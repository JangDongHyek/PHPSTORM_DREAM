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
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList($param);

        // 팝업
        $member = $this->session->userdata('member');

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($member['mb_id']);

        $recent_resultData['paging']['totalCount'] = 0;
        if($member){

            $param2 = array(
                'page' => 1,
                'sfl' => 'item',
                'member' => 'user',
            );

            $recent_resultData = $this->ProductModel->getProductList_recent($param2);
        }

        $position = !$member ? "0" : "1";
        $this->load->model("PopupModel");
        $popupList = $this->PopupModel->getTodayPopup($position);

        $data = [
            'pid' => 'index',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'popupList' => $popupList, // 팝업
            'member' => $member,
            'recent_totalCount' => $recent_resultData['paging']['totalCount']
        ];

        if ($recent_resultData['paging']['totalCount'] * 1 <= 0 && $member){
            ///* 구매이력 없는 회원만 */
            render('mall/index_no_purchase', $data);
        }else if ($recent_resultData['paging']['totalCount'] * 1 > 0 && $member){
            ///* 구매이력 있는 회원만 */
            render('mall/index_yes_purchase', $data);
        } else {
            render('mall/index_main', $data);
        }

	}
}
