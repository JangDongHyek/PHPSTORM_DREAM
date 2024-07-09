<?php
/**
 * 그룹관리
 */
class MemberGroupModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    // 그룹 조회 : 그룹명 object 반환 (key, name)
    public function fetchGroupKeyNames($idxList = ""): array
    {
        $sql = "SELECT idx, group_name FROM bs_member_group WHERE del_yn = 'N'";
        if ($idxList != "" && $idxList != "ALL") $sql .= " AND idx IN ({$idxList})"; // $idxList == "ALL": 그룹전체선택
        $sql .= " ORDER BY idx ASC;";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        $formattedResult = [];
        foreach ($result as $row) {
            $formattedResult[$row['idx']] = $row['group_name'];
        }

        return $formattedResult; // Array([1] => 해밀, [2] => 드림한의원)
    }

    // 그룹 목록
    public function getMemberGroupList($param = array()): array
    {
        // 공통 쿼리
        $sqlCommon = "FROM bs_member_group WHERE del_yn = 'N' ";

        // 검색
        if($param['stx'] != "") {
            switch ($param['sfl']) {
                case "gname" : // 그룹명
                    $sqlCommon .= "AND group_name LIKE '%{$param['stx']}%'";
                    break;
            }
        }

        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);

        // 목록
        $sql = "SELECT *, (SELECT COUNT(*) FROM bs_member WHERE del_yn = 'N' AND group_idx = bs_member_group.idx AND bs_member.mb_level < 6) AS clinicCnt
            {$sqlCommon}
            ORDER BY idx DESC
            LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
        $query = $this->db->query($sql);

        $resultData = array();
        $resultData['listData'] = $query->result_array();
        $resultData['paging'] = $paging;

        return $resultData;
    }

    // 그룹 삭제 및 그룹에 속한 회원/한의원 group_idx 초기화
    public function deleteMemberGroup($idxArr = array()): bool
    {
        try {
            $sql = "UPDATE bs_member_group SET del_yn = 'Y', mod_date = now() WHERE idx IN ?";
            $result = $this->db->query($sql, [$idxArr]);

            if($result) {
                $sql = " UPDATE bs_member SET group_idx = 0 WHERE group_idx IN ?";
                $this->db->query($sql, [$idxArr]);
            }
            return true;

        } catch (\Exception $e) {
            log_message('error', '그룹 삭제 실패=>' . $e->getMessage());
            return false;
        }
    }

    // 그룹명 중복확인
    public function checkDuplicateGroupName($groupName): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM bs_member_group WHERE del_yn = 'N' AND group_name = ?";
        $query = $this->db->query($sql, [$groupName]);
        log_message('debug', $this->db->last_query());

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->cnt;
        }

        return 0;
    }

    // 그룹 등록/수정
    public function registerMemberGroup($groupData = array(), $isModify = false): bool
    {
        try {
            // 1. 그룹 등록
            if(!$isModify) {
                $this->db->insert('bs_member_group', $groupData);
            }
            // 2. 그룹 수정
            else {
                $sql = "UPDATE bs_member_group SET group_name = ?, premium_rate = ?, mod_date = now() WHERE idx = ?";
                $this->db->query($sql, $groupData);
            }
            // log_message('debug', $this->db->last_query());
            return true;

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    // 그룹 정보 (1개)
    public function getMemberGroupInfo($idx): array
    {
        $sql = "SELECT * FROM bs_member_group WHERE idx = ? AND del_yn = 'N'";
        $query = $this->db->query($sql, [$idx]);
        $row = $query->row();

        // 배열로 반환
        return $row ? get_object_vars($row) : [];
    }
}