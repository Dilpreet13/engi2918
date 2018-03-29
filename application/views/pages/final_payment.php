<div class="container">
    <div class="jumbotron">
        <h1 class="display-3"><?php echo $product['name']; ?></h1>
        <p class="lead"></p>

    </div>

    <div class="row">

        <div class="col-lg-8 col-md-10 col-12">

            <p>
                You will be charged <?php echo "$".$product['cur_price']; ?>
            </p>
            <p>
                Continue?
            </p>
            <a href="<?php echo site_url('products/reserve_product').'/'.$product['id'];?> "><button class="btn btn-success">Finalize Payment</button></a>

        </div>

        <script src="https://www.paypalobjects.com/api/checkout.js"></script>

        <div id="paypal-button-container"></div>

        <script>

            // Render the PayPal button

            paypal.Button.render({

                // Set your environment

                env: 'sandbox', // sandbox | production

                // Specify the style of the button

                style: {
                    label: 'buynow',
                    fundingicons: true, // optional
                    branding: true, // optional
                    size:  'small', // small | medium | large | responsive
                    shape: 'rect',   // pill | rect
                    color: 'gold'   // gold | blue | silve | black
                },

                // PayPal Client IDs - replace with your own
                // Create a PayPal app: https://developer.paypal.com/developer/applications/create

                client: {
                    sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: 'access_token$sandbox$zqyd7wt4hg46cywp$080ad035e3e63151adbb0942f9edcece'
                },

                // Wait for the PayPal button to be clicked

                payment: function(data, actions) {
                    return actions.payment.create({
                        transactions: [
                            {
                                amount: { total: '0.01', currency: 'USD' }
                            }
                        ]
                    });
                },

                // Wait for the payment to be authorized by the customer

                onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function() {
                        window.alert('Payment Complete!');
                    });
                }

            }, '#paypal-button-container');

        </script>


    </div>


</div>