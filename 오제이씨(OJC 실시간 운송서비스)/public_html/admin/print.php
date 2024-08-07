<?php
$pid = "admin";
include_once("../app/app_head.php");

$dispatch_idx = $_GET['idx'];

$data = getDispatchInfo($dispatch_idx);
?>
<style>
    #sDataUrl {
        max-width: 500px !important;
        margin: 0 auto !important;
        height: 200px !important;
        margin: auto;
        display: block;
    }
</style>
<div id="signpadModal">
    <div>
        <div class="modal-content">
            <div id="signpadModalBody" class="modal-body">
                <div>
                    <table class="date" border="0" width="100%">
                        <colgroup>
                            <col width="20px">
                            <col width="*">
                        </colgroup>
                        <tr>
                            <th class="">일자</th>
                            <td class=""><?=getKrDate($data['complete_date'])?></td>
                        </tr>
                    </table>

                    <div class="list" style="min-height: 0px">
                        <table class="" border="0" width="100%">
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
                    <div class="admin list">
                        <table class="" border="0" width="100%">
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
                            
                            <? foreach($data['product_full_string'] as $key => $val){ ?>
                            <tr>
                                <th class=""><?=$key == 0? "배송물품" : ""; ?></th>
                                <td class=""><?=$val['MAKTX']?> <?=(int)$val['LFIMG']?>개</td>
                            </tr>                            
                            <? } ?>
                        </table>
                    </div>
                    <div class="">
                        <h6 class="tit">인수자 서명</h6>
                        <img id="sDataUrl" src="<?=getSignPadUrl($dispatch_idx)?>" />
                    </div>

                    <div class="admin list">
                        <table class="" border="0" width="100%">
                            <colgroup>
                                <col width="100px">
                                <col width="*">
                            </colgroup>
                            <tr>
                                <th class="">배송 담당자</th>
                                <td class=""><?=$data['real_delivery_name']?>(<?=telNoHyphen($data['delivery_mb_hp'])?>)</td>
                            </tr>
                            <tr>
                                <th class="">배송 완료일시</th>
                                <td class=""><?=getDateFormat2($data['complete_date'])?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    var initBodyHtml = '';

    function defaultSetup() {
        window.onbeforeprint = beforePrintSetup;
        window.onafterprint = afterPrintSetup;
        printPage();
    }

    function printPage() {
        window.print();
    }

    function beforePrintSetup() {
        initBodyHtml = document.body.innerHTML;

        console.log(initBodyHtml);
        document.body.innerHTML = document.getElementById('html').innerHTML;
    }

    function afterPrintSetup() {
        document.body.innerHTML = initBodyHtml;
        window.close();
    }

    defaultSetup();
</script>


<?php
include_once ("../app/tail.sub.php");
?>