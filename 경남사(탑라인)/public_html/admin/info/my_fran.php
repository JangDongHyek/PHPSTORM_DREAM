<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if(empty($yy)||empty($mm)){ 
	$yy = date("Y");
	$mm = date("m");
}
$SQL = "select * from $MemberTable where username='$Mall_Admin_ID'";
$dbresult = mysql_query($SQL, $dbconn);
$kind = mysql_result($dbresult, 0, "kind");
$fran_provider = str_replace('fran(','',$kind);	
$fran_provider = str_replace(')','',$fran_provider);	
	
$SQL = "select if_use,fran_type,tax_percent,pay_limit_use,pay_limit,article from $Fran_ConfTable where mart_id='$fran_provider'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$tax_percent = mysql_result($dbresult,0,2);
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body bgColor="#ffffff" leftMargin="0" topMargin="0">

<table height="100%" cellSpacing="0" cellPadding="0" width="780" border="0">
  <tr>
    <td>
    </td>
  </tr>
  <tr>
    <td vAlign="top" width="160"><p align="left"><br>
    <br>
    <br>
    </p>
    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td width="100%"><img height="36" src="../images/a1.gif" width="160"></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#6084d5" height="1"></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#f2f2f2"><p style="PADDING-LEFT: 5px"><span class="bb"><br>
        <small>��</small> <font face="����">���θ� ������ <br>
        <strong>&nbsp;&nbsp; ����������</strong>�Դϴ�.</font><br>
        <br>
        </span></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#6084d5" height="1"></td>
      </tr>
    </table>
    </td>
    <td width="1" bgColor="#6084d5"><br>
    </td>
    <td vAlign="top" width="646" bgColor="#ffffff"><br>
    <br>
    <div align="center"><center><table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><p style="PADDING-LEFT: 15px"><span
        class="aa">������������� ���ͱ���ȸȭ���Դϴ�.<br>
        <br>
        </span></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#6084d5" height="1"></td>
      </tr>
      <tr>
        <td vAlign="top" width="90%" bgColor="#ffffff"><p style="PADDING-LEFT: 10px"><span
        class="aa"><br>
        </span></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><p style="PADDING-LEFT: 10px"
        align="left"><span class="aa"><br>
        <strong>[�� �⺻����]</strong></span></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table
        width="95%" border="0" cellspacing="0" cellpadding="0">
          <?
          $SQL = "select name,tel1,url,email,gubun from $MemberTable where username='$Mall_Admin_ID'";
					$dbresult = mysql_query($SQL, $dbconn);
					if ($dbresult == false) echo "���� ���� ����!";
					$name = mysql_result($dbresult,0,0);
					$tel1 = mysql_result($dbresult,0,1);
					$url = mysql_result($dbresult,0,2);
					$email = mysql_result($dbresult,0,3);
					$gubun = mysql_result($dbresult,0,4);
          if($gubun == '1') {
						$gubun_str = '����';
					}
					if($gubun == '2') {
						$gubun_str = '�����';
					}	
					?>
					<tr>
            <td width="90%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%"
            border="0">
              <tr>
                <td align="left" width="7%" bgColor="#C0DAE2"><span class="aa">���̵�</span></td>
                <td align="left" width="21%" bgColor="#FFFFFF"><span class="aa"><?echo $Mall_Admin_ID?></span></td>
                <td align="left" width="8%" bgColor="#C0DAE2"><span class="aa">��ǥ</span></td>
                <td align="left" width="16%" bgColor="#FFFFFF"><span class="aa"><?echo $name?></span></td>
              </tr>
              <tr>
                <td align="left" width="7%" bgColor="#C0DAE2"><span class="aa">��ȭ</span></td>
                <td align="left" width="21%" bgColor="#FFFFFF"><span class="aa"><?echo $tel1?></span></td>
                <td align="left" width="8%" bgColor="#C0DAE2"><span class="aa">��Ÿ ����ó</span></td>
                <td align="left" width="16%" bgColor="#FFFFFF"><span class="aa"><?echo $tel2?></span></td>
              </tr>
              <tr>
                <td align="left" width="7%" bgColor="#C0DAE2"><span class="aa">URL</span></td>
                <td align="left" width="21%" bgColor="#FFFFFF"><a href="http://<?echo $url?>"
                target="_blank"><span class="aa">http://<?echo $url?></span></a></td>
                <td align="left" width="8%" bgColor="#C0DAE2"><span class="aa">�̸���</span></td>
                <td align="left" width="16%" bgColor="#FFFFFF"><span class="aa"><?echo $email?></span></td>
              </tr>
              <tr>
                <td align="left" width="7%" bgColor="#C0DAE2"><span class="aa">����</span></td>
                <td align="middle" width="45%" bgColor="#FFFFFF" colspan="3"><p align="left"><span
                class="aa"><?echo $gubun_str?></span></td>
              </tr>
            </table>
            </td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><p style="PADDING-LEFT: 10px"><span
        class="aa"><strong><br>
        <br>
        [���� ��������]</strong></span></td>
      </tr>
      <form method=post name="list1">
      <tr>
        <td><div align="center"><center><table border="0" width="95%">
          <tr>
            <td width="92%"><span class="bb"><p align="right">&nbsp; 
            <select name="yy" class="aa" style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
              <?
							for($i=2000;$i<=2006;$i++){
								echo ("<option value='$i'");
									if($i == $yy) echo " selected";
								echo ">$i";
							}
							?>
            </select> </span><span class="aa">��</span> <span class="bb">&nbsp; 
            <select name="mm" class="aa" style="height: 18px; background-color: rgb(242,242,242); border: 1px solid black" size="1">
              <?
						for($i=1;$i<=12;$i++){
							if(strlen($i) == 1){
								$i_t = "0".$i;
							}
							else  $i_t = $i;
							echo ("<option value='$i_t'");
							if($i_t == $mm) echo " selected";
							echo ">$i";
						}
						?>
            </select></span> <span class="aa">��</span></td>
            <td width="9%"><span class="aa"><p align="right"></span>
            <input type='image' src="../images/go.gif" width="39" height="18"></td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      </form>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table
        width="95%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="90%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%"
            border="0">
              <tr>
                <td align="center" width="9%" bgColor="#C0DAE2"><span class="aa">���ŰǼ�</span></td>
                <td align="center" width="9%" bgColor="#C0DAE2"><span class="aa">�����</span></td>
                <td align="center" width="9%" bgColor="#C0DAE2"><span class="aa">������</span></td>
                <td align="center" width="9%" bgColor="#C0DAE2"><span class="aa">������</span></td>
                <td align="center" width="8%" bgColor="#C0DAE2"><span class="aa">�Ǽ��ɾ�</span></td>
                <td align="center" width="8%" bgColor="#C0DAE2"><span class="aa">��������</span></td>
              </tr>
              <?
				      $SQL = "select order_num from $Order_BuyTable where mart_id='$mart_id' and status='3' 
				      and substring(date,1,4) ='$yy' and substring(date,5,2) ='$mm' 
				      order by index_no desc";
							//echo "sql=$SQL";
							$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							
							$mon_tot_sum = 0;
							$susu_tot_sum = 0;
							for ($i=0; $i<$numRows; $i++) {
								$order_num = mysql_result($dbresult,$i,0);
								
								$SQL1 = "select z_price,quantity,item_no from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
								//echo "sql=$SQL1";
								$dbresult1 = mysql_query($SQL1, $dbconn);
								$numRows1 = mysql_num_rows($dbresult1);
								
								$mon_tot = 0;
								$susu_tot = 0;
								for ($j=0; $j<$numRows1; $j++) {
									$z_price = mysql_result($dbresult1,$j,0);
									$quantity = mysql_result($dbresult1,$j,1);
									$item_no = mysql_result($dbresult1,$j,2);
									
									$SQL2 = "select provide_price from $ItemTable where item_no='$item_no'";
									//echo "sql=$SQL1";
									$dbresult2 = mysql_query($SQL2, $dbconn);
									$provide_price = mysql_result($dbresult2,0,0);
									
									$sum = $z_price*$quantity;
									$susu = ($z_price-$provide_price)*$quantity;
									
									$mon_tot += $sum;
									$susu_tot += $susu;
								}
				        $mon_tot_sum += $mon_tot;
				        $susu_tot_sum += $susu_tot;
							}
							$gongje = $susu_tot_sum*$tax_percent/100;
							$real_pay = $susu_tot_sum - $gongje;
							
							$SQL3 = "select count(*) from $Fran_PaidTable where fran_id = '$Mall_Admin_ID' and year = '$yy' and month = '$mm'";
							//echo "sql=$SQL";
							$dbresult3 = mysql_query($SQL3, $dbconn);
							$numRows3 = mysql_result($dbresult3,0,0);
							if($numRows3 >= 1) $pay_str = "����";
							else $pay_str = "������";
							?>
							<tr>
                <td align="left" width="9%" bgColor="#F2F2F2"><p align="center"><span class="aa"><?echo $numRows?>��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($mon_tot_sum)?>��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($susu_tot_sum)?>��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($gongje)?>��</span></td>
                <td align="right" width="8%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($real_pay)?>��</span></td>
                <td align="left" width="8%" bgColor="#F2F2F2"><p align="center"><span class="aa"><?echo $pay_str?></span></td>
              </tr>
              <?
        			$SQL = "select year,month from $Fran_PaidTable where fran_id='$Mall_Admin_ID' order by year||month desc";
        			$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if($numRows > 0){
								mysql_data_seek($dbresult,0);
								$ary = mysql_fetch_array($dbresult);
								$year = $ary["year"];
								$month = $ary["month"];
							}
							$max_paid = $year.$month;
							$yymm = $yy.$mm;
					     
					    if($yymm > $max_paid){
		      			$SQL = "select order_num from $Order_BuyTable where mart_id='$mart_id' and status='3' 
		      			and substring(date,1,6) < '$yymm' 
		      			and substring(date,1,6) > '$max_paid' 
		      			order by index_no desc";
							
								//echo "sql=$SQL <br>";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								
								$prev_mon_tot_sum = 0;
								$prev_susu_tot_sum = 0;
								for ($i=0; $i<$numRows; $i++) {
									$order_num = mysql_result($dbresult,$i,0);
									
									$SQL1 = "select z_price,quantity,item_no from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
									//echo "sql1=$SQL1 <br>";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
					
									$mon_tot = 0;
									$susu_tot = 0;
									for ($j=0; $j<$numRows1; $j++) {
										$z_price = mysql_result($dbresult1,$j,0);
										$quantity = mysql_result($dbresult1,$j,1);
										$item_no = mysql_result($dbresult1,$j,2);
										
										$SQL2 = "select provide_price from $ItemTable where item_no='$item_no'";
										//echo "sql2=$SQL2 <br>";
										$dbresult2 = mysql_query($SQL2, $dbconn);
										$provide_price = mysql_result($dbresult2,0,0);
										
										$sum = $z_price*$quantity;
										$susu = ($z_price-$provide_price)*$quantity;
										
										$mon_tot += $sum;
										$susu_tot += $susu;
									}
					        $prev_mon_tot_sum += $mon_tot;
					        $prev_susu_tot_sum += $susu_tot;
								}
								$prev_gongje = $prev_susu_tot_sum*$tax_percent/100;
								$prev_real_pay = $prev_susu_tot_sum - $prev_gongje;
								
								if($prev_real_pay == 0) $pay_str = '';
								else $pay_str = '������';
								?>
              <tr>
                <td align="left" width="9%" bgColor="#C0DAE2"><p align="center"><span class="aa">�����̿���</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($prev_mon_tot_sum)?>��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($prev_susu_tot_sum)?>��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($prev_gongje)?>��</span></td>
                <td align="right" width="8%" bgColor="#F2F2F2"><span class="aa"><?echo number_format($prev_real_pay)?>��</span></td>
                <td align="left" width="8%" bgColor="#F2F2F2"><p align="center"><span class="aa"><?echo $pay_str?></span></td>
              </tr>
              	<?
              }	
              else{
								?>
							<tr>
                <td align="left" width="9%" bgColor="#C0DAE2"><p align="center"><span class="aa">�����̿���</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa">0��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa">0��</span></td>
                <td align="right" width="9%" bgColor="#F2F2F2"><span class="aa">0��</span></td>
                <td align="right" width="8%" bgColor="#F2F2F2"><span class="aa">0��</span></td>
                <td align="left" width="8%" bgColor="#F2F2F2"><p align="center"><span class="aa"></span></td>
              </tr>
              	<?
								$prev_mon_tot_sum = 0;
								$prev_susu_tot_sum = 0;
								$prev_gongje = 0;
								$prev_real_pay = 0;
							}
							$SQL = "select pay_day from $Fran_PaidTable where fran_id = '$Mall_Admin_ID' 
							and year = '$yy' and month = '$mm'";
             	$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if($numRows == 1) {
								$pay_str = "���޿Ϸ�";
								$pay_day = mysql_result($dbresult,0,0);
							}
							else {
								$pay_str = "������";
								$pay_day = '';
							}
							?>	
							<tr>
                <td align="left" width="9%" bgColor="#8FBECD"><p align="center"><strong><span class="cc"><font
                color="#FFFFFF">���հ�</font></span></strong></td>
                <td align="right" width="9%" bgColor="#8FBECD"><strong><span class="aa"><font
                color="#FFFFFF"><?echo number_format($mon_tot_sum+$prev_mon_tot_sum)?>��</font></span></strong></td>
                <td align="right" width="9%" bgColor="#8FBECD"><strong><span class="aa"><font
                color="#FFFFFF"><?echo number_format($susu_tot_sum+$prev_susu_tot_sum)?>��</font></span></strong></td>
                <td align="right" width="9%" bgColor="#8FBECD"><strong><span class="aa"><font
                color="#FFFFFF"><?echo number_format($gongje+$prev_gongje)?>��</font></span></strong></td>
                <td align="right" width="8%" bgColor="#8FBECD"><strong><span class="cc"><font
                color="#FFFFFF"><?echo number_format($real_pay+$prev_real_pay)?>��</font></span></strong></td>
                <td align="left" width="8%" bgColor="#8FBECD"><p align="center"><strong><span class="cc"><font
                color="#FFFFFF"><?echo $pay_str?></font></span></strong></td>
              </tr>
            </table>
            </td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table
        border="0" width="95%">
          <tr>
            <td width="100%"><p align="right"><span class="aa"><strong>���޿Ϸ���</strong> &nbsp;<?echo $pay_day?> 
            </span></td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff" height="3"></td>
      </tr>
      <script>
      	function CouponWin() 
				{
					var url = 'http://www.mocoupon.co.kr/onlineShop/shopReg1.php?group=bluecart&shopid=guest1';
				
				window.open(url,'Coupon','scrollbars=yes,toolbar=no,location=no,directories=no,width=675,height=500,resizable=no,mebar=no');
				}
		</script>
	</TBODY>

    </table>
    </center></div></td>
  </tr>
</TBODY>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>