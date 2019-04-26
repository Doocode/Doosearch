var App = function() {};
var Doosearch;

$(function(){
	// Init
	Doosearch = new App();
    Doosearch.versionNumber = 1.34;
    Doosearch.versionText = '1.3.4';
	
	// Init translation
	let t = new Translations();
	Doosearch.lang = t;
	t.setLang('en-GB');
});