
<?
// 메인 전체 배경이미지
if($main_total_img != "") $tmp_main_total_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_total_img";
else $tmp_main_total_img = "";

// 메인 전체 배경새깔
if($main_total_color != "") $tmp_main_total_color = $main_total_color;
else $tmp_main_total_color = "#ffffff";

// 메인 메인이미지
if($main_main_img != "") $tmp_main_main_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_main_img";
else $tmp_main_main_img = "../images/main_template3/main.jpg";

//그림화일인지 플래시 화일인지 확인
if($main_main_img != ""){
	if(strtolower(substr($main_main_img,-4,4)) == ".gif" || strtolower(substr($main_main_img,-4,4)) == ".jpg" || strtolower(substr($main_main_img,-4,4)) == ".bmp") $img_flag = "image"; 
		if(strtolower(substr($main_main_img,-4,4)) == ".swf") $img_flag = "flash"; 
}

if($main_main_img == "") $tmp_main_main_img_str = "<img src='$tmp_main_main_img' width='428'>";
else {
	if($img_flag == "image"){
		$tmp_main_main_img_str = "<img src='$tmp_main_main_img' width='428'>";		
	}
	if($img_flag == "flash"){
		$tmp_main_main_img_str = "<embed src='$tmp_main_main_img' WIDTH='428' height='$main_main_img_flash_height'></embed>";
	}
}
    		
    // 메인 메뉴 배경4 이미지
if($main_menu4_img != "") $tmp_main_menu4_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_menu4_img";
else $tmp_main_menu4_img = "../images/main_template3/cellbg.gif";

// 추천상품 이미지
if($main_chuchon_img != "") $tmp_main_chuchon_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_chuchon_img";
else $tmp_main_chuchon_img = "../images/main_template3/title4.gif";


// 메인 메뉴 배경5 이미지
if($main_menu5_img != "") $tmp_main_menu5_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_menu5_img";
else $tmp_main_menu5_img = "../images/main_template3/cellbg.gif";

// 신상품 이미지
if($main_newitem_img != "") $tmp_main_newitem_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_newitem_img";
else $tmp_main_newitem_img = "../images/main_template3/title6.gif";
	
// 메인 메뉴 배경1 이미지
if($main_menu1_img != "") $tmp_main_menu1_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_menu1_img";
else $tmp_main_menu1_img = "";

if($main_menu1_color != "") $tmp_main_menu1_color = $main_menu1_color;
else{
	if($icon_module == 'icon9_1') $tmp_main_menu1_color = "#52BADE";
	if($icon_module == 'icon9_2') $tmp_main_menu1_color = "#313063";
	if($icon_module == 'icon9_3') $tmp_main_menu1_color = "#A5A663";
	if($icon_module == 'icon9_4') $tmp_main_menu1_color = "#CF4580";
	if($icon_module == 'icon9_5') $tmp_main_menu1_color = "#2BA7AF";
	if($icon_module == 'icon9_6') $tmp_main_menu1_color = "#DBBC8B";
}


// 쇼핑뉴스 이미지
if($main_news_img != "") $tmp_main_news_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_news_img";
else $tmp_main_news_img = "../images/main_template3/title7.gif";

// 메인 메뉴 배경2 이미지
if($main_menu2_img != "") $tmp_main_menu2_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_menu2_img";
else $tmp_main_menu2_img = "";

if($main_menu2_color != "") $tmp_main_menu2_color = $main_menu2_color;
else{
	if($icon_module == 'icon9_1') $tmp_main_menu2_color = "#52BADE";
	if($icon_module == 'icon9_2') $tmp_main_menu2_color = "#313063";
	if($icon_module == 'icon9_3') $tmp_main_menu2_color = "#A5A663";
	if($icon_module == 'icon9_4') $tmp_main_menu2_color = "#CF4580";
	if($icon_module == 'icon9_5') $tmp_main_menu2_color = "#2BA7AF";
	if($icon_module == 'icon9_6') $tmp_main_menu2_color = "#DBBC8B";
}


// 선물 이미지
if($main_present_img != "") $tmp_main_present_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_present_img";
else $tmp_main_present_img = "../images/main_template3/title8.gif";

// 메인 메뉴 배경3 이미지
if($main_menu3_img != "") $tmp_main_menu3_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_menu3_img";
else $tmp_main_menu3_img = "";

if($main_menu3_color != "") $tmp_main_menu3_color = $main_menu3_color;
else{
	if($icon_module == 'icon9_1') $tmp_main_menu3_color = "#4AA2D6";
	if($icon_module == 'icon9_2') $tmp_main_menu3_color = "#4182BF";
	if($icon_module == 'icon9_3') $tmp_main_menu3_color = "#B5C78C";
	if($icon_module == 'icon9_4') $tmp_main_menu3_color = "#386296";
	if($icon_module == 'icon9_5') $tmp_main_menu3_color = "#5EC6CC";
	if($icon_module == 'icon9_6') $tmp_main_menu3_color = "#948E84";
}

// 반짝설문 이미지
if($main_poll_img != "") $tmp_main_poll_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_poll_img";
else $tmp_main_poll_img = "../images/main_template3/title9.gif";

// 파트너쉽 이미지
if($main_partner_img != "") $tmp_main_partner_img = "$Co_img_DOWN$mart_id/design2/temp3/$main_partner_img";
else $tmp_main_partner_img = "../images/main_template3/partnership.gif";

$self_design_main .= "
<td width='428' valign='top' bgcolor='#ffffff'>
<!--이 템플릿은 메인과 오른편으로 구분되어 있으므로, 각각의 부분을 셀프디자인을 하셔야 합니다--> 
<!--메인코드삽입 시작-->
<div align='center'><center>
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr>
  <td width='100%' height='5'>
  $tmp_main_main_img_str</td>
</tr>
<tr>
  <td width='100%' height='11' bgcolor='$main_menu4_color' background='$tmp_main_menu4_img'>
  <img src='$tmp_main_chuchon_img' WIDTH='66' HEIGHT='22'></td>
</tr>
<tr>
  <td width='100%'>
";
$self_design_main .= '
  <!--추천상품 시작-->
  {bluecart $reco_product}
  <!--추천상품 끝-->
';      		
$self_design_main .= "
  </td>
</tr>
<tr>
  <td width='100%' height='11' bgcolor='$main_menu5_color' background='$tmp_main_menu5_img'>
  <img src='$tmp_main_newitem_img' WIDTH='66' HEIGHT='22'></td>
</tr>
<tr>
  <td width='100%' height='5'>
";            			
$self_design_main .= '
  <!--신상품 시작-->
  {bluecart $new_product}
  <!--신상품 끝-->
';
$self_design_main .= "
  </td>
</tr>
";
if($main_right_line_color == '') $main_right_line_color = '#CECBCE';
$self_design_main .= "
</table>
</center></div>
<!--메인코드삽입 끝-->
</td>
<td width='1' valign='top' bgcolor='$main_right_line_color'></td>
<td width='180' valign='top' bgcolor='$tmp_main_total_color' background='$tmp_main_total_img'>
<!--오른편코드시작-->
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
";
if($if_notice == 't'){ //공지사항 시작          		
	$self_design_main .= "
<tr>
  <td width='100%' bgcolor='$tmp_main_menu1_color' height='11' background='$tmp_main_menu1_img'>
  <img src='$tmp_main_news_img' WIDTH='97' HEIGHT='20'></td>
</tr>
<tr>
  <td width='100%'>
  <table>
  <tr>
    <td vAlign='top' width='100%' colspan='2' height='5'></td>
  </tr>
  <tr>
    <td width='180'>
	";
  $self_design_main .= '
    <!--공지사항 시작-->
    {bluecart $notice}
    <!--공지사항 끝-->
	';
	$self_design_main .= "
    </td>
  </tr>
  <tr>
    <td width='100%' colspan='2'>
    <p align='right'>
    <a href='../notice/notice_list.php?mart_id=$mart_id'>
    <img src='../images/more.gif' border='0' WIDTH='45' HEIGHT='15'></a>&nbsp;</td>
  </tr>
  </table>
  </td>
</tr>
<tr>
  <td width='100%' bgcolor='#CECBCE' height='1'></td>
</tr>
	";
}
$self_design_main .= "
<tr>
  <td width='100%'>
";
$self_design_main .= '
  <!--컨텐트 시작-->
  {bluecart $right_content}
  <!--컨텐트 끝-->
';      		
$self_design_main .= "
  </td>
</tr>
";
if($if_chuchon == 't'){ 
	$self_design_main .= "
  <tr>
    <td width='100%' bgcolor='#737173' height='2'></td>
  </tr>
  <tr>
    <td width='100%' bgcolor='$tmp_main_menu2_color' height='11' background='$tmp_main_menu2_img'>
    <img src='$tmp_main_present_img' border='0' WIDTH='143' HEIGHT='20'></td>
  </tr>
  <tr>
    <td width='100%'>
	";
	$self_design_main .= '
    <!--선물추천 시작-->
    {bluecart $main_present}
    <!--선물추천 끝-->
	';  
	$self_design_main .= "
    </td>
  </tr>
  ";    
}

$self_design_main .= "
<tr>
  <td width='100%'>
";
$self_design_main .= '
  <!--설문조사 시작-->
  {bluecart $main_poll}
  <!--설문조사 끝-->
';  
$self_design_main .= "
  </td>
</tr>
<tr>
  <td width='100%'>
";
$self_design_main .= '
  <!--파트너쉽 링크배너 시작-->
  {bluecart $partner}
  <!--파트너쉽 링크배너 끝-->
';
$self_design_main .= "
  </td>
</tr>
<tr>
  <td width='100%'>
";
$self_design_main .= '
  <!--배너 시작-->
  {bluecart $right_banner}
  <!--배너 끝-->
';      		
$self_design_main .= "
  </td>
</tr>
<tr>
  <td width='100%'></td>
</tr>
<tr>
  <td width='100%'></td>
</tr>
<tr>
  <td width='100%'></td>
</tr>
<tr>
  <td width='100%'></td>
</tr>
<tr>
  <td width='100%'></td>
</tr>
<tr>
  <td width='100%'></td>
</tr>
</table>
<!--오른편코드끝-->
</td>
</tr>
</table>
</td>
</tr>
</table>
";
include( '../include/bottom_main.inc' );
$self_design_main .= "
</body>
</html>
";
$self_design_main .= '
<!--이벤트 시작-->
{bluecart $event}
<!--이벤트 끝-->
';      		
$self_design_main .= '
<!--스크롤배너 시작-->
{bluecart $scrol_banner}
<!--스크롤배너 끝-->
'; 
?>
