<?php

function get_access_token() {

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
  return $token;

}





function post_order($amount, $one, $two, $three, $four) {

  $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders";

  $curl = curl_init();
  $access_token = get_access_token();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));
  $curl_post_data = '{
      "intent": "CAPTURE",
      "purchase_units": [
        {
          "amount": {
            "currency_code": "USD",
            "value": "'.$amount.'"
          }
        }
      ],
      "application_context": {
          "return_url": "https://otanga.co.ke/Projects/PayPal-Mock-App/callback.php?one='.$one.'&two='.$two.'&three='.$three.'&four='.$four.'"
      }
    }';
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	
  $curl_response = curl_exec($curl);

  $json = json_decode($curl_response, true);
  print_r($json);

  $approve_link = $json['links'][1]['href'];
  header('Location: '.$approve_link);


}





function capture_order($token, $payer_id) {

  $url = "https://api.sandbox.paypal.com/v2/checkout/orders/$token/capture";
  $access_token = get_access_token();

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Authorization:Bearer '.$access_token,
    'PayPal-Request-Id: '.$payer_id)
  );
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	
  $curl_response = curl_exec($curl);

  $arr = json_decode($curl_response, true);
  return $arr;

}


function get_invoice_number() {

  $url = "https://api-m.sandbox.paypal.com/v2/invoicing/generate-next-invoice-number";
  $access_token = get_access_token();

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content_Type:application/json',
    'Authorization:Bearer '.$access_token)
  );
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	
  $curl_response = curl_exec($curl);

  $arr = json_decode($curl_response, true);
  print_r($arr);

}

/*************************** Token functions ***************************/

function generateAlienTokens($type, $quantity) {

  $arr = [];

  for($i=0; $i<$quantity; $i++) {
      $token = bin2hex(openssl_random_pseudo_bytes(5*$type));
      array_push($arr, $token);
  }

  return $arr;

}

function generateMultiToken($one, $two, $three, $four) {
  $arr = array();

  if ($one > 0) $arr = array_merge($arr, generateAlienTokens(1, $one));
  if ($two> 0) $arr = array_merge($arr, generateAlienTokens(2, $two));
  if ($three > 0) $arr = array_merge($arr, generateAlienTokens(3, $three));
  if ($four > 0) $arr = array_merge($arr, $t = generateAlienTokens(4, $four));

  return $arr;
}


function getTokenType($token) {

  $len = strlen($token);

  switch($token) {
      case 10:
          return "Kepler-186f";
          break;
      case 20:
          return "Kepler-452b";
          break;
      case 30:
          return "Kepler-22b";
          break;
      default:
          return "Gliese 667 Cc";
  }

}

function unrollTokens($arr) {
  $size = count($arr);

  for($i=0; $i<$size; $i++) {
      echo nl2br($arr[$i]." - ".getTokenType($arr[$i])."\n");
  }

}

?>