<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "select count(*) as cnt from g5_member where mb_recommend = '{$member['mb_id']}'";
$row = sql_fetch($sql);

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div class="wal-cotainer" id="wal_cotainer">
	
	<?/*
    <dl class="row" style="padding:10px 0">
        <dd class="col-xs-4"><a class="btn btn-danger" style="width:100%;">결제내역</a></dd>
        <dd class="col-xs-4"><a class="btn btn-danger" style="width:100%;">수당배달</a></dd>
        <dd class="col-xs-4"><a class="btn btn-danger" style="width:100%;">정부수정</a></dd>
    </dl>
	*/?>

	<article class="wal-frm">
		<div class="wal-req2">
			<dl>
				<dt style="width:50%;">본인산하 추천인수</dt>
				<dd style="width:50%;"><?php echo $row['cnt'];?> 명</dd>
			</dl>
		</div>
		<div class="wal-req2">
			<dl>
				<dt>자산</dt>
				<dt>전일배당</dt>
				<dt>전일배당</dt>
			</dl>
			<dl>
				<dd>에셋</dd>
				<dd>000</dd>
				<dd>000.00</dd>
			</dl>
			<dl>
				<dd>에셋</dd>
				<dd>000</dd>
				<dd>000.00</dd>
			</dl>
		</div>
		<div class="wal-req2">
			<dl>
				<dt>일자</dt>
				<dt>보너스 수수료내역</dt>
				<dt>누계</dt>
			</dl>
			
			<?php 
			for($i=0; $i<$row=sql_fetch_array($result); $i++){
			
			$temp = explode(" ", $row['po_datetime']);
			$temp_date = explode("-", $temp[0]);
			$temp_time = explode(":", $temp[1]);

			$mk_now = mktime();
			$mk_date = mktime($temp_time[0], $temp_time[1], $temp_time[2], $temp_date[1], $temp_date[2], $temp_date[0]);

			$now_date = $mk_now - $mk_date;
			$date_str = floor($now_date / 86400);
			
			?>
			<dl>
				<dd><?php echo $temp_date[1]."-".$temp_date[2];?></dd>
				<dd><?php echo number_format($row['po_point']);?></dd>
				<dd><?php echo number_format($sum);?></dd>
			</dl>
			<?php
				$sum-=$row['po_point'];
			} ?>
			<?php if($i==0){ ?>
			<dl>
				<dd style="width:100%;">보너스 받은 내역이 없습니다.</dd>
			</dl>
			<?php } ?>
		</div>
		<div class="wal-req2 col4">
			<dl>
				<dt>일자</dt>
				<dt>아이디</dt>
				<dt>결제내역</dt>
				<dt>누계</dt>
			</dl>
			
			<?php 
			for($i=0; $i<$row=sql_fetch_array($result2); $i++){
			$idx = explode("님이", $row['po_content']);
			
			$temp = explode(" ", $row['po_datetime']);
			$temp_date = explode("-", $temp[0]);
			$temp_time = explode(":", $temp[1]);

			$mk_now = mktime();
			$mk_date = mktime($temp_time[0], $temp_time[1], $temp_time[2], $temp_date[1], $temp_date[2], $temp_date[0]);

			$now_date = $mk_now - $mk_date;
			$date_str = floor($now_date / 86400);
			
			?>
			<dl>
				<dd><?php echo $temp_date[1]."-".$temp_date[2];?></dd>
				<dd><?php echo $idx[0];?></dd>
				<dd><?php echo number_format($row['po_point']);?></dd>
				<dd><?php echo number_format($sum2);?></dd>
			</dl>
			<?php 
			$sum2-=$row['po_point'];
			} ?>
			<?php if($i==0){ ?>
			<dl>
				<dd style="width:100%;">보너스 받은 내역이 없습니다.</dd>
			</dl>
			<?php } ?>
		</div>
        
		<div class="wal-req2">
		
		<form name="wal_write" id="wal_write" action="<?php echo G5_BBS_URL?>/mychange_update.php" method="post" enctype="multipart/form-data" onsubmit="return fwrite_submit2(this);" >
        <h2>출금정보수 <a href="<?php echo G5_BBS_URL;?>/mychange.php" style="color:#333;">입력 / 수정</a></h2>
			<dl>
				<dt>성명</dt>
				<dt><?php echo $member['mb_bank'];?>은행계좌</dt>
				<dt>환전금액</dt>
			</dl>
			<dl>
				<dd><?php echo $member['mb_aname']?$member['mb_aname']:"미등록";?></dd>
				<dd><?php echo $member['mb_account']?$member['mb_account']:"미등록";?></dd>
				<dd><input type="text" name="ch_money" id="ch_money" value="" style="border:0; text-align:right;width:100%;" placeholder="환전금액"></dd>
			</dl>
			<dl>
				<input type="submit" value="환전신청" class="btn btn-danger btn-sm" style="width:100%;">
			</dl>
		</form>
		</div>
	</article>

    <article class="slg-text text-center">
    내 손안의 작은 디지털 경제가 시작됩니다.
    </article>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 124);
});	

function fwrite_submit2(f){
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

</script>


