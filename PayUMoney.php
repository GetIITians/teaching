<?php
include "includes/app.php";

if (!isset($_SESSION)) {
	session_start();
}

// Merchant Salt as provided by Payu
$SALT = "ZWOM220C";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

/*
var_dump($_SESSION);
echo "<pre>";print_r($_SESSION['studentBookSlot']);echo "</pre>";
die();
*/

$posted = array();
if(isset($_SESSION['studentBookSlot'])) {
	foreach($_SESSION['studentBookSlot'] as $key => $value) {    
		$posted[$key] = $value;
	}
	unset($_SESSION['studentBookSlot']);
}

$posted['txnid']	=	substr(hash('sha256', mt_rand().microtime()), 0, 20);
$posted['key']		=	"PjAwkA";

$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
//$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
$hashVarsSeq = explode('|', $hashSequence);
$hash_string = '';	
foreach($hashVarsSeq as $hash_var) {
	$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
	$hash_string .= '|';
}

$hash_string .= $SALT;
//var_dump($hash_string);

$hash = strtolower(hash('sha512', $hash_string));
$action = $PAYU_BASE_URL . '/_payment';

?>
<html>
	<head>
		<script>
			function submitPayuForm() {
				var payuForm = document.forms.payuForm;
				payuForm.submit();
			}
		</script>
	</head>
	<body onload="submitPayuForm()">
		<form action="<?php echo $action; ?>" method="post" name="payuForm">
			<input type="hidden" name="key" value="<?php echo $posted['key'] ?>" />
			<input type="hidden" name="hash" value="<?php echo $hash ?>" />
			<input type="hidden" name="txnid" value="<?php echo $posted['txnid'] ?>" />
			<input type="hidden" name="amount" value="<?php echo $posted['amount'] ?>" />
			<input type="hidden" name="firstname" value="<?php echo $posted['firstname'] ?>" />
			<input type="hidden" name="email" value="<?php echo $posted['email']; ?>" />
			<input type="hidden" name="phone" value="<?php echo $posted['phone']; ?>" />
			<input type="hidden" name="productinfo" value="<?php echo $posted['productinfo']; ?>" />
			<input type="hidden" name="surl" value="<?php echo HOST.'PayUsuccess.php'; ?>" />
			<input type="hidden" name="furl" value="<?php echo HOST.'PayUfailure.php'; ?>" />
			<input type="hidden" name="service_provider" value="payu_paisa" />
		</form>
	</body>
</html>