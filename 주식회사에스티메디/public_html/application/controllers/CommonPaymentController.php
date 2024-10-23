<?php

/**
 * 이노페이
 *
 * @property PaymentModel $PaymentModel
 * @property OrderModel $OrderModel
 */
class CommonPaymentController extends CI_Controller
{
	// 이노페이 결제요청결과
	public function responseInnoPay()
	{
		// print_r($_POST); // X
		// print_r($_GET); // O
		// print_r($_REQUEST); // X

		// 결제 로그 등록
		write_payment_log($_GET);

		$member = $this->session->userdata('member');

		// 성공코드
		// 3001: 카드결제 성공
		// 4000: 계좌이체결제 성공 (현재 계좌이체 사용안함)
		// 4100: 가상계좌 발급 성공
		// 4110: 가상계좌 입금 성공 (입금확인은 이노페이 리다이렉트 URL 에서 체크)
		$ipaySuccessCode = ['3001', '4000', '4100', '4110'];
		$resultCode = $_GET['ResultCode'];
		$ipaySuccess = (in_array($resultCode, $ipaySuccessCode)); // 결제성공여부
		$orderNo = trim($_GET['MOID']); // 주문번호

		// 결제 데이터
		$payData = [
			'pay_status' => ($ipaySuccess) ? 'Y' : 'F',
			'pay_method' => $_GET['PayMethod'],
			'mb_id' => $member['mb_id'],
			'goods_cnt' => 1,
			'goods_name' => mb_substr($_GET['GoodsName'], 0, 40),
			'amt' => $_GET['Amt'],
			'cancel_date' => '',
			'cancel_mb_id' => '',
			'moid' => $orderNo,
			'tid' => $_GET['TID'],
			'auth_date' => $_GET['AuthDate'],
			'auth_code' => $_GET['AuthCode'],
			'result_code' => $resultCode,
			'result_msg' => $_GET['ResultMsg'],
			'mall_reserved' => $_GET['MallReserved'],
			'fn_code' => $_GET['fn_cd'],
			'fn_name' => $_GET['fn_name'],
			'acqu_card_code' => $_GET['AcquCardCode'],
			'acqu_card_name' => $_GET['AcquCardName'],
			'card_quota' => $_GET['CardQuota'],
			'receipt_type' => $_GET['ReceitType'],
			'vbank_exp_date' => $_GET['VbankExpDate'],
			'vbank_name' => $_GET['VbankName'],
			'vbank_num' => $_GET['VbankNum'],
			'vbank_account_name' => $_GET['VBankAccountName'],
			'error_msg' => $_GET['ErrorMsg'],
			'error_code' => $_GET['ErrorCode'],
			'mid' => $_GET['MID'],
		];

		// 주문서 수정 데이터
		$orderData = [
			'tmp_save_yn' => 'N',
			'payment_status' => ($resultCode == '4100') ? 'R' : 'Y', // 가상계좌발급성공시 R
			'ord_no' => $orderNo,
		];

		// 결제(성공/실패) DB 등록 & 주문서 DB 수정
		$this->load->model("PaymentModel");
		$procResult = $this->PaymentModel->insertPaymentAndUpdateOrder($ipaySuccess, $payData, $orderData);
		$redirectErrorPage = false;
		$redirectErrorMessage = $payData['errorMsg'];

		// DB 처리 실패
		if (!$procResult) {
			$redirectErrorPage = true;
			$redirectErrorMessage = '결제처리 중 서버 통신 실패';
			// 결제취소 API (현재 X)
			// ...
		}
		// 결제 실패
		if (!$ipaySuccess) $redirectErrorPage = true;

		if ($redirectErrorPage) {
			// 결제실패 페이지로 이동
			redirect(PROJECT_URL . '/paymentFailed?msg=' . urlencode($redirectErrorMessage));
		} else {
			// 결제성공 페이지로 이동
			redirect(PROJECT_URL . '/paymentSuccess?no=' . $orderNo);
		}

	}

	// 결제 성공 페이지
	public function paymentSuccess()
	{
		// 주문정보
		$orderNo = $_GET['no'];
		$this->load->model('OrderModel');
		$order = $this->OrderModel->getOrderInfoByOrdNo($orderNo);

		if (!$order) {
			$data = [
				'message' => '존재하지 않는 주문번호 입니다.',
				'historyBack' => true,
			];
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}

		$this->load->model('PaymentModel');

		$data = [
			'pid' => 'order_sheet',
			'order' => $order,
			'payment' => $this->PaymentModel->getPaymentInfoByOrdNo($orderNo),
		];

		render('mall/payment_success', $data);
	}

	// 결제 실패 페이지
	public function paymentFailed()
	{
		// 결제실패사유
		$errorMessage = $_GET['msg'] ? urldecode($_GET['msg']) : '서버통신실패';

		$data = [
			'pid' => 'order_sheet',
			'errorMessage' => $errorMessage,
		];

		render('mall/payment_fail', $data);
	}

}
