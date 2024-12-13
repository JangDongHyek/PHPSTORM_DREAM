<?
if (!defined('CONFIG_INC_INCLUDED')) {  
  define('CONFIG_INC_INCLUDED', 1);
// *-- CONFIG_INC_INCLUDED START --*
	@error_reporting(E_ALL ^ E_NOTICE);
	// ������� 2005-10-01 ver 3.1.5 �ǿø�
	$C_RGBOARD_VERSION = '1.2';
	
	// �Խ��Ǽ��� �������
	$C_AUTH_READ = 1;
	$C_AUTH_WRITE = 2;
	$C_AUTH_REPLY = 3;
	$C_AUTH_COMMENT = 4;
	$C_AUTH_UPLOAD = 5;
	$C_AUTH_DOWNLOAD = 6;
	$C_AUTH_VOTE_YES = 7;
	$C_AUTH_VOTE_NO = 8;
	$C_AUTH_HTML = 9;
	$C_AUTH_LIST = 10;
	$C_AUTH_LINK = 11;
	$C_AUTH_NOTICE = 12;
	$C_AUTH_EDIT = 13;
	$C_AUTH_SECRET = 14;
	$C_AUTH_CART = 15;
	$C_AUTH_DELETE = 16;

	$C_USE_CATEGORY = 20;
	$C_USE_REMOTE_WRITE = 21;
	$C_USE_QUOTE = 22;
	$C_USE_VIEW_MAIL = 23;
	$C_USE_REPLAY_MAIL = 24;
	$C_USE_ADMIN_MAIL = 25;
	$C_USE_SIGNATURE = 26;
	$C_USE_MB_ICON = 27;

	$C_HTML_TYPE = 30;
	$C_REPLY_DELETE = 31;
	$C_VIEW_LIST = 32;
	$C_VIEW_IMAGE = 33;
	
	// ȸ�� ��� �������
	$MB_C_NICK = 1;
	$MB_C_NAME = 2;
	$MB_C_EMAIL = 3;
	$MB_C_MSN = 4;
	$MB_C_HOMEPAGE = 5;
	$MB_C_TEL = 6;
	$MB_C_MOBILE = 7;
	$MB_C_JUMIN = 8;
	$MB_C_BIRTH = 9;
	$MB_C_ADDRESS = 10;
	$MB_C_SEX = 11;
	$MB_C_JOB = 12;
	$MB_C_HOBBY = 13;
	$MB_C_PHOTO = 14;
	$MB_C_ICON = 15;
	$MB_C_SIGNATURE = 16;
	$MB_C_GREET = 17;
	
	// �Խ��� ����
	$db_table_prefix = 'rg_';
	
	$db_table_suffix_body = '_body';
	$db_table_suffix_category = '_category';
	$db_table_suffix_comment = '_comment';

	$db_table_vote = $db_table_prefix.'vote'; // ��ǥ����߰� 2003-10-14 
	
	$db_table_member = $db_table_prefix.'member';
	$db_table_site_cfg = $db_table_prefix.'site_cfg';
	$db_table_group_cfg = $db_table_prefix.'group_cfg';
	$db_table_group_member = $db_table_prefix.'group_member';
	$db_table_bbs_cfg = $db_table_prefix.'bbs_cfg';
	$db_table_zip = $db_table_prefix.'zip';
	$db_table_connect = $db_table_prefix.'connect';
	$db_table_memo = $db_table_prefix.'memo';
	
	$data_dir = 'data/';
	$editor_data_dir = "editor/upload/";			// �������� ���ε�

	$session_tmp_dir = '__session_tmp/';
	$member_photo_dir = '__mb_photo/';
	$member_icon_dir = '__mb_icon/';
	
	$skin_dir = 'skin/';
	$skin_board_dir = 'board/';
	$skin_member_dir = 'member/';
	$skin_site_dir = 'site/';
	$skin_vote_dir = 'vote/';	// ��ǥ�߰� 2003-10-14 
	$skin_vote_preview_dir = 'vote_preview/';	// �ܺ���ǥ 2003-10-14 
	$skin_lastest_dir = 'lastest/';
	$skin_outlogin_dir = 'outlogin/';
	$addon_dir = 'addon/';
	
	$skin_board_id = 'default';
	$skin_member_id = 'default';
	$skin_site_id = 'default';
	
	$site_bbs_view_chk_size = 256;
	$site_bbs_vote_chk_size = 256;
	
	if(!$site_url) $site_url="./";
	
	$auth = array();
	
	// �߰��׸� ����
	$ext_types = array();
	$ext_types[1] = array('value'=>'1','name'=>'������ư','ex'=>'!��1|��2|��3|��4');
	$ext_types[2] = array('value'=>'2','name'=>'�ؽ�Ʈ�Է�','ex'=>'ũ��|�⺻��');
	$ext_types[3] = array('value'=>'3','name'=>'����Ʈ','ex'=>'��1|!��2|��3|��4');
	$ext_types[4] = array('value'=>'4','name'=>'üũ�ڽ�','ex'=>'!{}ǥ���̸�|��');
	$ext_types[5] = array('value'=>'5','name'=>'�ؽ�Ʈ����','ex'=>'cols|rows|�⺻��');
	
	// �׷����
	$gr_states = array(0=>'����',1=>'���δ��',2=>'���');
	// �׷쳻ȸ��ǥ�ù��
	$gr_name_disps = array(0=>'���̵�',1=>'�̸�',2=>'�г���');
	// �׷��������
	$gr_open_list = array(0=>'����',1=>'�����');
	// �׷췹������(�׷췹���ϰ�� �׷��ȸ���ΰ�� ���ٺҰ�)
	$gr_level_type_list = array(0=>'ȸ������',1=>'�׷췹��');

	// ȸ������������
	$sel_join_form_field  = array(0=>'������',1=>'����',2=>'�ʼ��Է�');

	// ȸ������
	$mb_states = array(0=>'����',1=>'���δ��',2=>'����',3=>'Ż��');

	// ��ǥ ���Ѽ��� �� 2003-10-14
	$vote_auths = array(
	    		'A'=>'��ü','M'=>'ȸ��','D'=>'���','N'=>'������',
					0=>'���� 0',1=>'���� 1',2=>'���� 2',3=>'���� 3',4=>'���� 4',
					5=>'���� 5',6=>'���� 6',7=>'���� 7',8=>'���� 8',9=>'���� 9',
					10=>'���� 10');

	// �Խ��� ���Ѽ��� ��
	$bbs_auths = array(
	    		'A'=>'��ü','M'=>'ȸ��','G'=>'�׷�ȸ��','D'=>'���','N'=>'������',
					0=>'���� 0',1=>'���� 1',2=>'���� 2',3=>'���� 3',4=>'���� 4',
					5=>'���� 5',6=>'���� 6',7=>'���� 7',8=>'���� 8',9=>'���� 9',
					10=>'���� 10');
	$levels = array(
					0=>'���� 0',1=>'���� 1',2=>'���� 2',3=>'���� 3',4=>'���� 4',
					5=>'���� 5',6=>'���� 6',7=>'���� 7',8=>'���� 8',9=>'���� 9',
					10=>'���� 10');
	
	$bbs_func = array(0=>'������',1=>'�����');
	
	// �Խ��� ���Ѽ��� ��(html ��뿩��)
	$bbs_html_auths = array(0=>'�κл�밡��',1=>'�κл��Ұ�');
	// �Խ��� ���Ѽ��� ��(���ñ� ����� ����/�������ɿ���)
	$bbs_exist_del_auths = array(0=>'���Ѿ���',1=>'����/�����Ұ�',2=>'�����Ұ�',3=>'�����Ұ�',4=>'����ǥ�ø�');
	// �Խ��� ���Ѽ��� ��(����Բ�����)
	$bbs_list_auths = array(0=>'������',1=>'��ü���',2=>'���ñ۸�');
	// �Խ��� ���Ѽ��� ��(�̹��� �Բ�����)
	$bbs_image_view_auths = array(0=>'������',1=>'�Բ�����');

	$doc_encoding_list = array(
		'euc-kr' => 'korea(euc-kr)'
		);
				
	$doc_align_list = array(
		'center' => '���(center)','left'=>'����(left)','right'=>'������(right)'
		);

	$mb_sex_list = array('M' => '����','F'=>'����');	

	$msg_upload_ext = "���ε�� %file_ext%Ȯ���ڸ� �����մϴ�";
	$msg_noupload_ext = "���ε�� %file_ext%Ȯ���ڸ� ������ ���ϸ� �����մϴ�";
	$msg_not_find_mb_id = "%mb_id%�� ���� ���̵��Դϴ�.";
	$msg_no_match_mb_password = "��ȣ�� �ٸ��ϴ�.";
	
	$msg_exist_mb_id = "%mb_id%�� ������� ���̵��Դϴ�.";
	$msg_exist_mb_nick = "%mb_nick%�� ������� �г����Դϴ�.";
	$msg_exist_mb_jumin = "�̹� ��ϵ� �ֹε�Ϲ�ȣ�Դϴ�.";
	$msg_check_mb_jumin = "�߸��� �ֹε�Ϲ�ȣ�Դϴ�.";
	
	$msg_exist_gr_mb_id = "%id%�� �̹̰��Ե� ���̵��Դϴ�.";

	$msg_mb_password_required = "���� �Է����ּ���.";
	$msg_mb_password_not_find = "�ش� ȸ���� �����ϴ�.";
	$msg_mb_password_mail_subject = "%id% ���� ����� ��ȣ�Դϴ�.";
	$msg_mb_password_send_ok = "��ȣ�� �����߽��ϴ�.";

	$msg_normal_error = "�߸��� �����Դϴ�.";

	/**
	*	���� �߰��� ���
	*/
	$mb_tel_list = array('02'=>'02','031'=>'031','032'=>'032','033'=>'033','041'=>'041','042'=>'042','043'=>'043',
							'051'=>'051','052'=>'052','053'=>'053','054'=>'054','055'=>'055','061'=>'061','062'=>'062',
							'063'=>'063','063'=>'064');

	$mb_mobile_list = array('010'=>'010','011'=>'011','016'=>'016','017'=>'017','018'=>'018','019'=>'019');

	// ���� ���� ����Ʈ
	$mb_job_list = array('��ȹ/�繫��'=>'��ȹ/�繫��','����/����'=>'����/����','�̻�/�ѹ�'=>'�̻�/�ѹ�',
								'�����Ͼ�'=>'�����Ͼ�','������'=>'������','�������'=>'�������','��ǻ�Ͱ���'=>'��ǻ�Ͱ���',
								'���ͳݰ���'=>'���ͳݰ���','�Ǽ�/���'=>'�Ǽ�/���','����/����'=>'����/����',
								'�¹���/�װ�����'=>'�¹���/�װ�����','������'=>'������','������'=>'������','����'=>'����',
								'�п�����'=>'�п�����','���'=>'���','��������'=>'��������','������'=>'������',
								'������'=>'������','�����̳�'=>'�����̳�','�л�'=>'�л�','���л�'=>'���л�',
								'�ǻ�/���ǻ�'=>'�ǻ�/���ǻ�','��ȣ��/������'=>'��ȣ��/������','�ڿ���'=>'�ڿ���',
								'����/���Ӱ���'=>'����/���Ӱ���','�����'=>'�����','ȸ��/����'=>'ȸ��/����',
								'��ġ������'=>'��ġ������','��ȣ��/���������'=>'��ȣ��/���������','�����'=>'�����',
								'����'=>'����','��Ÿ'=>'��Ÿ');
	
	// �̹��� Ÿ�� �迭
	$imageTypes = array(
		1 => 'GIF',
		2 => 'JPG',
		3 => 'PNG',
		4 => 'SWF',
		5 => 'PSD',
		6 => 'BMP',
		7 => 'TIFF(intel byte order)',
		8 => 'TIFF(motorola byte order)',
		9 => 'JPC',
		10 => 'JP2',
		11 => 'JPX',
		12 => 'JB2',
		13 => 'SWC',
		14 => 'IFF',
		15 => 'WBMP',
		16 => 'XBM'
	);

	/**
 	* Unset magic_quotes_runtime - do not change!
 	*/
	set_magic_quotes_runtime(0);
	
} // *-- CONFIG_INC_INCLUDED END --*
?>