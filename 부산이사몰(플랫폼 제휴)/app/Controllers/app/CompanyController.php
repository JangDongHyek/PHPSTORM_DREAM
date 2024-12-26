<?php

namespace App\Controllers\app;

use App\Controllers\_common\ErrorController;
use App\Controllers\BaseController;
use App\Models\CompanyModel;

class CompanyController extends BaseController
{
    // 이사업체 목록
    public function company(): string
    {
        $get = $this->request->getGet();
        $areaSi = REGION[$get['type']];
        $param = [
            'page' => $get['page'] ?? 1,
            'areaSi' => $areaSi ?? '',
            'areaGu' => $get['reg'] ?? '',
            'stx' => $get['stx'] ?? '',
            'service' => $get['service'] ?? '',
            'listRow' => '16'
        ];

        $resultData = (new CompanyModel())->getCompanyList($param);

        $cpType = '2';
        $topLimit = '0';
        $service = $get['service'];
        $premium = (new CompanyModel())->getCompanyRandTop($cpType, $topLimit,'',$service , $areaSi, $get['reg']);
        //var_dump($premium);

        $data = array_merge($resultData,[
            'pid' => 'app_company',
            'sigu' => getSiGuData($areaSi, true) ?? [],
            'reg' => $get['type'] ?? '',
            'get' => $get,
            'type' => $get['type'] ?? '',
            'service' => $get['service'] ?? '',
            'stx' => $get['stx'],
            'premium' => $premium,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        if (empty($get['type']) || empty($get['service'])) {
            $redirectUrl = base_url() . 'company?type=bus&service=P&reg=all';
            header("Location: $redirectUrl");
            exit; // 리다이렉트 후 스크립트 종료
        }


        if (!empty($get['stx']) && !isset($get['redirected'])) {
            // 리다이렉트 플래그 추가
            $redirectUrl = base_url() . 'company?type=' . $get['type'] .
                '&service=' . $get['service'] .
                '&reg=' . $get['reg'] .
                '&stx=' . $get['stx'] .
                '&redirected=1'; // 리다이렉트 플래그 추가
            header("Location: $redirectUrl");
            exit; // 리다이렉트 후 스크립트 종료
        }

        return render('app/company/company', $data);
    }

    // 이사업체 상세
    public function companyView(): string
    {
        $get = $this->request->getGet();

        $infoData = (new CompanyModel())->getCompanyByIdxC($get['idx']);

        if (empty($infoData)) {
            return (new ErrorController())->errorMessage('존재하지 않는 페이지 입니다.', null, true);
        }

        // 조회수++
        (new CompanyModel())->updateReadCnt($get['idx']);

        $data = [
            'pid' => 'app_company_view',
            'infoData' => $infoData,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ];

        return render('app/company/company_view', $data);
    }


}