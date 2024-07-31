<?php
use Config\Database;

/**
 * 공통 데이터베이스 연결 인스턴스를 제공합니다.
 *
 * @return \CodeIgniter\Database\BaseConnection
 */
function getDatabaseConnection() {
    static $db = null;
    if ($db === null) {
        $db = Database::connect();
    }
    return $db;
}

/**
 * SQL 쿼리를 실행하고, 필요에 따라 오류 처리를 수행합니다.
 * 오류 시 false를 반환합니다.
 *
 * @param string $sql 실행할 SQL 쿼리 문자열.
 * @param bool $error 에러 시 false를 반환할지 여부.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return mixed 쿼리 결과 객체 또는 실패 시 false.
 */
function sql_query($sql, $error = true, $db = null) {
    $db = $db ?: getDatabaseConnection();
    $sql = trim($sql);
    $sql = preg_replace("#^select.*from.*[\s\(]+union[\s\)]+.*#i", "select 1", $sql);
    $sql = preg_replace("#^select.*from.*where.*`?information_schema`?.*#i", "select 1", $sql);
    $result = $db->query($sql);
    if ($error && !$result) {
        return false;
    }
    return $result;
}

/**
 * SQL 쿼리를 실행하고, 결과의 첫 번째 행을 배열로 반환합니다.
 *
 * @param string $sql 실행할 SQL 쿼리 문자열.
 * @param bool $error 에러 시 예외를 발생시킬지 여부.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return array 결과의 첫 번째 행.
 */
function sql_fetch($sql, $error = true, $db = null) {
    $db = $db ?: getDatabaseConnection();

    $query = sql_query($sql, $error, $db);
    return $query->getRowArray();
}

/**
 * 결과 객체에서 연관 배열로 다음 행을 반환합니다.
 *
 * @param mixed $result 쿼리 결과 객체.
 * @return array 결과의 모든 행.
 */
function sql_fetch_array($result) {
    return $result->getResultArray();
}



/**
 * 주어진 값을 사용하여 PASSWORD() 함수의 해시를 계산합니다.
 *
 * @param string $value 해시할 문자열.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return string 해시된 패스워드.
 */
function sql_password($value, $db = null) {
    $db = $db ?: getDatabaseConnection();

    $query = $db->query("SELECT PASSWORD(?) AS pass", [$value]);
    $row = $query->getRow();
    return $row->pass;
}

/**
 * 데이터베이스에서 마지막으로 삽입된 행의 ID를 반환합니다.
 * 실패 시 -1을 반환합니다.
 *
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return int 마지막으로 삽입된 행의 ID 또는 실패 시 -1.
 */
function sql_insert_id($db = null) {
    $db = $db ?: getDatabaseConnection();
    $id = $db->insertID();
    return $id ?: -1;
}

/**
 * 데이터베이스 트랜잭션을 시작합니다.
 *
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 */
function sql_trans_begin($db = null) {
    $db = $db ?: getDatabaseConnection();

    $db->transBegin();
}

/**
 * 데이터베이스 트랜잭션을 커밋하고, 성공 여부에 따라 롤백을 수행합니다.
 * 실패 시 false를 반환합니다.
 *
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return bool true 성공 시, false 실패 시.
 */
function sql_trans_commit($db = null) {
    $db = $db ?: getDatabaseConnection();
    $db->transComplete();
    return $db->transStatus() !== false;
}

/**
 * 데이터베이스 트랜잭션을 롤백합니다.
 *
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 */
function sql_trans_rollback($db = null) {
    $db = $db ?: getDatabaseConnection();

    $db->transRollback();
}

/**
 * 주어진 키와 값으로 데이터베이스 조회 조건을 설정합니다.
 *
 * @param string $key 조건 키.
 * @param mixed $value 조건 값.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return \CodeIgniter\Database\BaseConnection 설정된 데이터베이스 연결 인스턴스.
 */
function sql_where($key, $value, $db = null) {
    $db = $db ?: getDatabaseConnection();

    $db->where($key, $value);
    return $db;
}

/**
 * 지정된 테이블에 데이터를 삽입합니다.
 *
 * @param string $table 삽입할 테이블 이름.
 * @param array $data 삽입할 데이터 배열.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return bool 삽입 성공 여부.
 */
function sql_insert($table, $data, $db = null) {
    $db = $db ?: getDatabaseConnection();

    return $db->table($table)->insert($data);
}

/**
 * 주어진 조건에 따라 테이블에서 데이터를 삭제합니다.
 *
 * @param string $table 삭제할 테이블 명.
 * @param array $conditions 삭제 조건.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return bool 삭제 성공 여부.
 */
function sql_delete($table, $conditions, $db = null) {
    $db = $db ?: getDatabaseConnection();

    return $db->table($table)->delete($conditions);
}

/**
 * 주어진 데이터로 테이블을 업데이트합니다.
 * 업데이트 성공 여부를 반환합니다.
 *
 * @param string $table 업데이트할 테이블 명.
 * @param array $data 업데이트할 데이터 배열.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return bool 업데이트 성공 여부.
 */
function sql_update($table, $data, $db = null) {
    $db = $db ?: getDatabaseConnection();

    return $db->table($table)->update($data);
}

/**
 * 지정된 테이블에 대해 데이터베이스 잠금을 설정합니다.
 * 입력은 배열 또는 쉼표로 구분된 문자열 형태로 받을 수 있습니다.
 *
 * @param mixed $tables 잠글 테이블 이름 배열 또는 쉼표로 구분된 문자열.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 */
function sql_lock($tables, $db = null) {
    $db = $db ?: getDatabaseConnection();

    // 입력값이 문자열인 경우, 쉼표로 구분된 문자열을 배열로 변환
    if (is_string($tables)) {
        $tables = explode(',', $tables);
    }

    // 테이블명 정제 및 잠금 쿼리 구성
    $lockQueries = [];
    foreach ($tables as $table) {
        $lockQueries[] = $db->escapeString(trim($table)) . ' WRITE';
    }

    $query = 'LOCK TABLES ' . implode(', ', $lockQueries);
    $db->query($query);
}

/**
 * 데이터베이스 잠금을 해제합니다.
 *
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 */
function sql_unlock($db = null) {
    $db = $db ?: getDatabaseConnection();

    $db->query('UNLOCK TABLES');
}

/**
 * 주어진 문자열을 MySQL 쿼리에서 안전하게 이스케이프합니다.
 *
 * @param string $string 이스케이프할 문자열.
 * @param \CodeIgniter\Database\BaseConnection $db 데이터베이스 연결 인스턴스 (선택 사항).
 * @return string 이스케이프된 문자열.
 */
function sql_real_escape_string($string, $db = null) {
    $db = $db ?: getDatabaseConnection();

    return $db->escapeString($string);
}

/**
 * 결과 집합의 행 수를 반환합니다.
 *
 * @param \CodeIgniter\Database\ResultInterface $result 쿼리 실행 결과 객체.
 * @return int 결과 집합에 있는 행의 수.
 */
function sql_num_rows($result)
{
    return $result->getNumRows();
}

/**
 * 배열 데이터를 SQL INSERT 구문에 사용할 수 있는 형식으로 변환하는 함수
 *
 * @param array $data - 컬럼과 값을 포함하는 연관 배열
 * @return string - "컬럼 = 값" 형식의 문자열을 콤마로 구분하여 반환
 */
function array_to_sql_insert_str($data) {
    // 컬럼과 값을 "컬럼 = 값" 형식으로 추출
    $setClause = [];
    foreach ($data as $column => $value) {
        //배열일 경우에는 1을 리턴
        if(is_array($value) == 1){
            $encode_data = json_encode($value,JSON_UNESCAPED_UNICODE);
            $setClause[] = "`$column` = '$encode_data'";
        }else{
            $setClause[] = "`$column` = '$value'";
        }
    }

    // "컬럼 = 값" 형식의 문자열을 연결
    return implode(', ', $setClause);
}