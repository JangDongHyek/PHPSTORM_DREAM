<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
if($_GET['swr_name']&&$_GET['swr_7']){
	$list_href.="&amp;swr_name=".$_GET['swr_name']."&amp;swr_7=".$_GET['swr_7'];
}
if($view[ca_name]=="단기대여 서비스"){
	$style="display:";
}else{
	$style="display:none";
}
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<article id="bo_v" style="width:<?php echo $width; ?>" class="resBoard verView">
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
            <!--<?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>-->
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->
	
	<p class="res_ok_ment"><?=$view[wr_subject]?></p>
	<div class="tbl_frm01 tbl_wrap ">
		<div class="totalBox">
			<div class="res_Box">
				<h4>예약정보</h4>
				<dl>
					<dt>렌트분류	</dt>
					<dd><?=$view[ca_name]?></dd>
				</dl>
				<dl>
					<dt>픽업장소	</dt>
					<dd><?=$view[wr_1]?></dd>
				</dl>
				<?php
					if($view[wr_12]){
				?>
				<dl>
					<dt>반납장소	</dt>
					<dd><?=$view[wr_12]?></dd>
				</dl>
				<?php
					}
				?>
				<dl>
					<dt>대여일시	</dt>
					<dd><?=$view[wr_2]?> <?=$view[wr_3].":00"?></dd>
				</dl>
				<dl>
					<dt>반납일시	</dt>
					<dd><?=$view[wr_4]?> <?=$view[wr_5].":00"?></dd>
				</dl>
				<dl>
					<dt>차종	</dt>
					<dd><?=$view[wr_6]?></dd>
				</dl>
				<dl style="<?php echo $style?>">
					<dt>자차보험	</dt>
					<dd><?php echo $view[wr_10]==""?"신청안함":"신청함";?></dd>
				</dl>
				<dl>
					<dt>모델	</dt>
					<dd><?=$view[wr_9]?></dd>
				</dl>
				<dl style="<?php echo $style?>">
					<dt>대여가격</dt>
					<dd><?=number_format($view[wr_11])?>원</dd>
				</dl>
			</div>
			<!-- /res_Box -->

			<div class="res_Box">
				<h4>예약자 정보</h4>
				<dl>
					<dt>이름	</dt>
					<dd><?=$view[wr_name]?></dd>
				</dl>
				<dl>
					<dt>전화번호	</dt>
					<dd><?=$view[wr_7]?></dd>
				</dl>
				<dl>
					<dt>주소	</dt>
					<dd><?=$view[wr_content]?></dd>
				</dl>
				<dl>
					<dt>상세주소	</dt>
					<dd><?=$view[wr_8]?></dd>
				</dl>
			</div>
			<!-- /res_Box -->

		</div>
	</div>
	<!-- /tbl_wrap -->

    


    

    

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

