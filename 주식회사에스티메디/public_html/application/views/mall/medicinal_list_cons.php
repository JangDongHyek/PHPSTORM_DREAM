<div class="box" id="drugs_list_cons">
    <p class="txt_bold txt_blue">선택 의약품</p>
    <div class="flex jc-sb basic">
        <div>
            <p class="p_name"><?= $PRODUCT_NM ?></p>
        </div>
        <div class="area_text main_hide">
            <p class="p_price"><?= $prod_price ?><?=$prod_price != 0 ? '원' : ''?></p>
        </div>
    </div>
</div>
<div class="search">
    <input type="search" name="hstx" id="drugs_cons_hstx" placeholder="원하시는 제품을 검색하세요" value="<?= $cons_hstx ?>"
           onkeyup="if(window.event.keyCode==13){callContent_cons(1,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())}"/>
    <button type="button" class="btn"
            onclick="callContent_cons(1,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())">
        <i class="fa-regular fa-magnifying-glass"></i></button>
</div>

<p class="txt_bold txt_blue">대체약(<?= $totalCount ?>) / <?= $CONS_CD ?></p>
<ul class="drugs_list">
    <?php
    foreach ($listData2 as $list2) {
        $shipFreeYn = $list2['shipping_free_yn'] == "Y"; // 배송무료?
        $useYn = $list2['use_yn'] == "Y"; // 사용중?
        $idx = $list2['idx'];

        //보험가 적용하는 회원들 따로 가격
        if ($member['INSU_CHECK'] == 'Y') {
            $list2['prod_price'] = $list2['INSU_PRICE'];
        }

        if((int)$list2['prod_price'] == 0 ){
            $list2['prod_price'] = '제품문의';
        }else{
            $list2['prod_price'] = number_format(removeComma($list2['prod_price']));
            $list2['prod_price'] .= '원';
        }
        ?>
        <li>
            <div class="flex">
                <input type="checkbox" name="checkIdx" id="checkIdx_cons<?= $list2['idx'] ?>"
                       value="<?= $list2['idx'] ?>" class="<?= $list2['idx'] ?>" onclick="checkboxes_func2(this)">
                <label for="checkIdx_cons<?= $list2['idx'] ?>">
                    <div>
                        <p class="p_name">
                            <? if ($list2['soldout_yn'] == 'Y') { ?>
                                <span class="icon bl soldout">
                                <strong>임시품절</strong>
                            </span>
                            <? } ?>
                            <?= $list2['PRODUCT_NM'] ?>
                        </p>
                        <span>제조사 <strong><?= $list2['MAKER_NM'] ?></strong> |</span>
                        <span>성분분류명 <strong><?= $list2['CONS_CD'] ?></strong> |</span>
                        <span>단위 <strong><?= $list2['PRODUCT_STANDARD'] ?></strong> |</span>
                        <span class="main_hide">재고수량  <strong><?= number_format(removeComma($list2['STOCK_QTY'])) ?></strong></span>
                    </div>
                    <!--
                    <div class="area_text main_hide">
                    -->
                    <div class="area_text">
                        <p class="p_price"><?=$list2['prod_price']?></p>
                    </div>
                </label>
            </div>
        </li>
        <?php
    }
    ?>
</ul>
<div class="paging">
    <div class="pagingWrap">
        <!--처음-->
        <?php if ($paging2['page'] > 1 && $paging2['totalPage'] > 0) { ?>
            <a class="first disabled"
               onclick="callContent_cons(1,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())"><i
                        class="fa-light fa-chevrons-left"></i></a>
        <?php } ?>

        <!--이전-->
        <?php if ($paging2['currentBlock'] > 1) { ?>
            <a class="prev disabled"
               onclick="callContent_cons(<?= $paging2['startPage'] - 1 ?>,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())"><i
                        class="fa-light fa-chevron-left"></i></a>
        <?php } ?>

        <!--페이지-->
        <?php
        if ($paging2['totalPage'] != 0) {
            foreach (range(1, $paging2['totalPage']) as $number) {
                if ($number >= $paging2['startPage'] && $number <= $paging2['endPage']) {
                    $action = "?page=" . $number . "&" . $qstr;
                    if ($paging2['page'] == $number) $action = "javascript:void(0)";
                    ?>
                    <a class="<?= ($paging2['page'] == $number) ? 'active' : '' ?>"
                       onclick="callContent_cons(<?= $number ?>,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())"><?= $number ?></a>
                <?php }
            }
        } ?>

        <!--다음-->
        <?php if ($paging2['totalBlock'] > 1 && $paging2['totalBlock'] != $paging2['currentBlock']) { ?>
            <a class="next disabled"
               onclick="callContent_cons(<?= $paging2['endPage'] + 1 ?>,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())"><i
                        class="fa-light fa-chevron-right"></i></a>
        <?php } ?>

        <!--마지막-->
        <?php if ($paging2['page'] < $paging2['totalPage']) { ?>
            <a class="last disabled"
               onclick="callContent_cons(<?= $paging2['totalPage'] + 1 ?>,'<?= $CONS_CD ?>','<?= $PRODUCT_NM ?>','<?= $prod_price ?>',$('#drugs_cons_hstx').val())"><i
                        class="fa-light fa-chevrons-right"></i></a>
        <?php } ?>
    </div>
</div id="drugs_list_cons_end">



