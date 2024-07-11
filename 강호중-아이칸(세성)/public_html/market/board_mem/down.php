<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

//현재글의 Download 수를 올림
//mysql_query("update $table set download=download+1 where mart_id=$mart_id and index_no= =$index_no and bbs_no=$bbs_no");

$query = "select * from $New_BoardTable where mart_id='$mart_id' and index_no='$index_no' and bbs_no='$bbs_no'";
$result = mysql_query( $query, $dbconn );
$total = mysql_num_rows($result);

if( $total > 0 ){
	$row = mysql_fetch_array($result);

	$filen = $row[userfile]; // 서버 저장되기 전 원래 파일명
	$user_file = $row[userfile]; // 서버에 저장된 저장된 파일명

	$filen1 = $row[userfile1]; // 서버 저장되기 전 원래 파일명
	$user_file1 = $row[userfile1]; // 서버에 저장된 저장된 파일명
}else{
	echo "<script>window.alert('error')</script>";
    echo "<script>history.back()</script>";
    exit;
}
//------------------------------------------------------


//------------------------------------------------------
//파일을 다운로드 받을 수 있도록 변경
//디렉토리 앞에 붙이고 파일명 합체
//------------------------------------------------------
$upload = "../../up/$mart_id/";

$file = $upload.$user_file; //실제 파일명 또는 경로
$dnfile =  $filen; 

if( $mode == "file" ){
	if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
		if(strstr($HTTP_USER_AGENT, "MSIE 5.5")){ 
			header("Content-Type: doesn/matter"); 
			header("Content-disposition: filename=$dnfile"); 
			header("Content-Transfer-Encoding: binary"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
		} 

		if(strstr($HTTP_USER_AGENT, "MSIE 5.0")){ 
			Header("Content-type: file/unknown"); 
			header("Content-Disposition: attachment; filename=$dnfile"); 
			Header("Content-Description: PHP3 Generated Data"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
		} 

		if(strstr($HTTP_USER_AGENT, "MSIE 5.1")){ 
			Header("Content-type: file/unknown"); 
			header("Content-Disposition: attachment; filename=$dnfile"); 
			Header("Content-Description: PHP3 Generated Data"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
		} 
	  
		if(strstr($HTTP_USER_AGENT, "MSIE 6.0")){
			Header("Content-type: application/x-msdownload"); 
			Header("Content-Length: ".(string)(filesize("$file")));
			Header("Content-Disposition: attachment; filename=$dnfile");   
			Header("Content-Transfer-Encoding: binary");   
			Header("Pragma: no-cache");   
			Header("Expires: 0");   
		}
	}else{ 
		Header("Content-type: file/unknown");     
		Header("Content-Length: ".(string)(filesize("$file"))); 
		Header("Content-Disposition: attachment; filename=$dnfile"); 
		Header("Content-Description: PHP3 Generated Data"); 
		Header("Pragma: no-cache"); 
		Header("Expires: 0"); 
	} 

	if(is_file("$file")){ 
		$fp = fopen("$file", "rb"); 

		if(!fpassthru($fp))  
			fclose($fp); 

	}else{ 
		echo "해당 파일이나 경로가 존재하지 않습니다."; 
	} 
}

$file1 = $upload.$user_file1; //실제 파일명 또는 경로
$dnfile1 =  $filen1; 

if( $mode == "file1" ){
	if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
		if(strstr($HTTP_USER_AGENT, "MSIE 5.5")){ 
			header("Content-Type: doesn/matter"); 
			header("Content-disposition: filename=$dnfile1"); 
			header("Content-Transfer-Encoding: binary"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
		} 

		if(strstr($HTTP_USER_AGENT, "MSIE 5.0")){ 
			Header("Content-type: file/unknown"); 
			header("Content-Disposition: attachment; filename=$dnfile1"); 
			Header("Content-Description: PHP3 Generated Data"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
		} 

		if(strstr($HTTP_USER_AGENT, "MSIE 5.1")){ 
			Header("Content-type: file/unknown"); 
			header("Content-Disposition: attachment; filename=$dnfile1"); 
			Header("Content-Description: PHP3 Generated Data"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
		} 
	  
		if(strstr($HTTP_USER_AGENT, "MSIE 6.0")){
			Header("Content-type: application/x-msdownload"); 
			Header("Content-Length: ".(string)(filesize("$file")));
			Header("Content-Disposition: attachment; filename=$dnfile1");   
			Header("Content-Transfer-Encoding: binary");   
			Header("Pragma: no-cache");   
			Header("Expires: 0");   
		}
	}else{ 
		Header("Content-type: file/unknown");     
		Header("Content-Length: ".(string)(filesize("$file"))); 
		Header("Content-Disposition: attachment; filename=$dnfile1"); 
		Header("Content-Description: PHP3 Generated Data"); 
		Header("Pragma: no-cache"); 
		Header("Expires: 0"); 
	} 

	if(is_file("$file")){ 
		$fp = fopen("$file", "rb"); 

		if(!fpassthru($fp))  
			fclose($fp); 

	}else{ 
		echo "해당 파일이나 경로가 존재하지 않습니다."; 
	} 
}

mysql_free_result( $result );
mysql_close( $dbconn );
?>