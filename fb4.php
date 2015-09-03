<?php
session_start(); //Session should be active

include "includes/app.php";

$app_id             = '781444138632186';  //Facebook App ID
$app_secret         = '81c3207bf1cf29b3a2547976b0b94c25'; //Facebook App Secret
$required_scope     = 'public_profile, name, email'; //Permissions required
$redirect_url       = HOST.'fb3.php'; //FB redirects to this page with a code

//include autoload.php from SDK folder, just point to the file like this:
require_once __DIR__ . "/fb/autoload.php";

//import required class to the current scope
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

FacebookSession::setDefaultApplication($app_id , $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);

//display login url
$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
echo '<a href="'.$login_url.'">Login with Facebook</a>';