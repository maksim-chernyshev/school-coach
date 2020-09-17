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
  if ()
    $email = '';
    $phone = '';
  if(stristr($_POST['contact'], '@') === true) {
    $email = $_POST['contact'];
    $phone = '';
  }
  if(stristr($_POST['contact'], '@') === true) {
    $email = '';
    $phone = $_POST['contact'];
  }

	$body='';
	if ($_POST['name']) $body.='Имя: '.$_POST['name'].'<br>';
	if ($_POST['contact']) $body.='Email: '.$email.'<br>Телефон: '.$phone;
	if ($_POST['level']) $body.='Класс: '.$_POST['level'].'<br>';

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

		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

}
?>
