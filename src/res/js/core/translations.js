var Translations = function() {
    this.lang = 'fr-FR';
    this.data = '';
    this.module = '';
	this.isLoading = false;
	this.queue = [];
};

Translations.prototype = {
    // Set lang
    setLang : function(lang) {
		// if lang contains 5 char and folder exist, do this
        this.lang = lang;
		this.isLoading = true;
		
		let that = this;
		$.ajax({ 
			url: 'res/feed/translations.php',
			success: function(data) {
				that.data = data;
				that.isLoading = false;
				
				for(var i=0; i<that.queue.length; i++) 
					that.queue[i]();
				that.queue = [];
			},
			error: function(e) {
				console.log('Translations cannot be loaded. Error ='+e);
				that.isLoading = false;
			}
		});
    },
    // Set module
    setModule : function(module) {
		// If file exist, parse it and put it into this.module
        this.module = module;
    },
    // Get text from a key
    getText : function(key, defaultText='', afterLoading=function(){}) {
		if(this.isLoading) {
			this.queue.push(afterLoading);
			return defaultText;
		}
		if(typeof this.data[this.module+'.ini'][key] !== 'undefined')
        	return this.data[this.module+'.ini'][key];
		else
			return defaultText;
    }
};