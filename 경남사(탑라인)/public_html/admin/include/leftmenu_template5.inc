<?
//전체배경색깔 
if($left_bg_color != "") $tmp_left_bg_color = $left_bg_color;
else $tmp_left_bg_color = '#ffffff';

//전체배경이미지
if($left_bg_img != "") $tmp_left_bg_img = "$Co_img_DOWN$mart_id/design2/temp5/$left_bg_img";
else $tmp_left_bg_img = "";

// 메뉴배경2 
if($left_menu2_color != "") $tmp_left_menu2_color = $left_menu2_color;
else $tmp_left_menu2_color = "#EEEEEE";

// 메뉴배경3 
if($left_menu3_color != "") $tmp_left_menu3_color = $left_menu3_color;
else $tmp_left_menu3_color = "";

//라인배경    
if($left_line_bg_color != "") $tmp_left_line_bg_color = $left_line_bg_color;
else $tmp_left_line_bg_color = "#C6C7C6";

//쇼핑카테고리        
if($left_cateogy_img != "") $tmp_left_cateogy_img = "$Co_img_DOWN$mart_id/design2/temp5/$left_cateogy_img";
else $tmp_left_cateogy_img = "../images/template5/left01.gif";

//검색타이틀        
if($left_search_img != "") $tmp_left_search_img = "$Co_img_DOWN$mart_id/design2/temp5/$left_search_img";
else $tmp_left_search_img = "../images/template5/left02.gif";

//검색 go        
if($left_search_go_img != "") $tmp_left_search_go_img = "$Co_img_DOWN$mart_id/design2/temp5/$left_search_go_img";
else $tmp_left_search_go_img = "../images/template5/search.gif";

//선물코너타이틀        
if($left_gift_img != "") $tmp_left_gift_img = "$Co_img_DOWN$mart_id/design2/temp5/$left_gift_img";
else $tmp_left_gift_img = "../images/template5/left04.gif";


if($main_module == 3) $tmp_row_span='2';
else $tmp_row_span='1';
		
$self_design_left .= "
<td width='140' valign='top' bgcolor='$tmp_left_bg_color' background='$tmp_left_bg_img' rowspan='$tmp_row_span'>
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr>
  <td width='100%' height='30'><p align='center'><img src='$tmp_left_cateogy_img' WIDTH='140'></td>
</tr>
<tr>
  <td width='100%' height='10' class='aa'></td>
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
  <td width='100%' height='1'></td>
</tr>
<tr>
  <td width='100%' height='15'></td>
</tr>
<tr>
  <td width='100%' height='22' bgcolor='$tmp_left_menu2_color'><p align='center'><img src='$tmp_left_search_img' WIDTH='140'></td>
</tr>
<tr>
  <td width='100%' height='10' bgcolor='$tmp_left_menu2_color'></td>
</tr>
<tr>
  <td width='100%'>
  <table border='0' width='100%' cellspacing='0' cellpadding='0'> 
  <form name=search action='../product/search.php'>
  <input type=hidden name='search_type' value='item'>
  <input type=hidden name='mart_id' value='$mart_id'>
  <tr>
    <td width='100%' height='5' bgcolor='$tmp_left_menu2_color'><p align='center'><input class='bb' name='itemname' size='5' style='height: 18; width: 93; border: 1px solid #ADC6E7'><span class='aa'><input type='image' src='$tmp_left_search_go_img' align='absmiddle' WIDTH='31' HEIGHT='20'></span></td>
  </tr>
  </form>
  </table>
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
    <!--파트너쉽 링크배너 시작-->
    {bluecart $left_partner}
    <!--파트너쉽 링크배너 끝-->
';    	
$self_design_left .= "
  </td>
</tr>
";
    
if($if_chuchon == 't'){ //선물추천 시작
	$self_design_left .= "
<tr>
  <td width='100%' height='4' bgcolor='#FFFFFF'><img src='$tmp_left_gift_img' WIDTH='140'></td>
</tr>
<tr>
  <td width='100%'>
	";
	$self_design_left .= '
    <!--좌측 선물추천 시작-->
    {bluecart $left_present}
    <!--좌측 선물추천 끝-->
	';    	
	$self_design_left .= "
  </td>
</tr>
	";
}
$self_design_left .= "
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
</table>
</td>
<td width='1' bgcolor='$tmp_left_line_bg_color' rowspan='$tmp_row_span'></td>
";
?>