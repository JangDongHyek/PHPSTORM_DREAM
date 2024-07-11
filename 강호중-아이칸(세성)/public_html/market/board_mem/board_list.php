<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<?
//================== DB 설정 파일을 불러옴 ===============================================
include_once "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include_once "../../main.class";
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
$list_type = $ary[list_type];


if($board_class == 1){	
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1 && !$_SESSION["Mall_Admin_ID"]){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;	
	}
}

//========================== 회원제 게시판일때 회원만 글쓰기 가능하게 함 =======

	//if($_SESSION["MemberLevel"] == 4){ 
	//	$write_img = "<a href='board_write.php?mart_id=$mart_id&bbs_no=$bbs_no&page=$page&keyset=$keyset&searchword=$searchword'><img src='../image/helpdesk/info_write.gif' width='70' height='30' border='0'></a>";
	//}



include_once( '../include/getmartinfo.php' );
include_once('../include/head_alltemplate.php');
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
<style>
    @media screen and (max-width:900px) {
        .box2 tr{display: flex; flex-wrap: wrap;}
        .box2 td.title{width: calc(100% / 3);}
        .box2 td{display: block; box-sizing: border-box; width: calc((100% / 3) * 2); margin: 0 -2px; text-align: left; min-height: 20px; line-height: 20px; word-break: keep-all;}
    }
</style>
<body>

<?
if( $top_body ){
	//include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}
?>
<div class="wrap">
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
						<table width="100%" align="center"  border="0" cellspacing="0" cellpadding="0">
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
						<table width="100%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10"><img src="../image/helpdesk/table1_left.gif" width="10" height="40"></td>
								<td width="100" align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/faq_type1.gif"></td>
								<td width="1"><img src="../image/helpdesk/table1_line.gif" width="1" height="40"></td>
								<td align="center" background="../image/helpdesk/table1_bg.gif"><img src="../image/helpdesk/faq_quest.gif"></td>
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

	echo $keyset;



	$SQL1 = "select count(*) from $New_BoardTable where bbs_no='$bbs_no' $open_chk_query and code='$code' and mart_id='$mart_id' "; 
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

	$SQL1 = "select * from $New_BoardTable where bbs_no='$bbs_no' $open_chk_query and code='$code' and mart_id='$mart_id' "; 
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
						<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
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
?>
<!---------------------- FAQ 질문 시작 -------------------------------------------------->
						<table width="100%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="110" height="30" align="center" class="point"><?=$code_str?></td>
								<td width="630" class="help"><A HREF="javascript:span_sw( show<?=$k?> );"><?=$subject_new?></a></td>
							</tr>
							<tr>
								<td bgcolor="E1E1E1" height="1" colspan="2"></td>
							</tr>
						</table>
<!---------------------- FAQ 질문 끝 ---------------------------------------------------->
<!---------------------- FAQ 답변 시작 -------------------------------------------------->
						<span id='show<?=$k?>' style="display: none;">
						<table width="100%" align="center"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td>
									<table width="100%"  border="0" cellspacing="0" cellpadding="10">
										<tr>
											<td><?=nl2br($content)?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td></td>
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
<!---------------------- FAQ 답변 끝 ---------------------------------------------------->
<!---------------------- FAQ 끝 --------------------------------------------------------->
<?
}else{
?>
<!---------------------- 검색 시작 ------------------------------------------------------>
<form name="frmList" action='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>' method="post" onSubmit="board_check(); return false;">

<div class="form">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">
<input type="hidden" name="page" value="1">
<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
<input type=hidden name="keyset" value="all">	
<input type=hidden name="my_list" value="<?=$my_list?>">	



    <tr>
      <td align=center width=15% class="title">분야</td> 
      <td width=35% bgcolor="#FFFFFF">
		<?
		$big_value = 5;


		?>
		<select name=bunryu onChange="location.href='<?=$PHP_SELF?>?bbs_no=<?=$bbs_no?>&big_value=<?=$big_value?>&bunryu='+this.options[this.selectedIndex].value"
         class="select_01">
			<option value="">==분야선택==</option>	
		<?
		$sql = "select * from jungbo_cate_bunya where parent_num='$big_value' and parent_num2 is null";
		$result = mysql_query( $sql,$dbconn ) or err_msg("분야 쿼리오류.");
		for($i=0; $rows = mysql_fetch_array($result); $i++){
			if($rows[seq_num] == $bunryu){
				$bunryu_selected = "selected";
			}
		?>
			<option value="<?=$rows[seq_num]?>" <?=$bunryu_selected?>><?=$rows[category_name]?></option>			

		<?
			$bunryu_selected="";
		}
		?>

								
								</td>
      <td align=center width=15% class="title">부분</td>
      <td width=35% bgcolor="#FFFFFF">
								
									  
	<select name=bubun onchange="location.href='<?=$PHP_SELF?>?bbs_no=<?=$bbs_no?>&big_value=<?=$big_value?>&bunryu=<?=$bunryu?>&bubun='+this.options[this.selectedIndex].value" class="select_01">
		 <option value="">==부분선택==</option>	
			<?
			if($bunryu){
				$sql = "select * from jungbo_cate_bunya where parent_num2='$bunryu'";
				$result = mysql_query( $sql,$dbconn ) or err_msg("부분 쿼리오류.");
				for($i=0; $rows = mysql_fetch_array($result); $i++){
					if($rows[seq_num] == $bubun){
						$bubun_selected = "selected";
					}
				?>
					<option value="<?=$rows[seq_num]?>" <?=$bubun_selected?>><?=$rows[category_name]?></option>
				<?
					$bubun_selected="";
				}
			}else{
			?>
			<option value="">==부분선택==</option>	
			<?
			}
			?>
		</select>	  								  
									  </td>
    </tr>


	<tr>
      <td align=center width=15% class="title">지역선택</td> 
      <td width=35% bgcolor="#FFFFFF" colspan=3>
							<select name="sea_area" onChange="javascript:location.href='<?=$PHP_SELF?>?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&bunryu=<?=$bunryu?>&bubun=<?=$bubun?>&bbs_no=<?=$bbs_no?>&item_no=<?=$item_no?>&return=<?=$return?>&firstno=<?=$firstno?>&prevno=<?=$prevno?>&thirdno=<?=$thirdno?>&category_num=<?=$category_num?>&sea_num=<?=$sea_num?>&sung_num=<?=$sung_num?>&khan_num=<?=$khan_num?>&sea_area='+this.value" class="select_01">
								<option value=''>=선택=</option>
								<?
								$sql = "select distinct(sea_area) from category where category_degree='0' order by category_num ";
								$res = mysql_query($sql,$dbconn);
								for($i=0;$row=mysql_fetch_array($res);$i++){
									if($row[sea_area] == $sea_area){
										$sea_selected="selected";
									}
								?>
									<option value="<?=$row[sea_area]?>" <?=$sea_selected?>><?=$row[sea_area]?></option>
								<?
									$sea_selected="";
								}
								?>
								</option>
							</select>

							<select name="sung_area" onChange="javascript:location.href='<?=$PHP_SELF?>?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&bunryu=<?=$bunryu?>&bubun=<?=$bubun?>&bbs_no=<?=$bbs_no?>&item_no=<?=$item_no?>&return=<?=$return?>&firstno=<?=$firstno?>&prevno=<?=$prevno?>&thirdno=<?=$thirdno?>&category_num=<?=$category_num?>&sea_num=<?=$sea_num?>&sung_num=<?=$sung_num?>&khan_num=<?=$khan_num?>&sea_area=<?=$sea_area?>&sung_area='+this.value" class="select_01">
								<option value=''>=선택=</option>
								<?
								$sql = "select distinct(sung_area) from category where category_degree='1' and sea_area='$sea_area' order by category_num ";
								$res = mysql_query($sql,$dbconn);
								for($i=0;$row=mysql_fetch_array($res);$i++){
									if($row[sung_area] == $sung_area){
										$sung_selected="selected";
									}
								?>
									<option value="<?=$row[sung_area]?>" <?=$sung_selected?>><?=$row[sung_area]?></option>
								<?
									$sung_selected="";
								}
								?>
								</option>
							</select>

							<select name="khan_area" class="select_01">
								<option value=''>=선택=</option>
								<?
								$sql = "select distinct(khan_area),khan_area from category where category_degree='2' and sea_area='$sea_area' and sung_area='$sung_area' order by category_num ";
								$res = mysql_query($sql,$dbconn);
								for($i=0;$row=mysql_fetch_array($res);$i++){
									if($row[khan_area] == $khan_area){
										$khan_selected="selected";
									}
								?>
									<option value="<?=$row[khan_area]?>" <?=$khan_selected?>><?=$row[khan_area]?></option>
								<?
									$khan_selected="";
								}
								?>
								</option>
							</select>	  
								</td>
	</tr>






<?
if($_SESSION["MemberLevel"] == 3){//칸은 승인대기상태 검색기능 넣기
?>
     <tr>
      <td align=center width=15% class="title">정보구분</td> 
        <td width=35% bgcolor="#FFFFFF">
			<select name="jungbo_gubun" class="select_01">
				<option value="">=선택=</option>
				<option value="sell">판매정보</option>
				<option value="buy">구입정보</option>
			</select>		</td>
       <td align=center width=15% class="title">기타</td> 
        <td width=35% bgcolor="#FFFFFF">
			<input type=checkbox name="my_search" value='y'>내회원 정보검색&nbsp;
			<input type=checkbox name="daegi_search" value='y'>승인대기검색		</td>
	</tr>
<?}else{?>
     <tr>
      <td align=center width=15% class="title">정보구분</td> 
        <td width=35% bgcolor="#FFFFFF" colspan=3>
			<select name="jungbo_gubun" class="select_01">
				<option value="">=선택=</option>
				<option value="sell" <?if($jungbo_gubun=="sell"){echo "selected";}?>>판매정보</option>
				<option value="buy" <?if($jungbo_gubun=="buy"){echo "selected";}?>>구입정보</option>
			</select>		</td>
    </tr>
<?}?>






	<tr>
      <td align=center width=15% class="title">관련검색어</td>
      <td width=35% bgcolor="#FFFFFF" colspan="<?php echo $my_list=="y"?"":"3";?>"><input type='text' name='searchword' value='<?=$searchword?>' class='input_03' size='15'>	  </td>
	  <?php
		//정보등록내역보기일 때 월별검색이 보여줄 수 있게
		if($my_list=="y"){
		?>
	  <td align=center width=15% class="title">월별검색</td> 
      <td width=35% bgcolor="#FFFFFF">
		<?php
			$year=date("Y")-4;
			
		?>
		<select name="year_search">
			<option value="">년도</option>
			<?php
				for($i=$year;$i<=date("Y");$i++){
			?>
			<option value="<?php echo $i?>"<?php echo $i==$year_search?" selected":"";?>><?php echo $i?>년</option>
			<?php }?>
		</select>

		<select name="month_search">
			<option value="">월별검색</option>
			<?php
				
				for($i=1;$i<=12;$i++){
					$month=$i<10?"0".$i:$i;
			?>
				<option value="<?php echo $month?>"<?php echo $month_search==$month?" selected":"";?>><?php echo $month?>월</option>
			<?php }?>
		</select>
      </td>
	  <?php }?>
    </tr>
    <tr>
    <td align=center width=15% class="title">날짜</td>
        <td width=35% bgcolor="#FFFFFF">
            <input type='date' name='write_date_start' value='<?=$write_date_start?>' class='input_03' size='15'>~
            <input type='date' name='write_date_end' value='<?=$write_date_end?>' class='input_03' size='15'>
        </td>
    <td align=center width=15% class="title">가격</td>
    <td width=35% bgcolor="#FFFFFF">
    <input type='text' name='price' value='<?=$price?>' class='input_03' size='15'> 원</td>
</tr>

</table></div>
<br>
<div align=center>
<input type='image' src='../image/bu_search3.gif' hspace='10' border='0' align='absmiddle' onfocus='blur();'> <a href='<?=$PHP_SELF?>?&bbs_no=<?=$bbs_no?>&page=<?=$page?>'><img src='../image/bu_cancel2.gif' border='0' align='absmiddle' onfocus='blur();'></a>


</div>
						

</form>
<!---------------------- 검색 끝 -------------------------------------------------------->

<?

	// 리스트 스킨 불러오기
	if($list_type == "NL")
		if($bbs_no == 8){
			//include "board_list_skin_event.php";
			include_once "board_list_skin.php";
		}else{
			include_once "board_list_skin.php";
		}
	

	elseif($list_type == "GT")
		include_once "gallery_thumbnail_skin.php";
	elseif($list_type == "GL")
		include_once "gallery_thumbnail_skin.php";
?>
						<br>
<?
}
?>
<!---------------------- 페이징 시작 ---------------------------------------------------->
						<table width='100%'  border='0' cellspacing='0' cellpadding='0' align="center">
							<tr height='50'>
								<td align='center'>
<?
if($page == 1){
?>
									<img src='../image/helpdesk/arrow_1_big.gif' align='absmiddle' border='0'>
<?
}else{
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>&bunryu=<?=$bunryu?>&searchword_area1=<?=$searchword_area1?>&searchword_area2=<?=$searchword_area2?>'><img src='../image/helpdesk/arrow_1_big.gif' align='absmiddle' border='0'></a>
<?
}
?>
<?
if($start_page > 1){
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>&bunryu=<?=$bunryu?>&searchword_area1=<?=$searchword_area1?>&searchword_area2=<?=$searchword_area2?>'><img src='../image/helpdesk/arrow_1.gif' align='absmiddle' border='0'></a>
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
									<span class="page_num"><?=$i?></span>
<?
	}else{
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>&bunryu=<?=$bunryu?>&searchword_area1=<?=$searchword_area1?>&searchword_area2=<?=$searchword_area2?>'><?=$i?></a>
<?
	}
}
?>
<?
if($end_page < $total_page){
?>
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>&bunryu=<?=$bunryu?>&searchword_area1=<?=$searchword_area1?>&searchword_area2=<?=$searchword_area2?>'><img src='../image/helpdesk/arrow_2.gif' align='absmiddle' border='0'></a>
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
									<a href='board_list.php?bbs_no=<?=$bbs_no?>&mart_id=<?=$mart_id?>&page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&my_list=<?=$my_list?>&bunryu=<?=$bunryu?>&searchword_area1=<?=$searchword_area1?>&searchword_area2=<?=$searchword_area2?>'><img src='../image/helpdesk/arrow_2_big.gif' align='absmiddle' border='0'></a>
<?
}else{
?>
									<img src='../image/helpdesk/arrow_2_big.gif' align='absmiddle' border='0'>
<?
}
?>
								</td>
							</tr>
                            <tr>
                            	<td align="right"><?=$write_img?></td>
                            </tr>
</table>
<!---------------------- 페이징 끝 ------------------------------------------------------>
<!---------------------- 게시판 끝 ------------------------------------------------------>
</div><?
if( $bottom_body ){
	//include "$bottom_body";
}
if( $tailhtml ){
	echo "<br>$tailhtml";
}
?>
<script>
<!-- 
var arrItems1 = new Array(); 
var arrItemsGrp1 = new Array(); 


<?php
//$SQL="SELECT * FROM category where category_degree='1'";
$SQL = "select * from category where category_degree='1' group by sung_area order by category_num ";
$result = mysql_query($SQL, $dbconn);
while($rows=mysql_fetch_array($result)){
$i="$rows[sung_num]"; //그룹고유번호
$cont="$rows[sung_area]"; 
printf("arrItems1[\"$i\"] = \"$cont\"; \n");
printf("arrItemsGrp1[\"$i\"] = \"$rows[sea_area]\"; \n");
}
?>

var arrItems2 = new Array(); 
var arrItemsGrp2 = new Array(); 

<?php
$SQL1 = "select * from category where category_degree='2' group by khan_area order by category_num ";
$result1 = mysql_query($SQL1, $dbconn);
while($rows1=mysql_fetch_array($result1)){
$i="$rows1[khan_num]"; //그룹고유번호
$cont1="$rows1[khan_area]";
printf("arrItems2[$i] = \"$cont1\"; \n");
printf("arrItemsGrp2[$i] = \"$rows1[sung_num]\"; \n"); //부모그룹고유번호랑 $rows1[prevno]랑 일치해야함
$i++;
}
?>

var arrItems3 = new Array(); 
var arrItemsGrp3 = new Array(); 

<?php
$SQL3="SELECT * FROM category where category_degree='3'";
$result3 = mysql_query($SQL3, $dbconn);
$i=1;
while($rows3=mysql_fetch_array($result3)){
$cont3="$rows3[category_name]";
printf("arrItems3[$i] = \"$cont3\"; \n");
printf("arrItemsGrp3[$i] = \"$rows3[prevno]\"; \n"); //부모그룹고유번호랑 $rows1[prevno]랑 일치해야함
$i++;
}
?>

function selectChange(control, controlToPopulate, ItemArray, GroupArray) 
{ 
var myEle ; 
var x ; 
for (var q=controlToPopulate.options.length;q>=0;q--) controlToPopulate.options[q]=null; 
if (control.name == "firstChoice") { 
for (var q=myChoices.thirdChoice.options.length;q>=0;q--) myChoices.thirdChoice.options[q] = null; 
} 
myEle = document.createElement("option") ; 
myEle.value = 0 ; 
myEle.text = "=선택=" ; 
controlToPopulate.add(myEle) ; 
for ( x = 0 ; x < ItemArray.length ; x++ ) 
{ 
if ( GroupArray[x] == control.value ) 
{ 
myEle = document.createElement("option") ; 
myEle.value = x ; 
myEle.text = ItemArray[x] ; 
controlToPopulate.add(myEle) ; 
} 
} 
} 
//--> 
</script>
</body>
</html>
<?
mysql_close($dbconn);
?>