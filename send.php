<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $subject='Сообщение с сайта';
	if ($_POST['highlevel']) $subject=$_POST['highlevel'];

    $email = 'none';
    $phone = 'none';
  if(strpos($_POST['contact'], '@') !== false) {
    $email = $_POST['contact'];
  }
  if(strpos($_POST['contact'], '@') === false) {
    $phone = $_POST['contact'];
  }

	$body='<html><meta http-equiv="Content-Type"  content="text/html charset=UTF-8" /></html><body>';
	if ($_POST['name']) $body.='Имя: '.$_POST['name'].'<br>';
	if ($_POST['contact']) $body.='Email: '.$email.'<br>Телефон: '.$phone.'<br>';
	if ($_POST['level']) $body.='Класс: '.$_POST['level'].'<br>';
  $body .= '</body>';

	$message = $body;

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();

		$mail->Host = 'smtp.yandex.com';
		$mail->Port = 587;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "tls";
		$mail->Username = 'school.coach2@yandex.ru';
		$mail->Password = 'cuM07Pin';

		//Recipients
		$mail->setFrom('school.coach2@yandex.ru', 'School');
		$mail->addAddress('school.coach@yandex.ru', 'School');


		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
    $mail->CharSet = 'UTF-8';
    //$mail->Encoding = "16bit";

		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

}
?>
