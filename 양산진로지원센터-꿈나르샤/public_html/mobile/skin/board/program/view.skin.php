<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<style>
	.tbl_frm01 { width:90%; margin-left:-22px}
	.tbl_frm01 ul{width:100%}
	.tbl_frm01 ul li{ width:100%; overflow-y:hidden}
	.tbl_frm01 ul li h2{font-size:15px;}
</style>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->


<article id="bo_v" style="width:<?php echo $width; ?>">
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
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
	
	
    <!-- } 게시물 상단 버튼 끝 -->
   <div class="tbl_frm01 tbl_wrap">
	<ul>
		<!-- 이미지 보여주기 -->
		<li>
		<?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>
		</li>
		<li>
			<h2><?php echo $view['wr_subject']?></h2><br/>
			<table>
				<tbody>
					<tr>
						<th bgcolor="f9f9f9">일정</th>
						<td><?php echo $view[wr_1]?>~<?php echo $view[wr_2]?></td>
						<td rowspan="3">
						<?php
								$now=strtotime(date("Y-m-d"));
								if($now<strtotime($view['wr_1'])){
									echo "<a href='javascript:alert(\'아직 신청날짜가 아닙니다.'\);' class='btn btn_submit' style='color:white'>신청전</a>";
								}else if(strtotime($view['wr_1'])<=$now&&$now<=strtotime($view['wr_2'])){
									$sql="select count(wr_id) as cnt from g5_write_apply where wr_1='".$view['wr_id']."'";
									$cRow=sql_fetch($sql);
									if($cRow[cnt]<$view[wr_5]){
										echo "<a href='".G5_BBS_URL."/write.php?bo_table=apply&wr_1=".$view['wr_id']."' class='btn btn_request' style='color:white'>신청가능</a>";
									}else{
										echo "<a href='javascript:alert(\'마감되었습니다.'\);' class='btn btn_finish' style='color:white'>마감</a>";
									}
								}else{
									echo "<a href='javascript:alert(\'마감되었습니다.'\);' class='btn btn_finish' style='color:white'>마감</a>";
								}
							?>
						</td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">장소</th>
						<td><?php echo $view[wr_3]?></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">내용</th>
						<td><?php echo $view[wr_4]?></td>
					</tr>
				</tbody>
		  </table>
		
		</li>
	</ul>
        
	</div>

    

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>

    <?php if($cnt) { ?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <?php
    if ($view['link']) {
    ?>
     <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 관련링크 끝 -->
    <?php } ?>

    

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

       
        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        
    </section>

    <?php
    include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    //include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

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