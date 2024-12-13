<?
/*
보드 투표 테이블생성 프로그램
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	$chk = false;
	$dbqry="
		SHOW TABLES
	";
	$rs=query($dbqry,$dbcon);
	while($tmp = mysql_fetch_array($rs)) {
		if($tmp[0] == $db_table_prefix."vote_cfg") {
			rg_href('','투표 테이블이 있습니다.','','back');		
		}
	}

	if($act) {
		// 투표테이블 생성

		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		while($tmp = mysql_fetch_array($rs)) {
			$table_exist[$tmp[0]] = true;
		}
		// 투표설정 테이블
		if(!$table_exist[$db_table_prefix."vote_cfg"]) {
			$dbqry="
			CREATE TABLE {$db_table_prefix}vote_cfg (
				vt_num int(11) NOT NULL auto_increment,
				vt_start int(11) NOT NULL default '0',
				vt_end int(11) NOT NULL default '0',
				vt_regdate int(11) NOT NULL default '0',
				vt_skin varchar(255) NOT NULL default '',
				vt_question varchar(255) NOT NULL default '',
				vt_header_file varchar(255) NOT NULL default '',
				vt_header_tag text NOT NULL,
				vt_footer_file varchar(255) NOT NULL default '',
				vt_footer_tag text NOT NULL,
				vt_cfg_repeat int(1) NOT NULL default '0',
				vt_cfg_comment char(2) NOT NULL default '',
				vt_cfg_auth char(2) NOT NULL default '',
				vt_cfg_show char(2) NOT NULL default '',
			  vt_cmt_count int(10) unsigned NOT NULL default '0',
				PRIMARY KEY  (vt_num),
				KEY vt_start (vt_start,vt_end)
			) TYPE=MyISAM COMMENT='투표 설정 테이블'
			";
			$rs=query($dbqry,$dbcon);
		}
		
		//투표 코멘트
		if(!$table_exist[$db_table_prefix."vote_cmt"]) {
			$dbqry="
			CREATE TABLE {$db_table_prefix}vote_cmt (
				vtc_num int(11) NOT NULL auto_increment,
				vtc_vt_num int(11) NOT NULL default '0',
				vtc_mb_num int(11) NOT NULL default '0',
				vtc_name varchar(255) NOT NULL default '',
				vtc_password varchar(255) NOT NULL default '',
				vtc_email varchar(255) NOT NULL default '',
				vtc_comment text NOT NULL,
				vtc_reg_date int(11) NOT NULL default '0',
				vtc_reg_ip varchar(20) NOT NULL default '',
				PRIMARY KEY  (vtc_num),
				KEY vtc_vt_num (vtc_vt_num,vtc_mb_num)
			) TYPE=MyISAM COMMENT='투표 코멘트'
			";
			$rs=query($dbqry,$dbcon);
		}

		//투표 아이피 
		if(!$table_exist[$db_table_prefix."vote_ip"]) {
			$dbqry="
			CREATE TABLE {$db_table_prefix}vote_ip (
				vip_num int(11) NOT NULL auto_increment,
				vip_vt_num int(11) NOT NULL default '0',
				vip_vit_num int(11) NOT NULL default '0',
				vip_mb_num int(11) NOT NULL default '0',
				vip_ip varchar(20) NOT NULL default '',
				vip_date int(11) NOT NULL default '0',
				PRIMARY KEY  (vip_num),
				KEY vip_vt_num (vip_vt_num,vip_vit_num,vip_mb_num,vip_ip),
				KEY vip_date (vip_date)
			) TYPE=MyISAM COMMENT='투표 아이피 목록'
			";
			$rs=query($dbqry,$dbcon);
		}

		//투표 항목
		if(!$table_exist[$db_table_prefix."vote_item"]) {
			$dbqry="
			CREATE TABLE {$db_table_prefix}vote_item (
				vit_num int(11) NOT NULL auto_increment,
				vit_vt_num int(11) NOT NULL default '0',
				vit_order int(11) NOT NULL default '0',
				vit_item varchar(255) NOT NULL default '',
				vit_count int(11) NOT NULL default '0',
				PRIMARY KEY  (vit_num),
				KEY vit_vt_num (vit_vt_num,vit_order)
			) TYPE=MyISAM COMMENT='투표 항목 테이블'
			";
			$rs=query($dbqry,$dbcon);
		}

		rg_href("admin.sub_menu2.php","보드용 투표 테이블을 생성하였습니다.");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <br>
        <table width="70%" border="1" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="f7f7f7">보드용 
              투표 테이블을 생성합니다</td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" 확     인 ">
        <br>
        <br>
        <a href="admin.sub_menu2.php"><img src="images/list_mb.gif" border="0"></a> 
      </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>