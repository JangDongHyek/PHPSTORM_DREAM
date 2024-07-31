
<div class="box optionBox">
    <h4>
        <span class="color-blue">(필수)</span> 옵션
    </h4>

    <!-- 선택옵션 -->
    <?php
        echo view('goods/form/goods_option_form', $this->data);
    ?>

    <?
        $recommendedOpts = json_decode($goods_data['recommendedOpts'], true);
        $useOptionText = empty($recommendedOpts['text']) ? false : true;
    ?>

    <div class="input_form">
        <p>텍스트형</p>
        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="useOptionText1" name="useOptionText" value="T" <?=get_checked($useOptionText, true)?>>
                <label for="useOptionText1">
                    <i class="fa-duotone fa-circle-check"></i>설정함
                </label>
            </div>


            <div class="input_radio">
                <input type="radio" id="useOptionText2" name="useOptionText" value="F" <?=get_checked($useOptionText, false)?>>
                <label for="useOptionText2">
                    <i class="fa-duotone fa-circle-check"></i>설정안함
                </label>
            </div>
        </div>
    </div>

    <div id="div_textOption" class="secondBox" style="display: <?=get_displayed($useOptionText,true)?>">
        <p><span class="color-blue">(필수)</span> 옵션입력</p>
        <div class="option_grid">
            <div id="div_textOptionNameList">
                <p class="text-guide">옵션명</p>
                <?
                    if(empty($recommendedOpts['text'])){ ?>
                        <div class="input_select option-name">
                            <input type="text" name="textOptionName[]" placeholder="옵션명을 입력해주세요." class="border_gray" value="">
                        </div>
                    <?} else {
                        foreach ($recommendedOpts['text']['details'] as $index => $row){ ?>
                            <div class="input_select option-name">
                                <input type="text" name="textOptionName[]" placeholder="옵션명을 입력해주세요." class="border_gray" value="<?=$row['Value']?>">
                            </div>
                        <?}
                    }
                ?>
            </div>

            <div class="" id="div_displaydiv_textOptionNameList">
                <p class="text-guide">노출여부</p>
                <?
                if(empty($recommendedOpts['text'])){ ?>
                    <div class="flex gap10 option-value">
                        <div class="input_select option-name w50">
                            <select class="border_gray" name="displayTextOptionName[]">
                                <option value="T">노출</option>
                                <option value="F">비노출</option>
                            </select>
                        </div>
                        <button type="button" class="flex gap5 btn btn-white remove-button-text" style="display: none;"><i class="fa-light fa-minus"></i>삭제</button>
                        <button type="button" class="flex gap5 btn btn-blue add-button-text"><i class="fa-light fa-plus"></i>추가</button>
                    </div>
                <?} else {
                    foreach ($recommendedOpts['text']['details'] as $index => $row){ ?>
                        <div class="flex gap10 option-value">
                            <div class="input_select option-name w50">
                                <select class="border_gray" name="displayTextOptionName[]">
                                    <option value="T" <?=get_checked($row['isDisplay'],true)?>>노출</option>
                                    <option value="F" <?=get_checked($row['isDisplay'],false)?>>비노출</option>
                                </select>
                            </div>
                            <button type="button" class="flex gap5 btn btn-white remove-button-text" style="display: none;"><i class="fa-light fa-minus"></i>삭제</button>
                            <button type="button" class="flex gap5 btn btn-blue add-button-text"><i class="fa-light fa-plus"></i>추가</button>
                        </div>
                    <?}
                }
                ?>

            </div>
        </div>
    </div>
    <!--텍스트형-->

</div>
<!-- 옵션 -->

<!-- 디자인 확인 필요 -->
<!-- 오토오아시스 -->

<div class="box stockBox">
    <h4>오토오아시스 배송</h4>
    <div class="input_form">

        <div class="">
            <p><span class="color-blue">(필수)</span> 오토오아시스 배송여부</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="b2pAuto1" name="b2pAuto" value="T" <?= get_checked($goods_data['b2pAuto'], "T")?>>
                    <label for="b2pAuto1">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="b2pAuto2" name="b2pAuto" value="F" <?=get_checked($goods_data['b2pAuto'], "F")?> <?=get_checked($goods_data['b2pAuto'], "")?>>
                    <label for="b2pAuto2">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
            <p class="flex gap5 text-guide">
                <i class="fa-duotone fa-circle-exclamation"></i>오토오아시스 배송여부를 사용할 경우 텍스트옵션은 최대 4개까지 사용 가능합니다.
            </p>
        </div>
    </div>

</div>
<!-- 오토오아시스 -->


<div class="box stockBox"><!--재고수량-->
    <h4>재고수량</h4>
    <div class="input_form">

        <div class="">
            <p><span class="color-blue">(필수)</span> 재고수량</p>
            <div class="input_unit">
                <!-- 테스트값 삭제 -->
                <?
                    $stock_gmkt = 99999;
                    $stock_iac = 99999;
                    if(!empty($goods_data['stock_gmkt'])){
                        $stock_gmkt = (int) $goods_data['stock_gmkt'];
                    }
                    if(!empty($goods_data['stock_iac'])){
                        $stock_iac = (int) $goods_data['stock_iac'];
                    }
                    $goods_stock = min($stock_gmkt, $stock_iac, 99999);

                ?>
                <input type="text" id="stock" name="stock" placeholder="입력해주세요." class="border_gray" value="<?=number_format($goods_stock)?>">개
            </div>
            <p class="flex gap5 text-guide">
                <i class="fa-duotone fa-circle-exclamation"></i>옵션 재고수량을 설정하면, 상품등록시 옵션의 재고수량으로 자동 적용됩니다.
            </p>
        </div>
    </div>

</div>
<!--재고수량-->

<div class="box imgBox"><!--상품이미지-->
    <h4>
        <span class="color-blue">(필수)</span> 상품이미지
    </h4>
    <div class="">

        <?
            $imagesArr = [];
            if(!empty($goods_data['images'])){
                $imagesArr = json_decode($goods_data['images'], true);
            }

        ?>

        <div class="btn-proImgList">
            <p>상품 기본 이미지</p>
            <input class="border_gray" id="basicImgURL" name="basicImgURL" placeholder="링크를 입력해주세요" value="<?=array_shift($imagesArr)?>"><br>
        </div>
        <br>
        <div class="proImgAddList">
            <p>상품 추가 이미지</p>
            <button type="button" class="flex gap5 btn btn-blue" id="addImgBtn"><i class="fa-light fa-plus"></i>추가</button>
            <div id="addtionalImg">
                    <?
                        foreach ($imagesArr as $index => $item) {
                            if(empty($item)) {
                                continue;
                            }
                            ?>
                            <div class="flex">
                                <input class="border_gray" name="addtionalImg[]" value="<?=$item?>" placeholder="링크를 입력해주세요">
                                <button type="button" class="flex gap5 btn btn-white removeBtn"><i class="fa-light fa-xmark"></i>삭제</button>
                            </div>
                        <?}
                    ?>
            </div>
        </div>
    </div>
    <p class="flex gap5 text-guide">
        <i class="fa-duotone fa-circle-exclamation"></i>상품이미지는 15장까지 업로드 가능합니다
    </p>
</div>
<!--상품이미지-->

<?php echo view('goods/js/goods_js_2', $this->data); ?>