<?
/*
$host   = "localhost";  //ȣ��Ʈ��
$dbid   = "yensan";		//���̵�
$dbpass = "fpcm080";	//�н�����
$dbname = "yensan";		//DB�̸�

//$prevurl = $_SERVER[HTTP_REFERER]; �α��� �������̱� �ϱ� ���� ����

function my_connect() { //DB ����
	global $host, $dbid, $dbpass, $dbname;
	$connect=mysql_connect($host,$dbid,$dbpass);
	mysql_select_db($dbname);
	return $connect;
}
*/
function err_msg($msg) {	//�����޼���
	echo("
        <script>
	    window.alert('$msg')
	    history.back()
	    </script>
	");
	exit;
}

function msg($msg) { //���޼���
	echo("
        <script>
	    window.alert('$msg')
	    </script>
	");
}

function meta_read($home,$second="0") {	//URL ����
	echo "<meta http-equiv='Refresh' content='$second; URL=$home'>";
	exit;
}

function page_avg($totalpage,$cpage,$url) {	//�Խ��� ��� ����¡ �Լ�
  	if(!$pagenumber) {	       
		$pagenumber = 10;
	}
  
	$startpage = intval(($cpage - 1) / $pagenumber) * $pagenumber +1  ;
	$endpage = intVal(((($startpage -1) +  $pagenumber) / $pagenumber) * $pagenumber) ;

   	if ($totalpage <= $endpage)
		$endpage = $totalpage;

	if ( $cpage > $pagenumber) {
		$curpage = intval($startpage - 1);
		$url_page = "<a href='$url"."&page=$curpage'>";
		echo("$url_page");
		echo("<img src='http://mart.aqua2000.net/english/company/img/prew_icon.JPG' border='0' width='41' height='16' align='absmiddle'></a>");
		echo("<a href='$url"."&page=1'>[1] .. </a>");
	}
	else{
		echo("<img src='http://mart.aqua2000.net/english/company/img/prew_icon.JPG' border='0' width='41' height='16' align='absmiddle'> ");
	}

	$curpage = $startpage;
   
	while ($curpage <= $endpage): 
	if ($curpage == $cpage) {
		echo "<b>$cpage</b>";
	} else {
		$url_page = "<a href='$url"."&page=$curpage'>";
		echo ("$url_page");
		echo("[$curpage]</a>");
	}
	$curpage++;

	endwhile ;

	if ( $totalpage > $endpage) {
		$curpage = intval($endpage + 1);  
		echo("<a href='$url"."&page=$totalpage'> .. [$totalpage]</a>");
		$url_page = " <a href='$url"."&page=$curpage'>";
		echo ("$url_page");
		echo("<img src='http://mart.aqua2000.net/english/company/img/next_icon.JPG' border='0' width='41' height='16' align='absmiddle'></a>");
		
	}
	else{
		echo(" <img src='http://mart.aqua2000.net/english/company/img/next_icon.JPG' border='0' width='41' height='16' align='absmiddle'></a>");
	}
}


function cutting( $text , $cut_length ){  //���� �ڸ��� �Լ�
	$text_len = strlen( $text ); 
	$trim_len = strlen( substr( $text, 0, $cut_length ) ); 

	if( $text_len > $trim_len ){ 
		for( $jj = 0; $jj < $trim_len; $jj++ ){ 
			$uu = ord( substr( $text, $jj, 1) ); 
			if( $uu > 127 ){ 
				$jj++; 
			} 
		} 
		$text2=substr($text,0,$jj)."..."; 
	}else{ 
		$jj=100; 
		$text2=substr($text,0,$jj); 
	} 

	return $text2; 
} 
?>
