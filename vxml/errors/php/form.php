<?php
if(!isset($_POST['os'])){
    error_log('no os set');
    return;
}

switch($_POST['os']){
    //valid selections
    case 'windows':
        $support = 'Call back after you reboot.';
        break;
    case 'mac':
        $support = 'Please just go to the genius bar.';
        break;
    case 'linux':
        $support = 'Recompile your kernel.';
        break;
    case 'amiga':
        $support = 'Hangup and dial our BBS for support.';
        break;
    //if our VXML is as expected, this should never happen
    default:
        include '../vxml/form.vxml';
        return;
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<vxml version="2.1">
    <form>
        <block>
            <prompt><?php echo $support ?></prompt>
        </block>
    </form>
</vxml>