<?php
class Model {
    private $schema;
    private $db_name;
    private $table;
    private $link;
    private $mysqli = false;
    public  $primary;
    private $autoincrement;
    private $empty;

    private $sql = "";
    private $sql_order_by = "";

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
            $result = mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));
        }else {
            $result = @mysql_query($sql, $this->link);
            if(!$result) throw new Exception(mysql_error());
        }

        //return $_id;
        if($this->mysqli)
            return mysqli_insert_id($this->link);
        else
            return mysql_insert_id($this->link);
    }

    function count(){

        // Summary Query
        $sql = "SELECT $this->primary FROM {$this->table} WHERE 1 ".$this->sql;

        if($this->mysqli) {
            $result = mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));

            $total_count = mysqli_num_rows($result);

        }else {
            $result = @mysql_query($sql, $this->link);
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
        $sql .= $this->sql_order_by ? $this->sql.$this->sql_order_by : $this->sql;
        if($limit) $sql .= " LIMIT $skip, $limit";

        $object["data"] = array();
        $object["count"] = $this->count();

        $index = 1;

        if($this->mysqli) {
            $result = mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));

            while($row = mysqli_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                array_push($object["data"], $row);
                $index++;
            }
        }else {
            $result = @mysql_query($sql, $this->link);
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

        if($param[$this->primary]) throw new Exception("고유 키 값이 존재하지 않습니다.");

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
            $result = mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));
        }else {
            $result = @mysql_query($sql, $this->link);
            if(!$result) throw new Exception(mysql_error());
        }


        return $param[$this->primary];
    }

    function delete($_param){

        $param = $this->escape($_param);

        if($param[$this->primary]) throw new Exception("고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        $sql = "DELETE FROM {$this->table} WHERE 1 $search_sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));
        }else {
            $result = @mysql_query($sql, $this->link);
            if(!$result) throw new Exception(mysql_error());
        }

        return $param[$this->primary];
    }

    function get_sql($order_by = false) {
        $sql = "SELECT * FROM {$this->table} WHERE 1 ".$this->sql;
        if($order_by) {
            $sql .= " ORDER BY ".$this->sql_order_by;
        }
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
                    $this->sql .= " {$key} {$value}";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");
            if($this->sql_order_by) ",";
            $this->sql .= " {$first} {$second}";
        }
    }



    function where($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    $this->sql .= " AND `{$key}` = '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            $this->sql .= " AND `{$first}` = '{$second}'";
        }
    }

    function or_where($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    $this->sql .= " OR `{$key}` = '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            $this->sql .= " OR `{$first}` = '{$second}'";
        }
    }

    function and_or_where($array) {
        if(is_array($array) && count($array) >= 2) {
            $param = $this->escape($array);
            $this->sql .= " AND (";
            $bool = false;
            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;
                    if($bool) $this->sql .= " OR ";
                    $this->sql .= " `{$key}` = '{$value}'";
                    $bool = true;
                }
            }

            $this->sql .= ")";
        }else {
            throw new Exception("and_or_where은 2개이상의 길이의 연관 배열만 가능합니다.");
        }
    }

    function like($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    $this->sql .= " AND `{$key}` LIKE '%{$value}%'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            $this->sql .= " AND `{$first}` LIKE '%{$second}%'";
        }
    }

    function or_like($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    $this->sql .= " OR `{$key}` LIKE '%{$value}%'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            $this->sql .= " OR `{$first}` LIKE '%{$second}%'";
        }
    }




    function __construct($object = array()) {
        if(function_exists("mysqli_query") && G5_MYSQLI_USE) $this->mysqli = true;
        global $g5;
        $this->db_name = G5_MYSQL_DB;
        $this->link = $g5['connect_db'];
        $this->schema = array(
            "columns" => array()
        );

        if(!$object["table"]) throw new Exception("테이블명이 없습니다.");
        $this->table =$object["table"];
        $this->primary = $object["primary"] ? $object["primary"] : "idx";
        $this->autoincrement = $object["autoincrement"] ? $object["autoincrement"] : true;
        $this->empty = $object["empty"] ? $object["empty"] : false;

        // 테이블 스키마 정보 조회
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME=N'{$this->table}' AND TABLE_SCHEMA='{$this->db_name}' ";

        if($this->mysqli) {
            $result = @mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));

            while($row = mysqli_fetch_array($result)){
                array_push($this->schema['columns'], $row['COLUMN_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->link);
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
                $param[$key] = mysqli_real_escape_string($this->link, $value);
            }else {
                $param[$key] = mysql_real_escape_string($value);
            }

        }
        return $param;
    }
}
?>