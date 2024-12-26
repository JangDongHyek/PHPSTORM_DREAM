<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;
use App\Models\BoardFileModel;
use App\Models\BoardModel;
use App\Services\BoardService;
use CodeIgniter\HTTP\ResponseInterface;

class BoardController extends BaseController
{

    // 기본게시판 등록
    public function boardForm(): string
    {
        $get = $this->request->getGet();

        $dataList = [];
        if(isset($get['idx'])){
            $dataList = (new BoardService())->getBoardView($get['bo'], $get['idx'], $this->mbIdx);
        }

        $data = array_merge($dataList,[
            'pid' => 'app_board_form',
            'get' => $get,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/board/board_form', $data);
    }

    // 기본게시판
    public function board(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'bo' => $get['bo'] ?? '',
        ];

        $dataList = (new BoardService())->getBoardList($get['bo']);

        $data = array_merge($dataList,[
            'pid' => 'app_board',
            'param' => $param,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/board/board', $data);
    }

    //게시판 삭제
    public function postBoardDel():ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        $data = [
            'idx' => $post['idx'],
            'del_yn' => 'Y',
        ];
       //return $this->response->setJSON($data);
        $updateResult = (new BoardModel())->updateBoard($data);
        if (!$updateResult) {
            $resultData['success'] = false;
        }
        return $this->response->setJSON($resultData);
    }


    // 기본게시판 상세
    public function boardView(): string
    {

        $get = $this->request->getGet();

        $dataList = (new BoardService())->getBoardView($get['bo'], $get['idx'], $this->mbIdx);

        $data = array_merge($dataList,[
            'pid' => 'app_board_view',
            'get' => $get,
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/board/board_view', $data);
    }

    //게시글 등록
    public function postregisterBoard():ResponseInterface
    {
        $post = $this->request->getPost();
        $tableName = $post['boardType'];

        $boardData = [
            'idx' => extractNumbers($post['idx'] ?? 0),
            'tbl_name' => $tableName,
            'mb_idx' => $this->mbIdx,
            'mb_nick' => $this->member['mb_name'],
            'fix_yn' => !empty($post['fixYn']) ? 'Y' : 'N',
            'secret_yn' => !empty($post['secretYn']) ? 'Y' : 'N',
            'title' => trim($post['title']),
            'content' => $post['content'],
            'mb_hp' => $post['mbHp'],
            'mb_name' => $post['mbName']
        ];

        $fileData = [];
        if (!empty($post['fileName'])) {
            foreach ($post['fileName'] as $key => $val) {
                if (empty($val)) continue;

                $expFile = explode('/', $val);
                $fileData[] = [
                    'tbl_name' => $tableName,
                    'board_idx' => $boardData['idx'],
                    'file_name' => $val,
                    'folder' => $expFile[0],
                    'org_name' => $post['fileOrgName'][$key] ?? '',
                    'sort' => $key,
                ];
            }
        }

        //게시판 등록/수정
        if($boardData['idx'] == 0){
            $boardData['idx'] = (new BoardModel())->insertBoard($boardData);
            $resultData['result'] = $boardData['idx'] > 0;
        }else{
            $resultData['result'] = (new BoardModel())->updateBoard($boardData);
        }

        // 파일 등록
        if ($resultData['result'] && !empty($fileData)) {
            (new BoardFileModel())->insertFile($tableName, $boardData['idx'], $fileData);
        }

        // 물리파일 삭제
        if (!empty($post['deleteFiles'])) {
            $key = strtoupper($tableName);
            deleteAttachedFile($post['deleteFiles'], $key);
        }

        return $this->response->setJSON($resultData);
    }

    //답글 등록
    public function postCommentUpload():ResponseInterface
    {
        $post = $this->request->getPost();

        $boardModel = new BoardModel();

        $comment = [
            'idx' => $post['idx'] ?? 0,
            'board_idx' => $post['boardIdx'],
            'parent_idx' => 0,
            'mb_idx' => $this->mbIdx,
            'mb_nick' => $this->member['mb_name'],
            'content' => $post['content']
        ];


        if($post['upload']){
            switch ($post['upload']){
                case 'del':
                    $resultData['result'] = $boardModel->delComment($comment);
                    break;
                case 'edit':
                    $resultData['result'] = $boardModel->editComment($comment);
                    break;
            }
        }else{

            /*$condition = [
                'idx' => $post['boardIdx']
            ];

            $data = [
                'status'=> '4'
            ];
            $boardModel->updateData($data, $condition);*/


            $boardData['idx'] = $boardModel->insertComment($comment);
            $resultData['result'] = $boardData['idx'] > 0;
        }



        return $this->response->setJSON($resultData);
    }

    // FAQ게시판 등록
    public function faqForm(): string
    {
        $get = $this->request->getGet();
        $dataList = [];
        if($get['idx']){
            $dataList = (new BoardModel())->getFaqEdit($get['idx']);
        }
        //var_dump($dataList['faqData']['title']);
        $data = array_merge($dataList,[
            'pid' => 'app_faq_form',
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/board/faq_form', $data);
    }

    // faq 등록
    public function postFaqUpload(): ResponseInterface
    {
        $post = $this->request->getPost();

        $faq = [
            'idx' => extractNumbers($post['idx'] ?? 0),
            'category' => $post['category'],
            'mb_nick' => $this->member['mb_name'],
            'title' => $post['title'],
            'content' => $post['content'],
            'tbl_name' => 'faq',
            'mb_idx' => $this->member['idx']
        ];

        if($faq['idx'] === 0){
            $resultData['result'] = (new BoardModel())->insertData($faq);
        }else{
            $condition = ['idx' => $post['idx']];
            $resultData['result'] = (new BoardModel())->updateData($faq, $condition);
        }


        return $this->response->setJSON($resultData);
    }

    // FAQ게시판
    public function faq(): string
    {
        $faqList = (new BoardService())->getFaqBoardView('faq');

        $data = array_merge($faqList,[
            'pid' => 'app_faq',
            'response' =>  $this->visitorStats,// 방문자 수 오늘 , 총
        ]);

        return render('app/board/faq', $data);
    }

    //FAQ 삭제
    public function postFaqDelete(): ResponseInterface
    {
        $post = $this->request->getPost();

        $data = [
            'idx'=> $post['idx'],
        ];

        $resultData['result'] = (new BoardModel())->deleteData($data);

        return $this->response->setJSON($resultData);
    }



}