var pinnedWebsites;
pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']), i = 0; // Get the array of pinnedWebsites

updateSpeedDial();

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
			$('<li oncontextmenu="editWebsite(' + i + '); return false;"><a href="' + pinnedWebsites[i].url + '"><img src="' + pinnedWebsites[i].icon + '" /><h3>' + pinnedWebsites[i].title + '</h3></a></li>').insertAfter('#speedDial ul li:last-child');
	}
}