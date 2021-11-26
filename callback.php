<?php

require './functions.php';

$alienTokenOne = $_GET['one'];
$alienTokenTwo = $_GET['two'];
$alienTokenThree = $_GET['three'];
$alienTokenFour = $_GET['four'];
$token = $_GET['token'];
$payer_id = $_GET['PayerID'];

capture_order($token, $payer_id);
echo nl2br("\n\n\n\n\n");

$alienTokens = generateMultiToken($alienTokenOne, $alienTokenTwo, $alienTokenThree, $alienTokenFour);

echo nl2br("Here are your tokens: \n");
unrollTokens($alienTokens);

?>
