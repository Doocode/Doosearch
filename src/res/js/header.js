

$('body').click(function(e)
{
	if($('header ul').css('left')=='0px')
		$('header ul').css('left','-100%');
	if($('.family').css('right')=='0px')
		$('.family').css('right','-100%');
	
	return true;
});

function showHeaderMenu()
{
	if($('header ul').css('left')=='0px')
		$('header ul').css('left','-100%');
	else
		$('header ul').css('left','0px');
}

function showFamily()
{
	if($('.family').css('right')=='0px')
		$('.family').css('right','-100%');
	else
		$('.family').css('right','0px');
}

function isBodyWidthLess1000px()
{
	if(parseInt($('body').css('width').split("px").join(""))<1000)
		return true;
	else
		return false;
}