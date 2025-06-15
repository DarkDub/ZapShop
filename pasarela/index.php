<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Ad4mFrgbNaa4ulZNi7Plx0-e_jGeHV80zQYcwYjHaFwXvQ_Y2xLBYxbhb7xZiAXNa6IbYrlmM2MUx0vM&currency=USD"></script>
</head>
<body>

    <div id="paypal-button"></div>
    <script>
        paypal.Buttons({
            style:{
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 100
                        }
                    }] 
                });
            },
            onApprove: function(data, actions){
                actions.order.capture().then(function (detalles){
                    console.log(detalles);
                    window.location.href="../completado.html";

                });

            },
            onCancel: function(data){
                alert("pago canselado"); 
            }
        }).render('#paypal-button');
    </script>
</body>
</html>