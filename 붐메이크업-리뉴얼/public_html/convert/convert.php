<?
		include "dbconn.php" ;
?>
<HTML>
<HEAD>
<TITLE>CONVERTER</TITLE>
<script>
function in_check() {

	if (form1.delete_chk.checked) form1.delete_flg.value=1 ;
	if(!document.form1.zero_id.value) {
		alert("INPUT THE ZEROBOARD ID !!!");
		document.form1.zero_id.focus();
		return false;
	}
	if(!document.form1.rg_id.value) {
		alert("INPUT THE RGBOARD ID !!!");
		document.form1.rg_id.focus();
		return false;
	}  
	return true;

} 

</script> 
</HEAD>
<BODY>
<table align= center  border=0 width=500 cellspacing=0 cellpadding=0 >
<form name=form1 action="zero2rg.php" method="post" onsubmit="return in_check();">
  <tr> 
	<td align=center><span style="font:32 impact; color:#CDB8CD" >CONVERTER</span><br><br></td>
  </tr>
  <tr>
  <td>
		<table width=100% >
		<tr>
			<td align=left>ZERO BOARD</td>
			<td align=left>RG BOARD</td>
			<td></td>
		</tr>
		<tr>
<!--<td><input type=text name=zero_id style="width:100%;"></td>-->
		<td align=left>
		<select name="zero_id" >
		<?
		$q='SELECT no,name FROM zetyx_admin_table order by no';
		$result=mysql_query($q);
		while($data=mysql_fetch_array($result)) {
		?>
		  <option value=<?=$data[name]?> > <?=$data[name]?> </option>";
		<?
		}
		?>
		</select>
		</td>

		<td align=left>
		<select name="rg_id" >
		<?
		$q='select bbs_num,bbs_id,bbs_name from rg_bbs_cfg order by bbs_num';
		$result=mysql_query($q);
		while($data=mysql_fetch_array($result)) {
		?>
		  <option value=<?=$data[bbs_id]?> ><?=$data[bbs_name]?> </option>";
		<?
		}
		?>
		</select>
		</td>
<!--<td><input type=text name=rg_id style="width:100%;" ></td> -->

        <td align=right>
		  <input type="submit" name="btn_ok" value="convert"> 
		</td>

		</tr>
		</table>
  </td>

  </tr>
  <tr>
  <td><br>
  <input type="hidden" name="delete_flg" value="0">
  <input type="checkbox" name="delete_chk" checked>After Delete &nbsp;&nbsp;&nbsp;
	</td>
  </tr>

  <tr>
  <td align=left ><br>
	 <a href="zero2member.php" >MEMBER CONVERT</a>&nbsp;&nbsp;&nbsp;
  </td>
  </tr>

  <tr>
  <td align=left><br>
  <a href="zero2rg_count.php" >ZERO COUNTER => RG ADDON</a>
  </td>
  </tr>
  </form>
</table>
</BODY>
</HTML>
