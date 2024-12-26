<?php

namespace App\Models\Traits;

/**
 * Trait: 클래스간 코드 재사용
 * 다른 모델에서 사용시 use BuilderTrait;
 * 모델 클래스에 포함하면 상속받은 것처럼 $this->getBuilder() 로 호출 가능
 */
trait BuilderTrait
{
    /**
     * 빌더 생성 : 테이블 생성 시 별칭이 있는 경우
     *
     * @param string $tableName 테이블 이름
     * @param string $useAlias 사용할 별칭 (선택 사항)
     */
    protected function getBuilder(string $tableName, string $useAlias = '')
    {
        if (!empty($useAlias)) {
            return $this->db->table($tableName . ' as ' . $useAlias);
        } else {
            return $this->db->table($tableName);
        }
    }
}