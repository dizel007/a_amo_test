<?php

echo "<pre>";
// $data = '
// [
//     {
//         "name": "ЗАРАБОТАЛО5656 СУЧАРА",
//         "created_by": 0,
//         "price": 20000

//     }
// ]
// ';




$data = '[{"name": "ЗАРАБОТАЛО5656 СУЧАРА","created_by": 0,"price": 20000}]';





// $date = json_decode ($data, true);

var_dump($data);

// $date = json_encode($data_temp);

$data_temp[] = array (
      "name" => "Сделка бля sdlfgj;lkdf;lksdfm;lksdmf",
      "created_by" => 0,
      "price" => 20000


);

$data2 = json_encode($data_temp, JSON_UNESCAPED_UNICODE);
var_dump($data2);


// die();


