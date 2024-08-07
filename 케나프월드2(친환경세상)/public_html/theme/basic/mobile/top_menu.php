<? 
include_once("./_common.php");
include_once(G5_THEME_PATH.'/head.sub.php');
?>
<style></style>

<!--상단 메뉴부분 시작-->
<div id="header">
    <h1 class="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_logo.png" alt="로고"/></a></h1>
    <div class="btnMenu">
        <a href="#" class="bt1"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/toggle_menu.png" alt="메뉴열기"/><span class="sound_only">열기</span></a>
    </div>
    <div class="filter">
        <a href="#"><i class="fa fa-pencil-square-o fa-2x"></i><span class="sound_only">필터적용</span></a>
    </div>
    <nav class="side1">
    	<div class="icons">
            <a href="<?php echo G5_URL ?>"><i class="fa fa-home"></i><span class="sound_only">홈으로</span></a>
            <a href="#"><i class="fa fa-cog"></i><span class="sound_only">설정</span></a>
            <a href="#" class="closed"><i class="fa fa-times"></i><span class="sound_only">닫기</span></a>
        </div> 
        <div class="mypage">
        	<div class="avatar"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_logo2.png" alt="로고"/></div>
            <ul class="icon_menu3">
            	<li class="a"><a href="#">로그인</a></li>
            	<li class="b"><a href="#">아이디/비밀번호 찾기</a></li>
                <li class="c"><a href="#">10초 회원가입</a></li>
            </ul>
        </div><!--mypage-->
        <div id="gnb" class="hd_div">
            <ul class="gnb_1dul">
                <li class="gnb_1dli"><i class="fa fa-music"></i><a href="#">연습실 찾기</a></li>
                <li class="gnb_1dli"><i class="fa fa-headphones"></i><a href="#">합주실 찾기</a></li>
                <li class="gnb_1dli"><i class="fa fa-volume-up"></i><a href="#">학원 찾기</a></li>
            </ul>
            <ul class="gnb_1dul">
                <li class="gnb_1dli"><i class="fa fa-paper-plane"></i><a href="#">최근 본 연습실</a></li>
                <li class="gnb_1dli"><i class="fa fa-eyedropper "></i><a href="#">찜 한 연습실</a></li>
            </ul>
            <ul class="gnb_1dul">
                <li class="gnb_1dli"><i class="fa fa-file-text"></i><a href="#">악보 제작 의뢰하기</a></li>
                <li class="gnb_1dli"><i class="fa fa-address-book"></i><a href="#">오브리/구인구직</a></li>
                <li class="gnb_1dli"><i class="fa fa-commenting"></i><a href="#">연주자들 이야기</a></li>
                <li class="gnb_1dli"><i class="fa fa-calendar-minus-o"></i><a href="#">공연정보</a></li>
            </ul>
            <ul class="gnb_1dul">
                <li class="gnb_1dli"><i class="fa fa-thumbs-o-up"></i><a href="#">연습실 Top10</a></li>
                <li class="gnb_1dli"><i class="fa fa-thumbs-o-up"></i><a href="#">학원 Top10</a></li>
            </ul>
        </div>   
        <div class="c_center">
        	<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_call.png"/>
            <h3><span><?php echo $config['cf_title']; ?></span> 콜센터</h3>
            <p>051-123-1234</p>
            <span class="mun">E-mail : test@naver.com</span>
        </div>    
        <div class="c_copy">
			<ul>
            	<li><a href="#">정보삭제요청</a></li>
                <li><a href="#">약관보기</a></li>
                <li><a href="#">개인정보처리방침</a></li>
                <li><a href="#">고객센터</a></li>
            </ul>
			<address>
				<p><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span> <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span><span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span></p>
				<p><span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span> <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span> <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span><span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span> <span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span></p>
                <p><span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span> <span><strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?></span></p>
				<p class="co">COPYRIGHT(c) 2017 <strong></strong> ALL RIGHTS RESERVED</p>
			</address>	
        </div>     
    </nav><!--side1-->
    <div class="blackBG"></div>
</div><!--header-->
<!--상단 메뉴부분 끝-->