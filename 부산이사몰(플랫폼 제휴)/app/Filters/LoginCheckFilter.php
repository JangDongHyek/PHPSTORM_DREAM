<?php
/**
 * 로그인 검증 미들웨어
 */
namespace App\Filters;

use App\Controllers\_common\AccountController;
use App\Services\AccountService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;

class LoginCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 자동로그인 쿠키 체크
         if (!$session->has('member')) {
             $cookie = get_cookie(LOGIN_TOKEN_KEY);
             if ($cookie) {
                 helper('encryption');

                 // $userId = decryptData($cookie);
                 // if ($userId) {
                 //     (new AccountController())->createMemberSession($userId);
                 // }

                 // 쿠키 복호화
                 $decryptedData = decryptData($cookie);

                 if ($decryptedData) {
                     $decData = json_decode($decryptedData, true);

                     $userId = $decData['id'];
                     $storedIp = $decData['ip'];
                     $storedAgent = $decData['agent'];

                     // 현재 IP 주소와 User-Agent 확인
                     $currentIp = $_SERVER['REMOTE_ADDR'];
                     $currentAgent = $_SERVER['HTTP_USER_AGENT'];

                     // IP 주소 및 User-Agent가 일치하면 자동 로그인 처리
                     if ($userId && $storedIp === $currentIp && $storedAgent === $currentAgent) {
                         // log_message('debug', '자동로그인처리'.$userId);
                         (new AccountService())->createMemberSession(decryptData($userId));
                     } else {
                         // 쿠키를 삭제하여 잘못된 접근 방지
                         setcookie(LOGIN_TOKEN_KEY, '', time() - 3600, "/", "", false, true);
                     }
                 }

             }
         }

         // 회원세션 없으면 로그인페이지 이동
         if (!$session->has('member')) {
             $session->set('redirectUrl', current_url());

             return redirect()->to(base_url('/login'));
         }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}