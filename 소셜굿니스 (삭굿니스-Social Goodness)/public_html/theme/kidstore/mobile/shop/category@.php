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

<nav class="navbar navbar-custom navbar-inverse navbar-static-top container" id="nav"> 
    <div class="navbar-header">
        <!-- 모바일 GNB 버튼 -->
        <button type="button" class="navbar-toggle " data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- 모바일 회원 버튼 -->
        <button class="shop_member_btn dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-2x fa-th" aria-hidden="true"></i>
        	<!-- <i class="fa fa-2x fa-bars" aria-hidden="true"></i> --><span class="sound_only">분류보기</span></button>
        <ul class="dropdown-menu shop_member" role="menu">                   
            <?php if ($is_member) { ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/"><i class="fa fa-cog"></i><b>관리자</b></a></li>
            <?php } else { ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><i class="fa fa-check-square"></i>정보수정</a></li>
            <?php } ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"><i class="fa fa-sign-out"></i>로그아웃</a></li>
            <?php } else { ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><i class="fa fa-sign-in"></i>로그인</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join"><i class="fa fa-smile-o"></i>회원가입</a></li>
            
            <?php } ?>
            <li><a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank"><i class="fa fa-ticket"></i>쿠폰</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank"><i class="fa fa-money"></i>포인트</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php"><i class="fa fa-heart"></i>위시리스트</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><i class="fa fa-user"></i>마이페이지</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php"><i class="fa fa-credit-card"></i>개인결제</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php"><i class="fa fa-truck"></i>주문조회</a></li>
        </ul>
        <!-- 모바일 장바구니 버튼 -->
        <button type="button" class="shop_cart navbar-toggle">
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-2x fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span></a>
        </button>
    </div>
    <!-- gnb 버튼 -->
    <div class="collapse navbar-collapse cate_list">
    <?php
    $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
    $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
    for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
        if($i == 0)
            echo '<ul class="nav navbar-nav nav-cate">'.PHP_EOL;
    ?>
        <li class="active dropdown">
            <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>" class="aa"><?php echo get_text($mshop_ca_row1['ca_name']); ?><span class="sl_bg"></span></a>
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
        echo '<div id="sch_div"> 
             <form name="frmsearch1" action="'.G5_SHOP_URL.'/search.php" onsubmit="return search_submit(this);" >
                 <aside id="hd_sch">
                    <div class="sch_inner">
                        <h2>상품 검색</h2>
                        <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                        <input type="text" name="q"  id="sch_str" required class="frm_input " placeholder="검색어">
                        <button type="submit" class="btn_submit"><i class="fa fa-lg fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>                 </div>
                </aside>
            </form>
        </div>
        </ul>'.PHP_EOL;
    else
        echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
    ?>
    </div><!--/.nav-collapse -->
</nav><!--/.navbar -->
        
<script>

function search_submit(f) {
    if (f.q.value.length < 2) {
        alert("검색어는 두글자 이상 입력하십시오.");
        f.q.select();
        f.q.focus();
        return false;
    }

    return true;
}
   


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