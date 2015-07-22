<?php
$url = 'https://api.nexmo.com/verify/json?' . http_build_query([
        'api_key' => API_KEY,
        'api_secret' => API_SECRET,
        'number' => YOUR_NUMBER,
        'brand' => 'MyApp'
    ]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
error_log($response);