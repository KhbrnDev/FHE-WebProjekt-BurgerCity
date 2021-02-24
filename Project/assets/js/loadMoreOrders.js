

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
                            
                        }
                        
                        console.log(jsonResponse);

                    }
                    else
                    {
                        alert('Ein unerwarteter Fehler ist aufgetreten');
                    }
                }
            };

            request.send();
        }
    });
});