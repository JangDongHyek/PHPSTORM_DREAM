<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<section id="bo_w">
    <h2 id="container_title"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="wr_content" value="..." id="wr_content">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>


	<div id="form_box">
		<table class="form_tbl">
		<tbody>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_subject">배송지명</label></th>
			<td class="form_tbl_td">
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_text required x120">
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_7">수령인</label></th>
			<td class="form_tbl_td">
				<input type="text" name="wr_7" value="<?php echo $wr_7 ?>" id="wr_7" required class="frm_text required x120">
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_1_1">전화번호</label></th>
			<td class="form_tbl_td">
				<?php
				$wr_1_arr = explode('-',$wr_1);
				$wr_1_1 = $wr_1_arr[0];
				$wr_1_2 = $wr_1_arr[1];
				$wr_1_3 = $wr_1_arr[2];
				?>
				<input type="text" name="wr_1_1" value="<?php echo $wr_1_1 ?>" id="wr_1_1" class="frm_text x40"> -
				<input type="text" name="wr_1_2" value="<?php echo $wr_1_2 ?>" id="wr_1_2" class="frm_text x40"> -
				<input type="text" name="wr_1_3" value="<?php echo $wr_1_3 ?>" id="wr_1_3" class="frm_text x40">
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_2_1">휴대폰번호</label></th>
			<td class="form_tbl_td">
				<?php
				$wr_2_arr = explode('-',$wr_2);
				$wr_2_1 = $wr_2_arr[0];
				$wr_2_2 = $wr_2_arr[1];
				$wr_2_3 = $wr_2_arr[2];
				?>
				<input type="text" name="wr_2_1" value="<?php echo $wr_2_1 ?>" id="wr_2_1" class="frm_text x40"> -
				<input type="text" name="wr_2_2" value="<?php echo $wr_2_2 ?>" id="wr_2_2" class="frm_text x40"> -
				<input type="text" name="wr_2_3" value="<?php echo $wr_2_3 ?>" id="wr_2_3" class="frm_text x40">
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_3">주소</label></th>
			<td class="form_tbl_td">
				<input type="text" name="wr_3" value="<?php echo $wr_3 ?>" id="wr_3" class="frm_text required" size="5" maxlength="6" required>
				<button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'wr_3', 'wr_4', 'wr_5', 'wr_6', 'mb_addr_jibeon');">주소 검색</button><br>
				<input type="text" name="wr_4" value="<?php echo $wr_4 ?>" id="wr_4" class="frm_text required" size="60" required style="margin-top:5px;"><br>
				<input type="text" name="wr_5" value="<?php echo $wr_5 ?>" id="wr_5" class="frm_text" size="60" style="margin-top:5px;"><br>
				<input type="text" name="wr_6" value="<?php echo $wr_6 ?>" id="wr_6" class="frm_text" size="60" style="margin-top:5px;">
				<input type="hidden" name="mb_addr_jibeon" value="">
			</td>
		</tr>
		</tbody>
		</table>
	</div>


    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">리스트</a>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->