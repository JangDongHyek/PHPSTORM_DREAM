<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null){
        // 요청 전 실행할 코드
        $session = session();
        if (!$session->get('is_login')) {
            return redirect()->to('common/login');
        }

        // 로그인 유지할 수 있도록
        if ($session->get('is_login')) {
            $memberModel = new \App\Models\MemberModel();
            $mb = $memberModel->getMember($session->get('in_mb_id'));
            $mb2 = $memberModel->getMemberNo($session->get('in_mb_no'));

            if ($mb['mb_id'] != $mb2['mb_id']) {
                $session->destroy();
                $session->setFlashdata('msg', '다시 로그인 해주세요.');
                return redirect()->to('common/logout');
            }

            if ($mb['is_sign'] != "Y") {
                $session->destroy();
                $session->setFlashdata('msg', '미승인 상태입니다. 관리자에게 문의해주세요.');
                return redirect()->to('common/logout');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        // 요청 후 실행할 코드 (응답 전송 후)
    }
}
