var currentScreen = 1, selectedSearchEngine, bgImgGallery, defaultWebsites = [];

// Paramètres par défaut
selectedSearchEngine = new SearchEngine('Qwant', 'res/img/motors/qwant.png', 'https://www.qwant.com/?q=', ''); // A piocher dans la base de données 
defaultWebsites.push(genLink('Doocode','http://doocode.xyz/res/img/favicon.png','http://doocode.xyz/'));
defaultWebsites.push(genLink('Doosearch','http://search.doocode.xyz/res/img/favicon.png','http://search.doocode.xyz/'));
defaultWebsites.push(genLink('Doochronos','http://chronos.doocode.xyz/res/img/favicon.png','http://chronos.doocode.xyz/'));
defaultWebsites.push(genLink('Fonds d\'écran Doocode','http://doocode.xyz/res/img/logo/goodies.png','http://doocode.xyz/goodies.html'));

$(function(){
    $('#setupPage').addClass('selected');
    
    //selectedSearchEngine = new SearchEngine('Demander plus tard','res/img/choose.png','',''); // Moteur par défaut
    $('#imgMotor span').html(selectedSearchEngine.title);
	$('#imgMotor div').css('background','url('+selectedSearchEngine.icon+') no-repeat center center / cover');
    if(localStorage['backgroundColor']==null && localStorage['accentColor']==null && localStorage['bgImg']==null)
    {
        // Définition des couleurs par défaut
        localStorage['backgroundColor'] = '#F57900';
        localStorage['accentColor'] = '#C80064';
        localStorage['bgImg'] = '';
        localStorage['bgImgGallery'] = JSON.stringify([]);
    }
    bgImgGallery = JSON.parse(localStorage['bgImgGallery']);
    $("#backgroundColor").css('background',localStorage['backgroundColor']);
    $("#accentColor, .popupSearchEngines").css('background',localStorage['accentColor']);
    if(localStorage['bgImg'] == '')
        $('#backgroundImage').css('background-image','url("res/img/bgs/empty.png")');
    else
        $('#backgroundImage').css('background-image','url(' + localStorage['bgImg'] + ')');
	$('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    
    $( "#colorSelector" ).on( "colorSelected", function( event, newColor ){
        var preview, localName;
        if(currentColorSelectorPopup=='background')
        {
            preview = '#backgroundColor';
            localName = 'backgroundColor';
        }
        else if(currentColorSelectorPopup=='accent')
        {
            preview = '#accentColor';
            localName = 'accentColor';
        }

        localStorage[localName] = newColor;
        $('body').css('background-color',localStorage['backgroundColor']);
        $(preview).css('background',newColor);
    });

    $( window ).resize(function() {
        if(parseInt($('body').css('width').split("px").join(""))<1000)
        {
            if($('.screenView').css('display')!='block')
                hideScreen();
        }
    });

    $(document).keyup(function(e) {
        if (e.keyCode == 27)
        {
            if($('.popupSearchEngines').css('display')=='block')
                showMotors();
        }
        if (e.keyCode == 37 || e.keyCode == 38)
            goBack();
        if (e.keyCode == 39 || e.keyCode == 40)
            goNext();
    });
});

function goBack()
{
	var nbreScreen = $(".content .screen").length, i=1;
	
	if(currentScreen > 1)
		currentScreen = currentScreen -1;
	else
		currentScreen = nbreScreen;
    
    updateScreen();
    hideScreen();
}

function goNext()
{
	var nbreScreen = $(".content .screen").length, i=1;
	
	if(currentScreen+1 <= nbreScreen)
	{
		currentScreen = currentScreen +1;
        updateScreen();
	}
	else if(currentScreen == nbreScreen)
		saveSettings();
	else
		alert('Erreur');
    
    hideScreen();
}

function showMotors()
{
	if($('.panel').css('display')=='block') // Si on veut cacher la liste des moteurs (si elle est visible)
		$('.panel').fadeOut();
	else
	{
		$('.panel').fadeIn();
        clearSearchBar(); // On efface la zone de recherche
        $('.searchBar input').focus();
	}
}

function showEditor(editor)
{
	if($(editor).css('display')=='none')
        $(editor).slideDown();
    else
        $(editor).slideUp();
}

function setBgImg(imgUrl)
{
    localStorage['bgImg'] = imgUrl;
	
	// Preview
	$('#backgroundImage').css('background-image','url(' + imgUrl + ')');
	$('body').css('background','url(' + imgUrl + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
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

function viewScreen(screenImg)
{
	var nbreScreen = $(".content .screen").length, i=1;
	for (i = 1; i <= nbreScreen; i++)
		$('#screen' + i).css('display','none');
	$('.screenView').slideDown();
	$('.screenView').attr('src',screenImg);
	
	$('body').css('background','rgb(50,50,50)');
}

function hideScreen()
{
	$('.screenView').css('display','none');
	$('#screen'+currentScreen).slideDown();
	
	$('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
}

function setSearchEngine(id)
{
    selectedSearchEngine = listSearchEngines[id];
    
	// Set the view
	$('#imgMotor div').css('background','url('+selectedSearchEngine.icon+') no-repeat center center / cover');
	$('#imgMotor span').html(selectedSearchEngine.title);
	
	showMotors();
}

function genLink(title, icon, url)
{
    var item = {
        title: title,
        icon: icon,
        url: url
    };
    return item;
}

function skipIntro()
{
    currentScreen = 5;
    updateScreen();
}

function updateScreen()
{
    $('.screen').css('display','none');
	$('#screen'+currentScreen).fadeIn();
    
    if(currentScreen==1)
        $('#back').hide();
    else
        $('#back').css('display','inline-block');
}

function saveSettings()
{
	localStorage['searchEngine-title'] = selectedSearchEngine.title;
	localStorage['searchEngine-icon'] = selectedSearchEngine.icon;
	localStorage['searchEngine-prefix'] = selectedSearchEngine.urlPrefix;
	localStorage['searchEngine-suffix'] = selectedSearchEngine.urlSuffix;
	
	localStorage['format'] = 'icones';
	localStorage['searchOn'] = 'currentTab';
	
	localStorage['doosearchVersion'] = 1.32;
	
	var pinnedMotors = [];
	localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
	var pinnedWebsites = defaultWebsites;
	localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
	var bgImgGallery = [];
	localStorage['bgImgGallery'] = JSON.stringify(bgImgGallery);
	
	document.location.href='search.php';
}