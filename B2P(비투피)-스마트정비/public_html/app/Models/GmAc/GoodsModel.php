<?php

namespace App\Models\GmAc;

use App\Models\MemberModel;
use CodeIgniter\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GoodsModel extends GmAcBasicApiModel {

    // 일괄변경
    public function setGoodsBatch($data){
        $goodsBatch_type = $data['goodsBatch_type'];
        $selectedValues = explode(",",$data['selectedValues']);

        if(empty($selectedValues) || !is_array($selectedValues)){
            return ['code'=>400, 'msg'=>"올바르게 이용해주세요."];
        }

        $result = [];
        foreach ($selectedValues as $i => $goods_no){
            $getData = [
                'member' => ['mb_id' => $data['member']['mb_id'], 'mb_level' => $data['member']['mb_level']],
                'page' => 1,
                'items_per_page' => 1,
                'sf' => 'goods_no',
                'st' => $goods_no,
            ];
            $goods_data = $this->getList($getData, 'goods_list')['list'][0];
            if(empty($goods_data)){
                continue;
            }

            $useGmarket = false;
            $useAuction = false;
            if(!empty($goods_data['gmkt_no']) && !empty($goods_data['iac_no'])){
                $api_type = GMAC;
                $useGmarket = true;
                $useAuction = true;
            } else if(!empty($goods_data['gmkt_no'])){
                $api_type = GM;
                $useGmarket = true;
            } else if(!empty($goods_data['iac_no'])){
                $api_type = AC;
                $useAuction = true;
            } else {
                return ['code'=>400, 'msg'=>"올바르게 이용해주세요."];
            }

            $put_data = [];

            // 상품상태변경, 상품판매기간 변경,
            if($goodsBatch_type == "goodsState" || $goodsBatch_type == "goodsPeriod" || $goodsBatch_type == "goodsPrice" || $goodsBatch_type == "goodsStock"){
                if ($useGmarket) {
                    $put_data["isSell"]["gmkt"] = $goods_data['isSell_gmkt']=="T";
                    $put_data["itemBasicInfo"]["Price"]["gmkt"] = (int)$goods_data['price_gmkt'];
                    $put_data["itemBasicInfo"]["Stock"]["gmkt"] = (int)$goods_data['stock_gmkt'];
                    $put_data["itemBasicInfo"]["SellingPeriod"]["gmkt"] = 0;
                }

                if ($useAuction) {
                    $put_data["isSell"]["iac"] = $goods_data['isSell_iac']=="T";
                    $put_data["itemBasicInfo"]["Price"]["iac"] = (int)$goods_data['price_iac'];
                    $put_data["itemBasicInfo"]["Stock"]["iac"] = (int)$goods_data['stock_iac'];
                    $put_data["itemBasicInfo"]["SellingPeriod"]["iac"] = 0;
                }

                
                if($goodsBatch_type == "goodsState"){
                    // 상품 판매 상태 변경
                    if ($useGmarket) {
                        $put_data["isSell"]["gmkt"] = $data['select_goodsState']=="T";
                    }
                    if ($useAuction) {
                        $put_data["isSell"]["iac"] = $data['select_goodsState']=="T";
                    }
                } else if($goodsBatch_type == "goodsPeriod"){
                    // 상품 판매 기간 변경
                    if ($useGmarket) {
                        $put_data["itemBasicInfo"]["SellingPeriod"]["gmkt"] = (int)$data['select_goodsPeriod'];
                    }
                    if ($useAuction) {
                        $put_data["itemBasicInfo"]["SellingPeriod"]["iac"] = (int)$data['select_goodsPeriod'];
                    }
                } else if($goodsBatch_type == "goodsPrice"){
                    // 상품 가격 변경
                    $price = (int)$goods_data['price'];
                    $input_goodsPrice = (int)$data['input_goodsPrice'];
                    if($data['select_goodsPrice_type'] == "set"){
                        $price = $input_goodsPrice;
                    } else {
                        if($data['select_goodsPrice_unit'] == "1"){
                            // 원
                            if($data['select_goodsPrice_type'] == "up"){
                                $price = $price + $input_goodsPrice;
                            } else if($data['select_goodsPrice_type'] == "down"){
                                $price = $price - $input_goodsPrice;
                            }
                        } else if($data['select_goodsPrice_unit'] == "2"){
                            // %
                            if($data['select_goodsPrice_type'] == "up"){
                                $price = $price + ($price * $input_goodsPrice / 100);
                            } else if($data['select_goodsPrice_type'] == "down"){
                                $price = $price - ($price * $input_goodsPrice / 100);
                            }
                        }
                    }

                    // 소수점 이하를 먼저 제거
                    $price = floor($price);
                    // 원단위를 버림
                    $price = floor($price / 10) * 10;

                    if ($useGmarket) {
                        $put_data["itemBasicInfo"]["price"]["gmkt"] = (int)$price;
                    }
                    if ($useAuction) {
                        $put_data["itemBasicInfo"]["price"]["iac"] = (int)$price;
                    }
                } else if($goodsBatch_type == "goodsStock"){
                    // 재고 설정
                    $input_goodsStock = trim(str_replace(",","",$data['input_goodsStock']));
                    if(empty($input_goodsStock) || $input_goodsStock <= 0){
                        $input_goodsStock = 99999;
                    }

                    if ($useGmarket) {
                        $put_data["itemBasicInfo"]["Stock"]["gmkt"] = (int)$input_goodsStock;
                    }
                    if ($useAuction) {
                        $put_data["itemBasicInfo"]["Stock"]["iac"] = (int)$input_goodsStock;
                    }
                }
                $api_data['api_method'] = "PUT";
                $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/sell-status";
            }
            else if($goodsBatch_type == "goodsDc"){
                //할인가 설정
                $sellerUseDiscount = $data['sellerUseDiscount'] == "T";

                $put_data["sellerDiscount"]["isUse"] = $sellerUseDiscount;
                if ($useGmarket) {
                    $put_data["sellerDiscount"]["gmkt"]["type"] = (int)$data['sellerDiscountType'];
                    $put_data["sellerDiscount"]["gmkt"]["priceOrRate1"] = (int)$data['sellerDisCountPrice'];
                    $put_data["sellerDiscount"]["gmkt"]["startDate"] = !empty($data['sellerDiscountDday']) && !empty($data['sellerDiscountStartDate']) ? $data['sellerDiscountStartDate'] : null;
                    $put_data["sellerDiscount"]["gmkt"]["endDate"] = !empty($data['sellerDiscountDday']) && !empty($data['sellerDiscountEndDate']) ? $data['sellerDiscountEndDate'] : null;
                }
                if ($useAuction) {
                    $put_data["sellerDiscount"]["iac"]["type"] = (int)$data['sellerDiscountType'];
                    $put_data["sellerDiscount"]["iac"]["priceOrRate1"] = (int)$data['sellerDisCountPrice'];
                    $put_data["sellerDiscount"]["iac"]["startDate"] = !empty($data['sellerDiscountDday']) && !empty($data['sellerDiscountStartDate']) ? $data['sellerDiscountStartDate'] : null;
                    $put_data["sellerDiscount"]["iac"]["endDate"] = !empty($data['sellerDiscountDday']) && !empty($data['sellerDiscountEndDate']) ? $data['sellerDiscountEndDate'] : null;
                }

                $api_data['api_method'] = "POST";
                $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/seller-discounts";
            }
            else if($goodsBatch_type == "goodsSmile"){
                // 스마일 캐시

                if($data['useSmile'] == 'T'){
                    if ($useGmarket) {
                        $put_data["gmarketRatio"] = (float)$data['input_smile'];
                    }

                    if ($useAuction) {
                        $put_data["auctionRatio"] = (float)$data['input_smile'];
                    }

                    $api_data['api_method'] = "PUT";
                    $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/cashback";
                } else {
                    $api_data['api_method'] = "DELETE";
                    $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/cashback";
                }



            }
            else if($goodsBatch_type == "goodsBenefit"){
                // 사은품
                if($data['useBenefit'] == 'T'){
                    if ($useGmarket) {
                        $put_data["name"] = $data['input_benefit'];
                        $put_data["manageCode"] = $data['input_benefit_code'];
                    }

                    if ($useAuction) {
                        $put_data["name"] = $data['input_benefit'];
                        $put_data["manageCode"] = $data['input_benefit_code'];
                    }

                    $api_data['api_method'] = "PUT";
                    $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/free-gift";
                } else {
                    $api_data['api_method'] = "DELETE";
                    $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/free-gift";
                }
            }
            else if($goodsBatch_type == "goodsMore"){
                // 덤
                if($data['useMore'] == 'T'){
                    if ($useGmarket) {
                        $put_data["base"] = $data['input_moreBase'];
                        $put_data["bonus"] = $data['input_moreBonus'];
                        $put_data["manageCode"] = $data['input_moreCode'];
                    }

                    if ($useAuction) {
                        $put_data["base"] = $data['input_moreBase'];
                        $put_data["bonus"] = $data['input_moreBonus'];
                        $put_data["manageCode"] = $data['input_moreCode'];
                    }

                    $api_data['api_method'] = "PUT";
                    $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/bonus";
                } else {
                    $api_data['api_method'] = "DELETE";
                    $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/bonus";
                }
            }
            else if($goodsBatch_type == "goodsDelete"){
                // 삭제
                $api_data['api_method'] = "DELETE";
                $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}";
            }
            else if($goodsBatch_type == "goodsDonate"){
                // 후원, 나눔
                if($data['useDonate_gmkt'] == 'T') {
                    if ($useGmarket) {
                        $put_data['gmarket']["isUse"] = true;
                        $put_data['gmarket']["amount"] = (int)str_replace(",","",$data['money_gmkt']);
                        $put_data['gmarket']["maxAmount"] = (int)str_replace(",","",$data['maxMoney_gmkt']);
                        $put_data['gmarket']["field"] = (int)$data['donateType_gmkt'];
                        $put_data['gmarket']["startDate"] = $data['donateStartDate_gmkt'];
                        $put_data['gmarket']["endDate"] = $data['donateEndDate_gmkt'];
                    } else {
                        $put_data['gmarket']["isUse"] = false;
                    }
                } else {
                    $put_data['gmarket']["isUse"] = false;
                }

                if($data['useDonate_iac'] == 'T') {
                    if ($useAuction) {
                        $put_data['auction']["isUse"] = true;
                        $put_data['auction']["startDate"] = $data['donateStartDate_iac'];
                        $put_data['auction']["endDate"] = $data['donateEndDate_iac'];
                    } else {
                        $put_data['auction']["isUse"] = false;
                    }
                } else {
                    $put_data['auction']["isUse"] = false;
                }

                $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/sponsorship";

                $sponsorship = [];
                if(!empty($goods_data['sponsorship'])){
                    $sponsorship = json_decode($goods_data['sponsorship'], true);
                }

                // 둘다 등록 안함 일때
                if($data['useDonate_gmkt'] != 'T' && $data['useDonate_iac'] != 'T') {
                    if($sponsorship['gmarket']['isUse'] == true || $sponsorship['auction']['isUse'] == true){
                        // 기존에도 등록이 있을때만 삭제
                        $api_data['api_method'] = "DELETE";
                    } else {
                        // API 실행하지 않는다.
                        $api_data['api_method'] = "NO";
                    }
                }
                // 하나라도 등록할때
                else {
                    if($sponsorship['gmarket']['isUse'] == true || $sponsorship['auction']['isUse'] == true){
                        // 기존에 등록된게 있으면 수정
                        $api_data['api_method'] = "PUT";
                    } else {
                        // 기존에 등록된게 없으면 등록
                        $api_data['api_method'] = "POST";
                    }
                }
            }
            else {
                // 부분 api없는것들
                $update_data['api_type'] = GMAC;
                $update_data['api_method'] = "GET";
                $update_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}";
                $update_result = $this->callApi($update_data);

                if($update_result['code'] == 200 || $update_result['code'] == "200"){
                    $put_data = json_decode($update_result['body'], true);
                    $put_data['itemAddtionalInfo']['sellingPeriod']['Gmkt'] = 0;
                    $put_data['itemAddtionalInfo']['sellingPeriod']['Iac'] = 0;
                }

                if(empty($put_data)){
                    $result[$goods_no] = ['code'=>400, 'msg'=>'일시적인 오류거나 삭제 또는 정지된 상품입니다.'];
                    continue;
                }


                if($goodsBatch_type == "goodsPromo"){
                    // 프로모션 수정
                    $put_data['itemBasicInfo']['goodsName']['promotion'] = $data['input_goodsPromo'];
                } else if($goodsBatch_type == "goodsMax"){
                    // 최대구매수량 수정
                    $put_data['itemAddtionalInfo']['buyableQuantity'] = null;
                    $put_data['itemAddtionalInfo']['buyableQuantity']['type'] = 0;

                    if($data['useBuyAble'] == "T"){
                        $buyableQuantityChild = (int)$data['buyableQuantityChild'];

                        $put_data['itemAddtionalInfo']['buyableQuantity']['type'] = (int)$data['buyableQuantityChild'];
                        if($buyableQuantityChild == 1){
                            $put_data['itemAddtionalInfo']['buyableQuantity']['qty'] = (int)$data['buyableQuantityQty'];
                            $put_data['itemAddtionalInfo']['buyableQuantity']['unitDate'] = null;
                        } else if($buyableQuantityChild == 2){
                            $put_data['itemAddtionalInfo']['buyableQuantity']['qty'] = (int)$data['buyableQuantityOnceQty'];
                        } else if($buyableQuantityChild == 3){
                            $put_data['itemAddtionalInfo']['buyableQuantity']['qty'] = (int)$data['buyableQuantityDayQty'];
                            $put_data['itemAddtionalInfo']['buyableQuantity']['unitDate'] = (int)$data['buyableQuantityDays'];

                        } else {
                            $put_data['itemAddtionalInfo']['buyableQuantity']['type'] = 0;
                        }
                    }
                }
                else if($goodsBatch_type == "goodsCompare"){
                    // 가격비교 사이트 등록
                    $put_data['addtionalInfo']['pcs'] = null;
                    if($data['use_goodsCompare'] == 'T'){
                        $put_data['addtionalInfo']['pcs']['isUse'] = true;
                        $put_data['addtionalInfo']['pcs']['isUseIacPcsCoupon'] = $data['use_CouponIac'] == "T";
                    } else {
                        $put_data['addtionalInfo']['pcs']['isUse'] = false;
                    }
                }
                else if($goodsBatch_type == "goodsDelivery"){
                    // 배송정보

                    // 배송 방법 처리
                    if (isset($data['use_shippingMethod'])) {
                        $put_data['itemAddtionalInfo']['shipping']['type'] = isset($data['shippingType']) ? (int)$data['shippingType'] : null;

                        if ($put_data['itemAddtionalInfo']['shipping']['type'] == 1) {
                            $put_data['itemAddtionalInfo']['shipping']['companyNo'] = isset($data['companyNo']) ? (int)$data['companyNo'] : null;
                        }

                        // 퀵서비스 설정 추가
                        if (isset($data['quickService'])) {
                            $put_data['itemAddtionalInfo']['shipping']['quickService']['isUse'] = true;
                            if (isset($data['quickCompanyName'])) {
                                $put_data['itemAddtionalInfo']['shipping']['quickService']['companyName'] = $data['quickCompanyName'];
                            }
                            if (isset($data['quickCompanyHp'])) {
                                $put_data['itemAddtionalInfo']['shipping']['quickService']['phoneNo'] = $data['quickCompanyHp'];
                            }
                            if (isset($data['quickList'])) {
                                $regionCodes = [];
                                foreach ($data['quickList'] as $code) {
                                    if ($code === '0200' && isset($data['gyeonggiList'])) {
                                        // 경기도(0200)가 있는 경우, gyeonggiList 값을 추가
                                        foreach ($data['gyeonggiList'] as $gyeonggiCode) {
                                            if ($gyeonggiCode === '0200') {
                                                $regionCodes[] = $gyeonggiCode;
                                            } else {
                                                $regionCodes[] = $gyeonggiCode;
                                            }
                                        }
                                    } else {
                                        $regionCodes[] = $code;
                                    }
                                }
                                $put_data['itemAddtionalInfo']['shipping']['quickService']['shippingEnableRegionCode'] = implode(',', array_unique($regionCodes));
                            }
                        } else {
                            $put_data['itemAddtionalInfo']['shipping']['quickService']['isUse'] = false;
                        }
                    }

                    // 발송 정책 처리
                    if (isset($data['use_shippingPolicy'])) {
                        if (isset($data['select_shippingPolicy'])) {
                            list($gmkt, $iac) = explode(',', $data['select_shippingPolicy']);
                            $put_data['itemAddtionalInfo']['shipping']['dispatchPolicyNo']['gmkt'] = (int)$gmkt;
                            $put_data['itemAddtionalInfo']['shipping']['dispatchPolicyNo']['iac'] = (int)$iac;
                        }
                    }

                    // 묶음배송/배송비 처리
                    if (isset($data['use_shippingBundle'])) {
                        if (isset($data['placeNo'])) {
                            $put_data['itemAddtionalInfo']['shipping']['policy']['placeNo'] = (int)$data['placeNo'];
                        }

                        if (isset($data['shippingPolicyFeeType'])) {
                            $feeType = (int)$data['shippingPolicyFeeType'];
                            $put_data['itemAddtionalInfo']['shipping']['policy']['feeType'] = $feeType;
                            if ($feeType == 1) {
                                if (isset($data['deliveryTmplId'])) {
                                    $put_data['itemAddtionalInfo']['shipping']['policy']['bundle']['deliveryTmplId'] = (int)$data['deliveryTmplId'];
                                }
                            } elseif ($feeType == 2) {
                                if (isset($data['eachFeeType'])) {
                                    $put_data['itemAddtionalInfo']['shipping']['policy']['each']['feeType'] = (int)$data['eachFeeType'];
                                    if ($put_data['itemAddtionalInfo']['shipping']['policy']['each']['feeType'] == 2 && isset($data['basic_delivery_price'])) {
                                        $put_data['itemAddtionalInfo']['shipping']['policy']['each']['fee'] = (float)$data['basic_delivery_price'];
                                    } elseif ($put_data['itemAddtionalInfo']['shipping']['policy']['each']['feeType'] == 3) {
                                        if (isset($data['condition_delivery_price'])) {
                                            $put_data['itemAddtionalInfo']['shipping']['policy']['each']['fee'] = (float)$data['condition_delivery_price'];
                                        }
                                        if (isset($data['condition_over_price'])) {
                                            $put_data['itemAddtionalInfo']['shipping']['policy']['each']['details'][0]['Condition'] = (int)$data['condition_over_price'];
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // 반품/교환 정보 처리
                    if (isset($data['use_shippingReturn'])) {
                        if (isset($data['returnAndExchangeAddrNo'])) {
                            $put_data['itemAddtionalInfo']['shipping']['returnAndExchange']['addrNo'] = (int)$data['returnAndExchangeAddrNo'];
                        }
                        if (isset($data['returnAndExchange'])) {
                            $put_data['itemAddtionalInfo']['shipping']['returnAndExchange']['fee'] = (float)$data['returnAndExchange'];
                        }
                    }
                }

                $api_data['api_method'] = "PUT";
                $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}";
            }

            $api_data['api_data'] = $put_data;
            $api_data['api_type'] = $api_type;

            // 후원, 덤은 NO상태가 있음
            if($api_data['api_method'] != "NO"){
                $result[$goods_no] = $this->callApi($api_data);

                $update_sponsorship = sql_real_escape_string(json_encode($put_data, JSON_UNESCAPED_UNICODE));
                $sql = "update `goods_list` set `sponsorship` = '$update_sponsorship' where `goods_no` = '$goods_no'";
                sql_query($sql);

            } else {
                $result[$goods_no] = [
                    'code' => 400,
                    'body' => json_encode(['resultCode'=>400,'message'=>'등록된 후원이 없습니다.'],JSON_UNESCAPED_UNICODE)
                ];
            }/*

            // 후원, 나눔은 별도로 db저장해야함
            if($goodsBatch_type == "goodsDonate"){
                $update_data['api_type'] = GMAC;
                $update_data['api_method'] = "GET";
                $update_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}/customer-benefit/bonus";
                $update_result = $this->callApi($update_data);
                $update_sponsorship = sql_real_escape_string($update_result['body']);
                $sql = "update `goods_list` set `sponsorship` = '$update_sponsorship' where `goods_no` = '$goods_no'";
                sql_query($sql);

                $result[$goods_no][] = $update_result;
            }*/

            // db업데이트
            $update_data['api_type'] = GMAC;
            $update_data['api_method'] = "GET";
            $update_data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}";
            $update_result = $this->callApi($update_data);
            if(!empty($update_result['body'])){
                // 데이터가 있으면 즉시 db업데이트
                $update_data = json_decode($update_result['body'], true);
                $update_data['w'] = 'u';
                $update_data['goods_no'] = $goods_no;
                $this->updateGoods($update_data);
            }
        }

        return  $result;
    }

    // 상품등록
    public function setGoods($data){
        $mb_id = $data['member']['mb_id'];
        $mb_level = $data['member']['mb_level'];

        $curl = curl_init();

        $api_type = "";
        $useGmarket = false;
        $useAuction = false;
        if(!empty($data['useGmarket']) && !empty($data['useAuction'])){
            $api_type = GMAC;
            $useGmarket = true;
            $useAuction = true;
        } else if(!empty($data['useGmarket'])){
            $api_type = GM;
            $useGmarket = true;
        } else if(!empty($data['useAuction'])){
            $api_type = AC;
            $useAuction = true;
        } else {
            return ['code'=>400, 'msg'=>"올바르게 이용해주세요"];
        }

        // HTTP 헤더 설정
        $headers = $this->creatHeader($api_type);
        $headerArray = ['Content-Type: application/json'];
        foreach ($headers as $key => $value) {
            $headerArray[] = $key . ': ' . $value;
        }



        $is_upload = false;
        if($data['is_upload'] == 'T'){
            $is_upload = true;
            $mb_id = $data['mb_id'];

            $memberModel = new MemberModel();
            $member = $memberModel -> getMember($mb_id);
            $mb_level = $member['mb_level'];
        }

        $where_mb_id = "";
        if($mb_level < 9){
            $where_mb_id = " and `mb_id` = '$mb_id'";
        }

        $managedCode = $mb_id."_".get_uniqid(true);

        // 데이터 검증

        $data['useAddonService'] == "T" ? $useAddonService = true : $useAddonService = false;

        $addonService = null;

        $addonService = [
            "addonServiceList" => [],
            "addonServiceUseType" => 2
        ];
        if($useAddonService) {

            foreach ($data['addonName'] as $index => $addonName) {
                $addonService['addonServiceList'][] = [
                    "addonServiceType" => 4,
                    "addonServiceSeq" => 19005,
                    "addonServiceName" => $addonName,
                    "addonServiceValueSeq" => null,
                    "addonServiceValueName" => $data['addonValue'][$index],
                    "addonServiceAmnt" => (float)$data['addonExtraPrice'][$index],
                    "sortSeq" => $index + 1,
                    "qtyInfo" => [
                        "isSoldOut" => $data['addonSaleStatus'][$index] === 'F',
                        "exposeYN" => $data['addonDisplayStatus'][$index] === 'T',
                        "qty" => [
                            "iac" => (int)$data['addonStock'][$index],
                            "gmkt" => (int)$data['addonStock'][$index]
                        ]
                    ],
                    "manageCode" => $mb_id."_".get_uniqid(true)
                ];
            }
        }


        // 지마켓 사용/중단 여부
        $isSellGmkt = false;
        if($useGmarket){
            if($data['isSellGmkt'] == "T"){
                $isSellGmkt = true;
            }
        }

        // 옥션 사용/중단 여부
        $isSellIac = false;
        if($useAuction){
            if($data['isSellIac'] == "T"){
                $isSellIac = true;
            }
        }


        if($data['w'] == ''){
            $isSellGmkt = true;
            $isSellIac = true;
        }

        // 상품명
        $result = isStr($data['goodsName_kor']);
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '상품명을 입력해주세요'];
        }
        $goodsName_kor = $result['value'];

        // 카테고리 옥션
        if($useAuction){
            $result = isStr($data['ac_cate']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '카테고리를 선택해주세요'];
            }
            $ac_cate = $result['value'];
        } else {
            $result = isStr($data['ac_cate']);
            $ac_cate = $result['value'];
        }


        // 카테고리 지마켓
        if($useGmarket){
            $result = isNum($data['gm_cate']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '카테고리를 입력해주세요'];
            }
            $gm_cate = $result['value'];
        } else {
            $result = isNum($data['gm_cate']);
            $gm_cate = $result['value'];
        }


        // 가격
        $result = isNum(str_replace(",","",$data['price']));
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '판매가를 입력해주세요'];
        }
        $price = $result['value'];

        // 할인여부
        $data['sellerDiscount'] == "T" ? $sellerDiscount = true : $sellerDiscount = false;
        $sellerDiscountGmkt = null;
        $sellerDiscountIac = null;
        if($sellerDiscount){
            // 할인가
            $data['discountprice'] = str_replace(",","",$data['discountprice']);
            $result = isNum($data['discountprice']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '할인 가격을 입력해주세요.'];
            }
            $discountprice = $result['value'];

            if($useGmarket){
                $sellerDiscountGmkt = [
                    "type" => (int)$data['sellerDiscountType'],         // [(G마켓/옥션용), 옵션, int],
                    "priceOrRate1" => $discountprice,               // [(G마켓/옥션용), 옵션, number],
                    "priceOrRate2" => 0,               // [(G마켓/옥션용), 옵션, number],
                    "startDate" => $data['startDate'],                  // [(G마켓/옥션용), 옵션, date],
                    "endDate" => $data['endDate'],                    // [(G마켓/옥션용), 옵션, date]
                ];
            }

            if($useAuction){
                $sellerDiscountIac = [
                    "type" => (int)$data['sellerDiscountType'],  // [(G마켓/옥션용), 옵션, int],
                    "priceOrRate1" => $discountprice,               // [(G마켓/옥션용), 옵션, number],
                    "priceOrRate2" => 0,               // [(G마켓/옥션용), 옵션, number],
                    "startDate" => $data['startDate'],                  // [(G마켓/옥션용), 옵션, date],
                    "endDate" => $data['endDate'],                    // [(G마켓/옥션용), 옵션, date]
                ];
            }
        }

        $addtionalInfo_sellerDiscount = [
            "isUse" => $sellerDiscount,
            "gmkt" => $sellerDiscountGmkt,
            "iac" => $sellerDiscountIac
        ];
        
        // 판매기간 여부
        $data['sellingPeriod'] == "T"  ? $sellingPeriod = (int)$data['periodValue'] : $sellingPeriod = -1;
        $futureDate = "9999-12-31";
        if(empty($sellingPeriod)){
            $sellingPeriod = -1;
        }

        if($sellingPeriod != -1){
            $futureDate = date('Y-m-d', strtotime("+$sellingPeriod days"));
        }


        // 부과세 여부
        $data['isVatFree'] == "T"  ? $isVatFree = true : $isVatFree = false;

        // 옵션
        $recommendedOptsIndependent = null;
        $recommendedOptsText = null;
        $recommendedOptsCalculation = null;

        $uniqueOptionNames = [];
        if(!empty($data['optionName'])){
            $uniqueOptionNames = array_unique($data['optionName']);
        }

        $optionNameCount = count($uniqueOptionNames);

        $useSelectOption = ($data['useSelectOption'] == "T");
        $useOptionText = ($data['useOptionText'] == "T");

        $b2pAuto = $data['b2pAuto'] == "T";
        if($b2pAuto){
            $useOptionText = true;
        }




        $optsType = $data['optsType'];

        $recommendedOptsType = 0;

        if ($useSelectOption || $useOptionText) {
            if($useSelectOption){
                if($optsType == "i") {
                    // 단독형
                    if($useOptionText){
                        $recommendedOptsType = 6;
                    } else {
                        $recommendedOptsType = 1;
                    }

                } else if($optsType == "c"){
                    if($useOptionText){
                        if ($optionNameCount == 2) {
                            $recommendedOptsType = 7;
                        } else {
                            $recommendedOptsType = 8;
                        }
                    } else {
                        if ($optionNameCount == 2) {

                            $recommendedOptsType = 2;
                        } else {
                            $recommendedOptsType = 3;
                        }
                    }

                }
            } else {
                if($useOptionText){
                    $recommendedOptsType = 5;
                }
            }
        }

        $useOptionStockmanager = false;
        if($recommendedOptsType > 0){
            $data['useOptionStockmanager'] == "T" ? $useOptionStockmanager = true : $useOptionStockmanager = false;
        }
        // 기본 구조 생성
        $recommendedOpts = [
            'type' => $recommendedOptsType,
            'isStockManage' => $useOptionStockmanager,
        ];
        $tempIndependentOption = [];



        if (in_array($recommendedOptsType, [1, 6, 9])) {
            if($optionNameCount == 1){
                $recommendedOpts['independent'] = [];
            } else {
                $recommendedOpts['independents'] = [];
            }
            foreach ($data['optionName'] as $optionIndex => $optionName) {
                $result = isStr($optionName);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '선택형 옵션명을 입력해주세요'];
                }
                $optionName = trim($result['value']);

                if(empty($tempIndependentOption[$optionName])){
                    $tempIndependentOption[$optionName] = [
                        'details' => [],
                        'recommendedOptNo' => 0,
                        'recommendedOptName' => [
                            'koreanText' => $optionName,
                            'englishText' => null,
                            'chineseText' => null,
                            'japaneseText' => null,
                            'exposeLanguage' => 0
                        ]
                    ];
                }


                $optionValue = $data['optionValue'][$optionIndex];
                $result = isStr($optionValue);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '선택형 옵션값을 입력해주세요'];
                }
                $optionValue = trim($result['value']);

                trim($data['optionSaleStatus'][$optionIndex]) == "T" ? $optionSaleStatus = false : $optionSaleStatus = true;
                trim($data['optionDisplayStatus'][$optionIndex]) == "T" ? $optionDisplayStatus = true : $optionDisplayStatus = false;

                $detail = [
                    'recommendedOptValueNo' => 0,
                    'recommendedOptValue' => [
                        'koreanText' => $optionValue,
                        'englishText' => null,
                        'chineseText' => null,
                        'japaneseText' => null,
                        'exposeLanguage' => 0
                    ],
                    'imageUrl' => null,
                    'isSoldOut' => $optionSaleStatus,
                    'isDisplay' => $optionDisplayStatus,
                    'manageCode' => $mb_id."_".get_uniqid(true),
                    'skuInfo' => null,
                    'addAmnt' => (int)trim($data['optionExtraPrice'][$optionIndex])
                ];

                if ($useOptionStockmanager) {
                    $detail['qty'] = [
                        'iac' => (int)trim($data['optionStock'][$optionIndex]),
                        'gmkt' => (int)trim($data['optionStock'][$optionIndex])
                    ];
                } else {
                    $detail['qty'] = [
                        'iac' => 0,
                        'gmkt' => 0
                    ];
                }

                $tempIndependentOption[$optionName]['details'][] = $detail;
            }
        }

        foreach ($uniqueOptionNames as $optionIndex => $optionName) {
            if($optionNameCount == 1){
                $recommendedOpts['independent'] = $tempIndependentOption[$optionName];
            } else {
                $recommendedOpts['independents'][] = $tempIndependentOption[$optionName];
            }
        }

        // 조합형 옵션 생성
        if (in_array($recommendedOptsType, [2, 3, 7, 8])) {
            $recommendedOpts['combination'] = [
                'details' => [],
                'recommendedOptNo1' => 0,
                'recommendedOptNo2' => 0,
                'recommendedOptNo3' => 0,
                'imageInfo' => null,
                'recommendedOptName1' => [
                    'koreanText' => trim($uniqueOptionNames[0]) ?? '',
                    'englishText' => null,
                    'chineseText' => null,
                    'japaneseText' => null,
                    'exposeLanguage' => 0
                ],
                'recommendedOptName2' => [
                    'koreanText' => trim($uniqueOptionNames[1]) ?? '',
                    'englishText' => null,
                    'chineseText' => null,
                    'japaneseText' => null,
                    'exposeLanguage' => 0
                ],
                'recommendedOptName3' => $optionNameCount == 3 ? [
                    'koreanText' => trim($uniqueOptionNames[2]) ?? '',
                    'englishText' => null,
                    'chineseText' => null,
                    'japaneseText' => null,
                    'exposeLanguage' => 0
                ] : null
            ];

            foreach ($data['optionValue0'] as $combIndex => $optionValues) {
                trim($data['optionSaleStatus'][$combIndex]) == "T" ? $optionSaleStatus = false : $optionSaleStatus = true;
                trim($data['optionDisplayStatus'][$combIndex]) == "T" ? $optionDisplayStatus = true : $optionDisplayStatus = false;

                $detail = [
                    'recommendedOptValueNo1' => 0,
                    'recommendedOptValueNo2' => 0,
                    'recommendedOptValueNo3' => 0,
                    'recommendedOptValue1' => [
                        'koreanText' => trim($data['optionValue0'][$combIndex]),
                        'englishText' => null,
                        'chineseText' => null,
                        'japaneseText' => null,
                        'exposeLanguage' => 0
                    ],
                    'recommendedOptValue2' => [
                        'koreanText' => trim($data['optionValue1'][$combIndex]),
                        'englishText' => null,
                        'chineseText' => null,
                        'japaneseText' => null,
                        'exposeLanguage' => 0
                    ],
                    'recommendedOptValue3' => $optionNameCount == 3 ? [
                        'koreanText' => trim($data['optionValue2'][$combIndex]),
                        'englishText' => null,
                        'chineseText' => null,
                        'japaneseText' => null,
                        'exposeLanguage' => 0
                    ] : null,
                    'isSoldOut' => $optionSaleStatus,
                    'isDisplay' => $optionDisplayStatus,
                    'manageCode' => $mb_id."_".get_uniqid(true),
                    'skuInfo' => null,
                    'addAmnt' => (int)trim($data['optionExtraPrice'][$combIndex])
                ];

                if ($useOptionStockmanager) {
                    $detail['qty'] = [
                        'iac' => (int)trim($data['optionStock'][$optionIndex]),
                        'gmkt' => (int)trim($data['optionStock'][$optionIndex])
                    ];
                } else {
                    $detail['qty'] = [
                        'iac' => 0,
                        'gmkt' => 0
                    ];
                }

                $recommendedOpts['combination']['details'][] = $detail;
            }
        }

        // 텍스트 옵션 생성
        if (in_array($recommendedOptsType, [5, 6, 7, 8])) {
            if($b2pAuto){
                if(count($data['textOptionName']) >= 5){
                    return ['code' => '400', 'msg' => '오토오아이스 배송 이용시 텍스트 옵션은 최대 4개까지 사용 가능합니다.'];
                }

                $autoText1 = "서비스를 위해 전화번호를 꼭 입력해주세요.";
                if (!in_array($autoText1, $data['textOptionName'])) {
                    $data['textOptionName'][] = $autoText1;
                    $data['displayTextOptionName'][] = "T";
                }
            }


            $filteredKeys = array_keys(array_filter($data['textOptionName'], fn($value) => trim($value) !== ''));

            // 필터링된 키를 사용하여 두 배열에서 필요한 요소만 추출
            $textOptionNameFiltered = array_intersect_key($data['textOptionName'], array_flip($filteredKeys));
            $displayTextOptionNameFiltered = array_intersect_key($data['displayTextOptionName'], array_flip($filteredKeys));

            // 인덱스 재정렬
            $data['textOptionName'] = array_values($textOptionNameFiltered);
            $data['displayTextOptionName'] = array_values($displayTextOptionNameFiltered);

            $recommendedOpts['text']['details'] = []; // 필요한 값을 여기에 설정합니다.
            foreach ($data['textOptionName'] as $index => $value) {
                $result = isStr($value);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '텍스트 옵션명을 입력해주세요'];
                }
                $value = trim($result['value']);


                $isDisplay = isset($data['displayTextOptionName'][$index]) && $data['displayTextOptionName'][$index] === 'T';

                $recommendedOpts['text']['details'][] = [
                    'recommendedOptNo' => 0,
                    'isDisplay' => $isDisplay,
                    'Value' => $value
                ];
            }
        }

        $useOption = "F";
        if($recommendedOptsType != 0){
            $useOption = "T";
        }

        // 이미지
        if(empty($data['basicImgURL'])){
            return ['code' => 400, "msg" => "대표 이미지 url을 입력해주세요."];
        }

        $add_images = [];
        if (isset($data['addtionalImg']) && is_array($data['addtionalImg'])) {
            for ($i = 0; $i < count($data['addtionalImg']); $i++) {
                if (!empty($data['addtionalImg'][$i])) {
                    $add_images['addtionalImg' . ($i+1) . 'URL'] = ($data['addtionalImg'][$i]);
                }
            }
        }
        $data['images'] = array_merge(["basicImgURL" => ($data['basicImgURL'])], $add_images);

        // 배송 방법
        $result = isNum($data['shippingType']);
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '배송방법을 선택해주세요.'];
        }
        $shippingType = $result['value'];

        if($shippingType == 1){
            // 택배사 코드
            $result = isNum($data['companyNo']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '택배사를 선택해주세요.'];
            }
            $companyNo = $result['value'];
        }


        // 발송정책 코드
        $result = isNum($data['dispatchPolicyNo']);
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '발송정책을 선택해주세요.'];
        }
        $dispatchPolicyNo = $result['value'];

        // 배송정책
        $sql = "SELECT * FROM `dispatch_policies_list` where `dispatchPolicyNo` = '{$dispatchPolicyNo}'";
        $row = sql_fetch($sql);

        $sql = "select * from `dispatch_policies_list` where `dispatchPolicyName` = '{$row['dispatchPolicyName']}' and `dispatchType` = '{$row['dispatchType']}' and `readyDurationDay` = '{$row['readyDurationDay']}' and `dispatchCloseTime` = '{$row['dispatchCloseTime']}' and `api_type` = 'auction'";
        $row = sql_fetch($sql);

        if(empty($row)){
            return ['code' => '400', 'msg' => '발송정책을 확인해주세요.'];
        }

        $dispatchPolicyNo = [
            "gmkt" => (int)$data['dispatchPolicyNo'],               // [(G마켓용), 필수, int],
            "iac" => (int)$row['dispatchPolicyNo'],               // [(옥션용), 필수, int]
        ];

        // 출고지(출하지) 코드
        $result = isNum($data['placeNo']);
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '출고지(출하지)를 선택 해주세요.'];
        }
        $placeNo = $result['value'];

        $sql = "select * from `places_list` where `placeNo` = '{$placeNo}' {$where_mb_id}";
        $row = sql_fetch($sql);
        if(empty($row)){
            return ['code' => '400', 'msg' => '출고지(출하지)코드를 확인해주세요.'];
        }


        // 묶음배송
        $result = isNum($data['shippingPolicyFeeType']);
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '묶음배송을 선택 해주세요.'];
        }
        $shippingPolicyFeeType = $result['value'];

        $bundle = null;
        $shippingEach = null;
        if($shippingPolicyFeeType == 1){
            //묶음배송 탬플릿 선택
            $result = isNum($data['deliveryTmplId']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '묶음배송 배송비를 선택 해주세요.'];
            }
            $deliveryTmplId = $result['value'];

            $sql = "select * from `bundle_policies_list` where `policyNo` = '{$deliveryTmplId}' {$where_mb_id}";
            $row = sql_fetch($sql);
            if(empty($row)){
                return ['code' => '400', 'msg' => '묶음배송 배송비 코드를 확인해주세요.'];
            }

            $bundle = [
                "deliveryTmplId" => $deliveryTmplId,
            ];

        } else if($shippingPolicyFeeType == 2){
            //배송비 선택
            $result = isNum($data['eachFeeType']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '배송비를 선택 해주세요.'];
            }
            $eachFeeType = $result['value'];

            $delivery_price = 0;          // 기본 배송비
            $shippingEachDetails = null;
            if($eachFeeType == 2){
                //유료 배송비
                $result = isNum($data['basic_delivery_price']);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '배송비를 입력해주세요.'];
                }
                $delivery_price = $result['value'];
            } else if($eachFeeType == 3){
                //조건부 배송비
                $result = isNum($data['condition_delivery_price']);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '조건부 배송비를 입력해주세요.'];
                }
                $delivery_price = $result['value'];

                //조건부 조건
                $result = isNum($data['condition_over_price']);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '무료 배송가능한 최저 금액을 입력해주세요.'];
                }
                $condition_over_price = $result['value'];

                $shippingEachDetails = [
                    "FeeAmnt" => $condition_over_price
                ];
            }

            $shippingEach = [
                "feeType" => $eachFeeType,               // [상품별배송비 타입, 옵션, int],
                "feePayType" => 2,               // [상품별배송비지불방법, 옵션, int],
                "fee" => $delivery_price,               // [상품별배송비금액, 옵션, number],
                "details" => $shippingEachDetails
            ];
        }

        $policy = [
            "placeNo" => $placeNo,               // [출하지번호, 옵션, int],
            "feeType" => $shippingPolicyFeeType,               // [배송비 타입, 필수, int],
            'bundle' => $bundle,
            'each' => $shippingEach
        ];

        // 반품지 코드
        $result = isNum($data['returnAndExchangeAddrNo']);
        if (!$result['success']) {
            return ['code' => '400', 'msg' => '반품지를 선택 해주세요.'];
        }
        $returnAndExchangeAddrNo = $result['value'];

        $sql = "select * from `address_book_list` where `addrNo` = '{$returnAndExchangeAddrNo}' {$where_mb_id}";
        $row = sql_fetch($sql);
        if(empty($row)){
            return ['code' => '400', 'msg' => '반품지 코드를 확인해주세요.'];
        }

        // 퀵 사용여부
        $shippingQuickService = null;
        $data['quickService'] == "T" ? $quickService = true : $quickService = false;
        if($quickService){

            $haveGyeonggi = false;
            $shippingEnableRegionCode = "";
            if (!empty($data['quickList'])) {
                // quickList 체크박스에서 선택된 값들을 배열로 받음
                $selectedQuick = $data['quickList'];
                foreach ($selectedQuick as $code) {
                    if($is_upload == false){
                        if($code == "0200"){
                            $haveGyeonggi = true;
                            continue;
                        }
                    }
                    $shippingEnableRegionCode .= $code . ",";
                }
            }

            if($haveGyeonggi){
                if (!empty($data['gyeonggiList'])) {
                    // gyeonggiList 체크박스에서 선택된 값들을 배열로 받음
                    $selectedGyeonggi = $data['gyeonggiList'];
                    foreach ($selectedGyeonggi as $code) {
                        $shippingEnableRegionCode .= $code . ",";
                    }
                } else {
                    return ['code' => '400', 'msg' => '퀵서비스 경기도 지역을 선택해주세요.'.var_dump($is_upload)];
                }
            }

            if(empty($shippingEnableRegionCode)){
                return ['code' => '400', 'msg' => '퀵서비스 지역을 선택해주세요.'.$is_upload];
            }

            // 마지막 콤마 제거
            $shippingEnableRegionCode = rtrim($shippingEnableRegionCode, ",");

            $result = isStr($data['quickCompanyName']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '퀵서비스 업체명을 입력해주세요.'];
            }
            $quickCompanyName = $result['value'];

            $result = isStr($data['quickCompanyHp']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '퀵서비스 업체의 전화번호를 입력해주세요.'];
            }
            $quickCompanyHp = $result['value'];

            $shippingQuickService = [
                "isUse" => $quickService,               // [퀵서비스 제공여부, 옵션, Boolean],
                "companyName" => $quickCompanyName,               // [퀵서비스 업체명, 옵션, string],
                "phoneNo" => $quickCompanyHp,               // [퀵서비스 연락처, 옵션, string],
                "shippingEnableRegionCode" => $shippingEnableRegionCode,               // [퀵서비스 제공지역, 옵션, string]
            ];
        }

        // 방문수령 여부
        $shippingVisitAndTake = null;
        $data['visitAndTake'] == "T" ? $visitAndTake = true : $visitAndTake = false;
        if($visitAndTake){

            $result = isNum($data['visitAndTakeType']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '방문 혜택을 선택해주세요.'];
            }
            $visitAndTakeType = $result['value'];
            $visitAndTakeDiscount = 0;
            $visitAndTakeGifts = null;
            if($visitAndTakeType == 2){
                $result = isNum($data['visitAndTakeDiscount']);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '방문 혜택 할인금액을 입력하세요.'];
                }
                $visitAndTakeDiscount = $result['value'];
            } else if($visitAndTakeType == 3){
                $result = isStr($data['visitAndTakeGifts']);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '방문 혜택 사운품을 입력하세요.'];
                }
                $visitAndTakeGifts = $result['value'];
            }

            $result = isNum($data['visitAndTakeAddrNo']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '방문주소를 선택하세요.'];
            }
            $visitAndTakeAddrNo = $result['value'];


            $shippingVisitAndTake = [
                "isUse" => $visitAndTake,               // [방문수령 제공여부, 옵션, Boolean],
                "type" => $visitAndTakeType,               // [방문수령혜택, 옵션, int],
                "discount" => $visitAndTakeDiscount,               // [방문수령 가격할인, 옵션, number],
                "gifts" => $visitAndTakeGifts,               // [방문수령 사은품, 옵션, string],
                "addrNo" => $visitAndTakeAddrNo,               // [방문수령 주소번호, 옵션, int]
            ];
        }

            
        // 청소년구매여부
        $data['isAdultProduct'] == "T" ? $isAdultProduct = true : $isAdultProduct = false;

        // 최대 구매 허용 수량 설정 여부
        $buyableQuantity = 0;
        $buyableQuantityQty = 0 ;
        $buyableQuantityUnitDate = 0;
        $itemAddtionalInfoBuyableQuantity = null;
        if($data['buyableQuantity'] == "T"){
            $result = isNum($data['buyableQuantityQty']);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '최대 구매수량을 입력해주세요.'];
            }
            $buyableQuantityQty = $result['value'];
            if($data['buyableQuantityChild'] == "1"){
                $buyableQuantity = 1;
            } else if($data['buyableQuantityChild'] == "2"){
                $buyableQuantity = 2;
            } else if($data['buyableQuantityChild'] == "3"){
                $result = isNum($data['buyableQuantityUnitDate']);
                if (!$result['success']) {
                    return ['code' => '400', 'msg' => '구매제한 기간을 입력해주세요.'];
                }
                $buyableQuantityUnitDate = $result['value'];
                $buyableQuantity = 3;
            }
            $itemAddtionalInfoBuyableQuantity = [
                "type" => $buyableQuantity,
                "qty" => $buyableQuantityQty
            ];

            if ($buyableQuantity == 3 && isset($buyableQuantityUnitDate) && !empty($buyableQuantityUnitDate)) {
                $itemAddtionalInfoBuyableQuantity["unitDate"] = $buyableQuantityUnitDate;
            }
        }

        // 상품정보 제공고시
        $data['officialNotice'] = [
            "officialNoticeNo" => 15,
            "details" => []
        ];
        $elementCodes = ["15-1", "15-2", "15-3", "15-4", "15-5", "15-6", "15-7", "15-11", "15-8", "15-12", "15-9", "15-10", "999-5"];

        foreach ($elementCodes as $code) {
            $data['officialNotice']['details'][] = [
                "officialNoticeItemelementCode" => $code,
                "value" => "상품 상세설명 참조",
                "isExtraMark" => false
            ];
        }

        $catalog = null;
        if(!empty($data['brandNo'])){
            $catalog = [
                "modelName" => null,               // [모델명, 옵션, string],
                "brandNo" => (int)$data['brandNo'],               // [브랜드코드, 옵션, int],
                "barCode" => null,               // [바코드, 옵션, string],
                "epinCode" => null,               // [ESM 상품식별코드, 옵션, string]
            ];
        }

        $data['noBrand'] == "T" ? $noBrand = true : $noBrand = false;
        if($noBrand){
            $catalog = null;
        }

        // 쿠폰사용여부
        // 사이트할인 사용여부

        $siteDiscount = [
            "gmkt" => $data['siteDiscount'] == 'T' ,
            "iac" => $data['siteDiscount'] == 'T'
        ];

        $use_comparison = $data['use_comparison'] == 'T';
        $pcs = [
            "isUse" => false
        ];
        if($use_comparison){
            $pcs = [
                "isUse" => true,
                "isUseGmkPcsCoupon" => $data['use_coupon']=='T',
                "isUseIacPcsCoupon" => $data['use_coupon']=='T',
            ];
        }
        
        $orderOptsindependentCombination = null;
        $orderOptsText = null;
        if(!empty($data['orderOpts'])){
            $orderOptsindependentCombination = [
                "name" => [
                    "kor" => "",               // [(선택형/조합형) 옵션그룹명-국문, 옵션, string],
                    "eng" => "",               // [(선택형/조합형) 옵션그룹명-영문, 옵션, string],
                    "chi" => "",               // [(선택형/조합형) 옵션그룹명-중문, 옵션, string],
                    "jpn" => "",               // [(선택형/조합형) 옵션그룹명-일문, 옵션, string]
                ],
                "details" => [
                    "value" => [
                        "kor" => "",               // [(선택형/조합형) 옵션항목값-국문, 옵션, string],
                        "eng" => "",               // [(선택형/조합형) 옵션항목값-영문, 옵션, string],
                        "chi" => "",               // [(선택형/조합형) 옵션항목값-중문, 옵션, string],
                        "jpn" => "",               // [(선택형/조합형) 옵션항목값-일문, 옵션, string]
                    ],
                    "isSoldOut" => "",               // [(선택형/조합형) 품절여부, 옵션, Boolean],
                    "isDisplay" => "",               // [(선택형/조합형) 노출여부, 옵션, Boolean],
                    "qty" => [
                        "iac" => "",               // [(선택형/조합형) 옥션 재고수량, 옵션, int],
                        "gmkt" => "",               // [(선택형/조합형) G마켓 재고수량, 옵션, int]
                    ],
                    "manageCode" => "",               // [(선택형/조합형) 판매자옵션관리코드, 옵션, string],
                    "addAmnt" => "",               // [주문옵션 추가금, 옵션, number]
                ]
            ];

            $orderOptsText = [
                "name" => [
                    "kor" => "",               // [(텍스트형) 텍스트형 옵션명-국문, 옵션, string],
                    "eng" => "",               // [(텍스트형) 텍스트형 옵션명-영문, 옵션, string],
                    "chi" => "",               // [(텍스트형) 텍스트형 옵션명-중문, 옵션, string],
                    "jpn" => "",               // [(텍스트형) 텍스트형 옵션명-일문, 옵션, string]
                ],
                "isDisplay" => "",               // [(텍스트형) 노출여부, 옵션, Boolean]
            ];
        }

        $origin = null;
        if(!empty($data['origin'])){
            $origin = [
                "goodsType" => "",               // [원산지상품 타입, 옵션, int],
                "type" => "",               // [원산지지역 타입, 옵션, int],
                "code" => "",               // [원산지지역 코드, 옵션, string],
                "isMultipleOrigin" => "",               // [복수원산지 여부, 옵션, Boolean]
            ];
        }

        $sellerShop = null;
        if(!empty($data['sellerShop'])){
            $sellerShop = [
                "catCode" => "",               // [판매자 카테고리코드, 옵션, string],
                "catName" => "",               // [판매자 카테고리명, 옵션, string],
                "brandCode" => "",               // [판매자 브랜드코드, 옵션, string],
                "brandName" => "",               // [판매자 브랜드명, 옵션, string]
            ];
        }

        $capacity = null;
        if(!empty($data['capacity'])){
            $capacity = [
                "vol" => "",               // [(옥션상품용), 옵션, string],
                "unit" => "",               // [(옥션상품용), 옵션, int]
            ];
        }



        $childDetails = null;
        if(!empty($data['childDetails'])){
            $childDetails = [
                "certId" => "",               // [통합어린이인증코드, 옵션, string],
                "certTargetCode" => "",               // [통합어린이인증품목, 옵션, int]
            ];
        }

        $electricDetails = null;
        if(!empty($data['electricDetails'])){
            $electricDetails = [
                "certId" => "",               // [통합전기인증코드, 옵션, string],
                "certTargetCode" => "",               // [통합전기인증품목, 옵션, int]
            ];
        }

        $lifeDetails = null;
        if(!empty($data['lifeDetails'])){
            $lifeDetails = [
                "certId" => "",               // [통합생활용품인증코드, 옵션, string],
                "certTargetCode" => "",               // [통합생활용품인증품목, 옵션, int]
            ];
        }

        // 데이터 설정
        $api_data = [
            "itemBasicInfo" => [
                "goodsName" => [
                    "kor" => $goodsName_kor,                            // [검색용 상품명 (국문), 필수, stirng],
                    "promotion" => $data['goodsName_promotion'],        // [프로모션명 (공통, 지마켓), 옵션, string],
                    "promotionType" => 1,                               // [프로모션명 타입, 옵션, int],
                    "promotionIac" => $data['goodsName_promotion'],     // [프로모션명 (옥션), 옵션, string],
                    "eng" => "",                                        // [영문상품명, 옵션, string],
                    "chi" => "",                                        // [중문상품명, 옵션, string]
                ],
                "category" => [
                    "esm" => [
                        "catCode" => $data['esm_cate'],               // [ESM 카테고리 코드, 옵션, string]
                    ],
                    "site" => [
                        [
                            "siteType" => 1,              // [G마켓/옥션 카테고리 사이트구분, 필수, int],
                            "catCode" => $ac_cate   // [G마켓/옥션 카테고리코드, 필수, string]
                        ],
                        [
                            "siteType" => 2,              // [G마켓/옥션 카테고리 사이트구분, 필수, int],
                            "catCode" => $gm_cate   // [G마켓/옥션 카테고리코드, 필수, string]
                        ]
                    ],
                    "shop" => null
                ],
                "catalog" => $catalog,
            ],
            "itemAddtionalInfo" => [
                "buyableQuantity" => $itemAddtionalInfoBuyableQuantity,
                "price" => [
                    "Gmkt" => $price,               // [G마켓 판매가격, 필수, number],
                    "Iac" => $price,               // [옥션 판매가격, 필수, number]
                ],
                "stock" => [
                    "Gmkt" => (int)str_replace(",","",$data['stock']),               // [G마켓 재고수량, 필수, int],
                    "Iac" => (int)str_replace(",","",$data['stock']),               // [옥션 재고수량, 필수, int]
                ],
                "sellingPeriod" => [
                    "Gmkt" => $sellingPeriod,               // [G마켓 판매기간, 필수, int],
                    "Iac" => $sellingPeriod,               // [옥션 판매기간, 필수, int]
                ],
                "managedCode" => $managedCode,               // [판매자 상품코드, 옵션, string],
                "recommendedOpts" => $recommendedOpts,
                "orderOpts" => null,
                "inventoryCode" => null,               // [(G마켓용), 옵션, string],
                "sellerShop" => null,
                "expiryDate" => null,               // [유효일, 옵션, date],
                "manufacturedDate" => null,               // [제조일(발행일), 옵션, date],
                "capacity" => null,
                "shipping" => [
                    "type" => $shippingType,               // [배송방법 타입, 필수, int],
                    "companyNo" => $companyNo,               // [택배사코드, 필수, int],
                    "policy" => $policy,
                    "returnAndExchange" => [
                        "addrNo" => $returnAndExchangeAddrNo,               // [(반품/교환 주소), 옵션, int],
                        "fee" => (int)$data['returnAndExchange'],               // [반품/교환 편도배송비, 옵션, number]
                    ],
                    "dispatchPolicyNo" => $dispatchPolicyNo,
                    "visitAndTake" => $shippingVisitAndTake,
                    "quickService" => $shippingQuickService,
                ],
                "officialNotice" => $data['officialNotice'],
                "isAdultProduct" => $isAdultProduct,               // [청소년구매불가, 필수, Boolean],
                "isVatFree" => $isVatFree,               // [부가세여부, 필수, Boolean],
                "certInfo" => [
                    "gmkt" => [
                        "certId" => [],               // [(G마켓용), 옵션, string],
                        "licenseSeq" => null,               // [(G마켓용), 옵션, string]
                    ],
                    "iac" => null,
                    "safetyCerts" => [
                        "child" => [
                            "type" => 2,               // [통합어린이인증 타입, 필수, int],
                            "details" => null
                        ],
                        "electric" => [
                            "type" => 2,               // [통합전기인증 타입, 필수, int],
                            "details" => null,
                            "mandatorySafetySign" => 0,               // [병행수입여부, 옵션, int]
                        ],
                        "life" => [
                            "type" => 2,               // [통합생활용품인증 타입, 필수, int],
                            "details" => null,
                            "mandatorySafetySign" => 0,               // [병행수입여부, 옵션, int]
                        ],
                        "harmful" => [
                            "type" => 2,               // [위해우려제품인증 타입, 옵션, int],
                            "certId" => null,               // [통합자가검사번호, 옵션, string]
                        ]
                    ]
                ],
                "images" => $data['images'],
                "descriptions" => [
                    "kor" => [
                        "type" => 2,               // [상품상세정보 타입, 필수, int],
                        "html" => $data['html_kor'],               // [상품상세정보 html, 필수, string]
                    ]
                ],
                "addonService" => $addonService,
                "goodsStatus" => $data['goodsStatus'],               // [상품상태, 옵션, int],
                "isGift" => false,               // [선물하기 상품 여부, 옵션, boolean],
            ],
            "addtionalInfo" => [
                "sellerDiscount" => $addtionalInfo_sellerDiscount,
                "siteDiscount" => $siteDiscount,
                "pcs" => $pcs,
                "overseaSales" => [
                    "isAgree" => false,               // [(G마켓용), 필수, Boolean]
                ]
            ],
            "isSell" => [
                "gmkt" => $isSellGmkt,               // [(G마켓용), 필수, Boolean],
                "iac" => $isSellIac,               // [(옥션용), 필수, Boolean]
            ]
        ];

        $postData = json_encode($api_data);

        $options = [
            CURLOPT_URL => $data['api_url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => $data['api_method'],
            CURLOPT_HTTPHEADER => $headerArray,
            CURLOPT_POSTFIELDS => $postData
        ];

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $body = json_decode($response, true);

        if(!empty($body['resultCode'])){
            return ["code" => 400, "msg" => $response];
        }

        if(empty($body['goodsNo'])){
            return ["code" => 400, "msg" => $response];
        }


        $goods_no = $body['goodsNo'];
        $gmkt_no = $body['siteDetail']['gmkt']['SiteGoodsNo'];
        $iac_no = $body['siteDetail']['iac']['SiteGoodsNo'];

        $goodsArr = $this->getGoods($body);
        $goodsData = $goodsArr['body'];
        $goodsData = json_decode($goodsData, true);

        $goodsData['w'] = $data['w'];
        $goodsData['goods_no'] = $goods_no;
        $goodsData['gmkt_no'] = $gmkt_no;
        $goodsData['iac_no'] = $iac_no;
        $goodsData['gm_cate'] = $gm_cate;
        $goodsData['ac_cate'] = $ac_cate;
        $goodsData['endSellDate'] = $futureDate;
        $goodsData['cate_name'] = $data['cate_name'];
        $goodsData['brandNo'] = $data['brandNo'];
        $goodsData['brandName'] = $data['brandName'];
        $goodsData['makerName'] = $data['makerName'];
        $goodsData['productBrandName'] = $data['productBrandName'];
        $goodsData['mb_id'] = $mb_id;
        $goodsData['b2pAuto'] = $data['b2pAuto'];
        $goodsData['useOption'] = $useOption;

        $db_data = $this->updateGoods($goodsData);

        // 지마켓만 실패했을경우
        if(empty($gmkt_no)){
            $SiteGoodsComment = $body['siteDetail']['gmkt']['SiteGoodsComment'];
            return ["code" => 201,"msg" => $SiteGoodsComment, 'goods_no'=>$goods_no];
        }

        // 옥션만 실패했을경우
        if(empty($iac_no)){
            $SiteGoodsComment = $body['siteDetail']['iac']['SiteGoodsComment'];
            return ["code" => 202, "msg" => $SiteGoodsComment, 'goods_no'=>$goods_no];
        }

        // 결과를 객체나 배열로 반환
        return [
            'msg' => '저장하였습니다.',
            'code' => 200,
            'goods_no'=>$goods_no
        ];
    }

    public function getGoods($data){

        $data['api_type'] = GMAC;
        $data['api_method'] = "GET";
        $data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$data['goodsNo']}";
        $result = $this->callApi($data);
        return $result = $this->callApi($data);
    }

    public function updateGoods($goodsData){
        $db_data = null;

        // isSell
        $db_data['isSell_gmkt'] = empty($goodsData['isSell']['gmkt']) || $goodsData['isSell']['gmkt'] == false ? "F" : "T";
        $db_data['isSell_iac'] = empty($goodsData['isSell']['iac']) || $goodsData['isSell']['iac'] == false ? "F" : "T";

        // itemBasicInfo
        $itemBasicInfoData = $goodsData['itemBasicInfo'];

        // itemBasicInfo > goodsName
        $goodsNameData = $itemBasicInfoData['goodsName'];
        $db_data['goodsName_kor'] = $goodsNameData['kor'];
        $db_data['goodsName_chi'] = $goodsNameData['chi'];
        $db_data['goodsName_eng'] = $goodsNameData['eng'];
        $db_data['goodsName_jpn'] = $goodsNameData['jpn'];
        $db_data['promotion'] = $goodsNameData['promotion'];
        $db_data['promotionType'] = $goodsNameData['promotionType'];
        $db_data['promotionIac'] = $goodsNameData['promotionIac'];

        $db_data['is3PL'] = $itemBasicInfoData['is3PL'] ? "T" : "F";
        $db_data['goodsType'] = $itemBasicInfoData['goodsType'];

        // itemAddtionalInfo
        $itemAddtionalData = $goodsData['itemAddtionalInfo'];
        $db_data['buyableQuantity'] = json_encode($itemAddtionalData['buyableQuantity'],JSON_UNESCAPED_UNICODE);
        $db_data['buyableQuantityPolicy'] = json_encode($itemAddtionalData['buyableQuantityPolicy'],JSON_UNESCAPED_UNICODE);
        $db_data['price_gmkt'] = $itemAddtionalData['price']['Gmkt'];
        $db_data['price_iac'] = $itemAddtionalData['price']['Iac'];
        $db_data['price'] = empty($db_data['price_gmkt']) ? $db_data['price_iac'] : $db_data['price_gmkt'];
        $db_data['stock_gmkt'] = $itemAddtionalData['stock']['Gmkt'];
        $db_data['stock_iac'] = $itemAddtionalData['stock']['Iac'];

        $db_data['stock'] = min(empty($db_data['stock_gmkt'])?99999:$db_data['stock_gmkt'],empty($db_data['stock_iac'])?99999:$db_data['stock_iac']);

        $db_data['recommendedOpts'] = json_encode($itemAddtionalData['recommendedOpts'],JSON_UNESCAPED_UNICODE);
        $db_data['orderOpts'] = json_encode($itemAddtionalData['orderOpts'],JSON_UNESCAPED_UNICODE);
        $db_data['sellingPeriod'] = $itemAddtionalData['sellingPeriod']['Gmkt'];
        $db_data['managedCode'] = $itemAddtionalData['managedCode'];
        $db_data['inventoryCode'] = $itemAddtionalData['inventoryCode'];
        $db_data['sellerShop'] = json_encode($itemAddtionalData['sellerShop']);
        $db_data['expiryDate'] = $itemAddtionalData['expiryDate'];
        $db_data['manufacturedDate'] = $itemAddtionalData['manufacturedDate'];
        $db_data['origin'] = json_encode($itemAddtionalData['origin'],JSON_UNESCAPED_UNICODE);
        $db_data['capacity'] = json_encode($itemAddtionalData['capacity'],JSON_UNESCAPED_UNICODE);
        $db_data['shipping'] = json_encode($itemAddtionalData['shipping'],JSON_UNESCAPED_UNICODE);
        // shipping 세분화해서 검색용으로 저장
        $shipping = json_decode($db_data['shipping'], true);
        $db_data['shippingType'] = isset($shipping['policy']['feeType']) ? $shipping['policy']['feeType'] : "";
        $db_data['companyNo'] = isset($shipping['companyNo']) ? $shipping['companyNo'] : "";
        $db_data['placeNo'] = isset($shipping['policy']['placeNo']) ? $shipping['policy']['placeNo'] : "";
        $db_data['bundleNo'] = isset($shipping['policy']['bundle']['deliveryTmplId']) ? $shipping['policy']['bundle']['deliveryTmplId'] : "";
        $db_data['addrNo'] = isset($shipping['returnAndExchange']['addrNo']) ? $shipping['returnAndExchange']['addrNo'] : "";
        $db_data['dispatchPolicyNo_gmkt'] = isset($shipping['dispatchPolicyNo']['gmkt']) ? $shipping['dispatchPolicyNo']['gmkt'] : "";
        $db_data['dispatchPolicyNo_iac'] = isset($shipping['dispatchPolicyNo']['iac']) ? $shipping['dispatchPolicyNo']['iac'] : "";

        $db_data['officialNotice'] = json_encode($itemAddtionalData['officialNotice'],JSON_UNESCAPED_UNICODE);
        $db_data['isAdultProduct'] = $itemBasicInfoData['isAdultProduct'] ? "T" : "F";
        $db_data['isVatFree'] = $itemBasicInfoData['isVatFree'] ? "T" : "F";
        $db_data['certInfo'] = json_encode($itemAddtionalData['certInfo'],JSON_UNESCAPED_UNICODE);
        $db_data['images'] = json_encode($itemAddtionalData['images'],JSON_UNESCAPED_UNICODE);
        $db_data['weight'] = $itemAddtionalData['weight'];

        $db_data['descriptions'] = json_encode($itemAddtionalData['descriptions'],JSON_UNESCAPED_UNICODE);
        $db_data['descriptions'] = sql_real_escape_string($db_data['descriptions']);
        $db_data['addonService'] = json_encode($itemAddtionalData['addonService'],JSON_UNESCAPED_UNICODE);
        $db_data['skuInfo'] = json_encode($itemAddtionalData['skuInfo'],JSON_UNESCAPED_UNICODE);
        $db_data['goodsStatus'] = $itemAddtionalData['goodsStatus'];
        $db_data['preSaleShippingDate'] = $itemAddtionalData['preSaleShippingDate'];
        $db_data['isGift'] = $itemBasicInfoData['isGift'] ? "T" : "F";
        $db_data['eCoupon'] = json_encode($itemAddtionalData['eCoupon'],JSON_UNESCAPED_UNICODE);
        $db_data['install'] = json_encode($itemAddtionalData['install'],JSON_UNESCAPED_UNICODE);


        // addtionalInfo
        $addtionalData = $goodsData['addtionalInfo'];
        $db_data['sellerDiscount'] = json_encode($addtionalData['sellerDiscount'],JSON_UNESCAPED_UNICODE);
        $db_data['siteDiscount'] = json_encode($addtionalData['siteDiscount'],JSON_UNESCAPED_UNICODE);
        $db_data['pcs'] = json_encode($addtionalData['pcs'],JSON_UNESCAPED_UNICODE);
        $db_data['overseaSales'] = json_encode($addtionalData['overseaSales'],JSON_UNESCAPED_UNICODE);

        //판매기간
        if(!empty($goodsData['endSellDate'])){
            $db_data['endSellDate'] = $goodsData['endSellDate'];
        }

        // 오토아이시스
        if(isset($goodsData['b2pAuto'])){
            $db_data['b2pAuto'] = $goodsData['b2pAuto'];
        }

        //브랜드 코드
        if(isset($goodsData['brandNo'])){
            $db_data['brandNo'] = $goodsData['brandNo'];
            $db_data['brandName'] = $goodsData['brandName'];
            $db_data['makerName'] = $goodsData['makerName'];
            $db_data['productBrandName'] = $goodsData['productBrandName'];
        }

        if(isset($goodsData['useOption'])){
            $db_data['useOption'] = $goodsData['useOption'];
        }


        if(empty($goodsData['w'])){
            $db_data['goods_no'] = $goodsData['goods_no'];
            $db_data['gmkt_no'] = $goodsData['gmkt_no'];
            $db_data['iac_no'] = $goodsData['iac_no'];
            $db_data['cate_name'] = $goodsData['cate_name'];

            // itemBasicInfo -> category
            $categoryData = $itemBasicInfoData['category'];

            // category -> site
            $siteData = $categoryData['site'];
            $db_data['catCode_gmkt'] = $goodsData['gm_cate'];
            $db_data['catCode_iac'] = $goodsData['ac_cate'];

            // category -> esm
            $db_data['catCode_esm'] = $categoryData['esm']['catCode'];




            $insert_str = array_to_sql_insert_str($db_data);

            $sql_c = " $insert_str, `mb_id` = '{$goodsData['mb_id']}'";

            $sql = "INSERT INTO `goods_list` SET $sql_c";
            sql_query($sql);


        } else {
            $db_data['edit_date'] = date("Y-m-d h-i-s");
            if(empty($db_data['goodsName_kor'])){
                $sql = "update `goods_list` set `is_view` = 'F'  where `goods_no` = '{$goodsData['goods_no']}'";
                sql_query($sql);
            } else {
                $sql_c = array_to_sql_insert_str($db_data);

                $sql = "update `goods_list` SET $sql_c where `goods_no` = '{$goodsData['goods_no']}'";
                sql_query($sql);
            }


        }

        return $db_data;
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
            if($sf == "placeNo"){
                $where .= " and `$sf` = '$st'";
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

        $return_data['sql'] = $sql;
        $return_data['list'] = $row = sql_fetch_array($re);
        return $return_data;
    }

    // 엑셀 to DB
    public function cronExcelToDB(){
        $directory = WRITEPATH . 'uploads/goods';
        $files = glob($directory . '/*'); // 모든 파일 가져오기

        if (empty($files)) {
            return; // 파일이 없으면 작업을 종료합니다.
        }

        // 파일을 생성 날짜 기준으로 정렬합니다.
        usort($files, function ($a, $b) {
            return filemtime($a) - filemtime($b);
        });

        // 가장 오래된 파일을 선택합니다.
        $oldestFile = $files[0];
        $filename = basename($oldestFile);
        $mb_id = explode("_",$filename)[0];
        $filePath = $directory . '/' . $filename;

        // 엑셀 파일을 로드하고 작업을 수행합니다.
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();

            // 작업이 완료되면 파일을 삭제합니다.
            unlink($filePath);
        } catch (\Exception $e) {
            // 예외가 발생하면 로그를 남기거나 오류를 처리합니다.
            log_message('error', 'Error processing file: ' . $filename . '. Error: ' . $e->getMessage());
        }

        $highestRow = $worksheet->getHighestRow(); // 스프레드시트의 최대 행 수를 가져옵니다.

        $startRow = 7;
        if ($startRow <= $highestRow) {
            foreach ($worksheet->getRowIterator($startRow) as $row) {
                $cellIterator = $row->getCellIterator('B'); // 'B'열부터 시작
                $cellIterator->setIterateOnlyExistingCells(FALSE);

                $rowData = [];
                $bValue = null;
                $cValue = null;
                $dValue = null;
                foreach ($cellIterator as $cell) {
                    $column = $cell->getColumn();
                    $value = $cell->getValue();

                    if ($column == 'B') {
                        $bValue = $value;
                    } elseif ($column == 'C') {
                        $cValue = $value;
                    } elseif ($column == 'D') {
                        $value = preg_replace('/[!@#$%^&*()_+{}:"<>?=\[\];\',.\/`-]/', '', $value);
                        $value = trim(sql_real_escape_string($value));
                        $dValue = $value;
                    }

                    $rowData[strtolower($column)] = $value;
                }

                if ((empty($bValue) || $bValue == 'F') && (empty($cValue) || $cValue == 'F')) {
                    break; // B와 C가 동시에 빈 값이거나 'F'이면 루프 중지
                }

                $sql = "select * from `goods_list` where `goodsName_kor` = '$dValue' and `mb_id` = '$mb_id'";
                $row = sql_fetch($sql);
                if(!empty($row)){
                    continue;
                }

                $jsonData = json_encode($rowData, JSON_UNESCAPED_UNICODE);
                $jsonData = sql_real_escape_string($jsonData);
                $sql = "insert into `goods_excel_upload` set `excel_row` = '$jsonData', `mb_id` = '$mb_id'";
                sql_query($sql);
            }
        }


    }

    // DB to api
    public function cronDBToApi(){
        $sql = "update `goods_excel_upload` set `count` = `count`+1, `is_process` = 'F' WHERE `is_success` IS NULL AND `is_process` = 'T' and `count` <= 3";
        log_message('error',$sql);
        sql_query($sql);

        $sql = "select * from `goods_excel_upload` where `is_process` = 'F' and `count` <= 3 order by `idx` desc limit 1";
        log_message('error',$sql);
        $re = sql_query($sql);
        $rows = sql_fetch_array($re);

        if(count($rows) == 0){
            log_message('error','카운터 : 0');
            return false;
        }

        for($i=0;$i<count($rows); $i++){
            $data_row = $rows[$i];
            $sql = "update `goods_excel_upload` set `is_process` = 'T' where `idx` = '{$data_row['idx']}'";
            sql_query($sql);
        }

        for($i=0;$i<count($rows); $i++){
            $data_row = $rows[$i];

            $excel_row = $data_row['excel_row'];
            $row = json_decode($excel_row, true);

            $data = [];
            $data['w']  = "";
            $data['api_url'] = "https://sa2.esmplus.com/item/v1/goods";
            $data['api_method'] = "POST";
            $data['is_upload'] = "T";
            $data['mb_id'] = $data_row['mb_id'];

            $data['useAuction'] = ($row['b'] == 'F' || empty($row['b'])) ? null : "T"; // 판매사이트 옥션
            $data['useGmarket'] = ($row['c'] == 'F' || empty($row['c'])) ? null : "T"; // 판매사이트 지마켓
            $data['goodsName_kor'] = $row['d'];             // 상품명

            $sql = "select * from `goods_list` where `goodsName_kor` = '{$row['d']}' and `mb_id` = '{$data_row['mb_id']}'";
            $row2 = sql_fetch($sql);
            if(!empty($row2)){
                continue;
            }

            $data['goodsName_promotion'] = $row['e'];       // 프로모션 문구
            $data['esm_cate'] = $row['f'];      // esm 코드
            $data['ac_cate'] = $row['g'];       // 옥션 카테고리
            $data['gm_cate'] = substr($row['h'], -9); // 지마켓 카테고리
            $data['price'] = $row['i'];         // 판매가

            $api_data['api_type'] = GMAC;
            $api_data['api_method'] = "GET";
            $api_data['api_url'] = "https://sa2.esmplus.com/item/v1/categories/sd-cats/{$data['esm_cate']}/site-cats";
            $cateResult = $this->callApi($api_data);
            $cateResult = json_decode($cateResult['body'], true);
            $data['cate_name'] = empty($cateResult['MatchedCategory']['Gmkt'][0]['catName']) ? $cateResult['MatchedCategory']['Iac'][0]['catName'] : $cateResult['MatchedCategory']['Gmkt'][0]['catName'];

            // 할인유형

            $data['sellerDiscountType'] = $row['j'];    // 할인유형
            $data['sellerDiscount'] = empty($row['j']) ? 'F' : 'T';   // 할인 사용여부
            $data['discountprice'] = $row['k']; // 할인가
            $data['startDate'] = $row['l'];     // 할인 시작 기간
            $data['endDate'] = $row['m'];       // 할인 종료 기간
            $data['periodValue'] = empty($row['n']) ? '-1' : $row['n'];
            $data['sellingPeriod'] = $data['periodValue'] == '-1' ? "F" : "T";     // 판매기간
            $data['isVatFree'] = $row['o'];     // 부과세
            $data['stock'] = empty($row['p']) ? 99999 : $row['p'];      // 재고수량
            $data['basicImgURL'] = $row['q'];           // 기본 이미지
            $data['addtionalImg'] = explode(",",$row['r']);       // 추가 이미지
            $data['html_kor'] = $row['s'];      // 상품상세설명
            $data['goodsStatus'] = $row['t'];   // 상품상태
            $data['isAdultProduct'] = $row['u'];    // 구매연령
            $data['buyableQuantity'] = empty($row['v']) ? 'F' : 'T';    // 최대 구매 제한 사용 여부
            $data['buyableQuantityQty'] = $row['w'];    // 최대 구매 제한 수량
            $data['buyableQuantityChild'] = $row['v'];      // 최대 구매 제한
            $data['buyableQuantityUnitDate'] = $row['x'];   // 최대 구매 제한 일수
            $data['shippingType'] = $row['y'];      // 배송방법
            $data['companyNo'] = $row['z'];         // 택배사
            $data['quickService'] = empty($row['aa']) ? 'F' : 'T';  // 퀵 사용여부
            $data['quickList'] = explode(',',$row['aa']);   // 퀵서비스 가능지역
            $data['quickCompanyName'] = $row['ab'];     // 퀵서비스 업체명
            $data['quickCompanyHp'] = $row['ac'];       // 퀵서비스 연락처
            $data['dispatchPolicyNo'] = empty($row['ae']) ? $row['ad'] : $row['ae'];     // 발송정책
            $data['placeNo'] = $row['af'];      // 출고(하)지 코드
            $data['shippingPolicyFeeType'] = $row['ag'];        // 묶음배송
            $data['deliveryTmplId'] = $row['ah'];       // 묶음배송 코드
            $data['basic_delivery_price'] = $row['ai'];     // 배송비
            $data['condition_delivery_price'] = $row['ai']; // 조건부 배송비
            $data['condition_over_price'] = $row['aj'];     // 조건부 배송비 조건

            // 배송비 타입
            if(empty($data['basic_delivery_price'])){
                $data['eachFeeType'] = 1;
            } else if(empty($data['condition_over_price'])){
                $data['eachFeeType'] = 2;
            } else {
                $data['eachFeeType'] = 3;
            }

            $data['returnAndExchangeAddrNo'] = $row['ak'];      // 반품/교환지 코드
            $data['returnAndExchange'] = $row['al'];            // 반품/교환지 배송비


            // 선택형 옵셥
            $data['optsType'] = $row['am'];     // 주문옵션타입
            $data['useSelectOption'] = empty($data['optsType']) ? 'F' : 'T';    // 주문옵션 사용여부


            $optionArray = [$row['ao']];
            if (strpos($row['ao'], "\n") !== false) {
                $optionArray = explode("\n", $row['ao']);
            }

            $data['useOptionStockmanager'] = "F";
            if($data['optsType'] == 'i'){
                $data['useOptionStockmanager'] = "T";
                // 단독형
                $data['optionName'] = [];
                for($j=0;$j<count($optionArray);$j++){
                    $optionData = explode(",",$optionArray[$j]);

                    $data['optionName'][] = $optionData[0];        // 옵션명
                    $data['optionValue'][] = $optionData[1];        // 옵션값
                    $data['optionSaleStatus'][] = $optionData[2]=="정상" ? "T":"F";        // 옵션상태 (정상, 품절)
                    $data['optionDisplayStatus'][] = $optionData[3]=="노출" ? "T":"F";        // 노출여부 (노출, 미노출)
                    $data['optionExtraPrice'][] = $optionData[4];        // 추가금
                    $data['optionStock'][] = $optionData[5];        // 재고
                }
            } else if($data['optsType'] == 'c'){
                $data['useOptionStockmanager'] = "T";
                // 조합형
                $data['optionName'] = explode(",",$row['an']);  // 옵션명
                $optionCount = count($data['optionName']);
                for($j=0;$j<count($optionArray);$j++){
                    $optionData = explode(",",$optionArray[$j]);
                    $data['optionValue0'][] = $optionData[0];        // 옵션값1
                    $data['optionValue1'][] = $optionData[1];        // 옵션값2
                    if($optionCount == 3){
                        $data['optionValue2'][] = $optionData[2];        // 옵션값3
                        $data['optionSaleStatus'][] = $optionData[3]=="정상" ? "T":"F";        // 옵션상태 (정상, 품절)
                        $data['optionDisplayStatus'][] = $optionData[4]=="노출" ? "T":"F";        // 노출여부 (노출, 미노출)
                        $data['optionExtraPrice'][] = $optionData[5];        // 추가금
                        $data['optionStock'][] = $optionData[6];        // 재고
                    } else {
                        $data['optionSaleStatus'][] = $optionData[2]=="정상" ? "T":"F";        // 옵션상태 (정상, 품절)
                        $data['optionDisplayStatus'][] = $optionData[3]=="노출" ? "T":"F";        // 노출여부 (노출, 미노출)
                        $data['optionExtraPrice'][] = $optionData[4];        // 추가금
                        $data['optionStock'][] = $optionData[5];        // 재고
                    }
                }

            }

            // 텍스트형 옵션
            $data['b2pAuto'] = empty($row['ap']) || $row['ap'] == 'F' ? "F" : "T";     // 정비소 옵션 사용여부
            $data['useOptionText'] = empty($row['aq']) || $row['aq'] == 'F' ? "F" : "T";
            $optionArray = [$row['aq']];
            if (strpos($row['aq'], "\n") !== false) {
                $optionArray = explode("\n", $row['aq']);
            }
            for($j=0;$j<count($optionArray);$j++){
                $optionData = explode(",",$optionArray[$j]);
                $data['textOptionName'][] = $optionData[0];        // 옵션명
                $data['displayTextOptionName'][] = $optionData[1]=="노출" ? "T":"F";        // 노출여부 (노출, 미노출)
            }




            // 추가구성
            $data['useAddonService'] = empty($row['ar']) ? "F" : "T";     // 추가구성 사용여부
            $optionArray = [$row['ar']];
            if (strpos($row['ar'], "\n") !== false) {
                $optionArray = explode("\n", $row['ar']);
            }
            for($j=0;$j<count($optionArray);$j++){
                $optionData = explode(",",$optionArray[$j]);

                $data['addonName'][] = $optionData[0];        // 옵션명
                $data['addonValue'][] = $optionData[1];        // 옵션값
                $data['addonSaleStatus'][] = $optionData[2]=="정상" ? "T":"F";        // 옵션상태 (정상, 품절)
                $data['addonDisplayStatus'][] = $optionData[3]=="노출" ? "T":"F";        // 노출여부 (노출, 미노출)
                $data['addonExtraPrice'][] = $optionData[4];        // 추가금
                $data['addonStock'][] = $optionData[5];        // 재고
            }
            $return_data = $this->setGoods($data);
            $return_json = sql_real_escape_string(json_encode($return_data, JSON_UNESCAPED_UNICODE));

            $goods_name = sql_real_escape_string($data['goodsName_kor']);
            $goods_no = $return_data['goods_no'];

            if(!empty($return_data['msg'])){
                $return_data['msg'] = sql_real_escape_string($return_data['msg']);
            }


            if($return_data['code'] == 200){
                $sql = "update `goods_excel_upload` set `goods_no` = '$goods_no', `goods_name` = '$goods_name', `is_success` = 'T', `return_data` = '$return_json' where `idx` = '{$data_row['idx']}'";
                sql_query($sql);
            } else if($return_data['code'] == 201){
                // 지마켓만 성공
                $sql = "update `goods_excel_upload` set `goods_no` = '$goods_no', `goods_name` = '$goods_name', `is_success` = 'T', `reason` = '옥션만 등록 성공 {$return_data['msg']}', `return_data` = '$return_json' where `idx` = '{$data_row['idx']}'";
                sql_query($sql);
            } else if($return_data['code'] == 202){
                // 옥션만 성공
                $sql = "update `goods_excel_upload` set `goods_no` = '$goods_no', `goods_name` = '$goods_name', `is_success` = 'T', `reason` = '지마켓만 등록 성공 {$return_data['msg']}', `return_data` = '$return_json'where `idx` = '{$data_row['idx']}'";
                sql_query($sql);
            } else {
                $sql = "update `goods_excel_upload` set `goods_no` = '$goods_no', `goods_name` = '$goods_name', `is_success` = 'F', `reason` = '{$return_data['msg']}', `return_data` = '$json_return' where `idx` = '{$data_row['idx']}'";
                sql_query($sql);
            }
        }

        return true;

    }


    // 상품리스트
    public function getGoodsList($data){
        $where = " where `is_view` = 'T' ";

        // mb_id와 mb_level 체크
        if(isset($data['member']['mb_id']) && isset($data['member']['mb_level'])){
            $mb_id = $data['member']['mb_id'];
            $mb_level = (int)$data['member']['mb_level'];

            if($mb_level < 9){
                $where .= " and `mb_id` = '{$mb_id}'";
            }
        }

        // 상품코드 검색
        $where_no = "";
        if(!empty($data['st_no'])){
            if($data['sf_no'] == "goods_no"){
                $st_no = explode(",",$data['st_no']);
                foreach ($st_no as $i => $no){
                    if(empty(trim($no))){
                        continue;
                    }
                    if($where_no == ""){
                        $where_no = " `goods_no` = '{$no}' or `gmkt_no` = '{$no}' or `iac_no` = '{$no}' ";
                    } else {
                        $where_no .= " or `goods_no` = '{$no}' or `gmkt_no` = '{$no}' or `iac_no` = '{$no}' ";
                    }
                }
            }
        }

        if(!empty($where_no)){
            $where .= " and ({$where_no})";
        }

        // 상품명 검색
        if(!empty($data['st_name'])){
            if($data['sf_name'] == "goods_name"){
                $where .= " and (`goodsName_kor` like '%{$data['st_name']}%') ";
            }
        }

        // 판매상태 검색
        if(!(($data['sellState_t'] == 'T' && $data['sellState_s'] == 'T') || ($data['sellState_t'] == 'F' && $data['sellState_s'] == 'F'))){
            if($data['sellState_t'] == "T"){
                $where .= " and (`isSell_gmkt` = 'T' or `isSell_iac` = 'T')";
            } else if($data['sellState_s'] == "T"){
                $where .= " and (`isSell_gmkt` = 'F' or `isSell_iac` = 'F')";
            }
        }

        // 카테고리 검색
        if(!empty($data['esm_category_code'])){
            $where .= " and (`catCode_esm` like '%{$data['esm_category_code']}%') ";
        }

        // 날짜 검색
        if(!empty($data['start_date']) && !empty($data['end_date'])){
            $start_date = "{$data['start_date']} 00:00:00";
            $end_date = "{$data['end_date']} 23:59:59";
            if($data['sf_date'] == "1"){
                // 상품등록일
                $where .= " and (`reg_date` >= '{$start_date}' and `reg_date` <= '{$end_date}' )";
            } else if($data['sf_date'] == "1"){
                // 판매종료일
                $where .= " and (`endSellDate` >= '{$start_date}' and `endSellDate` <= '{$end_date}' )";
            } else if($data['sf_date'] == "1"){
                // 최종수정일조회
                $where .= " and (`edit_date` >= '{$start_date}' and `edit_date` <= '{$end_date}' )";
            }
        }

        // 상세검색

        // 판매기간
        if(!empty($data['sf_sellDate'])){
            $where .= " and endSellDate BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL {$data['sf_sellDate']} DAY)";
        }

        // 재고
        if(!empty($data['sf_stock'])){
            $where .= " and `stock` <= {$data['sf_stock']}";
        }

        // 옵션사용여부
        if(!empty($data['sf_useOption'])){
            $where .= " and `useOption` = '{$data['sf_useOption']}'";
        }

        // 배송비 타입
        if(!empty($data['sf_shippingType'])){
            $where .= " and `shippingType` = '{$data['sf_shippingType']}'";
        }

        // 발송정책
        if(!empty($data['sf_policyNo'])){
            $gmkt_policyNo = explode(",",$data['sf_policyNo'])[0];
            $iac_policyNo = explode(",",$data['sf_policyNo'])[1];
            $where .= " and (`dispatchPolicyNo_gmkt` = '{$gmkt_policyNo}' or `dispatchPolicyNo_iac` = '{$iac_policyNo}')";
        }


        $sql = "select * from `goods_list` $where";
        $re = sql_query($sql);
        $rows = sql_fetch_array($re);
        $total_count = sql_num_rows($re);
        $return_data['total_count'] = $total_count;

        // 페이지 번호와 페이지당 아이템 수 설정
        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $items_per_page = isset($data['items_per_page']) ? (int) $data['items_per_page'] : 20;
        $return_data['items_per_page'] = $items_per_page;

        // 시작 위치 계산 (0 기반 인덱스)
        $start_limit = ($page - 1) * $items_per_page;

        // 실제 데이터 리스트 만들기
        $sql = "SELECT * FROM `goods_list` $where ORDER BY `idx` DESC LIMIT $start_limit, $items_per_page";
        $re = sql_query($sql);

        $return_data['sql'] = $sql;
        $return_data['list'] = sql_fetch_array($re);

        $allCount_gmkt = 0;
        $allCount_iac = 0;
        $stockCount_gmkt = 0;
        $stockCount_iac = 0;
        $sevenDay_gmkt = 0;
        $sevenDay_iac = 0;
        $sellCount_gmkt = 0;
        $sellCount_iac = 0;
        $endSellCount_gmkt = 0;
        $endSellCount_iac = 0;

        foreach ($rows as $i => $row){
            // 날짜 차이가 7일 이내인지 확인
            $interval = null;
            $days = 0;
            if(!empty($row['endSellDate'])){
                $endSellDate = $row['endSellDate'];
                $endSellDate = new \DateTime($endSellDate);
                $today = new \DateTime();
                $interval = $today->diff($endSellDate);
                $days = $interval->days;
            }


            // 지마켓 사용여부
            if(!empty($row['gmkt_no'])){
                $allCount_gmkt++;

                // 지마켓 판매여부
                if($row['isSell_gmkt'] == 'T'){
                    $sellCount_gmkt++;
                    // 지마켓 재고 7개
                    if($row['stock_gmkt'] <= 10){
                        $stockCount_gmkt++;
                    }

                    if ($interval->invert == 0 && $days <= 7) {
                        if($row['isSell_gmkt'] == 'T'){
                            $sevenDay_gmkt++;
                        }
                    }
                } else {
                    $endSellCount_gmkt++;
                }
            }

            // 옥션 사용여부
            if(!empty($row['iac_no'])){
                $allCount_iac++;

                // 옥션 판매여부
                if($row['isSell_iac'] == 'T'){
                    $sellCount_iac++;
                    // 옥션 재고 7개
                    if($row['stock_iac'] <= 10){
                        $stockCount_iac++;
                    }

                    if ($interval->invert == 0 && $days <= 7) {
                        if($row['isSell_iac'] == 'T'){
                            $sevenDay_iac++;
                        }
                    }
                } else {
                    $endSellCount_iac++;
                }
            }
        }

        $return_data['allCount_gmkt'] = $allCount_gmkt;
        $return_data['allCount_iac'] = $allCount_iac;
        $return_data['stockCount_gmkt'] = $stockCount_gmkt;
        $return_data['stockCount_iac'] = $stockCount_iac;
        $return_data['sevenDay_gmkt'] = $sevenDay_gmkt;
        $return_data['sevenDay_iac'] = $sevenDay_iac;
        $return_data['sellCount_gmkt'] = $sellCount_gmkt;
        $return_data['sellCount_iac'] = $sellCount_iac;
        $return_data['endSellCount_gmkt'] = $endSellCount_gmkt;
        $return_data['endSellCount_iac'] = $endSellCount_iac;

        return $return_data;
    }
}