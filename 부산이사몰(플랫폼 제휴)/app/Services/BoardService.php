<?php

namespace App\Services;

use App\Models\BoardFileModel;
use App\Models\BoardModel;

class BoardService
{
    // (공통) 목록 데이터 기본게시판
    public function getBoardList($tableName = '', $isAdmin = false): array
    {
        $request = service('request');
        $get = $request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
            'status' => $get['status'] ?? '',
            'listRow' => '50'
        ];

        $resultData = (new BoardModel())->getBoardList($param, $tableName);

        return [
            'pid' => $this->methodPid[$tableName] ?? '',
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'route' => $tableName,
            'auth' => $this->getBoardAuth($tableName, $isAdmin),
        ];
    }

    //faq 목록
    public function getFaqBoardView($tableName = '', $isAdmin = false): array
    {
        $request = service('request');
        $get = $request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? '',
        ];

        $resultData = (new BoardModel())->getFaqList($param, $tableName);

        return [
            'listData' => $resultData['listData'],
            'paging' => $resultData['paging'],
            'param' => $param,
            'auth' => $this->getBoardAuth($tableName, $isAdmin),
        ];
    }

    // (공통) 상세 데이터
    public function getBoardView($tableName = '', $idx = 0, $mbIdx = 0, $isAdmin = false): array
    {
        if (empty($idx)) return ['error' => '존재하지 않는 게시글이에요.'];

        $boardModel = new BoardModel();

        $boardData = $boardModel->getBoardInfo($tableName, $idx);
        if (empty($boardData)) {
            return ['error' => '존재하지 않는 게시글이에요.'];
        }
        $fileData = (new BoardFileModel())->getFileList($tableName, $idx);

        // 비밀글 체크 (관리자&본인)
        if ($boardData['secret_yn'] == 'Y') {
            if (!isAdminCheck() && $mbIdx != $boardData['mb_idx']) {
                return ['error' => '올바른 요청이 아니에요.'];
            }
        }

        //답글
        $commentList = $boardModel->getCommentList($idx);

        if (!$isAdmin) {
            // 조회수 업데이트
            $boardModel->updateReadCnt($idx);
        }

        return [
            'pid' => $this->methodPid[$tableName] ?? '',
            'boardData' => $boardData,
            'fileData' => $fileData,
            'route' => $tableName,
            'comment' => $commentList,
            'auth' => $this->getBoardAuth($tableName, $isAdmin, $mbIdx, $boardData['mb_idx']),
        ];
    }

    // 게시판 권한
    private function getBoardAuth($tableName = '', $isAdmin = false, $mbIdx = 0, $regMbIdx = 0): array
    {
        if (!$isAdmin) { // 홈페이지
            $auth = [
                'modify' => false, 'delete' => false, 'write' => false,
                'comment_view' => false, 'comment_write' => false,
            ];

            if (isAdminCheck() || $mbIdx == $regMbIdx) { // 관리자&본인글 수정,삭제
                $auth['delete'] = true;
                $auth['modify'] = true;
            }
            if (in_array($tableName, ['topic', 'tidings', 'job', 'golfyard', 'info',  'partner', 'reviews', 'faq'])) { // 글쓰기 & 코멘트
                if (isMember()) {
                    $auth['write'] = true;
                    $auth['comment_write'] = true;
                }
                $auth['comment_view'] = true;
            }

        } else {
            // 관리자 권한
            $auth = [
                'modify' => true, 'delete' => true, 'write' => true,
                'comment_view' => true, 'comment_write' => true,
            ];
        }

        return $auth;
    }
}