<?php
if(!isset($_POST['department'])){
    return; //not a post from our script
}

switch($_POST['department']){
    case 'sales':
        $selected = 'want to talk to sales.';
        break;
    case 'support':
        $selected = 'need help with something.';
        break;
    default:
        $selected = 'did something unexpected it seems.';
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<vxml version="2.1">
    <form>
        <block>
            <prompt>You <?php echo $selected ?></prompt>
        </block>
    </form>
</vxml>