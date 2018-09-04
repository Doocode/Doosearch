$(function(){
    if(localStorage['doosearchVersion'] != null || localStorage['doosearchVersion'] == 1.33)
    {
		$('header #setupPage').hide();
        $('header #searchPage,header #quickAccessPage,header #configPage').css('display','inline-block');
    }
    else
    {
		$('header #setupPage').css('display','inline-block');
        $('header #searchPage, header #quickAccessPage,header #configPage').hide();
    }
    
    updateContrast();
});

$(document).click(function(e) // Lorsqu'on clique sur la page
{
	if($('header ul').css('left')=='0px') // Si le menu du header est visible
		$('header ul').css('left','-100%'); // Cacher ce menu
	if($('.family').css('right')=='0px') // Si le menu Doocode Family est visible
		$('.family').css('right','-100%'); // Cacher ce menu aussi
	
	return true; // Pour que le clic ait un effet
});

function showHeaderMenu() // Si on veut afficher le menu du header
{
	if($('header ul').css('left')=='0px') // Si le menu du header est visible
		$('header ul').css('left','-100%'); // Cacher ce menu
	else // S'il n'est pas visible
		$('header ul').css('left','0px'); // Afficher ce menu
}

function showFamily()
{
	if($('.family').css('right')=='0px') // Si le menu Doocode Family est visible
		$('.family').css('right','-100%'); // Cacher ce menu
	else // S'il n'est pas visible
		$('.family').css('right','0px'); // Afficher ce menu
}

function isBodyWidthLess1000px() // Pour savoir si la largeur de l'écran est inferieure à 1000px
{
	if(parseInt($('body').css('width').split("px").join(""))<1000) // Si c'est le cas
		return true; // Retourner true/vrai
	else // Sinon (si la largeur de l'écran est superieure à 1000px)
		return false; // Retourner false/faux
}

function setCurrentPage(idTag) // Pour laisser un indicateur (page active) dans le header
{
	$(idTag).addClass('selected');
}

function updateContrast()
{
    if(localStorage['contrast'] == 'dark')
        $('body').addClass('dark');
    else
        $('body').removeClass('dark');
}