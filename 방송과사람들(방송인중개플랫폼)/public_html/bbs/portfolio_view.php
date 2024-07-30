<?
include_once('./_common.php');
$g5['title'] = '포트폴리오 상세';
include_once('./_head.php');
$name = "portfolio";
$pid = "portfolio";

?>

        <style>
            @media screen and (max-width:1024px) {
                #nav_area{display: none;}
            }
        </style>

<div id="portfolio_view" class="view">
    <div class="inr">

        <div class="item_right">
            <div class="item_hd">
                <div class="title">김방송 님의 포트폴리오</div>
                <div class="btn_wrap">
                    <!--신고하기버튼--><a class="btn_share"><i class="fa-regular fa-siren"></i></a>
                    <!--공유하기버튼--><a class="btn_share"><i class="fa-regular fa-share-nodes"></i></a>
                </div>
            </div>
            <div class="item_info">
                <div class="profile_box">
                    <div class="profile"><?php
                        $icon_file = G5_DATA_PATH.'/file/member/'.$mb['mb_no'].'.jpg';
                        if (file_exists($icon_file)) {
                            $icon_url = G5_URL.'/data/file/member/'.$mb['mb_no'].'.jpg';
                            echo '<img src="'.$icon_url.'" alt="">';
                        }else{
                            echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                        }
                        ?></div>
                    <div class="profile_info">
                        <h3 onclick="location.href='<?=G5_URL?>/bbs/profile.php?mb_no=<?=$mb['mb_no']?>'">김방송<?=$mb['mb_nick']?></h3>

                        <?
                        $j = 0;
                        for($i=1; $i<7; $i++) {

                            if($mb['file'.$i] != "") $j++;

                            ?>


                        <?}?>

                        <div id="heartIcon"><i class="fa-light fa-heart"></i> 27</div>
                    </div>
                </div>
                <br>
                <i class="cate">배우·연기</i> <i class="cate">모델</i><!--전문분야-->
                <h2>000광고 화보 촬영</h2>
                <div id="area_btn">
                    <a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="box_btn">문의하기</a>
                    <!-- 찜하기 눌렀을 때 class="on"추가 -->
                    <div class="icon_jjim  <?php if ($like_cnt > 0) echo "on" ?>" onClick="heart_click(<?=$view['i_idx']?>,this)"></div>
                </div>
            </div>
        </div>
        <div class="item_left">
            <div class="area_tab">
                <div class="tab_cont">
                    <section id="portfolio_info">
                        <div class="area_img">
                            <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMzAzMDJfMjk4%2FMDAxNjc3NzM2NTc5NjM5.MXHvi0u50zx1O_MFWoPUzQqI_FIhlVdSF_d3vUteP8Ig.4Y3WHnB8e280hg2qBTjRJ6W0ncE2Dm2E0c0M34f6Qmcg.JPEG.estudio_klang%2F001.jpg&type=sc960_832">
                        </div>
                        <br>
                        <h3>포트폴리오 설명</h3>
                        <div class="conts">2020년도 10월에 촬영한 000광고입니다.</div>
                    </section>
                </div>
                <div class="area_ft_list">
                    <div>
                        <h3>김방송님의 다른 포트폴리오</h3>
                        <div class="swiper ftSwiper">
                            <ul id="product_list" class="swiper-wrapper">
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h3>김방송님의 전문가 서비스</h3>
                        <div class="swiper ftSwiper">
                            <ul id="product_list" class="swiper-wrapper">
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<form style="display: none" method="post" action="./order.php" id="orderfrm">
    <input type="hidden" name="i_idx" value="<?=$idx?>">
</form>
<!--채팅-->
<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="inquiry_idx" id="inquiry_idx" value="<?=$idx?>">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>


<script>
    //찜하트 클릭
    document.getElementById('heartIcon').addEventListener('click', function() {
        var icon = this.querySelector('i');
        if (icon.classList.contains('fa-light')) {
            icon.classList.remove('fa-light');
            icon.classList.add('fa-solid');
        } else {
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-light');
        }
    });

    //포트폴리오
    var swiper = new Swiper(".ftSwiper", {
        slidesPerView: 2.5,
        spaceBetween: 10,
        grabCursor: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            // 화면 너비가 1200px 이상일 때
            1200: {
                slidesPerView: 3.5,
                spaceBetween: 20
            },
            // 화면 너비가 992px 이상일 때
            950: {
                slidesPerView: 3.5,
                spaceBetween: 20
            },
            // 화면 너비가 768px 이상일 때
            768: {
                slidesPerView: 1.5,
                spaceBetween: 15
            },
        }
    });
</script>

<?
include_once('./_tail.php');
?>

