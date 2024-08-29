<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($bbs_no == "" || !isset($bbs_no)){
	$SQL = "select * from $New_BoardConfigTable where mart_id='$mart_id' order by bbs_order desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows == 0){
		echo ("
			<script language=\"javascript\">
				alert(\"생성된 게시판이 없습니다\");
				history.go(-1);
			</script>
		");
		exit;
	}
	for ($i=0; $i<$numRows; $i++) {
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$bbs_no_temp = $ary[bbs_no];
		$board_title_temp = $ary[board_title];
		$bbs_no = $bbs_no_temp;
		break;				
	}
}

$SQL = "select * from $New_BoardConfigTable where bbs_no = '$bbs_no' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0 ){
	mysql_data_seek($dbresult, 0);
	$ary = mysql_fetch_array($dbresult);
	$bbs_no = $ary[bbs_no];	
	$mart_id = $ary[mart_id];	
	$board_title = $ary[board_title];	
	$board_comment = $ary[board_comment];	
	$board_date = $ary[board_date];	
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

	include "../admin_head.php";
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

<body topmargin="0" leftmargin='0' bgcolor="#FFFFFF">
<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">

	<tr>
	 <td width="100%" align="center">
		
		<table border="0" width="98%">
			<tr>
				<td width="100%" height="20">
					<p align="center">
				<img src='../../market/images/board-icon.gif' align='absmiddle' WIDTH='25' HEIGHT='25'> <b><?=$board_title?></b>
			</td>
			</tr>
			<tr>
			<td width="100%" height="20"><br>
<?
$SQL = "select * from $New_BoardConfigTable where mart_id='$mart_id' order by bbs_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	$ary = mysql_fetch_array($dbresult);
	$bbs_no_temp = $ary[bbs_no];
	$board_title_temp = $ary[board_title];
	$board_type = $ary[board_type];
	
	if(!isset($bbs_no) || ($bbs_no == ""))
		$bbs_no = $bbs_no_temp;				
	if($bbs_no == $bbs_no_temp){
?>
				<img src='../../market/images/board-icon1.gif' align='absmiddle' WIDTH='12' HEIGHT='12'> <b><?=$board_title_temp?></b>&nbsp;
<?
	}else{
		if($board_type == ''){
?>
				<img src='../../market/images/board-icon1.gif' align='absmiddle' WIDTH='12' HEIGHT='12'> <a href='board_list.php?bbs_no=<?=$bbs_no_temp?>'> <?=$board_title_temp?></a>
<?
		}
		if($board_type == '1'){
?>
				<img src='../../market/images/board-icon1.gif' align='absmiddle' WIDTH='12' HEIGHT='12'> <a href='../car_board/board_list.php?bbs_no=<?=$bbs_no_temp?>'> <?=$board_title_temp?></a>
<?
		}
	}
}
?>	
			 </td>
			</tr>
			<tr>
			<td width="100%">
				<table cellSpacing="0" cellPadding="0" width="100%" border="0">
					<tr>
						<td width="100%">
							<table cellSpacing="0" cellPadding="0" width="100%" border="0">
							<tr height="1" bgcolor="#808080">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr bgColor="#4a494a" height="25" align="center">
								<td width='8%' bgcolor="<?=$item_bg_color?>"><font color='<?=$item_fg_color?>'>번호</font></td>
								<td width='60%' bgcolor="<?=$item_bg_color?>"><font color='<?=$item_fg_color?>'>제목</font></td>
								<td width='10%' bgcolor="<?=$item_bg_color?>"><font color='<?=$item_fg_color?>'>작성자</font></td>
								<td width='12%' bgcolor="<?=$item_bg_color?>"><font color='<?=$item_fg_color?>'>작성일</font></td>
								<td width='10%' bgcolor="<?=$item_bg_color?>"><font color='<?=$item_fg_color?>'>조회수</font></td>
							</tr>
							<tr height="1" bgcolor="#808080">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>						
<?
if ($cnfPagecount == "") $cnfPagecount = $pagecount;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$SQL1 = "select * from $New_BoardTable where bbs_no = '$bbs_no' and mart_id='$mart_id' "; 
$SQL2 = "and $keyset like '%$searchword%' ";
$SQL2_1 = "and (writer like '%$searchword%' or subject_new like '%$searchword%' or content like '%$searchword%') ";
$SQL3 = "order by ansno asc";

if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset != "all"))
	$SQL=$SQL1.$SQL2.$SQL3;
elseif(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset == "all"))
	$SQL=$SQL1.$SQL2_1.$SQL3;
else
	$SQL=$SQL1.$SQL3;

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

$total_page = ($numRows - 1) / $cnfPagecount;
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

for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$index_no = $ary[index_no];
	$bbs_no = $ary[bbs_no];
	$mart_id = $ary[mart_id];
	$code = $ary[code];
	$writer = $ary[writer];
	$user_id = $ary[username];
	$passwd = $ary[passwd];
	$write_date = $ary[write_date];
	$read_num = $ary[read_num];
	$msgno = $ary[msgno];
	$ansno = $ary[ansno];
	$step = $ary[step];
	$email = $ary[email];
	$subject_new = $ary[subject_new];
	$content = $ary[content];
	$if_secret = $ary[if_secret];
	$item_no = $ary[area];

	$write_date_tmp = strtotime($write_date);
	$today_tmp = time();

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
			$member_img = "<img src='../../up/$mart_id/$row0[admin_img]' width='40' border='0' align='absmiddle'>";
		}else{
			$member_img = $writer;
		}

		if( !$row0[admin_img] ){
			//========================= 회원 아이콘이 있으면 아이콘을 작성자에 표시 ======
			$sql1 = "select member_img from $Mart_Member_NewTable where username='$user_id'";
			$res1 = mysql_query( $sql1 , $dbconn );
			$row1 = mysql_fetch_array( $res1 );
			if( $row1[member_img] ){
				$member_img = "<img src='../../up/$mart_id/$row1[member_img]' width='40' border='0' align='absmiddle'>";
			}else{
				$member_img = $writer;
			} 
		}
	}else{
		$member_img = $writer;
	}
		
	$k = $numRows - $i;
	$write_date_str = substr($write_date,0,4)."/".substr($write_date,4,2)."/".substr($write_date,6,2);

	$j_str = "";
	for ($j=0; $j < $step; $j++){
		$j_str = $j_str."&nbsp;&nbsp;";
	}
	if($step > 0){
		$j_str = $j_str."<img src='../../market/images/re.gif'>";
	}
	if($if_use_secret == '1' && $if_secret == '1'){
		$secret_str = "<img src='../../market/images/key.gif'>";
	}else $secret_str = '';

	switch( $code ){
		case "1" : 
			$code_str = "[주문관련]";
			break;
		case "2" : 
			$code_str = "[결제관련]";
			break;
		case 3 : 
			$code_str = "[배송/반품관련]";
			break;
		case 4 : 
			$code_str = "[회원관련]";
			break;
		case 5 : 
			$code_str = "[기타질문]";
			break;
	}

	if( $bbs_no == "6" ){ //상품 Q&A 일때
		if( $item_no ){ //상품 정보가 있을때
			//================== 상품 정보를 불러옴 ======================================
			$item_sql = "select * from $ItemTable where mart_id='$mart_id' and item_no='$item_no'";
			$item_res = mysql_query($item_sql, $dbconn);
			$item_tot = mysql_num_rows($item_res);

			$item_row = mysql_fetch_array($item_res);

			$j_str .= "[<a href='$home_url/market/main/product_info.html?category_num=$item_row[category_num]&item_no=$item_no' target='_blank'>".$item_row[item_name]."</a>]";
		}
	}	
	
	if(($today_tmp - $write_date_tmp) < 86400&& !$step){
		$new_string = "<img src='../../admin/images/new.gif'>";
	}else{
		$new_string = "";
	}
?> 		
							<tr align='middle' height='22'>
								<td align='center'><?=$k?></td>
								<td align='left'><?=$j_str?> <?=$code_str?> <a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?=$subject_new?></a> <?=$new_string?> <?=$secret_str?></td>
								<td align='center'><?=$member_img?></td>
								<td align='center'><?=$write_date_str?></td>
								<td align='center'><?=$read_num?></td>
							</tr>
<?
	if(($i + 1) < ($cnfPagecount+$skipNum) && ($i + 1 < $numRows)){ 
?>
							<tr>
								<td bgColor='#eeeeee' colSpan='5' height='1'><img border='0' src='transparent.gif' width='1' height='1'></td>
							</tr>
<?
	}
}
?>
							<tr height="1" bgcolor="#808080">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
<?
	echo ("
						<tr>
								<td align='center' height='25' colspan='5' bgcolor='$item_bg_color'><p align='right'>
									<a href='board_write.php?bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'>
									<img src='../../market/images/write.gif' border='0' WIDTH='46' HEIGHT='15'></a>&nbsp;");	
							if($page > 1){
								echo ("<a href='board_list.php?bbs_no=$bbs_no&page=$prev_page&keyset=$keyset&searchword=$searchword'>
									<img src='../../market/images/pre.gif' border='0' WIDTH='48' HEIGHT='13'></a>&nbsp;
								");
							}
							else echo "<img src='../../market/images/pre.gif' border='0' WIDTH='48' HEIGHT='13'>&nbsp;";
							if($page < $total_page){
							echo ("
								<a href='board_list.php?bbs_no=$bbs_no&page=$next_page&keyset=$keyset&searchword=$searchword'>
									<img src='../../market/images/next.gif' border='0' WIDTH='46' HEIGHT='15'></a>
								");
							}
							else echo "<img src='../../market/images/next.gif' border='0' WIDTH='46' HEIGHT='15'>";		
							
							echo ("	
									&nbsp;&nbsp; 
								</td>
							</tr>
");
?>
							<tr height="1" bgcolor="#808080">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" height="10" width="100%"></td>
					</tr>
					<tr>
						<td align="right" height="3" width="100%">
							<p align="center">
							
					<?
					if($page == 1){
						echo ("
						처음
						");
					}
					else{
						echo ("
						<a href='board_list.php?bbs_no=$bbs_no&page=1&keyset=$keyset&searchword=$searchword'>처음</a> 
						");
					}
				
					if($start_page > 1){
						echo ("
						<a href='board_list.php?bbs_no=$bbs_no&page=$prev_start_page&keyset=$keyset&searchword=$searchword'>
						◁&nbsp; 
						</a>
						");
					}
					else{
						echo ("
						◁&nbsp; 
						");
					}
					for($i=$start_page;$i<=$end_page;$i++){
						if($i == $page){
							echo ("	
							[<b>$i</b>]
							");
						}
						else{
							echo ("
						<a href='board_list.php?bbs_no=$bbs_no&page=$i&keyset=$keyset&searchword=$searchword'>$i</a> 	
							");
						}
					}
					if($end_page < $total_page){
						echo ("
						<a href='board_list.php?bbs_no=$bbs_no&page=$next_start_page&keyset=$keyset&searchword=$searchword'>
						&nbsp;▷
						</a>
						");
					}
					else{
						echo ("
						&nbsp;▷
						");
					}
					if($page == $total_page){
						echo ("
						끝
						");
					}
					else{
						echo ("
						<a href='board_list.php?bbs_no=$bbs_no&page=$total_page&keyset=$keyset&searchword=$searchword'>끝</a> 
						");
					}
					?>
					
							</td>
					</tr>
					<tr>
						<td height="8" width="100%"></td>
					</tr>
					
					<form method="POST">
				<input type="hidden" name="page" value="1">
				<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
				<tr>
						<td height="1" width="100%">
							<p align="center">
							<select name="keyset" style="font-size: 9pt; background-color: rgb(255,255,255); padding-left: 0; padding-right: 0; padding-top: -1; padding-bottom: -1" size="1">
							<option value="writer">작성자</option>
							<option value="subject_new">제목</option>
							<option value="content">내용</option>
						<option value="all">전체</option>
						</select>&nbsp; 
							
							<input type='text' name='searchword' value='<?=$searchword?>' size="20" class="input_03"> 
							<b>
							<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="submit" value="찾기">&nbsp;
							</b>
						</td>
					</tr>
					</form>
				</table>
			</td>
			</tr>
		</table>
	 </td>
</tr>
</table>
</body>
</html>

</html>
<?
mysql_close($dbconn);
?>