<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 로그인상태 아니면 인트로페이지 이동
if (!$is_member) {
	goto_url(G5_URL."/bbs/login.php");
    //include_once(G5_URL."/bbs/login.php");
    return;
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>


<?


$device=isDevice();

// 나이
$mb_age = (date("Y")+1) - (int)substr($member['mb_birth'], 0, 4);

// 내 소개
$mb_profile = iconv_substr($member['mb_profile'], 0, 20, "utf-8");
if (mb_strlen($member['mb_profile'], 'utf-8' ) > 20) {
    $mb_profile .= "…";
}

// 회원사진
$mb_img_info = getMemberImg($member['mb_id']);
$mb_img_src = '<img src="'.G5_THEME_IMG_URL.'/mobile/no_image.png" alt="회원이미지">';

if ($mb_img_info['cnt'] > 0 && $mb_img_info['list'][0]['src'] != "") {
    $mb_img_src = getImgSquare($mb_img_info['list'][0]['src'], 110);
}

include_once(G5_PATH."/model/model2.php");

$g5_heartM = new Model(array(
    "table" => "g5_heart",
    "primary" => "idx",
    "autoincrement" => true
));
$filter = array(
    "mb_no" => $member['mb_no']
);
$gets_config = array(
    "like" => false,
    "add_qeury" => "",
    "order_by" => "idx",
    "sort" => "desc"
);
$heart_data = $g5_heartM->get($filter,$gets_config);


$g5_couponM = new Model(array(
    "table" => "g5_coupon",
    "primary" => "idx",
    "autoincrement" => true
));
$filter = array(
    "mb_no" => $member['mb_no'],
    "use_date" => "0000-00-00 00:00:00"
);
$gets_config = array(
    "like" => false,
    "add_qeury" => "",
    "order_by" => "idx",
    "sort" => "desc"
);
$copon_data = $g5_couponM->count($filter,$gets_config);

?>

<div id="idx_container" class="new">

<div class="">

    <div class="user">
        <?=$mb_img_src?>
        <div class="txt flex">
            <div class="flex ai-c jc-bw switch_wrap">
                <p>인연 찾는중</p>
                <?
                // 회원 휴면기/진행기 on, off
                $sw_flag = strtolower(strtolower($member['mb_switch']));
                $sw_str = ($sw_flag == "on")? "checked" : " ";
                ?>
                <input type="checkbox" id="switch" <?=$sw_str?> onclick="changeMemberSwitch('<?=$member['mb_id']?>', this);" data-flag="<?=$sw_flag?>"/>
                <label for="switch">Toggle</label>
            </div>
            <div class="">
                <h5><span><?=iconv_substr($member['mb_sex'], 0, 1, "utf-8");?>자, <?=$mb_age?>세</h5>
                <div class="flex ai-c jc-sb profile">
                    <h6> </h6>
                    <h4><?=$member['mb_name']?></h4>
                </div>
            </div>
        </div>
        <div class="gear">
        </div>
        <div class="my_wrap">
            <a href="<?=G5_BBS_URL?>/register_form.php?w=u" class="edit"><i class="fas fa-cog"></i> 프로필 관리</a>
            <?php if($member['mb_sex'] == "남"){ ?>
            <div>
                <a href="<?=G5_BBS_URL?>/my_point.php" class="btn">포인트 <strong><?=$heart_data ? number_format($heart_data['mb_heart']) : 0?></strong>P</a>
                <a href="<?=G5_BBS_URL?>/my_coupon.php" class="btn">쿠폰 <strong><?=$copon_data?></strong></a>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="noti">
        <div class="counsel flex ai-c jc-sb" onclick="location.href='<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_counsel'">
            <div class="txt">
                <p><i class="fas fa-heartbeat"></i> 연애 상담이 필요하다면?</p>
                <h6>연인 상담소에 고민을 말해봐요!</h6>
            </div>
            <img src="<?=G5_THEME_IMG_URL?>/new/counsel.png">
        </div>
        <div class="article flex ai-c jc-sb" onclick="location.href='<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_notice'">
            <div class="txt">

                <p>신중하게 찾아주는 당신의 인연 "연인"</p>
                <h6>
                    <?php echo latest("theme/basic", "b_notice",1, 50); ?></h6>
            </div>
            <img src="<?=G5_THEME_IMG_URL?>/new/article.png">
        </div>
    </div>
    <div class="bann flex ai-c jc-sb">
        <div class="even" onclick="location.href='<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_event'">
            <p><span>EVENT</span></p>
            <h6>이벤트 안내</h6>
        </div>
        <div class="rule" onclick="location.href='<?php echo G5_BBS_URL; ?>/rules.php'">
            <p><span>SERVICE</span></p>
            <h6>연인 소개룰</h6>
        </div>
    </div>

    <?php

    // 헬퍼리스트 조회
    $sql = "SELECT * FROM g5_member WHERE mb_level = 10 AND mb_status = '헬퍼' AND mb_3 != 'out' ORDER BY mb_datetime DESC";
    $result = sql_query($sql);
    $result_cnt = sql_num_rows($result);

    $helper_list = array();

    for ($i = 0; $i < $result_cnt; $i++) {
        $helper_list[$i] = sql_fetch_array($result);
    }
    ?>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <?
            foreach ($helper_list as $key=>$row) {
                $onoff_flag = ($row['mb_3'] == "on")? "checked" : "";

                // 헬퍼이미지
                $rs = sql_fetch("SELECT mi_img FROM g5_member_img WHERE mb_id = '{$row['mb_id']}'");
                $img_name = $rs['mi_img'];
                $img_url = MB_IMG_URL."/".$img_name;

                $helper_img = getImgSquare($img_url, $base_size=100);

                // 1:1상담신청 링크
                $helper_link = "javascript:alert('상담신청 준비중입니다.');";
                if ($row['mb_2'] != "") {
                    $helper_link = preg_replace("/\s+/","", $row['mb_2']);
                }
                ?>
                <div class="swiper-slide">
                    <div class="cont">
                        <div class="mem_photo">
                            <div class="mem"><?=$helper_img?></div>
                            <div class="suc">매칭♥성공<br><span><?=number_format(getMatchingCnt($row['mb_id']))?></span></div>
                        </div>
                        <div class="mem_cont">
                            <h6><span>HELPER</span> <?=$row['mb_name']?></h6>
                            <p><?=$row['mb_profile']?></p>
                            <span><?=$row['mb_4']?> | <?=$row['mb_1']?></span>
                        </div>
                    </div>
                    <div class="gear">
                    </div>
                    <a href="<?php echo $device=="ios"?"javascript:helperLink('".$helper_link."');":$helper_link;?>" class="edit">헬퍼 1:1 상담 신청</a>
                </div>
            <? } ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
            effect : 'fade',
            fadeEffect: { crossFade: true },
        });
    </script>
</div>

<?/*php } else {?>

    <div class="visual text-center">
        <h2><img src="<?php echo G5_THEME_IMG_URL; ?>/mobile/channel_t.png" alt="신중하게 찾아주는 당신의인연" style="width:250px"></h2>
        <div class="m_btn_area">
            <h3><span>"연인"</span>에서 만나 인연이 연인으로</h3>
            <ul class="mbtn">
                <li><a href="<?php echo G5_BBS_URL; ?>/helper.php"><span></span>헬퍼프로필</a></li><!--
                 --><li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_counsel"><span></span>연애상담소</a></li><!--
                 --><li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice"><span></span>공지사항</a></li><!--
                 --><li><a href="<?php echo G5_BBS_URL ?>/channel.php"><span></span>카카오채널</a></li>
            </ul>
        </div>
    </div>

<?php }*/?>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>