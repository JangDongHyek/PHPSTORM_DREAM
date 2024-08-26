<?
if (!defined('SCHEMA_INC_INCLUDED')) {  
    define('SCHEMA_INC_INCLUDED', 1);
// *-- SCHEMA_INC_INCLUDED START --*
	// 게시판
	$mysql_schema_bbs_body = "
		(
			rg_doc_num int(20) NOT NULL auto_increment,
			rg_top_num int(20) NOT NULL default '0',
			rg_parent_num int(20) NOT NULL default '0',
			rg_sequence int(20) NOT NULL default '0',
			rg_depth int(3) NOT NULL default '0',
			rg_next_num int(20) NOT NULL default '0',
			rg_cat_num int(10) NOT NULL default '0',
			rg_mb_num int(20) NOT NULL default '0',
			rg_name varchar(255) NOT NULL default '',
			rg_password varchar(255) NOT NULL default '',
			rg_email varchar(255) NOT NULL default '',
			rg_home_url varchar(255) NOT NULL default '',
			rg_home_hit int(20) NOT NULL default '0',
			rg_link1_url varchar(255) NOT NULL default '',
			rg_link2_url varchar(255) NOT NULL default '',
			rg_link1_hit int(20) NOT NULL default '0',
			rg_link2_hit int(20) NOT NULL default '0',
			rg_file1_name varchar(255) NOT NULL default '',
			rg_file2_name varchar(255) NOT NULL default '',
			rg_file1_size int(20) NOT NULL default '0',
			rg_file2_size int(20) NOT NULL default '0',
			rg_file1_hit int(20) NOT NULL default '0',
			rg_file2_hit int(20) NOT NULL default '0',
			rg_vote_yes int(20) NOT NULL default '0',
			rg_vote_no int(20) NOT NULL default '0',
			rg_doc_hit int(20) NOT NULL default '0',
			rg_cmt_count int(20) NOT NULL default '0',
			rg_title varchar(255) NOT NULL default '',
			rg_content text NOT NULL,
			rg_html_use int(3) NOT NULL default '0',
			rg_reg_date int(20) NOT NULL default '0',
			rg_modi_date int(20) NOT NULL default '0',
			rg_reg_ip varchar(20) NOT NULL default '',
			rg_modi_ip varchar(20) NOT NULL default '',
			rg_deleted int(1) NOT NULL default '0',
			rg_secret int(1) NOT NULL default '0',
			rg_vote_ip varchar(20) NOT NULL default '',
			rg_notice int(1) NOT NULL default '0',
			rg_reply_mail int(1) NOT NULL default '0',
			rg_agree int(1) NOT NULL default '0',
			rg_ext1 varchar(255) NOT NULL default '',
			rg_ext2 varchar(255) NOT NULL default '',
			rg_ext3 varchar(255) NOT NULL default '',
			rg_ext4 varchar(255) NOT NULL default '',
			rg_ext5 varchar(255) NOT NULL default '',
			admin_orderby int(11) default '0',
			PRIMARY KEY  (rg_doc_num),
			KEY rg_top_num (rg_top_num),
			KEY rg_cat_num (rg_cat_num),
			KEY rg_title (rg_title),
			KEY rg_name (rg_name),
			KEY rg_reply_mail (rg_reply_mail),
			KEY rg_notice (rg_notice),
			KEY rg_next_num (rg_next_num)
		) COMMENT='게시판 테이블'
	";
	
	// 카테고리
	$mysql_schema_bbs_category = "
		(
			cat_num int(20) NOT NULL auto_increment,
			cat_order int(20) NOT NULL default '0',
			cat_name varchar(255) NOT NULL default '',
			cat_count int(20) NOT NULL default '0',
			PRIMARY KEY  (cat_num),
			KEY cat_order (cat_order)
		) COMMENT='카테고리테이블'
	";
	
	// 코멘트
	$mysql_schema_bbs_comment = "
		(
			cmt_num int(20) NOT NULL auto_increment,
			cmt_doc_num int(20) NOT NULL default '0',
			cmt_mb_num int(20) NOT NULL default '0',
			cmt_name varchar(255) NOT NULL default '',
			cmt_password varchar(255) NOT NULL default '',
			cmt_email varchar(255) NOT NULL default '',
			cmt_comment text NOT NULL,
			cmt_reg_date int(20) NOT NULL default '0',
			cmt_reg_ip varchar(20) NOT NULL default '',
			PRIMARY KEY  (cmt_num),
			KEY cmt_doc_num (cmt_doc_num)
		) COMMENT='코멘트테이블'
	";
	
	// 게시판설정
	$mysql_schema_bbs_cfg = "
		(
		 	bbs_num int(20) NOT NULL auto_increment,
			bbs_id varchar(255) NOT NULL default '',
			bbs_gr_num int(20) NOT NULL default '0',
			bbs_name varchar(255) NOT NULL default '',
			bbs_header_file varchar(255) NOT NULL default '',
			bbs_header_tag text NOT NULL,
			bbs_footer_file varchar(255) NOT NULL default '',
			bbs_footer_tag text NOT NULL,
			bbs_charset varchar(255) NOT NULL default '',
			bbs_skin varchar(255) NOT NULL default '',
			bbs_title varchar(255) NOT NULL default '',
			bbs_bg_image varchar(255) NOT NULL default '',
			bbs_bg_color varchar(255) NOT NULL default '',
			bbs_body_tag varchar(255) NOT NULL default '',
			bbs_width varchar(20) NOT NULL default '0',
			bbs_align varchar(255) NOT NULL default '',
			bbs_admin_list text NOT NULL,
			bbs_cfg varchar(200) NOT NULL default '',
			bbs_file_count int(1) NOT NULL default '0',
			bbs_link_count int(1) NOT NULL default '0',
			bbs_file1_ext varchar(255) NOT NULL default '',
			bbs_file2_ext varchar(255) NOT NULL default '',
			bbs_html_text text NOT NULL,
			bbs_list_count int(20) NOT NULL default '0',
			bbs_act_after varchar(255) NOT NULL default '',
			bbs_page_count int(10) NOT NULL default '0',
			bbs_deny_write_ip text NOT NULL,
			bbs_deny_read_ip text NOT NULL,
			bbs_deny_word text NOT NULL,
			bbs_write_time int(20) NOT NULL default '0',
			bbs_new_time int(11) NOT NULL default '0',
			bbs_file1_size int(20) NOT NULL default '0',
			bbs_file2_size int(20) NOT NULL default '0',
			bbs_title_prefix varchar(255) NOT NULL default '',
			bbs_name_suffix varchar(255) NOT NULL default '',
			bbs_quota_mark varchar(255) NOT NULL default '',
			bbs_forward_prefix varchar(255) NOT NULL default '',
			bbs_default_content text NOT NULL,
			bbs_list_date_disp varchar(255) NOT NULL default '',
			bbs_view_date_disp varchar(255) NOT NULL default '',
			bbs_point_write int(11) NOT NULL default '0',
			bbs_point_reply int(11) NOT NULL default '0',
			bbs_point_comment int(11) NOT NULL default '0',
			bbs_reg_date int(20) NOT NULL default '0',
			bbs_ext_types varchar(6) NOT NULL default '0',
			bbs_ext_name1 varchar(255) NOT NULL default '',
			bbs_ext_value1 varchar(255) NOT NULL default '',
			bbs_ext_name2 varchar(255) NOT NULL default '',
			bbs_ext_value2 varchar(255) NOT NULL default '',
			bbs_ext_name3 varchar(255) NOT NULL default '',
			bbs_ext_value3 varchar(255) NOT NULL default '',
			bbs_ext_name4 varchar(255) NOT NULL default '',
			bbs_ext_value4 varchar(255) NOT NULL default '',
			bbs_ext_name5 varchar(255) NOT NULL default '',
			bbs_ext_value5 varchar(255) NOT NULL default '',
			PRIMARY KEY  (bbs_num),
			KEY bbs_id (bbs_id),
			KEY bbs_gr_num (bbs_gr_num)
		) COMMENT='게시판설정테이블'
	";
/*
	// 그룹설정
	$mysql_schema_group_cfg = "
		(
			gr_num int(20) NOT NULL auto_increment,
			gr_id varchar(255) NOT NULL default '',
			gr_owner_no int(20) NOT NULL default '0',
			gr_name varchar(255) NOT NULL default '',
			gr_header_file varchar(255) NOT NULL default '',
			gr_header_tag text NOT NULL,
			gr_footer_file varchar(255) NOT NULL default '',
			gr_footer_tag text NOT NULL,
			gr_intro text NOT NULL,
			gr_state int(1) NOT NULL default '0',
			gr_member_state int(1) NOT NULL default '0',
			gr_member_level int(2) NOT NULL default '0',
			gr_open int(1) NOT NULL default '0',
			gr_level_type int(1) NOT NULL default '0',
			gr_reg_date int(20) NOT NULL default '0',
			gr_total_member int(20) unsigned NOT NULL default '0', -- 2003-10-15 삭제
			gr_total_bbs int(20) unsigned NOT NULL default '0', -- 2003-10-15 삭제
			gr_name_disp int(1) NOT NULL default '0',
			gr_ext_types varchar(6) NOT NULL default '',
			gr_ext_name1 varchar(255) NOT NULL default '',
			gr_ext_value1 varchar(255) NOT NULL default '',
			gr_ext_name2 varchar(255) NOT NULL default '',
			gr_ext_value2 varchar(255) NOT NULL default '',
			gr_ext_name3 varchar(255) NOT NULL default '',
			gr_ext_value3 varchar(255) NOT NULL default '',
			gr_ext_name4 varchar(255) NOT NULL default '',
			gr_ext_value4 varchar(255) NOT NULL default '',
			gr_ext_name5 varchar(255) NOT NULL default '',
			gr_ext_value5 varchar(255) NOT NULL default '',
			PRIMARY KEY  (gr_num),
			KEY gr_id (gr_id)
		) COMMENT='그룹 테이블'
	";
*/
	// 그룹설정
	$mysql_schema_group_cfg = "
		(
			gr_num int(20) NOT NULL auto_increment,
			gr_id varchar(255) NOT NULL default '',
			gr_owner_no int(20) NOT NULL default '0',
			gr_name varchar(255) NOT NULL default '',
			gr_header_file varchar(255) NOT NULL default '',
			gr_header_tag text NOT NULL,
			gr_footer_file varchar(255) NOT NULL default '',
			gr_footer_tag text NOT NULL,
			gr_intro text NOT NULL,
			gr_state int(1) NOT NULL default '0',
			gr_member_state int(1) NOT NULL default '0',
			gr_member_level int(2) NOT NULL default '0',
			gr_open int(1) NOT NULL default '0',
			gr_level_type int(1) NOT NULL default '0',
			gr_reg_date int(20) NOT NULL default '0',
			gr_name_disp int(1) NOT NULL default '0',
			gr_ext_types varchar(6) NOT NULL default '',
			gr_ext_name1 varchar(255) NOT NULL default '',
			gr_ext_value1 varchar(255) NOT NULL default '',
			gr_ext_name2 varchar(255) NOT NULL default '',
			gr_ext_value2 varchar(255) NOT NULL default '',
			gr_ext_name3 varchar(255) NOT NULL default '',
			gr_ext_value3 varchar(255) NOT NULL default '',
			gr_ext_name4 varchar(255) NOT NULL default '',
			gr_ext_value4 varchar(255) NOT NULL default '',
			gr_ext_name5 varchar(255) NOT NULL default '',
			gr_ext_value5 varchar(255) NOT NULL default '',
			PRIMARY KEY  (gr_num),
			KEY gr_id (gr_id)
		) COMMENT='그룹 테이블'
	";
	
	// 그룹회원설정
	$mysql_schema_group_member = "
		(
			gm_num int(20) NOT NULL auto_increment,
			gm_mb_num int(20) NOT NULL default '0',
			gm_gr_num int(20) NOT NULL default '0',
			gm_reg_date int(20) NOT NULL default '0',
			gm_state int(1) NOT NULL default '0',
			gm_level int(2) NOT NULL default '0',
			gm_ext1 varchar(255) NOT NULL default '',
			gm_ext2 varchar(255) NOT NULL default '',
			gm_ext3 varchar(255) NOT NULL default '',
			gm_ext4 varchar(255) NOT NULL default '',
			gm_ext5 varchar(255) NOT NULL default '',
			PRIMARY KEY  (gm_num),
			KEY gm_mb_num (gm_mb_num),
			KEY gm_gr_num (gm_gr_num)
		) COMMENT='그룹회원 테이블'
	";
	
	// 회원설정
	$mysql_schema_member = "
		(
			mb_num int(20) NOT NULL auto_increment,
			mb_id varchar(255) NOT NULL default '',
			mb_password varchar(255) NOT NULL default '',
			mb_nick varchar(255) NOT NULL default '',
			mb_name varchar(255) NOT NULL default '',
			mb_email varchar(255) NOT NULL default '',
			mb_msn varchar(255) NOT NULL default '',
			mb_homepage varchar(255) NOT NULL default '',
			mb_tel varchar(255) NOT NULL default '',
			mb_mobile varchar(255) NOT NULL default '',
			mb_jumin varchar(255) NOT NULL default '',
			mb_birth int(20) NOT NULL default '0',
			mb_post varchar(10) NOT NULL default '',
			mb_address1 varchar(255) NOT NULL default '',
			mb_address2 varchar(255) NOT NULL default '',
			mb_sex char(1) NOT NULL default '',
			mb_job varchar(255) NOT NULL default '',
			mb_hobby varchar(255) NOT NULL default '',
			mb_photo varchar(255) NOT NULL default '',
			mb_mailing int(1) NOT NULL default '0',
			mb_open_info int(1) NOT NULL default '0',
			mb_icon varchar(20) NOT NULL default '',
			mb_signature text NOT NULL,
			mb_greet text NOT NULL,
			mb_point int(10) NOT NULL default '0',
			mb_today_point int(11) NOT NULL default '0',
			mb_point_date int(11) NOT NULL default '0',
			mb_level int(10) NOT NULL default '0',
			mb_state int(1) NOT NULL default '0',
		    mb_exist_memo int(1) NOT NULL default '0',
			mb_reg_date int(20) NOT NULL default '0',
			mb_modi_date int(20) NOT NULL default '0',
			mb_login_date int(20) NOT NULL default '0',
			mb_login_ip varchar(20) NOT NULL default '',
			mb_log_count int(20) NOT NULL default '0',
			mb_ext1 varchar(255) NOT NULL default '',
			mb_ext2 varchar(255) NOT NULL default '',
			mb_ext3 varchar(255) NOT NULL default '',
			mb_ext4 varchar(255) NOT NULL default '',
			mb_ext5 varchar(255) NOT NULL default '',
			mb_ext6 varchar(255) NOT NULL default '',
			mb_ext7 varchar(255) NOT NULL default '',
			mb_ext8 varchar(255) NOT NULL default '',
			mb_ext9 varchar(255) NOT NULL default '',
			mb_ext10 varchar(255) NOT NULL default '',
			PRIMARY KEY  (mb_num),
			KEY mb_id (mb_id),
			KEY mb_name (mb_name),
			KEY mb_nick (mb_nick)
		) COMMENT='회원테이블'
	";
	
	// 기본사이트설정
	$mysql_schema_site_cfg = "
		(
			`st_num` int(11) NOT NULL auto_increment,
			  `st_site_name` varchar(255) NOT NULL default '',
			  `st_default_group` varchar(255) NOT NULL default '',
			  `st_join_agreement` int(1) NOT NULL default '1',
			  `st_joining_check` int(1) NOT NULL default '1',
			  `st_join_agreement_url` varchar(255) NOT NULL default '',
			  `st_privacy_protect_policy_url` varchar(255) NOT NULL default '',
			  `st_name_validate` int(1) NOT NULL default '0',
			  `st_join_ok_url` varchar(255) NOT NULL default '',
			  `st_join_auto_login` int(1) NOT NULL default '0',
			  `st_login_ok_url` varchar(255) NOT NULL default '',
			  `st_logout_ok_url` varchar(255) NOT NULL default '',
			  `st_email` varchar(50) NOT NULL default '',
			  `st_join_form_cfg` varchar(100) NOT NULL default '0',
			  `st_default_point` int(20) NOT NULL default '0',
			  `st_login_point` int(11) NOT NULL default '0',
			  `st_today_max_point` int(11) NOT NULL default '0',
			  `st_default_level` int(20) NOT NULL default '0',
			  `st_default_state` int(1) NOT NULL default '0',
			  `st_join_out_stat` int(1) NOT NULL default '0',
			  `st_connect_time` int(11) NOT NULL default '0',
			  `st_mb_ext_types` varchar(11) NOT NULL default '0',
			  `st_mb_ext_name1` varchar(255) NOT NULL default '',
			  `st_mb_ext_value1` varchar(255) NOT NULL default '',
			  `st_mb_ext_name2` varchar(255) NOT NULL default '',
			  `st_mb_ext_value2` varchar(255) NOT NULL default '',
			  `st_mb_ext_name3` varchar(255) NOT NULL default '',
			  `st_mb_ext_value3` varchar(255) NOT NULL default '',
			  `st_mb_ext_name4` varchar(255) NOT NULL default '',
			  `st_mb_ext_value4` varchar(255) NOT NULL default '',
			  `st_mb_ext_name5` varchar(255) NOT NULL default '',
			  `st_mb_ext_value5` varchar(255) NOT NULL default '',
			  `st_mb_ext_name6` varchar(255) NOT NULL default '',
			  `st_mb_ext_value6` varchar(255) NOT NULL default '',
			  `st_mb_ext_name7` varchar(255) NOT NULL default '',
			  `st_mb_ext_value7` varchar(255) NOT NULL default '',
			  `st_mb_ext_name8` varchar(255) NOT NULL default '',
			  `st_mb_ext_value8` varchar(255) NOT NULL default '',
			  `st_mb_ext_name9` varchar(255) NOT NULL default '',
			  `st_mb_ext_value9` varchar(255) NOT NULL default '',
			  `st_mb_ext_name10` varchar(255) NOT NULL default '',
			  `st_mb_ext_value10` varchar(255) NOT NULL default '',
			  PRIMARY KEY  (`st_num`)
			) TYPE=MyISAM COMMENT='사이트설정테이블'
	";
	
	// 우편번호 테이블
	$mysql_schema_zip = "
		(
			`zp_num` int(11) NOT NULL default '0',
			`zp_code` varchar(6) NOT NULL default '',
			`zp_sido` varchar(4) NOT NULL default '',
			`zp_gugun` varchar(20) NOT NULL default '',
			`zp_dong` varchar(50) NOT NULL default '',
			`zp_bunji` varchar(20) NOT NULL default '',
			PRIMARY KEY  (`zp_num`),
			KEY `zp_code` (`zp_code`)
		) COMMENT='우편번호'
	";
	
	// 접속자 테이블
	$mysql_schema_connect = "
		(
			con_num int(11) NOT NULL auto_increment,
			con_mb_id varchar(255) NOT NULL default '',
			con_mb_icon varchar(255) NOT NULL default '',
			con_date int(11) NOT NULL default '0',
			con_ip varchar(20) NOT NULL default '',
			PRIMARY KEY  (con_num),
			UNIQUE KEY con_ip (con_ip)
		) COMMENT='현재접속자'
	";
	
	// 쪽지
	$mysql_schema_memo = "
		(
			mo_num int(11) NOT NULL auto_increment,
			mo_recv_mb_num int(11) NOT NULL default '0',
			mo_send_mb_num int(11) NOT NULL default '0',
			mo_write_date int(11) NOT NULL default '0',
			mo_read_date int(11) NOT NULL default '0',
			mo_content text NOT NULL,
			PRIMARY KEY  (mo_num),
			KEY mo_recv_mb_num (mo_recv_mb_num),
			KEY mo_send_mb_num (mo_send_mb_num)
		) COMMENT='메모테이블'
	";
	
	// 접속통계
	$mysql_schema_count_stat = "
		(
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
	
	// 접속통계 아이피목록
	$mysql_schema_count_ip = "
		(
			`num` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`ip` VARCHAR( 20 ) NOT NULL ,
			`count_date` DATE NOT NULL ,
			INDEX ( `ip` , `count_date` ) 
		) COMMENT = '통계 아이피 체크'
	";

	// 투표설정
	$mysql_schema_vote_cfg = "
		(
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
	
	// 투표 코멘트
	$mysql_schema_vote_cmt = "
		(
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
	
	// 투표 아이피 
	$mysql_schema_vote_ip = "
		(
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

	// //투표 항목 
	$mysql_schema_vote_item = "
		(
			vit_num int(11) NOT NULL auto_increment,
			vit_vt_num int(11) NOT NULL default '0',
			vit_order int(11) NOT NULL default '0',
			vit_item varchar(255) NOT NULL default '',
			vit_count int(11) NOT NULL default '0',
			PRIMARY KEY  (vit_num),
			KEY vit_vt_num (vit_vt_num,vit_order)
		) TYPE=MyISAM COMMENT='투표 항목 테이블'
	";

	// 카운터 브라우저/os 테이블
	$mysql_schema_counter_browser =  "
		(
		  bro_num int(10) unsigned NOT NULL auto_increment,
		  bro_hit int(10) unsigned NOT NULL default '0',
		  bro_pure_hit int(10) unsigned NOT NULL default '0',
		  bro_agent varchar(255) NOT NULL default '',
		  PRIMARY KEY  (bro_num),
		  KEY bro_agent (bro_agent)
		) TYPE=MyISAM COMMENT='브라우저/os 테이블'
	";

	// 카운터 아이피 테이블
	$mysql_schema_counter_ip = "
		(
		  ip_num int(10) unsigned NOT NULL auto_increment,
		  ip_hit int(10) unsigned NOT NULL default '0',
		  ip_pure_hit int(10) unsigned NOT NULL default '0',
		  ip_ip varchar(20) NOT NULL default '',
		  PRIMARY KEY  (ip_num),
		  KEY ip_ip (ip_ip)
		) TYPE=MyISAM COMMENT='아이피 테이블'
	";

	// 카운터 로그 테이블
	$mysql_schema_counter_log = "
		(
		  counter_num int(10) unsigned NOT NULL auto_increment,
		  pure tinyint(1) unsigned NOT NULL default '0',
		  yyyy smallint(4) unsigned NOT NULL default '0',
		  mm tinyint(2) unsigned NOT NULL default '0',
		  dd tinyint(2) unsigned NOT NULL default '0',
		  hh tinyint(2) unsigned NOT NULL default '0',
		  nn tinyint(2) unsigned NOT NULL default '0',
		  ww tinyint(1) unsigned NOT NULL default '0',
		  counter_date int(10) unsigned NOT NULL default '0',
		  counter_ref int(10) unsigned NOT NULL default '0',
		  counter_page int(10) unsigned NOT NULL default '0',
		  counter_ip int(10) unsigned NOT NULL default '0',
		  counter_browser int(10) unsigned NOT NULL default '0',
		  PRIMARY KEY  (counter_num),
		  KEY pure (pure),
		  KEY yyyy (yyyy),
		  KEY mm (mm),
		  KEY dd (dd),
		  KEY hh (hh),
		  KEY ww (ww),
		  KEY counter_ref (counter_ref),
		  KEY counter_page (counter_page),
		  KEY counter_ip (counter_ip),
		  KEY counter_browser (counter_browser)
		) TYPE=MyISAM COMMENT='카운터 테이블'
	";

	// 카운터 페이지 테이블
	$mysql_schema_counter_page = "
		(
		  page_num int(10) unsigned NOT NULL auto_increment,
		  page_hit int(10) unsigned NOT NULL default '0',
		  page_pure_hit int(10) unsigned NOT NULL default '0',
		  page_url varchar(255) NOT NULL default '',
		  PRIMARY KEY  (page_num),
		  KEY page_url (page_url)
		) TYPE=MyISAM COMMENT='페이지 테이블'
	";

	// 카운터 레퍼럴 테이블
	$mysql_schema_counter_ref = "
		(
		  ref_num int(10) unsigned NOT NULL auto_increment,
		  ref_hit int(10) unsigned NOT NULL default '0',
		  ref_pure_hit int(10) unsigned NOT NULL default '0',
		  ref_url varchar(255) NOT NULL default '',
		  PRIMARY KEY  (ref_num),
		  KEY ref_url (ref_url)
		) TYPE=MyISAM COMMENT='레퍼럴 테이블'
	";

	// 카테고리 기본 데이타
	$mysql_bbs_data[] = "(1, 1, '질문', 0)";
	$mysql_bbs_data[] = "(2, 2, '답변', 0)";
	$mysql_bbs_data[] = "(3, 3, '잡담', 0)";

	// 기본사이트설정 기본 데이타
	$mysql_site_data[] = "(1, 'Lets080 보드 - ver 1.2', 'main', 0, 0, '/', '', 0, '/', 0, '/', '/', '', ',1,2,1,0,0,1,1,0,0,1,0,0,0,0,0,0,1', 1, 1, 100, 1, 0, 1, 60, '00000000000', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
	
	$mysql_group_data[] = "(1, 'main', 1, '메인그룹', '', '', '', '', '', 0, 0, 0, 0, 0, 1057302330, 1, '000000', '', '', '', '', '', '', '', '', '', '')
	";

} // *-- SCHEMA_INC_INCLUDED END --*
?>