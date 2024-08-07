<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>
<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
	
	?>
<input type="hidden" name="io_id[<?php echo $row[it_id]; ?>][]" value="" id="io_id<?=$this->type?><?=$row[it_id]?>">
<input type="hidden" name="io_value[<?php echo $row[it_id]; ?>][]" value="<?php echo $row['it_name']; ?>" id="io_value<?=$this->type?><?=$row[it_id]?>">
<input type="hidden" class="io_price" value="0" id="io_price<?=$row[it_id]?>">
<input type="hidden" class="io_stock" value="<?php echo $row['it_stock_qty']; ?>" id="io_stock<?=$this->type?><?=$row[it_id]?>">

<?
    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $sct_last = ' sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = ' sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = ' sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct sct_10 ver2\">\n";
        }
    }
    echo "<li class=\"sct_li{$sct_last}\" >\n";
    if ($this->href) {
        //echo "<div class=\"sct_img\"><a href=\"#\" class=\"ad_cart\" onclick=\"eaSubmit('".$row[it_id]."','".$this->type."','".$row[it_price]."')\">장바구니</a><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
        echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], 300, 198, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }


    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"table_wrap\"><div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_basic && $row['it_basic']) {
//        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }
	
    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"sct_cost\">\n";
        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<strike>".display_price($row['it_cust_price'])."</strike>\n";
        }

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        echo "</div></div>\n";
		echo "<div class=\"btn_wrap\"><a href=\"{$this->href}{$row['it_id']}\" class=\"list_btn\">주문신청</a><a href=\"{$this->href}{$row['it_id']}\" class=\"list_btn\">상세설명보기</a></div>\n";

    }
    if ($this->view_it_icon) {
        echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_fb_s.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_twt_s.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_goo_s.png');
        echo "</div>\n";
    }

    echo "</li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->

<script type="text/javascript">
	function eaSubmit(it_id,type,it_price){
		if(it_price=="0"){
			alert("전화문의 및 판매중단 된 상품은 장바구니에 담을 수 없습니다.");
			return;
		}
		var ct_qty=$("#ct_qty"+type+it_id).val();
		var io_type = $("#io_type"+type+it_id).val();
		var io_id = $("#io_id"+type+it_id).val();
		var io_value = $("#io_value"+type+it_id).val();
		var io_price = $("#io_price"+type+it_id).val();
		var io_stock = $("#io_stock"+type+it_id).val();
		/*<?php
			if($member[mb_id]==""){
		?>
			alert("로그인 후에 장바구니를 담을 수 있습니다.");
			location.href=`${g5_bbs_url}/login.php`;
			return;
		<?php }?>*/
		//location.href="<?=G5_SHOP_URL?>/ajax.cartupdate.php?it_id="+it_id+"&ct_qty="+ct_qty;
		$.ajax({
			url:"<?=G5_SHOP_URL?>/ajax.cartupdate.php",
			data:{"it_id":it_id,"ct_qty":1,"act":"","io_type":io_type,"io_id":io_id,"io_value":io_value,"io_price":io_price,"io_stock":io_stock},
			dataType:"HTML",
			type:"POST",
			success:function(data){
				if(data.length!=0){
					alert(data);
				}else{
					alert("장바구니에 담았습니다.");
				}
				//location.reload();
			}
		});

	}
</script>
