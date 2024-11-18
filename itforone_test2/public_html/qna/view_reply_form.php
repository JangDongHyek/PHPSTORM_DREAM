<?php
$tab_hide = true;
include_once("./_head.php");

if($isIn == "T"){
	$row = sql_fetch("SELECT * FROM project_qna_reply2 WHERE idx = '{$idx}'");
} else {
	$row = sql_fetch("SELECT * FROM project_qna_reply WHERE idx = '{$idx}'");
}



?>
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/summernote.min.css">
<script src="./js/bootstrap.min.js"></script>
<script src="./js/summernote.min.js"></script>
<script src="./js/summernote-ko-KR.js"></script>
<script>
$(function() {
	// summernote
	$('#modify_editor').summernote({
		height: 300, //(mobilecheck())? 150 : 300, 
		lang: 'ko-KR',
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'underline', 'clear']],
			//['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['insert', ['link', 'picture']],
			['view', ['fullscreen', 'undo', 'redo']],
		],
		//placeholder: '상세내용을 입력해 주세요',

	}).summernote('code', $("#modify_reply").val());

});


// 답변등록/수정/삭제
function replySubmit(f) {
	var obj = {};
	var err_msg = "";
	var confirm_msg = "";

	obj.mode = 'modify';
	err_msg = "답변 수정에 실패하였습니다. 다시 시도해 주세요.";
	confirm_msg = "답변을 수정 하시겠습니까?";
	obj.idx = f.idx.value;
	obj.isIn = f.isIn.value;
	obj.reply = $('#modify_editor').summernote('code'); //f.reply.value;
	obj.reply2 = $('#modify_editor').summernote('code'); //f.reply.value;
	console.log(obj);
			

	if (confirm_msg != "" && !confirm(confirm_msg)) return false;

	$.ajax({
		type : "post",  
		url : "./ajax.reply_upate.php",
		data : obj,
		dataType : "json",  
	}).done(function(data, textStatus, xhr) {
		if (data.result) alert("완료 되었습니다.");
		else alert(err_msg);

	}).fail(function(data, textStatus, errorThrown) {
		alert(err_msg);

	}).always(function() {
		opener.location.reload();
		window.open('about:blank','_self').close();
	});

	return false;
}
</script>

<div class="reply_area">
<h1>답변수정</h1>
<form name="rFrm" onsubmit="return replySubmit(this)" autocomplete="off">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<input type="hidden" name="isIn" value="<?=$isIn?>">
	<div id="modify_editor" class="editor"></div>
	<textarea name="reply" id="modify_reply" required class="el_hide"><?=$row['reply']?></textarea>
	<button type="submit" class="btn-submit">완료</button>
</form>
</div>

<?php
include_once("./_tail.php");
?>