$(function() {
    $('.tabWidget input').change(function(){
        $('.tabContent label').hide();
        
        let id = $('.tabBar input[type=radio]:checked').attr('id');
        switch(id) {
            case 'tabAll':
                $('.tabContent label').removeAttr('style');
                break;
            case 'tabSelected':
                $('.tabContent input:checked + label').removeAttr('style');
                break;
            case 'tabNotSelected':
                $('.tabContent label').removeAttr('style');
                $('.tabContent input:checked + label').hide();
                break;
        }
    });
});