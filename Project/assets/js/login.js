
// disbale Login Button to have a similar design with signin
// is activated when input is valid

document.addEventListener('DOMContentLoaded', function () {
    var emailRegEx = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    var passwordRegEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    // get Input
    var loginEmail = document.getElementById('login-email');
    var loginPassword = document.getElementById('login-password');
    var loginSubmit = document.getElementById('login');
    
    loginSubmit.disabled = true;
    function activateLoginSubmit()
    {
        if(loginEmail.value.length == 0 || loginPassword.value.length == 0)
        {
            loginSubmit.disabled = true;
        }
    }

    loginEmail.addEventListener('focusout', function() {
        if (loginEmail.value.match(emailRegEx)) 
        {
            loginSubmit.disabled = false;
            activateLoginSubmit();
            return;
        }
        else
        {
            loginSubmit.disabled = true;
            return;
        }
    });

    loginPassword.addEventListener('focusout', function() {
        if (loginPassword.value.match(passwordRegEx)) 
        {
            loginSubmit.disabled = false;
            activateLoginSubmit(); 
            return;
        }
        else
        {
            loginSubmit.disabled = true;
            return;
        }
        });
});