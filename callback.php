<?php

require './functions.php';

$token = $_GET['token'];
$payer_id = $_GET['PayerID'];

capture_order($token, $payer_id);

?>
