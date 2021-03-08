<?php

$json = file_get_contents('php://input');
$arr = json_decode($json, true);
print_r($arr);

?>
