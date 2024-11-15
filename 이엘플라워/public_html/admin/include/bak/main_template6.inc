<?
$self_design_main .= "
<table width='990' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='10' colspan='3' ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='$mart_id'>
	<tr>
    <td width='30' height='30'>&nbsp;</td>
    <td width='500' background='../images/template6/image/top/search_bg.gif' class='text_left'><MARQUEE DIRECTION='left'><span class='text_left'><span class='style1'>트렉스타 쇼핑몰</span>에 오신것을 진심으로 환영합니다. 알찬쇼핑 즐거운시간 되시길 바랍니다!</span> 
    </MARQUEE></td>
    <td width='460' align='right' background='../images/template6/image/top/search_bg.gif' class='text_right'><input name='itemname' type='text' class='input_search'>
        <a href='javascript:document.search.submit()'><img src='../images/template6/image/top/bu_search.gif' width='56' height='22' border='0' align='absmiddle'></a></td>
  </tr>
  </form>
  <tr>
    <td height='10' colspan='3' ></td>
  </tr>
</table>
<!--검색부분끝-->
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='30'>&nbsp;</td>
    <td width='960'>
      <table width='960' border='0' align='center' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='230'>
  <!--카테고리시작-->
            <table width='230' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='90' rowspan='2' valign='bottom' background='../images/template6/image/main/category_left_bg.gif'><img src='../images/template6/image/main/category_left_img.gif' width='90' height='255'></td>
                <td><img src='../images/template6/image/main/category_top.gif' width='140' height='3'></td>
              </tr>
              <tr>
                <td><table width='140' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=10'><img src='../images/template6/image/main/category_1.gif' width='140' height='25' border='0' onMouseOver=\"MM_showHideLayers('Layer1','','show')\"></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=9'><img src='../images/template6/image/main/category_2.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=8'><img src='../images/template6/image/main/category_3.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=7'><img src='../images/template6/image/main/category_4.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=6'><img src='../images/template6/image/main/category_5.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=5'><img src='../images/template6/image/main/category_6.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=4'><img src='../images/template6/image/main/category_7.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=3'><img src='../images/template6/image/main/category_8.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=2'><img src='../images/template6/image/main/category_9.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                  <tr>
                    <td><a href='../product/product_list.php?mart_id=$mart_id&category_num=1'><img src='../images/template6/image/main/category_10.gif' width='140' height='25' border='0'></a></td>
                  </tr>
                </table></td>
              </tr>
          </table>
  <!--카테고리끝-->
          </td>
          <td width='10'></td>
          <td width='320'><img src='../images/template6/image/main/visual_img.gif' width='320' height='255'></td>
        <td width='10'></td>
          <td width='390' valign='top'>
  
  ";
	$self_design_main .= '
  <!--공지사항시작-->
  {bluecart $notice}
  <!--공지사항끝-->
	';      		
	$self_design_main .= "  
<!--스페샬상품시작--><table width='390' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td colspan='3'><img src='../images/template6/image/main/09_top.gif' width='390' height='30'></td>
    </tr>
  <tr>
    <td width='180'><img src='../images/template6/image/main/09_left.gif' width='180' height='110'></td>
    <td width='200'><!--상품--><table width='200' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='110'><img src='../images/template6/image/sample_img_1.gif' width='110' height='80'></td>
        <td width='90'><table width='80' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td align='center' class='product_09'>108.800원</td>
          </tr>
          <tr>
            <td><table width='80' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='5'><img src='../images/template6/image/main/09_bar1_left.gif' width='5' height='10'></td>
                <td bgcolor='E5E5E5'><img src='../images/template6/image/main/09_bar1_bg.gif' width='20' height='10'><img src='../images/template6/image/main/09_bar1_right.gif' width='5' height='10'></td>
                <td width='5'><img src='../images/template6/image/main/09_bar1_end.gif' width='5' height='10'></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align='center'><img src='../images/template6/image/main/09_arrow.gif' width='14' height='18'></td>
          </tr>
          <tr>
            <td align='center'><span class='product_price'>68.800원</span></td>
          </tr>
          <tr>
            <td><table width='80' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='5'><img src='../images/template6/image/main/09_bar2_left.gif' width='5' height='10'></td>
                <td bgcolor='E5E5E5'><img src='../images/template6/image/main/09_bar2_bg.gif' width='50' height='10'><img src='../images/template6/image/main/09_bar2_right.gif' width='5' height='10'></td>
                <td width='5'><img src='../images/template6/image/main/09_bar2_end.gif' width='5' height='10'></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr align='center'>
        <td height='30' colspan='2' background='../images/template6/image/main/09_bg.gif' class='product_title'>[한정수랑]어드벤츠(여성용)</td>
        </tr>
    </table><!--상품끝--></td>
    <td width='10'><img src='../images/template6/image/main/09_right.gif' width='10' height='110'></td>
  </tr>
  <tr>
    <td colspan='3'><img src='../images/template6/image/main/09_bottom.gif' width='390' height='20'></td>
    </tr>
</table>

         <!--스페샬상품끝-->
          </td>
        </tr>
      </table><table width='960' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='560'><!--브랜드멸 BEST추천상품 시작-->
      <table width='560' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='390' background='../images/template6/image/main/brand_title_bg.gif'><img src='../images/template6/image/main/brand_title.gif' width='150' height='50'></td>
          <td width='170'><img src='../images/template6/image/main/brand_title_bu.gif' width='170' height='50'></td>
        </tr>
        <tr>
          <td colspan='2'><object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='560' height='170'>
            <param name='movie' value='../images/template6/flash/brand_1.swf'>
            <param name='quality' value='high'>
            <embed src='../images/template6/flash/brand_1.swf' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='560' height='170'></embed>
          </object></td>
          </tr>
      </table>      <!--브랜드멸 BEST추천상품 끝--></td>
    <td width='10'></td>
    <td width='390'><img src='../images/template6/image/main/coupon.gif' width='390' height='50'><img src='../images/template6/image/main/adver_product.gif' width='390' height='170'></td>
  </tr>
  <tr>
    <td height='2' colspan='3'></td>
    </tr>
</table>
  ";
$self_design_main .= '
  <!--신상품 시작-->
  {bluecart $new_product}
  <!--신상품 끝-->
';
$self_design_main .= "

  <!--스페셜상품 시작-->
<table width='960' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><img src='../images/template6/image/main/special_01.gif' width='190' height='170'></td>
    <td><img src='../images/template6/image/main/special_02.gif' width='190' height='170'></td>
    <td><img src='../images/template6/image/main/special_03.gif' width='190' height='170'></td>
    <td><img src='../images/template6/image/main/special_04.gif' width='190' height='170'></td>
    <td><img src='../images/template6/image/main/special_05.gif' width='190' height='170'></td>
  </tr>
</table>
<!--스페셜상품 끝-->
<!--배너상품 시작-->
<table width='960' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><img src='../images/template6/image/main/bannerproduct_01.gif' width='240' height='90'></td>
    <td><img src='../images/template6/image/main/bannerproduct_02.gif' width='240' height='90'></td>
    <td><img src='../images/template6/image/main/bannerproduct_03.gif' width='240' height='90'></td>
    <td><img src='../images/template6/image/main/bannerproduct_04.gif' width='240' height='90'></td>
    </tr>
  <tr>
    <td height='10' colspan='4'></td>
    </tr>
</table>
<!--배너상품 끝-->
<table width='960' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='160' valign='top'>
      <!--콜센타/계좌번호 시작-->
      <table width='150' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td><img src='../images/template6/image/main/callcenter.gif' width='150' height='100'></td>
        </tr>
        <tr>
          <td><img src='../images/template6/image/main/bank.gif' width='150' height='220'></td>
        </tr>
      </table>
      <!--콜센타/계좌번호 끝--></td>
    	<td width='800' valign='top'>
    	";
			$self_design_main .= '
	  	<!--인기상품 시작-->
	  	{bluecart $pop_product}
	  	<!--인기상품 끝-->
			';      		
			$self_design_main .= '
	  	<!--추천상품 시작-->
	  	{bluecart $reco_product}
	  	<!--추천상품 끝-->
			';  
			$self_design_main .= "
		  </td>
  	</tr>
  	<tr>
    	<td height='2' colspan='2'></td>
    </tr>
	</table></td><td>&nbsp;</td>
  </tr>
</table>
		";
include( '../include/bottom_main.inc' );
?>