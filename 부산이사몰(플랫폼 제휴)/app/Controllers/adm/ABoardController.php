<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\BoardModel;
use App\Services\BoardService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class ABoardController extends BaseController
{
    //cs 등록 수정
    public function csForm(): string
    {
        $get = $this->request->getGet();

        $dataList = [];
        if(isset($get['idx'])){
            $dataList = (new BoardService())->getBoardView($get['bo'], $get['idx'], $this->mbIdx);
        }

        $data = array_merge($dataList,[
            'pid' => 'adm_cs',
            'get' => $get,
            'isAdmPage' => true,
        ]);
        return render('adm/cs/cs_form', $data);
    }

    // cs 게시판 목록
    public function cs() : string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'status' => $get['status'] ?? '',
            'bo' => 'cs',
        ];

        $dataList = (new BoardService())->getBoardList($param['bo']);

        $data = array_merge($dataList,[
            'pid' => 'adm_cs',
            'isAdmPage' => true,
            'param' => $param
        ]);
        return render('adm/cs/cs_list', $data);
    }

    // cs 게시판 상세
    public function csView(): string
    {
        $get = $this->request->getGet();

        $dataList = (new BoardService())->getBoardView($get['bo'], $get['idx'], $this->mbIdx);

        $data = array_merge($dataList,[
            'pid' => 'adm_cs',
            'get' => $get,
            'isAdmPage' => true,
        ]);
        return render('adm/cs/cs_view', $data);

    }

    //cs 게시판 삭제
    public function postCsDeletUpload(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        foreach ($post['idx'] as $key => $value) {
            $idx = ['idx' => $value];

            $updateResult = (new BoardModel())->deleteData($idx);

            if (!$updateResult) {
                $resultData['success'] = false; // 업데이트 실패 시 false로 설정
                break; // 실패 시 반복문 탈출 (선택 사항, 상황에 따라 달라질 수 있음)
            }
        }
        return $this->response->setJSON($resultData);
    }


    // CS 게시판 진행 상태  변경
    public function postChangeCsStatus():ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        $data = [
            'status' => $post['status']
        ];

        $condition = [
            'idx' => $post['idx']
        ];

        $updateResult = (new BoardModel())->updateData($data, $condition);

        if(!$updateResult){
            $resultData['success'] = false;
            return $this->response->setJSON($resultData);
        }
        return $this->response->setJSON($resultData);
    }



}