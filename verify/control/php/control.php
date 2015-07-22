<?php
$url = 'https://api.nexmo.com/verify/control/json?' . http_build_query([
        'api_key' => API_KEY,
        'api_secret' => API_SECRET,
        'request_id' => '039368b9e6a24ee29492a6ea63c74202',
        'cmd' => 'trigger_next_event'
    ]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
error_log($response);