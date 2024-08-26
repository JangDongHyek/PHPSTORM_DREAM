<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ks_c_5601-1987">
<title>기존배송지 리스트</title>
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt;  color: #5B5B5B}
.bb {   font-size: 9pt; color: #FFFFFF}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
<script>
function ReturnFocus(receiver,rev_tel,rev_tel1,zip,address,address_d) {	
	top.opener.document.f.receiver.value = receiver;
	top.opener.document.f.rev_tel.value = rev_tel;
	top.opener.document.f.rev_tel1.value = rev_tel1;	
	top.opener.document.f.zip.value = zip;	
	top.opener.document.f.address.value = address;	
	top.opener.document.f.address_d.value = address_d;	
 	window.close(); 
}	
</script>
</head>

<body topmargin="0" bgcolor="#FFFFFF" leftmargin="0" style='overflow-x:hidden; overflow-y:scroll;'>

<table border="0" width="569" height="300" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0"
    cellpadding="0">
      <tr>
        <td width="100%"><img src="../images/pastadr_title.gif" width="569" height="56"></td>
      </tr>
      <tr>
        <td width="100%" height="5"></td>
      </tr>
      <tr>
        <td width="100%"><div align="center"><center><table border="0" width="560" cellspacing="0"
        cellpadding="0">
          <tr>
            <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center><table
            border="0" width="97%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" height="20"></td>
              </tr>
              <tr>
                <td width="100%" align="left"><span class="aa">　<img
                src="../../admin/images/bullet4.gif" align="absmiddle"> 아래의 
                기존 배송지 중에서 해당 배송지의 선택버튼을 눌러주십시오</span>. </td>
              </tr>
              <tr>
                <td width="100%" height="8"></td>
              </tr>
              <tr>
                <td width="552" bgColor="#FFFFFF">
					<table border="5" width="552" bordercolor="#E0E0E0" cellspacing="0">
						<tr>
							<td width="552">
								<table border="0" width="552" cellspacing="0" cellpadding="0">
									<tr>
										<td width="58" bgcolor="#42BDBD" height="25" align="center"><span class="bb">수령인</span></td>
										<td width="90" bgcolor="#42BDBD" height="25" align="center"><span class="bb">전화번호</span></td>
										<td width="4" bgcolor="#42BDBD" height="25" align="center"><span class="bb"></span></td>
										<td width="361" bgcolor="#42BDBD" height="25" align="center"><span class="bb">배송지 
										주소</span></td>
										<td width="39" bgcolor="#42BDBD" height="25" align="center"><span class="bb">선택</span></td>
									</tr>
<?
$SQL = "select * from $Order_BuyTable where id='$id' and mart_id='$mart_id' order by zip";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for($i=0;$i<$numRows;$i++){
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$receiver = $ary["receiver"];
	$rev_tel = $ary["rev_tel"];
	$rev_tel1 = $ary["rev_tel1"];
	$zip = $ary["zip"];
	$address = $ary["address"];
	$address_d = $ary["address_d"];
	
	if($receiver_old == $receiver && $rev_tel_old == $rev_tel &&	$rev_tel1_old == $rev_tel1 && 
	$zip_old == $zip && $address_old == $address &&	$address_d_old == $address_d) continue;
	
	$receiver_old = $receiver;
	$rev_tel_old = $rev_tel;
	$rev_tel1_old = $rev_tel1;
	$zip_old = $zip;
	$address_old = $address;
	$address_d_old = $address_d;
?>
									<tr>
										<td width='58' bgcolor='#FFFFFF' height='25' align='center'><span class='aa'><?=$receiver?></span></td>
										<td width='90' bgcolor='#FFFFFF' height='25' align='center'><span class='aa'><?=$rev_tel?></span></td>
										<td width='4' bgcolor='#FFFFFF' height='25'><span class='aa'></span></td>
										<td width='361' bgcolor='#FFFFFF' height='25'><span class='aa'><font color='#0000FF'><?=$zip?></font> 
										<?=$address $address_d?></span></td>
										<td width='39' bgcolor='#FFFFFF' height='25' align='center'>
										<a href="javascript:ReturnFocus('<?=$receiver?>','<?=$rev_tel?>','<?=$rev_tel1?>','<?=$zip?>','<?=$address?>','<?=$address_d?>')">
										<img src='../images/pastadr_select.gif' width='34' height='18' border='0'></td>
									</tr>
<?
	if($i+1 < $numRows){
?>
									<tr>
										<td width='58' bgcolor='#F0F0F0' height='1' align='center'></td>
										<td width='90' bgcolor='#F0F0F0' height='1' align='center'></td>
										<td width='4' bgcolor='#F0F0F0' height='1'></td>
										<td width='361' bgcolor='#F0F0F0' height='1'></td>
										<td width='39' bgcolor='#F0F0F0' height='1' align='center'></td>
									</tr>
<?
	}
}
?>	
								</table>
							</td>
						</tr>
					</table>
                </td>
              </tr>
              <tr>
                <td width="100%" height="7" align="center">
                <br>
                <input class="bb" onclick="window.close()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="창닫기">
                </td>
              </tr>
            </table>
            </center></div></td>
          </tr>
        </table>
        </center></div></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>