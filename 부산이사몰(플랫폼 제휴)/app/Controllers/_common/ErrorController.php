<?php

namespace App\Controllers\_common;

use App\Controllers\BaseController;

class ErrorController extends BaseController
{
    // (공통) 접근권한 없음 페이지 이동
    public function accessDenied(): string
    {
        $data = [
            'message' => session()->get('member')? '접근 권한이 없습니다.' : '로그인이 필요합니다',
            'redirectUrl' => base_url('login'),
        ];

        return view('errors/swal_and_redirect', $data);
    }

    // (공통) 에러 페이지
    public function errorMessage($message = '', $redirectUrl = '', $historyBack = false): string
    {
        $data = [
            'message' => (empty($message))? '잘못된 접근입니다.' : $message,
            'redirectUrl' => $redirectUrl,
            'historyBack' => $historyBack,
            'httpReferer' => !empty($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : base_url(),
        ];

        return view('errors/swal_and_redirect', $data);
    }

    // javascript 에러 로그 저장
    public function saveFrontLogError()
    {
        $post = $this->request->getJSON(true);

        $saveLog = [
            'mb_id' => session()->get('member')['mb_id'] ?? '',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            'post' => $post,
        ];

        write_server_log($saveLog, 'front-error', 'log');
    }

}