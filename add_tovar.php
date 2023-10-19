<?php
require_once 'access.php';
require_once 'parts/functions.php';
require_once 'parts/functions_amo.php';
$connect_data['access_token'] = $access_token ;
$connect_data['subdomain'] = $subdomain;

$data_temp [] = array(
//*******************  Название товара   ************************************
        "name" => "Лоток для воды ", 
        "custom_fields_values" => array(
//*******************  Группв  товара ************************************
            array("field_id" => 2443035, 
                  "values" => array (array("value" => "объектные"))
            ),
// *******************  Цена  товара *******************************************
            array("field_id" => 2443033, // Цена  товара
                  "values" => array (array("value" => 1000))
                 ),
//*******************  Единица измерения  товара ************************************
            array("field_id" => 2443039, 
                  "values" => array (array("value" => "шт"))
                 )
        )
);


$data = json_encode($data_temp, JSON_UNESCAPED_UNICODE);
$method = "/api/v4/catalogs/12549/elements" ;
$res = post_query_in_amo($access_token, $subdomain , $method , $data);
$id_tovara = $res['_embedded']['elements'][0]['id'];

echo "<br><br>";
echo $id_tovara;
echo "<br><br>";


$data_temp =  array( array(   
    "to_entity_id" => $id_tovara,
    "to_entity_type" => "catalog_elements",
    "metadata"=> array (
        "quantity" => 100,
        "catalog_id" => 12549
            )       

    ));
    
$data = json_encode($data_temp, JSON_UNESCAPED_UNICODE);

$method = "/api/v4/leads/39542327/link";

$res = post_query_in_amo($access_token, $subdomain , $method , $data);

echo "<pre>";
print_r($res);




