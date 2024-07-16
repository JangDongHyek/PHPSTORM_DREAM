<?php
include_once('./_common.php');

/** 모바일버전 통합검색 (ajax) **/

$sql_where = " where 1=1 ";
$search = trim($search);

if($category == '헬프미' || empty($category)) {
    $sql_table = "g5_helpme";
    $sql_where .= "and del_yn is null
                   and (he_subject like '%{$search}%' or he_contents like '%{$search}%' or he_hashtag like '%{$search}%')";
    $sql_orderby = "order by idx desc ";
    $rlt = sql_query(" select * from {$sql_table} {$sql_where} {$sql_orderby} ");
?>
<div id="tab01" class="tab_box">
    <!--<div id="area_filter">-->
    <!--필터 체크 했을대 select클래스 추가-->
    <!--<span class="icon_filter"><i></i>필터</span>-->
    <!--</div>-->
    <div id="help_list">
        <?php if(!empty($search) && !empty(sql_num_rows($rlt))) { ?>
        <ul class="list">
        <?php
        while($row = sql_fetch_array($rlt)) {
            //해시태그
            $hashtag = '';
            if(!empty($row['he_hashtag'])) {
                $tag = explode(',',$row['he_hashtag']);
                for($j=0; $j<count($tag); $j++) {
                    $sch_class = '';
                    if($sch_tag == $tag[$j] || strpos($tag[$j], $search) !== false) {
                        $sch_class = " class='sch_word' ";
                    }
                    $hashtag .= '<li '.$sch_class.'>'.$tag[$j].'</li>';
                }
            }
            // 답변수 (공개설정이 전체공개)
            $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}' and del_yn is null; ")['count'];
            // 조회수
            $v_count = selectCount('g5_helpme_action', 'helpme_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터
            // 에디터에 이미지가 있을 경우
            $img_flag = false;
            if(strpos($row['he_contents'], '<img ') !== false) {
                $img_flag = true;
            }
        ?>
            <li>
                <div class="left <?php echo $img_flag ? '' : 'noimg'; ?>">
                    <a href="<?php echo G5_BBS_URL ?>/help_view.php?idx=<?=$row['idx']?>" class="sch">
                        <h3><?php if(!empty($row['he_bunker'])) { ?><i><?=number_format($row['he_bunker'])?></i><?php } ?><?=$row['he_subject']?></h3> <!--적립 BUNKER / 제목-->
                        <span><?=strip_tags($row['he_contents'])?></span>
                    </a>
                    <ul class="tag"><?=$hashtag?></ul>
                    <div class="list_info">
                        <span class="reply">답변수 <em><?=number_format($a_count)?></em></span>
                        <span class="view">조회수 <em><?=number_format($v_count)?></em></span>
                        <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
                    </div>
                </div>
                <?php
                if($img_flag) {
                    $img = explode('"', explode('src="', $row['he_contents'])[1])[0];
                ?>
                <!--<div class="right">
                    <img src="<?/*=$img*/?>">
                </div>-->
                <?php
                }
                ?>
            </li>
        <?php } ?>
        </ul>
        <?php } else { ?>
        <div class="nodata"><p>검색 결과가 없습니다.</p></div>
        <?php
        }
        ?>
    </div>
</div>
<?php
}
if($category == '커뮤니티') {
    $sql_table = "g5_community";
    $sql_where .= "and del_yn is null 
                   and (co_subject like '%{$search}%' or co_contents like '%{$search}%')";
    $sql_orderby = "order by idx desc ";
    $rlt = sql_query(" select * from {$sql_table} {$sql_where} {$sql_orderby} ");
?>
<div id="tab02" class="tab_box">
    <div id="area_community">
        <?php if(!empty($search) && !empty(sql_num_rows($rlt))) { ?>
        <ul class="board_list">
            <?php
            while($row = sql_fetch_array($rlt)) {
                // 답변수
                $a_count = sql_fetch(" select count(*) as count from g5_community_answer where community_idx = '{$row['idx']}' and del_yn is null; ")['count'];
                // 조회수
                $v_count = selectCount('g5_community_action', 'community_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터
            ?>
            <li class="left">
                <a href="<?=G5_BBS_URL?>/community_view.php?idx=<?=$row['idx']?>" class="sch">
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
            <?php } ?>
        </ul>
        <?php } else { ?>
        <div class="nodata"><p>검색 결과가 없습니다.</p></div>
        <?php } ?>
    </div>
</div>
<?php
}
if($category == '커리어') {
    $sql_table = "g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id";
    $sql_where .= " and (date_format(now(), '%Y-%m-%d') <= cr.cr_eddate or cr_always = 'Y') and cr_state is null
                    and (cr_subject like '%{$search}%' or mb_company_name like '%{$search}%' or cr_hashtag like '%{$search}%') ";
    $sql_orderby = "order by idx desc ";
    $rlt = sql_query(" select cr.*, mb.mb_category, mb.mb_company_name from {$sql_table} {$sql_where} {$sql_orderby} ");
?>
<div id="tab03" class="tab_box">
    <?php if(!empty($search) && !empty(sql_num_rows($rlt))) { ?>
    <ul class="career_list">
        <?php
        while($row = sql_fetch_array($rlt)) {
            // 채용공고 D-DAY
            $date = $row['cr_eddate'];
            $todate = date("Y-m-d", time());
            $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
        ?>
        <li>
            <a href="<?=G5_BBS_URL?>/career_view.php?idx=<?=$row['idx']?>">
                <div class="top sch">
                    <div class="company_logo"><?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?></div>
                    <span><?=$row['mb_company_name']?></span>
                    <h3><?=$row['cr_subject']?></h3>
                </div>
                <div class="bottom">
                    <span><?=$recruit_salary[$row['cr_work_salary']]?></span><!-- 연봉 -->
                    <em><?=!empty($row['cr_always']) ? '상시채용' : 'D - '.$dday; ?></em><!-- 남은기간 -->
                </div>
            </a>
        </li>
        <?php } ?>
    </ul>
    <?php } else { ?>
    <div class="nodata"><p>검색 결과가 없습니다.</p></div>
    <?php } ?>
</div>
<?php
}
if($category == '기업의뢰') {
    $sql_table = "g5_company_inquiry";
    $sql_where .= " podosea != 'Y' and ci_deadline_date >= date_format(now(), '%Y-%m-%d') and del_yn is null 
                    and (ci_subject like '%{$search}%' or ci_contents like '%{$search}%' or ci_category like '%{$search}%' 
                    or ci_maker like '%{$search}%' or ci_model like '%{$search}%' or ci_serial_no like '%{$search}%') ";
    $sql_orderby = "order by idx desc ";
    $rlt = sql_query(" select * from {$sql_table} {$sql_where} {$sql_orderby} ");
?>
<div id="tab04" class="tab_box">
    <div id="help_list">
        <?php if(!empty($search) && !empty(sql_num_rows($rlt))) { ?>
        <ul class="list">
            <!-- 리스트 10 -->
            <?php
            while($row = sql_fetch_array($rlt)) {
                $date = $row['ci_deadline_date'];
                $todate = date("Y-m-d", time());
                $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
            ?>
            <li class="company">
                <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$idx?>" class="sch">
                    <div class="title">
                        <em><?=$row['ci_category']?></em><!-- 카테고리 -->
                        <h3><?=$row['ci_subject']?></h3> <!-- 제목 -->
                    </div>
                    <div class="cont">
                        <ul class="list_text">
                            <li><em>Maker</em><span><?=$row['ci_maker']?></span></li><!-- 제조사 -->
                            <li><em>Model</em><span><?=$row['ci_model']?></span></li><!-- 모델 -->
                            <li class="period"><span><?=$dday?>일 남음</span></li><!-- 견적남은기간 -->
                        </ul>
                        <div class="list_info">
                            <span class="data"><?=replaceDateFormat($row['wr_datetime'])?></span> <!-- 의뢰올린날자 -->
                        </div>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php } else { ?>
        <div class="nodata"><p>검색 결과가 없습니다.</p></div>
        <?php } ?>
    </div>
</div>
<?php
}
if($category == '기업검색') {
    $sql_table = "g5_member";
    $sql_where .= "and mb_category = '기업'
                   and (mb_company_name like '%{$search}%' or mb_company_introduce like '%{$search}%' or mb_hashtag like '%{$search}%') ";
    $sql_orderby = "order by mb_no desc ";
    $rlt = sql_query(" select * from {$sql_table} {$sql_where} {$sql_orderby} ");
?>
<div id="tab05" class="tab_box">
    <div id="help_list">
        <?php if(!empty($search) && !empty(sql_num_rows($rlt))) { ?>
        <ul class="list company_search_list">
            <?php
            while($row = sql_fetch_array($rlt)) {
                //해시태그
                $hashtag = '';
                if(!empty($row['mb_hashtag'])) {
                    $tag = explode(',',$row['mb_hashtag']);
                    for($j=0; $j<count($tag); $j++) {
                        $sch_class = '';
                        if($sch_tag == $tag[$j] || strpos($tag[$j], $search) !== false) {
                            $sch_class = " class='sch_word' ";
                        }
                        $hashtag .= '<li '.$sch_class.'>'.$tag[$j].'</li>';
                    }
                }
            ?>
            <li class="company">
                <a href="<?php echo G5_BBS_URL ?>/company.php?mb_no=<?=$row['mb_no']?>" class="sch">
                    <div class="title">
                        <div class="company_logo"><?=getProfileImg($row['mb_id'], $row['mb_category'])?></div>
                        <div class="company_info">
                            <h3><?=$row['mb_company_name']?></h3><!-- 회사이름 -->
                            <div class="area_star">
                                <div class="img_star v<?=companyScore($row['mb_id'])?>">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cont">
                        <span class="intro"><?=$row['mb_company_introduce']?></span>
                        <ul class="tag">
                            <?=$hashtag?>
                        </ul>
                        <div class="list_info">
                            <span class="reply">총 거래건수 <em><?=completeCount($row['mb_id'])?></em></span>
                            <span>리뷰수 <em><?=reviewCount($row['mb_id'])?></em></span>
                        </div>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php
        } else {
        ?>
        <div class="nodata"><p>검색 결과가 없습니다.</p></div>
        <?php
        }
        ?>
    </div>
</div>
<?php
}
?>