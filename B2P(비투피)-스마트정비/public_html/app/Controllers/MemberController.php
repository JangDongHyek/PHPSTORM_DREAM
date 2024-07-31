<?php namespace App\Controllers;

use App\Models\MemberModel;

class MemberController extends BaseController {
    public function index(){
        $this->data['pid'] = "member_list";

        if(empty($this->data['member_type'])){
            $this->data['member_type'] = "other";
        }

        if($this->data['member']['mb_level'] != 10){
            return redirect()->to("/order/new");
        }

        $memberModel = new MemberModel();
        $this->data['member_data'] = $memberModel->getMemberList($this->data);

        return view('member/member_list',$this->data);
    }

    public function member_form(){
        $this->data['pid'] = "member_form";

        $session = session();

        // 접근 가능한지 체크
        $memberModel = new MemberModel();
        $result = $memberModel->isMyMemberData($this->data);
        if($result['code'] != 200){
            $session->setFlashdata('msg', $result['msg']);
            return redirect()->back();
        }

        $w = $this->data['w'];
        if (empty($w)) {
            // 등록일 경우
            $this->data['submit_name'] = "등록하기";
            $this->data['readonly'] = "";
            $this->data['w'] = "";

            // 기본 타이틀 설정
            $this->data['title'] = "B2P 직원";
            // 멤버 타입에 따른 타이틀 변경
            if ($this->request->getVar('member_type') == "other") {
                $this->data['title'] = "제조 . 유통사";
            }

        } else {
            // 수정일 경우
            $this->data['submit_name'] = "수정하기";
            $this->data['readonly'] = "readonly";
            $this->data['w'] = "u";

            $memberModel = new MemberModel();
            $this->data['mb'] = $memberModel->getMemberNo($this->data['mb_no']);

            // 기본 타이틀 설정
            $this->data['title'] = "B2P 직원";
            $this->data['member_type'] = "b2p";
            if($this->data['mb']['mb_level'] == '2'){
                $this->data['title'] = "개인정보";
                $this->data['member_type'] = "other";
            }

            $session->set("edit_mb_id", $this->data['mb']['mb_id']);
        }


        $this->data['bank_list'] = get_bank_list();
        $this->data['email_list'] = get_email_list();

        return view('member/member_form',$this->data);
    }

    public function member_form_update(){
        $memberModel = new MemberModel();
        $result = $memberModel->checkMemberData($this->data);

        if($result['code'] != 200){
            return $this->response->setJSON($result);
        }

        $result = $memberModel->setMember($result['data']);
        if($result['code'] != 200){
            return $this->response->setJSON($result);
        }

        // 성공 응답
        return $this->response->setJSON([
            'code' => '200',
            'msg' => '정상적으로 처리되었습니다.'
        ]);
    }
}
