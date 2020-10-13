<?php
    require_once '../initial.php';
    require_once DIR_ROOT.'/db/Plugin.php';

    $plugin = new Plugin();

    $dataPost = $_POST;
    $result = array(
        'success' => true
    );
//    if($dataPost) {
        @$referralId = $dataPost['referralId'];
        @$limitCount = $dataPost['limitCount'];
//        var_dump($action."==== add result\r\n");

        $addResult = $plugin->add_visitor($referralId, $limitCount);
//        var_dump($addResult."==== add result\r\n");

        $result['success'] = $addResult;
//    }
    echo json_encode($result);
