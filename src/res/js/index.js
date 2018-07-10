$(function(){
	if (localStorage['doosearchVersion'] != null || localStorage['doosearchVersion'] == 1.32)
    {
		$('#btnSetup').css('display','none');
		$('#actions #btnSearch, #actions #btnQuickAccess, #actions #btnConfig').css('display','inline-block');
    }
});