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
        문의자 이름 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
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
		<div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody class="cust">        
		<tr class="cust">
            <th class="cust" scope="row"><label for="wr_1"><span class="check">*</span>매장명<strong class="sound_only">필수</strong></label></th>
            <td class="cust">
				<?php echo $view[wr_1]?>
            </td>

            
        </tr>

		<tr>
            <th class="cust" scope="row"><label for="wr_2_1"><span class="check">*</span>문의유형</label></th>
            <td class="cust">
				<?php echo $view[wr_2]?>
			</td>
        </tr>
		<tr>
            <th class="cust" scope="row"><label for="wr_3_1"><span class="check">*</span>이용경로</label></th>
            <td class="cust">
                <div>
                 <?php echo $view[wr_3]?>
                </div>
                <!--//#visit-->
                <div id="etc">
                        <div class="route" id="delivery" style="<?php echo $view[wr_3]=="매장방문"?"display:none":"";?>">
                          <select name="wr_4" id="wr_4"  style="width:100px">
                             <option value="">선택</option>
                             <option value="배달"<?php echo $write['wr_4']=="배달"?" selected":"";?>>배달</option>
                             <option value="포장"<?php echo $write['wr_4']=="포장"?" selected":"";?>>포장</option>
                          </select>
                        </div>
                        <div class="route">
                          <span id="date"><?php echo $view[wr_3]=="매장방문"?"방문일":"주문일";?></span> <?php echo $view[wr_5];?>
                        </div>
                        <div class="route">
						<span>결제시간</span>
                          <?php echo $view[wr_6];?>
                        </div>
                        <div class="route">
                          <span>주문메뉴</span> <?php echo $view[wr_7];?>
                        </div>
                </div><!--//#etc-->
            </td>
        </tr>
		<tr>
            <th class="cust" scope="row"><label for="wr_8_1"><span class="check">*</span>답변 알림 서비스</label></th>
            <td class="cust">
				<?php echo $view[wr_8];?>
			</td>
        </tr>
        
        <?php if ($is_name) { ?>
        <tr>
            <th class="cust" scope="row"><label for="wr_name"><span class="check">*</span>문의자 이름<strong class="sound_only">필수</strong></label></th>
            <td class="cust"><?php echo $view[wr_name];?></td>
        </tr>
        <?php } ?>

        <tr>
            <th class="cust" scope="row"><label for="wr_email"><span class="check">*</span>이메일</label></th>
			<?php
				$wr_email = explode("@",$write[wr_email]);
			?>
            <td class="cust">
                <?php echo $view[wr_email];?>
            </td>
        </tr>
        

		<tr>
			<th class="cust"><span class="check">*</span>휴대폰</th>
			
			<td class="cust">
				 <?php echo $view[wr_9];?>
			</td>
		</tr>

       

        <tr>
            <th class="cust" scope="row"><label for="wr_subject"><span class="check">*</span>제목<strong class="sound_only">필수</strong></label></th>
            <td class="cust">
               <?php echo $view[wr_subject];?>
            </td>
        </tr>

        <tr>
            <th class="cust" scope="row"><label for="wr_content"><span class="check">*</span>문의 내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content cust">
                <?php echo get_view_thumbnail($view['content']); ?>
            </td>
        </tr>
		<tr>
            <th class="cust" scope="row"><label for="wr_content"><span class="check">*</span>진행여부<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content cust">
				<select name="wr_10" id="wr_10">
					<option value="">접수</option>
					<option value="ing"<?php echo $view[wr_10]=="ing"?" selected":"";?>>진행중</option>
					<option value="true"<?php echo $view[wr_10]=="true"?" selected":"";?>>답변완료</option>
				</select>
				
            </td>
        </tr>

      

		
        </tbody>
        </table>
    </div>
     
    </section>
	<script type="text/javascript">
		$(()=>{
			$("#wr_10").change(function(){
				$.ajax({
					url:`${g5_bbs_url}/ajax.answer.check.php`,
					data:{wr_10:$(this).val(),wr_id:'<?php echo $wr_id?>'},
					dataType:"HTML",
					type:"POST",
					success:function(){
						alert("진행여부가 변경되었습니다.");
					}
				});
			});
		});
	</script>

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