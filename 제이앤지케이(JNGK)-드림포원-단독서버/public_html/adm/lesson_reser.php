<?php
//$sub_menu = "200100";
include_once('./_common.php');

/** 프로 - 레슨예약 **/

// bbs/lesson_reser.php -- 현재 파일 수정 시 왼쪽 파일 같이 확인

$g5['title'] = '레슨예약';
include_once('./admin.head.php');

$mb_no = $member['mb_no'];
$mb = get_member_no($mb_no);

$today = date('Y.m.d');

$sql_search = '';
if(!empty($_GET['start_date'])) {
    $start_date = str_replace('-','.',$_GET['start_date']);
    $sql_search .= " and (re.reser_date >= '{$start_date}') ";
} else {
    $_GET['start_date'] = $today;
    $sql_search .= " and (re.reser_date >= '{$today}') ";
}

if(!empty($_GET['end_date'])) {
    $end_date = str_replace('-','.',$_GET['end_date']);
    $sql_search .= " and (re.reser_date <= '{$end_date}') ";
} else {
    $_GET['end_date'] = $today;
    $sql_search .= " and (re.reser_date <= '{$today}') ";
}

// $sql = " select count(*) as cnt
//          from g5_lesson_reser as re
//          left join g5_member as mb on mb.mb_no = re.mb_no
//          where re.pro_mb_no = '{$member['mb_no']}' {$sql_search} ";
// $row = sql_fetch($sql);
// $total_count = $row['cnt'];
//
// //$rows = $config['cf_page_rows'];
// $rows = 40;
// //if($ip == '183.103.22.103') { $rows = 10; }
// $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
// if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
// $from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select re.*, date_format(re.reg_date, '%Y.%m.%d') as reg_date, mb.mb_name, mb.mb_id_no, ifnull(re2.no_diary, 0) as no_diary
         from g5_lesson_reser as re
         left join g5_member as mb on mb.mb_no = re.mb_no
         left join (select history_idx, count(*) as no_diary from g5_lesson_reser where reser_state='예약완료' and diary_idx is null group by history_idx) as re2 on re.history_idx = re2.history_idx
         where re.pro_mb_no = '{$member['mb_no']}' {$sql_search} 
         order by re.reser_date, re.reser_time ";
// if($private) echo $sql;
//$result = sql_query($sql);

// 22.10.26 레슨일지미작성 카운트 시작
// $his_idx_arr = sql_fetch(" select group_concat(history_idx order by reser_date, reser_time) as idx from g5_lesson_reser as re where pro_mb_no = '{$member['mb_no']}' {$sql_search} ")['idx'];
// $sql2 = " select history_idx, count(*) as no_diary_cnt from g5_lesson_reser where history_idx in ({$his_idx_arr}) and reser_state = '예약완료' and diary_idx is null group by history_idx order by reser_date, reser_time ";
// $result2 = sql_query($sql2);
//
// $his_arr = array();
// $no_diary_arr = array();
// for($k=0; $row2=sql_fetch_array($result2); $k++) {
//     array_push($his_arr, $row2['history_idx']);
//     array_push($no_diary_arr, $row2['no_diary_cnt']);
// }
// 22.10.26 레슨일지미작성 카운트 끝

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$colspan = 10;
?>

<!--<script src="<?php /*echo G5_THEME_JS_URL */?>/calendar.adm.js"></script>-->
<script src="<?php echo G5_THEME_JS_URL ?>/calendar.adm.lesson_reser.js?v=<?=G5_JS_VER?>"></script>

<!--시간설정 모달창 시작-->
<div id="timeset_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-header">
              레슨 시간 설정
          </div><!--.modal-header-->

          <div class="modal-body">
          	  <div class="tset_box2">
                  <p>예약 가능한 시간을 선택하세요.<br><strong>* 일자 입력 시 입력한 일자의 예약 가능한 시간이 설정됩니다.</strong></p>
                  <input type="date" id="set_date" name="set_date" class="frm_input">
		      </div>

              <!--시간 설정-->
              <div class="tset_list check_bx2"></div><!--.tset_list-->
          </div><!--.modal-body-->

          <div class="modal-footer">
              <button type="button" class="lere_btn01" onclick="time_setting_comp();">설정 완료</button>
          </div><!--.modal-footer-->
        </div><!--.modal-body-->
      </div>
    </div>
</div><!--#timeset_modal-->
<!--시간설정 모달창 끝-->

<div id="lesson_resbox">
	<div id="les_calendar">
        <div class="my-calendar clearfix">
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
                    <tbody class="cal-body"></tbody>
                </table>
            </div>
        </div>
    </div><!--#calendar-->

    <div id="les_rescont">

        <div class="lre_info">
        	<div class="dl_search">
                <dl>
                    <dt>회원명</dt>

                    <div class="lre_search">
                    	<div class="cf">
                        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <input type="text" name="search_member" value="" id="search_member" required class="required frm_input" placeholder="회원번호 또는 이름을 입력하세요" onkeyup="enter_key();" autocomplete="off">
                        <input type="button" class="btn_submit" value="&#xf002" onclick="search_member();">
                		</div>

                        <div class="lre_search_txt">
                        먼저 회원명을 검색하고, 아래 검색된 회원 중 선택해주세요.
                        </div><!--.lre_search_txt-->

                        <div id="sea_mem_result">
                            <div class="sea_mem_result_in">
                                <div class="smr_tit"><i class="far fa-list-ul"></i> 검색된 회원 리스트</div>
                                <div id="search_member_result"></div>
                            </div><!--.sea_mem_result_in-->
                        </div><!--#sea_mem_result-->
                    </div><!--.lre_search-->

                    <div class="lre_search_rlt hide" style="padding-top: 10px;"></div>
                </dl>
            </div> <!--.dl_search-->

            <dl>
                <dt>예약일</dt>
                <dd><input type="text" id="reser_date" name="reser_date" value="<?=date('Y.m.d')?>" placeholder="달력에서 날짜를 선택해주세요" class="input01 readonly" readonly /></dd>
            </dl>
            <dl>
                <dt>예약시간</dt>
                <dd>
                    <div class="lre_tset">
                        <div class="time_set"><a href="javascript:void(0);" onclick="time_setting();">시간설정 <i class="fas fa-cog"></i></a></div>
                    </div><!--.lre_tset-->

                    <div class="check_bx"></div>
                </dd>
            </dl>
        </div><!--.lre_info-->

        <div class="lre_result">
        	<div class="lre_rest">레슨예약 내용</div>
        	<div class="lre_res"></div><!--.lre_res-->
            <div class="lre_res_btn"><input type="button" value="예약하기" class="btn01" onclick="reser_action(this.value);" /><i class="fas fa-angle-right"></i></div>
        </div><!--.lre_result-->
    </div><!--#les_rescont-->
</div><!--#lesson_resbox-->

<form>
    <input type="hidden" id="reser_time" name="reser_time">
    <input type="hidden" name="mb_id_no" id="mb_id_no">
    <input type="hidden" name="reser_mb_no" id="reser_mb_no">
    <input type="hidden" id="idx" name="idx"> <!-- 레슨예약정보 idx -->
    <input type="hidden" id="time_set_idx" name="time_set_idx"> <!-- 예약시간설정 idx -->
    <input type="hidden" id="mb_state" name="mb_state">
    <input type="hidden" id="lesson_code" name="lesson_code" value="">
    <input type="hidden" id="center_code" name="center_code" value="">
    <input type="hidden" id="reser_name" name="reser_name">
</form>

<!--예약자 리스트-->
<div id="lesson_reslist">
	<div class="lre_list_tit">레슨예약자 명단
    </div><!--.lre_list_tit-->
    <p>&nbsp;<?/*=$listall*/?></p>

	<!--기간검색-->
    <form id="fsearch" name="fsearch" method="get">
        <div class="lre_ldate">
            <input type="date" id="start_date" name="start_date" value="<?php echo empty($_GET['start_date']) ? date('Y-m-d') : str_replace('.','-',$_GET['start_date']) ?>" class="input_ldate"/> ~ <input type="date" id="end_date" name="end_date" value="<?php echo empty($_GET['end_date']) ? date('Y-m-d') : str_replace('.','-',$_GET['end_date']) ?>" class="input_ldate"/>
            <input type="button" class="btn_ldate" value="검색" onclick="getLessonReserList($('#start_date').val(),$('#end_date').val())">
        </div><!--.lre_ldate-->
    </form>

	<!--예약자 리스트 테이블-->
    <form action="ajax.approval_state_change.php" method="post">
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="3%">
                <col width="10%">
                <col width="8%">
                <col width="8%">
                <col width="7%">
                <col width="10%">
                <col width="6%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th>예약날짜</th>
                <th>예약시간</th>
                <th>회원번호</th>
                <th>이 름</th>
                <th>등록일자</th>
                <th>일지미작성</th>
                <th>예약상태</th>
                <th>승인여부</th>
                <th>수정/삭제</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //for($i=0; $row=sql_fetch_array($result); $i++) {
            for($i=0; $i<0; $i++) {
                // 예약완료 상태의 일지 미작성 건수 표시
                $no_diary = $row['no_diary'];
                // $no_diary = sql_fetch(" select count(*) as cnt from g5_lesson_reser where history_idx = '{$row['history_idx']}' and reser_state = '예약완료' and diary_idx is null ")['cnt'];
                // if(!$private) {
                //     $no_diary = sql_fetch(" select count(*) as cnt from g5_lesson_reser where history_idx = '{$row['history_idx']}' and reser_state = '예약완료' and diary_idx is null ")['cnt'];
                // } else {
                //     $no_diary = $row['no_diary'];
                //     // $his_key = -1; // 키값
                //     // $no_diary = 0; // 미작성 건수
                //     // if(in_array($row['history_idx'], $his_arr)) {
                //     //     $his_key = array_search($row['history_idx'], $his_arr);
                //     //     $no_diary = $no_diary_arr[$his_key];
                //     // }
                // }
            ?>
            <tr>
                <td>
                    <input type="hidden" name="idx[<?php echo $i ?>]" value="<?php echo $row['idx'] ?>" id="idx_<?php echo $i ?>">
                    <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                </td>
                <td style="cursor: pointer;"><?=$row['reser_date']?></td>
                <td style="cursor: pointer;"><?=$row['reser_time']?></td>
                <td style="cursor: pointer;"><?=$row['mb_id_no']?></td>
                <td style="cursor: pointer;" onclick="open_lesson_diary('<?=$row['mb_no']?>')"><?=$row['mb_name']?></td>
                <td style="cursor: pointer;"><?=$row['reg_date']?></td>
                <td <?php echo !empty($no_diary) ? 'style="color: red;"' : ''; ?>><?=$no_diary?></td>
                <td>
                    <?php if($row['reser_state'] == '예약대기') { ?><span class="btn_res btn_r01">예약대기</span><?php } ?>
                    <?php if($row['reser_state'] == '예약취소') { ?><span class="btn_res btn_r02">예약취소</span><?php } ?>
                    <?php if($row['reser_state'] == '노쇼') { ?><span class="btn_res btn_r03">노쇼</span><?php } ?>
                    <?php if($row['reser_state'] == '예약완료') { ?><span class="btn_res btn_r04">예약완료</span><?php } ?>
                </td>
                <td>
                    <select id="reser_state_<?=$i?>" name="reser_state_<?=$i?>" onchange="state_change('<?=$row['idx']?>',this.value, '<?=$row['reser_state']?>', '<?=$row['mb_no']?>', '<?=$i?>');">
                        <option value="예약대기" <?php if($row['reser_state'] == '예약대기') { ?> selected <?php } ?>>승인대기</option>
                        <option value="예약취소" <?php if($row['reser_state'] == '예약취소') { ?> selected <?php } ?>>승인취소</option>
                        <option value="노쇼" <?php if($row['reser_state'] == '노쇼') { ?> selected <?php } ?>>회원노쇼</option>
                        <option value="예약완료" <?php if($row['reser_state'] == '예약완료') { ?> selected <?php } ?>>승인완료</option>
                    </select>
                </td>
                <td>
                    <a href="javascript:void(0);" class="btn_remo" onclick="reser_mod('<?=$row['idx']?>', '<?=$row['mb_name']?>', '<?=$row['reser_date']?>', '<?=$row['time_set_idx']?>', '<?=$row['mb_id_no']?>', '<?=$row['reser_time']?>', '<?=$row['reser_state']?>');">수정</a>
                    <a href="javascript:void(0);" class="btn_remo" onclick="reser_del('<?=$row['idx']?>')">삭제</a>
                </td>
            </tr>
            <?php
            }
            if($i==0) {
            ?>
            <tr>
                <td colspan="<?=$colspan?>">레슨 예약자가 없습니다.</td>
            </tr>
            <?php
            }
            ?>

            </table>
        </div>



</div><!--#lesson_reslist-->
<div class="btn_res02">
    <input type="submit" value="선택 일괄승인"  class="btn02"/>
</div>
</form>

<div class="paging">
    <?php /*echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date'].'&amp;page='); */?>
</div>

<script>

    if($('#start_date').val()){
        getLessonReserList($('#start_date').val(),$('#end_date').val());
    }

    var pro_mb_no = '<?=$mb_no?>';
    $(function() {
        // 예약시간설정(예약가능시간)
        showLoadingBar();
        $.ajax({
            url : g5_admin_url + "/ajax.lesson_time_set.php",
            data: {reser_date : '<?=date('Y.m.d')?>', pro_mb_no : pro_mb_no},
            type: 'POST',
            dataType: 'html',
            async: false,
            success : function(data) {
                if(data){
                    $('.check_bx').html(data); // 예약시간설정(예약가능시간)
                }
                else{
                    $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');
                }
            },
            error : function(request, status, err) {
                alert("오류가 발생하였습니다.\ncode = "+ request.status + " message = " + request.responseText + " error = " + err);
            },
            complete : function() {
                hideLoadingBar();
            },
        });
    });

    // 예약 시간 선택 (예약시간, 예약시간설정idx)
    function reser_select(reser_time, time_set_idx) {
        if($('#reser_date').val() == '') {
            alert('달력에서 날짜를 선택해주세요.');
            return false;
        }

        if($('#reser_name').val() == '') {
            alert('회원을 선택해주세요.');
            $('input[type="checkbox"][name="ck_reser_time"]').prop('checked', false);
            $('#search_member').focus();
            return false;
        }

        // input type = 'radio' 처럼 동작
        $('input[type="checkbox"][name="ck_reser_time"]').prop('checked', false);
        $("input[name=ck_reser_time][value='" + reser_time + "']").prop("checked", true);

        // 레슨예약내용
        $('.lre_res').text($('#mb_id_no').val() + ' ' + $('#reser_name').val() + ' / ' + $('#reser_date').val() + ' / ' + reser_time);
        $('#reser_time').val(reser_time);
        $('#time_set_idx').val(time_set_idx);
    }

    // 회원 검색
    function search_member() {
        if($.trim($('#search_member').val()) == '') {
            alert('회원번호 또는 이름을 입력하세요.');
            // $('#search_member').focus();
            return false;
        }

        $.ajax({
            type: 'POST',
            url: g5_admin_url + "/ajax.search_member.php",
            dataType: 'json',
            data: {
                member: $('#search_member').val(),
                option : 'reser',
            },
            success: function (data) {
                if(data.length > 0) {
                    var html = '';
                    for(var i=0; i<data.length; i++) {
                        html += '<div class="sh_mb" style="cursor: pointer;margin-bottom: 5px;font-size: 15px;" onclick="select_member(\''+data[i]['mb_id_no']+'\',\''+data[i]['mb_name']+'\',\''+data[i]['mb_no']+'\', \''+data[i]['mb_state']+'\', \''+data[i]['lesson_code']+'\',\''+data[i]['center_code']+'\', this);">';
                        html += '<span style="margin-right: 10px;">'+data[i]['mb_id_no']+'</span>';
                        html += '<span style="margin-right: 20px;">'+data[i]['mb_name']+'</span>';
                        html += '</div>';
                    }

                    $('#search_member_result').html(html);
                }
                else {
                    $('#search_member_result').html('<div style="margin-bottom: 5px;font-size: 15px;">검색된 회원이 없습니다.</div>');
                }
            },
        });
    }

    // 회원 검색 후 선택 (회원번호, 회원명, 회원mb_no, 회원구분, 레슨정보, 센터정보)
    function select_member(mb_id_no, name, mb_no, mb_state, lesson_code, center_code, div) {
        var flag = true;

        showLoadingBar();
        setTimeout(function() {
            // 레슨 예약 가능한 회원인지 체크 (잔여회차 확인)
            $.ajax({
                type: 'POST',
                url: g5_admin_url + "/ajax.lesson_reser_check.php",
                data: {
                    mb_no: mb_no,
                },
                async: false,
                success: function (data) {
                    if(data == 'over') { // 레슨잔여회차 0 ==> 레슨일지를 다 작성하여 레슨완료 상태
                        flag = false;
                        alert('레슨 잔여회차가 없습니다.');
                        return false;
                    }
                    if(data == 'fail') { // 현재 예약되어있는 레슨 횟수 == 최대 예약 가능 레슨 횟수
                        flag = false;
                        alert('예약 가능 횟수를 초과하였습니다.');
                        return false;
                    }
                },
                complete: function() {
                    hideLoadingBar();
                }
            });

            if(flag) {
                // 선택한 회원 색 표시
                $('.sh_mb').attr('style', 'cursor: pointer;margin-bottom: 5px;font-size: 15px;');
                $(div).attr('style', 'cursor: pointer;margin-bottom: 5px;font-size: 15px;background:#f3d420');

                $('#reser_name').val(name);
                $('#mb_id_no').val(mb_id_no);
                $('#reser_mb_no').val(mb_no);
                // console.log(mb_state);
                if(mb_state == 'one_point_lesson') {
                    $('#mb_state').val(mb_state);
                }
                $('#lesson_code').val(lesson_code);
                $('#center_code').val(center_code);

                $('.lre_res').text(mb_id_no + ' ' + name);
            }
        }, 50);
    }

    // 승인여부 변경(예약idx, 승인상태, 예약상태, mb_no, 행)
    function state_change(idx, state, reser_state, mb_no, i) {
        var valid = lesson_comp_chk(idx);

        if(valid)
        {
            var valid2 = true;
            if(state == '노쇼') {
                if(!confirm('회원노쇼 처리 시 회원 레슨 잔여회차 1회 차감되며,\n승인여부 재수정 불가능합니다.\n변경하시겠습니까?')) {
                    valid2 = false;
                }
            }

            if(valid2)
            {
                $.ajax({
                    url : g5_admin_url + "/ajax.approval_state_change.php",
                    data: {idx : idx, state : state, mb_no : mb_no},
                    type: 'POST',
                    success : function(data) {
                        if(data){
                            alert('예약상태가 변경되었습니다.');
                            location.replace(g5_admin_url + '/lesson_reser.php');
                        }
                    },
                    error : function(request, status, err) {
                        alert("오류가 발생하였습니다.\ncode="+request.status+"/message="+request.responseText+"/error="+err);
                    },
                });
            }

            else {
                $('#reser_state_'+i).val(reser_state);
            }
        }
        else
        {
            $('#reser_state_'+i).val(reser_state);
        }
    }

    // 레슨예약 수정(예약idx, 이름, 예약일자, 예약시간설정idx, 회원번호, 예약시간, 상태)
    function reser_mod(idx, name, date, time_set_idx, mb_id_no, time, state) {
        var valid = lesson_comp_chk(idx); // 레슨완료 예약인지 확인

        if(valid)
        {
            var today = getToday();
            if(today > date) {
                alert('지난 예약은 수정할 수 없습니다.');
                return false;
            }
            if(state == '예약취소') {
                alert('취소된 예약입니다.');
                return false;
            }

            showLoadingBar();
            $.ajax({
                url : g5_admin_url + "/ajax.lesson_time_set.php",
                data: {pro_mb_no : pro_mb_no, reser_date : date, reser_time : time, mode : 'u'},
                type: 'POST',
                dataType: 'html',
                async: false,
                success : function(data) {
                    if(data){
                        $('.check_bx').html(data);
                        $('.lre_search').addClass('hide');
                        $('.lre_search_rlt').removeClass('hide');
                        $('.lre_search_rlt').text(name);
                        $('#reser_name').val(name);
                        $('#reser_date').val(date);
                        $('.cont_title').text('레슨수정');
                        $('.btn01').val('수정하기');
                    }

                    // 레슨예약내용
                    $('.lre_res').text(mb_id_no + ' ' + name + ' / ' + date + ' / ' + time);
                    $('#reser_time').val(time);
                    $('#mb_id_no').val(mb_id_no);
                    $('#idx').val(idx);
                    $('#time_set_idx').val(time_set_idx);
                },
                error : function(request, status, err) {
                    alert("오류가 발생하였습니다.\ncode="+request.status+"/message="+request.responseText+"/error="+err);
                },
                complete : function() {
                    hideLoadingBar();
                }
            });
        }
    }

    // 예약하기/수정하기
    var is_post = false; // 중복 post 체크
    function reser_action(value) {
        if(is_post) {
            return false;
        }
        is_post = true;

        if($('#reser_name').val() == '') {
            alert('회원을 선택해주세요.');
            is_post = false;
            return false;
        }
        if($('#reser_date').val() == '') {
            alert('달력에서 날짜를 선택해주세요.');
            is_post = false;
            return false;
        }
        if($('#reser_time').val() == '') {
            alert('예약시간을 선택하세요.');
            is_post = false;
            return false;
        }

        var mode = '';
        if(value == '수정하기') {
            mode = 'u';
        }

        $('#start_date').val($('#reser_date').val().replace(/\./g, '-'));
        $('#end_date').val($('#reser_date').val().replace(/\./g, '-'));

        showLoadingBar();
        $.ajax({
            url : g5_admin_url + "/ajax.reser_action.php",
            data: {
                idx : $('#idx').val(),
                reser_date : $('#reser_date').val(),
                reser_time : $('#reser_time').val(),
                time_set_idx : $('#time_set_idx').val(),
                mb_no : $('#reser_mb_no').val(),
                mb_state : $('#mb_state').val(),
                lesson_code : $('#lesson_code').val(),
                center_code : $('#center_code').val(),
                mode : mode,
                pro_mb_no : pro_mb_no,
            },
            type: 'POST',
            success : function(data) {
                if(data == 'success'){
                    alert('예약이 완료되었습니다.')
                    location.replace(g5_admin_url+'/lesson_reser.php');
                }
                else {
                    alert('이미 예약된 시간입니다.');
                    is_post = false;
                    return false;
                }
            },
            complete: function() {
                hideLoadingBar();
            }
        });
    }

    // 레슨예약 삭제(예약idx)
    function reser_del(idx) {
        var valid = lesson_comp_chk(idx); // 레슨완료 예약인지 확인

        if(valid)
        {
            if(confirm('예약을 삭제하시겠습니까?')) {
                $.ajax({
                    url : g5_bbs_url + "/ajax.reser_del.php",
                    data: { idx : idx },
                    type: 'POST',
                    success : function(data) {
                        if(data){
                            alert('예약이 삭제되었습니다.')
                            location.replace(g5_admin_url+'/lesson_reser.php');
                        }
                    },
                });
            }
        }
    }

    function getToday(){
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
        var date = now.getDate();

        return year + "." + addZero(month) + "." + addZero(date);
    }

    function addZero(num) {
        return (num < 10) ? '0' + num : num;
    }

    // 레슨일지팝업창
    function open_lesson_diary(mb_no) {
        var url = "./lesson_diary_form.php?mb_no="+mb_no+"&path=reser";

        if('<?=$ios_flag?>' || '<?=$android_flag?>') {
            location.href = url;
        }

        window.open(url, "add_lesson_diary", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
    }

    // 예약 시간 설정
    function time_setting() {
        showLoadingBar();
        // 프로가 설정한 예약 가능 시간
        $('#set_date').val('');
        $.ajax({
            url : g5_admin_url + "/ajax.lesson_time_set_pro.php",
            data: {pro_mb_no : pro_mb_no, reser_date : $('#reser_date').val()},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.tset_list').html('<input type=checkbox name="chkall" id="chkall" onclick="checkAll(this.form)"><label for="chkall"><div style="font-size: 20px; margin-top:-4px;"> </div></label><br><br>'+data); // 프로가 설정한 예약 가능 시간

                    if($('#hide_set_date').val() != '') {
                        $('#set_date').val($('#hide_set_date').val());
                    }
                    if($('#hide_chkall').val() == 'Y') {
                        $('#chkall').prop('checked', true);
                    } else {
                        $('#chkall').prop('checked', false);
                    }
                }

                $('#myModal').modal('show');
            },
            complete : function() {
                hideLoadingBar();
            }
        });

    }

    // 예약 시간 설정 완료
    var set_time = [];
    function time_setting_comp() {
        set_time = [];
        $('input:checkbox[name=ck_set_time]').each(function() {
            if(!this.checked) {
                set_time.push(this.value);
            }
        });

        showLoadingBar();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: g5_admin_url + "/ajax.time_setting_comp.php",
                data: {
                    set_time: set_time,
                    set_date: $('#set_date').val(),
                },
                async: false,
                success: function (data) {
                    if(data == 'success') {
                        alert('시간 설정이 완료되었습니다.');
                        $('#myModal').modal('hide');

                        // 예약시간설정(예약가능시간)
                        $.ajax({
                            url : g5_admin_url + "/ajax.lesson_time_set.php",
                            data: {reser_date : $('#reser_date').val(), reser_time : $('#reser_time').val(), pro_mb_no : pro_mb_no},
                            type: 'POST',
                            dataType: 'html',
                            async: false,
                            success : function(data) {
                                if(data){
                                    $('.check_bx').html(data); // 예약시간설정(예약가능시간)
                                }
                                else{
                                    $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');
                                }
                            },
                        });
                    }
                    else if(data == 'fail') { // 22.06.09 날짜 지정하여 휴무일 지정 시 휴무일에 예약된 레슨이 있는지 확인
                        alert('선택한 일자(시간)에 예약된 레슨이 있습니다.');
                    }
                },
                complete: function() {
                    hideLoadingBar();
                }
            });
        }, 100);
    }

    // 엔터키 적용
    function enter_key() {
        if (window.event.keyCode == 13) {
            // 엔터키가 눌렸을 때 실행할 내용
            search_member();
        }
    }

    // 레슨완료 예약인지 확인
    function lesson_comp_chk(idx) {
        // 수정 시 레슨 완료 데이터인지 확인 ==> 레슨완료 시 수정 불가 처리
        var valid = true;
        $.ajax({
            url : g5_admin_url + "/ajax.lesson_comp_chk.php",
            data: {idx : idx},
            type: 'POST',
            async: false,
            success : function(data) {
                if(data == 'fail'){
                    alert('레슨완료 예약입니다.');
                    valid = false;
                }
            },
        });

        return valid;
    }

    // 전체 체크박스
    function checkAll()
    {
        var chk = document.getElementsByName("ck_set_time");

        for (i=0; i<chk.length; i++) {
            if($("input:checkbox[name=chkall]").is(':checked')) {
                chk[i].checked = 'checked';
            } else {
                chk[i].checked = '';
            }
        }
    }

    // 레슨예약자 명단
    function getLessonReserList(start_date,end_date) {
        /*
        location.href = g5_admin_url + '/lesson_reser.php?token=<?=$_GET['token']?>&start_date='+reser_date+'&end_date='+reser_date;
        */
        $('.paging').html('');
        $('.mb_tbl tbody').html('<tr><td colspan="9999">로딩중...</td></tr>');
        $.ajax({
            url : g5_admin_url + "/ajax.lesson_reser_list.php",
            //data : {reser_date : reser_date},
            data : {start_date2 : start_date,end_date2 : end_date},
            type : 'POST',
            dataType: 'html',
            async: true,
            success : function(data) {
                $('.paging').html('');
                $('.mb_tbl tbody').html(data);
            },
        });
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
