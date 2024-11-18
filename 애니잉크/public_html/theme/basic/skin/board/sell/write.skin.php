<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo $board_skin_url ?>/jquery-ui.js"></script>
<script>
function datepicker_act(){
	$("#wr_1").datepicker({	// UI 달력을 사용할 Class / Id 를 콤마(,) 로 나누어서 다중으로 가능
		buttonText: "Select date",
		dateFormat: "yy-mm-dd",	// Form에 입력될 Date Type
		prevText: '이전 달',	// ◀ 에 마우스 오버하면 나타나는 타이틀
		nextText: '다음 달',	// ▶ 에 마우스 오버하면 나타나는 타이틀
		changeMonth: true,	// 월 SelectBox 형식으로 선택변경 유무
		changeYear: true,	// 년 SelectBox 형식으로 선택변경 유무
		showMonthAfterYear: true,	// 년도 다음에 월이 나타나게 할지 여부 ( true : 년 월 , false : 월 년 )
		showButtonPanel: true,	// UI 하단에 버튼 사용 유무
		monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],	// 요일에 마우스 오버하면 나타나는 타이틀
		dayNamesMin: ['일','월','화','수','목','금','토'],	// 요일 텍스트 값
		duration: 'fast', // 달력 나타나는 속도 ( Slow , Normal , Fast )
		showAnim: 'slideDown'
	});
}
$(function(){
	datepicker_act();
});
</script>

<?php if(!isset($_SERVER["HTTPS"])) { ?>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<?php }else{ ?>
    <script src=" https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<?php } ?>
<!-- 240409 카카오맵안열리는거
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
-->
<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

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
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            //$option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
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

    <div class="tbl_wrap">
        <table class="b_tbl">
		<tbody>
		<tr>
			<th class="b_th">수리/판매일자</th>
			<td class="b_td" colspan="3">
				<input type="text" name="wr_1" id="wr_1" value="<?php echo $write['wr_1'] ?>" class="frm_input x90" />
			</td>
		</tr>
		<tr>
			<th class="b_th">고객분류</th>
			<td class="b_td" colspan="3">
				<select name="wr_2" id="wr_2">
					<option value="" <?php if($write['wr_2'] == '') echo 'selected'; ?>>선택하세요</option>
					<option value="수리" <?php if($write['wr_2'] == '수리') echo 'selected'; ?>>수리</option>
					<option value="판매" <?php if($write['wr_2'] == '판매') echo 'selected'; ?>>판매</option>
				</select>
			</td>
		</tr>
		<tr>
			<th class="b_th">고객명</th>
			<td class="b_td" colspan="3">
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" class="frm_input x200" maxlength="255">
			</td>
		</tr>
		<tr>
			<th class="b_th xp15">Tel</th>
			<td class="b_td xp35">
				<input type="text" name="wr_7" id="wr_7" value="<?php echo $write['wr_7'] ?>" class="frm_input x130" />
			</td>
			<th class="b_th xp15">H.P</th>
			<td class="b_td xp35">
				<input type="text" name="wr_8" id="wr_8" value="<?php echo $write['wr_8'] ?>" class="frm_input x130" />
			</td>
		</tr>
		<tr>
			<th class="b_th">주소</th>
			<td class="b_td" colspan="3">
                <input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3"  class="frm_input " size="5" maxlength="6">
                <button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'wr_3', 'wr_4', 'wr_5', 'wr_6', 'mb_addr_jibeon');" style="border-radius:4px;">주소 검색</button><br>
                <input type="text" name="wr_4" value="<?php echo $write['wr_4'] ?>" id="wr_4"  class="frm_input frm_address " size="50">
                <label for="wr_4">기본주소</label><br>
                <input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" id="wr_5" class="frm_input frm_address" size="50">
                <label for="wr_5">상세주소</label>
                <br>
                <input type="text" name="wr_6" value="<?php echo $write['wr_6'] ?>" id="wr_6" class="frm_input frm_address" size="50" readonly>
                <label for="wr_6">참고항목</label>
                <input type="hidden" name="mb_addr_jibeon" value="">
			</td>
		</tr>
		<tr>
			<th class="b_th">모델</th>
			<td class="b_td">
				<input type="text" name="wr_9" id="wr_9" value="<?php echo $write['wr_9'] ?>" class="frm_input x130" />
			</td>
			<th class="b_th">수리/판매금액</th>
			<td class="b_td">
				<input type="text" name="wr_10" id="wr_10" value="<?php echo $write['wr_10'] ?>" class="frm_input x90" />
			</td>
		</tr>
		<tr>
			<th class="b_th">내용</th>
			<td class="b_td" colspan="3">
				<?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
			</td>
		</tr>
		<tr>
			<th class="b_th">첨부파일</th>
			<td class="b_td" colspan="3">
				<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
					<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
					<?php if ($is_file_content) { ?>
					<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
					<?php } ?>
					<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
					<?php } ?>
				<?php } ?>
			</td>
		</tr>
		</tbody>
		</table>
    </div>

    <div class="btn_confirm" style="padding-top:15px;">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
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
		if(f.wr_1.value == ''){
			alert("수리/판매일자를 선택(입력)해주세요");
			f.wr_1.focus();
			return false;
		}

		if(f.wr_2.value == ''){
			alert("고객분류를 선택해주세요");
			f.wr_2.focus();
			return false;
		}

		if(f.wr_subject.value == ''){
			alert("고객명을 입력해주세요");
			f.wr_subject.focus();
			return false;
		}
		
		if(f.wr_9.value == ''){
			alert("모델을 입력해주세요");
			f.wr_9.focus();
			return false;
		}

		if(f.wr_10.value == ''){
			alert("수리/판매금액을 입력해주세요");
			f.wr_10.focus();
			return false;
		}

        var wr_content_editor_data = oEditors.getById['wr_content'].getIR();
		oEditors.getById['wr_content'].exec('UPDATE_CONTENTS_FIELD', []);
		if(jQuery.inArray(document.getElementById('wr_content').value.toLowerCase().replace(/^\s*|\s*$/g, ''), ['&nbsp;','<p>&nbsp;</p>','<p><br></p>','<div><br></div>','<p></p>','<br>','']) != -1){document.getElementById('wr_content').value='';}
		//if (!wr_content_editor_data || jQuery.inArray(wr_content_editor_data.toLowerCase(), ['&nbsp;','<p>&nbsp;</p>','<p><br></p>','<p></p>','<br>']) != -1) { alert("내용을 입력해 주십시오."); oEditors.getById['wr_content'].exec('FOCUS'); return false; }

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("고객명에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->