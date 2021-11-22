<?php

include "functions.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $amount = $_POST['amount'];
    post_order($amount);
}