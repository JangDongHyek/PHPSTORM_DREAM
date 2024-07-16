<?
include_once('./_common.php');
include_once('./oceanship_eng_db.php'); // 포도씨 영문버전 DB

$g5['title'] = '기업의뢰';
include_once('./_head.php');

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

if($v == 'eng') {
    $ci = $db->getDbRows('view', $idx); // 포도씨 영문버전 기업의뢰 조회
} else {
    $ci = sql_fetch(" select ci.*, mb.mb_no, mb.mb_nick, mb.mb_category, mb.mb_company_homepage from g5_company_inquiry as ci left join g5_member as mb on mb.mb_id = ci.mb_id where idx = {$idx} ");
}

if(!$super) {
    if($ci['del_yn'] == 'Y' || $member['mb_category'] == '일반') {
        alert('올바른 경로가 아닙니다.');
    }
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
                        <li><a href="<?php echo G5_BBS_URL ?>/company_write.php">기업의뢰</a></li>
                        <li><a href=""  data-toggle="modal" data-target="#podoCS">포도씨에 직접 의뢰하기!</a></li>
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
                    <h4 class="modal-title" id="appModalLabel">견적보내기</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h3>이미 발송된 견적이 있습니다.</h3>
                        <span>마이페이지 - 나의 의뢰 - 보낸 견적에서<br>제출한 견적의 확인 및 수정이 가능합니다.</span>
                        <br>
                        <a href="javascript:;" data-dismiss="modal">확인</a>
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
			<h2>기업의뢰</h2>
			<span>조선, 해양 관련 어떤 것이든 물어보세요!</span>
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
								<em>의뢰유형</em>
								<div class="area_box"><p class="type"><i></i><?=$ci['ci_type']?></p></div>
							</li>
							<li>
								<em>의뢰 기본 정보</em>
								<ul class="area_box">
									<li>
										<span>Vessel name</span>
										<p><?=$ci['ci_vessel']?></p>
									</li> 
									<li>
										<span>IMO No.</span>
										<p><?=$ci['ci_imo_no']?></p>
									</li>
									<li>
										<span>견적기한</span>
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
												<th>Maker (제조사)</th>
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
								<em>의뢰 내용</em>
								<div class="area_box">
                                    <?php if(!empty($ci['ci_contents'])) { ?>
									<div class="area_txtarea">
										<?=nl2br($ci['ci_contents'])?>
									</div>
                                    <?php } ?>
								</div>
							</li>
							<li>
								<em>의뢰 상세 자료</em>
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
									<span>비밀번호 입력</span>
									<input type="text" name="ci_password" id="ci_password">
									 
									 <button type="button" onclick="passwordCheck('<?=$ci['idx']?>');">확인</button>
									</div>
                                   
                                    <p>* 비공개 자료입니다. 의뢰자에게 문의하세요.</p>
                                    <?php } ?>
                                </div>
							</li>
                            <li>
                                <em>BUDGET</em>
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
                        <?php if($v != 'eng') { ?>
						<div class="list_info">
							<span class="id">
                                <div class="profile">
                                <?php echo getProfileImg($ci['mb_id'], $ci['mb_category']); ?>
                                </div>
                                <?=getNickOrId($ci['mb_id'])?>
                            </span><!--아이디-->
							<span class="data"><?=replaceDateFormat($ci['wr_datetime'])?></span><!--등록일-->
							<span class="view">조회수 <em id="view_count"><?=number_format($view_count)?></em></span><!--조회수-->
							<ul class="user_list">
								<li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$ci['mb_no']?>">기업홈피로 이동</a></li>
								<li>의뢰건수 <em class="blue"><?=inquiryCount($ci['mb_id'])?></em>건</li>
								<li>거래건수 <em class="blue"><?=completeCount($ci['mb_id'])?></em>건</li>
                                <li onclick="reportOpen('<?=$ci['mb_id']?>', 'g5_company_inquiry', '<?=$ci['idx']?>')">신고하기</li>
                            </ul>
						</div>
                        <?php } else { ?>
                        <div class="list_info">
							<span class="id">
                                <div class="profile">
                                    <img class="com toggle" src="<?=G5_IMG_URL?>/img_nlogo.jpg">
                                </div>
                                글로벌 의뢰
                            </span><!--아이디-->
                            <span class="data"><?=replaceDateFormat($ci['wr_datetime'])?></span><!--등록일-->
                        </div>
                        <?php } ?>
					</div>
				</div>	
			</div>
            
			<div class="area_btn two">
                <?php if($v != 'eng') { // 해외버전에서 등록한 기업의뢰의 경우 버튼 숨김?>
				<ul class="btn_list">
                    <?php if($ci['mb_id'] != $member['mb_id']) { ?>
                    <?php if($member['mb_category'] == '기업') { ?> <!--기업회원만 견적보내기-->
                    <li><button type="button" class="btn_confirm" onclick="sendEstimate();">견적보내기</button></li>
                    <?php } ?>
					<li <?php if($member['mb_level'] == 2) { echo 'class="mfull"'; } ?>><button type="button" class="btn_confirm violet" onclick="chatting();">의뢰자에게 문의하기</button></li>
                    <?php } else { ?>
					<li><button type="button" class="btn_confirm" onclick="location.href='<?=G5_BBS_URL?>/company_write.php?idx=<?=$ci['idx']?>&w=u'">기업의뢰 수정하기</button></li>
                    <!--받은견적이 없을 때만 삭제 가능-->
                    <li><button type="button" class="btn_confirm gray" onclick="delInquiry();">기업의뢰 삭제하기</button></li>
                    <?php } ?>
				</ul>
                <?php } else { ?>
                <ul class="btn_list">
                    <li><button type="button" class="btn_confirm gray" onclick="window.open('http://itforone.com/~oceanship_eng/bbs/company_view.php?idx=<?=$ci['idx']?>')">글로벌 버전에서 확인하기</button></li>
                </ul>
                <?php } ?>
			</div>
			<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/company_list.php"><span>목록</span><a></div>
		
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
            swal('비밀번호를 입력해 주세요.');
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
                    swal('비밀번호가 일치하지 않습니다.');
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
            text: "의뢰를 삭제하시겠습니까?",
            icon: "warning",
            buttons: {
                defeat: "확인",
                cancel: "취소",
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
                                swal('기업의뢰가 삭제되었습니다.')
                                .then(()=>{
                                   location.replace(g5_bbs_url+'/company_list.php');
                                });
                            }
                            else {
                                swal('받은 견적이 있습니다.');
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