<?php 
    
    $fecha = '2020-04-01';
    $total = 24000;

    $url = "http://intcontabilidad.azurewebsites.net/api/EntradaContables";    
    $json = '{
        "descripcion": "Entrada Contable para Enero",
        "fecha": "'.$fecha.'",
        "monto": 24000,
        "auxiliarId": 3,
        "detalleEntradaContable": [
            {
                "cuentaContableId": 6,
                "tipoMovimiento": "CR",
                "descripcion": "Inventario",
                "monto": 12000
            },
            {
                "cuentaContableId": 13,
                "tipoMovimiento": "DB",
                "descripcion": "Ingreso X Venta",
                "monto": 12000
            }
        ]
    }';

    //Initiate cURL.
    $ch = curl_init($url);

    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
    
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    //Set the content in response variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    //Execute the request
    $response = curl_exec($ch);

    //Converting json object to array
    $arr = json_decode($response);

    //Getting the id
    $id = $arr->id;

    if(curl_errno($ch)){
        echo 'Request Error:' . curl_error($ch);
    }

    // Check for errors
    if($response === FALSE){
        die(curl_error($ch));
    }
?>
