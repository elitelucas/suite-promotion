<?php
require_once( 'config.php' );
require_once( 'TwitterAPIExchange.php' );

$settings = array(
	'oauth_access_token' => TWITTER_ACCESS_TOKEN,
	'oauth_access_token_secret' => TWITTER_ACCESS_TOKEN_SECRET,
	'consumer_key' => TWITTER_CONSUMER_KEY,
	'consumer_secret' => TWITTER_CONSUMER_SECRET
);

$url = 'https://api.twitter.com/1.1/users/show.json';

$requestMethod = 'GET';

$getfield = "?screen_name=".$_POST['username']."&count=1";

$twitter = new TwitterAPIExchange( $settings );
$twitter->setGetfield( $getfield );
$twitter->buildOauth( $url, $requestMethod );
$response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );
$tweets = json_decode($response, TRUE);
//echo '<pre>';
//print_r( $tweets['profile_image_url_https']);
if (isset($tweets['profile_image_url_https'])){
	echo  '<img src="' . $tweets['profile_image_url_https'] . '" height="150px">';
} else {
	echo "User Not Found";
}
?>
