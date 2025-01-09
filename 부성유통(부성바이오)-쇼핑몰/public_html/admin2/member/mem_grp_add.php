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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgColor="#ffffff">새로운 회원그룹을 생성합니다.</td>
				</tr>

				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><table width="100%" border="0">
					 <tr>
						<td width="100%" height="20"><p align="left"><strong>[회원그룹관리&gt; 그룹 새로등록]</strong></td>
					 </tr>
				  </table>
				  </td>
				</tr>
				
<form action='mem_grp_add.php' method='post' onsubmit='return checkform(this)'>
<input type='hidden' name='flag' value='add'>
				
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
							 <td align="left" width="14%" bgColor="#F3F3F3">그룹명</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input name="grp_name"class="input_03" size="16"></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">그룹설명</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input name="grp_detail"class="input_03" size="46"></td>
						  </tr>
						  <tr>
							 <td align="left" width="100%" bgColor="#8FBECD" colspan="2" height="25"><strong>&nbsp; 그룹에 맞는 조건을 체크합니다.</strong></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">지역</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="area_use" value="0" checked>모든 지역&nbsp; 
							 <input type="radio" name="area_use" value="1">지역선택 
							 &nbsp; 
							 <select name='area' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid rgb(0,0,0)" size="1">
								<option value="서울" selected>서울</option>
								<option value="인천">인천</option>
								<option value="대전">대전</option>
								<option value="대구">대구</option>
								<option value="부산">부산</option>
								<option value="광주">광주</option>
								<option value="울산">울산</option>
								<option value="경기">경기</option>
								<option value="경남">경남</option>
								<option value="경북">경북</option>
								<option value="전남">전남</option>
								<option value="전북">전북</option>
								<option value="충남">충남</option>
								<option value="충북">충북</option>
								<option value="강원">강원</option>
								<option value="제주">제주</option>
							 </select></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">성별</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="sex_use" value="0" checked>모든 성별&nbsp; 
							 <input type="radio" name="sex_use" value="1">성별선택 
							 &nbsp; 
							 <select name='sex' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
							 <option value="1">남</option>
							 <option value="2">여</option>
							 </select></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">연령</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="age_use" value="0" checked>모든 연령&nbsp; 
							 <input type="radio" name="age_use" value="1">연령선택 
							 &nbsp; 
							 <select name='age_from' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
							 <option value="10">10대</option>
							 <option value="20">20대</option>
							 <option value="30">30대</option>
							 <option value="40">40대</option>
							 <option value="50">50대</option>
							 <option value="60">60대이상</option>
							 </select>~ 
							 <select name='age_to' style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
							 <option value="19">10대</option>
							 <option value="29">20대</option>
							 <option value="39">30대</option>
							 <option value="49">40대</option>
							 <option value="59">50대</option>
							 <option value="100">60대이상</option>
							 </select></td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">총로그인횟수</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="login_use" value="0" checked>무관 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							 <input type="radio" name="login_use" value="1">직접입력&nbsp;&nbsp; 
							 <input name="login_from" class="input_03" size="4">
							 회 이상 ~ 
							 <input name="login_to" class="input_03" size="4">
							 회 이하</td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">총구매액</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="money_use" value="0" checked>무관 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							 <input type="radio" name="money_use" value="1">직접입력&nbsp;&nbsp; 
							 <input name="money_from" class="input_03" size="9">
							 원 이상 ~ 
							 <input name="money_to" class="input_03" size="9">
							 원 이하</td>
						  </tr>
						  <tr>
							 <td align="left" width="14%" bgColor="#F3F3F3">포인트</td>
							 <td align="left" width="86%" bgColor="#ffffff">
							 <input type="radio" name="bonus_use" value="0" checked>무관 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							 <input type="radio" name="bonus_use" value="1">직접입력&nbsp;&nbsp; 
							 <input name="bonus_from" class="input_03" size="9">
							 원 이상 ~ 
							 <input name="bonus_to" class="input_03" size="9">
							 원 이하</td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr align="middle">
				  <td align="center" width="100%" bgColor="#ffffff" height="35">
				  <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="등록">
				  <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="reset" value="재입력">
				  <input onclick="window.location.href='mem_grp_list.php'" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="리스트"></td>
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
if($flag == 'add'){
	$date = date("Y-m-d H:i:s");

	$SQL = "insert into $Member_GroupTable 
	(mart_id, grp_name, grp_detail, area_use, sex_use, age_use, login_use, money_use, bonus_use, area, sex, age_from, 
	age_to, login_from, login_to, money_from, money_to, bonus_from, bonus_to, date) 
	values ('$mart_id', '$grp_name', '$grp_detail', '$area_use', '$sex_use', '$age_use', '$login_use', '$money_use', 
	'$bonus_use', '$area', '$sex', '$age_from', '$age_to', '$login_from', '$login_to', '$money_from', '$money_to', 
	'$bonus_from', '$bonus_to', '$date')";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=mem_grp_list.php'>";
}	
?>
<?
mysql_close($dbconn);
?>