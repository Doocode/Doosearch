/*

	This file contains scripts about pinned search engines 
	displayed as bubbles at the bottom of the screen.
    
*/



// On récupère les paramètres dans le localStorage
var needToPinMotor = false; // Pour savoir si on veux épingler un moteur ou pas
var pinnedMotors = JSON.parse(localStorage['pinnedMotors']); // Récuperation de la liste des moteurs épinglé


function genPinButton(engine)
{
    let button = $('<li/>');
    button.click(function(){setSearchEngine(engine.id);});
    button.contextmenu(function(e){askAboutEngine(engine.id); e.stopPropagation(); return false;});
    button.mouseover(function(){showTooltip(engine.title);});
    button.append($('<img/>').attr('src',engine.icon));
    return button;
}

function updatePinnedMotors()
{
    $('.toolBar .pinned').html("");
	for(var i=0;i<pinnedMotors.length;i++)
        $('.toolBar .pinned').append(genPinButton(pinnedMotors[i]));
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

        $('.toolBar .pinned').append(genPinButton(motor));
    }

    needToPinMotor = false;
}