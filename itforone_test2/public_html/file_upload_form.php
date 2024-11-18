<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <script src="http://map.everywhereyougo.co.kr/js/jquery-1.9.1.min.js"></script>
  <title>Document</title>
 </head>
 <body>
  <form name="form" method="post" action="./file_upload_form_update.php" enctype="multipart/form-data">
  <div class="img_add"><button type="button" class="btn" id="btn_add_file">파일첨부</button></div>
  <div id="bf_prev_wrap" style="width:100%;height:500px"></div>
  <button type="submit">전송</button>
  </form>
  <script type="text/javascript">
  var sel_files = [],
		file_idx =0;
	$(function(){
		// 파일업로드 클릭
		$("#btn_add_file").on("click", function() {
			var leng = $("input[name='bf_file[]']").length,
				upload = $('<input type="file" name="bf_file[]" class="frm_file el_hidden" id="bf_file'+ file_idx +'" accept="image/*" multiple>');
			console.log(leng);
			if (leng < 5) {
				$(".img_add").after(upload);
				upload.trigger('click');
				file_idx++;

			} else {
				alert("11");
				
				return false;
			}
		});

	});
	$(document).on("change", "input[name='bf_file[]']", function(e) {
		fnFileUpload(e, this);
	});
	// 파일업로드 미리보기
	function fnFileUpload(e, el) {
		var files = e.target.files,
			files_arr = Array.prototype.slice.call(files),
			index = sel_files.length,
			prev_wrap = $("#bf_prev_wrap"),
			el_id = $(el).attr("id");

		files_arr.forEach(function(f) {
			if (!f.type.match("image.*")) {
				alert("이미지만 업로드 가능합니다.");
				
				return;
			}
			if (f.size > 5242880) {
				alert("이미지의 최대 용량(5MB)을 초과하여 등록이 불가능 합니다.");
				return;
			}
			sel_files.push(f);
			var reader = new FileReader();
			reader.onload = function(e) {
				var html = "<div class='prev_area pa"+ index +"'>";
				html += "<button type='button' class='btn_del' onclick=\"fnFileDel('w', "+ index +", '"+ el_id +"');\"><i class='fas fa-times'></i></button>";
				html += "<div class='img_bd'>";
				html += "<img src='"+ e.target.result +"' data-file='"+ f.name +"'>";
				html += "</div>";
				html += "</div>";

				prev_wrap.append(html);
				index++;
			}
			reader.readAsDataURL(f);
		});
	}

	// 파일업로드 삭제
	function fnFileDel(mode, idx, el_id) {
		if (mode == "w") {
			sel_files.splice(idx, 1);
			$("div.pa" + idx).remove();
			$("#"+el_id).remove();
		} else {
			$("div.pau" + idx).remove();
			$("#bf_file_del" + idx).prop("checked", true);
		}
	}
  </script>
 </body>
</html>
