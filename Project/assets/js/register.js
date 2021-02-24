


document.addEventListener('DOMContentLoaded', function () {

    var submit = document.getElementById('signin');

    submit.addEventListener('click', function (event)
    {
        if(window.XMLHttpRequest)
        {
            submit.value = "!1";
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

                            if(jsonResponse['success'] == undefined && jsonResponse['errors'] !== undefined) // error
                            {
                                var errorsDiv = document.getElementById('errors');
                                var errorTitle = document.getElementById('errorTitle');
                                errorTitle.innerHTML = "test";       
                                for (var index = 0; index < Object.keys(jsonResponse['erros']).length - 1; index++) 
                                {
                                }
                                console.log(Object.keys(jsonResponse['preload']).length);
                                console.log(jsonResponse['preload']);
                            }
                            else // success
                            {

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