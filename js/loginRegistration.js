(function(jQuery){
    var loginShowPasswordCheckbox = $("form#loginForm input#showPasswordCheckbox"),
        loginPasswordTextField = $('form#loginForm input#passwordTextField'),
        registrationShowPasswordCheckbox = $("form#registrationForm input#showPasswordCheckbox"),
        registrationPasswordTextField = $("form#registrationForm input#passwordTextField");

    loginShowPasswordCheckbox.change(function(){
        if(loginShowPasswordCheckbox.prop('checked')){
            loginPasswordTextField.prop("type", "text");
        } else {
            loginPasswordTextField.prop("type", "password");
        }
    });

    registrationShowPasswordCheckbox.change(function(){
        if(registrationShowPasswordCheckbox.prop('checked')){
            registrationPasswordTextField.prop("type", "text");
        } else {
            registrationPasswordTextField.prop("type", "password");
        }
    });

}($));
