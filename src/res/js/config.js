var pinnedMotors, formColor, listColor, currentView, bgImg;

$(function()
{
    // Chargement des paramètres de l'utilisateur
    // Moteur par défaut
    updateSearchEngineView();

    // Pinned
    pinnedMotors = JSON.parse(localStorage['pinnedMotors']), pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']), bgImgGallery = JSON.parse(localStorage['bgImgGallery']);
    updatePinnedMotors();
    updatePinnedWebsite();
    updateBgGallery();

    // Apparence
    $('#previewBgForm input').css('background',localStorage['backgroundColor']);
    $('#previewBgList input, .listMotors').css('background',localStorage['accentColor']);
    $('.page article h3').css('color',localStorage['accentColor']);

    formColor = hexToArray(localStorage['backgroundColor']);
    $('#editBgForm .red input').val(formColor[0]);
    $('#editBgForm .green input').val(formColor[1]);
    $('#editBgForm .blue input').val(formColor[2]);
    listColor = hexToArray(localStorage['accentColor']);
    $('#editBgList .red input').val(listColor[0]);
    $('#editBgList .green input').val(listColor[1]);
    $('#editBgList .blue input').val(listColor[2]);
    
    $('body').css('background-color',localStorage['backgroundColor']);
    $('.navig').css('background',localStorage['accentColor']);

    bgImg = 'res/img/bgs/empty.png';
    if(localStorage['bgImg'] != '' || localStorage['bgImg'] == null)
        bgImg = localStorage['bgImg'];

    $('#editBgImg .viewer').css('background-image','url(' + bgImg + ')');
    $('#previewBgImg input').css('background-image','url(' + bgImg + ')');
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    $('#editBgImg input').val(localStorage['bgImg']);

    // Options
    $('#' + localStorage['display']).attr('checked','checked');
    $('#' + localStorage['format']).attr('checked','checked');
    $('#' + localStorage['searchOn']).attr('checked','checked');
    
    // Listeners
    $('body').click(function(e) {
        spinClick = false;

        return true;
    });

    $( "#colorSelector" ).on( "colorSelected", function( event, newColor ){
        var preview, localName;
        if(currentColorSelectorPopup=='background')
        {
            preview = '#previewBgForm';
            localName = 'backgroundColor';
        }
        else if(currentColorSelectorPopup=='accent')
        {
            preview = '#previewBgList';
            localName = 'accentColor';
        }

        localStorage[localName] = newColor;
        $('body').css('background-color',localStorage['backgroundColor']);
        $('.navig, #previewBgList input, .listMotors').css('background',localStorage['accentColor']);
        $('.page article h3').css('color',localStorage['accentColor']);
        $(preview+' input').css('background',newColor);
    });
});

function resizeEvent()
{
	if(isBodyWidthLess1000px())
	{
		$('#editBgForm').css('display','none');
		$('#editBgList').css('display','none');
		
		if(currentView!='')
			$(currentView).css('display','block');
	}
}

function scrollEvent()
{
	if(!isBodyWidthLess1000px())
	{
		if(document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)
		{
			$('.navig').addClass('fixedNav');
			$('.page .ctn').addClass('fixedCtn');
		}
		else
		{
			$('.navig').removeClass('fixedNav');
			$('.page .ctn').removeClass('fixedCtn');
		}
	}
}

function reset()
{
    if(confirm('Voulez-vous vraiment continuer ?'))
    {
        // Moteurs de recherche
        localStorage.removeItem("searchEngine-prefix");
        localStorage.removeItem("searchEngine-suffix");
        localStorage.removeItem("searchEngine-icon");
        localStorage.removeItem("searchEngine-title");

        // Moteurs et sites épinglés
        localStorage.removeItem("pinnedMotors");
        localStorage.removeItem("pinnedWebsites");

        // Themes
        localStorage.removeItem("bgImg");
        localStorage.removeItem("bgImgGallery");
        localStorage.removeItem("backgroundColor");
        localStorage.removeItem("accentColor");

        // Affichage
        localStorage.removeItem("display");
        localStorage.removeItem("format");
        localStorage.removeItem("searchOn");

        // Numero de version de Doosearch utilisé
        localStorage.removeItem("doosearchVersion");

        // Redirection
        document.location.href='index.php';
    }
}

function showEditor(editor)
{
    $('#editBgImg').slideUp();
    $('#editBgForm').slideUp();
    $('#editBgList').slideUp();
	
	if($(editor).css('display')=='none')
	{
		currentView = editor;
        $(editor).slideDown();
	}
	else
		currentView = '';
}

function updateBgImg()
{
	// Saving
	localStorage['bgImg'] = $(editor + ' .bgImgURL input').val();
	
	// Verify if exist and display background
    bgImg = 'res/img/bgs/empty.png';
    if(localStorage['bgImg'] != '' || localStorage['bgImg'] == null)
        bgImg = localStorage['bgImg'];

    $('#editBgImg .viewer').css('background-image','url(' + bgImg + ')');
    $('#previewBgImg input').css('background-image','url(' + bgImg + ')');
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    $('#editBgImg input').val(localStorage['bgImg']);
}

function importImage()
{
    var imgUrl = prompt("Collez l'adresse URL de l'image dans la zone de texte puis tapez entrez");
    
    if(imgUrl.substr(0,7) == 'http://' || imgUrl.substr(0,8) == 'https://')
    {
        bgImgGallery.push(imgUrl);
        localStorage['bgImgGallery'] = JSON.stringify(bgImgGallery);

        updateBgGallery();
        
        setBgImg(imgUrl);
    }
    else
        alert('Adresse non valide.');
}

function updateBgGallery()
{
    $('#customBgImg').html('<li id="btnImportImg" onclick="importImage();" style="background-image: url(res/img/bgs/import.png);"></li>');
    
    var d = 0;
    for(d;d<bgImgGallery.length;d++)
    {
        if(d==(bgImgGallery.length+1)/2 || d==(bgImgGallery.length+1)/2-.5)
            $('<br/>').insertAfter('#btnImportImg');
        
        if(bgImgGallery[d]!='')
            $('<li onclick="setBgImg(&quot;'+bgImgGallery[d]+'&quot;);" style="background-image: url('+bgImgGallery[d]+');"></li>').insertAfter('#btnImportImg');
    }
}

function updatePinnedMotors()
{
    $('#3 .pinned').html('<li style="display: none;"><img src="res/img/choose.png" /><p>Lorem ipsum</p></li>');
    
    var j = 0;
    for(j;j<pinnedMotors.length;j++)
    {
        if(pinnedMotors[j]!='')
            $('<li><img src="' + pinnedMotors[j].icon + '" /><p>' + pinnedMotors[j].title + '<span><button title="Modifier"><img src="res/img/config-icon.png" /></button> <button onclick="removeMotor('+j+');" title="Supprimer"><img src="res/img/close.png" /></button></span></p></li>').insertAfter('#3 .pinned li:last-child');
    }
    if(pinnedMotors.length==0)
        $('<li style="cursor: default; background: transparent; border: none; padding: 0px; box-shadow: none;"><p style="margin: 0px 5px; color: #000;">Aucun moteur de recherche épinglé</p></li>').insertAfter('#3 .pinned li:last-child');
}

function updatePinnedWebsite()
{
    $('#4 .pinned').html('<li style="display: none;"><img src="res/img/choose.png" /><p>Lorem ipsum</p></li>');
    
    var k = 0;
    for(k;k<pinnedWebsites.length;k++)
    {
        if(pinnedWebsites[k]!='')
            $('<li><img src="' + pinnedWebsites[k].icon + '" /><p>' + pinnedWebsites[k].title + '<span><button title="Modifier"><img src="res/img/config-icon.png" /></button> <button onclick="removeWebsite('+k+');" title="Supprimer"><img src="res/img/close.png" /></button></span></p></li>').insertAfter('#4 .pinned li:last-child');
    }
    if(pinnedWebsites.length==0)
        $('<li style="cursor: default; background: transparent; border: none; padding: 0px; box-shadow: none;"><p style="margin: 0px 5px; color: #000;">Aucun site épinglé</p></li>').insertAfter('#4 .pinned li:last-child');
}

function updateSearchEngineView()
{
    if(localStorage['searchEngine-icon']!='')
    {
        $('.selectMotor img').attr('src',localStorage['searchEngine-icon']);
        $('.selectMotor h4').html(localStorage['searchEngine-title']);
        $('.selectMotor p').html(localStorage['searchEngine-prefix'] + '<span>votre recherche</span>' + localStorage['searchEngine-suffix']);

        if(localStorage['searchEngine-title']=='')
        {
            $('.selectMotor h4').html('Aucun moteur');
            $('.selectMotor p').html('Il vous sera demandé de selectionner un moteur de recherche pour lancer une requete');
        }
    }
}

function resetBgImg()
{
	// Saving
	localStorage['bgImg'] = '';
	
    // Update views
    bgImg = 'res/img/bgs/empty.png';
    $('#editBgImg .viewer').css('background-image','url(' + bgImg + ')');
    $('#previewBgImg input').css('background-image','url(' + bgImg + ')');
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    $('#editBgImg input').val(localStorage['bgImg']);
}

function setBgImg(imgUrl)
{
	var localName = 'bgImg';
	
	// Saving
	localStorage[localName] = imgUrl;
	
	// Preview
	$('#editBgImg .viewer').css('background-image','url(' + localStorage[localName] + ')');
	$('#previewBgImg input').css('background-image','url(' + localStorage[localName] + ')');
	
	$('body').css('background','url(' + localStorage[localName] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
	
	$('#editBgImg input').val(localStorage[localName]);
}

function showMotors()
{
	if($('.panel').css('display')=='block') // Si on veut cacher la liste des moteurs (si elle est visible)
    {
        $('.panel').fadeOut();
        clearSearchBar(); // On efface la zone de recherche
        
		$('body').css('overflow','auto');
    }
	else
	{
        $('.panel').fadeIn();
        $('#findEngine').focus();
        
        $('body').css('overflow','hidden');
		$('.listMotors').css('right','50px');
		$('.listMotors').css('top','5px');
		$('.listMotors').css('width','initial');
		$('.listMotors').css('height','initial');
		$('.listMotors').css('position','fixed');
	}
}

function setSearchEngine(id)
{
    var item = listSearchEngines[id];
    
	// Setting motors
	localStorage['searchEngine-prefix'] = item.urlPrefix;
	localStorage['searchEngine-suffix'] = item.urlSuffix;
	localStorage['searchEngine-title'] = item.title;
	localStorage['searchEngine-icon'] = item.icon;
		
	updateSearchEngineView(); // Update view
	showMotors(); // Hide the popup
}

function removeMotor(id)
{
    if(confirm('Voulez-vous vraiment supprimer le moteur "' + pinnedMotors[id].title + '" de vos favoris ?'))
    {
        pinnedMotors.splice(id, 1);
        updatePinnedMotors();
	   localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
    }
}

function removeWebsite(id)
{
    if(confirm('Voulez-vous vraiment supprimer le site "' + pinnedMotors[id].title + '" de votre accès rapide ?'))
    {
        pinnedWebsites.splice(id, 1);
        updatePinnedWebsite();
	   localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
    }
}

function setViewMode(radioName)
{
	var value = $('input[name=' + radioName + ']:checked').attr('id');
	
	if(radioName=='taille')
		localStorage['display'] = value;
	if(radioName=='forme')
		localStorage['format'] = value;
	if(radioName=='lancementRecherche')
		localStorage['searchOn'] = value;
}

function showCtn(show)
{
	if(isBodyWidthLess1000px())
	{
		if(show == true)
		{
			$('.page .navig').css('display','none');
			$('.page .ctn').css('display','block');
		}
		else
		{
			$('.page .navig').css('display','block');
			$('.page .ctn').css('display','none');
		}
	}
}