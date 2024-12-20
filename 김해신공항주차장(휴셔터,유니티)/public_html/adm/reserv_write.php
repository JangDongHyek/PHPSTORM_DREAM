<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
if($w=="u"){
	$sql="select * from g5_write_b_reserv where wr_id='$wr_id'";
	$row=sql_fetch($sql);
	$wr_1=explode(" ",$row[wr_1]);
	$wr_1_times=explode(":",$wr_1[1]);
	$wr_2=explode(" ",$row[wr_2]);
	$wr_2_times=explode(":",$wr_2[1]);
}

$g5['title'] = '예약신청';
$wr_21Arr=array("승용차(국산)","SUV(6인승이하)","고급승용차","외제차","승합차");
include_once(G5_PATH.'/head.sub.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="<?php echo G5_THEME_CSS_URL; ?>/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부스스트랩-->
<script src="<?php echo G5_THEME_JS_URL ?>/bootstrap.min.js"></script><!--부트스트랩-->

<form name="fmember" id="fmember" action="./reserv_write_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="bo_table" value="b_reserv">
<input type="hidden" name="wr_id" value="<?=$row[wr_id]?>">
<input type="hidden" name="w" value="<?=$w?>">
<input type="hidden" name="wr_subject" value="<?=$row[wr_subject]?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <!--<tr>
        <th scope="row"><label for="wr_21">차종류<?php echo $sound_only ?></label></th>
        <td>
            <select name="wr_21" id="wr_21">
				<option value="">자동차 종류를 선택해 주세요</option>
				<? for($i=0;$i<count($wr_21Arr);$i++){?>
				<option value="<?=$wr_21Arr[$i]?>"<?php echo $wr_21Arr[$i]==$row[wr_21]?" selected":"";?>><?=$wr_21Arr[$i]?></option>
				<? }?>
			</select>
        </td>
    </tr>-->
    <tr>
        <th scope="row"><label for="wr_4">등록자/스텝<?php echo $sound_only ?></label></th>
        <td>
			<select name="">
				<option value="통합관리자">통합관리자</option>
			</select>
            
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_4">국제/국내<?php echo $sound_only ?></label></th>
        <td>
            <input type="radio" name="wr_4" value="국내선"<?php echo $row[wr_4]=="국내선"||$row[wr_4]==""?" checked":"";?>>국내선
			<input type="radio" name="wr_4" value="국제선"<?php echo $row[wr_4]=="국제선"?" checked":"";?>>국제선
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_name">고객성명<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_name" value="<?php echo $row['wr_name'] ?>" id="wr_name" required class="frm_input required" size="15"  maxlength="20">
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_5">차량기종<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_5" value="<?php echo $row['wr_5'] ?>" id="wr_name" required class="frm_input required" size="15"  maxlength="20">
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_6">차량번호<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_6" value="<?php echo $row['wr_6'] ?>" id="wr_name" required class="frm_input required" size="15"  maxlength="20">
        </td>
    </tr>
	
	<tr>
        <th scope="row"><label for="wr_3">휴대폰번호<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_3" value="<?php echo $row['wr_3'] ?>" id="wr_3" required class="frm_input required" size="15"  maxlength="20">
        </td>
    </tr>
	<tr>
        <th scope="row" colspan="2" height="40"  style="font-weight:bold;font-size:20px">여행정보</th>
    </tr>
	<tr>
        <th scope="row"><label for="wr_17">입국항공편명<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_17" value="<?php echo $row['wr_17'] ?>" id="wr_17"  class="frm_input " style="width:80%"  maxlength="20"><br/>
			(예:PR484)
        </td>
    </tr>
	<tr>
        <th scope="row" colspan="2" height="40"  style="font-weight:bold;font-size:20px">주차요금계산</th>
    </tr>
	<tr>
        <th scope="row"><label for="wr_1">공항도착 예정시간<?php echo $sound_only ?></label></th>
        <td>
            <input name="wr_1[0]" id="wr_1" type="text" placeholder="이용입고예정일시" class="frm_input" required value="<?=$wr_1[0]?>">
			 <select name="wr_1[1]" class="select" id="wr_1_1" style="">
					<? for($i=6;$i<22;$i++){
						$hour=$i<10?"0".$i:$i;
					?>
					<option value="<?=$hour?>:"<?php echo $hour==$wr_1_times[0]?" selected":"";?>><?=$hour?>시</option>
					<? }?>
			  </select>
			  <select name="wr_1[2]" class="select" id="wr_1_2" style="">
					 <? for($i=0;$i<60;$i++){
							$min=$i<10?"0".$i:$i;
					 ?>
					 <option value="<?=$min?>"<?php echo $min==$wr_1_times[1]?" selected":"";?>><?=$min?>분</option>
					 <? }?>
			  </select>
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_2">입국시 도착시간<?php echo $sound_only ?></label></th>
        <td>
            <input name="wr_2[0]" id="wr_2" type="text" placeholder="이용도착예정일시" class="frm_input" required value="<?=$wr_2[0]?>">
			 <select name="wr_2[1]" class="select" id="wr_2_1" style="">
					<? for($i=6;$i<22;$i++){
						$hour=$i<10?"0".$i:$i;
					?>
					<option value="<?=$hour?>:"<?php echo $hour==$wr_2_times[0]?" selected":"";?>><?=$hour?>시</option>
					<? }?>
			  </select>
			  <select name="wr_2[2]" class="select" id="wr_2_2" style="">
					 <? for($i=0;$i<60;$i++){
							$min=$i<10?"0".$i:$i;
					 ?>
					 <option value="<?=$min?>"<?php echo $min==$wr_2_times[1]?" selected":"";?>><?=$min?>분</option>
					 <? }?>
			  </select>
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_8">금액입력<?php echo $sound_only ?></label></th>
        <td>
			<input name="wr_8" id="wr_8" type="text" placeholder="이용예정일시" required value="<?=$row[wr_8]?>" class="frm_input">
            <input type="button" id="btn-cal" value="계산하기" class="btn btn_reserv">
        </td>
    </tr>
	<tr>
        <th scope="row" colspan="2" height="40" style="font-weight:bold;font-size:20px">기타정보</th>
    </tr>
	<tr>
        <th scope="row"><label for="wr_parking">주차라인<?php echo $sound_only ?></label></th>
        <td>
			<!--<input type="text" name="wr_parking" id="wr_parking" value="<?php echo $row[wr_parking]?>" class="frm_input">-->
			<select name="wr_9">
				<option value="">:::선택:::</option>
				<?php
					$sql="select * from park_line order by line_order asc";
					$result2=sql_query($sql);
					while($row2=sql_fetch_array($result2)){
				?>
				<option value="<?php echo $row2[line_name]?>"<?php echo $row[wr_9]==$row2[line_name]?" selected":"";?>><?=$row2[line_name]?></option>
				<?php }?>

			</select>
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_12">키보관<?php echo $sound_only ?></label></th>
        <td>
			<select name="wr_12" id="wr_12">
				<option value="O"<?php echo $row[wr_12]=="O"?" selected":"";?>>O</option>
				<option value="X"<?php echo $row[wr_12]=="X"?" selected":"";?>>X</option>
			</select>
        </td>
    </tr>
	
	<tr>
        <th scope="row"><label for="wr_content">특이사항<?php echo $sound_only ?></label></th>
        <td>
			<textarea name="wr_content"><?=$row[wr_content]?></textarea>
        </td>
    </tr>

	<? /*
	<tr>
        <th scope="row"><label for="mb_memo">메모</label></th>
        <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_level">회원 권한</label></th>
        <td><?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></td>
        <th scope="row">포인트</th>
        <td><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $mb['mb_id'] ?>" target="_blank"><?php echo number_format($mb['mb_point']) ?></a> 점</td>
    </tr>
    <tr>
		<th scope="row"><label for="mb_homepage">홈페이지</label></th>
        <td><input type="text" name="mb_homepage" value="<?php echo $mb['mb_homepage'] ?>" id="mb_homepage" class="frm_input" maxlength="255" size="15"></td>
        <th scope="row"><label for="mb_tel">전화번호</label></th>
        <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row">본인확인방법</th>
        <td colspan="3">
            <input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify'] == 'ipin') echo 'checked="checked"'; ?>>
            <label for="mb_certify_ipin">아이핀</label>
            <input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify'] == 'hp') echo 'checked="checked"'; ?>>
            <label for="mb_certify_hp">휴대폰</label>
        </td>
    </tr>
    <tr>
        <th scope="row">본인확인</th>
        <td>
            <input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>>
            <label for="mb_certify_yes">예</label>
            <input type="radio" name="mb_certify" value="" id="mb_certify_no" <?php echo $mb_certify_no; ?>>
            <label for="mb_certify_no">아니오</label>
        </td>
        <th scope="row"><label for="mb_adult">성인인증</label></th>
        <td>
            <input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>>
            <label for="mb_adult_yes">예</label>
            <input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>>
            <label for="mb_adult_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row">주소</th>
        <td colspan="3" class="td_addr_line">
            <label for="mb_zip" class="sound_only">우편번호</label>
            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_icon">회원아이콘</label></th>
        <td colspan="3">
            <?php echo help('이미지 크기는 <strong>넓이 '.$config['cf_member_icon_width'].'픽셀 높이 '.$config['cf_member_icon_height'].'픽셀</strong>로 해주세요.') ?>
            <input type="file" name="mb_icon" id="mb_icon">
            <?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                echo '<img src="'.$icon_url.'" alt="">';
                echo '<input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1">삭제';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th scope="row">메일 수신</th>
        <td>
            <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?>>
            <label for="mb_mailling_yes">예</label>
            <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?>>
            <label for="mb_mailling_no">아니오</label>
        </td>
        <th scope="row"><label for="mb_sms_yes">SMS 수신</label></th>
        <td>
            <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
            <label for="mb_sms_yes">예</label>
            <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
            <label for="mb_sms_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_open">정보 공개</label></th>
        <td colspan="3">
            <input type="radio" name="mb_open" value="1" id="mb_open_yes" <?php echo $mb_open_yes; ?>>
            <label for="mb_open_yes">예</label>
            <input type="radio" name="mb_open" value="0" id="mb_open_no" <?php echo $mb_open_no; ?>>
            <label for="mb_open_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_signature">서명</label></th>
        <td colspan="3"><textarea  name="mb_signature" id="mb_signature"><?php echo $mb['mb_signature'] ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_profile">자기 소개</label></th>
        <td colspan="3"><textarea name="mb_profile" id="mb_profile"><?php echo $mb['mb_profile'] ?></textarea></td>
    </tr>
	*/ ?>
    

   

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
</div>
</form>

<script>
$(function(){
	//자동하이픈 넣기
		$(document).on("keyup", "#wr_3", function() { 
			$(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})/,"$1-$2-$3").replace("--", "-") ); 
		});
	$("#wr_1,#wr_2").datepicker({
			dateFormat: 'yy-mm-dd',
			buttonImage:"<?=G5_THEME_IMG_URL?>/common/icon_calendar.png",
			buttonImageOnly:true,
			showOn:'both',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			showMonthAfterYear: true,
			yearSuffix: '년',
		});
		
	$("#btn-cal").click(function(){
			var startDate=$("input[name='wr_1[0]']").val();
			var startTime=$("#wr_1_1").val()+$("#wr_1_2").val();
			var endDate=$("input[name='wr_2[0]']").val();
			var endTime=$("#wr_2_1").val()+$("#wr_2_2").val();
			$.ajax({
				url:"<?=G5_BBS_URL?>/ajax.date.cal.php",
				data:{"startdate":startDate,"enddate":endDate,"startTime":startTime,"endTime":endTime},
				dataType:"json",
				type:"POST",
				success:function(data){
					var json=JSON.parse(JSON.stringify(data));
					var day=json.day;
					var price=json.price;
					$("#start_date").html(startDate+' '+startTime);
					$("#end_date").html(endDate+' '+endTime);
					$("#price").html(price);
					$("#day").html(day);
					$("#wr_8").val(json.wr_8);

				}
			});
		});
});
function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
        alert('아이콘은 gif 파일만 가능합니다.');
        return false;
    }
    return true;
}
</script>

<?php
?>
