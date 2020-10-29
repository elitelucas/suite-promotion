<?php
require_once '../initial.php';

$message = null;

$dataPost = $_POST;
$result = array(
    'success' => false
);
$picFiles = array();

if (isset($dataPost)) {
    foreach($_FILES as $key => $file) {
        if($key != 'brand_pic_upload') {
            $picFiles[] = $file;
        }
    }
    // ======= get ip address module ==========
    $ip_address = '';

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    // ===== end of get ip address module =============

    @$title = $dataPost['title'];
    @$caption = $dataPost['caption'];
    @$description = $dataPost['description'];
    @$promotioncontent = $dataPost['promotioncontent'];
    @$totalpoints = $dataPost['totalpoints'];
    @$comment = $dataPost['comment'];
    @$expiry = $dataPost['expiry'];
    @$offersleft = $dataPost['offersleft'];
    @$type = $dataPost['type'];
    @$network = $dataPost['network'];

    @$action = $dataPost['action'];
    @$url = $dataPost['url'];
    @$numpoint = $dataPost['numpoint'];
    @$friends = $dataPost['numFriends'];
    @$visitAction = $dataPost['visitAction'];
    @$shareAction = $dataPost['shareAction'];
    @$scratchUrl = $dataPost['scratchUrl'];
    @$submitDescription = $dataPost['submit_description'];

    @$selectType = $dataPost['selectType'];
    @$checkboxLabel = $dataPost['checkbox_label'];
    @$shareDescription = $dataPost['shareDescription'];

    @$actionType = $dataPost['plugin-'.$action];

    @$mediaType = $dataPost['brand_media_type'];
    @$brandPicType = $dataPost['brand_pic_type'];
    @$brandPicUrl = $dataPost['brand_pic_url'];
    @$brandVideoUrl = $dataPost['brand_video_url'];
    @$brandPicUpload = $_FILES['brand_pic_upload'];
    @$slides = $dataPost['slides'];

    @$backImgUrl = $dataPost['back_img_url'];

    @$game_name = $dataPost['game_name'];
    @$game_iframe = $dataPost['game_iframe'];
    @$game_preview = $dataPost['game_preview'];

    @$recordType = $dataPost['record_type'];
    @$recordLength = $dataPost['record_length'];

    @$embedcode = $dataPost['embedcode']; //embedcode

    $pictures = array();
    $refer = array();

    $brandMode = '';
    $brandUrl = '';
    if($mediaType == 'picture') {
        if($brandPicType == 'url') {
            $brandMode = 'url';
            $brandUrl = $brandPicUrl;
        } else if($brandPicType == 'upload') {
            $brandMode = 'upload';

            $target_dir = 'uploads/';
            $target_file = $target_dir.basename($brandPicUpload['name']);

            // Check file size
            if ($brandPicUpload["size"] > 500000) {
                echo array('success' => false, 'message' => 'Sorry, your file is too large.');
                $uploadOk = 0;
            }
            move_uploaded_file($brandPicUpload["tmp_name"], DIR_ROOT.'/'.$target_file);
            $brandUrl = PATH_ROOT.'/'.$target_file;
        }
    } else if($mediaType == 'video') {
        $brandMode = 'video';
        if(strpos($brandVideoUrl, 'youtube') !== false) {
            $vid = explode('v=', $brandVideoUrl);
            if($vid[1] != '') {
                $brandUrl = 'https://www.youtube.com/embed/'.$vid[1];
            }
        } else if(strpos($brandVideoUrl, 'vimeo') !== false) {
            $vid = explode('vimeo.com/', $brandVideoUrl);
            if($vid[1] != '') {
                $brandUrl = 'https://player.vimeo.com/video/'.$vid[1];
            }
        }
    } else if($mediaType == 'slide_show') {
        $brandMode = 'slide';
        $brandUrl = $slides;
    }
    $brand = array(
        'mode' => $brandMode,
        'url' => $brandUrl,
    );

    if($actionType == 'select-and-share') {
        if($selectType == 'image') {
            $picture_name = $dataPost['picture_name'];
            $picture_url = $dataPost['picture_url'];
            $picture_mode = $dataPost['pic_mode'];

            $target_dir = 'uploads/';

            if (isset($picture_name)) {
                $picCount = count($picture_name);
                for ($i = 0; $i < $picCount; $i++) {
                    if($picture_mode[$i] == 'url') {
                        $pictures[] = array(
                            'name' => $picture_name[$i],
                            'mode' => 'url',
                            'url' => $picture_url[$i],
                        );
                    } else {
                        $target_file = $target_dir.basename($picFiles[$i]['name']);

                        // Check file size
                        if ($picFiles[$i]["size"] > 500000) {
                            echo array('success' => false, 'message' => 'Sorry, your file is too large.');
                            $uploadOk = 0;
                        }
                        move_uploaded_file($picFiles[$i]["tmp_name"], DIR_ROOT.'/'.$target_file);
                        $pictures[] = array(
                            'name' => $picture_name[$i],
                            'mode' => 'upload',
                            'url' => $target_file,
                        );
                    }

                }
            }
        }
    } else if($actionType == 'share-and-refer') {
        $ip_address = str_replace('.', '', $ip_address);
    }

    $now = time(); // or your date as well
    $your_date = strtotime($expiry);
    $datediff = $your_date - $now;

    $dayLeft = round($datediff / (60 * 60 * 24));

    $dataInfo = array(
        'title' => $title,
        'caption' => $caption,
        'description' => $description,
        'promotioncontent' => $promotioncontent,
        'totalpoints' => $totalpoints,
        'expiry' => $expiry,
        'dayLeft' => $dayLeft,
        'offersleft' => $offersleft,
        'type' => $type,
        'network' => $network,
        'media' => $brand,
        'background_image' => $backImgUrl,
        'comment' => $comment,
    );

    $newData = array(
        'info' => $dataInfo,
    );


    try {
        $filename = 'setting';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/plugins/widget_settings/' . $newFileName;
        // load old data
        $configClientData = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configSocial
                include_once $filePath;
            }
            if ($configClientData) {
                $configClientData = json_decode($configClientData);
                $configClientData = (array)$configClientData;
            }

        } catch(Exception $ex) {
            $result['message'] = 'Some error happen!';
            // log error here
        };

        @$newData['data'] = (array)$configClientData['data'];
        if ($action) {
            if($actionType == 'select-and-share') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'content' => $selectType == 'image' ? $pictures : $checkboxLabel,
                    'type' => $selectType,
                    'description' => $shareDescription,
                );
            } else if ($actionType == 'share-and-refer') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'uniqueId' => $ip_address,
                    'count' => $friends,
                );
            } else if ($actionType == 'scratch-and-share' || $actionType == 'spin-and-share') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'url' => $scratchUrl,
                );
            } else if ($actionType == 'play-then-share') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'url' => $scratchUrl,
                    'game' => array(
                        'name' => $game_name,
                        'iframe' => $game_iframe,
                        'preview' => $game_preview
                    )
                );
            } else if ($actionType == 'submit-then-share') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'description' => $submitDescription,
                    'url' => $url
                );
            } else if ($actionType == 'record-and-share') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'url' => $scratchUrl,
                    'recordType' => $recordType,
                    'recordLength' => $recordLength,
                );
            } else if ($actionType == 'share-and-visit' || $actionType == 'visit-and-share'|| $actionType == 'share-then-submit') {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'url' => $scratchUrl,
                    'embedcode' => $embedcode,
                );
            } else {
                $newData['data'][$action] = array(
                    'numpoint' => $numpoint,
                    'url' => $url,
                );
            }
            $newData['data'][$action]['visitAction'] = $visitAction;
            $newData['data'][$action]['shareAction'] = $shareAction;
        }
        // save new data
        $jsonString = json_encode($newData);
        $jsonString = "<?php \r\n\$configClientData = '" . $jsonString . "';";
        if ($filename) {
            // save into "plugins" folder
            $newFileName = $filename . '.php';
            $filePath = DIR_ROOT .  '/plugins/widget_settings/' . $newFileName;
            file_put_contents($filePath, $jsonString);
            $result['message'] = 'Create plugin successfull!';
            $result['success'] = true;
        }
    } catch(Exception $ex) {
        $result['message'] = 'Some error happen!';
        // log error here
        return false;
    };

//    if($actionType == 'share-and-refer') {
//        try {
//            $filename = 'refer';
//            $newFileName = $filename . '.php';
//
//            $filePath = DIR_ROOT .  '/' . $newFileName;
//
//            $referData = null;
//            try {
//                if (is_file($filePath)) {
//                    // load this file and update $configSocial
//                    include_once $filePath;
//                }
//                if ($referData) {
//                    $referData = json_decode($referData);
//                    $referData = (array)$referData;
//                }
//
//            } catch(Exception $ex) {
//                $result['message'] = 'Some error happen!';
//                // log error here
//            };
//
//            $newData = $referData == null ? array() : $referData;
//            $newData[$action] = array(
//                'count' => $friends,
//                'uniqueId' => $ip_address,
//                'visitors' => array()
//            );
//
//            // save new data
//            $jsonString = json_encode($newData);
//            $jsonString = "<?php \r\n\$referData = '" . $jsonString . "';";
//            if ($filename) {
//                // save into "plugins" folder
//                $newFileName = $filename . '.php';
//                $filePath = DIR_ROOT .  '/' . $newFileName;
//                file_put_contents($filePath, $jsonString);
//                $result['message'] = 'Create plugin successful!';
//                $result['success'] = true;
//            }
//        } catch (Exception $ex) {
//            $result['message'] = 'Some error happen!';
//            return false;
//        }
//    }

}
echo json_encode($result);
