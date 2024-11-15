<?
if($icon_module == 'icon8_1'){
	$menu_bg_color_top = '#94866B';
	$menu_bg_color1_top = '#BAAF9C';
	$left_bg_color_top = '#F3F0EB';
	$menu_bg_color = '#94866B';
	$menu_bg_color1 = '#BAAF9C';
}
if($icon_module == 'icon8_2'){
	$menu_bg_color_top = '#638EBD';
	$menu_bg_color1_top = '#92B1E4';
	$left_bg_color_top = '#F4F6FA';
	$menu_bg_color = '#638EBD';
	$menu_bg_color1 = '#92B1E4';
}
if($icon_module == 'icon8_3'){
	$menu_bg_color_top = '#7B5163';
	$menu_bg_color1_top = '#BD92A5';
	$left_bg_color_top = '#ECE2E7';
	$menu_bg_color = '#7B5163';
	$menu_bg_color1 = '#BD92A5';
}
if($icon_module == 'icon8_4'){
	$menu_bg_color_top = '#73754A';
	$menu_bg_color1_top = '#9CA67B';
	$left_bg_color_top = '#F2F4EA';
	$menu_bg_color = '#73754A';
	$menu_bg_color1 = '#9CA67B';
}
if($icon_module == 'icon8_5'){
	$menu_bg_color_top = '#526D94';
	$menu_bg_color1_top = '#6B86AD';
	$left_bg_color_top = '#ECF0F6';
	$menu_bg_color = '#526D94';
	$menu_bg_color1 = '#6B86AD';
}
if($icon_module == 'icon8_6'){
	$menu_bg_color_top = '#4A7531';
	$menu_bg_color1_top = '#739A52';
	$left_bg_color_top = '#F1F5ED';
	$menu_bg_color = '#4A7531';
	$menu_bg_color1 = '#739A52';
}
if($icon_module == 'icon8_7'){
	$menu_bg_color_top = '#C00000';
	$menu_bg_color1_top = '#FF644B';
	$left_bg_color_top = '#F7F7F7';
	$menu_bg_color = '#C00000';
	$menu_bg_color1 = '#FF644B';
}
if($icon_module == 'icon8_8'){
	$menu_bg_color_top = '#FF8111';
	$menu_bg_color1_top = '#FFB911';
	$left_bg_color_top = '#FCF7EC';
	$menu_bg_color = '#FF8111';
	$menu_bg_color1 = '#FFB911';
}
if($left_bg_color == "") $tmp_left_bg_color = $left_bg_color_top;
else $tmp_left_bg_color = $left_bg_color;

if($left_menu1_color == "") $tmp_left_menu1_color = $menu_bg_color;
else $tmp_left_menu1_color = $left_menu1_color;	
	
$self_design_left .= "
<td width='140' valign='top' rowspan='2' bgcolor='$tmp_left_bg_color' background='$Co_img_DOWN$mart_id/design2/temp2/$left_bg_img'>
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr bgcolor='$tmp_left_menu1_color'>
  <td width='100%' >
  <table border='0' cellspacing='0' cellpadding='0' width='140'>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
  <input type=hidden name='search_type' value='item'>
  <input type=hidden name='mart_id' value='$mart_id'>
  <tr>
    <td width='100%'>
    <img border='0' src='../images/template1/search.gif' vspace='2' WIDTH='88' HEIGHT='15'></td>
  </tr>
  <tr>
    <td width='100%'>
    <p align='center'>
    <input class='bb' name='itemname' size='10' style='BORDER-BOTTOM:  white 1px solid; BORDER-LEFT:   white 1px solid; BORDER-RIGHT: white 1px solid; BORDER-TOP:   white 1px solid; HEIGHT: 18px; WIDTH: 93px'>
    <a href='javascript:document.search.submit()'>
    <img border='0' src='../images/template1/go.gif' align='absmiddle' WIDTH='22' HEIGHT='17' border='0'></a></td>
  </tr>
  <tr>
    <td width='100%' height='3'></td>
  </tr>
  </form>
  </table>
  </td>
</tr>
<tr>
  <td width='100%' class='aa' height='10'></td>
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
    <!--좌측설문조사 시작-->
    {bluecart $left_poll}
    <!--좌측설문조사 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
<tr>
  <td width='100%' height='10'></td>
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
  <td width='100%' height='18'></td>
</tr>
</table>
</td>
";
?>
