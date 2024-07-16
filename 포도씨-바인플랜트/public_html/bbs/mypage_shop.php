<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '자료실';
include_once('./_head.php');

/** 마이페이지 - 자료실 **/

// 검색 (검색어 입력) 내용/제목/태그
if(!empty(trim($search))) {
    $sql_search .= " and (rr_subject like '%{$search}%' or strip_tags(rr_contents) like '%{$search}%' or rr_hashtag like '%{$search}%' or FIND_IN_SET('{$search}', rr_hashtag)) ";
}

// 다운로드 수
$buy_count = sql_fetch(" select count(distinct reference_idx) as count from g5_reference_room_download as a where 1=1 and a.mb_id = '{$member['mb_id']}' {$sql_search} ")['count'];
// 판매수
$sale_count = sql_fetch(" select count(distinct reference_idx) as count from g5_reference_room_sale where sale_mb_id = '{$member['mb_id']}' ")['count'];
// 찜한 자료 수
$like_count = sql_fetch(" select count(*) as count from g5_like_reference as a inner join g5_reference_room as b on a.reference_idx = b.idx where a.mb_id = '{$member['mb_id']}' {$sql_search} ")['count'];
?>

<? if ($name == "mypage") { ?>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="mypage">
<? } ?>

<link rel="stylesheet" href="<?= G5_URL ?>/css/style.css?v=<?= G5_CSS_VER ?>">

<!-- 리뷰 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade review" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close""><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">리뷰 작성</h4>
                </div>
                <div class="modal-body">
                    <!--ajax.mypage_shop_review.php-->
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 리뷰 모달팝업 -->

<div id="area_mypage" class="shop">
    <div class="inr v3">

        <?php include_once('./mypage_info.php'); ?>

        <div id="mypage_wrap">
            <div class="mypage_cont">
                <div class="box">
                    <h3>자료실</h3>
                    <div class="box_cont">
                        <input type="hidden" id="page" name="page" value="1">
                        <input type="hidden" id="mode" name="mode" value="b">
                        <ul class="tabs">
                            <li class="active" rel="tab1"><span>다운로드한 자료</span><em><?=number_format($buy_count)?></em></li>
                            <li rel="tab2"><span>판매한 자료</span><em><?=number_format($sale_count)?></em></li>
                            <li rel="tab3"><span>내가 찜한 자료</span><em id="likeCount"><?=number_format($like_count)?></em></li>
                        </ul>
                        <div class="tab_container">
                            <div class="top_filter">
                                <div class="box_left">
                                    <input type="checkbox" id="pay" name="is_free" value="N"><label for="pay" class="chk">유료</label>
                                    <input type="checkbox" id="free" name="is_free" value="Y"><label for="free" class="chk">무료</label>
                                </div>
                                <div class="box_sch">
                                    <form name="fsearchbox">
                                        <input type="text" placeholder="검색하기" id="search" name="search" value="<?=$search?>">
                                        <button type="submit"></button>
                                    </form>
                                </div>
                            </div>
                            <div id="tab1" class="tab_content">
                                <div class="box_cont">
                                    <!--구매한자료-->
                                    <ul class="list shop_b">
                                        <!--ajax.mypage_shop.php-->
                                        <!--<li>
                                            <div class="img_wrap">
                                                <img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/UEMsg1597124500.jpg">
                                                <p class="wish"><i class="fal fa-heart"></i></p>
                                                <p class="coin">유료</p>
                                            </div>
                                            <div class="text">
                                                <p class="cate">대분류 > 소분류</p>
                                                <h4 class="title">전문가 추천! 화장품 제조업체 리스트</h4>
                                                <div class="exp">국내 1위 레이저기기 제조사를 거쳐 존슨앤드존슨, 글로벌 화장품 기업에서 RA Specialist 로 근무한 슐리 입니다. </div>
                                                <div class="price"><strong>13,000</strong>원</div>
                                            </div>
                                            <div class="btn_wrap">
                                                <p class="date">구매일 2022-06-07</p>
                                                <button class="btn_chat"><i class="fal fa-comments-alt"></i>  판매자와 1:1채팅하기</button>
                                                <button class="btn_down"><i class="fal fa-arrow-to-bottom"></i> 파일 다운로드</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img_wrap">
                                                <img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/1dFub1622550487.jpg">
                                                <p class="wish"><i class="fal fa-heart"></i></p>
                                                <p class="coin">유료</p>
                                            </div>
                                            <div class="text">
                                                <p class="cate">대분류 > 소분류</p>
                                                <h4 class="title">한달 걸릴 선행논문조사, 하루 만에 완벽히 해결해 드립니다.</h4>
                                                <div class="exp">국내 1위 레이저기기 제조사를 거쳐 존슨앤드존슨, 글로벌 화장품 기업에서 RA Specialist 로 근무한 슐리 입니다. </div>
                                                <div class="price"><strong>199,000</strong>원</div>
                                            </div>
                                            <div class="btn_wrap">
                                                <p class="date">구매일 2022-06-07</p>
                                                <button class="btn_chat"><i class="fal fa-comments-alt"></i>  판매자와 1:1채팅하기</button>
                                                <button class="btn_down"><i class="fal fa-arrow-to-bottom"></i> 파일 다운로드</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img_wrap">
                                                <img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/pFuwY1607853350.jpg">
                                                <p class="wish"><i class="fal fa-heart"></i></p>
                                            </div>
                                            <div class="text">
                                                <p class="cate">대분류 > 소분류</p>
                                                <h4 class="title">매출이 일어날 수 있는'진짜'마케팅을 알려 드립니다.</h4>
                                                <div class="exp">국내 1위 레이저기기 제조사를 거쳐 존슨앤드존슨, 글로벌 화장품 기업에서 RA Specialist 로 근무한 슐리 입니다. </div>
                                                <div class="price">무료</div>
                                            </div>
                                            <div class="btn_wrap">
                                                <p class="date">구매일 2022-06-07</p>
                                                <button class="btn_chat"><i class="fal fa-comments-alt"></i>  판매자와 1:1채팅하기</button>
                                                <button class="btn_down"><i class="fal fa-arrow-to-bottom"></i> 파일 다운로드</button>
                                            </div>
                                        </li>-->
                                    </ul>
                                </div>
                            </div>
                            <div id="tab2" class="tab_content" style="display: none;">
                                <!--<div class="sales_price">
                                    <p>총 판매대금 <strong>250,0000</strong>원</p>
                                </div>-->
                                <div class="box_cont">
                                    <!--판매한자료-->
                                    <ul class="list shop_s">
                                        <!--ajax.mypage_shop.php-->
                                    </ul>
                                </div>
                            </div>
                            <div id="tab3" class="tab_content" style="display: none;">
                                <div class="box_cont">
                                    <!--찜한자료-->
                                    <ul class="list shop_l">
                                        <!--ajax.mypage_shop.php-->
                                    </ul>
                                </div>
                            </div>

                            <div id="paging"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('./mypage_menu.php'); ?>
        </div>
    </div>
</div>

<?
include_once('./_tail.php');
?>

<script>
    var star_score = 0;
    var is_free = '';
    $(document).ready(function () {
        referenceList(); // 리스트

        $(".tab_content").hide();
        $(".tab_content:first").show();

        $("ul.tabs li").click(function () {
            if (!($(this).find('a').length > 0)) {
                $("ul.tabs li").removeClass("active");
                $(this).addClass("active");
                $(".tab_content").hide()
                var activeTab = $(this).attr("rel");
                $("#" + activeTab).fadeIn()

                if(activeTab == 'tab1') {
                    $('#mode').val('b');
                } else if(activeTab == 'tab2') {
                    $('#mode').val('s');
                } else if(activeTab == 'tab3') {
                    $('#mode').val('l');
                }

                referenceList(); // 리스트
            }
        });

        // 찜한 자료만 보기
        $("[name=like]").click(function() {
           if(this.checked) {
               referenceList(1, 'like');
           } else {
               referenceList(1);
           }
        });

        // 유료/무료 필터
        $("[name=is_free]").click(function() {
            is_free = '';
            $("[name=is_free]").each(function() {
                if(this.checked) {
                    is_free += this.value+",";
                }
            });
            is_free = is_free.slice(0, -1);
            referenceList(1, '', is_free);
        });
    });

    function referenceList(page, like, filter) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.mypage_shop_list.php",
            data: {page : $('#page').val(), mode : $('#mode').val(), search: $("#search").val(), like: like, filter: filter},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.shop_'+$('#mode').val()).html(data);

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function get_page(page) {
        referenceList(page, '', is_free);
    }

    // 리뷰 작성 모달
    function reviewModal(reference_idx) {
        $.ajax({
            url: "./ajax.mypage_shop_review.php",
            type: "post",
            data: {reference_idx: reference_idx},
            dataType: "html",
            async: false,
            success: function(data) {
                $("#reviewModal .modal-body").html(data);

                $("#reviewModal").modal("show");

                // 리뷰-별점 선택
                $( ".star_rating a" ).click(function() {
                    $(this).parent().children("a").removeClass("on");
                    $(this).addClass("on").prevAll("a").addClass("on");
                    var score = $(this).attr('name').split('_');
                    star_score = score[1];
                    return false;
                });
            },
        });
    }

    // 리뷰 작성
    function reviewRegister(reference_idx, mode) {
        $.ajax({
            url: "./ajax.review_action.php",
            type: "post",
            data: {reference_idx: reference_idx, mode: mode, star_score: star_score, review: $("#review").val()},
            async: false,
            success: function(data) {
                if(data == 'success') {
                    swal("리뷰 작성이 완료되었습니다.")
                    .then(()=>{
                        $("#reviewModal").modal("hide");
                        referenceList(1);
                    });
                }
            },
        });
    }

    // 다운로드 기록
    function downloadHistory(reference_idx) {
        $.ajax({
            url: "./ajax.reference_action.php",
            type: "post",
            data: {idx: reference_idx, mode: "view"},
            async: false,
            success: function (data) {
            },
        });
    }

    // 내가 찜한 자료 수
    function likeCount() {
        $.ajax({
            url: "./ajax.like_reference.php",
            type: "post",
            data: {mode: "count"},
            async: false,
            success: function (data) {
                console.log("data: "+data);
                if(data) {
                    $("#likeCount").text(data);
                }
            },
        });
    }
</script>

<?php
include_once('./fchatting.php');
include_once(G5_BBS_PATH.'/ajax_get_page.php');
?>
