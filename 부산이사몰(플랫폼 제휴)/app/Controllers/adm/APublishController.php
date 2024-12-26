<?php
namespace App\Controllers\adm;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class APublishController extends BaseController
{
    /**
     * 관리자 퍼블리싱 컨트롤러
     */

    // 인덱스
    public function index(): string
    {
        $data = [
            'pid' => 'adm_index',
            'isAdmPage' => true,
        ];

        return render('adm/index', $data);
    }






    // 이사업체 관리
    public function company(): string
    {
        $data = [
            'pid' => 'adm_company',
            'isAdmPage' => true,
        ];

        return render('adm/company', $data);
    }



    // 이사 홈서비스 관리
    public function service(): string
    {
        $data = [
            'pid' => 'adm_service',
            'isAdmPage' => true,
        ];

        return render('adm/service', $data);
    }

    // 이사 홈서비스 등록
    public function serviceForm(): string
    {
        $data = [
            'pid' => 'adm_service_form',
            'isAdmPage' => true,
        ];

        return render('adm/service_form', $data);
    }




    // 광고배너관리
    public function banner(): string
    {
        $data = [
            'pid' => 'adm_banner',
            'isAdmPage' => true,
        ];

        return render('adm/banner', $data);
    }

    // 광고배너등록
    public function bannerForm(): string
    {
        $data = [
            'pid' => 'adm_banner_form',
            'isAdmPage' => true,
        ];

        return render('adm/banner_form', $data);
    }




}