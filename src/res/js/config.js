var pinnedMotors, formColor, listColor, currentViews = [], bgImg;

$(function()
{
    $('#configPage').addClass('selected');
    
    // Chargement des paramètres de l'utilisateur
    // Moteur par défaut
    updateSearchEngineView();

    // Pinned
    pinnedMotors = JSON.parse(localStorage['pinnedMotors']), pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']), bgImgGallery = JSON.parse(localStorage['bgImgGallery']);
    updatePinnedMotors();
    updatePinnedWebsite();
    updateBgGallery();
    updateBgFilter();

    // Apparence
    $('#previewBgForm input').css('background',localStorage['backgroundColor']);
    $('#previewBgList input, .popupSearchEngines').css('background',localStorage['accentColor']);
    $('.page article h3').css('color',localStorage['accentColor']);
    $('.slider input').val(localStorage['bgImgFilter']);

    formColor = hexToArray(localStorage['backgroundColor']);
    $('#editBgForm .red input').val(formColor[0]);
    $('#editBgForm .green input').val(formColor[1]);
    $('#editBgForm .blue input').val(formColor[2]);
    listColor = hexToArray(localStorage['accentColor']);
    $('#editBgList .red input').val(listColor[0]);
    $('#editBgList .green input').val(listColor[1]);
    $('#editBgList .blue input').val(listColor[2]);
    
    $('body, .slider .color').css('background-color',localStorage['backgroundColor']);
    $('.navig').css('background',localStorage['accentColor']);

    bgImg = 'res/img/bgs/empty.png';
    if(localStorage['bgImg'] != '' || localStorage['bgImg'] == null)
        bgImg = localStorage['bgImg'];

    $('#editBgImg .viewer').css('background-image','url(' + bgImg + ')');
    $('#previewBgImg input').css('background-image','url(' + bgImg + ')');
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    $('#editBgImg input').val(localStorage['bgImg']);

    // Options
    $('#' + localStorage['format']).attr('checked','checked');
    $('#' + localStorage['searchOn']).attr('checked','checked');
    $('#' + localStorage['contrast']).attr('checked','checked');
    
    // Listeners
    $('body').click(function(e) {
        spinClick = false;

        return true;
    });
    
    $('.navig a').click(function(event) {
        if(isBodyWidthLess1000px())
        {
            var id = $(event.target).attr('href');
            $('article').hide();
            $(id).fadeIn();
            currentViews.push(id);
        }
        $('#titleBar h2').html($(event.target).html());
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
        $('body, .slider .color').css('background-color',localStorage['backgroundColor']);
        $('.navig, #previewBgList input, .popupSearchEngines').css('background',localStorage['accentColor']);
        $('.page article h3').css('color',localStorage['accentColor']);
        $(preview+' input').css('background',newColor);
        updateBgFilter();
    });

    $('.slider input').on('input', function(){
        let value = $(this).val();
        localStorage['bgImgFilter'] = value;
        updateBgFilter();
    });
});

var needToPinMotor = false; // Pour savoir si on veux épingler un moteur ou pas

function resizeEvent()
{
	if(isBodyWidthLess1000px()) // Si la largeur de l'écran est inferieur à 1000px
	{
		$('#colorSelector, #editBgImg, article').hide();
        $('.navig').removeClass('fixedNav');
        $('.navig').css('display','block');
        $('.page > .ctn').removeClass('fixedCtn');
        
		if(currentViews.length>0)
        {
            for(let i=0; i<currentViews.length; i++)
                $(currentViews[i]).css('display','block');
        }
        if(currentViews.length>1)
            $('.navig').hide();
	}
    else
    {
        $('article').show();
        $('.navig, .page .ctn').css('display','inline-block');
        currentViews = [];
    }
}

function scrollEvent()
{
	if(!isBodyWidthLess1000px())
	{
		if(document.body.scrollTop > 80 || document.documentElement.scrollTop > 80)
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
        localStorage.removeItem('bgImgFilter');
        localStorage.removeItem("backgroundColor");
        localStorage.removeItem("accentColor");

        // Affichage
        localStorage.removeItem("display");
        localStorage.removeItem("format");
        localStorage.removeItem("searchOn");

        // Numero de version de Doosearch utilisé
        localStorage.removeItem("doosearchVersion");

        // Redirection
        document.location.href='setup.php';
    }
}

function showEditor(editor)
{
    $('#editBgImg').slideUp();
    $('#editBgForm').slideUp();
    $('#editBgList').slideUp();
	
	if($(editor).css('display')=='none')
	{
		currentViews.push(editor);
        $(editor).slideDown();
	}
	else
		currentViews.pop();
}

function importImage()
{
    var imgUrl = prompt("Entrez l'adresse URL du fond d'écran");
    
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

function updateBgFilter()
{
    if(localStorage['bgImg'] != '')
    {
        let value = localStorage['bgImgFilter'];
        if(value>0)
            $('#filter').css('background', 'rgba(0,0,0,'+(value/100)+')');
        else
            $('#filter').css('background', 'rgba(255,255,255,'+(Math.abs(value)/100)+')');
    }
    else
        $('#filter').css('background', 'transparent');
}

function resetBgFilter()
{
    localStorage['bgImgFilter'] = '';
    $('.slider input').val(0);
    updateBgFilter();
}

function updatePinnedMotors()
{
    $('#3 .pinned').html('<li style="display: none;"><img src="res/img/choose.png" /><p>Lorem ipsum</p></li>');
    
    var j = 0;
    for(j;j<pinnedMotors.length;j++)
    {
        if(pinnedMotors[j]!='')
            $('<li><img src="' + pinnedMotors[j].icon + '" /><p>' + pinnedMotors[j].title + '<span> <button onclick="removeMotor('+j+');" title="Supprimer"><img src="res/img/close.png" /></button></span></p></li>').insertAfter('#3 .pinned li:last-child');
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
            $('<li><img src="' + pinnedWebsites[k].icon + '" /><p>' + pinnedWebsites[k].title + '<span> <button onclick="removeWebsite('+k+');" title="Supprimer"><img src="res/img/close.png" /></button></span></p></li>').insertAfter('#4 .pinned li:last-child');
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

        if(localStorage['searchEngine-prefix']=='')
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
    updateBgFilter();
}

function setBgImg(imgUrl)
{
	var localName = 'bgImg';
	
	// Saving
	localStorage[localName] = imgUrl;
	
	// Preview
    updateBgFilter();
	$('#previewBgImg input').css('background-image','url(' + localStorage[localName] + ')');
	$('body').css('background','url(' + localStorage[localName] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
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
        $('.searchBar input').focus();
        
        $('body').css('overflow','hidden');
	}
}

function setSearchEngine(id)
{
    var item = listSearchEngines[id];
    
    if(!needToPinMotor)
    {
        // Setting default search engine
        localStorage['searchEngine-prefix'] = item.urlPrefix;
        localStorage['searchEngine-suffix'] = item.urlSuffix;
        localStorage['searchEngine-title'] = item.title;
        localStorage['searchEngine-icon'] = item.icon;

        updateSearchEngineView(); // Update view
    }
    else
        setPinnedMotor(item);
    
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
    if(confirm('Voulez-vous vraiment supprimer le site "' + pinnedWebsites[id].title + '" de votre accès rapide ?'))
    {
        pinnedWebsites.splice(id, 1);
        updatePinnedWebsite();
	    localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
    }
}

function setViewMode(radioName)
{
	var value = $('input[name=' + radioName + ']:checked').attr('id');
	
	if(radioName=='forme')
		localStorage['format'] = value;
	if(radioName=='lancementRecherche')
		localStorage['searchOn'] = value;
	if(radioName=='contrast')
    {
		localStorage['contrast'] = value;
        updateContrast();
    }
}

function showArticle(show)
{
	if(isBodyWidthLess1000px())
	{
		if(show == true)
		{
			$('.page .navig').css('display','none');
			$('.page .ctn').css('display','block');
			$('#titleBar img').css('display','inline-block');
		}
		else
		{
			$('.page .navig').css('display','block');
			$('.page .ctn, #titleBar img').css('display','none');
			$('#titleBar h2').html('Configuration');
		}
	}
}

function setPinnedMotor(motor)
{
    var isAlready=false;

    for(let i=0;i<pinnedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà épinglé
    {
        if(pinnedMotors[i].title==motor.title)
            isAlready = true;
    }
    if(isAlready)
        alert('Déjà épinglé');
    else if(!isAlready && motor.urlPrefix=='')
        alert('Cet icône ne peut pas être épinglé');
    else if(!isAlready && motor.urlPrefix!='')
    {
        pinnedMotors.push(motor);
        localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);

        let button = $('<li/>');
        button.click(function(){setSearchEngine(motor);});
        button.append($('<img/>').attr('src',motor.icon));
        $('.toolBar .pinned').append(button);
    }

    needToPinMotor = false;
    updatePinnedMotors();
}