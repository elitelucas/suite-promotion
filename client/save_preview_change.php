<?php
require_once '../initial.php';
require_once '../plugins/widget_settings/setting.php';

$configClientData = json_decode($configClientData, true);
// $order = ['refer-and-share', 'spin-and-share']; //get from request
$order = $_POST['order'];
$newData=[];
foreach($order as $obj){
    $newData[$obj]=$configClientData['data'][$obj];
}
$configClientData['data']=$newData;

try {
    $filename = 'setting';
    $newFileName = $filename . '.php';
    $filePath = DIR_ROOT .  '/plugins/widget_settings/' . $newFileName;

    // save new data
    $jsonString = json_encode($configClientData);
    $jsonString = "<?php \r\n\$configClientData = '" . $jsonString . "';";

    // save into "plugins" folder  
    file_put_contents($filePath, $jsonString);
    $result['message'] = 'Create plugin successfull!';
    $result['success'] = true;
} catch (Exception $ex) {
    $result['message'] = 'Some error happen!';
    // log error here
    return false;
};

echo json_encode($result);
