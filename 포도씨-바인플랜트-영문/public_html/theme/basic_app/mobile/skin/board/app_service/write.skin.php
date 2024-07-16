<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);


?>
<style>
#ft_menu{display:none;}
</style>

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
        
        
        <?php if ($is_category) { ?>
        <label for="ca_name">분류<strong class="sound_only">필수</strong></label>
            <select name="ca_name" id="ca_name" required>
                <option value="">분류를 선택해주세요</option>
                <?php echo $category_option ?>
            </select>
        <?php } ?>

        <label for="wr_subject">제목<strong class="sound_only">필수</strong></label>
		<div id="autosave_wrapper">
			<input type="text" name="wr_subject" value="<?=$write['wr_subject']?>" placeholder="제목을 입력해주세요" id="wr_subject" required class="frm_input" maxlength="255">
		</div>
		<label for="wr_1">상호명<strong class="sound_only">필수</strong></label>
        <input type="text" name="wr_1" value="<?php echo $write[wr_1] ?>" id="wr_1" required class="frm_input" size="10" maxlength="20" placeholder="상호명을 입력하세요">

		<label for="wr_2">급여<strong class="sound_only">필수</strong></label>
        <input type="text" name="wr_2" value="<?php echo $write[wr_2] ?>" id="wr_2" required class="frm_input" size="10" maxlength="20" placeholder="급여를 입력하세요">
		
		<label for="wr_3">출근시간<strong class="sound_only">필수</strong></label>
        <input type="time" name="wr_3" value="<?php echo $write[wr_3] ?>" id="wr_3" required class="frm_input" size="10" maxlength="20" placeholder="출근시간을 입력하세요">

		<label for="wr_4">퇴근시간<strong class="sound_only">필수</strong></label>
        <input type="time" name="wr_4" value="<?php echo $write[wr_4] ?>" id="wr_4" required class="frm_input" size="10" maxlength="20" placeholder="퇴근시간을 입력하세요">

		<label for="wr_5">지역선택<strong class="sound_only">필수</strong></label>
        <select name="wr_5" id="wr_5" class="frm_input">
			<option value="">지역선택(시/도)</option>
			<?for($i=0;$i<count($sidoArr);$i++){?>
			<option value="<?=$sidoArr[$i]?>"<?php echo $sidoArr[$i]==$view[wr_5]?" selected":"";?>><?=$sidoArr[$i]?></option>
			<? }?>
		</select>
		<script>
			$(function(){
				$("#wr_5").on('change',function(){
					if($(this).val()=='서울특별시'){
						$("#wr_6").css("display","");
						$("#label_6").css("display","");
					}else{
						$("#wr_6").val('');
						$("#wr_6").css("display","none");
						$("#label_6").css("display","none");
					}
				});
			});
		</script>
		<label for="wr_6" id="label_6" style="display:none">구군선택<strong class="sound_only">필수</strong></label>
        <select name="wr_6" id="wr_6" class="frm_input" style="display:none">
			<option value="">지역선택(구)</option>
			<?for($i=0;$i<count($gugunArr);$i++){?>
			<option value="<?=$gugunArr[$i]?>"<?php echo $gugunArr[$i]==$view[wr_5]?" selected":"";?>><?=$gugunArr[$i]?></option>
			<? }?>
		</select>
		<label for="wr_8">경력<strong class="sound_only">필수</strong></label>
        <input type="text" name="wr_8" value="<?php echo $write[wr_8] ?>" id="wr_8" required class="frm_input" size="10" maxlength="20" placeholder="경력을 입력하세요.">

				
		<label for="wr_content">업체소개<strong class="sound_only">필수</strong></label>
		<div class="wr_content">
			<textarea id="wr_content" name="wr_content" style="width:100%;height:300px" placeholder="업체소개 입력해주세요"><?=$write['wr_content']?></textarea>
		</div>
		<label for="wr_8">연락처<strong class="sound_only">필수</strong></label>
        <input type="tel" name="wr_8" value="<?php echo $write[wr_8] ?>" id="wr_8" required class="frm_input" size="10" maxlength="20" placeholder="연락처를 입력하세요">
		<label for="wr_7">마감일<strong class="sound_only">필수</strong></label>
        <input type="date" name="wr_7" value="<?php echo $write[wr_7] ?>" id="wr_7" required class="frm_input" size="10" maxlength="20" placeholder="마감일을 입력하세요">
        </div>
    </div>

    <div class="btn_confirm" id="ft_btn">
        <input type="submit" value="등록하기" id="btn_submit" accesskey="s" class="btn">
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
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
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

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->