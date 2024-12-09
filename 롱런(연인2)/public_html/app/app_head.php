<?php
require_once("../common.php");
require_once('../head.sub.php');
add_stylesheet('<link rel="stylesheet" href="'.G5_URL.'/app/css/common.css?ver='.G5_CSS_VER.'">',10);//어플
add_stylesheet('<link rel="stylesheet" href="'.G5_URL.'/app/css/style.css?ver='.G5_CSS_VER.'">',10);//어플

/**
 * 헤더타입
 * 0 : 헤더없음
 * 1 : 푸시아이콘, 앱이름, 마이페이지
 * 2 : 뒤로가기, 상단페이지명
 */
$header_type = 0;       // 헤더타입
$footer_type = 0;       // 푸터타입
$header_name = "";      // 상단페이지명
$lnb_name = "";      // 서브페이지명
$content_id = "";       // div id
$content_class = "";    // div class

switch ($pid) {
    case "index" :  // 메인
        $header_type = 1;
		$footer_type = 1;
		$header_name = "롱런";
        break;
    case "counselor" :  // 카운슬러 프로필
        $header_type = 2;
        $footer_type = 1;
        $header_name = "카운슬러 프로필";
        break;
    case "column" :  // 롱런칼럼
        $header_type = 2;
        $footer_type = 1;
        $header_name = "롱런칼럼";
        break;
    case "column_view" :  // 롱런칼럼
        $header_type = 2;
        $header_name = "롱런칼럼";
        break;
    case "column_form" :  // 롱런칼럼
        $header_type = 2;
        $header_name = "롱런칼럼";
        break;
    case "event" :  // 이벤트
        $header_type = 2;
        $footer_type = 1;
        $header_name = "이벤트";
        break;
    case "event_view" :  // 이벤트
        $header_type = 2;
        $header_name = "이벤트";
        break;
    case "event_form" :  // 이벤트
        $header_type = 2;
        $header_name = "이벤트";
        break;
    case "notice" :  // 공지
        $header_type = 2;
        $footer_type = 1;
        $header_name = "공지";
        break;
    case "notice_view" :  // 공지
        $header_type = 2;
        $header_name = "공지";
        break;
    case "notice_form" :  // 공지
        $header_type = 2;
        $header_name = "공지";
        break;

    case "mypage" :  // 마이페이지
        $header_type = 2;
        $footer_type = 1;
        $header_name = "마이페이지";
        break;
    case "heart" :  // 하트
        $header_type = 2;
        $footer_type = 1;
        $header_name = "하트";
        break;
    case "coupon" :  // 나의 쿠폰
        $header_type = 2;
        $footer_type = 1;
        $header_name = "나의 쿠폰";
        break;

    case "guide" :  // 롱런 가이드라인
        $header_type = 2;
        $footer_type = 2;
        $header_name = "롱런 가이드라인";
        break;

}
?>
<? if ($header_type == 1) { ?>
<? } else if ($header_type == 2) { ?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $header_name ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div id="hd_back" class="hd_icon">
            <a href="javascript:history.back();">
                <i class="fa-light fa-chevron-left"></i>
            </a>
        </div>
        <div id="title">
            <?php echo $header_name ?>
        </div>
        <div>
        </div>
    </div>
    </div>
</header>
<div id="wrap">
<? } else { ?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
            <div id="hd_back" class="hd_icon">
                <a href="javascript:history.back();">
                    <i class="fa-light fa-chevron-left"></i>
                </a>
            </div>
            <div id="title">
                <?php echo $g5['title'] ?>
            </div>
            <div>
            </div>
        </div>
    </div>	
</header>
<div id="wrap">
<? } ?>
