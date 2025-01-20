<?php
/**
 * 회원관리
 * @property MemberGroupModel $MemberGroupModel
 */
class MemberModel extends CI_Model
{
    public function __construct()
	{
		$this->load->database();
	}

	// 아이디로 회원정보상세
	public function getMemberById($memberId): array
	{
		$sql = "SELECT * FROM bs_member WHERE del_yn = 'N' AND mb_id = ?";
		$query = $this->db->query($sql, array($memberId));

		return $query->row_array() ?? array();
	}

	// 아이디 중복확인
	public function checkDuplicateMemberId($memberId): int
	{
		$sql = "SELECT COUNT(*) AS cnt FROM bs_member WHERE mb_id = ?";
		$query = $this->db->query($sql, array($memberId));

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->cnt;
		}

		return 0;
	}

	// 사업자등록번호 중복확인
	public function checkDuplicateBrno($brno = '', $excMemberId = ''): int
	{
		$sql = "SELECT COUNT(*) AS cnt FROM bs_member WHERE del_yn = 'N' AND biz_rno = ? ";
		if ($excMemberId != '') $sql .= " AND mb_id != '{$excMemberId}' "; // 수정시 내정보제외
		$query = $this->db->query($sql, array($brno));

		// log_message('debug', $this->db->last_query());

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->cnt;
		}

		return 0;
	}

	// 회원가입/내정보수정 처리 (+ 관리자 회원 등록/수정)
	public function registerMember($memberData = array(), $isModify = false): bool
	{
		try {
            if(!$isModify) {
                // 회원가입 및 관리자 회원등록
				$result = $this->db->insert('bs_member', $memberData);

            } else {
                // 관리자 회원수정
                if (!empty($memberData['mb_password'])) {
                    $this->db->set('mb_password', $memberData['mb_password']);
                } else {
                    unset($memberData['mb_password']);
                }
                $this->db->set('mod_date', 'now()', false);

				$this->db->where('idx', $memberData['idx']);
				$result = $this->db->update('bs_member', $memberData);
            }

			// log_message('debug', $this->db->last_query());
			return $result;

		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	// 로그인 일자
	public function updateMemberLoginDate($loginData = array()): bool
	{
		try {
			$sql = "UPDATE bs_member SET 
                     login_ip = ?, 
                     login_date = now(), 
                     user_agent = ? 
                    WHERE idx = ?";
			return $this->db->query($sql, $loginData);

		} catch (\Exception $e) {
			return false;
		}
	}

    // 회원 목록
    public function getMemberList($param = array(), $orderBy = ""): array
    {
        // 공통쿼리
        $sqlCommon = "FROM bs_member WHERE del_yn = 'N' AND mb_level < 6 ";

        // 검색
        if ($param['stx'] != "") {
            switch ($param['sfl']) {
                case "cname" :      // 한의원명
                    $sqlCommon .= "AND cn_name LIKE '%{$param['stx']}%' ";
                    break;
                case "name" :       // 이름
                    $sqlCommon .= "AND mb_name LIKE '%{$param['stx']}%' ";
                    break;
                case "mb_hp" :       // 전화번호
                    $sqlCommon .= "AND mb_hp LIKE '%{$param['stx']}%' ";
                    break;
                case "id" :         // 아이디
                    $sqlCommon .= "AND mb_id LIKE '%{$param['stx']}%' ";
                    break;
                case "rname" : // 대표자명
                    $sqlCommon .= " AND rep_name LIKE '%{$param['stx']}%'";
                    break;
                case "brno" : // 사업자등록번호
                    $sqlCommon .= " AND biz_rno LIKE '%{$param['stx']}%'";
                    break;
                case "tel" : // 대표전화
                    $sqlCommon .= " AND cn_tel LIKE '%{$param['stx']}%'";
                    break;
                case "addr" : // 주소
                    $sqlCommon .= " AND cn_addr LIKE '%{$param['stx']}%'";
                    break;
            }
        }
        // 그룹 선택시
        if (!empty($param['groupIdx'])) {
            $groupIdxArr = explode(",", $param['groupIdx']);
            if (count($groupIdxArr) > 0) $sqlCommon .= " AND group_idx IN (".implode(",", $groupIdxArr).")";
        }
        // 승인여부
        if (!empty($param['isAuth'])) $sqlCommon .= " AND auth_yn = '{$param['isAuth']}'";
        // 미수여부
        if (!empty($param['isMisu'])) $sqlCommon .= " AND misu_yn = '{$param['isMisu']}'";

        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);

		// 서브쿼리 추가
		$sqlSearch = "";
		if (!empty($param['addGroupName'])) // 그룹명
			$sqlSearch .= ", (SELECT group_name FROM bs_member_group WHERE del_yn = 'N' AND idx = bs_member.group_idx) AS groupName";
		if (!empty($param['addMisuAmt'])) { // 미수관리 데이터
			$thisMonthFirstDate = date('Y-m-01');
			$thisMonthLastDate = date('Y-m-t');
			$thisMonthBetween = "AND trans_date BETWEEN '{$thisMonthFirstDate}' AND '{$thisMonthLastDate}'";
			$misuCommonWhere = "FROM bs_misu WHERE del_yn = 'N' AND mb_id = bs_member.mb_id";

			// 총입금, 총외상, 이번달입금, 이번달외상
			$sqlSearch .= ", (SELECT SUM(deposit) {$misuCommonWhere}) as depAmt";
			$sqlSearch .= ", (SELECT SUM(credit_price) {$misuCommonWhere}) as creditAmt";
			$sqlSearch .= ", (SELECT SUM(deposit) {$misuCommonWhere} {$thisMonthBetween}) as monthDepAmt";
			$sqlSearch .= ", (SELECT SUM(credit_price) {$misuCommonWhere} {$thisMonthBetween}) as monthCreditAmt";
		}

		// 정렬 (기본등록순)
		$sqlOrderBy = "ORDER BY mb_level DESC, idx DESC";
		if ($orderBy == "name") $sqlOrderBy = "ORDER BY cn_name ASC"; // 한의원명

        // 목록
        $sql = "SELECT * {$sqlSearch}
            {$sqlCommon}
            {$sqlOrderBy}
            LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
        $query = $this->db->query($sql);

        // 목록 상단 검색필터
        $filter = [];
		$this->load->model('MemberGroupModel');
		$filter['groupNames'] = $this->MemberGroupModel->fetchGroupKeyNames(); // 그룹 목록

        $resultData = array();
        $resultData['listData'] = $query->result_array();
        $resultData['paging'] = $paging;
        $resultData['searchFilter'] = $filter;

        return $resultData;
    }

    // 회원 승인/승인취소
    public function updateAuthMember($isAuth = 'N', $idxArr = array()): bool
    {
        try {
            $sql = "UPDATE bs_member SET auth_yn = ?, auth_date = now() WHERE idx IN ?";
            return $this->db->query($sql, [$isAuth, $idxArr]);
            // log_message('debug', $this->db->last_query());

        } catch (\Exception $e) {
            log_message('error', "회원 승인/승인취소 실패" . $e->getMessage());
            return false;
        }
    }

    // 회원 미수업체 등록/해제
    public function updateMisuMember($misuYn = 'N', $idx = 0): bool
    {
        try {
            $sql = "UPDATE bs_member SET misu_yn = ? WHERE idx = ?";
            return $this->db->query($sql, [$misuYn, $idx]);

        } catch (\Exception $e) {
            log_message('error', "회원 미수업체 등록/해제 실패" . $e->getMessage());
            return false;
        }
    }

    // 회원 정보 (1개)
    public function getMemberInfo($idx = 0): array
    {
        $sql = "SELECT * FROM bs_member WHERE idx = ? AND del_yn = 'N'";
        $query = $this->db->query($sql, [$idx]);
        $row = $query->row();

        // 배열로 반환
        return $row ? get_object_vars($row) : [];
    }

	// 아이디/비밀번호 찾기
	public function findAccount($findType = 'id', $findData = array(), $tmpPassword = ''): array
	{
		$sql = "SELECT mb_id, DATE(reg_date) as reg_date, mb_name FROM bs_member WHERE del_yn = 'N' ";
		if ($findType == 'id') {
			$sql .= " AND mb_name = ? AND cn_email = ?";
			$sql .= " ORDER BY idx ASC";

			$query = $this->db->query($sql, $findData);
			return $query->result_array();

		} else {
			$sql .= " AND mb_id = ? AND cn_email = ?";
			$sql .= " LIMIT 1";

			$query = $this->db->query($sql, $findData);
			return $query->row_array() ?? []; // 배열로 반환
		}
	}

	// 임시비밀번호 변경
	public function updateMemberPassword($memberId = '', $password = '')
	{
		try {
			$sql = "UPDATE bs_member SET mb_password = ? WHERE mb_id = ?";
			return $this->db->query($sql, [$password, $memberId]);

		} catch (\Exception $e) {
			log_message('error', "임시비밀번호 변경 실패" . $e->getMessage());
			return false;
		}
	}

}
