<?php

include_once('./_common.php');

$sub_menu = "450100";

include_once('./admin.head.php');

$sql_c = " `state` >= 2 and `TID` != '' and `bo_table` = 'store'";

if($sfl){
    $sql_c .= " and `$sfl` like '%$sch_text%' ";
}

//SELECT gg._id, gg.name, s.title FROM girl_group AS gg LEFT OUTER JOIN song AS s ON s._id = gg.hit_song_id;

//$sql ="select * from g5_write_{$table} where {$sql_search}";
//$result  = sql_query($sql);



$sql ="select count(*) as cnt from `g5_order_list` where $sql_c";
$result_cnt  = sql_fetch($sql);

$total_count = $result_cnt['cnt'];
$colspan = 16;

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql ="select * from `g5_order_list` where $sql_c order by `idx` desc";
$result  = sql_query($sql);

?>

<style>
    .mb_tbl table {text-align: center;}
</style>
<!--
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총신청수 <?php echo number_format($total_count) ?>
</div> -->

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="buy_no"<?php echo get_selected($_GET['sfl'], "buy_no"); ?>>주문번호</option>
        <option value="od_name"<?php echo get_selected($_GET['sfl'], "od_name"); ?>>이름</option>
        <option value="od_hp"<?php echo get_selected($_GET['sfl'], "od_hp"); ?>>전화번호</option>
        <? /*
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
	*/ ?>
    </select>
    <label for="sch_text" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="sch_text" value="<?php echo $sch_text ?>" id="sch_text" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>
<!-- 교육/자격 신청 직접 접수 부분 -->
<?if($table=='apply01'){?>
    <!-- <div class="btn_add01 btn_add">
        <a href="./apply01_form.php" id="member_add">교육신청추가</a>
    </div> -->
<?}?>
<!-- 교육/자격 신청 직접 접수 부분 -->
<form name="fapplylist" id="fapplylist" action="./apply_list_update.php" onsubmit="return fapplylist_submit(this);" method="post">
    <input type="hidden" name="dltflg"   id="dltflg" value="<?=$table?>"/>
    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th>아이디</th>
                <th>이름</th>
                <th>전화번호</th>
                <th>주소</th>
                <th>구매번호</th>
                <th>구매물품</th>
                <th>구매가격</th>
                <th>구매수량</th>
                <th>배송비</th>
                <th>추가비용</th>
                <th>합계금액</th>
                <th>결제상태</th>
                <th>구매일</th>
                <th>배송여부</th>

                <th>주문취소</th>
                    
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $mb = get_member($row['mb_id']);

                ?>
                <tr>
                    <td><?=$mb['mb_id']?></td>
                    <td><?=$row['od_name']?></td>
                    <td><?=$row['od_hp']?></td>
                    <td><?=$row['od_zip']?><br><?=$row['od_addr1'].' '.$row['od_addr2']?></td>
                    <td><?=$row['buy_no']?></td>
                    <td><?=$row['item_title']?></td>
                    <td><?=number_format($row['item_cost'])?>원</td>
                    <td><?=number_format($row['item_count'])?>개</td>
                    <td><?=number_format($row['ship_cost'])?>원</td>
                    <td><?=number_format($row['add_cost'])?>원</td>
                    <td><?=number_format($row['sum_cost'])?>원</td>
                    <td><?=$market_state[$row['state']]?></td>
                    <td><?=$row['reg_date']?></td>
                    <td>
                        <? if($row['state'] < 4) { ?>
                            <select name="ship_state" data-idx="<?=$row['idx']?>">
                                <option value="2" <?php echo ($row['state'] <= 2) ? 'selected' : ''; ?>>배송전</option>
                                <option value="3" <?php echo ($row['state'] == 3) ? 'selected' : ''; ?>>배송완료</option>
                            </select>
                        <?}?>
                    </td>

                    <td>
                    <? if($row['state'] < 4) { ?>
                        <button type="button" onclick="pay_cancel('<?=$row['idx']?>','<?=$row['bo_table']?>')">주문취소</button>
                    <?}?>
                    </td>

                </tr>
            <?}
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

</form>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?flg='.$flg.'&amp;sch_text='.$sch_text.'&amp;'.$qstr.'&amp;page='); ?>

<script>

    $('select[name="ship_state"]').change(function() {
        let idx = $(this).data('idx');
        let value = $(this).val();
        $.post("<?=G5_ADMIN_URL?>/ajax/set_ship_state.php",{"idx":idx,"state":value},function (data) {
            alert(data.msg);
            location.reload();
        },"json");
    });


    function pay_cancel(idx, bo_table){
        if(!confirm("정말로 취소 하시나요?\n이 작업은 취소할수 없습니다.")){
            return false;
        }

        $.post("<?=G5_ADMIN_URL?>/ajax/set_order_cancel.php",{"idx":idx, "bo_table":bo_table},function (data) {
            alert(data.msg);
            location.reload();
        },"json");
    }

</script>


<?php
include_once ('./admin.tail.php');
?>


