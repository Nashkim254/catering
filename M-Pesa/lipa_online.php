<?php

  $consumerKey = 'qjGxvBNQKWlov43TEMlGqqOXmLMONf6G'; 
  $consumerSecret = 'qWMXjbaBC3qfg6sS'; 
  $headers = ['Content-Type:application/json; charset=utf8'];
  $token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';



  $curl = curl_init($token_url);

  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

  curl_setopt($curl, CURLOPT_HEADER, FALSE);

  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  //echo $access_token;
  curl_close($curl);






$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' => '600361',
  'Password' => '',
  'Timestamp' => date(''),
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount"' => '1',
  'PartyA' => ' ',
  'PartyB' => ' ',
  'PhoneNumber' => ' ',
  'CallBackURL' => 'https://ip_address:port/callback',
  'AccountReference' => ' ',
  'TransactionDesc' => ' '
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>