<?php
require_once '../initial.php';
require_once '../db/Social.php';
$filePath = DIR_ROOT .  '/plugins/widget_settings/links.json';

@$type = $_POST['type'];
@$links = $_POST['links'];

if ($type == 'get') {
    if (file_exists($filePath)) {
        $linksjson = file_get_contents($filePath);
        echo $linksjson;
    } else {
        echo '[]';
    }
}
if ($type == 'set') {
    file_put_contents($filePath, json_encode($links));
    echo 'links file saved';
}

function getLink($id)
{
    $filePath = DIR_ROOT .  '/plugins/widget_settings/links.json';
    if (file_exists($filePath)) {
        $linksjson = file_get_contents($filePath);
        $links = json_decode($linksjson);
        foreach ($links as $link) {
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
