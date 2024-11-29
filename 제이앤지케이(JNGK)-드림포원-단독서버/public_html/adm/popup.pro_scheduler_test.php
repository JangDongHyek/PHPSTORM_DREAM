<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');

/** 프로관리 - 전체스케줄 팝업 **/

if(empty($_GET['mb_no'])) {
    $mb_no = sql_fetch(" select mb_no from g5_member where mb_category = '프로' and mb_center = '{$member['mb_center']}' order by pro_enter_date asc, mb_no asc limit 1 ")['mb_no'];
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

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
//if($private) {
//    echo $sql;
//}
$result = sql_query($sql);

$today = date('Y.m.d');
$last_day = date('t', strtotime(date('Y-m'))); // 월의 마지막 일자

$date = date('Y-m-d');

// 스케줄러 시간설정
$time = sql_query(" select * from g5_lesson_time_set order by idx");

$reser_time = array();
for($j=0; $row=sql_fetch_array($time); $j++) {
    array_push($reser_time, $row['set_time']);
}

// 프로 수
$pro_count = sql_fetch(" select count(*) as count from g5_member where mb_category = '프로' and center_code = '{$member['center_code']}' and (pro_leave_date = '0000-00-00' or pro_leave_date > date_format(now(), '%Y-%m-%d')); ")['count'];
?>

<script src="<?php echo G5_THEME_JS_URL ?>/calendar.adm.pro_scheduler_test.js"></script>
<link rel="stylesheet" href="<?= G5_ADMIN_URL?>/css/scheduler.css">
<style>
    /*로딩바*/
    #mask { position:fixed; z-index:9000; background-color:#000000; display:none; left:0; top:0; }
    #loadingImg { position:fixed; left:50%; top:50%; display:none; z-index:10000;transform: translate(-50%, -50%); }
    #loadingImg img {
        width: 80px;
        height: 80px;
    }

    /*프로 7명 이상 시 적용*/
    <?php if($pro_count > 6) { ?>
    #calendar table tr .time{width:60px;}
    @media (max-width: 1400px){
        #calendar .table_body{overflow-x:scroll;}
        #calendar table{width:1400px;}
        #apl_sch .les_cabox01 { width: calc(35% - 30px) !important; }
        #apl_sch .les_cabox02{width:calc(65% - 30px);}
    }
    @media (max-width: 991px){
        #apl_sch .les_cabox01{width:100% !important;}
        #calendar .table_body{overflow-x:scroll;}
        #calendar table{width:991px;}
        #apl_sch .les_cabox02{width:100%;}
    }
    <?php } else { ?>
    #calendar table tr .time{width:5%;}
    <?php } ?>
</style>


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

        <div class="les_cabox02" style="background: none;">

            <h1 class="schedule_title"><?php echo empty($reser_date) ? date('Y.m.d') : $reser_date; ?></h1>
			
            <div id="calendar">
            </div>

        </div><!--.les_cabox02-->
    </div><!--#apl_sch-->
</div><!--padding:20px-->

<script>
    $(function() {
        // 전체 스케줄 조회
        showLoadingBar();
        $.ajax({
            url : g5_admin_url + "/ajax.popup_pro_scheduler_test.php",
            data: {reser_date : '<?=date('Y.m.d')?>'},
            type: 'POST',
            success : function(data) {
                // console.log(data);
                $('.schedule_title').text('<?=date('Y.m.d')?>');
                $('#calendar').html(data);
            },
            complete: function() {
                hideLoadingBar();
            }
        });
    });

    // 팝업 종료
    function popup_close() {
        window.close(); // -- 웹?
        history.back(); // -- 모바일?
    }

    // 로딩바 표시
    function showLoadingBar() {
        var maskHeight = $(document).height();
        var maskWidth = window.document.body.clientWidth;
        var mask = "<div id='mask'></div>";
        var loadingImg = '';
        loadingImg += "<div id='loadingImg'>";
        loadingImg += "<img src='<?=G5_IMG_URL?>/loading.gif'/>";
        loadingImg += "</div>";
        $('body').append(mask).append(loadingImg);
        $('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'})
        $('#mask').show();
        $('#loadingImg').show();
    }

    // 로딩바 숨김
    function hideLoadingBar() {
        $('#mask, #loadingImg').hide();
        $('#mask, #loadingImg').remove();
    }

</script>

<script>
	// requires jquery library
	jQuery(document).ready(function() {
	   jQuery(".amain-table").clone(true).appendTo('#calendar').addClass('clone');   
	});
</script>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>