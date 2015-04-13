<?php
$params = [
    'api_key' => API_KEY,
    'api_secret' => API_SECRET,
    'to' => YOUR_NUMBER,
    'from' => NEXMO_NUMBER,
    'text' => 'Hello from Nexmo',
];

$url = 'https://api.nexmo.com/tts/json?' . http_build_query($params);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);