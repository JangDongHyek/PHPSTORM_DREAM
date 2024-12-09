<?php
$sub_menu = "600300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '신고게시판 상세보기';
include_once('../admin.head.php');

$tbl_name = "report";
$idx = (int)$_GET['idx'];
// $file_count = 2;
$files = array();

$sql = "SELECT A.*, B.mb_name,
        (SELECT mb_name FROM g5_member WHERE mb_no = A.target_no) AS helper_name
        FROM g5_bbs_report A LEFT JOIN g5_member B ON A.writer_no = B.mb_no
        WHERE A.del_yn = 'N' AND A.idx = '{$idx}'";
$row = sql_fetch($sql);
if (!$row) alert("존재하지 않는 글 입니다.");

// 첨부파일 가져오기
// $files = getBbsFiles($tbl_name, $idx);

// 코멘트 가져오기
$comment = getBbsComment($tbl_name, $idx);

// 파라미터 str
$qstr = getQueryString($_GET, ['idx']);

?>

<article id="bo_v" class="max1200">
    <header>
        <h1 id="bo_v_title"></h1>
        <div style="padding: 0 0 10px; border-bottom: 1px solid #ddd; margin: 0 0 10px;">
            신고카운슬러 <b><?=$row['helper_name']?></b>
        </div>
        <section id="bo_v_info">
            <h2>페이지 정보</h2>
            작성자 <strong><?=$row['mb_name']?> (<?=$row['writer_ip']?>)</strong>
            등록일자 <b><?=substr($row['regdate'], 2, 14)?></b>
        </section>
    </header>

    <div id="bo_v_top">
        <?php ob_start(); ?>
        <ul class="bo_v_com">
            <?/*<li><a href="./report_form.php?idx=<?=$idx?>&<?=$qstr?>" class="btn_b01">수정</a></li>*/?>
            <li><a href="javascript:void(0)" onclick="deleteBbsOne('reportDelete', <?=$idx?>)" class="btn_b01">삭제</a></li>
            <li><a href="./report.php?<?=$qstr?>" class="btn_b01">목록</a></li>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
    </div>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <?
        // 파일 출력
        /*if (count($files) > 0) {
            echo "<div id='bo_v_img'>";
            foreach ($files AS $key=>$val) {
                echo "<div><img src='{$val['source']}' style='max-width: 50%'></div>";
            }
            echo "</div>";
        }*/
        ?>

        <!-- 본문내용 -->
        <div id="bo_v_con"><?=nl2br($row['content'])?></div>

        <!-- 코멘트 -->
        <section id="bo_vc">
            <h2><i class="far fa-comment-alt"></i> 댓글</h2>
            <?
            if (count($comment) > 0) {
                foreach ($comment AS $key=>$val) {
            ?>
            <article>
                <header style="z-index:2">
                    <h1><?=$val['mb_name']?>님의 댓글</h1>
                    <span class="member"><?=$val['mb_name']?></span>
                    <span class="bo_vc_hdinfo">(<?=$val['ip']?>)</span>
                </header>
                <!-- 댓글 출력 -->
                <p><?=nl2br($val['content'])?></p>
                <div class="edit_comment" id="edit_box_<?=$val['idx']?>">
                    <textarea id="comment_<?=$val['idx']?>"><?=$val['content']?></textarea>
                    <br><button type="button" class="btn_submit" onclick="commentEdit(<?=$val['idx']?>)">수정완료</button>
                </div>
                <footer>
                    <span class="bo_vc_hdinfo">
                        <time><?=substr($val['regdate'], 2, 14)?></time>
                    </span>
                    <? //if ($member['mb_no'] == $val['mb_no'] || $member['mb_status'] == "관리자") { // 본인것만 삭제가능 ?>
                    <ul class="bo_vc_act">
                        <li><a href="javascript:void(0)" onclick="commentEditOpen(<?=$val['idx']?>)">수정</a></li>
                        <li><a href="javascript:void(0)" onclick="commentDelete(<?=$val['idx']?>);">삭제</a></li>
                    </ul>
                    <? //} ?>
                </footer>
            </article>
            <?
                } // end foreach
            } else {
                echo '<p id="bo_vc_empty">등록된 답변이 없습니다.</p>';
            }
            ?>
        </section>

        <!-- 코멘트등록 -->
        <aside id="bo_vc_w">
            <form name="fviewcomment" onsubmit="return commentSubmit(this);" method="post" autocomplete="off">
                <input type="hidden" name="tbl_name" value="<?=$tbl_name?>">
                <input type="hidden" name="tbl_idx" value="<?=$idx?>">
                <div class="bo_vc_frm">
                    <textarea name="content" maxlength="10000" required class="required" placeholder="댓글을 입력주세요"></textarea>
                    <div class="btn_confirm">
                        <input type="submit" id="btn_submit" class="btn_submit" value="답변등록">
                    </div>
                </div>
            </form>
        </aside>
    </section>

    <div id="bo_v_bot">
        <?=$link_buttons?>
    </div>

</article>


<?php
include_once ('../admin.tail.php');
?>
