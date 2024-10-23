<?php
/**
 * 주문서
 */
class OrderLibrary
{
	// 주문서 공통정보 (쇼핑몰, 관리자)
	public function getOrderCommonData($ordIdx = 0): array
	{
		$CI =& get_instance();

		// 1. 주문서 정보
		$CI->load->model("OrderModel");
		$orderData = $CI->OrderModel->getOrderInfoByIdx($ordIdx);

		// 2. 주문서 상세정보
		$CI->load->model("OrderItemModel");
		$orderItemData = $CI->OrderItemModel->getOrderItemList($ordIdx);

		// 3. PG 결제 조회
		$payData = [];
		if ($orderData['pay_method'] == 'CARD' || $orderData['pay_method'] == 'VBANK') {
			$CI->load->model('PaymentModel');
			$payData = $CI->PaymentModel->getPaymentInfoByOrdNo($orderData['ord_no']);
		}

		return array(
			'orderData' => $orderData,
			'orderItemData' => $orderItemData,
			'payData' => $payData,
		);
	}
}
