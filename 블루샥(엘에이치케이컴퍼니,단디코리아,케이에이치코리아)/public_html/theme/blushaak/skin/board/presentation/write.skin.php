<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
$sidoArr=array("서울특별시","부산광역시","인천광역시","대전광역시","대구광역시","광주광역시","울산광역시","경기도","강원도","충청북도","충청남도","경상북도","경상남도","전라북도","전라남도","제주특별자치시");
$wr_3=explode("-",$write[wr_3]);
?>

<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fviewcomment" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="w" value="cu" >
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
    <input type="hidden" name="is_good" value="">
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
    <div class="area_title">
        <p>창업설명회 (서울)</p>
        <span>1회차 일시 : 10월 25일(수) 14시</span>
    </div>
	<?/* if(!$is_admin){*/?>
    <div class="agree">
    	<h2>개인정보수집동의</h2>
        <div class="txt cf">
			<div class="bx"><strong>개인정보의 수집·이용 목적</strong><div class="con">서비스 제공 및 계약의 이행 등을 목적으로 개인정보를 처리합니다.</div></div>
            <div class="bx"><strong>수집하려는 개인정보의 항목</strong><div class="con">이름, 이메일 등</div></div>
            <div class="bx"><strong>개인정보의 보유 및 이용 기간</strong><div class="con">개인정보 수집 및 이용목적이 달성된 후에는 예외없이 해당정보를 파기합니다..</div></div>
        </div>
        <div class="agree_ch">
            <input type=checkbox name="agree_chk" id="agree_chk" value="y" required>
            <label for="agree_chk">개인정보처리방침에 동의합니다.</label>
        </div>
    </div><!--.agree-->
	<?/* }*/?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name"><span class="check">*</span>이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password"><span class="check">*</span>비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <tr>
            <th><span class="check">*</span>연락처</th>
            <td>
                <div class="flex">
                <input type="text" name="wr_3[]" value="<?=$wr_3[0]?>" class="frm_input tel"> -
                <input type="text" name="wr_3[]" value="<?=$wr_3[1]?>" class="frm_input tel"> -
                <input type="text" name="wr_3[]" value="<?=$wr_3[2]?>" class="frm_input tel">
                </div>
            </td>
        </tr>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email"><span class="check">*</span>이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email"  maxlength="100"></td>
        </tr>
        <?php } ?>

		<tr>
            <th scope="row"><label for="wr_1"><span class="check">*</span>창업희망지역<strong class="sound_only">필수</strong></label></th>
            <td>
				<select name="wr_1" id="wr_1" required>
					<option value="">시/도</option>
					<?php
						for($i=0;$i<count($sidoArr);$i++){
					?>
					<option value="<?=$sidoArr[$i]?>"<?php echo $sidoArr[$i]==$write[wr_1]?" selected":"";?>><?=$sidoArr[$i]?></option>
					<?php }?>
				</select>
                <select>
                    <option>구/군</option>
                </select>
				<!--<input type="text" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input required" size="50"> 동까지 기재 시 더욱 자세히 답변가능 합니다.-->
            </td>
        </tr>
        
		<tr>
            <th scope="row"><label for="wr_2"><span class="check">*</span>점포유무</label></th>
            <td>
				<select name="wr_2" id="wr_2" required style="width:100px">
					<option value="있음"<?php echo $write['wr_2']=="있음"?" selected":"";?>>있음</option>
					<option value="없음"<?php echo $write['wr_2']=="없음"?" selected":"";?>>없음</option>
				</select>
			</td>
        </tr>
		<? /*<tr>
            <th scope="row"><label for="wr_4"><span class="check">*</span>유입경로</label></th>
            <td>
				<input type="radio" name="wr_4" id="wr_4_1" value="온라인광고"<?php echo $write[wr_4]=="온라인광고"||$w==""?" checked":"";?>><label for="wr_4_1">온라인광고</label>
				<input type="radio" name="wr_4" id="wr_4_2" value="SNS계정"<?php echo $write[wr_4]=="SNS계정"?" checked":"";?>> <label for="wr_4_2">SNS계정</label>
				<input type="radio" name="wr_4" id="wr_4_3" value="지인추천"<?php echo $write[wr_4]=="지인추천"?" checked":"";?>> <label for="wr_4_3">지인추천</label>
				<input type="radio" name="wr_4" id="wr_4_4" value="가맹점"<?php echo $write[wr_4]=="가맹점"?" checked":"";?>> <label for="wr_4_4">가맹점</label>
				<input type="radio" name="wr_4" id="wr_4_5" value="기타"<?php echo $write[wr_4]=="기타"?" checked":"";?>> <label for="wr_4_5">기타</label>
			</td>
        </tr>*/ ?>

        <?php /* if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" ></td>
        </tr>
        <?php } ?><?php */?>

        <?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name"><span class="check">*</span>분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

        <!--<tr>
            <th scope="row"><label for="wr_subject"><span class="check">*</span>제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php /*echo $subject */?>" id="wr_subject" required class="frm_input required" maxlength="255">
                    <?php /*if ($is_member) { // 임시 저장된 글 기능 */?>
                    <script src="<?php /*echo G5_JS_URL; */?>/autosave.js"></script>
                    <?php /*if($editor_content_js) echo $editor_content_js; */?>
                    <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php /*echo $autosave_count; */?></span>)</button>
                    <div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php /*echo $board_skin_url; */?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php /*echo $board_skin_url; */?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>
                    <?php /*} */?>
                </div>
            </td>
        </tr>-->

        <tr>
            <th scope="row"><label for="wr_content"><span class="check">*</span>문의 내용<strong class="sound_only">필수</strong></label></th>
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

        <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input"></td>
        </tr>
        <?php } ?>

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row"><span class="check">*</span>자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_orderby) { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="신청완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
        <? if($is_admin){?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
        <? } ?>
        
    </div>
    </form>

<script>
var save_before = '';
var save_html = document.getElementById('bo_vc_w').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
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

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("댓글을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('작성자가 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('비밀번호가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // 댓글 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'bo_vc_w';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 댓글 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;

        if(save_before)
            $("#captcha_reload").trigger("click");

        save_before = el_id;
    }
}

function comment_delete()
{
    return confirm("이 댓글을 삭제하시겠습니까?");
}

comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
// sns 등록
$(function() {
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('bo_vc_w').innerHTML;
        }
    );
});
<?php } ?>
</script>
</section>
<!-- } 게시물 작성/수정 끝 -->