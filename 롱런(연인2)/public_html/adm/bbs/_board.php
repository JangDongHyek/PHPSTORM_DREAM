<?php
/**
 * 기본형게시판 config
 */
$tbl_name = $_GET['tbl']; // 테이블명
$title = ""; // 게시판 제목
$file_count = 2; // 파일업로드 가능 수
$reply_enable = true; // 답변 가능
$hit_enable = false; // 조회수 on/off

switch ($tbl_name) {
    case "counselor" : // 요청페이지 > 카운슬러게시판
        $sub_menu = "600400";
        $title = "카운슬러 게시판";
        break;

    case "notice" : // 모바일관리 > notice
        $sub_menu = "650100";
        $title = "notice";
        $reply_enable = false;
        $hit_enable = true;
        break;

    case "column" : // 모바일관리 > 롱런칼럼
        $sub_menu = "650200";
        $title = "롱런칼럼";
        $reply_enable = false;
        $hit_enable = true;
        break;

    case "event" : // 모바일관리 > 이벤트
        $sub_menu = "650300";
        $title = "이벤트";
        $reply_enable = false;
        $hit_enable = true;
        break;

    case "couple" : // 모바일관리 > 커플후기
        $sub_menu = "650500";
        $title = "커플후기";
        $reply_enable = false;
        $hit_enable = true;
        break;

    default :
        alert("존재하지 않는 게시판 입니다.");
}