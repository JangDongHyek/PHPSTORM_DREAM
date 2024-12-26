<?php

namespace App\Controllers\_common;

use App\Models\SmsModel;
use App\Services\BaroSendMessagesService;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class BaroController extends Controller
{
    // 바로빌 문자 대량전송 or MMS
    public function postSendMessages() : ResponseInterface
    {
        $post = $this->request->getJSON(true);
        $resultData['result'] = false;

        $receiver = $post['receiver'] ?? [];
        $message = trim($post['message'] ?? '');
        $imageFile = $post['imageFile'] ?? '';

        // 문자 타입
        $msgByte = getStringByte($message);
        if (!empty($imageFile)) $sendType = 'M';
        else {
            $sendType = ($msgByte > 90) ? 'L' : 'S';
        }

        if (empty($receiver) || empty($message)) {
            $resultData['message'] = '수신정보를 올바르지 않습니다.';
            return $this->response->setJSON($resultData);
        }

        $smsData = [];
        $content = [
            'msg_type' => $sendType,
            'content' => $message,
            'img_name' => $imageFile,
            'res_code' => '',
            'mng_price' => SMS_UNIT[$sendType],
        ];

        $smsModel = (new SmsModel());

        // 매칭코드 (로그-요금정보)
        $feeCode = date('ymdhis_').getRandomString(4);
        $baroService = new BaroSendMessagesService();
        if ($sendType =='M'){
            $filePath = UPLOAD_FOLDERS['MMS']['path'] . $imageFile;

            if (!file_exists($filePath)) {
                $resultData['message'] = '사진 파일이 올바르지 않습니다. 삭제 후 다시 시도해 주세요.';
                return $this->response->setJSON($resultData);
            }

            $successCount = 0;

            // 건당 FTP 업로드 후 발송 처리 (대량전송 제공x)
            foreach ($receiver as $data) {
                $log = [
                    'to_num' => $data['number'],
                    'to_name' => $data['name'],
                    'sms_idx' => 0,
                    'success_yn' => 'N',
                    'fee_code' => $feeCode,
                ];

                $uploadResult = $baroService->uploadBiroFTP($filePath);

                // 사진 업로드 성공
                if ($uploadResult['result']) {
                    $sendResult = $baroService->sendMMSMessageFromFTP($log['to_name'], $log['to_num'], $message, $uploadResult['fileName']);
                    // $sendResult = ['result' => true, 'code' => 'TEST']; // test

                    if ($sendResult['result']) {
                        $log['success_yn'] = 'Y';
                        $successCount += 1;
                    }

                    sleep(1);
                }

                $content['res_code'] = $sendResult['code'] ?? '';
                $content['fee_code'] = $feeCode ?? '';

                $smsData[] = [
                    'content' => $content,
                    'log' => [$log],
                ];
            }
            $smsModel->insertLog($smsData);

            $resultData['result'] = $successCount > 0;
            $resultData['count'] = [
                'all' => count($receiver),
                'success' => $successCount,
                'failure' => (count($receiver) - $successCount),
            ];
        }else{
            $sendResult = $baroService->sendMessages($receiver, $message);

            $logs = [];

            foreach ($receiver as $data) {
                $logs[] = [
                    'to_num' => $data['number'],
                    'to_name' => $data['name'],
                    'sms_idx' => 0,
                    'success_yn' => $sendResult['result'] ? 'Y' : 'N',
                    'fee_code' => $feeCode,
                ];
            }

            $content['res_code'] = $sendResult['code'] ?? '';
            $content['fee_code'] = $feeCode ?? '';

            $smsData[] = [
                'content' => $content,
                'log' => $logs,
            ];

            $smsModel->insertLog($smsData);

            $resultData['result'] = $sendResult['result'];
            $resultData['count'] = [
                'all' => count($receiver),
                'success' => $sendResult['result'] ? count($receiver) : 0,
                'failure' => $sendResult['result'] ? 0 : count($receiver),
            ];
        }

        $resultData['sendType'] = $sendType;
        return $this->response->setJSON($resultData);
    }

}