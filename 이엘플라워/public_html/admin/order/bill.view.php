<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	

/*SMS $SQL = "select * from $Sms_ConfigTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$sms_user = $ary[sms_user];
	$sms_passwd = $ary[sms_passwd];
	$mart_name = $ary[mart_name];
	$callback_num1 = $ary[callback_num1];
	$callback_num2 = $ary[callback_num2];
	$callback_num3 = $ary[callback_num3];
	$admin_num1 = $ary[admin_num1];
	$admin_num2 = $ary[admin_num2];
	$admin_num3 = $ary[admin_num3];
	$if_money_chk_msg = $ary[if_money_chk_msg];
	$money_chk_msg = $ary[money_chk_msg];
	$if_product_send_msg = $ary[if_product_send_msg];
	$product_send_msg = $ary[product_send_msg];
	$if_order_cancel_msg = $ary[if_order_cancel_msg];
	$order_cancel_msg = $ary[order_cancel_msg];
	$if_order_cancel_msg_admin = $ary[if_order_cancel_msg_admin];
	$order_cancel_msg_admin = $ary[order_cancel_msg_admin];
}*/


	
	include "../admin_head.php";
	include "../stat/cal.php";
	
	$sql="select * from shop_bill where 1 and idx='$idx'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$qstr="&key=".$key."&search=".$search;
?>
<style>
	.page-link{
		border:1px solid #2683ff;
		color:#2683ff;
		float:left;
		min-width:15px;
		padding:5px;
		padding-top:8px;
		text-align:center;
		border-radius:5px;
	}
	.page-active{
		background-color:#2683ff;
		color:#fff;
		font-weight:bold;
	}
	.page-active:visited{
		color:#fff;
		font-weight:bold;
	}
	.page-link:hover{
		background-color:#2683ff;
		color:#fff;
		font-weight:bold;
	}
</style>
<script type="text/javascript">
	function billDelete(idx){
		var q=confirm("계산요청서를 삭제하시겠습니까? 삭제하시면 복구는 불가능합니다.");
		if(q){
			location.href="./bill.delete.php?idx="+idx+"&page=<?=$page?><?=$qstr?>";
		}
	}
</script>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu4.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">주문관리</span> &gt; <span class="text_gray2_c">계산서요청 </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>계산서요청 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">
					고객들의 계산서 요청입니다.
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" align="center">
					<b><a href='bill.list.php'>[전체목록 보기]</a> </b>
				</td>
				</tr>
				<!-- 검색 폼 시작 -->
				
				
					
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
						<tr>
							<td width="90%">
								<!-- 상세보기 시작 -->
								<table border="1" width="100%" cellspacing="0" cellpadding="5">
									<tr>
										<td bgcolor="#8FBECD" width="100">회사명</td>
										<td width="220"><?=$row[company]?></td>
										<td bgcolor="#8FBECD" width="100">대표자명</td>
										<td><?=$row[repres]?></td>
									</tr>
									<tr>
										<td bgcolor="#8FBECD">업태</td>
										<td><?=$row[business]?></td>
										<td bgcolor="#8FBECD">업종</td>
										<td><?=$row[line]?></td>
									</tr>
									<tr>
										<td bgcolor="#8FBECD">사업자주소</td>
										<td colspan="3"><?=$row[biz_addr]?></td>
									</tr>
									<tr>
										<td bgcolor="#8FBECD">사업자번호</td>
										<td colspan="3"><?=$row[biz_no]?></td>
									</tr>
									<tr>
										<td bgcolor="#8FBECD">주문번호</td>
										<td><?=$row[order_no]?></td>
										<td bgcolor="#8FBECD">수령자이메일</td>
										<td><?=$row[res_email]?></td>
									</tr>
								</table>
								<!-- 상세보기 끝 -->
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="./bill.list.php?page=<?=$page?>&key=<?=$key?>&search=<?=$search?>">목록보기</a>
								<a href="javascript:;" onclick="billDelete('<?=$row[idx]?>');">삭제하기</a>
							</td>
						</tr>
					</table>
				</td>
				</tr>
			</table>
			
			</form>
				

			  </td>
  </tr>
</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
