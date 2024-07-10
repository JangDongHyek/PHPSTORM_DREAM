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
    private $order_by;

    // 복수 데이터 조회
    function get(){

        // 검색조건
        $search_sql = "";

        //wheres
        foreach($this->wheres as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if($this->empty && $value == "") continue;

                $search_sql .= " AND `{$key}` = '{$value}'";
            }
        }

        //likes
        foreach($this->likes as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if($this->empty && $value == "") continue;

                $search_sql .= " AND `{$key}` LIKE '{%$value%}'";
            }
        }

        //or_wheres
        $bool = true;
        foreach($this->or_wheres as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if($this->empty && $value == "") continue;

                if($bool) $search_sql .= " AND ( ";
                $search_sql .= " `{$key}` = '{$value}'";
            }
        }



        if($object["add_query"]) $search_sql .= $object["add_query"];

        // 정렬조건
        $order_sql = "";
        if(in_array($object["order_by"], $this->schema['columns'])){
            $order_sql = "ORDER BY {$object['order_by']} {$object['sort']} ";
        }

        // 페이징
        $page  = $param['page']  ? $param['page']  : 1;
        $limit = $param['limit'] ? $param['limit'] : 20;
        $skip  = $param['skip']  ? $param['skip']  : ($page - 1) * $limit;

        // Data Query
        if($object["all_search"]) {
            $sql = "SELECT * FROM {$this->table} WHERE 1 $search_sql $order_sql";
        }else {
            $sql = "SELECT * FROM {$this->table} WHERE 1 $search_sql $order_sql LIMIT $skip, $limit";
        }

        $data["datas"] = array();
        $data["count"] = $this->count($param,$object);
        $data["pages"] = ceil($data["count"] / $limit);

        $index = 1;

        if($this->mysqli) {
            $result = mysqli_query($this->link, $sql);
            if(!$result) throw new Exception(mysqli_error($this->link));

            while($row = mysqli_fetch_assoc($result)){
                $row["index"] = ($page -1) * $limit + $index;
                array_push($data["datas"], $row);
                $index++;
            }
        }else {
            $result = @mysql_query($sql, $this->link);
            if(!$result) throw new Exception(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                $row["index"] = ($page -1) * $limit + $index;
                array_push($data["datas"], $row);
                $index++;
            }
        }


        return $data;
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
            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    $this->sql .= " OR `{$key}` = '{$value}'";
                }
            }
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

                    $this->or_where[$key] = $value;
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            $this->or_where[$first] = $second;
        }
    }

    function or_like($first,$second = "") {
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if($this->empty && $value == "") continue;

                    $this->like[$key] = $value;
                }
            }
        }

        if(is_string($first)) {
            if($first == "") throw new Exception("컬럼명을 입력해주새요.");
            if($second == "") throw new Exception("필터를 입력해주새요.");

            $this->like[$first] = $second;
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