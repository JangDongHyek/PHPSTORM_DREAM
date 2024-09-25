<?php


use App\Controllers\_common\Account;
use App\Controllers\_common\AccountController;
use App\Controllers\_common\Error;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UpdateMemberFilter implements FilterInterface
{
    // 페이지 이동시마다 회원정보 필터에서 체크
    public function before(RequestInterface $request, $arguments = null)
    {
        // $session = session();
        //
        // // 로그인한 사용자의 경우 최신정보 업데이트
        // if ($session->has('member')) {
        //     $id = $session->get('member')['mb_id'];
        //     // 세션업데이트
        //     $member = (new AccountController())->createMemberSession($id, false, true);
        //     if (empty($member)) {
        //         $session->remove('member'); // 특정 세션 변수 삭제
        //         $session->destroy(); // 세션 파괴
        //     }
        //
        //     // 탈퇴 or 승인해제
        //     if (!empty($member['leave_date']) || $member['auth_yn'] == 'N') {
        //         $session->destroy();
        //         // return (new Error())->errorMessage('탈퇴된 계정이에요.', '/login', true);
        //     }
        //     // 직원계정 로그인권한
        //     if (\App\Filters\isEmployeeCheck($member['mb_level'])) {
        //         $loginAuth = $member['emp_auth']['LOGIN'] ?? 'Y';
        //         if ($loginAuth == 'N')  $session->destroy();
        //     }
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}