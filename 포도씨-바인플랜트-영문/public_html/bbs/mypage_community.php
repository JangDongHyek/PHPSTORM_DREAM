<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = 'Mypage Community';
include_once('./_head.php');

/** 일반 - 마이페이지 - 커뮤니티 **/

// 질문수
$co_q_count = selectCount_n("g5_community", "mb_id='".$member['mb_id']."'", "del_yn is null");
// 답변수
$co_a_count = selectCount_n("g5_community_answer", "mb_id='".$member['mb_id']."'", "del_yn is null");
?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="mypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>

    <div id="area_mypage" class="help">
		<div class="inr v3">

			<?php include_once('./mypage_info.php'); ?> 	
			
			<div id="mypage_wrap">		
				<div class="mypage_cont">
					<div class="box">
						<h3>Community</h3>
						<div class="box_cont">
                            <input type="hidden" id="page" name="page" value="1">
                            <input type="hidden" id="mode" name="mode" value="q">
							<ul class="tabs">
                                <li class="active" rel="tab1"><span>My writing</span><em><?=number_format($co_q_count)?></em></li>
                                <li rel="tab2"><span>My comment</span><em><?=number_format($co_a_count)?></em></li>
							</ul>	
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="type w25">Category</li>
												<li class="subject w5">Subject</li>
												<li class="reply w1">Answers</li>
												<li class="data w15">Date</li>
											</ul>

											<!-- 목록 최대 5개 최신순-->
											<ul class="tbl_cont_wrap">
												<li class="tbl_cont community_q"></li>
											</ul>
										</div>
									</div>
								</div>
								<div id="tab2" class="tab_content">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="type w25">Category</li>
												<li class="subject w5">Subject</li>
												<li class="reply w1">Answers</li>
												<li class="data w15">Date</li>
											</ul>

											<!-- 목록 최대 5개 최신순-->
											<ul class="tbl_cont_wrap">
												<li class="tbl_cont community_a"></li>
											</ul>
										</div>
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

$(document).ready(function() {
    mypage_community(); // 리스트

    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn();

            if(activeTab == 'tab1') {
                $('#mode').val('q');
            } else {
                $('#mode').val('a');
            }

            mypage_community(); // 리스트
		}
    });
});

function mypage_community(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_community.php",
        data: {page : $('#page').val(), mode : $('#mode').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data){
                $('.community_'+$('#mode').val()).html(data);

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
    mypage_community(page);
}
</script>

<?php
include_once(G5_BBS_PATH.'/ajax_get_page.php');
?>