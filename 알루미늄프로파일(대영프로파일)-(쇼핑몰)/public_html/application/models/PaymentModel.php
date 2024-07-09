<?php
/**
 * 결제
 * @property OrderModel $OrderModel
 * @property ProductCartModel $ProductCartModel
 */
class PaymentModel extends CI_Model
{
    public function __construct()
	{
		$this->load->database();
	}

	// PG 결제(완료/실패) 처리
	// 1. 결제 DB 등록
	// 2. 결제 성공시
	// - (1) 주문서 DB 수정
	// - (2) 사용포인트가 존재하면 한의원 포인트 차감 -- 현재 포인트기능 없음
	// - (3) 약속처방 장바구니 삭제
	// 3. 결제 실패시 - 트랜잭션 밖에서 처리
	public function insertPaymentAndUpdateOrder($ipaySuccess = false, $payData = array(), $orderData = array()): bool
	{
		// 트랜잭션 시작
		$this->db->trans_begin();

		try {
			$this->load->model('OrderModel');
			$this->load->model('ProductCartModel');

			// 1. 결제 DB 등록
			$this->db->insert('bs_payment', $payData);
			$paymentIdx = $this->db->insert_id();

			// 2. 결제 성공시
			if ($ipaySuccess) {
				// (1) 주문서 DB 수정
				$isUpdate = $this->OrderModel->updateOrderSuccess($orderData);
				if (!$isUpdate) {
					throw new Exception('주문서 DB 수정 실패');
				}

				// 사용포인트, 주문 인덱스 조회
				$row = $this->OrderModel->getOrderInfoByOrdNo($orderData['ord_no'], 'idx, use_point');
				$usePoint = (int)$row['use_point'];
				$orderIdx = $row['idx'];

				// (2) 사용포인트가 존재하면 한의원 포인트 차감 -- 현재 포인트기능 없음
				if ($usePoint > 0) {
					// pass
				}

				// (3) 장바구니 삭제
				$this->ProductCartModel->deleteCartItem(array(), $orderIdx);
			}

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
			log_message('error', '결제처리 등록실패=>' . $e->getMessage());
			return false;
		}
	}

	// 결제 상세정보 (주문번호로 조회 & 결제완료된 건만)
	public function getPaymentInfoByOrdNo($ordNo, $columns="*"): array
	{
		$sql = "SELECT {$columns} FROM bs_payment 
             WHERE moid = ? AND pay_status = 'Y' ORDER BY idx DESC LIMIT 1";
		$query = $this->db->query($sql, [$ordNo]);
		$row = $query->row();

		// 배열로 반환
		return $row ? get_object_vars($row) : [];
	}



}
