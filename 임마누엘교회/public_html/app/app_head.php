<?php
require_once("../common.php");
require_once('../head.sub.php');
include_once("../jl/JlConfig.php");

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
    case "login" :
        $header_type = 0;
        $footer_type = 0;
        break;
    case "index" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '';
        break;
    case "prayer" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '기도요청';
        break;
    case "pray_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '기도요청';
        break;
    case "note" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '결단노트';
        break;
    case "note_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '결단노트';
        break;
    case "friend" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '교우소식';
        break;
    case "friend_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '교우소식';
        break;
    case "helper" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '도우미';
        break;
    case "helper_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '도우미 요청';
        break;
    case "helper_view" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '도우미 내용';
        break;
    case "class" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = 'IMC 속회방';
        break;
    case "class_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회보고';
        break;
    case "class_list" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회예배현황';
        break;
    case "class_noti" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회소식';
        break;
    case "class_all" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '지난 속회보고';
        break;
    case "class_list_view" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '교구별 보고현황';
        break;
    case "class_leader" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회 목회자';
        break;
    case "union" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = 'IMC 공동체';
        break;
    case "union_group" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '교구방';
        break;
    case "union_small" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '소그룹';
        break;
    case "union_mission" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = 'IMC 선교회';
        break;
    case "union_ministry" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '사역부서';
        break;
    case "union_culture" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '문화부';
        break;
    case "rental" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '대관 신청';
        break;
    case "rental_hall" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '본당 대관';
        break;
    case "hall_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '본당 대관';
        break;
    case "hall_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '본당 대관';
        break;
    case "rental_lecture" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '교육관 대관';
        break;
    case "rental_mine" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '나의 대여 신청 목록';
        break;
    case "lecture_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '교육관 대관';
        break;
    case "lecture_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '교육관 대관';
        break;
    case "rental_bus" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '버스 사용';
        break;
    case "bus_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '버스 사용';
        break;
    case "bus_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '버스 사용';
        break;
    case "rental_equip" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '비품 대여';
        break;
    case "equip_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '비품 대여';
        break;
    case "equip_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '비품 대여';
        break;
    case "point" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '나의 포인트';
        break;
    case "lost" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '분실물 찾기';
        break;
    case "lost_form" :
        $header_type = 1;
        $footer_type = 2;
        if($_GET['tab'] == 1) $header_name = '습득물 등록';
        else $header_name = '분실물 등록';
        break;
    case "lost_report" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '습득물 등록';
        break;
    case "lost_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '분실물 내용';
        break;
    case "video" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '설교영상';
        break;
    case "video_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '설교영상 등록';
        break;
    case "setting" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '설정';
        break;
    case "inquiry" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '문의하기';
        break;
    case "inquiry_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '문의하기';
        break;
    case "faq" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '자주하는질문';
        break;
    case "faq_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '자주하는질문';
        break;
}

$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://"
    . $_SERVER['HTTP_HOST']
    . $_SERVER['REQUEST_URI'];
//$relativeUrl = str_replace($jl->URL, '', $currentUrl);
$site_setting_model = new JlModel("site_setting");
$site_setting = $site_setting_model->orderBy("idx","DESC")->get()['data'][0];
?>


<script src="<?php echo G5_URL; ?>/app/js/sweetalert2.all.min.js"></script>
<script src="<?php echo G5_URL; ?>/app/js/ui.js"></script>
<link href="<?php echo G5_URL; ?>/app/css/style.css?v=<?php echo date('Y h:i:s A'); ?>" rel="stylesheet" type="text/css"><!--app-->
<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<?php if ($header_type == 0) { ?>

<?php } else if ($header_type == 1) { ?>
<header id="header" <? if($pid=='index') { echo 'class="index"';}?>>
    <a class="hd_logo" href="<?php echo G5_URL ?>/app">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.svg" alt="임마누엘 교회">
    </a>
    <a class="hd_title">
        <?=$header_name?>
    </a>
    <div class="flex gap10 ai-c">
        <?php if ($pid == 'index') {  ?>
            <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <?php }  ?>
                <a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃">로그아웃</a>
            <?php } else {  ?>
                <a href="<?php echo G5_BBS_URL ?>/login.php?url=<?=$currentUrl?>" title="로그인">로그인</a></li>
                <a href="<?php echo G5_BBS_URL ?>/register.php" title="회원가입">회원가입</a>
            <?php }  ?>
        <?php }  ?>
        <label for="sideToggle"><input type="checkbox" id="sideToggle"><i class="fa-solid fa-bars"></i> </label>
    </div>
</header>


    <div class="side-menu" id="sideMenu">
        <button type="button" class="btn" id="closeMenu">&times;</button>
        <div id="gnb">
            <div class="flex ai-c box_blue gap10">
            <?php if ($is_member) {  ?>
                <p>
                    <?php echo htmlspecialchars($member['mb_name']) ; ?>
                    <span> 로그인 중</span>
                </p>
                <button type="button" class="btn btn-mini btn-gray male-auto" onclick="location.href='<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php&module=app'">마이페이지</button>
            <?php } else {  ?>
                <p>
                    <span> 로그인이 필요합니다.</span>
                </p>
                <button type="button" class="btn btn-mini btn-gray male-auto" onclick="location.href='<?php echo G5_BBS_URL ?>/login.php?url=<?=$currentUrl?>'">로그인</button>
            <?php }  ?>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#webMenu" aria-controls="webMenu" role="tab" data-toggle="tab">WEB</a></li>
                <li role="presentation"><a href="#appMenu" aria-controls="appMenu" role="tab" data-toggle="tab">APP</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="webMenu">
                    <div class="menu">
                        <h6>교회 소개</h6>
                        <ul>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_01">교회비전</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_02">섬기는 사람들</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05">교회안내</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">행사안내</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_08">온라인 헌금</a></li>
                        </ul>
                        <h6>새가족</h6>
                        <ul>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub02_01">새가족 등록</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub02_02">커리큘럼</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub02_03">컨텐츠</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub02_04">인터뷰</a></li>
                        </ul>
                        <h6>다음세대</h6>
                        <ul>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_01_main">Linkers</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_02_main">교육부</a></li>
                        </ul>
                        <h6>선교</h6>
                        <ul>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_main">해외선교</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_02">군선교</a></li>
                        </ul>
                        <h6>매거진</h6>
                        <ul>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub06_05">Webzine</a></li>
                        </ul>
                        <hr>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="appMenu">
                    <div class="menu">
                        <h6>설교영상</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/video">목록</a></li>
                        </ul>
                        <h6>기도요청</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/prayer">목록</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/pray_form">요청/내역</a></li>
                        </ul>
                        <h6>결단노트</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/note">목록</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/note_form">작성하기</a></li>
                        </ul>
                        <h6>교우소식</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/friend">목록</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/friend_form">작성하기</a></li>
                        </ul>
                        <h6>대관신청</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/rental_hall">본당 대관</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/rental_lecture">교육관 대관</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/rental_bus">버스 사용</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/rental_equip">비품 대여</a></li>
                        </ul>
                        <h6>분실물찾기</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/lost">목록</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/lost_form?tab=1">주웠어요</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/lost_form?tab=2">잃어버렸어요</a></li>
                        </ul>
                        <h6>도우미</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/helper">목록</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/helper_form">요청하기</a></li>
                        </ul>
                        <h6>IMC 속회방</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/class">속회소식</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/class_form">속회보고</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/class_list">속회예배현황</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/class_leader">목회자탭</a></li>
                        </ul>
                        <h6>IMC 공동체</h6>
                        <ul>
                            <li><a href="<?php echo G5_URL ?>/app/union_group">교구방</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/union_mission">IMC 선교회</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/union_small">소그룹</a></li>
                            <li><a href="<?php echo G5_URL ?>/app/union_ministry">사역부서</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="menu">
                <h6>기타 서비스</h6>
                <ul>
                    <li><a href="<?php echo G5_URL ?>/app/inquiry">문의하기</a></li>
                    <li><a href="<?php echo G5_URL ?>/app/faq">자주하는질문</a></li>
                </ul>
            </div>
            <div class="icon">

                <span><a href="<?=$site_setting['sns_blog']?>" target="_blank"><img src="<?php echo G5_URL ?>/app/img/blog.png" alt="sns"></a></span>
                <span><a href="<?=$site_setting['sns_insta']?>" target="_blank"><img src="<?php echo G5_URL ?>/app/img/insta.png" alt="sns" title=""></a></span>
                <span><a href="<?=$site_setting['sns_youtube']?>" target="_blank"><img src="<?php echo G5_URL ?>/app/img/youtube.png" alt="sns" title=""></a></span>
                <span><a href="<?=$site_setting['sns_facebook']?>" target="_blank"><img src="<?php echo G5_URL ?>/app/img/facebook.png" alt="sns" title=""></a></span>
            </div>
            <div id="copy">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보취급처리방침</a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스이용약관</a>
                <?php if ($is_admin) {  ?>
                    <a href="<?php echo G5_URL ?>/app/setting">관리자</a>
                <?php }  ?>
            </div>

        </div>
    </div>

    <div class="overlay" id="overlay"></div>
    <script>
        const menuToggle = document.getElementById('sideToggle');
        const sideMenu = document.getElementById('sideMenu');
        const overlay = document.getElementById('overlay');
        const closeMenu = document.getElementById('closeMenu');

        menuToggle.addEventListener('click', () => {
            sideMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        closeMenu.addEventListener('click', () => {
            sideMenu.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            sideMenu.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>

<?php } ?>

<div id="wrapper">

