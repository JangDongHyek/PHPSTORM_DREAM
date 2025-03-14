<?php
/**
 * 관리자 상품관리
 * @property ProductModel $ProductModel
 * @property ConfigModel $ConfigModel
 */
class AdmProductController extends CI_Controller
{
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
			'isShipFree' => $_GET['isShipFree'] ?? '',
			'soldOut' => $_GET['soldOut'] ?? '',
			'mdRec' => $_GET['mdRec'] ?? '',
			'order' => $_GET['order'] ?? '',
		);

		$this->load->model("ProductModel");
		$resultData = $this->ProductModel->getProductList($param);

		$this->load->model("ConfigModel");
		$configData = $this->ConfigModel->getSystemConfig(); // 기본배송비정보

		$data = [
			'pid' => 'adm_product',
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
			'configData' => $configData,
		];

		render('adm/product', $data, true);
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
		];

		render('adm/product_form', $data, true);
    }

	// 상품 등록/수정 처리
	public function postRegisterProduct()
	{
		$resultData = ['result' => false, 'message' => ''];
		// $resultData['post'] = $_POST;

		$itemName = mb_substr(trim($_POST['prodName']), 0, 100);
		$contentCheck = strip_tags($_POST['content'], '<img>');
		$content = ($contentCheck == '')? '' : $_POST['content'];

		$productData = array(
			'use_yn' => ($_POST['useYn']=='Y')? 'Y' : 'N',
			'category' => $_POST['category'],
			'first_consonant' => getFirstConsonant(mb_substr($itemName, 0, 1, "UTF-8")),
			'prod_order' => extractNumbers($_POST['prodOrder']),
			'prod_name' => $itemName,
			'prod_price' => extractNumbers($_POST['prodPrice']),
            'prod_price2' => extractNumbers($_POST['prodPrice2']),
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
			'idx' => (int)$_POST['idx'],
		);
		// $resultData['상품등록'] = $productData;

		$this->load->model('ProductModel');

		// 상품 DB 등록/수정
		$resultData['result'] = $this->ProductModel->registerProduct($productData);

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

}
