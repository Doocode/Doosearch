<?php 
use Language\Lang;
header("Content-type: text/javascript; charset: UTF-8"); 
require("../core/Core.php");
Lang::setSection('search');
?>

/*

    Ce fichier contient le code concernant les moteurs séléctionnés,
    qui sont affichés dans une bulle entre le header et la barre de
    recherche
    
*/

var selectedEngines = []; // On crée un tableau qui va contenir la liste des moteurs sélectionnés

var motorChanged = false; // Dans le cas des utilisateurs qui n'ont pas défini un moteur, on va s'assurer qu'il vont selectionner un avant de rechercher
var needToAddSelectedMotor = false; // Cette variable nous permet de savoir si l'utilisateur veut séléctionner un moteur (pour l'ajouter dans les moteurs séléctionnés) ou pas
var changeSelectedMotor = {
    isNeeded : false, // Cette variable permet de determiner si l'utilisateur veut changer un moteur séléctionné
    motorId : 0 // Cette ligne va quand à lui retenir l'ID du moteur à changer
};

// AUTRES FONCTIONS UTILES

function updateSelectedMotors() // Pour mettre à jour l'affichage des moteurs sélectionnés
{
    $('.selected-engines').html(''); // On efface le code HTML 
    
    if(selectedEngines.length>0) // Si il y a au moins un moteur séléctionné
    {
        for(let i=0; i<listSearchEngines.length; i++) 
        {
            listSearchEngines[i].setSelected(false); // On déséléctionne les moteurs dans la liste des moteurs
            
            for(let j=0; j<selectedEngines.length; j++) // On parcours la liste des moteurs sélectionnés
            {
                if(listSearchEngines[i].title == selectedEngines[j].title)
                {
                    listSearchEngines[i].setSelected(true);
                    break;
                }
            }
        }
        
        for(let i=0; i<selectedEngines.length; i++) // On parcours la liste des moteurs sélectionnés
        {
            if(i<3)
            {
                // On génére le code HTML de l'element i
                let item = $("<li/>");
                if(selectedEngines.length==1)
                    item.addClass('big');
                let motor = selectedEngines[i];

                let icon = $("<img/>");
                icon.attr('class','icon');
                icon.attr('src',motor.icon);
                item.append(icon);
            
                $('.selected-engines').append(item);
            }
            else if(i==3)
            {
                // On génére le code HTML de l'element i
                let item = $("<li/>");
                item.addClass('overflow');
                
                let text = $("<span/>");
                text.html(selectedEngines.length-i);
                item.append(text);
            
                $('.selected-engines').append(item);
            }
        }
    }
    else // S'il n'y a pas de moteur séléctionné
    {
        for(let i=0; i<listSearchEngines.length; i++) 
            listSearchEngines[i].setSelected(false); // On déséléctionne les moteurs dans la liste des moteurs
        listSearchEngines[0].setSelected(true);
        
        let item = $("<li/>");
        item.addClass('big');
            let icon = $("<img />");
            icon.attr('class','icon');
            icon.attr('src','res/img/choose.png');
            icon.click(function(){showMotors();});
            icon.mouseover(function(){showTooltip('<?= Lang::getKey("ask_later"); ?>');});
            item.append(icon);
        
        $('.selected-engines').append(item);
    }
    
    updateListSearchEngine(); // On met à jour l'affichage de la liste des moteurs disponible
    
    // On met à jour le texte dans la barre de recherche
    if(selectedEngines.length==1 && selectedEngines[0].title!='') // Si un seul moteur est sélectionné et que le titre de ce moteur n'est pas vide
        $('#field').attr('placeholder', ('<?= Lang::getKey("search_on_one"); ?>').replace('%search_engine%',selectedEngines[0].title));
    else if(selectedEngines.length>1) // S'il y a plusieurs moteurs séléctionné
        $('#field').attr('placeholder','<?= Lang::getKey("search_on_multiple_search_engine"); ?>');
    else // Sinon
        $('#field').attr('placeholder','<?= Lang::getKey("write_your_query_here"); ?>');
}

function showSelectedEngines()
{
    showMotors();
    $('#add-search-engine').css('display','inline-block'); 
    $('.searchBar input').val('<?= Lang::getKey("selected"); ?>'); 
    $('.searchBar').addClass('withCleaner'); 
    $('.searchBar input').select(); 
    searchEngines('<?= Lang::getKey("selected"); ?>');
}

function setSelectedMotor(motor) // Si on veut juste rechercher sur un seul moteur de recherche
{
    selectedEngines = []; // On vide la liste des moteurs sélectionné
    
    if(motor.urlPrefix!='')
        selectedEngines.push(motor); // On ajoute le moteur dans la liste des moteurs

    updateSelectedMotors(); // On met à jour l'affichage de la liste des moteurs
    updateListSearchEngine(); // Et la liste des moteurs

    if(motorChanged) // Si on viens de cliquer sur "Rechercher" ou taper "Entrer"
        validateForm(); // Valider le formulaire
    else
        showTooltip(('<?= Lang::getKey("search_will_be_done_on_item"); ?>').replace('%search_engine%', motor.title));
}

function addNewSelectedMotor(motor) // Si on veut ajouter un moteur de recherche pour la recherche groupé
{
    var isAlready=false; // isAlready sert à savoir si le moteur n'est pas déjà dans la liste des moteurs séléctionné

    for(let i=0;i<selectedEngines.length;i++) // On va vérifier si le moteur n'est pas déjà dans la liste des moteurs séléctionné
    {
        if(selectedEngines[i].title==motor.title) // On compare le titre
            isAlready = true; // Si c'est similaire, alors on retient l'info
    }
    
    if(isAlready) // Si le moteur est dans la liste des moteurs séléctionné
        alert('<?= Lang::getKey("search_engine_already_selected"); ?>');
    else if(!isAlready && motor.urlPrefix=='') // Si c'est un  moteur invalide
        alert('<?= Lang::getKey("search_engine_cannot_be_selected"); ?>');
    else if(!isAlready && motor.urlPrefix!='') // Si le moteur valide n'est pas dans la liste des moteurs séléctionné
    {
        showTooltip(('<?= Lang::getKey("search_will_be_also_done_on_item"); ?>').replace('%search_engine%', motor.title));
        selectedEngines.push(motor); // On l'ajoute dans la liste des moteurs séléctionné
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

function changeSelectedMotorTo(motor)
{
    var isAlready=false; // isAlready sert à savoir si le moteur n'est pas déjà dans la liste des moteurs séléctionné

    if(motor.urlPrefix=='')
        alert('<?= Lang::getKey("search_engine_cannot_replace_another"); ?>');
    
    for(let i=0;i<selectedEngines.length;i++) // On va vérifier si le moteur n'est pas déjà dans la liste des moteurs séléctionné
    {
        if(selectedEngines[i].title==motor.title) // On compare le titre
            isAlready = true; // Si c'est similaire, alors on retient l'info
    }
    
    if(isAlready) // Si le moteur est dans la liste des moteurs séléctionné
        alert('<?= Lang::getKey("search_engine_is_also_on_the_list"); ?>');
    if(!isAlready) // Si le moteur n'est pas dans la liste des moteurs séléctionné
        selectedEngines[changeSelectedMotor.motorId] = motor; // On le remplace dans le tableau de la liste des moteurs séléctionné
    
    updateSelectedMotors(); // Et on met à jour l'affichage de la liste des moteurs

    changeSelectedMotor.isNeeded = false; // On a fini de remplacer le moteur, donc à plus besoin normalement
}

function removeSelectedEngine(arg) // Si on veut désélectionner un moteur de recherche
{
    if(arg > -1) // On s'assure que l'identifiant est valide
    {
        let engine = listSearchEngines[arg];
        let i;
        for(i=0;i<selectedEngines.length;i++) // On va chercher le moteur sélectionné
        {
            if(selectedEngines[i].title==engine.title)
            {
                engine.setSelected(false);
                break;
            }
        }

        selectedEngines.splice(i, 1);
    }

    updateSelectedMotors(); // Et on met à jour l'affichage de la liste des moteurs
}