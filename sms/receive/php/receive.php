<?php
// work with get or post
$request = array_merge($_GET, $_POST);

// check that request is inbound message
if(!isset($request['to']) OR !isset($request['msisdn']) OR !isset($request['text'])){
    error_log('not inbound message');
    return;
}

error_log('inbound message from: ' . $request['msisdn']);
error_log('inbound message body: ' . $request['text']);

