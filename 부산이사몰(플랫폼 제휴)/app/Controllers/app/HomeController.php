<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\MemberModel;
use App\Models\VisitorsModel;
use App\Services\BaroSendMessagesService;

class HomeController extends BaseController
{

    //메인 화면
    public function index(): string
    {
        $get = $this->request->getGet();
        //메인 상위 걧수
        $topLimit= 0;
        //메인 상단
        $cpTop = 3;
        //메인 하단
        $cpBottom = 4;
        //메인 하단 걧수
        $BotLimit= 0;
        
        //IP
        $ipAddress = $this->request->getIPAddress();
        $visitorsModel = new VisitorsModel();
        $data= [
            'ip_address' => $ipAddress,
        ];

        $param = [
            'type' => $get['type'] ?? '',
            'service' => $get['service'] ?? '',
            'reg' => $get['reg'] ?? '',
        ];

        //방문자 insert
        $visitorsModel->addVisitor($data);
        // 방문자 수 오늘 , 총
        $response = $visitorsModel->getVisitorCount($data);

        $companyTop = (new CompanyModel())->getCompanyRandTop($cpTop,$topLimit, $param);

        $companyBottom = (new CompanyModel())->getCompanyRandTop($cpBottom,$BotLimit , $param);

        $areaSi = REGION[$get['type'] ?? 'bus'];
        $data = [
            'pid' => 'app_index',
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
            'companyTop' => $companyTop, //상단
            'companyBottom' => $companyBottom, //하단
            'type' => $get['type'] ?? 'bus',
            'service' => $get['service'] ?? '',
            'sigu' => getSiGuData($areaSi, true) ?? [],
            'get' => $get,
        ];

        return render('app/index', $data);
    }

    /*public function text()
    {

        // 테스트를 위한 설정
        $baroService = new BaroSendMessagesService();

        $resultData = (new MemberModel())->kakaoTalList('19');
        $variables = [];

        foreach ($resultData as $list){
            if (isset($list['mb_hp'])) {
                $phoneNumber = str_replace('-', '', $list['mb_hp']);
                $variables[] = ['number' => $phoneNumber];
            }
        }


        $result = $baroService->sendKakaoTalkMessages($variables, 'NEW_ORDER', '견적 신청 접수 안내', BAROBILL_KAKAO, 'E', BAROBILL_SMS, '16');
        // 결과를 JSON 형식으로 반환

        return json_encode($result);
    }*/

}