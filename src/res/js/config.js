var pinnedMotors, formColor, listColor, currentViews = [], bgImg;

$(function()
{
    $('#configPage').addClass('selected');
    
    // Chargement des paramètres de l'utilisateur
    // Moteur par défaut
    updateSearchEngineView();

    // Pinned
    pinnedMotors = JSON.parse(localStorage['pinnedMotors']);
    pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']);
    bgImgGallery = JSON.parse(localStorage['bgImgGallery']);
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
	Doosearch.lang.setModule('configuration');
    if(confirm(Doosearch.lang.getText('really_want_to_continue')))
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
        localStorage.removeItem("contrast");
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
	Doosearch.lang.setModule('configuration');
    var imgUrl = prompt(Doosearch.lang.getText('enter_the_url_of_the_wallpaper'));
    
    if(imgUrl.substr(0,7) == 'http://' || imgUrl.substr(0,8) == 'https://')
    {
        bgImgGallery.push(imgUrl);
        localStorage['bgImgGallery'] = JSON.stringify(bgImgGallery);

        updateBgGallery();
        
        setBgImg(imgUrl);
    }
    else
        alert(Doosearch.lang.getText('invalid_address'));
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
    $('#3 .pinned').html('');
	Doosearch.lang.setModule('configuration');
    
    for(let i=0; i<pinnedMotors.length; i++)
    {
        let engine = pinnedMotors[i];
        if(engine != '')
        {
            let li     = $('<li/>');
            let img    = $('<img/>').attr('src', engine.icon);
            let button = $('<button/>');
            button.attr('title', Doosearch.lang.getText('remove', 'Remove', updatePinnedMotors));
            button.append($('<img/>').attr('src', 'res/img/close.png'));
            button.click(function(){
                removeMotor(i);
            });
            let span = $('<span/>').append(button);
            let p    = $('<p/>').html(engine.title);
            p.append(span);
            li.append(img).append(p);
            
            $('#3 .pinned').append(li);      
        }
    }
    if(pinnedMotors.length==0)
    {
        let li = $('<li/>');
        li.css({
            'cursor': 'default',
            'background': 'transparent',
            'border': 'none',
            'padding': '0',
            'box-shadow': 'none'
        });
        let p = $('<p/>');
        p.css({
            'margin': '0 5px',
            'color': '#000'
        });
        p.html(Doosearch.lang.getText('no_search_engine_pinned', 'No pinned search engine', updatePinnedMotors));
        li.append(p);
        $('#3 .pinned').append(li);
    }
}

function updatePinnedWebsite()
{
	Doosearch.lang.setModule('configuration');
    $('#4 .pinned').html('');
        
    for(let i=0; i<pinnedWebsites.length; i++)
    {
        let website = pinnedWebsites[i];
        if(website != '')
        {
            let li     = $('<li/>');
            let img    = $('<img/>').attr('src', website.icon);
            let button = $('<button/>');
            button.attr('title', Doosearch.lang.getText('remove', 'Remove', updatePinnedWebsite));
            button.append($('<img/>').attr('src', 'res/img/close.png'));
            button.click(function(){
                removeWebsite(i);
            });
            let span = $('<span/>').append(button);
            let p    = $('<p/>').html(website.title);
            p.append(span);
            li.append(img).append(p);
            
            $('#4 .pinned').append(li);      
        }
    }
    if(pinnedWebsites.length==0)
    {
        let li = $('<li/>');
        li.css({
            'cursor': 'default',
            'background': 'transparent',
            'border': 'none',
            'padding': 0,
            'box-shadow': 'none'
        });
        let p = $('<p/>');
        p.css({
            'margin': '0 5px',
            'color': '#000'
        });
        p.html(Doosearch.lang.getText('no_website_pinned', 'No pinned website', updatePinnedWebsite));
        li.append(p);
        $('#4 .pinned').append(li);
    }
}

function updateSearchEngineView()
{
	Doosearch.lang.setModule('configuration');
    if(localStorage['searchEngine-icon']!='')
    {
        $('.selectMotor img').attr('src',localStorage['searchEngine-icon']);
        $('.selectMotor h4').html(localStorage['searchEngine-title']);
        $('.selectMotor p').html(localStorage['searchEngine-prefix'] + 
								 '<span>' + 
								 	Doosearch.lang.getText('your_query', 'your-query-will-be-here', updateSearchEngineView) + 
								 '</span>' + 
								 localStorage['searchEngine-suffix']);

        if(localStorage['searchEngine-prefix']=='')
        {
            $('.selectMotor h4').html(Doosearch.lang.getText('no_search_engine', 'No search engine', updateSearchEngineView));
            $('.selectMotor p').html(Doosearch.lang.getText('no_search_engine_text', 'You will be asked to select a search engine to launch a query.', updateSearchEngineView));
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
		loadSearchEngines();
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
	Doosearch.lang.setModule('pinned_search_engines');
    let message = Doosearch.lang.getText('remove_the_search_engine_from_favorite');
    message = message.replace('%search_engine%',pinnedMotors[id].title);
    
    if(confirm(message))
    {
        pinnedMotors.splice(id, 1);
        updatePinnedMotors();
	    localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
    }
}

function removeWebsite(id)
{
	Doosearch.lang.setModule('quick_access');
    let message = Doosearch.lang.getText('remove_the_website_from_favorite');
    message = message.replace('%website%',pinnedWebsites[id].title);
    
    if(confirm(message))
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
	Doosearch.lang.setModule('pinned_search_engines');
    var isAlready=false;

    for(let i=0;i<pinnedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà épinglé
    {
        if(pinnedMotors[i].title==motor.title)
            isAlready = true;
    }
    if(isAlready)
        alert(Doosearch.lang.getText('already_pinned'));
    else if(!isAlready && motor.urlPrefix=='')
        alert(Doosearch.lang.getText('icon_cannot_be_pinned'));
    else if(!isAlready && motor.urlPrefix!='')
    {
        pinnedMotors.push(motor);
        localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
    }

    needToPinMotor = false;
    updatePinnedMotors();
}