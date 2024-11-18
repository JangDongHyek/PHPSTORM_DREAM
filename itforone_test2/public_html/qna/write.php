<?php
include_once('./_head.php');

$is_notice = ($_GET['noti'] == 'y')? true : false;

if (!empty($idx)) {
	// 공지만 수정가능 하도록
	//$sql = "SELECT * FROM project_qna WHERE idx = '{$idx}' AND is_notice = 'Y'";
	//$row = sql_fetch($sql);

    // 211014. 공지 & 회사에서등록한cs글만 수정가능
    $sql = "SELECT * FROM project_qna WHERE idx = '{$idx}' AND (is_notice = 'Y' OR (is_notice = 'N' AND mid = 0))";
    $row = sql_fetch($sql);

    $is_notice = ($row['is_notice'] == 'Y')? true : false;
}

$manager_all =  $mdb->getAllInfo();

foreach ($manager_all as $key => $value) {
	$manager_no_list[] = $key;
	$manager_kr_list[] = $value['firm_name'];
	
}

?>





<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/summernote.min.css">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="./js/bootstrap.min.js"></script>
<script src="./js/summernote.min.js"></script>
<script src="./js/summernote-ko-KR.js"></script>
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

	if (document.frm.idx.value != "") {
		$('#editor').summernote('code', $("textarea[name=qa_content]").val());
	}

});

function uploadFile(input) {
	// 최대용량 체크
	var	max_size_mb = 10; //10mb
	var max_byte = max_size_mb * 1024 * 1024;
	if (typeof input == "undefined") return;

	var file_byte = input.files[0].size;
	
	if (file_byte > max_byte) {
		alert("최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
		$(input).attr("type", "hidden").attr("type", "file");
		$(input).val("");
		return false;
	}
}

function frmSubmit(f) {
	var url = "./write_update.php";
	var obj = {};
	var upload_flag = true;

	// 1) 첨부파일 업로드
	var file_cnt = 0;
	$.each($('input.frm_files'), function(index, el) {
		if ($(el).val() != "") file_cnt++;
	});

	// 글수정시 파일삭제 카운트체크
	if ($("input.frm_chk:checked").length > 0) file_cnt += $("input.frm_chk:checked").length;
    if (obj.idx != "") {
        // 글수정시 기존등록된 파일있으면 카운팅
        $.each($('input.chk_old_file'), function(index, el) {
            if ($(el).val() != "") file_cnt++;
        });
    }
	
	if (file_cnt > 0) {
		var frm = $(f)[0];
		var frm_data = new FormData(frm);
		upload_flag = false;

		$.ajax({
			url : url,
			type : "post",
			processData : false,
			contentType : false,
			data : frm_data,
			dataType: "json",
			async : false,
		}).done(function(data, textStatus, xhr) {
			if (data.result) {
				obj.qa_files_json = data.files;
				obj.del_files_json = data.del_files;
				upload_flag = true;
			}
		}).fail(function(data, textStatus, errorThrown) {
			console.log(data);
		});

		if (!upload_flag) {
			alert("첨부파일 등록에 실패하였습니다. 다시 시도해 주세요.");
			return false;
		}
	} 

	// 2) 문의등록/수정
	obj.idx = f.idx.value;
	obj.mid = f.mid.value;
	obj.mid_name = f.mid_name.value;
	obj.mid_in = f.mid_in.value;
	obj.qa_subject = f.qa_subject.value;
	//obj.qa_name = f.qa_name.value;
	//obj.qa_tel = f.qa_tel.value;
	//obj.qa_content = f.qa_content.value;
	obj.is_notice = f.is_notice.value;
	obj.is_admin = f.is_admin.value;
	obj.qa_content = $('#editor').summernote('code');	// summernote bind
	obj.mode = "write";

	$.ajax({
		type : "post",  
		url : url,
		data : obj,
		dataType : "json",  
	}).done(function(data, textStatus, xhr) {
		//console.log(data);
		if (data.result) {
			alert("등록이 완료되었습니다.");
			location.href = "./list.php";
		} else {
			alert("등록에 실패하였습니다. 다시 시도해 주세요.");
		}
	}).fail(function(data, textStatus, errorThrown) {
		//console.log(data);
		alert("등록에 실패하였습니다. 다시 시도해 주세요.");
	});

	return false;
}
</script>
<div class="inr">
<h1><?=$is_notice? "공지 등록" : "CS 등록"?></h1>

<div class="write_tbl">
	<form name="frm" autocomplete="off" onsubmit="return frmSubmit(this)">
	<input type="hidden" name="idx" value="<?=$idx?>">
    <input type="hidden" name="mid" value="0">
    <input type="hidden" name="is_notice" value="<?=$is_notice? "Y" : "N";?>"><!-- 공지여부 -->
    <input type="hidden" name="is_admin" value="Y"><!-- 관리자등록여부 -->
	<input type="hidden" name="mid_in" id="mid_in" value="">

	<dl>
		<dt></dt>
		<dd>
			<span class="subj"><i class="require">*</i>제목</span>
			<span class="conts"><input type="text" class="inputFull" name="qa_subject" value="<?=$row['qa_subject']?>" required maxlength="100"></span>
		</dd>
		
		<?if(!$is_notice){ ?>
			<dd>
				<span class="subj"><i class="require">*</i>업체명</span>
				<span class="conts"><input type="text" name="mid_name" id="mid_name" value="<?=$row['mid_name']?>"></span>
				<!--
				<span class="conts">
					<select name="mid_name" id="mid_name">
						<option value="0" <?if($mid=="0") echo "selected";?>>드림포원</option>
						<?php foreach ($manager As $key=>$val) { ?>
						<option value="<?=$key?>" <?php if($mid==$key) echo "selected";?>><?=$val['firm_name']?></option>						
						<?php } ?>
					</select>
				</span>
				-->
			</dd>
		<?} else { ?>
			<input type="hidden" name="mid_name" id="mid_name" value="">
		<?}?>

		<?/*
		<dd>
			<span class="subj">담당자명</span>
			<span class="conts"><input type="text" name="qa_name" value="<?=$row['qa_name']?>" maxlength="40"></span>
		</dd>
		<dd>
			<span class="subj">연락처</span>
			<span class="conts"><input type="text" name="qa_tel" value="<?=$row['qa_tel']?>" maxlength="40"></span>
		</dd>
		*/?>
		<dd>
			<span class="subj"><i class="require">*</i>내용</span>
			<span class="conts">
				<div id="editor"></div>
				<textarea name="qa_content" class="el_hide"><?=$row['qa_content']?></textarea>
			</span>
		</dd>
	</dl>

	<dl>
		<dt>첨부파일 <em>최대 10개까지 업로드 가능합니다. 파일 1개당 최대 10mb까지이며, 큰 파일은 압축해서 올려주세요.</em></dt>
		<dd>
			<? 
			$file_max_cnt = 10;
			$qa_files_json = json_decode($row['qa_files_json'], true);

			for ($i=0; $i<10; $i++) {
				$fid = "file{$i}";
			?>
			<div>
				<input type="file" name="qa_upload[<?=$i?>]" class="frm_files" onchange="uploadFile(this);">
				
				<? if (!empty($qa_files_json[$i])) { ?>
				<!-- 글수정시 업로드 파일이 존재하면 -->
				<input type="checkbox" name="qa_del_file[<?=$i?>]" id="<?=$fid?>" class="frm_chk" value="1">
				<label for="<?=$fid?>"><?=$qa_files_json[$i]['name']?> 파일삭제</label>
				<input type="hidden" name="qa_old_file[<?=$i?>]" value="<?=$qa_files_json[$i]['file']?>">
				<input type="hidden" name="qa_old_name[<?=$i?>]" value="<?=$qa_files_json[$i]['name']?>">
				<? }} ?>
			</div>
		</dd>
	</dl>

	<div class="btn_confirm">
		<button type="submit" class="btn_submit"><?=(empty($idx))? "등록완료" : "수정완료"?></button>
	</div>

	</form>
</div>


</div>

<script>

var manager_kr_list = <?php echo json_encode($manager_kr_list); ?>;
var manager_no_list = <?php echo json_encode($manager_no_list); ?>;

$(document).ready(function(){
  
	$("#mid_name").autocomplete({
	  source: manager_kr_list,
	  select: function(event, ui) {
		// ui.item.value는 선택된 항목의 값입니다.
		// jsArray에서 이 값의 인덱스를 찾습니다.
		var index = manager_kr_list.indexOf(ui.item.value);
		$("#mid_in").val(manager_no_list[index]);
	  }
	});
});


</script>

<?php
include_once('./_tail.php');
?>
