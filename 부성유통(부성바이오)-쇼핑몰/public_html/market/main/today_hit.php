<?
$home_dir = getenv("HTTP_HOST");
$cookie_domain = eregi_replace("http://","",$home_dir);
//오늘 쇼핑한 상품을 쿠키에 넣음
if(!$_COOKIE[latest_items]){//쿠키에 처음 제품을 넣을 때
	$_COOKIE[latest_items] = $item_no;
	setcookie("latest_items",$_COOKIE[latest_items], time()+60*60*24,"/", $cookie_domain);//상품코드
}else{//장바구니에 두번째부터 제품이 들어갈 때

	$arr_temp = array();
	$arr_item = explode("|",$_COOKIE[latest_items]);

	for($i=0;$i<count($arr_item), $i<5;$i++){
		if($arr_item[$i] == $item_no ){
			break;
		}
		//echo "<br>arr_item[$i] : ".$arr_item[$i];
	}
	array_splice($arr_item, $i, 1);		// 제일 오래된거나, 중간에 중복되는 아이템은 삭제
	array_push($arr_temp, $item_no);	
	$_COOKIE[latest_items] = implode("|", 	array_merge($arr_temp, $arr_item));

	//현재상품 젤 앞에 등록
	setcookie("latest_items",$_COOKIE[latest_items],time()+60*60*24,"/",$cookie_domain);	
}
?>