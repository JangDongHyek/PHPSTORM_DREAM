<?php
$tv_idx = get_session("ss_tv_idx");

$tv_div['top'] = 0;
$tv_div['img_width'] = 80;
$tv_div['img_height'] = 50;
$tv_div['img_length'] = 3; // 한번에 보여줄 이미지 수


?>
	 <?php
        $tv_tot_count = 0;
        $k = 0;
        for ($i=1;$i<=5;$i++)
        {
            $tv_it_idx = $tv_idx - ($i - 1);
            $tv_it_id = get_session("ss_tv[$tv_it_idx]");
            $rowx = sql_fetch(" select it_id, it_name,it_price from {$g5['g5_shop_item_table']} where it_id = '$tv_it_id' ");
            if(!$rowx['it_id'])
                continue;

            if ($tv_tot_count % $tv_div['img_length'] == 0) $k++;

            $it_name = get_text($rowx['it_name']);
			$it_price = get_text($rowx['it_price']);
            $img = get_it_image($tv_it_id, $tv_div['img_width'], $tv_div['img_height'], $tv_it_id, '', $it_name);
			echo "<li>";
			echo '	<a href="'.G5_SHOP_URL.'/item.php?it_id='.$tv_it_id.'">';
			echo '		<div class="img">';
			echo strip_tags($img,"<img>");
			echo '		</div>';
			echo '		<div class="txt">';
			echo '			<p class="tit">'.cut_str($it_name, 10, '').'</p>';
			echo '			<p class="pr">'.number_format($it_price).'원</p>';
			echo '			</div>';
			echo '		</a>';
			echo '	</li>';
/*
            
            echo '<li class="stv_item c'.$k.'">'.PHP_EOL;
            echo $img;
            echo '<br>';
            echo '<p>';
            echo cut_str($it_name, 10, '').PHP_EOL;
            echo '</p></li>'.PHP_EOL;*/

            $tv_tot_count++;
        }
		if($tv_tot_count<=0){
        ?>
		<li class="no_view">최근 본 상품이 없습니다.</li>
		<?php }?>



