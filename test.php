<?php

require "functions.php";

$email = "alvinotanga@gmail.com";

$alienTokens = generateMultiToken("1", "2", "2", "1");

echo nl2br("Here are your tokens, they will be sent to your PayPal email too: \n");
unrollTokens($alienTokens);
send_tokens($email, $alienTokens);