<?php
class QnaDB {
    private $host = '211.51.221.167';
    private $database = 'itforone_test2';
    private $userid = 'project_qna';
    private $password = 'emflavhdnjs'; //sbtpsxja!@#
    protected $db;

	// 페이징변수
	public $list_rows = 20;				// 한페이지 글 개수
	public $list_page_rows = 5;			// 한블록 개수

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

	// 목록
	function getList($mid, $page=1, $type="all") {
		$return_data = array();

		// 목록 총 개수
		$row = $this->getDbRows("count", $mid);
		$return_data['cnt'] = $row['cnt'];

		if ($type == "notice") {
			$sql = "SELECT * FROM project_qna WHERE is_notice = 'Y' ORDER BY idx DESC";
		} else {
			$from_record = ($page - 1) * $this->list_rows;					// 시작 열
			$sql_limit = " LIMIT {$from_record}, ".$this->list_rows;
			$sql = "SELECT * FROM project_qna WHERE mid = '{$mid}' AND is_notice = 'N' ORDER BY idx DESC {$sql_limit}";
		}
		$result = mysqli_query($this->db, $sql);

		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
		    $return_data['list'][$i] = $row;
		}

		return $return_data;
	}

	// DB여러행 조회
	function getDbArray($mode, $pidx) {
		if ($mode == "reply")	// 답글
			$sql = "SELECT * FROM project_qna_reply WHERE pidx = '{$pidx}' ORDER BY idx DESC";
		
		$result = mysqli_query($this->db, $sql);
		$list = array();

		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$list[$i] = $row;
		}

		return $list;
	}

	// DB한행조회
	function getDbRows($type, $mid, $idx=0) {
		$sql = "";
		switch ($type) {
			case "count" : 	// 총 조회수
				$sql = "SELECT COUNT(*) AS cnt FROM project_qna WHERE mid = '{$mid}' AND is_notice = 'N'"; break;
			case "view" : 	// 상세보기, 글수정시
				$sql = "SELECT * FROM project_qna WHERE mid = '{$mid}' AND idx = '{$idx}'"; break;
			case "notice" :	// 공지
				$sql = "SELECT * FROM project_qna WHERE idx = '{$idx}' AND is_notice = 'Y'"; break;
		}
		if ($sql == "") return false;
		
		$result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($result);

		return $row;
	}

	// 답글 카운트
	function getReplyDbRows($pidx) {
        $sql = "SELECT COUNT(*) AS cnt FROM project_qna_reply WHERE pidx = '{$pidx}'";
        if ($sql == "") return false;

        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($result);

        return $row['cnt'];
    }

	// DB삽입,삭제
	function getDbInsert($sql){
		$result = mysqli_query($this->db, $sql);
		return $result;
    }

    //DB업데이트
    function getDbUpdate($sql){
        mysqli_query('set names utf8');
        mysqli_query('set sql_mode=\'\'');
        $result = mysqli_query($this->db, $sql);
		return $result;
    }


}

class ManagerDB {
    private $host = '211.51.221.181';
    private $database = 'ktlove004';
    private $userid = 'ktlove004';
    private $password = 'kt8910088';
    protected $db2;

    public function __construct() {
        $this->db2 = $this->connectDB();
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
	function getInfo($mid) {
		$result = mysqli_query($this->db, "SELECT firm_name, site_name FROM manager WHERE no = '{$mid}'");
        $row = mysqli_fetch_array($result);
        return euckrToUtf8($row);
	}
}

// 인코딩변환
function euckrToUtf8($row) {
	$iconv = [];
	foreach ($row AS $key=>$val) {
		//$iconv[$key] = iconv('euckr', 'utf8', $val);
	}
	return $iconv;
}
?>