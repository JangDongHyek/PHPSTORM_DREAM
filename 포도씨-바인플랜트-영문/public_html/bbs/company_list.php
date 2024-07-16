<?
include_once('./_common.php');

$g5['title'] = 'See RFQ';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    .highlight {color:#275dd7 !important;}
</style>

<?php include_once('./category_company01_modal.php'); ?>
<?php include_once('./category_company02_modal.php'); ?>

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="sort_list_mobile">
						<li class="active">By Registration</li>
						<li>By Deadline</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

<!-- 의뢰등록 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul>
                        <?php if($member['mb_category'] == '기업') { ?>
						<li><a href="<?php echo G5_BBS_URL ?>/company_write.php">Corporate RFQ</a></li>
                        <?php } ?>
						<li><a href=""  data-toggle="modal" data-target="#podoCS">Podosea Direct RFQ!</a></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 의뢰등록 모달팝업 -->

<!-- 의뢰종류 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="podoCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Podosea Direct RFQ</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h3>Do you want to keep you RFQs private?</h3>
                        <span>Please contact Podosea administrators directly. <br>After reviewing your RFQ, we will use our database to recommend a company best suited to your needs.</span>
                        <a href="<?php echo G5_BBS_URL ?>/company_write.php?podosea=Y">Direct RFQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 의뢰종류 모달팝업 -->

<div id="area_help" class="company">
	<div class="inr">
	<div id="top_bn">
		<div class="txt">
			<h2>See RFQ</h2>
			<span>Feel free to request anything related to marine business!</span>
		</div>
		<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
	</div>
	<div id="help_warp">
		<?php include_once('./left_menu_company.php'); ?>
		<div id="help_list">
            <input type="hidden" id="orderby" name="orderby" value="<?=$orderby?>">
            <input type="hidden" id="type" name="type" value="<?=$type?>">
            <input type="hidden" id="category" name="category" value="<?=$category?>">
            <input type="hidden" id="date" name="date" value="<?=$date?>">
            <input type="hidden" id="sch_tag" name="sch_tag" value="<?=$sch_tag?>">
            <input type="hidden" id="page" name="page" value="1">
            <input type="hidden" id="tab" value="<?=empty($tab) ? 'tab1' : $tab?>">
			<!-- 기업의뢰 필터-->
			<div class="mbox_cate filter mci_category">
			<!--<div class="mbox_cate select"> 필터 체크 했을대 select클래스 추가-->
				<span data-toggle="modal" data-target="#cateModal02"><i></i>Filter</span>
			</div>

			<!-- 매물리스트 카테고리-->
			<div class="mbox_cate filter mpr_category" style="display: none;">
				<span data-toggle="modal" data-target="#cateModal03"><i></i>Filter</span>
			</div>
			<!-- 매물리스트 카테고리-->

			<div class="top_filter">

				<ul class="tabs">
					<li class="active li_tab1" rel="tab1"><span>Corporate RFQ</span></li>
					<li rel="tab2"><span>For Sale</span></li>
				</ul>

				<ul class="sort_list">
					<li class="selected"><span>By Registration</span></li>
					<li><span>By Deadline</span></li>
				</ul>
				<div class="msort_list">
					<span data-toggle="modal" data-target="#listModal">By Registration</span>
				</div>
			</div>
			<div class="tab_container">
				<div id="tab1" class="tab_content">
					<ul class="list companylist"> <!--ajax.company_list.php-->
						<!-- 리스트 10 -->
					</ul>
				</div>

				<div id="tab2" class="tab_content" style="display: none;">
					<ul class="list forsalelist"> <!--ajax.forsale_list.php-->
						<!-- 리스트 10 -->

						<!-- 기계장비매물 -->
						<li class="company">
							<a href="<?php echo G5_BBS_URL ?>/product_view.php">
								<div class="title">
									<em>기계장비</em><!-- 카테고리 -->
									<h3>DE35DF</h3> <!-- 매물 제품명 -->
								</div>
								<div class="cont">
									<div class="left">
										<ul class="list_text">
											<li><em>Maker</em><span>DAIHATSU ANQING CSSC DIESEL ENGINE CO., LTD</span></li><!-- Maker -->
											<li><em>Model/Type</em><span>DE35DF</span></li><!-- Model/Type -->
											<li><em>Price Idea</em><span>$3,000 ~ $10,000</span></li><!-- Price Idea -->
											<li><em>Located at</em><span>Australia</span></li><!-- Located at -->
										</ul>
										<div class="list_info">
											<span class="data">2021.05.21</span> <!-- 의뢰올린날자 -->
										</div>
									</div>
									<div class="right">
								<img src="<?php echo G5_IMG_URL ?>/img_photo.jpg">
							</div>
								</div>
							</a>
						</li>
						<!-- //기계장비매물 -->

						<!-- 부품, 물품매물 -->
						<li class="company">
							<a href="<?php echo G5_BBS_URL ?>/product_view.php">
								<div class="title">
									<em>부품, 물품</em><!-- 카테고리 -->
									<h3>부품이름</h3> <!-- 매물 제품명 -->
								</div>
								<div class="cont">
									<div class="left">
										<ul class="list_text">
											<li><em>Maker</em><span>Maker</span></li><!-- Maker -->
											<li><em>Model/Type</em><span>Model/Type</span></li><!-- Model/Type -->
											<li><em>Certificate/Approval</em><span>Certificate/Approval</span></li><!-- Certificate/Approval -->
											<li><em>Located at</em><span>Australia</span></li><!-- Located at -->
										</ul>
										<div class="list_info">
											<span class="data">2021.05.21</span> <!-- 의뢰올린날자 -->
										</div>
									</div>
									<div class="right">
								<img src="<?php echo G5_IMG_URL ?>/img_photo.jpg">
							</div>
								</div>
							</a>
						</li>
						<!-- //부품, 물품매물 -->
					</ul>
				</div>

                <div id="paging"></div>
			</div>
		</div>
        <?php
        if($member['mb_category'] == '일반') {
            include_once('./myinfo.php');
        } else {
            include_once('./myinfo_company.php');
        }
        ?>
	</div>
</div>

<div class="btn_write"><a data-toggle="modal" data-target="#listCS"></a></div>

</div>

<script>
	$(document).ready(function() {
        company_list(); // 리스트

		$(".tab_content").hide();
		$(".tab_content:first").show();

		$("ul.tabs li").click(function () {
			if(!($(this).find('a').length > 0)) {
                clearSearch(); // 검색 초기화

				$("ul.tabs li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide()
				var activeTab = $(this).attr("rel");
				$("#" + activeTab).fadeIn()

                $('#tab').val(activeTab);
                // activeTab ==> tab1 : 기업의뢰 / tab2 : 매물리스트
                // 검색 카테고리 구분(웹)
                if(activeTab == 'tab1') {
                    $('.ci_type').show();
                    $('.ci_category').show();
                    $('.pr_type').hide();
                    if('<?=$mobile?>') { // 검색 카테고리 구분(모바일)
                        $('.mci_category').show();
                        $('.mpr_category').hide();
                    }
                    $('.company_write').show();
                    $('.product_write').hide();

                    company_list();
                } else {
                    $('.ci_type').hide();
                    $('.ci_category').hide();
                    $('.pr_type').show();
                    if('<?=$mobile?>') { // 검색 카테고리 구분(모바일)
                        $('.mci_category').hide();
                        $('.mpr_category').show();
                    }
                    $('.company_write').hide();
                    $('.product_write').show();

                    forsale_list();
                }
			}
		});

        // 매물리스트 상세뷰에서 검색 시 넘어옴
        if($('#tab').val() == 'tab2') {
            //$("ul.tabs li:last-child").trigger('click');
            $("ul.tabs li").removeClass('active');
            $("ul.tabs li:last").addClass('active');
            $(".tab_content").hide();
            $("#tab2").fadeIn()

            $('.ci_type').hide();
            $('.ci_category').hide();
            $('.pr_type').show();
            if('<?=$mobile?>') { // 검색 카테고리 구분(모바일)
                $('.mci_category').hide();
                $('.mpr_category').show();
            }
            $('.company_write').hide();
            $('.product_write').show();

            forsale_list();
        }

		// 매물리스트 매물유형 선택 시 카테고리 구분 (웹)
		$('.pr_type ul li').click(function() {
            $('.pr_category').hide();
		    if($(this)[0]['innerText'] == 'Ship') {
		        $('.pr_cate1').show();
            } else if($(this)[0]['innerText'] == 'Machinery') {
		        $('.pr_cate2').show();
            } else if($(this)[0]['innerText'] == 'Parts/Articles') {
                $('.pr_cate3').show();
            }
        });
		// 매물리스트 매물유형 선택 시 카테고리 구분 (모바일)
        $('.m_pr_type li').click(function() {
            $('.m_pr_category').hide();
            if($(this)[0]['innerText'] == 'Ship') {
                $('.m_pr_cate1').show();
            } else if($(this)[0]['innerText'] == 'Machinery') {
                $('.m_pr_cate2').show();
            } else if($(this)[0]['innerText'] == 'Parts/Articles') {
                $('.m_pr_cate3').show();
            }
        });
	});


	// 검색 초기화 (타입, 카테고리)
	function clearSearch() {
        $('#type').val('');
        $('#category').val('');
        $('.box_cate ul li').removeClass('active');
        $('.box_cate ul li:first-child').addClass('active');
    }

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name, 모바일여부)
    function click_event(object, element, class_name, column, mobile) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        if(mobile == 'mobile') { // 모바일 버전 필터 선택 시 클래스 추가
            if(element[0]['innerText'] != 'All') {
                if(object.indexOf('pr') != -1) {
                    $('.mpr_category').addClass('select')
                } else {
                    $('.mci_category').addClass('select')
                }
            } else {
                if(object.indexOf('pr') != -1) {
                    $('.mpr_category').removeClass('select')
                } else {
                    $('.mci_category').removeClass('select')
                }
            }
        }

        // 리스트
        if($('#tab').val() == 'tab1') {
            company_list();
        } else {
            forsale_list();
        }
    }

    // 기업의뢰 리스트 (ajax)
    function company_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.company_list.php",
            data: {orderby : $('#orderby').val(), search : $('#search').val(), type : $('#type').val(), category : $('#category').val(), date : $('#date').val(), page : $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data) {
                    $('.companylist').html(data);

                    var search = $.trim($('#search').val());
                    $(".companylist").highlight(search); // 검색어 있을 시 하이라이트

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 매물리스트 (ajax)
    function forsale_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.forsale_list.php",
            data: {orderby : $('#orderby').val(), search : $('#search').val(), type : $('#type').val(), category : $('#category').val(), date : $('#date').val(), page : $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data) {
                    $('.forsalelist').html(data);

                    var search = $.trim($('#search').val());
                    $(".forsalelist").highlight(search); // 검색어 있을 시 하이라이트

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
        // 리스트
        if($('#tab').val() == 'tab1') {
            company_list(page);
        } else {
            forsale_list(page);
        }
    }
</script>

<?
include_once(G5_BBS_PATH.'/company_list_search_script.php');
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>
