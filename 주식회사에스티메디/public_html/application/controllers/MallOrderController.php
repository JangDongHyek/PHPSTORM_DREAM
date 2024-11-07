<?php
include_once APPPATH.'libraries/Jl.php';
/**
 * 관리자 상품관리
 * @property ProductCartModel $ProductCartModel
 * @property ConfigModel $ConfigModel
 * @property OrderModel $OrderModel
 * @property OrderItemModel $OrderItemModel
 */
class MallOrderController extends CI_Controller {
    public $jl;

    public function __construct()
    {
        parent::__construct();

        try {
            $this->jl = new Jl();
        }catch(Exception $e) {}
    }

	// 주문서 작성
	public function orderSheet()
	{
		if (!loginCheck()) return;
		$post = $this->input->post();

		// $_POST['cartIdx'] = [1,2]; // test

		// 1. 장바구니 인덱스 없음
		if (empty($post['cartIdx']) || count($post['cartIdx']) == 0) {
			$data = [
				'message' => '주문정보를 불러오는데 실패했습니다.',
				'historyBack' => true,
			];
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}

		$this->load->model('ProductCartModel');
		$cartList = $this->ProductCartModel->getCartList($post['cartIdx']);

		// 2. 장바구니 데이터를 불러오지 못함
		if (count($cartList) == 0) {
			$data = [
				'message' => '주문정보를 불러오는데 실패했습니다.',
				'historyBack' => true,
			];
			log_message('error', "장바구니호출실패" . json_encode($post, JSON_UNESCAPED_UNICODE));
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}


		// 기본배송비정보
		$this->load->model("ConfigModel");
		$configData = $this->ConfigModel->getSystemConfig();

        $member = $this->session->userdata('member');
        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $this->load->model('ProductModel');
        $agencyData = [];
        foreach ($cartList as $row){
            //에이전시 수수료부분 wc
            $data = $this->ProductModel->getAgencyFeeData($row['idx'],"{$member['agency']}");
            array_push($agencyData,$data);
        }


        $data = [
            'pid' => 'order_sheet',
			'listData' => $cartList,
			'configData' => $configData,
			'member' => $member,
			'agencyData' => $agencyData,
            "jl" => $this->jl
        ];

		render('mall/order_sheet', $data);
	}

	// 주문배송조회
	public function orderList()
	{
		if (!loginCheck()) return;
		$get = $this->input->get();

		$param = array(
			'page' => $get['page'] ?? 1,
			// 'sfl' => $get['sfl'] ?? 'name',
			// 'stx' => $get['stx'] ?? '',
			'sdt' => $get['sdt'] ?? '',
			'edt' => $get['edt'] ?? '',
		);

		$this->load->model("OrderModel");
		$resultData = $this->OrderModel->getOrderList($param);

		$data = [
			'pid' => 'order',
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
		];

		render('mall/order_list', $data);
	}

	// 주문배송조회 상세
	public function orderView($idx = 0)
	{
		if (!loginCheck()) return;

		// 주문공통 정보
		$this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
		$orderCommon = $this->orderlibrary->getOrderCommonData($idx);

		$orderData = $orderCommon['orderData']; 			// 주문서
		$orderItemData = $orderCommon['orderItemData'];		// 주문서 상세
		$payData = $orderCommon['payData']; 				// PG 결제

		$member = $this->session->userdata("member");

		if (empty($orderData['idx']) || $orderData['mb_id'] != $member['mb_id']) {
			$data = [
				'message' => '존재하지 않는 정보입니다.',
				'historyBack' => true,
			];
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}

		$data = [
			'pid' => 'order_view',
			'orderData' => $orderData,
			'orderItemData' => $orderItemData,
			'payData' => $payData,
		];

		render('mall/order_view', $data);
	}

	// 약속처방 주문서 작성 (결제전 임시저장)
	public function postAddProductOrder()
	{
		$resultData = ['result' => false];
		$post = $this->input->post();
		// $resultData['post'] = $_POST;
		$memberId = $this->session->userdata('member')['mb_id'];

		// 1. 주문상세(상품정보)
		$orderDetailData = [];
		$itemName = [];
		$agency_fee = [];
		foreach ($post['productIdx'] as $pIdx) {
			$orderDetailData[$pIdx] = [
				'ord_idx' => 0,
				'product_idx' => (int)$pIdx,
				'item_name' => $post['productName'][$pIdx],
				'item_price' => (int)$post['productPrice'][$pIdx],
				'item_cnt' => (int)$post['productCnt'][$pIdx],
				'mb_id' => $memberId,
			];
			$itemName[] = $post['productName'][$pIdx];
            $agency_fee[] = $post['agency_fee'][$pIdx];
		}
		// $resultData['주문서 상세정보'] = $orderDetailData;

		// 2. 주문서
		$orderNo = createOrderNo(); // 주문번호 생성

		// 결제수단 (전액포인트결제시 결제수단 포인트로 변경)
		$payMethod = $post['payMethod'];
		// if (extractNumbers($post['totalPrice']) == 0) $payMethod = 'POINT';

		// 현금결제 여부
		$isCashPayment = $payMethod == 'CASH';
		// 임시저장 아님 체크 (현금결제 OR 포인트결제 OR 월말결제 = N, 나머지 = 임시저장)
		$tmpSaveYn = ($isCashPayment || $payMethod == 'POINT' || $payMethod == 'CREDIT') ? 'N' : 'Y';
		// 결제상태 체크 (현금결제 OR 가상계좌 OR 월말결제 = 입금대기, 나머지 = 결제완료)
		$paymentStatus = ($isCashPayment || $payMethod == 'VBANK' || $payMethod == 'CREDIT') ? 'R' : 'Y';

        // 추가배송비 관련부분 wc
        $this->load->model("OrderModel");
        $delivery_fee2 = $this->OrderModel->getOrderSendCost2($post['recZcode']);

		$orderData = [
			'tmp_save_yn' => $tmpSaveYn,
			'mb_id' => $memberId,
			'ord_no' => $orderNo,
			'ord_status' => 'R',
			'payment_status' => $paymentStatus,
			'ord_cancel_yn' => 'N',
			'ord_cancel_date' => '',
			'delivery_fee' => $post['deliveryFee'],
            'delivery_fee2' => extractNumbers($delivery_fee2),
            'agency_fee' => implode('|', $agency_fee),
            'agency_fee2' => $post['agency_fee2'],
			'subtotal_price' => extractNumbers($post['subtotalPrice']),
			'order_price' => extractNumbers($post['orderPrice']),
			'use_point' => 0, // 현재 포인트기능 없음
			'discount_price' => extractNumbers($post['discountPrice']),
			'total_price' => extractNumbers($post['totalPrice']),
			'prod_name' => implode('|', $itemName),
			'tracking_no' => '',
			'courier' => '',
			'ord_name' => $post['ordName'], // 주문자 정보
			'ord_zcode' => $post['ordZcode'],
			'ord_addr' => $post['ordAddr'],
			'ord_addr_detail' => $post['ordAddrDetail'],
			'ord_tel' => $post['ordTel'],
			'rec_name' => $post['recName'],
			'rec_zcode' => $post['recZcode'],
			'rec_addr' => $post['recAddr'],
			'rec_addr_detail' => $post['recAddrDetail'],
			'rec_tel' => $post['recTel'],
			'rec_memo' => $post['recMemo'],
			'pay_method' => $post['payMethod'],
			'cash_issue_type' => $post['cashIssueType'],
			'invoice_biz_num' => ($isCashPayment && $post['cashIssueType'] == "1") ? $post['invoiceBizNum'] : '', // 계산서 체크
			'invoice_email' => ($isCashPayment && $post['cashIssueType'] == "1") ? $post['invoiceEmail'] : '',
			'invoice_rep_name' => ($isCashPayment && $post['cashIssueType'] == "1") ? $post['invoiceRepName'] : '',
			'cash_receipt_type' => ($isCashPayment && $post['cashIssueType'] == "2") ? $post['cashReceiptType'] : '', // 현금영수증 체크
			'cash_receipt_auth_num' => ($isCashPayment && $post['cashIssueType'] == "2") ? $post['cashReceiptAuthNum'] : '',
			'ord_date' => '',
			'ord_fin_date' => '',
		];

		// 장바구니 인덱스
		$cartIdxData = $post['cartIdx'];

		// 3. 주문서/주문상세/결제 DB 등록
		$this->load->model('OrderModel');
		$resultData['result'] = $this->OrderModel->registerOrder($orderData, $orderDetailData, $cartIdxData);
		$resultData['orderNo'] = $orderNo;      // 주문번호
		$resultData['payMethod'] = $payMethod;  // 결제수단(+포인트결제)

		// $resultData['주문서 정보'] = $orderData;
		// $resultData['post'] = $post;

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}


}
