<?
include "../lib/Mall_Admin_Session.php";
?>

<?
include "../admin_head.php";
?>
<?
if(!$page)$page=1;
if(!$type)$type=0;
$limit=10;

$where="f_type = $type";

if($keyword){
	$where.=" and (f_to_phone like '%$keyword%' or f_comment like '%$keyword%')";
}

//�Ⱓ�˻�
if($syear and $eyear and $se_type=="yes"){
	$start_day=$syear."-".$smonth."-".$sday;
	$end_day=$eyear."-".$emonth."-".$eday;
	$where.=" and (DATE_FORMAT(f_wdate,'%Y-%m-%d') between '$start_day' and '$end_day')";
}

if(!$syear)$syear=date('Y');
if(!$smonth)$smonth=date('m');
if(!$sday)$sday=date('d');
if(!$eyear)$eyear=date('Y');
if(!$emonth)$emonth=date('m');
if(!$eday)$eday=date('d');

$num_result=mysql_query("select f_id from tbl_sms where $where"); // �� �Խù� ��
$num=mysql_num_rows($num_result);
?>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "sms";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�������۳���</b></td>
			</table>

			<!--���� START~~--><br>

			
			
			<!-- ���� ����-->
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
				<form action="<?=$PHP_SELF?>?type=<?=$type?>" method="post" name="diib">
				<tr align="right" height="25">
					<td colspan="5">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><b><?=$num?></b>��</td>
								<td align="right">
									<select name="syear">
										<?for($i=2007;$i<=date('Y');$i++){?>
										<option value="<?=$i?>" <?if($syear==$i)echo"selected";?>><?=$i?>��</option>
										<?}?>
									</select>
									<select name="smonth">
										<?
										for($i=1;$i<=12;$i++){
											if(strlen($i)==1){
												$i2="0".$i;
											}else{
												$i2=$i;
											}
										?>
										<option value="<?=$i2?>" <?if($smonth==$i2)echo"selected";?>><?=$i?>��</option>
										<?}?>
									</select>
									<select name="sday">
										<?
										for($i=1;$i<=31;$i++){
											if(strlen($i)==1){
												$i2="0".$i;
											}else{
												$i2=$i;
											}
										?>
										<option value="<?=$i2?>" <?if($sday==$i2)echo"selected";?>><?=$i?>��</option>
										<?}?>
									</select> ~
									<select name="eyear">
										<?for($i=2005;$i<=date('Y');$i++){?>
										<option value="<?=$i?>" <?if($eyear==$i)echo"selected";?>><?=$i?>��</option>
										<?}?>
									</select>
									<select name="emonth">
										<?
										for($i=1;$i<=12;$i++){
											if(strlen($i)==1){
												$i2="0".$i;
											}else{
												$i2=$i;
											}
										?>
										<option value="<?=$i2?>" <?if($emonth==$i2)echo"selected";?>><?=$i?>��</option>
										<?}?>
									</select>
									<select name="eday">
										<?
										for($i=1;$i<=31;$i++){
											if(strlen($i)==1){
												$i2="0".$i;
											}else{
												$i2=$i;
											}
										?>
										<option value="<?=$i2?>" <?if($eday==$i2)echo"selected";?>><?=$i?>��</option>
										<?}?>
									</select>
									<input type="checkbox" name="se_type" value="yes" <?if($se_type=="yes")echo"checked";?> style="border:0">�Ⱓ����
									<input type="text" name="keyword" value="<?=$keyword?>" size="10">
									<input type="submit" value="�˻�">
								</td>
							</tr>
						</table>
					</td>
				</tr></form>
				<tr align="center" bgcolor="9F9F9F">
					<td height="30" width="30"><font color="FFFFFF">��ȣ</td>
					<td><font color="FFFFFF">����</td>
					<td width="80"><font color="FFFFFF">�޴���</td>
					<td width="80"><font color="FFFFFF">������</td>
					<td width="100"><font color="FFFFFF">�����ð�</td>
				</tr>
				<?
				$start = ($page-1)*$limit;
				$no = $num+1-$start;
				$result=mysql_query("select * from tbl_sms where $where order by f_wdate desc limit $start,$limit");
				while($row=mysql_fetch_array($result)){
					$no = $no - 1;
					$now_date=date('Y-m');
				?>
				<tr bgcolor="F7FDFF" align="center">
					<td height="26"><?=$no?></td>
					<td align="left" style="line-height: 12pt;"><?=$row[f_comment]?></td>
					<td><?=$row[f_to_phone]?></td>
					<td><?=$row[f_from_phone]?></td>
					<td><?=substr($row[f_wdate],0,16)?></td>
				</tr>
				<tr height="1">
					<td colspan="5" bgcolor="CCCCCC"></td>
				</tr>
				<?}?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td>
						<input type="button" value="���" onclick="javascript:location.href='<?=$PHP_SELF?>?mode=list&type=<?=$type?>'" class="box">
					</td>
					<td align="right">
						<?
						$pages=intval($num/$limit) + 1 ;
						$total_pages=$pages;

						if($num%$limit == 0){ $pages = $pages-1; }

						if(!$page_start) $page_start = 1;
						if($page_start != 1){
							$tmp = $page_start-8;
							$prev_page = $page_start - 1;
							echo"<a href=$PHP_SELF?type=$type&syear=$syear&smonth=$smonth&sday=$sday&eyear=$eyear&emonth=$emonth&eday=$eday&se_type=$se_type&page=1&page_start=1&keyword=$keyword>[��ó��]</a>";
							echo"&nbsp;<a href=$PHP_SELF?type=$type&syear=$syear&smonth=$smonth&sday=$sday&eyear=$eyear&emonth=$emonth&eday=$eday&se_type=$se_type&page=$prev_page&page_start=$tmp&keyword=$keyword>[����]</a>&nbsp;";
						}
						if($pages > $page_start+8){$page_finish=$page_start+8;}else{$page_finish=$pages+1;}
							for($a=$page_start;$a<$page_finish;$a++){
								echo"&nbsp;<a href=$PHP_SELF?type=$type&syear=$syear&smonth=$smonth&sday=$sday&eyear=$eyear&emonth=$emonth&eday=$eday&se_type=$se_type&page=$a&page_start=$page_start&keyword=$keyword>";if($a==$page){echo"<span class=style8>$a</span></a>";}else{echo"[$a]</a>";}
							}
						if($pages > $page_start+7){
							$tmp = $page_start+8;
							$last_page = (($total_pages)%8)-1; //���� ������ ������ ����Ʈ��
							$last_page = $total_pages - $last_page; //�� ������ - ������ ��������
							echo "&nbsp;<a href=$PHP_SELF?type=$type&syear=$syear&smonth=$smonth&sday=$sday&eyear=$eyear&emonth=$emonth&eday=$eday&se_type=$se_type&page=$tmp&page_start=$tmp&keyword=$keyword>[����]</a>";
							echo"&nbsp;<a href=$PHP_SELF?type=$type&syear=$syear&smonth=$smonth&sday=$sday&eyear=$eyear&emonth=$emonth&eday=$eday&se_type=$se_type&page=$total_pages&page_start=$last_page&keyword=$keyword>[�ǳ�]</a>";
						}
						?>
					</td>
				</tr>
				<tr height="5">
					<td></td>
				</tr>
			</table>
			<!-- ���� �� -->			
			
			
			
			
			<!--���� END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<script>
//exp(document.f);
</script>
<?
if( $dbresult ){
	mysql_free_result( $dbresult );
}
mysql_close($dbconn);
?>