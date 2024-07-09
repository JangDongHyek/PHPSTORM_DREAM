<?php

/**
 * 미수관리
 */
class MisuModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// 한의원 총 미수금 & 한의원명 조회
	public function getMisuAmt($memberIdx = 0): array
	{
		$sql = "SELECT (SUM(A.credit_price) - SUM(A.deposit)) AS total, B.cn_name, B.idx, B.mb_id
            FROM bs_misu A RIGHT JOIN bs_member B 
            ON A.mb_id = B.mb_id AND A.del_yn = 'N'
            WHERE B.idx = ? AND B.del_yn = 'N';
        ";
		$query = $this->db->query($sql, array($memberIdx));
		return $query->row_array() ?? []; // 배열로 반환
	}

	// 한의원 거래내역 (미수상세)
	public function getMisuDetailList($param = array(), $memberId = "", $isAdminPage = true)
	{
		// 공통 쿼리
		$sqlCommon = "FROM bs_misu WHERE del_yn = 'N' AND mb_id = '{$memberId}' ";
		if (!$isAdminPage) $sqlCommon .= " AND sales_price = 0 "; // 한의원 외상거래만 노출 (일반거래 숨김)

		// 검색
		if (!empty($param['stx'])) {
			switch ($param['sfl']) {
				case "content" : // 내용
					$sqlCommon .= " AND trans_content LIKE '%{$param['stx']}%'";
					break;
			}
		}
		// 시작일,종료일
		if (!empty($param['sdt'])) $sqlCommon .= "AND DATE(trans_date) >= '{$param['sdt']}' ";
		if (!empty($param['edt'])) $sqlCommon .= "AND DATE(trans_date) <= '{$param['edt']}' ";
		// 입력구분 (1:직접입력, 2:외상주문)
		if ($param['regType'] == '1') $sqlCommon .= "AND ord_idx = 0 ";
		else if ($param['regType'] == '2') $sqlCommon .= "AND ord_idx > 0 ";
		// 입금/외상 (1:입금, 2:외상)
		if ($param['transType'] == '1') $sqlCommon .= "AND deposit > 0 ";
		else if ($param['transType'] == '2') $sqlCommon .= "AND credit_price > 0 ";
		// 결제
		if (!empty($param['payMethod'])) $sqlCommon .= "AND trans_type = '{$param['payMethod']}'";


		// 페이징
		$totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
		$totalCountRow = $this->db->query($totalCountSql)->row();
		$totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
		$paging = getPaging($param['page'], $totalCount);
		$sqlPaging = "LIMIT {$paging['formRecord']}, {$paging['listRows']}";

		// 목록 (정렬변경금지-잔액계산이 달라짐)
		$sql = "SELECT * {$sqlCommon}
            -- ORDER BY trans_date DESC, idx DESC
            ORDER BY sort DESC
            {$sqlPaging}
        ";
		$query = $this->db->query($sql);

		$resultData = array();
		$resultData['listData'] = $query->result_array();
		$resultData['paging'] = $paging;

		return $resultData;
	}

	// 거래조회
	public function getMisuInfo($idx): array
	{
		$sql = "SELECT * FROM bs_misu WHERE del_yn = 'N' AND idx = ?";
		$query = $this->db->query($sql, array($idx));
		return $query->row_array() ?? []; // 배열로 반환
	}

	// 거래등록
	public function registerMisu($misuData = array()): int
	{
		// 트랜잭션 시작
		$this->db->trans_begin();

		try {
			$isModify = (int)$misuData['idx'] > 0;

			// 1. 등록
			if (!$isModify) {
				if (empty($misuData['del_yn'])) $misuData['del_yn'] = 'N';
				if (empty($misuData['sales_price'])) $misuData['sales_price'] = 0;

				$this->db->insert('bs_misu', $misuData);
			} // 2. 수정
			else {
				$this->db->where('idx', $misuData['idx']);
				$this->db->update('bs_misu', $misuData);
			}

			// 3. 잔액계산
			$this->updateMisuBalance($misuData['mb_id']);

			// 트랜잭션 완료
			$this->db->trans_complete();

			// 트랜잭션 상태 확인
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
			}

			return true;

		} catch (Exception $e) {
			// 실패시 롤백
			$this->db->trans_rollback();
			log_message('error', '미수거래 등록실패' . $e->getMessage());
			return false;
		}
	}

	// 잔액 계산 (잔액, 정렬순서 업데이트)
	public function updateMisuBalance($id = ""): bool
	{
		try {
			$sql = "SELECT idx, credit_price, deposit FROM bs_misu 
                WHERE del_yn = 'N' AND mb_id = ?
                ORDER BY trans_date ASC, idx ASC
            ";
			$query = $this->db->query($sql, [$id]);

			$balance = 0;  // 잔액
			foreach ($query->result_array() as $key => $row) {
				$plus = (int)$row['deposit'];
				$minus = (int)$row['credit_price'];
				// $balance += ($plus - $minus);
				$balance += ($minus - $plus); // 잔액 += 외상-입금

				// 잔액 업데이트
				$misuData = [
					'balance' => $balance,
					'sort' => $key,
				];
				$this->db->where('idx', $row['idx']);
				$updateRes = $this->db->update('bs_misu', $misuData);
				if (!$updateRes) throw new Exception('잔액 업데이트 실패');
			}

			return true;

		} catch (Exception $e) {
			log_message('error', '잔액계산 실패' . $e->getMessage());
			return false;
		}
	}

	// 거래삭제
	public function updateMisuDelYn($idx = 0, $memberId = "", $ordIdx = 0, $value = 'Y'): bool
	{
		// 트랜잭션 시작
		$this->db->trans_begin();

		try {
			// 1. 삭제
			if ($idx > 0) {
				// 1.1 거래 인덱스로 삭제
				$sql = "UPDATE bs_misu SET del_yn = ?, del_date = now() WHERE idx = ?";
				$this->db->query($sql, [$value, $idx]);

			} else if ($ordIdx > 0) {
				// 1.2 주문 인덱스로 삭제 or 복구
				$sql = "UPDATE bs_misu SET del_yn = ?, del_date = now() WHERE ord_idx = ?";
				$this->db->query($sql, [$value, $ordIdx]);
			}

			// 2. 잔액계산
			$this->updateMisuBalance($memberId);

			// 트랜잭션 완료
			$this->db->trans_complete();

			// 트랜잭션 상태 확인
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
			}

			return true;

		} catch (Exception $e) {
			// 실패시 롤백
			$this->db->trans_rollback();
			log_message('error', '미수거래 삭제실패' . $e->getMessage());
			return false;
		}
	}


}
