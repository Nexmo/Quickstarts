<?php
// work with get or post
$request = array_merge($_GET, $_POST);

// check that request is inbound message
if(!isset($request['to']) OR !isset($request['msisdn']) OR !isset($request['text'])){
    error_log('not inbound message');
    return;
}

$text = str_rot13($request['text']);

$url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
        'api_key' => API_KEY,
        'api_secret' => API_SECRET,
        'to' => $request['msisdn'],
        'from' => $request['to'],
        'text' => $text
    ]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);