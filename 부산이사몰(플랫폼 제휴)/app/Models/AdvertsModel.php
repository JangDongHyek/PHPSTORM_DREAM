<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class AdvertsModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_ad_order';

    // 광고 결제 내역
    public function getAdList($param = []): array
    {
        $builder = $this->getBuilder($this->table, 'a');

        // 서브쿼리 생성
        $subQuery = $this->getBuilder('bm_member_card')
            ->select('*')
            ->where('del_yn', 'N')
            ->groupBy('mb_idx')
            ->getCompiledSelect(); // 서브쿼리를 문자열로 변환

        $builder->select('a.*, b.*, c.*, c.idx as pidx')
            ->join("($subQuery) b", 'b.mb_idx = a.mb_idx', 'left')
            ->join('bm_payment c', 'a.idx = c.order_id', 'left')
            ->where('a.del_yn', 'N')
            ->where('a.status != "T"')
            ->orderBy('a.idx', 'DESC');

        if (!empty($param['mbidx'])) $builder->where('a.mb_idx', $param['mbidx']);
        if (!empty($param['sdt'])) $builder->where('DATE(a.created_at) >=', $param['sdt']);
        if (!empty($param['edt'])) $builder->where('DATE(a.created_at) <=', $param['edt']);
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case 'mbId':
                    $builder->like('c.mb_id', $param['stx']);
                    break;
                case 'companyName':
                    $builder->like('a.company_name', $param['stx']);
                    break;
            }
        }
        if (!empty($param['type'])) {
            switch ($param['type']) {
                case 'ad':
                    $builder->where('a.area_gu != "전화 연결"');
                    break;

                case 'tel':
                    $builder->where('a.area_gu', '전화 연결');
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

    // 광고 신청 관리
    public function getAdCompanyList($param = []): array
    {
        $builder = $this->getBuilder($this->table, 'b');
        $builder->select('b.*,a.company_name as companyName, a.mb_id,MIN(a.created_at) AS earliest_created_at,')
        ->join('bm_member a', 'a.idx = b.mb_idx', 'left')
        ->where('a.del_yn = "N"')
        ->where('b.del_yn = "N"')
        ->where('b.status != "T"')
        ->groupBy('b.mb_idx')
        ->orderBy('a.idx', 'DESC');

        if (!empty($param['sdt'])) $builder->having('DATE(b.next_pay_at) >=', $param['sdt']);
        if (!empty($param['edt'])) $builder->having('DATE(b.next_pay_at) <=', $param['edt']);

        /*if (!empty($param['dtRange'])) $builder->where('b.status', $param['dtRange']);*/
        if (!empty($param['mbIdx'])) $builder->where('a.mb_idx', $param['mbIdx']);
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case 'mbId':
                    $builder->like('a.mb_id', $param['stx']);
                    break;
                case 'mbName':
                    $builder->like('a.mb_name', $param['stx']);
                    break;
                case 'companyName':
                    $builder->like('a.company_name', $param['stx']);
                    break;
            }
        }

        // 페이징
        $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
        else $builder->limit($paging['listRows'], $paging['formRecord']);

        $query = $builder->get();
        $list = [];

        foreach ($query->getResultArray() as $row) {
            $param = [
                'idx' => $row['idx']
            ];
            $row['order'] = $this->getADOrderInfo($param);
            $list[] = $row;
        }

        return [
            'listData' => $list,
            'paging' => $paging,
        ];
    }

    //현재 진행중인 광고 OR 결제일
    public function getMonthData($param = []): array
    {
        $builder = $this->getBuilder($this->table, 'a');
        $builder->select('a.*')
            ->select('(select b.next_pay_at from bm_ad_order as b where b.del_yn = "N" and b.status != "T" and b.mb_idx = a.mb_idx and parent_id = "0") as next_pay_at')
            ->where('a.del_yn', 'N')
            ->where('a.status !=', 'T')
            ->orderBy('a.idx', 'DESC');

        if (!empty($param['mbIdx'])) $builder->where('a.mb_idx', $param['mbIdx']);

        $row = $builder->get()->getRowArray();

        return $row ?? [];

    }

    // 광고 변경 및 결제 상세 페이지
    public function getADOrderInfo($param = []): array
    {
        $builder = $this->getBuilder($this->table, 'a');
        $builder->select('a.*, b.*,a.idx as aidx')
            ->join('bm_member_card b', 'a.mb_idx = b.mb_idx', 'left')
            ->where('a.del_yn', 'N')
            ->where('a.status != "T"');

        if (!empty($param['idx'])) {
            $builder->groupStart()  // 조건 그룹 시작
            ->where('a.idx', $param['idx'])
                /*->orWhere('a.parent_id', '0')*/
                ->orWhere('a.parent_id', $param['idx'])
                ->groupEnd();  // 조건 그룹 종료
        }
        $builder->orderBy('a.idx', 'DESC')
            ->limit(1);

        $row = $builder->get()->getRowArray();

        return $row ?? [];

    }

    // 광고 변경 및 결제 상세 페이지
    public function getADOrderInfo01(array $param): array
    {

        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where('del_yn', 'N')
            ->where('status != "T"');
        if (!empty($param['idx'])) {
            $builder->groupStart()
                ->orWhere('idx', $param['idx'])
                ->orWhere('parent_id', $param['idx'])
                ->groupEnd();
        }

        $builder->orderBy('idx', 'DESC')
            ->limit(1);

        $row = $builder->get()->getRowArray();

        if ($row['mb_idx']) {
            $builder2 = $this->getBuilder('bm_member_card');
            $builder2->select('*')
                ->where('mb_idx', $row['mb_idx'])
                ->where('del_yn', 'N');
            $row['card'] = $builder2->get()->getRowArray();
        }

        return $row ?? [];
    }

    //광고 내역이 있는지
    public function getADOrderCount($param = []): int
    {
        $builder = $this->getBuilder($this->table);
        $builder->where('area_gu !=', '전화 연결')
            ->where('status !=', 'T')
            ->where('del_yn', 'N');

        if (!empty($param['idx'])) {
            $builder->where('mb_idx', $param['idx']);
        }

        return $builder->countAllResults(false); // 쿼리 리셋 방지
    }
}