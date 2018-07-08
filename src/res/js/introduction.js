var currentScreen = 1, selectedSearchEngine;

$(function(){
    updateListSearchEngine(); // Affichage des moteurs disponibles
    
    if(localStorage['backgroundColor']==null && localStorage['accentColor']==null)
    {
        // Définition des couleurs par défaut
        localStorage['backgroundColor'] = '#F57900';
        localStorage['accentColor'] = '#C80064';
    }
    $("#backgroundColor").css('background',localStorage['backgroundColor']);
    $("#accentColor, .listMotors").css('background',localStorage['accentColor']);
    $('body').css('background-color',localStorage['backgroundColor']);
    
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
            if($('.listMotors').css('display')=='block')
                showMotors();
        }
        if (e.keyCode == 37 || e.keyCode == 38)
            goBack();
        if (e.keyCode == 39 || e.keyCode == 40)
            goNext();
    });
});


function showTooltip(text) // Afficher les bulles d'infos
{
	/*if(text=='')
		$('.toolBar p').css('display','none');
	else
	{
		$('.toolBar p').css('display','inline-block');
		$('.toolBar p').html(text);
	}*/
}



function goBack()
{
	var nbreScreen = $(".chooseMotors .screen").length, i=1;
	
	for (i = 1; i <= nbreScreen; i++)
		$('#screen' + i).css('display','none');
	
	if(currentScreen > 1)
	{
		currentScreen = currentScreen -1;
		$('#screen' + currentScreen).fadeIn();
	}
	else
	{
		$('#screen' + nbreScreen).fadeIn();
		currentScreen = nbreScreen;
	}
}

function goNext()
{
	var nbreScreen = $(".chooseMotors .screen").length, i=1;
	
	if(currentScreen+1 <= nbreScreen)
	{
		for (i = 1; i <= nbreScreen; i++)
			$('#screen' + i).css('display','none');
		
		currentScreen = currentScreen +1;
		$('#screen'+currentScreen).fadeIn();
	}
	else if(currentScreen == nbreScreen)
		saveSettings();
	else
		alert('Erreur');
}

function showMotors()
{
	if($('.panel').css('display')=='block') // Si on veut cacher la liste des moteurs (si elle est visible)
		$('.panel').fadeOut();
	else
	{
		$('.panel').fadeIn();
        
		$('.listMotors').css('right','50px');
		$('.listMotors').css('top','5px');
		$('.listMotors').css('width','initial');
		$('.listMotors').css('height','initial');
	}
}

function viewScreen(screenImg)
{
	var nbreScreen = $(".chooseMotors .screen").length, i=1;
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
	
	$('body').css('background','rgb(255,100,0)');
}

function setSearchEngine(id)
{
    selectedSearchEngine = listSearchEngines[id];
    
	// Set the view
	$('#imgMotor div').css('background','url('+selectedSearchEngine.icon+') no-repeat center center / cover');
	if(selectedSearchEngine.title!='')
		$('#imgMotor span').html(selectedSearchEngine.title);
	else
		$('#imgMotor span').html('Aucun');
	
	showMotors();
}

function saveSettings()
{
	localStorage['searchEngine-title'] = selectedSearchEngine.title;
	localStorage['searchEngine-icon'] = selectedSearchEngine.icon;
	localStorage['searchEngine-prefix'] = selectedSearchEngine.urlPrefix;
	localStorage['searchEngine-suffix'] = selectedSearchEngine.urlSuffix;
	
	localStorage['bgImg'] = '';
	
	localStorage['display'] = 'sideScreen';
	localStorage['format'] = 'icones';
	localStorage['searchOn'] = 'currentTab';
	
	localStorage['doosearchVersion'] = 1.32;
	
	var pinnedMotors = [];
	localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
	var pinnedWebsites = [];
	localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
	var bgImgGallery = [];
	localStorage['bgImgGallery'] = JSON.stringify(bgImgGallery);
	
	document.location.href='home.php';
}