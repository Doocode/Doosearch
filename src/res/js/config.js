//Motors
if(localStorage['logoMotor']!='')
{
	$('.selectMotor img').attr('src',localStorage['logoMotor']);
	$('.selectMotor h4').html(localStorage['titleMotor']);
	$('.selectMotor p').html(localStorage['firstUrl'] + '<span>votre recherche</span>' + localStorage['lastUrl']);
	
	if(localStorage['titleMotor']=='')
	{
		$('.selectMotor h4').html('Aucun moteur');
		$('.selectMotor p').html('Il vous sera demandé de selectionner un moteur de recherche pour lancer une requete');
	}
}

// Pinned
var pinnedMotors = JSON.parse(localStorage['pinnedMotors']), j = 0;
for(j;j<pinnedMotors.length;j++)
{
	if(pinnedMotors[j]!='')
		$('<li><img src="' + pinnedMotors[j].icon + '" /><p>' + pinnedMotors[j].title + '</p></li>').insertAfter('#3 .pinned li:last-child');
}
if(pinnedMotors.length==0)
	$('<li style="cursor: default; background: transparent; border: none; padding: 0px; box-shadow: none;"><p style="margin: 0px 5px; color: #000;">Aucun moteur de recherche épinglé</p></li>').insertAfter('#3 .pinned li:last-child');

var pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']), k = 0;
for(k;k<pinnedWebsites.length;k++)
{
	if(pinnedWebsites[k]!='')
		$('<li><img src="' + pinnedWebsites[k].icon + '" /><p>' + pinnedWebsites[k].title + '</p></li>').insertAfter('#4 .pinned li:last-child');
}
if(pinnedWebsites.length==0)
	$('<li style="cursor: default; background: transparent; border: none; padding: 0px; box-shadow: none;"><p style="margin: 0px 5px; color: #000;">Aucun site épinglé</p></li>').insertAfter('#4 .pinned li:last-child');

//Colors
$('#editBgForm .viewer').css('background',localStorage['bgColorForm']);
$('#editBgList .viewer').css('background',localStorage['bgColorList']);
$('#previewBgForm input').css('background',localStorage['bgColorForm']);
$('#previewBgList input').css('background',localStorage['bgColorList']);
var formColor = getColors(localStorage['bgColorForm']);
$('#editBgForm .red input').val(formColor[0]);
$('#editBgForm .green input').val(formColor[1]);
$('#editBgForm .blue input').val(formColor[2]);
var listColor = getColors(localStorage['bgColorList']);
$('#editBgList .red input').val(listColor[0]);
$('#editBgList .green input').val(listColor[1]);
$('#editBgList .blue input').val(listColor[2]);
var currentView;
$('body').css('background-color',localStorage['bgColorForm']);
$('.navig').css('background',localStorage['bgColorList']);

var bgImg = 'res/img/bgs/empty.png';
if(localStorage['bgImg'] != '' || localStorage['bgImg'] == null)
    bgImg = localStorage['bgImg'];

$('#editBgImg .viewer').css('background-image','url(' + bgImg + ')');
$('#previewBgImg input').css('background-image','url(' + bgImg + ')');
$('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['bgColorForm']);
$('#editBgImg input').val(localStorage['bgImg']);

//ViewLight
$('#' + localStorage['display']).attr('checked','checked');
$('#' + localStorage['format']).attr('checked','checked');
$('#' + localStorage['searchOn']).attr('checked','checked');

$('body').click(function(e)
{
	spinClick = false;/*
	$('#editBgImg').slideUp();
	$('#editBgForm').slideUp();
	if($('#editBgList').css('display')=='block')
		$('#editBgList').slideUp();*/
	
	return true;
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
	// Moteurs de recherche
	localStorage.removeItem("firstUrl");
	localStorage.removeItem("lastUrl");
	localStorage.removeItem("logoMotor");
	localStorage.removeItem("titleMotor");
	
	// Moteurs et sites épinglés
	localStorage.removeItem("pinnedMotors");
	localStorage.removeItem("pinnedWebsites");
	
	// Themes
	localStorage.removeItem("bgImg");
	localStorage.removeItem("bgColorForm");
	localStorage.removeItem("bgColorList");
	
	// Affichage
	localStorage.removeItem("display");
	
	// Numero de version de Doosearch utilisé
	localStorage.removeItem("doosearchVersion");
	
	// Redirection
	document.location.href='index.php';
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

function getColors(color)
{
	var rgbColor = color.replace('rgb(','');
	rgbColor = rgbColor.replace(')','');
	return rgbColor.split(',');
}

function updateColor(object)
{
	var newColor, r, g, b, editor, preview, localName;
	if(object=='bgForm')
	{
		editor = '#editBgForm';
		preview = '#previewBgForm';
		localName = 'bgColorForm';
	}
	else if(object=='bgList')
	{
		editor = '#editBgList';
		preview = '#previewBgList';
		localName = 'bgColorList';
	}
	
	r = $(editor + ' .red input').val();
	g = $(editor + ' .green input').val();
	b = $(editor + ' .blue input').val();
	
	newColor = 'rgb(' + r + ',' + g + ',' + b + ')';
	
	// Saving
	localStorage[localName] = newColor;
	
	// Preview
	$(editor+' .viewer').css('background',localStorage[localName]);
	$(preview+' input').css('background',localStorage[localName]);
	
	$('body').css('background-color',localStorage['bgColorForm']);
	$('.navig').css('background',localStorage['bgColorList']);
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
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['bgColorForm']);
    $('#editBgImg input').val(localStorage['bgImg']);
}

function resetBgImg()
{
	// Saving
	localStorage['bgImg'] = '';
	
    // Update views
    bgImg = 'res/img/bgs/empty.png';
    $('#editBgImg .viewer').css('background-image','url(' + bgImg + ')');
    $('#previewBgImg input').css('background-image','url(' + bgImg + ')');
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['bgColorForm']);
    $('#editBgImg input').val(localStorage['bgImg']);
}

function setColor(object,color)
{
	var localName,editor,preview;
	if(object=='bgForm')
	{
		editor = '#editBgForm';
		preview = '#previewBgForm';
		localName = 'bgColorForm';
	}
	else if(object=='bgList')
	{
		editor = '#editBgList';
		preview = '#previewBgList';
		localName = 'bgColorList';
	}
	
	// Saving
	localStorage[localName] = color;
	
	// Preview
	$(editor+' .viewer').css('background',localStorage[localName]);
	$(preview+' input').css('background',localStorage[localName]);
	
	$('body').css('background-color',localStorage['bgColorForm']);
	$('.navig').css('background',localStorage['bgColorList']);
	
	var arrayColor = getColors(color);
	$(editor+' .red input').val(arrayColor[0]);
	$(editor+' .green input').val(arrayColor[1]);
	$(editor+' .blue input').val(arrayColor[2]);
}

function setBgImg(imgUrl)
{
	var localName,editor,preview;
	editor = '#editBgImg';
	preview = '#previewBgImg';
	localName = 'bgImg';
	
	// Saving
	localStorage[localName] = imgUrl;
	
	// Preview
	$(editor+' .viewer').css('background-image','url(' + localStorage[localName] + ')');
	$(preview+' input').css('background-image','url(' + localStorage[localName] + ')');
	
	$('body').css('background','url(' + localStorage[localName] + ') no-repeat fixed center center / cover,' + localStorage['bgColorForm']);
	
	$(editor+' input').val(localStorage[localName]);
}

function showMotors()
{
	if($('.motors').css('display')=='none')
	{
		$('.motors').css('display','block');
		$('body').css('overflow','hidden');
	}
	else
	{
		$('.motors').css('display','none');
		$('body').css('overflow','auto');
	}
}

function setMotor(first,last,icon,title)
{
	// Setting motors
	localStorage['firstUrl'] = first;
	localStorage['lastUrl'] = last;
	localStorage['logoMotor'] = icon;
	localStorage['titleMotor'] = title;
	
	// Show new motor
	/*$('.selectMotor img').attr('src',localStorage['logoMotor']);
	
	if(title!='')
		$('.selectMotor span').html(localStorage['titleMotor']);
	else
		$('.selectMotor span').html('Aucun moteur');*/
	
	$('.selectMotor img').attr('src',localStorage['logoMotor']);
	$('.selectMotor h4').html(localStorage['titleMotor']);
	$('.selectMotor p').html(localStorage['firstUrl'] + '<span>votre recherche</span>' + localStorage['lastUrl']);
	
	if(localStorage['titleMotor']=='')
	{
		$('.selectMotor h4').html('Aucun moteur');
		$('.selectMotor p').html('Il vous sera demandé de selectionner un moteur de recherche pour lancer une requete');
	}
	
	showMotors();
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