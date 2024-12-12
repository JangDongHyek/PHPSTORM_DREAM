<?php
/**
 * 관리자 회원관리
 * @property MemberModel $MemberModel
 * @property MemberGroupModel $MemberGroupModel
 */
class AgencyMemberController extends CI_Controller
{
    // 회원목록
    public function agencyMember()
    {
        if (!loginCheck(false,true)) return;


        $param = array(
            'page' => $_GET['page'] ?? 1,
            'sfl' => $_GET['sfl'] ?? '',
            'stx' => $_GET['stx'] ?? '',
            'groupIdx' => $_GET['groupIdx'] ?? '',
            'isAuth' => $_GET['isAuth'] ?? '',
            'isMisu' => $_GET['isMisu'] ?? '',
            'agency_div' => $_GET['agency_div'] ?? '',
            'addGroupName' => 1, // 그룹명
            'mb_level' => 7, // 에이전시는 등급7
        );

        $this->load->model("MemberModel");
        $resultData = $this->MemberModel->getMemberList($param);

        $data = [
            'pid' => 'adm_agency', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'paging2' => $resultData['paging'],
            'searchFilter' => $resultData['searchFilter'],
        ];

        render('adm/agency.php', $data, true);
    }

    // 회원목록
    public function agencyConnectMember()
    {
        if (!loginCheck(false,true)) return;

        $member = $this->session->userdata('member');

        $param = array(
            'page' => $_GET['page'] ?? 1,
            'sfl' => $_GET['sfl'] ?? '',
            'stx' => $_GET['stx'] ?? '',
            'groupIdx' => $_GET['groupIdx'] ?? '',
            'isAuth' => $_GET['isAuth'] ?? '',
            'isMisu' => $_GET['isMisu'] ?? '',
            'agency_div' => $_GET['agency_div'] ?? '',
            'agency' => $member['mb_id'] ?? '',
            'addGroupName' => 1, // 그룹명
        );

        $this->load->model("MemberModel");
        $resultData = $this->MemberModel->getMemberList($param);

        $data = [
            'pid' => 'adm_member', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'paging2' => $resultData['paging'],
            'searchFilter' => $resultData['searchFilter'],
        ];

        render('agency/list.php', $data, agency);
    }

    //에이전시 정산관리
    public function agencyAccount()
    {
        if (!loginCheck(false,true)) return;
        $get = $this->input->get();
        $member = $this->session->userdata('member');

        $param = array(
            'page' => $post['page'] ?? 1,
            'agency' => $member['mb_id'] ?? '',
            'addGroupName' => 1, // 그룹명
        );

        $this->load->model("MemberModel");
        $memberData = $this->MemberModel->getMemberList($param);

        $mbIds = [];

        // mb_id만 추출하여 배열에 추가
        foreach ($memberData['listData'] as $item) {
            if (!empty($item['mb_id'])) {  // mb_id가 비어 있지 않은 경우에만 추가
                array_push($mbIds, $item['mb_id']);
            }
        }

        $agencyMembersInStr = "'" . implode("','", $mbIds) . "'";


        // 검색
        $param = array(
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? 'name',
            'stx' => $get['stx'] ?? '',
            'sdt' => $get['sdt'] ?? '',
            'edt' => $get['edt'] ?? '',
            'year' => $get['year'] ?? '',
            'month' => $get['month'] ?? '',
            'groupIdxList' => $get['groupIdxList'] ?? '',
            'status' => $get['status'] ?? '',
            'method' => $get['method'] ?? '',
            'excel' => $get['excel'] ?? '',
            'mb_id' => $get['mb_id'] ?? '',
            'UPDATE_KEY' => $get['UPDATE_KEY'] ?? '',
            'agencyMembersInStr' => $agencyMembersInStr ?? '',
        );

        $this->load->model('OrderModel');

        $resultData = $this->OrderModel->getOrderAgencyList($param);

        $data = [
            'pid' => 'agency_account',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'agencyMember' => $mbIds,
            'minDate' => $resultData['minDate'],
            "member" => $member
        ];

        render('agency/account', $data, 'agency');
    }

    public function getAgencyMember()
    {

        $post = $this->input->post();

        if($post['sfl']){
            $_GET['sfl'] = $post['sfl'];
        }

        if($post['stx']){
            $_GET['stx'] = $post['stx'];
        }

        $param = array(
            'page' => $_GET['page'] ?? 1,
            'sfl' => $_GET['sfl'] ?? '',
            'stx' => $_GET['stx'] ?? '',
            'groupIdx' => $_GET['groupIdx'] ?? '',
            'isAuth' => $_GET['isAuth'] ?? '',
            'isMisu' => $_GET['isMisu'] ?? '',
            'agency_div' => $_GET['agency_div'] ?? '',
            'addGroupName' => 1, // 그룹명
            'mb_level' => 7, // 에이전시는 등급7
            'page_setting' => 100, // 가져올 첫페이지 개수
        );

        $this->load->model("MemberModel");
        $resultData = $this->MemberModel->getMemberList($param);

        $data = [
            'pid' => 'adm_member', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'paging2' => $resultData['paging'],
            'searchFilter' => $resultData['searchFilter'],
            'get' => $get,
            'post' => $post,
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    // 회원 등록/수정 폼
    public function agencyMemberForm($idx = 0)
    {
        $isModify = false;
        if(!empty($idx)) { // 수정
            $isModify = true;

            $this->load->model("MemberModel");
            $memberData = $this->MemberModel->getMemberInfo($idx); // 회원 조회

            if (empty($memberData['idx'])) {
                $data = [
                    'message' => '존재하지 않는 정보입니다.',
                    'historyBack' => true,
                ];
                $this->load->view('errors/alert_and_redirect', $data);
                return;
            }
        }

        $this->load->model("MemberGroupModel");
        $groupList = $this->MemberGroupModel->fetchGroupKeyNames(); // 그룹 목록

        $data = [
            'pid' => 'adm_agency_form', // views/_common/header.php
            'groupList' => $groupList,
            'memberData' => $memberData,
            'isModify' => $isModify,
        ];

        render('adm/agency_form', $data, true);
    }

	public function agencyFee()
	{
	    /*
	     * admin으로감
		$data = [
			'pid' => 'adm_agency_fee',
		];

		render('adm/agency_fee', $data, true);
	    */
	}
    // 회원 등록/수정
    public function postRegisterMember()
    {
        $resultData = ['result' => false, 'message' => ''];
        $post = $this->input->post();

        // 사업자등록번호 없음체크
        $emptyBrnoCheck = $post['emptyBrno']=='y';

        $memberData = array(
            'group_idx' => ($post['groupIdx'] != '')? $post['groupIdx'] : 1,
            'mb_id' => trim($post['id']),
            'agency_div' => trim($post['agency_div']),
            'agency_members' => trim($post['agency_members']),
            'mb_password' => ($post['password'] != '')? password_hash($post['password'], PASSWORD_DEFAULT) : '',
            'mb_name' => trim($post['name']),
            'mb_birth' => $post['birth'],
            'mb_hp' => $post['hp'],
            'auth_yn' => 'Y',
            'mb_level' => 7, // 에이젼시
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
            'login_ip' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'idx' => (int)$post['idx'],
        );
        $isModify = (bool)$memberData['idx'];
        // $resultData['회원정보'] = $memberData;

        $this->load->model('MemberModel');

        if(!$isModify) {
            // 아이디 중복확인
            $checkId = $this->MemberModel->checkDuplicateMemberId($memberData['mb_id']);
            if ($checkId != 0) {
                $resultData['message'] = '이미 등록된 아이디 입니다.';
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($resultData));
                return;
            }

            // 사업자번호 중복확인
            if (!$emptyBrnoCheck) {
                $checkBrno = $this->MemberModel->checkDuplicateBrno($memberData['biz_rno']);
                if ($checkBrno != 0) {
                    $resultData['message'] = '이미 등록된 사업자 등록번호 입니다.';
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($resultData));
                    return;
                }
            }
        }

        // 회원 DB 등록
        $resultData['result'] = $this->MemberModel->registerMember($memberData, $isModify);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 회원목록
    public function postSearchMember()
    {

        $post = $this->input->post();

        $param = array(
            'page' => $post['page'] ?? 1,
            'sfl' => $post['sfl'] ?? '',
            'stx' => $post['stx'] ?? '',
            'groupIdx' => $post['groupIdx'] ?? '',
            'isAuth' => $post['isAuth'] ?? '',
            'isMisu' => $post['isMisu'] ?? '',
            'agency_div' => $post['agency_div'] ?? '',
            'addGroupName' => 1, // 그룹명
        );

        $this->load->model("MemberModel");
        $resultData = $this->MemberModel->getMemberList($param);

        $data = [
            'pid' => 'adm_member', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'searchFilter' => $resultData['searchFilter'],
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

    }

    // 회원목록
    public function postConnectMember()
    {

        $post = $this->input->post();

        $param = array(
            'page' => $post['page'] ?? 1,
            'sfl' => $post['sfl'] ?? '',
            'stx' => $post['stx'] ?? '',
            'groupIdx' => $post['groupIdx'] ?? '',
            'isAuth' => $post['isAuth'] ?? '',
            'isMisu' => $post['isMisu'] ?? '',
            'agency_div' => $post['agency_div'] ?? '',
            'agency' => $post['agency'] ?? '',
            'addGroupName' => 1, // 그룹명
        );

        $this->load->model("MemberModel");
        $resultData = $this->MemberModel->getMemberList($param);

        $data = [
            'pid' => 'adm_member', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'searchFilter' => $resultData['searchFilter'],
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

    }

    // 회원목록
    public function postUpdateAgency()
    {
        $resultData = ['result' => false, 'message' => ''];
        $post = json_decode($this->input->raw_input_stream, true);

        if(empty($post['idxArr'])) {
            $resultData['message'] = '올바른 요청이 아닙니다.';
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($resultData));
            return;
        }

        $this->load->model("MemberModel");
        $resultData['result'] = $this->MemberModel->updateAgencyMember($post['isAuth'], $post['idxArr']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));

    }


}
