<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>
<style>
	.item-list ul{ float:left}
	.item-list ul li{
		list-style:none;
		float:left;
		width:19%;
		padding:0;
		text-align:center;
		margin:0 .5% 17px;
		transition: all 0.3s ease;
	}
    .item-list ul li img{ margin:0 0 10px; padding: 2px; border: 2px solid #e1c254;} 
	.item-list ul li p.tit{ font-size:1.15em; font-weight:bold;}
	.item-list ul li p.price{ font-size:1.12em; font-weight:500;}
	.item-list ul li .info{ min-height:64px}
@media (max-width: 1200px){
	.item-list ul li{
		list-style:none;
		float:left;
		width:24%;
		padding:0;
		text-align:center;
		margin:0 .5% 17px;
		transition: all 0.3s ease;
	}
}
@media (max-width: 767px){
	.item-list ul li{
		list-style:none;
		float:left;
		width:32.3333%;
		padding:0;
		text-align:center;
		margin:0 .5% 17px;
		transition: all 0.3s ease;
	}
}
@media (max-width: 500px){
	.item-list ul li{
		list-style:none;
		float:left;
		width:49%;
		padding:0;
		text-align:center;
		margin:0 .5% 17px;
		transition: all 0.3s ease;
	}
}
</style>
<div class="item-list">
	<ul>
<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {?>
<input type="hidden" name="io_id[<?php echo $row[it_id]; ?>][]" value="" id="io_id<?=$this->type?><?=$row[it_id]?>">
<input type="hidden" name="io_value[<?php echo $row[it_id]; ?>][]" value="<?php echo $row['it_name']; ?>" id="io_value<?=$this->type?><?=$row[it_id]?>">
<input type="hidden" class="io_price" value="0" id="io_price<?=$row[it_id]?>">
<input type="hidden" class="io_stock" value="<?php echo $row['it_stock_qty']; ?>" id="io_stock<?=$this->type?><?=$row[it_id]?>">

	<li onclick="location.href='<?php echo $this->href?><?php echo $row[it_id]?>';" style="cursor:pointer">
		<!-- 사진 -->
		<div>
			<?php
			if ($this->view_it_img) {
				echo get_it_image($row['it_id'], 135, 90, '', '', stripslashes($row['it_name']))."\n";
			}?>
		</div>
		<!-- 제품정보 -->
        <div class="info">
            <!--제품명-->
            <p class="tit"><?php echo stripslashes($row['it_name'])."\n";?></p>
            <!-- 가격 -->
            <div>
                <p class="price">
				<?php echo display_price(get_price($row), $row['it_tel_inq'])."\n";?></p>
            </div>
        </div>
	</li>


<?php }

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
	</ul>
</div>
<!-- } 상품진열 10 끝 -->

<script type="text/javascript">
	function eaSubmit(it_id,type){
		var ct_qty=$("#ct_qty"+type+it_id).val();
		var io_type = $("#io_type"+type+it_id).val();
		var io_id = $("#io_id"+type+it_id).val();
		var io_value = $("#io_value"+type+it_id).val();
		var io_price = $("#io_price"+type+it_id).val();
		var io_stock = $("#io_stock"+type+it_id).val();
				<?php
			if($member[mb_id]==""){
		?>
			alert("로그인 후에 장바구니를 담을 수 있습니다.");
			location.href=`${g5_bbs_url}/login.php`;
			return;
		<?php }?>
		//location.href="<?=G5_SHOP_URL?>/ajax.cartupdate.php?it_id="+it_id+"&ct_qty="+ct_qty;
		$.ajax({
			url:"<?=G5_SHOP_URL?>/ajax.cartupdate.php",
			data:{"it_id":it_id,"ct_qty":1,"act":"","io_type":io_type,"io_id":io_id,"io_value":io_value,"io_price":io_price,"io_stock":io_stock},
			dataType:"HTML",
			type:"POST",
			success:function(data){
				console.log(data);
				alert("장바구니에 담았습니다.");
				//location.reload();
			}
		});

	}
</script>
