						<script language="javascript">
							var isboolean=false;
							function ListSel(){
								var frm=document.frmList;
								var chk=document.getElementsByName("index_no[]");
								var chk_su="";
								var sel=document.getElementById("sel");
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
								if(isboolean==false)
								{
									sel.src="../image/helpdesk/list_check_off.gif";
									isboolean=true;
								}else{
									for(var i=0;i<chk_su;i++)
									{
										if(chk_su==1){
											chk[0].checked=false;
										}else{
											chk[i].checked=false;
										}
									}
									sel.src="../image/helpdesk/list_check.gif";
									isboolean=false;
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
						<table width='100%' align="center"  border='0' cellspacing='0' cellpadding='0'>
						<form name="frmList" action='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>' method="post" onSubmit="board_check(); return false;">

						<input type="hidden" name="page1" value="<?=$page?>">
							<tr>
								<td width='10'><img src='../image/helpdesk/table1_left.gif'></td>
								<td width='60' align='center' background='../image/helpdesk/table1_bg.gif'><img src='../image/helpdesk/no.gif'></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif'></td>
								<td align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/subject.gif'></font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif'></td>
								<td width='100' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/write.gif'></font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif'></td>
								<td width='100' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/date.gif'></font></td>
								<td width='1'><img src='../image/helpdesk/table1_line.gif'></td>
								<td width='60' align='center' background='../image/helpdesk/table1_bg.gif'><font color='<?=$item_fg_color?>'><img src='../image/helpdesk/hit.gif'></font></td>
								<td width='10'><img src='../image/helpdesk/table1_right.gif'></td>
							</tr>
						</table>

						<table width='100%' align='center'  border='0' cellspacing='0' cellpadding='0'>		
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
	echo "<input type=hidden name=skipNum value=$skipNum>";
	echo "<input type=hidden name=cnfPagecount value=$cnfPagecount>";

	

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

		if(strlen($subject_new) > 70){
			$subject_new = substr($subject_new, 0, 70);
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
								<td class='help' align='left'>
								<? if($_SESSION["Mall_Admin_ID"]){?>
									<input type="checkbox" name="index_no[]" value="<?=$index_no?>">
									<? }?>
								
								
								<?
								if($row[area]){
									$sql2 = "select * from item where item_no='$row[area]'";
									$res2 = mysql_query($sql2,$dbconn);
									$row2 = mysql_fetch_array($res2);
								?>
								<a href="../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$row2[category_num]?>&flag=&item_no=<?=$row2[item_no]?>" target="_top"><b>[<?=$row2[item_name]?>]</b></a>&nbsp;&nbsp;
								<?
								}
								?>
								
								
								
								
								
								<?=$j_str?><a href='board_read.php?index_no=<?=$index_no?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&mart_id=<?=$mart_id?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'><?if($row[notice_no] >= '100000'){?><b><?}?><?=$subject_new?></a> <?=$secret_str?><?=$new_string?></td>
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