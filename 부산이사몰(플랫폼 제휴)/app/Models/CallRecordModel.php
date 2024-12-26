<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class CallRecordModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_call_records';

    public function getCallIdById(array $data): bool
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where('del_yn', 'N');

        if (!empty($data['callId'])) $builder->where('callId', $data['callId']);

        $row = $builder->get()->getRowArray();

        if (!empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    // 수신 상세내역
    public function getCallingByNumList($param = []): array
    {
        $builder = $this->getBuilder($this->table, 'a');
        $builder->select('a.*, b.*')

            ->where('a.del_yn', 'N')
            ->where('b.del_yn', 'N')
            ->orderBy('a.created_at', 'DESC');

        if (!empty($param['admin'])){
            $builder->join('bm_member b', 'a.calling_num = REPLACE(b.mb_hp, \'-\', \'\')', 'left');
        }else{
            $builder->join('bm_member b', 'a.called_num = REPLACE(b.mb_hp, \'-\', \'\')', 'left');
        }

        if (!empty($param['mbHp'])) $builder->where('a.calling_num', $param['mbHp']);

        if (!empty($param['sdt'])) $builder->where('DATE(a.created_at) >=', $param['sdt']);
        if (!empty($param['edt'])) $builder->where('DATE(a.created_at) <=', $param['edt']);

        // 검색
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case 'name' :
                    $builder->like('b.mb_name', $param['stx']);
                    break;
                case 'tel' :
                    $builder->like('a.called_num', $param['stx']);
                    break;
                case 'company': // 회사이름
                    $builder->like('b.company_name', $param['stx']);
                    break;
                case 'calling': // 발신번호
                    $builder->like('a.calling_num',$param['stx']);
                    break;
                case 'vno': // 가상번호
                    $builder->like('a.vno' ,$param['stx']);
                    break;
            }
        }
        //페이징
        if ($param['isPaging'] ?? true) {
            $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
            $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
            if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
            else $builder->limit($paging['listRows'], $paging['formRecord']);
        }
        $query = $builder->get();

        return [
            'listData' => $query->getResultArray() ?? [],
            'paging' => $paging,
        ];

    }

    // 총 수신건수, 월 , 일
    public function getTotalReceived($param = [] ):array
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*');
        $totalCountQuery = $builder->where('del_yn', 'N');

        if (!empty($param['mbHp'])) $totalCountQuery->where('calling_num', $param['mbHp']);

        $totalCount = $totalCountQuery->countAllResults();

        // 월별 호출 수 계산
        $monthCountQuery = $this->getBuilder($this->table);
        $monthCountQuery->where('del_yn','N')
            ->where('created_at > LAST_DAY(NOW() - INTERVAL 1 MONTH) and created_at<= NOW()');
        if (!empty($param['mbHp'])) {
            $monthCountQuery->where('calling_num', $param['mbHp']);
        }

        $monthCount = $monthCountQuery->countAllResults();

        // 일별 호출 수 계산
        $dayCountQuery = $this->getBuilder($this->table);
        $dayCountQuery->where('del_yn', 'N')
            ->where('created_at >= CURDATE() - INTERVAL 1 DAY');

        if (!empty($param['mbHp'])) {
            $dayCountQuery->where('calling_num', $param['mbHp']);
        }

        $dayCount = $dayCountQuery->countAllResults();

        return [
            'totalCount' =>$totalCount,
            'monthCount' => $monthCount,
            'dayCount' => $dayCount,

        ];
    }
}