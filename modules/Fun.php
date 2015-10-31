<?php
class Special{
	function lt($a, $b){
		return ($b==-1 || $a<$b);
	}
	function gt($a, $b){
		return ($a==-1 || $a>$b);
	}
	function max2($a, $b){
		return ($this->gt($a, $b) ? $a:$b);
	}
	function min2($a, $b){
		return ($this->lt($a, $b) ? $a:$b);
	}
	function max(){
		$inp=func_get_args();
		if(count($inp)==0)
			return null;
		$maxtillnow=$inp[0];
		for($i=1; $i<count($inp); $i++){
			$maxtillnow=$this->max2($maxtillnow, $inp[$i]);
		}
		return $maxtillnow;
	}
	function min(){
		$inp=func_get_args();
		if(count($inp)==0)
			return null;
		$mintillnow=$inp[0];
		for($i=1; $i<count($inp); $i++){
			$mintillnow=$this->min2($mintillnow, $inp[$i]);
		}
		return $mintillnow;
	}
}


abstract class Fun{
	public static function encode($pass){
		$shift=0;
		$outp="";
		for($i=0;$i<strlen($pass);$i++){
			$val=ord(($pass[$i]+$shift)%256);
			$outp.=(chr( ord('a') + floor($val/16) ).chr( ord('a') + ($val%16) ));
		}
		return $outp;
	}
	public static function decode($epass){
		$shift=0;
		$outp="";
		$st=0;
		for($i=0;$i<strlen($epass);$i++){
			if($i%2==0){
				$st= ( ord($epass[$i])-ord('a') )*16 ;
			}
			else{
				$st+=( ord($epass[$i])-ord('a') ) ;
				$outp.=chr( ($st+256-$shift)%256);
			}
		}
		return $outp;
	}
	public static function encode1($inp){
		global $passkey;
		return substr(md5( self::encode($passkey["key1"].$inp) ),0,9);
	}
	public static function encode2($inp){
		global $sec;
		return substr(md5( $sec['encode1'].substr(md5($inp),10,10)),0,9);
	}

	public static  function max($a,$b){
		return ($a>$b?$a:$b);
	}
	public static function oneToN($n,$m=1,$incorder=true){
		$outp=array();
		for($i=$m;$i<=$n;$i++){
			$outp[]=$incorder?$i:($n-$i+$m);
		}
		return $outp;
	}
	public static function isAllSet($alist,$data){
		for($i=0;$i<count($alist);$i++)
			if( ! isset($data[ $alist[$i] ]) )
				return false;
		return true;
	}
	public static function isSetG(){
		global $_GET;
		return self::isAllSet( func_get_args() , $_GET );
	}
	public static function isSetP(){
		global $_POST;
		return self::isAllSet( func_get_args() , $_POST );
	}

	public static function issetlogout(){
		if(isset($_GET['logout'])) {
			User::logout();
			self::redirect(HOST);
		}
	}
	public static function redirect($url){
		closedb();
		header("Location: ".$url);
		exit(0);
	}
	public static function redirectinv(){
		Fun::redirect(HOST."invalid.php");
	}
	public static function getcururl($protocol='http://'){
		return $protocol. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}
	public static function gotohome($typec='',$force=false){
		self::gotologin($typec,$force,"");
	}
	public static function gotologin($typec='',$force=false,$page='login'){
		if( $force || ( !User::islogin() || ($typec!='' && $typec!=User::loginType()) )  ) {
			Fun::redirect(BASE.$page."?url=".rawurlencode(self::getcururl()));
		}
	}


	public static function getflds($arr,$data){ 
		$temp=array();
		for($i=0;$i<count($arr);$i++){
			$k=$arr[$i];
			if(isset($data[$k]))
				$temp[$k]=$data[$k];
		}
		return $temp;
	}
/*   BY YOGY  */
	public static function changesomedata($data){ 
		$temp = array();
		$subother = $data['subother']; 
		foreach($data as $key=>$value ){
			$value = $key=='gender'?($value=='m'?'Male':'Female'):$value;
			$value = $key=='college'?'IIT '.$value:$value;
			$value = $key=='resume'?'http://www.getiitians.com/teaching/'.$value:$value;
			$value = $key=='minfees'?digrupee($value):$value;
			$value = $key=='degree'?convert_degree($value):$value;
			$value = $key=='grade'?convgrades($value,1):$value;
			$value = $key=='sub'?convsubs($value,$subother):$value;
			if($key!='subother')
				$temp[$key] = $value;
			}
		return $temp;
	}
	public static function getarrflds($arr,$data,$namestrtpos=0){
		$temp=array();
		for($i=0;$i<count($arr);$i++){
			$k=$arr[$i];
			if(isset($data[$k])) {
				for($j=0;$j<count($data[$k]);$j++) { 
					$l=$j+$namestrtpos+1;
					$temp[$k.$l]=$data[$k][$j];
				}
			}		
		}
		return $temp;
	}
/*...........*/	
	

	public static function timetostr($time){//Opposite of strtotime
		return date("M d Y h:i a",$time);
	}
	public static function timetostr_t2($time){//made by himanshu
		return date("h:i",$time);
	}
	public static function timetostr_t4($time){//made by himanshu
		return date("h:i a",$time);
	} 
	public static function timetodate($time){
		return date("M d, Y",$time);
	}
	public static function timetodate_v2($time){
		return date("d-m-Y",$time);
	}
	public static function timetostr_t3($time){
		return date('d F, Y',$time);
	}
	public static function strtotime_t3($date){
		if($date=='')
			return 0;
		$temp=DateTime::createFromFormat('d F, Y',$date);
		return strtotime($temp->format("M d Y h:i a"));
	}

	public static function timetotime($time){
		return date("h:i a",$time);
	}

	public static function timetotime_t3($time,$showampm=true){
		$hours=0+date("h",$time);
		$min=0+date("i",$time);
		$ampm=date("a",$time);
		$outp=$hours;
		if($min!=0)
			$outp.=":".$min;
		if($showampm){
			$outp.=" ".$ampm;
		}
		return $outp;
	}
	public static function timepassed($s){
		if($s<5)
			return "few second ago";
		else if($s<60)
			return $s." second ago";
		else if($s<60*45)
			return floor($s/60)." minutes ago";
		else if($s<60*(60+45))
			return "about 1 hour ago";
		else if($s<60*60*24)
			return floor($s/3600)." hours ago";
		else if($s<60*60*24*5)
			return floor($s/(60*60*24))." days ago";
		else
			return self::timetostr(time()-$s);
	}
	public static function timepassed_t2($s){
		if($s<5)
			return "Just";
		else if($s<60)
			return $s."s";
		else if($s<60*45)
			return floor($s/60)."m";
		else if($s<60*60*24)
			return floor($s/3600)."h";
		else if($s<60*60*24*5)
			return floor($s/(60*60*24))."d";
		else
			return self::timetostr(time()-$s);
	}
	public static function maxspace($inp,$len){
		$inp=self::displayMsgBody($inp);
		if(strlen($inp)>$len)
			return substr($inp,0,$len-3).".. ";
		else
			return $inp;
	}
	public static function displayMsgBody($inp){
		$inp=htmlspecialchars($inp);
		$inp=str_replace("\n","<br>",$inp);
		$inp=str_replace("  ","&nbsp;&nbsp;",$inp);
		$inp=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$inp);
		return $inp;
	}
	public static function mergeifunset($a,$b){
		$keys=array_keys($b);
		for($i=0;$i<count($keys);$i++){
			if(!isset($a[$keys[$i]]))
				$a[$keys[$i]]=$b[$keys[$i]];
		}
		return $a;
	}
	public static function allfileexist($files){
		foreach($files as $f){
			if(!file_exists($f))
				return false;
		}
		return true;
	}
	public static function setifunset($data,$key,$val){
		if(!isset($data[$key]))
			$data[$key]=$val;
		return $data;
	}
	public static function capName($name){
		if(strlen($name)>0 && ord('a')<=ord($name[0]) && ord($name[0])<=ord('z') )
			return chr( ord($name[0])-ord('a')+ord('A')  ).substr($name,1);
		else
			return $name;
	}
	public static function uploadfile($ext='file'){
		$timenow=time();
		$fn=$timenow."_".Fun::encode2(User::loginId()).".".$ext;
		return $fn;
	}
	public static function datetoday($timenow=0,$n=0){
		if($timenow==0)
			$timenow=time();
		return strtotime(date("d-m-Y",$timenow))+$n*3600*24;
	}
	public static function arrtooption($arr,$type='intval'){
		$outp=array();
		for($i=0;$i<count($arr);$i++){
			$temp=array('disptext'=>$arr[$i],'val'=>( $type=='intval' ? $i+1 : $arr[$i] ));
			$outp[]=$temp;
		}
		return $outp;
	}
	public static function addselect($oparr,$text='Select'){
		array_unshift ($oparr,array('disptext'=>$text,'val'=>''));
		return $oparr;
	}
	public static function addother($oparr,$text="Other"){
		$oparr[]=array('disptext'=>$text,'val'=>'other','type'=>'other');
		return $oparr;
	}
	public static function replacetext($content,$arr){
		
	}
	public static function timeofnextmonth($inp=0){
		if($inp==0)
			$inp=Fun::dateToday();
		$datetodaynum=date("d",$inp);//today date integer (1-31)
		$maxdays=date('t',$inp);//Max days in this month
		return $inp+($maxdays-$datetodaynum+1)*(24*3600);
	}
	public static function timeofprvmonth($inp=0){
		if($inp==0)
			$inp=Fun::dateToday();
		$datetodaynum=date("d",$inp);//today date integer (1-31)
		$maxdays=date('t',$inp);//Max days in this month
		return $inp-($datetodaynum)*(24*3600);
	}
	public static function timeofnextxday($d){
		$datetoday=Fun::datetoday();
		return $datetoday+24*3600*(1+($d+7-1-date('w',$datetoday))%7);
	}
	public static function getmulinput($arr,$key,$num){
		$outp=array();
		for($i=0;$i<$num;$i++){
			if(isset($arr[$key.($i+1)]) && $arr[$key.($i+1)]=="true"){
				$outp[]=$i;
			}
		}
		return $outp;
	}
	public static function makeDummyTableQuery($arr,$key){
		if(count($arr)==0)
			return "select * from (select 1 as ".$key." ) temp_".$key." where 1=2 ";
		$temp=array();
		$temp[]="select ".(0+$arr[0])." as ".$key;
		for($i=1;$i<count($arr);$i++){
			$temp[]="select ".(0+$arr[$i]);
		}
		$query=implode(" union ", $temp);
		return $query;
	}
	public static function getuploadfilename($ext='file',$change=''){
		$timenow=time();
		$fn=$timenow."_".(User::loginId())."_".Fun::encode2(User::loginId()).$change.".".$ext;
		return $fn;
	}
	public static function uploadfile_post($data,$const=array(),$change='') {
		$outp=array();
		$ext=pathinfo($data['name'],PATHINFO_EXTENSION);
		if(isset($const["maxsize"]) && $data["size"]>$const["maxsize"])
			$outp['ec']=-1;
		else if(isset($const["ext"]) && in_array($ext,$const["ext"]) )
			$outp['ec']=-3;
		else{
			$fn="data/files/".Fun::getuploadfilename($ext,$change);
			move_uploaded_file($data["tmp_name"],$fn);
			chmod($fn,0777);
			$outp['ec']=1;
			$outp['fn']=$fn;
		}
		return $outp;
	} 
	public static function uploadfiles($data,$const=array()){
		$outp=array();
		$ec=1;
		if( isset($const["maxfile"]) && count($data["size"] > $const["maxfile"] )){
			$ec=-4;//Maximum number of file allowed exeed.
		}
		else if(!(count($data['size'])==1 && $data['size'][0]==0 )){
			for($i=0;$i<count($data["tmp_name"]) && $data["tmp_name"][0]!="";$i++){
				$temp=Fun::uploadfile_post(array('name'=>$data['name'][$i],"size"=>$data["size"][$i],"tmp_name"=>$data["tmp_name"][$i]),$const,$i);
				if($temp['ec']<0){
					$ec=$temp['ec'];
					break;
				}
				else
					$outp[]=$temp['fn'];
			}
		}
		else
			$ec=-2;//Not file uploaded
		return array('ec'=>$ec,'outp'=>$outp);
	}

	public static function resizeimage($curimage,$tosave,$w,$h){//don't use this function. use resizeimg { php/funcs.php }
		$cmd="convert $curimage -resize '$w"."x"."$h^' -gravity Center -crop '$w"."x"."$h+0+0' $tosave ; chmod 777 $tosave";
		shell_exec($cmd);
	}

	public static function myexplode($n,$st){
		$temp=explode($n,$st);
		return (count($temp)==1 && $temp[0]=="") ? array() : $temp;
	}

	public static function rmsg($msg,$data){
		$keys=array_keys($data);
		for($i=0;$i<count($keys);$i++){
			$msg=str_replace("<".$keys[$i].">",$data[$keys[$i]],$msg);
		}
		return $msg;
	}

	public static function dummymm($to,$sub,$body,$add=array()){
		$cont="To : ".$to."\nSub : ".$sub."\nTime : ".(Fun::timetostr(time()))."\n\n".$body."\n\n".json_encode($add)."\n\n----------------------------------------------------\n";
		mergeifunset($add,array("file"=>"data/mailf"));
		$oldc=file_exists($add["file"])?file_get_contents($add["file"]):"";

		file_put_contents($add["file"], $oldc.$cont);
		return chmod($add["file"],0777);
	}

	public static function mail($to,$sub,$body,$add=array()){ //to be replace 
		Fun::dummymm($to,$sub,$body,Fun::mergeifunset($add, array("file"=>"data/mailf")));
		if(gi("isrealmail")) { 
			return Funs::sendmail($to, $sub, $body);
		}
	}
	public static function msg($to,$sub,$body,$add=array()){//to be replace
		Fun::dummymm($to,$sub,$body, Fun::mergeifunset($add,array("file"=>"data/msgf")));
		if(gi("isrealmsg")) {
			return Funs::sendmsg($to, $body);
		}
	}

	public static function mailfromfile($to,$mfile,$data = array()) { 
		list($subj, $body) = Fun::readmail($mfile);
		return Fun::mail( $to, $subj, rquery($body, $data) );
	}

	public static function mailfromfields($to,$subj,$body,$data = array()) {
		return Fun::mail($to, $subj, rquery($body, $data));
	}

	public static function msgfromfile($phone,$mfile,$data){
		return Fun::msg($phone, "phone messgae", rquery( Fun::readmail($mfile, true), $data));
	}

	public static function msgfromfields($phone,$body,$data = array()){
		return Fun::msg($phone,"phone messgae",rquery($body,$data));	
	}

	public static function timeslotlist(){
		$datetoday=Fun::datetoday();
		$times=array();
		for($i=0;$i<24;$i++){
			$times[]=Fun::timetotime($datetoday+$i*3600 )." - ".Fun::timetotime($datetoday+($i+1)*3600-1 ) ;
		}
		return $times;
	}
	public static function rquery($msg,$data){
		$keys=array_keys($data);
		for($i=0;$i<count($keys);$i++){
			$msg=str_replace("{".$keys[$i]."}",$data[$keys[$i]],$msg);
		}
		return $msg;
	}
	public static function get_key_values($arr){
		$outp=array();
		foreach($arr as $key=>$val){
			$outp[]=$val;
		}
		return $outp;
	}
	public static function mycurl($url){
		return file_get_contents($url);
//    return shell_exec("python check_plogin.py '".$url."'");
	}
	public static function copy_arr($n,$val=""){
		$outp=array();
		for($i=0;$i<$n;$i++)
			$outp[]=$val;
		return $outp;
	}

	public static function prvnotf($uid,$sid,$mfile,$data,$url){
		$content=Fun::rmsg(file_get_contents($mfile),$data);
		$nid=Sqle::insertVal("notf",array("uid"=>$uid,"sid"=>$sid,"content"=>$content,"time"=>time(),"isr"=>"0","url"=>$url ));
		if(strpos($url,'?'))
			$url=$url."&notfid=";
		else
			$url=$url."?notfid=";
		Sql::query("update notf set url=concat(?,id) where id=?",'si',array(&$url,&$nid));
		return $nid;
	}
	public static function notf($uid,$fn,$arr){
		$arr=Fun::setifunset($arr,"url","");
		Fun::prvnotf($uid,User::loginId(),$fn,$arr,$arr["url"]);
	}
	public static function filestodownload_link($inp){
		$files=Fun::myexplode(",",$inp);
		$outp=array();
		foreach($files as $ind=>$val){
			$outp[]=("<a href='$val' >File ".($ind+1)."</a>");
		}
		return $outp;
	}
	public static function smilymsg($data){
		$data=str_replace("<3", ":heart:",$data );
		$data=htmlspecialchars($data);
		$exp=array(':)'=>'smile.png',':-)'=>'smile.png',':p'=>'p.png',':P'=>'p.png',':/'=>'angry.png',';)'=>'eye.png',':('=>'sad.png',':o'=>'question.png',':O'=>'question.png','<3'=>'heart.png',':*'=>'kiss.png',':-*'=>'kiss.png',':heart:'=>'heart.png');
		$exp1=array("\n"=>"<br>", "  "=>"&nbsp;&nbsp;", "\t"=>"&nbsp;&nbsp;&nbsp;");
		foreach($exp1 as $key=>$val){
			$data=str_replace($key, $val ,$data);
		}
		foreach($exp as $key=>$val){
			$data=str_replace($key,"<img  style='margin-bottom:-4px;' src='photo/usefull/".$val."' />"  ,$data);
		}
		return $data;
	}
	public static function makeDummyTableColumns($arr,$flds=null,$params=''){
		if(count($arr)==0){
			return "select 1 as id limit 0";
		}
		else{
			if($flds==null){
				$flds=array();
				for($i=0;$i<count($arr[0]);$i++){
					$flds[]="col".$i;
				}
			}
			$qtexts=array();
			foreach($arr as $i=>$val){
				$qtext="(select ";
				$farr=array();
				foreach($val as $j=>$val1){
					$farr[]=( ($params!='' && $params[$j]=='s') ? "'".$val1."'" : (0+$val1)).($i==0?( " as ".$flds[$j] ):"" );
				}
				$qtext.=implode(" , ", $farr ).")";
				$qtexts[]=$qtext;
			}
			$query=implode(" union ", $qtexts );
			return $query;
		}
	}
	public static function makeDummyTableColumns_t2($arr,$flds,$params=''){
		if(count($arr)==0){
			return "select 1 as id limit 0";
		}
		else{
			$qtexts=array();
			foreach($arr as $i=>$val){
				$qtext="(select ";
				$farr=array();
				foreach($val as $j=>$val1){
					$farr[]=( ($params!='' && $params[$j]=='s') ? "'".$val1."'" : (0+$val1)).($i==0?( " as ".$flds[$j] ):"" );
				}
				$qtext.=implode(" , ", $farr ).")";
				$qtexts[]=$qtext;
			}
			if(isset($qtexts[1]))
				$qtexts[0]=$qtexts[0].' as tmp ';
			$query=implode(" union ", $qtexts );
			return $query;
		}
	}
	public static function dbarrtooption($arr,$id,$val){
		$outp=array();
		foreach($arr as $i=>$row){
			$outp[]=array("disptext"=>$row[$val],"val"=>$row[$id]);
		}
		return $outp;
	}
	public static function idtovalarr($qresult,$id,$val){
		$outp=array();
		foreach($qresult as $i=>$row)
			$outp[$row[$id]]=$row[$val];
		return $outp;
	}

	public static function getmulchecked($data,$key,$len){
		$outp=array();
		for($i=1;$i<=$len;$i++){
			if(isset($data[$key.$i]))
				$outp[]=$i;
		}
		if(isset($data[$key."other"])){
			$outp[]="other";
			$outp[]=$data[$key."other"];
		}
		return implode("-",$outp);
	}


	public static function uploadpic($file, $smallkey, $bigkey, $size, $const=array()){
			$fd=Fun::uploadfile_post($file,$const);
			if($fd["ec"]>0){
				$smallpic="data/files/".Fun::getuploadfilename(pathinfo($fd['fn'], PATHINFO_EXTENSION), 'small');
				resizeimg($fd["fn"], $smallpic, $size, $size);
				Sqle::updateVal("users",array($smallkey=>$smallpic, $bigkey=>$fd["fn"]), array("id"=>User::loginId()) );
			}
			return $fd["ec"];
	}
	public static function getloadviewname($inp){
		return firstelm(explode(".php",lastelm(explode("/",$inp))));
	}

	public static function key_search($keys, $matchcolumn) {//$data have keys => {search, class, subject, topic, price, timer, lang, timeslot, orderby, 
		$temp = array();
		foreach($keys as $i => $val) {
			$temp[] = "lower(".$matchcolumn.") like concat('%', {key".($i+1)."}, '%')";
		}
		return count($temp) ==0 ? "true" : implode(" AND ", $temp);
	}
	public static function multichoose($arr, $matchcolumn, $needtoexplode = false) {
		if($needtoexplode) {
			$arr = intexplode("-", $arr);
		}
		return (count($arr)>0 ? ($matchcolumn." in (".implode(",", $arr)." ) ") : "false");
	}
	public static function intersectionquery($queryies, $key, $alias='query') {
		if(count($queryies) <= 0) {
			return "select 1 limit 0";
		}
		$query = "select * from (".$queryies[0].") ".$alias."0 ";
		$appstr = array();
		for($i=1; $i<count($queryies); $i++) {
			$appstr[] = " $key in (".$queryies[$i].") " ;
		}
		if(count($appstr) == 0) { 
			return $query;
		} else { 
			return $query." where ".implode(" AND ", $appstr);
		}
	}

	public static function readmail($file, $ismsg=false) {
		$clines = implode("\n", filter( myexplode("\n", file_get_contents($file)) , function($inp){
			return (strlen($inp)==0 || $inp[0]!="#");
		}));
		if( $ismsg ) {
			return $clines;
		} else {
			$clines = explode("\n", $clines, 2);
			return array(getval(0, $clines), getval(1, $clines) );
		}
	}

	public static function array_append($a, $b) {
		for($i=0; $i<count($b); $i++) {
			$a[] = $b[$i];
		}
		return $a;
	}

	public static function array_addinall($a, $val) {
		foreach($a as $i => $v) {
			$a[$i]+=$val;
		}
		return $a;
	}

	public static function mergeforce($a,$b){
		$keys=array_keys($b);
		for($i=0;$i<count($keys);$i++){
			$a[$keys[$i]]=$b[$keys[$i]];
		}
		return $a;
	}

	public static function get_constrain($inp, $arr) {//used in some query. mainly search
		return msimplode(" OR ", map(Fun::getflds( add(intexplode_t2($inp, count($arr) ), -1), $arr), function($inp){
			return "(".$inp.")";
		}), "true");
	}
/*   BY YOGY   */
	public static function starttimeconsstu($date1,$timeslot) {
		if($timeslot==null) {
			return true;
		} else { $str='';
		for($i=0;$i<=count($timeslot)-1;$i++) {
				if(count($timeslot)-1==$i) {
					$str=$str.'starttime = '.($date1+($timeslot[$i]-1)*1800);				}
				else {
					$str=$str.'starttime = '.($date1+($timeslot[$i]-1)*1800).' OR ';
					}
			}
			return $str;
		}
	}
	public static function rearrangefilearray($filearray) {
		$img_pro=array("name","type","tmp_name","error","size");
		for($j=0;$j<count($filearray[$img_pro[0]]);$j++) {
			for($i=0;$i<count($img_pro);$i++) {
				$arr[$j][$img_pro[$i]]=$filearray[$img_pro[$i]][$j];
			}
		}
		return $arr;		
	}
	public static function getsamenameflds($data,$key,$len) {
		$arr=array();
		for($i=0;$i<count($key);$i++) {
			for($j=1;$j<=$len;$j++) {
				$arr[$key[$i].$j]=$data[$key[$i].$j];	
			}
		}
		return $arr;	
	}
	public static function resjson2arr($data) {
		foreach($data as $result) {
			if(isset($result['jsoninfo'])) {
				$jsonarray = str2json($result['jsoninfo']);
				unset($result['jsoninfo']);
				$arr[] = mergeifunset($result,$jsonarray);
			} else {
				$arr[] = $result;
			}

		}
		return $arr;
	}

/*...........*/
}
?>