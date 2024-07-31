<?php

namespace App\Models\GmAc;

use CodeIgniter\Model;

class DeliveryModel extends GmAcBasicApiModel {

    // 주소록 저장
    public function setAddress($data){
        $mb_id = $data['member']['mb_id'];
        $mb_level = (int)$data['member']['mb_level'];

        $data['api_type'] = GMAC;
        $data['api_method'] = "POST";
        $data['api_url'] = "https://sa2.esmplus.com/item/v1/sellers/address";
        if(!empty($data['w'])){
            // 수정이고 직원이 아니라면 아이디 체크
            $where = "";
            if($mb_level < 9){
                $where = ", `mb_id` = {$mb_id}";
            }

            // 실제로 데이터가 있는지 체크
            $sql = "select * from `address_book_list` where `addrNo` = '{$data['addrNo']}' $where";
            $row = sql_fetch($sql);
            if(empty($row)){
                return ["code" => 400, "msg" => '일치하는 데이터가 없습니다.'];
            }
            $data['api_method'] = "PUT";
            $data['api_url'] = "https://sa2.esmplus.com/item/v1/sellers/address/{$data['addrNo']}";
        }
        $fields = ['addrName', 'representativeName','zipCode','addr1','addr2','homeTel','cellPhone','locationDescription'];
        $data['api_data'] = $this->createApiData($data, $fields);

        $result = $this->callApi($data);

        $body = json_decode($result['body'], true);

        // resultCode가 있으면 실패임
        if(!empty($body['resultCode'])){
            return ["code" => 400, "msg" => $body['message']];
        }

        if(empty($body['addrNo'])){
            return ["code" => 400, "msg" => $body['message']];
        }

        $insert_str = array_to_sql_insert_str($data['api_data']);

        if(empty($data['w'])){
            $sql = "insert into `address_book_list` set $insert_str, `addrNo` = '{$body['addrNo']}', `mb_id` = '{$mb_id}'";
            sql_query($sql);
        } else {
            // 위에서 체크 했으므로 별도로 아이디 체크는 안함
            $sql = "update `address_book_list` set $insert_str where `addrNo` = '{$data['addrNo']}'";
            sql_query($sql);
        }

        return ['code' => 200, 'msg'=>'저장하였습니다.'];
    }

    // 출고지 저장
    public function setPlaces($data){
        $mb_id = $data['member']['mb_id'];
        $mb_level = (int)$data['member']['mb_level'];

        $data['api_type'] = GMAC;
        $data['api_method'] = "POST";
        $data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/places";
        if(!empty($data['w'])){
            // 수정이고 직원이 아니라면 아이디 체크
            $where = "";
            if($mb_level < 9){
                $where = ", `mb_id` = {$mb_id}";
            }

            // 실제로 데이터가 있는지 체크
            $sql = "select * from `places_list` where `placeNo` = '{$data['placeNo']}' $where";
            $row = sql_fetch($sql);
            if(empty($row)){
                return ["code" => 400, "msg" => '일치하는 데이터가 없습니다.'];
            }
            $data['api_method'] = "PUT";
            $data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/places/{$data['placeNo']}";
        }

        $data['addrNo'] = (int) $data['addrNo'];
        $data['backwoodsAdditionalShippingFee'] = (int) $data['backwoodsAdditionalShippingFee'];
        $data['jejuAdditionalShippingFee'] = (int) $data['jejuAdditionalShippingFee'];
        $data['imposeType'] = (int) $data['imposeType'];

        $data['isSetAdditionalShippingFee'] = false;
        if(!empty($data['backwoodsAdditionalShippingFee']) || !empty($data['jejuAdditionalShippingFee'])){
            $data['isSetAdditionalShippingFee'] = true;
        }

        $data['isDefaultShippingPlace'] = false;

        $fields = ['placeName', 'addrNo','zipCode','isSetAdditionalShippingFee','backwoodsAdditionalShippingFee','jejuAdditionalShippingFee','isDefaultShippingPlace','imposeType','isDefaultShippingPlace'];
        $data['api_data'] = $this->createApiData($data, $fields);

        $result = $this->callApi($data);

        $body = json_decode($result['body'], true);

        // resultCode가 있으면 실패임
        if(!empty($body['resultCode'])){
            return ["code" => 400, "msg" => $body['message']];
        }

        if(empty($body['placeNo'])){
            return ["code" => 400, "msg" => $body['message']];
        }

        $insert_str = array_to_sql_insert_str($data['api_data']);

        if(empty($data['w'])){
            $sql = "insert into `places_list` set $insert_str, `placeNo` = '{$body['placeNo']}', `mb_id` = '{$mb_id}'";
            sql_query($sql);
        } else {
            // 위에서 체크 했으므로 별도로 아이디 체크는 안함
            $sql = "update `places_list` set $insert_str where `placeNo` = '{$data['placeNo']}'";
            sql_query($sql);
        }

        return ['code' => 200, 'msg'=>'저장하였습니다.'];
    }

    // 묶음배송 저장
    public function setBundlePolicy($data){
        $mb_id = $data['member']['mb_id'];
        $mb_level = (int)$data['member']['mb_level'];

        $data['api_type'] = GMAC;
        $data['api_method'] = "POST";
        $data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/policies";
        if(!empty($data['w'])){
            // 수정이고 직원이 아니라면 아이디 체크
            $where = "";
            if($mb_level < 9){
                $where = ", `mb_id` = {$mb_id}";
            }

            // 실제로 데이터가 있는지 체크
            $sql = "select * from `bundle_policies_list` where `policyNo` = '{$data['policyNo']}' $where";
            $row = sql_fetch($sql);
            if(empty($row)){
                return ["code" => 400, "msg" => '일치하는 데이터가 없습니다.'];
            }
            $data['api_method'] = "PUT";
            $data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/policies/{$data['policyNo']}";
        }

        $data['feeType'] = (int) $data['feeType'];
        $data['fee'] = (int) $data['fee'];
        $data['isPrepayment'] = false;      // 배송비 선결제여부
        $data['isCashOnDelivery'] = false;  // 배송비 착불여부
        if($data['payment_option'] == "1"){  // 선결제만 가능
            $data['isPrepayment'] = true;
            $data['isCashOnDelivery'] = false;
        } else if($data['payment_option'] == "2"){  // 착불/선결제 가능 가능
            $data['isPrepayment'] = true;
            $data['isCashOnDelivery'] = true;
        } else if($data['payment_option'] == "3"){  // 착불만 가능
            $data['isPrepayment'] = false;
            $data['isCashOnDelivery'] = true;
        }
        $data['placeNo'] = (int) $data['placeNo'];
        $data['isDefault'] = false;
        $data['shippingFee'] = [
            [
                'condition' => (int)$data['shippingFeeCondition']
            ]
        ];

        $fields = ['feeType', 'fee','isPrepayment','isCashOnDelivery','placeNo','isDefault','isDefaultShippingPlace','shippingFee'];
        $data['api_data'] = $this->createApiData($data, $fields);

        $result = $this->callApi($data);

        $body = json_decode($result['body'], true);

        // resultCode가 있으면 실패임
        if(!empty($body['resultCode'])){
            return ["code" => 400, "msg" => $result, "api_data" => $data['api_data']];
        }

        if(empty($body['policyNo'])){
            return ["code" => 400, "msg" => $result , "api_data" => $data['api_data']];
        }

        if (isset($data['api_data']['shippingFee'])) {
            unset($data['api_data']['shippingFee']);
        }

        $insert_str = array_to_sql_insert_str($data['api_data']);

        if(empty($data['w'])){
            $sql = "insert into `bundle_policies_list` set $insert_str, `policyNo` = '{$body['policyNo']}', `payment_option` = '{$data['payment_option']}', `shippingFeeCondition` = '{$data['shippingFeeCondition']}', `mb_id` = '{$mb_id}'";
            sql_query($sql);
        } else {
            // 위에서 체크 했으므로 별도로 아이디 체크는 안함
            $sql = "update `bundle_policies_list` set $insert_str, `shippingFeeCondition` = '{$data['shippingFeeCondition']}', `payment_option` = '{$data['payment_option']}' where `policyNo` = '{$data['policyNo']}'";
            sql_query($sql);
        }

        return ['code' => 200, 'msg'=>'저장하였습니다.'];
    }

    public function setDispatchPolicy($data){
        $mb_id = $data['member']['mb_id'];
        $mb_level = (int)$data['member']['mb_level'];

        $data['api_method'] = "POST";
        $data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/dispatch-policies";

        $data['readyDurationDay'] = (int) $data['readyDurationDay'];

        $fields = ['dispatchType', 'readyDurationDay','dispatchCloseTime'];
        $data['api_data'] = $this->createApiData($data, $fields);

        $result = $this->callApi($data);

        $body = json_decode($result['body'], true);

        // resultCode가 있으면 실패임
        if(!empty($body['resultCode'])){
            return ["code" => 400, "msg" => $result, "api_data" => $data['api_data']];
        }

        if(empty($body['dispatchPolicyNo'])){
            return ["code" => 400, "msg" => $result , "api_data" => $data['api_data']];
        }

        return ['code' => 200, 'msg'=>'저장하였습니다.'];
    }

    // 발송정책 저장
    public function setDispatchPolicy2($data){
        $api_type = $data['api_type'];
        $body = json_decode($data['body'], true);
        $dispatchPolicies = $body['dispatchPolicies'];
        for($i=0; $i<count($dispatchPolicies); $i++){
            // {"dispatchPolicyNo": 1638190, "dispatchPolicyName": "발송일미정", "dispatchType": "F", "readyDurationDay": 0, "dispatchCloseTime": "00:00", "isDefault": true},
            $l_data = $dispatchPolicies[$i];

            $sql = "insert into `dispatch_policies_list` set `dispatchPolicyNo` = '{$l_data['dispatchPolicyNo']}',
                                                            `dispatchPolicyName` = '{$l_data['dispatchPolicyName']}',
                                                            `dispatchType` = '{$l_data['dispatchType']}',
                                                            `readyDurationDay` = '{$l_data['readyDurationDay']}',
                                                            `dispatchCloseTime` = '{$l_data['dispatchCloseTime']}',
                                                            `api_type` = '{$api_type}'";
            sql_query($sql);
        }
    }

    public function getDispatchPolicy(){
        $sql = "
                SELECT 
                    d1.dispatchPolicyName AS dispatch_policy,
                    CASE 
                        WHEN d1.dispatchPolicyName = '당일발송' THEN CONCAT('발송 마감시간: ', d1.dispatchCloseTime, '시')
                        WHEN d1.dispatchPolicyName = '순차발송' THEN CONCAT('배송준비 소요일: ', d1.readyDurationDay, '일')
                        ELSE '-'
                    END AS dispatch_info,
                    MAX(CASE WHEN d1.api_type = 'gmarket' THEN d1.dispatchPolicyNo END) AS gmarket_reg_no,
                    MAX(CASE WHEN d1.api_type = 'auction' THEN d1.dispatchPolicyNo END) AS auction_reg_no
                FROM 
                    dispatch_policies_list d1
                GROUP BY 
                    d1.dispatchPolicyName, d1.dispatchType, d1.readyDurationDay, d1.dispatchCloseTime
                ORDER BY 
                    FIELD(d1.dispatchPolicyName, '당일발송', '순차발송', '요청일발송', '주문제작발송', '발송일미정'),
                    CASE 
                        WHEN d1.dispatchPolicyName = '당일발송' THEN d1.dispatchCloseTime
                        WHEN d1.dispatchPolicyName = '순차발송' THEN d1.readyDurationDay
                    END;
                ";
        $re = sql_query($sql);

        $data = sql_fetch_array($re);

        return $data;
    }

    public function getList($data, $table_name){
        $where = " where 1=1 ";

        // mb_id와 mb_level 체크
        if(isset($data['member']['mb_id']) && isset($data['member']['mb_level'])){
            $mb_id = $data['member']['mb_id'];
            $mb_level = (int)$data['member']['mb_level'];

            if($mb_level < 9){
                $where .= " and `mb_id` = '{$mb_id}'";
            }
        }

        // 검색어 처리
        $sf = isset($data['sf']) ? $data['sf'] : '';
        $st = isset($data['st']) ? $data['st'] : '';

        if(!empty($sf) && !empty($st)){
            if($sf == "homeTel" || $sf == "cellPhone"){
                $st = str_replace("-","",$st);
                $where .= " and REPLACE(`$sf`, '-', '') like '%$st%'";
            } else {
                $where .= " and `$sf` like '%$st%'";
            }
        }

        // 특정 인덱스 처리
        if(!empty($data['idx'])){
            $where .= " and `idx` = '{$data['idx']}'";
        }

        $sql = "select * from `$table_name` $where";
        $re = sql_query($sql);
        $total_count = sql_num_rows($re);
        $return_data['total_count'] = $total_count;

        // 페이지 번호와 페이지당 아이템 수 설정
        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $items_per_page = isset($data['items_per_page']) ? (int) $data['items_per_page'] : 15;
        $return_data['items_per_page'] = $items_per_page;

        // 시작 위치 계산 (0 기반 인덱스)
        $start_limit = ($page - 1) * $items_per_page;

        // 실제 데이터 리스트 만들기
        $sql = "SELECT * FROM `$table_name` $where ORDER BY `idx` DESC LIMIT $start_limit, $items_per_page";
        $re = sql_query($sql);
        $return_data['list'] = sql_fetch_array($re);
        return $return_data;
    }
}
