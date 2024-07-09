<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 쇼핑몰 한방약재
 * @property ProductModel $ProductModel
 * @property BoardModel $BoardModel
 * @property BoardCommentModel $BoardCommentModel
 */
class MallMedicinalController extends CI_Controller {
	// 한방약재 목록
	public function medicinalList()
	{
        //if (!loginCheck()) return;
        $get = $this->input->get();

		if (!empty($get['hstx'])) { // 쇼핑몰 헤더,사이드에서 검색
			$get['sfl'] = 'title';
			$get['stx'] = $get['hstx'];
		}

        $param = array(
            'page' => $get['page'] ?? 1,
            'initial' => $get['initial'],
            'order' => $get['order'],
			'sfl' => $get['sfl'],
			'stx' => $get['stx'],
            'use_yn' => 'Y',
        );

        $this->load->model("ProductModel");
        $resultData = $this->ProductModel->getProductList($param);

        $data = [
            'pid' => 'product_list',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
        ];

		render('mall/medicinal_list', $data);
	}

    // 한방약재 상세
    public function medicinalView($idx = 0)
    {
        //if (!loginCheck()) return;

        $this->load->model("ProductModel");
        $productData = $this->ProductModel->getProductById($idx);
        $member = $this->session->userdata('member');

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
            'member' => $member,
        ];

        render('mall/medicinal_view', $data);
    }

    // 한방약재 조회 (1개)
    public function getProductInfo($idx = 0)
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

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($productData));
    }

    // 한방약재 상품후기/상품문의 목록
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

    // 한방약재 상품후기/상품문의 목록
    public function getProductBoardList2()
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

        redirect(PROJECT_URL . '/board/'.$get['productIdx'].'?cate='.$get['category']);
        //render('mall/board_view', $data);
        //$this->load->view('mall/board_view', $data);
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
}