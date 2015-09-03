<?php
include "includes/app.php";

require_once __DIR__ . '/fb/autoload.php';

$fb = new Facebook\Facebook([
	'app_id' => '781444138632186',
	'app_secret' => '81c3207bf1cf29b3a2547976b0b94c25',
	'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();
//$permissions = ['email'];
$loginUrl = $helper->getLoginUrl(HOST.'fb.php',array('scope' => 'email'));

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';