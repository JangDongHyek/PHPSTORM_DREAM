						<table width='96%' align="center"  border='0' cellspacing='0' cellpadding='0'>
							<tr>
								<td width='10'><img src='../image/helpdesk/table1_left.gif' width='10' height='40'></td>
								<td width='150' align='center' background='../image/helpdesk/table1_bg.gif'>상품명</td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'>제목</font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td width='100' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'>글쓴이</font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td width='100' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'>등록일</font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif' width='1' height='40'></td>
								<td width='60' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'>평가</font></td>
								<td width='10'><img src='../image/helpdesk/table1_right.gif' width='10' height='40'></td>
							</tr>
						</table>

						<table width='96%' align='center'  border='0' cellspacing='0' cellpadding='0'>		
<?
	//if($bbs_no == 8){
	//	$open_chk_query = " and open_chk = 'y' ";
	//}
	if ($cnfPagecount == "") $cnfPagecount = $pagecount;
	if ($page == "") $page = 1;
	$skipNum = ($page - 1) * $cnfPagecount;

	$prev_page = $page - 1;
	$next_page = $page + 1;

	$SQL1 = "select count(*) from $New_BoardTable where bbs_no = '$bbs_no' $open_chk_query and mart_id = '$mart_id' "; 
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

	$SQL1 = "select * from $New_BoardTable where bbs_no = '$bbs_no' $open_chk_query and mart_id = '$mart_id' "; 
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

		$est_sql2 = "select * from $ItemTable where mart_id='$mart_id' and item_no='$row[area]'";
		$est_res2 = mysql_query($est_sql2, $dbconn);
		$est_row2 = mysql_fetch_array($est_res2);

		$index_no = $row[index_no];
		$writer = $row[writer];
		$user_id = $row[username];
		$write_date = $row[write_date];
		$read_num = $row[read_num];
		$subject_new = $row[subject_new];
		$userfile = $row[userfile];

	$subject_new = str_replace("아토피","***",$subject_new);
	$subject_new = str_replace("여드름","***",$subject_new);
	$subject_new = str_replace("기미","**",$subject_new);
	$subject_new = str_replace("주근깨","***",$subject_new);
	$subject_new = str_replace("주근께","***",$subject_new);
	$subject_new = str_replace("미백","**",$subject_new);
	$subject_new = str_replace("주름","**",$subject_new);
	$subject_new = str_replace("자외선차단","*****",$subject_new);
	$subject_new = str_replace("자외선 차단","*****",$subject_new);
		$step = $row[step];
		$if_secret = $row[if_secret];
		$item_no = $row[area];

		$write_date_tmp = substr($write_date,0,8);
		$today_tmp = date("Ymd");

		if(strlen($subject_new) > 50){
			$subject_new = substr($subject_new, 0, 50);
			preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);
			$subject_new_tmp[0] .= '..';
			$subject_new = $subject_new_tmp[0];
		}
		$point = $row[point];
		$point_str = '';
		for($l=0;$l<$point;$l++){
			$point_str .= "<img src='../image/product/star_1.gif' align='asbmiddle'>";
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


		$sql_com = "select * from board_comment where bbs_no = '$bbs_no' and mart_id = '$mart_id' and index_no = '$index_no'"; 
		$dbresult_com = mysql_query($sql_com, $dbconn);
		$numRows_com = mysql_num_rows($dbresult_com);

		



?>
							<tr height='30' align='center'>
								<td width='150' class='point'><a href="#" onclick="javascript:parent.location.href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$est_row2[category_num]?>&item_no=<?=$est_row2[item_no]?>';"><span class="text_name"><?=$est_row2[item_name]?></span></a></td>
								<td class='help' align='left'><?=$j_str?><a href='board_read.php?item_no=<?=$item_no?>&index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?if($row[notice_no] >= '10000'){echo"<b>[공지]$subject_new</b>";}else{echo"$subject_new";}?></a>
								<?if($numRows_com > 0){?>
								<span style=font-size:8pt>[<?=$numRows_com?>]</span> 
								<?}?>
								<?=$secret_str?><?=$new_string?>
								
								<?
								if($userfile){
									echo"<img src='../image/icon_camera_color.gif' align=absmiddle>";
								}
								?>
								
								</td>
								<td width='100'><?=$member_img?></td>
								<td width='100' class='point'><?=$write_date_str?></td>
								<td width='70' class='point'><?=$point_str?></td>
							</tr>
							<tr>
								<td bgcolor='E1E1E1' height='1' colspan='5'></td>
							</tr>
<?     				
	}
?>
						</table>