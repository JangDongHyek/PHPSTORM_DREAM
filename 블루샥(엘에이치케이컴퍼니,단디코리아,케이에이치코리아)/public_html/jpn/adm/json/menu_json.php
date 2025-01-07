<?
	$jsonArray=array();
	


	$sql="select * from g5_menu where CHAR_LENGTH(me_code)='2' order by me_id";
	$result=sql_query($sql);
	if(!$result){
		$jsonArray["success"]="false";
		$jsonArray["message"]="메뉴불러오기에 실패하였습니다.";
		$output=json_encode($jsonArray);
		echo to_han($output);
		exit;
	}else{
		$jsonArray["success"]="true";
		
	}

	$jsonArray["menu"]=array();
	while($row=sql_fetch_array($result)){
		if(strpos($row[me_link],"co_id")>0){
			$type="content";	
			$menu_id=substr($row[me_link],strpos($row[me_link],"=")+1,strlen($row[me_link]));
		}else if(strpos($row[me_link],"bo_table")>0){
			$type="board";
			$menu_id=substr($row[me_link],strpos($row[me_link],"=")+1,strlen($row[me_link]));
		}else{
			$type="";
		}
		$listArray=array(
								"me_code"=>$row[me_code],
								"me_name"=>strip_tags($row[me_name]),
								"path"=>$row[me_link],
								"type"=>$type,
								"menu_id"=>$menu_id,
								"web_url"=>G5_URL.$row[me_link]."&device=mobile"
								);
		array_push($jsonArray["menu"],$listArray);
	}
	$output=json_encode($jsonArray);
	echo stripslashes(to_han($output));

?>