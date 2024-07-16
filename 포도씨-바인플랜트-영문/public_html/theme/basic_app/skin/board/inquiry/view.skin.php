<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1>
    <section id="bo_v_info">
        <h2>페이지 정보</h2>
        이름 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
        <span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
    </section>
    </header>

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
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
			<? /*
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
			*/ ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con" class="tbl">
			<table>
				<tr>
					<th>이름</th>
					<td><?=$view['wr_name']?></td>
					<th>연락처</th>
					<td><?=$view['wr_content']?></td>
				</tr>
				<tr>
					<th>여행구분</th>
					<td colspan="3"><?=$view['ca_name']?></td>
				</tr>
				<tr>
					<th>출발일~회차일</th>
					<td colspan="3"><?=$view['wr_1']?> ~ <?=$view['wr_2']?></td>
				</tr>
				<tr>
					<th>출발시간/장소</th>
					<td colspan="3"><?=$view['wr_3']?>시 <?=$view['wr_4']?>분 <?=$view['wr_5']?></td>
				</tr>
				<tr>
					<th>경유지</th>
					<td><? echo $view['wr_6']? $view['wr_6'] : "없음"; ?></td>
					<th>목적지</th>
					<td><?=$view['wr_7']?></td>
				</tr>
				<tr>
					<th>차량종류/대수</th>
					<td><?=$view['wr_8']?> / <?=$view['wr_9']?>대</td>
					<th>운행구분</th>
					<td><?=$view['wr_10']?></td>
				</tr>
				<tr>
					<th>부대비용</th>
					<td colspan="3"><?=$view['wr_11']?></td>
				</tr>
				<tr>
					<th>단체명</th>
					<td colspan="3"><? echo $view['wr_12']? $view['wr_12'] : "없음"; ?></td>
				</tr>
				<tr>
					<th>요청사항</th>
					<td colspan="3"><? echo $view['wr_13']? $view['wr_13'] : "없음"; ?></td>
				</tr>
			</table>
		</div>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

    </section>


</article>
<!-- } 게시글 읽기 끝 -->