<?php 
include_once("./_head.php");

if (!empty($idx)) {
	// 문의내용
	$row = sql_fetch("SELECT * FROM project_qna WHERE idx = '{$idx}' AND is_busan != 'Y'");
	if (!$row) alert("잘못된 정보입니다.");

	$file_de = json_decode($row['qa_files_json'], true);

	// 답변
	$result = sql_query("SELECT * FROM project_qna_reply WHERE pidx = '{$idx}' ORDER BY idx DESC");
	$result_cnt = sql_num_rows($result);
	$reply = array();
	for ($i = 0; $i < $result_cnt; $i++) {
		$reply[$i] = sql_fetch_array($result);
	}


	// 내부 코멘트
	$result = sql_query("SELECT * FROM project_qna_reply2 WHERE pidx = '{$idx}' ORDER BY idx DESC");
	$result_cnt2 = sql_num_rows($result);
	$reply2 = array();
	for ($i = 0; $i < $result_cnt2; $i++) {
		$reply2[$i] = sql_fetch_array($result);
	}

	// 업체명
	if ($row['mid'] == "0")  {

		if(!empty($row['mid_in'])){
			$manager = $mdb->getInfo(array($row['mid_in']));
		}
		$mngr = $manager[$row['mid_in']];

		$cp_name = (!empty($mngr['site_name'])) ? $mngr['site_name'] : $mngr['firm_name'];
		if($cp_name == "") {
			$cp_name = "드림포원";
		}
		$cp_name = "(내부) ".$cp_name;
	} else {
		$mngr = $manager[$row['mid']];
		$cp_name = (!empty($mngr['site_name']))? $mngr['site_name'] : $mngr['firm_name'];
	}
	$com_code = $mngr['com_code'];

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
		<li class="full">
			<em>업체명</em>
			<span><?=$cp_name?></span>
		</li>
		<li class="half">
			<em>접수도메인</em>
			<span><?=$row['qa_domain']?></span>
		</li>
		<li class="half">
			<em>아이피</em>
			<span><?=$row['qa_ip']?></span>
		</li>
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
		<li class="half">
			<em>담당자명</em>
			<span><?=$row['qa_name']?></span>
		</li>
		<li class="half">
			<em>연락처</em>
			<span><?=$row['qa_tel']?></span>
		</li>	
		<? if(!empty($mngr)) { ?>
			<li class="half">
				<em>매니저URL</em>
				<span><a href="<?='http://manager.lets080.co.kr/manager_view.php?no='.$mngr['no']?>" target="_blank">매니저 바로가기</a></span>
			</li>	
			<li class="half">
				<em>매니저 비밀 <button id="copyButton" style="color:#000">복사</button></em>
				<span id="com_code" style="background-color:#fff; color:#fff;"><?=$com_code[13].$com_code[11].$com_code[9].$com_code[7];?></span>
			</li>
		<?}?>
	
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

	<? if(!empty($mngr)) { ?>
		<div class="reply_state">
			<em>매니저URL</em>
			<span class="confirm"><a href="<?='http://manager.lets080.co.kr/manager_view.php?no='.$mngr['no']?>" target="_blank">매니저 바로가기</a></span>	
			<em>매니저 비밀 </em>
			<span class="confirm" style="background-color:#fff; color:#fff;"><?=$com_code[13].$com_code[11].$com_code[9].$com_code[7];?></span>
			<button id="copyButton2" style="color:#000">복사</button>
		</div>
	<?}?>

	<div class="reply_state">
		<em>답변상태</em>
		<span>
			<select name="qa_status" data-origin="<?=$row['qa_status']?>">
				<?php foreach ($qa_status_list AS $key=>$val) { ?>
				<option value="<?=$val?>" <?if ($row['qa_status']==$val) echo "selected"; ?>><?=$val?></option>
				<?php } ?>
			</select>
		</span>
        <span class="confirm">
            <label for="work_check"><input type="checkbox" id="work_check" name="work_check" value="Y" <?=$row['work_check']=="Y"? "checked" : ""?>> 작업 검수요청</label>
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
			$btn_hide = "display:none";
			if (!empty($row['qa_dsgr']) && !in_array($row['qa_dsgr'], $designer_list)) {
				$_class = "show";
				$btn_hide = "";
			}
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
			if (!empty($row['qa_prgr']) && !in_array($row['qa_prgr'], $programmer_list)) {
				$_class = "show";
				$btn_hide = "";
			}
			?>
			<input type="text" id="prgr_str" class="<?=$_class?>" value="<?=$row['qa_prgr']?>">

			<button type="button" id="btn_change" onclick="setWorker();" style="<?=$btn_hide?>">변경</button>
		</span>
	</div>
    <div class="worker_area">
        <em>확인요망</em>
        <span>
            <label><input type="checkbox" name="rep_check" value="Y" <?=$row['rep_check']=="Y"? "checked" : ""?>> 작업전 담당자 확인필요</label>
        </span>
    </div>
<div class="cont layout">
	<!-- 내부 코멘트 -->
	<div class="commentWrap incomment">
		<h3 >내부 코멘트</h3>
		<div class="layout">
			<dl class="reply_area">
				<dt>내부 코멘트</dt>
				<dd>
					<?php if (count($reply2) == 0) { ?>
					<div class="empty">등록된 답변이 없습니다.</div>
					<?
					} else {
						foreach ($reply2 As $key=>$val) {
							$mb = get_member($val['mb_id']);
					?>
					<div class="box">
						<h6><?=$mb['mb_name']?></h6>
						<div class="date"><span><?=$val['regdate']?></span></div>
						<div class="conts"><?=nl2br($val['reply'])?></div>
						<ul class="reply_btn">
							<li><button type="button" onclick="replyModify(<?=$val['idx']?>, 'T')">수정</button></li>
							<li><button type="button" onclick="replySubmit('', 'delete', <?=$val['idx']?>, 'T')">삭제</button></li>
						</ul>	
					</div>
					<?php }} ?>
				</dd>
			</dl>
			<dl>
				<dt>내부 코멘트등록</dt>
				<dd class="comment">
					<form name="rFrm2" onsubmit="return replySubmit(this, 'regist','', 'T')" autocomplete="off">
						<input type="hidden" name="pidx" value="<?=$idx?>">
						<div id="editor2" class="editor"></div>
						<textarea name="reply" class="el_hide"></textarea>
						<button type="submit" class="btn">등록</button>
					</form>
				</dd>
			</dl>
		</div>
	</div>

	<!-- 답변 -->
	<div class="commentWrap outcomment">
	<h3 >업체 답변</h3>
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
	</div>
	</div>
	<?php } ?>

	<div class="btn_confirm">
		<? if ($row['is_notice'] == "Y" || ($row['is_notice'] == "N" && $row['is_admin'] == "Y")) { // 공지or회사등록글이면 수정삭제 ?>
		<ul class="area_btn">
			<li><button type="button" class="btn_submit" onclick="location.href='./write.php?idx=<?=$idx?>'">수정</button></li>
			<li><button type="button" class="btn_list delete" onclick="deleteQst(<?=$idx?>)">삭제</button></li>
		</ul>
		<? } ?>
		<button type="button" class="btn_list" onclick="location.href='./list.php<?=$params?>'">목록</button>
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

	$('#editor2').summernote({
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

					$("#btn_change").show();
				} else {
					setWorker();
					field.classList.remove('show');
					field.classList.add('hide');
					field.value = "";

					$("#btn_change").hide();
				}
			});
		}
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


	// 확인요망 체크
	document.querySelector("input[name=rep_check]").addEventListener('change', function(e) {
		// console.log(e, this, this.checked);
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

	// 작업검수요청 체크
	document.querySelector("input[name=work_check]").addEventListener('click', function(e) {
		let obj = {mode: 'workChecked', idx: document.rFrm.pidx.value};
		obj.work_check = (e.target.checked)? "Y" : "N";

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


    $("#copyButton, #copyButton2").click(function(){
        // 텍스트를 복사하기 위한 임시 텍스트 영역을 생성합니다.
        var $temp = $("<textarea>");
        $("body").append($temp);

        // span에서 텍스트를 가져와 임시 텍스트 영역에 설정합니다.
        $temp.val($("#com_code").text()).select();

        // 텍스트를 클립보드에 복사합니다.
        document.execCommand("copy");

        // 임시 텍스트 영역을 제거합니다.
        $temp.remove();
    });

});


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



// 답변등록/수정 폼오픈
var child = "";
function replyModify(idx, isIn="F") {
	var pop_w = 700,
		pop_h = 600,
		left = Math.floor((window.innerWidth - pop_w) / 2),
		top = Math.floor((window.innerHeight - pop_h) / 2);

	child = window.open("./view_reply_form.php?isIn="+isIn+"&idx="+idx, "답변수정", "width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
}

// 답변등록/수정/삭제
function replySubmit(f, mode, idx, isIn="F") {
	var obj = {};
	var err_msg = "";
	var confirm_msg = "";

	obj.mode = mode;
	obj.isIn = isIn;

	switch (mode) {
		case "regist" :
			err_msg = "답변 등록에 실패하였습니다. 다시 시도해 주세요.";
			confirm_msg = "답변을 등록 하시겠습니까?";
			obj.pidx = f.pidx.value;
			obj.reply = $('#editor').summernote('code'); //f.reply.value;
			obj.reply2 = $('#editor2').summernote('code'); //f.reply.value;
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
			obj.reply2 = $('#modify_editor2').summernote('code'); //f.reply.value;
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
function deleteQst(idx, isIn="F") {
	if (!confirm("해당 질문을 삭제하시겠습니까? 삭제된 데이터는 복구되지 않습니다.")) return false;
	var err_msg = "삭제에 실패하였습니다. 다시 시도해 주세요.";
	var obj = {mode: 'delete', idx: idx, "isIn":isIn};
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
			history.replaceState({data: "replaceState"}, "", g5_url + "/qna/list.php");
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

</script>

<?
include_once("./_tail.php");

?>