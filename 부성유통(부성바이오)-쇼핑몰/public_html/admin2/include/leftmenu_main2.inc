<?
if($icon_module == 'icon7_1'){
	$menu_bg_color_top = '#08ADBD';
	$menu_bg_color1_top = '#94CED6';
	$menu_bg_color = '#08ADBD';
	$menu_bg_color1 = '#94CED6';
}
if($icon_module == 'icon7_2'){
	$menu_bg_color_top = '#FF8811';
	$menu_bg_color1_top = '#FFC68C';
	$menu_bg_color = '#FF8811';
	$menu_bg_color1 = '#FFC68C';
}
if($icon_module == 'icon7_3'){
	$menu_bg_color_top = '#6B96CE';
	$menu_bg_color1_top = '#ADC7E7';
	$menu_bg_color = '#6B96CE';
	$menu_bg_color1 = '#ADC7E7';
}
if($icon_module == 'icon7_4'){
	$menu_bg_color_top = '#52AED6';
	$menu_bg_color1_top = '#B5D7E7';
	$menu_bg_color = '#52AED6';
	$menu_bg_color1 = '#B5D7E7';
}
if($icon_module == 'icon7_5'){
	$menu_bg_color_top = '#639AFF';
	$menu_bg_color1_top = '#AAC8FF';
	$menu_bg_color = '#639AFF';
	$menu_bg_color1 = '#AAC8FF';
}
if($icon_module == 'icon7_6'){
	$menu_bg_color_top = '#CEA229';
	$menu_bg_color1_top = '#E7C77B';
	$menu_bg_color = '#CEA229';
	$menu_bg_color1 = '#E7C77B';
}
if($icon_module == 'icon7_7'){
	$menu_bg_color_top = '#808080';
	$menu_bg_color1_top = '#C0C0C0';
	$menu_bg_color = '#808080';
	$menu_bg_color1 = '#C0C0C0';
}
if($icon_module == 'icon7_8'){
	$menu_bg_color_top = '#18A200';
	$menu_bg_color1_top = '#84D700';
	$menu_bg_color = '#18A200';
	$menu_bg_color1 = '#84D700';
}
if($icon_module == 'icon7_9'){
	$menu_bg_color_top = '#8CBD26';
	$menu_bg_color1_top = '#C8E787';
	$menu_bg_color = '#8CBD26';
	$menu_bg_color1 = '#C8E787';
}
if($icon_module == 'icon7_10'){
	$menu_bg_color_top = '#EF8EB5';
	$menu_bg_color1_top = '#F8C9DC';
	$menu_bg_color = '#EF8EB5';
	$menu_bg_color1 = '#F8C9DC';
}
if($icon_module == 'icon7_11'){
	$menu_bg_color_top = '#9C71D6';
	$menu_bg_color1_top = '#CAB4E9';
	$menu_bg_color = '#9C71D6';
	$menu_bg_color1 = '#CAB4E9';
}
if($icon_module == 'icon7_12'){
	$menu_bg_color_top = '#00084A';
	$menu_bg_color1_top = '#004173';
	$menu_bg_color = '#00084A';
	$menu_bg_color1 = '#004173';
}
if($icon_module == 'icon7_13'){
	$menu_bg_color_top = '#BD2029';
	$menu_bg_color1_top = '#C2C2C2';
	$menu_bg_color = '#BD2029';
	$menu_bg_color1 = '#C2C2C2';
}
if($left_bg_color == "") $left_bg_color = '#ffffff';
if($main_module == 3) $main_module_str = "rowspan='2' ";
else $main_module_str = "";

$self_design_left .= "
<td width='140' valign='top' $main_module_str bgcolor='$left_bg_color' background='$Co_img_DOWN$mart_id/design2/$left_bg_img'> 
<table border='0' width='100%' cellspacing='0' cellpadding='0'> 
<tr>  
  <td width='100%' height='30'>  
";
$self_design_left .= '
  <!--로그인 시작-->
  {bluecart $left_login}
  <!--로그인 끝-->
';    	
$self_design_left .= "
  </td> 
</tr> 
";

if($left_menu1_color == "") $left_menu1_color = $menu_bg_color;
if($left_list_img == "") $left_list_img_str = "<img border='0' src='../images/title1.gif' width='82' height='20'>";
else $left_list_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$left_list_img' width='82' height='20'>";
	
$self_design_left .= "
<tr>  
  <td width='100%' bgcolor='$left_menu1_color' height='20'>  
  <p align='center'>
  <strong>
  <span class='dd'>
    	$left_list_img_str
  </span>
  </strong> 
  </td> 
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
</table>
<table border='0' width='100%' cellspacing='0' cellpadding='0'> 
<tr>
	<td width='100%'>
";
if($left_menu3_color == "") $left_menu3_color = $menu_bg_color;

if($left_bg_color == "" && $left_bg_img == ""){
	$tmp_bg_color = "#FFFFFF";
}
//else $tmp_bg_color = $left_bg_color;
$self_design_left .= '
    <!--좌측공동구매 시작-->
    {bluecart $left_union}
    <!--좌측공동구매 끝-->
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
    <!--좌측컨텐트 시작-->
    {bluecart $left_content}
    <!--좌측컨텐트 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td width='100%'>
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
  <td width='100%'>
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
  <td width='100%'>
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
  <td width='100%'>
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
  <td width='100%'>
";
$self_design_left .= '
    <!--좌측설문조사 시작-->
    {bluecart $left_poll}
    <!--좌측설문조사 끝-->
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
<tr>  
  <td width='100%'></td> 
</tr> 
</table> 
</td>
";
?>   