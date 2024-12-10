
<?
	$yoil=array("일","월","화","수","목","금","토");
	if($month<10){
		$month="0".$month;
	}
?>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' <? if($mode == 'edit') {?>OnSubmit='javascript:return ContentCheck()'<?}?> enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
	<tr>
		<td>
			<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#8ea9dc">
				<tr>	
					<td bgcolor="#dee9fd">
						골프장 : <?=$bbs[bbs_name]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						선택하신날짜 : <?=$year?>년 <?=$month?>월 <?=$day?>일(<?=$yoil[date("w",strtotime($year."-".$month."-".$day))]?>)
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="30" style="border-left:1px solid #ccc">예약시간</td>
					<td align="center" style="border-right:1px solid #cccccc">9홀</td>
					<td align="center" height="30">예약시간</td>
					<td align="center" style="border-right:1px solid #cccccc">9홀</td>
					
				</tr>
				<tr>
					<td height="1" bgcolor="#cccccc" colspan="8"></td>
				</tr>
				
				<tr>
					<?
					$bbs_category="rg_".$bbs_id."_category";

					if($book == "1379430000"){
						$sql="SELECT * FROM $bbs_category LIMIT 0,68";
					}elseif($book == "1379602800"){
						$sql="SELECT * FROM $bbs_category WHERE cat_num>='27'";
					}else{
						$sql="select * from $bbs_category";
					}
					
					$result=mysql_query($sql);
					$i=0;
					while($rs=mysql_fetch_array($result)){
						$cat_num=$rs[cat_num];
						$sql="select * from $bbs_table where (rg_cat_num='$rs[cat_num]' OR rg_cat_num2='$rs[cat_num]' OR rg_cat_num3='$rs[cat_num]' OR rg_cat_num4='$rs[cat_num]') and rg_ext5='$book'";
						$result2=mysql_query($sql);
						$num=mysql_num_rows($result2);

						if($i%2==0){
							echo "</tr><tr><td height='1' bgcolor='#cccccc' colspan=8></td></tr><tr>";
						}
				?>
					<td align="center"  height="30" style="border-left:1px solid #cccccc"><?=$rs[cat_name]?></td>
					<td align="center" style="border-right:1px solid #cccccc">
						<?
						if(!$num){
						?>
						<a href="./mobile_write.php?bbs_id=<?=$bbs_id?>&rg_cat_num=<?=$cat_num?>&rg_ext5=<?=$book?>"><img src="<?=$skin_board_url?>images/btn_order.gif" border="0"></a>
						<? }else{?>
						<img src="<?=$skin_board_url?>images/btn_order_end.gif" border="0">
						<? }?>
					</td>
					<? $i++;}?>
				</tr>
				<tr>
					<td height="1" bgcolor="#cccccc" colspan="8"></td>
				</tr>
				
			</table>
			
		</td>
	</tr>
</table>
