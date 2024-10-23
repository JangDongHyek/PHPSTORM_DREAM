<?php
/**
 * 관리자 주문배송관리
 * @property OrderModel $OrderModel
 * @property MemberGroupModel $MemberGroupModel
 */
class AdmOrderController extends CI_Controller
{
    // 주문배송관리
    public function admOrder()
    {
        $resultData = $this->getOrderList(); // 주문 목록

        $this->load->model('MemberGroupModel');
        $groupList = $this->MemberGroupModel->fetchGroupKeyNames(); // 그룹 목록

        $data = [
            'pid' => 'adm_order', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'groupList' => $groupList,
        ];

        render('adm/order', $data, true);
    }

    // 목록
    public function getOrderList(): array
    {
        $get = $this->input->get();

        // 검색
        $param = getOrderListParam($get);
        $isExcel = !empty($get['excel']);

        // // 주문접수 1주일 경과하면 `배송완료` 변경 (주문취소 제외)
        // $curHour = (int)date('H');
        // $curMin = (int)date('i');
        // if ($curHour >= 7 && $curHour <= 17 && $curMin <= 10) {
        //     $config = (new ConfigModel())->getSystemConfig("cf_order_fin_last_date AS lastDate");
        //     // 마지막 변경일자를 조회하여 오늘보다 이전이면 `배송완료`로 변경
        //     if ($config['lastDate'] < date('Y-m-d')) {
        //         $orderModel->updateOrderFinish();
        //     }
        // }

        $this->load->model('OrderModel');
        return $this->OrderModel->getOrderList($param, $isExcel, true);
    }

	// 주문배송관리 상세
	public function admOrderView($idx = 0)
	{
		if (!loginCheck(true)) return;

		// 주문공통 정보
		$this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
		$orderCommon = $this->orderlibrary->getOrderCommonData($idx);

		$orderData = $orderCommon['orderData']; 			// 주문서
		$orderItemData = $orderCommon['orderItemData'];		// 주문서 상세
		$payData = $orderCommon['payData']; 				// PG 결제

		if (empty($orderData['idx']) || $orderData['tmp_save_yn'] == 'Y') {
			$data = [
				'message' => '존재하지 않는 정보입니다.',
				'historyBack' => true,
			];
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}

		$data = [
			'pid' => 'adm_order_view',
			'orderData' => $orderData,
			'orderItemData' => $orderItemData,
			'payData' => $payData,
		];

		render('adm/order_view', $data, true);
	}

    // (주문공통) 목록 일괄수정
    public function postUpdateOrderList()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);

        $listData = $post['listData'];
        foreach ($listData as $key => $data) {
            // 택배사 선택시 `배송중`으로 상태변경 (주문상태가 주문접수 or 작업중일때)
            if ($data['courier'] != "" && ($data['ordStatus'] == "R" || $data['ordStatus'] == "I")) {
                $listData[$key]['ordStatus'] = "DI";
            }
        }
        // $resultData['listData'] = $listData;

        $this->load->model('OrderModel');
        $resultData['result'] = $this->OrderModel->updateOrderListData($listData);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

	// 배송정보수정
	public function postUpdateOrderRecipient()
	{
		$post = $this->input->post();
		$resultData['post'] = $_POST;

		$orderData = array(
			'rec_name' => $post['recName'],
			'rec_zcode' => $post['recZcode'],
			'rec_addr' => $post['recAddr'],
			'rec_addr_detail' => $post['recAddrDetail'],
			'rec_tel' => $post['recTel'],
			'rec_memo' => $post['recMemo'],
			'idx' => (int)$post['idx'],
		);
		// $resultData['배송정보'] = $orderData;

		$this->load->model('OrderModel');
		$resultData['result'] = $this->OrderModel->updateOrderRecipient($orderData);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}
}
