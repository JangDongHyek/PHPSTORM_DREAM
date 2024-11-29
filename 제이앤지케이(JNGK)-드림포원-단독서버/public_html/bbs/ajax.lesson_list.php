<?php
include_once("./_common.php");

/** 회원 - 레슨정보 (ajax) -- 월 변경 시 사용 **/

$year = $_POST['year'];
$month = $_POST['month'];

//if($private) {
//    $member['mb_no'] = '17799';
//}

$sql = " select *, substring(lesson_date, 6, 7) as lesson_date from g5_lesson_diary where lesson_date like '{$year}.{$month}%' and mb_no = {$member['mb_no']} order by idx desc ";
//echo $sql;
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
            <div class="ld_count"><?=$row['lesson_count']?>회차</div> <!-- 회차는 수정 필요 -->

            <div class="ld_btn_wrap">
                <!--레슨내용 보기 버튼-->
                <div class="ld_lescont">
                <a href="javascript:void(0);" onclick="diary_view('<?=$row['idx']?>')"><i class="fas fa-pencil-alt"></i><span class="sound_only">레슨내용보기</span></a>
                <input type="hidden" id="hidden_contents_<?=$row['idx']?>" value="<?=$row['lesson_contents']?>">
                </div><!--.ld_lescont-->

                <!--동영상 다운로드/재생 버튼-->
                <?php if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) { ?>
                <div class="ld_down">
                    <a class="down_video" href="javascript:fileDownload('<?=$video['img_file']?>','<?=$video['img_source']?>','<?=$row['idx']?>')"><i class="fas fa-arrow-alt-to-bottom"></i></a>
                </div>

                <div class="ld_movie" onclick="video_play('<?=$row['idx']?>', '<?=$video_src?>');"><a><img src="<?php echo G5_IMG_URL ?>/ico_movie.gif" alt=""/></a></div>
                <?php } ?>
            </div><!--.ld_btn_wrap-->
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
?>
