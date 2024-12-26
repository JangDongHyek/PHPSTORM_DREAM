<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class MemberCardModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_member_card';

    // 카드 정보 조회
    public function getCardByNum($cardNum = '', $mbId = ''): array
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where('del_yn', 'N');
        if (!empty($cardNum)) {
            $builder->where('card_num', $cardNum);
        }
        if (!empty($mbId)) {
            $builder->where('mb_id', $mbId);
        }

        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

}