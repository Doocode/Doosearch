var pinnedWebsites;
pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']), i = 0; // Get the array of pinnedWebsites

$(function(){
    updateSpeedDial();
});

function addWebsite()
{
	var website = {
		icon: $('#addWebsite .icon img').attr('src'),
		title: $('#addWebsite input[name=title]').val(),
		url: $('#addWebsite input[name=url]').val()
	};
	
	if(website.url=='')
	{
		alert('Veuillez entrer une adresse URL pour ajouter un site web');
		return;
	}
	
	pinnedWebsites.push(website);
	localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
	alert('Raccourci ajouté avec succès !');
	closeWindow('#addWebsite');
	resetForm();
	updateSpeedDial();
}

function editWebsite(id)
{
	openWindow('#editWebsite');
	
	$('#editWebsite input[name=title]').val(pinnedWebsites[id].title);
	$('#editWebsite input[name=url]').val(pinnedWebsites[id].url);
	$('#editWebsite .icon img').attr('src',pinnedWebsites[id].icon);
}

function resetForm()
{
	$('#addWebsite input[name=title]').val('');
	$('#addWebsite input[name=url]').val('');
	$('#addWebsite .icon img').attr('src','res/img/choose.png');
}

function updateSpeedDial()
{
	for(i;i<pinnedWebsites.length;i++)
	{
		if(pinnedWebsites[i]!='')
        {
            
            var motor = pinnedMotors[i];
            
            var tile = $('<li/>');
            tile.contextmenu(function(){
                editWebsite(i);
                return false;
            });
            
            var link = $('<a/>');
                link.attr('href',pinnedWebsites[i].url);
                link.append($('<img/>').attr('src',pinnedWebsites[i].icon));
                link.append($('<p/>').html(pinnedWebsites[i].title));
            tile.append(link);
            
            $('#speedDial ul').append(tile);
        }
	}
}