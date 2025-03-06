<?
include_once("./_common.php");

$g5['title'] = '가입비 알아보기';
include_once('./_head.php');
?>
<style>
    #hd_wrapper{background:#806E6F85}
    #svisual{display: none;}
    #container{width: 100%; margin: 0;}
    #sub_title{display: none;}
    #scont_wrap2{padding: 0;}
    @media screen and (max-width: 768px) {
        #scont{padding: 0;}
        #hd_wrapper{background:transparent}

    }
	.cost_wrap .form_wrap .select input[type=radio]+label{ font-size:1em !important}
</style>

    <!--이상형찾기-->
    <div class="wrap_bg cost">
        <div class="cost_wrap">

            <div class="box_white">
                <div class="titleArea">
                    <!--<p>가입비 산출을 위한 당신의 정보를 입력해주세요.</p>-->
                    <h1>가입비 알아보기</h1>
                    <span>가입비 산출을 위한 당신의 정보를 입력해주세요.</span>
                </div>

                <form name="frmfee" action="<?=G5_BBS_URL?>/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
                    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                    <input type="hidden" name="bo_table" value="fee">
                    <input type="hidden" name="wr_subject" value="가입비 알아보기 신청이 접수되었습니다.">
                    <input type="hidden" name="wr_content" value="가입비 알아보기 신청이 접수되었습니다."> 
                    <div class="form">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#step-1">1</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-2">2</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-3">3</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-4">4</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-5">5</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-6">6</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <h2>당신의 성별은?</h2>
                                    <div class="form_wrap">
                                        <div class="select grid">
                                            <input type="radio" name="wr_1" id="wr_1_1" value="남자"<?php echo $write[wr_1]=="남자"||$w==""?" checked":"";?>><label for="wr_1_1">남자</label>
                                            <input type="radio" name="wr_1" id="wr_1_2" value="여자"<?php echo $write[wr_1]=="여자"?" checked":"";?>><label for="wr_1_2">여자</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <h2>당신의 거주지역은?</h2>
                                    <div class="form_wrap">
                                        <div>
                                            <!--<select name="wr_2" id="wr_2" required>
                                                <option>출생년도</option>
												 <?
                                                 //2010~현재년도까지
                                                  //foreach(range(date('Y'), 1940) as $year) {
                                                    //$tm_selected = ($ymd == $year) ? "selected" : "";
                                                    //echo '<option value="'.$year.'"  '.$tm_selected.'  >'.$year.'</option>';
                                                  //}  
                                                 ?>
                                            </select>-->
                                            <select name="wr_3" id="wr_3" required >
                                                <option>거주지역</option>
                                                <option value="서울"<?php echo $write['wr_3']=="서울"?" selected":"";?>>서울</option>
                                                <option value="경기"<?php echo $write['wr_3']=="경기"?" selected":"";?>>경기</option>
                                                <!--<option value="경기(북부 - 고양,파주,의정부 등)"<?php echo $write['wr_3']=="경기(북부 - 고양,파주,의정부 등)"?" selected":"";?>>경기(북부 - 고양,파주,의정부 등)</option>
                                                <option value="경기(서부 - 김포,광명,시흥 등)"<?php echo $write['wr_3']=="경기(서부 - 김포,광명,시흥 등)"?" selected":"";?>>경기(서부 - 김포,광명,시흥 등)</option>
                                                <option value="경기(남부 - 분당,과천,수원,용인 등)"<?php echo $write['wr_3']=="경기(남부 - 분당,과천,수원,용인 등)"?" selected":"";?>>경기(남부 - 분당,과천,수원,용인 등)</option>
                                                <option value="경기(동부 - 구리,하남,남양주 등)"<?php echo $write['wr_3']=="경기(동부 - 구리,하남,남양주 등)"?" selected":"";?>>경기(동부 - 구리,하남,남양주 등)</option>-->
                                                <option value="인천/부천"<?php echo $write['wr_3']=="인천/부천"?" selected":"";?>>인천/부천</option>
                                                <option value="강원도"<?php echo $write['wr_3']=="강원도"?" selected":"";?>>강원도</option>
                                                <option value="대전"<?php echo $write['wr_3']=="대전"?" selected":"";?>>대전</option>
                                                <option value="세종"<?php echo $write['wr_3']=="세종"?" selected":"";?>>세종</option>
                                                <option value="대구"<?php echo $write['wr_3']=="대구"?" selected":"";?>>대구</option>
                                                <option value="광주"<?php echo $write['wr_3']=="광주"?" selected":"";?>>광주</option>
                                                <option value="울산"<?php echo $write['wr_3']=="울산"?" selected":"";?>>울산</option>
                                                <option value="부산"<?php echo $write['wr_3']=="부산"?" selected":"";?>>부산</option>
                                                <option value="충북"<?php echo $write['wr_3']=="충북"?" selected":"";?>>충북</option>
                                                <option value="충남"<?php echo $write['wr_3']=="충남"?" selected":"";?>>충남</option>
                                                <option value="경북"<?php echo $write['wr_3']=="경북"?" selected":"";?>>경북</option>
                                                <option value="경남"<?php echo $write['wr_3']=="경남"?" selected":"";?>>경남</option>
                                                <option value="전북"<?php echo $write['wr_3']=="전북"?" selected":"";?>>전북</option>
                                                <option value="전남"<?php echo $write['wr_3']=="전남"?" selected":"";?>>전남</option>
                                                <option value="제주"<?php echo $write['wr_3']=="제주"?" selected":"";?>>제주</option>
                                                <option value="해외"<?php echo $write['wr_3']=="해외"?" selected":"";?>>해외</option>
                                                <option value="기타"<?php echo $write['wr_3']=="기타"?" selected":"";?>>기타</option>
                                            </select>
                                        </div>                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <h2>당신의 학력은?</h2>
                                    <div class="form_wrap">
                                        <div class="select grid grid2">
                                            <input type="radio" name="wr_9" id="wr_9_1"  value="고졸"<?php echo $write[wr_9]=="고졸"||$w==""?" checked":"";?>><label for="wr_9_1">고졸</label>
                                            <input type="radio" name="wr_9" id="wr_9_2"  value="전문대졸"<?php echo $write[wr_9]=="전문대졸"?" checked":"";?>><label for="wr_9_2">전문대졸</label>
                                            <input type="radio" name="wr_9" id="wr_9_3"  value="대학교졸"<?php echo $write[wr_9]=="대학교졸"?" checked":"";?>><label for="wr_9_3">대학교졸</label>
                                            <input type="radio" name="wr_9" id="wr_9_4"  value="대학원 이상"<?php echo $write[wr_9]=="대학원 이상"?" checked":"";?>><label for="wr_9_4">대학원 이상</label>
                                            <input type="radio" name="wr_9" id="wr_9_5"  value="기타"<?php echo $write[wr_9]=="기타"?" checked":"";?>><label for="wr_9_5">기타</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    <h2>당신의 직업은?</h2>
                                    <div class="form_wrap">
                                        <div class="select grid grid2">
                                        <input type="radio" name="wr_4" id="wr_4_1" value="사무/금융직"<?php echo $write[wr_4]=="사무/금융직"?" checked":"checked";?>><label for="wr_4_1">사무/금융직</label>
                                        <input type="radio" name="wr_4" id="wr_4_2" value="연구원, 엔지니어"<?php echo $write[wr_4]=="연구원, 엔지니어"?" checked":"";?>><label for="wr_4_2">연구원, 엔지니어</label>
                                        <input type="radio" name="wr_4" id="wr_4_3" value="건축, 설계"<?php echo $write[wr_4]=="건축, 설계"?" checked":"";?>><label for="wr_4_3">건축, 설계</label>
                                        <input type="radio" name="wr_4" id="wr_4_4" value="교사 및 강사"<?php echo $write[wr_4]=="교사 및 강사"?" checked":"";?>><label for="wr_4_4">교사 및 강사</label>
                                        <input type="radio" name="wr_4" id="wr_4_5" alue="공무원, 공사"<?php echo $write[wr_4]=="공무원, 공사"?" checked":"";?>><label for="wr_4_5">공무원, 공사</label>
                                        <input type="radio" name="wr_4" id="wr_4_6" alue="승무원/항공관련"<?php echo $write[wr_4]=="승무원/항공관련"?" checked":"";?>><label for="wr_4_6">승무원/항공관련</label>
                                        <input type="radio" name="wr_4" id="wr_4_7" alue="서비스/영업"<?php echo $write[wr_4]=="서비스/영업"?" checked":"";?>><label for="wr_4_7">서비스/영업</label>
                                        <input type="radio" name="wr_4" id="wr_4_8" alue="의사, 한의사, 약사"<?php echo $write[wr_4]=="의사, 한의사, 약사"?" checked":"";?>><label for="wr_4_8">의사, 한의사, 약사</label>
                                        <input type="radio" name="wr_4" id="wr_4_9" value="변호사, 법조인"<?php echo $write[wr_4]=="사무/금융직"?" checked":"";?>><label for="wr_4_9">변호사, 법조인</label>
                                        <input type="radio" name="wr_4" id="wr_4_10" value="회계사 등 전문직"<?php echo $write[wr_4]=="회계사 등 전문직"?" checked":"";?>><label for="wr_4_10">회계사 등 전문직</label>
                                        <input type="radio" name="wr_4" id="wr_4_11" value="간호 및 의료사"<?php echo $write[wr_4]=="간호 및 의료사"?" checked":"";?>><label for="wr_4_11">간호 및 의료사</label>
                                        <input type="radio" name="wr_4" id="wr_4_12" value="자영업, 사업"<?php echo $write[wr_4]=="자영업, 사업"?" checked":"";?>><label for="wr_4_12">자영업, 사업</label>
                                        <input type="radio" name="wr_4" id="wr_4_13" value="유학생, 석/박사"<?php echo $write[wr_4]=="유학생, 석/박사"?" checked":"";?>><label for="wr_4_13">유학생, 석/박사</label>
                                        <input type="radio" name="wr_4" id="wr_4_14" value="프리랜서 및 기타"<?php echo $write[wr_4]=="프리랜서 및 기타"?" checked":"";?>><label for="wr_4_14">프리랜서 및 기타</label>

                                        </div>
                                    </div>
                                </div>
                                <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                                    <h2>당신의 연봉은?</h2>
                                    <div class="form_wrap">
                                        <div class="select grid grid2">
                                        <input type="radio" name="wr_19" id="wr_19_1" value="3천만원 미만"<?php echo $write[wr_19]=="3천만원 미만"||$w==""?" checked":"";?>><label for="wr_19_1">3천만원 미만</label>
                                        <input type="radio" name="wr_19" id="wr_19_2" value="3~4천 만원"<?php echo $write[wr_19]=="3~4천 만원"?" checked":"";?>><label for="wr_19_2">3~4천 만원</label>
                                        <input type="radio" name="wr_19" id="wr_19_3"  value="4~6천 만원"<?php echo $write[wr_19]=="4~6천 만원"?" checked":"";?>><label for="wr_19_3">4~6천 만원</label>
                                        <input type="radio" name="wr_19" id="wr_19_4" value="6~8천 만원"<?php echo $write[wr_19]=="6~8천 만원"?" checked":"";?>><label for="wr_19_4">6~8천 만원</label>
                                        <input type="radio" name="wr_19" id="wr_19_5"  value="8천~1억"<?php echo $write[wr_19]=="8천~1억"?" checked":"";?>><label for="wr_19_5">8천~1억</label>
                                        <input type="radio" name="wr_19" id="wr_19_6" value="1억~1억5천"<?php echo $write[wr_19]=="1억~1억5천"?" checked":"";?>><label for="wr_19_6">1억~1억5천</label>
                                        <input type="radio" name="wr_19" id="wr_19_7" value="1억5천~2억"<?php echo $write[wr_19]=="1억5천~2억"?" checked":"";?>><label for="wr_19_7">1억5천~2억</label>
                                        <input type="radio" name="wr_19" id="wr_19_8" value="2억 이상"<?php echo $write[wr_19]=="2억 이상"?" checked":"";?>><label for="wr_19_8">2억 이상</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
                                    <div class="text-center">카카오 알림톡으로 익일 발송해 드립니다</div>
                                    <h2>나의 가입비를 바로 확인해 보세요.</h2>
                                    <br>
                                    <div class="form_wrap profile">
                                        <div class="flex">
                                            <input type="text" name="wr_name" placeholder="이름">
                                        </div>
                                        <div class="flex">
                                            <input type="text" name="wr_7" id="mtel" placeholder="휴대폰번호">
                                        </div>
                                        <div class="flex">
                                            <div class="select grid grid2">
                                                <input type="radio" name="wr_10" id="wr_10_1" value="음력"<?php echo $write[wr_10]=="음력"||$w==""?" checked":"";?>><label for="wr_10_1">음력</label>
                                                <input type="radio" name="wr_10" id="wr_10_2" value="양력"<?php echo $write[wr_10]=="양력"?" checked":"";?>><label for="wr_10_2">양력</label>
                                            </div>
                                            <input type="text" name="wr_11" value="<?php echo $write['wr_11'] ?>" id="wr_11" placeholder="생년월일 입력  - 예시) 19840101 형태로">
                                            <!--<input type="text" name="wr_12" value="<?php echo $write['wr_12'] ?>" id="wr_12" placeholder="출생 월">
                                            <input type="text" name="wr_13" value="<?php echo $write['wr_13'] ?>" id="wr_13" placeholder="출생 일">-->
                                        </div>
                                        <input type="text" name="wr_15" value="<?php echo $write['wr_15'] ?>" id="wr_15" placeholder="키 입력 - (cm)">
                                        <input type="text" name="wr_16" value="<?php echo $write['wr_16'] ?>" id="wr_16" placeholder="종교 입력 -  ex) 기독교, 불교 무교 등">
                                        <input type="text" name="wr_17" value="<?php echo $write['wr_17'] ?>" id="wr_17" placeholder="형제관계 입력 -  ex) 2남 1녀 중 막내">
                                        <textarea name="wr_18" id="wr_18" placeholder="희망상대 직접 입력 - 자유롭게 적어주세요"></textarea>
                                        <div class="select grid grid4" style="margin:40px 0 20px">        
                                            <input type="radio" name="wr_8" id="wr_8_1" value="초혼"<?php echo $write[wr_8]=="초혼"||$w==""?" checked":"";?>><label for="wr_8_1">초혼</label>
                                            <input type="radio" name="wr_8" id="wr_8_2" value="재혼"<?php echo $write[wr_8]=="재혼"?" checked":"";?>><label for="wr_8_2">재혼</label>
                                            <input type="radio" name="wr_8" id="wr_8_3" value="썸혼"<?php echo $write[wr_8]=="썸혼"?" checked":"";?>><label for="wr_8_3" class="block" tooltip="자녀없이 이혼한  돌싱">썸혼</label>
                                            <input type="radio" name="wr_8" id="wr_8_4" value="황혼"<?php echo $write[wr_8]=="황혼"?" checked":"";?>><label for="wr_8_4" class="block" tooltip="60세이후 혼자">황혼</label>
                                        </div>

                                        <ul class="agree">
                                            <li>
                                                <input type="checkbox" id="agree1" name="agree_all">
                                                <label for="agree1">개인정보 수집 및 이용, 마케팅 활용에 모두 동의</label>
                                            </li>
                                            <li class="flex ai-c jc-s">
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
                                            <li class="flex ai-c jc-s">
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
											$(document).on("keyup", "#mtel", function() {
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

                            <!-- Include optional progressbar HTML -->
                            <div class="step-total">
                                <strong class="txt_purple">STEP</strong> <span id="sw-current-step" class="txt_purple"></span> / <span id="sw-total-step"></span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- jQuery와 Smart Wizard 라이브러리 추가 -->

                        <script>
                            function onCancel(){ $('#smartwizard').smartWizard("reset"); }

                            $(function() {
                                // Step show event
                                $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                                    if(stepPosition === 'first') {
                                        $("#prev-btn").addClass('disabled').prop('disabled', true);
                                    } else if(stepPosition === 'last') {
                                        $("#next-btn").addClass('disabled').prop('disabled', true);
                                    } else {
                                        $("#prev-btn").removeClass('disabled').prop('disabled', false);
                                        $("#next-btn").removeClass('disabled').prop('disabled', false);
                                    }

                                    // Get step info from Smart Wizard
                                    let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                                    $("#sw-current-step").text(stepInfo.currentStep + 1);
                                    $("#sw-total-step").text(stepInfo.totalSteps);
                                });

                                $("#smartwizard").on("initialized", function(e) {
                                    console.log("initialized");
                                });

                                $("#smartwizard").on("loaded", function(e) {
                                    console.log("loaded");
                                });

                                // Smart Wizard
                                $('#smartwizard').smartWizard({
                                    selected: 0,
                                    // autoAdjustHeight: false,
                                    theme: 'basic', // basic, arrows, square, round, dots
                                    transition: {
                                        animation:'fade' // none|fade|slideHorizontal|slideVertical|slideSwing|css
                                    },
                                    toolbar: {
                                        showNextButton: true, // show/hide a Next button
                                        showPreviousButton: true, // show/hide a Previous button
                                        position: 'bottom', // none/ top/ both bottom
                                        extraHtml: `<button class="btn btn-success" onclick="onFinish()">작성완료</button>`
                                    },
                                    anchor: {
                                        enableNavigation: true, // Enable/Disable anchor navigation
                                        enableNavigationAlways: false, // Activates all anchors clickable always
                                        enableDoneState: true, // Add done state on visited steps
                                        markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                        unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
                                        enableDoneStateNavigation: true // Enable/Disable the done state navigation
                                    },
                                    lang: { // Language variables for button
                                        next: '다음',
                                        previous: ''
                                    },
                                    disabledSteps: [], // Array Steps disabled
                                    errorSteps: [], // Highlight step with errors
                                    hiddenSteps: [], // Hidden steps
                                    // getContent: (idx, stepDirection, selStep, callback) => {
                                    //   console.log('getContent',selStep, idx, stepDirection);
                                    //   callback('<h1>'+idx+'</h1>');
                                    // }
                                });

                            });
                        </script>

                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        function index_write_submit(f){
			if( frmfee.wr_3.value == "" ) {
				frmfee.wr_3.focus();
				alert("거주지역을 선택해 주세요.");
				return false;	
			}
			if( frmfee.wr_name.value == "" ) {
				frmfee.wr_name.focus();
				alert("이름을 입력해 주세요.");
				return false;	
			}
            if(checkHan(frmfee.wr_name.value) == false){
                frmfee.wr_name.focus();
                alert("이름은 한글로만 입력해 주세요.");
                return false;
            }
			if( frmfee.wr_7.value == "" ) {
				frmfee.wr_7.focus();
				alert("휴대폰번호를 입력해 주세요.");
				return false;	
			}
			if( frmfee.wr_11.value == "" ) {
				frmfee.wr_11.focus();
				alert("생년월일을 입력해 주세요.");
				return false;	
			}
			if( frmfee.wr_15.value == "" ) {
				frmfee.wr_15.focus();
				alert("키를 입력해 주세요.");
				return false;	
			}
			if( frmfee.wr_16.value == "" ) {
				frmfee.wr_16.focus();
				alert("종교를 입력해 주세요.");
				return false;	
			}
			if( frmfee.wr_17.value == "" ) {
				frmfee.wr_17.focus();
				alert("형제관계를 입력해 주세요.");
				return false;	
			}
			if( frmfee.wr_18.value == "" ) {
				frmfee.wr_18.focus();
				alert("희망상대에 대한 내용을 입력해 주세요.");
				return false;	
			}
			if( frmfee.agree2.value == "" ) {
				frmfee.agree2.focus();
				alert("개인정보 수집 및 이용에 동의하셔야 서비스를 받을 수 있습니다.");
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
            return true;
        }
    </script>



<?
include_once('./tail.php');
?>