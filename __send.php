<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $subject='Сообщение с сайта';
	if ($_POST['highlevel']) $subject=$_POST['highlevel'];
    $from = 'school.coach2@yandex.ru';
  if (stristr($_POST['contact'], '@')) $from = $_POST['contact'];

	$body='';
	if ($_POST['name']) $body.='Имя: '.$_POST['name'].'<br>';
	if ($_POST['contact']) $body.='Телефон или email: '.$_POST['contact'].'<br>';
	if ($_POST['level']) $body.='Класс: '.$_POST['level'].'<br>';

	$to  = 'shcool.coach@yandex.ru';
	$message = $body;

	$headers  = "Content-type: text/html; charset=utf-8 \r\n";
	$headers.= "From: ".$from."\r\n";

	if (mail($to, $subject, $message, $headers)) echo $_POST['name'];
}
?>
