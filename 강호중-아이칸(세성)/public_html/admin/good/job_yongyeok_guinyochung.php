<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
	include "../admin_head.php";
?>
<script language="JavaScript" src='./address.js'></script>

<script language='javascript'>
function frm_val(f){

	if(f.content.value==""){
		alert("������ �Էµ��� �ʾҽ��ϴ�.");
		f.content.focus();
		return false;
	}
	var Digit = '1234567890'

	if(f.bonus.value==""){
		alert("���� �ݾ��� �Է��ϼ���");				
		f.bonus.focus();
		return false;				
		
	}
	else{
		var len =f.bonus.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = f.bonus.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է°����մϴ�.");
					f.bonus.focus();
					return false;
			} 
			ret = false;
		}
	}
}

function del(username,num){
	if(confirm("�����Ͻðڽ��ϱ�?")){
		window.location.href='bonus_total.php?flag=del&mode=<?=$mode?>&provider_id=<?=$provider_id?>&username='+username+'&num='+num;
	}
	else return;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?include '../inc/menu3.html'; ?>
<table border="0" cellpadding="0" cellspacing="0" width="40%" bordercolorlight="#E1E1E1"  align="center">
<form name=fwrite method=post action="<?=$PHP_SELF?>">
<input type=hidden name="item_id" value="<?=$item_id?>">
<input type=hidden name="flag" value="add">
 <tr>
	 <td vAlign="top" width="646" bgColor="#ffffff" align="center">
	 <table cellSpacing="0" cellPadding="0" width="100%" border="0">
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
		  <table width="100%" border="0">
			 <tr>
				<td width="100%" height="20" align=center>

<?
	$SQL2 = "select * from item where item_id='$item_id'";
	$dbresult2 = mysql_query($SQL2,$dbconn);
	$ary=mysql_fetch_array($dbresult2);



?>
				<a href="../../admin/good/board_frame12.html">[����ȭ��ó�����ΰ���]</a>
<BR>
				<p align="center"><b>[�뿪��ü ������û] </b><br>
					

				
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
		  <table width="97%" border="0">
			 <tr>
				<td width="100%" bgColor="#999999">
				<table cellSpacing="1" cellPadding="3" width="100%" border="0">
					
				<tr>
					<td align="middle" bgColor="#c8dfec">��ü��</td>
					<td align="middle" bgColor="#c8dfec">����</td>
					<td align="middle" bgColor="#c8dfec">�ο���</td>
					<td align="middle" bgColor="#c8dfec">����</td>


				<tr>
					<td align='middle' width='10%' bgColor='#ffffff' rowspan=5><?=$ary[item_name]?></td>
					<td align='middle' width='20%' bgColor='#ffffff'>
					<select name="jongmok1">
						<?
						$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++){
							$row = mysql_fetch_array( $dbresult );
							$category_num = $row[category_num];
							$category_name = $row[category_name];
						?>
							<option value="<?=$category_num?>"><?=$category_name?></option>
						<?
						}	
						?>	
					</select>
					</td>
					<td align='middle' width='20%' bgColor='#ffffff'><input type=text size=4 name="inwon1" value=""></td>
					<td align='middle' width='50%' bgColor='#ffffff'>
					
						<select name=sido onchange="sidochange()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="��õ" >��õ</option>
						<option value="�λ�" >�λ�</option>
						<option value="�뱸" >�뱸</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>

						</select>

						<select name=gugun onchange="gugunchange()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="" ></option>
						</select>

						<select name=dong  value="">
						<option value="" >��(��ü)</option>
						<option value="" ></option>
						</select>

						<script language="JavaScript">
						<!--
							sidoview();
						   gugunview("");
						//-->
						</script>
				
					
					
					</td>
				</tr>

				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>	
					<select name="jongmok2">
						<?
						$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++){
							$row = mysql_fetch_array( $dbresult );
							$category_num = $row[category_num];
							$category_name = $row[category_name];
						?>
							<option value="<?=$category_num?>"><?=$category_name?></option>
						<?
						}	
						?>	
					</select></td>
					<td align='middle' width='12%' bgColor='#ffffff'><input type=text size=4 name="inwon2" value=""></td>
					<td align='middle' width='12%' bgColor='#ffffff'>
					
					
						<select name=sido2 onchange="sidochange2()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="��õ" >��õ</option>
						<option value="�λ�" >�λ�</option>
						<option value="�뱸" >�뱸</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>

						</select>

						<select name=gugun2 onchange="gugunchange2()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="" ></option>
						</select>

						<select name=dong2  value="">
						<option value="" >��(��ü)</option>
						<option value="" ></option>
						</select>

						<script language="JavaScript">
						<!--
							sidoview2();
						   gugunview2("");
						//-->
						</script>
				
					
					
					</td>
				</tr>
				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>	
					<select name="jongmok3">
						<?
						$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++){
							$row = mysql_fetch_array( $dbresult );
							$category_num = $row[category_num];
							$category_name = $row[category_name];
						?>
							<option value="<?=$category_num?>"><?=$category_name?></option>
						<?
						}	
						?>	
					</select></td>
					<td align='middle' width='12%' bgColor='#ffffff'><input type=text size=4 name="inwon3" value=""></td>
					<td align='middle' width='12%' bgColor='#ffffff'>
						<select name=sido3 onchange="sidochange3()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="��õ" >��õ</option>
						<option value="�λ�" >�λ�</option>
						<option value="�뱸" >�뱸</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>

						</select>

						<select name=gugun3 onchange="gugunchange3()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="" ></option>
						</select>

						<select name=dong3  value="">
						<option value="" >��(��ü)</option>
						<option value="" ></option>
						</select>

						<script language="JavaScript">
						<!--
							sidoview3();
						   gugunview3("");
						//-->
						</script>
					</td>
				</tr>

				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>	
					<select name="jongmok4">
						<?
						$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++){
							$row = mysql_fetch_array( $dbresult );
							$category_num = $row[category_num];
							$category_name = $row[category_name];
						?>
							<option value="<?=$category_num?>"><?=$category_name?></option>
						<?
						}	
						?>	
					</select></td>
					<td align='middle' width='12%' bgColor='#ffffff'><input type=text size=4 name="inwon4" value=""></td>
					<td align='middle' width='12%' bgColor='#ffffff'>
						<select name=sido4 onchange="sidochange4()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="��õ" >��õ</option>
						<option value="�λ�" >�λ�</option>
						<option value="�뱸" >�뱸</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>

						</select>

						<select name=gugun4 onchange="gugunchange4()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="" ></option>
						</select>

						<select name=dong4  value="">
						<option value="" >��(��ü)</option>
						<option value="" ></option>
						</select>

						<script language="JavaScript">
						<!--
							sidoview4();
						   gugunview4("");
						//-->
						</script>			
					</td>
				</tr>

				<tr>
					<td align='middle' width='5%' bgColor='#ffffff'>	
					<select name="jongmok5">
						<?
						$SQL = "select * from job_jongmok where mart_id='$mart_id' and prevno='0' order by cat_order desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++){
							$row = mysql_fetch_array( $dbresult );
							$category_num = $row[category_num];
							$category_name = $row[category_name];
						?>
							<option value="<?=$category_num?>"><?=$category_name?></option>
						<?
						}	
						?>	
					</select></td>
					<td align='middle' width='12%' bgColor='#ffffff'><input type=text size=4 name="inwon5" value=""></td>
					<td align='middle' width='12%' bgColor='#ffffff'>
						<select name=sido5 onchange="sidochange5()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="��õ" >��õ</option>
						<option value="�λ�" >�λ�</option>
						<option value="�뱸" >�뱸</option>
						<option value="����" >����</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="�泲" >�泲</option>
						<option value="���" >���</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>
						<option value="����" >����</option>

						</select>

						<select name=gugun5 onchange="gugunchange5()" value="">
						<option value="" >��/��(��ü)</option>
						<option value="" ></option>
						</select>

						<select name=dong5  value="">
						<option value="" >��(��ü)</option>
						<option value="" ></option>
						</select>

						<script language="JavaScript">
						<!--
							sidoview5();
						   gugunview5("");
						//-->
						</script>	
					</td>
				</tr>



				</table>
				</td>
			 </tr>
		  </table>
		  </td>
		</tr>

		<tr align="middle">
		  <td vAlign="top" width="100%" bgColor="#ffffff"><input type=submit value=" ��û�ϱ� "></td>
		</tr>
	 </table>
	 </td>
  </tr>
 </form>
</table>










</body>
</html>
<?
}else if($flag=="add"){
	$write_date = date("Y-m-d");


				//state 1:��û�� 2:�������� 3:�ŷ��Ϸ�
		

			$sql = "insert into job_yong_guyo (seq_num, my_id, you_id, jongmok1, inwon1, sido,gugun,dong, jongmok2, inwon2, sido2,gugun2,dong2, jongmok3, inwon3, sido3,gugun3,dong3, jongmok4, inwon4, sido4,gugun4,dong4, jongmok5, inwon5, sido5,gugun5,dong5, state, reg_date) values ('', '$_SESSION[Mall_Admin_ID]','$item_id', '$jongmok1', '$inwon1', '$sido','$gugun','$dong', '$jongmok2', '$inwon2', '$sido2','$gugun2','$dong2', '$jongmok3', '$inwon3', '$sido3','$gugun3','$dong3', '$jongmok4', '$inwon4', '$sido4','$gugun4','$dong4', '$jongmok5', '$inwon5', '$sido5','$gugun5','$dong5', '1', '$write_date')";
			$dbresult = mysql_query($sql, $dbconn);


			echo("
				<script>
				alert('��û�Ϸ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL=job_yongyeok.php?username=$username&provider_id=$provider_id&mode=$mode'>
			");
			exit;
	

	
}else if($flag=="del"){
	
	$SQL = "select bonus from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$bonus = mysql_result($dbresult,0,0);
	
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $bonus 
	where username='$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $BonusTable where num = $num and id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=bonus_total.php?username=$username&provider_id=$provider_id&mode=$mode'>";
}
?>
<?
mysql_close($dbconn);
?>
