<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
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
if($bbs_no==5||$bbs_no==6){
	$bbs_deny_word="��Ŀ,����,����,��.��.��.��,��������,����,����,������,����,URL,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,���,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��,http,�����,������,.COM,JOA8888,�� �� ��,��`��`��,��.��.��,�� �� �� ��,�ε���,ī����,ī �� ��,co.kr,.com,joa,JOA,j o a,J O A";

}
if($bbs_no == 7 && !$_SESSION["Mall_Admin_ID"])
{
	echo ("		
	<script>
		alert('�����ڸ� ���� ���Ǽ� �ֽ��ϴ�.');
		history.go(-1);
	</script>
	");
	exit;
}

if( $board_class == 1 || $board_class == 3 ){
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1 && !$_SESSION["Mall_Admin_ID"]){
		echo ("		
			<script>
			window.alert('ȸ������ �����Դϴ�.');
			parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;
	}
}

if($board_class == 2 && !$_SESSION["Mall_Admin_ID"]){
	echo ("		
	<script>
		alert('�����ڸ� ���� ���Ǽ� �ֽ��ϴ�.');
		history.go(-1);
	</script>
	");
	exit;
}

include( '../include/getmartinfo.php' );
if(isset($flag)==false || $flag != "write"){
	include('../include/head_alltemplate.php');
?>
<script language="javascript">
<!--
/*function goTo(){
	var f=document.boardchange;
	f.action="board.php";
	f.submit();
}*/
//-->
</script>
<script>
/*var blnBodyLoaded = false;
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
	var mikExp = /[$\\@\\\#%\^\&\*\(\)\[\]\+\_\{\}\`\~\=\|\��]/;

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
	var obj_Title_arr=document.getElementById("subject_new").value.split(",");
	var obj_Content_arr=f.content.value.split(",");
	var obj_DenyArr=obj_Deny.split(",");
	var obj_titles="";
	var obj_conetents="";
	for(var j=0;j<obj_Title_arr.length;j++){
			obj_titles+=obj_Title_arr[j];
	}
	for(var k=0;k<obj_Content_arr.length;k++){
		obj_conetents+=obj_Content_arr[k];
	}
	var obj_Title=obj_titles;
	var obj_Content=obj_conetents;
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
	var rg_spam1=document.getElementById("rg_spam1").value;
		if(rg_spam1){
			var rg_spam2=document.getElementById("rg_spam2").value;
			if(rg_spam1!=rg_spam2){
				alert("���Թ��� ��ȣ�� ���� �ʽ��ϴ�.");
				return false;
			}
		}
		if(obj_Title.search(mikExp) == -1) {
			
		}
		else {
			alert("���� Ư�����ڰ� �Է� �Ǿ����ϴ�. Ư�����ڸ� ������ �� �ٽ� �Է��Ͻñ� �ٶ��ϴ�.");
			document.getElementById("rg_title").focus();
			return false;
		}
		if(obj_Content.search(mikExp) == -1) {
			
		}
		else {
			alert("���뿡 Ư�����ڰ� �Է� �Ǿ����ϴ�. Ư�����ڸ� ������ �� �ٽ� �Է��Ͻñ� �ٶ��ϴ�.");		
			return false;
		}
	f.submit();	
}
</script>
<script event="onscriptletevent(name, eventData)" for=editBox>
/*if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}*/
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
					<form method="POST" name='writeform' enctype="multipart/form-data" onsubmit='board_checkform(); return false' action="https://www.jsbusan.com:8026/market/board_myaddr/board_write.php"> 
					<input type="hidden" name="flag" value="write">
					<input type="hidden" name="mart_id" value="<?=$mart_id?>">
					<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
					<input type="hidden" name="item_no" value="<?=$item_no?>">
					<input type="hidden" name="return" value="<?=$return?>">
					<input type="hidden" name="bbs_deny_word" value="<?=$bbs_deny_word?>">
					<input type="hidden" name="content" value="..">
					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
							<td width="60" align="center" background="../image/helpdesk/table1_bg.gif">������̸�</td>
							<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
							<td background="../image/helpdesk/table1_bg.gif"> &nbsp;&nbsp;<input name="subject_new" type="text" size="20" style='ime-mode:active' class="input_03" id="subject_new"></td>
							<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
						</tr>
					</table>

					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="70" height="30" align="center">������</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input type="text" class="input_03" size="20" name="writer" value='<?=$MemberName?>' id="writer" style='ime-mode:active'>
<?
if( $board_class != 0 && $if_use_secret == '1'){
?>
										<input type='checkbox' name='if_secret' value='1'>��ݻ��
<?
}
?>							
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
							<td width="70" height="30" align="center">������ּ�</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><input name="zip" id="zip" value='<?=$zip?>' type="text" class="input_03" size="10">
                              <img src="../images/login_page_btn2.gif" align="absmiddle" style="cursor:hand" onClick="daumPostcode();">
<br>
<input type="text" name="address" id="address" value='<?=$address?>' class="input_03" size="70" style='ime-mode:active'>
                            <br>
                              <input type="text" name="address_d" id="address_d" value='<?=$address_d?>' class="input_03" size="70" style='ime-mode:active'>
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td width="70" height="30" align="center">�Ϲ���ȭ</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><select name=tel1>
								<option value="02">02</option>
								<option value="031">031</option>
								<option value="032">032</option>
								<option value="033">033</option>
								<option value="041">041</option>
								<option value="042">042</option>
								<option value="043">043</option>
								<option value="044">044</option>
								<option value="051">051</option>
								<option value="052">052</option>
								<option value="053">053</option>
								<option value="054">054</option>
								<option value="055">055</option>
								<option value="061">061</option>
								<option value="062">062</option>
								<option value="063">063</option>
								<option value="064">064</option>
								<option value="0502">0502</option>
								<option value="0503">0503</option>
								<option value="0504">0504</option>
								<option value="0505">0505</option>
								<option value="0506">0506</option>
								<option value="0507">0507</option>
								<option value="070">070</option>
								</select>
							-
							<input name="tel2" id="tel2" value='<?=$tel2?>' type="text" class="input_03" size="10">
							-
							<input name="tel3" id="tel3" value='<?=$tel3?>' type="text" class="input_03" size="10">
                              
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						<tr>
							<td width="70" height="30" align="center">�޴���ȭ</td>
							<td width="1"><img src="../image/helpdesk/view_line.gif" width="1" height="30"></td>
							<td width="10"></td>
							<td><select name=mobile1>
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="0130">0130</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>
							</select>
							-
							<input name="mobile2" id="mobile2" value='<?=$mobile2?>' type="text" class="input_03" size="10">
							-
							<input name="mobile3" id="mobile3" value='<?=$mobile3?>' type="text" class="input_03" size="10">
                              
							</td>
						</tr>
						<tr>
							<td bgcolor="E1E1E1" height="1" colspan="4"></td>
						</tr>
						
					</table>
					<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center"><input type='image' onfocus='blur();' src="../image/helpdesk/bu_write.gif" width="70" height="30" border="0" style='width:70;height:30;'><a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" width="70" height="30" border="0"></a></td>
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
	if($board_class == 1){
	}
}
elseif ($flag == "write") {
	


#######################�����ܾ��ñ���################################	
	if(!$subject_new){
		$error_msg = '������ �Է����ּ���';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;		
	}
	if(!$content){
		$error_msg = '������ �Է����ּ���';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;		
	}

	if($tmp = rg_str_inword("hello,example,Arizona,family,purpose,doctrine,applied,very,broadly,holds,parents,liable,even,for,the,negligence,of,child,driving,motor,vehicle,in,defiance,of,driving,restrictions,pla,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,���,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��",$subject_new)) {
		$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}

	if($tmp = rg_str_inword("hello,example,Arizona,family,purpose,doctrine,applied,very,broadly,holds,parents,liable,even,for,the,negligence,of,child,driving,motor,vehicle,in,defiance,of,driving,restrictions,pla,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,���,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��",$content)) {
		$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}
#######################################################################




	//=================== LOCK�� �Ǵ� ========================================================
	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	//=================== ������ ã�� ========================================================
	$query2 = "select MAX(thread) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$result2 = mysql_query( $query2, $dbconn );
	$row2 = mysql_fetch_array( $result2 );
	$thread = $row2[0] + 1;

	//=================== ������ ã�� ========================================================
	$query3 = "select MIN(ansno) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'" ;
	$result3 = mysql_query( $query3, $dbconn );
	$row3 = mysql_fetch_array( $result3 );
	$ansno = $row3[0] + 1;

	//=================== ���������� �۵��� AnsNo �� 1�� ������Ŵ ========================
	$query4 = "update $New_BoardTable set ansno = ansno + 1 where (ansno > 0) and mart_id = '$mart_id' and bbs_no='$bbs_no'";
	mysql_query( $query4, $dbconn );

	//============= �ְ� index_no ���� ã�Ƽ� 1�� �����ְ� �� uid ���� insert ������ =========
	$query6 = "select MAX(index_no) from $New_BoardTable where mart_id = '$mart_id'";
	$result6 = mysql_query( $query6, $dbconn );
	$row6 = mysql_fetch_array( $result6 );
	$index_no = $row6[0] + 1;
	
	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	//�ѱ��ڸ���
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	$write_date = date("Ymd H:i:s");

	//================== ���ε� �Լ� �ҷ��� ==================================================
	include "../upload.php";
	$upload_dir = "$UploadRoot$mart_id/";
	// ���͸�ũ �������
	$watermark_path = $upload_dir."__watermark.png";		
	//================== ÷�� ������ ���ε��� ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$upload_dir", $userfile, $userfile_name );
		//echo "$upload_dir". $userfile_name;

		// ���͸�ŷ
		$arr_result = waterMarkImage("$upload_dir".$file, $watermark_path, 50, 100);
		/*if(!$arr_result["bool"])
		{
			echo $arr_result["error"];
			exit;
		}*/		
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$upload_dir", $userfile1, $userfile1_name );

		// ���͸�ŷ
		$arr_result = waterMarkImage("$upload_dir".$file1, $watermark_path, 50, 100);
	}
	
	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;

	$SQL = "insert into $New_BoardTable (index_no, bbs_no, mart_id, username, writer, passwd, write_date, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret, writer_ip, area, zip, address, address_d, mobile,tel) values ('$index_no', $bbs_no, '$mart_id', '$UnameSess', '$writer', '$passwd', '$write_date', '1', '0', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$REMOTE_ADDR', '$item_no', '$zip', '$address', '$address_d', '$mobile', '$tel')";
	$dbresult = mysql_query($SQL, $dbconn);
	if( !$dbresult ){
		echo "
			<script>
				window.alert('�� �ۼ��� �����߽��ϴ�');
				history.go(-1);
			</script>
		";
		exit;
	}
	//=================== LOCK�� Ǭ�� ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	if( $return == "product" ){
		echo "
			<script>
				window.alert('���� �ۼ��߽��ϴ�');
				window.close();
				window.opener.location.reload();
			</script>
		";
		exit;
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=http://www.jsbusan.com/market/board_myaddr/board_list.php?mart_id=$mart_id&bbs_no=$bbs_no'>";
	}
}
?>
<?
mysql_close($dbconn);
?>
