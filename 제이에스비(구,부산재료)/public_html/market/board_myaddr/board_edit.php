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
if($bbs_no==5||$bbs_no==6){
	$bbs_deny_word="��Ŀ,����,����,��.��.��.��,��������,����,����,������,����,URL,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,���,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��,http";

}
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

if( $board_class == 1 || $board_class == 3 ){
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	
	if($numRows < 1){
		echo ("		
			<script>
			window.alert('ȸ������ �����Դϴ�.');
			parent.location.href='../member/login.php?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;	
	}
}

if($board_class == 2 && !$_SESSION["Mall_Admin_ID"]){
	echo ("		
	<script>
		alert('�����ڸ� ������ �� �ֽ��ϴ�.');
		history.go(-1);
	</script>
	");
	exit;
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
?>
	if (f.passwd.value.length < 1){
		alert("��й�ȣ�� ����/�����ÿ� �ʿ��մϴ�.")
		f.passwd.focus();
		return;
	}
<?
}
?>
	//f.editBox.editmode = "html";
	//f.content.value = f.editBox.html;
	var obj_Deny=document.getElementById("bbs_deny_word").value;
	var obj_Title=document.getElementById("subject_new").value;
	var obj_Content=f.content.value;
	var obj_DenyArr=obj_Deny.split(",");
	if(obj_Deny){
		for(var i=0;i<obj_DenyArr.length;i++){
			var chk1=obj_Title.match(obj_DenyArr[i].toString());
			var chk2=obj_Content.match(obj_DenyArr[i].toString());
			if(chk1==obj_DenyArr[i]){
				alert("���� "+chk1+"��(��) ����� �� ���� �ܾ��Դϴ�.");
				return false;
				break;
			}
			if(chk2==obj_DenyArr[i]){
				alert("���뿡 "+chk2+"��(��) ����� �� ���� �ܾ��Դϴ�.");
				return false;
				break;
			}
		}
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
	include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}
?>
<!---------------------- �Խ��� ���� ---------------------------------------------------->	
<?
$SQL = "select * from $New_BoardTable where index_no=$index_no and mart_id = '$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "���� ���� ����!";

$ary = mysql_fetch_array($dbresult);

$writer = $ary[writer];
$email = $ary[email];
$subject_new = $ary[subject_new];
$content = $ary[content];
$if_secret = $ary[if_secret];
$user_file = $ary[userfile];
$user_file1 = $ary[userfile1];
$mobile = $ary[mobile];
$mobile_ex = explode("-",$mobile);
$tel = $ary[tel];
$tel_ex = explode("-",$tel);
$zip = $ary[zip];
$address = $ary[address];
$address_d = $ary[address_d];

$subject_new = eregi_replace( "<br>", "", $subject_new );
$content = eregi_replace( "<br>", "", $content );

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
					<form method='POST' name='writeform' enctype='multipart/form-data' onsubmit='board_checkform(); return false' action="https://www.jsbusan.com:8026/market/board_myaddr/board_edit.php"> 
					<input type='hidden' name='flag' value='update'>
					<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
					<input type='hidden' name='bbs_no' value='<?=$bbs_no?>'>
					<input type='hidden' name='index_no' value='<?=$index_no?>'>
					<input type='hidden' name='page' value='<?=$page?>'>
					<input type='hidden' name='keyset' value='<?=$keyset?>'>
					<input type='hidden' name='searchword' value='<?=$searchword?>'>
					<input type='hidden' name='user_file' value='<?=$user_file?>'>
					<input type='hidden' name='user_file1' value='<?=$user_file1?>'>
					<input type="hidden" name="bbs_deny_word" value="<?=$bbs_deny_word?>">
					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
							<td width="60" align="center" background="../image/helpdesk/table1_bg.gif">������̸�</td>
							<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
							<td background="../image/helpdesk/table1_bg.gif"> &nbsp;&nbsp;<input name="subject_new" value='<?=$subject_new?>' type="text" class="category_2" size="90" style='ime-mode:active'  id="subject_new"></td>
							<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
						</tr>
					</table>

					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="70" height="30" align="center">������</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="20" name="writer" value='<?=$writer?>' style='ime-mode:active'>
							
							</td>
						</tr>
						<tr>
						  <td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
    function daumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // �˾����� �˻���� �׸��� Ŭ�������� ������ �ڵ带 �ۼ��ϴ� �κ�.

                // �� �ּ��� ���� ��Ģ�� ���� �ּҸ� �����Ѵ�.
                // �������� ������ ���� ���� ��쿣 ����('')���� �����Ƿ�, �̸� �����Ͽ� �б� �Ѵ�.
                var fullAddr = ''; // ���� �ּ� ����
                var extraAddr = ''; // ������ �ּ� ����

                // ����ڰ� ������ �ּ� Ÿ�Կ� ���� �ش� �ּ� ���� �����´�.
                if (data.userSelectedType === 'R') { // ����ڰ� ���θ� �ּҸ� �������� ���
                    fullAddr = data.roadAddress;

                } else { // ����ڰ� ���� �ּҸ� �������� ���(J)
                    fullAddr = data.jibunAddress;
                }

                // ����ڰ� ������ �ּҰ� ���θ� Ÿ���϶� �����Ѵ�.
                if(data.userSelectedType === 'R'){
                    //���������� ���� ��� �߰��Ѵ�.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // �ǹ����� ���� ��� �߰��Ѵ�.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // �������ּ��� ������ ���� ���ʿ� ��ȣ�� �߰��Ͽ� ���� �ּҸ� �����.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // �����ȣ�� �ּ� ������ �ش� �ʵ忡 �ִ´�.
                document.getElementById("zip").value = data.zonecode;
                document.getElementById("address").value = fullAddr;

                // Ŀ���� ���ּ� �ʵ�� �̵��Ѵ�.
                document.getElementById("address_d").focus();
            }
        }).open();
    }
</script>
						<tr>
							<td height="30" align="center">�����</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td ><input name="zip" id="zip" value='<?=$zip?>' type="text" class="input_03" size="10">
                              <img src="../images/login_page_btn2.gif" align="absmiddle" style="cursor:hand" onClick="daumPostcode();">
<br>
<input type="text" name="address" id="address" value='<?=$address?>' class="input_03" size="70" style='ime-mode:active'>
                            <br>
                              <input type="text" name="address_d" id="address_d" value='<?=$address_d?>' class="input_03" size="70" style='ime-mode:active'></td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

						<tr>
							<td height="30" align="center">�Ϲ���ȭ</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td>
							<select name=tel1>
							<option value="02" <?if($tel_ex[0]=="02"){echo"selected";}?>>02</option>
							<option value="031" <?if($tel_ex[0]=="031"){echo"selected";}?>>031</option>
							<option value="032" <?if($tel_ex[0]=="032"){echo"selected";}?>>032</option>
							<option value="033" <?if($tel_ex[0]=="033"){echo"selected";}?>>033</option>
							<option value="041" <?if($tel_ex[0]=="041"){echo"selected";}?>>041</option>
							<option value="042" <?if($tel_ex[0]=="042"){echo"selected";}?>>042</option>
							<option value="043" <?if($tel_ex[0]=="043"){echo"selected";}?>>043</option>
							<option value="044" <?if($tel_ex[0]=="044"){echo"selected";}?>>044</option>
							<option value="051" <?if($tel_ex[0]=="051"){echo"selected";}?>>051</option>
							<option value="052" <?if($tel_ex[0]=="052"){echo"selected";}?>>052</option>
							<option value="053" <?if($tel_ex[0]=="053"){echo"selected";}?>>053</option>
							<option value="054" <?if($tel_ex[0]=="054"){echo"selected";}?>>054</option>
							<option value="055" <?if($tel_ex[0]=="055"){echo"selected";}?>>055</option>
							<option value="061" <?if($tel_ex[0]=="061"){echo"selected";}?>>061</option>
							<option value="062" <?if($tel_ex[0]=="062"){echo"selected";}?>>062</option>
							<option value="063" <?if($tel_ex[0]=="063"){echo"selected";}?>>063</option>
							<option value="064" <?if($tel_ex[0]=="064"){echo"selected";}?>>064</option>
							<option value="0502" <?if($tel_ex[0]=="0502"){echo"selected";}?>>0502</option>
							<option value="0503" <?if($tel_ex[0]=="0503"){echo"selected";}?>>0503</option>
							<option value="0504" <?if($tel_ex[0]=="0504"){echo"selected";}?>>0504</option>
							<option value="0505" <?if($tel_ex[0]=="0505"){echo"selected";}?>>0505</option>
							<option value="0506" <?if($tel_ex[0]=="0506"){echo"selected";}?>>0506</option>
							<option value="0507" <?if($tel_ex[0]=="0507"){echo"selected";}?>>0507</option>
							<option value="070" <?if($tel_ex[0]=="070"){echo"selected";}?>>070</option>
							</select>
							-
							<input name="tel2" id="tel2" value='<?=$tel_ex[1]?>' type="text" class="input_03" size="10">
							-
							<input name="tel3" id="tel3" value='<?=$tel_ex[2]?>' type="text" class="input_03" size="10">
                              							
							</td>
						</tr>						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

						<tr>
							<td height="30" align="center">�޴���ȭ</td>
							<td><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td>
							<select name=mobile1>
							<option value="010" <?if($mobile_ex[0]=="010"){echo"selected";}?>>010</option>
							<option value="011" <?if($mobile_ex[0]=="011"){echo"selected";}?>>011</option>
							<option value="0130" <?if($mobile_ex[0]=="0130"){echo"selected";}?>>0130</option>
							<option value="016" <?if($mobile_ex[0]=="016"){echo"selected";}?>>016</option>
							<option value="017" <?if($mobile_ex[0]=="017"){echo"selected";}?>>017</option>
							<option value="018" <?if($mobile_ex[0]=="018"){echo"selected";}?>>018</option>
							<option value="019" <?if($mobile_ex[0]=="019"){echo"selected";}?>>019</option>
							</select>
							-
							<input name="mobile2" id="mobile2" value='<?=$mobile_ex[1]?>' type="text" class="input_03" size="10">
							-
							<input name="mobile3" id="mobile3" value='<?=$mobile_ex[2]?>' type="text" class="input_03" size="10">
                              							
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>

					</table>
					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center"><input type='image' onfocus='blur();' src="../image/helpdesk/bu_modify.gif" width="70" height="30" border="0"><a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" width="70" height="30" border="0"></a></td>
						</tr>
					</table>
					</form>
<!---------------------- �Խ��� �� ------------------------------------------------------>
<?
if( $bottom_body ){
	include "$bottom_body";
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

		if( $passwd_db != $passwd ){
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

	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;

	$SQL = "update $New_BoardTable set writer='$writer', email='$email', subject_new='$subject_new_tmp[0]', mobile='$mobile', tel='$tel', zip='$zip', address='$address', address_d='$address_d' where index_no ='$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=http://www.jsbusan.com/market/board_myaddr/board_read.php?mart_id=$mart_id&index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
}
?>
<?
mysql_close($dbconn);
?>