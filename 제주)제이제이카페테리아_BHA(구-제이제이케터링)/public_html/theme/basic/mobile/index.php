<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 메인화면 최신글 시작 -->
<?php
//  최신글
$sql = " select bo_table
            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
            where a.bo_device <> 'pc' ";
if(!$is_admin)
    $sql .= " and a.bo_use_cert = '' ";
$sql .= " order by b.gr_order, a.bo_order ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 스킨은 입력하지 않을 경우 관리자 > 환경설정의 최신글 스킨경로를 기본 스킨으로 합니다.

    // 사용방법
    // latest(스킨, 게시판아이디, 출력라인, 글자수);
    //echo latest('theme/basic', $row['bo_table'], 5, 25);
}
?>
<!-- 메인화면 최신글 끝 -->


<div id="main">
    <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=carte&is_day=1">
        <img src="<?php echo G5_THEME_IMG_URL ?>/icon01.png" alt="">
        <br />오늘의 메뉴
    </a>

    <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=carte" class="color">
        <img src="<?php echo G5_THEME_IMG_URL ?>/icon02.png" alt="">
        <br />주간식단표
    </a>

    <a href="<?php echo G5_BBS_URL; ?>/survey.php">
        <img src="<?php echo G5_THEME_IMG_URL ?>/icon05.png" alt="">
        <br />설문조사
    </a>

    <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qna" class="color">
        <img src="<?php echo G5_THEME_IMG_URL ?>/icon06.png" alt="">
        <br />의견남기기
    </a>

    <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice">
        <img src="<?php echo G5_THEME_IMG_URL ?>/icon03.png" alt="">
        <br />카페테리아 소식
    </a>

        <?php /*?><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=event" class="color"><img src="<?php echo G5_THEME_IMG_URL ?>/icon04.png" alt=""><br />야식 핫라인</a><?php */?>
</div><!--#main-->


<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>