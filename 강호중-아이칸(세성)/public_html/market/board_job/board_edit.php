<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ���� ������ �ҷ��� =============================================
include "../../main.class";
?>
<?
$SQL = "select perms from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, 0);
if($perms == "4") {
	echo ("		
	<script>
		alert('�̵�� ���θ��Դϴ�.');
		history.go(-1);
	</script>
	");
	exit;
}

$SQL = "select * from $New_BoardConfigTable where mart_id = '$mart_id' and bbs_no = '$bbs_no'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

$board_title = $ary[board_title];	
$board_comment = $ary[board_comment];	
$board_date = $ary[board_date];
$comment_ok = $ary[comment_ok];
$item_fg_color = $ary[item_fg_color];	
$item_bg_color = $ary[item_bg_color];	
$table_fg_color = $ary[table_fg_color];	
$table_bg_color = $ary[table_bg_color];	
$headhtml = $ary[headhtml];
$tailhtml = $ary[tailhtml];
$top_body = $ary[top_body];
$bottom_body = $ary[bottom_body];	
$board_class = $ary[board_class];	
$pagecount = $ary[pagecount];	
$if_use_secret = $ary[if_use_secret];
$userfile_use = $ary[userfile_use];
$jungbo_gubun = $ary[jungbo_gubun];

if(!$Mall_Admin_ID&&$MemberLevel!=1){
	if( $board_class == 1 || $board_class == 3 ){
		$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		
		if($numRows < 1){
			echo ("		
				<script>
				window.alert('ȸ������ �����Դϴ�.');
				parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
				</script>
			");
			exit;	
		}
	}
}
if($board_class == 2){

 if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
	
	echo ("		
	<script>
		alert('�����ڸ� ������ �� �ֽ��ϴ�.');
		history.go(-1);
	</script>
	");
	exit;
 }
}						

include( '../include/getmartinfo.php' );
if(!isset($flag) || $flag != "update"){
	include('../include/head_alltemplate.php');
?>
<script language="javascript">
<!--
/*
function goTo(){
	var f=document.boardchange;
	f.action="board.php";
	f.submit();
}*/
//-->
</script>
<script>
/*
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}
*/
function board_checkform(){
	var f = document.writeform;
	if (f.writer.value.length < 1){
		alert("������ �Է��ϼ���.")
		f.writer.focus();
		return;
	}
	if (f.subject_new.value.length < 1){
		alert("���� ������ �����Ͻñ� �ٶ��ϴ�.")
		f.subject_new.focus();
		return;
	}
<?
if( $board_class == 0 ){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
?>
	if (f.passwd.value.length < 1){
		alert("��й�ȣ�� ����/�����ÿ� �ʿ��մϴ�.")
		f.passwd.focus();
		return;
	}
<?
	}
}
?>
	//f.editBox.editmode = "html";
	//f.content.value = f.editBox.html;
	var content = ed.getHtml(); //��ü�� textarea�� �ۼ���HTML�� ����
	if(content=="")
	{
			alert("������ �����ּ���!");
			ed.focus();
			return false;
	}
	f.submit();	
}
</script>
<script event="onscriptletevent(name, eventData)" for=editBox>
/*
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
*/
</script>

<script>
//window.onload=HandleLoad
</script>
<?
if( $top_body ){
	//include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}
?>
<!---------------------- �Խ��� ���� ---------------------------------------------------->	
<?
$SQL = "select * from $New_BoardTable where index_no=$index_no and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "���� ���� ����!";

$ary = mysql_fetch_array($dbresult);

$writer = $ary[writer];
$email = $ary[email];
$subject_new = $ary[subject_new];
$content = $ary[content];
$price = $ary[price];
$bunryu = $ary[bunryu];

$if_secret = $ary[if_secret];
$user_file = $ary[userfile];
$user_file1 = $ary[userfile1];
$notice_no = $ary[notice_no];
$end_date = $ary[end_date];
$address2 = $ary[address2];
$open_address2 = $ary[open_address2];
$subject_new = eregi_replace( "<br>", "", $subject_new );
$content = eregi_replace( "<br>", "", $content );

$bunryu = $ary[bunryu];
$bubun = $ary[bubun];
$gigan_day = $ary[gigan_day];

$write_date_str = substr($write_date,0,4)."/".substr($write_date,4,2)."/".substr($write_date,6,2);

//========================= ÷������ó�� =================================================
//========================= �׸������� ������ ��� =======================================
$upload = "../../up/$mart_id/"; //���ε� ���丮

$target = "$upload"."$user_file";
$target1 = "$upload"."$user_file1";
//========================= userfile =====================================================
if(eregi("\.jpg", $user_file) || eregi("\.gif", $user_file)){
	$img_file = "<img src='$target' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file;
	//==================== �̹��� ����� ���� ==========================================
	$img_size = GetImageSize("$target"); 

	if( eregi("\.jpg", $user_file) || eregi("\.gif", $user_file) || eregi("\.JPG", $user_file) || eregi("\.GIF", $user_file) ){
		$img_width = $img_size[0]; //�̹����� ���̸� �� �� ���� 
		$img_height = $img_size[1]; //�̹����� ���̸� �� �� ����
	}
}else if(eregi("\.swf", $user_file)){
	$img_file = "<embed src='$target' border='0'><br>".$img_file;
}

if( $user_file ){
	//========================== ���� ����� ���� ======================================
	$size = filesize($target);
	//========================== ���� ����� �̻ڰ� �ٹ� ===============================
	$size = GetFileSize($size);
}
//========================= userfile1 ====================================================
if( eregi("\.jpg", $user_file1) || eregi("\.gif", $user_file1) ){
	$img_file1 = "<img src='$target1' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file1;
	//==================== �̹��� ����� ���� ==========================================
	$img_size1 = GetImageSize("$target1"); 

	if( eregi("\.jpg", $user_file1) || eregi("\.gif", $user_file1) || eregi("\.JPG", $user_file1) || eregi("\.GIF", $user_file1)){
		$img_width1 = $img_size1[0]; //�̹����� ���̸� �� �� ���� 
		$img_height1 = $img_size1[1]; //�̹����� ���̸� �� �� ����
	}
}else if(eregi("\.swf", $user_file1)){
	$img_file1 = "<embed src='$target1' border='0'><br>".$img_file1;
}

if( $user_file1 ){
	$size1 = filesize($target1);
	$size1 = GetFileSize($size1);
}
//========================= ÷������ó�� =================================================
?>
<script src="../../editor/easyEditor.js"></script>
<SCRIPT LANGUAGE=JAVASCRIPT SRC="../../admin/good/popcal.js"></SCRIPT>
<script type="text/javascript">
<!--
	function gigan_change(gv){
		var arrString = gv.split("|"); 
		var gigan_10=arrString[0];
		var gigan_20=arrString[1];
		var gigan_30=arrString[2];

		document.getElementById("gigan_money10").value = gigan_10;
		document.getElementById("gigan_money20").value = gigan_20;
		document.getElementById("gigan_money30").value = gigan_30;

	}


 

	function addDay(ymd, v_day){
	 var yyyy = ymd.substr(0,4);
	 var mm = eval(ymd.substr(4,2) + "- 1") ;
	 var dd = ymd.substr(6,2);
	 var dt3 = new Date(yyyy, mm, eval(dd + '+' + v_day));
	 yyyy = dt3.getYear();
	 mm = (dt3.getMonth()+1)<10? "0" + (dt3.getMonth()+1) : (dt3.getMonth()+1) ;
	 dd = dt3.getDate()<10 ? "0" + dt3.getDate() : dt3.getDate();

	 document.getElementById("end_date").value = yyyy+"-"+mm+"-"+dd;

	}


//-->
</script>

					<form method='POST' name='writeform' enctype='multipart/form-data' onsubmit='board_checkform(); return false'> 
					<input type='hidden' name='flag' value='update'>
					<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
					<input type='hidden' name='bbs_no' value='<?=$bbs_no?>'>
					<input type='hidden' name='index_no' value='<?=$index_no?>'>
					<input type='hidden' name='page' value='<?=$page?>'>
					<input type='hidden' name='keyset' value='<?=$keyset?>'>
					<input type='hidden' name='searchword' value='<?=$searchword?>'>
					<input type='hidden' name='user_file' value='<?=$user_file?>'>
					<input type='hidden' name='user_file1' value='<?=$user_file1?>'>
					<input type='hidden' name='old_notice_no' value='<?=$notice_no?>'>







<br><br>

					<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
	<?
if($seq_num > 0){ //������û����
$SQL0 = "select * from request_update_board where seq_num='$seq_num'";
$dbresult0 = mysql_query($SQL0, $dbconn);
$rows0 = mysql_fetch_array($dbresult0);
?>					<tr>
							<td width=80 height="30" align="center"><b>������û����</b></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td ><?=nl2br($rows0[content])?></td>
						</tr>
							<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?}?>
						<tr>
							<td height="30" align="center"><b>����</b></td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td ><input name="subject_new" value='<?=$subject_new?>' type="text" class="category_2" size="60" style='ime-mode:active'></td>
						</tr>	
							<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>		
							<tr>
							<td width="70" height="30" align="center"><b>��������</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td>
							<input type=radio name="jungbo_gubun" value="sell" <?if($jungbo_gubun=="sell"){echo"checked";}?>>�Ǹ�����
							<input type=radio name="jungbo_gubun" value="buy" <?if($jungbo_gubun=="buy"){echo"checked";}?>>��������
							<input type=radio name="jungbo_gubun" value="gujik" <?if($jungbo_gubun=="gujik"){echo"checked";}?>>��������
							<input type=radio name="jungbo_gubun" value="guin" <?if($jungbo_gubun=="guin"){echo"checked";}?>>��������
						    </td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>		

						
						<tr>
							<td height="30" align="center">�з�</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td >
							
								<select name='bunryu' onchange="gigan_change(this.value);">
									<option value="">::�����ϼ���::</option>
								<?
								$today = date("Y-m-d");
								$sql = "select * from jungbo_cate order by binary(category_name)";
								$res = mysql_query($sql,$dbconn);
								for($z=0;$row = mysql_fetch_array($res);$z++){
									if($row[bunryu] == $bunryu){
										$bunryu_seld = "selected";
									}
								?>	
									<option value="<?=$row[gigan_money10]?>|<?=$row[gigan_money20]?>|<?=$row[gigan_money30]?>" <?=$bunryu_seld?>><?=$row[category_name]?></option>
								<?
									$bunryu_seld="";
								}
								?>
								</select>
								&nbsp;&nbsp;&nbsp;				
								�κ�:<input type=text name="bubun" value="<?=$bubun?>">
							
							</td>
						</tr>
						<tr>
						  <td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>		
						<tr>
							<td width="70" height="30" align="center"><b>����</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="12" name="price" value='<?=$price?>' style='ime-mode:active'>��
						    </td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>		
						<tr>
							<td width="70" height="30" align="center"><b>�ۼ���</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="20" name="writer" value='<?=$writer?>' style='ime-mode:active'>
						    </td>
						</tr>

						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
if( $board_class == 0 ){	
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
?>
						<tr>
							<td height="30" align="center"><b>��й�ȣ</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td>
								<input type='password' name="passwd" class="input_03" size="20" style='ime-mode:inactive'>
							
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<?
	}
}
?>
<?
if($seq_num > 0 && $MemberLevel==2){ 	//������û�ڸ� �Ⱓ ��������
?>

						<tr>
							<td height="30" align="center">�Ⱓ����</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td >
								<input type=radio name="gigan_day" value="10" <?if($gigan_day==10){echo"checked";}?> onclick="addDay('<?=date("Ymd")?>','10');">10��:<input type=text name="gigan_money10" id="gigan_money10" value="<?=$gigan_money10?>" size=7 readonly>��&nbsp;&nbsp;
								<input type=radio name="gigan_day" value="20" <?if($gigan_day==20){echo"checked";}?> onclick="addDay('<?=date("Ymd")?>','20');">20��:<input type=text name="gigan_money20" id="gigan_money20" value="<?=$gigan_money20?>" size=7 readonly>��&nbsp;&nbsp;
								<input type=radio name="gigan_day" value="30" <?if($gigan_day==30){echo"checked";}?> onclick="addDay('<?=date("Ymd")?>','40');">30��:<input type=text name="gigan_money30" id="gigan_money30" value="<?=$gigan_money30?>" size=7 readonly>��
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center"><b>�ԽñⰣ</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td ><?=date("Y-m-d");?> ~ <input name="end_date" value='<?=$end_date?>' type="text" class="input_03" size="12" onClick="popUpCalendar(this, end_date, 'yyyy-mm-dd');" readonly></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>							
<?}?>						



		
						<tr>
							<td width="70" height="30" align="center"><b>�ŷ����ּ�</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input name="address2" value='<?=$address2?>' type="text" class="input_03" size="30" style='ime-mode:inactive' > <input type=radio name="open_address2" value="n" checked>����� <input type=radio name="open_address2" value="y">����
						    </td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

						<tr>
							<td height="30" align="center" valign="top"><b>����</td>
							<td valign="top"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td height='300'><textarea name="content" id="content" style="width:100%;height:290px"><?=$content?></textarea></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

						<tr>
							<td height="30" align="center"><b>÷������1</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile' size="50">
							<?if($user_file){?>
							<input type=checkbox name=userfile_delete1 value="y">����(<?=$user_file?>)</td>
							<?}?>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td height="30" align="center">÷������2</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type='file' name='userfile1' size="50">
							<?if($user_file1){?>
							<input type=checkbox name=userfile_delete2 value="y">����(<?=$user_file1?>)</td>
							<?}?>
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

					</table>
<script>
		var ed = new easyEditor("content"); //�ʱ�ȭ id�Ӽ���
		ed.init(); //�������� ����
</script>
					<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center"><input type='image' onfocus='blur();' src="../image/helpdesk/bu_modify.gif" border="0"><a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" border="0"></a></td>
						</tr>
					</table>
					</form>
<!---------------------- �Խ��� �� ------------------------------------------------------>
<?
if( $bottom_body ){
	//include "$bottom_body";
}
if( $tailhtml ){
	echo "<br>$tailhtml";
}
?>
</body>
</html>

<?
}
else if($flag == "update"){
	if( $board_class == 0 ){
		$SQL = "select passwd from $New_BoardTable where index_no='$index_no' and mart_id = '$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$passwd_db = mysql_result($dbresult,0,0);

		if( $passwd_db != $passwd && (!$Mall_Admin_ID&&$MemberLevel!=1)){
			echo ("
				<script language='javascript'>
				alert('��й�ȣ�� ��Ȯ���� �ʽ��ϴ�.');
				</script>
			");
			echo "<meta http-equiv='refresh' content='0; URL=board_read.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
			exit;
		}
	}

	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	//�ѱ��ڸ���
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	//================== ���ε� �Լ� �ҷ��� ==========================================
	include "../upload.php";
	$upload_dir = "$UploadRoot$mart_id/";
	// ���͸�ũ �������
	$watermark_path = $upload_dir."__watermark.png";	




	if($userfile_delete1 == "y" && $user_file){		
		$sql = "update $New_BoardTable set userfile='' where index_no='$index_no' and mart_id='$mart_id'";
		$res = mysql_query( $sql, $dbconn );

		unlink("$UploadRoot$mart_id"."/"."$user_file");
	}
	if($userfile_delete2 == "y" && $user_file1){

		$sql = "update $New_BoardTable set userfile1='' where index_no='$index_no' and mart_id='$mart_id'";
		$res = mysql_query( $sql, $dbconn );
	
		unlink("$UploadRoot$mart_id"."/"."$user_file1");
	}





	if( $userfile_name ){//÷�� ������ ���ε� ������ ���ϸ��� ������
		$file = FileUploadName( "$user_file", "$UploadRoot$mart_id/", $userfile, $userfile_name );
		$sql = "update $New_BoardTable set userfile='$file' where index_no='$index_no' and mart_id='$mart_id'";
		$res = mysql_query( $sql, $dbconn );

		if( !$res ){
			echo("
				<script>
				window.alert('�̹����� �����ϴµ� �����߽��ϴ�!');
				history.go(-1)
				</script>
			");
			exit;
		}
		// ���͸�ŷ
		$arr_result = waterMarkImage("$upload_dir".$file, $watermark_path, 50, 100);
	}
	if( $userfile1_name ){//÷�� ������ ���ε� ������ ���ϸ��� ������
		$file1 = FileUploadName( "$user_file1", "$UploadRoot$mart_id/", $userfile1, $userfile1_name );
		$sql = "update $New_BoardTable set userfile1='$file1' where index_no='$index_no' and mart_id='$mart_id'";
		$res = mysql_query( $sql, $dbconn );

		if( !$res ){
			echo("
				<script>
				window.alert('�̹����� �����ϴµ� �����߽��ϴ�!');
				history.go(-1)
				</script>
			");
			exit;
		}
		// ���͸�ŷ
		$arr_result = waterMarkImage("$upload_dir".$file1, $watermark_path, 50, 100);
	}
	if($old_notice_no > 0 && $notice_no == ""){		
		$notice_sql = ", notice_no='0'";
	}
	elseif($old_notice_no == 0 && $notice_no == "y"){
		$que = "select max(notice_no) from $New_BoardTable where bbs_no='$bbs_no'";
		$result = mysql_query($que, $dbconn);
		$max_notice = mysql_result($result,0,0);

		if($max_notice == 0){
			$notice_sql = ", notice_no='100000'";
		}else{
			$max_notice = $max_notice + 1;
			$notice_sql = ", notice_no='$max_notice'";
		}
	}	

	if($seq_num > 0 && $end_date){
		$end_date_sql = ", end_date='$end_date' ";
	}

	$SQL = "update $New_BoardTable set writer='$writer', code='$code', email='$email', subject_new='$subject_new_tmp[0]', content='$content', if_secret='$if_secret', price='$price',address2='$address2',open_address2='$open_address2',jungbo_gubun='$jungbo_gubun' $notice_sql $end_date_sql where index_no ='$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=board_read.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
}
?>
<?
mysql_close($dbconn);
?>