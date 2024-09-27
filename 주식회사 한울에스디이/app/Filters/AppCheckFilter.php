<?php
/**
 * 유저 로그인 검증 미들웨어
 */

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AppCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $user = $session->get("user");

        if(!$user) {
            $session->setFlashdata('warning', '로그인을 진행 해주세요.');
            return redirect()->to("login");
        }


    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 필요한 경우 추가
    }
}