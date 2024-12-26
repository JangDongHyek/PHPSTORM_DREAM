<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\SmsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ASmsController extends BaseController
{

    // 문자서비스
    public function smsService(): string
    {
        $get = $this->request->getGet();
        $param = [
            'page' => $get['page'] ?? 1,
        ];

        $resultData = (new SmsModel())->getSmsContentList($param);

        $data = array_merge($resultData, [
            'pid' => 'adm_sms_service',
            'isAdmPage' => true,
        ]);

        return render('adm/sms_service', $data);
    }

    // 연락처관리
    public function phoneBook(): string
    {
        $get = $this->request->getGet();
        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'listRow' => '100',
        ];

        $resultData = (new SmsModel())->getContactList($param);

        $data = array_merge($resultData, [
            'pid' => 'adm_phone_book',
            'isAdmPage' => true,
        ]);

        return render('adm/phone_book', $data);
    }

    // 연락처 추가
    public function postContactInsert(): ResponseInterface
    {
        $post = $this->request->getPost();

        $contact = [
            'mb_name' => $post['cname'],
            'mb_tel' => $post['number']
        ];

        $resultData['result'] = (new SmsModel())->insertData($contact);

        return $this->response->setJSON($resultData);
    }

    // 수신자 내역
    public function postRecipientList(): ResponseInterface
    {
        $post = $this->request->getPost();

        $param = [
            'fee_code' => $post['feeCode'],
        ];
        $resultList = (new SmsModel())->getSmsLog($param);
        $resultData = [];
        if ($resultList) {
            $resultData['result'] = true;
            $resultData = $resultList;
        }

        return $this->response->setJSON($resultData);
    }
}