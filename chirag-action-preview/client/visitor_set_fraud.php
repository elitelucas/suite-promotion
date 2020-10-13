<?php
require_once '../initial.php';
require_once DIR_ROOT.'/db/Plugin.php';

$plugin = new Plugin();

$message = null;

$dataPost = $_POST;

@$flag = $dataPost['flag'];
@$cheat = $dataPost['cheat'];

$result = array(
    'success' => true
);
$cheatData = array();
if($flag == 'set') {
    $plugin->setFraud($cheat);
} else if($flag == 'remove') {
    $plugin->removeFraud();
} else if($flag == 'get') {
    $cheatData = $plugin->getFraud();
}

@$result['ban'] = $cheatData['ban'];
@$result['cheat'] = $cheatData['cheat'];

echo json_encode($result);
