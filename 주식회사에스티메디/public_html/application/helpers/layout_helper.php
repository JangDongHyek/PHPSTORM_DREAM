<?php
/**
 * 레이아웃 헬퍼
 */
if (!function_exists('render')) {
    // $isAdminPage = 관리자페이지: true, 쇼핑몰: false, 에이전시: 'agency'
	function render($name, $data = array(), $isAdminPage = false)
	{
		$CI =& get_instance();
		$CI->load->view('_common/layout', array(
			'content' => $CI->load->view($name, $data, true),
			'isAdminPage' => $isAdminPage,
		));

	}
}
