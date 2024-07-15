<?
include_once('./_common.php');

$g5['title'] = '자료실';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<style>
    #wrapper{background:#fff;}
    #container{padding:0 0 140px;}
</style>

<div id="area_shop">
    <!--상단배너-->
    <div class="area_top">
        <div class="inr v3">
            <div class="bn_list">
                <div class="txt">
                    <h3>
                    <strong>바다에서 필요했던 모든 자료와<br class="br"> 정보들을 공유해보세요!</strong>
                    <p>정보가 곧 자산인 시대!<br class="br"> 나만의 정보를 통해 수익을 얻어보세요!</p>
                    </h3>
                    <a href="shop_write.php" class="btn_inquiry">나만의 정보 등록하기</a>
                </div>
                <div class="obj"><img src="<?php echo G5_IMG_URL ?>/shop_bn.png"></div>
                <div class="obj2"><img src="<?php echo G5_IMG_URL ?>/shop_bn2.png"></div>
            </div>
            <div class="search">
                <strong>자료검색창</strong> <input type="search" id="search" name="search" placeholder="검색어를 입력하세요" onkeyup="dataSearch()"><button onkeyup="dataSearch()"><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>
    <!--//상단배너-->

    <div class="area_bottom">
        <input type="hidden" id="page" name="page" value="1">
        <div class="inr v3">
            <div class="area_cate">
                <div class="inr v3">
                    <ul class="tabs">
                        <li rel="p1"><a id="t1" class="default bold"><i class="fal fa-ship"></i><p id="p1">인기자료</p></a></li>
                        <li rel="p2"><a id="t2"><i class="fal fa-scroll"></i><p id="p2">양식/서식</p></a></li>
                        <li rel="p3"><a id="t3"><i class="fal fa-building"></i><p id="p3">비즈니스(산업)</p></a></li>
                        <li rel="p4"><a id="t4"><i class="fal fa-window-restore"></i><p id="p4">보고서/회의</p></a></li>
                        <li rel="p5"><a id="t5"><i class="fal fa-edit"></i><p id="p5">노하우</p></a></li>
                        <li rel="p6"><a id="t6"><i class="fal fa-file-exclamation"></i><p id="p6">리포트/논문</p></a></li>
                        <li rel="p7"><a id="t7"><i class="fal fa-briefcase"></i><p id="p7">기타</p></a></li>

                        <!--<li id="over1"><a id="t1" class="default"><i class="fal fa-ship"></i><p>인기자료</p></a></li>
                        <li id="over2"><a id="t2"><i class="fal fa-scroll"></i><p>좋은자료</p></a></li>
                        <li id="over3"><a id="t3"><i class="fal fa-building"></i><p>사업계획서</p></a></li>
                        <li id="over4"><a id="t4"><i class="fal fa-window-restore"></i><p>제안서</p></a></li>
                        <li id="over5"><a id="t5"><i class="fal fa-edit"></i><p>계약서</p></a></li>
                        <li id="over6"><a id="t6"><i class="fal fa-file-exclamation"></i><p>규정</p></a></li>
                        <li id="over7"><a id="t7"><i class="fal fa-briefcase"></i><p>비지니스</p></a></li>
                        <li id="over8"><a id="t8"><i class="fal fa-user-tie"></i><p>자기소개서</p></a></li>-->
                    </ul>
                </div>
            </div>
            <h3>추천 자료리스트</h3>
            <div class="top_filter">
                <div class="box_left">
                    <!--<span class="view"><a href="<?/*=$_SERVER['SCRIPT_NAME']*/?>">전체</a> <span class="blue"></span>건</span>-->
                    <input type="checkbox" id="free" name="free" onclick="freeView()"><label for="free"><span></span><em>무료 자료만 보기</em></label>
                    <ul class="sort_list" style="float:right">
                        <li class="selected"><span>최신순</span></li>
                        <li><span>별점 높은순</span></li>
                    </ul>
                </div>
            </div>
            <ul class="shop_list">
                <div>
                    <ul class="list dataList">
                        <!--ajax.reference_list.php-->
                        <!--<li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg"></p>
                                <p class="wish on"><i class="fal fa-heart"></i></p>
                                <p class="coin">유료</p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li><li>#실무서</li><li>#기획</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price"><strong>13,000</strong>원</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/9cyLA1638845259.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price">무료</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/tSglB1647239554.png"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                                <p class="coin">유료</p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price"><strong>13,000</strong>원</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/9cyLA1638845259.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price">무료</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/yoV3u1647857755.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price">무료</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/OHgJ71626246194.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price"><strong>13,000</strong>원</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/w3qHe1596459002.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price"><strong>13,000</strong>원</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/wFALq1648643889.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price"><strong>13,000</strong>원</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>
                        <li>
                            <div class="img">
                                <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/Rw50y1660809646.jpg"></p>
                                <p class="wish"><i class="fal fa-heart"></i></p>
                                <p class="coin">유료</p>
                            </div>
                            <div class="text">
                                <ul class="tag"><li>#소비심리학</li></ul>
                                <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                                <p class="gray">구매 43개</p>
                                <p class="price"><strong>13,000</strong>원</p>
                            </div>
                            <div class="review">
                                <strong><i class="fas fa-star"></i>5.0</strong>
                                이제 4강정도 듣고 있는데 엄청 기대됩니다.
                            </div>
                        </li>-->
                    </ul>
                </div>
            </ul>

            <div id="paging"></div>
        </div>
    </div>
</div>

<form name="fsearch" id="fsearch">
    <input type="hidden" id="orderby" name="orderby">
    <input type="hidden" id="is_free" name="is_free">
</form>

<!--카테고리(탭메뉴자동진행)-->
<script>
    var tab = "";
    $(function() {
       referenceList();

        $("ul.tabs li").click(function () {
            if($(this).find('a').length > 0){
                $("ul.tabs li a").removeClass("bold");
                $(this).find('a').addClass("bold");
                var activeTab = $(this).attr("rel");
                tab = $("#" + activeTab).text();

                referenceList(1);
            }
        });

        // 정렬
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');
        });
    });

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        referenceList(); // 리스트
    }

    // 자료실 목록
    function referenceList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $('.dataList').html("");
        if(tab == "인기자료") tab = "";
        $.ajax({
            url : g5_bbs_url + "/ajax.reference_list.php",
            data: {orderby: $("#orderby").val(), search: $("#search").val(), is_free: $("#is_free").val(), tab: tab, page: $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.dataList').html(data);

                    var search = $.trim($('#search').val());
                    // 검색어 있을 시 하이라이트
                    $('.dataList .text').highlight(search);

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
        referenceList(page);
    }

    // 무료 자료만 보기
    function freeView() {
        $("#is_free").val("N");
        if($("#free").is(":checked")) {
            $("#is_free").val("Y");
        }

        referenceList(1);
    }

    // 태그 검색
    function tag_search(tag) {
        // 검색폼에 데이터 입력
        $('#search').val(tag);
        referenceList(1);
    }

    // 자료검색창
    function dataSearch() {
        if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            if($.trim($('#search').val()) == '') {
                swal('검색어를 입력해 주세요.');
                return false;
            }
        }
        referenceList();
    }
</script>

<?
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>

