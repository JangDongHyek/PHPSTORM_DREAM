<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

include_once('./admin.head.php');
$class_idx = $_GET['class_idx'];

$classInfo = getClassInfo($class_idx);

$sql = "
    SELECT 
        *
    FROM
        class_app_list
    WHERE
        class_idx = '{$class_idx}' and `isUse` = 'Y'
    ORDER BY
        class_app_idx DESC;
";

$list = array();

$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {        
    
    $row['sendMember'] = get_member($row['mb_id']);    
    $row['payInfo'] = getPayInfo($row['class_app_idx']);
    $row['member'] = getClassAppMemberList($row['class_app_idx']);
    
    $list[] = $row;
}


$DEPOSIT_WAIT = 0; /* 입금대기 */
$WAIT = 0; /* 대기 */
$CONFIRMED = 0; /* 예약확정 */
$REFUND = 0; /* 환불요청 */
$REFUND_END = 0; /* 환불완료 */
$CANCEL = 0; /* 취소 */

foreach($list as $key => $data){
    switch($data['status']){
        /*case 'DEPOSIT_WAIT':  $DEPOSIT_WAIT++; break;
        case 'WAIT': $WAIT++;  break;
        case 'CONFIRMED': $CONFIRMED++;  break;
        case 'REFUND':  $REFUND++; break;
        case 'REFUND_END' : $REFUND_END++; break;
        case 'CANCEL':  $CANCEL++; break;*/

        case 'DEPOSIT_WAIT':  $DEPOSIT_WAIT+=$data['person']; break;
        case 'WAIT': $WAIT+=$data['person'];  break;
        case 'CONFIRMED': $CONFIRMED+=$data['person'];  break;
        case 'REFUND':  $REFUND+=$data['person']; break;
        case 'REFUND_END' : $REFUND_END+=$data['person']; break;
        case 'CANCEL':  $CANCEL+=$data['person']; break;
    }    
}

$totalRegiMenCnt = $DEPOSIT_WAIT + $WAIT + $CONFIRMED + $REFUND + $REFUND_END + $CANCEL;

/* 대기 */

/* 무통장입금 */
?>

<style>

    .title {
        font-weight: bold;
        text-align: center;
        font-size: 18px;
    }

    .sub_title {
        font-weight: bold;
        font-size: 14px;
    }

    .DEPOSIT_WAIT {
        color: #a2a22a;
    }

    .WAIT {
        color: dimgray;
    }

    .CONFIRMED {
        color: #6fd9d9;
    }

    .REFUND {
        color: forestgreen;
    }
    
    .REFUND_END{
         color : brown;   
    }

    .CANCEL {
        color: red;
    }

    .status {
        margin-bottom: 15px;
    }

    .status span {
        padding-right: 15px;
        font-weight: bold;
        font-size: 14px;
    }
    .btn_submit {width: 250px;}
    .tbl_head02 tbody td{ padding: 20px; }
</style>


<div class="tbl_head02 tbl_wrap">
    <p class="title"><?=$classInfo['className']?>(최대인원 : <?=$classInfo['maxPerson']?>명)</p>
    <p class="title">신청내역리스트</p>
    <!--<p class="sub_title">신청 <?=count($list)?>팀 중</p>-->
    <p class="sub_title">신청 <?=$totalRegiMenCnt?>명 중</p>
    <div class="status">
        <span class="DEPOSIT_WAIT">입금대기 - <?=$DEPOSIT_WAIT?>명</span>
        <span class="WAIT">대기 - <?=$WAIT?>명</span>
        <span class="CONFIRMED">예약확정 - <?=$CONFIRMED?>명</span>
        <span class="REFUND">환불요청 - <?=$REFUND?>명</span>
        <span class="REFUND_END">환불완료 - <?=$REFUND_END?>명</span>
        <span class="CANCEL">취소 - <?=$CANCEL?>명</span>
    </div>

    <a href="./v5_class_excel_down.php?class_idx=<?php echo $class_idx; ?>" class="btn_submit" style="width: 100px; height: 30px;" download>엑셀다운로드</a>

    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>신청자</th>
                <th>상태</th>
                <th>인원</th>
                <th>금액</th>
                <th>관리</th>
                <th>결제타입</th>
                <th>신청일</th>
                <th>이름</th>
                <th>생년월일</th>
                <th>휴대번호</th>
                <th>이메일</th>
            </tr>
        </thead>
        <tbody>
            <? foreach($list as $key => $data){ 
                $class_app_idx = $data['class_app_idx'];
                $mb_id = $data['sendMember']['mb_id'];
                $rowspan = count($data['member']);
            ?>
            <tr>
                <td rowspan="<?=$rowspan?>">No.<?=count($list) - $key?></td>
                <td rowspan="<?=$rowspan?>">
                    <p>신청자 아이디 : <?=$data['sendMember']['mb_id']?></p>
                    <p>신청자 휴대번호 : <?=$data['sendMember']['mb_hp']?></p>
                    <p>신청자 이름 : <?=$data['sendMember']['mb_name']?></p>
                    <p>신청자 이메일 : <?=$data['sendMember']['mb_email']?></p>
                    <p>신청자 생년월일 : <?=$data['sendMember']['mb_1']?></p>
                </td>
                <td class="<?=$data['status']?>" rowspan="<?=$rowspan?>"><?=CLASS_APP_STATUS[$data['status']]?></td>
                <td rowspan="<?=$rowspan?>"><?=$data['person']?>명</td>
                <td rowspan="<?=$rowspan?>"><?=number_format($data['payInfo']['Amt'])?>원</td>
                <td rowspan="<?=$rowspan?>">
                    <!-- 관리 상태병 버튼 노출 !-->

                    <? if($data['status'] == 'DEPOSIT_WAIT'){ ?>
                        <p>- 가상계좌 정보 -</p>
                        <p>입금만료기간 : <?=$data['payInfo']['VbankExpDate']?></p>
                        <p>은행 : <?=$data['payInfo']['VbankName']?></p>
                        <p>계좌번호 : <?=$data['payInfo']['VbankNum']?></p>
                        <p>예금주명 : <?=$data['payInfo']['VBankAccountName']?></p>
                        <p><button onclick="changeStatus('<?=$mb_id?>', '<?=$class_app_idx?>', 'WAIT','<?=$data['payInfo']['fn_cd']?>','<?=$data['payInfo']['VbankNum']?>','<?=$data['payInfo']['VBankAccountName']?>')" class="btn_submit">입금확인</button></p>
                    <? } ?>

                    <? if($data['status'] == 'WAIT'){ ?>
                       <? if($data['payType'] == 'VBANK'){ ?>
                           <p><button onclick="changeStatus('<?=$mb_id?>', '<?=$class_app_idx?>', 'DEPOSIT_WAIT','<?=$data['payInfo']['fn_cd']?>','<?=$data['payInfo']['VbankNum']?>','<?=$data['payInfo']['VBankAccountName']?>')" class="btn_submit">입금취소</button></p>
                       <? } ?>                        
                        <p><button onclick="changeStatus('<?=$mb_id?>', '<?=$class_app_idx?>', 'CONFIRMED')" class="btn_submit">예약확정</button></p>
                    <? } ?>                    

                    <? if($data['status'] == 'REFUND' || $data['status'] == 'REFUND_END'){ ?>
                    <p>환불은행 : <?=INNOPAY_BANK[$data['payInfo']['refundBankCd']]?></p>
                    <p>환불계좌 : <?=$data['payInfo']['refundAcctNo']?></p>
                    <p>예금주명 : <?=$data['payInfo']['refundAcctNm']?></p>
                    <p>환불금액 : <?=number_format($data['payInfo']['Amt'])?>원</p>                                                                        
                       <? if($data['status'] != 'REFUND_END'){ ?>
                       <p><button onclick="changeStatus('<?=$mb_id?>', '<?=$class_app_idx?>', 'REFUND_END','<?=$data['payInfo']['fn_cd']?>','<?=$data['payInfo']['VbankNum']?>','<?=$data['payInfo']['VBankAccountName']?>')" class="btn_submit">환불처리</button></p>
                       <? } ?>
                    <? } ?>
                    
                    <? if($data['status'] == 'CONFIRMED'){ ?>
                        <p><button onclick="changeStatus('<?=$mb_id?>', '<?=$class_app_idx?>', 'WAIT')" class="btn_submit">대기처리</button></p>
                    <? } ?>
                    
                    <? if($data['status'] != 'CANCEL' && $data['status'] != 'REFUND_END'){ ?>
                        <p><button onclick="changeStatus('<?=$mb_id?>', '<?=$class_app_idx?>', 'CANCEL','<?=$data['payInfo']['fn_cd']?>','<?=$data['payInfo']['VbankNum']?>','<?=$data['payInfo']['VBankAccountName']?>')" class="btn_submit">예약취소</button></p>
                    <? } ?>
                </td>
                <td rowspan="<?=$rowspan?>"><?=PAY_TYPE[$data['payInfo']['payMethod']]?></td>
                <td rowspan="<?=$rowspan?>"><?=substr($data['regDate'], 2, 14)?></td>
                <td><?=$data['member'][0]['name']?></td>
                <td><?=$data['member'][0]['birth']?></td>
                <td><?=$data['member'][0]['hp']?></td>
                <td><?=$data['member'][0]['email']?></td>
            </tr>
            <? foreach($data['member'] as $mbKey => $mbData){ 
                if($mbKey == 0) continue;
            ?>
            <tr>
                <td><?=$mbData['name']?></td>
                <td><?=$mbData['birth']?></td>
                <td><?=$mbData['hp']?></td>
                <td><?=$mbData['email']?></td>
            </tr>
            <? } ?>
            <? } ?>
        </tbody>
    </table>
</div>

<script>
    
    const $class_idx = <?=$class_idx?>;
    
    async function changeStatus(mb_id, class_app_idx, status, bankCd='',acctNo='',acctNm='') {
        let confirmMsg = "";
        
        switch(status){
            case 'DEPOSIT_WAIT' : confirmMsg = "입금대기 상태로 변경하시겠습니까?"; break;
            case 'WAIT' : confirmMsg = "대기 상태로 변경하시겠습니까?"; break;
            case 'CONFIRMED' : confirmMsg = "예약확정 상태로 변경하시겠습니까?"; break;
            case 'REFUND' : confirmMsg = "환불요청 상태로 변경하시겠습니까?"; break;
            case 'REFUND_END' : confirmMsg = "환불완료 상태로 변경하시겠습니까?"; break;
            case 'CANCEL' : confirmMsg = "예약취소 처리하시겠습니까?<br/><br/> 한 번 취소한 예약은 복구가 불가능합니다."; break;
        }
        
        showConfirm(confirmMsg)
        .then(async (result) => {
            
            if (!result.value) return;
            
            const changeStatusRes = await postJson(getAjaxUrl('class'), {
                mode: 'changeStatus',
                mb_id: mb_id,
                class_app_idx: class_app_idx,
                class_idx: $class_idx,
                status: status/*,
                "bankCd":bankCd,
                "acctNo":acctNo,
                "acctNm":acctNm*/
            });

            if (!changeStatusRes.result) {
                showAlert(changeStatusRes.msg);
                return;
            }

            showAlert('처리되었습니다.')
            .then(() => {
                location.reload();
            }); 
        });
    }
    
    $(function(){
        
    });
</script>

<?php
include_once ('./admin.tail.php');
?>