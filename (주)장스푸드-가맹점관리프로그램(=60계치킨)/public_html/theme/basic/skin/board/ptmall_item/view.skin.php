<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$hap_tot = 0;
$hap_tot2 = 0;
if($view['opt_use1'] != 'y' && $view['opt_use2'] != 'y' && $view['opt_use3'] != 'y'){
	$hap_tot = $view['wr_1'];
}
?>

<script>
     function chkNum(c){
          if((c.keyCode<48) || (c.keyCode>57)){
               return false;
          }
     }

     function onOnlyNumber(obj){
          for(var i=0; i<obj.value.length; i++){
               chr = obj.value.substr(i,1);
               chr = escape(chr);
               key_eg = chr.charAt(1);

               if(key_eg == "u"){
                    key_num = chr.substr(i,(chr.length-1));
                    if((key_num < "AC00") || (key_num > "D7A3")){
                         event.returnValue = false;
                    }
               }
          }

          if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 16){
               event.returnValue = true;
          }else{
               event.returnValue = false;
          }
     }
</script>

<script>
function comma(num){
    var len, point, str;
    num = num + "";
    point = num.length % 3 ;
    len = num.length;
    str = num.substring(0, point);

    while (point < len) {
        if (str != "") str += ",";
        str += num.substring(point, point + 3);
        point += 3;
    }
    return str;
}
</script>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<?php
if ($view['file']['count']) {
	$cnt = 0;
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']/* && !$view['file'][$i]['view']*/)
			$cnt++;
	}
}
?>

<article id="bo_v" style="width:<?php echo $width; ?>">

	<h2 id="container_title"><?php echo $board['bo_subject'] ?> 상세보기</h2>

	<form method="post" name="buy_frm" action="<?php echo G5_BBS_URL ?>/ptmall_cart_in.php" onsubmit="">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
	<?php if($view['file'][0]['file'] != ''){ ?>
	<input type="hidden" name="it_img" value="<?php echo $view['file'][0]['path'].'/'.$view['file'][0]['file'] ?>">
	<?php } ?>
	<input type="hidden" name="it_name" value="<?php echo $view['wr_subject'] ?>">
	<input type="hidden" name="it_price" value="<?php echo $view['wr_1'] ?>">
	<input type="hidden" name="price" id="price" value="<?php echo $view['wr_1'] ?>">
    <input type="hidden" name="price2" id="price2" value="<?php echo $view['wr_1'] ?>">
	<input type="hidden" name="it_fee" id="it_fee" value="<?php echo $view['wr_3'] ?>">
	<input type="hidden" name="hap_tot" id="hap_tot" value="<?php echo $hap_tot ?>">
    <input type="hidden" name="hap_tot2" id="hap_tot2" value="<?php echo $hap_tot2 ?>">
	<input type="hidden" name="ct_direct" id="ct_direct" value="">

	<input type="hidden" name="userPoint" id="userPoint" value="<?=MEMBER_POINT?>">

	<div id="cate_box" style="margin-top:30px; margin-left:2px;">
		<ul id="bo_cate_ul">
			<?php
			$c_sql = " select * from g5_ptmall_category order by ca_order desc, ca_idx asc ";
			$c_qry = sql_query($c_sql);
			$c_num = sql_num_rows($c_qry);
			if($c_num > 0){
				for($ca=0; $ca<$c_num; $ca++){
					$c_row = sql_fetch_array($c_qry);
					$cate_select = $cate_select_a = '';
					if($c_row['ca_idx'] == $category){
						$cate_select = 'cate_select';
						$cate_select_a = 'cate_select_a';
					}
			?>
			<li class="bo_cate_li <?php echo $cate_select ?>">
				<a class="bo_cate_li_a <?php echo $cate_select_a ?>" href="<?php echo G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&category='.$c_row['ca_idx'] ?>"><?php echo $c_row['ca_name'] ?></a>
			</li>
			<?php
				}
			}
			?>
		</ul>
		<div style="clear:both; margin:0; padding:0; width:0px; height:0px;"></div>
		<div class="list_line"></div>
	</div>

	<div id="form_box_info">
		<table class="form_tbl">
		<tbody>
		<tr>
			<td id="item_container1">
				<div>
					<span style="margin-right:5px; font-weight:bold;"><?php echo $view['wr_subject'] ?></span>
					<?php if($view['wr_4'] == 'y'){ ?><span class="icon1">★추천</span><?php }else{echo '&nbsp;';} ?>
				</div>
				<div class="item_info_line"></div>

				<div style="margin:0 auto; text-align:center;">
				<?php
				// 파일 출력
				$v_img_count = count($view['file']);
				if($v_img_count) {
					echo "<div id=\"bo_v_img\">\n";

					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							//echo $view['file'][$i]['view'];
							echo get_view_thumbnail($view['file'][$i]['view'],300);
						}
					}

					echo "</div>\n";
				}
				?>
				</div>
			</td>
			<td id="item_container2">
				<div class="item_info">
					<span class="item_title2">판매가 : </span>
					<span id="item_price"><?php echo number_format($view['wr_1']).' 원' ?></span>
				</div>
				<div class="item_info">
					<span class="item_title2">배송비 : </span>
					<span id="item_fee"><?php echo ($view['wr_3'] == 0)? 0 : number_format($view['wr_3']); ?> 원</span>
				</div>
				<?php if($view['wr_5'] == 'y' && ($view['opt_use1'] == 'y' || $view['opt_use2'] == 'y' || $view['opt_use3'] == 'y')){ ?>
				<div class="item_info">
					<span class="item_title2">상품옵션 : </span>

					<?php if($view['opt_use1'] == 'y'){ ?>
						<div class="opt_view_container">
							<input type="hidden" id="wr_opt1" value="<?php echo $view['wr_opt1'] ?>">
							<label><?php echo $view['wr_opt1'] ?></label>

							<select name="opt1" id="opt1">
								<option value="">(필수) 선택하세요</option>
								<?php
								$opt1_sql = " select * from g5_opt1 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' order by opt_idx asc ";
								$opt1_qry = sql_query($opt1_sql);
								$opt1_num = sql_num_rows($opt1_qry);
								if($opt1_num > 0){
									for($o=0; $o<$opt1_num; $o++){
										$opt1_row = sql_fetch_array($opt1_qry);
										$opt_price = $opt1_row['opt_price'];
										if($opt_price > 0){
											$opt_price_str = '(+'.number_format($opt_price).'원)';
										}else{
											$opt_price_str = '';
										}

                                        $opt_price2 = $opt1_row['opt_price2'];
                                        if($opt_price2 > 0){
                                            $opt_price_str2 = '(+'.number_format($opt_price2).'P)';
                                        }else{
                                            $opt_price_str2 = '';
                                        }
								?>
								<option value="<?php echo $opt1_row['opt_idx'] ?>|<?php echo str_replace('|','',$opt1_row['opt_name']); ?>|<?php echo $opt1_row['opt_price'] ?>|<?php echo str_replace('|','',$view['wr_opt1']); ?>|<?php echo $opt1_row['opt_price2'] ?>">
								<?php echo $opt1_row['opt_name'] ?> <?php echo $opt_price_str ?><?php echo $opt_price_str2 ?>
								</option>
								<?php
									}
								}
								?>
							</select>
						</div>
					<?php } ?>

					<?php if($view['opt_use2'] == 'y'){ ?>
						<div class="opt_view_container">
							<input type="hidden" id="wr_opt2" value="<?php echo $view['wr_opt2'] ?>">
							<label><?php echo $view['wr_opt2'] ?></label>

							<select name="opt2" id="opt2">
								<option value="">(필수) 선택하세요</option>
								<?php
								$opt2_sql = " select * from g5_opt2 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' order by opt_idx asc ";
								$opt2_qry = sql_query($opt2_sql);
								$opt2_num = sql_num_rows($opt2_qry);
								if($opt2_num > 0){
									for($o=0; $o<$opt2_num; $o++){
										$opt2_row = sql_fetch_array($opt2_qry);
										$opt_price = $opt2_row['opt_price'];
										if($opt_price > 0){
											$opt_price_str = '(+'.number_format($opt_price).'원)';
										}else{
											$opt_price_str = '';
										}

                                        $opt_price2 = $opt2_row['opt_price2'];
                                        if($opt_price2 > 0){
                                            $opt_price_str2 = '(+'.number_format($opt_price2).'P)';
                                        }else{
                                            $opt_price_str2 = '';
                                        }
								?>
								<option value="<?php echo $opt2_row['opt_idx'] ?>|<?php echo str_replace('|','',$opt2_row['opt_name']); ?>|<?php echo $opt2_row['opt_price'] ?>|<?php echo str_replace('|','',$view['wr_opt2']); ?>|<?php echo $opt2_row['opt_price2'] ?>">
								<?php echo $opt2_row['opt_name'] ?> <?php echo $opt_price_str ?><?php echo $opt_price_str2 ?>
								</option>
								<?php
									}
								}
								?>
							</select>
						</div>
					<?php } ?>

					<?php if($view['opt_use3'] == 'y'){ ?>
						<div class="opt_view_container">
							<input type="hidden" id="wr_opt3" value="<?php echo $view['wr_opt3'] ?>">
							<label><?php echo $view['wr_opt3'] ?></label>

							<select name="opt3" id="opt3">
								<option value="">(필수) 선택하세요</option>
								<?php
								$opt3_sql = " select * from g5_opt3 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' order by opt_idx asc ";
								$opt3_qry = sql_query($opt3_sql);
								$opt3_num = sql_num_rows($opt3_qry);
								if($opt3_num > 0){
									for($o=0; $o<$opt3_num; $o++){
										$opt3_row = sql_fetch_array($opt3_qry);
										$opt_price = $opt3_row['opt_price'];
										if($opt_price > 0){
											$opt_price_str = '(+'.number_format($opt_price).'원)';
										}else{
											$opt_price_str = '';
										}

                                        $opt_price2 = $opt3_row['opt_price2'];
                                        if($opt_price2 > 0){
                                            $opt_price_str2 = '(+'.number_format($opt_price2).'P)';
                                        }else{
                                            $opt_price_str2 = '';
                                        }
								?>
								<option value="<?php echo $opt3_row['opt_idx'] ?>|<?php echo str_replace('|','',$opt3_row['opt_name']); ?>|<?php echo $opt3_row['opt_price'] ?>|<?php echo str_replace('|','',$view['wr_opt3']); ?>|<?php echo $opt3_row['opt_price2'] ?>">
								<?php echo $opt3_row['opt_name'] ?> <?php echo $opt_price_str ?><?php echo $opt_price_str2 ?>
								</option>
								<?php
									}
								}
								?>
							</select>
						</div>
					<?php } ?>
				</div>
				<?php } ?>
				<div class="item_info">
					<div id="select_option">
					</div>
					<div style="text-align:right;">
						<label style="font-weight:bold; font-size:16px; color:#333;">총 상품 금액</label>
						<span id="tot_price_text"><?php echo number_format($hap_tot) ?> 원</span>
                        
					</div>

                    <div style="text-align:right;">
                        <label style="font-weight:bold; font-size:16px; color:#333;">총 상품 마일리지</label>
                        <span id="tot_price_text2"><?php echo number_format($hap_tot2) ?> P</span>

                    </div>


				</div>

				<?php if($view['wr_1'] > 0){ ?>
				<div class="item_info" style="text-align:right; border:0; line-height:60px;">
					<?php if($view['wr_2'] == 'NS'){ ?>
					<a id="cart_btn">장바구니 담기</a>
					<a id="order_btn">바로구매</a>
					<?php } ?>
				</div>
				<?php }else if($view['wr_1'] == 0){ ?>
				<div class="item_info" style="text-align:right; border:0; line-height:60px;">
					<?php if($view['wr_2'] == 'NS'){ ?>
					<a id="cart_btn">장바구니 담기</a>
					<a id="order_btn">바로구매</a>
					<?php } ?>
				</div>
				<?php } ?>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	</form>

	<div id="form_box_view">
		<div id="tab1" class="tab">
        	<ul>
            	<li class="on"><a href="#tab1">상품상세정보</a></li>
            	<li><a href="#tab2">배송안내</a></li>
            	<li><a href="#tab3">반품안내</a></li>
            </ul>
        </div>
		<div><?php echo get_view_thumbnail($view['content']); ?></div>

		<?php
		$co_sql = " select co_content, co_mobile_content from g5_content where co_id='common' ";
		$co_row = sql_fetch($co_sql);
		?>
		<div id="tab2" class="tab">
        	<ul>
            	<li><a href="#tab1">상품상세정보</a></li>
            	<li class="on"><a href="#tab2">배송안내</a></li>
            	<li><a href="#tab3">반품안내</a></li>
            </ul>
        </div>
		<div style="border-bottom:1px solid #cacaca;"><?php if($view['wr_content2']){ echo get_view_thumbnail($view['wr_content2']); }else{ echo $co_row['co_content']; } ?></div>

		<div id="tab3" class="tab">
        	<ul>
            	<li><a href="#tab1">상품상세정보</a></li>
            	<li><a href="#tab2">배송안내</a></li>
            	<li class="on"><a href="#tab3">반품안내</a></li>
            </ul>
        </div>
		<div style="border-bottom:1px solid #cacaca;"><?php if($view['wr_content3']){ echo get_view_thumbnail($view['wr_content3']); }else{ echo $co_row['co_mobile_content']; } ?></div>
	</div>
</article>
<!-- } 게시판 읽기 끝 -->

<script>
var member_point = <?=MEMBER_POINT?>;

$(function(){
	$("#opt1").on('change', function(){
		$("#opt2 option:eq(0)").prop('selected', true);
		$("#opt3 option:eq(0)").prop('selected', true);

		opt_items();
	});

	$("#opt2").on('change', function(){
		$("#opt3 option:eq(0)").prop('selected', true);

		if($("#opt1").length > 0){
			if($("#opt1").val() == ''){
				$("#opt2 option:eq(0)").prop('selected', true);
				alert('이전 옵션을 먼저 선택해주세요!');
				return false;
			}
		}

		opt_items();
	});

	$("#opt3").on('change', function(){
		if($("#opt1").length > 0){
			if($("#opt1").val() == ''){
				$("#opt3 option:eq(0)").prop('selected', true);
				alert('이전 옵션을 먼저 선택해주세요!');
				return false;
			}
		}

		if($("#opt2").length > 0){
			if($("#opt2").val() == ''){
				$("#opt3 option:eq(0)").prop('selected', true);
				alert('이전 옵션을 먼저 선택해주세요!');
				return false;
			}
		}

		opt_items();
	});


	$(document).on('click','.vary_up',function(){
		var _idx = $(".vary_up").index(this);
		var num = $(".quantity").eq(_idx).val();
		$(".quantity").eq(_idx).val((Number(num)+1));

		opt_sum(_idx);
	});

	$(document).on('click','.vary_down',function(){
		var _idx = $(".vary_down").index(this);
		var num = $(".quantity").eq(_idx).val();
		if(num > 1){
			$(".quantity").eq(_idx).val((Number(num)-1));
		}

		opt_sum(_idx);
	});

	$(document).on('keyup','.quantity',function(){
		var _idx = $(".quantity").index(this);

		if($(this).val() < 1){
			$(this).val(1);
		}

		opt_sum(_idx);
	});

	$(document).on('click','.opt_delete',function(){
		var _idx = $(".opt_delete").index(this);
		$(".options_container").eq(_idx).remove();

		hap_sum();
	});

	$("#cart_btn").on('click', function(){
		<?php if($view['opt_use1'] != 'y' && $view['opt_use2'] != 'y' && $view['opt_use3'] != 'y'){ ?>
		<?php }else{ ?>
			if($(".options_container").length <= 0){
				alert('주문옵션을 선택하시기 바랍니다');
				return false;
			}
		<?php } ?>

		$("#ct_direct").val('n');

		var frm_query = $("form[name=buy_frm]").serialize();

		$.ajax({
			type : 'post',
			url : '<?php echo G5_BBS_URL ?>/ptmall_cart_in.php',
			data : frm_query,
			dataType : 'html',
			success : function(html){
				if(confirm('장바구니에 상품이 담겼습니다.\n장바구니로 이동하시겠습니까?')){
					location.href = '<?php echo G5_BBS_URL ?>/content.php?co_id=ptmall_cart';
				}else{
					return false;
				}
			},
			error: function(xhr, status, error){
				alert(error);
			}
		});
	});

	$("#order_btn").on('click', function(){
		<?php if($view['opt_use1'] != 'y' && $view['opt_use2'] != 'y' && $view['opt_use3'] != 'y'){ ?>
		<?php }else{ ?>
			if($(".options_container").length <= 0){
				alert('주문옵션을 선택하시기 바랍니다');
				return false;
			}
		<?php } ?>

		var userPoint = parseInt($("#userPoint").val());
		var totalPrice2 = parseInt($("#hap_tot2").val());

		if(userPoint < totalPrice2){
			alert("보유 마일리지가 부족합니다.");
			return false;
		}

		$("#ct_direct").val('y');
		document.buy_frm.submit();

	});
});


function opt_sum(idx){
	var price = Number($("#price").val());
	var opt1_p = 0, opt2_p = 0, opt3_p = 0;
	var quantity_p = Number($(".quantity").eq(idx).val());

	if($(".opt1_price").eq(idx).length > 0) opt1_p = Number($(".opt1_price").eq(idx).val());
	if($(".opt2_price").eq(idx).length > 0) opt2_p = Number($(".opt2_price").eq(idx).val());
	if($(".opt3_price").eq(idx).length > 0) opt3_p = Number($(".opt3_price").eq(idx).val());

	var hap = (price + opt1_p + opt2_p + opt3_p) * quantity_p;
	$(".opt_tot_price").eq(idx).val(hap);

	if(hap>0){
        $(".opt_tot_price_text").eq(idx).html(comma(hap)+'원');
    }

    //마일리지부분
    var price2 = Number($("#price2").val());
    var opt1_p2 = 0, opt2_p2 = 0, opt3_p2 = 0;
    var quantity = Number($(".quantity").eq(idx).val());

    if($(".opt1_price2").eq(idx).length > 0) opt1_p2 = Number($(".opt1_price2").eq(idx).val());
    if($(".opt2_price2").eq(idx).length > 0) opt2_p2 = Number($(".opt2_price2").eq(idx).val());
    if($(".opt3_price2").eq(idx).length > 0) opt3_p2 = Number($(".opt3_price2").eq(idx).val());

    var hap2 = (opt1_p2 + opt2_p2 + opt3_p2) * quantity;
    $(".opt_tot_price2").eq(idx).val(hap2);

    if(hap2>0){
        $(".opt_tot_price_text2").eq(idx).html(comma(hap2)+'P');
    }
    
    

	hap_sum();
}




function hap_sum(){
	var hap_tot = 0;
	if($(".opt_tot_price").length > 0){
		for(var i=0; i<$(".opt_tot_price").length; i++){
			hap_tot += Number($(".opt_tot_price").eq(i).val());
		}
	}

	$("#hap_tot").val(hap_tot);
	if(hap_tot > 0){
        $("#tot_price_text").html(comma(hap_tot)+' 원');
    }else{
        $("#tot_price_text").html('');
    }


	//마일리지부분
    var hap_tot2 = 0;
    if($(".opt_tot_price2").length > 0){
        for(var i=0; i<$(".opt_tot_price2").length; i++){
            hap_tot2 += Number($(".opt_tot_price2").eq(i).val());
        }
    }

    $("#hap_tot2").val(hap_tot2);
    if(hap_tot2 > 0) {
        $("#tot_price_text2").html(comma(hap_tot2) + ' P');
    }else{
        $("#tot_price_text2").html('');
    }
}




function none_opt_hap_sum(){
	var hap_tot = Number($("#price").val());

	$("#hap_tot").val(hap_tot);
	$("#tot_price_text").html(comma(hap_tot)+' 원');

    var hap_tot2 = Number($("#price2").val());

    $("#hap_tot2").val(hap_tot2);
    $("#tot_price_text2").html(comma(hap_tot2)+' P');
}



function opt_items(){
	var cnt = 0, opt_tot_price = 0, opt_tot_price2 = 0;

	var $opt1_obj = $("#opt1");
	var $opt2_obj = $("#opt2");
	var $opt3_obj = $("#opt3");

	if($opt1_obj.length > 0){
		if($opt1_obj.val() == ''){
			return false;
		}
	}

	if($opt2_obj.length > 0){
		if($opt2_obj.val() == ''){
			return false;
		}
	}

	if($opt3_obj.length > 0){
		if($opt3_obj.val() == ''){
			return false;
		}
	}

	var datas = '';
	datas += '<div class="options_container">';
	datas += '<input type="hidden" name="opt_cnt[]" class="opt_cnt" value="ok">';
	datas += '<table class="select_option_tbl">';
	datas += '<tbody>';
	datas += '<tr>';
	datas += '<td>';
	if($opt1_obj.length > 0){
		cnt++;
		datas += '<div>'+$("#wr_opt1").val()+' : ';
		var $opt1_obj_arr = $opt1_obj.val().split('|');
		datas += $opt1_obj_arr[1];

		if($opt1_obj_arr[2] > 0){
            datas += ' (+'+comma($opt1_obj_arr[2])+'원)';
        }

        if($opt1_obj_arr[4] > 0){
            datas += ' (+'+comma($opt1_obj_arr[4])+'P)';
        }

		datas += '<input type="hidden" name="opt1[]" class="opt1" value="'+$opt1_obj.val()+'">';
		datas += '<input type="hidden" name="opt1_price[]" class="opt1_price" value="'+$opt1_obj_arr[2]+'">';
        datas += '<input type="hidden" name="opt1_price2[]" class="opt1_price2" value="'+$opt1_obj_arr[4]+'">';
		datas += '</div>';
		opt_tot_price += Number($opt1_obj_arr[2]);
        opt_tot_price2 += Number($opt1_obj_arr[4]);
	}
	if($opt2_obj.length > 0){
		cnt++;
		datas += '<div>'+$("#wr_opt2").val()+' : ';
		var $opt2_obj_arr = $opt2_obj.val().split('|');
		datas += $opt2_obj_arr[1];

        if($opt2_obj_arr[2] > 0){
            datas += ' (+'+comma($opt2_obj_arr[2])+'원)';
        }

        if($opt2_obj_arr[4] > 0){
            datas += ' (+'+comma($opt2_obj_arr[4])+'P)';
        }



		datas += '<input type="hidden" name="opt2[]" class="opt2" value="'+$opt2_obj.val()+'">';
		datas += '<input type="hidden" name="opt2_price[]" class="opt2_price" value="'+$opt2_obj_arr[2]+'">';
        datas += '<input type="hidden" name="opt2_price2[]" class="opt2_price2" value="'+$opt2_obj_arr[4]+'">';
		datas += '</div>';
		opt_tot_price += Number($opt2_obj_arr[2]);
        opt_tot_price2 += Number($opt2_obj_arr[4]);
	}
	if($opt3_obj.length > 0){
		cnt++;
		datas += '<div>'+$("#wr_opt3").val()+' : ';
		var $opt3_obj_arr = $opt3_obj.val().split('|');
		datas += $opt3_obj_arr[1];

        if($opt3_obj_arr[2] > 0){
            datas += ' (+'+comma($opt3_obj_arr[2])+'원)';
        }

        if($opt3_obj_arr[4] > 0){
            datas += ' (+'+comma($opt3_obj_arr[4])+'P)';
        }



		datas += '<input type="hidden" name="opt3[]" class="opt3" value="'+$opt3_obj.val()+'">';
		datas += '<input type="hidden" name="opt3_price[]" class="opt3_price" value="'+$opt3_obj_arr[2]+'">';
        datas += '<input type="hidden" name="opt3_price2[]" class="opt3_price2" value="'+$opt3_obj_arr[4]+'">';
		datas += '</div>';
		opt_tot_price += Number($opt3_obj_arr[2]);
        opt_tot_price2 += Number($opt3_obj_arr[4]);
	}

	if($(".options_container").length > 0){
		var cntt = 0;
		for(var i=0; i<$(".options_container").length; i++){
			cntt = 0;

			if($opt1_obj.length > 0){
				if($(".opt1").eq(i).val() == $opt1_obj.val()){
					cntt++;
				}
			}

			if($opt2_obj.length > 0){
				if($(".opt2").eq(i).val() == $opt2_obj.val()){
					cntt++;
				}
			}

			if($opt3_obj.length > 0){
				if($(".opt3").eq(i).val() == $opt3_obj.val()){
					cntt++;
				}
			}

			if(cntt == cnt){
				alert('이미 추가된 옵션입니다!');
				return false;
			}
		}
	}

	opt_tot_price += Number($("#price").val());
	opt_tot_price = (opt_tot_price * 1);

    opt_tot_price2 += Number($("#price2").val());
    opt_tot_price2 = (opt_tot_price2 * 1);

	datas += '</td>';
	datas += '<td style="width:100px; text-align:center;">';
	datas += '<input type="text" name="quantity[]" class="quantity" value="1" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">';
	datas += '<span class="vary_box">';
	datas += '<button type="button" class="vary_up"><i class="fa fa-caret-up" aria-hidden="true"></i></button><button type="button" class="vary_down"><i class="fa fa-caret-down" aria-hidden="true"></i></button>';
	datas += '</span>';
	datas += '</td>';
	datas += '<td style="width:105px; text-align:right;">';
	datas += '<input type="hidden" name="opt_tot_price[]" class="opt_tot_price" value="'+opt_tot_price+'">';
    datas += '<input type="hidden" name="opt_tot_price2[]" class="opt_tot_price2" value="'+opt_tot_price2+'">';
    if(opt_tot_price > 0){
        datas += '<span class="opt_tot_price_text">'+comma(opt_tot_price)+'원</span>';
    }

    if(opt_tot_price2 > 0){
        datas += '<span class="opt_tot_price_text2">'+comma(opt_tot_price2)+'P</span>';
    }

	datas += '</td>';
	datas += '<td style="width:30px; text-align:center;"><i class="fa fa-window-close opt_delete" aria-hidden="true" style="cursor:pointer;"></i></td>';
	datas += '</tr>';
	datas += '</tbody>';
	datas += '</table>';
	datas += '</div>';

	$("#select_option").append(datas);

	if($opt1_obj.length > 0) $("#opt1 option:eq(0)").prop('selected', true);
	if($opt2_obj.length > 0) $("#opt2 option:eq(0)").prop('selected', true);
	if($opt3_obj.length > 0) $("#opt3 option:eq(0)").prop('selected', true);

	hap_sum();
}
</script>

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->
