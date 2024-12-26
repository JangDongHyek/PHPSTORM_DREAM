<?php

namespace App\Filters;

use App\Controllers\_common\Account;
use App\Controllers\_common\AccountController;
use App\Controllers\_common\Error;
use App\Services\AccountService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UpdateMemberFilter implements FilterInterface
{
    // 페이지 이동시마다 회원정보 필터에서 체크
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        //로그인한 사용자의 경우 최신정보 업데이트
        if ($session->has('member')) {
            $id = $session->get('member')['mb_id'];

            // 세션업데이트
            $member = (new AccountService())->createMemberSession($id, false, true);
            if (empty($member)) {
                $session->remove('member'); // 특정 세션 변수 삭제
                $session->destroy(); // 세션 파괴
            }

            // 탈퇴
            if (!empty($member['left_at'])) {
                $session->destroy();
                // return (new Error())->errorMessage('탈퇴된 계정이에요.', '/login', true);
            }

            //승인안되어 있으면
            if ($member['state'] !== 'N') {
                $session->destroy();
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}