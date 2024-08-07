<?php
$pid = "now";
include_once("./app_head.php");

$dispatch_idx = $_GET['idx'];

$data = getDispatchInfo($dispatch_idx);

$data['date'] = getDateFormat(TODAY);
$data['dateWeekDay'] = getWeekday(TODAY);
?>

<div id="header">
    <div class="text">
        <p><span class="green"><?=$data['date']?> (<?=$data['dateWeekDay']?>)</span></p>
        <h2><?=$data['real_company_name']?></h2>
    </div>
</div>

<div id="container">

    <div class="now">
        <h5>배송 정보</h5>
        <div class="list">
            <div class="txt">
                <p class="txt1"><?=$data['real_company_name']?></p>
                <p class="txt2">(<?=$data['customer_zip_code']?>)<?=$data['customer_addr']?> <?=$data['customer_addr_detail']?></p>
            </div>
        </div>
        <div class="list">
            <table class="" border="0" width="100%">
                <colgroup>
                    <col width="100px">
                    <col width="*">
                </colgroup>
                <thead>
                    <tr>
                        <th class="">인수 담당자</th>
                        <td class=""><?=$data['customer_mb_name']?>(<?=telNoHyphen($data['customer_mb_hp'])?>)
                            <a href="tel:<?=$data['customer_mb_hp']?>">
                                <span class="call"><i class="fa-solid fa-phone"></i></span>
                            </a>
                        </td>
                    </tr>
                </thead>
                <tbody>              
                    <tr>
                        <th class="">배송물품</th>
                        <td class=""><?=$data['product_name']?></td>
                    </tr>
                    <tr>
                        <th class="">배송 수량</th>
                        <td class=""><?=number_format($data['product_cnt'])?>개</td>
                    </tr>                    
                </tbody>
            </table>
        </div>
        <div class="list">
            <h6>긴급 상황 설정</h6>
            <select id="disStatus">
                <? foreach(DisStatusCode as $key => $val){ ?>
                <option value="<?=$val['code']?>" <?=$val['code'] == $data['dis_status_code']? 'selected' : ''?>><?=$val['name']?></option>
                <? } ?>
            </select>
            <span id="disStatusTextBox" class="<?=$data['dis_status_code'] == '0'? 'hide' : ''?>">
                <h6>긴급 사유</h6>
                <input type="text" id="disStatusText" placeholder="긴급 사유를 작성해주세요." maxlength="55" value="<?=$data['dis_status_text']?>">
            </span>
            <h6>배송 예정 시간</h6>
            <select id="deliveryTime">
                <option value="">배송 예정 시간을 선택하세요</option>

                <? foreach($deliveryTime as $key=>$val){ ?>
                <option value="<?=$val['fromTime']?>/<?=$val['toTime']?>" <?=($val['fromTime'] == $data['from_time'] && $val['toTime'] == $data['to_time'])? 'selected' : ''?>>
                    <?=$val['fromTime']?> ~ <?=$val['toTime']?>
                </option>
                <? } ?>
            </select>
        </div>
    </div>

</div>

<div class="fixed" style="position: unset;">
<!--    <p class="noti">배송 예정 시간 설정시 알림톡이 발송됩니다.</p>-->
    <button type="button" class="btn-submit" onclick="saveDeliveryStatus()">저장하기</button>
</div>


<script>
    const $dispatch_idx = '<?=$data['idx']?>';

    async function saveDeliveryStatus() {
        let $disStatus = $('#disStatus option:selected'),
            $deliveryTime = $('#deliveryTime option:selected');

        if (!$deliveryTime.val()) {
            swal('배송 예정 시간을 선택해주세요.');
            return false;
        }

        const saveSignPadRes = await postJson(getAjaxUrl('setting'), {
            mode: 'saveDeliveryStatus',
            dispatch_idx: $dispatch_idx,
            dis_status: $disStatus.val(),
            dis_status_text: $('#disStatusText').val(),
            delivery_time: $deliveryTime.val()
        });

        if (!saveSignPadRes.result) {
            swal(saveSignPadRes.msg);
            return false;
        }

        swal('저장되었습니다.')
            .then(() => {
                location.replace('./');
            });
    }

    $(function() {
        $('#disStatus').on('change', function() {
            let $el = $(this),
                $disStatusTextBox = $('#disStatusTextBox'),
                $disStatusText = $('#disStatusText');

            if ($el.val() == '0') {
                $disStatusTextBox.addClass('hide');
                $disStatusText.val('');
            } else {
                $disStatusTextBox.removeClass('hide');
                $disStatusText.focus();
            }
        });
    });
</script>

<?php
include_once ("./app_tail.php");
?>