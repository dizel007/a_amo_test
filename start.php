<?php
ob_end_clean();
require_once 'connect_db.php';
require_once 'amo_setup.php';
require_once 'access.php';
require_once 'parts/functions.php';
require_once 'parts/functions_amo.php';
$connect_data['access_token'] = $access_token ;
// echo "<br>";
$connect_data['subdomain'] = $subdomain;
// echo "<br>";


  // Вычитываем все телефоны с таким ИНН
  $stmt = $pdo->prepare("SELECT id,InnCustomer, NameCustomer FROM reestrkp ORDER BY id DESC LIMIT 20");
  $stmt->execute([]);
  $arr_inn_name = $stmt->fetchAll(PDO::FETCH_ASSOC);

//   echo"<pre>";
// print_r($arr_inn_name);
// die();

foreach ($arr_inn_name as $j_inn) {
  set_time_limit(120);
  echo "<br><b>SET_LIMIT_120</b><br>";
  echo "<br><b>*************************************************************************************************</b><br>";
  $id = $j_inn['id'];
  $inn = $j_inn['InnCustomer'];
  
    if ($inn !=0) {  /// проверяем если ли ИНН в сделке
        $inn_our_company = find_company_by_inn ($connect_data, $inn); // ищем есть ли такой ИНН в АМО
      if ($inn_our_company == null)  { // проверяем есть ли такой ИНН в АМО
        require "parts/parts_with_inn.php";
      } else {
                   echo "<br>Eсть Компания с ИНН : $inn <br>";
             }
     } else  {
        echo "<br> NENE ";
        // require "parts/parts_without_inn.php";
        // require "add_sdelka.php";

    }

    sleep(1);

}




