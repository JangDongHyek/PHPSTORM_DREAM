<script src="/js/jquery-3.7.1.min.js?v=<?= filemtime(FCPATH . 'js/jquery-3.7.1.min.js'); ?>"></script>
<link href="/css/common.css?v=<?= filemtime(FCPATH . 'css/common.css'); ?>" rel="stylesheet" type="text/css">
<div class="modal fade" id="orderLabelModal" tabindex="-1" aria-labelledby="orderLabelModalLabel" aria-hidden="true">
    <button type="button" class="btn btn-primary" onclick="fn_print()">인쇄</button>
        <div>
            <dl class="label_choice grid grid4">
                <dt><strong>수신인 전화번호</strong></dt>
                <dd class="select">
                    <input type="radio" class="rdo" name="phone_number" id="phone_number_x" checked="checked" value="x" onclick="$('.phone_number_show').hide()">
                    <label for="phone_number_x">표시안함</label>
                    <input type="radio" class="rdo" name="phone_number" id="phone_number_o" value="o" onclick="$('.phone_number_show').show()">
                    <label for="phone_number_o">표시함</label>
                </dd>
                <dt><strong>구매자 ID</strong></dt>
                <dd class="select">
                    <input type="radio" class="rdo" name="buyer_id" id="buyer_id_x" checked="checked" value="x" onclick="$('.buyer_id_show').hide()">
                    <label for="buyer_id_x">표시안함</label>
                    <input type="radio" class="rdo" name="buyer_id" id="buyer_id_o" value="o" onclick="$('.buyer_id_show').show()">
                    <label for="buyer_id_o">표시함</label>
                </dd>
            </dl>

            <div id="print_label_list">
                <?php
                $count_3 = 0;
                ?>
                <?php foreach ($this->data['result'] as $row) : ?>
                <div class="print_label <?=$count_3 % 3 == 0 ? "top" : ''?>">
                    <p class="title_txt"><img src="https://pics.esmplus.com/front/icon/bl_arrow.gif" alt="">
                        <?=$row['SiteGoodsNo']?> (<?=$row['OrderNo']?>) <?=$row['GoodsName']?>
                        <?php if($row['ItemOptionSelectList']): ?>
                            <?php $data2 = json_decode($row['ItemOptionSelectList']); ?>
                            <?php $data2_count = 1; ?>
                            <?php foreach ($data2 as $ItemOptionSelectList ): ?>
                                <?=$ItemOptionSelectList->ItemOptionValue ? ' '.$data2_count.'.'.$ItemOptionSelectList->ItemOptionValue.'/' : ''?>
                                <?=$ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt.'/' : ''?>
                                <?=$ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : ''?>
                                <?='</br>'?>
                                <?php $data2_count++ ?>
                            <?php endforeach ?>
                        <?php endif ?>
                        <?php if($row['ItemOptionAdditionList']): ?>
                            <?php $data3 = json_decode($row['ItemOptionAdditionList']); ?>
                            <?php $data3_count = 1; ?>
                            <?php foreach ($data3 as $ItemOptionAdditionList ): ?>
                                <?=$ItemOptionAdditionList->ItemOptionValue ? ' '.$data3_count.'.'.$ItemOptionAdditionList->ItemOptionValue.'/' : ''?>
                                <?=$ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt.'/' : ''?>
                                <?=$ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : ''?>
                                <?='</br>'?>
                                <?php $data3_count++ ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </p>
                    <div class="send_recipient">
                        <div class="box_area">
                            <div class="box_line">
                                <p class="tit">보내는 사람</p>
                                <p class="address">
                                    <span class="nubmer">11906</span>
                                    경기도 구리시 동구릉로460번길 37 1층 카스트코코리아
                                </p>
                                <div class="seller_buyer">
                                    <p class="name">비투피</p>
                                </div>
                            </div>
                        </div>
                        <div class="dotted_line"><img
                                src="https://pics.esmplus.com/front/img/img_label_print_bar.gif" alt="절취선">
                        </div>
                        <div class="box_area">
                            <div class="box_line">
                                <p class="tit">받는 사람</p>
                                <p class="address">
                                    <span class="nubmer"><?=$row['ZipCode']?></span>
                                    <?=$row['DelFullAddress']?>
                                </p>
                                <div class="seller_buyer">
                                    <p class="name"><?=$row['BuyerName']?> 귀하 <span style="display: none;" class="buyer_id_show">(구매자ID : <?=$row['BuyerID']?>)</span>
                                    </p>
                                    <div class="order">
                                        <p class="cut3" style="word-break: break-all">
                                        <?php if($row['ItemOptionSelectList']): ?>
                                            <?php $data2 = json_decode($row['ItemOptionSelectList']); ?>
                                            <?php $data4_count = 1; ?>
                                            <?php foreach ($data2 as $ItemOptionSelectList ): ?>
                                                <?=$ItemOptionSelectList->ItemOptionValue ? ' '.$data4_count.'.'.$ItemOptionSelectList->ItemOptionValue.'/' : ''?>
                                                <?=$ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt.'/' : ''?>
                                                <?=$ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : ''?>
                                                <?='</br>'?>
                                                <?php $data4_count++ ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        <?php if($row['ItemOptionAdditionList']): ?>
                                            <?php $data3 = json_decode($row['ItemOptionAdditionList']); ?>
                                            <?php $data5_count = 1; ?>
                                            <?php foreach ($data3 as $ItemOptionAdditionList ): ?>
                                                <?=$ItemOptionAdditionList->ItemOptionValue ? ' '.$data5_count.'.'.$ItemOptionAdditionList->ItemOptionValue.'/' : ''?>
                                                <?=$ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt.'/' : ''?>
                                                <?=$ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : ''?>
                                                <?='</br>'?>
                                                <?php $data5_count++ ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        </p>
                                        <b style="display: none; margin-top: 5px" class="phone_number_show">(Tel : <?=$row['HpNo']?> / HP : <?=$row['TelNo']?>)</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $count_3++;
                ?>
                <?endforeach;?>
            </div>
        </div>

</div>

<style>
    #orderLabelModal .label_choice {
        margin-bottom: 10px;
        padding: 20px;
        border: 1px solid #eee;
        background-color: #f1f7fa;
        letter-spacing: -1px;
    }
    #orderLabelModal .print_label {
        padding: 20px;
        border: 1px solid #a6a8b6;
    }
    #orderLabelModal .print_label .title_txt {
        margin-bottom: 15px;
    }
    #orderLabelModal .print_label .title_txt img {
        vertical-align: 2px;
    }
    #orderLabelModal .print_label .send_recipient {
        overflow: hidden;
        width: 100%;
        padding-bottom: 27px;
        display: flex;
    }
    #orderLabelModal .print_label .send_recipient .box_area {
        padding: 0 0px;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line {
        position: relative;
        min-height: 210px;
        width: 376px;
        padding: 11px 13px;
        border: 2px solid #a6a8b6;
        font-size: 14px;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .tit {
        margin-bottom: 0px;
        font-size: 12px;
        opacity: 0.7;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .address {
        margin-bottom: 0;
        line-height: 1.2em;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .address .nubmer {
        display: block;
        font-weight: bold;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .seller_buyer {
        position: absolute;
        bottom: 11px;
        left: 13px;
        width: calc(100% - 26px);
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .seller_buyer .name {
        font-size: 14px;
        font-weight: bold;
        color: #000;
        margin-top: 0;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .seller_buyer .name span {
        font-size: 11px;
        font-weight: normal;
        color: #48494f;
    }
    #orderLabelModal .print_label .send_recipient .box_area .box_line .seller_buyer .order {
        margin-top: 1px;
        font-size: 11px;
        line-height: 15px;
    }
    #orderLabelModal .print_label .send_recipient .dotted_line {
        width: 54px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media print {
        html, body {
            width: 210mm;
            height: 297mm;}
        #orderLabelModal {width: 210mm;min-height: 297mm!important;}
        #orderLabelModal.over {    min-height: 594mm!important;}
        #orderLabelModal .print_label {
            padding: 10px 0 !important;
            border: 0!important;
            border-bottom: 1px solid #000000 !important;
        }
        #orderLabelModal .print_label.top {
            page-break-before:always;margin-top:1cm
        }
        #orderLabelModal .print_label .title_txt {
            font-size: 12px;
            line-height: 1.2em;
        }
    }
    @page {
        size: auto;  /* auto is the initial value */
        margin: 0 1cm;  /* this affects the margin in the printer settings */
    }

</style>
<script>
    function fn_print(){
        var initBody = document.body.innerHTML; //body영역 저장
        window.onbeforeprint = function () { //프린터 출력 전 이벤트
            $('.btn-primary').hide()
            $('.label_choice').hide()
        }
        window.onafterprint = function () { //프린터 출력 후 이벤트
            $('.btn-primary').show()
            $('.label_choice').show()
        }
        window.print();
    }

</script>