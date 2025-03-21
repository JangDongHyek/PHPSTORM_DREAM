<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?v=1">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<style>
    #layer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-height: 100vh;
        z-index: 999;
        background: rgba(255, 255, 255, 0.8);
        /*
        top: 50%!important;
        left: 50%!important;
        transform: translate(-50%,-50%)!important;
        max-width: 300px !important;
        max-height: 500px !important;
*/
    }

    #layer>div {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 90%;
        max-width: 350px !important;
        max-height: 500px !important;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
    }

    #btnCloseLayer {
        position: absolute;
        right: 0;
        top: 0px;
        padding: 10px 0;
    }

    @media(max-width:768px){
        #layer {
        background: rgb(109 109 109 / 80%);
        }
    }
    /*네모형 라디오*/
    .select input[type=radio]{    display: none;}
    .select input[type=radio]+label{    border-radius: 0; display: inline-block;    cursor: pointer;    height: 49px; padding: 0 10px;  background-color: #fff;    color: #373844;    line-height: 49px; border-radius: 10px !important;   text-align: center;  font-weight:400;}
    .select input[type=radio]+label{    background-color: #fff;    color: #373844;  border: 1px solid #C9C9C9;}
    .select input[type=radio]:disabled+label{    background-color: #c9c9c9;    color: #373844;}
    .select input[type=radio]:checked+label{background-color: #f0e6ff;    border: 1px solid #005ccf;  color: #005ccf; font-weight:bold;}

</style>
<script type="text/javascript">
    const autoHyphen2 = (target) => {
        target.value = target.value
            .replace(/[^0-9]/g, '')
            .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
    }

</script>
<section class="qna_w" id="bo_w">
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
        <input type="hidden" name="wr_subject" value="새가족 등록이 접수되었습니다.">
        <input type="hidden" name="wr_content" value="새가족 등록이 접수되었습니다.">
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
        <? if(!$is_admin){?>
            <? if($bo_table == "sub02_01_04"){ ?>
                <div class="agree">
                    <h2>Consent to Collection and Use of Personal Information</h2>
                    <div class="txt cf">
                        <div class="bx"><strong>Purpose of collection and use of personal information</strong>
                            <div class="con">Your personal information will only be used for the purpose of providing services smoothly on the Immanuel Church website and app.</div>
                        </div>
                        <div class="bx"><strong>Items for collection and use of personal information</strong>
                            <div class="con">Name, date of birth, mobile phone number, address, etc</div>
                        </div>
                        <div class="bx"><strong>Period for which personal information is held and used</strong>
                            <div class="con">Your personal information will be retained and used until you withdraw from the membership, and we will destroy it immediately upon your request.</div>
                        </div>
                    </div>
                    <div class="agree_ch">
                        <label><input type=checkbox name="agree_chk" value="y" required> I agree to collect and use my personal information for the above purposes.</label>
                    </div>
                </div>
                <!--.agree-->
            <? }else { ?>
                <div class="agree">
                    <h2>개인정보 수집·이용 동의</h2>
                    <div class="txt cf">
                        <div class="bx"><strong>개인정보의 수집·이용 목적</strong>
                            <div class="con">귀하의 개인정보는 임마누엘교회 홈페이지 및 앱의 원활한 서비스 제공을 위한 목적으로만 사용됩니다.</div>
                        </div>
                        <div class="bx"><strong>수집하려는 개인정보의 항목</strong>
                            <div class="con">성명, 생년월일, 휴대전화번호, 주소, 교적사항 등</div>
                        </div>
                        <div class="bx"><strong>개인정보의 보유 및 이용 기간</strong>
                            <div class="con">귀하의 개인정보는 회원 탈퇴 시까지 보유 및 이용되며, 동의자의 요구가 있을 경우에는 즉시 해당정보를 파기합니다.</div>
                        </div>
                    </div>
                    <div class="agree_ch">
                        <label><input type=checkbox name="agree_chk" value="y" required> 본인은 위와 같은 목적으로 본인의 개인정보를 수집·이용하는 것에 동의합니다.</label>
                    </div>
                </div>
                <!--.agree-->
            <? } ?>
        <!--.agree-->
        <? }?>

        <div>
            <div class="flex">
                <p><label for="wr_name">
                        <? if($bo_table == "sub02_01_04"){ ?>
                            First Name
                        <? }else { ?>
                            성명
                        <? } ?>
                        <strong class="sound_only">필수</strong>
                    </label></p>
                <div><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required"></div>


                <p><label for="">
                        <? if($bo_table == "sub02_01_04"){ ?>
                            Last Name
                        <? }else { ?>
                            성별
                        <? } ?><strong class="sound_only">필수</strong></label>
                </p>
                <div class="flex select"  style="margin-bottom: 0">
                    <? if($bo_table == "sub02_01_04"){ ?>
                        <input type="text" name="wr_5" id="wr_5" value="<?php echo $write[wr_5]?>" class="frm_input required">
                    <? }else { ?>
                        <input type="radio" name="wr_5" value="남자" id="male" class="frm_input required" <?php if(isset($write['wr_5']) && $write['wr_5'] == "남자") echo "checked"; ?>>
                        <label for="male">남자</label>

                        <input type="radio" name="wr_5" value="여자" id="female" class="frm_input required" <?php if(isset($write['wr_5']) && $write['wr_5'] == "여자") echo "checked"; ?>>
                        <label for="female">여자</label>
                    <? } ?>
                </div>
            </div>

            <div class="flex">
                <p><label for="">
                        <? if($bo_table == "sub02_01_04"){ ?>
                            Cell Phone No.
                        <? }else { ?>
                            핸드폰번호
                        <? } ?><strong class="sound_only">필수</strong></label></p>
                <div><input type="tel" name="wr_1" id="wr_1" value="<?php echo $write[wr_1]?>" required class="frm_input required" oninput="autoHyphen2(this)"></div>

                <p><label for="">
                        <? if($bo_table == "sub02_01_04"){ ?>
                            Date of Birth
                        <? }else { ?>
                            생년월일
                        <? } ?><strong class="sound_only">필수</strong></label></p>
                <div><input type="date" name="wr_8" value="<?php echo $write[wr_8]?>" id="wr_8" required class="frm_input required" max="9999-12-31"></div>

            </div>

            <div class="flex">
                <? if($bo_table == "sub02_01_04"){ ?>
                    <p class="sub"><label for="">Select Gender<strong class="sound_only">필수</strong></label></p>
                    <div class="flex select" style="margin-bottom: 0">
                        <input type="radio" name="wr_4" value="남자" id="male" class="frm_input required" <?php if($write[wr_4]=="male") echo"checked"; ?>><label for="male">Male</label>
                        <input type="radio" name="wr_4" value="여자" id="female" class="frm_input required" <?php if($write[wr_4]=="female") echo "checked"; ?>><label for="female">Female</label>
                    </div>
                <? }else { ?>
                    <p class="sub"><label for="">주소<strong class="sound_only">필수</strong></label></p>
                    <div style="display: flex; align-items: center">
                        <p style="position: relative; width: 100%"><input type="text" name="wr_3" value="<?php echo $write[wr_3]?>" id="wr_3" class="frm_input ver_tel">
                            <a href="javascript:;" onclick="sample2_execDaumPostcode()" class="ver_btn"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </p>
                        <p style="width: 100%"><input type="text" name="wr_4" value="<?php echo $write[wr_4]?>" id="wr_4" class="frm_input"></p>
                    </div>
                <? } ?>
            </div>

            <div class="flex">
                <p class="sub" style="max-width: 200px"><label for="">
                        <? if($bo_table == "sub02_01_04"){ ?>
                            How did you get to know our church?
                        <? }else { ?>
                            어떻게 교회를 알게 되셨나요?
                        <? } ?><strong class="sound_only">필수</strong></label></p>
                <div>
                    <p><input type="text" name="wr_6" value="<?php echo $write[wr_6]?>" id="wr_6" class="frm_input"></p>
                </div>
            </div>

            <? if($bo_table == "sub02_01"||$bo_table == "sub02_01_02") {?>
            <div class="flex">
                    <p  class="sub" style="max-width: 200px"><label for="">인도자가 있다면 적어주세요.<strong class="sound_only">필수</strong></label></p>
                <div>
                    <p><input type="text" name="wr_7" value="<?php echo $write[wr_7]?>" id="wr_7" class="frm_input"></p>
                </div>
            </div>
            <? }else if($bo_table == "sub02_01_03"){ ?>
            <div class="flex">
                    <p  class="sub" style="max-width: 200px"><label for="">학교와 학년을 적어주세요.<strong class="sound_only">필수</strong></label></p>
                <div>
                    <p><input type="text" name="wr_7" value="<?php echo $write[wr_7]?>" id="wr_7" class="frm_input"></p>
                </div>
            </div>
            <? }else { ?>
            <? } ?>




                    <?/*tr>
                        <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
                        <td class="wr_content" colspan="3">
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
                    </tr*/?>

                    <!--    <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
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
                    <?php } ?> -->

        </div>

        <div class="btn_confirm">
            <? if($bo_table == "sub02_01_04"){ ?>
            <input type="submit" value="Register" id="btn_submit" accesskey="s" class="btn btn-large btn-blue">
            <? }else { ?>
            <input type="submit" value="등록하기" id="btn_submit" accesskey="s" class="btn btn-large btn-blue">
            <? } ?>
            <!--        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>-->
            <? if($is_admin){?>
            <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록</a>
            <? } ?>

        </div>
    </form>

</section>
<!-- } 게시물 작성/수정 끝 -->



<!--   주소찾기-->
    <div id="layer">
        <span id="btnCloseLayer" onclick="closeDaumPostcode()">닫기<i class="fa-solid fa-xmark"></i></span>
        <!--<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">-->
    </div>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // 우편번호 찾기 화면을 넣을 element
        var element_layer = document.getElementById('layer');

        function closeDaumPostcode() {
            // iframe을 넣은 element를 안보이게 한다.
            element_layer.style.display = 'none';
        }

        function sample2_execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if (data.userSelectedType === 'R') {
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if (data.buildingName !== '' && data.apartment === 'Y') {
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if (extraAddr !== '') {
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        //                    document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        //                  document.getElementById("sample2_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('wr_3').value = data.zonecode;
                    document.getElementById("wr_4").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    //                document.getElementById("sample2_detailAddress").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    element_layer.style.display = 'none';
                },
                width: '100%',
                height: '100%',
                maxSuggestItems: 2
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
        // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
        // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
        function initLayerPosition() {
            //        var width = 300; //우편번호서비스가 들어갈 element의 width
            //        var height = 400; //우편번호서비스가 들어갈 element의 height
            //        var borderWidth = 2; //샘플에서 사용하는 border의 두께

            // 위에서 선언한 값들을 실제 element에 넣는다.
            //        element_layer.style.width = width + 'px';
            //        element_layer.style.height = height + 'px';
            //        element_layer.style.border = borderWidth + 'px solid';
            // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
            //        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
            //        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
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

        function html_auto_br(obj) {
            if (obj.checked) {
                result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
                if (result)
                    obj.value = "html2";
                else
                    obj.value = "html1";
            } else
                obj.value = "";
        }

        function fwrite_submit(f) {
            <?php //echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

            if(f.bo_table.value == 'sub02_01_04') {
                if(!f.wr_4.value) {
                    alert('Please check your gender');
                    return false;
                }
            }else {
                if(!f.wr_5.value) {
                    alert("성별을 체크해주세요.");
                    return false;
                }
            }

            var subject = "";
            var content = "";
            $.ajax({
                url: g5_bbs_url + "/ajax.filter.php",
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
                alert("제목에 금지단어('" + subject + "')가 포함되어있습니다");
                f.wr_subject.focus();
                return false;
            }

            if (content) {
                alert("내용에 금지단어('" + content + "')가 포함되어있습니다");
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
                        alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
                        return false;
                    } else if (char_max > 0 && char_max < cnt) {
                        alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
                        return false;
                    }
                }
            }

            <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

            document.getElementById("btn_submit").disabled = "disabled";

            return true;
        }

    </script>
