<?php

//require 'functions.php';

$url = "https://api-m.sandbox.paypal.com/v1/oauth2/token";
$client_id = "ATH6jxOJg7yTVeBdOVGRvLfvMIt3re1o7VuChtJ2lWQV-PPWy9yGE9xRfRqexa6D9KNwDXV_-ktBodJh";
$client_secret = "EIdTvQ4W9K8dwr7RGJwmIMu2aNR2OpEKl4CyIIjepL4a4ggIw2grGIMfdOgcxxv1YOhyeFIxwp7T1k-g";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Accept-Language: en_US"
));
curl_setopt($curl, CURL_SSL_VERIFYPEER, false);
curl_setopt($curl, CURL_SSLVERSION, 6);
curl_setopt($curl, CURLOPT_USERPWD, $client_id.":".$client_secret);
curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$curl_response = curl_exec($curl);

$json = json_decode($curl_response, true);
$token = $json['access_token'];
print_r($token);

?>