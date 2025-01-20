<?php

/**
 * 게시글관리
 */
class BoardModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

    // 게시글 개수
    public function getBoardCount($category = 'review', $productIdx = 0): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM bs_board WHERE del_yn = 'N' AND ref_idx = ? AND category = ?";
        $query = $this->db->query($sql, [$productIdx, $category]);
        // log_message('debug', $this->db->last_query());
        $row = $query->row();

        return ($row && $row->cnt) ? $row->cnt : 0;
    }

	// 게시글 등록/수정
	public function registerBoard($boardData = array()): bool
	{
		try {
			if ($boardData['idx'] == 0) { // 등록
				$result = $this->db->insert('bs_board', $boardData);
			} else { // 수정
				$this->db->where('idx', $boardData['idx']);
				$result = $this->db->update('bs_board', $boardData);
			}

			return $result;

		} catch (Exception $e) {
			log_message('error', "게시글 등록 실패" . $e->getMessage());
			return false;
		}
	}

	// 게시글 상세
	public function getBoardInfoByIdx($idx = 0, $category = 'notice'): array
	{
		$sql = "SELECT *, (SELECT cn_name FROM bs_member WHERE mb_id = bs_board.mb_id) AS cn_name FROM bs_board WHERE del_yn = 'N' AND idx = ? AND category = ?";
		$query = $this->db->query($sql, array($idx, $category));

		return $query->row_array() ?? array();
	}

	// 게시글 목록
	public function getBoardList($param = array(), $isProductPage = false): array
	{
		// 공통쿼리
		$sqlCommon = "FROM bs_board WHERE del_yn = 'N' AND category = '{$param['cate']}'";
		$sqlSearch = "";

        // 상품페이지이면
        if($isProductPage) $sqlCommon .= "AND ref_idx = '{$param['productIdx']}'";

		// 검색
		if ($param['stx'] != "") {
			switch ($param['sfl']) {
				case "title" :      // 제목
					$sqlCommon .= "AND title LIKE '%{$param['stx']}%' ";
					break;
				case "content" :      // 상세설명
					$sqlCommon .= "AND content LIKE '%{$param['stx']}%' ";
					break;
			}
		}

		// 공지사항/상품문의 답변개수
		if ($param['cate'] == 'qna' || $param['cate'] == 'p_qna') {
			$sqlSearch .= ", (SELECT COUNT(*) FROM bs_board_comment WHERE del_yn = 'N' AND board_idx = bs_board.idx) AS commentCnt ";
		}

		// 페이징
		$totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
		$totalCountRow = $this->db->query($totalCountSql)->row();
		$totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
		$paging = getPaging($param['page'], $totalCount);

		// 목록
		$sql = "SELECT *, (SELECT cn_name FROM bs_member WHERE mb_id = bs_board.mb_id) AS cn_name {$sqlSearch} {$sqlCommon}
			ORDER BY idx DESC
            LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
		$query = $this->db->query($sql);

		$resultData = array();
		$resultData['listData'] = $query->result_array();
		$resultData['paging'] = $paging;

		return $resultData;
	}

	// 게시글 조회수
	public function updateBoardViewCount($idx = 0): bool
	{
		try {
			$sql = "UPDATE bs_board SET view_cnt = view_cnt + 1 WHERE idx = ?";
			return $this->db->query($sql, [$idx]);

		} catch (\Exception $e) {
			log_message('error', "게시글 삭제 실패" . $e->getMessage());
			return false;
		}
	}

	// 게시글 삭제
	public function deleteBoard($idx = 0, $memberId = ""): bool
	{
		try {
			$sql = "UPDATE bs_board SET del_yn = 'Y', mod_date = now(), mod_mb_id = ? WHERE idx = ?";
			return $this->db->query($sql, [$memberId, $idx]);

		} catch (\Exception $e) {
			log_message('error', "게시글 삭제 실패" . $e->getMessage());
			return false;
		}
	}

}
