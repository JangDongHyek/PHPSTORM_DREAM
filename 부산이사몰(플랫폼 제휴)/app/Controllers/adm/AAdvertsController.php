<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\AdvertsModel;
use App\Models\MemberCardModel;
use App\Models\MemberModel;
use CodeIgniter\HTTP\ResponseInterface;

class AAdvertsController extends BaseController
{
    // 광고 신청 관리
    public function ad(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'sdt' => $get['sdt'],
            'edt' => $get['edt']
        ];

        $resultData = (new AdvertsModel())->getAdCompanyList($param);
        $data = array_merge($resultData, [
            'pid' => 'adm_ad',
            'isAdmPage' => true,
            'param' => $param
        ]);

        return render('adm/adverts/ad', $data);
    }

    // 광고 변경 및 결제
    public function adForm(): string
    {
        $get = $this->request->getGet();

        $param = [
            'idx' => $get['idx']
        ];

        $resultData = (new AdvertsModel())->getADOrderInfo01($param);

        $data = array_merge($resultData, [
            'pid' => 'adm_ad_form',
            'isAdmPage' => true,
            'param' => $param
        ]);

        return render('adm/adverts/ad_form', $data);
    }

    //관리자 광고 신청 관리 결제일 변경
    public function postNextPayAtChange(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        foreach ($post['idx'] as $key => $value) {
            $data = [
                'next_pay_at' => $post['nextPayAt'][$key],
                /*'status'=>$post['status'][$key]*/
            ];
            $condition = ['idx' => $value];

            $updateResult = (new AdvertsModel())->updateData($data, $condition);

            if (!$updateResult) {
                $resultData['success'] = false; // 업데이트 실패 시 false로 설정
                break; // 실패 시 반복문 탈출 (선택 사항, 상황에 따라 달라질 수 있음)
            }
        }

        return $this->response->setJSON($resultData);
    }

    //결제 정보 수정
    public function postChangeCardNum(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        $member = (new MemberModel())->getMemberInfoIdx($post['mbId']);

        $card = (new MemberCardModel())->getCardByNum('', $post['mbIdm']);


        $apiResult = registerAutoBill($member, $post);

        if (!$apiResult['isSuccess']) {
            // 1.1 API 실패
            $defaultMessage = '[ER01] 카드등록에 실패했습니다.<br>잠시 후 다시 시도해 주세요.';
            $resultData['message'] = $apiResult['response']['resultMsg'] ?? $defaultMessage;
            return $this->response->setJSON($resultData);
        }

        $resCardData = $apiResult['cardData'];
        // 카드 정보보
        $insertData = [
            'mb_id' => $member['mb_id'],
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
            'idNum' => $post['idNum']
        ];
        $condition = [
            'idx' => $post['idx']
        ];
        if(empty($card)){
            $billKeyIdx = (new MemberCardModel())->insertData($insertData, true);
        }else{
            $billKeyIdx = (new MemberCardModel())->updateData($insertData, $condition);
        }

        if (!$billKeyIdx) {
            $resultData['success'] = false; // 업데이트 실패 시 false로 설정
        }
        return $this->response->setJSON($resultData);
    }
}