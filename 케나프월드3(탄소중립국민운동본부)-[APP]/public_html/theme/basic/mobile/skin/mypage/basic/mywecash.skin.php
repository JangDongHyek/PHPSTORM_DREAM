<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div class="wal-cotainer" id="wal_cotainer">
	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dt class="wc-price">포인트 <span><?php echo number_format($member['mb_point']);?></span>원</dt>
			</dl>
			<dl>
				<?php for($i=0; $i<$row=sql_fetch_array($result); $i++){ ?>
				<dd class="row">
                    <p class="col-xs-4"><strong><?php echo $row['po_point']>0?"+".number_format($row['po_point']):number_format($row['po_point']);?></strong>원</p>
                    <p class="col-xs-8 text-right">
                        <span class="box-ico"><?php echo $row['po_content'];?></span>
                        <span class="time"><?php echo $row['po_datetime'];?></span>
                    </p>
                    <p class="col-xs-12 text-right wc-price">잔액 <span><?php echo number_format($row['po_mb_point']);?></span>원</p>
                </dd>
				<?php } ?>
				<?php if($i==0) { ?>
				<dd>포인트를 충전한 내역이 없습니다.</dd>
				<?php } ?>
			</dl>
			<?php if($write_pages){ ?>
			<dl>
				<dd><?php echo $write_pages;?></dd>
			</dl>
			<?php } ?>
		</div>
	</article>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 124);
});	
</script>


