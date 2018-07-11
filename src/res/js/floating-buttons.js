function showTooltip(text) // Afficher les bulles d'infos
{
	if(text=='')
		$('.tooltip').fadeOut();
	else
	{
		$('.tooltip').slideDown();
		$('.tooltip').html(text);
        setTimeout(function(){showTooltip('');}, 3000);
	}
}