<?php
$request = array_merge($_GET, $_POST);
error_log('call id: ' . $request['call-id']);
error_log('duration: ' . $request['call-duration']);
error_log('price: ' . $request['call-price']);
error_log('call ended at: ' . $request['call-end']);