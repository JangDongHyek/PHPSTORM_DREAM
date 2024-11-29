<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// 3개월 이전 레슨 동영상 삭제 (DB는 남겨두고 파일만 삭제)
$tmpTimestamp = strtotime(date('Y-m-d') . " -3 months");
$beforeDate = date('Y-m-d', $tmpTimestamp);

$lessonFileCount = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_lesson_video WHERE del_yn = 'N' AND DATE_FORMAT(img_datetime, '%Y-%m-%d') = '{$beforeDate}'")['cnt'];
if($lessonFileCount > 0) {
    $lessonFileSql = "SELECT * FROM g5_lesson_video WHERE del_yn = 'N' AND DATE_FORMAT(img_datetime, '%Y-%m-%d') = '{$beforeDate}' ORDER BY idx";
    $lessonFileRlt = sql_query($lessonFileSql);

    for($aa=0; $row=sql_fetch_array($lessonFileRlt); $aa++) {
        $fileToDeletePath = G5_DATA_PATH.'/file/lesson/'.$row['img_file'];
        if (file_exists($fileToDeletePath)) {
            if (unlink($fileToDeletePath)) {
                sql_fetch("UPDATE g5_lesson_video SET del_yn = 'Y' WHERE idx = '{$row['idx']}'"); // 삭제여부 업데이트
                // echo '파일삭제<br>';
            }
        } else {
            // echo '파일없음<br>';
        }
    }
} else {
    // echo '파일없음<br>';
}

// get_cookie 확인
if($member['get_ck_mb_id'] != get_cookie('ck_mb_id') || $member['get_ck_auto'] != get_cookie('ck_auto')) {
    $sql = " update g5_member 
             set 
             get_ck_mb_id = '".get_cookie('ck_mb_id')."', 
             get_ck_auto = '".get_cookie('ck_auto')."', 
             get_ck_datetime = '".G5_TIME_YMDHIS."' 
             where mb_id = '{$member['mb_id']}' and use_yn = 'Y' ";
    sql_query($sql);
}

// ===== 21.02.28 회원현황 조회 시 미등록회원, 휴면회원 체크 시작 =====
$today = date('Y-m-d');

if($member['mb_category'] == '팀장') {
    $sql = " select * from g5_member where mb_category='회원' and center_code = '{$member['center_code']}' ";
    $result = sql_query($sql);
}
else {
    $sql = " select * from g5_member where mb_category='회원' and pro_mb_no = '{$member['mb_no']}' ";
    $result = sql_query($sql);
}

for($i=0; $row=sql_fetch_array($result); $i++) {
    if(!empty($row['no_register_date'])) {
        if($row['mb_state'] == 'new_member' || $row['mb_state'] == 're_member' || $row['mb_state'] == 'one_point_lesson') { // 신규나 재등록, 원포인트 회원 중
            if($today > $row['lesson_end_date'] && $row['lesson_end_date'] != '0000-00-00' && $row['lesson_end_date'] != '1970-01-01') { // 금일이 레슨종료일 이후면 미등록 회원으로 전환시킬 것
                $sql = " update g5_member set mb_state = 'no_register' where mb_no = {$row['mb_no']} ";
                sql_query($sql);
            }
        }

        if($row['mb_state'] == 'no_register') { // 미등록 회원 중
            if($today >= $row['no_register_date'] && $row['lesson_end_date'] != '0000-00-00' && $row['lesson_end_date'] != '1970-01-01') { // 금일이 휴면회원전환일 이후면 휴면회원으로 전환시킬 것
                $sql = " update g5_member set mb_state = 'no_long_register' where mb_no = {$row['mb_no']} ";
                sql_query($sql);
            }
        }
    }
}
// ===== 21.02.28 회원현황 조회 시 미등록회원, 휴면회원 체크 끝 =====

// 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정)
$sql_common = " from {$g5['member_table']} as mb ";
// 22.01.07 이전내용
/*$sql_common = " from {$g5['member_table']} as mb
                left join g5_lesson as le on le.idx = mb.lesson_idx ";*/

$sql_search = " where mb_id != 'admin' and mb_category = '회원' and use_yn = 'Y' "; // 온라인(online)/휴면(no_long_register)/미등록(no_register)은 유효회원에서 제외, 21.04.29 삭제한 회원 제외

//센터코드입력시 해당센터 가져오는곳 wc
$center_code = '';

// 팀장으로 로그인 시 본인 센터 정보만 조회
if($member['mb_level'] == 9) {
    $g5['title'] = '회원관리';
    $center_code = $member['center_code'];
    $sql_search .= " and mb.center_code = '{$member['center_code']}' ";
}else if($member['mb_level'] == 8){
    $g5['title'] = '회원정보';
    $center_code = $member['center_code'];
    $sql_search .= " and pro_mb_no = '{$member['mb_no']}' and mb.center_code = '{$member['center_code']}' ";
}else{
    $g5['title'] = '회원관리';
    $center_code = $_REQUEST['center_code'];
    $sql_search .= " and mb.center_code = '{$_REQUEST['center_code']}' ";
}

/* 23.10.31 이런식으로하면 다이어리 없는애들 안적힘;; wc
$center_arr = array();
$center = sql_query(" select lesson_name,lesson_code from g5_lesson where center_code = '{$center_code}' ");
for ($j = 0 ; $center_row = sql_fetch_array($center) ; $j++){
    $center_arr[$center_row['lesson_code']] = array('lesson_name' => $center_row['lesson_name']);
}
*/

// 검색
if ($stx) {
    $name = str_replace(' ', '', $stx);
    $sql_search .= " and (mb_id_no like '%{$name}%' or mb_name like '%{$name}%' or mb_id like '%{$name}%') ";
}

// 정렬
if (!$sst) {
    $sst = "mb_reg_date";
    $sod = "desc";
}

// 회원구분
$current = '';
if(!empty($_GET['member_option'])) {
    if($_GET['member_option'] == '유효회원') {
        $sql_search .= " and mb_state not in ('online', 'no_register', 'no_long_register') ";
    } else if($_GET['member_option'] == '신규회원') {
        $sql_search .= " and mb_state = 'new_member' ";
    } else if($_GET['member_option'] == '재등록회원') {
        $sql_search .= " and mb_state = 're_member' ";
    } else if($_GET['member_option'] == '온라인회원') {
        $sql_search .= " and mb_state = 'online' ";
    } else if($_GET['member_option'] == '미등록회원') {
        $sql_search .= " and mb_state = 'no_register' ";
    } else if($_GET['member_option'] == '휴면회원') {
        $sql_search .= " and mb_state = 'no_long_register' ";
    } else if($_GET['member_option'] == '유보회원') {
        $sql_search .= " and mb_state in ('no_register', 'no_long_register') "; // 온라인회원은 팀장이 등록 후 조회
    } else if($_GET['member_option'] == '전체') {

    }
} else {
    $sql_search .= " and mb_state not in ('online', 'no_register', 'no_long_register') ";
    $current = 'current';
}

// 미등록회원에서 프로명 선택 시
$pro = '';
if(!empty($_GET['pro'])) {
    $pro = $_GET['pro'];
    $sql_search .= " and pro_mb_no = '{$pro}' ";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정)
$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
// 22.01.07 이전내용
/*$sql = " select *, (select min(lesson_remain_count*1) from g5_lesson_diary where mb_no = mb.mb_no and history_idx = mb.history_idx) AS lesson_remain_count, le.lesson_name
         {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";*/
$result = sql_query($sql);
//if($private) {
//    echo $sql;
//}
$colspan = 16;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

// 페이지 넘길 때 검색 조건
$p_sch = '';

include_once('./admin.head.php');
?>

<style>
.mb_tbl table {text-align: center;}
.btn_remo {
    display: inline-block;
    width: 75px;
    line-height: 32px;
    text-align: center;
    border-radius: 3px;
    border: 1px solid #ccc;
    background: #f2f2f2;
}
input[type=text] {
    -webkit-ime-mode: active !important;
    -moz-ime-mode: active !important;;
    -ms-ime-mode: active !important;;
    ime-mode: active !important;;
}
</style>

<div id="tab_box">
    <ul class="tab">
        <li class="<?=$current?> <?=$_GET['member_option'] == '유효회원' ? 'current' : ''?>" id="tab1"><a href="#" onclick="tabClick('유효회원');">유효회원</a></li>
        <li class="<?=$_GET['member_option'] == '신규회원' ? 'current' : ''?>" id="tab2"><a href="#" onclick="tabClick('신규회원');">신규회원</a></li>
        <li class="<?=$_GET['member_option'] == '재등록회원' ? 'current' : ''?>" id="tab3"><a href="#" onclick="tabClick('재등록회원');">재등록회원</a></li>
        <li class="<?=$_GET['member_option'] == '미등록회원' ? 'current' : ''?>" id="tab5"><a href="#" onclick="tabClick('미등록회원');">미등록회원</a></li>
        <?php if($member['mb_level'] == 9) { ?> <!-- 팀장 -->
        <li class="<?=$_GET['member_option'] == '온라인회원' ? 'current' : ''?>" id="tab4"><a href="#" onclick="tabClick('온라인회원');">온라인회원</a></li>
        <li class="<?=$_GET['member_option'] == '휴면회원' ? 'current' : ''?>" id="tab4"><a href="#" onclick="tabClick('휴면회원');">휴면회원</a></li>
        <?php } ?>
    </ul>
</div><!--#tab_box-->
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">

<div id="adm_search">
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input" placeholder="회원번호/이름/아이디" style="width: 200px;">
    <input type="hidden" id="member_option" name="member_option" value="<?=$_GET['member_option']?>">
    <input type="submit" class="btn_submit"  value="&#xf002">
</div><!--#adm_search-->

<div id="adm_sort">
    <!--<select name="sfl" id="sfl">-->
        <!--<option value="mb_id"<?php /*echo get_selected($_GET['sfl'], "mb_id"); */?>>상품별</option>
        <option value="mb_id"<?php /*echo get_selected($_GET['sfl'], "mb_id"); */?>>회차별</option>-->
        <!--<option value="mb_id"<?php /*echo get_selected($_GET['sfl'], "mb_id"); */?>>등록 일자별</option>-->
    <!--</select>-->
</div><!--#adm_sort-->
</form>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 회원수 <?php echo number_format($total_count) ?>명 | <a href="<?=G5_ADMIN_URL?>/member_list_exceldown.php?member_option=<?=$_REQUEST['member_option']?>&pro=<?=$_REQUEST['pro']?>" target='_blank'>엑셀 다운로드</a>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col width="6%"> <!--회원사진-->
        <col width="6%"> <!--회원번호-->
        <?php if($_REQUEST['member_option'] == '미등록회원' || $_REQUEST['member_option'] == '휴면회원') { ?>
        <col width="7%"> <!--회원명-->
        <?php } else { ?>
        <col width="10%"> <!--회원명-->
        <?php } ?>
        <col width="15%"> <!--센터/아카데미-->
        <?php if($member['mb_level'] == 9) { ?>
        <col width="7%"> <!--담당프로-->
        <?php } ?>
        <col width="10%"> <!--상품명-->
        <?php if($_REQUEST['member_option'] == '미등록회원' || $_REQUEST['member_option'] == '휴면회원') { ?>
        <col width="10%"> <!--등록일-->
        <?php } ?>
        <col width="10%"> <!--잔여회차-->
        <col width="15%"> <!--관리-->
        <?php if($member['mb_level'] > 8) { ?>
        <col width="10%"> <!--삭제-->
        <?php } else { ?>
        <col width="10%"> <!--삭제-->
        <?php } ?>
    </colgroup>
    <thead>
	<tr>
		<th>회원사진</th>
		<th>회원번호</th>
        <th><?php echo subject_sort_link('mb_name', 'member_option='.$member_option.'&pro='.$pro) ?>회원명 </a></th>
		<th>센터/아카데미</th>
        <?php if($member['mb_level'] == 9) { ?> <!-- 팀장관리자 일 경우만 조회, 프로 로그인 시 본인 담당회원만 조회할 수 있으므로 필요없음 -->
        <th><?php echo subject_sort_link('mb_charge_pro', 'member_option='.$member_option.'&pro='.$pro) ?>담당프로 </a></th>
        <?php } ?>
        <th>상품명</th>
        <?php if($_REQUEST['member_option'] == '미등록회원' || $_REQUEST['member_option'] == '휴면회원') { ?>
        <th>등록일</th>
        <?php } ?>
        <th>잔여회차</th>
        <th>관리</th>
        <th>삭제</th>
	</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = './member_view.php?mb_no='.$row['mb_no'];
        $pro_s_mod = './pro_view_member.php?mb_no='.$row['pro_mb_no'];
        $bg = 'bg'.($i%2);

        $state_class = 'mb_state';
        if ($row['mb_state'] == 'new_member') {
            $mb_state = '신규';
            $state_class = 'mbs_new';
        } else if ($row['mb_state'] == 're_member') {
            $mb_state = '재등록';
            $state_class = 'mbs_re';
        } else if ($row['mb_state'] == 'one_point_lesson') {
            $mb_state = '원포인트';
            $state_class = 'mbs_one';
        } else if ($row['mb_state'] == 'online') {
            $mb_state = '온라인';
        } else if ($row['mb_state'] == 'no_register') {
            $mb_state = '미등록';
        } else if ($row['mb_state'] == 'no_long_register') {
            $mb_state = '휴면';
        }

        $file = sql_fetch(" select * from g5_member_img where mb_no = '{$row['mb_no']}' ");

        //23.10.30 left join 최대한빼고 쿼리실행 최소화 wc
        //$info = sql_fetch(" select md.lesson_remain_count, his.lesson_name from g5_lesson_diary as md right outer join g5_member_history as his on md.history_idx = his.idx where his.idx = '{$row['history_idx']}' order by md.idx desc limit 1 ");
        $info = sql_fetch(" select lesson_code,lesson_count,lesson_remain_count from g5_lesson_diary where mb_no = '{$row['mb_no']}' and history_idx = '{$row['history_idx']}' order by idx desc limit 1 ");

        $lesson_name = '';
        //$lesson_name = $center_arr->$info['lesson_code']->lesson_name;
        //$lesson_name = $center_arr[$info['lesson_code']]['lesson_name'];

        $lesson_count = '0회';
        $lesson_remain_count = 0;
        $lesson_total_count = '0회';

        // 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정) -> 23.10.31 살짝더 커스텀
        $tmp0 = sql_fetch(" select lesson_name from g5_member_history where idx = '{$row['history_idx']}' order by idx desc limit 1");
        if($tmp0){
            $tmp1 = explode('/', $tmp0['lesson_name']);
            //$lesson_name = $tmp1[0].' / '.$tmp1[1].'/'.$tmp1[2].' / '.$tmp1[3].' / '.number_format($tmp1[4]);
            $lesson_name = $tmp1[0];
            $lesson_remain_count = '0회';
            $lesson_total_count = $tmp1[2];
            if($tmp1[0] == '원포인트'){
                //$lesson_name = $tmp1[0].' / '.$tmp1[1].'/'.$tmp1[2].' / '.number_format($tmp1[3]);
                $lesson_name = $tmp1[0];
                $lesson_total_count = $tmp1[1];
            }
        }

        if($info){
            $info['lesson_count'] <= 0 ? $lesson_count = '0회' : $lesson_count = $info['lesson_count'].'회';
            $info['lesson_remain_count'] <= 0 ? $lesson_remain_count = '0회' : $lesson_remain_count = $info['lesson_remain_count'].'회';

            $lesson_total_count = $info['lesson_count']*1 + $info['lesson_remain_count']*1;
            $lesson_total_count = $lesson_total_count.'회';
        }else{
            $lesson_remain_count = $lesson_total_count;
        }




        /*if($private) {
            echo $info['lesson_remain_count'] === null;
        }*/
        // 22.01.07 이전내용
        /*$lesson_name = $row['lesson_name'];
        $lesson_count = explode('/',$row['lesson_count'])[0];
        if(empty($diary_count)) { $lesson_remain_count = explode('/',$row['lesson_count'])[0]; }
        else { $lesson_remain_count = $row['lesson_remain_count'].'회'; }*/

        // *수정접수내역 No.48 프로 이름 선택 시 프로별 미등록회원으로 정렬
        if($member_option == '미등록회원') {
            $pro_s_mod = G5_ADMIN_URL.'/member_list.php?member_option='.$member_option.'&pro='.$row['pro_mb_no'];
            $p_sch = '&pro='.$_GET['pro'];
        }
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?php if(!empty($file['img_file'])) { ?> <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>" width="50px" height="50px"> <?php } else { ?> <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif" width="50px" height="50px"/> <?php } ?></td>
        <td><span class="<?=$state_class?>"><?=$mb_state?></span><br><font size="2"><?=$row['mb_id_no']?></font></td>
        <td style="cursor: pointer;" onclick="member_history_popup('<?=$row['mb_no']?>');"><?=$row['mb_name']?></td>
        <td><?=$row['mb_center']?></td>
        <?php if($member['mb_level'] == 9) { ?> <!-- 팀장관리자 일 경우만 조회, 프로 로그인 시 본인 담당회원만 조회할 수 있으므로 필요없음 -->
        <td style="cursor: pointer;" onclick="location.href='<?=$pro_s_mod?>'"><?=$row['mb_charge_pro']?></td>
        <?php }?>
        <td><?=$lesson_name?></td>
        <?php if($_REQUEST['member_option'] == '미등록회원' || $_REQUEST['member_option'] == '휴면회원') { ?>
        <td><?=substr($row['mb_reg_date'],0, 10)?></td>
        <?php } ?>
        <td>
            <!--잔여회차-->
            <span style="font-weight: bold;">
            <?=$lesson_remain_count?>
            <?php //if(empty($diary_count)) echo explode('/',$row['lesson_count'])[0]; else echo $row['lesson_remain_count'].'회'; ?>
            </span>
            <?php if(!empty($row['history_idx'])) { ?>/<?php } ?>
            <!--레슨회차-->
            <?=$lesson_total_count?>
            <?php //if(!empty($row['lesson_idx'])) { echo '/ '.explode('/',$row['lesson_count'])[0]; } ?>
        </td>
        <td onclick="event.cancelBubble=true">
            <?php if($row['mb_state'] != 'online') { ?>
            <a href="javascript:void(0);" class="btn_remo" onclick="lesson_diary('<?=$row['mb_no']?>');">일지</a>
            <?php } ?>
			<?php if($row['mb_state'] != 'online') { ?>
                <a href="javascript:void(0);" class="btn_remo" onclick="location.href='<?=$s_mod?>'">상세보기</a>
            <?php } else { ?> <!-- 온라인 회원일 경우 바로 회원 등록으로 연결 -->
                <a href="javascript:void(0);" class="btn_remo" onclick="location.href='<?=G5_ADMIN_URL?>/member_form_app.php?w=u&mb_no=<?=$row['mb_no']?>'">회원등록</a>
            <?php } ?>
        </td>
        <td>
            <?php if($member['mb_level'] > 8) { ?> <!-- 팀장일 때 -->
                <a href="javascript:void(0);" class="btn_remo" onclick="member_del('<?=$row['mb_no']?>');">삭제</a>
            <?php } ?>
        </td>
	</tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&member_option='.$_GET['member_option'].$p_sch.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

// 회원-탭선택
function tabClick(value) {
    $('#member_option').val(value);
    $('#stx').val("");
    fsearch.submit();
}

// 회원-레슨일지(팝업)
function lesson_diary(mb_no) {
    var url = "./lesson_diary_form.php?mb_no="+mb_no;

    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
        location.href = url;
    }
    else {
        window.open(url, "add_lesson_diary", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
    }
}

// 회원-상품등록이력조회 팝업
function member_history_popup(mb_no) {
    var url = "./popup.member_history.php?mb_no="+mb_no;

    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
        location.href = url;
    }

    window.open(url, "member_history", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
}

// 회원-삭제
function member_del(mb_no) {
    if(confirm("한번 삭제한 자료는 복구할 수 없습니다.\n그래도 삭제하시겠습니까?")) {
        $.ajax({
            url: g5_admin_url + "/ajax.member_del.php",
            data: {mb_no: mb_no},
            type: 'POST',
            success: function (data) {
                if(data) {
                    alert('삭제되었습니다.');
                    location.reload();
                }
            },
        });
    }
}
</script>

<?php
include_once ('./admin.tail.php');
?>
