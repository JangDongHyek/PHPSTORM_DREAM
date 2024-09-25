<?php
/**
 * 관리자 로그인 검증 미들웨어
 */

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 회원세션 없음 or 관리자가 아니면 경고창 후 로그인 이동
        if (!$session->has('member')) {
            $session->set('redirectUrl', current_url());
            return redirect()->to(base_url('accessDenied'));

        } else {
            if (!isAdminCheck()) {
                $session->set('redirectUrl', current_url());
                return redirect()->to(base_url('accessDenied'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 필요한 경우 추가
    }
}