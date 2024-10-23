<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// 로그인 여부 체크
if (!function_exists('loginCheck')) {
	function loginCheck($admPageCheck = false,$agencyPageCheck = false): bool
	{
		$CI =& get_instance();
		$member = $CI->session->userdata('member');

		if (!$member) {
			$data = [
				'message' => '로그인이 필요합니다.',
				'redirectUrl' => PROJECT_URL . '/login',
			];
			$CI->load->view('errors/alert_and_redirect', $data);
			return false;

		} else {
			// 관리자페이지 권한확인
			if ($admPageCheck && !isAdminCheck($member['mb_level'])) {
				$data = [
					'message' => '접근 권한이 없습니다.',
					'historyBack' => true,
				];
				$CI->load->view('errors/alert_and_redirect', $data);
				return false;
			}

            // 에이전시 권한확인
            if ($agencyPageCheck && $member['mb_level'] < 7 ) {
                $data = [
                    'message' => '에이전시 접근 권한이 없습니다.',
                    'historyBack' => true,
                ];
                $CI->load->view('errors/alert_and_redirect', $data);
                return false;
            }
		}

		return true;
	}
}

// 이미 로그인된 사용자는 이전페이지로 이동
if (!function_exists('redirectIfLoggedIn')) {
	function redirectIfLoggedIn() {
		$CI =& get_instance();
		if ($CI->session->userdata('member')) {
			// if (isset($_SERVER['HTTP_REFERER'])) {
			// 	redirect($_SERVER['HTTP_REFERER']);
			// } else {
				// 메인으로 이동
				redirect(PROJECT_URL);
			// }
		}
	}
}
