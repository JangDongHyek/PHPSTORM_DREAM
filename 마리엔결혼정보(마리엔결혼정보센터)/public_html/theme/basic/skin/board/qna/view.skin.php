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
    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1>
    <section id="bo_v_info">
        <h2>페이지 정보</h2>
        작성자 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
        <span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
        조회<strong><?php echo number_format($view['wr_hit']) ?>회</strong>
        <?php /*?>댓글<strong><?php echo number_format($view['wr_comment']) ?>건</strong><?php */?>
    </section>
    </header>

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
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>

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

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">신청하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <div class="qna_wrap">
        <div class="form">
            <div class="form_wrap">
                <div class="select grid grid6">
                    <input type="checkbox" id="join_fee" name="join_fee" checked disabled><label for="join_fee">가입비</label>
                    <input type="checkbox" id="meeting_count" name="meeting_count" disabled><label for="meeting_count">만남횟수</label>
                    <input type="checkbox" id="registration_method" name="registration_method" disabled><label for="registration_method">가입방법</label>
                    <input type="checkbox" id="marriage_rate" name="marriage_rate" disabled><label for="marriage_rate">성혼율</label>
                    <input type="checkbox" id="membership_eligibility" name="membership_eligibility" disabled><label for="membership_eligibility">가입자격</label>
                    <input type="checkbox" id="member_count" name="member_count" disabled><label for="member_count">회원수</label>
                </div>
                <textarea placeholder="문의내용 직접 입력" disabled>가입비 관련해서 자세한 안내 부탁드립니다.</textarea>
            </div>
            <div class="form_wrap">
                <h3>결혼 상대의 직업은? <span>(복수선택가능)</span></h3>
                <div class="select grid grid4">
                    <input type="checkbox" id="q7_1" name="chk_work1" value="Y" class="rd_job" checked disabled><label for="q7_1">사무/금융직</label>
                    <input type="checkbox" id="q7_2" name="chk_work2" value="Y" class="rd_job" checked disabled><label for="q7_2">연구원, 엔지니어</label>
                    <input type="checkbox" id="q7_3" name="chk_work3" value="Y" class="rd_job" disabled><label for="q7_3">건축, 설계</label>
                    <input type="checkbox" id="q7_4" name="chk_work4" value="Y" class="rd_job" disabled><label for="q7_4">교사 및 강사</label>
                    <input type="checkbox" id="q7_5" name="chk_work5" value="Y" class="rd_job" disabled><label for="q7_5">공무원, 공사</label>
                    <input type="checkbox" id="q7_6" name="chk_work6" value="Y" class="rd_job" disabled><label for="q7_6">승무원/항공관련</label>
                    <input type="checkbox" id="q7_7" name="chk_work7" value="Y" class="rd_job" disabled<label for="q7_7">서비스/영업</label>
                    <input type="checkbox" id="q7_8" name="chk_work8" value="Y" class="rd_job" disabled><label for="q7_8">의사, 한의사, 약사</label>
                    <input type="checkbox" id="q7_9" name="chk_work9" value="Y" class="rd_job" disabled><label for="q7_9">변호사, 법조인</label>
                    <input type="checkbox" id="q7_10" name="chk_work10" value="Y" class="rd_job" disabled><label for="q7_10">회계사 등 전문직</label>
                    <input type="checkbox" id="q7_11" name="chk_work11" value="Y" class="rd_job" disabled><label for="q7_11">간호 및 의료사</label>
                    <input type="checkbox" id="q7_12" name="chk_work12" value="Y" class="rd_job" disabled><label for="q7_12">자영업, 사업</label>
                    <input type="checkbox" id="q7_13" name="chk_work13" value="Y" class="rd_job" disabled><label for="q7_13">유학생, 석/박사</label>
                    <input type="checkbox" id="q7_14" name="chk_work14" value="Y" class="rd_job" disabled><label for="q7_14">프리랜서 및 기타</label>

                </div>
            </div>
            <div class="form_wrap">
                <h3>상담을 위한 정보를 입력해주세요</h3>

                <div class="flex">
                    <input type="text" placeholder="이름" value="류선재" disabled>
                    <div class="select grid grid2">
                        <input type="radio" id="female" name="gender" checked><label for="female">여자</label>
                        <input type="radio" id="male" name="gender"><label for="male">남자</label>
                    </div>
                </div>
                <input type="text" placeholder="휴대폰번호" value="010-1234-1234" disabled>
                <div class="flex">
                    <select disabled>
                        <option selected>출생년도</option>
                    </select>
                    <select disabled>
                        <option>최종학력</option>
                        <option>대학교졸업</option>
                        <option selected>대학교중퇴</option>
                        <option>대학교재학</option>
                        <option>대학원졸업</option>
                        <option>대학(2,3년제)졸업</option>
                        <option>대학(2,3년제)중퇴</option>
                        <option>고등학교 졸업</option>
                        <option>기타</option>
                    </select>
                    <select disabled>
                        <option>거주지</option>
                        <option value="1">서울</option>
                        <option value="2">경기(북부 - 고양,파주,의정부 등)</option>
                        <option value="3" selected>경기(서부 - 김포,광명,시흥 등)</option>
                        <option value="4">경기(남부 - 분당,과천,수원,용인 등)</option>
                        <option value="5">경기(동부 - 구리,하남,남양주 등)</option>
                        <option value="6">인천/부천</option>
                        <option value="7">강원도</option>
                        <option value="8">대전</option>
                        <option value="9">세종</option>
                        <option value="10">대구</option>
                        <option value="11">광주</option>
                        <option value="12">울산</option>
                        <option value="13">부산</option>
                        <option value="14">충북</option>
                        <option value="15">충남</option>
                        <option value="16">경북</option>
                        <option value="17">경남</option>
                        <option value="18">전북</option>
                        <option value="19">전남</option>
                        <option value="20">제주</option>
                        <option value="21">해외</option>
                        <option value="22">기타</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <section id="bo_v_atc">
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

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

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