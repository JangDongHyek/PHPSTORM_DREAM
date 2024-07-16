<?
include_once('./_common.php');

$g5['title'] = 'Help Me';
include_once('./_head.php');

if(!$is_member) {
    alert('Please try again after logging in.', G5_BBS_URL.'/login.php');
}

$help = sql_fetch(" select he.*, mb.mb_no, mb.mb_nick, mb.mb_category from g5_helpme as he left join g5_member as mb on mb.mb_id = he.mb_id where he.idx = '{$idx}'; ");

if($help['del_yn'] == 'Y') { // 삭제한 질문에 접근 시 튕김
    alert('Not the correct path.');
}

$view_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$idx} and mode = 'view' order by idx desc limit 1 ")['acc_count']; // 조회 누적카운트
$good_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$idx} and mode = 'good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
$hate_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$idx} and mode = 'hate' order by idx desc limit 1 ")['acc_count']; // 싫어요 누적카운트
$answer_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = {$idx} and del_yn is null ")['count'];

//해시태그
$hashtag = '';
$regexp = ''; // 하단 비슷한질문에 사용
if(!empty($help['he_hashtag'])) {
    $tag = explode(',',$help['he_hashtag']);
    for($j=0; $j<count($tag); $j++) {
        $hashtag .= '<li onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
        $regexp .= $tag[$j].'|';
    }
}
$regexp = substr($regexp, 0, -1);

// 관심친구 확인
$fri_rlt = sql_query(" select * from g5_like_friend where mb_id = '{$member['mb_id']}'; ");
$fri_arr = array();
while($fri = sql_fetch_array($fri_rlt)) {
    array_push($fri_arr, $fri['friend_mb_id']);
}

// 질문에 대한 채택답변 유무
$selection_flag = false;
$selection = selectCount('g5_helpme_answer', 'helpme_idx', $idx, 'an_selection', 'Y');
if($selection > 0) { $selection_flag = true; } // 채택된 답변 있음

// 질문에 대한 답변작성 유무
$reply_flag = false;
$reply = selectCount_n("g5_helpme_answer", "helpme_idx=".$idx, "mb_id='".$member['mb_id']."'", "del_yn is null");
if($reply > 0) { $reply_flag = true; } // 작성한 답변 있음
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#wrapper{background:#fff; margin:0;}
	#container{padding:0;}
	#area_help{padding:40px 0 60px; background:#f2f5f8;}

	@media screen and (max-width:1023px) {
		#area_help{padding:20px 0 0;}
	}
	@media screen and (max-width:768px) {
		#area_help{padding:15px 0 0;}
	}
	@media screen and (max-width:550px) {
		#area_help{padding:10px 0 0;}
	}

    .help_write .profile img{border-radius:50px !important;}
</style>

<?php include_once('./category_modal.php'); ?>

<!-- 답변 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade select" id="edit_home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Choose</h4>
                </div>
                <div class="modal-body">
					<ul class="list_edit">
						<li><a href="javascript:void(0);">Best answer</a></li>
						<li class="deactivate"><a href="javascript:void(0);">Great answer</a></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 답변 모달팝업 -->

<!-- 답변 모달팝업2 -- 베스트 답변 채택 후 마감 or 우수 답변 채택 여부 선택 알림창 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="edit_home2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                        <em>You accepted the best answer. <br>Are you sure you want to close?</em>
                    </div>
                    <ul class="madal_btn">
                        <li class="ok">To close</li>
                        <li class="ok">Choose the best answer</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 답변 모달팝업2 -->

<!-- 답변 모달팝업3 -- 답변이 총 2개 이상일 때 우수 답변 채택하기 선택 시 24시간 이내 선택 유도 알림창 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="edit_home3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                        <em>If the best answer is not accepted within 24 hours, <br>the manager can accept the answer.</em>
                    </div>
                    <ul class="madal_btn">
                        <li>Cancel</li>
                        <li class="ok">Confirm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 답변 모달팝업3 -->

<!-- 답변 모달팝업4 -- 답변이 총 1개일 때 우수 답변 채택하기 선택 시 채택할 답변 없다는 알림창 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="edit_home4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                        <em>There is no answer to accept. <br>Are you sure you want to close?</em>
                    </div>
                    <ul class="madal_btn">
                        <li>Cancel</li>
                        <li class="ok">To close</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 답변 모달팝업4 -->

<?php
// 프로필 모달
include_once('./profile_modal.php');
?>

<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>

<div id="area_help" class="help_view">
	<div class="inr">
		<div id="top_bn">
			<div class="txt">
				<h2>Help Me</h2>
				<span>Ask us about anything related to shipbuilding and offshore business!</span>
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

				<div class="help_question top">
					<div class="title">
						<h3><?php if(!empty($help['he_bunker'])) { ?><i><?=number_format($help['he_bunker'])?></i><?php } ?><?=$help['he_subject']?></h3>
                        <?php if(($help['mb_id'] == $member['mb_id'] && !$selection_flag && empty($answer_count))) { // 작성자 == 로그인자 && 채택된 답변 없어야 함 && 답변이 0개?>
						<a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
						<ul class="edit_list edit_list_q" style="display: none;">
                            <li class="modify"><a href="<?=G5_BBS_URL?>/help_write.php?idx=<?=$help['idx']?>&w=u">Edit</a></li>
                            <li class="delete"><a href="javascript:help_action_chk('help');">Delete</a></li>
						</ul>
                        <?php } else if($is_admin) { // 관리자?>
                        <a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
                        <ul class="edit_list edit_list_q" style="display: none;">
                            <li class="delete"><a href="javascript:help_action_chk('help');">Delete</a></li>
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
								<li class="good li_good <?=actionCheck('helpme', 'good', $member['mb_id'], $help['idx']);?>" onclick="help_action('good');"><i></i><span id="good_count"><?=number_format($good_count)?></span></li><!--좋아요-->
								<li class="bad li_hate <?=actionCheck('helpme', 'hate', $member['mb_id'], $help['idx']);?>" onclick="help_action('hate');"><i></i><span id="hate_count"><?=number_format($hate_count)?></span></li><!--싫어요-->
							</ul>
							<div class="list_info">
								<span class="id toggle" onclick="userToggle('user_list_main');">
                                    <div class="profile">
                                    <?php echo getProfileImg($help['mb_id'], $help['mb_category']); ?>
                                    </div>
                                    <?php echo !empty($help['mb_nick']) ? $help['mb_nick'] : $help['mb_id']; ?>
                                </span><!--아이디-->
								<span class="data"><?=str_replace('-','.',substr($help['wr_datetime'],0,10))?></span><!--등록일-->
								<span class="view">Views <em id="view_count"><?=number_format($view_count)?></em></span><!--조회수-->
                                <?php
                                $txt = 'Add friend';
                                $mode = 'add';
                                if(in_array($help['mb_id'], $fri_arr)) { // 관심친구에 있음
                                    $txt = 'Delete friend';
                                    $mode = 'del';
                                }
                                $self = $member['mb_id'] != $help['mb_id'] ? false : true; // 내가쓴글인지?
                                ?>

                                <!-- 토글메뉴 -->
                                <ul class="user_list_main user_list sm">
                                <?php if($help['mb_category'] == '일반') { // 작성자일반회원?>
                                <li onclick="profileOpen('<?=$help['mb_category']?>', '<?=$help['mb_id']?>')">View Profile</li>
                                <?php } ?>
                                <?php if(!$self && $help['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                <li onclick="likeFriend('<?=$help['mb_id']?>', '<?=$mode?>');"><?=$txt?></li> <!--친구등록/삭제-->
                                <?php } ?>
                                <?php if($help['mb_category'] == '기업') { // 작성자기업회원?>
                                <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$help['mb_no']?>">Go to Company Homepage</a></li>
                                <li>Number of requests <em class="blue"><?=inquiryCount($help['mb_id'])?></em></li>
                                <li>Transactions <em class="blue"><?=completeCount($help['mb_id'])?></em></li>
                                <?php } ?>
                                <?php if(!$self && $help['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                <li onclick="chatting('<?=$help['mb_id']?>');">Chat</li>
                                <?php } ?>
                                <?php if(!$self) { // 내가쓴글아님?>
                                <li onclick="reportOpen('<?=$help['mb_id']?>', 'g5_helpme', '<?=$help['idx']?>')">Report</li>
                                <?php } ?>
                                </ul>
                                <!-- //토글메뉴 -->
                            </div>
						</div>
					</div>
				</div>

                <?php if($help['he_answer_state'] == '답변대기') { // 질문이 답변대기 상태?>
                <?php if($member['mb_id'] != $help['mb_id']) { // 본인 질문에는 답변 달 수 없음 ?>
                <div class="anwser_area <?php echo $reply_flag ? 'noshow' : ''; ?>">
				<div class="line"></div>

                <form id="fanswer" name="fanswer" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/help_view_update.php">
                    <input type="hidden" id="helpme_idx" name="helpme_idx" value="<?=$idx?>">
                    <input type="hidden" id="helpme_an_idx" name="helpme_an_idx">
                    <input type="hidden" id="an_hashtag" name="an_hashtag">
                    <input type="hidden" id="w" name="w">
                    <div class="help_write" >
                        <div class="title" >
							<h3 class="answer">
                                <div class="profile">
                                <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
                                </div>
                                <span class="bold"><?php echo !empty($member['mb_nick']) ? $member['mb_nick'] : $member['mb_id']; ?></span>, please share your knowledge!
                            </h3>
                        </div>

                        <!-- 에디터넣어주세용~~ -->
                        <div class="bottom" id="editor" style="display: none;"></div>
                        <textarea id="an_contents" name="an_contents" class="noshow"><?=$an['an_contents']?></textarea>
                    </div>
					<div class="w_filter hash">
                        <h3>#HASHTAG</h3>
                        <div class="area_tag">
                            <input type="text" class="input_tag" id="input_tag" placeholder="#Enter tag relating to the answer (separate by enter key, up to 5 entries)" onkeyup="add_hash(this);lengthChk(this);">
                            <ul class="tag_list">
                            </ul>
                        </div>
                    </div>
                    <div class="w_filter">
                        <h3>Privacy settings</h3>
                        <ul class="area_filter">
                            <li>
                                <input type="checkbox" id="open" checked name="an_open" value="open" onclick="checkOnlyOne(this);">
                                <label for="open">
                                    <span></span>
                                    <em>Public</em>
                                </label>
                            </li>
							<li>
                                <input type="checkbox" id="questioner" name="an_open" value="questioner" onclick="checkOnlyOne(this);">
                                <label for="questioner">
                                    <span></span>
                                    <em>Show only to question giver</em>
                                </label>
                            </li>
							<!--
                            <li>
                                <input type="checkbox" id="private" name="an_open" value="private" onclick="checkOnlyOne(this);">
                                <label for="private">
                                    <span></span>
                                    <em>비공개</em>
                                </label>
                            </li>
							-->
                        </ul>
                    </div>
                    <button type="button" class="btn_confirm" onclick="helpme_answer_register();">Post answer</button>
                </form>
                </div>
                <?php } ?>
                <?php } ?>

				<div class="line"></div>
				<div class="area_answer">
					<h2>There is a total of <span id="answer_count"><?=number_format($answer_count)?></span>answer(s).</h2>
                    <?php
                    // 답변 리스트
                    $sql = " select an.*, mb.mb_no, mb.mb_nick, mb.mb_grade, mb.mb_category from g5_helpme_answer as an left join g5_member as mb on an.mb_id = mb.mb_id where helpme_idx = '{$idx}' and an.del_yn is null order by an.wr_datetime desc ";
                    $result = sql_query($sql);

                    $best_flag = false; // 베스트 답변 채택 유무
                    $best = selectCount('g5_helpme_answer', 'helpme_idx', $idx, 'an_best', 'Y');
                    if($best > 0) { $best_flag = true; }

                    $great_flag = false; // 우수 답변 채택 유무
                    $great = selectCount('g5_helpme_answer', 'helpme_idx', $idx, 'an_great', 'Y');
                    if($great > 0) { $great_flag = true; }

                    for($i=0; $row=sql_fetch_array($result); $i++) {
                        //해시태그
                        $an_hashtag = '';
                        if(!empty($row['an_hashtag'])) {
                            $an_tag = explode(',',$row['an_hashtag']);
                            for($k=0; $k<count($an_tag); $k++) {
                                $an_hashtag .= '<li onclick="tag_search(\''.$an_tag[$k].'\');">'.$an_tag[$k].'</li>';
                            }
                        }

                        // 좋아요
                        $answer_good_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_an_idx = {$row['idx']} and mode = 'answer_good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                        // 싫어요
                        $answer_hate_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_an_idx = {$row['idx']} and mode = 'answer_hate' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                        // 댓글
                        $answer_reply_count = sql_fetch( " select count(*) as count from g5_helpme_answer_reply where helpme_an_idx = '{$row['idx']}' and del_yn is null ")['count'];

                        // 채택 표시
                        $an_selection = '';
                        if($row['an_selection'] == 'Y') {
                            $an_selection = 'style="display: block;"';
                        }
                        else {
                            $an_selection = 'style="display: none;"';
                        }

                        // 채택답변수 (* 채택된 질문 중 삭제된 질문이 있어도 제외하지 않음, 제외 필요하면 쿼리 수정)
                        $select_count = selectCount('g5_helpme_answer', 'mb_id', $row['mb_id'], 'an_selection', 'Y');

                        $display = true;
                        if($row['an_open'] == 'questioner') { // 공개설정 질문자만 공개 시 질문자와 답변 작성자에게만 답변이 보여짐
                            if($row['mb_id'] != $help['mb_id'] && $row['mb_id'] != $member['mb_id'] && $help['mb_id'] != $member['mb_id']) { // 댓글작성자 != 헬프미 작성자 || 댓글작성자 != 로그인자 || 헬프미작성자 != 로그인자
                                $display = false;
                            }
                        }
                        /*if($row['an_open'] == 'private') { // 공개설정 비공개 시 답변 작성자에게만 답변이 보여짐
                            if($row['mb_id'] != $member['mb_id']) {
                                $display = false;
                            }
                        }*/
                    ?>
                    <!-- 답변 -->
                    <div class="help_question help_answer">
                        <!-- 채택된 답변 표시 아이콘-->
                        <div class="area_select area_select_<?=$row['idx']?>" <?=$an_selection?>>
                            <span></span>
                            <em><?php echo $row['an_best'] == 'Y' ? 'BEST' : 'GREAT'; ?></em>
                        </div>
                        <div class="title">
                            <div class="area_name" onclick="userToggle('answer_<?=$row['idx']?>');">
                                <div class="profile">
                                <?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?>
                                </div> <!-- 프로필사진 -->
                                <div class="profile_info">
                                    <h4 class="toggle">
                                    <?php echo getNickOrId($row['mb_id']); ?><!-- 아이디 or 닉네임 -->

                                    <!-- 친구등록 버튼 클릭하면 class="on" 추가-->
                                    <?php
                                    $fri_class = '';
                                    $txt2 = 'Add friend';
                                    $mode2 = 'add';
                                    if(in_array($row['mb_id'], $fri_arr)) { // 관심친구에 있음
                                        $fri_class = 'on';
                                        $txt2 = 'Delete friend';
                                        $mode2 = 'del';
                                    }

                                    $self = $member['mb_id'] != $row['mb_id'] ? false : true; // 내가쓴글인지?
                                    ?>

                                    <?php if(!$self && $row['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                    <div class="add_friend <?=$fri_class?>" onclick="likeFriend('<?=$row['mb_id']?>', '<?=$mode2?>')"></div>
                                    <?php } ?>
                                    </h4>

                                    <!-- 토글메뉴 -->
                                    <ul class="answer_<?=$row['idx']?> user_list answer01 sm">
                                        <?php if($row['mb_category'] == '일반') { // 작성자일반회원?>
                                        <li onclick="profileOpen('<?=$row['mb_category']?>', '<?=$row['mb_id']?>')">View Profile</li>
                                        <?php } ?>
                                        <?php if(!$self && $row['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                        <li onclick="likeFriend('<?=$row['mb_id']?>', '<?=$mode2?>');"><?=$txt2?></li> <!--친구등록/삭제-->
                                        <?php } ?>
                                        <?php if($row['mb_category'] == '기업') { // 작성자기업회원?>
                                        <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">Go to Company Homepage</a></li>
                                        <li>Number of requests <em class="blue"><?=inquiryCount($row['mb_id'])?></em></li>
                                        <li>Transactions <em class="blue"><?=completeCount($row['mb_id'])?></em></li>
                                        <?php } ?>
                                        <?php if(!$self && $row['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                        <li onclick="chatting('<?=$row['mb_id']?>');">CHAT</li>
                                        <?php } ?>
                                        <?php if(!$self) { // 내가쓴글아님?>
                                        <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_helpme_answer', '<?=$row['idx']?>')">REPORT</li>
                                        <?php } ?>
                                    </ul>
                                    <!-- //토글메뉴 -->

                                    <div class="list_info">
                                        <span class="lv"><?=$row['mb_grade']?></span> <!-- 등급 -->
                                        <span class="s_answer">Number of chosen answers <em><?=number_format($select_count)?></em></span> <!-- 이 회원의 현재까지 채택된 답변 수 -->
                                        <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span> <!-- 등록일 -->
                                    </div>
                                </div>
                            </div>
                            <?php if(($member['mb_level'] == 10 || $help['mb_id'] == $member['mb_id']) && empty($row['an_selection']) && empty($help['he_selection'])) { // (관리자 || 질문자 == 로그인자) && 현재 답변이 채택이 안됐을 경우 && 현재 질문에 답변 채택이 완료되지 않음 ?>
							<a class="answer_select" href="javascript:modal_open('edit_home', '<?=$row['idx']?>', '<?=$best_flag?>', '<?=$great_flag?>');"><span></span><em>Choose<em class="mhide"></em></em></a>
                            <?php } ?>
                        </div>

                        <div class="area_bottom">
                            <div class="bottom">
								
                                <?php if($display) { ?>
                                <div class="cont"><?=$row['an_contents']?></div>
                                <ul class="tag">
                                    <?=$an_hashtag?>
                                </ul>
                                <?php } else { ?>
                                <!-- 질문자만 공개 했을대 나오는 문구 -->
                                <div class="secret"><span><i class="fas fa-lock"></i>This answer is open only to the questioner.</span></div>
                                <?php } ?>

                                <div class="info">
                                    <?php if($member['mb_id'] == $row['mb_id']) { // 본인이 쓴 글이면 보임 ?>
                                    <?php if($row['an_selection'] != 'Y') { // 채택되면 수정/삭제 불가 ?>
                                    <a href="javascript:edit_open('edit_list_<?=$row['idx']?>');" class="btn_more"></a>
                                    <ul class="edit_list edit_list_<?=$row['idx']?>" style="display: none;">
                                        <?php if($help['he_answer_state'] == '답변대기') { ?>
                                        <li class="modify"><a href="javascript:help_action('answer_update', <?=$row['idx']?>);">Edit</a></li>
                                        <?php } ?>
                                        <!--<li class="delete"><a href="javascript:help_action_chk('answer', <?/*=$row['idx']*/?>, '<?/*=$row['an_selection']*/?>');">삭제</a></li>-->
                                    </ul>
                                    <?php } ?>
                                    <?php } else if($is_admin) { // 관리자 ?>
                                    <a href="javascript:edit_open('edit_list_<?=$row['idx']?>');" class="btn_more"></a>
                                    <ul class="edit_list edit_list_<?=$row['idx']?>" style="display: none;">
                                        <li class="delete"><a href="javascript:help_action_chk('answer', <?=$row['idx']?>, '<?=$row['an_selection']?>');">Delete</a></li>
                                    </ul>
                                    <?php } ?>
                                    <ul class="thums">
                                        <li class="good li_answer_good_<?=$row['idx']?> <?=actionCheck('helpme', 'answer_good', $member['mb_id'], $help['idx'], $row['idx']);?>" onclick="help_action('answer_good', <?=$row['idx']?>);"><i></i><span id="answer_good_count_<?=$row['idx']?>"><?=number_format($answer_good_count)?></span></li> <!-- 좋아요 -->
                                        <li class="bad li_answer_hate_<?=$row['idx']?> <?=actionCheck('helpme', 'answer_hate', $member['mb_id'], $help['idx'], $row['idx']);?>" onclick="help_action('answer_hate', <?=$row['idx']?>);"><i></i><span id="answer_hate_count_<?=$row['idx']?>"><?=number_format($answer_hate_count)?></span></li> <!-- 싫어요 -->
                                        <li class="comment comment_<?=$row['idx']?>"><i></i><span id="answer_reply_count_<?=$row['idx']?>"><?=number_format($answer_reply_count)?></span></li> <!-- 댓글수 -->
                                    </ul>
                                </div>
                            </div>
                            <!-- 댓글 -->
                            <div class="area_comment area_comment_<?=$row['idx']?>">
                                <div class="area_input">
                                    <input type="text" class="w_input" id="input_reply_<?=$row['idx']?>" name="input_reply_<?=$row['idx']?>" placeholder="Please post a comment.">
                                    <button type="button" class="btn_comment btn_comment_<?=$row['idx']?>" onclick="reply_action(<?=$row['idx']?>, '');">POST</button>
                                </div>
                                <ul class="list_comment list_comment_<?=$row['idx']?>">
                                    <?php
                                    $sql_reply = " select re.*, mb.mb_no, mb.mb_nick, mb.mb_category from g5_helpme_answer_reply as re left join g5_member as mb on re.mb_id = mb.mb_id where helpme_an_idx = {$row['idx']} and re.del_yn is null order by wr_datetime desc ";
                                    $result_reply = sql_query($sql_reply);

                                    for($a=0; $reply=sql_fetch_array($result_reply); $a++) {
                                    ?>
                                    <li>
										<div class="area_name" onclick="userToggle('reply_<?=$reply['idx']?>');">
                                            <h3 class="toggle">
                                                <?php echo getNickOrId($reply['mb_id']); ?>

                                                <?php
                                                $txt3 = 'Add friend';
                                                $mode3 = 'add';
                                                if(in_array($reply['mb_id'], $fri_arr)) { // 관심친구에 있음
                                                    $txt3 = 'Delete friend';
                                                    $mode3 = 'del';
                                                }

                                                $self = $member['mb_id'] != $reply['mb_id'] ? false : true; // 내가쓴글인지?
                                                ?>
                                            </h3>

                                            <!-- 토글메뉴 -->
                                            <ul class="reply_<?=$reply['idx']?> user_list answer02 sm">
                                                <?php if($reply['mb_category'] == '일반') { // 작성자일반회원?>
                                                <li onclick="profileOpen('<?=$reply['mb_category']?>', '<?=$reply['mb_id']?>')">View Profile</li>
                                                <?php } ?>
                                                <?php if(!$self && $reply['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                                <li onclick="likeFriend('<?=$reply['mb_id']?>', '<?=$mode3?>');"><?=$txt3?></li> <!--친구등록/삭제-->
                                                <?php } ?>
                                                <?php if($reply['mb_category'] == '기업') { // 작성자기업회원?>
                                                <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$reply['mb_no']?>">Go to Company Homepage</a></li>
                                                <li>Number of requests <em class="blue"><?=inquiryCount($reply['mb_id'])?></em></li>
                                                <li>Transactions <em class="blue"><?=completeCount($reply['mb_id'])?></em></li>
                                                <?php } ?>
                                                <?php if(!$self && $reply['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                                <li onclick="chatting('<?=$reply['mb_id']?>');">CHAT</li>
                                                <?php } ?>
                                                <?php if(!$self) { // 내가쓴글아님?>
                                                <li onclick="reportOpen('<?=$reply['mb_id']?>', 'g5_helpme_answer_reply', '<?=$reply['idx']?>')">REPORT</li>
                                                <?php } ?>
                                            </ul>
                                            <!-- //토글메뉴 -->
										</div>
                                        <span><?=$reply['contents']?></span>
                                        <em><?=str_replace('-','.',substr($reply['wr_datetime'],0,10))?></em>

                                        <?php if($member['mb_id'] == $reply['mb_id']) { ?>
										<!-- 댓글 수정 삭제 -->
										<ul class="edit">
											<li class="modify"><a href="javascript:reply_action_info(<?=$row['idx']?>, <?=$reply['idx']?>, '<?=$reply['contents']?>')">Edit</a></li>
											<li class="delete"><a href="javascript:reply_action(<?=$row['idx']?>, 'd', <?=$reply['idx']?>);">Delete</a></li>
										</ul>
										<!-- //댓글 수정 삭제 -->
                                        <?php } else if($is_admin) { ?>
                                        <!-- 댓글 수정 삭제 -->
                                        <ul class="edit">
                                            <li class="delete"><a href="javascript:reply_action(<?=$row['idx']?>, 'd', <?=$reply['idx']?>);">Delete</a></li>
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
				<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/help_list.php"><span>LIST</span></a></div>
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
</div>

<!-- 비슷한 질문-->
<div id="area_question">
	<div class="inr v2">
		<h3>Look for similar questions!</h3>
		<ul class="list">
            <?php
            $tag_search = tagSearch('he_hashtag', $help['he_hashtag']); // 검색컬럼, 검색태그
            $rlt = sql_query(" select * from g5_helpme where {$tag_search} and idx != '{$idx}' and del_yn is null order by he_good desc limit 4 ");
            while($row = sql_fetch_array($rlt)) {
                $view_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$row['idx']} and mode = 'view' order by idx desc limit 1 ")['acc_count']; // 조회 누적카운트
                $good_count = sql_fetch(" select acc_count from g5_helpme_action where helpme_idx = {$row['idx']} and mode = 'good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}' and del_yn is null; ")['count']; // 답변수
            ?>
            <li>
                <a href="<?=G5_BBS_URL?>/help_view.php?idx=<?=$row['idx']?>">
                    <h3><?=$row['he_subject']?></h3>
                    <span><?=strip_tags($row['he_contents'])?></span>
                    <div class="list_info">
                        <span class="view">Views <em><?=number_format($view_count)?></em></span> <!-- 조회수 -->
                        <span class="reply">Replys <em><?=number_format($a_count)?></em></span> <!-- 답변수 -->
                        <span class="good"><i></i><em><?=number_format($good_count)?></em></span> <!-- 좋아요 -->
                    </div>
                </a>
            </li>
            <?php
            }
            if(sql_num_rows($rlt) == 0) {
            ?>
            <li class="nodata">No similar questions found.</li>
            <?php
            }
            ?>
		</ul>
	</div>
</div>

<script>
var g_class = ''; // 댓글 구분 idx
$(function(){
    $('#answer_count').text(number_format($('.help_answer').length.toString())); // 총 답변 수
    
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
    // 다른 아이디(닉네임)의 소메뉴 클릭 시 이전 소메뉴 숨김
    $('.user_list').each(function() {
        if($(this).attr('style').indexOf('block') != -1) {
            if($(this)[0]['classList'][0] != user_cls) {
                $('.user_list').hide();
            }
        }
    });
    if (!$(e.target).hasClass('toggle')) { // toggle 포함된 영역 밖 클릭 시 소메뉴 영역 숨김
        $('.user_list').hide();
    }
});

// 수정/삭제 토글
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
    var txt = ' question';
    if(op == 'answer') { txt = ' answer'; }

    if(op == 'answer' && selection == 'Y') {
        swal('Accepted answers cannot be deleted.');
        return false;
    }

    swal({
        text: "Are you sure you want to delete your" + txt + "?",
        icon: "warning",
        buttons: {
            defeat: "Confirm",
            cancel: "Cancel",
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

// 조회/좋아요/싫어요 동작 (액션, idx, 채택 답변 구분, 마감 or 우수답변채택)
function help_action(mode, idx, gubun, fin) {
    if(mode == 'answer_update') { // 답변 수정 -- 답변 내용이 답변 등록 폼에 보여짐
        $('.anwser_area').removeClass('noshow');
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
                // $('.note-editable').html(data.an_contents);
                $('#editor').summernote('code', data.an_contents)
                // 해시태그
                if(data.input_an_hashtag != '') {
                    $('#an_hashtag').val(data.input_an_hashtag);
                    $('.tag_list').html(data.an_hashtag);
                    num = $('.tag_word').length + 1;
                }
                // 공개설정
                $("input:checkbox[name='an_open']").prop("checked", false);
                $("input:checkbox[id='"+data.an_open+"']").prop('checked', true);

                // 답변 등록 폼으로 위치 이동
                var offset = $('#fanswer').offset();
                $('html, body').animate({scrollTop : offset.top}, 100);
                $('.btn_confirm').text('Modify');
                $('#w').val('u');
                $('#helpme_an_idx').val(idx);
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
    else if(mode == 'delete') { // 질문 삭제
        location.href = g5_bbs_url + '/help_write_update.php?idx=<?=$idx?>&w=d';
    }
    else {
        $.ajax({
            url : g5_bbs_url + "/ajax.help_action.php",
            data: {mode : mode, helpme_idx : '<?=$idx?>', helpme_an_idx : idx, gubun : gubun, fin : fin},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    if(mode == 'answer_delete') {
                        swal("Answer has been deleted.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/help_view.php?idx=<?=$idx?>');
                        });
                    }
                    else if(mode == 'delete') {
                        swal("question has been deleted.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/help_list.php');
                        });
                    }
                    else if(mode == 'select') {
                        swal("accepted the answer.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/help_view.php?idx=<?=$idx?>');
                            // $('.answer_select').attr('style', 'display: none;');
                            // $('.area_select_'+idx).attr('style', 'display: block;');
                            // $('#edit_home').modal('hide');
                        });
                    }
                    else {
                        if(mode != 'view') {
                            if(mode == 'answer_good' || mode == 'answer_hate') {
                                // 좋아요/싫어요 표시
                                if($('#'+mode+'_count_'+idx).text()*1 < data*1) { // 액션
                                    $('.li_'+mode+'_'+idx).addClass('on');
                                } else { // 액션 취소
                                    $('.li_'+mode+'_'+idx).removeClass('on');
                                }
                                $('#'+mode+'_count_'+idx).text(data);
                            }
                            else {
                                // 좋아요/싫어요 표시
                                if($('#'+mode+'_count').text()*1 < data*1) { // 액션
                                    $('.li_'+mode).addClass('on');
                                } else { // 액션 취소
                                    $('.li_'+mode).removeClass('on');
                                }
                                $('#'+mode+'_count').text(data);
                            }
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
            swal('Please enter your tags.');
            return false;
        }
        // 콤마 체크
        if(!isComma(data.value)) {
            swal('Commas cannot be entered.');
            $('#input_tag').val('');
            return false;
        }
        // 최대 5개 처리
        if($('.tag_word').length == 5) {
            swal('You can register up to 5.');
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

    $('#an_contents').val(editorCheck()); // 내용

    $('.tag_list li span').each(function() {
        hashtag += $(this).text() + ',';
    });
    hashtag = hashtag.slice(0, -1);
    $('#an_hashtag').val(hashtag); // 해시태그

    var f = $('#fanswer')[0];
    if(f.an_contents.value.replace(/(<([^>]+)>)/ig,"") == "") {
        swal('Please enter your details.');
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
    $('.btn_comment_'+idx).text('Edit');
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
            swal("Please enter your details.");
            is_post2 = false;
            return false;
        }
    }
    $('.reply_count').remove(); // 삭제 후 사용 -- 댓글 추가할 때 마다 중복되기 때문에
    
    var txt = '';
    if(w == '') {
        txt = ' posted';
    }
    else if(w == 'u') {
        txt = ' edited';
    }
    else if(w == 'd') {
        txt = ' deleted';
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.help_answer_reply.php",
        data: {helpme_an_idx : idx, contents : $('#input_reply_'+idx).val(), w : w, reply_idx : reply_idx},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            swal('The reply has been' + txt + '.')
            .then(()=>{
                $('.list_comment_'+idx).html(data); // 리스트 초기화
                $('#answer_reply_count_'+idx).text($('.reply_count').val()); // 답변에 대한 댓글 총 개수
                $('#input_reply_'+idx).val(''); // 댓글 입력 폼 초기화
                $('.btn_comment_'+idx).text('post');
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

// 채택하기 모달
function modal_open(modal_id, an_idx, best, great) {
    $('#'+modal_id).modal('show');

    if(!best && !great) { // 베스트 / 우수 둘다 채택 X
        $('.list_edit li:nth-child(1) a').attr("onclick", "$('#edit_home').modal('hide');$('#edit_home2').modal('show');"); // 베스트 답변
        $('.list_edit li:nth-child(2)').hide(); // 우수 답변
        $('#edit_home2 .madal_btn li:nth-child(1)').attr("onclick", "javascript:help_action('select', "+an_idx+", 'best', 'fin');"); // 마감하기
        if('<?=$answer_count?>' == 1) { // 답변 1개
            $('#edit_home2 .madal_btn li:nth-child(2)').attr("onclick", "$('#edit_home2').modal('hide');$('#edit_home4').modal('show');"); // 우수답변채택하기
            // 우수답변 선택 시 채택할 답변 없다는 알림창
            $('#edit_home4 .madal_btn li:nth-child(1)').attr("onclick", "$('#edit_home4').modal('hide');"); // 취소
            $('#edit_home4 .madal_btn li:nth-child(2)').attr("onclick", "javascript:help_action('select', "+an_idx+", 'best', 'fin');"); // 마감
        } else { // 답변 2개 이상
            $('#edit_home2 .madal_btn li:nth-child(2)').attr("onclick", "$('#edit_home2').modal('hide');$('#edit_home3').modal('show');"); // 우수답변채택하기
            // 우수답변 선택 시 24시간 이내 선택 유도 알림창
            $('#edit_home3 .madal_btn li:nth-child(1)').attr("onclick", "$('#edit_home3').modal('hide');"); // 취소
            $('#edit_home3 .madal_btn li:nth-child(2)').attr("onclick", "javascript:help_action('select', "+an_idx+", 'best', 'no_fin');"); // 확인
        }
    } else if(best && !great) { // 베스트 채택 O
        $('.list_edit li:nth-child(1)').hide(); // 베스트 답변
        $('.list_edit li:nth-child(2) a').attr("onclick", "javascript:help_action('select', "+an_idx+", 'great');"); // 우수 답변
        $('.list_edit li:nth-child(2)').removeClass('deactivate');
    }
}

// 사용자 소메뉴 토글
var user_cls = '';
function userToggle(cls) {
    if(user_cls != cls) {
        $('.user_list').hide();
    }
    user_cls = cls;

    if($('.'+cls).attr('style').indexOf('block') != -1) {
        $('.'+cls).hide();
    } else {
        $('.'+cls).show();
    }
}
</script>

<?php
include_once(G5_BBS_PATH.'/help_list_search_script.php');
include_once('./_tail.php');
?>