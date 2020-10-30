<?php
require_once '../initial.php';
require_once '../db/Social.php';
$dirPath = DIR_ROOT .  '/tools';

@$type = $_POST['type'];
@$tools = $_POST['tools'];

if ($type == 'get') {
    $result = [];
    try {
        if (file_exists($dirPath)) {
            $subs = scandir($dirPath);
            foreach ($subs as $value) {
                $filePath = $dirPath . '/' . $value;
                if (is_file($filePath)) {
                    $content = phpToJson(file_get_contents($filePath));
                    array_push($result, json_decode($content));
                }
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
        if (is_file($file))
            unlink($file); // delete file
    }
    //save each file
    foreach ($tools as $tool)
        if ($tool['filename'])
            file_put_contents($dirPath . '/' . $tool['filename'] . '.php', jsonToPHP(json_encode($tool)));
    echo 'tools file saved';
}

function getTools()
{
    $dirPath = DIR_ROOT .  '/tools';
    $result = [];
    try {
        if (file_exists($dirPath)) {
            $subs = scandir($dirPath);
            foreach ($subs as $value) {
                $filePath = $dirPath . '/' . $value;
                if (is_file($filePath)) {
                    $content = phpToJson(file_get_contents($filePath));
                    array_push($result, json_decode($content));
                }
            }
        }
    } catch (Exception $ex) {
        // log error here
    }
    return $result;
}

function getCategories()
{
    $tools = getTools();
    $categories = [];
    foreach ($tools as $obj)
        array_push($categories, $obj->category);
    $categories = array_unique($categories);
    return $categories;
}


function jsonToPHP($json)
{
    $prefix = "<?php \$tool='";
    $suffix = "'?>";
    return $prefix . $json . $suffix;
}

function phpToJson($php)
{
    $prefix = "<?php \$tool='";
    $suffix = "'?>";
    $text = substr($php, strlen($prefix));
    $text = rtrim($text, $suffix);
    return $text;
}
