<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\CallRecordModel;
use App\Models\CompanyModel;
use App\Models\MemberModel;
use CodeIgniter\HTTP\ResponseInterface;

class ACompanyController extends BaseController
{
    // 이사업체 등록
    public function companyForm($idx = 0): string
    {
        $get = $this->request->getGet();

        if(isset($get['idx'])){
            $companyInfo = (new CompanyModel())->getCompanyByIdxC($get['idx']);
        }

        $data = [
            'pid' => 'adm_company_form',
            'isAdmPage' => true,
            'sigu' => getSiGuData(null, true) ?? [],
            'idx' => $idx,
            'companyInfo' => $companyInfo ?? []
        ];

        return render('adm/company/company_form', $data);
    }

    // 이사업체 관리
    public function company(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'cp_type' => $get['dtRange'],
            'admin' => 'Y',
        ];
        $resultData = (new CompanyModel())->getCompanyList($param);

        $data = array_merge($resultData,[
            'param' => $param,
            'pid' => 'adm_company',
            'isAdmPage' => true,
        ]);

        return render('adm/company/company', $data);
    }

    // 안심번호 통계
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
            'admin' => 'Y'
        ];

        // 수신 상세내역
        $resultData = $callRecordModel->getCallingByNumList($param);
        // 총 수신건수, 월 , 일
        $totalReceived = $callRecordModel->getTotalReceived($param);

        $data = array_merge($resultData,[
            'pid' => 'adm_callStat',
            'isAdmPage' => true,
            'totalReceived' => $totalReceived,
            'param' => $param
        ]);

        return render('adm/callStat/call_stat', $data);
    }

    // 이사업체 복사(지역 변경)
    public function postCompanyAddition():ResponseInterface
    {
        $post = $this->request->getPost();
        if($post['mbIdx']){
            $companyInfo = (new MemberModel())->getCompanyByIdx($post['mbIdx']);
        }else{
            $companyInfo = (new CompanyModel())->getCompanyByIdxC($post['idx']);
        }
        $company = [
            'mb_idx' => $post['mbIdx'] ?? $companyInfo['mb_idx'],
            'company_name' => $companyInfo['company_name'], //업체명
            'area_si' => $post['areaSi'], //지역
            'area_gu' => $post['areaGu'], //구
            'zip_code' => $companyInfo['zip_code'], //우편번호
            'addr' => $companyInfo['addr'], //주소
            'addr_detail' => $companyInfo['addr_detail'], //상세 주소
            'cp_tel' => $companyInfo['cp_tel'], // 연락처
            'cp_desc' => $companyInfo['cp_desc'], //간단설명
            'service_type' => !empty($post['service_type']) ? $post['service_type'] : $companyInfo['service_type'], //서비스 콘마로 구분
            'grant' => $companyInfo['grant'], //관허
            'main_img' => $companyInfo['main_img'], // 이미지
            'shorts_video' => $companyInfo['shorts_video'], // 이미지
            'hompage_link' => $companyInfo['hompage_link'], // 홈페이지
            'blog_link' => $companyInfo['blog_link'], //블로그
            'instar_link' => $companyInfo['instar_link'], //인스타
            'youtube_link' => $companyInfo['youtube_link'],// 유튜브
            'tiktok_link' => $companyInfo['tiktok_link'], // 틱톡
            'service_desc' => $companyInfo['service_desc'], //서비스 설명
            'cp_type' => $post['cpType'], //서비스 설명
        ];

        $resultData['result'] = (new CompanyModel())->insertData($company);

        return $this->response->setJSON($resultData);
    }

}