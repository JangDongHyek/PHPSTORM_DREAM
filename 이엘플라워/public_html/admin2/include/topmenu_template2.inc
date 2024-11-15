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
if($top_bg_color_all == "") $tmp_top_bg_color_all = "";
else $tmp_top_bg_color_all = $top_bg_color_all;

if($top_bg_color1 == "") $tmp_top_bg_color1 = $menu_bg_color_top;
else $tmp_top_bg_color1 = $top_bg_color1;

if($top_bg_color2 == "") $tmp_top_bg_color2 = $menu_bg_color1_top;
else $tmp_top_bg_color2 = $top_bg_color2;

if(substr($top_logo_img,-4,4) == ".gif" || substr($top_logo_img,-4,4) == ".jpg" || substr($top_logo_img,-4,4) == ".bmp") $img_flag = "image"; 
if(substr($top_logo_img,-4,4) == ".swf") $img_flag = "flash"; 

if($top_logo_img == "") $top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='../images/template1/ci.gif' WIDTH='260' HEIGHT='55'></a>";
else {
	if($img_flag == "image"){
			$top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='$Co_img_DOWN$mart_id/design2/temp2/$top_logo_img' WIDTH='260' HEIGHT='55' border='0'></a>";		
	}
	if($img_flag == "flash"){
			$top_logo_img_str =  "
			<embed src='$Co_img_DOWN$mart_id/design2/temp2/$top_logo_img' WIDTH='260' HEIGHT='55'>
			";
		}
}

if($top_home_img == "") $tm1_img = "../images/topmenu_template2/$icon_module/tm1000.gif";
else $tm1_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_home_img";

if($top_cart_img == "") $tm3_img = "../images/topmenu_template2/$icon_module/tm1002.gif";
else $tm3_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_cart_img";

if($top_order_search_img == "") $tm4_img = "../images/topmenu_template2/$icon_module/tm1003.gif";
else $tm4_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_order_search_img";

if($top_intro_img == "") $tm5_img = "../images/topmenu_template2/$icon_module/tm1004.gif";
else $tm5_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_intro_img";

if($top_guide_img == "") $tm6_img = "../images/topmenu_template2/$icon_module/tm1005.gif";
else $tm6_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_guide_img";

if($top_member_img == "") $tm7_img = "../images/topmenu_template2/$icon_module/tm1006.gif";
else $tm7_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_member_img";

if($top_board_img == "") $tm8_img = "../images/topmenu_template2/$icon_module/tm1007.gif";
else $tm8_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_board_img";

if($top_email_img == "") $tm9_img = "../images/topmenu_template2/$icon_module/tm1008.gif";
else $tm9_img = "$Co_img_DOWN$mart_id/design2/temp2/$top_email_img";

if($page_position == 1) $self_design_top .= "<div align='center'><center>";
$self_design_top .= "
<script>
function company_win(){
  var url = 'http://$link';
  var uploadwin = window.open(url,'company','width=600,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes');
}
</script>
<table border='0' width='750' cellspacing='0' cellpadding='0' bgcolor='$tmp_top_bg_color_all' background='$Co_img_DOWN$mart_id/design2/temp2/$top_bg_img_all'>
<tr>
  <td>$top_logo_img_str</td>
  <td>
  <table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td><div align='right'>
    <table border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <!--홈으로가기-->
      <td>
      <a href='../main/index.php?mart_id=$mart_id'>
      <img src='$tm1_img' border='0' WIDTH='82' HEIGHT='22'></a></td>
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
";
$self_design_top .= '
      <!--로그인 시작-->
      {bluecart $top_login}
      <!--로그인 끝-->
';      
$self_design_top .= "
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
      <!--장바구니-->
      <td><a href='../cart/cart_view.php?mart_id=$mart_id'>
      <img src='$tm3_img' border='0' WIDTH='82' HEIGHT='22'></a></td>
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
      <!--주문조회-->
      <td><p align='right'>
      <a href='../stat/order.php?mart_id=$mart_id'>
      <img src='$tm4_img' border='0' WIDTH='83' HEIGHT='22'></a></td>
    </tr>
    </table>
    </div></td>
  </tr>
  <tr>
    <td height='3'></td>
  </tr>
  <tr>
    <td><div align='right'>
    <table border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <!--회사소개-->
      <td>
";            			
if($intro_type == 3){
	$self_design_top .= "
      <a href='http://$link' target='_blank'>
	";
}
else{
	$self_design_top .= "
      <a href='../info/company.php?mart_id=$mart_id'>
	";
}
$self_design_top .= "
      <img src='$tm5_img' border='0' WIDTH='104' HEIGHT='22'></a></td>
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
      <!--이용안내-->
      <td>
      <a href='../info/user_guide.php?mart_id=$mart_id'>
      <img src='$tm6_img' border='0' WIDTH='104' HEIGHT='22'></a></td>
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
      <!--회원가입/변경-->
      <td>
      <a href='../mypage/mypage.php?mart_id=$mart_id'>
      <img src='$tm7_img' border='0' WIDTH='104' HEIGHT='22'></a></td>
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
      <!--게시판-->
      <td>
      <a href='../board/board_list.php?mart_id=$mart_id'>
      <img src='$tm8_img' border='0' WIDTH='82' HEIGHT='22'></a></td>
      <td><img src='../images/template1/blank.gif' WIDTH='2' HEIGHT='22'></td>
      <!--이메일-->
      <td>
      <a href='../mail/mail_send.php?mart_id=$mart_id'>
      <img src='$tm9_img' border='0' WIDTH='83' HEIGHT='22'></a></td>
    </tr>
    </table>
    </div></td>
  </tr>
  </table>
</td>
</tr>
<tr>
  <td colspan='2' height='20'></td>
</tr>
</table>
";
?>
