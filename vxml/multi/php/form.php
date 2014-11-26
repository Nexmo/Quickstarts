<?php
//caller transferred to sales
if(isset($_POST['sales'])){
    error_log('sales call disconnected because: ' . $_POST['sales']);
    return;
}

if(!isset($_POST['menu'])){
    error_log('unknown call type');
}

switch($_POST['menu']){
    case 'review':
        error_log('caller left a review: ' . $_FILES['review']['tmp_name']);
        break;
    case 'support':
        error_log('support call disconnected because: ' . $_POST['support']);
}