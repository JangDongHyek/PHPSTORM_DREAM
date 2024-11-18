<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
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
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=new&wr_id=<?php echo $view['wr_1'] ?>" class="btn_b01">목록</a></li>
			<?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del_new(this.href); return false;">삭제</a></li><?php } ?>
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
		<?php
		if($p_wr_id != ''){
			$p_sql = " select * from g5_write_new where wr_id='{$p_wr_id}' limit 0,1 ";
		}else{
			$p_sql = " select * from g5_write_new where wr_id='{$write['wr_1']}' limit 0,1 ";
		}
		$p_row = sql_fetch($p_sql);
		?>
		<tr>
			<th class="b_th">업체명</th>
			<td class="b_td"><?php echo $p_row['wr_subject'] ?></td>
		<tr>
		<tr>
			<th class="b_th">구분</th>
			<td class="b_td"><?php echo $view['wr_2'] ?></td>
		</tr>
		<tr>
			<th class="b_th">점검일자</th>
			<td class="b_td"><?php echo $view['wr_3'] ?></td>
		</tr>
		<tr>
			<th class="b_th">점검위치</th>
			<td class="b_td">
				<?php echo $view['wr_4'] ?>
				<?php if($write['wr_4'] == '일부'){ ?>
				<div id="wr_4_box" style="display:block;"><?php echo $view['wr_4_text'] ?></div>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<th class="b_th xp15">A/S 요청사항</th>
			<td class="b_td xp85"><?php echo $view['wr_5'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">기기교체</th>
			<td class="b_td xp85"><?php echo $view['wr_9'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">처리사항</th>
			<td class="b_td xp85"><?php echo $view['wr_6'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">담당자확인</th>
			<td class="b_td xp85"><?php echo $view['wr_7'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">담당A/S기사</th>
			<td class="b_td xp85"><?php echo $view['wr_11'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">출력장수</th>
			<td class="b_td xp85"><?php echo $view['wr_8'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">첨부파일</th>
			<td class="b_td xp85">
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
		<tr>
			<th class="b_th">비고</th>
			<td class="b_td" colspan="3"><?php echo get_view_thumbnail($view['content']); ?></td>
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
	if(confirm('삭제하시겠습니까?')){
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