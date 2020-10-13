<?php

$ip = $_GET['IP'];
header('Content-Type: application/json');

if($myfile = fopen("todo/$ip.txt", "r")) {
    $data = fread($myfile,filesize("todo/$ip.txt"));
    fclose($myfile);

    echo json_encode($data);
    exit;
}
echo json_encode(['result'=>'failed']);
exit;
?>