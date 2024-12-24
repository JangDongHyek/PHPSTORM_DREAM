<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div class="wal-cotainer" id="wal_cotainer">
	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dt class="wc-price">포인트 <span><?php echo number_format($member['mb_point_l']);?></span> <span class="sc-line" style="color:#333;">w</span></dt>
			</dl>
			<dl>
				<form name="wal_write" id="wal_write" action="<?php echo $wal_action_url ?>" method="post" enctype="multipart/form-data" onsubmit="return fwrite_submit(this);" >
					<input type="hidden" name="wl_tel_chk" id="wl_tel_chk" value="">
					<p class="row" style="padding-bottom:0; ">
						<span class="col-xs-9" style="padding:0;">
							<input type="text" name="wl_tel" id="wl_tel" value="" class="wal-input" placeholder="전화번호를 입력해주세요." onkeyup="$('#wl_tel_chk').val('')">
						</span>
						<span class="col-xs-3" style="padding:0;">
							<input type="button" class="btn btn-default btn-sm wl_btn" value="찾기" style="background:#FFF;" onclick="findTel()">
						</span>
						<span class="col-xs-12" id="wl_font" style="font-weight:bold;"></span>
					</p>
					<p class="row">
						<span class="col-xs-9" style="padding:0;">
							<input type="number" name="wl_money" id="wl_money" value="" class="wal-input" placeholder="0">
						</span>
						<span class="col-xs-3" style="padding:0;">
							<input type="submit" id="wl_submit" class="btn btn-danger btn-sm wl_btn" value="결제">
						</span>
					</p>
				</form>
			</dl>
		</div>

		<div class="wal-req">
			<dl>
				<dt>결제내역</dt>
			</dl>
			<dl>
				<?php for($i=0; $i<$row=sql_fetch_array($result); $i++){ ?>
				<dd class="row">
                    <p class="col-xs-4"><strong><?php echo $row['po_point']>0?"+".number_format($row['po_point']):number_format($row['po_point']);?></strong> <span class="sc-line">w</span></p>
                    <p class="col-xs-8 text-right">
                        <span class="box-ico"><?php echo $row['po_content'];?></span>
                        <span class="time"><?php echo $row['po_datetime'];?></span>
                    </p>
                </dd>
				<?php } ?>
			</dl>
			<dl>
				<dd><?php echo $write_pages;?></dd>
			</dl>
		</div>
	</article>
    <?php /*?><article class="slg-text">
    	<h3>빠르고 편리한 모바일 직거래 시장 - 포인트<br>
        모바일wellet - <strong>수수료적립</strong></h3>
        <p>카드나 현금대신 회원간의 간편한 결제수단으로 이용하시면 수수료가 적립됩니다.</p>
        <br/>
        <p class="step">
            결제시스템 기반의 포인트적립<br/>
            <span>결제버튼 - 금액입력 - ID확인 - 완료</span>
        </p>
        <br>
        <p>포인트는 디지털거래 기축통화구축 실물경제 결제통화상용화 물류 및 
        영업수당지급화 외식 쇼핑 가맹 결제 사회적 기부나눔 사업등 기존사업과 초간편 융합하는 시스템입니다.</p>
    </article><?php */?>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 124);
});	

function findTel(){
	var wl_tel = $("#wl_tel").val();

	$.get("<?php echo G5_BBS_URL;?>/ajax.find_tel.php", {wl_tel:wl_tel}, function (e){
		if(e.success)
			$("#wl_tel_chk").val(1);
		else
			$("#wl_tel_chk").val("");

		$("#wl_font").html(e.msg);
	}, "json");
}

function fwrite_submit(f){
	var mon = document.getElementById("wl_money").value;
	var wl_tel = document.getElementById("wl_tel").value;
	var wl_tel_chk = document.getElementById("wl_tel_chk").value;

	if(mon == ""){
		alert("결제금액을 입력해주세요.");
		return false;
	}

	if(wl_tel == ""){
		alert("전화번호를 입력해주세요.");
		return false;
	}
	
	if(wl_tel_chk == ""){
		alert("찾기 버튼 클릭 후 결제를 눌러주세요.");
		return false;
	}

	return true;
}
</script>


