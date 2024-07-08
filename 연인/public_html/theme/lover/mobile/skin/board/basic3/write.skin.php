<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<style>
#ft_menu{display:none;}
</style>
<div id="bo_rev">
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

    <div class="tbl_frm01 tbl_wrap">
        <!--<?php if ($option) { ?>
        	옵션 <?php echo $option ?>
        <?php } ?> -->
    	<div class="frm">
			<? /* 작업대기 ★★★★★★★★★
			<?php if ($is_name) { ?>
			<label for="wr_name">이름<strong class="sound_only">필수</strong></label>
			<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" placeholder="닉네임을 입력해주세요" required class="frm_input" maxlength="20">
	        <?php } ?>

			<?php if ($is_password) { ?>
			<tr>
				<th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
				<td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
			</tr>
			<?php } ?>
			*/ ?>

			<? /* <label for="ca_name">분류<strong class="sound_only">필수</strong></label>
			<select name="ca_name" id="ca_name" required>
				<option value="">분류를 선택해주세요</option>
				<?php echo $category_option ?>
			</select> */ ?>
			<span id="sub_cate_area"><!-- load --></span>

			<? if (!$is_member) { ?>
			<label for="wr_name">이름<strong class="sound_only">필수</strong></label>
			<input type="text" name="wr_name" value="<?=$write['wr_name']?>" placeholder="Please enter the user name" id="wr_name" required class="frm_input" maxlength="100">
			<label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label>
			<input type="password" name="wr_password" value="" placeholder="Please enter the password" id="wr_password" required class="frm_input" maxlength="100">
			<? } ?>

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
								<input type="file" name="bf_file[]">
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
    </div>
	<br><br>

    <div id="ft_btn" class="btn_confirm">
        <input type="submit" value="등록하기" id="btn_submit" accesskey="s" class="btn_submit_app">
    </div>
    </form>


</section>

<script>
var file_num = 0;	// 업로드파일 카운팅

// 이미지업로드 동적생성
function getImgUpload() {
	var area = document.getElementById("img_after"),
		input = document.createElement('input');

	input.setAttribute("type", "file");
	input.setAttribute("name", "bf_file[]");
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