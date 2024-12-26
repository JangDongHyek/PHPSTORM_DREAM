<?php

namespace App\Services;


use App\Models\EstimateModel;
use CodeIgniter\Controller;

class BaroSendMessagesService extends Controller
{
    private $certKey;
    private $corpNum;
    private $id;

    public function __construct()
    {
        $this->certKey = BAROBILL_KEY;
        $this->corpNum = BAROBILL_CORP_NUM;
        $this->id = BAROBILL_ID;
    }

    // 공통 인스턴스 생성
    private function getBaroServiceClient($clientType = 'BANK'): \SoapClient
    {
        $server = BAROBILL_SERVER;
        switch ($clientType) {
            case 'BANK' :
                $server .= 'BANKACCOUNT.asmx?WSDL';
                break;
            case 'KAKAO' :
                $server .= 'KAKAOTALK.asmx?WSDL';
                break;
            case 'SMS' :
                $server .= 'SMS.asmx?WSDL';
                // $server = 'https://testws.baroservice.com/SMS.asmx?WSDL'; // TODO: 테스트계정 (완료후 운영변경)
                break;
        }

        return new \SoapClient($server, [
            'trace' => true,
            'encoding' => 'UTF-8',
        ]);
    }

    // 문자: 대량전송
    // API 레퍼런스 : https://dev.barobill.co.kr/docs/references/문자전송-API#SendMessages
    public function sendMessages($receiver = [], $message = ''): array
    {
        $baroService = $this->getBaroServiceClient('SMS');
        $xmsMessage = [];

        foreach ($receiver as $data) {
            $xmsMessage[] = [
                'SenderNum' => BAROBILL_SMS,
                'ReceiverName' => $data['name'] ?? '',
                'ReceiverNum' => $data['number'],
                'Message' => $message,
                // 'RefKey' => '', // 사용하지않는 항목
            ];
        }

        $response = $baroService->SendMessages([
            'CERTKEY' => $this->certKey,
            'CorpNum' => $this->corpNum,
            'SenderID' => $this->id,
            'SendCount' => count($xmsMessage),
            'CutToSMS' => false, // 메시지 길이에 따라 자동 단문/장문
            'Messages' => ['XMSMessage' => $xmsMessage],
            'SendDT' => '', // 즉시전송
        ])->SendMessagesResult;

        if ($response < 0) { // 실패코드 리턴
            log_message('error', '바로빌:: 문자대량전송 실패 :' . $response);
            return ['result' => false, 'code' => $response];

        } else {
            return ['result' => true, 'code' => $response];
        }
    }

    // 알림톡 : 여러건의 동일한 알림톡을 전송 최대 100건까지 가능
    // API 레퍼런스 : https://dev.barobill.co.kr/docs/references/%EC%B9%B4%EC%B9%B4%EC%98%A4%ED%86%A1%EC%A0%84%EC%86%A1-API#SendATKakaotalksEx
    public function sendKakaoTalkMessages($receiver = [], $type = '', $templateName = '', $yellowId = '', $smsReply = '', $smsSenderNum = '', $idx = ''): array
    {
        $baroService = $this->getBaroServiceClient('KAKAO');
        $kakaoTalkMessages = [];

        foreach ($receiver as $data) {
            $templateData = $this->templateName($type, $idx);
            $kakaoTalkMessages[] = [
                'ReceiverNum' => $data['number'],
                'ReceiverName' => '',
                'Title' => '견적 신청 접수 안내',
                'Message' => $templateData['template'],
                'SmsSubject' => '',
                'SmsMessage' => '',
                'Buttons' => [
                    'KakaotalkButton' => [
                        [
                            'Name' => 'View More', // Button text
                            'ButtonType' => 'WL', // Button type: 'WL' for web link
                            'Url1' => 'https://example.com', // URL for the button
                            'Url2' => '', // Optional second URL
                        ]
                    ]
                ]
            ];
        }

        $response = $baroService->SendATKakaotalksEx([
            'CERTKEY' => $this->certKey,
            'CorpNum' => $this->corpNum,
            'SenderID' => $this->id,
            'YellowId' => $yellowId,
            'TemplateName' => $templateName,
            'SendDT' => '', // 즉시전송
            'SmsReply' => $smsReply,
            'SmsSenderNum' => $smsSenderNum,
            'KakaotalkMessages' => $kakaoTalkMessages,
        ])->SendATKakaotalksExResult;

        if ($response < 0) { // 실패코드 리턴
            log_message('error', '바로빌:: 카카오톡전송 실패 :' . $response);
            return ['result' => false, 'code' => $response];

        } else {
            return ['result' => true, 'code' => $response];
        }
    }

    // 카카오템플릿
    private function templateName($type, $idx): array
    {
        $data = ['template' => '', 'code' => ''];
        // 이사견적 상세
        $resultData = (new EstimateModel())->getAEstimateByIdx($idx);
        switch ($type) {
            case 'NEW_ORDER':
                $template = "이사 희망 고객님의\n";
                $template .= "견적신청이 접수되었습니다.\n\n";
                $template .= "[이사견적열람]에서 확인하세요!\n\n";
                $template .= "▶서비스: " . (SERVICE_TYPE[$resultData['service_type'] ?? '']); // Replace with actual service
                $template .= "\n▶이사날짜: " . ($resultData['sched_date'] ?? ''); // Replace with actual date
                $template .= "\n▶출발지: " . ($resultData['origin'] ?? ''); // Replace with actual departure
                $template .= "\n▶도착지: " . ($resultData['bourne'] ?? ''); // Replace with actual destination
                $template .= "\n\n*해당 메시지는 고객님께서 요청하신 간편견적신청이 접수될 경우 발송됩니다.";
                $data['code'] = 'B61712862790000001'; // 템플릿 코드
                break;

            default:
                log_message('error', '잘못된 템플릿 타입: ' . $type);
                return ['template' => '', 'code' => '']; // 잘못된 템플릿 타입 처리
        }

        $data['template'] = $template;
        return $data;
    }

    // 공통: FTP 업로드
    // API 레퍼런스: https://dev.barobill.co.kr/docs/guides/%EB%B0%94%EB%A1%9C%EB%B9%8C-API-%EA%B0%9C%EB%B0%9C%EC%A4%80%EB%B9%84#FTP
    public function uploadBiroFTP($filePath): array
    {
        $ftpServer = 'ftp.barobill.co.kr'; // 운영
        $ftpPort = 9030;
        $ftpUserName = BAROBILL_ID;
        $ftpUserPass = BAROBILL_PW;

        $response = ['result' => false, 'message' => ''];

        $localFile = $filePath; // 서버에 저장된 파일 경로
        $remoteFile = getRandomString('6') . '.jpg';

        // FTP 연결 생성
        $connId = ftp_connect($ftpServer, $ftpPort, 5);

        if ($connId) {
            if (ftp_login($connId, $ftpUserName, $ftpUserPass)) {
                ftp_pasv($connId, true); // Passive 모드 활성화

                if (ftp_put($connId, '/' . $remoteFile, $localFile, FTP_BINARY)) {
                    $response['result'] = true; // 업로드 성공
                    $response['fileName'] = $remoteFile;
                } else {
                    $response['message'] = '바로빌 FTP 사진업로드 실패';
                }
            } else {
                $response['message'] = '바로빌 FTP 로그인 실패';
            }

            ftp_close($connId); // FTP 연결 종료

        } else {
            $response['message'] = '바로빌 FTP 연결실패';
        }

        // log_message('notice', 'FTP: '. json_encode($response, JSON_UNESCAPED_UNICODE));

        return $response;
    }

    // 문자: 전송내역 URL
    public function getSMSHistoryURL()
    {
        /*$baroService = getBaroServiceClient('SMS');
        $certKey = BAROBILL_KEY;
        $corpNum = BAROBILL_CORP_NUM;
        $id = BAROBILL_ID;

        $response = $baroService->GetSMSHistoryURL([
            'CERTKEY' => $certKey,
            'CorpNum' => $corpNum,
            'ID' => $id,
        ])->GetSMSHistoryURLResult;

        if ($response < 0) { // 실패코드 리턴
            log_message('error', '바로빌:: 문자전송내역 URL 호출 실패 :' . $response);
            return '';

        } else {
            return $response;
        }*/
    }

    // 문자: 포토(MMS) 전송 - 단건만 가능
    // API 레퍼런스 : https://dev.barobill.co.kr/docs/references/문자전송-API#SendMMSMessageFromFTP
    public function sendMMSMessageFromFTP($name, $num, $message, $fileName): array
    {
        $baroService = $this->getBaroServiceClient('SMS');
        $certKey = BAROBILL_KEY;
        $corpNum = BAROBILL_CORP_NUM;
        $id = BAROBILL_ID;

        $response = $baroService->SendMMSMessageFromFTP([
            'CERTKEY' => $certKey,
            'CorpNum' => $corpNum,
            'SenderID' => $id,
            'FromNumber' => BAROBILL_SMS,
            'ToName' => $name,
            'ToNumber' => $num,
            'TXTSubject' => '부산이사몰', // 제목,
            'TXTMESSAGE' => $message,
            'ImageFileName' => $fileName,
            'SendDT' => '',
        ])->SendMMSMessageFromFTPResult;

        // log_message('notice', 'MMS 리턴코드: ' . $response);

        if ($response < 0) { // 실패코드 리턴
            log_message('error', '바로빌:: MMS 실패 :' . $response);
            return ['result' => false, 'code' => $response];

        } else {
            return ['result' => true, 'code' => $response];
        }
    }

}