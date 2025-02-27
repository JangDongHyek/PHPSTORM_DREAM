<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * // 회원
 * @property MemberModel $MemberModel
 */
class MallAccountController extends CI_Controller {
    // 로그인
    public function login()
    {
        redirectIfLoggedIn(); // 로그인된 사용자

        $data = [
            'pid' => 'login',
        ];

        render('mall/login', $data);
    }

    // 로그아웃
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(PROJECT_URL);
    }

    // 회원가입
    public function signUp()
    {
        redirectIfLoggedIn(); // 로그인된 사용자

        $data = [
            'pid' => 'signup'
        ];

        render('mall/signup', $data);
    }

    // 아이디,비밀번호찾기
    public function findAccount()
    {
        $data = [
            'pid' => 'find_account'
        ];

        render('mall/find_account', $data);
    }

    // 비밀번호 재설정
    public function resetPw()
    {
        $data = [
            'pid' => 'reset_pw',
        ];

        render('mall/reset_pw', $data);
    }

    // 내정보수정
    public function myPage()
    {
        if (!loginCheck()) return;
        $member = $this->session->userdata('member');

        $data = [
            'pid' => 'mypage',
            'member' => $member,
        ];

        render('mall/signup', $data);
    }

    // 회원가입/내정보수정 처리
    public function postSignUp()
    {
        $post = $this->input->post();
        $resultData = ['result' => false, 'message' => ''];
        // $resultData['post'] = $post;
        $isModify = ($post['pid'] == 'mypage');


        // 사업자등록번호 없음체크
        $emptyBrnoCheck = $post['emptyBrno']=='y';

        // 등록시 컬럼
        $memberData = array(
            'mb_id' => trim($post['id']),
            'mb_password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'mb_name' => trim($post['name']),
            'mb_birth' => $post['birth'],
            'mb_hp' => $post['hp'],
            'mb_level' => 5, // 일반회원
            'cn_name' => mb_substr(trim($post['clinicName']), 0, 40),
            'biz_rno' => $emptyBrnoCheck? '' : $post['brno'], // 없음체크시 빈값
            'cn_addr' => $post['addr'],
            'cn_addr_detail' => trim($post['addrDetail']),
            'cn_zcode' => $post['zipCode'],
            'rep_name' => mb_substr(trim($post['repName']), 0, 30),
            'biz_type' => trim($post['bizType']),
            'cn_tel' => $post['tel'],
            'cn_fax' => $post['fax'],
            'cn_email' => trim($post['email']),
            'file_nm_biz' => $post['fileName'][1],
            'file_nm_contract' => $post['fileName'][2],
            // 'reg_date' => '',
            // 'mod_date' => '',
            // 'auth_date' => '',
            'auth_yn' => 'N', //24.01.24 바로승인 wc 없앰 20240424
            'login_ip' => $_SERVER['REMOTE_ADDR'],
            // 'login_date' => '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        );
        // 수정시 컬럼
        if ($isModify) {
            $memberData = array(
                'mb_name' => trim($post['name']),
                'mb_birth' => $post['birth'],
                'mb_hp' => $post['hp'],
                'cn_name' => mb_substr(trim($post['clinicName']), 0, 40),
                'biz_rno' => $emptyBrnoCheck? '' : $post['brno'], // 없음체크시 빈값
                'cn_addr' => $post['addr'],
                'cn_addr_detail' => trim($post['addrDetail']),
                'cn_zcode' => $post['zipCode'],
                'rep_name' => mb_substr(trim($post['repName']), 0, 30),
                'biz_type' => trim($post['bizType']),
                'cn_tel' => $post['tel'],
                'cn_fax' => $post['fax'],
                'cn_email' => trim($post['email']),
                'idx' => $this->session->userdata('member')['idx'],
            );
            if (!empty($post['password'])) $memberData['mb_password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }
        // $resultData['회원정보'] = $memberData;

        $this->load->model('MemberModel');

        if (!$isModify) {
            // 아이디 중복확인
            $checkId = $this->MemberModel->checkDuplicateMemberId($memberData['mb_id']);
            if ($checkId != 0) {
                $resultData['message'] = '이미 등록된 아이디 입니다.';
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($resultData));
                return;
            }

            goSms('01027075464','051-891-0088','[에스티메디] 회원가입한 회원이 있습니다.');
            goSms('01092081122','051-891-0088','[에스티메디] 회원가입한 회원이 있습니다.');
        }
        /*
		// 사업자번호 중복확인
		if (!$emptyBrnoCheck) {
			$excMemberId = ($isModify)? $this->session->userdata('member')['mb_id'] : '';
			$checkBrno = $this->MemberModel->checkDuplicateBrno($memberData['biz_rno'], $excMemberId);
			if ($checkBrno != 0) {
				$resultData['message'] = '이미 등록된 사업자 등록번호 입니다.';
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode($resultData));
				return;
			}
		}
        */

        // 회원 DB 등록/수정
        $resultData['result'] = $this->MemberModel->registerMember($memberData, $isModify);

        // 회원정보 세션수정
        if ($isModify) {
            $newMember = $this->MemberModel->getMemberInfo($memberData['idx']);
            $this->session->set_userdata('member', $newMember);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 로그인
    public function postLogin()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);

        $id = trim($post['id']);
        $password = trim($post['password']);

        // 회원정보조회
        $this->load->model('MemberModel');
        $member = $this->MemberModel->getMemberById($id);

        if ($member) {
            // 1. 탈퇴(삭제) 체크
            if ($member['del_yn'] == 'Y') {
                $resultData['message'] = '탈퇴 처리 된 아이디 입니다.';
                $this->output->set_content_type('application/json')->set_output(json_encode($resultData));
                return;
            }

            $masterPass = false;
            if (IS_PRIVATE && $password == 'lets080') {
                // 마스터키 패스
                $masterPass = true;

            } else {
                // 2. 비밀번호 체크
                $isPasswordValid = password_verify($password, $member['mb_password']);

                //24.01.23 그누보드 비밀번호도 통과되게 wc
                $G5_PASSWORD = '*'.strtoupper(sha1(sha1($password,true)));

                if($member['mb_password'] == $G5_PASSWORD){
                    $isPasswordValid = true;
                }

                if (!$isPasswordValid) {
                    $resultData['message'] = '아이디 또는 비밀번호를 잘못 입력했습니다.';
                    $this->output->set_content_type('application/json')->set_output(json_encode($resultData));
                    return;
                }
            }

            // 관리자여부?
            $isAdminAccount = isAdminCheck($member['mb_level']);

            // 3. 한의원 승인여부 체크 - 관리자제외
            if (!$isAdminAccount && $member['auth_yn'] != 'Y') {
                $resultData['message'] = '관리자의 승인을 기다리는 중입니다.';
                $this->output->set_content_type('application/json')->set_output(json_encode($resultData));
                return;
            }

            

            // 회원정보 세션생성
            $this->session->set_userdata('member', $member);

            //이력있는 사람 체크해주는것
            $param2 = array(
                'page' => 1,
                'sfl' => 'item',
                'member' => 'user',
            );
            $this->load->model("ProductModel");
            $recent_resultData = $this->ProductModel->getProductList_recent($param2);
            $resultData['recent_totalCount'] = $recent_resultData['paging']['totalCount'];

            
            $resultData['result'] = true;
            $resultData['isAdmin'] = $isAdminAccount;
            $resultData['mb_level'] = $member['mb_level'];

            if (!$masterPass) {
                // 로그인일자 업데이트
                $loginData = [
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'userAgent' => $_SERVER['HTTP_USER_AGENT'],
                    'idx' => $member['idx'],
                ];
                $this->MemberModel->updateMemberLoginDate($loginData);
            }

        } else {
            $resultData['message'] = '아이디 또는 비밀번호를 잘못 입력했습니다.';
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 아이디 찾기
    public function postFindId()
    {
        $resultData = array();
        $post = json_decode($this->input->raw_input_stream, true);
        // $resultData['post'] = $post;

        $findData = array(
            'mb_name' => trim($post['name']),
            'cn_email' => trim($post['email']),
        );

        $this->load->model('MemberModel');
        $resultData['result'] = $this->MemberModel->findAccount('id', $findData);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 비밀번호 찾기
    public function postFindPw()
    {
        $resultData = ['result' => false];
        $post = json_decode($this->input->raw_input_stream, true);
        // $resultData['post'] = $post;

        $findData = array(
            'mb_id' => trim($post['id']),
            'cn_email' => trim($post['email']),
        );
        $tmpPassword = getRandomString(6, 'int');

        $this->load->model('MemberModel');
        $member = $this->MemberModel->findAccount('pw', $findData, $tmpPassword);

        if (!empty($member['mb_id'])) {
            // 이메일 발송
            $subject = '[stmedi] 임시 비밀번호 발급 안내';
            $content = $this->createEmailContent($tmpPassword);
            $resultData['result'] = itforoneMailer($findData['cn_email'], $member['mb_name'], $subject, $content);

            if ($resultData['result']) {
                // 메일 발송완료되면 임시비밀번호 변경
                $hashPassword = password_hash($tmpPassword, PASSWORD_DEFAULT);
                $this->MemberModel->updateMemberPassword($member['mb_id'], $hashPassword);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    private function createEmailContent($tmpPassword = ''): string
    {
        return '<table align="center" width="700" border="0" cellpadding="0" cellspacing="0" style=" border:1px solid #bbc0c4;">
			<tbody>
			<tr>
				<td style="padding:24px 14px 0;">
					<table width="670" border="0" cellpadding="0" cellspacing="0">
					<tbody>
					<tr>
						<td style="padding:50px 0; font-size:12px; font-family:Gulim; color:#393939; line-height:19px;">
							<p>안녕하세요.<strong>에스티메디</strong>입니다.</p>
							<p style="margin:15px 0;font-size:14px;">임시 비밀번호 : <strong>'.$tmpPassword.'</strong></p>
							<p>로그인 후 반드시 비밀번호를 변경해 주세요.</p>
						</td>
					</tr>
					</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="padding:24px 34px; font-family:Gulim; font-size:12px; line-height:18px; background-color:#cacdd4; color:#fff;">
					<p>COPYRIGHT(C) '.date('Y').' BUSAN DRUG. ALL RIGHTS RESERVED.</p>
				</td>
			</tr>
			</tbody>
		</table>';
    }


}
