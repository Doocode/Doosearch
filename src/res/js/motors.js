$(function(){
    updateListSearchEngine(); // Chargement des moteurs disponibles
});

var SearchEngine = function(title, icon, urlPrefix, urlSuffix) {
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

var listSearchEngines = [];
(function(){
    var item = new SearchEngine('Demander plus tard','res/img/choose.png','','');
    listSearchEngines.push(item);
})();

function updateListSearchEngine()
{
    for(let i=0; i<listSearchEngines.length; i++)
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