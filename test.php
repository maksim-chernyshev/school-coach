<?php

$contact = '89118990900';
$email = '';
$phone = '';

if(strpos($contact, '@') !== false) {
$email = $contact;
$phone = '';
}

if(strpos($contact, '@') === false) {
$email = '';
$phone = $contact;
}

echo "Email: ".$email.'<br> Phone: '.$phone.'<br>';

?>
