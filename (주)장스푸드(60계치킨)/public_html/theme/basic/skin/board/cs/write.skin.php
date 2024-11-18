<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//is_member($is_member);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

$si_arr = array("서울","세종","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

if(empty($wr_10)){
    $wr_10 = "미처리";
}

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
    <input type="hidden" name="wr_10" value="<?php echo $wr_10 ?>">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">

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

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">문의유형<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>            </td>
        </tr>
        <?php } ?>
		<tr>
            <th scope="row"><label for="wr_1">연락처</label></th>
            <td><input type="text" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input required"></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_2">지점</label></th>
            <td>
                <div class="shop_search" width="100%" style="padding-top:8px;">
                    <select name="wr_6" id="si" class="sch_sel">
                        <option value="">시/도(전체)</option>
                        <?php for($i=0; $i<count($si_arr); $i++){ ?>
                            <option value="<?php echo $si_arr[$i]?>" <?php if($write['wr_6']==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
                        <?php } ?>
                    </select>
                    <select name="wr_5" id="gu" class="sch_sel">
                        <option value="" >구/군(전체)</option>
                    </select>
                    <select name="wr_4" id="dong" class="sch_sel">
                        <option value="" >동</option>
                    </select>
                    <!--<input type="button" value="가맹점 찾기" id="search_store" class="btn_sch">-->
                    <!-- 기존 input 태그를 select 박스로 변경 -->
                    <select name="wr_3" id="wr_3" required class="sch_sel">
                        <? if(empty($write['wr_3'])) { ?>
                            <option value="" disabled selected>지점을 선택해주세요</option>
                        <? } else {?>
                            <option value="<?=$write['wr_3']?>" selected><?=$write['wr_3']?></option>
                        <?}?>


                    </select>
                </div>
            </td>
        </tr>
		<script type="text/javascript">
            function getCity(si, gu){
                if(!si && !gu){
                    return false;
                }

                var opt;
                var opt_select;

                $.ajax({
                    type:"GET",
                    url:"<?php echo G5_PLUGIN_URL?>/address/address.php",
                    dataType: "json",
                    data: {
                        "si": si,
                        "gu": gu
                    },
                    success:function(datas){
                        for(var i=0; i<datas.length; i++){
                            if("<?php echo $write['wr_6']?>" == datas[i] || "<?php echo $write['wr_5']?>" == datas[i] || "<?php echo $write['wr_4']?>" == datas[i])
                                opt_select = "selected";
                            else
                                opt_select = "";

                            opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";

                            if(!gu){
                                if(si == '세종'){
                                    $("#dong").append(opt);
                                } else {
                                    $("#gu").append(opt);
                                }

                            }else{
                                $("#dong").append(opt);
                            }
                        }
                    },
                    error:function(request,status,error){
                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    }
                });
            }

            $(document).ready(function (){
                getCity("<?php echo $write['wr_6']?>");
                getCity("<?php echo $write['wr_6']?>", "<?php echo $write['wr_5']?>");
            });

            $("#si").change(function (){
                $('#wr_3').empty(); // 기존 옵션들을 비웁니다.

                $("#gu").find("option").remove();
                $("#gu").append("<option value=''>구/군(전체)</option>");
                $("#dong").find("option").remove();
                $("#dong").append("<option value=''>동</option>");

                getCity($(this).val(), "")
            });

            $("#gu").change(function (){
                $('#wr_3').empty(); // 기존 옵션들을 비웁니다.

                var si = $("#si").val();
                $("#dong").find("option").remove();
                $("#dong").append("<option value=''>동</option>");

                getCity(si, $(this).val())
            });

            $('#dong').change(function (){
                $('#wr_3').empty(); // 기존 옵션들을 비웁니다.

                let si = $('#si').val();
                let gu = $('#gu').val();
                let dong = $('#dong').val();

                $.ajax({
                    url: g5_url + "/bbs/ajax.getstore_bysigudong.php",
                    type: "POST",
                    data: {
                        "si": si,
                        "gu": gu,
                        "dong": dong
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data && data.length > 0) {
                            $('#wr_3').append($('<option>', { value: '', text: '선택하세요' })); // 기본 옵션 추가
                            data.forEach(function(item) {
                                $('#wr_3').append($('<option>', { value: item, text: item })); // 반환된 데이터로 옵션 추가
                            });
                        }else{
                            alert('검색조건에 해당하는 지점이 없습니다.');
                        }

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('검색 실패: ', textStatus, errorThrown);
                    }
                });
            });
		</script>

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

        <?php if ($is_orderby) { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>
        <?php if($w==""){?>
            <tr>
                <th colspan="2" scope="row">
                    <input name="checkbox" type="checkbox" id="agree"/>
                    <label for="agree" style="padding:4px 0;">개인정보 수집·활용 동의(필수)</label>

                    <div name="textarea" style="font-size:11px; font-weight:200; background-color:#fff; width:100%; height:140px; color:#646464; padding:10px; overflow-y: scroll; "  readonly><?php /*echo get_text($config['cf_privacy']) */?>
                        [개인정보 수집·활용 동의]<br>
                        주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 개인정보 보호를 위하여, 개인정보 수집의 목적과 그 정보의 정책적, 시스템적 보안에 관하여 규정하고 그에 따른 동의를 받고자 합니다.<br>
                         <br>
                        1. 개인정보 수집 및 이용목적<br>
                        - 고객 상담 목적 외에 어떠한 용도로도 사용되지 않습니다.<br>
                        - 고객 상담에 있어, 원활하게 문의 사항의 접수 및 답변이 이루어질 수 있도록 하기 위한 최소한의 정보를 수집합니다.<br>
                        2. 수집하는 개인정보의 항목<br>
                        - 이름, 연락처(전화번호, 핸드폰번호), 이메일, 이용매장, 고객 문의사항(첨부파일 포함)<br>
                        3. 보유기간 및 이용기간<br>
                        - 보유 및 이용기간은 5년으로 하며, 기간 경과 후 본사는 해당 자료를 지체 없이 파기 합니다.<br>
                         <br>
                        [개인정보 제3자 제공 동의]<br>
                        주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 불만사항 해결 등을 위하여 다음과 같이 제3자에게 제공될 수 있고 그에 따른 동의를 받고자 합니다.<br>
                         <br>
                        1. 제공 받는 자<br>
                        - 60계치킨 가맹점<br>
                        2. 제공받는 자의 이용목적<br>
                        - 고객불만사항 해결, 인적, 물적 피해에 대한 보험 처리 업무<br>
                        3. 제공하는 개인정보의 항목<br>
                        - 이름, 연락처(전화번호, 핸드폰번호), 이메일, 이용매장, 고객 문의사항(첨부파일 포함)<br>
                        4. 보유기간 및 이용기간<br>
                        - 이용 목적 달성 시까지. 단, 관계 법령에 따른 보관기간이 더 길 경우 해당 기간까지<br>
                         <br>
                        [개인정보 위탁 동의]<br>
                        주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 불만사항에 대한 처리 등 원활한 업무 수행을 위하여 다음과 같이 개인정보 처리 업무를 외부 전문업체에 위탁하여 운영하고 있습니다.<br>
                         <br>
                        1. 수탁업체<br>
                        - 더화이트커뮤니케이션㈜<br>
                        2. 위탁업무 내용<br>
                        - 고객 상담 서비스 & 서비스 오퍼레이션<br>
                        3. 개인정보의 보유 및 이용기간<br>
                        - 보유기간 경과, 개인정보 처리 목적 달성, 위탁계약의 해지 및 만료시까지<br>
                         <br>
                        위와 같이 개인정보를 처리하는데 동의를 거부할 권리가 있습니다. 그러나 동의를 거부할 경우 고객센터 이용에 제한이 될 수 있습니다.

</div>

                    <!--<input name="checkbox" type="checkbox" id="agree02"/>
                    <label for="agree02" style="padding:4px 0;">고객센터 수집·활용 동의(필수)</label>
                    <textarea name="textarea" style="font-size:11px; font-weight:200; background-color:#fff; width:100%; height:140px; color:#646464; padding:10px">[개인정보 수집·활용 동의]
주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 개인정보 보호를 위하여, 개인정보
수집의 목적과 그 정보의 정책적, 시스템적 보안에 관하여 규정하고 그에 따른 동의를 받고자 합니다.

1. 개인정보 수집 및 이용목적
- 고객 상담 목적 외에 어떠한 용도로도 사용되지 않습니다.
- 고객 상담에 있어, 원활하게 문의 사항의 접수 및 답변이 이루어질 수 있도록 하기 위한 최소한의 정보를 수집합니다.
2. 수집하는 개인정보의 항목
- 이름, 연락처(전화번호, 핸드폰번호), 이메일, 이용매장, 고객 문의사항(첨부파일 포함)
3. 보유기간 및 이용기간
- 보유 및 이용기간은 5년으로 하며, 기간 경과 후 본사는 해당 자료를 지체 없이 파기 합니다.


[개인정보 제3자 제공 동의]
주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 불만사항 해결 등을 위하여 다음과 같이 제3자에게 제공될 수 있고 그에 따른 동의를 받고자 합니다.
1. 제공 받는 자
- 60계치킨 가맹점
2. 제공받는 자의 이용목적
- 고객불만사항 해결, 인적, 물적 피해에 대한 보험 처리 업무
3. 제공하는 개인정보의 항목
- 이름, 연락처(전화번호, 핸드폰번호), 이메일, 이용매장, 고객 문의사항(첨부파일 포함)
4. 보유기간 및 이용기간
- 이용 목적 달성 시까지. 단, 관계 법령에 따른 보관기간이 더 길 경우 해당 기간까지


[개인정보 위탁 동의]
주식회사 장스푸드는 60계치킨 고객센터를 이용하는 고객님의 불만사항에 대한 처리 등 원활한
업무 수행을 위하여 다음과 같이 개인정보 처리 업무를 외부 전문업체에 위탁하여 운영하고 있습니다.

1. 수탁업체
- 더화이트커뮤니케이션㈜
2. 위탁업무 내용
- 고객 상담 서비스 & 서비스 오퍼레이션
3. 개인정보의 보유 및 이용기간
- 보유기간 경과, 개인정보 처리 목적 달성, 위탁계약의 해지 및 만료시까지

위와 같이 개인정보를 처리하는데 동의를 거부할 권리가 있습니다. 그러나 동의를 거부할 경우 고객센터 이용에 제한이 될 수 있습니다.

                    </textarea>-->

                </th>
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

        /*
        let jijum = $('#wr_3').val();
        if(!jijum){
            alert("지점을 선택해주세요.");
            return false;
        }

        let qType = $('#ca_name').val();
        if(!qType){
            alert("문의유형을 선택해주세요.");
            return false;
        }
         */

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

    $('#ca_name').on('change', function() {
        var category = $(this).val(); // 선택된 카테고리 값을 가져옵니다.

        // 카테고리가 선택되지 않았다면 함수를 종료합니다.
        if (!category) {
            $('#content').val('');
            return;
        }

        $.ajax({
            url: g5_url + "/bbs/ajax.get_default_content.php",
            type: 'POST',
            dataType: 'json',
            data: {
                ca_name: category // 선택된 카테고리 값을 서버에 보냅니다.
            },
            success: function(response) {
                // 성공적으로 응답을 받았을 때 textarea의 내용을 변경합니다.
                $('#wr_content').text(response);
            },
            error: function(xhr, status, error) {
                // 요청이 실패했을 때 처리
                console.error("Error: " + error);
                $('#wr_content').text(''); // 에러가 발생하면 textarea를 비웁니다.
            }
        });
    });

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->