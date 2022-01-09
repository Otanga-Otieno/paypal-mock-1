<?php

require './functions.php';

//Get quantity of each token
$alienTokenOne = $_GET['one'];
$alienTokenTwo = $_GET['two'];
$alienTokenThree = $_GET['three'];
$alienTokenFour = $_GET['four'];
$token = $_GET['token'];
$payer_id = $_GET['PayerID'];

//Capture order, generate and send tokens via email
$order = capture_order($token, $payer_id);
$email = $order["payer"]["email_address"];

$alienTokens = generateMultiToken($alienTokenOne, $alienTokenTwo, $alienTokenThree, $alienTokenFour);

echo nl2br("Here are your tokens, they will be sent to your PayPal email too: \n");
unrollTokens($alienTokens);
send_tokens($email, $alienTokens);

?>
