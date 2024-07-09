<?php
/**
 * 레이아웃 헬퍼
 */
if (!function_exists('render')) {
	function render($name, $data = array(), $isAdminPage = false)
	{
		$CI =& get_instance();
		$CI->load->view('_common/layout', array(
			'content' => $CI->load->view($name, $data, true),
			'isAdminPage' => $isAdminPage,
		));

	}
}
