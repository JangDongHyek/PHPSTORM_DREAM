<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<section id="bo_w">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
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

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

		<tr>
            <th scope="row"><label for="wr_2">지역선택<strong class="sound_only">필수</strong></label></th>
            <td>
				<select name="wr_2" id="wr_2" class="frm_input" required>
					<option value="">선택(시)</option>
					<? foreach ($si_list as $key=>$si) { ?>
					<option value="<?=$si?>" <? if ($write['wr_2'] == $si) echo "selected"; ?>><?=$si?></option>
					<? } ?>
				</select>
				<!-- 구 선택은 서울만 노출 -->

				<?
				$gu_css = "display: none;";
				if ($w == "u" && in_array($write['wr_2'], $depth_local_list)) $gu_css = "";
				?>
				<select name="wr_3" id="wr_3" class="frm_input" style="<?=$gu_css?>">
					<option value="">선택(구)</option>
				</select>
				<input type="hidden" id="slct_opt" value="<?=$write['wr_3']?>">

			</td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_subject">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_subject" value="<?=$write['wr_subject']?>" id="wr_subject" required class="frm_input required" size="50" maxlength="100"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_content">연락처<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_content" value="<?=$write['wr_content']?>" id="wr_content" required class="frm_input required" size="50" maxlength="30"></td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_1">상세설명</label></th>
            <td><textarea id="wr_1" name="wr_1" class="wr_1" style="line-height: 1.7;"><?=$write['wr_1']?></textarea></td>
        </tr>
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">사진 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 사진 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
		<tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td>
				<input type="text" name="wr_orderby" value="<? if ((int)$write['wr_orderby'] > 0) echo $write['wr_orderby']; ?>" id="wr_orderby" class="frm_input" size="50" placeholder="숫자만 입력하세요">
				<p style="padding: 10px 0 0;">※ 숫자가 높을수록 리스트 상위에 노출됩니다.</p>
			</td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_1">메모</label></th>
            <td><textarea id="wr_8" name="wr_8" class="wr_8" style="line-height: 1.7;"><?=$write['wr_8']?></textarea></td>
        </tr>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel hidden-xs">취소</a>
    </div>
    </form>

    <script>
	var su_list = <?php echo json_encode($seoul_list)?>; 
	var ic_list = <?php echo json_encode($ic_list)?>; 
	var kg_list = <?php echo json_encode($kg_list)?>; 

	$(function() {
		// 공백입력불가
		$("#wr_content, #wr_orderby").on("keyup", function() {
			var val = $(this).val().replace(/ /gi, '');
			// 숫자만
			if ($(this).attr("id") == "wr_orderby") {
				val = $(this).val().replace(/[^0-9]/gi,"");
			}
	        $(this).val(val);
		});

		// 지역선택 (서울 선택시 구 노출)
		$("#wr_2").on("change", getGuList);
		

		// 수정시 지역(구) 호출
		if (document.fwrite.w.value == "u") {
			getGuList();
		}
	});
	
	// 지역(구) 호출
	function getGuList() {
		var si = $("#wr_2").val();
		var depth_list = "";

		if (si == "서울" || si == "인천" || si == "경기") {
			switch (si) {
				case "서울" : depth_list = su_list; break;
				case "인천" : depth_list = ic_list; break;
				case "경기" : depth_list = kg_list; break;
			}

			$("#wr_3").html("");

			for (var i=0; i < depth_list.length; i++) {
				var val = depth_list[i];
				var opt = "<option value='"+ val +"'>"+ val +"</option>";

				$("#wr_3").append(opt);
				
				if (document.fwrite.w.value == "u") {
					var slct_opt = $("#slct_opt").val();
					console.log(slct_opt);
					$("#wr_3 option[value="+ slct_opt +"]").prop("selected", true);
				}
			}

			$("#wr_3").show();

		} else {
			$("#wr_3").hide();
			$("#wr_3 option:eq(0)").prop("selected", true);
		}


	}

    function fwrite_submit(f)
    {
		if ($("#wr_2").val() == "서울" && $("#wr_3").val() == "") {
			alert("지역(구)를 선택하세요.");
			$("#wr_3").focus();
			return false;
		}

        document.getElementById("btn_submit").disabled = "disabled";
        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->