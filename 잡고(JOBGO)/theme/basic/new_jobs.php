<?php
global $pid;
$pid = "new_service";
$sub_id = "new_service";
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

?>
<style>
    @media (max-width: 767px){
        #hd {
            display: none;
        }
    }
</style>
<section id="new_service" class="job">
    <div class="main">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/slide6.png">
    </div>
    <div class="inner">
        <h2>잡고 회원을 위한</h2>
        <h1>다양한 채용의 장!</h1>
        <div class="com_info">
            <div class="list">

                <div class="thm">
                    <div class="info">
                        <div class="flex ai-c jc-sb">
                            <h6>업체명 | ~09/30</h6>
                            <div class="heart" name="">
                                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                            </div>
                        </div>
                        <div class="tit">공고제목</div>
                        <p class="flex ai-c">시 구 ·&nbsp;<b class="txt_color"> 월 0원</b>
                            <b class="male-auto">+</b>
                        </p>
                    </div>
                </div>
                <div class="thm" style="opacity: 0.5">
                    <div class="info">
                        <div class="flex ai-c jc-sb">
                            <h6>업체명 | ~09/30</h6>
                            <div class="heart" name="">
                                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                            </div>
                        </div>
                        <div class="tit">공고제목</div>
                        <p class="flex ai-c">시 구 ·&nbsp;<b class="txt_color"> 월 0원</b>
                            <b class="male-auto">+</b>
                        </p>
                    </div>
                </div>
                <div class="thm" style="opacity: 0.2">
                    <div class="info">
                        <div class="flex ai-c jc-sb">
                            <h6>업체명 | ~09/30</h6>
                            <div class="heart" name="">
                                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                            </div>
                        </div>
                        <div class="tit">공고제목</div>
                        <p class="flex ai-c">시 구 ·&nbsp;<b class="txt_color"> 월 0원</b>
                            <b class="male-auto">+</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="process">
        <div class="inner">
            <h6>구인구직 진행 절차</h6>
            <ul>
                <li>
                    <p>
                        <span>1</span>
                        <b>공고 목록</b>
                    </p>
                    <p>공고 목록을 확인하고<br>
                        찜하기로 탐색해요</p>
                </li>
                <li>
                    <p>
                        <span>2</span>
                        <b>공고 상세</b>
                    </p>
                    <p>마음에 드는 공고<br>
                        눌러 상세 정보를 확인해요</p>
                </li>
                <li>
                    <p>
                        <span>3</span>
                        <b>공고 지원</b>
                    </p>
                    <p>접수 기간 내<br>
                        언제든지 지원 가능해요</p>
                </li>
                <li>
                    <p>
                        <span>4</span>
                        <b>마이페이지</b>
                    </p>
                    <p>마이페이지 - 구인구직 관리에서<br>
                        지원 현황을 확인해요</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_fixed">
        <a href="<?php echo G5_BBS_URL ?>/job_list.php">구인구직 바로가기 <i class="fa-solid fa-right"></i></a>
    </div>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>