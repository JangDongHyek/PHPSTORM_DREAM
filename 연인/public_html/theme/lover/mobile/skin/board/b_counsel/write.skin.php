<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$view_class = "";
if (defined('G5_IS_ADMIN')) {	// 관리자페이지면
	$view_class = "max1200";
}
?>
<style>
#ft_menu{display:none;}
</style>

<div id="bo_rev">
        <p class="b_con">당신의 연애 고충을 들어드립니다.</p>
<section id="bo_w" class="<?=$view_class?>">
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

	<? /*
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
	*/ ?>

    <div class="tbl_frm01 tbl_wrap">
		<?
		if (defined('G5_IS_ADMIN')) {	// 관리자페이지면
		?>
		<table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
		<tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255" style="width:100%;">                    
                </div>
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
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
		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">사진 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="사진첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input"  accept="image/*">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="사진 설명을 입력해주세요." class="frm_file frm_input">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 사진 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
		</tbody>
		</table>
		<br>
		<div class="btn_confirm">
			<input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
			<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
		</div>

		<? } else {						// 사용자페이지면 ?>

    	<div class="frm">
			<label for="wr_subject">제목<strong class="sound_only">필수</strong></label>
			<div id="autosave_wrapper">
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" placeholder="제목을 입력해주세요" id="wr_subject" required class="frm_input" maxlength="100">
			</div>
			<label for="wr_content">내용<strong class="sound_only">필수</strong></label>
			<div class="wr_content">
				<textarea id="wr_content" name="wr_content" style="width:100%;height:150px" placeholder="내용을 입력해주세요" required><?=$write['wr_content']?></textarea>
			</div>

			<br>
			<div id="bf_wrap">
				<dl>
					<dt>첨부파일</dt>
					<dd>
						<!-- 이미지선택후 -->
						<div id="img_after">
							<!-- 미리보기 -->
							<div id="prev_area">
								<?
								// 파일개수체크
								$rs = sql_fetch(" SELECT COUNT(*) AS cnt FROM g5_board_file WHERE bo_table = '{$bo_table}' AND wr_id = '{$wr_id}' ");
								$cnt = $rs['cnt'];

								for($i = 0; $i < $cnt; $i++) {
									if($w == 'u' && $file[$i]['file']) { 
										$img_src = $file[$i]['path']."/".$file[$i]['file'];
								?>
								<div class="p_box" id="ubox<?=$i?>">
									<div class="img_bd"><img class="p_img" src="<?=$img_src?>"></div>
									<button type="button" class="btn" onclick="getImgDel('u', '<?=$i?>')">X</button>
								</div>
								<input type="file" name="bf_file[]" accept="image/*">
								<input type="hidden" id="bf_file_del<?=$i?>" name="bf_file_del[<?=$i?>]" value="">
								<?
									}
								} // end for
								?>
							</div>
						</div>
						<!-- //이미지선택후 -->
						<!-- 이미지선택전 -->
						<div class="img_add"><button type="button" class="btn" id="btn_add_file" onclick="getImgUpload();"><i class="fa fa-plus"></i></button></div>
						
						<? /*
						<div id="bf_prev_wrap">
							<? 
							// 글 수정이면
							if ($w == "u" && $file['count'] > 0) { 
								for ($ii = 0; $ii < $file['count']; $ii++)	{
									$upload_img = $file[$ii]['path']."/".$file[$ii]['file'];
							?>
							<div class="prev_area pau<?=$ii?>">
								<button type="button" class="btn_del" onclick="fnFileDel('u', '<?=$ii?>', '');"><i class="fa fa-times"></i></button>
								<div class="img_bd"><img src="<?=$upload_img?>"></div>
							</div>
							<input type="checkbox" class="el_hidden" id="bf_file_del<?php echo $ii ?>" name="bf_file_del[<?php echo $ii;  ?>]" value="1">
							<?
								}
							}
							?>
						</div>
						
						<div id="bf_prev_wrap">
							<div class="prev_area">
								<button type="button" class="btn_del" onclick="fnFileDel('u', '<?=$ii?>', '');"><i class="fa fa-times"></i></button>
								<div class="img_bd"><img src="http://lits.itforone.co.kr/data/file/meeting/3076986471_8EA4vPUD_7c46dc0a5225948d43053655e9c58c7143db6ee8.jpg"></div>
							</div>
						</div>
						*/ ?>
					</dd>
				</dl>
			</div>
		
        </div>

		<br><br>
		<div id="ft_btn" class="btn_confirm">
			<input type="submit" value="등록하기" id="btn_submit" accesskey="s" class="btn_submit_app">
		</div>
		<? } ?>

    </div><!-- .tbl_wrap -->
    </form>

</section>

<script>
var file_num = 0;	// 업로드파일 순번

// 이미지업로드 동적생성
function getImgUpload() {
	var area = document.getElementById("img_after"),
		input = document.createElement('input'),
		leng = document.getElementsByName("bf_file[]").length;

	file_num = leng;

	if (leng > 4) { // 5장까지
		alert("최대 5장까지 등록 가능합니다.");
		return false;
	}

	input.setAttribute("type", "file");
	input.setAttribute("name", "bf_file[]");
	input.setAttribute("accept", "image/*");
	input.setAttribute("id", "f"+file_num);
	input.setAttribute("onchange", "getImgPrev(this)");

	area.appendChild(input);

	var elem = document.getElementsByName("bf_file[]"),
		eq = elem.length;

	elem[eq-1].click();
}

// 이미지업로드 미리보기
function getImgPrev(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			var area = document.getElementById("prev_area"),
				div = document.createElement('div'),
				div_img = document.createElement('div'),
				img = document.createElement('img'),
				btn = document.createElement('button');

			div.setAttribute("class", "p_box");
			div.setAttribute("id", "box"+file_num);

			div_img.setAttribute("class", "img_bd");
			img.setAttribute("class", "p_img");
			img.setAttribute("src", e.target.result);

			btn.setAttribute("type", "button");
			btn.setAttribute("class", "btn");
			btn.setAttribute("onclick", "getImgDel('w', "+ file_num +")");
			btn.innerHTML = "X";

			div_img.appendChild(img);
			div.appendChild(div_img);
			div.appendChild(btn);
			area.appendChild(div);

			file_num++;
		}
		reader.readAsDataURL(input.files[0]);
	}
}

// 이미지미리보기/업로드된 이미지 삭제
function getImgDel(mode, idx) {
	if (mode == "w") {
		var input = document.getElementById("f"+idx),
			prev = document.getElementById("box"+idx);

		input.parentNode.removeChild(input);
		prev.parentNode.removeChild(prev);

	} else if (mode == "u") {
		var input = document.getElementById("bf_file_del"+idx),
			prev = document.getElementById("ubox"+idx);

		input.value = 1;
		prev.parentNode.removeChild(prev);
	}
}

</script>
<!-- } 게시물 작성/수정 끝 -->
</div>