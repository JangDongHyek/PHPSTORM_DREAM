<?php

$addonService = json_decode($goods_data['addonService'], true);

$useAddonService = false;
if($addonService['addonServiceUseType'] != 0){
    $useAddonService = true;
}

$addonServiceData = [];
if($useAddonService){
    $addonServiceList = $addonService['addonServiceList'];
    foreach ($addonServiceList as $i => $list){
        $addonServiceData[$list['addonServiceName']][$i]['value'] = $list['addonServiceValueName'];
        $addonServiceData[$list['addonServiceName']][$i]['isSoldOut'] = $list['qtyInfo']['isSoldOut'];
        $addonServiceData[$list['addonServiceName']][$i]['isDisplay'] = $list['qtyInfo']['exposeYN'];
        $addonServiceData[$list['addonServiceName']][$i]['manageCode'] = $list['manageCode'];
        $addonServiceData[$list['addonServiceName']][$i]['addAmnt'] = $list['addonServiceAmnt'];

        $qty = 99999;
        $qty_gmkt = 99999;
        if($goods_data['isSell_gmkt'] == 'T'){
            $qty_gmkt = $list['qtyInfo']['qty']['gmkt'];
        }
        $qty_iac = 99999;
        if($goods_data['isSell_iac'] == 'T'){
            $qty_iac = $list['qtyInfo']['qty']['iac'];
        }
        $addonServiceData[$list['addonServiceName']][$i]['qty'] = min($qty, $qty_gmkt, $qty_iac);
    }
}

?>
<div class="input_form">
    <p>추가구성</p>

    <div class="flex gap20">
        <div class="input_radio">
            <input type="radio" id="useAddonService1" name="useAddonService" value="T" <?=get_checked($useAddonService, true)?>>
            <label for="useAddonService1">
                <i class="fa-duotone fa-circle-check"></i>설정함
            </label>
        </div>
        <div class="input_radio">
            <input type="radio" id="useaddonService2" name="useAddonService" value="F" <?=get_checked($useAddonService, false)?>>
            <label for="useaddonService2">
                <i class="fa-duotone fa-circle-check"></i>설정안함
            </label>
        </div>

    </div>
</div>

<div class="secondBox" id="div_useAddonService" style="display: <?=get_displayed($useAddonService,true)?>">
    <p><span class="color-blue">(필수)</span> 추가구성 입력</p>
    <div class="option_grid">
        <div>
            <p class="text-guide">추가구성명</p>

            <div id="div_addonServiceName">
                <?
                if(!empty($addonServiceData)){
                    $i = 1;
                    foreach ($addonServiceData as $key => $optionData){ ?>
                        <div class="input_select addonService-name" data-id="addonService-<?=$i++?>">
                            <input type="text" placeholder="옵션명을 입력해주세요." name="makeAddonServiceName[]" class="border_gray" value="<?=$key?>">
                        </div>
                    <?}
                }
                ?>
            </div>

        </div>
        <div class="" >
            <p class="text-guide">추가구성값</p>
            <div id="div_addonServiceValue">
                <?
                if(!empty($addonServiceData)){
                    $i=1;
                    foreach ($addonServiceData as $key => $optionData){
                        $optionValueArr = array_column($optionData, 'value');
                        $optionValues = implode(',', $optionValueArr);
                        ?>

                        <div class="flex gap10 addonService-value" data-id="addonService-<?=$i?>">
                            <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" name="makeAddonServiceValue[]" class="border_gray" value="<?=$optionValues?>">
                            <button type="button" class="flex gap5 btn btn-blue add_addon-btn" style=""><i class="fa-light fa-plus"></i>추가</button>
                            <button type="button" class="flex gap5 btn btn-white delete_addon-btn" data-id="addonService-<?=$i?>" style="display: none;"><i class="fa-light fa-xmark"></i>삭제</button>
                        </div>
                        <?
                        $i++;
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <button type="button" id="add_addons" class="btn-option-save btn-blue"><i class="fa-light fa-arrow-down"></i>추가구성 목록으로 적용</button>

    <p><span class="color-blue">(필수)</span> 추가구성 목록 </p>
    <!--        <div class="flex justi-sb option_wrap">
                <div class="flex gap10">
                    <div class="input_select w100px">

                        <select class="border_gray">
                            <option value="등록순">등록순</option>
                            <option value="등록순">등록순</option>
                            <option value="등록순">등록순</option>
                        </select>
                    </div>
                    <a href="" class="inlineflex gap5 btn btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 다운로드</a>
                </div>
            </div>-->


    <div class="option_table">
        <div class="top_btn">
            <div></div>
            <button type="button" id="delete_addon_selected" class="btn btn-sm btn-white">선택삭제</button>
        </div>
        <div class="table">
            <table>
                <thead id="addon_table_head">
                <tr>
                    <th width="50px">
                        <div class="input_checkbox"><input type="checkbox" id="addon-selectall"><label for="addon-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label></div>
                    </th>
                    <th>추가구성명</th>
                    <th>추가구성값</th>
                    <th>추가금<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonExtraPrice">일괄수정</button></th>
                    <th class="stock-column">재고수량<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonStock">일괄수정</button></th>
                    <th>판매상태<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonSaleStatus">일괄수정</button></th>
                    <th>노출여부<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonDisplayStatus">일괄수정</button></th>
                    <th>삭제</th>
                </tr>
                </thead>
                <tbody id="addon_list">
                <?php
                if (!empty($addonServiceData)) {
                    $i = 1;
                    foreach ($addonServiceData as $addonName => $addonData) {
                        foreach ($addonData as $j => $detail) {
                            ?>
                            <tr>
                                <td>
                                    <div class="input_checkbox">
                                        <input type="checkbox" class="row-select" id="checkbox_addon_<?=$i.$j?>">
                                        <label for="checkbox_addon_<?=$i.$j?>"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                    </div>
                                </td>
                                <td><span><?=$addonName?></span><input type="hidden" name="addonName[]" value="<?=$addonName?>"></td>
                                <td><input type="text" name="addonValue[]" value="<?=$detail['value']?>" class="border_gray"></td>
                                <td><input type="text" name="addonExtraPrice[]" value="<?=$detail['addAmnt']?>" class="border_gray"></td>
                                <td class="stock-column" style="display: none;"><input type="text" name="addonStock[]" value="<?=$detail['qty']?>" class="border_gray"></td>
                                <td>
                                    <div class="input_select">
                                        <select name="addonSaleStatus[]" class="border_gray">
                                            <option value="T" <?=$detail['isSoldOut'] ? '' : 'selected'?>>판매가능</option>
                                            <option value="F" <?=$detail['isSoldOut'] ? 'selected' : ''?>>품절</option>
                                        </select>
                                    </div>
                                </td>
                                <td><input type="text" name="addonManageCode[]" value="<?=$detail['manageCode']?>" class="border_gray"></td>
                                <td>
                                    <div class="input_select">
                                        <select name="addonDisplayStatus[]" class="border_gray">
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
    </div>
</div>


