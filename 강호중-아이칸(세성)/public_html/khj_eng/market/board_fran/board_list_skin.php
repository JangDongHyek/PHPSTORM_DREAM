<script language="javascript">
							function ListSel(){
								var frm=document.frmList;
								var chk=document.getElementsByName("index_no[]");
								var chk_su="";
								if(!chk.length){
									chk_su=1;
								}else{
									chk_su=chk.length;
								}
								
								for(var i=0;i<chk_su;i++)
								{
									if(chk_su==1){
										chk[0].checked=true;
									}else{
										chk[i].checked=true;
									}
								}
								if(frm.sel.value=="전체선택")
								{
									frm.sel.value="전체해제";
								}else{
									for(var i=0;i<chk_su;i++)
									{
										if(chk_su==1){
											chk[0].checked=false;
										}else{
											chk[i].checked=false;
										}
									}
									frm.sel.value="전체선택";
								}
							}
							function ListDel(){
								var frm=document.frmList;
								var chk=document.getElementsByName("index_no[]");;
								var j=0;
								var answer=confirm("한 번 삭제하시면 복구하실 수 없습니다. 그래도 삭제하시겠습니까?");
								if(!chk.length){
									chk_su=1;
								}else{
									chk_su=chk.length;
								}
								for(var i=0;i<chk_su;i++){
									if(chk[i].checked==true){
										j+=(i+1);
									}
								}
								if(j==0){
									alert("한 개 이상 체크가 되어 있어야 합니다.");
									return false;
								}
								if(answer==false){
									return false;
								}
								frm.action="board_All_delete.php";
								frm.submit();
							}
						</script>



<table width='50%' align="center"  border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align=right width=900>
<?
##################################################################################

//그룹 현재 위치
if($category_num){
	if($_SESSION["MemberLevel"] == 3){
		$cur_category_name = category_navi3($category_num);
	}elseif($_SESSION["MemberLevel"] == 2){
		$cur_category_name = category_navi2($category_num);
	}elseif($_SESSION["MemberLevel"] == 1){
		$cur_category_name = category_navi1($category_num);
	}else{
		$cur_category_name = category_navi($category_num);
	}
	$tmp_category_num = $category_num;
}
if($category_num){
$SQL = "select prevno from $CategoryTable where category_num='$tmp_category_num' and mart_id='$mart_id'";
//echo $SQL;
$dbresult = mysql_query($SQL, $dbconn);
$prevno = mysql_result($dbresult,0,0);
}
if($prevno > 0)
{
	//=========================== 해당 상위 그룹 정보를 불러옴 ============================
	$SQL = "select prevno from $CategoryTable where category_num='$prevno' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$prevno2 = mysql_result($dbresult,0,0);
	if($prevno2 > 0)
	{
		//=========================== 해당 상위 그룹 정보를 불러옴 ============================
		$SQL = "select prevno from $CategoryTable where category_num='$prevno2' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$prevno3 = mysql_result($dbresult,0,0);		
	}
}
if( $pu == 1 ){ //1차 그룹 리스트 일때
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "firstno='$tmp_category_num'";			// 1차 회원등록
	$con1 = "a.firstno='$tmp_category_num'";
	$first_no = $tmp_category_num;
	$second_no = 0;
	$thirdno = 0;
	$category_num = $tmp_category_num;
}else if( $pu == 2 ){ //2차 그룹 리스트 일때
	//$con = "category_num='$tmp_category_num'";
	//$con1 = "a.category_num='$tmp_category_num'";
	$con = "prevno='$tmp_category_num'";			// 3차 회원등록
	$con1 = "a.prevno='$tmp_category_num'";
	$first_no = $prevno;
	$second_no = $tmp_category_num;
	$thirdno = 0;
	$category_num = $tmp_category_num;
}else if($pu == 3){ //3차 그룹 리스트 일때
	$con = "thirdno='$tmp_category_num'";
	$con1 = "a.thirdno='$tmp_category_num'";
	$first_no = $prevno2;
	$second_no = $prevno;
	$thirdno = $tmp_category_num;
	$category_num = $tmp_category_num;
}else if($pu == 4){ //3차 그룹 리스트 일때
	$con = "category_num='$tmp_category_num'";
	$con1 = "a.category_num='$tmp_category_num'";
	$first_no = $prevno3;
	$second_no = $prevno2;
	$thirdno = $prevno;
	$category_num = $tmp_category_num;
}


if(!$category_num){
	$con = "1";
}
##################################################################################













$now_date = date("Y-m-d"); //게시기간

$sql0 = "select * from $New_BoardTable where $con and del_chk='n' and bbs_no = '$bbs_no'";
$result0 = mysql_query($sql0,$dbconn);
$rows0 = @mysql_num_rows($result0);


$sql1 = "select * from $New_BoardTable where $con and end_date >= '$now_date' and del_chk='n' and bbs_no = '$bbs_no'";
$result1 = mysql_query($sql1,$dbconn);
$rows1 = @mysql_num_rows($result1);


//기간만료
$sql2 = "select * from $New_BoardTable where $con and end_date < '$now_date' and del_chk='n' and bbs_no = '$bbs_no'";
$result2 = mysql_query($sql2,$dbconn);
$rows2 = @mysql_num_rows($result2);
?>
<?if($_SESSION["MemberLevel"] == 10){?>

	<table border="0" width="170" cellspacing="1" cellpadding="1" bgcolor=#808080>
								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										전체 가맹점수
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($rows0)?>
									</td>
								</tr>
								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										유효기간
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($rows1)?>
									</td>
								</tr>
								<tr>
									<td width="50%" bgcolor="#8FBECD" align="center" colspan="2">
										<a href="<?=$PHP_SELF?>?nochul_end=y">유효기간만료</a>
									</td>
									<td width="50%" bgcolor="#ffffff" align="center" colspan="2">
										<?=number_format($rows2)?>
									</td>
								</tr>
	  </table>
								
						

<?}?>
</td>
</tr>
</table>


<div align=center>

<a href="<?=$PHP_SELF?>?my_list=y&bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>"><b><img src="../images/board/view_border_butten.gif"></b></a></div>
<br />

						<table width='60%' align="center"  border='0' cellspacing='0' cellpadding='0' class="box1">
						<form name="frmList" action='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>' method="post" onSubmit="board_check(); return false;">

						<input type="hidden" name="page1" value="<?=$page?>">
							<tr>
								
								<td width='70' align='center'  class="title">번호</td>

								<td width='100' align='center'  class="title">분야</td>

								<td width='100' align='center'  class="title">부분</td>

								<td width='100' align='center'  class="title">상호</td>

								<td width='100' align='center'  class="title">할인율</td>

								<td width='100' align='center'  class="title">등록자</td>

								<td width='100' align='center'  class="title">등록일</td>

								<td width='60' align='center'  class="title">조회수</td>
							</tr>
						</table>

						<table width='60%' align='center'  border='0' cellspacing='0' cellpadding='0'>		
<?

	$SQL = "select category_num from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);
	$category_num = $rows[category_num];



	if ($cnfPagecount == "") $cnfPagecount = $pagecount;
	if ($page == "") $page = 1;
	$skipNum = ($page - 1) * $cnfPagecount;

	$prev_page = $page - 1;
	$next_page = $page + 1;

	if($my_list == "y"){//내게시물보기
		$add_query=" and username='$_SESSION[Mall_Admin_ID]' ";
	}else{
		//$end_date_query=" and end_date >= '$now_date' ";
	}


	if($nochul_end == y){//게시기간만료보기
		//$add_query2 =" and end_date < '$now_date' ";
	}





	$open_chk_query = " and mart_id = '$mart_id' ";

	if($sea_area){
		$open_chk_query .= " and sea_area = '$sea_area' ";
	}
	if($sung_area){
		$open_chk_query .= " and sung_area = '$sung_area' ";
	}
	if($khan_area){
		$open_chk_query .= " and khan_area = '$khan_area' ";
	}
	if($bunryu_search){
		$open_chk_query .= " and bunryu = '$bunryu_search' ";
	}
	if($bubun){
		$open_chk_query .= " and bubun = '$bubun' ";
	}
	if($subject_new){
		$open_chk_query .= " and subject_new like '%$subject_new%' ";
	}
	if($halin){
		$open_chk_query .= " and halin = '$halin' ";
	}


	if($view_type == "on"){
		$open_chk_query .= " and end_date >= '$now_date' "; 
	}
	elseif($view_type == "off"){
		$open_chk_query .= " and end_date < '$now_date' "; 
	}


	$SQL1 = "select count(*) from $New_BoardTable where $con $open_chk_query and del_chk='n' and bbs_no = '$bbs_no' $end_date_query $open_auth_query  $add_query $add_query2   "; 
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
	$numRows_tot = @mysql_result($dbresult,0,0);

	$SQL1 = "select * from $New_BoardTable where $con $open_chk_query and del_chk='n' and bbs_no = '$bbs_no' $end_date_query $open_auth_query  $add_query $add_query2  "; 
	$SQL2 = "and binary $keyset like '%$searchword%' ";
	$SQL2_1 = "and (binary writer like '%$searchword%' or binary subject_new like '%$searchword%' or binary content like '%$searchword%') ";
	$SQL3 = "order by notice_no desc, ansno asc limit $skipNum, $cnfPagecount";


	if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset != "all")){
		$SQL=$SQL1.$SQL2.$SQL3;
	}elseif(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!="")&&($keyset == "all")){
		$SQL=$SQL1.$SQL2_1.$SQL3;
	}else{
		$SQL=$SQL1.$SQL3;
	}

	
	
	echo "<input type=hidden name=skipNum value=$skipNum>";
	echo "<input type=hidden name=cnfPagecount value=$cnfPagecount>";


	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = @mysql_num_rows($dbresult);
?>
<?
	if( $numRows == "0" ){
?>
							<tr height='30'>
								<td colspan='8' align='center'><b>등록된 글이 없습니다</b></td>
							</tr>
							<tr>
								<td bgcolor='E1E1E1' height='1' colspan='8'></td>
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
		$open_auth = $row[open_auth];
		$bunryu = $row[bunryu];
		$halin = $row[halin];

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
								<td width='70' class='point'><?if($row[notice_no] >= '100000'){echo"<b>[공지]</b>";}else{echo"$k";}?></td>
								<td width="100" align='center' class='help'>

															<?
									$sql2 = "select category_name from gameng_cate_bunya where seq_num='$bunryu'";
									$res2 = mysql_query($sql2,$dbconn);
									$row2 = mysql_fetch_array($res2);

									$bunryu_name = $row2[category_name];
									echo $bunryu_name;

									?>									</td>
								<td width="100" align='center' class='help'>
								<?
									$sql3 = "select category_name from gameng_cate_bunya where seq_num='$bubun'";
									$res3 = mysql_query($sql3,$dbconn);
									$row3 = mysql_fetch_array($res3);

									$bubun_name = $row3[category_name];
									echo $bubun_name;

									?>								</td>
								<td width="100" align='center' class='help'>
								<a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>'><?if($row[notice_no] >= '100000'){?><b><?}?><?=$subject_new?></a> <?=$secret_str?><?=$new_string?></td>
								<td width="100" align='center'><?=$halin?>%</td>
								<td width="100" align='center'><?=$member_img?></td>
								<td width="100" align='center' class='point'><?=$write_date_str?></td>
								<td width="60" align='center' class='point'><?=$read_num?></td>
							</tr>
							<tr>
								<td bgcolor='E1E1E1' height='1' colspan='8'></td>
							</tr>
<?     				
	}
?>
						</table>