<?php
require_once '../initial.php';
require_once DIR_ROOT . '/db/Social.php';

class Plugins {
    public function getPromotions(){
        $filepatharr = $this->getPHPFileArray();
        $promotions=[];
        foreach($filepatharr as $obj){
            $filename = pathinfo($obj)['filename'];
            $promotions[$filename]= $this->loadone($filename);            
        }
        return $promotions;
    }

    public function getPHPFileArray(){
        $dirPath = DIR_ROOT .  '/plugins/widget_settings/';
        $result = [];
        try {
            if (file_exists($dirPath)) {
                $subs = scandir($dirPath);
                foreach ($subs as $value) {
                    $filePath = $dirPath . '/' . $value;
                    if (is_file($filePath) && pathinfo($filePath)['extension'] == 'php') {
                        array_push($result, $filePath);
                    }
                }
            }
        } catch (Exception $ex) {
            // log error here
        }
        return $result;
    }

    public function loadone($fileName){        
        $dirPath = DIR_ROOT .  '/plugins/widget_settings/';
        $filePath = $dirPath . '/' . $fileName.  '.php';
        // load old data
        $configClientData = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include $filePath;
            }
            if ($configClientData) {
                $configClientData = json_decode($configClientData);
                $configClientData = (array)$configClientData;
            }

        } catch(Exception $ex) {
            // log error here
        };

        if ($configClientData) {
            $allData = (array)$configClientData['data'];
            if ($allData && count($allData)>0) {
                foreach($allData as $socialKey => $dataInfo):
                    $social = new Social();
                    $filename = $socialKey . '.php';
                    $filePath = DIR_ROOT .  '/plugins/' . $filename;
                    $currentData = $social->load($filePath);
                    $allData[$socialKey] = (array)$allData[$socialKey];
                    $allData[$socialKey]['social'] = array(
                        'type' => $currentData->getType(),
                        'network' => $currentData->getNetwork(),
                        'id' => $currentData->getID(),
                        'iconid' => $currentData->getIconID(),
                        'title' => $currentData->getTitle(),
                        'actionName' => $currentData->getActionName(),
                        'visitLink' => $currentData->getvisitLink(),
                        'shareLink' => $currentData->getShareLink(),
                        'shareTitle' => $currentData->getShareTitle(),
                        'delayTime' => $currentData->getDelayTime(),
                        'filename' => $currentData->getFilename(),
                        'game' => $currentData->getGame(),
                    );
                endforeach;
            }
            $configClientData['data'] = $allData;
        }

        return $configClientData;
    }
}

class Plugin {  

    public function load() {

        $filename = 'setting';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/plugins/widget_settings/' . $newFileName;
        // load old data
        $configClientData = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include $filePath;
            }
            if ($configClientData) {
                $configClientData = json_decode($configClientData);
                $configClientData = (array)$configClientData;
            }

        } catch(Exception $ex) {
            // log error here
        };

        if ($configClientData) {
            $allData = (array)$configClientData['data'];
            if ($allData && count($allData)>0) {
                foreach($allData as $socialKey => $dataInfo):
                    $social = new Social();
                    $filename = $socialKey . '.php';
                    $filePath = DIR_ROOT .  '/plugins/' . $filename;
                    $currentData = $social->load($filePath);
                    $allData[$socialKey] = (array)$allData[$socialKey];
                    $allData[$socialKey]['social'] = array(
                        'type' => $currentData->getType(),
                        'network' => $currentData->getNetwork(),
                        'id' => $currentData->getID(),
                        'iconid' => $currentData->getIconID(),
                        'title' => $currentData->getTitle(),
                        'actionName' => $currentData->getActionName(),
                        'visitLink' => $currentData->getvisitLink(),
                        'shareLink' => $currentData->getShareLink(),
                        'shareTitle' => $currentData->getShareTitle(),
                        'delayTime' => $currentData->getDelayTime(),
                        'filename' => $currentData->getFilename(),
                        'game' => $currentData->getGame(),
                    );
                endforeach;
            }
            $configClientData['data'] = $allData;
        }

        return $configClientData;
    }

    public function getUniqueId() {
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

        return str_replace('.', '', $ip_address);
    }

    public function add_visitor($referralId, $limitCount) {
        $uniqueId = $this->getUniqueId();
//        if($referralId == $uniqueId) {
//            return false;
//        }

        $filename = 'refer';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/' . $newFileName;
        // load old data
        $referData = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include_once $filePath;
//                var_dump($referData."====== here \r\n");
            }
            if ($referData) {
                $referData = json_decode($referData);
                $referData = (array)$referData;
//                var_dump($referData."====== there \r\n");
            } else {
                $referData = array();
            }

        } catch(Exception $ex) {
            // log error here
        };
        $newData = array();
        $setFlag = false;
        $result = false;
        foreach($referData as $idx => $refer) {
            $item = (array)$refer;
            if($item['referrer'] == $referralId) {
                $setFlag = true;
                if(in_array($uniqueId, (array)$item['visitors']) || $referralId == $uniqueId) {
                    return count($item['visitors']) >= $limitCount;
                }
                array_push($item['visitors'], $uniqueId);
                $item['visits'] = count($item['visitors']);
                $result = count($item['visitors']) >= $limitCount;
            }
            $newData[] = $item;
        }

        if(!$setFlag) {
            if($referralId == $uniqueId) {
                return false;
            }
            $newData[] = array(
                'referrer' => $referralId,
                'visits' => 1,
                'visitors' => array($uniqueId)
            );
        }

        // save new data
        $jsonString = json_encode($newData);
        $jsonString = "<?php \r\n\$referData = '" . $jsonString . "';";
        if ($filename) {
            // save into "plugins" folder
            $newFileName = $filename . '.php';
            $filePath = DIR_ROOT .  "/" . $newFileName;
            file_put_contents($filePath, $jsonString);
        }
        return $result;
    }

    public function getVisitors($referralId) {
        $filename = 'refer';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/' . $newFileName;
        // load old data
        $referData = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include_once $filePath;
            }
            if ($referData) {
                $referData = json_decode($referData);
                $referData = (array)$referData;
            } else {
                $referData = array();
            }

        } catch(Exception $ex) {
            // log error here
        };
        foreach($referData as $idx => $refer) {
            $item = (array)$refer;
            if($item['referrer'] == $referralId) {
                return count((array)$item['visitors']);
            }
        }
        return 0;
    }

    public function clear_visitors($referralId) {
        $filename = 'refer';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/' . $newFileName;
        // load old data
        $referData = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include_once $filePath;
            }
            if ($referData) {
                $referData = json_decode($referData);
                $referData = (array)$referData;
            }

        } catch(Exception $ex) {
            // log error here
        };
        $newData = array();
        foreach($referData as $idx => $refer) {
            $item = (array)$refer;
            if($item['referrer'] == $referralId) {
                $newData[] = array(
                    'referrer' => $referralId,
                    'visitors' => array(),
                    'visits' => 0
                );
            } else {
                $newData[] = $item;
            }
        }

        // save new data
        $jsonString = json_encode($newData);
        $jsonString = "<?php \r\n\$referData = '" . $jsonString . "';";
        if ($filename) {
            // save into "plugins" folder
            $newFileName = $filename . '.php';
            $filePath = DIR_ROOT .  '/' . $newFileName;
            file_put_contents($filePath, $jsonString);
        }
        return false;
    }

    public function setFraud($cheat) {
        $ip = $this->getUniqueId();

        $filename = 'cheats';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/' . $newFileName;
        // load old data
        $fraud = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include_once $filePath;
            }
            if ($fraud) {
                $fraud = json_decode($fraud);
                $fraud = (array)$fraud;
            } else {
                $fraud = array();
            }

        } catch(Exception $ex) {
            // log error here
        };
        $temp = array();
        $setFlag = false;
        foreach($fraud as $i => $item) {
            $tmp = (array)$item;
            if($tmp['ip'] == $ip) {
                $setFlag = true;
                $temp[] = array(
                    'ip' => $ip,
                    'cheat' => $cheat,
                    'ban' => $cheat >= 3 ? date('Y-m-d H:i:s') : $tmp['ban'],
                );
            } else {
                $temp[] = $tmp;
            }
        }
        if($setFlag == false) {
            $temp[] = array(
                'ip' => $ip,
                'cheat' => $cheat,
                'ban' => $cheat >= 3 ? date('Y-m-d H:i:s') : ''
            );
        }
        // save new data
        $jsonString = json_encode($temp);
        $jsonString = "<?php \r\n\$fraud = '" . $jsonString . "'; ?>";
        if ($filename) {
            // save into "plugins" folder
            $newFileName = $filename . '.php';
            $filePath = DIR_ROOT .  '/' . $newFileName;
            file_put_contents($filePath, $jsonString);
        }
    }

    public function getFraud() {
        $ip = $this->getUniqueId();

        $filename = 'cheats';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/' . $newFileName;
        // load old data
        $fraud = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include_once $filePath;
            }
            if ($fraud) {
                $fraud = json_decode($fraud);
                $fraud = (array)$fraud;
            } else {
                $fraud = array();
            }

        } catch(Exception $ex) {
            // log error here
        };
        $retVal = '';
        foreach($fraud as $key => $item) {
            $tmp = (array)$item;
            if($tmp['ip'] == $ip) {
                $retVal = $tmp;
            }
        }
        return $retVal;
    }

    public function removeFraud() {
        $ip = $this->getUniqueId();

        $filename = 'cheats';
        $newFileName = $filename . '.php';

        $filePath = DIR_ROOT .  '/' . $newFileName;
        // load old data
        $fraud = null;
        try {
            if (is_file($filePath)) {
                // load this file and update $configClientData
                include_once $filePath;
            }
            if ($fraud) {
                $fraud = json_decode($fraud);
                $fraud = (array)$fraud;
            } else {
                $fraud = array();
            }

        } catch(Exception $ex) {
            // log error here
        };
        $temp = array();
        foreach($fraud as $i => $item) {
            $tmp = (array)$item;
            if($tmp['ip'] == $ip) {
                $temp[] = array(
                    'ip' => $ip,
                    'cheat' => 0,
                    'ban' => '',
                );
            } else {
                $temp[] = $tmp;
            }
        }
        // save new data
        $jsonString = json_encode($temp);
        $jsonString = "<?php \r\n\$fraud = '" . $jsonString . "';";
        if ($filename) {
            // save into "plugins" folder
            $newFileName = $filename . '.php';
            $filePath = DIR_ROOT .  '/' . $newFileName;
            file_put_contents($filePath, $jsonString);
        }

    }

    public function getAllSocialData() {
        $social = new Social();
        return $social->loadAll();
    }

}
