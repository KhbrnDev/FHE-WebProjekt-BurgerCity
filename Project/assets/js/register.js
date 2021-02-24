

document.addEventListener('DOMContentLoaded', function () {

    var submit = document.getElementById('signin');

    submit.addEventListener('click', function (event)
    {
        if(window.XMLHttpRequest)
        {
            event.preventDefault();
            event.stopPropagation();

            var request = new XMLHttpRequest();
            request.open('POST', 'index.php?c=account&a=LogInSignIn&ajax=1');

            request.onreadystatechange = function () {
                if(this.readyState == 4) // this.readyState = XMLHttpRequest.Done
                {
                    if(this.status == 200)
                    {
                        var jsonResponse = null;
                        try 
                        {
                            jsonResponse = JSON.parse(this.response);
                        } 
                        catch (e) 
                        {
                            console.log(e);
                        }

                        if(jsonResponse !== null)
                        {
                            console.log(jsonResponse);
                            if(jsonResponse['success'] == undefined && jsonResponse['errors'] !== undefined) // error
                            {
                                var errorsDiv = document.getElementById('js-errors');
                                var errorTitle = document.getElementById('js-errors-head');
                                var errorsUL = document.getElementById('js-errors-ul');
                                
                                errorsDiv.style.display = "block";
                                errorTitle.innerHTML = jsonResponse['errors']['title'];       

                                for (var index = 0; index < Object.keys(jsonResponse['errors']).length - 1; index++) 
                                {
                                    console.log(jsonResponse['errors'][0]);
                                    errorsUL.innerHTML += "<li>" + jsonResponse['errors'][index] + "</li>"
                                }
                                
                            }
                            else // success
                            {
                                var successDiv = document.getElementById('js-success');
                                var successTitle = document.getElementById('js-success-head');
                                var loginEmail = document.getElementById('login-email');

                                successDiv.style.display = "block";
                                successTitle.innerHTML = jsonResponse['success']['message'];
                                loginEmail.value = jsonResponse['preload']['logEmail'];
                                
                                // deleting input values from singin form
                                var firstName = document.getElementById('firstname');
                                var lastName = document.getElementById('lastname');
                                var birthday = document.getElementById('birthday');
                                var phonenumber = document.getElementById('phonenumber');
                                var email = document.getElementById('email');
                                var password = document.getElementById('password');

                                firstName.value   = "";
                                lastName.value    = "";
                                birthday.value    = "";
                                phonenumber.value = "";
                                email.value       = "";
                                password.value    = "";
                                

                            }
                        }

                    }
                    else
                    {
                        alert('Ein unerwarteter Fehler ist aufgetreten');
                    }
                }
            };

            var signinForm = document.getElementById('signinForm');
            request.send(new FormData(signinForm));
        }


        





    });


});