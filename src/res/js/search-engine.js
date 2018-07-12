var SearchEngine = function(title, icon, urlPrefix, urlSuffix) { // Constructeur de SearchEngine
    this.icon = icon;
    this.title = title;
    this.urlPrefix = urlPrefix;
    this.urlSuffix = urlSuffix;
    this.isSelected = false;
    this.id = 0;
};

SearchEngine.prototype = {
    // Cette fonction sert à générer l'url
    generateUrl : function(query){
        return this.urlPrefix + query + this.urlSuffix;
    },
    // Cette fonction sert à définir l'ID du moteur
    setID : function(id){
        this.id = id;
        return this;
    },
    // Cette fonction sert à changer le flag de isPinned
    setSelected : function(flag){
        if(flag==true)
            this.isSelected = true;
        else
            this.isSelected = false;
        
        return this;
    }
};