<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";

if (isset($flag) == false) {
	if (isset($prevno) == false) $prevno = 0;
	
	$SQL = "select * from $EventboardTable where event_no = $event_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);
		$ary = mysql_fetch_array($dbresult);
		$event_no = $ary[event_no];
		$mart_id = $ary[mart_id];
		$title = $ary[title];
		$title1 = $ary[title1];
		$write_date = $ary[write_date];
		$content = htmlspecialchars($ary[content], ENT_QUOTES);
		$msg_head = $ary[msg_head];
		$event_board_color = $ary[event_board_color];

		$userfile = $ary[userfile];
		$userfile1 = $ary[userfile1];

		$userfile_old = $ary[userfile];
		$userfile1_old = $ary[userfile1];

		$if_event = $ary[if_event];
		$open_win = $ary[open_win];
		$win_width = $ary[win_width];
		$win_height = $ary[win_height];
		$win_left = $ary[win_left];
		$win_top = $ary[win_top];
		$start_date = $ary[start_date];
		$end_date = $ary[end_date];
		$list_chk = $ary[list_chk];

		$s_date = explode("-",$start_date);
		$e_date = explode("-",$end_date);

		if($start_date){
			$s_year = $s_date[0];
			$s_month = $s_date[1];
			$s_day = $s_date[2];
		}else{
			$s_year = date("Y");
			$s_month = date("m");
			$s_day = date("d");
		}

		if($end_date){
			$e_year = $e_date[0];
			$e_month = $e_date[1];
			$e_day = $e_date[2];
		}else{
			$e_year = date("Y");
			$e_month = date("m");
			$e_day = date("d");
		}

		//========================= �׸������� ������ ��� ===================================
		$upload = "../../up/";//÷������ ���
		$target = "$upload"."$userfile";
		$target1 = "$upload"."$userfile1";

		if( $userfile ){
			//========================== ���� ����� ���� ==================================
			$size = filesize($target);
			//========================== ���� ����� �̻ڰ� �ٹ� ===========================
			$size = GetFileSize($size);
			//==================== �̹��� ����� ���� ======================================
			$img_size = GetImageSize("$target"); 
		}

		if( $userfile1 ){
			$size1 = filesize($target1);
			$size1 = GetFileSize($size1);
		}
		//====================================================================================

	}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>
function checkform(f){
	if (f.title.value.length < 1){
		alert("������ �����ּ���!!")
		f.title.focus();
		return false;
	}

	// #####################################################################
	// ###  Ȩ�������ּ�,��Ʈ��ȣ,�̹������ε�,���,�뷮,���ε�������  ###
	// ###  ����Ǵ� �̹����� ���� �κ�									 ###
	// #####################################################################
	var base = document.writeform;
	if (base.content_txt.UploadLocalImg("<?=$urlx?>", <?=$port?>, "<?=$upload_php?>", "<?=$upload?>", 0, "<?=$homeup_url?>") < 0){
		alert(base.content_txt.UploadImgError);
		return false;
	}
	base.content.value = base.content_txt.Body;
	//=======================================================================

	return true;
}
</script>

<script>
/*
//�̺�Ʈ ��â����
function checkOk() {
	var f = document.writeform;
	if (f.chkWin.checked == true) {	
		f.txtWidth.disabled	= false;	
		f.txtHeight.disabled	= false;
		f.txtTop.disabled		= false;	
		f.txtLeft.disabled		= false;
		f.s_year.disabled = false;		
		f.s_month.disabled = false;		
		f.s_day.disabled = false;		
		f.e_year.disabled	= false;		
		f.e_month.disabled	= false;		
		f.e_day.disabled	= false;
//		f.list_chk.disabled	= false;

		f.s_year.value = "<?=$s_year?>";
		f.s_month.value = "<?=$s_month?>";
		f.s_day.value = "<?=$s_day?>";
		f.e_year.value = "<?=$e_year?>";
		f.e_month.value = "<?=$e_month?>";
		f.e_day.value = "<?=$e_day?>";

	} else {
		f.txtWidth.disabled	= true;	
		f.txtHeight.disabled	= true;
		f.txtTop.disabled		= true;	
		f.txtLeft.disabled		= true;
		f.s_year.disabled = true;		
		f.s_month.disabled = true;		
		f.s_day.disabled = true;		
		f.e_year.disabled	= true;		
		f.e_month.disabled	= true;		
		f.e_day.disabled	= true;
//		f.list_chk.disabled	= true;			
		f.txtWidth.value		= 0;	
		f.txtHeight.value		= 0;
		f.txtTop.value			= 0;	
		f.txtLeft.value		= 0;			
	}
}
*/
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�̺�Ʈ����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>
			
			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>     
					<td width="90%" bgcolor="#FFFFFF" valign="top"><br>     
						<p style="padding-left: 10px"><span class="aa">[�̺�Ʈ ����]</span>
					</td>    
				</tr>             
			
			<form method=post  name=writeform onsubmit='return checkform(this)' enctype="multipart/form-data">
		<input type="hidden" name="flag" value="update">
		<input type="hidden" name="event_no" value="<?echo $event_no?>">
		<input type=hidden name=content value='<?echo $content?>'> 
		<input type="hidden" name="userfile_old" value="<?=$userfile_old?>">
		<input type="hidden" name="userfile1_old" value="<?=$userfile1_old?>">
		  
		  <tr>       
			<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
				<table border="0" width="97%">       
					<tr>       
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">       
							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">��¥</span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<span class="aa"><?echo date("Y-m-d")?></span></td>       
							</tr>       
<!--               			<tr>         
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">���Ӹ�</span></td>         
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<span class="aa">
									<select class="aa" name="msg_head" size="1">
									<option value='[����]'
									<?
									if($msg_head == '[����]') echo " selected"
									?>
									>[����]</option>
									<option value='[�̺�Ʈ]'
									<?
									if($msg_head == '[�̺�Ʈ]') echo " selected"
									?>
									>[�̺�Ʈ]</option>
									<option value='[�ʵ�]'
									<?
									if($msg_head == '[�ʵ�]') echo " selected"
									?>
									>[�ʵ�]</option>
									<option value='[�ʰ���]'
									<?
									if($msg_head == '[�ʰ���]') echo " selected"
									?>
									>[�ʰ���]</option>
									<option value='[����]'
									<?
									if($msg_head == '[����]') echo " selected"
									?>
									>[����]</option>
									<option value='[�ȳ�]'
									<?
									if($msg_head == '[�ȳ�]') echo " selected"
									?>
									>[�ȳ�]</option>
									</select>
										&nbsp;</span>
										<span class="aa">&nbsp;&nbsp;
									<input name="event_board_color" value='<?echo $event_board_color?>' size="14" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span>
									<a href="javascript:colorPicker('writeform', ' event_board_color')">
										<img src="../images/pick.gif" align="absmiddle" WIDTH="19" HEIGHT="18" border='0'>
									</a>
									</td>          
							</tr>   -->
							<tr>         
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">����</span></td>         
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<span class="aa">
									<input class="aa" name="title" value='<?echo $title?>' size="67" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">          
										&nbsp;</span>
									</td>          
							</tr>          

							<tr>         
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">�̺�Ʈ ���</span></td>         
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<span class="aa">
									<input class="aa" name="title1" value='<?echo $title1?>' size="67" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">          
										&nbsp;</span>
									</td>          
							</tr>

								<tr>          
									<td bgcolor="#C8DFEC" colspan="2" align="center">�� ��</td>
								</tr>                   
								<tr>
									<td bgcolor="#FFFFFF" align="center" colspan="2">
										<object id="content_txt" codebase="<?=$edit_url?>GsWebEdit.cab#version=1,0,0,62" height="550" width="100%" classid="CLSID:8B844CB2-4E1B-4707-B3D5-31C00D717398">
											<param name="AhrefAutoTargetUse" value="true">
											<param name="AhrefAutoTarget" value="__blank">
											<param name="CurMoveFirst" value="true">
											<param name="Metacontent" value="<?=$url?>">
											<param name="CharSet" value="ks_c_5601-1987">
											<param name="BorderColor" value="#FFFFFF">
											<param name="InsertHtml" value="<?=$content?>">
											<param name="FontSize" VALUE="">
											<param name="LimitAttachFileSize" value="0">
											<param name="LimitAttachFileTotalSize" value="0">
											<param name="LimitAttachFileCount" value="0">
											<param name="CSSUrl" value="<?=$style_url?>style.css">
											<param name="TableBorder" value="1">
											<param name="TableCellSpacing" value="2">
											<param name="TableCellPadding" value="1">
											<param name="ShowProgressBar" value="true">
											<param name="ToolBarStyleUrl" value="<?=$style_url?>style.txt">
											<param name="UseBR" value="true">
											<param name="UseStyle" value="true">
											<param name="ToolBarImagePath" value="">
											<param name="ToolBarHotImagePath" value="">
											<param name="ToolBarDisableImagePath" value="">
											<param name="TabPosition" value="bottom">
										</object>
										<textarea style='display:none' name="item_content"></textarea>
									</td>
								</tr>          


							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">�̹���÷�� </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><input type='file' name='userfile' size='30' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">
<?
if( $userfile ){
?>
<span class="bb">÷���̹��� : <a href='<?=$target?>' target='_blank'><?=$userfile?> (<?=$size?>)</a> <input type="checkbox" name="img_del" value="Y"> ÷�� �̹��� ������ üũ
<?
}
?>								
								</td>       
							</tr>

							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">����÷�� </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><input type='file' name='userfile1' size='30' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">
<?
if( $userfile1 ){
?>
<span class="bb">÷������ : <a href='<?=$target1?>' target='_blank'><?=$userfile1?> (<?=$size1?>)</a> <input type="checkbox" name="file_del" value="Y"> ÷��  ���� ������ üũ
<?
}
?>
								</td>       
							</tr>
<!-- 
							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">��â���� </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><input type="checkbox" name="chkWin" value="Y" onclick="javascrip:checkOk()"  style="border:0;" <?if($open_win=="Y") echo "checked"?>> <span class="aa">
				  &nbsp;&nbsp;<font color="red"> * ����ȭ���� �̺�Ʈ ��â���θ� ������ �ּ���.</font> </td>       
							</tr>

							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">��â��  </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtWidth" value="<?=$win_width?>" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel </td>
							</tr>
							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">��â����  </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtHeight" value="<?=$win_height?>" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel </td>
							</tr>
							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">��â Y�� ��ġ </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtTop" value="<?=$win_left?>" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel</td>
							</tr>
							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">��â X�� ��ġ  </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtLeft" value="<?=$win_top?>" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel &nbsp; </td>
							</tr>
 -->
							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">�̺�Ʈ�Ⱓ  </span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa">
								
								<select name="s_year" style="font-size:9pt;">
									<option value="<?=date("Y")?>" ><?=date("Y")?>��</option>
									<option value='<?=(date("Y") + 1)?>'><?=(date("Y") + 1)?>��</option>
								</select>

								<select name="s_month" style="font-size:9pt;">
									<? for($i=1;$i<=12;$i++){ ?>
									<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>��</option>
									<?}?>
								</select>

								<select name="s_day" style="font-size:9pt;">
									<? for($i=1;$i<=31;$i++){ ?>
									<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>��</option>
									<?}?>
								</select> ����

								<select name="e_year" style="font-size:9pt;">
									<option value="<?=date("Y")?>" ><?=date("Y")?>��</option>
									<option value='<?=(date("Y") + 1)?>'><?=(date("Y") + 1)?>��</option>
								</select>

								<select name="e_month" style="font-size:9pt;">
									<? for($i=1;$i<=12;$i++){ ?>
									<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>��</option>
									<?}?>
								</select>

								<select name="e_day" style="font-size:9pt;">
									<? for($i=1;$i<=31;$i++){ ?>
									<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>��</option>
									<?}?>
								</select> ����
								&nbsp; </td>
							</tr>

							<tr>       
								<td width="14%" bgcolor="#C8DFEC" align="left">
									<span class="aa">����Ʈ�� ���</span></td>       
								<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="checkbox" name="list_chk" value="Y"  style="border:0;" <?if($list_chk=="Y") echo "checked"?>></td>
							</tr>


							</table>          
						</td>
					</tr>
					<tr>          
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">       
							<p align="center"><br> 
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�">&nbsp; 
							<input class="aa" onclick='re_init(this.form)' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���Է�">&nbsp; 
							<input class="aa" onclick="window.location.href='event_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��"><br>        
							</p>     
					</td>        
					</tr>         
				</table>        
			</td>            
		</tr>            
		</form>
		</table>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table> 
<SCRIPT LANGUAGE="JavaScript">
<!--
document.writeform.s_year.value = "<?=$s_year?>";
document.writeform.s_month.value = "<?=$s_month?>";
document.writeform.s_day.value = "<?=$s_day?>";
document.writeform.e_year.value = "<?=$e_year?>";
document.writeform.e_month.value = "<?=$e_month?>";
document.writeform.e_day.value = "<?=$e_day?>";
//-->
</SCRIPT>
</body>            
<?
}
elseif ($flag == "update") {

	$upload = "../../up/";//÷������ ���

	if($img_del  == "Y" || $file_del  == "Y" ) {
		//================== ���� ���� �ҷ��� ==========================================	
		$SQL = "select userfile, userfile1 from $EventboardTable where event_no = $event_no and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$del_userfile = mysql_result($dbresult,0,0);
		$del_userfile1 = mysql_result($dbresult,0,1);
	}

	if($img_del  == "Y"){
		if( $del_userfile ){ //�ش��ȣ�� ������ �ִٸ� ������ ������
			$desc = "{$upload}{$del_userfile}";
			unlink($desc);
			$file_sql .= ", userfile = ''";
		}
	}
	if($file_del  == "Y"){
		if( $del_userfile1 ){ //�ش��ȣ�� ������ �ִٸ� ������ ������
			$desc1 = "{$upload}{$del_userfile1}";
			unlink($desc1);
			$file_sql .= ", userfile1=''";
		}
	}


	//================== ���ε� �Լ� �ҷ��� ==========================================
	include "../../market/upload.php";
	//================== ÷�� ������ ���ε��� ========================================
	if( $userfile_name ){
		$file = FileUploadName( "$userfile_old", "$UploadRoot", $userfile, $userfile_name );
		$file_sql = ", userfile='$file'";
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "$userfile1_old", "$UploadRoot", $userfile1, $userfile1_name );
		$file_sql .= ", userfile1='$file1'";
	}

/*
	if($chkWin == "Y"){
		$start_date = $s_year."-".$s_month."-".$s_day;
		$end_date = $e_year."-".$e_month."-".$e_day;
	}else{
		$list_chk = "Y";
	}
*/

	$start_date = $s_year."-".$s_month."-".$s_day;
	$end_date = $e_year."-".$e_month."-".$e_day;

	$SQL = "update $EventboardTable set title = '$title',title1 = '$title1', content = '$content', msg_head = '$msg_head',  event_board_color='$event_board_color', open_win='$chkWin' , win_width='$txtWidth' , win_height='$txtHeight' , win_left='$txtLeft' , win_top='$txtTop', start_date='$start_date' , end_date='$end_date' , list_chk='$list_chk' $file_sql  where event_no = $event_no and mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=event_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>