<?
include_once('./_common.php');

$g5['title'] = 'Search for Company';
include_once('./_head.php');

//loginCheck($member['mb_id'], $member['mb_category']);

$sql = " select * from g5_member where mb_category = '기업' ";
$result = sql_query($sql);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    .highlight {color: #ff0052 !important; font-weight: 600;}
</style>

<?php include_once('./category_company01_modal.php'); ?>

<!-- 프로필 업데이트 모달팝업 -->
<div id="basic_modal">
    <div class="modal fade" id="profileChkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">프로필 업데이트</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <div class="area_box">
                            <h3 style="font-size: 18px;margin-bottom: 10px;">After completing the profile update<br/>
                                You can check it right away!<br/>
                                Could you please give me a minute?
                            </h3>
                            <a href="<?=$profile_url?>">Profile update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //프로필 업데이트 모달팝업 -->

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="sort_list_mobile">
						<li class="active">By review</li>
						<li>By Rating</li>
						<li>By Transaction</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul>
						<li><a href="<?php echo G5_BBS_URL ?>/company_write.php">Corporate RFQ</a></li>
						<li><a href=""  data-toggle="modal" data-target="#podoCS">Podosea Direct RFQ!</a></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

<!-- 마케팅 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="podoCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Marketing products</h4>
                </div>
                <div class="modal-body">
					<div class="txt">
						<h3>"Marketing product in preparation" </h3>
						<span>For banner advertisements, please contact the PODOSEA manager.</span>
						<a href="mailto:support@podosea.com">support@podosea.com</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 마케팅 모달팝업 -->


<!-- 일반회원 기업회원가입 모달팝업 -->
<div id="basic_modal">
    <div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Register as a corporate member</h4>
                </div>
                <div class="modal-body">
					<div class="txt">
						<div class="area_box">
							<h3>Only corporate members can use it.</h3>
							<a href="<?php echo G5_BBS_URL ?>/register_company_form.php">Register as a corporate member</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //일반회원 기업회원가입 모달팝업 -->


<div id="area_help" class="company c_sch">
	<div class="inr">
	<div id="top_txt">
		<h2>Search for Company</h2>
		<span>Search for a company you want to request for a quotation!</span>
	</div>
	<div class="swiper-container mySwiper" >
		<div class="swiper-wrapper ad_list">
            <div class="swiper-slide"><a href="<?=G5_BBS_URL?>/company.php?mb_no=143"><img src="<?php echo G5_IMG_URL ?>/banner/chungmoo.jpg"></a></div>
            <div class="swiper-slide" data-toggle="modal" data-target="#podoCS"><a href="" ><img src="<?php echo G5_IMG_URL ?>/img_ad01.png"></a></div>
			<div class="swiper-slide" data-toggle="modal" data-target="#podoCS"><a href="" ><img src="<?php echo G5_IMG_URL ?>/img_ad02.png"></a></div>
			<!--<div class="swiper-slide basic" data-toggle="modal" data-target="#podoCS">
				<div class="area_txt">
					<div class="img"><img src="<?php /*echo G5_IMG_URL */?>/icon_boat.svg"></div>
					<h3>PODOSEA</h3>
					<span>Advertisements Wanted.</span>
				</div>
			</div>-->
		</div>
	</div>
	<div id="help_warp">
		<?php include_once('./left_menu_csearch.php'); ?>
		<div id="help_list">
            <input type="hidden" id="orderby" name="orderby" value="<?=empty($orderby)?'By Review':$orderby?>">
            <input type="hidden" id="filter1" name="filter1" value="<?=$filter1?>">
            <input type="hidden" id="filter2" name="filter2" value="<?=$filter2?>">
            <input type="hidden" id="page" name="page" value="1">
			<div class="top_filter">
				<ul class="sort_list">
					<li class="selected"><span>By Review</span></li>
					<li><span>By Rating</span></li>
					<li><span>By Transaction</span></li>
				</ul>
				<div class="msort_list">
					<span data-toggle="modal" data-target="#listModal">By Review</span>
				</div>
			</div>
			<div class="tab_container">
				<div id="tab1" class="tab_content">
					<ul class="list" style="margin-bottom: 15px;">
						<!-- 리스트 10 -->
						<li class="first">
                            <div class="cont">
                                <h2>Consult and request your upcoming <br>project to Podosea experts!</h2>

								<!-- 기업회원일때 -->
                                <a class="btn_inquiry" href="javascript:memberCheck('<?=$member['mb_category']?>');">RFQ Now!</a>

								<!-- 일반회원일때 -->
                                <!--<a class="btn_inquiry" href="" data-toggle="modal" data-target="#joinModal">지금 문의하기!</a>-->

                                <div class="obj"><img src="<?php echo G5_IMG_URL ?>/sch_obj.svg"></div>
                            </div>
						</li>
					</ul>
                    <!--ajax.company_search_list.php-->
                    <ul class="list company_search_list"></ul>
				</div>

                <div id="paging"></div>
			</div>
		</div>
		<?php include_once('./ad_list.php'); ?>
	</div>
</div>

</div>

<script>
var swiper = new Swiper(".mySwiper", {
	loop:false,
	slidesPerView: 1,
	spaceBetween: 0,
	autoplay: {
	delay: 3500,
	disableOnInteraction: false,
	},
	breakpoints: {
		1100: {
		  slidesPerView: 3,
		  spaceBetween: 12,
		},
		768: {
		  slidesPerView: 2,
		  spaceBetween: 12,
		},
		650: {
		  slidesPerView: 2,
		  spaceBetween: 12,
		},
		550: {
		  slidesPerView: 1,
		  spaceBetween: 0,
		},
	}
});

$(function() {
    company_search_list();
});

// 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
function click_event(object, element, class_name, column) {
    $('.' + object + ' li').removeClass(class_name);
    element.addClass(class_name);
    $('#' + column).val(element[0]['innerText']);

    company_search_list(); // 리스트
}

// 기업 리스트 (ajax)
function company_search_list(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    // Country(국가) 필터 - 최대 5개 선택
    var country = '';
    $("input:checkbox[name=country]").each(function() {
        if(this.checked) {
            country += ""+this.value+",";
        }
    });
    country = country.slice(0, -1);
    $('#filter2').val(country);

    $.ajax({
        url : g5_bbs_url + "/ajax.company_search_list.php",
        data: {orderby : $('#orderby').val(), search : $('#search').val(), page : $('#page').val(), sch_tag : $('#sch_tag').val(), filter1 : $('#filter1').val(), filter2 : $('#filter2').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data){
                $('.company_search_list').html(data);

                var search = $.trim($('#search').val());
                $(".company").highlight(search); // 검색어 있을 시 하이라이트

                // 페이징 처리 -- 하단에 페이지 표시
                ajaxGetPaging();
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 태그 검색
function tag_search(tag) {
    // 검색폼에 데이터 입력
    $('#sch_tag').val(tag);
    $('#search').val(tag);
    company_search_list();
}

// 페이징 처리 -- 페이지 클릭 시 동작 이벤트
function get_page(page) {
    company_search_list(page);
}

// 국가 검색 필터
function searchCountry(input) {
    $.ajax({
        url: g5_bbs_url+'/ajax.search_country.php',
        data: {country: input},
        type: 'post',
        success: function(data) {
            $('.area_filter').html(data);
        },
    });
}
</script>

<?php
include_once(G5_BBS_PATH.'/company_search_script.php');
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>
