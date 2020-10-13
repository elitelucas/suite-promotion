<?php

include_once 'header.php';

?>

    <div class="container h-100">

        <div class="d-flex justify-content-center h-100" style="background: #f7f7f7">

            <div class="searchbar">

                <div class="col-md-8">
                    <h3>Enter Username</h3>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-2 col-xs-4">
                    <select class="form-control" id="type">
                        <option value="fb">Facebook</option>
                        <option value="insta">Instagram</option>
                        <option value="twitter">Twitter</option>
                        <option value="youtube">Youtube</option>
                        <option value="pinterest">Pinterest</option>
                        <option style="display: none;" value="linkedin">Linkedin</option>
                        <option value="flickr">Flickr</option>
                    </select>
                </div>

                <div class="col-md-8 col-xs-6">
                    <input class="search_input form-control" type="text" id="search" placeholder="Search...">
                </div>

                <div class="col-md-2 col-xs-2">
                    <button class="search_icon btn btn-info "><span class="glyphicon glyphicon-search"></span></button>
                </div>

                <div class="clearfix"></div>

            </div>

        </div>

        <div class="clearfix"></div>
        <br>

        <div id="result"></div>

    </div>

    <div id="wait" style="display:none;width:100px;height:100px;position:absolute;top:45%;left:50%;padding:2px;z-index: 9999">
        <img src='wait.gif' width="100px" height="100px" />
    </div>

        <script type="text/javascript">
            $(document).ready(function() {

                $(document).ajaxStart(function() {
                    $("#wait").css("display", "block");
                });

                $(document).ajaxComplete(function() {
                    $("#wait").css("display", "none");
                });

                $(document).on('click', ".search_icon", function(e) {
                    e.preventDefault;
                    $('#result').empty();
                    var search = $('#search').val();
                    var type = $('#type').val();

                    if (type == 'twitter') {
                        $.ajax({
                            url: "twitter.php",
                            type: 'POST',
                            data: {
                                username: search
                            },
                            success: function(data) {
                                $('#result').html(data);
                            }
                        });
                        return;
                    }

                    if (type == 'insta') {
                        jQuery.instagramFeed({
                            'username': search,
                            'container': "#result",
                            'display_profile': true,
                            'display_biography': false,
                            'display_gallery': false,
                            'get_raw_json': false,
                            'callback': null,
                            'styling': false,
                            'items': 0,
                            'items_per_row': 4,
                            'margin': 1
                        });
                        return;
                    }

                    if (search != '') {

                        $.ajax({
                            url: "ajax.php",
                            type: 'POST',
                            data: {
                                action: type,
                                username: search
                            },
                            success: function(data) {

                                $('#result').html(data);

                                if (type == 'fb') {
                                    var url = $('#result').find('.fbimg').attr('src');
                                    let bloburl = void 0;
                                    let img = new Image;
                                    const getResourceName = fetch(url)
                                    .then(response => Promise.all([response.url, response.blob()]))
                                    .then(([resource, blob]) => {
                                        bloburl = URL.createObjectURL(blob);
                                        img.src = bloburl;
                                        return resource
                                    });

                                    fetch(url).then(res => {
                                        $('#result').find('.fbinput').val(res.url)
                                    });

                                }
                            }
                        });
                    }
                    return false;

                });
            });

            function pinterestCallback(data) {
                var html = '';
                var user = data.data.user;
                html += "<img style='width:100px;' src='" + user.image_small_url + "' >";
                html += user.full_name;
                console.log(data);
                console.log(user);
                jQuery('#result').html(html);
            }

        </script>
  </body>
</html>
