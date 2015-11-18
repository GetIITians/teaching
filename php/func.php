<?php
	function div($a, $b) {
	/*
	Divides $a by $b and returns the quotient
	Arguments: $a,$b integer 

	*/
		return ($a-($a%$b))/$b;
	}

	function jshref($url="") {
	/*
	Used to redirect using javascript
	Arguments: $url: path to redirect

	*/    
		return "window.location.href = '$url'";
	}

	function sessm($key, $val) {
	/*
	To check whether the session key is set and its corresponding value is correct 
	Arguments: $key:To select required key
						 $val:Value corresponding to given key 
	*/    
		return (isset($_SESSION[$key]) && $_SESSION[$key]==$val);
	}

	function init_db() {
	/*
	To initialise database i.e to make connection to database
	*/    
		global $DB,$db_data;
		if($DB==null){
			$DB = new mysqli( $db_data['host'] , $db_data['user'] , $db_data['pass'] , $db_data['db']);
			Sql::init($DB);
		}
	}

	function closedb() {
	/*
	To close the database
	*/    
		global $DB;
		if($DB!=null)
			$DB->close();
	}

	function getval($key,$arr,$default=null){
		 return ( ($arr!==null && isset($arr[$key])) ? $arr[$key] : $default );
	}

	function post($key, $default=null) {
	/*
	Same as getval with array variable=$_POST 
	*/    
		return getval($key,$_POST,$default);
	}

	function isget($key) {
	/*
	Checks whether the given key is set in $_GET array
	*/    
		return isset($_GET[$key]);
	}

	function ispost($key) {
	/*
	Checks whether the given key is set in $_POST array
	*/    
		return isset($_POST[$key]);
	}

	function isses($key) {
	/*
	Checks whether the given key is set in $_SESSION array 
	*/    
		return isset($_SESSION[$key]);
	}

	function get($key, $default = null) {
	/*Same as getval with array variable=$_POST 
	*/
		return getval($key, $_GET, $default);
	}

	function sets($key, $val) {
	/*To set value of given key in $_SESSION array variable 
	*/    
		$_SESSION[$key] = $val;
	}

	function gets($key, $default = null) {
	/*Same as getval with array variable=$_SESSION 
	*/    
		return getval($key,$_SESSION,$default);
	}

	function load_view($view, $inp = array()) { 
	/*Used to load/include required file in the given page.
		Arguments: $view: Name of the page to be loaded.
							 $inp:  Variables to be passed to that page
	*/    

		global $view_default,$_ginfo;
		if(isset($view_default[$view]))
			$inp=Fun::mergeifunset($inp,$view_default[$view]);
		$inp=Fun::setifunset($inp,"page", getNameFromUrl(Fun::getcururl()));
		$inp=Fun::setifunset($inp,"islogin",User::loginType());
		$tem_name=Fun::getloadviewname($view);
		$templates=new Templates();
		if(method_exists($templates,$tem_name )){
			$templates->$tem_name($inp);
			return true;
		}
		else{
			$view="application/views/".$view;
			if(file_exists($view)){
				foreach($inp as $key=>$val){
					$$key=$val;
				}
				include $view;
				return true;
			}
			else{
				echo "MM Error : Unable to load view ".$view." Line ".__LINE__." in file ".__FILE__ ;
				return false;
			}
		}
	}


	function str2json($inp) { 
	/* Takes a JSON encoded string and converts it into Php array variable
	*/
		$temp = json_decode($inp); 
		if($temp)
			return (array)$temp;
		else
			return null;
	}

	function arr2option($arr, $type = 'intval') {
	/* 
	*/    
		$outp = array();
		for($i=0;$i<count($arr);$i++){
			$temp = array('disptext'=>$arr[$i],'val'=>( $type=='intval' ? $i+1 : $arr[$i] ));
			$outp[] = $temp;
		}
		return $outp;
	}

	function lastelm($arr) {
	/* Returns the last element of array
		 Arguments: $arr: Array
	*/  
		if(count($arr)==0)
			return null;
		else
			return $arr[count($arr)-1];
	}

	function firstelm($arr) {
	/* Returns the first element of array
		 Arguments: $arr: Array
	*/     
		if(count($arr)==0)
			return null;
		else
			return $arr[0];
	}

	function curfilename() {
	/* Returns the name of currently running file
	*/ 
		return firstelm(explode(".",lastelm(explode("/",$_SERVER['SCRIPT_FILENAME']))));
	}


	function isUserLoggedInAs($loginTypeArray) {
	//Function Added By Tej Pal Sharma  The function takes an argument array of string of login types like array('s','t','a') and returns 1 if user of any of these types is currently logged in otherwise it returns 0.CAUSTION: FUNCTION USED IN DATABASE QUERY, SO KEEP THAT IN MIND WHILE EDITING.
		$userLoginType = User::loginType();
		if(in_array($userLoginType, $loginTypeArray))
			return 1;
		else
			return 0;
	}

	function isvalid_action($post_data) {
		global $_ginfo;
		if(isset($_ginfo["action_constrain"][$post_data["action"]])){
			$sarr=$_ginfo["action_constrain"][$post_data["action"]];
			$sarr=Fun::mergeifunset($sarr,array("users"=>"","need"=>array()));
			if(!(($sarr["users"]=="all" && User::islogin()) || $sarr["users"]=="" || ($sarr["users"] != "all" && in_array(User::loginType(), $sarr["users"])) ))
				return -2;
			if(!Fun::isAllSet($sarr["need"], $post_data))
				return -9;
		}
		return true;
	}

	function islset($data, $arr) {
		for($i = 0;$i<count($arr);$i++){
			if(!isset($data[$arr[$i]]))
				return false;
			$data = $data[$arr[$i]];
		}
		return true;
	}

	function getmyneed($fname) {
	/*Returns the need field from the $_ginfo["action_constraint"]["fname"]
		Arguments: $fname: Field name  
	*/    
		global $_ginfo;
		return $_ginfo["action_constrain"][$fname]["need"];
	}

	function handle_request($post_data) { 
		global $_ginfo;
		$b=new Actions();
		if(User::isloginas('s'))
			$a=new Students();
		else if(User::isloginas('a'))
			$a=new Admin();
		else if(User::isloginas('t'))
			$a=new Teachers();
		else
			$a=$b;
		$outp=array("ec"=>-7);
		if(isset($post_data["action"])  ){
			$isvalid=isvalid_action($post_data);
			if(!($isvalid>0))
				$outp["ec"]=$isvalid;
			else{
				$func=$post_data["action"];
				if( method_exists($a,$post_data["action"]))
					$outp=$a->$func($post_data);
				else if( method_exists($b,$post_data["action"]))
					$outp=$b->$func($post_data);
				else if(islset($_ginfo,array("autoinsert",$post_data["action"]))) {
					$action_spec=$_ginfo["autoinsert"][$post_data["action"]];
					$action_spec=Fun::mergeifunset($action_spec,array("fixed"=>array(),"add"=>array()));
					$ins_data=Fun::getflds(getmyneed($post_data["action"]) , $post_data );
					$ins_data=Fun::mergeifunset($ins_data,$action_spec["add"]);
					$fixvalues=array("time"=>time(),"uid"=>User::loginId());
					foreach($action_spec["fixed"] as $i=>$val){
						$ins_data[$val]=$fixvalues[$val];
					}
					$outp["data"]=Sqle::insertVal($action_spec["table"],$ins_data);
					$outp["ec"]=1;
				}
			}
		}
		return $outp;
	}

	function rquery($str, $data) {
		preg_match_all("|{[^}]+}|U",$str,$matches);
		$matches=$matches[0];
		for($i=0;$i<count($matches);$i++){
			$key=substr($matches[$i],1,strlen($matches[$i])-2);
			if(isset($data[$key])){
				$str=str_replace($matches[$i],$data[$key],$str);
			}
		}
		return $str;
	}

	function timeondate($day, $month, $year){
	/*Returns Unix time stamp corresponding to given date
	 Arguments: $day,$month,$year 
	*/  
		return strtotime($day."-".$month."-".$year);
	}

	function setift(&$var, $val, $istrue=true){
	/*Set the variable's value if $istrue is true
	 Arguments: $var: variable that is to be set
							$val: value to be assigned to variable
							$istrue: flag to set value 
	*/  
		if($istrue){
			$var = $val;
		}
	}
	function getifn($inp, $alt=null) {
		return rit($inp, $inp!=null, $alt);
	}

	function setifnn(&$var, $val) {
		/*
			set value, is already null
		*/
		setift($var, $val, $var==null);
	}

	function mergeifunset(&$a, $b) {
	/*If the required key values are not set in $a,then it set the corresponding key values from $b
	*/
		$keys = array_keys($b);
		for($i = 0;$i<count($keys);$i++){
			if(!isset($a[$keys[$i]]))
				$a[$keys[$i]] = $b[$keys[$i]];
		}
		return $a;
	}

	function myexplode($n, $st) {
		$temp = explode($n,$st);
		return (count($temp)==1 && $temp[0]=="") ? array() : $temp;
	}

	function intexplode($ex, $inp) {
		$temp = myexplode($ex,$inp);
		foreach($temp as $i=>$val){
			$temp[$i] = 0+$val;
		}
		return $temp;
	}
	function intexplode_t2($inp, $limit=-1, $ex='-'){
		$temp=myexplode($ex,$inp);
		$outp=array();
		foreach($temp as $i=>$val){
			$val=0+$val;
			if(1<=$val &&  ($limit==-1 || $val<=$limit) )
				$outp[]=$val;
		}
		return $outp;
	}

	function daystarttime($ts=null) {
	/*Returns today's start time unix timestamp  
	*/    
		setifnn($ts,time());
		return strtotime(Fun::timetodate($ts));
	}

	function resizeimg($filename, $tosave, $max_width, $max_height) {
		/*Resizes the image according to required height and width
		 Arguments: $filename: name of file
								$tosave: path to save the file
								$max_width: width of dream image
								$max_height: height of dream image
		*/
		$imginfo = getimagesize($filename);
		list($orig_width, $orig_height) = $imginfo;
		$type = $imginfo[2];


		$crop_width = $orig_width;
		$crop_height = $orig_height;
		if($orig_width*$max_height <= $orig_height*$max_width){
			$crop_height = $orig_width*$max_height/$max_width;
		}
		else{
			$crop_width = $orig_height*$max_width/$max_height;
		}

		$image_p = imagecreatetruecolor($max_width, $max_height);
		switch($type){
			case "1": 
				$image = imagecreatefromgif($filename); 
				$transparent = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
				imagefill($image_p, 0, 0, $transparent);
				imagealphablending($image_p, true);         
				break;
			case "2": $image = imagecreatefromjpeg($filename);break;
			case "3": 
				$image = imagecreatefrompng($filename);
				imagealphablending($image_p, false);
				imagesavealpha($image_p, true);
				break;
			default:  $image = imagecreatefromjpeg($filename);
		}
		imagecopyresampled($image_p, $image, 0, 0, ($orig_width-$crop_width)/2, ($orig_height-$crop_height)/2, $max_width, $max_height, $crop_width, $crop_height);

		$ext=pathinfo($tosave, PATHINFO_EXTENSION);

		switch($ext){
			case "gif": imagegif($image_p,$tosave); break;
			case "jpg": imagejpeg($image_p,$tosave,100); break;
			case "jpeg": imagejpeg($image_p,$tosave,100); break;
			case "png": imagepng($image_p,$tosave,0);break;
			default: imagejpeg($image_p,$tosave,100);
		}
		chmod($tosave,0777);
	}
	
	function getrefarr(&$inp) {
	/*Returns the referenced array
	 Arguments: $inp: Input data array(passed by reference)
	*/    
		$outp=array();
		foreach($inp as $i=>$val){
			$outp[] = &$inp[$i];
		}
		return $outp;
	}

	function gtable($name) {//don't use it now. need to be deleted. it is here just because some people have used it.
	/*Used to select required query from $_ginfo["query"]
	 Arguments: $name: field name
	*/     
		global $_ginfo;
		return $_ginfo["query"][$name];
	}

	function qtable($name, $alias=true) {
		global $_ginfo;
		return ($alias ? ("(".$_ginfo["query"][$name].") ".$name) : $_ginfo["query"][$name]);
	}


	function grouplist($inp, $gap=1) {
		$outp = array();
		$started = 0;
		$ended = 0;
		for($i=0;$i<count($inp);$i++){
			if($started==null){
				$started = $inp[$i];
				$ended = $started;
			}
			else if($inp[$i]-$ended==$gap){
				$ended = $inp[$i];
			}
			else{
				$outp[] = array($started,($ended-$started)/$gap+1);
				$started = null;
				$i--;
			}
		}
		if($started!=null){
			$outp[] = array($started,($ended-$started)/$gap+1 );
		}
		return $outp;
	}

	function sql2dict($data, $key) {
		$outp = array();
		foreach($data as $i=>$row){
			$outp[$row[$key]] = $row;
		}
		return $outp;
	}

	function errormsg($ec, $cnd=true) {
		global $_ginfo;
		return (($ec<0 && $cnd) ?getval($ec, $_ginfo["error"], "Error : ".$ec):"");
	}

	function tf($inp) {
		return $inp?"true":"false";
	}
	// Function Added By Tej Pal Sharma for filtering Search Results
	// Start::
	//if both upperlimit and lowerlimit are set -1 then returns query => " TRUE " and param=>emptyArray
	//Returns an associative array with keys 'query' whose value is the query and 'parama' whose value is an array(having values to replace in query) to pass to function Sqle::getA()
	function filteredResultsQuery($filteringKey, $inWhichTable, $lowerLimit = -1, $upperLimit = -1, $colsToFetch = array('*'),$groupByKey = -1) {
		global $_ginfo;
		$colsToFetch = implode(',', $colsToFetch);
		$parametersArr = array();
		if($lowerLimit==-1 && $upperLimit==-1){
			return array('query'=>' TRUE ','parama'=>$parametersArr);
		}
		$parametersArr['lowerlimit'] = $lowerLimit;
		$parametersArr['upperlimit'] = $upperLimit;
		
		$query  = "SELECT ".$colsToFetch." FROM ".$inWhichTable." WHERE ";
		if($lowerLimit==-1)
			$query .= " TRUE AND ";
		else
			$query .= $filteringKey." > {lowerlimit} AND ";
		if($upperLimit==-1)
			$query .= " TRUE ";
		else
			$query .= $filteringKey." < {upperlimit} ";
		if($groupByKey!=-1)
			$query .= "group by ".$groupByKey." ";
		return array('query'=>$query,'parama'=>$parametersArr);
	}
	// ::End


	function autoscroll($post_data){
		global $_ginfo;
		$action_spec=$_ginfo["autoscroll"][$post_data["action"]];
		mergeifunset($action_spec, array('sort'=>'', 'maxl'=>null, 'minl'=>null, "filterfunc"=>null, "load_view"=>"template/".$post_data["action"].".php" ));
		$fixed=array("uid"=>User::loginId(), "time"=>time());
		$post_data=Fun::mergeforce($post_data, $fixed);
		$qoutput=Sqle::autoscroll($action_spec["query"], $post_data, $action_spec["key"], $action_spec["sort"], $post_data["isloadold"], $action_spec["minl"], $action_spec["maxl"]);
		if($action_spec["filterfunc"]!=null){
			$autos=new Autoscoll();
			$funcname=$action_spec["filterfunc"];
			if(method_exists($autos, $funcname))
				$qoutput=$autos->$funcname($qoutput);
		}
		$qoutput["load_view"]=$action_spec["load_view"];
		return $qoutput;
	}
	function handle_disp($post_data,$actionarg=null){ 
		global $_ginfo;
		if($actionarg!=null)
			$post_data["action"]=$actionarg;
		$a=new Actiondisp();
		$outp=array("ec"=>-7); 
		if(isset($post_data["action"])  ){
			$isvalid=isvalid_action($post_data);
			if(!($isvalid>0))
				$outp["ec"]=$isvalid;
			else{ 
				$func=$post_data["action"];   
				if( method_exists($a,$post_data["action"])){  
					$a->$func($post_data,$actionarg==null);
					return;
				}
				else if(islset($_ginfo,array("autoscroll",$post_data["action"]))) {
					$as_handle = autoscroll($post_data);
					$outp["data"]=Fun::getflds(array("min", "max", "minl", "maxl"), $as_handle);
					$outp["ec"]=1;
					if($actionarg==null)
						echo json_encode($outp)."\n";
					
					load_view($as_handle["load_view"], array("qresult"=>$as_handle["qresult"]));
					return;
				}
			}
		}
		if($actionarg==null)
			echo json_encode($outp)."\n";
	}

	function subsarr($arr1, $arr2){
		/*	
			$arr1 - $arr2
		*/
		$outp = array();
		foreach( $arr1 as $i){
			if( !in_array($i, $arr2))
				$outp[]=$i;
		}
		return $outp;
	}

	function rit($toprint, $cond=true, $toprint_false=''){
		if($cond)
			return $toprint;
		else
			return $toprint_false;
	}

	function convchars($inp){
		$conv=array("&" => "&amp;", '"' => "&quot;", "'" => "&#039;", "<" => "&lt;", ">" => "&gt;");
		foreach($conv as $i => $val) {
			$inp=str_replace($i, $val, $inp);
		}
		return $inp;
	}

	function getNameFromUrl($url) {
		$arr=Fun::myexplode('/',$url); 
		$index=array_search('index.php', $arr)+1;
		if(!(isset($arr[$index])) || $arr[$index]=='' || $arr[$index]=='#')
			return 'index';
		else if(strpos($arr[$index],'?')!==false) {
			$ok=Fun::myexplode('?',$arr[$index]);
			return $ok[0];
		}
		return $arr[$index];
	}

	function searchkeysplit($searchString) {
		$searchString = preg_replace("/[^a-zA-Z 0-9]+/", " ", $searchString);
		$searchString = trim($searchString);
		return myexplode(" ", strtolower($searchString));
	}


	function g($inp) {
		global $$inp;
		return $$inp;
	}

	function s($inp, $val=null) {
		global $$inp;
		$$inp = $val;
	}

	function gi($inp) {
		return getval($inp, g("_ginfo"));
	}

	function listget() {
		$args = func_get_args();
		$inplist = array_slice($args, 1);
		$outp = getval(0,$args);
		//echo "<pre>";print_r($outp);echo "<pre>";
		foreach($inplist as $i => $val) {
			$outp = getval( $val, $outp );
		}
		return $outp;
	}

	function gget() {
		$args = func_get_args();
		$args[0] = g(getval(0, $args));
		return call_user_func_array("listget", $args);
	}

	function giget() {
		$args = func_get_args();
		$args[0] = gi(getval(0, $args));
		return call_user_func_array("listget", $args);
	}
	
	function filter($list, $boolfunc) {
		$outp = array();
		foreach($list as $i => $val) {
			if($boolfunc($val) === true) {
				$outp[] = $val;
			}
		}
		return $outp;
	}

	function map($list ,$func, $isindexed=false) {
		$outp = array();
		foreach($list as $i => $val) {
			$outp[($isindexed?$val:$i)] = $func($val);
		}
		return $outp;
	}


	function add($a, $b) {
		if(gettype($a) == "array" && gettype($b) == "array" ) {
			return Fun::array_append($a, $b);
		} else if (gettype($a) == "array" && gettype($b) == "integer") {
			return Fun::array_addinall($a, $b);
		}
	}

	function msvalprint($inp) {//recursive function.
		if(gettype($inp) == "array") {
			$isnindex = (array_keys($inp) == Fun::oneToN(count($inp)-1, 0));//is natural indexed
			$otext = map(array_keys($inp), function($ind) use($isnindex, $inp) {
				return ($isnindex?"":"'".$ind."'=>").msvalprint($inp[$ind]);
			});
			return "array(".implode(", ", $otext).")";
		} else if(gettype($inp) == 'integer') {
			return $inp;
		} else {
			$inp = str_replace("'", "\\'", "".$inp);
			return "'".$inp."'";
		}
	}

	function msimplode($glue, $inp, $defval=null) {
		 return (count($inp) == 0 && $defval != null ) ? $defval : implode($glue, $inp);
	}

?>
<?php  /*  by yogy   */
	function digrupee($digit) {
		return 'Rs. '.$digit;
	}
	function convlang($langcode){
		$lang=array("English","Hindi","Assamese","Sanskrit","Bengali","Mayalayam","Tamil","Gujarati","Marathi","Telugu","Oriya","Urdu","Kannada","Punjabi");
		for($i=0;$i<count($lang);$i++) {
			if($i==($langcode-1)) {
				return $lang[$i];
			}
		}
		return null;
	}
	function convsubs($subcodes,$subother=''){
		$subjects = array("Mathematics","Physics","Chemistry","Biology","Science (6-10)");
		$subkeys = explode("-",$subcodes);
		$fltrsubs = array();
		foreach($subkeys as $key){
			if(array_key_exists(($key-1),$subjects))
				$fltrsubs[] = $subjects[$key-1];
		}
		if(!empty($subother))
			$fltrsubs[] = $subother;
		return implode(',',$fltrsubs);
	}

	function convgrades($gradecodes,$html=0){
		$gradesarr = array();
		$grades = explode("-", $gradecodes);
		foreach ($grades as $value)
			$gradesarr[] .= convgrade($value,$html);
		return implode(',',$gradesarr);
	}
	function convgrade($gradecode,$html=0) {
		if($html==0)
			$grades=array("6<sup> th</sup> to 8<sup> th</sup>","9<sup> th</sup> to 10<sup> th</sup>","11<sup> th</sup> to 12<sup> th</sup>","IIT JEE");
		else
			$grades=array("6th to 8th","9th to 10 th","11 th to 12 th","IIT JEE");		
		for($i=0;$i<count($grades);$i++) {
			if($i==($gradecode-1)) {
				return $grades[$i];
			}
		}
		return null;
	}
	function cururl() {
		return $_SERVER['REQUEST_URI'];
	}
	function unsets($key){
		unset ($_SESSION[$key]);

	}
	function yogyimplode($glue,$lastglue,$arrval) { //implode with last glue
		if(!count($arrval)>0)
			return null;
		else {
			for($i=0;$i<=count($arrval)-1;$i++) {
				if($i==0)
					$string=$arrval[$i];
				else if($i==count($arrval)-1)
					$string=$string.$lastglue.$arrval[$i];
				else
					$string=$string.$glue.$arrval[$i];
			}
		}
		return $string;		
	}

	function conmerge($array1=array(),$array2=array()) { // merge 2 array's value continuous
		if(!count($array1)>0)
			return null;
		else if(!count($array1)==count($array2))
			return array1;
		else {
			for($i=0;$i<=count($array1)-1;$i++)
				$temparr[]=$array1[$i].$array2[$i];
			}
		return $temparr;	
	}
	function replacekeys($array1,$array2) {
		$keys=array_keys($array2);
		for($i=0;$i<count($keys);$i++) {
			for($j=0;$j<count($array1);$j++) {
				if($array1[$j]==$keys[$i])
					$array1[$j]=$array2[$keys[$i]];
			}
		}
		return $array1;
	}

	function getpaginrows($totalrows,$divat){
		for($i=1;$i<=($totalrows/$divat);$i++);

			if($totalrows%$divat!=0)
				return $i;
			else
				return $i-1;
	}
	function getpaginval($data,$spoint,$limit){ 
		$temp = array();
		if($spoint==0) $spoint=1;$tl=0;
		$spoint = $spoint*$limit-$limit;
		for($i=$spoint;$i<count($data);$i++){
			$temp[] = $data[$i];
			$tl++;if($tl==$limit) break;
		}
		return $temp;
	}

?>
<?php
/*
	Author: Narayan Waraich
*/
	/*
		Converts language code string into a comma separated languages string
		e.g. 1-2-5 => English,Hindi,Bengali
	*/
	function convert_lang($lang_code='')
	{
		$langs = explode("-", $lang_code);
		$languages=array("English","Hindi","Assamese","Sanskrit","Bengali","Mayalayam","Tamil","Gujarati","Marathi","Telugu","Oriya","Urdu","Kannada","Punjabi");
		foreach ($langs as $key => $value)
		{
			$lang[] = $languages[$value-1];
		}
		return implode(' , ',$lang);
	}

	/*
		Returns the proper spelling for degrees
	*/
	function convert_degree($degree='')
	{
		$degrees 	= array(
			'btech' =>	'B.Tech.',
			'mtech' =>	'M.Tech.',
			'phd'	=>	'Ph.D.',
			'msc'	=>	'M.Sc.',
			'mba'	=>	'M.B.A.',
			'dual'	=>	'B.Tech. + M.Tech.'
			);
		if (array_key_exists($degree, $degrees))
			return $degrees[$degree];
		return $degree;
	}
?>