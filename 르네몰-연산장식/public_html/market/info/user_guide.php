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
if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
else include('../include/head_alltemplate.inc');
?>
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
<?
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) include( '../include/topmenu_template6.inc' );

if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) {
?>
<!--검색부분-->
<table width="990" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='<?=$mart_id?>'>
	<tr>
    <td width="30" height="30">&nbsp;</td>
    <td width="500" background="../images/template6/image/top/search_bg.gif" class="text_left"><img src="../images/template6/image/nevigation_icon.gif" width="17" height="14" align="absmiddle">
    홈 &gt; 이용안내
    </td>
    <td width="460" align="right" background="../images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="../images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--검색부분끝-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--타이들이미지 시작-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="../images/template6/image/product/title_bg.gif"><img src="../images/template6/image/product/title_1.gif" width="130" height="40"><img src="../images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--타이들이미지  끝-->
  <table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
<?
	include( '../include/leftmenu_template6.inc' );
}
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
        	if($ti_intro1_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_intro1_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_intro1_img' WIDTH='89' HEIGHT='27'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/guide-title.gif' WIDTH='89' HEIGHT='27'>
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
        	<td width="100%" height="10"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		
        		<table border="0" width="95%">
        <?
        	if($ti_intro2_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_intro2_img")){
        		$q_img_str = "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_intro2_img' WIDTH='15' HEIGHT='16'>
        		";
        	}
        	else{
        		$q_img_str = "
        	<img src='../images/q.gif' align='absmiddle' WIDTH='15' HEIGHT='16'>
        		";
        	}
        
        	if($ti_intro3_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_intro3_img")){
        		$a_img_str = "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_intro3_img' WIDTH='15' HEIGHT='16'>
        		";
        	}
        	else{
        		$a_img_str = "
        	<img src='../images/a.gif' align='absmiddle' WIDTH='15' HEIGHT='16'>
        		";
        	}
        	
				$SQL = "select * from $User_GuideTable where mart_id ='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				if($numRows > 0 ){
					mysql_data_seek($dbresult, 0);
					$ary = mysql_fetch_array($dbresult);
					$question1 = $ary["question1"];	 
					$answer1 = $ary["answer1"];
					$question2 = $ary["question2"];	 
					$answer2 = $ary["answer2"];
					$question3 = $ary["question3"];	 
					$answer3 = $ary["answer3"];
					$question4 = $ary["question4"];	 
					$answer4 = $ary["answer4"];
					$question5 = $ary["question5"];	 
					$answer5 = $ary["answer5"];
					$question6 = $ary["question6"];	 
					$answer6 = $ary["answer6"];
					$question7 = $ary["question7"];	 
					$answer7 = $ary["answer7"];
					$question8 = $ary["question8"];	 
					$answer8 = $ary["answer8"];
					$question9 = $ary["question9"];	 
					$answer9 = $ary["answer9"];
					$question10 = $ary["question10"];	 
					$answer10 = $ary["answer10"];	
				}
				
				if(($question1 != "")&&($answer1 != "")){
					echo ("
				<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question1</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer1</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          			");
          		}
          		if(($question2 != "")&&($answer2 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question2</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer2</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          			");
          		}
          		if(($question3 != "")&&($answer3 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question3</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer3</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          			");
          		}
          		if(($question4 != "")&&($answer4 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question4</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer4</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          			");
          		}
          		if(($question5 != "")&&($answer5 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question5</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer5</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          			");
          		}
          		if(($question6 != "")&&($answer6 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question6</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer6</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          			");
          		}
          		if(($question7 != "")&&($answer7 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question7</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer7</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          		
        			");
          		}
          		if(($question8 != "")&&($answer8 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question8</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer8</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          		
					");
          		}
          		if(($question9 != "")&&($answer9 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question9</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer9</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          		
					");
          		}
          		if(($question10 != "")&&($answer10 != "")){
					echo ("
				<tr>
            		<td width='5%' valign='top'></td>
            		<td width='95%' height='1' background='../images/left_dot.gif'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top' height='10'></td>
            		<td width='95%' height='10'></td>
          		</tr>
          		<tr>
            		<td width='5%' height='11'><p align='left'>
            			$q_img_str
            		</td>
            		<td width='95%' height='11'>
            			<span class='bb'><strong>$question10</strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width='5%' height='5'></td>
            		<td width='95%' height='5'></td>
          		</tr>
          		<tr>
            		<td width='5%' valign='top'>
            			<span class='aa'>
            			$a_img_str</span></td>
            		<td width='95%' height='6'>
            			<span class='bb'>$answer10</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='100%' valign='top' colspan='2' height='10'></td>
          		</tr>
          		
					");
          		}
          		?>
          		
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
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