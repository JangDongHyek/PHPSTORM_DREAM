<?php
if($identify_act == 'ok'){
	if($b_name == '' || $b_tel == ''){
		echo "<script>
		alert('예약조회 정보를 모두 입력해주세요');
		location.replace('./board.php?bo_table={$bo_table}&mode=identify');
		</script>";
		exit;
	}
	
	$sql = " SELECT * FROM `g5_write_counsel_book` WHERE b_name='{$b_name}' AND b_tel='{$b_tel}' ORDER BY b_idx DESC ";
	$result = sql_query($sql);
	$numb = sql_num_rows($result);
?>
	<?php
	if($numb <= 0){
	?>
	<div style="margin:0; padding:30px 0px; text-align:center;">해당 정보에는 예약된 상담이 없습니다.</div>
	<?php
	}else{
		for($i=0; $i<$numb; $i++){
			$row = sql_fetch_array($result);
			$sql2 = " SELECT * FROM `g5_write_counsel` WHERE wr_id='{$row[b_wr_id]}' LIMIT 1 ";
			$result2 = sql_query($sql2);
			$row2 = sql_fetch_array($result2);

			$wr_6 = $row2['wr_6'];
			$wr_7 = $row2['wr_7'];
			$wr_8 = $row2['wr_8'];
			$wr_9 = $row2['wr_9'];

			if($wr_6 < 10) $wr_6 = '0'.$wr_6;
			if($wr_7 < 10) $wr_7 = '0'.$wr_7;
			if($wr_8 < 10) $wr_8 = '0'.$wr_8;
			if($wr_9 < 10) $wr_9 = '0'.$wr_9;
	?>
	<div style="margin:0; padding-bottom:15px;">
		<table style="margin:0 auto; padding:0px 0px; width:100%; border-collapse:collapse;">
		<tbody>
		<tr>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>프로그램명</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row2['wr_subject']; ?></td>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>예약날짜</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;">
			<?php echo $row2['wr_5'].'&nbsp;&nbsp;'.$wr_6.':'.$wr_7.'&nbsp;~&nbsp;'.$wr_8.':'.$wr_9; ?>
			</td>
		</tr>
		<tr>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>예약자명</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_name']; ?></td>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>대상</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row2['wr_content']; ?></td>
		</tr>
		<tr>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>학교</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_school']; ?></td>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>학년</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php if($row['b_class'] != '') echo $row['b_class'].'학년'; ?></td>
		</tr>
		<tr>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>휴대폰번호</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_tel']; ?></td>
			<th style="margin:0; padding:4px 4px; width:15%; border:1px solid #d1dee2; background-color:#e5ecef; font-weight:bold;"><label>이메일</label></th>
			<td style="margin:0; padding:4px 4px; width:35%; border:1px solid #d1dee2; background-color:#ffffff;"><?php echo $row['b_email']; ?></td>
		</tr>
		</tbody>
		</table>
	</div>
	<?php
		}
	}
	?>
<?php
}else{
?>

<style>
/*카운셀링*/
#programText{letter-spacing:-1px;}
#programText .counselimg{ width:100%; height:auto;}
#programText h2{ background:url(../img/subicon.jpg) no-repeat 1px top; font-weight:bold; color:#000; font-size:20px; overflow:hidden; padding-top:10px; }
#programText .subtext{ font-size:16px; color:#333; display:block; font-weight:500; line-height:30px; }
#programText .subtext span{color:#de3d18;}
</style>
<div id="programText">
<div class="counselimg"><img src="<?php echo G5_URL; ?>/img/identifyimg.jpg" border=0 /></div><br>
        <p class="subtext">
            - 청소년에게 진로 상담을 제공하며 <span>학부모 동반도 가능</span> 합니다. <br>
            - 대상은 <span>양산시 소재 초(5학년이상),중,고</span> 학생이 우선입니다.<br>
            - <span>상담은 아래의 사전 예약을 통해서만 가능합니다.</span> <br>
            - 예약 후 방문이 어려우신 경우 <span>2일전 취소요청을</span> 하셔야 합니다.<br>
            - 사전취소 요청없이 <span>무단 상담불참시 향후 센터 활동에 불이익</span>을 당할 수 있습니다.<br><br>
</div>

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

	if(f.b_tel.value == ''){
		alert('휴대폰번호를 입력해주세요');
		return false;
	}

	return true;
}
</script>
<div>
	<form method="post" name="book_form" action="./board.php?bo_table=<?php echo $bo_table; ?>&mode=identify" onsubmit="return book_act(this);">
	<input type="hidden" name="identify_act" value="ok" />
	<p style="margin:0; padding:0px 0px 5px 0px; font-size:15px;">■ 예약자 정보 조회</p>
	<ul style="position:relative; margin:0; padding:0px 0px; list-style:none; text-decoration:none;">
		<li style="float:left; width:15%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px; font-size:16px;">예약자명</label></li>
		<li style="float:left; width:35%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476;"><input type="text" name="b_name" value="" style="width:40%; margin-left:10px;" /></li>
		<li style="float:left; width:15%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;  font-size:16px;">휴대폰번호</label></li>
		<li style="float:left; width:34.85%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; border-right:1px solid #3a8476;"><input type="text" name="b_tel" value="" style="width:40%; margin-left:10px; IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);" /></li>
	</ul>
	<div style="clear:both; margin:0 auto; padding:10px 0px; text-align:center;"><input type="submit" style="margin:0; padding:4px 8px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" value="예약조회" /></div>
	</form>
</div>
<?
}
?>
