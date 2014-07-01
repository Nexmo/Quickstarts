<?php
$params = [
    'api_key' => NEXMO_KEY,
    'api_secret' => NEXMO_SECRET,
    'to' => YOUR_NUMBER,
    'from' => NEXMO_NUMBER,
    'text' => 'Hello from Nexmo',
];

$url = 'https://rest.nexmo.com/tts/json?' . http_build_query($params);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
error_log($response);