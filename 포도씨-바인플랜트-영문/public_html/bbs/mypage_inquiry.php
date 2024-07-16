<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 나의문의';
include_once('./_head.php');

/** 일반 - 마이페이지 - 나의문의 **/

$r_count = selectCount('g5_company_question', 'mb_no', $member['mb_no']); // 받은문의 수
$s_count = selectCount('g5_company_question', 'mb_id', $member['mb_id']); // 보낸문의 수
?>

<style>
    .profile img {border-radius: 50% !important;}
</style>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<?php
// 프로필 모달
include_once('./profile_modal.php');
?>

<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

    <input type="hidden" id="page" name="page" value="1">
    <input type="hidden" id="mode" name="mode" value="r">
    <div id="area_mypage" class="help">
		<div class="inr v3">
			<div id="mypage_wrap">
				<?php include_once('./mypage_cinfo.php'); ?>
				<div class="mypage_cont">
					<div class="box">
						<h3>나의문의</h3>
						<div class="box_cont">
							<ul class="tabs">
								<li class="active" rel="tab1"><span>받은문의</span><em><?=number_format($r_count)?></em></li>
								<li rel="tab2"><span>보낸문의</span><em><?=number_format($s_count)?></em></li>
							</ul>
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div id="help_list" class="inquiry">
										<ul class="list full inquiry_r"></ul>
									</div>
								</div>
								<div id="tab2" class="tab_content">
									<div id="help_list" class="inquiry">
										<ul class="list full inquiry_s"></ul>
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

<script>
    $(document).ready(function() {
        mypage_inquiry(); // 리스트

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
                    $('#mode').val('r');
                } else {
                    $('#mode').val('s');
                }

                mypage_inquiry(); // 리스트
            }
        });
    });

    function mypage_inquiry(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.mypage_inquiry.php",
            data: {page : $('#page').val(), mode : $('#mode').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.inquiry_'+$('#mode').val()).html(data);

                    readMore(); // 더보기

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
        mypage_inquiry(page);
    }

    // 더보기
    function readMore() {
        $('#help_list.inquiry .content_box').each(function(){
            var content = $(this).children('span');
            var content_txt = content.text();
            var content_txt_short = content_txt.substring(0,140)+"...";
            var btn_more = $('<a href="javascript:void(0)" class="more">더보기<i></i></a>');

            $(this).append(btn_more);

            if(content_txt.length >= 140){
                content.html(content_txt_short)

            }else{
                btn_more.hide()
            }

            btn_more.click(toggle_content);
            // 아래 bind가 안 되는 이유는??
            // btn_more.bind('click',toggle_content);

            function toggle_content(){
                if($(this).hasClass('short')){
                    // 접기 상태
                    $(this).html('더보기<i></i>');
                    content.html(content_txt_short)
                    $(this).removeClass('short');
                }else{
                    // 더보기 상태
                    $(this).html('더보기<i></i>');
                    content.html(content_txt);
                    $(this).addClass('short');

                }
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>