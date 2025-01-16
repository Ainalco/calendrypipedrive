<?php //Your Calendly Api token
$access_token='eyJraWQiOiIxY2UxZTEwerewtewzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzE3NTQ2MTg1LCJqdGkiOiIyMmU2M2VmNC1kOTUyLTQ0NTktOTc3NS0zN2NkYzY1YWU2MWUiLCJ1c2VyX3V1aWQiOiJDQ0ZFUURKTTJIUlJOT0w1In0.SAyHCOl-gdFJlyvqDYneoSrElvoPZ4zM29bJP9raWL-0omUhi9jCphW5UxukHP2fxJlf-Rtweqh4234';

//getting the user or org for calendly
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.calendly.com/users/me",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$access_token,
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
// print_r($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $response_array = json_decode($response, true);
  $organization_uri = $response_array['resource']['current_organization'];
  $user_uri = $response_array['resource']['uri'];

  echo "Organization URI: " . $organization_uri . "<br>";

  echo "User URI: " . $user_uri . "<br>";
}
// then you get organization and User in abobe code after that you execute below commented code.Just comment Above code and commented below code.
//in this code you must define your webhook link example your Webhook link is: https://example.com/calendly/calendlydata.php
// below code is return successfully create webhook subscription then just fill out you calendly form and submit then you can get data





/*
$organization_uri = "https://api.calendly.com/organizations/BADFVTREWSQ";
$user_id = "CCFEQDJM2HRRNOL5";

$curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.calendly.com/webhook_subscriptions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
        "url": "https://example.com/calendly/calendlydata.php",
        "events": [
        "invitee.created"
        ],
        "user": "https://api.calendly.com/users/' . $user_id . '",
        "organization":  "' . $organization_uri . '"  ,
        "scope": "organization"
    }',
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$access_token,
        "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    echo $response;
    }
  */
?>