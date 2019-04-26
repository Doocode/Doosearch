$(function() { // Cette fonction est appelé après le chargement de la page

    // On affiche les éléments de l'interface de l'application
    $('#searchPage').addClass('selected');

    if(localStorage.getItem("searchEngine-prefix") != '') // Si on a défini un moteur de recherche par défaut
    {
        // On récupère dans le localStorage les paramètres du moteur
        let engine = new SearchEngine(localStorage['searchEngine-title'], 
                                     localStorage['searchEngine-icon'], 
                                     localStorage['searchEngine-prefix'], 
                                     localStorage['searchEngine-suffix']);

        selectedEngines.push(engine); // Puis on l'ajoute dans la liste des moteurs séléctionné
    }

    updateSelectedMotors(); // Affichage des moteurs séléctionnés
    updatePinnedMotors(); // Affichage des moteurs épinglés

    //Charger les couleurs
    $('.popupSearchEngines').css('background',localStorage.getItem("accentColor"));
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    $('#add').css('background',localStorage['backgroundColor']);
    if(localStorage['bgImg'] != '')
    {
        let value = localStorage['bgImgFilter'];
        if(value>0)
            $('.central, #quick-access, #toolBarHolder').css('background', 'rgba(0,0,0,'+(value/100)+')');
        else
            $('.central, #quick-access, #toolBarHolder').css('background', 'rgba(255,255,255,'+(Math.abs(value)/100)+')');
    }

    // On déplace le menu contextuel des moteurs de recherche
    let menu = $('.central.menu').detach();
    $('body').append(menu);

    // On met le focus sur la barre de recherche
    $('#field').focus();

    $('body').append($('.tooltip').detach())

    // Définitions des listeners
    $('body').mousemove(function(e){
        if(!Modernizr.touchevents)
        {
            var cursorPosX = e.pageX - Math.round($('.toolBar').position().left); // On calcul la position du curseur sur l'objet par rapport à sa position sur le body
            var percent = ((cursorPosX / parseInt($('.toolBar').css('width').split("px").join("")))*100); // On calcul sa position en % sur l'axe X
            var percentString = '' + percent + '%'; // On le met en chaine de caractère et on ajoute le caractère "%"
            $('.toolBar').scrollTo(percentString,0); // On scroll vers la position (percentString,0px)
            $('.toolBar').css('overflow','hidden');
        }
        else
        {
            $('.toolBar').css({'overflow':'auto', 'pointer-events':'all'});
            $('.toolBar div').css({'pointer-events':'all'});
        }

        return true; // Pour que le navigateur prenne en compte l'evenement*/
    });
    $('#field').keypress(function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == 13)
            validateForm();
        return true;
    });
    $('#field').on('input',function(e){
        if($('#field').val().length > 0)
            $('#form').addClass('withCleaner');
        else
            $('#form').removeClass('withCleaner');
        return true;
    });
});

$(document).click(function(e) // Lors du clic sur la page (n'importe où)
{    
	$('.popupSearchEngines .searchEngines').css('opacity','1'); // Remettre l'opacité de la liste des moteurs en normal
    
	if($('.family').css('right')=='0px') // Si le menu "Doocode Family" est visible
		$('.family').css('right','-100%'); // Masquer le menu
	
	return true;
});

function showMotors()
{
	if($('.panel').css('display')=='block') // Si on veut cacher la liste des moteurs (si elle est visible)
	{
        $('.panel').fadeOut();
        $('#add-search-engine').hide(); 
        clearSearchBar(); // On efface la zone de recherche
        $('body').css('overflow','auto'); // Affiche la barre de scroll sur la page si nécéssaire
        
		motorChanged = false;
        needToAddSelectedMotor = false;
        changeSelectedMotor.isNeeded = false;
	}
	else // Sinon on l'affiche
	{
        $('body').css('overflow','hidden'); // Cache la barre de scroll sur la page
        $('.panel').fadeIn();
        $('.searchBar input').focus();
		loadSearchEngines();
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
    if((selectedEngines.length==1 && selectedEngines[0].urlPrefix=='') || selectedEngines.length==0) // Si aucun moteur à été choisi
	{
		motorChanged = true;
		showMotors();
	}
	else if(selectedEngines.length==1 && selectedEngines[0].urlPrefix!='') // Si un seul moteur à été défini
	{
		var query = $('#field').val(); // On récupère le champ de texte
		var url = selectedEngines[0].generateUrl(query); // On génère l'url
		
        if(localStorage['searchOn'] == 'currentTab') // Si l'utilisateur veut que la recherche se lance sur la page actuelle
            document.location.href=url;
        else if(localStorage['searchOn'] == 'newTab') // Si l'utilisateur veut que la recherche se lance dans une nouvelle page
            window.open(url, '_blank');
	}
	else if(selectedEngines.length>1) // Si plusieurs moteurs ont été définis
    {
        var i=0, query = $('#field').val(); // On récupère le champ de texte
        for(i;i<selectedEngines.length;i++)
        {
            var url = selectedEngines[i].generateUrl(query); // On génère l'url
            window.open(url, '_blank'); // On ouvre chaque url dans une nouvelle page
        }
        
        if(localStorage['searchOn'] == 'currentTab') // Si l'utilisateur voulais que la recherche se lance sur la page actuelle
        {
            window.open('','_parent','');
            window.close(); // On ferme cette page vu qu'elle ne sert plus à rien
        }
    }
}