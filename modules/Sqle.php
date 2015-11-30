<?php
class Sqle extends Sql{
	public static function selectVal($table,$flds,$cnds,$resultNo=-1){
		$selects=array();
		$params=array();
		$str="";
		$keys=array_keys($cnds);
		for($i=0;$i<count($keys);$i++){
			if(gettype($cnds[$keys[$i]])!='array'){
				$params[]=&$cnds[$keys[$i]];
				$val=$cnds[$keys[$i]];
				$sign='=';
			}
			else{
				$val=$cnds[$keys[$i]][0];
				$params[]=&$cnds[$keys[$i]][0];
				$sign=(count($cnds[$keys[$i]])>1 ? $cnds[$keys[$i]][1]:"=" );
			}
			$selects[]=$keys[$i].$sign." ? ";
			$str.=gettype($val)=='integer'?'i':'s';
		}
		$conds=join(" AND ",$selects);
		$query="select $flds from $table ".( $conds ===""? " ":" WHERE ").$conds." ".($resultNo!=-1 ? " LIMIT $resultNo ":" ");
		$temp=self::getArray($query,$str,$params);
		if($resultNo===1){
			if(count($temp)>0)
				return $temp[0];
			else
				return null;
		}
		else
			return $temp;
	}
	
	public static function insertVal($table,$data){
		$keys=array_keys($data);
		$params=array();
		$vars=array();
		$str="";
		for($i=0;$i<count($keys);$i++){
			$params[]=&$data[$keys[$i]];
			$vars[]='?';
			$str.=(gettype($data[$keys[$i]])=='string'?'s':'i');
		}
		$query="insert into $table (".join(",",$keys).") VALUES  (".join(",",$vars).")";
		// print_r($query);
		// print_r($str);
		// print_r($params);
		return self::query($query,$str,$params);
	}
	public static function updateVal($table,$sets,$cnds,$limit=-1){
		$selects=array();
		$params=array();
		$str="";
		$keys=array_keys($sets);
		$setstr=array();
		for($i=0;$i<count($keys);$i++){
			$setstr[]= $keys[$i]."=?";
			$params[]=&$sets[$keys[$i]];
			$str.=gettype($sets[$keys[$i]])=='integer'?'i':'s';
		}
		$keys=array_keys($cnds);
		for($i=0;$i<count($keys);$i++){
			if(gettype($cnds[$keys[$i]])!='array'){
				$params[]=&$cnds[$keys[$i]];
				$val=$cnds[$keys[$i]];
				$sign='=';
			}
			else{
				$val=$cnds[$keys[$i]][0];
				$params[]=&$cnds[$keys[$i]][0];
				$sign=(count($cnds[$keys[$i]])>1 ? $cnds[$keys[$i]][1]:"=" );
			}
			$selects[]=$keys[$i].$sign." ? ";
			$str.=gettype($val)=='integer'?'i':'s';
		}
		$conds=join(" AND ",$selects);
		$query="update $table set ".join(',',$setstr).( $conds ===""? " ":" WHERE ").$conds." ".($limit!=-1 ? " LIMIT $limit ":" ");
		return self::query($query,$str,$params);
	}
	public static function deleteVal($table,$cnds,$limit=-1){
		$selects=array();
		$params=array();
		$str="";
		$keys=array_keys($cnds);
		for($i=0;$i<count($keys);$i++){
			if(gettype($cnds[$keys[$i]])!='array'){
				$params[]=&$cnds[$keys[$i]];
				$val=$cnds[$keys[$i]];
				$sign='=';
			}
			else{
				$val=$cnds[$keys[$i]][0];
				$params[]=&$cnds[$keys[$i]][0];
				$sign=(count($cnds[$keys[$i]])>1 ? $cnds[$keys[$i]][1]:"=" );
			}
			$selects[]=$keys[$i].$sign." ? ";
			$str.=gettype($val)=='integer'?'i':'s';
		}
		$conds=join(" AND ",$selects);
		$query="delete from $table ".( $conds ===""? " ":" WHERE ").$conds." ".($limit!=-1 ? " LIMIT $limit ":" ");
		return self::query($query,$str,$params);
	}
	public static function fetchColumnNamesFromTable($table,$excludeColumns=array()){		//Function returns a array of column names of table defined by $table. And Excludes columns which are present in array $excludeColumns
		$columns = array();
		$query = "SHOW COLUMNS FROM $table";
		$columnInfoArray = self::getArray($query);
		foreach ($columnInfoArray as $columnInfoRow) {
			if(!array_search($columnInfoRow['Field'], $excludeColumns))
				$columns[] = $columnInfoRow['Field'];
		}
		return $columns;
	}
	public static function getRow($query,$param_string="",$param_array=array(), $getkey=null){
		$qoutp=Sql::getArray($query,$param_string,$param_array);
		if(count($qoutp)>0)
			return ($getkey == null ? $qoutp[0]:getval($getkey, $qoutp[0]) );
		else
			return null;
	}

	public static function getR($query, $param = array(), $getkey=null) {
		$qoutp=Sqle::getA($query, $param);
		if(count($qoutp) > 0)
			return ($getkey == null ? $qoutp[0]:getval($getkey, $qoutp[0]) );
		else
			return null;
	}

	public static function loadtables($query,$key,$limit=-1,$min=0,$max=0,$isnewer=true,$sorttext=''){
		$min=0+$min;
		$max=0+$max;
		$limit=0+$limit;
		$max_constrain=(($max>0 && $isnewer)  ? $key.">".$max:"true");
		$min_constrain=(($min>0 && !$isnewer)  ? $key."<".$min:"true");
		$limit_constrain=($limit==-1 ? "":"limit ".$limit);
		$uquery="select * from (select * from (".$query[0].") overflowtable where $max_constrain AND $min_constrain $limit_constrain ) overflowtable_extend $sorttext ";
		$qoutp=Sql::getArray($uquery,$query[1],$query[2]);

		if(count($qoutp)==0){
		}
		else{
			$e1=$qoutp[0][$key];
			$e2=$qoutp[count($qoutp)-1][$key];
			$mino=min($e1,$e2);
			$maxo=max($e1,$e2);
		}
		return array("qoutp"=>$qoutp,"min"=>$min,"max"=>$max);
	}
	public static function convQuery($query,$param_array=array()){
		preg_match_all("|{[^}]+}|U",$query,$matches); 
		$matches=$matches[0]; 
		$params="";
		$parama=array();
		for($i=0;$i<count($matches);$i++){
			$key=substr($matches[$i],1,strlen($matches[$i])-2);
			if(isset($param_array[$key])){
				$params.=(gettype($param_array[$key])=='string'?'s':'i');
				$parama[]=$param_array[$key];
				$query=str_replace($matches[$i], '?' , $query );
			}
		} //print_r($matches);
		return array($query,$params,$parama);
	}

	public static function getA($query,$param_array=array()){ 
		$conq=Sqle::convQuery($query,$param_array); 
		return Sql::getArray($conq[0],$conq[1],getrefarr($conq[2]));
	}

	public static function q($query,$param_array=array()){
		$conq=Sqle::convQuery($query,$param_array);
		return Sql::query($conq[0],$conq[1],getrefarr($conq[2]));
	}

	// public static function autoscroll($query, $param, $key, $sort='', $isloadold=true ,$minl=null, $maxl=null){
	// 	setifnn($minl, $param["minl"]);
	// 	setifnn($maxl, $param["maxl"]);
	// 	if($key!=null){
	// 		if($isloadold)
	// 			$querylimit = "select * from (".gtable($query).") outpquery where ($key<{min} OR {min}=-1) ".($param["minl"]==-1?'':"limit {minl} ");
	// 		else
	// 			$querylimit = "select * from (".gtable($query).") outpquery where $key>{max} ".($param["maxl"]==-1?'':"limit {maxl} ");
	// 	} else{//max,maxl must be +ve int
	// 		$querylimit="select * from (".$query.") outpquery limit {maxl} offset {max} ";
	// 	}
	// 	if($key!=null)
	// 		$querysort="select * from (".$querylimit.") sortquery ".$sort;
	// 	else
	// 		$querysort=$querylimit;
	// 	$qresult=Sqle::getA($querysort,$param);
	// 	$outp["qresult"]=$qresult;
	// 	$outp["maxl"]=$maxl;
	// 	$outp["minl"]=$minl;
	// 	if($key==null){
	// 		$outp["max"]=$param["max"]+$param["maxl"];
	// 	} else{
	// 		if(count($qresult)==0){
	// 			$outp["min"] = $param["min"];
	// 			$outp["max"] = $param["max"];
	// 		} else{
	// 			$e1=$qresult[0][$key];
	// 			$e2=$qresult[count($qresult)-1][$key];
	// 			$outp["min"] = min($e1, $e2);
	// 			$outp["max"] = max($e1, $e2);
	// 		}
	// 	}
	// 	return $outp;
	// }

	public static function autoscroll($query, $param, $key, $sort='', $isloadold=true ,$minl=null, $maxl=null){
		
		setifnn($minl, $param["minl"]);
		setifnn($maxl, $param["maxl"]);
		if($key!=null){
			if($isloadold)
				$querylimit = "select * from (".gtable($query, false).") outpquery where ($key<{min} OR {min}=-1) ".($param["minl"]==-1?'':"limit {minl} ");
			else
				$querylimit = "select * from (".gtable($query, false).") outpquery where $key>{max} ".($param["maxl"]==-1?'':"limit {maxl} ");
		} else{//max,maxl must be +ve int
			$querylimit="select * from (".$query.") outpquery limit {maxl} offset {max} ";
		}
		if($key!=null)
			$querysort="select * from (".$querylimit.") sortquery ".$sort;
		else
			$querysort=$querylimit;
		$qresult=Sqle::getA($querysort,$param);
		$outp["qresult"]=$qresult;
		$outp["maxl"]=$maxl;
		$outp["minl"]=$minl;
		$outp["qresultlen"]=count($qresult);
		if($key==null){
			$outp["max"]=$param["max"]+$param["maxl"];
		} else{
			if(count($qresult)==0){
				$outp["min"] = $param["min"];
				$outp["max"] = $param["max"];
			} else{
				$e1=$qresult[0][$key];
				$e2=$qresult[count($qresult)-1][$key];
				$s=new Special();
				$outp["min"] = $s->min($e1, $e2, $param["min"]);
				$outp["max"] = $s->max($e1, $e2, $param["max"]);
			}
		}

		return $outp;
	}




}
?>
