<?php namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\RegisterModel;

class RegisterController extends BaseController {
    
    //판매회원가입
    public function seller()
    {
        $this->data['pid'] = 'seller';
        return view('signup/seller',$this->data);
    }
    
    //사업자번호인증
    public function corpSellerCheck()
    {
        $this->data['pid'] = 'corpSellerCheck';
        $session = session();
        $this->data['company_no'] = $session->get('company_no');
        $this->data['company_name'] = $session->get('company_name');
        $this->data['company_owner'] = $session->get('company_owner');
        $this->data['company_open'] = $session->get('company_open');

        return view('signup/corpSellerCheck',$this->data);
    }

    // 사업자번호 체크 아작스
    public function chkCompanyNo(){
        $company_no = trim($this->data['company_no']);
        $company_name = trim($this->data['company_name']);
        $company_owner = trim($this->data['company_owner']);
        $company_open = trim($this->data['company_open']);
        if (preg_match('/^\d{10}$/', $company_no)) {
            $registerModel = new RegisterModel();
            $result = $registerModel->chkCompanyNo($this->data);
            if($result['code'] == 200){
                $session = session();
                $session->set("company_no",$company_no);
                $session->set("company_name",$company_name);
                $session->set("company_owner",$company_owner);
                $session->set("company_open",$company_open);
            }
            $return = $result;
        } else {
            $return = array("msg"=>"사업자번호는 10자리 숫자만 입력 가능합니다.", "code"=>400, "err_id"=>"company_no");
        }
        return $this->response->setJSON($return);
    }
    
    //휴대폰인증
    public function selfCerti()
    {
        $this->data['pid'] = 'selfCerti';
        if($this->checkPage("selfCerti")){
            return redirect()->to("/");
        }
        set_cookie("isAuth", "T", 300);

        $session = session();
        $this->data['company_no'] = $session->get('company_no');
        $this->data['company_name'] = $session->get('company_name');
        $this->data['company_owner'] = $session->get('company_owner');
        $this->data['company_open'] = $session->get('company_open');

        return view('signup/selfCerti',$this->data);
    }



    
    //약관동의
    public function regiAgr()
    {
        $this->data['pid'] = 'regiAgr';
        if($this->checkPage("regiAgr")){
            return redirect()->to("/");
        }

        $session = session();
        $this->data['privacy_collection_agreement'] = $session->get('privacy_collection_agreement');
        $this->data['market_discount_agreement'] = $session->get('market_discount_agreement');
        $this->data['credit_card_promotion_agreement'] = $session->get('credit_card_promotion_agreement');
        return view('signup/regiAgr',$this->data);
    }

    public function chkAgreeForm(){
        $registerModel = new RegisterModel();
        $result = $registerModel->chkAgreeForm($this->data);
        return $this->response->setJSON($result);
    }

    
    //사업자정보 사업자등록 추가 입력
    public function infoSeller()
    {
        $this->data['pid'] = 'infoSeller';
        $session = session();
        $this->data['company_no'] = $session->get('company_no');
        $this->data['company_name'] = $session->get('company_name');
        $this->data['company_owner'] = $session->get('company_owner');
        $this->data['company_open'] = $session->get('company_open');


        return view('signup/infoSeller',$this->data);
    }

    // 사업자 추가정보 체크 아작스
    public function chkSellerForm(){
        $registerModel = new RegisterModel();
        $result = $registerModel->chkSellerForm($this->data);
        return $this->response->setJSON($result);
    }
    
    //기본정보 입력
    public function infoBasic()
    {
        $this->data['pid'] = 'infoBasic';
        $session = session();
        $this->data['company_no'] = $session->get('company_no');
        $this->data['company_name'] = $session->get('company_name');
        $this->data['company_owner'] = $session->get('company_owner');
        $this->data['company_open'] = $session->get('company_open');
        $this->data['mb_name'] = $session->get('auth_name');
        $this->data['mb_hp'] = $session->get('auth_hp');

        $this->data['email_list'] = get_email_list();

        return view('signup/infoBasic',$this->data);
    }

    // 기본정보 체크 아작스
    public function chkBasicForm(){
        $registerModel = new RegisterModel();
        $result = $registerModel->chkBasicForm($this->data);
        return $this->response->setJSON($result);
    }

    // 회원가입시 중복확인
    public function chkDuplicateMbId(){
        $memberModel = new MemberModel();
        $result = $memberModel->checkDuplicateMbId($this->data);
        return $this->response->setJSON($result);
    }
    
    //판매정보 입력
    public function infoSale()
    {
        $this->data['pid'] = 'infoSale';
        if($this->checkPage("infoSale")){
            return redirect()->to("/");
        }

        $session = session();
        $this->data['seller_gmarket'] = $session->get('seller_gmarket');
        $this->data['seller_action'] = $session->get('seller_action');
        $this->data['store_url'] = $session->get('store_url');

        return view('signup/infoSale',$this->data);
    }
    
    // 판매정보 체크 아작스
    public function chkMiniShop(){
        $registerModel = new RegisterModel();
        $result = $registerModel->chkMiniShop($this->data);
        return $this->response->setJSON($result);
    }
    
    //정산정보 입력
    public function infoAccount()
    {
        $this->data['pid'] = 'infoAccount';
        if($this->checkPage("infoAccount")){
            return redirect()->to("/");
        }
        $session = session();
        $this->data['company_no'] = $session->get('company_no');
        $this->data['bank_list'] = get_bank_list();
        return view('signup/infoAccount',$this->data);
    }

    // 정상정보 체크 아작스
    public function chkAccountForm(){
        $registerModel = new RegisterModel();
        $result = $registerModel->chkAccountForm($this->data);
        return $this->response->setJSON($result);
    }

    public function registerMember(){
        $registerModel = new RegisterModel();
        $result = $registerModel->registerMember($this->data);
        return $this->response->setJSON($result);
    }
    
    // 가입완료
    public function signComp()
    {
        $this->data['pid'] = 'signComp';
        return view('signup/signComp',$this->data);
    }

    public function checkPage($page){
        return false;
        $session = session();

        $required_keys = [
            'infoSale' => ['company_no', 'company_name', 'company_owner', 'company_open'],
            'selfCerti' => ['company_no', 'company_name', 'company_owner', 'company_open', 'store_url'],
            'regiAgr' => ['company_no', 'company_name', 'company_owner', 'company_open', 'store_url','auth_ci','auth_di'],
            'infoSeller'=> ['company_no', 'company_name', 'company_owner', 'company_open', 'store_url','auth_ci','auth_di','privacy_collection_agreement','market_discount_agreement','credit_card_promotion_agreement'],
            'infoBasic'=>['company_no', 'company_name', 'company_owner', 'company_open', 'store_url','auth_ci','auth_di','privacy_collection_agreement','market_discount_agreement','credit_card_promotion_agreement'],
            'infoAccount'=>['company_no', 'company_name', 'company_owner', 'company_open', 'store_url','auth_ci','auth_di','privacy_collection_agreement','market_discount_agreement','credit_card_promotion_agreement','mb_id','mb_hp']
        ];

        if (array_key_exists($page, $required_keys)) {
            foreach ($required_keys[$page] as $key) {
                if (!$session->has($key)) {
                    return true;
                }
            }
        }

        return false;
    }
}
