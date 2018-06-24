/*

    Ce fichier contient le code concernant les moteurs séléctionnés,
    qui sont affichés dans une bulle entre le header et la barre de
    recherche
    
*/

var selectedMotors = []; // On crée un tableau qui va contenir la liste des moteurs sélectionnés

var motorChanged = false; // Dans le cas des utilisateurs qui n'ont pas défini un moteur, on va s'assurer qu'il vont selectionner un avant de rechercher
var needToAddSelectedMotor = false; // Cette variable nous permet de savoir si l'utilisateur veut séléctionner un moteur (pour l'ajouter dans les moteurs séléctionnés) ou pas
var changeSelectedMotor = {
    isNeeded : false, // Cette variable permet de determiner si l'utilisateur veut changer un moteur séléctionné
    motorId : 0 // Cette ligne va quand à lui retenir l'ID du moteur à changer
};



// LES EVENTS

$('.selectedMotors').mousemove(function(e) // Si la souris se déplace sur la liste des moteurs selectionnés
{
	var cursorPosX = e.pageX - Math.round($('.selectedMotors').position().left); // On calcul la position du curseur sur l'objet par rapport à sa position sur le body
	var percent = ((cursorPosX / parseInt($('.selectedMotors').css('width').split("px").join("")))*100); // On calcul sa position en % sur l'axe X
	var percentString = '' + percent + '%'; // On le met en chaine de caractère et on ajoute le caractère "%"
    $('.selectedMotors').scrollTo(percentString,0); // On scroll vers la position (percentString,0px)
    
	return true; // Pour que le navigateur prenne en compte l'evenement
});

$('.selectedMotors').mouseout(function(e) // Si la souris quitte la zone de la liste des moteurs selectionnés
{
	$('.selectedMotors').scrollTo(0,0); // On scroll vers la position (0%,0px)
    
	return true; // Pour que le navigateur prenne en compte l'evenement
});




// AUTRES FONCTIONS UTILES

function updateSelectedMotors() // Pour mettre à jour l'affichage des moteurs sélectionnés
{
   // var htmlCode = '';
    $('.selectedMotors').html(''); // On efface le code HTML 
    
    if(selectedMotors.length>0) // Si il y a au moins un moteur séléctionné
    {
        for(let i=0;i<selectedMotors.length;i++) // On parcours la liste des moteurs sélectionnés
        {
            var motor = selectedMotors[i];
            
            // On génére le code HTML de chaque moteur
            var item = $("<li/>");
                var icon = $("<img />");
                icon.attr('class','icon');
                icon.attr('src',motor.icon);
                icon.click(function(){replaceMotor(i);});
                icon.mouseover(function(){showTooltip(motor.title);});
                icon.mouseout(function(){showTooltip();});
                item.append(icon);
            
                var remove = $('<span />');
                remove.attr('class','remove');
                remove.click(function(){removeSelectedMotor(i);});
                remove.mouseover(function(){showTooltip('Supprimer le moteur de recherche');});
                remove.mouseout(function(){showTooltip();});
                remove.html('<img src="res/img/close.png" />');
                item.append(remove);
            
            $('.selectedMotors').append(item);
        }
    }
    else // S'il n'y a pas de moteur séléctionné
    {
        var item = $("<li/>");
            var icon = $("<img />");
            icon.attr('class','icon');
            icon.attr('src','res/img/choose.png');
            icon.click(function(){showMotors();});
            icon.mouseover(function(){showTooltip('Selectionner le moteur plus tard');});
            icon.mouseout(function(){showTooltip();});
            item.append(icon);

        $('.selectedMotors').append(item);
    }
    
    // Et on ajoute le bouton "+" pour pouvoir ajouter des moteurs
    var item = $("<li/>");
    item.click(function(){addSelectedMotor();});
    item.mouseover(function(){showTooltip('Ajouter un moteur de recherche');});
    item.mouseout(function(){showTooltip();});
        var icon = $("<img />");
        icon.attr('class','icon');
        icon.attr('src','res/img/add.png');
        item.append(icon);

    $('.selectedMotors').append(item);
    
    // On met à jour le texte dans la barre de recherche
    if(selectedMotors.length==1 && selectedMotors[0].title!='') // Si un seul moteur est sélectionné et que le titre de ce moteur n'est pas vide
        $('#field').attr('placeholder','Rechercher sur ' + selectedMotors[0].title);
    else if(selectedMotors.length>1) // S'il y a plusieurs moteurs séléctionné
        $('#field').attr('placeholder','Rechercher sur plusieurs sites web');
    else // Sinon
        $('#field').attr('placeholder','Tapez votre requete ici');
}

function addSelectedMotor() // Quand l'utilisateur veut ajouter un moteur
{
    needToAddSelectedMotor = true; // On retient l'info : que l'utilisateur veut ajouter un moteur
    showMotors(); // Et on affiche la liste des moteurs
}

function setSelectedMotor(first,last,icon,title) // Si on veut juste rechercher sur un seul moteur de recherche
{
    selectedMotors = []; // On vide le tableau de la liste des moteurs

    // On crée un objet moteur qui contiendra les informations du moteur séléctionné
    var motor = {
        icon: icon,
        title: title,
        first: first,
        last: last
    };

    selectedMotors.push(motor); // On l'ajoute dans le tableau de la liste des moteurs

    updateSelectedMotors(); // On met à jour l'affichage de la liste des moteurs

    if(motorChanged) // Si on viens de cliquer sur "Rechercher" ou taper "Entrer"
        validateForm(); // Valider le formulaire
}

function addNewSelectedMotor(first,last,icon,title) // Si on veut ajouter un moteur de recherche pour la recherche groupé
{
    var i=0,isAlready=false; // isAlready sert à savoir si le moteur n'est pas déjà dans la liste des moteurs séléctionné

    for(i;i<selectedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà dans la liste des moteurs séléctionné
    {
        if(selectedMotors[i].title==title) // On compare le titre
            isAlready = true; // Si c'est similaire, alors on retient l'info
    }
    
    if(isAlready) // Si le moteur est dans la liste des moteurs séléctionné
        alert('Le moteur est déjà dans la liste');
    else if(!isAlready && first=='') // Si c'est un  moteur invalide
        alert('Cet icône ne peut pas être sélectionné');
    else if(!isAlready && first!='') // Si le moteur valide n'est pas dans la liste des moteurs séléctionné
    {
        // On crée un objet moteur qui contiendra les informations du moteur séléctionné
        var motor = {
            icon: icon,
            title: title,
            first: first,
            last: last
        };

        selectedMotors.push(motor); // On l'ajoute dans le tableau de la liste des moteurs séléctionné
    }
    updateSelectedMotors(); // Et on met à jour l'affichage de la liste des moteurs

    needToAddSelectedMotor = false; // On a fini de selectionner un moteur, donc à plus besoin normalement
}

function replaceMotor(id) // Si on veut changer de moteur de recherche déjà séléctionné
{
    changeSelectedMotor.isNeeded = true; // On signale qu'il faut remplacer un moteur séléctionné
    changeSelectedMotor.motorId = id; // On retiens l'ID du moteur à changer
    
    showMotors(); // On affiche la liste des moteurs
}

function changeSelectedMotorTo(first,last,icon,title)
{
    var i=0,isAlready=false; // isAlready sert à savoir si le moteur n'est pas déjà dans la liste des moteurs séléctionné

    for(i;i<selectedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà dans la liste des moteurs séléctionné
    {
        if(selectedMotors[i].title==title) // On compare le titre
            isAlready = true; // Si c'est similaire, alors on retient l'info
    }
    
    if(isAlready) // Si le moteur est dans la liste des moteurs séléctionné
        alert('Le moteur est déjà dans la liste');
    if(!isAlready) // Si le moteur n'est pas dans la liste des moteurs séléctionné
    {
        // On crée un objet moteur qui contiendra les informations du moteur séléctionné
        var motor = {
            icon: icon,
            title: title,
            first: first,
            last: last
        };
        
        selectedMotors[changeSelectedMotor.motorId] = motor; // On le remplace dans le tableau de la liste des moteurs séléctionné
    }
    updateSelectedMotors(); // Et on met à jour l'affichage de la liste des moteurs

    changeSelectedMotor.isNeeded = false; // On a fini de remplacer le moteur, donc à plus besoin normalement
}

function removeSelectedMotor(id) // Si on veut désélectionner un moteur de recherche
{
    if(id > -1) // On s'assure que l'identifiant est valide
        selectedMotors.splice(id, 1); // On supprime 1 seul élément à la position "id"

    updateSelectedMotors(); // Et on met à jour l'affichage de la liste des moteurs
}