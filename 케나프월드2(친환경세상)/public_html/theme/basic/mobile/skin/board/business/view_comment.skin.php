<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>

<?php if($w == '')  $w = 'c'; ?>
<div id="review">
	<aside id="bo_vc_w">
		<form name="fviewcomment" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
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
		<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $com['wr_1']?$com['wr_1']:"1";?>">
		<input type="hidden" name="cmt_depth" id="cmt_depth" value="">

		<div>
			<dd id="star_dd" class="star_dd">
				<?php 
				for($j=0; $j<5; $j++){ 
					if($j < $com['wr_1'] || $j == 0){
				?>	
					<i class="fa fa-star fa-2x write_star" onclick="setStar('<?php echo $j;?>')"></i>
				<?php }else{ ?>
					<i class="fa fa-star-o fa-2x write_star" onclick="setStar('<?php echo $j;?>')"></i>
				<?php
					}
				} 
				?>
			</dd>
			<dd>
				<?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
				<textarea id="wr_content" name="wr_content" required title="리뷰 내용"
				<?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
				<?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
			</dd>
			<dd id="file_dd" class="file_dd" style="padding-bottom:3px;">
				<label class="btn btn-default btn-file" style="display:inline-block;">
					파일선택 <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input" style="display:none;">
				</label>
				<p id="file_p" class="file_p"></p>
				<p id="file_font" class="file_font">
				<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> 
					<label for="bf_file_del<?php echo $i ?>" style="height:auto; margin-bottom: 0;">파일 삭제</label>
				<?php } ?>
				</p>
			</dd>
			<dd>
				<input type="submit" value="리뷰등록" id="btn_submit" class="btn btn-danger" accesskey="s" style="width:100%;">
			</dd>
		</div>

		</form>
	</aside>

	<!-- 리뷰 리스트 -->
	<section id="bo_vc">
		<?php
		for ($i=0; $i<count($list); $i++) {
			$comment_id = $list[$i]['wr_id'];
			$cmt_depth = ""; // 리뷰단계
			$cmt_depth = strlen($list[$i]['wr_comment_reply']) * 20;
				$str = $list[$i]['content'];
				if (strstr($list[$i]['wr_option'], "secret"))
					$str = $str;
				$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);

			$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 300, 300);
			if($thumb['src'])
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'" class="img" style="width:100%;">';
			else
				$img_content = '';
		?>
		<article id="c_<?php echo $comment_id ?>" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;border-top-color:#e0e0e0"<?php } ?>>
			<header>
				<h1><?php echo get_text($list[$i]['wr_name']); ?>님의 리뷰</h1>
				<span class="nickname"><?php echo $list[$i]['name'] ?></span>
				<?php if ($cmt_depth) { ?><img src="<?php echo $board_skin_url ?>/img/icon_reply.gif" alt="리뷰의 리뷰" class="icon_reply"><?php } ?>
				<span class="bo_vc_hdinfo w_date"><time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($list[$i]['datetime'])) ?>"><?php echo $list[$i]['datetime'] ?></time></span>
				
				<?php if ($is_ip_view) { ?>
				<span class="bo_vc_hdinfo w_date" style="float:right;"><?php echo $list[$i]['ip']; ?></span>
				<?php } ?>
			</header>
			<div id="edit_div_<?php echo $list[$i]['wr_id'];?>" class="edit_div">
				<?php if(!$cmt_depth){ ?>
				<!-- 리뷰 출력 -->
				<p class="star_dd" style="font-size:1.25em;">
					<?php 
					for($j=0; $j<5; $j++){ 
						if($j < $list[$i]['wr_1'] || $j == 0)
							echo "<i class=\"fa fa-star\"></i>";
						else
							echo "<i class=\"fa fa-star-o\"></i>";
					} 
					?>
				</p>
				<?php } ?>
				<p class="img">
					<?php echo $img_content;?>
				</p>
				<p>
					<?php if (strstr($list[$i]['wr_option'], "secret")) echo "<img src=\"".$board_skin_url."/img/icon_secret.gif\" alt=\"비밀글\">"; ?>
					<?php echo $str ?>
				</p>
			</div>

			<span class="edit_span" id="edit_<?php echo $comment_id ?>" style="display:none"></span><!-- 수정 -->
			<span class="reply_span" id="reply_<?php echo $comment_id ?>" style="display:none"></span><!-- 답변 -->

			<input type="hidden" id="secret_comment_<?php echo $comment_id ?>" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>">
			<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>

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

				$file = sql_fetch("select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$list[$i]['wr_id']}'");
			?>
			<footer>
				<ul class="bo_vc_act" style="padding-top:10px;">
					<input type="hidden" id="wr_1_<?php echo $list[$i]['wr_id'];?>" value="<?php echo $list[$i]['wr_1'];?>">
					<input type="hidden" id="wr_file_<?php echo $list[$i]['wr_id'];?>" value="<?php echo $file['bf_source'];?>">
					<?php if ($list[$i]['is_reply']) { ?><li><a href="<?php echo $c_reply_href; ?>" onclick="comment_box('<?php echo $comment_id ?>', 'c', '<?php echo $cmt_depth;?>'); return false;" class="btn btn-default btn-sm">답변</a></li><?php } ?>
					<?php if ($list[$i]['is_edit']) { ?><li><a href="<?php echo $c_edit_href; ?>" onclick="comment_box('<?php echo $comment_id ?>', 'cu', '<?php echo $cmt_depth;?>'); return false;" class="btn btn-default btn-sm">수정</a></li><?php } ?>
					<?php if ($list[$i]['is_del'])  { ?><li><a href="<?php echo $list[$i]['del_link']; ?>" onclick="return comment_delete();" class="btn btn-default btn-sm">삭제</a></li><?php } ?>
				</ul>
			</footer>
			<?php } ?>
		</article>
		<?php } ?>
		<?php if ($i == 0) { //리뷰이 없다면 ?><p id="bo_vc_empty">등록된 리뷰이 없습니다.</p><?php } ?>

	</section>
<div>

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

	/*
	var s;
	if (s = word_filter_check(document.getElementById('wr_content').value))
	{
		alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
		document.getElementById('wr_content').focus();
		return false;
	}
	*/

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
			alert("리뷰은 "+char_min+"글자 이상 쓰셔야 합니다.");
			return false;
		} else if (char_max > 0 && char_max < cnt)
		{
			alert("리뷰은 "+char_max+"글자 이하로 쓰셔야 합니다.");
			return false;
		}
	}
	else if (!document.getElementById('wr_content').value)
	{
		alert("리뷰을 입력하여 주십시오.");
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

	<?php if($is_guest) echo chk_captcha_js(); ?>

	set_comment_token(f);

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}

function comment_box(comment_id, work, cmt_depth)
{
	var el_id;

	// 리뷰 아이디가 넘어오면 답변, 수정
	if (comment_id)
	{
		if (work == 'c')
			el_id = 'reply_' + comment_id;
		else
			el_id = 'edit_' + comment_id;
	}
	else
		el_id = 'bo_vc_w';

	$(".edit_div").slideDown(200);

	if (save_before != el_id)
	{
		if (save_before)
		{
			document.getElementById(save_before).style.display = 'none';
			document.getElementById(save_before).innerHTML = '';
		}
		
		document.getElementById(el_id).style.display = '';
		document.getElementById(el_id).innerHTML = save_html;
		
		// 리뷰 수정
		if (work == 'cu')
		{
			$("#edit_div_"+comment_id).slideUp(200);

			document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
			
			$("#"+el_id).find("#wr_1").val("");
			if(cmt_depth == "0"){
				$("#"+el_id).find("#star_dd").css("display", "");
				$("#"+el_id).find("#file_dd").css("display", "");

				var wr_1 = $("#wr_1_"+comment_id).val();
				var wr_file = $("#wr_file_"+comment_id).val();

				$("#"+el_id).find("#wr_1").val(wr_1);
				
				for(var i=0; i<wr_1; i++){
					$(".write_star").eq(i).removeClass("fa-star-o").addClass("fa-star");
				}
				
				$('[name="bf_file[]"]').on('fileselect', function(e, f, l) {
					$(this).parents("dd.file_dd").find("p.file_p").html(l);
				});

				if(wr_file){
					var chk = $("<input/>", {
								type	: "checkbox",
								id		: "bf_file_del"+comment_id,
								name	: "bf_file_del[]",
								value	: 1
							});
					var lb = $("<label/>", {
								for		: "bf_file_del"+comment_id,
								style	: "height:auto; margin-bottom: 0; width:auto;",
								html	: "파일 삭제 ( "+wr_file+" )"
							});
					$("#file_font").append(chk).append(lb);
				}
			}else{
				$("#"+el_id).find("#star_dd").css("display", "none");
				$("#"+el_id).find("#file_dd").css("display", "none");
			}
			$("#"+el_id).find("#btn_submit").val("리뷰수정");
		}else if(work == 'c' && comment_id){
			$("#"+el_id).find("#wr_1").val("");
			$("#"+el_id).find("#star_dd").css("display", "none");
			$("#"+el_id).find("#file_dd").css("display", "none");
			$("#"+el_id).find("#btn_submit").val("리뷰답변");
		}

		document.getElementById('comment_id').value = comment_id;
		document.getElementById('w').value = work;

		if(save_before)
			$("#captcha_reload").trigger("click");

		save_before = el_id;
	}else{
		el_id = 'bo_vc_w';
		if (save_before)
		{
			document.getElementById(save_before).style.display = 'none';
			document.getElementById(save_before).innerHTML = '';
		}
		
		document.getElementById(el_id).style.display = '';
		document.getElementById(el_id).innerHTML = save_html;
		
		$("#"+el_id).find("#wr_1").val("");
		$("#"+el_id).find("#star_dd").css("display", "");
		$("#"+el_id).find("#file_dd").css("display", "");
		$("#"+el_id).find("#btn_submit").val("리뷰등록");
				
		$('[name="bf_file[]"]').on('fileselect', function(e, f, l) {
			$(this).parents("dd.file_dd").find("p.file_p").html(l);
		});

		document.getElementById('comment_id').value = '';
		document.getElementById('w').value = 'c';

		if(save_before)
			$("#captcha_reload").trigger("click");

		save_before = el_id;
	}
	
	var h = $("#review").height() + 10;
	$("#swiper-content02, #review_slide").animate({ height:h }, 100);
}

function comment_delete()
{
	return confirm("이 리뷰을 삭제하시겠습니까?");
}

comment_box('', 'c', '0'); // 리뷰 입력폼이 보이도록 처리하기위해서 추가 (root님)

$(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$('[name="bf_file[]"]').on('fileselect', function(e, f, l) {
	$(this).parents("dd.file_dd").find("p.file_p").html(l);
});

function setStar(j){
	j++;

	for(var i=0; i<$(".write_star").size(); i++){
		if(i < j)
			$(".write_star").eq(i).removeClass().addClass("fa fa-star fa-2x write_star");
		else
			$(".write_star").eq(i).removeClass().addClass("fa fa-star-o fa-2x write_star");
	}
	$("#wr_1").val(j);
}

</script>
