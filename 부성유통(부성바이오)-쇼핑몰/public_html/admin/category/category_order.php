<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag==""){
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top"><p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a3.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
        		<small>��</small> <font face="����">���θ� <strong>ī�װ� ����</strong>��<strong> 
        		<br>
        		&nbsp;&nbsp; ����</strong>�մϴ�.<br>
        		</font><br>
        		</span></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF" valign="top">
    	<div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><span class="aa">ī�װ��� ������ �����Ͻ� �� 
        		�ֽ��ϴ�. <br>
        		�����ϰ� �Ͱų� Ȥ�� �߿��� ī�װ��� ������ ��½�ų �� 
        		�ֽ��ϴ�. <br>
        		���������� �� ī�װ��� �ش��ϴ� �̹��� ��(�Ʒ�), ��(��) �� 
        		Ŭ���ϼ���.<br>
        		<br>
        		<br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="80%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<tr>
        	<td width="80%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="0">
            			
            			<table border="0" width="100%">
              			<tr>
                			<td width="30%" height="3"></td>
                			<td width="70%" height="3"><span class="aa"></span></td>
              			</tr>
              			<tr>
                			<td width="100%" colspan="2">
                				<img src="../images/soo.gif" border="0" WIDTH="140" HEIGHT="19">
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="center">
        		<div align="center">
        		<center>
        		
        		<table border="0" width="80%">
          		<tr>
            		<td width="80%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="2">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="50%">&nbsp; <strong><span class="dd">��ϵ� ī�װ� ���</span></strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<?
						$SQL = "select * from $CategoryTable where prevno=0 and mart_id='$mart_id' order by cat_order desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						?>
      					<tr>
                			<td width="23%" bgcolor="#EEEEEE" align="left">
                				<span class="aa"><p align="center">ī�װ���</span></td>
                			<td width="30%" bgcolor="#EEEEEE" align="left">
                				<p align="center"><span class="aa">��ġ ����</span></td>
              			</tr>
              			<?
				      	for ($i=0; $i<$numRows; $i++) {
							mysql_data_seek($dbresult,$i);
							$ary = mysql_fetch_array($dbresult);
							$category_num = $ary["category_num"];
							$category_name = $ary["category_name"];
							$cat_order = $ary["cat_order"];
							$j = $i + 1;
							echo ("
						<tr>
                			<td width='23%' bgcolor='#FFFFFF' align='left'>
                				<a href='a12-1.html'><strong><span class='bb'>$category_name</span></strong></a></td>
                			<td width='30%' bgcolor='#FFFFFF' align='left'>
              ");
                			  
					     	if($i < $numRows - 1){
									echo ("
									<a href=category_order.php?category_num=$category_num&cat_order=$cat_order&flag=down>
									<img src='../images/down.gif' border='0' alt='���� ī�װ� ������' WIDTH='23' HEIGHT='17'></a>
									");	
								}
								else{
									echo ("
								<img src='../images/blank2317.gif' WIDTH='23' HEIGHT='17'>
									");
								}
								if($i > 0){	
									echo ("
									<a href=category_order.php?category_num=$category_num&cat_order=$cat_order&flag=up>
									<img src='../images/up.gif' alt='���� ī�װ� �ø���' border='0' WIDTH='23' HEIGHT='17'></a>
									");
								}
				            
								echo ("
							</td>
 						</tr>
              				");
              			}	
              			?>
              			</table>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        		<p align="center">
        		<input class="aa" onclick="window.location.href='category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��"></p>
        		</div>
        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html>
<?
}
if($flag == "up"){
	$SQL = "select cat_order from $CategoryTable where prevno=0 and cat_order > $cat_order and mart_id='$mart_id' order by cat_order Asc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$up_cat_order = $ary["cat_order"];
	
	$SQL = "select category_num from $CategoryTable where cat_order = $up_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$up_category_num = $ary["category_num"];
	
	$SQL = "update $CategoryTable set cat_order = $up_cat_order where category_num = $category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	
	$SQL = "update $CategoryTable set cat_order = $cat_order where category_num = $up_category_num and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_order.php'>";
}

if($flag == "down"){
	$SQL = "select cat_order from $CategoryTable where prevno=0 and cat_order < $cat_order and mart_id='$mart_id' order by cat_order Desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$down_cat_order = $ary["cat_order"];
	
	$SQL = "select category_num from $CategoryTable where cat_order = $down_cat_order and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$down_category_num = $ary["category_num"];
	
	$SQL = "update $CategoryTable set cat_order = $down_cat_order where category_num = $category_num and mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	
	
	$SQL = "update $CategoryTable set cat_order = $cat_order where category_num = $down_category_num and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_order.php'>";
}
?>
<?
mysql_close($dbconn);
?>