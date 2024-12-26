<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class HpOrderModels extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_hp_order';

    public function getHpOrderByEstIdx($estIdx, array $member): bool
    {
        try {
            $builder = $this->getBuilder($this->table);
            $builder->select('*')
                ->where('est_idx', $estIdx)
                ->where('del_yn', 'N')
                ->where('mb_idx', $member['idx']);

            $row = $builder->get()->getRowArray();

            if ($row) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', "초회 실패: " . $e->getMessage());
            return false;
        }
    }
}