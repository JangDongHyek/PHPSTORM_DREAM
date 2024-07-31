<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\CLI\CLI;
use App\Models\GmAc\GoodsModel;

class QueueProcessor extends Controller
{
    protected $goodsModel;

    public function __construct()
    {
        if (is_cli()) {
            $this->request = \Config\Services::clirequest();
        }
        $this->goodsModel = new GoodsModel();
    }

    public function processQueue()
    {
        // PHP 실행 시간 제한 해제
        set_time_limit(0);

        // 메모리 제한 설정 (필요에 따라 조정)
        ini_set('memory_limit', '256M');

        while (true) {
            $job = $this->getNextJob();
            if ($job) {
                $this->processJob($job);
            }

            // DB 데이터를 API로 전송
            $job2 = $this->goodsModel->cronDBToApi();

            // 메모리 사용량 체크 및 관리
            if (memory_get_usage(true) > 200 * 1024 * 1024) { // 200MB 이상 사용 시
                gc_collect_cycles(); // 가비지 컬렉션 강제 실행
                // 여전히 높다면 프로세스 재시작을 고려
                if (memory_get_usage(true) > 200 * 1024 * 1024) {
                    exit(0); // systemd가 자동으로 재시작
                }
            }

            if($job && $job2){
                sleep(1);
            } else if($job){
                sleep(2);
            } else if($job2){
                sleep(2);
            } else {
                sleep(5);
            }
        }

    }

    private function getNextJob()
    {
        $sql = "SELECT * FROM `excel_queue` WHERE `status` = 'pending' ORDER BY `created_at` ASC LIMIT 1";
        $job = sql_fetch($sql);

        if ($job) {
            $update_sql = "UPDATE `excel_queue` SET `status` = 'processing' WHERE `id` = '{$job['id']}'";
            sql_query($update_sql);
        }

        return $job;
    }

    private function processJob($job)
    {
        try {
            // 엑셀 파일을 DB에 저장
            $this->goodsModel->cronExcelToDB();


            // 작업 상태 업데이트
            $this->updateJobStatus($job['id'], 'completed');
        } catch (\Exception $e) {
            // 오류 발생 시 작업 상태 업데이트
            $this->updateJobStatus($job['id'], 'failed');
            log_message('error', 'Job processing failed: ' . $e->getMessage());
        }
    }

    private function updateJobStatus($jobId, $status)
    {
        $status = sql_real_escape_string($status);
        $sql = "UPDATE `excel_queue` SET `status` = '$status' WHERE `id` = '$jobId'";
        sql_query($sql);
    }
}