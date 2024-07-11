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
// 배경1이미지
if($top_bg_img1 != "") $tmp_top_bg_img1 = "$Co_img_DOWN$mart_id/design2/temp3/$top_bg_img1";
else $tmp_top_bg_img1 = "";

if($icon_module == 'icon9_1') $tmp_top_bg_color2 = "#000000";
if($icon_module == 'icon9_2') $tmp_top_bg_color2 = "#6B9CD6";
if($icon_module == 'icon9_3') $tmp_top_bg_color2 = "#A5A563";
if($icon_module == 'icon9_4') $tmp_top_bg_color2 = "#AD0039";
if($icon_module == 'icon9_5') $tmp_top_bg_color2 = "#31949C";
if($icon_module == 'icon9_6') $tmp_top_bg_color2 = "#948C84";

// 상점 로고
if($top_logo_img != "") $tmp_top_logo_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_logo_img";
else $tmp_top_logo_img = "../images/topmenu_template3/ci.gif";

//그림화일인지 플래시 화일인지 확인
if($top_logo_img != ""){
	if(substr($top_logo_img,-4,4) == ".gif" || substr($top_logo_img,-4,4) == ".jpg" || substr($top_logo_img,-4,4) == ".bmp") $img_flag = "image"; 
	if(substr($top_logo_img,-4,4) == ".swf") $img_flag = "flash"; 
}

if($top_logo_img == "") $tmp_top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img src='$tmp_top_logo_img' WIDTH='141' HEIGHT='99' border='0'></a>";
else {
	if($img_flag == "image"){
		$tmp_top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img src='$tmp_top_logo_img' WIDTH='141' HEIGHT='99' border='0'></a>";		
	}
	if($img_flag == "flash"){
		$tmp_top_logo_img_str = "<embed src='$tmp_top_logo_img' WIDTH='141' HEIGHT='99'></embed>";
	}
}

// 홈 이미지
if($top_home_img != "") $tmp_top_home_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_home_img";
else $tmp_top_home_img = "../images/topmenu_template3/$icon_module/tm1000.gif";

// 회사소개 이미지
if($top_intro_img != "") $tmp_top_intro_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_intro_img";
else $tmp_top_intro_img = "../images/topmenu_template3/$icon_module/tm1001.gif";

// 이용안내 이미지
if($top_guide_img != "") $tmp_top_guide_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_guide_img";
else $tmp_top_guide_img = "../images/topmenu_template3/$icon_module/tm1002.gif";

// 회원가입변경 이미지
if($top_member_img != "") $tmp_top_member_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_member_img";
else $tmp_top_member_img = "../images/topmenu_template3/$icon_module/tm1003.gif";

// 장바구니 이미지
if($top_cart_img != "") $tmp_top_cart_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_cart_img";
else $tmp_top_cart_img = "../images/topmenu_template3/$icon_module/tm1004.gif";

// 주문조회 이미지
if($top_order_search_img != "") $tmp_top_order_search_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_order_search_img";
else $tmp_top_order_search_img = "../images/topmenu_template3/$icon_module/tm1005.gif";

// 게시판 이미지
if($top_board_img != "") $tmp_top_board_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_board_img";
else $tmp_top_board_img = "../images/topmenu_template3/$icon_module/tm1006.gif";

// 이메일 이미지
if($top_email_img != "") $tmp_top_email_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_email_img";
else $tmp_top_email_img = "../images/topmenu_template3/$icon_module/tm1007.gif";

//로그아웃 
$insert=0;
$member_session="Member_Session";
if(isset($HTTP_COOKIE_VARS[$member_session])&&$HTTP_COOKIE_VARS[$member_session]!="")
{
	$SQL = "select * from active_sessions where sid='$HTTP_COOKIE_VARS[$member_session]'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult); 
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$strVal = $ary["val"];
		if(strstr($strVal,"perm")){
			$insert = 1; //로그인 되어있슴
		}
	}
}
if($insert == 0){
	$login_str = "<a href='../mypage/mypage.php?mart_id=$mart_id'>";
	// 로그인 이미지
	if($top_login_img != "") $tmp_top_login_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_login_img";
	else $tmp_top_login_img = "../images/topmenu_template3/$icon_module/tm1008.gif";

}
else{
	$login_str = "<a href='../member/logout.php?mart_id=$mart_id'>";
	if($top_logout_img != "") $tmp_top_login_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_logout_img";
	else $tmp_top_login_img = "../images/topmenu_template3/$icon_module/tm1008_1.gif";
}


// 상품검색 이미지
if($top_item_search_img != "") $tmp_top_item_search_img = "$Co_img_DOWN$mart_id/design2/temp3/$top_item_search_img";
else $tmp_top_item_search_img = "../images/topmenu_template3/search.gif";

if($intro_type == 3)
	$intro_str = "<a href='http://$link' target='_blank'>";
else
	$intro_str = "<a href='../info/company.php?mart_id=$mart_id'>";
$self_design_top .= "
<table border='1' width='1000' bordercolor='$top_bg_line_color' cellspacing='0' cellpadding='0' style='border: thin'>
<tr>
  <td>
  <table border='0' width='1000' cellspacing='0' cellpadding='0' bgcolor='$top_bg_color1' background='$tmp_top_bg_img1'>
  <tr>
    <td>$tmp_top_logo_img_str</td>
    <td valign='bottom' width='859'>　
    <table border='0' cellspacing='0' cellpadding='0' width='859'>
    <tr>
      <!--홈으로가기-->
      <td width='659' bgcolor='$tmp_top_bg_color2'>
      <a href='../main/index.php?mart_id=$mart_id'>
      <img src='$tmp_top_home_img' border='0' WIDTH='68' HEIGHT='24'></a>
      <!--회사소개-->
      $intro_str
      <img src='$tmp_top_intro_img' border='0' WIDTH='67' HEIGHT='24'></a>
      <!--이용안내-->
      <a href='../info/user_guide.php?mart_id=$mart_id'>
      <img src='$tmp_top_guide_img' border='0' WIDTH='67' HEIGHT='24'></a>
      <!--회원가입/변경-->
      <a href='../mypage/mypage.php?mart_id=$mart_id'>
      <img src='$tmp_top_member_img' border='0' WIDTH='94' HEIGHT='24'></a>
      <!--장바구니-->
      <a href='../cart/cart_view.php?mart_id=$mart_id'>
      <img src='$tmp_top_cart_img' border='0' WIDTH='65' HEIGHT='24'></a>
      <!--주문조회-->
      <a href='../stat/order.php?mart_id=$mart_id'>
      <img src='$tmp_top_order_search_img' border='0' WIDTH='66' HEIGHT='24'></a>
      <!--게시판-->
      <a href='../board/board_list.php?mart_id=$mart_id'>
      <img src='$tmp_top_board_img' border='0' WIDTH='53' HEIGHT='24'></a>
      <!--이메일-->
      <a href='../mail/mail_send.php?mart_id=$mart_id'>
      <img src='$tmp_top_email_img' border='0' WIDTH='52' HEIGHT='24'></a>
";
$self_design_top .= '
      <!--로그인 시작-->
      {bluecart $top_login}<!--로그인 끝-->';      
$self_design_top .= "</td>
      <!--상품검색 시작-->
    	<form name=search action='../product/search.php'>
      <input type=hidden name='search_type' value='item'>
      <input type=hidden name='mart_id' value='$mart_id'>
      <td width='187' bgcolor='$tmp_top_bg_color2'>
      <img src='$tmp_top_item_search_img' align='absmiddle' WIDTH='73' HEIGHT='22'><input class='bb' name='itemname' size='17' style='height: 18; width: 93; border: 1px solid #ffffff'><span class='dd'><a href='javascript:document.search.submit()'>go</a></span></td></form>
      <!--상품검색 끝-->    	
    </tr>
    <tr>
      <td width='846' colspan='2'></td>
    </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan='3' bgcolor='#CECBCE' height='1'></td>
  </tr>
  </table>
";
?>
