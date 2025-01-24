<?php
//namespace App\Libraries;
require_once("JlDefine.php");
require_once("Jl.php");
class JlModel{
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

    private $jl;

    function __construct($object = array()) {
        $this->jl = new Jl(false);
        // 매개변수가 문자열이면 테이블속성만 넣었다고 가정
        if (is_string($object)) {
            $object = array("table" =>$object);
        }

        // mysql 버전 확인
        if(function_exists("mysqli_connect")) $this->mysqli = true;

        //connect전 필수 정보확인
        if(!JL_HOSTNAME) $this->jl->error("JlModel construct() : hostname를 입력해주세요.");
        $this->hostname = JL_HOSTNAME;
        if(!JL_USERNAME || JL_USERNAME == "exam") $this->jl->error("JlModel construct() : username를 입력해주세요.");
        $this->username = JL_USERNAME;
        if(!JL_PASSWORD || JL_PASSWORD == "pass") $this->jl->error("JlModel construct() : password를 입력해주세요.");
        $this->password = JL_PASSWORD;
        if(!JL_DATABASE || JL_DATABASE == "exam") $this->jl->error("JlModel construct(): database를 입력해주세요.");
        $this->database = JL_DATABASE;

        //DB Connection
        if($this->mysqli) {
            $connect = new \mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($connect->connect_errno) $this->jl->error(mysqli_error($this->connect));
        }else {
            $connect = mysql_connect($this->hostname, $this->username, $this->password);
            if(!$connect) $this->jl->error(2);
            mysql_select_db($this->database, $connect);
        }
        $this->connect = $connect;

        $this->schema = array(
            "columns" => array(),
            "tables" => array(),
            "join_columns" => array()
        );

        if(!$object["table"]) $this->jl->error("JlModel construct() : 테이블을 지정해주세요.");
        $this->table =$object["table"];

        // 테이블 확인
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='{$this->database}'";
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_assoc($result)){
                array_push($this->schema['tables'], $row['TABLE_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                array_push($this->schema['tables'], $row['TABLE_NAME']);
            }
        }

        if (isset($object['create']) && $object['create'] === true) {
            if(!$this->isTable()) $this->createTable($object['columns']);
        }else {
            if(!$this->isTable()) $this->jl->error("JlModel construct() : 테이블을 찾을수 없습니다.");
        }

        // Primary Key 확인
        $primary = $this->getPrimary($this->table);
        $this->primary = $primary['COLUMN_NAME'];
        $this->primary_type = $primary['DATA_TYPE'];
        $this->autoincrement = $primary["EXTRA"] ? true : false;

        if(!$this->primary) $this->jl->error("해당 테이블에 Primary 값이 존재하지않습니다.");
        if($this->primary_type == "int" && !$this->autoincrement) $this->jl->error("Primary 타입이 int인데 autoincrement가 설정되어있지않습니다..");

        // 테이블 스키마 정보 조회
        $this->schema['columns'] = $this->getColumns($this->table);
        $this->schema['columns_info'] = $this->getColumnsInfo($this->table);

    }

    function isTable() {
        return in_array($this->table,$this->schema['tables']);
    }

    function getPrimary($table) {
        $sql = "SELECT COLUMN_NAME, EXTRA,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->database}' AND TABLE_NAME = '{$table}' AND COLUMN_KEY = 'PRI';";
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect));

            if(!$row = mysqli_fetch_assoc($result)) $this->jl->error("JlModel getPrimary($table) : Primary 값이 존재하지않습니다 Primary설정을 확인해주세요.");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            if(!$row = mysql_fetch_assoc($result)) $this->jl->error("JlModel getPrimary($table) : Primary 값이 존재하지않습니다 Primary설정을 확인해주세요.");
        }

        return $row;
    }

    function getColumnsInfo($table) {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$table}' AND TABLE_SCHEMA='{$this->database}' ";
        $array = array();
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_assoc($result)){
                $array[$row['COLUMN_NAME']] = $row;
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                $array[$row['COLUMN_NAME']] = $row;
            }
        }

        return $array;
    }

    function getColumns($table) {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$table}' AND TABLE_SCHEMA='{$this->database}' ";
        $array = array();
        if($this->mysqli) {
            $result = @mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_assoc($result)){
                array_push($array, $row['COLUMN_NAME']);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                array_push($array, $row['COLUMN_NAME']);
            }
        }

        return $array;
    }



    function setFilter($obj) {
        if($obj['primary']) $this->where($this->primary,$obj['primary']);
        if($obj['order_by_desc']) {
            if($this->jl->isJson($obj['order_by_desc'])) {
                $orders = $this->jsonDecode($obj['order_by_desc']);
                foreach ($orders as $order) {
                    $this->orderBy($order,"DESC");
                }
            }else {
                $this->orderBy($obj['order_by_desc'],"DESC");
            }
        }

        if($obj['order_by_asc']) {
            if($this->jl->isJson($obj['order_by_asc'])) {
                $orders = $this->jsonDecode($obj['order_by_asc']);
                foreach ($orders as $order) {
                    $this->orderBy($order,"ASC");
                }
            }else {
                $this->orderBy($obj['order_by_asc'],"ASC");
            }
        }


        if(isset($obj['where'])) {
            $arrays = $this->jsonDecode($obj['where']);
            foreach($arrays as $array) {
                $item = $this->jsonDecode($array);
                $operator = (isset($item['operator']) && trim($item['operator']) !== '') ? $item['operator'] : 'AND';
                $source = isset($item['source']) ? $item['source'] : '';

                if (isset($item['key']) && strpos($item['key'], '.') !== false) {
                    $keyParts = explode('.', $item['key'], 2);
                    $source = $keyParts[0];
                    $item['key'] = $keyParts[1];
                }

                if($item['value']) $this->where($item['key'],$item['value'],$operator,$source);
            }
        }

        if(isset($obj['like'])) {
            $arrays = $this->jsonDecode($obj['like']);
            foreach($arrays as $array) {
                $item = $this->jsonDecode($array);
                $operator = (isset($item['operator']) && trim($item['operator']) !== '') ? $item['operator'] : 'AND';
                $source = isset($item['source']) ? $item['source'] : '';

                if (isset($item['key']) && strpos($item['key'], '.') !== false) {
                    $keyParts = explode('.', $item['key'], 2);
                    $source = $keyParts[0];
                    $item['key'] = $keyParts[1];
                }

                if($item['value']) $this->like($item['key'],$item['value'],$operator,$source);
            }
        }

        if(isset($obj['between'])) {
            $arrays = $this->jsonDecode($obj['between']);
            foreach($arrays as $array) {
                $item = $this->jsonDecode($array);
                $operator = (isset($item['operator']) && trim($item['operator']) !== '') ? $item['operator'] : 'AND';
                $source = isset($item['source']) ? $item['source'] : '';

                if (isset($item['key']) && strpos($item['key'], '.') !== false) {
                    $keyParts = explode('.', $item['key'], 2);
                    $source = $keyParts[0];
                    $item['key'] = $keyParts[1];
                }

                if($item['start'] && $item['end']) $this->between($item['key'],$item['start'],$item['end'],$operator,$source);
            }
        }

        if(isset($obj['in'])) {
            $arrays = $this->jsonDecode($obj['in']);
            foreach($arrays as $array) {
                $item = $this->jsonDecode($array);
                $operator = (isset($item['operator']) && trim($item['operator']) !== '') ? $item['operator'] : 'AND';
                $source = isset($item['source']) ? $item['source'] : '';

                if (isset($item['key']) && strpos($item['key'], '.') !== false) {
                    $keyParts = explode('.', $item['key'], 2);
                    $source = $keyParts[0];
                    $item['key'] = $keyParts[1];
                }

                $values = $this->jsonDecode($item['array']);
                if(count($values)) $this->in($item['key'],$values,$operator,$source);
            }
        }

        if(isset($obj['group_where'])) {
            $arrays = $this->jsonDecode($obj['group_where']);
            $this->groupStart();

            foreach($arrays as $array) {
                $item = $this->jsonDecode($array);
                $operator = (isset($item['operator']) && trim($item['operator']) !== '') ? $item['operator'] : 'OR';
                $source = isset($item['source']) ? $item['source'] : '';

                if (isset($item['key']) && strpos($item['key'], '.') !== false) {
                    $keyParts = explode('.', $item['key'], 2);
                    $source = $keyParts[0];
                    $item['key'] = $keyParts[1];
                }

                $this->where($item['key'],$item['value'],$operator,$source);
            }

            $this->groupEnd();
        }

        if(isset($obj['group_like'])) {
            $arrays = $this->jsonDecode($obj['group_like']);
            $this->groupStart();

            foreach($arrays as $array) {
                $item = $this->jsonDecode($array);
                $operator = (isset($item['operator']) && trim($item['operator']) !== '') ? $item['operator'] : 'OR';
                $source = isset($item['source']) ? $item['source'] : '';

                if (isset($item['key']) && strpos($item['key'], '.') !== false) {
                    $keyParts = explode('.', $item['key'], 2);
                    $source = $keyParts[0];
                    $item['key'] = $keyParts[1];
                }

                $this->like($item['key'],$item['value'],$operator,$source);
            }

            $this->groupEnd();
        }

        if(isset($obj['add_query'])) {
            $this->addSql($obj['add_query']);
        }
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
            if(!$result) $this->jl->error(mysqli_error($this->connect));

            while($row = mysqli_fetch_assoc($result)){
                array_push($array, $row);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
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

        foreach($this->schema['columns'] as $column) {
            $info = $this->schema['columns_info'][$column];
            $value = $param[$column];
            if($column == $this->primary && $value == '') continue; // 10.2부터 int에 빈값이 허용안되기때문에 빈값일경우 패스

            // 컬럼의 데이터타입이 datetime 인데 널값이 허용이면 넘기고 아니면 기본값을 넣어서 쿼리작성
            if($info['DATA_TYPE'] == "datetime") {
                if($value == '') {
                    if($info['IS_NULLABLE'] == "NO") $value = '0000-00-00 00:00:00';
                    else continue;
                }
            }
            if($info['DATA_TYPE'] == "date") {
                if($value == '') {
                    if($info['IS_NULLABLE'] == "NO") $value = '0000-00-00';
                    else continue;
                }
            }

            if($column == 'insert_date') $value = 'now()';
            if($column == 'wr_datetime') $value = 'now()';

            if(!empty($columns)) $columns .= ", ";
            $columns .= "`{$column}`";

            if(!empty($values)) $values .= ", ";

            if($value == "now()") $values .= "{$value}";
            else $values .= "'{$value}'";
        }

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());
        }

        if($param[$this->primary]) return $param[$this->primary];

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
            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");

            $total_count = mysqli_num_rows($result);

        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            $total_count = mysql_num_rows($result);

        }

        if($reset) {
            $this->reset();
        }

        return $total_count ? $total_count : 0;
    }

    function distinct($_param){
        if(!isset($_param['column'])) $this->jl->error("JlModel distinct() : column 값이 없습니다..");
        // Summary Query

        if($this->jl->isJson($_param['column'])) {
            $_param['column'] = $this->jsonDecode($_param['column']);
        }

        $sql = $this->getSql(array("distinct" => true, "column" => $_param['column']));

        $data = array();

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);

            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");

            while($row = mysqli_fetch_assoc($result)){
                array_push($data, $row);
            }
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                array_push($data, $row);
            }
        }

        return array("data" => $data,"sql" => $sql);
    }

    function get($_param = array()) {
        $page = $_param['page'] ? $_param['page'] : 0;
        $limit = $_param['limit'] ? $_param['limit'] : 0;
        $reset = isset($_param['reset']) ? $_param['reset'] : true;
        $_param['source'] = $_param['source'] ? $_param['source'] : $this->table;

        if($_param['source'] != $this->table) {
            if(!$this->join_table) $this->jl->error("JlModel get() : join() 부터 실행해주세요.");
            if(!in_array($_param['source'], $this->schema['tables'])) $this->jl->error("JlModel get() : join 테이블을 찾을수 없습니다.");
        }

        // 페이징
        $skip  = ($page - 1) * $limit;

        // Data Query
        $sql = $this->getSql($_param);
        if($limit) $sql .= " LIMIT $skip, $limit";

        $object["data"] = array();
        $object["count"] = $this->count($_param);
        $object['total_page'] = $limit ? ceil($object["count"] / $limit) : 0;
        if($_param['sql']) $object["sql"] = $sql;

        $index = 1;

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");

            while($row = mysqli_fetch_assoc($result)){
                $row["jl_no"] = ($page -1) * $limit + $index;
                $row["jl_no_reverse"] = $object['count'] - $index + 1 - (($page -1) * $limit);
                $row['primary'] = $row[$this->primary];
                foreach ($row as $key => $value) {
                    if($this->primary == $key) continue;
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
            if(!$result) $this->jl->error(mysql_error());

            while($row = mysql_fetch_assoc($result)){
                $row["jl_no"] = ($page -1) * $limit + $index;
                $row["jl_no_reverse"] = $object['count'] - $index + 1 - (($page -1) * $limit);
                $row['primary'] = $row[$this->primary];
                foreach ($row as $key => $value) {
                    if($this->primary == $key) continue;
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

    /*
    _param에 있는 데이터중 해당 테이블의 primary에 해당하는 데이터를 key == column 이 맞는 컬럼을 수정하는 함수
    key == column 일경우 value의 값으로 바뀜
    */
    function update($_param){
        $param = $this->escape($_param);

        if($param['primary']) $param[$this->primary] = $param['primary'];

        if(!isset($param[$this->primary])) $this->jl->error("JlModel update() : 고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        foreach($param as $key => $value){
            if($key == "update_date") continue;
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
            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());
        }

        $this->reset();

        return $this;
    }

    /*
    _param에 있는 데이터중 해당 테이블의 primary가 있으면 해당 기준으로 데이터 삭제하는 함수
    */
    function delete($_param){

        $param = $this->escape($_param);

        if($param['primary']) $param[$this->primary] = $param['primary'];

        if(!isset($param[$this->primary])) $this->jl->error("JlModel delete() : 고유 키 값이 존재하지 않습니다.");

        $search_sql = " AND $this->primary='{$param[$this->primary]}' ";

        $sql = "DELETE FROM {$this->table} WHERE 1 $search_sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());
        }

        $this->reset();

        return $this;
    }

    /*
    where() 등록된 데이터를 삭제하는 함수
     */
    function whereDelete(){
        if($this->sql == "") $this->jl->error("JlModel whereDelete() : 조건 삭제에 조건이 없습니다.");

        $sql = "DELETE FROM {$this->table} WHERE 1 $this->sql ";

        if($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if(!$result) $this->jl->error(mysqli_error($this->connect)."\n $sql");
        }else {
            $result = @mysql_query($sql, $this->connect);
            if(!$result) $this->jl->error(mysql_error());
        }

        $this->reset();

        return $param[$this->primary];
    }

    /*
    select 관련 쿼리를 _param값 기준으로 반환하는 함수
    _param
        source(String)($this->table) : 조회하는 테이블 설정한다 join 후 사용해야함
        select(String)(Null) : 조인 되어있는 다른 테이블의 컬럼을 조회할때 쓰는 값 *을 하면 다른테이블명_컬럼명 으로 모든 컬럼이 조회된다
        count(Boolean)(false) : 카운트 쿼리로 인식해 *말고 프라이마리 키값만 조회 false : *
        distinct(Boolean)(false) : true distinct 사용함
        column(String || Array)(null) : distinct 사용할때 쓰는 필드 추가된 컬럼만큼 distinct 해서 반환
     */
    function getSql($_param = array()) {
        $source = $_param['source'] ? $_param['source'] : $this->table;
        $other = $source == $this->table ? $this->join_table : $this->table;
        $scope = $_param['count'] ? $source == $this->table ? $this->primary : $this->join_primary : "*";

        $distinct = "";
        $select = "";

        if($_param['distinct']) {
            if (is_string($_param['column'])) {
                $scope = $_param['column'];
            }

            if (is_array($_param['column'])) {
                $scope = "";
                foreach($_param['column'] as $d) {
                    if($scope != "") $scope .= ", ".$source.".";
                    $scope .= $d;
                }
            }
            $distinct = "distinct";
        }

        if($_param['select']) {
            if($_param['select'] == "*") {
                $columns = $source == $this->table ? $this->schema['join_columns'] : $this->schema['columns'];
                foreach($columns as $column) {
                    $select .= ", {$other}.{$column} AS {$other}_{$column}";
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

        $sql = "SELECT $distinct $source.$scope $select $this->group_by_sql_front FROM {$this->table} as $this->table $this->join_sql WHERE 1";
        $sql .= $this->sql;
        $sql .= $this->group_by_sql_back ? $this->group_by_sql_back : "";
        $sql .= $this->sql_order_by ? " ORDER BY $this->sql_order_by" : " ORDER BY $this->primary DESC";
        return $sql;
    }

    /*
    등록되어있는 sql에 강제로 구문을 추가하는 함수
     */
    function addSql($query) {
        $this->sql .= "$query";
        return $this;
    }
    // 함수명 변경 및 버전 관리를 위해 위에랑 똑같이 진행
    function addWhere($query) {
        $this->sql .= "$query";
        return $this;
    }

    function orderBy($first,$second = "",$source="") {
        $source = $source ? $source : $this->table;
        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $this->schema['columns'])){
                    if(!in_array($value,array("DESC","ASC"))) $this->jl->error("JlModel orderBy() : DESC , ASC 둘중 하나만 선택가능합니다.");
                    if($this->sql_order_by) $this->sql_order_by .= ",";
                    $this->sql_order_by .= " {$source}.{$key} {$value}";
                }
            }
        }

        if(is_string($first)) {
            if($first == "") $this->jl->error("JlModel orderBy() : 컬럼명을 입력해주새요.");
            if($second == "") $this->jl->error("JlModel orderBy() : 필터를 입력해주새요.");
            if(!in_array($first, $this->schema['columns'])) $this->jl->error("JlModel orderBy() : 존재하지않는 컬럼입니다..");
            if(!in_array($second,array("DESC","ASC"))) $this->jl->error("JlModel orderBy() : DESC , ASC 둘중 하나만 선택가능합니다.");

            if($this->sql_order_by) $this->sql_order_by .= ",";
            $this->sql_order_by .= " {$source}.{$first} {$second}";
        }

        return $this;
    }

    function join($table,$origin_key,$join_key,$join_type = "") {
        if(!in_array($table, $this->schema['tables'])) $this->jl->error("JlModel join() : $table 테이블을 찾을수 없습니다.");
        if(!in_array($origin_key, $this->schema['columns'])) $this->jl->error("JlModel join() : Origin Key를 찾을 수 없습니다.");
        $this->schema['join_columns'] = $this->getColumns($table);
        if(!in_array($join_key, $this->schema['join_columns'])) $this->jl->error("JlModel join() : Join Key를 찾을 수 없습니다.");
        $this->join_table = $table;
        $primary = $this->getPrimary($table);
        $this->join_primary = $primary['COLUMN_NAME'];

        $this->join_sql = "$join_type JOIN $table ON $this->table.$origin_key = $table.$join_key ";
    }

    function groupBy($group_key,$total_key,$as,$type = "COUNT") {
        if(!$this->join_table) $this->jl->error("JlModel groupBy() : join()을 먼저 해주세요.");
        if(strpos($group_key,".") === false) $this->jl->error("JlModel groupBy() : group_key의 형식이 잘못됐습니다. (table.column) 으로 진행해주세요.");
        if(strpos($total_key,".") === false) $this->jl->error("JlModel groupBy() : total_key의 형식이 잘못됐습니다. (table.column) 으로 진행해주세요.");
        if(!$as) $this->jl->error("JlModel groupBy() : as 값은 필수입니다.");
        if(!$type) $type = "COUNT";
        $groups = explode(".",$group_key);
        $totals = explode(".",$total_key);

        $group_columns = $groups[0] == $this->table ? $this->schema['columns'] : $this->schema['join_columns'];
        $total_columns = $totals[0] == $this->table ? $this->schema['columns'] : $this->schema['join_columns'];

        if(!in_array($groups[0], $this->schema['tables'])) $this->jl->error("JlModel groupBy() : {$groups[0]} 테이블을 찾을수 없습니다.");
        if(!in_array($totals[0], $this->schema['tables'])) $this->jl->error("JlModel groupBy() : {$totals[0]} 테이블을 찾을수 없습니다.");
        if(!in_array($groups[1], $group_columns)) $this->jl->error("JlModel groupBy() : {$groups[0]}에서 {$groups[1]} 를 찾을 수 없습니다.");
        if(!in_array($totals[1], $total_columns)) $this->jl->error("JlModel groupBy() : {$totals[0]}에서 {$totals[1]} 를 찾을 수 없습니다.");

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
        if($column == "") $this->jl->error("JlModel between() : 컬럼명을 대입 해주새요.");
        if($start == "") $this->jl->error("JlModel between() : 시작시간을 대입 해주새요.");
        if($end == "") $this->jl->error("JlModel between() : 종료시간을 대입 해주새요.");

        if($source == "") {
            $columns = $this->schema['columns'];
            $source = $this->table;
        } else {
            if(!$this->join_table) $this->jl->error("JlModel between() : join()을 먼저 해주세요.");
            $columns = $this->schema['join_columns'];
        }

        if(strtolower($column) == "curdate()" || strtolower($column) == "now()") {
            if(!in_array($start, $columns)) $this->jl->error("JlModel between() : start 컬럼이 존재하지않습니다.");
            if(!in_array($end, $columns)) $this->jl->error("JlModel between() : end 컬럼이 존재하지않습니다.");
            if($this->group_bool) {
                if(!$this->group_index) $this->group_index = 1;
                else $this->sql .= " {$operator} ";
            }else {
                $this->sql .= " {$operator} ";
            }

            $this->sql .= "$column BETWEEN $source.{$start} AND $source.{$end} ";
        }else {
            if(in_array($column, $columns)){
                if(strpos($start,":") === false) $start .= " 00:00:00";
                if(strpos($end,":") === false) $end .= " 23:59:59";

                if($this->group_bool) {
                    if(!$this->group_index) $this->group_index = 1;
                    else $this->sql .= " {$operator} ";
                }else {
                    $this->sql .= " {$operator} ";
                }

                $this->sql .= "$source.{$column} BETWEEN '{$start}' AND '{$end}' ";
            }else {
                $this->jl->error("JlModel between() : 유효하지않는 컬럼입니다.");
            }
        }



        return $this;
    }

    function in($first,$second = "",$operator = "AND",$source = "") {
        if($source == "") {
            $columns = $this->schema['columns'];
            $source = $this->table;
        } else {
            if(!$this->join_table) $this->jl->error("JlModel in() : join()을 먼저 해주세요.");
            $columns = $this->schema['join_columns'];
        }

        if(is_array($first)) {
            $param = $this->escape($first);

            foreach($param as $key => $value){
                if(in_array($key, $columns)){
                    if(!is_array($value)) $this->jl->error("JlModel in() : 비교값이 배열이아닙니다.");
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
            if($first == "") $this->jl->error("JlModel in() : 컬럼명을 입력해주새요.");
            if($second == "") $this->jl->error("JlModel in() : 필터를 입력해주새요.");
            if(!is_array($second)) $this->jl->error("JlModel in() : 비교값이 배열이 아닙니다.");

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
            if(!$this->join_table) $this->jl->error("JlModel where() : join()을 먼저 해주세요.");
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
            if($first == "") $this->jl->error("JlModel where() : 컬럼명을 입력해주새요.");
            if($second == "") $this->jl->error("JlModel where() : 필터를 입력해주새요.");
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
            if(!$this->join_table) $this->jl->error("JlModel like() : join()을 먼저 해주세요.");
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
            if($first == "") $this->jl->error("JlModel like() : 컬럼명을 입력해주새요.");
            if($second == "") $this->jl->error("JlModel like() : 필터를 입력해주새요.");
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
            if (is_array($value)) $value = $this->jsonEncode($value);
            if (is_object($value)) $value = $this->jsonEncode($value);

            if($this->mysqli) {
                $param[$key] = mysqli_real_escape_string($this->connect, $value);
            }else {
                $param[$key] = mysql_real_escape_string($value);
            }

        }
        return $param;
    }

    function jsonDecode($obj) {
        return $this->jl->jsonDecode($obj);
    }

    function jsonEncode($obj) {
        return $this->jl->jsonEncode($obj);
    }

    function error($obj) {
        return $this->jl->error($obj);
    }

    function backup($tableName, $data,$date) {
        // 데이터가 배열인지 확인
        if (!is_array($data) || empty($data)) {
            die("Invalid data provided. Must be a non-empty array.");
        }

        // 첫 번째 데이터의 키를 기준으로 컬럼 이름 추출
        $columns = array_keys($data[0]);
        // 특정 컬럼(jl_no, jl_no_reverse) 제거
        $excludedColumns = ['jl_no', 'jl_no_reverse'];
        $columns = array_filter($columns, function ($column) use ($excludedColumns) {
            return !in_array($column, $excludedColumns);
        });
        $columnsString = implode(', ', $columns);



        // INSERT INTO 구문 시작
        $sql = "INSERT INTO $tableName ($columnsString) VALUES\n";

        // 각 데이터 항목을 SQL 값으로 변환
        $values = [];
        foreach ($data as $row) {
            $escapedRow = [];
            foreach ($row as $column => $value) {
                // 특정 컬럼(jl_no, jl_no_reverse)은 건너뛰기
                if (in_array($column, $excludedColumns)) {
                    continue;
                }

                if (is_null($value)) {
                    $escapedRow[] = "NULL";
                    continue;
                }

                // 배열이나 객체인 경우 json_encode 처리
                if (is_array($value) || is_object($value)) {
                    $value = $this->jsonEncode($value);
                }

                $escapedRow[] = "'" . $value . "'";
            }
            $values[] = '(' . implode(', ', $escapedRow) . ')';
        }


        // 값 추가
        $sql .= implode(",\n", $values) . ";\n";


        //테이블 폴더 없으면 생성
        $filePath = $this->jl->RESOURCE."/{$tableName}";
        if(!is_dir($filePath)) {
            mkdir($filePath, 0777);
            chmod($filePath, 0777);
        }

        // 백업 경로 없다면 생성
        $filePath = $this->jl->RESOURCE."/{$tableName}/backup";
        if(!is_dir($filePath)) {
            mkdir($filePath, 0777);
            chmod($filePath, 0777);
        }

        $fileName = "{$date}.txt";

        //$this->jl->error($filePath);
        file_put_contents($filePath."/".$fileName, $sql, FILE_APPEND);

        //if (($error = error_get_last()) !== null) {
        //    $this->jl->error($error['message']);
        //}
    }


    /*
    | 속성             | 필수 여부 | 설명                                 | 예시 값                      |
    |------------------|----------|--------------------------------------|-----------------------------|
    | `type`           | 필수     | 데이터 타입 설정                     | 'VARCHAR', 'INT'            |
    | `length`         | 선택     | 데이터 길이 지정                     | 255, 11                     |
    | `nullable`       | 선택     | NULL 허용 여부                      | true, false                 |
    | `default`        | 선택     | 기본값 설정                          | 'example', 0, 'CURRENT_TIMESTAMP' |
    | `auto_increment` | 선택     | 자동 증가 여부                       | true, false                 |
    | `unique`         | 선택     | 고유 제약 조건 설정                  | true, false                 |
    | `comment`        | 선택     | 컬럼에 대한 설명 추가                | '사용자 이메일'             |

    $columns = array(
        'idx' => [
            'type' => 'VARCHAR',
            'length' => 15,
            'nullable' => false,
            'comment' => '고유값'
        ],
        'age' => [
            'type' => 'VARCHAR',
            'length' => 11,
            'nullable' => false,
            'auto_increment' => false,
        ],
        'address' => [
            'type' => 'VARCHAR',
            'length' => 255,
            'nullable' => false,
            'default' => '대한민국',
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'nullable' => true,
        ],
        primary => "idx"
    )
    */
    function createTable($columns) {
        if($this->isTable()) $this->jl->error("JlModel createTable() : 이미 테이블이 존재합니다.");
        // 테이블 생성 시작
        if (!$this->jl->isAssociativeArray($columns)) {
            $this->jl->error("JlModel createTable() : 매개변수는 연관배열로만 가능합니다.");
        }
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $this->table)) {
            $this->jl->error("JlModel createTable(): 유효하지 않은 테이블 이름입니다.");
        }

        if(!isset($columns['primary'])) $this->jl->error("JlModel createTable() : primary 값은 필수입니다.");



        $sql = "CREATE TABLE IF NOT EXISTS `{$this->table}` (";

        $columnDefinitions = [];
        foreach ($columns as $name => $definition) {
            if ($name === 'primary') {
                continue;
            }

            $definition = $this->jl->jsonDecode($definition);


            if (!isset($definition['type'])) {
                $this->jl->error("JlModel createTable(): {$name}의 type 정보가 없습니다.");
            }

            $type = strtoupper($definition['type']);
            if (isset($definition['auto_increment']) && $definition['auto_increment'] && $type !== 'INT') {
                $this->jl->error("JlModel createTable(): auto_increment는 INT 타입에서만 사용할 수 있습니다.");
            }

            $type = strtoupper($definition['type']);
            $length = isset($definition['length']) ? "({$definition['length']})" : "";
            $nullable = isset($definition['nullable']) && !$definition['nullable'] ? "NOT NULL" : "NULL";
            $default = isset($definition['default']) ? "DEFAULT '{$definition['default']}'" : "";
            $autoIncrement = isset($definition['auto_increment']) && $definition['auto_increment'] ? "AUTO_INCREMENT" : "";
            $comment = isset($definition['comment']) ? "COMMENT '{$definition['comment']}'" : "";

            $columnDefinitions[] = "`$name` $type$length $nullable $default $autoIncrement $comment";
        }

        // 컬럼 정의 추가
        $sql .= implode(", ", $columnDefinitions);

        // Primary Key 추가
        $sql .= ", PRIMARY KEY (`{$columns['primary']}`)";

        $sql .= ") DEFAULT CHARSET=utf8mb4;";

        // 쿼리 실행
        if ($this->mysqli) {
            $result = mysqli_query($this->connect, $sql);
            if (!$result) {
                $this->jl->error(mysqli_error($this->connect) . "\n $sql");
            }
        } else {
            $result = mysql_query($sql, $this->connect);
            if (!$result) {
                $this->jl->error(mysql_error());
            }
        }

        if (!$result) {
            $errorMessage = "JlModel createTable(): 테이블 생성 실패";
            if ($this->jl->DEV) {
                $errorMessage .= "\n" . ($this->mysqli ? mysqli_error($this->connect) : mysql_error()) . "\n $sql";
            }
            $this->jl->error($errorMessage);
        }

        return true;
    }
}
?>