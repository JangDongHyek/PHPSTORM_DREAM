<form>
<br><br><br>
<table border=0 width=250 class=zv3_writeform height=30>
<tr class=title>
	<td class=z_t1 align=center><b>경고!!!</b></td>
</tr>
<tr class=list0>
    <td align=center height=50 class=z_list>
      <?echo $message;?>
	</td>
</tr>
</table>
<?
  if(!$url)
  {
?>

  <br>
  <center><a href=# onclick=history.back() onfocus=blur()><font class=z_list>이전 화면</font></a>

<?
  }
  else
  {
?>
	<br>
  <div align=center><a href=# onclick=location.href="<?echo $url;?>" onfocus=blur()><font class=z_list>페이지 이동</font></a>

<?
  }
?>
</form>
<br>
<br>
