(function() {
    var password_confirmation = $('.password_confirmation');
    var password = $('.password');
    $('body').on('change', password_confirmation, function() {
        if (password_confirmation.val() != password.val()) {
            password_confirmation[0].setCustomValidity('Les deux mots de passe ne sont pas identiques.');
        }
        else {
            try {
                password_confirmation[0].setCustomValidity('');
            } catch(e) {};
        }
    });
})();