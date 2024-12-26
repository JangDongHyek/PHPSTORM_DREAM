<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\AdvertsModel;
use App\Models\PaymentModel;
use CodeIgniter\HTTP\ResponseInterface;

class APaymentController extends BaseController
{
    // 광고 결제 내역
    public function adPayment(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'],
            'edt' => $get['edt'],
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'type' => $get['type']
        ];

        $resultData = (new AdvertsModel())->getAdList($param);

        $data = array_merge($resultData,[
            'pid' => 'adm_ad_payment',
            'isAdmPage' => true,
            'param' => $param
        ]);

        return render('adm/payment/ad_payment', $data);
    }


    //관리자 결제 취소
    public function postPayRevoke():ResponseInterface
    {
        $post = $this->request->getPost();

        $payRow =  (new PaymentModel())->getPaymentByIdx($post);

        //주문 취소
        $return = cancelAutoBill($payRow['tid'], $payRow['amt']);

        $data = [
            'pay_status' => 'C'
        ];

        $condition = ['idx' => $payRow['idx']];

        $updateResult = (new PaymentModel())->updateData($data,$condition);

        if($updateResult){
            $dataAd = [
                'status' => 'C'
            ];
            $conditionAd = ['idx' => $payRow['order_id']];
            $updateAdResult = (new AdvertsModel())->updateData($dataAd,$conditionAd);
        }


        return $this->response->setJSON($updateAdResult);

    }
}