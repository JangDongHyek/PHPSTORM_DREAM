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
		<!--
		<section id="bo_v_info">
			<h2>페이지 정보</h2>
			작성자 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
			<span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
			조회<strong><?php echo number_format($view['wr_hit']) ?>회</strong>
			댓글<strong><?php echo number_format($view['wr_comment']) ?>건</strong>
		</section>
		-->

		<!-- 게시물 상단 버튼 시작 { -->
		<div id="bo_v_top">
			<?php
			ob_start();
			?>

			<ul class="bo_v_com">
				<!--<?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>-->
				<?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
				<li><a href="<?php echo $list_href ?>" class="btn_b01">리스트</a></li>
				<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
			</ul>
			<?php
			$link_buttons = ob_get_contents();
			ob_end_flush();
			?>
		</div>
		<!-- } 게시물 상단 버튼 끝 -->

		<div id="form_box">
			<table class="form_tbl">
			<tbody>
			<tr>
				<th class="form_tbl_th x110">제목</th>
				<td class="form_tbl_td" colspan="3"><?php echo $view['wr_subject'] ?></td>
			</tr>
			<tr>
				<th class="form_tbl_th x110">발신자 번호</th>
				<td class="form_tbl_td" colspan="3"><?php echo $view['wr_11'] ?></td>
			</tr>
			<tr>
				<th class="form_tbl_th x110">발송일시</th>
				<td class="form_tbl_td x260"><?php echo $view['wr_2'] ?></td>
				<th class="form_tbl_th x110">발송예약시간</th>
				<td class="form_tbl_td">
					<?php
					if($view['wr_2'] == '즉시'){
						echo date("Y-m-d H시 i분", strtotime($view['wr_datetime']));
					}
					
					if($view['wr_2'] == '예약'){
						if($view['wr_3'] != '') echo $view['wr_3'].' ';
						if($view['wr_4'] != '') echo $view['wr_4'].'시 ';
						if($view['wr_5'] != '') echo $view['wr_5'].'분';
					}
					?>
				</td>
			</tr>
			<tr>
				<th class="form_tbl_th x110">발송상태</th>
				<td class="form_tbl_td x260">
					<div>
						<?php echo $view['wr_1'] ?>
					</div>
				</td>
				<th class="form_tbl_th x110">문자내용</th>
				<td class="form_tbl_td"><?php echo get_view_thumbnail($view['content']); ?></td>
			</tr>
			<tr>
				<th class="form_tbl_th x110">발송대상</th>
				<td class="form_tbl_td" colspan="3">
					<?php
					$sm_sql = " select sm_mb_id from sms_mb_id where sm_bo_table='{$bo_table}' and sm_wr_id='{$wr_id}' order by sm_idx asc ";
					$sm_qry = sql_query($sm_sql);
					$sm_num = sql_num_rows($sm_qry);
					if($sm_num > 0){
					?>
					<dl style="margin:0; padding:0;">
					<?php
						for($sm=0; $sm<$sm_num; $sm++){
							$sm_row = sql_fetch_array($sm_qry);

							$sn_sql = " select * from g5_member where mb_id='{$sm_row['sm_mb_id']}' limit 1 ";
							$sn_row = sql_fetch($sn_sql);
					?>
						<dd><?php echo ($sn_row['mb_2'] != '')? $sn_row['mb_2'] : $sn_row['mb_name']; ?></dd>
					<?php
						}
					?>
					</dl>
					<?php
					}
					?>
				</td>
			</tr>
			</tbody>
			</table>
		</div>

		<!-- 링크 버튼 시작 { -->
		<div id="bo_v_bot">
			<?php echo $link_buttons ?>
		</div>
		<!-- } 링크 버튼 끝 -->
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