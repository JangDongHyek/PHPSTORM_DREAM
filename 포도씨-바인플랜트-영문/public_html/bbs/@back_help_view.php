<?
include_once('./_common.php');

$g5['title'] = '헬프미';
include_once('./_head.php');

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

$help = sql_fetch(" select he.*, mb.mb_nick, mb.mb_category from g5_helpme as he left join g5_member as mb on mb.mb_id = he.mb_id where he.idx = '{$idx}'; ");

if($help['del_yn'] == 'Y') { // 삭제한 질문에 접근 시 튕김
    alert('올바른 경로가 아닙니다.');
}

$view_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$idx} and mode = 'view' order by idx desc limit 1 ")['acc_count']; // 조회 누적카운트
$good_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$idx} and mode = 'good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
$hate_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$idx} and mode = 'hate' order by idx desc limit 1 ")['acc_count']; // 싫어요 누적카운트
$answer_count = selectCount("g5_helpme_answer", "helpme_idx", $idx);

//해시태그
$hashtag = '';
if(!empty($help['he_hashtag'])) {
    $tag = explode(',',$help['he_hashtag']);
    for($j=0; $j<count($tag); $j++) {
        $hashtag .= '<li onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
    }
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#wrapper{background:#fff; margin:0;}
	#container{padding:0;}
	#area_help{padding:40px 0 0; background:#f2f5f8;}

	@media screen and (max-width:1023px) {
		#area_help{padding:20px 0 0;}
	}
	@media screen and (max-width:768px) {
		#area_help{padding:15px 0 0;}
	}
	@media screen and (max-width:550px) {
		#area_help{padding:10px 0 0;}
	}
</style>

<?php include_once('./category_modal.php'); ?>

<div id="area_help">
	<div class="inr">
		<div id="top_bn">
			<div class="txt">
				<h2>헬프미</h2>
				<span>조선, 해양 관련 어떤 것이든 물어보세요!</span>
			</div>
			<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
		</div>
		<div id="help_warp">
			<?php include_once('./left_menu.php'); ?>
			<div id="help_list">
				<!-- 카테고리
				<div class="mbox_cate">
					<span data-toggle="modal" data-target="#cateModal"><i></i>전체</span>
				</div>
				-->

				<div class="help_question">
					<div class="title">
						<h3><?php if(!empty($help['he_bunker'])) { ?><i><?=number_format($help['he_bunker'])?></i><?php } ?><?=$help['he_subject']?></h3>
                        <?php if($help['mb_id'] == $member['mb_id']) { // 본인이 쓴 글이면 보임?>
						<a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
						<ul class="edit_list edit_list_q" style="display: none;">
							<li class="modify"><a href="<?=G5_BBS_URL?>/help_write.php?idx=<?=$help['idx']?>&w=u">수정</a></li>
							<li class="delete"><a href="javascript:help_action_chk('help');">삭제</a></li>
						</ul>
                        <?php } ?>
					</div>
					<div class="bottom">
						<div class="cont"><?=$help['he_contents']?></div>
						<ul class="tag">
                            <?=$hashtag?>
						</ul>
						<div class="info">
							<ul class="thums">
								<li class="good" onclick="help_action('good');"><i></i><span id="good_count"><?=number_format($good_count)?></span></li><!--좋아요-->
								<li class="bad" onclick="help_action('hate');"><i></i><span id="hate_count"><?=number_format($hate_count)?></span></li><!--싫어요-->
							</ul>
							<div class="list_info">
								<span class="id">
                                    <div class="profile">
                                        <?php if(!empty(getProfileImage($help['mb_id'])) && $help['mb_category'] == '일반') { ?>
                                        <img src="<?php echo G5_DATA_URL ?>/file/member/<?=getProfileImage($help['mb_id'])?>">
                                        <?php } else { ?>
                                        <img class="basic" src="<?php echo G5_IMG_URL ?>/img_smile.svg">
                                        <?php } ?>
                                    </div>
                                    <?php echo !empty($help['mb_nick']) ? $help['mb_nick'] : $help['mb_id']; ?>
                                </span><!--아이디-->
								<span class="data"><?=str_replace('-','.',substr($help['wr_datetime'],0,10))?></span><!--등록일-->
								<span class="view">조회수 <em id="view_count"><?=number_format($view_count)?></em></span><!--조회수-->
							</div>
						</div>
					</div>
				</div>

                <?php if($member['mb_id'] != $help['mb_id']) { // 본인 질문에는 답변 달 수 없음(미정) ?>
				<div class="line"></div>

                <form id="fanswer" name="fanswer" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/help_view_update.php">
                    <input type="hidden" id="helpme_idx" name="helpme_idx" value="<?=$idx?>">
                    <input type="hidden" id="helpme_an_idx" name="helpme_an_idx">
                    <input type="hidden" id="an_contents" name="an_contents">
                    <input type="hidden" id="an_hashtag" name="an_hashtag">
                    <input type="hidden" id="w" name="w">
                    <div class="help_write">
                        <div class="title">
                            <h3>
                                <div class="profile">
                                    <?php if(!empty(getProfileImage($member['mb_id'])) && $member['mb_category'] == '일반') { ?>
                                    <img style="border-radius: 50%;" src="<?php echo G5_DATA_URL ?>/file/member/<?=getProfileImage($member['mb_id'])?>">
                                    <?php } else { ?>
                                    <img class="basic" src="<?php echo G5_IMG_URL ?>/img_smile.svg">
                                    <?php } ?>
                                </div>
                                <span class="bold"><?php echo !empty($member['mb_nick']) ? $member['mb_nick'] : $member['mb_id']; ?></span>님, 당신의 지식을 공유해 주세요!</h3>
                        </div>

                        <div class="bottom" id="editor" style="display: none;"></div>
                        <!-- 에디터넣어주세용~~ -->
                    </div>
					<div class="w_filter hash">
                        <h3>#해시태그</h3>
                        <div class="area_tag">
                            <input type="text" class="input_tag" id="input_tag" placeholder="#답변에 맞는 태그를 입력해 주세요(엔터로 구분, 최대 5개)" onkeyup="add_hash(this);">
                            <ul class="tag_list">
                            </ul>
                        </div>
                    </div>
                    <div class="w_filter">
                        <h3>공개설정</h3>
                        <ul class="area_filter">
                            <li>
                                <input type="checkbox" id="open" checked name="an_open" value="open" onclick="checkOnlyOne(this);">
                                <label for="open">
                                    <span></span>
                                    <em>전체공개</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="private" name="an_open" value="private" onclick="checkOnlyOne(this);">
                                <label for="private">
                                    <span></span>
                                    <em>비공개</em>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="btn_confirm" onclick="helpme_answer_register();">등록하기</button>
                </form>
                <?php } ?>

				<div class="line"></div>
				<div class="area_answer">
					<h2>총 <?=number_format($answer_count)?>개의 답변이 있습니다.</h2>
                    <?php
                    // 답변 리스트
                    $sql = " select an.*, mb.mb_nick, mb.mb_grade, mb.mb_category from g5_helpme_answer as an left join g5_member as mb on an.mb_id = mb.mb_id where helpme_idx = '{$idx}' order by an.wr_datetime desc ";
                    $result = sql_query($sql);

                    // 질문에 대한 채택답변 유무
                    $selection_flag = false;
                    $selection = selectCount('g5_helpme_answer', 'helpme_idx', $idx, 'an_selection', 'Y');
                    if($selection > 0) { $selection_flag = true; }
                    // 질문 작성자만 채택 가능
                    if($help['mb_id'] != $member['mb_id']) { $selection_flag = true; }

                    for($i=0; $row=sql_fetch_array($result); $i++) {
                        //해시태그
                        $an_tag = explode(',',$row['an_hashtag']);
                        $an_hashtag = '';
                        for($k=0; $k<count($an_tag); $k++) {
                            $an_hashtag .= '<li onclick="tag_search(\''.$an_tag[$k].'\');">'.$an_tag[$k].'</li>';
                        }

                        // 좋아요
                        $answer_good_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_an_idx = {$row['idx']} and mode = 'answer_good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                        // 싫어요
                        $answer_hate_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_an_idx = {$row['idx']} and mode = 'answer_hate' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                        // 댓글
                        $answer_reply_count = selectCount("g5_helpme_answer_reply", 'helpme_an_idx', $row['idx']);

                        // 채택 표시
                        $an_selection = '';
                        if($row['an_selection'] == 'Y') {
                            $an_selection = 'style="display: block;"';
                        }
                        else {
                            $an_selection = 'style="display: none;"';
                        }

                        // 채택답변수 (* 삭제된 질문은 제외하지 않음, 제외 필요하면 쿼리 수정)
                        $select_count = selectCount('g5_helpme_answer', 'mb_id', $row['mb_id'], 'an_selection', 'Y');
                    ?>
                    <!-- 답변 -->
                    <div class="help_question">
                        <!-- 채택된 답변 표시 아이콘-->
                        <div class="area_select area_select_<?=$row['idx']?>" <?=$an_selection?>>
                            <span></span>
                            <em>채택</em>
                        </div>
                        <div class="title">
                            <div class="profile">
                                <?php if(!empty(getProfileImage($row['mb_id'])) && $row['mb_category'] == '일반') { ?>
                                <img src="<?php echo G5_DATA_URL ?>/file/member/<?=getProfileImage($row['mb_id'])?>">
                                <?php } else { ?>
                                <img class="basic" src="<?php echo G5_IMG_URL ?>/img_smile.svg">
                                <?php } ?>
                            </div> <!-- 프로필사진 -->
                            <div class="profile_info">
                                <h4><?php echo !empty($row['mb_nick']) ? $row['mb_nick'] : $row['mb_id']; ?></h4> <!-- 아이디 or 닉네임 -->
                                <div class="list_info">
                                    <span class="lv"><?=$row['mb_grade']?></span> <!-- 등급 -->
                                    <span class="s_answer">채택답변수 <em><?=number_format($select_count)?></em></span> <!-- 이 회원의 현재까지 채택된 답변 수 -->
                                    <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span> <!-- 등록일 -->
                                </div>
                            </div>
                            <?php if(!$selection_flag) { ?>
							<a class="answer_select" href="javascript:help_action('select', <?=$row['idx']?>);"><span></span><em>채택<em class="mhide">하기</em></em></a>
                            <?php } ?>
                        </div>

                        <div class="area_bottom">
                            <div class="bottom">
                                <div class="cont"><?=$row['an_contents']?></div>
                                <ul class="tag">
                                    <?=$an_hashtag?>
                                </ul>
                                <div class="info">
                                    <?php if($member['mb_id'] == $row['mb_id']) { // 본인이 쓴 글이면 보임 ?>
                                    <a href="javascript:edit_open('edit_list_<?=$row['idx']?>');" class="btn_more"></a>
                                    <ul class="edit_list edit_list_<?=$row['idx']?>" style="display: none;">
                                        <li class="modify"><a href="javascript:help_action('answer_update', <?=$row['idx']?>);">수정</a></li>
                                        <li class="delete"><a href="javascript:help_action_chk('answer', <?=$row['idx']?>, '<?=$row['an_selection']?>');">삭제</a></li>
                                    </ul>
                                    <?php } ?>
                                    <ul class="thums">
                                        <li class="good" onclick="help_action('answer_good', <?=$row['idx']?>);"><i></i><span id="answer_good_count_<?=$row['idx']?>"><?=number_format($answer_good_count)?></span></li> <!-- 좋아요 -->
                                        <li class="bad" onclick="help_action('answer_hate', <?=$row['idx']?>);"><i></i><span id="answer_hate_count_<?=$row['idx']?>"><?=number_format($answer_hate_count)?></span></li> <!-- 싫어요 -->
                                        <li class="comment comment_<?=$row['idx']?>"><i></i><span id="answer_reply_count_<?=$row['idx']?>"><?=number_format($answer_reply_count)?></span></li> <!-- 댓글수 -->
                                    </ul>
                                </div>
                            </div>
                            <!-- 댓글 -->
                            <div class="area_comment area_comment_<?=$row['idx']?>">
                                <div class="area_input">
                                    <input type="text" class="w_input" id="input_reply_<?=$row['idx']?>" name="input_reply_<?=$row['idx']?>" placeholder="댓글을 등록해 주세요.">
                                    <button type="button" class="btn_comment btn_comment_<?=$row['idx']?>" onclick="reply_action(<?=$row['idx']?>, '');">등록</button>
                                </div>
                                <ul class="list_comment list_comment_<?=$row['idx']?>">
                                    <?php
                                    $sql_reply = " select re.*, mb.mb_nick from g5_helpme_answer_reply as re left join g5_member as mb on re.mb_id = mb.mb_id where helpme_an_idx = {$row['idx']} order by wr_datetime desc ";
                                    $result_reply = sql_query($sql_reply);

                                    for($a=0; $reply=sql_fetch_array($result_reply); $a++) {
                                    ?>
                                    <li>
                                        <h3><?php echo !empty($reply['mb_nick']) ? $reply['mb_nick'] : $reply['mb_id']; ?></h3>
                                        <span><?=$reply['contents']?></span>
                                        <em><?=str_replace('-','.',substr($reply['wr_datetime'],0,10))?></em>

                                        <?php if($member['mb_id'] == $reply['mb_id']) { ?>
										<!-- 댓글 수정 삭제 -->
										<ul class="edit">
											<li class="modify"><a href="javascript:reply_action_info(<?=$row['idx']?>, <?=$reply['idx']?>, '<?=$reply['contents']?>')">수정</a></li>
											<li class="delete"><a href="javascript:reply_action(<?=$row['idx']?>, 'd', <?=$reply['idx']?>);">삭제</a></li>
										</ul>
										<!-- //댓글 수정 삭제 -->
                                        <?php } ?>
									</li>
                                    <?php
                                    }
                                    if($a==0) {
                                    ?>
                                    <!--<li><span>등록된 댓글이 없습니다.</span></li>-->
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- //댓글 -->
                        </div>
                    </div>
                    <!-- //답변 -->
                    <?php
                    }
                    ?>
				</div>
				<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/help_list.php"><span>목록</span><a></div>
			</div>
			<?php include_once('./myinfo.php'); ?>
		</div>
	</div>
</div>

<!-- 비슷한 질문-->
<div id="area_question">
	<div class="inr v2">
		<h3>비슷한 질문을 확인해 보세요!</h3>
		<ul class="list">
			<li>
				<a href="">
					<h3>지방대 4년제 조선해양공학과를 졸업했습니다. 지방대 4년제 조선해양공학과를 졸업했습니다.</h3>
					<span>학점은 2.3으로 매우 낮은편이고 , 현재 나이 26살입니다. 울산쪽에 살고 있어서 중견 화학단지쪽으로 가고..</span>
					<div class="list_info">
						<span class="view">조회수 <em>14</em></span> <!-- 조회수 -->
						<span class="reply">답변수 <em>0</em></span> <!-- 답변수 -->
						<span class="good"><i></i><em>2</em></span> <!-- 좋아요 -->
					</div>
				</a>
			</li>
			<li>
				<a href="">
					<h3>지방대 4년제 조선해양공학과를 졸업했습니다.</h3>
					<span>학점은 2.3으로 매우 낮은편이고 , 현재 나이 26살입니다. 울산쪽에 살고 있어서 중견 화학단지쪽으로 가고..</span>
					<div class="list_info">
						<span class="view">조회수 <em>14</em></span> <!-- 조회수 -->
						<span class="reply">답변수 <em>0</em></span> <!-- 답변수 -->
						<span class="good"><i></i><em>2</em></span> <!-- 좋아요 -->
					</div>
				</a>
			</li>
			<li>
				<a href="">
					<h3>지방대 4년제 조선해양공학과를 졸업했습니다.</h3>
					<span>학점은 2.3으로 매우 낮은편이고 , 현재 나이 26살입니다. 울산쪽에 살고 있어서 중견 화학단지쪽으로 가고..</span>
					<div class="list_info">
						<span class="view">조회수 <em>14</em></span> <!-- 조회수 -->
						<span class="reply">답변수 <em>0</em></span> <!-- 답변수 -->
						<span class="good"><i></i><em>2</em></span> <!-- 좋아요 -->
					</div>
				</a>
			</li>
			<li>
				<a href="">
					<h3>지방대 4년제 조선해양공학과를 졸업했습니다.</h3>
					<span>학점은 2.3으로 매우 낮은편이고 , 현재 나이 26살입니다. 울산쪽에 살고 있어서 중견 화학단지쪽으로 가고..</span>
					<div class="list_info">
						<span class="view">조회수 <em>14</em></span> <!-- 조회수 -->
						<span class="reply">답변수 <em>0</em></span> <!-- 답변수 -->
						<span class="good"><i></i><em>2</em></span> <!-- 좋아요 -->
					</div>
				</a>
			</li>
		</ul>
	</div>
</div>

<script>
var g_class = '';
$(function(){
    // 댓글 버튼 클릭
	$('#help_list .help_question .info .thums > li.comment').on('click',function(){
	    var temp = $(this)[0].className.split(' ')[1];
	    var idx = temp.split('_')[1];

	    if(g_class != idx) {
            $('.comment').removeClass('active');
            $('.area_comment').removeClass('active');
        }
	    g_class = idx;

		$(this).toggleClass('active');
		$('.area_comment_'+idx).toggleClass('active');
		return false;
	});

    // summernote
    var editor = $('#editor').summernote({
        height: 300, //(mobilecheck())? 150 : 300,
        lang: 'ko-KR',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'undo', 'redo']],
        ],
        callbacks: {
            onImageUpload:function(files){ // 이미지 업로드
                sendFile(editor, files[0]);
            }
        }
    });

    // 조회/좋아요/싫어요 동작
    help_action('view');
});

// 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
function click_event(object, element, class_name, column) {
    $('.'+object+' li').removeClass(class_name);
    element.addClass(class_name);
    $('#'+column).val(element[0]['innerText']);

    $('#fsearch').submit();
}

// 수정/삭제
$(document).click(function(e) {
    if (!$(e.target).hasClass('btn_more')) { // btn_more가 포함된 영역 밖 클릭 시 수정/삭제 영역 숨김
        $('.edit_list').attr('style', 'display: none;');
    }
});
var g_class2 = '';
function edit_open(mode) { // mode : 각 답변에 적용된 클래스
    if(g_class2 != mode) {
        $('.edit_list').attr('style', 'display: none;');
    }
    g_class2 = mode;

    if($('.'+mode).attr('style').indexOf('block') != -1) {
        $('.'+mode).attr('style', 'display: none;');
    } else {
        $('.'+mode).attr('style', 'display: block;');
    }
}

// 삭제 전 삭제 확인 체크 (op : 구분(질문 or 답변) / idx : 답변 idx / selection : 답변 채택 여부)
function help_action_chk(op, idx, selection) {
    var txt = '질문';
    if(op == 'answer') { txt = '답변'; }

    if(op == 'answer' && selection == 'Y') {
        swal('채택된 답변은 삭제할 수 없습니다.');
        return false;
    }

    swal({
        text: txt + "을 삭제하시겠습니까?",
        icon: "warning",
        buttons: {
            defeat: "확인",
            cancel: "취소",
        },
    })
    .then((value) => {
        switch (value) {
            case "defeat":
                if(op == 'help') {
                    help_action("delete"); // 질문삭제
                }
                else {
                    help_action("answer_delete", idx); // 답변삭제
                }
            case "cancel":
                return false;
        }
    });
    $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
}

// 조회/좋아요/싫어요 동작 (액션, idx)
function help_action(mode, idx) {
    if(mode == 'answer_update') { // 답변 수정 -- 답변 내용이 답변 등록 폼에 보여짐
        $('.edit_list_'+idx).attr('style', 'display:none;');

        $.ajax({
            url : g5_bbs_url + "/ajax.help_answer_info.php",
            data: {idx : idx},
            type: 'POST',
            cache: false,
            async: false,
            dataType: 'json',
            success : function(data) {
                // 내용
                $('.note-editable').html(data.an_contents);
                // 해시태그
                $('#an_hashtag').val(data.input_an_hashtag);
                $('.tag_list').html(data.an_hashtag);
                num = $('.tag_word').length + 1;
                // 공개설정
                $("input:checkbox[name='an_open']").prop("checked", false);
                $("input:checkbox[id='"+data.an_open+"']").prop('checked', true);

                // 답변 등록 폼으로 위치 이동
                var offset = $('#fanswer').offset();
                $('html, body').animate({scrollTop : offset.top}, 100);
                $('.btn_confirm').text('수정하기');
                $('#w').val('u');
                $('#helpme_an_idx').val(idx);
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
    else {
        $.ajax({
            url : g5_bbs_url + "/ajax.help_action.php",
            data: {mode : mode, helpme_idx : '<?=$idx?>', helpme_an_idx : idx},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    if(mode == 'answer_delete') {
                        swal("답변이 삭제되었습니다.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/help_view.php?idx=<?=$idx?>');
                        });
                    }
                    else if(mode == 'delete') {
                        swal("질문이 삭제되었습니다.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/help_list.php');
                        });
                    }
                    else if(mode == 'select') {
                        swal("답변을 채택하였습니다.")
                        .then(()=>{
                            $('.answer_select').attr('style', 'display: none;');
                            $('.area_select_'+idx).attr('style', 'display: block;');
                        });
                    }
                    else {
                        if(mode == 'answer_good' || mode == 'answer_hate') {
                            $('#'+mode+'_count_'+idx).text(data);
                        }
                        else {
                            $('#'+mode+'_count').text(data);
                        }
                    }
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
}

// #해시태그 등록
var num = 1;
var hashtag = "";
function add_hash(data) {
    if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
        event.preventDefault();

        // 빈칸 체크
        if($.trim(data.value).length == 0) {
            swal('태그를 입력해 주세요.');
            return false;
        }
        // 최대 5개 처리
        if($('.tag_word').length == 5) {
            swal('최대 5개까지 등록할 수 있습니다.');
            return false;
        }
        var tag = '<li class="tag_'+num+'"><span class="tag_word">#'+data.value+'<button type="button" class="btn_close" onclick="del_hash('+num+');"></button></span></li>';
        $('.tag_list').append(tag);
        $('#input_tag').val('');
        num++;
    }
}

// #해시태그 삭제
function del_hash(num) {
    $('.tag_'+num).remove();
}

// 답변등록
var is_post = false; // 중복 submit 체크
function helpme_answer_register() {
    if(is_post) {
        return false;
    }
    is_post = true;

    if($.trim($('.note-editable').text()).length != 0) {
        $('#an_contents').val($('.note-editable').html()); // 내용
    }

    $('.tag_list li span').each(function() {
        hashtag += $(this).text() + ',';
    });
    hashtag = hashtag.slice(0, -1);
    $('#an_hashtag').val(hashtag); // 해시태그

    var f = $('#fanswer')[0];
    if(f.an_contents.value == "") {
        swal('내용을 입력해 주세요.');
        is_post = false;
        return false;
    }
    // if($('.tag_word').length == 0) {
    //     swal('해시태그를 입력해 주세요.');
    //     is_post = false;
    //     return false;
    // }

    $('#fanswer').submit();
}

// 댓글 수정 시 댓글 입력 폼에 내용 보여줌 (답변 idx, 댓글 idx, 댓글 내용)
function reply_action_info(idx, reply_idx, contents) {
    $('#input_reply_'+idx).val(contents);
    $('.btn_comment_'+idx).text('수정');
    $('.btn_comment_'+idx).attr('onclick', 'reply_action('+idx+', "u", '+reply_idx+');');
}

// 댓글등록/수정/삭제 (답변 idx, 구분, 댓글 idx)
var is_post2 = false; // 중복 submit 체크
function reply_action(idx, w, reply_idx) {
    if(is_post2) {
        return false;
    }
    is_post2 = true;

    if(w == '' || w == 'u') {
        if($.trim($('#input_reply_'+idx).val()).length == 0) {
            swal("내용을 입력해 주세요.");
            is_post2 = false;
            return false;
        }
    }
    $('.reply_count').remove(); // 삭제 후 사용 -- 댓글 추가할 때 마다 중복되기 때문에
    
    var txt = '';
    if(w == '') {
        txt = '등록';
    }
    else if(w == 'u') {
        txt = '수정';
    }
    else if(w == 'd') {
        txt = '삭제';
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.help_answer_reply.php",
        data: {helpme_an_idx : idx, contents : $('#input_reply_'+idx).val(), w : w, reply_idx : reply_idx},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            swal('댓글이 '+txt+'되었습니다.')
            .then(()=>{
                $('.list_comment_'+idx).html(data); // 리스트 초기화
                $('#answer_reply_count_'+idx).text($('.reply_count').val()); // 답변에 대한 댓글 총 개수
                $('#input_reply_'+idx).val(''); // 댓글 입력 폼 초기화
                $('.btn_comment_'+idx).text('등록');
                $('.btn_comment_'+idx).attr('onclick', 'reply_action('+idx+', "");');

                if($('.list_comment_'+idx+' li').length == 0) {
                    $('#answer_reply_count_'+idx).text(0);
                    $('.comment').removeClass('active');
                }

                is_post2 = false;
            });
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
    $('#sch_txt').val(tag);
    $('#fsearch').submit();
}
</script>

<?php
include_once(G5_BBS_URL.'/help_list_search_script.php');
include_once('./_tail.php');
?>