<?
$self_design_top .= "
<!--회사소개 새창 스크립트-->
<script>
function company_win(){
  var url = 'http://$link';
  var uploadwin = window.open(url,'company','width=600,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes');
}
</script>
";
if($page_position == 1) $self_design_top .= "<div align='center'><center>";

//배경이미지
if($top_bg_img_all != "") $tmp_top_bg_img_all = "$Co_img_DOWN$mart_id/design2/temp4/$top_bg_img_all";
else $tmp_top_bg_img_all = "";

//외곽선 배경
if($top_bg_line_color != "") $tmp_top_bg_line_color = $top_bg_line_color;
else $tmp_top_bg_line_color = "#000000";

//배경1 색깔
if($top_bg_color1 != "") $tmp_top_bg_color1 = $top_bg_color1;
else $tmp_top_bg_color1 = "#ffffff";

//배경2 색깔
if($top_bg_color2 != "") $tmp_top_bg_color2 = $top_bg_color2;
else $tmp_top_bg_color2 = "#ffffff";

//회사로고
if(substr($top_logo_img,-4,4) == ".gif" || substr($top_logo_img,-4,4) == ".jpg" || substr($top_logo_img,-4,4) == ".bmp") $img_flag = "image"; 
if(substr($top_logo_img,-4,4) == ".swf") $img_flag = "flash"; 

if($top_logo_img == "") $top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='../images/template4/ci.gif' WIDTH='165' HEIGHT='37'></a>";
else {
	if($img_flag == "image"){
		$top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='$Co_img_DOWN$mart_id/design2/temp4/$top_logo_img' WIDTH='165' HEIGHT='37'></a>";		
	}
	if($img_flag == "flash"){
		$top_logo_img_str =  "
			<embed src='$Co_img_DOWN$mart_id/design2/temp4/$top_logo_img' WIDTH='165' HEIGHT='37'>
		";
	}
}

//홈 이미지	
if($top_home_img != "") $tmp_top_home_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_home_img";
else $tmp_top_home_img = "../images/template4/$icon_module/tm1000.gif";

//회사소개
if($top_intro_img != "") $tmp_top_intro_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_intro_img";
else $tmp_top_intro_img = "../images/template4/$icon_module/tm1001.gif";

//이용안내
if($top_guide_img != "") $tmp_top_guide_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_guide_img";
else $tmp_top_guide_img = "../images/template4/$icon_module/tm1002.gif";
	
//회원가입/변경
if($top_member_img != "") $tmp_top_member_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_member_img";
else $tmp_top_member_img = "../images/template4/$icon_module/tm1003.gif";
	
//장바구니
if($top_cart_img != "") $tmp_top_cart_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_cart_img";
else $tmp_top_cart_img = "../images/template4/$icon_module/tm1004.gif";

//주문조회
if($top_order_search_img != "") $tmp_top_order_search_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_order_search_img";
else $tmp_top_order_search_img = "../images/template4/$icon_module/tm1005.gif";
	
//게시판
if($top_board_img != "") $tmp_top_board_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_board_img";
else $tmp_top_board_img = "../images/template4/$icon_module/tm1006.gif";
	
//이메일
if($top_email_img != "") $tmp_top_email_img = "$Co_img_DOWN$mart_id/design2/temp4/$top_email_img";
else $tmp_top_email_img = "../images/template4/$icon_module/tm1007.gif";
	
	
if($intro_type == 3)
	$intro_str = "<a href='http://$link' target='_blank'>";
else
	$intro_str = "<a href='../info/company.php?mart_id=$mart_id'>";
$self_design_top .= "
<table border='1' width='750' bordercolor='$tmp_top_bg_line_color' cellspacing='0' cellpadding='0' style='border: thin'>
<tr>
  <td>
  <table border='0' width='750' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' background='$tmp_top_bg_img_all'>
  <tr height='50' bgcolor='$tmp_top_bg_color1'>
    <td colspan='4'>
    $top_logo_img_str</td>
    <td colspan='4' valign='bottom'>
    <p align='right'>
";
$self_design_top .= '
    <!--로그인 시작-->
    {bluecart $top_login}
    <!--로그인 끝-->
';      
$self_design_top .= "
    </td>
  </tr>
  <tr bgcolor='$tmp_top_bg_color2'>
    <!--홈으로가기-->
    <td>
    <a href='../main/index.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_home_img' WIDTH='69' HEIGHT='26'></a></td>
    <!--회사소개-->
    <td>
    $intro_str
    <img border='0' src='$tmp_top_intro_img' WIDTH='103' HEIGHT='26'></a></td>
    <!--이용안내-->
    <td>
    <a href='../info/user_guide.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_guide_img' WIDTH='102' HEIGHT='26'></a></td>
    <!--회원가입/변경-->
    <td>
    <a href='../mypage/mypage.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_member_img' WIDTH='103' HEIGHT='26'></a></td>
    <!--장바구니-->
    <td>
    <a href='../cart/cart_view.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_cart_img' WIDTH='103' HEIGHT='26'></a></td>
    <!--주문조회-->
    <td>
    <a href='../stat/order.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_order_search_img' WIDTH='103' HEIGHT='26'></a></td>
    <!--게시판-->
    <td>
    <a href='../board/board_list.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_board_img' WIDTH='78' HEIGHT='26'></a></td>
    <!--이메일-->
    <td>
    <a href='../mail/mail_send.php?mart_id=$mart_id'>
    <img border='0' src='$tmp_top_email_img' WIDTH='89' HEIGHT='26'></a></td>
  </tr>
  </table>
";
?>
