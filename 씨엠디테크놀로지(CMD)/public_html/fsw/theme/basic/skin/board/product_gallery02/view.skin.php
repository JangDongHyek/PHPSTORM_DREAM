<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
$board['bo_subject'] = $view['ca_name'];

$sql="select * from g5_write_category where wr_subject='{$view['ca_name']}' order by wr_id asc";
$row=sql_fetch($sql);
$categorys=explode(",",$row[wr_1]);
?>

<!-- 이미지 슬라이더 -->
<link rel="stylesheet" href="<?= $board_skin_url ?>/fotorama/fotorama.css">
<script src="<?= $board_skin_url ?>/fotorama/fotorama.js"></script>

<!--<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>-->

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php /*echo $board['bo_subject']; */ ?></div>-->
<style>
    .container_title {
        display: none;
    }
</style>
<!--카테고리-->
<div class="bo_top_cate">
    <dl>
        <dt><?php echo $board['bo_subject']; ?></dt>
        <dd class="active"><a><?php echo $view['wr_2']?></a></dd>

    </dl>
</div>
<!--//카테고리-->

<div class="pro_name">
    <h5><?= $view['wr_subject'] ?></h5> <!-- 제품명 -->
    <p>(<?= $view['wr_1'] ?>)</p> <!-- 제품코드 -->
</div>


<article id="bo_v" style="width:<?php echo $width; ?>">

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i = 0; $i < count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
    ?>

    <?php if ($cnt) { ?>
        <!-- 첨부파일 시작 { -->
        <section id="bo_v_file">
            <h2>첨부파일</h2>
            <ul>
                <?php
                // 가변 파일
                for ($i = 0; $i < count($view['file']); $i++) {
                    if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
                        ?>
                        <li>
                            <a href="<?php echo $view['file'][$i]['href']; ?>" class="view_file_download">
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
                for ($i = 1; $i <= count($view['link']); $i++) {
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
                <?php if ($prev_href) { ?>
                    <li><a href="<?php echo $prev_href ?>" class="btn_b01">이전제품</a></li><?php } ?>
                <?php if ($next_href) { ?>
                    <li><a href="<?php echo $next_href ?>" class="btn_b01">다음제품</a></li><?php } ?>
            </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>&sca=<?php echo $sca?>" class="btn_b01">목록</a></li>
            <?php /*?><?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?><?php */ ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <div class="clearfix header">
            <div class="text-center wow fadeIn">
                <div id="foto" class="fotorama" data-width="100%" data-nav="thumbs" data-loop="true"
                     data-autoplay="true">
                    <?php
                    // 파일 출력
                    $v_img_count = count($view['file']);
                    if ($v_img_count) {
                        for ($i = 0; $i <= count($view['file']); $i++) {
                            if ($view['file'][$i]['view']) {
                                $view['file'][$i]['href'] = '';
                                echo get_view_thumbnail($view['file'][$i]['view']);
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div>
                <!--<p class="t1"><?= $view['wr_subject'] ?></p>
                    <p class="t5 t_margin40"><strong>제품 코드</strong> <?= $view['wr_1'] ?></p>  제품코드 -->
                <!--<p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #b6c3cb; margin:0px auto">&nbsp;</p>-->
                <div class="pt_20"></div>
                <p class="wow fadeIn" data-wow-delay="1s">&nbsp;</p>
                <div class="t_margin20"></div>
                <p class="t7 wow fadeIn" data-wow-delay="1s">
                    <!--<strong>제품 간단설명</strong><br>-->
                    <?= $view['wr_4'] ?></p> <!-- 간략설명 -->
                <p class="wow fadeIn" data-wow-delay="1s"
                   style="width:100%; border-top:1px solid rgba(0,0,0,.1); margin:20px auto">&nbsp;</p>
                <!--<p class="t9 pt_20"><?= $view['wr_3'] ?><span>원</span></p>  제품가격 -->
                <!--견적신청버튼-->
                <div class="btn_wrap">
                    <div>
                        <!--<a href="<?php /*echo G5_BBS_URL */ ?>/write.php?bo_table=qna" class="counsel">
                            제품 견적 요청&nbsp;<i class="fa-solid fa-file-import"></i>
                        </a>-->
                        <a class="counsel" data-toggle="modal" data-target="#myModal">
                            제품 견적 요청&nbsp;<i class="fa-solid fa-file-import"></i>
                        </a>

                        <!-- 제품 견적 요청 Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">제품견적 요청내용</h4>
                                    </div>
                                    <div class="modal-body">
                                        <textarea placeholder="제품견적요청 상세내용을 입력해주세요" id="content"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                                        <button type="button" class="btn btn-primary" id="btn-request">요청하기</button>
                                    </div>
                                    <script type="text/javascript">
                                        $("#btn-request").click(()=> {
                                            if($("#content").val().length === 0){
                                                alert("내용을 입력하세요");
                                                return false;
                                            }
                                            const data = {
                                                mb_id:'<?php echo $member[mb_id]?>',
                                                mb_name:'<?php echo $member[mb_name]?>',
                                                wr_id:'<?php echo $view[wr_id]?>',
                                                wr_subject:'<?php echo $view[wr_subject]?>',
                                                content:$("#content").val()
                                            }
                                            $.ajax({
                                                url:`${g5_bbs_url}/ajax.request.update.php`,
                                                data:data,
                                                type:'post',
                                                dataType:'html',
                                                success:(result)=>{
                                                    if(result === 'ok'){
                                                        alert('견적문의 요청하였습니다. 관리자가 확인 후 연락드리겠습니다.')
                                                    }else{
                                                        alert('견적문의 요청에 실패하였습니다.')
                                                    }
                                                    $("#myModal").modal('hide');
                                                    $("#content").val('');
                                                }
                                            })
                                        });

                                    </script>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($member[mb_id] != "") {
                            $sql = "select * from g5_board_file where bo_table='product' and wr_id='{$view['wr_id']}' and bf_no='1'";
                            $row2 = sql_fetch($sql);
                            if ($row2[bf_no]) {
                                ?>
                                <a class="counsel manual"
                                   href="<?php echo G5_BBS_URL ?>/download.php?bo_table=product&wr_id=<?php echo $view[wr_id] ?>&no=1">
                                    사용자 메뉴얼
                                    <i class="fa-light fa-arrow-down-to-line"></i>
                                </a>
                            <?php }
                        } ?>

                    </div>
                   <!-- <a href="javascript:;" onclick="$('#sns-share').css('display','')"><i class="fa-regular fa-share-nodes"></i> 공유</a>--><a href="javascript:;" data-toggle="modal" data-target="#shareModal"><i class="fa-regular fa-share-nodes"></i> 공유</a>
                </div>
                <!--//견적신청버튼-->
                <!-- 공유하기 시작 -->

                <!-- Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="shareModalLabel">공유하기</h4>
                            </div>
                            <div class="modal-body">
                                <div id="sns-share">
                                    <!-- Share on Facebook -->
                                    <a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='
							+encodeURIComponent(document.URL)+'&amp;t='+encodeURIComponent(document.title), 'facebooksharedialog',
							 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                       target="_blank" alt="Share on Facebook">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns2_face.png" alt="페이스북"></a>

                                    <!-- Share on Twitter -->
                                    <a href="#" onclick="javascript:window.open('https://twitter.com/intent/tweet?text=[%EA%B3%B5%EC%9C%A0]%20'
							+encodeURIComponent(document.URL)+'%20-%20'+encodeURIComponent(document.title), 'twittersharedialog',
							 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                       target="_blank" alt="Share on Twitter"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns2_twitter.png" alt="트위터"></a>

                                    <!-- Share on Google+ -->
                                    <a href="#"
                                       onclick="javascript:window.open('https://plus.google.com/share?url='+encodeURIComponent(document.URL), 'googleplussharedialog','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=600');return false;"
                                       target="_blank" alt="Share on Google+">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns2_google.png" alt="구글"></a>

                                    <!-- Share on Kakaotalk -->
                                    <a id="kakao-link-btn" href="javascript:alert('카카오톡 공유는 준비중에 있습니다.');"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns2_kakao.png" alt="카카오톡"></a>

                                    <!-- Share on Kakaostory -->
                                    <a href="#"
                                       onclick="javascript:window.open('https://story.kakao.com/s/share?url='+encodeURIComponent(document.URL), 'kakaostorysharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;"
                                       target="_blank" alt="Share on kakaostory">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns2_kakaostory.png" alt="카카오스토리"></a>

                                    <!-- Share on Naver -->
                                    <a href="#" onclick="javascript:window.open('http://share.naver.com/web/shareView.nhn?url='
							+encodeURIComponent(document.URL)+'&amp;title='+encodeURIComponent(document.title),
							 'naversharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
                                       target="_blank" alt="Share on Naver">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns2_naver.png" alt="네이버"></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- 공유하기 끝 -->
            </div>
        </div>


        <!-- 본문 내용 시작 { -->
        <div class="thumb_img">
            <h3><strong>제품</strong>상세설명</h3>
            <?php echo get_view_thumbnail($view['content']); ?>
        </div>

        <? /* <div class="wrapper">
	    <div class="tabs cf">
		<input type="radio" name="tabs" id="tab1" checked>
		<label for="tab1">
        제품설명
        </label>
		<input type="radio" name="tabs" id="tab2">
		<label for="tab2">
        스펙
        </label>

		<div id="tab-content1" class="tab-content"><div class="thumb_img"><?php echo get_view_thumbnail($view['content']); ?></div></div>
		<div id="tab-content2" class="tab-content"><?php echo get_view_thumbnail($view['wr_text2']); ?></div>
	    </div>
        </div>*/ ?>


        <!--<h3 class="tit">제품설명</h3>
		<div><?php echo get_view_thumbnail($view['content']); ?></div>-->
        <? php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
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
        <!-- } 스크랩 추천 비추천 끝 --><?php */ ?>
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
    $(function () {
        $("a.view_file_download").click(function () {
            if (!g5_is_member) {
                alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
                return false;
            }

            var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

            if (confirm(msg)) {
                var href = $(this).attr("href") + "&js=on";
                $(this).attr("href", href);

                return true;
            } else {
                return false;
            }
        });
    });
    <?php } ?>

    function board_move(href) {
        window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
    }
</script>

<script>
    $(function () {
        $("a.view_image").click(function () {
            window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
            return false;
        });

        // 추천, 비추천
        $("#good_button, #nogood_button").click(function () {
            var $tx;
            if (this.id == "good_button")
                $tx = $("#bo_v_act_good");
            else
                $tx = $("#bo_v_act_nogood");

            excute_good(this.href, $(this), $tx);
            return false;
        });

        // 이미지 리사이즈
        //$("#bo_v_atc").viewimageresize();
    });

    function excute_good(href, $el, $tx) {
        $.post(
            href,
            {js: "on"},
            function (data) {
                if (data.error) {
                    alert(data.error);
                    return false;
                }

                if (data.count) {
                    $el.find("strong").text(number_format(String(data.count)));
                    if ($tx.attr("id").search("nogood") > -1) {
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