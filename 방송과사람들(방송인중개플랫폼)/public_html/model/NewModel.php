<?php
class Model {
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
    private $empty;

    private $sql = "";
    private $sql_order_by = "";
    private $group_bool = false;
    private $group_index = 0;

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
            if(!$result) throw new Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());
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
            if(!$result) throw new Exception(mysqli_error($this->connect));

            $total_count = mysqli_num_rows($result);

        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());

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
            if(!$result) throw new Exception(mysqli_error($this->connect));

            while($row = mysqli_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                array_push($object["data"], $row);
                $index++;
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                array_push($object["data"], $row);
                $index++;
            }
        }


        return $object;
    }

    function update($_param){

        $param = $this->escape($_param);

        if(!$param[$this->primary]) throw new Exception("고유 키 값이 존재하지 않습니다.");

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
            if(!$result) throw new Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());
        }


        return $param[$this->primary];
    }

    function delete($_param){

        $param = $this->escape($_param);

        if(!$param[$this->primary]) throw new Exception("고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        $sql = "DELETE FROM {$this->table} WHERE 1 $search_sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());
        }

        return $param[$this->primary];
    }

    function sqlDelete($_param){

        $param = $this->escape($_param);

        if($this->sql == "") throw new Exception("조건 삭제에 조건이 없습니다.");

        $sql = "DELETE FROM {$this->table} WHERE 1 $this->sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) throw new Exception(mysqli_error($this->connect));
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());
        }

        return $param[$this->primary];
    }

    function get_sql() {
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
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");
            if(!in_array($second,array("DESC","ASC"))) throw new Exception("DESC , ASC 둘중 하나만 선택가능합니다.");
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
        if($column == "") throw new Exception("컬럼명을 대입 해주새요.");
        if($start == "") throw new Exception("시작시간을 대입 해주새요.");
        if($end == "") throw new Exception("종료시간을 대입 해주새요.");

        if(in_array($column, $this->schema['columns'])){
            if($this->group_bool) {
                if(!$this->group_index) $this->group_index = 1;
                else $this->sql .= " {$type} ";
            }else {
                $this->sql .= " {$type} ";
            }

            $this->sql .= "{$column} BETWEEN `{$start}` AND `{$end}` ";
        }
    }

    function where($first,$second = "") {
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

                    $this->sql .= "`{$key}` = '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            if(in_array($first, $this->schema['columns'])){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " AND ";
                }else {
                    $this->sql .= " AND ";
                }

                $this->sql .= "`{$first}` = '{$second}'";
            }
        }
    }

    function or_where($first,$second = "") {
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

                    $this->sql .= "`{$key}` = '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");
            if(in_array($first, $this->schema['columns'])){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " OR ";
                }else {
                    $this->sql .= " OR ";
                }

                $this->sql .= "`{$first}` = '{$second}'";
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
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            if(in_array($first, $this->schema['columns'])){
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
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

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




    function __construct($object = array()) {
        // mysql 버전 확인
        if(function_exists("mysqli_connect")) $this->mysqli = true;

        //connect전 필수 정보확인
        if(!$object["hostname"]) throw new Exception("hostname를 입력해주세요.");
        $this->hostname = $object["hostname"];
        if(!$object["username"]) throw new Exception("username를 입력해주세요.");
        $this->username = $object["username"];
        if(!$object["password"]) throw new Exception("password를 입력해주세요.");
        $this->password = $object["password"];
        if(!$object["database"]) throw new Exception("database를 입력해주세요.");
        $this->database = $object["database"];

        //DB Connection
        if($this->mysqli) {
            $connect = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($connect->connect_errno) throw new Exception($connect->connect_error);
        }else {
            $connect = mysql_connect($this->hostname, $this->username, $this->password);
            if(!$connect) throw new Exception(mysql_error());
            mysql_select_db($this->database, $connect);
        }
        $this->connect = $connect;

        $this->schema = array(
            "columns" => array()
        );

        if(!$object["table"]) throw new Exception("테이블명이 없습니다.");
        $this->table =$object["table"];
        $this->primary = $object["primary"] ? $object["primary"] : "idx";
        $this->autoincrement = $object["autoincrement"] ? $object["autoincrement"] : true;
        $this->empty = $object["empty"] ? $object["empty"] : false;

        // 테이블 스키마 정보 조회
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME=N'{$this->table}' AND TABLE_SCHEMA='{$this->database}' ";

        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) throw new Exception(mysqli_error($this->connect));

            while($row = mysqli_fetch_array($result)){
                array_push($this->schema['columns'], $row['COLUMN_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) throw new Exception(mysql_error());

            while($row = mysql_fetch_array($result)){
                array_push($this->schema['columns'], $row['COLUMN_NAME']);
            }
        }
    }

    function escape($_param) {
        $param = array();
        foreach($_param as $key => $value){
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