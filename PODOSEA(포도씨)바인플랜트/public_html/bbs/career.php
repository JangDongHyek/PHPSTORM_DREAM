<?
include_once('./_common.php');

$g5['title'] = '커리어';
include_once('./_head.php');

//loginCheck($member['mb_id'], $member['mb_category']);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<?php include_once('./category_modal.php'); ?> 

<style>
	#wrapper{background:#fff;}
	#container{padding:0 0 140px;}
</style>


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
                            <h3 style="font-size: 18px;margin-bottom: 10px;">프로필 업데이트 완료 후<br/>
                                바로 확인이 가능하세요!<br/>
                                잠시만 시간을 내어주시겠어요?
                            </h3>
                            <a href="<?=$profile_url?>">프로필 업데이트</a>
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
						<li class="active">최신순</li>
						<li>마감순</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

<div id="area_career">
	<div class="area_top">
		<div class="inr v3">
			<ul class="bn_list">
				<li>
					<div class="txt">
						<h3><span class="bold">프로필을 업데이트</span>하고 <br>기업 추천을 받으세요!</h3>
                        <?php if($member['mb_category'] == '일반') { ?>
						<a href="<?=G5_BBS_URL?>/profile_update01.php" class="btn_inquiry">프로필 업데이트</a>
                        <?php } else { ?>
                        <a href="<?=G5_BBS_URL?>/profile_company_update01.php" class="btn_inquiry">프로필 업데이트</a>
                        <?php } ?>
					</div>
					<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_career01.png"></div>
				</li>
				<li>
					<div class="txt">
						<h4>
							전문인력이 필요하시면, 포도씨에서 <br>
							<span class="bold">적합한 인재</span>를 찾으세요!
						</h4>
						<a href="<?=G5_BBS_URL?>/career_write.php" class="btn_inquiry">공고 등록하기</a>
					</div>
					<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_career02.png"></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="area_bottom">
        <input type="hidden" id="orderby" name="orderby" value="<?=$orderby?>">
        <input type="hidden" id="page" name="page" value="1">
		<div class="inr v3">
			<h3>채용공고</h3>
			<div class="top_filter">
				<div class="box_left">
                    <span class="view"><a href="<?=$_SERVER['SCRIPT_NAME']?>">전체</a> <span class="blue"></span>건</span>
					<ul class="sort_list">
                        <li class="selected"><span>최신순</span></li>
						<li><span>마감순</span></li>
					</ul>
					<div class="msort_list">
						<span data-toggle="modal" data-target="#listModal">최신순</span>
					</div>
				</div>
				<div class="box_sch">
					<form name="fsearchbox" onsubmit="return searchChk();">
					  <input type="text" placeholder="검색하기" id="search" name="search" value="<?=$search?>">
					  <button type="submit"></button>
					</form>
				</div>
			</div>
			<ul class="career_list">
			</ul>

            <div id="paging"></div>
		</div>
	</div>
</div>

<script>
    $(function() {
        career_list(); // 리스트

        // 마감순/최신순 (웹)
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');
        });

        // 마감순/최신순 (모바일)
        $(".sort_list_mobile li").click(function () {
            click_event('sort_list_mobile', $(this), 'active', 'orderby');

            $('.msort_list span').text($(this)[0]['innerText']);
            $('#listModal').modal('hide');
        });
    });

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        career_list(); // 리스트
    }

    // 채용공고 리스트 (ajax)
    function career_list(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.career.php",
            data: {orderby : $('#orderby').val(), search : $('#search').val(), page : $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.career_list').html(data);
                    $('.blue').text($('#total_count').val()); // 전체 채용공고 수

                    // var search = $('#search').val();
                    // $(".career_list li a").highlight(search); // 검색어 있을 시 하이라이트

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
        career_list(page);
    }
</script>

<?
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>

