<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$wal_action_url = G5_BBS_URL."/myasset_update.php";

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div id="ejax_trade" class="ejax ejax-right"></div>

<div class="wal-cotainer" id="wal_cotainer">
	<article class="wal-frm">
		<?/*
		<div class="wal-req">
			<dl>
				<dt class="wc-price">
					거래중인 에셋
					<p>- 거래중인 에셋은 판매자 수락 후 지급됩니다.</p>
				</dt>
			</dl>
			<dl>
				<dd>
					<div class="tbl_head01 tbl_wrap">
						<table>
						<thead>
							<tr>
								<th scope="col">일</th>
								<th scope="col">id</th>
								<th scope="col">매매</th>
								<th scope="col">수량</th>
								<th scope="col">합계</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						for($i=0; $i<count($list); $i++){ 
							$row = sql_fetch("select * from g5_write_asset where wr_id = '{$list[$i]['wr_parent']}'");
							
							$temp = explode(" ", $list[$i]['wr_datetime']);
							$temp_date = explode("-", $temp[0]);
							$temp_time = explode(":", $temp[1]);

							$mk_now = mktime();
							$mk_date = mktime($temp_time[0], $temp_time[1], $temp_time[2], $temp_date[1], $temp_date[2], $temp_date[0]);

							$now_date = $mk_now - $mk_date;
							$date_str = floor($now_date / 86400);
							
							if($list[$i]['mb_id'] == $member['mb_id']){
								$name = substr($row['mb_id'], -4);
								$stat = "매수";
							}else{
								$name = substr($list[$i]['mb_id'], -4);
								$stat = "매도";
							}
						?>
							<tr>
								<td><?php echo $date_str;?></td>
								<td><?php echo $name;?></td>
								<td><?php echo $stat; ?></td>
								<td><?php echo number_format($list[$i]['wr_content']);?></td>
								<td>
									<?php echo number_format($list[$i]['wr_content'] * $row['wr_content']);?>
									<?php if($stat == "매수"){ ?>
									<input type="button" value="취소" onclick="setMyPay('<?php echo $list[$i]['wr_id'];?>', '취소')" class="btn btn-default btn-xs">
									<?php }else{ ?>
									<input type="button" value="수락" onclick="setMyPay('<?php echo $list[$i]['wr_id'];?>', '수락')" class="btn btn-danger btn-xs">
									<input type="button" value="거절" onclick="setMyPay('<?php echo $list[$i]['wr_id'];?>', '거절')" class="btn btn-black btn-xs">
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
									
						<?php if($i==0){ ?>
						<tr>
							<td colspan="5" class="text-center">
								거래중인 에셋이 없습니다.
							</td>
						</tr>
						<?php } ?>
						</tbody>
						</table>
					</div>
				</dd>
			</dl>
		</div>
		*/?>

		<div class="wal-req">
			<dl>
				<dt>에셋 거래내역</dt>
			</dl>
			<dl>
				<dd>
					<div class="tbl_head01 tbl_wrap">
						<table>
						<thead>
							<tr>
								<th scope="col">일</th>
								<th scope="col">id</th>
								<th scope="col">매매</th>
								<th scope="col">수량</th>
								<th scope="col">합계</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for($i=0; $i<$row=sql_fetch_array($result); $i++){ 
								$temp = explode(" ", $row['po_datetime']);
								$temp_date = explode("-", $temp[0]);
								$temp_time = explode(":", $temp[1]);

								$mk_now = mktime();
								$mk_date = mktime($temp_time[0], $temp_time[1], $temp_time[2], $temp_date[1], $temp_date[2], $temp_date[0]);

								$now_date = $mk_now - $mk_date;
								$date_str = floor($now_date / 86400);
								
								$content = explode(" ", $row['po_content']);
								$wr_idx = str_replace("]","", str_replace("[","", $content[0]));
								$wr_id_arr = explode("-", $wr_idx);
								$wr_id = $wr_id_arr[0];
								$wr_child = $wr_id_arr[1];

								$content = explode("(", $row['po_content']);
								$po_sub_arr = explode(")", $content[1]);
								$po_sub = $po_sub_arr[0];
								
								if($wr_child){
									$mb = sql_fetch("select mb_id from g5_write_asset where wr_id = '{$wr_id}'");
									$mb2 = sql_fetch("select mb_id from g5_write_asset where wr_id = '{$wr_child}'");
								}else{
								}
							?>
							<tr>
								<td><?php echo $temp_date[1]."-".$temp_date[2];?></td>
								<td>
									<?php 
									if($wr_child)		
										echo $mb['mb_id'] == $member['mb_id']?$mb2['mb_id']:$mb['mb_id'] ;
									else
										echo $po_sub;
									?>
								</td>
								<td>
									<?php 
									if($wr_child)
										echo $row['po_asset']>0?"매수":"매도";
									else
										echo $row['po_asset']>0?"받음":"보냄";
									?>
								</td>
								<td><?php echo number_format($row['po_asset']);?></td>
								<td><?php echo number_format($row['po_mb_asset']);?></td>
							</tr>
							<?php } ?>
							<?php if($i==0) { ?>
							<tr>
								<td colspan="5" class="text-center">
									에셋 거래내역이 없습니다.
								</td>
							</tr>
							<?php } ?>
						</tbody>
						</table>
					</div>
				</dd>
				<?php 
				for($i=0; $i<$row=sql_fetch_array($result); $i++){ 
					$content = explode(" ", $row['po_content']);
				?>
				<dd class="row">
                    <p class="col-xs-4"><strong><?php echo $row['po_asset']>0?"+".number_format($row['po_asset']):number_format($row['po_asset']);?></strong> </p>
                    <p class="col-xs-8 text-right">
                        <span class="box-ico"><?php echo $content[2];?> <?php echo $content[3];?></span>
                        <span class="time"><?php echo $row['po_datetime'];?></span>
                    </p>
                    <p class="col-xs-12 text-right wc-price">남은에셋 <span><?php echo number_format($row['po_mb_asset']);?></span> 에셋</p>
                </dd>
				<?php } ?>
			</dl>
			<?php if($write_pages){ ?>
			<dl>
				<dd><?php echo $write_pages;?></dd>
			</dl>
			<?php } ?>
		</div>
	</article>
    <article class="slg-text">
        <h4>Digitel 자산거래소</h4>
        <p>주식회사 글로벌 group - 디지털 포인트 자산거래소는 4차 산업중심의 유망중소 벤처기업, 
        신금융 에너지 금 부동산 광물자원 유통 ICT 드론 신소재 인류 자생환경을 위한 
        각분야별 사업을 발굴하여 활성화에 적극 지원 하고자 합니다.</p>
        <img src="<?php echo $mypage_skin_url?>/img/myasset_img.png" width="100%" alt="" style="margin-bottom:-30px;">
    </article>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 80);
});	

function setOpen(i){
	if($(i).css("display") == "none"){
		$(i).slideDown(100);
	}else{
		$(i).slideUp(100);
	}
}

$("#wc-oc-btn").on("click", function (){
	if($("#wc-wt-div").css("display") == "none"){
		$("#wc-wt-div").slideDown(100);
	}else{
		$(this).val("에셋거래");
		$("#wc-wt-div").slideUp(100);
	}
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

function setMyPay(wr_id, t){
	if(confirm(t + " 하시겠습니까?")){
		$.get("<?php echo G5_BBS_URL;?>/ajax.mypayment.php", {wr_id:wr_id, t:t}, function (e){
			location.reload();
		});
	}
}
</script>


