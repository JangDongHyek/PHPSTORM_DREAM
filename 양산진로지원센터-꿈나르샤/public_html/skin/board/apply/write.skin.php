<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
if($w==""&&$_GET['wr_1']==""){
	alert("잘못된 경로로 접근하였습니다.");
}
?>

<section id="bo_w">


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
	<input type="hidden" name="wr_1" value="<?php echo $_GET[wr_1]!=""?$_GET[wr_1]:$write[wr_1];?>">
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
        <table>
        <tbody>
        
        <tr>
            <th scope="row"><label for="wr_name">학생명<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
       
		<tr>
            <th scope="row"><label for="wr_2">학생연락처<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_2" value="<?php echo $write[wr_2] ?>" id="wr_2" required class="frm_input required" size="50" maxlength="100"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_3">학부모성함<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_3" value="<?php echo $write[wr_3] ?>" id="wr_3" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_4">학부모연락처<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_4" value="<?php echo $write[wr_4] ?>" id="wr_4" required class="frm_input required" size="50" maxlength="100"></td>
        </tr>
		
        <tr>
            <th scope="row"><label for="wr_subject">학교명<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
                </div>
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_content">학년<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_content" value="<?php echo $write[wr_content] ?>" id="wr_content" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_5">기타1</label></th>
            <td>
				<textarea name="wr_5" id="wr_5" class="frm_input"><?=$write[wr_5]?></textarea>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_6">기타2</label></th>
            <td>
				<textarea name="wr_6" id="wr_6" class="frm_input"><?=$write[wr_6]?></textarea>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_7">기타3</label></th>
            <td>
				<textarea name="wr_7" id="wr_7" class="frm_input"><?=$write[wr_7]?></textarea>
			</td>
        </tr>
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
		<?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
	
	
	<div class="agree">
      <h2><i class="fas fa-check-circle"></i> 개인정보 수집 및 저작권 이용 허락서</h2>
	  <p>양산진로교육지원센터는 프로그램의 원활한 운영을 위하여 일정 개인정보를 수집·이용합니다.<br />
	  이에 개인정보보호법에 의거하여 개인정보 수집 및 이용을 고지하니 다음의 내용을 확인하시기 바랍니다. </p>
	  
	  
	  
      <div class="txt"> <strong>[개인정보 수집 및 이용 내역]</strong> <br />
        <strong>- 수집 및 이용 목적 : </strong>양산진로교육지원센터 프로그램 운영 <br />
        <strong>- 수집 및 이용 항목 :</strong> 성명, 소속/직위, 연락처, 이메일등 수집자료일체 <br />
        <strong>- 보유 및 이용 기간 : </strong>동의일로부터 보유목적 달성 시까지
        <br />
        <br />
        <strong>[저작권 안내 및 저작물 이용 허락]</strong> <br />
        - 저작권 일체(저작인격권, 저작재산권)는 참여자 개인에게 있으며, 주최/주관기관이 사업홍보를 위한 저작물 이용 허락 *을 받을 수 있음. <br />
*저작물 이용 허락 범위 : 자료집 발간, DB구축 및 정보제공 웹서비스 등, 사업홍보를 위한 제출자료의 일부 복제, 가공, 인쇄, 배포, 전시, 공중송신 등
 <br />
</div>
      <div class="agree_ch">
        <input type="checkbox" name="agree_chk" value="y" id="agree_chk" /> 개인정보 수집 및 저작권 이용에 동의합니다. 
	  </div>
	  
    </div>
	

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <?php 
			if($is_admin){
		?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
		<?php }?>
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

        var subject = "";
        var content = "";




        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }
		<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
		if($("#agree_chk").prop("checked")==false){
			alert("개인정보 수집 및 저작권에 동의하십시오");
			return false;
		}
        document.getElementById("btn_submit").disabled = "disabled";
	
        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->