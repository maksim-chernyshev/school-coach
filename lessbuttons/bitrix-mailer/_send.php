<?php
define('CRM_HOST', 'b24-ozc9w6.bitrix24.ru'); // Указываем Ваш домен в CRM
define('CRM_PORT', '443'); // Порт сервера CRM. Установлен по умолчанию, не меняем
define('CRM_PATH', '/crm/configs/import/lead.php');

define('CRM_LOGIN', 'm.leonov@author24.ru'); // Логин пользователя Вашей CRM
define('CRM_PASSWORD', 'gofric-vukfu0-caqJem'); // Пароль пользователя Вашей CRM

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $email = '';
 $phone = '';
 $level = $_POST['level'];
 $name = $_POST['name'];//получаем данные из поля Имя
 $contact = $_POST['contact']; //получаем данные из поля Телефон
 if (strpos($contact, '@') !== false)
 {
   $email = $contact;
 }
 else {
   $phone = $contact;
 };

   $postData = array(
      'TITLE' => 'Новая заявка '.$level, // заголовок для лида
     'NAME' => $name,
    'PHONE_MOBILE' => $phone,
    'EMAIL_WORK' => $email,
    'SOURCE_ID' => 'WEB'
   );

   if (defined('CRM_AUTH'))
   {
      $postData['AUTH'] = CRM_AUTH;
   }
   else
   {
      $postData['LOGIN'] = CRM_LOGIN;
      $postData['PASSWORD'] = CRM_PASSWORD;
   }

   $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
   if ($fp)
   {
      $strPostData = '';
      foreach ($postData as $key => $value)
         $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

      $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
      $str .= "Host: ".CRM_HOST."\r\n";
      $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
      $str .= "Content-Length: ".strlen($strPostData)."\r\n";
      $str .= "Connection: close\r\n\r\n";

      $str .= $strPostData;

      fwrite($fp, $str);

      $result = '';
      while (!feof($fp))
      {
         $result .= fgets($fp, 128);
      }
      fclose($fp);

      $response = explode("\r\n\r\n", $result);

      $output = '<pre>'.print_r($response[1], 1).'</pre>';
   }
   else
   {
      echo 'Connection Failed! '.$errstr.' ('.$errno.')';
   }
   }
$sendto   = "school.coach@yandex.ru";


$subject  = "Новая заявка с school.coach";
$headers  = "From: " . strip_tags("school.coach@yandex.ru") . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html;charset=utf-8 \r\n";

$msg  = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Новая заявка со scool.coach</h2>\r\n";
$msg .= "<p><strong>Sent by:</strong> ".$name."</p>\r\n";
$msg .= "<p><strong>Contact:</strong> ".$contact."</p>\r\n";
$msg .= "<p><strong>Level:</strong> ".$level."</p>\r\n";
$msg .= "</body></html>";


if(@mail($sendto, $subject, $msg, $headers)) {
	echo "true";
  echo $name." ".$contact." ".$level." ".$_POST['highlevel'];
} else {
	echo "false";
  echo $name." ".$contact." ".$level." ".$_POST['highlevel'];
}

?>
