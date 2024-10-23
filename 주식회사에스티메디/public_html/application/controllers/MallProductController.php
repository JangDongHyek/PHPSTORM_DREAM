<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MallProductController extends CI_Controller {
	// 상품(기획전,건강환) 목록
	public function productList()
	{
        $data = [
            'pid' => 'product_list'
        ];

		render('mall/product_list', $data);
	}

	// 상품(기획전,건강환) 상세
	public function productView($idx = null)
	{
		$data = [
			'pid' => 'product_view'
		];

		render('mall/product_view', $data);
	}
}
