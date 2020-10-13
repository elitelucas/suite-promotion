<?php
    require_once '../initial.php';
    require_once DIR_ROOT . '/db/Plugin.php';
    require_once DIR_ROOT . '/db/Social.php';

    $social = new Social();
    $allData = $social->loadAll();
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
<div class="">
    <div class="card" style="">
        <div class="card-body">
            <div class="clear">
                <h4 class="card-title">All plugins</h4>
            </div>
            <div class="clear">

                <?php
                @$message = $allData['message'];
                if ($message) {
                    ?>
                    <div class="alert alert-success" role="alert"><?php echo $message?></div>
                    <?php
                }

                ?>
                <a href="<?php echo PATH_ROOT?>/admin" class="btn btn-primary">Add</a>

                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Type</th>
                        <th>network</th>
                        <th>id</th>
                        <th>title</th>
<!--                        <th>actionName</th>-->
                        <th>visitLink</th>
                        <th>shareLink</th>
                        <th>delayTime</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                <?php
//                print_r($allData);
                if ($allData && count($allData)>0) {
                    foreach($allData as $key => $data):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data->getFilename());?>.php</td>
                            <td><?php echo htmlspecialchars($data->getType());?></td>
                            <td><?php echo htmlspecialchars($data->getNetwork());?></td>
                            <td><?php echo htmlspecialchars($data->getID());?></td>
                            <td><?php echo htmlspecialchars($data->getTitle());?></td>
                            <td><?php echo htmlspecialchars($data->getVisitLink());?></td>
                            <td><?php echo htmlspecialchars($data->getShareLink());?></td>
                            <td><?php echo htmlspecialchars($data->getDelayTime());?></td>
                            <td>
                                <a href="edit.php?file=<?php echo $data->getFilename();?>" class="btn btn-success">Edit</a>
                                <a href="admin_delete_func.php?file=<?php echo $data->getFilename();?>&t=<?php echo time()?>" ref="<?php echo htmlentities($data->getFilename());?>.php" class="btn btn-danger deleteplugin">Delete</a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                }
                ?>
                    </tbody>
            </div>
        </div>
    </div>
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

        $('.deleteplugin').click(function(e) {
            e.preventDefault();
            var name = $(this).attr('ref');
            var href = $(this).attr('href');
            if (confirm('Do you want to delete ' + name + '?')) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: href,
                    success: function(data)
                    {
                        loadAllPlugins();
                        var success = data.success;
                        var message = data.message;
                        alert(message); // show response from the php script.
                    }
                });

            }
        });

    });
</script>
</body>
</html>
