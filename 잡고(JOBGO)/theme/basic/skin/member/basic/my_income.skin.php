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

    .mb1_write_btn{


    }
</style>


<!--마이페이지-->
<article id="mypage">
    <?php include_once($member_skin_path . '/mypage_left_menu.php'); ?>

    <?php if ($member['mb_division'] == 2){ //전문인 일때?>
    <section id="right_view">
        <h3>수익 관리</h3>

        <div id="my_income">
            <header>
                <h4>출금가능 수익금</h4>
                <p class="tot_price"><?= number_format(floor($mb['mb_6'])) ?><span>원</span><span class="account"><a href="<?php echo G5_BBS_URL ?>/my_withdraw.php">출금 신청</a></span></p>
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
                <h4 class="account_info">입금/출금 내역<span><i class="fal fa-money-check"></i> 출금정보 : <?= $bank_list[$mb['mb_1']] ?> <?= $mb['mb_3'] ?> (<?= $mb['mb_2'] ?>)</span><span class="account"><a href="javascript:$('#mb1_write_modal').modal()">수정</a></span></h4>

                <div class="wrapper">
                    <div class="tabs50 cf">
                        <ul>
                            <li id="tab1"><a href="<?php echo G5_BBS_URL ?>/my_income.php?tab=1">출금 내역</a></li>
                            <li id="tab2"><a href="<?php echo G5_BBS_URL ?>/my_income.php?tab=2">입금 내역</a></li>
                        </ul>

                        <!--출금내역-->
                        <div id="tab-content1" class="tab-content">
                            <!--출금 분류-->
                            <div class="sale_item_sort">
                                <ul>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=1"><li class="op1 check">전체(<?= $status1 ?>)</li></a>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=2"><li class="op2">대기(<?= $status2 ?>)</li></a>
                                    <!--<a href=""><li class="op3">진행(10)</li></a>-->
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=3"><li class="op3">완료(<?= $status3 ?>)</li></a>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?tab=<?=$_REQUEST['tab']?>&op=4"><li class="op4">보류(<?= $status4 ?>)</li></a>
                                </ul>
                            </div>
                            <!--//출금 분류-->

                            <!--리스트-->
                            <ul class="manage_list">
                                <li class="fl tc w5 title t_line">No.</li>
                                <li class="fl tc w45 title t_line">계좌번호/예금주</li>
                                <li class="fl tc w14 title t_line">신청일시</li>
                                <li class="fl tc w14 title t_line">지급일시</li>
                                <li class="fl tc w11 title t_line">상태</li>
                                <li class="fl tc w11 title t_line">금액</li>
                            </ul>
                            <?php
                            $k = $count;
                            for ($i = 0; $row = sql_fetch_array($result); $i++) {
                                $class = "wait";
                                $status = "대기";
                                if ($row['rp_proc'] == 1) {
                                    $class = "wait";
                                    $status = "대기";
                                } else if ($row['rp_proc'] == 2 || $row['rp_proc'] == 4) {
                                    $class = "comp";
                                    $status = "완료";
                                } else {
                                    $class = "hold";
                                    $status = "보류";
                                }
                                ?>
                                <ul class="lt_box">
                                    <li class="fl tc w5 lt lt_line ordernum"><?= $k ?></li>
                                    <li class="fl tc w45 lt lt_line">
                                    <p class="date">신청 : <?= substr($row['wr_datetime'], 0, 10) ?> / 지급 : <?= substr($row['complete_datetime'], 0, 10) ?></p>
									<?= $bank_list[$row['mb_1']] ?> <?= $row['mb_3'] ?> <?php if ($row['mb_2'] != "") echo "(".$row['mb_2'].")" ?>
                                    <p class="fee"><span class="<?=$class?>"><?=$status?></span> <?= number_format($row['rp_amt']) ?>원</p>
                                    </li>
                                    <li class="fl tc w14 lt lt_line date"><?= substr($row['wr_datetime'], 0, 10) ?></li>
                                    <li class="fl tc w14 lt lt_line date"><?= substr($row['complete_datetime'], 0, 10) ?></li>
                                    <li class="fl tc w11 lt lt_line status"><span class="<?=$class?>"><?=$status?></span></li>
                                    <li class="fl tc w11 lt lt_line fee"><?= number_format($row['rp_amt']) ?>원</li>
                                </ul>
                                <?php
                                $k--;
                            }
                            ?>
                            <!---//리스트 --->
                        </div>

                        <!--입금내역-->
                        <div id="tab-content2" class="tab-content box-article">
                            <!--리스트-->
                            <ul class="manage_list">
                                <li class="fl tc w5 title t_line">번호</li>
                                <li class="fl tc w14 title t_line">신청일시</li>
                                <li class="fl tc w14 title t_line">지급일시</li>
                                <li class="fl tc w11 title t_line">상태</li>
                                <li class="fl tc w45 title t_line">사유</li>
                                <li class="fl tc w11 title t_line">금액</li>
                            </ul>
                            <?php
                            $k = $count;
                            for($i=0; $row=sql_fetch_array($result2); $i++) {
                                $class = "wait";
                                $status = "대기";
                                if ($row['rp_proc'] == 1) {
                                    $class = "wait";
                                    $status = "대기";
                                } else if ($row['rp_proc'] == 2 || $row['rp_proc'] == 4 ) {
                                    $class = "comp";
                                    $status = "완료";
                                } else {
                                    $class = "hold";
                                    $status = "보류";
                                }
                            ?>
                            <ul class="lt_box">
                                <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                                <li class="fl tc w14 lt lt_line date"><?=substr($row['up_datetime'], 0, 10)?></li>
                                <li class="fl tc w14 lt lt_line date"><?=substr($row['complete_datetime'], 0, 10)?></li>
                                <li class="fl tc w11 lt lt_line status"><span class="<?=$class?>"><?=$status?></span></li>
                                <li class="fl tl w45 lt lt_line text-left">
                                <p class="date">신청 : <?= substr($row['up_datetime'], 0, 10) ?> / 지급 : <?= substr($row['complete_datetime'], 0, 10) ?></p>
								<?=$row['rp_memo']?>
                                <p class="fee"><span class="<?=$class?>"><?=$status?></span> <?= number_format($row['rp_amt']) ?>원</p>
                                </li>
                                <li class="fl tc w11 lt lt_line fee"><?=number_format($row['rp_amt'])?>원</li>
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
    
    <? }else if($member['mb_division'] == 1){ //일반인일때?>
    
    <section id="right_view">
        <h3>잡고 캐쉬</h3>

        <div id="my_income">
            <header>
                <!--<h4>출금가능 수익금</h4>-->
                <p class="tot_price"><?= number_format($mb['mb_6']) ?><span>원</span><span class="account"><a href="<?php echo G5_BBS_URL ?>/my_cash.php">캐쉬 충전</a></span></p>
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
                <h4 class="account_info">사용/충전 내역<span><!--<i class="fal fa-money-check"></i> 출금정보 : <?= $bank_list[$mb['mb_1']] ?> <?= $mb['mb_3'] ?> (<?= $mb['mb_2'] ?>)</span>--></h4>

                <div class="wrapper">
                    <div class="tabs50 cf">
                        <ul>
                            <li id="tab1"><a href="<?php echo G5_BBS_URL ?>/my_income.php?tab=1">사용 내역</a></li>
                            <li id="tab2"><a href="<?php echo G5_BBS_URL ?>/my_income.php?tab=2">충전 내역</a></li>
                        </ul>

                        <!--사용내역-->
                        <div id="tab-content1" class="tab-content">

                            <!--리스트-->
                            <ul class="manage_list">
                                <li class="fl tc w5 title t_line">No.</li>
                                <li class="fl tc w59 title t_line">내용</li>
                                <li class="fl tc w14 title t_line">일시</li>
                                <!--<li class="fl tc w14 title t_line">지급일시</li>-->
                                <li class="fl tc w11 title t_line">상태</li>
                                <li class="fl tc w11 title t_line">금액</li>
                            </ul>
                            <?php
                            $k = $count-($rows*($page-1)); // 글번호
                            for ($i = 0; $row = sql_fetch_array($result); $i++) {


                                $class = "wait";
                                $status = "대기";
                                if ($row['rp_proc'] == 1) {
                                    $class = "wait";
                                    $status = "대기";
                                } else if ($row['rp_proc'] == 2) {
                                    $class = "comp";
                                    $status = "완료";
                                } else {
                                    $class = "hold";
                                    $status = "보류";
                                }
                             ?>
                                <ul class="lt_box">
                                    <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                                    <li class="fl tc w59 lt lt_line">
                                    <p class="date">일시 : <?= substr($row['wr_datetime'], 0, 10) ?></p>
									<?=$row['ph_content']?>
                                    <p class="fee"><span class="<?=$class?>"><?=$status?></span> <?=number_format($row['ph_amt'])?>원</p>
                                    </li>
                                    <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                                    <li class="fl tc w11 lt lt_line status"><span class="<?=$class?>"><?=$status?></span></li>
                                    <li class="fl tc w11 lt lt_line fee"><?=number_format($row['ph_amt'])?></li>
                                </ul>
                            <?php
                                $k--;
                            }
                             ?>
                            <!---//리스트 --->
                        </div>

                        <!--충전내역-->
                        <div id="tab-content2" class="tab-content box-article">
                            <!--리스트-->
                            <ul class="manage_list">
                                <li class="fl tc w5 title t_line">번호</li>
                                <li class="fl tc w14 title t_line">신청일시</li>
                                <li class="fl tc w14 title t_line">지급일시</li>
                                <li class="fl tc w11 title t_line">상태</li>
                                <li class="fl tc w45 title t_line">내용</li>
                                <li class="fl tc w11 title t_line">금액</li>
                            </ul>
                            <?php
                            $k = $count-($rows*($page-1)); // 글번호
                            for($i=0; $row=sql_fetch_array($result2); $i++) {
                                ?>
                                <ul class="lt_box">
                                    <li class="fl tc w5 lt lt_line ordernum"><?=$k?></li>
                                    <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                                    <li class="fl tc w14 lt lt_line date"><?=substr($row['wr_datetime'], 0, 10)?></li>
                                    <li class="fl tc w11 lt lt_line status"><span class="comp">완료</span></li>
                                    <li class="fl tl w45 lt lt_line text-left">
                                        <p class="date">신청 : <?= substr($row['wr_datetime'], 0, 10) ?> / 지급 : <?= substr($row['wr_datetime'], 0, 10) ?></p>
                                        <!--캐쉬 --><?//=number_format($row['ph_amt'])?><!--원 충전되었습니다.-->
                                        <?=$row['ph_content']?>
                                        <p class="fee"><span class="comp">완료</span> <?= number_format($row['ph_amt']) ?>원</p>
                                    </li>
                                    <li class="fl tc w11 lt lt_line fee"><?=number_format($row['ph_amt'])?>원</li>
                                </ul>
                                <?php
                            ?>
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
    
    <?php } ?>

</article>

<!-- 계좌번호 MODAL -->
<div class="accountModal modal fade" id="mb1_write_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fal fa-credit-card"></i>&nbsp;계좌번호 등록</h4>
            </div>

            <div class="modal-body">
                <div id="my_income" style="margin:15px 0">
                    <div class="income_list" style="margin:0">
                        <h4 class="account_info">입금계좌가 등록되지 않았습니다.<br>입금계좌 및 예금주를 등록해주세요.</h4>
                    </div>
                </div>
                <div class="withdraw_appli" style="padding:0; border:0">
                    <dl>
                        <dt>예금주</dt>
                        <dd><input type="text" style="width: 120px" name = 'mb_2' value="<?=$member['mb_2']?>" placeholder="예금주">
                            <select name="mb_1" style="width: 100px" class="select <?php echo $required ?>" id="mb_1" title="은행 선택" >
                                <option value="" hidden>은행 선택</option>
                                <!--normal select-->
                                <option value="">은행명</option>
                                <? foreach ($bank_list as $code=>$name) { ?>
                                    <option value="<?=$code?>" <? if ($code == $member['mb_1']) echo "selected"; ?>><?=$name?></option>
                                <? } ?>
                            </select>
                        </dd>
                    </dl>
                    <!--<dl>
                        <dt>수수료</dt>
                        <dd>50,000원</dd>
                    </dl>-->
                    <dl>
                        <dt>계좌번호</dt>
                        <dd><input name = 'mb_3' type="text" value="<?=$member['mb_3']?>" placeholder="계좌번호"></dd>
                    </dl>
                    <!--<dl>
                        <dt>최종 출금 금액</dt>
                        <dd class="tot"><span id="modal_total_withdraw_fee">0원</span></dd>
                    </dl>-->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="mb_1_write();">계좌 등록하기</button>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //계좌번호 MODAL-->
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

    function mb_1_write() {
        var mb_1 = $('[name = mb_1]').val(),
            mb_2 = $('[name = mb_2]').val(),
            mb_3 = $('[name = mb_3]').val();

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            type: "POST",
            data: {
                mode : "mb_1_write",
                mb_1 : mb_1,
                mb_2 : mb_2,
                mb_3 : mb_3
            },
            dataType: "json",
            success: function (data) {

                if (data.code == "success") {
                    swal("계좌가 수정되었습니다.").then(function(){
                        location.href = location.href
                    });

                }else{
                    swal("오류입니다. 다시 시도해주세요. ");
                }
            },
        });
    }
</script>