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
					<td align="center">예약시간</td>
					<td align="center">9홀</td>
				</tr>
				<?
					$bbs_category="rg_".$bbs_id."_category";
					$sql="select * from $bbs_category";
					
					$result=mysql_query($sql);
					while($rs=mysql_fetch_array($result)){
						$cat_num=$rs[cat_num];
						$sql="select * from $bbs_table where rg_cat_num='$rs[cat_num]' and rg_ext5='$book'";
						$result2=mysql_query($sql);
						$num=mysql_num_rows($result2);

				?>
				<tr>
					<td align="center"><?=$rs[cat_name]?></td>
					<td align="right">
						<?
						if(!$num){
						?>
						<a href="./write.php?bbs_id=<?=$bbs_id?>&rg_cat_num=<?=$cat_num?>&rg_ext5=<?=$book?>"><img src="<?=$skin_board_url?>images/btn_order.gif" border="0"></a>
						<? }else{?>
						<img src="<?=$skin_board_url?>images/btn_order_end.gif" border="0">
						<? }?>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#cccccc"></td>
				</tr>
				<? }?>
			</table>
			
		</td>
	</tr>
</table>
