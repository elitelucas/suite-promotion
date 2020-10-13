<?php
    require_once '../initial.php';
    require_once DIR_ROOT . '/db/Plugin.php';
    require_once DIR_ROOT . '/db/Social.php';

    $dataPost = $_GET;
    @$file = $dataPost['file'];
    if($file) {
        $social = new Social();
        $filePath = DIR_ROOT .  '/plugins/' . $file . '.php';

        $social->load($filePath);
        $dataPost = $social->toArray();
        if (!isset($dataPost['file'])) {
            $dataPost['file'] = $file;
        }
    }
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
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="<?php echo PATH_ROOT ?>/plugins/jquery/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card" style="">
        <div class="card-body">
            <div class="clear">
                <h4 class="card-title">
                    <a href="<?php echo PATH_ROOT ;?>/admin">All Plugins</a> &raquo; Edit
                </h4>
            </div>
            <div class="clear">

                <?php
                $data = $dataPost;
                @$message = $data['message'];
                @$type = $data['type'];
                @$network = $data['network'];
                @$id = $data['id'];
//                @$placeholder = $data['placeholder'];
                @$actionName = $data['actionName'];
                @$visitLink = $data['visitLink'];
                @$shareLink = $data['shareLink'];
                @$shareTitle = $data['shareTitle'];
                @$delayTime = $data['delayTime'];
                @$filename = $data['filename'];

                if ($message) {
                    ?>
                    <div class="alert alert-success" role="alert"><?php echo $message?></div>
                    <?php
                }
                ?>
                <form action="" method="post" id="edit-plugin">
                    <input type="hidden" name="file" value="<?php echo @$data['file']?>">
                    <div class="form-group">
                        <label for="type">Choose type</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="">----- Please choose -----</option>
                            <option value="visit-and-share" <?php if ($type == 'visit-and-share') echo 'selected';?>>Visit and Share</option>
                            <option value="share-and-visit" <?php if ($type == 'share-and-visit') echo 'selected';?>>Share and Visit</option>
                            <option value="share-then-submit" <?php if ($type == 'share-then-submit') echo 'selected';?>>Share then Submit</option>
                            <option value="submit-then-share" <?php if ($type == 'submit-then-share') echo 'selected';?>>Submit then Share</option>
                            <option value="select-and-share" <?php if ($type == 'select-and-share') echo 'selected';?>>Select and Share</option>
                            <option value="share-and-refer" <?php if ($type == 'share-and-refer') echo 'selected';?>>Refer and Share</option>
                            <option value="scratch-and-share" <?php if ($type == 'scratch-and-share') echo 'selected';?>>Scratch and Share</option>
                            <option value="spin-and-share" <?php if ($type == 'spin-and-share') echo 'selected';?>>Spin and Share</option>
                            <option value="play-then-share" <?php if ($type == 'play-then-share') echo 'selected';?>>Play then Share</option>
                            <option value="record-and-share" <?php if ($type == 'record-and-share') echo 'selected';?>>Record and Share</option>
                        </select>
                    </div>
                    <div class="card d-none" id="gameContainer" style="">
                        <div class="card-body">
                            <div class="clear">
                                <h4 class="">
                                    Enter Game
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
                                                        <label for="game_name_0">Name</label>
                                                        <input id="game_name_0" name="game_name[]" type="text" placeholder="" class="form-control input-md">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="game_iframe_0">IFrame</label>
                                                        <input id="game_iframe_0" name="game_iframe[]" type="text" placeholder="" class="form-control input-md">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="preview_url_0">Preview URL</label>
                                                        <input id="preview_url_0" name="preview_url[]" type="text" placeholder="" class="form-control input-md">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="preview_src_0">Preview Image</label>
                                                        <input type="file" id="preview_src_0" name="preview_src_0" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp">
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
                    <div class="form-group">
                        <label for="network">Choose Network</label>
                        <select class="form-control" name="network" id="network" required>
                            <option value="">----- Please choose -----</option>
                            <option value="facebook" <?php if ($network == 'facebook') echo 'selected';?>>Facebook</option>
                        </select>
                    </div>
                    <div class="form-group has-succes">
                        <label class="form-control-label" for="id">ID</label>
                        <input type="text" class="form-control" required name="id" id="id"
                               value="<?php echo $id?>">
                        <small id="helpId" class="form-text text-muted">Ex: facebook</small>
                    </div>
<!--                    <div class="form-group has-succes">-->
<!--                        <label class="form-control-label" for="placeholder">Placeholder</label>-->
<!--                        <input type="text" class="form-control form-control-success" required name="placeholder" id="placeholder"-->
<!--                               value="--><?php //echo $placeholder?><!--">-->
<!--                        <small id="helpId" class="form-text text-muted">Ex: Visit our Facebook page</small>-->
<!--                    </div>-->
                    <div class="form-group has-succes">
                        <label class="form-control-label" for="actionName">Enter action name</label>
                        <input type="text" class="form-control form-control-success" required name="actionName" id="actionName"
                               value="<?php echo $actionName?>">
                        <small id="helpId" class="form-text text-muted">Ex: Share our facebook page</small>
                    </div>
<!--                    <div class="form-group has-succes">-->
<!--                        <label class="form-control-label" for="visitLink">Visit link</label>-->
<!--                        <input type="text" class="form-control form-control-success" required name="visitLink" id="visitLink"-->
<!--                               value="--><?php //echo $visitLink?><!--">-->
<!--                    </div>-->
                    <div class="form-group has-succes">
                        <label class="form-control-label" for="shareLink">Short codes</label>
                        <input type="text" class="form-control form-control-success" required name="shareLink" id="shareLink"
                               value="<?php echo $shareLink?>">
                        <small id="helpId" class="form-text text-muted">Use &lt;URL> and &lt;TITLE> for dynamic data (uppercase)</small>
                    </div>
                    <div class="form-group has-succes">
                        <label class="form-control-label" for="filename">Filename</label>
                        <input type="text" class="form-control form-control-success" required name="filename" id="filename"
                               value="<?php echo $filename?>">
                    </div>

                    <?php
                    $delayTime = (int)$delayTime;
                    if ($delayTime < 1) {
                        $delayTime = 1;
                    }

                    ?>
                    <div class="form-group has-succes">
                        <label class="form-control-label" for="delayTime">Delay Time</label>
                        <input type="text" class="form-control form-control-success" required name="delayTime" id="delayTime"
                               value="<?php echo $delayTime?>">
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo PATH_ROOT ;?>/admin" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="list-container">
</div>
<script type="text/javascript">
    $(document).ready(function () {

        function loadAllPlugins() {
            $.ajax({
                url: "listall.php",
                cache: false,
                context: document.body
            }).done(function(data) {
                $( '#list-container' ).html( data );
            });
        }

        loadAllPlugins();

        // this is the id of the form
        $("#edit-plugin").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = 'admin_edit_func.php';
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
                    loadAllPlugins();
                    var success = data.success;
                    var message = data.message;
                    if (success) {
                        $("#edit-plugin").trigger("reset");
                        // $('#pictureContainer').addClass('d-none')
                        // $('#urlContainer').removeClass('d-none')
                    }
                    // alert(message); // show response from the php script.
                    alert('Updated Plugin successfully.'); // show response from the php script.
                    // window.location.href = "/socialsuite";
                }
            });
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
            '<label for="game_name_' + next + '">Name</label>' +
            '<input id="game_name_' + next + '" name="game_name[]" type="text" placeholder="" class="form-control input-md"> ' +
            '</div>' +
            '<div class="form-group"> ' +
            '<label for="game_iframe_' + next + '">IFrame</label>' +
            '<input id="game_iframe_' + next + '" name="game_iframe[]" type="text" placeholder="" class="form-control input-md"> ' +
            '</div>' +
            '<div class="form-group"> ' +
            '<label for="preview_url_' + next + '">Preview URL</label>' +
            '<input id="preview_url_' + next + '" name="preview_url[]" type="text" placeholder="" class="form-control input-md"> ' +
            '</div>' +
            '<div class="form-group">\n' +
            '<label for="preview_src_' + next + '">Preview Image</label>\n' +
            '<input type="file" id="preview_src_' + next + '" name="preview_src' + next + '" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp">\n' +
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
    $('#type').on('change', function() {
        var pluginType = $(this).val()
        if(pluginType == 'play-then-share') {
            $('#gameContainer').removeClass('d-none')
        } else {
            $('#gameContainer').addClass('d-none')
        }
    })
</script>
</body>
</html>
