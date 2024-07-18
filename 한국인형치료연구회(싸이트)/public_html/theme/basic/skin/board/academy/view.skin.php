<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

    $now = date("Y-m-d");
    $timestart = $view['wr_1'];
    $timeend = $view['wr_2'];

    $str_now = strtotime($now);
    $str_start = strtotime($timestart);
    $str_end = strtotime($timeend);

    $a_href = "";
    if(!($str_start > $str_now || $str_end < $str_now)){
        $a_href = "./write.php?bo_table=apply03&eduid=".$wr_id."&cate=".$view['ca_name'];
/*        $sql ="select count(*) as cnt from g5_write_apply03 where wr_4={$wr_id} and mb_id = '{$member['mb_id']}' ";
        $cnt_apply = sql_fetch($sql);
        if($cnt_apply['cnt'] >0){
            $a_href = "./write.php?bo_table=apply03&eduid=".$wr_id."&cate=".$view['ca_name'];
        }*/
    }

?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<div class="bo_edu">
	<table>
		<tbody>
			<tr>
				<th>제목</th>
				<td><?=$view['wr_subject']?></td>
			</tr>
			<tr>
				<th>접수기간</th>
				<td><?=$view['wr_1']?> ~ <?=$view['wr_2']?></td>
			</tr>
			<tr>
				<th>행사기간</th>
				<td><?=$view['wr_3']?> ~ <?=$view['wr_4']?></td>
			</tr>
			<tr>
				<th>비용</th>
				<td><?=number_format($view['wr_5']);?>원</td>
			</tr>
			<tr>
				<th>내용</th>
				<td>
					<!-- 본문 내용 시작 { -->
					<div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
					<?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
					<!-- } 본문 내용 끝 -->
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="btn_confirm">
    <? if($a_href != "") { ?>
        <a href="<?=$a_href?>" class="btn_submit">접수</a>
    <?}?>

		<?if($is_admin){?><a href="./write.php?bo_table=<?=$bo_table?>&wr_id=<?=$wr_id?>&certifyid=<?=$wr_id?>&w=u" class="btn_submit">수정</a><?}?>
	<a href="javascript:history.back();" class="btn_cancel">취소</a>
</div>
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