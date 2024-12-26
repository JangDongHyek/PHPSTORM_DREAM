<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;
use App\Models\EstimateModel;

class EstimateController extends BaseController
{
    // 일반회원 > 이사견적 신청
    public function estimateForm(): string
    {
        $get = $this->request->getGet();
        $idx =$get['idx'] ?? 0;

        $param = [
            'idx' =>  $get['idx'] ?? 0,
            'mbidx' => $this->member['idx']
        ];

        if (!empty($idx)) {
            $idxData = (new EstimateModel())->getAEstimateList($param);
        }

        $data = [
            'idxData' => $idxData['listData'][0] ?? [],
            'pid' => 'app_estimate_form',
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ];

        return render('app/estimate/estimate_form', $data);
    }

    // 사업자 > 이사견적 열람
    public function estimate(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'serviceState' => $get['serviceState'] ?? '', // 승인 상태
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'state' => 'Y',
            'mb_idx' => $this->member['idx']
        ];

        $resultData = (new EstimateModel())->getAEstimateList($param);

        $data = array_merge($resultData,[
            'pid' => 'app_estimate',
            'param' => $param,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/estimate/estimate', $data);
    }

}