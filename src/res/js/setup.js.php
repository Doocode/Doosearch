<?php 
header("Content-type: text/javascript; charset: UTF-8"); 
require("../php/core/Core.php");
$lang->setSection('setup');
?>

var currentScreen = 1, selectedSearchEngine, bgImgGallery = [], defaultWebsites = [], defaultEngines = [];

// # Paramètres par défaut
$(function(){
    $('#setupPage').addClass('selected');
    
    if(localStorage['doosearchVersion'] == undefined) // Si Doosearch n'a jamais été lancé
    {
        // On défini les ...
        /// Paramètres par défaut
        
        // Définition des couleurs par défaut
        localStorage['backgroundColor'] = '#2E3436';
        localStorage['accentColor'] = '#FF0064';
        localStorage['bgImg'] = '';
        localStorage['bgImgGallery'] = JSON.stringify([]);
        
        // Moteur de recherche
        selectedSearchEngine = new SearchEngine('Qwant', 'res/img/motors/qwant.png', 'https://www.qwant.com/?q=', ''); // A piocher dans la base de données 

        // Sites épinglés
        defaultWebsites.push(genLink('Feldrise','http://feldrise.com/favicon.ico','https://feldrise.com/'));
        defaultWebsites.push(genLink('Sielo','https://sielo.app/images/icon.png','https://sielo.app/'));
        defaultWebsites.push(genLink('Sielo (GitHub)','https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png','https://github.com/SieloBrowser/SieloBrowser'));
        defaultWebsites.push(genLink('Doocode','res/img/family/doocode.png','https://doocode.xyz/'));
        
        // Moteurs épinglés
        defaultEngines.push(new SearchEngine('Dropbox', 'res/img/motors/dropbox.png', 'https://www.dropbox.com/search/personal?query_unnormalized=', '&last_fq_path=').setID(25));
        defaultEngines.push(new SearchEngine('DeviantArt', 'res/img/motors/deviantart.png', 'http://browse.deviantart.com/?q=', '').setID(22));
        defaultEngines.push(new SearchEngine('Fnac', 'res/img/motors/new/fnac.jpg', 'http://recherche.fnac.com/SearchResult/ResultList.aspx?Search=', '').setID(32));
        defaultEngines.push(new SearchEngine('Boulanger', 'res/img/motors/boulanger.jpg', 'http://www.boulanger.com/resultats?tr=', '').setID(14));
        defaultEngines.push(new SearchEngine('Dribbble', 'res/img/motors/new/dribbble.png', 'https://dribbble.com/search?q=', '').setID(24));
        defaultEngines.push(new SearchEngine('Deezer', 'res/img/motors/new/deezer.png', 'http://www.deezer.com/search/', '').setID(21));
        defaultEngines.push(new SearchEngine('France.tv', 'res/img/motors/francetv.png', 'https://www.france.tv/recherche/?q=', '').setID(35));
    }
    else // Sinon
    {
        // On fait une ...
        /// Mise à jour : on récupère les paramètres anciens et on les mets à jour
        
        selectedSearchEngine = new SearchEngine(localStorage['searchEngine-title'], localStorage['searchEngine-icon'], localStorage['searchEngine-prefix'], localStorage['searchEngine-suffix']);
        
        defaultEngines = JSON.parse(localStorage['pinnedMotors']);
        defaultWebsites = JSON.parse(localStorage['pinnedWebsites']);
        bgImgGallery = JSON.parse(localStorage['bgImgGallery']);
    }
    
    $('#imgMotor span').html(selectedSearchEngine.title);
	$('#imgMotor div').css('background','url('+selectedSearchEngine.icon+') no-repeat center center / cover');

    $("#backgroundColor").css('background',localStorage['backgroundColor']);
    $("#accentColor, .popupSearchEngines").css('background',localStorage['accentColor']);
    if(localStorage['bgImg'] == '')
        $('#backgroundImage').css('background-image','url("res/img/bgs/empty.png")');
    else
        $('#backgroundImage').css('background-image','url(' + localStorage['bgImg'] + ')');
	$('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    updateBgFilter();
    updateView();
    
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
    
    updateView();
    hideScreen();
}

function goNext()
{
	var nbreScreen = $(".content .screen").length, i=1;
	
	if(currentScreen+1 <= nbreScreen)
	{
		currentScreen = currentScreen +1;
        updateView();
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
    updateBgFilter();
	$('#backgroundImage').css('background-image','url(' + imgUrl + ')');
	$('body').css('background','url(' + imgUrl + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
}

function resetBgImg()
{
	// Saving
	localStorage['bgImg'] = '';
	
    // Update views
    bgImg = 'res/img/bgs/empty.png';
    $('#editBgImg .viewer, #backgroundImage').css('background-image','url(' + bgImg + ')');
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    $('#editBgImg input').val(localStorage['bgImg']);
    updateBgFilter();
}

function importImage()
{
    var imgUrl = prompt("<?= $lang->getKey("enter_the_url_of_the_wallpaper"); ?>");
    
    if(imgUrl.substr(0,7) == 'http://' || imgUrl.substr(0,8) == 'https://')
    {
        bgImgGallery.push(imgUrl);
        localStorage['bgImgGallery'] = JSON.stringify(bgImgGallery);

        updateBgGallery();
        
        setBgImg(imgUrl);
    }
    else
        alert('<?= $lang->getKey("invalid_address"); ?>');
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

function updateBgFilter()
{
    if(localStorage['bgImg'] != '')
    {
        value = 25;
        if(localStorage['bgImgFilter'] != undefined)
            value = localStorage['bgImgFilter'];
        
        if(value>0)
            $('.central').css('background', 'rgba(0,0,0,'+(value/100)+')');
        else
            $('.central').css('background', 'rgba(255,255,255,'+(Math.abs(value)/100)+')');
    }
    else
        $('.central').css('background', 'transparent');
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

function updateScreen()
{
    $('.screen').css('display','none');
	$('#screen'+currentScreen).fadeIn();
    
    if(currentScreen==1)
        $('#back').hide();
    else
        $('#back').css('display','inline-block');
}

function updateView()
{
    updateScreen();
    updatePagination();
}

function updatePagination()
{
    let categories = ['intro', 'customize', 'ending'];
    let nbSlide = 1;
    for(let i=0; i<categories.length; i++)
    {
        
        let contener = $('#'+categories[i]+' .slides');
        if(contener.children().length == 0) // Si la pagination n'a pas été généré
        {
            // On génère la pagination
            let n = nbSlide;
            $('#'+categories[i]).click(function(){
                goTo(n); 
            });
            
            let screens = $('.'+categories[i]).length;
            for(let j=0; j<screens; j++)
            {
                let page = $('<li/>');
                page.addClass('page'+nbSlide);
                page.attr('title',$('#screen'+nbSlide+' h1').html());
                let n = nbSlide;
                page.click(function(e){
                    goTo(n); 
                    e.stopPropagation();
                });
                contener.append(page);
                nbSlide++;
            }
        }
    }
        
    // On active la page actuelle
    $('.pagination li').removeClass('active'); // On désactive tout
    $('.pagination .page'+currentScreen).addClass('active'); // On active la led du slide actuel
    for(let i=0; i<categories.length; i++)
    {
        if($('#screen'+currentScreen).attr('class').includes(categories[i]))
        {
            $('#'+categories[i]).addClass('active');
            break;
        }
    }
}

function goTo(n)
{
    currentScreen = n;
    updateView();
}

function saveSettings()
{
	localStorage['doosearchVersion'] = 1.33;
	
	localStorage['searchEngine-title'] = selectedSearchEngine.title;
	localStorage['searchEngine-icon'] = selectedSearchEngine.icon;
	localStorage['searchEngine-prefix'] = selectedSearchEngine.urlPrefix;
	localStorage['searchEngine-suffix'] = selectedSearchEngine.urlSuffix;
	
	localStorage['pinnedMotors'] = JSON.stringify(defaultEngines);
	localStorage['pinnedWebsites'] = JSON.stringify(defaultWebsites);
	localStorage['bgImgGallery'] = JSON.stringify(bgImgGallery);
    
    setSetting('bgImgFilter', 25);
    
	setSetting('format', 'icones');
	setSetting('contrast', 'light');
	setSetting('searchOn', 'currentTab');
	
	document.location.href='search.php';
}

// La fonction setSetting() permet de sauvegarder des paramètre s'ils n'existent pas (pour ne pas écraser les params existantes)
function setSetting(key, value)
{
    if(localStorage[key] == undefined)
        localStorage[key] = value;
}