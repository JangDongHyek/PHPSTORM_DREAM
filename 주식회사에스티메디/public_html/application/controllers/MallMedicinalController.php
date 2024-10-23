<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 쇼핑몰 한방약재
 * @property ProductModel $ProductModel
 * @property BoardModel $BoardModel
 * @property BoardCommentModel $BoardCommentModel
 */
class MallMedicinalController extends CI_Controller {
	// 상품 목록
	public function medicinalList()
	{
        if (!loginCheck()) return;
        $get = $this->input->get();

		if (!empty($get['hstx'])) { // 쇼핑몰 헤더,사이드에서 검색
			$get['sfl'] = 'PRODUCT_NM';
			$get['stx'] = $get['hstx'];
		}


        $param = array(
            'page' => $get['page'] ?? 1,
            'initial' => $get['initial'],
            'order' => $get['order'],
			'sfl' => $get['sfl'],
			'stx' => $get['stx'],
            'member' => 'user',
            'PRODUCT_STANDARD' => 'N',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList($param);

        $member = $this->session->userdata('member');

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $data = [
            'pid' => 'product_list',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'member' => $member,
        ];

		render('mall/medicinal_list', $data);
	}
	public function medicinalList2()
	{
        //if (!loginCheck()) return;
        $get = $this->input->get();

		if (!empty($get['hstx'])) { // 쇼핑몰 헤더,사이드에서 검색
			$get['sfl'] = 'PRODUCT_NM';
			$get['stx'] = $get['hstx'];
		}


        $param = array(
            'page' => $get['page'] ?? 1,
            'initial' => $get['initial'],
            'order' => $get['order'],
			'sfl' => $get['sfl'],
			'stx' => $get['stx'],
            'member' => 'user',
            'PRODUCT_STANDARD' => 'N',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList($param);

        $member = $this->session->userdata('member');

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $data = [
            'pid' => 'medicinal_list',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'member' => $member,
        ];

		render('mall/@medicinal_list', $data);
	}

	public function medicinalSearch()
	{
       // if (!loginCheck()) return;
        $get = $this->input->get();

		if (!empty($get['hstx'])) { // 쇼핑몰 헤더,사이드에서 검색
			$get['sfl'] = 'PRODUCT_NM';
			$get['stx'] = $get['hstx'];
		}


        $param = array(
            'page' => $get['page'] ?? 1,
            'initial' => $get['initial'],
            'order' => $get['order'],
			'sfl' => $get['sfl'],
			'stx' => $get['stx'],
            'member' => 'user',
            'PRODUCT_STANDARD' => 'N',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList($param);

        $member = $this->session->userdata('member');

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $data = [
            'pid' => 'medicinal_search',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'member' => $member,
        ];

		render('mall/medicinal_search', $data);
	}

    // 동일성분 상품 목록
    public function medicinalList_cons()
    {
        //if (!loginCheck()) return;
        $get = $this->input->get();

        if (!empty($get['cons_hstx'])) { // 쇼핑몰 헤더,사이드에서 검색
            $get['sfl'] = 'PRODUCT_NM';
            $get['stx'] = $get['cons_hstx'];
        }

        $param = array(
            'page' => $get['page'] ?? 1,
            'initial' => $get['initial'],
            'order' => $get['order'],
            'sfl' => $get['sfl'],
            'stx' => $get['stx'],
            'CONS_CD' => $get['CONS_CD'],
            'member' => 'user',
            'PRODUCT_STANDARD' => 'N',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList_cons($param);

        $member = $this->session->userdata('member');

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $data = [
            'pid' => 'product_list',
            'listData2' => $resultData['listData'],
            'paging2' => $resultData['paging'],
            'CONS_CD' => $get['CONS_CD'],
            'PRODUCT_NM' => $get['PRODUCT_NM'],
            'prod_price' => $get['prod_price'],
            'cons_hstx' => $get['cons_hstx'],
            'totalCount' => $resultData['totalCount'],
            'member' => $member,
        ];

        render('mall/medicinal_list_cons', $data);
    }

    // 동일성분 상품 목록
    public function medicinalList_recent()
    {
        //if (!loginCheck()) return;
        $get = $this->input->get();

        if (!empty($get['recent_hstx'])) { // 쇼핑몰 헤더,사이드에서 검색
            $get['sfl'] = 'item';
            $get['stx'] = $get['recent_hstx'];
        }

        $param = array(
            'page' => $get['page'] ?? 1,
            'initial' => $get['initial'],
            'order' => $get['order'],
            'sfl' => $get['sfl'],
            'stx' => $get['stx'],
            'edt' => $get['edt'],
            'sdt' => $get['sdt'],
            'recent_hstx' => $get['recent_hstx'],
            'member' => 'user',
            'PRODUCT_STANDARD' => 'N',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList_recent($param);

        $member = $this->session->userdata('member');

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $data = [
            'pid' => 'product_list',
            'listData3' => $resultData['listData'],
            'paging3' => $resultData['paging'],
            'CONS_CD' => $get['CONS_CD'],
            'PRODUCT_NM' => $get['PRODUCT_NM'],
            'prod_price' => $get['prod_price'],
            'recent_hstx' => $get['recent_hstx'],
            'totalCount' => $resultData['totalCount'],
            'edt' => $get['edt'],
            'sdt' => $get['sdt'],
            'member' => $member,
        ];

        render('mall/medicinal_list_recent', $data);
    }

    // 상품 상세
    public function medicinalView($idx = 0)
    {
        if (!loginCheck()) return;

        $this->load->model("ProductModel");
        $productData = $this->ProductModel->getProductById($idx);

        if (empty($productData['idx'])) {
            $data = [
                'message' => '존재하지 않는 정보입니다.',
                'historyBack' => true,
            ];
            $this->load->view('errors/alert_and_redirect', $data);
            return;
        }

        // 상품사진
        if (!empty($productData['file_name_list'])) {
            $exp = explode(',', $productData['file_name_list']);
            foreach ($exp AS $fileName) {
                $filePath = UPLOAD_FOLDERS['PRODUCT'] . $fileName;
                if (file_exists($filePath)) {
                    $imageFiles[] = [
                        'filename' => $fileName,
                        'source' => 'assets/' . uploadFileRemoveServerPath($filePath),
                    ];
                }
            }
        }

        // 상품후기/상품문의 글 개수
        $this->load->model('BoardModel');
        $reviewCnt = $this->BoardModel->getBoardCount('review', $idx);
        $qnaCnt = $this->BoardModel->getBoardCount('p_qna', $idx);

        $data = [
            'pid' => 'product_view',
            'productData' => $productData,
            'imageFiles' => $imageFiles,
            'reviewCnt' => $reviewCnt,
            'qnaCnt' => $qnaCnt,
        ];

        render('mall/medicinal_view', $data);
    }

    // 상품 조회 (1개)
    public function getProductInfo($idx = 0)
    {
        //if (!loginCheck()) return;

        $this->load->model("ProductModel");
        $productData = $this->ProductModel->getProductById($idx);

        if (empty($productData['idx'])) {
            $data = [
                'message' => '존재하지 않는 정보입니다.',
                'historyBack' => true,
            ];
            $this->load->view('errors/alert_and_redirect', $data);
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($productData));
    }

    // 상품 조회 (1개)
    public function getProductInfoPRODUCT_CD($idx = 0)
    {
        //if (!loginCheck()) return;

        $this->load->model("ProductModel");
        $productData = $this->ProductModel->getProductByPRODUCT_CD($idx);

        if (empty($productData['idx'])) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($productData));
        }else{

            $data = [
                'message' => '이미 존재하는 정보입니다.',
                'historyBack' => true,
            ];

            $this->load->view('errors/alert_and_redirect', $data);
            return;
        }
    }

    // 상품 조회 제품코드로
    public function getProductInfoAPIPRODUCT_CD($PRODUCT_CD = 0)
    {
        if(!$PRODUCT_CD){
            $post = json_decode($this->input->raw_input_stream, true);
            $PRODUCT_CD = $post['PRODUCT_CD'];
        }

        $this->load->model("ProductModel");
        $productData = $this->ProductModel->getProductByPRODUCT_CD($PRODUCT_CD);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($productData));

        if (empty($productData['idx'])) {

            $productData2 = [
                'message' => '존재하지 않는 정보입니다.',
                'PRODUCT_NM' => '존재하지 않는 정보입니다.',
                'historyBack' => true,
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($productData2));

        }else{
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($productData));
        }
    }

    // 상품 상품후기/상품문의 목록
    public function getProductBoardList()
    {
        if (!loginCheck()) return;
        $get = $this->input->get();

        $param = array(
            'page' => $get['page'] ?? 1,
            'cate' => $get['category'],
            'productIdx' => $get['productIdx'],
        );
        $this->load->model('BoardModel');
        $resultData = $this->BoardModel->getBoardList($param, true);

        // 상품후기/상품문의 글 개수
        $this->load->model('BoardModel');
        $reviewCnt = $this->BoardModel->getBoardCount('review', $get['productIdx']);
        $qnaCnt = $this->BoardModel->getBoardCount('p_qna', $get['productIdx']);

        $data = [
            'category' => $get['category'],
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
            'reviewCnt' => $reviewCnt,
            'qnaCnt' => $qnaCnt,
        ];

        $this->load->view('modal/product_board_data', $data);
    }

    // 상품후기/상품문의 상세
    public function getProductBoardInfo($category = 'review', $idx = 0)
    {
        if (!loginCheck()) return;

        $this->load->model('BoardModel');
        $boardData['data'] = $this->BoardModel->getBoardInfoByIdx($idx, $category);

        // 코멘트
        $this->load->model('BoardCommentModel');
        $boardData['commentData'] = $this->BoardCommentModel->getCommentList($idx);

        if (empty($boardData['data']['idx'])) {
            $data = [
                'message' => '존재하지 않는 정보입니다.',
                'historyBack' => true,
            ];
            $this->load->view('errors/alert_and_redirect', $data);
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($boardData));
    }

    // api Use토큰 가져오기
    public function postUpdateApiUseToken()
    {
        $resultData = ['result' => false];

        $this->load->model("ConfigModel");
        $configData = $this->ConfigModel->getSystemConfig(); // 토큰정보

        //1.엑세스토큰받기 ACCESS_TOKEN 얻기
        $url = "https://openapi.ssart.co.kr/api/v1/oAuth/utk/";
        $ready_array = array(
            'ACCESS_TOKEN' => $configData['cf_access_token']
        );

        $ready_data = json_encode($ready_array);
        $header_data = array(
            'Content-Type: application/json; charset=utf-8'
        );

        $urlResponse = APICurlFnc($url, $header_data, $ready_data);
        $feeData = [
            'use_token' =>  $urlResponse['USE_TOKEN']
        ];

        $resultData['result'] = $this->ConfigModel->updateApiUseToken($feeData);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // API 주문보내기
    public function postApiOrder($idx = 0)
    {
        if(!$idx){
            $post = json_decode($this->input->raw_input_stream, true);
            $idx = $post['idx'];
        }

        $this->postUpdateApiUseToken();

        // 주문공통 정보
        $this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
        $orderCommon = $this->orderlibrary->getOrderCommonData($idx);

        // 회원정보조회
        $this->load->model('MemberModel');
        $orderData = $orderCommon['orderData']; 			// 주문서
        $orderItemData = $orderCommon['orderItemData'];		// 주문서 상세
        $payData = $orderCommon['payData']; 				// PG 결제

        if($orderData['UPDATE_KEY']){
            $data = [
                'message' => 'error : 이미 주문확인이 완료된 건입니다.',
                'historyBack' => true,
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

            log_message('error', "api RE.주문보내기 중복 UPDATE_KEY:".$orderData['UPDATE_KEY']);
            //return;
        }

        $member = $this->MemberModel->getMemberById($orderData['mb_id']);

        if (empty($orderData['idx'])) {
            $data = [
                'message' => 'error : 해당 상품정보 오류',
                'historyBack' => true,
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

            log_message('error', "api RE.주문보내기 상품없음 UPDATE_KEY:".$orderData['UPDATE_KEY']);
            return;
        }

        if(empty($member['CUSTOMER_CODE'])){
            $data = [
                'message' => 'error : 거래처번호 오류',
                'historyBack' => true,
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

            log_message('error', "api RE.주문보내기 CUSTOMER_CODE 없음");
            return;
        }

        $api_data = [];
        $api_cnt = 0;
        $api_cnt2 = 1; //1번부터 순서매겨달라함
        foreach ($orderItemData as $item_row){

            $price = 0;
            $api_data[$api_cnt]['ORDER_DATE'] = str_replace('-', '', substr($orderData['reg_date'], 0, 10));
            $api_data[$api_cnt]['ORDER_NO'] = $orderData['ord_no'];
            $api_data[$api_cnt]['ORDER_DETAIL_NO'] = $api_cnt2;
            $api_data[$api_cnt]['ORDER_ID'] = $orderData['ord_no'].'_'.$item_row['idx'];
            $api_data[$api_cnt]['CUSTOMER_SIMS_CODE'] = $member['CUSTOMER_CODE'];
            $api_data[$api_cnt]['CUSTOMER_CODE'] = $member['CUSTOMER_CODE'];
            $api_data[$api_cnt]['PRODUCT_SIMS_CODE'] = $item_row['PRODUCT_CD'];
            $api_data[$api_cnt]['PRODUCT_CODE'] = $item_row['PRODUCT_CD'];
            $api_data[$api_cnt]['ORDER_QUANTITY'] = $item_row['item_cnt'];
            $api_data[$api_cnt]['PRODUCT_PRICE'] = round($item_row['item_price']);
            $price = (int)$item_row['item_cnt'] * $item_row['item_price'];
            $api_data[$api_cnt]['SUPPLY_PRICE'] = round($price / 1.1);
            $api_data[$api_cnt]['TAX_PRICE'] = $price - $api_data[$api_cnt]['SUPPLY_PRICE'];
            $api_cnt++;
            $api_cnt2++;

            /*
            └ ORDER_DATE STRING(8) Y 주문일자 20240315
            └ ORDER_NO STRING(50) Y 주문번호 3
            └ ORDER_DETAIL_NO STRING(10) Y 주문상세번호(순번) 1
            └ ORDER_ID STRING(100) Y 주문고유번호 ORD20240315-003
            └ CUSTOMER_SIMS_CODE STRING(5) Y 거래처코드(SIMS코드) 50123
            └ CUSTOMER_CODE STRING(50) N 거래처코드
            └ PRODUCT_SIMS_CODE STRING(5) Y 제품코드(SIMS코드) 10022
            └ PRODUCT_CODE STRING(300) N 제품코드
            └ ORDER_QUANTITY STRING(18) Y 주문수량 10
            └ PRODUCT_PRICE STRING(18) Y 주문단가(부가세포함) 33000
            └ SUPPLY_PRCIE STRING(18) Y 공급가액 300000
            └ TAX_PRICE STRING(18) Y 부가세액 30000
            └ REMARK STRING(1000) N 비고
            */

        }

        $resultData = ['result' => false];

        $this->load->model("ConfigModel");
        $configData = $this->ConfigModel->getSystemConfig(); // 토큰정보

        //주문 정보 연동
        $url = "https://openapi.ssart.co.kr/api/v1/order/put/";
        $ready_array = array(
            'USE_TOKEN' => $configData['cf_use_token'],
            'DATA' => $api_data
        );

        $ready_data = json_encode($ready_array);
        $header_data = array(
            'Content-Type: application/json; charset=utf-8'
        );

        $urlResponse = APICurlFnc($url, $header_data, $ready_data);

        if($urlResponse['ERRCODE'] == 'E0000'){
            //성공
            log_message('info', "api 3.주문보내기 업데이트정보 - " . print_r($urlResponse,true));

            $encode_data = json_encode($urlResponse['DATA'],JSON_UNESCAPED_UNICODE);
            $orderData['DATA'] = $encode_data;
            $orderData['UPDATE_KEY'] = $urlResponse['UPDATE_KEY'];

            $this->load->model('OrderModel');
            $resultData['UPDATE'] = $this->OrderModel->updateApiOrder($orderData);

        }else if($urlResponse['ERRCODE'] == 'E0002'){
            //USE토큰 에러
            $this->postUpdateApiUseToken();
            log_message('error', "api RE.주문보내기 USE토큰업데이트 - " . print_r($urlResponse,true));
        }else{
            log_message('error', "api 3.주문보내기 ERRCODE - " . $urlResponse['ERRCODE'] . "  ready_array :" . print_r($ready_array,true));
        }

        $resultData['result'] = $urlResponse;
        $resultData['ERRCODE'] = $urlResponse['ERRCODE'];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
        /*
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($orderCommon));*/
    }

    // API 주문가져오기
    public function postApiOrderCheck($UPDATE_KEY = 0)
    {
        if(!$UPDATE_KEY){
            $post = json_decode($this->input->raw_input_stream, true);
            $UPDATE_KEY = $post['UPDATE_KEY'];
        }

        $this->postUpdateApiUseToken();

        $resultData = ['result' => false];

        $this->load->model("ConfigModel");
        $configData = $this->ConfigModel->getSystemConfig(); // 토큰정보

        //주문 정보 확인 연동
        $url = "https://openapi.ssart.co.kr/api/v1/order/get/";
        $ready_array = array(
            'USE_TOKEN' => $configData['cf_use_token'],
            'UPDATE_KEY' => $UPDATE_KEY
        );

        $ready_data = json_encode($ready_array);
        $header_data = array(
            'Content-Type: application/json; charset=utf-8'
        );

        $urlResponse = APICurlFnc($url, $header_data, $ready_data);

        if($urlResponse['ERRCODE'] == 'E0000'){
            //성공
            log_message('info', "api 주문확인 정보 - " . print_r($urlResponse,true));
        }else if($urlResponse['ERRCODE'] == 'E0002'){
            //USE토큰 에러
            $this->postUpdateApiUseToken();
            log_message('error', "api RE.주문보내기 USE토큰업데이트 - " . print_r($urlResponse,true));
        }else{
            log_message('error', "api 3.주문보내기 ERRCODE - " . $urlResponse['ERRCODE']);
        }

        $resultData['result'] = $urlResponse;
        $resultData['ERRCODE'] = $urlResponse['ERRCODE'];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
        /*
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($orderCommon));*/
    }
}
