$(function(){ // Après le chargement de la page
	Doosearch.lang.setModule('search_engines');
	Doosearch.searchEngines = [];
	Doosearch.searchEngines.isReady = false;
	
    // Format d'affichage de la liste
    if(localStorage['format']=='icones' || typeof localStorage['format'] == 'undefined')
        showAsList(false);
    else if(localStorage['format']=='liste')
        showAsList(true);
    
    $('.menuEngine').slideUp(); // Fermeture du menu contextuel
    
    $('.searchBar input').on('input',function(e) {
        searchEngines($('.searchBar input').val()); // On lance la recherche des moteur avec les termes saisis par l'utilisateur
        $('#add-search-engine').hide(); 
        
        if($('.searchBar input').val().length > 0)
            $('.searchBar').addClass('withCleaner');
        else
            $('.searchBar').removeClass('withCleaner');
        
        return true;
    });
    $('.popupSearchEngines .top, .menuEngine').contextmenu(function(e){e.stopPropagation(); return true;});

	/*$('.popupSearchEngines').draggable({
		axis : 'y'
	});*/
});

function showMenu() {
	if($('.popupSearchEngines .side').hasClass('visible')) {
		$('.popupSearchEngines .side').removeClass('visible');
		$('.popupSearchEngines .center').addClass('maximized');
	}
	else {
		$('.popupSearchEngines .side').addClass('visible');
		$('.popupSearchEngines .center').removeClass('maximized');
	}
}

var listSearchEngines = []; // Liste des moteurs disponible
var currentContextEngine;
$(function(){
	let title = Doosearch.lang.getText("ask_later", 'Ask later', function() {
		let title = Doosearch.lang.getText("ask_later", 'Ask later');
		var item = new SearchEngine(title,'res/img/choose.png','','');
		item.setSelected(false);
		listSearchEngines[0] = item; // Ajout du moteur "nul"
	});
    var item = new SearchEngine(title,'res/img/choose.png','','');
    item.setSelected(false);
    listSearchEngines.push(item); // Ajout du moteur "nul"
});

function loadSearchEngines() {
	if(!Doosearch.searchEngines.isReady) {
		$.ajax({ // On récupère les moteurs disponibles en Ajax et JSON
			url: 'res/feed/search-engines.php',
			success: function(data) {
				loadSearchEnginesData(data);
			},
			error: function() {
				alert(Doosearch.lang.getText("error_retrieving_search_engines", 'Error while retrieving search engines'));
			}
		});
		$.ajax({ // On récupère la liste des catégories disponibles en Ajax et JSON
			url: 'res/feed/categories.php',
			success: function(data) {
				loadCategories(data);
			},
			error: function() {
				alert(Doosearch.lang.getText("error_retrieving_search_engines", 'Error while retrieving search engines'));
			}
		});
	}
}

function loadSearchEnginesData(data)
{
    var engines = data;
    for(let i=0; i<engines.length; i++)
    {
        let engine = new SearchEngine(engines[i].title, engines[i].icon, engines[i].prefix, engines[i].suffix);
        engine.setID(engines[i].id);
		engine.categories = engines[i].categories;
        listSearchEngines.push(engine);
    }
	Doosearch.searchEngines.isReady = true;
    updateListSearchEngine(); // Mise à jour de l'affichage des moteurs disponibles
}

function loadCategories(data)
{
    var categories = data;
    for(let i=0; i<categories.length; i++)
    {
		let radio = $('<input type="radio" name="sort" />').attr('id',categories[i].keyword);
		let label = $('<label/>').html(categories[i].text).attr('for',categories[i].keyword);
		$('.popupSearchEngines .side').append(radio).append(label);
    }

    $('.popupSearchEngines .side input[type=radio]').change(function(e){
		sortEngines($(this).attr('id'));
		searchEngines($('.searchBar input').val());
	});
}

function sortEngines(sort) {
	clearSearchBar();
	$('.popupSearchEngines .searchEngines li').hide();
	
	switch(sort) {
		case 'all':
			for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
				$('#search-engine-'+i).fadeIn();
			break;
		default:
			for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
			{
				let engine = listSearchEngines[i];
				let categories = listSearchEngines[i].categories;
				
				// https://stackoverflow.com/questions/7241878/for-in-loops-in-javascript-key-value-pairs
				for (var key in categories){
					if (categories.hasOwnProperty(key) && key == sort && categories[key] == '1') {
						$('#search-engine-'+engine.id).fadeIn();
					}
				}
			}

			break;
	}
}

function updateListSearchEngine()
{
    if($(".popupSearchEngines .searchEngines > li").length <= 2)
    {        
        $(".popupSearchEngines .searchEngines").html('');
        for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        {
            let engine = listSearchEngines[i];
            
            if(typeof selectedEngines !== 'undefined') // Si les moteurs sélectionnés sont utilisés sur la page
            {
                for(let j=0; j<selectedEngines.length; j++)
                {
                    var item = selectedEngines[j];
                    if(engine.title == item.title)
                        engine.setSelected(true);
                }
            }

            let button = $('<li/>');
            if(engine.isSelected==true) 
                button.addClass('selected');
            button.attr('id','search-engine-'+i);
            button.click(function(){setSearchEngine(i);});
            button.contextmenu(function(e){askAboutEngine(i); e.stopPropagation(); return false;});
            var icon = $('<img/>').attr('src', engine.icon);
            var text = $('<p/>').html(engine.title);
            button.append(icon).append(text);
            $('.popupSearchEngines .searchEngines').append(button);
        }
        
        let button = $('<li/>');
        button.attr('id','add-search-engine');
        button.click(function(){
            needToPinMotor=false;
            needToAddSelectedMotor=true;
            clearSearchBar();
        });
        var icon = $('<img/>').attr('src', 'res/img/add-engine.png');
        var text = $('<p/>').html(Doosearch.lang.getText("add_search_engine", 'Add search engine', updateListSearchEngine));
        button.append(icon).append(text);
        $('.popupSearchEngines .searchEngines').append(button);
    }
    else
    {
        for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        {
            let engine = listSearchEngines[i];
            $('#search-engine-'+i).removeClass('selected');
            if(engine.isSelected==true) 
                $('#search-engine-'+i).addClass('selected');
        }
    }
}

function searchEngines(query)
{
	Doosearch.lang.setModule('search');
    query = accentFold(query.toLowerCase()); // On traite le string
    let category = $('input[name=sort]:checked').attr('id');

    for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
    {
        let engine = listSearchEngines[i];
        let condition1 = (query.size=='' || engine.title.toLowerCase().includes(query));
        let condition2 = (accentFold(Doosearch.lang.getText("selected", 'selected')).toLowerCase().includes(query) && engine.isSelected);
        let condition3 = engine.hasCategory(category);
		let condition10 = (condition1 || condition2) && category == 'all';
		let condition11 = category != 'all' && condition1 && condition3;

        if(condition10 || condition11)
            $('#search-engine-'+i).fadeIn();
        else
            $('#search-engine-'+i).hide();
    }
	Doosearch.lang.setModule('search_engines');
}

function clearSearchBar()
{ 
    $('.searchBar').removeClass('withCleaner');
    $('.searchBar input').val(''); 
    $('#add-search-engine').hide(); 
    for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        $('#search-engine-'+i).fadeIn();
}

function toggleSearchBar()
{
    if($('.searchBar').css('display')=='block')
    {
        $('.searchBar').slideUp(400, function() {
			let top = $('.popupSearchEngines .top').css('height');
            //$('.popupSearchEngines .side').css('padding-top',top);
            $('.popupSearchEngines .center').css('top', top);
		});
		$('#recherche').removeClass('checked');
    }
    else
    {
        $('.searchBar').slideDown(400, function(){
			let top = $('.popupSearchEngines .top').css('height');
            //$('.popupSearchEngines .side').css('padding-top',top);
            $('.popupSearchEngines .center').css('top', top);
        });
		$('#recherche').addClass('checked');
    }
}

function askAboutEngine(id)
{
    currentContextEngine = id;
    let engine = listSearchEngines[id];
    $('.menuEngine .view img').attr('src', engine.icon);
    $('.menuEngine .view h5').html(engine.title);
    $('.popupSearchEngines, .content, .page, .toolBar').css('filter','blur(4px) brightness(50%)');
    $('.central.menu').fadeIn();
    $('.menuEngine').slideDown();
    
    if(typeof pinnedMotors !== 'undefined') // Si les moteurs épinglés sont utilisés sur la page
    {
        $('#actPinEngine').css('display','inline-block'); // On affiche le bouton épingler
        $('#actUnpinEngine').hide(); // Et on cache le bouton désépingler
        
        for(let i=0; i<pinnedMotors.length; i++) // On parcours les moteurs épinglés
        {
            if(pinnedMotors[i].title==engine.title) // Et si le moteur[id] est épinglé
            {
                $('#actPinEngine').hide(); // On cache le bouton épingler
                $('#actUnpinEngine').css('display','inline-block'); // Et on affiche le bouton désépingler
                break; // Et on sort de la boucle
            }
        }
    }
    
    if(typeof selectedEngines !== 'undefined') // Si les moteurs sélectionnés sont utilisés sur la page
    {
        $('#actAddEngine').css('display','inline-block'); // On affiche le bouton sélectionner
        $('#actRemoveEngine').hide(); // Et on cache le bouton désélectionner
        
        for(let i=0; i<selectedEngines.length; i++) // On parcours les moteurs épinglés
        {
            if(selectedEngines[i].title==engine.title) // Et si le moteur[id] est sélectionné
            {
                $('#actAddEngine').hide(); // On cache le bouton sélectionner
                $('#actRemoveEngine').css('display','inline-block'); // Et on affiche le bouton désélectionner
                break; // Et on sort de la boucle
            }
        }
    }
}

function hideMenuEngine()
{
    $('.popupSearchEngines, .content, .page, .toolBar').css('filter','blur(0px) brightness(100%)');
    $('.menuEngine').slideUp();
    $('.central.menu').fadeOut();
}

function removePinnedEngine(id)
{
    let engine = listSearchEngines[id];

    let message = Doosearch.lang.getText("remove_the_search_engine_from_favorite", 'Do you really want to remove the search engine \"%search_engine%\" from your favorites?');
    message = message.replace('%search_engine%',engine.title);
    
    if(confirm(message))
    {
        let i;
        for(i=0;i<pinnedMotors.length;i++) // On chercher le moteur épinglé
        {
            if(pinnedMotors[i].title==engine.title)
                break;
        }
        
        pinnedMotors.splice(i, 1);
	    localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
        updatePinnedMotors();
    }
}

function showAsList(show) // Pour afficher la liste de moteur sous forme de liste ou d'icônes
{
	if(show==true) // Si on veut l'afficher sous forme de liste
	{
		$('.popupSearchEngines').addClass('list');
		$('#list').addClass('checked');
		$('#icons').removeClass('checked');
	}
	else // Si on veut l'afficher sous forme d'icônes
	{
		$('.popupSearchEngines').removeClass('list');
		$('#list').removeClass('checked');
		$('#icons').addClass('checked');
	}
}