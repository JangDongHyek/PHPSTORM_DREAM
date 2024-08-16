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
        <div class="m_box">
        	<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=system01" class="mbox01">
				<div><img src="<?php echo G5_THEME_IMG_URL ?>/mbanner01.jpg" alt="" /></div>            
            </a>
        	<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=system02" class="mbox02">
				<div><img src="<?php echo G5_THEME_IMG_URL ?>/mbanner02.jpg" alt="" /></div>            
            </a>
        	<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=system03" class="mbox03">
				<div><img src="<?php echo G5_THEME_IMG_URL ?>/mbanner03.jpg" alt="" /></div>            
            </a>
        </div><!--.m_box1-->
        
        <div class="m_box2">
			<img src="<?php echo G5_THEME_IMG_URL ?>/mbanner04.jpg" alt="" />        
        </div><!--.m_box2-->
        
        <?php /*?><div class="m_box2">
        	<ul>
            	<li class="mbox04">
                    <h1>베네치안</h1>
                    <h2>콘크리트/시멘트몰탈/석면판/실내장식용</h2>
                    <p>
                    베네치아 풍의 스투코 효과를 나타내는 퍼티형태의 도료로써 고풍의 빈티지한 <br />
                    효과를 나타내는 반광택 고급 마감도료이고 엑틱한 질감을 구현
                    </p>
                    <a href="" class="mbox_btn">보러가기 &nbsp;&nbsp;+</a>
        	    </li>
            	<li class="mbox05">
                    <h1>키메라</h1>
                    <h2>콘크리트/시멘트몰탈/석면판/실내장식용</h2>
                    <p>
                    다양한 도구를 활용하여 고풍스러운 효과를 나타내는 반광택의 장식용 고급마감재<br />
                    도구의 활용에 다라 같은 색상이라도 두가지 이상의 연출이 가능
                    </p>
                    <a href="" class="mbox_btn">보러가기 &nbsp;&nbsp;+</a>
        	    </li>
        	</ul>
        </div><?php */?>
    </div><!--#main_box-->

    <div id="idx_best">
    	<div class="container">
            <div class="idx_best_box">
                <h2>
                <strong>주차</strong>차단기
               		<p>언제나 고객여러분의 만족을 위해 정직한 마음으로 최선을 다합니다.</p> 
                </h2>
				<?php 
                $list = new item_list(); 
                $list->set_category('10', 1); 
                $list->set_list_mod(4); 
                $list->set_list_row(1); 
                $list->set_img_size(280, 280); 
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
        </div>
    </div>

    <div id="idx_new">
    	<div class="container">
            <div class="idx_new_box">
                <h2>
                <strong>차량번호</strong>인식기
               		<p>언제나 고객여러분의 만족을 위해 정직한 마음으로 최선을 다합니다.</p> 
                </h2>
				<?php 
                $list = new item_list(); 
                $list->set_category('20', 1); 
                $list->set_list_mod(4); 
                $list->set_list_row(1); 
                $list->set_img_size(280, 280); 
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
        </div>
    </div>

    <div id="idx_rec">
    	<div class="container">
            <div class="idx_rec_box">
                <h2>
                <strong>무선</strong>CCTV
               		<p>언제나 고객여러분의 만족을 위해 정직한 마음으로 최선을 다합니다.</p> 
                </h2>
				<?php 
                $list = new item_list(); 
                $list->set_category('30', 1); 
                $list->set_list_mod(4); 
                $list->set_list_row(1); 
                $list->set_img_size(275, 275); 
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
        </div>
    </div>

    <div id="idx_rec">
    	<div class="container">
            <div class="idx_rec_box">
                <h2>
               <strong>크레인</strong>CCTV
               		<p>언제나 고객여러분의 만족을 위해 정직한 마음으로 최선을 다합니다.</p> 
                </h2>
				<?php 
                $list = new item_list(); 
                $list->set_category('40', 1); 
                $list->set_list_mod(4); 
                $list->set_list_row(1); 
                $list->set_img_size(275, 275); 
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
        </div>
    </div>

<div class="container">

     
<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>