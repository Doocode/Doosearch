/*

    Ce fichier contient le code concernant les moteurs épinglés,
    qui sont affichés sous forme de bulles en bas de l'écran.
    
*/



// On récupère les paramètres dans le localStorage
var needToPinMotor = false; // Pour savoir si on veux épingler un moteur ou pas
var pinnedMotors = JSON.parse(localStorage['pinnedMotors']); // Récuperation de la liste des moteurs épinglé


function updatePinnedMotors()
{
    console.log("updating");
    console.log('count = '+pinnedMotors.length);
    
    $('.toolBar .pinned').html("");
	for(var i=0;i<pinnedMotors.length;i++)
	{
        console.log('count = '+i);
        let motor = pinnedMotors[i];
        let button = $('<li/>');
        button.click(function(){setSearchEngine(motor.title, motor.icon, motor.urlPrefix, motor.urlSuffix);});
        button.mouseover(function(){showTooltip(motor.title);});
        button.mouseout(function(){showTooltip();});
        button.append($('<img/>').attr('src',motor.icon));
        $('.toolBar .pinned').append(button);
    }
}

function addPinnedMotors() // Cette fonction est appelé si on veut épingler un moteur
{
	needToPinMotor = true; // On signale que l'utilisateur veut épingler un moteur
	showMotors(); // Et on affiche la liste des moteurs
}

function setPinnedMotor(motor)
{
    var isAlready=false;

    for(let i=0;i<pinnedMotors.length;i++) // On va vérifier si le moteur n'est pas déjà épinglé
    {
        if(pinnedMotors[i].title==motor.title)
            isAlready = true;
    }
    if(isAlready)
        alert('Déjà épinglé');
    else if(!isAlready && motor.urlPrefix=='')
        alert('Cet icône ne peut pas être épinglé');
    else if(!isAlready && motor.urlPrefix!='')
    {
        pinnedMotors.push(motor);
        localStorage['pinnedMotors'] = JSON.stringify(pinnedMotors);

        let button = $('<li/>');
        button.click(function(){setSearchEngine(motor);});
        button.mouseover(function(){showTooltip(motor.title);});
        button.mouseout(function(){showTooltip();});
        button.append($('<img/>').attr('src',motor.icon));
        $('.toolBar .pinned').append(button);
    }

    needToPinMotor = false;
}