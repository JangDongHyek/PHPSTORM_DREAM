<?
####################################################################################
//					����
####################################################################################
set_time_limit(0);
if(!$is_admin){
nalog_error("���̃v���O�C���͊Ǘ��҂̂ݗ��p�o���܂��B");
}
?>

<?
####################################################################################
//					�ŏ��̉��
####################################################################################
if(!$pmode){?>
<table width=100% board=0 cellpadding=2 cellspacing=0 align=center bgcolor=white>
<tr><td align=center>
<br><br><br><br><br>
<img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0>
<br><br><br><br><br><br>
</td></tr>
</table>
<?}?>

<?
####################################################################################
//					�o�b�N�A�b�v���
####################################################################################
if($pmode==1){?>
<?
$tables=nalog_list_bd();
$total=count($tables);

$page=10;
$pageviewsu=10; 
$pagesu=ceil($total/$page); 
$start=($page*$pagenum); 
$no=$total-$start;
$pagegroup=ceil(($pagenum+1)/$pageviewsu); 
$pagestart=($pageviewsu*($pagegroup-1))+1; 
$pageend=$pagestart+$pageviewsu-1;
$nowpage=$pagenum+1; 
$send="&page=$page&";
?>
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/dump.php>
		<tr>
		<td>���v <b><?=$total?></b>�̃J�E���^</td>
		<td align=right>�ۑ����@ : <input type=radio name=how value=1 checked> �_�E�����[�h
		<input type=radio name=how value=0> �T�[�o�[�ɕۑ� (�ۑ��o�H : <?=str_replace("admin_counter.php","*.sql",$PHP_SELF)?>)</td> 
		</tr> 
		</table>
	
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<input type=hidden name=counter value="<?=$counter?>">
		<input type=hidden name=id value="<?=$id?>">
		<input type=hidden name=pmode value="<?=$pmode?>">
		<tr bgcolor=#C9F0FF>
		<td width=1% nowrap align=center>�ԍ�</td>
		<td width=1% nowrap align=center>�I��</td>
		<td width=92% align=center>�J�E���^��</td>
		<td width=1% nowrap align=center>�J�E���^�L�^</td>
		<td width=1% nowrap align=center>OS/BW�L�^</td>
		<td width=1% nowrap align=center>LOG�L�^</td>
		<td width=1% nowrap align=center>DLOG�L�^</td>
		<td width=1% nowrap align=center>�K��ҋL�^</td>
		<td width=1% nowrap align=center>����L�^</td>
		</tr>
<?
		$j=0;
		for($i=$start;$i<$start+$page;$i++)
		{
		if(!$tables[$i]){break;}
		$board_name=$tables[$i];

		$total_data=mysql_fetch_array(mysql_query("select count(*) from nalog3_data where counter='$board_name'"));
		$total_os=mysql_fetch_array(mysql_query("select count(*) from nalog3_os where counter='$board_name' and os='1'"));
		$total_bw=mysql_fetch_array(mysql_query("select count(*) from nalog3_os where counter='$board_name' and os='0'"));
		$total_log=mysql_fetch_array(mysql_query("select count(*) from nalog3_log_$board_name"));
		$total_dlog=mysql_fetch_array(mysql_query("select count(*) from nalog3_dlog_$board_name"));
		$total_dlog=mysql_fetch_array(mysql_query("select count(*) from nalog3_dlog_$board_name"));
		$total_counter=mysql_fetch_array(mysql_query("select count(*) from nalog3_counter_$board_name"));
		$total_member=mysql_fetch_array(mysql_query("select count(*) from nalog3_counter_$board_name where id<>''"));


		echo"
		<tr bgcolor=white>
		<td width=1% nowrap align=center>$no</td>
		<td width=1% nowrap align=center><input type=checkbox name=name[$j] value='$board_name' checked id=name[$j]></td>
		<td width=92%><b><label for=name[$j]>$board_name</label></b></td>
		<td width=1% nowrap align=right>$total_data[0]��</td>
		<td width=1% nowrap align=right>$total_os[0]/$total_bw[0]��</td>
		<td width=1% nowrap align=right>$total_log[0]��</td>
		<td width=1% nowrap align=right>$total_dlog[0]��</td>
		<td width=1% nowrap align=right>$total_counter[0]�l</td>
		<td width=1% nowrap align=right>$total_member[0]�l</td>
		</tr>
		";
		$no--;
		$j++;
		}
?>
		</table>
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr>
		<td align=center><?nalog_index()?></td>
		</tr>
		<tr bgcolor=white>
		<td align=center><input type=submit class=button value=�o�b�N�A�b�v></td>	
		</tr>
		</form>
		</table>
<?}?>

<?
####################################################################################
//					�������
####################################################################################
if($pmode==2){?>

		<script language=javascript>
		function chk(){
		if(!ok.filename.value){alert('�����Ώۃt�@�C����I�����ĉ�����\n�����A�Ώۃt�@�C�����T�[�o�[�ɂȂ���΁A�t�@�C�����A�b�v���[�h���ĉ�����');ok.filename.focus();return false;}
		}
		function chkup(){
		if(!up.backup.value){alert('�A�b�v���[�h����t�@�C����I��ŉ�����');up.backup.click();return false;}
		}
		</script>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>n@log �f�[�^�[ �o�b�N�A�b�v �t�@�C�� �A�b�v���[�h</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/upload.php onsubmit="return chkup()" name=up enctype=multipart/form-data>
		<tr bgcolor=white>
		<td><input type=file name=backup size=32 class=input> ���̃t�@�C���� n@log�t�H���_�[�ɓ]�����܂��B</td>
		<td align=right><input type=submit class=button value=�]��></td>
		</tr>
		</form>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr><td>�f�[�^�[�𕜋�����ɂ́An@log���ݒu����Ă���t�H���_�[�ɁA�o�b�N�A�b�v�t�@�C��(*.sql)�����Ă����K�v������܂��B<br>
		FTP�œ]�����邩�A��L�̃t�H�[���œ]������t�@�C����Y�t���ĉ������B<br>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>n@log �t�H���_�[�ɕۑ����ꂽ�f�[�^�[�t�@�C������</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/restore.php onsubmit="return chk()" name=ok>
		<td><select name=filename>
		<option value="">�f�[�^�[�𕜋�����t�@�C����I��ŉ������B</option>
		<?
		$handle=@opendir("./");
		while ($dir = @readdir($handle))
		{
		if(!eregi("\.sql$",$dir)){continue;}
		echo "<option value=\"$dir\">$dir</option>";
		}
		?>
		</select> ���̃t�@�C�����T�[�o�[��n@log�ɕ������܂��B</td>
		<td align=right><input type=submit class=button value=�����J�n></td>
		</tr>
		</table>


<?}?>

<?
####################################################################################
//					�v���O�C�����
####################################################################################
if($pmode==3){?>
<table width=100% board=0 cellpadding=5 cellspacing=0 align=center bgcolor=white>
<tr>
<td width=99% valign=top>
	<table width=100% board=0 cellpadding=4 cellspacing=0 align=center bgcolor=white>
	<tr>
	<td width=1% nowrap>�v���O�C����</td>
	<td width=99%> : <?=$plugin[name]?></td>
	</tr>	
	<tr>
	<td width=1% nowrap>�v���O�C�� ID</td>
	<td width=99%> : <?=$plugin[id]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>�o�[�W����</td>
	<td width=99%> : <?=$plugin[version]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>�z�z��</td>
	<td width=99%> : <?=$plugin[date]?></td>
	</tr>
	<tr>
	<td width=1% nowrap> ��� </td>
	<td width=99%> : <?=$plugin[programmer]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>e-mail</td>
	<td width=99%> : <?=$plugin[email]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>homepage</td>
	<td width=99%> : <?=$plugin[homepage]?></td>
	</tr> 
	</table>                        
</td>
<td width=1% nowrap valign=top><img src="plug_in/<?=$plugin[dir]?>/logo.gif" border=0></td>
</tr>
</table>
<?}?>
