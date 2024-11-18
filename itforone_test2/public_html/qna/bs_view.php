<?php
$pid = "bs";
include_once("./_head.php");

if (!empty($idx)) {
	// 문의내용
	$row = sql_fetch("SELECT * FROM project_qna WHERE idx = '{$idx}' AND is_busan = 'Y'");
	if (!$row) alert("잘못된 정보입니다.");

	$file_de = json_decode($row['qa_files_json'], true);

	// 답변
	$result = sql_query("SELECT * FROM project_qna_reply WHERE pidx = '{$idx}' ORDER BY idx DESC");
	$result_cnt = sql_num_rows($result);
	$reply = array();
	for ($i = 0; $i < $result_cnt; $i++) {
		$reply[$i] = sql_fetch_array($result);
	}

	// 업체명
    $cp_name = $row['qa_tel'];

} else {
	alert("잘못된 정보입니다.");
}

// get파라미터
$params = "";
$query_str = explode("&", getenv("QUERY_STRING"));
foreach ($query_str AS $key=>$val) {
	$exp = explode("=", $val);
	if ($exp[0] == "idx") continue;

	$params .= (empty($params))? "?" : "&";
	$params .= $val;
}

?>
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/summernote.min.css">
<script src="./js/bootstrap.min.js"></script>
<script src="./js/summernote.min.js"></script>
<script src="./js/summernote-ko-KR.js"></script>

<h1>CS 상세</h1>

<div class="view_tbl">
	<?php if ($row['is_notice'] == "Y") { // 1) 공지사항 ?>
	<!-- 공지사항 -->
	<ul class="top_list">
		<li>
			<em>제목</em>
			<span><?=get_text($row['qa_subject'])?></span>
		</li>
		<li>
			<em>등록일</em>
			<span><?=$row['qa_regdate']?></span>
		</li>
		<li class="notice_cont">
			<div><?=nl2br($row['qa_content'])?></div>
		</li>
		<?php if (!empty($file_de) && count($file_de) > 0) { ?>
		<li class="file2">
			<em>첨부파일</em>
			<span>
				<?php foreach ($file_de AS $key=>$val) { ?>
				<input type="hidden" name="files[]" value="<?=$val['file']?>">
				<div><a href="<?=$val['src']?>" target="_blank"><?=$key+1?>. <?=$val['name']?></a></div>
				<?php } ?>
			</span>
		</li>
		<?php } ?>
	</ul>

	<?php } else { 						// 2) 일반문의글 ?>
	<!-- 문의내용 -->
	<ul class="top_list">
		<li class="half">
			<em>업체명</em>
			<span><?=$cp_name?></span>
		</li>
        <li class="half">
            <em>작성자명</em>
            <span><?=$row['qa_name']?>(<?=$row['is_busan_id']?>)</span>
        </li>
        <?/*
		<li class="half">
			<em>접수도메인</em>
			<span><?=$row['qa_domain']?></span>
		</li>
		<li class="half">
			<em>아이피</em>
			<span><?=$row['qa_ip']?></span>
		</li>
        */?>
		<li class="full">
			<em>제목</em>
			<span><?=get_text($row['qa_subject'])?></span>
		</li>
		<li class="half">
			<em>처리상태</em>
			<span><?=$row['qa_status']?></span>
		</li>
		<li class="half">
			<em>등록일</em>
			<span><?=$row['qa_regdate']?></span>
		</li>
	</ul>
	
	<div class="file">
		<h3>첨부파일</h3>
		<ul>
			<li>
				<span>
					<? if (empty($file_de)) { ?>
					<div class="empty">등록된 파일이 없습니다.</div>
					<? } else { ?>
					<?php foreach ($file_de AS $key=>$val) { ?>
					<input type="hidden" name="files[]" value="<?=$val['file']?>">
					<div><a href="<?=$val['src']?>" target="_blank"><?=$key+1?>. <?=$val['name']?></a></div>
					<?php }} ?>
				</span>
			</li>
		</ul>
	</div>
	<div class="cont">
		<h3>문의내용</h3>
		<div><?=nl2br($row['qa_content'])?></div>
	</div>

	<div class="reply_state">
		<em>답변상태</em>
		<span>
			<select name="qa_status" data-origin="<?=$row['qa_status']?>">
				<?php foreach ($qa_status_list AS $key=>$val) { ?>
				<option value="<?=$val?>" <?if ($row['qa_status']==$val) echo "selected"; ?>><?=$val?></option>
				<?php } ?>
			</select>
		</span>
	</div>
	<div class="worker_area">
		<em>작업담당</em>
		<span>
			<!-- 디자이너 -->
			<label for="dsgr">디자인</label>
			<select id="dsgr">
				<option value="">선택하세요</option>
				<?php 
				foreach ($designer_list AS $key=>$val) { 
					$_selected = ($val==$row['qa_dsgr'] || !empty($row['qa_dsgr']) && !in_array($row['qa_dsgr'], $designer_list))? "selected" : "";
				?>
				<option value="<?=$val?>" <?=$_selected?>><?=$val?></option>
				<?php }?>
			</select>
			<?php
			// 직접입력?
			$_class = "hide";
			if (!empty($row['qa_dsgr']) && !in_array($row['qa_dsgr'], $designer_list)) $_class = "show";
			?>
			<input type="text" id="dsgr_str" class="<?=$_class?>" value="<?=$row['qa_dsgr']?>">
			<!-- 프로그래머 -->
			<label for="prgr">프로그램</label>
			<select id="prgr">
				<option value="">선택하세요</option>
				<?php 
				foreach ($programmer_list AS $key=>$val) { 
					$_selected = ($val==$row['qa_prgr'] || !empty($row['qa_prgr']) && !in_array($row['qa_prgr'], $programmer_list))? "selected" : "";
				?>
				<option value="<?=$val?>" <?=$_selected?>><?=$val?></option>
				<?php }?>
			</select>
			<?php
			// 직접입력?
			$_class = "hide";
			if (!empty($row['qa_prgr']) && !in_array($row['qa_prgr'], $programmer_list)) $_class = "show";
			?>
			<input type="text" id="prgr_str" class="<?=$_class?>" value="<?=$row['qa_prgr']?>">

			<button type="button" onclick="setWorker();">변경</button>
		</span>
	</div>
    <div class="worker_area">
        <em>확인요망</em>
        <span>
            <label><input type="checkbox" name="rep_check" value="Y" <?=$row['rep_check']=="Y"? "checked" : ""?>> 작업전 담당자 확인필요</label>
        </span>
    </div>

	<!-- 답변 -->
	<dl class="reply_area">
		<dt>답변</dt>
		<dd>
			<?php if (count($reply) == 0) { ?>
			<div class="empty">등록된 답변이 없습니다.</div>
			<?
			} else {
				foreach ($reply As $key=>$val) {
			?>
			<div class="box">
				<div class="date"><span><?=$val['regdate']?></span></div>
				<div class="conts"><?=nl2br($val['reply'])?></div>
				<ul class="reply_btn">
					<li><button type="button" onclick="replyModify(<?=$val['idx']?>)">수정</button></li>
					<li><button type="button" onclick="replySubmit('', 'delete', <?=$val['idx']?>)">삭제</button></li>
				</ul>	
			</div>
			<?php }} ?>
		</dd>
	</dl>
	<dl>
		<dt>답변등록</dt>
		<dd class="comment">
			<form name="rFrm" onsubmit="return replySubmit(this, 'regist')" autocomplete="off">
				<input type="hidden" name="pidx" value="<?=$idx?>">
				<div id="editor" class="editor"></div>
				<textarea name="reply" class="el_hide"></textarea>
				<button type="submit" class="btn">완료</button>
			</form>
		</dd>
	</dl>
	<?php } ?>

	<div class="btn_confirm">
		<ul class="area_btn">
			<li><button type="button" class="btn_submit" onclick="location.href='./bs_write.php?idx=<?=$idx?>'">수정</button></li>
			<li><button type="button" class="btn_list delete" onclick="deleteQst(<?=$idx?>)">삭제</button></li>
		</ul>
		<button type="button" class="btn_list" onclick="location.href='./bs_list.php<?=$params?>'">목록</button>
	</div>

</div>


<script>
$(function() {
	// summernote
	$('#editor').summernote({
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
	});

	/*
	if (document.rfrm.Pidx.value != "") {
		$('#editor').summernote('code', $("textarea[name=qa_content]").val());
	}
	*/

});

// 작업담당자 변경
var worker = document.querySelectorAll('.worker_area select');
if (worker.length > 0) {
	for (var i=0; i<worker.length; i++) {
		worker[i].addEventListener('change', function(event) {
			var res = event.target.value;
			var field = event.target.nextElementSibling;

			if (res == "직접입력") {
				field.classList.remove('hide');
				field.classList.add('show');
				field.focus();
			} else {
				field.classList.remove('show');
				field.classList.add('hide');
				field.value = "";
			}
		});
	}
}
function setWorker() {
	var obj = {};
	obj.mode = 'wrkr';
	obj.idx = document.rFrm.pidx.value;
	obj.qa_dsgr = document.getElementById("dsgr").value;
	obj.qa_prgr = document.getElementById("prgr").value;

	if (obj.qa_dsgr == "직접입력") obj.qa_dsgr = document.getElementById("dsgr_str").value;
	if (obj.qa_prgr == "직접입력") obj.qa_prgr = document.getElementById("prgr_str").value;

	$.ajax({
		type : "post",  
		url : "./ajax.reply_upate.php",
		data : obj,
		dataType : "json",  
	}).done(function(data, textStatus, xhr) {
		if (data.result) location.reload(); //alert("변경되었습니다.");
		else alert(err_msg);
	}).fail(function(data, textStatus, errorThrown) {
		alert(err_msg);
	}).always(function() {
		//location.reload();
	});
}

// 답변상태변경
var selStatus = document.querySelector('select[name=qa_status]');
if (selStatus != null) {
	selStatus.addEventListener('change', function(event) {
		var res = event.target.value;
		var origin_status = event.target.dataset.origin;

		if (res != origin_status) {
			//if (confirm("답변상태를 "+ res + "(으)로 변경하시겠습니까?")) {
				var err_msg = "답변상태 변경에 실패하였습니다. 다시 시도해 주세요.";

				$.ajax({
					type : "post",  
					url : "./ajax.reply_upate.php",
					data : {mode: 'status', idx: document.rFrm.pidx.value, val: res},
					dataType : "json",  
				}).done(function(data, textStatus, xhr) {
					if (data.result) location.reload(); //alert("변경되었습니다.");
					else alert(err_msg);
				}).fail(function(data, textStatus, errorThrown) {
					alert(err_msg);
				}).always(function() {
					//location.reload();
				});

			//} else {
			//	var opts = selStatus.options;
			//	for (var i=0; i<opts.length; i++) {
			//		if (opts[i].value == origin_status) opts[i].selected = true;
			//	}
			//}
		}
	});
}

// 답변등록/수정 폼오픈
var child = "";
function replyModify(idx) {
	var pop_w = 700,
		pop_h = 600,
		left = Math.floor((window.innerWidth - pop_w) / 2),
		top = Math.floor((window.innerHeight - pop_h) / 2);

	child = window.open("./view_reply_form.php?idx="+idx, "답변수정", "width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
}



// 답변등록/수정/삭제
function replySubmit(f, mode, idx) {
	var obj = {};
	var err_msg = "";
	var confirm_msg = "";

	obj.mode = mode;

	switch (mode) {
		case "regist" :
			err_msg = "답변 등록에 실패하였습니다. 다시 시도해 주세요.";
			confirm_msg = "답변을 등록 하시겠습니까?";
			obj.pidx = f.pidx.value;
			obj.reply = $('#editor').summernote('code'); //f.reply.value;
			break;
		
		case "delete" :
			err_msg = "답변 삭제에 실패하였습니다. 다시 시도해 주세요.";
			confirm_msg = "답변을 삭제 하시겠습니까?";
			obj.idx = idx;
			break;

		case "modify" :
			err_msg = "답변 수정에 실패하였습니다. 다시 시도해 주세요.";
			confirm_msg = "답변을 수정 하시겠습니까?";
			obj.idx = f.idx.value;
			obj.reply = $('#modify_editor').summernote('code'); //f.reply.value;
			break;
	}

	if (confirm_msg != "" && !confirm(confirm_msg)) return false;

	$.ajax({
		type : "post",  
		url : "./ajax.reply_upate.php",
		data : obj,
		dataType : "json",  
	}).done(function(data, textStatus, xhr) {
		//if (data.result) alert("완료 되었습니다.");
		//else alert(err_msg);
		if (!data.result) alert(err_msg);

	}).fail(function(data, textStatus, errorThrown) {
		alert(err_msg);

	}).always(function() {
		if (mode == "modify") child.close();
		location.reload();
	});

	return false;
}

// 문의삭제
function deleteQst(idx) {
	if (!confirm("해당 질문을 삭제하시겠습니까? 삭제된 데이터는 복구되지 않습니다.")) return false;
	var err_msg = "삭제에 실패하였습니다. 다시 시도해 주세요.";
	var obj = {mode: 'delete', idx: idx};
	var del_file = [];

	$.each($('input[name="files[]"]'), function(index, el) {
		del_file.push($(el).val());
	});
	obj.del_file = del_file;

	$.ajax({
		type : "post",  
		url : "./write_update.php",
		data : obj,
		dataType : "json",  
	}).done(function(data, textStatus, xhr) {
		//console.log(data);
		if (data.result) {
			//alert("삭제가 완료되었습니다.");
			history.replaceState({data: "replaceState"}, "", g5_url + "/qna/bs_list.php");
			location.reload();
		} else {
			alert(err_msg);
		}
	}).fail(function(data, textStatus, errorThrown) {
		console.log(data);
		alert(err_msg);
	}).always(function() {
	});
}

// 확인요망 체크
document.querySelector("input[name=rep_check]").addEventListener('change', function(e) {
    console.log(e, this, this.checked);
    let obj = {mode: 'checked', idx: document.rFrm.pidx.value};
    obj.rep_check = (this.checked)? "Y" : "N";

    $.ajax({
        type : "post",
        url : "./ajax.reply_upate.php",
        data : obj,
        dataType : "json",
    }).done(function(data, textStatus, xhr) {
        if (data.result) location.reload(); //alert("변경되었습니다.");
        else alert('변경에 실패했습니다.');
    }).fail(function(data, textStatus, errorThrown) {
        alert('변경에 실패했습니다.');
    }).always(function() {
        //location.reload();
    });
});
</script>

<?
include_once("./_tail.php");

?>