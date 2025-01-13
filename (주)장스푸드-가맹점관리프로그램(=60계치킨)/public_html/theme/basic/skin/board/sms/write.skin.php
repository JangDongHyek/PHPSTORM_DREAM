<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo $board_skin_url ?>/jquery-1.12.4.min.js"></script>
<script src="<?php echo $board_skin_url ?>/jquery-ui.js"></script>

<script>
function byte_check()
{
    var conts = document.getElementById('wr_content');
    var bytes = document.getElementById('bytes');
    var max_bytes = document.getElementById("max_bytes");

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++)
    {
        ch = conts.value.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

	bytes.innerHTML = cnt;

	if($("#wr_1_1").is(':checked') == true){
		var max_cnt = 80;
		max_bytes.innerHTML = max_cnt;

		$("#mms_box").css('display','none');
	}

	if($("#wr_1_2").is(':checked') == true){
		var max_cnt = 1000;
		max_bytes.innerHTML = max_cnt;

		$("#mms_box").css('display','none');
	}

	if($("#wr_1_3").is(':checked') == true){
		var max_cnt = 1000;
		max_bytes.innerHTML = max_cnt;

		$("#mms_box").css('display','block');
	}

    if (cnt > max_cnt)
    {
        exceed = cnt - max_cnt;
        alert('메시지 내용은 80바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++)
        {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > max_cnt) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        conts.value = tmp;
        bytes.innerHTML = xcnt;
        return;
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
		<table class="form_tbl">
		<tbody>
		<?php if ($is_category) { ?>
		<tr>
			<th class="form_tbl_th x110"><label for="ca_name">분류</label></th>
			<td class="form_tbl_td">
				
				<select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>

			</td>
		</tr>
		<?php } ?>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_subject">제목</label></th>
			<td class="form_tbl_td" colspan="3">
				
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" class="frm_text x500" maxlength="255">

			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_subject">발신자 번호</label></th>
			<td class="form_tbl_td" colspan="3">
				<? /*
				<?php if(!$write['wr_11']) $write['wr_11'] = '0260117048'; //'0260117054'; ?>
				<input type="text" name="wr_11" value="<?php echo $write['wr_11'] ?>" id="wr_11" class="frm_text x150" maxlength="255">
				*/?>
				<input type="text" name="wr_11" value="<?php echo ($write['wr_11'])? $write['wr_11'] : "0260117042" ?>" id="wr_11" class="frm_text x150" maxlength="255">
				※ 등록되지 않은 발신자 번호는 문자 발송이 되지 않습니다.
			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_2">발송일시</label></th>
			<td class="form_tbl_td x260">
				
				<label><input type="radio" name="wr_2" id="wr_2_1" value="즉시" style="vertical-align:top;" <?php if($write['wr_2'] == '즉시' || $write['wr_2'] == '') echo 'checked'; ?>> 즉시</label>
				<label><input type="radio" name="wr_2" id="wr_2_2" value="예약" style="vertical-align:top;" <?php if($write['wr_2'] == '예약') echo 'checked'; ?>> 예약</label>

			</td>
			<th class="form_tbl_th x110"><label for="wr_3">발송예약시간</label></th>
			<td class="form_tbl_td">
				
				<input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" class="frm_text x100 talign_c">
				
				<select name="wr_4">
					<option value="">--</option>
					<?php
					for($a=1; $a<=24; $a++){
						$aa = $a;
						if($a < 10) $aa = '0'.$a;
					?>
					<option value="<?php echo $aa ?>"><?php echo $aa ?></option>
					<?php } ?>
				</select>시

				<select name="wr_5">
					<option value="">--</option>
					<?php
					for($a=0; $a<=59; $a++){
						$aa = $a;
						if($a < 10) $aa = '0'.$a;
					?>
					<option value="<?php echo $aa ?>"><?php echo $aa ?></option>
					<?php } ?>
				</select>분

			</td>
		</tr>
		<tr>
			<th class="form_tbl_th x110"><label for="wr_1">발송상태</label></th>
			<td class="form_tbl_td x260">
				
				<div>
					<label><input type="radio" name="wr_1" id="wr_1_1" value="SMS" onclick="byte_check()" style="vertical-align:top;" <?php if($write['wr_1'] == 'SMS' || $write['wr_1'] == '') echo 'checked'; ?>> SMS</label>
				</div>
				<!--<div>
					<label><input type="radio" name="wr_1" id="wr_1_3" value="MMS" onclick="byte_check()" style="vertical-align:top;" <?php if($write['wr_1'] == 'MMS') echo 'checked'; ?>> MMS</label>
				</div>-->
				<div>
					<label><input type="radio" name="wr_1" id="wr_1_2" value="LMS" onclick="byte_check()" style="vertical-align:top;" <?php if($write['wr_1'] == 'LMS') echo 'checked'; ?>> LMS</label>
				</div>

			</td>
			<th class="form_tbl_th x110"><label for="wr_content">문자내용</label></th>
			<td class="form_tbl_td">
				
				<p>(<span id="bytes"></span> / <span id="max_bytes"></span>)</p>
				<textarea name="wr_content" id="wr_content" style="width: 250px; height: 150px;" maxlength="65536" onkeyup="byte_check()"><?php echo $write['wr_content'] ?></textarea>

				<div id="mms_box">
					<div id="mms_box_title">MMS 이미지</div>
					<div id="mms_box_info">
					※ 이미지는 176*144 사이즈의 jpg 파일로 제한됩니다.<br>
					※ 첨부가능한 jpg 파일의 개수는 3개이며, 하나의 파일 크기는 1Mb를 초과하지 않아야 합니다.
					</div>
					<input type="file" name="mms_img1" style="margin:0; margin-bottom:7px;">
					<input type="file" name="mms_img2" style="margin:0; margin-bottom:7px;">
					<input type="file" name="mms_img3">
				</div>

			</td>
		</tr>
		</tbody>
		</table>

		<table class="form_tbl" style="margin-top:20px;">
		<tbody>
		<tr>
			<td class="form_tbl_td x50per" style="vertical-align:top;">
				<!-- 관리자 -->
				<table class="form_tbl">
				<tbody>
				<tr>
					<th class="mem_th x50per">
						<input type="checkbox" id="all_chk1" class="valign_b" value="y">
						<label for="all_chk1" style="margin:0; vertical-align:top;">전체선택</label>
					</th>
					<td class="mem_td x50per" rowspan="2" id="mem_box1"></td>
				</tr>
				<tr>
					<td class="mem_td">
						<?php
						$mc_list1 = explode('|',mc_mb_list(3));
						for($mc1=0; $mc1<count($mc_list1); $mc1++){
						?>
						<div class="cate_box">
							<input type="checkbox" class="cate_check1" id="cate_check1_<?php echo $mc1 ?>">
							<label class="cate_check_label" for="cate_check1_<?php echo $mc1 ?>"><?php echo $mc_list1[$mc1] ?></label>
						</div>
						<div class="member_box1">
							<?php
							// 관리자 리스트
							$mcm_sql = " select * from g5_member where mb_1='{$mc_list1[$mc1]}' and mb_level>='3' and mb_hp != '' order by mb_name asc";
							$mcm_qry = sql_query($mcm_sql);
							while($mcm_row = sql_fetch_array($mcm_qry)){
							?>
							<div class="mb_id_box">
								<input type="checkbox" name="mb_name[]" class="mb_name" id="mb_name_<?php echo $mcm_row['mb_id'] ?>" value="<?php echo $mcm_row['mb_name'] ?>">
								<input type="checkbox" name="mb_id[]" class="mb_id" id="mb_id_<?php echo $mcm_row['mb_id'] ?>" value="<?php echo $mcm_row['mb_id'] ?>" style="vertical-align:top;" onchange="name_to_check($(this))">
								<label class="cate_check_label" for="mb_id_<?php echo $mcm_row['mb_id'] ?>"><?php echo $mcm_row['mb_name'] ?></label>
							</div>
							<?php
							}
							?>
						</div>
						<?php
						}
						?>
					</td>
				</tr>
				</tbody>
				</table>
				<!-- // 관리자 -->

				<br>
				<!-- 계육업체 -->
				<table class="form_tbl">
				<tbody>
				<tr>
					<th class="mem_th x50per">
						<input type="checkbox" id="all_chk3" class="valign_b" value="y">
						<label for="all_chk3" style="margin:0; vertical-align:top;">계육업체 전체선택</label>
					</th>
					<td class="mem_td x50per" rowspan="2" id="mem_box3"></td>
				</tr>
				<tr>
					<td class="mem_td">
						<?php
						$co_result = sql_query("SELECT idx, co_name FROM g5_ck_company WHERE co_use = 'Y' ORDER BY idx DESC;");
						$co_list = array();

						for ($ii = 0; $ck = sql_fetch_array($co_result); $ii++) {
							$co_list[$ii]['idx'] = $ck['idx'];
							$co_list[$ii]['co_name'] = $ck['co_name'];
						}

						foreach ($co_list as $key=>$val) {
						?>
						<div class="cate_box">
							<input type="checkbox" class="cate_check3" id="cate_check3_<?php echo $key ?>">
							<label class="cate_check_label" for="cate_check3_<?php echo $key ?>"><?php echo $val['co_name'] ?></label>
						</div>
						<div class="member_box3">
							<?php
							// 계육업체 등록된 점주 리스트
							$mb_result = sql_query("SELECT mb_id, mb_2, mb_hp FROM g5_member WHERE mb_4 = '{$val['idx']}' ORDER BY mb_2 ASC;");

							for ($jj = 0; $mb_row = sql_fetch_array($mb_result); $jj++) {
							?>
							<div class="mb_id_box">
								<input type="checkbox" name="mb_name[]" class="mb_name" id="mb_name_<?=$mb_row['mb_id']?>" value="<?=$mb_row['mb_2']?>">
								<input type="checkbox" name="mb_id[]" class="mb_id" id="mb_id_<?=$mb_row['mb_id']?>" value="<?=$mb_row['mb_id']?>" style="vertical-align:top;" onchange="name_to_check($(this))">
								<label class="cate_check_label" for="mb_id_<?=$mb_row['mb_id']?>"><?=$mb_row['mb_2']?> (<?=$mb_row['mb_hp']?>)</label>
							</div>
							<?php
							}
							?>
						</div>
						<?php
						} // end foreach
						?>
					</td>
				</tr>
				</tbody>
				</table>
				<!-- // 계육업체 -->
				
			</td>
			<td class="form_tbl_td x50per" style="vertical-align:top;">
				<!-- 점주 -->
				<table class="form_tbl">
				<tbody>
				<tr>
					<th class="mem_th x50per">
						<input type="checkbox" id="all_chk2" class="valign_b" value="y">
						<label for="all_chk2" style="margin:0; vertical-align:top;">전체선택</label>
					</th>
					<td class="mem_td x50per" rowspan="2" id="mem_box2"></td>
				</tr>
				<tr>
					<td class="mem_td">
						<?php
						$mc_list1 = explode('|',mc_mb_list(2));
						for($mc1=0; $mc1<count($mc_list1); $mc1++){
						?>
						<div class="cate_box">
							<input type="checkbox" class="cate_check2" id="cate_check2_<?php echo $mc1 ?>">
							<label class="cate_check_label" for="cate_check2_<?php echo $mc1 ?>"><?php echo $mc_list1[$mc1] ?></label>
						</div>
						<div class="member_box2">
							<?php
							// 점주 리스트
							$mcm_sql = " select * from g5_member where mb_1='{$mc_list1[$mc1]}' and mb_level='2' and mb_hp != '' order by mb_2 asc";
							$mcm_qry = sql_query($mcm_sql);
							while($mcm_row = sql_fetch_array($mcm_qry)){
							?>
							<div class="mb_id_box">
								<input type="checkbox" name="mb_name[]" class="mb_name" id="mb_name_<?php echo $mcm_row['mb_id'] ?>" value="<?php echo $mcm_row['mb_2'] ?>">
								<input type="checkbox" name="mb_id[]" class="mb_id" id="mb_id_<?php echo $mcm_row['mb_id'] ?>" value="<?php echo $mcm_row['mb_id'] ?>" style="vertical-align:top;" onchange="name_to_check($(this))">
								<label class="cate_check_label" for="mb_id_<?php echo $mcm_row['mb_id'] ?>"><?php echo $mcm_row['mb_2'] ?> (<?php echo $mcm_row['mb_hp'];?>)</label>
							</div>
							<?php
							}
							?>
						</div>
						<?php
						}
						?>
					</td>
				</tr>
				</tbody>
				</table>
				<!-- // 점주 -->
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
window.onload = function(){
	byte_check();
}


$(function(){
	// 전체선택 (관리자)
	$("#all_chk1").on('click', function(){
		if($(this).is(':checked') == true){
			$(".cate_check1").prop('checked', true);
			$(".member_box1 .mb_name").prop('checked', true);
			$(".member_box1 .mb_id").prop('checked', true);
		}else{
			$(".cate_check1").prop('checked', false);
			$(".member_box1 .mb_name").prop('checked', false);
			$(".member_box1 .mb_id").prop('checked', false);
		}

		update_member();
	});
	
	// 전체선택 (점주)
	$("#all_chk2").on('click', function(){
		if($(this).is(':checked') == true){
			$(".cate_check2").prop('checked', true);
			$(".member_box2 .mb_name").prop('checked', true);
			$(".member_box2 .mb_id").prop('checked', true);
		}else{
			$(".cate_check2").prop('checked', false);
			$(".member_box2 .mb_name").prop('checked', false);
			$(".member_box2 .mb_id").prop('checked', false);
		}

		update_member();
	});

	// 전체선택 (계육업체)
	$("#all_chk3").on('click', function(){
		if($(this).is(':checked') == true){
			$(".cate_check3").prop('checked', true);
			$(".member_box3 .mb_name").prop('checked', true);
			$(".member_box3 .mb_id").prop('checked', true);
		}else{
			$(".cate_check3").prop('checked', false);
			$(".member_box3 .mb_name").prop('checked', false);
			$(".member_box3 .mb_id").prop('checked', false);
		}

		update_member();
	});

	// 중분류 전체선택 (관리자)
	$(".cate_check1").on('click', function(){
		var _idx = $(".cate_check1").index(this);

		if($(this).is(':checked') == true){
			$(".member_box1:eq("+_idx+") .mb_name").prop('checked', true);
			$(".member_box1:eq("+_idx+") .mb_id").prop('checked', true);
		}else{
			$(".member_box1:eq("+_idx+") .mb_name").prop('checked', false);
			$(".member_box1:eq("+_idx+") .mb_id").prop('checked', false);
		}

		update_member();
	});

	// 중분류 전체선택 (점주)
	$(".cate_check2").on('click', function(){
		var _idx = $(".cate_check2").index(this);

		if($(this).is(':checked') == true){
			$(".member_box2:eq("+_idx+") .mb_name").prop('checked', true);
			$(".member_box2:eq("+_idx+") .mb_id").prop('checked', true);
		}else{
			$(".member_box2:eq("+_idx+") .mb_name").prop('checked', false);
			$(".member_box2:eq("+_idx+") .mb_id").prop('checked', false);
		}

		update_member();
	});

	// 중분류 전체선택 (계육업체)
	$(".cate_check3").on('click', function(){
		var _idx = $(".cate_check3").index(this);

		if($(this).is(':checked') == true){
			$(".member_box3:eq("+_idx+") .mb_name").prop('checked', true);
			$(".member_box3:eq("+_idx+") .mb_id").prop('checked', true);
		}else{
			$(".member_box3:eq("+_idx+") .mb_name").prop('checked', false);
			$(".member_box3:eq("+_idx+") .mb_id").prop('checked', false);
		}

		update_member();
	});

	$(".mb_id").on('click', function(){
		var _idx = $(".mb_id").index(this);

		if($(this).is(':checked') == true){
			$(".mb_name").eq(_idx).prop('checked', true);
		}else{
			$(".mb_name").eq(_idx).prop('checked', false);
		}
		update_member();
	});


	$("#wr_3").datepicker({	// UI 달력을 사용할 Class / Id 를 콤마(,) 로 나누어서 다중으로 가능
		buttonImageOnly: false,	// 버튼을 이미지로 사용할지 유무
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
		// 최소한의 날짜 조건 제한주기
		// new Date(년,월,일)
		// ex) 2016-02-10 이전의 날짜는 선택 안되도록 하려면 new Date(2016, 2-1, 10)
		// d : 일 , m : 월 , y : 년
		// +1d , -1d , +1m , -1m , +1y , -1y
		// ex) minDate: '-100d' 이런 방식도 가능
		minDate: '0d',
		// 오늘을 기준으로 선택할 수 있는 최대한의 날짜 조건 제한주기
		// d : 일 , m : 월 , y : 년
		// +1d , -1d , +1m , -1m , +1y , -1y
		maxDate: '+1y',
		duration: 'fast', // 달력 나타나는 속도 ( Slow , normal , Fast )
		// 달력 Show/Hide 이벤트
		// 종류 : show , slideDown , fadeIn , blind , bounce , clip , drop , fold , slide ( '' 할경우 애니매이션 효과 없이 작동 )
		showAnim: 'slideDown',
		// 달력에서 좌우 선택시 이동할 개월 수
		stepMonths: 1,
	});
});



function name_to_check(obj){
	var _idx = $(".mb_id").index(obj);
	if(obj.is(':checked') == true){
		$(".mb_name").eq(_idx).prop('checked', true);
	}else{
		$(".mb_name").eq(_idx).prop('checked', false);
	}
}



function update_member(){

	var datas = '';

	$("#mem_box1").empty();
	$("#mem_box2").empty();
	$("#mem_box3").empty();
	
	if($('.member_box1 .mb_id:checked').size() > 0){
		for(var i=0; i<$('.member_box1 .mb_id:checked').size(); i++){
			datas = '';
			datas += '<div class="data_box">';
			datas += '<input type="hidden" name="sms_mb_id[]" class="sms_mb_id" value="'+$('.member_box1 .mb_id:checked').eq(i).val()+'">';
			datas += $('.member_box1 .mb_name:checked').eq(i).val();
			datas += '</div>';
			$("#mem_box1").append(datas);
		}
	}else{
		$("#mem_box1").empty();
	}

	if($('.member_box2 .mb_id:checked').size() > 0){
		for(var i=0; i<$('.member_box2 .mb_id:checked').size(); i++){
			datas = '';
			datas += '<div class="data_box">';
			datas += '<input type="hidden" name="sms_mb_id[]" class="sms_mb_id" value="'+$('.member_box2 .mb_id:checked').eq(i).val()+'">';
			datas += $('.member_box2 .mb_name:checked').eq(i).val();
			datas += '</div>';
			$("#mem_box2").append(datas);
		}
	}else{
		$("#mem_box2").empty();
	}

	if($('.member_box3 .mb_id:checked').size() > 0){
		for(var i=0; i<$('.member_box3 .mb_id:checked').size(); i++){
			datas = '';
			datas += '<div class="data_box">';
			datas += '<input type="hidden" name="sms_mb_id[]" class="sms_mb_id" value="'+$('.member_box3 .mb_id:checked').eq(i).val()+'">';
			datas += $('.member_box3 .mb_name:checked').eq(i).val();
			datas += '</div>';
			$("#mem_box3").append(datas);
		}
	}else{
		$("#mem_box3").empty();
	}

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
		if(f.wr_subject.value == ''){
			alert('제목을 입력해주세요');
			f.wr_subject.focus();
			return false;
		}

		if (f.wr_11.value == "") {
			alert("발신자 번호를 입력해주세요.");
			f.wr_11.focus();
			return false;
		}

		if($("#wr_2_2").is(':checked') == true){
			if(f.wr_3.value == ''){
				alert('날짜를 선택해주세요');
				f.wr_3.focus();
				return false;
			}

			if(f.wr_4.value == ''){
				alert('시간을 선택해주세요');
				f.wr_4.focus();
				return false;
			}

			if(f.wr_5.value == ''){
				alert('분을 선택해주세요');
				f.wr_5.focus();
				return false;
			}
		}

        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->