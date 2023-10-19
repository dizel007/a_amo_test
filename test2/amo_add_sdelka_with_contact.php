<?php

require_once 'access.php';


$data_temp[] = array (
    "name" => "Новая сделка тест 22001",
    "created_by" => 0,
    "price" => 199990,
    "custom_fields_values" => array 
    (
        array (
        "field_id" => 2454277,
        "values" => array(array ("value" => "https://brazel.ru/?transition=30&id=3319")) // ссылка на корректировку КП
        ),
    
        array (
            "field_id" => 2455525,
            "values" => array(array ("value" => "https://brazel.ru/EXCEL/%E2%84%96214%D0%95%20%D0%BE%D1%82%2017.03.2022%20%D0%9E%D0%9E%D0%9E%20%D0%A1%D0%A2%D0%A0%D0%9E%D0%99%D0%A2%D0%A0%D0%90%D0%9D%D0%A1%20(%D0%9A%D0%9F%20%D0%BA%20%D0%B7%D0%B0%D0%BA%D1%83%D0%BF%D0%BA%D0%B5%E2%84%9632211056310)%20%D0%9E%D0%9E%D0%9E%20%D0%A2%D0%94%20%D0%90%D0%9D%D0%9C%D0%90%D0%9A%D0%A1.pdf")) // ссылка на ПДФ КП
        )        
    
        ),

    "_embedded" =>array(
        "contacts" => array( // данные контакта
               array (
                  "name" => "Жучака",
                  "first_name" => "Антоха",
                  "last_name" => "Пиндоха",
                   "custom_fields_values" => array(

///// КОНТАКТЫ //////////////////////////////////////////////////////////////////
          //// Рабочий /////
                     array(
                         "field_name" => "Телефон",
                         "field_code" => "PHONE",
                         "values" => array(
                             array(
                                "value" => 9999956951,
                                "enum_code" => "WORK"
                                    )
                             )
                           ) ,
          //// Мобильный /////                 
                     array(
                     "field_name" => "Телефон",
                     "field_code" => "PHONE",
                     "values" => array(
                           array(
                              "value" => 9999956951,
                              "enum_code" => "MOB"
                                 )
                           ),
                           
           //// Другой /////                          
                        ),
                        array(
                           "field_name" => "Телефон",
                           "field_code" => "PHONE",
                           "values" => array(
                                 array(
                                    "value" => 9999956951,
                                    "enum_code" => "OTHER"
                                       )
                                 ),
                                 
                                 
                              ),
  
///// Должноссть //////////////////////////////////////////////////////////////////
                  array(
                     "field_name" => "Должность",
                     "field_code" => "POSITION",
                     "values" => array(
                        array(
                           "value" => "Хер в зимнем Пальто",
                              )
                        )
                        
                        
                     )

                      )
                   ),
              ),
      //   "companies" => array(
      //    "name" => array ("value" =>"ООО Рога и Копыта"),
      //         )

    )
);



echo "<pre>";
// print_r($data_temp);

// die ('8888888');
$data2 = json_encode($data_temp, JSON_UNESCAPED_UNICODE);

// print_r($data2);

$method = "/api/v4/leads/complex";

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
];



echo "<br><br>";
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, $data2);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$out = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$code = (int) $code;
$errors = [
    301 => 'Moved permanently.',
    400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
    401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
    403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
    404 => 'Not found.',
    500 => 'Internal server error.',
    502 => 'Bad gateway.',
    503 => 'Service unavailable.'
];

echo "<pre>";
print_r(json_decode($out, true));


if ($code < 200 || $code > 204) die( "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error') );


