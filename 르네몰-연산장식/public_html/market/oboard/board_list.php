<?
$it_board_row = 10;			//  열수
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
			$result = mysql_query("select * from $board where code='$code_url' order by thread desc,thread2 asc,pos asc limit $start,$it_board_row");
	}else{
		$data = explode(",",$check_array);
		$where = search_create($data,$search_word);

		$result = mysql_query("select * from $board $where and code='$code_url' order by thread desc,thread2 asc,pos asc limit $start,$it_board_row");
	}

	db_error($result,"데이터질의문 오류");

	$total_list = mysql_num_rows($result);

	if($total_list >= $it_board_row) $IsNext = ($page == $total_page)? 0:1;
}


	$colspan1="6";
	$colspan2="6";

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function Scheck_box(Num)
{
	var ck_data=new Array();
	var ck_num=0;

	for(var i=0; i < Num;i++){
		var ck_box=eval("document.all.checkbox"+i);

		if(ck_box.checked == true){
			ck_data[ck_num]=ck_box.value;
			ck_num++;
		}
	}
	if(ck_num=="0"){
		alert("성함을 선택하셔야 합니다.");
		return;
	}
	document.all.check_array.value=ck_data;
	it.submit();
}

//Enter key control
function word_box()
{
	if(event.keyCode == 13){
		event.returnValue=false;
		Scheck_box(1);
	}
}
//-->
</SCRIPT>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<form name="it" method="post">
<input type="hidden" name="check_array">
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="90%"><img src="../images/oboard_title.gif" width="673" height="88" /></td>
      </tr>
    </table>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr bgcolor="CFCFCF"> 
                <td height="2" colspan="<?=$colspan2?>" align="center"></td>
      </tr>
              <tr> 
                <td width="30" height="30" align="center"> 
                  번호</td>
                <td align="center" width="93"> 
                 성명</td>
                <td align="center" width="120"> 
                 제품분류</td>
                  <td align="center" width="80"> 
                 기본수량</td>
                <td align="center" width="100"> 
                 연락처</td>
							<td width="253" align="center"> 
                 접수일</td>
              </tr>
			<tr bgcolor="CFCFCF"> 
                <td height="2" colspan="<?=$colspan2?>" align="center"></td>
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
		$reserv_date = explode("/",$ans[reserv_date]);
		if($reserv_date[3] == "1"){
			$reserv_date_am = "오전";
		}else{
				$reserv_date_am = "오후";
		}
########################################### board_type board #######################################
		if($board_type == "board"){
?>
					<tr> 
						<td height="28" align="center"> 
						<!--번호 데이타-->
						<?=$row_num?></td>
						<td align="center">
						<a href='#' title="<?=$ans[body]?>"><font face=굴림 color='#666666'>
						<a href='<?=$code_url?>?set=view&board=<?=$board?>&uid=<?=$ans[0]?>&opti_ex=<?=$ans[9]?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&page_num=<?=$row_num?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><font face=굴림 color='#666666'><?=$ans[reserv_name]?></a>	</a>				
						</td>
						<td align="center">
						<?=$ans[reserv_bunryu]?>
						</td>
						<td align="center">
						<?=$ans[reserv_gibonnum]?>
						</td>
						<td align="center">
						<?=$ans[reserv_phone]?>
						</td>
						<td align="center"> 
						<?=$ans[reg_date]?>
					  </td>						
					</tr>
					<tr bgcolor="CFCFCF"> 
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
							  <a href='<?=$code_url?>?set=list&board=<?=$board?>&page=1&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><img src="../oboard/images/table_bt_left2.jpg" width="17" height="14" border="0"></a>				  
							  <?
								if($block > 1){
									$pre_block=$first_page;
							   ?>	
									<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$pre_block?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><font color=\"#6699CC\"><img src="../oboard/images/table_bt_left1.jpg" width="13" height="14" border="0"> </font></a>
								<?
								}else{
								?>
									<font color=\"#6699CC\"><img src="../oboard/images/table_bt_left1.jpg" width="13" height="14" border="0"> </font>
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
									<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$my_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'> <font color=\"#6699CC\"><img src="../oboard/images/table_bt_right1.jpg" width="13" height="14" border="0"></font></a>
								<?
								}else{
								?>
								 <font color=\"#6699CC\"><img src="../oboard/images/table_bt_right1.jpg" width="13" height="14" border="0"></font>
								<?
								}
								?>
								<a href='<?=$code_url?>?set=list&board=<?=$board?>&page=<?=$total_page?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><img src="../oboard/images/table_bt_right2.jpg" width="17" height="14" border="0"></a>
							  </td>
							</tr>
						  </table>                  
				  <!--페이지 표시 테이블 끝 -->
				</td>
				<td width="335">
                  <!--검색 테이블 시작 -->
				  <table width="270" border="0" cellspacing="0" cellpadding="0" align="right">
                    <tr> 
                      <td width="27" align="center"><input type="checkbox" name="checkbox0" value="reserv_name" checked></td>
                      <td width="30" align="center">성함</td>
                      <td width="170" align="center"> <input name="search_word" type="text" size="16" maxlength="18" onkeypress="word_box()"></td>
                      <td width="64"><a href="#">
                        <!--검색버튼 -->
                        <img src="../oboard/images/table_bt_search.jpg" width="41" height="19" border="0" onclick="Scheck_box(1)"></a></td>
						<?				
						if ($HTTP_COOKIE_VARS[BEAUTYE_GRADE] == "3"){
						?>
						<td width="90" height="35" align="right">
							<a href="<?=$code_url?>?board=<?=$board?>&set=write"> 
							<img src="../oboard/images/table_bt_write.jpg" width="71" height="17" border="0"></a>						</td>
						<?
						}
						?>
                    </tr>
                  </table>
                  <!--검색 테이블 끝 -->
				</td>
             </tr>
            </table>
</form>














