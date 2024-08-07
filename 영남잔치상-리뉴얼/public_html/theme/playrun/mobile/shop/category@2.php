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

<nav class="navbar navbar-custom navbar-inverse navbar-static-top" id="nav"> 
	<div class="container">
        <div class="navbar-collapse cate_list">
        <?php
        $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
        $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
        for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
            if($i == 0)
                echo '<ul class="nav navbar-nav nav-cate">'.PHP_EOL;
        ?>
            <li class="active dropdown">
                <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>" class="aa"><span class="ico"></span><span class="text"><?php echo get_text($mshop_ca_row1['ca_name']); ?></span><span class="sl_bg"></span></a>
                <?php
                $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
                if(sql_num_rows($mshop_ca_res2))
                    echo '<button class="sub_ct_toggle ct_op dropdown-toggle" data-toggle="dropdown">'.get_text($mshop_ca_row1['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
    
                for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                    if($j == 0)
                        echo '<ul class="sub_cate sub_cate1 dropdown-menu" role="menu">'.PHP_EOL;
                ?>
                    <li>
                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                        <?php
                        $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                        
                        for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
                            if($k == 0)
                                echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
                        ?>
                            <li>
                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><i class="fa fa-chevron-right"></i><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                
                            </li>
                        <?php
                        }
    
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
    
        if($i > 0)
            echo ''.PHP_EOL;
        else
            echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
        ?>
        </div><!--/.nav-collapse -->
	</div>
</nav><!--/.navbar -->
        
<script>

$(function (){
    var $hd_sch = $('#hd_sch');

    $(".btn_close").on("click", function() {
        $hd_sch.css("display","none");
    });

    $("#hd_sch_open").on("click", function(){
        $hd_sch.css("display","block");
    });

});
</script>