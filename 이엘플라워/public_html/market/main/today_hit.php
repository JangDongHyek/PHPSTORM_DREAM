<?
$home_dir = getenv("HTTP_HOST");
$cookie_domain = eregi_replace("http://","",$home_dir);
//���� ������ ��ǰ�� ��Ű�� ����
if(!$_COOKIE[latest_items]){//��Ű�� ó�� ��ǰ�� ���� ��
	$_COOKIE[latest_items] = $item_no;
	setcookie("latest_items",$_COOKIE[latest_items], time()+60*60*24,"/", $cookie_domain);//��ǰ�ڵ�
}else{//��ٱ��Ͽ� �ι�°���� ��ǰ�� �� ��

	$arr_temp = array();
	$arr_item = explode("|",$_COOKIE[latest_items]);

	for($i=0;$i<count($arr_item), $i<5;$i++){
		if($arr_item[$i] == $item_no ){
			break;
		}
		//echo "<br>arr_item[$i] : ".$arr_item[$i];
	}
	array_splice($arr_item, $i, 1);		// ���� �����Ȱų�, �߰��� �ߺ��Ǵ� �������� ����
	array_push($arr_temp, $item_no);	
	$_COOKIE[latest_items] = implode("|", 	array_merge($arr_temp, $arr_item));

	//�����ǰ �� �տ� ���
	setcookie("latest_items",$_COOKIE[latest_items],time()+60*60*24,"/",$cookie_domain);	
}
?>