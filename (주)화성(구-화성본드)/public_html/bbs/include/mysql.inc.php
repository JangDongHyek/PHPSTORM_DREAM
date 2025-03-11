<?
/* =====================================================
	화일명 : dbcon.php
  작성일 : 2001. 2. 11
  작성자 : 윤범석
  작성자 E-Mail : carrotdi@orgio.net
 ===================================================== */
if (!defined('MYSQL_INC_INCLUDED')) {  
    define('MYSQL_INC_INCLUDED', 1);
// *-- MYSQL_INC_INCLUDED START --*

	define("_DEBUG_", 1);	// 디버깅 여부

	// 데이타베이스 초기화
  function dbinit() {
    global $mysql_host, $mysql_user, $mysql_password, $mysql_database_name;
    $result_ = @mysql_connect($mysql_host, $mysql_user, $mysql_password);
		if(!$result_) {
			if(_DEBUG_)	{ 
				echo '에러 : '.mysql_error().' <br>데이타베이스에 접속을 할 수 없습니다.<br>홈페이지 관리자는 데이타베이스 접속 정보를 확인후<br> 데이타베이스정보를 수정하시기 바랍니다.';
				exit;
			}
			return false;
		}
    if(!@mysql_select_db($mysql_database_name,$result_)) {
			if(_DEBUG_)	{
				echo "에러 : ".mysql_error().' <br>데이타베이스에 접속을 할 수 없습니다.<br>홈페이지 관리자는 데이타베이스 접속 정보를 확인후<br> 데이타베이스정보를 수정하시기 바랍니다.';
				exit;
			}
			return false;
		}
    return $result_;
  }

  // 데이타베이스 닫기
  function dbclose($dbcon) {
    $result_ = @mysql_close($dbcon);
		if(!$result_) {
			if(_DEBUG_)	{ 
				echo "에러 : ".mysql_error();
				exit;
			}
		}
    return $result_;
  }

  // 결과를 읽어서 변수 배열에 저장
  function fetch($dbrs,$result) {
		$_cols = @mysql_fetch_row($dbrs);
		if(!$_cols) {
			if(_DEBUG_) {
				echo "에러 : ".mysql_error();
				exit;
			}
		}
		if ($_cols) {
			for ($i = 0; ($i < count($result)) && ( $i < count($_cols) ); $i++) {
				$GLOBALS[$result[$i]] = $_cols[$i];
			}
		}
		return $_cols;
	}
  
	// 결과를 읽어서 변수 배열에 저장
  function fetcha($dbrs) {
		$_cols = @mysql_fetch_array($dbrs);
		if(!$_cols) {
			if(_DEBUG_) {
				echo "에러 : ".mysql_error();
				exit;
			}
		}
		return $_cols;
	}
	
  // 데이타 베이스로 질의문 전송
  function query($query,$dbcon,$error_skip=0) {
//    $result_ = mysql_query($query,$dbcon) or die("Query문을 실행할 수 없습니다.<br>$query<br>".mysql_error());
//		echo "$query<br>".mysql_error();
    $result_ = mysql_query($query,$dbcon);
		if(!$result_ && !$error_skip) {
			if(_DEBUG_) echo "$query<br>".mysql_error();
			exit;
		}
    return $result_;
  }

} // *-- MYSQL_INC_INCLUDED END --*
?>