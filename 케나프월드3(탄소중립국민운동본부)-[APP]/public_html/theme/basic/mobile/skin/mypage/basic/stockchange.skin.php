<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/common.lib.php');

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$bank_arr = array("국민은행", "KEB 하나은행", "NH 농협은행", "우리은행", "신한은행", "기업은행", "한국 SC은행");

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);

$stocks = getStocksByMemberAndStatus($member['mb_id'], '');
$totalHoldingCount = 0;
foreach ($stocks as $stock) {
    $totalHoldingCount += $stock['holding_count']; // 각 포인트의 보유량을 더함
}

?>
<div class="change_info">
<!--
※ 시장공급가액이 1주당 10,000원 이상일때 본인의 포인트계좌로 받을 수 있습니다.
<p>※ 포인트 지급시  소정의  세금이  부가됩니다</p>
-->
※ 보유한 포인트는 쇼핑몰에서 현금처럼 사용이 가능합니다.
</div>
<div class="wal-cotainer" id="wal_cotainer">
	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dt class="wc-price">
					포인트 정보
				</dt>
				<dd id="wc_account" class="wc-account">
					<div>
						<span>
							<?php if($member['mb_account']){ ?>
							[<?php echo $member['mb_bank'];?>] <?php echo $member['mb_aname']; ?> <?php echo $member['mb_account'];?>
							<?php }else{ ?>
							계좌를 입력해주세요.
							<?php } ?>
						</span>
						<input type="button" id="acc_btn" value="계좌정보" class="btn btn-default btn-xs" onclick="setAcc(this)">
					</div>
					<div id="acc_frm" style="display:none;">
						<dl>
							<dd class="row">
								<p class="col-xs-6">
									<select id="acc_sel" class="frm-input" style="padding:0 5px; font-size:11pt; width:100%;" onchange="document.getElementById('mb_bank').value=this.value;">
										<option value="">직접입력</option>
										<?php for($i=0; $i<count($bank_arr); $i++){ ?>
										<option value="<?php echo $bank_arr[$i];?>" <?php if($bank_arr[$i] == $member['mb_bank']) echo "selected";?>><?php echo $bank_arr[$i];?></option>
										<?php } ?>
									</select>
								</p>
								<p class="col-xs-6">
									<input type="text" name="mb_bank" id="mb_bank" value="<?php echo $member['mb_bank'];?>" class="frm-input" style="padding:0 5px; font-size:11pt; width:100%;" placeholder="은행명">
								</p>
							</dd>
							<dd>
								<input type="text" name="mb_aname" id="mb_aname" value="<?php echo $member['mb_aname'];?>" class="frm-input" style="padding:0 5px; font-size:11pt; width:100%;" placeholder="계좌주">
							</dd>
							<dd>
								<input type="text" name="mb_account" id="mb_account" value="<?php echo $member['mb_account'];?>" class="frm-input" style="padding:0 5px; font-size:11pt; width:100%;" placeholder="계좌번호">
							</dd>
							<dd>
								<input type="button" onclick="ajaxAcc()" value="저장" class="btn btn-warning btn-xs" style="width:100%;">
							</dd>
						</dl>
					</div>
				</dd>
			</dl>
            <?php
            $sql="select sum(po_point) as lpoint from g5_point_l where mb_id='{$_SESSION['ss_mb_id']}'";
            $row3=sql_fetch($sql);
            ?>
			<dl>
				<dt class="wc-price">보유 포인트 <span><?=$row3['lpoint']?></span> <span style="color:#333;">P</span></dt>
			</dl>
			<!--<dl>
				<dd class="row">
					<form name="wal_write" id="wal_write" action="<?php /*echo $wal_action_url */?>" method="post" enctype="multipart/form-data" onsubmit="return fwrite_submit(this);" >
						<p class="col-xs-9" style="padding:0;">
							<input type="number" name="ch_money" id="ch_money" value="" class="wal-input">
						</p>
						<p class="col-xs-3" style="padding:0;">
							<input type="submit" id="ch_submit" class="btn btn-danger btn-sm wl_btn" value="환전신청">
						</p>
					</form>
				</dd>
			</dl>-->
		</div>
		
		<?/*
		<div class="wal-req">
			<dl>
				<dt>환전신청내역</dt>
			</dl>
			<dl class="row">
				<?php for($i=0; $i<count($list); $i++){ ?>
				<dd class="col-xs-6"><?php echo number_format($list[$i]['ch_money']);?>원</dd>
				<dd class="col-xs-6 text-right"><?php echo $list[$i]['ch_datetime'];?></dd>
				<?php } ?>
				<?php if($i == 0){ ?>
				<dd class="col-xs-12">포인트를 신청한 내역이 없습니다.</dd>
				<?php } ?>
			</dl>
		</div>
		*/?>

		<div class="wal-req">
			<dl>
				<dt>환전내역</dt>
			</dl>
			<dl>
                <?php
                // $stocks 배열에 데이터가 있는지 확인하고 순회합니다.
                if (!empty($stocks)) {
                    foreach ($stocks as $row) {
                        ?>
                        <dd class="row">
                            <p class="col-xs-4">
                                <strong><?php echo $row['holding_count'] ?></strong>
                                <span class="sc-line" style="color:#333;">포인트</span>
                                <span class="" style="color:#333;">
                                    <?php
                                    $giver_member_id = $row['giver_member_id'];
                                    $get_member = get_member($giver_member_id);
                                    $mb_name = $get_member['mb_name'];
                                    if($mb_name){
                                        echo '['.$mb_name.' - '.$row[payment_reason].']';
                                    }
                                    ?>
                                </span>
                            </p>
                            <p class="col-xs-8 text-right">
                                <span class="box-ico">포인트당 <?php echo $row['stock_price'];?>원</span>
                                <span class="time"><?php echo $row['issuance_date'];?></span>
                            </p>
                            <p class="col-xs-12 text-right wc-price">
                                <?php
                                echo getRefundStatusText($row['refund_status']);
                                ?>
                            </p>

                            <?php if ($row['refund_status'] == 'N') { ?>
                                <!-- 환전 신청 버튼 -->
                                <p class="col-xs-12 text-right">
                                    <button type="button" onclick="updateStockStatusToR('<?= $row['id'] ?>')" class="btn btn-primary">환전 신청</button>
                                </p>
                            <?php } ?>
                        </dd>
                        <?php
                    }
                } else {
                    // $stocks가 비어있을 경우
                    ?>
                    <dd>포인트를 환전한 내역이 없습니다.</dd>
                    <?php
                }
                ?>
            </dl>
			<?php if($write_pages){ ?>
			<dl>
				<dd><?php echo $write_pages;?></dd>
			</dl>
			<?php } ?>
		</div>
	</article>
    <?php /*?><article class="slg-text">
    	<h3>자신을 위한 세계 당신이 세상의 길이 된다.</h3>
        <h4>포인트와 함께하는 당신</h4>
        <p>대기업과 금융사, 정보유통, 시장을 압축, 줄필요한 중간유통시간 고용경비등 절감비용을 우리의 소득으로 환원하여 줌으로 자신을 위한 세계를 열어 가십시오.</p>
        <img src="<?php echo $mypage_skin_url?>/img/mychange_img.png" width="100%" alt="" style="margin-bottom:-30px;">
    </article><?php */?>

</div>

<script>
    //포인트 환전 신청
    function updateStockStatusToR(stockId) {
        //계좌 정보 있는지 확인
        let mbBank = '<?php echo $member['mb_bank'];?>';
        let mbAname = '<?php echo $member['mb_aname']; ?>';
        let mbAccount = '<?php echo $member['mb_account'];?>';

        if(!mbBank || !mbAname || !mbAccount){
            alert('계좌 정보가 없습니다. 계좌정보를 입력해주세요');
            return false;
        }

        if(!confirm('환전 신청 하시겠습니까?'))
            return false;

        console.log('stockId >>> ' + stockId);

        $.ajax({
            url: g5_bbs_url+'/update_stock_info.php', // 요청을 보낼 URL
            type: 'POST',
            dataType: 'json',
            data: { stockId: stockId },
            success: function(response) {
                if(response.status === 'success') {
                    alert(response.message);
                    // 성공적으로 업데이트되었을 때의 추가 동작
                    location.reload();
                } else {
                    alert(response.message);
                    // 업데이트 실패 시의 처리
                    location.reload();
                }
            },
            error: function() {
                alert('서버와의 통신 중 오류가 발생했습니다.');
            }
        });
    }

    $(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 124);
});	

function fwrite_submit(f){
	var mon = parseInt(document.getElementById("ch_money").value);
	var max_mon = <?php echo $member['mb_point'];?>
	
	if(mon == ""){
		alert("환전신청금액을 입력해주세요.");
		return false;
	}
	
	if(max_mon < mon){
		alert("환전신청금액은 <?php echo number_format($member['mb_point']);?>를 넘을 수 없습니다.");
		return false;
	}

	return true;
}

function setAcc(t){
	if($("#acc_frm").css("display") == "none"){
		$("#acc_frm").slideDown(200);
		t.value = "닫기";
	}else{
		$("#acc_frm").slideUp(100);
		t.value = "계좌정보";
	}
}

function ajaxAcc(){
	var mb_bank = document.getElementById("mb_bank").value;
	var mb_aname = document.getElementById("mb_aname").value;
	var mb_account = document.getElementById("mb_account").value;

	if(!mb_bank){
		alert("은행명을 작성해주세요.");
		return false;
	}

	if(!mb_aname){
		alert("계좌주를 작성해주세요.");
		return false;
	}

	if(!mb_account){
		alert("계좌번호를 작성해주세요.");
		return false;
	}

	$.get("<?php echo G5_BBS_URL;?>/ajax.account.php", {mb_bank:mb_bank, mb_aname:mb_aname, mb_account:mb_account}, function (e){
		location.reload();
	});
}
</script>


