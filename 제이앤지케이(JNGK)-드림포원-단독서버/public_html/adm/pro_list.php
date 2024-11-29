<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";
$sql_search = " where mb_id!='lets080' and mb_id!='admin' and mb_category = '프로' and (mb_center = '{$member['mb_center']}' or center_code = '{$member['center_code']}') "; // 팀장이 속한 센터의 프로만 조회
if(empty($_REQUEST['leave'])) {
    $sql_search .= " and (pro_leave_date = '0000-00-00' or pro_leave_date > date_format(now(), '%Y-%m-%d')) ";
} else {
    //$sql_search .= " and (pro_leave_date != '0000-00-00' and pro_leave_date < date_format(now(), '%Y-%m-%d')) "; // 퇴사일 입력한 프로는 조회하지 않음
    $sql_search .= " and (pro_leave_date != '0000-00-00' and pro_leave_date < date_format(now(), '%Y-%m-%d')) "; // 퇴사일 입력한 프로는 조회하지 않음
    //$sql_search .= " and (  pro_leave_date < date_format(now(), '%Y-%m-%d')) "; // 퇴사일 입력한 프로는 조회하지 않음
}

if ($stx) {
    $sql_search .= " and (mb_id_no like '{$stx}%' or mb_name like '{$stx}%') ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and mb_id != 'lets080'";

if (!$sst) {
    $sst = "pro_enter_date";
    $sod = "asc";
}

$sql_order = " order by {$sst} {$sod} ";

if($member['center_code'] == 'center1') {
    $sql_order = " order by field(mb_no, 17) desc, pro_enter_date asc "; // 21.08.20 워커힐 임연석 프로 제일 마지막 순서로 변경 요청
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
$listall_scheduler = '<a href="javascript:pro_scheduler();" class="ov_listall">전체스케줄</a>';
$listall2 = '<a href="'.$_SERVER['SCRIPT_NAME'].'?leave=Y" class="ov_listall">퇴사프로</a>';

$g5['title'] = '프로관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<style>
.mb_tbl table {text-align: center;}
.adm_pro_cal {
    left: 70px;
    position: relative;
    font-size: 20px;
    bottom: 20px;
}
.select_pro {
    border-color:#f3d421 !important;
    border-width:2px !important;
}
</style>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">
<div id="adm_search">
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input" placeholder="찾으시는 프로이름을 입력하세요" style="width: 200px;">
<input type="submit" class="btn_submit" value="&#xf002">
</div><!--#adm_search-->
</form>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <?php echo $listall_scheduler ?>
    <?php echo $listall2 ?>
    총 프로수 <?php echo number_format($total_count) ?>명
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">


<div id="adm_pro_list">
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = './pro_view_member.php?mb_no='.$row['mb_no'];
        $bg = 'bg'.($i%2);

        $file = sql_fetch(" select * from g5_member_img where mb_no = '{$row['mb_no']}' ");
    ?>

    <div class="apro_box mb_no_<?=$row['mb_no']?>" onclick="location.href='<?=$s_mod?>'" style="cursor: pointer;">
        <!--<div class="adm_pro_cal" onclick="pro_schedule('<?/*=$row['mb_no']*/?>');" style="cursor: pointer;"><i class="fal fa-calendar-alt"></i></div>-->
    	<div class="adm_pro_img">
		<?php if(!empty($file['img_file'])) { ?> <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>">
		<?php } else { ?> <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif"/> <?php } ?>
        </div><!--.adm_pro_img-->

        <div class="adm_pro_name"><?=$row['mb_name']?> <span>프로</span><?php /*?><?=$row['mb_reg_date']?><?php */?></div>

        <div class="adm_pro_gov">상세보기 <i class="fal fa-angle-right"></i></div>
    </div><!--.apro_box-->

    <?php
    }
    if ($i == 0)
        echo "<div class=\"empty_table\">자료가 없습니다.</div>";
    ?>
</div><!--#adm_pro_list-->

<?php /*?><div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col width="10%">
        <col width="10%">
        <col width="10%">
    </colgroup>
    <thead>
	<tr>
		<th>프로사진</th>
		<th>프로명</th>
		<th>등록일</th>
	</tr>
    </thead>
    <tbody>
	<tr class="<?php echo $bg; ?>" onclick="location.href='<?=$s_mod?>'">
        <td>
		<?php if(!empty($file['img_file'])) { ?> <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>" width="50px" height="50px">
		<?php } else { ?> <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif " width="50px" height="50px"/> <?php } ?></td>
        <td><?=$row['mb_name']?></td>
        <td><?=$row['mb_reg_date']?></td>
	</tr>

    </tbody>
    </table>
</div>
<?php */?>
<!--<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>-->

</form>

<?php if ($is_admin == 'super') { ?>
    <div class="adm_pw_btn">
        <a href="javascript:void(0);" onclick="pro_schedule()" id="pro_add" class="btn_adm_ok">프로 레슨현황</a>
        <a href="./pro_form.php" id="pro_add" class="btn_adm_ok">프로 등록하기</a>
    </div>
<?php } ?>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page=&leave='.$_GET['leave']); ?>

<!--<div class="pro_schedule"></div>-->

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

// var pro_mb_no = '';
function pro_schedule(mb_no) {
    // pro_mb_no = mb_no;

    // 팝업으로 표현
    var url = g5_admin_url+'/popup.pro_schedule.php';

    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
        location.href = url;
    }

    window.open(url, "", "left=300,top=50,width=1200,height=920,scrollbars=yes,resizable=yes");

    /*// 하단 div에 표현
    $.ajax({
        url : g5_admin_url+'/ajax.pro_schedule.php',
        data : {mb_no : mb_no},
        type : 'POST',
        success : function(data) {
            $('.pro_schedule').html(data);

            // 선택 프로 표시
            $('.apro_box').removeClass('select_pro');
            $('.mb_no_'+mb_no).addClass('select_pro');
        },
    });*/
}

// 전체 프로 스케줄러
function pro_scheduler() {
    // 팝업으로 표현
    if('<?=$private?>') {
        // var url = g5_admin_url+'/popup.pro_scheduler_test.php';
        var url = g5_admin_url+'/popup.pro_scheduler.php';
    } else {
        var url = g5_admin_url+'/popup.pro_scheduler.php';
    }

    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
        location.href = url;
    }

    window.open(url, "", "left=250,top=50,width=1800,height=920,scrollbars=yes,resizable=yes");
}
</script>

<?php
include_once ('./admin.tail.php');
?>
