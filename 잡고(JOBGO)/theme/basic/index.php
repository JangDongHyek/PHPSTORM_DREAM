<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

$search = $_REQUEST['search'];
if ($search == "")  $search = "date";

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/jl/JlConfig.php");

//캠페인 데이터
$model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$limit = 4;
$page = $_GET['page'] ? $_GET['page'] : 1;
$data = $model->get(array("page" => $page,"limit" => $limit));
$total_page = ceil($data['count'] / $limit);

// 캠페인 좋아요
if($member['mb_no']) {
    $campaign_like = new JlModel(array(
        "table" => "campaign_like",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    ));
    $getLike = $campaign_like->where("user_idx",$member['mb_no'])->get()['data'];

    $likes = array();
    foreach ($getLike as $index => $d) {
        array_push($likes,$d['campaign_idx']);
    }
}

// 캠페인 선장자
$request_model = new JlModel(array(
    "table" => "campaign_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

?>
    <div id="idx_wrapper">
        <div id="visual" class="main wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">

            <!-- Swiper -->
            <div class="swiper mainSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide1.png" onclick="location.href='<?php echo G5_BBS_URL ?>/campaign_exp_list.php'"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide4.png" onclick="location.href='<?php echo G5_BBS_URL ?>/campaign_exp_list.php'"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide2.png" onclick="location.href='<?php echo G5_BBS_URL ?>/compete_list.php'"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/common/slide3.png" onclick="location.href='<?php echo G5_BBS_URL ?>/market_list.php'"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <script>
                var swiper = new Swiper(".mainSwiper", {
                    pagination: {
                        el: ".swiper-pagination",
                        type: "fraction",
                    },
                    autoplay: {
                        delay: 25000,
                        disableOnInteraction: false,
                    },
                });
            </script>
        </div><!-- //visual -->
    </div><!--  #idx_wrapper -->

    <!--메인 재능상품 1차 카테고리(아이콘) 영역-->
    <div id="main_item">
        <div class="in cf">
            <?/*div class="item">
                <a href="<?php echo G5_BBS_URL ?>/campaign_list.php?menu=sns">
                    <i class="fa-light fa-camera-polaroid"></i>
                    <h2>SNS 포스팅</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/campaign_list.php?menu=design">
                    <i class="fa-light fa-object-group"></i>
                    <h2>디자인</h2>
                </a>
            </div*/?>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/campaign_list.php">
                    <i class="fa-light fa-calendar-star"></i>
                    <h2>체험단</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인" tooltip="기존 거래는 여기서!">
                    <i class="fa-light fa-icons"></i>
                    <h2>재능거래</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/compete_list.php">
                    <i class="fa-light fa-boombox"></i>
                    <h2>공모전</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/market_list.php">
                    <i class="fa-light fa-store"></i>
                    <h2>마켓</h2>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo G5_BBS_URL ?>/job_list.php">
                    <i class="fa-light fa-address-card"></i>
                    <h2>구인구직</h2>
                </a>
            </div>
        </div><!--in-->
    </div><!--main_item-->
    <div id="banner" class="gray">
        <h6><b class="txt_color2">트렌디한 청년인력을 찾고있나요?</b></h6>
        <h6 class="txt_bold2 txt_color2">잡고가 소개시켜드려요!</h6>
        <h6 class="txt_thin">#체험단 #SNS #디자인</h6>
        <button type="button" class="btn btn_white txt_color2" onclick="location.href='./new_campaign.php'">협업문의 <i class="fa-solid fa-right"></i></button>
    </div>



    <div id="goods">
        <!--  캠페인  -->
        <div class="in section_area">
            <h2 class="title">함께 할 청년 <strong>여기 여기 모여라</strong></h2>
            <div class="list">
                <?php
                foreach($data['data'] as $index => $d) {
                    $heart = "off";
                    if(in_array($d['idx'],$likes,true)) $heart = "on";

                    $request_model->where("campaign_idx",$d['idx']);
                    $select = $request_model->where("status","선정")->get()['count'];
                ?>
                <div class="thm">
                    <div class="mg">
                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php?idx=<?=$d['idx']?>">
                            <div class="mg_in">
                                <div class="over">
                                    <?if(count($d['thumb'])) {?>
                                        <img src="<?=$jl->URL.$d['thumb'][0]['src']?>">
                                    <?}else {?>
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                    <?}?>
                                </div>
                            </div><!--상품사진-->
                        </a>
                    </div><!--mg-->
                    <div class="info">
                        <div class="heart" name="">
                            <button type="button" class="heart <?=$heart?>" onclick="postLike('<?=$d['idx']?>')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_<?=$heart?>.png" alt="좋아요off" title="좋아요off"></button>
                        </div>
                        <div id="lecture_writer_list">
                            <div class="mb flex gap5 ai-c">
                                <div class="count">
                                    <b class="txt_color"><?=$select?></b>/<?=$d['recruitment']?>
                                </div>
                                <p><?=$d['status']?></p>
                            </div>
                        </div>
                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php?idx=<?=$d['idx']?>">
                            <div class="tit"><?=$d['subject']?></div>
                            <div class="txt_color"><?=$d['company_name']?></div>
                        </a>
                    </div>
                </div><!--thm-->

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->

    <div id="banner" class="black">
        <h6><b class="txt_color3">대학생에게 필요한 ○○</b></h6>
        <h6 class="txt_bold2 txt_white">용돈, 알바, 대외활동!</h6>
        <h6 class="txt_thin txt_white">잡고가 함께 해요</h6>
        <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_cpn_service.php'">새로워진 잡고 <i class="fa-solid fa-right"></i></button>
    </div>

    <div id="idx_wrapper" class="mb25">
        <div id="visual">
            <ul class="sliderbx">

                <?php //관리자: 상단배너관리에서 넣은 이미지 불러오기
                echo banner('top'); ?>


            </ul><!--.sliderbx-->
        </div><!-- //visual -->
    </div>

    <div id="goods">
        <!--  재능거래 (구.인기재능)  -->
        <div class="in section_area">
            <h2 class="title">내가 가진 능력으로 <strong>재능거래</strong></h2>
            <div class="list">
                <?php
                //리스트 쿼리(code_use => 카테고리 사용중인것만 데이터 표출)
                $sql = "SELECT ta.*,
                    (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay
                    , (select COUNT(*) idx from new_like li where ta.ta_idx = li.ta_idx) li_cnt
                    ,(select count(*) from new_payment_review pr where ta.ta_idx = pr.ta_idx) as review_count
            FROM {$g5['talent_table']} as ta
            left join new_code as cd2 on cd2.code_idx = ta.ta_category2
            left join new_code as cd3 on cd3.code_idx = ta.ta_category3
            where cd2.code_use = '1' and cd3.code_use = '1' and ta_imsi = 'N' and ta.wr_datetime >= '".date("Y-m-d H:i:s", strtotime(G5_TIME_YMDHIS." -5 months"))."'
            order by li_cnt desc, review_count desc limit 8 ";
                $result = sql_query($sql);


                for ($i = 0;  $row = sql_fetch_array($result); $i++){
                    //ios 스토어업데이트를 위해 추가한 신고..
                    $sql = "select count(*) cnt from new_report where mb_id = '{$member["mb_no"]}' and r_p_idx= '{$row['ta_idx']}' ";
                    $report_cnt = sql_fetch($sql)["cnt"];
                    if ($report_cnt > 0){
                        continue;
                    }

                    include(G5_BBS_PATH."/li_content.php")
                    ?>

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->


    <div id="idx_wrapper">
        <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
            <ul class="sliderbx">

                <?php //관리자: 하단배너관리에서 넣은 이미지 불러오기
                echo banner('btm'); ?>


            </ul><!--.sliderbx-->
        </div><!-- //visual -->
    </div>
<? $jl->jsLoad(); ?>
    <script>
        const jl = new Jl();
        const user_idx = "<?=$member['mb_no']?>";
        async function postLike(idx) {
            try {
                if(!user_idx) return false;
                let obj = {
                    user_idx : user_idx,
                    campaign_idx : idx
                }

                let res = await jl.ajax("insert",obj,"/api/campaign_like.php");
                window.location.reload();
            }catch (e) {
                alert(e)
            }
        }
    </script>


    <!--인기카테고리 추출 스크립트(pc화면용)-->
    <script>
        $('.slide-box').each(function(){
            $(this).slick({
                slidesToShow:5,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
                accessibility: true,
                arrows: true,
                prevArrow: $(this).parents('.slide-wrap').find('.btn-prev'),
                nextArrow: $(this).parents('.slide-wrap').find('.btn-next'),
                speed: 300,
                autoplay: false,
                autoplaySpeed: 1000,
                responsive: [  // 반응형일때 원하는 사이즈에서 보여지는 갯수 조절함
                    {
                        breakpoint: 990,
                        settings: {
                            slidesToShow: 3,
                        }
                    }
                ]

            })
        })

        //bx메인슬라이더시작
        $(document).ready(function(){
            $('.sliderbx').bxSlider({
                responsive : true,            // 반응형
                mode : 'fade',           // 'horizontal', 'vertical', 'fade'
                pager : false,                 // 페이지버튼 사용유무
                Controls : false,              // 좌우버튼 사용유무
                auto : true,                  // 자동재생
                pause : 5000,                  // 자동재생간격
                speed : 1000,                  // 이미지전환속도
                autoControls : false,          // 재생버튼 사용
                autoHover: true,
                autoControlsCombine : true,   // 플레이, 스탑버튼 교차
            });
        });


        function open_tab(f,type) {
            // 새탭으로 띄우기 = 1
            var link = $('#'+f.id).data('link');

            if (type == 1){
                window.open(link);
            }else{
                window.location = link
            }
        }
    </script>

<script>

    $(document).ready(function () {
        ing_competition('date');
    });

    function ing_competition(search) {
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "ing_competition",
                "search": search

            },
            dataType: "html",
            success: function(data) {
                $('[name = "a_ing"]').removeClass("current");
                $("#"+search+'_a').addClass("current");
                $('#ing_div').html(data);

            }
        });
    }
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>