<?
if($left_line_bg_color == "") $left_line_bg_color = "#9CA49C"; 
$self_design_main .= "
<td width='1' bgcolor='$left_line_bg_color'></td>
<td width='608' valign='top' colspan='3' bgcolor='#FFFFFF'>
<!--메인코드삽입 시작-->
<div align='center'><center>
<table cellspacing='0' cellpadding='0' width='100%' border='0'>
<tr>
  <td width='100%'><p align='center'>
";

if(strtolower(substr($main2_main_img,-4,4)) == ".gif" || strtolower(substr($main2_main_img,-4,4)) == ".jpg" || strtolower(substr($main2_main_img,-4,4)) == ".bmp") $img_flag = "image"; 
if(substr($main2_main_img,-4,4) == ".swf") $img_flag = "flash"; 

if($main2_main_img == "") $self_design_main .= "<img src='../images/main2/main.jpg' WIDTH='608' HEIGHT='180'>";
else{
	if($img_flag == "image"){
		$self_design_main .= "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main2_main_img' width='608'>";
	}
	if($img_flag == "flash"){
		$self_design_main .= "
		<embed src='$Co_img_DOWN$mart_id/design2/$main2_main_img' width='608' height='$main2_main_img_flash_height'>
		";
	}
}
$self_design_main .= "
  </td>
</tr>
<tr>
  <td width='100%'>
  <table cellspacing='0' cellpadding='0' width='100%' border='0'>
  <tr>
    <td width='420' valign='top' cellpadding='0' cellspacing='0'>
    <table border='0' width='418' cellpadding='0' cellspacing='0'>
";				      	

if($if_notice == 't'){ //공지사항 시작
	if($main2_news_title_img == "") $main2_news_title_img_str = "<img src='../images/main2/title3.gif' WIDTH='137' HEIGHT='26'>";
	else $main2_news_title_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main2_news_title_img' WIDTH='137' HEIGHT='26'>";
	
	if($main2_news_img == "") $main2_news_img_str = "<img border='0' src='../images/main2/event.jpg' WIDTH='74' HEIGHT='88'>";
	else $main2_news_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main2_news_img' WIDTH='74' HEIGHT='88'>";
	
	$self_design_main .= "
   <tr>
      <td width='100%'>
			<table border='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='100%' colspan='2'>
        $main2_news_title_img_str
        </td>
      </tr>
      <tr>
        <td width='20%'>
        $main2_news_img_str
        </td>
        <td width='80%' valign='top'>
	";	            			
	$self_design_main .= '
    <!--공지사항 시작-->
    {bluecart $notice}
    <!--공지사항 끝-->
	';
	$self_design_main .= "
        </td>
      </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td width='100%'>
      <p align='right'>
      <a href='../notice/notice_list.php?mart_id=$mart_id'>
      <img src='../images/more.gif' border='0' WIDTH='45' HEIGHT='15'></a>&nbsp;&nbsp;&nbsp;</td>
    </tr>
	";
}//공지사항 끝
if($main2_chuchon_title_img == "") $main2_chuchon_title_img_str = "<img border='0' src='../images/main2/title4.gif' WIDTH='102' HEIGHT='26'>";
else $main2_chuchon_title_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main2_chuchon_title_img' WIDTH='102' HEIGHT='26'>";

if($main2_new_title_img == "") $main2_new_title_img_str = "<img border='0' src='../images/main2/title6.gif' WIDTH='159' HEIGHT='26'>";
else $main2_new_title_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main2_new_title_img' WIDTH='159' HEIGHT='26'>";
				            			
$self_design_main .= "
    <tr>
      <td width='100%' height='1'>
      <table border='0' width='412'>
      <tr>
        <td width='206' colspan='2'>
        $main2_chuchon_title_img_str
        </td>
        <td width='1'></td>
        <td width='205' colspan='2'>
        $main2_new_title_img_str
        </td>
      </tr>
      <tr>
        <td width='412' colspan='5' background='../images/main2/dot03_gray.gif'></td>
      </tr>
      <tr>
        <td width='412' colspan='5' height='5'></td>
      </tr>
      <tr>
        <td width='3'></td>
        <td width='205' valign='top'>
";
$self_design_main .= '
        <!--추천상품 시작-->
        {bluecart $reco_product}
        <!--추천상품 끝-->
';      		
$self_design_main .= "
        </td>
        <td width='1' background='../images/main2/dot2.gif'></td>
        <td width='1'><br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        </td>
        <td width='204' valign='top'>
";
$self_design_main .= '
        <!--신상품 시작-->
        {bluecart $new_product}
        <!--신상품 끝-->
';
if($main2_menu1_bg_color == ""){
	$tmp_bgcolor = "#6B96CE";
}
else{
	$tmp_bgcolor = $main2_menu1_bg_color;
}
$self_design_main .= "
        </td>
      </tr>
      </table>
      </td>
    </tr>
    </table>
    </td>
    <td width='1' valign='top' bgcolor='#FFFFFF'></td>
    <td width='188' valign='top' bgcolor='$main2_menu_bg_color' background='$Co_img_DOWN$mart_id/design2/$main2_menu_bg_img'>
    <table border='0' width='188' cellspacing='0' cellpadding='0'>
    <tr>
      <td width='100%' bgcolor='$tmp_bgcolor' height='22' background='$Co_img_DOWN$mart_id/design2/$main2_menu1_bg_img'>
      <p align='center'>
      <span class='dd'><b>인기상품</b></span></td>
    </tr>
    <tr>
      <td width='100%'>
";
$self_design_main .= '
      <!--인기상품 시작-->
      {bluecart $pop_product}
      <!--인기상품 끝-->
';      		
$self_design_main .= "
      </td>
    </tr>
    <tr>  
      <td width='100%' height='10'></td> 
    </tr>
    <tr>
      <td width='100%'>
";			
$self_design_main .= '
    <!--컨텐트 시작-->
    {bluecart $right_content}
    <!--컨텐트 끝-->
';      		
$self_design_main .= "
    </td>
  </tr>
";
if($main2_menu2_bg_color == ""){
	$tmp_bgcolor = "#6B96CE";
}
else{
	$tmp_bgcolor = $main2_menu2_bg_color;
}
	
if($if_chuchon == 't'){ //선물추천 시작
	$self_design_main .= "
  <tr>  
    <td width='100%' height='5'></td> 
  </tr> 
  <tr>
    <td width='100%' bgcolor='#FFFFFF' height='10'></td>
  </tr>
  <tr>
    <td width='100%' bgcolor='$tmp_bgcolor' height='22' background='$Co_img_DOWN$mart_id/design2/$main2_menu2_bg_img'>
    <p align='center'><b>
    <span class='dd'>이런 선물 어떠세요?</span></b></td>
  </tr>
  <tr>
    <td width='100%'>
	";
	$self_design_main .= '
    <!--선물추천 시작-->
    {bluecart $main_present}
    <!--선물추천 끝-->
	';  		
	$self_design_main .= "
    </td>
  </tr>
	";
} 
$self_design_main .= "
  <tr>
    <td width='100%' height='10'></td>
  </tr>
  <tr>
    <td width='100%'>
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
    <td width='100%'>
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
    <td width='100%' height='3'></td>
  </tr>
  <tr>
    <td width='100%'></td>
  <tr>
    <td width='100%'>
    </td>
  </tr>
  </table>
  </td>
</tr>
</table>
</td>
</tr>
</table>
</center>
</div>
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