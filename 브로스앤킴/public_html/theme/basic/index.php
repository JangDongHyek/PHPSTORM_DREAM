<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_container">
    <div class="main_sev container">
        <h2><?php echo $config['cf_title']; ?> 서비스소개</h2>
        <p class="add_ex">환경을 개선하고 사람의 치유를 돕는 청소전문 서비스</p>
        <ul class="box_list">
        	<div class="row">
                <li class="col-xs-12 col-md-4">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=clean01">
                        <div class="over col-md-12 col-xs-6">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/sev_img01.jpg" alt="에어컨클리닝">
                        </div>
                        <div class="text col-md-12 col-xs-6">
                            <p>에어컨클리닝 <strong>에어컨 살균세척 작업으로 충분히 제어가능</strong>
                            <div class="btn btn-info btn-xs hidden-xs">바로가기<i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </p>
                            <span>
                            에어컨을 장시간 사용하면 내부오염으로 인해 
                            호흡기질횐 및 인체에 악영향을 미치기 때문에 
                            사용전 반드시 전문가의 철저한 청소가 필요합니다.
                            </span>
                        </div>
	                </a>
                </li>
                <li class="col-xs-12 col-md-4">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=clean02">
                        <div class="over col-md-12 col-xs-6">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/sev_img02.jpg" alt="세탁기클리닝">
                        </div>
                        <div class="text col-md-12 col-xs-6">
                            <p>세탁기클리닝
                            <strong>세탁조 내부의 곰팡이 및 세균을 청소하는 서비스</strong>
                            <div class="btn btn-info btn-xs hidden-xs">바로가기<i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </p>
                            <span>세탁기는 항상 습기가 있기 때문에 청소하지 않고 
                            그대로 방치할 경우 세균이나 곰팡이가 번식할 수 있어 
                            천식과 알레르기 등을 유발할 수 있고 빨래 냄새의 원인이 될 수도 있습니다.</span>
                        </div>
	                </a>
                </li>
                <li class="col-xs-12 col-md-4">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=clean03">
                        <div class="over col-md-12 col-xs-6">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/sev_img03.jpg" alt="홈클리닝">
                        </div>
                        <div class="text col-md-12 col-xs-6">
                            <p>홈클리닝
                            <strong>이사, 입주청소 및 침대청소</strong>
                            <div class="btn btn-info btn-xs hidden-xs">바로가기<i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </p>
                            <span>기존 건물을 새롭게 청소하는 서비스로 신축아파트, 주택, 빌라, 오피스텔등 이사 혹은 입주하기 전의 대청소<br>
                            침대의 곰팡이, 대장균, 보이지 않는 세균처리 청소서비스</span>
                        </div>
	                </a>
                </li>
            </div>
        </ul>
    </div><!--//main_sev-->
    
    <div class="main_bn">
        <ul class="container">
            <?php /*?><li class="com col-sm-4" >
                <h2><?php echo $config['cf_title']; ?> 회사소개</h2>
                <div class="text">저희 에코하이(주)는 생산과 설계 시공으로<br />보강토시공과 조경석 콘크리트옹벽, 패널식옹벽 등을<br />전문적인 신기술로 시공하고 있습니다.</div>
                <a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet01" class="btn btn-info btn-sm">바로가기 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </li><?php */?>
            <li class="cus col-sm-3">
                <h2 class="call">OUR OFFICE</h2>
                <p>문의사항이 있으시면 연락주세요</p>
                <h3><?php echo $config['cf_4']; ?></h3>
                <div class="fax">
                    <i class="fa fa-fax" aria-hidden="true"></i>FAX : <?php echo $config['cf_6']; ?><br>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo $config['cf_7']; ?>
                </div>
            </li>
            <li class="case col-sm-9 hidden-xs">
                <?php echo latest('theme/gallery', 'case', 6, 18); ?>
            </li>
        </ul>
    </div><!-- //main_bn -->

</div><!-- #idx_container -->

<?php
include_once(G5_PATH.'/tail.php');
?>