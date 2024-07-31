<?php

$recommendedOpts = json_decode($goods_data['recommendedOpts'], true);
// 옵션사용여부
$useSelectOption = false;
$useTextOption = false;
$optsType = "i";

$selectOptionData = [];
$combinationOptionData = [];
if(!empty($recommendedOpts['independent']) || !empty($recommendedOpts['independents'])){
    $useSelectOption = true;
    $optsType = "i";

    if(!empty($recommendedOpts['independent'])){
        $independent = $recommendedOpts['independent'];
        $optionName = $independent['recommendedOptName']['koreanText'];

        $selectOptionData[$optionName] = [];
        $details = $independent['details'];
        foreach ($details as $j => $detail){
            $selectOptionData[$optionName][$j]['value'] = $detail['recommendedOptValue']['koreanText'];
            $selectOptionData[$optionName][$j]['isSoldOut'] = $detail['isSoldOut'];
            $selectOptionData[$optionName][$j]['isDisplay'] = $detail['isDisplay'];
            $selectOptionData[$optionName][$j]['manageCode'] = $detail['manageCode'];
            $selectOptionData[$optionName][$j]['addAmnt'] = $detail['addAmnt'];

            $qty = 99999;
            $qty_gmkt = 99999;
            if($goods_data['isSell_gmkt'] == 'T'){
                $qty_gmkt = $detail['qty']['gmkt'];
            }
            $qty_iac = 99999;
            if($goods_data['isSell_iac'] == 'T'){
                $qty_iac = $detail['qty']['iac'];
            }
            $selectOptionData[$optionName][$j]['qty'] = min($qty, $qty_gmkt, $qty_iac);
        }
    } else if(!empty($recommendedOpts['independents'])) {
        $independents = $recommendedOpts['independents'];
        foreach ($independents as $i => $independent){
            $optionName = $independent['recommendedOptName']['koreanText'];

            $selectOptionData[$optionName] = [];
            $details = $independent['details'];
            foreach ($details as $j => $detail){
                $selectOptionData[$optionName][$j]['value'] = $detail['recommendedOptValue']['koreanText'];
                $selectOptionData[$optionName][$j]['isSoldOut'] = $detail['isSoldOut'];
                $selectOptionData[$optionName][$j]['isDisplay'] = $detail['isDisplay'];
                $selectOptionData[$optionName][$j]['manageCode'] = $detail['manageCode'];
                $selectOptionData[$optionName][$j]['addAmnt'] = $detail['addAmnt'];
                $selectOptionData[$optionName][$j]['qty_iac'] = $detail['qty']['iac'];
                $selectOptionData[$optionName][$j]['qty_gmkt'] = $detail['qty']['gmkt'];

                $qty = 99999;
                $qty_gmkt = 99999;
                if($goods_data['isSell_gmkt'] == 'T'){
                    $qty_gmkt = $detail['qty']['gmkt'];
                }
                $qty_iac = 99999;
                if($goods_data['isSell_iac'] == 'T'){
                    $qty_iac = $detail['qty']['iac'];
                }
                $selectOptionData[$optionName][$j]['qty'] = min($qty, $qty_gmkt, $qty_iac);
            }
        }
    }

} else if(!empty($recommendedOpts['combination'])) {
    $useSelectOption = true;
    $optsType = "c";
    $combination = $recommendedOpts['combination'];

    $optionName1 = $combination['recommendedOptName1']['koreanText'];
    $optionName2 = $combination['recommendedOptName2']['koreanText'];
    $optionName3 = $combination['recommendedOptName3']['koreanText'];

    $selectOptionData[$optionName1] = [];
    $selectOptionData[$optionName2] = [];
    if(!empty($optionName3)){
        $selectOptionData[$optionName3] = [];
    }

    $details = $combination['details'];
    foreach ($details as $j => $detail){
        $selectOptionData[$optionName1][$j]['value1'] = $detail['recommendedOptValue1']['koreanText'];
        $selectOptionData[$optionName2][$j]['value2'] = $detail['recommendedOptValue2']['koreanText'];

        $combinationOptionData[$j]['value1'] = $detail['recommendedOptValue1']['koreanText'];
        $combinationOptionData[$j]['value2'] = $detail['recommendedOptValue2']['koreanText'];
        if(!empty($optionName3)){
            $selectOptionData[$optionName3][$j]['value3'] = $detail['recommendedOptValue3']['koreanText'];

            $combinationOptionData[$j]['value3'] = $detail['recommendedOptValue3']['koreanText'];
        }
        $combinationOptionData[$j]['isSoldOut'] = $detail['isSoldOut'];
        $combinationOptionData[$j]['isDisplay'] = $detail['isDisplay'];
        $combinationOptionData[$j]['manageCode'] = $detail['manageCode'];
        $combinationOptionData[$j]['addAmnt'] = $detail['addAmnt'];
        $combinationOptionData[$j]['qty_iac'] = $detail['qty']['iac'];
        $combinationOptionData[$j]['qty_gmkt'] = $detail['qty']['gmkt'];

        $qty = 99999;
        $qty_gmkt = 99999;
        if($goods_data['isSell_gmkt'] == 'T'){
            $qty_gmkt = $detail['qty']['gmkt'];
        }
        $qty_iac = 99999;
        if($goods_data['isSell_iac'] == 'T'){
            $qty_iac = $detail['qty']['iac'];
        }
        $combinationOptionData[$j]['qty'] = min($qty, $qty_gmkt, $qty_iac);
    }

}

if(!empty($recommendedOpts['text'])) {
    $useTextOption = true;
}

$stock_display = "none";
if($recommendedOpts['isStockManage']){
    $stock_display = "";
}

?>

<div class="input_form">
    <p>선택형</p>
    <div class="flex gap20">
        <div class="input_radio">
            <input type="radio" id="useSelectOption1" name="useSelectOption" value="T" <?=get_checked($useSelectOption, true)?>>
            <label for="useSelectOption1">
                <i class="fa-duotone fa-circle-check"></i>설정함
            </label>
        </div>


        <div class="input_radio">
            <input type="radio" id="useSelectOption2" name="useSelectOption" value="F" <?=get_checked($useSelectOption, false)?>>
            <label for="useSelectOption2">
                <i class="fa-duotone fa-circle-check"></i>설정안함
            </label>
        </div>
    </div>
</div>


<div class="secondBox" id="div_selectOption" style="display: <?=get_displayed($useSelectOption,true)?>">
    <div>
        <p><span class="color-blue">(필수)</span> 옵션 입력방식</p>
        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="radi_option_upload01_01" name="radi_option_upload01" checked>
                <label for="radi_option_upload01_01">
                    <i class="fa-duotone fa-circle-check"></i>직접 입력하기
                </label>
            </div>

            <!--<div class="input_radio">
                <input type="radio" id="radi_option_upload01_02" name="radi_option_upload01">
                <label for="radi_option_upload01_02">
                    <i class="fa-duotone fa-circle-check"></i>엑셀 일괄 등록하기
                </label>
            </div>-->

        </div>

        <!--<div class="exel_btn_wrap">
            <input type="file" id="file-exel">
            <label for="file-exel" class="btn btn-sm btn-blue">
                <i class="fa-duotone fa-arrow-up-from-bracket"></i>엑셀 업로드
            </label>

            <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(단독형)</a>
            <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(2개조합형)</a>
            <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(3개조합형)</a>
        </div>-->
    </div>


    <div>
        <p><span class="color-blue">(필수)</span> 옵션 유형</p>
        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="optsType1" name="optsType" value="i" <?=get_checked($optsType, "i")?>>
                <label for="optsType1">
                    <i class="fa-duotone fa-circle-check"></i>단독형
                </label>
            </div>

            <div class="input_radio">
                <input type="radio" id="optsType2" name="optsType" value="c" <?=get_checked($optsType, "c")?>>
                <label for="optsType2">
                    <i class="fa-duotone fa-circle-check"></i>조합형
                </label>
            </div>
        </div>
    </div>

    <p><span class="color-blue">(필수)</span> 옵션입력</p>
    <div class="option_grid">
        <div>
            <p class="text-guide">옵션명</p>
            <div id="div_optionName">
                <?
                if(!empty($selectOptionData)){
                    $i = 1;
                    foreach ($selectOptionData as $key => $optionData){ ?>
                        <div class="input_select option-name" data-id="option-<?=$i++?>">
                            <input type="text" placeholder="옵션명을 입력해주세요." name="makeOptionName[]" class="border_gray" value="<?=$key?>">
                        </div>
                    <?}
                }
                ?>
            </div>
        </div>

        <div>
            <p class="text-guide">옵션값</p>
                <div id="div_optionValue">
                    <?
                    if(!empty($selectOptionData)){
                        $i=1;
                        foreach ($selectOptionData as $key => $optionData){
                            $optionValueArr = array_column($optionData, 'value');
                            if(empty($optionValueArr)){
                                // 조합형
                                $optionValueArr = array_column($optionData, 'value'.$i);
                                $optionValueArr = array_unique($optionValueArr);
                            }
                            $optionValues = implode(',', $optionValueArr);
                            ?>
                            <div class="flex gap10 option-value" data-id="option-<?=$i?>">
                                <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" name="makeOptionValue[]" class="border_gray" value="<?=$optionValues?>">
                                <button type="button" class="flex gap5 btn btn-blue add-btn" style=""><i class="fa-light fa-plus"></i>추가</button>
                                <button type="button" class="flex gap5 btn btn-white delete-btn" data-id="option-<?=$i?>" style="display: none;"><i class="fa-light fa-xmark"></i>삭제</button>
                            </div>
                            <?
                            $i++;
                        }
                    }
                    ?>
                </div>
        </div>
    </div>
    <button type="button" id="add_options" class="btn-option-save btn-blue"><i class="fa-light fa-arrow-down"></i>옵션목록으로 적용</button>


    <p><span class="color-blue">(필수)</span> 옵션 목록 </p>
    <div class="flex justi-sb option_wrap mb0">
        <div class="input_checkbox">
            <input type="checkbox" id="optionStockmanager" name="useOptionStockmanager" value="T" <?=get_checked($recommendedOpts['isStockManage'], true)?>>
            <label for="optionStockmanager"><i class="fa-duotone fa-square-check txt-lg"></i>재고수량 관리</label>
        </div>

        <!--            <div class="flex gap10">
                        <div class="input_select w100px">

                            <select class="border_gray">
                                <option value="등록순">등록순</option>
                                <option value="등록순">등록순</option>
                                <option value="등록순">등록순</option>
                            </select>
                        </div>

                        <a href="" class="inlineflex gap5 btn btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 다운로드</a>
                    </div>-->
    </div>


    <div class="option_table">
        <div class="top_btn">
            <div></div>
            <button type="button" class="btn btn-sm btn-white" id="delete_selected">선택삭제</button>
        </div>
        <?php if ($optsType === "i"): ?>
            <!-- 단독형 테이블 -->
        <div class="table">
            <table>
                <thead id="option_table_head">
                <tr>
                    <th width="50px">
                        <div class="input_checkbox">
                            <input type="checkbox" id="option-selectall">
                            <label for="option-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                        </div>
                    </th>
                    <th>옵션명</th>
                    <th>옵션값</th>
                    <th>추가금 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionExtraPrice">일괄수정</button></th>
                    <th class="stock-column" style="display: <?=$stock_display?>;">재고수량 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionStock">일괄수정</button></th>
                    <th>판매상태 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionSaleStatus">일괄수정</button></th>

                    <th>노출여부 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionDisplayStatus">일괄수정</button></th>
                    <th>삭제</th>
                </tr>
                </thead>
                <tbody id="option_list">
                <?php
                if (!empty($selectOptionData)) {
                    $i = 1;
                    foreach ($selectOptionData as $optionName => $optionData) {
                        foreach ($optionData as $j => $detail) {
                            ?>
                            <tr>
                                <td>
                                    <div class="input_checkbox">
                                        <input type="checkbox" class="row-select" id="checkbox_option_<?=$i.$j?>">
                                        <label for="checkbox_option_<?=$i.$j?>"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                    </div>
                                </td>
                                <td><span><?=$optionName?></span><input type="hidden" name="optionName[]" value="<?=$optionName?>"></td>
                                <td><input type="text" name="optionValue[]" value="<?=$detail['value']?>" class="border_gray"></td>
                                <td><input type="text" name="optionExtraPrice[]" value="<?=$detail['addAmnt']?>" class="border_gray"></td>
                                <td class="stock-column" style="display: <?=$stock_display?>;"><input type="text" name="optionStock[]" value="<?=$detail['qty']?>" class="border_gray"></td>
                                <td>
                                    <div class="input_select">
                                        <select name="optionSaleStatus[]" class="border_gray">
                                            <option value="T" <?=$detail['isSoldOut'] ? '' : 'selected'?>>판매가능</option>
                                            <option value="F" <?=$detail['isSoldOut'] ? 'selected' : ''?>>품절</option>
                                        </select>
                                    </div>
                                </td>

                                <td>
                                    <div class="input_select">
                                        <select name="optionDisplayStatus[]" class="border_gray">
                                            <option value="T" <?=$detail['isDisplay'] ? 'selected' : ''?>>노출</option>
                                            <option value="F" <?=$detail['isDisplay'] ? '' : 'selected'?>>미노출</option>
                                        </select>
                                    </div>
                                </td>
                                <td><button type="button" class="btn btn-sm btn-white delete-row">삭제</button></td>
                            </tr>
                            <?php
                        }
                        $i++;
                    }
                } else {
                    ?>
                    <tr class="nodata_tr">
                        <td colspan="9"><p><i class="fa-duotone fa-circle-exclamation"></i>적용된 옵션값이 없습니다</p></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php elseif ($optsType === "c"): ?>
            <!-- 조합형 테이블 -->
        <div class="table">
            <table>
                <thead id="option_table_head">
                <tr>
                    <th width="50px">
                        <div class="input_checkbox">
                            <input type="checkbox" id="option-selectall">
                            <label for="option-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                        </div>
                    </th>
                    <th><?=$optionName1?><input type="hidden" name="optionName[]" value="<?=$optionName1?>"></th>
                    <th><?=$optionName2?><input type="hidden" name="optionName[]" value="<?=$optionName2?>"></th>
                    <? if(empty(!$optionName3)) { ?>
                        <th><?=$optionName3?><input type="hidden" name="optionName[]" value="<?=$optionName3?>"></th>
                    <?}?>
                    <th>추가금 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionExtraPrice">일괄수정</button></th>
                    <th class="stock-column" style="display: <?=$stock_display?>;">재고수량 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionStock">일괄수정</button></th>
                    <th>판매상태 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionSaleStatus">일괄수정</button></th>

                    <th>노출여부 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionDisplayStatus">일괄수정</button></th>
                    <th>삭제</th>
                </tr>
                </thead>
                <tbody id="option_list">
                <?php
                if (!empty($combinationOptionData)) {

                    $i = 0;
                    foreach ($combinationOptionData as $combination) {
                        ?>
                        <tr id="row_combo_option_<?=$i?>">
                            <td>
                                <div class="input_checkbox">
                                    <input type="checkbox" id="checkbox_combo_option_<?=$i?>" class="row-select">
                                    <label for="checkbox_combo_option_<?=$i?>"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                </div>
                            </td>
                            <td><input type="text" name="optionValue0[]" value="<?=$combination['value1']?>" class="border_gray"></td>
                            <td><input type="text" name="optionValue1[]" value="<?=$combination['value2']?>" class="border_gray"></td>
                            <?  if(!empty($combination['value3'])){ ?>
                                <td><input type="text" name="optionValue2[]" value="<?=$combination['value3']?>" class="border_gray"></td>
                            <?}?>
                            <td><input type="text" name="optionExtraPrice[]" value="<?=$combination['addAmnt']?>" class="border_gray"></td>
                            <td class="stock-column" style="display: <?=$stock_display?>;"><input type="text" name="optionStock[]" value="<?=$combination['qty']?>" class="border_gray"></td>
                            <td>
                                <div class="input_select">
                                    <select name="optionSaleStatus[]" class="border_gray">
                                        <option value="T" <?=$combination['isSoldOut'] ? '' : 'selected'?>>판매가능</option>
                                        <option value="F" <?=$combination['isSoldOut'] ? 'selected' : ''?>>품절</option>
                                    </select>
                                </div>
                            </td>

                            <td>
                                <div class="input_select">
                                    <select name="optionDisplayStatus[]" class="border_gray">
                                        <option value="T" <?=$combination['isDisplay'] ? 'selected' : ''?>>노출</option>
                                        <option value="F" <?=$combination['isDisplay'] ? '' : 'selected'?>>미노출</option>
                                    </select>
                                </div>
                            </td>
                            <td><button type="button" class="btn btn-sm btn-white delete-row" data-id="row_combo_option_<?=$i?>">삭제</button></td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr class="nodata_tr">
                        <td colspan="9"><p><i class="fa-duotone fa-circle-exclamation"></i>적용된 옵션값이 없습니다</p></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<!--선택형-->