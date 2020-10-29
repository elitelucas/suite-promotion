<?php
require_once '../initial.php';
require_once '../db/Social.php';
$dirPath = DIR_ROOT .  '/tools';

@$type = $_POST['type'];
@$tools = $_POST['tools'];

if ($type == 'get') {
    $result = [];
    try {
        $subs = scandir($dirPath);
        foreach ($subs as $value) {
            $filePath = $dirPath . '/' . $value;
            if (is_file($filePath)) {
                $content = file_get_contents($filePath);
                array_push($result, json_decode($content));
            }
        }
    } catch (Exception $ex) {
        // log error here
    }
    echo json_encode($result);
}

if ($type == 'set') {
     //make folder
    if (!file_exists($dirPath)) {
        mkdir($dirPath);
    }
    //delete files
    $files = glob("$dirPath/*"); // get all file names
    foreach ($files as $file) { // iterate files
        echo "deleting $file";
        if (is_file($file))
            unlink($file); // delete file
    }
    //save each file
    foreach ($tools as $tool)
        if ($tool['filename'])
            file_put_contents($dirPath . '/' . $tool['filename'], json_encode($tool));
    echo 'tools file saved';
}

function getLink($id)
{
    $dirPath = DIR_ROOT .  '/plugins/widget_settings/tools.json';
    if (file_exists($dirPath)) {
        $toolsjson = file_get_contents($dirPath);
        $tools = json_decode($toolsjson);
        foreach ($tools as $link) {
            if ($link->id == $id) return $link;
        }
    }
    return (object) [
        'id' => '',
        'banner' => '',
        'imageURL' => '',
        'networks' => [],
        'actions' => []
    ];
}
