<?php
include_once APPPATH.'libraries/Jl.php';
include_once APPPATH.'libraries/JlModel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class PublishController extends CI_Controller {

    public $jl;

    public function __construct()
    {
        parent::__construct();

        try {
            $this->jl = new Jl();
        }catch(Exception $e) {}
    }

    public function index() {
        $member = $this->session->userdata('member');
        if(!$member) $this->indexNoMember();
        else {
            $model = new JlModel(array("table" => "bs_order"));
            $data = $model->where("mb_id",$member['mb_id'])->get();
            if($data['count']) {
                $this->indexNoOrder();
            }else {
                $this->indexNoOrder();
            }
        }
    }

    public function indexNoOrder() {
        $member = $this->session->userdata('member');

        $this->load->model("PopupModel");
        $popupList = $this->PopupModel->getTodayPopup(1);


        $data = [
            'pid' => 'index2',
            "member" => $member,
            'popupList' => $popupList, // 팝업
            "jl" => $this->jl
        ];

        render('mall/index2_no', $data);
    }

    public function indexNoMember() {
        $this->load->model("PopupModel");
        $popupList = $this->PopupModel->getTodayPopup(0);

        $model = new JlModel(array("table" => "bs_comparative"));
        $model->orderBy("priority","DESC");
        $items = $model->get();

        $data = [
            'pid' => 'index2',
            "data" => $items,
            'popupList' => $popupList, // 팝업
            "jl" => $this->jl
        ];

        render('mall/index2_main', $data);
    }


    //mall
    public function index2Page()
    {
        $model = new JlModel(array("table" => "bs_comparative"));
        $model->orderBy("priority","DESC");
        $items = $model->get();

        $data = [
            'pid' => 'index2',
            "data" => $items,
            "jl" => $this->jl
        ];

        render('mall/index2_main', $data);
    }

    public function resultPage()
    {
        $data = [
            'pid' => 'result',
        ];

        render('mall/result', $data);
    }

    public function eventPage()
    {
        $data = [
            'pid' => 'event',
        ];

        render('mall/event', $data);
    }

    public function guidePage()
    {
        $data = [
            'pid' => 'guide',
        ];

        render('mall/guide', $data);
    }
    public function privacyPage()
    {
        $data = [
            'pid' => 'privacy',
        ];

        render('mall/privacy', $data);
    }
    public function provisionPage()
    {
        $data = [
            'pid' => 'provision',
        ];

        render('mall/provision', $data);
    }

    public function estimate()
    {
        if (!loginCheck()) return;
        $member = $this->session->userdata('member');

        $data = [
            'pid' => 'estimate',
            "jl" => $this->jl,
            "member" => $member
        ];

        render('mall/estimate_list', $data);
    }

    public function estimateView()
    {
        if (!loginCheck()) return;
        $member = $this->session->userdata('member');

        $request_get = $this->input->get();
        $data = [
            'pid' => 'estimate',
            "jl" => $this->jl,
            "request_get" => $request_get,
            "member" => $member
        ];

        render('mall/estimate_view', $data);
    }

    public function estimatePrint()
    {
        if (!loginCheck()) return;
        $member = $this->session->userdata('member');
        $request_get = $this->input->get();

        $data = [
            'pid' => 'estimate_print',
            "jl" => $this->jl,
            "request_get" => $request_get,
            "member" => $member
        ];

        render('mall/estimate_print', $data);
    }


    //adm
    public function admIndexPage()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_index'
        ];

		render('adm/index', $data, true);
    }

    public function medicinalList2() {
        if (!loginCheck()) return;
        $member = $this->session->userdata('member');

        $bs_order = new JlModel(array("table" => "bs_order"));
        $bs_order_item = new JlModel(array("table" => "bs_order_item"));
        $bs_product = new JlModel(array("table" => "bs_product"));

        //해당 유저 주문건
        $bs_order->orderBy("reg_date","DESC");
        $orders = $bs_order->where("mb_id",$member['mb_id'])->get()['data'];

        foreach ($orders as $index => $order) {
            // 주문건의 상품
            $products = $bs_order_item->where("ord_idx",$order['idx'])->get()['data'];

            foreach($products as $index2 => $product) {
                // 상품 정보
                $product_info = $bs_product->where("idx",$product['product_idx'])->get()['data'][0];
                $products[$index2]['info'] = $product_info;
            }
            $orders[$index]['products'] = $products;
        }

        $data = [
            'pid' => 'medicinal_list',
            "member" => $member,
            "orders" => $orders,
            "jl" => $this->jl,
        ];

        render('mall/@medicinal_list', $data);
    }

    public function estiSample()
    {
		if (!loginCheck(true)) return;

		$model = new JlModel(array("table" => "bs_comparative"));

        $request_get = $this->input->get();

        if($request_get['like_key'] && $request_get['like_value']) $model->like($request_get['like_key'],$request_get['like_value']);

        $model->orderBy("priority","DESC");

		$items = $model->get();

        $data = [
            'pid' => 'adm_esti_sample',
            "jl" => $this->jl,
            "data" => $items,
            "request_get" =>$request_get
        ];

		render('adm/esti_sample', $data, true);
    }

    public function estiSampleForm()
    {
		if (!loginCheck(true)) return;

        $model = new JlModel(array("table" => "bs_comparative"));

        $request_get = $this->input->get();
        if($request_get['idx']) {
            $item = $model->where("idx",$request_get['idx'])->get();
        }

        $data = [
            'pid' => 'adm_esti_sample_form',
            "jl" => $this->jl,
            "data" => $item['data'][0]
        ];

		render('adm/esti_sample_form', $data, true);
    }

    public function productRequest()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_product_request',
            "jl" => $this->jl,
        ];

		render('adm/product_request', $data, true);
    }
    public function mainBanner()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_main_banner'
        ];

		render('adm/main_banner', $data, true);
    }

    public function mainBannerForm()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_main_banner_form'
        ];

		render('adm/main_banner_form', $data, true);
    }

    //agency
    public function agencyIndexPage()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'agency_index'
        ];

		render('agency/index', $data, 'agency');
    }
    //agency
    public function agencyAccount()
    {

        $data = [
            'pid' => 'agency_account'
        ];

		render('agency/account', $data, 'agency');
    }
	//agency
    public function agencyMemberForm()
    {
        $data = [
            'pid' => 'agency_member'
        ];

		render('agency/member_form', $data, 'agency' );
    }

	//agency
    public function agencyList()
    {
        $data = [
            'pid' => 'agency_list'
        ];

		render('agency/list', $data, 'agency' );
    }

}
