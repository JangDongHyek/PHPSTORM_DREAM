<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);

if(!$_REQUEST['tab']){
    header('Location: '.G5_BBS_URL.'/my_item.php?tab=1',true,301);
}

?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
</style>


<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>


    <?php if ($member['mb_division'] == 2){ //전문인 일때?>
        <section id="right_view">
            <h3>재능 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                    <ul>
                        <li id="tab1"><a href="javascript:a_tab('1');">등록한 재능<span class="badge"><?=$talent_cnt['cnt']?></span></a></li>
                        <li id="tab2"><a href="javascript:a_tab('2');">판매한 재능<span class="badge"><?=$sale_status1?></span></a></li>
                        <li id="tab3"><a href="javascript:a_tab('3');">찜한재능<span class="badge"><?=$like_total?></span></a></li>
                    </ul>

                    <!--등록한 재능-->
                    <div id="tab-content1" class="tab-content">

                        <div id="my_goods">
                            <div class="in">
                                <div class="list cf">
                                    <?php
                                    if (sql_num_rows($talent_result) > 0){
                                        for ($i = 0; $row = sql_fetch_array($talent_result); $i++){
                                            $row['page_type'] = 'update';
                                            include(G5_BBS_PATH."/li_content.php");
                                        ?>

                                    <?php }
                                    }else{ ?>
                                        <div class="text-center empty_list">
                                            <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                            <p class="t_padding17">등록한 재능이 없습니다.</p>
                                        </div>
                                   <?php }?>
                                </div><!--list-->
                            </div><!--in-->
                        </div>

                    </div>

                    <!--판매한 재능-->
                    <div id="tab-content2" class="tab-content box-article">

                        <div id="item_review">
                            <!--판매관리분류-->
                            <div class="sale_item_sort">
                                <ul>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=2&op=1"><li class="op1 check">전체(<?=number_format($sale_status1)?>)</li></a>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=2&op=2"><li class="op2">진행대기(<?=number_format($sale_status2)?>)</li></a>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=2&op=3"><li class="op3">진행중(<?=number_format($sale_status3)?>)</li></a>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=2&op=4"><li class="op4">완료(<?=number_format($sale_status4)?>)</li></a>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=2&op=5"><li class="op5">취소(<?=number_format($sale_status5)?>)</li></a>
                                </ul>
                            </div>
                            <!--판매관리분류-->
                            <div class="in">
                                <div class="rev cf">
                                    <?php
                                    for($i=0; $row=sql_fetch_array($sale_result); $i++) {
                                        // 진행 시작일에 맞춰서 남은 시간 계산 필요 (진행시작일 + 작업일)
                                        $d_day = '';
                                        if($row['status'] == '진행중') {
                                            $status_date = substr($row['status_date'],0,10); // 진행시작일

                                            $timestamp = strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days"); // 진행시작일 + 작업일
                                            $end_date = date('Y-m-d', $timestamp); // 진행종료일(예정)

                                            $d_day = ( strtotime($end_date) - strtotime(date('Y-m-d')) ) / 86400; // 남은 일자 계산
                                        }
                                        /*else if($row['status'] == '완료') {
                                            $expected_date = date('Y-m-d', strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days")); // 진행종료일(예정)
                                            if(substr($row['end_date'],0,10) <= $expected_date) { // 예정일 전에 작업이 끝났거나 예정일에 작업이 끝났을 경우
                                                $d_day = ( strtotime($expected_date) - strtotime(substr($row['end_date'],0,10))) / 86400; // 남은 일자 계산
                                            } else { // 예정일이 지나서 작업이 끝났을 경우
                                                $d_day = ( strtotime(substr($row['end_date'],0,10)) - strtotime($expected_date)) / 86400; // 남은 일자 계산
                                            }
                                        }*/
                                        $pta_idx = explode("-",$row["Moid"])[2];
                                        if ($pta_idx == 0 ){
                                            $row['pta_title'] = "직접입력";
                                            $row['pta_content'] = "판매자와 상의 후 입력한 금액입니다.";
                                        }
                                    ?>
                                    <div class="list cf">
                                        <a onclick="toggle_sales('sales_list<?=$i?>');">
                                            <div class="mg">
                                            <?php
                                            $file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$row['ta_idx']} order by bf_datetime limit 1 ";
                                            $file_row = sql_fetch($file_sql);

                                            if($file_row['wr_id']) { ?>
                                                <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$file_row['bf_file']?>">
                                            <?php } else { ?>
                                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                                            <?php } ?>
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="tit"><?=$row['ta_title']?></div>
                                                <div class="chat" onclick="chatting('<?=$row['ta_idx']?>', '<?=$row['mb_id']?>', '<?=$row['sale_mb_nick']?>', '<?=$row['sale_mb_id']?>')">문의채팅</div>
                                                <div class="sale_sort">
                                                    <span class="ing" id="status<?=$i?>">
                                                        <?php echo empty($row['status']) ? '진행대기' : $row['status'] ?>
                                                    </span>
                                                    <?php if($row['status'] == "완료"){ ?>
                                                        <span style="cursor: auto; margin-left: 3px" class="<?= $row['comp_chk'] != "Y" ? 'comp': "cancel";?>">구매확정 <?= $row['comp_chk'] == "Y" ? '완료': "전";?></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$row['sale_mb_nick']?></div><!--닉네임 일부분 노출-->
                                                <div class="date"><?=$row['wr_datetime']?>
                                                    <div class="pay"><?=number_format($row['Amt'])?>원</div>
                                                </div>
                                            </div>
                                        </a>

                                        <!--판매 리스트-->
                                        <div id="sales_list<?=$i?>" style="display:none">
                                            <div class="slist">
                                                <div class="sale_sort clearfix">
                                                    <div class="col-md-8 btn_gr">
                                                        <ul>
                                                            <li>
                                                                <select <?php if($row['status'] == '완료' || $row['status'] == '취소') echo 'disabled'; ?> id="sale_status" name="sale_status" onchange="status_change(this.value, '<?=$row['pa_idx']?>', '<?=$i?>');">
                                                                    <option value="진행대기" <?php if($row['status'] == '진행대기') echo 'selected'; ?>>진행대기</option>
                                                                    <option value="진행중" <?php if($row['status'] == '진행중') echo 'selected'; ?>>진행중</option>
                                                                    <option value="완료" <?php if($row['status'] == '완료') echo 'selected'; ?>>완료</option>
                                                                    <option value="취소" <?php if($row['status'] == '취소') echo 'selected'; ?>>취소</option>
                                                                </select>
                                                                <!--<span class="ing">진행대기</span>-->
                                                            </li>
                                                            <li><span>의뢰인 : <?=$row['mb_nick']?></span></li>
                                                            <li><span id="status_date<?=$i?>"><?=substr($row['status_date'],0,10)?></span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <?php if($pta_idx != 0) { ?>
                                                        <p id="d_day<?=$i?>"><i class="fal fa-stopwatch"></i> 남은시간 : <?=$d_day?>일</p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="tbl_left">
                                                    <table summary="판매정보">
                                                        <colgroup>
                                                            <col style="width:60%" />
                                                            <col style="width:10%" />
                                                            <col style="width:13%" />
                                                            <col style="width:*" />
                                                        </colgroup>
                                                        <thead>
                                                        <tr>
                                                            <th>기본항목</th>
                                                            <th>수량</th>
                                                            <th>작업일</th>
                                                            <th>금액</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>

                                                                <p class="t"><?=$row['pta_title']?></p>
                                                                <p><?=$row['pta_content']?></p>
                                                            </td>
                                                            <td><?=$row['GoodsCnt']?></td>
                                                            <td><?= ($pta_idx != 0) ? $row['pta_select1']."일" : ""?></td>
                                                            <td><i class="fal fa-won-sign"></i> <?=number_format($row['Amt'])?>원</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--<div class="tprice text-right"><i class="fal fa-won-sign"></i> <?/*=number_format($row['pta_pay']*$row['GoodsCnt'])*/?>원</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    if($i == 0) {
                                    ?>
                                    <div class="text-center empty_list">
                                        <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                        <p class="t_padding17">판매한 재능이 없습니다.</p>
                                    </div>
                                    <?php
                                    }
                                    ?>

									<script type="text/javascript">
                                    <!--
                                        function toggle_sales(id) {
                                           var e = document.getElementById(id);
                                           if(e.style.display == 'block')
                                              e.style.display = 'none';
                                           else
                                              e.style.display = 'block';
                                        }
                                    //-->
                                    </script>
                                    <!--//판매 리스트-->

                                </div><!--rev-->
                            </div><!--in-->
                        </div>


                    </div>

                    <!--찜한 재능-->
                    <div id="tab-content3" class="tab-content">
                         <div id="my_goods">
                            <div class="in">
                                <div class="list cf">
                                    <?php if (sql_num_rows($like_list_result) == 0){ ?>

                                    <div class="text-center empty_list">
                                           <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                           <p class="t_padding17">찜한 재능이 없습니다.</p>
                                    </div>
                                    <?php }else{
                                    for($i = 0; $row = sql_fetch_array($like_list_result); $i++){
                                        include(G5_BBS_PATH."/li_content.php"); ?>

                                    <?php } ?>
                                <?php } ?>
                                </div><!--list-->
                            </div><!--in-->
                        </div>


                    </div>

                </div><!--//tabs-->
            </div>
            <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?tab='.$_REQUEST['tab'].'&op='.$op); ?>
        </section>

    <? }else if($member['mb_division'] == 1){ //일반인일때?>

        <section id="right_view">
        <h3>재능 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                    <ul>
                        <li id="tab1"><a href="javascript:a_tab('1');">찜한 재능<span class="badge"><?=$like_total?></span></a></li>
                        <li id="tab2"><a href="javascript:a_tab('2');">구매한 재능<span class="badge"><?=$pay_status1?></span></a></li>
                        <li id="tab3"><a href="javascript:a_tab('3');">결제 내역<span class="badge"><?=$pay_status1?></span></a></li>
                    </ul>

                    <!--일반인 찜한 재능-->
                    <div id="tab-content1" class="tab-content">

                        <div id="my_goods">
                            <div class="in">
                                <div class="list cf">
                                    <?php if (sql_num_rows($like_list_result) == 0){ ?>

                                    <div class="text-center empty_list">
                                           <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                           <p class="t_padding17">찜한 재능이 없습니다.</p>
                                    </div>
                                    <?php }else{
                                    for($i = 0; $row = sql_fetch_array($like_list_result); $i++){
                                        include(G5_BBS_PATH."/li_content.php") ?>
                                    <?php } ?>
                                <?php } ?>
                                </div><!--list-->
                            </div><!--in-->
                        </div>

                    </div>

                    <!--구매한 재능-->
                    <div id="tab-content2" class="tab-content box-article">

                        <div id="my_goods">
                            <div class="in">
                                <div class="list cf">
                                    <?php
                                    for($i=0; $row=sql_fetch_array($payment_result); $i++) {
                                        $row['page_type'] = "buy";
                                        include(G5_BBS_PATH."/li_content.php")
                                    ?>

                                    <?php
                                    }
                                    ?>
                                </div><!--list-->
                            </div><!--in-->
                        </div>


                    </div>

                    <!--결제내역-->
                    <div id="tab-content3" class="tab-content">

                        <div id="item_review">
                            <!--판매관리분류-->
                            <div class="sale_item_sort">
                                <ul>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=3&op=1"><li class="op1 check">전체(<?=number_format($pay_status1)?>)</li>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=3&op=2"><li class="op2">진행대기(<?=number_format($pay_status2)?>)</li>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=3&op=3"><li class="op3">진행중(<?=number_format($pay_status3)?>)</li>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=3&op=4"><li class="op4">완료(<?=number_format($pay_status4)?>)</li>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?tab=3&op=5"><li class="op5">취소(<?=number_format($pay_status5)?>)</li>
                                </ul>
                            </div>
                            <!--판매관리분류-->
                            <div class="in">
                                <div class="rev cf">
                                    <?php
                                    for($i=0; $row=sql_fetch_array($payment_result2); $i++) {
                                        // 진행 시작일에 맞춰서 남은 시간 계산 필요
                                        $d_day = '';
                                        if($row['status'] == '진행중') {
                                            $status_date = substr($row['status_date'],0,10); // 진행시작일

                                            $timestamp = strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days"); // 진행시작일 + 작업일
                                            $end_date = date('Y-m-d', $timestamp); // 진행종료일(예정)

                                            $d_day = ( strtotime($end_date) - strtotime(date('Y-m-d')) ) / 86400; // 남은 일자 계산
                                        }
                                        /*else if($row['status'] == '완료') {
                                            $expected_date = date('Y-m-d', strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days")); // 진행종료일(예정)
                                            if(substr($row['end_date'],0,10) <= $expected_date) { // 예정일 전에 작업이 끝났거나 예정일에 작업이 끝났을 경우
                                                $d_day = ( strtotime($expected_date) - strtotime(substr($row['end_date'],0,10))) / 86400; // 남은 일자 계산
                                            } else { // 예정일이 지나서 작업이 끝났을 경우
                                                $d_day = ( strtotime(substr($row['end_date'],0,10)) - strtotime($expected_date)) / 86400; // 남은 일자 계산
                                            }
                                        }*/
                                        $pta_idx = explode("-",$row["Moid"])[2];
                                        if ($pta_idx == 0 ){
                                            $row['pta_title'] = "직접입력";
                                            $row['pta_content'] = "판매자와 상의 후 입력한 금액입니다.";
                                        }
                                    ?>
                                    <div class="list cf">
                                        <a href="javascript:void(0);" onclick="toggle_sales('pay_list<?=$i?>');">
                                            <div class="mg">
                                                <?php
                                                $file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$row['ta_idx']} order by bf_datetime limit 1 ";
                                                $file_row = sql_fetch($file_sql);

                                                if($file_row['wr_id']) { ?>
                                                <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$file_row['bf_file']?>">
                                                <?php } else { ?>
                                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                                                <?php } ?>
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="tit"><?=$row['ta_title']?></div>
                                                <div class="sale_sort"><span class="ing"><?=$row['status']?></span>
                                                    <?php if($row['status'] == "완료"){ ?>
                                                    <span id="comp_chk_btn<?=$row['pa_idx']?>">
                                                       <?php if ($row['comp_chk'] != 'Y'){ ?>
                                                        <span onclick="comp_chk('<?=$row['pa_idx']?>')" class="comp">구매확정</span>
                                                       <?php }else{ ?>
                                                       <span style="cursor: auto" class="cancel">구매확정</span>
                                                       <?php } ?>
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$row['sale_mb_nick']?></div><!--닉네임 일부분 노출-->
                                                <div class="date"><?=substr($row['wr_datetime'], 0, 16)?>
                                                    <div class="pay"><?=number_format($row["Amt"])?>원</div>
                                                </div>
                                            </div>
                                        </a>

                                        <!--결제 리스트-->
                                        <div id="pay_list<?=$i?>" style="display:none">
                                            <div class="slist">
                                                <div class="sale_sort clearfix">
                                                    <div class="col-md-8 btn_gr">
                                                        <ul>
                                                            <li><span class="ing"><?=$row['status']?></span></li>
                                                            <li><span><?=substr($row['status_date'],0,10)?></span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <?php if($pta_idx != 0) { ?>
                                                        <p><i class="fal fa-stopwatch"></i> 남은시간 : <?=$d_day?>일</p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="tbl_left">
                                                    <table summary="판매정보">
                                                        <colgroup>
                                                            <col style="width:60%" />
                                                            <col style="width:10%" />
                                                            <col style="width:13%" />
                                                            <col style="width:*" />
                                                        </colgroup>
                                                        <thead>
                                                        <tr>
                                                            <th>기본항목</th>
                                                            <th>수량</th>
                                                            <th>작업일</th>
                                                            <th>금액</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <p class="t"><?=$row['pta_title']?></p>
                                                                <p><?=$row['pta_content']?></p>
                                                            </td>
                                                            <td><?=$row['GoodsCnt']?></td>
                                                            <td><?= ($pta_idx != 0) ? $row['pta_select1']."일" : ""?></td>
                                                            <td><i class="fal fa-won-sign"></i> <?=number_format($row["Amt"])?>원</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--<div class="tprice text-right"><i class="fal fa-won-sign"></i> <?/*=number_format($row['pta_pay']*$row['GoodsCnt'])*/?>원</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    if($i == 0) {
                                    ?>
                                    <div class="text-center empty_list">
                                        <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                        <p class="t_padding17">결제 내역이 없습니다.</p>
                                    </div>
                                    <?php
                                    }
                                    ?>


									<script type="text/javascript">
                                    <!--
                                        function toggle_sales(id) {
                                           var e = document.getElementById(id);
                                           if(e.style.display == 'block')
                                              e.style.display = 'none';
                                           else
                                              e.style.display = 'block';
                                        }
                                    //-->
                                    </script>
                                    <!--//판매 리스트-->

                                </div><!--rev-->
                            </div><!--in-->
                        </div>


                    </div>

                </div><!--//tabs-->
            </div>
            <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?tab='.$_REQUEST['tab'].'&op='.$op); ?>

        </section>
    <?php } ?>

</article>

<script>

    $(document).ready(function () {
        //a_tab('1');        $('.sale_item_sort li').removeClass('check');
        $('.op<?=$op?>').addClass('check');
    });


    // 판매 재능 상태 변경 (상태값, 결제idx, 행번호)
    function status_change(value, pa_idx, k) {
        // console.log(value);

        $.ajax({
            url: g5_bbs_url + "/ajax.status_change.php",
            type: "POST",
            data: {
                pa_idx: pa_idx,
                status: value,
            },
            success: function (data) {
                if(data.length != 0) {
                    swal('진행상태가 변경되었습니다.');
                    $('#status'+k).text(value); // 진행상태
                    $('#status_date'+k).text('<?=date('Y-m-d')?>'); // 진행상태변경일
                    $('#d_day'+k).html('<i class="fal fa-stopwatch"></i> 남은시간 : '+data.split('_')[1]+'일'); // 남은시간
                }
            },
        });
    }

    // 탭 처리
    function a_tab(id) {
        location.href = g5_bbs_url + "/my_item.php?tab="+id
    }

    function comp_chk(pa_idx) {

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            type: "POST",
            data: {
                pa_idx: pa_idx,
                mode: "comp_chk"
            },
            success: function (data) {
                if(data == 1 ) {
                    swal('구매확정이 되었습니다.');
                    $('#comp_chk_btn'+pa_idx).html('<span class="cancel" style="cursor: auto">구매확정</span>');
                }else{
                    swal("오류입니다. 다시시도해주세요.");
                }
            },
        });

    }
</script>


<!--채팅-->
<form name="fchatting" id="fchatting" method="post">
    <input type="hidden" name="ta_idx" id="ta_idx" value="">
    <input type="hidden" name="room_name" id="room_name" value="">
    <input type="hidden" name="master_id" id="master_id" value="">
    <input type="hidden" name="sub_id" id="sub_id" value="">
    <input type="hidden" name="room_id" id="room_id" value="">
</form>
<script>
    $(function() {
        if('<?=$mobile?>') { // 모바일 웹 또는 안드로이드 접속 시
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/chat_room.php');
        } else {
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/message.php');
        }
    });

    // 채팅방 입장 (재능 idx, 일반인아이디, 전문인닉네임, 전문인아이디)
    function chatting(ta_idx, master_id, room_name, sub_id) {
        $('#ta_idx').val(ta_idx);
        $('#room_name').val(room_name);
        $('#master_id').val(master_id);
        $('#sub_id').val(sub_id);

        var form = $('#fchatting')[0];
        var formdata = new FormData(form);

        $.ajax({
            url: g5_bbs_url+'/ajax.chat.control.php',
            processData: false,
            contentType: false,
            type: "POST",
            data: formdata,
            success: function (data) {
                if(data) {
                    $('#room_id').val(data);

                    $('#fchatting').submit();
                }
            },
        });
    }
</script>