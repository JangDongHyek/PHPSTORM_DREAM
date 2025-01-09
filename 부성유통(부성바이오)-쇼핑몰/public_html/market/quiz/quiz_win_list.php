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
      	<?
      	$today = date("Ymd");
		$SQL = "select * from $QuizTable where mart_id='$mart_id' and quiz_no = $quiz_no";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			mysql_data_seek($dbresult, 0);
			$ary=mysql_fetch_array($dbresult);
			$quiz_no = $ary["quiz_no"];
			$mart_id = $ary["mart_id"];
			$from_date = $ary["from_date"];
			$from_date_str = substr($from_date,0,4)."/".substr($from_date,4,2)."/".substr($from_date,6,2);
			$to_date = $ary["to_date"];
			$to_date_str = substr($to_date,0,4)."/".substr($to_date,4,2)."/".substr($to_date,6,2);
			$quiz_question = $ary["quiz_question"];
			$correct_answer_no = $ary["correct_answer_no"];
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
		
			if($correct_answer_no == 1) $answer = $answer1;
			if($correct_answer_no == 2) $answer = $answer2;
			if($correct_answer_no == 3) $answer = $answer3;
			if($correct_answer_no == 4) $answer = $answer4;
			if($correct_answer_no == 5) $answer = $answer5;
			if($correct_answer_no == 6) $answer = $answer6;
			if($correct_answer_no == 7) $answer = $answer7;
			if($correct_answer_no == 8) $answer = $answer8;
			if($correct_answer_no == 9) $answer = $answer9; 
		}
		?>
		<tr>
        	<td width="100%">
        		<div align="center"><center>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="100%" bgcolor="#808080" height="2"></td>
          		</tr>
          		<tr>
            		<td width="100%" align="center" height="22">
            			<p align="center">
            			<span class="aa">문 &nbsp; 제</span>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" background="../images/left_dot.gif"></td>
          		</tr>
          		<tr>
            		<td width="100%" height="20" align="center">
            		
            			<table border="0" width="90%">
              			<tr>
                			<td width="100%"><span class="bb">[<?=$date_str?>]
                			 	<?=$quiz_question?>
                			 	<br>
                				<br>
                				정답 : <?=$correct_answer_no?> 번 <?=$answer?></span>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
          		<?
          		$SQL = "select * from $Quiz_ApplyTable where mart_id = '$mart_id' and quiz_no = '$quiz_no' and if_win = 't' order by quiz_apply_no desc";
              	//echo "sql=$SQL";
              	$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				?>
				<tr>
            		<td width="100%" height="1" align="center" bgcolor="#C0C0C0"><span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="100%" height="20" align="center"><span class="bb">당첨자 : 총 <?=$numRows?> 명</span></td>
          		</tr>
          		<tr>
            		<td width="100%" height="1" align="center" bgcolor="#C0C0C0"><span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="100%" height="10" align="center" bgcolor="#FFFFFF"><span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="100%" height="20" align="center">
            		
            			<table border="0" width="300" cellpadding="4">
              			<tr>
                			<td width="63" align="center" bgcolor="#BEDEDE"><span class="bb">번호</span></td>
                			<td width="119" bgcolor="#BEDEDE" align="center"><span class="bb">ID</span></td>
                			<td width="94" bgcolor="#BEDEDE" align="center"><span class="bb">성명</span></td>
              			</tr>
              			<?
              			for ($i=0; $i<$numRows; $i++) {
							mysql_data_seek($dbresult,$i);
							$ary = mysql_fetch_array($dbresult);
							$quiz_apply_no = $ary["quiz_apply_no"];
							$mart_id = $ary["mart_id"];
							$quiz_no = $ary["quiz_no"];
							$answer_no = $ary["answer_no"];
							$username = $ary["username"];
							$name = $ary["name"];
							
							$if_win = $ary["if_win"];
							$write_date = $ary["write_date"];
							
							$j = $i + 1;
							if($i % 2 == 0){              				
              					echo ("
              			<tr>
                			<td width='63' align='center' bgcolor='#F3F3F3'><span class='bb'>$j</span></td>
                			<td width='119' bgcolor='#F3F3F3'><span class='bb'>$username</span></td>
                			<td width='94' bgcolor='#F3F3F3'><span class='bb'>$name</span></td>
              			</tr>
              					");
              				}
              				if($i % 2 == 1){              				
          						echo ("
          				<tr>
                			<td width='63' align='center' bgcolor='#EBEBEB'><span class='bb'>$j</span></td>
                			<td width='119' bgcolor='#EBEBEB'><span class='bb'>$username</span></td>
                			<td width='94' bgcolor='#EBEBEB'><span class='bb'>$name</span></td>
              			</tr>
              					");
              				}
            			}
              			?>
              			</table>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" height="22"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="22">
            			<p align="center">
            			<input class="bb" onclick="window.location.href='quiz_list.php?mart_id=<?=$mart_id?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="이전화면">
            		</td>
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