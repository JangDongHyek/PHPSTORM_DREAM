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
$self_design_left .= "
<td width='140' valign='top' bgcolor='$left_bg_color' background='$Co_img_DOWN$mart_id/design2/$left_bg_img'> 
<table border='0' width='100%' cellspacing='0' cellpadding='0'> 
<tr>  
  <td width='100%' height='30'>  
";
$self_design_left .= '
    <!--�α��� ����-->
    {bluecart $left_login}
    <!--�α��� ��-->
';    	
$self_design_left .= "
  </td>
  </tr>
";	
if($left_menu1_color == "") $left_menu1_color = $menu_bg_color;

if($left_list_img == "") $left_list_img_str = "<img border='0' src='../images/title1.gif' width='82' height='20'>";
else $left_list_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$left_list_img' width='82' height='20'>";

$self_design_left .= "
<tr bgcolor='$left_menu1_color' height='20'>  
  <td width='100%' >  
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
    <!--ī�װ��� ����-->
    {bluecart $category}
    <!--ī�װ��� ��-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr> 
  <td width='100%'>
";  
$self_design_left .= '
    <!--������������ ����-->
    {bluecart $left_union}
    <!--������������ ��-->
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
    <!--��������Ʈ ����-->
    {bluecart $left_content}
    <!--��������Ʈ ��-->
';    	
$self_design_left .= "
	</td>
</tr>
<tr> 
  <td width='100%'>
";
$self_design_left .= '
    <!--Ŀ�³�Ƽ ����-->
    {bluecart $community}
    <!--Ŀ�³�Ƽ ��-->
';    	
$self_design_left .= "
  </td>
</tr> 
<tr> 
  <td width='100%'>
";
$self_design_left .= '
    <!--���� ����-->
    {bluecart $coupon}
    <!--���� ��-->
';    	
$self_design_left .= "
  </td>
</tr> 
<tr> 
  <td width='100%'>
";
$self_design_left .= '
    <!--���� ����-->
    {bluecart $quiz}
    <!--���� ��-->
';    	
$self_design_left .= "
  </td>
</tr> 
<tr> 
  <td width='100%'>
";
$self_design_left .= '
    <!--īŻ�α� ����-->
    {bluecart $catalog}
    <!--īŻ�α� ��-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr> 
  <td width='100%'>
";
$self_design_left .= '
    <!--������������ ����-->
    {bluecart $left_poll}
    <!--������������ ��-->
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
    <!--������� ����-->
    {bluecart $left_banner}
    <!--������� ��-->
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
if($left_line_bg_color == "") $left_line_bg_color = "#9CA49C"; 
$self_design_left .= "
<td width='1' bgcolor='$left_line_bg_color'></td>   
";
?>