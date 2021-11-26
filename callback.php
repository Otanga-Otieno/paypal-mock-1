<?php

require './functions.php';

$alienTokenOne = $_GET['one'];
$alienTokenTwo = $_GET['two'];
$alienTokenThree = $_GET['three'];
$alienTokenFour = $_GET['four'];
$token = $_GET['token'];
$payer_id = $_GET['PayerID'];

capture_order($token, $payer_id);

?>
