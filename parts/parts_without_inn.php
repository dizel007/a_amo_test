<?php

    echo "<br>Компания БЕЗ ИНН : $id КП Добавляем ТОЛЬКО СДЕЛКУ<br>";
// ************************* начинае мсоздавать компанию 
// echo "<br> Создание компании  ********************************************<br>";
  echo  $name_company = $j_inn['NameCustomer']; // Наименование компании


// ************************* Добавляем сделки к компаниям *******************************************
$stmt = $pdo->prepare("SELECT * FROM reestrkp WHERE id = $id");
$stmt->execute([]);
$arr_sdelki = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*******************************************************************
*  ***** Если у сделки нет ИНН то создае только сделку
**************************************************************** */
unset($res);
foreach ($arr_sdelki as $sdelki) {
$name_sdelka = "№".$sdelki['KpNumber']." от " .$sdelki['KpData'] ." ($name_company)";
echo "$name_sdelka ********************************************************************** СДЕЛКУ<br>";
$link_to_change_kp = 'https://brazel.ru/?transition=30&id='.$sdelki['id'];
$link_to_see_pdf = 'https://brazel.ru/'.$sdelki['LinkKp'];
$price_sdelka = (int)($sdelki['KpSum']);
$pipeline_id_2 = 7242730;
// формируем массив для созждания сделки
$data_sdelka2 = Make_simple_sdelka ($name_sdelka, $link_to_change_kp, $link_to_see_pdf, $price_sdelka, $pipeline_id_2); 
post_query_in_amo($access_token, $subdomain , '/api/v4/leads' , $data_sdelka2);
$id_sdelka = $res["_embedded"]["leads"][0]["id"]; // ID созданной сделки





















// ************** цепляем задачу к сделке  (если она есть)

    $DateNextCall = $sdelki['DateNextCall'];

    if ($DateNextCall != '0000-00-00') {
     
        $currentTime = strtotime($DateNextCall); // переводим время с 1980 года
        $data_temp5[] = array (
            "text" => "Звонок (API)",
            "complete_till" => $currentTime, 
            "entity_id" => $id_sdelka,
            "entity_type" => "leads"
    );
    $data = json_encode($data_temp5, JSON_UNESCAPED_UNICODE);
    $res = post_query_in_amo($access_token, $subdomain , "/api/v4/tasks" , $data);
    unset($data_temp5); // удаляем массив с задачами

    }
    
// ********************  Редактируем статус сделки  ***********************************************
$KpCondition = $sdelki['KpCondition'];
$Kpclosed = $sdelki['FinishContract'];
$time_status_sell = $sdelki['date_sell'];
$time_status_close = $sdelki['date_close'];
// echo "<br>SEL = $time_status_sell <br> CLOSE $time_status_close";
$data = change_status_sdelka ($id_sdelka, $KpCondition, $time_status_sell, $time_status_close, $Kpclosed);
// echo "<br>DATA = $data";
$res= send_patch_in_amo($access_token, $subdomain , "/api/v4/leads" , $data);



////  смена воронки принудительно еще  арз 
// $data = change_pipeline_sdelka ($id_sdelka, 7242730);
// $res= send_patch_in_amo($access_token, $subdomain , "/api/v4/leads" , $data);
}