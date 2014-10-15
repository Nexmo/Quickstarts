<?php
// accept both query string and post
$request = array_merge($_GET, $_POST);
error_log('got a call from: ' . $request['nexmo_caller_id']);
// make the XML short tag friendly
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<vxml version="2.1">
    <form>
        <block>
            <prompt>Hello from VXML!</prompt>
        </block>
    </form>
</vxml>