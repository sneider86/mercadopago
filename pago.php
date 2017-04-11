<?php
require_once "lib/mercadopago.php";
 
$mp = new MP('3121391224066490', 'W0LtO8zTvGx5g4pMClbNR0eurpqLoUSS');

//$mp->sandbox_mode(TRUE);

$preference_data = array(
    "items" => array(
        array(
            "title" => "Boleta",
            "currency_id" => "COP",
            "category_id" => "Evento",
            "quantity" => 1,
            "unit_price" => 10
        )
    ),
    "back_urls" => array(
		"success" => "https://www.success.com",
		"failure" => "http://www.failure.com",
		"pending" => "http://www.pending.com"
	),
);

$preference = $mp->create_preference($preference_data);
?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
       	<!-- <a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Pagar</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script> -->
        <a href="<?php echo $preference["response"]["sandbox_init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Pagar</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
    </body>
</html>