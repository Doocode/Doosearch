// On récupère les paramètres dans le localStorage
// Ici, on prend l'adresse url du moteur de recherche défini
var m_first = localStorage['firstUrl'];
var m_last = localStorage['lastUrl'];
// Puis le logo
var m_logo = localStorage['logoMotor'];
// Et enfin le nom du moteur
var m_title = localStorage['titleMotor'];

// Dans le cas des utilisateurs qui n'ont pas défini un moteur, on va s'assurer qu'il vont selectionner un avant de rechercher
var motorChanged = false;
var setPinnedMotor = false; // Pour savoir si on veux épingler un moteur ou pas
var pinnedMotors = JSON.parse(localStorage['pinnedMotors']); // Récuperation de la liste des moteurs épinglé

updateTime(); // Lancement de l'horloge
updatePinnedMotors(); // Affichage des moteurs épinglés

function resizeEvent() // Si la fenêtre est redimensionnée
{
	if(isBodyWidthLess1000px()) // Si la largeur de l'écran < 1000px (fonction dans le fichier header.js)
	{
		resizePanel(true); // Redimensionner la liste des moteurs
	}
	else // Sinon si la largeur de l'écran (body.width) > 1000px
	{
        // Affichage en plein écran ou en petite fenêtre
		if(localStorage['display']=='fullScreen')
			resizePanel(true);
		else if(localStorage['display']=='sideScreen')
			resizePanel(false);
	}
}

$('.listMotors').contextmenu(function(e) // Afficher ou cacher le menu contextuel (clic droit sur la liste)
{
	//alert(e.target.tagName);
	//alert($(e.target).html());
	if(!isBodyWidthLess1000px()) // Si la largeur de l'écran > 1000px
	{
        // Déplacer le menu vers la position du clic
		$('.contextMenu').css('left',e.pageX);
		$('.contextMenu').css('top',e.pageY);
        
        // Dérouler le menu
		$('.contextMenu').slideDown(250);
        
        // Rendre transparent la liste des moteurs
		$('.listMotors ul').css('opacity','0.3');
        
        // Retourner false pour que le navigateur n'affiche pas son propre menu contextuel
		return false;
	}
	else
		return true;
});

$('body').click(function(e) // Lors du clic sur la page (n'importe où)
{
	$('.contextMenu').slideUp(250); // Fermer le menu du clic droit de Doosearch
	$('.listMotors ul').css('opacity','1'); // Remettre l'opacité de la liste des moteurs en normal
    
	if($('.family').css('right')=='0px') // Si le menu "Doocode Family" est visible
		$('.family').css('right','-100%'); // Masquer le menu
	
	return true;
});

function scrollEvent() // Lorsqu'on scrolle
{
	if(!isBodyWidthLess1000px()) // Si la largeur de la fenêtre est superieur à 1000px
	{
		if(document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)
		{
			$('#speedDial .form').css('display', 'block');
		}
		else
		{
			$('#speedDial .form').css('display', 'none');
		}
	}
}

function showMotors()
{
	if($('.panel').css('display')=='block')
	{
		$('.panel').fadeOut();
		motorChanged = false;
	}
	else
	{
		$('.panel').fadeIn();
		
		if(isBodyWidthLess1000px())
			resizePanel(true);
	}
}

function addPinnedMotors()
{
	setPinnedMotor = true;
	showMotors();
}

function setMotor(first,last,icon,title) // Choisir un moteur
{
	if(setPinnedMotor == false) // Si on ne veut pas épingler de moteur
	{
		m_first = first;
		m_last = last;
		m_logo = icon;
		m_title = title;
		
		$('#appFind .logo').attr('src',icon); // Afficher le logo du moteur
		
		if(title!='') // Si le titre du moteur de recherche n'est pas vide
			$('#field').attr('placeholder','Rechercher sur ' + title);
		else
			$('#field').attr('placeholder','Tapez votre requete ici');
		
        if($('.panel').css('display')=='block') // Si la liste des moteurs est visible
            showMotors(); // Cacher la liste
		
		if(motorChanged) // Si on viens de cliquer sur "Rechercher" ou taper "Entrer"
			validateForm(); // Valider le formulaire
	}
	else // Si on veut épingler un moteur
	{
		var i=0,isAlready=false;
		
		for(i;i<pinnedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà épinglé
		{
			if(pinnedMotors[i].title==title)
				isAlready = true;
		}
		if(isAlready)
		{
			alert('Déjà épinglé');
		}
		if(!isAlready)
		{
			var motor = {
				icon: icon,
				title: title,
				first: first,
				last: last
			};
	
			pinnedMotors.push(motor);
			localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);
			
			$('<li onclick="setMotor(\'' + motor.first + '\',\'' + motor.last + '\',\'' + motor.icon + '\',\'' + motor.title + '\');" onmouseover="showTooltip(\'' + motor.title + '\');" onmouseout="showTooltip(\'\');"><img src="' + motor.icon + '" /></li>').insertAfter('.toolBar .pinned li:last-child');
		}
		showMotors();
		
		setPinnedMotor = false;
	}
}

$('#field').keydown(function(e){
	if(e.which == 13 || e.which == 10) // Si la touche "Entrer" est appuyée
		validateForm();
});

function validateForm() // Valider le formulaire
{
	if(m_first=='') // Si aucun moteur à été choisi
	{
		motorChanged = true;
		showMotors();
	}
	else // Si un moteur à été défini
	{
		var query = $('#field').val();
		var url = m_first + query + m_last; // Générer l'url
		
		document.location.href=url; // Redirection vers l'url généré
	}
}

function itsOK() // Cette fonction est appelé au chargement de la page
{
	if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.3) // Si aucun paramètre à été défini ou si on a utilisé une ancienne version
		document.location.href='index.php'; // Retourner vers l'accueil
	else // Si des paramètres existent, charger les configs
	{
		$('#appFind .logo').addClass('animated rotateIn');
		$('#appFind .toolBar').addClass('animated fadeInDown');
		$('#appFind .clock').addClass('animated zoomIn');
		$('#appFind .logo,#appFind #form,#appFind .toolBar').css('display','block');
		//$('#head .ctn a img').attr('src','res/img/favicon.png');
		$('.redirect').css('display','none');
		
		if(localStorage.getItem("firstUrl") != '')
		{
			$('#appFind .logo').attr('src',m_logo);
			$('#field').attr('placeholder','Rechercher sur ' + m_title);
		}
		
		//Changer les couleurs
		//$('body').css('background',localStorage['bgColorForm']);
		$('.listMotors').css('background',localStorage.getItem("bgColorList"));
		$('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['bgColorForm']);
		$('#add').css('background',localStorage['bgColorForm']);
		$('#appFind #form button:last-child,#search').css('background',localStorage.getItem("bgColorList"));
		
		// Affichage de la liste
		if(localStorage['display']=='fullScreen')
			resizePanel(true);
		else if(localStorage['display']=='sideScreen')
			resizePanel(false);
		if(localStorage['format']=='icones')
			showAsList(false);
		else if(localStorage['format']=='liste')
			showAsList(true);
		
		// Finish
		$('#field').focus();
	}
}

function resizePanel(resize) // Pour redimensionner la liste de moteurs
{
	if(resize==true) // Si on veut l'afficher en plein écran
	{
		$('.listMotors').css('right','50px');
		$('.listMotors').css('top','5px');
		$('.listMotors').css('width','initial');
		$('.listMotors').css('height','initial');
		$('#fullScreen').addClass('checked');
		$('#sideScreen').removeClass('checked');
	}
	else // Si on veut l'afficher sur le côté
	{
		$('.listMotors').css('right','initial');
		$('.listMotors').css('top','initial');
		$('.listMotors').css('width','375px');
		$('.listMotors').css('height','500px');
		$('#fullScreen').removeClass('checked');
		$('#sideScreen').addClass('checked');
	}
}

function showAsList(show) // Pour afficher la liste de moteur sous forme de liste ou d'icônes
{
	if(show==true) // Si on veut l'afficher sous forme de liste
	{
		$('.listMotors').addClass('list');
		$('#liste').addClass('checked');
		$('#icones').removeClass('checked');
	}
	else // Si on veut l'afficher sous forme d'icônes
	{
		$('.listMotors').removeClass('list');
		$('#liste').removeClass('checked');
		$('#icones').addClass('checked');
	}
}

function showFolder(folderId) // Pour afficher des moteurs "cachés"
{
	if($(folderId).css('display') == 'none')
		$(folderId).fadeIn();
	else
		$(folderId).fadeOut();
}

function showTooltip(text) // Afficher les bulles d'infos
{
	if(text=='')
		$('#appFind .toolBar p').css('display','none');
	else
	{
		$('#appFind .toolBar p').css('display','inline-block');
		$('#appFind .toolBar p').html(text);
	}
}

function updatePinnedMotors()
{
	var i=0;
	for(i;i<pinnedMotors.length;i++)
	{
		$('<li onclick="setMotor(\'' + pinnedMotors[i].first + '\',\'' + pinnedMotors[i].last + '\',\'' + pinnedMotors[i].icon + '\',\'' + pinnedMotors[i].title + '\');" onmouseover="showTooltip(\'' + pinnedMotors[i].title + '\');" onmouseout="showTooltip(\'\');"><img src="' + pinnedMotors[i].icon + '" /></li>').insertAfter('.toolBar .pinned li:last-child');
	}
}

function showTime() // Afficher l'heure en plein écran
{
	if($('.clock').css('left')=='0px')
		$('.clock').removeClass('fullScreen');
	else
		$('.clock').addClass('fullScreen');
}

function updateTime() // Pour mettre à jour la date et heure affichée
{
	var today = new Date;
	
	// HEURES
	var hours = today.getHours();
	var minutes = today.getMinutes();

	if(hours < 10) // Si l'hours est compris entre 0 et 9
		hours = '0'+today.getHours(); // On rajoute un '0' au début : 07
	if(minutes < 10) // De même pour les minutes
		minutes = '0'+today.getMinutes(); // Même opération

	var hours = hours + ':' + minutes; // L'heure au format 00:00
	
	$('.clock h1').html(hours);
	
	// DATE
	var day = today.getDay();
	var dayNum = today.getDate();
	var month = today.getMonth();
	var year = today.getFullYear();
	
	if(day == 0) {day = 'Dimanche';}
	else if(day == 1) {day = 'Lundi';}
	else if(day == 2) {day = 'Mardi';}
	else if(day == 3) {day = 'Mercredi';}
	else if(day == 4) {day = 'Jeudi';}
	else if(day == 5) {day = 'Vendredi';}
	else if(day == 6) {day = 'Samedi';}
	
	if(dayNum == 1) {dayNum = '1er';}
	
	if(month == 0) {month = 'Janvier';}
	else if(month == 1) {month = 'Fevrier';}
	else if(month == 2) {month = 'Mars';}
	else if(month == 3) {month = 'Avril';}
	else if(month == 4) {month = 'Mai';}
	else if(month == 5) {month = 'Juin';}
	else if(month == 6) {month = 'Juillet';}
	else if(month == 7) {month = 'Août';}
	else if(month == 8) {month = 'Septembre';}
	else if(month == 9) {month = 'Octobre';}
	else if(month == 10) {month = 'Novembre';}
	else if(month == 11) {month = 'Décembre';}
	
	var currentDate = day + ' ' + dayNum + ' ' + month + ' ' + year;
	
	$('.clock #date').html(currentDate);

	setTimeout(updateTime, 1000);
}