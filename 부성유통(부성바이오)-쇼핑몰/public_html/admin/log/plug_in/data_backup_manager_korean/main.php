<?
####################################################################################
//					준비
####################################################################################
set_time_limit(0);
if(!$is_admin){
nalog_error("이 플러그인은 관리자만 사용할 수 있습니다.");
}
?>

<?
####################################################################################
//					첫화면
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
//					백업화면
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
		<td>총 <b><?=$total?></b>개의 카운터</td>
		<td align=right>저장방법 : <input type=radio name=how value=1 checked> 다운로드 
		<input type=radio name=how value=0> 서버에 저장 (저장경로 : <?=str_replace("admin_counter.php","*.sql",$PHP_SELF)?>)</td> 
		</tr> 
		</table>
	
		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<input type=hidden name=counter value="<?=$counter?>">
		<input type=hidden name=id value="<?=$id?>">
		<input type=hidden name=pmode value="<?=$pmode?>">
		<tr bgcolor=#C9F0FF>
		<td width=1% nowrap align=center>번호</td>
		<td width=1% nowrap align=center>선택</td>
		<td width=92% align=center>카운터 이름</td>
		<td width=1% nowrap align=center>카운터기록</td>
		<td width=1% nowrap align=center>OS/BW기록</td>
		<td width=1% nowrap align=center>LOG기록</td>
		<td width=1% nowrap align=center>DLOG기록</td>
		<td width=1% nowrap align=center>방문자기록</td>
		<td width=1% nowrap align=center>회원기록</td>
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
		<td width=1% nowrap align=right>$total_data[0]일</td>
		<td width=1% nowrap align=right>$total_os[0]/$total_bw[0]개</td>
		<td width=1% nowrap align=right>$total_log[0]개</td>
		<td width=1% nowrap align=right>$total_dlog[0]개</td>
		<td width=1% nowrap align=right>$total_counter[0]명</td>
		<td width=1% nowrap align=right>$total_member[0]명</td>
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
		<td align=center><input type=submit class=button value=백업하기></td>	
		</tr>
		</form>
		</table>
<?}?>

<?
####################################################################################
//					복구화면
####################################################################################
if($pmode==2){?>

		<script language=javascript>
		function chk(){
		if(!ok.filename.value){alert('복구 대상 파일을 선택해 주세요\n만약 대상 파일이 서버에 없다면 파일을 업로드해 주세요');ok.filename.focus();return false;}
		}
		function chkup(){
		if(!up.backup.value){alert('업로드할 파일을 선택해 주세요');up.backup.click();return false;}
		}
		</script>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>n@log 데이터 백업 파일 업로드</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/upload.php onsubmit="return chkup()" name=up enctype=multipart/form-data>
		<tr bgcolor=white>
		<td><input type=file name=backup size=32 class=input> 파일을 n@log디렉토리로 전송 합니다.</td>
		<td align=right><input type=submit class=button value=전송하기></td>
		</tr>
		</form>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr><td>데이터를 복구하려면 n@log가 설치된 디렉토리에 백업 파일(*.sql)이 있어야 합니다.<br>
		FTP로 직접 전송 하시거나 위의 폼에 전송하실 파일을 첨부해 주세요.<br>
		</td></tr>
		</table>

		<table align=center width=98% cellpadding=4 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=#C9F0FF>
		<td align=center>n@log 디렉토리에 저장된 데이터 파일 복구</td>
		</tr>
		</table>

		<table align=center width=98% cellpadding=10 cellspacing=0 border=1 bordercolor=white>
		<tr bgcolor=white>
		<form method=post action=plug_in/<?=$plugin[dir]?>/restore.php onsubmit="return chk()" name=ok>
		<td><select name=filename>
		<option value="">데이터를 복구할 파일을 선택하세요</option>
		<?
		$handle=@opendir("./");
		while ($dir = @readdir($handle))
		{
		if(!eregi("\.sql$",$dir)){continue;}
		echo "<option value=\"$dir\">$dir</option>";
		}
		?>
		</select> 파일을 현재 서버의 n@log로 복구 합니다.</td>
		<td align=right><input type=submit class=button value=복구시작></td>
		</tr>
		</table>


<?}?>

<?
####################################################################################
//					플러그인정보
####################################################################################
if($pmode==3){?>
<table width=100% board=0 cellpadding=5 cellspacing=0 align=center bgcolor=white>
<tr>
<td width=99% valign=top>
	<table width=100% board=0 cellpadding=4 cellspacing=0 align=center bgcolor=white>
	<tr>
	<td width=1% nowrap>플러그인이름</td>
	<td width=99%> : <?=$plugin[name]?></td>
	</tr>	
	<tr>
	<td width=1% nowrap>플러그인 ID</td>
	<td width=99%> : <?=$plugin[id]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>배포버전</td>
	<td width=99%> : <?=$plugin[version]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>배포일자</td>
	<td width=99%> : <?=$plugin[date]?></td>
	</tr>
	<tr>
	<td width=1% nowrap>제 작 자</td>
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
