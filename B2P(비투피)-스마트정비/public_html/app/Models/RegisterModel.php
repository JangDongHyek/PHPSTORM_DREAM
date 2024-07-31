<?php namespace App\Models;

use App\Models\MemberModel;
use CodeIgniter\Model;


class RegisterModel extends Model {

    public function chkCompanyNo($data){
        $company_no = trim($data['company_no']);
        $company_no = str_replace("-", "", $company_no);

        $sql = "select * from `member_list` where `cp_no` = '$company_no'";
        $row = sql_fetch($sql);
        if(!empty($row)){
            return [
                'code' => 400, 'msg'=>'이미 등록된 사업자 번호입니다.', 'err_id'=>'chk_company'
            ];
        }

        $company_name = trim($data['company_name']);
        $company_owner = trim($data['company_owner']);

        $company_open = trim($data['company_open']);
        $company_open = str_replace("-", "", $company_open);

        $serviceKey = "EhuKcVgSsZl6OJ70dgwO%2BRUXcwcPx0xqHS4NdmINEzxjPWAdhjHECULpT89cR2iO0WxCJiw5ee%2Fi38c39fBPvw%3D%3D";
        $url = "https://api.odcloud.kr/api/nts-businessman/v1/validate?serviceKey=" . $serviceKey;

        $data = [
            "businesses" => [
                [
                    "b_no" => $company_no,
                    "start_dt" => $company_open,
                    "p_nm" => $company_owner,
                ]
            ]
        ];

        $options = [
            'http' => [
                'header' => "Content-Type: application/json\r\n" .
                    "Accept: */*\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if ($response['status_code'] === 'OK' && isset($response['data'][0]['valid']) && $response['data'][0]['valid'] === '01') {
            return [
                'code' => 200, 'msg'=>''
            ];
        } else {
            return [
                'code' => 400, 'msg'=>'인증에 실패하였습니다. 사업자 번호를 확인해주세요.', 'err_id'=>'chk_company'
            ];
        }
    }

    public function chkSellerForm($data){
        $memberModel = new MemberModel();
        $result = $memberModel->checkCompanyData($data);
        return $result;
    }

    public function chkBasicForm($data){
        $memberModel = new MemberModel();
        $result = $memberModel->checkBasicData($data);
        return $result;
    }

    public function chkMiniShop($data){
        $memberModel = new MemberModel();
        $result = $memberModel->checkMiniShop($data);
        return $result;
    }

    public function chkAgreeForm($data){

        $requiredFields = ['essAgr01', 'essAgr02', 'essAgr03','essAgr04','essAgr05'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || $data[$field] != 'T') {
                return ['code' => 400, 'msg' => '필수 동의 항목에 체크해주세요.', 'err_id' => $field];
            }
        }

        $session = session();
        $session->set("privacy_collection_agreement",$data['privacy_collection_agreement']);
        $session->set("market_discount_agreement",$data['market_discount_agreement']);
        $session->set("credit_card_promotion_agreement",$data['credit_card_promotion_agreement']);
        
        return ['code' => 200, 'msg' => ''];

    }

    public function chkAccountForm($data){
        $memberModel = new MemberModel();
        $result = $memberModel->checkAccountForm($data);
        return $result;

    }

    public function registerMember($data){
        $memberModel = new MemberModel();
        $result = $memberModel->checkRegisterMember($data);
        if($result['code'] != 200){
            return $result;
        }
        $result = $memberModel->setMember($result['data']);
        return $result;
    }
}
