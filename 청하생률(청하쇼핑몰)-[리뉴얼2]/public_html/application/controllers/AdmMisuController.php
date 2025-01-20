<?php
/**
 * 관리자 미수관리
 * @property MemberModel $MemberModel
 * @property MisuModel $MisuModel
 */
class AdmMisuController extends CI_Controller
{
	// 미수관리
	public function admMisuPage()
	{
		if (!loginCheck(true)) return;

		// 목록
		$resultData = $this->getMisuList();

		$data = [
			'pid' => 'adm_misu',
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
		];

		render('adm/misu', $data, true);
	}

	// 미수관리 목록 데이터
	public function getMisuList(): array
	{
		$get = $this->input->get();
		$param = array(
			'isMisu' => 'Y',
			'page' => $get['page'] ?? 1,
			'sfl' => $get['sfl'] ?? 'name',
			'stx' => $get['stx'] ?? '',
			'addMisuAmt' => 1, // 총 미수금
		);

		$this->load->model('MemberModel');
		return $this->MemberModel->getMemberList($param, 'name');
	}

	// 미수관리 상세정보
	public function admMisuDetailPage($memberIdx = 0)
	{
		if (!loginCheck(true)) return;

		// 총미수금&한의원명 조회
		$this->load->model('MisuModel');
		$amtAndName = $this->MisuModel->getMisuAmt($memberIdx);

		//미수잔액 재계산
		// if (IS_PRIVATE) $misuModel->updateMisuBalance($clinicIdx);

		if (empty($amtAndName['mb_id'])) {
			$data = [
				'message' => '존재하지 않는 정보입니다.',
				'historyBack' => true,
			];
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}

		// 거래내역
		$get = $this->input->get();
		$param = [
			'page' => $get['page'] ?? 1,
			'sfl' => $get['sfl'] ?? '',
			'stx' => $get['stx'] ?? '',
			'sdt' => $get['sdt'] ?? '',
			'edt' => $get['edt'] ?? '',
			'regType' => $get['regType'] ?? '',
			'transType' => $get['transType'] ?? '',
			'payMethod' => $get['payMethod'] ?? '',
		];
		$resultData = $this->MisuModel->getMisuDetailList($param, $amtAndName['mb_id']);

		$data = [
			'pid' => 'adm_misu_detail',
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
			'misuAmt' => $amtAndName['total'],
			'clinicName' => $amtAndName['cn_name'],
			'memberId' => $amtAndName['mb_id'],
			'memberIdx' => $memberIdx,
		];

		render('adm/misu_detail', $data, true);
	}

	// 외상거래/입금내역 등록/수정
	public function postRegisterMisu()
	{
		$post = $this->input->post();
		$resultData['post'] = $post;

		$isDeposit = $post['formName']=='depFrm'; // 입금내역 등록?

		$misuData = [
			'mb_id' => $post['memberId'],
			'trans_type' => ($isDeposit)? 'DEPOSIT' : 'CREDIT',
			'trans_date' => $post['date'],
			'trans_content' => mb_substr(trim($post['content']), 0, 250),
			'credit_price' => (!$isDeposit)? extractNumbers($post['price'], true) : 0,
			'deposit' => ($isDeposit)? extractNumbers($post['price'], true) : 0,
			'idx' => (int)$post['idx'],
		];

		$this->load->model('MisuModel');
		$resultData['result'] = $this->MisuModel->registerMisu($misuData);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 외상거래,입금내역 조회
	public function getMisuInfo($idx = 0)
	{
		$this->load->model('MisuModel');
		$resultData['data'] = $this->MisuModel->getMisuInfo($idx);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 외상거래,입금내역 삭제
	public function postDeleteMisu()
	{
		$post = json_decode($this->input->raw_input_stream, true);
		$resultData['post'] = $post;

		$this->load->model('MisuModel');
		$resultData['result'] = $this->MisuModel->updateMisuDelYn($post['idx'], $post['memberId']);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

}
