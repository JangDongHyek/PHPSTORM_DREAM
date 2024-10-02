<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

        <div *id="content" class="sub" style="margin-top:-80px">
            <div class="customer_wrap">
                <div class="contains">
                    <div class="main_title_box">
                        <p class="title"><?php echo $board['bo_subject']; ?></p>
                    </div>
                                        

                    <div class="bbs_wrap">
                    <table class="bbs_table bbs_view">
                        <caption><?php echo $board['bo_subject']; ?></caption>
                        <colgroup>
                            <col style="width:12%">
                            <col style="width:64%">
                            <col style="width:10%">
                            <col style="width:14%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col" class="l" colspan="2">
                                    <p class="title"><?php
                                    if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
                                    echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
                                    ?></p></th>
                                <th scope="col" class="date"><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></th>
                                <th scope="col" class="view"><span>조회수</span><?php echo number_format($view['wr_hit']) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4">
                                    <div class="view_content">

                                    <?php
                                    // 파일 출력
                                    $v_img_count = count($view['file']);
                                    if($v_img_count) {
                                        echo "<div id=\"bo_v_img\">\n";

                                        for ($i=0; $i<=count($view['file']); $i++) {
                                            if ($view['file'][$i]['view']) {
                                                //echo $view['file'][$i]['view'];
                                                echo get_view_thumbnail($view['file'][$i]['view']);
                                            }
                                        }

                                        echo "</div>\n";
                                    }
                                     ?>
                                    <!-- 본문 내용 시작 { -->
                                    <?php echo get_view_thumbnail($view['content']); ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>

                        <?php if ($prev_href || $next_href) { ?> 
                            <?php if ($next_href) { ?>
                                <tr class="next">
                                    <td class="label l" nowrap><p>다음글</p></td>
                                    <td colspan="3" class="l"><a href="<?php echo $next_href ?>" class="link"><?=$next_wr_subject?></a></td> 
                                </tr> 
                            <?php } ?> 
                            <?php if ($prev_href) { ?>
                                <tr class="prev">
                                    <td class="label l" nowrap><p>이전글</p></td>
                                    <td colspan="3" class="l"><a href="<?php echo $prev_href ?>" class="link"><?=$prev_wr_subject?></a></td> 
                                </tr> 
                            <?php } ?>
                        <?php } ?> 
                        </tfoot>
                    </table>
					</div>
                    
                    <div class="page_btn">                        
                        <div class="btn_right">

                        <?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="btns">수정</a><?php } ?>
                        <?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" class="btns" onclick="del(this.href); return false;">삭제</a><?php } ?>  
                        <a href="<?php echo $list_href ?>" class="btns">목록</a>
                        <?php if ($reply_href) { ?><a href="<?php echo $reply_href ?>" class="btns">답변</a><?php } ?>
                        <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btns">글쓰기</a><?php } ?>
                      
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- uline_community -->
            <?php include G5_THEME_PATH."/lib/uline.php"; ?>
        </div>
     
 
<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
 
</script>
<!-- } 게시글 읽기 끝 -->