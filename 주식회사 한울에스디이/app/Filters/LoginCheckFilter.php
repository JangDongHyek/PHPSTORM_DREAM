<?php
/**
 * 로그인 검증 미들웨어
 */
namespace App\Filters;

use App\Controllers\_common\Error;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 회원세션 없으면 로그인페이지 이동
        //if (!session()->has('member')) {
        //    $session = service('session');
        //    $session->set('redirectUrl', current_url());
        //
        //    return redirect()->to(base_url('login'));
        //}
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}