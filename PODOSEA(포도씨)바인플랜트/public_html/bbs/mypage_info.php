<div id="area_my" class="help">
    <div class="myinfo">
        <!--<div class="lv_label lv1">
            <div class="txt">
                <h3>엑스<br>퍼트</h3>
            </div>
        </div>-->

        <div class="myinfo_wrap">
            <div class="area_photo">
            <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
            </div>
        </div>
        <div class="location"><span><?=$member['mb_si']?></span></div>
        <div class="id">
            <i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><span><?=getNickOrId($member['mb_id'])?></span><a class="btn_arrow" href=""></a>
        </div>
        <div class="area_intro">
            <?php if(!empty($member['mb_introduce'])) { ?>
            <p><?=$member['mb_introduce']?></p>
            <?php } else { ?>
            <div class="nodata"><p>작성된 소개글이 없습니다.</p></div>
            <?php } ?>
        </div>

        <div class="area_nm">
            <em>나의 포도씨 항해 거리</em> <span class="blue"><?=number_format($member['mb_grade_point'])?>NM</span>
        </div>
    </div>
    <ul class="my_qna left">
        <?php
        // 질문수
        $q_count = sql_fetch(" select count(*) as count from g5_helpme where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
        // 답변수
        $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
        // 채택된 답변수
        $s_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$member['mb_id']}' and an_selection = 'Y' and del_yn is null; ")['count'];
        ?>
        <li><a href="javascript:void(0);"><?=number_format($q_count)?></a><em>질문</em></li>
        <li><a href="javascript:void(0);"><?=number_format($a_count)?></a><em>답변</em></li>
        <li><a href="javascript:void(0);"><?=number_format($s_count)?></a><em>채택된 답변</em></li>
    </ul>
    <div class="area_bunker">
        <h3>Bunker</h3>
        <span><?=number_format($member['mb_bunker']+$member['mb_bunker_bonus'])?></span>
    </div>
</div>