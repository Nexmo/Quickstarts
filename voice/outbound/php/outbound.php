<?php
$url = 'https://rest.nexmo.com/call/json?' . http_build_query(array(
        'api_key' => NEXMO_KEY,
        'api_secret' => NEXMO_SECRET,
        'to' => YOUR_NUMBER,
        'from' => NEXMO_NUMBER,
        'answer_url' => 'http://example.com/outbound.vxml',
        'status_url' => 'http://example.com/status.php'
    ));

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);