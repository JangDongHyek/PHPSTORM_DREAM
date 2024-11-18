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
	$("#wr_3").datepicker({	// UI 달력을 사용할 Class / Id 를 콤마(,) 로 나누어서 다중으로 가능
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
		<?php
		if($p_wr_id != ''){
			$p_sql = " select * from g5_write_new where wr_id='{$p_wr_id}' limit 0,1 ";
			$list_str = '?bo_table=new&wr_id='.$p_wr_id;
		}else{
			$p_sql = " select * from g5_write_new where wr_id='{$write['wr_1']}' limit 0,1 ";
			$list_str = '?bo_table=new&wr_id='.$write['wr_1'];
		}
		//echo $list_str;
		$p_row = sql_fetch($p_sql);
		?>
		<tr>
			<th class="b_th">업체명</th>
			<td class="b_td" colspan="3">
				<input type="hidden" name="wr_1" value="<?php echo ($p_wr_id != '') ? $p_wr_id : $write['wr_1']; ?>" />
				<input type="hidden" name="wr_subject" value="<?php echo ($p_wr_id != '') ? $p_wr_id : $write['wr_subject']; ?>" />
				<?php echo $p_row['wr_subject'] ?>
			</td>
		<tr>
		<tr>
			<th class="b_th">구분</th>
			<td class="b_td" colspan="3">
				<select name="wr_2" id="wr_2">
					<option value="">선택하세요</option>
					<option value="정기점검" <?php if($write['wr_2'] == '정기점검') echo 'selected'; ?>>정기점검</option>
					<option value="A/S" <?php if($write['wr_2'] == 'A/S') echo 'selected'; ?>>A/S</option>
				</select>
			</td>
		</tr>
		<tr>
			<th class="b_th">점검일자</th>
			<td class="b_td" colspan="3">
				<input type="text" name="wr_3" id="wr_3" value="<?php echo $write['wr_3'] ?>" class="frm_input x90" />
			</td>
		</tr>
		<tr>
			<th class="b_th">점검위치</th>
			<td class="b_td" colspan="3">
				<label><input type="radio" name="wr_4" class="wr_4" value="전체" <?php if($write['wr_4'] == '전체') echo 'checked'; ?>> 전체</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" name="wr_4" class="wr_4" value="일부" <?php if($write['wr_4'] == '일부') echo 'checked'; ?>> 일부</label>
				<div id="wr_4_box">
					<textarea name="wr_4_text" class="frm_textarea"><?php echo $write['wr_4_text'] ?></textarea>
				</div>
				<?php if($write['wr_4'] == '일부'){ ?>
				<script>
				$("#wr_4_box").css('display','block');
				</script>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<th class="b_th">A/S 요청사항</th>
			<td class="b_td" colspan="3">
				<textarea name="wr_5" id="wr_5" class="frm_textarea"><?php echo $write['wr_5'] ?></textarea>
			</td>
		</tr>
		<tr>
			<th class="b_th">기기교체</th>
			<td class="b_td" colspan="3">
				<label><input type="radio" name="wr_9" value="무" <?php if($write['wr_9'] == '무' || $w == '') echo 'checked'; ?> /> 무</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" name="wr_9" value="유" <?php if($write['wr_9'] == '유') echo 'checked'; ?> /> 유</label>
			</td>
		</tr>
		<tr>
			<th class="b_th xp15">처리사항</th>
			<td class="b_td xp85" colspan="3">
				<textarea name="wr_6" id="wr_6" class="frm_textarea"><?php echo $write['wr_6'] ?></textarea>
			</td>
		</tr>
		<tr>
			<th class="b_th">담당자확인</th>
			<td class="b_td">
				<input type="text" name="wr_7" id="wr_7" value="<?php echo $write['wr_7'] ?>" class="frm_input x90" />
			</td>
			<th class="b_th">담당A/S기사</th>
			<td class="b_td">
				<input type="text" name="wr_11" id="wr_11" value="<?php echo $write['wr_11'] ?>" class="frm_input x90" />
			</td>
		</tr>
		<tr>
			<th class="b_th">출력장수</th>
			<td class="b_td" colspan="3">
				<input type="text" name="wr_8" id="wr_8" value="<?php echo $write['wr_8'] ?>" class="frm_input x90" />
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
		<tr>
			<th class="b_th">비고</th>
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
		</tbody>
		</table>
    </div>

    <div class="btn_confirm" style="padding-top:15px;">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php<?php echo $list_str ?>" class="btn_cancel">목록보기</a>
    </div>
    </form>

<script>
$(function(){
	$(".wr_4").on('click', function(){
		var _idx = $(".wr_4").index(this);
		if(_idx == 0){
			$("#wr_4_box").css('display','none');
		}else{
			$("#wr_4_box").css('display','block');
		}
	});
});
</script>

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
			alert("죄송합니다\n업체정보를 불러오는데 실패하였습니다\n다시 상세정보를 선택하여 작성해주세요");
			return false;
		}

		if(f.wr_2.value == ''){
			alert("구분을 선택해주세요");
			f.wr_2.focus();
			return false;
		}

		if(f.wr_3.value == ''){
			alert("점검일자를 선택(입력)해주세요");
			f.wr_3.focus();
			return false;
		}

        var wr_content_editor_data = oEditors.getById['wr_content'].getIR();
		oEditors.getById['wr_content'].exec('UPDATE_CONTENTS_FIELD', []);
		if(jQuery.inArray(document.getElementById('wr_content').value.toLowerCase().replace(/^\s*|\s*$/g, ''), ['&nbsp;','<p>&nbsp;</p>','<p><br></p>','<div><br></div>','<p></p>','<br>','']) != -1){document.getElementById('wr_content').value='';}
		//if (!wr_content_editor_data || jQuery.inArray(wr_content_editor_data.toLowerCase(), ['&nbsp;','<p>&nbsp;</p>','<p><br></p>','<p></p>','<br>']) != -1) { alert("내용을 입력해 주십시오."); oEditors.getById['wr_content'].exec('FOCUS'); return false; }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->