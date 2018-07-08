$(function(){
    updateListSearchEngine(); // Chargement des moteurs disponibles
    
    $('#findEngine').on('input',function(e) {
        var query = $('#findEngine').val(); // On récupère les termes saisis par l'utilisateur
        for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        {
            let engine = listSearchEngines[i];
            if(query.size=='' || engine.title.toLowerCase().includes(query.toLowerCase()))
                $('#search-engine-'+i).fadeIn();
            else
                $('#search-engine-'+i).fadeOut();
        }
    });
});

var SearchEngine = function(title, icon, urlPrefix, urlSuffix) { // Constructeur de SearchEngine
    this.icon = icon;
    this.title = title;
    this.urlPrefix = urlPrefix;
    this.urlSuffix = urlSuffix;
};

SearchEngine.prototype = {
    // Cette fonction sert à générer l'url
    generateUrl : function(query){
        return this.urlPrefix + query + this.urlSuffix;
    }
};

var listSearchEngines = []; // Liste des moteurs disponible
(function(){
    var item = new SearchEngine('Demander plus tard','res/img/choose.png','','');
    listSearchEngines.push(item); // Ajout du moteur "nul"
})();

function updateListSearchEngine()
{
    for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
    {
        let engine = listSearchEngines[i];
        
        let button = $('<li/>');
        button.attr('id','search-engine-'+i);
        button.click(function(){setSearchEngine(i);});
        var icon = $('<img/>').attr('src', engine.icon);
        var text = $('<p/>').html(engine.title);
        button.append(icon).append(text);
        $('.listMotors ul').append(button);
    }
}

function clearSearchBar()
{
    $('#findEngine').val(''); 
    for(let i=0; i<listSearchEngines.length; i++) // Pour chaque moteur
        $('#search-engine-'+i).fadeIn();
}