var pinnedWebsites;
pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']); // Get the array of pinnedWebsites

$(function(){
    updateSpeedDial();
});

function updateSpeedDial()
{
    $('#quick-access ul').html('');
    
    var i=0;
	for(i;i<pinnedWebsites.length;i++)
	{
		if(pinnedWebsites[i]!='')
        {
            var tile = $('<li/>');
            
            var link = $('<a/>');
                link.attr('href',pinnedWebsites[i].url);
                link.append($('<img/>').attr('src',pinnedWebsites[i].icon));
                link.append($('<p/>').html(pinnedWebsites[i].title));
            tile.append(link);
            
            $('#quick-access ul').append(tile);
        }
	}
    
    if(pinnedWebsites.length==0)
        $('#quick-access').css('display','none');
    else
        $('#quick-access').css('display','block');
}