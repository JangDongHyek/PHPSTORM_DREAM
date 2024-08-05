<? 
include_once("./_common.php");

$g5['title'] = '포인트 사용완료';
$pid = "use_point_com";
include_once('./_head.php');

?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
	.btm_nav_box{
		background: transparent;
	}
	#mypage_wrap .con_wrap{
		width: 100%;
	}
</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="qr_ver">
		<div class="con_wrap">
            <ul class="top_con">
                <li class="info">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_myinfo.svg" class="menu_ic">
                    <div class="profile_wrap">
                        <span class="rating vvip">VVIP</span>
                        <!--        <span class="rating vip">VIP</span>-->
                        <h1><span class="user_name"><?=$member["mb_name"]?></span> 님</h1>
                    </div>
                </li>
                <li>
                    <a href="./point_list.php" onclick="alert('준비중입니다.')">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_point_deducted.svg" class="menu_ic">
                        <div class="wrap">
                        <a href="./point_list.php" class="info_tit">사용한 포인트</a>
                        <a href="./point_list.php" class="btn_count"><strong class="color_gold">- 50</strong><span class="em">P</span></a>
                        </div>
                    </a>
				</li>
                <li>
                    <a href="./point_list.php" onclick="alert('준비중입니다.')">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_point.svg" class="menu_ic">
                        <div class="wrap">
                        <a href="./point_list.php" class="info_tit">포인트 잔액</a>
                        <a href="./point_list.php" class="btn_count"><strong class="color_gold">1950</strong><span class="em">P</span></a>
                        </div>
                    </a>
				</li>
            </ul>
        </div>
    </div>
</div>
</div>
<script>

</script>

<?php
include_once('./_tail.php');
?>
