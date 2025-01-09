<?
// 좌측메뉴 전체 배경 색깔
if($left_bg_color != "") $tmp_left_bg_color = $left_bg_color;
else {
	if($icon_module == 'icon10_1') $tmp_left_bg_color = "#ffffff";
	if($icon_module == 'icon10_2') $tmp_left_bg_color = "#ffffff";
	if($icon_module == 'icon10_3') $tmp_left_bg_color = "#FFC37B";
	if($icon_module == 'icon10_4') $tmp_left_bg_color = "#9DCDD3";
	if($icon_module == 'icon10_5') $tmp_left_bg_color = "#ffffff";
	if($icon_module == 'icon10_6') $tmp_left_bg_color = "#ECECEC";
	if($icon_module == 'icon10_7') $tmp_left_bg_color = "#ECECEC";
	if($icon_module == 'icon10_8') $tmp_left_bg_color = "#ffffff";
	if($icon_module == 'icon10_9') $tmp_left_bg_color = "#E7D3DE";
	if($icon_module == 'icon10_10') $tmp_left_bg_color = "#ECCCD1";
}
// 좌측메뉴 전체 배경이미지
if($left_bg_img != "") $tmp_left_bg_img = "$Co_img_DOWN$mart_id/design2/temp4/$left_bg_img";
else $tmp_left_bg_img = "";

// 라인1 컬러 
if($left_line1_color != "") $tmp_left_line1_color = $left_line1_color;
else $tmp_left_line1_color = "#000000";

// 검색 이미지
if($left_search_img != "") $tmp_left_search_img = "$Co_img_DOWN$mart_id/design2/temp4/$left_search_img";
else $tmp_left_search_img = "../images/template4/$icon_module/search.gif";

// 검색 GO 이미지
if($left_search_go_img != "") $tmp_left_search_go_img = "$Co_img_DOWN$mart_id/design2/temp4/$left_search_go_img";
else $tmp_left_search_go_img = "../images/template4/go.gif";

$self_design_left .= "
<td width='140' valign='top' bgcolor='$tmp_left_bg_color' background='$tmp_left_bg_img'>
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr bgcolor='$left_menu1_color'>
  <td width='100%' height='15'><p align='left'>
  <img border='0' src='$tmp_left_search_img' WIDTH='67' HEIGHT='18'></td>
</tr>
<tr>
  <td width='100%'>
  <table border='0' width='100%' cellspacing='0' cellpadding='0'> 
  <form name=search action='../product/search.php'>
  <input type=hidden name='search_type' value='item'>
  <input type=hidden name='mart_id' value='$mart_id'>
  <tr bgcolor='$left_menu1_color'>
    <td width='100%' height='15'><p align='center'>
    <input class='aa' name='itemname' size='14' style='width :70%;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid'><input type='image' border='0' src='$tmp_left_search_go_img' WIDTH='24' HEIGHT='14'><br>
    <br>
    </td>
  </tr>
  </form>
  </table>
  </td>
</tr>
<tr>
  <td width='100%' height='1' bgcolor='$tmp_left_line1_color'></td>
</tr>
";
		
// 카테고리 이미지
if($left_cateogy_list_img != "") $tmp_left_cateogy_list_img = "$Co_img_DOWN$mart_id/design2/temp4/$left_cateogy_list_img";
else $tmp_left_cateogy_list_img = "../images/template4/$icon_module/title1.gif";
$self_design_left .= "
<tr bgcolor='$left_menu2_color'>
  <td width='100%' height='22' class='aa'>
  <img border='0' src='$tmp_left_cateogy_list_img' WIDTH='67' HEIGHT='18'></td>
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
				
// 라인2 컬러 
if($left_line2_color != "") $tmp_left_line2_color = $left_line2_color;
else $tmp_left_line2_color = "#000000";
$self_design_left .= "
<tr bgcolor='$left_menu3_color'>
  <td width='100%' height='15'></td>
</tr>
<tr bgcolor='$left_menu3_color'>
  <td width='100%'></td>
</tr>
<tr bgcolor='$left_menu3_color'>
  <td width='100%'></td>
</tr>
</table>
</td>
<td width='1' bgcolor='$tmp_left_line2_color'></td>
";
?>


      			