<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

/** 팀장 - 프로관리 ==> 스케줄관리 **/

$mb_no = $_GET['mb_no'];

$mb = get_member_no($mb_no);

$lesson_info = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' ");

/*$sql_search = '';
if(!empty($_GET['start_date'])) {
    $start_date = str_replace('-','.',$_GET['start_date']);
    $sql_search .= " and (re.reser_date >= '{$start_date}') ";
}
if(!empty($_GET['end_date'])) {
    $end_date = str_replace('-','.',$_GET['end_date']);
    $sql_search .= " and (re.reser_date <= '{$end_date}') ";
}*/

$today = date('Y.m.d');
$year = date('Y');
$month = date('m');

// 총 레슨건 -- 총 예약건으로 판한
$sql = " select count(*) as cnt 
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$mb_no}' and re.reser_date like '{$year}.{$month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select re.*, date_format(re.reg_date, '%Y.%m.%d') as reg_date, mb.mb_name, mb.mb_id_no, le.lesson_name, le.lesson_count
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         left join g5_lesson as le on le.lesson_code = mb.lesson_code and le.center_code = mb.center_code
         where re.pro_mb_no = '{$mb_no}' and re.reser_date like '{$year}.{$month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
         order by re.reser_date desc, re.reser_time desc ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'?mb_no='.$mb_no.'" class="ov_listall">전체목록</a>';

$last_day = date('t', strtotime(date('Y-m'))); // 월의 마지막 일자

//$colspan = 6;

// 오늘 레슨
$sql = " select count(*) as today_reser_count from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no
         where re.pro_mb_no = '{$mb_no}' and re.reser_date = date_format(curdate(), '%Y.%m.%d') and re.reser_date like '{$year}.{$month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$today_reser_count = sql_fetch($sql)['today_reser_count'];

// 레슨 취소  -- 레슨 완료 기능 작업 후 수정 필요
$sql = " select count(*) as reser_cancel_count from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$mb_no}' and re.reser_state = '예약취소' and re.reser_date like '{$year}.{$month}%' ";
$reser_cancel_count = sql_fetch($sql)['reser_cancel_count'];

// 레슨 완료 -- reser_idx가 있으면 레슨 완료로 판단
$sql = " select count(*) as reser_ok_count 
         from g5_lesson_diary as ld
         left join g5_member as mb on mb.mb_no = ld.mb_no
         where ld.pro_mb_no = '{$mb_no}' {$sql_search}  and ld.lesson_date like '{$year}.{$month}%' and ld.reser_idx is not null ";
$reser_ok_count = sql_fetch($sql)['reser_ok_count'];

$g5['title'] .= '프로관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>
    #calendar { height: 280px; }
    html, body { box-sizing: border-box; padding: 0; margin: 0; }
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
    .cal-table .day { position: relative;/*cursor: pointer;*/ width:35px; height:35px; line-height:35px;border-radius: 50%; margin:0 auto;}
    .cal-table .les_yes { background:#f3d421; width:7px; height:7px; border-radius:50%; position:absolute; bottom:4px; left:50%; margin-left:-3.5px;}
    .cal-table .today { background: #ffd255;border-radius: 50%;color: #fff;}
    .cal-table .prev { color: #c2c2c2;}
    .cal-table .day-active { background: #ff8585;border-radius: 50%;color: #fff;}
    .cal-table .has-event:after { content: '';display: block;position: absolute;left: 0;bottom: 0;width: 100%;height: 4px;background: #FFC107;}

     .btn_adm_pro_ok {
         display: inline-block;
         line-height: 35px;
         background: #f3d421;
         color: #333;
         font-size: 1.2em;
         font-weight: 600;
         border: 1px solid #f3d421;
         width: 100px;
         margin: 0 5px;
         text-align: center;
         border-radius: 30px;
     }
</style>


<div id="tab_box">
    <ul class="tab">
        <li class="" id="tab0"><a href="javascript:void(0);" onclick="tabClick('pro_view_member.php');">유효회원</a></li>
        <li class="" id="tab1"><a href="javascript:void(0);" onclick="tabClick('pro_view.php');">레슨현황</a></li>
        <li class="current" id="tab2"><a href="javascript:void(0);">스케줄관리</a></li>
        <!--<li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab3.php');">휴무관리</a></li>-->
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_atta.php');">근태관리</a></li>
        <!--<li class="" id="tab4"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab5.php');">신규/재등록 현황</a></li>-->
        <li class="" id="tab5"><a href="javascript:void(0);" onclick="tabClick('pro_view_sales.php');">매출관리</a></li>
    </ul>
</div><!--#tab_box-->

<!--프로 프로필영역 시작//-->
<div class="adm_pro_info">
    <div class="apro_img">
        <?
        $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
        $file = sql_fetch($sql);
        
        if(!empty($file['img_file'])) {
        ?>
        <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>">
        <?
        } else {
        ?>
        <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif"/>
        <?php
        }
        ?>
    </div><!--.apro_img-->
    <div class="apro_name">
        <?php /*?><span style="font-weight: bold;margin-right: 10px;"><?=$mb_state?></span> 
        <span><?=$mb['mb_id_no']?></span> <?php */?>
        <?=$mb['mb_name']?> <span><?=$mb['mb_category']?></span>
    </div><!--.apro_name-->
    <div style="text-align: center;">
        <input type="button" class="btn_adm_pro_ok" value="정보수정" onclick="location.href='<?=G5_ADMIN_URL?>/pro_form.php?w=u&mb_no=<?=$mb_no?>'">
    </div>
</div><!--.adm_pro_info-->
<!--//프로 프로필영역 끝-->


<!--총 스케줄현황표-->
<!--레슨현황이랑 중복이긴한데... 넣는걸루?-->
<div id="les_state">
<div class="lre_list_tit">스케줄현황</div><!--.lre_list_tit-->
    <div class="les_sdate">기간 : <?=date('Y-m').'-'.'01'?> ~ <?=date('Y-m').'-'.$last_day?></div>
    <div class="les_sbox">
        <ul>
            <li><p>총 레슨건</p><span><?=$total_count?></span></li>
            <li class="lsg"><p>레슨 취소</p><span><?=$reser_cancel_count?></span></li>
            <li class="lsg"><p>레슨 완료</p><span><?=$reser_ok_count?></span></li>
            <li class="lsb">
                <div class="lsb_d"><?=date('Y.m.d')?></div>
                <div class="lsb_today">오늘레슨 <strong><?=$today_reser_count?></strong></div>
            </li>
        </ul>
    </div><!--.les_sbox-->
</div><!--#les_state-->

<!--오늘예약-->
<div id="pro_sch_box" class="pro_sch_box2">
    <div class="psch_list psch_list2">
    	<div class="psch_tit">오늘 예약 (총 <?=$today_reser_count?>건)</div>
        <ul>
            <?php
            $today_sql = " select mb.mb_no, mb.history_idx, mb.lesson_idx, re.reser_time, mb.mb_name, mb.mb_id_no, di.reser_idx, di.no_show,
                           (select min(lesson_remain_count*1) from g5_lesson_diary where le.lesson_code = lesson_code and history_idx = mb.history_idx) AS lesson_remain_count,
                           le.lesson_name, le.lesson_count
                           from g5_lesson_reser as re 
                           left join g5_member as mb on re.mb_no = mb.mb_no
                           left join g5_lesson_diary as di on di.reser_idx = re.idx
                           left join g5_lesson as le on le.idx = mb.lesson_idx
                           where re.pro_mb_no = {$mb_no} and re.reser_date = '{$today}' and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
                           order by re.reser_date desc, re.reser_time desc ";
            $today_result = sql_query($today_sql);

            for($i=0; $row=sql_fetch_array($today_result); $i++) {

                $diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$row['mb_no']}' and history_idx = '{$row['history_idx']}'; ")['count'];

                $remain = '';
                if(empty($diary_count)) {
                    $remain .= explode('/',$row['lesson_count'])[0];
                } else {
                    $remain .= $row['lesson_remain_count'].'회';
                }
                if(!empty($row['lesson_idx'])) { $remain .= '/'; }
                $remain .= explode('/',$row['lesson_count'])[0];
            ?>
            <li>
                <div class="lc_date"><?=$today?></div>
                <div class="lc_time"><i class="far fa-clock"></i> <?=$row['reser_time']?></div>
                <div class="lc_member" onclick="member_history_popup('<?=$row['mb_no']?>');" style="cursor: pointer;"><?=$row['mb_id_no']?> <?=$row['mb_name']?> 고객님
                <?php if(!empty($row['reser_idx']) && $row['no_show'] != 'Y') { echo '<span class="le_comp">[레슨완료 ('.$remain.')]</span>'; } ?>
                <?php if($row['no_show'] == 'Y') { echo '<span class="le_comp">[노쇼 ('.$remain.')]</span>'; } ?>
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
<div id="pro_sch_box" class="pro_sch_box2">
    <div class="psch_list psch_list2">
        <div class="psch_tit">예약 가능한 시간</div>
        <div class="res_time_set"></div>
    </div><!--.psch_list2-->
</div><!--#pro_sch_box-->
<!-- 예약 가능한 시간 -->

<!--달력현황-->
<div id="les_schedule">
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

	<div class="les_cabox02">
        <div class="les_ctit"><?=$month?>월 예약</div>
        <div class="les_ctotal">총 <?=$total_count?>건</div>
        <div class="les_csch">
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

<!--<script src="<?php /*echo G5_THEME_JS_URL */?>/calendar.pro.js"></script>-->
<script src="<?php echo G5_THEME_JS_URL ?>/calendar.adm.pro_view_tab2.js"></script>
<script>
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

    var pro_mb_no = '<?=$mb_no?>';
    function tabClick(tab) {
        if(tab == 'pro_view_tab5.php') {
            alert('준비중입니다.');
            return false;
        }

        var lv = '';
        if(tab == 'pro_view_sales.php') {
            lv = '&lv=당일매출';
        }
        location.replace(g5_admin_url+'/'+tab+'?mb_no=<?=$mb_no?>'+lv);
    }

    // 회원-상품등록이력조회 팝업
    function member_history_popup(mb_no) {
        var url = "./popup.member_history.php?mb_no="+mb_no;

        window.open(url, "member_history", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
    }
</script>

<?php
include_once('./admin.tail.php');
?>
