<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 메인
 * @property ProductModel $ProductModel
 * @property PopupModel $PopupModel
 */
class MallMainController extends CI_Controller
{
	// 메인
	public function index()
	{
		$this->load->model("ProductModel");
		$mdData = $this->ProductModel->getProductList(array('mdRec'=>'Y'));

        // 팝업
        $member = $this->session->userdata('member');
        $position = !$member ? "0" : "1";
        $this->load->model("PopupModel");
        $popupList = $this->PopupModel->getTodayPopup($position);

        $param = array(
            'page' => $get['page'] ?? 1,
            'cate' => 'review',
        );

        $this->load->model('BoardModel');
        $resultData = $this->BoardModel->getBoardList($param);

		$data = [
			'pid' => 'index',
			'mdData' => $mdData['listData'], // MD추천
            'popupList' => $popupList, // 팝업
            'listData' => $resultData['listData'],
		];

		render('mall/index', $data);
	}
}
