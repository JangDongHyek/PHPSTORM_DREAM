<?php
$sub_menu = 200200;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

include_once('../head.sub.php');

$row = sql_fetch("SELECT * FROM g5_member WHERE mb_id = '{$_GET['mb_id']}'");
if (!$row) die("존재하지 않는 기사정보 입니다.");

// 사인서명조회
$sign_url = false;
if (!empty($row['mb_5'])) {
    $img_path = G5_SIGN_PATH . "/" . $row['mb_5'];
    if (file_exists($img_path)) $sign_url = G5_SIGN_URL . "/" . $row['mb_5'];
}
// 이름서명 조회
$nm_sign_url = false;
if (!empty($row['mb_12'])) {
    $img_path = G5_SIGN_PATH . "/" . $row['mb_12'];
    if (file_exists($img_path)) $nm_sign_url = G5_SIGN_URL . "/" . $row['mb_12'];
}


?>

<style>
#contract_wrap {padding: 20px; font-size: 14px; font-family: 'Noto Sans KR','Spoqa Han Sans', sans-serif}
#contract_wrap .title {font-size: 1.5em; font-weight: bold;}
#contract_wrap .top_box {border: 1px solid #e4eaec; background: #f7f7f7; padding: 10px; margin: 20px 0;}
#contract_wrap .top_box p {line-height: 2em;]}
#contract_wrap p {padding: 0; line-height: 1.5;}
.btn_print {padding: 10px 20px; border: 0; background: #ff3061; color: white; margin: 0 0 10px; font-size: 1.2em;}
.driver_sign, .name_sign {height: 60px;}
#contract_wrap .footer {text-align: center; margin: 50px 0 20px;}
#contract_wrap .footer .row {margin: 5px 0;}
.ja_date {font-weight: bold; margin: 20px 0;}
</style>


<div id="contract_wrap">
    <button type="button" class="btn_print" onclick="print()">출력하기</button>
    <p class="title">콜 위탁 수행 이행계약서 탁송, 대리운전 T대리 어플리케이션 T대리점 및 기사 운영 계약서</p>
    <div class="top_box">
    <p>- (갑)상호(회사명) : 주식회사 티대리</p>
    <p>- 사업자 등록번호 : 735-86-01545</p>
    <p>- (을) 성명 : <span id="cont_name"><?=$row['mb_name']?></span></p>
    <p>- 주민번호(앞자리 6) : <span id="cont_jumin"><?=$row['mb_4']?></span></p>
    <p>- T대리 분양몰 id : <span id="cont_id"><?=$row['mb_hp']?></span></p>
    <p>- 휴대폰번호 : <span id="cont_hp"><?=$row['mb_hp']?></span></p>
    </div>

    <?
    // 계약서 내용
    include_once (G5_BBS_PATH."/contract_driver.php");
    ?>

    <div class="footer">
        <!-- 계약일자 -->
        <div class="ja_date"><?=date("Y년 m월 d일", strtotime($row['mb_datetime']))?></div><!--.ja_date-->

        <!-- 갑-->
        <div class="row">
            <span>주식회사 티대리</span>
            <span>(인)</span>
            <img src="../img/tdae_dojang.gif" class="driver_sign">
        </div>

        <!-- 을 -->
        <div class="row">
            <!-- 이름 -->
            <?if ($sign_url!=false) { ?>
            <img src="<?=$nm_sign_url?>" class="name_sign">
            <? } else { ?>
            <span><?=$row['mb_name']?></span><!-- 이름서명없으면 텍스트 -->
            <? } ?>

            <span>(인)</span>

            <!-- 사인 -->
            <?if ($sign_url!=false) { ?>
            <img src="<?=$sign_url?>" class="driver_sign">
            <? } ?>
        </div>
    </div>
</div>

<?php
include_once('../head.tail.php');
?>