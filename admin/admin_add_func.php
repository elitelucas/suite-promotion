<?php
    require_once '../initial.php';
    require_once DIR_ROOT . '/db/Plugin.php';
    require_once DIR_ROOT . '/db/Social.php';

    $message = null;
    $picFiles = array();
    foreach($_FILES as $key => $file) {
        $picFiles[] = $file;
    }

    $dataPost = $_POST;
    $result = array(
        'success' => false
    );
    if ($dataPost) {

        $social = new Social();
        $social->setDataByArray($dataPost, $picFiles);

        @$filename = $dataPost['filename'];
        if($filename) {
            $filePath = DIR_ROOT .  '/plugins/' . $filename . '.php';
            if(is_file($filePath)) {
                $result['message'] = 'This file already exists, please use another file name!';
            } else {
                $social->save();
                $result['message'] = 'Create plugin successfull!';
                $result['success'] = true;
            }
        } else {
            $result['message'] = 'Please enter file name';
        }
    }
    echo json_encode($result);
