/*

    Ce fichier contient le code concernant les moteurs épinglés,
    qui sont affichés sous forme de bulles en bas de l'écran.
    
*/



// On récupère les paramètres dans le localStorage
var needToPinMotor = false; // Pour savoir si on veux épingler un moteur ou pas
var pinnedMotors = JSON.parse(localStorage['pinnedMotors']); // Récuperation de la liste des moteurs épinglé


function updatePinnedMotors()
{
	var i=0;
	for(i;i<pinnedMotors.length;i++)
	{
        var motor = pinnedMotors[i];
        var icon = $('<li/>');
        icon.click(function(){setMotor(motor.first, motor.last, motor.icon, motor.title);});
        icon.mouseover(function(){showTooltip(motor.title);});
        icon.mouseout(function(){showTooltip();});
        icon.append($('<img/>').attr('src',motor.icon));
        $('.toolBar .pinned').append(icon);
    }
}

function addPinnedMotors() // Cette fonction est appelé si on veut épingler un moteur
{
	needToPinMotor = true; // On signale que l'utilisateur veut épingler un moteur
	showMotors(); // Et on affiche la liste des moteurs
}

function setPinnedMotor(first,last,icon,title)
{
    var i=0,isAlready=false;

    for(i;i<pinnedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà épinglé
    {
        if(pinnedMotors[i].title==title)
            isAlready = true;
    }
    if(isAlready)
        alert('Déjà épinglé');
    else if(!isAlready && first=='')
        alert('Cet icône ne peut pas être épinglé');
    else if(!isAlready && first!='')
    {
        var motor = {
            icon: icon,
            title: title,
            first: first,
            last: last
        };

        pinnedMotors.push(motor);
        localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);

        var icon = $('<li/>');
        icon.click(function(){setMotor(motor.first, motor.last, motor.icon, motor.title);});
        icon.mouseover(function(){showTooltip(motor.title);});
        icon.mouseout(function(){showTooltip();});
        icon.append($('<img/>').attr('src',motor.icon));
        $('.toolBar .pinned').append(icon);
    }

    needToPinMotor = false;
}