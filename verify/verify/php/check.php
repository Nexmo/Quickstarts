<?php
$url = 'https://api.nexmo.com/verify/check/json?' . http_build_query([
        'api_key' => NEXMO_KEY,
        'api_secret' => NEXMO_SECRET,
        'request_id' => '1178e48a940a485eaca317a1237279e5',
        'code' => '6356'
    ]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);