<?
if (!defined('CONFIG_INC_INCLUDED')) {  
  define('CONFIG_INC_INCLUDED', 1);
// *-- CONFIG_INC_INCLUDED START --*
	@error_reporting(E_ALL ^ E_NOTICE);
	// 보드버전 2005-10-01 ver 3.1.5 판올림
	$C_RGBOARD_VERSION = '1.2';
	
	// 게시판설정 상수정의
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
	
	// 회원 기능 설정상수
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
	
	// 게시판 관련
	$db_table_prefix = 'rg_';
	
	$db_table_suffix_body = '_body';
	$db_table_suffix_category = '_category';
	$db_table_suffix_comment = '_comment';

	$db_table_vote = $db_table_prefix.'vote'; // 투표기능추가 2003-10-14 
	
	$db_table_member = $db_table_prefix.'member';
	$db_table_site_cfg = $db_table_prefix.'site_cfg';
	$db_table_group_cfg = $db_table_prefix.'group_cfg';
	$db_table_group_member = $db_table_prefix.'group_member';
	$db_table_bbs_cfg = $db_table_prefix.'bbs_cfg';
	$db_table_zip = $db_table_prefix.'zip';
	$db_table_connect = $db_table_prefix.'connect';
	$db_table_memo = $db_table_prefix.'memo';
	
	$data_dir = 'data/';
	$editor_data_dir = "editor/upload/";			// 웹에디터 업로드

	$session_tmp_dir = '__session_tmp/';
	$member_photo_dir = '__mb_photo/';
	$member_icon_dir = '__mb_icon/';
	
	$skin_dir = 'skin/';
	$skin_board_dir = 'board/';
	$skin_member_dir = 'member/';
	$skin_site_dir = 'site/';
	$skin_vote_dir = 'vote/';	// 투표추가 2003-10-14 
	$skin_vote_preview_dir = 'vote_preview/';	// 외부투표 2003-10-14 
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
	
	// 추가항목 형태
	$ext_types = array();
	$ext_types[1] = array('value'=>'1','name'=>'라디오버튼','ex'=>'!값1|값2|값3|값4');
	$ext_types[2] = array('value'=>'2','name'=>'텍스트입력','ex'=>'크기|기본값');
	$ext_types[3] = array('value'=>'3','name'=>'셀렉트','ex'=>'값1|!값2|값3|값4');
	$ext_types[4] = array('value'=>'4','name'=>'체크박스','ex'=>'!{}표시이름|값');
	$ext_types[5] = array('value'=>'5','name'=>'텍스트영역','ex'=>'cols|rows|기본값');
	
	// 그룹상태
	$gr_states = array(0=>'정상',1=>'승인대기',2=>'폐쇄');
	// 그룹내회원표시방법
	$gr_name_disps = array(0=>'아이디',1=>'이름',2=>'닉네임');
	// 그룹공개여부
	$gr_open_list = array(0=>'공개',1=>'비공개');
	// 그룹레벨적용(그룹레벨일경우 그룹비회원인경우 접근불가)
	$gr_level_type_list = array(0=>'회원레벨',1=>'그룹레벨');

	// 회원가입폼설정
	$sel_join_form_field  = array(0=>'사용안함',1=>'선택',2=>'필수입력');

	// 회원상태
	$mb_states = array(0=>'정상',1=>'승인대기',2=>'보류',3=>'탈퇴');

	// 투표 권한설정 값 2003-10-14
	$vote_auths = array(
	    		'A'=>'전체','M'=>'회원','D'=>'운영자','N'=>'사용안함',
					0=>'레벨 0',1=>'레벨 1',2=>'레벨 2',3=>'레벨 3',4=>'레벨 4',
					5=>'레벨 5',6=>'레벨 6',7=>'레벨 7',8=>'레벨 8',9=>'레벨 9',
					10=>'레벨 10');

	// 게시판 권한설정 값
	$bbs_auths = array(
	    		'A'=>'전체','M'=>'회원','G'=>'그룹회원','D'=>'운영자','N'=>'사용안함',
					0=>'레벨 0',1=>'레벨 1',2=>'레벨 2',3=>'레벨 3',4=>'레벨 4',
					5=>'레벨 5',6=>'레벨 6',7=>'레벨 7',8=>'레벨 8',9=>'레벨 9',
					10=>'레벨 10');
	$levels = array(
					0=>'레벨 0',1=>'레벨 1',2=>'레벨 2',3=>'레벨 3',4=>'레벨 4',
					5=>'레벨 5',6=>'레벨 6',7=>'레벨 7',8=>'레벨 8',9=>'레벨 9',
					10=>'레벨 10');
	
	$bbs_func = array(0=>'사용안함',1=>'사용함');
	
	// 게시판 권한설정 값(html 사용여부)
	$bbs_html_auths = array(0=>'부분사용가능',1=>'부분사용불가');
	// 게시판 권한설정 값(관련글 존재시 수정/삭제가능여부)
	$bbs_exist_del_auths = array(0=>'제한없음',1=>'수정/삭제불가',2=>'수정불가',3=>'삭제불가',4=>'삭제표시만');
	// 게시판 권한설정 값(목록함께보기)
	$bbs_list_auths = array(0=>'사용안함',1=>'전체목록',2=>'관련글만');
	// 게시판 권한설정 값(이미지 함께보기)
	$bbs_image_view_auths = array(0=>'사용안함',1=>'함께보기');

	$doc_encoding_list = array(
		'euc-kr' => 'korea(euc-kr)'
		);
				
	$doc_align_list = array(
		'center' => '가운데(center)','left'=>'왼쪽(left)','right'=>'오른쪽(right)'
		);

	$mb_sex_list = array('M' => '남자','F'=>'여자');	

	$msg_upload_ext = "업로드는 %file_ext%확장자만 가능합니다";
	$msg_noupload_ext = "업로드는 %file_ext%확장자를 제외한 파일만 가능합니다";
	$msg_not_find_mb_id = "%mb_id%는 없는 아이디입니다.";
	$msg_no_match_mb_password = "암호가 다릅니다.";
	
	$msg_exist_mb_id = "%mb_id%는 사용중인 아이디입니다.";
	$msg_exist_mb_nick = "%mb_nick%는 사용중인 닉네임입니다.";
	$msg_exist_mb_jumin = "이미 등록된 주민등록번호입니다.";
	$msg_check_mb_jumin = "잘못된 주민등록번호입니다.";
	
	$msg_exist_gr_mb_id = "%id%는 이미가입된 아이디입니다.";

	$msg_mb_password_required = "전부 입력해주세요.";
	$msg_mb_password_not_find = "해당 회원이 없습니다.";
	$msg_mb_password_mail_subject = "%id% 님의 변경된 암호입니다.";
	$msg_mb_password_send_ok = "암호를 전송했습니다.";

	$msg_normal_error = "잘못된 접근입니다.";

	/**
	*	내가 추가한 상수
	*/
	$mb_tel_list = array('02'=>'02','031'=>'031','032'=>'032','033'=>'033','041'=>'041','042'=>'042','043'=>'043',
							'051'=>'051','052'=>'052','053'=>'053','054'=>'054','055'=>'055','061'=>'061','062'=>'062',
							'063'=>'063','063'=>'064');

	$mb_mobile_list = array('010'=>'010','011'=>'011','016'=>'016','017'=>'017','018'=>'018','019'=>'019');

	// 가고 직업 리스트
	$mb_job_list = array('기획/사무직'=>'기획/사무직','금융/증권'=>'금융/증권','이사/총무'=>'이사/총무',
								'엔지니어'=>'엔지니어','연구원'=>'연구원','정보통신'=>'정보통신','컴퓨터관련'=>'컴퓨터관련',
								'인터넷관련'=>'인터넷관련','건설/토목'=>'건설/토목','서비스/영업'=>'서비스/영업',
								'승무원/항공관련'=>'승무원/항공관련','공무원'=>'공무원','교직원'=>'교직원','교사'=>'교사',
								'학원강사'=>'학원강사','사업'=>'사업','프리랜서'=>'프리랜서','예술가'=>'예술가',
								'연예인'=>'연예인','디자이너'=>'디자이너','학생'=>'학생','유학생'=>'유학생',
								'의사/한의사'=>'의사/한의사','변호사/법조인'=>'변호사/법조인','자영업'=>'자영업',
								'교수/전임강사'=>'교수/전임강사','언론인'=>'언론인','회계/세무'=>'회계/세무',
								'유치원교사'=>'유치원교사','간호사/병원기술직'=>'간호사/병원기술직','운동선수'=>'운동선수',
								'무직'=>'무직','기타'=>'기타');
	
	// 이미지 타입 배열
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