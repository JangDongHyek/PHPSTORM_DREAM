<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where mb_id!='lets080' ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if($str_date){
	$sql_search .= " and ( mb_datetime > '{$str_date}' ) ";
}

if($end_date){
	$sql_search .= " and ( mb_datetime < '{$end_date}' ) ";
}

$sql_search .= " and mb_id <> '{$config['cf_admin']}' ";
$sql_search .= " and mb_id <> 'lets080' and mb_level!='1'";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 7;

//스탬프 갯수
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총회원수 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<input type="hidden" name="sca" value="<?php echo $sca?>">
	<label for="sfl" class="sound_only">검색대상</label>
	<select name="sfl" id="sfl">
		<option value="mb_id" <?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
		<option value="mb_name" <?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
		<option value="mb_nick" <?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
	</select>
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
	<input type="submit" class="btn btn-danger btn-sm" value="검색">
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="stc" value="<?php echo $stc ?>">
<input type="hidden" name="token" value="">


<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value"> 
    <input type="submit" name="act_button" value="선택차단" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택차단해제" onclick="document.pressed=this.value">
</div>

<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" rowspan="2" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)" dis=false>
        </th>
        <th scope="col" rowspan="2">고유아이디</th>
        <th scope="col" rowspan="2">추천회원목록</th>
        <th scope="col" rowspan="2">이름</th>
        <th scope="col" rowspan="2">전화번호</th>
        <th scope="col" rowspan="2">회원가입 포인트</th>
        <th scope="col" rowspan="2">추천인</th>
		<th scope="col" colspan="2">포인트내역</th>
		<th scope="col" colspan="2">포인트사용내역</th>
		<th scope="col" rowspan="2">동영상충전포인트</th>
        <th scope="col" rowspan="2">가입일</th>
        <th scope="col" rowspan="2">차단일</th>
		<th scope="col" rowspan="2">관리</th>
		<th scope="col" rowspan="2">포인트<br/>신청관리</th>
				
    </tr>
		<tr>
			<th>S포인트</th>
			<th>L포인트</th>
			<th>S포인트</th>
			<th>L포인트</th>
		</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">수정</a>';
		
        //$leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
		// 차단일
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_id = $row['mb_id'];
        $bg = 'bg'.($i%2);

		// 나를 추천한 회원
		$sql = " SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_recommend = '{$row['mb_id']}' ";
		$r_row = sql_fetch($sql);
		$recomm_cnt = $r_row["cnt"];
		$recomm_str = $recomm_cnt;

		if ($recomm_cnt > 0) {
			$recomm_str = "<a href='javascript:void(0)' class='link' onclick='getRecommList(\"{$row['mb_id']}\");'>{$recomm_cnt}</a>";
		} 
		
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>"<?php echo 0 < $recomm_cnt?"disabled dis=true":"dis=false"?>>
        </td>
        <td class="td_name"><?php echo $mb_id ?></td>
        <td class="td_name"><?=$recomm_str?></td>
       
		<td class="td_name"><?php echo $row['mb_name'] ?></td>
		<td class="td_name"><?php echo $row['mb_hp'] ?></td>
		<td class="td_name">
			<?php
			// 회원가입 포인트
			$bs = sql_fetch("select * from g5_point where mb_id = '{$row['mb_id']}' and po_rel_table = '@member'");
			if($bs)
				echo number_format($bs['po_point']);
			else 
				echo "미지급";
			?>
		</td>
		<td class="td_name">
			<?php
			// 추천인
			echo $row['mb_recommend'];
			if($row['mb_recommend']){
				$bs = sql_fetch("select * from g5_point where mb_id = '{$row['mb_recommend']}' and po_rel_table = '@member'");
				if($bs)
					echo " ( ".number_format($bs['po_point'])." )";
				else 
					echo " ( 미지급 )";
			}else{
				echo "-";
			}

			$sql="select sum(po_point) as spoint from g5_point where mb_id='$row[mb_id]' and po_point < 0";
			$row2=sql_fetch($sql);

			$sql="select sum(po_point) as lpoint from g5_point_l where mb_id='$row[mb_id]' and po_point < 0";
			$row3=sql_fetch($sql);
			?>
		</td>
		<td align="right"><a href="./point_list.php?sfl=mb_id&stx=<?=$row[mb_id]?>"><?=number_format($row['mb_point'])?>P</a></td>
		<td align="right"><a href="./point_l_list.php?sfl=mb_id&stx=<?=$row[mb_id]?>"><?=number_format($row['mb_point_l'])?>P</a></td>
		<td align="right"><a href="./point_list.php?sfl=mb_id&stx=<?=$row[mb_id]?>"><?=number_format($row2['spoint'])?>P</a></td>
		<td align="right"><a href="./point_l_list.php?sfl=mb_id&stx=<?=$row[mb_id]?>"><?=number_format($row3['lpoint'])?>P</a></td>
		<td align="right"><a href="./point_m_list.php?sfl=mb_id&stx=<?=$row[mb_id]?>"><?=number_format($row['mb_point_m'])?>P</a></td>
		<td class="td_tel text-center"><?php echo substr($row['mb_datetime'],2,8); ?></td>
		<td class="td_tel text-center"><?php echo $row['mb_intercept_date']?$row['mb_intercept_date']:"-" ?></td>
		<td headers="mb_list_mng" class="td_mngsmall">
			<?php echo $s_mod ?> <?php echo $s_grp ?>
			
		
		</td>
		<td headers="mb_list_mng" class="td_mngsmall"><a href="./wallet_list.php?stl=mb_id&stx=<?=$row[mb_id]?>">바로가기</a></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">회원이 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
     <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value"> 
    <input type="submit" name="act_button" value="선택차단" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택차단해제" onclick="document.pressed=this.value">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>


<!-- popup -->
<div id="popup_overlay" onclick="fnPrevClose();"></div>
<div id="mypagePopup" >
	<iframe id="hFrame" frameborder="0" src="" scrolling="yes"></iframe>
	<a class="close_window" onclick="fnPrevClose();">창닫기 <i class="fa fa-times"></i></a>
	<!--<a class="close_window back" onclick="fnFrameBack();">뒤로 <i class="fa fa-chevron-left"></i></a>-->
</div>
<!-- //popup -->

<script>
var first_id = "",
	hFrame_back = false;

function getRecommList(mb_id) {
	var h = $(window).height(),
		w = $(window).width(),
		pop_h = (h * 0.6) + "px",
		pop_t = ((h * 0.4) / 2) + "px",
		pop_w = $("#mypagePopup").width();
		pop_l = ((w - pop_w) / 2) + "px";
		var width=parseInt(w)/2;
		var height=parseInt(h);
		url = g5_admin_url + "/ajax.member_recomm_list.php?mb_id=" + mb_id;
		window.open(url,"recommend","width="+width+",height="+height+",scroll=1");


/*
	$("#mypagePopup iframe").prop("src", url);
	$("#popup_overlay").show();
	$("#mypagePopup").show().css({"height" : pop_h, "top" : pop_t, "left" : pop_l});*/

	if (first_id != "") {
		// 뒤로가기 버튼생성
		hFrame_back = true;
	} else {
		first_id = mb_id;
		hFrame_back = false;
	}
}

document.getElementById('hFrame').onload = function() {
	if (hFrame_back) {
		$('#hFrame').contents().find('#btn_back').css("display", "block");
	} else {
		$('#hFrame').contents().find('#btn_back').css("display", "none");
	}
};

function fnPrevClose() {
	$("#mypagePopup iframe");
	$("#popup_overlay").hide();
	$("#mypagePopup").hide();
	$("#mypagePopup iframe").prop("src", "");

	first_id = "";
}

function fnFrameBack(mb_id) {
	if (mb_id == first_id) {
		hFrame_back = false;
	}
	document.getElementById("hFrame").contentWindow.history.back();
}

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

</script>

<?php
include_once ('./admin.tail.php');
?>
