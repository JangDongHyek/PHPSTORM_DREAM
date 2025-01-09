<style>
/*카운셀링*/
#programText{letter-spacing:-1px;}
#programText .counselimg{ width:100%; height:auto;}
#programText h2{ background:url(../img/subicon.jpg) no-repeat 1px top; font-weight:bold; color:#000; font-size:20px; overflow:hidden; padding-top:10px; }
#programText .subtext{ font-size:16px; color:#333; display:block; font-weight:500; line-height:30px; }
#programText .subtext span{color:#de3d18;}
</style>
<div id="programText">
<div class="counselimg"><img src="<?php echo G5_URL; ?>/img/counselimg.jpg" border=0 /></div><br>
        <h2>아래 상담일정표에서 센터방문상담을 선택하세요.</h2>
        <p class="subtext">
            - 청소년에게 진로 상담을 제공하며 <span>학부모 동반도 가능</span> 합니다. <br>
            - 대상은 <span>양산시 소재 초(5학년이상),중,고</span> 학생이 우선입니다.<br>
            - <span>상담은 아래의 사전 예약을 통해서만 가능합니다.</span> <br>
            - 예약 후 방문이 어려우신 경우 <span>2일전 취소요청을</span> 하셔야 합니다.<br>
            - 사전취소 요청없이 <span>무단 상담불참시 향후 센터 활동에 불이익</span>을 당할 수 있습니다.<br><br>
</div>



<?php
$book_sql = " SELECT * FROM `g5_write_counsel` WHERE wr_id='{$b_wr_id}' LIMIT 1 ";
$book_result = sql_query($book_sql);
$book_row = sql_fetch_array($book_result);
$book_wr_6 = $book_row['wr_6'];
$book_wr_7 = $book_row['wr_7'];
$book_wr_8 = $book_row['wr_8'];
$book_wr_9 = $book_row['wr_9'];

if($book_wr_6 < 10) $book_wr_6 = '0'.$book_wr_6;
if($book_wr_7 < 10) $book_wr_7 = '0'.$book_wr_7;
if($book_wr_8 < 10) $book_wr_8 = '0'.$book_wr_8;
if($book_wr_9 < 10) $book_wr_9 = '0'.$book_wr_9;
?>

<script>
     function chkNum(c){
          if((c.keyCode<48) || (c.keyCode>57)){
               return false;
          }
     }

     function onOnlyNumber(obj){
          for(var i=0; i<obj.value.length; i++){
               chr = obj.value.substr(i,1);
               chr = escape(chr);
               key_eg = chr.charAt(1);
              
               if(key_eg == "u"){
                    key_num = chr.substr(i,(chr.length-1));
                    if((key_num < "AC00") || (key_num > "D7A3")){
                         event.returnValue = false;
                    }
               }
          }

          if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 16){
               event.returnValue = true;
          }else{
               event.returnValue = false;
          }
     }
</script>

<script>
function book_act(f){
	if(f.b_name.value == ''){
		alert('예약자명을 입력해주세요');
		return false;
	}

	if(f.b_school.value == ''){
		alert('학교를 입력해주세요');
		return false;
	}

	/*
	if(f.b_class.value == ''){
		alert('학년을 선택해주세요');
		return false;
	}
	*/

	if(f.b_tel.value == ''){
		alert('휴대폰번호를 입력해주세요');
		return false;
	}

	if(f.b_email.value == ''){
		alert('이메일을 입력해주세요');
		return false;
	}

	if(f.chk1.checked == false){
		alert('동의란에 모두 동의하셔야 예약신청이 가능합니다.');
		return false;
	}

	if(f.chk2.checked == false){
		alert('동의란에 모두 동의하셔야 예약신청이 가능합니다.');
		return false;
	}

	return true;
}
</script>
<div style="position:relative; display:block; margin:0 auto; padding:0px 0px;">
	<form method="post" name="book_form" action="<?php echo $board_skin_url; ?>/book.write.php" onsubmit="return book_act(this);">
	<input type="hidden" name="b_wr_id" value="<?php echo $b_wr_id; ?>" />
	<p style="margin:0; padding:0px 0px 5px 0px; font-size:15px;">■ 예약자 정보 입력</p>
	<ul style="position:relative; margin:0; padding:0px 0px; list-style:none; text-decoration:none;">
		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">프로그램명</label></li>
		<li style="float:left; width:35%; height:35px; line-height:35px; border-top:1px solid #3a8476;"><span style="padding-left:10px;"><?php echo $book_row['wr_subject']; ?></span></li>
		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">예약날짜</label></li>
		<li style="float:left; width:34.85%; height:35px; line-height:35px; border-top:1px solid #3a8476; border-right:1px solid #3a8476;"><span style="padding-left:10px;"><?php echo $book_row['wr_5'].'&nbsp;&nbsp;'.$book_wr_6.':'.$book_wr_7.'&nbsp;~&nbsp;'.$book_wr_8.':'.$book_wr_9; ?></span></li>

		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">예약자명</label></li>
		<li style="float:left; width:35%; height:35px; line-height:35px; border-top:1px solid #3a8476;">
		<input type="text" name="b_name" value="" style="width:40%; margin-left:10px;" />
		</li>
		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">대상</label></li>
		<li style="float:left; width:34.85%; height:35px; line-height:35px; border-top:1px solid #3a8476; border-right:1px solid #3a8476;"><span style="padding-left:10px;"><?php echo $book_row['wr_content']; ?></span></li>

		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">학교</label></li>
		<li style="float:left; width:35%; height:35px; line-height:35px; border-top:1px solid #3a8476;">
		<input type="text" name="b_school" value="" style="width:60%; margin-left:10px;" />
		</li>
		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">학년</label></li>
		<li style="float:left; width:34.85%; height:35px; line-height:35px; border-top:1px solid #3a8476; border-right:1px solid #3a8476;">
		<select name="b_class" style="margin-left:10px;">
			<option value="">선택</option>
			<?php for($i=1; $i<7; $i++){ ?>
			<option value="<?php echo $i; ?>"><?php echo $i.'학년'; ?></option>
			<?php } ?>
		</select>
		</li>

		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">휴대폰번호</label></li>
		<li style="float:left; width:35%; height:35px; line-height:35px; border-top:1px solid #3a8476;"><input type="text" name="b_tel" value="" style="width:40%; IME-MODE:disabled; margin-left:10px;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);" /></li>
		<li style="float:left; width:15%; height:35px; line-height:35px; border-top:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;">이메일</label></li>
		<li style="float:left; width:34.85%; height:35px; line-height:35px; border-top:1px solid #3a8476; border-right:1px solid #3a8476;"><input type="text" name="b_email" value="" style="width:60%; margin-left:10px;" /></li>

		<li style="float:left; width:100%; height:35px; line-height:35px; border-top:1px solid #3a8476;">
		<label>
		<input type="checkbox" name="chk1" id="chk1" value="y">
		상기 개인정보는 상담예약을 위해 본인 동의하에 제공하며 개인정보 수집 및 활용에 동의합니다.
		</label>
		</li>
		<li style="float:left; width:100%; height:35px; line-height:35px; border-bottom:1px solid #3a8476;">
		<label>
		<input type="checkbox" name="chk2" id="chk2" value="y">
		양산진로지원센터 꿈나르샤의 새로운 소식, 이벤트, 활동사항 등의 문자서비스를 받겠습니다.
		</label>
		</li>
	</ul>
	<div style="clear:both; margin:0 auto; padding:10px 0px; text-align:center;"><input type="submit" style="margin:0; padding:4px 8px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" value="상담 예약하기" /></div>
	</form>
</div>

