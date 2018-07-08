$(function() { // Cette fonction est appelé après le chargement de la page
	if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.31) // Si aucun paramètre à été défini ou si on a utilisé une ancienne version
		document.location.href='index.php'; // Retourner vers l'accueil
	else // Si des paramètres existent, charger les configs
	{
        // On affiche les éléments de l'interface de l'application
		$('#appFind #form,#appFind .toolBar').css('display','block');
		$('.selectedMotors,#appFind #form').css('display','inline-block');
		
		if(localStorage.getItem("searchEngine-prefix") != '') // Si on a défini un moteur de recherche par défaut
		{
            // On récupère dans le localStorage les paramètres du moteur
            var motor = new SearchEngine(localStorage['searchEngine-title'], 
                                         localStorage['searchEngine-icon'], 
                                         localStorage['searchEngine-prefix'], 
                                         localStorage['searchEngine-suffix']);

			selectedMotors.push(motor); // Puis on l'ajoute dans la liste des moteurs séléctionné
		}
        
        updateListSearchEngine(); // Affichage des moteurs disponibles
        updateSelectedMotors(); // Affichage des moteurs séléctionnés
        updatePinnedMotors(); // Affichage des moteurs épinglés
		
		//Charger les couleurs
		$('.listMotors').css('background',localStorage.getItem("accentColor"));
		$('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
		$('#add').css('background',localStorage['backgroundColor']);
		$('#appFind #form button:last-child,#search').css('background',localStorage.getItem("accentColor"));
		
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
});

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

$(document).contextmenu(function (e) // Lors du clic droit sur la page
{
    var target = $(e.target);
    
    if($('.panel').has(target).length == 1 && !isBodyWidthLess1000px()) // Si le clic s'est déroulé sur un descendant de .panel (sur la liste de moteur ici), et que la largeur de l'écran > 1000px, alors :
    {
        // Déplacer le menu vers la position du clic
        $('.contextMenu').css('left',e.pageX);
        $('.contextMenu').css('top',e.pageY);

        // Afficher le menu contextuel
        $('.contextMenu').slideDown(250);

        // Rendre transparent la liste des moteurs
        $('.listMotors ul').css('opacity','0.3');

        // Retourner false pour que le navigateur n'affiche pas son propre menu contextuel
        return false;
    }
	else
        return true;
});

$(document).click(function(e) // Lors du clic sur la page (n'importe où)
{
    // Fermer le menu du clic droit de Doosearch
    $('.contextMenu').slideUp(250);
    
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

function setSearchEngine(id) // Choisir un moteur
{
    var motor = listSearchEngines[id];
    
	if(needToPinMotor == false && needToAddSelectedMotor == false && changeSelectedMotor.isNeeded == false) // Si on ne veut pas épingler/remplacer un moteur ni selectionner plusieurs moteurs
	    setSelectedMotor(motor);
	else if(needToPinMotor == true) // Si on veut épingler un moteur
        setPinnedMotor(motor);
    else if(needToAddSelectedMotor == true) // Si on veut ajouter un moteur de recherche pour la recherche groupé
        addNewSelectedMotor(motor);
    else if(changeSelectedMotor.isNeeded == true) // Si on veut remplacer un moteur de recherche pour la recherche groupé
        changeSelectedMotorTo(motor);

    if($('.panel').css('display')=='block') // Si la liste des moteurs est visible
        showMotors(); // Cacher la liste
}

$('#field').keydown(function(e){
	if(e.which == 13 || e.which == 10) // Si la touche "Entrer" est appuyée
		validateForm();
});

function validateForm() // Valider le formulaire
{
    if((selectedMotors.length==1 && selectedMotors[0].urlPrefix=='') || selectedMotors.length==0) // Si aucun moteur à été choisi
	{
		motorChanged = true;
		showMotors();
	}
	else if(selectedMotors.length==1 && selectedMotors[0].urlPrefix!='') // Si un seul moteur à été défini
	{
		var query = $('#field').val(); // On récupère le champ de texte
		var url = selectedMotors[0].generateUrl(query); // On génère l'url
		
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
            var url = selectedMotors[i].generateUrl(query); // On génère l'url
            window.open(url, '_blank'); // On ouvre chaque url dans une nouvelle page
        }
        
        if(localStorage['searchOn'] == 'currentTab') // Si l'utilisateur voulais que la recherche se lance sur la page actuelle
        {
            window.open('','_parent','');
            window.close(); // On ferme cette page vu qu'elle ne sert plus à rien
        }
    }
}

function resizePanel(resize) // Pour redimensionner la liste de moteurs
{
	if(resize==true) // Si on veut l'afficher en plein écran
	{
		$('.listMotors').css('right','50px');
		$('.listMotors').css('width','initial');
		$('#fullScreen').addClass('checked');
		$('#sideScreen').removeClass('checked');
	}
	else // Si on veut l'afficher sur le côté
	{
		$('.listMotors').css('right','initial');
		$('.listMotors').css('width','375px');
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
