<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
//========================== URL 처리 ==========================================
$url=$REQUEST_URI;
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
		alert('미등록 쇼핑몰입니다.');
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
				alert('생성된 게시판이 없습니다');
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

if($board_class == 1){	
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			parent.location.href='../member/login.php?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;	
	}
}

//========================== 회원제 게시판일때 회원만 글쓰기 가능하게 함 =======
if( $board_class == 1 || $board_class == 3 ){
	if( $UnameSess ){ //로그인했을때 글쓰기 페이지 링크함
		$write_img = "<a href='board_write.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_write.gif' width='70' height='30' border='0'></a>";
	}else{
		$write_img = "<img src='../image/helpdesk/bu_write.gif' width='70' height='30' border='0' onclick=\"membercheck($bbs_no);\" style='cursor:hand'>";
	}
}else if( $board_class == 2 ){
	$write_img = "";
}else{
	$write_img = "<a href='board_write.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/bu_write.gif' width='70' height='30' border='0'></a>";
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
if (confirm("회원만 사용할 수 있는 메뉴입니다. 로그인하세요.")) return true;
return false;
}

//-->
</script>
<script>
function board_check(){
	var here = document.board_list

	if(here.input_key.value == ""){
		alert("검색어를 입력하세요")
		here.input_key.focus()
		return
	}

	here.submit()
}
function membercheck(num){
	var remessage = "회원만 글을 쓸 수 있습니다. 로그인 하시겠습니까?";

	if(confirm(remessage)){							
		location.href="../member/login.html?url=<?=$url?>";
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
<!---------------------- 게시판 시작 ---------------------------------------------------->
<?
if( $bbs_no == '3' ){
	if( !$code ){
		$code = "1";
	}
	switch( $code ){
		case "1" : 
			$code_str = "주문관련";
			$code_img1 = "_on";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "";
			break;
		case "2" : 
			$code_str = "결제관련";
			$code_img1 = "";
			$code_img2 = "_on";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "";
			break;
		case 3 : 
			$code_str = "배송/반품관련";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "_on";
			$code_img4 = "";
			$code_img5 = "";
			break;
		case 4 : 
			$code_str = "회원관련";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "_on";
			$code_img5 = "";
			break;
		case 5 : 
			$code_str = "기타질문";
			$code_img1 = "";
			$code_img2 = "";
			$code_img3 = "";
			$code_img4 = "";
			$code_img5 = "_on";
			break;
	}
?>
<!---------------------- FAQ 시작 ------------------------------------------------------->
<!---------------------- FAQ 메뉴 시작 -------------------------------------------------->
						<table width="96%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="50">&nbsp;</td>
								<td width="70"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=1"><img src="../image/helpdesk/faq_bu_01<?=$code_img1?>.gif" width="70" height="40" border="0"></a></td>
								<td width="70"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=2"><img src="../image/helpdesk/faq_bu_02<?=$code_img2?>.gif" width="70" height="40" border="0"></a></td>
								<td width="90"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=3"><img src="../image/helpdesk/faq_bu_03<?=$code_img3?>.gif" width="90" height="40" border="0"></a></td>
								<td width="70"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=4"><img src="../image/helpdesk/faq_bu_04<?=$code_img4?>.gif" width="70" height="40" border="0"></a></td>
								<td width="70"><a href="board_list.php?bbs_no=<?=$bbs_no?>&code=5"><img src="../image/helpdesk/faq_bu_05<?=$code_img5?>.gif" width="70" height="40" border="0"></a></td>
							</tr>
						</table>
<!---------------------- FAQ 메뉴 끝 ---------------------------------------------------->
						<table width="96%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
								<td width="100" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/faq_type1.gif" width="20" height="40"></td>
								<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
								<td align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/faq_quest.gif" width="60" height="40"></td>
								<td width="10"><img src="../image/helpdesk/table1_right.gif" width="10" height="40"></td>
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

	$SQL1 = "select count(*) from $New_BoardTable where bbs_no='$bbs_no' and code='$code' and mart_id='$mart_id' "; 
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

	$SQL1 = "select * from $New_BoardTable where bbs_no='$bbs_no' and code='$code' and mart_id='$mart_id' "; 
	$SQL2 = "and binary $keyset like '%$searchword%' ";
	$SQL2_1 = "and (binary writer like '%$searchword%' or binary subject_new like '%$searchword%' or binary content like '%$searchword%') ";
	$SQL3 = "order by ansno asc limit $skipNum, $cnfPagecount";

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
								<td colspan='2' align='center'><b>등록된 글이 없습니다</b></td>
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

		//========================= 이미지 태그내의 스크립트 방지 ================================
		$src = "/<img .*src=[a-z0-9\"']*script:[^>]+>/i";
		$des = "";
		$content = preg_replace($src, $des, $content);
		//========================================================================================
		
		$write_date_tmp = substr($write_date,0,8);
		$today_tmp = date("Ymd");

		if(strlen($subject_new) > 50){
			$subject_new = substr($subject_new, 0, 50);
			preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);
			$subject_new_tmp[0] .= '..';
			$subject_new = $subject_new_tmp[0];
		}

		//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ==============
		if( $user_id ){
			//========================= 관리자 아이콘이 있으면 아이콘을 작성자에 표시 ========
			$sql0 = "select admin_img from $MemberTable where username='$user_id'";
			$res0 = mysql_query( $sql0 , $dbconn );
			$row0 = mysql_fetch_array( $res0 );
			if( $row0[admin_img] ){
				$member_img = "<img src='../../up/$mart_id/$row0[admin_img]' border='0' align='absmiddle' height='20'>";
			}else{
				$member_img = $writer;
			}
			
			if( !$row0[admin_img] ){
				//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ======
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
	}
}else{
?>
						<table width='96%' align="center"  border='0' cellspacing='0' cellpadding='0'>
							<tr>
								<td width='10'><img src='../image/helpdesk/table1_left.gif' width='10' height='40'></td>
								<td width='60' align='center' background='../image/helpdesk/table1_bg.gif'><img src='../image/helpdesk/no.gif' width='20' height='40'></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/subject.gif' width='20' height='40'></font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td width='100' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/write.gif' width='30' height='40'></font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td width='100' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/date.gif' width='30' height='40'></font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td width='60' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/hit.gif' width='30' height='40'></font></td>
								<td width='10'><img src='../image/helpdesk/table1_right.gif' width='10' height='40'></td>
							</tr>
						</table>

						<table width='96%' align='center'  border='0' cellspacing='0' cellpadding='0'>		
<?
	if ($cnfPagecount == "") $cnfPagecount = $pagecount;
	if ($page == "") $page = 1;
	$skipNum = ($page - 1) * $cnfPagecount;

	$prev_page = $page - 1;
	$next_page = $page + 1;

	$SQL1 = "select count(*) from $New_BoardTable where bbs_no = '$bbs_no' and mart_id = '$mart_id' "; 
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

	$SQL1 = "select * from $New_BoardTable where bbs_no = '$bbs_no' and mart_id = '$mart_id' "; 
	$SQL2 = "and binary $keyset like '%$searchword%' ";
	$SQL2_1 = "and (binary writer like '%$searchword%' or binary subject_new like '%$searchword%' or binary content like '%$searchword%') ";
	$SQL3 = "order by ansno asc limit $skipNum, $cnfPagecount";

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
							<tr height='30'>
								<td colspan='5' align='center'><b>등록된 글이 없습니다</b></td>
							</tr>
							<tr>
								<td bgcolor='E1E1E1' height='1' colspan='5'></td>
							</tr>
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
		$writer = $row[writer];
		$user_id = $row[username];
		$write_date = $row[write_date];
		$read_num = $row[read_num];
		$subject_new = $row[subject_new];
		$step = $row[step];
		$if_secret = $row[if_secret];

		$write_date_tmp = substr($write_date,0,8);
		$today_tmp = date("Ymd");

		if(strlen($subject_new) > 50){
			$subject_new = substr($subject_new, 0, 50);
			preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);
			$subject_new_tmp[0] .= '..';
			$subject_new = $subject_new_tmp[0];
		}

		//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ==============
		if( $user_id ){
			//========================= 관리자 아이콘이 있으면 아이콘을 작성자에 표시 ========
			$sql0 = "select admin_img from $MemberTable where username='$user_id'";
			$res0 = mysql_query( $sql0 , $dbconn );
			$row0 = mysql_fetch_array( $res0 );
			if( $row0[admin_img] ){
				$member_img = "<img src='../../up/$mart_id/$row0[admin_img]' border='0' align='absmiddle' height='20'>";
			}else{
				$member_img = $writer;
			}
			
			if( !$row0[admin_img] ){
				//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ======
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
							<tr height='30' align='center'>
								<td width='70' class='point'><?=$k?></td>
								<td class='help' align='left'><?=$j_str?><a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?=$subject_new?></a> <?=$secret_str?><?=$new_string?></td>
								<td width='100'><?=$member_img?></td>
								<td width='100' class='point'><?=$write_date_str?></td>
								<td width='70' class='point'><?=$read_num?></td>
							</tr>
							<tr>
								<td bgcolor='E1E1E1' height='1' colspan='5'></td>
							</tr>
<?     				
	}
?>
						</table>
						<br>
<!---------------------- 검색 시작 ------------------------------------------------------>
						<table width='96%' align="center"  border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<form action='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>' method="post" onSubmit="board_check(); return false;">
							<input type="hidden" name="page" value="1">
							<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
								<td width='10'><img src='../image/helpdesk/table2_left.gif' width='10' height='40'></td>
								<td align='center' background='../image/helpdesk/table2_bg.gif'><img src='../image/helpdesk/search_type.gif' width='115' height='20' hspace='10' align='absmiddle'>
									<select name="keyset" class='input_03'>
										<option value="subject_new" selected>제목</option>
										<option value="content">내용</option>
										<option value="writer">작성자</option>
										<option value="all">전체</option>
									</select>					  
									<input type='text' name='searchword' value='<?=$searchword?>' class='input_03' size='15'>
									<input type='image' src='../image/bu_search3.gif' width='40' height='20' hspace='10' border='0' align='absmiddle' onfocus='blur();'> <a href='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>'><img src='../image/bu_cancel2.gif' border='0' align='absmiddle' onfocus='blur();'></a>

								</td>
								<td width='10'><img src='../image/helpdesk/table2_right.gif' width='10' height='40'></td>
							</form>
							</tr>
						</table>
<!---------------------- 검색 끝 -------------------------------------------------------->
<?
}
?>
<!---------------------- 페이징 시작 ---------------------------------------------------->
						<table width='100%'  border='0' cellspacing='0' cellpadding='0'>
							<tr height='50'>
								<td width='80%' align='center'>
<?
if($page == 1){
?>
									<img src='../image/helpdesk/arrow_1_big.gif' width='21' height='14' align='absmiddle' border='0'>
<?
}else{
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_1_big.gif' width='21' height='14' align='absmiddle' border='0'></a>
<?
}
?>
<?
if($start_page > 1){
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_1.gif' width='16' height='14' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_1.gif' width='16' height='14' align='absmiddle' border='0'>
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
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?=$i?></a>
<?
	}
}
?>
<?
if($end_page < $total_page){
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_2.gif' width='16' height='14' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_2.gif' width='16' height='14' align='absmiddle' border='0'>
<?
}
?>
<?
if($page == $total_page){
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src='../image/helpdesk/arrow_2_big.gif' width='21' height='14' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_2_big.gif' width='21' height='14' align='absmiddle' border='0'>
<?
}
?>
								</td>
								<td width='20%' align="right"><?=$write_img?></td>
							</tr>
						</table>
<!---------------------- 페이징 끝 ------------------------------------------------------>
<!---------------------- 게시판 끝 ------------------------------------------------------>
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