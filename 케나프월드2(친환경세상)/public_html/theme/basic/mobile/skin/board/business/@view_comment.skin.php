<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>

<div id="review" class="boxin col-xs-12">
	<div id="review_list">
		<?php 
		$sql = " select * from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 and mb_id = '{$member['mb_id']}'";
		$com = sql_fetch($sql);
		$file = get_file($bo_table, $com['wr_id']);
		if($is_member){
		?>
		<div id="review_wirte" style="<?php if($com) echo "display:none;";?>">
			<form name="fviewcomment" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $com?"cu":"c";?>" id="w">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $com['wr_id'] ?>" id="comment_id">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="is_good" value="">
			<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $com['wr_1']?$com['wr_1']:"1";?>">
			<div>
				<?php 
				for($j=0; $j<5; $j++){ 
					if($j < $com['wr_1'] || $j == 0)
						echo "<i class=\"fa fa-star fa-2x write_star\"></i>";
					else
						echo "<i class=\"fa fa-star-o fa-2x write_star\"></i>";
				} 
				?>
			</div>
			<?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
			<textarea id="wr_content" name="wr_content" maxlength="1000" required class="agree-text required" title="내용" 
			<?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $com['wr_content'];  ?></textarea>
			<?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
			<script>
			$(document).on("keyup change", "textarea#wr_content[maxlength]", function() {
				var str = $(this).val()
				var mx = parseInt($(this).attr("maxlength"))
				if (str.length > mx) {
					$(this).val(str.substr(0, mx));
					return false;
				}
			});

			$(function (){
				$(".write_star").click(function (){
					var $index = parseInt($(this).index(".write_star") + 1);
					for(var i=0; i<$(".write_star").length; i++){
						if(i < $index)
							$(".write_star").eq(i).removeClass().addClass("fa fa-star fa-2x write_star");
						else
							$(".write_star").eq(i).removeClass().addClass("fa fa-star-o fa-2x write_star");
					}
					$("#wr_1").val($index);
				});
			});
			</script>
			<div style="padding-bottom:10px;">
                <input type="file" name="bf_file[]" title="파일첨부 1 : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input" style="width:100%; display:block !important;">
                <?php if($file[0]['file']) { ?>
                <input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1"> <label for="bf_file_del0"><?php echo $file[0]['source'].'('.$file[0]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
			</div>

			<div class="btn_confirm">
				<input type="submit" id="btn_submit" class="btn btn-danger btn-sm" value="리뷰<?php echo $com?"수정":"등록";?>" style="width:100%;">
			</div>

			</form>
		</div>
		<?php } ?>
		<?php
		$cmt_amt = count($list);
		for ($i=0; $i<$cmt_amt; $i++) {
			$comment_id = $list[$i]['wr_id'];
			$cmt_depth = ""; // 댓글단계
			$cmt_depth = strlen($list[$i]['wr_comment_reply']) * 20;
			$comment = $list[$i]['content'];

			$comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
			$cmt_sv = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
		 ?>
		 <div class="clearfix"> </div>
		<div class="review" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;border-top-color:#e0e0e0"<?php } ?>>
			<div class="info row" style="width:100%;">
				<h2 class="nickname"><?php echo $list[$i]['name'] ?></h2><span class="w_date"><?php echo $list[$i]['datetime'] ?></span>
				<?php if($cmt_depth == 0){ ?>
				<div class="star">
					<?php 
					for($j=0; $j<5; $j++){ 
						if($j < $list[$i]['wr_1'])
							echo "<i class=\"fa fa-star\"></i>";
						else
							echo "<i class=\"fa fa-star-o\"></i>";
					} 
					?>
				</div>
				<?php } ?>
				<?php 
				// 리뷰 수정, 삭제
				if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
					$query_string = clean_query_string($_SERVER['QUERY_STRING']);

					if($w == 'cu') {
						$sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
						$cmt = sql_fetch($sql);
						if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
							$cmt['wr_content'] = '';
						$c_wr_content = $cmt['wr_content'];
					}

					$c_edit_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=cu#review_wirte';
					$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

					if($thumb['src'])
						$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'" class="img" style="width:100%;">';
					else
						$img_content = '';
				?>
				<div>
					<?php echo $img_content;?>
				</div>
				<div>
					<?php if ($list[$i]['mb_id'] == $member['mb_id']) { ?>
					<a href="" onclick="return <?php if(!$list[$i]['wr_comment_reply']) echo "setComment()"; else echo "comment_box('".$list[$i]['wr_id']."', 'cu')";?>" style="cursor:pointer;">수정</a>
					<?php } ?>
					<?php if($is_member){ ?>
					<a href="" onclick="return comment_box('<?php echo $list[$i]['wr_id'];?>', 'c');">답변</a>
					<?php } ?>
					<?php if ($list[$i]['is_del'] || $list[$i]['mb_id'] == $member['mb_id'])  { ?>
					<a href="<?php echo $list[$i]['del_link'];  ?>" onclick="return comment_delete();">삭제</a>
					<?php } ?>
				</div>
				<?php } /* 리뷰 수정, 삭제 */?>
				<div class="con">
					<?php echo $comment ?>
				</div>
			</div>
		</div><!--review-->
		<!-- 답변 -->
		<?php if($is_member){ ?>
		<div id="rep_wirte<?php echo $list[$i]['wr_id'];?>" class="rep_wirte" style="display:none;">
			<form name="fviewcomment" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
			<input type="hidden" name="w" id="w_<?php echo $list[$i]['wr_id'];?>" value="c">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $list[$i]['wr_id'] ?>" id="comment_id">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="is_good" value="">
			<?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
			<textarea name="wr_content" maxlength="1000" required class="agree-text required" title="내용" 
			<?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?> style="width:100%; height:70px; border: 1px solid #e9e9e9;"><?php echo $c_wr_content;  ?></textarea>
			<?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
			<script>
			$(document).on("keyup change", "textarea#wr_content[maxlength]", function() {
				var str = $(this).val()
				var mx = parseInt($(this).attr("maxlength"))
				if (str.length > mx) {
					$(this).val(str.substr(0, mx));
					return false;
				}
			});

			$(function (){
				$(".write_star").click(function (){
					var $index = parseInt($(this).index(".write_star") + 1);
					for(var i=0; i<$(".write_star").length; i++){
						if(i < $index)
							$(".write_star").eq(i).removeClass().addClass("fa fa-star fa-2x write_star");
						else
							$(".write_star").eq(i).removeClass().addClass("fa fa-star-o fa-2x write_star");
					}
					$("#wr_1").val($index);
				});
			});
			</script>

			<div class="btn_confirm">
				<input type="submit" id="btn_submit_<?php echo $list[$i]['wr_id'];?>" class="btn btn-danger btn-sm" value="답변등록" style="width:100%;">
			</div>
			</form>
		</div>
		<?php } ?>
		<?php } ?>
	</div><!--review_list-->
</div><!--boxin-->
<?php if ($is_comment_write) {
    if($w == '')
        $w = 'c';
?>

<script>
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
    f.wr_content.value = f.wr_content.value.replace(pattern, "");
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
    else if (!f.wr_content.value)
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

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function comment_delete()
{
    return confirm("이 댓글을 삭제하시겠습니까?");
}

function comment_box(wr_id, t)
{ 
	$("#w_"+wr_id).val(t);
	
	if(t=="cu"){
		$("#btn_submit_"+wr_id).val("답변수정");
	}else{
		$("#btn_submit_"+wr_id).val("답변등록");
	}

	var bk = true;
	if($("#rep_wirte"+wr_id).css("display") != "none")
		bk = false;

	$(".rep_wirte").css("display", "none");
	
	if(bk)
		$("#rep_wirte"+wr_id).css("display", "block");
	
	var h = $("#review").height() + 10;
	$("#swiper-content02, #review_slide").animate({ height:h }, 100);

	return false;
}

function setComment(){
	if($("#review_wirte").css("display") == "none")
		$("#review_wirte").css("display", "block");
	else
		$("#review_wirte").css("display", "none");

	var h = $("#review").height() + 10;
	$("#swiper-content02, #review_slide").animate({ height:h }, 100);
	return false;
}
</script>
<?php } ?>
<!-- } 댓글 쓰기 끝 -->