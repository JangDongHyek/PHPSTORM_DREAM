<?
/* =====================================================
	ȭ�ϸ� : dbcon.php
  �ۼ��� : 2001. 2. 11
  �ۼ��� : ������
  �ۼ��� E-Mail : carrotdi@orgio.net
 ===================================================== */
if (!defined('MYSQL_INC_INCLUDED')) {  
    define('MYSQL_INC_INCLUDED', 1);
// *-- MYSQL_INC_INCLUDED START --*

	define("_DEBUG_", 1);	// ����� ����

	// ����Ÿ���̽� �ʱ�ȭ
  function dbinit() {
    global $mysql_host, $mysql_user, $mysql_password, $mysql_database_name;
    $result_ = @mysql_connect($mysql_host, $mysql_user, $mysql_password);
		if(!$result_) {
			if(_DEBUG_)	{ 
				echo '���� : '.mysql_error().' <br>����Ÿ���̽��� ������ �� �� �����ϴ�.<br>Ȩ������ �����ڴ� ����Ÿ���̽� ���� ������ Ȯ����<br> ����Ÿ���̽������� �����Ͻñ� �ٶ��ϴ�.';
				exit;
			}
			return false;
		}
    if(!@mysql_select_db($mysql_database_name,$result_)) {
			if(_DEBUG_)	{
				echo "���� : ".mysql_error().' <br>����Ÿ���̽��� ������ �� �� �����ϴ�.<br>Ȩ������ �����ڴ� ����Ÿ���̽� ���� ������ Ȯ����<br> ����Ÿ���̽������� �����Ͻñ� �ٶ��ϴ�.';
				exit;
			}
			return false;
		}
    return $result_;
  }

  // ����Ÿ���̽� �ݱ�
  function dbclose($dbcon) {
    $result_ = @mysql_close($dbcon);
		if(!$result_) {
			if(_DEBUG_)	{ 
				echo "���� : ".mysql_error();
				exit;
			}
		}
    return $result_;
  }

  // ����� �о ���� �迭�� ����
  function fetch($dbrs,$result) {
		$_cols = @mysql_fetch_row($dbrs);
		if(!$_cols) {
			if(_DEBUG_) {
				echo "���� : ".mysql_error();
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
  
	// ����� �о ���� �迭�� ����
  function fetcha($dbrs) {
		$_cols = @mysql_fetch_array($dbrs);
		if(!$_cols) {
			if(_DEBUG_) {
				echo "���� : ".mysql_error();
				exit;
			}
		}
		return $_cols;
	}
	
  // ����Ÿ ���̽��� ���ǹ� ����
  function query($query,$dbcon,$error_skip=0) {
//    $result_ = mysql_query($query,$dbcon) or die("Query���� ������ �� �����ϴ�.<br>$query<br>".mysql_error());
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