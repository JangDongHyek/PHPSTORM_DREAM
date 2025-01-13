<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<?php
if ($view['file']['count']) {
	$cnt = 0;
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']/* && !$view['file'][$i]['view']*/)
			$cnt++;
	}
}
?>

<article id="bo_v" style="width:<?php echo $width; ?>">

	<h2 id="container_title"><?php echo $board['bo_subject'] ?> 상세보기</h2>

	<div id="form_box">
		<section id="bo_v_info">
			<h2>페이지 정보</h2>
			작성자 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
			<span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
			조회<strong><?php echo number_format($view['wr_hit']) ?>회</strong>
			댓글<strong><?php echo number_format($view['wr_comment']) ?>건</strong>
		</section>

		<!-- 게시물 상단 버튼 시작 { -->
		<div id="bo_v_top">
			<?php
			ob_start();
			?>
			<?php if ($prev_href || $next_href) { ?>
			<!--
			<ul class="bo_v_nb">
				<?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
				<?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
			</ul>
			-->
			<?php } ?>

			<ul class="bo_v_com">
				<?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
				<?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
				<li><a href="<?php echo $list_href ?>" class="btn_b01">리스트</a></li>
				<?php
				$re_sql = " select * from {$write_table} where wr_num='{$view['wr_num']}' and wr_reply!='' order by wr_num, wr_reply ";
				$re_qry = sql_query($re_sql);
				$re_num = sql_num_rows($re_qry);
				//$re_row = sql_fetch($re_sql);
				?>
				<!--<?php if ($reply_href && $re_row['wr_id'] == '') { ?>--><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><!--<?php } ?>-->
				<?php if ($write_href && $member['mb_level'] == 2) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
			</ul>
			<?php
			$link_buttons = ob_get_contents();
			ob_end_flush();
			?>
		</div>
		<!-- } 게시물 상단 버튼 끝 -->

		<table class="form_tbl">
		<tbody>
		<tr>
			<th class="form_tbl_th x110"><label>문의번호</label></th>
			<td class="form_tbl_td"><?php echo $view['wr_id'] ?></td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label>매장명</label></th>
			<td class="form_tbl_td">
				<?php
				$view_mb = null;
				$view_mb = get_member($view['mb_id']);
				if($view_mb['mb_2'] != '') echo $view_mb['mb_2'];
				?>
			</td>
		</tr>
		<?php if ($category_name){ ?>
		<tr>
			<th class="form_tbl_th x110"><label>분류</label></th>
			<td class="form_tbl_td">
				<?php
				$ic_sql = " select * from g5_write_inquiry_cate where ic_idx='{$view['ca_name']}' ";
				$ic_row = sql_fetch($ic_sql);
				?>
				<?php echo $ic_row['ic_ca_name'] ?>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th class="form_tbl_th x110"><label>제목</label></th>
			<td class="form_tbl_td">
				<?php echo cut_str(get_text($view['wr_subject']), 150); ?>
			</td>
		</tr>
		<?php
		if($cnt){
			for ($i=0; $i<count($view['file']); $i++) {
				if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']/* && !$view['file'][$i]['view']*/) {
		?>
		<tr>
			<th class="form_tbl_th x110"><label>다운로드 #<?php echo $i+1 ?></label></th>
			<td class="form_tbl_td">
				<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <!--<span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>-->
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
			</td>
		</tr>
		<?php
				}
			}
		}
		?>
		<tr>
			<td colspan="2" class="form_tbl_td">
				<?php echo get_view_thumbnail($view['content']); ?>
			</td>
		</tr>
		</tbody>
		</table>

		<!-- 답변 STR -->
		<?php
		//if($re_row['wr_id'] != ''){
		if($re_num > 0){
			for($rei=0; $rei<$re_num; $rei++){
				$re_row = sql_fetch_array($re_qry);

				$html = 0;
				if (strstr($re_row['wr_option'], 'html1'))
					$html = 1;
				else if (strstr($re_row['wr_option'], 'html2'))
					$html = 2;

				$re_wr_content = $re_row['wr_content'];
				$re_wr_content = conv_content($re_wr_content, $html);
				if (strstr($sfl, 'content'))
					$re_wr_content = search_font($stx, $re_wr_content);
		?>
		<div id="re_title">답변내용</div>

		<table class="form_tbl">
		<tbody>
		<tr>
			<th class="form_tbl_th x110">답변내용</th>
			<td class="form_tbl_td" colspan="3"><?php echo get_view_thumbnail($re_wr_content); ?></td>
		</tr>
		<?php
		if($re_row['wr_file'] > 0){
			for($b=0; $b<$re_row['wr_file']; $b++){
				$bf_sql = " select * from g5_board_file where bo_table='{$bo_table}' and wr_id='{$re_row['wr_id']}' and bf_no='{$b}' ";
				$bf_row = sql_fetch($bf_sql);
		?>
		<tr>
			<th class="form_tbl_th x110">다운로드 #<?php echo $b+1 ?></th>
			<td class="form_tbl_td" colspan="3">
				<a href="<?php echo G5_BBS_URL ?>/download.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $re_row['wr_id'] ?>&no=<?php echo $b ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $bf_row['bf_source'] ?></strong>
                </a>
			</td>
		</tr>
		<?php
			}
		}
		?>
		<tr>
			<th class="form_tbl_th x110">답변 완료일</th>
			<td class="form_tbl_td x360">
			<?php
			$datetime_arr = explode(' ', $re_row['wr_datetime']);
			$sub_datetime = $datetime_arr[0];
			echo $sub_datetime;
			?>
			</td>
			<th class="form_tbl_th x110">작성자</th>
			<td class="form_tbl_td">
			<?php
			if(!$re_row['wr_name']){
				$re_mem = get_member($re_row['mb_id']);
				echo $re_mem['mb_name'];
				$up_sql = " update g5_write_{$bo_table} set wr_name='{$re_mem['mb_name']}' where wr_num='{$view['wr_num']}' and wr_reply='A' ";
				sql_query($up_sql);
			}else{
				echo $re_row['wr_name'];
			}
			?>
			</td>
		</tr>
		</tbody>
		</table>

		<?php if($is_admin || $member['mb_id'] == $re_row['mb_id']){ ?>
		<div id="bo_v_top">
			<ul class="bo_v_com">
				<li><a class="btn_b01" href="./write.php?w=u&bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $re_row['wr_id'] ?>">답변수정</a></li>
				<li><a class="btn_b01" href="./delete.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $re_row['wr_id'] ?>&reply=ok" onclick="del(this.href); return false;">답변삭제</a></li>
			</ul>
		</div>
		<?php } ?>

		<?php
			}
		}
		?>
		<!-- 답변 END -->
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
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->