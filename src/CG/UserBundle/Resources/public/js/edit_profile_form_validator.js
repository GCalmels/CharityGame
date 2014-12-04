(function() {
    var fields = $('.positive-number-input');

    for (var i=0 ; i<fields.length ; i++)
    {
        $('body').on("invalid", fields[i], function() {
            $(this).setCustomValidity('Veuillez entrer un nombre positif');
        });
    
        $('body').on("change", fields[i], function() {
            try {
                $(this).setCustomValidity('');
            } catch(e) {};
        });
    }
});