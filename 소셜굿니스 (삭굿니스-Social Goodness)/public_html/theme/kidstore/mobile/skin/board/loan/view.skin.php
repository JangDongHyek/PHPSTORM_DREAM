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
        <?php if ($prev_href || $next_href) { ?>
        <!--<ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
        </ul>-->
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>            
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
			<?if($bo_table=="qna"){?>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
			<?}?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->
	<div  class="tbl_head01">
    <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="wr_name">신청인<strong class="sound_only">필수</strong></label></th>
            <td><?=$view[wr_name]?></td>
        </tr>
		<tr>
			<th scope="row">자택주소</th>
			<td>
				<?=$view[wr_1]?><br/>
				<?=$view[wr_2]?><br/>
				<?=$view[wr_3]?>
			</td>
		</tr>
		<tr>
			<th scope="row">자택 연락처<br/>(휴대폰번호)</th>
			<td><?=$view[wr_4]?></td>
		</tr>
		 <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><?=$view[wr_email]?></td>
        </tr>
		<tr>
            <th scope="row">직장명</th>
            <td><?=$view[wr_5]?></td>
        </tr>
		<tr>
            <th scope="row">직장연락처</th>
            <td><?=$view[wr_9]?></td>
        </tr>
      
        </tbody>
        </table>
      
      <div class="tal_tit2">대출 신청정보</div>
      <table>
      	<tbody>
            <tr>
                <th scope="row">신청상품</th>
                <td><?=$view[wr_subject]?></td>
            </tr>
            <tr>
                <th scope="row">대출신청금액</th>
                <td><?=$view[wr_content]?>만원</td>
            </tr>
        </tbody>
      </table>
      
      
      
      
      
        </div>
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