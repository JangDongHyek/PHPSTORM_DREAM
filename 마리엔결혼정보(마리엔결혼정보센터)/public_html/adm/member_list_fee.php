<?php
$sub_menu = "750100";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');
$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
$g5['title'] = '가입비 알아보기';
include_once('./admin.head.php');
$colspan = 17;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총회원수 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
	<option value="mb_2"<?php echo get_selected($_GET['sfl'], "mb_2"); ?>>성별</option>    
    <option value="mb_mb_312"<?php echo get_selected($_GET['sfl'], "mb_mb_312"); ?>>나이</option>
	<option value="mb_73"<?php echo get_selected($_GET['sfl'], "mb_73"); ?>>학력</option>
	<option value="mb_8"<?php echo get_selected($_GET['sfl'], "mb_8"); ?>>지역</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
<input type="button" class="btn_submit" value="초기화" onclick="location.href='./member_list.php'">
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<input type="hidden" name="member_list_manager" value="1">

<div class="row row-horizon">
<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th width="5" align="center" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>				
		<th id="mb_company">이름</th>
		<th id="mb_name">성별</th>
		<th id="mb_tel">출생년도</th>		
		<th id="mb_hp">휴대폰</th>
		<th id="mb_10">최종학력</th>
		<th id="mb_email">거주지</th>
		<?if($_SESSION['ss_mb_id'] == "lets080"){?>
        <th id="mb_list_auth">상태/권한<?php echo subject_sort_link('mb_level', '', 'desc') ?><span class="ud"></span></a></th>
		<?}?>
        <th id="mb_list_mng">수정</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>		
		<td align="center" class="td_company" headers="mb_company"><?php echo get_text($row['mb_company']); ?></td>
		<td align="center" class="td_name" headers="mb_name"><?php echo get_text($row['mb_name']); ?></td>
		<td align="center" class="td_tel" headers="mb_tel"><?php echo get_text($row['mb_tel']); ?></td>		
		<td align="center" class="td_hp" headers="mb_hp"><?php echo get_text($row['mb_hp']); ?></td>
		<td align="center" class="td_10" headers="mb_10"><?php echo get_text($row['mb_10']); ?></td>
		<td align="center" class="td_email" headers="mb_email"><?php echo get_text($row['mb_email']); ?></td>
        <td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?></td>
    </tr>
    <?php
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>
</div><!--row row-horizon-->

<div class="btn_list01 btn_list">
    <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

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
</script>

<?php
include_once ('./admin.tail.php');
?>
