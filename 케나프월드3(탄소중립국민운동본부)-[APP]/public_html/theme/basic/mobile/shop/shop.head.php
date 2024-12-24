<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');

add_javascript('<script src="'.G5_THEME_JS_URL.'/owl.carousel.min.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_JS_URL.'/owl.carousel.css">', 10);


?>

<script type="text/javascript">
	$(function(){
		$.ajax({
			url:"<?=G5_SHOP_URL?>/ajax.cart.count.php",
			dataType:"HTML",
			type:"POST",
			success:function(data){
				if(data){
					$(".cart_num").html(data);
					$(".cart_num").css("display","");
				}
			}
		});
	});
</script>

<? if(defined('_INDEX_')) {?>
<header id="hd">
	<div class="container">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>


        <div id="hd_wrapper"> 
            <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/">
               <img src="<?php echo G5_THEME_IMG_URL ?>/common/zeros_logo.png" alt="<?php echo $config['cf_title']; ?>"/>
                </a></div>    
            <div id="nav_open">
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                    <span></span><span></span><span></span>
                </a>
            </div><!--#nav_open-->
            
            
	<!-- 모바일 장바구니/검색버튼 시작{ -->
    <div class="r_btn">
		<button type="button" class="shop_cart">
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_cart.png" alt="장바구니"></a>
            <div class="cart_num" style="display:none">0</div>
        </button>
        <button type="button" id="hd_sch_open" class="hd_opener"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_sch.png" alt="검색"><span class="sound_only">열기</span></button>
        <div id="hd_sch" class="hd_div">
            <div id="sch_div"> 
                 <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);" >
                     <aside id="hd_sch">
                        <div class="sch_inner">
                            <h2>상품 검색</h2>
                            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="q"  id="sch_str" required class="frm_input " placeholder="찾으시는 제품을 입력해주세요">
                            <button type="submit" class="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_sch2.png" alt="검색"><span class="sound_only">검색</span></button>
                            <button type="button" id="sch_close" class="hd_closer"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_close2.png" alt="닫기"><span class="sound_only">닫기</span></button>
                        </div>
                    </aside>
                </form>
            </div>
        </div>

        <script>
        $(function () {
            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });
        });
        </script>
	</div>
	<!-- 모바일 장바구니/검색버튼 끝{ -->
    
    
<?php /*?><div id="tgnb">       
    <h2>모바일공통상단메뉴</h2>
    	<ul id="tgnb_1dul">
			<?php
            // 1단계 분류 판매 가능한 것만
            $hsql = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where length(ca_id) = '2' and ca_use = '1' order by ca_order, ca_id ";
            $hresult = sql_query($hsql);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
            for ($i=0; $row=sql_fetch_array($hresult); $i++)
            {
                $gnb_zindex -= 1; // html 구조에서 앞선 gnb_1dli 에 더 높은 z-index 값 부여
                // 2단계 분류 판매 가능한 것만
                $sql2 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '4' and SUBSTRING(ca_id,1,2) = '{$row['ca_id']}' and ca_use = '1' order by ca_order, ca_id ";
                $result2 = sql_query($sql2);
                $count = sql_num_rows($result2);
            ?>
            <li style="z-index:<?php echo $gnb_zindex; ?>">
                <a href="<?php echo G5_SHOP_URL.'/list.php?ca_id='.$row['ca_id']; ?>"><?php echo $row['ca_name']; ?></a>
                <?php
                for ($j=0; $row2=sql_fetch_array($result2); $j++)
                {
                if ($j==0) echo '<ul class="b" style="z-index:'.$gnb_zindex.'">';
                ?>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $row2['ca_id']; ?>"><?php echo $row2['ca_name']; ?></a></li>
                <?php }
                if ($j>0) echo '</ul>';
                ?>
            </li>
            <?php } ?>
        </ul>
</div><!--#tgnb--><?php */?>
    
    

        </div><!--#hd_wrapper-->
   </div><!--//container-->
</header>


<? }else { ?>
<header id="hd">
    <div id="hd_wrapper"> 
    	<a href="javascript:history.back();" class="back_closed"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/tnb_back.png" alt="뒤로"><span class="sound_only">뒤로</span></a>
    
        <div id="container_title">
			<?php if($bo_table) {?>
                <?php echo $board['bo_subject']; ?>
            <?php }else { ?>
                <?php echo $g5['title'] ?>
            <?php } ?>
        </div>
        
    <!-- 모바일 장바구니/검색버튼 시작{ -->
    <div class="r_btn">
		<button type="button" class="shop_cart">
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_cart.png" alt="장바구니"></a>
            <div class="cart_num" style="display:none">0</div>
        </button>
        <button type="button" id="hd_sch_open" class="hd_opener"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_sch.png" alt="검색"><span class="sound_only">열기</span></button>
        <div id="hd_sch" class="hd_div">
            <div id="sch_div"> 
                 <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);" >
                     <aside id="hd_sch">
                        <div class="sch_inner">
                            <h2>상품 검색</h2>
                            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="q"  id="sch_str" required class="frm_input " placeholder="찾으시는 제품을 입력해주세요">
                            <button type="submit" class="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_sch2.png" alt="검색"><span class="sound_only">검색</span></button>
                            <button type="button" id="sch_close" class="hd_closer"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_close2.png" alt="닫기"><span class="sound_only">닫기</span></button>
                        </div>
                    </aside>
                </form>
            </div>
        </div>

        <script>
        $(function () {
            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });
        });
        </script>
	</div>
	<!-- 모바일 장바구니/검색버튼 끝{ -->        
   </div><!--#hd_wrapper-->
</header>
<? } ?> 




	<? if(defined('_INDEX_')) {?>
    <? }else { ?>
	<div id="wrapper">
        <div id="container"">
		<?php /*?><?php
        $nav_skin = $skin_dir.'/navigation.skin.php';
        if(!is_file($nav_skin))
            $nav_skin = G5_SHOP_SKIN_PATH.'/navigation.skin.php';
        include $nav_skin;
        ?> <?php */?>       
            

    
    <? } ?> 
