<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;
use CodeIgniter\Model;

class BoardModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_board';

    // 게시판 등록
    public function insertBoard($data = []): int
    {
        try {
            $builder = $this->getBuilder('bm_board');
            $builder->insert($data);

            return $this->db->insertID();

        } catch (\Exception $e) {
            log_message('error', "게시판 등록실패: " . $e->getMessage());
            return 0;
        }
    }

    //답글 등록
    public function insertComment($data = []): int
    {
        try {
            $builder = $this->getBuilder('bm_board_comment');
            $builder->insert($data);

            return $this->db->insertID();
        } catch (\Exception $e) {
            log_message('error', "답글 등록실패: " . $e->getMessage());
            return 0;
        }
    }

    //답글 삭제
    public function delComment($data = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_board_comment');
            $builder->set('del_yn', 'Y')
                ->set('updated_at', 'now()', false)
                ->where('idx', $data['idx'])
                ->update();
            return true;
        } catch (\Exception $e) {
            log_message('error', "답글 삭제 실패: " . $e->getMessage());
            return false;
        }
    }

    //답글 수정
    public function editComment($data = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_board_comment');
            $builder->set($data)
                ->set('updated_at', 'now()', false)
                ->where('idx', $data['idx'])
                ->update();
            return true;
        } catch (\Exception $e) {
            log_message('error', "답글 수정 실패: " . $e->getMessage());
            return false;
        }
    }

    //답글 목록
    public function getCommentList($idx = 0): array
    {
        $builder = $this->getBuilder('bm_board_comment');
        $builder->select('*')
            ->where('board_idx', $idx)
            ->where('del_yn', 'N');
        return $builder->get()->getResultArray();
    }


    // 게시판 수정
    public function updateBoard($data = []): bool
    {
        try {
            // 수정 제외 키
            $removeKeys = ['tbl_name', 'mb_idx', 'mb_nick'];
            foreach ($removeKeys as $key) {
                if (array_key_exists($key, $data)) {
                    unset($data[$key]);
                }
            }

            $builder = $this->getBuilder('bm_board');
            $builder->set($data)
                ->set('updated_at', DATE_TIME)
                ->where('idx', $data['idx'])
                ->update();

            return true;

        } catch (\Exception $e) {
            log_message('error', "게시판 수정실패: " . $e->getMessage());
            return false;
        }
    }

    // 게시판 상세
    public function getBoardInfo($tableName = '', $idx = 0): array
    {
        $builder = $this->getBuilder('bm_board', 'bd');
        $builder->select('bd.*')
            ->select('mb.mb_id')
            ->join('bm_member mb', 'mb.idx = bd.mb_idx', 'left')
            ->where('bd.del_yn', 'N')
            ->where('bd.idx', $idx)
            ->where('bd.tbl_name', $tableName);

        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

    // 조회수 업데이트
    public function updateReadCnt($idx = 0): void
    {
        try {
            $builder = $this->getBuilder('bm_board');
            $builder->set('read_cnt', 'read_cnt+1', false)
                ->where('idx', $idx)
                ->update();

        } catch (\Exception $e) {
            log_message('error', '조회수실패: ' . $e->getMessage());
        }
    }

    // 게시판 목록
    public function getBoardList($param = [], $tableName = '', $isFixFirst = true): array
    {
        if (empty($tableName)) return [];

        $builder = $this->getBuilder('bm_board bd');
        $builder->select('bd.*')
            ->select('(SELECT COUNT(idx) FROM bm_board_comment WHERE board_idx = bd.idx and del_yn = "N") as comment_cnt')
            ->where('bd.del_yn', 'N')
            ->where('bd.tbl_name', $tableName);
        // ->orderBy('CASE WHEN bd.fix_yn = "Y" THEN 0 ELSE 1 END', 'ASC', false)
        // ->orderBy('bd.idx', 'DESC');

        // 정렬
        if ($isFixFirst) $builder->orderBy('CASE WHEN bd.fix_yn = "Y" THEN 0 ELSE 1 END', 'ASC', false);
        $builder->orderBy('bd.idx', 'DESC');

        // qna (업체명, 아이디)
        /*if ($tableName == 'qna') {
            $builder->join('bm_member mb', 'mb.idx = bd.mb_idx', 'left')
                ->join('bm_company cp', 'mb.cp_idx = cp.idx', 'left')
                ->select('mb.mb_id, cp.cp_name, cp.cp_type');
        }*/

        // 검색
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case 'title' :
                    $builder->like('bd.title', $param['stx']);
                    break;
                case 'mbNick' :
                    $builder->like('bd.mb_nick', $param['stx']);
                    break;
                case 'content' :
                    $builder->like('bd.content', $param['stx']);
                    break;
            }
        }

        if(!empty($param['status']))$builder->where('status',$param['status']);

        // 페이징
        $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
        else $builder->limit($paging['listRows'], $paging['formRecord']);

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray() ?? [],
            'paging' => $paging,
        ];
    }

    //faq 목록
    public function getFaqList($param = [], $tableName = ''): array
    {
        if (empty($tableName)) return [];

        $builder = $this->getBuilder('bm_board bd');
        $builder->select('bd.*')
            ->select('(SELECT COUNT(idx) FROM bm_board_comment WHERE board_idx = bd.idx and del_yn = "N") as comment_cnt')
            ->where('bd.del_yn', 'N')
            ->where('bd.tbl_name', $tableName);

        if (!empty($param['stx'])) {
            $builder->like('bd.category', $param['sfl']);
            $builder->like('bd.title', $param['stx']);
        }

        // 페이징
        $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
        else $builder->limit($paging['listRows'], $paging['formRecord']);

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray() ?? [],
            'paging' => $paging,
        ];
    }

    //faq 수정
    public function getFaqEdit($idx = 0): array
    {
        $builder = $this->getBuilder('bm_board');
        $builder->select('*')
            ->where('del_yn', 'N')
            ->where('idx', $idx);

        return [
            'faqData' => $builder->get()->getRowArray() ?? [],
        ];
    }
}