<?
// 좌측메뉴 전체 배경이미지
if($left_bg_img != "") $tmp_left_bg_img = "$Co_img_DOWN$mart_id/design2/temp3/$left_bg_img";
else $tmp_left_bg_img = "";

if($left_bg_color != "") $tmp_left_bg_color = $left_bg_color;
else $tmp_left_bg_color = "#E9E9E9";

if($left_menu1_color != "") $tmp_left_menu1_color = $left_menu1_color;
else {
	if($icon_module == 'icon9_1') $tmp_left_menu1_color = "#4A96CE";
	if($icon_module == 'icon9_2') $tmp_left_menu1_color = "#6B9AD6";
	if($icon_module == 'icon9_3') $tmp_left_menu1_color = "#8CA663";
	if($icon_module == 'icon9_4') $tmp_left_menu1_color = "#AD0039";
	if($icon_module == 'icon9_5') $tmp_left_menu1_color = "#007D84";
	if($icon_module == 'icon9_6') $tmp_left_menu1_color = "#948E84";
}

// 상품카테고리 이미지
if($left_cateogy_list_img != "") $tmp_left_cateogy_list_img = "$Co_img_DOWN$mart_id/design2/temp3/$left_cateogy_list_img";
else $tmp_left_cateogy_list_img = "../images/leftmenu_template3/title1.gif";

// 아이콘 이미지
if($left_icon_img != "") $tmp_left_icon_img = "$Co_img_DOWN$mart_id/design2/temp3/$left_icon_img";
else $tmp_left_icon_img = "../images/leftmenu_template3/bullet.gif";
			
$self_design_left .= "
<td width='140' valign='top' bgcolor='$tmp_left_bg_color' background='$tmp_left_bg_img'>
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr>
  <td width='100%' height='22' bgcolor='$tmp_left_menu1_color'>
  <p align='left'>
  <img src='$tmp_left_cateogy_list_img' WIDTH='100' HEIGHT='20'></td>
</tr>
<tr>
  <td width='100%'>
";  		
$self_design_left .= '
    <!--카테고리 시작-->
    {bluecart $category}
    <!--카테고리 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td width='100%'>
";
$self_design_left .= '
    <!--좌측공동구매 시작-->
    {bluecart $left_union}
    <!--좌측공동구매 끝-->
';  	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td widht='100%'>
";
$self_design_left .= '
    <!--좌측컨텐트 시작-->
    {bluecart $left_content}
    <!--좌측컨텐트 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td widht='100%'>
";  	
$self_design_left .= '
    <!--커뮤너티 시작-->
    {bluecart $community}
    <!--커뮤너티 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td widht='100%'>
";
$self_design_left .= '
    <!--쿠폰 시작-->
    {bluecart $coupon}
    <!--쿠폰 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td widht='100%'>
";
$self_design_left .= '
    <!--퀴즈 시작-->
    {bluecart $quiz}
    <!--퀴즈 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td widht='100%'>
";
$self_design_left .= '
    <!--카탈로그 시작-->
    {bluecart $catalog}
    <!--카탈로그 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td width='100%' height='15'></td>
</tr>
<tr>
  <td width='100%'>
";
$self_design_left .= '
    <!--좌측배너 시작-->
    {bluecart $left_banner}
    <!--좌측배너 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
";
if($left_line_color != "") $tmp_left_line_color = $left_line_color;
else $tmp_left_line_color = "#CECBCE";
		
$self_design_left .= "
</table>
</td>
<td width='1' bgcolor='$tmp_left_line_color'></td>
";
?>	
