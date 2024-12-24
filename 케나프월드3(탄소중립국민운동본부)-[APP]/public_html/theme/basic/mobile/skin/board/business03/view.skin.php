<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div id="bo_v_table"><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']); ?></div>

<article id="bo_v" style="">

    <div id="bo_v_top" style="margin-bottom:0; padding-bottom:0;">
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b02">목록</a></li>
			<li>	
				<a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn_b01">위캐시 결제</a>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<dl class="modal-dialog modal-lg">
						<dd class="modal-content modal-point">
							<p>※ 결제하실 위캐시 입력 후 결제버튼을 눌러주세요. </p>
							<p class="row wc-price">
								<span class="col-xs-6">보유중인 위캐시</span>
								<span class="col-xs-6 text-right"><strong><?php echo number_format($member['mb_point']);?></strong></span>
							</p>
							<input type="number" name="wecash_pay" id="wecash_pay" value="" class="frm-input">
							<input type="button" value="결제" class="btn btn-danger" onclick="setPay()">
						</dd>
					</dl>
				</div>
			</li>
        </ul>
    </div>

    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo ($category_name ? '[ '.$view['ca_name'].' ] ' : ''); // 분류 출력 끝
			?>
			<span>
			<?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?>
			</span>
		</h1>
    </header>

    <section id="bo_v_info">
        <h2>페이지 정보</h2>
		<div class="row">
			<dl class="col-xs-8 text-left">
				작성자 <?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
			</dl>
			<dl class="col-xs-4 text-right" style="color:#888">
				<span class="sound_only">작성일</span><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?>
			</dl>
		</div>
		<div class="text-right">
			<i class="fa fa-eye" aria-hidden="true"></i> <?php echo number_format($view['wr_hit']) ?>
			<i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($view['comment_cnt']); ?>
        </div>
    </section>

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
    <?php } ?>

    <?php
    if ($view['link']) {
    ?>
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
    <?php } ?>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

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

        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act" style="paddind-bottom:5px;">
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">좋아요 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good">이 글을 좋아요하셨습니다</b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천  <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <?php
        include(G5_SNS_PATH."/view.sns.skin.php");
        ?>
    </section>

    <?php
    // 코멘트 입출력
	if($bo_table != "recommend" && $bo_table != "news" && $bo_table != "facebook")
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

</article>

<script>

var view_on = function (){
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
						$tx.text("이 글을 좋아요 하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					}
				}
			}, "json"
		);
	}
}

$(document).ready(function (e){
	view_on();
});

function setPay(){
	var wr_id = "<?php echo $wr_id;?>";
	var wp = $("#wecash_pay").val();

	if(!wp){
		alert("결제하실 위캐시를 입력해주세요.");
		return false;
	}

	$.get("<?php echo G5_BBS_URL;?>/ajax.wecash_update.php", {bo_table:"<?php echo $bo_table;?>", wr_id:wr_id, wp:wp}, function (e){
		if(e.success)
			location.href = "<?php echo G5_BBS_URL;?>/mywallet.php";
		else
			alert(e.msg);
	}, "json");
}
</script>