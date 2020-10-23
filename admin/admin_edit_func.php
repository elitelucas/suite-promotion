<?php
    require_once '../initial.php';
    require_once DIR_ROOT . '/db/Plugin.php';
    require_once DIR_ROOT . '/db/Social.php';

    $message = null;
    $picFiles = array();
    foreach($_FILES as $key => $file) {
        $picFiles[] = $file;
    }

    $result = array(
        'success' => false,
        'message' => 'Error on update plugin'
    );

    $dataPost = $_POST;
    if ($dataPost) {
        @$file = $dataPost['file'];
        @$newFileName = $dataPost['filename'];
        $parentPath = DIR_ROOT .  '/plugins';
        if ($file && $newFileName && $file != $newFileName) {
            $oldFile = $parentPath . '/' . $file . '.php';
            $newFile = $parentPath . '/' . $newFileName . '.php';
            rename($oldFile, $newFile);
        }

        $social = new Social();
        $social->setDataByArray($dataPost,$picFiles);

        $social->save();
        $result['message'] = 'Save plugin successfull!';
    }

    echo json_encode($result);