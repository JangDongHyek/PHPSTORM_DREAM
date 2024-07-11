<?
// 메인 메인이미지
if($main_main_img != "") $tmp_main_main_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_main_img";
else $tmp_main_main_img = "../images/template4/main.jpg";

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

// 추천상품 이미지
if($main_chuchon_img != "") $tmp_main_chuchon_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_chuchon_img";
else $tmp_main_chuchon_img = "../images/template4/$icon_module/title4.gif";
$self_design_main .= "
<td width='428' valign='top' bgcolor='#FFFFFF'>
<!--이 템플릿은 메인과 오른편으로 구분되어 있으므로, 각각의 부분을 셀프디자인을 하셔야 합니다--> 
<!--메인코드삽입 시작-->
$tmp_main_main_img_str<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr>
  <td width='100%'><img src='$tmp_main_chuchon_img' WIDTH='428' HEIGHT='21'></td>
</tr>
<tr>
  <td width='100%' height='10'></td>
</tr>
<tr>
  <td width='100%'><div align='center'><center>
";
$self_design_main .= '
  <!--추천상품 시작-->
  {bluecart $reco_product}
  <!--추천상품 끝-->
';      		
$self_design_main .= "
  </center></div></td>
</tr>
<tr>
  <td width='100%' height='10'></td>
</tr>
";	
if($main_newitem_img != "") $tmp_main_newitem_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_newitem_img";
else $tmp_main_newitem_img = "../images/template4/$icon_module/title6.gif";
$self_design_main .= "
<tr>
  <td width='100%'>
  <img src='$tmp_main_newitem_img' WIDTH='428' HEIGHT='21'></td>
</tr>
<tr>
  <td width='100%' height='10'></td>
</tr>
<tr>
  <td width='100%'><div align='center'><center>
";
$self_design_main .= '
  <!--신상품 시작-->
  {bluecart $new_product}
  <!--신상품 끝-->
';
$self_design_main .= "
  </center></div></td>
</tr>
";
if($main_right_line_color == '') $main_right_line_color = '#000000';
$self_design_main .= "
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
<p><br><!--메인코드삽입 끝-->
</td>
<td width='1' valign='top' bgcolor='$main_right_line_color'></td>
";
        	
// 뉴스 배경색
if($main_menu1_color != "") $tmp_main_menu1_color = $main_menu1_color;
else {
	if($icon_module == 'icon10_1') $tmp_main_menu1_color = "#000000";
	if($icon_module == 'icon10_2') $tmp_main_menu1_color = "#859C47";
	if($icon_module == 'icon10_3') $tmp_main_menu1_color = "#FFB663";
	if($icon_module == 'icon10_4') $tmp_main_menu1_color = "#73B6BD";
	if($icon_module == 'icon10_5') $tmp_main_menu1_color = "#F4B800";
	if($icon_module == 'icon10_6') $tmp_main_menu1_color = "#736D63";
	if($icon_module == 'icon10_7') $tmp_main_menu1_color = "#FF655A";
	if($icon_module == 'icon10_8') $tmp_main_menu1_color = "#597DC7";
	if($icon_module == 'icon10_9') $tmp_main_menu1_color = "#BD8EAD";
	if($icon_module == 'icon10_10') $tmp_main_menu1_color = "#D68A94";
}

// 뉴스 배경 이미지
if($main_menu1_img != "") $tmp_main_menu1_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_menu1_img";
else $tmp_main_menu1_img = "";
	
// 뉴스 이미지
if($main_news_img != "") $tmp_main_news_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_news_img";
else $tmp_main_news_img = "../images/template4/news.gif";
$self_design_main .= "
<td width='180' valign='top' bgcolor='#FFFFFF'>
<!--오른편코드시작-->
<table border='0' cellspacing='0' width='100%' cellpadding='0'>
";
if($if_notice == 't'){ //공지사항 시작
	$self_design_main .= "
<tr>
  <td width='100%' bgcolor='$tmp_main_menu1_color' height='21' background='$tmp_main_menu1_img'>
  <p align='center'>
  <img src='$tmp_main_news_img' WIDTH='117' HEIGHT='21'></td>
</tr>
<tr>
  <td width='100%'><div align='center'><center>
  <table border='0' width='95%'>
  <tr>
    <td width='100%' valign='top' colspan='2' height='5'></td>
  </tr>
  <tr>
    <td width='100%' colspan='2'>
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
    <td width='3%' valign='top'>
    </td>
    <td width='97%'>
    <p align='right'>
    <a href='../notice/notice_list.php?mart_id=$mart_id'>
    <img src='../images/more.gif' border='0' WIDTH='45' HEIGHT='15'></a></td>
  </tr>
  </table>
  </center></div></td>
</tr>
	";
}//공지사항 끝
      
 // 인기상품 배경색
if($main_menu2_color != "") $tmp_main_menu2_color = $main_menu2_color;
else {
	if($icon_module == 'icon10_1') $tmp_main_menu2_color = "#000000";
	if($icon_module == 'icon10_2') $tmp_main_menu2_color = "#859C47";
	if($icon_module == 'icon10_3') $tmp_main_menu2_color = "#FFB663";
	if($icon_module == 'icon10_4') $tmp_main_menu2_color = "#73B6BD";
	if($icon_module == 'icon10_5') $tmp_main_menu2_color = "#F4B800";
	if($icon_module == 'icon10_6') $tmp_main_menu2_color = "#736D63";
	if($icon_module == 'icon10_7') $tmp_main_menu2_color = "#FF655A";
	if($icon_module == 'icon10_8') $tmp_main_menu2_color = "#597DC7";
	if($icon_module == 'icon10_9') $tmp_main_menu2_color = "#BD8EAD";
	if($icon_module == 'icon10_10') $tmp_main_menu2_color = "#D68A94";
}

// 인기상품 배경 이미지
if($main_menu2_img != "") $tmp_main_menu2_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_menu2_img";
else $tmp_main_menu2_img = "";
	
// 인기상품 이미지
if($main_hititem_img != "") $tmp_main_hititem_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_hititem_img";
else $tmp_main_hititem_img = "../images/template4/pi.gif";
		  		
$self_design_main .= "
<tr>
  <td width='100%' bgcolor='$tmp_main_menu2_color' height='21' background='$tmp_main_menu2_img'>
  <p align='center'>
  <img src='$tmp_main_hititem_img' WIDTH='117' HEIGHT='21'></td>
</tr>
<tr>
  <td width='100%'>
  <div align='center'><center>
";
$self_design_main .= '
  <!--인기상품 시작-->
  {bluecart $pop_product}
  <!--인기상품 끝-->
';      		
$self_design_main .= "
  </center></div></td>
</tr>
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
		
//선물추천 시작
// 선물 배경색
if($main_menu3_color != "") $tmp_main_menu3_color = $main_menu3_color;
else {
	if($icon_module == 'icon10_1') $tmp_main_menu3_color = "#000000";
	if($icon_module == 'icon10_2') $tmp_main_menu3_color = "#859C47";
	if($icon_module == 'icon10_3') $tmp_main_menu3_color = "#FFB663";
	if($icon_module == 'icon10_4') $tmp_main_menu3_color = "#73B6BD";
	if($icon_module == 'icon10_5') $tmp_main_menu3_color = "#F4B800";
	if($icon_module == 'icon10_6') $tmp_main_menu3_color = "#736D63";
	if($icon_module == 'icon10_7') $tmp_main_menu3_color = "#FF655A";
	if($icon_module == 'icon10_8') $tmp_main_menu3_color = "#597DC7";
	if($icon_module == 'icon10_9') $tmp_main_menu3_color = "#BD8EAD";
	if($icon_module == 'icon10_10') $tmp_main_menu3_color = "#D68A94";
}

// 선물 배경 이미지
if($main_menu3_img != "") $tmp_main_menu3_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_menu3_img";
else $tmp_main_menu3_img = "";

// 선물 이미지
if($main_gift_img != "") $tmp_main_gift_img = "$Co_img_DOWN$mart_id/design2/temp4/$main_gift_img";
else $tmp_main_gift_img = "../images/template4/fg.gif";

if($if_chuchon == 't'){ 
  $self_design_main .= "
<tr>
  <td width='100%' bgcolor='$tmp_main_menu3_color' height='21' background='$tmp_main_menu3_img'>
  <p align='center'>
  <img src='$tmp_main_gift_img' WIDTH='117' HEIGHT='21'></td>
</tr>
<tr>
  <td width='100%'>
  <div align='center'><center>
	";
  $self_design_main .= '
  <!--선물추천 시작-->
  {bluecart $main_present}
  <!--선물추천 끝-->
	';  
	$self_design_main .= "
  </center></div>
  </td>
</tr>
  ";     		
}
$self_design_main .= "
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
";
if($main_bottom_line_color == '') $main_bottom_line_color = '#000000';  	
$self_design_main .= "
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