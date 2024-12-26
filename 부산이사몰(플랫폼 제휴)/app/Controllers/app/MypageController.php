<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;
use App\Models\AdvertsModel;
use App\Models\CallRecordModel;
use App\Models\CompanyModel;
use App\Models\EstimateModel;
use App\Models\HpOrderModels;
use App\Models\MemberCardModel;
use App\Models\MemberModel;
use CodeIgniter\HTTP\ResponseInterface;

class MypageController extends BaseController
{
    // 일반회원 > 나의 이사견적
    public function estimateMy(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'mbidx' => $this->member['idx'],
        ];

        $resultData = (new EstimateModel())->getAEstimateList($param);

        $data = array_merge($resultData, [
            'pid' => 'app_estimate_my',
            'param' => $param,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);
        return render('app/mypage/estimate_my', $data);
    }

    // 정보 관리
    public function mypage(): string
    {
        // 카드 정보
        $cardData = (new MemberCardModel())->getCardByNum('', $this->member['mb_id']);

        $data = [
            'pid' => 'app_mypage',
            'cardData' => $cardData,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ];

        return render('app/mypage/mypage', $data);
    }

    // 사업자 > 광고 내역
    public function ad(): string
    {
        $get = $this->request->getGet();

        $advertsModel = new AdvertsModel();

        $param = [
            'page' => $get['page'] ?? 1,
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'mbIdx' => $this->member['idx'],
            'admin' => 'Y',
        ];

        // 현재 진행중인 광고 OR 결제일
        $monthData = $advertsModel->getMonthData($param);

        // 광고 결제 내역
        $resultData = (new CompanyModel())->getCompanyList($param);

        $data = array_merge($resultData, [
            'pid' => 'app_ad',
            'param' => $param,
            'monthData' => $monthData,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/mypage/ad', $data);
    }

    // 사업자 > 결제 내역
    public function adPayment(): string
    {
        $get = $this->request->getGet();

        $advertsModel = new AdvertsModel();

        $param = [
            'page' => $get['page'] ?? 1,
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'mbidx' => $this->member['idx'],
            'type' => $get['type'],
        ];

        // 광고 결제 내역
        $resultData = $advertsModel->getAdList($param);

        $data = array_merge($resultData, [
            'pid' => 'app_ad_payment',
            'param' => $param,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/mypage/ad_payment', $data);
    }

    // 사업자 > 전화연결 통계 서비스
    public function callStat(): string
    {

        $get = $this->request->getGet();
        $callRecordModel = new CallRecordModel();
        $param = [
            'page' => $get['page'] ?? 1,
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'mbHp' => str_replace('-', '', $this->member['mb_hp']), //02-855-0088
        ];
        // 수신 상세내역
        $resultData = $callRecordModel->getCallingByNumList($param);
        // 총 수신건수, 월 , 일
        $totalReceived = $callRecordModel->getTotalReceived($param);


        $data = array_merge($resultData, [
            'pid' => 'app_call_stat',
            'totalReceived' => $totalReceived,
            'param' => $param,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/mypage/call_stat', $data);
    }

    public function postCardEnrolment(): ResponseInterface
    {
        $resultData['result'] = (new MemberCardModel())->getCardByNum('', $this->member['mb_id']);

        return $this->response->setJSON($resultData);
    }

    // 전화 연결 이력 조회
    public function postHpOrderByIdx(): ResponseInterface
    {
        $post = $this->request->getJSON(true);

        $resultData['result'] = (new HpOrderModels())->getHpOrderByEstIdx($post['estIdx'], $this->member);

        return $this->response->setJSON($resultData['result']);

    }

}
