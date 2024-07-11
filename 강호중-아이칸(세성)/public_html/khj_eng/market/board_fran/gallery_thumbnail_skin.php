<?
	//================ 기본설정==========================

	// 한줄에 출력 수
	$rows_count = "4";
	// 이미지 가로
	$gallery_img_width = "130";
	// 이미지 세로
	$gallery_img_height = "100";
	// 썸네일 지원 여부

	//========================= 그림파일이 있을때 출력 =======================================
	$upload = "../../up/$mart_id/"; //업로드 디렉토리
?>
						<!-- <table width='96%' align="center"  border='0' cellspacing='0' cellpadding='0'>
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
						</table> -->

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
		$userfile = $row[userfile];

		//================= 파일 경로 ==================
		$target = "$upload"."$userfile";

		$write_date_tmp = substr($write_date,0,8);
		$today_tmp = date("Ymd");

		//if(strlen($subject_new) > 20){
		//	$subject_new = substr($subject_new, 0, 50);
		//	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);
		//	$subject_new_tmp[0] .= '..';
		//	$subject_new = $subject_new_tmp[0];
		//}
		$subject_new = han_cut($subject_new, 20);

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

		if($i%$rows_count == 0)
			echo "				<tr>\n";
?>
							<td width="<?=intval(100/$rows_count)?>%">
								<table width=100% height=100% border=0 cellpadding=0 cellspacing=0 >
									<tr>
										<td align="center">
											<table width="<?=$gallery_img_width+20?>" height="<?=$gallery_img_height+20?>" border=0 cellpadding=0 cellspacing=0>
												<tr>
													<td><img src="../image/board/rt_l.gif "width=4 height=4 border=0></td>
													<td background="../image/board/rt_bg.gif"></td>
													<td><img src="../image/board/rt_r.gif" width=4 height=4 border=0></td>
												</tr>
												<tr>
													<td background="../image/board/rl_bg.gif"></td>
													<td align=center bgcolor=#F7F7F7 width=100% height=100%><a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><img src="<?=$target?>" width="<?=$gallery_img_width?>" height="<?=$gallery_img_height?>"></a></td>
													<td background="../image/board/rr_bg.gif"></td>
												</tr>
												<tr>
													<td><img src="../image/board/rb_l.gif" width=4 height=4 border=0></td>
													<td background="../image/board/rb_bg.gif"></td>
													<td><img src="../image/board/rb_r.gif" width=4 height=4 border=0></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align=center nowrap height=25><a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?=$subject_new?></a> <?=$secret_str?><?=$new_string?></td>
							        </tr>
								</table>
							</td>

							<!-- <tr height='30' align='center'>
								<td width='70' class='point'><?=$k?></td>
								<td class='help' align='left'><?=$j_str?><a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?=$subject_new?></a> <?=$secret_str?><?=$new_string?></td>
								<td width='100'><?=$member_img?></td>
								<td width='100' class='point'><?=$write_date_str?></td>
								<td width='70' class='point'><?=$read_num?></td>
							</tr> -->							
<?     				
		if($i%$rows_count == $rows_count-1)
		{
			echo "				</tr>\n";
			echo "				<tr><td height='10'></td></tr>";
		}
	}
?>
						</table>