<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}
?>



<div id="all_c">
    <div id="menu_open"><i class="fal fa-bars"></i> </div>
    
    <div id="category">
        <button type="button" class="close_btn"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
        <div class="ct_wr">
            <?php
            $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
            $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
            for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
                if($i == 0)
                    echo '<ul class="cate">'.PHP_EOL;
            ?>
                <li class="cate_li_1">
                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>" class="cate_li_1_a"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                    <?php
                    $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
    
                    for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                        if($j == 0)
                            echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                    ?>
                        <li class="cate_li_2">
                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
							<?php
								$mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
								for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
									if($k == 0)
										echo '<ul class="sub_cate2">'.PHP_EOL;
							?>
							<li class="cate_li_3">
	                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
							</li>

							<?php }
								if($k > 0)
			                      echo '</ul>'.PHP_EOL;
							?>
                        </li>
                    <?php
                    }
    
                    if($j > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
            <?php
            }
    

            ?>
        </div>
    </div>
</div>

<script>
$(function (){
    var $category = $("#category");

    $("#menu_open").on("click", function() {
        $category.css("display","block");
    });

    $("#category .close_btn").on("click", function(){
        $category.css("display","none");
    });
});
$(document).mouseup(function (e){
	var container = $("#category");
	if( container.has(e.target).length === 0)
	container.hide();
});
</script>
