<?
	$site_path = '../';
	include($site_path."include/config.inc.php"); 
	include($site_path."include/mysql.inc.php"); 
	include($site_path."include/func.inc.php"); 
	include($site_path."include/schema.inc.php"); 
	clearstatcache();

	if (file_exists($site_path.$data_dir."db.inc.php")) { // 이미 설치되어 있음
		$msg="
이미 db.inc.php 파일이 있습니다.<br>
재설치 하시려면 해당 파일과 데이타베이스를 초기화 하신후 실행 하시기 바랍니다.";
		include("error.inc.php");
	}
	
	if(!is_dir($site_path.$data_dir)) {
		$msg="data 디렉토리를 찾을수 없습니다.<br>
확인해주세요.";
		include("error.inc.php");
	}
	
	$data_chk_perms = @fileperms($site_path.$data_dir);
	$data_chk_perms=decoct($data_chk_perms);
	$data_chk_perms=substr($data_chk_perms,-1);

	$editor_data_chk_perms = @fileperms($site_path.$editor_data_dir);
	$editor_data_chk_perms=decoct($editor_data_chk_perms);
	$editor_data_chk_perms=substr($editor_data_chk_perms,-1);

	if($data_chk_perms!='7' || $editor_data_chk_perms != '7') {
		$msg="
editor/upload/ <br>
data <br>
디렉토리의 권한을 707또는 777으로 변경해주시기 바랍니다.<br>
변경방법은 ftp 를 이용하셨을 경우 권한 설정시 Owner(소유자) 와 Group(그룹), Other(모든사용자) 의 권한을 읽기,쓰기,실행이 가능하도록 체크해시고, <br>
telnet 또는 SSH를 이용하실경우 명령어 chmod 707 data 로 변경하실수가 있습니다.<br><br>
변경하셨으면 확인 버튼을 눌러주세요.<br>
<input type=\"button\" onclick=\"location.reload()\" value=\" 확 인 \">
";
		include("error.inc.php");
	}
	
	if($HTTP_POST_VARS['act']) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
	
		if(!$mysql_host || !$mysql_user || !$mysql_password || !$mysql_database_name) {
			rg_href('','mysql정보를 빠짐없이 입력해주세요.','','back');
		}
		$dbcon=@mysql_connect($mysql_host, $mysql_user, $mysql_password);
		if(!$dbcon) {
			echo "데이타베이스 서버에 접속할수 없습니다.<br>
	호스트,사용자아이디,암호를 확인해주세요.<br>
	에러 : ".mysql_error();
			exit;
		}
		if(!@mysql_select_db($mysql_database_name,$dbcon)) {
				echo "데이타베이스에 접속 할수 없습니다.<br>
	데이타베이스명을 확인하세요.<br>			
	에러 : ".mysql_error();
				exit;
		}
		
		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		unset($chk);
		$chk[] = $db_table_member;
		$chk[] = $db_table_site_cfg;
		$chk[] = $db_table_group_cfg;
		$chk[] = $db_table_group_member;
		$chk[] = $db_table_bbs_cfg;
		$chk[] = $db_table_zip;
		$chk[] = $db_table_connect;
		$chk[] = $db_table_memo;
		while($tmp = mysql_fetch_array($rs)) {
			if(in_array($tmp[0],$chk)) {
				rg_href('delete_rgboard.php','데이타베이스에 이미 테이블이 있습니다.\n재설치 하시려면 보드관련 테이블을 모두 삭제해주신후 실행해주세요.');		
			}
		}
		
		$fp = fopen($site_path.$data_dir."db.inc.php", "wb");
		if(!$fp) {
			$msg="
데이타베이스 정보를 저장할수 없습니다.<br>
서버관리자에게 문의해주세요.<br>
";
			include("error.inc.php");
		}
		$dbcfg="<"."?
echo \"<script>alert('잘못된 접근입니다.(보드로 ...)');location='http://lets080.com'</script>\";exit;
/*
$mysql_host
$mysql_user
$mysql_password
$mysql_database_name
*/
?".">		
";
		if(!fputs($fp, $dbcfg)) {
			$msg="
데이타베이스 정보를 저장할수 없습니다.<br>
서버관리자에게 문의해주세요.<br>
";
			include("error.inc.php");
		}
		fclose($fp);

		// 게시판설정테이블 생성
		$dbqry = "
				CREATE TABLE `$db_table_bbs_cfg`
				$mysql_schema_bbs_cfg
			";
		query($dbqry,$dbcon);
			// 그룹설정
		$dbqry = "
				CREATE TABLE `$db_table_group_cfg`
				$mysql_schema_group_cfg
			";
		query($dbqry,$dbcon);
		// 그룹회원설정
		$dbqry = "
				CREATE TABLE `$db_table_group_member`
				$mysql_schema_group_member
			";
		query($dbqry,$dbcon);
	
		// 회원설정
		$dbqry = "
				CREATE TABLE `$db_table_member`
				$mysql_schema_member
			";
		query($dbqry,$dbcon);
	
		// 기본사이트설정
		$dbqry = "
				CREATE TABLE `$db_table_site_cfg`
				$mysql_schema_site_cfg
			";
		query($dbqry,$dbcon);

		// 현재접속자
		$dbqry = "
				CREATE TABLE `$db_table_connect`
				$mysql_schema_connect
			";
		query($dbqry,$dbcon);

		// 쪽지
		$dbqry = "
				CREATE TABLE `$db_table_memo`
				$mysql_schema_memo
			";
		query($dbqry,$dbcon);
		
		// 접속통계
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}count_stat`
				$mysql_schema_count_stat
			";
		query($dbqry,$dbcon);
		
		// 접속통계 아이피목록
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}count_ip`
				$mysql_schema_count_ip
			";
		query($dbqry,$dbcon);

		// 투표설정
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_cfg`
				$mysql_schema_vote_cfg
			";
		query($dbqry,$dbcon);

		// 투표 코멘트
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_cmt`
				$mysql_schema_vote_cmt
			";
		query($dbqry,$dbcon);
	
		// 투표 아이피 
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_ip`
				$mysql_schema_vote_ip
			";
		query($dbqry,$dbcon);

	 	//투표 항목 
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_item`
				$mysql_schema_vote_item
			";
		query($dbqry,$dbcon);

		// 카운터 브라우저/os 테이블
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_browser`
				$mysql_schema_counter_browser
			";
		query($dbqry,$dbcon);

		// 카운터 아이피 테이블
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_ip`
				$mysql_schema_counter_ip
			";
		query($dbqry,$dbcon);

		// 카운터 로그 테이블
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_log`
				$mysql_schema_counter_log
			";
		query($dbqry,$dbcon);

		// 카운터 페이지 테이블
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_page`
				$mysql_schema_counter_page
			";
		query($dbqry,$dbcon);

		// 카운터 레퍼럴 테이블
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_ref`
				$mysql_schema_counter_ref
			";
		query($dbqry,$dbcon);
		
		// 기본데이타 추가.
		for($i=0;$i<count($mysql_site_data);$i++) {
			$dbqry = "
				INSERT INTO `{$db_table_site_cfg}`
				VALUES 
				$mysql_site_data[$i]
			";
			query($dbqry,$dbcon);
		}
		for($i=0;$i<count($mysql_group_data);$i++) {
			$dbqry = "
				INSERT INTO `{$db_table_group_cfg}`
				VALUES 
				$mysql_group_data[$i]
			";
			query($dbqry,$dbcon);
		}

		// 기본 데이타디렉토리 설정
		if(!is_dir($site_path.$data_dir.$member_icon_dir))
		{
			@mkdir($site_path.$data_dir.$member_icon_dir,0707);
			@chmod($site_path.$data_dir.$member_icon_dir,0707);
		}

		if(!is_dir($site_path.$data_dir.$member_photo_dir))
		{
			@mkdir($site_path.$data_dir.$member_photo_dir,0707);
			@chmod($site_path.$data_dir.$member_photo_dir,0707);
		}

		if(!is_dir($site_path.$data_dir.$session_tmp_dir))
		{
			@mkdir($site_path.$data_dir.$session_tmp_dir,0707);
			@chmod($site_path.$data_dir.$session_tmp_dir,0707);
		}

		rg_href('install_1.php');
		exit;
	}
?>
<? include("admin.header.php"); ?>
<form name="form1" method="post" action="">
<input name="act" type="hidden" value="ok">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="center" width="500">보드 설치 환경입니다.<br> MySql 정보를 정확히 입력하여 주십시오.</td>
    </tr>
  </table>
  <br>
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">Host Name :&nbsp;</td>
      <td><input name="mysql_host" type="text" id="mysql_host" value="localhost" required itemname="Host Name">
        <font color="#FF0000">mysql 호스트 명</font></td>
    </tr>
    <tr> 
      <td width="150" height="24" align="right" bgcolor="#F7F7F7">User ID :&nbsp;</td>
      <td><input name="mysql_user" type="text" id="mysql_user" required itemname="User ID">
        <font color="#FF0000">mysql 접속 사용자명</font></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">User Password :&nbsp;</td>
      <td><input name="mysql_password" type="password" id="mysql_password" required itemname="User Password">
        <font color="#FF0000">mysql 사용자 암호</font></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">DB Name :&nbsp;</td>
      <td><input name="mysql_database_name" type="text" id="mysql_database_name" required itemname="DB Name">
        <font color="#FF0000">mysql 사용데이타베이스명</font></td>
    </tr>
  </table>
  <br>
  <div align="center">
    <input type="submit" class="button1" value=" 확  인 ">
  </div>
</form>
<?
	include("admin.footer.php");
?>