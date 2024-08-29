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
<section id="new_service" class="mkt">
    <div class="main">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/slide3.png">
    </div>
    <div class="inner">
        <h2>마음에 드는 상품을 소문내요!</h2>
        <h1>친구가 구매할 때마다 적립!</h1>
        <div class="com_info">
            <div>

                <div id="cam_count" class="flex ai-c gap10">
                    <div class="mb flex gap5 ai-c">
                        <p>잡고 마켓</p>
                    </div>
                    <div class="heart male-auto" name="">
                        <button type="button" class="heart off"><img src="https://www.jobgo.ac:443/theme/basic/img/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                    </div>
                </div>
                <header>
                    <h6 class="item_tit">마음에 쏙 드는 상품</h6>
                    <p class="txt_color">잡고와 함께 해요</p>
                    <div class="flex ai-c gap10 end">
                        <strong class="txt_color">40%</strong>
                        <s>29,800원</s>
                    </div>
                    <h5 class="text-right">17,900원</h5>
                </header>
                <div id="cam_info">
                    <p class="flex ai-e jc-sb">
                        <b><i class="fa-solid fa-sparkles"></i> 판매할 때마다! 리워드</b>
                        <span>상품가의 <b class="txt_color price">5%</b></span>
                    </p>
                </div>
                <div class="btn_wrap">
                    <button type="button" class="btn btn_large btn_color" onclick="">판매하기</button>
                </div>
            </div>
        </div>
    </div>
    <div class="process">
        <div class="inner">
            <h6>마켓 판매 진행 절차</h6>
            <ul>
                <li>
                    <p>
                        <span>1</span>
                        <b>마켓 판매 신청</b>
                    </p>
                    <p>상품을 확인하고<br>
                        판매를 신청해요</p>
                </li>
                <li>
                    <p>
                        <span>2</span>
                        <b>판매 선정</b>
                    </p>
                    <p>생성된 판매 링크로<br>
                        주위에 소문내요</p>
                </li>
                <li>
                    <p>
                        <span>3</span>
                        <b>판매 종료</b>
                    </p>
                    <p>판매 관리에서<br>
                        언제든 종료 가능해요</p>
                </li>
                <li>
                    <p>
                        <span>4</span>
                        <b>판매 정산</b>
                    </p>
                    <p>판매리워드에 따라<br>
                        잡고 캐쉬로 정산돼요</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_fixed">
        <a href="<?php echo G5_BBS_URL ?>/market_list.php">마켓 바로가기 <i class="fa-solid fa-right"></i></a>
    </div>
</section>
<?php
include_once(G5_PATH.'/tail.php');
?>