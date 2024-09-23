<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

    $tab = empty($_GET['tab'])? 'rent' : $_GET['tab'];

    /* RENT 이용내역 */
    $rentList = array();

    $sql = "        
        SELECT
            *,
            date(regDate) AS regDate
        FROM
            rental_list
        WHERE
            mb_id = '{$member['mb_id']}' AND
            isUse = 'Y'
        ORDER BY
            rental_idx DESC
    ";

    $rentRes = sql_query($sql);
        
    for($i = 0; $info = sql_fetch_array($rentRes); $i++){
        $info['floor'] = $info['floor'].'F '.RENT_FLOOR[$info['floor']];
        $info['statusText'] = STATUS[$info['status']];
        $info['rentDate'] = replaceHyphenWithDot($info['rentDate']);
        $info['regDate'] = replaceHyphenWithDot(substr($info['regDate'], 2, 10));
        
        switch($info['status']){
            case 'W': $info['statusCode'] = '1'; break; /* 신청 */
            case 'C': $info['statusCode'] = '2'; break; /* 취소 */
            case 'F': $info['statusCode'] = '3'; break; /* 예약확정 */
        }
        
        $rentList[] = $info;
    }

    /* CLASS 이용내역 */

    $classList = array();

    $sql = "
        SELECT
            C.*,    
            CA.class_app_idx,
            CA.status,
            CA.payType,
            CA.person,
            date(CA.regDate) AS regDate           
        FROM 
            class_app_list AS CA JOIN
            class_list AS C ON C.class_idx = CA.class_idx AND C.isUse = 'Y'            
        WHERE 
            CA.mb_id = '{$member['mb_id']}' AND
            CA.isUse = 'Y'   
        ORDER BY
            CA.class_app_idx DESC
    ";

    $classRes = sql_query($sql);

    //echo "쿼리 확인 >>> ".$sql;
        
    for($i = 0; $info = sql_fetch_array($classRes); $i++){
        $info['payInfo'] = getPayInfo($info['class_app_idx']);        
        $info['floor'] = $info['floor'].'F '.CLASS_FLOOR[$info['floor']]; 
        $info['person'] = $info['person'].'명';
        $info['statusText'] = CLASS_APP_STATUS[$info['status']];
        $info['eventDate'] = replaceHyphenWithDot($info['eventDateTime']);
        $info['regDate'] = replaceHyphenWithDot(substr($info['regDate'], 2, 10));
        
        switch($info['status']){
            case 'DEPOSIT_WAIT': 
            case 'WAIT':
                $info['statusCode'] = '1';
            break; /* 신청 */
            case 'CANCEL': $info['statusCode'] = '2'; break; /* 취소 */
            case 'CONFIRMED': $info['statusCode'] = '3'; break; /* 예약확정 */
        }
        
		
		$info['content'] = '';		
		$info['classContent'] = '';
		$info['thumbnailImgJson'] = '';
		
        $classList[] = $info;
    }


    /* 찜한 리스트 */

    $heartList = array();

    $sql = "
        SELECT
            C.*,
            'active' AS clsActive,
            'fas' AS clsHeart
        FROM
            heart_list AS H JOIN
            class_list AS C ON H.class_idx = C.class_idx AND C.isUse = 'Y'
        WHERE
            H.mb_id = '{$member['mb_id']}' AND 
            H.isUse = 'Y'
        ORDER BY
            heart_idx DESC;        
    ";
    
    $heartRes = sql_query($sql);
        
    for($i = 0; $info = sql_fetch_array($heartRes); $i++){        
        $row = sortClassInfo($info);
        $heartList[] = $row;
    }    
?>

<style>
    .tab-content {
        display: none;
    }

    .tab-content.current {
        display: inherit;
    }
</style>

<section id="event" class="my">

    <ul class="tabs">
        <li class="tab-link <?=$tab == 'rent'? 'current': ''?>" data-tab="tab-1" onclick="saveTab('rent')">이용 내역(RENT)</li>
        <li class="tab-link <?=$tab == 'class'? 'current': ''?>" data-tab="tab-2" onclick="saveTab('class')">이용 내역(CLASS)</li>
        <li class="tab-link <?=$tab == 'heart'? 'current': ''?>" data-tab="tab-3" onclick="saveTab('heart')">찜한 클래스</li>
    </ul>

    <div id="tab-1" class="tab-content <?=$tab == 'rent'? 'current': ''?>">
        <div class="tbl_head01 tbl_wrap">
            <table>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>구분</th>
                        <th class="visible-xs">관리</th>
                        <th>타입</th>
                        <th>예약일시</th>
                        <th>예약인원</th>
                        <th>신청일</th>
                        <th>상태</th>
                        <th class="hidden-xs">관리</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($rentList as $key=>$data){ 						
					?>
                    <tr>                        
                        <td class="td_num"><?=sprintf('%02d', ((int)$key + 1))?></td>
                        <td class="td_center">RENT</td>
                        <td class="td_center visible-xs">
                            <a class="btn_b01" onclick='openReserveModal("rent", <?=json_encode($data)?>)'>확인</a>
                        </td>
                        <td class="td_center"><?=$data['floor']?></td>
                        <td class="td_center"><?=$data['rentDate']?> <?=$data['rentTime']?>시간</td>
                        <td class="td_center"><?=$data['person']?></td>
                        <td class="td_date"><?=$data['regDate']?></td>
                        <td class="td_center state<?=$data['statusCode']?>"><strong><?=$data['statusText']?></strong></td>
                        <td class="td_center hidden-xs">
                            <a class="btn_b01" onclick='openReserveModal("rent", <?=json_encode($data)?>)'>확인</a>
                        </td>
                    </tr>
                    <? } ?>
                    <!--
                    <tr>
                        <td class="td_num">02</td>
                        <td class="td_center">RENT</td>
                        <td class="td_center">6F DOWOON SPACE</td>
                        <td class="td_center">2023.07.30 3시간</td>
                        <td class="td_center">30명</td>
                        <td class="td_date">23.07.17</td>
                        <td class="td_center state2"><strong>취소</strong></td>
                        <td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
                    </tr>
                    <tr>
                        <td class="td_num">03</td>
                        <td class="td_center">CLASS</td>
                        <td class="td_center">6F DOWOON SPACE - MASTER CLASS</td>
                        <td class="td_center">2023.07.30 오전(9:00~12:00)</td>
                        <td class="td_center">1명</td>
                        <td class="td_date">23.07.17</td>
                        <td class="td_center state3"><strong>확약</strong></td>
                        <td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
                    </tr>
-->
                </tbody>
            </table>
        </div>
    </div>

    <div id="tab-2" class="tab-content <?=$tab == 'class'? 'current': ''?>">
        <div class="tbl_head01 tbl_wrap">
            <table>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>구분</th>
                        <th class="visible-xs">관리</th>
                        <th>타입</th>
                        <th>결제</th>
                        <th>예약일시</th>
                        <th>예약인원</th>
                        <th>신청일</th>
                        <th>상태</th>
                        <th class="hidden-xs">관리</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($classList as $key=>$data){ 						
					?>
                    <tr>
                        <td class="td_num"><?=sprintf('%02d', ((int)$key + 1))?></td>
                        <td class="td_center">CLASS</td>
                        <td class="td_center visible-xs">
                            <? $data['className'] = ''; ?>
                            <a class="btn_b01" onclick='openReserveModal("class", <?=json_encode($data)?>)'>확인</a>
                        </td>
                        <td class="td_center">
                            <?=$data['floor']?><br>
                            - <a href="./event.view.php?idx=<?=$data['class_idx']?>"><?=$data['className']?></a></td>
                        <td><?=PAY_TYPE[$data['payType']]?></td>
                        <td class="td_center"><?=$data['eventDate']?></td>
                        <td class="td_center"><?=$data['person']?></td>
                        <td class="td_date"><?=$data['regDate']?></td>
                        <td class="td_center state<?=$data['statusCode']?>"><strong><?=$data['statusText']?></strong></td>
                        <td class="td_center hidden-xs">
                           	<? $data['className'] = ''; ?>
                            <a class="btn_b01" onclick='openReserveModal("class", <?=json_encode($data)?>)'>확인</a>
                        </td>
                    </tr>
                    <? } ?>
                    <!--
                    <tr>
                        <td class="td_num">02</td>
                        <td class="td_center">RENT</td>
                        <td class="td_center">6F DOWOON SPACE</td>
                        <td class="td_center">2023.07.30 3시간</td>
                        <td class="td_center">30명</td>
                        <td class="td_date">23.07.17</td>
                        <td class="td_center state2"><strong>취소</strong></td>
                        <td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
                    </tr>
                    <tr>
                        <td class="td_num">03</td>
                        <td class="td_center">CLASS</td>
                        <td class="td_center">6F DOWOON SPACE - MASTER CLASS</td>
                        <td class="td_center">2023.07.30 오전(9:00~12:00)</td>
                        <td class="td_center">1명</td>
                        <td class="td_date">23.07.17</td>
                        <td class="td_center state3"><strong>확약</strong></td>
                        <td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
                    </tr>
-->
                </tbody>
            </table>
        </div>
    </div>
    <div id="tab-3" class="tab-content <?=$tab == 'heart'? 'current': ''?>">
        <div id="class">
            <div class="classBox">
                <? foreach($heartList as $key => $data){ ?>
                <div class="classItem <?=$data['clsClassStatus']?>">
                    <a href="./event.view.php?idx=<?=$data['class_idx']?>" class="nextLink" data-status="<?=$data['classStatus']?>">
                        <div class="img">
                            <img src="<?=$data['thumbnail']?>">
                        </div>
                        <div class="txt">
                            <h2><span><?=$data['classStatus']?></span><?=$data['className']?></h2>
                            <h3><i class="fas fa-calendar-star"></i> <?=replaceHyphenWithDot($data['eventDate'])?>일 <?=$data['eventTime1']?> ~ <?=$data['eventTime2']?><span class="hidden-xs"> | </span><span class="visible-xs"><br></span><i class="fas fa-user-friends"></i> 정원 <?=$data['maxPerson']?>명</h3>
                            <h4><strong><?=number_format($data['price'])?></strong> 원</h4>
                        </div>
                    </a>
                </div>
                <? } ?>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="reserve" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">예약 정보</h5>
            </div>
            <div class="modal-body">
                <table class="eo_table">
                    <tbody>
                        <tr>
                            <th><strong>신청타입</strong></th>
                            <td id="sendLocation">[RENT] 1F Dowoon Lounge</td>
                        </tr>
                        <tr>
                            <th><strong>신청일</strong></th>
                            <td id="sendDate">23.07.17</td>
                        </tr>
                        <tr>
                            <th><strong>예약일시</strong></th>
                            <td><strong id="sendTime">2023.07.30 3시간</strong></td>
                        </tr>
                        <tr>
                            <th><strong>예약인원</strong></th>
                            <td><strong id="sendPerson">30명</strong></td>
                        </tr>
                        <tr>
                            <th><strong>상태</strong></th>
                            <td><strong id="sendStatus">신청</strong></td>
                        </tr>
                        <!--tr>// CLASS 
				<th><strong>결제금액</strong></th>
				<td><strong>150,000원</strong></td>
			  </tr>
			  <tr>
				<th><strong>결제수단</strong></th>
				<td><strong>삼성카드(4916)</strong></td>
			  </tr-->
                    </tbody>

                </table>
                <div class="notice">
                    <p id="noticeText">※ 예약 변경은 취소 후 재신청 바랍니다.</p>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idx" value="" />
                <input type="hidden" id="class_app_idx" value="" />                
                <input type="hidden" id="type" value="" />                
                <button id="retund" type="button" class="btn btn-secondary" onclick="oepnRefundModal()">예약취소 및 환불요청</button>
                <button id="cancelReserve" type="button" class="btn btn-secondary" onclick="cancelReserve()">예약 취소</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refund" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refundModalLabel">환불정보</h5>
            </div>
            <div class="modal-body">
                <table class="eo_table">
                    <tbody>
                        <tr>
                            <th><strong>취소사유 - 간략</strong></th>
                            <td><input type="text" placeholder="취소사유 - 간략" id="cancelMsg" /></td>
                        </tr>
                        <tr>
                            <th><strong>은행</strong></th>
                            <td>
                                <select id="refundBankCd">
                                    <option value="">은행을 선택해주세요.</option>
                                    <? foreach(INNOPAY_BANK as $key => $data){ ?>
                                    <option value="<?=$key?>"><?=$data?></option>
                                    <? } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><strong>계좌번호</strong></th>
                            <td><input type="text" placeholder="계좌번호" id="refundAcctNo" /></td>
                        </tr>
                        <tr>
                            <th><strong>예금주</strong></th>
                            <td><input type="text" placeholder="예금주" id="refundAcctNm" /></td>
                        </tr>
                    </tbody>

                </table>
                <div class="notice">
                    <p>※ 가상계좌에 입금하신 계좌와 동일한 계좌, 예금주로 작성해야합니다.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="chkrefundForm()">예약취소 및 환불요청</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<script>
	var tab = '<?=$tab?>';	
    const INNOPAY_BANK = <?=json_encode(INNOPAY_BANK)?>;

	function saveTab(tabType){
		tab = tabType;		
	}
	
	/* 현재 날짜 */
	function getCurrentFormattedTime() {
	  let currentDate = new Date(),
	   	  year = String(currentDate.getFullYear()),
	   	  month = String(currentDate.getMonth() + 1).padStart(2, '0'),
	   	  day = String(currentDate.getDate()).padStart(2, '0');
		
	  return `${year}.${month}.${day}`;
	}
	
	/* 특정날짜 7일 빼기 */
	function subtractDaysFromDate(inputDateStr, daysToSubtract) {	  
	  const inputDate = new Date(inputDateStr);

	  // daysToSubtract만큼 일을 뺍니다.
	  inputDate.setDate(inputDate.getDate() - daysToSubtract);

	  // 결과를 "yyyy.mm.dd" 형식으로 포맷팅합니다.
	  const year = inputDate.getFullYear();
	  const month = String(inputDate.getMonth() + 1).padStart(2, "0");
	  const day = String(inputDate.getDate()).padStart(2, "0");

	  return `${year}.${month}.${day}`;
	}
	
    function openReserveModal(type, data) {

        let isEnd = true,
			sendStatus = data.statusText;
		
        $('#idx').val(type == 'rent' ? data.rental_idx : data.class_idx);
        $('#class_app_idx').val(type == 'class' ? data.class_app_idx : 0);        
        $('#type').val(type);
        $('#sendLocation').text(`[${type.toUpperCase()}] ${data.floor}`);
        $('#sendDate').text(data.regDate);
        $('#sendTime').text(type == 'rent' ? (`${data.rentDate} ${data.rentTime}시간`) : (`${data.eventDate} ~ ${data.eventTime2}`));
        $('#sendPerson').text(data.person);
		
		
        if (type == 'rent') {
			/* 예약 취소 일주일 전 일경우 취소 안 되게 */
			isEnd = subtractDaysFromDate(data.rentDate, 7) < getCurrentFormattedTime(); 
			
            $('#retund').addClass('hide');

            if (!isEnd && data.status == 'W') {
                $('#cancelReserve').removeClass('hide');
            } else {
                $('#cancelReserve').addClass('hide');
            }
        } else {
			/* 예약 취소 일주일 전 일경우 취소 안 되게 */
			isEnd = subtractDaysFromDate(data.eventDate.slice(0, 10), 7) < getCurrentFormattedTime(); 
			
            /* 가상계좌일 경우 */
            if (data.payType == 'VBANK') {
                
                switch(data.status){
                    case 'DEPOSIT_WAIT':
                        sendStatus += `                    
                            <p>----------------계좌정보----------------</p>
                            <p>입금은행 : ${data.payInfo.VbankName}</p>
                            <p>입금계좌 : ${data.payInfo.VbankNum}</p>
                            <p>입금자명 : ${data.payInfo.VBankAccountName}</p>
                            <p>입금금액 : ${comma(data.payInfo.Amt)}원</p>
                        `;
                    break;
                    case 'REFUND':
                        sendStatus += `
                            <p>----------------환불정보----------------</p>
                            <p>환불은행 : ${INNOPAY_BANK[data.payInfo.refundBankCd]}</p>
                            <p>환불계좌 : ${data.payInfo.refundAcctNo}</p>
                            <p>예금주명 : ${data.payInfo.refundAcctNm}</p>
                            <p>환불금액 : ${comma(data.payInfo.Amt)}원</p>
                        `;
                    break;
                }
                
                if(data.status == 'DEPOSIT_WAIT'){
                    $('#cancelReserve').removeClass('hide');
                    $('#retund').addClass('hide');
                }else{										
                    if(!isEnd && (data.status == 'REFUND' || data.status == 'REFUND_END' || data.status == 'CANCEL')){
                        $('#retund').addClass('hide');
                    }else{
                        $('#retund').removeClass('hide');
                    }

                    $('#cancelReserve').addClass('hide');   
                }                
            }else{
				
				/* 예약 취소일 일주일 전 일경우 취소 안 되게 */							
                if (!isEnd && (data.status == 'WAIT' || data.status == 'CONFIRMED')) {
                    $('#cancelReserve').removeClass('hide');
                } else {
                    $('#cancelReserve').addClass('hide');
                }
                $('#retund').addClass('hide');
            }                                        
        }

		if(isEnd){
			$('#noticeText').text('※ 예약 취소/환불 예약일 기준 7일 전까지만 가능합니다.');
		}else{
			$('#noticeText').text('※ 예약 변경은 취소 후 재신청 바랍니다.');
		}		
        $('#sendStatus').html(sendStatus);
        $('#reserve').modal('show');
    }

    function oepnRefundModal() {
        $('#cancelMsg').val('');
        $('#refundBankCd').val('').attr("selected", "selected");
        $('#refundAcctNo').val('');
        $('#refundAcctNm').val('');
        $('#refund').modal('show');
    }

    async function cancelReserve() {

        showConfirm(`예약취소 처리하시겠습니까?`)
            .then(async (result) => {

                if (!result.value) return;

                let idx = $('#idx').val(),
                    type = $('#type').val(),
                    data = {
                        mode: 'changeStatus',
                        mb_id: '<?=$member['mb_id']?>'
                    };

                if (type == 'rent') {
                    data.rental_idx = idx;
                    data.status = 'C';
                } else {
                    data.class_idx = idx;
                    data.class_app_idx = $('#class_app_idx').val();
                    data.status = 'CANCEL';
                    data.cancelMsg = $('#cancelMsg').val();
                    data.refundBankCd = $('#refundBankCd option:selected').val();
                    data.refundAcctNo = $('#refundAcctNo').val();
                    data.refundAcctNm = $('#refundAcctNm').val();
                }
            
                const changeStatusRes = await postJson(getAjaxUrl(type), data);
                //console.log(changeStatusRes);

                if (!changeStatusRes.result) {
                    showAlert(changeStatusRes.msg);
                    return;
                }

                showAlert('처리되었습니다.')
                .then(() => {
                    location.replace(`${g5_url}/mypage.php?tab=${tab}`);
                });
            });
    }

    function chkrefundForm() {
        let $cancelMsg = $('#cancelMsg'),
            $refundBankCd = $('#refundBankCd option:selected'),
            $refundAcctNo = $('#refundAcctNo'),
            $refundAcctNm = $('#refundAcctNm');

        if (!$cancelMsg.val()) {
            showAlert("취소사유를 입력해주세요.", $cancelMsg.focus());
            return;
        } else if (!$refundBankCd.val()) {
            showAlert("은행을 선택해주세요.", $refundBankCd.focus());
            return;
        } else if (!$refundAcctNo.val()) {
            showAlert("계좌번호를 입력해주세요.", $refundAcctNo.focus());
            return;
        } else if (!$refundAcctNm.val()) {
            showAlert("예금주를 입력해주세요.", $refundAcctNm.focus());
            return;
        }

        cancelReserve();
    }

    $(document).ready(function() {

        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

    })



</script>

<?php
include_once(G5_PATH.'/tail.php');
?>