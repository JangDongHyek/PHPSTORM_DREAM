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
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <br>
        <!--삼삼경매 상담문의-->
        <div class="form_wrap">
            <div class="form">
                <dl>
                    <dt><label for="wr_name">이름<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required size="10" maxlength="20" disabled></dd>
                </dl>
                <dl class="flex">
                    <dt>성별<strong class="sound_only">*</strong></dt>
                    <dd>
                        <input type="radio" id="gender_female" name="gender" value="female" checked disabled><label for="gender_female">여성</label>
                        <input type="radio" id="gender_male" name="gender" value="male" disabled><label for="gender_male">남성</label>
                    </dd>
                </dl>
                <dl>
                    <dt><label for="contact">연락처<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="contact" name="contact" placeholder="연락처" value="010-1234-1234" disabled></dd>
                </dl>
                <dl>
                    <dt><label for="email">이메일<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="email" name="email" placeholder="이메일" value="aaa@aa.acom" disabled></dd>
                </dl>
                <dl>
                    <dt><label for="birthdate">생년월일<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="date" id="birthdate" name="birthdate" placeholder="생년월일" value="2000-01-01" disabled></dd>
                </dl>
                <dl>
                    <dt><label for="address">주소<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="address" name="address" placeholder="시(서울시는 구까지 입력 부탁드립니다)" value="부산광역시" disabled></dd>
                </dl>
                <dl>
                    <dt><label for="occupation">직업<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="occupation" name="occupation" placeholder="직업" value="주부" disabled></dd>
                </dl>
                <dl class="flex">
                    <dt>결혼유무<strong class="sound_only">*</strong></dt>
                    <dd>
                        <input type="radio" id="marital_status_single" name="marital_status" value="single" disabled><label for="marital_status_single">미혼</label>
                        <input type="radio" id="marital_status_married" name="marital_status" value="married" checked disabled><label for="marital_status_married">기혼</label>
                    </dd>
                </dl>
                <dl>
                    <dt>투자경험여부<strong class="sound_only">*</strong><span>복수 선택 가능합니다.</span></dt>
                    <dd>
                        <p><input type="checkbox" id="investment_none" name="investment_experience[]" value="none" checked disabled>
                            <label for="investment_none">금융투자상품에 투자해 본 경험 없음</label></p>
                        <p> <input type="checkbox" id="investment_bank" name="investment_experience[]" value="bank" checked disabled><label for="investment_bank">은행, 예/적금, 국채, MMF, CMA등</label></p>
                        <p>  <input type="checkbox" id="investment_fund" name="investment_experience[]" value="fund" disabled><label for="investment_fund">펀드, 원금보장형 ELS, 금융채 등</label></p>
                        <p>  <input type="checkbox" id="investment_gpl" name="investment_experience[]" value="gpl" disabled><label for="investment_gpl">GPL, NPL, 경매 등</label></p>
                        <p>  <input type="checkbox" id="investment_realestate" name="investment_experience[]" value="realestate" disabled><label for="investment_realestate">실물 부동산 투자</label></p>
                        <p>  <input type="checkbox" id="investment_bitcoin" name="investment_experience[]" value="bitcoin" disabled><label for="investment_bitcoin">비트코인</label></p>
                        <p>  <input type="checkbox" id="investment_venture" name="investment_experience[]" value="venture" disabled><label for="investment_venture">벤처투자</label></p>
                    </dd>
                </dl>
                <dl>
                    <dt>희망하는 상담 서비스<strong class="sound_only">*</strong><span>복수 선택 가능합니다.</span></dt>
                    <dd>
                        <p>  <input type="checkbox" id="service_financial" name="desired_service[]" value="financial" disabled><label for="service_financial">재무상담</label></p>
                        <p>   <input type="checkbox" id="service_mortgage" name="desired_service[]" value="mortgage" checked disabled><label for="service_mortgage">담보물채권투자</label></p>
                        <p>   <input type="checkbox" id="service_realestate" name="desired_service[]" value="realestate" disabled><label for="service_realestate">부동산 상담</label></p>
                        <p> <input type="checkbox" id="service_auction" name="desired_service[]" value="auction" checked disabled><label for="service_auction">경매상담</label></p>
                        <p> <input type="checkbox" id="service_legal" name="desired_service[]" value="legal" disabled><label for="service_legal">법무상담</label></p>
                        <p>  <input type="checkbox" id="service_loan" name="desired_service[]" value="loan" disabled><label for="service_loan">대출상담</label></p>
                    </dd>
                </dl>
                <dl class="flex">
                    <dt>희망하시는 상담 유형<strong class="sound_only">*</strong><span>항목에 대한 설명을 입력해주세요</span></dt>
                    <dd>
                        <input type="radio" id="consultation_type_visit" name="consultation_type" value="visit"><label for="consultation_type_visit">내방</label>
                        <input type="radio" id="consultation_type_phone" name="consultation_type" value="phone"><label for="consultation_type_phone">전화</label>
                    </dd>
                </dl>
                <dl>
                    <dt>문의사항<strong class="sound_only">*</strong><span>최대한 구체적으로 적어주세요. </span></dt>
                    <dd>
                        <textarea id="inquiry" name="inquiry" placeholder="최대한 구체적으로 적어주세요."></textarea>
                    </dd>
                </dl>
                <dl class="flex">
                    <dt>통화가능시간대<strong class="sound_only">*</strong><span>항목에 대한 설명을 입력해주세요</span></dt>
                    <dd>
                        <input type="time" id="available_time" name="available_time" value="15:20" disabled>
                    </dd>
                </dl>
            </div>
        </div>
        <!--//삼삼경매 상담문의-->

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