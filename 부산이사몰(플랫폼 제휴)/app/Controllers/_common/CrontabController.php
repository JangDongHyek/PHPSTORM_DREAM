<?php

namespace App\Controllers\_common;

use App\Controllers\BaseController;
use App\Models\CallRecordModel;
use App\Models\CompanyModel;

class CrontabController extends BaseController
{
    // 통화목록 크론탭 실행 (5분마다 조회)
    public function callStatCrontab(){
        helper('biz050');

        $startDate = date('YmdHi', strtotime('-1 week'));
        $endDate = date('YmdHi');
        $response = cdrInquiry($startDate, $endDate);

        if($response['code'] === '0000' && isset($response['data']['list'])){
            $callRecordModel = new CallRecordModel();
            $list = $response['data']['list'];

            foreach ($list as $record){
                $data = [
                    'call_id' => $record['callId'],
                    'calling_num' => $record['callingNum'],
                    'vno' => $record['vno'],
                    'called_num' => $record['calledNum'],
                    'cs_time' => $record['csTime'],
                    'da_time' => $record['daTime'],
                    'cn_time' => $record['cnTime'],
                    'ce_time' => $record['ceTime'],
                    'call_duration' => $record['callDuration'],
                    'bill_duration' => $record['billDuration'],
                    'call_cause' => $record['callCause'],
                    'custom_id' => $record['customId'],
                    'channel_id' => $record['channelId']
                ];

                $getCallId = $callRecordModel->getCallIdById($data);

                if($getCallId){
                    $callRecordModel->insertData($data);
                }
            }

            write_server_log(['msg' => '성공'], 'crontab');

        }else{
            // CLI::write("저장할 데이터가 없거나 응답에 오류가 발생했습니다.", 'red');
            write_server_log(['msg' => '실패'], 'crontab');
        }

        // if (IS_PRIVATE) $this->updateTest();
    }

    // private function updateTest()
    // {
    //     $model = (new CompanyModel());
    //     $listData = $model->getCompanyList(['page' => 1, 'isPaging' => false]);
    //     // print_r($listData);
    //
    //     foreach ($listData['listData'] as $list) {
    //         $desc = $list['service_desc'];
    //         $idx = $list['idx'];
    //         $newDesc = str_replace('http://14.48.175.236/~knn24form/', '/', $desc);
    //         $data = [
    //             'service_desc' =>$newDesc,
    //         ];
    //         $condition = ['idx' => $idx];
    //
    //         $result = $model->updateData($data, $condition);
    //         echo "<pre>";
    //         var_dump($result);
    //         echo "</pre>";
    //     }
    // }
}