<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
if(!$ca_id){
	$ca_id=$it['ca_id'];
	
}
$firstCaIds = Array("10","20","60","70");//제사음식/명절차례상/시제음식/추가맞춤음식만 추가 배송보이게 하는 배열
$firstCaId = substr($ca_id,0,2);

$addTextArr = array("10"=>"맞춤견적","20"=>"맞춤견적","60"=>"맞춤견적","70"=>"맞춤견적","80"=>"뒷풀이음식","90"=>"뒷풀이음식","a0"=>"뒷풀이음식","b0"=>"뒷풀이음식");
$deliverys=Array(Array());
$sql="select * from g5_shop_sendcost where (1) group by sc_price order by sc_id asc ";
$result=sql_query($sql);
if(strval(array_search($firstCaId,$firstCaIds))!=""){
	for($i=0;$sRow=sql_fetch_array($result);$i++){
		$deliverys[$i]['sc_price']=$sRow[sc_price];
		$sql="select * from g5_shop_sendcost where sc_price='$sRow[sc_price]' order by sc_id asc";
		$result2=sql_query($sql);
		$deliverys[$i]['sc_name']="";
		for($j=0;$sRow2=sql_fetch_array($result2);$j++){
			$deliverys[$i]['sc_name'].=$sRow2[sc_name]."/";
		}
		$deliverys[$i]['sc_name']=substr($deliverys[$i]['sc_name'],0,strlen($deliverys[$i]['sc_name'])-1);
        $deliverys[$i]['sc_name']=str_replace("양산시 상북면",'상북면',$deliverys[$i]['sc_name']);
		$deliverys[$i]['sc_name']=str_replace("양산시",'양산',$deliverys[$i]['sc_name']);
		$deliverys[$i]['sc_name']=str_replace("김해시",'김해 <span class="color_green"> (진영읍 제외)</span>',$deliverys[$i]['sc_name']);
	}
}
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<style>
#ft_to_top{bottom:85px;}
#ft_to_call{bottom:85px;}

.bx-wrapper .bx-pager, 
.bx-wrapper .bx-controls-auto{
	bottom:0;
}
.bx-wrapper .bx-pager.bx-default-pager a {
	width: 66px;
	height: 66px;
	border-radius:0;
}
.bx-wrapper .bxslider{ height:63px !important;}
.bx-wrapper .bxslider li{ /*height:600px !important;*/}
	
	
.swiper-button-next, .swiper-button-prev {
    margin-top: -58px;
}
@media (max-width:1199px){
#sit_pvi img{width:100% !important; height:auto !important;max-width: 500px; margin: 0px auto;}
}
@media (max-width:992px){
.bx-wrapper .bx-pager.bx-default-pager a {
	width: 50px;
	height: 50px;
}
.bx-wrapper .bxslider{ height:auto !important;}
.bx-wrapper .bxslider li{ height:auto !important;}
}


</style>
<!-- 원산지 안내 Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index:999999">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">원산지안내</h2>
      </div>
      <div class="modal-body">
              <img src="<?php echo G5_THEME_URL; ?>/img/sub/20190808081930_7460.jpg" alt="" class="원산지 안내">
      </div>
      <div class="modal-footer">


      </div>
    </div>
  </div>
</div>

<form name="fitem" action="<?php echo $action_url; ?>" method="post" onsubmit="return fitem_submit(this);">
<input type="hidden" name="it_id[]" value="<?php echo $it['it_id']; ?>">
<input type="hidden" name="sw_direct">
<input type="hidden" name="url">

<div id="sit_ov_wrap">
    <?php
    // 이미지(중) 썸네일
    $thumb_img = '';
	$thumb_img_arr = Array();
    $thumb_img_w = 300; // 넓이
    $thumb_img_h = 300; // 높이

    for ($i=1; $i<=10; $i++)
    {
        if(!$it['it_img'.$i])
            continue;

        $thumb = get_it_thumbnail($it['it_img'.$i], $thumb_img_w, $thumb_img_h, '', true);
		$thumb2 = get_it_thumbnail($it['it_img'.$i], 60, 60, '', true);
		$thumb_img_arr[$i-1] = $thumb2;

        /*if(!$thumb)
            continue;*/

        $thumb_img .= '<li>';
        $thumb_img .= '<a>'.$thumb.'</a>';
        $thumb_img .= '</li>'.PHP_EOL;
    }
    if ($thumb_img)
    {
        echo '<div id="sit_pvi" class="col-lg-5 col-md-5 col-sm-5 col-xs-12">'.PHP_EOL;
        echo '<ul class="bxslider" style="width:'.$thumb_img_w.'px;height:'.$thumb_img_h.'px">'.PHP_EOL;
        echo $thumb_img;
        echo '</ul>'.PHP_EOL;
        echo '</div>';
    }
    ?>
    <script>
    $('.bxslider').bxSlider({
        adaptiveHeight: true,
        mode: 'fade',
    });
	window.onload=function(){
		$(".bx-pager-link").empty();
		//$(".bx-pager-link").css('width','66px').css('height','66px');
		<?php if(count($thumb_img_arr) > 0){ ?>
		<?php for($b=0; $b<count($thumb_img_arr); $b++){ ?>
		$(".bx-pager-link").eq(<?php echo $b ?>).html('<?php echo $thumb_img_arr[$b] ?>');
		
	//	$(".bx-pager-link").removeAttr('href');
		<?php } ?>
		<?php } ?>
	}
	
	//$(".bx-pager-link > img").css('border-radius','50%');

	$( window ).resize(function() {
		$(".bx-pager-link").empty();
		//$(".bx-pager-link").css('width','66px').css('height','66px');
		<?php if(count($thumb_img_arr) > 0){ ?>
		<?php for($b=0; $b<count($thumb_img_arr); $b++){ ?>
		$(".bx-pager-link").eq(<?php echo $b ?>).append('<?php echo $thumb_img_arr[$b] ?>');
//		$(".bx-pager-link").removeAttr('href');
		<?php } ?>
		<?php } ?>
		//$(".bx-pager-link > img").css('border-radius','50%');
	});
	$(function(){
		$(".bx-pager-link").on('mouseover', function(){
			var _idx = $(".bx-pager-link").index(this);
			$(".bx-pager-link").removeClass('active');
			$(".bx-pager-link").eq(_idx).click();
		});
	});
    </script>
    <section id="sit_ov" class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
        <h2>상품간략정보 및 구매기능</h2>
        <strong id="sit_title"><?php echo stripslashes($it['it_name']); ?></strong>
        <?php if($is_orderable) { ?>
        <p id="sit_opt_info">
            상품 선택옵션 <?php echo $option_count; ?> 개, 추가옵션 <?php echo $supply_count; ?> 개
        </p>
        <?php } ?>
        <div id="sit_star">
            <?php
            $sns_title = get_text($it['it_name']).' | '.get_text($config['cf_title']);
            $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$it['it_id'];

            if ($score = get_star_image($it['it_id'])) { ?>
            고객선호도 <span>별<?php echo $score?>개</span>
            <img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $score?>.png" alt="" class="sit_star">
            <?php } ?>

        </div>
        <div class="sit_ov_tbl col-lg-12 col-md-12">
            <table>
            <colgroup>
                <col class="grid_2">
                <col>
            </colgroup>
            <tbody>
            

            <?php if ($it['it_origin']) { ?>
            <tr>
                <th scope="row">원산지</th>
                <td><?php echo $it['it_origin']; ?></td>
            </tr>
            <?php } ?>

            <?php if ($it['it_brand']) { ?>
            <tr>
                <th scope="row">브랜드</th>
                <td><?php echo $it['it_brand']; ?></td>
            </tr>
            <?php } ?>
            <?php if ($it['it_model']) { ?>
            <tr>
                <th scope="row">모델</th>
                <td><?php echo $it['it_model']; ?></td>
            </tr>
            <?php } ?>
            <?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
            <tr>
                <th scope="row">판매가격</th>
                <td>판매중지</td>
            </tr>
            <?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
            <tr>
                <th scope="row">판매가격</th>
                <td>전화문의</td>
            </tr>
            <?php } else { // 전화문의가 아닐 경우?>
            <?php if ($it['it_cust_price']) { // 1.00.03?>
            <tr>
                <th scope="row">시중가격</th>
                <td><?php echo display_price($it['it_cust_price']); ?></td>
            </tr>
            <?php } ?>

            <tr>
                <th scope="row">판매가격</th>
                <td>
                    <span class="price"><?php echo display_price(get_price($it)); ?></span>
                    <input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
                </td>
            </tr>
            <?php } ?>
			<?php if ($it['it_maker']) { ?>
            <tr>
                <th scope="row">제조사</th>
                <td>
					<?php echo $it['it_maker']; ?>
					<a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm" style="color:#fff; margin-left:10px">원산지안내</a>
				</td>
            </tr>
            <?php } ?>

            <?php
            /* 재고 표시하는 경우 주석 해제
            <tr>
                <th scope="row">재고수량</th>
                <td><?php echo number_format(get_it_stock_qty($it_id)); ?> 개</td>
            </tr>
            */
            ?>

            <?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?>
            <tr>
                <th scope="row"><label for="disp_point">포인트</label></th>
                <td>
                    <?php
                    if($it['it_point_type'] == 2) {
                        echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
                    } else {
                        $it_point = get_item_point($it);
                        echo number_format($it_point).'점';
                    }
                    ?>
                </td>
            </tr>
            <?php } ?>
            <!--?php
            $ct_send_cost_label = '배송비결제';

                if($it['it_sc_type'] == 1)
                    $sc_method = '무료배송';
                else {
                    if($it['it_sc_method'] == 1)
                        $sc_method = '수령후 지불';
                    else if($it['it_sc_method'] == 2) {
                        $ct_send_cost_label = '<label for="ct_send_cost">배송비결제</label>';
                        $sc_method = '<select name="ct_send_cost" id="ct_send_cost">
                                          <option value="0">주문시 결제</option>
                                          <option value="1">수령후 지불</option>
                                      </select>';
                    }
                    else
                        $sc_method = '5만원 이상 구매시 무료 (이하 3500원)';
                }
            ?>
            <tr>
                <th><?php echo $ct_send_cost_label; ?></th>
                <td><?php echo $sc_method; ?></td>
            </tr-->
            <?php if($it['it_buy_min_qty']) { ?>
            <tr>
                <th>최소구매수량</th>
                <td><?php echo number_format($it['it_buy_min_qty']); ?> 개</td>
            </tr>
            <?php } ?>
            <?php if($it['it_buy_max_qty']) { ?>
            <tr>
                <th>최대구매수량</th>
                <td><?php echo number_format($it['it_buy_max_qty']); ?> 개</td>
            </tr>
            <?php } ?>
			<?php
				if($addTextArr[$it[ca_id]]){?>
			<tr>
				<th>추가제물</th>
				<td><?php echo $addTextArr[$it[ca_id]]?>에서 주문가능</td>
			</tr>
			<?php }?>
           <?php
								if(strval(array_search($firstCaId,$firstCaIds))!=""){?>
					<tr class="visible-xs" id="add_con01">
						<th scope="row">배송비</th>
						<td>
							<!-- 모바일 추가배송비 -->
                            <!-- 24.05.22 지역별 배송비를 자동으로 불러오기에는 데이터가 맞지 않아 수동 입력으로 수정-->
                            기장/정관: 15,000원</br>
                            양산: 15,000원~30,000원 </br>
                            강서구/김해<span class="color_green">(진영읍 제외)</span>: 25,000원 </br>
							<!-- <?php 
								for($i=0;$i<count($deliverys);$i++){
                                    $sc_names = array_unique(explode('/', $deliverys[$i]['sc_name']));
                                    $deliverys[$i]['sc_name'] = implode('/', $sc_names);
							?>
							<?php echo str_replace("부산 ","",str_replace("경남 ","",$deliverys[$i]['sc_name']))?> : <?php echo number_format($deliverys[$i]['sc_price']);?>원<br/>
							<?php }?> -->
							<!-- <span class="color_green">※ 진영읍의 경우 배송비 0원 입니다.</span> -->
							
							
							
							<!-- 모바일 추가배송비 -->
						</td>
					</tr>
					<?php }?>
            </tbody>
            </table>
        </div>
        <!--} 퀵구매-->
        <!-- 퀵구매버튼{ -->
        <div id="bt_btn">
        
        		<!--옵션{-->
				<?php if ($is_orderable) { ?>
                <button type="button" id="op_open" class="hd_opener visible-xs"><i class="fas fa-chevron-up"></i> 옵션열기</button>
				<?php } ?>
        		<div id="op_view" class="hd_div">
                <button type="button" id="op_close" class="hd_closer visible-xs"><i class="fas fa-chevron-down"></i> 옵션닫기</button>
					<?php
                    if($option_item) {
                    ?>
                    <section>
                        <h3>선택옵션</h3>
                        <table class="sit_op_sl">
                        <colgroup>
                            <col class="grid_2">
                            <col>
                        </colgroup>
                        <tbody>
                        <?php // 선택옵션
                        echo $option_item;
                        ?>
                        </tbody>
                        </table>
                    </section>
                    <?php
                    }
                    ?>
            
                    <?php
                    if($supply_item) {
                    ?>
                    <section>
                        <h3>추가옵션</h3>
                        <table class="sit_op_sl">
                        <colgroup>
                            <col class="grid_2">
                            <col>
                        </colgroup>
                        <tbody>
                        <?php // 추가옵션
                        echo $supply_item;
                        ?>
                        </tbody>
                        </table>
                    </section>
                    <?php
                    }
                    ?>
            
                    <?php if ($it['it_use'] && !$it['it_tel_inq'] && !$is_soldout) { ?>
                    <div id="sit_sel_option">
                    <?php
                    if(!$option_item) {
                        if(!$it['it_buy_min_qty'])
                            $it['it_buy_min_qty'] = 1;
                    ?>
                        <ul id="sit_opt_added">
                            <li class="sit_opt_list">
                                <input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
                                <input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
                                <input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
                                <input type="hidden" class="io_price" value="0">
                                <input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
                                <span class="sit_opt_subj"><?php echo $it['it_name']; ?></span>
                                <span class="sit_opt_prc">(+0원)</span>
                                <div class="sit_opt_qty">
                                    <input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" class="frm_input" size="5">
                                    <button type="button" class="sit_qty_plus">증가</button>
                                    <button type="button" class="sit_qty_minus">감소</button>
                                </div>
                            </li>
                        </ul>
                        <script>
                        $(function() {
                            price_calculate();
                        });
                        </script>
                    <?php } ?>
                    </div>
            
                    <div id="sit_tot_price"></div>
                    <?php } ?>
            
                    <?php if($is_soldout) { ?>
                    <p id="sit_ov_soldout">상품의 재고가 부족하여 구매할 수 없습니다.</p>
                    <?php } ?>
            
                </div>
		<?php
								if(strval(array_search($firstCaId,$firstCaIds))!=""){?>
        <div class="sit_ov_tbl col-lg-12 col-md-12 hidden-xs deli_box" id="add_con01">
            <table>
				<colgroup>
					<col class="grid_2">
					<col>
				</colgroup>
				<tbody>
					<tr>
						<th scope="row" style="width:20%;">배송비</th>
						<td>
							<!-- pc 추가배송비 -->
                            <!-- 24.05.22 지역별 배송비를 자동으로 불러오기에는 데이터가 맞지 않아 수동 입력으로 수정-->
                            기장/정관: 15,000원</br>
                            양산: 15,000원~30,000원 </br>
                            강서구/김해<span class="color_green">(진영읍 제외)</span>: 25,000원 </br>
                            <!-- <?php 
								for($i=0;$i<count($deliverys);$i++){
                                    $sc_names = array_unique(explode('/', $deliverys[$i]['sc_name']));
                                    $deliverys[$i]['sc_name'] = implode('/', $sc_names);
							?>
							<?php echo str_replace("부산 ","",str_replace("경남 ","",$deliverys[$i]['sc_name']))?> : <?php echo number_format($deliverys[$i]['sc_price']);?>원<br/>
							<?php }?> -->
<!-- 							<span class="color_green">※ 진영읍의 경우 배송비 0원 입니다.</span> -->
							<!-- pc 추가배송비 -->
							
							
							
						</td>
					</tr>
				</tbody>
        	</table>
        </div>
		<?php }?>
							<!-- pc 추가 배송비 -->
                <!--}옵션-->
        
                <div id="sit_ov_btn">
                    <?php if ($is_orderable) { ?>
                    <input type="submit" onclick="document.pressed=this.value;" value="장바구니" id="sit_btn_cart">
                    <input type="submit" onclick="document.pressed=this.value;" value="바로구매하기" id="sit_btn_buy">
                    <?php } ?>
                    <?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
                    <a href="javascript:popup_stocksms('<?php echo $it['it_id']; ?>');" id="sit_btn_buy" class="sit_btn_buy_alarm">재입고알림</a>
                    <?php } ?>
                    <?php /*?><a href="javascript:item_wish(document.fitem, '<?php echo $it['it_id']; ?>');"<?php if(!$is_orderable){ echo "class='w100'"; } ?> id="sit_btn_wish">위시리스트</a><?php */?>
					<?php if ($naverpay_button_js) { ?>
					<div class="naverpay-item"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
					<?php } ?>
					
                </div>
        </div>
        <!-- }퀵구매버튼 -->
    </section>
</div>
</form>

<?php /*?><div id="sit_sns">
    <?php echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_fb.png'); ?>
                <?php echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_twt.png'); ?>
                <?php echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_goo.png'); ?>
                <?php echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png'); ?>
                <a href="javascript:popup_item_recommend('<?php echo $it['it_id']; ?>');" id="sit_btn_rec">추천하기</a>
    <?php
    $href = G5_SHOP_URL.'/iteminfo.php?it_id='.$it_id;
    ?>
</div><?php */?>
<aside id="sit_siblings">
    <h2>다른 상품 보기</h2>
    <?php
    if ($prev_href || $next_href) {
        echo $prev_href.$prev_title.$prev_href2;
        echo $next_href.$next_title.$next_href2;
    } else {
        echo '<span class="sound_only">이 분류에 등록된 다른 상품이 없습니다.</span>';
    }
    ?>
</aside>

<!--탭-->
<div role="tabpanel" id="sit_tab">
    <!-- Nav tabs -->
    <!--<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab"><span class="hidden-xs">상품</span>상세정보</a></li>
        <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab"><span class="hidden-xs">상품</span>구매정보</a></li>
        <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab"><span class="hidden-xs">상품</span>후기<span class="item_use_count"><?php echo $item_use_count; ?></span></a></li>
        <li role="presentation"><a href="#qa" aria-controls="qa" role="tab" data-toggle="tab"><span class="hidden-xs">상품</span>문의<span class="item_qa_count"><?php echo $item_qa_count; ?></span></a></li>
        
    </ul>-->

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="detail" style="text-align:center;">
            <!--<h1>상품설명</h1>-->
            

					<?php if($default['de_mobile_rel_list_use']) { ?>
                    <!-- 관련상품 시작 { -->
                    <section id="sit_rel">
                        <h2>추천 상품</h2>
                        <div class="sct_wrap">
                            <div class="swiper-container prd_slide">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            <?php
                            $rel_skin_file = $skin_dir.'/'.$default['de_mobile_rel_list_skin'];
                            if(!is_file($rel_skin_file))
                                $rel_skin_file = G5_MSHOP_SKIN_PATH.'/'.$default['de_mobile_rel_list_skin'];

							
						
                            $sql = " select b.* from {$g5['g5_shop_item_relation_table']} a left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id) where a.it_id = '{$it['it_id']}' and b.it_use='1' ";
                            $list = new item_list($rel_skin_file, $default['de_mobile_rel_list_mod'], 0, $default['de_mobile_rel_img_width'], $default['de_mobile_rel_img_height']);
                            $list->set_query($sql);
                            echo $list->run();
                            ?>
                            </div>
                        </div>
                    </section>
                    <!-- } 관련상품 끝 -->
                    <?php } ?>

<img src="<?php echo G5_THEME_URL; ?>/img/detail_top.jpg" alt="" />
            <div id="sit_inf" class="win_desc">
               <!-- <?php if ($it['it_basic']) { // 상품 기본설명 ?>
                <div id="sit_inf_basic">
                     <?php echo $it['it_basic']; ?>
                </div>
                <?php } ?>-->

                <?php if ($it['it_explan'] || $it['it_mobile_explan']) { // 상품 상세설명 ?>
                <div id="sit_inf_explan">                    
                    <?php echo ($it['it_mobile_explan'] ? conv_content($it['it_mobile_explan'], 1) : str_replace("/smart",G5_URL."/smart",conv_content($it['it_explan'], 1))); ?>
                </div>
                <?php } ?>

                <?php
                if ($it['it_info_value']) {
                    $info_data = unserialize(stripslashes($it['it_info_value']));
                    if(is_array($info_data)) {
                        $gubun = $it['it_info_gubun'];
                        $info_array = $item_info[$gubun]['article'];
                ?>
                <!--<h2>상품 정보 고시</h2>-->
                <!-- 상품정보고시 -->
                <!--<ul id="sit_inf_open">
                    <?php
                    foreach($info_data as $key=>$val) {
                        $ii_title = $info_array[$key][0];
                        $ii_value = $val;
                    ?>
                    <li>
                        <strong><?php echo $ii_title; ?></strong>
                        <span><?php echo $ii_value; ?></span>
                    </li>
                    <?php } //foreach?>
                </ul>-->
                <!-- 상품정보고시 end -->
                <?php
                    } else {
                        if($is_admin) {
                            echo '<p>상품 정보 고시 정보가 올바르게 저장되지 않았습니다.<br>config.php 파일의 G5_ESCAPE_FUNCTION 설정을 addslashes 로<br>변경하신 후 관리자 &gt; 상품정보 수정에서 상품 정보를 다시 저장해주세요. </p>';
                        }
                    }
                } //if
                ?>

            </div>
            <!-- 상품설명 end -->
        </div>

        <div role="tabpanel" class="tab-pane" id="info">
            <h2 class="if_tit">배송정보</h2>
            <div class="win_desc_if">
                <?php echo get_text($default['de_baesong_content'], 1); ?>
            </div>

            <h2 class="if_tit">교환/반품</h2>
            <div class="win_desc_if">
                <?php echo get_text($default['de_change_content'], 1); ?>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="review">
            <h1  class="tit_no">사용후기</h1>
            <div id="itemuse" class="win_desc">
                <?php include_once('./itemuse.php'); ?>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="qa">
            <h1 class="tit_no">상품문의</h1>
            <div id="itemqa" class="win_desc">
                <?php include_once('./itemqa.php'); ?>
            </div>
        </div>

    </div>

</div>
<!--탭-->

    <ul id="sit_more">
        <li><a href="<?php echo $href; ?>" target="_blank">DETAIL</a></li>
        <?php if ($default['de_baesong_content']) { ?><li><a href="<?php echo $href; ?>&amp;info=dvr" target="_blank">INFO</a></li><?php } ?>

        <li><a href="<?php echo $href; ?>&amp;info=use" target="_blank">REVIEW<span class="item_use_count"><?php echo $item_use_count; ?></span></a></li>
        <li><a href="<?php echo $href; ?>&amp;info=qa" target="_blank">Q&amp;A<span class="item_qa_count"><?php echo $item_qa_count; ?></span></a></li>


    </ul>



<script>

$(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
        document.location.reload();
    }
});

$(function(){
    // 상품이미지 슬라이드
    var time = 500;
    var idx = idx2 = 0;
    var slide_width = $("#sit_pvi_slide").width();
    var slide_count = $("#sit_pvi_slide li").size();
    $("#sit_pvi_slide li:first").css("display", "block");
    if(slide_count > 1)
        $(".sit_pvi_btn").css("display", "inline");

    $("#sit_pvi_prev").click(function() {
        if(slide_count > 1) {
            idx2 = (idx - 1) % slide_count;
            if(idx2 < 0)
                idx2 = slide_count - 1;
            $("#sit_pvi_slide li:hidden").css("left", "-"+slide_width+"px");
            $("#sit_pvi_slide li:eq("+idx+")").filter(":not(:animated)").animate({ left: "+="+slide_width+"px" }, time, function() {
                $(this).css("display", "none").css("left", "-"+slide_width+"px");
            });
            $("#sit_pvi_slide li:eq("+idx2+")").css("display", "block").filter(":not(:animated)").animate({ left: "+="+slide_width+"px" }, time,
                function() {
                    idx = idx2;
                }
            );
        }
    });

    $("#sit_pvi_next").click(function() {
        if(slide_count > 1) {
            idx2 = (idx + 1) % slide_count;
            $("#sit_pvi_slide li:hidden").css("left", slide_width+"px");
            $("#sit_pvi_slide li:eq("+idx+")").filter(":not(:animated)").animate({ left: "-="+slide_width+"px" }, time, function() {
                $(this).css("display", "none").css("left", slide_width+"px");
            });
            $("#sit_pvi_slide li:eq("+idx2+")").css("display", "block").filter(":not(:animated)").animate({ left: "-="+slide_width+"px" }, time,
                function() {
                    idx = idx2;
                }
            );
        }
    });

    // 상품이미지 크게보기
    $(".popup_item_image").click(function() {
        var url = $(this).attr("href");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
    });
});

// 상품보관
function item_wish(f, it_id)
{
    f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id;
    f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
    f.submit();
}

// 추천메일
function popup_item_recommend(it_id)
{
    if (!g5_is_member)
    {
        if (confirm("회원만 추천하실 수 있습니다."))
            document.location.href = "<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo urlencode(G5_SHOP_URL."/item.php?it_id=$it_id"); ?>";
    }
    else
    {
        url = "<?php echo G5_SHOP_URL; ?>/itemrecommend.php?it_id=" + it_id;
        opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
        popup_window(url, "itemrecommend", opt);
    }
}

// 재입고SMS 알림
function popup_stocksms(it_id)
{
    url = "<?php echo G5_SHOP_URL; ?>/itemstocksms.php?it_id=" + it_id;
    opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
    popup_window(url, "itemstocksms", opt);
}


function fsubmit_check(f)
{
    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }
    //24.01.29 cs왔었음 리뉴얼로인해 결제안된다는 wc
	//alert("결제는 영남잔치상 리뉴얼관계로 잠시 중단된 상탭니다.\n 조속히 정상 처리하도록 하겠습니다. 감사합니다.");
	//return false;

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}

// 바로구매, 장바구니 폼 전송
function fitem_submit(f)
{
    if (document.pressed == "장바구니") {
        f.sw_direct.value = 0;
    } else { // 바로구매
        f.sw_direct.value = 1;
		var agent = navigator.userAgent.toLowerCase();
		if ((navigator.appName == 'Netscape' && agent.indexOf('trident') != -1) || (agent.indexOf("msie") != -1)) {
			alert("익스플로러에서 주문을 하면 오류가 발생하오니 다른 브라우저를 사용하시길 바랍니다.");
			return false;
		}
    }
	/*alert("결제는 영남잔치상 리뉴얼관계로 잠시 중단된 상탭니다.\n 조속히 정상 처리하도록 하겠습니다. 감사합니다.");
	return false;*/
    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}
</script>

<aside id="sit_siblings" class="bt">
    <h2>다른 상품 보기</h2>
    <?php
    if ($prev_href || $next_href) {
        echo $prev_href.$prev_title.$prev_href2;
        echo $next_href.$next_title.$next_href2;
    } else {
        echo '<span class="sound_only">이 분류에 등록된 다른 상품이 없습니다.</span>';
    }
    ?>
</aside>

