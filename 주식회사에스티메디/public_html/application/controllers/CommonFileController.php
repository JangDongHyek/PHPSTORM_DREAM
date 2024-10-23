<?php

use CodeIgniter\HTTP\ResponseInterface;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 업로드 파일 위치
 * /assets/uploads/folder-name
 */
class CommonFileController extends CI_Controller {
	// 파일다운로드
	public function downloadFile()
	{
        $get = $this->input->get();
        $filePath = ASSETS_PATH . $get['path'];
        $fileName = null;

        // 계약서 다운시
        if (strpos($filePath, '/file/contract') !== false) $fileName = '해밀한의원_원외탕전실_공동탕전실_이용계약서.hwp';

        if (!file_exists($filePath)) {
            show_error('존재하지 않는 파일입니다.', 404);
        }

        // 파일명 변경시
        if ($fileName !== null) {
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            return readfile($filePath);
        }

        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        return readfile($filePath);
}

	// 파일업로드 1개
	public function uploadSingleFile()
	{
		$resultData = ['result' => false, 'message' => '파일 업로드에 실패하였습니다.'];
		$post = $this->input->post();
		$uploadPath = ""; // 파일업로드경로

		if (array_key_exists($post['target'], UPLOAD_FOLDERS)) {
			$uploadPath = UPLOAD_FOLDERS[$post['target']];
		}
		$resultData['path'] = $uploadPath;

		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*'; // 모든확장자 허용
		$config['encrypt_name'] = TRUE; // 파일명 랜덤

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('uploaded_file')) {
			$data = $this->upload->data();

			$resultData['result'] = true;
			$resultData['message'] = '';
			$resultData['filename'] = $data['file_name'];

			$pos = strpos($uploadPath, "/uploads");
			$resultData['source'] = 'assets' . substr($uploadPath.$data['file_name'], $pos); // 파일 url

		} else {
			$resultData['message'] = $this->upload->display_errors();
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($resultData));

	}
}
