<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$f_wr_id=$view[wr_10];
$sql="select * from g5_write_rent_old_sch where wr_id='$f_wr_id'";
$row=sql_fetch($sql);

$sql="select bf_file from g5_board_file where bo_table='rent_old_sch' and wr_id='$f_wr_id' and bf_no='0'";
$row2=sql_fetch($sql);
$carImageUrl="<img src='".G5_DATA_URL."/file/rent_old_sch/".$row2[bf_file]."'>";
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->
<article id="bo_v" style="width:<?php echo $width; ?>">
	<section id="bo_w">


		<div id="top_date_box">
			<div class="imgbox">
				<?php echo get_view_thumbnail($carImageUrl);?>
			</div>
			<div class="txtbox">
				<h3 class="bo_w_tit"><?=$row[wr_subject]?></h3>
				<ul>
					<li><span class="tit">배기량</span><span>0</span></li>
					<li><span class="tit">연료</span><span>-</span></li>
					<li><span class="tit">자차보험</span><span>-</span></li>
					<li class="btype"><span class="tit">보증금</span><span><?=number_format($row[wr_1])?> 원</span></li>
					<li class="btype"><span class="tit">월 렌트료</span><span><?=number_format($row[wr_2])?> 원</span></li>
				</ul>
			</div>
		</div>


		<!-- 게시물 작성/수정 시작 { -->
		


		<div class="tbl_frm01 tbl_wrap">
		<h4>견적신청</h4>
			<dl>
				<dt><label for="wr_subject">성명 및 회사명<strong class="sound_only">필수</strong></label></dt>
				<dd>
					<div id="autosave_wrapper">
						<?php echo $view[subject] ?>
					</div>
				</dd>
			</dl>

			<dl>
				<dt><label for="wr_phffrm_input frm_tel required wr_1_1">핸드폰</label></dt>
				<dd>
					<?php echo $view[wr_1];?>
				</dd>
			</dl>

			<dl>
				<dt><label for="wr_2">신용카테고리</label></dt>
				<dd>
					<?php echo $view[wr_2]?>

				</dd>
			</dl>
			<dl>
				<dt><label for="wr_content">나이</label></dt>
				<dd>
					<?php echo $view[wr_content]?>
				</dd>
			</dl>

			<dl>
				<dt>필요한 차종</dt>
				<dd><?=$row[wr_subject]?></dd>
			</dl>
	</div>
    <header>
      

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->
	</header>

    

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

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