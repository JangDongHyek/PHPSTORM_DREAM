<div class="flex js sub" id="drugs_list_recent">

    <span class="flex gap10 ai-c">
		<strong>마지막 주문일 <b class="txt_blue">24.01.01</b></strong>
		<?/*input type="date" id="drugs_recent_sdt" style="width: fit-content;" data-placeholder="날짜 선택" value="<?= $sdt ?>"
               onchange="callContent_recent(1,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"/>
		<b>~</b>
		<input type="date" id="drugs_recent_edt" style="width: fit-content;" data-placeholder="날짜 선택" value="<?= $edt ?>"
               onchange="callContent_recent(1,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"/*/?>
			<button type="button" class="btn male-auto btn_blue">전체 담기</button>
	</span>
</div>
<?/*div class="search">
    <input type="search" name="recent_hstx" id="drugs_recent_hstx" placeholder="원하시는 제품을 검색하세요"
           value="<?= $recent_hstx ?>"
           onkeyup="if(window.event.keyCode==13){callContent_recent(1,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())}"/>
    <button type="button" class="btn"
            onclick="callContent_recent(1,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())">
        <i class="fa-regular fa-magnifying-glass"></i></button>
</div*/?>
<div class="drugs_list my_list">
    <ul>
        <?php
        $list4_product_idx = [];
        foreach ($listData3 as $list3) {

            $shipFreeYn = $list3['shipping_free_yn'] == "Y"; // 배송무료?
            $useYn = $list3['use_yn'] == "Y"; // 사용중?
            $idx = $list3['idx'];
            $listData3_order = $list3['orderItemData'];
            foreach ($listData3_order as $list4) {
                //보험가 적용하는 회원들 따로 가격
                if ($member['INSU_CHECK'] == 'Y') {
                    $list4['prod_price'] = $list4['INSU_PRICE'];
                }
                //중복제거하는 부분
                if (in_array($list4['idx'], $list4_product_idx)) {
                    continue;
                } else {
                    array_push($list4_product_idx, $list4['idx']);
                    $item_CountSql = "SELECT SUM(item_cnt) AS cnt from bs_order_item where product_idx = '{$list4['idx']}' and mb_id = '{$this->session->userdata('member')['mb_id']}'";
                    $item_CountRow = $this->db->query($item_CountSql)->row();
                    $item_Count = ($item_CountRow && $item_CountRow->cnt) ? $item_CountRow->cnt : 0; // 전체 수
                }

                ?>
                <li>
                    <div class="flex">
                        <input type="checkbox" name="checkIdx" id="checkIdx_recent<?= $list4['idx'] ?>"
                               value="<?= $list4['idx'] ?>" class="<?= $list4['idx'] ?>"
                               onclick="checkboxes_func2(this)">
                        <label for="checkIdx_recent<?= $list4['idx'] ?>">
                            <div>
                                <p class="p_name">
                                    <? if ($list4['soldout_yn'] == 'Y') { ?>
                                        <span class="icon bl soldout">
                                <strong>임시품절</strong>
                            </span>
                                    <? } ?>
                                    <?= $list4['PRODUCT_NM'] ?>
                                </p>
                                <span>제조사 <strong><?= $list4['MAKER_NM'] ?></strong> |</span>
								<span>단위 <strong><?= $list4['PRODUCT_STANDARD'] ?></strong> |</span><br class="visible-xs">
                                <span>성분명 <strong><?= $list4['CONS_CD_NM'] ?></strong> |</span>
                                <span>재고수량  <strong><?= number_format(removeComma($list4['STOCK_QTY'])) ?></strong></span>
                            </div>
                            <div class="area_text">
                                <?/*p class="p_date">
                                    <span><?= replaceDateFormat($list3['reg_date']) ?></span><br>구매 <?= number_format($item_Count) ?>
                                    회
								</p*/?>
                                <p class="p_price" style="display: none"><?= number_format(removeComma($list4['prod_price'])) ?>원</p>
                                <p style="font-weight: 700;text-align: right;"><?= number_format(removeComma($list4['prod_price']) * $item_Count) ?>원</p>
                            </div>
                        </label>
                    </div>
                </li>
                <?php
            }
        }
        ?>

        <?php if ($paging3['totalCount'] == 0) { ?>
            <li class="noDataAlign" style="width: 100%; text-align: center;">주문된 상품이 없습니다.</li>
        <?php } ?>
    </ul>
</div>


<div class="paging">
    <div class="pagingWrap">
        <!--처음-->
        <?php if ($paging3['page'] > 1 && $paging3['totalPage'] > 0) { ?>
            <a class="first disabled"
               onclick="callContent_recent(1,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"><i
                        class="fa-light fa-chevrons-left"></i></a>
        <?php } ?>

        <!--이전-->
        <?php if ($paging3['currentBlock'] > 1) { ?>
            <a class="prev disabled"
               onclick="callContent_recent(<?= $paging3['startPage'] - 1 ?>,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"><i
                        class="fa-light fa-chevron-left"></i></a>
        <?php } ?>

        <!--페이지-->
        <?php
        if ($paging3['totalPage'] != 0) {
            foreach (range(1, $paging3['totalPage']) as $number) {
                if ($number >= $paging3['startPage'] && $number <= $paging3['endPage']) {
                    $action = "?page=" . $number . "&" . $qstr;
                    if ($paging3['page'] == $number) $action = "javascript:void(0)";
                    ?>
                    <a class="<?= ($paging3['page'] == $number) ? 'active' : '' ?>"
                       onclick="callContent_recent(<?= $number ?>,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"><?= $number ?></a>
                <?php }
            }
        } ?>

        <!--다음-->
        <?php if ($paging3['totalBlock'] > 1 && $paging3['totalBlock'] != $paging3['currentBlock']) { ?>
            <a class="next disabled"
               onclick="callContent_recent(<?= $paging3['endPage'] + 1 ?>,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"><i
                        class="fa-light fa-chevron-right"></i></a>
        <?php } ?>

        <!--마지막-->
        <?php if ($paging3['page'] < $paging3['totalPage']) { ?>
            <a class="last disabled"
               onclick="callContent_recent(<?= $paging3['totalPage'] + 1 ?>,$('#drugs_recent_hstx').val(),$('#drugs_recent_sdt').val(),$('#drugs_recent_edt').val())"><i
                        class="fa-light fa-chevrons-right"></i></a>
        <?php } ?>
    </div>
</div id="drugs_list_recent_end">
