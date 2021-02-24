

document.addEventListener('DOMContentLoaded', function () {

    var submit = document.getElementById('loadMore');

    submit.addEventListener('click', function (event)
    {
        if(window.XMLHttpRequest)
        {
            event.preventDefault();
            event.stopPropagation();

            var request = new XMLHttpRequest();
            request.open('POST', 'index.php?c=account&a=account&ajax=1');

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
                            // increase Button value
                            document.getElementById('js-offset').value = jsonResponse['offset'];
                            var ordersDiv = document.getElementById('account-orders');
                            jsonResponse['preloadOrders'].forEach(element => 
                            {
                                productsArray = "";
                                element['orderItems'].forEach(item => 
                                {
                                    productsPrice = item['product']['price'] * item['quantity'];
                                    productsArray +=  
                                    "<div class = \"order-element\">"+
                                        "<a class = \"left\">"+ item['quantity'] + " " + item['product']['description'] + "</a>"+
                                        "<a class = \"right\">"+ productsPrice + " €</a>"+
                                    "</div>"
                                });
                                // maybe bad stye, but it works -> DO NOT TOUCH IT
                                ordersDiv.innerHTML +=  
                                "<form class=\"account-orderlist-body\" method=\"post\">"+
                                    "<div class=\"account-orderlist-order\">"+ 
                                        "Bestellnummer " + element['orderId'] + " vom " + element['orderDate']+
                                        "<div class=\"account-order-box\">"+
                                            "<div class=\"account-order-subbox\">" +
                                                "<p>Lieferadresse</p>"+
                                                "<p class=\"text\">"+ element['adress']['street'] + element['adress']['number'] + "</p>" +
                                                "<p class=\"text\">"+ element['adress']['zipCode'] + element['adress']['city'] + "</p>" +
                                            "</div>"+
                                            "<div class=\"account-order-subbox\">" +
                                                "<h4>Bestellte Produkte</h4>"+
                                                productsArray +
                                            "</div>"+
                                            "<div class=\"account-order-subbox\">" +
                                                "<input style=\"display:none;\" type=\"text\" name=\"orderId\" value=\""+ element['orderId']+ "\" readonly required>" +
                                                "<br>"+
                                                "<a class = \"left\">Gesamtpreis</a>"+
                                                "<a class= \"right\">"+ element['totalPrice'] +" €</a>" +
                                                "<br>" +
                                                "<input type=\"submit\" name=\"repeatOrder\" value=\"Erneut Bestellen\"></input> "+
                                            "</div>"+
                                        "</div"+
                                    "</div>"+
                                "</form>";
                            });
                            
                        }
                        
                        console.log(jsonResponse['preloadOrders'][0]);

                    }
                    else
                    {
                        alert('Ein unerwarteter Fehler ist aufgetreten');
                    }
                }
            };
            var offsetForm = document.getElementById('js-loadMore');
            request.send(new FormData(offsetForm));
        }
    });
});