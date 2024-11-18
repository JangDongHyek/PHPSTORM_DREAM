<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<?php
function type_list($t_row){
	global $list_arr;

	if($t_row){
		$datas = '';
		$datas .= '<tr class="nt_tr1"><td class="b_tb_td x110" rowspan="2">'.$t_row['nt_date'].'</td>';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_list'].'</td>';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_page1'].'</td>';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_install'].'</td>';
		$datas .= '</tr><tr class="nt_tr2">';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_model'].'</td>';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_page2'].'</td>';
		$datas .= '<td class="b_tb_td talign_l">';
		if($t_row['nt_file'] != ''){
			$datas .= '<a href="'.G5_BBS_URL.'/download_new.php?nt_file='.$t_row['nt_file'].'">'.$t_row['nt_file'].'</a>';
		}
		$datas .= '</td></tr>';
		echo $datas;
	}
}
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<article id="bo_v" style="width:<?php echo $width; ?>">
	
	<!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
        ?>
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del_new(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->
	
	<div class="tbl_wrap">
        <table class="b_tbl">
		<tbody>
		<tr>
			<th class="b_th">수리/판매일자</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_1'] ?></td>
		</tr>
		<tr>
			<th class="b_th">고객분류</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_2'] ?></td>
		</tr>
		<tr>
			<th class="b_th">고객명</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_subject'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">Tel</th>
			<td class="b_td xp35"><?php echo $view['wr_7'] ?></td>
			<th class="b_th xp15">H.P</th>
			<td class="b_td xp35"><?php echo $view['wr_8'] ?></td>
		</tr>
		<tr>
			<th class="b_th">주소</th>
			<td class="b_td" colspan="3">
                <?php if($view['wr_9'] != '') echo '['.$view['wr_9'].'] '; ?>
				<?php if($view['wr_10'] != '') echo $view['wr_10'].' ' ?>
				<?php if($view['wr_11'] != '') echo $view['wr_11'].' ' ?>
				<?php if($view['wr_12'] != '') echo '<br>'.$view['wr_12'].' ' ?>
			</td>
		</tr>
		<tr>
			<th class="b_th">모델</th>
			<td class="b_td"><?php echo $view['wr_9'] ?></td>
			<th class="b_th">수리/판매금액</th>
			<td class="b_td"><?php echo number_format($view['wr_10']).'원'; ?></td>
		</tr>
		<tr>
			<th class="b_th">내용</th>
			<td class="b_td" colspan="3"><?php echo get_view_thumbnail($view['content']); ?></td>
		</tr>
		<tr>
			<th class="b_th">첨부파일</th>
			<td class="b_td" colspan="3">
				<ul style="margin:0; padding:0 0;">
				<?php
				// 가변 파일
				for ($i=0; $i<count($view['file']); $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
				?>
					<li>
						<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
							<img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
							<strong><?php echo $view['file'][$i]['source'] ?></strong>
						</a>
					</li>
				<?php
					}
				}
				?>
				</ul>
			</td>
		</tr>
		</tbody>
		</table>
    </div>

</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

function del_new(href){
	if(confirm('신규고객을 삭제하시면 신규고객에 연동되는 임대기종, 정기정검 및 A/S, 기기교체 등을 복구할 수 없습니다.\n정말 삭제하시겠습니까?')){
		location.href = href;
	}
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>
<!-- } 게시글 읽기 끝 -->