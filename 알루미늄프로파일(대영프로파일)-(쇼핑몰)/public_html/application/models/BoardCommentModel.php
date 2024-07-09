<?php

/**
 * 게시글 코멘트
 */
class BoardCommentModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// 코멘트 목록
	public function getCommentList($boardIdx = 0): array
	{
		$sql = "SELECT * FROM bs_board_comment WHERE del_yn = 'N' AND board_idx = ? ORDER BY idx DESC";
		$query = $this->db->query($sql, [$boardIdx]);

		return $query->result_array();
	}

	// 코멘트 등록/수정/삭제
	public function registerComment($commentData = array()): bool
	{
		try {
			if ($commentData['idx'] == 0) { // 등록
				$result = $this->db->insert('bs_board_comment', $commentData);
			} else { // 수정
				$this->db->where('idx', $commentData['idx']);
				$result = $this->db->update('bs_board_comment', $commentData);
			}

			return $result;

		} catch (Exception $e) {
			log_message('error', "코멘트 등록 실패" . $e->getMessage());
			return false;
		}
	}


}
