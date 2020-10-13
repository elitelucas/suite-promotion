<?php
    require_once '../initial.php';
    require_once DIR_ROOT . '/db/Plugin.php';
    require_once DIR_ROOT . '/db/Social.php';

    $social = new Social();
    $allPlugins = $social->loadAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Social Promo Widget</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Social -->
    <link rel="stylesheet" href="https://suite.social/src/css/social-buttons.css">
    <link rel="stylesheet" href="https://suite.social/src/css/social-colors.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ASSET_ROOT ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo ASSET_ROOT ?>/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo ASSET_ROOT ?>/css/style.css">

    <style>
        .entry:not(:first-of-type)
        {
            margin-top: 10px;
        }

        .glyphicon
        {
            font-size: 12px;
        }

        .modal-header {
            padding: 15px;
            border-bottom: none;
        }
        .modal-title{
            font-weight:bold;
        }
        .modal-body.choice-modal{
            position: relative;
            padding: 0px;

        }

        .row.inner-scroll {
            height: 445px;
            overflow: auto;
        }

        .mycard-footer {
            height: 25px;
            background: #333333;
            font-size: 15px;
            text-indent: 10px;
            /* border-radius: 0 0px 4px 4px;*/
        }

        .gallery-card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
            height: 132px;
            margin-bottom:14px;
        }
        .gallery-card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            /*padding: 1.25rem;*/
        }
        .gallery-card img {
            height: 100px;
            width: 100%;
        }
        label{
            margin-bottom: 0 !important;
        }
        /*--checkbox--*/

        .block-check {
            display: block;
            position: relative;


            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .block-check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            cursor: pointer;
        }

        /* On mouse-over, add a grey background color */
        .block-check:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .block-check input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .block-check input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .block-check .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

    </style>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- jQuery -->
<!--    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>-->
<!--    <script src="--><?php //echo PATH_ROOT ?><!--/plugins/jquery/jquery.min.js"></script>-->
<!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">-->
<!--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>-->
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
</head>
<body>
<div class="container">
    <div class="card" style="">
        <div class="card-body">
            <div class="clear">
                <h4 class="">
                    Client form
                </h4>
                <hr/>
            </div>
            <div class="clear">
                <?php
                $data = $allPlugins;
                ?>
                <form action="client_add_func.php" method="post" id="create-client-plugin" enctype="multipart/form-data">

                    <!-------------------- Settings -------------------->

                    <div class="card" style="">
                        <div class="card-body">
                            <div class="clear">
                                <h4 class=""><b>Settings</b></h4>
                                <hr/>
                            </div>
                            <div class="clear">

                                <div class="form-group">
                                    <label for="type">Choose type</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="">----- Please choose -----</option>
                                        <option value="points" >Points</option>
                                        <option value="entries" >Entries</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="totalpoints">Total points/entries</label>
                                    <input type="text" class="form-control" name="totalpoints" id="totalpoints" aria-describedby="helpIdTitle" placeholder="total points">
                                </div>

                                <div class="form-group">
                                    <label for="offersleft">Offers left</label>
                                    <input type="number" min="0" max="10"
                                           class="form-control" name="offersleft" id="offersleft"
                                           aria-describedby="helpIdOffersLeft"
                                           placeholder="enter offers left">
                                </div>

                                <div class="form-group">
                                    <label for="expiry">Expiry</label>
                                    <input type="date"
                                           class="form-control" name="expiry" id="expiry"
                                           aria-describedby="helpIdExpiry"
                                           placeholder="enter expiry">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-------------------- Branding -------------------->

                    <div class="card" style="">
                        <div class="card-body">
                            <div class="clear">
                                <h4 class=""><b>Branding</b></h4>
                                <hr/>
                            </div>
                            <div class="clear">

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text"
                                           class="form-control" name="title" id="title"
                                           aria-describedby="helpIdTitle"
                                           placeholder="enter title">
                                    <small id="helpIdTitle" class="form-text text-muted">Title of your widget</small>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description"
                                              rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="promotioncontent">Promotion content</label>
                                    <textarea class="form-control" name="promotioncontent" id="promotioncontent"
                                              rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="brand_media_type">Choose Type</label>
                                    <select class="form-control" name="brand_media_type" id="brand_media_type" required>
                                        <option value="">----- Please choose -----</option>
                                        <option value="video">Video</option>
                                        <option value="picture">Picture</option>
                                        <option value="slide_show">SlideShow</option>
                                    </select>
                                </div>
                                <div class="form-group d-none" id="brand_pic_container">
                                    <label for="brand_pic_type">Choose picture type</label>
                                    <select class="form-control" name="brand_pic_type" id="brand_pic_type" >
                                        <option value="">----- Please choose -----</option>
                                        <option value="url">URL</option>
                                        <option value="upload">Image</option>
                                    </select>
                                </div>
                                <div class="form-group d-none" id="brand_pic_url_container">
                                    <label for="brand_pic_url">URL</label>
                                    <input id="brand_pic_url" name="brand_pic_url" type="text" placeholder="" class="form-control input-md">
                                </div>
                                <div class="form-group d-none" id="brand_pic_upload_container">
                                    <label for="brand_pic_upload">Image</label>
                                    <input type="file" id="brand_pic_upload" name="brand_pic_upload" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp">
<!--                                        <div id="file_name_0"></div>-->
                                </div>
                                <div class="form-group d-none" id="brand_video_container">
                                    <label for="brand_video_url">Video</label>
                                    <input id="brand_video_url" name="brand_video_url" type="text" placeholder="" class="form-control input-md">
                                </div>
                                <div class="d-none" id="brand_slide_container">
                                    <div class="form-group" id="slides">
                                        <label class="control-label" for="field1">SlideShow URL</label>
                                        <div class="controls">
                                            <div>
                                                <div class="entry input-group col-xs-6">
                                                    <input class="form-control" name="slides[]" type="text" placeholder="Enter slide show URL." />
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <span style="font-size: 18px; font-weight: 700;" class="glyphicon glyphicon-plus">+</span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="back_img_url">Background</label>
                                    <input id="back_img_url" name="back_img_url" type="text" placeholder="enter background URL" class="form-control input-md">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-------------------- Actions -------------------->

                    <div class="card" style="">
                        <div class="card-body">
                            <div class="clear">
                                <h4 class=""><b>Actions</b></h4>
                                <hr/>
                            </div>
                            <div class="clear">

                                <div class="form-group">
                                    <label for="network">Choose Network</label>
                                    <select class="form-control" name="network" id="network" required>
                                        <option value="">----- Please choose -----</option>
                                        <option value="facebook">Facebook</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="action">Choose Action</label>
                                    <select class="form-control" name="action" id="action" required>
                                        <option value="">----- Please choose -----</option>
                                        <?php
                                        if ($data && count($data)>0) {
                                            foreach($data as $idx => $plugin):
                                                ?>
                                                <option value="<?php echo $plugin->getFilename();?>"><?php echo $plugin->getActionName();?></option>
                                            <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if ($data && count($data)>0) {
                                        foreach($data as $idx => $plugin):

                                            ?>
                                            <input type="hidden"
                                                   id="plugin-<?php echo $plugin->getFilename(); ?>"
                                                   name="plugin-<?php echo $plugin->getFilename(); ?>"
                                                   value="<?php echo $plugin->getType();?>" />
                                        <?php
                                        endforeach;
                                    }
                                    ?>
                                </div>

                                <div class="d-none" id="gameContainer">
                                    <?php
                                    if ($data && count($data)>0) {
                                    foreach($data as $idx => $plugin):
                                        if($plugin->getType() == 'play-then-share') {?>
                                            <div class="choose--game d-none" style="margin-bottom: 10px; margin-top: 10px;" id="choose_game_<?php echo $plugin->getFilename();?>">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_<?php echo $plugin->getFilename();?>">
                                                    Choose Game
                                                </button>
                                            </div>
                                        <?php }

                                    endforeach;
                                    }?>
                                    <div class="d-none" style="margin-top: 20px; margin-bottom: 20px;" id="game_preview_container">
                                        <img src="" width="65%" id="game_preview_image" />
                                    </div>
                                    <input type="hidden" id="game_key" name="game_key" value="-1" />
                                    <input type="hidden" id="game_name" name="game_name" value="" />
                                    <input type="hidden" id="game_iframe" name="game_iframe" value="" />
                                    <input type="hidden" id="game_preview" name="game_preview" value="" />
                                </div>
                                <div class="d-none" id="descriptionContainer">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="summernote" name="submit_description"></textarea>
                                    </div>
                                </div>
                                <div class="d-none" id="selectShareContainer">
                                    <div class="form-group">
                                        <label for="shareDescription">Description</label>
                                        <textarea class="form-control" name="shareDescription" id="shareDescription" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="selectType">Choose Type</label>
                                        <select class="form-control" name="selectType" id="selectType">
                                            <option value="">----- Please choose -----</option>
                                            <option value="image">Image select</option>
                                            <option value="checkbox">Checkbox</option>
                                        </select>
                                    </div>
                                    <div class="card d-none" id="pictureContainer" style="">
                                        <div class="card-body">
                                            <div class="clear">
                                                <h4 class="">
                                                    Enter Picture
                                                </h4>
                                                <hr/>
                                            </div>
                                            <div class="clear">
                                                <div id="field">
                                                    <div id="field0">
                                                        <div class="card" style="">
                                                            <div class="card-body">
                                                                <div class="clear">
                                                                    <div class="form-group">
                                                                        <label for="picture_name_0">Name</label>
                                                                        <input id="picture_name_0" name="picture_name[]" type="text" placeholder="" class="form-control input-md">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="network">Choose Pic Mode</label>
                                                                        <select class="form-control" name="pic_mode[]" id="pic_mode_0" onchange="changePictureMode(0)">
                                                                            <option value="">----- Please choose -----</option>
                                                                            <option value="url">URL</option>
                                                                            <option value="upload">Upload</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group d-none" id="url_container_0">
                                                                        <label for="picture_url_0">URL</label>
                                                                        <input id="picture_url_0" name="picture_url[]" type="text" placeholder="" class="form-control input-md">
                                                                    </div>
                                                                    <div class="form-group d-none" id="upload_container_0">
                                                                        <label for="picture_src_0">Image</label>
                                                                        <input type="file" id="picture_src_0" name="picture_src_0" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp">
                                                                        <div id="file_name_0"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Button -->
                                                <div class="form-group">
                                                    <button type="button" id="add-more" name="add-more" class="btn btn-primary">Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-none" id="checkboxContainer">
                                        <div id="checkboxField">
                                            <div id="checkboxField0">
                                                <div class="form-group">
                                                    <input id="checkbox_label_0" name="checkbox_label[]" type="text" placeholder="Enter checkbox label" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="add-more-checkbox" name="add-more-checkbox" class="btn btn-primary">Add More</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none" id="scratchContainer">
                                    <div class="form-group">
                                        <label for="scratchUrl">Select URL</label>
                                        <input type="text" class="form-control" name="scratchUrl" id="scratchUrl" aria-describedby="helpIdUrl" placeholder="enter url">
                                    </div>
                                </div>
                                <div class="d-none" id="urlContainer">
                                    <div class="form-group">
                                        <label for="url">Select URL/Embed code </label>
                                        <input type="text" class="form-control" name="url" id="url" aria-describedby="helpIdUrl" placeholder="enter url">
                                    </div>
                                    <div class="form-group">
                                        <label for="embedcode">Embed code</label>
                                        <textarea class="form-control" name="embedcode" id="embedcode" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="d-none" id="friendContainer">
                                    <div class="form-group">
                                        <label for="numFriends">Number of friends</label>
                                        <input type="text"
                                               class="form-control" name="numFriends" id="numFriends"
                                               aria-describedby="helpIdFriends"
                                               placeholder="enter number of friends">
                                    </div>
                                </div>
                                <div class="d-none" id="recordContainer">
                                    <div class="form-group">
                                        <label for="record_type">Choose option</label>
                                        <select class="form-control" name="record_type" id="record_type">
                                            <option value="">----- Please choose -----</option>
                                            <option value="audio">Audio</option>
                                            <option value="video">Video</option>
                                            <option value="image">Image</option>
                                            <option value="gif">Gif</option>
                                        </select>
                                    </div>
                                    <div class="d-none form-group" id="lengthContainer">
                                        <label for="record_length">Length</label>
                                        <input type="number"
                                               class="form-control" name="record_length" id="record_length"
                                               aria-describedby="helpIdRecordLength"
                                               placeholder="enter record length">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="numpoint">Number of points</label>
                                    <input type="text"
                                           class="form-control" name="numpoint" id="numpoint"
                                           aria-describedby="helpIdNumpoint"
                                           placeholder="enter number of point">
                                </div>
                                <div class="form-group">
                                    <label for="visitAction">Visit action</label>
                                    <input type="text"
                                           class="form-control" name="visitAction" id="visitAction"
                                           aria-describedby="helpIdVisitAction"
                                           placeholder="enter action name">
                                </div>
                                <div class="form-group">
                                    <label for="shareAction">Share action</label>
                                    <input type="text"
                                           class="form-control" name="shareAction" id="shareAction"
                                           aria-describedby="helpIdShareAction"
                                           placeholder="enter share button name">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card" style="">
                        <div class="card-body">
                            <div class="clear">
                                <h4 class="">
                                    <b>Options</b>
                                </h4>
                                <hr/>
                            </div>
                            <div class="clear">

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="exitpopup"
                                               id="exitpopup"
                                               value="1">
                                        Exit popup
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="directoryinclusion"
                                               id="directoryinclusion"
                                               value="1">
                                        Directory inclusion
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <!--                            <a href="--><?php //echo PATH_ROOT ;?><!--/client" class="btn btn-default">Cancel</a>-->
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($data && count($data)>0) {
        foreach($data as $idx => $plugin):
            if($plugin->getType() == 'play-then-share') {
                $game = $plugin->getGame();
                ?>
                <!-- The Modal -->
                <div class="modal fade" id="myModal_<?php echo $plugin->getFilename();?>">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">What are your Interest? </h4>
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <div class="modal-body choice-modal" >
                                <div class="container-fluid">
                                    <div class="row inner-scroll" >
                                        <?php
                                        foreach($game as $game_idx => $item):
                                            $item = (array)$item;
                                            ?>
                                            <div class="col-md-4">
                                                <div class="gallery-card">
                                                    <div class="gallery-card-body">
                                                        <label class="block-check">
                                                            <img src="<?php echo $item['preview'];?>" class="img-responsive" />
                                                            <input type="checkbox" class="selected--game" id="selected_game_<?php echo $plugin->getFilename();?>_<?php echo $game_idx;?>"
                                                                   onchange="onSelectGame('<?php echo $item['name'];?>', '<?php echo $item['iframe'];?>', '<?php echo $item['preview'];?>', '<?php echo $game_idx;?>')">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <div class="mycard-footer">
                                                            <a href="<?php echo $item['iframe']?>" target="_blank" class="card-link"><?php echo $item['name'];?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        endforeach;
    }
    ?>
</div>
<div id="list-container">

</div>
<script type="text/javascript">


    $(document).ready(function () {
        $('#summernote').summernote()
        // this is the id of the form
        $("#create-client-plugin").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = 'client_add_func.php';
            var fd = new FormData(this);

            $.ajax({
                type: "POST",
                // dataType: "json",
                contentType: false,
                processData: false,
                url: url,
                data: fd, // serializes the form's elements.
                // data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    var success = data.success;
                    var message = data.message;
                    if (success) {
                        $("#create-client-plugin").trigger("reset");
                        $('#pictureContainer').addClass('d-none')
                        $('#urlContainer').removeClass('d-none')
                    }
                    // alert(message); // show response from the php script.
                    alert('Created Plugin successfully.'); // show response from the php script.
                    // window.location.href = "/socialsuite";
                }
            });


        });

        var next = 0;
        $("#add-more").click(function(e){
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn =
                '<div id="field'+ next +'" name="field'+ next +'">' +
                '<div class="card" style="">' +
                '<div class="card-body">' +
                '<div class="clear">' +
                '<div class="form-group"> ' +
                '<label for="picture_name_' + next + '">Name</label>' +
                '<input id="picture_name_' + next + '" name="picture_name[]" type="text" placeholder="" class="form-control input-md"> ' +
                '</div>' +
                '<div class="form-group">\n' +
                '<label for="network">Choose Pic Mode</label>\n' +
                '<select class="form-control" onchange="changePictureMode(' + next + ')" name="pic_mode[]" id="pic_mode_' + next +'" required>\n' +
                '<option value="">----- Please choose -----</option>\n' +
                '<option value="url">URL</option>\n' +
                '<option value="upload">Upload</option>\n' +
                '</select>\n' +
                '</div>' +
                '<div class="form-group d-none" id="url_container_' + next + '"> ' +
                '<label for="picture_url_' + next + '">URL</label>' +
                '<input id="picture_url_' + next + '" name="picture_url[]" type="text" placeholder="" class="form-control input-md"> ' +
                '</div>' +
                '<div class="form-group d-none" id="upload_container_' + next + '">\n' +
                '<label for="picture_src_' + next + '">Image</label>\n' +
                '<input type="file" id="picture_src_' + next + '" name="picture_src' + next + '" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp">\n' +
                '<div id="file_name_' + next + '"></div>\n' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            var newInput = $(newIn);
            var removeBtn = '<div class="form-group"><button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div>';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source',$(addto).attr('data-source'));
            $("#count").val(next);

            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
        });

        var nextCheckbox = 0
        $("#add-more-checkbox").click(function(e){
            e.preventDefault();
            var addto = "#checkboxField" + nextCheckbox;
            var addRemove = "#checkboxField" + (nextCheckbox);
            nextCheckbox = nextCheckbox + 1;
            var newIn =
                '<div id="checkboxField'+ nextCheckbox +'" name="checkboxField'+ nextCheckbox +'">' +
                '<div class="form-group"> ' +
                '<input id="checkbox_label_' + nextCheckbox + '" name="checkbox_label[]" type="text" placeholder="Enter checkbox label" class="form-control input-md"> ' +
                '</div>' +
                '</div>';
            var newInput = $(newIn);
            var removeBtn = '<div class="form-group"><button id="remove' + (nextCheckbox - 1) + '" class="btn btn-danger remove-checkbox" >Remove</button></div>';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#checkboxField" + next).attr('data-source',$(addto).attr('data-source'));
            $("#count").val(next);

            $('.remove-checkbox').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#checkboxField" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
        });

        $('#brand_media_type').change(function() {
            var media_type = $(this).val()
            if(media_type == 'picture') {
                $('#brand_pic_container').removeClass('d-none')
                $('#brand_video_container').addClass('d-none')
                $('#brand_slide_container').addClass('d-none')
            } else if(media_type == 'video') {
                $('#brand_pic_container').addClass('d-none')
                $('#brand_video_container').removeClass('d-none')
                $('#brand_slide_container').addClass('d-none')
                $('#brand_pic_url_container').addClass('d-none')
                $('#brand_pic_upload_container').addClass('d-none')
            } else if(media_type == 'slide_show') {
                $('#brand_pic_container').addClass('d-none')
                $('#brand_video_container').addClass('d-none')
                $('#brand_slide_container').removeClass('d-none')
                $('#brand_pic_url_container').addClass('d-none')
                $('#brand_pic_upload_container').addClass('d-none')
            }
        })

        $('#brand_pic_type').change(function() {
            var pic_type = $(this).val()
            if(pic_type == 'url') {
                $('#brand_pic_url_container').removeClass('d-none')
                $('#brand_pic_upload_container').addClass('d-none')
            } else if(pic_type == 'upload') {
                $('#brand_pic_url_container').addClass('d-none')
                $('#brand_pic_upload_container').removeClass('d-none')
            }
        })

        $('#action').change(function() {
            var actionValue = $(this).val();
            var actionType = $('#plugin-' + actionValue).val()

            clearContainer()
            if(actionType == 'select-and-share') {
                $('#selectShareContainer').removeClass('d-none')
            } else if(actionType == 'share-and-refer') {
                $('#friendContainer').removeClass('d-none')
            } else if (actionType == 'scratch-and-share' || actionType == 'spin-and-share') {
                $('#scratchContainer').removeClass('d-none')
            } else if (actionType == 'play-then-share') {
                $('#gameContainer').removeClass('d-none')
                $('#scratchContainer').removeClass('d-none')
                hideAllGameButton()
                $('#choose_game_' + actionValue).removeClass('d-none')
            } else if (actionType == 'submit-then-share') {
                $('#urlContainer').removeClass('d-none')
                $('#descriptionContainer').removeClass('d-none')
            } else if (actionType == 'record-and-share') {
                $('#recordContainer').removeClass('d-none')
                $('#scratchContainer').removeClass('d-none')
            } else {
                $('#urlContainer').removeClass('d-none')
            }
        })

        $('#selectType').change(function() {
            var selectType = $(this).val()
            if(selectType == 'image') {
                $('#pictureContainer').removeClass('d-none')
                $('#checkboxContainer').addClass('d-none')
            } else if (selectType == 'checkbox') {
                $('#pictureContainer').addClass('d-none')
                $('#checkboxContainer').removeClass('d-none')
            }
        })

        $('#record_type').change(function() {
            var recordType = $(this).val()

            if(recordType == 'image') {
                $('#lengthContainer').addClass('d-none')
            } else {
                $('#lengthContainer').removeClass('d-none')
                if(recordType == 'audio') {
                    $("#record_length").prop('min',5);
                    $("#record_length").prop('max',30);

                } else if(recordType == 'video') {
                    $("#record_length").prop('min',5);
                    $("#record_length").prop('max',60);

                } else if(recordType == 'gif') {
                    $("#record_length").prop('min',5);
                    $("#record_length").prop('max',15);

                }
                $('#record_length').on('mouseup keyup', function () {
                    var max = parseInt($(this).attr('max'));
                    var min = parseInt($(this).attr('min'));
                    $(this).val(Math.min(max, Math.max(min, $(this).val())));
                });
            }
        })

        function clearContainer() {
            $('#selectShareContainer').addClass('d-none')
            $('#urlContainer').addClass('d-none')
            $('#friendContainer').addClass('d-none')
            $('#scratchContainer').addClass('d-none')
            $('#gameContainer').addClass('d-none')
            $('#descriptionContainer').addClass('d-none')
            $('#recordContainer').addClass('d-none')
        }
    });

    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls div:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        console.log(controlForm, currentEntry, newEntry, "plus button===")
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus" style="font-size: 18px; margin-top: 8px; font-weight: 700;"> - </span>');
    }).on('click', '.btn-remove', function(e)
    {
        $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });

    function changePictureMode(idx) {
        var mode = $('#pic_mode_' + idx).val()
        if(mode == 'url') {
            $('#url_container_' + idx).removeClass('d-none')
            $('#upload_container_' + idx).addClass('d-none')
        } else {
            $('#url_container_' + idx).addClass('d-none')
            $('#upload_container_' + idx).removeClass('d-none')
        }
    }

    function hideAllGameButton() {
        $('.choose--game').addClass('d-none')
    }

    function onPreview(iframe) {
        window.open('', '', )
    }

    function uncheckAll() {
        // var checkboxes = $('.selected--game')
        $('.selected--game').prop('checked', false)
        // for(var i = 0 ; i < checkboxes.length; i ++) {
        //     checkboxes[i].prop('checked', false)
        // }
    }

    function onSelectGame(name, url, preview, idx) {
        var game_key = $('#game_key').val()
        var actionValue = $('#action').val();

        uncheckAll()
        if(game_key == idx) {
            $('#game_key').val(-1)
            $('#game_name').val("")
            $('#game_iframe').val("")
            $('#game_preview').val("")
            $('#game_preview_container').addClass('d-none')
        } else {
            $('#game_key').val(idx)
            $('#game_name').val(name)
            $('#game_iframe').val(url)
            $('#game_preview').val(preview)

            $('#selected_game_' + actionValue + '_' + idx).prop('checked', true)
            $('#game_preview_container').removeClass('d-none')
            $('#game_preview_image').prop('src', preview)
        }
    }
</script></body>
</html>
