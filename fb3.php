<?php
session_start(); //Session should be active

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

//try to get current user session
try {
  $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
    die(" Error : " . $ex->getMessage());
} catch(\Exception $ex) {
    die(" Error : " . $ex->getMessage());
}

if ($session){ //if we have the FB session
    $user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
    //do stuff below, save user info to database etc.
   
    echo '<pre>';
    print_r($user_profile); //Or just print all user details
    echo '</pre>';
   
}