<?
	$DBconnect = mysql_connect("localhost","pusanmakeup","wjsghk!@#"); 
	
	mysql_select_db("pusanmakeup",$DBconnect); 
	$result0 = mysql_query("select * from rg_noticee_body order by rg_top_num desc LIMIT 0,3",$DBconnect);					
	//order by no desc�� no�� �ֻ��� ���� �����������Դϴ� 
	//LIMIT 0,5 �� 5���� ��������� ���Դϴ�. 10���� �������÷��� 10���� �����Ͻø� �˴ϴ�.


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

