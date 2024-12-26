<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;
use CodeIgniter\Model;

class BoardFileModel extends Model
{
    use BuilderTrait;

    // 파일 등록
    public function insertFile($tableName = '', $boardIdx = 0, $data = []): int
    {
        // 트랜잭션 시작
        $this->db->transBegin();

        try {
            $builder = $this->getBuilder("bm_board_file");

            // 초기화
            $res = $this->deleteFile($tableName, $boardIdx);
            if (!$res) throw new \Exception('파일삭제 오류');

            foreach ($data as $row) {
                $row['board_idx'] = $boardIdx;

                $builder->insert($row);
            }

            // 트랜잭션 상태 확인
            if ($this->db->transStatus() === FALSE) {
                throw new \Exception('트랜잭션 상태가 올바르지 않습니다.');
            }

            // 커밋
            $this->db->transCommit();
            return true;

        } catch (\Exception $e) {
            $this->db->transRollback(); // 실패시 롤백
            log_message('error', "게시판파일 등록실패: " . $e->getMessage());
            return 0;
        }
    }

    // 파일 삭제 (DB만)
    public function deleteFile($tblName = '', $boardIdx = 0, $fileNames = []): bool
    {
        try {
            $builder = $this->getBuilder("bm_board_file");
            $builder->where('tbl_name', $tblName)
                ->where('board_idx', $boardIdx);

            if (!empty($fileNames)) $builder->whereIn('file_name', $fileNames);

            $builder->delete();

            return true;

        } catch (\Exception $e) {
            log_message('error', "게시판파일 삭제실패: " . $e->getMessage());
            return false;
        }
    }

    // 파일 목록
    public function getFileList($tblName = '', $boardIdx = 0): array
    {
        $builder = $this->getBuilder("bm_board_file");
        $builder->where('tbl_name', $tblName)
            ->where('board_idx', $boardIdx)
            ->orderBy('sort', 'ASC');

        $query = $builder->get();

        $listData = [];

        $key = 'BOARD';
        $filePath = UPLOAD_FOLDERS['BOARD'] ?? '';

        $i = 1;
        foreach ($query->getResultArray() as $file) {
            // 첨부파일
            if (!empty($file['file_name']) && file_exists($filePath['url'] . $file['file_name'])) {
                $listData[$i] = [
                    'name' => $file['file_name'],
                    'orgName' => $file['org_name'],
                    'download' => '/file/download?key=' . $key . '&file=' . $file['file_name'] . '&changeName=' . $file['org_name'],
                ];
                $i++;
            }
        }

        return $listData;

    }
}