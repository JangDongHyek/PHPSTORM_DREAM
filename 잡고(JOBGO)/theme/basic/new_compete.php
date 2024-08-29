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
<section id="new_service" class="cpt">
    <div class="main">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/slide2.png">
    </div>
    <div class="inner">
        <h2>자신있는 공모전에 마음껏 도전해요</h2>
        <h1>공모전 우승시 상금 혜택</h1>
        <div class="com_info">
            <div>
            <div id="cam_count" class="flex ai-c gap10">
                <div class="mb flex gap5 ai-c">
                    <div class="count">
                        <b class="">접수중</b>
                    </div>
                    <p>공모전 · 조회수 10,000</p>
                </div>
                <div class="heart male-auto" name="">
                    <button type="button" class="heart off"><img src="https://www.jobgo.ac:443/theme/basic/img/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                </div>
            </div>
            <header>
                <h6 class="item_tit">잡고 회원만을 위한 특별 공모전!</h6>
                <p class="txt_color">잡고와 함께해요</p>
            </header>
            <div id="cam_info" class="flex ai-c gap10">
                <span>
                    <p class="flex ai-c jc-sb">
                        <span>접수기간</span>
                        <span>202N.09.01까지</span>
                    </p>
                    <p class="flex ai-c jc-sb">
                        <span>심사기간</span>
                        <span>202N.10.01까지</span>
                    </p>
                </span>
                <span>
                    <p class="txt_mini text-right">
                        <span class="txt_mini">N명의 참가자</span>
                    </p>
                    <p class="text-right">
                        <span class="txt_mini">1등 * 1명</span>
                        총상금 <b class="txt_color price">500,000원</b>
                    </p>
                </span>
            </div>
            <button type="button" class="btn btn_large btn_color" data-toggle="modal" href="#competeSubmit">참여하기 </button>
            </div>
        </div>
    </div>
    <div class="process">
        <div class="inner">
            <h6>공모전 진행 절차</h6>
            <ul>
                <li>
                    <p>
                        <span>1</span>
                        <b>공모전 탐색</b>
                    </p>
                    <p>공모전을 확인하고<br>
                        찜하기로 탐색해요</p>
                </li>
                <li>
                    <p>
                        <span>2</span>
                        <b>공모전 선정</b>
                    </p>
                    <p>모집 기간 내<br>
                        공모전에 마음껏 도전해요</p>
                </li>
                <li>
                    <p>
                        <span>3</span>
                        <b>공모전 선정</b>
                    </p>
                    <p>모집 기간 종료 후<br>
                        공모전 선정 내역을 확인해요</p>
                </li>
                <li>
                    <p>
                        <span>4</span>
                        <b>상금 전달</b>
                    </p>
                    <p>공모전 선정 시<br>
                        잡고 캐쉬로 상금이 전달돼요</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_fixed">
        <a href="<?php echo G5_BBS_URL ?>/compete_list.php">공모전 바로가기 <i class="fa-solid fa-right"></i></a>
    </div>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>