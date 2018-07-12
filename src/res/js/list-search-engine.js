$(function(){ // Après le chargement de la page
    $.ajax({ // On récupère les moteurs disponibles en Ajax et JSON
		url: 'res/feed/search-engines.php',
		success: function(data) {
			loadSearchEngines(data);
		},
        error: function() {
            alert('Erreur lors de la récupération des moteurs de recherche');
        }
	});
    $('.menuEngine').slideUp(); // Fermeture du menu contextuel
    
    $('#findEngine').on('input',function(e) {
        var query = $('#findEngine').val(); // On récupère les termes saisis par l'utilisateur
        for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        {
            let engine = listSearchEngines[i];
            if(query.size=='' || engine.title.toLowerCase().includes(query.toLowerCase()))
                $('#search-engine-'+i).fadeIn();
            else
                $('#search-engine-'+i).fadeOut();
        }
    });
    $('.popupSearchEngines .top, .menuEngine').contextmenu(function(e){e.stopPropagation(); return true;});
});

var listSearchEngines = []; // Liste des moteurs disponible
var currentContextEngine;
(function(){
    var item = new SearchEngine('Demander plus tard','res/img/choose.png','','');
    listSearchEngines.push(item); // Ajout du moteur "nul"
})();

function loadSearchEngines(data)
{
    var engines = jQuery.parseJSON(data);
    for(let i=0; i<engines.length; i++)
    {
        let engine = new SearchEngine(engines[i].title, engines[i].icon, engines[i].prefix, engines[i].suffix);
        engine.setID(engines[i].id);
        listSearchEngines.push(engine);
    }
    updateListSearchEngine(); // Mise à jour de l'affichage des moteurs disponibles
}

function updateListSearchEngine()
{
    for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
    {
        let engine = listSearchEngines[i];
        
        let button = $('<li/>');
        button.attr('id','search-engine-'+i);
        button.click(function(){setSearchEngine(i);});
        button.contextmenu(function(e){askAboutEngine(i); e.stopPropagation(); return false;});
        var icon = $('<img/>').attr('src', engine.icon);
        var text = $('<p/>').html(engine.title);
        button.append(icon).append(text);
        $('.popupSearchEngines .searchEngines').append(button);
    }
}

function clearSearchBar()
{
    $('#findEngine').val(''); 
    for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        $('#search-engine-'+i).fadeIn();
}

function toggleSearchBar()
{
    if($('#findEngine').css('display')=='block')
    {
        $('#findEngine').slideUp(400, function(){
            $('.popupSearchEngines .center').css('top',$('.popupSearchEngines .top').css('height'));
        });
    }
    else
    {
        $('#findEngine').slideDown(400, function(){
            $('.popupSearchEngines .center').css('top',$('.popupSearchEngines .top').css('height'));
        });
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
    
    if(typeof pinnedMotors !== 'undefined')
    {
        for(let i=0; i<pinnedMotors.length; i++)
        {
            if(pinnedMotors[i].title==engine.title)
            {
                $('#actPinEngine').hide();
                $('#actUnpinEngine').css('display','inline-block');
                break;
            }
            else
            {
                $('#actPinEngine').css('display','inline-block');
                $('#actUnpinEngine').hide();
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
    if(confirm('Voulez-vous vraiment supprimer le moteur "' + engine.title + '" de vos favoris ?'))
    {
        let i;
        for(i=0;i<pinnedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà épinglé
        {
            if(pinnedMotors[i].title==engine.title)
                break;
        }
        
        pinnedMotors.splice(i, 1);
	    localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
        updatePinnedMotors();
    }
}