<?php 
use Language\Lang;
header("Content-type: text/javascript; charset: UTF-8"); 
require("../php/core/Core.php");
Lang::setSection('color_selector');
?>

/* Ce fichier est utilisé dans "/res/php/colors.php" */

var currentColorSelectorPopup = '';

function showColorSelector(arg) // Sert à afficher/cacher le panneau de sélection de couleur
{
    if(arg==false) // Si l'argument vaut false, alors on va cacher le panneau
    {
        $('#colorSelector').slideUp();
        
        currentColorSelectorPopup = '';
    }
    else if(arg == 'background' || arg == 'accent') // Sinon on l'affiche
    {
        $('#colorSelector').slideDown();
        
        currentColorSelectorPopup = arg;
        
        if(arg == 'background')
        {
            $('#colorSelector .titleBar p').html("<?= Lang::getKey("background_color"); ?>");
            setSelectedColor(localStorage['backgroundColor'])
        }
        else if(arg == 'accent')
        {
            $('#colorSelector .titleBar p').html("<?= Lang::getKey("accent_color"); ?>");
            setSelectedColor(localStorage['accentColor'])
        }
        
    }
}

function setSelectedColor(color)
{
	// Affichage de la couleur
	$('#colorSelector .viewer').css('background', color);
	
    // Affichage de la couleur en format RGB
	var arrayColor = hexToArray(color);
	$('#colorSelector .red input').val(arrayColor[0]);
	$('#colorSelector .green input').val(arrayColor[1]);
	$('#colorSelector .blue input').val(arrayColor[2]);
    
    $("#colorSelector").trigger( "colorSelected", color );
}

function updateInputColor() // Permet de mettre à jour l'affichage RGB en sélectionnant une couleur prédéfinie.
{
    var r, g, b, color;
	
	r = $('#colorSelector .red input').val();
	g = $('#colorSelector .green input').val();
	b = $('#colorSelector .blue input').val();
    color = rgbToHex(parseInt(r),parseInt(g),parseInt(b));
	
	// Preview
	$('#colorSelector .viewer').css('background',color);
    
    // Emit a signal
    $("#colorSelector").trigger( "colorSelected", [ color ] );
}