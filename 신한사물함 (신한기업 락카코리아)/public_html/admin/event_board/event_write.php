<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$this_year = date("Y");
$this_month = date("m");
$this_day = date("d");

if(isset($flag)==false){


//관리자...이멜...아이디..	
$SQL = "select * from $MartInfoTable where mart_id ='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$admin_name = $ary["name"];
	$admin_email = $ary["email"];
}
//관리자...이멜...아이디..	
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
		alert("제목을 적어주세요!!")
		f.title.focus();
		return false;
	}

	// #####################################################################
	// ###  홈페이지주소,포트번호,이미지업로드,경로,용량,업로드절대경로  ###
	// ###  저장되는 이미지를 위한 부분									 ###
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
//이벤트 새창여부
/*
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

f.s_year.value = "<?=$this_year?>";
f.s_month.value = "<?=$this_month?>";
f.s_day.value = "<?=$this_day?>";
f.e_year.value = "<?=$this_year?>";
f.e_month.value = "<?=$this_month?>";
f.e_day.value = "<?=$this_day?>";

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
			<!--왼쪽부분시작-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>이벤트관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
			
			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>     
					<td width="90%" bgcolor="#FFFFFF" valign="top"><br>     
						<p style="padding-left: 10px"><span class="aa">[이벤트 등록]</span>
					</td>    
				</tr>    
 
				<form method=post  name=writeform onsubmit='return checkform(this)' enctype="multipart/form-data"> 
				<input type='hidden' name='flag' value='write'>
				<input type=hidden name=content value=''> 
        
				<tr>       
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="97%">       
						<tr>       
							<td width="100%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">       
								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">날짜</span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left">
										<span class="aa"><?echo date("Y-m-d")?></span></td>       
              					</tr>
<!--               			<tr>         
                			<td width="14%" bgcolor="#C8DFEC" align="left">
                				<span class="aa">말머리</span></td>         
                			<td width="48%" bgcolor="#FFFFFF" align="left">
                				<span class="aa">
                				<select class="aa" name="msg_head" size="1">
                				<option value='[뉴스]'>[뉴스]</option>
                				<option value='[이벤트]'>[이벤트]</option>
                				<option value='[필독]'>[필독]</option>
                				<option value='[초강추]'>[초강추]</option>
                				<option value='[공지]'>[공지]</option>
                				<option value='[안내]'>[안내]</option>
                				</select>
                  				&nbsp;</span>
                  				<span class="aa">&nbsp;&nbsp;
            					<input name="event_board_color" value='' size="14" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span>
            					<a href="javascript:colorPicker('writeform', ' event_board_color')">
                  				<img src="../images/pick.gif" align="absmiddle" WIDTH="19" HEIGHT="18" border='0'>
            					</a>
                  			</td>          
              			</tr>            -->
              					<tr>         
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">제목</span></td>         
									<td width="48%" bgcolor="#FFFFFF" align="left">
										<span class="aa">
										<input class="aa" name="title" size="67" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">          
										&nbsp;</span>
									</td>          
								</tr>          

								<tr>         
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">이벤트 대상</span></td>         
									<td width="48%" bgcolor="#FFFFFF" align="left">
										<span class="aa">
										<input class="aa" name="title1" size="67" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">          
										&nbsp;</span>
									</td>          
								</tr>

								<tr>          
									<td bgcolor="#C8DFEC" colspan="2" align="center">내 용</td>
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
											<param name="InsertHtml" value="">
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
										<span class="aa">이미지첨부 </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><input type='file' name='userfile' size='30' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; "></td>       
								</tr>

								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">파일첨부 </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><input type='file' name='userfile1' size='30' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; "></td>       
								</tr>
		<!-- 
								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">새창여부 </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><input type="checkbox" name="chkWin" value="Y" onclick="javascrip:checkOk()"  style="border:0;"> <span class="aa">
					  &nbsp;&nbsp;<font color="red"> * 메인화면의 이벤트 새창여부를 선택해 주세요.</font> </td>       
								</tr>

								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">새창폭  </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtWidth" value="" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel </td>
									</tr>
								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">새창높이  </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtHeight" value="" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel </td>
									</tr>
								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">새창 Y축 위치 </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtTop" value="" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel</td>
									</tr>
								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">새창 X축 위치  </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="text" name="txtLeft" value="" size="5" maxlength="10" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px; ">Pixel &nbsp; </td>
									</tr>
		 -->
								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">이벤트기간  </span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa">
										<select name="s_year" style="font-size:9pt;">
											<option value="<?=date("Y")?>" ><?=date("Y")?>년</option>
											<option value='<?=(date("Y") + 1)?>'><?=(date("Y") + 1)?>년</option>
										</select>

										<select name="s_month" style="font-size:9pt;">
											<? for($i=1;$i<=12;$i++){ ?>
											<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>월</option>
											<?}?>
										</select>

										<select name="s_day" style="font-size:9pt;">
											<? for($i=1;$i<=31;$i++){ ?>
											<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>일</option>
											<?}?>
										</select> 부터

										<select name="e_year" style="font-size:9pt;">
											<option value="<?=date("Y")?>" ><?=date("Y")?>년</option>
											<option value='<?=(date("Y") + 1)?>'><?=(date("Y") + 1)?>년</option>
										</select>

										<select name="e_month" style="font-size:9pt;">
											<? for($i=1;$i<=12;$i++){ ?>
											<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>월</option>
											<?}?>
										</select>

										<select name="e_day" style="font-size:9pt;">
											<? for($i=1;$i<=31;$i++){ ?>
											<option value="<?=addzero($i,2)?>" ><?=addzero($i,2)?>일</option>
											<?}?>
										</select> 까지&nbsp; 
									</td>
								</tr>

								<tr>       
									<td width="14%" bgcolor="#C8DFEC" align="left">
										<span class="aa">리스트에 출력</span></td>       
									<td width="48%" bgcolor="#FFFFFF" align="left"><span class="aa"><input type="checkbox" name="list_chk" value="Y"  style="border:0;" checked></td>
								</tr>

							</table>          
						</td>
					</tr>

					<tr>          
						<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br> 
							<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료">&nbsp; 
							<input class="aa" onclick='re_init(this.form)' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="재입력">&nbsp; 
							<input class="aa" onclick="window.location.href='event_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로"><br>        
							</p>     
						</td>        
					</tr>         

				</table>
        	</td>            
  		</tr>            
		</form>
		</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
<?
$this_year = date("Y");
$this_month = date("m");
$this_day = date("d");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
document.writeform.s_year.value = "<?=$this_year?>";
document.writeform.s_month.value = "<?=$this_month?>";
document.writeform.s_day.value = "<?=$this_day?>";
document.writeform.e_year.value = "<?=$this_year?>";
document.writeform.e_month.value = "<?=$this_month?>";
document.writeform.e_day.value = "<?=$this_day?>";
//-->
</SCRIPT>
</body>            
<?
}
elseif ($flag == "write") {
	//================== 업로드 함수 불러옴 ==================================================
	include "../../market/upload.php";
	//================== 첨부 파일을 업로드함 ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$UploadRoot", $userfile, $userfile_name );
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$UploadRoot", $userfile1, $userfile1_name );
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

	$SQL = "insert into $EventboardTable (mart_id, title,  title1, write_date, content, readnum,   event_board_color, userfile, userfile1, open_win, win_width, win_height, win_left, win_top, start_date, end_date, list_chk ) 
	values ('$mart_id', '$title', '$title1', now(), '$content', 0, '$event_board_color', '$file', '$file1', '$chkWin', '$txtWidth', '$txtHeight', '$txtLeft', '$txtTop', '$start_date', '$end_date', '$list_chk' )";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=event_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>