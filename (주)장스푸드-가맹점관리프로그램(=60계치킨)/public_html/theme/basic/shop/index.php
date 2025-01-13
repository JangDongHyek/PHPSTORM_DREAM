<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

define("_INDEX_", TRUE);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>

<!-- 메인 공지사항 추출 ( 첫페이지 노출 ) STR -->
<?php
$main_notice_sql = " select * from $write_table where wr_3 = 'y' limit 0,1 ";
$main_notice_qry = sql_query($main_notice_sql);
$main_notice_num = sql_num_rows($main_notice_qry);
if($main_notice_num == 0){
	$main_notice_sql = " select * from $write_table order by wr_id desc limit 0,1 ";
}
$main_write = sql_fetch($main_notice_sql);
if($main_write){

	$ss_name = 'ss_view_'.$bo_table.'_'.$main_write['wr_id'];
	set_session($ss_name, TRUE);

	$mn_view = get_view($main_write, $board, $board_skin_path);

	$html = 0;
	if (strstr($mn_view['wr_option'], 'html1'))
		$html = 1;
	else if (strstr($mn_view['wr_option'], 'html2'))
		$html = 2;

	$mn_view['content'] = conv_content($mn_view['wr_content'], $html);
	if (strstr($sfl, 'content'))
		$mn_view['content'] = search_font($stx, $mn_view['content']);

	if ($mn_view['file']['count']) {
		$mn_cnt = 0;
		for ($i=0; $i<count($mn_view['file']); $i++) {
			if (isset($mn_view['file'][$i]['source']) && $mn_view['file'][$i]['source']/* && !$view['file'][$i]['view']*/)
				$mn_cnt++;
		}
	}
?>
<div id="index_wrap">
	<div id="index_box">
		<div id="main_mn_info">※ 필독 공지사항 입니다!</div>

		<table class="main_mn_tbl">
		<tbody>
		<tr>
			<th class="main_mn_tbl_th x110"><label>공지기간</label></th>
			<td class="main_mn_tbl_td">
				<?php
				if($mn_view['wr_1'] != '') echo $mn_view['wr_1'];
				if($mn_view['wr_1'] != '' && $mn_view['wr_2'] != '') echo ' ~ ';
				if($mn_view['wr_2'] != '') echo $mn_view['wr_2'];
				?>
			</td>
		</tr>
		<tr>
			<th class="main_mn_tbl_th x110"><label for="wr_subject">제목</label></th>
			<td class="main_mn_tbl_td">
				<?php echo cut_str(get_text($mn_view['wr_subject']), 150); ?>
			</td>
		</tr>
		<?php
		if($mn_cnt){
			for ($i=0; $i<count($mn_view['file']); $i++) {
				if (isset($mn_view['file'][$i]['source']) && $mn_view['file'][$i]['source']/* && !$view['file'][$i]['view']*/) {
		?>
		<tr>
			<th class="main_mn_tbl_th x110"><label>다운로드 #<?php echo $i+1 ?></label></th>
			<td class="main_mn_tbl_td">
				<a href="<?php echo $mn_view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $mn_view['file'][$i]['source'] ?></strong>
                    <?php echo $mn_view['file'][$i]['content'] ?> (<?php echo $mn_view['file'][$i]['size'] ?>)
                </a>
                <span>DATE : <?php echo $mn_view['file'][$i]['datetime'] ?></span>
			</td>
		</tr>
		<?php
				}
			}
		}
		?>
		<tr>
			<td colspan="2" class="main_mn_tbl_td">
				<?php echo get_view_thumbnail($mn_view['content']); ?>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
<?php
}
?>
<!-- 메인 공지사항 추출 ( 첫페이지 노출 ) END -->


<!-- 메인 공지사항 리스트 추출 STR -->
<?php
require_once(G5_BBS_PATH.'/board_notice.php');
?>
<!-- 메인 공지사항 리스트 추출 END -->


<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>