var pinnedWebsites;
pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']); // Get the array of pinnedWebsites

$(function(){
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    //$('.navig').css('background',localStorage['accentColor']);
    $('#quickAccessPage').addClass('selected');
    
    // Listeners
    $('#searchBar input').on('input',function(e) {
        var query = $('#searchBar input').val(); // On récupère les termes saisis par l'utilisateur
        for(let i=0; i<pinnedWebsites.length; i++) // Pour chaque site épinglé
        {
            let item = pinnedWebsites[i];
            if(item.title.toLowerCase().includes(query.toLowerCase()) || item.url.toLowerCase().includes(query.toLowerCase()))
                $('#website-'+i).fadeIn();
            else
                $('#website-'+i).fadeOut();
        }
    });
    
    updateView();
});

function updateView()
{
    var contener = $('.content .tiles');
    contener.html('');
    
    if(pinnedWebsites.length==0)
    {
        var text = $('<p/>');
        text.attr('class','info');
        text.html('Vous avez aucun site épinglé');
        contener.append(text);
    }
    
    var i=0;
	for(i;i<pinnedWebsites.length;i++)
	{
		if(pinnedWebsites[i]!='')
        {
            var tile = $('<li/>');
            tile.attr('id','website-'+i);
            tile.contextmenu(function(){
                editWebsite(i);
                return false;
            });
            
            var link = $('<a/>');
                link.attr('href',pinnedWebsites[i].url);
                link.append($('<img/>').attr('src',pinnedWebsites[i].icon));
                link.append($('<p/>').html(pinnedWebsites[i].title));
            tile.append(link);
            
            contener.append(tile);
        }
	}
}

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
	updateView();
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