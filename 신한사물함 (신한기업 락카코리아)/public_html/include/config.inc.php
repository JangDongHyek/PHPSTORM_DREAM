<?
if (!defined('CONFIG_INC_INCLUDED')) {  
  define('CONFIG_INC_INCLUDED', 1);
// *-- CONFIG_INC_INCLUDED START --*
	@error_reporting(E_ALL ^ E_NOTICE);
	// 보드버전 2005-10-01 ver 3.1.5 판올림
	$C_MALL_VERSION = '1.2';
	
	// 게시판설정 상수정의
	/*$C_AUTH_READ = 1;*/

	// 회원 기능 설정상수
	/*$MB_C_NICK = 1;
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
	$MB_C_GREET = 17;*/
	
	// 게시판 관련
	if(!$site_url) $site_url="./";
	
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
	*	내가 추가한 설정
	*/
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