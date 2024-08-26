<?
include "./function.inc";
include("./util.php");
$connect = my_connect();

$title = addslashes($title);
$body = addslashes($body);

if($upfile && $upfile != "none"){
	$save_dir = "datafile";
	$dir = $save_dir."/".$upfile_name;

	$file_type = array("php","php3","php4","dat","inc","pl","cgi","phtml","html","dhtml","asp","txt");
	$file_count = sizeof($file_type);

	$file_detail = explode(".",$upfile_name);

	for($i=0;$i < $file_count;$i++){
		if(!strcmp($file_type[$i],$file_detail[1])){
			$error_msg = $file_detail[1]." 형식의 파일은 업로드 하실 수 없습니다.";
			error($error_msg); exit;
		}
	}

	$same_file_exist = file_exists($dir);

	if($same_file_exist){ error("동일한 이름의 파일이 존재합니다."); exit;}
	if(!copy($upfile,"$save_dir/$upfile_name")){ error("파일을 저장 할 수 없습니다."); exit; }
	if(!unlink($upfile)){ error("임시 파일을 삭제 할 수 없습니다."); exit; }
}

if($mode == "write") {
	$result = mysql_query("select MAX(thread) from $board");
	$row = mysql_fetch_row($result);
	$thread = $row[0]+1;

$reserv_date = $reserv_date1."/".$reserv_date2."/".$reserv_date3."/".$reserv_date4."/".$reserv_date5;
$reserv_phone = $reserv_phone1."-".$reserv_phone2."-".$reserv_phone3;
$reserv_mobile = $reserv_mobile1."-".$reserv_mobile2."-".$reserv_mobile3;

	$body_trim = eregi_replace("<br>","",$body);
	$result = mysql_query("insert into $board values('','$reserv_email', '$reserv_bunryu', '$reserv_kyukuk', '$reserv_jaejil', '$reserv_insoi', '$reserv_coting', '$reserv_gibonnum','$reserv_phone','$reserv_name','$HTTP_COOKIE_VARS[BEAUTYE_EMAIL]','$home','$title','$body',now(),'$count','$thread','$depth','$pos',password('$passwd'),'$dir','','','','$new_thread','$HTTP_COOKIE_VARS[BEAUTYE_ID]','$code_url','$board_type','$body2')");


//echo"insert into $board values('','$reserv_inwon','$reserv_date','$reserv_phone','$reserv_mobile','$name','$HTTP_COOKIE_VARS[BEAUTYE_EMAIL]','$home','$title','$body',now(),'$count','$thread','$depth','$pos',password('$passwd'),'$dir','','','','$new_thread','$HTTP_COOKIE_VARS[BEAUTYE_ID]','$code_url','$board_type','$body2')";
//exit;

} else if($mode == "reply") {
	
	$depth++;
	$sql_thread = mysql_query("select thread2,right(thread2,1) from $board where code='$code_url' and thread='$thread' and length(thread2) = length('$thread2')+1 and locate('$thread2',thread2)=1 order by thread2 desc limit 1");

	if(!$sql_thread){	error("QUERY_ERROR");	exit; }
	$count = mysql_num_rows($sql_thread);

	if($count){
		$row = mysql_fetch_row($sql_thread);
		$thread_head = substr($row[0],0,-1);
		$thread_tail=++$row[1];
		$new_thread = $thread_head.$thread_tail;
	}else{
		$new_thread = $thread2."A";
	}
$reserv_date = $reserv_date1."/".$reserv_date2."/".$reserv_date3."/".$reserv_date4."/".$reserv_date5;
$reserv_phone = $reserv_phone1."/".$reserv_phone2."/".$reserv_phone3;
$reserv_mobile = $reserv_mobile1."/".$reserv_mobile2."/".$reserv_mobile3;
$result = mysql_query("insert into $board values('','$reserv_inwon','$reserv_date','$reserv_phone','$reserv_mobile','$name','$HTTP_COOKIE_VARS[BEAUTYE_EMAIL]','$home','$title','$body',now(),'1','$thread','$depth','$pos',password('$passwd'),'$dir','','','','$new_thread','$HTTP_COOKIE_VARS[BEAUTYE_ID]','$code_url','$board_type')");

$max_sql=@mysql_query("select max(id) from $board where code='$code_url'");
db_error($max_sql,"아이디호출오류");

$max_id=@mysql_result($max_sql,0,0);

} else if($mode == "modify") {
	if($upfile && $upfile != "none"){
		$rep_sql = mysql_query("select user_file from $board where id = $uid");
		db_error($rep_sql,"질의문 오류~");
		
		$rep_rows = mysql_fetch_array($rep_sql);

		if($rep_rows[user_file]) {
			if(!unlink($rep_rows[user_file])){ error("이전 파일을 삭제 할 수 없습니다."); exit; }
		}

		$result = mysql_query("update $board set name='$name', title='$title',body='$body',count='$count',user_file='$dir',body2='$body2' where id='$uid'");
	} else {
		$result = mysql_query("update $board set name='$name', title='$title',body='$body',count='$count',body2='$body2' where id='$uid'");
	}
}else if(!strcmp($mode,"delete")){ //--- Process Delete!!
	$result_d = mysql_query("select * from $board where id='$uid'");
	$row_d = mysql_fetch_array($result_d);
	if($row_d[user_file]){ if(!unlink($row_d[user_file])){ error("[$row_d[user_file]] 파일을 삭제 할 수 없습니다."); exit; }}

	$result= mysql_query("delete from $board where id='$uid'");
	db_error($result,"글삭제에 실패하였습니다!");

	print "<script>alert('글이 삭제되었습니다!!');</script>";
	print "<meta http-equiv='Refresh' content='0; URL=$code_url?set=list&board=$board&uid=$uid&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'>";
	exit;
}



if($result) {
		print "<script>alert('접수되었습니다!');</script>";

    print "<meta http-equiv='Refresh' content='0; URL=$code_url?set=write&board=$board&uid=$uid&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'>";
    exit;
} else {
    print "새글 입력 중 오류가 발생했습니다.";
}
?>