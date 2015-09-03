<?php
include "includes/app.php";

require_once __DIR__ . '/fb/autoload.php';

$fb = new Facebook\Facebook([
	'app_id' => '781444138632186',
	'app_secret' => '81c3207bf1cf29b3a2547976b0b94c25',
	'default_graph_version' => 'v2.2',
]);


$helper = $fb->getRedirectLoginHelper();

try {
	$accessToken = $helper->getAccessToken();
	var_dump($accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (isset($accessToken)) {
	// Logged in!
	$_SESSION['facebook_access_token'] = (string) $accessToken;

	// Now you can redirect to another page and use the
	// access token from $_SESSION['facebook_access_token']
	//var_dump($_SESSION['facebook_access_token']);

	$fb->setDefaultAccessToken($accessToken);
	$response = $fb->get('/me');
	$userNode = $response->getGraphUser();
	var_dump($userNode);
	var_dump($userNode->getProperty('email'));
	//echo $userNode->getName() . "<br>" . $userNode->getId() . "<br>";
	echo "<pre>";print_r($response->getDecodedBody());echo "</pre>";
}