<?php

$ip = $_GET['IP'];
$data = $_GET['data'];

$myfile = fopen("todo/$ip.txt", "w");
fwrite($myfile, json_encode($data));
fclose($myfile);

echo 'ok';
?>