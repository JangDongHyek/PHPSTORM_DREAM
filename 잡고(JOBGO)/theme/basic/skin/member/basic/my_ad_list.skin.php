<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="' . $member_skin_url . '/js/epggea.js"></script>', 100);
?>

<style>
    .box-article .box-body .row {
        background: #fff
    }

    .tab-content {
        display: none;
        float: left;
        width: 100%;
        padding: 0 0 1em 0;
        background: #fff;
    }

    #reply {
        display: none
    }
</style>


<!--마이페이지-->

<article id="mypage">

    <?php include_once($member_skin_path . '/mypage_left_menu.php'); ?>

    <section id="right_view">
        <h3>광고 관리 </h3>

        <!--광고 신청-->
        <div class="wrapper">
            <div class="tabs cf">

                <ul class="forth">
                    <li id="tab1"><a href="<?php echo G5_BBS_URL ?>/my_ad_list.php?tab=1">메인 상단</a></li>
                    <li id="tab2"><a href="<?php echo G5_BBS_URL ?>/my_ad_list.php?tab=2">메인 하단</a></li>
                    <li id="tab3"><a href="<?php echo G5_BBS_URL ?>/my_ad_list.php?tab=3">카테고리 상단</a></li>
                    <li id="tab4"><a href="<?php echo G5_BBS_URL ?>/my_ad_list.php?tab=4">플러스</a></li>
                </ul>

                <!--메인 상단-->
                <div id="tab-content1" class="tab-content">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>광고 잔여 일</dt>
                                    <dd><?=$d_day?><span>일</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php"><span class="account">광고 신청</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <p class="t_margin25">※ 현재 메인페이지 상단에 <span>노출중</span>입니다.</p>
                    <!--리스트-->
                    <?php
                    if($count > 0) {
                    ?>
                    <ul class="manage_list">
                        <li class="fl tc w5 title t_line">번호</li>
                        <li class="fl tc w14 title t_line">사용일시</li>
                        <li class="fl tc w20 title t_line">상태</li>
                        <li class="fl tc w50 title t_line">내용</li>
                        <li class="fl tc w11 title t_line">금액</li>
                    </ul>
                    <?php
                    }
                    else {
                    ?>
                    <div class="text-center empty_list">
                        <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                        <p class="t_padding17">현재 신청중인 광고가 없습니다.</p>
                    </div>
                    <?php
                    }

                    $k = $count-($rows*($page-1)); // 글번호
                    for($i=0; $row=sql_fetch_array($result); $i++) {
                        if($row['ad_status'] == '진행대기') { $status_class = 'wait'; }
                        else if($row['ad_status'] == '진행중') { $status_class = 'ing'; }
                        else if($row['ad_status'] == '진행종료') { $status_class = 'comp'; }
                    ?>
                    <ul class="lt_box">
                        <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                        <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                        <li class="fl tc w20 lt lt_line status"><span class="<?=$status_class?>"><?=$row['ad_status']?></span></li>
                        <li class="fl tl w50 lt lt_line text-left">
                            <p class="date"><?=substr($row['wr_datetime'], 0, 10)?></p>
                            메인 상단 배너를 구입 하였습니다.
                            <p class="fee"><span class="<?=$status_class?>"><?=$row['ad_status']?></span> <?=number_format($row['ad_fee'])?>원</p>
                        </li>
                        <li class="fl tc w11 lt lt_line fee"><?=number_format($row['ad_fee'])?>원</li>
                    </ul>
                    <?php
                        $k--;
                    }
                    ?>
                    <!---//리스트 --->
                </div>

                <!--메인 하단-->
                <div id="tab-content2" class="tab-content box-article">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>광고 잔여 일</dt>
                                    <dd><?=$d_day?><span>일</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php"><span class="account">광고 신청</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <!--리스트-->
                    <?php
                    if($count > 0) {
                    ?>
                    <ul class="manage_list">
                        <li class="fl tc w5 title t_line">번호</li>
                        <li class="fl tc w14 title t_line">사용일시</li>
                        <li class="fl tc w20 title t_line">상태</li>
                        <li class="fl tc w50 title t_line">내용</li>
                        <li class="fl tc w11 title t_line">금액</li>
                    </ul>
                    <?php
                    } else {
                    ?>
                    <div class="text-center empty_list">
                        <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                        <p class="t_padding17">현재 신청중인 광고가 없습니다.</p>
                    </div>
                    <?php
                    }

                    $k = $count-($rows*($page-1)); // 글번호
                    for($i=0; $row=sql_fetch_array($result2); $i++) {
                        if($row['ad_status'] == '진행대기') { $status_class = 'wait'; }
                        else if($row['ad_status'] == '진행중') { $status_class = 'ing'; }
                        else if($row['ad_status'] == '진행종료') { $status_class = 'comp'; }
                        ?>
                        <ul class="lt_box">
                            <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                            <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                            <li class="fl tc w20 lt lt_line status"><span class="<?=$status_class?>"><?=$row['ad_status']?></span></li>
                            <li class="fl tl w50 lt lt_line text-left">
                                <p class="date"><?=substr($row['wr_datetime'], 0, 10)?></p>
                                메인 하단 배너를 구입 하였습니다.
                                <p class="fee"><span class="<?=$status_class?>"><?=$row['ad_status']?></span> <?=number_format($row['ad_fee'])?>원</p>
                            </li>
                            <li class="fl tc w11 lt lt_line fee"><?=number_format($row['ad_fee'])?>원</li>
                        </ul>
                    <?php
                        $k--;
                    }
                    ?>
                    <!---//리스트 --->
                </div>

                <!--카테고리 상단-->
                <div id="tab-content3" class="tab-content">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>광고 잔여 일</dt>
                                    <dd><?=$d_day?><span>일</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php"><span class="account">광고 신청</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <!--리스트-->
                    <?php
                    if($count > 0) {
                    ?>
                    <ul class="manage_list">
                        <li class="fl tc w5 title t_line">번호</li>
                        <li class="fl tc w14 title t_line">사용일시</li>
                        <li class="fl tc w20 title t_line">상태</li>
                        <li class="fl tc w50 title t_line">내용</li>
                        <li class="fl tc w11 title t_line">금액</li>
                    </ul>
                    <?php
                    } else {
                    ?>
                    <div class="text-center empty_list">
                        <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                        <p class="t_padding17">현재 신청중인 광고가 없습니다.</p>
                    </div>
                    <?php
                    }

                    $k = $count-($rows*($page-1)); // 글번호
                    for($i=0; $row=sql_fetch_array($result4); $i++) {
                        if($row['ad_status'] == '진행대기') { $status_class = 'wait'; }
                        else if($row['ad_status'] == '진행중') { $status_class = 'ing'; }
                        else if($row['ad_status'] == '진행종료') { $status_class = 'comp'; }
                        ?>
                        <ul class="lt_box">
                            <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                            <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                            <li class="fl tc w20 lt lt_line status"><span class="<?=$status_class?>"><?=$row['ad_status']?></span></li>
                            <li class="fl tl w50 lt lt_line text-left">
                                <p class="date"><?=substr($row['wr_datetime'], 0, 10)?></p>
                                카테고리 상단 배너를 구입 하였습니다.
                                <p class="fee"><span class="<?=$status_class?>"><?=$row['ad_status']?></span> <?=number_format($row['ad_fee'])?>원</p>
                            </li>
                            <li class="fl tc w11 lt lt_line fee"><?=number_format($row['ad_fee'])?>원</li>
                        </ul>
                        <?php
                        $k--;
                    }
                    ?>
                    <!---//리스트 --->
                </div>
                
                <!--플러스 광고-->
                <div id="tab-content4" class="tab-content">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>광고 잔여 일</dt>
                                    <dd><?=$d_day?><span>일</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php"><span class="account">광고 신청</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <!--리스트-->
                    <?php
                    if($count > 0) {
                    ?>
                    <ul class="manage_list">
                        <li class="fl tc w5 title t_line">번호</li>
                        <li class="fl tc w14 title t_line">사용일시</li>
                        <li class="fl tc w20 title t_line">상태</li>
                        <li class="fl tc w50 title t_line">내용</li>
                        <li class="fl tc w11 title t_line">금액</li>
                    </ul>
                    <?php
                    } else {
                    ?>
                    <div class="text-center empty_list">
                        <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                        <p class="t_padding17">현재 신청중인 광고가 없습니다.</p>
                    </div>
                    <?php
                    }

                    $k = $count-($rows*($page-1)); // 글번호
                    for($i=0; $row=sql_fetch_array($result3); $i++) {
                        if($row['ad_status'] == '진행대기') { $status_class = 'wait'; }
                        else if($row['ad_status'] == '진행중') { $status_class = 'ing'; }
                        else if($row['ad_status'] == '진행종료') { $status_class = 'comp'; }
                        ?>
                        <ul class="lt_box">
                            <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                            <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                            <li class="fl tc w20 lt lt_line status"><span class="<?=$status_class?>"><?=$row['ad_status']?></span></li>
                            <li class="fl tl w50 lt lt_line text-left">
                                <p class="date"><?=substr($row['wr_datetime'], 0, 10)?></p>
                                카테고리 상단 배너를 구입 하였습니다.
                                <p class="fee"><span class="<?=$status_class?>"><?=$row['ad_status']?></span> <?=number_format($row['ad_fee'])?>원</p>
                            </li>
                            <li class="fl tc w11 lt lt_line fee"><?=number_format($row['ad_fee'])?>원</li>
                        </ul>
                        <?php
                        $k--;
                    }
                    ?>
                    <!---//리스트 --->
                </div>

            </div><!--//tabs-->
        </div>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'] . '?tab='.$_REQUEST['tab']); ?>

    </section>

</article>

<script>
    $(function () {
        <?php if ($tab != "") { ?>
        $('#tab<?=$tab?>').prop("checked", true);
        <?php } ?>
    });
</script>

