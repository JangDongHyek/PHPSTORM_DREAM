<?php
/*
 * 로그아웃 검증 미들웨어
 */
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LogoutCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 회원세션 있으면 메인페이지 이동
        if (session()->has('member')) {
            if (isAdminCheck()) {
                return redirect()->to(base_url('adm'));
            } else {
                return redirect()->to(base_url());
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 필요한 경우 추가
    }
}