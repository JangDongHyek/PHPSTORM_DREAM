<form>
<br><br><br>
<table border=0 width=250 class=zv3_writeform height=30>
<tr class=title>
	<td class=z_t1 align=center><b>���!!!</b></td>
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
  <center><a href=# onclick=history.back() onfocus=blur()><font class=z_list>���� ȭ��</font></a>

<?
  }
  else
  {
?>
	<br>
  <div align=center><a href=# onclick=location.href="<?echo $url;?>" onfocus=blur()><font class=z_list>������ �̵�</font></a>

<?
  }
?>
</form>
<br>
<br>
