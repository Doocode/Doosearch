var currentScreen = 1;
$('.toolBar').css('display','block');
$('.toolBar').addClass('animated fadeInDown');

$( window ).resize(function()
{
	if(parseInt($('body').css('width').split("px").join(""))<1000)
	{
		if($('.screenView').css('display')!='block')
			hideScreen();
	}
});

function showTooltip(text) // Afficher les bulles d'infos
{
	if(text=='')
		$('.toolBar p').css('display','none');
	else
	{
		$('.toolBar p').css('display','inline-block');
		$('.toolBar p').html(text);
	}
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
	if($('.listMotors').css('display')=='none')
	{
		$('.listMotors').css('display','block');
		$('.quitListMotors').css('display','block');
	}
	else
	{
		$('.listMotors').css('display','none');
		$('.quitListMotors').css('display','none');
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

function setMotor(first,last,icon,title)
{
	// Set the view
	$('#imgMotor div').css('background','url('+icon+') no-repeat center center / cover');
	if(title!='')
		$('#imgMotor span').html(title);
	else
		$('#imgMotor span').html('Aucun');
	
	// Fill the form
	$('#editFirst').attr('value',first);
	$('#editLast').attr('value',last);
	$('#editImg').attr('value',icon);
	$('#editTitle').attr('value',title);
	
	showMotors();
}

function saveSettings()
{
	localStorage['firstUrl'] = $('#editFirst').attr('value');
	localStorage['lastUrl'] = $('#editLast').attr('value');
	localStorage['logoMotor'] = $('#editImg').attr('value');
	localStorage['titleMotor'] = $('#editTitle').attr('value');
	
	localStorage['bgColorForm'] = 'rgb(40,200,40)';
	localStorage['bgColorList'] = 'rgb(0,120,200)';
	
	localStorage['display'] = 'sideScreen';
	localStorage['format'] = 'icones';
	localStorage['searchOn'] = 'currentTab';
	
	localStorage['doosearchVersion'] = 1.3;
	
	var pinnedMotors = [];
	localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
	var pinnedWebsites = [];
	localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
	
	document.location.href='home.php';
}

$(document).keyup(function(e)
{
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