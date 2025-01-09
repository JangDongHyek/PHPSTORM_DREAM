<?
if($icon_module != 'icon11_1' && $icon_module != 'icon11_2' && $icon_module != 'icon11_3' && $icon_module != 'icon11_4') //이 템플릿 탑과 레프트를 선택 안했을때.
$icon_module = 'icon11_1'; //기본 첫번째꺼
//배너1 화일이 그림화일인지 플래시 화일인지 확인
if($main_banner1_img != "") $tmp_main_banner1_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_banner1_img";
else $tmp_main_banner1_img = "../images/template5/banner1.gif";

if($main_banner1_img != ""){
	if(substr($main_banner1_img,-4,4) == ".gif" || substr($main_banner1_img,-4,4) == ".jpg" || substr($main_banner1_img,-4,4) == ".bmp") $img_flag = "image"; 
	if(substr($main_banner1_img,-4,4) == ".swf") $img_flag = "flash"; 
}

if($main_banner1_img == ""){
	if($main_banner1_if_newwin == 1) $target_str = "target=_new";
	else $target_str = "";
	if($main_banner1_link == "")
	 $tmp_main_banner1_img_str = "<img src='$tmp_main_banner1_img' width='203'>";
	else 
		$tmp_main_banner1_img_str = "<a href='$main_banner1_link' $target_str><img src='$tmp_main_banner1_img' width='203' border='0'></a>";
}
else{
	if($img_flag == "image"){
 		if($main_banner1_height == '') $main_banner1_height = '53';
 		if($main_banner1_if_newwin == 1) $target_str = "target=_new";
		else $target_str = "";
		if($main_banner1_link == "")
	 	$tmp_main_banner1_img_str = "<img src='$tmp_main_banner1_img' width='203' height='$main_banner1_height'>";
		else 
		$tmp_main_banner1_img_str = "<a href='$main_banner1_link' $target_str><img src='$tmp_main_banner1_img' width='203' height='$main_banner1_height' border='0'></a>";
	}
 	if($img_flag == "flash")
		$tmp_main_banner1_img_str = "<embed src='$tmp_main_banner1_img' WIDTH='203' height='$main_banner1_height'></embed>";
}

//배너2 화일이 그림화일인지 플래시 화일인지 확인
if($main_banner2_img != "") $tmp_main_banner2_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_banner2_img";
else $tmp_main_banner2_img = "../images/template5/banner2.gif";

if($main_banner2_img != ""){
	if(substr($main_banner2_img,-4,4) == ".gif" || substr($main_banner2_img,-4,4) == ".jpg" || substr($main_banner2_img,-4,4) == ".bmp") $img_flag = "image"; 
	if(substr($main_banner2_img,-4,4) == ".swf") $img_flag = "flash"; 
}

if($main_banner2_img == ""){
	if($main_banner2_if_newwin == 1) $target_str = "target=_new";
	else $target_str = "";
	if($main_banner2_link == "")
	 $tmp_main_banner2_img_str = "<img src='$tmp_main_banner2_img' width='203'>";
	else 
		$tmp_main_banner2_img_str = "<a href='$main_banner2_link' $target_str><img src='$tmp_main_banner2_img' width='203' border='0'></a>";
}
else{
	if($img_flag == "image"){
 		if($main_banner2_height == '') $main_banner2_height = '53';
 		if($main_banner2_if_newwin == 1) $target_str = "target=_new";
		else $target_str = "";
		if($main_banner2_link == "")
	 	$tmp_main_banner2_img_str = "<img src='$tmp_main_banner2_img' width='203' height='$main_banner2_height'>";
		else 
		$tmp_main_banner2_img_str = "<a href='$main_banner2_link' $target_str><img src='$tmp_main_banner2_img' width='203' height='$main_banner2_height' border='0'></a>";
	}
 	if($img_flag == "flash")
		$tmp_main_banner2_img_str = "<embed src='$tmp_main_banner2_img' WIDTH='203' height='$main_banner2_height'></embed>";
}

//배너3 화일이 그림화일인지 플래시 화일인지 확인
if($main_banner3_img != "") $tmp_main_banner3_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_banner3_img";
else $tmp_main_banner3_img = "../images/template5/banner3.gif";

if($main_banner3_img != ""){
	if(substr($main_banner3_img,-4,4) == ".gif" || substr($main_banner3_img,-4,4) == ".jpg" || substr($main_banner3_img,-4,4) == ".bmp") $img_flag = "image"; 
	if(substr($main_banner3_img,-4,4) == ".swf") $img_flag = "flash"; 
}

if($main_banner3_img == ""){
	if($main_banner3_if_newwin == 1) $target_str = "target=_new";
	else $target_str = "";
	if($main_banner3_link == "")
	 $tmp_main_banner3_img_str = "<img src='$tmp_main_banner3_img' width='203'>";
	else 
		$tmp_main_banner3_img_str = "<a href='$main_banner3_link' $target_str><img src='$tmp_main_banner3_img' width='203' border='0'></a>";
}
else{
	if($img_flag == "image"){
 		if($main_banner3_height == '') $main_banner3_height = '53';
 		if($main_banner3_if_newwin == 1) $target_str = "target=_new";
		else $target_str = "";
		if($main_banner3_link == "")
	 	$tmp_main_banner3_img_str = "<img src='$tmp_main_banner3_img' width='203' height='$main_banner3_height'>";
		else 
		$tmp_main_banner3_img_str = "<a href='$main_banner3_link' $target_str><img src='$tmp_main_banner3_img' width='203' height='$main_banner3_height' border='0'></a>";
	}
 	if($img_flag == "flash")
		$tmp_main_banner3_img_str = "<embed src='$tmp_main_banner3_img' WIDTH='203' height='$main_banner3_height'></embed>";
}

//추천상품이미지
if($main_chuchon_img != "") $tmp_main_chuchon_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_chuchon_img";
else $tmp_main_chuchon_img = "../images/template5/$icon_module/best-title.gif";

//신상품
if($main_newitem_img != "") $tmp_main_newitem_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_newitem_img";
else $tmp_main_newitem_img = "../images/template5/$icon_module/new-title.gif";

//기획상물
if($main_planitem_img != "") $tmp_main_planitem_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_planitem_img";
else $tmp_main_planitem_img = "../images/template5/$icon_module/dd-title.gif";

//기획상품1
if($main_planitem1_img != "") $tmp_main_planitem1_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_planitem1_img";
else $tmp_main_planitem1_img = "../images/template5/reco01.gif";

if($main_planitem1_if_newwin == 1) $target_str = "target=_new";
else $target_str = "";
if($main_planitem1_link == "")
 $tmp_main_planitem1_link_str = "<img src='$tmp_main_planitem1_img' WIDTH='192' HEIGHT='100'>";
else 
	$tmp_main_planitem1_link_str = "<a href='$main_planitem1_link' $target_str><img src='$tmp_main_planitem1_img' WIDTH='192' HEIGHT='100' border='0'></a>";

//기획상품2
if($main_planitem2_img != "") $tmp_main_planitem2_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_planitem2_img";
else $tmp_main_planitem2_img = "../images/template5/reco02.gif";

if($main_planitem2_if_newwin == 1) $target_str = "target=_new";
else $target_str = "";
if($main_planitem2_link == "")
 $tmp_main_planitem2_link_str = "<img src='$tmp_main_planitem2_img' WIDTH='192' HEIGHT='100'>";
else 
	$tmp_main_planitem2_link_str = "<a href='$main_planitem2_link' $target_str><img src='$tmp_main_planitem2_img' WIDTH='192' HEIGHT='100' border='0'></a>";

//공동구매 타이틀
if($main_union_title_img != "") $tmp_main_union_title_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_union_title_img";
else $tmp_main_union_title_img = "../images/template5/$icon_module/coo-title.gif";

//인기상품 타이틀
if($main_hititem_img != "") $tmp_main_hititem_img = "$Co_img_DOWN$mart_id/design2/temp5/$main_hititem_img";
else $tmp_main_hititem_img = "../images/template5/$icon_module/pop-title.gif";

$self_design_main .= "
<td width='609' valign='top' bgcolor='#FFFFFF'>
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
<tr>        
  <td width='100%'>
  <!--메인코드삽입 시작-->
  <div align='center'><center>
  <table cellspacing='0' cellpadding='0' width='100%' border='0'>
  <tr>
    <td width='100%' colspan='2'>
    <table border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td>$tmp_main_banner1_img_str</td>
      <td>$tmp_main_banner2_img_str</td>
      <td>$tmp_main_banner3_img_str</td>
    </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width='100%' colspan='2'><img src='$tmp_main_chuchon_img' WIDTH='609' HEIGHT='23'></td>
  </tr>
  <tr>
    <td width='100%' height='10' colspan='2'></td>
  </tr>
  <tr>
    <td width='100%' colspan='2'>
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
  <td width='100%' colspan='2'><img src='$tmp_main_newitem_img' WIDTH='609' HEIGHT='23'></td>
</tr>
<tr>
  <td width='100%' height='10' colspan='2'></td>
</tr>
<tr>
  <td width='100%' colspan='2'>
";
$self_design_main .= '
  <!--신상품 시작-->
  {bluecart $new_product}
  <!--신상품 끝-->
';
$self_design_main .= "
  </td>
</tr>
<tr>
  <td width='50%'><img src='$tmp_main_planitem_img' WIDTH='428' HEIGHT='23'></td>
  <td width='50%'><img src='$tmp_main_union_title_img' WIDTH='181' HEIGHT='23'></td>
</tr>
<tr>
  <td width='50%'>
  <table border='0' width='100%'>
  <tr>
    <td width='50%'><p align='center'>$tmp_main_planitem1_link_str</td>
    <td width='50%'><p align='center'>$tmp_main_planitem2_link_str</td>
  </tr>
  </table>
  </td>
";
$self_design_main .= '
  <!--우측공동구매 시작-->
  {bluecart $main_union}
  <!--우측공동구매 끝-->
';
$self_design_main .= "
</tr>
<tr>
  <td width='100%' colspan='2'><img src='$tmp_main_hititem_img' WIDTH='609' HEIGHT='23'></td>
</tr>
<tr>
  <td width='100%' colspan='2'>
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
  <td width='100%' colspan='2'></td>
</tr>
<tr>
  <td width='100%' colspan='2'></td>
</tr>
<tr>
  <td width='100%' colspan='2'></td>
</tr>
<tr>
  <td width='100%' colspan='2'></td>
</tr>
</table>
</center></div>
<!--메인코드삽입 끝-->
</td>
</tr>
</table>
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