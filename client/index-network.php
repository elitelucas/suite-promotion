<?php
require_once '../initial.php';
require_once DIR_ROOT . '/db/Plugin.php';
require_once DIR_ROOT . '/db/Social.php';

$social = new Social();
$allPlugins = $social->loadAll();

$plugin = new Plugin();
$pluginData= $plugin->load();
$uniqueId = $plugin->getUniqueId();

$spin_limit = 3;

@$referralId = $_GET['id'];

@$info = (array)$pluginData['info'];

@$backgroundImage = $info['background_image'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Social Promo</title>
<meta name="title" content="Social Promo Demo">

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

<!-- Theme style -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/src/css/adminlte.min.css">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/fontawesome-free/css/all.min.css">

<!-- iconic-font
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">

<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- Text editor -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/summernote/summernote-bs4.css">

<!-- Millery --> 
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> 
<link href="<?php echo PATH_ROOT ?>/src/build/css/millery.min.css" rel="stylesheet" />
<script src="<?php echo PATH_ROOT ?>/src/build/vendor/jquery.min.js"></script>
<script src="<?php echo PATH_ROOT ?>/src/build/js/millery.min.js"></script>

<!-- Spin Wheel -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/spin-wheel/css/sweetalert2.min.css"> <!-- sweetalert2 -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/spin-wheel/css/superwheel.min.css"> <!-- superWheel -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>/plugins/spin-wheel/css/style.css"> <!-- Resource style -->

<!-- Record (General) -->
<link href="<?php echo PATH_ROOT;?>/plugins/record/css/video-js.min.css" rel="stylesheet">
<link href="<?php echo PATH_ROOT;?>/plugins/record/css/videojs.record.css" rel="stylesheet">

<style>

/**************************************** BODY ****************************************/

a {
    color: #666;
}

.login-card-body, .register-card-body {
    padding: 0px;
}

.login-box, .register-box {
	width: 590px;
}

.login-box {
    /*box-shadow: 0 0 2px rgba(0,0,0,0.3), 0 3px 5px rgba(0,0,0,0.2);*/
	overflow: hidden;
}

.login-page, .register-page {
     height: auto;
    background: #fff;
	/*background: #e9ecef;*/
	
background-image:url(); 
background-repeat:no-repeat; 
background-attachment:fixed; 
background-position:center top; 
background-size: cover; 
-moz-background-size: cover;
}

.layout-top-nav .wrapper .main-header .brand-image {
    height: 25px;
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

/**************************************** BANNER ****************************************/ 

.top {
  margin: 0;
  opacity: 1;
  text-align: center;
}

  .jumbotron-facebook {
	background: #5b8dcd;
	background: -moz-radial-gradient(center, ellipse cover,  #5b8dcd 0%, #3c5b9b 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #5b8dcd 0%,#3c5b9b 100%);
	background: radial-gradient(ellipse at center,  #5b8dcd 0%,#3c5b9b 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5b8dcd', endColorstr='#3c5b9b',GradientType=1 );
    color:#fff;	
  }
  
  .jumbotron-instagram {
	background: #61b9d4;
	background: -moz-radial-gradient(center, ellipse cover,  #61b9d4 0%, #3d739c 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #61b9d4 0%,#3d739c 100%);
	background: radial-gradient(ellipse at center,  #61b9d4 0%,#3d739c 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#61b9d4', endColorstr='#3d739c',GradientType=1 );
    color:#fff;	
  }  
  
  .jumbotron-linkedin {
	background: #00a5d5;
	background: -moz-radial-gradient(center, ellipse cover,  #00a5d5 0%, #006699 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #00a5d5 0%,#006699 100%);
	background: radial-gradient(ellipse at center,  #00a5d5 0%,#006699 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00a5d5', endColorstr='#006699',GradientType=1 );
    color:#fff;	
  } 

  .jumbotron-pinterest {
	background: #ea333d;
	background: -moz-radial-gradient(center, ellipse cover,  #ea333d 0%, #cb2027 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #ea333d 0%,#cb2027 100%);
	background: radial-gradient(ellipse at center,  #ea333d 0%,#cb2027 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ea333d', endColorstr='#cb2027',GradientType=1 );
    color:#fff;		
  } 
  
  .jumbotron-twitter {
	background: #52d6f7;
	background: -moz-radial-gradient(center, ellipse cover,  #52d6f7 0%, #359bed 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #52d6f7 0%,#359bed 100%);
	background: radial-gradient(ellipse at center,  #52d6f7 0%,#359bed 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#52d6f7', endColorstr='#359bed',GradientType=1 );
    color:#fff;	
  } 

  .jumbotron-whatsapp {
	background: #00e024;
	background: -moz-radial-gradient(center, ellipse cover,  #00e024 0%, #00a416 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #00e024 0%,#00a416 100%);
	background: radial-gradient(ellipse at center,  #00e024 0%,#00a416 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00e024', endColorstr='#00a416',GradientType=1 );
    color:#fff;	
  }   
  
  .jumbotron-wordpress {
	background: #757370;
	background: -moz-radial-gradient(center, ellipse cover,  #757370 0%, #454442 100%);
	background: -webkit-radial-gradient(center, ellipse cover,  #757370 0%,#454442 100%);
	background: radial-gradient(ellipse at center,  #757370 0%,#454442 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#757370', endColorstr='#454442',GradientType=1 );
    color:#fff;		
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
        width: 50%;
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

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #dc3545;
}

.alert {
    text-align: center;
    padding-top: 6px;
    padding-bottom: 0px;
    padding-left: 50px;
    padding-right: auto;
}

#divB { display : none; }

/**************************************** Millery ****************************************/

.millery {
	width: 100%;
}

.millery-theme-1 .millery-container .millery-bottom {
	/*overflow-y: scroll;*/
	min-height: 400px !important;
}

.millery-container .millery-bottom .millery-panel.millery-panel-overlay {
	min-height: 400px;
	overflow-y: auto;
}

@media screen and (max-width: 768px){
	.millery {
		width: auto;
		height: calc(100vh - 100px);
	}
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

/************************************** CLIENT FORM *******************************************/

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
<script src="<?php echo PATH_ROOT ?>/plugins/jquery/jquery.min.js"></script>

<!-- Spin Wheel (JS) -->
<script src="<?php echo PATH_ROOT ?>/plugins/spin-wheel/js/jquery-2.1.1.js"></script>
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
<body class="hold-transition layout-top-nav">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="https://suite.social/promo" class="navbar-brand">
        <img src="<?php echo PATH_ROOT ?>/images/logos/suite.png" alt="AdminLTE Logo" class="brand-image"
             style="opacity: .8">
        <!--<span class="brand-text font-weight-light">Social Promo</span>-->
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Trending</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Archive</a>
          </li>		  
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Contact</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
			  <li class="dropdown-divider"></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>

            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM 
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>-->
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
	  
        <li class="nav-item">
          <a style="color:#fff; margin-right:12px;line-height: 20px;" class="nav-link btn btn-danger" href="//suite.social/promo" role="button"><i class="fas fa-credit-card"></i> Sign-up</a>
        </li>
		
        <li class="nav-item">
          <a style="color:#fff;line-height: 20px;" class="nav-link btn btn-success" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
		
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="pt-3"></div>
<!-- Main content -->
<section class="content">
<div class="container-fluid">

<div class="top">
  <div class="jumbotron jumbotron-facebook">
    <div class="container">
      <div class="col-lg-12">
	  <p><i class="fab fa-facebook fa-7x"></i></p>
      <p><h2>Facebook Promotion to run contests, giveaways and sweepstakes to grow fans, referrals and traffic!</b></h2></p>
      <p><a href="#create" class="btn btn-lg btn-default">CREATE NOW</a>&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-lg btn-default">TRY DEMO</a></p>
      </div>
    </div>
  </div>
</div>

<div id="create" class="alert alert-default alert-dismissible">
  <h6>Test out the promotion tool with all features! When your ready to create a live promotion, click the sign-up button!</h6>
</div>

<div class="row">

<div class="col-12 col-sm-12 col-md-6">
<!-- Default box -->
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Promotion: <span id="state">NEW</span></h3>

	</div>
	<div class="card-body">

		<!--================================================== ACCORDIAN ==================================================-->

		<div id="accordion">

			<!---------------------------------------------------- SETTINGS ---------------------------------------------------->
			
			<?php $data = $allPlugins; ?>
			<form action="client_add_func.php" method="post" id="create-client-plugin" enctype="multipart/form-data">				

			<div class="card-custom card card-default">

				<a class="info-box-custom info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
					<span class="info-box-icon bg-default"><i class="fas fa-cogs"></i></span>

					<div class="info-box-content">
						<span class="info-box-text-custom info-box-text">Settings</span>
					</div>
					<span class="badge-custom badge badge-secondary float-right">1</span>					
					<!-- /.info-box-content -->
				</a>
				<!-- /.info-box -->

				<div id="collapse2" class="panel-collapse collapse">
					<div class="card-body">

						<!-------------------- FORM -------------------->

						<div class="form-group">
							<label for="type">Select type</label>
							<h6 class="text-muted"><small>Choose the type of promotion you want </small></h6>
							<select class="form-control" name="type" id="type" required>
								<option value="">----- Please Choose -----</option>
								<option value="points">Points (Unlock Content)</option>
								<option value="entries">Entries (Select Winner)</option>
							</select>
						</div>	

						<div class="form-group">
							<label for="totalpoints">Total Points/Entries</label>
							<h6 class="text-muted"><small>Enter the total number of points/entries user needs to get to claim your offer.</small></h6>
							<input type="number" class="form-control points_input" name="totalpoints" id="totalpoints" aria-describedby="helpIdTotalPoints" value="10" placeholder="Total points">
						</div>	

						<div class="form-group">
							<label for="offersleft">Offers left</label>
							<h6 class="text-muted"><small>Enter the total number of offers you have (e.g. 50 coupons, 10 prizes etc).</small></h6>  
							<input type="number" min="0" max="10" class="form-control offers_input" name="offersleft" id="offersleft" aria-describedby="helpIdOffersLeft" value="1" placeholder="enter offers left">
						</div>							
						
						<div class="form-group">
							<label for="expiry">Expiry</label>
							<h6 class="text-muted"><small>Choose when your promotion expires.</small></h6>          
							<input type="date" class="form-control expiry_date_input" name="expiry" id="expiry" aria-describedby="helpIdExpiry" placeholder="enter expiry">
						</div>							
						
						<div class="form-group">
							<label>Login Type</label>
							 <h6 class="text-muted"><small>Choose how users login.</small></h6>                                                       

								<p>Email Login<br>
								<input type="checkbox" class="login_type_check" name="my-checkbox" data-type="email" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></br><br>
								<input type="email" class="form-control" value="Enter email for login alerts"></p>
								
								<p>SMS Login<br>
								<input type="checkbox" class="login_type_check" name="my-checkbox" data-type="sms" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></br><br>
								<input type="text" class="form-control" value="Enter Twilio API Key"></p>

								<p>WhatsApp Login<br>
								<input type="checkbox" class="login_type_check" name="my-checkbox" data-type="whatsapp" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></br><br>
								<input type="text" class="form-control" value="Enter WhatsApp Number"></p>

								<p>Social Login<br>
								<input type="checkbox" class="login_type_check" name="my-checkbox" data-type="social" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"></br><br>
								<input type="email" class="form-control" value="Enter email for login alerts"></p>
						   
						</div>	

						<h6 class="text-muted"><small>Options</small></h6>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" name="exitpopup" id="exitpopup" value="1">
								Exit popup?
							</label>
						</div>

						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" name="directoryinclusion" id="directoryinclusion" value="1">
								Directory inclusion?
							</label>
						</div>							
						
					</div>
				</div>
			</div>

			<!---------------------------------------------------- BRANDING ---------------------------------------------------->

			<div class="card-custom card card-default">

				<a class="info-box-custom info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
					<span class="info-box-icon bg-default"><i class="fas fa-id-card"></i></span>

					<div class="info-box-content">
						<span class="info-box-text-custom info-box-text">Branding</span>
					</div>
					<span class="badge-custom badge badge-secondary float-right">2</span>
					<!-- /.info-box-content -->
				</a>
				<!-- /.info-box -->

				<div id="collapse3" class="panel-collapse collapse">
					<div class="card-body">

						<!-------------------- FORM -------------------->
						
						<div class="form-group">
							<label for="title">Headline <span class="text-danger">*</span></label>
							 <h6 class="text-muted"><small>What is your promotion called? (E.g. 50% discount on product etc).</small></h6> 
							<input type="text" class="form-control headlineinput" name="title" id="title" aria-describedby="helpIdTitle" placeholder="Enter Headline">
						</div>	

						<div class="form-group">
							<label for="caption">Caption <span class="text-danger">*</span></label>
							 <h6 class="text-muted"><small>What is your promotion about? (140 characters max, used for meta tags).</small></h6> 
							<input type="text" class="form-control captioninput" name="caption" id="caption" maxlength="140" aria-describedby="helpIdCaption" placeholder="Enter Caption">
						</div>						

						<div class="form-group">
							<label for="description">Description</label>
							<h6 class="text-muted"><small>What is your promotion about?</small></h6>
							<textarea class="description_text_input" name="description" id="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>													

						<div class="form-group">
							<label for="promotioncontent">Promotion content</label>
							<h6 class="text-muted"><small>What does users see after they complete all actions? (E.g. coupon, download, media or message etc).</small></h6>
							<textarea class="textarea2" name="promotioncontent" id="promotioncontent" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>	

						<div class="form-group">
							<label for="rules">Terms & Conditions </label>
							<h6 class="text-muted"><small>What are your promotion rules? (E.g. terms, privacy policy etc).</small></h6>
							 <textarea class="rules_text_input" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>							
						
						<div class="form-group">
							<label for="brand_media_type">Banner</label>
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
							<!--<label for="brand_pic_upload">Image</label>
							<input type="file" id="brand_pic_upload" name="brand_pic_upload" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp"><!--<div id="file_name_0"></div>-->
						
							<a class='btn btn-default' href='javascript:;'>
								<i class="fas fa-cloud-upload-alt"></i> Upload Banner
								<!-- <input type="file" style='position:absolute;z-index:2;top:0;left:0;height:38px;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' id="brand_pic_upload" name="brand_pic_upload" class="input-file" accept=".jpg,.jpeg,.png,.gif,.bmp" size="40" onchange='$("#upload-logo").html($(this).val());'> -->
								<input type='file' id="brand_pic_upload" name="brand_pic_upload" class="input-file"  onchange='$("#upload-logo").html($(this).val());'/>
							</a>							
						
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
											<input class="form-control" name="slides[]" onchange="sliderurls(this.value)" type="text" placeholder="Enter slide show URL." />
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

						<!-------------------- / FORM -------------------->

					</div>
				</div>
			</div>

			<!---------------------------------------------------- ACTIONS ---------------------------------------------------->

			<div class="card-custom card card-default">

				<a class="info-box-custom info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
					<span class="info-box-icon bg-default"><i class="fas fa-share-alt"></i></span>

					<div class="info-box-content">
						<span class="info-box-text-custom info-box-text">Actions</span>

					</div>
					<span class="badge-custom badge badge-secondary float-right">3</span>
					<!-- /.info-box-content -->
				</a>
				<!-- /.info-box -->

				<div id="collapse4" class="panel-collapse collapse">
				
					<div class="card-body">

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
									<option value="<?php echo $plugin['filename'];?>"><?php echo $plugin['actionName'];?></option>
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
									   id="plugin-<?php echo $social->getFilename(); ?>"
									   name="plugin-<?php echo $social->getFilename(); ?>"
									   value="<?php echo $social->getType();?>" />
							<?php
							endforeach;
						}
						?>
					</div>

					<div class="d-none" id="gameContainer">
						<?php
						if ($data && count($data)>0) {
						foreach($data as $idx => $plugin):
							if($social->getType() == 'play-then-share') {?>
								<div class="choose--game d-none" style="margin-bottom: 10px; margin-top: 10px;" id="choose_game_<?php echo $social->getFilename();?>">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_<?php echo $social->getFilename();?>">
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
									<h4 class="">Enter Picture</h4>
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
							<input type="text" class="form-control" name="scratchUrl" id="scratchUrl" aria-describedby="helpIdUrl" placeholder="Enter url">
						</div>
					</div>
					<div class="d-none" id="urlContainer">
						<div class="form-group">
							<label for="url">Select URL/Embed code </label>
							<input type="text" class="form-control" name="url" id="url" aria-describedby="helpIdUrl" placeholder="Enter url">
						</div>
						<div class="form-group">
							<label for="embedcode">Embed code</label>
							<textarea class="form-control" name="embedcode" id="embedcode" rows="3"></textarea>
						</div>
					</div>
					<div class="d-none" id="friendContainer">
						<div class="form-group">
							<label for="numFriends">Number of friends</label>
							<input type="text" class="form-control" name="numFriends" id="numFriends" aria-describedby="helpIdFriends" placeholder="Enter number of friends">
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
							<input type="number" class="form-control" name="record_length" id="record_length" aria-describedby="helpIdRecordLength" placeholder="Enter record length">
						</div>
					</div>

					<div class="form-group">
						<label for="numpoint">Number of points</label>
						<input type="text" class="form-control" name="numpoint" id="numpoint" aria-describedby="helpIdNumpoint" placeholder="Enter number of point">
					</div>
					
					<div class="form-group">
						<label for="visitAction">Visit action text</label>
						<input type="text" class="form-control" name="visitAction" id="visitAction" aria-describedby="helpIdVisitAction" placeholder="Enter action name">
					</div>
					
					<div class="form-group">
						<label for="shareAction">Share action text</label>
						<input type="text" class="form-control" name="shareAction" id="shareAction" aria-describedby="helpIdShareAction" placeholder="Enter share button name">
					</div>
					
					<button type="button" class="btn bg-gradient-success" id="add_action_button">Add Action</button>
					
					<hr>
					
                <div class="form-group">
                  <label>Added Actions</label>
                  <div class="select2-danger">
                    <select class="select2" multiple="multiple" data-placeholder="Added Actions" data-dropdown-css-class="select2-danger" style="width: 100%;">
						<option value="record-and-share">Record and Share Facebook</option>
						<option value="refer-and-share">Refer and Share Facebook</option>
						<option value="scratch-and-share">Scratch and Share Facebook</option>
						<option value="select-and-share">Select and Share Facebook</option>
						<option value="share-and-visit">Share and Visit Facebook</option>
						<option value="share-then-submit">Share then Submit Facebook</option>
						<option value="spin-and-share">Spin and Share Facebook</option>
						<option value="submit-then-share">Submit then Share Facebook</option>
						<option value="visit-and-share">Visit and Share Facebook</option>
                    </select>
                  </div>
                </div>		
				
						</div>
					</div>				
						
				</div>

			<!---------------------------------------------------- TOOLS ---------------------------------------------------->

			<div class="card-custom card card-default">

				<a class="info-box-custom info-box" data-toggle="collapse"
				   data-parent="#accordion" href="#collapse5">
					<span class="info-box-icon bg-default"><i class="fas fa-tools"></i></span>

					<div class="info-box-content">
						<span class="info-box-text-custom info-box-text">Tools</span>

					</div>
					<span class="badge-custom badge badge-secondary float-right">4</span>
					<!-- /.info-box-content -->
				</a>
				<!-- /.info-box -->

				<div id="collapse5" class="panel-collapse collapse">
					<div class="card-body">

						<!-------------------- FORM -------------------->




						<!-------------------- / FORM -------------------->

					</div>
				</div>
			</div>

			<div class="btn-group">
				<button type="reset" class="btn bg-gradient-success">Reset Promotion</button>
				<button type="submit" class="btn bg-gradient-danger">Create Promotion</button>
			</div>	
			
			</form>				

		</div><!--/accordion>-->

	</div>
	<!-- /.card-body -->
	
	<div class="card-footer">
	
			<div class="alert alert-success alert-dismissible">
			  <h6>Success! Your promotion is created. Copy link or choose option below.</h6>
			</div>

<div class="input-group input-group mb-3">
			  <!-- /btn-group -->
			  <input type="text" class="form-control">
			  <div class="input-group-prepend">
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				  Options
				</button>
				<ul class="dropdown-menu" style="">
				  <li class="dropdown-item"><a href="#">View Page</a></li>
				  <li class="dropdown-item"><a href="#">Embed Code</a></li>
				  <li class="dropdown-item"><a href="#">QR Code Poster</a></li>
				  <li class="dropdown-item"><a href="#">Send by email</a></li>
				  <li class="dropdown-item"><a href="#">Tab Generator</a></li>
				  <li class="dropdown-item"><a href="#">Popup Generator</a></li>
				</ul>
			  </div>
			</div>

	</div>
	<!-- /.card-footer-->
	
</div><!-- /.card -->
	
</div>

<div class="col-12 col-sm-12 col-md-6">

<div class="login-box">

  <div class="card">
    <div class="card-body login-card-body">
	  
				<div style="margin-top:12px;" class="row">
                  <div class="col-4 col-md-4 text-center">
                    <input type="text" class="knob" id="days_left_input" value="1" data-min="0" data-max="1" data-width="90" 
					     data-height="90" data-fgColor="#dc3545">

                    <div class="knob-label"><b>Days Left</b></div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 col-md-4 text-center">
                    <input type="text" class="knob" id="offers_display_input" value="1" data-min="0" data-max="1" data-width="90" 
					     data-height="90" data-fgColor="#dc3545">

                    <div class="knob-label"><b>Offers Left</b></div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 col-md-4 text-center ">				  
                    <input type="text" class="knob" id="points_display_input" value="100" data-min="1" data-max="100" data-width="90" 
					     data-height="90" data-fgColor="#dc3545">

                    <div class="knob-label"><b><span id="promotion_type_text">Points</span> Left</b></div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
	
	<p id="bannerpreview"><img style="margin-top:12px" id="banner_image" width="100%" src="<?php echo PATH_ROOT ?>/images/banner_facebook.jpg"/>
	</p>
	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"><div class="carousel-inner" id="sliders"></div></div>
	
	  <div class="login-logo headlinebox"><b>Your headline here</b></div>
	  <p class="login-box-msg captionbox">Caption here (140 characters max)</p>
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
<br><p class="login-box-msg descriptionbox">Promotion description goes here. Choose a method to login or register</p>
</div>	

 <!--======================================== LOGIN ========================================--> 	

<!--<a style="margin-top:10px" href="#login" data-toggle="collapse" class="btn btn-default btn-block">LOGIN NOW <i class="fas fa-sign-in-alt"></i> </a>-->

<div id="login" class="collapse">

<br>

<div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Email</a>
                  <a class="nav-link" id="vert-tabs-sms-tab" data-toggle="pill" href="#vert-tabs-sms" role="tab" aria-controls="vert-tabs-sms" aria-selected="true">SMS</a>
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
          <input type="text" class="form-control" placeholder="Full Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
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
		  <input type="text" class="form-control" placeholder="Username">
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

 <!---------------------------------------- SMS LOGIN ---------------------------------------->			  
				  
                  <div class="tab-pane fade" id="vert-tabs-sms" role="tabpanel" aria-labelledby="vert-tabs-sms-tab">


      <p style="text-align:right" class="mb-1">
        <a href="#"><u>Login here</u></a>
      </p>
	  
	  <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>	  
        <div class="input-group mb-3">
          <input type="tel" class="form-control" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fab fa-whatsapp"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
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
		  <input type="text" class="form-control" placeholder="Username">
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
            <button type="submit" class="btn btn-danger btn-block">Verify</button>
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
          <input type="text" class="form-control" placeholder="Full Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>	  
        <div class="input-group mb-3">
          <input type="tel" class="form-control" placeholder="WhatsApp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fab fa-whatsapp"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
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
		  <input type="text" class="form-control" placeholder="Username">
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
				
				  <!---------------------------------------------------- ACTION ---------------------------------------------------->				
				  
				<div class="alert alert-danger alert-dismissible" id="action_result">
                  <h5>1 Ways to Enter</h5>
                </div>		  

				  <!---------------------------------------------------- ACTION ---------------------------------------------------->				
				  				  
                  <div class="card card-default">
				  
					<a class="info-box" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
					  <span id="suite" class="info-box-icon bg-info"><i class="fas fa-award"></i></span>

					  <div class="info-box-content">
						<span class="info-box-text">Bonus: Complete All of the Steps Above</span>
						
					  </div>
					  <span class="badge badge-danger float-right">+5</span>
					  <!-- /.info-box-content -->
					</a>
					<!-- /.info-box -->					
				
                    <div id="collapse9" class="panel-collapse collapse">
                      <div class="card-body">
					  
					<!-------------------- REVEAL -------------------->
				  
					<p>Complete all the steps above for bonus points</p>
			
					<!-------------------- / REVEAL -------------------->					  

                      </div>
                    </div>
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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
                      <img style="margin-right:12px" src="<?php echo PATH_ROOT ?>/images/default-150x150.png" alt="Product Image" class="img-size-50">
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

</div><!-- /.col-12 col-sm-12 col-md-6-->

  </div><!--/.row-->
  
<!--================================================== PROJECTS ==================================================-->

<div class="row">
<div class="col-md-12">

              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#create" data-toggle="tab">Promotions</a></li>
                  <li class="nav-item"><a class="nav-link" href="#users" data-toggle="tab">Users</a></li>
                </ul>
              </div><!-- /.card-header -->
                <div class="tab-content">
                  <div class="active tab-pane" id="create">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Campaigns</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
					<th>Pic</th>
					<th>Name</th>
					<th>Settings</th>
					<th>Days</th>
					<th>Users</th>
					<th>Status</th>
					<th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				<tr>
				   <td><img width="150px" src="<?php echo PATH_ROOT ?>/images/banner.jpg" alt="Pic"></td>
				   <td>Promo Name</td>
				   <td>
				   <b>Type:</b> Points<br>
				   <b>Total Points/Entries:</b> 100<br>
				   <b>Offers:</b> 10<br>
				   <b>Expiry:</b> 14/05/21<br>
				   <b>Actions:</b> 10
				   </td>
				   <td>10</td>
				   <td>100<br>
				   <button type="button" class="btn btn-success btn-sm"><i class="fas fa-users"></i> View Users</button>
				   </td>
				   <td><span style="padding: .25em .4em;font-size: 75%;font-weight: 700;line-height: 1;border-radius: .25rem;" class="badge badge-success">Active</span></td>
				   <td>
					   <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-link"></i> View</a>
					   <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-pencil-alt"></i> Edit</button>
					   <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
				   </td>
			    </tr>
				<tr>
				   <td><img width="150px" src="<?php echo PATH_ROOT ?>/images/banner.jpg" alt="Pic"></td>
				   <td>Promo Name</td>
				   <td>
				   <b>Type:</b> Points<br>
				   <b>Total Points/Entries:</b> 100<br>
				   <b>Offers:</b> 10<br>
				   <b>Expiry:</b> 14/05/21<br>
				   <b>Actions:</b> 10
				   </td>
				   <td>10</td>
				   <td>100<br>
				   <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-users"></i> UPGRADE</button>
				   </td>
				   <td><span style="padding: .25em .4em;font-size: 75%;font-weight: 700;line-height: 1;border-radius: .25rem;" class="badge badge-danger">Expired</span></td>
				   <td>
					   <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-link"></i> View</a>
					   <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-pencil-alt"></i> Edit</button>
					   <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
				   </td>
			    </tr>
                  </tbody>
                  <tfoot>
                  <tr>
					<th>Pic</th>
					<th>Name</th>
					<th>Settings</th>
					<th>Days</th>
					<th>Users</th>
					<th>Status</th>
					<th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
				
                  </div>
                  <!-- /.tab-pane -->
				  
                  <div class="tab-pane" id="users">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Campaigns</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
					<th>Pic</th>
					<th>Name</th>
					<th>Location</th>
					<th>Promotion</th>
					<th>Contact</th>
					<th>Stats</th>
					<th>Days</th>
					<th>Status</th>
					<th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				<tr>
				   <td><img width="100px" src="<?php echo PATH_ROOT ?>/images/default.jpg" alt="Pic"></td>
				   <td>Full Name</td>
				   <td>United Kingdom, London</td>				   
				   <td>Promo Name</td>
				   <td>
				   <b>Login:</b> Email<br>
				   <b>Contact:</b> name@gmail.com<br>
				   </td>				   
				   <td>
				   <b>Type:</b> Points<br>
				   <b>Total:</b> 100<br>
				   <b>Actions:</b> 10
				   </td>
				   <td>10</td>
				   <td><span style="padding: .25em .4em;font-size: 75%;font-weight: 700;line-height: 1;border-radius: .25rem;" class="badge badge-success">Active</span></td>
				   <td>
					   <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
				   </td>
			    </tr>
				<tr>
				   <td><img width="100px" src="<?php echo PATH_ROOT ?>/images/default.jpg" alt="Pic"></td>
				   <td>Full Name</td>
				   <td>United Kingdom, London</td>				   
				   <td>Promo Name</td>
				   <td>
				   <b>Login:</b> Email<br>
				   <b>Contact:</b> name@gmail.com<br>
				   </td>				   
				   <td>
				   <b>Type:</b> Points<br>
				   <b>Total:</b> 50<br>
				   <b>Actions:</b> 5
				   </td>
				   <td>10</td>
				   <td><span style="padding: .25em .4em;font-size: 75%;font-weight: 700;line-height: 1;border-radius: .25rem;" class="badge badge-danger">Banned</span></td>
				   <td>
					   <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i> Delete</a>
				   </td>
			    </tr>
                  </tbody>
                  <tfoot>
                  <tr>
					<th>Pic</th>
					<th>Name</th>
					<th>Location</th>
					<th>Promotion</th>
					<th>Contact</th>
					<th>Stats</th>
					<th>Days</th>
					<th>Status</th>
					<th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
					
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->

            <!-- /.nav-tabs-custom -->
          </div>
		</div>
		<!-- /.row -->

<!--================================================== /PROJECTS ==================================================-->
  
     </div><!--/.container-fluid-->
	 
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
	
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0
        </div>
        <strong>Copyright &copy; 2020 <a href="https://suite.social">Social Suite</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

     <!--------------------------------------------------- GAMES --------------------------------------------------->

<?php
if ($data && count($data)>0) {
foreach($data as $idx => $plugin):
if($social->getType() == 'play-then-share') {
$game = $social->getGame();
?>
<!-- The Modal -->
<div class="modal fade" id="myModal_<?php echo $social->getFilename();?>">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">What game? </h4>
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
<div id="list-container">

</div>

     <!--------------------------------------------------- MODALS --------------------------------------------------->

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
              <p class="rulesbox">Details here</p>
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
	  
     <!--------------------------------------------------- CREATE --------------------------------------------------->
 
      <div class="modal fade" id="create">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sign-up Now!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="text-center modal-body">
					
			<div id="divA">
              <h2>Searching <span id="rotate" class="text-danger"> <span>Facebook</span> <span>Twitter</span> <span>Linkedin</span> <span>Instagram</span> <span>Pinterest</span> </span> for people who might be interested in your promotion...</h2>			  

<center>
<span class="w3-content w3-section" style="max-width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile1.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile2.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile3.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile4.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile5.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile6.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile7.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile8.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile9.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile10.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile11.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile12.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile13.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile14.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile15.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile16.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile17.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile18.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile19.jpg" style="width:150px">
  <img class="mySlides" src="<?php echo PATH_ROOT ?>/images/profile20.jpg" style="width:150px">
</span>
</center>

			</div>
			
			<div id="divB">
			
<h2 style="font-size: 48px; font-weight: 300; margin-top: 0px;margin-bottom: 0px;">
<br>
<script>
function fakecounter(){

//decrease/increase counter value (depending on perceived popularity of your site!)
var decrease_increase=5000

var counterdate=new Date()
var currenthits=counterdate.getTime().toString()
currenthits=parseInt(currenthits.substring(2,currenthits.length-4))+decrease_increase

document.write("Reach <span class='text-danger'>"+currenthits+"</span> potential customers using Social Promotion!")
}
fakecounter()
</script>

</h2>			

			  <br><p><a style="color:#fff;" class="btn bg-gradient-danger btn-lg" href="//suite.social/promo"><i class="fas fa-credit-card"></i> Sign-up now for only £9.99!</a>
			  
			</div>
			           			  			  			  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


<!-- jQuery -->
<script src="<?php echo PATH_ROOT ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo PATH_ROOT ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo PATH_ROOT ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?php echo PATH_ROOT ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_ROOT ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo PATH_ROOT ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo PATH_ROOT ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo PATH_ROOT ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo PATH_ROOT ?>/src/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo PATH_ROOT ?>/src/js/demo.js"></script>
<!-- Text rotate -->
<script  src="<?php echo PATH_ROOT ?>/src/js/rotate.js"></script>
<!-- Summernote -->
<script src="<?php echo PATH_ROOT ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- jQuery Knob -->
<script src="<?php echo PATH_ROOT ?>/plugins/jquery-knob/jquery.knob.min.js"></script>

<script type="text/javascript">

$(window).scroll(function(){
    $(".top").css("opacity", 1 - $(window).scrollTop() / 250);
  });

</script>

<script type="text/javascript">
// SELECT2
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
	
  })
</script>

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
</script>

<!-- page script -->
<script type="text/javascript">

//SWAP DIV

$("#divA").delay(20000).fadeOut(function() {
     $("#divB").fadeIn();
     $(this).remove();
});

//SLIDEHSOW

var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 500); // Change image every 1 seconds
}

// POPUP

function popup(url)
{
var w = 800;
var h = 600;
var title = 'Social';
var left = (screen.width / 2) - (w / 2);
var top = (screen.height / 2) - (h / 2);
window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
document.getElementById("action").style.display = "none";
document.getElementById("action2").style.display = "none";
document.getElementById("action3").style.display = "none";
document.getElementById("action4").style.display = "none";
document.getElementById("action5").style.display = "none";
document.getElementById("action6").style.display = "none";
document.getElementById("action7").style.display = "none";
document.getElementById("action8").style.display = "none";
document.getElementById("action9").style.display = "none";
}
	
</script>

<script>
  $(function () {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $('.sparkline').each(function () {
      var $this = $(this)
      $this.sparkline('html', $this.data())
    })

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines()
    drawMouseSpeedDemo()

  })

  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {
      type    : 'bar',
      barColor: '#aaf'
    })
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
      {
        composite: true,
        fillColor: false,
        lineColor: 'red'
      })


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline()

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
      {
        type  : 'line',
        height: '2.5em',
        width : '4em'
      })

    // Customized line chart
    $('#linecustom').sparkline('html',
      {
        height      : '1.5em',
        width       : '8em',
        lineColor   : '#f00',
        fillColor   : '#ffa',
        minSpotColor: false,
        maxSpotColor: false,
        spotColor   : '#77f',
        spotRadius  : 3
      })

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', { type: 'bar' })

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
      type               : 'bar',
      tooltipFormat      : '{{value:levels}} - {{value}}',
      tooltipValueLookups: {
        levels: $.range_map({
          ':2' : 'Low',
          '3:6': 'Medium',
          '7:' : 'High'
        })
      }
    })

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', { type: 'tristate' })
    $('.sparktristatecols').sparkline('html',
      {
        type    : 'tristate',
        colorMap: {
          '-2': '#fa7',
          '2' : '#44f'
        }
      })

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {
      fillColor     : false,
      changeRangeMin: 0,
      chartRangeMax : 10
    })
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
      {
        composite     : true,
        fillColor     : false,
        lineColor     : 'red',
        changeRangeMin: 0,
        chartRangeMax : 10
      })

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
      {
        fillColor     : false,
        normalRangeMin: -1,
        normalRangeMax: 8
      })
    $('#normalExample').sparkline('html',
      {
        fillColor       : false,
        normalRangeMin  : 80,
        normalRangeMax  : 95,
        normalRangeColor: '#4f4'
      })

    // Discrete charts
    $('.discrete1').sparkline('html',
      {
        type     : 'discrete',
        lineColor: 'blue',
        xwidth   : 18
      })
    $('#discrete2').sparkline('html',
      {
        type          : 'discrete',
        lineColor     : 'blue',
        thresholdColor: 'red',
        thresholdValue: 4
      })

    // Bullet charts
    $('.sparkbullet').sparkline('html', { type: 'bullet' })

    // Pie charts
    $('.sparkpie').sparkline('html', {
      type  : 'pie',
      height: '1.0em'
    })

    // Box plots
    $('.sparkboxplot').sparkline('html', { type: 'box' })
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
      {
        type        : 'box',
        raw         : true,
        showOutliers: true,
        target      : 6
      })

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type                     : 'box',
      tooltipFormatFieldlist   : ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    })

    // click event demo sparkline
    $('.clickdemo').sparkline()
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
      value         = region.y
      alert('Clicked on x=' + region.x + ' y=' + region.y)
    })

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline()
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
      value         = region.y
      $('.mouseoverregion').text('x=' + region.x + ' y=' + region.y)
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('')
    })
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500 // update display every 500ms
    var lastmousex       = -1
    var lastmousey       = -1
    var lastmousetime
    var mousetravel      = 0
    var mpoints          = []
    var mpoints_max      = 30
    $('html').mousemove(function (e) {
      var mousex = e.pageX
      var mousey = e.pageY
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey))
      }
      lastmousex = mousex
      lastmousey = mousey
    })
    var mdraw = function () {
      var md      = new Date()
      var timenow = md.getTime()
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000)
        mpoints.push(pps)
        if (mpoints.length > mpoints_max) {
          mpoints.splice(0, 1)
        }
        mousetravel = 0
        $('#mousespeed').sparkline(mpoints, {
          width        : mpoints.length * 2,
          tooltipSuffix: ' pixels per second'
        })
      }
      lastmousetime = timenow
      setTimeout(mdraw, mrefreshinterval)
    }
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>

<script>
  $(function () {
    // Summernote
    $('.textarea2').summernote()
  })
</script>

<script>
// DATATABLES

  $(function () {
	$("#example1").DataTable({
	  "responsive": true,
	  "autoWidth": false,
	});
	$('#example2').DataTable({
	  "responsive": true,
	  "autoWidth": false,
	});
  });

    $(document).ready(function () {
        //
        // let item;
        // $(document).on('click' , '.add-more' , function (e) {
        //     e.preventDefault();
        //     var container = $(this).closest('.field');
        //     new_field_group = container.children().filter('.item:first-child').clone();
        //     new_field_group.find('input').each(function () {
        //         $(this).val('');
        //     });
        //     new_field_group.find('textarea').each(function () {
        //         $(this).val('');
        //     });
        //     container.append(new_field_group);
        //
        //     $(".editor").on('click', function () {
        //         item = $(this).closest('.item');
        //         let data = $(item).data('item');
        //         if  (data == 'que') {
        //             $("#summernote").summernote('code',item.find('.Qans').val());
        //         }else if  (data == 'keyword') {
        //             $("#summernote").summernote('code',item.find('.Kans').val());
        //         }
        //     });
        //
        //     $(".rss").on('click', function(){
        //         item = $(this).closest('.item');
        //         let data = $(item).data('item');
        //         if  (data == 'que') {
        //             $("#rssUrl").val(item.find('.Qans').val().replace('RSS:', ''));
        //         }else if  (data == 'keyword') {
        //             $("#rssUrl").val(item.find('.Kans').val().replace('RSS:', ''));
        //         }
        //     });
        // });
        // $(document).on('click' , '.remove' , function (e) {
        //     e.preventDefault();
        //     $(this).closest('.item').remove();
        // });
        //
        // $(".editor").on('click', function () {
        //     item = $(this).closest('.item');
        //     let data = $(item).data('item');
        //     if  (data == 'que') {
        //         $("#summernote").summernote('code',item.find('.Qans').val());
        //     }else if  (data == 'keyword') {
        //         $("#summernote").summernote('code',item.find('.Kans').val());
        //     }
        // });
        //
        // $("#saveEditor").on('click', function () {
        //     let val = $(".note-editable").html();
        //     let data = $(item).data('item');
        //     if  (data == 'que') {
        //         $(item).find('.Qans').val(val);
        //     }else if  (data == 'keyword') {
        //         $(item).find('.Kans').val(val);
        //     }
        //     $("#summernote").summernote('destroy');
        // });
        //
        // $(".rss").on('click', function(){
        //     item = $(this).closest('.item');
        //     let data = $(item).data('item');
        //     if  (data == 'que') {
        //         $("#rssUrl").val(item.find('.Qans').val().replace('RSS:', ''));
        //     }else if  (data == 'keyword') {
        //         $("#rssUrl").val(item.find('.Kans').val().replace('RSS:', ''));
        //     }
        // });
        //
        // $("#saveRss").on('click', function () {
        //     let val = $("#rssUrl").val();
        //     let data = $(item).data('item');
        //     if  (data == 'que') {
        //         $(item).find('.Qans').val('RSS:'+val);
        //     }else if  (data == 'keyword') {
        //         $(item).find('.Kans').val('RSS:'+val);
        //     }
        //     $("#rssUrl").val('');
        // });
    });
</script>

<script>

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
	
</script>

<script>
    // Settings Form Scripts
    $('#type').change(function () {
        var selected_type = $(this).val();
        if (selected_type == 'points') {
            $('#promotion_type_text').text('Points');
        } else if (selected_type == 'entries') {
            $('#promotion_type_text').text('Entries');
        }
    });
    $('.points_input').keyup(function (event) {
        newText = event.target.value;
        var points_element = $('#points_display_input');
        points_element.val(newText);
        points_element.attr("data-max", newText);
        points_element.attr("data-width", newText);
        points_element.attr("data-height", newText);
    });
    $('.offers_input').keyup(function (event) {
        newText = event.target.value;
        var points_element = $('#offers_display_input');
        points_element.val(newText);
        points_element.attr("data-max", newText);
        points_element.attr("data-width", newText);
        points_element.attr("data-height", newText);


    });
    $('.expiry_date_input').change(function (event) {
        var end_date = new Date(event.target.value);
        var today = new Date();
        var points_element = $('#days_left_input');
        var days_left = calculate_days_difference(today, end_date);
        points_element.val(days_left);
        points_element.attr("data-max", days_left);
        points_element.attr("data-width", days_left);
        points_element.attr("data-height", days_left);
    });


    $('.login_type_check').on('switchChange.bootstrapSwitch', function (event, state) {
        var type = $(this).data('type');
        if ($(this).is(':checked')) {
            switch (type) {
                case'email': {
                    $('#vert-tabs-home-tab').show();
                    break;
                }
                case 'sms': {
                    $('#vert-tabs-sms-tab').show();
                    break;
                }
                case 'whatsapp': {
                    $('#vert-tabs-profile-tab').show();
                    break;
                }
                case 'social': {
                    $('#vert-tabs-messages-tab').show();
                    break;
                }
            }
        } else {
            switch (type) {
                case'email': {
                    $('#vert-tabs-home-tab').hide();
                    break;
                }
                case 'sms': {
                    $('#vert-tabs-sms-tab').hide();
                    break;
                }
                case 'whatsapp': {
                    $('#vert-tabs-profile-tab').hide();
                    break;
                }
                case 'social': {
                    $('#vert-tabs-messages-tab').hide();
                    break;
                }
            }
        }
    });

    function calculate_days_difference(startDate, endDate) {
        oneDay = 24 * 60 * 60 * 1000;
        return Math.ceil((endDate.getTime() - startDate.getTime()) / oneDay);
    }

    // Branding Form Scripts
    $(function () {
        $('.headlineinput').keyup(function (event) {
            newText = event.target.value;
            $('.headlinebox').text(newText);
        });
        $('.captioninput').keyup(function (event) {
            newText = event.target.value;
            $('.captionbox').text(newText);
        });		
        $('.description_text_input').summernote({
            callbacks: {
                onKeyup: function (e) {
                    setTimeout(function () {
                        $(".descriptionbox").html($('.description_text_input').val());
                    }, 200);
                }
            }
        });

        $('#brand_pic_url').change(function (event) {
            newText = event.target.value;
            $('#bannerpreview').html('<img style="margin-top:12px" id="banner_image" width="100%" src="<?php echo PATH_ROOT ?>/images/banner.jpg"/>');
            $('#banner_image').attr('src',newText);
        });	

        $('#brand_video_url').change(function (event) {
            newText = event.target.value;
            var videoObj = parseVideo(newText);
            // console.log(videoObj);return false;	
		   if (videoObj.type =="youtube")
		    { 
		           var videoId = convert_youtube(newText);
		    }
		   else if (videoObj.type =="vimeo")
		    {
		            var videoId = convert_vimeo(newText);
		    }
		    else
		    {
		           var videoId = newText;
		    }
		    // console.log('===='+videoId);
            // $('#bannerpreview').html('<video width="630" controls autoplay><source src="'+newText+'" id="video_here">Your browser does not support HTML5 video.</video>');
            // $('#bannerpreview').html('<iframe src="'+newText+'" frameborder="0" allowfullscreen class="video"></iframe>');
            $('#bannerpreview').html('<div class="video-container">'+videoId+'</div>');
        });		

        $('.rules_text_input').summernote({
            callbacks: {
                onKeyup: function (e) {
                    setTimeout(function () {
                        $(".rulesbox").html($('.rules_text_input').val());
                    }, 200);
                }
            }
        });
    })

    $("#upload_banner_button").change(function() {
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#banner_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    function readURL(input) {
    	$('#bannerpreview').html('<img style="margin-top:12px" id="banner_image" width="100%" src="<?php echo PATH_ROOT ?>/images/banner.jpg"/>');
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('#banner_image').attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}

	$("#brand_pic_upload").change(function() {
	  readURL(this);
	});

	function convert_youtube(input) {
	  var pattern = /(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(\S+)/g;
	  if (pattern.test(input)) {
	    var replacement = '<iframe width="630" height="445" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>';
	    var input = input.replace(pattern, replacement);
	    // For start time, turn get param & into ?
	    var input = input.replace('&amp;t=', '?t=');
	  }
	  return input;
	}

	function convert_vimeo(input) {
	  var pattern = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/?(\S+)/g;
	  if (pattern.test(input)) {
	   var replacement = '<iframe width="630" height="445" src="//player.vimeo.com/video/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	   var input = input.replace(pattern, replacement);
	  }
	  return input;
	}

	function parseVideo (url) {
	    url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

	    if (RegExp.$3.indexOf('youtu') > -1) {
	        var type = 'youtube';
	    } else if (RegExp.$3.indexOf('vimeo') > -1) {
	        var type = 'vimeo';
	    }

	    return {
	        type: type,
	        id: RegExp.$6
	    };
	}

	function sliderurls(url){
		$("#bannerpreview").html("");
		var numItems = $('.carousel-item').length;
		console.log(numItems);
		if(numItems==0)
		{
			$('#sliders').append('<div class="carousel-item active"><img class="d-block w-100" src="'+url+'" alt="First slide"></div>');
		}else{
			$('#sliders').append('<div class="carousel-item"><img class="d-block w-100" src="'+url+'" alt="First slide"></div>');
		}
	}

	$('.carousel').carousel();

</script>

</body>
</html>
