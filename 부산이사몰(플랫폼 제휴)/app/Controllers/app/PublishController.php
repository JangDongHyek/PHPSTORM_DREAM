<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class PublishController extends BaseController
{
    /**
     * 퍼블리싱 컨트롤러
     */

    //  이용약관
    public function provision(): string
    {
        $data = [
            'pid' => 'app_provision',
        ];

        return render('app/provision', $data);
    }

    // 개인정보처리방침
    public function privacy(): string
    {
        $data = [
            'pid' => 'app_privacy',
        ];

        return render('app/privacy', $data);
    }


    // 이사업체 목록
    public function company(): string
    {
        $data = [
            'pid' => 'app_company',
        ];

        return render('app/company', $data);
    }

    // 이사업체 상세
    public function companyView(): string
    {
        $data = [
            'pid' => 'app_company_view',
        ];

        return render('app/company_view', $data);
    }


    // 홈서비스 목록
    public function service(): string
    {
        $data = [
            'pid' => 'app_service',
        ];

        return render('app/service', $data);
    }

    // 홈서비스 상세
    public function serviceView(): string
    {
        $data = [
            'pid' => 'app_service_view',
        ];

        return render('app/service_view', $data);
    }


    // 기본게시판
    public function board(): string
    {
        $data = [
            'pid' => 'app_board',
        ];

        return render('app/board', $data);
    }


    // 일반회원 > 나의 이사견적
    public function estimateMy(): string
    {
        $data = [
            'pid' => 'app_estimate_my',
        ];

        return render('app/estimate_my', $data);
    }

    // 일반회원 > 관심 업체
    public function wish(): string
    {
        $data = [
            'pid' => 'app_wish',
        ];

        return render('app/wish', $data);
    }


    // 사업자 > 결제 내역
    public function adPayment(): string
    {
        $data = [
            'pid' => 'app_ad_payment',
        ];

        return render('app/ad_payment', $data);
    }




    // 이사 계약시 유의사항
    public function guideline(): string
    {
        $data = [
            'pid' => 'app_guideline',
        ];

        return render('app/guideline', $data);
    }

    // 이사전 체크리스트
    public function checklist(): string
    {
        $data = [
            'pid' => 'app_checklist',
        ];

        return render('app/checklist', $data);
    }

    // 서비스 진행과정
    public function process(): string
    {
        $data = [
            'pid' => 'app_process',
        ];

        return render('app/process', $data);
    }


}