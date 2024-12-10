<?
	$bbs_category_table="rg_".$bbs_id."_category";

$qry="
	SELECT *
	FROM $bbs_category_table
	where cat_num='$rg_cat_num'
	ORDER BY cat_order
";
$result=mysql_query($qry);
$rs=mysql_fetch_array($result);
?>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
  <TR> 
	<TD align=right>
<?=$show_prev_begin?><?=$a_prev?><IMG src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?> <?=$show_next_begin?><?=$a_next?><IMG src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
  </TR>
  <TR>
	<TD>
		<TABLE cellspacing="0" cellpadding="0" width="100%" border="0" style="table-layout:fixed">
			<TR>
				<TD>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><img src="../images/subtable_38.jpg" width="765" height="67" /></td>
                      </tr>
                    </table>
				    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30"> ÀüÃ¼&gt; <b>
                          <?=$bbs[bbs_name]?>
                        </b> &gt; <b>
                        <?=$rs[cat_name]?>
                        </b></td>
                      </tr>
                    </table>
			      </TD>
			</TR>

			<TR>
			  <TD align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="125" valign="top" background="../images/subtable_39.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" height="25">&nbsp;</td>
                            <td><?=$rg_name?></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;</td>
                            <td height="25"><?=$rg_title?></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;</td>
                            <td height="25"><?=date("Y-m-d",$rg_ext5)?> <?=$rg_cat_name?></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;</td>
                            <td height="25"><?=$rg_ext1?></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;</td>
                            <td height="25"><?=$rg_ext2?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></TD>
			</TR>
		</TABLE>

	</TD>
  </TR>
  <TR>
	<TD height=5></TD>
  </TR>
