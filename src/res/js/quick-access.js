var pinnedWebsites, currentContextItem;
pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']); // Get the array of pinnedWebsites

$(function(){
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    //$('.navig').css('background',localStorage['accentColor']);
    $('#quickAccessPage').addClass('selected');
    resetForm();
    
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
    
	for(let i=0; i<pinnedWebsites.length; i++)
	{
		if(pinnedWebsites[i]!='')
        {
            let tile = $('<li/>');
            tile.attr('id','website-'+i);
            tile.contextmenu(function(){
                askAboutWebsite(i);
                return false;
            });
            
            let link = $('<a/>');
                link.attr('href',pinnedWebsites[i].url);
                link.append($('<img/>').attr('src',pinnedWebsites[i].icon));
                link.append($('<p/>').html(pinnedWebsites[i].title));
            tile.append(link);
            
            contener.append(tile);
        }
	}
}

function askAboutWebsite(id)
{
    currentContextItem = id;
    let item = pinnedWebsites[id];
    $('.menu .view img').attr('src', item.icon);
    $('.menu .view h5').html(item.title);
    $('.content, .toolBar').css('filter','blur(4px) brightness(50%)');
    $('.central.ctxtmenu').fadeIn();
    $('.menu').slideDown();
}

function hideMenu()
{
    $('.content, .toolBar').css('filter','blur(0px) brightness(100%)');
    $('.menu').slideUp();
    $('.central.ctxtmenu').fadeOut();
}

function openLink()
{
    document.location.href=pinnedWebsites[currentContextItem].url;
}

function getIconUrl()
{
    var imgUrl = prompt("Entrez l'adresse URL de l'icône");
    
    if(imgUrl.substr(0,7) == 'http://' || imgUrl.substr(0,8) == 'https://')
        $('#addWebsite .icon img, #editWebsite .icon img').attr('src',imgUrl);
    else
        alert('Adresse non valide.');
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

function editWebsite()
{
	openWindow('#editWebsite');
	
    let item = pinnedWebsites[currentContextItem];
	$('#editWebsite input[name=title]').val(item.title);
	$('#editWebsite input[name=url]').val(item.url);
	$('#editWebsite .icon img').attr('src',item.icon);
}

function saveChanges()
{
    let item = pinnedWebsites[currentContextItem];
	item.title = $('#editWebsite input[name=title]').val();
	item.url = $('#editWebsite input[name=url]').val();
	item.icon = $('#editWebsite .icon img').attr('src');
    
    pinnedWebsites[currentContextItem] = item;
    localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
    
	closeWindow('#editWebsite');
    hideMenu();
	resetForm();
    updateView();
}

function duplicateWebsite()
{
    let item = pinnedWebsites[currentContextItem];
    pinnedWebsites.push(item);
    localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
    updateView();
}

function removeWebsite()
{
    if(confirm('Voulez-vous vraiment supprimer le site "' + pinnedWebsites[currentContextItem].title + '" de votre accès rapide ?'))
    {
        pinnedWebsites.splice(currentContextItem, 1);
	    localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
        updateView();
    }
}

function resetForm()
{
	$('#addWebsite input[name=title]').val('Nom du site');
	$('#addWebsite input[name=url]').val('http://www.domaine.com');
	$('#editWebsite input[name=title]').val('');
	$('#editWebsite input[name=url]').val('');
	$('#addWebsite .icon img, #editWebsite .icon img').attr('src','res/img/choose.png');
}