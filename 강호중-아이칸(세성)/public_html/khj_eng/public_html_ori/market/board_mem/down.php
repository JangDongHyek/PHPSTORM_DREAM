<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";

//������� Download ���� �ø�
//mysql_query("update $table set download=download+1 where mart_id=$mart_id and index_no= =$index_no and bbs_no=$bbs_no");

$query = "select * from $New_BoardTable where mart_id='$mart_id' and index_no='$index_no' and bbs_no='$bbs_no'";
$result = mysql_query( $query, $dbconn );
$total = mysql_num_rows($result);

if( $total > 0 ){
	$row = mysql_fetch_array($result);

	$filen = $row[userfile]; // ���� ����Ǳ� �� ���� ���ϸ�
	$user_file = $row[userfile]; // ������ ����� ����� ���ϸ�

	$filen1 = $row[userfile1]; // ���� ����Ǳ� �� ���� ���ϸ�
	$user_file1 = $row[userfile1]; // ������ ����� ����� ���ϸ�
}else{
	echo "<script>window.alert('error')</script>";
    echo "<script>history.back()</script>";
    exit;
}
//------------------------------------------------------


//------------------------------------------------------
//������ �ٿ�ε� ���� �� �ֵ��� ����
//���丮 �տ� ���̰� ���ϸ� ��ü
//------------------------------------------------------
$upload = "../../up/$mart_id/";

$file = $upload.$user_file; //���� ���ϸ� �Ǵ� ���
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
		echo "�ش� �����̳� ��ΰ� �������� �ʽ��ϴ�."; 
	} 
}

$file1 = $upload.$user_file1; //���� ���ϸ� �Ǵ� ���
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
		echo "�ش� �����̳� ��ΰ� �������� �ʽ��ϴ�."; 
	} 
}

mysql_free_result( $result );
mysql_close( $dbconn );
?>