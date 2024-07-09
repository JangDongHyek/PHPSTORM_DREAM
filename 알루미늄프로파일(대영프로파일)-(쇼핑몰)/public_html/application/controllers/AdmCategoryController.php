<?php
/**
 * 관리자 카테고리관리
 */
class AdmCategoryController extends CI_Controller
{
	// 카테고리 목록
	public function AdmCategory()
	{

		$data = [
			'pid' => 'adm_category',
		];

		render('adm/category', $data, true);
	}

    // 카테고리 등록/수정 폼
    public function AdmCategoryForm()
    {

		$data = [
			'pid' => 'adm_category_form',
		];

		render('adm/category_form', $data, true);
    }


}
