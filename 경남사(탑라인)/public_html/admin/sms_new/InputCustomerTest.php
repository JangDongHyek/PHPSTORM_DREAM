<!--
// 호출페이지 : http://www.2000272.co.kr/onlineShop/ResultCustomer.php
// 받드시 필요한 값
// $_SHOPGROUP : 온라인 그룹명 (예:bluecart)
// $_SHOPID : 온라인그룹에서 쓰이는 상점ID (예:online)
// $_USERID : 사용자 ID
// $url : 리턴 URL
// $mode : 1:고객추가,2:고객삭제,3:고객정보수정

// 고객추가 및 수정시 받드시 필요한 값
// $cname : 고객명
// $hp1 : 핸드폰1
// $hp2 : 핸드폰2
// $hp3 : 핸드폰3

// 고객추가시 추가사항
// $sex : 성별 1:남자,2:여자
// $bdate1 : 생년
// $bdate2 : 생월
// $bdate3 : 생일
// $bdate_gub : 생일구분 1:양력,2:음력
// $memorial1 : 기념일1 이름
// $m_year1 : 기념일1 년
// $m_month1 : 기념일1 월
// $m_day1 : 기념일1 일
// $memorial2 : 기념일2 이름
// $m_year2 : 기념일2 년
// $m_month2 : 기념일2 월
// $m_day2 : 기념일2 일
-->
<html>
<head><title>회원등록 예제</title></head>
<body bgcolor=white>
<SCRIPT LANGUAGE='JavaScript'>
<!--
function valid_customer ()
{
	var form = document.custinput;
	var cname = form.cname.value ;
	var hp1 = form.hp1.value ;
	var hp2 = form.hp2.value ;
	var hp3 = form.hp3.value ;
	var bdate1 = form.bdate1.value ;
	var bdate2 = form.bdate2.value ;
	var bdate3 = form.bdate3.value ;

	if (cname == '') {
        alert('성명을 입력하세요');
        form.cname.focus();
        return false;
    }
	if (form._USERID.value == '') {
        alert('ID을 입력하세요');
        form._USERID.focus();
        return false;
    }

    if ((hp1 == '')||(hp2 == '')||(hp3 == '')) {
        alert('핸드폰번호를 입력하세요');
        form.hp1.focus();
        return false;
    }
	return true;
}

//-->
</SCRIPT>

<table width='100%' border='0' cellpadding='0' cellspacing='0' align=center>
<form method='POST' action='http://www.2000272.co.kr/onlineShop/ResultCustomer.php' name=custinput onSubmit='return valid_customer();'>
<input type='hidden' name='mode' value='1'>
<input type='hidden' name='_SHOPGROUP' value='bluecart'>
<input type='hidden' name='_SHOPID' value='online'>
<input type='hidden' name='url' value='http://www.2000272.co.kr/onlineShop/test/InputCustomerResult.php'>
	<TR><TD bgColor='#FFA633' colSpan=4 align=center height=25>
		<select name='mode'>
		<option value='1'>고객추가</option>
		<option value='2'>고객삭제</option>
		<option value='3'>고객수정</option>
		</select>
	</TD></TR>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>고 객 명</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; <input style='text' size=15 name=cname value='' maxlength='15'></td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>성  별</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input type='radio' name='sex' value='1' checked>남 <input type='radio' name='sex' value='2'>여
		</td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>고객ID</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; 	<input style='text' size=15 name='_USERID' maxlength='30'></td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>휴대전화</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<select name=hp1>
			<option value=''>선택</option>
			<option value=010>010</option>
			<option value=011>011</option>
			<option value=016>016</option>
			<option value=017>017</option>
			<option value=018>018</option>
			<option value=019>019</option>
			</select>
			- 
			<input style='text' size=4 name=hp2 value='' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'  maxlength='4'>
			- 
			<input style='text' size=4 name=hp3 value='' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'  maxlength='4'>
		</td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>생년월일</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; 
			<input type=text name=bdate1 value='1990' size=4 maxlength=4>년
			<input type=text name=bdate2 value='1' size=2 maxlength=2>월
			<input type=text name=bdate3 value='1' size=2 maxlength=2>일
		</td>
		<td width='50%' bgColor='#F7F7F7' colspan=2 align='left' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
		  <input type='radio' name='bdate_gub' value='1' checked>양력 
		  <input type='radio' name='bdate_gub' value='2'>음력
		</td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>기념일1</b></td>
		<td width='85%' colspan=3 bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			기념일이름 : <input style='text' size=15 name=memorial1 maxlength='15'>
			&nbsp;&nbsp;<input type=text name='m_year1' size=4 maxlength=4>년
			<input type=text name='m_month1' size=2 maxlength=2>월
			<input type=text name='m_day1' size=2 maxlength=2>일
		</td>
	</tr><tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>기념일2</b></td>
		<td width='85%' colspan=3 bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			기념일이름 : <input style='text' size=15 name=memorial2 maxlength='15'>
			&nbsp;&nbsp;<input type=text name='m_year2' size=4 maxlength=4>년
			<input type=text name='m_month2' size=2 maxlength=2>월
			<input type=text name='m_day2' size=2 maxlength=2>일
		</td>
	</tr>	<TR><TD bgColor='#FFA633' colSpan=4 height=2></TD></TR><tr>
		<td align=center colspan=4 height=30><input type=submit value=' 회원등록 '></td>
	</tr>
</table>
</form>
</body>
</html>