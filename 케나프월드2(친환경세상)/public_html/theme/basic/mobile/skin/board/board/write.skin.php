<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">
    <h2 id="container_title"><?php echo $g5['title'] ?></h2>

    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<div class="div_form">
		<?php if ($is_category) { ?>
		<dl>
			<dd>
				<select name="ca_name" id="ca_name" required class="required" >
					<option value="">선택하세요</option>
					<?php echo $category_option ?>
				</select>
			</dd>
		</dl>
		<?php } ?>
		<dl>
			<dd>
				<?php if($is_adm && ($bo_table == "facebook" || $bo_table == "lost" || $bo_table == "event")){ ?>
				<input type="checkbox" name="wr_main" id="wr_main" value="1" <?php if($wr_main) echo "checked";?>><label for="wr_main"> 메인화면</label><br/><?php echo $wr_main;?>
				※ ) 메인화면은 각 게시판 마다 1개만 지정할 수 있습니다.
				<br/>
				<?php } ?>
				<input type="text" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>" class="frm_input required" required placeholder="제목을 작성해주세요." style="width:100%;">
			</dd>
		</dl>
		<dl>
			<dd>
				<textarea id="wr_content" name="wr_content" placeholder="내용을 작성해주세요." class="required" required><?php echo $content;?></textarea>
			</dd>
		</dl>
		<dl class="row">
		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
			<dd class="col-xs-6">
				<label class="btn btn-default btn-file" style="display:inline-block;">
					파일선택 <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input" style="display:none;">
				</label>
				<p id="file_font_<?php echo $i;?>" class="file_font">
				<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> 
					<label for="bf_file_del<?php echo $i ?>" style="height:auto; margin-bottom: 0;">파일 삭제</label>
				<?php } ?>
				</p>
			</dd>
		<?php } ?>
		</dl>
	</div>
	
	<?php if ($is_guest) { //자동등록방지 ?>
	<?php echo $captcha_html ?>
	<?php } ?>

    <div class="text-center" style="padding:10px;">
        <input type="submit" value="작성완료" id="btn_submit" class="btn btn-primary btn-sm" accesskey="s">
    </div>
    </form>
</section>

<script>

$(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$('[name="bf_file[]"]').on('fileselect', function(e, f, l) {
	console.log(l);
	$(this).parents("dd.col-xs-6").find("p.file_font").html(l);
});

<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
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

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

     <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>
