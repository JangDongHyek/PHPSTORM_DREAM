<?
if (!defined('FUNC_INC_INCLUDED')) {  
    define('FUNC_INC_INCLUDED', 1);
// *-- FUNC_INC_INCLUDED START --*

	// ����� ���ڷ� �̷���� �ִ� ��.
	function  rg_alpa_check($str) { 
		return eregi("^([a-z0-9-])*$", $str); 
	} 
	
	// ��,���ڷ������� ���̸�ŭ �߻���Ų��. 
	function rg_get_uniqid($len) {
		return substr(md5(uniqid(rand())), 0, $len);
	}

	// Ȩ������ �Է½� http �� �����ϴ��� üũ�Ͽ�
	// �ƴ� ��� http:// �� ���δ�.
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
	
	// ������ �̵� �Լ�(�׼����� ó��)
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
	
	// base64�� ���ڵ� �Ͽ� ������ ������.
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
  
		// ����(base64�� ���ڵ��Ѵ�)
		$message = chunk_split(base64_encode($message)); 
		return mail($to,$subject,$message,$headers);
	}
				
	// TEXT ���� ��ȯ
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
				
	// TEXT �������� ��ȯ
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

	// ���� ��ũ��Ʈ�� URL �� ��´�
	function rg_get_current_url()
	{
			global $HTTP_SERVER_VARS;
			
			// �������� ���ϱ� 
			$protocol = strtolower($HTTP_SERVER_VARS["SERVER_PROTOCOL"]);
			$protocol = preg_replace('/(\/.*)/', '', $protocol);
			
			// ������ ��Ʈ��ȣ�� 80�� �ƴҰ�� ��Ʈ��ȣ ����(���� ����)
			$port = $HTTP_SERVER_VARS['SERVER_PORT'];
			$port = ($port!='80')?':'.$port:'';
			
			$host = $HTTP_SERVER_VARS['HTTP_HOST'];
			$url = $protocol.'://'.$host.$port.dirname($HTTP_SERVER_VARS['PHP_SELF']);
			
			// ���� / �� ������ ���̱�
			if(!preg_match("/(\/)$/",$url)) $url .= '/';

			return $url;
	}	
	
	// 2003-05-31 01:22:11 ������ ���ڸ� TimeStemp �������� ��ȯ�Ѵ�.
	function rg_str2time($DateTimeStr) {
		$Tmp=explode(" ", $DateTimeStr);
		$Date=explode("-", $Tmp[0]);
		$Time=explode(":", $Tmp[1]);
	
		// �� �� �� �� �� ��
		return mktime($Time[0],$Time[1],$Time[2],$Date[1],$Date[2],$Date[0]+$PayYear);
	}

	// �迭�� �̿��Ͽ� <option> �±׸� �߻���Ų��.
	// $options �� �迭�Ǵ� ���߹迭�̴�.
	function rg_html_option($options,$key_field='',$text_field='',$default=NULL,$text_key=false) {
		$_result = '';
		$selected = false;

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;

		reset($options);
		while(list($key,$value)=each($options)) {
		
			if($key_field && $text_field) { // Ű�ʵ�� �ؽ�Ʈ�� �ִٸ�
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // Ű�ʵ常 �ִٸ�
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // �ؽ�Ʈ�ʵ常 �ִٸ�
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // �Ѵ� ���ٸ�
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

		$_result .= "<a href=\"./list.php?bbs_id=$bbs_id\">��ü</a> | \n";

		while(list($key,$value)=each($options)) {

			if($key_field && $text_field) { // Ű�ʵ�� �ؽ�Ʈ�� �ִٸ�
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // Ű�ʵ常 �ִٸ�
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // �ؽ�Ʈ�ʵ常 �ִٸ�
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // �Ѵ� ���ٸ�
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
		
	// ���ڵ���� �ʵ带 �̿��Ͽ� <option> �±׸� �߻���Ų��.
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
	
	// �迭�� �̿��Ͽ� radio �±׸� �߻���Ų��.
	// $options �� �迭�Ǵ� ���߹迭�̴�.
	function rg_html_radio($options,$form_name,$key_field=NULL,$text_field='',$default='',$tag1='',$tag2='') {
		$_result = '';
		$selected = false;

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;
		
		reset($options);
		while(list($key,$value)=each($options)) {
		
			if($key_field && $text_field) { // Ű�ʵ�� �ؽ�Ʈ�� �ִٸ�
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // Ű�ʵ常 �ִٸ�
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // �ؽ�Ʈ�ʵ常 �ִٸ�
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // �Ѵ� ���ٸ�
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
	
	# ����� ���� ���� �����.
	# 1, �ʵ��
	# 2, ����
	# 3, ��
	# 4, �⺻��
	# �ۼ��� : ������
	
	function rg_makeform($form_name, $type, $values, $default_value='') {
		if(func_num_args()>3) { // �⺻���Է��� �ִٸ� �⺻�� üũ
			$m = true;
		} else {
			$m = false;
		}
								
		$select_box = false;
								
		$tmp = explode("|", $values);
		
		if($type=='2') { // �ؽ�Ʈ �ڽ� 1��° ����, 2��° �⺻��
			if($m) $tmp[2]=$default_value;
			$result = "<input name=\"$form_name\" type=\"text\" id=\"$form_name\" $tmp[0] itemname='$tmp[1]' value=\"$tmp[2]\" size=\"$tmp[3]\" class=b_input>\n";
			return $result;
		}
		
		if($type=='5') { // �ؽ�Ʈ ������ 1��° cols, 2��° rows, 3��° �⺻��
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
				case 1 : // ������ư
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$return .= "<input type=radio name=\"$form_name\" id=\"{$form_name}_$i\" VALUE=\"$tmp[$i]\"";
								if ($default) { $return .= " checked"; }
								$return .= "><label for=\"{$form_name}_$i\">$tmp[$i]</label>\n";
								break;
				case 3 : // ����Ʈ�ڽ�
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$select_box = true;
								$return .= "<option value=\"$tmp[$i]\"";
								if ($default) { $return .= " selected"; }
								$return .= ">$tmp[$i]</option>\n";
								break;
				case 4 : // üũ�ڽ� ó��! �⺻üũ, ��������, ������
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
		
	// ����Ʈ ���� �о��
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
		
	// �Խ��� ���� �о��
	function rg_get_bbs_cfg($key,$type=0) {
		global $dbcon,$db_table_bbs_cfg;
	
		switch ($type) {
			case 1 : // �Խ��ǰ�����ȣ��
				$dbqry = "SELECT *
									FROM `$db_table_bbs_cfg`
									WHERE bbs_num='$key'";
				break;
			default : // �⺻ ���̵��
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
	
	// �׷� ���� �о��
	function rg_get_group_cfg($key,$type=0) {
		global $dbcon,$db_table_group_cfg;
	
		switch ($type) {
			case 1 : // �׷������ȣ��
				$dbqry = "SELECT *
									FROM `$db_table_group_cfg`
									WHERE gr_num='$key'";
				break;
			default : // �⺻ ���̵��
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
	
	// ȸ�� ���� �о��
	function rg_get_member_info($key,$type=0) {
		global $dbcon,$db_table_member;
	
		switch ($type) {
			case 1 : // ȸ����ȣ��
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_num='$key'";
				break;
			case 2 : // �г�������
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_nick='$key'";
				break;
			case 3 : // �ֹε�Ϲ�ȣ��
				$dbqry = "SELECT *
									FROM `$db_table_member`
									WHERE mb_jumin='$key'";
				break;
			default : // �⺻ ���̵��
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

	// ȸ�� �޸� ������ �о�´�
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
	
	// �׷�/ȸ�� ���� �о��
	function rg_get_group_member_info($gr_key,$mb_key='',$type='') {
		global $dbcon,$db_table_group_member,$db_table_member;
		/*
		 $type 
		 	 0: �׷���̵�,ȸ�����̵�
			 1: �׷���̵�,ȸ����ȣ
		   2: �׷��ȣ,ȸ����ȣ
			 3: �׷��ȣ,ȸ�����̵�
			 4: �׷�ȸ����ȣ
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
	
	// ������ ����(?) �о�´�
	function rg_get_doc_info($bbs_id,$key,$type='0') {
		global $dbcon,$db_table_prefix,$db_table_suffix_body;
		$table = $db_table_prefix.$bbs_id.$db_table_suffix_body;

		switch ($type) {
			case 1 : // next_num ����
				$dbqry = "SELECT *
									FROM `$table`
									WHERE rg_next_num='$key'";
				break;
			default : // ������ȣ��
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
	
	// ���������� �о�´�.
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

	// ȸ���� ����Ʈ�� ����,�����Ѵ�. 
	function rg_set_point($key,$point,$type='0') {
		global $dbcon,$db_table_member,$bbs,$site;
		$now = time();

		if(!$point || !$key) {
			return false;
		}

		switch ($type) {
			case 1 : // ȸ����ȣ�� 
				$where_str = " mb_num='$key' ";
				break;
			default : // ���̵�� 
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

	// ��ǥ ���� �о�� 2003-10-14
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

	// ���� �����ڻ��¸� ���Ѵ�. 
	function rg_get_connect_count($type='total',$key='') {
		global $dbcon,$db_table_connect;

		switch ($type) {
			case 'login' : // �α��λ���� 
				$where_str = " AND `con_mb_id` <> '' ";
				break;
			case 'nologin' : // �α��� ���� ���� ����� 
				$where_str = " AND `con_mb_id` = '' ";
				break;
			case 'total' : // ��ü ������ ��
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
	
	// ���ڿ��� mysql password�Լ��� �̿��Ͽ� ��ȣȭ �Ѵ�.
	function get_password_str($str) {
/*
	// mysql 4.1.0 ���� passowrd �Լ��� ���� �������� ����Ǿ� 
	// ���� password �Լ��� ������ �˰����� �ڵ�� �ٲ����.
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
		// �Ϻ� �������� �� ��ȣȭ �˰����� ���� �ʴ°� ����
		// mysql ������ üũ�Ͽ� ��ȣȭ �Ѵ�
		
		global $dbcon;
		// mysql������ ������ ���Ѵ�
		$rs = query("SHOW VARIABLES like 'version'",$dbcon);
		$tmp=mysql_fetch_array($rs);
		mysql_free_result($rs);
		list($mysql_version)=explode('.',$tmp[1]);
		
		// mysql 4.1 ���� password �Լ��� old_password �ιٲ����.
		if($mysql_version>3) { // 4.0 ���� �̻��̶��
			$rs = query("SELECT old_password('$str')",$dbcon);
		} else { // 3.xx ���� ���϶��
			$rs = query("SELECT password('$str')",$dbcon);
		}
		
		$tmp=mysql_fetch_array($rs);
		mysql_free_result($rs);
		return $tmp[0];
	}

	// ���ڿ� �ڸ���. 
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

	# ���� ũ�� ��� �Լ�
	# $bfsize ������ bytes ������ ũ����
	#
	# number_formant() - 3�ڸ��� �������� �ĸ��� ���
	function rg_human_fsize_lib($bfsize, $sub = "0") {
		$BYTES = number_format($bfsize) . " Bytes";
	
		if($bfsize < 1024) // Bytes ����
			return $BYTES;
		else if($bfsize < 1048576) // KBytes ����
			$bfsize = number_format(round($bfsize/1024)) . " KB";
		else if($bfsize < 1073741827) // MB ����
			$bfsize = number_format(round($bfsize/1048576)) . " MB";
		else // GB ����
			$bfsize = number_format(round($bfsize/1073741827)) . " GB";
	
		if($sub) $bfsize .= "($BYTES)";
	
		return $bfsize;
	}	
		
	# ���� ���뿡 �ִ� URL���� ã�Ƴ��� �ڵ����� ��ũ�� �������ִ� �Լ�
	function rg_autolink(&$str) {
	//  $agent = get_agent_lib();
	
		$regex[file] = "gz|tgz|tar|gzip|zip|rar|mpeg|mpg|exe|rpm|dep|rm|ram|asf|ace|viv|avi|mid|gif|jpg|png|bmp|eps|mov";
		$regex[file] = "(\.($regex[file])\") TARGET=\"_blank\"";
		$regex[http] = "(http|https|ftp|telnet|news|mms):\/\/(([\xA1-\xFEa-z0-9:_\-]+\.[\xA1-\xFEa-z0-9,:;&#=_~%\[\]?\/.,+\-]+)([.]*[\/a-z0-9\[\]]|=[\xA1-\xFE]+))";
		$regex[mail] = "([\xA1-\xFEa-z0-9_.-]+)@([\xA1-\xFEa-z0-9_-]+\.[\xA1-\xFEa-z0-9._-]*[a-z]{2,3}(\?[\xA1-\xFEa-z0-9=&\?]+)*)";
	
		# &lt; �� �����ؼ� 3�ٵڿ� &gt; �� ���� ����
		# IMG tag �� A tag �� ��� ��ũ�� �����ٿ� ���� �̷���� ���� ���
		# �̸� ���ٷ� ��ħ (��ġ�鼭 �ΰ� �ɼǵ��� ��� ������)
		$src[] = "/<([^<>\n]*)\n([^<>\n]+)\n([^<>\n]*)>/i";
		$tar[] = "<\\1\\2\\3>";
		$src[] = "/<([^<>\n]*)\n([^\n<>]*)>/i";
		$tar[] = "<\\1\\2>";
		$src[] = "/<(A|IMG)[^>]*(HREF|SRC)[^=]*=[ '\"\n]*($regex[http]|mailto:$regex[mail])[^>]*>/i";
		$tar[] = "<\\1 \\2=\"\\3\">";
	
		# email �����̳� URL �� ���Ե� ��� URL ��ȣ�� ���� @ �� ġȯ
		$src[] = "/(http|https|ftp|telnet|news|mms):\/\/([^ \n@]+)@/i";
		$tar[] = "\\1://\\2_HTTPAT_\\3";
	
		# Ư�� ���ڸ� ġȯ �� html���� link ��ȣ
		$src[] = "/&(quot|gt|lt)/i";
		$tar[] = "!\\1";
		
		// 3.0.11 ���� �߰�
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
	
		# ��ũ�� �ȵ� url�� email address �ڵ���ũ
		$src[] = "/((SRC|HREF|BASE|GROUND)[ ]*=[ ]*|[^=]|^)($regex[http])/i";
		$tar[] = "\\1<A HREF=\"\\3\" TARGET=\"_blank\">\\3</a>";
		$src[] = "/($regex[mail])/i";
		$tar[] = "<A HREF=\"mailto:\\1\">\\1</a>";
		$src[] = "/<A HREF=[^>]+>(<A HREF=[^>]+>)/i";
		$tar[] = "\\1";
		$src[] = "/<\/A><\/A>/i";
		$tar[] = "</A>";
	
		# ��ȣ�� ���� ġȯ�� �͵��� ����
		$src[] = "/!(quot|gt|lt)/i";
		$tar[] = "&\\1";

		$src[] = "/(http|https|ftp|telnet|news|mms)_orig/i";
		$tar[] = "\\1";
		$src[] = "'#-#'";
		$tar[] = "@";
		$src[] = "/$regex[file]/i";
		$tar[] = "\\1";
	
		# email �ּҸ� ������ �� URL ���� @ �� ����
		$src[] = "/_HTTPAT_/";
		$tar[] = "@";
	
		# �̹����� ������ 0 �� ����
		$src[] = "/<(IMG SRC=\"[^\"]+\")>/i";
		$tar[] = "<\\1 BORDER=0>";
	
		# IE �� �ƴ� ��� embed tag �� ������
		if($agent[br] != "MSIE") {
			$src[] = "/<embed/i";
			$tar[] = "&lt;embed";
		}
	
		$str = preg_replace($src,$tar,$str);
		return $str;
	}
		
	/*******************************************************************************
	* �ֹι�ȣ �˻�
	******************************************************************************/
	function rg_check_jumun($reginum) { 
		$weight = '234567892345'; // �ڸ��� weight ���� 
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
	
	// ������ ���, ���������� ����, ������ġ ����
	function rg_navigation(&$page,$row_count,$page_size=10,$display_page=10) {
		if(empty($page_size)) $page_size = 10;
		if(empty($display_page)) $display_page = 10;
	
		$_result = array();
		$total_page=ceil($row_count/$page_size);
		if($page>$total_page) $page=$total_page;
		if(empty($page)) $page = 1;
	
		$start_row=($page-1)*$page_size;
		if($start_row<0)$start_row=0;
		
		$_result[page] = $page;								// ����������
		$_result[offset] = $start_row;				// ������ ���� ��ġ
		$_result[rows] = $page_size;					// ��Ͽ� ������ ���ڵ� ����
		$_result[total_rows] = $row_count;		// ��ü ���ù� ����
		$_result[page_rows] = $display_page;	// ����� �������� ��
		$_result[total_page] = $total_page;		// ��ü ������ ��
	
		$start_page=floor(($page-1)/$display_page)*$display_page+1;
		if($start_page<1)$start_page=1;
		$end_page=$start_page+$display_page;
		if($end_page>$total_page)$end_page=$total_page+1; 
	
		if($end_page<=1)$end_page=2; 
	
		$prior_page=$page-$display_page;				// ���� 10������

		$next_page=$page+$display_page;					// ���� 10������
	
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


	# ���丮�� ���� ����Ʈ�� �޴� �Լ�
	# path  -> ���ϸ���Ʈ�� ���� ���丮 ���
	# t     -> ����Ʈ�� ���� ���
	#          f  : ������ ���丮�� ���ϸ� ����
	#          d  : ������ ���丮�� ���丮�� ����
	#          l  : ������ ���丮�� ��ũ�� ����
	#          fd : ������ ���丮�� ���ϰ� ���丮�� ����
	#          fl : ������ ���丮�� ���ϰ� ��ũ�� ����
	#          dl : ������ ���丮�� ���丮�� ��ũ�� ����
	#          �ƹ��͵� �������� �ʾ��� ��쿡�� fdl ��� ����
	# regex -> ǥ������ ����� �� ������, regex �� �����ϸ� t ��
	#          e �� ���ǵǾ���.
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

	// input �Ǵ� textarea�� ����� �ݾ��� �ͽ��϶� �����Ͽ� ����
	function size($size) {
		global $agent;
		if($agent[br]=='MSIE') return $size;
		else return round($size*0.6);
	}

	# ������ ����� ����ϴ� �������� �˱� ���� ���Ǵ� �Լ�, ����� FORM
	# �Է�â�� ũ�Ⱑ ���������� Ʋ���� �����Ǵ� ���� �����ϱ� ���� ����
	function rg_get_agent() {
		$agent_env = $GLOBALS[HTTP_USER_AGENT];
	
		# $agent �迭 ���� [br] ������ ����
		#                  [os] �ü��
		#                  [ln] ��� (�ݽ�������)
		#                  [vr] ������ ����
		#                  [co] ���� ����
		if(ereg("MSIE", $agent_env)) {
			$agent[br] = "MSIE";
			# OS �� ����
			if(ereg("NT", $agent_env)) $agent[os] = "NT";
			else if(ereg("Win", $agent_env)) $agent[os] = "WIN";
			else $agent[os] = "OTHER";
			# version ����
			$agent[vr] = trim(eregi_replace("Mo.+MSIE ([^;]+);.+","\\1",$agent_env));
			$agent[vr] = eregi_replace("[a-z]","",$agent[vr]);
		} else if(eregi("Gecko|Galeon",$agent_env) && !eregi("Netscape",$agent_env)) {
			$agent[br] = "MOZL";
			# client OS ����
			if(ereg("NT", $agent_env)) $agent[os] = "NT";
			else if(ereg("Win", $agent_env)) $agent[os] = "WIN";
			else if(ereg("Linux", $agent_env)) $agent[os] = "LINUX";
			else $agent[os] = "OTHER";
			# version ����
			$agent[vr] = eregi_replace("Mozi[^(]+\([^;]+;[^;]+;[^;]+;[^;]+;([^)]+)\).*","\\1",$agent_env);
			$agent[vr] = str_replace("rv:","",$agent[vr]);
			# NS ���� ���� ����
			$agent[co] = "mozilla";
		} else if(ereg("Konqueror",$agent_env)) {
			$agent[br] = "KONQ";
		} else if(ereg("Lynx", $agent_env)) {
			$agent[br] = "LYNX";
		} else if(ereg("^Mozilla", $agent_env)) {
			$agent[br] = "NS";
			# client OS ����
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
			# version ����
			if(eregi("Gecko",$agent_env)) $agent[vr] = "6";
			else $agent[vr] = "4";
			# Mozilla ���� ���� ����
			$agent[co] = "mozilla";
		} else $agent[br] = "OTHER";
	
		return $agent;
	}
	// ȭ���� �����Ѵ�.
	// �ۼ��� ������
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
			echo "$body"; // ȭ�ϳ����� �о �������� �����ش�. 
		} 
		fclose($fp);
		return true;
	}	
	
	// �ֱٱ� ���� �Լ� 
/**************************************************************************
	rg_lastest('��Ų','�Խ��Ǿ��̵�','����',��ϼ�,
	           �������,'���̺��ٱ涧ǥ�ù���',���Ĺ��)
	���Ĺ�� �迭������ ����
	array('�ʵ��'=>'���Ĺ��','�ʵ��'=>'���Ĺ��'....)	
	���Ĺ�� 1 �̸� DESC 
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
		
		// ���Ĺ���� ���ٸ� �۹�ȣ�� ����
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
			// ī�װ� ��������
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
			// ȸ�������� 10���ϸ� html �� ����Ҽ� ����.
			if($mb_level<10) {
				$rg_title = rg_conv_text($rg_title);
				$rg_name = rg_conv_text($rg_name);
				$rg_email = rg_conv_text($rg_email);
			}
			if($mb_icon) { // �������� �ִٸ� 
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
	
	// �ܺηα���
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
	
	// ������ üũ list�� , �� �и� 
	// ����Ʈ �ȿ� ip�� �ִ���
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
	
	// $str �ȿ� $list �� �ִ��� �˻�
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

	// $str �ȿ� $list �±׸� ��ȯ�Ѵ�.
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
	
	// ���� ���丮�� ������ ���� �����Ѵ�.
	function rg_delete_board_file($path) { // ��������� ������ �����.
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

	
	// �Խ��� ���� �����Ѵ�.
	function rg_bbs_doc_del($bbs_id,$rg_doc_num) {
		global $dbcon,$data_path,$bbs_cfg,
					 $db_table_prefix,$db_table_suffix_body,
					 $db_table_suffix_comment;
					 
		$bbs_data_path = $data_path.$bbs_id.'/';
		
		// �Խ��� ���̺� ���� ����
		$bbs_table = $db_table_prefix.$bbs_id.$db_table_suffix_body;
		$commant_table = $db_table_prefix.$bbs_id.$db_table_suffix_comment;
		
		$data = rg_get_doc_info($bbs_id,$rg_doc_num);
	
		// ������ �����.
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
			
			// �����ۺ��� admin_orderby ���� ũ�� �ϳ��� ������.
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
		// �����ۺ��� next_num �� ũ�� �ϳ��� ������.
		$dbqry="
			UPDATE `$bbs_table` SET
				`rg_next_num` = `rg_next_num` - 1
			WHERE rg_next_num > '$data[rg_next_num]'
		";
		query($dbqry,$dbcon);
		
		// ���� �����Ѵ�.
		$dbqry="
			DELETE FROM `$bbs_table`
			WHERE rg_doc_num = '$rg_doc_num'
		";
		query($dbqry,$dbcon);
		
		// �ڸ�Ʈ ����
		$dbqry="
			DELETE FROM `$commant_table`
			WHERE cmt_doc_num = '$rg_doc_num'
		";
		$rs=query($dbqry,$dbcon);
		
	}

	
	
	// �Խ��� ���� �����Ѵ�.
	function rg_bbs_doc_copy($target_bbs_id,$source_bbs_id,$source_rg_doc_num) {
		global $dbcon,$data_path,
		   $db_table_prefix,$db_table_suffix_body,$db_table_suffix_comment;
			 
		$src_bbs_data_path = $data_path.$source_bbs_id.'/';
		$tar_bbs_data_path = $data_path.$target_bbs_id.'/';
		
		// �Խ��� ���̺� ���� ����
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
		// ���������� �ƴѰ�� next_num ���� ���Ѵ�
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
		
		//$rg_content.='��. '.$mb[mb_show_name]."�Կ� ���� ����(�̵�)�Ǿ����ϴ�. (".rg_date(time()).")";

		// ����������  next_num�� �ϳ��� �ø���.
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

		// ���� ���� 
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
					
		
		// �ڸ�Ʈ ����
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
	
	// ��ǥ�ϱ� 
	// rg_vote_preview('��Ų��','�˾�����')
	// �˾����� 1:�˾�, 0:����â
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
		// ����üũ
		$tmp = array(1=>"comment",2=>"auth",3=>"show");
		if($group[gr_level_type]) {
			$tmp_level = $group_member[gm_level];
		} else {
			$tmp_level = $mb[mb_level];
		}

		foreach($tmp as $key => $val) {
			switch(${"vt_cfg_$val"}) {
				case 'A' : $vote_auth["{$val}"] = true;break;// ��ü 
				case 'M' : $vote_auth["{$val}"] = ($mb)?true:false;break;// ȸ�� 
				case 'D' :
				case 10 : $vote_auth["{$val}"] = ($auth[admin])?true:false;break;// ��� 
				case 'N' : $vote_auth["{$val}"] = false;break;// ������
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
				default : // ������ ����
						$vote_auth["{$val}"] = ($tmp_level>${"vt_cfg_$val"})?true:false;
						break;
	//					$error_msg = '�߸��� �����Դϴ�.';
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

		// ��ǥ�Ⱓ�� üũ 
		$vote_expired = !(($vt_start < $now) && ($now < $vt_end));
		// �ߺ���ǥüũ 
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
		// ��ǥ�����ϴٸ� 
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

		// ������ �ε�
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
		// ��ǥ �Ⱓ�� �ƴ� 
		if($vote_expired) {
			include($skin_vote_path."vote1.php");
		// �̹���ǥ�Ѱ�� 
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
	{ //������ �ۺ���
			//�������ϸ�
			$FileName = $rg_doc_num.'\$'.$fi.'\$'.$rg_file_name;
			if($fi > 1){
				//�������ϸ�(������)
				$FileName2_d = $rg_doc_num.'$'.$fi.'$'.$rg_file_name;
			}
			//���� ���� �̸�
			$ThumFileName = $rg_doc_num.'\$'.$fi.'\$th2\$'.$rg_file_name;				
			
			//�������� ���
			$path=dirname(realpath(__FILE__)); 
			$top_path=substr($path, 0, strpos($path, "public_html")); 
			$ori_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName;
			if($fi > 1){
				$ori_del_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName2_d;
			}
			//���� ���� ���				
			$ThumFileName_url = $top_path."public_html/bbs/data/".$bbs_id."/".$ThumFileName;

			exec ("convert -geometry 600x $ori_path $ThumFileName_url");
			if($fi > 1){ //÷������ 2������ ����� ��������� ������ ������
				if(file_exists("$ori_del_path")){ 
					unlink ("$ori_del_path");	
				}
			}
	}
	function MakeThum_Gall_List($rg_doc_num,$fi,$bbs_id,$rg_file_name,$thum_width) 
	{
			$path=dirname(realpath(__FILE__)); 
			$top_path=substr($path, 0, strpos($path, "public_html")); 

			//����Ϸ� ��ȯ�� ����
			$FileName = $rg_doc_num.'\$'.$fi.'\$th2\$'.$rg_file_name;			
			//���� ����
			$FileName2 = $rg_doc_num.'\$'.$fi.'\$'.$rg_file_name;
			//�������ϸ�(������)
			$FileName2_d = $rg_doc_num.'$'.$fi.'$'.$rg_file_name;

			//������ �Ȱ� ���� �װŷ� ���� ���� �������� �����     
			if(file_exists($top_path."public_html/bbs/data/".$bbs_id."/"."{$rg_doc_num}\$$fi\$th2\$".$rg_file_name)) {				
					$FileName = $FileName;
			}else{						
					$FileName = $FileName2;
			}
			//���� ���� �̸�
			$ThumFileName = $rg_doc_num.'\$'.$fi.'\$th\$'.$rg_file_name;		
			
			//�������� ���
			$ori_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName;
			
			$ori_del_path=$top_path."public_html/bbs/data/".$bbs_id."/".$FileName2_d;

			//���� ���� ���				
			$ThumFileName_url = $top_path."public_html/bbs/data/".$bbs_id."/".$ThumFileName;

			$thum_widthx = $thum_width."x";

			exec ("convert -geometry $thum_widthx $ori_path $ThumFileName_url");

			if(file_exists($top_path."public_html/bbs/data/".$bbs_id."/"."{$rg_doc_num}\$$fi\$th2\$".$rg_file_name)) {
				if(file_exists("$ori_del_path")){ 
					unlink ("$ori_del_path");	//������̸� �����ϰ� �����̸� ��������
				}
			}
	}
} // *-- FUNC_INC_INCLUDED END --*
?>
