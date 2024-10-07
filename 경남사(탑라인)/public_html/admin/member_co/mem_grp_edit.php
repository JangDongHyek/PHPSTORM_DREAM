<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){
	include "../admin_head.php";
?>

<script>
function checkform(frm)
{	 
	var Digit = '1234567890'
	
	if(frm.grp_name.value==""){
		alert("\n그룹명을 입력하세요.");
		frm.grp_name.focus();
		return false;
	}
	if(frm.login_use[1].checked){
		
		if (frm.login_from.value==""){
			alert("총로그인횟수를 입력하세요");
			frm.login_from.focus();
			return false;
		}
		else{
			var len =frm.login_from.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				 var ch = frm.login_from.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.login_from.focus();
						return false;
				}
				ret = false;
			}	
		}
		if (frm.login_to.value==""){
			alert("총로그인횟수를 입력하세요");
			frm.login_to.focus();
			return false;
		}
		else{
			var len =frm.login_to.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				 var ch = frm.login_to.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.login_to.focus();
						return false;
				}
				ret = false;
			}	
		}
	}
	
	
	if(frm.money_use[1].checked){
		
		if (frm.money_from.value==""){
			alert("총구매액을 입력하세요");
			frm.money_from.focus();
			return false;
		}
		else{
			var len =frm.money_from.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				 var ch = frm.money_from.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.money_from.focus();
						return false;
				}
				ret = false;
			}	
		}
		if (frm.money_to.value==""){
			alert("총구매액을 입력하세요");
			frm.money_to.focus();
			return false;
		}
		else{
			var len =frm.money_to.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				 var ch = frm.money_to.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.money_to.focus();
						return false;
				}
				ret = false;
			}	
		}
	}
	
	
	if(frm.bonus_use[1].checked){
		
		if (frm.bonus_from.value==""){
			alert("포인트를 입력하세요");
			frm.bonus_from.focus();
			return false;
		}
		else{
			var len =frm.bonus_from.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				 var ch = frm.bonus_from.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.bonus_from.focus();
						return false;
				}
				ret = false;
			}	
		}
		if (frm.bonus_to.value==""){
			alert("포인트를 입력하세요");
			frm.bonus_to.focus();
			return false;
		}
		else{
			var len =frm.bonus_to.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				 var ch = frm.bonus_to.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.bonus_to.focus();
						return false;
				}
				ret = false;
			}	
		}
	}
	
}  
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>업체회원 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><table width="100%" border="0">
					 <tr>
						<td width="100%" height="20"><p align="left"><strong>[업체회원그룹관리&gt; 그룹 수정]</strong></td>
					 </tr>
				  </table>
				  </td>
				</tr>
				
		<form action='mem_grp_edit.php' method='post' onsubmit='return checkform(this)'>
		<input type='hidden' name='flag' value='update'>
		<input type='hidden' name='grp_no' value='<?echo $grp_no?>'>
				<?
				$SQL = "select * from $Member_GroupTable where mart_id='$mart_id' and grp_no=$grp_no";
				$dbresult = mysql_query($SQL,$dbconn);
				$numRows = mysql_num_rows($dbresult);
				if($numRows>0){
					mysql_data_seek($dbresult,0);
						$ary = mysql_fetch_array($dbresult);
						$grp_name = $ary["grp_name"];
					$grp_detail = $ary["grp_detail"];
					$area_use = $ary["area_use"];
					$sex_use = $ary["sex_use"];
					$age_use = $ary["age_use"];
					$login_use = $ary["login_use"];
					$money_use = $ary["money_use"];
					$bonus_use = $ary["bonus_use"];
					$area = $ary["area"];
					$sex = $ary["sex"];
					$age_from = $ary["age_from"];
					$age_to = $ary["age_to"];
					$login_from = $ary["login_from"];
					$login_to = $ary["login_to"];
					$money_from = $ary["money_from"];
					$money_to = $ary["money_to"];
					$bonus_from = $ary["bonus_from"];
					$bonus_to = $ary["bonus_to"];
					}					
				?>
				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table
				  width="97%" border="0">
					 <tr>
						<td width="100%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%"
						border="0">
						  <tr>
							 <td align="middle" width="100%" bgColor="#8FBECD" colspan="2" height="25"><p align="left"><strong>&nbsp; 새로운 그룹을 등록합니다.</strong></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">그룹명</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input name="grp_name" value='<?echo $grp_name?>' class="input_03" size="16"></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">그룹설명</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input name="grp_detail" value='<?echo $grp_detail?>' class="input_03" size="46"></td>
						  </tr>
						  <tr>
							 <td align="left" width="100%" bgColor="#8FBECD" colspan="2" height="25"><strong><span
							 class="dd">&nbsp; 그룹에 맞는 조건을 체크합니다.</strong></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">지역</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="area_use" value="0"
							 <?
							 if($area_use == '0') echo " checked";
							 ?>
							 ><span class="aa">모든 지역&nbsp; 
							 <input type="radio" name="area_use" value="1"
							 <?
							 if($area_use == '1') echo " checked";
							 ?>
							 >지역선택 
							 &nbsp; 
							 <select name='area' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid rgb(0,0,0)" size="1">
								<option value="서울"
								<?
								if($area == '서울') echo " selected";
								?>
								>서울</option>
								<option value="인천"
								<?
								if($area == '인천') echo " selected";
								?>
								>인천</option>
								<option value="대전"
								<?
								if($area == '대전') echo " selected";
								?>
								>대전</option>
								<option value="대구"
								<?
								if($area == '대구') echo " selected";
								?>
								>대구</option>
								<option value="부산"
								<?
								if($area == '부산') echo " selected";
								?>
								>부산</option>
								<option value="광주"
								<?
								if($area == '광주') echo " selected";
								?>
								>광주</option>
								<option value="울산"
								<?
								if($area == '울산') echo " selected";
								?>
								>울산</option>
								<option value="경기"
								<?
								if($area == '경기') echo " selected";
								?>
								>경기</option>
								<option value="경남"
								<?
								if($area == '경남') echo " selected";
								?>
								>경남</option>
								<option value="경북"
								<?
								if($area == '경북') echo " selected";
								?>
								>경북</option>
								<option value="전남"
								<?
								if($area == '전남') echo " selected";
								?>
								>전남</option>
								<option value="전북"
								<?
								if($area == '전북') echo " selected";
								?>
								>전북</option>
								<option value="충남"
								<?
								if($area == '충남') echo " selected";
								?>
								>충남</option>
								<option value="충북"
								<?
								if($area == '충북') echo " selected";
								?>
								>충북</option>
								<option value="강원"
								<?
								if($area == '강원') echo " selected";
								?>
								>강원</option>
								<option value="제주"
								<?
								if($area == '제주') echo " selected";
								?>
								>제주</option>
							 </select></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">성별</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="sex_use" value="0"
							 <?
							 if($sex_use == '0') echo " checked";
							 ?>
							 ><span class="aa">모든 성별&nbsp; 
							 <input type="radio" name="sex_use" value="1"
							 <?
							 if($sex_use == '1') echo " checked";
							 ?>
							 >성별선택 
							 &nbsp; 
							 <select name='sex' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
							 <option value="1"
							 <?
								if($sex == '1') echo " selected";
							 ?>
							 >남</option>
							 <option value="2"
							 <?
								if($sex == '2') echo " selected";
							 ?>
							 >여</option>
							 </select></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">연령</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="age_use" value="0"
							 <?
							 if($age_use == '0') echo " checked";
							 ?>
							 ><span class="aa">모든 연령&nbsp; 
							 <input type="radio" name="age_use" value="1"
							 <?
							 if($age_use == '1') echo " checked";
							 ?>
							 >연령선택 
							 &nbsp; 
							 <select name='age_from' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
							 <option value="10"
							 <?
								if($age_from == '10') echo " selected";
							 ?>
							 >10대</option>
							 <option value="20"
							 <?
								if($age_from == '20') echo " selected";
							 ?>
							 >20대</option>
							 <option value="30"
							 <?
								if($age_from == '30') echo " selected";
							 ?>
							 >30대</option>
							 <option value="40"
							 <?
								if($age_from == '40') echo " selected";
							 ?>
							 >40대</option>
							 <option value="50"
							 <?
								if($age_from == '50') echo " selected";
							 ?>
							 >50대</option>
							 <option value="60"
							 <?
								if($age_from == '60') echo " selected";
							 ?>
							 >60대이상</option>
							 </select>~ 
							 <select name='age_to' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
							 <option value="19"
							 <?
								if($age_to == '19') echo " selected";
							 ?>
							 >10대</option>
							 <option value="29"
							 <?
								if($age_to == '29') echo " selected";
							 ?>
							 >20대</option>
							 <option value="39"
							 <?
								if($age_to == '39') echo " selected";
							 ?>
							 >30대</option>
							 <option value="49"
							 <?
								if($age_to == '49') echo " selected";
							 ?>
							 >40대</option>
							 <option value="59"
							 <?
								if($age_to == '59') echo " selected";
							 ?>
							 >50대</option>
							 <option value="100"
							 <?
								if($age_to == '100') echo " selected";
							 ?>
							 >60대이상</option>
							 </select></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">총로그인횟수</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="login_use" value="0"
							 <?
							 if($login_use == '0') echo " checked";
							 ?>
							 ><span class="aa">무관 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							 <input type="radio" name="login_use" value="1"
							 <?
							 if($login_use == '1') echo " checked";
							 ?>
							 >직접입력&nbsp;&nbsp; 
							 <input name="login_from" value='<?echo $login_from?>' class="input_03" size="4">
							 <span class="aa">회 이상 ~ 
							 <input name="login_to" value='<?echo $login_to?>' class="input_03" size="4">
							 <span class="aa">회 이하</td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">총구매액</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="money_use" value="0"
							 <?
							 if($money_use == '0') echo " checked";
							 ?>
							 ><span class="aa">무관 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							 <input type="radio" name="money_use" value="1"
							 <?
							 if($money_use == '1') echo " checked";
							 ?>
							 >직접입력&nbsp;&nbsp; 
							 <input name="money_from" value='<?echo $money_from?>' class="input_03" size="9">
							 <span class="aa">원 이상 ~ 
							 <input name="money_to" value='<?echo $money_to?>' class="input_03" size="9">
							 <span class="aa">원 이하</td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3"><span class="aa">포인트</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="bonus_use" value="0"
							 <?
							 if($bonus_use == '0') echo " checked";
							 ?>
							 ><span class="aa">무관 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							 <input type="radio" name="bonus_use" value="1"
							 <?
							 if($bonus_use == '1') echo " checked";
							 ?>
							 >직접입력&nbsp;&nbsp; 
							 <input name="bonus_from" value='<?echo $bonus_from?>' class="input_03" size="9">
							 <span class="aa">원 이상 ~ 
							 <input name="bonus_to" value='<?echo $bonus_to?>' class="input_03" size="9">
							 <span class="aa">원 이하</td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr align="middle">
				  <td width="100%" height="35" bgColor="#ffffff">
				  <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="수정">
				  <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="reset" value="재입력">
				  <input onclick="window.location.href='mem_grp_list.php'" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="리스트">
				  </td>
				</tr>
				
				</form>
			 </table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
if($flag == 'update'){
	
	$SQL = "update $Member_GroupTable 
	set grp_name = '$grp_name', grp_detail = '$grp_detail', area_use = '$area_use', sex_use = '$sex_use', 
	age_use = '$age_use', login_use = '$login_use', money_use = '$money_use', bonus_use = '$bonus_use', area = '$area', 
	sex = '$sex', age_from = '$age_from', age_to = '$age_to', login_from = '$login_from', login_to = '$login_to', 
	money_from = '$money_from', money_to = '$money_to', bonus_from = '$bonus_from', bonus_to = '$bonus_to'
	where grp_no='$grp_no' and mart_id='$mart_id'"; 

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=mem_grp_list.php'>";
}	
?>
<?
mysql_close($dbconn);
?>