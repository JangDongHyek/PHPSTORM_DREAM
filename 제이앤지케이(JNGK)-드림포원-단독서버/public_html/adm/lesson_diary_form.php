<?php
//$sub_menu = "220100";
include_once('./_common.php');

/** 프로 - 레슨일지 작성 팝업창 **/

// 회원, 레슨정보
$sql = " select mb.*, le.* from g5_member as mb left join g5_lesson as le on le.lesson_code = mb.lesson_code and le.center_code = mb.center_code where mb.mb_no = {$_GET['mb_no']} ";
$mb = sql_fetch($sql);

// 레슨일지
$count = sql_fetch( " select count(*) as count from g5_lesson_diary as ld left join g5_member as mb on ld.mb_no = mb.mb_no where mb.mb_no = {$_GET['mb_no']} and ld.history_idx = {$mb['history_idx']} ")['count'];

$sql = " select ld.* from g5_lesson_diary as ld left join g5_member as mb on ld.mb_no = mb.mb_no where mb.mb_no = {$_GET['mb_no']} and ld.history_idx = {$mb['history_idx']} order by idx desc ";
//if($private) {
//    echo $sql;
//}
$result = sql_query($sql);

// 22.01.07 상품 삭제 시 레슨명 제대로 안나와서 수정
$his = sql_fetch(" select * from g5_member_history where idx = '{$mb['history_idx']}' "); // 히스토리
$tmp = explode('/', $his['lesson_name']);
$lesson_name = '';
for($i=0; $i<count($tmp); $i++) {
    if($i==count($tmp)-1) { // 레슨금액
        $lesson_name .= number_format($tmp[$i]);
    } else {
        $lesson_name .= $tmp[$i].'/';
    }
}
//$lesson_name = $mb['lesson_name'].'/'.$mb['lesson_time'].'/'.$mb['lesson_count'].'/'.number_format($mb['lesson_price']);

$g5['title'] = '레슨 일지 작성';
include_once(G5_PATH.'/head.sub.php');

$colspan = 8;
?>

<style>
    .bg {
        background: lightgrey;
    }
    .hide {
        display: none;
    }
    .readonly {
        background: #f2f2f2 !important;
    }
    textarea {
        white-space: pre-wrap;
        font-family: inherit;
    }
    select {
        font-family: inherit;
    }
    .btn_remo {
        display: inline-block;
        width: 75px;
        line-height: 32px;
        text-align: center;
        border-radius: 3px;
        border: 1px solid #ccc;
        background: #f2f2f2;
    }
</style>

<div id="menu_frm" class="new_win">
    <div class="metf"><?php echo $g5['title']; ?></div>

    <form name="flessonform" id="flessonform" method="post" action="./lesson_diary_form_update.php" onsubmit="return flessonform_submit(this);" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" id="w" value="<?=$w?>">
        <input type="hidden" name="idx" id="idx" value="">
        <input type="hidden" name="mb_no" id="mb_no" value="<?=$_GET['mb_no']?>">
        <input type="hidden" name="del_video" id="del_video" value="">
        <input type="hidden" name="path" id="path" value="<?=$_GET['path']?>">
        <input type="hidden" name="history_idx" id="history_idx" value="<?=$mb['history_idx']?>">

        <div class="tbl_head01 tbl_wrap">
            <table>
                <tbody>
                    <tr>
                        <td><label for="chk">회원명</label></td>
                        <td><input type="text" name="mb_name" id="mb_name" value="<?=$mb['mb_name']?>" required class="required frm_input full_input readonly" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="chk">레슨명</label></td>
                        <td>
                            <input type="text" name="lesson_name" id="lesson_name" value="<?php if(!empty($mb['lesson_idx'])) { echo $lesson_name; } ?>" required class="required frm_input full_input readonly" readonly>
                            <input type="hidden" name="lesson_code" id="lesson_code" value="<?=$mb['lesson_code']?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="chk">레슨일자</label></td>
                        <td>
                            <select class="frm_input full_input" id="reser_idx" name="reser_idx" onchange="reser_select(this.value);">
                                <?php
                                // 22.03.10 현재 담당프로에게 예약된 리스트만 조회 (re.pro_mb_no = '{$mb['pro_mb_no']}' 추가)
                                $reser_sql_search = " and re.mb_no = '{$mb['mb_no']}' and re.pro_mb_no = '{$mb['pro_mb_no']}' and re.reser_state = '예약완료' and re.diary_idx is null ";

                                //$reser_count = sql_fetch( " select count(*) as count from g5_lesson_reser as re left join g5_lesson_diary as diary on diary.reser_idx = re.idx where re.mb_no = {$mb['mb_no']} and re.reser_state = '예약완료' and diary.reser_idx is null; " )['count'];
                                // 22.01.18 업체 요청으로 이전 상품의 레슨까지 다 보이도록 변경 (and re.history_idx = '{$mb['history_idx']}' 삭제)
                                $reser_count = sql_fetch( " select count(*) as count from g5_lesson_reser as re where 1 {$reser_sql_search} " )['count'];

                                if($reser_count > 0) {
                                ?>
                                <option value="">레슨 일자 선택</option>
                                <?php
                                } else {
                                    $hide = 'hide';
                                ?>
                                <option value="">레슨이 없습니다.</option>
                                <?php
                                }

                                //$sql = " select re.* from g5_lesson_reser as re left join g5_lesson_diary as diary on diary.reser_idx = re.idx where re.mb_no = {$mb['mb_no']} and re.reser_state = '예약완료' and diary.reser_idx is null order by re.reser_date, re.reser_time ";
                                // 22.01.18 업체 요청으로 이전 상품의 레슨까지 다 보이도록 변경 (and re.history_idx = '{$mb['history_idx']}' 삭제)
                                $sql = " select re.* from g5_lesson_reser as re where 1 {$reser_sql_search} order by re.reser_date, re.reser_time ";
                                $reser_info = sql_query($sql);

                                for($i=0; $reser=sql_fetch_array($reser_info); $i++) {
                                ?>
                                <option value="<?=$reser['idx']?>"><?=$reser['reser_date']?> <?=$reser['reser_time']?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <br>* 일지를 작성하지 않은 레슨을 조회합니다.
                            <!--<br>* 예약상태 : 예약완료-->
                            <input type="hidden" id="lesson_date" name="lesson_date" value="">
                            <input type="hidden" id="lesson_time" name="lesson_time" value="">
                        </td>
                        <!--<td><label for="chk">레슨일자</label></td>
                        <td><input type="date" name="lesson_date" id="lesson_date" value="<?php /*if(empty($lesson['lesson_date'])) { echo date('Y-m-d'); } */?>" required class="required frm_input full_input"></td>-->
                    </tr>
                    <tr>
                        <td><label for="chk">레슨회차</label></td>
                        <td>
                            <?php
                            if($count == 0) { // 레슨일지 미작성 -- 첫회차부터 시작
                                $lesson_count = 1;
                            } else {
                                $remain_count = sql_fetch("select min(ld.lesson_remain_count) as remain_count from g5_lesson_diary as ld left join g5_member as mb on ld.mb_no = mb.mb_no where mb.mb_no = {$_GET['mb_no']} and ld.history_idx = {$mb['history_idx']} ")['remain_count'];
                                if($remain_count != 0) {
                                    $lesson_count = $count + 1;
                                } else {
                                    $lesson_count = '남은 회차가 없습니다.';
                                    $hide = 'hide';
                                }
                            }
                            ?>
                            <input type="text" readonly name="lesson_count" id="lesson_count" value="<?=$lesson_count?>" required class="required frm_input full_input readonly">

                        </td>
                    </tr>
                    <tr>
                        <td><label for="chk">레슨내용</label></td>
                        <td><textarea id="lesson_contents" name="lesson_contents" class="full_input frm_text" style="resize: unset;"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="chk">동영상등록</label></td>
                        <td>
                            <input type="file" id="file" name="file" accept="video/*">
                            <div id="video_area"></div>
                            <!--<video id="videoPlay" width="300" height="200" controls>

                            </video>-->
                        </td>
                    </tr>
                    <tr>
                        <td><label for="chk">회원메모</label></td>
                        <td><textarea id="lesson_mb_memo" name="lesson_mb_memo" class="full_input readonly frm_text" readonly style="resize: unset;" placeholder="회원 등록 메모입니다."></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="chk">메모</label></td>
                        <td><textarea id="lesson_memo" name="lesson_memo" class="full_input frm_text" style="resize: unset;"></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </form>

    <div class="btn_confirm01 btn_confirm <?=$hide?>" style="margin-bottom: 25px;z-index: 10000;">
        <!--<input type="button" name="act_button" value="초기화" class="btn_cancel" onclick="clear_form();">-->
        <!--<input type="submit" name="act_button" value="작성" class="btn_submit">-->
        <input type="button" name="act_button" value="작성" class="btn_submit" onclick="form_ajax();" style="width: 100px;height: 40px;">
    </div>

    <hr>

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="5%">
                <col width="10%">
                <col width="*">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <!--<col width="10%">-->
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>회원명</th>
                <th>레슨명</th>
                <th>레슨일자</th>
                <th>레슨회차</th>
                <th>동영상</th>
                <!--<th>회원메모</th>-->
                <th>메모</th>
                <th>수정</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $k = $count;
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $video_sql = " select * from g5_lesson_video where diary_idx = '{$row['idx']}' ";
                $video = sql_fetch($video_sql);
                $video_src = '';
                if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) {
                    $video_src = G5_DATA_URL . '/file/lesson/' . $video['img_file'];
                }
                ?>
                <tr>
                    <td><?=$k?></td>
                    <td><?=$mb['mb_name']?></td>
                    <td><?=$lesson_name?></td>
                    <td><?=$row['lesson_date']?></td>
                    <td><?=$row['lesson_count']?>회</td>
                    <td><?php if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) { ?>○<?php } else { ?>X<?php } ?></td>
                    <!--<td><?/*=$row['lesson_mb_meno']*/?></td>-->
                    <td><?=$row['lesson_memo']?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn_remo" onclick="lesson_diary_info(this,'<?=$row['idx']?>', '<?=$video_src?>', '<?=$row['reser_idx']?>')">수정</a>
                    </td>
                </tr>
            <?php
                $k--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

</div>

<script>
$(function() {
    if($("#reser_idx option:checked").text() == '레슨이 없습니다.') {
        $('#reser_idx').attr('disabled', true);
        $('#reser_idx').addClass('readonly');
    }

    hideLoadingBar(); // 로딩바 숨김
});

function flessonform_submit(f)
{
    if($('#reser_idx').val() == '') {
        alert('레슨 일자를 선택하세요.');
        return false;
    }

    return true;
}

// submit
var is_post = false; // 중복 post 체크
function form_ajax() {
    if(is_post) {
        return false;
    }
    is_post = true;

    // 최대용량 체크
    // var file = document.getElementById('file');
    // var	max_size_mb = 30, // 30mb
    //     max_byte = max_size_mb * 1024 * 1024,
    //     file_byte = file.files[0].size;
    // if (file_byte > max_byte) {
    //     swal("최대 용량 30MB를 초과합니다.");
    //     $('#file').val('');
    //     is_post = true;
    //     return false;
    // }

    if($('#reser_idx').val() == '') {
        alert('레슨 일자를 선택하세요.');
        is_post = false;
        return false;
    }

    var form = $('form')[0];
    var formData = new FormData(form);

    $.ajax({
        url : g5_admin_url + "/lesson_diary_form_update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            if(data){
                alert('저장되었습니다.');
                if($('#path').val() == 'sch') { // 회원현황
                    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
                        location.replace(g5_admin_url+'/pro_lesson.php');
                    }
                    opener.document.location.replace(g5_admin_url+'/pro_lesson.php');
                    window.close();
                } else if($('#path').val() == 'reser') { // 프로 - 레슨예약
                    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
                        location.replace(g5_admin_url+'/lesson_reser.php');
                    }
                    opener.document.location.reload(); // 레슨예약 화면 새로고침
                    window.close();
                } else { // 프로 - 레슨스케줄
                    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
                        location.replace(g5_admin_url+'/member_list.php');
                    }
                    opener.document.location.replace(g5_admin_url+'/member_list.php');
                    window.close();
                }
            }
        },
        error : function(request, status, err) {
            alert("오류가 발생하였습니다.\ncode="+request.status+"/message="+request.responseText+"/error="+err);
        },
        complete : function() {
            hideLoadingBar();
        },
        beforeSend : function() {
            showLoadingBar();
        },
    });
}

// 회원-레슨일지수정 (선택 tr, 레슨일지idx, 동영상, 레슨예약idx)
function lesson_diary_info(tr, idx, video, reser_idx) {
    $('.mb_tbl tr').removeClass('bg');
    $($(tr).parents('tr')[0]).addClass('bg'); // 행 선택 시 배경색
    $('#w').val('u');
    $('#idx').val(idx);

    $.ajax({
        url : g5_admin_url + "/ajax.lesson_diary.php",
        data: {idx : idx},
        type: 'POST',
        success : function(data) {
            data = JSON.parse(data);

            $('#lesson_date').val(data.lesson_date);
            $('#lesson_time').val(data.lesson_time);
            $('#lesson_count').val(data.lesson_count);
            $('textarea#lesson_mb_memo').attr('placeholder','');
            $('textarea#lesson_mb_memo').val(data.lesson_mb_memo);
            $('textarea#lesson_memo').val(data.lesson_memo);
            $('textarea#lesson_contents').val(data.lesson_contents);

            $('#reser_idx').html('<option value='+reser_idx+' checked>'+data.lesson_date+' '+data.lesson_time+'</option>');
            $('#reser_idx').attr('disabled', true);
            $('#reser_idx').addClass('readonly');
            $('.btn_confirm').removeClass('hide');
        },
    });

    if(video != '') {
        $('#file').addClass('hide');
        $('#video_area').html('<video id="videoPlay" width="300" height="200" controls src="'+video+'"></video><br><input type="button" value="삭제" class="del" onclick="video_del(\''+idx+'\');" ">');
    } else {
        $('#file').val('');
        $('#file').removeClass('hide');
        $('#video_area').html('');
    }
}

// 레슨일지 폼 초기화
function clear_form() {
    $('.mb_tbl tr').removeClass('bg');
    $('#w').val('');
    $('#idx').val('');
    $('#lesson_date').val(getToday());
    $('#lesson_count').val('');
    $('textarea#lesson_mb_memo').attr('placeholder','회원 등록 메모입니다.');
    $('textarea#lesson_mb_memo').val('');
    $('textarea#lesson_memo').val('');
}

function getToday(){
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
    var date = now.getDate();

    return year + "-" + addZero(month) + "-" + addZero(date);
}

function addZero(num) {
    return (num < 10) ? '0' + num : num;
}

// 동영상 삭제
function video_del(idx) {
    if (confirm("동영상을 삭제하시겠습니까?")) {
        $('#del_video').val(idx);

        $('#file').removeClass('hide');
        $('#video_area').html('');
    }
}

// 레슨일자 선택
function reser_select(idx) {
    var lesson_date = $("#reser_idx option:checked").text().split(' ')[0];
    var lesson_time = $("#reser_idx option:checked").text().split(' ')[1];
    $('#lesson_date').val(lesson_date);
    $('#lesson_time').val(lesson_time);
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
