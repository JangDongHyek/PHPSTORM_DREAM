<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//================== �Լ� ���� ������ �ҷ��� =============================================
include "../../main.class";
?>
<?
if($flag == ''){
	$SQL = "select * from $New_BoardConfigTable where bbs_no = '$bbs_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0 ){
		$ary = mysql_fetch_array($dbresult);
		$bbs_no = $ary[bbs_no];	
		$mart_id = $ary[mart_id];	
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
	}
	//===================== ��ȸ���� 1 ������ ======================================
	$SQL = "update $New_BoardTable set read_num = read_num +1 where index_no = $index_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";

	//===================== ��ȸ���� 1 ������ ============================================
	$SQL2 = "update $New_BoardTable set ansno=$ansno_tmp+1, step=$step_tmp, bbs_no='$to_bbs_no' 	where index_no = $index_no_tmp and mart_id='$mart_id'";
	$dbresult2 = mysql_query($SQL2, $dbconn);

	//===================== �Խ��� ������ �ҷ��� =========================================
	$SQL = "select * from $New_BoardTable where bbs_no='$bbs_no' and index_no = $index_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0 ){
		$ary = mysql_fetch_array($dbresult);
		$mart_id = $ary[mart_id];
		$code = $ary[code];
		$writer = $ary[writer];
		$user_id = $ary[username];
		$passwd = $ary[passwd];	
		$doc_type = $ary[doc_type];	
		$write_date = $ary[write_date];	
		$read_num = $ary[read_num];	
		$msgno = $ary[msgno];	
		$ansno = $ary[ansno];	
		$email = $ary[email];	
		$subject_new = $ary[subject_new];	
		$content = $ary[content];	
		$writer_ip = $ary[writer_ip];	
		$step = $ary[step];
		$userfile = $ary[userfile];
		$userfile1 = $ary[userfile1];
		$item_no = $ary[area];

		//========================= �̹��� �±׳��� ��ũ��Ʈ ���� ================================
		$src = "/<img .*src=[a-z0-9\"']*script:[^>]+>/i";
		$des = "";
		$content = preg_replace($src, $des, $content);
		//========================================================================================
		 
		$write_date_str = substr($write_date,0,4)."/".substr($write_date,4,2)."/".substr($write_date,6,2);

		//========================= ȸ�� �������� ������ �������� �ۼ��ڿ� ǥ�� ==========
		if( $user_id ){
			//========================= ������ �������� ������ �������� �ۼ��ڿ� ǥ�� ====
			$sql0 = "select admin_img from $MemberTable where username='$user_id'";
			$res0 = mysql_query( $sql0 , $dbconn );
			$row0 = mysql_fetch_array( $res0 );
			if( $row0[admin_img] ){
				$member_img = "<img src='../../up/$mart_id/$row0[admin_img]' border='0' align='absmiddle'>";
			}else{
				$member_img = $writer;
			}

			if( !$row0[admin_img] ){
				//========================= ȸ�� �������� ������ �������� �ۼ��ڿ� ǥ�� ==
				$sql1 = "select member_img from $Mart_Member_NewTable where username='$user_id'";
				$res1 = mysql_query( $sql1 , $dbconn );
				$row1 = mysql_fetch_array( $res1 );
				if( $row1[member_img] ){
					$member_img = "<img src='../../up/$mart_id/$row1[member_img]' border='0' align='absmiddle'>";
				}else{
					$member_img = $writer;
				} 
			}
		}else{
			$member_img = $writer;
		}
		//========================= �̸����� ������ �ۼ��ڿ� ��ũ�� ======================
		if( $email ){
			$member_img = "<a href='mailto:$email'>$member_img</a>";
		}

		//========================= ÷������ó�� =========================================
		//========================= �׸������� ������ ��� ===============================
		$upload = "../../up/$mart_id/"; //���ε� ���丮

		$target = "$upload"."$userfile";
		$target1 = "$upload"."$userfile1";
		//========================= userfile =============================================
		if( eregi("\.jpg", $userfile) || eregi("\.gif", $userfile) || eregi("\.JPG", $userfile) || eregi("\.GIF", $userfile) ){
			//==================== �̹��� ����� ���� ==================================
			$img_size = GetImageSize("$target"); 

			if( eregi("\.jpg", $userfile) || eregi("\.gif", $userfile) || eregi("\.JPG", $userfile) || eregi("\.GIF", $userfile) ){
				$img_width = $img_size[0]; //�̹����� ���̸� �� �� ���� 
				$img_height = $img_size[1]; //�̹����� ���̸� �� �� ����
			}

			//=============================== ����,���� ������ �°� �̹��� ���߱� ========
			if( $userfile ){
				list( $height_new, $width_new ) = img_size( "$target", "500", "1000");
			}

			$img_file = "<img src='$target' width='$width_new' height='$height_new' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file;
		}else if(eregi("\.swf", $userfile)){
			$img_file = "<embed src='$target' border='0'><br>".$img_file;
		}

		if( $userfile ){
			//========================== ���� ����� ���� ==============================
			$size = filesize($target);
			//========================== ���� ����� �̻ڰ� �ٹ� =======================
			$size = GetFileSize($size);
		}
		//========================= userfile1 ============================================
		if( eregi("\.jpg", $userfile1) || eregi("\.gif", $userfile1) || eregi("\.JPG", $userfile1) || eregi("\.GIF", $userfile1)){
			//==================== �̹��� ����� ���� ==================================
			$img_size1 = GetImageSize("$target1");

			if( eregi("\.jpg", $userfile1) || eregi("\.gif", $userfile1) || eregi("\.JPG", $userfile1) || eregi("\.GIF", $userfile1)){
				$img_width1 = $img_size1[0]; //�̹����� ���̸� �� �� ���� 
				$img_height1 = $img_size1[1]; //�̹����� ���̸� �� �� ����
			}

			//=============================== ����,���� ������ �°� �̹��� ���߱� ========
			if( $userfile1 ){
				list( $height_new1, $width_new1 ) = img_size( "$target1", "500", "1000");
			}

			$img_file1 = "<img src='$target1' width='$width_new1' height='$height_new1' border='0' hspace='5' style='border: #000000; border-style: solid; border-width:1px'><br>".$img_file1;
		}else if(eregi("\.swf", $userfile1)){
			$img_file1 = "<embed src='$target1' border='0'><br>".$img_file1;
		}

		if( $userfile1 ){
			$size1 = filesize($target1);
			$size1 = GetFileSize($size1);
		}
		//========================= ÷������ó�� =========================================

		if( $bbs_no == '3' ){
			switch( $code ){
				case "1" : 
					$code_str = "[�ֹ�����]";
					break;
				case "2" : 
					$code_str = "[��������]";
					break;
				case 3 : 
					$code_str = "[���/��ǰ����]";
					break;
				case 4 : 
					$code_str = "[ȸ������]";
					break;
				case 5 : 
					$code_str = "[��Ÿ����]";
					break;
			}
		}


		if( $bbs_no == "6" ){ //��ǰ Q&A �϶�
			if( $item_no ){ //��ǰ ������ ������
				//================== ��ǰ ������ �ҷ��� ======================================
				$item_sql = "select * from $ItemTable where mart_id='$mart_id' and item_no='$item_no'";
				$item_res = mysql_query($item_sql, $dbconn);
				$item_tot = mysql_num_rows($item_res);

				$item_row = mysql_fetch_array($item_res);

				if($step == 0){
					$j_str = "[Q] [".$item_row[item_name]."]";
				}else{
					$j_str = "[A] [".$item_row[item_name]."]";
				}
			}
		}
	}
?>
<?
	include "../admin_head.php";
?>
<script>
function really(mart_id,flag,index_no,bbs_no,page,keyset,searchword){

	if (window.confirm("������� ������ �����Ͻðڽ��ϱ�?"))
	  {
			location.href='board_read.php?mart_id='+mart_id+'&flag=del&index_no='+index_no+'&bbs_no='+bbs_no+'&page='+page+'&keyset='+keyset+'&searchword='+searchword;
	  }
	else
	  {
			
		location.href='board_read.php?mart_id='+mart_id+'&flag=&index_no='+index_no+'&bbs_no='+bbs_no+'&page='+page+'&keyset='+keyset+'&searchword='+searchword;
	}
}
function checkform(f){
	if (f.to_bbs_no.value == ''){
		alert("�̵��� �Խ����� �����ϼ���.");
		f.to_bbs_no.focus();
		return false;
	}
	if (f.from_bbs_no.value == f.to_bbs_no.value){
		alert("\n������ �Խ������� �̵��� �� �����ϴ�.\n\n�ٸ� �Խ����� �����ϼ���.");
		f.to_bbs_no.focus();
		return false;
	}
	return true;
}

</script>
</head>

<body topmargin="0" leftmargin='0' bgcolor="#FFFFFF">
<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">

	<tr>
	<td width="100%">
	
		<table cellSpacing="0" cellPadding="0" width="100%" border="0">
			<tr>
				<td width="100%" colspan="2">
					<table cellSpacing="0" cellPadding="5" width="100%" border="0">

					<tr bgColor="#4a494a">
						<td width="100%" height="25" bgcolor="#F6F6F6" colspan="2" align="center"><?=$j_str?> <?=$code_str?> <?=$subject_new?></td>
					</tr>
					<tr>
						<td width="100%" height="1" bgcolor="#808080" colspan="2"></td>
					</tr>
					<tr>
						<td bgColor="#F6F6F6" height="25" colspan="2">
							�ۼ��� : <?=$write_date_str?>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							�ۼ��� : <?=$member_img?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							��ȸ�� : <?=$read_num?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							IP : <?=$writer_ip?>
					</td>
					</tr>
<? 
if( $userfile ){ 
?>
				<tr>
					<td bgColor="#F6F6F6" height="25" colspan="2">÷������ : <a href='../../market/board/down.php?mart_id=<?=$mart_id?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&mode=file'><?=$userfile?></a> (<?=$size?>)&nbsp;
<? 
if( $userfile1 ){ 
?>
						<a href='../../market/board/down.php?mart_id=<?=$mart_id?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&mode=file1'><?=$userfile1?></a> (<?=$size1?>)
					</td>
				</tr>
<?
}
?>
<?
}
?>
					<tr>
						<td bgColor="#808080" height="1" colspan="2"></td>
					</tr>

<?
if( $img_file ){
?>
				<tr>
					<td bgColor="#FFFFFF" colspan="2"><a href='#1' onClick="window.open('big.html?file=<?=$userfile?>&mart_id=<?=$mart_id?>','������������','width=<?=$img_width?>,height=<?=$img_height?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file?></a></td>
				</tr>
<?
}
?>
<?
if( $img_file1 ){
?>
				<tr>
					<td bgColor="#FFFFFF" colspan="2"><a href='#1' onClick="window.open('big.html?file=<?=$userfile1?>&mart_id=<?=$mart_id?>','������������','width=<?=$img_width1?>,height=<?=$img_height1?>,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')" onFocus='blur();'><?=$img_file1?></a></td>
				</tr>
<?
}
?>
					<tr>
						<td bgColor="#FFFFFF" colspan="2" align="center">
							<table border="0" width="97%">
								<tr>
								<td width="100%">
								<?=$content?>
								</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgColor="#808080" height="1" colspan="2"></td>
					</tr>

<?
if( $comment_ok =="y" ){
$sql1 = "select * from board_comment where bbs_no = '$bbs_no' and mart_id = '$mart_id' and index_no = '$index_no'"; 
$dbresult1 = mysql_query($sql1, $dbconn);
$numRows1 = mysql_num_rows($dbresult1);

for($i=0; $i < $numRows1; $i++){
$ary1 = mysql_fetch_array($dbresult1);
$c_no = $ary1["c_no"];
$c_name = $ary1["c_name"];
$user_id = $ary1["user_id"];
$c_regdate = $ary1["c_regdate"];
$c_comment = $ary1["c_comment"];
$c_comment = stripslashes($c_comment);
$c_comment = htmlspecialchars($c_comment);	
$c_comment = nl2br($c_comment);
?>
					<tr>
						<td bgColor="#FFFFFF" colspan="2" align="center">
						<table width='100%' border='0' cellspacing='0' cellpadding='5'>
							<tr bgcolor='#e7e7e7'> 
								<td height='1' colspan='2'></td>
							</tr>
							<tr>
								<td width='80' valign='top'><?=$c_name?></td>
								<td valign='top'><?=$c_comment?>
									<a onfocus='blur()' href='./comment_del.php?c_no=<?=$c_no?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>' onclick="return confirm('���� ���� �Ͻðڽ��ϱ�?')">[����]</a><br>
									<font color='#999999'>[ <?=$c_regdate?> ]</font>
								</td>
							</tr>
						</table> 
						</td>
					</tr>
<?
}
?>


<SCRIPT LANGUAGE="JavaScript">
<!--
function form_comment_check(){
var f = document.form_comment;

if(f.cmt_name.value == ""){
alert("�̸��� �Է� ���ּ���!!");
f.cmt_name.focus();
return false;
}else if(f.cmt_password.value == ""){
alert("��й�ȣ �Է� ���ּ���!!");
f.cmt_password.focus();
return false;
}else if(f.cmt_comment.value == ""){
alert("������ �Է� ���ּ���!!");
f.cmt_comment.focus();
return false;
}else{
return true;
}
}
//-->
</SCRIPT>
<!-- �ڸ�Ʈ �� -->
<form name=form_comment method=post action='<?=$PHP_SELF?>' onsubmit="return form_comment_check()">
<input type="Hidden" name="flag" value="comment">
<input type="Hidden" name="mart_id" value="<?=$mart_id?>">
<input type="Hidden" name="bbs_no" value="<?=$bbs_no?>">
<input type="Hidden" name="index_no" value="<?=$index_no?>">
<input type="Hidden" name="page" value="<?=$page?>">
<input type="Hidden" name="keyset" value="<?=$keyset?>">
<input type="Hidden" name="searchword" value="<?=$searchword?>">
					<tr>
						<td bgColor="#FFFFFF" height="10" colspan="2"></td>
					</tr>
					<tr>
						<td bgColor="#808080" height="1" colspan="2"></td>
					</tr>
				<tr> 
					<td width='50%'>
						�̸� : <input type=text name=cmt_name class="input_03" size=10 maxlength=20 value='<?=$MemberName?>' <?=$writer_readonly?>>
					</td>
					<td width='50%'>
						��й�ȣ : <input type=password name=cmt_password class="input_03" size=15>
					</td>
				</tr>
				<tr>
					<td colspan='2'><textarea rows=4 name=cmt_comment style="width:80%;" class="input_03"></textarea>&nbsp;&nbsp;&nbsp;
					<input type="submit" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px' value='�� ��'></td>
				</tr>
					<tr>
						<td bgColor="#808080" height="1" colspan="2"></td>
					</tr>
				</form>
<?
}
?>
<?
$SQL = "select index_no from $New_BoardTable where bbs_no = $bbs_no and mart_id='$mart_id' and ansno > $ansno order by ansno";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "���� ���� ����!";
if(mysql_num_rows($dbresult)>=1)
$prevno = mysql_result($dbresult, 0,0);

$SQL = "select index_no from $New_BoardTable where bbs_no = $bbs_no and mart_id='$mart_id' and ansno < $ansno order by ansno desc";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "���� ���� ����!";
if(mysql_num_rows($dbresult)>=1)
$nextno = mysql_result($dbresult, 0,0);
				
	echo ("
					<tr>
						<td bgColor='#F6F6F6' height='25'>&nbsp; 
							<a href='board_list.php?bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>
							<img border='0' src='../../market/images/list.gif' width='46' height='15'></a>
							<a href='board_edit.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>
							<img border='0' src='../../market/images/mod.gif' width='50' height='15'></a>
	
<a onclick=really('$mart_id','del','$index_no','$bbs_no','$page','$keyset','$searchword')><img border='0' src='../../market/images/del.gif' width='49' height='15'></a>
");
if( $bbs_no != 3 ){
	echo ("
							<a href='board_reply.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img border='0' src='../../market/images/reply.gif' width='50' height='15'></a>
	");
}
	echo ("
						</td>
						<td bgColor='#F6F6F6' height='25'>
							<p align='right'>
					");		
					if(isset($prevno)&&$prevno!=""){
						echo ("
							<a href='board_read.php?bbs_no=$bbs_no&index_no=$prevno&page=$page&keyset=$keyset&searchword=$searchword'>
									<img border='0' src='../../market/images/pre.gif' width='48' height='13'></a>
						");
					}
					else echo "<img border='0' src='../../market/images/pre.gif' width='48' height='13'>";
					
					if(isset($nextno)&&$nextno!=""){
									echo ("
									<a href='board_read.php?bbs_no=$bbs_no&index_no=$nextno&page=$page&keyset=$keyset&searchword=$searchword'>
									<img border='0' src='../../market/images/next.gif' width='46' height='15'></a>
									");
								}
								else echo "<img border='0' src='../../market/images/next.gif' width='46' height='15'>";	
				
								echo ("	
						&nbsp;&nbsp; 
						</td>
					</tr>
					");
					?>
					<tr>
						<td bgColor="#808080" height="0" colspan="2"></td>
					</tr>
					<?
					if($step=='0'){
					?>

					  <tr>
						 <td align="middle" colSpan="2"><table border="0" width="100%">
							<tr>
							  <td width="100%" bgColor="#FFFFFF"><div align="center"><center><table border="3"
							  width="100%" bordercolor="#E0E0E0" cellspacing="0">
								 <tr>
									<td width="100%">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									
									<form action='board_read.php' method='post' onsubmit='return checkform(this)'>
									<input type='hidden' name='flag' value='move'>
									<input type='hidden' name='index_no' value='<?=$index_no?>'>
									<input type='hidden' name='from_bbs_no' value='<?=$bbs_no?>'>
									 
									<tr>
									<td width="100%" height="25" bgcolor="#6489C4" align="center" colspan="2"><p align="left"><strong>
									<font color="#FFFFFF">&nbsp; �Խù� �̵��ϱ�</font></strong></td>
									</tr>
									<tr>
									<td width="100%" bgcolor="#F1F1F1" height="1" colspan="2"></td>
									</tr>
									<tr>
									<td width="38%" bgcolor="#FFFFFF" height="60">&nbsp; 
									<img src="../images/bullet1.gif" align="absmiddle"> 
									������ġ : <strong><?=$board_title?></strong>&nbsp; </td>
									<td width="62%" bgcolor="#FFFFFF" height="60">
									<img src="../images/bullet4.gif"> �̵��� 
									�Խ��Ǽ��� 
									<select name="to_bbs_no" style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; height: 18px; BACKGROUND-COLOR: rgb(111,204,204)" size="1">
									<option selected value="">---�����ϼ���---</option>
									<?
											$SQL = "select * from $New_BoardConfigTable where mart_id='$mart_id' and board_type='' order by bbs_order desc";
													$dbresult = mysql_query($SQL, $dbconn);
													$numRows = mysql_num_rows($dbresult);
													for ($i=0; $i<$numRows; $i++) {
														mysql_data_seek($dbresult,$i);
														$ary = mysql_fetch_array($dbresult);
														$bbs_no = $ary["bbs_no"];
														$board_title = htmlspecialchars($ary["board_title"]);
														echo "
													<option value='$bbs_no'>$board_title</option>
														";
													}	
													?>
													</select> 
									<input type='image' src="../images/move.gif" width="37" height="18" align="absmiddle" border="0"></td>
									</tr>
									
									</form>
									
									</table>
									</td>
								 </tr>
							  </table>
							  </center></div></td>
							</tr>
						 </table>
						 </td>
					  </tr>
					  <tr>
						 <td align="middle" colSpan="2"><p align="left">&nbsp; <img
						 src="../images/tip.gif"> �Խù� �̵��� 
						 �亯���� �ִ� ��쿡�� �亯�۰� �Բ� �̵��˴ϴ�.</td>
					  </tr>
					  <?
						}
					  ?>
							</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</body>

</html>
<?
}
if($flag == 'del'){
	$sql1 = "select userfile, userfile1, thread from $New_BoardTable where index_no='$index_no' and mart_id = '$mart_id'";
	$dbresult = mysql_query($sql1, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	
	$row = mysql_fetch_array($dbresult);

	$username = $row[username];
	$userfile = $row[userfile];
	$userfile1 = $row[userfile1];
	$thread = $row[thread];

	//==================== ������ ������ ������ step �� 1�� ���� =========================
	/*$sql0 = "select * from $New_BoardTable where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$res0 = mysql_query( $sql0, $dbconn );
	$tot0 = mysql_num_rows( $res0 );
	if( $tot0 ){
		$sql1 = "update $New_BoardTable set step = step - 1 where thread='$thread' and mart_id = '$mart_id' and bbs_no='$bbs_no'";
		$res1 = mysql_query( $sql1, $dbconn );
		if( !$res1 ){
			echo "
			<script>
				window.alert('���� ������Ʈ�� �����߽��ϴ�.');
				history.go(-1);
			</script>
			";
			exit;
		}
	}*/

	$upload = "$UploadRoot$mart_id/";
	if( $userfile ){ //�ش��ȣ�� ������ �ִٸ� ������ ������
		$desc = "{$upload}{$userfile}";
		unlink($desc);
	}
	if( $userfile1 ){ //�ش��ȣ�� ������ �ִٸ� ������ ������
		$desc1 = "{$upload}{$userfile1}";
		unlink($desc1);
	}

	$SQL = "delete from $New_BoardTable where index_no='$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	//���� �ڸ�Ʈ ����
	$SQL = "delete from board_comment where index_no='$index_no' and bbs_no='$bbs_no' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=board_list.php?bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";	
	exit;
}
if($flag == 'move'){
	
	$SQL = "select ansno from $New_BoardTable where index_no='$index_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$ansno = mysql_result($dbresult,0,0);
	
	$SQL = "select * from $New_BoardTable where ansno < $ansno and bbs_no = '$from_bbs_no' and mart_id='$mart_id' order by ansno desc";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	$numRows = mysql_num_rows($dbresult);
	$count = 0;
	for ($i=0; $i < $numRows; $i++) {	
		mysql_data_seek($dbresult, $i);
		$ary = mysql_fetch_array($dbresult);
		$step = $ary["step"];
		$count = $i+1;
		if($step == '0') break;
	}

	$SQL = "select * from $New_BoardTable where ansno >= $ansno-$count and ansno <= $ansno and bbs_no = '$from_bbs_no' and mart_id='$mart_id' order by ansno asc";

	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	$numRows = mysql_num_rows($dbresult);
	for ($i=0; $i < $numRows; $i++) {	
		mysql_data_seek($dbresult, $i);
		$ary = mysql_fetch_array($dbresult);
		$index_no_tmp = $ary["index_no"];
		$step_tmp = $ary["step"];
		
		$SQL1 = "select ansno from $New_BoardTable where bbs_no = '$to_bbs_no' and mart_id='$mart_id' order by ansno desc";
		//echo "sql1=$SQL1<br><br>";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		if ($dbresult1 == false) echo "���� ���� ����!";
		$numRows1 = mysql_num_rows($dbresult1);
		if($numRows1>0)
			$ansno_tmp = mysql_result($dbresult1,0,0);
		else
			$ansno_tmp = 0;
	}
	echo "<meta http-equiv='refresh' content='0; URL=board_list.php?bbs_no=$from_bbs_no'>";	
	exit;
}
if ($flag == "comment") {
	if( !$cmt_name || !$cmt_password || !$cmt_comment){
		echo("
			<script>
			window.alert('�ʿ��� ���� �����ϴ�. �ٽ� �Է��� �ּ���!');
			history.go(-1)
			</script>
		");
		exit;
	}

	$cmt_reg_ip = $REMOTE_ADDR;
	$cmt_comment = addslashes($cmt_comment);

	$SQL = "insert into board_comment (c_no, index_no, bbs_no, mart_id, c_name, c_password, c_comment, c_reg_ip, c_regdate, user_id) values ('', '$index_no', '$bbs_no', '$mart_id', '$cmt_name', '$cmt_password', '$cmt_comment', '$cmt_reg_ip', now(), '$Mall_Admin_ID')";
	$dbresult = mysql_query($SQL, $dbconn);

	if( !$dbresult ){
		echo("
			<script>
			window.alert('�ٽ� �Է��� �ּ���!');
			history.go(-1)
			</script>
		");
		exit;
	}

	echo "<meta http-equiv='refresh' content='0; URL=board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>";
}
?>
<?
mysql_close($dbconn);
?>
