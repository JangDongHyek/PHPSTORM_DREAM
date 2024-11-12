<?php
$sub_menu = "301200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '광고신청';
include_once ('./admin.head.php');

$colspan = 5;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> 3 건 </span></span>
</div>
<!--

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="po_content"<?php echo get_selected($_GET['sfl'], "po_content"); ?>>내용</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>
-->

<form name="fpointlist" id="fpointlist" method="post" action="./point_list_delete.php" onsubmit="return fpointlist_submit(this);">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">선택</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">업체명(성명)</th>
        <th scope="col">작성자</th>
        <th scope="col">날짜</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>

    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
            $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
            $row2 = sql_fetch($sql2);
        }

        $mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

        $link1 = $link2 = '';
        if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table']) {
            $link1 = '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$row['po_rel_table'].'&amp;wr_id='.$row['po_rel_id'].'" target="_blank">';
            $link2 = '</a>';
        }

        $expr = '';
        if($row['po_expired'] == 1)
            $expr = ' txt_expired';

        $bg = 'bg'.($i%2);
    ?>
    
    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="po_id[<?php echo $i ?>]" value="<?php echo $row['po_id'] ?>" id="po_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['po_content'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_left">업체명 들어갑니다</td>
        <td class="td_left">작성자</td>
        <td class="td_datetime"><?php echo $row['po_datetime'] ?></td>
        <td>
            <a href="" class="btn btn_03">삭제</a>
            <a href="./itemupload_view.php" class="btn btn_02">보기</a>
        </td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">등록된 게시글이 없습니다.</td></tr>';
    ?>
    
    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="po_id[<?php echo $i ?>]" value="<?php echo $row['po_id'] ?>" id="po_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['po_content'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_left">업체명 들어갑니다</td>
        <td class="td_left">작성자</td>
        <td class="td_datetime"><?php echo $row['po_datetime'] ?></td>
        <td>
            <a href="" class="btn btn_03">삭제</a>
            <a href="./itemupload_view.php" class="btn btn_02">보기</a>
        </td>
    </tr>
    
    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="po_id[<?php echo $i ?>]" value="<?php echo $row['po_id'] ?>" id="po_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['po_content'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_left">업체명 들어갑니다</td>
        <td class="td_left">작성자</td>
        <td class="td_datetime"><?php echo $row['po_datetime'] ?></td>
        <td>
            <a href="" class="btn btn_03">삭제</a>
            <a href="./itemupload_view.php" class="btn btn_02">보기</a>
        </td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>


<script>
</script>

<?php
include_once ('./admin.tail.php');
?>
