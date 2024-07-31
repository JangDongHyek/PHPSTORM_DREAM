<?php namespace App\Controllers;

use App\Models\MemberModel;

class LoginController extends BaseController {

    // 로그인 페이지
    public function index(){
        $session = session();
        if ($session->get('is_login')) {
            return redirect()->to('/member/list');
        }

        //log_message("alert", "Debug Message1");
        return view('common/login');
    }

    // 로그인 확인
    public function authenticate() {
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        $mb_id = $this->request->getVar('mb_id');
        $password = $this->request->getVar('mb_password');

        $session = session();
        $memberModel = new MemberModel();
        $member = $memberModel->getMember($mb_id, true);

        // 아이디 존재여부
        if(empty($member)){
            $session->setFlashdata('msg', '일치하는 회원 정보가 없습니다.');
            return redirect()->to('common/login');
        }

        // 비밀번호 확인
        if (password_verify($password, $member['mb_password'])) {

            // 승인 여부
            if($member['is_sign'] != "Y"){
                $session->setFlashdata('msg', '미승인 상태입니다. 관리자에게 문의해주세요.');
                return redirect()->to('common/login');
            }

            $ses_data = [
                'in_mb_no'         => $member['mb_no'],
                'in_mb_id'         => $member['mb_id'],
                'in_mb_name'       => $member['mb_name'],
                'in_mb_level'      => $member['mb_level'],
                'is_login'      => true
            ];
            $session->set($ses_data);

            $url = "/member/list";
            if($member['mb_level'] != 10){
                $url = "/order/new";
            }
            return redirect()->to($url);
        } else {
            $session->setFlashdata('msg', '일치하는 회원 정보가 없습니다.');
            return redirect()->to('common/login');
        }
    }

    // 로그아웃
    public function logout(){
        session()->destroy();
        return redirect()->to('common/login');
    }
}
