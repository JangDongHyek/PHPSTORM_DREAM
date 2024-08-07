<?php
include_once('./_common.php');

define("_INDEX_", TRUE);
include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>
    
    <div id="main_box">
        <!-- 메인 배너 -->
        <div id="mainbanner">
            <div class=""><?php echo display_banner('메인', 'mainbanner.10.skin_m.php'); ?></div>
        </div>
    </div><!--#main_box-->
    
    
    <?php /*?><!-- 인기상품  -->
    <div id="idx_best">
    	<div class="container">
            <div class="idx_best_box">
                <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4"><strong>인기</strong>반찬</a></h2>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_list_mod(4); 
                $list->set_list_row(1); 
				$list->set_img_size(290, 230); 
                $list->set_type(4);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', false);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
            </div> 
            <div class="more"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">더 많은 반찬보기 +</a></div>
        </div>
    </div>

    
    <!-- 신상품  -->
    <div id="idx_new">
    	<div class="container">
            <div class="idx_new_box">
                <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3"><strong>NEW</strong> ITEM</a></h2>
				<?php
                $list = new item_list();
				 $list->set_mobile(true);
                $list->set_type(3);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_basic', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
            </div> 
        </div>
    </div><?php */?>


    <div id="idx_sale">
    	<div class="container">
            <div class="idx_sale_box">
                <h2><h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3"><strong>NEW</strong> ITEM</a></h2></h2>

                <?php
                $list = new item_list(); 
                $list->set_category('10', 1); 
                $list->set_list_mod(10); 
                $list->set_list_row(1); 
                $list->set_img_size(290, 230); 
                $list->set_list_skin(G5_SHOP_SKIN_PATH.'/list.10.skin.php'); 
                $list->set_view('it_img', true); 
                //$list->set_view('it_id', true); 
                $list->set_view('it_name', true); 
                $list->set_view('it_basic', true); 
                $list->set_view('it_cust_price', true); 
                $list->set_view('it_price', true); 
                $list->set_view('it_icon', true); 
                //$list->set_view('sns', true); 
                echo $list->run(); 
                ?> 
            </div> 
            <div class="more"><a href="../shop/list.php?ca_id=10">더 많은 상품 보기 +</a></div>
        </div>
    </div>

   
      
    
    <div id="join_wrap">
        <h2><?php /*?><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/join_img.png" /><?php */?><span>지금 <strong><?php echo $default['de_admin_company_name']; ?>에 회원가입</strong>을 하시면<br class="visible-xs" /> 각종 다양한 혜택을 받으실 수 있습니다.</span></h2>
        <div class="box">
        	<?php if ($is_member) { ?>
            <?php if ($is_admin) {  ?>
            <a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" class="login">관리자</a>
            <?php } else { ?>
            <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="login">정보수정</a>
            <?php } ?>
            <a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop" class="join">로그아웃</a>
            <?php } else { ?>
            <a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>" class="login">로그인</a>
            <a href="<?php echo G5_BBS_URL ?>/register_form.php" class="join">회원가입</a>
            <?php } ?>
        </div>
    </div>

             

<div class="container">

     
<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>