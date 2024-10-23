<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublishController extends CI_Controller {

    //mall
    public function index2Page()
    {
        $data = [
            'pid' => 'index2',
        ];

        render('mall/index2', $data);
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
        $data = [
            'pid' => 'estimate',
        ];

        render('mall/estimate_list', $data);
    }

    public function estimateView()
    {
        $data = [
            'pid' => 'estimate',
        ];

        render('mall/estimate_view', $data);
    }

    public function estimatePrint()
    {
        $data = [
            'pid' => 'estimate_print',
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

    public function estiSample()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_esti_sample'
        ];

		render('adm/esti_sample', $data, true);
    }

    public function estiSampleForm()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_esti_sample_form'
        ];

		render('adm/esti_sample_form', $data, true);
    }

    public function productRequest()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_product_request'
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
