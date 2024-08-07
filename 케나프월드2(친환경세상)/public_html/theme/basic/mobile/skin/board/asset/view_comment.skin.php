<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>

<!-- 댓글 리스트 -->
<section id="bo_vc" style="padding-top:10px;">
    <?php
    for ($i=0; $i<count($list); $i++) {
        $comment_id = $list[$i]['wr_id'];
        $cmt_depth = ""; // 댓글단계
        $cmt_depth = strlen($list[$i]['wr_comment_reply']) * 20;
            $str = $list[$i]['content'];
            if (strstr($list[$i]['wr_option'], "secret"))
                $str = $str;
            $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
    ?>
    <article id="c_<?php echo $comment_id ?>" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;border-top-color:#e0e0e0"<?php } ?>>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
			   <col style="width:30%" />
			   <col style="width:auto" />
			</colgroup>
			<tbody>
				<tr>
					<th>요청에셋</th>
					<td><?php echo number_format($list[$i]['content']);?> 에셋</td>
				</tr>
				<tr>
					<th>요청날짜</th>
					<td><?php echo $list[$i]['wr_datetime'];?></td>
				</tr>
				<?/*
				<?php if($is_admin || $member['mb_id'] == $view['mb_id']) { ?>
				<tr>
					<?php if(!$list[$i]['wr_1']){ ?>
					<td colspan="2">
						<ul class="bo_vc_act">
							<li><a href="#" onclick="return setMyPay('<?php echo $list[$i]['wr_id'];?>', '수락');" class="btn btn-default">수락</a></li>
							<li><a href="#" onclick="return setMyPay('<?php echo $list[$i]['wr_id'];?>', '거절');" class="btn btn-default">거절</a></li>
							<?php if ($is_adm)  { ?><li><a href="<?php echo $list[$i]['del_link']; ?>" onclick="return comment_delete();" class="btn btn-default">삭제</a></li><?php } ?>
						</ul>
					</td>
					<?php }else{ ?>
					<th>상태</th>
					<td>
						<?php echo $list[$i]['wr_1']=="success"?"수락":"거절"; ?>
						<ul class="bo_vc_act">
							<?php if ($is_adm)  { ?><li><a href="<?php echo $list[$i]['del_link']; ?>" onclick="return comment_delete();" class="btn btn-default">삭제</a></li><?php } ?>
						</ul>
					</td>
					<?php } ?>
				</tr>
				<?php } ?>
				*/?>
			</tbody>
			</table>
		</div>

    </article>
    <?php } ?>

</section>

<script>

function setMyPay(wr_id, t){
	if(confirm(t + " 하시겠습니까?")){
		$.get("<?php echo G5_BBS_URL;?>/ajax.mypayment.php", {wr_id:wr_id, t:t}, function (e){
			location.reload();
		});
	}
	return false;
}

function setAsset(wr_id, t, c){
	if(confirm("정말 "+c+"하시겠습니까?") !== true)
		return false;
	
	$.get("<?php echo G5_BBS_URL;?>/ajax.asset_update.php", {wr_id:wr_id, wr_1:t}, function (e){
		location.reload();
	});
}

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
			alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
			return false;
		} else if (char_max > 0 && char_max < cnt)
		{
			alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
			return false;
		}
	}
	else if (!document.getElementById('wr_content').value)
	{
		alert("댓글을 입력하여 주십시오.");
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


function comment_delete()
{
	return confirm("이 에셋을 삭제하시겠습니까?");
}

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
// sns 등록
$(function() {
	$("#bo_vc_send_sns").load(
		"<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
		function() {
			save_html = document.getElementById('bo_vc_w').innerHTML;
		}
	);
});
<?php } ?>
</script>
