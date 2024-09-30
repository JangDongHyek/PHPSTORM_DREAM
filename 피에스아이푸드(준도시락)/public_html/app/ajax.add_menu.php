<?php
include_once ('../common.php');
/**
 * 주문하기 - 메뉴 추가
 */
?>
<div class="ordmenu addmenu ord_<?=$num?>">
    <input type="hidden" id="main_<?=$num?>" name="main[]" value="정기배달">
    <!--<p class="">
        <select class="frm_input main" id="main_<?/*=$num*/?>" name="main[]" onchange="getDosirak(this.value, '<?/*=$num*/?>');" disabled>
            <option value="정기배달">정기배달도시락</option>
        </select>
    </p>-->
    <p class="">
        <!--ajax.select_dosirak.php-->
        <select class="frm_input sub" id="sub_<?=$num?>" name="sub[]">
            <?php
            $rlt = sql_query(" select * from g5_dosirak where do_category = '정기배달' and use_yn = 'Y' order by do_order desc ");
            while ($row = sql_fetch_array($rlt)) {
                // 23.06.27 주문불가능시간 및 날짜에 포함되면 메뉴 표시 안함
                if(date('H:i', strtotime($row['no_st_time'])) < date('H:i') && date('H:i') < date('H:i', strtotime($row['no_ed_time']))) continue;
                if(in_array($delivery_date, explode(',', $row['no_date']))) continue;
            ?>
            <option value="<?= $row['idx'] ?>"><?= $row['do_name'] ?></option>
            <?php
            }
            ?>
        </select>
    </p>
    <p class="">
        <input type="text" class="frm_input amount" id="amount_<?=$num?>" name="amount[]" style="width:calc(100% - 20px); margin-right:6px;"/>개
    </p>
    <div class="add_btn">
    <?php if($num == 1) { ?>
    <span onclick="addMenu();"><i class="fa-regular fa-plus"></i>추가</span>
    <?php } else { ?>
    <span onclick="delMenu('<?=$num?>');"><i class="fa-regular fa-minus"></i>삭제</span>
    <?php } ?>
    </div>
</div>
