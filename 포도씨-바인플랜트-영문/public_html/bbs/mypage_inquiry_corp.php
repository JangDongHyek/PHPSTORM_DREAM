<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = 'Received RFQs';
include_once('./_head.php');

/** 기업 - 마이페이지 - 받은문의 **/

$ing_cnt = selectCount('g5_company_question', 'mb_no', $member['mb_no'], 'state', 'Processing'); // 처리중
$com_cnt = selectCount('g5_company_question', 'mb_no', $member['mb_no'], 'state', 'Processing Complete'); // 처리완료
?>

<style>
    .profile img {border-radius: 50% !important;}
</style>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<?php include_once('./profile_modal.php'); // 프로필 모달 ?>

<!-- 필터 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="cq_idx" name="cq_idx">
        <input type="hidden" id="cq_state" name="cq_state">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <ul id="sort_list" class="list_modal">
                        <li class="ing" onclick="inquiryAction('ing');">Processing</li>
                        <li class="com" onclick="inquiryAction('com');">Processing Complete</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!--  필터 모달 -->

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

    <input type="hidden" id="page" name="page" value="1">
    <input type="hidden" id="mode" name="mode" value="ing">
    <div id="area_mypage" class="help">
		<div class="inr v3">
			<div id="mypage_wrap">
				<?php include_once('./mypage_cinfo.php'); ?>
				<div class="mypage_cont">
					<div class="box">
						<h3>Received Inquiry</h3>
						<div class="box_cont">
							<ul class="tabs">
								<li class="active" rel="tab1"><span>Processing</span><em><?=number_format($ing_cnt)?></em></li>
								<li rel="tab2"><span>Processing Complete</span><em><?=number_format($com_cnt)?></em></li>
							</ul>
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div id="help_list" class="inquiry">
                                        <!--ajax.mypage_inquiry.php-->
										<ul class="list full inquiry_ing"></ul>
									</div>
								</div>
								<div id="tab2" class="tab_content">
									<div id="help_list" class="inquiry">
                                        <!--ajax.mypage_inquiry.php-->
                                        <ul class="list full inquiry_com"></ul>
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
                    $('#mode').val('ing');
                } else {
                    $('#mode').val('com');
                }

                mypage_inquiry(); // 리스트
            }
        });

        // // 처리중/처리완료 상태 변경 모달 클릭 시
        // $(".list_modal li").click(function () {
        //     $(".list_modal li").removeClass('active');
        //     $(this).addClass('active');
        //     $('#cq_state').val($(this)[0]['innerText']);
        // });
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
            var btn_more = $('<a href="javascript:void(0)" class="more">more<i></i></a>');

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
                    $(this).html('more<i></i>');
                    content.html(content_txt_short)
                    $(this).removeClass('short');
                }else{
                    // 더보기 상태
                    $(this).html('more<i></i>');
                    content.html(content_txt);
                    $(this).addClass('short');

                }
            }
        });
    }

    // 처리중/처리완료 모달
    function listModal(idx, state) {
        $(".list_modal li").removeClass('active');
        $('#cq_idx').val(idx); // 문의내역 idx
        var cls = '';
        if(state == 'Processing Complete') { cls = 'com'; }
        else { cls = 'ing'; }
        $("."+cls).addClass('active');
        $('#listModal').modal('show');
    }

    // 처리중/처리완료 액션
    function inquiryAction(cls) {
        $(".list_modal li").removeClass('active');
        $("."+cls).addClass('active');
        var state = '';
        if(cls == 'com') { state = 'Processing Complete'; }
        else { state = 'Processing'; }
        $('#cq_state').val(state);

        $.ajax({
            url: "./ajax.inquiry_action.php",
            type: "post",
            data: {idx: $('#cq_idx').val(), state: $('#cq_state').val()},
            success: function(data) {
                if(data) {
                    swal("processing status has changed.")
                    .then(() => {
                        $('#listModal').modal('hide');
                        //mypage_inquiry();
                        location.reload();
                    });
                }
            },
        });
    }
</script>

<?
include_once('./fchatting.php');
include_once('./_tail.php');
?>
