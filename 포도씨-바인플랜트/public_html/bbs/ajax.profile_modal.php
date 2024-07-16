<?php
include_once('./_common.php');

/** 일반회원 프로필 모달 (ajax) **/

$mb = get_member($mb_id); // 프로필 회원 정보

$viewFlag = false; // 프로필 전체 공개설정
if($mb['profile'] == 'all') { // 전체공개
    $viewFlag = true;
} else if($mb['profile'] == 'friend') { // 친구공개
    // 프로필 조회한 회원에게 내가 관심친구인지 확인
    $result = sql_query(" select * from g5_like_friend where mb_id = '{$mb_id}' order by idx desc ");
    while($row = sql_fetch_array($result)) {
        if($row['friend_mb_id'] == $member['mb_id']) {
            $viewFlag = true;
            break;
        }
    }
} else if($mb['profile'] == 'private') { // 비공개
    $viewFlag = false;
}

// 각 프로필 공개설정
$profile2Flag = false; // 프로필2 공개설정
$profile3Flag = false; // 프로필3 공개설정
$profile4Flag = false; // 프로필4 공개설정
if($mb['profile2_open'] == 'Y') { $profile2Flag = true; }
if($mb['profile3_open'] == 'Y') { $profile3Flag = true; } // * 건너뛰기할 시 프로필 보여야 한다고 하면 아래 주석 사용
//if($mb['profile3_open'] == 'Y' || !isset($mb['profile3_open'])) { $profile3Flag = true; } // 프로필 공개 설정이 Y 또는 공개 설정할 정보가 없으면 (프로필에서 건너뛰기)
if($mb['profile4_open'] == 'Y') { $profile4Flag = true; }

// 내 프로필 조회 시
if($mb['mb_id'] == $member['mb_id']) {
    $viewFlag = true;
    $profile2Flag = true;
    $profile3Flag = true;
    $profile4Flag = true;
}
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
        <h4 class="modal-title" id="appModalLabel"><?=getNickOrId($mb['mb_id'])?> 프로필</h4>
    </div>
    <div class="modal-body">
        <div id="area_my">
            <div class="myinfo">
                <div class="top_box first_box">
                    <div class="box_wrap">
                        <div class="myinfo_wrap">
                            <div class="area_photo">
                                <?php echo getProfileImg($mb['mb_id'], $mb['mb_category']); ?>
                            </div>
                        </div>
                        <div class="location"><span><?=$mb['mb_si']?></span></div>
                        <div class="id">
                            <i class="lv<?=array_search($mb['mb_grade'], $member_grade)?>"><?=$mb['mb_grade']?></i><span><?=getNickOrId($mb['mb_id'])?></span>
                        </div>
                        <div class="area_intro">
                            <?php if(!empty($mb['mb_introduce'])) { ?>
                            <p><?=$mb['mb_introduce']?></p>
                            <?php } else { ?>
                            <div class="nodata"><p>작성된 소개글이 없습니다.</p></div>
                            <?php } ?>
                        </div>
                        <div class="area_nm">
                            <em>나의 포도씨 항해 거리</em> <span class="blue"><?=number_format($mb['mb_grade_point'])?>NM</span>
                        </div>
                        <?php if($mb['mb_id'] != $member['mb_id']) { ?>
						<span class="btn_report" onclick="reportOpen('<?=$mb['mb_id']?>', 'g5_member', '<?=$mb['mb_no']?>')">신고하기</span>
                        <?php } ?>
                    </div>
                </div>
                <div class="top_box second_box">
                    <div class="area_box">
                        <h3>경력사항</h3>
                        <?php if($viewFlag && $profile2Flag) { ?>
                        <?php if(!empty($mb['mb_career'])) { ?>
                        <ul class="myinfo_list">
                            <?php
                            $mb_career = explode(',',$mb['mb_career']);
                            for($k=0; $k<count($mb_career); $k++) {
                            ?>
                            <li><?=$mb_career[$k]?></li>
                            <?php } ?>
                        </ul>
                        <?php } else { ?>
                        <div class="nodata"><p>등록된 경력사항이 없습니다.</p></div>
                        <?php } ?>
                        <?php } else { ?>
                        <div class="nodata"><p>비공개 정보입니다.</p></div>
                        <?php } ?>
                    </div>
                    <div class="area_box">
                        <h3>학력 및 전공</h3>
                        <?php if($viewFlag && $profile3Flag) { ?>
                        <?php if(!empty($mb['mb_education'])) { ?>
                        <ul class="myinfo_list">
                            <?php
                            $mb_education = explode(',',$mb['mb_education']);
                            for($k=0; $k<count($mb_education); $k++) {
                            ?>
                            <li><?=$mb_education[$k]?></li>
                            <?php } ?>
                        </ul>
                        <?php } else { ?>
                        <div class="nodata"><p>등록된 학력 및 전공이 없습니다.</p></div>
                        <?php } ?>
                        <?php } else { ?>
                        <div class="nodata"><p>비공개 정보입니다.</p></div>
                        <?php } ?>
                    </div>
                    <div class="area_box">
                        <h3>보유기술 및 자격증</h3>
                        <?php if($viewFlag && $profile4Flag) { ?>
                        <?php if(!empty($mb['mb_tech'])) { ?>
                        <ul class="myinfo_list">
                            <?php
                            $mb_tech = explode(',',$mb['mb_tech']);
                            for($k=0; $k<count($mb_tech); $k++) {
                            ?>
                            <li><?=$mb_tech[$k]?></li>
                            <?php } ?>
                        </ul>
                        <?php } else { ?>
                        <div class="nodata"><p>등록된 보유기술 및 자격증이 없습니다.</p></div>
                        <?php }?>
                        <?php } else { ?>
                        <div class="nodata"><p>비공개 정보입니다.</p></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>