<?php
include_once('./_common.php');

$g5['title'] = '레슨정보';
include_once('./_head.php');

$mb_no = $member['mb_no'];
$mb = get_member_no($mb_no);

// 레슨정보
$lesson = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' ");

$count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = {$mb_no}; ")['count'];
?>

<link rel="stylesheet" href="<?= G5_CSS_URL ?>/style.css">
<style>
    /*#container{ padding-bottom:100px !important;}*/
</style>

<div id="lesson_cont">
    <div id="lesson_info">
        <div class="les_tits">현재 레슨상품</div>
        <div class="cf">
            <div class="les_tit">
                <?=$lesson['lesson_name']?> <span class="les_tit_term"><?=$lesson['lesson_count']?></span>
            </div><!--.les_tit-->
            <div class="les_tit_ico"><img src="<?php echo G5_IMG_URL ?>/ico_les_tit.gif" alt=""/></div>
        </div>

        <div class="les_date">기간 : 2020.08.01 ~ 2020.11.30</div>

        <div class="les_teacher">
            <span>담당</span> <?= $mb['mb_charge_pro'] ?> 프로 <strong><?=$mb['mb_center']?></strong>
        </div><!--.les_teacher-->
    </div><!--#lesson_cont-->


    <!--레슨정보 시작-->
    <div id="lesson_acc">

        <div id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
                <!--날짜바--> <!-- 레슨현황 조회하여 lesson01 div, collapse01 div 둘 다 수정 -->
                <div class="panel-heading" role="tab" id="lesson01">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse01" aria-expanded="true" aria-controls="collapseOne">
                            <i class="far fa-list-ul"></i> 2020.10
                            <div class="arrow_down"><i class="fas fa-angle-down"></i></div>
                        </a>
                    </h4>
                </div><!--.panel-heading-->
                <!--세부내용-->

                <div id="collapse01" class="panel-collapse collapse" role="tabpanel" aria-labelledby="lesson01">
                    <div class="panel-body" style="height: 450px;overflow: hidden;">
                        <div id="les_detail">
                            <ul>
                                <?php
                                if ($count > 0) {
                                $sql = " select *, substring(lesson_date, 6, 7) as lesson_date from g5_lesson_diary where mb_no = '{$member['mb_no']}' order by idx desc ";
                                $result = sql_query($sql);

                                for($i=0; $row=sql_fetch_array($result); $i++) {
                                ?>
                                <li>
                                    <div class="les_dtit">
                                        <div class="ld_date"><?=str_replace('-','.',$row['lesson_date'])?></div>
                                        <div class="ld_count"><?=$row['lesson_count']?>회차</div> <!-- 회차는 수정 필요 -->
                                        <div class="ld_movie"><a><img src="<?php echo G5_IMG_URL ?>/ico_movie.gif" alt=""/></a></div>
                                    </div><!--.les_dtit-->
                                    <div class="my_memo">
                                        <textarea class="doc_text" name="doc_text" placeholder="100자 이내로 적어주세요" style="resize: unset;"></textarea>
                                        <p id="counter">0 / 최대 100자</p>

                                        <!--메모 등록되어 있으면, '메모수정'으로-->
                                        <div class="my_memo_btn"><input type="submit" value="메모 등록하기" class="btn_memo"/></div>
                                    </div><!--.my_memo-->
                                </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div><!--#les_detail-->
                    </div><!--.panel-body-->
                </div>

            </div><!--.panel-->

        </div>

    </div><!--#lesson_acc-->
    <!--레슨정보 끝-->


    <!--레슨정보가 없을경우-->
    <?php if ($count == 0) { ?>
        <div class="no_les_list">
            <i class="fal fa-comments"></i> 레슨정보가 없습니다.
        </div>
    <?php } ?>
</div><!--#lesson_list-->


<script>
    //textarea 글자 수 제한
    $('.doc_text').keyup(function (e) {
        var content = $(this).val();
        $('#counter').html("" + content.length + " / 최대 100자");    //글자수 실시간 카운팅

        if (content.length > 100) {
            alert("최대 100자까지 입력 가능합니다.");
            $(this).val(content.substring(0, 100));
            $('#counter').html("100 / 최대 100자");
        }
    });
</script>

<?php
include_once('./_tail.php');
?>