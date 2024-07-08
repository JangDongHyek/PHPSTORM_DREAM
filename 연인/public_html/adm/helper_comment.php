<?
/****************************************
$cmt_mode
- member : 회원관리 - 소개이력, 매칭
- calc : 정산현황
****************************************/

$sql_common = " FROM g5_helper_comment A
				WHERE co_page = '{$cmt_mode}' ";

if ($cmt_mode == "member") {
	$sql_common .= " AND A.mb_id = '{$mb_id}' ";	//AND A.co_is_del = '0' 
	$sql_limit = "";

} else if ($cmt_mode == "calc") {
	if ($t == "1") {
		$sql_common .= " AND co_fix_date = '{$s_date}' ";
	} else {
		$set_month = $s_year."-".sprintf('%02d', $s_month);
		$sql_common .= " AND co_fix_date LIKE '{$set_month}%' ";
	}

	$sql = " SELECT COUNT(*) AS cnt {$sql_common} ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];
	$list_rows = 30;											// 한페이지 글 개수
	$total_page = ceil($total_count / $list_rows);				// 전체페이지
	if ((int)$page > $total_page) $page = $total_page;

	if ($page < 1) $page = 1;
	$from_record = ($page - 1) * $list_rows;					// 시작 열
	$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가
	$list_page_rows = 10;										// 한블록 개수
}

// 원댓글 내림차순, 대댓글 오름차순
$c_sql = "SELECT A.*, (SELECT mb_name FROM g5_member WHERE mb_id = A.helper_id) AS helper_name 
		 {$sql_common} 
		 ORDER BY A.p_idx DESC, A.idx ASC 
		 {$sql_limit};";

$c_result = sql_query($c_sql);
$c_result_cnt = sql_num_rows($c_result);

$comment_list = array();

for ($i = 0; $i < $c_result_cnt; $i++) {
	$comment_list[$i] = sql_fetch_array($c_result);
}

?>

<? if ($cmt_mode == "calc") { ?>
<div id="popup_wrap">
<? } ?>

<p>헬퍼 코멘트</p>
<div id="comment_wrap">
	<!-- 입력폼 -->
	<div class="frm">
		<form name="fComment" id="fComment">
			<input type="hidden" name="helper_id" value="<?=$member['mb_id']?>">
			<input type="hidden" name="mb_id" value="<?=$_GET['mb_id']?>">
			<input type="hidden" name="co_page" value="<?=$cmt_mode?>">
			<textarea name="co_txt" placeholder="코멘트를 남겨주세요."></textarea>
			<button type="button" onclick="commentSubmit2('w', document.fComment);">등록</button>
		</form>
	</div>
	<!-- // 입력폼 -->
	<!-- 리스트 -->
	<div class="lst">
		<ul>
			<? if ($c_result_cnt == 0) { ?>
			<li>등록된 코멘트가 없습니다.</li>
			<? 
			} else { 
				foreach ($comment_list as $key=>$val) {
					$helper_name = ($val['helper_name'] != "")? $val['helper_name'] : "삭제된 헬퍼입니다.";

					// 원글, 댓글구분
					$lst_class = ($val['co_is_parent'] == "0")? "re_commt" : "";
			?>
			<li id="lst<?=$key?>" class="<?=$lst_class?>">
				<? if ($val['co_is_del'] == 1) { ?>
				<div class="del">삭제된 코멘트 입니다.</div>

				<? } else { ?>
				<div class="info">
					<span class="name"><?=$helper_name?></span><span class="date"><?=$val['co_regdate']?></span>
					<? if ($val['co_is_parent'] == "1" && $cmt_mode != "calc") { // 답글의 답글 불가 or 정산현황의경우 ?>
					<span class="reply" onclick="getFrmLoad('<?=$key?>', '<?=$val['idx']?>');" style="margin-left:7px;">답글</span>
					<? } ?>
                    <? if ($member['mb_status']=="관리자") { // 관리자 삭제가능 ?>
                    <span class="reply" onclick="replyDelete('<?=$key?>', '<?=$val['idx']?>');">삭제</span>
                    <?}?>
				</div>
				<div><?=nl2br($val['co_txt'])?></div>
				<? } ?>
			</li>
			<?
				}
			}
			?>
		</ul>
	</div>
	<!-- // 리스트 -->
</div>

<? 
if ($cmt_mode == "calc") {
	// 페이징
	$paging_params = get_paging_params($qstr);
	echo get_paging($list_page_rows, $page, $total_page, '?'.$paging_params);
?>
</div>
<? } ?>

<script src="<?=G5_JS_URL?>/jquery.serializeObject.js"></script>
<script>
$(function() {
	var st = sessionStorage.getItem("st");
	if (st != "") {
		$(window).scrollTop(st);
		sessionStorage.removeItem("st");
	}
});

// 답글폼생성
function getFrmLoad(num, idx) {
	var area_id = "#lst"+num,
		helper_id = document.fComment.helper_id.value,
		mb_id = document.fComment.mb_id.value,
		frm_name = "fComment"+ num,
		form = $('<form name="'+ frm_name +'"></form>'),
		div = $('<div class="frm"></div>');

	$("div.lst").find("div.frm").remove();

	div.appendTo(area_id);

	var input = $("<input type='hidden' name='helper_id' value='"+ helper_id +"'>"),
		input2 = $("<input type='hidden' name='mb_id' value='"+ mb_id +"'>");
		input3 = $("<input type='hidden' name='p_idx' value='"+ idx +"'>");
		input4 = $("<input type='hidden' name='co_is_parent' value='0'>");
		txt = $("<textarea name='co_txt'></textarea>");
		btn = $("<button type='button' onclick='commentSubmit2(\"r\", document."+ frm_name +");'>등록</button>");

	form.append(input);
	form.append(input2);
	form.append(input3);
	form.append(input4);
	form.append(txt);
	form.append(btn);

	div.append(form);

	$(area_id).find("textarea").focus();
}

// 코멘트등록
function commentSubmit2(mode, f) {
	var el = $(f),
		co_page = document.fComment.co_page.value,
		data_list = el.serializeObject();

	data_list.mode = mode;
	data_list.page = co_page;

	if ($("input[name=t]:checked").val() == "2") {
		alert("당일소개로 검색후 코멘트를 등록하세요.");
		$("input[name=t]").focus();
		return false;
	}

	if (f.co_txt.value == "") {
		alert("내용을 입력하세요.");
		f.co_txt.focus();
		return false;
	}

	if (co_page == "calc") {
		data_list.co_fix_date = document.getElementById("s01").value;
	}

	$.ajax({  
		type : "post",  
		url : g5_admin_url + "/ajax.helper_comment_update.php",
		data : data_list,
		dataType : "text",  
		success : function(data) {
			if (data == "T") {
				var st = $(window).scrollTop();
				sessionStorage.setItem("st", st);
				location.reload();
			} else {
				alert("코멘트 등록에 실패하였습니다. 다시 시도해 주세요.");
				f.co_txt.focus();
			}
		},  
		error : function(xhr,status,error) {
			alert("코멘트 등록에 실패하였습니다. 다시 시도해 주세요.");
			f.co_txt.focus();
		}  
	});
}

// 코멘트삭제 (num=0:
function replyDelete(num, idx) {
    var del_msg = "삭제하시겠습니까?";
    if (num == "0") del_msg += "\n답글이 있는 경우 함께 삭제됩니다.";
    var err_msg = "코멘트 삭제에 실패하였습니다. 다시 시도해 주세요.";

    if (!confirm(del_msg)) return false;

    $.post("./ajax.helper_comment_update.php", {mode: "delete", idx: idx, is_reply: num} ).done(function(json) {
        var data = JSON.parse(json);
        if (data.result) {
            location.reload();
        } else {
            alert(err_msg);
        }
    }, "json").fail(function(data) {
        //console.log(data);
        alert(err_msg);
    });


}
</script>