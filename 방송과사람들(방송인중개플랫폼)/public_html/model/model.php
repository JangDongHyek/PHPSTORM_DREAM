<?php
class Model {
    private $schema;
    private $db_name;
    private $table;
    private $mysqli = false;
    private $link;
    private $primary;
    private $autoincrement;

    function __construct($table,$primary = "_idx",$autoincrement = true) {
        if(function_exists("mysqli_query") && G5_MYSQLI_USE) $this->mysqli = true;
        global $g5;
        $this->db_name = G5_MYSQL_DB;
        $this->table =$table;
        $this->link = $g5['connect_db'];
        $this->schema = array(
            "columns" => array()
        );
        $this->primary = $primary;
        $this->autoincrement = $autoincrement;

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

    function count($_param){

        $param = $this->escape($_param);

        // 검색조건
        $search_sql = "";
        foreach($param as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                $search_sql .= " AND `{$key}`='{$value}'";
            }
        }

        // Summary Query
        $sql = "SELECT $this->primary FROM {$this->table} WHERE 1 $search_sql ";

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

    // 복수 데이터 조회
    function gets($_param){

        $param = $this->escape($_param);

        // 검색조건
        $search_sql = "";
        foreach($param as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                $search_sql .= " AND `{$key}`='{$value}'";
            }
        }

        // 정렬조건
        $order_sql = "";
        if(in_array("c_date", $this->schema['columns'])){
            $order_sql = "ORDER BY c_date desc ";
        }

        // 페이징
        $page  = $param['page']  ? $param['page']  : 1;
        $limit = $param['limit'] ? $param['limit'] : 20;
        $skip  = $param['skip']  ? $param['skip']  : ($page - 1) * $limit;

        // Data Query
        $sql = "SELECT * FROM {$this->table} WHERE 1 $search_sql $order_sql LIMIT $skip, $limit";

        $data["datas"] = array();
        $data["count"] = $this->count($param);
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

    // 단수 데이터 조회
    function get($_param = array()){
        $gets = $this->gets($_param)["datas"];
        return count($gets) ? $gets[0] : null;
    }

    // 데이터 삽입
    function post($_param){

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
        if(in_array("c_date", $this->schema['columns'])){
            $columns .= ", `c_date`";
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

    // 데이터 수정
    function put($_param){

        $param = $this->escape($_param);

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        foreach($param as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if(!empty($update_sql)) $update_sql .= ", ";
                $update_sql .= "`{$key}`='{$value}'";
            }
        }

        if(in_array("u_date", $this->schema['columns'])){
            $update_sql .= ", `u_date` = now() ";
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

    // 데이터 삭제
    function delete($_param){

        $param = $this->escape($_param);

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
}
?>