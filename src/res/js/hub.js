$(function(){
    /* Redirection si les données en localStorage ne sont pas à jour ou inexistantes */
    let isntUpToDate = typeof localStorage['doosearchVersion'] ==  'undefined' || localStorage['doosearchVersion'] < 1.33;
    let isntSetup = document.location.pathname.match(/[^\/]+$/)[0] != 'setup.php';

    if(isntUpToDate && isntSetup)
        document.location.href='setup.php';
    else if(!isntUpToDate && !isntSetup)
        document.location.href='search.php';
    
    $('body').keypress(function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == 27) // Si la touche 'echap' est appuyé
            closeAllPopups();
    });
});

function closeAllPopups()
{
    if(typeof listSearchEngines !== 'undefined') // Si les moteurs sont utilisés sur la page
    {
        if($('.panel').css('display')!='none')
            showMotors();
        if($('.menuEngine').css('display')!='none')
            hideMenuEngine();
    }
    if(typeof closeWindow !== 'undefined') // Si la fonction closeWindow existe (alors ça signifie qu'on est dans la page quickaccess.php)
    {
        closeWindow('#addWebsite');
        closeWindow('#editWebsite');
        resetForm();
    }
    if(typeof showEditor !== 'undefined') // Si la fonction showColorSelector existe (alors ça signifie qu'on est dans la page config.php)
    {
        if($('#editBgImg').css('display')!='none')
            showEditor('#editBgImg');
    }
    if(typeof showColorSelector !== 'undefined') // Si la fonction showColorSelector existe (alors ça signifie qu'on est dans la page config.php ou setup.php)
        showColorSelector(false);
}