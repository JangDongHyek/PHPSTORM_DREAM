<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

$sql="select sum(po_point) as total from g5_point where mb_id='$member[mb_id]' and po_rel_table != '@login'";
$result=sql_query($sql);
$row=sql_fetch_array($result);
$mb_point = ($row[total])? $row[total] : 0;
define('MEMBER_POINT', $mb_point);
?>
<style>
#gnb dl.active dt {background: #945f5f;}
</style>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>

    <div id="hd_wrapper">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>" style="width:150px;"></a></div>

        <div id="tnb">
            <h3>회원메뉴</h3>
            <ul>
				<?php if($is_member){ ?>
				<li>
					<span id="m-info"><?php echo $member['mb_name'] ?> | <?php echo $member['mb_id'] ?></span>
                    <!--
					<span style="color:#fff;font-weight:bold;width:100%;text-align:left;float:left"><a href="<?php echo G5_BBS_URL; ?>/pstore.list.php" style="color:#fff;">P : <?=number_format(MEMBER_POINT)?>점</a></span>
				    -->
				</li>
				<?php } ?>
				<?php if($is_admin){ ?>
				<li>
					<a href="<?php echo G5_URL; ?>/qna/list.php" id="mm-btn" target="_blank">수정문의</a>
				</li>
				<li>
					<a href="<?php echo G5_ADMIN_URL; ?>/newwinlist.php" id="mm-btn">팝업관리</a>
				</li>
				<li>
					<a href="<?php echo G5_ADMIN_URL; ?>/member_list.php" id="mm-btn">회원관리</a>
				</li>
				<?php } ?>
				<?php if($is_member){ ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/mb_edit.php" id="mm-btn">정보수정</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop" id="mm-btn">로그아웃</a></li>
				<?php } ?>
                <!--
				<?php if ($is_member) { ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>관리자</b></a></li>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
                <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
                <?php } ?>
                <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a></li>
                <?php if(G5_COMMUNITY_USE) { ?>
                <li><a href="<?php echo G5_URL; ?>/">커뮤니티</a></li>
                <?php } ?>
				-->
            </ul>
        </div>

    </div>

	<?
	// 스크롤 제어
	if($bo_table != "" || $co_id != "") {
		switch($bo_table){
			case "notice" : $gnbSub02 = true; break;			// 점주관리센터 - 공지사항
			case "sms" : $gnbSub02 = true; break;				// 점주관리센터 - 문자발송
			case "recipe" : $gnbSub02 = true; break;			// 점주관리센터 - 레시피
			case "recipe" : $gnbSub02 = true; break;			// 점주관리센터 - 레시피
			case "inquiry" : $gnbSub02 = true; break;			// 점주관리센터 - 레시피
			case "question" : $gnbSub02 = true; break;			// 점주관리센터 - 레시피
			case "praise" : $gnbSub02 = true; break;			// 점주관리센터 - 레시피
			case "recipe" : $gnbSub02 = true; break;			// 점주관리센터 - 레시피
			case "deliver" : $gnbSub06 = true; break;			// 점주/홍보물쇼핑몰 - 배송정보관리
			case "item" : 
				if($member['mb_level'] > 2) $gnbSub03 = true;	// 점주/홍보물쇼핑몰 - 상품관리
				else $gnbSub06 = true;
				break;		
			case "point_item" : 
				if($member['mb_level'] > 2) $gnbSub04 = true;	// 물품쇼핑몰 - 상품관리
				else $gnbSub07 = true;
				break;		
			case "ptmall_item" : 
				if($member['mb_level'] > 2) $gnbSub08 = true; 	// 포인트몰 - 상품관리
				else $gnbSub09 = true;
				break;
		}
		switch($co_id){
			case "delivery" : $gnbSub03 = true; break;			// 점주/홍보물쇼핑몰 - 배송업체관리
			case "common" : $gnbSub03 = true; break;			// 점주/홍보물쇼핑몰 - 공통정보관리
			case "cart" : $gnbSub06 = true; break;				// 점주/홍보물쇼핑몰 - 장바구니
			case "myorder" : 
				if($member['mb_level'] > 2) $gnbSub03 = true;	// 점주/홍보물쇼핑몰 - 주문관리
				else $gnbSub06 = true;
				break;	
			case "category" : $gnbSub03 = true; break;			// 점주/홍보물쇼핑몰 - 상품분류관리
			case "point_myorder" : 
				if($member['mb_level'] > 2) $gnbSub04 = true;	// 물품쇼핑몰 - 주문관리
				else $gnbSub07 = true;
				break;	
			case "point_category" : $gnbSub04 = true; break;	// 물품쇼핑몰 - 상품분류관리
			case "point_cart" : $gnbSub07 = true; break;		// 물품쇼핑몰 - 장바구니
			case "ptmall_myorder" : 
				if($member['mb_level'] > 2) $gnbSub08 = true;	// 포인트몰 - 주문관리
				else $gnbSub09 = true;
				break;	
			case "ptmall_category" : $gnbSub08 = true; break;	// 포인트몰 - 상품분류관리
			case "ptmall_cart" : $gnbSub09 = true; break;		// 포인트몰 - 장바구니
		}

	} else {
		switch(basename($_SERVER['PHP_SELF'])){
			case "ic_list.php" : $gnbSub01 = true; break;				// 재고관리 - 1:1문의카테고리
			case "ic_write.php" : $gnbSub01 = true; break;				// 재고관리 - 1:1문의카테고리
			case "qc_list.php" : $gnbSub01 = true; break;				// 재고관리 - Q&A카테고리
			case "qc_write.php" : $gnbSub01 = true; break;				// 재고관리 - Q&A카테고리
			case "pstore.list.php" : $gnbSub05 = true; break;			// 포인트관리자 - 발급/차감
			case "pstore.point.list.php" : 
				if($member['mb_level'] > 2) $gnbSub05 = true;			// 포인트관리자 - 발급/차감 상세이력
				else $gnbSub09 = true;
				break;			
			case "pstore_total.list.php" : $gnbSub05 = true; break;		// 포인트관리자 - 상세이력
			case "pstore_total.detail.php" : $gnbSub05 = true; break;	// 포인트관리자 - 상세이력
			case "order.php" : $gnbSub06 = true; break;					// 점주/홍보물쇼핑몰 - 주문하기
			case "point_order.php" : $gnbSub07 = true; break;			// 물품쇼핑몰 - 주문하기
		}
	}
	?>

</div>
<!-- } 상단 끝 -->


<?
// 왼쪽메뉴 OPEN, CLOSE
$leftMenu = ($_SESSION['leftMenu'])? $_SESSION['leftMenu'] : "open";

if ($leftMenu == "open") {
	$hd_div_style = "display: block;";
	$wrap_style = "width: calc(100% - 370px);";
} else {
	$hd_div_style = "display: none;";
	$wrap_style = "width: 100%;";
}
?>
<div id="hd_container">
<button type="button" id="gnb_open" class="hd_opener"><i class="fas fa-chevron-right"></i></button>
	<div class="hd_div" style="<?=$hd_div_style?>">
    <button type="button" id="gnb_close" class="hd_closer"><i class="fas fa-chevron-left"></i></button>
    <div id="gnb">
        <?php if($is_admin || $member['mb_level'] > 2){ ?>
        <dl id="sub_01" <? if($gnbSub01) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 관리/설정 </dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/ic_list.php"><i class="fa fa-angle-right"></i> 1:1 문의 카테고리 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/qc_list.php"><i class="fa fa-angle-right"></i> Q&amp;A 카테고리 관리</a></dd>
			<dd><a href="<?php echo G5_BBS_URL ?>/co_list.php"><i class="fa fa-angle-right"></i> 계육업체 관리</a></dd>
        </dl>
        <?php } ?>
        <dl id="sub_02" <? if($gnbSub02) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 점주 관리센터</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice"><i class="fa fa-angle-right"></i> 공지사항</a></dd>
            <?php if($is_admin || $member['mb_level'] > 2){ ?>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=sms"><i class="fa fa-angle-right"></i> 문자발송</a></dd>
            <?php } ?>
			<dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=movie"><i class="fa fa-angle-right"></i> 교육영상</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=recipe"><i class="fa fa-angle-right"></i> 레시피안내</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=inquiry"><i class="fa fa-angle-right"></i> 1:1 문의</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=question"><i class="fa fa-angle-right"></i> Q&amp;A</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=praise"><i class="fa fa-angle-right"></i> 칭찬합니다</a></dd>
        </dl>

        <?/* 관리자 */ ?>
        <?php if($is_admin || $member['mb_level'] > 2){ ?>
				
		 <dl id="sub_04" <? if($gnbSub04) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 물품 쇼핑몰 (주방집기/기기)</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=point_myorder"><i class="fa fa-angle-right"></i> 주문 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=point_item"><i class="fa fa-angle-right"></i> 상품 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=point_category"><i class="fa fa-angle-right"></i> 상품분류 관리</a></dd>
        </dl>
		
		<dl id="sub_08" <? if($gnbSub08) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 마일리지 몰</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ptmall_myorder"><i class="fa fa-angle-right"></i> 주문 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=ptmall_item"><i class="fa fa-angle-right"></i> 상품 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ptmall_category"><i class="fa fa-angle-right"></i> 상품분류 관리</a></dd>
        </dl>
		

        <dl id="sub_05" <? if($gnbSub05) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 마일리지 관리자</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/pstore.list.php"><i class="fa fa-angle-right"></i> 마일리지 발급/차감</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/pstore_total.list.php"><i class="fa fa-angle-right"></i> 마일리지 상세이력</a></dd>
        </dl>
		
						
        <dl id="sub_03" <? if($gnbSub03) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 홍보물 쇼핑몰</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=myorder"><i class="fa fa-angle-right"></i> 주문 관리</a></dd>
            <? /* ?><dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=myorder_miss"><i class="fa fa-angle-right"></i> 주문 누락 관리</a></dd><? */ ?>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=item"><i class="fa fa-angle-right"></i> 상품 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=category"><i class="fa fa-angle-right"></i> 상품분류 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=delivery"><i class="fa fa-angle-right"></i> 배송업체 관리</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=common"><i class="fa fa-angle-right"></i> 공통정보 관리</a></dd>
        </dl>




        <?php } ?>

        <?/* 점주 */ ?>
        <?php if($member['mb_level'] == 2){ ?>
		
		
		<dl id="sub_07" <? if($gnbSub07) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 물품 쇼핑몰 (주방집기/기기)</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=point_item"><i class="fa fa-angle-right"></i> 주문하기</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=point_cart"><i class="fa fa-angle-right"></i> 장바구니</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=point_myorder"><i class="fa fa-angle-right"></i> 주문내역</a></dd>
        </dl>
		
		
        <dl id="sub_09" <? if($gnbSub09) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 포인트 몰</dt>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=ptmall_item"><i class="fa fa-angle-right"></i> 주문하기</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ptmall_cart"><i class="fa fa-angle-right"></i> 장바구니</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ptmall_myorder"><i class="fa fa-angle-right"></i> 주문내역</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/pstore.point.list.php?mb_id=<?=$member[mb_id]?>"><i class="fa fa-angle-right"></i> 포인트 이력</a></dd>
        </dl>
		
		
		
        <dl id="sub_06" <? if($gnbSub06) echo "class='active'"; ?>>
            <dt><i class="fa fa-flag" aria-hidden="true"></i> 홍보물 쇼핑몰</dt>
            <dd><a href="http://shop.jangsfood.com/" target="_blank"><i class="fa fa-angle-right"></i> 주문하기</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cart"><i class="fa fa-angle-right"></i> 장바구니</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=myorder"><i class="fa fa-angle-right"></i> 주문내역</a></dd>
            <dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=deliver"><i class="fa fa-angle-right"></i> 배송정보 관리</a></dd>
        </dl>
    


    
        <?php } ?>
        
        <script>
        var gnbActiveEl = $("dl.active").attr('id'),
            gnbSt = 0;

        if(gnbActiveEl != undefined) {
            var elSt = $("#"+gnbActiveEl).position().top;
            if($("#gnb").height() < elSt) { gnbSt = elSt; }
        }

        $(function(){
            $("#gnb").scrollTop(gnbSt);
        });

        </script>

    </div>

    <div id="ft">
        <div>
            <a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_IMG_URL; ?>/footer_logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo"></a>
            <a href="http://www.ftc.go.kr/info/bizinfo/communicationView.jsp?apv_perm_no=2015321015330201992&area1=&area2=&currpage=1&searchKey=03&searchVal=%C0%E5%C1%B6%BF%F5&stdate=&enddate=" target="_blank" class="btn btn-xs">사업자정보확인</a>
    
            <!--<a href="<?php echo G5_SHOP_URL; ?>/" id="ft_logo"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img2" alt="처음으로"></a> -->
            <!--<ul>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
            </ul> -->
            <p>
                <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
                <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
                <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
                <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?><br /></span><br />
                            
                <!--span><b>대표전화</b> <?php echo $default['de_admin_company_tel']; ?></span-->
                <span style="color:#fff200; font-weight:900">
                <span><b>SV</b> 02-6011-7047</span> <span><b>디자인</b> 02-6011-7051 </span><br>
                <span><b>구매</b> 02-6213-0193</span> <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span></span><br>
                
                <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
                <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
                <!--<span><b>개인정보 보호책임자</b> <?php echo $default['de_admin_info_name']; ?></span> -->
                
    
                <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
                Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.        </p>
            <!--<a href="#" id="ft_totop"><i class="fa fa-chevron-up"></i></a> -->
      </div>
    </div>
    </div>
</div>
<script>
$(function () {
	/* if (sessionStorage.getItem("leftMenu") == "close") {
		$("div.hd_div").hide();
		$("#wrapper").css("width", "100%");
	} */

    $(".hd_opener").on("click", function() {
        var $this = $(this);
        var $hd_layer = $this.next(".hd_div");
        $("#wrapper").css("width","100%");

        if($hd_layer.is(":visible")) {
            $hd_layer.hide();
            $this.find("span").text("열기");
			$("#wrapper").css("width","100%");
        } else {
            var $hd_layer2 = $(".hd_div:visible");
            $hd_layer2.prev(".hd_opener").find("span").text("열기");
            $hd_layer2.hide();

            $hd_layer.show();
            $this.find("span").text("닫기");
			$("#wrapper").css("width","calc(100% - 370px)");
        }

		//sessionStorage.setItem("leftMenu", "open");
		setLeftMenu("open");
    });

    $(".hd_closer").on("click", function() {
        var idx = $(".hd_closer").index($(this));
        $(".hd_div:visible").hide();
        $(".hd_opener:eq("+idx+")").find("span").text("열기");
        $("#wrapper").css("width","100%");

		//sessionStorage.setItem("leftMenu", "close");
		setLeftMenu("close");
    });
});

function setLeftMenu(mode) {
	$.post(g5_bbs_url + "/ajax.left_menu.php", {"display": mode}, function(data) {
		console.log(data);
	});
}
</script>


<div id="wrapper" style="<?=$wrap_style?>">
    <!-- 콘텐츠 시작 { -->
    <div id="container">
    	<div id="quick_menu">
        	<ul>
            	<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=inquiry"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon01.png" alt="" ></span><p>1:1문의</p></a></li>

				<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=question"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon10.png" alt="Q&A"></span><p>Q&amp;A</p></a></li>
            	<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=praise"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon11.png" alt="칭찬합니다"></span><p>칭찬합니다</p></a></li>

            	<!--<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="http://filedn.smilebiz.co.kr/TSBZ/REAL/run.php" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon03.png" alt="" ></span><p>전용유</p></a></li> -->
            	
				
				<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="http://www.jangsfood.shop" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon04.png" alt="" ></span><p>홍보&amp;판촉물</p></a></li>
				
				
				
            	<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="https://onlyonefoodnet.co.kr" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon02.png" alt="" ></span><p>상품발주</p></a></li>
            	<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="https://ceo.baemin.com/" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon05.png" alt="" ></span><p>배달의민족</p></a></li>

				<? if ($member['mb_level'] == "2") { ?>
				<li>
					<img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="http://60chicken.jangsfood.com/60chicken/notice/shortage/?c_id=<?=md5(strtolower($member['mb_id']))?>" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon12.png" alt="" ></span><p>결품수량확인</p></a>
				</li>
				<? } ?>

            	<!--<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="https://owner.yogiyo.co.kr/owner/login/" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon06.png" alt="" ></span><p>요기요</p></a></li>
            	<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="http://fms.giftsmartcon.com:18080/login/loginform.sc" target="_blank"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon07.png" alt="" ></span><p>스마트콘</p></a></li> -->
            	
				
				<?php if($member['mb_level'] == 2){ ?>
				
				<!--li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=inquiry&c_name=10"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon08.png" alt="전화상담신청"></span><p>전화상담신청</p></a></li>
            	<li><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_arrow.png" alt="" class="arrow"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=inquiry&c_name=12"><span class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/shop/quick_icon09.png" alt="방문상담신청"></span><p>방문상담신청</p></a></li-->
				<?php } ?>
				
				
				
				
            </ul>
        
        </div>
        <!--
		<?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?>
		<div id="wrapper_title"><?php echo $g5['title'] ?></div>
		<?php } ?>
		-->
    