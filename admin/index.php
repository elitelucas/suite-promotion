<?php require_once '../initial.php'; ?>
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
                    <a href="<?php echo PATH_ROOT ;?>/admin">All Plugins</a> &raquo; Create new plugin
                </h4>
            </div>
            <div class="clear">

                <?php
//                $data = $this->data;
//                @$message = $data['message'];
//                @$type = $data['type'];
//                @$network = $data['network'];
//                @$id = $data['id'];
//                @$placeholder = $data['placeholder'];
//                //                    @$title = $data['title'];
//                @$actionName = $data['actionName'];
//                @$visitLink = $data['visitLink'];
//                @$shareLink = $data['shareLink'];
//                @$shareTitle = $data['shareTitle'];
//                @$delayTime = $data['delayTime'];
//                @$filename = $data['filename'];

//                if ($message) {
//                    ?>
<!--                    <div class="alert alert-success" role="alert">--><?php //echo $message?><!--</div>-->
<!--                    --><?php
//                }
//                ?>
                <form action="" method="post" id="create-plugin">

                    <div class="form-group">
                        <label for="type">Choose type</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="">----- Please choose -----</option>
                            <option value="visit-and-share" >Visit and Share</option>
                            <option value="share-and-visit" >Share and Visit</option>
                            <option value="share-then-submit" >Share then Submit</option>
                            <option value="submit-then-share" >Submit then Share</option>
                            <option value="select-and-share" >Select and Share</option>
                            <option value="share-and-refer" >Refer and Share</option>
                            <option value="scratch-and-share" >Scratch and Share</option>
                            <option value="spin-and-share" >Spin and Share</option>
                            <option value="play-then-share" >Play then Share</option>
                            <option value="record-and-share" >Record and Share</option>
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
                            <option value="facebook">Facebook</option>
                        </select>
						
						<br>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                        Create Network
                       </button>

						<button type="button" class="btn btn-default">
                        Delete Selected Network
                       </button>					   						
						
                    </div>
                    <div class="form-group has-success">
                        <label class="form-control-label" for="id">ID</label>
                        <input type="text" class="form-control" required name="id" id="id">
                        <small id="helpId" class="form-text text-muted">Ex: facebook</small>
                    </div>
<!--                    <div class="form-group has-success">-->
<!--                        <label class="form-control-label" for="placeholder">Placeholder</label>-->
<!--                        <input type="text" class="form-control form-control-success" required name="placeholder" id="placeholder">-->
<!--                        <small id="helpId" class="form-text text-muted">Ex: Visit our Facebook page</small>-->
<!--                    </div>-->
                    <!--                        <div class="form-group has-succes">-->
                    <!--                            <label class="form-control-label" for="title">Title</label>-->
                    <!--                            <input type="text" class="form-control form-control-success" required name="title" id="title"-->
                    <!--                                   value="--><?php //echo $title?><!--">-->
                    <!--                        </div>-->
                    <div class="form-group has-success">
                        <label class="form-control-label" for="actionName">Enter action name</label>
                        <input type="text" class="form-control form-control-success" required name="actionName" id="actionName">
                        <small id="helpId" class="form-text text-muted">Ex: Share our facebook page</small>
                    </div>
                    <!--                        <div class="form-group has-succes">-->
                    <!--                            <label class="form-control-label" for="visitLink">Visit link</label>-->
                    <!--                            <input type="text" class="form-control form-control-success" required name="visitLink" id="visitLink"-->
                    <!--                                   value="--><?php //echo $visitLink?><!--">-->
                    <!--                        </div>-->
                    <div class="form-group has-success">
                        <label class="form-control-label" for="shareLink">Short codes</label>
                        <input type="text" class="form-control form-control-success" required name="shareLink" id="shareLink">
                        <small id="helpId" class="form-text text-muted">Use &lt;URL> and &lt;TITLE> for dynamic data (uppercase)</small>
                    </div>
                    <div class="form-group has-success">
                        <label class="form-control-label" for="filename">Filename</label>
                        <input type="text" class="form-control form-control-success" required name="filename" id="filename">
                    </div>

                    <div class="form-group has-success">
                        <label class="form-control-label" for="delayTime">Delay Time</label>
                        <input type="text" class="form-control form-control-success" required name="delayTime" id="delayTime">
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
<!-- --><?php //require_once 'listall.php';?>
</div>

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create Network</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

			<div class="form-group">
				<input type="text" class="form-control" required name="network" id="network" placeholder="https://www.facebook.com//sharer.php?u=<URL>&quote=<TITLE>">
			</div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
        $("#create-plugin").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = 'admin_add_func.php';
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
                        $("#create-plugin").trigger("reset");
                        // $('#pictureContainer').addClass('d-none')
                        // $('#urlContainer').removeClass('d-none')
                    }
                    // alert(message); // show response from the php script.
                    alert('Created Plugin successfully.'); // show response from the php script.
                    // window.location.href = "/socialsuite";
                }
            });

            // $.ajax({
            //     type: "POST",
            //     dataType: "json",
            //     url: url,
            //     data: form.serialize(), // serializes the form's elements.
            //     success: function(data)
            //     {
            //         loadAllPlugins();
            //         var success = data.success;
            //         var message = data.message;
            //         if (success) {
            //             $("#create-plugin").trigger("reset");
            //         }
            //         alert(message); // show response from the php script.
            //     }
            // });


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
