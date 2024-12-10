<?php
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');
include_once(G5_THEME_PATH.'/head.php');
?>
<div id="driver_wrap">
    <div id="dv_mb">
		<?php if ($is_member) {  ?>
        <!--로그인후 -->
    	<div class="mb">
            <div class="photo">
            	<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/mb_noimg.png" class="noimg">
            </div>
            <div class="info">
            	<p>포원이 <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fas fa-cog"></i><!--마이페이지 --></a></p>
                <!-- 자기사 -->
                <span class="s1">자기사</span> <span class="s2">패널티 : 없음</span>
                <!--// 자기사 -->
                <!-- 보험미확인기사
                <span class="s2">보험 미확인 기사</span>
                <!--// 보험미확인기사 -->
            </div>
        </div>
        <div class="point">
        	<dl>
        	<dt>마일리지 충전금</dt>
            <dd>123,456 P</dd>
            </dl>
            <a>충전식 가장 계좌 관리 <i class="fas fa-angle-right"></i></a>
        </div>
        <!--//로그인후 -->
        <?php } else {  ?>
        <!--로그인전 -->
            <div class="join_bn">
                <p>T대리가 처음이세요?</p>
                <span>지금 대리기사 등록하시고 혜택 받아가세요!</span>
                <a href="<?php echo G5_BBS_URL ?>/register.php">T대리기사 등록 바로가기</a>
            </div>
		<!--//로그인전 -->
        <?php }  ?>
    </div>
    <div id="idx_bbs">
        <?php echo latest('theme/basic', 'notice', 1, 20); ?>
    </div>
    <div id="req_list">
    	<ul>
        	<li>
            	<div class="info" onClick="window.location=''">
                	<div class="d1">
                    	<p>출발지까지 500m</p>
                    	<p><span>요청출발지</span> <strong>해운대 재송동</strong></p>
                    	<p><span>요청도착지</span> <strong>북구 만덕동</strong></p>
                    </div>
                    <div class="d2"><span>10km</span><span>35,000P</span></div>
                </div>
                <div class="state">
                	<button class="off">
                	대기중
                    </button>
                </div>
            </li>
        	<li>
            	<div class="info" onClick="window.location=''">
                	<div class="d1">
                    	<p>출발지까지 500m</p>
                    	<p><span>요청출발지</span> <strong>해운대 재송동</strong></p>
                    	<p><span>요청도착지</span> <strong>북구 만덕동</strong></p>
                    </div>
                    <div class="d2"><span>10km</span><span>35,000P</span></div>
                </div>
                <div class="state">
                	<button class="on">
                	요청수락
                    </button>
                </div>
            </li>
        </ul>
    </div>
    

</div><!--//driver_wrap -->
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>