<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

include( '../include/getmartinfo.php' );	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<title><?=$page_title?></title>
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 
</head>

<?
if(strstr($icon_module,"icon7")!=false || strstr($icon_module,"icon8")!=false){
	if(strstr($icon_module,"icon7")!=false){
		if($top_out_img != "") $tmp_body_background = "$Co_img_DOWN$mart_id/design2/$top_out_img";
		else $tmp_body_background == "";
		echo ("
<body topmargin='0' bgcolor='$top_out_color' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD' background='$tmp_body_background'>
		");
	}
	else {
		if($top_out_img != "") $tmp_body_background = "$Co_img_DOWN$mart_id/design2/temp2/$top_out_img";
		else $tmp_body_background == "";
		echo ("
<body topmargin='0' bgcolor='$top_out_color' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD' background='$tmp_body_background'>
		");
	}
}
if(strstr($icon_module,"icon9")!=false){
	// 탑메뉴 배경이미지
	if($top_bg_img_all != "") $tmp_background = "$Co_img_DOWN$mart_id/design2/temp3/$top_bg_img_all";
	else $tmp_background = "";
	echo ("
<body topmargin='0' bgcolor='$top_bg_color_all' background='$tmp_background' link='#CECBCE' vlink='#CECBCE' alink='#CECBCE' leftmargin='0'>
	");
}
if(strstr($icon_module,"icon10")!=false){
	if($top_bg_color_all != "") $tmp_top_bg_color_all = $top_bg_color_all;
	else{
		if($icon_module == 'icon10_1') $tmp_top_bg_color_all = "#E3E3E3";
		if($icon_module == 'icon10_2') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_3') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_4') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_5') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_6') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_7') $tmp_top_bg_color_all = "#E3E3E3";
		if($icon_module == 'icon10_8') $tmp_top_bg_color_all = "#E0EEFC";
		if($icon_module == 'icon10_9') $tmp_top_bg_color_all = "#9A9A9A";
		if($icon_module == 'icon10_10') $tmp_top_bg_color_all = "#9A9A9A";
	}
	if($top_bg_img_all != "") $tmp_top_bg_img_all = "$Co_img_DOWN$mart_id/design2/temp4/$top_bg_img_all";
	else $tmp_top_bg_img_all = "../images/template4/$icon_module/bg.gif";
	echo ("
	<body bgcolor='$tmp_top_bg_color_all' topmargin='0' link='#000000' vlink='#000000' alink='#000000' background='$tmp_top_bg_img_all'>
	");
}
if(strstr($icon_module,"icon11")!=false){
	echo ("
<body $leftmargin_str topmargin='0' bgcolor='$top_out_color' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD' background='$Co_img_DOWN$mart_id/design2/temp5/$top_out_img'>
	");
}
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon9")!=false) {
	if($onestep != 10) include( '../include/topmenu_template3.inc' );
	else include( '../include/topmenu_template3_1024.inc' );
}
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
?>
<table border="0" width="<?=$middle_width?>" cellspacing="0" cellpadding="0">
<tr>
    <?
	if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
	if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
	if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
	if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
	if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
	?>
	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        	<?
        	if($ti_quiz2_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_quiz2_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_quiz2_img' WIDTH='171' HEIGHT='27'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/quiz2-title.gif' WIDTH='171' HEIGHT='27'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
        	<?
        	if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/line.gif' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"><span class="aa"></span></td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="100%" bgcolor="#808080" height="2" colspan="3"></td>
          		</tr>
          		<tr>
            		<td width="7%" align="center" height="22"><p align="center"><span class="aa">번호</span></td>
            		<td width="72%" height="22" align="center"><span class="aa">문제</span></td>
            		<td width="21%" height="22" align="center"><span class="aa">비고</span></td>
          		</tr>
          		<tr>
            		<td width="100%" background="../images/left_dot.gif" colspan="3"></td>
          		</tr>
          		<?
          		$today = date("Ymd");
          		$SQL = "select * from $QuizTable where mart_id='$mart_id' order by quiz_no desc";
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
					$quiz_no = $ary["quiz_no"];
					$mart_id = $ary["mart_id"];
					$from_date = $ary["from_date"];
					$to_date = $ary["to_date"];
					$quiz_question = $ary["quiz_question"];
					$currect_answer_no = $ary["currect_answer_no"];
					$quiz_explain = $ary["quiz_explain"];
					$date = $ary["date"];
					$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
					$answer1 = $ary["answer1"];
					$answer2 = $ary["answer2"];
					$answer3 = $ary["answer3"];
					$answer4 = $ary["answer4"];
					$answer5 = $ary["answer5"];
					$answer6 = $ary["answer6"];
					$answer7 = $ary["answer7"];
					$answer8 = $ary["answer8"];
					$answer9 = $ary["answer9"];
					
					$j = $numRows - $i;
					echo ("
				<tr>
            		<td width='7%' height='20' align='center'>
            			<span class='bb'>$j</span></td>
            		<td width='72%' height='20' align='center'>
            			<p align='left'><span class='bb'>
            			[$date_str] $quiz_question</span>
            		</td>
            		<td width='21%' height='20' align='center'>
            			<span class='bb'>
            		");
            		
            		if(($from_date <= $today) && ($today <= $to_date)){
            			echo ("진행중");
            		}
            		else{
            			echo ("
            		<input class='bb' onclick=\"window.location.href='quiz_win_list.php?mart_id=$mart_id&quiz_no=$quiz_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px' type='button' value='당첨자보기'>
            			");
            		}
            		echo ("
            			</span>
            		</td>
          		</tr>
          			");
					if($i + 1 < ($cnfPagecount+$skipNum) && $i +1 < $numRows){
						echo ("
				<tr>
            		<td width='100%' height='1' align='center' colspan='3' bgcolor='#C0C0C0'></td>
          		</tr>		");
					}
				
				}
				?>
				<tr>
            		<td width="100%" background="../images/left_dot.gif" colspan="3"></td>
          		</tr>
          		<tr>
            		<td width="100%" height="22" colspan="3">
            			<p align="right">
            			<span class="aa">
            			<?
		        		if($page == 1){
		        			echo ("
		        			처음
		        			");
		        		}
		        		else{
		        			echo ("
		        			<a href='quiz_list.php?mart_id=$mart_id&page=1'>처음</a> 
		        			");
		        		}
		        	
		        		if($start_page > 1){
							echo ("
							<a href='quiz_list.php?mart_id=$mart_id&page=$prev_start_page'>
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
							<a href='quiz_list.php?mart_id=$mart_id&page=$i'>$i</a> 
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='quiz_list.php?mart_id=$mart_id&page=$next_start_page'>
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
		        			<a href='quiz_list.php?mart_id=$mart_id&page=$total_page'>끝</a> 
		        			");
		        		}
		        		?>      
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#808080" height="1" colspan="3"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="22" colspan="3"><p align="center"><br>
            		<input class="bb" onclick="window.location.href='quiz.php?mart_id=<?=$mart_id?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="이전화면"></td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
mysql_close($dbconn);
?>