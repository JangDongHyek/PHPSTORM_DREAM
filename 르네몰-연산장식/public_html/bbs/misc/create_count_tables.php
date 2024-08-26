<?
/*
보드 카운터 테이블생성 프로그램

설치법입니다. 

count_stat.zip 를 다운로드 받으신후 count_stat.php 는 addon 디렉토리에  create_count_tables.php는 admin 디렉토리에 올리세요. 

[테이블생성] 
관리자로 로그인 한다음 
http://도메인/보드경로/admin/create_count_tables.php 하신후 확인누르시면 접속통계에 필요한 테이블이 생성되어집니다. 

[프로그램추가] 
보드처럼 왼쪽하단에 나오게 하려면 addon/head.php 를 열어서 49번째줄쯤 
<? include($site_path."addon/connect_list.php")?> 
요 및에 아래와 같이 소스를 추가해주세요. 

<br> 
<? include($site_path."addon/count_stat.php")?> 

다음에 보드에 접속해보시면 통계가 나올것입니다. 

[동작방식] 
1일동안 접속한 IP를 테이블에 저장하여 체크를 하고, 서버의 안정을 위하여 1일이 지난 IP는 자동삭제되도록 프로그램 되었습니다. 

실행방법
admin 디렉토리 안에 올리신후
보드경로/admin/create_count_tables.php 하신후
확인누르시면 됩니다.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	if($act) {
		// 보드 관련테이블 삭제

		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		$table1_exist = false;
		$table2_exist = false;
		while($tmp = mysql_fetch_array($rs)) {
			if($db_table_prefix."count_stat"==$tmp[0]) {
				$table1_exist = true;
			}
			if($db_table_prefix."count_ip"==$tmp[0]) {
				$table2_exist = true;
			}
			if($table1_exist && $table2_exist) break;
		}
		if(!$table1_exist) {
			$dbqry="
				CREATE TABLE `{$db_table_prefix}count_stat` (
				`num` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`today_count` INT NOT NULL ,
				`yesterday_count` INT NOT NULL ,
				`total_count` INT NOT NULL ,
				`max_conn_count` INT NOT NULL ,
				`max_count` INT NOT NULL ,
				`today_date` DATE NOT NULL ,
				`ip` VARCHAR( 20 ) NOT NULL 
				) COMMENT = '통계테이블'
			";
			$rs=query($dbqry,$dbcon);
		}
		if(!$table2_exist) {
			$dbqry="
				CREATE TABLE `{$db_table_prefix}count_ip` (
					`num` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`ip` VARCHAR( 20 ) NOT NULL ,
					`count_date` DATE NOT NULL ,
					INDEX ( `ip` , `count_date` ) 
				) COMMENT = '통계 아이피 체크'
			";
			$rs=query($dbqry,$dbcon);
		}
		rg_href("/","보드용 통계 테이블을 생성하였습니다.");
	}

?>
<? include("../admin/admin.header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <table width="100%" cellspacing="0" style="border-collapse:collapse;">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="silver" class="line1"> 
              보드용 통계테이블을 생성합니다.<br>
							</td>
          </tr>
        </table>
        <br>
        <input type="submit" value="생성">
        <a href="javascript:history.back()">취소</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>