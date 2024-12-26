<?php

namespace App\Controllers\_common;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class FileController extends BaseController
{
    // 파일업로드 1개 (업로드가 안될경우 터미널 폴더 소유주 확인)
    public function uploadSingleFile(): ResponseInterface
    {
        $resultData = ['result' => false, 'message' => '파일 업로드에 실패하였습니다.'];
        $file = $this->request->getFile('uploaded_file'); // input name
        $post = $this->request->getPost();
        $uploadPath = ''; // 파일업로드경로
        $folder = '';

        try {
            if (!isset($post['target']) || !array_key_exists($post['target'], UPLOAD_FOLDERS)) {
                throw new \Exception('업로드 상수가 설정되지 않았습니다.');
            }

            $uploadPath = UPLOAD_FOLDERS[$post['target']]['path'];

            // 업로드 폴더 체크
            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    throw new \Exception("업로드 폴더 생성 실패(1)");
                }
            }

            if (($post['createYm'] ?? '') == 'Y') {
                $folder = date('ym');
                $uploadPath .= $folder . '/';
                if (!is_dir($uploadPath)) {
                    if (!mkdir($uploadPath, 0777, true)) {
                        throw new \Exception("업로드 폴더 생성 실패(2)");
                    }
                }
            }
            if (!empty($post['createIdx'])) {
                $folder = $post['createIdx'];
                $uploadPath .= $folder . '/';
                if (!is_dir($uploadPath)) {
                    if (!mkdir($uploadPath, 0777, true)) {
                        throw new \Exception("업로드 폴더 생성 실패(3)");
                    }
                }
            }

            if (!empty($uploadPath) && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $resultData['result'] = true;
                $resultData['message'] = '';
                // $resultData['filename'] = $newName;
                // $resultData['folder'] = $folder;
                $resultData['name'] = $folder . '/' . $newName;
                $resultData['source'] = base_url() . UPLOAD_FOLDERS[$post['target']]['url'] . $resultData['name']; // 파일 url
            }

            return $this->response->setJSON($resultData);

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON($resultData);
        }

        return $this->response->setJSON($resultData);
    }

    // 파일다운로드
    public function downloadFile()
    {
        $get = $this->request->getGet();

        // $filePath = ROOTPATH . 'public' . $get['path'];
        // $fileName = null;

        $folderKey = $get['key'] ?? '';
        //$folderKey = 'BOARD';
        $changeFileName = $get['changeName'] ?? null;
        $folderName = array_key_exists($folderKey, UPLOAD_FOLDERS) ? UPLOAD_FOLDERS[$folderKey] : null;
        $fileName = $get['file'] ?? '';
        if ($folderName == null || $fileName == '') {
            // return $this->response->setStatusCode(404, '존재하지 않는 파일입니다.');
            die('존재하지 않는 파일입니다.');

        }

        $filePath = $folderName['path'] . $fileName;
        // die($filePath);

        if (!file_exists($filePath)) {
            // return $this->response->setStatusCode(404, '존재하지 않는 파일입니다.');
            die('존재하지 않는 파일입니다.');

        }

        // 파일명 변경시
        if ($changeFileName !== null) {
            return $this->response->download($filePath, null)->setFileName($changeFileName);
        }
        return $this->response->download($filePath, null);
    }

}