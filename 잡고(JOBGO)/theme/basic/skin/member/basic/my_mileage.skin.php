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
</style>


<!--마이페이지-->
<article id="mypage">
    <?php include_once($member_skin_path . '/mypage_left_menu.php'); ?>

    <section id="right_view">
        <h3>재능 마일리지</h3>

        <div id="my_income">
            <header>
                <h4>전체 마일리지</h4>
                <p class="tot_price"><?=number_format($mb['mb_7'])?><span>원</span><span class="account"><a href="<?php echo G5_BBS_URL ?>/my_purchase.php">마일리지 구매</a></span></p>
            </header>
            <!--잡고캐쉬
                    <div class="cash_idx">
                            <ul>
                                <li>
                                    <a href="<?= G5_BBS_URL ?>/my_item.php"><dl>
                                        <dt>출금가능 캐쉬</dt>
                                        <dd>2,500,000<span>원</span><span class="account">출금하기</span></dd>
                                    </dl></a>
                                </li>
                                <li>
                                    <a href="<?= G5_BBS_URL ?>/my_contest.php"><dl>
                                        <dt>예상수익금</dt>
                                        <dd>250,000<span>원</span></dd>
                                    </dl></a>
                                </li>
                                <li>
                                    <a href="<?= G5_BBS_URL ?>/my_inquiry.php"><dl>
                                        <dt>출금완료 수익금</dt>
                                        <dd>350,000<span>원</span></dd>
                                    </dl></a>
                                </li>
                            </ul>
                    </div>-->
            <!--//잡고캐쉬-->
            <div class="income_list">
                <h4 class="account_info">사용/입금 내역</h4>

                <div class="wrapper">
                    <div class="tabs50 cf">
                    
                    <ul>
                        <li id="tab1"><a href="<?php echo G5_BBS_URL ?>/my_mileage.php?tab=1">사용 내역</a></li>
                        <li id="tab2"><a href="<?php echo G5_BBS_URL ?>/my_mileage.php?tab=2">입금 내역</a></li>
                    </ul>


                        <!--출금내역-->
                        <div id="tab-content1" class="tab-content">

                            <!--리스트-->
                            <ul class="manage_list">
                                <li class="fl tc w5 title t_line">번호</li>
                                <li class="fl tc w14 title t_line">사용일시</li>
                                <li class="fl tc w20 title t_line">상품</li>
                                <li class="fl tc w50 title t_line">내용</li>
                                <li class="fl tc w11 title t_line">금액</li>
                            </ul>
                            <?php
                            $k = $count-($rows*($page-1)); // 글번호
                            for($i=0; $row=sql_fetch_array($result); $i++) {
                                $class = '';
                                $category = '';
                                if($row['ad_category'] == '1') {
                                    $class = 'charge';
                                    $category = '메인 상단 배너';
                                }else if($row['ad_category'] == '2') {
                                    $class = 'accum';
                                    $category = '메인 하단 배너';
                                }
                                else if($row['ad_category'] == '3') {
                                    $class = 'accum';
                                    $category = '카테고리 배너';
                                }
                                ?>
                                <ul class="lt_box">
                                    <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                                    <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                                    <li class="fl tc w20 lt lt_line status"><span class="<?=$class?>"><?=$category?></span></li>
                                    <li class="fl tl w50 lt lt_line text-left">
                                        <p class="date"><?=substr($row['wr_datetime'], 0, 10)?></p>
                                        <?php if ($row['ad_category'] != null ){ ?>
                                        <?=$category?>를 구입 하였습니다,
                                        <?php }else{ ?>
                                        취소로 인한 마일리지 차감.
                                        <?php } ?>
                                        <p class="fee"><span class="<?=$class?>"><?=$category?></span> <?=number_format($row['ad_fee'])?>원</p>
                                    </li>
                                    <li class="fl tc w11 lt lt_line fee"><?= ($row['ad_category'] != null ) ? number_format($row['ad_fee']) : number_format($row['mileage']) ?>원</li>
                                </ul>
                                <?php
                                $k--;
                            }

                            ?>
                            <!---//리스트 --->
                        </div>

                        <!--입금내역-->
                        <div id="tab-content2" class="tab-content box-article">
                            <!--입금 분류-->
                            <div class="sale_item_sort">
                                <ul>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=1"><li class="op1 check">전체(<?= $status1 ?>)</li></a>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=2"><li class="op2">적립(<?= $status2 ?>)</li></a>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=3"><li class="op3">구매(<?= $status3 ?>)</li></a>
                                </ul>
                            </div>
                            <!--//입금 분류-->
                            <!--리스트-->
                            <ul class="manage_list">
                                <li class="fl tc w5 title t_line">번호</li>
                                <li class="fl tc w14 title t_line">지급일시</li>
                                <li class="fl tc w11 title t_line">상태</li>
                                <li class="fl tc w59 title t_line">내용</li>
                                <li class="fl tc w11 title t_line">금액</li>
                            </ul>
                            <?php
                            $k = $count-($rows*($page-1)); // 글번호
                            for($i=0; $row=sql_fetch_array($result2); $i++) {
                                $class = '';
                                if($row['category'] == '적립') {
                                    $class = 'accum';
                                }
                                else if($row['category'] == '구매') {
                                    $class = 'charge';
                                }
                            ?>
                            <ul class="lt_box">
                                <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                                <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'],0,10)?></li>
                                <li class="fl tc w11 lt lt_line status"><span class="<?=$class?>"><?=$row['category']?></span></li>
                                <li class="fl tl w59 lt lt_line text-left">
                                    <p class="date"><?=substr($row['wr_datetime'],0,10)?></p>
                                    마일리지 <?=number_format($row['mileage'])?>원 <?=$row['category']?>되었습니다.
                                    <p class="fee"><span class="<?=$class?>"><?=$row['category']?></span> <?=number_format($row['mileage'])?>원</p>
                                </li>
                                <li class="fl tc w11 lt lt_line fee"><?=number_format($row['mileage'])?>원</li>
                            </ul>
                            <?php
                                $k--;
                            }
                            ?>
                            <!---//리스트 --->
                        </div>

                    </div><!--//tabs-->
                </div>
            </div>
        </div>
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'] . '?tab='.$_REQUEST['tab'].'&op=' . $op); ?>
    </section>
</article>

<script>
    $(function () {
        <?php if ($tab != "") { ?>
        $('#tab<?=$tab?>').prop("checked", true);
        <?php } ?>

        $('.sale_item_sort li').removeClass('check');
        $('.op<?=$op?>').addClass('check');
    });

    // 탭 처리
    function a_tab(id) {
        location.href = g5_bbs_url + "/my_income.php?tab="+id
    }
</script>