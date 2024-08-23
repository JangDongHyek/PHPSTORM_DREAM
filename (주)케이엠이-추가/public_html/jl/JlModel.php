<?php
include_once("Jl.php");

class JlModel extends Jl{
    //Database 설정
    private $hostname;
    private $username;
    private $password;
    private $database;

    private $schema;
    private $table;
    private $connect;
    private $mysqli = false;
    public  $primary;
    private $autoincrement;
    private $empty;                         //true 일시 빈값은 그냥 건너뛴다

    private $sql = "";
    private $sql_order_by = "";
    private $group_bool = false;
    private $group_index = 0;
    public  $not = false;

    function __construct($object = array()) {
        //부모 생성자
        parent::__construct();

        // mysql 버전 확인
        if(function_exists("mysqli_connect")) $this->mysqli = true;

        //connect전 필수 정보확인
        if(!$this->DB["hostname"]) throw new \Exception("JlModel construct() : hostname를 입력해주세요.");
        $this->hostname = $this->DB["hostname"];
        if(!$this->DB["username"]) throw new \Exception("JlModel construct() : username를 입력해주세요.");
        $this->username = $this->DB["username"];
        if(!$this->DB["password"]) throw new \Exception("JlModel construct() : password를 입력해주세요.");
        $this->password = $this->DB["password"];
        if(!$this->DB["database"]) throw new \Exception("JlModel construct(): database를 입력해주세요.");
        $this->database = $this->DB["database"];

        //DB Connection
        if($this->mysqli) {
            $connect = new \mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($connect->connect_errno) throw new \Exception(mysqli_error($this->connect));
        }else {
            $connect = mysql_connect($this->hostname, $this->username, $this->password);
            if(!$connect) throw new \Exception(2);
            mysql_select_db($this->database, $connect);
        }
        $this->connect = $connect;

        $this->schema = array(
            "columns" => array()
        );

        if(!$object["table"]) throw new \Exception("JlModel construct() : 테이블명이 없습니다.");
        $this->table =$object["table"];
        $this->primary = $object["primary"] ? $object["primary"] : "idx";
        $this->autoincrement = $object["autoincrement"] ? $object["autoincrement"] : true;
        $this->empty = $object["empty"] ? $object["empty"] : false;

        // 테이블 확인
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='{$this->database}' AND TABLE_NAME='{$this->table}'";
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));

            $result = mysqli_num_rows($result);
        }else {
            $result = mysql_num_rows($result);
        }

        if(!$result) throw new \Exception("JlModel construct() : 테이블을 찾을수 없습니다.");

        // 테이블 스키마 정보 조회
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$this->table}' AND TABLE_SCHEMA='{$this->database}' ";

        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));

            while($row = mysqli_fetch_array($result)){
                array_push($this->schema['columns'], $row['COLUMN_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());

            while($row = mysql_fetch_array($result)){
                array_push($this->schema['columns'], $row['COLUMN_NAME']);
            }
        }
    }

    function getSchema() {
        return $this->schema;
    }

    function reset() {
        $this->sql = "";
        $this->sql_order_by = "";
    }

    function insert($_param){

        $param = $this->escape($_param);

        if($this->autoincrement) {
            $param[$this->primary] = empty($param[$this->primary]) ? '' : $param[$this->primary];

        }else {
            $param[$this->primary] = empty($param[$this->primary]) ? uniqid().str_pad(rand(0, 99), 2, "0", STR_PAD_LEFT) : $param[$this->primary];
        }

        foreach($param as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if(!empty($columns)) $columns .= ", ";
                $columns .= "`{$key}`";

                if(!empty($values)) $values .= ", ";
                $values .= "'{$value}'";
            }
        }

        // 생성일이 있는경우
        if(in_array("insert_date", $this->schema['columns'])){
            $columns .= ", `insert_date`";
            $values .= ", now()";
        }

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());
        }

        //return $_id;
        if($this->mysqli)
            return mysqli_insert_id($this->connect);
        else
            return mysql_insert_id($this->connect);
    }

    function count(){
        // Summary Query
        $sql = "SELECT $this->primary FROM {$this->table} WHERE 1 ".$this->sql;

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));

            $total_count = mysqli_num_rows($result);

        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());

            $total_count = mysql_num_rows($result);

        }


        return $total_count ? $total_count : 0;
    }

    function get($page = 0, $limit = 0) {
        // 페이징
        $skip  = ($page - 1) * $limit;

        // Data Query
        $sql = "SELECT * FROM {$this->table} WHERE 1 ";
        $sql .= $this->sql_order_by ? $this->sql." ORDER BY ".$this->sql_order_by : $this->sql;
        if($limit) $sql .= " LIMIT $skip, $limit";

        $object["data"] = array();
        $object["count"] = $this->count();

        $index = 1;

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));

            while($row = mysqli_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                $row["data_page_nor"] = $object['count'] - $index + 1;
                foreach ($row as $key => $value) {
                    // JSON인지 확인하고 디코딩 시도
                    $decoded_value = json_decode($value, true);

                    // JSON 디코딩이 성공했다면 값을 디코딩된 데이터로 변경
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $row[$key] = $decoded_value;
                    }
                }
                array_push($object["data"], $row);
                $index++;
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                $row["data_page_nor"] = $object['count'] - $index + 1;
                foreach ($row as $key => $value) {
                    // JSON인지 확인하고 디코딩 시도
                    $decoded_value = json_decode($value, true);

                    // JSON 디코딩이 성공했다면 값을 디코딩된 데이터로 변경
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $row[$key] = $decoded_value;
                    }
                }
                array_push($object["data"], $row);
                $index++;
            }
        }

        $this->reset();

        return $object;
    }

    function update($_param){

        $param = $this->escape($_param);

        if(!$param[$this->primary]) throw new \Exception("JlModel update() : 고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        foreach($param as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if(!empty($update_sql)) $update_sql .= ", ";
                $update_sql .= "`{$key}`='{$value}'";
            }
        }

        if(in_array("update_date", $this->schema['columns'])){
            $update_sql .= ", `update_date` = now() ";
        }

        $sql = "UPDATE {$this->table} SET $update_sql WHERE 1 $search_sql";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());
        }

        $this->reset();

        return $param[$this->primary];
    }

    function delete($_param){

        $param = $this->escape($_param);

        if(!$param[$this->primary]) throw new \Exception("JlModel delete() : 고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        $sql = "DELETE FROM {$this->table} WHERE 1 $search_sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());
        }

        $this->reset();

        return $param[$this->primary];
    }

    function whereDelete(){
        if($this->sql == "") throw new \Exception("JlModel whereDelete() : 조건 삭제에 조건이 없습니다.");

        $sql = "DELETE FROM {$this->table} WHERE 1 $this->sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new \Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new \Exception(mysql_error());
        }

        $this->reset();

        return $param[$this->primary];
    }

    function getSql() {
        $sql = "SELECT * FROM {$this->table} WHERE 1 ".$this->sql;
        $sql .= $this->sql_order_by ? " ORDER BY ".$this->sql_order_by : "";
        return $sql;
    }

    function add_sql($query) {
        $this->sql .= "$query";
    }

    function order_by($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;
                    if($this->sql_order_by) ",";
                    $this->sql_order_by .= " {$key} {$value}";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new \Exception("JlModel order_by() : 컬럼명을 입력해주새요.");
            if($second == "") throw new \Exception("JlModel order_by() : 필터를 입력해주새요.");
            if(!in_array($second,array("DESC","ASC"))) throw new \Exception("JlModel order_by() : DESC , ASC 둘중 하나만 선택가능합니다.");
            if(in_array($first, $this->schema['columns'])){
                if($this->sql_order_by) ",";
                $this->sql_order_by .= " {$first} {$second}";
            }
        }
    }

    function group_start($type = "AND") {
        if($this->group_bool) return false;

        $this->group_bool = true;
        $this->sql .= " {$type} ( ";
    }

    function group_end() {
        if(!$this->group_bool) return false;

        $this->group_bool = false;
        $this->group_index = 0;
        $this->sql .= " ) ";
    }

    function between($column,$start,$end,$type = "AND") {
        if($column == "") throw new \Exception("JlModel between() : 컬럼명을 대입 해주새요.");
        if($start == "") throw new \Exception("JlModel between() : 시작시간을 대입 해주새요.");
        if($end == "") throw new \Exception("JlModel between() : 종료시간을 대입 해주새요.");

        if(strpos($start,":") === false) $start .= " 00:00:00";
        if(strpos($end,":") === false) $end .= " 23:59:59";

        if(in_array($column, $this->schema['columns'])){
            if($this->group_bool) {
                if(!$this->group_index) $this->group_index = 1;
                else $this->sql .= " {$type} ";
            }else {
                $this->sql .= " {$type} ";
            }

            $this->sql .= "{$column} BETWEEN '{$start}' AND '{$end}' ";
        }
    }

    function where($first,$second = "") {
        $equals = $this->not ? "!=" : "=";

        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " AND ";
                    }else {
                        $this->sql .= " AND ";
                    }

                    $this->sql .= "`{$key}` $equals '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new \Exception("JlModel where() : 컬럼명을 입력해주새요.");
            if($second == "") throw new \Exception("JlModel where() : 필터를 입력해주새요.");

            if(in_array($first, $this->schema['columns'])){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " AND ";
                }else {
                    $this->sql .= " AND ";
                }

                $this->sql .= "`{$first}` $equals '{$second}'";
            }
        }
    }

    function or_where($first,$second = "") {
        $equals = $this->not ? "!=" : "=";

        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " OR ";
                    }else {
                        $this->sql .= " OR ";
                    }

                    $this->sql .= "`{$key}` $equals '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new \Exception("JlModel or_where() : 컬럼명을 입력해주새요.");
            if($second == "") throw new \Exception("JlModel or_where() : 필터를 입력해주새요.");
            if(in_array($first, $this->schema['columns'])){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " OR ";
                }else {
                    $this->sql .= " OR ";
                }

                $this->sql .= "`{$first}` $equals '{$second}'";
            }
        }
    }

    function like($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;
                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " AND ";
                    }else {
                        $this->sql .= " AND ";
                    }

                    $this->sql .= "`{$key}` LIKE '%{$value}%'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new \Exception("JlModel like() : 컬럼명을 입력해주새요.");
            if($second == "") throw new \Exception("JlModel like() : 필터를 입력해주새요.");

            if(in_array($first, $this->schema['columns'])){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " AND ";
                }else {
                    $this->sql .= " AND ";
                }

                $this->sql .= "`{$first}` LIKE '%{$second}%'";
            }
        }
    }

    function or_like($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;
                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " OR ";
                    }else {
                        $this->sql .= " OR ";
                    }

                    $this->sql .= "`{$key}` LIKE '%{$value}%'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new \Exception("JlModel or_like() : 컬럼명을 입력해주새요.");
            if($second == "") throw new \Exception("JlModel or_like() : 필터를 입력해주새요.");

            if(in_array($first, $this->schema['columns'])) {
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " OR ";
                }else {
                    $this->sql .= " OR ";
                }

                $this->sql .= "`{$first}` LIKE '%{$second}%'";
            }
        }
    }






    function escape($_param) {
        $param = array();
        foreach($_param as $key => $value){
            if (is_array($value)) $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            if (is_object($value)) $value = json_encode($value, JSON_UNESCAPED_UNICODE);

            if($this->mysqli) {
                $param[$key] = mysqli_real_escape_string($this->connect, $value);
            }else {
                $param[$key] = mysql_real_escape_string($value);
            }

        }
        return $param;
    }
}
?>