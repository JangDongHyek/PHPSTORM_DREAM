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
            <div class="hidden-xs container"><?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?></div>
            <div class="visible-xs"><?php echo display_banner('메인', 'mainbanner.10.skin_m.php'); ?></div>
        </div>
    </div><!--#main_box-->


    <div id="service_banner">
                <div class="banner_in">
                    <h2><strong>해피라이프 상조상품안내</strong><span>장례식장 장지, 상조뿐만 아니라 장례 전후 토탈 서비스를 제공합니다.</span></h2>
                    <div class="box">
                        <ul class="box_list cf">
                            <li> 
                                <div>
                                    <h3>상조상품안내</h3>
                                    <p>부르는게 값인 장례용품<br />이제 검증된 상품을 이용하세요.</p>
                                </div>
                                <div><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=goods01" class="more">자세히보기</a></div>
                            </li>
                            <li>
                                <div class="over">
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/main/service01.jpg" alt="">
                                    <div class="con">
                                        <h3>해피라이프 소개</h3>
                                        <p>고객 여러분의 더 풍요로운 삶을 위한<br />라이프 토탈 케어 서비스</p>
                                        <div><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce01" class="more">자세히보기</a></div>
                                    </div><!--con-->  
                                </div>
                            </li>
                            </li>
                            <li>
                                <div class="over">
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/main/service02.jpg" alt="">
                                    <div class="con">
                                        <h3>제휴업체</h3>
                                        <p>국내 최고의 기업들과의 제휴협약을 통해<br />품격있는 상조서비스를 제공합니다.</p>
                                        <div><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=group01" class="more">자세히보기</a></div>
                                    </div><!--con-->  
                                </div>
                            </li>
                            </li>
                        </ul><!--box_list-->
                    </div><!--box-->
                </div><!--banner_in-->
    </div><!--pro_banner-->
    
    
    <div id="service">
        <div class="con_cate">
            <h2><strong>평생 회원 서비스!</strong><span>해피라이프 회원가입을 하시면, 다양한 정보와 혜택을 받으실 수 있습니다.</span></h2>
            <ul class="cf">
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=service01">
                <li>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/dong01.jpg" /></div>
                    <p class="t">회원 서비스</p>
                    <p class="c">최고의 전문성을 통해 <br />장례용품의 엄격한<br />품질보장과 품격있는 장례진행으로<br />모범적 견인차 역할을 다하겠습니다.</p>
                </li>
                </a>
                <a href="<?php echo G5_BBS_URL; ?>/register.php">
                <li>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/dong02.jpg" /></div>
                    <p class="t">가입 신청</p>
                    <p class="c">최고의 전문성을 통해 <br />장례용품의 엄격한<br />품질보장과 품격있는 장례진행으로<br />모범적 견인차 역할을 다하겠습니다.</p>
                </li>
                </a>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=service01">
                <li>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/dong03.jpg" /></div>
                    <p class="t">서비스 신청</p>
                    <p class="c">최고의 전문성을 통해 <br />장례용품의 엄격한<br />품질보장과 품격있는 장례진행으로<br />모범적 견인차 역할을 다하겠습니다.</p>
                </li>
                </a>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=group01">
                <li>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/dong04.jpg" /></div>
                    <p class="t">제휴업체 현황</p>
                    <p class="c">최고의 전문성을 통해 <br />장례용품의 엄격한<br />품질보장과 품격있는 장례진행으로<br />모범적 견인차 역할을 다하겠습니다.</p>
                </li>
                </a> 
            </ul>
        </div><!--con_cate-->
    </div><!--brand-->


    
    <div id="idx_best" style="display:none;">
        <div class="container">
            <div class="idx_best_box">
                <h2>
                    해피라이프에서 <strong>추천</strong>합니다.
                    <p>고객님들이 많이 찾아주시는 제품들을 한 눈에 확인하세요.</p> 
                </h2>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
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
        </div>
    </div>
    
    
    


    <!-- 베스트 상품  -->
    <?php /*?><div id="idx_best">
    	<div class="container">
            <div class="idx_best_box">
                <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4"><strong>BEST</strong> ITEM</a></h2>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
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





    <div id="service" class="b">
        <h2 class="luzen">해피라이프는</h2>
        <!--<h3>'바르게 하면 오래 간다'</h3>-->
        <div class="con top">신뢰와 정직을 바탕으로<br />
투명하고 표준화된 장례서비스를 제공하겠습니다.<br />
장례업의 본질은 신뢰입니다.<br /> 해피라이프는 고객의 만족을 최우선으로 하고 있습니다.<br />
고객이 진정으로 만족 할 때 장례회사의 신뢰가 만들어진다는 것을 잘 알기 때문입니다.<br />
해피라이프는 고객, 협력업체, 장례지도사를 포함한 모든 이해관계자와 견고한 신뢰를 쌓을 것입니다
</div> 
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce01" class="go">해피라이프 소개 바로가기&nbsp;&nbsp; <i class="fas fa-angle-double-right"></i></a>   
    </div>
        
        
    
    
    
    
    <div id="join_wrap">
        <h2><!--<img src="<?php echo G5_THEME_IMG_URL ?>/join_img.png" />--><span>지금 해피라이프에 회원가입을 하시면<br class="visible-xs" /> 각종 다양한 혜택을 받으실 수 있습니다.</span></h2>
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
            <a href="<?php echo G5_BBS_URL ?>/register.php" class="join">회원가입</a>
            <?php } ?>
        </div>
    </div>

             

<div class="container">

     
<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>