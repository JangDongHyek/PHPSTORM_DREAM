<?php

/**
 * 관리자 팝업관리
 * @property PopupModel $PopupModel
 */
class AdmPopupController extends CI_Controller
{
    // 목록
    public function admPopup()
    {
        if (!loginCheck(true)) return;

        // 목록
        $get = $this->input->get();
        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
        ];

        $this->load->model("PopupModel");
        $resultData = $this->PopupModel->getPopupList($param);

        $data = [
            'pid' => 'adm_popup', // views/_common/header.php
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
        ];

        render('adm/popup', $data, true);
    }
    
    // 상세
    public function admPopupForm($idx = null)
    {
        if (!loginCheck(true)) return;

        $viewData = [];
        if (!empty($idx)) { // 수정
            $this->load->model("PopupModel");
            $viewData = $this->PopupModel->getPopup($idx);
            if (!$viewData) {
                $data = [
                    'message' => '존재하지 않는 정보입니다.',
                    'historyBack' => true,
                ];
                $this->load->view('errors/alert_and_redirect', $data);
                return;
            }
        }

        $data = [
            'pid' => 'adm_popup_form', // views/_common/header.php
            'viewData' => $viewData,
        ];

        render('adm/popup_form', $data, true);
    }

    // 팝업 등록/수정
    public function postRegisterPopup()
    {
        $resultData = ['result' => false, 'message' => ''];
        $post = $this->input->post();

        $startDate = "{$post['startDate']} {$post['startHour']}:{$post['startMin']}:00";
        $endDate = "{$post['endDate']} {$post['endHour']}:{$post['endMin']}:59";

        $isModify = !empty($post['idx']);
        $popupData = [
            'target' => $post['target'],
            'display_position' => $post['position'],
            'hide_duration_hour' => extractNumbers($post['hideHour']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'layer_left' => extractNumbers($post['layerLeft']),
            'layer_top' => extractNumbers($post['layerTop']),
            'title' => mb_substr(trim($_REQUEST['title']), 0, 30),
            'file_nm' => $post['fileName'],
            'idx' => $post['idx'],
        ];
        // $resultData['팝업'] = $popupData;

        $this->load->model("PopupModel");
        $resultData['result'] = $this->PopupModel->registerPopup($popupData, $isModify);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }

    // 팝업 삭제
    public function postDeletePopup()
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

        // 삭제
        $this->load->model("PopupModel");
        $resultData['result'] = $this->PopupModel->deletePopup($post['idxArr']);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }
}