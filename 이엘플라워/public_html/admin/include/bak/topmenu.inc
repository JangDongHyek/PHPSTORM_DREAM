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
if($top_bg_img1 != "") $tmp_background = "$Co_img_DOWN$mart_id/design2/$top_bg_img1";
else $tmp_background == "";
$self_design_top .= "
<script>
function company_win(){
  var url = 'http://$link';
  var uploadwin = window.open(url,'company','width=600,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes');
}
</script>
";
if($page_position == 1) $self_design_top .= "<div align='center'><center>";
$self_design_top .= "
<table border='0' width='750' cellspacing='0' cellpadding='0' bgcolor='$top_bg_color1' background='$tmp_background'>
<tr>
  <td colspan='8'>
";

if(substr($top_logo_img,-4,4) == ".gif" || substr($top_logo_img,-4,4) == ".jpg" || substr($top_logo_img,-4,4) == ".bmp") $img_flag = "image"; 
if(substr($top_logo_img,-4,4) == ".swf") $img_flag = "flash"; 

if($top_logo_img == "") $self_design_top .= "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='../images/ci.gif' width='165' height='37'></a>";
else {
	if($img_flag == "image"){
			$self_design_top .= "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='$Co_img_DOWN$mart_id/design2/$top_logo_img' width='165' height='37'></a>";		
	}
	if($img_flag == "flash"){
			$self_design_top .= "
			<embed src='$Co_img_DOWN$mart_id/design2/$top_logo_img' width='165' height='37'>
			";
		}
}
$self_design_top .= "
  </td>
</tr>
";
if($top_bg_color2 != ""){
	$menu_bg_color_top = "";
}

if($top_home_img == "") $tm1_img = "../images/topmenu/$icon_module/tm1000.gif";
else $tm1_img = "$Co_img_DOWN$mart_id/design2/$top_home_img";

if($top_intro_img == "") $tm2_img = "../images/topmenu/$icon_module/tm1001.gif";
else $tm2_img = "$Co_img_DOWN$mart_id/design2/$top_intro_img";

if($top_guide_img == "") $tm3_img = "../images/topmenu/$icon_module/tm1002.gif";
else $tm3_img = "$Co_img_DOWN$mart_id/design2/$top_guide_img";

if($top_member_img == "") $tm4_img = "../images/topmenu/$icon_module/tm1003.gif";
else $tm4_img = "$Co_img_DOWN$mart_id/design2/$top_member_img";

if($top_cart_img == "") $tm5_img = "../images/topmenu/$icon_module/tm1004.gif";
else $tm5_img = "$Co_img_DOWN$mart_id/design2/$top_cart_img";

if($top_order_search_img == "") $tm6_img = "../images/topmenu/$icon_module/tm1005.gif";
else $tm6_img = "$Co_img_DOWN$mart_id/design2/$top_order_search_img";

if($top_board_img == "") $tm7_img = "../images/topmenu/$icon_module/tm1006.gif";
else $tm7_img = "$Co_img_DOWN$mart_id/design2/$top_board_img";

if($top_email_img == "") $tm8_img = "../images/topmenu/$icon_module/tm1007.gif";
else $tm8_img = "$Co_img_DOWN$mart_id/design2/$top_email_img";

$self_design_top .= "
<tr bgcolor='$top_bg_color2'>
  <!--홈으로가기-->
  <td>
  <a href='../main/index.php?mart_id=$mart_id'>
  <img src='$tm1_img' width='69' height='26' border='0'></a></td>
";
if($intro_type == 3){
	$self_design_top .= "
  <!--회사소개 새창-->
  <td><a href='http://$link' target='_blank'>
  <img src='$tm2_img' WIDTH='103' HEIGHT='26' border='0'></a></td>		
	";
}
else{
	$self_design_top .= "
  <!--회사소개 현재창-->
  <td><a href='../info/company.php?mart_id=$mart_id'>
  <img src='$tm2_img' WIDTH='103' HEIGHT='26' border='0'></a></td>
	";
}

$self_design_top .= "
  <!--이용안내-->
  <td><a href='../info/user_guide.php?mart_id=$mart_id'>
  <img src='$tm3_img' WIDTH='102' HEIGHT='26' border='0'></a></td>
  <!--회원가입/변경-->
  <td><a href='../mypage/mypage.php?mart_id=$mart_id'>
  <img src='$tm4_img' WIDTH='103' HEIGHT='26' border='0'></a></td>
  <!--장바구니-->
  <td><a href='../cart/cart_view.php?mart_id=$mart_id'>
  <img src='$tm5_img' WIDTH='103' HEIGHT='26' border='0'></a></td>
  <!--주문조회-->
  <td><a href='../stat/order.php?mart_id=$mart_id'>
  <img src='$tm6_img' WIDTH='103' HEIGHT='26' border='0'></a></td>
  <!--게시판-->
  <td><a href='../board/board_list.php?mart_id=$mart_id'>
  <img src='$tm7_img' WIDTH='78' HEIGHT='26' border='0'></a></td>
  <!--이메일-->
  <td><a href='../mail/mail_send.php?mart_id=$mart_id'>
  <img src='$tm8_img' WIDTH='89' HEIGHT='26' border='0'></a></td>
</tr>
";
if($top_bg_color3 == "" && $top_bg_img3 == "" && $top_bg_color1 == "" && $top_bg_img1 == "") $top_bg_color3 = $menu_bg_color1;
$self_design_top .= "
<!--상품검색 시작-->
<form name=search action='../product/search.php'>
<input type=hidden name='search_type' value='item'>
<input type=hidden name='mart_id' value='$mart_id'>
<tr bgcolor='$top_bg_color3'>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan='3' class='dd'><p align='right'>search&nbsp; <input class='bb' name='itemname' size='17' style='height: 18; width: 93; border: 1px solid $top_bg_color3'><a href='javascript:document.search.submit()'><span class='dd'>go</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</form>
<!--상품검색 끝-->
</table>
";
?>
