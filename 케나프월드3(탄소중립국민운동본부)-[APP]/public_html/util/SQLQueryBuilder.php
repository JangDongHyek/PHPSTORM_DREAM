<?php

/**
 * Class SQLQueryBuilder
 * 고명우
 * SQL Query 작성 객체 
 * *****************************
 * select
 * from
 * where -> 값이 잇을경우만
 * order by
 * join
 * limit
 * getSql -> 쿼리 출력
 * *****************************
 */
class SQLQueryBuilder {
    protected $select = '';
    protected $from = '';
    protected $where = [];
    protected $orderBy = '';
    protected $join = []; // JOIN을 저장할 배열
    protected $limit = ''; // LIMIT 구문

    public function select(string $select) {
        $this->select = $select;
        return $this;
    }

    public function from(string $from) {
        $this->from = $from;
        return $this;
    }

    public function where(string $condition) {
        if (!empty($condition)) {
            $this->where[] = $condition;
        }
        return $this;
    }

    public function orderBy(string $orderBy) {
        $this->orderBy = $orderBy;
        return $this;
    }

    // JOIN 메소드 추가
    public function join(string $type, string $table, string $on) {
        $this->join[] = "$type JOIN $table ON $on";
        return $this;
    }

    // LIMIT 메소드 추가
    public function limit(int $limit, int $offset = 0) {
        if ($offset > 0) {
            $this->limit = "LIMIT $offset, $limit";
        } else {
            $this->limit = "LIMIT $limit";
        }
        return $this;
    }

    public function getSQL() {
        $sql = $this->select . ' FROM ' . $this->from;
        if (!empty($this->join)) {
            $sql .= ' ' . implode(' ', $this->join);
        }
        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }
        if (!empty($this->orderBy)) {
            $sql .= ' ORDER BY ' . $this->orderBy;
        }
        if (!empty($this->limit)) {
            $sql .= ' ' . $this->limit;
        }
        return $sql . ';';
    }
}
