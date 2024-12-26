<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;
use CodeIgniter\Model;

class BaseModel extends Model
{
    use BuilderTrait;

    protected $table;      // 각 모델에서 정의할 테이블명 (상속받는 모델에서 정의 필수!)

    /**
     * 등록
     * @param array $data 등록할 데이터
     * @param bool $returnIdx insertID 반환 필요시 true
     * @return bool|int
     */
    public function insertData(array $data = [], bool $returnIdx = false)
    {
        try {
            $builder = $this->getBuilder($this->table);
            $result = $builder->insert($data);

            // 입력 실패
            if (!$result) return false;

            if ($returnIdx) {
                return $this->db->insertID();
            } else {
                return true;
            }

        } catch (\Exception $e) {
            log_message('error', "{$this->table} 등록실패: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * 수정
     * @param array $data 수정할 데이터
     * @param array $condition 조건
     * @return bool
     */
    public function updateData(array $data = [], array $condition = []): bool
    {
        try {
            $builder = $this->getBuilder($this->table);
            $result = $builder->set($data)
                ->set('updated_at', 'now()', false)
                ->where($condition)
                ->update();

            // 업데이트된 행 수
            return $result > 0;

        } catch (\Exception $e) {
            log_message('error', "{$this->table} 수정실패: " . $e->getMessage());
            return false;
        }
    }

    /**
     * 삭제
     * @param array $condition 삭제 조건
     * @param string $deleteDateColumn 삭제시간 컬럼명 존재시
     * @return bool
     */
    public function deleteData(array $condition = [], string $deleteDateColumn = ''): bool
    {
        if (empty($condition)) return false;

        try {
            $builder = $this->getBuilder($this->table);
            $result = $builder->set('del_yn', 'Y');

            // 삭제 시간 컬럼존재시
            if (!empty($deleteDateColumn)) $builder->set($deleteDateColumn, 'now()', false);
            else $builder->set('updated_at', 'now()', false);

            $builder->where($condition)
                ->update();

            // 업데이트된 행 수
            return $result > 0;

        } catch (\Exception $e) {
            log_message('error', "{$this->table} 삭제실패: " . $e->getMessage());
            return false;
        }
    }
}
