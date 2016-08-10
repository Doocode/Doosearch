
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
	if($('.panel').css('display')=='block') // Si on veut cacher la liste des moteurs (si elle est visible)
	{
		$('.panel').fadeOut();
		motorChanged = false;
        needToAddSelectedMotor = false;
        changeSelectedMotor.isNeeded = false;
	}
	else
	{
		$('.panel').fadeIn();
		
		if(isBodyWidthLess1000px())
			resizePanel(true);
	}
}

function setMotor(first,last,icon,title) // Choisir un moteur
{
	if(needToPinMotor == false && needToAddSelectedMotor == false && changeSelectedMotor.isNeeded == false) // Si on ne veut pas épingler/remplacer un moteur ni selectionner plusieurs moteurs
	    setSelectedMotor(first,last,icon,title);
	else if(needToPinMotor == true) // Si on veut épingler un moteur
        setPinnedMotor(first,last,icon,title);
    else if(needToAddSelectedMotor == true) // Si on veut ajouter un moteur de recherche pour la recherche groupé
        addNewSelectedMotor(first,last,icon,title);
    else if(changeSelectedMotor.isNeeded == true) // Si on veut remplacer un moteur de recherche pour la recherche groupé
        changeSelectedMotorTo(first,last,icon,title);

    if($('.panel').css('display')=='block') // Si la liste des moteurs est visible
        showMotors(); // Cacher la liste
}

$('#field').keydown(function(e){
	if(e.which == 13 || e.which == 10) // Si la touche "Entrer" est appuyée
		validateForm();
});

function validateForm() // Valider le formulaire
{
    if((selectedMotors.length==1 && selectedMotors[0].first=='') || selectedMotors.length==0) // Si aucun moteur à été choisi
	{
		motorChanged = true;
		showMotors();
	}
	else if(selectedMotors.length==1 && selectedMotors[0].first!='') // Si un seul moteur à été défini
	{
		var query = $('#field').val(); // On récupère le champ de texte
		var url = selectedMotors[0].first + query + selectedMotors[0].last; // On génère l'url
		
        if(localStorage['searchOn'] == 'currentTab') // Si l'utilisateur veut que la recherche se lance sur la page actuelle
            document.location.href=url;
        else if(localStorage['searchOn'] == 'newTab') // Si l'utilisateur veut que la recherche se lance dans une nouvelle page
            window.open(url, '_blank');
	}
	else if(selectedMotors.length>1) // Si plusieurs moteurs ont été définis
    {
        var i=0, query = $('#field').val(); // On récupère le champ de texte
        for(i;i<selectedMotors.length;i++)
        {
            var url = selectedMotors[i].first + query + selectedMotors[i].last; // On génère l'url
            window.open(url, '_blank'); // On ouvre chaque url dans une nouvelle page
        }
        
        if(localStorage['searchOn'] == 'currentTab') // Si l'utilisateur voulais que la recherche se lance sur la page actuelle
        {
            window.open('','_parent','');
            window.close(); // On ferme cette page vu qu'elle ne sert plus à rien
        }
    }
}

function loadConfig() // Cette fonction est appelé après le chargement de la page
{
	if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.31) // Si aucun paramètre à été défini ou si on a utilisé une ancienne version
		document.location.href='index.php'; // Retourner vers l'accueil
	else // Si des paramètres existent, charger les configs
	{
        // On affiche l'application et on lance quelques animations
		$('.selectedMotors').addClass('animated tada');
		$('.clock').addClass('animated rubberBand');
		$('#form').addClass('animated bounceIn');
		$('#appFind .toolBar').addClass('animated fadeInDown');
		$('#appFind #form,#appFind .toolBar,.clock').css('display','block');
		$('.selectedMotors,#appFind #form').css('display','inline-block');
		$('.redirect').css('display','none');
		
		if(localStorage.getItem("firstUrl") != '') // Si on a défini un moteur de recherche par défaut
		{
            // On récupère dans le localStorage les paramètres du moteur
            var motor = {
				icon: localStorage['logoMotor'],
				title: localStorage['titleMotor'],
				first: localStorage['firstUrl'],
				last: localStorage['lastUrl']
			};
	
			selectedMotors.push(motor); // Puis on l'ajoute dans la liste des moteurs séléctionné
		}
        
        updateTime(); // Lancement de l'horloge
        updateSelectedMotors(); // Affichage des moteurs séléctionnés
        updatePinnedMotors(); // Affichage des moteurs épinglés
		
		//Changer les couleurs
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
		
		// On met le focus sur la barre de recherche
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
    
    // HELLO
    if(today.getHours() >= 6 && today.getHours() < 12)
	   $('.clock #hello').html('Bonjour');
    else if(today.getHours() == 12)
	   $('.clock #hello').html('Miam !');
    else if(today.getHours() > 12 || today.getHours() < 18)
	   $('.clock #hello').html('Bon aprèm');
    else if(today.getHours() == 0)
	   $('.clock #hello').html('ZZZzzzz...');
    else
	   $('.clock #hello').html('Bonsoir');

	setTimeout(updateTime, 1000);
}