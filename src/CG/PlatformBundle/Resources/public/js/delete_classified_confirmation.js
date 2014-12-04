(function() {   
    $('.cancel_delete_button').each(function(){
        $(this).on('click', function(){
            $(this).parent().parent().find('.delete_confirmation').hide();
        });
    });
    
    $('.delete_button').each(function(){
        $(this).on('click', function(){
            $(this).parent().find('.delete_confirmation').show();
        });
    });
    
})();