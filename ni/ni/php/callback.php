<?php
if(!isset($_GET['request_id'])){
    return; //doesn't look like a number insight callback
}

foreach($_GET as $param => $value){
    error_log($param . ': ' . $value);
}