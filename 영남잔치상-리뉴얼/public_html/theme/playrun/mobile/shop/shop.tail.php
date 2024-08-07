<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
	</div>
	<!-- /sub_cont_box -->
	</div>
	<!-- /sub_cont_box -->

	<!-- /mainBox -->
	<div class="rightBox">
		<?php
		include_once('inc/right_box.php');
		?>

	</div>
	<!-- /rightBox -->
</section>
</div><!-- container End -->
</div><!-- wrapper End -->
</div>
<!-- <div class="ft_info">
<div class="inr">
	<div id="newft">
		<div class="telBox">
			<h4>고객센터 및 상담문의</h4>
			<p class="telN">010-8514-5236</p>
			<p class="txt">평일,주말 AM09:00 ~ PM18:00</p>
		</div>
		<div class="accBox">
			<h4>입금계좌</h4>
				<div class="account">

				<p>농협은행 : <span class="accnum">307-0757-2378-71</span></p>
				</div>
				<span class="txt">예금주 : 헤스티아 가구 박준혁</span>

		</div>
		<div class="notiBox">
			<h4>공지사항</h4>
			사진 최신글2 {
				<?php
				// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
				// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
				// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
				echo latest('theme/shop_basic','notice',  3, 23);
				?>
		</div>
	</div>
	/newft

</div>
</div>
 -->
<div id="pfooter" style="text-align:right; margin:0px auto; width:1114px">
    <img src="<?php echo G5_THEME_IMG_URL ?>/common/ft.jpg" alt="" usemap="#footermap">

    <map name="footermap" id="footermap">
      <area shape="rect" coords="1047,5,1098,30" href="#" />
      <area shape="rect" target="_blank" coords="557,4,643,25" href="https://www.ftc.go.kr/bizCommPop.do?wrkr_no=6071169261" />
      <area shape="rect" coords="480,6,530,25" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qa" />
      <area shape="rect" coords="354,5,450,22" href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" />
      <area shape="rect" coords="272,6,323,22" href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision" />
      <area shape="rect" coords="191,5,238,22" href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company" />
      <area shape="rect" coords="178,110,277,134" href="http://www.itforone.co.kr/" target="_blank" />
    </map>
</div>


<div id="footer">
	<!--div class="ft_top">
		<div class="inr">
			<div class="btmBtn">
				<span class="btmBtnBox">
					<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
					<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
					<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="">개인정보처리방침</a>
					<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=gall01">고사행사 갤러리</a>
					<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=gall02">잔치행사 갤러리</a>
					/*<a href="#">찾아오시는 길</a>*/
					<a href="<?php echo G5_URL; ?>/adm">관리자</a>
				</span>
				<div class="noti_ver">
					<b>NOTICE</b>
					<div class="swiper-container noti_slide">                
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-wrapper">        
							<?php
								$sql="select * from g5_write_notice order by wr_id desc limit 3";
								$result=sql_query($sql);
								for($i=0;$row=sql_fetch_array($result);$i++){
							?>
							<div class="swiper-slide"><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=notice&wr_id=<?php echo $row[wr_id]?>"><?php echo $row[wr_subject]?></a></div>
							<?php }?>
 							/*<div class="swiper-slide"><a href="#">영남잔치상 홈페이지 저작권에 관하여 안내드립니다.</a></div>
							<div class="swiper-slide"><a href="#">영남잔치상 홈페이지 저작권에 관하여 안내드립니다.</a></div>*/
						</div>                
					</div>
				</div>
			</div>
		</div>
	</div-->
    <div class="inr">
        <div class="visible-xs" id="ft_login">
            <!--로그인/로그아웃-->
            <ul>
                <?php if ($is_member) { ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-unlock"></i> 로그아웃</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><i class="fas fa-user"></i> 정보수정</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fas fa-lock"></i> 로그인</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/register_form.php" id="snb_join"><i class="fas fa-user"></i> 회원가입</a></li>
                <?php } ?>
            </ul>
        </div>
        <!--#ft_login-->


        <!--하단정보-->
        <div id="bcus_box_wrap">
            <div id="bcus_box">
                <div class="tel">
                    <h3>1688.7892</h3>
                    <span>FAX : 0504-051-4517</span>
                    <span>youngnam784@naver.com</span>
                </div>
                <!--.tel-->
                <ul class="area_sns">
                    <li class="naver"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice"><span>공지사항</span></a></li>
                    <li><a class="cs_btn" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=faq"><span>자주 묻는 질문</span></a></li>
                    <li class="kakao"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qa"><span>문의게시판</span></a></li>
                </ul>
            </div>
            <!--#bcus_box-->

            <div id="bcux_box2">
                <dl>
                    <dt>상담시간</dt>
                    <div class="bank">
                        <div class="bpoint">월-토 : 10:00 ~ 19:00</div>
                        <div class="bpoint">점심시간 : 12:00 ~ 13:00</div>
                    </div>
                    <!--.bank-->
                </dl>
                <dl>
                    <dt>예금계좌안내</dt>
                    <div class="bank">
                        <div class="bpoint">
                            농협 | 927-02-654184<br>
                            부산은행 | 073-12-127946-9<br>
                        </div>
                        <p>
                            예금주 : 정재영 (영남잔치상)
                        </p>
                    </div>
                    <!--.bank-->
                </dl>
            </div>
            <!--#bcus_box2-->
        </div>
        <!--#bcus_box_wrap-->

        <div id="ft">
			<div class="flexBox">
            <div class="img_wrap">
                <h1 class="logo">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="">
                </h1>
                <p class="btn_link"><a href="https://www.ftc.go.kr/bizCommPop.do?wrkr_no=6071169261" target="_blank">사업자정보확인</a></p>
				<div class="add_img"><img src="<?php echo G5_THEME_IMG_URL ?>/common/img_ad_ft.jpg" alt=""></div>
                <!-- <ul class="sns_wrap">
                    <li>
                        <a onclick="alert('준비중입니다')">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_insta.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a onclick="alert('준비중입니다')">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_facebook.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a onclick="alert('준비중입니다')">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_naver01.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a onclick="alert('준비중입니다')">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_naver02.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a onclick="alert('준비중입니다')">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_youtube.png" alt="">
                        </a>
                    </li>
                </ul> -->
            </div>
            <div class="copy_info">
                <div id="ft_copy">
                    <span>상호 : 영남잔치상</span>&nbsp;&nbsp;
                    <span>대표이사 : 정재영</span>&nbsp;&nbsp;
                    <span>주소 : 부산광역시 동래구 시실로 167번길 64 (신양빌딩)</span><br>
                    <span>TEL : 1688-7892</span>&nbsp;&nbsp;
                    <span>FAX : 0504-051-4517</span><br>
                    <span>E-mail : youngnam784@naver.com</span><br>
                    <span>사업자등록번호 : 607-11-69261</span>&nbsp;&nbsp;
                    <span>개인정보보호책임자 : 정재영</span><br>
                    <span>통신판매업신고번호 : 2001-부산동래- 0012호</span>&nbsp;&nbsp;<span>식품제조가공업체 제 122호</span>

                </div>
                <!--#ft_copy-->
                <p class="copy">copyright(c)2022 janchsang.com.All Rights Reserved. <br class="visible-xs"></p>
            </div>
			</div>
            <!--#ft-->
        </div>
    </div>
</div>

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">

    <!-- <a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a> -->
</div>





<script>
    $(document).ready(function() {
        $("#gobtn").hide();

        // fade in #back-top
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#gobtn').fadeIn();
                } else {
                    $('#gobtn').fadeOut();
                }
            });
        });

        $('.goHd').click(function($e) {
            $('html, body').animate({
                scrollTop: 0
            });
            return false
        });
    });
</script>




<a href="#" id="ft_to_top">TOP</a>
<a href="tel:051-528-1405" id="ft_to_call"><i class="fas fa-phone"></i></a>



<script>
    //    $(function() {
    //        $("#ft_to_top").on("click", function() {
    //            $("html, body").animate({scrollTop:0}, '500');
    //            return false;
    //        });
    //    });
</script>
<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>



<?php /*?><div align="center">
    <script language="JavaScript" src="https://pgweb.dacom.net/WEB_SERVER/js/escrowValid.js" type="text/javascript"></script><a onClick="goValidEscrow('si_sehyuninter');"><img src="<?=G5_URL?>/theme/kidstore2<?php echo G5_THEME_IMG_URL ?>/escro.jpg" width="227" border="0" style="cursor:hand" /></a>
</div><?php */?>


<!--ul class="b_menu">
    <li><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu01.png">홈</a></li>
    <li><a href="#hash-menu"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu02.png">카테고리</a></li>
    <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu03.png">회사소개</a></li>
    <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu04.png">장바구니</a></li>
    <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu05.png">마이페이지</a></li>
</ul-->

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>