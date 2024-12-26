<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;
use CodeIgniter\Model;

class EstimateModel extends Model
{
    use BuilderTrait;

    //이사견적 신청
    public function insertEstimate($estimate = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_estimate');
            $builder->insert($estimate);
            return true;
        } catch (\Exception $e) {
            log_message('error', "등록실패: " . $e->getMessage());
            return false;
        }
    }

    //이사견적 수정
    public function updateEstimate($estimate = [], $condition = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_estimate');
            $builder->set($estimate)
                ->set('updated_at', 'now()', false)
                ->where($condition)
                ->update();
            return true;
        } catch (\Exception $e) {
            log_message('error', "수정실패: " . $e->getMessage());
            return false;
        }
    }

    // 이사견적 상세
    public function getAEstimateByIdx($idx = ''): array
    {
        $builder = $this->getBuilder('bm_estimate');
        $builder->select('*')
            ->where('del_yn', 'N')
            ->where('del_at IS NULL')
            ->where('idx',$idx);
        $row = $builder->get()->getRowArray();

        return $row ?? [];


    }

    //관리자 이사견적 리스트
    public function getAEstimateList($param = []): array
    {
        $builder = $this->getBuilder('bm_estimate', 'a');
        $builder->select('*')
            ->select('(select mb_id from bm_member where idx = a.mb_idx ) as mb_id ')
            ->select('(select mb_idx from bm_hp_order where mb_idx = "' . $param['mb_idx'] . '" AND del_yn = "N" AND est_idx = a.idx LIMIT 1 ) as hp ')
            ->where('del_yn', 'N')
            ->where('del_at IS NULL')
            ->orderBy('idx', 'DESC');

        // 시작일,종료일
        if ($param['dateType'] == 'createdAt' || empty($param['dateType'])) {
            if (!empty($param['sdt'])) $builder->where('DATE(a.created_at) >=', $param['sdt']);
            if (!empty($param['edt'])) $builder->where('DATE(a.created_at) <=', $param['edt']);
        } elseif ($param['dateType'] == 'schedDate') {
            if (!empty($param['sdt'])) $builder->where('DATE(a.sched_date) >=', $param['sdt']);
            if (!empty($param['edt'])) $builder->where('DATE(a.sched_date) <=', $param['edt']);
        }
        if (!empty($param['serviceState'])) $builder->where('a.service_state', $param['serviceState']);

        // 사업자 > 이사견적 열람
        if (!empty($param['state'])) $builder->where('a.state', $param['state']);

        // 나의 이사견적 / 수정
        if (!empty($param['mbidx'])) $builder->where('a.mb_idx', $param['mbidx']);
        if (!empty($param['idx'])) $builder->where('a.idx', $param['idx']);


        // 페이징
        $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        if (($param['limitCnt'] ?? 0) > 0) {
            $builder->limit($param['limitCnt']);
        } else {
            $builder->limit($paging['listRows'], $paging['formRecord']);
        }

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray() ?? [],
            'paging' => $paging,
        ];
    }
}