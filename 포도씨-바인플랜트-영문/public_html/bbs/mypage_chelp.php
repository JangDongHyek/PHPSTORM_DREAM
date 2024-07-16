<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = 'Mypage Help Me';
include_once('./_head.php');

/** 기업 - 마이페이지 - 헬프미 **/

// 질문수
$q_count = sql_fetch(" select count(*) as count from g5_helpme where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
// 답변수
$a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>

    <div id="area_mypage" class="help">
		<div class="inr v3">		
			<div id="mypage_wrap">	
				<?php include_once('./mypage_cinfo.php'); ?> 
				<div class="mypage_cont">
					<div class="box">
						<h3>Help Me</h3>
						<div class="box_cont">
                            <input type="hidden" id="page" name="page" value="1">
                            <input type="hidden" id="mode" name="mode" value="q">
							<ul class="tabs">
                                <li class="active" rel="tab1"><span>My question</span><em><?=number_format($q_count)?></em></li>
                                <li rel="tab2"><span>My answer</span><em><?=number_format($a_count)?></em></li>
							</ul>	
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
                                                <li class="type w2">Category</li>
                                                <li class="subject w35">Subject</li>
                                                <li class="select w1">Best Answer</li>
                                                <li class="select w1">Great Answer</li>
                                                <li class="reply w1">Answers</li>
                                                <li class="data w15">Date</li>
											</ul>

											<!-- 목록 최대 5개 최신순-->
											<ul class="tbl_cont_wrap">
                                                <!--ajax.mypage_help_list.php-->
												<li class="tbl_cont helpme_q"></li>
											</ul>
										</div>
									</div>
								</div>
								<div id="tab2" class="tab_content" style="display: none;">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
                                                <li class="type w2">Category</li>
                                                <li class="subject w35">Subject</li>
                                                <li class="select w1">Best Answer</li>
                                                <li class="select w1">Great Answer</li>
                                                <li class="reply w1">Answers</li>
                                                <li class="data w15">Date</li>
											</ul>
											<ul class="tbl_cont_wrap">
                                                <!--ajax.mypage_help_list.php-->
												<li class="tbl_cont helpme_a"></li>
											</ul>
										</div>
									</div>
								</div>

                                <div id="paging"></div>
							</div>
						</div>
					</div>
				</div>
				<?php include_once('./mypage_cmenu.php'); ?> 
			</div>			
		</div>
	</div>

<?
include_once('./_tail.php');
?>

<script>

$(document).ready(function() {
    mypage_help_list(); // 리스트

    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()

            if(activeTab == 'tab1') {
                $('#mode').val('q');
            } else {
                $('#mode').val('a');
            }

            mypage_help_list(); // 리스트
		}
    });
});


function mypage_help_list(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_help_list.php",
        data: {page : $('#page').val(), mode : $('#mode').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data){
                $('.helpme_'+$('#mode').val()).html(data);

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
    mypage_help_list(page);
}
</script>