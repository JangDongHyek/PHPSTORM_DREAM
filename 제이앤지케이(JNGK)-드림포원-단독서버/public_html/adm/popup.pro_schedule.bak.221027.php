<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');

/**
 * 팀장 - 프로관리 - 프로 레슨현황 팝업창
 * 22.06.17 수정 - 속도개선
 */

if(empty($_GET['mb_no'])) {
    $orderby = " order by pro_enter_date asc, mb_no asc ";
    if($member['center_code'] == 'center1') {
        $orderby = " order by field(mb_no, 17) desc, pro_enter_date asc "; // 21.08.20 워커힐 임연석 프로 제일 마지막 순서로 변경 요청
    }
    $mb_no = sql_fetch(" select mb_no from g5_member where mb_category = '프로' and mb_center = '{$member['mb_center']}' {$orderby} limit 1 ")['mb_no'];
} else {
    $mb_no = $_GET['mb_no'];
}

$sql_common = " from {$g5['member_table']} ";
$sql_search = " where mb_id != 'lets080' and mb_id != 'admin' and mb_category = '프로' and mb_center = '{$member['mb_center']}' "; // 팀장이 속한 센터의 프로만 조회
$sql_search .= " and (pro_leave_date = '0000-00-00' or pro_leave_date > date_format(now(), '%Y-%m-%d')) "; // 퇴사일 입력한 프로는 조회하지 않음

if (!$sst) {
    $sst = "pro_enter_date";
    $sod = "asc";
}

$sql_order = " order by {$sst} {$sod} ";

if($member['center_code'] == 'center1') {
    $sql_order = " order by field(mb_no, 17) desc, pro_enter_date asc "; // 21.08.20 워커힐 임연석 프로 제일 마지막 순서로 변경 요청
}

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
//if($private) echo $sql;
$result = sql_query($sql);

$today = date('Y.m.d');
$last_day = date('t', strtotime(date('Y-m'))); // 월의 마지막 일자

// 오늘 레슨
$year = date('Y');
$month = date('m');
$sql = " select count(*) as today_reser_count from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no
         where re.pro_mb_no = '{$mb_no}' and re.reser_date = date_format(curdate(), '%Y.%m.%d') and re.reser_date like '{$year}.{$month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$today_reser_count = sql_fetch($sql)['today_reser_count'];
?>

<script src="<?php echo G5_THEME_JS_URL ?>/calendar.adm.pro_view_tab2.js"></script>
<style>
    *, *:before, *:after { box-sizing: inherit; }
    .clearfix:after { content: ''; display: block; clear: both; float: none; }

    /* ======== Calendar ======== */
    .my-calendar {/*width: inherit;*/ padding:30px;text-align: center; cursor: default;}
    .my-calendar .clicked-date {border-radius: 25px;margin-top: 36px;float: left;width: 42%;padding: 46px 0 26px;background: #ddd;}
    .my-calendar .calendar-box {/*float: right;*/width: 100%;/*padding-left: 30px;*/}
    .clicked-date .cal-day {font-size: 24px;}
    .clicked-date .cal-date {font-size: 130px;}
    .ctr-box {padding: 0 16px; margin-bottom:20px;font-size: 22px; font-weight:bold; color:#222;}
    .ctr-box .btn-cal {position: relative;float: left;width:30px;height:30px; border-radius:50%; font-size:1em;cursor: pointer;border: none;
        background:#eee; line-height:21px; text-align:center; outline:none; padding:0;}
    .ctr-box .btn-cal:after {/*content: '<';*/position: absolute;top: 0;left: 0;width: 100%;height: 100%;line-height: 25px;font-weight: bold;font-size: 15px;}
    .ctr-box .btn-cal.next {float: right;}
    .ctr-box .btn-cal.next:after {/*content: '>';*/}
    .cal-table { width: 100%;}
    .cal-table th { width: 14.2857%; padding-bottom:10px; border-bottom:1px solid #ddd; font-size: 15px; color:#999;text-align: center; font-weight:normal;}
    .cal-table td { padding:12px 0;height: 40px;font-size:18px;vertical-align: middle; border:0; text-align:center; font-weight:400; position:relative;}
    .cal-table .day { position: relative; cursor: pointer; width:35px; height:35px; line-height:35px;border-radius: 50%; margin:0 auto;}
    .cal-table .les_yes { background:#f3d421; width:7px; height:7px; border-radius:50%; position:absolute; bottom:4px; left:50%; margin-left:-3.5px;}
    .cal-table .today { background: #ffd255;border-radius: 50%;color: #fff;}
    .cal-table .prev { color: #c2c2c2;}
    .cal-table .day-active { background: #ff8585;border-radius: 50%;color: #fff;}
    .cal-table .has-event:after { content: '';display: block;position: absolute;left: 0;bottom: 0;width: 100%;height: 4px;background: #FFC107;}
    .lre_ldate .input_ldate {
        height: 33px;
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 0 10px;
    }
    .lre_ldate .btn_ldate {
         height: 33px;
         border: 1px solid #444;
         border-radius: 3px;
         padding: 0 10px;
         background: #444;
         color: #fff;
         margin-left: 5px;
     }
    #adm_pro_lesson .close{
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 40px;
        opacity: 1;
        text-shadow: 0;
        z-index: 10;
    }
</style>

<div id="adm_pro_lesson">
    <div class="apl_tit">레슨현황</div><!--.apl_tit-->
    <button type="button" class="close" onclick="popup_close();"><span aria-hidden="true">&times;</span></button>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = './popup.pro_schedule.php?mb_no='.$row['mb_no'];
        $style = 'border-color:#f3d421; background:#fff; font-weight:500; color:#222;';
    ?>
    <div class="apl_name" style=" <?php if($row['mb_no'] == $mb_no) { echo $style; } ?>" onclick="showLoadingBar();location.href='<?=$s_mod?>'">
        <div class="apl_pro"><?=$row['mb_name']?> <span>프로</span></div>
    </div><!--.apl_name-->
    <?php
    }
    ?>
</div><!--#adm_pro_lesson-->

<!--오늘예약-->
<div id="pro_sch_box" class="pro_sch_box2" style="margin:20px;">
    <div class="psch_list psch_list2">
        <div class="psch_tit">오늘 예약 (총 <?=$today_reser_count?>건)</div>
        <ul>
            <?php
            $today_sql = " select mb.mb_no, mb.history_idx, mb.lesson_idx, re.reser_time, mb.mb_name, mb.mb_id_no,le.lesson_name, le.lesson_count
                           from g5_lesson_reser as re 
                           left join g5_member as mb on re.mb_no = mb.mb_no
                           left join g5_lesson as le on le.idx = mb.lesson_idx
                           where re.pro_mb_no = {$mb_no} and re.reser_date = '{$today}' and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
                           order by re.reser_date desc, re.reser_time desc ";
            //if($private) { echo $today_sql; }
            $today_result = sql_query($today_sql);

            for($i=0; $row=sql_fetch_array($today_result); $i++) {

                $diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$row['mb_no']}' and history_idx = '{$row['history_idx']}'; ")['count'];
                $lesson_reamin_count = sql_fetch (" select lesson_remain_count from g5_lesson_diary where history_idx = '{$row['history_idx']}' order by idx desc limit 1; ")['lesson_remain_count'];

                $remain = '';
                if(empty($diary_count)) {
                    $remain .= explode('/',$row['lesson_count'])[0]; // 잔여회차
                } else {
                    $remain .= $lesson_reamin_count.'회'; // 잔여회차
                }
                if(!empty($row['lesson_idx'])) { $remain .= '/'; }
                $remain .= explode('/',$row['lesson_count'])[0]; // 전체회차
            ?>
            <li>
                <div class="lc_date"><?=$today?></div>
                <div class="lc_time"><i class="far fa-clock"></i> <?=$row['reser_time']?></div>
                <div class="lc_member"><?=$row['mb_id_no']?> <?=$row['mb_name']?> 고객님
                <?php if(!empty($row['diary_idx']) && $row['reser_state'] != '노쇼') { echo '<span class="le_comp">[레슨완료 ('.$remain.')]</span>'; } ?>
                <?php if($row['reser_state'] == '노쇼') { echo '<span class="le_comp">[노쇼 ('.$remain.')]</span>'; } ?>
                </div>
            </li>
            <?php
            }
            if($i == 0) {
            ?>
                <li>예약이 없습니다.</li>
            <?php
            }
            ?>
        </ul>
    </div><!--.psch_list2-->
</div><!--#pro_sch_box-->

<!-- 예약 가능한 시간 -->
<div id="pro_sch_box" class="pro_sch_box2" style="margin:20px;">
    <div class="psch_list psch_list2">
        <div class="psch_tit">예약 가능한 시간</div>
        <div class="res_time_set"></div>
    </div><!--.psch_list2-->
</div><!--#pro_sch_box-->
<!-- 예약 가능한 시간 -->

<!--달력현황-->
<div style="padding:20px;">
    <div id="apl_sch">
        <div class="les_cabox01">

            <div class="my-calendar clearfix month">
                <!--<div class="clicked-date">
                    <div class="cal-day"></div>
                    <div class="cal-date"></div>
                </div>-->
                <div class="calendar-box">
                    <div class="ctr-box clearfix">
                        <button type="button" title="prev" class="btn-cal prev"><i class="far fa-angle-left"></i></button>
                        <span class="cal-year"></span>년
                        <span class="cal-month"></span>월
                        <button type="button" title="next" class="btn-cal next"><i class="far fa-angle-right"></i></button>
                    </div>
                    <table class="cal-table">
                        <thead>
                        <tr>
                            <th>일</th>
                            <th>월</th>
                            <th>화</th>
                            <th>수</th>
                            <th>목</th>
                            <th>금</th>
                            <th>토</th>
                        </tr>
                        </thead>
                        <tbody class="cal-body">
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!--.les_cabox01-->

        <div class="les_cabox02" >
            <div class="les_ctit"><?=$month?>월 예약</div>
            <div class="les_ctotal">총 <?=$total_count?>건</div>
            <div class="les_csch" style="height: 390px;">
                <ul>
                    <?php
                    for($i=0; $row=sql_fetch_array($result); $i++) {
                        $class = '';
                        if($today > $row['reser_date']) {
                            $class = 'li_past';
                        } else if($today == $row['reser_date']) {
                            $class = 'li_today';
                        }
                        ?>
                        <li class="<?=$class?>">
                            <div class="lc_date"><?=$row['reser_date']?></div>
                            <div class="lc_time"><i class="far fa-clock"></i> <?=$row['reser_time']?></div>
                            <div class="lc_member"><?=$row['mb_id_no']?> <?=$row['mb_name']?> 고객님</div>
                        </li>
                        <?php
                    }
                    if($i==0) {
                        ?>
                        <li style="font-size:15px; color:#666; text-align:center; padding:30px 0;">예약이 없습니다.</li>
                        <?php
                    }
                    ?>
                </ul>
            </div><!--.les_csch-->
        </div><!--.les_cabox02-->
    </div><!--#apl_sch-->
</div><!--padding:20px-->


<script>
    var pro_mb_no = <?=$mb_no?>;
    $(function() {
        showLoadingBar();
        $.ajax({
            url : g5_admin_url + "/ajax.lesson_time_set.php",
            data: {reser_date : '<?=date('Y.m.d')?>', pro_mb_no : '<?=$mb_no?>', mode : 'pro'},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.res_time_set').html(data); // 예약시간설정(예약가능시간)
                }
                else{
                    $('.res_time_set').html('<p>예약 가능 시간이 없습니다.</p>');
                }
            },
            complete : function() {
                hideLoadingBar();
            }
        });
    });

    function popup_close() {
        window.close(); // -- 웹?
        history.back(); // -- 모바일?
    }
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>

