<?php
class ManagerDB {
    private $host = '211.51.221.181';
    private $database = 'ktlove004';
    private $userid = 'ktlove004';
    private $password = 'kt8910088';
    protected $db;

    public function __construct() {
        $this->db = $this->connectDB();
    }

    function __destruct(){
        mysqli_close($this->connectDB());
    }

    private function connectDB() {
        $dbconn = mysqli_connect($this->host, $this->userid, $this->password, $this->database);
        mysqli_set_charset($dbconn, "utf8");
		// mysqli_query($dbconn, "set names utf8");
		//echo mysqli_character_set_name($dbconn);

        if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
        } else {
			return $dbconn;
        }
    }

	// 매니저 계정정보 호출
	function getInfo($mid=array()) {
		$result = mysqli_query($this->db, "SELECT * FROM manager WHERE no IN (".implode(",", $mid).") ORDER BY firm_name ASC");
		$result_cnt = mysqli_num_rows($result);
		$list = array();

		if ($result_cnt > 0) {
			while ($row = mysqli_fetch_array($result)){
				//$list[] = euckrToUtf8($row);
				$list[$row['no']]['firm_name'] = strip_tags(euckrToUtf8($row['firm_name']));
				$list[$row['no']]['site_name'] = strip_tags(euckrToUtf8($row['site_name']));
				$list[$row['no']]['no'] = $row['no'];
				$list[$row['no']]['com_code'] = $row['com_code'];
			}
		}

		return $list;
	}

		// 매니저 계정정보 호출
	function getAllInfo() {
		$result = mysqli_query($this->db, "SELECT no, firm_name, site_name FROM manager ORDER BY firm_name ASC");
		$result_cnt = mysqli_num_rows($result);
		$list = array();

		if ($result_cnt > 0) {
			while ($row = mysqli_fetch_array($result)){
				//$list[] = euckrToUtf8($row);
				$list[$row['no']]['firm_name'] = strip_tags(euckrToUtf8($row['firm_name']));
				$list[$row['no']]['site_name'] = strip_tags(euckrToUtf8($row['site_name']));
			}
		}

		return $list;
	}
}

// 인코딩변환
function euckrToUtf8($col) {
	/*
	$iconv = Array();
	foreach ($row AS $key=>$val) {
		$iconv[$key] = iconv('euckr', 'utf8', $val);
	}
	*/
	return iconv('euckr', 'utf8', $col);
}
?>