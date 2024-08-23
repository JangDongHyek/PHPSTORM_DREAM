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
    <div class="d-flex border fs-5 p-4 bg-light">
        <div class="me-2 mobile-none">
            <i class="bi bi-newspaper"></i>
        </div>
        <div>
            <?php
            if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </div>
    </div>
    <div class="d-lg-flex justify-content-between border-bottom p-4 fs-6_5">
        <div class="d-flex mb-2 mb-lg-0">
            <?php
            if ($view['file']['count']) {
                $cnt = 0;
                for ($i=0; $i<count($view['file']); $i++) {
                    if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                        $cnt++;
                }
            }
            ?>

            <?php if($cnt) { ?>
                <!-- 첨부파일 시작 { -->
                <ul>
                    <?php
                    // Variable files
                    for ($i=0; $i<count($view['file']); $i++) {
                        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
                            ?>
                            <li>
                                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                                    <i class="bi bi-cloud-download me-2"></i>
                                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                                </a>
                                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?> downloads</span>
                                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <!-- } 첨부파일 끝 -->
            <?php } ?>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <i class="bi bi-pen me-2"></i>
                <div><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></div>
            </div>
            <div class="mx-3 text-secondary">|</div>
            <div class="d-flex">
                <i class="bi bi-calendar-check me-2"></i>
                <div><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></div>
            </div>
            <div class="mx-3 text-secondary">|</div>
            <div class="d-flex">
                <i class="bi bi-eye me-2"></i>
                <div><?php echo number_format($view['wr_hit']) ?></div>
            </div>
        </div>
    </div>


    <?php
    if ($view['link']) {
     ?>
     <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 관련링크 끝 -->
    <?php } ?>


    <section id="bo_v_atc" class="pt-3">
        <h2 id="bo_v_atc_title">본문</h2>

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
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

        <?php /*?><!-- 스크랩 추천 비추천 시작 { -->
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act">
            <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn_b01" onclick="win_scrap(this.href); return false;">스크랩</a><?php } ?>
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">추천 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good"></b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천  <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- } 스크랩 추천 비추천 끝 --><?php */?>
    </section>

    <?php
    //include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    //include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

    <!-- 링크 버튼 시작 {
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
     } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

<div class="d-flex justify-content-end py-4 border-top border-bottom">
    <?php
    ob_start();
    ?>
    <?php if ($update_href) { ?>
        &nbsp;<button class="btn btn-outline-primary p-3 px-5" onclick="window.location.href='<?php echo $update_href ?>';">Edit</button>
    <?php } ?>
    <?php if ($delete_href) { ?>
        &nbsp;<button class="btn btn-outline-primary p-3 px-5" onclick="del('<?php echo $delete_href ?>'); return false;">Delete</button>
    <?php } ?>
    <?php if ($search_href) { ?>
        &nbsp;<button class="btn btn-outline-primary p-3 px-5" onclick="window.location.href='<?php echo $search_href ?>';">Search</button>
    <?php } ?>
    &nbsp;<button class="btn btn-outline-primary p-3 px-5" onclick="window.location.href='<?php echo $list_href ?>';">List View</button>
    <?php if ($write_href) { ?>
        &nbsp;<button class="btn btn-outline-primary p-3 px-5" onclick="window.location.href='<?php echo $write_href ?>';">Write</button>
    <?php } ?>
    <?php
    $link_buttons = ob_get_clean();
    echo $link_buttons; // Output or store this variable where needed
    ?>
</div>
<!-- 게시물 상단 버튼 시작 { -->

<!-- } 게시물 상단 버튼 끝 -->
<?php if ($prev_href || $next_href) { ?>
    <?php if ($prev_href) { ?><div class="d-flex border-bottom p-3">
        <div class="text-center" style="width: 100px;">Back</div>
        <div class="mx-lg-5 mx-2">|</div>
        <div class="w-100 text-break-1">
            <a class="" href="<?php echo $prev_href ?>" target="_self">Korea Industrial Human Resources Corporation signs a parallel
                work-study system agreement</a>
        </div>
    </div>
    <?php } ?>
    <?php if ($next_href) { ?>
    <div class="d-flex border-bottom p-3">
        <div class="text-center" style="width: 100px;">Next</div>
        <div class="mx-lg-5 mx-2">|</div>
        <div class="w-100 text-break-1">
            <a class="" href="<?php echo $next_href ?>" target="_self">Busan Industrial High School's industry-academic cooperation
                agreement was signed</a>
        </div>
    </div>
    <?php } ?>
<?php } ?>


<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

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

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->