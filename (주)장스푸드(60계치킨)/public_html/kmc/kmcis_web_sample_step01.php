<?php
	//************************************************************************
	//																		//
	//		본 샘플소스는 개발 및 테스트를 위한 목적으로 만들어졌으며,		//
	//																		//
	//		실제 서비스에 그대로 사용하는 것을 금합니다.					//
	//																		//
	//************************************************************************

	/************************************************************************************/
	/* - 결과값 복호화를 위해 IV 값을 Random하게 생성함.(반드시 필요함!!)				*/
	/* - input박스 certNum의 value값을  echo $CurTime.$RandNo  형태로 지정				*/
 	/************************************************************************************/
    $CurTime = date('YmdHis');
	$RandNo = rand(100000, 999999);

	//요청 번호 생성
	$reqNum = $CurTime.$RandNo;
?>
<html>
    <head>
        <title>KMC 본인확인서비스  테스트</title>
        <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<meta name="robots" content="noindex">
        <style>
            <!--
            body,p,ol,ul,td
            {
                font-family: 굴림;
                font-size: 12px;
            }

            a:link { size:9px;color:#000000;text-decoration: none; line-height: 12px}
            a:visited { size:9px;color:#555555;text-decoration: none; line-height: 12px}
            a:hover { color:#ff9900;text-decoration: none; line-height: 12px}

            .style1 {
                color: #6b902a;
                font-weight: bold;
            }
            .style2 {
                color: #666666
            }
            .style3 {
                color: #3b5d00;
                font-weight: bold;
            }
            -->
        </style>
    </head>
    <body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>
        <center>
            <br><br><br>
            <span class="style1">KMC 본인확인서비스 테스트</span><br>

            <form name="reqForm" method="post" action="http://고객사별경로/kmcis_web_sample_step02.php">
                <table cellpadding=1 cellspacing=1>
                    <tr>
                        <td align=center>고객사ID</td>
                        <td align=left><input type="text" name="cpId" size='41' maxlength ='10' value = ""></td>
                    </tr>
                    <tr>
                        <td align=center>URL코드</td>
                        <td align=left><input type="text" name="urlCode" size='41' maxlength ='6' value=""></td>
                    </tr>
                    <tr>
                        <td align=center>요청번호</td>
                        <td align=left><input type="text" name="certNum" size='41' maxlength ='40' value='<?php echo $reqNum ?>'></td>
                    </tr>
                    <tr>
                        <td align=center>요청일시</td>
						<!-- 현재시각 세팅(YYYYMMDDHI24MISS) -->
                        <td align=left><input type="text" name="date" size="41" maxlength ='14' value="<?php echo ($CurTime)  ?>"></td>
					</tr>
					<tr>
						<td align=center><font color="red">*</font>본인확인방법</td>
						<td align=left>
							<select name="certMet" id="certMet" style="width:300">
								<option value="M" selected>본인확인방법 선택</option>
							</select>
						</td>
					</tr
                    <tr>
                        <td align=center>추가DATA정보</td>
                        <td align=left><input type="text" name="plusInfo"  size="41" maxlength ='320' value=""></td>
                    </tr>
                    <tr>
                        <td align=center>결과수신URL</td>
                        <td align=left><input type="text" name="tr_url" size="41" value="http://고객사별 경로/kmcis/web/kmcis_web_sample_step03.php"></td>
                    </tr>
                    <tr>
                        <td align=center>IFrame사용여부</td>
                        <td align=left>
                            <select name="tr_add" style="width:300">
                                <option value="N"selected>미사용</option>
                                <option value="Y">사용</option>
                            </select>
                        </td>
                    </tr>					
                </table>
                <br><br>
                <input type="submit" value="본인인증 테스트">
            </form>
            <br>
            <br>
            이 Sample화면은 KMC 본인확인서비스 테스트를 위해 제공하고 있는 화면입니다.<br>
            <br>
        </center>
    </body>
</html>