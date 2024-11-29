<?php
include_once('./_common.php');

/** 회원 - 레슨예약 **/

// adm/lesson_reser.php -- 현재 파일 수정 시 왼쪽 파일 같이 확인

$g5['title'] = '레슨예약';
include_once('./_head.php');

$mb_no = $member['mb_no'];
$mb = get_member_no($mb_no);
if($mb['lesson_end_date'] == '1970-01-01') $mb['lesson_end_date'] = '0000-00-00';

$lesson = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' and center_code = '{$mb['center_code']}' "); // 레슨정보

$today = date('Y-m-d');

$diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$mb['mb_no']}' and history_idx = '{$mb['history_idx']}'; ")['count'];
$diary_info = sql_fetch(" select *, min(lesson_remain_count*1) as lesson_remain_count from g5_lesson_diary where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}'; "); // 레슨일지 정보
?>

<link rel="stylesheet" href="<?= G5_CSS_URL ?>/style.css?v=<?=G5_CSS_VER?>">
<!--<script src="<?php /*echo G5_THEME_JS_URL */?>/calendar.js"></script>-->
<script src="<?php echo G5_THEME_JS_URL ?>/calendar.bbs.lesson_reser.js?v=<?=G5_JS_VER?>"></script>
<style>
    #container { padding-bottom: 150px !important; }
</style>

<div id="month_top">
    <div class="month_tbox cf">
        <div class="mtb_arrow mtb_al btn-cal prev"><i class="far fa-angle-left"></i><span class="sound_only">이전달</span></div>
        <div class="mtb_num"></div>
        <div class="mtb_arrow mtb_ar btn-cal next"><i class="far fa-angle-right"></i><span class="sound_only">다음달</span></div>
    </div><!--.month_tbox-->
</div><!--#month_top-->

<div id="lesson_box">
    <div class="les_box">
        <?php if(empty($mb['lesson_idx'])) { ?>
            <div class="le_tit">레슨 정보가 없습니다.</div>
        <?php } else { ?>
            <div class="le_tit">
                <?=$lesson['lesson_name']?> <span><?=$lesson['lesson_count']?></span>
                <!--<span class="le_date">(잔여회차 <?php /*if(empty($diary_count)) echo explode('회', explode(',', $diary_info['lesson_count'])[0])[0]; else echo $diary_info['lesson_remain_count'].'회'; */?>)</span>-->
            </div>
        <?php } ?>
        <!--<div class="le_date">등록일 : <?/*=substr($mb['mb_reg_date'], 0, 10)*/?></div>-->
        <div class="le_date">시작일 : <?=$mb['lesson_start_date']?></div>
        <div class="le_date">종료일 : <?=$mb['lesson_end_date']?></div>
        <div class="my_pro">담당 : <?=$mb['mb_charge_pro']?> 프로</div>
    </div><!--.les_box-->
</div><!--#lesson_box-->


<div id="calendar"><!--달력부분
<button type="button" class="" data-toggle="modal" data-target="#myModal">
날짜클릭 하면 예약모달 창
</button>-->
    <div class="my-calendar clearfix">
        <!--<div class="clicked-date">
            <div class="cal-day"></div>
            <div class="cal-date"></div>
        </div>-->
        <div class="calendar-box">
            <div class="ctr-box clearfix" style="display: none;">
                <button type="button" title="prev" class="btn-cal prev">
                </button>
                <span class="cal-year"></span>년
                <span class="cal-month"></span>월
                <button type="button" title="next" class="btn-cal next">
                </button>
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
                <tbody class="cal-body"></tbody>
                <!--
                예약/레슨상태 별 클래스값
                .today    오늘날짜
	            .re_done  예약완료
	            .re_wait  예약대기
	            .noshow   노쇼
                .le_done  레슨완료
                -->
            </table>
        </div>
    </div>
    <!-- // .my-calendar -->

    <!--달력 동그라미 표시-->
    <div id="cal_help">
    	<ul>
        	<li class="ch01"><span>오늘날짜</span></li>
        	<li class="ch02"><span>예약완료</span></li>
        	<li class="ch03"><span>예약대기</span></li>
        	<!--<li class="ch04"><span>레슨완료</span></li>-->
        	<li class="ch05"><span>노쇼</span></li>
        </ul>
    </div><!--#cal_help-->


</div><!--#calendar-->

<!--예약모달창 시작-->
<div id="lere_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <div class="lere_today">
                        <span>선택한 날짜</span>
                        <?=$today?>
                    </div><!--.to_date-->

                    <div class="lere_time">
                        <p>예약 시간 선택</p>

                        <div class="check_bx">
                            <!-- 프로 예약 시간 설정 후 수정 -->
                            <!--<input type=checkbox name="ck_reser_time" id="reser_time1" value="10:00"><label for="reser_time1"><div>10:00</div></label>
                            <input type=checkbox name="ck_reser_time" id="reser_time2" value="10:30"><label for="reser_time2"><div>10:30</div></label>
                            <input type=checkbox name="ck_reser_time" id="reser_time3" value="11:00"><label for="reser_time3"><div>11:00</div></label>
                            <input type=checkbox name="ck_reser_time" id="reser_time4" value="15:00"><label for="reser_time4"><div>15:00</div></label>-->
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lere_btn01" onclick="reser_request();">예약요청 <i class="fas fa-angle-right"></i></button>

                    <!--예약수정 시 아래버튼 나옴-->
                    <div class="lere_modify hide">
                        <a class="lere_btn02" onclick="reser_mod();">예약수정 <i class="fal fa-pen"></i></a>
                        <a class="lere_btn03" onclick="reser_del();">예약삭제</a>
                    </div><!--.lere_modify-->
                </div><!--.modal-footer-->
            </div><!--.modal-body-->
        </div>
    </div>
</div><!--#lere_modal-->
<!--예약모달창 끝-->

<form>
    <input type="hidden" id="reser_date" name="reser_date" value="">
    <input type="hidden" id="reser_time" name="reser_time" value="">
    <input type="hidden" id="idx" name="idx" value=""> <!-- 레슨예약정보 idx -->
    <input type="hidden" id="time_set_idx" name="time_set_idx" value=""> <!-- 예약시간설정 idx -->
    <input type="hidden" id="lesson_code" name="lesson_code" value="<?=$lesson['lesson_code']?>">
    <input type="hidden" id="center_code" name="center_code" value="<?=$lesson['center_code']?>">
    <input type="hidden" id="mb_state" name="mb_state" value="">
    <input type="hidden" id="pro_mb_no" name="pro_mb_no" value="<?=$mb['pro_mb_no']?>">
    <input type="hidden" id="lesson_start_date" name="lesson_start_date" value="<?=str_replace('-','.',$mb['lesson_start_date'])?>">
    <input type="hidden" id="lesson_end_date" name="lesson_end_date" value="<?=str_replace('-','.',$mb['lesson_end_date'])?>">
    <input type="hidden" id="lesson_idx" name="lesson_idx" value="<?=$mb['lesson_idx']?>">
</form>

<div id="lesson_list">
    <?php
    $today = date('Y.m.d');

    $count = sql_fetch(" select count(*) as count from g5_lesson_reser where mb_no = {$member['mb_no']} and history_idx = '{$member['history_idx']}' and reser_date >= '{$today}' order by idx desc ")['count'];

    $sql = " select * from g5_lesson_reser where mb_no = {$member['mb_no']} and history_idx = '{$member['history_idx']}' and reser_date >= '{$today}' order by reser_date desc, reser_time desc ";
    $result = sql_query($sql);

    $res_class = '';
    if($count > 0) {
        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($row['reser_state'] == '예약대기') $res_class = 'res_wait'; else $res_class = 'res_done';
    ?>
    <div class="les_list">
    <dl>
        <dt><?=$row['reser_date']?></dt>
        <dd><?=$row['reser_time']?></dd>
        <?php if($row['reser_state'] == '예약대기') { ?>
        <div class="les_modify"><a href="javascript:void(0);" onclick="reser_mod_modal('<?=$row['idx']?>', '<?=$row['reser_time']?>', '<?=$row['reser_date']?>', '<?=$row['time_set_idx']?>');"><i class="fas fa-pen"></i><span class="sound_only">수정</span></a></div>
        <?php } ?>
        <div class="les_state"><span class="<?=$res_class?>"><?=$row['reser_state']?></span></div>
    </dl>
    </div><!--.les_list-->
    <?php
        }
    } else {
    ?>
    <div class="les_list" style="text-align: center;"><dl>레슨 예약이 없습니다.</dl></div>
    <?php
    }
    ?>
</div><!--#lesson_list-->

<script>
    /*$(function () {
        // input type = 'radio' 처럼 동작
        $('input[type="checkbox"][name="ck_reser_time"]').click(function(){
            $('#reser_time').val(''); // 초기화
            if ($(this).prop('checked')) {
                $('input[type="checkbox"][name="ck_reser_time"]').prop('checked', false);
                $(this).prop('checked', true);

                $('#reser_time').val($(this).val()); // 선택 예약 시간
                console.log($(this).val());
            }
        });
    });*/

    // 예약 시간 선택 (예약시간, 예약시간설정idx)
    function reser_select(reser_time, time_set_idx) {
        // input type = 'radio' 처럼 동작
        $('input[type="checkbox"][name="ck_reser_time"]').prop('checked', false);
        $("input[name=ck_reser_time][value='" + reser_time + "']").prop("checked", true);
        $('#reser_time').val(reser_time); // 선택 예약 시간
        $('#time_set_idx').val(time_set_idx);
        if('<?=$mb['mb_state']?>' == 'one_point_lesson') {
            $('#mb_state').val('<?=$mb['mb_state']?>');
        }
    }

    // 예약요청
    var pro_mb_no = '<?=$mb['pro_mb_no']?>';
    var is_post = false; // 중복 post 체크
    function reser_request() {
        var flag = true;

        // 레슨 예약 가능한 회원인지 체크 (잔여회차 확인)
        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.lesson_reser_check.php",
            data: {
                mb_no: '<?=$member['mb_no']?>',
            },
            async: false,
            success: function (data) {
                if(data == 'over') { // 레슨잔여회차 0 ==> 레슨일지를 다 작성하여 레슨완료 상태
                    flag = false;
                    swal('레슨 잔여회차가 없습니다.');
                    return false;
                }
                if(data == 'fail') { // 현재 예약되어있는 레슨 횟수 == 최대 예약 가능 레슨 횟수
                    flag = false;
                    swal('예약 가능 횟수를 초과하였습니다.');
                    return false;
                }
            },
        });

        if(flag) {
            if(is_post) {
                return false;
            }
            is_post = true;

            if($('#reser_time').val() == '') {
                swal('예약시간을 선택하세요.');
                is_post = false;
                return false;
            }

            showLoadingBar();

            var form = $('form')[0];
            var formData = new FormData(form);

            $.ajax({
                url : g5_bbs_url + "/ajax.reser_request.php",
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                success : function(data) {
                    if(data == 'success'){
                        swal('예약요청이 완료되었습니다.')
                        .then(() => {
                            location.replace(g5_bbs_url+'/lesson_reser.php');
                        });
                    }
                    else if(data == 'error') {
                        swal('이미 예약된 시간입니다.');
                        is_post = false;
                        return false;
                    }
                    else if(data == 'error2') { // 22.06.09 예약 전 프로 휴무일인지 체크
                        swal('프로 휴무일입니다.')
                        .then(() => {
                            location.replace(g5_bbs_url+'/lesson_reser.php');
                        });
                    }
                },
                complete : function() {
                    hideLoadingBar();
                }
            });
        }
    }

    // 예약수정모달 (예약idx , 예약시간, 예약일자, 예약시간설정idx)
    function reser_mod_modal(idx, reser_time, reser_date, time_set_idx) {
        $('.check_bx').html(''); // 초기화

        showLoadingBar();
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_time_set.php",
            data: {reser_date : reser_date, reser_time : reser_time, pro_mb_no : pro_mb_no, mode : 'u'},
            type: 'POST',
            // async: false,
            success : function(data) {
                if(data){
                    $('.check_bx').html(data); // 예약시간설정(예약가능시간)
                }

                $('.lere_today').html('<span>선택한 날짜</span>'+reser_date);
                $('.lere_btn01').addClass('hide');
                $('.lere_modify').removeClass('hide');
                $('#myModal').modal('show');
                // $("input[name=ck_reser_time][value='" + reser_time + "']").prop("checked", true);
                $('#idx').val(idx);
                $('#reser_date').val(reser_date);
                $('#reser_time').val(reser_time);
                $('#time_set_idx').val(time_set_idx);
            },
            complete : function() {
                hideLoadingBar();
            }
        });
    }

    // 예약수정
    function reser_mod() {
        if(is_post) {
            return false;
        }
        is_post = true;

        if($('#reser_time').val() == '') {
            swal('예약시간을 선택하세요.');
            is_post = false;
            return false;
        }

        showLoadingBar();
        $.ajax({
            url : g5_bbs_url + "/ajax.reser_mod.php",
            data: { idx : $('#idx').val(), pro_mb_no : pro_mb_no, reser_date : $('#reser_date').val(), reser_time : $('#reser_time').val(), time_set_idx : $('#time_set_idx').val() },
            type: 'POST',
            success : function(data) {
                if(data == 'success'){
                    swal('예약수정이 완료되었습니다.')
                    .then(() => {
                        location.replace(g5_bbs_url+'/lesson_reser.php');
                    });
                }
                else if(data == 'fail') { // 21.12.07
                    swal('승인이 완료된 예약입니다.')
                    .then(() => {
                        location.replace(g5_bbs_url+'/lesson_reser.php');
                    });
                }
                else if(data == 'error') {
                    swal('이미 예약된 시간입니다.');
                    is_post = false;
                    return false;
                }
                else if(data == 'error2') { // 22.06.09 예약 전 프로 휴무일인지 체크
                    swal('프로 휴무일입니다.')
                    .then(() => {
                        location.replace(g5_bbs_url+'/lesson_reser.php');
                    });
                }
            },
            complete : function() {
                hideLoadingBar();
            }
        });
    }

    // 예약삭제
    function reser_del() {
        swal({
            text: "예약을 삭제하시겠습니까?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                showLoadingBar();
                $.ajax({
                    url : g5_bbs_url + "/ajax.reser_del.php",
                    data: { idx : $('#idx').val() },
                    type: 'POST',
                    success : function(data) {
                        if(data == 'fail') { // 21.12.07
                            swal('승인이 완료된 예약입니다.')
                            .then(() => {
                                location.replace(g5_bbs_url+'/lesson_reser.php');
                            });
                        } else {
                            swal('예약삭제가 완료되었습니다.')
                            .then(() => {
                                location.replace(g5_bbs_url+'/lesson_reser.php');
                            });
                        }
                    },
                    complete : function() {
                        hideLoadingBar();
                    }
                });
            }
        });
    }
</script>


<?php
include_once('./_tail.php');
?>
