<?
include_once('./_common.php');

$co = sql_fetch(" select co.*, mb.mb_no, mb.mb_nick, mb.mb_category from g5_community as co left join g5_member as mb on mb.mb_id = co.mb_id where co.idx = {$idx} ");

if($co['co_category'] == '꿀팁') {
    $op = 'tab1';
} else if($co['co_category'] == '일상 이런저런') {
    $op = 'tab2';
} else if($co['co_category'] == '회사/현장 이야기') {
    $op = 'tab3';
} else if($co['co_category'] == '해양뉴스') {
    $op = 'tab4';
}

$g5['title'] = $co['co_category'];
include_once('./_head.php');

if($co['del_yn'] == 'Y') { // 삭제한 게시물에 접근 시 튕김
    alert('올바른 경로가 아닙니다.');
}

$view_count = sql_fetch(" select acc_count from g5_community_action where community_idx = {$idx} and mode = 'view' order by idx desc limit 1 ")['acc_count']; // 조회 누적카운트
$good_count = sql_fetch(" select acc_count from g5_community_action where community_idx = {$idx} and mode = 'good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
$hate_count = sql_fetch(" select acc_count from g5_community_action where community_idx = {$idx} and mode = 'hate' order by idx desc limit 1 ")['acc_count']; // 싫어요 누적카운트
$answer_count = selectCount_n("g5_community_answer", "community_idx=".$idx, "del_yn is null"); // 댓글수

/*// 해시태그
$hashtag = '';
if(!empty($co['co_hashtag'])) {
    $tag = explode(',',$co['co_hashtag']);
    for($j=0; $j<count($tag); $j++) {
        $hashtag .= '<li onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
    }
}*/

// 관심친구 확인
$fri_rlt = sql_query(" select * from g5_like_friend where mb_id = '{$member['mb_id']}'; ");
$fri_arr = array();
while($fri = sql_fetch_array($fri_rlt)) {
    array_push($fri_arr, $fri['friend_mb_id']);
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 20px;}
	#ft{display:none;}
	.btn_write{bottom:10px;}
</style>


<?php
// 프로필 모달
include_once('./profile_modal.php');
?>

<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>

<div id="area_community" class="view">
	<!--
	<div id="sub_bn">
		<div class="txt">
			<h1><img src="<?php echo G5_IMG_URL ?>/community_txt.png"></h1>
			<span>포도씨 회원님들과 소통해보세요.</span>
			<a href="<?php echo G5_BBS_URL ?>/community_write.php"><span>글쓰기</span></a>
		</div>
		<div class="img"><img src="<?php echo G5_IMG_URL ?>/community_obj.png"></div>
	</div>

	<div class="community_cate">
		<div class="inr v3">
			<ul class="list_cate">
				<li><a class="active" href="">꿀팁</a></li>
				<li><a href="">일상 이런저런</a></li>
				<li><a href="">회사/현장 이야기</a></li>
				<li><a href="">해양뉴스</a></li>
			</ul>
			<div class="box_sch">
			<form name="fsearchbox">
				  <input type="text" placeholder="검색하기" name="search">
				  <button type="submit"></button>
				</form>
			</div>
		</div>
	</div>
	-->
	<div class="inr v3">

			<div id="help_list">
				<div class="help_question top">
					<div class="title">
						<em class="community_type"><a href="<?=G5_BBS_URL?>/community_list.php?op=<?=$op?>"><?=$co['co_category']?></a></em><!-- 카테고리 리스트로 이동 -->
						<h3><?=$co['co_subject']?></h3>
						<div class="list_info">
							<span class="id toggle" onclick="userToggle('user_list_main');">
                                <div class="profile toggle">
                                <?php echo getProfileImg($co['mb_id'], $co['mb_category'], $co['co_open']); ?>
                                </div>
                                <?php
                                if($co['co_open'] == 'private') { echo '익명'; }
                                else { echo getNickOrId($co['mb_id']); }
                                ?>
                            </span><!--아이디-->
							<span class="data"><?=str_replace('-','.',substr($co['wr_datetime'],0,10))?></span><!--등록일-->
							<span class="view">조회수 <em id="view_count"><?=number_format($view_count)?></em></span><!--조회수-->
							<?php if($co['mb_id'] == $member['mb_id']) { // 본인이 쓴 글이면 보임?>
							<a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
							<ul class="edit_list edit_list_q" style="display: none;">
								<li class="modify"><a href="<?=G5_BBS_URL?>/community_write.php?idx=<?=$co['idx']?>&w=u">수정</a></li>
								<li class="delete"><a href="javascript:community_action_chk('community');">삭제</a></li>
							</ul>
							<?php } else if($is_admin) { // 관리자 ?>
                            <a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
                            <ul class="edit_list edit_list_q" style="display: none;">
                                <li class="delete"><a href="javascript:community_action_chk('community');">삭제</a></li>
                            </ul>
                            <?php } ?>
                            <?php
                            $txt = '친구등록';
                            $mode = 'add';
                            if(in_array($co['mb_id'], $fri_arr)) { // 관심친구에 있음
                                $txt = '친구삭제';
                                $mode = 'del';
                            }

                            $self = $member['mb_id'] != $co['mb_id'] ? false : true; // 내가쓴글인지?
                            ?>

                            <!-- 토글메뉴 -->
                            <ul class="user_list_main user_list sm">
                                <?php if($co['co_open'] != 'private') { // 전체공개?>
                                <?php if($co['mb_category'] == '일반') { // 작성자일반회원?>
                                <li onclick="profileOpen('<?=$co['mb_category']?>', '<?=$co['mb_id']?>')">프로필보기</li>
                                <?php } ?>
                                <?php if(!$self && $co['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                <li onclick="likeFriend('<?=$co['mb_id']?>', '<?=$mode?>');"><?=$txt?></li> <!--친구등록/삭제-->
                                <?php } ?>
                                <?php if($co['mb_category'] == '기업') { // 작성자기업회원?>
                                <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$co['mb_no']?>">기업홈피로 이동</a></li>
                                <li>의뢰건수 <em class="blue"><?=inquiryCount($co['mb_id'])?></em>건</li>
                                <li>거래건수 <em class="blue"><?=completeCount($co['mb_id'])?></em>건</li>
                                <?php } ?>
                                <?php if(!$self && $co['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                <li onclick="chatting('<?=$co['mb_id']?>');">채팅하기</li>
                                <?php } ?>
                                <?php } ?>
                                <?php if(!$self) { // 내가쓴글아님?>
                                <li onclick="reportOpen('<?=$co['mb_id']?>', 'g5_community', '<?=$co['idx']?>')">신고하기</li>
                                <?php if($member['mb_id'] == 'test01') { ?>
                                <li onclick="userBlock('<?=$co['mb_id']?>', 'g5_community', '<?=$co['idx']?>', 'community')">차단하기</li>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                            <!-- //토글메뉴 -->
						</div>
					</div>
					<div class="bottom">
						<div class="cont"><?=nl2br(htmlspecialchars_decode($co['co_contents']))?></div>
						<div class="info">
							<ul class="thums">
								<!-- 선택했을 때 li 클래스 on 추가 -->
								<li class="good li_good <?=actionCheck('community', 'good', $member['mb_id'], $co['idx']);?>" onclick="community_action('good');"><i></i><span id="good_count"><?=number_format($good_count)?></span></li><!--좋아요-->
								<li class="bad li_hate <?=actionCheck('community', 'hate', $member['mb_id'], $co['idx']);?>" onclick="community_action('hate');"><i></i><span id="hate_count"><?=number_format($hate_count)?></span></li><!--싫어요-->
							</ul>
						</div>
					</div>
					<ul class="tag"></ul>
				</div>

                <?php if($is_member) { ?>
                <form id="fanswer" name="fanswer" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/community_view_update.php">
                    <input type="hidden" id="community_idx" name="community_idx" value="<?=$idx?>">
                    <input type="hidden" id="community_an_idx" name="community_an_idx">
                    <input type="hidden" id="w" name="w">
                    <div class="help_write">
                        <h3>댓글쓰기</h3>

                        <div class="area_textarea">
                            <textarea id="an_contents" name="an_contents" placeholder="댓글을 등록해 주세요."></textarea>
                        </div>

                        <div class="w_filter">
                            <ul class="area_filter">
                                <li>
                                    <input type="checkbox" id="an_open" name="an_open">
                                    <label for="an_open">
                                        <span></span>
                                        <em>익명으로 등록하기</em>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="btn_confirm" onclick="community_answer_register();">등록하기</button>
                    </div>
                </form>
                <?php } ?>

				<div class="area_answer">
					<h2>총 <span class="blue" id="answer_count"><?=number_format($answer_count)?>개</span>의 댓글이 있습니다.</h2>
                    <?php

                    /**
                     * 앱 심사용 - 차단한 사용자 숨김
                     * ajax.help_list.php, help_view.php, ajax.community_list.php, community_view.php, community.php, community_list.php
                     */
                    if($member['mb_id'] == 'test01') {
                        if(!empty(blockUser($member['mb_id']))) {
                            $block = blockUser($member['mb_id']);
                            $sql_search = " and an.mb_id not in ({$block}) ";
                        }
                    }

                    // 댓글 리스트
                    $sql = " select an.*, mb.mb_no, mb.mb_nick, mb.mb_grade, mb.mb_category from g5_community_answer as an left join g5_member as mb on an.mb_id = mb.mb_id where community_idx = '{$idx}' and del_yn is null {$sql_search} order by an.wr_datetime desc ";
                    $result = sql_query($sql);

                    for($i=0; $row=sql_fetch_array($result); $i++) {
                        // 좋아요
                        $answer_good_count = sql_fetch(" select acc_count from g5_community_action where community_an_idx = {$row['idx']} and mode = 'answer_good' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                        // 싫어요
                        $answer_hate_count = sql_fetch(" select acc_count from g5_community_action where community_an_idx = {$row['idx']} and mode = 'answer_hate' order by idx desc limit 1 ")['acc_count']; // 좋아요 누적카운트
                        // 답글
                        $answer_reply_count = selectCount_n("g5_community_answer_reply", 'community_an_idx='.$row['idx'], 'del_yn is null');
                        $add_style = '';
                        if($answer_reply_count == 0) { $add_style = 'style="display: none;"'; }
                    ?>
                    <!-- 댓글 -->
                    <div class="help_question comm_answer">
                        <div class="title">
                            <div class="area_name" onclick="userToggle('answer_<?=$row['idx']?>');">
                                <div class="profile toggle">
                                <?php echo getProfileImg($row['mb_id'], $row['mb_category'], $row['an_open']); ?>
                                </div> <!-- 프로필사진 -->
                                <div class="profile_info">
                                    <h4 class="toggle">
                                    <?php
                                    if($row['an_open'] == 'private') { echo '익명'; }
                                    else { echo getNickOrId($row['mb_id']); }
                                    ?><!-- 아이디 or 닉네임 -->

                                    <!-- 친구등록 버튼 클릭하면 class="on" 추가-->
                                    <?php
                                    $fri_class = '';
                                    $txt2 = '친구등록';
                                    $mode2 = 'add';
                                    if(in_array($row['mb_id'], $fri_arr)) { // 관심친구에 있음
                                        $fri_class = 'on';
                                        $txt2 = '친구삭제';
                                        $mode2 = 'del';
                                    }

                                    $self = $member['mb_id'] != $row['mb_id'] ? false : true; // 내가쓴글인지?
                                    ?>

                                    <?php if(!$self && $row['mb_category'] == '일반' && $row['an_open'] != 'private' && $member['mb_category'] == '일반') {  // 내가쓴글아님 && 작성자일반회원 && 익명아님 && 내가일반회원?>
                                    <div class="add_friend <?=$fri_class?>" onclick="likeFriend('<?=$row['mb_id']?>', '<?=$mode2?>')"></div>
                                    <?php } ?>
                                    </h4>

                                    <!-- 토글메뉴 -->
                                    <ul class="answer_<?=$row['idx']?> user_list answer01 sm">
                                        <?php if($row['an_open'] != 'private') { // 전체공개?>
                                        <?php if($row['mb_category'] == '일반') { // 작성자일반회원?>
                                        <li onclick="profileOpen('<?=$row['mb_category']?>', '<?=$row['mb_id']?>')">프로필보기</li>
                                        <?php } ?>
                                        <?php if(!$self && $row['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                        <li onclick="likeFriend('<?=$row['mb_id']?>', '<?=$mode2?>');"><?=$txt2?></li> <!--친구등록/삭제-->
                                        <?php } ?>
                                        <?php if($row['mb_category'] == '기업') { // 작성자기업회원?>
                                        <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">기업홈피로 이동</a></li>
                                        <li>의뢰건수 <em class="blue"><?=inquiryCount($row['mb_id'])?></em>건</li>
                                        <li>거래건수 <em class="blue"><?=completeCount($row['mb_id'])?></em>건</li>
                                        <?php } ?>
                                        <?php if(!$self && $row['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                        <li onclick="chatting('<?=$row['mb_id']?>');">채팅하기</li>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if(!$self) { // 내가쓴글아님?>
                                        <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_community_answer', '<?=$row['idx']?>')">신고하기</li>
                                        <?php if($member['mb_id'] == 'test01') { ?>
                                        <li onclick="userBlock('<?=$row['mb_id']?>', 'g5_community_answer', '<?=$row['idx']?>', 'community_view')">차단하기</li>
                                        <?php } ?>
                                        <?php } ?>
                                    </ul>
                                    <!-- //토글메뉴 -->

                                    <div class="list_info">
                                        <span class="lv"><?=$row['mb_grade']?></span> <!-- 등급 -->
                                        <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span> <!-- 등록일 -->
                                    </div>
                                </div>
                            </div>

                            <?php if($row['mb_id'] == $member['mb_id']) { // 본인이 쓴 글이면 보임?>
                            <a href="javascript:edit_open('edit_list_<?=$row['idx']?>');" class="btn_more"></a>
                            <ul class="edit_list edit_list_<?=$row['idx']?>" style="display: none;">
                                <li class="modify"><a href="javascript:community_action('answer_update', <?=$row['idx']?>);">수정</a></li>
                                <li class="delete"><a href="javascript:community_action_chk('answer', <?=$row['idx']?>);">삭제</a></li>
                            </ul>
                            <?php } else if($is_admin) { // 관리자?>
                            <a href="javascript:edit_open('edit_list_<?=$row['idx']?>');" class="btn_more"></a>
                            <ul class="edit_list edit_list_<?=$row['idx']?>" style="display: none;">
                                <li class="delete"><a href="javascript:community_action_chk('answer', <?=$row['idx']?>);">삭제</a></li>
                            </ul>
                            <?php }?>
                        </div>

                        <div class="area_bottom">
                            <div class="bottom">
                                <div class="cont"><?=$row['an_contents']?></div>
                                <div class="info">
                                    <a class="btn_reply count store_noshow" href="javascript:void(0);">답글 <span id="answer_reply_count_<?=$row['idx']?>"><?=number_format($answer_reply_count)?></span>개</a>
                                    <?php if($is_member) { ?><a class="btn_reply reply_<?=$row['idx']?> reply_write store_noshow" href="javascript:void(0);">답글쓰기</a><?php } ?><!-- 클릭하면 .area_comment_input display:block-->
                                    <ul class="thums">
                                        <li class="good li_answer_good_<?=$row['idx']?> <?=actionCheck('community', 'answer_good', $member['mb_id'], $co['idx'], $row['idx']);?>" onclick="community_action('answer_good', <?=$row['idx']?>);"><i></i><span id="answer_good_count_<?=$row['idx']?>"><?=number_format($answer_good_count)?></span></li> <!-- 좋아요 -->
                                        <li class="bad li_answer_hate_<?=$row['idx']?> <?=actionCheck('community', 'answer_hate', $member['mb_id'], $co['idx'], $row['idx']);?>" onclick="community_action('answer_hate', <?=$row['idx']?>);"><i></i><span id="answer_hate_count_<?=$row['idx']?>"><?=number_format($answer_hate_count)?></span></li> <!-- 싫어요 -->
                                    </ul>
                                </div>

                                <!-- 클릭하면 .area_comment_input display:block-->
                                <div class="area_comment_input area_comment_input_<?=$row['idx']?>" style="display: none;">
                                    <textarea id="input_reply_<?=$row['idx']?>" name="input_reply_<?=$row['idx']?>" placeholder="답글을 등록해 주세요."></textarea>
                                    <div class="comment_bottom">
                                        <!--<div class="w_filter">
                                            <input type="checkbox" id="filter01" checked name="filter_type">
                                            <label for="filter01">
                                                <span></span>
                                                <em>익명으로 게시하기</em>
                                            </label>
                                        </div>-->
                                        <div class="list_btn">
                                            <button class="btn_cancle reply_<?=$row['idx']?>">취소</button><!-- 클릭하면 .area_comment_input display:none-->
                                            <button type="button" class="btn_comment btn_comment_<?=$row['idx']?>" onclick="reply_action(<?=$row['idx']?>, '');">등록</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 답글 -->
                            <div class="area_comment area_comment_<?=$row['idx']?>" <?=$add_style?>>
                                <ul class="list_comment list_comment_<?=$row['idx']?>">
                                    <?php
                                    $sql_reply = " select re.*, mb.mb_no, mb.mb_nick, mb.mb_category from g5_community_answer_reply as re left join g5_member as mb on re.mb_id = mb.mb_id where community_an_idx = {$row['idx']} and del_yn is null order by wr_datetime asc ";
                                    $result_reply = sql_query($sql_reply);

                                    for($a=0; $reply=sql_fetch_array($result_reply); $a++) {
                                    ?>
                                    <li>
                                        <div class="area_name" onclick="userToggle('reply_<?=$reply['idx']?>');">
                                        <h3 class="toggle">
                                            <?php echo getNickOrId($reply['mb_id']); ?>

                                            <?php
                                            $txt3 = '친구등록';
                                            $mode3 = 'add';
                                            if(in_array($reply['mb_id'], $fri_arr)) { // 관심친구에 있음
                                                $txt3 = '친구삭제';
                                                $mode3 = 'del';
                                            }

                                            $self = $member['mb_id'] != $reply['mb_id'] ? false : true; // 내가쓴글인지?
                                            ?>
										</h3>

                                        <!-- 토글메뉴 -->
                                        <ul class="reply_<?=$reply['idx']?> user_list answer02 sm">
                                            <?php if($reply['mb_category'] == '일반') { // 작성자일반회원?>
                                            <li onclick="profileOpen('<?=$reply['mb_category']?>', '<?=$reply['mb_id']?>')">프로필보기</li>
                                            <?php } ?>
                                            <?php if(!$self && $reply['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                            <li onclick="likeFriend('<?=$reply['mb_id']?>', '<?=$mode3?>');"><?=$txt3?></li> <!--친구등록/삭제-->
                                            <?php } ?>
                                            <?php if($reply['mb_category'] == '기업') { // 작성자기업회원?>
                                            <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$reply['mb_no']?>">기업홈피로 이동</a></li>
                                            <li>의뢰건수 <em class="blue"><?=inquiryCount($reply['mb_id'])?></em>건</li>
                                            <li>거래건수 <em class="blue"><?=completeCount($reply['mb_id'])?></em>건</li>
                                            <?php } ?>
                                            <?php if(!$self && $reply['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                            <li onclick="chatting('<?=$reply['mb_id']?>');">채팅하기</li>
                                            <?php } ?>
                                            <?php if(!$self) { // 내가쓴글아님?>
                                            <li onclick="reportOpen('<?=$reply['mb_id']?>', 'g5_community_answer_reply', '<?=$reply['idx']?>')">신고하기</li>
                                            <?php if($member['mb_id'] == 'test01') { ?>
                                            <li onclick="userBlock('<?=$reply['mb_id']?>', 'g5_community_answer_reply', '<?=$reply['idx']?>', 'community_view')">차단하기</li>
                                            <?php } ?>
                                            <?php } ?>
                                        </ul>
                                        <!-- //토글메뉴 -->
                                        </div>

                                        <span><?=$reply['contents']?></span>
                                        <em><?=str_replace('-','.',substr($reply['wr_datetime'],0,16))?></em>

                                        <?php if($member['mb_id'] == $reply['mb_id']) { ?>
                                        <!-- 답글 수정 삭제 -->
                                        <ul class="edit">
                                            <li class="modify"><a href="javascript:reply_action_info(<?=$row['idx']?>, <?=$reply['idx']?>, '<?=$reply['contents']?>')">수정</a></li>
                                            <li class="delete"><a href="javascript:reply_action(<?=$row['idx']?>, 'd', <?=$reply['idx']?>);">삭제</a></li>
                                        </ul>
                                        <!-- //답글 수정 삭제 -->
                                        <?php } else if($is_admin) { // 관리자?>
                                        <!-- 답글 수정 삭제 -->
                                        <ul class="edit">
                                            <li class="delete"><a href="javascript:reply_action(<?=$row['idx']?>, 'd', <?=$reply['idx']?>);">삭제</a></li>
                                        </ul>
                                        <!-- //답글 수정 삭제 -->
                                        <?php } ?>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- //답글 -->
                        </div>
                    </div>
                    <!-- //댓글 -->
                    <?php
                    }
                    ?>
				</div>
		</div>
		<div id="area_popular">
			<div class="area_write">
				<a href="<?php echo G5_BBS_URL ?>/community_write.php"><span>글쓰기</span></a>
			</div>
			<div class="list_best">
			<h3>TOP 10</h3>
			<ul>
                <?php
                // 해당 카테고리 게시글 인기순으로 10개 (인기순 없을 시 최신순)
                $sql = " select co.*, mb.mb_nick from g5_community as co left join g5_member as mb on mb.mb_id = co.mb_id where co_category = '{$co['co_category']}' and del_yn is null order by co_good desc, co.wr_datetime desc limit 10 ";
                $result = sql_query($sql);

                for($i=0; $row=sql_fetch_array($result); $i++) {
                ?>
                <li>
                    <a href="<?=G5_BBS_URL?>/community_view.php?idx=<?=$row['idx']?>">
                        <span><i><?=sprintf("%02d",($i+1))?></i><?=$row['co_subject']?></span><!-- 제목 -->
                        <em>
                            <?php
                            if($row['co_open'] == 'private') { echo '익명'; }
                            else { echo getNickOrId($row['mb_id']); }
                            ?>
                        </em><!-- 아이디 -->
                    </a>
                </li>
                <?php
                }
                ?>
			</ul>
			</div>
		</div>
		<div id="help_list">
		<div class="area_bottom">
			<div class="tab_container">
				<div class="tab_content">
					<ul class="board_list">
                        <?php
                        // 해당 카테고리 게시글 최신순으로 5개
                        $sql2 = " select co.*, mb.mb_nick from g5_community as co left join g5_member as mb on mb.mb_id = co.mb_id where co_category = '{$co['co_category']}' and del_yn is null order by co.wr_datetime desc limit 5 ";
                        $result2 = sql_query($sql2);

                        for($i=0; $row=sql_fetch_array($result2); $i++) {
                            // 댓글수
                            $a_count = selectCount_n("g5_community_answer", "community_idx=".$row['idx'], "del_yn is null");
                            // 조회수
                            $v_count = selectCount('g5_community_action', 'community_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터
                        ?>
                        <li>
                            <a href="<?=G5_BBS_URL?>/community_view.php?idx=<?=$row['idx']?>">
                                <div class="subject"><h3><?=$row['co_subject']?></h3><em class="reply"><i><?=number_format($a_count)?></i></em></div>
                                <span class="contents"><?=strip_tags($row['co_contents'])?></span>
                                <div class="list_info">
                                    <span class="id">
                                        <?php
                                        if($row['co_open'] == 'private') { echo '익명'; }
                                        else { echo getNickOrId($row['mb_id']); }
                                        ?>
                                    </span>
                                    <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
                                    <span class="view">조회수 <em><?=number_format($v_count)?></em></span>
                                </div>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/community_list.php?op=<?=$op?>"><span>목록</span></a></div>

		</div>
	</div>
</div>

<div class="btn_write"><a href="<?php echo G5_BBS_URL ?>/community_write.php"></a></div>

<script>
var g_class = '';
$(function() {
    $('#answer_count').text(number_format($('.comm_answer').length.toString())); // 총 댓글 수

    // 답글쓰기 버튼 클릭
    $('#help_list .help_question .info > .reply_write').on('click',function(){
        var temp = $(this)[0].className.split(' ')[1];
        var idx = temp.split('_')[1];

        if(g_class != idx) {
            $('.area_comment_input').hide();
        }
        g_class = idx;

        $('.area_comment_input_'+idx).show();
    });

    // 답글쓰기-취소 버튼 클릭
    $('.btn_cancle').on('click',function(){
        // 폼 초기화
        $('.btn_comment').text('등록');
        $('.area_comment_input textarea').val('');
        $('#w').val('');
        $('.area_comment_input').hide();
    });

    // 조회/좋아요/싫어요 동작
    community_action('view');
});

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
function edit_open(mode) { // mode : 각 댓글에 적용된 클래스
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

// 삭제 전 삭제 확인 체크 (op : 구분(게시글 or 댓글) / idx : 댓글 idx)
function community_action_chk(op, idx) {
    var txt = '게시글';
    if(op == 'answer') { txt = '댓글'; }

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
                if(op == 'community') {
                    community_action("delete"); // 게시글삭제
                }
                else {
                    community_action("answer_delete", idx); // 댓글삭제
                }
            case "cancel":
                return false;
        }
    });
    $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
}

// 조회/좋아요/싫어요 동작 (액션, idx)
function community_action(mode, idx) {
    if(mode == 'answer_update') { // 댓글 수정 -- 댓글 내용이 댓글 등록 폼에 보여짐
        $('.edit_list_'+idx).attr('style', 'display:none;');

        $.ajax({
            url : g5_bbs_url + "/ajax.community_answer_info.php",
            data: {idx : idx},
            type: 'POST',
            cache: false,
            async: false,
            dataType: 'json',
            success : function(data) {
                // 내용
                $('#an_contents').val(data.an_contents);
                // 댓글 등록 폼으로 위치 이동
                var offset = $('#fanswer').offset();
                $('html, body').animate({scrollTop : offset.top}, 100);
                $('.btn_confirm').text('수정하기');
                $('#w').val('u');
                $('#an_open').val(data.an_open);
                if($('#an_open').val() == 'open') {
                    $('#an_open').attr('checked', false);
                } else {
                    $('#an_open').attr('checked', true);
                }
                $('#community_an_idx').val(idx);
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
    else if(mode == 'delete') {
        location.href = g5_bbs_url + '/community_write_update.php?idx=<?=$idx?>&w=d';
    }
    else {
        $.ajax({
            url : g5_bbs_url + "/ajax.community_action.php",
            data: {mode : mode, community_idx : '<?=$idx?>', community_an_idx : idx},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    if(mode == 'answer_delete') {
                        swal("댓글이 삭제되었습니다.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/community_view.php?idx=<?=$idx?>');
                        });
                    }
                    else if(mode == 'delete') {
                        swal("게시글이 삭제되었습니다.")
                        .then(()=>{
                            location.replace(g5_bbs_url+'/community.php');
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
                    }
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
}

// 댓글등록
var is_post = false; // 중복 submit 체크
function community_answer_register() {
    if(is_post) {
        return false;
    }
    is_post = true;

    var f = $('#fanswer')[0];
    if(f.an_contents.value == "") {
        swal('내용을 입력해 주세요.');
        is_post = false;
        return false;
    }
    if($("input:checkbox[name=an_open]").is(":checked") == true) {
        $('#an_open').val('private');
    }

    $('#fanswer').submit();
}

// 답글 수정 시 답글 입력 폼에 내용 보여줌 (댓글 idx, 답글 idx, 답글 내용)
function reply_action_info(idx, reply_idx, contents) {
    $('#input_reply_'+idx).val(contents);
    $('.btn_comment_'+idx).text('수정');
    $('.btn_comment_'+idx).attr('onclick', 'reply_action('+idx+', "u", '+reply_idx+');');
    $('.area_comment_input_'+idx).show();
}

// 답글 등록/수정/삭제 (댓글 idx, 구분, 답글 idx)
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
    $('.reply_count').remove(); // 삭제 후 사용 -- 답글 추가할 때 마다 중복되기 때문에

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
        url : g5_bbs_url + "/ajax.community_answer_reply.php",
        data: {community_an_idx : idx, contents : $('#input_reply_'+idx).val(), w : w, reply_idx : reply_idx},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            swal('답글이 '+txt+'되었습니다.')
            .then(()=>{
                $('.list_comment_'+idx).html(data); // 리스트 초기화
                $('#answer_reply_count_'+idx).text($('.reply_count').val()); // 댓글에 대한 답글 총 개수
                $('#input_reply_'+idx).val(''); // 답글 입력 폼 초기화
                $('.btn_comment_'+idx).text('등록');
                $('.btn_comment_'+idx).attr('onclick', 'reply_action('+idx+', "");');
                $('.area_comment_'+idx).show();

                if($('.list_comment_'+idx+' li').length == 0) {
                    $('#answer_reply_count_'+idx).text(0);
                    $('.comment').removeClass('active');
                    $('.area_comment_'+idx).hide();
                }

                is_post2 = false;
            });
        },
        error : function(err) {
            swal(err.status);
        }
    });
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

/*// 태그 검색
function tag_search(tag) {
    // 검색폼에 데이터 입력
    $('#sch_tag').val(tag);
    $('#sch_txt').val(tag);
    $('#fsearch').submit();
}*/
</script>

<?
include_once('./_tail.php');
?>
