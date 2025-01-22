<?php
include_once('./_common.php');
$g5['title'] = "도시락주문";
if(!$month){
	$month=date("Y-m");
}

$weekNames = array("1"=>"월","2"=>"화","3"=>"수","4"=>"목","5"=>"금");
include_once(G5_MSHOP_PATH.'/_head.php');

$sql="select * from apartment where is_view='Y' order by idx desc";
$result=sql_query($sql);
?>

<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";

</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>
<div id="mml">
<div id="sct">

	<div id="sct_wrap_bd">
		<ul id="sct_wrap" class="sct sct_10">
			<?php
				for($i=0;$row=sql_fetch_array($result);$i++){
						
					?>
			<li class="col-xs-6 col-sm-3 sct_li sct_clear">
				<div class="inner-bd">
					<div class="sct_img text-center">
						<a href="<?php echo G5_SHOP_URL?>/month_menu.php?a_idx=<?php echo $row[idx]?>" class="sct_a">
							<?php
								if($row[apartment_photo]){?>
							<img src="<?php echo G5_DATA_URL?>/apartment/<?php echo $row[apartment_photo]?>" width="100">
							<?php }else{?>
							<img src="<?php echo G5_THEME_IMG_URL?>/noimg.jpg" class="noimg">
							<?php }?>
						</a>
					</div>
					<div class="sct_txt">
						<a href="<?php echo G5_SHOP_URL?>/month_menu.php?a_idx=<?php echo $row[idx]?>" class="sct_a"><?php echo $row[apartment_name]?></a>
					</div>
				</div>
			</li>
			<?php }?>
		</ul>
	</div>

</div>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
?>
