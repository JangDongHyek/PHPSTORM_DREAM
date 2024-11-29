<?php
//$sub_menu = "200100";
include_once('./_common.php');

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
    $sql_search .= " and (re.reser_date >= '{$today}') ";
}

if(!empty($_GET['end_date'])) {
    $end_date = str_replace('-','.',$_GET['end_date']);
    $sql_search .= " and (re.reser_date <= '{$end_date}') ";
} else {
    $sql_search .= " and (re.reser_date <= '{$today}') ";
}

$sql = " select count(*) as cnt 
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where mb.pro_mb_no = '{$member['mb_no']}' {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select re.*, date_format(re.reg_date, '%Y.%m.%d') as reg_date, mb.mb_name, mb.mb_id_no
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where mb.pro_mb_no = '{$member['mb_no']}' {$sql_search} 
         order by re.reser_date desc, re.reser_time desc limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
?>

<!--<script src="<?php /*echo G5_THEME_JS_URL */?>/calendar.adm.js"></script>-->
<script src="<?php echo G5_THEME_JS_URL ?>/calendar.adm.lesson_reser.js"></script>

<!--시간설정 모달창 시작-->
<div id="timeset_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-header">
                    레슨시간 설정
                </div><!--.modal-header-->
                <div class="modal-body">
                    <div class="tset_box"><input type="time" id="input_time" class="input_tset" /><input type="button" value="추가" class="btn_tset" onclick="add_time($('#input_time').val());" /></div>

                    <!--시간 추가 후 나오는 리스트-->
                    <div class="tset_list">
                        <div class="tset_lt">설정시간</div>
                        <ul>
                        </ul>
                    </div><!--.tset_list-->

                </div><!--.modal-body-->
                <div class="modal-footer">
                    <button type="button" class="lere_btn01" onclick="reser_setting_comp();">시간설정 완료 </button>

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
                        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <input type="text" name="search_member" value="" id="search_member" required class="required frm_input" placeholder="회원번호 또는 이름을 입력하세요">
                        <input type="button" class="btn_submit" value="&#xf002" onclick="search_member();">

                        <dd style="float:none !important; width:100% !important; margin-top:5px;"><input type="text" placeholder="아래의 검색된 회원 중 선택해주세요" id="reser_name" name="reser_name" class="input01 readonly" readonly /></dd>
                        <div id="sea_mem_result">
                            <div class="sea_mem_result_in">
                                <div class="smr_tit"><i class="far fa-list-ul"></i> 검색된 회원 리스트</div>
                                <div id="search_member_result"></div>
                            </div><!--.sea_mem_result_in-->
                        </div><!--#sea_mem_result-->
                    </div><!--.lre_search-->
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
                        <!--시간설정 전 나오는 문구/ 시간설정 후 사라짐-->
                        <div class="lre_not"><i class="far fa-clock"></i> 예약가능한 시간을 먼저 설정해주세요.</div><!--.lre_not-->

                        <!--시간설정이 완료되었으면, '시간수정'으로 이름변경-->
                        <div class="time_set"><a href="javascript:void(0);" onclick="reser_setting();">시간설정 <i class="fas fa-cog"></i></a></div>
                    </div><!--.lre_tset-->

                    <div class="check_bx">
                        <p>예약 가능 시간이 없습니다.</p>
                        <!--<input type=checkbox name="a01" id="a01" value=""><label for="a01"><div>10:00</div></label>
                        <input type=checkbox name="a02" id="a02" value=""><label for="a02"><div>10:30</div></label>
                        <input type=checkbox name="a03" id="a03" value=""><label for="a03"><div>11:00</div></label>
                        <input type=checkbox name="a04" id="a04" value=""><label for="a04"><div>15:00</div></label>
                        <input type=checkbox name="a05" id="a05" value=""><label for="a05"><div>18:00</div></label>-->
                    </div>

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
    <input type="hidden" id="pro_info_idx" name="pro_info_idx"> <!-- 프로예약정보 idx -->
    <input type="hidden" id="mb_state" name="mb_state">
    <input type="hidden" id="lesson_code" name="lesson_code" value="">
    <input type="hidden" id="center_code" name="center_code" value="">
</form>

<!--예약자 리스트-->
<div id="lesson_reslist">
    <div class="lre_list_tit">레슨예약자 명단
    </div><!--.lre_list_tit-->
    <p><?=$listall?></p>

    <!--기간검색-->
    <form id="fsearch" name="fsearch" method="get">
        <div class="lre_ldate">
            <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? date('Y-m-d') : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? date('Y-m-d') : $_GET['end_date'] ?>" class="input_ldate"/><input type="submit" class="btn_ldate" value="검색">
        </div><!--.lre_ldate-->
    </form>

    <!--예약자 리스트 테이블-->
    <form action="ajax.approval_state_change.php" method="post">
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                <tr>
                    <th scope="col">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th>예약날짜</th>
                    <th>레슨 예약시간</th>
                    <th>회원번호</th>
                    <th>이 름</th>
                    <th>등록일자</th>
                    <th>예약상태</th>
                    <th>승인여부</th>
                    <th>레슨예약 수정/삭제</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for($i=0; $row=sql_fetch_array($result); $i++) {
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="idx[<?php echo $i ?>]" value="<?php echo $row['idx'] ?>" id="idx_<?php echo $i ?>">
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td><?=$row['reser_date']?></td>
                        <td><?=$row['reser_time']?></td>
                        <td><?=$row['mb_id_no']?></td>
                        <td style="cursor: pointer;" onclick="open_lesson_diary('<?=$row['mb_no']?>')"><?=$row['mb_name']?></td>
                        <td><?=$row['reg_date']?></td>
                        <td>
                            <?php if($row['reser_state'] == '예약대기') { ?><span class="btn_res btn_r01">예약대기</span><?php } ?>
                            <?php if($row['reser_state'] == '예약취소') { ?><span class="btn_res btn_r02">예약취소</span><?php } ?>
                            <?php if($row['reser_state'] == '노쇼') { ?><span class="btn_res btn_r03">노쇼</span><?php } ?>
                            <?php if($row['reser_state'] == '예약완료') { ?><span class="btn_res btn_r04">예약완료</span><?php } ?>
                        </td>
                        <td>
                            <select onchange="state_change('<?=$row['idx']?>',this.value);">
                                <option <?php if($row['reser_state'] == '예약대기') { ?> selected <?php } ?>>승인대기</option>
                                <option <?php if($row['reser_state'] == '예약취소') { ?> selected <?php } ?>>승인취소</option>
                                <option <?php if($row['reser_state'] == '노쇼') { ?> selected <?php } ?>>회원노쇼</option>
                                <option <?php if($row['reser_state'] == '예약완료') { ?> selected <?php } ?>>승인완료</option>
                            </select>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn_remo" onclick="reser_mod('<?=$row['idx']?>', '<?=$row['mb_name']?>', '<?=$row['reser_date']?>', '<?=$row['pro_info_idx']?>', '<?=$row['mb_id_no']?>', '<?=$row['reser_time']?>', '<?=$row['reser_state']?>');">수정</a>
                            <a href="javascript:void(0);" class="btn_remo" onclick="reser_del('<?=$row['idx']?>')">삭제</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date'].'&amp;page='); ?>

        <div class="btn_res02">
            <input type="submit" value="선택 일괄승인"  class="btn02"/>
            <!--<input type="submit" value="선택 수정"  class="btn03"/>-->
        </div>
    </form>

</div><!--#lesson_reslist-->


<script>
    var pro_mb_no = '<?=$mb_no?>';
    $(function() {
        // 프로예약정보(예약가능시간)
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_pro_info.php",
            data: {reser_date : '<?=date('Y.m.d')?>', pro_mb_no : pro_mb_no},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.check_bx').html(data); // 프로예약정보(예약가능시간)
                }
                else{
                    $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');
                }
            },
        });
        // 프로가 설정한 예약 가능 시간
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_pro_info.php",
            data: {reser_date : '<?=date('Y.m.d')?>', pro_mb_no : pro_mb_no, option : 'setting'},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.tset_list ul').html(data); // 프로가 설정한 예약 가능 시간

                    if($('.tset_list ul li').length != 0) {
                        $('.lre_not').addClass('hide');
                        $('.time_set').html('<a href="javascript:void(0);" onclick="reser_setting();">시간수정 <i class="fas fa-cog"></i></a>');
                    }
                }
                else{
                    $('.lre_not').removeClass('hide');
                    $('.time_set').html('<a href="javascript:void(0);" onclick="reser_setting();">시간설정 <i class="fas fa-cog"></i></a>');
                }
            },
        });
    });

    // 예약 시간 설정
    function reser_setting() {
        if($('#reser_date').val() == '') {
            alert('달력에서 날짜를 선택해주세요.');
            return false;
        }

        $('.tset_list ul').html(''); // 초기화
        $('#input_time').val(''); // 초기화
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_pro_info.php",
            data: {reser_date : $('#reser_date').val(), pro_mb_no : pro_mb_no, option : 'setting'},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.tset_list ul').html(data); // 프로가 설정한 예약 가능 시간
                }
            },
        });

        $('#myModal').modal('show');
    }

    // 예약 시간 선택 (예약시간, 프로예약정보idx)
    function reser_select(reser_time, pro_info_idx) {
        if($('#reser_date').val() == '') {
            alert('달력에서 날짜를 선택해주세요.');
            return false;
        }

        if($('#reser_name').val() == '') {
            alert('회원을 입력해주세요.');
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
        $('#pro_info_idx').val(pro_info_idx);
    }

    // 회원 검색
    function search_member() {
        $.ajax({
            type: 'POST',
            url: g5_admin_url + "/ajax.search_member.php",
            dataType: 'json',
            data: {
                member: $('#search_member').val(),
            },
            success: function (data) {
                if(data.length > 0) {
                    var html = '';
                    for(var i=0; i<data.length; i++) {
                        html += '<div style="cursor: pointer;margin-bottom: 5px;font-size: 15px;" onclick="select_member(\''+data[i]['mb_id_no']+'\',\''+data[i]['mb_name']+'\',\''+data[i]['mb_no']+'\', \''+data[i]['mb_state']+'\', \''+data[i]['lesson_code']+'\',\''+data[i]['center_code']+'\');">';
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
    function select_member(mb_id_no, name, mb_no, mb_state, lesson_code, center_code) {
        $('#reser_name').val(name);
        $('#mb_id_no').val(mb_id_no);
        $('#reser_mb_no').val(mb_no);
        // console.log(mb_state);
        if(mb_state == 'one_point_lesson') {
            $('#mb_state').val(mb_state);
        }
        $('#lesson_code').val(lesson_code);
        $('#center_code').val(center_code);
    }

    // 레슨 시간 추가
    function add_time(time) {
        if(time == '') {
            alert('시간을 선택하세요.');
            return false;
        }

        var index = 0;
        if($('.tset_list ul li').length != 0) {
            index = $('.tset_list ul li').last()[0].id.split('_')[1];
        }
        index++;
        $('.tset_list ul').append('<li id="time_'+index+'" class="r">'+time+' <a class="btn_tset" onclick="del_time(\''+index+'\')">삭제</a></li>');
        $('#input_time').val('');
    }

    // 레슨 시간 삭제(index, 삭제 idx) -- 삭제하고자 하는 시간에 예약정보가 있는지 확인해야함
    var delete_time = [];
    function del_time(i, idx) {
        $('#time_'+i).remove();

        if(idx != '') {
            delete_time.push(idx);
        }
    }

    // 레슨 시간 설정 완료
    var insert_time = [];
    function reser_setting_comp() {
        $('.tset_list ul .r').each(function() {
            var time = this.innerHTML.split(' ')[0];

            insert_time.push(time);
        });

        if(insert_time.length == 0 && delete_time.length == 0) {
            alert('레슨 시간을 설정하세요.');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: g5_admin_url + "/ajax.reser_setting_comp.php",
            data: {
                add_time: insert_time,
                delete_time: delete_time,
                reser_date: $('#reser_date').val(),
            },
            async: false,
            success: function (data) {
                // 예약시간 삭제 실패
                if(data == 'del_fail') {
                    alert('삭제 시간에 레슨 예약자가 있습니다.');
                    delete_time = []; // 초기화
                    $('#myModal').modal('hide');
                }
                else {
                    alert('시간 설정이 완료되었습니다.');
                    $('#myModal').modal('hide');

                    $.ajax({
                        url : g5_bbs_url + "/ajax.lesson_pro_info.php",
                        data: {reser_date : $('#reser_date').val(), pro_mb_no : pro_mb_no},
                        type: 'POST',
                        async: false,
                        success : function(data) {
                            if(data){
                                $('.check_bx').html(data); // 프로예약정보(예약가능시간)

                                // 초기화
                                $('.lre_not').addClass('hide');
                                $('.time_set').html('<a href="javascript:void(0);" onclick="reser_setting();">시간수정 <i class="fas fa-cog"></i></a>');

                                insert_time = [];
                                delete_time = [];
                            }
                            else {
                                $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');

                                $('.lre_not').removeClass('hide');
                                $('.time_set').html('<a href="javascript:void(0);" onclick="reser_setting();">시간설정 <i class="fas fa-cog"></i></a>');
                            }
                        },
                    });
                }
            },
        });
    }

    // 승인여부 변경(예약idx, 승인상태)
    function state_change(idx, state) {
        $.ajax({
            url : g5_admin_url + "/ajax.approval_state_change.php",
            data: {idx : idx, state : state},
            type: 'POST',
            success : function(data) {
                if(data){
                    alert('예약상태가 변경되었습니다.');
                    location.replace(g5_admin_url + '/lesson_reser.php');
                }
            },
        });
    }

    // 레슨예약 수정(예약idx, 이름, 예약일자, 프로예약정보idx, 회원번호, 예약시간, 상태)
    function reser_mod(idx, name, date, pro_info_idx, mb_id_no, time, state) {
        var today = getToday();
        if(today > date) {
            alert('지난 예약은 수정할 수 없습니다.');
            return false;
        }
        if(state == '예약취소') {
            alert('취소된 예약입니다.');
            return false;
        }

        // 레슨예약내용
        $('.lre_res').text(mb_id_no + ' ' + name + ' / ' + date + ' / ' + time);
        $('#reser_time').val(time);
        $('#mb_id_no').val(mb_id_no);
        $('#idx').val(idx);
        $('#pro_info_idx').val(pro_info_idx);

        $.ajax({
            url : g5_admin_url + "/ajax.lesson_info.php",
            data: {idx : idx},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.check_bx').html(data);
                    $('.lre_search').addClass('hide');
                    $('#reser_name').val(name);
                    $('#reser_date').val(date);
                    $('.cont_title').text('레슨수정');
                    $('.btn01').val('수정하기');
                }
            },
        });
    }

    // 예약하기/수정하기
    function reser_action(value) {
        if($('#reser_name').val() == '') {
            alert('회원을 입력해주세요.');
            return false;
        }
        if($('#reser_date').val() == '') {
            alert('달력에서 날짜를 선택해주세요.');
            return false;
        }
        if($('#reser_time').val() == '') {
            alert('예약시간을 선탁하세요.');
            return false;
        }

        var mode = '';
        if(value == '수정하기') {
            mode = 'u';
        }

        $.ajax({
            url : g5_admin_url + "/ajax.reser_action.php",
            data: {
                idx : $('#idx').val(),
                reser_date : $('#reser_date').val(),
                reser_time : $('#reser_time').val(),
                pro_info_idx : $('#pro_info_idx').val(),
                mb_no : $('#reser_mb_no').val(),
                mb_state : $('#mb_state').val(),
                lesson_code : $('#lesson_code').val(),
                center_code : $('#center_code').val(),
                mode : mode,
            },
            type: 'POST',
            success : function(data) {
                if(data == 'success'){
                    alert('예약이 완료되었습니다.')
                    location.replace(g5_admin_url+'/lesson_reser.php');
                }
                else {
                    alert('이미 예약된 시간입니다.');
                    return false;
                }
            },
        });
    }

    // 레슨예약 삭제(예약idx)
    function reser_del(idx) {
        // alert('준비중입니다.');

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

    function open_lesson_diary(mb_no) {
        var url = "./lesson_diary_form.php?mb_no="+mb_no;

        window.open(url, "add_lesson_diary", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
    }
</script>

<?php
include_once ('./admin.tail.php');
?>