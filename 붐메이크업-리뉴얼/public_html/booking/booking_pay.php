<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>붐메이컵 입니다.</title>
<link href="../img/style.css" type=text/css rel=stylesheet>
<script language="javascript">
<!--
	var time = new Date()
	var year = time.getYear()
	var month = time.getMonth() + 1
	var day = time.getDate()

	year = year.toString();
	if(month < 10 == 1) {
		month = "0"+month.toString();
	} else {
		month = month.toString();
	}
	if(day < 10) {
		day = "0"+day.toString();
	} else {
		day = day.toString();
	}

    function allblur() {
         for (i = 0; i < document.links.length; i++)
              document.links[i].onfocus = document.links[i].blur;
    }

	function sendForm() {
		var form= window.frm;
		var sendVal;
		
		if(form.paybank.value == "") {
			alert("입금은행을 입력하세요");
			form.paybank.focus();
			return;
		}
		if(form.payname.value == "") {
			alert("입금자성명을 입력하세요");
			form.payname.focus();
			return;
		}
		if(form.payamt.value == "") {
			alert("입금액을 입력하세요");
			form.payamt.focus();
			return;
		}

		//입력한 값을 iframe으로 넘김
		sendVal="<input type='hidden' name='no' value='<?= $no ?>'>";
		sendVal=sendVal+"<input type='hidden' name='paybank' value='"+form.paybank.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='paydate' value='"+form.paydate_yyyy.value+form.paydate_mm.value+form.paydate_dd.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='payname' value='"+form.payname.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='payamt' value='"+form.payamt.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='flag' value='Y'>"; //flag=Y일때만 아이프레임에서 작업되도록
	
		window.ifmRegist.frmResult.innerHTML=sendVal;
		window.ifmRegist.frmResult.submit();
	}
//-->
</script>
</head>
<body onLoad="allblur();" bgcolor="D1D1D1" leftmargin="0" topmargin="0">

<table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top" height="50"><img src="img/booking_pay_tit.gif" width="400" height="50"></td>
    </tr>
    <tr>
        <td valign="top" align="center" bgcolor="7D7D7D">
            <table width="385" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#FFFFFF" align="center" valign="top" style="margin:5pt;">
            <table width="385" border="0" cellpadding="2">
                            <tr>
                                <td bgcolor="white" align="center" width="377">
                                    <table align="center" width="98%">
                                      <form name="frm" method="post">
                                        <tr>
                                            <td>입금은행</td>
                                            <td><input type="text" name="paybank">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>입금일자</td>
                                            <td>
      <select name="paydate_yyyy" style="width:50px;">
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
      </select>년
      <select name="paydate_mm" style="width:40px">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
      </select>월
      <select name="paydate_dd" style="width:40px">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
      </select>일
      <script language="javascript">
		frm.paydate_yyyy.value = year;
		frm.paydate_mm.value = month;
		frm.paydate_dd.value = day;
      </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>입금자성명</td>
                                            <td><input type="text" name="payname">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>입금액</td>
                                            <td><input type="text" name="payamt">
                                            </td>
                                        </tr>
                                      </form>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="E8E8E8" align="center" width="377">
                                    <TABLE cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR>
                                            <TD>
                                                <p align="center"><IMG height=30 width=60 src="img/gray_ok.gif" border=0 onClick="sendForm()" style="cursor:hand"></TD>
                                            <TD>
                                                <p align="center"><IMG height=30 width=60 src="img/gray_cancel.gif" border=0 onClick="self.close();" style="cursor:hand"></TD>
                                        </TR>
                                        </TBODY>
                                    </TABLE>
                                </td>
                            </tr>
            </table>
			</td>
				</tr>
				<td>&nbsp;</td>
            </table>
        </td>
    </tr>
</table>
</BODY>
<iframe id="ifmRegist" src="booking_pay_ok.php" frameborder="0"  leftmargin="0"  topmargin="0" scrolling="no"  width="0" height="0"></iframe>
</HTML>
