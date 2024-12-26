<?php
/**
 * 관리자 로그인 검증 미들웨어
 */
namespace App\Filters;

use App\Controllers\_common\AccountController;
use App\Services\AccountService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
         $session = session();

         // 자동로그인 쿠키 체크
         if (!$session->has('member')) {
             $cookie = get_cookie(LOGIN_TOKEN_KEY);
             if ($cookie) {
                 helper('encryption');
                 $userId = decryptData($cookie);
                 if ($userId) {
                     (new AccountService())->createMemberSession($userId);
                 }
             }
         }

         // 회원세션 없음 or 관리자가 아니면 로그인페이지 이동
         if (!$session->has('member')) {
             $session->set('redirectUrl', current_url());
             return redirect()->to(base_url('/login'));

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