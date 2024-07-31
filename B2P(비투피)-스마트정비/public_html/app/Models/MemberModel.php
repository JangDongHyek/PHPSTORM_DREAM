<?php namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model {

    public function checkRegisterMember($data){
        $session = session();

        // 필수로 체크하지 않을 항목들
        $optionalKeys = [
            'market_discount_agreement',
            'credit_card_promotion_agreement',
            'privacy_collection_agreement',
            'cp_addr2',
            'cp_addr3',
            'cp_addr4'
        ];

        // 필수로 체크해야 하는 세션 값들
        $sessionValues = [
            'mb_id' => $session->get('mb_id'),
            'mb_password' => $session->get('mb_password'),
            'mb_name' => $session->get('mb_name'),
            'mb_email' => $session->get('mb_email'),
            'mb_hp' => $session->get('mb_hp'),
            'cp_file' => $session->get('cp_file'),
            'cp_no' => $session->get('company_no'),
            'cp_name' => $session->get('company_name'),
            'cp_hp' => $session->get('auth_hp'),
            'cp_ci' => $session->get('auth_ci'),
            'cp_di' => $session->get('auth_di'),
            'cp_owner' => $session->get('company_owner'),
            'cp_open' => $session->get('company_open'),
            'cp_email' => $session->get('cp_email'),
            'cp_zip' => $session->get('cp_zip'),
            'cp_addr1' => $session->get('cp_addr1'),
            'business_type' => $session->get('business_type'),
            'business_item' => $session->get('business_item'),
            'mall_register_no' => $session->get('mall_register_no'),
            'bank_code' => $session->get('bank_code'),
            'bank_num' => $session->get('bank_num'),
            'bank_owner' => $session->get('bank_owner'),
            'store_url' => $session->get('store_url'),
            'seller_gmarket' => $session->get('seller_gmarket'),
            'seller_action' => $session->get('seller_action')
        ];

        // 데이터와 세션 값을 비교하여 존재 여부를 확인합니다.
        foreach ($sessionValues as $key => $value) {
            if (empty($value)) {
                // 모든 세션 값을 삭제합니다.
                $this->unsetSessionValues();
                return ['code' => 400, 'msg' => "회원가입은 2시간내로 끝내야합니다. 처음부터 다시 시도해주세요.", 'err_id' => $key, 'd'=>$session->get('mb_id')];
            }
        }

        // 세션 값을 데이터에 추가
        $mergedData = array_merge($data, $sessionValues);

        // 옵션 값을 데이터에 추가
        foreach ($optionalKeys as $key) {
            $mergedData[$key] = $session->get($key);
        }

        $mergedData['w'] = "";
        $mergedData['mb_level'] = "2";
        $mergedData['mb_type'] = "제조사";
        $mergedData['is_sign'] = "N";
        $mergedData['is_user_register'] = "Y"; // 유저가 직접 가입 여부

        return ['code' => 200, 'msg' => '', 'data'=>$mergedData];
    }

    private function unsetSessionValues() {
        $session = session();
        $sessionValues = [
            'mb_id', 'mb_password', 'mb_name', 'mb_email', 'mb_hp', 'mb_kakao', 'cp_email', 'cp_zip', 'cp_addr1', 'cp_addr2', 'auth_name','auth_birthdate','auth_di','auth_hp','auth_ci',
            'cp_addr3', 'cp_addr4', 'business_type', 'business_item', 'mall_register_no', 'bank_code', 'bank_num', 'bank_owner',
            'store_url', 'seller_gmarket', 'seller_action', 'market_discount_agreement', 'credit_card_promotion_agreement',
            'privacy_collection_agreement','company_no','company_name','company_owner','company_open'
        ];

        foreach ($sessionValues as $key) {
            $session->remove($key);
        }
    }

    public function setMember($data){
        extract($data);

        $business_item = implode(",",$business_item);
        $business_type = implode(",", $business_type);
        if(!empty($mb_email_domain)){
            $mb_email = $mb_email."@".$mb_email_domain;
        }
        if(!empty($cp_email_domain)){
            $cp_email = $cp_email."@".$cp_email_domain;
        }

        $sql_c = " `mb_name` = '{$mb_name}', `mb_email` = '{$mb_email}', `mb_hp` = '{$mb_hp}', `mb_kakao` = '{$mb_kakao}', `cp_no` = '{$cp_no}', `cp_email` = '{$cp_email}',
                    `cp_name` = '{$cp_name}', `cp_hp` = '{$cp_hp}', `cp_owner` = '{$cp_owner}', `cp_open` = '{$cp_open}', `business_type` = '{$business_type}', `business_item` = '{$business_item}',
                    `mb_type` = '{$mb_type}', `mb_level` = '{$mb_level}', `mall_register_no` = '{$mall_register_no}',
                    `store_name` = '{$store_name}', `store_intro` = '{$store_intro}', `store_url` = '{$store_url}', `seller_gmarket` = '{$seller_gmarket}', `seller_action` = '$seller_action',
                    `cp_zip` = '{$cp_zip}', `cp_addr1` = '{$cp_addr1}', `cp_addr2` = '{$cp_addr2}', `cp_addr3` = '{$cp_addr3}', `cp_addr4` = '{$cp_addr4}',
                    `bank_code` = '{$bank_code}', `bank_owner` = '{$bank_owner}', `bank_num` = '{$bank_num}', `charge_platform` = '{$charge_platform}',
                    `charge_mall` = '{$charge_mall}', `charge_pg` = '{$charge_pg}', `debit_approval` = '{$debit_approval}'";

        if (isset($market_discount_agreement)) {
            $sql_c .= ", `market_discount_agreement` = '{$market_discount_agreement}'";
        }
        if (isset($credit_card_promotion_agreement)) {
            $sql_c .= ", `credit_card_promotion_agreement` = '{$credit_card_promotion_agreement}'";
        }
        if (isset($privacy_collection_agreement)) {
            $sql_c .= ", `privacy_collection_agreement` = '{$privacy_collection_agreement}'";
        }
        if (isset($is_sign)) {
            $sql_c .= ", `is_sign` = '{$is_sign}'";
        }
        if (isset($cp_file)) {
            $sql_c .= ", `cp_file` = '{$cp_file}'";
        }

        if (isset($cp_ci)) {
            $sql_c .= ", `cp_ci` = '{$cp_ci}'";
        }

        if (isset($cp_di)) {
            $sql_c .= ", `cp_di` = '{$cp_di}'";
        }

        if ($w == "") {
            // 유저가 직접 가입한거라면 패스워드 암호화를 안함
            if(!isset($is_user_register) || $is_user_register != "Y"){
                $mb_password = password_hash($mb_password, PASSWORD_DEFAULT);
            }
            $sql_c .= ", `mb_id` = '{$mb_id}', `mb_password` = '{$mb_password}'";

            $sql = "insert into `member_list` set $sql_c";
            sql_query($sql);
        } else if ($w == "u") {
            $session = session();
            $edit_mb_id = $session->get("edit_mb_id");
            if($edit_mb_id != $mb_id){
                return ['code' => 400, 'msg' => '잘못된 접근입니다.'];
            }

            if (!empty($mb_password)) {
                $mb_password = password_hash($mb_password, PASSWORD_DEFAULT);
                $sql_c .= ", `mb_password` = '{$mb_password}'";
            }
            $sql = "update `member_list` set $sql_c where `mb_id` = '{$mb_id}'";
            sql_query($sql);
        }

        $session = session();
        if (!$session->get('is_login')) {
            $this->unsetSessionValues();
        }

        return ['code' => 200, 'msg' => ''];
    }

    // 본인 데이터만 접근 및 수정 가능
    // 레벨이 10레벨 이라면 체크 안함
    public function isMyMemberData($data){
        $session = session();
        $ss_mb_no = $session->get("in_mb_no");
        $ss_mb_level = $session->get("in_mb_level");

        if ($ss_mb_level != 10) {
            $w = $data['w'];
            if($w == "u") {
                $mb_no = $data['mb_no'];
                if ($ss_mb_no != $mb_no) {
                    return ['code' => 400, 'msg' => '본인 데이터만 수정 가능합니다.'];
                }
            }
        }

        return ['code' => 200, 'msg' => ''];
    }

    public function checkCompanyData($data){
        try {
            $data['cp_file'] = saveFile(base_path("/data/file/cp_member"), "cp_file");
        } catch (\Throwable  $e) {
            if($data['w'] == "") {
                if($e->getMessage() == UPLOAD_ERR_NO_FILE){
                    return ['code'=> 400, 'msg'=>'사업자 등록증은 필수입니다.', 'err_id'=>'cp_file'];
                } else {
                    return ['code'=>400, 'msg'=>$e->getMessage(), 'err_id'=>'cp_file'];
                }
            }
        }

        if(empty($data['cp_zip'])){
            return ['code' => 400, 'msg' => '회사주소를 올바르게 입력해주세요.', 'err_id'=>'cp_addr1'];
        }

        if(empty($data['cp_addr1'])){
            return ['code' => 400, 'msg' => '회사 주소를 확인해주세요.', 'err_id'=>'cp_addr1'];
        }

        $business_type = $data['business_type'];
        $business_item = $data['business_item'];
        if(empty($business_type[0])){
            return ['code' => 400, 'msg' => '업태를 하나 이상 입력해주세요.', 'err_id'=>'business_type', 'data'=>$data];
        }

        if(empty($business_item[0])){
            return ['code' => 400, 'msg' => '종목을 하나 이상 입력해주세요.', 'err_id'=>'business_item', 'data'=>$data];
        }

        if(empty($data['mall_register_no'])){
            return ['code' => 400, 'msg' => '통신판매업 신고번호를 확인해주세요.', 'err_id'=>'mall_register_no'];
        }

        if($data['w'] == ""){
            $session = session();
            $session->set("cp_file",$data['cp_file']);
            $session->set("cp_zip",$data['cp_zip']);
            $session->set("cp_addr1",$data['cp_addr1']);
            $session->set("cp_addr2",$data['cp_addr2']);
            $session->set("cp_addr3",$data['cp_addr3']);
            $session->set("cp_addr4",$data['cp_addr4']);

            $session->set("business_type", $business_type);
            $session->set("business_item", $business_item);
            $session->set("mall_register_no",$data['mall_register_no']);
        }


        return ['code' => 200, 'msg' => '', 'err_id'=>''];
    }

    public function checkAccountForm($data){
        if(empty($data['bank_owner'])){
            return ['code' => 400, 'msg' => '예금주명을 확인해주세요.', 'err_id'=>'bank_owner'];
        }

        if(empty($data['bank_num'])){
            return ['code' => 400, 'msg' => '계좌번호를 확인해주세요.', 'err_id'=>'bank_num'];
        }

        if(empty($data['bank_code'])){
            return ['code' => 400, 'msg' => '은행을 선택해주세요.', 'err_id'=>'bank_code'];
        }

        if($data['w'] == ""){
            $session = session();
            $session->set("bank_code",$data['bank_code']);
            $session->set("bank_num",$data['bank_num']);
            $session->set("bank_owner",$data['bank_owner']);
        }


        return ['code' => 200, 'msg' => '', 'err_id'=>''];
    }

    public function checkBasicData($data){
        $session = session();

        // 유저 아이디 체크
        if ($data['w'] == ""){
            $result = $this->checkDuplicateMbId($data);
            if($result['code'] != 200){
                return $result;
            }
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $data['mb_id'])) {
            return ['code' => 400, 'msg' => '아이디는 알파벳, 숫자, 밑줄만 포함할 수 있습니다.', 'err_id'=>'mb_id'];
        }

        // 비밀번호 체크
        if(empty($data['mb_password'])) {
            if ($data['w'] == ""){
                return ['code' => 400, 'msg' => '비밀번호는 빈값이면 안 됩니다.', 'err_id'=>'mb_password'];
            }
        }

        if($data['mb_password'] != $data['mb_password2']){
            if ($data['w'] == ""){
                return ['code' => 400, 'msg' => '비밀번호가 일치 하지 않습니다.', 'err_id'=>'mb_password2'];
            }
        }
        $mb_password = password_hash($data['mb_password'], PASSWORD_DEFAULT);

        // 회사 이메일체크 
        if(empty($data['cp_email'])){
            return ['code' => 400, 'msg' => '회사 이메일 주소를 올바르게 입력해주세요.', 'err_id'=>'cp_email_domain'];
        }

        if(empty($data['cp_email_domain'])){
            return ['code' => 400, 'msg' => '회사 이메일 주소를 올바르게 입력해주세요.', 'err_id'=>'cp_email_domain'];
        }
        $cp_email = $data['cp_email']."@".$data['cp_email_domain'];
        if (!filter_var($cp_email, FILTER_VALIDATE_EMAIL)) {
            return ['code' => 400, 'msg' => '유효한 회사 이메일 주소를 입력해 주세요.', 'err_id'=>'cp_email_domain'];
        }

        // 회사 휴대폰 및 일반 전화번호 검증
        if (!preg_match('/^(?:(?:010|011|016|017|018|019|02|0[3-9]{1}\d{1})-(?:\d{3,4})-\d{4})$/', $data['cp_hp'])) {
            return ['code' => 400, 'msg' => '회사 연락처를 확인해주세요.', 'err_id'=>'cp_hp'];
        }

        // 실무자 이름 체크
        if(empty($data['mb_name'])){
            return ['code' => 400, 'msg' => '실무자 이름이 빈값이면 안 됩니다.', 'err_id'=>'mb_name'];
        }

        $mb_name = $session->get("auth_name");

        if($data['mb_name'] != $mb_name){
            return ['code' => 400, 'msg' => '실무자 이름이 다릅니다..', 'err_id'=>'mb_name'];
        }

        // 실무자 메일 체크
        if(empty($data['mb_email'])){
            return ['code' => 400, 'msg' => '실무자 이메일 주소를 올바르게 입력해주세요.', 'err_id'=>'mb_email_domain'];
        }

        if(empty($data['mb_email_domain'])){
            return ['code' => 400, 'msg' => '실무자 이메일 주소를 올바르게 입력해주세요.', 'err_id'=>'mb_email_domain'];
        }

        $mb_email = $data['mb_email']."@".$data['mb_email_domain'];
        if (!filter_var($mb_email, FILTER_VALIDATE_EMAIL)) {
            return ['code' => 400, 'msg' => '유효한 실무자 이메일 주소를 입력해 주세요.', 'err_id'=>'mb_email_domain'];
        }

        // 휴대폰 및 일반 전화번호 검증
        if (!preg_match('/^(?:(?:010|011|016|017|018|019|02|0[3-9]{1}\d{1})-(?:\d{3,4})-\d{4})$/', $data['mb_hp'])) {
            return ['code' => 400, 'msg' => '실무자 연락처를 확인해주세요.', 'err_id'=>'mb_hp'];
        }

        $mb_hp = $session->get("auth_hp");
        if ($data['mb_hp'] != $mb_hp) {
            return ['code' => 400, 'msg' => '실무자 연락처를 확인해주세요.', 'err_id'=>'mb_hp'];
        }

        if($data['w'] == ""){
            $session->set("cp_email",$cp_email);
            $session->set("mb_id",$data['mb_id']);
            $session->set("mb_password",$mb_password);
            $session->set("mb_name",$data['mb_name']);
            $session->set("mb_email",$mb_email);
            $session->set("mb_hp",$data['mb_hp']);
        }



        return ['code' => 200, 'msg' => '', 'err_id'=>''];
    }

    public function checkMiniShop($data){
        if($data['seller_gmarket'] == 'F' && $data['seller_action'] == 'F'){
            return ['code' => 400, 'msg' => 'G마켓/옥션 판매자여야 합니다.', 'err_id'=>'seller_action'];
        }

        if (empty($data['store_url'])) {
            return ['code' => 400, 'msg' => '스토어/미니샵 URL을 입력해주세요.', 'err_id' => 'store_url'];
        }

        if (!filter_var($data['store_url'], FILTER_VALIDATE_URL)) {
            return ['code' => 400, 'msg' => '유효한 URL을 입력해주세요.', 'err_id' => 'store_url'];
        }

        if($data['w'] == ""){
            $session = session();
            $session->set("seller_gmarket",$data['seller_gmarket']);
            $session->set("seller_action",$data['seller_action']);
            $session->set("store_url",$data['store_url']);
        }


        return ['code' => 200, 'msg' => ''];
    }

    public function checkDuplicateMbId($data){
        $data['mb_id'] = trim($data['mb_id']);

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $data['mb_id'])) {
            return ['code' => 400, 'msg' => '아이디는 알파벳, 숫자, 밑줄만 포함할 수 있습니다.', 'err_id'=>'mb_id'];
        }

        if(empty($data['mb_id'])){
            return ['code' => 400, 'msg' => '아이디가 빈값입니다.', 'err_id'=>'mb_id'];
        }

        $mb = $this->getMember($data['mb_id']);
        if(!empty($mb)){
            return ['code' => 400, 'msg' => '이미 존재하는 아이디 입니다.', 'err_id'=>'mb_id'];
        }
        return ['code' => 200, 'msg' => '사용 가능한 아이디 입니다.', 'err_id'=>'mb_id'];
    }

    public function checkMemberData($data){
        $result = $this->isMyMemberData($data);
        if($result['code'] != 200 ){
            return $result;
        }

        $result = $this->checkBasicData($data);
        if($result['code'] != 200){
            return $result;
        }

        $result = $this->checkMiniShop($data);
        if($result['code'] != 200){
            return $result;
        }

        $result = $this->checkAccountForm($data);
        if($result['code'] != 200){
            return $result;
        }

        $result = $this->checkCompanyData($data);
        if($result['code'] != 200){
            return $result;
        }

        


        return ['code' => 200, 'msg' => '', 'data'=> $data];
    }

    public function getMemberList($data){
        $return_data = [];
        $where = " where `mb_level` != '10' ";

        // 현재 페이지가 직원인지 아닌지
        $member_type = $data['member_type'];
        if(empty($member_type) || $member_type == "b2p"){
            $where .= " and `mb_type` = '직원'";
        } else {
            $where .= " and `mb_type` != '직원'";
        }

        // 검색어 처리
        $sf = $data['sf'];
        $st = $data['st'];
        $sf_sign = $data['sf_sign'];

        if(!empty($sf) && !empty($st)){
            if($sf == "mb_hp" || $sf == "cp_hp" || $sf == "cp_no"){
                $st = str_replace("-","",$st);
                $where .= " and REPLACE(`$sf`, '-', '') like '%$st%'";
            } else {
                $where .= " and `$sf` like '%$st%'";
            }
        }

        if(!empty($sf_sign)){
            $where .= " and `is_sign` = '$sf_sign'";
        }
        
        // 토탈카운터 구하기
        $sql = "select * from `member_list` $where order by `mb_no` desc";
        $re = sql_query($sql);
        $total_count = sql_num_rows($re);
        $return_data['total_count'] = $total_count;

        // 실제 데이터 리스트 만들기

        // 페이지 번호와 페이지당 아이템 수 설정
        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $items_per_page = 15;
        $return_data['items_per_page'] = $items_per_page;

        // 시작 위치 계산 (0 기반 인덱스)
        $start_limit = ($page - 1) * $items_per_page;

        // 실제 데이터 리스트 만들기
        $sql = "SELECT * FROM `member_list` $where ORDER BY `mb_no` DESC LIMIT $start_limit, $items_per_page";
        $re = sql_query($sql);
        $return_data['list'] =  sql_fetch_array($re);
        return $return_data;
    }

    public function getMember($mb_id, $get_pass = false){
        return $this->getMemberId($mb_id, $get_pass);
    }

    public function getMemberId($mb_id, $get_pass = false){
        $sql = "select * from `member_list` where `mb_id` = '{$mb_id}'";
        $mb = sql_fetch($sql);
        if($get_pass == false){
            unset($mb['mb_password']);
        }
        return $mb;
    }

    public function getMemberNo($mb_no, $get_pass = false){
        $sql = "select * from `member_list` where `mb_no` = '{$mb_no}'";
        $mb = sql_fetch($sql);
        if($get_pass == false){
            unset($mb['mb_password']);
        }
        return $mb;
    }
}
