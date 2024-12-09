<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = 'My진행불';
include_once(G5_PATH.'/head.sub.php');

$helper_id = $member['mb_id'];
$helper_name = $member['mb_name'];

$sql = "SELECT A.*, B.mb_name, B.mb_birth, B.mb_si, B.mb_sex
		FROM g5_member_match A INNER JOIN g5_member B
		ON A.mb_id = B.mb_id
		WHERE A.helper_id = '{$helper_id}' AND A.match_status = '1' ORDER BY A.idx DESC ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

?>
<div id="popup_wrap">
	<p>My진행불</p>
	<form name="fMatch" action="" method="post" onsubmit="return matchSubmit(this);">
		<div class="tbl_head02 tbl_wrap">
			<!-- My진행불 -->
			<table>
			<caption>My진행불</caption>
			<colgroup>
				<col width="20%">
				<col width="">
				<col width="15%">
				<col width="15%">
				<col width="15%">
				<col width="">
			</colgroup>
			<thead>
			<tr>
				<th>진행여부</th>
				<th>이름</th>
				<th>나이</th>
				<th>지역</th>
				<th>성별</th>
				<th>프로필</th>
			</tr>
			</thead>
			<tbody>
			<? if ($result_cnt == 0) { ?>
			<tr style="text-align:center;"><td colspan="6">조회 결과가 없습니다.</td></tr>
			<? 
			} else { 
				while($row = sql_fetch_array($result)) {
					$mb_age = (date("Y")+1) - substr($row['mb_birth'], 0, 4);
					$btn_cls = ($row['match_type'] == "1")? "btn04": "btn03";
			?>
			<tr style="text-align:center;">
				<td><button type="button" class="<?=$btn_cls?>" onclick="setMatchIng('<?=$row['mb_id']?>', '<?=$helper_id?>', '1', '<?=$row['idx']?>');">&#10084; <?=$helper_name?></button></td>
				<td><?=$row['mb_name']?></td>
				<td><?=$mb_age?></td>
				<td><?=$row['mb_si']?></td>
				<td><?=$row['mb_sex']?></td>
				<td><button type="button" class="btn01" onclick="getProfile('<?=$row['mb_id']?>');">보기</button></td>
			</tr>
			<? 
				}
			}
			?>
			</thead>
			</table>
		</div>

		<br><br>
		<div class="btn_confirm01 btn_confirm">
			<a href="javascript:void(0);" onclick="getWinClose('refresh');">닫기</a>
		</div>

	</form>
</div>



<script>
$(function() {
	if (!opener) {
		document.write('잘못된 접근입니다.');
	} 
});

// 프로필보기
function getProfile(mb_id) {
	//opener.location.href = "./member_form.php?w=u&mb_id=" + mb_id;

	var ts = new Date().getTime();
	var pop_w = 1200, pop_h = 800, title = "회원프로필 "+ts,
		url = g5_admin_url + "/member_form.php?w=u&mb_id=" + mb_id;

	var left = Math.floor((window.innerWidth - pop_w) / 2),
		top = Math.floor((window.innerHeight - pop_h) / 2);

	window.open(url, title,"width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
}

// 진행불
function setMatchIng(mb_id, helper_id, stt, idx) {
	$.ajax({  
		type : "POST",  
		url : "./ajax.member_match_ing.php",
		data : {"mb_id" : mb_id, "idx" : idx, "stt" : stt, "helper_id" : helper_id},
		dataType : "json",  
		success : function(data) {
			if (data.result == "T") {
				alert("변경 완료되었습니다.");
				location.reload();
			} else {
				alert(data.msg);
			}
		},  
		error : function(xhr,status,error) {
			alert("진행여부 변경에 실패하였습니다. 다시 시도해 주세요.");
			//location.reload();
		}  
	});
	
}

// 새창팝업
function getWinPop(mode, mb_id) {
	
}

</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>