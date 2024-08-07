<?php
$pid = "pay";
include_once("./app_head.php");

$dispatch_idx = $_GET['idx'];

$data = getDispatchInfo($dispatch_idx);
?>

<div id="header">
</div>

<div id="container">

    <div class="now">

        <table class="date" border="0" width="100%">
            <colgroup>
                <col width="20px">
                <col width="*">
            </colgroup>
            <tr>
                <th class="">일자</th>
                <td class=""><?=getKrDate(TODAY)?></td>
            </tr>
        </table>

        <div class="table20">
            <table class="gray" border="0" width="100%">
                <colgroup>
                    <col width="70px">
                    <col width="*">
                </colgroup>
                <tr>
                    <th class="">상호</th>
                    <td class=""><?=$data['real_company_name']?></td>
                </tr>
            </table>
        </div>
        <div class="table20">
            <table class="gray" border="0" width="100%">
                <colgroup>
                    <col width="70px">
                    <col width="*">
                </colgroup>
                <tr>
                    <th class="">납품장소</th>
                    <td class=""><?=$data['customer_addr']?> <?=$data['customer_addr_detail']?></td>
                </tr>
                <tr>
                    <th class="">담당자</th>
                    <td class=""><?=$data['customer_mb_name']?></td>
                </tr>
                <tr>
                    <th class="">연락처</th>
                    <td class=""><?=telNoHyphen($data['customer_mb_hp'])?></td>
                </tr>             
                <tr>
                    <th class="">배송물품</th>
                    <td class=""><?=$data['product_name']?></td>
                </tr>
                <tr>
                    <th class="">배송 수량</th>
                    <td class=""><?=$data['product_cnt']?></td>
                </tr>
            </table>
        </div>
        <div class="">
            <h6 class="tit">인수자 서명</h6>
            <div class="row">
                <div class="col-md-12">
                    <canvas id="sig-canvas" height="160">
                        Get a better browser, bro.
                    </canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-default clear" id="sig-clearBtn" data-action="clear" onclick="clearSignPad()">전체 지우기</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="nofix">
    <button type="button" class="btn-submit save" data-action="save" onclick="saveSignPad()">배송 완료</button>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script>
    const $dispatch_idx = '<?=$dispatch_idx?>';
    const canvas = document.querySelector('canvas');
    const signaturePad = new SignaturePad(canvas, {
        minWidth: 2,
        maxWidth: 2,
        velocityFilterWeight: 0.7,
    });

    function clearSignPad() {
        signaturePad.clear();
    }

    async function saveSignPad() {

        if (signaturePad.isEmpty()) {
            swal('인수자 서명 후 진행해주세요.');
            return false;
        }

        const dataURL = signaturePad.toDataURL();
        const saveSignPadRes = await postJson(getAjaxUrl('setting'), {
            mode: 'saveSignPad',
            dispatch_idx: $dispatch_idx,
            dataUrl: dataURL
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

    function defaultSetup() {

    }

    $(function() {
        defaultSetup();
    });
</script>

<?php
include_once ("./app_tail.php");
?>