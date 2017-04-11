<?php
require_once "Class/MercadoPagoClass.php";
 
    $MP=new MercadoPagoClass(true);
    $MP->setTitulo('Boleta de Prueba');
    $MP->setCantidad(1);
    $MP->setPrecio(20000);

?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
        <?php echo $MP->generarBotonPago(); ?>
    </body>
</html>