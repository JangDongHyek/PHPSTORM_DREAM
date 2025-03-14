<?php
$pid = "done";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
$model = new JlModel(array("table" => "dispatch_list"));
$g5_member = new JlModel(array("table" => "g5_member"));

$new_data = $model->where("idx",$_GET['idx'])->get()['data'][0];

$customer = $g5_member->where('mb_id',$new_data['company_mb_id'])->get()['data'][0];
$client = $g5_member->where("shipment_id",$new_data['shipment_id'])->get()['data'][0];

////울산
//if($new_data['shipping_point'] == "1100") {
//    $client = array(
//        "mb_company_number" => "620-85-00816",
//        "mb_company_name" => "오제이씨 주식회사 울산공장",
//        "mb_addr" => "울산광역시 북구 책골길 59, 1층(연암동)",
//        "mb_name" => "송성근",
//    );
//}
////전주
//else if($new_data['shipping_point'] == "1200") {
//    $client = array(
//        "mb_company_number" => "402-85-07773",
//        "mb_company_name" => "오제이씨(주) 전주공장",
//        "mb_addr" => "전라북도 완주군 봉동읍 용암리 794",
//        "mb_name" => "이재열",
//    );
//}


$dispatch_idx = $_GET['idx'];
$data = getDispatchInfo($dispatch_idx);
?>
<meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=10, user-scalable=yes">
<style>
    body {
        background: #F5F5F5;
        height: 100vh;
    }
    #container{min-width: fit-content; width: 100%;}
</style>

<div id="header" class="ty2">
</div>

<div id="container">
<?/*
    <div class="recipt">

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
        <div class="list">
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
            <div class="img" style="background: url(<?=getSignPadUrl($dispatch_idx)?>) center center no-repeat;
   			 background-size: cover;    
   			 height: 200px;">
            </div>
        </div>

        <div class="list">
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
*/?>
<div class="recipt2">
            <h1>인수증</h1>

            <div class="sign">
                <h2>인수자 서명</h2>
                <div class="img">
                    <img src="<?=getSignPadUrl($dispatch_idx)?>">
                </div>
            </div>

            <!--<div class="flex ai-c jc-sb">-->
            <!--    <p>일련번호 : --><?//=$new_data['product_pk']?><!--</p>-->
            <!--    <p>용차공통 : ??</p>-->
            <!--</div>-->
            <div class="table">
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <th rowspan="3" class="vertical">공급자</th>
                    <th>등록번호</th>
                    <td colspan="3"><?=$client['mb_company_number']?></td>
                    <th rowspan="3" class="vertical">공급받는자</th>
                    <th>등록번호</th>
                    <td colspan="3"><?=$customer['mb_company_number']?></td>
                </tr>
                <tr>
                    <th>상호</th>
                    <td><?=$client['mb_company_name']?></td>
                    <th>성명</th>
                    <td><?=$client['mb_name']?></td>
                    <th>상호</th>
                    <td><?=$customer['mb_company_name']?></td>
                    <th>성명</th>
                    <td><?=$customer['mb_name']?></td>
                </tr>
                <tr>
                    <th>주소</th>
                    <td colspan="3"><?=$client['mb_addr']?> <?=$client['mb_addr_detail']?> <?=$client['mb_zip_code']?></td>
                    <th>주소</th>
                    <td colspan="3"><?=$customer['mb_addr']?> <?=$customer['mb_addr_detail']?> <?=$customer['mb_zip_code']?></td>
                </tr>
                </tbody>
            </table>
            </div>

            <h2>명세내역</h2>
            <div class="table">
            <table width="100%" border="1">
                <thead>
                <tr>
                    <th>년월일</th>
                    <th>품목</th>
                    <th>규격</th>
                    <th>수량</th>
                </tr>
                </thead>
                <tbody>
                <? foreach($new_data['product_full_string'] as $p) {?>
                <tr>
                    <td><?=$p['WADAT']?></td>
                    <td><?=$p['MAKTX']?></td>
                    <td>EA</td>
                    <td><?=$p['LFIMG']?></td>
                </tr>
                <?}?>
                </tbody>
            </table>
            </div>

            <button class="btn" onclick="printPage()">출력</button>

            <script>
                function printPage() {
                    window.print();
                }
            </script>
        </div>
</div>

<?
$user_ip = $_SERVER['REMOTE_ADDR'];
$allowed_ip = '121.140.204.65';
if ($user_ip == $allowed_ip) { ?>
    <button id="sendBtn">인수증 보내기</button>
<?}
?>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
    $(function(){
        Kakao.init('8896f5151c8f582627de4389e589ca8b');

        $('#sendBtn').click(function() {
            captureAndShare();
        });
    });

    function captureAndShare() {
        html2canvas(document.querySelector("#container")).then(canvas => {
            var dataURL = canvas.toDataURL('image/png');

            $.post("<?=G5_URL?>/ajax/save_capture.php",{"idx" : "<?=$dispatch_idx?>", "image": dataURL},function (data) {
                console.log(data);
                // 서버에서 이미지 URL을 받고 카카오링크 공유 실행
                shareKakaoLink(data.imageUrl);
            },"json");
        });
    }

    function shareKakaoLink(imageUrl) {

        const userAgent = navigator.userAgent.toLowerCase();
        const isAndroid = /android/.test(userAgent);
        const isiOS = /iphone|ipad|ipod/.test(userAgent);

        if (isAndroid) {
            Kakao.Link.sendDefault({
                objectType: 'feed',
                content: {
                    title: '인수증 확인부탁드립니다.',
                    imageUrl: imageUrl,
                    link: {
                        mobileWebUrl: imageUrl,
                        webUrl: imageUrl
                    }
                },
                buttons: [
                    {
                        title: '인수증 보기',
                        link: {
                            mobileWebUrl: imageUrl,
                            webUrl: imageUrl
                        }
                    }
                ]
            });
        } else {
            // iOS와 PC에서는 기본 웹 공유 API 사용
            if (navigator.share) {
                navigator.share({
                    title: '인수증 확인 부탁드립니다.',
                    url: imageUrl
                }).catch(console.error);
            } else {
                // navigator.share가 지원되지 않는 경우
                alert('공유 기능을 지원하지 않는 브라우저입니다.');
            }
        }

    }
</script>


<?php
include_once ("./app_tail.php");
?>