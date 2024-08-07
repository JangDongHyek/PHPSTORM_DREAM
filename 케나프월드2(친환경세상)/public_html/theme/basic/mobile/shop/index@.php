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
    
    
    
    <div class="com_ban cf">
        <dl class="a col-xs-12 col-md-4">
            <dt><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ban1.jpg" onmouseover="this.src='<?php echo G5_THEME_IMG_URL ?>/mobile/ban1_on.jpg'"onmouseout="this.src='<?php echo G5_THEME_IMG_URL ?>/mobile/ban1.jpg'"></dt>
            <dd class="title">투명한 재료</dd>
            <dd class="con">100% 국산화를 목표로 최고급 친환경 재료와 <br class="hidden-xs" />
				최적의 비율, 철저한 위생관리로 <br class="hidden-xs" />
				보다 깊은 음식의 맛을 고객님께 드리겠습니다.</dd>
        </dl>
        <dl class="b col-xs-12 col-md-4">
            <dt><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ban2.jpg" onmouseover="this.src='<?php echo G5_THEME_IMG_URL ?>/mobile/ban2_on.jpg'"onmouseout="this.src='<?php echo G5_THEME_IMG_URL ?>/mobile/ban2.jpg'"></dt>
            <dd class="title">깔끔하고 건강한 맛</dd>
            <dd class="con">다사라 반찬&amp;도시락은<br class="hidden-xs" />
				전문가가 직접 참여 개발, 조리, 검수하여<br class="hidden-xs" />
				차별화된 맛과 품질을 보장합니다.</dd>
        </dl>
        <dl class="c col-xs-12 col-md-4">
            <dt><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ban3.jpg" onmouseover="this.src='<?php echo G5_THEME_IMG_URL ?>/mobile/ban3_on.jpg'"onmouseout="this.src='<?php echo G5_THEME_IMG_URL ?>/mobile/ban3.jpg'"></dt>
            <dd class="title">가족을 생각하는 정성으로</dd>
            <dd class="con">우리 가족이 먹는다는 마음가짐으로 깨끗하고<br class="hidden-xs" />
				건강한 재료로 정성을 다하여 만듭니다.<br class="hidden-xs" />
				식품약품안전처가 인증한 HACCP을 취득했습니다.</dd>
        </dl>
    </div><!--com_ban-->   
   
   
    
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
    </div> <?php */?> 
    

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
    </div>

   
   
   
       <div id="brand">
        <h2 class="luzen"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/logo2.png" alt="다사라반찬"></h2>
        <h3>'바르게 하면 오래 간다'</h3>
        <div class="con">최고 품질의 재료와 정성으로 만든 다사라 반찬&amp;도시락은<br class="visible-xs" />정직하고 바른 음식을 제공해 드립니다.</div> 
        <!--<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company" class="go">회사소개 바로가기&nbsp;&nbsp; <i class="fas fa-angle-double-right"></i></a>-->   
    </div><!--brand-->

 
    <?php /*?><div id="idx_sale">
    	<div class="container">
            <div class="idx_sale_box">
                <h2><a href="../shop/list.php?ca_id=10">
                    다사라 반찬&amp;도시락은 <strong>SALE중</strong></a> 
                </h2>
                
                <?php 
                $list = new item_list(); 
                $list->set_category('10', 1); 
                $list->set_list_mod(4); 
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
            <div class="more"><a href="../shop/list.php?ca_id=10">더 많은 세일 상품 보기 +</a></div>
        </div>
    </div><?php */?>
      
    
    
    
    <div id="cate_in">
        <div class="con_cate">
            <h2>다사라 반찬&amp;도시락 <strong>주요품목</strong><span>다사라 반찬&amp;도시락은 신선하고 좋은 품질의<br class="hidden-md hidden-lg" /> 상품들을 합리적인 가격에 제공해 드립니다.</span></h2>
            <ul class="cf">
                <a href="../shop/list.php?ca_id=20">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong01.jpg" /></div><p>반찬</p></li>
                </a>
                <a href="../shop/list.php?ca_id=30">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong02.jpg" /></div><p>국</p></li>
                </a>
                <a href="../shop/list.php?ca_id=40">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong03.jpg" /></div><p>메인요리</p></li>
                </a>
                <a href="../shop/list.php?ca_id=50">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong04.jpg" /></div><p>도시락</p></li>
                </a>
                <a href="../shop/list.php?ca_id=60">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong05.jpg" /></div><p>샤브</p></li>
                </a>  
                <a href="../shop/list.php?ca_id=70">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong06.jpg" /></div><p>야채</p></li>
                </a>
                <a href="../shop/list.php?ca_id=80">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong07.jpg" /></div><p>축산</p></li>
                </a>
                <a href="../shop/list.php?ca_id=10">
                <li><div><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/dong08.jpg" /></div><p>세일중</p></li>
                </a>
            </ul>
        </div><!--con_cate-->
    </div>
    
   
    



    <div id="brand" class="b">
        <h2 class="luzen"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/back_text2.png" alt="맛있고 건강한"></h2>
        <!--<h3>'바르게 하면 오래 간다'</h3>-->
        <div class="con top">맛과 영양을 모두 담은 제대로 만든 도시락<br />
        매일 다양하게 즐길 수 있는 꼼꼼하게 구성한 반찬과<br />
        영양가득한 곡물밥까지~~</div> 
        <a href="../shop/list.php?ca_id=50" class="go">도시락 코너 바로가기&nbsp;&nbsp; <i class="fas fa-angle-double-right"></i></a>   
    </div>
        
        
    
    
    
    
    <div id="join_wrap">
        <h2><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/join_img.png" /><span>지금 다사라 반찬&amp;도시락에 회원가입을 하시면<br class="visible-xs" /> 각종 다양한 혜택을 받으실 수 있습니다.</span></h2>
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