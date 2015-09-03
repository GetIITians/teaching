<?php
include "includes/app.php";

include ( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/FacebookHttpable.php' );
require_once( 'Facebook/FacebookCurl.php' );
require_once( 'Facebook/FacebookCurlHttpClient.php' );

 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
 
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('781444138632186' ,'81c3207bf1cf29b3a2547976b0b94c25');
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( HOST.'fb2.php' );
//echo HOST.'fb2.php';
 
try {
	$session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
	// When Facebook returns an error
} catch( Exception $ex ) {
	// When validation fails or other local issues
}
 
if ( isset( $session ) ) {
	$request = new FacebookRequest( $session, 'GET', '/me' );
	$response = $request->execute();
	// get response
	$graphObject = $response->getGraphObject();
	 
	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
	$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	$fbemail = $graphObject->getProperty('email');

	var_dump($graphObject->getProperty('email'));
	die();

	User::fglogin(array("type" => "fblogin", "fblogin" => $fbid, "name" => $fbfullname, "email" => $fbemail));
	Fun::redirect(BASE."profile");
} else {
	$loginurl = $helper->getLoginUrl(array('scope' => 'email'));
	Fun::redirect($loginurl);
}

closedb();
?>