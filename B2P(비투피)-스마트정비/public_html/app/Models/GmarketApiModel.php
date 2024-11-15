<?php

namespace App\Models;

use App\Services\JWTService;
use CodeIgniter\Model;
use Config\Services;

class GmarketApiModel extends Model {
    // 지마켓 헤더 생성
    private function creatHeader($api_type){
        $headers = [];
        if($api_type == GMAC || $api_type == GM || $api_type == AC){
            $headers['Authorization'] = 'Bearer ' .  JWTService::initGmAcJWT($api_type);
        }
        return $headers;
    }

    // 완전 기본호출 api
    public function basicCallApi($data){
        $curl = curl_init();

        // HTTP 헤더 설정
        $headers = $this->creatHeader($data['api_type']);
        $headerArray = [];
        foreach ($headers as $key => $value) {
            $headerArray[] = $key . ': ' . $value;
        }

        $options = [
            CURLOPT_URL => $data['api_url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => $data['api_method'],
            CURLOPT_HTTPHEADER => $headerArray
        ];

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        // 결과를 객체나 배열로 반환
        return [
            'body' => $response,
            'status' => $statusCode
        ];
    }

    public function temp(){
        $api_data = [
            "itemBasicInfo" => [
                "goodsName" => [
                    "eng" => null,
                    "chi" => null,
                    "jpn" => null,
                    "kor" => $goodsName_kor,
                    "promotion" => $data['goodsName_promotion']
                ],
                "category" => [
                    "site" => [
                        [
                            "siteType" => 1,            // [G마켓/옥션 카테고리 사이트구분, 필수, int],
                            "catCode" => $ac_cate       // [G마켓/옥션 카테고리코드, 필수, string]
                        ],
                        [
                            "siteType" => 2,            // [G마켓/옥션 카테고리 사이트구분, 필수, int],
                            "catCode" => $gm_cate       // [G마켓/옥션 카테고리코드, 필수, string]
                        ]
                    ]
                ],
                "book" => null,
                "catalog" => [
                    "modelName" => "모델명",
                    "brandNo" => 1090,
                    "barCode" => "11111111",
                    "epinCode" => null
                ]
            ],
            "itemAddtionalInfo" => [

                "buyableQuantity" => null,
                "price" => [
                    "Gmkt" => $price,
                    "Iac" => $price
                ],
                "stock" => [
                    "Gmkt" => $data['stock'],
                    "Iac" => $data['stock']
                ],
                "recommendedOpts" => [
                    "type" => 0,
                    "isStockManage" => false,
                    "independent" => null,
                    "combination" => null
                ],
                "sellingPeriod" => [
                    "Gmkt" => (int)$sellingPeriod,
                    "Iac" => (int)$sellingPeriod
                ],
                "managedCode" => $managedCode,
                "inventoryCode" => null,
                "sellerShop" => null,
                "expiryDate" => null,
                "manufacturedDate" => null,
                "origin" => null,
                "capacity" => null,
                "shipping" => [
                    "type" => 2,
                    "policy" => [
                        "placeNo" => 22460494,
                        "feeType" => 1,
                        "bundle" => [
                            "deliveryTmplId" => "90844359"
                        ],
                        "each" => null
                    ],
                    "returnAndExchange" => [
                        "addrNo" => $data['returnAndExchangeAddrNo'],
                        "fee" => 0
                    ],
                    "dispatchPolicyNo" => [
                        "gmkt" => 1644730,
                        "iac" => 1643527
                    ],
                    "generalPost" => null,
                    "visitAndTake" => null,
                    "quickService" => null
                ],
                "officialNotice" => [
                    "officialNoticeNo" => 1,
                    "details" => [
                        [
                            "officialNoticeItemelementCode" => "1-1",
                            "value" => "123",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-10",
                            "value" => "123",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-2",
                            "value" => "123",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-3",
                            "value" => "213",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-4",
                            "value" => "213",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-5",
                            "value" => "213",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-6",
                            "value" => "2131111",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-7",
                            "value" => "213",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-8",
                            "value" => "123",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "1-9",
                            "value" => "23",
                            "isExtraMark" => false
                        ],
                        [
                            "officialNoticeItemelementCode" => "999-5",
                            "value" => "",
                            "isExtraMarkcheckOrder" => false
                        ]
                    ]
                ],
                "isAdultProduct" => $isAdultProduct,
                "isVatFree" => $isVatFree,
                "certInfo" => [
                    "gmkt" => [
                        "certId" => [],
                        "licenseSeq" => null
                    ],
                    "iac" => null,
                    "safetyCerts" => [
                        "child" => [
                            "details" => null,
                            "type" => 2
                        ],
                        "electric" => [
                            "mandatorySafetySign" => 0,
                            "details" => null,
                            "type" => 2
                        ],
                        "life" => [
                            "mandatorySafetySign" => 0,
                            "details" => null,
                            "type" => 2
                        ],
                        "harmful" => [
                            "certId" => null,
                            "type" => 2
                        ]
                    ]
                ],
                "images" => $data['images'],
                "weight" => 0,
                "descriptions" => [
                    "kor" => [
                        "type" => 2,
                        "contentId" => "",
                        "html" => '<div class="ee-contents"><p class="">상세설명</p><p><br></p><p><br></p></div>'
                    ]
                ]
            ],
            "addtionalInfo" => [
                "sellerDiscount" => $addtionalInfo_sellerDiscount,
                "siteDiscount" => [
                    "gmkt" => true,
                    "iac" => true
                ],
                "pcs" => [
                    "isUse" => true,
                    "isUseIacPcsCoupon" => true,
                    "isUseGmkPcsCoupon" => true
                ],
                "overseaSales" => [
                    "isAgree" => false
                ]
            ]
        ];
    }

    // 상품등록
    public function getOrder($data){
        $curl = curl_init();

        // HTTP 헤더 설정
        $headers = $this->creatHeader($data['api_type']);
        $headerArray = ['Content-Type: application/json'];
        foreach ($headers as $key => $value) {
            $headerArray[] = $key . ': ' . $value;
        }

        // 데이터 검증

        // 데이터 설정
        $api_data = $data['api_data'];

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

        // 결과를 객체나 배열로 반환
        return [
            'api_data' => $api_data,
            'body' => json_decode($response, true),
            'status' => $statusCode,
            'header' => $headerArray,
        ];
    }

    // 정산관련 API 데이터 비교
    public function checkOrder($data){
        $curl = curl_init();

        // HTTP 헤더 설정
        $headers = $this->creatHeader($data['api_type']);
        $headerArray = ['Content-Type: application/json'];
        foreach ($headers as $key => $value) {
            $headerArray[] = $key . ': ' . $value;
        }

        // 데이터 검증

        // 데이터 설정
        $api_data = $data['api_data'];

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

        // 결과를 객체나 배열로 반환
        return [
            'api_data' => $api_data,
            'body' => json_decode($response, true),
            'status' => $statusCode,
        ];
    }

    
}
