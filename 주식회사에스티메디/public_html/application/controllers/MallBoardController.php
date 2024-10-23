<?php
/**
 * 게시글 - 고객센터 (공지사항, 고객문의, FAQ, 단체주문문의), 상품후기, 상품문의
 * @property BoardModel $BoardModel
 * @property BoardCommentModel $BoardCommentModel
 */
class MallBoardController extends CI_Controller
{
	private $categoryList = ['notice', 'qna', 'faq', 'group_order'];

	// 게시판 lnb
	public function getCategory()
	{
		$category = 'notice';
		if (!empty($_GET['cate']) && in_array($_GET['cate'], $this->categoryList)) $category = $_GET['cate'];
		return $category;
	}

	// 게시판 첨부파일
	public function getAttachedFile($jsonStr): array
	{
		$attachedFile = array();

		if (!empty($jsonStr)) {
			$decode = json_decode($jsonStr, true);
			foreach ($decode as $file) {
				$filePath = UPLOAD_FOLDERS['BOARD'] . $file['name'];
				if (file_exists($filePath)) {
					$attachedFile[] = [
						'fileName' => $file['name'],
						'orgFileName' => $file['orgName'],
					];
				}
			}
		}

		return $attachedFile;
	}

	// 게시판 목록
	public function boardListPage()
	{
		// if (!loginCheck()) return;
		$get = $this->input->get();
		$category = $this->getCategory();

		$param = array(
			'page' => $get['page'] ?? 1,
			'cate' => $category,
		);
		$this->load->model('BoardModel');
		$resultData = $this->BoardModel->getBoardList($param);

		$data = [
			'pid' => 'board_list',
			'category' => $category,
			'member' => $this->session->userdata('member'),
			'listData' => $resultData['listData'],
			'paging' => $resultData['paging'],
		];

		render('mall/board_list', $data);
	}

	// 게시판 상세
	public function boardViewPage($idx = 0)
	{
		// if (!loginCheck()) return;
		// $get = $this->input->get();
		$category = $this->getCategory();
		$member = $this->session->userdata('member');
		$isAdminAccount = isAdminCheck($member['mb_level']);

		$this->load->model('BoardModel');
		$boardData = $this->BoardModel->getBoardInfoByIdx($idx, $category);

		if (empty($boardData['idx'])) {
			$data = [
				'message' => '존재하지 않는 정보입니다.',
				'historyBack' => true,
			];
			$this->load->view('errors/alert_and_redirect', $data);
			return;
		}

		// 비밀글 열람권한 체크
		if ($boardData['secret_yn'] == 'Y') {
			$allowedToView = $isAdminAccount || $boardData['mb_id'] == $member['mb_id']; // 관리자 or 본인글

			if (!$allowedToView) {
				$data = [
					'message' => '존재하지 않는 정보입니다.',
					'historyBack' => true,
				];
				$this->load->view('errors/alert_and_redirect', $data);
				return;
			}
		}

		// 조회수 추가
		$this->BoardModel->updateBoardViewCount($idx);

		// 코멘트
		$this->load->model('BoardCommentModel');
		$commentData = $this->BoardCommentModel->getCommentList($idx);

		// 첨부파일
		$attachedFile = $this->getAttachedFile($boardData['file_name_json']);

		$data = [
			'pid' => 'board_view',
			'category' => $category,
			'member' => $member,
			'boardData' => $boardData,
			'commentData' => $commentData,
			'attachedFile' => $attachedFile,
			'isAdminAccount' => $isAdminAccount,
		];

		render('mall/board_view', $data);
	}

	// 게시판 등록
	public function boardFormPage($idx = 0)
	{
		if (!loginCheck()) return;

		// $get = $this->input->get();
		$category = $this->getCategory();
		$member = $this->session->userdata('member');
		$isAdminAccount = isAdminCheck($member['mb_level']);
		$boardData = array();
		$attachedFile = array();

		if ($idx > 0) {
			$this->load->model('BoardModel');
			$boardData = $this->BoardModel->getBoardInfoByIdx($idx, $category);

			if (empty($boardData['idx'])) {
				$data = [
					'message' => '존재하지 않는 정보입니다.',
					'historyBack' => true,
				];
				$this->load->view('errors/alert_and_redirect', $data);
				return;
			}
			if (!$isAdminAccount && $boardData['mb_id'] != $member['mb_id']) {
				$data = [
					'message' => '존재하지 않는 정보입니다.',
					'historyBack' => true,
				];
				$this->load->view('errors/alert_and_redirect', $data);
				return;
			}

			// 첨부파일
			$attachedFile = $this->getAttachedFile($boardData['file_name_json']);
		}

		$data = [
			'pid' => 'board_form',
			'category' => $category,
			'member' => $member,
			'boardData' => $boardData,
			'attachedFile' => $attachedFile,
		];

		render('mall/board_form', $data);
	}

	// 게시판 등록/수정 처리
	public function postRegisterBoard()
	{
		$resultData = ['result' => false, 'message' => ''];
		$post = $this->input->post();
		// $resultData['post'] = $post;
		$member = $this->session->userdata('member');

		$fileNameList = array();
		foreach ($post['fileName'] AS $key=>$name) {
			if ($name != '') {
				$fileNameList[] = [
					'name' => $name,
					'orgName' => $post['orgFileName'][$key] != ''? $post['orgFileName'][$key] : $name,
				];
			}
		}

		// $isModify = !empty($post['idx']);
		$boardData = [
			'category' => $post['category'] ?? 'notice',
			'mb_id' => $member['mb_id'],
			'mb_name' => $member['mb_name'],
			'fix_yn' => $post['fixYn']=='Y'? 'Y':'N',
			'title' => mb_substr(trim($post['title']), 0, 90),
			'content' => $post['content'],
			'view_cnt' => 0,
			'file_name_json' => json_encode($fileNameList, JSON_UNESCAPED_UNICODE),
			'secret_yn' => $post['secretYn']=='Y'? 'Y':'N',
            'ref_idx' => $post['ref_idx'], // 상품인덱스
			'idx' => (int)$post['idx'],
		];
		// $resultData['게시판등록'] = $boardData;

		// 수정시 컬럼 추가/제거
		if ($boardData['idx'] > 0) {
			$boardData['mod_date'] = date('Y-m-d H:i:s');
			$boardData['mod_mb_id'] = $member['mb_id'];
			unset($boardData['category']);
			unset($boardData['mb_id']);
			unset($boardData['mb_name']);
		}

		$this->load->model('BoardModel');
		$resultData['result'] = $this->BoardModel->registerBoard($boardData);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 게시판 삭제
	public function postDeleteBoard()
	{
		$resultData = ['result' => false, 'message' => ''];
		$post = json_decode($this->input->raw_input_stream, true);
		$memberId = $this->session->userdata('member')['mb_id'];

		$this->load->model('BoardModel');
		$resultData['result'] = $this->BoardModel->deleteBoard($post['idx'], $memberId);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 게시판 코멘트 등록/수정 처리
	public function postRegisterBoardComment()
	{
		$resultData = ['result' => false, 'message' => ''];
		$post = json_decode($this->input->raw_input_stream, true);
		// $resultData['post'] = $post;
		$member = $this->session->userdata('member');

		$commentData = [
			'board_idx' => $post['boardIdx'],
			'mb_id' => $member['mb_id'],
			'mb_name' => $member['mb_name'],
			'content' => trim($post['answer']),
			'idx' => (int)$post['commentIdx'],
		];
		// $resultData['코멘트'] = $commentData;

		$this->load->model('BoardCommentModel');
		$resultData['result'] = $this->BoardCommentModel->registerComment($commentData);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

	// 게시판 코멘트 삭제
	public function postDeleteBoardComment()
	{
		$resultData = ['result' => false, 'message' => ''];
		$post = json_decode($this->input->raw_input_stream, true);

		$commentData = [
			'del_yn' => 'Y',
			'mod_date' => date('Y-m-d H:i:s'),
			'idx' => (int)$post['idx'],
		];
		// $resultData['코멘트'] = $commentData;

		$this->load->model('BoardCommentModel');
		$resultData['result'] = $this->BoardCommentModel->registerComment($commentData);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));
	}

}
