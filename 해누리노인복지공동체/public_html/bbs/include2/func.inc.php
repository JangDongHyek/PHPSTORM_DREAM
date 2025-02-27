<?
if (!defined('FUNC_INC_INCLUDED')) {  
    define('FUNC_INC_INCLUDED', 1);
// *-- FUNC_INC_INCLUDED START --*

	// 영어와 숫자로 이루어져 있는 지.
	function  rg_alpa_check($str) { 
		return eregi("^([a-z0-9-])*$", $str); 
	} 
	
	// 영,숫자랜덤값을 길이만큼 발생시킨다. 
	function rg_get_uniqid($len) {
		return substr(md5(uniqid(rand())), 0, $len);
	}

	// 홈페이지 입력시 http 로 시작하는지 체크하여
	// 아닐 경우 http:// 를 붙인다.
	function rg_homepage_chk($str) {
		if($str == '')
			return '';

		if(strtolower($str) == 'http://')
			return '';

		if(eregi('^(http://)',strtolower($str)))
			return $str;

		return 'http://'.$str;
	}

	function rg_date($time,$format='%Y-%m-%d %H:%M:%S') {
		if(!$format) $format='%Y-%m-%d %H:%M:%S';
		return strftime($format,$time);
	}	
	
	// 페이지 이동 함수(액셔이후 처리)
	function rg_href($url='',$msg='',$target='',$action='',$charset='euc-kr'){
	/*		if(func_num_args()>0)
			$arg_list = func_get_args();
		} else {
			return false;
		}
	*/
		$script="";
	
		if($msg) {
			$script.="\nalert('$msg');\n;";
		}
		if($url && !$action) {
			if($target)
				$script.="\n$target.location.replace('$url');\n";
			else
				$script.="\nlocation.replace('$url');\n";
		}
		switch($action) {
			case 'back' : 
					$script.="\nhistory.back();\n";
					break;
			case 'close' : 
					$script.="\nself.close();\n";
					break;
			case '';
					break;
		}
		
		echo "
<HTML><HEAD>
<META HTTP-EQUIV=Content-Type CONTENT=text/html;charset=$charset>
<SCRIPT LANGUAGE=JavaScript>
<!--
$script
//-->
</SCRIPT></html>
		";
		exit;
	}
	
	// base64로 인코딩 하여 메일을 보낸다.
	function rg_mail($from,$to,$cc,$bcc,$subject,$message) {
		if($cc) $cc = "cc : $cc\n";
		if($bcc) $bcc = "bcc : $bcc\n";
		$headers = "From: $from_name <$from>\n";
		$headers .= "X-Sender: <$from>\n";
		$headers .= "X-Mailer: PHP ".phpversion()."\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "Return-Path: <$from>\n";
		//if(!$type) $headers .= "Content-Type: text/plain; ";
		$headers .= "Content-Type: text/html; ";
		$headers .= "charset=euc-kr\n";
		$headers .= "Content-Transfer-Encoding: base64";
  
		// 내용(base64로 인코딩한다)
		$message = chunk_split(base64_encode($message)); 
		return mail($to,$subject,$message,$headers);
	}
				
	// TEXT 형식 변환
	function rg_conv_text($str, $html='0')
	{
		switch($html) {
			case '1' : 
						$str = $str."<!--\"<--></xml></script></iframe>";
					break;		
			case '2' : 
						$str = nl2br($str)."<!--\"<--></xml></script></iframe>";
					break;		
			default : 
						$str=rg_get_text($str,1);
						$str=rg_autolink($str);
					break;
		}
		return $str;
	}			
				
	// TEXT 형식으로 변환
	function rg_get_text($str, $nl2br=0)
	{
			$source[] = "/  /";
			$target[] = " &nbsp;";
			$source[] = "/</";
			$target[] = "&lt;";
			$source[] = "/>/";
			$target[] = "&gt;";
			$source[] = "/\"/";
			$target[] = "&#034;";
			$source[] = "/\'/";
			$target[] = "&#039;";
			$source[] = "/}/";
			$target[] = "&#125;";
			if ($nl2br) {
					$source[] = "/\n/";
					$target[] = "<br>";
			}
	
			return preg_replace($source, $target, $str);
	}

	// 현재 스크립트의 URL 을 얻는다
	function rg_get_current_url()
	{
			global $HTTP_SERVER_VARS;
			
			// 프로토콜 구하기 
			$protocol = strtolower($HTTP_SERVER_VARS["SERVER_PROTOCOL"]);
			$protocol = preg_replace('/(\/.*)/', '', $protocol);
			
			// 서버의 포트번호가 80이 아닐경우 포트번호 지정(보드 수정)
			$port = $HTTP_SERVER_VARS['SERVER_PORT'];
			$port = ($port!='80')?':'.$port:'';
			
			$host = $HTTP_SERVER_VARS['HTTP_HOST'];
			$url = $protocol.'://'.$host.$port.dirname($HTTP_SERVER_VARS['PHP_SELF']);
			
			// 끝에 / 이 없으면 붙이기
			if(!preg_match("/(\/)$/",$url)) $url .= '/';

			return $url;
	}	
	
	// 2003-05-31 01:22:11 형식의 날자를 TimeStemp 형식으로 변환한다.
	function rg_str2time($DateTimeStr) {
		$Tmp=explode(" ", $DateTimeStr);
		$Date=explode("-", $Tmp[0]);
		$Time=explode(":", $Tmp[1]);
	
		// 시 분 초 월 일 년
		return mktime($Time[0],$Time[1],$Time[2],$Date[1],$Date[2],$Date[0]+$PayYear);
	}

	// 배열을 이용하여 <option> 태그를 발생시킨다.
	// $options 는 배열또는 이중배열이다.
	function rg_html_option($options,$key_field='',$text_field='',$default=NULL,$text_key=false) {
		$_result = '';
		$selected = false;

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;

		reset($options);
		while(list($key,$value)=each($options)) {
		
			if($key_field && $text_field) { // 키필드와 텍스트가 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // 키필드만 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // 텍스트필드만 있다면
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // 둘다 없다면
				if($text_key)
					$o_key = $value;
				else
					$o_key = $key;				
				$o_text = $value;
			}
			
			if(($default!=NULL) && (!$selected) && ($o_key==$default)) {
				$_result .= "<option value='$o_key' selected>$o_text</option>\n";
				$selected=true;
			} else {
				$_result .= "<option value='$o_key'>$o_text</option>\n";
			}
		}
		return $_result;
	}

	function rg_category_make($options,$key_field='',$text_field='',$default=NULL)
	{
		global $bbs_id, $p_str;
		$_result = '';

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;

		reset($options);

		$_result .= "<a href=\"./list.php?bbs_id=$bbs_id\">전체</a> | \n";

		while(list($key,$value)=each($options)) {

			if($key_field && $text_field) { // 키필드와 텍스트가 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // 키필드만 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // 텍스트필드만 있다면
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // 둘다 없다면
				if($text_key)
					$o_key = $value;
				else
					$o_key = $key;				
				$o_text = $value;
			}

			if($default == $key) {
				$_result .= "$o_text | \n";
			} else {
				$_result .= "<a href=\"./list.php?bbs_id=$bbs_id&ss[fc]=$o_key\">$o_text</a> | \n";
			}
		}
		return $_result;
	}
		
	// 레코드셋의 필드를 이용하여 <option> 태그를 발생시킨다.
	function rg_sql_html_option($rs,$key_field,$text_field='',$default=NULL) {
		global $dbcon;
		$_result = '';
		$selected = false;
		if(!$rs) return false;

		if($text_field=='')$text_field=$key_field;
		while ($R=mysql_fetch_array($rs)) {
			if(($default!=NULL) && (!$selected) && ($R[$key_field]==$default)) {
				$_result .= "<option value='$R[$key_field]' selected>$R[$text_field]</option>\n";
				$selected=true;
			} else {
				$_result .= "<option value='$R[$key_field]'>$R[$text_field]</option>\n";
			}
		}
		return $_result;
	}
	
	// 배열을 이용하여 radio 태그를 발생시킨다.
	// $options 는 배열또는 이중배열이다.
	function rg_html_radio($options,$form_name,$key_field=NULL,$text_field='',$default='',$tag1='',$tag2='') {
		$_result = '';
		$selected = false;

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;
		
		reset($options);
		while(list($key,$value)=each($options)) {
		
			if($key_field && $text_field) { // 키필드와 텍스트가 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // 키필드만 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // 텍스트필드만 있다면
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // 둘다 없다면
				$o_key = $key;
				$o_text = $value;
			}
			
			if(($default!=NULL) && (!$selected) && ($o_key==$default)) {
				$_result .= "$tag1<input type=radio name='$form_name' value='$o_key' checked>$o_text$tag2\n";
				$selected=true;
			} else {
				$_result .= "$tag1<input type=radio name='$form_name' value='$o_key'>$o_text$tag2\n";
			}
		}
		return $_result;
	}
	
	# 사용자 정의 폼을 만든다.
	# 1, 필드명
	# 2, 형태
	# 3, 값
	# 4, 기본값
	# 작성자 : 윤범석
	
	function rg_makeform($form_name, $type, $values, $default_value='') {
		if(func_num_args()>3) { // 기본값입력이 있다면 기본값 체크
			$m = true;
		} else {
			$m = false;
		}
								
		$select_box = false;
								
		$tmp = explode("|", $values);
		
		if($type=='2') { // 텍스트 박스 1번째 길이, 2번째 기본값
			if($m) $tmp[2]=$default_value;
			$result = "<input name=\"$form_name\" type=\"text\" id=\"$form_name\" $tmp[0] itemname='$tmp[1]' value=\"$tmp[2]\" size=\"$tmp[3]\" class=b_input>\n";
			return $result;
		}
		
		if($type=='5') { // 텍스트 에리어 1번째 cols, 2번째 rows, 3번째 기본값
			if($m) $tmp[4]=$default_value;
			$result = "<textarea name=\"$form_name\" $tmp[0] itemname='$tmp[1]' cols=\"$tmp[2]\" rows=\"$tmp[3]\" class=\"b_textarea\">$tmp[4]</textarea>";
			return $result;
		}
		
		for ($i = 0; $i < sizeof($tmp); $i++) {
			$tmp[$i] = trim($tmp[$i]);
			if (ereg("^\!",$tmp[$i])) {
				$tmp[$i] = ereg_replace("^\!", "", $tmp[$i]);
				if ( !$m ||
				   ($m && $default_value == $tmp[$i])) {
					$default = 1; 
				}	else {
					$default = 0; 
				}
			}	elseif ($m && $default_value == $tmp[$i]) {
				$default = 1;
			}	else {
				$default = 0; 
			}
			switch ($type) {
				case 1 : // 라디오버튼
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$return .= "<input type=radio name=\"$form_name\" id=\"{$form_name}_$i\" VALUE=\"$tmp[$i]\"";
								if ($default) { $return .= " checked"; }
								$return .= "><label for=\"{$form_name}_$i\">$tmp[$i]</label>\n";
								break;
				case 3 : // 셀렉트박스
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$select_box = true;
								$return .= "<option value=\"$tmp[$i]\"";
								if ($default) { $return .= " selected"; }
								$return .= ">$tmp[$i]</option>\n";
								break;
				case 4 : // 체크박스 처음! 기본체크, 좌측문항, 우측값
								if(empty($tmp[$i+1])) break;
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$tmp[$i+1] = htmlspecialchars($tmp[$i+1]);
								$checkbox_value = trim($tmp[$i+1]);
								$checkbox = "<input type=\"checkbox\" name=\"$form_name\" id=\"{$form_name}\" value=\"$checkbox_value\"";
								if ($default || $default_value == $checkbox_value) {
									$checkbox .= " checked";
								}
								$checkbox .= ">";
								$tmp[$i]=str_replace("{}",$checkbox,$tmp[$i]);
								$return .= "<label for=\"{$form_name}\">$tmp[$i]</label>\n";
								$i++;
								break;				
			}	
		}
		if ($select_box) {
			$return = "<select name=\"$form_name\">\n$return</select>\n";
		} 
		return $return;
	} // *-- rg_makeform --*
		
	// 사이트 설정 읽어옴
	function rg_get_site_cfg() {
		global $dbcon,$db_table_site_cfg;
	
		$dbqry = "
			SELECT *
				FROM `$db_table_site_cfg`
			";
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		return $r;
	}
		
	// 게시판 설정 읽어옴
	function rg_get_bbs_cfg($key,$type=0) {
		global $dbcon,$db_table_bbs_cfg;
	
		switch ($type) {
			case 1 : // 게시판고유번호로
				$dbqry = "SELECT *
									FROM `$db_table_bbs_cfg`
									WHERE bbs_num='$key'";
				break;
			default : // 기본 아이디로
				$dbqry = "SELECT *
									FROM `$db_table_bbs_cfg`
									WHERE bbs_id='$key'";
				break;
		}
		$rs = query($dbqry,$dbcon);

		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		return $r;
	}
	
	// 그룹 설정 읽어옴
	function rg_get_group_cfg($key,$type=0) {
		global $dbcon,$db_table_group_cfg;
	
		switch ($type) {
			case 1 : // 그룹고유번호로
				$dbqry = "SELECT *
									FROM `$db_table_group_cfg`
									WHERE gr_num='$key'";
				break;
			default : // 기본 아이디로
				$dbqry = "SELECT *
									FROM `$db_table_group_cfg`
									WHERE gr_id='$key'";
				break;
		}
		$rs = query($dbqry,$dbcon);

		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		return $r;
	}
	
	// 회원 설정 읽어옴
	function rg_get_member_info($key,$type=0) {
		global $dbcon,$db_table_member;
	
		switch ($type) {
			case 1 : // 회원번호로
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_num='$key'";
				break;
			case 2 : // 닉네임으로
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_nick='$key'";
				break;
			case 3 : // 주민등록번호로
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_jumin='$key'";
				break;
			default : // 기본 아이디로
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_id='$key'";
				break;
		}
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $r;
	}

	// 회원 메모 갯수를 읽어온다
	function rg_get_memo_count($key,$type=0) {
		global $dbcon,$db_table_memo;
	
		$dbqry = "SELECT count(*)
							FROM `$db_table_memo`
							WHERE mo_recv_mb_num='$key'";
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $r[0];
	}
	
	// 그룹/회원 설정 읽어옴
	function rg_get_group_member_info($gr_key,$mb_key='',$type='') {
		global $dbcon,$db_table_group_member,$db_table_member;
		/*
		 $type 
		 	 0: 그룹아이디,회원아이디
			 1: 그룹아이디,회원번호
		   2: 그룹번호,회원번호
			 3: 그룹번호,회원아이디
			 4: 그룹회원번호
		*/
		
		switch ($type) {
			case 1 : 
				$tmp = rg_get_group_cfg($gr_key);
				$gr_key = $tmp[gr_num];
				unset($tmp);
				break;
			case 2 :
				break;
			case 3 :
				$tmp = rg_get_member_info($mb_key);
				$mb_key = $tmp[mb_num];
				unset($tmp);
				break;
			case 4 :
				break;
			default : 
				$tmp = rg_get_group_cfg($gr_key);
				$gr_key = $tmp[gr_num];
				
				$tmp = rg_get_member_info($mb_key);
				$mb_key = $tmp[mb_num];
				unset($tmp);
				break;
		}
		if($type==4) {
			$dbqry = "SELECT *
								FROM `$db_table_group_member`
								WHERE gm_num='$gr_key'";
		} else {
			$dbqry = "SELECT *
								FROM `$db_table_group_member`
								WHERE gm_gr_num='$gr_key'
									AND gm_mb_num='$mb_key'";
		}	
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $r;
	}
	
	// 문서를 한장(?) 읽어온다
	function rg_get_doc_info($bbs_id,$key,$type='0') {
		global $dbcon,$db_table_prefix,$db_table_suffix_body;
		$table = $db_table_prefix.$bbs_id.$db_table_suffix_body;

		switch ($type) {
			case 1 : // next_num 으로
				$dbqry = "SELECT *
									FROM `$table`
									WHERE rg_next_num='$key'";
				break;
			default : // 문서번호로
				$dbqry = "SELECT *
									FROM `$table`
									WHERE rg_doc_num='$key'";
				break;
		}
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $r;
	}
	
	// 쪽지한장을 읽어온다.
	function get_memo_doc($mo_num)
	{
		global $dbcon,$db_table_memo,$db_table_member;

		$dbqry = "
			SELECT $db_table_memo.*,a.mb_id as mo_send_mb_id,
						 b.mb_id as mo_recv_mb_id
			FROM `$db_table_memo`,
					 `$db_table_member` a,
					 `$db_table_member` b
			WHERE `mo_num`='$mo_num'
				AND a.mb_num=mo_send_mb_num
				AND b.mb_num=mo_recv_mb_num		
		";
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $r;
	}

	// 회원의 포인트를 증가,감소한다. 
	function rg_set_point($key,$point,$type='0') {
		global $dbcon,$db_table_member,$bbs,$site;
		$now = time();

		if(!$point || !$key) {
			return false;
		}

		switch ($type) {
			case 1 : // 회원번호로 
				$where_str = " mb_num='$key' ";
				break;
			default : // 아이디로 
				$where_str = " mb_id='$key' ";
				break;
		}
		
		$dbqry = "
			UPDATE `$db_table_member` SET
				`mb_today_point` = 0,
				`mb_point_date` = '$now'
			WHERE $where_str
				AND TO_DAYS(FROM_UNIXTIME('$now')) > TO_DAYS(FROM_UNIXTIME(mb_point_date))
		";
		query($dbqry,$dbcon);

		$dbqry = "
			UPDATE `$db_table_member` SET
				`mb_point` = `mb_point` + '$point',
				`mb_today_point` = `mb_today_point` + '$point'			
			WHERE $where_str
				AND `mb_today_point` <  '$site[st_today_max_point]'
		";
		query($dbqry,$dbcon);

	}

	// 투표 설정 읽어옴 2003-10-14
	function rg_get_vote_cfg($key) {
		global $dbcon,$db_table_vote;
	
		$dbqry = "SELECT *
							FROM `{$db_table_vote}_cfg`
							WHERE vt_num='$key'";
		$rs = query($dbqry,$dbcon);

		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		return $r;
	}

	// 현재 접속자상태를 구한다. 
	function rg_get_connect_count($type='total',$key='') {
		global $dbcon,$db_table_connect;

		switch ($type) {
			case 'login' : // 로그인사용자 
				$where_str = " AND `con_mb_id` <> '' ";
				break;
			case 'nologin' : // 로그인 하지 않은 사용자 
				$where_str = " AND `con_mb_id` = '' ";
				break;
			case 'total' : // 전체 접속자 수
			default :
				$where_str = "";
				break;
		}
		
		$dbqry = "
			SELECT count(*)
			FROM `$db_table_connect`
			WHERE (1=1) $where_str
		";
		$rs = query($dbqry,$dbcon);
	
		if(mysql_num_rows($rs)==0) return false;
		$r=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $r[0];
	}
	
	// 문자열을 mysql password함수를 이용하여 암호화 한다.
	function get_password_str($str) {
/*
	// mysql 4.1.0 부터 passowrd 함수의 값이 무작위로 변경되어 
	// 기존 password 함수와 동일한 알고리즘의 코드로 바뀌었다.
		$nr = 1345345333;
		$add = 7;
		$nr2 = 0x12345671;
		
		$size = strlen($pass);
		for($i=0;$i<$size;$i++)
		{
      // skipp space in password 
			if($pass[$i] == ' ' || $pass[$i] == '\t') continue;  
			$tmp = ord($pass[$i]);
			$nr ^= ((($nr & 63)+$add)*$tmp) + ($nr << 8);
			$nr2 += ($nr2 << 8) ^ $nr;
			$add += $tmp;
		}
		$result1=$nr & ((1 << 31) -1); // Don't use sign bit (str2int)
		$result2=$nr2 & ((1 << 31) -1);
		$result = sprintf("%08x%08x",$result1,$result2);
		return $result; */
		// 일부 서버에서 위 암호화 알고리즘이 듣지 않는것 같다
		// mysql 버전을 체크하여 암호화 한다
		
		global $dbcon;
		// mysql서버의 버전을 구한다
		$rs = query("SHOW VARIABLES like 'version'",$dbcon);
		$tmp=mysql_fetch_array($rs);
		mysql_free_result($rs);
		list($mysql_version)=explode('.',$tmp[1]);
		
		// mysql 4.1 부터 password 함수가 old_password 로바뀌었다.
		if($mysql_version>3) { // 4.0 버전 이상이라면
			$rs = query("SELECT old_password('$str')",$dbcon);
		} else { // 3.xx 버전 이하라면
			$rs = query("SELECT password('$str')",$dbcon);
		}
		
		$tmp=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $tmp[0];
	}

	// 문자열 자르기. 
	function rg_cut_string($string, $length, $suffix="...") { 
		if (strlen($string) <= $length)
			return $string; 
		$cpos = $length - 1; 
		$count_2B = 0; 
		$lastchar = $string[$cpos]; 
		while (ord($lastchar)>127 && $cpos>=0) { 
			$count_2B++; 
			$cpos--; 
			$lastchar = $string[$cpos]; 
		}
		if($count_2B % 2) $length--;
		return substr($string, 0, $length).$suffix; 
	} 

	# 파일 크기 출력 함수
	# $bfsize 변수는 bytes 단위의 크기임
	#
	# number_formant() - 3자리를 기준으로 컴마를 사용
	function rg_human_fsize_lib($bfsize, $sub = "0") {
		$BYTES = number_format($bfsize) . " Bytes";
	
		if($bfsize < 1024) // Bytes 범위
			return $BYTES;
		else if($bfsize < 1048576) // KBytes 범위
			$bfsize = number_format(round($bfsize/1024)) . " KB";
		else if($bfsize < 1073741827) // MB 범위
			$bfsize = number_format(round($bfsize/1048576)) . " MB";
		else // GB 범위
			$bfsize = number_format(round($bfsize/1073741827)) . " GB";
	
		if($sub) $bfsize .= "($BYTES)";
	
		return $bfsize;
	}	
		
	# 문서 내용에 있는 URL들을 찾아내어 자동으로 링크를 구성해주는 함수
	function rg_autolink(&$str) {
	//  $agent = get_agent_lib();
	
		$regex[file] = "gz|tgz|tar|gzip|zip|rar|mpeg|mpg|exe|rpm|dep|rm|ram|asf|ace|viv|avi|mid|gif|jpg|png|bmp|eps|mov";
		$regex[file] = "(\.($regex[file])\") TARGET=\"_blank\"";
		$regex[http] = "(http|https|ftp|telnet|news|mms):\/\/(([\xA1-\xFEa-z0-9:_\-]+\.[\xA1-\xFEa-z0-9,:;&#=_~%\[\]?\/.,+\-]+)([.]*[\/a-z0-9\[\]]|=[\xA1-\xFE]+))";
		$regex[mail] = "([\xA1-\xFEa-z0-9_.-]+)@([\xA1-\xFEa-z0-9_-]+\.[\xA1-\xFEa-z0-9._-]*[a-z]{2,3}(\?[\xA1-\xFEa-z0-9=&\?]+)*)";
	
		# &lt; 로 시작해서 3줄뒤에 &gt; 가 나올 경우와
		# IMG tag 와 A tag 의 경우 링크가 여러줄에 걸쳐 이루어져 있을 경우
		# 이를 한줄로 합침 (합치면서 부가 옵션들은 모두 삭제함)
		$src[] = "/<([^<>\n]*)\n([^<>\n]+)\n([^<>\n]*)>/i";
		$tar[] = "<\\1\\2\\3>";
		$src[] = "/<([^<>\n]*)\n([^\n<>]*)>/i";
		$tar[] = "<\\1\\2>";
		$src[] = "/<(A|IMG)[^>]*(HREF|SRC)[^=]*=[ '\"\n]*($regex[http]|mailto:$regex[mail])[^>]*>/i";
		$tar[] = "<\\1 \\2=\"\\3\">";
	
		# email 형식이나 URL 에 포함될 경우 URL 보호를 위해 @ 을 치환
		$src[] = "/(http|https|ftp|telnet|news|mms):\/\/([^ \n@]+)@/i";
		$tar[] = "\\1://\\2_HTTPAT_\\3";
	
		# 특수 문자를 치환 및 html사용시 link 보호
		$src[] = "/&(quot|gt|lt)/i";
		$tar[] = "!\\1";
		
		// 3.0.11 에서 추가
		$src[] = "/&#034;/i";
		$tar[] = "\"";
		$src[] = "/&#039;/i";
		$tar[] = "'";
		$src[] = "/&#125;/";
		$tar[] = "}";
			
		$src[] = "/<a([^>]*)href=[\"' ]*($regex[http])[\"']*[^>]*>/i";
		$tar[] = "<A\\1HREF=\"\\3_orig://\\4\" TARGET=\"_blank\">";
		$src[] = "/href=[\"' ]*mailto:($regex[mail])[\"']*>/i";
		$tar[] = "HREF=\"mailto:\\2#-#\\3\">";
		$src[] = "/<([^>]*)(background|codebase|src)[ \n]*=[\n\"' ]*($regex[http])[\"']*/i";
		$tar[] = "<\\1\\2=\"\\4_orig://\\5\"";
	
		# 링크가 안된 url및 email address 자동링크
		$src[] = "/((SRC|HREF|BASE|GROUND)[ ]*=[ ]*|[^=]|^)($regex[http])/i";
		$tar[] = "\\1<A HREF=\"\\3\" TARGET=\"_blank\">\\3</a>";
		$src[] = "/($regex[mail])/i";
		$tar[] = "<A HREF=\"mailto:\\1\">\\1</a>";
		$src[] = "/<A HREF=[^>]+>(<A HREF=[^>]+>)/i";
		$tar[] = "\\1";
		$src[] = "/<\/A><\/A>/i";
		$tar[] = "</A>";
	
		# 보호를 위해 치환한 것들을 복구
		$src[] = "/!(quot|gt|lt)/i";
		$tar[] = "&\\1";

		$src[] = "/(http|https|ftp|telnet|news|mms)_orig/i";
		$tar[] = "\\1";
		$src[] = "'#-#'";
		$tar[] = "@";
		$src[] = "/$regex[file]/i";
		$tar[] = "\\1";
	
		# email 주소를 변형한 뒤 URL 속의 @ 을 복구
		$src[] = "/_HTTPAT_/";
		$tar[] = "@";
	
		# 이미지에 보더값 0 을 삽입
		$src[] = "/<(IMG SRC=\"[^\"]+\")>/i";
		$tar[] = "<\\1 BORDER=0>";
	
		# IE 가 아닌 경우 embed tag 를 삭제함
		if($agent[br] != "MSIE") {
			$src[] = "/<embed/i";
			$tar[] = "&lt;embed";
		}
	
		$str = preg_replace($src,$tar,$str);
		return $str;
	}
		
	/*******************************************************************************
	* 주민번호 검사
	******************************************************************************/
	function rg_check_jumun($reginum) { 
		$weight = '234567892345'; // 자리수 weight 지정 
		$len = strlen($reginum); 
		$sum = 0; 
		
		if ($len <> 13) { return false; } 
		
		for ($i = 0; $i < 12; $i++) { 
			$sum = $sum + (substr($reginum,$i,1)*substr($weight,$i,1)); 
		} 
		
		$rst = $sum%11; 
		$result = 11 - $rst; 
		
		if ($result == 10) {$result = 0;} 
		else if ($result == 11) {$result = 1;} 
		
		$jumin = substr($reginum,12,1); 
		
		if ($result <> $jumin) {return false;} 
		return true; 
	} 
	
	// 페이지 계산, 현재페이지 교정, 시작위치 지정
	function rg_navigation(&$page,$row_count,$page_size=10,$display_page=10) {
		if(empty($page_size)) $page_size = 10;
		if(empty($display_page)) $display_page = 10;
	
		$_result = array();
		$total_page=ceil($row_count/$page_size);
		if($page>$total_page) $page=$total_page;
		if(empty($page)) $page = 1;
	
		$start_row=($page-1)*$page_size;
		if($start_row<0)$start_row=0;
		
		$_result[page] = $page;								// 현재페이지
		$_result[offset] = $start_row;				// 페이지 시작 위치
		$_result[rows] = $page_size;					// 목록에 보여줄 레코드 갯수
		$_result[total_rows] = $row_count;		// 전체 개시물 갯수
		$_result[page_rows] = $display_page;	// 목록의 페이지수 수
		$_result[total_page] = $total_page;		// 전체 페이지 수
	
		$start_page=floor(($page-1)/$display_page)*$display_page+1;
		if($start_page<1)$start_page=1;
		$end_page=$start_page+$display_page;
		if($end_page>$total_page)$end_page=$total_page+1; 
	
		if($end_page<=1)$end_page=2; 
	
		$prior_page=$page-$display_page;				// 이전 10페이지

		$next_page=$page+$display_page;					// 다음 10페이지
	
		if($prior_page<1)$prior_page=1;
		if($next_page>$total_page)$next_page=$total_page; 
	
		if($page>1) 
			$_result[first] = 1;
		else
			$_result[first] = '';
	
		if($start_page>1) 
			$_result[prior_step] = $prior_page;
		else
			$_result[prior_step] = '';
	
		if($page>1)
			$_result[prior] = $page-1;
		else
			$_result[prior] = '';
	
		for($i=$start_page;$i<$end_page;$i++)	$_result[pages][] = $i;
		
		if($page<$total_page)
			$_result[next] = $page+1;
		else
			$_result[next] = '';
	
		if($end_page<$total_page+1)
			$_result[next_step] = $next_page;
		else
			$_result[next_step] = '';
	
		if($page<$total_page)
			$_result[end] = $total_page;
		else
			$_result[end] = '';
			
		return $_result;	
	}


	# 디렉토리의 파일 리스트를 받는 함수
	# path  -> 파일리스트를 구할 디렉토리 경로
	# t     -> 리스트를 받을 목록
	#          f  : 지정한 디렉토리의 파일만 받음
	#          d  : 지정한 디렉토리의 디렉토리만 받음
	#          l  : 지정한 디렉토리의 링크만 받음
	#          fd : 지정한 디렉토리의 파일과 디렉토리만 받음
	#          fl : 지정한 디렉토리의 파일과 링크만 받음
	#          dl : 지정한 디렉토리의 디렉토리와 링크만 받음
	#          아무것도 지정하지 않았을 경우에는 fdl 모두 받음
	# regex -> 표현식을 사용할 수 있으며, regex 를 정의하면 t 는
	#          e 로 정의되어짐.
	#
	function rg_get_filelist($path='./',$t='',$regex='') {
		$t = $regex ? "e" : $t;
		if(is_dir($path)) {
			$p = opendir($path);
			while($i = readdir($p)) {
				switch($t) {
					case 'e'  :
						if($i != "." && $i != ".." && eregi("$regex",$i)) $file[] = $i;
						break;
					case 'f'  :
						if(is_file("$path/$i") && !is_link("$path/$i")) $file[] = $i;
						break;
					case 'd'  :
						if($i != "." && $i != ".." && is_dir("$path/$i")) $file[] = $i;
						break;
					case 'l'  :
						if(is_link("$path/$i")) $file[] = $i;
						break;
					case 'fd' :
						if($i != "." && $i != ".." && (is_dir("$path/$i") || is_file("$path/$i") && !is_link("$path/$i"))) $file[] = $i;
						break;
					case 'fl' :
						if(is_file("$path/$i")) $file[] = $i;
						break;
					case 'dl' :
						if($i != "." && $i != ".." && (is_dir("$path/$i") || is_link("$path/$i"))) $file[] = $i;
						break;
					default   :
						if($i != "." && $i != "..") $file[] = $i;
				}
			}
			closedir($p);
		} else {
			echo("$path is not directory");
			return 0;
		}
	
		return $file;
	}	

	// input 또는 textarea의 사이즈를 넷쓰와 익스일때 구분하여 리턴
	function size($size) {
		global $agent;
		if($agent[br]=='MSIE') return $size;
		else return round($size*0.6);
	}

	# 접속한 사람이 사용하는 브라우져를 알기 위해 사용되는 함수, 현재는 FORM
	# 입력창의 크기가 브라우져마다 틀리게 설정되는 것을 보정하기 위해 사용됨
	function rg_get_agent() {
		$agent_env = $GLOBALS[HTTP_USER_AGENT];
	
		# $agent 배열 정보 [br] 브라우져 종류
		#                  [os] 운영체제
		#                  [ln] 언어 (넷스케이프)
		#                  [vr] 브라우져 버젼
		#                  [co] 예외 정보
		if(ereg("MSIE", $agent_env)) {
			$agent[br] = "MSIE";
			# OS 별 구분
			if(ereg("NT", $agent_env)) $agent[os] = "NT";
			else if(ereg("Win", $agent_env)) $agent[os] = "WIN";
			else $agent[os] = "OTHER";
			# version 정보
			$agent[vr] = trim(eregi_replace("Mo.+MSIE ([^;]+);.+","\\1",$agent_env));
			$agent[vr] = eregi_replace("[a-z]","",$agent[vr]);
		} else if(eregi("Gecko|Galeon",$agent_env) && !eregi("Netscape",$agent_env)) {
			$agent[br] = "MOZL";
			# client OS 구분
			if(ereg("NT", $agent_env)) $agent[os] = "NT";
			else if(ereg("Win", $agent_env)) $agent[os] = "WIN";
			else if(ereg("Linux", $agent_env)) $agent[os] = "LINUX";
			else $agent[os] = "OTHER";
			# version 정보
			$agent[vr] = eregi_replace("Mozi[^(]+\([^;]+;[^;]+;[^;]+;[^;]+;([^)]+)\).*","\\1",$agent_env);
			$agent[vr] = str_replace("rv:","",$agent[vr]);
			# NS 와의 공통 정보
			$agent[co] = "mozilla";
		} else if(ereg("Konqueror",$agent_env)) {
			$agent[br] = "KONQ";
		} else if(ereg("Lynx", $agent_env)) {
			$agent[br] = "LYNX";
		} else if(ereg("^Mozilla", $agent_env)) {
			$agent[br] = "NS";
			# client OS 구분
			if(ereg("NT", $agent_env)) {
				$agent[os] = "NT";
				if(ereg("\[ko\]", $agent_env)) $agent[ln] = "KO";
			} else if(ereg("Win", $agent_env)) {
				$agent[os] = "WIN";
				if(ereg("\[ko\]", $agent_env)) $agent[ln] = "KO";
			} else if(ereg("Linux", $agent_env)) {
				$agent[os] = "LINUX";
				if(ereg("\[ko\]", $agent_env)) $agent[ln] = "KO";
			} else $agent[os] = "OTHER";
			# version 정보
			if(eregi("Gecko",$agent_env)) $agent[vr] = "6";
			else $agent[vr] = "4";
			# Mozilla 와의 공통 정보
			$agent[co] = "mozilla";
		} else $agent[br] = "OTHER";
	
		return $agent;
	}
	// 화일을 전송한다.
	// 작성자 윤범석
	function download_file($server_name,$file_name) {
		if(empty($server_name) || empty($file_name)) return 1;
		$filesendsize=4096; 
		if(!($fp = @fopen($server_name, "rb")))
			 return false;

//		Header("Content-Type: application/octet-stream"); 
		Header("Content-Type: application/octet-stream; name=$file_name"); 
		Header("Content-Disposition: attachment; filename=$file_name"); 
		$filesize = filesize($server_name); 
		for ($i = 0; $i <= $filesize; $i += $filesendsize) { 
			if(!$body = fread($fp, $filesendsize)) 
				return false;			 
			echo "$body"; // 화일내용을 읽어서 브라우저로 보내준다. 
		} 
		fclose($fp);
		return true;
	}	
	
	// 최근글 보기 함수 
/**************************************************************************
	rg_lastest('스킨','게시판아이디','제목',목록수,
	           제목길이,'길이보다길때표시문자',정렬방법)
	정렬방법 배열형으로 정의
	array('필드명'=>'정렬방법','필드명'=>'정렬방법'....)	
	정렬방법 1 이면 DESC 
**************************************************************************/
	function rg_lastest($skin='',$bbs='',$bbs_title='',$list=10,
											$length=0, $suffix='...',$asort='', $blank_count=0) {
		global $dbcon,$site_url,$site_path,$skin_path,$skin_url,$skin_lastest_dir,
		       $db_table_prefix,$db_table_suffix_body,$db_table_member,
					 $data_path,$data_url,$db_table_suffix_category,
					 $member_icon_url,$C_USE_MB_ICON,
					 $C_USE_CATEGORY;
		$now = time();
		$bbs_id = $bbs;
		
		// 정렬방법이 없다면 글번호로 정렬
		if($asort=='') {
			$asort['rg_doc_num']='1';
		}

		$sort = array();
		$order_str = '';
		foreach($asort as $key => $val) {
			if($val=='1')
				$sort[] = "$key DESC";
			else
				$sort[] = "$key";
		}
		if(count($sort) > 0) {
			$order_str.=" ORDER BY ".implode(",",$sort)." ";
		}
		unset($sort);
		
		$bbs_info = rg_get_bbs_cfg($bbs);
		$bbs_cfg = explode(',', $bbs_info['bbs_cfg']);
		
		$bbs_table = $db_table_prefix.$bbs.$db_table_suffix_body;
		$skin_lastest_path = $skin_path.$skin_lastest_dir.$skin.'/';
		$skin_lastest_url = $skin_url.$skin_lastest_dir.$skin.'/';
		$category_table = $db_table_prefix.$bbs.$db_table_suffix_category; 
		$bbs_data_path = $data_path.$bbs_id.'/';
		$bbs_data_url = $data_url.$bbs_id.'/';

		if(!$bbs_title)$bbs_title=$bbs_info[bbs_title];

		if($bbs_cfg[$C_USE_CATEGORY]!='1') {
			$show_category_begin = '<!--';
			$show_category_end = '-->';
		} else {
			// 카테고리 정보읽음
			$dbqry1=" 
				SELECT * 
				FROM `$category_table` 
				ORDER BY cat_order 
			"; 
			
			$rs1=query($dbqry1,$dbcon); 
			while ($R1=mysql_fetch_array($rs1)) { 
				$category_list[$R1[cat_num]] = $R1; 
			} 
			mysql_free_result($rs1); 
			unset($R1); 
			$show_category_begin = '';
			$show_category_end = '';
		}

		ob_start();

		if (file_exists($skin_lastest_path."setup.php")) 
			include($skin_lastest_path."setup.php");

		$u_title = $site_url."list.php?bbs_id=$bbs";
		$a_title = "<a href=\"$u_title\" $class[link_title]>";

		if(!$skin_icon_new)
			$skin_icon_new = "<img src=\"{$skin_lastest_url}new.gif\" border=0>";

		if(!$skin_date_format)
			$skin_date_format = '%Y-%m-%d';
		
		include($skin_lastest_path."head.php");

		$dbqry = "
			SELECT `$bbs_table`.*,mb_icon,mb_id,mb_name,mb_nick,mb_level
			FROM `$bbs_table` LEFT JOIN `$db_table_member`
				ON rg_mb_num = mb_num
			$order_str
			LIMIT 0,$list";
		$rs = query($dbqry,$dbcon);
		$i=0;
		while($R=mysql_fetch_array($rs)) {
			$mb_icon='';
			$mb_id='';
			$mb_name='';
			$mb_nick='';
			$mb_level=0;
			extract($R);
			// 회원레벨이 10이하면 html 을 사용할수 없다.
			if($mb_level<10) {
				$rg_title = rg_conv_text($rg_title);
				$rg_name = rg_conv_text($rg_name);
				$rg_email = rg_conv_text($rg_email);
			}
			if($mb_icon) { // 아이콘이 있다면 
				$rg_mb_icon = "<img src=$member_icon_url$mb_icon border=0 align=absbottom>";
			} else {
				$rg_mb_icon = '';
			}
			$rg_cmt_count = ($rg_cmt_count)?"[$rg_cmt_count]":"";

			if($now < ($rg_reg_date+$bbs_info[bbs_new_time])) {
				$rg_new_icon = $skin_icon_new;
			} else {
				$rg_new_icon = '';
			}
			if($rg_file1_name && eregi('(\.gif|\.jpg|\.png)$', $rg_file1_name))
				$rg_file1_url = $data_url.$bbs.'/'.$rg_doc_num.'$1$'.$rg_file1_name;
			else 
				$rg_file1_url = "";

			if($rg_file2_name && eregi('(\.gif|\.jpg|\.png)$', $rg_file2_name))
				$rg_file2_url = $data_url.$bbs.'/'.$rg_doc_num.'$2$'.$rg_file2_name;
			else
				$rg_file2_url = "";

			$rg_reg_date = rg_date($rg_reg_date,$skin_date_format);
			$u_list = $site_url."view.php?bbs_id=$bbs&doc_num=$rg_doc_num";
			$a_list = "<a href=\"$u_list\" $class[link_list]>";
			if($length) $rg_title = rg_cut_string($rg_title,$length,$suffix);

			$rg_cat_name = $category_list[$rg_cat_num][cat_name]; 
			include($skin_lastest_path."main.php");
			$i++;
		}
		for(; $i<$blank_count; $i++)
		{
			$rg_file1_name = "";
			$rg_title = "";
			$a_list = "";
			$rg_new_icon = "";
			$rg_reg_date = "";

			include($skin_lastest_path."main.php");
		}
		include($skin_lastest_path."foot.php");
		$_result = ob_get_contents(); 
		ob_end_clean();
		return $_result;
	}
	
	// 외부로그인
	function rg_outlogin($skin='',$url=NULL) {
		global $dbcon,$site_url,$skin_path,$skin_url,$skin_outlogin_dir,
						$mb,$_SESSION,$HTTP_SERVER_VARS,$site,$MB_C_NICK,$MB_C_NAME;
		
		$skin_lastest_path = $skin_path.$skin_outlogin_dir.$skin.'/';
		$skin_lastest_url = $skin_url.$skin_outlogin_dir.$skin.'/';
		if($url==NULL) $url = $HTTP_SERVER_VARS['REQUEST_URI'];
		
		ob_start();
		include($skin_lastest_path."head.php");

		if( $mb && ($_SESSION[ss_login_ok]=='ok') && !empty($_SESSION[ss_mb_id])) {
			$mb_id = $mb[mb_id];
			$mb_memo_count=rg_get_memo_count($mb[mb_num]);

			if($site[st_join_form_cfg][$MB_C_NICK] && $mb[mb_nick]) {
				$show_nick_begin = '';
				$show_nick_end = '';
				$mb_nick = $mb[mb_nick];
			} else {
				$show_nick_begin = '<!--';
				$show_nick_end = '-->';
			}
			if($site[st_join_form_cfg][$MB_C_NAME] && $mb[mb_name]) {
				$show_name_begin = '';
				$show_name_end = '';
				$mb_name = $mb[mb_name];
			} else {
				$show_name_begin = '<!--';
				$show_name_end = '-->';
			}
			$mb_exist_memo = $mb[mb_exist_memo];
			if($mb[mb_exist_memo]) {
				$show_exist_memo_begin = '';
				$show_exist_memo_end = '';
			} else {
				$show_exist_memo_begin = '<!--';
				$show_exist_memo_end = '-->';
			}
			
			$mb_level = $mb[mb_level];
			$mb_point = number_format($mb[mb_point]);

			$member_modify_url=$site_url."mb_edit.php?url=".urlencode($url);
			$member_memo_url=$site_url."memo.php";
			$member_leave_url=$site_url."mb_leave.php?url=".urlencode($url);
			$logout_url=eregi_replace("http://([0-9a-zA-Z\.\-]+)\.([0-9a-zA-Z\-]+)(/)?", "/", $site_url)."mb_logout.php?url=".urlencode($url);
			if($mb[mb_level]>9)
				$admin_url=$site_url."admin/";
			else {
				$show_admin_begin = '<!--';
				$show_admin_end = '-->';
			}

			include($skin_lastest_path."logout.php");
		} else {
			$login_url = eregi_replace("http://([0-9a-zA-Z\.\-]+)\.([0-9a-zA-Z\-]+)(/)?", "/", $site_url)."mb_login.php?url=".urlencode($url);
			$logout_url = $site_url."mb_logout.php?url=".urlencode($url);
			$password_url = $site_url."mb_password.php?url=".urlencode($url);
			if(!$site[st_joining_check] && !$site[st_join_agreement])
				$member_join_url=$site_url."mb_join.php?url=".urlencode($url);
			else
				$member_join_url=$site_url."mb_join_check.php?url=".urlencode($url);

			include($skin_lastest_path."login.php");
		}
		include($skin_lastest_path."foot.php");

		$_result = ob_get_contents(); 
		ob_end_clean();
		return $_result;
	}
	
	// 아이피 체크 list는 , 로 분리 
	// 리스트 안에 ip가 있는지
	function rg_chk_deny_ip($list,$ip='') {
		global $REMOTE_ADDR;
		if(!$ip) $ip = $REMOTE_ADDR;

    $is_exist = false;
		$list = explode(",", trim($list));
		reset($list);
		while (list ($key, $val) = each ($list)) {
        $val = trim($val);
        if ($val=='') continue;
        $reg_str = "/^({$val})/";
        $is_exist = preg_match($reg_str, $ip);
        if ($is_exist)
            break;
		}
		unset($key);
		unset($val);
		unset($list);

    return $is_exist;
	}
	
	// $str 안에 $list 가 있는지 검사
	function rg_str_inword($list,$str) {
    $_result = '';
    $list = explode(",", trim($list));
		while (list ($key, $val) = each ($list)) {
			$val = trim($val);
			if ($val=='') continue;
			$val = str_replace('/','\/',$val);
			$val = str_replace('(','\(',$val);
			$val = str_replace(')','\)',$val);
			$reg_str = "/({$val})/i";
			if (preg_match($reg_str, $str)) {
				$_result = $val;
				break;
			}
		}
		unset($key);
		unset($val);
		unset($list);
		
    return $_result;
	}

	// $str 안에 $list 태그를 변환한다.
	function rg_script_conv($list,$str) {
		$source = array();
		$target = array();
    $list = explode(",", trim($list));
		while (list ($key, $val) = each ($list)) {
			$val = trim($val);
			if (!$val) continue;
			$source[] = "/<{$val}/i";
			$target[] = "<rg-{$val}";
			$source[] = "/<\/{$val}/i";
			$target[] = "</rg-{$val}";
		}
    return preg_replace($source, $target, $str);
	}
	
	function rg_img_view_tag($name){
		if(eregi('(\.gif|\.jpg|\.png)$',$name)) {
			return "<img src=\"$name\" border=0 vspace=\"10\" hspace=\"10\">";
		} else {
			return "";
		}
	}
	
	// 하위 디렉토리와 파일을 전부 삭제한다.
	function rg_delete_board_file($path) { // 재귀적으로 파일을 지운다.
		if(is_dir($path)) {
			$p = opendir($path);
			while($i = readdir($p)) {
      	if($i != "." && $i != "..") {
					if(is_dir("$path/$i")){
						rg_delete_board_file("$path/$i");
					} else {
						unlink("$path/$i");
					}
				}
			}
	    closedir($p);
			rmdir($path);
		}
	}

	
	// 게시판 글을 삭제한다.
	function rg_bbs_doc_del($bbs_id,$rg_doc_num) {
		global $dbcon,$data_path,$bbs_cfg,
					 $db_table_prefix,$db_table_suffix_body,
					 $db_table_suffix_comment;
					 
		$bbs_data_path = $data_path.$bbs_id.'/';
		
		// 게시판 테이블 관련 변수
		$bbs_table = $db_table_prefix.$bbs_id.$db_table_suffix_body;
		$commant_table = $db_table_prefix.$bbs_id.$db_table_suffix_comment;
		
		$data = rg_get_doc_info($bbs_id,$rg_doc_num);
	
		// 파일을 지운다.
		if($bbs_id == "flash"){
			$del_file = $data["rg_file1_name"];
			@unlink($bbs_data_path.$del_file);
			$del_file = $data["rg_file1_name"]; 
			@unlink($bbs_data_path.$del_file); 

			$del_file = $data["rg_file2_name"];
			@unlink($bbs_data_path.$del_file);
			$del_file = $data["rg_file2_name"]; 
			@unlink($bbs_data_path.$del_file); 
				


			###############################################################################
		
			$sql = "select admin_orderby from `$bbs_table` where rg_doc_num='$rg_doc_num'";
			$result = query($sql,$dbcon);
			$admin_orderby_value = mysql_result($result,0,0);
			//echo $sql."<br>";
			$sql = "select * from `$bbs_table` where admin_orderby > '$admin_orderby_value' order by admin_orderby asc";
			$result = query($sql,$dbcon);
			$rows_count = mysql_num_rows($result);
			//echo $sql;
			//exit;

			if($rows_count > 0){
				for($h=0;$rows_value = mysql_fetch_array($result);$h++){
					$rows_value_admin = $rows_value[admin_orderby] - 1;

					$small_newfile="small".$rows_value_admin.".jpg";
					$big_newfile = "big".$rows_value_admin.".jpg";

					$small_newfile_url=$bbs_data_path.$small_newfile;
					$big_newfile_url = $bbs_data_path.$big_newfile;

					rename($bbs_data_path.$rows_value[rg_file1_name],$small_newfile_url);
					rename($bbs_data_path.$rows_value[rg_file2_name],$big_newfile_url);

					$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile' where rg_doc_num='$rows_value[rg_doc_num]'";
					query($sql2,$dbcon);
				}
			}			
			
			// 삭제글보다 admin_orderby 값이 크면 하나씩 내린다.
			$dbqry="
				UPDATE `$bbs_table` SET
					`admin_orderby` = `admin_orderby` - 1
				WHERE admin_orderby > '$data[admin_orderby]'
			";
			query($dbqry,$dbcon);
			###############################################################################
			

		}else{
			$del_file = $rg_doc_num."\$1\$th$".$data["rg_file1_name"];
			@unlink($bbs_data_path.$del_file);
			$del_file = $rg_doc_num."\$1\$th2$".$data["rg_file1_name"]; 
			@unlink($bbs_data_path.$del_file); 

			$del_file = $rg_doc_num."\$2$".$data["rg_file2_name"];
			@unlink($bbs_data_path.$del_file);
			$del_file = $rg_doc_num."\$2\$th2$".$data["rg_file2_name"]; 
			@unlink($bbs_data_path.$del_file); 
		}
		// 삭제글보다 next_num 이 크면 하나씩 내린다.
		$dbqry="
			UPDATE `$bbs_table` SET
				`rg_next_num` = `rg_next_num` - 1
			WHERE rg_next_num > '$data[rg_next_num]'
		";
		query($dbqry,$dbcon);
		
		// 글을 삭제한다.
		$dbqry="
			DELETE FROM `$bbs_table`
			WHERE rg_doc_num = '$rg_doc_num'
		";
		query($dbqry,$dbcon);
		
		// 코멘트 삭제
		$dbqry="
			DELETE FROM `$commant_table`
			WHERE cmt_doc_num = '$rg_doc_num'
		";
		$rs=query($dbqry,$dbcon);
		
	}

	
	
	// 게시판 글을 복사한다.
	function rg_bbs_doc_copy($target_bbs_id,$source_bbs_id,$source_rg_doc_num) {
		global $dbcon,$data_path,
		   $db_table_prefix,$db_table_suffix_body,$db_table_suffix_comment;
			 
		$src_bbs_data_path = $data_path.$source_bbs_id.'/';
		$tar_bbs_data_path = $data_path.$target_bbs_id.'/';
		
		// 게시판 테이블 관련 변수
		$src_bbs_table = $db_table_prefix.$source_bbs_id.$db_table_suffix_body;
		$src_commant_table = $db_table_prefix.$source_bbs_id.$db_table_suffix_comment;

		$tar_bbs_table = $db_table_prefix.$target_bbs_id.$db_table_suffix_body;
		$tar_commant_table = $db_table_prefix.$target_bbs_id.$db_table_suffix_comment;


		$source = rg_get_doc_info($source_bbs_id,$source_rg_doc_num);
		while(list($key,$value)=each($source)) {
			$source[$key] = addslashes($value);
		}
		extract($source);
		$rg_doc_num = '';
		$rg_top_num = '';
		$rg_parent_num = '';
		$rg_sequence = 1;
		$rg_depth = 0;
		$rg_next_num = '';
		$rg_cat_num = '1';
		// 공지사항이 아닌경우 next_num 값을 구한다
		$dbqry="
			SELECT max(rg_next_num) as rg_next_num
			FROM `$tar_bbs_table`
			WHERE rg_notice < 1
		";
		$rs=query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		$rg_next_num = $tmp[rg_next_num] + 1;

		if($rg_html_use!=0)
			$rg_content.="<br>\n<br>\n";
		else
			$rg_content.="\n\n";
		
		//$rg_content.='※. '.$mb[mb_show_name]."님에 의해 복사(이동)되었습니다. (".rg_date(time()).")";

		// 공지사항의  next_num을 하나씩 올린다.
		$dbqry="
			UPDATE `$tar_bbs_table` SET
				`rg_next_num` = `rg_next_num` + 1
			WHERE rg_notice > 0
		";
		query($dbqry,$dbcon);
		$dbqry="
			INSERT INTO `$tar_bbs_table`
				( `rg_doc_num` , `rg_top_num` , `rg_parent_num` ,
				 	`rg_sequence` , `rg_depth` , `rg_next_num` ,
					`rg_cat_num` , `rg_mb_num` , `rg_name` ,
					`rg_password` , `rg_email` , `rg_home_url` ,
					`rg_home_hit` , `rg_link1_url` , `rg_link2_url` ,
					`rg_link1_hit` , `rg_link2_hit` , `rg_file1_name` ,
					`rg_file2_name` , `rg_file1_size` , `rg_file2_size` ,
					`rg_file1_hit` , `rg_file2_hit` , `rg_vote_yes` ,
					`rg_vote_no` , `rg_doc_hit` , `rg_cmt_count` ,
					`rg_title` , `rg_content` , `rg_html_use` ,
					`rg_reg_date` , `rg_modi_date` , `rg_reg_ip` ,
					`rg_modi_ip` , `rg_deleted` , `rg_secret` ,
					`rg_vote_ip` , `rg_notice` , `rg_reply_mail` ,
					`rg_agree` , `rg_ext1` , `rg_ext2` ,
					`rg_ext3` , `rg_ext4` , `rg_ext5` 
				)
			VALUES 
				( '$rg_doc_num', '$rg_top_num', '$rg_parent_num',
					'$rg_sequence', '$rg_depth', '$rg_next_num', 
					'$rg_cat_num', '$rg_mb_num', '$rg_name', 
					'$rg_password', '$rg_email', '$rg_home_url', 
					'$rg_home_hit', '$rg_link1_url', '$rg_link2_url', 
					'$rg_link1_hit', '$rg_link2_hit', '$rg_file1_name', 
					'$rg_file2_name', '$rg_file1_size', '$rg_file2_size', 
					'$rg_file1_hit', '$rg_file2_hit', '$rg_vote_yes', 
					'$rg_vote_no', '$rg_doc_hit', '$rg_cmt_count', 
					'$rg_title', '$rg_content', '$rg_html_use', 
					'$rg_reg_date', '$rg_modi_date', '$rg_reg_ip', 
					'$rg_modi_ip', '$rg_deleted', '$rg_secret', 
					'$rg_vote_ip', '$rg_notice', '$rg_reply_mail', 
					'$rg_agree', '$rg_ext1', '$rg_ext2', 
					'$rg_ext3', '$rg_ext4', '$rg_ext5'
				)
		";
		query($dbqry,$dbcon);
		
		$rg_doc_num = mysql_insert_id();
		$rg_top_num = $rg_doc_num;

		$dbqry="
			UPDATE `$tar_bbs_table` SET
				`rg_top_num` = '$rg_top_num',
				`rg_file1_name` = '$rg_file1_name',
				`rg_file1_size` = '$rg_file1_size',
				`rg_file2_name` = '$rg_file2_name',
				`rg_file2_size` = '$rg_file2_size'
			WHERE rg_doc_num='$rg_doc_num'
		";
		query($dbqry,$dbcon);

		// 파일 복사 
			if(${"rg_file1_name"}) {
				${"rg_file1_src_server_name"} = 
				        $source_rg_doc_num."\$1\$th\$".${"rg_file1_name"};
				${"rg_file1_tar_server_name"} = 
				        $rg_doc_num."\$1\$th\$".${"rg_file1_name"};
				if(!@copy($src_bbs_data_path.${"rg_file1_src_server_name"},
				          $tar_bbs_data_path.${"rg_file1_tar_server_name"})) {
				}


				${"rg_file1_src_server_name"} = 
				        $source_rg_doc_num."\$1\$th2\$".${"rg_file1_name"};
				${"rg_file1_tar_server_name"} = 
				        $rg_doc_num."\$1\$th2\$".${"rg_file1_name"};
				if(!@copy($src_bbs_data_path.${"rg_file1_src_server_name"},
				          $tar_bbs_data_path.${"rg_file1_tar_server_name"})) {
					${"rg_file1_name"} = '';
					${"rg_file1_size"} = 0;
				}


			}
			if(${"rg_file2_name"}) {
				${"rg_file2_src_server_name"} = 
				        $source_rg_doc_num."\$2\$".${"rg_file2_name"};
				${"rg_file2_tar_server_name"} = 
				        $rg_doc_num."\$2\$".${"rg_file2_name"};
				if(!@copy($src_bbs_data_path.${"rg_file2_src_server_name"},
				          $tar_bbs_data_path.${"rg_file2_tar_server_name"})) {
				}


				${"rg_file2_src_server_name"} = 
				        $source_rg_doc_num."\$2\$th2\$".${"rg_file2_name"};
				${"rg_file2_tar_server_name"} = 
				        $rg_doc_num."\$2\$th2\$".${"rg_file2_name"};
				if(!@copy($src_bbs_data_path.${"rg_file2_src_server_name"},
				          $tar_bbs_data_path.${"rg_file2_tar_server_name"})) {
					${"rg_file2_name"} = '';
					${"rg_file2_size"} = 0;
				}
			}
					
		
		// 코멘트 복사
		$dbqry="
			INSERT INTO `$tar_commant_table`
				( `cmt_num` , `cmt_doc_num` , `cmt_mb_num` ,
					`cmt_name` , `cmt_password` , `cmt_email` ,
					`cmt_comment` , `cmt_reg_date` , `cmt_reg_ip`
				)
			SELECT '' , '$rg_doc_num' , `cmt_mb_num` ,
					`cmt_name` , `cmt_password` , `cmt_email` ,
					`cmt_comment` , `cmt_reg_date` , `cmt_reg_ip`
			FROM `$src_commant_table`
			WHERE cmt_doc_num = '$source_rg_doc_num'
		";

		query($dbqry,$dbcon);
	}
	
	function rg_hidden_ip($ip) {
		$ptn_src = '/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/';
		$ptn_dst = '\1.xxx.\3.xxx';
		return preg_replace($ptn_src,$ptn_dst,$ip);
	}
	
	// 투표하기 
	// rg_vote_preview('스킨명','팝업여부')
	// 팝업여부 1:팝업, 0:현재창
	function rg_vote_preview($skin,$vote_popup) {
		global $dbcon,$site_url,$skin_path,$skin_url,$skin_vote_preview_dir,
						$mb,$_SESSION,$HTTP_SERVER_VARS,$site,
						$db_table_vote,$MB_C_NICK,$MB_C_NAME;
		$now = time();
		$vip_ip = $HTTP_SERVER_VARS[REMOTE_ADDR];
		
		$skin_vote_path = $skin_path.$skin_vote_preview_dir.$skin.'/';
		$skin_vote_url = $skin_url.$skin_vote_preview_dir.$skin.'/';
		if($url==NULL) $url = $HTTP_SERVER_VARS['REQUEST_URI'];
//		$vote_url=$site_url."mb_logout.php?url=".urlencode($url);
		$vote_url=$site_url."vote_main.php";
		$vote_popup_url=$site_url."vote_popup.php";

		$dbqry="
			SELECT *
			FROM `{$db_table_vote}_cfg`
			WHERE UNIX_TIMESTAMP() BETWEEN `vt_start` AND `vt_end`
			ORDER BY vt_num DESC
			LIMIT  0,1
		";
		$rs=query($dbqry,$dbcon,1);
		if(!$rs || mysql_num_rows($rs) == 0) {
			return ;
		}
		$R=mysql_fetch_array($rs);
		$group = rg_get_group_cfg("$site[st_default_group]");		
		extract($R);
		$vote_link=$site_url."vote_main.php?vt_num=".$vt_num;
//		$vote_href=$site_url."vote_main.php?vt_num=".$vt_num;

		$vt_cmt_count=($vt_cmt_count>0)?'['.$vt_cmt_count.']':'';
		// 권한체크
		$tmp = array(1=>"comment",2=>"auth",3=>"show");
		if($group[gr_level_type]) {
			$tmp_level = $group_member[gm_level];
		} else {
			$tmp_level = $mb[mb_level];
		}

		foreach($tmp as $key => $val) {
			switch(${"vt_cfg_$val"}) {
				case 'A' : $vote_auth["{$val}"] = true;break;// 전체 
				case 'M' : $vote_auth["{$val}"] = ($mb)?true:false;break;// 회원 
				case 'D' :
				case 10 : $vote_auth["{$val}"] = ($auth[admin])?true:false;break;// 운영자 
				case 'N' : $vote_auth["{$val}"] = false;break;// 사용안함
				case 0 :
				case 1 : 
				case 2 :
				case 3 : 
				case 4 :
				case 5 : 
				case 6 :
				case 7 : 
				case 8 : 
				case 9 : 
				default : // 레벨에 따라서
						$vote_auth["{$val}"] = ($tmp_level>${"vt_cfg_$val"})?true:false;
						break;
	//					$error_msg = '잘못된 설정입니다.';
	//					include($skin_site_path.'error.htm');
	//					exit;
	//					break;
			}
			${"show_{$val}_begin"} = ($vote_auth["{$val}"])?'':'<!--';
			${"show_{$val}_end"} = ($vote_auth["{$val}"])?'':'-->';
	//		echo ${"vt_cfg_$val"}."  vt_cfg_{$val} => ".$vote_auth["{$val}"]."&nbsp;&nbsp; $tmp_level<br>";
		}	
		unset($tmp_level);
		unset($tmp);

		// 투표기간이 체크 
		$vote_expired = !(($vt_start < $now) && ($now < $vt_end));
		// 중복투표체크 
		$vote_repeat=false;
		if($vt_cfg_repeat) {
			if($mb)
				$mb_sql=" OR vip_mb_num=$mb[mb_num] ";
			$qry="
				SELECT `{$db_table_vote}_ip`.*,vit_item,vit_order
				FROM `{$db_table_vote}_ip`,`{$db_table_vote}_item`
				WHERE vip_vt_num = '$vt_num'
				AND `{$db_table_vote}_item`.vit_num=`{$db_table_vote}_ip`.vip_vit_num
				AND (vip_ip='$vip_ip' $mb_sql)
				LIMIT 0,1
			";
			$rs=query($qry,$dbcon);
			if($last_vote=mysql_fetch_array($rs)) {
				$vote_repeat=true;
				$last_vote[vip_date]=rg_date($last_vote['vip_date'],'%Y-%m-%d');
			}
		}
		// 투표가능하다면 
		if(!$vote_expired && !$vote_repeat) {
			$vote_able=true;
			$show_item_check_begin='';
			$show_item_check_end='';
		} else {
			$vote_able=false;
			$show_item_check_begin='<!--';
			$show_item_check_end='-->';
		}

		include($skin_vote_path."setup.php");

		// 아이템 로딩
		$qry="
			SELECT *
			FROM `{$db_table_vote}_item`
			WHERE vit_vt_num = '$vt_num'
			ORDER BY vit_order
		";
		$rs=query($qry,$dbcon);
		
		$item_list=array();
		$vt_max_count=0;
		$vt_total_count=0;
		while($R=mysql_fetch_array($rs)) {
			if($R[vit_count] > $vt_max_count) $vt_max_count = $R[vit_count];
			$vt_total_count = $vt_total_count + $R[vit_count];
			$item_list[]=$R;
		}
		foreach($item_list as $key => $val) {
			if($item_list[$key][vit_count]>0) {
				$item_list[$key][vit_count_per] = number_format($item_list[$key][vit_count]/$vt_total_count*100,2,'.','');
				$item_list[$key][vit_graph_per] = number_format($item_list[$key][vit_count]/$vt_max_count*75,0,'.','');
			} else {
				$item_list[$key][vit_count_per] = 0;
				$item_list[$key][vit_graph_per] = 0;
			}
			$item_list[$key][vit_count]=number_format($item_list[$key][vit_count]);
		}
	
		$vt_start=rg_date($vt_start,'%Y-%m-%d');
		$vt_end=rg_date($vt_end,'%Y-%m-%d');
		$vt_regdate=rg_date($vt_regdate,'%Y-%m-%d');
		
		ob_start();
		include($skin_vote_path."item_head.php");
	
		for($i=0;$i<count($item_list);$i++) {
			extract($item_list[$i]);
			include($skin_vote_path."item_list.php");
		}
		
		ob_start();
		// 투표 기간이 아님 
		if($vote_expired) {
			include($skin_vote_path."vote1.php");
		// 이미투표한경우 
		} else if($vote_repeat) {
			include($skin_vote_path."vote2.php");
		} else {
			include($skin_vote_path."vote3.php");
		}
		$vote_submit=ob_get_contents();
		ob_end_clean();
		
		include($skin_vote_path."item_foot.php");

		$_result = ob_get_contents(); 
		ob_end_clean();
		return $_result;
	}

	function fn_progress_bar($intCurrentCount = 100, $intTotalCount = 100)
	{
	   static $intNumberRuns = 0;
	   static $intDisplayedCurrentPercent = 0;
	   $strProgressBar = '';
	   $dblPercentIncrease = (100 / $intTotalCount);
	   $intCurrentPercent = intval($intCurrentCount * $dblPercentIncrease);
	   $intNumberRuns++;
		   
	   if(1 == $intNumberRuns)
	   {
		   $strProgressBar = "
			<table width='50%' id='progress_bar' summary='progress_bar' align='center'><tbody><tr>
			<td id='progress_bar_complete' width='0%' align='center' style='background:#CCFFCC;'>&nbsp;</td>
			<td style='background:#FFCCCC;'>&nbsp;</td>
			</tr></tbody></table>
			<script type='text/javascript' language='javascript'>
			function dhd_fn_progress_bar_update(intCurrentPercent)
			{
			   document.getElementById('progress_bar_complete').style.width = intCurrentPercent+'%';
			   document.getElementById('progress_bar_complete').innerHTML = intCurrentPercent+'%';
			}
			</script>
			";
	   }
	   else if($intDisplayedCurrentPercent <> $intCurrentPercent)
	   {
		   $intDisplayedCurrentPercent = $intCurrentPercent;
		   $strProgressBar = "
			<script type='text/javascript' language='javascript'>
			dhd_fn_progress_bar_update($intCurrentPercent);
			</script>
			";
		}
		if(100 < $intCurrentPercent)
		{
		   $intNumberRuns = $intDisplayedCurrentPercent = 0;
		   $strProgressBar = "
			<script type='text/javascript' language='javascript'>
			document.getElementById('progress_bar').style.visibility='hidden';
			</script>
			";
	   }
	   echo $strProgressBar;
	   flush();
	   ob_flush();
	}
	function MakeThum_Gall($rg_doc_num,$fi,$bbs_id,$rg_file_name) 
	{ //갤러리 글보기
			//원본파일명
			$FileName = $rg_doc_num.'\$'.$fi.'\$'.$rg_file_name;
			if($fi > 1){
				//원본파일명(삭제용)
				$FileName2_d = $rg_doc_num.'$'.$fi.'$'.$rg_file_name;
			}
			//새로 만들 이름
			$ThumFileName = $rg_doc_num.'\$'.$fi.'\$th2\$'.$rg_file_name;				
			
			//원본파일 경로
			$path=dirname(realpath(__FILE__)); 
			$top_path=substr($path, 0, strpos($path, "public_html")); 
			$ori_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName;
			if($fi > 1){
				$ori_del_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName2_d;
			}
			//새로 만들 경로				
			$ThumFileName_url = $top_path."public_html/bbs/data/".$bbs_id."/".$ThumFileName;

			exec ("convert -geometry 600x $ori_path $ThumFileName_url");
			if($fi > 1){ //첨부파일 2번부터 썸네일 만들어지면 원본은 삭제함
				if(file_exists("$ori_del_path")){ 
					unlink ("$ori_del_path");	
				}
			}
	}
	function MakeThum_Gall_List($rg_doc_num,$fi,$bbs_id,$rg_file_name,$thum_width) 
	{
			$path=dirname(realpath(__FILE__)); 
			$top_path=substr($path, 0, strpos($path, "public_html")); 

			//썸네일로 변환된 파일
			$FileName = $rg_doc_num.'\$'.$fi.'\$th2\$'.$rg_file_name;			
			//원본 파일
			$FileName2 = $rg_doc_num.'\$'.$fi.'\$'.$rg_file_name;
			//원본파일명(삭제용)
			$FileName2_d = $rg_doc_num.'$'.$fi.'$'.$rg_file_name;

			//섬네일 된거 있음 그거로 쓰고 없음 원본으로 만들기     
			if(file_exists($top_path."public_html/bbs/data/".$bbs_id."/"."{$rg_doc_num}\$$fi\$th2\$".$rg_file_name)) {				
					$FileName = $FileName;
			}else{						
					$FileName = $FileName2;
			}
			//새로 만들 이름
			$ThumFileName = $rg_doc_num.'\$'.$fi.'\$th\$'.$rg_file_name;		
			
			//원본파일 경로
			$ori_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName;
			
			$ori_del_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName2_d;

			//새로 만들 경로				
			$ThumFileName_url = $top_path."public_html/bbs/data/".$bbs_id."/".$ThumFileName;

			$thum_widthx = $thum_width."x";

			exec ("convert -geometry $thum_widthx $ori_path $ThumFileName_url");

			if(file_exists($top_path."public_html/bbs/data/".$bbs_id."/"."{$rg_doc_num}\$$fi\$th2\$".$rg_file_name)) {
				if(file_exists("$ori_del_path")){ 
					unlink ("$ori_del_path");	//썸메일이면 삭제하고 원본이면 삭제안함
				}
			}
	}
} // *-- FUNC_INC_INCLUDED END --*
?>
