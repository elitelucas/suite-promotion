<?php
    require_once '../initial.php';

    $data = $_GET;
    @$file = $data['file'];


    $result = array(
        'success' => false,
        'message' => 'Can not delete this plugin.'
    );

    if ($file) {
        $filePath = DIR_ROOT .  '/plugins/' . $file . '.php';
        try {
            if(is_file($filePath)) {
                unlink($filePath);
                $result['success'] = true;
                $result['message'] = 'Delete plugin successfull!';
            } else {
                $result['message'] = 'File does not exists!!';
            }
        } catch (Exception $ex) {
            $result['message'] = 'Error on delete file - please check file permission!';
        }
    }

    echo json_encode($result);