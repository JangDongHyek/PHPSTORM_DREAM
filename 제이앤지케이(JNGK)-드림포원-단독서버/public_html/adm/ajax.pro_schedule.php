<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');

/** 사용 안함 **/

$mb_no = $_POST['mb_no'];
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
        background:#eee; line-height:21px; text-align:center; outline:none;}
    .ctr-box .btn-cal:after {/*content: '<';*/position: absolute;top: 0;left: 0;width: 100%;height: 100%;line-height: 25px;font-weight: bold;font-size: 15px;}
    .ctr-box .btn-cal.next {float: right;}
    .ctr-box .btn-cal.next:after {/*content: '>';*/}
    .cal-table { width: 100%;}
    .cal-table th { width: 14.2857%; padding-bottom:10px; border-bottom:1px solid #ddd; font-size: 15px; color:#999;text-align: center; font-weight:normal;}
    .cal-table td { padding:12px 0;height: 40px;font-size:18px;vertical-align: middle; border:0; text-align:center; font-weight:400; position:relative;}
    .cal-table .day { position: relative;cursor: pointer; width:35px; height:35px; line-height:35px;border-radius: 50%; margin:0 auto;}
    .cal-table .les_yes { background:#f3d421; width:7px; height:7px; border-radius:50%; position:absolute; bottom:4px; left:50%; margin-left:-3.5px;}
    .cal-table .today { background: #ffd255;border-radius: 50%;color: #fff;}
    .cal-table .prev { color: #c2c2c2;}
    .cal-table .day-active { background: #ff8585;border-radius: 50%;color: #fff;}
    .cal-table .has-event:after { content: '';display: block;position: absolute;left: 0;bottom: 0;width: 100%;height: 4px;background: #FFC107;}
</style>

<!--오늘예약-->
<div id="pro_sch_box" class="pro_sch_box2" style="margin: 20px;">
    <div class="psch_list psch_list2">
        <div class="psch_tit">오늘 예약</div>
        <ul>
            <?php
            $today_sql = " select le.reser_time, mb.mb_name, mb.mb_id_no 
                           from g5_lesson_reser as le 
                           left join g5_lesson_pro_info as lep on lep.idx = le.pro_info_idx 
                           left join g5_member as mb on le.mb_no = mb.mb_no 
                           where re.pro_mb_no = {$mb_no} and le.reser_date = '{$today}' ";
            $today_result = sql_query($today_sql);

            for($i=0; $row=sql_fetch_array($today_result); $i++) {
                ?>
                <li>
                    <div class="lc_date"><?=$today?></div>
                    <div class="lc_time"><i class="far fa-clock"></i> <?=$row['reser_time']?></div>
                    <div class="lc_member"><?=$row['mb_id_no']?> <?=$row['mb_name']?> 고객님</div>
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

<!--달력현황-->
<div id="les_schedule" style="margin: 20px;">
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

    <div class="les_cabox02" style="width: 42% !important;height: 423px !important;">
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
</div><!--#les_schedule-->

<script>
    var pro_mb_no = <?=$mb_no?>
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>

