<?php

class Social {
    protected $type;
    protected $network;
    protected $id;
    protected $title;
    protected $actionName;
    protected $visitLink;
    protected $shareLink;
    protected $shareTitle;
    protected $delayTime;
    protected $filename;
    protected $game;
//    protected $placeholder;

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getNetwork() {
        return $this->network;
    }

    public function setNetwork($network) {
        $this->network = $network;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }


//    public function getPlaceholder() {
//        return $this->placeholder;
//    }
//
//    public function setPlaceholder($placeholder) {
//        $this->placeholder = $placeholder;
//    }

    public function getActionName() {
        return $this->actionName;
    }

    public function setActionName($actionName) {
        $this->actionName = $actionName;
    }

    public function getvisitLink() {
        return $this->visitLink;
    }

    public function setVisitLink($visitLink) {
        $this->visitLink = $visitLink;
    }

    public function getShareLink() {
        return $this->shareLink;
    }

    public function setShareLink($shareLink) {
        $this->shareLink = $shareLink;
    }

    public function getShareTitle() {
        return $this->shareTitle;
    }

    public function setShareTitle($shareTitle) {
        $this->shareTitle = $shareTitle;
    }

    public function getDelayTime() {
        return $this->delayTime;
    }

    public function setDelayTime($delayTime) {
        $this->delayTime = $delayTime;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame($game) {
        $this->game = array_merge(array(), $game);
    }

    public function toArray() {
        $result = array(
            'type' => $this->type,
            'network' => $this->network,
            'id' => $this->id,
            'title' => $this->title,
            'actionName' => $this->actionName,
            'visitLink' => $this->visitLink,
            'shareLink' => $this->shareLink,
            'shareTitle' => $this->shareTitle,
            'delayTime' => $this->delayTime,
            'filename' => $this->filename,
            'game' => $this->game,
//            ,'placeholder' => $this->placeholder
        );

        return $result;
    }

    public function setDataByArray($data, $files = null) {
            @$type = $data['type'];
            @$network = $data['network'];
            @$id = $data['id'];
            @$title = $data['title'];
            @$actionName = $data['actionName'];
            @$visitLink = $data['visitLink'];
            @$shareLink = $data['shareLink'];
            @$shareTitle = $data['shareTitle'];
            @$delayTime = $data['delayTime'];
            @$filename = $data['filename'];

            if($files == null) {
                @$game = (array)$data['game'];
            } else {
                @$gameNames = $data['game_name'];
                @$gameIframes = $data['game_iframe'];
                @$previewUrls = $data['preview_url'];
                @$previewImages = $files;
                $game = array();
                if($type == 'play-then-share') {
                    $count = count($gameNames);
                    for($i = 0; $i < $count ; $i ++) {
                        $mode = $previewImages[$i]['name'] != '';
                        $imgUrl = '';
                        if($mode) {
                            $target_dir = 'uploads/';
                            $target_file = $target_dir.basename($previewImages[$i]['name']);

                            // Check file size
                            if ($previewImages[$i]["size"] > 500000) {
                                echo array('success' => false, 'message' => 'Sorry, your file is too large.');
                            } else {
                                move_uploaded_file($previewImages[$i]["tmp_name"], DIR_ROOT.'/'.$target_file);
                            }
                            $imgUrl = PATH_ROOT.'/'.$target_file;
                        }
                        $game[] = array(
                            'name' => $gameNames[$i],
                            'iframe' => $gameIframes[$i],
                            'url' => $previewUrls[$i],
                            'image' => $mode ? $imgUrl : '',
                            'preview' => $mode ? $imgUrl : $previewUrls[$i],
                        );
                    }
                }
            }


//            @$placeholder = $data['placeholder'];

            $this->setType($type);
            $this->setNetwork($network);
            $this->setID($id);
            $this->setTitle($title);
            $this->setActionName($actionName);
            $this->setVisitLink($visitLink);
            $this->setShareLink($shareLink);
            $this->setShareTitle($shareTitle);
            $this->setDelayTime($delayTime);
            $this->setFilename($filename);
            $this->setGame($game);
//            $this->setPlaceholder($placeholder);
    }

    public function setDataByJson($json) {
        try {
            $data = json_decode($json);

            $data = (array)$data;
            $this->setDataByArray($data);
        } catch(Exception $ex){
            // Handle and log data here
        }
    }

    public function toJson() {
        $result = json_encode($this->toArray());
        return $result;
    }

    public function save() {
        $jsonString = $this->toJson();

        try {
            $jsonString = "<?php \r\n\$configSocial = '" . $jsonString . "';";
            $filename = $this->filename;
            if ($filename) {
                // save into "plugins" folder
                $newFileName = $filename . '.php';
                $filePath = DIR_ROOT .  '/plugins/' . $newFileName;
                file_put_contents($filePath, $jsonString);
            }
        } catch(Exception $ex) {
            // log error here
            return false;
        };

        return true;
    }

    public function load($filePath) {

        $data = null;
        try {
            $configSocial = null;
            if (is_file($filePath)) {
                // load this file and update $configSocial
                include $filePath;
            }

            $data = $configSocial;
        } catch(Exception $ex) {
            // log error here
        };

        $this->setDataByJson($data);
        return $this;
    }

    public function loadAll() {
        $dir = DIR_ROOT .  '/plugins';

        $result = array();
        try {
            $allSub = scandir($dir);
            // unset($allSub[0]);
            // unset($allSub[1]);
            // print_r($allSub);
            foreach($allSub as $key => $value):
                $filePath = $dir . '/' . $value;
                if (is_file($filePath)) {
                    $social = new Social();
                    $tmp = $social->load($filePath);
                    // print_r($tmp);
                    $result[] = array(
                        'type' => $tmp->type,
                        'network' => $tmp->network,
                        'id' => $tmp->id,
                        'title' => $tmp->title,
                        'actionName' => $tmp->actionName,
                        'visitLink' => $tmp->visitLink,
                        'shareLink' => $tmp->shareLink,
                        'shareTitle' => $tmp->shareTitle,
                        'delayTime' => $tmp->delayTime,
                        'filename' => $tmp->filename,
                        'game' => $tmp->game,
                    );
                }
            endforeach;
        } catch(Exception $ex) {
            // log error here
        }
        return $result;
    }

}
