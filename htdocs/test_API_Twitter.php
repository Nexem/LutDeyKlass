<?php
ini_set('display_errors', 1);
require_once('Twitter/TwitterAPIExchange.php');

$settings = array(
'oauth_access_token' => "1242442504781402113-94dUYKEA2TeuAjxzotOHEt3ticC8L3",
'oauth_access_token_secret' => "XtLGu6bjZ2R7OHWE6dAKlIXtJXnmEVp5JXvJkVoDRO1N2",
'consumer_key' => "QzklDtYUDciKDSVV503LYl6CY",
'consumer_secret' => "C9lhvUlgLyBFO3k3Lvb8mOJxFpN5nyNKjeyh6jvAsgAHX2K4tN"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
 
$requestMethod = "GET";
 
$getfield = '?screen_name=LetmeknowFr&count=1';
 
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
foreach($string as $items) {
$followers = $items['user']['followers_count'];
$friends = $items['user']['friends_count'];
$tweets = $items['user']['statuses_count'];
}
?>