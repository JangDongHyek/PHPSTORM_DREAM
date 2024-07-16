<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//현재주소를 불러옴
// $uri = $_SERVER['REQUEST_URI'];
// $uri = explode('/',$uri);
// //배열의 마지막 반환
// $arr_last=array_pop($uri);

?>
    </div>
</div>

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span class="sound_only">브라우저 최상단으로 이동합니다</span></a>
</div>
<script>
$(document).ready(function(){
	$("#gobtn").hide();

	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});

	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});
</script>


<div id="ft_copy">

	<div class="inr">
		<ul class="list_link">
			<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
			<li><a href="<?php echo G5_BBS_URL ?>/cscenter.php">고객센터</a></li>
		</ul>
		<div class="ft_left">
			<div class="logo">
				<a href="<?php echo G5_URL ?>/index.php">
					<img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_logo.svg" alt="<?php echo $config['cf_title']; ?>">
				</a>
			</div><!--.logo-->
			<ul class="ad_info">
				<li><span>바인플랜트(주)</span></li>
				<!--<li><b>대표</b><span>한녕균</span></li>-->
				<li><b>사업자등록번호</b><span>735-81-02350</span></li>
				<li><b>통신판매업신고</b><span>2022-부산해운대-0222</span></li><br>
				<li><span>부산광역시 해운대구 센텀중앙로 97, A동 1607호</span> </li>
				<li><b>TEl</b><span class="tel"><a href="tel:07078430031 ">070.7843.0031 </a></span></li>
				<li><b>E-mail</b><span><a href="mailto:support@podosea.com">support@podosea.com</a></span></li>
			</ul>
			<em>
			바인플랜트㈜는 통신판매중개자로서 통신판매의 당사자가 아니며 개별 판매자가 제공하는 서비스에 대한 이행, 계약사항 등과 관련한 의무와 책임은 거래당사자에게 있습니다. 바인플랜트㈜ 포도씨 사이트의 상품/회원 정보/중개 서비스/거래 정보/콘텐츠/UI 등에 대한 무단복제, 전송, 배포, 스크래핑 등의 행위는 저작권법, 콘텐츠산업 진흥법 등 관련법령에 의하여 엄격히 금지됩니다. 포도씨 사이트에 게시된  의뢰기업 정보가 무단으로 수집되는 것을 거부합니다.
			</em>
			<div class="copy w">© 2021 <span class="blue">PODOSEA</span> All Rights Reserved.</div>
		</div>
		<div class="ft_right">
			<ul class="ft_sns">
				<li class="blog"><a href="https://blog.naver.com/vineplant" target="_self"></a></li>
				<li class="facebook"><a href="https://www.facebook.com/%ED%8F%AC%EB%8F%84%EC%94%A8-103701035534437" target="_self"></a></li>
				<li class="insta"><a href="https://www.instagram.com/podo_sea" target="_self"></a></li>
				<li class="youtube"><a href="https://www.youtube.com/channel/UCzo4EtUT81aiCJcGOq_WQvA" target="_self"></a></li>
			</ul>
			<ul class="ft_list">
				<li><a href="<?php echo G5_BBS_URL ?>/introduce.php">포도씨소개</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/movie.php">소개영상</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보취급방침</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a></li>
			</ul>
		</div>
		<div class="copy m">© 2021 <span class="blue">PODOSEA</span> All Rights Reserved.</div>
    </div>

</div><!--#ft_copy-->



<div id="ft">
	<?
	$ft_menu = array();
	$ft_menu['home'] = array('name'=>'홈', 'url'=>G5_URL.'/index.php', 'on'=>'/app/ft_icon01_on.svg', 'off'=>'/app/ft_icon01.svg');
    // // 22.12.06 기업검색 메뉴 및 기업회원 접근불가 (기업검색, 커리어)
    $ft_menu['company'] = array('name'=>'기업검색', 'url'=>G5_BBS_URL.'/company_search.php', 'on'=>'/app/ft_icon05_on.svg', 'off'=>'/app/ft_icon05.svg');
    $ft_menu['career'] = array('name'=>'커리어', 'url'=>G5_BBS_URL.'/career.php', 'on'=>'/app/ft_icon04_on.svg', 'off'=>'/app/ft_icon04.svg');
    $ft_menu['sale'] = array('name'=>'헬프미', 'url'=>G5_BBS_URL.'/help_list.php', 'on'=>'/app/ft_icon02_on.svg', 'off'=>'/app/ft_icon02.svg');
	$ft_menu['buy'] = array('name'=>'커뮤니티', 'url'=>G5_BBS_URL.'/community.php', 'on'=>'/app/ft_icon03_on.svg', 'off'=>'/app/ft_icon03.svg');
    if($member['mb_category'] == '기업') $my_url = G5_BBS_URL.'/mypage_company.php';
    if($member['mb_category'] == '일반') $my_url = G5_BBS_URL.'/mypage.php';
	$ft_menu['my'] = array('name'=>'마이메뉴', 'url'=>$my_url, 'on'=>'/app/ft_icon06_on.svg', 'off'=>'/app/ft_icon06.svg');
	//$ft_menu['my']['url'] = ($is_member)? G5_BBS_URL."/store.php" : G5_BBS_URL."/login.php?url=".G5_BBS_URL."/store.php"; ///register_form.php?w=u


	?>
	<div id="ft_menu">
		<ul>
			<? foreach ($ft_menu AS $key=>$val) {
				$_cls = ($page_id == $key)? "on" : "";
				$_img = ($page_id == $key)? $val['on'] : $val['off'];
				if($val['name']!='제품등록'){
				    if($val['name']=='마이메뉴') {
                        if($member['mb_category'] == '기업') $my_url = G5_BBS_URL.'/mypage_company.php';
                        if(!$is_member || $member['mb_category'] == '일반') $my_url = G5_BBS_URL.'/mypage.php';
				        $val['url'] = $my_url;
                    }
			?>
			<li class="<?=$_cls?>"><a href="<?=$val['url']?>"><img src="<?=G5_THEME_IMG_URL?><?=$_img?>" /><p><?=$val['name']?></p></a></li>
			<? }else {?>

			<li class="<?=$_cls?>"><a href="javascript:void(0)" onclick="insert_modal()"><img src="<?=G5_THEME_IMG_URL?><?=$_img?>" /><p><?=$val['name']?></p></a></li>

			<?}} ?>
		</ul>
		<?/*
    	<ul>
			<li class="on"><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon01_on.svg" /><p>홈</p></a></li>
			<!--<li><a class="btn_menu" href="#"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02.svg" /><p>카테고리</p></a></li>-->
        	<li><a href="<?php echo G5_BBS_URL; ?>/sale.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03.svg" /><p>팝니다</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL; ?>/buy.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon04.svg" /><p>삽니다</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL; ?>/company.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon06.svg" /><p>협력업체</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL; ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05.svg" /><p>마이메뉴</p></a></li>
        </ul>
		<!-- class on 추가
		<ul>
			<li class="on"><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon01_on.svg" /><p>홈</p></a></li>
			<li class="on"><a href="<?php echo G5_BBS_URL; ?>/sale.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03_on.svg" /><p>팝니다</p ></a></li>
        	<li class="on"><a href="<?php echo G5_BBS_URL; ?>/buy.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon04_on.svg" /><p>삽니다</p></a></li>
        	<li class="on"><a href="<?php echo G5_BBS_URL; ?>/company.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon06_on.svg" /><p>협력업체</p></a></li>
        	<li class="on"><a href="<?php echo G5_BBS_URL; ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05_on.svg" /><p>마이메뉴</p></a></li>
        </ul>
		<!-- //class on 추가 -->
		*/ ?>
    </div>
</div>


<!-- 제품등록 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="myModalLabel">제품등록</h4>
                </div>
                <div class="modal-body">
					<ul>
						<li><a href="<?php echo G5_BBS_URL; ?>/sell_regi.php?from=modal">팝니다 제품등록</a></li>
						<li><a href="<?php echo G5_BBS_URL; ?>/buy_regi.php?from=modal">삽니다 제품등록</a></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- //제품등록 모달팝업 -->

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
function insert_modal() {
    $("#myModal").modal();
}
$(function() {
    // 모바일에서 a 태그 target '_self'로 변경, 웹뷰에서 새창 안열리는 문제
    if('<?=$mobile?>') {
        $('a').attr('target', '_self');
    }
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_BBS_PATH . '/ajax_get_page.php'); // 페이징
include_once(G5_THEME_PATH."/tail.sub.php");
?>
