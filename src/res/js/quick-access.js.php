<?php 
use Language\Lang;
header("Content-type: text/javascript; charset: UTF-8"); 
require("../php/core/Core.php");
Lang::setSection('quick_access');
?>

var pinnedWebsites, currentContextItem;
pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']); // Get the array of pinnedWebsites

$(function(){
    $('body').css('background','url(' + localStorage['bgImg'] + ') no-repeat fixed center center / cover,' + localStorage['backgroundColor']);
    
    if(localStorage['bgImg'] != '')
    {
        let value = localStorage['bgImgFilter'];
        if(value>0)
            $('.central').css('background', 'rgba(0,0,0,'+(value/100)+')');
        else
            $('.central').css('background', 'rgba(255,255,255,'+(Math.abs(value)/100)+')');
    }
    
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
    pinnedWebsites = JSON.parse(localStorage['pinnedWebsites']); // Get the array of pinnedWebsites
    
    var contener = $('.content .tiles');
    contener.html('');
    
    if(pinnedWebsites.length==0)
    {
        var text = $('<p/>');
        text.attr('class','info');
        text.html('<?= Lang::getKey("no_pinned_website"); ?>');
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

function addWebsite()
{
	var website = {
		icon: $('#addWebsite input[name=icon]').val(),
		title: $('#addWebsite input[name=title]').val(),
		url: $('#addWebsite input[name=url]').val()
	};
	
	if(website.url=='')
	{
		alert('<?= Lang::getKey("please_enter_url_address"); ?>');
		return;
	}
	
	pinnedWebsites.push(website);
	localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
	alert('<?= Lang::getKey("shortcut_added_successfully"); ?>');
	closeWindow('#addWebsite');
	resetForm();
	updateView();
}

function popupAddWebsite()
{
	openWindow('#addWebsite');
}

function editWebsite()
{
	openWindow('#editWebsite');
	
    let item = pinnedWebsites[currentContextItem];
	$('#editWebsite input[name=title]').val(item.title);
	$('#editWebsite input[name=icon]').val(item.icon);
	$('#editWebsite input[name=url]').val(item.url);
	$('#editWebsite .icon').attr('src',item.icon);
}

function saveChanges()
{
    let item = pinnedWebsites[currentContextItem];
	item.title = $('#editWebsite input[name=title]').val();
	item.icon = $('#editWebsite input[name=icon]').val();
	item.url = $('#editWebsite input[name=url]').val();
    
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
    let message = '<?= Lang::getKey("remove_the_website_from_favorite"); ?>';
    message = message.replace('%website%',pinnedWebsites[currentContextItem].title);
    
    if(confirm(message))
    {
        pinnedWebsites.splice(currentContextItem, 1);
	    localStorage['pinnedWebsites'] = JSON.stringify(pinnedWebsites);
        updateView();
    }
}

function resetForm()
{
	$('#addWebsite input[name=title]').val('<?= Lang::getKey("website_title"); ?>');
	$('#addWebsite input[name=icon]').val('res/img/page.png');
	$('#addWebsite input[name=url]').val('http://www.domaine.com');
	$('#editWebsite input[name=title]').val('');
	$('#editWebsite input[name=icon]').val('');
	$('#editWebsite input[name=url]').val('');
	$('#addWebsite .icon, #editWebsite .icon').attr('src','res/img/page.png');
}