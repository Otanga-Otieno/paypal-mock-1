<?php

include "functions.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $tokenOne = $_POST['qty1'];
    $tokenTwo = $_POST['qty2'];
    $tokenThree = $_POST['qty3'];
    $tokenFour = $_POST['qty4'];
    $amount = ($tokenOne * 0.05) + ($tokenTwo * 0.1) + ($tokenThree * 0.25) + ($tokenFour * 0.5);
    post_order($amount, $tokenOne, $tokenTwo, $tokenThree, $tokenFour);
}