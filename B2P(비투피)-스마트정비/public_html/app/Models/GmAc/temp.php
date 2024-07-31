<?

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

    $managedCode = $mb_id."_".get_uniqid(true);


    // 데이터 검증

    // 추가구성
    
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
                "manageCode" => $data['addonManageCode'][$index]
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
    if(empty($sellingPeriod)){
        $sellingPeriod = -1;
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
    $optsType = $data['optsType'];


    $recommendedOptsType = 0;

    if ($useSelectOption || $useOptionText) {
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
            $optionName = $result['value'];

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
            $optionValue = $result['value'];

            $data['optionSaleStatus'][$optionIndex] == "T" ? $optionSaleStatus = false : $optionSaleStatus = true;
            $data['optionDisplayStatus'][$optionIndex] == "T" ? $optionDisplayStatus = true : $optionDisplayStatus = false;

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
                'manageCode' => $data['optionManageCode'][$optionIndex],
                'skuInfo' => null,
                'addAmnt' => (int)$data['optionExtraPrice'][$optionIndex]
            ];

            if ($useOptionStockmanager) {
                $detail['qty'] = [
                    'iac' => (int)$data['optionStock'][$optionIndex],
                    'gmkt' => (int)$data['optionStock'][$optionIndex]
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
                'koreanText' => $uniqueOptionNames[0] ?? '',
                'englishText' => null,
                'chineseText' => null,
                'japaneseText' => null,
                'exposeLanguage' => 0
            ],
            'recommendedOptName2' => [
                'koreanText' => $uniqueOptionNames[1] ?? '',
                'englishText' => null,
                'chineseText' => null,
                'japaneseText' => null,
                'exposeLanguage' => 0
            ],
            'recommendedOptName3' => $optionNameCount == 3 ? [
                'koreanText' => $uniqueOptionNames[2] ?? '',
                'englishText' => null,
                'chineseText' => null,
                'japaneseText' => null,
                'exposeLanguage' => 0
            ] : null
        ];

        foreach ($data['optionValue0'] as $combIndex => $optionValues) {
            $data['optionSaleStatus'][$combIndex] == "T" ? $optionSaleStatus = false : $optionSaleStatus = true;
            $data['optionDisplayStatus'][$combIndex] == "T" ? $optionDisplayStatus = true : $optionDisplayStatus = false;

            $detail = [
                'recommendedOptValueNo1' => 0,
                'recommendedOptValueNo2' => 0,
                'recommendedOptValueNo3' => 0,
                'recommendedOptValue1' => [
                    'koreanText' => $data['optionValue0'][$combIndex],
                    'englishText' => null,
                    'chineseText' => null,
                    'japaneseText' => null,
                    'exposeLanguage' => 0
                ],
                'recommendedOptValue2' => [
                    'koreanText' => $data['optionValue1'][$combIndex],
                    'englishText' => null,
                    'chineseText' => null,
                    'japaneseText' => null,
                    'exposeLanguage' => 0
                ],
                'recommendedOptValue3' => $optionNameCount == 3 ? [
                    'koreanText' => $data['optionValue2'][$combIndex],
                    'englishText' => null,
                    'chineseText' => null,
                    'japaneseText' => null,
                    'exposeLanguage' => 0
                ] : null,
                'isSoldOut' => $optionSaleStatus,
                'isDisplay' => $optionDisplayStatus,
                'manageCode' => $data['optionManageCode'][$combIndex],
                'skuInfo' => null,
                'addAmnt' => (int)$data['optionExtraPrice'][$combIndex]
            ];

            if ($useOptionStockmanager) {
                $detail['qty'] = [
                    'iac' => (int)$data['optionStock'][$optionIndex],
                    'gmkt' => (int)$data['optionStock'][$optionIndex]
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
        $recommendedOpts['text']['details'] = []; // 필요한 값을 여기에 설정합니다.
        foreach ($data['textOptionName'] as $index => $value) {
            $result = isStr($value);
            if (!$result['success']) {
                return ['code' => '400', 'msg' => '텍스트 옵션명을 입력해주세요'];
            }
            $value = trim($result['value']);


            $isDisplay = trim(isset($data['displayTextOptionName'][$index])) && trim($data['displayTextOptionName'][$index]) === 'T';
            $recommendedOpts['text']['details'][] = [
                'recommendedOptNo' => 0,
                'isDisplay' => $isDisplay,
                'Value' => $value
            ];
        }
    }



    // 이미지
    if(empty($data['basicImgURL'])){
        return ['code' => 400, "msg" => "대표 이미지 url을 입력해주세요."];
    }

    $add_images = [];
    if (isset($data['addtionalImg']) && is_array($data['addtionalImg'])) {
        for ($i = 1; $i < count($data['addtionalImg']) + 1; $i++) {
            if (!empty($data['addtionalImg'][$i])) {
                $add_images['addtionalImg' . $i . 'URL'] = $data['addtionalImg'][$i];
            }
        }
    }
    $data['images'] = array_merge(["basicImgURL" => $data['basicImgURL']], $add_images);

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
    $row2 = sql_fetch($sql);

    $gmkt_dispatchPolicyNo = $dispatchPolicyNo;
    $iac_dispatchPolicyNo = $row['dispatchPolicyNo'];
    if(empty($row2)){
        $sql = "select * from `dispatch_policies_list` where `dispatchPolicyName` = '{$row['dispatchPolicyName']}' and `dispatchType` = '{$row['dispatchType']}' and `readyDurationDay` = '{$row['readyDurationDay']}' and `dispatchCloseTime` = '{$row['dispatchCloseTime']}' and `api_type` = 'gmarket'";
        $row2 = sql_fetch($sql);

        $gmkt_dispatchPolicyNo = $row['dispatchPolicyNo'];
        $iac_dispatchPolicyNo = $dispatchPolicyNo;
    }

    if(empty($row2)){
        return ['code' => '400', 'msg' => '발송정책을 확인해주세요.'];
    }

    $dispatchPolicyNo = [
        "gmkt" => $gmkt_dispatchPolicyNo,               // [(G마켓용), 필수, int],
        "iac" => $iac_dispatchPolicyNo,               // [(옥션용), 필수, int]
    ];

    // 출고지(출하지) 코드
    $result = isNum($data['placeNo']);
    if (!$result['success']) {
        return ['code' => '400', 'msg' => '출고지(출하지)를 선택 해주세요.'];
    }
    $placeNo = $result['value'];


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
            return ['code' => '400', 'msg' => '묶음배송을 선택해주세요.'];
        }
        $deliveryTmplId = $result['value'];

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
                if($code == "0200"){
                    $haveGyeonggi = true;
                    continue;
                }
                $shippingEnableRegionCode .= $code . ",";
            }
        }

        if(!$haveGyeonggi && empty($shippingEnableRegionCode)){
            return ['code' => '400', 'msg' => '퀵서비스 지역을 선택해주세요.'];
        }

        if($haveGyeonggi){
            if (!empty($data['gyeonggiList'])) {
                // gyeonggiList 체크박스에서 선택된 값들을 배열로 받음
                $selectedGyeonggi = $data['gyeonggiList'];
                foreach ($selectedGyeonggi as $code) {
                    $shippingEnableRegionCode .= $code . ",";
                }
            } else {
                return ['code' => '400', 'msg' => '퀵서비스 경기도 지역을 선택해주세요.'];
            }
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
                    "fee" => (int)str_replace(",","",$data['returnAndExchange']),               // [반품/교환 편도배송비, 옵션, number]
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
            "goodsStatus" => (int)$data['goodsStatus'],               // [상품상태, 옵션, int],
            "isGift" => false,               // [선물하기 상품 여부, 옵션, boolean],
        ],
        "addtionalInfo" => [
            "sellerDiscount" => $addtionalInfo_sellerDiscount,
            "siteDiscount" => [
                "gmkt" => true,               // [(G마켓용), 필수, Boolean],
                "iac" => true,               // [(옥션용), 필수, Boolean]
            ],
            "pcs" => [
                "isUse" => true,               // [가격비교사이트, 필수, Boolean],
                "isUseIacPcsCoupon" => true,               // [(옥션용), 필수, Boolean],
                "isUseGmkPcsCoupon" => true,               // [(사용불가) (G마켓용), 필수, Boolean]
            ],
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
        return ["code" => 400, "msg" => $body['message'], 'api_data' => $api_data];
    }

    if(empty($body['goodsNo'])){
        return ["code" => 400, "msg" => $body['message'],'api_data' => $api_data];
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
    $goodsData['endSellDate'] = $data['endSellDate'];
    $goodsData['cate_name'] = $data['cate_name'];
    $goodsData['brandNo'] = $data['brandNo'];
    $goodsData['brandName'] = $data['brandName'];
    $goodsData['makerName'] = $data['makerName'];
    $goodsData['productBrandName'] = $data['productBrandName'];
    $goodsData['mb_id'] = $mb_id;

    // 지마켓만 실패했을경우
    if(empty($gmkt_no)){
        $SiteGoodsComment = $body['siteDetail']['gmkt']['SiteGoodsComment'];
        return ["code" => 201, "msg" => $SiteGoodsComment,'api_data' => $api_data];
    }

    // 옥션만 실패했을경우
    if(empty($iac_no)){
        $SiteGoodsComment = $body['siteDetail']['iac']['SiteGoodsComment'];
        return ["code" => 201, "msg" => $SiteGoodsComment,'api_data' => $api_data];
    }

    // 결과를 객체나 배열로 반환
    return [
        'api_data' => $api_data,
        'body' => $body,
        'result' => $result,
        'code' => 200,
        'header' => $headerArray,
    ];
}
?>