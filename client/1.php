<?php
$url = $_GET['v'];
?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
	    <title>Social Suite</title>
        <meta charset="UTF-8">
		<meta http-equiv="refresh" content="0;URL=<?=$url?>">
        <script type="text/javascript">
            window.top.location.href = "<?=$url?>"
        </script>
		<base target="_top">
    </head>
    <body onload="top.document.location='<?=$url?>';">
        <!-- Note: don't tell people to `click` the link, just tell them that it is a link. -->
        If you are not redirected automatically, follow the <a href='<?=$url?>' target="_top">link</a>
    </body>
</html>