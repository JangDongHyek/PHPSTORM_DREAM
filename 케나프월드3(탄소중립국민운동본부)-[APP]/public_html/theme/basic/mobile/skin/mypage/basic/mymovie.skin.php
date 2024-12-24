<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
$sql="select sum(point) as point from g5_movie_point where mb_id='$member[mb_id]' and status='1'";
$row=sql_fetch($sql);

$sql="select sum(point) as point from g5_movie_view_point where mb_id='$member[mb_id]'";
$row2=sql_fetch($sql);

$totalPoint=$row[point]-$row2[point];
$statusArr=array("-1","거절","0"=>"대기","1"=>"수락");

?>

<?php /*?><table class="table">
<tbody>
    <tr>
        <td><a href="<?=G5_BBS_URL?>/mywallet.php">충전내역</a></td>
        <td><a href="<?=G5_BBS_URL?>/myrecommend.php">추천인목록</a></td>
        <td><a href="<?=G5_BBS_URL?>/myrecommend.point.php">포인트내역</a></td>
        <td><a href="<?=G5_BBS_URL?>/mylotto.php">복권당첨내역</a></td>

    </tr>
</tbody>
</table>
<?php */?>	


<!--상단 탭부분-->
<div id="cha_tab">
    <ul>
        <li><a href="<?=G5_BBS_URL?>/mywallet.php">충전내역</a></li>
        <li><a href="<?=G5_BBS_URL?>/myrecommend.php">추천인목록</a></li>
        <li><a href="<?=G5_BBS_URL?>/myrecommend.point.php">포인트내역</a></li>
        <li><a href="<?=G5_BBS_URL?>/mylotto.php">복권당첨내역</a></li>
		<li class="selected"><a href="<?=G5_BBS_URL?>/mymovie.php">동영상충전내역</a></li>
    </ul>
</div><!--#cha_tab-->


<div class="wal-cotainer" id="wal_cotainer">

	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dt class="wc-price">포인트 <span><?php echo number_format($totalPoint);?></span> <span class="sc-line" style="color:#333;">w</span></dt>
			</dl>
			<dl>
				<form name="wal_write" id="wal_write" action="<?php echo G5_BBS_URL?>/mymovie.update.php" method="post" enctype="multipart/form-data" onsubmit="return fwrite_submit(this);" >
					<p class="row">
						<span class="col-xs-9" style="padding:0;">
							<input type="number" name="point" id="point" value="" class="wal-input" placeholder="0">
						</span>
						<span class="col-xs-3" style="padding:0;">
							<input type="submit" id="wl_submit" class="btn btn-danger btn-sm wl_btn" value="충전신청">
						</span>
					</p>
				</form>
			</dl>
		</div>
		

		<?/*
		<div class="wal-req">
			<dl>
				<dt>충전신청내역</dt>
			</dl>
			<dl class="row">
				<?php for($i=0; $i<count($list); $i++){ ?>
				<dd class="col-xs-6"><?php echo number_format($list[$i]['wl_money']);?>원</dd>
				<dd class="col-xs-6 text-right"><?php echo $list[$i]['wl_datetime'];?></dd>
				<?php } ?>
				<?php if($i == 0){ ?>
				<dd class="col-xs-12">포인트를 신청한 내역이 없습니다.</dd>
				<?php } ?>
			</dl>
		</div>
		*/?>

		<div class="wal-req">
			<dl>
				<dt>동영상포인트 충전내역</dt>
			</dl>
			<dl>
				<?php 
				$sql="select * from g5_movie_point where mb_id='$member[mb_id]'";
				$result=sql_query($sql);
				for($i=0; $i<$row=sql_fetch_array($result); $i++){ ?>
				<dd class="row">
                    <p class="col-xs-4"><strong><?php echo number_format($row[point])?></strong> <span class="sc-line">w</span></p>
                    <p class="col-xs-8 text-right">
                        <span class="box-ico"><?php echo $statusArr[$row[status]]?></span>
                        <span class="time"><?php echo date("m.d H:i",$row['regdate']);?></span>
                    </p>
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

function fwrite_submit(f){
	var mon = document.getElementById("point").value;

	if(mon == ""){
		alert("충전신청금액을 입력해주세요.");
		return false;
	}
	if(parseInt(mon)<2000){
		alert("충전금액은 2,000원 이상 신청하셔야 합니다.");
		return false;
	}

	return true;
}
</script>


