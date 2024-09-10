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

    <!--사이버 감사-->
        <div class="audit_from">
            <div class="flex">
                <h3>제보자 정보</h3>
                <p><span class="color_red">*</span>는 필수 입력사항 입니다.</p>
            </div>
            <dl>
                <dt><label for="wr_name"><span class="color_red">*</span>이름</label></dt>
                <dd>
                    <input type="text" id="wr_name" name="wr_name" placeholder="이름을 입력해 주세요" required>
                    <p><input type="checkbox" id="wr_1" name="wr_1" onchange="changeWr()"><label for="wr_1">익명접수</label></p>
                </dd>
            </dl>
            <dl>
                <dt><label for="contact"><span class="color_red">*</span>연락처</label></dt>
                <dd>
                    <input type="text" id="contact" name="wr_2" placeholder="예) 010-1234-5678" required>
                </dd>
            </dl>
            <dl>
                <dt><label for="wr_email"><span class="color_red">*</span>이메일</label></dt>
                <dd>
                    <input type="text" id="wr_email" name="wr_email" placeholder="예) example@seco.com" required>
                </dd>
            </dl>
            <h3>제보 내용</h3>
            <dl>
                <dt><label for="wr_subject"><span class="color_red">*</span>제목</label></dt>
                <dd>
                    <input type="text" id="wr_subject" name="wr_subject" placeholder="제목을 입력해 주세요" required>
                </dd>
            </dl>
            <dl style="align-items: baseline;">
                <dt><label for="wr_content"><span class="color_red">*</span>내용</label></dt>
                <dd>
                    <textarea id="wr_content" name="wr_content" placeholder="내용을 입력해 주세요" required></textarea>
                </dd>
            </dl>
            <dl>
                <dt><label for="attachment">첨부파일</label></dt>
                <dd>
                    <input type="text" id="fileName" name="fileName" placeholder="파일을 첨부해 주세요 (최대 20M)" readonly required>
                    <input type="file" id="attachment" name="bf_file[]" accept=".pdf,.jpg,.png,.doc,.docx" style="display:none" onchange="document.getElementById('fileName').value = this.files[0].name;">
                    <button class="btn" type="button" onclick="document.getElementById('attachment').click();">파일 선택</button>
                </dd>
            </dl>
            <textarea class="privacy">
1. 개인정보 처리방침의 목적
대경화학(주)(이하 "회사")는 개인정보 보호법, 정보통신망 이용촉진 및 정보보호 등에 관한 법률 등 관련 법령을 준수하며, ESG 경영 원칙을 바탕으로 개인정보를 보호하고 안전하게 처리합니다. 본 방침은 이용자의 개인정보 보호와 권익을 보호하기 위한 목적으로 작성되었습니다.

2. 개인정보의 수집 및 이용 목적
회사는 다음과 같은 목적으로 개인정보를 수집하고 이용합니다. 수집된 개인정보는 명시된 목적 이외의 용도로는 이용되지 않으며, 목적 변경 시 사전 동의를 구할 것입니다.

서비스 제공 및 계약 이행: 제품 주문, 배송, A/S 제공 등
고객 관리: 고객 문의 처리, 불만 접수 및 처리, 고객 만족도 조사
마케팅 및 홍보: 신제품 및 이벤트 정보 제공, 프로모션 안내
법적 요구 준수: 관련 법령에 따른 의무 이행, 법적 분쟁 대응

3. 수집하는 개인정보 항목
회사는 서비스 제공을 위해 다음과 같은 개인정보를 수집할 수 있습니다:

필수 항목: 이름, 연락처, 이메일, 주소, 거래 내역, 로그인 정보(아이디, 비밀번호)
선택 항목: 생년월일, 직업, 관심 분야
자동 수집 항목: IP 주소, 쿠키, 방문 일시, 서비스 이용 기록

4. 개인정보의 보유 및 이용 기간
회사는 개인정보 수집 및 이용 목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 다만, 관련 법령에서 정한 경우에는 일정 기간 동안 개인정보를 보유할 수 있습니다.

고객관리 정보: 서비스 종료 후 5년
거래 관련 기록: 5년 (전자상거래 등에서의 소비자 보호에 관한 법률에 따름)

5. 개인정보의 제3자 제공
회사는 원칙적으로 이용자의 개인정보를 제3자에게 제공하지 않습니다. 다만, 다음의 경우에는 예외로 합니다:

이용자가 사전에 동의한 경우
법령의 규정에 따라 필요한 경우
회사가 이용 계약 이행을 위해 불가피하게 협력 업체에 제공하는 경우(예: 배송업체)

6. 개인정보의 처리 위탁
회사는 원활한 개인정보 업무 처리를 위해 외부에 위탁할 수 있으며, 이 경우 위탁 계약을 통해 개인정보 보호에 관한 사항을 명확히 규정하고 감독합니다. 위탁 업체와 그 역할은 홈페이지에 공시됩니다.

7. 개인정보의 안전성 확보 조치
회사는 개인정보 보호를 위해 다음과 같은 안전성 확보 조치를 시행하고 있습니다:

기술적 조치: 방화벽, 백신 프로그램 설치, 비밀번호 암호화, 접근 통제 시스템 운영
관리적 조치: 개인정보 취급자 교육, 접근 권한 관리, 정기적인 보안 점검
물리적 조치: 서버 및 데이터베이스 접근 통제, 보안 시스템 관리

8. 이용자의 권리 및 행사 방법
이용자는 언제든지 회사에 본인의 개인정보 조회, 수정, 삭제, 처리 정지를 요청할 수 있습니다. 이러한 요청은 서면, 전화, 이메일을 통해 접수 가능하며, 회사는 이를 신속히 처리하겠습니다.

9. 개인정보 침해에 대한 대응
회사는 개인정보 침해 사고를 방지하기 위해 지속적인 모니터링과 예방 활동을 수행하고 있으며, 개인정보 침해 발생 시 신속하게 대응하고 필요한 조치를 취할 것입니다.

10. 개인정보 보호 책임자 및 연락처
개인정보 관련 문의 및 고충 처리는 아래의 담당 부서를 통해 접수하실 수 있습니다:

개인정보 보호 책임자: 정도영
연락처: 051-263-1490
주소: 부산광역시 사하구 다산로 226번길 33(장림동

11. 정책 변경에 대한 안내
본 개인정보 처리방침은 시행일로부터 적용되며, 내용 추가, 삭제 및 수정이 있을 시 사전 공지 후 시행됩니다.

시행일: 2024년 9월 5일
            </textarea>


        </div>

    <!--//사이버 감사-->
    <?/*
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

        <?php if ($is_email) { ?><!--
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email"  maxlength="100"></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" ></td>
        </tr>
        --><?php } ?>

        <?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <?php if($editor_content_js) echo $editor_content_js; ?>
                    <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                    <div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>
                    <?php } ?>
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
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_orderby) { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $write[wr_orderby] ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>
    */?>
    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <?php if ($is_admin) { ?>
            <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">제보 목록</a>
        <?php } ?>

    </div>
	<!-- NAVER SCRIPT -->
	<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
	<script type="text/javascript">
	var _nasa={};
	_nasa["cnv"] = wcs.cnv("5","1");
	</script>
	<!-- NAVER SCRIPT END-->
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

    function changeWr() {
        let checked = $("#wr_1").is(":checked")

        if(checked) {
            $("#wr_name").val("익명접수")
        }else {
            $("#wr_name").val("")
        }
    }

    function fwrite_submit(f)
    {


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