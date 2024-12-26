<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class SmsModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_contact';

    public function getContactList($param = []): array
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where('del_yn', 'N')
            ->orderBy('created_at', 'DESC');

        if (!empty($param['stx'])) {
            if ($param['sfl']) {
                switch ($param['sfl']) {
                    case 'name':
                        $builder->like('mb_name', $param['stx']);
                        break;
                    case 'mb_hp':
                        $builder->like('mb_tel', $param['stx']);
                        break;
                }
            }
        }

        // 페이징
        if ($param['isPaging'] ?? true) {
            $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
            $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
            if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
            else $builder->limit($paging['listRows'], $paging['formRecord']);
        }

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray(),
            'paging' => $paging,
        ];
    }

    public function updateExcel($excelRows): bool
    {
        try {
            $this->db = \Config\Database::connect();
            for ($i = 1; $i < count($excelRows); $i++) {
                $row = $excelRows[$i];

                $name = $row[0]; // '이름'
                $tel = $row[1];   // '연락처'

                // 데이터가 비어있지 않은지 확인
                if (empty($name) || empty($tel)) {
                    log_message('error', '이름 또는 연락처가 비어 있습니다. 이름: ' . $name . ', 연락처: ' . $tel);
                    continue; // 비어있는 경우 다음 반복으로 넘어갑니다.
                }


                $sql = "INSERT INTO bm_contact (mb_name, mb_tel) VALUES (?, ?)";
                $this->db->query($sql, [$name, $tel]);
            }
            return true;
        } catch (\Exception $e) {
            log_message('error', '엑셀업로드실패: ' . $e->getMessage());
            return false;
        }
    }

    public function insertLog($smsData = []): bool
    {
        // 트랜잭션 시작
        $this->db->transBegin();

        try {
            $contBuilder = $this->getBuilder('bm_sms_content'); // 내용
            $logBuilder = $this->getBuilder('bm_sms_log'); // 발송내역

            foreach ($smsData as $data) {
                // 1. 내용 등록
                $contBuilder->insert($data['content']);
                $smsIdx = $this->db->insertID();

                // 2. 발송내역 등록 (성공여부)
                foreach ($data['log'] as $log) {
                    $log['sms_idx'] = $smsIdx;

                    $logBuilder->insert($log);
                    $logBuilder->resetQuery();
                }

                $contBuilder->resetQuery();
            }

            // 트랜잭션 상태 확인
            if ($this->db->transStatus() === FALSE) {
                throw new \Exception('트랜잭션 상태 오류');
            }

            // 커밋
            $this->db->transCommit();
            return true;

        } catch (\Exception $e) {
            $this->db->transRollback(); // 롤백
            log_message('error', '문자 등록실패' . $e->getMessage());
            return false;
        }
    }

    public function getSmsContentList($param = []): array
    {
        $builder = $this->getBuilder('bm_sms_content', 'a');
        $builder->select('a.idx, a.del_yn, a.created_at, a.updated_at, a.msg_type, a.content, a.img_name, a.res_code, a.mng_price, a.fee_code, 
    GROUP_CONCAT(DISTINCT b.to_num SEPARATOR ", ") AS to_num, 
    GROUP_CONCAT(DISTINCT b.to_name SEPARATOR ", ") AS to_name, 
    b.sms_idx, b.success_yn')
            ->join('bm_sms_log b', 'a.fee_code = b.fee_code', 'left')
            ->where('a.del_yn', 'N')
            ->where('b.del_yn', 'N')
            ->groupBy('a.fee_code')
            ->orderBy('a.created_at', 'desc');

        // 페이징
        if ($param['isPaging'] ?? true) {
            $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
            $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
            if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
            else $builder->limit($paging['listRows'], $paging['formRecord']);
        }

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray(),
            'paging' => $paging,
        ];
    }

    public function getSmsLog($param = []): array
    {
        $builder = $this->getBuilder('bm_sms_log',);
        $builder->select('*')
            ->where('del_yn', 'N');

        if (!empty($param['fee_code'])) $builder->where('fee_code', $param['fee_code']);

        if ($param['isPaging'] ?? true) {
            $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
            $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
            if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
            else $builder->limit($paging['listRows'], $paging['formRecord']);
        }
        $query = $builder->get();

        return [
            'listData' => $query->getResultArray(),
            'paging' => $paging,
        ];
    }
}