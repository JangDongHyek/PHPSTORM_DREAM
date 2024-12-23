<?
if($main_chuchon_title_img == "") $title4_img = "../images/template1/title4.gif";
else $title4_img = "$Co_img_DOWN$mart_id/design2/temp2/$main_chuchon_title_img";
if($main_chuchon_title_bg_color == "") $main_chuchon_title_bg_color = "#E9E9E9";

if($main_chuchon_exp_img == "") $title5_img = "../images/template1/title5.gif";
else $title5_img = "$Co_img_DOWN$mart_id/design2/temp2/$main_chuchon_exp_img";

if($main_news_title_img == "") $title3_img = "../images/template1/title3.gif";
else $title3_img = "$Co_img_DOWN$mart_id/design2/temp2/$main_news_title_img";
if($main_news_title_bg_color == "") $main_news_title_bg_color = "#E9E9E9";

if($main_new_title_img == "") $title6_img = "../images/template1/title6.gif";
else $title6_img = "$Co_img_DOWN$mart_id/design2/temp2/$main_new_title_img";
if($main_new_title_bg_color == "") $main_new_title_bg_color = "#E9E9E9";

if($main_menu1_bg_color == "") {
	if($menu_bg_color1 != '')
		$main_menu1_bg_color = $menu_bg_color1;
	else 
		$main_menu1_bg_color = '#baaf9c';
}
if($main_menu2_bg_color == "") {
	if($menu_bg_color1 != '')
		$main_menu2_bg_color = $menu_bg_color1;
	else	
		$main_menu2_bg_color = '#baaf9c';
}
	
$self_design_main .= "
<td rowspan='2' width='1' bgcolor='#ffffff'></td>
<td width='609' valign='top' colspan='3' bgcolor='#ffffff'>
<!--메인코드삽입 시작-->
<div align='center'><center>
";    	
if(strtolower(substr($main_main_img,-4,4)) == ".gif" || strtolower(substr($main_main_img,-4,4)) == ".jpg" || strtolower(substr($main_main_img,-4,4)) == ".bmp") $img_flag = "image"; 
if(strtolower(substr($main_main_img,-4,4)) == ".swf") $img_flag = "flash"; 

if($main_main_img == "") $tmp_main_img = "../images/template1/main.jpg";
else $tmp_main_img = "$Co_img_DOWN$mart_id/design2/temp2/$main_main_img";

if($main_main_img == "" || $img_flag == "image")
	$main_main_img_str = "<img src='$tmp_main_img' border='0' width=609>";
if($img_flag == "flash")
	$main_main_img_str = "<embed src='$tmp_main_img' width=609 HEIGHT='$main_main_img_flash_height'>";
			
$self_design_main .= "
<table height=5 cellspacing=0 cellpadding=0 width=609 border=0>
<tr> 
  <td valign=top colspan='7'> 
  <p align=center>$main_main_img_str</p>
  </td>
</tr>
<tr> 
  <td width=609 bgcolor='$main_chuchon_title_bg_color' background='$Co_img_DOWN$mart_id/design2/temp2/$main_chuchon_title_bg_img' colspan=7> 
  <p align=center><img height=26 src='$title4_img' width=102 border=0></p>
  </td>
</tr>
<tr> 
  <td width=609 colspan=7 height=5></td>
</tr>
<tr> 
  <td> 
  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%'>
";
$self_design_main .= '
    <!--추천상품 시작-->
    {bluecart $reco_product}
    <!--추천상품 끝-->
';      		
$self_design_main .= "
    </td>
  </tr>
  <tr>
    <td vAlign='top' height='5' colspan='5'>
    <table border='0' width='100%' cellspacing='0' cellpadding='0'>
    <tr>
      <td valign=top width=423 cellspacing='0' cellpadding='0' bgcolor=#ffffff>
      <table width='100%' cellspacing='0' cellpadding='0' border=0>
";
if($if_notice == 't'){ //공지사항 시작
	$self_design_main .= "
      <tr>
        <td width='100%' bgcolor='$main_news_title_bg_color' background='$Co_img_DOWN$mart_id/design2/temp2/$main_news_title_bg_img'>
        <img src='$title3_img' hspace='10' border='0' WIDTH='110' HEIGHT='24'></td>
      </tr>
      <tr>
        <td width='100%'>
        <table border='0' width='100%'>
        <tr>
          <td width='100%'>
	";
	$self_design_main .= '
          <!--공지사항 시작-->
          {bluecart $notice}
          <!--공지사항 끝-->
	';
	$self_design_main .= "
          </td>
        </tr>
        <tr>
          <td width='146%'>
          <p align='right'>
          <a href='../notice/notice_list.php?mart_id=$mart_id'>
          <img src='../images/more.gif' border='0' WIDTH='45' HEIGHT='15'></a>&nbsp;&nbsp;&nbsp;</td>
        </tr>
        </table>
        </td>
      </tr>
	";
}
//공지사항 끝
$self_design_main .= "
      <tr>
        <td width='100%' bgcolor='$main_new_title_bg_color' background='$Co_img_DOWN$mart_id/design2/temp2/$main_new_title_bg_img'>
        <img src='$title6_img' hspace='10' WIDTH='110' HEIGHT='24'></td>
      </tr>
      <tr>
        <td width='100%' align='center' height='5'></td>
      </tr>
      <tr>
        <td width='100%' align='center'>
        <div align='center'><center>
";
$self_design_main .= '
        <!--신상품 시작-->
        {bluecart $new_product}
        <!--신상품 끝-->
';
$self_design_main .= "
        </center></div>
        </td>
      </tr>
      <tr>
        <td width='100%'></td>
      </tr>
      <tr>
        <td width='100%'></td>
      </tr>
      </table>
      </td>
      <td width='1' valign='top' bgcolor='#ffffff'></td>
      <td width='185' valign='top' bgcolor='#ffffff'>
";
//인기상품 시작
if($main_menu1_bg_img!='' && file_exists("$Co_img_UP$mart_id/design2/temp2/$main_menu1_bg_img")){
	$title7_str = "<img src='$Co_img_DOWN$mart_id/design2/temp2/$main_menu1_bg_img' WIDTH='185'>";
}	
else {
	$title7_str = "<img src='../../admin/images/title7.gif' width='185' height='24'>";
}
$self_design_main .= "
      <table cellspacing='0' cellpadding='0' border='0' width='185'>
      <tr>
        <td width='185' colspan='2' height='24'>
        <p align='center'><strong>$title7_str</strong></td>
      </tr>
      <tr>
        <td>
";
$self_design_main .= '
      <!--인기상품 시작-->
      {bluecart $pop_product}
      <!--인기상품 끝-->
';      		
$self_design_main .= "
      </td>
    </tr>
    </table>
";
$self_design_main .= '
    <!--컨텐트 시작-->
    {bluecart $right_content}
    <!--컨텐트 끝-->
';      		

$self_design_main .= "
    <table border='0' width='185' cellspacing='0' cellpadding='0' >
";
      	
if($if_chuchon == 't'){ //선물추천 시작
	if($main_menu2_bg_img!='' && file_exists("$Co_img_UP$mart_id/design2/temp2/$main_menu2_bg_img")){
		$title8_str = "<img src='$Co_img_DOWN$mart_id/design2/temp2/$main_menu2_bg_img' WIDTH='185'>";
	}	
	else {
		$title8_str = "<img src='../../admin/images/title8.gif' width='185' height='24'>";
	}
	$self_design_main .= "
    <tr>
      <td width='185' colspan='2' height='24'>
      <p align='center'><strong>$title8_str</strong></td>
    </tr>
    <tr>
      <td width='185' colspan='2' height='10'></td>
    </tr>
    <tr>
      <td width='185' colspan='2' height='3'>
	";
	$self_design_main .= '
      <!--선물추천 시작-->
      {bluecart $main_present}
      <!--선물추천 끝-->
	';        	
}
$self_design_main .= "
      </td>
    </tr>
    <tr>
      <td width='185' colspan='2'>
";
$self_design_main .= '
      <!--파트너쉽 링크배너 시작-->
      {bluecart $partner}
      <!--파트너쉽 링크배너 끝-->
';
$self_design_main .= "
      </td>
    </tr>
    <tr>
      <td width='185' colspan='2'>
";
$self_design_main .= '
      <!--배너 시작-->
      {bluecart $right_banner}
      <!--배너 끝-->
';      		
$self_design_main .= "
      </td>
    </tr>
    <tr>
      <td width='185' colspan='2'><span class='ee'></span></td>
    </tr>
    </table>
    </td>
  </tr>
  </table>
  </td>
</tr>
</table>
</td>
</tr>
</table>
</center></div>
<!--메인코드삽입 끝-->
</td>
</tr>
</table>
";
include( '../include/bottom_main.inc' );
$self_design_main .= "
</body>
</html>
";
$self_design_main .= '
<!--이벤트 시작-->
{bluecart $event}
<!--이벤트 끝-->
';      		
$self_design_main .= '
<!--스크롤배너 시작-->
{bluecart $scrol_banner}
<!--스크롤배너 끝-->
'; 
?>
