<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?
include "../include/getmartinfo.php";

if($event_no){
	$SQL = "select * from $EventboardTable where event_no = $event_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);
		$ary = mysql_fetch_array($dbresult);
		$event_no = $ary["event_no"];
		$mart_id = $ary["mart_id"];
		$title = $ary["title"];
		$write_date = $ary["write_date"];
		$content = $ary["content"];
		if($content)
			$content = "<br>$content";
		$msg_head = $ary["msg_head"];
		$readnum = $ary["readnum"];
		$userfile = $ary["userfile"];
		$userfile1 = $ary["userfile1"];
		$write_date_str = substr($write_date,0,4)."�� ".substr($write_date,5,2)."�� ".substr($write_date,8,2)."��";
	}

	//========================= �׸������� ������ ��� =======================================
	$upload = "../../up/";
	$target = "$upload"."$userfile";
	$target1 = "$upload"."$userfile1";

	if(eregi("\.jpg", $userfile) || eregi("\.gif", $userfile)) 
		$img_file = "<img src='$target' border='0'><br>".$img_file;
	elseif(eregi("\.swf", $userfile)) 
		$img_file = "<embed src='$target' border='0'><br>".$img_file;

	if( $userfile ){
		//========================== ���� ����� ���� ======================================
		$size = filesize($target);
		//========================== ���� ����� �̻ڰ� �ٹ� ===============================
		$size = GetFileSize($size);
		//==================== �̹��� ����� ���� ==========================================
		$img_size = GetImageSize("$target"); 

		if(eregi("\.jpg", $userfile) || eregi("\.gif", $userfile)){
			$img_width = $img_size[0]; //�̹����� ���̸� �� �� ���� 
			$img_height = $img_size[1]; //�̹����� ���̸� �� �� ����
		}
	}

	if( $userfile1 ){
		$size1 = filesize($target1);
		$size1 = GetFileSize($size1);
	}
?>
<?
	include "../include/head_alltemplate.php";
?>

<body>
<a name="top"></a>

<table width="740" border="0" align="center" cellpadding="10" cellspacing="1" bgcolor="#DBDBDB">
	<tr>
		<td bgcolor="#FFFFFF">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" align='center'>
<?
	if( $img_file ){
		if( $img_width > 750 ){
?>

						<a href='#1' onClick="window.open('big.html?file=<?=$userfile?>','������������','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><img src='<?=$target?>' border='0' width='750'></a></center>
<? 
		}else{ 
?>
						<a href='#1' onClick="window.open('big.html?file=<?=$userfile?>','������������','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file?></a></center>
<?
		}
	}
?>
						<?=$content?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?
	$SQL = "update $EventboardTable set readnum = $readnum +1 where event_no = $event_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
}
?>
<?
mysql_close($dbconn);
?>