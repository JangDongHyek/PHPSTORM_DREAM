<?
include_once('./_common.php');

$g5['title'] = '기업의뢰';
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
						<li class="active">등록순</li>
						<li>마감순</li>
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
						<li><a href="<?php echo G5_BBS_URL ?>/company_write.php">기업의뢰</a></li>
                        <?php } ?>
						<li><a href=""  data-toggle="modal" data-target="#podoCS">포도씨에 직접 의뢰하기!</a></li>
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
                    <h4 class="modal-title" id="appModalLabel">포도씨에 직접 의뢰하기</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h3>기업회원이 아니지만 기업의뢰를 원하시나요? <br>아니면 공개적으로 노출되지 않기 원하시는 의뢰사항이 있으신가요?</h3>
                        <span>포도씨 관리자에게 직접 문의 바랍니다. <br>의뢰 내용 확인후, 내부 DB를 바탕으로 최적의 업체를 검토후 추천해 드리겠습니다.</span>
                        <a href="<?php echo G5_BBS_URL ?>/company_write.php?podosea=Y">의뢰하기</a>
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
			<h2>기업의뢰</h2>
			<span>조선, 해양 관련 무엇이든 의뢰하세요!</span>
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
            <input type="hidden" id="tab" value="tab1">
			<!-- 기업의뢰 필터-->
			<div class="mbox_cate filter mci_category">
			<!--<div class="mbox_cate select"> 필터 체크 했을대 select클래스 추가-->
				<span data-toggle="modal" data-target="#cateModal02"><i></i>필터</span>
			</div>

			<!-- 매물리스트 카테고리-->
			<div class="mbox_cate filter mpr_category" style="display: none;">
				<span data-toggle="modal" data-target="#cateModal03"><i></i>필터</span>
			</div>
			<!-- 매물리스트 카테고리-->

			<div class="top_filter">
				
				<ul class="tabs">
					<li class="active" rel="tab1"><span>기업의뢰</span></li>
                    <?php if($private) { ?>
					<li rel="tab2"><span>글로벌의뢰</span></li>
                    <?php } ?>
				</ul>
				
				<ul class="sort_list">
					<li class="selected"><span>등록순</span></li>
					<li><span>마감순</span></li>
				</ul>
				<div class="msort_list">
					<span data-toggle="modal" data-target="#listModal">등록순</span>
				</div>
			</div>
			<div class="tab_container">
				<div id="tab1" class="tab_content">
                    <!--ajax.company_list-->
					<ul class="list companylist">
						<!-- 리스트 10 -->
					</ul>
				</div>

				<div id="tab2" class="tab_content" style="display: none;">
                    <!--ajax.global_list-->
					<ul class="list globallist">
						<!-- 리스트 10 -->
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
    /**
     * 매물리스트 사용 X
     */
	$(document).ready(function() {
        company_list(); // 리스트

		$(".tab_content").hide();
		$(".tab_content:first").show();

		$("ul.tabs li").click(function () {
			if(!($(this).find('a').length > 0)){
				$("ul.tabs li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide()
				var activeTab = $(this).attr("rel");
				$("#" + activeTab).fadeIn()

                // activeTab ==> tab1 : 기업의뢰 / tab2 : 글로벌의뢰
                $('#tab').val(activeTab);
                // 검색 카테고리 구분(웹)
                if(activeTab == 'tab1') {
                    /*$('.ci_type').show();
                    $('.ci_category').show();
                    $('.pr_type').hide();
                    if('<?=$mobile?>') { // 검색 카테고리 구분(모바일)
                        $('.mci_category').show();
                        $('.mpr_category').hide();
                    }
                    $('.company_write').show();*/

                    company_list();
                } else {
                    /*$('.ci_type').hide();
                    $('.ci_category').hide();
                    $('.pr_type').show();
                    if('<?=$mobile?>') { // 검색 카테고리 구분(모바일)
                        $('.mci_category').hide();
                        $('.mpr_category').show();
                    }
                    $('.company_write').hide();*/

                    global_list();
                }
			}
		});

		/*// 매물리스트 매물유형 선택 시 카테고리 구분
		$('.pr_cate ul li').click(function() {
            $('.pr_category').hide();
		    if($(this)[0]['innerText'] == '선박') {
		        $('.pr_cate1').show();
            } else if($(this)[0]['innerText'] == '기계장비') {
		        $('.pr_cate2').show();
            } else if($(this)[0]['innerText'] == '부품/물품') {
                $('.pr_cate3').show();
            }
        });*/
	});

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name, 모바일여부)
    function click_event(object, element, class_name, column, mobile) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        if(mobile == 'mobile') { // 모바일 버전 필터 선택 시 클래스 추가
            if(element[0]['innerText'] != '전체') {
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
            global_list();
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

    // 글로벌의뢰 리스트 (ajax)
    function global_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.global_list.php",
            data: {orderby : $('#orderby').val(), search : $('#search').val(), type : $('#type').val(), category : $('#category').val(), date : $('#date').val(), page : $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data) {
                    $('.globallist').html(data);

                    var search = $.trim($('#search').val());
                    $(".globallist").highlight(search); // 검색어 있을 시 하이라이트

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
            global_list(page);
        }
    }
</script>
	
<?
include_once(G5_BBS_PATH.'/company_list_search_script.php');
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>