<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

</div><!-- container End -->
</div><!-- wrapper End -->


<? if(defined('_INDEX_')) {?>

<div id="ft">
	<div class="ft_com">
        <ul>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a></li>
            <li class="bno"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="point">개인정보처리방침</a></li>
            <li><a href="http://ftc.go.kr/www/bizCommList.do?key=232" target="_blank">사업자정보</a></li>
            <?php /*?><p><?php echo $default['de_admin_company_name']; ?>의 제품이미지의 저작권은 <?php echo $default['de_admin_company_name']; ?>에 있음을 알립니다.</p><?php */?>
        </ul>
     </div>
            
	<div id="ft_box">
        <div id="ft_copy">
            <h1><strong><?php echo $default['de_admin_company_name']; ?></strong></h1>
            <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
            <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br />
            <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
            <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
            <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
            <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span><br />
            <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span>
            <div class="copy">Copyright &copy; 2019 <strong class="point"><?php echo $default['de_admin_company_name']; ?></strong>. All Rights Reserved.</div>
        </div>
	</div><!--#ft_box-->
</div>

<? } ?> 


<!--하단 퀵메뉴-->
<div id="quick_menu">
	<a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_home.png" alt="HOME"><p>HOME</p></a>
	<a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_my.png" alt="마이페이지"><p>마이페이지</p></a>
	<a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_cate.png" alt="카테고리"><p>카테고리</p></a>
	<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_cus.png" alt="고객센터"><p>고객센터</p></a>
</div><!--#quick_menu-->


<!--하단전화/탑 버튼-->
<?php /*?><a href="#" id="ft_to_top">TOP</a>
<a href="tel:051-961-0502" id="ft_to_call"><i class="fas fa-phone"></i></a>
<script>
    $(function() {
        $("#ft_to_top").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
</script><?php */?>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>


<?php /*?><div align="center"><script language = "JavaScript" src = "https://pgweb.dacom.net/WEB_SERVER/js/escrowValid.js" type="text/javascript"></script><a onClick="goValidEscrow('si_sehyuninter');"><img src="<?=G5_URL?>/theme/kidstore2/img/escro.jpg" width="227" border="0" style="cursor:hand" /></a></div><?php */?>



<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
