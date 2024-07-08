<link href="../style.css" rel="stylesheet" type="text/css">
<?
$it_board_row = 20;			//  열수
$it_board_page_num = 10;	//  페이지수
$link_page_num = 10;
$time_limit = 60*60*24*1;
$today = date("Y-m-d");

if(!$page) $page=1;

if($guin_gujik == "guin"){ //개인,중개업소
	$guin_gujik_query = " and guin_gujik='guin' ";
}else if($guin_gujik == "gujik"){
	$guin_gujik_query = " and guin_gujik='gujik' ";
}
if($address1=="전체"){
	$address1="";
}
if($address2=="전체"){
	$address2="";
}
if($sido){
	$where =" and location1 like '%$sido%' ";

}
if($address1){
	$where .= " and location1 like '%$address1%' ";
}
if($address2 && $address2 != "전체"){
	$address2 = substr($address2,0,4);
	if($address1 == "수영구" && $address2 == "수영"){
		$address2 = "수영동";
	}
	$where .= " and location1 like '%$address2%' ";
}
if($bunya){ //아파트/빌라,빌라,원룸/투룸/오피스텔,상가주택/빌딩
	$where .= " and bunya='$bunya' ";
}

if($opt2_1 == 'y'){ //급매물
	$where .= " and opt2_1='y' ";
}

if($opt1){ //추천,스페셜,프리미엄
	$where .= " and opt1='$opt1' ";
}

if($maemae_type){ //매매,전세,월세
	$where .= " and maemae_type='$maemae_type' ";
}

###################### 상세검색꺼 시작#############################
if($mae_money1_start > 0){ //매매 융자금 이상
	$where .= " and mae_money1 >= '$mae_money1_start' ";
}
if($mae_money1_end > 0){ //매매 융자금 이하
	$where .= " and mae_money1 <= '$mae_money1_end' ";
}
if($mae_money2_start > 0){ //매매 매매가 이상
	$where .= " and mae_money2 >= '$mae_money2_start' ";
}
if($mae_money2_end > 0){ //매매 매매가 이하
	$where .= " and mae_money2 <= '$mae_money2_end' ";
}

if($jun_money_start > 0){ //전세 전세금 이상
	$where .= " and jun_money >= '$jun_money_start' ";
}
if($jun_money_end > 0){ //전세 전세금 이하
	$where .= " and jun_money <= '$jun_money_end' ";
}

if($wol_money1_start > 0){ //월세 보증금 이상
	$where .= " and wol_money1 >= '$wol_money1_start' ";
}
if($wol_money1_end > 0){ //월세 보증금 이하
	$where .= " and wol_money1 <= '$wol_money1_end' ";
}
if($wol_money2_start > 0){ //월세 월세금 이상
	$where .= " and wol_money2 >= '$wol_money2_start' ";
}
if($wol_money2_end > 0){ //월세 월세금 이하
	$where .= " and wol_money2 <= '$wol_money2_end' ";
}

if($pyungsu_start > 0){ //평수 이상
	$where .= " and pyungsu >= '$pyungsu_start' ";
}
if($pyungsu_end > 0){ //평수 이하
	$where .= " and pyungsu <= '$pyungsu_end' ";
}

if($subway_si){ //역세권 시
	$where .= " and subway_si = '$subway_si' ";
}
if($subway_hosun){ //역세권 호선
	$where .= " and subway_hosun = '$subway_hosun' ";
}
if($subway_yeok){ //역세권 역
	$where .= " and subway_yeok like '%$subway_yeok%' ";
}

if($text_value){
	$where .= " and member_id like '%$text_value%'"; //고를께 없어서 일단 아이디로검색
}
if($add_field){
	$where .= " $add_field"; //대분류 카테고리 검색
}
###################### 상세검색꺼 끝#############################

$result = mysql_query("select count(*) from $board where 1 $guin_gujik_query $where ");
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



	$result = mysql_query("select * from $board where 1 $guin_gujik_query $where order by mod_date desc, id desc limit $start,$it_board_row");

	db_error($result,"데이터질의문 오류");

	$total_list = mysql_num_rows($result);

	if($total_list >= $it_board_row) $IsNext = ($page == $total_page)? 0:1;
}
?>
<SCRIPT LANGUAGE="javascript" SRC="../oboard/function.js"></SCRIPT>
<SCRIPT LANGUAGE="javascript" SRC="../oboard/select_area.js"></SCRIPT>
<?
if($address2){
?>
	<script language="javascript">
	function change_load()
	{
		var cat_sel = local.address1.selectedIndex
		change1(cat_sel, '<?=$address2?>');
	}

	window.onload = change_load;
	</script>
<?
}else{
?>
	<script language="javascript">
	function change_load()
	{
		var cat_sel = local.address1.selectedIndex
		change1(cat_sel, 'all');
	}

	window.onload = change_load;
	</script>
<?
}
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

<?if($address1 || $address2 || $bunya || $maemae_type || $guin_gujik){?>
<tr bgcolor="#ffffff"> 
	<td colspan="9" align="center" bgcolor="ffffff">&nbsp;
	<font color=green>
	<b>
	
	<?
	if($address1 && $address1 != "경남"){
		echo "구/군 : $address1 &nbsp;&nbsp;&nbsp;";
	}
	?>
	<?
	if($address2){
		echo "읍/면/동 : $address2 &nbsp;&nbsp;&nbsp;";
	}
	?>
	<?
	if($bunya){
		echo "매물종류 : $bunya &nbsp;&nbsp;&nbsp;";
	}
	?>
	<?
	if($maemae_type){
		echo "매물형태 : $maemae_type &nbsp;&nbsp;&nbsp;";
	}
	?>
	<?
	if($guin_gujik == "guin"){
		echo "등록구분 : 개인매물 ";
	}
	if($guin_gujik == "gujik"){
		echo "등록구분 : 중개매물 ";
	}

	?>
	
	</b>
	</font>
	</td>
</tr>
<?}?>
	
	<tr bgcolor="CFCFCF"> 
		<td height="1" colspan="9" align="center" bgcolor="2359A3"></td>
	</tr>
	<tr> 
		<td height="30" bgcolor="F2F2F2"><div align="center"><strong>사진</strong></div></td> 
		<td bgcolor="F2F2F2" width=100><div align="center"><strong>소재지</strong></div></td>
		<td bgcolor="F2F2F2"><div align="center"><strong>종류</strong></div></td>
		<td bgcolor="F2F2F2" width=40><div align="center"><strong>형태</strong></div></td>
		<td bgcolor="F2F2F2" width=30><div align="center"><strong>면적</strong></div></td>
		<td bgcolor="F2F2F2" width=100><div align="center"><strong>매도가/인수가</strong></div></td>
		<td bgcolor="F2F2F2" width=50><div align="center"><strong>등록일</strong></div></td>
		<td bgcolor="F2F2F2" width=30><div align="center"><strong>조회</strong></div></td>
		<td bgcolor="F2F2F2" width=30><div align="center"><strong>사진</strong></div></td>
	</tr>
	<tr bgcolor="CFCFCF"> 
		<td height="1" colspan="9" align="center" bgcolor="2359A3"></td>
	</tr>

<?
########################################### 게시판 for 문시작 ##############################################
if($total){
	for($i=0;	$ans = mysql_fetch_array($result); $i++){

		if($search_word){
			for($c=0; $c<count($data); $c++){
				if(!strcmp($data[$c],"title")){
					$ans[name] = change_fontcolor($search_word,$ans[name]);
				}else if(!strcmp($data[$c],"name")){
					$ans[title] = change_fontcolor($search_word,$ans[title]);
				}
			}
		}
		$sign_date=explode("-",$ans[mod_date]);
		$sign_date=$sign_date[1]."-".$sign_date[2];
		$end_date = date("Y-m-d", strtotime("-3 day")); 
?>
<a href='<?=$code_url?>?set=view&guin_gujik=<?=$guin_gujik?>&board=<?=$board?>&uid=<?=$ans[0]?>&opti_ex=<?=$ans[9]?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&page_num=<?=$row_num?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&subway_si=<?=$subway_si?>&subway_hosun=<?=$subway_hosun?>&subway_yeok=<?=$subway_yeok?>&address1=<?=$address1?>&address2=<?=$address2?>&bunya=<?=$bunya?>&maemae_type=<?=$maemae_type?>'><tr onmouseover="this.style.backgroundColor='#F2F2F2'" onmouseout="this.style.backgroundColor='white'" style="cursor:hand">					
						<td height="50" align="center">
						<?
						if($ans[opt2_4] == "y"){
							if($ans[img_big] && file_exists("../oboard/upfile_dir/$ans[img_big]")){
							?>
								<img src="../oboard/upfile_dir/<?=$ans[img_big]?>" width="60" height="43" border="0">
							<?
							}else{
							?>
								<img src="../oboard/images/not_image.gif" width="60" height="43" border="0">
							<?
							}
						?>
							
						<?
						}else{
						?>
							
						<?
						}
						?>						</td>
						<td height="28" align="center"><?=$ans[location1]?></td>
						<td align="center">	
						[<?=$ans[bunya]?>]
						<?
						if($ans[opt2_2] == "y"){
							$opt2_2_value1 = "<b>";
							$opt2_2_value2 = "</b>";
						}
						if($ans[opt2_3] == "y"){
							$opt2_3_value1 = "<font color=blue>";
							$opt2_3_value2 = "</font>";
						}
						?>	
								<?=$opt2_3_value1?><?=$opt2_2_value1?><?=$ans[apt_name]?><?=$opt2_2_value2?><?=$opt2_3_value2?>

						<?
						if($sign_date > $end_date){
						?>
							<img src="../images/main/icon_new.gif" border="0">
						<?
						}if($ans[opt2_1] == "y"){
						?>
							<img src="../images/main/icon_wanted.gif" width="36" height="16" align="absmiddle" />
						<?
						}
						?>
						</td>
						<td align="center">
						<?=$ans[maemae_type]?>						</td>
						<td align="center">
						<?=$ans[pyungsu]?>
<?
	if($ans[bunya] == "원룸/투룸/오피스텔" || $ans[bunya] == "아파트/빌라"){
		echo"평";
	}else{
		echo"㎡";
			$sangga_count = $ans[pyungsu] / 3.3058;
			$sangga_pyungsu = round($sangga_count);
			echo "<br>"."($sangga_pyungsu"."평)";
	}							
?>						
						</td>
						<td align="center"> <!--가격-->
						<?
							if($ans[maemae_type] == "매매"){
						?>
								<?=number_format($ans[mae_money1])?>/<?=number_format($ans[mae_money2])?>&nbsp;만원
						<?
							}
							elseif($ans[maemae_type] == "전세"){
						?>
							<?=number_format($ans[jun_money])?>&nbsp;만원
						<?
							}else{
						?>
							<?=number_format($ans[wol_money1])?>/<?=number_format($ans[wol_money2])?>&nbsp;만원
						<?
							}
						?>
						</td>
						<td align="center"> 
						<?=$sign_date?>					  </td>						
						<td align="center"> 
						<?=$ans[count]?>					  </td>						
						<td align="center"><? if($ans[img_big]){ ?><img src="../images/main/icon_camera_color.gif" width="18" height="17" /><? }else{ ?><img src="../images/main/icon_camera_gray.gif" width="18" height="17" /><?}?></td>						
					</tr>
					<tr bgcolor="CFCFCF"> 
					<td height="1" colspan="9" align="center" bgcolor="#F2F2F2"></td>
					</tr>
	</a>	
		<?
		$opt2_2_value1 = "";
		$opt2_2_value2 = "";
		$opt2_3_value1 = "";
		$opt2_3_value2 = "";
	$row_num--;
	}
}
#############################################게사파 for문 끝#######################################
?>
			  <tr> 
                <td height="1" colspan="9" bgcolor="CFCFCF"></td>
              </tr>
  </table>
<br />	 <table align="center">
							<tr> 
                <td width="100%" colspan="9" align="center"> 
                  <!--페이지 표시 테이블 시작 -->
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
							  <td width="100%" align="center">
							  <a href='<?=$code_url?>?set=list&guin_gujik=<?=$guin_gujik?>&board=<?=$board?>&page=1&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&subway_si=<?=$subway_si?>&subway_hosun=<?=$subway_hosun?>&subway_yeok=<?=$subway_yeok?>&address1=<?=$address1?>&address2=<?=$address2?>&bunya=<?=$bunya?>&maemae_type=<?=$maemae_type?>&opt2_1=<?=$opt2_1?>&opt1=<?=$opt1?>'><img src="../oboard/images/table_bt_left2.jpg" width="17" height="14" border="0" align="absmiddle"></a>				  
							  <?
								if($block > 1){
									$pre_block=$first_page;
							   ?>	
									<a href='<?=$code_url?>?set=list&guin_gujik=<?=$guin_gujik?>&board=<?=$board?>&page=<?=$pre_block?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&subway_si=<?=$subway_si?>&subway_hosun=<?=$subway_hosun?>&subway_yeok=<?=$subway_yeok?>&address1=<?=$address1?>&address2=<?=$address2?>&bunya=<?=$bunya?>&maemae_type=<?=$maemae_type?>&opt2_1=<?=$opt2_1?>&opt1=<?=$opt1?>'><font color=\"#6699CC\"><img src="../oboard/images/table_bt_left1.jpg" width="13" height="14" border="0" align="absmiddle"> </font></a>
								<?
								}else{
								?>
									<font color=\"#6699CC\"><img src="../oboard/images/table_bt_left1.jpg" width="13" height="14" border="0" align="absmiddle"> </font>
								<?
								}
								for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++){
									if($page == $direct_page) {
								?>
										<b><font color="#FF0000"><?=$direct_page?></font></b>&nbsp;
								<?
									}else{
								?>
										<a href='<?=$code_url?>?set=list&guin_gujik=<?=$guin_gujik?>&board=<?=$board?>&page=<?=$direct_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&subway_si=<?=$subway_si?>&subway_hosun=<?=$subway_hosun?>&subway_yeok=<?=$subway_yeok?>&address1=<?=$address1?>&address2=<?=$address2?>&bunya=<?=$bunya?>&maemae_type=<?=$maemae_type?>&opt2_1=<?=$opt2_1?>&opt1=<?=$opt1?>'><font color="#000000"><?=$direct_page?></font></a>&nbsp;
								<?
									}
								}
								if($block < $total_block) {
									$my_page = $last_page+1;
								?>
									<a href='<?=$code_url?>?set=list&guin_gujik=<?=$guin_gujik?>&board=<?=$board?>&page=<?=$my_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&subway_si=<?=$subway_si?>&subway_hosun=<?=$subway_hosun?>&subway_yeok=<?=$subway_yeok?>&address1=<?=$address1?>&address2=<?=$address2?>&bunya=<?=$bunya?>&maemae_type=<?=$maemae_type?>&opt2_1=<?=$opt2_1?>&opt1=<?=$opt1?>'> <font color=\"#6699CC\"><img src="../oboard/images/table_bt_right1.jpg" width="13" height="14" border="0" align="absmiddle"></font></a>
								<?
								}else{
								?>
								 <font color=\"#6699CC\"><img src="../oboard/images/table_bt_right1.jpg" width="13" height="14" border="0" align="absmiddle"></font>
								<?
								}
								?>
								<a href='<?=$code_url?>?set=list&guin_gujik=<?=$guin_gujik?>&board=<?=$board?>&page=<?=$total_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&subway_si=<?=$subway_si?>&subway_hosun=<?=$subway_hosun?>&subway_yeok=<?=$subway_yeok?>&address1=<?=$address1?>&address2=<?=$address2?>&bunya=<?=$bunya?>&maemae_type=<?=$maemae_type?>&opt2_1=<?=$opt2_1?>&opt1=<?=$opt1?>'><img src="../oboard/images/table_bt_right2.jpg" width="17" height="14" border="0" align="absmiddle"></a>							  </td>
							</tr>
						  </table>                  
				  <!--페이지 표시 테이블 끝 -->
				</td>
             </tr>
            </table>















