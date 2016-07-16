function closeWindow(id)
{
	$(id+' .window').slideUp();
	$(id).fadeOut();
}

function openWindow(id)
{
	$(id).fadeIn();
	$(id+' .window').slideDown();
}