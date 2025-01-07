<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>

<style>
.textarea {border:0px;}
</style>


<div class="section">
<div class="container" style="margin:0px; padding:0px;">

<div id="comments" class="item comments">
	<h3 class="comments-title mb-4">Comments</h3>
		<ol class="comment-list">
			<li id="li-comment-2">

			<?php
			$cmt_amt = count($list);
			for ($i=0; $i<$cmt_amt; $i++) {
				$comment_id = $list[$i]['wr_id'];
				$cmt_depth = strlen($list[$i]['wr_comment_reply']) * 50;
				$comment = $list[$i]['content'];
				/*
				if (strstr($list[$i]['wr_option'], "secret")) {
					$str = $str;
				}
				*/
				$comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
				$cmt_sv = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
			 ?>

				<article id="c_<?php echo $comment_id ?>" class="comment byuser comment-author-kpowers bypostauthor even thread-even depth-1 mb-5" style="margin-left:0px; padding-left:0px;">

					

					<div class="comment-meta">
						<h5 class="mb-0"><?php echo $list[$i]['name'] ?></h5>
						<p class="mb-4"><span><i class="fa fa-clock-o" aria-hidden="true"></i> <time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($list[$i]['datetime'])) ?>"><?php echo $list[$i]['datetime'] ?></time></span></p>
					</div>

					<div class="comment-content" class="txt">
						<p>
							<?php if (strstr($list[$i]['wr_option'], "secret")) { ?><i class="fa fa-lock" aria-hidden="true"></i><?php } ?>
							<?php echo $comment ?>
						</p>
					</div>


					<?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
						$query_string = clean_query_string($_SERVER['QUERY_STRING']);

						if($w == 'cu') {
							$sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
							$cmt = sql_fetch($sql);
							if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
								$cmt['wr_content'] = '';
							$c_wr_content = $cmt['wr_content'];
						}

						$c_reply_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
						$c_edit_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
					 ?>

						<span class="reply mt-2">
						<p class="template-form" style="padding-top:10px;">
						<?php if ($list[$i]['is_reply']) { ?>
							<!--input type="button" value="답변" href="<?php echo $c_reply_href;  ?>" class="wpcf7-form-control wpcf7-submit txt" style="margin-right:0px; height:30px; padding-top:5px;" onclick="comment_box('<?php echo $comment_id ?>', 'c'); return false;"-->
						<?php } ?>
						<?php if ($list[$i]['is_edit']) { ?>
							<input type="button" value="수정" class="wpcf7-form-control wpcf7-submit txt" style="margin-right:0px; height:30px; padding-top:5px;" onclick="comment_box('<?php echo $comment_id ?>', 'cu'); return false; location.href='<?php echo $c_edit_href;  ?>';">
						<?php } ?>
						<?php if ($list[$i]['is_del'])  { ?>
							<input type="button" value="삭제" class="wpcf7-form-control wpcf7-submit txt" style="margin-right:0px; height:30px; padding-top:5px;" onclick="location.href='<?php echo $list[$i]['del_link']; ?>'; return comment_delete();">
						<?php } ?>
						</p>
						</span>

					<?php } ?>

					<span id="edit_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 수정 -->
					<span id="reply_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 답변 -->

					<input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
					<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>

				</article>
				<?php } ?>
				<?php if ($i == 0) { //댓글이 없다면 ?><p id="bo_vc_empty">등록된 코멘트가 없습니다.</p><?php } ?>

				</li><!-- #comment-## -->
		</ol>

		
	</div>
</div>
</div>





<?php if ($is_comment_write) {
    if($w == '')
        $w = 'c';
?>
<!-- 댓글 쓰기 시작 { -->

<div class="section">
<div class="container" style="margin:0px; padding:0px;">
<aside id="bo_vc_w" class="bo_vc_w">

<form name="fviewcomment" id="fviewcomment" action="<?php echo $comment_action_url; ?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off" class="comment-form">
    <input type="hidden" name="w" value="<?php echo $w ?>" id="w">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="is_good" value="">

	<div id="comments" class="item comments animated">
		<div class="comments-form">

			<div id="respond" class="comment-respond">
				<!--h3 id="reply-title" class="comment-reply-title">Leave a Comment</h3-->

				<p class="comment-notes">
					<span id="email-notes"><?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
				</p>

				<?php if ($is_guest) { ?>
				
				<div class="theme-form mt-4">
					<div class="row">
						<div class="col-6">
							<input type="text" name="wr_name" value="<?php echo get_cookie("ck_sns_name"); ?>" id="wr_name" required class="form-control field" size="30" placeholder="성함" aria-required='true'>
						</div>
						
						<div class="col-6">
							<input type="password" class="form-control field" name="wr_password" id="wr_password" required size="30"  placeholder="비밀번호" aria-required='true'>
						</div>
					</div>
				</div>

				<?php
				}
				?>

				<div class="theme-form mt-3">
					<div class="form-group">
						<textarea id="wr_content" name="wr_content" maxlength="10000" required aria-required="true" class="form-control" rows="4" title="내용" placeholder="코멘트 내용을 입력해주세요" 
    <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
    <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script>
	<?php } ?>
						<script>
						$(document).on("keyup change", "textarea#wr_content[maxlength]", function() {
							var str = $(this).val()
							var mx = parseInt($(this).attr("maxlength"))
							if (str.length > mx) {
								$(this).val(str.substr(0, mx));
								return false;
							}
						});
						</script>
					</div>
				</div>

				<?php if ($is_guest) { ?>

				<div class="theme-form mt-4">
					<div class="row">
						<div class="col-12">
							<?php echo $captcha_html; ?>
						</div>
					</div>
				</div>

				<?php } ?>

				<br>

				<div style="float:left;">
					<p class="form-submit">
					<input type="submit" id="btn_submit" class="submit" value="코멘트 등록">
					</p>
				</div>
				<div style="float:right;">
					<input type="checkbox" name="wr_secret" value="secret" id="wr_secret">
					<label for="wr_secret"> <i class="fa fa-lock" aria-hidden="true"></i> 비공개 코멘트</label>
				</div>
				<div class="cbt"></div>
				
			
			</div>
	
		</div>
	</div>

	</form>
</aside>

</div>
</div>



<script>
var save_before = '';
var save_html = document.getElementById('bo_vc_w').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("답변은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("답변은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("답변을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('비밀번호가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    set_comment_token(f);

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function comment_box(comment_id, work)
{
    var el_id,
        form_el = 'fviewcomment',
        respond = document.getElementById(form_el);

    // 댓글 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'bo_vc_w';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).appendChild(respond);
        //입력값 초기화
        document.getElementById('wr_content').value = '';
        
        // 댓글 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        if(save_before)
            $("#captcha_reload").trigger("click");

        save_before = el_id;
    }
}

function comment_delete()
{
    return confirm("이 답변을 삭제하시겠습니까?");
}

comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>

$(function() {
    // sns 등록
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('bo_vc_w').innerHTML;
        }
    );
});
<?php } ?>
$(function() {            
    //댓글열기
    $(".cmt_btn").click(function(){
        $(this).toggleClass("cmt_btn_op");
        $("#bo_vc").toggle();
    });
});
</script>
<?php } ?>
<!-- } 댓글 쓰기 끝 -->