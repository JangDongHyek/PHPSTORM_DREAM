<!--
// 호출페이지 : http://www.2000272.co.kr/onlineShop/ResultSms.php
// 받드시 필요한 값
// $_SHOPGROUP : 온라인 그룹명 (예:bluecart)
// $_SHOPID : 온라인그룹에서 쓰이는 상점ID (예:online)
// $_USERID : 사용자 ID
// $cname : 사용자 이름
// $url : 리턴 URL
// $mode : 1:상품주문, 2:상품배송, 3:입금확인
// $hp1 : 핸드폰1
// $hp2 : 핸드폰2
// $hp3 : 핸드폰3

// 상품주문지 필요사항
// $item : 상품이름 : 최대 한글 10자이내

// 상품배송, 입금확인시 필요사항
// $indate : 입금일 또는 배송일 (예 : 2003-01-01) 없으면 자동으로 현재 날짜가 찍힘
-->
<html>
<head><title>SMS발송예제</title></head>
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

	if (form.item.value == '') {
        alert('상품명을 입력하세요');
        form.item.focus();
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
<form method='POST' action='http://www.2000272.co.kr/onlineShop/ResultSms.php' name=custinput onSubmit='return valid_customer();'>
<input type='hidden' name='mode' value='1'>
<input type='hidden' name='_SHOPGROUP' value='bluecart'>
<input type='hidden' name='_SHOPID' value='online'>
<input type='hidden' name='url' value='http://www.2000272.co.kr/onlineShop/test/SendSmsTestResult.php'>
	<TR><TD bgColor='#FFA633' colSpan=4 align=center height=25>
		<select name='mode'>
		<option value='1'>상품주문</option>
		<option value='2'>상품배송</option>
		<option value='3'>입금확인</option>
		</select>
	</TD></TR>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>고 객 명</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input style='text' size=15 name=cname value='' maxlength='15'>
		</td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>상품이름</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input style='text' size=15 name=item value='테스트상품' maxlength='15'>
		</td>
	</tr>
	</TR>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>배송일</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
			<input style='text' size=10 name=indate value='2003-12-01' maxlength='10'>
		</td>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>고객ID</b></td>
		<td width='35%' bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp; 	<input style='text' size=15 name='_USERID' maxlength='30'></td>
	</tr>
	<tr height='25' bgColor='#FFECD4'>
		<td width='15%' align='center' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'><b>휴대전화</b></td>
		<td width='85%' colspan=3 bgColor='#F7F7F7' style='border-right: 1 solid #c9c9c9;border-bottom: 1 solid #c9c9c9'>&nbsp;
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
	</tr>	<TR><TD bgColor='#FFA633' colSpan=4 height=2></TD></TR><tr>
		<td align=center colspan=4 height=30><input type=submit value=' SMS발송 '></td>
	</tr>
</table>
</form>
</body>
</html>