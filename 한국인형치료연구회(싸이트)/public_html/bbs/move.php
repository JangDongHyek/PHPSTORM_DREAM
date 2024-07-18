<?php
include_once('./_common.php');

if ($sw == 'move')
    $act = '이동';
else if ($sw == 'copy')
    $act = '복사';
else
    alert('sw 값이 제대로 넘어오지 않았습니다.');

// 게시판 관리자 이상 복사, 이동 가능
if ($is_admin != 'board' && $is_admin != 'group' && $is_admin != 'super')
    alert_close("게시판 관리자 이상 접근이 가능합니다.");

$g5['title'] = '게시물 ' . $act;
include_once(G5_PATH.'/head.sub.php');

$wr_id_list = '';
if ($wr_id)
    $wr_id_list = $wr_id;
else {
    $comma = '';
    for ($i=0; $i<count($_POST['chk_wr_id']); $i++) {
        $wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
        $comma = ',';
    }
}

//$sql = " select * from {$g5['board_table']} a, {$g5['group_table']} b where a.gr_id = b.gr_id and bo_table <> '$bo_table' ";
// 원본 게시판을 선택 할 수 있도록 함.
$sql = " select * from {$g5['board_table']} a, {$g5['group_table']} b where a.gr_id = b.gr_id ";
if ($is_admin == 'group')
    $sql .= " and b.gr_admin = '{$member['mb_id']}' ";
else if ($is_admin == 'board')
    $sql .= " and a.bo_admin = '{$member['mb_id']}' ";
$sql .= " order by a.gr_id, a.bo_order, a.bo_table ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;
}

$categories = explode('|', $board['bo_category_list']); 

?>

<div id="copymove" class="new_win">
    <h1 id="win_title"><?php echo $g5['title'] ?></h1>

    <form name="fboardmoveall" method="post" action="./move_cate.php" onsubmit="return fboardmoveall_submit(this);">
    <input type="hidden" name="sw" value="<?php echo $sw ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id_list" value="<?php echo $wr_id_list ?>">
  

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $act ?>할 게시판을 한개 이상 선택하여 주십시오.</caption>
        <thead>
        <tr>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시판 전체</label>              
            </th>
            <th scope="col">카테고리</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i=0; $i<count($categories); $i++) {
      
        ?>
        <tr class="<?php echo $atc_bg; ?>">
            <td class="td_chk">
                <label for="chk<?php echo $i ?>" class="sound_only"></label>
                <input type="radio" value="<?php echo $categories[$i]?>" id="chk<?php echo $i ?>" name="chk_cate">
            </td>
            <td>
				<?=$categories[$i]?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>

    <div class="win_btn">
        <input type="submit" value="<?php echo $act ?>" id="btn_submit" class="btn_submit">
    </div>
    </form>

</div>

<script>
$(function() {
    $(".win_btn").append("<button type=\"button\" class=\"btn_cancel\">창닫기</button>");

    $(".win_btn button").click(function() {
        window.close();
    });

});


</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
