<?php

include_once('../common.php');

$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
        
    /* 관리자 로그인 */
    case 'login':
        $id = $_POST['id'];
        $password = $_POST['password'];        
        
        if($id != 'admin'){
            $result['msg'] = '아이디가 일치하지 않습니다.';
            $result['target'] = 'id';
            die(json_encode($result));
        }else if($password != 'admin0808'){
            $result['msg'] = '비밀번호가 일치하지 않습니다.';
            $result['target'] = 'password';
            die(json_encode($result));
        }
        
        setMemberSession($id);
        $result['result'] = true;
    break;
        
    /* 기사 추가/수정 */
    case 'saveDriver':
        $settingType = $_POST['settingType']; // insert, update
        $driver_id = $_POST['driver_id']; // 기사 아이디
        $driver_password = $_POST['driver_password']; // 기사 비밀번호
        $dirver_name = $_POST['dirver_name']; // 기사 이름
        $driver_hp = $_POST['driver_hp']; // 기사 연락처
        $driver_car_number = $_POST['driver_car_number']; // 기사 차량번호
        $driver_member_key = $_POST['driver_member_key']; // 기사 memberkey
        
        $setSql = "
            mb_password = '{$driver_password}',
            mb_name = '{$dirver_name}',
            mb_hp = '{$driver_hp}',
            driver_car_number = '{$driver_car_number}',
            driver_member_key = '{$driver_member_key}'
        ";
        
        // 가입시
        if($settingType == 'insert'){
            
            // 아이디 중복 체크
            $memberCnt = sql_fetch("SELECT COUNT(*) cnt FROM g5_member WHERE mb_id = '{$driver_id}';")['cnt'];
            if($memberCnt > 0){
                $result['msg'] = "이미 가입된 아이디입니다.\n다른 아이디로 진행해주세요.";
                die(json_encode($result));
            }
            
            //배송기사 필드값
            $DELIVERY = DELIVERY;
            
            $sql = "
                INSERT INTO 
                    g5_member
                SET
                    mb_type = '{$DELIVERY}',
                    mb_id = '{$driver_id}',                    
                    $setSql
            ";
        }
        // 수정시
        else{
            $sql = "
                UPDATE
                    g5_member
                SET
                    $setSql
                WHERE
                    mb_id = '{$driver_id}'
            ";
        }
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = "처리도중 문제가 발생하였습니다.\n업체에 문의해주세요.";
            die(json_encode($result));
        }
    break;
    
    /* 정보 삭제 공통 */
    case 'removeData':        
        $table = $_POST['table'];
        $idx = $_POST['idx'];
        
        $sql = "
                UPDATE
                    $table
                SET                    
                    is_use = '0'
                WHERE
                    idx = '{$idx}';
            ";
        
        $result['result'] = sql_query($sql); 
        
        if(empty($result['result'])){
            $result['msg'] = "처리도중 문제가 발생하였습니다.\n업체에 문의해주세요.";
            die(json_encode($result));
        }
    break;
        
    /* 테이블 데이터 삭제 공통 */
        
    case 'removeTableData':
        $table = $_POST['table'];
        $idxArr = $_POST['idxArr'];
        
        for($i=0; $i<count($idxArr); $i++){
            $idx = $idxArr[$i];
            
            $sql = "
                UPDATE
                    $table
                SET                    
                    is_use = '0'
                WHERE
                    idx = '{$idx}';
            ";
        
            $result['result'] = sql_query($sql); 

            if(empty($result['result'])){
                $result['msg'] = "처리도중 문제가 발생하였습니다.\n업체에 문의해주세요.";
                die(json_encode($result));
            }
        }
    break;
        
    /* 업체 정보 수정 */
    case 'companySet':
        $settingType = $_POST['settingType']; // insert, update
        $mb_id = $_POST['mb_id']; // 아이디
        $mb_password = $_POST['mb_password']; // 비밀번호
        $mb_company_name = $_POST['mb_company_name']; // 회사명
        $mb_company_tel = $_POST['mb_company_tel']; // 대표번호
        $mb_company_number = $_POST['mb_company_number']; // 사업자등록번호
        $mb_company_email = $_POST['mb_company_email']; // 이메일
        $mb_addr = $_POST['mb_addr']; // 기본주소 
        $mb_zip_code = $_POST['mb_zip_code'];
        $mb_lat = $_POST['mb_lat'];
        $mb_lng = $_POST['mb_lng']; 
        $mb_addr_detail = $_POST['mb_addr_detail']; // 상세주소
        $mb_name = $_POST['mb_name']; // 담당자 성함
        $mb_hp = $_POST['mb_hp']; // 담당자 전화번호
        $mb_name2 = $_POST['mb_name2']; // 담당자 성함
        $mb_hp2 = $_POST['mb_hp2']; // 담당자 전화번호
        $mb_name3 = $_POST['mb_name3']; // 담당자 성함
        $mb_hp3 = $_POST['mb_hp3']; // 담당자 전화번호
        $mb_name4 = $_POST['mb_name4']; // 담당자 성함
        $mb_hp4 = $_POST['mb_hp4']; // 담당자 전화번호

        $setSql = "
            mb_password = '{$mb_password}',
            mb_company_name = '{$mb_company_name}',
            mb_company_tel = '{$mb_company_tel}',
            mb_company_number = '{$mb_company_number}',
            mb_company_email = '{$mb_company_email}',
            mb_addr = '{$mb_addr}',
            mb_zip_code = '{$mb_zip_code}',
            mb_lat = '{$mb_lat}',
            mb_lng = '{$mb_lng}',
            mb_addr_detail = '{$mb_addr_detail}',
            mb_name = '{$mb_name}',
            mb_hp = '{$mb_hp}',
            mb_name2 = '{$mb_name2}',
            mb_hp2 = '{$mb_hp2}',
            mb_name3 = '{$mb_name3}',
            mb_hp3 = '{$mb_hp3}',
            mb_name4 = '{$mb_name4}',
            mb_hp4 = '{$mb_hp4}'
        ";
        
        // 가입시
        if($settingType == 'insert'){
            
            // 아이디 중복 체크
            $memberCnt = sql_fetch("SELECT COUNT(*) cnt FROM g5_member WHERE mb_id = '{$mb_id}';")['cnt'];
            if($memberCnt > 0){
                $result['msg'] = "이미 가입된 아이디입니다.\n다른 아이디로 진행해주세요.";
                die(json_encode($result));
            }
            
            //배송기사 필드값
            $CUSTOMER = CUSTOMER;
            
            $sql = "
                INSERT INTO 
                    g5_member
                SET
                    mb_type = '{$CUSTOMER}',
                    mb_id = '{$mb_id}',                    
                    $setSql
            ";
        }
        // 수정시
        else{                        
            $sql = "
                UPDATE
                    g5_member
                SET                    
                    $setSql
                WHERE
                    mb_id = '{$mb_id}'
            ";
        }        
        
        $result['result'] = sql_query($sql); 
        
        if(empty($result['result'])){
            $result['msg'] = "처리도중 문제가 발생하였습니다.\n업체에 문의해주세요.";
            die(json_encode($result));
        }
    break;
       
    /* 물품 검색 */
    case 'searchProduct':
        $request_date = $_POST['request_date']; 
        $shipping_point = $_POST['shipping_point'];                        
            
        $subUrl = '/ojc/delivery';
        $data = array(
            'wadat' => $request_date,
            'werks' => $shipping_point
        );
        
        $deliveryInfo = getRfcData($subUrl, $data);                
        $groupedArray = [];
        
        $result['deliveryInfo'] = $deliveryInfo;
        
        $deliveryInfo = $deliveryInfo['delivery_info'];
        
        if(!count($deliveryInfo)){
            $result['msg'] = '일치하는 정보가 존재하지 않습니다.';
            die(json_encode($result));
        }              
                
        for($i=0; $i<count($deliveryInfo); $i++){
            $data = $deliveryInfo[$i];
            
            $data['from_time'] = $data['ZARFR'];
            $data['to_time'] = $data['ZARTO'];
            
            $deliveryInfo[$i] = $data;
        }
                
        // VBELN(남품문서를 기준으로 공통되는 것은 묶기)
        foreach($deliveryInfo as $item) {
            $vbeln = $item["VBELN"];
                         
            if(!isset($groupedArray[$vbeln])) {
                $groupedArray[$vbeln] = [];
            }
            
            $groupedArray[$vbeln][] = $item;
        }
        
        $result['deliveryInfo'] = $deliveryInfo;
        $result['groupedArray'] = $groupedArray;        
        $result['result'] = true;
    break;
        
    /* 업체 검색 */
    case 'searchCompany':
        $company_name = $_POST['company_name'];
        $CUSTOMER = CUSTOMER;
        
        $sql = "
            SELECT
                mb_company_name AS real_company_name,
                mb_id AS company_mb_id,
                mb_name AS customer_mb_name,
                mb_hp AS customer_mb_hp,
               mb_name2 AS customer_mb_name2,
                mb_hp2 AS customer_mb_hp2,
               mb_name3 AS customer_mb_name3,
                mb_hp3 AS customer_mb_hp3,
               mb_name4 AS customer_mb_name4,
                mb_hp4 AS customer_mb_hp4,
                mb_addr AS customer_addr,
                mb_zip_code AS customer_zip_code,
                mb_lat AS customer_lat,
                mb_lng AS customer_lng,
                mb_addr_detail AS customer_addr_detail
            FROM
                g5_member
            WHERE
                mb_company_name LIKE '%{$company_name}%' AND
                mb_type = '{$CUSTOMER}' AND
                is_use = '1'
            ORDER BY
                idx ASC
            LIMIT
                1;
        ";
        
        $companyInfo = sql_fetch($sql);
        
        if(empty($companyInfo)){
            $result['msg'] = "일치하는 업체가 존재하지 않습니다.";
            die(json_encode($result));
        }
        
        $result['companyInfo'] = $companyInfo;
        $result['result'] = true;
    break;
                
    /* 기사 조회 */
    case 'searchDelivery':
        $delivery_mb_name = $_POST['delivery_mb_name'];        
        $DELIVERY = DELIVERY;
        
        $sql = "
            SELECT
                mb_id AS delivery_mb_id,
                mb_name AS real_delivery_name,
                mb_hp AS delivery_mb_hp,
                driver_car_number AS delivery_car_number
            FROM
                g5_member
            WHERE
                mb_name LIKE '%{$delivery_mb_name}%' AND
                mb_type = '{$DELIVERY}' AND
                is_use = '1'
            ORDER BY
                idx ASC
            LIMIT
                1;
        ";
                        
        $deliveryInfo = sql_fetch($sql);
        
        if(empty($deliveryInfo)){
            $result['msg'] = "일치하는 기사정보가 존재하지 않습니다.";
            die(json_encode($result));
        }
        
        $result['deliveryInfo'] = $deliveryInfo;
        $result['result'] = true;
    break;
        
    /* 배차 하기(추가/수정) */        
    case 'saveDispatch':
        $dispatch_idx = $_POST['dispatch_idx'];
        $settingType = empty($dispatch_idx)? 'insert' : 'update';
        
        $status_code = $_POST['status_code'];
        $dis_status_code = $_POST['dis_status_code'];                
        $dis_status_text = $_POST['dis_status_text'];
        
        $request_date = $_POST['request_date'];
        $shipping_point = $_POST['shipping_point'];
        $product_string = $_POST['product_string'];
        $product_full_string = $_POST['product_full_string'];
        $product_pk = $_POST['product_pk'];
        $product_name = $_POST['product_name'];
        $product_cnt = $_POST['product_cnt'];        
        
        $company_mb_id = $_POST['company_mb_id'];
        $real_company_name = $_POST['real_company_name'];
        $customer_mb_name = $_POST['customer_mb_name'];
        $customer_mb_hp = $_POST['customer_mb_hp'];
        $customer_mb_name2 = $_POST['customer_mb_name2'];
        $customer_mb_hp2 = $_POST['customer_mb_hp2'];
        $customer_mb_name3 = $_POST['customer_mb_name3'];
        $customer_mb_hp3 = $_POST['customer_mb_hp3'];
        $customer_mb_name4 = $_POST['customer_mb_name4'];
        $customer_mb_hp4 = $_POST['customer_mb_hp4'];
        $customer_addr = $_POST['customer_addr'];
        $customer_addr_detail = $_POST['customer_addr_detail'];
        $customer_zip_code = $_POST['customer_zip_code'];
        $customer_lat = $_POST['customer_lat'];
        $customer_lng = $_POST['customer_lng'];
        
        $delivery_mb_id = $_POST['delivery_mb_id'];
        $real_delivery_name = $_POST['real_delivery_name'];
        $delivery_mb_hp = $_POST['delivery_mb_hp'];
        $delivery_car_number = $_POST['delivery_car_number'];
        $delivery_time = $_POST['delivery_time'];
		$is_alimtalk = $_POST['is_alimtalk'];
                
        $productInfo = json_decode(stripslashes($product_string), true);                
        
        
        $from_time = explode('/', $delivery_time)[0];
        $to_time = explode('/', $delivery_time)[1];
            
        $result['from_time'] = $from_time;
        $result['to_time'] = $to_time;
        
        $setSql = "
            status_code = '{$status_code}',
            dis_status_code = '{$dis_status_code}',
            dis_status_text = '{$dis_status_text}',
                        
            request_date = '{$request_date}',
            shipping_point = '{$shipping_point}',
            product_string = '{$product_string}',
            product_full_string = '{$product_full_string}',
            product_pk = '{$product_pk}',
            product_name = '{$product_name}',
            product_cnt = '{$product_cnt}',                        
            
            company_mb_id = '{$company_mb_id}',
            real_company_name = '{$real_company_name}',
            customer_mb_name = '{$customer_mb_name}',
            customer_mb_hp = '{$customer_mb_hp}',
            customer_mb_name2 = '{$customer_mb_name2}',
            customer_mb_hp2 = '{$customer_mb_hp2}',
            customer_mb_name3 = '{$customer_mb_name3}',
            customer_mb_hp3 = '{$customer_mb_hp3}',
            customer_mb_name4 = '{$customer_mb_name4}',
            customer_mb_hp4 = '{$customer_mb_hp4}',
            customer_addr = '{$customer_addr}',
            customer_addr_detail = '{$customer_addr_detail}',
            customer_zip_code = '{$customer_zip_code}',
            customer_lat = '{$customer_lat}',
            customer_lng = '{$customer_lng}',
            
            delivery_mb_id = '{$delivery_mb_id}',
            real_delivery_name = '{$real_delivery_name}',
            delivery_mb_hp = '{$delivery_mb_hp}',
            delivery_car_number = '{$delivery_car_number}',
            from_time = '{$from_time}',
            to_time = '{$to_time}'
        ";
                
        if($settingType == 'insert'){            
            $sql = "
                INSERT INTO
                    dispatch_list
                SET
                    $setSql                    
            ";
        }else{
            $sql = "
                UPDATE
                    dispatch_list
                SET
                    $setSql
                WHERE
                    idx = '{$dispatch_idx}'
            ";
        }
                
        $result['result'] = sql_query($sql); 
        
        if(empty($result['result'])){
            $result['msg'] = "처리도중 문제가 발생하였습니다.\n업체에 문의해주세요.";
            die(json_encode($result));
        }
		
		if($settingType == 'insert'){
			$dispatch_idx = sql_insert_id();
		}
        
		/* 알림톡전송 */
		if($is_alimtalk == 'Y'){
			$dateParts = explode("-", $request_date);
			
			$params = array(
				'mbName' => $customer_mb_name,
				'month' => $dateParts[1],
				'day' => $dateParts[2],
				'mainPct' => $product_name,
				'startTime' => explode(":", $from_time)[0],
				'endTime' => explode(":", $to_time)[0]
			);
			
			$result['alimTalk'] = sendAlimTalk(0, $params, $customer_mb_hp, $dispatch_idx);
			if($customer_mb_hp2) {
                $params['mbName'] = $customer_mb_name2;
                sendAlimTalk(0, $params, $customer_mb_hp2, $dispatch_idx);
            }
            if($customer_mb_hp3) {
                $params['mbName'] = $customer_mb_name3;
                sendAlimTalk(0, $params, $customer_mb_hp3, $dispatch_idx);
            }
            if($customer_mb_hp4) {
                $params['mbName'] = $customer_mb_name4;
                sendAlimTalk(0, $params, $customer_mb_hp4, $dispatch_idx);
            }
		}
		
    break;
        
    case 'getRecordList':
        $page = $_POST['page'];
        $pagingCount = $_POST['pagingCount'];
        $type = $_POST['type'];
        $mb_id = $_POST['mb_id'];
        $limit = ((int)$page - 1) * (int)$pagingCount;
        $list = array();
        
        $type = $type.'_mb_id';
        
        $sql = "
            SELECT
                *
            FROM
                dispatch_list
            WHERE
                {$type} = '{$mb_id}' AND
                status_code = '4' AND
                is_use = '1'
            ORDER BY
                complete_date DESC, idx DESC
            LIMIT
                $limit, $pagingCount
        ";
        
        $res = sql_query($sql);

        for($i = 0; $row = sql_fetch_array($res); $i++){
            $row['limit_complete_date'] = getDateFormat($row['complete_date']);
            $row['data_url'] = getSignPadUrl($row['idx']);
            
            $row['product_string'] = json_decode($row['product_string'], true);
            $row['product_full_string'] = json_decode($row['product_full_string'], true);
            
            $list[] = $row;
        }
        
        $result['list'] = $list;
    break;
}

die(json_encode($result));
?>