<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

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

	<input type="hidden" id="secret" name="secret" value="secret">
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
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
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

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email"  maxlength="100"></td>
        </tr>
        <?php } ?>


        <?php if ('121.140.204.65' == $_SERVER['REMOTE_ADDR']) { ?>
            <!--TODO-->
        <?php } ?>


		<tr>
            <th scope="row"><label for="wr_1">연락처</label></th>
            <td><input type="text" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input required"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_2">지점</label></th>
            <td>
				<input type="text" name="wr_2" value="<?php echo $write['wr_2'] ?>" id="wr_2" required class="frm_input required">
				<div id="store-list" class="" style="border:1px solid #000;background-color:#fff;height:300px;overflow-y:scroll;width:100%;position:absoulte;display:none"></div>			</td>
        </tr>
		<script type="text/javascript">
			$(function(){
				$("#wr_2").keyup(function(){
					if(0 < $(this).val().length){
						$.ajax({
							url:"<?=G5_BBS_URL?>/ajax.store.list.php",
							data:{wr_subject:$(this).val()},
							dataType:"HTML",
							type:"POST",
							success:function(data){
								$("#store-list").html(data);
							}
						});
						$("#store-list").css("display","block");
					}else{
						$("#store-list").css("display","none");
						$("#store-list").html("");
					}
				});
				
			});
			function storeChoice(wr_2){
				$("#wr_2").val(wr_2);
				$("#store-list").css("display","none");
				$("#store-list").html("");
			}
		</script>
        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>            </td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
                </div>            </td>
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
                <?php } ?>            </td>
        </tr>        

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
                <?php } ?>            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>            </td>
        </tr>

        <?php } ?>
        <?php if($w==""){?>
        <tr>
            <th colspan="2" scope="row">
                <input name="checkbox" type="checkbox" id="agree"/>
                <label style="padding:4px 0;">개인정보 수집·활용 동의(필수)</label>


                <textarea name="textarea" style="font-size:11px; font-weight:200; background-color:#fff; width:100%; height:140px; color:#646464; padding:10px">개인정보 수집·활용 동의

주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 개인정보 보호를 위하여, 개인정보 수집의 목적과 그 정보의 정책적, 시스템적 보안에 관하여 규정하고 그에 따른 동의를 받고자 합니다.

1. 개인정보 수집 및 이용목적
 - 고객 상담 목적 외에 어떠한 용도로도 사용되지 않습니다.
 - 고객 상담에 있어, 원활하게 문의 사항의 접수 및 답변이 이루어질 수 있도록 하기 위한 최소한의 정보를 수집합니다.

2. 수집하는 개인정보의 항목
 - 이름, 연락처(전화번호, 핸드폰번호), 이메일, 이용매장, 고객 문의사항(첨부파일 포함)

3. 보유기간 및 이용기간
 - 보유 및 이용기간은 5년으로 하며, 기간 경과 후 본사는 해당 자료를 지체 없이 파기 합니다.

개인정보 제3자 제공 동의

주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 불만사항 해결 등을 위하여 다음과 같이 제3자에게 제공될 수 있고 그에 따른 동의를 받고자 합니다.

1.	제공 받는 자
-	60계치킨 가맹점
2.	제공받는 자의 이용목적
-	고객불만사항 해결, 인적, 물적 피해에 대한 보험 처리 업무
3.	제공하는 개인정보의 항목
-	이름, 연락처(전화번호, 핸드폰번호), 이메일, 이용매장, 고객 문의사항(첨부파일 포함)
4.	보유기간 및 이용기간
-	이용 목적 달성 시까지. 단, 관계 법령에 따른 보관기간이 더 길 경우 해당 기간까지 
위와 같이 개인정보를 처리하는데 동의를 거부할 권리가 있습니다. 그러나 동의를 거부할 경우 고객센터 이용에 제한이 될 수 있습니다.

          </textarea>

            </th>
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
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <!--<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>-->
    </div>
    </form>

    <script> 
	var first_focus = 0;

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

//내용 안내문구 표시
/*	$("#wr_content").focus(function(){

			if(<?if($w=='') echo "'empty'"; else echo $w;?>=='empty' && first_focus!=1){
				
					$("#wr_content").html("");					
					first_focus=1;

			}

	});*/

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
		<?php if($w==""){?>
			if($("#agree").prop("checked")==false){
				alert("개인정보 수집·활용 동의를 하셔야합니다.");
				return false;
			}
		<?php }?>

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