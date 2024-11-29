<?php
include_once('./_common.php');

$g5['title'] = '레슨정보';
include_once('./_head.php');

$mb_no = $member['mb_no'];
//if($private) {
//    $mb_no = 18292;
//    $member['mb_no'] = 18292;
//}
$mb = get_member_no($mb_no);

// 레슨정보
$lesson = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' and center_code = '{$mb['center_code']}' ");
//if($private) {
//    print_r($lesson);
//}

$year = date('Y');
$month = date('m');

$count = sql_fetch(" select count(*) as count from g5_lesson_diary where lesson_date like '{$year}.{$month}%' and mb_no = {$mb_no}; ")['count'];
?>

<link rel="stylesheet" href="<?= G5_CSS_URL ?>/style.css?v=<?=G5_CSS_VER?>">
<style>
    #container{ padding-bottom:120px !important;}
</style>

<!--동영상재생모달 시작-->
<div id="lere_modal2">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="video_stop();"><span aria-hidden="true">&times;</span></button>
                <div class="modal-header">
                    동영상 재생
                </div>

                <div class="modal-body">

                </div>
            </div><!--.modal-body-->
        </div>
    </div>
</div><!--#lere_modal2-->
<!--동영상재생모달 끝-->

<!--레슨내용 보기 모달 시작-->
<div id="lere_modal3">
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-header">레슨내용</div>
                <div class="modal-body" style="white-space: pre-wrap;">

                </div>
            </div><!--.modal-body-->
        </div>
    </div>
</div><!--#lere_modal3-->
<!--레슨내용 보기 모달 끝-->





<div id="lesson_cont">
    <div id="lesson_info">
        <div class="les_tits">현재 레슨상품</div>
        <div class="cf">
            <div class="les_tit">
                <?=$lesson['lesson_name']?> <span class="les_tit_term"><?=$lesson['lesson_count']?></span>
            </div><!--.les_tit-->
            <div class="les_tit_ico"><img src="<?php echo G5_IMG_URL ?>/ico_les_tit.gif" alt=""/></div>
        </div>

        <div class="les_date">등록일 : <?=substr($mb['mb_reg_date'], 0, 10)?></div>

        <div class="les_teacher">
            <span>담당</span> <?= $mb['mb_charge_pro'] ?> 프로 <strong><?=$mb['mb_center']?></strong>
        </div><!--.les_teacher-->
    </div><!--#lesson_cont-->


    <!--레슨정보 시작-->
    <div id="lesson_acc">

        <div id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default" style="text-align: center;">
                <button type="button" title="prev" onclick="prev_next('prev');"><i class="far fa-angle-left"></i><span class="sound_only">이전달</span></button>
                <span class="year"><?=date('Y')?></span>년
                <span class="month"><?=date('m')?></span>월
                <button type="button" title="next" onclick="prev_next('next');"><i class="far fa-angle-right"></i><span class="sound_only">다음달</span></button>
            </div><!--.panel-->

            <div class="panel-body">
            	<div class="les_scroll">
                <p style="text-align: right;font-size: 13px;">※ 영상은 3개월 이후 자동 삭제됩니다.</p>
                <div id="les_detail">
                    <?php
                    // 레슨 정보 있음
                    if ($count > 0) {
                        $sql = " select *, substring(lesson_date, 6, 7) as lesson_date from g5_lesson_diary where lesson_date like '{$year}.{$month}%' and mb_no = '{$member['mb_no']}' order by idx desc ";
                        $result = sql_query($sql);

                        for($i=0; $row=sql_fetch_array($result); $i++) {
                            $video_sql = " select * from g5_lesson_video where diary_idx = '{$row['idx']}' ";
                            $video = sql_fetch($video_sql);
                            $video_src = '';
                            if($video['img_file']) {
                                $video_src = G5_DATA_URL . '/file/lesson/' . $video['img_file'];
                            }
                    ?>
                    <ul>
                        <li>
                            <div class="les_dtit">
                                <div class="ld_date"><?=str_replace('-','.',$row['lesson_date'])?></div>
                                <div class="ld_count"><?=$row['lesson_count']?>회차</div>

                                <div class="ld_btn_wrap">
                                    <!--레슨내용 보기 버튼-->
                                    <div class="ld_lescont">
                                        <a href="javascript:void(0);" onclick="diary_view('<?=$row['idx']?>')"><i class="fas fa-pencil-alt"></i><span class="sound_only">레슨내용보기</span></a>
                                        <!--<input type="hidden" id="hidden_contents_<?/*=$row['idx']*/?>" value="<?/*=$row['lesson_contents']*/?>">-->
                                        <textarea style="display: none;" id="hidden_contents_<?=$row['idx']?>"><?=$row['lesson_contents']?></textarea>
                                    </div><!--.ld_lescont-->

                                    <!--동영상 다운로드/재생 버튼-->
                                    <?php if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) { ?>
                                    <div class="ld_down">
                                        <a class="down_video" href="javascript:fileDownload('<?=$video['img_file']?>','<?=$video['img_source']?>','<?=$row['idx']?>')"><i class="fas fa-arrow-alt-to-bottom"></i></a>
                                    </div>

                                    <div class="ld_movie" onclick="video_play('<?=$row['idx']?>', '<?=$video_src?>');"><a><img src="<?php echo G5_IMG_URL ?>/ico_movie.gif" alt=""/></a></div>
                                    <?php } ?>

                                </div>
                            </div><!--.les_dtit-->
                            <div class="my_memo">
                                <textarea class="doc_text" id="memo<?=$i?>" name="memo<?=$i?>" placeholder="100자 이내로 적어주세요" style="resize: unset;"><?=$row['lesson_mb_memo']?></textarea>
                                <p id="counter<?=$i?>"><?=mb_strlen($row['lesson_mb_memo'], 'utf-8')?> / 최대 100자</p>

                                <!--메모 등록되어 있으면, '메모수정'으로-->
                                <?php if(!empty($row['lesson_mb_memo'])) { $txt = '수정'; } else { $txt = '등록'; } ?>
                                <div class="my_memo_btn"><input type="button" value="메모 <?=$txt?>하기" class="btn_memo" onclick="memo_reg('<?=$row['idx']?>', '<?=$i?>', '<?=$txt?>');"/></div>
                            </div><!--.my_memo-->
                        </li>
                    </ul>
                        <?php
                        }
                    }
                    // 레슨 정보 없음
                    else {
                    ?>
                    <div class="no_les_list"><i class="fal fa-comments"></i> 레슨정보가 없습니다.</div>
                    <?php
                    }
                    ?>
                </div><!--#les_detail-->
                   </div><!--.les_scroll-->
            </div>

        </div>

    </div><!--#lesson_acc-->
    <!--레슨정보 끝-->

</div><!--#lesson_list-->


<script>
    //textarea 글자 수 제한
    $('.doc_text').keyup(function (e) {
        var i = this.id.split('memo')[1];
        var content = $("textarea#memo"+i).val();
        $('#counter'+i).html("" + content.length + " / 최대 100자");    //글자수 실시간 카운팅

        if (content.length > 100) {
            alert("최대 100자까지 입력 가능합니다.");
            $(this).val(content.substring(0, 100));
            $('#counter').html("100 / 최대 100자");
        }
    });

    // 달력 이전달 다음달 클릭
    function prev_next(op) {
        if(op == 'prev') {
            if(Number($('.month').text()) -1 == 0) {
                $('.year').text(Number($('.year').text()) - 1);
                $('.month').text('12');
            } else {
                $('.month').text(addZero(Number($('.month').text()) - 1));
            }
        }
        else {
            if(Number($('.month').text()) + 1 == 13) {
                $('.year').text(Number($('.year').text()) + 1)
                $('.month').text('01');
            } else {
                $('.month').text(addZero(Number($('.month').text()) + 1));
            }
        }

        // 레슨정보 ajax
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_list.php",
            data: { year : $('.year').text(), month : $('.month').text() },
            type: 'POST',
            success : function(data) {
                if(data.length > 0) {
                    $('#les_detail').html('' + data);
                } else {
                    $('#les_detail').html('<div class="no_les_list"><i class="fal fa-comments"></i> 레슨정보가 없습니다.</div>');
                }
                // location.replace(g5_bbs_url+'/lesson_list.php');

                //textarea 글자 수 제한
                $('.doc_text').keyup(function (e) {
                    var i = this.id.split('memo')[1];
                    var content = $("textarea#memo"+i).val();
                    $('#counter'+i).html("" + content.length + " / 최대 100자");    //글자수 실시간 카운팅

                    if (content.length > 100) {
                        alert("최대 100자까지 입력 가능합니다.");
                        $(this).val(content.substring(0, 100));
                        $('#counter').html("100 / 최대 100자");
                    }
                });
            },
        });
    }

    // 메모 등록/수정 (레슨일지idx, 인덱스, 등록/수정여부)
    function memo_reg(idx, i, txt) {
        $.ajax({
            url: g5_bbs_url + "/ajax.lesson_memo_reg.php",
            data: { idx: idx, memo: $("textarea#memo"+i).val() },
            type: 'POST',
            success: function (data) {
                if(data) {
                    swal('메모가 '+txt+'되었습니다.');
                }
                // location.replace(g5_bbs_url+'/lesson_list.php');
            },
        });
    }

    // 동영상 재생 (레슨일지idx, 동영상경로)
    function video_play(idx, video) {
        $('#myModal').modal('show');
        $('#myModal .modal-body').html('<video id="videoPlay" width="100%" height="500" autoplay controls src="'+video+'"></video>');
        // $('#videoPlay')[0].play();
    }

    function addZero(num) {
        return (num < 10) ? '0' + num : num;
    }

    // 레슨일지 조회
    function diary_view(idx) {
        var content = $('#hidden_contents_'+idx).val();

        $('#myModal2').modal('show');
        $('#myModal2 .modal-body').html(content);
    }

    $('#myModal').on('hide.bs.modal', function(e){
        $('#videoPlay')[0].pause();
        // e.stopImmediatePropagation();
    });

    function video_stop() {
        $('#videoPlay')[0].pause();
    }
</script>

<?php
include_once('./_tail.php');
?>
