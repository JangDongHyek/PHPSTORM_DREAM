<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class PaymentModel extends BaseModel
{
    use BuilderTrait;
    protected $table = 'bm_payment';
    //관리자 결제 취소
    public function getPaymentByIdx($idx = []):array
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where($idx);

        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

    // 결제 내역
    public function getPaymentFullList($param = []): array
    {

        $builder = $this->getBuilder($this->table, 'a');
        $builder->select('a.*, b.*, c.*, c.idx as pidx')
            ->join('bm_member_card b', 'b.mb_idx = a.mb_idx ', 'left')
            ->join('bm_payment c','a.idx = c.order_id', 'left')
            ->where('a.del_yn', 'N')
            ->where('a.status != "T"')
            ->orderBy('a.idx', 'DESC');

        if (!empty($param['mbidx'])) $builder->where('a.mb_idx', $param['mbidx']);
        if (!empty($param['sdt'])) $builder->where('DATE(a.created_at) >=', $param['sdt']);
        if (!empty($param['edt'])) $builder->where('DATE(a.created_at) <=', $param['edt']);
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case 'mbId':
                    $builder->like('a.mb_id', $param['stx']);
                    break;
                case 'companyName':
                    $builder->like('b.company_name', $param['stx']);
                    break;
            }
        }


        // 페이징
        $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
        else $builder->limit($paging['listRows'], $paging['formRecord']);

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray() ?? [],
            'paging' => $paging,
        ];
    }


}