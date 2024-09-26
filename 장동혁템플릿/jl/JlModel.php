<?php
namespace App\Libraries;
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
    public  $primary_type;
    public $autoincrement;

    private $sql = "";
    private $sql_order_by = "";
    private $group_bool = false;
    private $group_index = 0;

    private $join_sql = "";
    private $join_table = "";
    private $join_primary = "";
    private $group_by_sql_front = "";
    private $group_by_sql_back = "";

    function __construct($object = array()) {
        //부모 생성자
        parent::__construct();

        // mysql 버전 확인
        if(function_exists("mysqli_connect")) $this->mysqli = true;

        //connect전 필수 정보확인
        if(!$this->DB["hostname"]) $this->error("JlModel construct() : hostname를 입력해주세요.");
        $this->hostname = $this->DB["hostname"];
        if(!$this->DB["username"]) $this->error("JlModel construct() : username를 입력해주세요.");
        $this->username = $this->DB["username"];
        if(!$this->DB["password"]) $this->error("JlModel construct() : password를 입력해주세요.");
        $this->password = $this->DB["password"];
        if(!$this->DB["database"]) $this->error("JlModel construct(): database를 입력해주세요.");
        $this->database = $this->DB["database"];

        //DB Connection
        if($this->mysqli) {
            $connect = new \mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($connect->connect_errno) $this->error(mysqli_error($this->connect));
        }else {
            $connect = mysql_connect($this->hostname, $this->username, $this->password);
            if(!$connect) $this->error(2);
            mysql_select_db($this->database, $connect);
        }
        $this->connect = $connect;

        $this->schema = array(
            "columns" => array(),
            "tables" => array(),
            "join_columns" => array()
        );

        if(!$object["table"]) $this->error("JlModel construct() : 테이블을 지정해주세요.");
        $this->table =$object["table"];

        // 테이블 확인
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='{$this->database}'";
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_array($result)){
                array_push($this->schema['tables'], $row['TABLE_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());

            while($row = mysql_fetch_array($result)){
                array_push($this->schema['tables'], $row['TABLE_NAME']);
            }
        }


        if(!in_array($this->table, $this->schema['tables'])) $this->error("JlModel construct() : 테이블을 찾을수 없습니다.");

        // Primary Key 확인
        $primary = $this->getPrimary($this->table);
        $this->primary = $primary['COLUMN_NAME'];
        $this->primary_type = $primary['DATA_TYPE'];
        $this->autoincrement = $primary["EXTRA"] ? true : false;

        if(!$this->primary) $this->error("해당 테이블에 Primary 값이 존재하지않습니다.");
        if($this->primary_type == "int" && !$this->autoincrement) $this->error("Primary 타입이 int인데 autoincrement가 설정되어있지않습니다..");

        // 테이블 스키마 정보 조회
        $this->schema['columns'] = $this->getColumns($this->table);
    }

    function getPrimary($table) {
        $sql = "SELECT COLUMN_NAME, EXTRA,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->database}' AND TABLE_NAME = '{$table}' AND COLUMN_KEY = 'PRI';";
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect));

            if(!$row = mysqli_fetch_array($result)) $this->error("JlModel getPrimary($table) : row 값이 존재하지않습니다 Primary설정을 확인해주세요.");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());

            if(!$row = mysql_fetch_array($result)) $this->error("JlModel getPrimary($table) : row 값이 존재하지않습니다 Primary설정을 확인해주세요.");
        }

        return $row;
    }

    function getColumns($table) {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$table}' AND TABLE_SCHEMA='{$this->database}' ";
        $array = array();
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_array($result)){
                array_push($array, $row['COLUMN_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());

            while($row = mysql_fetch_array($result)){
                array_push($array, $row['COLUMN_NAME']);
            }
        }

        return $array;
    }

    function getSchema() {
        return $this->schema;
    }

    function reset() {
        $this->sql = "";
        $this->sql_order_by = "";
        $this->join_sql = "";
        $this->join_table = "";
        $this->join_primary = "";
        $this->group_by_sql_front = "";
        $this->group_by_sql_back = "";

        return $this;
    }

    function query($sql) {
        $array = array();

        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_array($result)){
                array_push($array, $row);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());

            while($row = mysql_fetch_array($result)){
                array_push($array, $row);
            }
        }

        return $array;
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
                if($key == $this->primary && $value == '') continue; // 10.2부터 int에 빈값이 허용안되기때문에 빈값일경우 패스
                if(!empty($columns)) $columns .= ", ";
                $columns .= "`{$key}`";

                if(!empty($values)) $values .= ", ";

                if($value == "now()") $values .= "{$value}";
                else $values .= "'{$value}'";

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
            if(!$result) $this->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());
        }

        //return $_id;
        if($this->mysqli)
            return mysqli_insert_id($this->connect);
        else
            return mysql_insert_id($this->connect);
    }

    function count($_param = array()){
        $reset = isset($_param['reset']) ? $_param['reset'] : true;
        // Summary Query
        $sql = $this->getSql(array("count" => true));

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect)."\n $sql");

            $total_count = mysqli_num_rows($result);

        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());

            $total_count = mysql_num_rows($result);

        }

        if($reset) {
            $this->reset();
        }

        return $total_count ? $total_count : 0;
    }

    function get($_param = array()) {
        $page = $_param['page'] ? $_param['page'] : 0;
        $limit = $_param['limit'] ? $_param['limit'] : 0;
        $reset = isset($_param['reset']) ? $_param['reset'] : true;
        $_param['source'] = $_param['source'] ? $_param['source'] : $this->table;

        if($_param['source'] != $this->table) {
            if(!$this->join_table) $this->error("JlModel get() : join() 부터 실행해주세요.");
            if(!in_array($_param['source'], $this->schema['tables'])) $this->error("JlModel get() : join 테이블을 찾을수 없습니다.");
        }

        // 페이징
        $skip  = ($page - 1) * $limit;

        // Data Query
        $sql = $this->getSql($_param);
        if($limit) $sql .= " LIMIT $skip, $limit";

        $object["data"] = array();
        $object["count"] = $this->count($_param);
        if($_param['sql']) $object["sql"] = $sql;

        $index = 1;

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect)."\n $sql");

            while($row = mysqli_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                $row["data_page_nor"] = $object['count'] - $index + 1 - (($page -1) * $limit);
                foreach ($row as $key => $value) {
                    // JSON인지 확인하고 디코딩 시도
                    $decoded_value = json_decode($value, true);

                    // JSON 디코딩이 성공했다면 값을 디코딩된 데이터로 변경
                    if (!is_null($decoded_value)) {
                        $row[$key] = $decoded_value;
                    }
                }
                array_push($object["data"], $row);
                $index++;
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                $row["data_page_no"] = ($page -1) * $limit + $index;
                $row["data_page_nor"] = $object['count'] - $index + 1 - (($page -1) * $limit);
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

        if($reset) {
            $this->reset();
        }

        return $object;
    }

    function update($_param){

        $param = $this->escape($_param);

        if(!isset($param[$this->primary])) $this->error("JlModel update() : 고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        foreach($param as $key => $value){
            if(in_array($key, $this->schema['columns'])){
                if(!empty($update_sql)) $update_sql .= ", ";

                if($value == "now()") $update_sql .= "`{$key}`={$value}";
                else $update_sql .= "`{$key}`='{$value}'";
            }
        }

        if(in_array("update_date", $this->schema['columns'])){
            $update_sql .= ", `update_date` = now() ";
        }

        $sql = "UPDATE {$this->table} SET $update_sql WHERE 1 $search_sql";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());
        }

        $this->reset();

        return $this;
    }

    function delete($_param){

        $param = $this->escape($_param);

        if(!isset($param[$this->primary])) $this->error("JlModel delete() : 고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        $sql = "DELETE FROM {$this->table} WHERE 1 $search_sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());
        }

        $this->reset();

        return $this;
    }

    function whereDelete(){
        if($this->sql == "") $this->error("JlModel whereDelete() : 조건 삭제에 조건이 없습니다.");

        $sql = "DELETE FROM {$this->table} WHERE 1 $this->sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->error(mysql_error());
        }

        $this->reset();

        return $param[$this->primary];
    }

    function getSql($_param = array()) {
        $source = $_param['source'] ? $_param['source'] : $this->table;
        $other = $source == $this->table ? $this->join_table : $this->table;
        $scope = $_param['count'] ? $source == $this->table ? $this->primary : $this->join_primary : "*";

        $select = "";

        if($_param['select']) {
            if($_param['select'] == "*") {
                $columns = $source == $this->table ? $this->schema['join_columns'] : $this->schema['columns'];
                foreach($columns as $column) {
                    $select .= ", {$other}.{$column} AS join_{$other}_{$column}";
                }
            }else {
                if(is_string($_param['select'])) $select .= ", ".$_param['select'];
                if(is_array($_param['select'])) {
                    foreach($_param['select'] as $d) {
                        $select .= ", $d";
                    }
                }
            }
        }

        $sql = "SELECT $source.$scope $select $this->group_by_sql_front FROM {$this->table} as $this->table $this->join_sql WHERE 1";
        $sql .= $this->sql;
        $sql .= $this->group_by_sql_back ? $this->group_by_sql_back : "";
        $sql .= $this->sql_order_by ? " ORDER BY $this->sql_order_by" : " ORDER BY $this->primary DESC";
        return $sql;
    }

    function addSql($query) {
        $this->sql .= "$query";
    }

    function orderBy($first,$second = "",$source="") {
        $source = $source ? $source : $this->table;
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if(!in_array($value,array("DESC","ASC"))) $this->error("JlModel orderBy() : DESC , ASC 둘중 하나만 선택가능합니다.");
                    if($this->sql_order_by) $this->sql_order_by .= ",";
                    $this->sql_order_by .= " {$source}.{$key} {$value}";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") $this->error("JlModel orderBy() : 컬럼명을 입력해주새요.");
            if($second == "") $this->error("JlModel orderBy() : 필터를 입력해주새요.");
            if(!in_array($first, $this->schema['columns'])) $this->error("JlModel orderBy() : 존재하지않는 컬럼입니다..");
            if(!in_array($second,array("DESC","ASC"))) $this->error("JlModel orderBy() : DESC , ASC 둘중 하나만 선택가능합니다.");

            if($this->sql_order_by) $this->sql_order_by .= ",";
            $this->sql_order_by .= " {$source}.{$first} {$second}";
        }

        return $this;
    }

    function join($table,$origin_key,$join_key) {
        if(!in_array($table, $this->schema['tables'])) $this->error("JlModel join() : $table 테이블을 찾을수 없습니다.");
        if(!in_array($origin_key, $this->schema['columns'])) $this->error("JlModel join() : Origin Key를 찾을 수 없습니다.");
        $this->schema['join_columns'] = $this->getColumns($table);
        if(!in_array($join_key, $this->schema['join_columns'])) $this->error("JlModel join() : Join Key를 찾을 수 없습니다.");
        $this->join_table = $table;
        $primary = $this->getPrimary($table);
        $this->join_primary = $primary['COLUMN_NAME'];

        $this->join_sql = " JOIN $table ON $this->table.$origin_key = $table.$join_key ";
    }

    function groupBy($group_key,$total_key,$as,$type = "COUNT") {
        if(!$this->join_table) $this->error("JlModel groupBy() : join()을 먼저 해주세요.");
        if(strpos($group_key,".") === false) $this->error("JlModel groupBy() : group_key의 형식이 잘못됐습니다. (table.column) 으로 진행해주세요.");
        if(strpos($total_key,".") === false) $this->error("JlModel groupBy() : total_key의 형식이 잘못됐습니다. (table.column) 으로 진행해주세요.");
        $groups = explode(".",$group_key);
        $totals = explode(".",$total_key);

        $group_columns = $groups[0] == $this->table ? $this->schema['columns'] : $this->schema['join_columns'];
        $total_columns = $totals[0] == $this->table ? $this->schema['columns'] : $this->schema['join_columns'];

        if(!in_array($groups[0], $this->schema['tables'])) $this->error("JlModel groupBy() : {$groups[0]} 테이블을 찾을수 없습니다.");
        if(!in_array($totals[0], $this->schema['tables'])) $this->error("JlModel groupBy() : {$totals[0]} 테이블을 찾을수 없습니다.");
        if(!in_array($groups[1], $group_columns)) $this->error("JlModel groupBy() : {$groups[0]}에서 {$groups[1]} 를 찾을 수 없습니다.");
        if(!in_array($totals[1], $total_columns)) $this->error("JlModel groupBy() : {$totals[0]}에서 {$totals[1]} 를 찾을 수 없습니다.");

        $this->group_by_sql_front = " , $type($total_key) AS $as ";
        $this->group_by_sql_back = " GROUP BY $group_key";
    }

    function groupStart($operator = "AND") {
        if($this->group_bool) return false;

        $this->group_bool = true;
        $this->sql .= " {$operator} ( ";

        return $this;
    }

    function groupEnd() {
        if(!$this->group_bool) return false;

        $this->group_bool = false;
        $this->group_index = 0;
        $this->sql .= " ) ";

        return $this;
    }

    function between($column,$start,$end,$operator = "AND",$source = "") {
        if($column == "") $this->error("JlModel between() : 컬럼명을 대입 해주새요.");
        if($start == "") $this->error("JlModel between() : 시작시간을 대입 해주새요.");
        if($end == "") $this->error("JlModel between() : 종료시간을 대입 해주새요.");

        if(strpos($start,":") === false) $start .= " 00:00:00";
        if(strpos($end,":") === false) $end .= " 23:59:59";

        if($source == "") {
            $columns = $this->schema['columns'];
            $source = $this->table;
        } else {
            if(!$this->join_table) $this->error("JlModel between() : join()을 먼저 해주세요.");
            $columns = $this->schema['join_columns'];
        }

        if(in_array($column, $columns)){
            if($this->group_bool) {
                if(!$this->group_index) $this->group_index = 1;
                else $this->sql .= " {$operator} ";
            }else {
                $this->sql .= " {$operator} ";
            }

            $this->sql .= "$source.{$column} BETWEEN '{$start}' AND '{$end}' ";
        }

        return $this;
    }

    function in($first,$second = "",$operator = "AND",$source = "") {
        if($source == "") {
            $columns = $this->schema['columns'];
            $source = $this->table;
        } else {
            if(!$this->join_table) $this->error("JlModel in() : join()을 먼저 해주세요.");
            $columns = $this->schema['join_columns'];
        }

        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $columns)){
                    if(!is_array($value)) $this->error("JlModel in() : 비교값이 배열이아닙니다.");
                    if(!count($value)) continue;

                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " $operator ";
                    }else {
                        $this->sql .= " $operator ";
                    }

                    $this->sql .= "$source.`{$key}` IN (";

                    $bool = false;
                    foreach($value as $v) {
                        if($bool) $this->sql .= ", ";
                        else $bool = true;

                        if(is_numeric($v)) $this->sql .= "$v";
                        else $this->sql .= "'$v'";
                    }

                    $this->sql .= ")";

                }
            }
        }

        if(is_string($first)) {
            if($first == "") $this->error("JlModel in() : 컬럼명을 입력해주새요.");
            if($second == "") $this->error("JlModel in() : 필터를 입력해주새요.");
            if(!is_array($second)) $this->error("JlModel in() : 비교값이 배열이 아닙니다.");

            if(in_array($first, $columns) && count($second)){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " $operator ";
                }else {
                    $this->sql .= " $operator ";
                }

                $this->sql .= "$source.`{$first}` IN (";

                $bool = false;
                foreach($second as $v) {
                    if($bool) $this->sql .= ", ";
                    else $bool = true;

                    if(is_numeric($v)) $this->sql .= "$v";
                    else $this->sql .= "'$v'";

                }

                $this->sql .= ")";
            }
        }

        return $this;
    }

    function where($first,$second = "",$operator = "AND",$source = "") {
        if($source == "") {
            $columns = $this->schema['columns'];
            $source = $this->table;
        } else {
            if(!$this->join_table) $this->error("JlModel where() : join()을 먼저 해주세요.");
            $columns = $this->schema['join_columns'];
        }

        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $columns)){
                    if($value == "") continue;

                    if($value == "jl_null") $value = "";

                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " $operator ";
                    }else {
                        $this->sql .= " $operator ";
                    }

                    $this->sql .= "$source.`{$key}` = '{$value}'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") $this->error("JlModel where() : 컬럼명을 입력해주새요.");
            if($second == "") $this->error("JlModel where() : 필터를 입력해주새요.");
            if($second == "jl_null") $second = "";

            if(in_array($first, $columns)){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " $operator ";
                }else {
                    $this->sql .= " $operator ";
                }

                $this->sql .= "$source.`{$first}` = '{$second}'";
            }
        }

        return $this;
    }

    function like($first,$second = "",$operator = "AND", $source = "") {
        if($source == "") {
            $columns = $this->schema['columns'];
            $source = $this->table;
        } else {
            if(!$this->join_table) $this->error("JlModel like() : join()을 먼저 해주세요.");
            $columns = $this->schema['join_columns'];
        }

        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $columns)){
                    if($value == "") continue;

                    if($value == "jl_null") $value = "";

                    if($this->group_bool) {
                        if(!$this->group_index) $this->group_index = 1;
                        else $this->sql .= " $operator ";
                    }else {
                        $this->sql .= " $operator ";
                    }

                    $this->sql .= "$source.`{$key}` LIKE '%{$value}%'";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") $this->error("JlModel like() : 컬럼명을 입력해주새요.");
            if($second == "") $this->error("JlModel like() : 필터를 입력해주새요.");
            if($second == "jl_null") $second = "";

            if(in_array($first, $columns)){
                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " $operator ";
                }else {
                    $this->sql .= " $operator ";
                }

                $this->sql .= "$source.`{$first}` LIKE '%{$second}%'";
            }
        }

        return $this;
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