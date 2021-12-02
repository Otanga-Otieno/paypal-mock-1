<?php

require './functions.php';

$alienTokenOne = $_GET['one'];
$alienTokenTwo = $_GET['two'];
$alienTokenThree = $_GET['three'];
$alienTokenFour = $_GET['four'];
$token = $_GET['token'];
$payer_id = $_GET['PayerID'];

$order = capture_order($token, $payer_id);
$email = "alvinotanga@gmail.com";//$order["payer"]["email_address"];
//echo nl2br($order["payer"]["email_address"]."\n\n");


$alienTokens = generateMultiToken($alienTokenOne, $alienTokenTwo, $alienTokenThree, $alienTokenFour);

echo nl2br("Here are your tokens, they will be sent to your PayPal email too: \n");
unrollTokens($alienTokens);
send_tokens($email, $alienTokens);

?>
