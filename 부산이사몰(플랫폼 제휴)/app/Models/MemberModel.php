<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;
use CodeIgniter\Model;

class MemberModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_member';

    //회원 상세
    public function getMemberById($userId = null, $snsType = null, $snsId = null): array
    {
        $builder = $this->getBuilder('bm_member', 'mb');
        $builder->select('mb.*')
            ->where('del_yn', 'N');

        if (!empty($userId)) $builder->where('mb_id', $userId);
        else {
            $builder->where('sns_type', $snsType)
                ->where('sns_uniq_id', $snsId);
        }

        $row = $builder->get()->getRowArray();

        if (isset($row)) {
            unset($row['sns_uniq_id']);
        }

        return $row ?? [];
    }

    //등록되 전화번호 확인
    public function getMemberPhone($phone = ''): array
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where('del_yn', 'N')
            ->where('left_at IS NULL');
        if (!empty($phone)) $builder->where('mb_hp', $phone);

        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

    // 회원 상세
    public function getMemberInfoIdx($idx = null): array
    {
        $builder = $this->getBuilder('bm_member', 'mb');
        $builder->select('mb.*')
            ->where('del_yn', 'N');

        if (!empty($idx)) $builder->where('idx', $idx);

        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

    // 아이디 중복확인
    public function checkDuplicateId($id = ''): int
    {
        // 사용불가 아이디
        $lowerNick = strtolower($id);
        $allowedNicks = array_map('strtolower', ['admin', 'lets', 'test']);
        if (in_array($lowerNick, $allowedNicks)) return 1;

        $builder = $this->getBuilder('bm_member');
        $builder->selectCount('*', 'cnt')
            ->where('mb_id', $id)
            ->where('del_yn', 'N');

        $row = $builder->get()->getRowArray();

        return (int)($row['cnt'] ?? 0);
    }

    // 등록
    public function insertMember($member = []): bool
    {
        // 트랜잭션 시작
        $this->db->transBegin();
        try {
            $builder = $this->getBuilder('bm_member');
            $builder->insert($member);

            return true;
        } catch (\Exception $e) {
            log_message('error', "회원등록실패: " . $e->getMessage());
            return false;
        }
    }


    public function getCompanyByIdx($idx = 0): array
    {
        $builder = $this->getBuilder('bm_member', 'a');
        $builder->select('*')
            ->join('bm_company b', 'a.idx = b.mb_idx ', 'left')
            ->where('a.del_yn', 'N')
            ->where('b.del_yn', 'N')
            ->where('a.idx', $idx);

        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

    // 수정
    public function updateMember($data = [], $condition = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_member');
            $builder->set($data)
                ->set('updated_at', 'now()', false)
                ->where($condition)
                ->update();

            return true;

        } catch (\Exception $e) {
            log_message('error', "수정실패: " . $e->getMessage());
            return false;
        }
    }

    //회원목록
    public function getMemberList($param = []): array
    {
        $builder = $this->getBuilder('bm_member');
        $builder->select('*')
            ->where('del_yn', 'N')
            ->where('mb_level != 10')
            ->where('left_at IS NULL')
            ->orderBy('idx', 'DESC');

        if (!empty($param['type'])) {
            if ($param['type'] !== 'all') {
                $builder->where('mb_level', $param['type']);
            }
        }

        if (!empty($param['state'])) {
            $builder->where('state', $param['state']);
        }

        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case 'mbId':
                    $builder->like('mb_id', $param['stx']);
                    break;
                case 'mbName':
                    $builder->like('mb_name', $param['stx']);
                    break;
                case 'companyName':
                    $builder->like('company_name', $param['stx']);
                    break;
            }
        }

        // 페이징
        $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        if (($param['limitCnt'] ?? 0) > 0) {
            $builder->limit($param['limitCnt']);
        } else {
            $builder->limit($paging['listRows'], $paging['formRecord']);
        }

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray(),
            'paging' => $paging,
        ];
    }

    public function memberFindId(array $member): array
    {
        $builder = $this->getBuilder('bm_member');
        $builder->select('*')
            //->where('del_yn', 'N')
            ->where('mb_level != 10')
            //->where('left_at IS NULL')
            ->orderBy('idx', 'DESC');

        if (!empty($member['mb_name'])) $builder->where('mb_name', $member['mb_name']);
        if (!empty($member['cmbName'])) $builder->where('mb_name', $member['cmbName']);

        if (!empty($member['biz_no'])) $builder->where('biz_no', $member['biz_no']);
        if (!empty($member['mb_hp'])) $builder->where('mb_hp', $member['mb_hp']);
        $row = $builder->get()->getRowArray();

        return $row ?? [];
    }

    public function kakaoTalList($idx = ''): array
    {
        $builder = $this->getBuilder('bm_member');
        $builder->select('*')
            ->where('del_yn','N')
            ->where('left_at is null')
            ->where('mb_level','5')
            ->where('state','N');

        if (!empty($idx)) $builder->where('idx', $idx);
        $listData = $builder->get()->getResultArray();

        return $listData;
    }

}
