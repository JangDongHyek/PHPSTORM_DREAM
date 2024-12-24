<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$view['wr_id']}' and wr_is_comment = '1'");
$sum = $row['wr_content'];

$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$view['wr_id']}' and wr_is_comment = '1' and wr_1 = 'success'");
$res_sum = $row['wr_content'];

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<article id="bo_v" style="">

    <div id="bo_v_top" style="margin-bottom:0; padding-bottom:10px;">
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($is_adm || ($delete_href && $view['ca_name']=="구매")) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
        </ul>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:30%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
			<?php if($is_adm){ ?>
			<tr>
				<th>작성자</th>
				<td><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?> <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></td>
			</tr>
			<?php } ?>
			<tr>
				<th><?php echo $view['ca_name'];?>에셋</th>
				<td><?php echo number_format($view['subject']);?> 에셋</td>
			</tr>
			<tr>
				<th>1에셋 단가</th>
				<td><?php echo number_format($view['content']);?> 원</td>
			</tr>
			<?php if($view['ca_name']=="판매"){ ?>
			<tr>
				<th>남은에셋</th>
				<td>
					<?php echo number_format($view['subject'] - $sum);?> 에셋 
					<?php if($res_sum >= $view['subject'] && !$view['wr_1']){ ?> 
					<input type="button" value="판매완료 변경" class="btn btn-default btn-xs" onclick="setEnd('end')">
					<?php } ?>
					<?php if($view['wr_1'] && $res_sum < $view['subject']){ ?>
					<input type="button" value="판매중 변경" class="btn btn-default btn-xs" onclick="setEnd('')">
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
		</table>
	</div>

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

</article>
<div class="ft-box">

	에셋의 판매가격은 회원의 자율사항이며 보유량의 10%를 항시 판매할 수 있습니다

</div>
<script>
function setEnd(en){
	$.get("<?php echo G5_BBS_URL;?>/ajax.asset_end.php", {wr_id:<?php echo $view['wr_id'];?>, en:en}, function (e){
		location.reload();
	});
}
</script>