<?

/*
if($HTTP_SESSION_VARS[AUTH2] || ($Mall_Admin_ID&&$MemberLevel==1)){
	$auth_chk = "ok";
}
if(!$auth_chk){
	err_msg("로그인후 이용가능합니다");
}
*/

if($ox_modify){
			$result = mysql_query("update $board set ox='$ox_modify' where id='$uid'");

			print "<meta http-equiv='Refresh' content='0; URL=$code_url?set=list&board=$board&uid=$uid&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'>";
					exit;
}



$it_board_row = 15;			//  열수
$it_board_page_num = 10;	//  페이지수
$link_page_num = 10;
$time_limit = 60*60*24*1;

if(!$page) $page=1;

if(!$search_word){ //검색어가 없을때
		$result = mysql_query("select count(*) from $board where code='$code_url'");
}else{
	$data = explode(",",$check_array);
	$where = search_create($data,$search_word);

	$result = mysql_query("select count(*) from $board $where and code='$code_url'");
}
db_error($result,"카운트오류!");
$total = mysql_result($result,0,0);

if($total){
	$total_page = ceil($total/$it_board_row);
	$total_block = ceil($total_page/$it_board_page_num);
	$block = ceil($page/$link_page_num);

	$first_page = ($block-1)*$it_board_page_num;
	$last_page = $block*$it_board_page_num;

	if($total_block<=$block) $last_page = $total_page;

	$row_num = $total-$it_board_row*($page-1);
	$start = ($page-1)*$it_board_row;

	if(!$search_word){
		if($Mall_Admin_ID&&$MemberLevel==1){
				$result = mysql_query("select * from $board where code='$code_url' order by thread desc,thread2 asc,pos asc limit $start,$it_board_row");
		}
		else{
				$result = mysql_query("select * from $board where code='$code_url' order by thread desc,thread2 asc,pos asc limit $start,$it_board_row");
		}
	}else{
			if($Mall_Admin_ID&&$MemberLevel==1){
				$data = explode(",",$check_array);
				$where = search_create($data,$search_word);

				$result = mysql_query("select * from $board $where and code='$code_url' order by thread desc,thread2 asc,pos asc limit $start,$it_board_row");
			}else{
				$data = explode(",",$check_array);
				$where = search_create($data,$search_word);

				$result = mysql_query("select * from $board $where and code='$code_url' order by thread desc,thread2 asc,pos asc limit $start,$it_board_row");
		}
	}

	db_error($result,"데이터질의문 오류");

	$total_list = mysql_num_rows($result);

	if($total_list >= $it_board_row) $IsNext = ($page == $total_page)? 0:1;
}

if($Mall_Admin_ID&&$MemberLevel==1){
	$colspan1="8";
	$colspan2="8";
}else{
	$colspan1="5";
	$colspan2="5";
}
?>

				  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1">
			<tr bgcolor="F2F2F2"> 
                <td height="2" colspan="<?=$colspan2?>" align="center"></td>
      </tr>
              <tr> 
                <td width="160" align="center" bgcolor="2EACDF"><span class="style1"> 
                업체명</span></td>
                <td width="80" align="center" bgcolor="2EACDF"><span class="style1"> 
                대표자명</span></td>
                  <td width="120" align="center" bgcolor="2EACDF"><span class="style1"> 
                 취급품목</span></td>
                <!--<td width="80" align="center" bgcolor="2EACDF"><span class="style1"> 
                구분</span></td>-->
	                <td width="100" align="center" bgcolor="2EACDF"><span class="style1"> 
                 전화번호</span></td>
	                <td width="100" align="center" bgcolor="2EACDF"><span class="style1"> 
                 상품보기</span></td>
<?
if($Mall_Admin_ID&&$MemberLevel==1){
?>
						<td width="100" align="center" bgcolor="2EACDF"><span class="style1"> 
                 등록일</span></td>
						<td width="60" align="center" bgcolor="2EACDF"><span class="style1"> 
                 조회수</span></td>
						<!--
						<td width="60" align="center" bgcolor="2EACDF"><span class="style1"> 
                 상태</span></td>-->
<?
}
?>
              </tr>
			<tr bgcolor="CFCFCF"> 
                <td height="2" colspan="<?=$colspan2?>" align="center"></td>
      </tr>

<?
########################################### 게시판 for 문시작 
if($total){
	for($i=0;	$ans = mysql_fetch_array($result); $i++){

		if($board_type == "board"){



	$qry="SELECT * FROM rg_goods_category where cat_name='$ans[value11]'";
	$rs=mysql_query($qry);
	$tmp = mysql_fetch_array($rs);

	if($ans[value8]){
		$ahref="http://$ans[value8]";
		$gubun = "<font color=green>홈페이지</font>";
	}else{
		$ahref="../../bbs/list_front.php?bbs_id=goods&ss[fc]=$tmp[cat_num]&view_id=$ans[id]";
		$gubun = "<font color=blue>상품보기</font>";
	}
?>

<tr onmouseover="this.style.backgroundColor='#fafad2'" onmouseout="this.style.backgroundColor='white'" style="cursor:hand">
						<td align="center" bgcolor="#F7FCFD"  height="28">
						<a href='#' title="<?=$ans[body]?>"><font face=굴림 color='#666666'>
						<a href='<?=$code_url?>?set=view&board=<?=$board?>&uid=<?=$ans[0]?>&opti_ex=<?=$ans[9]?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&page_num=<?=$row_num?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><font face=굴림 color='#666666'><b><?=$ans[value1]?></b></a>	
						</td>
						<td align="center">
						<?=$ans[value2]?>						</td>
						<td align="center" bgcolor="#F7FCFD">
						<?=$ans[value10]?>						</td>
						<!--<td align="center">
						<?=$ans[value13]?>						</td>-->
						<td align="center" bgcolor="#F7FCFD">
						  <?=$ans[value6]?>
						</td>
						<td align="center" bgcolor="#F7FCFD"> 
						<a href="<?=$ahref?>" target='_blank'><b><?=$gubun?></b></a>
						</td>		
<?
if($Mall_Admin_ID&&$MemberLevel==1){
?>
						<td align="center"> 
						<?=$ans[reg_date]?>					  </td>						
						<td align="center" bgcolor="#F7FCFD"> 
						<?=$ans[count]?>					  </td>		
						<!--
						<td align="center" bgcolor="#F7FCFD"> 
						<?
							if($ans[ox] == "x"){
								echo"<a href='$code_url?ox_modify=o&set=list&board=$board&uid=$ans[id]&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'><font color='red'>미등록</font></a>";
							}elseif($ans[ox] == "o"){
								echo"<a href='$code_url?ox_modify=x&set=list&board=$board&uid=$ans[id]&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'><font color='blue'>등록</font></a>";
							}
						?>
					  </td>	
					  -->
<?
}
?>
	  </tr>
					<tr bgcolor="F2F2F2"> 
					<td height="1" colspan="<?=$colspan2?>" align="center"></td>
					</tr>
		<?
		}
	$name = "";
	$row_num--;
	}
}
#############################################게사파 for문 끝#######################################
?>
			  <tr> 
                <td height="1" colspan="<?=$colspan2?>" bgcolor="CFCFCF"></td>
              </tr>
  </table>
<br />	 <table align="center">
							<tr> 
                <td width="300" colspan="<?=$colspan2?>" align="center"> 
                  <!--페이지 표시 테이블 시작 -->
						  <table width="300" border="0" cellspacing="0" cellpadding="0">
							<tr> 
							  <td width="300" align="center">
							  <a href='<?=$code_url?>?set=list&board=<?=$board?>&page=1&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><img src="../oboard_com2/images/table_bt_left2.jpg" width="17" height="14" border="0"></a>				  
							  <?
								if($block > 1){
									$pre_block=$first_page;
							   ?>	
									<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$pre_block?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><font color=\"#6699CC\"><img src="../oboard_com2/images/table_bt_left1.jpg" width="13" height="14" border="0"> </font></a>
								<?
								}else{
								?>
									<font color=\"#6699CC\"><img src="../oboard_com2/images/table_bt_left1.jpg" width="13" height="14" border="0"> </font>
								<?
								}
								for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++){
									if($page == $direct_page) {
								?>
										<b><font color="#FF0000"><?=$direct_page?></font></b>&nbsp;
								<?
									}else{
								?>
										<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$direct_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><font color="#000000"><?=$direct_page?></font></a>&nbsp;
								<?
									}
								}
								if($block < $total_block) {
									$my_page = $last_page+1;
								?>
									<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$my_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'> <font color=\"#6699CC\"><img src="../oboard_com2/images/table_bt_right1.jpg" width="13" height="14" border="0"></font></a>
								<?
								}else{
								?>
								 <font color=\"#6699CC\"><img src="../oboard_com2/images/table_bt_right1.jpg" width="13" height="14" border="0"></font>
								<?
								}
								?>
								<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$total_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><img src="../oboard_com2/images/table_bt_right2.jpg" width="17" height="14" border="0"></a>
							  </td>
							</tr>
						  </table>                  
				  <!--페이지 표시 테이블 끝 -->
				</td>
				</tr>
				</table>

</form>















<map name="Map" id="Map">
<area shape="rect" coords="406,12,658,79" href="../site/usage.htm" />
</map>