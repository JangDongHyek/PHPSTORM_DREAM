<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script>
     function chkNum(c){
          if((c.keyCode<48) || (c.keyCode>57)){
               return false;
          }
     }

     function onOnlyNumber(obj){
          for(var i=0; i<obj.value.length; i++){
               chr = obj.value.substr(i,1);
               chr = escape(chr);
               key_eg = chr.charAt(1);
              
               if(key_eg == "u"){
                    key_num = chr.substr(i,(chr.length-1));
                    if((key_num < "AC00") || (key_num > "D7A3")){
                         event.returnValue = false;
                    }
               }
          }

          if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 16){
               event.returnValue = true;
          }else{
               event.returnValue = false;
          }
     }
</script>

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
		<div style="margin:0px 0px 10px 0px;">상품 기본정보</div>
		<table class="form_tbl">
		<tbody>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_10">상품분류</label></th>
			<td class="form_tbl_td x330">
				<select name="wr_10" id="wr_10">
					<?php echo item_ptmall_cate_option($write['wr_10']) ?>
				</select>
			</td>
			<th class="form_tbl_th x110" rowspan="3"><label>상품이미지</label></th>
			<td class="form_tbl_td" rowspan="3">
			
			<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
				<?php if($w == 'u' && $file[$i]['file']){ ?>
					<?php echo get_view_thumbnail($file[$i]['view'],100); ?>
				<?php } ?>
				<div style="margin-top:10px;">
					<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
					<?php if ($is_file_content) { ?>
					<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
					<?php } ?>
					<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>" style="word-break: break-all;"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
					<?php } ?>
				</div>
			<?php } ?>

			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_subject">상품명</label></th>
			<td class="form_tbl_td">
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" class="frm_text x300" maxlength="255" required>
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_1">판매가격</label></th>
			<td class="form_tbl_td">
				<input type="text" name="wr_1" value="0" id="wr_1"  class="frm_text  x160" style="text-align:right; IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);" readonly>
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_2_1">판매상태</label></th>
			<td class="form_tbl_td" colspan="3">
				<input type="radio" name="wr_2" id="wr_2_1" value="NS" <?php if($write['wr_2'] == 'NS' || $write['wr_2'] == '') echo 'checked'; ?>>
				<label for="wr_2_1" style="margin:0; margin-right:10px;">&nbsp;정상판매</label>

				<input type="radio" name="wr_2" id="wr_2_2" value="SS" <?php if($write['wr_2'] == 'SS') echo 'checked'; ?>>
				<label for="wr_2_2" style="margin:0; margin-right:10px;">&nbsp;판매중지</label>

				<input type="radio" name="wr_2" id="wr_2_3" value="SO" <?php if($write['wr_2'] == 'SO') echo 'checked'; ?>>
				<label for="wr_2_3" style="margin:0; margin-right:10px;">&nbsp;품절</label>
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_3">배송비</label></th>
			<td class="form_tbl_td" colspan="3">
				<input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" required class="frm_text required x160" style="text-align:right; IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_4">추천여부</label></th>
			<td class="form_tbl_td" colspan="3">
				<input type="radio" name="wr_4" id="wr_4_1" value="n" <?php if($write['wr_4'] == 'n' || $write['wr_4'] == '') echo 'checked'; ?>>
				<label for="wr_4_1" style="margin:0; margin-right:10px;">&nbsp;추천없음</label>

				<input type="radio" name="wr_4" id="wr_4_2" value="y" <?php if($write['wr_4'] == 'y') echo 'checked'; ?>>
				<label for="wr_4_2" style="margin:0; margin-right:10px;">&nbsp;추천표시 (점주가 보는 화면에서 추천표시가 됩니다)</label>
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_5">상품옵션</label></th>
			<td class="form_tbl_td" colspan="3">
				<input type="radio" name="wr_5" id="wr_5_1" value="n" <?php if($write['wr_5'] == 'n' || $write['wr_5'] == '') echo 'checked'; ?>>
				<label for="wr_5_1" style="margin:0; margin-right:10px;">&nbsp;옵션 없음</label>

				<input type="radio" name="wr_5" id="wr_5_2" value="y" <?php if($write['wr_5'] == 'y') echo 'checked'; ?>>
				<label for="wr_5_2" style="margin:0; margin-right:10px;">&nbsp;옵션 등록</label>

				<div class="opt_container">
					<div style="margin-bottom:10px;">
						<input type="checkbox" name="opt_use1" id="opt_use1" class="opt_use" value="y" <?php if($write['opt_use1'] == 'y') echo 'checked'; ?>>
						<label for="opt_use1" style="margin:0;">옵션명&nbsp;:&nbsp;</label>
						<input type="text" name="wr_opt1" value="<?php echo $write['wr_opt1'] ?>" id="wr_opt1" class="frm_text x160">
						<input type="button" class="opt_add_btn" value="옵션 항목 추가">
					</div>

					<table class="form_tbl">
					<thead>
					<tr>
						<th class="opt_th" style="color:#333">옵션항목</th>
						<th class="opt_th x180" style="color:#333">옵션추가금액(원)</th>
                        <th class="opt_th x180" style="color:#333">옵션추가금액(마일리지)</th>
						<th class="opt_th x110" style="color:#333">삭제</th>
					</tr>
					</thead>
					<tbody id="tbody_opt1">
					<?php
					$opt1_sql = " select * from g5_opt1 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' order by opt_idx asc ";
					$opt1_qry = sql_query($opt1_sql);
					$opt1_num = sql_num_rows($opt1_qry);
					for($i=0; $i<$opt1_num; $i++){
						$opt1_row = sql_fetch_array($opt1_qry);
					?>
					<tr>
						<td class="opt_td">
							<input type="hidden" name="opt_idx1[]" class="opt_idx" value="<?php echo $opt1_row['opt_idx'] ?>">
							<input type="text" name="opt_name1[]" value="<?php echo $opt1_row['opt_name'] ?>" class="opt_name frm_text_opt">
						</td>
						<td class="opt_td">
							<input type="text" name="opt_price1[]" value="<?php echo $opt1_row['opt_price'] ?>" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
						</td>
                        <td class="opt_td">
                            <input type="text" name="opt_price1_2[]" value="<?php echo $opt1_row['opt_price2'] ?>" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
                        </td>
						<td class="opt_td">
							<a class="btn_b02 opt_del_btn" onclick="opt_del_action(1,this)">삭제</a>
						</td>
					</tr>
					<?php
					}
					?>
					</tbody>
					</table>
				</div>

				<div class="opt_container">
					<div style="margin-bottom:10px;">
						<input type="checkbox" name="opt_use2" id="opt_use2" class="opt_use" value="y" <?php if($write['opt_use2'] == 'y') echo 'checked'; ?>>
						<label for="opt_use2" style="margin:0;">옵션명&nbsp;:&nbsp;</label>
						<input type="text" name="wr_opt2" value="<?php echo $write['wr_opt2'] ?>" id="wr_opt2" class="frm_text x160">
						<input type="button" class="opt_add_btn" value="옵션 항목 추가">
					</div>

					<table class="form_tbl">
					<thead>
					<tr>
						<th class="opt_th" style="color:#333">옵션항목</th>
                        <th class="opt_th x180" style="color:#333">옵션추가금액(원)</th>
                        <th class="opt_th x180" style="color:#333">옵션추가금액(마일리지)</th>
						<th class="opt_th x110" style="color:#333">삭제</th>
					</tr>
					</thead>
					<tbody id="tbody_opt2">
					<?php
					$opt2_sql = " select * from g5_opt2 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' order by opt_idx asc ";
					$opt2_qry = sql_query($opt2_sql);
					$opt2_num = sql_num_rows($opt2_qry);
					for($i=0; $i<$opt2_num; $i++){
						$opt2_row = sql_fetch_array($opt2_qry);
					?>
					<tr>
						<td class="opt_td">
							<input type="hidden" name="opt_idx2[]" class="opt_idx" value="<?php echo $opt2_row['opt_idx'] ?>">
							<input type="text" name="opt_name2[]" value="<?php echo $opt2_row['opt_name'] ?>" class="opt_name frm_text_opt">
						</td>
						<td class="opt_td">
							<input type="text" name="opt_price2[]" value="<?php echo $opt2_row['opt_price'] ?>" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
						</td>
                        <td class="opt_td">
                            <input type="text" name="opt_price2_2[]" value="<?php echo $opt2_row['opt_price2'] ?>" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
                        </td>
						<td class="opt_td">
							<a class="btn_b02 opt_del_btn" onclick="opt_del_action(2,this)">삭제</a>
						</td>
					</tr>
					<?php
					}
					?>
					</tbody>
					</table>
				</div>

				<div class="opt_container">
					<div style="margin-bottom:10px;">
						<input type="checkbox" name="opt_use3" id="opt_use3" class="opt_use" value="y" <?php if($write['opt_use3'] == 'y') echo 'checked'; ?>>
						<label for="opt_use3" style="margin:0;">옵션명&nbsp;:&nbsp;</label>
						<input type="text" name="wr_opt3" value="<?php echo $write['wr_opt3'] ?>" id="wr_opt3" class="frm_text x160">
						<input type="button" class="opt_add_btn" value="옵션 항목 추가">
					</div>

					<table class="form_tbl">
					<thead>
					<tr>
						<th class="opt_th" style="color:#333">옵션항목</th>
                        <th class="opt_th x180" style="color:#333">옵션추가금액(원)</th>
                        <th class="opt_th x180" style="color:#333">옵션추가금액(마일리지)</th>
						<th class="opt_th x110" style="color:#333">삭제</th>
					</tr>
					</thead>
					<tbody id="tbody_opt3">
					<?php
					$opt3_sql = " select * from g5_opt3 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' order by opt_idx asc ";
					$opt3_qry = sql_query($opt3_sql);
					$opt3_num = sql_num_rows($opt3_qry);
					for($i=0; $i<$opt3_num; $i++){
						$opt3_row = sql_fetch_array($opt3_qry);
					?>
					<tr>
						<td class="opt_td">
							<input type="hidden" name="opt_idx3[]" class="opt_idx" value="<?php echo $opt3_row['opt_idx'] ?>">
							<input type="text" name="opt_name3[]" value="<?php echo $opt3_row['opt_name'] ?>" class="opt_name frm_text_opt">
						</td>
						<td class="opt_td">
							<input type="text" name="opt_price3[]" value="<?php echo $opt3_row['opt_price'] ?>" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
						</td>
                        <td class="opt_td">
                            <input type="text" name="opt_price3_2[]" value="<?php echo $opt3_row['opt_price2'] ?>" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">
                        </td>
						<td class="opt_td">
							<a class="btn_b02 opt_del_btn" onclick="opt_del_action(3,this)">삭제</a>
						</td>
					</tr>
					<?php
					}
					?>
					</tbody>
					</table>
				</div>
			</td>
		</tr>
		</tbody>
		</table>


		<div style="margin:20px 0px 10px 0px;">상품 상세정보</div>
		<table class="form_tbl">
		<tbody>
		<tr>
			<td class="form_tbl_td">
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

        <div style="margin:20px 0px 10px 0px;">배송안내</div>
        <table class="form_tbl">
            <tbody>
            <tr>
                <td class="form_tbl_td">
                    <?php echo editor_html('wr_content2', get_text($write['wr_content2'], 0)); ?>
                </td>
            </tr>
            </tbody>
        </table>

        <div style="margin:20px 0px 10px 0px;">반품안내</div>
        <table class="form_tbl">
            <tbody>
            <tr>
                <td class="form_tbl_td">
                    <?php echo editor_html('wr_content3', get_text($write['wr_content3'], 0)); ?>
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
$(function(){
	$("#wr_5_1").on('click', function(){
		option_view();
	});

	$("#wr_5_2").on('click', function(){
		option_view();
	});

	$(".opt_add_btn").on('click', function(){
		var _idx = $(".opt_add_btn").index(this) + 1;
		var datas = '';
		datas += '<tr>';
		datas += '<td class="opt_td">';
		datas += '<input type="hidden" name="opt_idx'+_idx+'[]" class="opt_idx" value="">';
		datas += '<input type="text" name="opt_name'+_idx+'[]" value="" class="opt_name frm_text_opt">';
		datas += '</td>';
		datas += '<td class="opt_td">';
		datas += '<input type="text" name="opt_price'+_idx+'[]" value="" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">';
		datas += '</td>';
        datas += '<td class="opt_td">';
        datas += '<input type="text" name="opt_price'+_idx+'_2[]" value="" class="opt_price frm_text_price" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);">';
        datas += '</td>';
		datas += '<td class="opt_td">';
		datas += '<a class="btn_b02 opt_del_btn" onclick="opt_del_action('+_idx+',this)">삭제</a>';
		datas += '</td>';
		datas += '</tr>';

		$("#tbody_opt"+_idx).append(datas);
	});
});


function option_view(){
	if($("#wr_5_2").is(':checked') == true){
		$(".opt_container").css('display','block');
	}else{
		$(".opt_container").css('display','none');
	}
}



function opt_del_action(num,obj){
	var _idx = $("#tbody_opt"+num+" .opt_del_btn").index(obj);
	$("#tbody_opt"+num+" tr:eq("+_idx+")").remove();
}



window.onload = function(){
	option_view();
}
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
		<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo get_editor_js('wr_content2'); ?>
        <?php echo get_editor_js('wr_content3'); ?>

		/*
		if(f.wr_10.value == ''){
			alert('상품분류를 선택해주세요');
			f.wr_10.focus();
			return false;
		}
		*/

		if(f.wr_subject.value == ''){
			alert('상품명을 입력해주세요');
			f.wr_subject.focus();
			return false;
		}

		if($("#wr_5_2").is(':checked') == true){
			if($(".opt_use").is(':checked') == false){
				alert('사용할 옵션을 선택해주세요');
				$("#opt_use1").focus();
				return false;
			}

			if($("#opt_use1").is(':checked') == true){
				if($("#wr_opt1").val() == ''){
					alert('옵션의 제목을 입력해주세요');
					$("#wr_opt1").focus();
					return false;
				}

				if($("#tbody_opt1 .opt_idx").length == 0){
					alert('선택한 옵션의 옵션항목이 비어있습니다');
					return false;
				}

				for(var i=0; i<$("#tbody_opt1 .opt_name").length; i++){
					if($("#tbody_opt1 .opt_name").eq(i).val() == ''){
						alert('옵션항목 제목을 입력해주세요');
						$("#tbody_opt1 .opt_name").eq(i).focus();
						return false;
					}
				}
			}

			if($("#opt_use2").is(':checked') == true){
				if($("#wr_opt2").val() == ''){
					alert('옵션의 제목을 입력해주세요');
					$("#wr_opt2").focus();
					return false;
				}

				if($("#tbody_opt2 .opt_idx").length == 0){
					alert('선택한 옵션의 옵션항목이 비어있습니다');
					return false;
				}

				for(var i=0; i<$("#tbody_opt2 .opt_name").length; i++){
					if($("#tbody_opt2 .opt_name").eq(i).val() == ''){
						alert('옵션항목 제목을 입력해주세요');
						$("#tbody_opt2 .opt_name").eq(i).focus();
						return false;
					}
				}
			}

			if($("#opt_use3").is(':checked') == true){
				if($("#wr_opt3").val() == ''){
					alert('옵션의 제목을 입력해주세요');
					$("#wr_opt3").focus();
					return false;
				}

				if($("#tbody_opt3 .opt_idx").length == 0){
					alert('선택한 옵션의 옵션항목이 비어있습니다');
					return false;
				}

				for(var i=0; i<$("#tbody_opt3 .opt_name").length; i++){
					if($("#tbody_opt3 .opt_name").eq(i).val() == ''){
						alert('옵션항목 제목을 입력해주세요');
						$("#tbody_opt3 .opt_name").eq(i).focus();
						return false;
					}
				}
			}
		}

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->