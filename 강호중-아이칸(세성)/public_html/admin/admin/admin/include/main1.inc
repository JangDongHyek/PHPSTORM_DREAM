<?
$self_design_main .= "
<!--메인코드시작-->
<td valign=top width='609' bgcolor=#ffffff> 
<!--메인코드삽입 시작-->
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr> 
  <td width='420' valign='top' bgcolor='#ffffff'>
  <div align='center'><center>

  <table border='0' width='90%'> 
  <tr> 
    <td width='100%' height='5' colspan='3'></td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3'>
    <p align='center'>
";
if(strtolower(substr($main_main_img,-4,4)) == ".gif" || strtolower(substr($main_main_img,-4,4)) == ".jpg" || strtolower(substr($main_main_img,-4,4)) == ".bmp") $img_flag = "image"; 
if(strtolower(substr($main_main_img,-4,4)) == ".swf") $img_flag = "flash"; 

if($main_main_img == "")$self_design_main .= "<img border='0' src='../images/main.jpg' width='396' height='188'>";
else {
	if($img_flag == "image"){
		$self_design_main .= "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_main_img' width='396'>";		
	}
	if($img_flag == "flash"){
		$self_design_main .= "
			<embed src='$Co_img_DOWN$mart_id/design2/$main_main_img' width='396' height='$main_main_img_flash_height'>
		";
	}
}
$self_design_main .= "
    </td> 
  </tr> 
";

if($if_notice == 't'){ //공지사항 시작
	if($main_news_title_img == "") $main_news_title_img_str = "<img border='0' src='../images/title3.gif' width='137' height='26'>";
	else $main_news_title_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_news_title_img' width='137' height='26'>";
  
  if($main_news_img == "") $main_news_img_str = "<img border='0' src='../images/event.jpg' width='74' height='88'>";
  else $main_news_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_news_img' width='74' height='88'>";
        					
  $self_design_main .= "
  <tr> 
    <td width='100%' colspan='3'>
		$main_news_title_img_str
    </td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3'>
    <table border='0' width='100%' cellspacing='0' cellpadding='0'> 
    <tr> 
      <td width='20%' valign='top'>
      $main_news_img_str
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
    <td width='100%' colspan='3'>
    <p align='right'>
    <a href='../notice/notice_list.php?mart_id=$mart_id'>
    <img src='../images/more.gif' border='0' WIDTH='45' HEIGHT='15'></a>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td width='100%' background='../images/dot03_gray.gif' height='1' colspan='3'></td> 
  </tr> 
	";
}
//공지사항 끝
//추천상품 시작
if($main_chuchon_title_img == "") $main_chuchon_title_img_str = "<img border='0' src='../images/title4.gif' width='102' height='26'>";
else $main_chuchon_title_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_chuchon_title_img' width='102' height='26'>";
if($main_chuchon_exp_img == "") $main_chuchon_exp_img_str = "<img border='0' src='../images/title5.gif' width='137' height='26'>";
else $main_chuchon_exp_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_chuchon_exp_img' width='137' height='26'>";
    
//신상품 이미지
if($main_new_title_img == "") $main_new_title_img_str = "<img border='0' src='../images/title6.gif' width='159' height='26'>";
else $main_new_title_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_new_title_img' width='159' height='26'>";
if($main_new_exp_img == "") $main_new_exp_img_str = "<img border='0' src='../images/title7.gif' width='107' height='26'>";
else $main_new_exp_img_str = "<img border='0' src='$Co_img_DOWN$mart_id/design2/$main_new_exp_img' width='107' height='26'>";
    		
$self_design_main .= "
  <tr> 
    <td width='100%' colspan='3'>
    $main_chuchon_title_img_str
    $main_chuchon_exp_img_str
    </td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3' height='5'></td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3'>
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
    <td width='100%' colspan='3' height='5'></td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3' background='../images/dot03_gray.gif'></td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3'>
    $main_new_title_img_str
    $main_new_exp_img_str
    </td> 
  </tr> 
  <tr> 
    <td width='100%' colspan='3' height='5'></td> 
  </tr>
  <tr> 
    <td width='100%' colspan='3'>
";
$self_design_main .= '
    <!--신상품 시작-->
    {bluecart $new_product}
    <!--신상품 끝-->
';
$self_design_main .= "      		
    </td>
  </tr> 
  </table> 
  </center></div>
 	</td> 
  <td width='189' valign='top' bgcolor='#ffffff'>
  <table width='100%' cellspacing='0' cellpadding='0'> 
  <tr> 
    <td width='100%' height='3'></td> 
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
    <td width='100%' height='5'></td> 
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
//컨텐트 끝
if($if_chuchon == 't'){ //선물추천 시작
	if($main_present_title_img == "") $main_present_title_img_str = "<img src='../images/title9.gif' width='189' height='51'>";
	else $main_present_title_img_str = "<img src='$Co_img_DOWN$mart_id/design2/$main_present_title_img' width='189' height='51'>";

	$self_design_main .= "
  <tr>
    <td width='100%' height='5'></td> 
  </tr> 
  <tr> 
    <td width='100%'>
    <span class='aa'>
    $main_present_title_img_str
    </span>
    </td> 
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
  </table> 
  </td>
</tr>
</table>
<!--메인코드삽입 끝-->
</td>
<!--메인코드끝-->
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
