<?php
/**
 * 관리자 상품관리
 * @property ProductModel $ProductModel
 * @property ConfigModel $ConfigModel
 */

include_once APPPATH.'libraries/Jl.php';
include_once APPPATH.'libraries/JlModel.php';


class AdmProductController extends CI_Controller
{

    public $jl;

    public function __construct()
    {
        parent::__construct();

        try {
            $this->jl = new Jl();
        }catch(Exception $e) {}
    }

	// 상품 목록
	public function admProduct()
	{
		if (!loginCheck(true)) return;

		$param = array(
			'page' => $_GET['page'] ?? 1,
			'sfl' => $_GET['sfl'] ?? '',
			'stx' => $_GET['stx'] ?? '',
			'cate' => $_GET['cate'] ?? '',
			'isUse' => $_GET['isUse'] ?? '',
			'del_yn' => $_GET['del_yn'] ?? '',
			'isShipFree' => $_GET['isShipFree'] ?? '',
			'soldOut' => $_GET['soldOut'] ?? '',
			'mdRec' => $_GET['mdRec'] ?? '',
			'order' => $_GET['order'] ?? '',
			'PRODUCT_CD' => $_GET['PRODUCT_CD'] ?? '',
            'member' => 'admin',
		);

		$this->load->model("ProductModel");
		$resultData = $this->ProductModel->getProductList($param);

		$this->load->model("ConfigModel");
		$configData = $this->ConfigModel->getSystemConfig(); // 기본배송비정보

        $memberId = $this->session->userdata('member')['mb_id'];

		$data = [
			'pid' => 'adm_product',
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
			'configData' => $configData,
            'memberId' => $memberId,
		];

		render('adm/product', $data, true);
	}

    // 상품 목록
    public function admProductKeyword()
    {
        if (!loginCheck(true)) return;

        $param = array(
            'page' => $_GET['page'] ?? 1,
            'sfl' => $_GET['sfl'] ?? '',
            'stx' => $_GET['stx'] ?? '',
            'cate' => $_GET['cate'] ?? '',
            'isUse' => $_GET['isUse'] ?? '',
            'del_yn' => $_GET['del_yn'] ?? '',
            'isShipFree' => $_GET['isShipFree'] ?? '',
            'soldOut' => $_GET['soldOut'] ?? '',
            'mdRec' => $_GET['mdRec'] ?? '',
            'order' => $_GET['order'] ?? '',
            'PRODUCT_CD' => $_GET['PRODUCT_CD'] ?? '',
            'DISTINCT' => 'DISTINCT',
            'member' => 'admin',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductKeywordList($param);

        $this->load->model("ConfigModel");
        $configData = $this->ConfigModel->getSystemConfig(); // 기본배송비정보

        $memberId = $this->session->userdata('member')['mb_id'];

        $data = [
            'pid' => 'adm_product',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'configData' => $configData,
            'memberId' => $memberId,
        ];

        render('adm/product_keyword', $data, true);
    }


    // 상품 등록/수정 폼
    public function admProductForm($idx = 0)
    {
		if (!loginCheck(true)) return;

		$imageFiles = array();
		$productData = array();
		$isModify = false;
		if(!empty($idx)) { // 수정
			$isModify = true;

			$this->load->model('ProductModel');
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
		}




		$data = [
			'pid' => 'adm_product_form',
			'productData' => $productData,
			'imageFiles' => $imageFiles,
			'isModify' => $isModify,
            "jl" => $this->jl

		];

		render('adm/product_form', $data, true);
    }

	// 상품 등록/수정 처리
	public function postRegisterProduct()
	{
		$resultData = ['result' => false, 'message' => ''];
		// $resultData['post'] = $_POST;

		$itemName = mb_substr(trim($_POST['PRODUCT_NM']), 0, 100);
		$contentCheck = strip_tags($_POST['content'], '<img>');
		$content = ($contentCheck == '')? '' : $_POST['content'];



        //기존이랑 같으면 납두고 다르면 중복체크
        if($_POST['PRODUCT_CD_reg'] == $_POST['PRODUCT_CD']){
            $productData_PRODUCT_CD = false;
        }else{
            $this->load->model("ProductModel");
            $productData_PRODUCT_CD = $this->ProductModel->getProductByPRODUCT_CD(trim($_POST['PRODUCT_CD']));
        }


       // log_message('error', 'errorororo'.$_POST);
        if($productData_PRODUCT_CD){
            $resultData['msg'] = '이미 등록된 제품코드입니다.';
        }else{
            $productData = array(
                'use_yn' => ($_POST['useYn']=='Y')? 'Y' : 'N',
                'category' => $_POST['category'],
                'first_consonant' => getFirstConsonant(mb_substr($itemName, 0, 1, "UTF-8")),
                'keyword' => trim($_POST['keyword']), //검색키워드
                'prod_order' => extractNumbers($_POST['prodOrder']),
                'prod_name' => $itemName,
                'PRODUCT_NM' => $itemName, //상품명 이거씀 wc
                'UNIT_PRICE' => trim($_POST['UNIT_PRICE']), //단가
                'INSU_PRICE' => trim($_POST['INSU_PRICE']), //보험가
                'PRODUCT_CD' => trim($_POST['PRODUCT_CD']), //제품코드
                'CONS_CD' => trim($_POST['CONS_CD']), //성분코드
                'CONS_CD_SEQ' => trim($_POST['CONS_CD_SEQ']), //성분코드SEQ
                'CONS' => trim($_POST['CONS']), //성분분류코드
                'CONS_NM' => trim($_POST['CONS_NM']), //성분분류명
                'CONS_CD_NM' => trim($_POST['CONS_CD_NM']), //성분명
                'MAKER_NM' => trim($_POST['MAKER_NM']), //제조사명
                'INSU_CD' => trim($_POST['INSU_CD']), //보험코드
                'STANDARD_CD' => trim($_POST['STANDARD_CD']), //표준코드
                'PRODUCT_STANDARD' => trim($_POST['PRODUCT_STANDARD']), //규격
                'PRODUCT_UNIT' => trim($_POST['PRODUCT_UNIT']), //단위
                'STOCK_QTY' => trim($_POST['STOCK_QTY']), //재고수량
                'ACC_UNIT' => trim($_POST['ACC_UNIT']), //계산단위

                'prod_price' => extractNumbers($_POST['prodPrice']),
                'prod_origin' => mb_substr(trim($_POST['prodOrigin']), 0, 100),
                'package_method' => mb_substr(trim($_POST['packageMethod']), 0, 100),
                'prod_format' => mb_substr(trim($_POST['prodFormat']), 0, 100),
                'shipping_info' => mb_substr(trim($_POST['shippingInfo']), 0, 100),
                'shipping_free_yn' => $_POST['shippingFreeYn'],
                'pay_method_list' => (empty($_POST['payMethod']))? '' : implode(",", $_POST['payMethod']),
                'content' => $content,
                'file_name_list' => (empty($_POST['prodImage']))? '' : implode(",", $_POST['prodImage']),
                'soldout_yn' => ($_POST['soldoutYn']=='Y')? 'Y' : 'N',
                'md_rec_yn' => ($_POST['mdRecYn']=='Y')? 'Y' : 'N',
                'del_yn' => ($_POST['del_yn']=='Y')? 'Y' : 'N',
                'idx' => (int)$_POST['idx'],
            );
            // $resultData['상품등록'] = $productData;

            $this->load->model('ProductModel');

            // 상품 DB 등록/수정
            $resultData['result'] = $this->ProductModel->registerProduct($productData);
            $resultData['idx'] = (int)$_POST['idx'];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));

	}


	// 상품 목록 일괄수정
	public function postUpdateProductList()
	{
		$resultData = ['result' => false];
		$post = json_decode($this->input->raw_input_stream, true);
		// $resultData['post'] = $post;

		$this->load->model('ProductModel');
		$resultData['result'] = $this->ProductModel->updateProductListData($post['listData']);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 상품 목록 기본배송비 설정
	public function postUpdateDeliveryFee()
	{
		$resultData = ['result' => false];
		$post = json_decode($this->input->raw_input_stream, true);
		// $resultData['post'] = $post;

		$feeData = [
			'deliveryFee' => extractNumbers($post['deliveryFee']),
			'freeShipOverAmt' => extractNumbers($post['freeShipOverAmt']),
		];

		$this->load->model("ConfigModel");
		$resultData['result'] = $this->ConfigModel->updateDeliveryFee($feeData);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 상품 삭제
	public function postDeleteProduct()
	{
		$resultData = ['result' => false];
		$post = json_decode($this->input->raw_input_stream, true);
		// $resultData['post'] = $post;

		$this->load->model('ProductModel');
		$resultData['result'] = $this->ProductModel->deleteProduct($post['idx']);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

    // 상품 가져오기
    public function getProductInfo()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);
        // $resultData['post'] = $post;

        $this->load->model('ProductModel');
        $resultData['result'] = $this->ProductModel->getProductById($post['idx']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }


    // api access토큰 가져오기
    public function postUpdateApiAccessToken()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);
        // $resultData['post'] = $post;

        //1.엑세스토큰받기 ACCESS_TOKEN 얻기
        $url = "https://openapi.ssart.co.kr/api/v1/oAuth/";
        $uid = $post['apiId'];
        //$uid = 'stmedi';
        $pwd = $post['apiPass'];
        //$pwd = '6318702972';
        $ready_array = array(
            'uid' => $uid
            ,'pwd' => $pwd
        );
        $ready_data = json_encode($ready_array);
        $header_data = array(
            'Content-Type: application/json; charset=utf-8'
        );
        $urlResponse = APICurlFnc($url, $header_data, $ready_data);
        log_message('info', "api ACCESS_TOKE토큰 업데이트정보 - " . print_r($urlResponse,true));

        $feeData = [
            'access_token' => $urlResponse['ACCESS_TOKEN']
        ];

        $this->load->model("ConfigModel");
        $resultData['result'] = $this->ConfigModel->updateApiAccessToken($feeData);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
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

    // api 상품목록 가져오기
    public function postGetApiProductList()
    {
        $resultData = ['result' => false];

        $this->load->model("ConfigModel");
        $configData = $this->ConfigModel->getSystemConfig(); // 토큰정보

        //4.거래상품정보
        $url = "https://openapi.ssart.co.kr/api/v1/product/get/";
        $ready_array = array(
            'USE_TOKEN' => $configData['cf_use_token']
        );

        $ready_data = json_encode($ready_array);
        $header_data = array(
            'Content-Type: application/json; charset=utf-8'
        );

        $urlResponse = APICurlFnc($url, $header_data, $ready_data);
        
        if($urlResponse['ERRCODE'] == 'E0000'){
            //성공
            log_message('info', "api 4.거래상품정보 업데이트정보 - " . print_r($urlResponse,true));
        }else if($urlResponse['ERRCODE'] == 'E0002'){
            //USE토큰 에러
            $this->postUpdateApiUseToken();
            log_message('error', "api RE.거래상품정보 USE토큰업데이트 - " . print_r($urlResponse,true));
        }else{
            log_message('error', "api 4.거래상품정보 ERRCODE - " . $urlResponse['ERRCODE']);
        }

        $this->load->model('ProductModel');
        $resultData['result'] = $this->ProductModel->getApiProductListData($urlResponse['DATA']);
        $resultData['ERRCODE'] = $urlResponse['ERRCODE'];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }



    // 상품 등록/수정 처리
    public function postPRODUCT_CD()
    {
        $post = json_decode($this->input->raw_input_stream, true);
        $PRODUCT_CD = $post['PRODUCT_CD'];
        $resultData = ['result' => false, 'msg' => ''];

        $this->load->model("ProductModel");
        $productData_PRODUCT_CD = $this->ProductModel->getProductByPRODUCT_CD(trim($PRODUCT_CD));

        // log_message('error', 'errorororo'.$_POST);
        if ($productData_PRODUCT_CD) {
            $resultData['msg'] = '이미 등록된 제품코드입니다.';
            $resultData['result'] = true;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));

    }

    // 에이전시 수수료 설정
    public function setAgencyFee()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);

        $listData = $post['listData'];

        $this->load->model('ProductModel');
        $resultData['result'] = $this->ProductModel->setAgencyFeeData($listData);
        $resultData['result2'] = $this->ProductModel->setAgencyFeeMinMax($listData[0]['product_idx']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 에이전시 수수료 설정
    public function getAgencyFee()
    {

        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);
        // $resultData['post'] = $post;

        $this->load->model('ProductModel');
        $resultData['result'] = $this->ProductModel->getAgencyFeeData($post['idx']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }





}
