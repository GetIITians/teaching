<?php
class ScheduleClass
{
	public $secheduledata;
	
	function ScheduleClass($secretAcessKey,$access_key,$webServiceUrl,$add_details=array())
	{
		$outp=array("ec"=>-1);
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "create";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization’s teacher account. ’ For more information visit at: (http://developer.wiziq.com/faqs)
		$requestParameters=Fun::mergeifunset($requestParameters,$add_details);

		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&')); 
		}
		catch(Exception $e)
		{	
	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
//				echo $e->getMessage();
			}
		$status=$objDOM->getElementsByTagName("rsp")->item(0);
    	$attribNode = $status->getAttribute("status");
		if($attribNode=="ok")
		{
			$methodTag=$objDOM->getElementsByTagName("method");
			$outp["ec"]=1;
			$class_idTag=$objDOM->getElementsByTagName("class_id");
			$outp["cid"]=$class_idTag->item(0)->nodeValue;
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			$outp["rurl"]=$recording_urlTag->item(0)->nodeValue;
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			$outp["curl"]=$presenter_urlTag->item(0)->nodeValue;
			if(false){
				echo "method=".$method=$methodTag->item(0)->nodeValue;
				$class_idTag=$objDOM->getElementsByTagName("class_id");
				echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
				$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
				echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
				$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
				echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
				$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
				echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;
			}
		}
		else if($attribNode=="fail")
		{
			$error=$objDOM->getElementsByTagName("error")->item(0);
			$outp["ec"]=-1;
			$outp["msg"]=$error->getAttribute("msg");
			if(false){
	   			echo "<br>errorcode=".$errorcode = $error->getAttribute("code");
	   			echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
			}
		}
	 }//end if	
	 $this->secheduledata=$outp;
   }//end function
	
}

class getTeacher
{
	function getTeacher($secretAcessKey,$access_key,$webServiceUrl,$add_details=array())
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "get_teacher_details";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
		//This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
		//this presenter email to your organization’s teacher account. ’ For more information visit at: (http://developer.wiziq.com/faqs)
		$requestParameters=Fun::mergeifunset($requestParameters,$add_details);

		$httpRequest=new HttpRequest();
		try
		{
			$post_url = $webServiceUrl.'?method='.$method;
			$param = http_build_query($requestParameters, '', '&');
			echo $post_url."<br>".$param;
			$XMLReturn=$httpRequest->wiziq_do_post_request( $post_url, $param ); 
		}
		catch(Exception $e)
		{	
//	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
//			  echo $e->getMessage();
			}
		$status=$objDOM->getElementsByTagName("rsp")->item(0);
    	$attribNode = $status->getAttribute("status");
    	print_r($XMLReturn);

    	}
    }
}

class AddTeacher
{


	function AddTeacher($secretAcessKey,$access_key,$webServiceUrl,$add_details=array())
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "add_teacher";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization’s teacher account. ’ For more information visit at: (http://developer.wiziq.com/faqs)
		$requestParameters=Fun::mergeifunset($requestParameters,$add_details);

		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method='.$method,http_build_query($requestParameters, '', '&')); 
		}
		catch(Exception $e)
		{	
//	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
//			  echo $e->getMessage();
			}
		$status=$objDOM->getElementsByTagName("rsp")->item(0);
    	$attribNode = $status->getAttribute("status");
    	print_r($XMLReturn);
    	if(true){
			if($attribNode=="ok" )
			{
				$methodTag=$objDOM->getElementsByTagName("method");
				if(true){
					echo "method=".$method=$methodTag->item(0)->nodeValue;
					$class_idTag=$objDOM->getElementsByTagName("class_id");
					echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
					$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
					echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
					$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
					echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
					$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
					echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;
				}
			}
			else if($attribNode=="fail")
			{
				$error=$objDOM->getElementsByTagName("error")->item(0);
				if(true){
		    		echo "<br>errorcode=".$errorcode = $error->getAttribute("code");
		   			echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
		   		}
			}
		}
	 }//end if	
   }//end function
	
}

?>