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

if($flag==""){
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
        	if($ti_quiz1_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_quiz1_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_quiz1_img' WIDTH='130' HEIGHT='29'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/quiz-title.gif' WIDTH='130' HEIGHT='29'>
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
        	<td width="100%" height="10">
        		<p align="right">
        		<a href="quiz_list.php?mart_id=<?=$mart_id?>">
        		<img src="../images/past-quiz.gif" border="0" WIDTH="148" HEIGHT="18"></a>
        	</td>
      	</tr>
      	<?
      	$today = date("Ymd");
		$SQL = "select * from $QuizTable where mart_id='$mart_id' and from_date <= $today and $today <= to_date and if_end = 'f' order by quiz_no desc";
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
			
			$answer1 = $ary["answer1"];
			$answer2 = $ary["answer2"];
			$answer3 = $ary["answer3"];
			$answer4 = $ary["answer4"];
			$answer5 = $ary["answer5"];
			$answer6 = $ary["answer6"];
			$answer7 = $ary["answer7"];
			$answer8 = $ary["answer8"];
			$answer9 = $ary["answer9"];
		?>
		<script>
		function checkform(f) {
			if(f.apply_no.value=="0"){
				alert("\n답변을 선택하셔야 합니다."); 
				return false;
			}
			return true;
		}	
		</script>
		
		<form name = 'quiz_form' onsubmit='return checkform(this)'>
		<input type='hidden' name='flag' value='apply'>
		<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
		<input type='hidden' name='order_no' value='<?=$order_no?>'>
		<input type='hidden' name='quiz_no' value='<?=$quiz_no?>'>
		<input type=hidden name='apply_no' value='0'> 
		
		<tr>
        	<td width="100%" height="10">
        		<div align="center"><center>
        	
        		<table border="0" width="441">
          		<tr>
            		<td width="100%"><span class="bb"><br>
	            		<?=$quiz_explain?><br>
            			응모기간 : <?=$from_date_str?>~<?=$to_date_str?></span>
            		</td>
          		</tr>
        		</table>
        		</center></div><p><br>
        	</td>
		</tr>
    	<tr>
        	<td width="100%">
        		<div align="center"><center>
			        	
        		<table cellspacing="1" background="../images/dot2.gif" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top">
            			<div align="center"><center>
            		
            			<table border="0" width="90%">
              			<tr>
                			<td width="100%" height="5"></td>
              			</tr>
              			<tr>
                			<td width="100%"><span class="aa">
                			<?=$quiz_question?></span><br>
                				<span class="aa">
                				<?
                				if($answer1 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=1\" type='radio'>$answer1<br> 
                					");
                				}
                				if($answer2 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=2\" type='radio'>$answer2<br> 
                					");
                				}
                				if($answer3 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=3\" type='radio'>$answer3<br>  
                					");
                				}
                				if($answer4 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=4\" type='radio'>$answer4<br>  
                					");
                				}
                				if($answer5 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=5\" type='radio'>$answer5<br>  
                					");
                				}
                				if($answer6 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=6\" type='radio'>$answer6<br>  
                					");
                				}
                				if($answer7 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=7\" type='radio'>$answer7<br>  
                					");
                				}
                				if($answer8 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=8\" type='radio'>$answer8<br>  
                					");
                				}
                				if($answer9 != ""){
                					echo ("
                					<input name='answer_no' onclick=\"quiz_form.apply_no.value=9\" type='radio'>$answer9<br>  
                					");
                				}
                				?>
                				</span>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" height="5"><span class="aa"></span></td>
              			</tr>
            			</table>
            			</center></div>
            		</td>
          		</tr>
        		<?
        		}
        		else{
        		?>
        	<tr>
        	<td width="100%">
        		<div align="center"><center>
			        	
        		<table cellspacing="1" background="../images/dot2.gif" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top">
            			<div align="center"><center>
            		
            			<table border="0" width="90%">
              			<tr>
                			<td width="100%" height="5"></td>
              			</tr>
              			<tr>
                			<td width="100%"><span class="aa">
                				</span><br>
                				<span class="aa"><center>
                				현재 진행중인 퀴즈가 없습니다.
                				</center></span><br>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" height="5"><span class="aa"></span></td>
              			</tr>
            			</table>
            			</center></div>
            		</td>
          		</tr>
        		<?	
        		}
        		?>
        		</table>
        		</center></div>
        		<div align="center"><center>
			        	
        		<table cellspacing="1" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top"><p align="center"><br>
            			<br>
            			<span class="zz"><strong>
            			<input class="bb" style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="submit" value="응모">
            			<br>
            			<br>
            			</strong>
            			</span><br>
            		</td>
          		</tr>
        		
        		</form>
        		
        		</table>
        		</center></div>
        	</td>
  		</tr>
    	<tr>
        	<td width="100%"></td>
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
}
if($flag == 'apply'){
	$SQL = "select * from $Quiz_ApplyTable where quiz_no = '$quiz_no' and username='$UnameSess'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	
	if ($numRows > 0) {
		echo ("
		<script>
		alert(\"동일인이 한문제에 대하여 2개이상의 답을 선택할 수 없습니다.\");
		</script>
		");
		echo "<meta http-equiv='refresh' content='0; URL=quiz.php?mart_id=$mart_id'>";
		exit;
	}
	
	$SQL = "select * from $Mart_Member_NewTable where username='$UnameSess' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$name = $ary["name"];
	}

	$SQL = "select max(quiz_apply_no), count(*) from $Quiz_ApplyTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0) 
		$maxQuiz_apply_no = mysql_result($dbresult, 0, 0);
	else
		$maxQuiz_apply_no = 0;
	$date = date("Ymd H:i:s");
	$SQL = "insert into $Quiz_ApplyTable (quiz_apply_no, mart_id, quiz_no, answer_no, username, name, if_win, date )".
	" values ($maxQuiz_apply_no+1, '$mart_id', '$quiz_no', '$apply_no', '$UnameSess', '$name', 'f', '$date')";

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=quiz_thanks.php?mart_id=$mart_id'>";
}
?>
<?
mysql_close($dbconn);
?>