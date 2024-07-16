<?
include_once('./_common.php');

$g5['title'] = 'Corporate RFQ';
include_once('./_head.php');

if(!$is_member) alert('Please try again after logging in.', G5_BBS_URL.'/login.php');

$ci = sql_fetch(" select ci.*, mb.mb_no, mb.mb_nick, mb.mb_category, mb.mb_company_homepage from g5_company_inquiry as ci left join g5_member as mb on mb.mb_id = ci.mb_id where idx = {$idx} ");

if($ci['del_yn'] == 'Y' || $member['mb_category'] == '일반') {
    alert('Not the correct path.');
}

$view_count = sql_fetch(" select acc_count from g5_company_inquiry_action where company_inquiry_idx = {$idx} and mode = 'view' order by idx desc limit 1 ")['acc_count']; // 조회 누적카운트
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft_menu{display:none;}
</style>

<!-- 의뢰등록 모달팝업 -->
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
<!-- 의뢰등록 모달팝업 -->

<!-- 견적보내기 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="estimateCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Send Quote</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h3>A quote has already been sent</h3>
                        <span>You can check and edit the quote submitted in<br>Mypage - My RFQs - Quote Sent</span>
                        <br>
                        <a href="javascript:;" data-dismiss="modal">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 견적보내기 모달팝업 -->

<div id="area_help" class="company view">
	<div class="inr">
	<div id="top_bn">
		<div class="txt">
			<h2>Corporate RFQ</h2>
			<span>Feel free to request anything relating to shipbuilding and offshore business!</span>
		</div>
		<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
	</div>
	<div id="help_warp">
		<?php include_once('./left_menu_company.php'); ?>
		<div id="help_list">
			<div class="help_question">
				<div class="title">
					<em><?=$ci['ci_category']?></em><!-- 카테고리 -->
					<h3><?=$ci['ci_subject']?></h3><!-- 제목 -->
				</div>
				<div class="bottom">
					<div id="company_write">
						<ul class="box_list">
							<li>
								<em>RFQ Type</em>
								<div class="area_box">
                                    <?php
                                    $ciTypes = explode("|", $ci['ci_type']);
                                    foreach ($ciTypes as $ciType) { ?>
                                    <p class="type"><i></i><?=$ciType?></p>
                                    <?php } ?>
                                </div>
							</li>
							<li>
								<em>RFQ Basic Information</em>
								<ul class="area_box">
									<li>
										<span>Vessel Name</span>
										<p><?=$ci['ci_vessel']?></p>
									</li>
									<li>
										<span>IMO No.</span>
										<p><?=$ci['ci_imo_no']?></p>
									</li>
									<li>
										<span>Quotation Deadline</span>
										<p><?=replaceDateFormat($ci['ci_deadline_date'])?></p>
									</li>
								</ul>
								<div class="table_wrap">
									<table class="table v1 scroll">
										<caption>지원내용</caption>
										<colgroup>
											<col style="width:25%"/>
											<col style="width:25%"/>
											<col style="width:25%"/>
											<col style="width:25%"/>
										</colgroup>
										<thead>
											<tr>
												<th>*Category</th>
												<th>Maker (manufacturer)</th>
												<th>Model</th>
												<th>Serial No.</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><span><?=$ci['ci_category']?></span></td>
												<td><span><?=$ci['ci_maker']?></span></td>
												<td><span><?=$ci['ci_model']?></span></td>
												<td><span><?=$ci['ci_serial_no']?></span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</li>
							<li>
								<em>RFQ Content</em>
								<div class="area_box">
									<table class="table v2 scroll">
										<colgroup>
											<col style="width:25px"/>
										</colgroup>
										<thead>
										  <tr>
											<th>NO.</th>
											<th>DESCRIPTION</th>
											<th>REFERENCE</th>
											<th>PART NO.</th>
											<th>QUANTITY</th>
											<th>UoM</th>
										  </tr>
										</thead>
										<tbody>
                                        <?php
                                        $contentRlt = sql_query("SELECT * FROM g5_company_inquiry_content WHERE inquiry_idx = '{$idx}' order by idx");
                                        for($i=1; $content=sql_fetch_array($contentRlt); $i++) { ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><span><?=$content['description']?></span></td>
                                            <td><span><?=$content['reference']?></span></td>
                                            <td><span><?=$content['part_no']?></span></td>
                                            <td><span><?=number_format($content['quantity'])?></span></td>
                                            <td><span><?=$content['uom']?></span></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
										</tbody>
									</table>
								</div>
								<div class="area_box">
                                    <?php if(!empty($ci['ci_contents'])) { ?>
                            			<span>Message to Supplier</span>
									<div class="area_txtarea">
										<?=nl2br($ci['ci_contents'])?>
									</div>
                                    <?php } ?>
								</div>
							</li>
							<li>
								<em>RFQ Details</em>
								<div class="area_box file_box">
                                    <?php if($ci['ci_open'] == 'open' || $ci['mb_id'] == $member['mb_id']) { ?> <!--자료 전체 공개-->
									<ul class="file_list">
                                    <?php
                                    $filecount = sql_fetch(" select count(*) as count from g5_company_inquiry_img where company_inquiry_idx = {$idx}; ")['count'];
                                    if($filecount > 0) {
                                        $file_sql = " select * from g5_company_inquiry_img where company_inquiry_idx = {$idx} order by idx; ";
                                        $file_result = sql_query($file_sql);

                                        for($i=0; $row=sql_fetch_array($file_result); $i++) {
                                        ?>
                                        <li class="file_<?=$i?>">
                                            <span class="fileName"><a href="javascript:fileDownload('company_inquiry', '<?=$row['img_file']?>', '<?=$row['img_source']?>');"><?=$row['img_source']?></a></span>
                                        </li>
                                        <?php
                                        }
                                    }
                                    ?>
									</ul>
                                    <?php } else { ?> <!--자료 선택 공개 ==> 비밀번호 입력 필요-->
                                    <div class="data_password">
									<span>Enter Password</span>
									<input type="text" name="ci_password" id="ci_password">

									 <button type="button" onclick="passwordCheck('<?=$ci['idx']?>');">Confirm</button>
									</div>

                                    <p>* This is private material. Contact the client.</p>
                                    <?php } ?>
                                </div>
							</li>
                            <li>
                                <em>Budget</em>
                                <div class="area_box">
                                    <span><?=$company_budget[$ci['ci_budget']]?></span>
                                </div>
                            </li>
                            <li>
                                <em>Delivery To</em>
                                <div class="area_box">
                                    <span><?=$ci['ci_delivery_to']?></span>
                                </div>
                            </li>
						</ul>
					</div>
					<div class="info">
						<div class="list_info">
							<span class="id">
                                <div class="profile">
                                <?php echo getProfileImg($ci['mb_id'], $ci['mb_category']); ?>
                                </div>
                                <?=getNickOrId($ci['mb_id'])?>
                            </span><!--아이디-->
							<span class="data"><?=replaceDateFormat($ci['wr_datetime'])?></span><!--등록일-->
							<span class="view">Views <em id="view_count"><?=number_format($view_count)?></em></span><!--조회수-->
							<ul class="user_list">
								<li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$ci['mb_no']?>">Go to Company Homepage</a></li>
								<li>RFQs <em class="blue"><?=inquiryCount($ci['mb_id'])?></em></li>
								<li>Transactions <em class="blue"><?=completeCount($ci['mb_id'])?></em></li>
                                <li onclick="reportOpen('<?=$ci['mb_id']?>', 'g5_company_inquiry', '<?=$ci['idx']?>')">Report</li>
                            </ul>
						</div>
					</div>
				</div>
			</div>

			<div class="area_btn two">
				<ul class="btn_list">
                    <?php if($ci['mb_id'] != $member['mb_id']) { ?>
                    <?php if($member['mb_level'] == '3') { ?> <!--기업회원만 견적보내기-->
                    <li><button type="button" class="btn_confirm" onclick="sendEstimate();">Send Quote</button></li>
                    <?php } ?>
					<li <?php if($member['mb_level'] == 2) { echo 'class="mfull"'; } ?>><button type="button" class="btn_confirm violet" onclick="chatting();">Contact the client</button></li>
                    <?php } else { ?>
					<li><button type="button" class="btn_confirm" onclick="location.href='<?=G5_BBS_URL?>/company_write.php?idx=<?=$ci['idx']?>&w=u'">Edit Corporate RFQ</button></li>
                    <!--받은견적이 없을 때만 삭제 가능-->
                    <li><button type="button" class="btn_confirm gray" onclick="delInquiry();">Delete Corporate RFQ</button></li>
                    <?php } ?>
				</ul>
			</div>
			<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/company_list.php"><span>List</span><a></div>

		</div>
	</div>
</div>

<!--<div class="btn_write"><a data-toggle="modal" data-target="#listCS"></a></div>-->

</div>

<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="inquiry_idx" id="inquiry_idx" value="<?=$idx?>">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="<?=$ci['mb_id']?>">
</form>

<script>
    $(function() {
        // 조회/좋아요/싫어요 동작
        company_action('view');
    });

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name, 모바일여부)
    function click_event(object, element, class_name, column, mobile) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        $('#fsearch').submit();
    }

    // 조회/좋아요/싫어요 동작 (액션)
    function company_action(mode) {
        $.ajax({
            url : g5_bbs_url + "/ajax.company_action.php",
            data: {mode : mode, company_inquiry_idx : '<?=$idx?>'},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('#'+mode+'_count').text(data);
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 자료 비밀번호 확인
    function passwordCheck(idx) {
        if($('#ci_password').val() == '') {
            swal('Please enter a password.');
            return false;
        }

        $.ajax({
            url : g5_bbs_url + "/ajax.password_check.php",
            data: {idx : idx, password : $('#ci_password').val()},
            type: 'POST',
            cache: false,
            async: false,
            dataType: 'html',
            success : function(data) {
                if(data == 'fail'){
                    swal('Wrong password.');
                } else {
                    $('.file_box').html(data);
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 견적보내기 (견적은 한번만 발송)
    function sendEstimate() {
        // 이미 보낸 견적이 있는지 확인
        $.ajax({
            url : g5_bbs_url + "/ajax.estimate_check.php",
            data: {idx : '<?=$ci['idx']?>'},
            type: 'POST',
            success : function(data) {
                if(data) {
                    location.href = '<?=G5_BBS_URL?>/estimate.php?idx=<?=$ci['idx']?>'
                } else {
                    $('#estimateCheck').modal('show'); // 견적을 이미 보냈을 경우 알림창
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 기업의뢰 삭제하기
    function delInquiry() {
        swal({
            text: "Are you sure you want to delete the inquiry?",
            icon: "warning",
            buttons: {
                defeat: "Confirm",
                cancel: "Cancel",
            },
        })
        .then((value) => {
            switch (value) {
                case "defeat":
                    $.ajax({
                        url: g5_bbs_url + "/ajax.company_write_update.php",
                        data: {idx: '<?=$ci['idx']?>', w: 'd'},
                        type: 'POST',
                        success: function (data) {
                            if(data == 'success') {
                                swal('Delete completed.')
                                .then(()=>{
                                   location.replace(g5_bbs_url+'/company_list.php');
                                });
                            }
                            else {
                                swal('There are already registered quotes.');
                                return false;
                            }
                        },
                    });
                case "cancel":
                    return false;
            }
        });
        $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
    }
</script>

<script>
$(function(){
	$('.list_info > .id').on('click',function(){
		$(this).toggleClass('active');
		$('.list_info .user_list').toggleClass('active');
		return false;
	});
});
</script>

<?
include_once(G5_BBS_PATH.'/company_list_search_script.php');
include_once('./_tail.php');
?>
