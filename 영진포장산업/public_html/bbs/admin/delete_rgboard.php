<?
/*
보드 모든 데이타베이스 테이블 삭제프로그램 

실행방법
admin 디렉토리 안에 올리신후
보드경로/admin/drop_all_tables.php 하신후
확인누르시면 됩니다.
*/
	
	$site_path = '../';
	include($site_path."include/config.inc.php"); 
	include($site_path."include/mysql.inc.php"); 
	include($site_path."include/func.inc.php"); 
	
	if($act) {

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
		
		// 테이블 삭제

		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		while($tmp = mysql_fetch_array($rs)) {
			if(eregi("^($db_table_prefix)",$tmp[0])) {
				query("drop table $tmp[0] ",$dbcon);
			}
		}
		rg_delete_board_file($site_path.$data_dir);
		rg_href("/","데이타베이스 테이블을 전부 삭제하였습니다.");
	}

?>
<? include("../admin/admin.header.php"); ?>
<form name="form1" method="post" action="" onSubmit="if(!confirm('삭제된 정보는 다시 살릴수 없습니다.\n확실합니까?')) return false;">
  <input name="act" type="hidden" value="ok">
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="124" align="center"><a href="./"><img src="images/main_1.gif" border="0"></a></td>
      <td align="center">사용하시던 보드 데이타베이스의<br> 모든테이블을 삭제합니다.<br>
        <font color="#FF0000">모든 정보가 삭제되니 신중하게<br> 실행해주시기 바랍니다.</font><br>
      </td>
    </tr>
  </table>
  <br>
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
  <div align="center"> <br>
    <br>
    <input name="submit" type="submit" class="button1" value="  확  인  ">
  </div>
</form>
<? include("../admin/admin.footer.php"); ?>