<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect_login.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?

$est_qry = "select * from $EstimateTable where mart_id='$mart_id' and estimate_ok='y'";
$est_result = mysql_query( $est_qry, $dbconn );



for($i=0;$rows=mysql_fetch_array($est_result);$i++){


	$mart_id = "koreainsam";
	$bbs_no = "11";



	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	//=================== 쓰레드 찾기 ========================================================
	$query2 = "select MAX(thread) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$result2 = mysql_query( $query2, $dbconn );
	$row2 = mysql_fetch_array( $result2 );
	$thread = $row2[0] + 1;

	//=================== 포지션 찾기 ========================================================
	$query3 = "select MIN(ansno) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'" ;
	$result3 = mysql_query( $query3, $dbconn );
	$row3 = mysql_fetch_array( $result3 );
	$ansno = $row3[0] + 1;

	//=================== 질문이후의 글들의 AnsNo 를 1씩 증가시킴 ========================
	$query4 = "update $New_BoardTable set ansno = ansno + 1 where (ansno > 0) and mart_id = '$mart_id' and bbs_no='$bbs_no'";
	mysql_query( $query4, $dbconn );

	//============= 최고 index_no 값을 찾아서 1을 더해주고 이 uid 값을 insert 시켜줌 =========
	$query6 = "select MAX(index_no) from $New_BoardTable where mart_id = '$mart_id'";
	$result6 = mysql_query( $query6, $dbconn );
	$row6 = mysql_fetch_array( $result6 );
	$index_no = $row6[0] + 1;
	
	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);







	$area = $rows[item_no]; //제품번호
	$subject_new = $rows[title]; //제목
	$content = $rows[content]; //내용
	$writer = $rows[name];//글쓴이
	$email = $rows[email];
	$write_date = $rows[write_date];
	$username=$rows[username];
	$point = $rows[point];

	$sql = "insert into new_board (index_no,bbs_no,mart_id,code,username,writer,write_date,ansno,step,thread,email,content,subject_new,notice_no,area,point) values ('$index_no','11','koreainsam','0','$username','$writer','$write_date','1','0','$thread','$email','$content','$subject_new','0','$area','$point')";
	//echo $sql."<br>";
	$result = mysql_query( $sql, $dbconn );

}
?>