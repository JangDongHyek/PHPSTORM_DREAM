<?
include "../admin_head1.php";
ini_set("session.cache_expire", 86400);  // 세션 유휴시간 24시간
ini_set("session.gc_maxlifetime", 86400);  // 역시 24시간
session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", ".wickhan.com");
?>
<?  include '../inc/menu3.html'; 

$td_size = 3;
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="0"></td>
        <td valign="top" ><div align="right">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td>

<?
if($_SESSION["MemberLevel"] == 10){
?>	
<table align=right>
<form name="cate_search" method="get" action="category_search.php">
<tr>
<td align=right>
	�׷���˻� : 
</td>
<td>
	<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" >
	-
	<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" >
	-
	<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" >
	<input type=submit value="�˻�">
 </td>
</tr>
</form>
<form name="cate_search" method="get" action="member_view.php">
<tr>
<td align=right>
	ȸ���˻� : 
</td>
<td>
	<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" maxlength=4>
	-
	<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2>
	-
	<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2>
	-
	<input class="aa" type="text" name="sudong_num" value='<?=$sudong_num?>' size="5" maxlength=4>
	<input type=submit value="�˻�">
</td>
</tr>
</form>
</table>
<?}else{?>
				<div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�׷���� </span> </div>
	<?}?>

				</td>
              </tr>
              <tr>
                <td>
<?
if($_SESSION["MemberLevel"] == 10){
?>	

			<?if(!$category_num){?>
			<table border="0" cellspacing="0" cellpadding="0" align="center" width=220 height=42>
			  <tr>
				<td align="center" width=320 height=42>
					<b><a href="#" onClick="javascript:location.href='category_write.php?flag=addcategory';">[WIC KHAN �׷���]</b>
				</td>
			  </tr>
			  <tr>
				<td align="center" background="../images/member_bg.gif" width=220 height=42>
					<font color=#ffffff><b>����</b>
				</td>
			  </tr>
			</table>	
			<table  border="0" cellspacing="0" cellpadding="0" align="center">
			 <?
			$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno='0' and if_hide = '0' and category_num > 0 order by cat_order desc";
			$dbresult = mysql_query($SQL, $dbconn);
			for($z=0;$rows = mysql_fetch_array($dbresult);$z++){

			if($z%$td_size == 0){
		?>
									<tr>
									  <?
			}
		?>
				<td align="center" background="../images/member_bg_2.gif" width=220 height=42>
					<a href="category_list.php?category_num=<?=$rows[category_num]?>"><font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b></a>
				</td>
		<?
			if($z%$td_size==$td_size-1)
				echo "			  </tr>\n";
		}
			
		?>
			</table>
			<?}else{?>

				<table border="0" cellspacing="0" cellpadding="0" align="center" width=220 height=42>
				  <tr>
					<td align="center"  width=220 height=42>	 
					<?
					
					$SQL = "select * from $CategoryTable where mart_id='$mart_id' and category_num='$category_num'";
					$dbresult = mysql_query($SQL, $dbconn);
					$rows = mysql_fetch_array($dbresult);

					if($rows[category_degree] == 0){//1���� 2���׷���
					?>
						<a href="#" onClick="javascript:location.href='category_write.php?st=2&prevno=<?=$rows[category_num]?>&category_num=<?=$rows[category_num]?>';"><b>[IC KHAN �׷���]</a>
					<?
					}else{ //2���� 3���׷���
					?>
						<a href="#" onClick="javascript:location.href='category_write.php?st=3&prevno=<?=$rows[category_num]?>&category_num=<?=$rows[category_num]?>';"><b>[C KHAN �׷���]</a>
					<?
					}
					?>	  	  
				  
					</td>
				  </tr>	  
				  
				  <tr>
					<td align="center" background="../images/member_bg.gif" width=220 height=42>
					<?
					$SQL = "select * from $CategoryTable where mart_id='$mart_id' and category_num='$category_num'";
					$dbresult = mysql_query($SQL, $dbconn);
					for($z=0;$rows = mysql_fetch_array($dbresult);$z++){
						$prev_category_num = $rows[category_num];
					?>			
						<font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b>
						<br>
						<a href="category_list.php?category_num=<?=$rows[prevno]?>"><font color=#ffffff>[�����̵�]</a>
						<a href="#" onClick="javascript:location.href='category_edit.php?category_num=<?=$rows[category_num]?>';"><font color=#ffffff>[����]</a>
						<a href="#" onClick="javascript:location.href='category_modify.php?flag=delcategory&category_num=<?=$rows[category_num]?>';"><font color=#ffffff>[����]</a>

					<?
					}          
					?>

					</td>
				  </tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0" align="center">
				  <tr>
					<?
					$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno='$prev_category_num' order by cat_order desc";
					$dbresult = mysql_query($SQL, $dbconn);
					for($z=0;$rows = mysql_fetch_array($dbresult);$z++){
						if($rows[category_degree] == 2){
					
						if($z%$td_size == 0){
						?>
						<tr>
						<?
						}
						?>
					<td align="center" background="../images/member_bg_2.gif" width=220 height=42>

						<font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b>
						<br><a href="#" onClick="javascript:location.href='category_edit.php?category_num=<?=$rows[category_num]?>&prev_category_num=<?=$rows[prevno]?>';"><font color=#ffffff>[����]</a>
						<a href="#" onClick="javascript:location.href='category_modify.php?flag=delcategory&category_num=<?=$rows[category_num]?>&prev_category_num=<?=$rows[prevno]?>';"><font color=#ffffff>[����]</a>

					</td>

					<?
						}else{
					?>
					<td align="center" background="../images/member_bg_2.gif" width=220 height=42>
						<a href="category_list.php?category_num=<?=$rows[category_num]?>"><font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b></a>
					</td>
					<?
						}
					
			if($z%$td_size==$td_size-1)
				echo "			  </tr>\n";
		}
			
		?>
				</table>		

			<?}?>

<?
}else{
?>	

				<table border="0" cellspacing="0" cellpadding="0" align="center" width=220 height=42>				  
				  <tr>
					<td align="center" background="../images/member_bg.gif" width=220 height=42>
					<?
					if(!$category_num){
					$SQL = "select category_num from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
					$dbresult = mysql_query($SQL, $dbconn);
					$rows = mysql_fetch_array($dbresult);
					$category_num = $rows[category_num];
				}

					$SQL = "select * from $CategoryTable where mart_id='$mart_id' and category_num='$category_num'";
					$dbresult = mysql_query($SQL, $dbconn);
					for($z=0;$rows = mysql_fetch_array($dbresult);$z++){
						$prev_category_num = $rows[category_num];

						

					?>			
						<font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b>
						<br>
						<?if($rows[category_degree] == 1 && $_SESSION["MemberLevel"] == 1){?>
							<a href="category_list.php?category_num=<?=$rows[prevno]?>"><font color=#ffffff>[�����̵�]</a>
						<?}?>

					<?
					}          
					?>

					</td>
				  </tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0" align="center">
				  <tr>
					<?
					$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno='$prev_category_num' order by cat_order desc";
					$dbresult = mysql_query($SQL, $dbconn);
					for($z=0;$rows = mysql_fetch_array($dbresult);$z++){
						if($rows[category_degree] == 2){
					
						if($z%$td_size == 0){
						?>
						<tr>
						<?
						}
						?>
					<td align="center" background="../images/member_bg_2.gif" width=220 height=42>

						<font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b>
						<?if($_SESSION["MemberLevel"] == 1 || $_SESSION["MemberLevel"] == 2){?>
							<br><a href="#" onClick="javascript:location.href='category_edit.php?category_num=<?=$rows[category_num]?>&prev_category_num=<?=$rows[prevno]?>';"><font color=#ffffff>[����]</a>
						<?}?>

					</td>

					<?
						}else{
					?>
					<td align="center" background="../images/member_bg_2.gif" width=220 height=42>
						<a href="category_list.php?category_num=<?=$rows[category_num]?>"><font color=#ffffff><b><?=$rows[sea_num]?><?=$rows[sung_num]?><?=$rows[khan_num]?></b></a>
						<?if($_SESSION["MemberLevel"] == 1){?>
							<br><a href="#" onClick="javascript:location.href='category_edit.php?category_num=<?=$rows[category_num]?>&prev_category_num=<?=$rows[prevno]?>';"><font color=#ffffff>[����]</a>
						<?}?>
					</td>
					<?
						}
					
			if($z%$td_size==$td_size-1)
				echo "			  </tr>\n";
		}
			
		?>
				</table>		





<?
}
?>
				</td>
              </tr>
            </table>
        </div></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

