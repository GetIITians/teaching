<?php
include "includes/app.php";

if(server!='server'){
	sleep(1);
}
echo json_encode(handle_request($_POST));

closedb();

?>