<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;
use App\Models\AdvertsModel;
use App\Models\HpOrderModels;
use App\Models\MemberCardModel;
use App\Models\PaymentModel;
use App\Models\Transaction\AdvertsCardModel;
use CodeIgniter\HTTP\ResponseInterface;


class AdvertsController extends BaseController
{
    // 광고 문의
    public function adGuide(): string
    {
        $param = [
            'idx' => $this->member['idx'],
        ];

        $AdOrder = (new AdvertsModel())->getADOrderCount($param);
        $data = [
            'pid' => 'app_ad_guide',
            'AdOrder' => $AdOrder,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ];

        return render('app/adverts/ad_guide', $data);
    }

    // 광고 가입 신청
    public function adForm(): string
    {

        $cardInfo = (new MemberCardModel())->getCardByNum('',$this->member['mb_id']);

        $data = [
            'pid' => 'app_ad_form',
            'cardInfo' => $cardInfo,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ];

        return render('app/adverts/ad_form', $data);
    }

    //광고 신청 카드 결제
    public function postAdvertsUpload(): ResponseInterface
    {
        $post = $this->request->getPost();

        //  카드정보 조회
        if(empty($post['division'])){
            $cardInfo = (new MemberCardModel())->getCardByNum($post['cardNumber']);
        }else{
            $cardInfo = (new MemberCardModel())->getCardByNum('',$this->member['mb_id']);
        }

        if (empty($cardInfo)) {
            $apiResult = registerAutoBill($this->member, $post);

            if (!$apiResult['isSuccess']) {
                // 1.1 API 실패
                $defaultMessage = '[ER01] 카드등록에 실패했습니다.<br>잠시 후 다시 시도해 주세요.';
                $resultData['message'] = $apiResult['response']['resultMsg'] ?? $defaultMessage;
                return $this->response->setJSON($resultData);
            }


            $resCardData = $apiResult['cardData'];
            // 카드 정보보
            $insertData = [
                'mb_id' => $resCardData['userId'],
                'buyer_hp' => $resCardData['buyerHp'],
                'buyer_name' => $resCardData['buyerName'],
                'moid' => $apiResult['response']['moid'],
                'card_num' => $resCardData['cardNum'],
                'card_exp' => $resCardData['cardExpire'],
                'card_pwd' => $resCardData['cardPwd'],
                'bill_key' => $apiResult['response']['billKey'],
                'card_code' => $apiResult['response']['cardCode'],
                'result_code' => $apiResult['response']['resultCode'],
                'result_msg' => $apiResult['response']['resultMsg'],
                'mb_idx' => $resCardData['mbIdx'],
                'idNum' => $post['idNum'],
            ];
            // 카드정보 insert 후 성공 하면
            $billKeyIdx = (new MemberCardModel)->insertData($insertData);
            if (empty($billKeyIdx)) {
                $deleteData = [
                    'mid' => $insertData['mid'],
                    'userId' => $insertData['userId'],
                    'billKey' => $insertData['billKey']
                ];
                $resDel = callRegAutoIpayApi($deleteData, 'delAutoCardBill');
                $resultData['message'] = '[ER02] 카드등록에 실패했습니다.<br>잠시 후 다시 시도해 주세요.';
                return $this->response->setJSON($resultData);
            }

            $cardInfo = $insertData;

        }

        if (empty($post['division'])) {
            // 광고 결제
            $adverts = [
                'mb_idx' => $post['mb_idx'] ?? $this->member['idx'], //회원 인덱스
                'company_name' => $post['companyName'],// 업체명
                'company_tel' => $post['cpTel'], // 전화번호
                'area_si' => $post['areaSi'], // 지역(시)
                'area_gu' => $post['areaGu'], // 지역(구)
                'pre_yn' => $post['preYn'] ?? 'N', // 프리미엄 선택
                'main_yn' => $post['mainYn'] ?? 'N', // 메인선택
                'order_price' => $post['orderPrice'], // 주문금액
                'discount_rate' => $post['discountRate'], // 할인률
                'discount' => $post['discount'], // 할인금액
                'total_amt' => $post['totalAmt'], // 총 금액
                'pre_si' => $post['areaSi2'] ?? "", // 프리미엄 지역(시)
                'pre_area' => $post['preArea'] ?? "", // 프리미엄 지역(구)
                'main_price' => $post['mainPrice'], // 메인 가격
                'pre_price' => $post['prePrice'], // 프리미엄 가격
                'basic_price' => $post['basicPrice'], // 기본가격
                'parent_id' => $post['parentId'] ?? 0, // 부모 인덱스
                'admin_idx' => $this->member['idx'],
                'main_bottom' => $post['mainBottom'], // 메인 하단 선택
                'main_top' => $post['mainTop'], // 메인 상단 선택
                'main_top_price' => $post['mainTopPrice'], //메인 상단 가격
                'main_bottom_price' => $post['mainBottomPrice'], // 메인 하단 가격
                'card_quota' => $post['cardQuota'] // 할부 개월
            ];
            // 신청 db insert idx 값 필요
            $isInsert = (new AdvertsModel())->insertData($adverts, true);
        } else {
            // 전화 결제
            $adverts = [
                'mb_idx' => $this->member['idx'], //회원 인덱스
                'company_name' => $this->member['company_name'],// 업체명
                'company_tel' => $post['cpTel'], // 전화번호
                'area_si' => $post['areaSi'], // 지역(시)
                'area_gu' => '전화 연결', // 지역(구)
                'pre_yn' => $post['preYn'] ?? 'N', // 프리미엄 선택
                'main_yn' => $post['mainYn'] ?? 'N', // 메인선택
                'order_price' => $post['orderPrice'], // 주문금액
                'discount_rate' => $post['discountRate'], // 할인률
                'discount' => $post['discount'], // 할인금액
                'total_amt' => $post['totalAmt'], // 총 금액
                'pre_si' => $post['areaSi2'] ?? "", // 프리미엄 지역(시)
                'pre_area' => $post['preArea'] ?? "", // 프리미엄 지역(구)
                'main_price' => $post['mainPrice'], // 메인 가격
                'pre_price' => $post['prePrice'], // 프리미엄 가격
                'basic_price' => $post['basicPrice'], // 기본가격
                'parent_id' => $post['parentId'] ?? 0, // 부모 인덱스
                'admin_idx' => $this->member['idx'],
                'main_bottom' => $post['mainBottom'], // 메인 하단 선택
                'main_top' => $post['mainTop'], // 메인 상단 선택
                'main_top_price' => $post['mainTopPrice'], //메인 상단 가격
                'main_bottom_price' => $post['mainBottomPrice'] // 메인 하단 가격
            ];
            $isInsert = (new AdvertsModel())->insertData($adverts, true);
            // 신청 db insert idx 값 필요

            $advertsHp = [
                'mb_idx' => $this->member['idx'], //회원 인덱스
                'company_tel' => $post['cpTel'], // 전화번호
                'company_name' => $this->member['company_name'], // 회사이름
                'order_price' => $post['orderPrice'], // 주문금액`
                'est_idx' => $post['parentId']// 견적 idx
            ];
            $isInsert1 = (new HpOrderModels())->insertData($advertsHp, true);
        }

        // 신청 db insert idx 값 필요
        //$isInsert = (new AdvertsModel())->insertData($adverts, true);

        if (empty($isInsert)) {
            $resultData['message'] = '[ER02] 결재에 실패했습니다.<br>잠시 후 다시 시도해 주세요.';
            return $this->response->setJSON($resultData);
        }
        /*if(empty($post['division'])){
            $selectPlanData = [
                'goodsName' => '광고신청',
                'amt' => $adverts['order_price']
            ];
        }else{
            $selectPlanData = [
                'goodsName' => '전화 연결',
                'amt' => $adverts['order_price']
            ];
        }*/
        $selectPlanData = [
            'goodsName' => '광고신청',
            'amt' => $adverts['order_price']
        ];

        $cardInfo['cardQuota'] = $post['cardQuota'];
        $apiBillResult = paymentAutoBill($cardInfo, $selectPlanData);
        $payData = $apiBillResult['payData'];
        $payData['order_id'] = $isInsert;
        if (!$apiBillResult['isSuccess']) {
            // 2.1 API 통신실패: 리턴
            $resultData['message'] = '결제에 실패했습니다.';
            if (!empty($apiBillResult['response']['resultMsg'])) $resultData['message'] .= '<br>(사유: ' . $apiBillResult['response']['resultMsg'] . ')';
            return $this->response->setJSON($resultData);
        } else {
            $procResult = (new PaymentModel())->insertData($payData);

            if(empty($post['division'])){
                $data = [
                    'status' => 'Y'
                ];
                $condition = [
                    'idx' => $isInsert
                ];

                // 상태 변경 status
                $status = (new AdvertsModel())->updateData($data, $condition);
            }


            // 2.2 API 통신성공:
            // 2.2.1 결제실패: 결제취소 API 실행 후 리턴
            if (!$procResult) {
                cancelAutoBill($payData['tid'], $payData['amt']);
                $resultData['message'] = '결제에 실패했습니다.<br>(사유: 서버통신 오류)';
                return $this->response->setJSON($resultData);
            }
            // 2.2.2 결제성공: END
            $resultData['result'] = true;
        }

        return $this->response->setJSON($resultData);
    }
}