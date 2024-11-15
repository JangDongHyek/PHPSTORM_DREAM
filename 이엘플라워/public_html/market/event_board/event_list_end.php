<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
include "../include/getmartinfo.php";
include "../include/head_alltemplate.php";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function event_view(event_no){
	document.main.location.replace("./event_view.php?mart_id=<?=$mart_id?>&event_no="+event_no);	
}
//-->
</SCRIPT>
<!-- 트렉스타 임시 leftmenu 템플릿 처리(?) 04-07-30 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">

	<table width="960" border="0" cellspacing="0" cellpadding="0">
	  <tr>
    <td width="160" valign="top"><table width="140" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="../event_board/event_list.php?mart_id=<?=$mart_id?>"><img src='../images/template6/image/event/menu_1.gif' border='0' align='absmiddle'></a></td>
      </tr>
      <tr>
        <td><a href="../event_board/event_list_end.php?mart_id=<?=$mart_id?>"><img src='../images/template6/image/event/menu_2.gif' border='0' align='absmiddle'></a></td>
      </tr>
	
    </table>
	 
<?    
include "../include/left_content_trek.php";
?>	 

	 </td>
<!-- 트렉스타 MEMBER 임시leftmenu 템플릿 처리(?) 04-07-30 -->



<td width="<?echo $right_width?>" valign="top" bgcolor='#ffffff'>

<!-- 현재위치 -->
      <table width="796" border="0" cellpadding="0" cellspacing="0">
      <tr>
          <td height="30" background="../images/search_bg.gif" class="text_left"><img src="../images/nevigation_icon.gif" width="17" height="14" align="absmiddle"><a href='../main/index.php?mart_id=<?=$mart_id?>'>트렉스타쇼핑몰 홈</a> &gt; <b>이벤트</b></td>
          </tr>
        <tr>
          <td height="10" colspan="2" bgcolor="FFFFFF"></td>
        </tr>
      </table>
<!-- 현재위치 -->

      <table width="760" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
          <td><img src="../images/template6/image/event/subtitle_2.gif"></td>
        </tr>
      </table>

    	
   	<table border="0" width="100%" cellpadding="0" cellspacing="0">
      	<tr>
        	<td width="100%" height="10"></td>
      	</tr>
<!-- 
        <tr>
          <td align="center"><img src="../images/template6/image/mypage/help_img.gif" width="630" height="130" border="0" usemap="#Map"></td>
        </tr> -->
<!-- 
게시판 제목 부분
      	<tr>
        	<td width="100%" height="20"><br>
        		<?
	  			$SQL = "select bbs_no,board_title,board_type from $New_BoardConfigTable where mart_id='$mart_id' order by bbs_order desc";
						
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				for ($i=0; $i<$numRows; $i++) {
					$bbs_no_temp = mysql_result($dbresult,$i,0);
					$board_title_temp = mysql_result($dbresult,$i,1);
					$board_type = mysql_result($dbresult,$i,2);
					
					if(!isset($bbs_no) || ($bbs_no == ""))
						$bbs_no = $bbs_no_temp;				
	  				if($bbs_no == $bbs_no_temp){
	  					echo ("
	  					<img src='../images/board-icon1.gif' align='absmiddle' WIDTH='12' HEIGHT='12'> 
        				<strong><span class='bb'>$board_title_temp</span></strong>&nbsp;
        				");
          			}
          			else{
          				if($board_type == '')
          				echo ("
          				<img src='../images/board-icon1.gif' align='absmiddle' WIDTH='12' HEIGHT='12'> 
        				<a href='notice_list.php?mart_id=$mart_id&bbs_no=$bbs_no_temp'>
        				<span class='bb'>$board_title_temp</span></a>
        					");
        					else if($board_type == '1')
        					echo ("
          				<img src='../images/board-icon1.gif' align='absmiddle' WIDTH='12' HEIGHT='12'> 
        				<a href='../car_board/notice_list.php?mart_id=$mart_id&bbs_no=$bbs_no_temp'>
        				<span class='bb'>$board_title_temp</span></a>
        					");
        					
          			}
          		}
          		?>	
		    </td>
      	</tr>
 -->
      	<tr>
        	<td width="100%">			
        		<table cellSpacing="0" cellPadding="0" width="100%" border="0">
          		<tr>
            		<td width="100%">            			
           			 <table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="1" colspan="5" bgcolor="CECECE"></td>
        </tr><tr bgcolor="#F5F5F5">
          <td height="30" align="center" bgcolor="EDEDED"><img src="../images/template6/image/event/type_1.gif" width="50" height="30"></td>
          <td width="1"><img src="image/event/table_line.gif" width="1" height="30"></td>
          <td width="199" align="center" bgcolor="EDEDED"><img src="../images/template6/image/event/type_2.gif" width="50" height="30"></td>
          <td width="1"><img src="image/event/table_line.gif" width="1" height="30"></td>
          <td width="200" align="center" bgcolor="EDEDED"><img src="../images/template6/image/event/type_3.gif" width="50" height="30"></td>
          </tr> 
			 <tr>
				 <td height='1' colspan='5' bgcolor='CECECE'></td>
			  </tr>

<?
$today = date("Y-m-d");
//$SQL = "select * from $EventboardTable where mart_id='$mart_id' and ( (start_date < '$today') and ('$today' > end_date))  and list_chk='Y' order by event_no desc";
$SQL = "select * from $EventboardTable where mart_id='$mart_id' and '$today' > end_date and list_chk='Y' order by event_no desc";
//echo $SQL;
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($cnfPagecount == "") $cnfPagecount = 10;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

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

for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
if ($i >= $numRows) break;
mysql_data_seek($dbresult, $i);
$ary=mysql_fetch_array($dbresult);
if($i == $skipNum)
	$event_no_s = $ary["event_no"];

$event_no = $ary["event_no"];
$title = $ary["title"];
$title1 = $ary["title1"];
$write_date = $ary["write_date"];
$content = $ary["content"];
$readnum = $ary["readnum"];
$msg_head = $ary["msg_head"];
$start_date = $ary["start_date"];
$end_date = $ary["end_date"];

$this_date = date("Y-m-d");
if($this_date >= $start_date && $this_date <= $end_date){
	$date_str =  "<font color='#00CC00'>$start_date ~ $end_date</font>";
}else{
	$date_str =  "<font color='#FF6600'>$start_date ~ $end_date</font";
}

$write_date_str = substr($write_date,0,10);
$j = $numRows - $i;
			  				
			  				echo ("<tr>
											 <td class='text_left'><a href='javascript:event_view($event_no)'><span class='style10'>$title</span></a></td>
											 <td><img src='image/mypage/help_line2.gif' width='1' height='30'></td>
											 <td align='center' >$date_str</td>
											 <td><img src='image/mypage/help_line2.gif' width='1' height='30'></td>
											 <td align='center'>$title1 </td>
											 </tr>
												 <tr>
											 <td height='1' colspan='5' bgcolor='CECECE'></td>
										  </tr>");
/*

		<tr>
          <td align='center'>$j</td>
          <td><img src='../images/template6/image/mypage/help_line2.gif' width='1' height='30'></td>
          <td class='text_left style9'><a href='notice_view.php?mart_id=$mart_id&event_no=$event_no'>$msg_head $title</a></td>
          <td><img src='../images/template6/image/mypage/help_line2.gif' width='1' height='30'></td>
          <td align='center'>$write_date_str</td>
          <td><img src='../images/template6/image/mypage/help_line2.gif' width='1' height='30'></td>
          <td align='center'>$readnum</td>
        </tr>");
              				
              				if(($i + 1) < ($cnfPagecount+$skipNum) && ($i + 1 <= $numRows)){ 
              					echo ("<tr><td height='1' colspan='9' bgcolor='CECECE'></td></tr>");
			      			}
*/
			      		}

			      		?>
		</table>

	  <table width="760" border="0" align="center" cellpadding="0" cellspacing="0">

<form action='notice_list.php' method="POST">
<input type="hidden" name="page" value="1">
<input type="hidden" name="mart_id" value="<?echo $mart_id?>">
<input type="hidden" name="bbs_no" value="<?echo $bbs_no?>">
        <tr>
          <td width="360" height="50"><!-- 		  
		  <select class="bb" name="keyset" style="font-size: 9pt; background-color: rgb(255,255,255); padding-left: 0; padding-right: 0; padding-top: -1; padding-bottom: -1" size="1">
            <option value="writer">작성자</option>
			<option value="subject_new">제목</option>
			<option value="content">내용</option>
			<option value="all">전체</option>
          </select>
            <input name="searchword" type="text" class="input_search" size="20">
            <input type="image" src="../images/template6/image/mypage/bu_search.gif" width="35" height="20" align="absmiddle"> --></td>
          <td width="400" align="center">
<!-- 페이징 -->		  
<?
if($page == 1){
	echo ("
	처음
	");
}
else{
	echo ("
	<a href='notice_list.php?bbs_no=$bbs_no&mart_id=$mart_id&page=1&keyset=$keyset&searchword=$searchword'>처음</a> 
	");
}

if($start_page > 1){
	echo ("
	<a href='notice_list.php?bbs_no=$bbs_no&mart_id=$mart_id&page=$prev_start_page&keyset=$keyset&searchword=$searchword'>
	<img src='../images/template6/image/mypage/pre.gif' width='40' height='30' align='absmiddle' border='0'>&nbsp; 
	</a>
	");
}
else{
	echo ("
	<img src='../images/template6/image/mypage/pre.gif' width='40' height='30' align='absmiddle' border='0'>&nbsp; 
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
	<a href='notice_list.php?bbs_no=$bbs_no&mart_id=$mart_id&page=$i&keyset=$keyset&searchword=$searchword'>$i</a> 	
		");
	}
}
if($end_page < $total_page){
	echo ("
	<a href='notice_list.php?bbs_no=$bbs_no&mart_id=$mart_id&page=$next_start_page&keyset=$keyset&searchword=$searchword'>
	&nbsp;<a href='notice_list.php?bbs_no=$bbs_no&mart_id=$mart_id&page=$total_page&keyset=$keyset&searchword=$searchword'>
	</a>
	");
}
else{
	echo ("
	&nbsp;<img src='../images/template6/image/mypage/next.gif' width='40' height='30' align='absmiddle' border='0'>
	");
}
if($page == $total_page){
	echo ("
	끝
	");
}
else{
	echo ("
	<a href='notice_list.php?bbs_no=$bbs_no&mart_id=$mart_id&page=$total_page&keyset=$keyset&searchword=$searchword'>끝</a> 
	");
}
?>
<!-- 페이징 -->		  
		  </td>
        </tr>
</form>

<script>
function resize(element, minWidth, minHeight)
{
        var objFrame = element;
        var objBody     = eval(element.id+'.document.body');
		
		// 가로 리사이즈
		if (objFrame.style.width != minWidth)
                objFrame.style.width = minWidth;

        if (objBody.scrollWidth + (objBody.offsetWidth - objBody.clientWidth) > minWidth)
                objFrame.style.width = objBody.scrollWidth + (objBody.offsetWidth - objBody.clientWidth);
		
		// 세로 리사이즈
        if (objFrame.style.height != minHeight)
                objFrame.style.height = minHeight;

        if (objBody.scrollHeight + (objBody.offsetHeight - objBody.clientHeight) > minHeight)
                objFrame.style.height = objBody.scrollHeight + (objBody.offsetHeight - objBody.clientHeight);
}
</script>

<!-- 이벤트 내용 -->
		  <tr>
			<td colspan="2">
			<iframe src="./event_view.php?mart_id=<?=$mart_id?>&event_no=<?=$event_no_s?>"  id="main" name="main" onload="resize(this, 760, 200);" width="760" height="100%" scrolling=no frameborder=0  marginheight=0 marginwidth=0 border=0></iframe>
			</td>
		  </tr>
<!-- 이벤트 내용 -->


	</table>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</td></tr></table>

<map name="Map">
  <area shape="circle" coords="534,80,40" href="board_write.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>" onfocus="blur()">
</map>
<?
include( '../include/bottom.inc' );
mysql_close($dbconn);
?>
</body>
</html>
