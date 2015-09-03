<?php
include "includes/app.php";

require_once __DIR__ . '/Facebook/autoload.php';

$fb = new Facebook\Facebook([
	'app_id' => Facebook_app_id,
	'app_secret' => Facebook_app_secret,
	'default_graph_version' => 'v2.2',
]);


$helper = $fb->getRedirectLoginHelper();

try {
	$accessToken = $helper->getAccessToken();
	//var_dump($accessToken);

	// OAuth 2.0 client handler
	//$oAuth2Client = $fb->getOAuth2Client();

	// Exchanges a short-lived access token for a long-lived one
	//$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
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

	try {
		$response = $fb->get('/me?fields=id,name,email',$accessToken);
		$userNode = $response->getGraphUser();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	//var_dump($userNode);
	//var_dump($userNode->getProperty('email'));
	//echo $userNode->getName() . "<br>" . $userNode->getId() . "<br>";
	User::fglogin(array(
		"type" => "fblogin",
		"fblogin" => $userNode->getProperty('id'),
		"name" => $userNode->getProperty('name'),
		"email" => $userNode->getProperty('email')
		)
	);
	Fun::redirect(BASE."profile");
	//echo "<pre>";print_r($userNode->getProperty('email'));echo "</pre>";
} else {
	$permissions = ['email'];
	$loginUrl = $helper->getLoginUrl(HOST.'fb2.php', $permissions);
	Fun::redirect($loginUrl);
	//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}