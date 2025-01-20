<?php
/**
 * 쇼핑몰 장바구니
 * @property ProductCartModel $ProductCartModel
 * @property ConfigModel $ConfigModel
 */
class MallCartController extends CI_Controller
{
    // 장바구니
    public function cart()
    {
		if (!loginCheck()) return;

        $memberId = $this->session->userdata('member')['mb_id'];
        $this->load->model("ProductCartModel");
        $this->load->model("ConfigModel");

        $data = [
            'pid' => 'cart',
            'listData' => $this->ProductCartModel->getCartList(array(), $memberId),
            'configData' => $this->ConfigModel->getSystemConfig(), // 기본배송비 정보
        ];

        render('mall/cart', $data);
    }

    // 장바구니 등록
    public function postAddCart()
    {
        $resultData = ['result' => false, 'message' => ''];
        $post = $this->input->post();

        $cartData = [
            'add_cart_yn' => $post['isBuy'], // Y:장바구니, N:바로구매
            'memberId' => $this->session->userdata('member')['mb_id'],
            'product_idx' => $post['productIdx'],
            'product_cnt' => $post['productCnt'],
        ];

        // 장바구니 등록
        $this->load->model("ProductCartModel");

        // 1. 장바구니 등록여부 확인 (장바구니 등록시만 확인 (바로구매 x))
        $cartIdx = $cartData['add_cart_yn'] == 'Y' ? $this->ProductCartModel->getCartIdx($cartData['product_idx'], $cartData['memberId']) : array();

        // 2. 장바구니 등록/수정
        if(count($cartIdx) == 0) {
            // 2.1 등록
            $cartIdx = $this->ProductCartModel->registerCart($cartData);
            $resultData['result'] = count($cartIdx) > 0;
        }
        else {
            // 2.2 수정(수량+)
            $cartData['idx'] = $cartIdx;
            $cartData['product_cnt'] = $post['productCnt'];
            $resultData['result'] = $this->ProductCartModel->registerCart($cartData, true);
        }
        $resultData['cartIdx'] = $cartIdx;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 장바구니 수량 업데이트
    public function postUpdateCartOption()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);

        $this->load->model("ProductCartModel");
        $resultData['result'] = $this->ProductCartModel->updateCartOptionCount($post['cartIdx'], $post['changeCount']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 장바구니 삭제
    public function postDeleteCart()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);

        $memberId = $this->session->userdata('member')['mb_id'];
        $this->load->model("ProductCartModel");
        $resultData['result'] = $this->ProductCartModel->deleteCartItem($post['cartIdxArr'], 0, $post['isClear'], $memberId);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 추가배송비
    public function postSendCost2()
    {
        $resultData = ['result' => false, 'message' => ''];
        $post = $this->input->post();

        // 추가배송비 관련부분 wc
        $this->load->model("OrderModel");
        $delivery_fee2 = $this->OrderModel->getOrderSendCost2($post['recZcode']);

        if($delivery_fee2){
            $resultData['delivery_fee2'] = $delivery_fee2;
            $resultData['result'] = "추가배송비";
            $resultData['recZcode'] = $post['recZcode'];
        }else{
            $resultData['delivery_fee2'] = 0;
            $resultData['result'] = "";
            $resultData['recZcode'] = "";
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }
}
