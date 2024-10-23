<?php
class TestModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// 1개
	public function getTestByIdx($idx): array
	{
		// 로그 생성
		// log_message('debug', '지영 테스트');

		// 1. 직접넣기
		// $sql = "SELECT * FROM test_table WHERE idx = '{$idx}'";
		// $query = $this->db->query($sql);

		// 2. 물음표
		$sql = "SELECT * FROM test_table WHERE idx = ?";
		$query = $this->db->query($sql, array($idx));

		return $query->row_array() ?? array(); // 결과없을시 null 리턴함
	}

	// 여러개
	public function getTestList(): array
	{
		$sql = "SELECT * FROM test_table ORDER BY idx DESC";
		$query = $this->db->query($sql);

		return $query->result_array(); // 모든결과를 배열로 반환

	}
}
