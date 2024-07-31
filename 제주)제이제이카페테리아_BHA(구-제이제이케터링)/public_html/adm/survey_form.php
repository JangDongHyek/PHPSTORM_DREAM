<?php
$sub_menu = "500100";
include_once('./_common.php');
include_once('./survery_config.php');

auth_check($auth[$sub_menu], 'w');

$html_title = '설문조사';
if ($w == '')
    $html_title .= ' 생성';
else if ($w == 'u')  {
    $html_title .= ' 수정';
    $sql = " select * from {$g5['survey_table']} where sv_id = '{$sv_id}' ";
    $sv = sql_fetch($sql);
} else
    alert('w 값이 제대로 넘어오지 않았습니다.');

$g5['title'] = $html_title;
include_once('./admin.head.php');

$sql = "select * from ".$g5['clause_table']." where sv_id = '".$sv_id."' order by cl_id asc";
$result = sql_query($sql);
$cnt = sql_num_rows($result);
$cnt = $cnt ? $cnt:1;
?>
<style>
	.add_question { padding: 0 20px 10px 0; text-align:right;}
	.add_question .btn_cancel { cursor:pointer; }
	.cl_tb { border-top:2px solid #DBDBDB; }
</style>

<form name="fsurvey" id="fsurvey" action="./survey_form_update.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="sv_id" value="<?php echo $sv_id ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="cl_cnt" value="<?php echo $cl_cnt ?>">
<input type="hidden" name="token" value="">

<div class="add_question">
	<input type="button" id="add_question" value="문항추가" class="btn_cancel">
</div>

<div class="tbl_frm01 tbl_wrap">
    <table>
	<colgroup>
		<col width="150">
		<col width="auto">
		<col width="150">
		<col width="auto">
	</colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="sv_subject">설문조사 제목<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
			<input type="text" name="sv_subject" value="<?php echo $sv['sv_subject'] ?>" id="sv_subject" required class="required frm_input" size="80" maxlength="125">
		</td>
    </tr>
    </tbody>
	<?php 
		for($i=0; $i<$cnt; $i++){ 
		$cl = sql_fetch_array($result);
	?>
	<tbody class="cl_tb">
	<tr>
		<th scope="row"><label for="cl_subject<?php echo $i?>">문항 제목 ＃ <span class="sj_<?php echo $i?>"><?php echo ($i+1)?></span><strong class="sound_only">필수</strong></label></th>
		<td colspan="3">
			<input type="text" name="cl_subject[<?php echo $i?>]" value="<?php echo $cl['cl_subject'] ?>" id="cl_subject<?php echo $i?>" required class="required frm_input" size="80" maxlength="125">
			<input type="checkbox" name="cl_ext[<?php echo $i?>]" value="1" id="cl_ext<?php echo $i?>" <?php if($cl['cl_ext']) echo "checked";?>><label id="cl_elb<?php echo $i?>" for="cl_ext<?php echo $i?>"> 기타의견사용</label>
			<input type="button" name="cl_del[<?php echo $i?>]" value="문항삭제" class="btn_cancel" style="<?php if($i==0) echo "display:none;"?> cursor:pointer" onclick="cl_del(<?php echo $i?>)">
			<input type="hidden" name="cl_id[<?php echo $i?>]" value="<?php echo $cl['cl_id'] ?>" class="btn_cancel">
		</td>
	</tr>

	<?php 
	for($j=0; $j<8; $j++){ 
		if($j==0 || $j==1)
			$required = "required";
		else
			$required = "";
	?>
	<tr>
		<th scope="row">항목 ＃ <span class="sj_<?php echo $i?>"><?php echo ($i+1)?></span> - <?php echo ($j+1)?></th>
		<td>
			<input type="text" name="cl[<?php echo $i?>][<?php echo $j?>]" value="<?php echo $cl['cl_'.($j+1)] ?>" <?php echo $required?> class="<?php echo $required?> frm_input" size="80" maxlength="125">
			<input type="text" name="cl_cnt[<?php echo $i?>][<?php echo $j?>]" value="<?php echo $cl['cl_cnt'.($j+1)] ?>" class="frm_input" size="5" maxlength="125" style="width:40px;" onkeyup="this.value=number_only(this.value)">
		</td>
		<?php $j++; ?>
		<th scope="row">항목 ＃ <span class="sj_<?php echo $i?>"><?php echo ($i+1)?></span> - <?php echo ($j+1)?></th>
		<td>
			<input type="text" name="cl[<?php echo $i?>][<?php echo $j?>]" value="<?php echo $cl['cl_'.($j+1)] ?>" <?php echo $required?> class="<?php echo $required?> frm_input" size="80" maxlength="125">
			<input type="text" name="cl_cnt[<?php echo $i?>][<?php echo $j?>]" value="<?php echo $cl['cl_cnt'.($j+1)] ?>" class="frm_input" size="5" maxlength="125" style="width:40px;" onkeyup="this.value=number_only(this.value)">
		</td>
	</tr>
	<?php } ?>
	<tr>
		<th scope="row">기타의견</th>
		<td colspan="3">
			<textarea name="cl_ext_txt[<?php echo $i?>]" id="cl_ext_txt<?php echo $i?>" <?php if($member['mb_id']!="lets080") echo "readonly"?> rows="5" style="width:80%"><?php echo preg_replace("/\n/", " / ", $cl['cl_ext_txt']) ?></textarea>
			<input type="text" name="cl_ext_cnt[<?php echo $i?>]" value="<?php echo $cl['cl_ext_cnt'] ?>" class="frm_input" size="5" maxlength="125" style="width:40px;" onkeyup="this.value=number_only(this.value)">
		</td>
	</tr>
	
    </tbody>
	<?php } ?>

	<?php if ($w == 'u') { ?>
	<tbody style="border-top:3px solid #DBDBDB;">
		<tr>
			<th scope="row">설문조사등록일</th>
			<td colspan="3"><?php echo $sv['sv_date']; ?></td>
		</tr>
		<tr>
			<th scope="row"><label for="po_ips">설문조사참가 IP</label></th>
			<td colspan="3"><textarea name="sv_ips" id="sv_ips" <?php if($member['mb_id']!="lets080") echo "readonly"?> rows="5"><?php echo preg_replace("/\n/", " / ", $sv['sv_ips']) ?></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_ids">설문조사참가 회원</label></th>
			<td colspan="3"><textarea name="mb_ids" id="mb_ids" <?php if($member['mb_id']!="lets080") echo "readonly"?> rows="5"><?php echo preg_replace("/\n/", " / ", $sv['mb_ids']) ?></textarea></td>
		</tr>
	</tbody>
	<?php } ?>
    </table>

</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./survey_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>

<script>

$("#add_question").click(function (){
	var cl_last = $(".cl_tb:last"); 
	var $index = cl_last.index(".cl_tb");
	var $clone = cl_last.clone();
	var l = $index + 1;

	$clone.find("[name='cl_subject["+$index+"]']").attr("name", "cl_subject["+l+"]").attr("id", "cl_subject"+l);
	$clone.find(".sj_" + $index).removeClass("sj_"+$index).addClass("sj_" + l).html((l+1));
	$clone.find("[name='cl_del["+$index+"]']").attr("name", "cl_del["+l+"]").css("display","").attr("onclick", "cl_del("+l+")");
	$clone.find("[name='cl_ext["+$index+"]']").attr("name", "cl_ext["+l+"]").attr("id", "cl_ext"+l).css("display","").prop("checked",false);
	$clone.find("#cl_elb"+$index).attr("id", "cl_elb"+l).attr("for", "cl_ext"+l);
	$clone.find(".frm_input").val("");
	$clone.find("[name='cl_id["+$index+"]']").attr("name", "cl_id["+l+"]").val("");

	for(var i=0; i<8; i++){
		$clone.find("[name='cl["+$index+"]["+i+"]']").attr("name", "cl["+l+"]["+i+"]");
		$clone.find("[name='cl_cnt["+$index+"]["+i+"]']").attr("name", "cl_cnt["+l+"]["+i+"]");
	}

	cl_last.after($clone);
});

function number_only(num) {
	num = num + "";
	num = num.replace(/[^0-9]/gi, ""); 
	num = parseFloat(num);
	if(isNaN(num)) return '0';

	return num ;
}

function cl_del(di){
	var cl_cnt = $(".cl_tb").length;
	var l;

	$(".cl_tb").eq(di).remove();
	
	for(var i=di; i<cl_cnt; i++){
		l = i - 1;

		$("[name='cl_subject["+i+"]']").attr("name", "cl_subject["+l+"]").attr("id", "cl_subject"+l);
		$(".sj_" + i).removeClass("sj_"+i).addClass("sj_" + l).html((l+1));
		$("[name='cl_del["+i+"]']").attr("name", "cl_del["+l+"]").css("display","").attr("onclick", "cl_del("+l+")");
		$("[name='cl_ext["+i+"]']").attr("name", "cl_ext["+l+"]").attr("id", "cl_ext"+l).css("display","").prop("checked",false);
		$("#cl_elb"+i).attr("id", "cl_elb"+l).attr("for", "cl_ext"+l);
		$("[name='cl_id["+i+"]']").attr("name", "cl_id["+l+"]");

		for(var j=0; j<8; j++){
			$("[name='cl["+i+"]["+j+"]']").attr("name", "cl["+l+"]["+j+"]");
			$("[name='cl_cnt["+i+"]["+j+"]']").attr("name", "cl_cnt["+l+"]["+j+"]");
		}
	}
}
</script>
<?php
include_once('./admin.tail.php');
?>
