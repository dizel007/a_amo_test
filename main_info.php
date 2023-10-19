<?php
// Подюключение к БД
$host="localhost";//имя  сервера
$user="root";//имя пользователя
$password="";//пароль
$db="brazel_reestr";//имя  базы данных

$reestrKP = "reestrkp"; // 
$reestrINN = "";

/* 
* КОНСТАНТЫ
*/
define('PAGE_ITEMS', 200); // количество КП выводимых на странице
define('TEXT_KP_INFO', 'В ответ на Ваш запрос предлагаем рассмотреть приобретение продукции на следующих условиях:'); // Текст для первой строчки КП
define('TEXT_ADRESS_IF_NO_ADRESS', 'По согласованию сторон');
define('TEXT_USLOVIA_OPLATI_DEFAULT','По согласованию сторон');
define('TEXT_USLOVIA_IZGOTOVLEBIA_DEFAULT','По согласованию сторон');
define('TEXT_PERED_ADRESOM_DOSTAVKI','Примерная стоимость доставки до объекта ');


define('ALARM_EMAIL_ADRESS', 'tender@anmaks.ru'); // количество КП выводимых на странице


