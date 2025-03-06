<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>


<section id="bo_w" class="child-consult">
    <div class="child-consult__head">
        <h4>
            자녀 결혼을<br> 준비하고 계신 <br class="visible-xs visible-sm">부모님들!
        </h4>
        <p>
            마리엔에서는 자녀의 결혼을 준비 중이신 분들을 위해<br>
            자녀 결혼에 특화된 컨설팅 서비스를 제공합니다.
        </p>
        <ul class="box">
            <li>
                <p>문의전화</p>
                <strong>051-703-0250</strong>
            </li>
            <li><a href="#write_form">결혼상담 신청하기 &nbsp;<i class="fa-light fa-angle-right"></i></a></li>
        </ul>
    </div>
    <div class="child-consult__text">
        자녀의 결혼은 가족에게 중요한 이벤트 중 하나입니다.<br>
        결혼을 앞두고 계획을 세우고 파트너를 찾는 과정은 때로는 복잡하고 어려울 수 있습니다.<br>
        그러나 전문가의 도움을 받으면 이 모든 과정을 수월하게 진행이 가능합니다.
    </div>
    <div class="child-consult__diagram grid grid3">
        <dl>
            <dt>전문가 상담</dt>
            <dd>저희는 자녀의 결혼을 위한 전문가로서, 여러분의 상황을 듣고 최상의 솔루션을 제공해드립니다. 가족의 우려와 요구를 듣고, 그에 맞는 최적의 전략을 제시합니다.</dd>
        </dl>
        <dl>
            <dt>맞춤 매칭</dt>
            <dd>우리는 데이터 기반의 알고리즘을 활용하여 자녀의 성향과 가족의 선호도를 고려한 맞춤 매칭을 제공합니다. 이를 통해 자녀와 잘 어울리는 파트너를 찾을 수 있습니다.</dd>
        </dl>
        <dl>
            <dt>컨설팅 및 지원</dt>
            <dd>결혼 전문가로서, 우리는 결혼을 위한 준비와 과정에 대한 컨설팅 및 지원을 제공합니다. 어려운 문제나 의견 충돌이 발생할 경우, 전문가의 조언을 받아보세요.</dd>
        </dl>
    </div>


    <br>
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
    <input type="hidden" name="wr_subject" value="간편상담 신청 문의가 접수되었습니다.">
    <input type="hidden" name="wr_content" value="간편상담 문의가 접수되었습니다."> 
    <div class=""  id="write_form">
        <div class="child-consult__start">원하는 배우자를 꼭 찾아드립니다.</div>
        <div class="qna_wrap">
            <div class="form_wrap">
                <!--<div class="select s_service grid grid4">
                    <input type="radio" id="radio1" name="marital_status" checked><label for="radio1">초혼 서비스</label>
                    <input type="radio" id="radio2" name="marital_status"><label for="radio2">재혼 서비스</label>
                    <input type="radio" id="radio3" name="marital_status"><label for="radio3">전문직&엘리트 계층을 위한 서비스</label>
                    <input type="radio" id="radio4" name="marital_status"><label for="radio4">VIP 명문가를 위한 하이엔드 서비스</label>
                </div>-->

                <h3>부모님 정보를 입력해주세요.</h3>
                <div class="flex">
                    <input type="text" name="wr_name" id="wr_name" placeholder="부모님 성함">
                    <input type="text" name="wr_1" id="wr_1" placeholder="부모님 연락처 ('-'없이)">
                </div>
                
                <h3 style="margin:30px 0 10px">자녀 정보를 입력해주세요.</h3>
                <div class="flex">
                    <input type="text" name="wr_3" id="wr_3" placeholder="자녀 성함">
                    <div class="select grid grid2">
                        <input type="radio" name="wr_4" id="wr_4_1" value="남자"<?php echo $write[wr_4]=="남자"||$w==""?" checked":"";?>><label for="wr_4_1">남자</label>
                        <input type="radio" name="wr_4" id="wr_4_2" value="여자"<?php echo $write[wr_4]=="여자"?" checked":"";?>><label for="wr_4_2">여자</label>
                    </div>
                </div>
                <div class="flex">
                    <input type="text" name="wr_2" id="wr_2" placeholder="자녀 연락처">
                </div>
                <div class="flex" style="margin:10px 0 0">
                    <select name="wr_5" id="wr_5" style="width:50%">
                        <option value="">출생년도</option>
                             <?
                              //2010~현재년도까지
                              foreach(range(date('2004'), 1940) as $year) {
                                $tm_selected = ($ymd == $year) ? "selected" : "";
                                echo '<option value="'.$year.'"  '.$tm_selected.'  >'.$year.'</option>';
                              }  
                             ?>
                    </select>
                    <select name="wr_6" id="wr_6" style="width:50%">
                        <option value="">거주지역</option>
                        <option value="서울"<?php echo $write['wr_6']=="서울"?" selected":"";?>>서울</option>
                        <option value="경기"<?php echo $write['wr_6']=="경기"?" selected":"";?>>경기</option>
                        <!--<option value="경기(서부 - 김포,광명,시흥 등)"<?php echo $write['wr_6']=="경기(서부 - 김포,광명,시흥 등)"?" selected":"";?>>경기(서부 - 김포,광명,시흥 등)</option>
                        <option value="경기(남부 - 분당,과천,수원,용인 등)"<?php echo $write['wr_6']=="경기(남부 - 분당,과천,수원,용인 등)"?" selected":"";?>>경기(남부 - 분당,과천,수원,용인 등)</option>
                        <option value="경기(동부 - 구리,하남,남양주 등)"<?php echo $write['wr_6']=="경기(동부 - 구리,하남,남양주 등)"?" selected":"";?>>경기(동부 - 구리,하남,남양주 등)</option>-->
                        <option value="인천/부천"<?php echo $write['wr_6']=="인천/부천"?" selected":"";?>>인천/부천</option>
                        <option value="강원도"<?php echo $write['wr_6']=="강원도"?" selected":"";?>>강원도</option>
                        <option value="대전"<?php echo $write['wr_6']=="대전"?" selected":"";?>>대전</option>
                        <option value="세종"<?php echo $write['wr_6']=="세종"?" selected":"";?>>세종</option>
                        <option value="대구"<?php echo $write['wr_6']=="대구"?" selected":"";?>>대구</option>
                        <option value="광주"<?php echo $write['wr_6']=="광주"?" selected":"";?>>광주</option>
                        <option value="울산"<?php echo $write['wr_6']=="울산"?" selected":"";?>>울산</option>
                        <option value="부산"<?php echo $write['wr_6']=="부산"?" selected":"";?>>부산</option>
                        <option value="충북"<?php echo $write['wr_6']=="충북"?" selected":"";?>>충북</option>
                        <option value="충남"<?php echo $write['wr_6']=="충남"?" selected":"";?>>충남</option>
                        <option value="경북"<?php echo $write['wr_6']=="경북"?" selected":"";?>>경북</option>
                        <option value="경남"<?php echo $write['wr_6']=="경남"?" selected":"";?>>경남</option>
                        <option value="전북"<?php echo $write['wr_6']=="전북"?" selected":"";?>>전북</option>
                        <option value="전남"<?php echo $write['wr_6']=="전남"?" selected":"";?>>전남</option>
                        <option value="제주"<?php echo $write['wr_6']=="제주"?" selected":"";?>>제주</option>
                        <option value="해외"<?php echo $write['wr_6']=="해외"?" selected":"";?>>해외</option>
                        <option value="기타"<?php echo $write['wr_6']=="기타"?" selected":"";?>>기타</option>
                    </select>
                </div>
                <div class="flex">
                    <select name="wr_7" id="wr_7" style="width:50%">
                            <option value="">자녀의 직업은</option>
                            <option value="사무/금융직"<?php echo $write['wr_7']=="사무/금융직"?" selected":"";?>>사무/금융직</option>
                            <option value="연구원/엔지니어"<?php echo $write['wr_7']=="연구원/엔지니어"?" selected":"";?>>연구원/엔지니어</option>
                            <option value="건축/설계"<?php echo $write['wr_7']=="건축/설계"?" selected":"";?>>건축/설계</option>
                            <option value="교사 및 강사"<?php echo $write['wr_7']=="교사 및 강사"?" selected":"";?>>교사 및 강사</option>
                            <option value="공무원/공사"<?php echo $write['wr_7']=="공무원/공사"?" selected":"";?>>공무원/공사</option>
                            <option value="승무원/항공관련"<?php echo $write['wr_7']=="승무원/항공관련"?" selected":"";?>>승무원/항공관련</option>
                            <option value="서비스/영업"<?php echo $write['wr_7']=="서비스/영업"?" selected":"";?>>서비스/영업</option>
                            <option value="의사/한의사/약사"<?php echo $write['wr_7']=="의사/한의사/약사"?" selected":"";?>>의사/한의사/약사</option>
                            <option value="변호사/법조인"<?php echo $write['wr_7']=="변호사/법조인"?" selected":"";?>>변호사/법조인</option>
                            <option value="회계사 등 전문직"<?php echo $write['wr_7']=="회계사 등 전문직"?" selected":"";?>>회계사 등 전문직</option>
                            <option value="간호 및 의료사"<?php echo $write['wr_7']=="간호 및 의료사"?" selected":"";?>>간호 및 의료사</option>
                            <option value="자영업/사업"<?php echo $write['wr_7']=="자영업/사업"?" selected":"";?>>자영업/사업</option>
                            <option value="유학생/석,박사"<?php echo $write['wr_7']=="유학생/석,박사"?" selected":"";?>>유학생/석,박사</option>
                            <option value="프리랜서 및 기타"<?php echo $write['wr_7']=="기타"?" selected":"";?>>프리랜서 및 기타</option>
                     </select>
                     <select name="wr_8" id="wr_8" style="width:50%" >
                        <option value="">최종학력</option>
                        <option value="대학교 졸업"<?php echo $write['wr_8']=="대학교 졸업"?" selected":"";?>>대학교 졸업</option>
                        <option value="대학교 중퇴"<?php echo $write['wr_8']=="대학교 중퇴"?" selected":"";?>>대학교 중퇴</option>
                        <option value="대학교 재학"<?php echo $write['wr_8']=="대학교 재학"?" selected":"";?>>대학교 재학</option>
                        <option value="대학원 졸업"<?php echo $write['wr_8']=="대학교 졸업"?" selected":"";?>>대학원 졸업</option>
                        <option value="대학(2,3년제) 졸업"<?php echo $write['wr_8']=="대학(2,3년제) 졸업"?" selected":"";?>>대학(2,3년제) 졸업</option>
                        <option value="대학(2,3년제) 중퇴"<?php echo $write['wr_8']=="대학(2,3년제) 중퇴"?" selected":"";?>>대학(2,3년제) 중퇴</option>
                        <option value="고등학교 졸업"<?php echo $write['wr_8']=="고등학교 졸업"?" selected":"";?>>고등학교 졸업</option>
                        <option value="기타"<?php echo $write['wr_8']=="기타"?" selected":"";?>>기타</option>
                     </select>
                </div>
                <ul class="agree">
                    <li>
                        <input type="checkbox" id="agree1" name="agree_all">
                        <label for="agree1">개인정보 수집 및 이용, 마케팅 활용에 모두 동의</label>
                    </li>
                    <li class="grid grid2">
                        <p>
                            <input type="checkbox" id="agree2" name="agree_collect">
                            <label for="agree2">개인정보 수집 및 이용 동의 (필수)</label>
                        </p>
                        <a class="btn" onclick="toggleDetails('detail2')">[자세히보기]</a>
                        <div id="detail2" class="detail" style="display: none;">
                            <div class="title">
                                <h4>개인정보 수집 및 이용동의</h4>
                                <a onclick="toggleDetails('detail2')">[닫기]</a>
                            </div>
                            <div class="conts"><?php echo get_text($config['cf_privacy']) ?></div>
                        </div>
                    </li>
                    <li class="grid grid2">
                        <p>
                            <input type="checkbox" id="agree3" name="agree_marketing">
                            <label for="agree3">마케팅 활용에 동의 (선택) <span>- 서비스안내 수신동의 내용 포함</span></label>
                        </p>
                        <a class="btn" onclick="toggleDetails('detail3')">[자세히보기]</a>
                        <div id="detail3" class="detail" style="display: none;">
                            <div class="title">
                                <h4>마케팅 활용 동의</h4>
                                <a onclick="toggleDetails('detail3')">[닫기]</a>
                            </div>
                            <div class="conts"><? include_once(G5_BBS_PATH.'/agree_detail02.php'); ?></div>
                        </div>
                    </li>
                </ul>

				<script>
                    //약관보기
                    function toggleDetails(id) {
                        var detail = document.getElementById(id);
                        if (detail.style.display === "none") {
                            detail.style.display = "block";
                        } else {
                            detail.style.display = "none";
                        }
                    }

                    function toggleDetails(id) {
                        var detail = document.getElementById(id);
                        if (detail.style.display === "none") {
                            detail.style.display = "block";
                        } else {
                            detail.style.display = "none";
                        }
                    }
                    //자동하이픈 넣기
                    $(document).on("keyup", "#wr_1", function() {
                        $(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})/,"$1-$2-$3").replace("--", "-") );
                    });
                    //자동하이픈 넣기
                    $(document).on("keyup", "#wr_2", function() {
                        $(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})/,"$1-$2-$3").replace("--", "-") );
                    });
                                                            //모두동의
                    function toggleAllAgreements() {
                        var agreeAllCheckbox = document.getElementById('agree1');
                        var agreeCollectCheckbox = document.getElementById('agree2');
                        var agreeMarketingCheckbox = document.getElementById('agree3');

                        // Check if agreeAllCheckbox is checked
                        if (agreeAllCheckbox.checked) {
                            agreeCollectCheckbox.checked = true;
                            agreeMarketingCheckbox.checked = true;
                        } else {
                            agreeCollectCheckbox.checked = false;
                            agreeMarketingCheckbox.checked = false;
                        }
                    }

                    // 추가: 모두 동의 체크박스 클릭 시 하위 체크박스 상태 변경
                    document.getElementById('agree1').addEventListener('click', function() {
                        toggleAllAgreements();
                    });
                </script>
            </div>

        </div>

    </div>

    <div class="btn_confirm">
        <input type="submit" value="문의신청" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
       <? /*  if($is_admin){?>
        <a href="<?=G5_BBS_URL ?>/board.php?bo_table=<?=$bo_table?>" class="btn_cancel">목록보기</a>
       <? } */?>
        
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
        <?php //echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
		/*
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
        }*/
		/*
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
        }*/
		if( fwrite.wr_name.value == "" ) {
			fwrite.wr_name.focus();
			alert("부모님 성함을 입력해 주세요.");
			return false;	
		}
        if(checkHan(fwrite.wr_name.value) == false){
            fwrite.wr_name.focus();
            alert("이름은 한글로만 입력해 주세요.");
            return false;
        }

		if( fwrite.wr_1.value == "" ) {
			fwrite.wr_1.focus();
			alert("부모님 연락처를 입력해 주세요.");
			return false;	
		}
		if( fwrite.wr_3.value == "" ) {
			fwrite.wr_3.focus();
			alert("자녀 성함을 입력해 주세요.");
			return false;	
		}
		if( fwrite.wr_2.value == "" ) {
			fwrite.wr_2.focus();
			alert("자녀 연락처를 입력해 주세요.");
			return false;	
		}
		if( fwrite.wr_5.value == "" ) {
			fwrite.wr_5.focus();
			alert("출생년도를 선택해 주세요.");
			return false;	
		}
		if( fwrite.wr_5.value == "" ) {
			fwrite.wr_5.focus();
			alert("출생년도를 선택해 주세요.");
			return false;	
		}
		if( fwrite.wr_6.value == "" ) {
			fwrite.wr_6.focus();
			alert("거주지역을 선택해 주세요.");
			return false;	
		}
		if( fwrite.wr_7.value == "" ) {
			fwrite.wr_7.focus();
			alert("자녀의 직업을 선택해 주세요.");
			return false;	
		}
		if( fwrite.wr_8.value == "" ) {
			fwrite.wr_8.focus();
			alert("최종학력을 선택해 주세요.");
			return false;	
		}
		if (!f.agree2.checked) {
			alert("개인정보 수집 및 이용에 동의하셔야 서비스를 받을 수 있습니다.");
			f.agree2.focus();
			return false;
		}
		if (!f.agree3.checked) {
			alert("마케팅 활용에 동의하셔야 서비스를 받을 수 있습니다.");
			f.agree3.focus();
			return false;
		}

        <?php //echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->