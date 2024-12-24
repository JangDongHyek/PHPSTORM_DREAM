<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$action_url = G5_BBS_URL."/mysearch_update.php";

$mb_search = explode("|", $member['mb_search']);
add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
$search_arr = array("부킹맛집", "카풀", "배달", "알바", "부동산", "카정보", "콜서비스", "생활정보", "행사공연", "명품몰");
?>
<div class="wal-cotainer" id="wal_cotainer">
	<form action="<?php echo $action_url ?>" method="post" enctype="multipart/form-data" autocomplete="off">
	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dt class="wc-price">검색어 관리 </dt>
			</dl>
			<dl class="row">
				<?php for($i=0; $i<10; $i++){ ?>
				<dd class="col-xs-6">
					<input type="text" name="mb_search[<?php echo $i;?>]" id="mb_search_<?php echo $i;?>" value="<?php echo $mb_search[$i]?$mb_search[$i]:$search_arr[$i];?>" class="btn btn-default" style="width:100%;">
				</dd>
				<?php } ?>
				<dd class="col-xs-12">
					<input type="submit" value="저장" class="btn btn-danger" style="width:100%;">
				</dd>
			</dl>
		</div>
	</article>
	</form>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 125);
});	
</script>


