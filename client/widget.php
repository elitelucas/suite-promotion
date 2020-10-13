<?php
require_once '../initial.php';
require_once '../db/Plugin.php';
require_once '../db/Social.php';

$plugin = new Plugin();
$data = $plugin->load();
$uniqueId = $plugin->getUniqueId();
$spin_limit = 3;

@$referralId = $_GET['id'];
@$info = (array)$data['info'];
@$backgroundImage = $info['background_image'];
@$pluginTitle = $info['title'];
@$description = $info['description'];
@$promotioncontent = $info['promotioncontent'];
@$totalpoints = (int)$info['totalpoints'];
@$expiry = $info['expiry'];
@$dayLeft = (int)$info['dayLeft'];
@$offersleft = (int)$info['offersleft'];
@$network = $info['network'];
@$brandMedia = (array)$info['media'];
@$pluginType = $info['type'];
@$maxPoints = $totalpoints;

$now = time(); // or your date as well
$your_date = strtotime($expiry);
$datediff = $your_date - $now;

$currentDay = round($datediff / (60 * 60 * 24));

$social = new Social();
$allPlugins = $social->loadAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $pluginTitle?></title>

<!-- Meta Data -->
<meta name="title" content="<?php echo $pluginTitle?>">
<meta name="description" content="<?php echo $pluginCaption?>">
<meta name="author" content="Social Suite | https://suite.social/">
<meta name="keywords" content="Blog Promotions, Blog Marketing, Facebook Promotions, Facebook Marketing, Flickr Promotions, Flickr Marketing, Google+ Promotions, Google+ Marketing, Instagram Promotions, Instagram Marketing, Linkedin Promotions, Linkedin Marketing, Periscope Promotions, Periscope Marketing, Pinterest Promotions, Pinterest Marketing, Reddit Promotions, Reddit Marketing, Snapchat Promotions, Snapchat Marketing, Social Media Automation, Social Media Bot, Social Media Dashboard, Social Media Groups, Social Media Hub, Social Media Promotions, Social Media Manager, Social Media Marketer, Social Media Marketing, Social Media Monitoring, Social Media Poster, Social Media Promotion, Social Media Publisher, Social Media Publishing, Social Media Reports, Social Media Scheduler, Social Media Stream, Social Media Training, Social Media Wall, Soundcloud Promotions, Soundcloud Marketing, StumbleUpon Promotions, StumbleUpon Marketing, Tumblr Promotions, Tumblr Marketing, Twitter Promotions, Twitter Marketing, Vimeo Promotions, Vimeo Marketing, Vk Promotions, Vk Marketing, WhatsApp Promotions, WhatsApp Marketing, Wordpress Promotions, Wordpress Marketing, XING Promotions, XING Marketing, YouTube Promotions, YouTube Marketing">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="English">
<meta name="revisit-after" content="7 days">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

<!-- Google Plus -->
<!-- Update your html tag to include the itemscope and itemtype attributes. -->
<!-- html itemscope itemtype="//schema.org/{CONTENT_TYPE}" -->
<meta itemprop="name" content="<?php echo $pluginTitle?>">
<meta itemprop="description" content="<?php echo $pluginCaption?>">
<meta itemprop="image" content="<?php echo $brandMedia['url']?>">

<!-- Twitter -->
<meta name="twitter:card" content="<?php echo $pluginTitle?>">
<meta name="twitter:site" content="@socialsuite">
<meta name="twitter:title" content="<?php echo $pluginTitle?>">
<meta name="twitter:description" content="<?php echo $pluginCaption?>">
<meta name="twitter:creator" content="@socialsuite">
<meta name="twitter:image:src" content="<?php echo $brandMedia['url']?>">
<meta name="twitter:player" content="">

<!-- Open Graph General (Facebook & Pinterest) -->
<meta property="og:url" content="<?php echo ($promo_url != '') ? $promo_url : '//suite.social'; ?>">
<meta property="og:title" content="<?php echo $pluginTitle?>">
<meta property="og:description" content="<?php echo $pluginCaption?>">
<meta property="og:site_name" content="Social Suite">
<meta property="og:image" content="<?php echo $brandMedia['url']?>">
<meta property="og:type" content="product">
<meta property="og:locale" content="en_UK">

<!-- Open Graph Article (Facebook & Pinterest) -->
<meta property="article:section" content="Marketing">
<meta property="article:tag" content="Marketing">		

<!-- Mobile Specific Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />

<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />	
<meta name="HandheldFriendly" content="true" />	

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_ROOT ?>/images/favicon/favicon.ico">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo PATH_ROOT ?>/images/favicon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo PATH_ROOT ?>/images/favicon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo PATH_ROOT ?>/images/favicon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="256x256" href="<?php echo PATH_ROOT ?>/images/favicon/apple-touch-icon-256x256.png" />

<!-- Chrome for Android web app tags -->
<meta name="mobile-web-app-capable" content="yes" />
<link rel="shortcut icon" sizes="256x256" href="<?php echo PATH_ROOT ?>/images/favicon/apple-touch-icon-256x256.png" />

<!-- Social --> 
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/src/css/social-buttons.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/src/css/social-colors.css"> 

<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/fontawesome-free/css/all.min.css">

<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/src/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/src/css/style.css">

<!-- summernote -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/summernote/summernote-bs4.css">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- Spin Wheel (CSS) -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/spin-wheel/css/sweetalert2.min.css"> <!-- sweetalert2 -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/spin-wheel/css/superwheel.min.css"> <!-- superWheel -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/spin-wheel/css/style.css"> <!-- Resource style -->

<!-- Record -->
<link href="<?php echo PATH_ROOT;?>/plugins/record/css/video-js.min.css" rel="stylesheet">
<link href="<?php echo PATH_ROOT;?>/plugins/record/css/videojs.record.css" rel="stylesheet">

<style>

a {
	color: #666;
}

.content-wrapper {
	background: transparent;
}

.layout-top-nav .wrapper .main-header .brand-image {
	height: 25px;
}

.login-card-body, .register-card-body {
	padding: 0px;
}

.login-box, .register-box {
	width: 590px;
}

.login-box {
	box-shadow: 0 0 2px rgba(0,0,0,0.3), 0 3px 5px rgba(0,0,0,0.2);
	overflow: hidden;
}

.login-page, .register-page {
	height: auto;
	/*background: transparent;*/
	/*background: #e9ecef;*/
}

.card {
	box-shadow: 0 0 0px rgba(0,0,0,.125), 0 0px 0px rgba(0,0,0,.2);
	margin-bottom: 0.5rem;
	border: 1px solid #ddd;
}

.info-box {
	box-shadow: 0px 0 0px rgba(0,0,0,.125), 0 0px 0px rgba(0,0,0,.1);
	margin-bottom: 0rem;
	min-height: auto;
	height: 50px;
	padding: 0px;
}

.info-box .info-box-text, .info-box .progress-description {
	overflow: visible;
	font-size: 18px;
}

/**************************************** MEDIA SCREENS ****************************************/

@media screen and (max-width: 400px) {
	.login-box, .register-box {
		width: 100%;
	}
}

@media screen and (min-width: 401px) and (max-width: 720px) {
	.login-box, .register-box {
		width: 100%;
	}
}

@media screen and (min-width: 1281px) and (max-width: 1440px) {
	.login-box, .register-box {
		width: 100%;
	}
}

@media screen and (min-width: 1441px) and (max-width: 1920px) {
	.login-box, .register-box {
		width: 100%;
	}
}

@media screen and (min-width: 1921px) {
	.login-box, .register-box {
		width: 100%;
	}
}

/**************************************** UI ELEMENTS ****************************************/

.badge {
	font-size: 25px;
	line-height: inherit;
}

.nav-tabs .nav-link.active {
	font-weight:bold;
	background-color: transparent;
	border-bottom:3px solid #dc3545;
	border-right: none;
	border-left: none;
	border-top: none;
}

.nav-tabs.flex-column .nav-item.show .nav-link, .nav-tabs.flex-column .nav-link.active {
	border-color: #dc3545 transparent #dc3545 #dc3545;
}

.alert {
	text-align: center;
	padding-top: 6px;
	padding-bottom: 0px;
	padding-left: 50px;
	padding-right: auto;
}

/**************************************** SCRATCH CARD ****************************************/

.scratch-container {
	position: relative;
	width: 300px;
	height: 300px;
	margin: 0 auto;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	-o-user-select: none;
	user-select: none;
	color:#fff;
	cursor: url('<?php echo PATH_ROOT ?>/images/coin.png'), auto;
}

.canvas {
	position: absolute;
	top: 0;
}

.form {
	padding: 20px;
}

/**************************************** VIDEO ****************************************/

.video-container {
	position: relative;
	width: 100%;
	height: 0;
	padding-bottom: 56.25%;
}
.video {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.embedHtml {
	text-align: left;
	width: 100%;
}

.embedHtml img {
	max-width: 100%;
}

/**************************************** RECORD ****************************************/

/* change player background color */
.gif--bgcolor {
	background-color: #4ecdc4;
}

/* change player background color */
.audio--bgcolor {
	background-color: #9FD6BA;
}

/* change player background color */
.video--bgcolor {
	background-color: #9ab87a;
}

/* change player background color */
.image--bgcolor {
	background-color: #efc3e6;
}

.video--dimensions {
	width: 100%;
}

/**************************************** CLIENT FORM ****************************************/


.entry:not(:first-of-type)
{
	margin-top: 10px;
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
<script src="<?php echo PATH_ROOT ?>/plugins/jquery/jquery.min.js"></script>

<!-- Spin Wheel (JS) -->
<!--<script src="--><?php //echo PATH_ROOT ?><!--/mockup/plugins/spin-wheel/js/jquery-2.1.1.js"></script>-->
<script src="<?php echo PATH_ROOT ?>/plugins/spin-wheel/js/jquery.superwheel.min.js"></script> <!-- superWheel -->
<script src="<?php echo PATH_ROOT ?>/plugins/spin-wheel/js/sweetalert2.min.js"></script> <!-- sweetalert2 -->

<!-- Record (Animated Gif / Video / Image) -->
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/video.min.js"></script>
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/RecordRTC.js"></script>
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/gif-recorder.js"></script>
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/adapter.js"></script>
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/videojs.record.js"></script>

<!-- Record (Audio) -->
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/wavesurfer.min.js"></script>
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/wavesurfer.microphone.min.js"></script>
<script src="<?php echo PATH_ROOT;?>/plugins/record/js/videojs.wavesurfer.min.js"></script>

</head>
<body>

<div class="row">

<div class="col-md-6">

<div class="card" style="">
	<div class="card-body">
		<div class="clear">
			<h4 class="">
				Client form
			</h4>
			<hr/>
		</div>
		<div class="clear">
		<!---======================================================== FIX ========================================================-->
			<?php			
			//Set networks
			$networks = [];
			foreach ($allPlugins as $obj)
				array_push($networks, $obj['network']);
			$networks = array_unique($networks);
			?>
			
		<!---======================================================== /FIX ========================================================-->
		
			
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

		<!---======================================================== FIX ========================================================-->

				<div class="card" style="">
					<div class="card-body">
						<div class="clear">
							<h4 class=""><b>Actions</b></h4>
							<hr/>
						</div>
						<div class="clear">

							<div class="form-group">
								<label for="network">Choose Network</label>
								<select class="form-control myselect2" name="network" id="network" required>
										<option value="">----- Please choose -----</option>
										<?php
										foreach ($networks as $network) :
										?>
											<option value="<?= $network ?>"><?= $network ?></option>
										<?php
										endforeach;
										?>
									</select>
							</div>

							<div class="form-group">
								<label for="action">Choose Action</label>
								<select class="form-control" name="action" id="action" required>
									<option value="">----- Please choose -----</option>
									<?php
									if ($allPlugins && count($allPlugins)>0) {
										foreach($allPlugins as $idx => $plugin):
											?>
											<option value="<?php echo $plugin['filename'];?>"><?php echo $plugin['actionName'];?></option>
										<?php
										endforeach;
									}
									?>
								</select>
								<?php
								if ($allPlugins && count($allPlugins)>0) {
									foreach($allPlugins as $idx => $plugin):

										?>
									<input type="hidden" id="plugin-<?php echo $plugin['filename']; ?>" name="plugin-<?php echo $plugin['filename']; ?>" value="<?php echo $plugin['type']; ?>" />
									<?php
									endforeach;
								}
								?>
							</div>

							<div class="d-none" id="gameContainer">
								<?php
								if ($allPlugins && count($allPlugins)>0) {
								foreach($allPlugins as $idx => $plugin):
									if($plugin['type'] == 'play-then-share') {?>
										<div class="choose--game d-none" style="margin-bottom: 10px; margin-top: 10px;" id="choose_game_<?php echo $plugin['filename'];?>">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_<?php echo $plugin['filename'];?>">
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
				
		<!---======================================================== /FIX ========================================================-->			

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

</div><!--/col-md-6-->

<div class="col-md-6">

<div class="login-box">
<?php
/*@$pluginTitle = $info['title'];
@$description = $info['description'];
@$promotioncontent = $info['promotioncontent'];
@$totalpoints = (int)$info['totalpoints'];
@$expiry = $info['expiry'];
@$dayLeft = (int)$info['dayLeft'];
@$offersleft = (int)$info['offersleft'];
@$network = $info['network'];
@$brandMedia = (array)$info['media'];
@$pluginType = $info['type'];
@$maxPoints = $totalpoints;

$now = time(); // or your date as well
$your_date = strtotime($expiry);
$datediff = $your_date - $now;

$currentDay = round($datediff / (60 * 60 * 24));*/

?>
<div id="promotioncontent" style="display: none"><?php echo $promotioncontent?></div>
<div class="card">
<div class="card-body login-card-body">

<div style="margin-top:12px;" class="row">
	<div class="col-4 col-md-4 text-center">
		<input type="text" class="knob" value="<?php echo $currentDay;?>" data-min="1" data-max="<?php echo $dayLeft;?>" data-width="90"
			   data-height="90" data-fgColor="#dc3545">

		<div class="knob-label"><b>Days Left</b></div>
	</div>
	<!-- ./col -->
	<div class="col-4 col-md-4 text-center">
		<input type="text" class="knob" value="<?php echo $offersleft?>" data-min="1" data-max="<?php echo $offersleft;?>" data-width="90"
			   data-height="90" data-fgColor="#dc3545">

		<div class="knob-label"><b>Offers Left</b></div>
	</div>
	<!-- ./col -->
	<div class="col-4 col-md-4 text-center">
		<input type="text" class="knob" id="totalpoint" value="<?php echo $totalpoints?>" data-min="1" data-max="<?php echo $maxPoints;?>" data-width="90"
			   data-height="90" data-fgColor="#dc3545">

		<div class="knob-label"><b>Points Left</b></div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
<?php if($brandMedia['mode'] == 'video') { ?>
	<p><div class="video-container"><iframe src="<?php echo $brandMedia['url']; ?>" frameborder="0" allowfullscreen class="video"></iframe></div></p>
<?php } else if($brandMedia['mode'] == 'slide') {
	$slides = (array)$brandMedia['url'];
	?>
	<p>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php foreach($slides as $key => $slide):?>
				<li data-target="#carouselExampleIndicators"
					data-slide-to="<?php echo $key;?>"
					class="<?php echo $key ? '' : 'active';?>"></li>
			<?php endforeach;?>
		</ol>
		<div class="carousel-inner">
			<?php foreach($slides as $key => $slide): ?>
				<div class="carousel-item <?php echo $key ? '' : 'active';?>">
					<img class="d-block w-100" src="<?php echo $slide?>" alt="<?php echo $key;?> slide">
				</div>
			<?php endforeach;?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	</p>

<?php } else { ?>
	<p><img style="margin-top:12px" width="100%" src="<?php echo $brandMedia['url']?>"/></p>
<?php } ?>

<div class="login-logo"><b><?php echo $pluginTitle?></b></div>
<p class="login-box-msg">Caption here</p>
<!-- /.login-logo -->

<div style="padding-left: 20px;padding-right: 20px;">

	<div class="row">

		<div class="col-6 col-md-6">
			<a href="#info" data-toggle="collapse" class="btn btn-block btn-secondary">
				<i class="fas fa-question-circle"></i> INFO
			</a>
		</div>
		<!-- /.col -->

		<div class="col-6 col-md-6">
			<a href="#login" data-toggle="collapse" class="btn btn-block btn-secondary">
				<i class="fas fa-sign-in-alt"></i> LOGIN
			</a>
		</div>
		<!-- /.col -->

	</div>
	<!-- /.row -->

	<!--<a href="#info" data-toggle="collapse" class="btn btn-default btn-block">MORE INFO <i class="fas fa-question-circle"></i> </a>-->

	<div id="info" class="collapse">
		<br><p class="login-box-msg"><?php echo $description;?></p>
	</div>

	<!--======================================== LOGIN ========================================-->

	<!--<a style="margin-top:10px" href="#login" data-toggle="collapse" class="btn btn-default btn-block">LOGIN NOW <i class="fas fa-sign-in-alt"></i> </a>-->

	<div id="login" class="collapse">

		<br>

		<div class="row">
			<div class="col-5 col-sm-3">
				<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Email</a>
					<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">WhatsApp</a>
					<a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Social</a>
				</div>
			</div>
			<div class="col-7 col-sm-9">
				<div class="tab-content" id="vert-tabs-tabContent">

					<!---------------------------------------- EMAIL LOGIN ---------------------------------------->

					<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">

						<p style="text-align:right" class="mb-1">
							<a href="#"><u>Login here</u></a>
						</p>

						<form action="#" method="post">
							<div class="input-group mb-3">
								<input type="text" class="form-control" title="Full Name">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">
								<input type="email" class="form-control" title="Email">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-envelope"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">
								<input type="password" class="form-control" title="Password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											Profile Pic
										</button>
										<ul class="dropdown-menu">
											<li class="dropdown-item"><a href="#">Facebook</a></li>
											<li class="dropdown-item"><a href="#">Instagram</a></li>
											<li class="dropdown-item"><a href="#">Twitter</a></li>
											<li class="dropdown-item"><a href="#">Youtube</a></li>
											<li class="dropdown-item"><a href="#">Pinterest</a></li>
											<li class="dropdown-item"><a href="#">Flickr</a></li>
										</ul>
									</div>
									<!-- /btn-group -->
									<input type="text" class="form-control" title="Username">
									<span class="input-group-append">
									<button type="button" class="btn btn-default btn-flat"><span class="fas fa-search"></span></button>
								  </span>
								</div>
								<!-- /input-group -->

							</div>

							<div class="row">
								<div class="col-8">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
										<label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
									</div>
								</div>
								<!-- /.col -->
								<div class="col-4">
									<button type="submit" class="btn btn-default btn-block">Register</button>
								</div>
								<!-- /.col -->
							</div>
						</form>

						<p class="mb-1">
							<a href="forgot-password.html">I forgot my password</a>
						</p>

					</div>

					<!---------------------------------------- WHATSAPP LOGIN ---------------------------------------->

					<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">


						<p style="text-align:right" class="mb-1">
							<a href="#"><u>Login here</u></a>
						</p>

						<form action="#" method="post">
							<div class="input-group mb-3">
								<input type="text" class="form-control" title="Full Name">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">
								<input type="tel" class="form-control" title="WhatsApp">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fab fa-whatsapp"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">
								<input type="password" class="form-control" title="Password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											Profile Pic
										</button>
										<ul class="dropdown-menu">
											<li class="dropdown-item"><a href="#">Facebook</a></li>
											<li class="dropdown-item"><a href="#">Instagram</a></li>
											<li class="dropdown-item"><a href="#">Twitter</a></li>
											<li class="dropdown-item"><a href="#">Youtube</a></li>
											<li class="dropdown-item"><a href="#">Pinterest</a></li>
											<li class="dropdown-item"><a href="#">Flickr</a></li>
										</ul>
									</div>
									<!-- /btn-group -->
									<input type="text" class="form-control" title="Username">
									<span class="input-group-append">
<button type="button" class="btn btn-default btn-flat"><span class="fas fa-search"></span></button>
</span>
								</div>
								<!-- /input-group -->

							</div>

							<div class="row">
								<div class="col-8">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck11">
										<label class="custom-control-label" for="exampleCheck11">I agree to the <a href="#">terms of service</a>.</label>
									</div>
								</div>
								<!-- /.col -->
								<div class="col-4">
									<button type="submit" class="btn btn-danger btn-block">Verify</button>
								</div>
								<!-- /.col -->
							</div>
						</form>

						<p class="mb-1">
							<a href="forgot-password.html">I forgot my password</a>
						</p>

					</div>

					<!---------------------------------------- SOCIAL LOGIN ---------------------------------------->

					<div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">

						<div class="social-auth-links text-center mb-3">

							<a href="#" style="color: #fff;" class="btn btn-block btn-social btn-facebook"><i class="fab fa-facebook fa-2x"></i> Facebook </a>
							<a href="#" style="color: #fff;" class="btn btn-block btn-social btn-linkedin"><i class="fab fa-linkedin fa-2x"></i> Linkedin </a>
							<a href="#" style="color: #fff;" class="btn btn-block btn-social btn-google"><i class="fab fa-google fa-2x"></i> Google </a>
							<a href="#" style="color: #fff;" class="btn btn-block btn-social btn-twitter"><i class="fab fa-twitter fa-2x"></i> Twitter </a>

						</div>
						<!-- /.social-auth-links -->

					</div>
				</div>
			</div>
		</div>

	</div>

	<!--======================================== / LOGIN ========================================-->

</div>

</div><!-- /.login-card-body -->

<!--        <div class="pt-3 text-center">-->
<!--            --><?php //echo $description;?>
<!--        </div>-->
<!---------------------------------------- TABS ---------------------------------------->

<div class="card-body">

<nav class="nav-justified ">
	<div class="nav nav-tabs " id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="earn-tab" data-toggle="tab" href="#earn" role="tab" aria-controls="earn" aria-selected="true">Earn Points</a>
		<a class="nav-item nav-link" id="points-tab" data-toggle="tab" href="#points" role="tab" aria-controls="points" aria-selected="false">My Points</a>
		<a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">Leaderboard</a>

	</div>
</nav>
<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="earn" role="tabpanel" aria-labelledby="earn-tab">
		<div class="pt-3"></div>

		<!--================================================== ACCORDIAN ==================================================-->

		<div id="accordion">
			<div class="all-plugins-data">


				<div class="alert alert-danger alert-dismissible">
					<h5>7 Ways to Enter</h5>
				</div>

				<!---------------------------------------------------- ACTION ---------------------------------------------------->
				<?php

				//                        print_r($data);
				//                            print_r($allSocials);die;
				@$allSocials = (array)$data['data'];
				if ($allSocials && count($allSocials) > 0) {
					foreach($allSocials as $socialKey => $clientData):
//                                    print_r($clientData);die;
//                                $socialData = $this->data;

//                                @$pluginData = $clientData['data'];
						@$url = $clientData['url'];
						@$numpoint = $clientData['numpoint'];
						@$content = (array)$clientData['content'];
						@$count = $clientData['count'];
						@$visitAction = $clientData['visitAction'];
						@$shareAction = $clientData['shareAction'];
						@$game = (array)$clientData['game'];
						@$submitDescription = $clientData['description'];
						@$shareType = $clientData['type'];

						@$recordType = $clientData['recordType'];
						@$recordLength = $clientData['recordLength'];

						@$socialData = $clientData['social'];
						// echo '<pre>';
      //                   print_r($socialData);
      //                   echo '</pre>';
      //                   exit;
//                                    $title =  $socialData->getPlaceholder();
						
						/*$network =  $socialData->getNetwork();
						$id =  $socialData->getID();
						$shareLink = $socialData->getShareLink();
						$shareTitle = $socialData->getShareTitle();
						$delayTime = $socialData->getDelayTime();
						$type =  $socialData->getType();
						$actionName =  $socialData->getActionName();
						*/

						$network =  $socialData['network'];
						$id =  $socialData['id'];
						$shareLink = $socialData['shareLink'];
						$shareTitle = $socialData['shareTitle'];
						$delayTime = $socialData['delayTime'];
						$type =  $socialData['type'];
						$actionName =  $socialData['actionName'];

						$visitLink = $url;

						$delayTime = (int)$delayTime;
						if ($delayTime < 1) {
							$delayTime = 1;
						}
						//if($type == 'shareandvisit' && $network =='facebook') {
					if($type == 'submit-then-share' && $network =='facebook') {?>
						<!---------------------------------------------------- ACTION ---------------------------------------------------->
						<div class="card card-default">
							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-<?php echo $id?>"></i></span>
								<div class="info-box-content">
									<span class="info-box-text"><?php echo $visitAction;?></span>
								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->
							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">
									<!-------------------- REVEAL -------------------->
									<div id="action-<?php echo "$socialKey-$network"?>" class="form-group text-center">
										<div class="embedHtml">
											<?php echo $submitDescription;?>
										</div>
<!--                                                    <label>We'd love to know about what type of campaign you'd like to run on Facebook, just let us know & we can see if we can help out.</label>-->
										<textarea class="form-control" rows="3" placeholder="Enter comment"></textarea>
										<a id="action-btn-<?php echo "$socialKey-$network"?>" href="javascript:void(0);" style="color: #fff; -webkit-transition-delay: 3s;transition-delay: 3s;" class="btn btn-block btn-social btn-<?php echo $id?>" data-toggle="collapse" aria-expanded="false" aria-controls="submit-and-share<?php echo $socialKey?>">
											<i class="fab fa-<?php echo $id?> fa-2x"></i> <?php echo $shareAction?>
										</a>
									</div>
									<div id="submit-and-share-<?php echo "$socialKey-$network"?>" style="display:none;-webkit-transition-delay: 2s;transition-delay: 2s;" class="collapse text-center" >
										<p><i class="fas fa-check"></i> Thanks for submitting, share to add points!</p>
										<p id="share-button"><a href="javascript:void(0);"  style="color: #fff;" class="btn btn-block btn-social btn-<?php echo $id?> sharefb<?php echo "$socialKey-$network"?>">
												<i class="fab fa-<?php echo $id?> fa-2x"></i> <?php echo $actionName?>
											</a>
										</p>
									</div>
									<div style="display: none" class="collapse text-center" id="action-content-<?php echo "$socialKey-$network";?>">
										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for submitting and sharing, points have been added!</p>
									</div>
									<!-------------------- / REVEAL -------------------->
								</div>
							</div>
						</div>

						<script type="text/javascript">
							$(document).on('click', '#action-btn-<?php echo "$socialKey-$network";?>', function () {
								popup('<?php echo $visitLink; ?>', '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)
											setTimeout(function() {
												// add point to account here
												$('#action-<?php echo "$socialKey-$network";?>').hide();
												$('#submit-and-share-<?php echo "$socialKey-$network";?>').show();
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							});

							$(document).on('click', '.sharefb<?php echo "$socialKey-$network";?>', function () {
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI(location.href);
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>');

								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)
											setTimeout(function() {
												// add point to account here
												//$('.sharefb<?php //echo "$socialKey-$network";?>//').hide();
												$('#submit-and-share-<?php echo "$socialKey-$network"?>').hide();
												$('#action-content-<?php echo "$socialKey-$network"?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }

							});
						</script>

					<?php } else if($type == 'share-then-submit' && $network =='facebook') {?>

						<!---------------------------------------------------- ACTION ---------------------------------------------------->
						<div class="card card-default">
							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-<?php echo $id?>"></i></span>
								<div class="info-box-content">
									<span class="info-box-text"><?php echo $visitAction;?></span>
								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>"
									  class="badge badge-danger float-right">
									+<?php echo $numpoint?>
								</span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->
							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">
									<!-------------------- REVEAL -------------------->
									<div id="share-and-submit-<?php echo "$socialKey-$network"?>">
										<a id="action5"
										   href="javascript:void(0);"
										   style="color: #fff; -webkit-transition-delay: 3s;transition-delay: 3s;"
										   class="btn btn-block btn-social btn-<?php echo $id?> sharefb<?php echo "$socialKey-$network";?>"
										   data-toggle="collapse" aria-expanded="false" aria-controls="FBLike">
											<i class="fab fa-<?php echo $id?> fa-2x"></i>
											<?php echo $shareAction; ?>
										</a>
									</div>
									<div id="action-submit-<?php echo "$socialKey-$network"?>" class="form-group text-center" style="display: none">
										<label>We'd love to know about what type of campaign you'd like to run on Facebook, just let us know & we can see if we can help out.</label>
										<textarea class="form-control" rows="3" placeholder="Enter comment"></textarea>
										<a id="action-btn-<?php echo "$socialKey-$network"?>" href="javascript:void(0);" style="color: #fff; -webkit-transition-delay: 3s;transition-delay: 3s;" class="btn btn-block btn-social btn-<?php echo $id?>" data-toggle="collapse" aria-expanded="false" aria-controls="submit-and-share<?php echo $socialKey?>">
											<i class="fab fa-<?php echo $id?> fa-2x"></i> <?php echo $actionName?>
										</a>
									</div>
									<div style="display: none" class="collapse text-center" id="action-content-<?php echo "$socialKey-$network";?>">
										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for sharing and submitting, points have been added!</p>
									</div>
									<!-------------------- / REVEAL -------------------->
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(document).on('click', '.sharefb<?php echo "$socialKey-$network";?>', function () {
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI(location.href);
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												$('#share-and-submit-<?php echo "$socialKey-$network"?>').hide();
												$('#action-submit-<?php echo "$socialKey-$network"?>').show();
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }

							});
							$(document).on('click', '#action-btn-<?php echo "$socialKey-$network";?>', function () {
								popup('<?php echo $visitLink; ?>', '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
									var popupCheck = setInterval(function() {
										var timer = 0
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												// add point to account here
												$('#action-submit-<?php echo "$socialKey-$network";?>').hide();
												$('#action-content-<?php echo "$socialKey-$network";?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);

											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							});
						</script>
					<?php } else if($type == 'visit-and-share' && $network =='facebook') {
					?>
						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-<?php echo $id?>"></i></span>

								<div class="info-box-content">
									<!--                                            <span class="info-box-text">Visit then share action</span>-->
									<span class="info-box-text"><?php echo $visitAction;?></span>

								</div>
								<!--                                        <span class="badge badge-default float-right"><i class="fas fa-check"></i></span>-->
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse in">
								<div class="card-body">
									<!-------------------- REVEAL -------------------->

									<a id="action-<?php echo "$socialKey-$network";?>" href="javascript:void(0);"
									   style="color: #fff; -webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;"
									   class="btn btn-block btn-social btn-<?php echo $id?>" data-toggle="collapse" aria-expanded="false" aria-controls="FBLike<?php echo $socialKey?>">
										<i class="fab fa-<?php echo $id?> fa-2x"></i> <?php echo $shareAction?></a>

									<div style="display: none" class="collapse text-center" id="action-content-<?php echo "$socialKey-$network";?>">

										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for visiting, share to add points!</p>

										<p id="share-button"><a href="javascript:void(0);"  style="color: #fff;" class="btn btn-block btn-social btn-<?php echo $id?> sharefb<?php echo "$socialKey-$network"?>">
												<i class="fab fa-<?php echo $id?> fa-2x"></i> <?php echo $actionName?></a></p>

									</div>

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(document).on('click', '#action-<?php echo "$socialKey-$network";?>', function () {
								popup('<?php echo $visitLink; ?>', '<?php echo $socialKey;?>');
								// console.log(getDiffDays(), "==========")
								// if(getDiffDays() > 48) {
								var timer = 0
								var popupCheck = setInterval(function() {
									var fraudCheck = window.localStorage.getItem('fraud')
									console.log(fraudCheck, "======== fraud check, ", timer)
									timer ++
									if(fraudCheck == 'no') {
										clearInterval(popupCheck)

										setTimeout(function() {

											// add point to account here

											$('#action-<?php echo "$socialKey-$network";?>').hide();
											$('#action-content-<?php echo "$socialKey-$network";?>').show();

										}, <?php echo $delayTime?> * 1000);
									}
									if(timer > 6) {
										clearInterval(popupCheck)
									}
								}, 1000)
								// }

							});
							$(document).on('click', '.sharefb<?php echo "$socialKey-$network";?>', function () {
								var openUrl = '<?php echo $shareLink; ?>';

								var currentUrl = encodeURI(location.href);
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));

								var openUrlReplace = openUrl.replace("<URL>", currentUrl);
								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
								var timer = 0
								var popupCheck = setInterval(function() {
									var fraudCheck = window.localStorage.getItem('fraud')
									console.log(fraudCheck, "======== fraud check, ", timer)
									timer ++
									if(fraudCheck == 'no') {
										clearInterval(popupCheck)
										setTimeout(function() {
											// add point to account here
											$('.sharefb<?php echo "$socialKey-$network";?>').hide();
											$('#message-description-<?php echo $socialKey?>').html('<i class="fas fa-check"></i> Thanks for sharing, points have been added!');
											$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
											updateTotalPoint(<?php echo (int)$numpoint?>);

										}, <?php echo $delayTime?> * 1000);
									}
									if(timer > 6) {
										clearInterval(popupCheck)
									}
								}, 1000)
								// }
							});
						</script>

					<?php } ?>

					<?php
					if($type == 'share-and-visit' && $network =='facebook') {
					?>
						<!---------------------------------------------------- ACTION ---------------------------------------------------->

						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<!--                                            <span class="info-box-text">Share then visit action</span>-->
									<span class="info-box-text"><?php echo $visitAction;?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">

									<!-------------------- REVEAL -------------------->

									<a id="action2" href="javascript:void(0);" style="color: #fff; " class="btn btn-block btn-social btn-facebook sharefb<?php echo $socialKey?>">
										<i class="fab fa-facebook fa-2x"></i> <?php echo $shareAction;?></a>

									<div id="FBLike<?php echo $socialKey?>" style="display:none;-webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;" class="collapse text-center" >

										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for sharing, visit our page to add points!</p>

										<p><a href="javascript:void(0);" style="color: #fff;" class="btn btn-block btn-social btn-facebook openFbAddPoint<?php echo $socialKey?>">
												<i class="fab fa-facebook fa-2x"></i> <?php echo $actionName?></a></p>

									</div>

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(document).on('click', '.openFbAddPoint<?php echo $socialKey?>', function () {
								popup('<?php echo $visitLink?>', '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {

												// add point to account here

												$('#message-description-<?php echo $socialKey?>').html('<i class="fas fa-check"></i> Thanks for visiting our facebook page, points have been added!');
												$('.openFbAddPoint<?php echo $socialKey?>').hide();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');

												updateTotalPoint(<?php echo (int)$numpoint?>);
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }

							});
							$(document).on('click', '.sharefb<?php echo $socialKey?>', function () {
								var openUrl = '<?php echo $shareLink; ?>';

								var currentUrl = encodeURI(location.href);
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));

								var openUrlReplace = openUrl.replace("<URL>", currentUrl);
								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												$('.sharefb<?php echo $socialKey?>').hide();
												$('#FBLike<?php echo $socialKey?>').show();
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }

							});
						</script>

					<?php } ?>
					<?php
					if($type == 'select-and-share' && $network == 'facebook') {
					?>
						<!----------------------------------------------------- ACTION select-and-share ----------------------------------->
						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<span class="info-box-text"><?php echo $visitAction?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">
									<p><?php echo $submitDescription;?></p>
									<!-------------------- REVEAL -------------------->
									<div id="selector-action-submit-<?php echo "$socialKey-$network"?>" class="form-group text-center" style="display: none">
<!--                                                        <label>We'd love to know about what type of campaign you'd like to run on Facebook, just let us know & we can see if we can help out.</label>-->
<!--                                                        <textarea class="form-control" rows="3" placeholder="Enter comment"></textarea>-->
										<a id="selector-action-btn-<?php echo "$socialKey-$network"?>" href="javascript:void(0);" style="color: #fff; -webkit-transition-delay: 3s;transition-delay: 3s;" class="btn btn-block btn-social btn-<?php echo $id?>" data-toggle="collapse" aria-expanded="false" aria-controls="submit-and-share<?php echo $socialKey?>">
											<i class="fab fa-<?php echo $id?> fa-2x"></i> <?php echo $shareAction?>
										</a>
									</div>
									<div id="action6" class="row">
										<div class="card-body" id="selector-<?php echo "$socialKey-$network";?>">
										<?php if($shareType == 'checkbox') {
											foreach($content as $idx => $label): ?>
												<div class="form-group clearfix">
													<div class="icheck-danger d-inline">
														<input type="checkbox" class="share--checkbox" id="shareCheck<?php echo $idx;?>">
														<label for="shareCheck<?php echo $idx;?>">
															<?php echo $label;?>
														</label>
													</div>
												</div>
											<?php endforeach;
										} ?>
										</div>
											<?php if($shareType == 'image') {
										for($i = 0 ; $i < count($content); $i += 2) {
											if($i < count($content)) {
												$picture = (array)($content[$i]);
												?>
												<div class="col-6 col-md-6">
													<a
														href="#FBSelectShare<?php echo $socialKey?>"
														id="<?php $picture['name']?>"
														onclick="shareImage('<?php echo $picture['url'];?>', '<?php echo $picture['mode'];?>')"
														style="-webkit-transition-delay: 3s;transition-delay: 3s;"
														data-toggle="collapse"
														aria-expanded="false"
														aria-controls="FBSelectShare<?php echo $socialKey?>"
														class="sharefb<?php echo $socialKey?>"
													>
														<img class="img-fluid mb-3" src="<?php echo $picture['mode'] == 'upload' ? PATH_ROOT.'/'.$picture['url'] : $picture['url'];?>" alt="<?php echo $picture['name'];?>">
													</a>
												</div>
											<?php }?>
											<?php
											if($i + 1 < count($content)) {
												$picture = (array)$content[$i + 1];
												?>
												<div class="col-6 col-md-6">
													<a
														href="#FBSelectShare<?php echo $socialKey?>"
														onclick="shareImage('<?php echo $picture['url'];?>', '<?php echo $picture['mode'];?>')"
														style="-webkit-transition-delay: 3s;transition-delay: 3s;"
														data-toggle="collapse"
														aria-expanded="false"
														aria-controls="FBSelectShare<?php echo $socialKey?>"
														class="sharefb<?php echo $socialKey?>"
													>
														<img class="img-fluid mb-3" src="<?php echo $picture['mode'] == 'upload' ? PATH_ROOT.'/'.$picture['url'] : $picture['url'];?>" alt="<?php echo $picture['name'];?>">
													</a>
												</div>
											<?php } ?>
										<?php } }?>
									</div>
									<!-- /.row -->

									<div id="FBSelectShare<?php echo $socialKey?>" style="-webkit-transition-delay: 3s;transition-delay: 3s;" class="collapse text-center">

										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for sharing, points have been added!</p>

									</div>

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script type="text/javascript">
							function shareImage(imgUrl, mode) {
								var openUrl = '<?php echo $shareLink; ?>';
								var prefix = mode == 'upload' ? '<?php echo PATH_ROOT;?>/' : ''
								var currentUrl = encodeURI(prefix + imgUrl);
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>')
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												$('.sharefb<?php echo $socialKey?>').hide();
												$('#FBSelectShare<?php echo $socialKey?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }

							}

							$(document).on('click', '#selector-action-btn-<?php echo "$socialKey-$network";?>', function () {
								var openUrl = '<?php echo $shareLink; ?>';
								var prefix = '<?php echo PATH_ROOT;?>'
								var currentUrl = encodeURI(prefix);
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>');
								// if(getDiffDays() > 48) {
									var popupCheck = setInterval(function() {
										var timer = 0
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												// add point to account here
												$('#selector-action-submit-<?php echo "$socialKey-$network";?>').hide();
												$('#FBSelectShare<?php echo $socialKey?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);

											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							});

							$('.share--checkbox').change(function() {
								if($(this).prop('checked')) {
									console.log("checked==========")
									$('#selector-action-submit-<?php echo "$socialKey-$network";?>').show();
									$('#selector-<?php echo "$socialKey-$network";?>').hide();
								}
							})
						</script>

					<?php } else if($type == 'share-and-refer' && $network == 'facebook') {
					// $visitors = $plugin->getVisitors($socialKey);
					?>
						<!----------------------------------------------------- ACTION share-and-refer ----------------------------------->
						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="facebook" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<span class="info-box-text"><?php echo $visitAction?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">
									<!--                                                <div class="friends--show">-->
									<!--                                                    <p>Friends: --><?php //echo $count;?><!--</p>-->
									<!--                                                    <p>Visitors: --><?php //echo count($visitors);?><!--</p>-->
									<!--                                                </div>-->
									<!-------------------- REVEAL -------------------->
									<div class="friends--show">
										<label>Share link with (<?php echo $count ;?>) friends to get points (points added only when they login).</label>
										<?php if($referralId != $uniqueId) {?>
										<div class="input-group mb-3">
											<input type="text" value="<?php echo PATH_ROOT.'?id='.$uniqueId; ?>" class="form-control" placeholder="Copy link">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fas fa-copy"></i></span>
											</div>
										</div>
										<?php }?>
									</div>
									<?php if($referralId != $uniqueId) { ?>
									<a id="action7"
									   href="javascript:void(0);"
									   style="color: #fff; "
									   class="btn btn-block btn-social btn-facebook sharefb<?php echo $socialKey?>">
										<i class="fab fa-facebook fa-2x"></i> <?php echo $shareAction?>
									</a>
									<?php } ?>

									<div
										id="FBLike<?php echo $socialKey?>"
										style="display:none;-webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;"
										class="collapse text-center" >
										<p id="message-description-<?php echo $socialKey?>">
											<i class="fas fa-check"></i>
											Thanks for referring! Points have been added!
										</p>
									</div>

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<?php if($referralId == $uniqueId) {?>
						<script type="text/javascript">
							$(document).ready(function() {
								var url = 'client_add_visitor.php';
								var fd = new FormData();
								var postData = {
									referralId: <?php echo $referralId;?>,
									limitCount: <?php echo $count;?>
								}

								$.ajax({
									type: "POST",
									dataType: "json",
									// contentType: false,
									// processData: false,
									url: url,
									data: postData, //fd, // serializes the form's elements.
									// data: form.serialize(), // serializes the form's elements.
									success: function(data)
									{
										var success = data.success;
										if (success) {
												$('.friends--show').hide();
												$('#FBLike<?php echo $socialKey?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);
											//setTimeout(function() {
											//    //$('.sharefb<?php ////echo $socialKey?>////').hide();
											//}, <?php //echo $delayTime?>// * 1000);
										}
									},
									error: function(err) {
										console.log(err, "===== err")
									}
								});
							})
						</script>
						<?php } ?>
						<script type="text/javascript">

							$(document).on('click', '.sharefb<?php echo $socialKey?>', function () {
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI('<?php echo PATH_ROOT.'?id='.$uniqueId ?>');
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>')
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											var url = 'client_add_visitor.php';
											var fd = new FormData();
											var postData = {
												referralId: <?php echo $referralId;?>,
												limitCount: <?php echo $count;?>
											}

											$.ajax({
												type: "POST",
												dataType: "json",
												// contentType: false,
												// processData: false,
												url: url,
												data: postData, //fd, // serializes the form's elements.
												// data: form.serialize(), // serializes the form's elements.
												success: function(data)
												{
													var success = data.success;
													if (success) {
														//setTimeout(function() {
														//    $('.sharefb<?php //echo $socialKey?>//').hide();
														//    $('.friends--show').hide();
														//    $('#FBLike<?php //echo $socialKey?>//').show();
														//    $('#action-point-<?php //echo "$socialKey-$network"?>//').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
														//    updateTotalPoint(<?php //echo (int)$numpoint?>//);
														//}, <?php //echo $delayTime?>// * 1000);
													}
												},
												error: function(err) {
													console.log(err, "===== err")
												}
											});
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							})
						</script>

					<?php } else if($type == 'scratch-and-share' && $network == 'facebook') { ?>
						<!---------------------------------------------------- ACTION scratch-and-share ---------------------------------------------------->

						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey; ?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<span class="info-box-text"><?php echo $visitAction; ?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"; ?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey;?>" class="panel-collapse collapse">
								<div class="card-body">

									<!-------------------- REVEAL -------------------->
									<div id="scratchContainer<?php echo $socialKey; ?>" class="row">
										<div id="<?php echo $id?>"  class="scratch-container ">
											<canvas class="canvas canvas<?php echo $socialKey;?>" id="js-canvas" width="300" height="300"></canvas>
											<div class="form form<?php echo $socialKey;?> text-center" style="visibility: hidden;">
												<h2>YOU WON!</h2>
												<h4>Share to add points!</h4>
												<br>
												<div>
													<a id="action7"
													   href="javascript:void(0);"
													   style="color: #fff; "
													   class="btn btn-block btn-facebook sharefb<?php echo $socialKey?>">
														<?php echo $shareAction;?>
													</a>
												</div>
											</div>
										</div>
									</div>
									<div
										id="FBLike<?php echo $socialKey?>"
										style="display:none;-webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;"
										class="collapse text-center" >
										<p id="message-description-<?php echo $socialKey?>">
											<i class="fas fa-check"></i>
											Thanks for spin! Points have been added!
										</p>
									</div>
									<!-- /.row -->

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script type="text/javascript">
							(function() {

								'use strict';

								var isDrawing, lastPoint;
								var container    = document.getElementById('js-container'),
									canvas      = $('.canvas<?php echo $socialKey;?>')[0];//document.getElementById('js-canvas')
								var canvasWidth  = canvas.width,
									canvasHeight = canvas.height,
									ctx          = canvas.getContext('2d'),
									image        = new Image(),
									brush        = new Image();

								// base64 Workaround because Same-Origin-Policy
								image.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAYAAAB5fY51AAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAEu2SURBVHja7L15mFxHebd9V9U5vc6qZbRbmy3J+4JtQDiAzWLMGhJj42xfPgx2HJJwOQkhAT4IZgkBB7/vS9jBF0kgxo6TNwQHYnAizGLAm7BlY0m2Ze2j0Yyk2Xo9p6q+P05Pz/SsPTPdo5npeq5L9pytu6rOqbuf53eeqhL+e49aRpsYu6vSLIgpjsMk59jJj4177YgyVX2siv0Vx6azf5w2EuOfa8c911bZLrXcZydui0n32cnbREyxPeG+KbbHq9OU51SxPV49ZrBtp2yHadZ3WtvTqfds6jyN+zwH5ZcOVg5WDlYOVgsBVjAaWA5WDlYOVg5W8xRWYEcAy8HKwcrBysFqHsNq2MNysHKwcrBysKoxrJJKkJCypuX3HKwcrBysHKxqAitrSeY9tDLEk4KmmI9A0FXIoalN+aWDlYOVg5WDVS08q0RBIa0gZiSyCNoYwJJQsmbl9xysHKwcrBysahEGBp5BBYJEWiEloA1GGNJSoRBoDAVrCK2dWfkFEwHLwcrBysHKwWp69dW+RUuDH/Mp5jXxpEKHBqkkaSURpb7Smc/PCFaWcYHlYOVgtbhgJQBhQGDKl0hr8W1AXvlYGV1ghIPVbOubV4bewQJxoRjsDxHCkkgptDFIT6CtnTGsxgkJHawcrBYXrJJaoIzAj4ExEAYaoQRaawSCJBCPKXLZAIBCDEIlHKxmkbqQ8zUmbxEWEv5wWxayIVmpQc0MVlR6WA5WDlaLLwwUCJQQ+L6I0g61wmKwWKwApSSxuKSQFUS//dbBqgZ5VsW4QRUNgZbIAPyYoljQeIBOglbTh9UIDcvBysFqMWtWItq2U2hWdsT5DlazKr8VljAhCLFgDYVBXe43M4VVycNysHKwWuSwmup5dJpVXTPYM0JDAlQYgWymsIo0LAcrB6tFCysm8awcrOoBK2Ej7UraaL+WYEtpWNqbHaxGaVgOVg5Wizl1QUx9voPVtMsvBKQKHlKAEpYg0EglMEbjWY31YqAgCDWhEgRxO2NYTZ6H5WDlYLUIYKWFQQlJKQmIyfKsjLJlb8DBqsryW/CsRHkQSwrsQNSAxlpCIUnEFUJYdNEg1OxgNUGmu4OVg9Xi8awKCoqeRocWH4EVI8+0BMBgPiSbACMcrGZefjHz8lcJq3FCQgcrB6vFl8FugayNht+KGHhaYJRByyGAmcryOVjNXfmnAatRwHKwcrBa/MNtDFBUBpe6sPBgNWKKZAcrBys3NtDBan7DqjTjqIOVg5WDlYPVDMpvLdZaijIczq+aoHxGRgOjsWbGsBoOCR2sHKwcrBysplt+IUBYcjFNwYakigorBF4pcDPCkNWWQBnCZOk6IWYMqwhYDlYOVg5WDlazLL8RMIiGuEUaAb7BSECKUf1sNnWxM5kPy8HKwcrBysFqovILjBonUbcGsIJxp0h2sHKwcrBysDr9Avt4ZZMOVg5WDlYOVgsBVqNWfnawcrBysHKwmr+wGrGQqoOVg5WDlYPV/IZVKSR0sHKwcrBysJr/sIqA5WDlYOVg5WC1AGA1eVqDg9WM9n3qxUt48fomtm9uqTjy0PP9/OLAIH/xSM+8gtWVS+K8dGWaTzxzYkaw6r3pMtIxj9/+tye5p3OwJrD60qVn8I4XbSifff+zx3jjjt3TglXf776CdMzjj3+wky8cOjGm7LesW8ZnX31x9PnPH+UNP35q3Pr33fAq0jGP1/z7j9nRn2Hvm17GpvZmfuu/fsY93accrOYQVqWQ0MGqVrB68LozuPWq1WNgBbB9cwu3XrWaB69dP29g9alLOvj+713A+SvSs/CsqvAmpwGrx998QQWsAK4+ayWPv/miaXlWTxw7BcDFy1rGLfsrVi8p/33xyvZx63bLumWkYx7HMzl29GecZ3WaYTUOsBysZrrv/Re0lkF17+M9+J/chf+3w//ufOgYmYJm++ZWvvRrHfMiDFzXGp99GFhDWN2yvp3zV7WRKYb89rd34n/5h3z4h88AcP7KNm45Y0nVYeAvOk8CcOmqJeOW/eXrO8gUQ57sOkVHOskt65aOqevFS6P7+aODXeXrt9z3E7x/+i739PQ6WM0xrEYBy8FqNvu2b2gC4M6Hurjh+51j6n3zj4/zqf85AsArz2ydX5oVtdCsmLVm1R6PFIonOnu5p6sPgE8828W+k1Go2R73qtasvns4CgM3L2keU/Yr25J0pJM8f2qARztPlDyx1jF1vXRlBLEHO3ucZzUPYDVCw3Kwqt2+iSH0iV29fGJX77jtvTUp+euXreCac5aSjkcrTe46Msi9u3r4xNOnyp/V+0cXAvDWu3bzxTduZNOyFJmC5q3feoYdJ/O8/5wlXH1WO9s3tVdqaC+c4nOPdJZ1pt5bXkQ6Fn3PtReu4toLV3Hnw4e5+eeHQcDWpMdfX76Ga7Z1lM/bdbSfe3/VxSd2d49b7y9dvo7rL1hNOhY9Vg/tP8Ff/2w/O3qzVXXU5/rzAFy4qo2tCZ89hYCtCZ8VTQkyxZB/PXyyaoF9R1+W44N5OpoS3LJuGV841FM+fsPGlQA82nmCu17o5B0Xnckrz1gBv3y+4hnZ3N5CphjyhSPd5XLufeMVbGpv4bfuf6isYfVd91rSvs9rvrODPz/vLK7euHa43Y8c48M7f8WOgUEHq1nCCoaW+XKwmvW+h/YPcvW57Vz/omW0JBQ3/KCTat8GXrk0xjfetpmO5ljFN5y/ponz10Se2yeePllxbAhWQ5+142SeL21fxTtevGZcZWn7xnYuXNNC97eeZsep/KT605XtCb7xlrPpaI5Xlmd1C+evbgFh+cTunopjf/nS9Zy/qrXyOzcs5RvL0lz1LzvZUwin7Aj3dPXze88e4+qzVvIfb7yQH+7v5o1bVpGOeXz4wV+xOx9Mq/Pe99wR3nHR5kjHOtQz7DmtijynB472sKM/y/FMjk3tzVzZmoq0KuCWtctJxzyePH6yys4O//66K0j7fmUbrFnJN9taWf0fP3CwmiWshkNCB6tZ7/vErl7ufKiLdFxx7SXLCN53PsH7LuCu16zirlev4rq1qQkB9sU3b6CjOcbxgSIf/q/9+Lfv5LzPPcmuI9Gv8rtftrriu9JxRVPc47e/tRv/jsdo+9xOtiY9rr848hzu+NFB/P/1SPnfh7+/j+MDBdIxxdu3RZpO2xcf5d4nOiPN7YlO/P/zc27+RRSyfvGas+hojnN8oMCHH3gW/+9/xnlfe4RdR6Mw7d2Xrx9zr85f1cqdjx7A/8JP8L/wE+746fMAdDQluHFrR9Ud4Y07drPv5CCbljTxjks2MlgM+fCDv+Ljz3ZNu/Pu7Okf1rEqPKdmjmdy3NMd1WfnsQhKr1+zbFiIL4n1/33gGFOv3Tlsd+7ag/fP38G76zvc8Vj05rEjneTTWzc6WM0SVlGmu4NVzfbd/OPjvPare7j38W6O9xejcOuS5Vx7yXK++Vtn0vue8/jUZcsqrrtyaZxNy5IA3HrfC3ziqSj825PX3PDtfWQKmo7mGLdsbqn43vue7uGezky5HfbkQto+txP/fz3KXzzeVQnTZ3p4ricKy1ri3vhtUvrsK9sTbFoavTW89ft7y57UnlzADd/bQ6YY0tEc55YNbRXluXfXEW5+5FB5+y+ePMr9e6NyrGtOVNURrlvRwuNvvohNS5rKn5MphjOCFcAXDvWQKYZsbm8uH/rA5shjG4IUwH0HjgHw4pJmhbBl/eq7R7urW2gYuHv3Pm7atbd8/nv37uP+F6I2aY3FHKxmCatxlvlysJrtvh0nCuz4QSc8EHkv161N8dZtrWztSHL+2iZuvXINrQnFzT+JOsk1m6LOlClo7jlSqfXsyYW0/f0T49b7l12ZSdvsrleuK+/bujwVhXJM1qaRXbO+tQyK0XlVe/IhbV95eNx2+NHh3jH3fqCKMHBo+/1bVvCRV55Nphhy5+Mv8K3nuvi/v34p569s4z9fsY03PPgMWxI+t128gf5iwE2Pv1BV532i6yTb13Vwy9plfOFwD9tL6QwPdQ7nnX3hcDefLIZcuGLYE9vc1hKlMwxkqu78D3R2j6njQBBEPxQlXc/BauawKmlYDlb1zGC/53CGew5nQMD7z2vjI9es5/pLlvOZx7rZk9e0lgT2roFi9W8DgRP5cEw7XLc6xUev2jCsbc3AWhNeqTyFqrWbyvJMvMLyZB3j3ZduJFMMeeu/P8qOvhwI+Msf/orPvvYCrj5rFd8qRp9/7bnreOhgd9Wd9xedEbAuXtYCR7q5eOWSyGt7vrPi/OdP9XPBiiXcsmZ5FHbHPL6379A03opOVkccrGoAq2ENy8FqVvvef34bwfvO58gt2yYF2Cee6mVfT450XHHh0kjQ7it5ISuaY9NIXRjbNluTii//+lY2LUuxryfLvU8cK/977T8+yUMvnJq6TsKOKE+cqvOqmMaDP872LeuX0NGUoGswX4aVBb5wsIc7fr63DKprz428xr9/Yn/Vnfe7R3rKOtZ1y1tL6Qz9Y87/74PHStpVK69YPTqdwU4Nn6naAAer2cIKMXIRCgerGe/71+f7I62pJcanLls64a/s1qSMwAR05zRgebQzWxbSr1uTGtO2j19/FsGfvoj7rlk/SQqF5cazl5COKR564RRbv/kUN/zwYPnfjt4cZ1Z4XRPnWT3aNVj2MK5b3TTmmsffeh7BH76M+159ZvU5ZFV1DFjRlGBr0q/oHO996jB37txXPuehg91lsbyah35HX/QWcHN7C68uieqPHjsx5vzvHi2BbeVSXr5uJZkgKKUzVDE5gIPVnMBqhIflYDWbMHBPVvO9UtrBrVeu4b43ro3eCo4471OXLuU/3n4m6bhi15FBdpyMUgvuOZJlX08uerv3ho28/9z2ch3vumoN56+JNK5/fLKnqjZb2RLnutXp4e+9pIM9v31+OUWhuZR8CdBfCuNWtwynL9zTOci+E5Fuc8drtvL+bcvKdb7r1zaWUxf+8eljk2hh0wsLv3DwBMcH86RjHv/86vO4sjVZvuTLL9rApauGc8q2n7GcD5y5clqd+UcHj5OOeVx/9oZI33vh2Jjzd/RnOJ7JsTI9nFQ6uUdZZR2nep4drKqG1bCG5WA1a83qhgc6Wd0aY/vmVq4+ZwlXn7OEb45Ton09OW74930V9fmD77zAN649k47mGB953UY+8rqNFdfc+8su7jk6OGnbfO2Zk/z2xSvZtDTFN9927rjfPRpOQ+Hf9g1LCP7opdz5yCFu/sUh/uD+PXzjTefS0RznI6/awkdetaWyPLuOcM+xgZrAamj71h1P8+WrL+SClW384G0vGdtuJwc5Nphj+xnL+cjLz2N9c5Kbfrmvqs784NEerj17feW4wHE6yX3PH+IdF2wphYidU2t3M9KwHKxmCqtppjU4WE0lsL/iX/fz4e8d4P5fnRxTml1HBrnzZ51s/fpu9uR0xbU7Tua56p92c+/O46OuGeCOBw9yw45DU4Yje/IBv/N/94zRqvadyHLvE538yXd2A7Bp2bD39RdPHOOh/cNl3bY8HSWhnspz1T1PcO+TRyvL09nHHT99nht+8kKVIRFVh4V3d/Xz699+lPuf7RwDqjt37mPLv/+clz/wBHf8Yg/HB/OVXtIUneALh6P0BiiNC5ygk+w8MRxqfrezu0pYTacNHKxmAysECP8D++18gVXSA4sgry1uPivcfFYz6ry4+awWKayGQ8LTBStrSIagpSWeEKTjHkIKjg8GaOtg5WDlYOVgNa20hvp6VnEdTSofMwIZgrEm2u8JBysHKwcrB6sxdfJOZxgYCvAsJNIKqQBjsMLQ5IESAgPktSE0DlYOVg5WjQ6rymW+ToNmpZVE++DHJTq0KF9hDUgpaYorWhKSZSnPwcrBysHKwWqEhnUa3wbmBfQOFIlLSaY/RGBJpD3CIEQqMUrLcrBysHKwalRYRcA67akLkBMCExiEMSQSEksUAxayIVlEdKKDlYOVg1VDw2rEQqqnC1bD+4ueIFSWYhASFDVSCYpFjVfQKGscrBysHKwaHFYjppc5/UmhVkDgKQIAaykMBFgDSIOWysHKwcrBqsFhVdKw5l8Ge8YIUAolo0RSBysHKwcrB6tSWsPphZXAgrEooux2LaO/EBYtpIOVg5WDlYNV+fu8uYaVAFIapLBIBUExehtotMbDYJQABWFgCKUgUNLBysHKwcrBqqRhnQbPykOgfImfAKtF+UiIIpGQCEH01tA6z8rBysHKwWq43HI+aFYTdzoHKwcrBysHq+Ft6WDlYOVg5WC1EGBV8rAcrBysHKwcrOY/rCrHEs43WI35PgcrBysHq0aGVWWm+1zAylqsNRQx5dSFiTwrI0ALwFoHKwcrBysHK2BMWkOdPSsRjQvMKUvBBKTyEguo0hcZLNlQEwgIY7L0gQ5WDlYOVg5WjE5rmMswEAySQQMoizQGPDBKjiKHg1WtYSVKu4SNPF5hIzfbtyF55WFFJBQYBysHq3kGq2EP67RqVgIjh7wvJ7DXE1bJUKAs+DGBMYawaBAeaGMQ1pK0EE8pcrkwGs/pgy7P/upg5WB1emE1dsbR0yWwu7eBY8rvCUNCauJS40kdJdNaCK0ksIKCVYRWYqyoOgwUQqAQ+L7AWglGEjlaARaJ8iSxhKKQDSPpcJF6VgLwhCYuDDFl8DBIET2xGkHBSnJGoa3AOljNG1iN8LAcrOYTrJIqpEkFeMIgRpwjBXgiJC4gTUjBKHJaUWQIXNVqVqIhNSspLL6wJGVAXEaQik4bPl9h8IUmKUIGrU/OyOEaOlidVliNmF7GwWq+wCqlQlq8QvT6doJzRKmTJWVAXIUERpLRPgUjsdXCyk7yQ1U+Pnz+QoaVAGLSkFYhMaGRE55vy3960tJCEYlHxnjjeFoOVnMNq2EPy8Fq3nhWzV6xAlYr4xnesuJ5rlp6iPXJfpIypLuY5NlsGz/vW8mPT63haL4JT2gKVpHRPqGVI97MTsezEuPe64UKK4FFCUtahSSkRmGIC83KWJ7tTT28rOk4WxIDdHh5ilZyqJjiR4Md/GvfWo4Uk0igSYUYIcga6WB1mmEFFuF/+DnrYHX6YRWXmlavgCds+Zw3dLzAX2x6hA3JfiayQe1zf896/qN7E4/1L+dkkCCrFTnjYagUzFNa4ltBPCWwFoo5i8WidQCAiknSzT4DpwpYC/m4JVRiQcJKEmmAKaXxhaFJBlyQ6uXNbYd5fdtR2lVxwjbtDBJ85vhW7u1dhyZaV6DP+OSNcrA6jbAChoDlYHW6BfZWr0hc6vI5b1u5l09s/SkxqanWvtO9kW8dO4ufnlpNxnglb6uk0AiIa0HMCJKpSJcpZi0Wg9ZhpN/4knSzx8CpIlpa8jGBEQsPVr7QpKQmqaLw7/J0D9cvOcBvLjmEHO9ZncBuO3YuXz2xEYDASvqMR9FKB6vTBCsEKPXKP/5rB6vTByspLE0qIKmGYXX18v387bYfk1DVwwpga7qXNy7fT5tfpDtIMag9jBXo0oAGLS2BsmV5ypqhLhBlXRllCbFklKXoCewCg5UAEjKkRYUklWZdLMtNy5/lQ2t2cUn61HgB76R2RbqHziDJ0/lWlIz81QAZqWIOVnMOK7Ao9co/+WsHK05bnlVKhaS9oPw28OKW49xxzoO0+QVmYp6wXNLSzeWtXeSMx758K4Lodb0t9eoASwFDUVmsIFr8w4dAQRFb41f5cwMriSUtQ5pViC8t17Qe5f9bvYu3th8mIc2M2lIKeEn6JLvyrRwMUngCjBUEox9IB6s5gRUwAlgOVnMOq5jUNHsBXqlDrYhnuf3sH3FmqpfZ2vJYnle0H2VVPMveXBs5rQiRJV1ruC10lI419OpxQQrsSliaVUCTCmnzAm5duZs/X/kMG+OZWbdjXBouTPbxk8xyTmkfJS2hleiysu9gNVewGgaWg9Wcw0oKS1pFaQlDRfjQWT/nNcsOUivzpeHC5h4uaznOvnwL3UGqJCKLRZNn5QtDswpISc22ZD+fOeNxfqP9EPEZelXj2RKvSIeX54HBFRgEAhuFhtMdw+lgNStYRRrWlX/y1w5Wcz/cJqE0aS9AlvZdu/JZ3rNhZzmZsZa2Kp7lFe1HyWqPPdk2jBBoKxc0rISAuDA0qyIJYbim7SifWvc459fAOx3PNsUz9OkYj+faUViMiIR4B6u5g1VpehkHq7mGlRKWpApQpfPOSvdy47qn8IShXrYqluWjm3/BezfsZHksR1KVlJgFCquE1LSoIimpubHjOW5f9zgbahACTmQKy+8v2c9FyV6ktCSliVJQHKzmDFYwegI/B6u6wyryrgJipZBFCcvvrv4V5zSdoN6WkJo/XfcEn9z8MzYlBkh5YRXtMP9glZQhzarIUq/AB1c/xYdX76JZBXVvvzP8LO9Y8gIJofExJEXoYDWHsBoLLAerusPKk5qE1OV8oJe2HeXaVc8yl3Zdx/N8buuPuLipm7QqDhdxwcAqYGMsw+1nPM6Ny5+b07Z7c0snVzZ1I4QlLg1+2St2sKo3rBBjZhx1sKr3FDFxqfFL3lVaFXnHuqdJz4F3MNq2tx7j77f8hO2tx0iroKSdzW9YpUqwOjvRxx3rH+V1rUfnvN0klpuX7GOpKuILQ0KYOYFVUkoSUjU0rIY9LAerOYGVKgFLlla53r6kk1ctPcjpsnPTJ/nClp9w9dLDEbTK7Tf/YJUuweri1En+9/pHuTx94rS12yXJ3sjLAmJC40lbe1hZQyrrEQsEzVLS5sdY4sdRUjQsrCJgOVjNCawgGi8YaVeWZr/Iu9bu4nTb+sQAd5z5U3592X7SKqyYzmY+wapJBby0qZv/vf5Rzk32nfZ2+4Ml+1iqCsSkIT5uWDg7zypRUAgEsVChCgJtDAhISNmwsCp5WA5WcwGroV9jKQxIuLztGC9uO8Z8sNWxLLdv/jlvX/EcaTUij3uehIFNKuBVLce444zH2BwfnBdttiU+yCubuxECYsIgMTUNAwM/+mFLpBWxRDTPprGatFC0KI+0UvhCNBSsKjUsB6u6wQqirPaY0uVhJL+3+hnmky318/ztxof5/ZV7I2jNg6TQIVi9vvUIt5/xOGtj2XnVZu9oO0BSaGJCE5O2ppqV9iw6ofFjEq3B8yTWgJSCtO/T6sdYFks0FKyGNSwHq7rCCsCXGiUMVhsuTh/jivYjo84Xw/9Ok7V4RW5b/xi/u/LZGnpaM+sIQ5rVa1o6+ejaJ1ju5U8fmSa4N+cn+nlZshslLDFpKmYunQ2shv7OK0NvpoAODYP9IfmsxloIixptDIE1DQWrCtHdwap+sFLCRNPEaI0NNG/peB5PAkqCFFhtMIUAUwiwxRBrLUgJSkX/FwLE3EHrbzY8wu90PFcDT2vmnlVzKQz81LqdrPDnCFaiBCcpwYva3lqLLYbD9yfU0TledF/e2nwUG2pi6NJcZrWB1dB2zg/J65Ci1ggVrXSEgEIupD9faChYQWmZLwer+sEKLL7U+CbAakO7l+O1q45gtSY81k+x8xS6LwvalH9CRMzDa04hW9N4S9LIVALhSVAiWn/LmLr22yYV8LcbHwYB/3T8TLLaG3/h2zrC6tUtndx+xuMs8wr1B5UU0T8LNtSYXBF9chDdlyXsy2CDAHT51wfVnMJf2Ybf0cbLW3tZf2yQ/TqNrxSBUdQ6z6oQ13iBJQgkUoIfVxQLIZ4V6JRFe40BK4TFc7CqL6yiifM1QmuwhteuOsKSXA+ZZw5S7O5DGAueGjE3qIVMgfDEQDTHU8zHa07hr2jFX9GGaEoifBUtoaPrB660CvnkhocpGMnd3ZvIWVXZQnWAVVJqmlXAK5q75gZWSkYg0RbTnyc83kvQ1UvYl8UWSjOSSlmaa0uUS6v7shQP9+AtbSZ+zhm8ub2b/3M8iRIaMZQcUsOkUCstQRwCDCAoZkqrGtFYsIo8LAerusJKYfCMjlx5KXhdei/5R5/FDGaRvgeeGFUcMdyZALQh6OmjeLwX9fwx1PIW4muW4i1tQcT9Erh0Xfpzkwr5zKZfoBH8S8/GaIrgOsEqLjXNqsgVTd3cccZj9YWVirxVWwjRJwYpHj1BsbsPkylEs4YphfC9CaNGYh5gCU8MoB99lqvOb+XzrMM3IUoqQiFrBqvRqQsZQohHaoGVjQWrscBysKr5IqcKgyIECSv8DBsPPoHJ5CLYVDMxgxAIP1qg2xRD9P7jhJ0n8Za1EluzFH9VOyIRg1DXxeNqVgGf3vgwRSv5zxNrsdhhcXnaHWHsvbLlmUI1L246wd+d8Vh9NCtbApWvsIWA4MgpikdOEnb3YfIBwlPImDd2RaFJBC8R97D5gOV7d7Ox40J2h60oYQlrBCuBRWiQFpAWLSlPaaP9xoNVaSFVB6t6wSqSpAyqlFh4IfuJ9/dGv94zmEVGKIlQMawxFDtPEnT34x85QWztMmKrl0Dch2K0anMtbalX4G83PEohhJ/1L69BRxh7Dy5M9vLpdTvrlLogIOGB1gQHeygc6ibo7scGIcKTyIQ/5lGrFoLCVyQzg1yePcDe+Pkoa0DIGcFKYEnlPaQQKGkJihrpCYwJ8azBqhgoCLQm9CCI2YaC1fC6hA5WdVs+XonhtWtexAuk5OxDHSElIiaxxhAc6yXs7ic4fILYphX4K9sjYIW1DRPXxLN8esMj/N+DS1BhWFopWUzcy8e7h6OOCyzGCopW8YbVvZyZzEOtnURPgRSEx3sp7OsiON6LLYTgycijqoHF0FxY7OSb8fOiOV3FUDWm2ZEteFahfIglBVZHoaWxlhBFIi4REnTGIGzjwSoKCR2s6gYrIWxpyYJo7OBGe2yc+XxmBy4kWG0oHjtFcKKf2NplJLasRjYlINA187assazqP8TN/l6Iy5oyxRqLGoxj0kuQnpyR9zkuMD0PkytQeK6T4sFuTCEEKRA1AtVI2xCcIEWRHN7kz2lVHVlMcm7jhYEjy+o5WNUHVkOruEii5L4Vsp8V5mRdNGShJCjAGAr7Iy8iuWU1sTOWRzlDZpYEEAJTKKCz+eitWa3LLwUml8cWi+AlmTWxZJTkGRzqIbf7MDqTQwiB8FTd8tlagyxrzAAnZKr0AyVm35EbLCm0mrJ7Dlb1gVVZNC1td4h+UrrAhCss18JkFDKYfJHsk/sJjveR2LYW1ZKKBPnZeFvGUnebbTgoBCiJyeTJ7z5C8ciJKM9Sqjon3goSJmCZySAoZbwLMf2ObGfSyRsHVsMaloNVzWFVBlbpmhabJWYD5iJlXZS8oOLRk4R9WZJb1xBbuyzyPLRhUZqKlv4Jjpwkt/sQuj+H8BRCzs3Xx62mTefL007PuCOXj4nJn1PbeLAaERI6WNUaVqO3m2QB3+j6eliji+wpTLZA5vF96N4sia2rEclYTbWteWG+hy2GFJ47Sv7Zo1hjo+TauTIBymgSpjjzjmyjFO6iDEjglULK8Z9TIyxamUnAtjhhVQKWg1W9YBVJ7VFij29DpDVzBqsKfctY8s8eQfcPkjxvA2ppMwTh3IR5da2cgJiP6cuQ23WAwtETSE9FWtVcmrVICTE1MpVBTK8jlybmy8U0BRuSCjysEHillXmMNOSMoSgNYcqWRgE3FqwiDcvBqm6eVaRglX4VGRrEbOccWtGbMZ+gqw+T3Uvy/PX4a5ZCaOo+LrGedcL3CLtOkXvyBYKTGUTcOz2zXZSeNW1G/EjNdA52ES1sO0gIcYs0AoQpLXYrGjIMnEDDcrCqdRhosRGogCwxilaRtmLOeTXUJiLuozN5Mo89TzJXJL5pZZQ6vdDCQyHAUxT3d5HbdRCTLyLj/ulpVwArCFHkUJHkXqsFI4TAeCN/4BobViM0LAerWsOK0iCWUESZWL0kKQpvTjWscfu672FDTW7XAUxRk9y2JvKyFkp4WJrapfBsJ7lfHcRqU5e8qulaQSj6vCShlJUvOxt4wYhaw2oEsGYGpqQnsNaSNw5WE9VNC4W2giO2naxInFZYlavnKaw25PceRhhLYtua0hg6O/9hJYdgdTgS1+darxrfxSKr4hzxWtBCNByshLUII0rFiv6WFnwbko8pbGk+NyNsaWDkzPvV9ER3LMkiaGmJJyTphEQKQVcmQFsHq/HqFlhBQfj00MzzcjUbw875AS0lwVpyzx4BLIlta8sC8ryFlZIUnjtK9pnD0Vx7npwvheNoop3d/lKCobEMDQKrVMFDaoEfE9FQsaJGSkFoNBJJ0ijiSY9cNgQshWSI9mYYsYjyqjnVeVbxMLogZiUyNJiSYBv3pIPVBHWzCArWpygUD8bOoSjjtRl6UiMICCnJPxulA0TzQ4n5CStPUdjXRe6ZwwhbmnBvnpiWkh81rydjfcy4gvviDQOFFSgUvi/xYx6eiiGFhxQKI3yUksQSKhp8YAXl6TBmAKtRGtbUYWAoLZ4WJNISKaPX5UYYmjyDJwQaKGhLaBYfrJQ10dRsdtRxO07dRnmbFkFoFD/In8PvxFewtXhwngEBcs8dRsQl8c2roThBnlY9va+JPlsIiEuKB7vJ7jkYJeKq+dV8h5JL+Dd1DhaBZy3CmsrnamQGux0/u90IgZYsYM1KjO3nNdCsRsJq1NCcqUNDrSRaWvy4oJi3xBMKHWqkkqQ9gUBgrOVYJlhUsIqZkKQJ8OzwyijeyIdyihtvBQhryIkE/1C4mg8m/rE0TGeemBQQGnLPHEYm4virlkSzPdjR90/UMZydYCIqJQm7+sg+dSDKHfPmF60CqbjHXMrJIElbEJQHuo95/ifwrMKSp6gl5HxFQcmFByvL5Ns1gtWMRPe8hN7+kLiUDPYHCGFIpD10ae4ebVl0YWCTLhI30XQtzWGBNx/dy+bBkxMKsOPvFlgLNmkRei1+mJlfboIFm9PonhD/BgO+gGDEaiUxn9jytvqFjNYiY7FRsBJgDeEDRbwnliCSaj7IfxUWyhhbWjQfCZ6KPHA5ysOGCfTgyA63pPj21lX0pGIoaykk/cXzNpBJUjJmAKtSHtb03xDmJJggRFhLIj40U5mgkAnJDv1iLyLNKmZ0efuPnnuE/3ffL2fxkywQOgkk559WlLGIpijUL3e8UhgjPA+vvaW+329GDdCWFjTIQ034z6QgPf/0tWbg7eoQ+DMPl886OcBfvuo8PGMWNqzsRD/c09eG7QTl82aaZ1X0BSo0BIFFqmjBx2JR4wE6ptBSLBqB3UbBLgh46+Hds3vCfYv1Q+alaVvKFh/vGavf3PFTWtxgkyEkBIvRrtrfXeqkYsHBKlQGZaOJlMb3KIfLZpTBSjNjWM1wepnhubhDX0XzV1tLYTAoV2kxwWridnHmrFZhpViwnlUhFlCMBYTWJ2YUVtjS28DoukBaBgtFsk0hRswOViM0rOnBavS+jAE8GUkOYnHDSjtyOat1JLwAPauR2xbIioCsV0R44AcKg0b7owA0S1iNGEtYPawEFmEorb5m0UJih1akUpKGyLNy5qwetgiG21ig6Ic1EdjH17CmgJUAUmE0fYaSEBQNUgmMDvEwGC8GAsLAEEpB4AkHK2fOZgQrsaBhNdN+VS2sqpxexuIhUR7EEhKrZWnKFEsoSit5CIEpTjA1rIOVM2fTMAerybblTDSrqfc5WDlz5mBVW1ghKoDlYFXN2EBnzhysTg+sRnhY1cAKB6uJ2sSZs9nCCgerarZlTT0r62DlzFn9PK3GhlXkYU3WUa3FWk1RGKywk3ZoI2xptLl1sHLmzMGq5rAauy7h6I4pIqblPEvBhKTy0RtChSzPIJgNNYGAMCYneUO4CGBlnYblrN6wEg5WU+dhVRPyCYwQDFoLnkVaDQqMHDHdyKIPAx2snNXRnGdFdXlY09asBEZM1NiLHFYuLHQ2p2Ghg9X4eVgudcHBypmD1TyHFWIq0d3ByoWFzhys5gmsxk6RvIBhJayNFlY2UXqFsNESpr4NySufoSl7jIOVs3mtYTlYTVYfbzHAKhmCIlpqyGhLGIQIBdoYhIWkNcRTHrlcNE95wbdoJWbRkM6c1cnLcrCatD7eYggDhZAoK/A9gVUWjD80PBsrJMqLlhoq5HRp4DYOVs4WkKflYDWsYS0qzYrqZgqdbUM6c+ZgNeewiobmOIHdwcqZg9UCgBWMnq3BwWrcbTuu9+bMWT3h5WA13rZcfLCi5p6VKH2H87Gc1c+cZzV1fSjN1rDAYaWlLaUrTO1ZGQFWiWk15PCyGjZaO86ZsxqatMPrJThYTc4ZbzF4VgVpKcoQrSV+6baPbIgQy2A+JBMDK8W0GzKQEt9EawkWlIKgAUKSkf/safj+keVokDDQCBysptj2FotmZQVkbeT9CN/iG4FR0RqJVtjh1Yyn2ZAWyHoe6cAgsdx55vn85VO/mPpXU8oF2Gks0pfQoiABFICijf4/lxYD4gJ8opWfYxKEHLWi+AIJ9IyZkvf/du4qtIRsTDlYTbHtLQZYjWlUoKhspXsgZgYrsOSUhxYCzxr+fuvF7E+3ck5fz4ibF5myBmUtnta8fP9eVvf3LqzeVQSxT6L+IRdl6OUgcZYktllg52LRZwvCg+J+S363QcSjfXpviC2aBSUiWuBUU4IHLj6DbNyPJAsxNhR8dlma72zroC/hUVTSwWoKznjubeDksBr6b0EpikjA45ubzhm3fskgIF3MkwoD2o4cJDU4uPC8rOeB3aUQZRBa36ZoWVYKg+sNDAHCh8GHDae+GSKbSt/pl+5RYWEBa++SBP/78g0ca02SjXuTdljrPKsqODNyLKGD1biwGllHO0n9KgRTbGkasYUowNjhaR0VUJqX0cq5ARYChCp9t1f6TrEw21JZsBiEHf3zh3sbOANYDYeEDlZTwmo6D4e0FjUErQWnY4kIFiIKz4Q8Dcq3FAhPROBawLkkAos01iWF1ghWUDG9jINVLWDlzNnYfuJgVQtYRcBysHKwcjYHipaD1WxhVdKwHKxqDyuLwWLswoaYsWCNBWOiicTmQsMy0XcaW1o2zi5cRFnrYFVLWA1rWA5WNXg4RKQNy0j3ScQTtKRSCzqUsQaSTT7eEg/COQKWB8lmTWuqiEgtbA0rkUwghSy9L3Cwmi2shoHlYFUbz0qCFAIpJalUivbm5gUNLIFFtcZQyxIQ2LkBli+QrQXiTQVs88IewJlsSiOVGoaAg9WsYBUBy8GqNrASQ28FRenzLXaBh4TWlt5yGVOKD+ciJBSLIiQcar9ogkmqHGXhYDXVtnSwqg2shj+h1MucBu9s5JNnHaxmCytGct/Banawqvw8Z85cGFhrWA0Dy8GqRrBybpWzCX0sB6tZwioCloNVfWDlPC1nDlY1hVU0p7uDVR1g5TwtZw5WtYbV8Ko5DlYOVs7mUMNysJopY6SDVb1g5cDlzMGqlrAaBpaDlYOVMwereQ6rEesSOljVFFZOcHc2mdTiYDUjWFWumuNg5WDlrI4aloPVbGFVqWE5WLkw0JnzrOYxrCqB5WBVQ8/KwcuZ86xqDatSHpaDVc1h5cJCZw5WNYdVpGE5WDnPypmD1QKA1dQaloOV86yczdIcrGrJD+lgNRcPkzPnaTlYzZ4fTKBhOVg5WDlzsJpnsAKL52DlYOVsfsBKWIuwItplQZgos9u3mryvsMKCFJjyc9ZYsEKMXITCwcrByln99Kspnq9U3kNage9LrLYExRDpQWg00kiSWhJPeeSyIVgoJELCWGPBCiqA5WBVG1i5N4XOputpWYQQKKPwfYH1LNb4kWZjBUZYPE8SiysKWY21jedZVWpYDlYOVs5OG6zGH74z8fFGhdXwBH4OVrWDlYOXs6rDQiewTwdWkYflYOVg5ew0eFoOVtOF1TgzjjpYOVg5O/2wwsFqAqZIB6s6wMq9LXQ2zecrVCZKW6jCszLKYlXjwSrKw3KwcrBydto9q4IfUvQDQusTsworBGLE28BAhAwWDdnmACNsQ8IKqCZx1MFq+rByYaEzpt2vrICsCMgSIFIWL1QYLNrTEbgaNAwcue05WDlYOTv9sBq9bQQUfd3wmtXEGpaDVe1g5cJCZxXP2/Q9rVr3scUAq+EJ/BysHKycOVjNc1iVPCwHq9rDyoWFzhysag2rCFgOVvWBlfO0nDlY1RRWoxJHHawcrJw5WM1fWJVCQgcrBytnpyssdLCqHlYTDH52sKrZw+LMmYNVzWBVnYblYOVg5czBah7AamoNy8FqFrBy8HLmYFVLWE2uYTlY1eZhceY0LAermsBqYg3LwcrBylnNPS0Hq9nBanwNy8HKwcqZg9U8hNWIkNDBqvYPizNntXzeHKxGiO4OVnV9WJw5z8rBatawKnlYDlbOs3JWdy/LwWrWsBqercHBynlWzhys5jmsIg/Lwar2D4tw4HJG9R3Twaq6c6iBhuVg5WDlzMFqLmBVEt0drGoHK9c/ndU6LHSwGllX6WBVJ8/KeVrOZu1pOViNrqt0sHKwcuZgtRBgNSMNy8HKwcqZg9XpgFUJWA5WDlbOHKzmP6yGM90drBysnNXJHKxqBatIdHewqj2s3NtCZ9P2tByspoJVVRqWg9Us6+vMwcrBqiawmlLDagRYJaUgIaWDlbPTFBY2BqySKBLCmxWsALyGg5U1JPMK7RniCUFTLIYQ0FUooK2pUX0duJw1OKwspAYThH4Y9TMvjkDQZQbRmBnBKhLdG8yzShQlEklMK2Qg0MaAgIQUtYOV07CcNbhnlcjFEFYSCzxUXmGG+pnwZgwrsCUPq4HCwMAzqKIkkVZICViLMYa0lCgh0FgKRhNa51k5qxe8Fn8YGPgBKlQk0x5CgjUWIyxN1kMJ0FiKhAToqmFVCgkbS7PSHmip8WMexYIhnhTo0CKlJC0FQlis9ejM551n5czBaoaalY4ZtAjwhvpZQqJDg1CSJhEv8cbSqfun5W15jQSrob/z0tKbKRIXisE+gxCGRNpDByFSiYj5NS2/MwerxoFVuZ95Ab05Qdz4DPaHUT9LeQRGozwIZyS6N2jqQs7TmIJFGEsiLkvHBYWsJqt0xWz3DlbOZmKiWjgt1tQFCblYEZu1CA1xX5UP5bOarF+MXKbpiO6NnGdVjBlCZQgCTVDUSCkoFkO8rEXpmZdfYFHGLA7nQDK3ABaAWiTAshN19AbKsxKWQqpI6IUEWhOUophiQeMNKJQWTEd0l42cFGolhHHIJCwFYRjMFrA2WjhAq5mXvygV+1qbF36PUwJzwIC1Q+JBVMd6/GMYjubI4vBSX1gap+jRuLAait0EBGlDpqlAQYZkMkP9zKKVqRpWwxpWA8Jq9HZGaIiBkiJa6WQW5S8qwT+ct5k1mSwXHz+JBYyopgfO8C1jXTq3hZSAA+B9T+K9VOHFInbVy7HSRUvwI0P4KwkdicqwvNZvYEUN22nUx0oDu1ck+OIVHeQ9GT06LoMdBGS8KAxUcYEVo8pSRWgo1Ff+2zYarAQgjEWW9mnFiOWYZhoGQioIaS4WEdMsr512XSYo27Tu4+iHZcSxISolBSIxwYM/3XtQzbml/bYA5ExFWDEp2Ccdyzn181bzpbhG/T2YVAzG5PD3NAKsbFRkYQXSRhvlfjbN3KuR5jUCrASWVCHKu1ISgoJGehKjQzwM1vNBCoLQEPqGwJ9++SMvCrQSeMYuXFiNPKZL8JKzgJWYyEOaBGzaTt5RFxCstBLoKb2IxQErYSGVjSOFQAFBYJDKYkyIZ8EqHzxBEIaEMU2Q0NOCVSlxtAE8KwseCqUglgSrZZQwiiVEkYgrhAAdmMoiT7P8BU8i8UgHAQIxqjOIyvIKMQJWo46Vt+1wJcd7ACuOjdy2lRdUbEffXdUxbSEQCL+kL9lSne2oNh93W4w6VkUdLRAYbAhIMUU9xiv79DqxFWJsW055T6qrz9ChvC/I+3ISz2IxeVbgGYXyBbGkwA5EQ3CMhRBIJBRCWHRRIKyYNqwQFRpWo2hWoopf5pmV3yDI+IqMryYvr5iJZ2XnzrMavW1L8KoKVlOBbJxzR9bDA5rq+XzVybNysy6M8wM6/ZBvMlgNvZdxU8TMZfkXGqymVcda3S8Hq8U8RczE4f3ksIqA1ehLcTlYOVg5WNUQVtTFsxoGlvOsKretg5WDlYPVzGBVbU7VqOJVCavhdQkXM6ysxVpLUQaVTTKOp2WkRUsL1jhYOVg5WE0HVkP9TBXL71wm8qKMNIRKj5C9qoOVLYvui9mzEtEApJzUFKwmVfCiituI1UZasjogsJYwUSqbEA5WDlYOVtPRrEr9JpcsUrBFUoGPlRLPROOsjLLkbIGi0oTNZsQIh+phBeA1TBgoBEbAoAghZpEG8KOGrHzN7zwrBysHqxkL7BIMlkEVZbRLHaWnRP1sZmHgyKRuryE1KyEw5bGCoj7ld7BysGo0WI3THsa3MxbYR8OqUnR3qQsOVg5WDla1gtV09lUJq2HR3cHKwcrBysFqnsOqtAiFg5WDlYOVg9X8h9UsNayFDytPwCpjabOgbBXlH22imrpSqZNNOP5v9EXVjg1kGveI8R/yCcvNDGZdYPxzx70fU5SdKco+GlZV1aWa+kwDTpO2P1MP3q6iXkMWSkufrzmazBPKxoPVLDSshQ8rJeAsbVlqbJ1hVcXNF9Pp5LbKzuJgtZhgBeAZwdKCx5bBFMqKhoPVsIfVgGHgCmOJlwbfLlWK18VTnKl84qJ+U10mEgmWLFlSs887fvw4YRhO+dkDAwMMDAzUtjJV9MVGsebmZpqbpz/DbD6f5+TJk1OeVxCa57wB/it5mB5VIK4lK/IxjibzDQWryMNqUM2qrbR7mVK8O9XKuV6srrACaGpqqtln5fP5MqwA0un0+Fyxlmw2i7P6mBBiwrafyjKZTFXnxa3i3KCNdw+czXKdAKC9qBoOVpVDcxoIVgCxUhh4dTxFQtR/AvFYLEYsFqvZ5w0ODpb/9n2feDw+7nm5XA6ttSNLnSyZTCKlnPZ1YRhSKBSm56FbxdW5NYDFN7LhYBW9JWxAWI3cPlP5c/Jg19K7KhaLFIvFqj57JNiczZ/7OtP7clbYUvLsGg9WUUjYwLAC6h4GAnieRyKRqIt3pZQimUyOr30UChVho7PaWjwex/O8aV9njCGXy83MU7eN6VlVqWE1QJ7VAvOuwjAkn88772oe2Gy0Kzvr5YcaD1bDHlajwmoO1r6bzAOarXclpSSVSo17XhAE09ZInM2N1zz7lyCNCatJ5sOKTk4qSUJJB6tZ/gqLGoWdWuuKUCKVSk342c67mp/eVe1fgjQOrGB0Hpa1JAsS7VniCUlTzEcAXQWDLruwi3C4TZ1MCDGhBzTTX+ahUGKy1+mjweZs/tzXalMZHKzG9ygrNKxEUSARxLRCFkEbDYKSl+VgNZNf4Zm88h73Nlpb8bAnk0mUUnPQKZyNtsk828ls9Nvd2hG0MWA17GGVDgSeRQWSRFohpQVjMcKQlgLlSTRQMIbQGgerOoYNE3lXxpgpP9sY4xJF5+l9rcsPSQPBCsqie3Sy9gQ6bvBjAq3B81W08K8UpGM+rTGf5QnfwaoKm8wDmomN1KTi8Ti+71cFNme1tUQiMaNUBq11xdtdB6vpw6rkYVWenJeG3kyROIrB/hAhDIm0QhdDpCciLWvRTBFTP6tlKsNooXayz3bh4Pz0rkbqjw5WM4NVtFT9OJ07pwymYBHGkojL8vWFbEhWmpJf5mA1kU3mAc3Wu3LDcE6feZ43YdtPZqP1RwermcFqjIY18qRizKBCQxBaZGDxY4piUeNZ0AnQikU0+d789a4KhQJBEFT1C+9SGean15zL5eoQpjcerCgv8zXe/EISwpgkJJpEvpAJiDxai1bCwWoCm8wDmq13NdUwnJFgc1Zbk1LOOAG49mF6Y8JqXA1rvM6eEQZioJTFCrG4pjWex97V6Gz1yZJQnXdVX5tpKkPdfkgaEFYRsEZ1dgEIbZElz0orWZ6nfHF5VrXPdq/1MJyRv8yTJSvOZKoSZ9OzeZ3K0CCwGprWnFRRIYVFSQiKGqkExhg8DFZ5oCxBaAk9CHwHq7nwrrTWFflUqVRqwiRU513V12aaolKXVAYaF1aRh2XBswLlS2JJgdXRWQYIUSTiAiEkOrAIaxcZrGoXEk42ELkWv8wTwdANw2kw76qBYQUgG34prho+1LUa5GyMqXoYTs3ze5xV2Exnip2TqakbDFalsYQNDKsahYX1HOQ8mXdV8/weZ2Nspve17iMOGhBWJQ9rgoI6WNVd46gGQm4Yzumz2bxEqesPSYPCajgkrBZO1sFqPKvnMJzJ9BPnXdXfu5ppKkP9p6ZuPFiBRVprKUpdWopy4s5vhEUrA+WxhA5WMPPBsBPZyDd+k81qmcvl3Hzt9ZSHZrF8V/3f2jYmrAA8lCCnNAUTkioorBR4Nppl1AhL1mgCLGHCREt1LApYDS/1XsASnwXF6rnWoBvkfPpsLpfvmo4VhW5YWEXAKpmRgkFhwLdIa8EDo0ZWbDHBaqhGlud0gXPVzObmrudag5MNBanbRHDOqgrFT6d39WysL3p+GxBWpXUJR10sIngZT5QWP1tMmtXwdrH0/d8PBsnbmQnX9Vxr0A3DOX0209k2ZrN8V1UeuAi5P30IgECahoMVlNclrAYGiwdWYOmV0XY3IZ8vnuBpnacwjdysWq81OHoYzkS/8KOX+XI2f7yreuXEFYTm6fhJPt/+NN0qAuKpWNBwsAIQ6q5v20aDFYACtoaCuJ2owaZZr6rrOMmNmehGT/SgTdoe1dZjirIzRdlHz/JRVV2qqU+Vz9uU7T/evZp+vcb/nirux6TXTXPWhSGAKcOe1kG0sA0FqxHLfDUWrAC0gL2+4YSE0MHKwWoBwEoLy4lEkb0NCisYml6mwWA1tB0CBz1bWbZp1WtUuetSx1ol8dZzXceRD/psRkzM4vmbdh1nUs9JgNbAy8fPFaym0LAWN6zGLZuDlYOVg9W8hVUELAcrBysHKwerBQCrUlqDg5WDlYOVg9X8h1UpJHSwcrBysHKwmv+wGn5L6GDlYOVg5WA1z2E1QsNysHKwcrBysJrfsKoMCR2sHKwcrBys5jGsSsBysHKwcrBysJr/sBoGloOVg5WDlYPVPIfViDndHawcrBysHKzmN6yq0LAcrBysHKwcrOYHrMAOT+DnYOVgNV9gdWVsOQA7guMOVg5WFcc8B6ux5dzqJ7jvkjew4/h+btr/aMWxT685n5s3XUrai2YafbK3k0/u+zl3Dxwrf86n11zIzRsuqzxn/8+4e+BouVzfPes1XL1iKwBfO/gwNx36RbmsX173EtYmWnj9c/dXVY+tfoKPrH4pb1t1UXnf8cIA3+l+mpuO/mRBwWqLSvHfZ/0hHzrybXb0Ha8rrD7Y/CJuW/kbbHvh4+zVmRnD6nvLfourm6O2/8yJ/+Tc+Bqubiptn/xP/nxgx6KGlbAg9LC6JI1AWItvNPmYjOI4YTHSTjJjyNSwikJCB6uKcl6ZauW+S97ApqYl44Ls5k2X8q1Du1A//CLn/PTrAPzlppeUz93qJ7h5w2V86/CTqB99jnMe+hoI+MuNLymX6wPLt3HF0o28+rFv8KG9D3DjGZdzffPK6PuT7bxpxdncuv9HVdXj+uZVPHLRO9iaXs6rn/g66uG/Qz38d3zj2GO8afm57Dz7hoUXBo55cOvkWTF7z2qLbOLq5ov42qn/Qe5/L1/OPMrVTRfxtd7/QR5476KHVSqbID2YolUnaS4mSGR8EkUPVRDIgkcyF6NNp0gMxEn1xVBFOWNYlTwsB6uh7/ryxhdxZccGbnrqAR54yXVj6vTOjrMAuOnAIwDsCXJ85dAv+eTZr2KrH2dPkOedHZHXdNPBX0Tn6DxfOfQ4n9z2Grb6SfaEOdYnWqKQJ3+Ko2Ge24AzE20w2MltG67gO13PsCfMVVWPj218Nc9nerj4mbsrjr+361F6dZ7bNr2OP2zdzOf7nuMDS8/jtk3XcM4v/549YTaC55LzuW3jNZzzxGfZraOVir+y8td407Lz6IhF5czoAl86+hP+/MTDkWfSfj7vW/sanhg8xPbWMzle7GflM5/lKytewZuWXFB5XdeP+PMTP4+ua7uI29a9ia91/ZgbV/waAPvyx/l6z8/4WN8v2aJS7N72XgBuW/MWXtdyDlcc/gbXJ9fzV8tfzQXpMyKPNXuQW499mx3F7vI9uj6xnr9a/louSI04p+vf2RF0le/hB5tfxB8tfRUdfivHgz525vZP+Xx+sOkyrm2+lAuS66PPzR3g1hP/yo7gGNfHN3HX6j8A4Mb2q7ix/apy+9/YdhVvb9lO86EPcn1sE3/V/nouSGyIPiO/n1tP/gs79DHA8sHUi3lf+1t4ovAC25NnczzsZeWxjyyIMFAgUCh8X2A9sDpawEZaMBI8KYklFIVciLWzg1VJdHewGrK+sMAbd97H0SA/7g1al2qmKz9Yce0zuV7SXoxXNa8EAesSLXTlByrK8kx+xDlYDuT7I28q0c617VFHeGjwGB9Yto2V8RZuOvyzqurxh62b2ZRaxleOPjpuvT5+4inUI7fz+b7npphIEMxQp24/jxtXb+ejh36A3PlJ5M6/4flcNzevvqLinqRVnAFdQD7xcW7YdxcfbL+QG1dewUeP/BfyyY8hd32M5/PHuXnFy8fcl8uaNrBt9+3Ipz/CoC7wRyuuBGCvybBtz6cB+NCRb3PF4W+wRaX56rrf5pHsfuTuDyF3fwiAu9b9Xrme0Tm/yyPZF5B7P4jc+8HonLX/T7me1yc2cNvK3+A7/TuRz72f9xy7myuatk2qR10f38htHb9JZ3gKue99bDvw0ehzV94IwN3FfWw7eFsU1pc8rG2HItB8rfe/aT70QbbIJr664h08kn8eefDPkAf/LPqMjndV3N+0TDBg8sjDt3JDz5ecZjVhWoODVfnYew/vYk+Qn/ABWVPyjEZeezSM5thu9+MArEk0jynL0TACYLsXnfPxnmf4yckXeOBFv8NtW17DZ/b9mB35k/z+mhdxx4GHqq7HRU0rAPjv7JHphUOTzHr6sVO7kDs/yef6ny0fe2TgAGkV58r40oqPua/3V5GnWOzhY71PIJ/8GJ8b2Fsu/yODQ9ctq/ier/Q8VNKM4IH+Z+jwW9jipcbtKO9tfwkZk+ddJx4oH7no4FdJywS3t78sOqftpWR0nned/MHwOYe/RFoluL01Au3vt17O8aCPd536fgSbwn6+deqhSTvn77e8mONhH9d03wUC9ppBbj1xLx1eK7e3vGKKTlrydJt/LSp//3eHy9b92aj8TVdWtmful1F7hsccrMY9ZvEcrGpQR6p5G1h5U17/7P3w7P3lc7+89qUcK/Tz+b59/Hjrm9m+ZGMk2r7wIO/tenwS/aby+69vWsM/n3NDxd5/6drJ2w89MP7DO07Zt6gUH10ZwWBragUXNK0FoEMlK+rTo3OVeo5K8dGSR7U1uYIL0uuGrxthP8gdLP/dqydfZebsxEo6/FbMttvGHGstfe7Z8VXROVs+NuE5q7w2niscq6jvgeDkpBrWWbFV0TUj9u0IusiYPOu8JVW9DTw7toYOrw1zxt+NLZtMVVzbYzIL2LMSE0K7VrAafkvoYFWVN3Ik38/KRFNFOVf70co5p0pe1JFCPyuTzRXXri55X6d0ftw6bvWSvH31RVy28+t8euXFXNiyhnMe+RLvXLaNP934Cr7bt58d+ZNj6vXLTNQBX5VezZ5S2Hd35gh3P3J7uS79F/9JFQL7cF3f3XIWn938mzw5eJg92S4eGTjAIwMHuHHVyyado/3dzVv47MbreDJziD25Lh4ZPMAjgwe4ccUVk3ogk88rH9mTmYNs/9U/Efoh8bigKZZAAF1hplyvJ7MHuejwl5lZ6kIVnaaqlcPH/wF7Mr+fi45/dhIxnQUhsE/PsxqnTnZ2sJqGhtWgsBp1Ew/l+1mRaK4o59nJNgCeyfWBIDon3lxRp7MTQ+f0jlvHr575Gr7V+Uv2hFnWxVvoKvSzR2f56olnANjetHLcen2+73n2ZXu4oeOCab0lW60S5Qd9fbyt4mNvWHohTw4e5qLn/onrj36fd3U9SEvFQrPjd8obll7Ck5lDXLTv61zf+T3e1b2DFhWf4s3X1NtHgl42J1YgrCQW+KiiwuhoTb6EkCDgSHCKzYkVk8JqT+EYZ8ZXVrT/en/JpJ3m2WLnmGuu9FaQlgkOhSergBwcCU+yObZy0eZZhZ7GCjM5uEvXGKWxys4YVsPAcrCaYqWU6PhXj++N3iauv7x8/rvWXsy+wRPsyJ8CLF89vic6Z92Ly5/zrrWXsC9zIvKSRpX7D9s2lYT2SE85VOhnRaKFrV6Sdy49OxLkM50T1uum5/6DC1vWsHPbDVyfXlMu6weWnMfOrb9FWsU5VOgrfU6UB3ZzxyWREJ1ew5uWnVdRzwFdYGWshS0qBVhuX/ZiXr/0vCnv74DOs9Jvja4TcPuSl/D69gtmDKs2LwrlvtgbvW19aNvvkkwrYnGPT7a/nMOb/4K3JTbRIuLc2fdY5HGuvXlYJ1vyGsxZH+f60pu5L/b9jLRKcPeyt5QF9Te1XDJpOPepvv8hLeN8b9lvRaGybOKOZb/J8bCPPx/4YVUe4xcHfxqVbfkfD5et5Q2YdZ/h+timBe9ZFWJFBpozDIoCgRkNL0uoNINBgWxLjlxLAaPsjGEVhYQOVlXXcU+Q40v7H+HmDZdx44ZLI3e/t5Obdt9fLsseneNLBx7m5vWXc+P6y6Jz+o5y0+7vjlvuW9dv5+tHHxsWabse49ym5fzq0uh1+Wf2PzgMunHKvqNwksue/CofWbWdr2z9Df655NVkdIHv9jzNnx74L3YUTkRibqGHzxz6H25e/TJMxyXsy3XznRNPceOq7eUyvefoA9yz8TfZff57orIPHuZb3Y9y48qXcVlqNXfnDo37YL2n837uWX8du8/5s1IYd4hv9TzMjSt+jcuSq7k7d6Cq0GGvznB/35P86YqreXXz2Vx08Ku889A/8f7lV9N1zvsA2F/o5mOd/8l/FY/QpGLsMgP8See/8J72l2PO+jgA+wpdfOjYv3F3YX9U96CLdx75Bz7e8RbM5r/heNjHzuwLXN1y0YQdc0dwjHce+zp/teQazIZPReDM7uaGY1+pOoN9hz7GO7u/xl+1RpAC2Bcc40Mn7+bu4vMTeiYDqz7JE4UXuOLUF+d9GGiBrCqQVXmED37gY6xBxw1W2FmHgRWH1L/eYx2sZltHN9ymqu1p13FEPSwkiz5x62OsRQhDIulhjEZ5glBYeky2Ss3KDbeZ728DJ9LBPAcrB6t5D6vS5+ViRWwOhIG4L0vHBfmsJusHpafZwWqxwmoCDcvBysFqnsFqaFtCIVUk9EKCMCQINFIJikWNNyhRIQ5WixhW4+RhOVg5WM1TWJW2rYAgqQnQYKCY0VgTHdeedbBaxLCKRHcHKwerBTqfVUYFkALlg5UzqI+D1YKC1QhgOVg5WM1jWJVmJRGmNL2IsGhFqY4WHXNhYCPAqgQsBysHq/kHK4EllYsjESghCIoh0hMYE+JZi1U+KAi0JvQNQUI7WC1yWEXAcrBysJqPnhUCz3goH2IJgS1NJ2EshEAiLhFSoDMWYY2DVQPACkYOzXGwcrCa93Ow20kA52C12GE1PL2Mg5WDlVswwsFqnsMKbGnVHAcrB6sFASscrBoYVlFI6GDlYDUvYVWNzhWVR1gHq0aA1SQaloOVg9VphBVgraWoguFnbAJYGWkIla6YQ87BanHCCsbNw3KwcrCaB2GgEOQSRQqmQCqMYaXEMwqwGGnIWU1RaMImE13jYLXoYVUCloOVg9U81ayExXgwSBEUSB2dZ7wp7peD1aKEVQQsBysHq4XwNlCMBJWDVSPCaoSG5WDlYIVLXXCwmtewKgHLwcrBysHKwWr+wwphh+bDcrBysHKwcrCa37CKPCwHKwcrBysHqwUAK4D/fwDx69fPO0TxzQAAAABJRU5ErkJggg==';
								image.onload = function() {
									ctx.drawImage(image, 0, 0);
									// Show the form when Image is loaded.
									document.querySelectorAll('.form<?php echo $socialKey;?>')[0].style.visibility = 'visible';
								};
								brush.src = 'data:image/png;base64,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';

								canvas.addEventListener('mousedown', handleMouseDown, false);
								canvas.addEventListener('touchstart', handleMouseDown, false);
								canvas.addEventListener('mousemove', handleMouseMove, false);
								canvas.addEventListener('touchmove', handleMouseMove, false);
								canvas.addEventListener('mouseup', handleMouseUp, false);
								canvas.addEventListener('touchend', handleMouseUp, false);

								function distanceBetween(point1, point2) {
									return Math.sqrt(Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2));
								}

								function angleBetween(point1, point2) {
									return Math.atan2( point2.x - point1.x, point2.y - point1.y );
								}

								// Only test every `stride` pixel. `stride`x faster,
								// but might lead to inaccuracy
								function getFilledInPixels(stride) {
									if (!stride || stride < 1) { stride = 1; }

									var pixels   = ctx.getImageData(0, 0, canvasWidth, canvasHeight),
										pdata    = pixels.data,
										l        = pdata.length,
										total    = (l / stride),
										count    = 0;

									// Iterate over all pixels
									for(var i = count = 0; i < l; i += stride) {
										if (parseInt(pdata[i]) === 0) {
											count++;
										}
									}

									return Math.round((count / total) * 100);
								}

								function getMouse(e, canvas) {
									var offsetX = 0, offsetY = 0, mx, my;

									if (canvas.offsetParent !== undefined) {
										do {
											offsetX += canvas.offsetLeft;
											offsetY += canvas.offsetTop;
										} while ((canvas = canvas.offsetParent));
									}

									mx = (e.pageX || e.touches[0].clientX) - offsetX;
									my = (e.pageY || e.touches[0].clientY) - offsetY;

									return {x: mx, y: my};
								}

								function handlePercentage(filledInPixels) {
									filledInPixels = filledInPixels || 0;
									console.log(filledInPixels + '%');
									if (filledInPixels > 50) {
										canvas.parentNode.removeChild(canvas);
									}
								}

								function handleMouseDown(e) {
									isDrawing = true;
									lastPoint = getMouse(e, canvas);
								}

								function handleMouseMove(e) {
									if (!isDrawing) { return; }

									e.preventDefault();

									var currentPoint = getMouse(e, canvas),
										dist = distanceBetween(lastPoint, currentPoint),
										angle = angleBetween(lastPoint, currentPoint),
										x, y;

									for (var i = 0; i < dist; i++) {
										x = lastPoint.x + (Math.sin(angle) * i) - 25;
										y = lastPoint.y + (Math.cos(angle) * i) - 25;
										ctx.globalCompositeOperation = 'destination-out';
										ctx.drawImage(brush, x, y);
									}

									lastPoint = currentPoint;
									handlePercentage(getFilledInPixels(32));
								}

								function handleMouseUp(e) {
									isDrawing = false;
								}

							})();
							$(document).on('click', '.sharefb<?php echo $socialKey?>', function () {

								// e.preventDefault(); // avoid to execute the actual submit of the form.
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI('<?php echo $url; ?>');
								console.log(currentUrl, "=== current url")
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>')
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												$('#scratchContainer<?php echo $socialKey; ?>').hide();
												$('#FBLike<?php echo $socialKey?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							})
						</script>
					<?php } else if($type == 'spin-and-share' && $network == 'facebook') { ?>
						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey; ?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<span class="info-box-text"><?php echo $visitAction; ?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"; ?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey;?>" class="panel-collapse collapse">
								<div class="card-body">

									<!-------------------- REVEAL -------------------->
									<div id="spinContainer<?php echo $socialKey; ?>" class="row">
										<div class="col-12 col-md-12 text-center" id="spin-container<?php echo $socialKey;?>">

											<h3>You have <b>(<span id="try_limit<?php echo $socialKey?>" class="text-danger"><?php echo $spin_limit;?></span>)</b> chances to win</h3>

											<div class="cd-main-content text-center">

												<div class="wheel-horizontal wheel-horizontal<?php echo $socialKey;?>"></div>
												<button type="button" class="button button-primary wheel-horizontal-spin-button wheel-horizontal-spin-button<?php echo $socialKey;?>">Spin to win</button>

											</div>
											<input type="hidden" id="try_count<?php echo $socialKey;?>" value="0" />

										</div>
										<div class="col-12 col-md-12 text-center" id="share-container<?php echo $socialKey;?>" style="display: none;">
											<a id="action2" href="javascript:void(0);" style="color: #fff; " class="btn btn-block btn-social btn-facebook sharefb<?php echo $socialKey?>">
												<i class="fab fa-facebook fa-2x"></i> <?php echo $shareAction;?></a>
										</div>
									</div>
									<div
										id="FBLike<?php echo $socialKey?>"
										style="display:none;-webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;"
										class="collapse text-center" >
										<p id="message-description-<?php echo $socialKey?>">
											<i class="fas fa-check"></i>
											Thanks for spin! Points have been added!
										</p>
									</div>
									<!-- /.row -->

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script>
							// Super Wheel Script
							var spin_limit = '<?php echo $spin_limit;?>'
							spin_limit = parseInt(spin_limit)
							jQuery(document).ready(function($){

								$('.wheel-horizontal<?php echo $socialKey;?>').superWheel({
									slices: [
										{
											text: "<?php echo $numpoint; ?> Points",
											value: 1,
											message: "You won <?php echo $numpoint; ?> points! Share to claim",
											discount: "no",
											background: "#364C62",

										},
										{
											text: "No luck",
											value: 0,
											message: "You have no luck today",
											discount: "no",
											background: "#9575CD",

										},
										{
											text: "<?php echo $numpoint; ?> Points",
											value: 1,
											message: "You won <?php echo $numpoint; ?> points! Share to claim",
											discount: "no",
											background: "#E67E22",

										},
										{
											text: "Lose",
											value: 0,
											message: "You Lose :(",
											discount: "no",
											background: "#E74C3C",

										},
										{
											text: "<?php echo $numpoint; ?> Points",
											value: 1,
											message: "You won <?php echo $numpoint; ?> points! Share to claim",
											discount: "no",
											background: "#2196F3",

										},
										{
											text: "Nothing",
											value: 0,
											message: "You get Nothing :(",
											discount: "no",
											background: "#95A5A6",

										}
									],
									text : {
										color: '#fff',
										offset : 11,
										letterSpacing: 0,
										orientation: 'h',
									},
									slice : {
										background : "#333",
									},
									line: {
										width: 6,
										color: "#eee"
									},
									outer: {
										width: 10,
										color: "#eee"
									},
									inner: {
										width: 12,
										color: "#eee"
									},
									/*marker: {
										background: "#00BCD4"
									},*/
									selector: "value"
								});

								var tick = new Audio('<?php echo PATH_ROOT?>/plugins/spin-wheel/media/tick.mp3');
								$(document).on('click','.wheel-horizontal-spin-button<?php echo $socialKey;?>',function(e){
									$('.wheel-horizontal<?php echo $socialKey;?>').superWheel('start','value',Math.floor(Math.random() * 2));
									$(this).prop('disabled',true);
								});
								$('.wheel-horizontal<?php echo $socialKey;?>').superWheel('onStart',function(results){
									$('.wheel-horizontal-spin-button<?php echo $socialKey;?>').text('Spinning...');
								});
								$('.wheel-horizontal<?php echo $socialKey;?>').superWheel('onStep',function(results){
									if (typeof tick.currentTime !== 'undefined')
										tick.currentTime = 0;
									tick.play();
								});
								$('.wheel-horizontal<?php echo $socialKey;?>').superWheel('onComplete',function(results){
									//console.log(results.value);
									if(results.value === 1){
										swal({
											type: 'success',
											title: "Congratulations!",
											html: results.message+' <br><br>'
										});
										$('#spin-container<?php echo $socialKey;?>').hide()
										$('#share-container<?php echo $socialKey;?>').show()
									}else{
										var try_count = $('#try_count<?php echo $socialKey;?>').val()
										if(try_count == spin_limit - 1) {
											swal("Oops!", "Sorry, you have used up all your chances for today", "error");
											// disable wheel part
											$('#spin-container<?php echo $socialKey;?>').hide()
										} else {
											try_count ++
											$('#try_count<?php echo $socialKey;?>').val(try_count)
											$('#try_limit<?php echo $socialKey;?>').html(spin_limit - try_count)
											swal("Oops!", results.message, "error");
										}
									}
									$('.wheel-horizontal-spin-button<?php echo $socialKey;?>:disabled').prop('disabled',false).text('Spin to win');

								});
							});
							$(document).on('click', '.sharefb<?php echo $socialKey?>', function () {

								// e.preventDefault(); // avoid to execute the actual submit of the form.
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI('<?php echo $url; ?>');
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>')
								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												$('#spinContainer<?php echo $socialKey; ?>').hide();
												$('#FBLike<?php echo $socialKey?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							})

						</script>
					<?php } else if($type == 'play-then-share' && $network == 'facebook') {?>
						<!------------- Action play-then-share ------------------------------->

						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<!--<span class="info-box-text">Share then visit action</span>-->
									<span class="info-box-text"><?php echo $visitAction;?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">

									<!-------------------- REVEAL -------------------->
									<div id="gameContainer<?php echo $socialKey; ?>" class="text-center">
										<h3>Play the game to get points!</h3>

										<div class="codegena_iframe codegena_iframe<?php echo $socialKey;?>"
											 onclick="onClickGame()"
											 data-src="<?php echo $game['iframe'];?>"
											 style="height:350px;width:100%;"
											 data-responsive="true"
											 data-img="<?php echo $game['preview'];?>"
											 data-css="background:url('images/loading.gif') white center center no-repeat;border:0px;"
											 data-Id="game" data-name="<?php echo $game['name']?>"></div>

									</div>

									<div class="col-12 col-md-12 text-center" id="share-container<?php echo $socialKey;?>" style="display: none;">
										<p><i class="fas fa-check"></i> Thanks for playing, share to add points!</p>
										<a id="action2" href="javascript:void(0);" style="color: #fff; " class="btn btn-block btn-social btn-facebook sharefb<?php echo $socialKey?>">
											<i class="fab fa-facebook fa-2x"></i> <?php echo $shareAction;?></a>
									</div>
									<div id="FBLike<?php echo $socialKey?>" style="display:none;-webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;" class="collapse text-center" >

										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for share, points have been added!</p>

									</div>

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script>
							// Super Wheel Script
							$(document).on('click', '.codegena_iframe<?php echo $socialKey;?>', function() {
								console.log('click game ===============')
								setTimeout(function() {
									//$('#gameContainer<?php //echo $socialKey; ?>//').hide();
									$('#share-container<?php echo $socialKey; ?>').show();
								}, <?php echo $delayTime?> * 1000);
							})

							$(document).on('click', '.sharefb<?php echo $socialKey?>', function () {

								// e.preventDefault(); // avoid to execute the actual submit of the form.
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI('<?php echo $url; ?>');
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>')

								// if(getDiffDays() > 48) {
									var timer = 0
									var popupCheck = setInterval(function() {
										var fraudCheck = window.localStorage.getItem('fraud')
										timer ++;
										if(fraudCheck == 'no') {
											clearInterval(popupCheck)

											setTimeout(function() {
												//$('#gameContainer<?php //echo $socialKey; ?>//').hide();
												$('#share-container<?php echo $socialKey; ?>').hide();
												$('#FBLike<?php echo $socialKey?>').show();
												$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
												updateTotalPoint(<?php echo (int)$numpoint?>);
											}, <?php echo $delayTime?> * 1000);
										}
										if(timer > 6) {
											clearInterval(popupCheck)
										}
									}, 1000)
								// }
							})

							function onClickGame() {
								setTimeout(function() {
									$('#gameContainer<?php echo $socialKey; ?>').hide();
									$('#share-container<?php echo $socialKey; ?>').show();
								}, <?php echo $delayTime?> * 1000);
							}

						</script>
					<?php } else if($type == 'record-and-share' && $network == 'facebook') {
//                                    $recordType = 'video';
						?>
						<!------------- Action record-and-share ------------------------------->
						<div class="card card-default">

							<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $socialKey?>">
								<span id="<?php echo $id?>" class="info-box-icon bg-info"><i class="fab fa-facebook"></i></span>

								<div class="info-box-content">
									<!--                                            <span class="info-box-text">Share then visit action</span>-->
									<span class="info-box-text"><?php echo $visitAction;?></span>

								</div>
								<span id="action-point-<?php echo "$socialKey-$network"?>" class="badge badge-danger float-right">+<?php echo $numpoint?></span>
								<!-- /.info-box-content -->
							</a>
							<!-- /.info-box -->

							<div id="collapse<?php echo $socialKey?>" class="panel-collapse collapse">
								<div class="card-body">

									<!-------------------- REVEAL -------------------->
									<div id="recordContainer<?php echo $socialKey;?>" class="col-12 col-md-12 text-center">
										<?php if($recordType == 'audio') {?>
											<p>
												<audio id="my_<?php echo $recordType."_".$socialKey;?>"
													   class="video-js vjs-default-skin <?php echo $recordType;?>--bgcolor video--dimensions"></audio>
											</p>
										<?php } else {?>
											<p>
												<video id="my_<?php echo $recordType."_".$socialKey;?>"
													   class="video-js vjs-default-skin <?php echo $recordType;?>--bgcolor video--dimensions"></video>
											</p>
										<?php } ?>

										<script>
											//AUDIO
											var recordType = '<?php echo $recordType;?>'
											var plugin = {}
											var controlBar = {}
											if(recordType == 'audio') {
												plugin = {
													wavesurfer: {
														src: "live",
														waveColor: "#36393b",
														progressColor: "black",
														debug: true,
														cursorWidth: 1,
														msDisplayMax: 20,
														hideScrollbar: true
													},
													record: {
														audio: true,
														video: false,
														maxLength: parseInt('<?php echo $recordLength;?>'),
														debug: true
													}
												}
												controlBar = {
													volumePanel: true,
													fullscreenToggle: true
												}
											} else if(recordType == 'video') {
												plugin = {
													record: {
														audio: true,
														video: true,
														maxLength: 60,
														debug: true
													}
												}
												controlBar = {
													volumePanel: true,
													fullscreenToggle: true
												}
											} else if(recordType == 'gif') {
												plugin = {
													record: {
														animation: true,
														animationQuality: 20,
														animationFrameRate: 200,
														maxLength: 10,
														debug: true
													}
												}
												controlBar = {
													volumePanel: false,
													fullscreenToggle: false
												}
											} else if(recordType == 'image') {
												plugin = {
													record: {
														image: true,
														debug: true
													}
												}
												controlBar = {
													volumePanel: false,
													fullscreenToggle: false
												}
											}
											var player = videojs("my_<?php echo $recordType."_".$socialKey;?>", {
												controls: true,
												width: 450,
												height: 285,
												fluid: false,
												plugins: plugin,
												controlBar: controlBar
											}, function() {
												// print version information at startup
												var msg = 'Using video.js ' + videojs.VERSION +
													' with videojs-record ' + videojs.getPluginVersion('record') +
													', videojs-wavesurfer ' + videojs.getPluginVersion('wavesurfer') +
													', wavesurfer.js ' + WaveSurfer.VERSION + ' and recordrtc ' +
													RecordRTC.version;
												videojs.log(msg);
											});
											// error handling
											player.on('deviceError', function() {
												console.log('device error:', player.deviceErrorCode);
											});
											player.on('error', function(error) {
												console.log('error:', error);
											});
											// user clicked the record button and started recording
											player.on('startRecord', function() {
												console.log('started recording!');
											});
											// user completed recording and stream is available
											player.on('finishRecord', function() {
												// the blob object contains the recorded data that
												// can be downloaded by the user, stored on server etc.
												console.log('finished recording: ', player.recordedData);

												$('#share-container<?php echo $socialKey;?>').show()

												var formData = new FormData();
												if(recordType == 'audio') {
													formData.append('audio', player.recordedData);
													formData.append('file_name', 'my_<?php echo $recordType."_".$socialKey;?>')
												} else if(recordType == 'video') {
													formData.append('audiovideo', player.recordedData);
													formData.append('file_name', 'my_<?php echo $recordType."_".$socialKey;?>')
												}

												// Execute the ajax request, in this case we have a very simple PHP script
												// that accepts and save the uploaded "video" file
												if(recordType == 'audio' || recordType == 'video') {
													xhr('../plugins/record/servers/upload-video.php', formData, function (fName) {
														console.log(recordType + " succesfully uploaded !",fName);
													});
												}

												// Helper function to send
												function xhr(url, data, callback) {
													var request = new XMLHttpRequest();
													request.onreadystatechange = function () {
														if (request.readyState == 4 && request.status == 200) {
															callback(location.href + request.responseText);
														}
													};
													request.open('POST', url);
													request.send(data);
												}

											});
										</script>

									</div>

									<div class="col-12 col-md-12 text-center" id="share-container<?php echo $socialKey;?>" style="display: none;">
										<p><i class="fas fa-check"></i> Thanks for record, share to add points!</p>
										<a id="action2" href="javascript:void(0);" style="color: #fff; " class="btn btn-block btn-social btn-facebook sharefb<?php echo $socialKey?>">
											<i class="fab fa-facebook fa-2x"></i> <?php echo $shareAction;?></a>
									</div>
									<div id="FBLike<?php echo $socialKey?>" style="display:none;-webkit-transition: width , height;transition: width , height;-webkit-transition-delay: <?php echo $delayTime?>s;transition-delay: <?php echo $delayTime?>s;" class="collapse text-center" >
										<p id="message-description-<?php echo $socialKey?>"><i class="fas fa-check"></i> Thanks for share, points have been added!</p>
									</div>

									<!-------------------- / REVEAL -------------------->

								</div>
							</div>
						</div>
						<script>
							$(document).on('click', '.sharefb<?php echo $socialKey?>', function () {

								// e.preventDefault(); // avoid to execute the actual submit of the form.
								var openUrl = '<?php echo $shareLink; ?>';
								var currentUrl = encodeURI('<?php echo PATH_ROOT."/plugins/record/servers/my_".$recordType."_".$socialKey.".webm"; ?>');
								var metaTitle = encodeURI($('meta[name=title]').attr("content"));
								var openUrlReplace = openUrl.replace("<URL>", currentUrl);

								openUrlReplace = openUrlReplace.replace("<TITLE>", metaTitle);
								popup(openUrlReplace, '<?php echo $socialKey;?>')

								// if(getDiffDays() > 48) {
								var timer = 0
								var popupCheck = setInterval(function() {
									var fraudCheck = window.localStorage.getItem('fraud')
									timer ++;
									if(fraudCheck == 'no') {
										clearInterval(popupCheck)

										setTimeout(function() {
											//$('#gameContainer<?php //echo $socialKey; ?>//').hide();
											$('#share-container<?php echo $socialKey; ?>').hide();
											//$('#recordContainer<?php //echo $socialKey;?>//').hide();
											$('#FBLike<?php echo $socialKey?>').show();
											$('#action-point-<?php echo "$socialKey-$network"?>').html('<i class="fas fa-check"></i>').removeClass('badge-danger').addClass('badge-default');
											updateTotalPoint(<?php echo (int)$numpoint?>);
										}, <?php echo $delayTime?> * 1000);
									}
									if(timer > 6) {
										clearInterval(popupCheck)
									}
								}, 1000)
								// }
							})
						</script>
					<?php }?>
					<?php
					endforeach;
				} // if allSocial && count > 0 ?>


			</div>
		</div><!--/accordion>-->

	</div>
	<div class="tab-pane fade" id="points" role="tabpanel" aria-labelledby="points-tab">
		<div class="pt-3"></div>

		<!--================================================ POINTS ================================================-->

		<h3 class="text-center"><span class="text-danger">50</span> Points <span class="text-danger">5</span> Actions</h3>

		<ul class="products-list product-list-in-card pl-2 pr-2">
			<li class="item">
				<div class="product-img">
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">Visit then share
						<span class="badge badge-warning float-right">10</span></a>
					<span class="product-description">
			07-03-2020 16:26:28
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">Share then visit
						<span class="badge badge-warning float-right">10</span></a>
					<span class="product-description">
			07-03-2020 16:26:28
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">Submit then share
						<span class="badge badge-warning float-right">10</span></a>
					<span class="product-description">
			07-03-2020 16:26:28
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">Share then visit
						<span class="badge badge-warning float-right">10</span></a>
					<span class="product-description">
			07-03-2020 16:26:28
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">Refer friends
						<span class="badge badge-warning float-right">10</span></a>
					<span class="product-description">
			07-03-2020 16:26:28
		  </span>
				</div>
			</li>
			<!-- /.item -->
		</ul>

		<!--================================================ / POINTS ================================================-->

	</div>
	<div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
		<div class="pt-3"></div>

		<!--================================================ LEADERBOARD ================================================-->

		<ul class="products-list product-list-in-card pl-2 pr-2">
			<li class="item">
				<div class="product-img">
					<span class="badge badge-default float-left">1</span>
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">User Name
						<span class="badge badge-warning float-right">100</span></a>
					<span class="product-description">
			Visited our facebook page on 28/6/2020
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<span class="badge badge-default float-left">2</span>
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">User Name
						<span class="badge badge-warning float-right">90</span></a>
					<span class="product-description">
			Visited our facebook page on 28/6/2020
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<span class="badge badge-default float-left">3</span>
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">User Name
						<span class="badge badge-warning float-right">80</span></a>
					<span class="product-description">
			Visited our facebook page on 28/6/2020
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<span class="badge badge-default float-left">4</span>
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">User Name
						<span class="badge badge-warning float-right">70</span></a>
					<span class="product-description">
			Visited our facebook page on 28/6/2020
		  </span>
				</div>
			</li>
			<!-- /.item -->
			<li class="item">
				<div class="product-img">
					<span class="badge badge-default float-left">5</span>
					<img style="margin-right:12px" src="<?php echo PATH_ROOT?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
					<a href="javascript:void(0)" class="product-title">User Name
						<span class="badge badge-warning float-right">60</span></a>
					<span class="product-description">
			Visited our facebook page on 28/6/2020
		  </span>
				</div>
			</li>
			<!-- /.item -->
		</ul>

		<!--================================================ / LEADERBOARD ================================================-->

	</div>

</div>

</div><!--/card-body-->

<div class="card-footer clearfix">
<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-default" class="float-left">Terms & Conditions</a>
<a href="//suite.social/promo" target="_blank" class="float-right">Powered by SocialSuite</a>
</div>
<!-- /.card-footer -->

</div><!-- /.card -->
</div><!-- /.login-box -->

</div><!--/col-md-6-->

</div><!-- /.row -->

<!--================================================ / TERMS ================================================-->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Terms & Conditions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Details here</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="list-container">

</div>

<!-- Bootstrap 4 -->
<script src="<?php echo PATH_ROOT ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Select2 -->
<script src="<?php echo PATH_ROOT ?>/plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo ASSET_ROOT ?>/js/adminlte.min.js"></script>

<!-- GAME -->
<script src="<?php echo PATH_ROOT ?>/src/js/async-iframe.js"></script>

<!-- jQuery Knob -->
<script src="<?php echo PATH_ROOT ?>/plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- Summernote -->
<script src="<?php echo PATH_ROOT ?>/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

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
        //select2
        $('.myselect2').select2({});
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
    //when select network
    $("select#network").change(function() {
            var selectedNetwork = $("select#network").val();			
            $("select#action").html('');
            for (var x in actions) {
                if (actions[x]['network'] == selectedNetwork) {
                    console.log(actions[x]['network']);
                    var newOption = new Option(actions[x]['actionName'], actions[x]['filename'], false, false);
                    $('select#action').append(newOption)
                }
            }
            $('select#action').select2({});

        });
    var actions = <?php echo json_encode($allPlugins) ?>;
</script>

<!--==================================================================== WIDGET CODE ====================================================================-->

<script type="text/javascript">
    function updateTotalPoint(point) {
        var totalpoint = $('#totalpoint').val();
        totalpoint -= point;
        if (totalpoint <=0 ) {
            totalpoint = 0;
            $('.all-plugins-data').html($('#promotioncontent').html());
        }
        $('#totalpoint').val(totalpoint);
        $('#totalpoint').trigger('change')

    }
    async function popup(url, key)
    {
        // var prevCheatCount = window.localStorage.getItem(key) ? parseInt(window.localStorage.getItem(key)) : 0
        var cheatData = await getCheatData()
        var prevCheatCount = cheatData.cheat
        var diffHours = await getDiffDays()

        if(diffHours <= 48) {
            swal("Cheating Detected!", 'Your account is banned for 48 hours.', "error");
            return
        } else {
            if(prevCheatCount >= 3) {
                setFraudData('remove', 0)
            }
        }

        var w = 800;
        var h = 600;
        var title = 'Social';
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        var popup = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        window.localStorage.setItem('fraud', 'yes')
        var timeCounter = 0
        var popupTick = setInterval(function() {
            if (popup.closed) {
                clearInterval(popupTick);
                if(timeCounter > 5) {
                    window.localStorage.setItem('fraud', 'no')
                    window.localStorage.setItem(key, 0 + '')
                    console.log('remove fraud, ===============')
                    setFraudData('remove', 0)
                } else {
                    window.localStorage.setItem('fraud', 'yes')
                    prevCheatCount ++
                    window.localStorage.setItem(key, prevCheatCount + '')
                    setFraudData('set', prevCheatCount)
                    if(prevCheatCount == 2) {
                        swal("Cheating Detected!", "We have detected you are not visiting or sharing, please don't cheat or you will be banned! Thanks!", "warning");
                    } else if(prevCheatCount >= 3) {
                        swal("Cheating Detected!", "We have detected you are not visiting or sharing, you have been banned for 48 hours!", "error");
                        // window.localStorage.setItem('limitedAccount', new Date().toDateString())
                        console.log('set fraud, ===========')
                    }
                }
                console.log('window closed!');
            } else {
                timeCounter ++
                if(timeCounter > 5) {
                    window.localStorage.setItem('fraud', 'no')
                    window.localStorage.setItem(key, 0 + '')
                    setFraudData('remove', 0)
                    clearInterval(popupTick)
                }
            }
        }, 1000);

        // document.getElementById("action").style.display = "none";
        // document.getElementById("action2").style.display = "none";
        // document.getElementById("action3").style.display = "none";
        // document.getElementById("action4").style.display = "none";
        // document.getElementById("action5").style.display = "none";
        // document.getElementById("action6").style.display = "none";
        // document.getElementById("action7").style.display = "none";
        // document.getElementById("action8").style.display = "none";
        // document.getElementById("action9").style.display = "none";
    }

    async function getDiffDays() {
        // var startDate = window.localStorage.getItem('limitedAccount') ? window.localStorage.getItem('limitedAccount') : ''
        var cheatData = await getCheatData()
        var startDate = cheatData.ban
        var cheatCount = cheatData.cheat
        if(startDate == '' || cheatCount <= 2) {
            return 50
        }
        var date1 = new Date(startDate)
        var date2 = new Date()
        var Difference_In_Time = date2.getTime() - date1.getTime()
        return Difference_In_Time / (1000 * 3600)
    }

    async function setFraudData(flag, cheatCount) {
        var url = 'visitor_set_fraud.php';
        var fd = new FormData();
        fd.append('flag', flag)
        fd.append('cheat', cheatCount)

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
                var data = JSON.parse(data)
            }
        });
    }

    function getCheatData() {
        return new Promise(resolve => {
            var url = 'visitor_set_fraud.php';
            var fd = new FormData();
            fd.append('flag', 'get')

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
                    var data = JSON.parse(data)
                    console.log(data['ban'], "=============== return value")
                    resolve(data)
                }
            });
        })
    }
</script>

<script>

    $(function () {
        /* jQueryKnob */

        $('.knob').knob()
        /* END JQUERY KNOB */

        //INITIALIZE SPARKLINE CHARTS
        // $('.sparkline').each(function () {
        //     var $this = $(this)
        //     $this.sparkline('html', $this.data())
        // })

        /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
        // drawDocSparklines()
        // drawMouseSpeedDemo()

    })

</script>

</body>
</html>
