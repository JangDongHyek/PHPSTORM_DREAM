<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?
//========================== URL ó�� ==========================================
$url="../main/product_info.html?mart_id=$mart_id&category_num=$category_num&flag=&item_no=$item_no&page=$page&mode=$mode";
//$url=$REQUEST_URI;
//$url=urlencode($url);

$url = str_replace( "?", "|", $url );
$url = str_replace( "&", "!", $url );
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

if($bbs_no == "" || !isset($bbs_no)){
	$SQL = "select bbs_no,board_title from $New_BoardConfigTable where mart_id='$mart_id' order by bbs_order desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows == 0){
		echo ("
			<script language='javascript'>
				alert('������ �Խ����� �����ϴ�');
				history.go(-1);
			</script>
		");
		exit;
	}
	for($i=0; $i<$numRows; $i++){
		$bbs_no_temp = mysql_result($dbresult,$i,0);
		$board_title_temp = mysql_result($dbresult,$i,1);
		$bbs_no = $bbs_no_temp;
		break;				
	}
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
$list_type = $ary[list_type];	

if($board_class == 1){	
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

//========================== ȸ���� �Խ����϶� ȸ���� �۾��� �����ϰ� �� =======
if( $board_class == 1 || $board_class == 3 ){
	if( $UnameSess ){ //�α��������� �۾��� ������ ��ũ��
		$write_img = "<a href='board_write.php?item_no=$item_no&mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_write.gif' border='0'></a>";
	}else{
		$write_img = "<img src='../image/helpdesk/bu_write.gif' border='0' onclick=\"membercheck();\" style='cursor:hand'>";
	}
}else if( $board_class == 2 ){
	if($Mall_Admin_ID&&$MemberLevel==1){ 
		$write_img = "<a href='board_write.php?item_no=$item_no&mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_write.gif' border='0'></a>";
	}

}else{
	$write_img = "<a href='board_write.php?item_no=$item_no&mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_write.gif' border='0'></a>";
}

include( '../include/getmartinfo.php' );
include('../include/head_alltemplate.php');
?>
<script language="javascript">
<!--
function goTo(){
	var f=document.boardchange;
	f.action="board_list.php";
	f.submit();
}

function member(){
if (confirm("ȸ���� ����� �� �ִ� �޴��Դϴ�. �α����ϼ���.")) return true;
return false;
}

//-->
</script>
<script>
function board_check(){
	var here = document.board_list

	if(here.input_key.value == ""){
		alert("�˻�� �Է��ϼ���")
		here.input_key.focus()
		return
	}

	here.submit()
}
function membercheck(){
	var remessage = "ȸ���� ���� �� �� �ֽ��ϴ�. �α��� �Ͻðڽ��ϱ�?";

	var Item_No = parent.document.all["item_no"].value;

	if(confirm(remessage)){							
		parent.location.href="../member/login.html?url=<?=$url?>&item_no="+Item_No;
	}
}
</script>
<body>

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
if( $bbs_no == '3' ){
	if( !$code ){
		$code = "1";
	}
	switch( $code ){
		case "1" : 
			$code_str = "�ֹ�/��������";
			$code_img1 = "_on";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "";
			$code_img6 = "";
			break;
		case "2" : 
			$code_str = "��۰���";
			$code_img1 = "";
			$code_img2 = "_on";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "";
			$code_img6 = "";
			break;
		case 3 : 
			$code_str = "��ȯ/��ǰ/���";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "_on";
			$code_img4 = "";
			$code_img5 = "";
			$code_img6 = "";
			break;
		case 4 : 
			$code_str = "ȸ�����/������";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "_on";
			$code_img5 = "";
			$code_img6 = "";
			break;
		case 5 : 
			$code_str = "ȸ������";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "_on";
			$code_img6 = "";
			break;
		case 6 : 
			$code_str = "����뿡���� ����";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "";
			$code_img6 = "_on";
			break;
			
	}
?>
<!---------------------- FAQ ���� ------------------------------------------------------->
<!---------------------- FAQ �޴� ���� -------------------------------------------------->
						<table width="96%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="50">&nbsp;</td>
								<td width="99"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=1"><img src="../image/helpdesk/faq_bu_01<?=$code_img1?>.gif" border="0"></a></td>
								<td width="66"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=2"><img src="../image/helpdesk/faq_bu_02<?=$code_img2?>.gif" border="0"></a></td>
								<td width="108"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=3"><img src="../image/helpdesk/faq_bu_03<?=$code_img3?>.gif" border="0"></a></td>
								<td width="125"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=4"><img src="../image/helpdesk/faq_bu_04<?=$code_img4?>.gif" border="0"></a></td>
								<td width="69"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=5"><img src="../image/helpdesk/faq_bu_05<?=$code_img5?>.gif" border="0"></a></td>
							    <td width="115"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=6"><img src="../image/helpdesk/faq_bu_06<?=$code_img6?>.gif" border="0"></a></td>
							</tr>
						</table>
<!---------------------- FAQ �޴� �� ---------------------------------------------------->
						<table width="96%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10"><img src="../image/helpdesk/table1_left.gif"></td>
								<td width="100" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/faq_type1.gif"></td>
								<td width="1"><img src="../image/helpdesk/table1_line.gif"></td>
								<td align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/faq_quest.gif"></td>
								<td width="10"><img src="../image/helpdesk/table1_right.gif"></td>
							</tr>
						</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
function span_sw( str ) {
	if (str.style.display == "none") 
	str.style.display = ""; // Show
	else
	str.style.display = "none"; // Hidden
}
//-->
</SCRIPT>
<?
	if ($cnfPagecount == "") $cnfPagecount = $pagecount;
	if ($page == "") $page = 1;
	$skipNum = ($page - 1) * $cnfPagecount;

	$prev_page = $page - 1;
	$next_page = $page + 1;


	//if($bbs_no == 8){
	//	$open_chk_query = " and open_chk = 'y' ";
	//}



	$SQL1 = "select count(*) from $New_BoardTable where area='$item_no' and bbs_no='$bbs_no' $open_chk_query and code='$code' and mart_id='$mart_id' "; 
	$SQL2 = "and binary $keyset like '%$searchword%' ";
	$SQL2_1 = "and (binary writer like '%$searchword%' or binary subject_new like '%$searchword%' or binary content like '%$searchword%') ";
	$SQL3 = "";

	if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset != "all"))
		$SQL=$SQL1.$SQL2.$SQL3;
	elseif(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset == "all"))
		$SQL=$SQL1.$SQL2_1.$SQL3;
	else
		$SQL=$SQL1.$SQL3;

	$dbresult = mysql_query($SQL, $dbconn);
	$numRows_tot = mysql_result($dbresult,0,0);

	$SQL1 = "select * from $New_BoardTable where area='$item_no' and bbs_no='$bbs_no' $open_chk_query and code='$code' and mart_id='$mart_id' "; 
	$SQL2 = "and binary $keyset like '%$searchword%' ";
	$SQL2_1 = "and (binary writer like '%$searchword%' or binary subject_new like '%$searchword%' or binary content like '%$searchword%') ";
	$SQL3 = "order by ansno desc limit $skipNum, $cnfPagecount";


	if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset != "all")){
		$SQL=$SQL1.$SQL2.$SQL3;
	}elseif(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset == "all")){
		$SQL=$SQL1.$SQL2_1.$SQL3;
	}else{
		$SQL=$SQL1.$SQL3;
	}

	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
?>
<?
	if( $numRows == "0" ){
?>
						<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
							<tr height='30'>
								<td colspan='2' align='center'><b>��ϵ� ���� �����ϴ�</b></td>
							</tr>
							<tr>
								<td bgcolor="E1E1E1" height="1" colspan="2"></td>
							</tr>
						</table>
<?
	}
?>
<?
	$total_page = ($numRows_tot - 1) / $cnfPagecount;
	$total_page = intval($total_page)+1;

	if($page % 10 == 0)
	$start_page = $page - 9;
	else
	$start_page = $page - ($page % 10) + 1;

	$end_page = $start_page + 9;
	if($end_page >= $total_page)
		$end_page = $total_page;
	$prev_start_page = $start_page - 10;
	$next_start_page = $start_page + 10;

	for ($i=0; $i < $numRows; $i++){
		$row = mysql_fetch_array( $dbresult );

		$index_no = $row[index_no];
		$code = $row[code];
		$writer = $row[writer];
		$user_id = $row[username];
		$write_date = $row[write_date];
		$read_num = $row[read_num];
		$subject_new = $row[subject_new];
		$step = $row[step];
		$if_secret = $row[if_secret];

		$content = $row[content];

		//========================= �̹��� �±׳��� ��ũ��Ʈ ���� ================================
		$src = "/<img .*src=[a-z0-9\"']*script:[^>]+>/i";
		$des = "";
		$content = preg_replace($src, $des, $content);
		//========================================================================================
		
		$write_date_tmp = substr($write_date,0,8);
		$today_tmp = date("Ymd");

		if(strlen($subject_new) > 80){
			$subject_new = substr($subject_new, 0, 80);
			preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);
			$subject_new_tmp[0] .= '..';
			$subject_new = $subject_new_tmp[0];
		}

		//========================= ȸ�� �������� ������ �������� �ۼ��ڿ� ǥ�� ==============
		if( $user_id ){
			//========================= ������ �������� ������ �������� �ۼ��ڿ� ǥ�� ========
			$sql0 = "select admin_img from $MemberTable where username='$user_id'";
			$res0 = mysql_query( $sql0 , $dbconn );
			$row0 = mysql_fetch_array( $res0 );
			if( $row0[admin_img] ){
				$member_img = "<img src='../../up/$mart_id/$row0[admin_img]' border='0' align='absmiddle' height='20'>";
			}else{
				$member_img = $writer;
			}
			
			if( !$row0[admin_img] ){
				//========================= ȸ�� �������� ������ �������� �ۼ��ڿ� ǥ�� ======
				$sql1 = "select member_img from $Mart_Member_NewTable where username='$user_id'";
				$res1 = mysql_query( $sql1 , $dbconn );
				$row1 = mysql_fetch_array( $res1 );
				if( $row1[member_img] ){
					$member_img = "<img src='../../up/$mart_id/$row1[member_img]' border='0' align='absmiddle' height='20'>";
				}else{
					$member_img = $writer;
				} 
			}
		}else{
			$member_img = $writer;
		}

		if($mart_id == 'pdazzle' && $bbs_no == '1'){
			$new_string = "";
		}else{
			if($write_date_tmp == $today_tmp){
				$new_string = "<img src='../../admin/images/new.gif'>";
			}else{
				$new_string = "";
			}
		}

		$k = $numRows_tot - $skipNum - $i;
		$write_date_str = substr($write_date,0,4)."/".substr($write_date,4,2)."/".substr($write_date,6,2);
		
		$j_str = "";
		for ($j=0; $j < $step; $j++) {
			$j_str = $j_str."&nbsp;";
		}
		if($step > 0){
			$j_str = $j_str."<img src='../images/re.gif'  align='absmiddle'>";
		}
		if($if_use_secret == '1' && $if_secret == '1'){
			$secret_str = "<img src='../images/key.gif'>";
		}else{
			$secret_str = '';
		}
?>
<!---------------------- FAQ ���� ���� -------------------------------------------------->
						<table width="96%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="110" height="30" align="center" class="point"><?=$code_str?></td>
								<td width="630" class="help"><A HREF="javascript:span_sw( show<?=$k?> );"><?=$subject_new?></a></td>
							</tr>
							<tr>
								<td bgcolor="E1E1E1" height="1" colspan="2"></td>
							</tr>
						</table>
<!---------------------- FAQ ���� �� ---------------------------------------------------->
<!---------------------- FAQ �亯 ���� -------------------------------------------------->
						<span id='show<?=$k?>' style="display: none;">
						<table width="96%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td><img src="../image/helpdesk/view_table_top.gif" width="680" height="10"></td>
							</tr>
							<tr>
								<td background="../image/helpdesk/view_table_bg.gif">
									<table width="100%"  border="0" cellspacing="0" cellpadding="10">
										<tr>
											<td><?=nl2br($content)?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td><img src="../image/helpdesk/view_table_bottom.gif" width="680" height="10"></td>
							</tr>
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td bgcolor="E1E1E1" height="1" ></td>
							</tr>
						</table>
						</span>
<?     				
	}
?>
<!---------------------- FAQ �亯 �� ---------------------------------------------------->
<!---------------------- FAQ �� --------------------------------------------------------->
<?
}else{
?>
<?
	// ����Ʈ ��Ų �ҷ�����
	if($list_type == "NL")
		//if($bbs_no == 8){
		//	include "board_list_skin_event.php";
		//}else{
			include "board_list_skin.php";
		//}


	elseif($list_type == "GT")
		include "gallery_thumbnail_skin.php";
	elseif($list_type == "GL")
		include "gallery_thumbnail_skin.php";
?>
						<br>
<!---------------------- �˻� ���� ------------------------------------------------------>
						<table width='96%' align="center"  border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<form action='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>' method="post" onSubmit="board_check(); return false;">
							<input type="hidden" name="page" value="1">
							<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
							<input type="hidden" name="item_no" value="<?=$item_no?>">
								<td width='10'><img src='../image/helpdesk/table2_left.gif' width='10' height='40'></td>
							  <td align='center' background='../image/helpdesk/table2_bg.gif'><img src='../image/helpdesk/search_type.gif' hspace='10' align='absmiddle'>
									<select name="keyset" class='input_03'>
					          <option value="subject_new" selected>����</option>
										<option value="content">����</option>
										<option value="writer">�ۼ���</option>
										<option value="all">��ü</option>
									</select>					  
									<input type='text' name='searchword' value='<?=$searchword?>' class='input_03' size='15'>
									<input type='image' src='../image/bu_search3.gif' border='0' align='absmiddle' onfocus='blur();'>&nbsp;<a href='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>'><img src='../image/bu_cancel2.gif' border='0' align="absmiddle" onfocus='blur();'></a>								</td>
								<td width='10'><img src='../image/helpdesk/table2_right.gif' width='10' height='40'></td>
							</form>
							</tr>
						</table>
<!---------------------- �˻� �� -------------------------------------------------------->
<?
}
?>
<!---------------------- ����¡ ���� ---------------------------------------------------->
						<table width='98%'  border='0' cellspacing='0' cellpadding='0'>
							<tr height='50'>
								<td width='80%' align='center'>
<?
if($page == 1){
?>
									<img src='../image/helpdesk/arrow_1_big.gif' align='absmiddle' border='0'>
<?
}else{
?>
									<a href='board_list.php?item_no=<?=$item_no?>&bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_1_big.gif' align='absmiddle' border='0'></a>
<?
}
?>
<?
if($start_page > 1){
?>
									<a href='board_list.php?item_no=<?=$item_no?>&bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_1.gif' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_1.gif' align='absmiddle' border='0'>
<?
}
?>
<?
for($i=$start_page;$i<=$end_page;$i++){
	if($i == $page){
?>
									<b>[<?=$i?>]</b>
<?
	}else{
?>
									<a href='board_list.php?item_no=<?=$item_no?>&bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?=$i?></a>
<?
	}
}
?>
<?
if($end_page < $total_page){
?>
									<a href='board_list.php?item_no=<?=$item_no?>&bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_2.gif' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_2.gif' align='absmiddle' border='0'>
<?
}
?>
<?
if($page < $total_page){
?>
									<a href='board_list.php?item_no=<?=$item_no?>&bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_2_big.gif' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_2_big.gif' align='absmiddle' border='0'>
<?
}
?>
								</td>
								<td width='20%' align="right"><?=$write_img?></td>
							</tr>
</table>
<!---------------------- ����¡ �� ------------------------------------------------------>
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
mysql_close($dbconn);
?>