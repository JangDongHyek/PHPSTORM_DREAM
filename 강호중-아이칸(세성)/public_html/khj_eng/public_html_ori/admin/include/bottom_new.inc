<?
if(strstr($icon_module,"icon9")!=false){
	$tmp_main_bottom_color = $main_bottom_color;
	$tmp_main_font_color = $main_font_color;
}
if(strstr($icon_module,"icon10")!=false){
	$tmp_main_font_color = $main_font_color;
}

if($main_bottom_color != "" || $main2_bottom_bg_color != "") { 
	if($main_bottom_color != "")
		$tmp_main_bottom_color = $main_bottom_color;
	if($main2_bottom_bg_color != "")
		$tmp_main_bottom_color = $main2_bottom_bg_color;
}
else $tmp_main_bottom_color = "#ffffff";

if($onestep == 10) $bottom_width='1000';
else $bottom_width='750';

if($main_bottom_img != ""|| $main2_bottom_bg_img != ""){ 
	if(strstr($icon_module,"icon9")!=false) $tmp_background = "$Co_img_DOWN$mart_id/design2/temp3/$main_bottom_img";
	if(strstr($icon_module,"icon10")!=false) $tmp_background = "$Co_img_DOWN$mart_id/design2/temp4/$main_bottom_img";;
	if(strstr($icon_module,"icon9")==false && strstr($icon_module,"icon10")==false){
		if($main_module == 1) $tmp_background = "$Co_img_DOWN$mart_id/design2/$main_bottom_img";
		if($main_module == 2) $tmp_background = "$Co_img_DOWN$mart_id/design2/$main2_bottom_bg_img";
		if($main_module == 3) $tmp_background = "$Co_img_DOWN$mart_id/design2/temp2/$main_bottom_img";
		if($main_module == 4) $tmp_background = "$Co_img_DOWN$mart_id/design2/temp5/$main_bottom_img";
	}
}
else $tmp_background == "";
$self_design_main .= "
<table border='0' width='$bottom_width' cellspacing='0' cellpadding='0' bgcolor='$tmp_main_bottom_color' background='$tmp_background'>
";


	if($bottom_img1 == '') $bottom_img1_str = "<img src='../images/bottom/cr1.gif' width='156' height='44' border='0'>";
	else $bottom_img1_str = "<img src='$Co_img_DOWN/$mart_id/design2/$bottom_img1' width='156' border='0'>";
	if($bottom_img2 == '') $bottom_img2_str = "<img src='../images/bottom/cr2.gif' width='185' height='44' border='0'>";
	else $bottom_img2_str = "<img src='$Co_img_DOWN/$mart_id/design2/$bottom_img2' width='185' border='0'>";
	if($bottom_img3 == '') $bottom_img3_str = "<img src='../images/bottom/cr3.gif' width='172' height='44' border='0'>";
	else $bottom_img3_str = "<img src='$Co_img_DOWN/$mart_id/design2/$bottom_img3' width='172' border='0'>";
	if($bottom_img4 == '') $bottom_img4_str = "<img src='../images/bottom/cr4.gif' width='137' height='44' border='0'>";
	else $bottom_img4_str = "<img src='$Co_img_DOWN/$mart_id/design2/$bottom_img4' width='137' border='0'>";
	if($bottom_img5 == '') $bottom_img5_str = "<img src='../images/bottom/cr5.gif' width='100' height='44' border='0'>";
	else $bottom_img5_str = "<img src='$Co_img_DOWN/$mart_id/design2/$bottom_img5' width='100' border='0'>"; 

	if($bottom_logo != "" && file_exists("$Co_img_UP$mart_id/design2/$bottom_logo")){
		if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
			$img_str = "<img src='$Co_img_DOWN$mart_id_tmp/$img_sml' width='70' height='70' border=1>";
		}
		if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
			$img_str = "<embed src='$Co_img_DOWN$mart_id_tmp/$img_sml' width='70' height='70'></embed>";
		}	
	}
	$copyright = nl2br($copyright);

	$self_design_bottom .= "
<tr>
    <td width='$bottom_width' valign='top' colspan='4' bgcolor='#9CA49C' height='1'></td>
</tr>
<tr> 
  <!--하단코드삽입 시작-->
  <td valign=top colspan=4></td>
</tr>
<tr> 
  <td valign='top' colspan='4'>
	";  

	if($if_use_bottom_img=='1') $self_design_bottom .= "$bottom_img1_str$bottom_img2_str<a href='../info/agree.php?mart_id=$mart_id'>$bottom_img3_str</a><a href='../info/privacy.php?mart_id=$mart_id'>$bottom_img4_str</a>$bottom_img5_str";

	$self_design_bottom .= "
  </td>
</tr>
<tr>
  <td valign=top colspan=4 height='10'></td>
</tr>
	";
	if(substr($bottom_logo,-4,4) == ".gif" || substr($bottom_logo,-4,4) == ".jpg" || substr($bottom_logo,-4,4) == ".bmp") $img_flag = "image"; 
	if(substr($bottom_logo,-4,4) == ".swf") $img_flag = "flash"; 
	
	if(strstr($icon_module,"icon7")!=false) {
		$top_logo_pos = '';
		$top_logo_default_img = "<img src='../images/ci.gif' width='165' height='37' border='0' hspace='10'>";
		$top_logo_width = 165;
		$top_logo_height = 37;
	}
	if(strstr($icon_module,"icon8")!=false) {
		$top_logo_pos = 'temp2/';
		$top_logo_default_img = "<img src='../images/template1/ci.gif' WIDTH='260' HEIGHT='55' border='0' hspace='10'>";
		$top_logo_width = 260;
		$top_logo_height = 55;
	}
	if(strstr($icon_module,"icon9")!=false) {
		$top_logo_pos = 'temp3/';
		$top_logo_default_img = "<img src='../images/topmenu_template3/ci.gif' WIDTH='141' HEIGHT='99' border='0' hspace='10'>";
		$top_logo_width = 141;
		$top_logo_height = 99;
	}
	if(strstr($icon_module,"icon10")!=false) {
		$top_logo_pos = 'temp4/';
		$top_logo_default_img = "<img src='../images/template4/ci.gif' WIDTH='165' HEIGHT='37' border='0' hspace='10'>";
		$top_logo_width = 165;
		$top_logo_height = 37;
	}
	if(strstr($icon_module,"icon11")!=false) {
		$top_logo_pos = 'temp5/';
		$top_logo_default_img = "<img src='../images/template5/ci.gif' WIDTH='165' HEIGHT='37' border='0' hspace='10'>";
		$top_logo_width = 165;
		$top_logo_height = 37;
	}
	
	if($bottom_logo == "") {
		if($if_use_2in1_logo == '1'){	
			if(substr($top_logo_img,-4,4) == ".gif" || substr($top_logo_img,-4,4) == ".jpg" || substr($top_logo_img,-4,4) == ".bmp") $img_flag = "image"; 
			if(substr($top_logo_img,-4,4) == ".swf") $img_flag = "flash"; 
			
			if($top_logo_img == "") $bottom_logo_img = $top_logo_default_img;
			else {
				if($img_flag == "image")
					$bottom_logo_img = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$top_logo_pos$top_logo_img' width='$top_logo_width' height='$top_logo_height' hspace='10'>";		
				if($img_flag == "flash")
					$bottom_logo_img = "<embed src='$Co_img_DOWN$mart_id/design2/$top_logo_pos$top_logo_img' width='$top_logo_width' height='$top_logo_height' hspace='10'>";
			}
		}
		else $bottom_logo_img = "";
	}
	else {
		if($img_flag == "image")
			$bottom_logo_img = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$bottom_logo' hspace='10'>";		
		if($img_flag == "flash")
			$bottom_logo_img = "<embed src='$Co_img_DOWN$mart_id/design2/$bottom_logo' width='$bottom_logo_width' height='$bottom_logo_height' hspace='10'>";
	}
	if($bottom_logo_img != ''){
		$self_design_bottom .= "
<tr> 
  <td valign='middle' width='300' align='right'>
 	<span class=aa>
	$bottom_logo_img</span></td>
	<td valign='top' width='450' align='left'> 
	<span class='aa'><font color='$tmp_main_font_color'>$copyright</font>
  </span>
  </td>
</tr>
		";
	}
	else{
		$self_design_bottom .= "
<tr> 
  <td valign='top' align='center'>
 	<span class='aa'><font color='$tmp_main_font_color'>$copyright</font>
  </span>
  </td>
</tr>
		";
	}	
$self_design_bottom .= "
<tr> 
    <td width='$bottom_width' valign='top' colspan='4' height='5'></td> 
</tr> 
<tr>
    <td width='$bottom_width' valign='top' colspan='4'>
    	<p align='center'>
";    	
    	
$SQL_B = "select * from $BannerTable where mart_id='$mart_id' and banner_pos = 'bottom' order by banner_no desc";
//echo "sql = $SQL_B";
$dbresult_B = mysql_query($SQL_B, $dbconn);
$numRows_B = mysql_num_rows($dbresult_B);
for ($i=0; $i<$numRows_B; $i++) {
	mysql_data_seek($dbresult_B,$i);
	$ary_B = mysql_fetch_array($dbresult_B);
	$info = $ary_B["info"];
	$img = $ary_B["img"];
	$link = $ary_B["link"];
	$if_newwin = $ary_B["if_newwin"];
	$if_inwin = $ary_B["if_inwin"];
	$if_flash = $ary_B["if_flash"];
	$flash_image = $ary_B["flash_image"];
	$flash_width = $ary_B["flash_width"];
	$flash_height = $ary_B["flash_height"];
	$img_width = $ary_B["img_width"];
	$img_height = $ary_B["img_height"];
	
	if($img_width != '') $img_width_str = "width='$img_width'";
	else $img_width_str = "";
	if($img_height != '') $img_height_str = "height='$img_height'";
	else $img_height_str = "";

	if($if_flash == 0){ //이미지 일때 
		if($if_newwin == 't'){
			if($link != "")
				$self_design_bottom .= "<a href='$link' target='_blank'><img border='0' src='$Co_img_DOWN/$mart_id/$img' $img_width_str $img_height_str></a>";
			else
				$self_design_bottom .= "<img border='0' src='$Co_img_DOWN/$mart_id/$img' $img_width_str $img_height_str>";
		}
		else{
			if($link != ""){
				if($if_inwin==0)
					$self_design_bottom .= "<a href='../banner/inner_banner.php?mart_id=$mart_id&banner_no=$banner_no_left'><img border='0' src='$Co_img_DOWN/$mart_id/$img' $img_width_str $img_height_str></a>";
				else
					$self_design_bottom .= "<a href='$link'><img border='0' src='$Co_img_DOWN/$mart_id/$img' $img_width_str $img_height_str></a>";
			}
			else
				$self_design_bottom .= "<img border='0' src='$Co_img_DOWN/$mart_id/$img' $img_width_str $img_height_str>";
		}
 	}
 	else  //플래시 일때
		$self_design_bottom .= "<embed src='$Co_img_DOWN$mart_id/$flash_image' width='$flash_width' height='$flash_height'>";
}
$self_design_bottom .= "
		</td>
   	<!--하단코드삽입 끝-->
</tr>
</table>
";
if($page_position == 1) $self_design_bottom .= "</center></div>";
?>



<?
/*
if(strstr($icon_module,"icon9")!=false){
	$tmp_main_bottom_color = $main_bottom_color;
	$tmp_main_font_color = $main_font_color;
}
if(strstr($icon_module,"icon10")!=false){
	if($main_bottom_color != "") $tmp_main_bottom_color = $main_bottom_color;
	else $tmp_main_bottom_color = "#ffffff";
	
	$tmp_main_font_color = $main_font_color;
}
if($onestep == 10) $bottom_width='1000';
else $bottom_width='750';
$copyright = nl2br($copyright);
$self_design_main .= ("
<table border='0' width='$bottom_width' cellspacing='0' cellpadding='0'>
<tr>
    <td width='$bottom_width' valign='top' colspan='4' bgcolor='#9CA49C' height='1'></td>
</tr>
<tr bgcolor='$tmp_main_bottom_color'>
    <!--하단코드삽입 시작-->
    <td width='$bottom_width' valign='top' colspan='4' height='5' ></td>
</tr>
<tr bgcolor='$tmp_main_bottom_color'> 
    <td width='$bottom_width' valign='top' colspan='4'>
    	<p align='center'><span class='aa'>
    	<font color='$tmp_main_font_color'>
    	$copyright</font></span>
    </td> 
</tr> 
<tr bgcolor='$tmp_main_bottom_color'> 
    <td width='$bottom_width' valign='top' colspan='4' height='5'></td> 
</tr> 
<tr bgcolor='$tmp_main_bottom_color'>
    <td width='$bottom_width' valign='top' colspan='4'>
    	<p align='center'>
");
    	$SQL_B = "select * from $BannerTable where mart_id='$mart_id' and banner_pos = 'bottom' order by banner_no desc";
			//echo "sql = $SQL_B";
			$dbresult_B = mysql_query($SQL_B, $dbconn);
			$numRows_B = mysql_num_rows($dbresult_B);
			for ($i=0; $i<$numRows_B; $i++) {
				mysql_data_seek($dbresult_B,$i);
				$ary_B = mysql_fetch_array($dbresult_B);
				$info = $ary_B["info"];
				$img = $ary_B["img"];
				$link = $ary_B["link"];
				$if_newwin = $ary_B["if_newwin"];
				$if_flash = $ary_B["if_flash"];
				$flash_image = $ary_B["flash_image"];
				$flash_width = $ary_B["flash_width"];
				$flash_height = $ary_B["flash_height"];
				
				if($if_flash == 0){ //이미지 일때 
					if($if_newwin == 't'){
						if($link != "")
							$self_design_main .= "<a href='$link' target='_blank'><img border='0' src='$Co_img_DOWN/$mart_id/$img'></a>";
						else
							$self_design_main .= "<img border='0' src='$Co_img_DOWN/$mart_id/$img'>";
					}
					else{
						if($link != "")
							$self_design_main .= "<a href='../banner/inner_banner.php?mart_id=$mart_id&banner_no=$banner_no_left'><img border='0' src='$Co_img_DOWN/$mart_id/$img'>";
						else
							$self_design_main .= "<img border='0' src='$Co_img_DOWN/$mart_id/$img'>";
					}
			 	}
			 	else  //플래시 일때
					$self_design_main .= "<embed src='$Co_img_DOWN$mart_id/$flash_image' width='$flash_width' height='$flash_height'>";
			}
	  $self_design_main .= ("
   	</td>
   	<!--하단코드삽입 끝-->
</tr>
</table>
		");
		
if($page_position == 1) $self_design_main .= "</center></div>";
*/
?>
