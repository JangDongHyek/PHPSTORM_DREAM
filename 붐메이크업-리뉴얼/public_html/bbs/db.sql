CREATE TABLE rg_bbs_cfg (
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
  bbs_ext_types varchar(51) NOT NULL default '0',
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
  bbs_ext_name6 varchar(255) NOT NULL default '',
  bbs_ext_value6 varchar(255) NOT NULL default '',
  bbs_ext_name7 varchar(255) NOT NULL default '',
  bbs_ext_value7 varchar(255) NOT NULL default '',
  bbs_ext_name8 varchar(255) NOT NULL default '',
  bbs_ext_value8 varchar(255) NOT NULL default '',
  bbs_ext_name9 varchar(255) NOT NULL default '',
  bbs_ext_value9 varchar(255) NOT NULL default '',
  bbs_ext_name10 varchar(255) NOT NULL default '',
  bbs_ext_value10 varchar(255) NOT NULL default '',
  bbs_ext_name11 varchar(255) NOT NULL default '',
  bbs_ext_value11 varchar(255) NOT NULL default '',
  bbs_ext_name12 varchar(255) NOT NULL default '',
  bbs_ext_value12 varchar(255) NOT NULL default '',
  bbs_ext_name13 varchar(255) NOT NULL default '',
  bbs_ext_value13 varchar(255) NOT NULL default '',
  bbs_ext_name14 varchar(255) NOT NULL default '',
  bbs_ext_value14 varchar(255) NOT NULL default '',
  bbs_ext_name15 varchar(255) NOT NULL default '',
  bbs_ext_value15 varchar(255) NOT NULL default '',
  bbs_ext_name16 varchar(255) NOT NULL default '',
  bbs_ext_value16 varchar(255) NOT NULL default '',
  bbs_ext_name17 varchar(255) NOT NULL default '',
  bbs_ext_value17 varchar(255) NOT NULL default '',
  bbs_ext_name18 varchar(255) NOT NULL default '',
  bbs_ext_value18 varchar(255) NOT NULL default '',
  bbs_ext_name19 varchar(255) NOT NULL default '',
  bbs_ext_value19 varchar(255) NOT NULL default '',
  bbs_ext_name20 varchar(255) NOT NULL default '',
  bbs_ext_value20 varchar(255) NOT NULL default '',
  bbs_ext_name21 varchar(255) NOT NULL default '',
  bbs_ext_value21 varchar(255) NOT NULL default '',
  bbs_ext_name22 varchar(255) NOT NULL default '',
  bbs_ext_value22 varchar(255) NOT NULL default '',
  bbs_ext_name23 varchar(255) NOT NULL default '',
  bbs_ext_value23 varchar(255) NOT NULL default '',
  bbs_ext_name24 varchar(255) NOT NULL default '',
  bbs_ext_value24 varchar(255) NOT NULL default '',
  bbs_ext_name25 varchar(255) NOT NULL default '',
  bbs_ext_value25 varchar(255) NOT NULL default '',
  bbs_ext_name26 varchar(255) NOT NULL default '',
  bbs_ext_value26 varchar(255) NOT NULL default '',
  bbs_ext_name27 varchar(255) NOT NULL default '',
  bbs_ext_value27 varchar(255) NOT NULL default '',
  bbs_ext_name28 varchar(255) NOT NULL default '',
  bbs_ext_value28 varchar(255) NOT NULL default '',
  bbs_ext_name29 varchar(255) NOT NULL default '',
  bbs_ext_value29 varchar(255) NOT NULL default '',
  bbs_ext_name30 varchar(255) NOT NULL default '',
  bbs_ext_value30 varchar(255) NOT NULL default '',
  bbs_ext_name31 varchar(255) NOT NULL default '',
  bbs_ext_value31 varchar(255) NOT NULL default '',
  bbs_ext_name32 varchar(255) NOT NULL default '',
  bbs_ext_value32 varchar(255) NOT NULL default '',
  bbs_ext_name33 varchar(255) NOT NULL default '',
  bbs_ext_value33 varchar(255) NOT NULL default '',
  bbs_ext_name34 varchar(255) NOT NULL default '',
  bbs_ext_value34 varchar(255) NOT NULL default '',
  bbs_ext_name35 varchar(255) NOT NULL default '',
  bbs_ext_value35 varchar(255) NOT NULL default '',
  bbs_ext_name36 varchar(255) NOT NULL default '',
  bbs_ext_value36 varchar(255) NOT NULL default '',
  bbs_ext_name37 varchar(255) NOT NULL default '',
  bbs_ext_value37 varchar(255) NOT NULL default '',
  bbs_ext_name38 varchar(255) NOT NULL default '',
  bbs_ext_value38 varchar(255) NOT NULL default '',
  bbs_ext_name39 varchar(255) NOT NULL default '',
  bbs_ext_value39 varchar(255) NOT NULL default '',
  bbs_ext_name40 varchar(255) NOT NULL default '',
  bbs_ext_value40 varchar(255) NOT NULL default '',
  bbs_ext_name41 varchar(255) NOT NULL default '',
  bbs_ext_value41 varchar(255) NOT NULL default '',
  bbs_ext_name42 varchar(255) NOT NULL default '',
  bbs_ext_value42 varchar(255) NOT NULL default '',
  bbs_ext_name43 varchar(255) NOT NULL default '',
  bbs_ext_value43 varchar(255) NOT NULL default '',
  bbs_ext_name44 varchar(255) NOT NULL default '',
  bbs_ext_value44 varchar(255) NOT NULL default '',
  bbs_ext_name45 varchar(255) NOT NULL default '',
  bbs_ext_value45 varchar(255) NOT NULL default '',
  bbs_ext_name46 varchar(255) NOT NULL default '',
  bbs_ext_value46 varchar(255) NOT NULL default '',
  bbs_ext_name47 varchar(255) NOT NULL default '',
  bbs_ext_value47 varchar(255) NOT NULL default '',
  bbs_ext_name48 varchar(255) NOT NULL default '',
  bbs_ext_value48 varchar(255) NOT NULL default '',
  bbs_ext_name49 varchar(255) NOT NULL default '',
  bbs_ext_value49 varchar(255) NOT NULL default '',
  bbs_ext_name50 varchar(255) NOT NULL default '',
  bbs_ext_value50 varchar(255) NOT NULL default '',
  PRIMARY KEY  (bbs_num),
  KEY bbs_id (bbs_id),
  KEY bbs_gr_num (bbs_gr_num)
) TYPE=MyISAM;

--
-- Dumping data for table `rg_bbs_cfg`
--

INSERT INTO rg_bbs_cfg VALUES (4,'test',1,'test','','','','','euc-kr','blue','test','','','','100%','center','',',A,A,A,A,N,N,N,N,A,A,A,D,A,A,D,A,,,,0,0,1,0,0,0,1,0,,,,0,1,1,,,,,,',0,0,'!php,php3,ph,inc,html,htm,phtml','!php,php3,ph,inc,html,htm,phtml','script,xml',20,'0',10,'','','8��,����,������,�һ���,����,����,����,����,�ϱ��,���,����,�ֳ�,�ֳ�,����,����,�ϱ��,��������,���,������,�ٺ�����,�û���,����,����,�ù�,����,���׶�,����,��õ��,��õid,��õ���̵�,��õid,��õ���̵�,��/õ/��,����,���,�ΰ���,��ģ��,��ģ��,���,�׽��ϴ�,�Ծ�,�Ե��,�����',10,86400,2048000,2048000,'[�亯]','���� ���Դϴ�.','>','','','%Y-%m-%d','%Y-%m-%d %H:%M:%S',1,1,1,1195462196,'022222222222132222222222222222222222222222222222222','�߰��Է�1 :','','�߰��Է�2 :','','�߰��Է�3 :','','�߰��Է�4 :','','�߰��Է�5 :','','�߰��Է�6 :','','�߰��Է�7 :','','�߰��Է�8 :','','�߰��Է�9 :','','�߰��Է�10 :','','�߰��Է�11 :','','�߰��Է�12 :','!��1|��2|��3|��4','�߰��Է�13 :','!��1|��2|��3|��4','�߰��Է�14 :','','�߰��Է�15 :','','�߰��Է�16 :','','�߰��Է�17 :','','�߰��Է�18 :','','�߰��Է�19 :','','�߰��Է�20 :','','�߰��Է�21 :','','�߰��Է�22 :','','�߰��Է�23 :','','�߰��Է�24 :','','�߰��Է�25 :','','�߰��Է�26 :','','�߰��Է�27 :','','�߰��Է�28 :','','�߰��Է�29 :','','�߰��Է�30 :','','�߰��Է�31 :','','�߰��Է�32 :','','�߰��Է�33 :','','�߰��Է�34 :','','�߰��Է�35 :','','�߰��Է�36 :','','�߰��Է�37 :','','�߰��Է�38 :','','�߰��Է�39 :','','�߰��Է�40 :','','�߰��Է�41 :','','�߰��Է�42 :','','�߰��Է�43 :','','�߰��Է�44 :','','�߰��Է�45 :','','�߰��Է�46 :','','�߰��Է�47 :','','�߰��Է�48 :','','�߰��Է�49 :','','�߰��Է�50 :','');
INSERT INTO rg_bbs_cfg VALUES (5,'test2',1,'test2','','','','','euc-kr','webeditor','test2','','','','100%','center','',',A,A,A,A,A,A,N,N,A,A,A,D,A,A,D,A,,,,0,0,1,0,0,0,1,0,,,,0,1,1,,,,,,',0,0,'!php,php3,ph,inc,html,htm,phtml','!php,php3,ph,inc,html,htm,phtml','script,xml',20,'0',10,'','','8��,����,������,�һ���,����,����,����,����,�ϱ��,���,����,�ֳ�,�ֳ�,����,����,�ϱ��,��������,���,������,�ٺ�����,�û���,����,����,�ù�,����,���׶�,����,��õ��,��õid,��õ���̵�,��õid,��õ���̵�,��/õ/��,����,���,�ΰ���,��ģ��,��ģ��,���,�׽��ϴ�,�Ծ�,�Ե��,�����',10,86400,2048000,2048000,'[�亯]','���� ���Դϴ�.','>','','','%Y-%m-%d','%Y-%m-%d %H:%M:%S',1,1,1,1195462996,'022222200000000000000000000000000000000000000000000','�߰��Է�1 :','','�߰��Է�2 :','','�߰��Է�3 :','','�߰��Է�4 :','','�߰��Է�5 :','','�߰��Է�','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO rg_bbs_cfg VALUES (6,'yeyak',1,'�����ϱ�','','','','','euc-kr','iuman_schedule','�����ϱ�','','','','100%','center','',',A,A,N,N,N,N,N,N,A,A,A,D,A,A,D,A,,,,0,1,1,0,0,0,1,0,,,,0,0,1,,,,,,',0,0,'!php,php3,ph,inc,html,htm,phtml','!php,php3,ph,inc,html,htm,phtml','script,xml',20,'0',10,'','','��ī��,���̺�,8��,����,������,�һ���,����,����,����,����,�ϱ��,���,����,�ֳ�,�ֳ�,����,����,�ϱ��,��������,���,������,�ٺ�����,�û���,����,����,�ù�,����,���׶�,����,��õ��,��õid,��õ���̵�,��õid,��õ���̵�,��/õ/��,����,���,�ΰ���,��ģ��,��ģ��,���,�׽��ϴ�,�Ծ�,�Ե��,�����',10,86400,2048000,2048000,'[�亯]','���� ���Դϴ�.','>','','','%Y-%m-%d','%Y-%m-%d %H:%M:%S',1,1,1,1196234227,'003330201332220000000000000000000000000000000000000','�����','','�ο���','2','�߰��ο���','!����|1|2','������','!1��2��|2��3��|3��4��|4��5��|5��6��|6��7��','������','','����Ⱓ','','���̸�','','����','!���డ��|�Աݴ��|����Ϸ�','�ٺ�ť�׸�','!�߰�����|�߰�','����ó1','!010|011|016|017|018|019|031|032|033|041|042|043|051|052|053|054|055|061|062|064','����ó2','required|����ó||4','����ó3','required|����ó||4','�Ա��ڸ�','required|�Ա��ڸ�||8','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO rg_bbs_cfg VALUES (7,'search_dal',1,'�޷�','','','','','euc-kr','search_dal','�޷�','','','','100%','center','',',A,A,A,A,N,N,N,N,A,A,A,D,A,A,D,A,,,,0,0,1,0,0,0,1,0,,,,0,1,1,,,,,,',0,0,'!php,php3,ph,inc,html,htm,phtml','!php,php3,ph,inc,html,htm,phtml','script,xml',20,'0',10,'','','8��,����,������,�һ���,����,����,����,����,�ϱ��,���,����,�ֳ�,�ֳ�,����,����,�ϱ��,��������,���,������,�ٺ�����,�û���,����,����,�ù�,����,���׶�,����,��õ��,��õid,��õ���̵�,��õid,��õ���̵�,��/õ/��,����,���,�ΰ���,��ģ��,��ģ��,���,�׽��ϴ�,�Ծ�,�Ե��,�����',10,86400,2048000,2048000,'[�亯]','���� ���Դϴ�.','>','','','%Y-%m-%d','%Y-%m-%d %H:%M:%S',1,1,1,1196785776,'000000000000000000000000000000000000000000000000000','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');

--
-- Table structure for table `rg_connect`
--

CREATE TABLE rg_connect (
  con_num int(11) NOT NULL auto_increment,
  con_mb_id varchar(255) NOT NULL default '',
  con_mb_icon varchar(255) NOT NULL default '',
  con_date int(11) NOT NULL default '0',
  con_ip varchar(20) NOT NULL default '',
  PRIMARY KEY  (con_num),
  UNIQUE KEY con_ip (con_ip)
) TYPE=MyISAM COMMENT='����������';

--
-- Dumping data for table `rg_connect`
--

INSERT INTO rg_connect VALUES (10,'admin','',1197005159,'121.144.63.58');

--
-- Table structure for table `rg_count_ip`
--

CREATE TABLE rg_count_ip (
  num int(11) NOT NULL auto_increment,
  ip varchar(20) NOT NULL default '',
  count_date date NOT NULL default '0000-00-00',
  PRIMARY KEY  (num),
  KEY ip (ip,count_date)
) TYPE=MyISAM COMMENT='��� ������ üũ';

--
-- Dumping data for table `rg_count_ip`
--

INSERT INTO rg_count_ip VALUES (2,'220.71.88.40','2007-12-07');

--
-- Table structure for table `rg_count_stat`
--

CREATE TABLE rg_count_stat (
  num int(11) NOT NULL auto_increment,
  today_count int(11) NOT NULL default '0',
  yesterday_count int(11) NOT NULL default '0',
  total_count int(11) NOT NULL default '0',
  max_conn_count int(11) NOT NULL default '0',
  max_count int(11) NOT NULL default '0',
  today_date date NOT NULL default '0000-00-00',
  ip varchar(20) NOT NULL default '',
  PRIMARY KEY  (num)
) TYPE=MyISAM COMMENT='������̺�';

--
-- Dumping data for table `rg_count_stat`
--

INSERT INTO rg_count_stat VALUES (1,1,1,3,1,1,'2007-12-07','220.71.88.40');

--
-- Table structure for table `rg_counter_browser`
--

CREATE TABLE rg_counter_browser (
  bro_num int(10) unsigned NOT NULL auto_increment,
  bro_hit int(10) unsigned NOT NULL default '0',
  bro_pure_hit int(10) unsigned NOT NULL default '0',
  bro_agent varchar(255) NOT NULL default '',
  PRIMARY KEY  (bro_num),
  KEY bro_agent (bro_agent)
) TYPE=MyISAM COMMENT='������/os ���̺�';

--
-- Dumping data for table `rg_counter_browser`
--


--
-- Table structure for table `rg_counter_ip`
--

CREATE TABLE rg_counter_ip (
  ip_num int(10) unsigned NOT NULL auto_increment,
  ip_hit int(10) unsigned NOT NULL default '0',
  ip_pure_hit int(10) unsigned NOT NULL default '0',
  ip_ip varchar(20) NOT NULL default '',
  PRIMARY KEY  (ip_num),
  KEY ip_ip (ip_ip)
) TYPE=MyISAM COMMENT='������ ���̺�';

--
-- Dumping data for table `rg_counter_ip`
--


--
-- Table structure for table `rg_counter_log`
--

CREATE TABLE rg_counter_log (
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
) TYPE=MyISAM COMMENT='ī���� ���̺�';

--
-- Dumping data for table `rg_counter_log`
--


--
-- Table structure for table `rg_counter_page`
--

CREATE TABLE rg_counter_page (
  page_num int(10) unsigned NOT NULL auto_increment,
  page_hit int(10) unsigned NOT NULL default '0',
  page_pure_hit int(10) unsigned NOT NULL default '0',
  page_url varchar(255) NOT NULL default '',
  PRIMARY KEY  (page_num),
  KEY page_url (page_url)
) TYPE=MyISAM COMMENT='������ ���̺�';

--
-- Dumping data for table `rg_counter_page`
--


--
-- Table structure for table `rg_counter_ref`
--

CREATE TABLE rg_counter_ref (
  ref_num int(10) unsigned NOT NULL auto_increment,
  ref_hit int(10) unsigned NOT NULL default '0',
  ref_pure_hit int(10) unsigned NOT NULL default '0',
  ref_url varchar(255) NOT NULL default '',
  PRIMARY KEY  (ref_num),
  KEY ref_url (ref_url)
) TYPE=MyISAM COMMENT='���۷� ���̺�';

--
-- Dumping data for table `rg_counter_ref`
--


--
-- Table structure for table `rg_group_cfg`
--

CREATE TABLE rg_group_cfg (
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
) TYPE=MyISAM COMMENT='�׷� ���̺�';

--
-- Dumping data for table `rg_group_cfg`
--

INSERT INTO rg_group_cfg VALUES (1,'main',1,'���α׷�','','','','','',0,0,0,0,0,1057302330,1,'000000','','','','','','','','','','');

--
-- Table structure for table `rg_group_member`
--

CREATE TABLE rg_group_member (
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
) TYPE=MyISAM COMMENT='�׷�ȸ�� ���̺�';

--
-- Dumping data for table `rg_group_member`
--


--
-- Table structure for table `rg_member`
--

CREATE TABLE rg_member (
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
) TYPE=MyISAM COMMENT='ȸ�����̺�';

--
-- Dumping data for table `rg_member`
--

INSERT INTO rg_member VALUES (1,'admin','45271aba0b765d95','','������','','','','','','',0,'','','','','','','',0,0,'','','',41,1,1197001792,10,0,0,1195431666,0,1197002487,'220.71.88.40',37,'','','','','','','','','','');

--
-- Table structure for table `rg_memo`
--

CREATE TABLE rg_memo (
  mo_num int(11) NOT NULL auto_increment,
  mo_recv_mb_num int(11) NOT NULL default '0',
  mo_send_mb_num int(11) NOT NULL default '0',
  mo_write_date int(11) NOT NULL default '0',
  mo_read_date int(11) NOT NULL default '0',
  mo_content text NOT NULL,
  PRIMARY KEY  (mo_num),
  KEY mo_recv_mb_num (mo_recv_mb_num),
  KEY mo_send_mb_num (mo_send_mb_num)
) TYPE=MyISAM COMMENT='�޸����̺�';

--
-- Dumping data for table `rg_memo`
--


--
-- Table structure for table `rg_search_dal_body`
--

CREATE TABLE rg_search_dal_body (
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
  rg_ext6 varchar(255) NOT NULL default '',
  rg_ext7 varchar(255) NOT NULL default '',
  rg_ext8 varchar(255) NOT NULL default '',
  rg_ext9 varchar(255) NOT NULL default '',
  rg_ext10 varchar(255) NOT NULL default '',
  rg_ext11 varchar(255) NOT NULL default '',
  rg_ext12 varchar(255) NOT NULL default '',
  rg_ext13 varchar(255) NOT NULL default '',
  rg_ext14 varchar(255) NOT NULL default '',
  rg_ext15 varchar(255) NOT NULL default '',
  rg_ext16 varchar(255) NOT NULL default '',
  rg_ext17 varchar(255) NOT NULL default '',
  rg_ext18 varchar(255) NOT NULL default '',
  rg_ext19 varchar(255) NOT NULL default '',
  rg_ext20 varchar(255) NOT NULL default '',
  rg_ext21 varchar(255) NOT NULL default '',
  rg_ext22 varchar(255) NOT NULL default '',
  rg_ext23 varchar(255) NOT NULL default '',
  rg_ext24 varchar(255) NOT NULL default '',
  rg_ext25 varchar(255) NOT NULL default '',
  rg_ext26 varchar(255) NOT NULL default '',
  rg_ext27 varchar(255) NOT NULL default '',
  rg_ext28 varchar(255) NOT NULL default '',
  rg_ext29 varchar(255) NOT NULL default '',
  rg_ext30 varchar(255) NOT NULL default '',
  rg_ext31 varchar(255) NOT NULL default '',
  rg_ext32 varchar(255) NOT NULL default '',
  rg_ext33 varchar(255) NOT NULL default '',
  rg_ext34 varchar(255) NOT NULL default '',
  rg_ext35 varchar(255) NOT NULL default '',
  rg_ext36 varchar(255) NOT NULL default '',
  rg_ext37 varchar(255) NOT NULL default '',
  rg_ext38 varchar(255) NOT NULL default '',
  rg_ext39 varchar(255) NOT NULL default '',
  rg_ext40 varchar(255) NOT NULL default '',
  rg_ext41 varchar(255) NOT NULL default '',
  rg_ext42 varchar(255) NOT NULL default '',
  rg_ext43 varchar(255) NOT NULL default '',
  rg_ext44 varchar(255) NOT NULL default '',
  rg_ext45 varchar(255) NOT NULL default '',
  rg_ext46 varchar(255) NOT NULL default '',
  rg_ext47 varchar(255) NOT NULL default '',
  rg_ext48 varchar(255) NOT NULL default '',
  rg_ext49 varchar(255) NOT NULL default '',
  rg_ext50 varchar(255) NOT NULL default '',
  admin_orderby int(11) default '0',
  PRIMARY KEY  (rg_doc_num),
  KEY rg_top_num (rg_top_num),
  KEY rg_cat_num (rg_cat_num),
  KEY rg_title (rg_title),
  KEY rg_name (rg_name),
  KEY rg_reply_mail (rg_reply_mail),
  KEY rg_notice (rg_notice),
  KEY rg_next_num (rg_next_num)
) TYPE=MyISAM COMMENT='�Խ��� ���̺�';

--
-- Dumping data for table `rg_search_dal_body`
--


--
-- Table structure for table `rg_search_dal_category`
--

CREATE TABLE rg_search_dal_category (
  cat_num int(20) NOT NULL auto_increment,
  cat_order int(20) NOT NULL default '0',
  cat_name varchar(255) NOT NULL default '',
  cat_count int(20) NOT NULL default '0',
  PRIMARY KEY  (cat_num),
  KEY cat_order (cat_order)
) TYPE=MyISAM COMMENT='ī�װ����̺�';

--
-- Dumping data for table `rg_search_dal_category`
--

INSERT INTO rg_search_dal_category VALUES (1,1,'����',0);
INSERT INTO rg_search_dal_category VALUES (2,2,'�亯',0);
INSERT INTO rg_search_dal_category VALUES (3,3,'���',0);

--
-- Table structure for table `rg_search_dal_comment`
--

CREATE TABLE rg_search_dal_comment (
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
) TYPE=MyISAM COMMENT='�ڸ�Ʈ���̺�';

--
-- Dumping data for table `rg_search_dal_comment`
--


--
-- Table structure for table `rg_site_cfg`
--

CREATE TABLE rg_site_cfg (
  st_num int(11) NOT NULL auto_increment,
  st_site_name varchar(255) NOT NULL default '',
  st_default_group varchar(255) NOT NULL default '',
  st_join_agreement int(1) NOT NULL default '1',
  st_joining_check int(1) NOT NULL default '1',
  st_join_agreement_url varchar(255) NOT NULL default '',
  st_privacy_protect_policy_url varchar(255) NOT NULL default '',
  st_name_validate int(1) NOT NULL default '0',
  st_join_ok_url varchar(255) NOT NULL default '',
  st_join_auto_login int(1) NOT NULL default '0',
  st_login_ok_url varchar(255) NOT NULL default '',
  st_logout_ok_url varchar(255) NOT NULL default '',
  st_email varchar(50) NOT NULL default '',
  st_join_form_cfg varchar(100) NOT NULL default '0',
  st_default_point int(20) NOT NULL default '0',
  st_login_point int(11) NOT NULL default '0',
  st_today_max_point int(11) NOT NULL default '0',
  st_default_level int(20) NOT NULL default '0',
  st_default_state int(1) NOT NULL default '0',
  st_join_out_stat int(1) NOT NULL default '0',
  st_connect_time int(11) NOT NULL default '0',
  st_mb_ext_types varchar(11) NOT NULL default '0',
  st_mb_ext_name1 varchar(255) NOT NULL default '',
  st_mb_ext_value1 varchar(255) NOT NULL default '',
  st_mb_ext_name2 varchar(255) NOT NULL default '',
  st_mb_ext_value2 varchar(255) NOT NULL default '',
  st_mb_ext_name3 varchar(255) NOT NULL default '',
  st_mb_ext_value3 varchar(255) NOT NULL default '',
  st_mb_ext_name4 varchar(255) NOT NULL default '',
  st_mb_ext_value4 varchar(255) NOT NULL default '',
  st_mb_ext_name5 varchar(255) NOT NULL default '',
  st_mb_ext_value5 varchar(255) NOT NULL default '',
  st_mb_ext_name6 varchar(255) NOT NULL default '',
  st_mb_ext_value6 varchar(255) NOT NULL default '',
  st_mb_ext_name7 varchar(255) NOT NULL default '',
  st_mb_ext_value7 varchar(255) NOT NULL default '',
  st_mb_ext_name8 varchar(255) NOT NULL default '',
  st_mb_ext_value8 varchar(255) NOT NULL default '',
  st_mb_ext_name9 varchar(255) NOT NULL default '',
  st_mb_ext_value9 varchar(255) NOT NULL default '',
  st_mb_ext_name10 varchar(255) NOT NULL default '',
  st_mb_ext_value10 varchar(255) NOT NULL default '',
  PRIMARY KEY  (st_num)
) TYPE=MyISAM COMMENT='����Ʈ�������̺�';

--
-- Dumping data for table `rg_site_cfg`
--

INSERT INTO rg_site_cfg VALUES (1,'Lets080 ���� - ver 1.2','main',0,0,'/','',0,'/',0,'/','/','',',1,2,1,0,0,1,1,0,0,1,0,0,0,0,0,0,1',1,1,100,1,0,1,60,'00000000000','','','','','','','','','','','','','','','','','','','','');

--
-- Table structure for table `rg_test2_body`
--

CREATE TABLE rg_test2_body (
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
  rg_ext6 varchar(255) NOT NULL default '',
  rg_ext7 varchar(255) NOT NULL default '',
  rg_ext8 varchar(255) NOT NULL default '',
  rg_ext9 varchar(255) NOT NULL default '',
  rg_ext10 varchar(255) NOT NULL default '',
  rg_ext11 varchar(255) NOT NULL default '',
  rg_ext12 varchar(255) NOT NULL default '',
  rg_ext13 varchar(255) NOT NULL default '',
  rg_ext14 varchar(255) NOT NULL default '',
  rg_ext15 varchar(255) NOT NULL default '',
  rg_ext16 varchar(255) NOT NULL default '',
  rg_ext17 varchar(255) NOT NULL default '',
  rg_ext18 varchar(255) NOT NULL default '',
  rg_ext19 varchar(255) NOT NULL default '',
  rg_ext20 varchar(255) NOT NULL default '',
  rg_ext21 varchar(255) NOT NULL default '',
  rg_ext22 varchar(255) NOT NULL default '',
  rg_ext23 varchar(255) NOT NULL default '',
  rg_ext24 varchar(255) NOT NULL default '',
  rg_ext25 varchar(255) NOT NULL default '',
  rg_ext26 varchar(255) NOT NULL default '',
  rg_ext27 varchar(255) NOT NULL default '',
  rg_ext28 varchar(255) NOT NULL default '',
  rg_ext29 varchar(255) NOT NULL default '',
  rg_ext30 varchar(255) NOT NULL default '',
  rg_ext31 varchar(255) NOT NULL default '',
  rg_ext32 varchar(255) NOT NULL default '',
  rg_ext33 varchar(255) NOT NULL default '',
  rg_ext34 varchar(255) NOT NULL default '',
  rg_ext35 varchar(255) NOT NULL default '',
  rg_ext36 varchar(255) NOT NULL default '',
  rg_ext37 varchar(255) NOT NULL default '',
  rg_ext38 varchar(255) NOT NULL default '',
  rg_ext39 varchar(255) NOT NULL default '',
  rg_ext40 varchar(255) NOT NULL default '',
  rg_ext41 varchar(255) NOT NULL default '',
  rg_ext42 varchar(255) NOT NULL default '',
  rg_ext43 varchar(255) NOT NULL default '',
  rg_ext44 varchar(255) NOT NULL default '',
  rg_ext45 varchar(255) NOT NULL default '',
  rg_ext46 varchar(255) NOT NULL default '',
  rg_ext47 varchar(255) NOT NULL default '',
  rg_ext48 varchar(255) NOT NULL default '',
  rg_ext49 varchar(255) NOT NULL default '',
  rg_ext50 varchar(255) NOT NULL default '',
  admin_orderby int(11) default '0',
  PRIMARY KEY  (rg_doc_num),
  KEY rg_top_num (rg_top_num),
  KEY rg_cat_num (rg_cat_num),
  KEY rg_title (rg_title),
  KEY rg_name (rg_name),
  KEY rg_reply_mail (rg_reply_mail),
  KEY rg_notice (rg_notice),
  KEY rg_next_num (rg_next_num)
) TYPE=MyISAM COMMENT='�Խ��� ���̺�';

--
-- Dumping data for table `rg_test2_body`
--

INSERT INTO rg_test2_body VALUES (11,11,0,1,0,2,0,1,'������','','','',0,'','',0,0,'','',0,0,0,0,0,0,0,0,'af','asdf\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle><IMG src=\"http://www.lets080.com/~jaejin79/bbs/editor/upload/1196059607.gm\"> </TD></TR></TBODY></TABLE>',1,1196059609,0,'121.144.63.58','',0,0,'121.144.63.58',0,0,0,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',0);
INSERT INTO rg_test2_body VALUES (10,10,0,1,0,1,0,1,'������','','','',0,'','',0,0,'','',0,0,0,0,0,0,0,0,'11','111\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle><IMG src=\"http://www.lets080.com/~jaejin79/bbs/editor/upload/1196059562.gm\"> </TD></TR></TBODY></TABLE>',1,1196059563,0,'121.144.63.58','',0,0,'121.144.63.58',0,0,0,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',0);

--
-- Table structure for table `rg_test2_category`
--

CREATE TABLE rg_test2_category (
  cat_num int(20) NOT NULL auto_increment,
  cat_order int(20) NOT NULL default '0',
  cat_name varchar(255) NOT NULL default '',
  cat_count int(20) NOT NULL default '0',
  PRIMARY KEY  (cat_num),
  KEY cat_order (cat_order)
) TYPE=MyISAM COMMENT='ī�װ����̺�';

--
-- Dumping data for table `rg_test2_category`
--

INSERT INTO rg_test2_category VALUES (1,1,'����',0);
INSERT INTO rg_test2_category VALUES (2,2,'�亯',0);
INSERT INTO rg_test2_category VALUES (3,3,'���',0);

--
-- Table structure for table `rg_test2_comment`
--

CREATE TABLE rg_test2_comment (
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
) TYPE=MyISAM COMMENT='�ڸ�Ʈ���̺�';

--
-- Dumping data for table `rg_test2_comment`
--


--
-- Table structure for table `rg_test_body`
--

CREATE TABLE rg_test_body (
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
  rg_ext6 varchar(255) NOT NULL default '',
  rg_ext7 varchar(255) NOT NULL default '',
  rg_ext8 varchar(255) NOT NULL default '',
  rg_ext9 varchar(255) NOT NULL default '',
  rg_ext10 varchar(255) NOT NULL default '',
  rg_ext11 varchar(255) NOT NULL default '',
  rg_ext12 varchar(255) NOT NULL default '',
  rg_ext13 varchar(255) NOT NULL default '',
  rg_ext14 varchar(255) NOT NULL default '',
  rg_ext15 varchar(255) NOT NULL default '',
  rg_ext16 varchar(255) NOT NULL default '',
  rg_ext17 varchar(255) NOT NULL default '',
  rg_ext18 varchar(255) NOT NULL default '',
  rg_ext19 varchar(255) NOT NULL default '',
  rg_ext20 varchar(255) NOT NULL default '',
  rg_ext21 varchar(255) NOT NULL default '',
  rg_ext22 varchar(255) NOT NULL default '',
  rg_ext23 varchar(255) NOT NULL default '',
  rg_ext24 varchar(255) NOT NULL default '',
  rg_ext25 varchar(255) NOT NULL default '',
  rg_ext26 varchar(255) NOT NULL default '',
  rg_ext27 varchar(255) NOT NULL default '',
  rg_ext28 varchar(255) NOT NULL default '',
  rg_ext29 varchar(255) NOT NULL default '',
  rg_ext30 varchar(255) NOT NULL default '',
  rg_ext31 varchar(255) NOT NULL default '',
  rg_ext32 varchar(255) NOT NULL default '',
  rg_ext33 varchar(255) NOT NULL default '',
  rg_ext34 varchar(255) NOT NULL default '',
  rg_ext35 varchar(255) NOT NULL default '',
  rg_ext36 varchar(255) NOT NULL default '',
  rg_ext37 varchar(255) NOT NULL default '',
  rg_ext38 varchar(255) NOT NULL default '',
  rg_ext39 varchar(255) NOT NULL default '',
  rg_ext40 varchar(255) NOT NULL default '',
  rg_ext41 varchar(255) NOT NULL default '',
  rg_ext42 varchar(255) NOT NULL default '',
  rg_ext43 varchar(255) NOT NULL default '',
  rg_ext44 varchar(255) NOT NULL default '',
  rg_ext45 varchar(255) NOT NULL default '',
  rg_ext46 varchar(255) NOT NULL default '',
  rg_ext47 varchar(255) NOT NULL default '',
  rg_ext48 varchar(255) NOT NULL default '',
  rg_ext49 varchar(255) NOT NULL default '',
  rg_ext50 varchar(255) NOT NULL default '',
  admin_orderby int(11) default '0',
  PRIMARY KEY  (rg_doc_num),
  KEY rg_top_num (rg_top_num),
  KEY rg_cat_num (rg_cat_num),
  KEY rg_title (rg_title),
  KEY rg_name (rg_name),
  KEY rg_reply_mail (rg_reply_mail),
  KEY rg_notice (rg_notice),
  KEY rg_next_num (rg_next_num)
) TYPE=MyISAM COMMENT='�Խ��� ���̺�';

--
-- Dumping data for table `rg_test_body`
--

INSERT INTO rg_test_body VALUES (4,4,0,1,0,2,0,1,'������','','','',0,'','',0,0,'','',0,0,0,0,0,0,0,0,'test2','test2',0,1195462955,0,'121.144.63.58','',0,0,'121.144.63.58',0,0,0,'�߰��Է�1 :','�߰��Է�2 :','�߰��Է�3 :','�߰��Է�4 :','�߰��Է�5 :','�߰��Է�6 :','�߰��Է�7 :','�߰��Է�8 :','�߰��Է�9 :','�߰��Է�10 :','�߰��Է�11 :','��2','��3','�߰��Է�14 :','�߰��Է�15 :','�߰��Է�16 :','�߰��Է�17 :','�߰��Է�18 :','�߰��Է�19 :','�߰��Է�20 :','�߰��Է�21 :','�߰��Է�22 :','�߰��Է�23 :','�߰��Է�24 :','�߰��Է�25 :','�߰��Է�26 :','�߰��Է�27 :','�߰��Է�28 :','�߰��Է�29 :','�߰��Է�30 :','�߰��Է�31 :','�߰��Է�32 :','�߰��Է�33 :','�߰��Է�34 :','�߰��Է�35 :','�߰��Է�36 :','�߰��Է�37 :','�߰��Է�38 :','�߰��Է�39 :','�߰��Է�40 :','�߰��Է�41 :','�߰��Է�42 :','�߰��Է�43 :','�߰��Է�44 :','�߰��Է�45 :','�߰��Է�46 :','�߰��Է�47 :','�߰��Է�48 :','�߰��Է�49 :','�߰��Է�50 :',0);
INSERT INTO rg_test_body VALUES (3,3,0,1,0,1,0,1,'������','','','',0,'','',0,0,'','',0,0,0,0,0,0,0,0,'test','test',0,1195462732,0,'121.144.63.58','',0,0,'121.144.63.58',0,0,0,'�߰��Է�1 :','�߰��Է�2 :','�߰��Է�3 :','�߰��Է�4 :','�߰��Է�5 :','�߰��Է�6 :','�߰��Է�7 :','�߰��Է�8 :','�߰��Է�9 :','�߰��Է�10 :','�߰��Է�11 :','��2','��2','�߰��Է�14 :','�߰��Է�15 :','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',0);

--
-- Table structure for table `rg_test_category`
--

CREATE TABLE rg_test_category (
  cat_num int(20) NOT NULL auto_increment,
  cat_order int(20) NOT NULL default '0',
  cat_name varchar(255) NOT NULL default '',
  cat_count int(20) NOT NULL default '0',
  PRIMARY KEY  (cat_num),
  KEY cat_order (cat_order)
) TYPE=MyISAM COMMENT='ī�װ����̺�';

--
-- Dumping data for table `rg_test_category`
--

INSERT INTO rg_test_category VALUES (1,1,'����',0);
INSERT INTO rg_test_category VALUES (2,2,'�亯',0);
INSERT INTO rg_test_category VALUES (3,3,'���',0);

--
-- Table structure for table `rg_test_comment`
--

CREATE TABLE rg_test_comment (
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
) TYPE=MyISAM COMMENT='�ڸ�Ʈ���̺�';

--
-- Dumping data for table `rg_test_comment`
--


--
-- Table structure for table `rg_vote_cfg`
--

CREATE TABLE rg_vote_cfg (
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
) TYPE=MyISAM COMMENT='��ǥ ���� ���̺�';

--
-- Dumping data for table `rg_vote_cfg`
--


--
-- Table structure for table `rg_vote_cmt`
--

CREATE TABLE rg_vote_cmt (
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
) TYPE=MyISAM COMMENT='��ǥ �ڸ�Ʈ';

--
-- Dumping data for table `rg_vote_cmt`
--


--
-- Table structure for table `rg_vote_ip`
--

CREATE TABLE rg_vote_ip (
  vip_num int(11) NOT NULL auto_increment,
  vip_vt_num int(11) NOT NULL default '0',
  vip_vit_num int(11) NOT NULL default '0',
  vip_mb_num int(11) NOT NULL default '0',
  vip_ip varchar(20) NOT NULL default '',
  vip_date int(11) NOT NULL default '0',
  PRIMARY KEY  (vip_num),
  KEY vip_vt_num (vip_vt_num,vip_vit_num,vip_mb_num,vip_ip),
  KEY vip_date (vip_date)
) TYPE=MyISAM COMMENT='��ǥ ������ ���';

--
-- Dumping data for table `rg_vote_ip`
--


--
-- Table structure for table `rg_vote_item`
--

CREATE TABLE rg_vote_item (
  vit_num int(11) NOT NULL auto_increment,
  vit_vt_num int(11) NOT NULL default '0',
  vit_order int(11) NOT NULL default '0',
  vit_item varchar(255) NOT NULL default '',
  vit_count int(11) NOT NULL default '0',
  PRIMARY KEY  (vit_num),
  KEY vit_vt_num (vit_vt_num,vit_order)
) TYPE=MyISAM COMMENT='��ǥ �׸� ���̺�';

--
-- Dumping data for table `rg_vote_item`
--


--
-- Table structure for table `rg_yeyak_body`
--

CREATE TABLE rg_yeyak_body (
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
  rg_ext1 date NOT NULL default '0000-00-00',
  rg_ext2 varchar(255) NOT NULL default '',
  rg_ext3 varchar(255) NOT NULL default '',
  rg_ext4 varchar(255) NOT NULL default '',
  rg_ext5 varchar(255) NOT NULL default '',
  rg_ext6 varchar(255) NOT NULL default '',
  rg_ext7 varchar(255) NOT NULL default '',
  rg_ext8 varchar(255) NOT NULL default '',
  rg_ext9 varchar(255) NOT NULL default '',
  rg_ext10 varchar(255) NOT NULL default '',
  rg_ext11 varchar(255) NOT NULL default '',
  rg_ext12 varchar(255) NOT NULL default '',
  rg_ext13 varchar(255) NOT NULL default '',
  rg_ext14 varchar(255) NOT NULL default '',
  rg_ext15 varchar(255) NOT NULL default '',
  rg_ext16 varchar(255) NOT NULL default '',
  rg_ext17 varchar(255) NOT NULL default '',
  rg_ext18 varchar(255) NOT NULL default '',
  rg_ext19 varchar(255) NOT NULL default '',
  rg_ext20 varchar(255) NOT NULL default '',
  rg_ext21 varchar(255) NOT NULL default '',
  rg_ext22 varchar(255) NOT NULL default '',
  rg_ext23 varchar(255) NOT NULL default '',
  rg_ext24 varchar(255) NOT NULL default '',
  rg_ext25 varchar(255) NOT NULL default '',
  rg_ext26 varchar(255) NOT NULL default '',
  rg_ext27 varchar(255) NOT NULL default '',
  rg_ext28 varchar(255) NOT NULL default '',
  rg_ext29 varchar(255) NOT NULL default '',
  rg_ext30 varchar(255) NOT NULL default '',
  rg_ext31 varchar(255) NOT NULL default '',
  rg_ext32 varchar(255) NOT NULL default '',
  rg_ext33 varchar(255) NOT NULL default '',
  rg_ext34 varchar(255) NOT NULL default '',
  rg_ext35 varchar(255) NOT NULL default '',
  rg_ext36 varchar(255) NOT NULL default '',
  rg_ext37 varchar(255) NOT NULL default '',
  rg_ext38 varchar(255) NOT NULL default '',
  rg_ext39 varchar(255) NOT NULL default '',
  rg_ext40 varchar(255) NOT NULL default '',
  rg_ext41 varchar(255) NOT NULL default '',
  rg_ext42 varchar(255) NOT NULL default '',
  rg_ext43 varchar(255) NOT NULL default '',
  rg_ext44 varchar(255) NOT NULL default '',
  rg_ext45 varchar(255) NOT NULL default '',
  rg_ext46 varchar(255) NOT NULL default '',
  rg_ext47 varchar(255) NOT NULL default '',
  rg_ext48 varchar(255) NOT NULL default '',
  rg_ext49 varchar(255) NOT NULL default '',
  rg_ext50 varchar(255) NOT NULL default '',
  admin_orderby int(11) default '0',
  PRIMARY KEY  (rg_doc_num),
  KEY rg_top_num (rg_top_num),
  KEY rg_cat_num (rg_cat_num),
  KEY rg_title (rg_title),
  KEY rg_name (rg_name),
  KEY rg_notice (rg_notice),
  KEY rg_next_num (rg_next_num),
  KEY rg_ext8 (rg_ext8)
) TYPE=MyISAM COMMENT='�Խ��� ���̺�';

--
-- Dumping data for table `rg_yeyak_body`
--

INSERT INTO rg_yeyak_body VALUES (21,21,0,1,0,1,0,0,'�����','1111','1111@hanmail.net','',0,'','',0,0,'','',0,0,0,0,0,0,0,0,'','1111',0,0,0,'220.71.88.40','',0,0,'220.71.88.40',0,0,0,'2007-12-07','2','1','3��4��','2007-12-19','2007-12-19|2007-12-20|2007-12-21','��(�)','�Աݴ��','�߰�','011','111','1111','ȫ�浿','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',0);
INSERT INTO rg_yeyak_body VALUES (22,22,0,1,0,2,0,0,'����ǥ','1111','1111@hanmail.net','',0,'','',0,0,'','',0,0,0,0,0,0,0,0,'','1111',0,0,0,'220.71.88.40','',0,0,'220.71.88.40',0,0,0,'2007-12-07','2','����','1��2��','2007-12-17','2007-12-17','��(�)','�Աݴ��','�߰�����','010','111','1111','����ǥ','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',0);

--
-- Table structure for table `rg_yeyak_category`
--

CREATE TABLE rg_yeyak_category (
  cat_num int(20) NOT NULL auto_increment,
  cat_order int(20) NOT NULL default '0',
  cat_name varchar(255) NOT NULL default '',
  cat_count int(20) NOT NULL default '0',
  PRIMARY KEY  (cat_num),
  KEY cat_order (cat_order)
) TYPE=MyISAM COMMENT='ī�װ����̺�';

--
-- Dumping data for table `rg_yeyak_category`
--

INSERT INTO rg_yeyak_category VALUES (1,1,'����',0);
INSERT INTO rg_yeyak_category VALUES (2,2,'�亯',0);
INSERT INTO rg_yeyak_category VALUES (3,3,'���',0);

--
-- Table structure for table `rg_yeyak_comment`
--

CREATE TABLE rg_yeyak_comment (
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
) TYPE=MyISAM COMMENT='�ڸ�Ʈ���̺�';

--
-- Dumping data for table `rg_yeyak_comment`
--


--
-- Table structure for table `sungsugi`
--

CREATE TABLE sungsugi (
  seq_num int(11) NOT NULL auto_increment,
  start_date varchar(20) default NULL,
  end_date varchar(20) default NULL,
  use_date text,
  start_date2 varchar(20) default NULL,
  end_date2 varchar(20) default NULL,
  use_date2 text,
  PRIMARY KEY  (seq_num)
) TYPE=MyISAM;

--
-- Dumping data for table `sungsugi`
--

INSERT INTO sungsugi VALUES (1,'2008-08-01','2008-08-31','','2007-12-22','2008-01-01','');





