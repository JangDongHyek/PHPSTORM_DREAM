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

//배경 이미지
if($top_bg_img != "") $tmp_top_bg_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_bg_img";
else $tmp_top_bg_img = "../images/template5/top_image2.jpg";
 
//배경 왼편 이미지
if($top_bg_left_img != "") $top_bg_left_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_bg_left_img";
else $top_bg_left_img = "../images/template5/sam.jpg";

//그림화일인지 플래시 화일인지 확인
if($top_bg_left_img != ""){
	if(substr($top_bg_left_img,-4,4) == ".gif" || substr($top_bg_left_img,-4,4) == ".jpg" || substr($top_bg_left_img,-4,4) == ".bmp") $img_flag = "image"; 
		if(substr($top_bg_left_img,-4,4) == ".swf") $img_flag = "flash"; 
}
if($top_bg_left_img == "") $tmp_top_bg_left_img_str = "<img src='$tmp_main_main_img' width='453' width='177'>";
else {
	if($img_flag == "image"){
		$tmp_top_bg_left_img_str = "<img src='$top_bg_left_img' width='453' width='177'>";		
	}
	if($img_flag == "flash"){
		$tmp_top_bg_left_img_str = "<embed src='$top_bg_left_img' WIDTH='453' height='$top_bg_left_img_height'></embed>";
	}
}
		
//회사로고  
if(substr($top_logo_img,-4,4) == ".gif" || substr($top_logo_img,-4,4) == ".jpg" || substr($top_logo_img,-4,4) == ".bmp") $img_flag = "image"; 
if(substr($top_logo_img,-4,4) == ".swf") $img_flag = "flash"; 

if($top_logo_img == "") $top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='../images/template5/ci.gif' WIDTH='165' HEIGHT='37'></a>";
else {
	if($img_flag == "image"){
		$top_logo_img_str = "<a href='../main/index.php?mart_id=$mart_id'><img border='0' src='$Co_img_DOWN$mart_id/design2/temp5/$top_logo_img' WIDTH='165' HEIGHT='37'></a>";		
	}
	if($img_flag == "flash"){
		$top_logo_img_str =  "
		<embed src='$Co_img_DOWN$mart_id/design2/temp5/$top_logo_img' WIDTH='165' HEIGHT='37'>
		";
	}
}
 
//홈 이미지        
if($top_home_img != "") $tmp_top_home_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_home_img";
else $tmp_top_home_img = "../images/template5/$icon_module/menu01.gif";

//회사소개 이미지        
if($top_intro_img != "") $tmp_top_intro_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_intro_img";
else $tmp_top_intro_img = "../images/template5/$icon_module/menu02.gif";

//이용안내 이미지        
if($top_guide_img != "") $tmp_top_guide_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_guide_img";
else $tmp_top_guide_img = "../images/template5/$icon_module/menu03.gif";

//회원가입/변경 이미지       
if($top_member_img != "") $tmp_top_member_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_member_img";
else $tmp_top_member_img = "../images/template5/$icon_module/menu04.gif";

//장바구니 이미지        
if($top_cart_img != "") $tmp_top_cart_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_cart_img";
else $tmp_top_cart_img = "../images/template5/$icon_module/menu05.gif";

//주문조회 이미지        
if($top_order_search_img != "") $tmp_top_order_search_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_order_search_img";
else $tmp_top_order_search_img = "../images/template5/$icon_module/menu06.gif";

//게시판 이미지
if($top_board_img != "") $tmp_top_board_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_board_img";
else $tmp_top_board_img = "../images/template5/$icon_module/menu07.gif";
        

//이메일 이미지
if($top_email_img != "") $tmp_top_email_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_email_img";
else $tmp_top_email_img = "../images/template5/top02_04.gif";
        
//뉴스 이미지        
if($top_news_img != "") $tmp_top_news_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_news_img";
else $tmp_top_news_img = "../images/template5/top_noti.gif";

//뉴스리스트 이미지        
if($top_news_more_img != "") $tmp_top_news_more_img = "$Co_img_DOWN$mart_id/design2/temp5/$top_news_more_img";
else $tmp_top_news_more_img = "../images/template5/more.gif";

if($intro_type == 3)
	$intro_str = "<a href='http://$link' target='_blank'>";
else
	$intro_str = "<a href='../info/company.php?mart_id=$mart_id'>";
$self_design_top .= "
<table border='0' width='750' cellspacing='0' cellpadding='0' bgcolor='$top_top_color' background='$Co_img_DOWN$mart_id/design2/temp5/$top_top_img'>
<tr>
  <td colspan='4'>$top_logo_img_str</td>
  <td colspan='4' valign='bottom'><p align='right'>
";
$self_design_top .= '
  <!--로그인 시작-->
  {bluecart $top_login}
  <!--로그인 끝-->
';      
$self_design_top .= "
  <img src='../images/template5/top02_back.gif' border='0' WIDTH='2' HEIGHT='20'><a href='../mail/mail_send.php?mart_id=$mart_id'><img src='$tmp_top_email_img' border='0' WIDTH='58' HEIGHT='20'></a></td>
</tr>
</table>
<table border='0' width='750' cellspacing='0' cellpadding='0'>
<tr>
  <td colspan='8' valign='top'>
  <table border='0' width='750' height='172' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='750' background='$tmp_top_bg_img' valign='top'>
    <table border='0' width='100%' height='177' cellspacing='0' cellpadding='0'>
    <tr>
      <td width='453'>$tmp_top_bg_left_img_str</td>
      <td width='297' valign='top'>
";
if($if_notice == 't'){ //공지사항 시작
	$self_design_top .= "
      <table border='0' width='297' align='right' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='100%' height='20' colspan='2'></td>
      </tr>
      <tr>
        <td width='100%' colspan='2'>
        <img src='$tmp_top_news_img' WIDTH='107' HEIGHT='19'></td>
      </tr>
      <tr>
        <td width='100%' height='10' colspan='2'></td>
      </tr>
      <tr>
        <td width='100%' height='10' colspan='2'>
  ";
  $self_design_top .= '
        <!--공지사항 시작-->
        {bluecart $notice}
        <!--공지사항 끝-->
	';      
  $self_design_top .= "
        </td>
        </tr>
        <tr>
          <td width='100%' height='20' colspan='2'><div align='right'><table border='0' width='50%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%'><p align='center'><a href='../notice/notice_list.php?mart_id=$mart_id'><img src='$tmp_top_news_more_img' border='0' WIDTH='45' HEIGHT='15'></a></td>
        </tr>
        </table>
        </div></td>
      </tr>
      </table>
	";
}
$self_design_top .= "
      </td>
    </tr>
    </table>
    </td>
  </tr>
  </table>
  </td>
</tr>
<tr>
  <td>
  <a href='../main/index.php?mart_id=$mart_id'>
  <img src='$tmp_top_home_img' WIDTH='106' HEIGHT='36' border='0'></a></td>
  <td>
  $intro_str
  <img src='$tmp_top_intro_img' WIDTH='106' HEIGHT='36' border='0'></a></td>
  <td>
  <a href='../info/user_guide.php?mart_id=$mart_id'>
  <img src='$tmp_top_guide_img' WIDTH='106' HEIGHT='36' border='0'></a></td>
  <td>
  <a href='../mypage/mypage.php?mart_id=$mart_id'>
  <img src='$tmp_top_member_img' WIDTH='110' HEIGHT='36' border='0'></a></td>
  <td>
  <a href='../cart/cart_view.php?mart_id=$mart_id'>
  <img src='$tmp_top_cart_img' WIDTH='106' HEIGHT='36' border='0'></a></td>
  <td>
  <a href='../stat/order.php?mart_id=$mart_id'>
  <img src='$tmp_top_order_search_img' WIDTH='110' HEIGHT='36' border='0'></a></td>
  <td>
  <a href='../board/board_list.php?mart_id=$mart_id'>
  <img src='$tmp_top_board_img' WIDTH='106' HEIGHT='36' border='0'></a></td>
  </tr>
  </table>
";
?>

