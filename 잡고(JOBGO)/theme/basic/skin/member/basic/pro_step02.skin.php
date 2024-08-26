<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

?>

<style>
    textarea { resize: unset; }
    .price_cate li { pointer-events : none; }
</style>

<!--1차카테고리(디자인) > 2차카테고리(웹툰.캐릭터)를 임의로 선택하고 등록가정시-->

<!-- 재능상품 등록하기(2.가격정보 단계) -->
<div id="pro_step">
    
    <!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="move_category('pro_step01.php');"><span class="nm">01</span>기본정보</a></li>
        <li class="active"><a href="javascript:void(0);"><span class="nm">02</span>가격정보</a></li>
        <li><a href="javascript:void(0);" onclick="move_category('pro_step03.php');"><span class="nm">03</span>서비스상세</a></li>
    </ul>
    <!--등록 폼 시작-->
    <div class="in">
        <form id="frmpro" name="frmpro" method="post">
            <input type="hidden" name="mode" value="pro_step2">
            <input type="hidden" id="move_mode" name="move_mode" value=""> <!-- 임시저장 or 다음단계 -->
            <input type="hidden" id="page" name="page" value=""> <!-- 이동할 탭 (01-기본정보/02-가격정보/03-서비스상세) -->
            <input type="hidden" id="ta_idx" name="ta_idx" value="<?=$ta_idx?>">
            <input type="hidden" id="w" name="w" value="<?=$_REQUEST['w']?>">
            <!--<input type="hidden" id="pta_package" name="pta_package" value="<?/*=$pta_st['pta_package']*/?>">--> <!-- 패키지 설정 -->
            <div class="form-group">
                <div class="HeadTit">
                    <div class="tit">가격정보</div>
                    <!--패키지로 가격설정 on시 탭메뉴 모두 활성화/패키지로 가격설정 off시 스탠다드 탭만 활성화 되게..-->
                    <!--<div class="st">
                        <strong>패키지로 가격설정</strong>
                        <span class="onoffswitch">
                            <input type="checkbox" name="myonoffswitch_mobile" class="onoffswitch-checkbox" id="myonoffswitch_mobile" <?php /*if($pta_st['pta_package'] == 'Y') { echo 'checked'; }*/?>>
                            <label class="onoffswitch-label" for="myonoffswitch_mobile">
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </span>
                    </div>--><!--st-->
                </div><!--HeadTit-->

                <div class="tbl_price">
                    <table summary="가격정보">
                        <caption>가격정보</caption>
                        <colgroup>
                            <col style="width:*">
                            <col style="width:28%">
                            <col style="width:28%">
                            <col style="width:28%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th></th>
                            <th>STANDARD</th>
                            <th>DELUXE</th>
                            <th>PREMIUM</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>제목<span class="pt">*</span></th>
                            <td class="right">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt doc_text" id="standard_pta_title" name="standard_pta_title" placeholder="제목을 50자 이하로 입력해 주세요. "><?=$pta_st['pta_title']?></textarea>
                                    <div class="text_limit"><span id="standard_pta_title_count"><?=mb_strlen($pta_st['pta_title'],'utf-8') > 0  ? mb_strlen($pta_st['pta_title'],'utf-8'): "0";?></span> / 50</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                            <td class="right">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt doc_text" id="deluxe_pta_title" name="deluxe_pta_title" placeholder="제목을 50자 이하로 입력해 주세요. "><?=$pta_de['pta_title']?></textarea>
                                    <div class="text_limit"><span id="deluxe_pta_title_count"><?=mb_strlen($pta_de['pta_title'],'utf-8') > 0  ? mb_strlen($pta_de['pta_title'],'utf-8'): "0";?></span> / 50</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                            <td class="right">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt doc_text" id="premium_pta_title" name="premium_pta_title" placeholder="제목을 50자 이하로 입력해 주세요. "><?=$pta_pr['pta_title']?></textarea>
                                    <div class="text_limit"><span id="premium_pta_title_count"><?=mb_strlen($pta_pr['pta_title'],'utf-8') > 0  ? mb_strlen($pta_pr['pta_title'],'utf-8'): "0";?></span> / 50</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                        </tr>
                        <tr>
                            <th>설명<span class="pt">*</span></th>
                            <td class="right">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt big doc_text" id="standard_pta_content" name="standard_pta_content" placeholder="상세설명을 100자 이하로 입력해 주세요"><?=$pta_st['pta_content']?></textarea>
                                    <div class="text_limit"><span id="standard_pta_content_count"><?=mb_strlen($pta_st['pta_content'],'utf-8') > 0  ? mb_strlen($pta_st['pta_content'],'utf-8')-1: "0";?></span> / 100</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                            <td class="right">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt big doc_text" id="deluxe_pta_content" name="deluxe_pta_content" placeholder="상세설명을 100자 이하로 입력해 주세요"><?=$pta_de['pta_content']?></textarea>
                                    <div class="text_limit"><span id="deluxe_pta_content_count"><?=mb_strlen($pta_de['pta_content'],'utf-8') > 0  ? mb_strlen($pta_de['pta_content'],'utf-8')-1: "0";?></span> / 100</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                            <td class="right">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt big doc_text" id="premium_pta_content" name="premium_pta_content" placeholder="상세설명을 100자 이하로 입력해 주세요"><?=$pta_pr['pta_content']?></textarea>
                                    <div class="text_limit"><span id="premium_pta_content_count"><?=mb_strlen($pta_pr['pta_content'],'utf-8') > 0  ? mb_strlen($pta_pr['pta_content'],'utf-8')-1: "0";?></span> / 100</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                        </tr>
                        <tr>
                            <th>옵션설명<span class="pt">*</span></th>
                            <td class="right height">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt big doc_text" id="standard_pta_text" name="standard_pta_text" placeholder="V 반응형 웹&#13;&#10;V 컨텐츠 업로드&#13;&#10;V 맞춤 디자인 제공&#13;&#10;V 페이지 수 : 0페이지"><?=$pta_st['pta_text']?></textarea>
                                    <div class="text_limit"><span id="standard_pta_text_count"><?=mb_strlen($pta_st['pta_text'],'utf-8') > 0  ? mb_strlen($pta_st['pta_text'],'utf-8')-1: "0";?></span> / 100</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                            <td class="right height">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt big doc_text" id="deluxe_pta_text" name="deluxe_pta_text" placeholder="V 반응형 웹&#13;&#10;V 컨텐츠 업로드&#13;&#10;V 맞춤 디자인 제공&#13;&#10;V 페이지 수 : 0페이지"><?=$pta_de['pta_text']?></textarea>
                                    <div class="text_limit"><span id="deluxe_pta_text_count"><?=mb_strlen($pta_de['pta_text'],'utf-8') > 0  ? mb_strlen($pta_de['pta_text'],'utf-8')-1: "0";?></span> / 100</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                            <td class="right height">
                                <div class="pri_bx">
                                    <textarea class="form-control pri_txt big doc_text" id="premium_pta_text" name="premium_pta_text" placeholder="V 반응형 웹&#13;&#10;V 컨텐츠 업로드&#13;&#10;V 맞춤 디자인 제공&#13;&#10;V 페이지 수 : 0페이지"><?=$pta_pr['pta_text']?></textarea>
                                    <div class="text_limit"><span id="premium_pta_text_count"><?=mb_strlen($pta_pr['pta_text'],'utf-8') > 0  ? mb_strlen($pta_pr['pta_text'],'utf-8')-1: "0";?></span> / 100</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div><!--pri_bx-->
                            </td>
                        </tr>
                        <tr>
                            <th>금액(VAT포함)<span class="pt">*</span></th>
                            <td class="right">
                                <div class="pri_bx won">
                                    <input type="text" class="form-control won" id="standard_pta_pay" name="standard_pta_pay" value="<?= $pta_st['pta_pay'] != 0 ?number_format($pta_st['pta_pay']) : "" ?>" required placeholder="스탠다드 금액을 입력해 주세요" onkeyup="add_comma(this);">
                                    <span class="wons">원</span>
                                </div><!--pri_bx-->
                            </td>
                            <td class="right">
                                <div class="pri_bx won">
                                    <input type="text" class="form-control won" id="deluxe_pta_pay" name="deluxe_pta_pay" value="<?= $pta_de['pta_pay'] != 0 ?number_format($pta_de['pta_pay']) : "" ?>" placeholder="디럭스 금액을 입력해 주세요" onkeyup="add_comma(this);">
                                    <span class="wons">원</span>
                                </div><!--pri_bx-->
                            </td>
                            <td class="right">
                                <div class="pri_bx won">
                                    <input type="text" class="form-control won" id="premium_pta_pay" name="premium_pta_pay" value="<?= $pta_pr['pta_pay'] != 0 ?number_format($pta_pr['pta_pay']) : "" ?>" placeholder="프리미엄 금액을 입력해 주세요" onkeyup="add_comma(this);">
                                    <span class="wons">원</span>
                                </div><!--pri_bx-->
                            </td>
                        </tr>
                        <tr>
                            <th>작업기간<span class="pt">*</span></th>
                            <td>
                                <div class="pri_bx">
                                    <select class="form-control sec" id="standard_pta_select1" name="standard_pta_select1">
                                        <option value="0">선택해 주세요</option>
                                        <option value="1">1일</option>
                                        <option value="2">2일</option>
                                        <option value="3">3일</option>
                                        <option value="4">4일</option>
                                        <option value="5">5일</option>
                                        <option value="6">6일</option>
                                        <option value="7">7일</option>
                                        <option value="8">8일</option>
                                        <option value="9">9일</option>
                                        <option value="10">10일</option>
                                        <option value="11">11일</option>
                                        <option value="12">12일</option>
                                        <option value="13">13일</option>
                                        <option value="14">14일</option>
                                        <option value="15">15일</option>
                                        <option value="16">16일</option>
                                        <option value="17">17일</option>
                                        <option value="18">18일</option>
                                        <option value="19">19일</option>
                                        <option value="20">20일</option>
                                        <option value="21">21일</option>
                                        <option value="22">22일</option>
                                        <option value="23">23일</option>
                                        <option value="24">24일</option>
                                        <option value="25">25일</option>
                                        <option value="26">26일</option>
                                        <option value="27">27일</option>
                                        <option value="28">28일</option>
                                        <option value="29">29일</option>
                                        <option value="30">30일</option>
                                    </select>
                                </div><!--pri_bx-->
                            </td>
                            <td>
                                <div class="pri_bx">
                                    <select class="form-control sec" id="deluxe_pta_select1" name="deluxe_pta_select1">
                                        <option value="0">선택해 주세요</option>
                                        <option value="1">1일</option>
                                        <option value="2">2일</option>
                                        <option value="3">3일</option>
                                        <option value="4">4일</option>
                                        <option value="5">5일</option>
                                        <option value="6">6일</option>
                                        <option value="7">7일</option>
                                        <option value="8">8일</option>
                                        <option value="9">9일</option>
                                        <option value="10">10일</option>
                                        <option value="11">11일</option>
                                        <option value="12">12일</option>
                                        <option value="13">13일</option>
                                        <option value="14">14일</option>
                                        <option value="15">15일</option>
                                        <option value="16">16일</option>
                                        <option value="17">17일</option>
                                        <option value="18">18일</option>
                                        <option value="19">19일</option>
                                        <option value="20">20일</option>
                                        <option value="21">21일</option>
                                        <option value="22">22일</option>
                                        <option value="23">23일</option>
                                        <option value="24">24일</option>
                                        <option value="25">25일</option>
                                        <option value="26">26일</option>
                                        <option value="27">27일</option>
                                        <option value="28">28일</option>
                                        <option value="29">29일</option>
                                        <option value="30">30일</option>
                                    </select>
                                </div><!--pri_bx-->
                            </td>
                            <td>
                                <div class="pri_bx">
                                    <select class="form-control sec" id="premium_pta_select1" name="premium_pta_select1">
                                        <option value="0">선택해 주세요</option>
                                        <option value="1">1일</option>
                                        <option value="2">2일</option>
                                        <option value="3">3일</option>
                                        <option value="4">4일</option>
                                        <option value="5">5일</option>
                                        <option value="6">6일</option>
                                        <option value="7">7일</option>
                                        <option value="8">8일</option>
                                        <option value="9">9일</option>
                                        <option value="10">10일</option>
                                        <option value="11">11일</option>
                                        <option value="12">12일</option>
                                        <option value="13">13일</option>
                                        <option value="14">14일</option>
                                        <option value="15">15일</option>
                                        <option value="16">16일</option>
                                        <option value="17">17일</option>
                                        <option value="18">18일</option>
                                        <option value="19">19일</option>
                                        <option value="20">20일</option>
                                        <option value="21">21일</option>
                                        <option value="22">22일</option>
                                        <option value="23">23일</option>
                                        <option value="24">24일</option>
                                        <option value="25">25일</option>
                                        <option value="26">26일</option>
                                        <option value="27">27일</option>
                                        <option value="28">28일</option>
                                        <option value="29">29일</option>
                                        <option value="30">30일</option>
                                    </select>
                                </div><!--pri_bx-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!--form-group-->
        </form>
    </div><!--in-->

    <!--저장 부분-->
    <div class="f_save cf">
        <div class="save hide"><a href="javascript: form_action('save');">임시저장</a></div>
        <div class="save"><a href="javascript:move_category('pro_step01.php')"><i class="fal fa-undo"></i> 이전단계</a></div>
        <div class="arr"><a href="javascript: form_action('next')">다음단계</a></div>
    </div><!--f_save-->

</div><!--pro_step-->

<script>
    $(function() {
        if($("input:checkbox[name=myonoffswitch_mobile]").is(":checked") == true) {
            $('.price_cate li').attr('style', 'pointer-events : inherit;'); // DELUXE / PREMIUM 비활성화
        }

        // standard
        if('<?=$pta_st['pta_select1']?>' != '') { $('#standard_pta_select1').val('<?=$pta_st['pta_select1']?>').attr('selected', 'selected'); } // 작업기간
        if('<?=$pta_st['pta_select2']?>' != '') { $('#standard_pta_select2').val('<?=$pta_st['pta_select2']?>').attr('selected', 'selected'); } // 수정횟수
        if('<?=$pta_st['pta_select3']?>' != '') { $('#standard_pta_select3').val('<?=$pta_st['pta_select3']?>').attr('selected', 'selected'); } // 시안개수
        if('<?=$pta_st['pta_select4']?>' != '') { $('#standard_pta_select4').val('<?=$pta_st['pta_select4']?>').attr('selected', 'selected'); } // 피사체개수

        // deluxe
        if('<?=$pta_de['pta_select1']?>' != '') { $('#deluxe_pta_select1').val('<?=$pta_de['pta_select1']?>').attr('selected', 'selected'); } // 작업기간
        if('<?=$pta_de['pta_select2']?>' != '') { $('#deluxe_pta_select2').val('<?=$pta_de['pta_select2']?>').attr('selected', 'selected'); } // 수정횟수
        if('<?=$pta_de['pta_select3']?>' != '') { $('#deluxe_pta_select3').val('<?=$pta_de['pta_select3']?>').attr('selected', 'selected'); } // 시안개수
        if('<?=$pta_de['pta_select4']?>' != '') { $('#deluxe_pta_select4').val('<?=$pta_de['pta_select4']?>').attr('selected', 'selected'); } // 피사체개수

        // premium
        if('<?=$pta_pr['pta_select1']?>' != '') { $('#premium_pta_select1').val('<?=$pta_pr['pta_select1']?>').attr('selected', 'selected'); } // 작업기간
        if('<?=$pta_pr['pta_select2']?>' != '') { $('#premium_pta_select2').val('<?=$pta_pr['pta_select2']?>').attr('selected', 'selected'); } // 수정횟수
        if('<?=$pta_pr['pta_select3']?>' != '') { $('#premium_pta_select3').val('<?=$pta_pr['pta_select3']?>').attr('selected', 'selected'); } // 시안개수
        if('<?=$pta_pr['pta_select4']?>' != '') { $('#premium_pta_select4').val('<?=$pta_pr['pta_select4']?>').attr('selected', 'selected'); } // 피사체개수
    });

    // 체크박스 검사
    $('.chech_yn').click(function() {
        if($("input:checkbox[name="+this.name+"]").is(":checked") == true) {
            this.value = 'Y';
        } else {
            this.value = '';
        }
    });

    // 패키지로 가격설정 on/off
    $('.onoffswitch-checkbox').click(function () {
        if($("input:checkbox[name=myonoffswitch_mobile]").is(":checked") == true) { // 패키지로 가격설정 시 DELUXE / PREMIUM 비활성화
            $('#pta_package').val('Y');
            $('.price_cate li').attr('style', 'pointer-events : inherit;');
        } else {
            $('#pta_package').val('N');
            $('.price_cate li').removeClass('active');
            $('.price_cate li').attr('style', 'pointer-events : none;');
            $('.standard').attr('style', 'pointer-events : inherit;');
            $('.standard').addClass('active');
        }
    });

    function removeComma(str) {
        n = parseInt(str.replace(/,/g,""));
        return n*1;
    }

    // textarea 글자 수 체크
    $('.doc_text').keyup(function (e) {
        var content = $("textarea#"+this.id).val();
        $('#'+this.id+'_count').text("" + content.length); // 글자 수 실시간 카운팅

        if(this.id.indexOf('title') != -1) { // 제목
            if (content.length > 50) {
                swal("최대 50자까지 입력 가능합니다.");
                var content_slice = content.slice(0, 50);
                $("textarea#"+this.id).val(content_slice);
                $('#'+this.id+'_count').text("50");
            }
        }
        if(this.id.indexOf('content') != -1) { // 설명
            if (content.length > 100) {
                swal("최대 100자까지 입력 가능합니다.");
                var content_slice = content.slice(0, 100);
                $("textarea#"+this.id).val(content_slice);
                $('#'+this.id+'_count').text("100");
            }
        }
    });

    function form_action(mode) {
        /*if (mode == 'save'){
            $("#frmpro").attr("action", g5_bbs_url+"/ajax.controller.php");
        }
        if (mode == 'next'){
            $("#frmpro").attr("action", g5_bbs_url+"/pro_step03.php");
        }*/

        if ($('#standard_pta_title').val().length > 50){
            swal("제목은 최대 50자까지 입력 가능합니다.");
            return false;
        }
        if ($('#standard_pta_content').val().length > 100){
            swal("상세설명은 최대 100자까지 입력 가능합니다.");
            return false;
        }

        if(removeComma($('#standard_pta_pay').val()) < 10000){
            swal("STANDARD 금액을 10000원이상 입력해주세요.");
            return false;
        }
        if(removeComma($('#deluxe_pta_pay').val()) < 10000){
            swal("DELUXE 금액을 10000원이상 입력해주세요.");
            return false;
        }
        if(removeComma($('#premium_pta_pay').val()) < 10000){
            swal("PREMIUM 금액을 10000원이상 입력해주세요.");
            return false;
        }


        var subject_arr = $("[id$='pta_title']");
        var content_arr = $("[id$='pta_content']");
        //금지어 필터링
        for (var i = 0; i < subject_arr.length;i++ ){
            var subject = subject_arr[i].value;
            var content = content_arr[i].value;

            $.ajax({
                url: g5_bbs_url+"/ajax.filter.php",
                type: "POST",
                data: {
                    "subject": subject,
                    "content": content,
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
                swal("제목에 금지단어('"+subject+"')가 포함되어있습니다");
                return false;
            }
            if (content) {
                swal("설명에 금지단어('"+content+"')가 포함되어있습니다");
                return false;
            }

        }



        $('#move_mode').val(mode);
        $("#frmpro").attr("action", g5_bbs_url+"/ajax.controller.php");

        submit_ok();
    }

    function submit_ok() {
        /*// STANDARD 유효성 체크
        if($.trim($('textarea#standard_pta_title').val()).length == 0 || $.trim($('textarea#standard_pta_content').val()).length == 0 || $.trim($('#standard_pta_pay').val()).length == 0 || $('#standard_pta_select1').val() == '' || $('#standard_pta_select2').val() == '') {
            swal('STANDARD 필수 입력 값을 확인해주세요.');
            return false;
        }

        // DELUXE / PREMIUM 유효성 체크
        if($("input:checkbox[name=myonoffswitch_mobile]").is(":checked") == true) {
            if($.trim($('textarea#deluxe_pta_title').val()).length == 0 || $.trim($('textarea#deluxe_pta_content').val()).length == 0 || $.trim($('#deluxe_pta_pay').val()).length == 0 || $('#deluxe_pta_select1').val() == '' || $('#deluxe_pta_select2').val() == '') {
                swal('DELUXE 필수 입력 값을 확인해주세요.');
                return false;
            }
            if($.trim($('textarea#premium_pta_title').val()).length == 0 || $.trim($('textarea#premium_pta_content').val()).length == 0 || $.trim($('#premium_pta_pay').val()).length == 0 || $('#premium_pta_select1').val() == '' || $('#premium_pta_select2').val() == '') {
                swal('PREMIUM 필수 입력 값을 확인해주세요.');
                return false;
            }
        }*/

        $("#frmpro").submit();
    }

    function move_category(page) {
        $('#page').val(page); // 탭 이동 시 (01-기본정보, 03-서비스상세)
        form_action('next');
        //location.href = '<?//=G5_BBS_URL?>///' + page;
    }

    //콤마찍기(type=number)로하면 comma안먹힘

    function add_comma(x) {
        var price = x.value;
        price = price.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        // price = price.replace(/,/g,''); // ,값 공백처리
        $('#'+x.id).val(number_format(price)); // 정규식을 이용해서 3자리 마다 , 추가
    }

</script>