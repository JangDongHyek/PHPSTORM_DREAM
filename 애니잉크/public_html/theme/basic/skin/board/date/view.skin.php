<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<article id="bo_v" style="width:<?php echo $width; ?>">

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
        ?>
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?><?php echo $where_url ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?><?php echo $where_url ?>" class="btn_b01" onclick="del_new(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?><?php echo $where_url ?>" class="btn_b01">목록</a></li>
            <?php if ($write_href && $sch_wr_2 != '임대해지') { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <div class="tbl_wrap">
        <table class="b_tbl">
            <tbody>
            <tr>
                <th class="b_th">등록일자</th>
                <td class="b_td"><?php echo $view['wr_1'] ?></td>
            </tr>
            <tr>
                <th class="b_th">등록자</th>
                <td class="b_td"><?php echo $view['wr_name'] ?></td>
            </tr>
            <tr>
                <th class="b_th">모델명</th>
                <td class="b_td"><?php echo $view['wr_subject'] ?></td>
            </tr>
            <tr>
                <th class="b_th">증상내용</th>
                <td class="b_td"><?php echo $view['wr_2'] ?></td>
            </tr>
            <tr>
                <th class="b_th">증상첨부파일</th>
                <td class="b_td">
                    <?php
                    // 가변 파일
                    for ($i=0; $i<2; $i++) {
                        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
                            ?>
                                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                                </a>
                            <?php
                        }
                    }
                    ?>

                </td>
            </tr>
            <tr>
                <th class="b_th">해결방법</th>
                <td class="b_td"><?php echo $view['wr_3'] ?></td>
            </tr>
            <tr>
                <th class="b_th">해결관련첨부파일</th>
                <td class="b_td">
                    <?php
                    // 가변 파일
                    for ($i=2; $i<4; $i++) {
                        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
                            ?>
                            <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                                <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                                <strong><?php echo $view['file'][$i]['source'] ?></strong>
                            </a>
                            <?php
                        }
                    }
                    ?>

                </td>
            </tr>
            <tr>
                <th class="b_th">비고</th>
                <td class="b_td"><?php echo get_view_thumbnail($view['content']); ?></td>
            </tr>
            </tbody>
        </table>


    </div>

</article>
<!-- } 게시판 읽기 끝 -->


<script>
    $(function() {
        $("a.view_image").click(function() {
            window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
            return false;
        });

        // 이미지 리사이즈
        $("#bo_v_atc").viewimageresize();
    });
</script>
<!-- } 게시글 읽기 끝 -->