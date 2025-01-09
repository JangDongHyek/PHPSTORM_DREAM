<?php
$sub_id="search";
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<?php if ($result_cnt == 0) { ?>
<p class="search_tit"><span>'<?php echo $stx ?>'</span> 에 대한 검색결과 <?=number_format($result_cnt)?>개</p>
    <div class="empty_list">
           <p><i class="fal fa-search fa-3x"></i></p>
           <p class="t_padding17">검색된 자료가 하나도 없습니다.<br />다른 키워드를 사용해 보세요.</p>
    </div>
<?php }else { ?>
<p class="search_tit"><span>'<?php echo $stx ?>'</span> 에 대한 검색결과 <?=number_format($result_cnt)?>개</p>
<section id="cate_depth">
    <div class="cateTit"><h2>카테고리</h2></div>
    <div class="cateList">
        <div class="sort">

                    <?php echo $title_name ?>

<!--                <li class="check">신규등록 순</li>-->
<!--                <li>인기 순</li>-->
<!--                <li>추천 순</li>-->
<!--                <li>평점 순</li>-->
<!--                <li>응답 순</li>-->

        </div>
        <div class="depthList">
            <ul>
               <?= $ctg_html ?>
            </ul>
        </div>
    </div>
</section>
<?php  }  ?>

<!-- 전체검색 시작 { -->
<? /* <form name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
<input type="hidden" name="srows" value="<?php echo $srows ?>">
<fieldset id="sch_res_detail">
    <legend>상세검색</legend>
    <?php echo $group_select ?>
    <script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>

    <label for="sfl" class="sound_only">검색조건</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject||wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
        <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
        <option value="wr_name"<?php echo get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
    </select>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $text_stx ?>" id="stx" required class="frm_input required" maxlength="20">
    <input type="submit" class="btn_submit" value="검색">

    <script>
    function fsearch_submit(f)
    {
        if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
        var cnt = 0;
        for (var i=0; i<f.stx.value.length; i++) {
            if (f.stx.value.charAt(i) == ' ')
                cnt++;
        }

        if (cnt > 1) {
            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        f.action = "";
        return true;
    }
    </script>
    <input type="radio" value="or" <?php echo ($sop == "or") ? "checked" : ""; ?> id="sop_or" name="sop">
    <label for="sop_or">OR</label>
    <input type="radio" value="and" <?php echo ($sop == "and") ? "checked" : ""; ?> id="sop_and" name="sop">
    <label for="sop_and">AND</label>
</fieldset>
</form> */ ?>


<div id="sch_result">

    <hr>

    <section id="goods">
        <div class="in">
            <!--<h2 class="title">회원들이 많이 <strong>찾아 본</strong> 서비스</h2>회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
            <div class="list cf">
                <?php
                for ($i = 0;  $row = sql_fetch_array($result); $i++){
                    // 재능 등록 이미지 (첫번째 이미지)
                    $file_sql = " select * from {$g5['board_file_table']} where bo_table = '{$file_name}' and wr_id = {$row[$idx]} order by bf_datetime limit 1 ";
                    $file_row = sql_fetch($file_sql);

                    $mb = get_member($row['mb_id']);

                    $like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$row[$idx]}' and mb_id = '{$member['mb_id']}' ";
                    $like_row = sql_fetch($like_sql);

                    ?>
                    <div class="thm">

                        <div class="mg">
                            <!--<span class="pri">PRIME</span>--><!--prime 광고등록 상품은 해당 아이콘이 뜨도록 ==> 정해진 내용이 없어서 우선 숨김 -->
                            <div class="heart" id="heart_div_<?=$row[$idx]?>">
                                <?php if (isset($like_row['li_idx'])){ ?>
                                    <button type="button" onclick="like_chk('off',<?=$row[$idx]?>)" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                                <?php }else{ ?>
                                    <button type="button" onclick="like_chk('on',<?=$row[$idx]?>)" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                                <?php } ?>
                            </div>
                            <a href="<?php echo G5_BBS_URL.$url.$row[$idx] ?>">
                                <div class="mg_in">
                                    <div class="over">

                                        <?php
                                    if ($option == 'video_lecture') {

                                        $youtube_key = substr($row['wr_link1'], -11, 11);

                                        if ($youtube_key) {
                                            $img_content = '<img src="https://img.youtube.com/vi/' . $youtube_key . '/mqdefault.jpg" width="100%" height="100%"">';
                                        } else {
                                            $img_content = '<span style="width:' . $board['bo_gallery_width'] . 'px;line-height:' . $board['bo_gallery_height'] . 'px" class="noimg">no image</span>';
                                        }


                                        echo $img_content;
                                    }else{
                                        if($file_row['wr_id']) { ?>
                                            <img src="<?php echo G5_DATA_URL ?>/file/<?=$file_name?>/<?=$file_row['bf_file']?>">
                                        <?php } else { ?>
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                                        <?php }
                                    }?>
                                    </div>
                                </div><!--상품사진-->
                            </a>
                        </div><!--mg-->
                        <div class="info">
                            <!-- 재능강의 작성자 정보 -->
                            <div id="lecture_writer_list">
                                <div class="mb">
                                    <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                    <div class="mb_info">
                                        <p><?= $mb['mb_nick'] ?>&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo G5_BBS_URL.$url.$row[$idx] ?>">
                                <div class="tit"><?=$row[$title]?></div><!--상품제목(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                <div class="rate cf">
                                    <div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                                    <div class="heart_hit"><span><i class="fas fa-heart"></i></span><span style="margin-left: 5px" id="like_cnt_<?=$row[$idx]?>"><?= like_cnt($row[$idx]) ?></span></div><!--사람들이 좋아요 한 횟수-->
                                </div>
                            </a>
                            <?php if ($option == 'talent'){ ?>
                            <div class="price"><?=number_format($row['pta_pay'])?>원</div><!--상품가격-->
                            <?php } ?>
                        </div>

                    </div>
                <?php } ?>
            </div><!--list-->
        </div><!--in-->
    </section>
    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$made_qstr.'&amp;page='); ?>

</div>
<!-- } 전체검색 끝 -->
<script>
    function like_chk(type,idx) {

        <?php if (!$is_member){ ?>
        swal('회원만 사용가능한 기능입니다.');
        return false;
        <?php } ?>

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            type: "POST",
            data: {
                mode: 'like_chk',
                ta_idx: idx,
                type: type
            },
            dataType:'html',
            success: function(data) {

                $('#heart_div_'+idx).html(data);

                var like_cnt = $('#like_cnt_'+idx).text();
                like_cnt=like_cnt *1
                if (type == 'off'){
                    $('#like_cnt_'+idx).text(like_cnt-1);
                }else{
                    $('#like_cnt_'+idx).text(like_cnt+1);
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        })

    }
</script>