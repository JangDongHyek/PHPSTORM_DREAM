<?
	$DBconnect = mysql_connect("localhost","pusanmakeup","wjsghk!@#"); 
	
	mysql_select_db("pusanmakeup",$DBconnect); 
	$result0 = mysql_query("select * from rg_noticee_body order by rg_top_num desc LIMIT 0,3",$DBconnect);					
	//order by no desc는 no의 최상위 글을 가져오란말입니다 
	//LIMIT 0,5 는 5개를 가져오라는 말입니다. 10개를 가져오시려면 10으로 수정하시면 됩니다.


	$num=0;
	while($row=mysql_fetch_array($result0)){
		$num++;
		$z_num[$num]=trim($row[rg_doc_num]);
		$z_title[$num]=trim($row[rg_title]);
		$z_title[$num]=date("[Y-m-d] ", $row[rg_reg_date]).$z_title[$num];

		echo "&z_num[$num]=$z_num[$num]&z_title[$num]=$z_title[$num]";

	}
		mysql_close($DBconnect);	
		exit;
?>

