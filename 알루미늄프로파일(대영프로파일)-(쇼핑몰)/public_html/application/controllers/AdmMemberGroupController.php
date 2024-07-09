<?php
/**
 * 관리자 그룹관리
 * @property MemberGroupModel $MemberGroupModel
 */
class AdmMemberGroupController extends CI_Controller
{
    // 그룹 목록
    public function admMemberGroup()
    {
        if (!loginCheck(true)) return;

        $param = array(
            'page' => $_GET['page'] ?? 1,
            'sfl' => $_GET['sfl'] ?? '',
            'stx' => $_GET['stx'] ?? '',
        );

        $this->load->model("MemberGroupModel");
        $resultData = $this->MemberGroupModel->getMemberGroupList($param);

        $data = [
            'pid' => 'adm_group', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
        ];

        render('adm/group', $data, true);
    }

    // 그룹 등록/수정
    public function postRegisterMemberGroup()
    {
        $resultData = ['result' => false, 'message' => ''];
        $post = $this->input->post();

        $groupData = array(
            'group_name' => $post['groupName'],
            'premium_rate' => str_replace(',', '', $post['premiumRate']),
            'idx' => (int)$post['idx']
        );
        $isModify = (bool)$groupData['idx'];

        $this->load->model("MemberGroupModel");

        // 그룹명 중복확인
        if(!$isModify) {
            $checkGroup = $this->MemberGroupModel->checkDuplicateGroupName($groupData['group_name']);
            if($checkGroup != 0) {
                $resultData['message'] = '동일한 그룹명이 존재합니다.';
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($resultData));
                return;
            }
        }

        $resultData['result'] = $this->MemberGroupModel->registerMemberGroup($groupData, $isModify);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 그룹 조회
    public function getMemberGroupInfo($idx)
    {
        $this->load->model("MemberGroupModel");
        $resultData['data'] = $this->MemberGroupModel->getMemberGroupInfo($idx);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 그룹 삭제
    public function postDeleteMemberGroup()
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

        $this->load->model("MemberGroupModel");
        $resultData['result'] = $this->MemberGroupModel->deleteMemberGroup($post['idxArr']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }
}
