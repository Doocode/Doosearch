/*

    Ce fichier contient le code concernant les moteurs épinglés,
    qui sont affichés sous forme de bulles en bas de l'écran.
    
*/

// On récupère les paramètres dans le localStorage
var pinnedMotors = JSON.parse(localStorage['pinnedMotors']); // Récuperation de la liste des moteurs épinglé
var needToPinMotor = false; // Pour savoir si on veux épingler un moteur ou pas

function updatePinnedMotors()
{
	var i=0;
	for(i;i<pinnedMotors.length;i++)
	{
		$('<li onclick="setMotor(\'' + pinnedMotors[i].first + '\',\'' + pinnedMotors[i].last + '\',\'' + pinnedMotors[i].icon + '\',\'' + pinnedMotors[i].title + '\');" onmouseover="showTooltip(\'' + pinnedMotors[i].title + '\');" onmouseout="showTooltip(\'\');"><img src="' + pinnedMotors[i].icon + '" /></li>').insertAfter('.toolBar .pinned li:last-child');
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

    needToPinMotor = false;
}