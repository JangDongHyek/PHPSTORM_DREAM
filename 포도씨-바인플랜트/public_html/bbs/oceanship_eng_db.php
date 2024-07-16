<?php
class podoseaEngDB {
    private $host = '14.48.175.189';
    private $database = 'oceanship_eng';
    private $userid = 'oceanship';
    private $password = 'd1j1gmeh';
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

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            return $dbconn;
        }
    }

    // 페이징변수
    public $list_rows = 10;     // 한페이지 글 개수
    public $list_page_rows = 5; // 한블록 개수

    // 목록
    function getList($page=1, $orderby, $search, $type, $category, $date) {
        /* 검색조건 */
        // 정렬
        $sql_orderby = " order by wr_datetime desc "; // default 등록순
        if($orderby == '등록순') { // 등록순
            $sql_orderby = " order by wr_datetime desc ";
        }
        else if($orderby == '마감순') { // 마감순
            $sql_orderby = " order by ci_deadline_date asc ";
        }
        // 검색
        $sql_search = " and podosea != 'Y' and ci_deadline_date >= date_format(now(), '%Y-%m-%d') and ci_state = 'Processing submission' and target_mb_no = 0 and del_yn is null "; // 접수대기 상태의 의뢰만 표시 / 기업 미니홈피에서 의뢰 시 해당 기업만 의뢰 조회 가능 해야 함
        // 검색 (검색어 입력)
        if(!empty(trim($search))) {
            $sql_search .= " and (ci_subject like '%{$search}%' or ci_contents like '%{$search}%' or ci_category like '%{$search}%' or ci_maker like '%{$search}%' or ci_model like '%{$search}%' or ci_serial_no like '%{$search}%') ";
        }
        // 검색 (의뢰유형)
        if(!empty($type) && $type != '전체') {
            $sql_search .= " and ci_type = '{$type}' ";
        }
        // 검색 (카테고리)
        if(!empty($category) && $category != '전체') {
            $sql_search .= " and ci_category = '{$category}' ";
        }
        // 검색 (기간검색)
        if(!empty($date)) {
            if($date == '1일') { // 1일전~지금
                $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 DAY)";
            }
            else if($date == '1주일') { // 1주일전~지금
                $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 7 DAY)";
            }
            else if($date == '1개월') { // 1개월전~지금
                $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 MONTH)";
            }
        }
        $sql_add = $sql_search.$sql_orderby;
        /* 검색조건 */

        $return_data = array();

        // 목록 총 개수
        $row = $this->getDbRows("count", 0, $sql_add);
        $return_data['cnt'] = $row['cnt'];
        $return_data['page'] = ceil($row['cnt'] / $this->list_rows);

        $from_record = ($page - 1) * $this->list_rows; // 시작 열
        $sql_limit = " limit {$from_record}, ".$this->list_rows;
        $sql = "SELECT * FROM g5_company_inquiry WHERE 1 {$sql_add} {$sql_limit}";
        $result = mysqli_query($this->db, $sql);

        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
            $return_data['list'][$i] = $row;
        }

        return $return_data;
    }

    // DB 한행조회
    function getDbRows($type, $idx=0, $sql_add) {
        $sql = "";
        switch ($type) {
            case "count" : 	// 총 조회수
                $sql = "SELECT COUNT(*) AS cnt FROM g5_company_inquiry WHERE 1 {$sql_add}"; break;

            case "view" : 	// 상세보기, 글수정시
                $sql = "SELECT ci.*, mb.mb_no, mb.mb_nick, mb.mb_category, mb.mb_company_homepage FROM g5_company_inquiry as ci left join g5_member as mb on mb.mb_id = ci.mb_id 
                        WHERE idx = '{$idx}'"; break;
        }
        if ($sql == "") return false;

        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($result);

        return $row;
    }
}

$db = new podoseaEngDB();