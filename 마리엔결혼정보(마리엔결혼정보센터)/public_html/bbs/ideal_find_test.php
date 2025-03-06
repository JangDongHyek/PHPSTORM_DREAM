<?
include_once("./_common.php");

$g5['title'] = '내 결혼상대 찾기';
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

</style>

    <!--이상형찾기-->
    <div class="wrap_bg ideal">
        <div class="ideal_wrap">

            <div class="box_white">
                <div class="titleArea">
                    <p>나와 관심사가 맞는 회원은?</p>
                    <h1>내 결혼상대 찾기</h1>
                    <span>희망하는 연령, 학력, 직업 등을 기반으로<br>
                    2명의 이상적 결혼 상대 프로필을 보내 드립니다.</span>
                </div>

                <form name="frmtest"  action="<?=G5_BBS_URL?>/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
                    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                    <input type="hidden" name="bo_table" value="lovetest">
                    <input type="hidden" name="wr_subject" value="러브테스트 신청이 접수되었습니다.">
                    <div class="form">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#step-1">1</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-2">2</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-3">3</a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-4">4</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <h2>결혼 가치관 선택</h2>
                                    <h3>Q1. 내가 생각하는 결혼 필수 조건은?</h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4">
                                            <input type="radio" id="wr_1_1" name="wr_1" value="인성"<?php echo $write[wr_1]=="인성"||$w==""?" checked":"";?>><label for="wr_1_1">인성</label>
                                            <input type="radio" id="wr_1_2" name="wr_1" value="성격"<?php echo $write[wr_1]=="성격"?" checked":"";?>><label for="wr_1_2">성격</label>
                                            <input type="radio" id="wr_1_3" name="wr_1" value="능력"<?php echo $write[wr_1]=="능력"?" checked":"";?>><label for="wr_1_3">능력</label>
                                            <input type="radio" id="wr_1_4" name="wr_1" value="외모"<?php echo $write[wr_1]=="외모"?" checked":"";?>><label for="wr_1_4">외모</label>
                                        </div>
                                    </div>
                                    <h3>Q2. 결혼 전 연인과 합의하고 싶은 것은?</h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4">
                                            <input type="radio" id="wr_2_1" name="wr_2" value="가사 분담"<?php echo $write[wr_2]=="가사 분담"||$w==""?" checked":"";?>><label for="wr_2_1">가사 분담</label>
                                            <input type="radio" id="wr_2_2" name="wr_2" value="가정 수칙"<?php echo $write[wr_2]=="가정 수칙"?" checked":"";?>><label for="wr_2_2">가정 수칙</label>
                                            <input type="radio" id="wr_2_3" name="wr_2" value="재산 관리"<?php echo $write[wr_2]=="재산 관리"?" checked":"";?>><label for="wr_2_3">재산 관리</label>
                                            <input type="radio" id="wr_2_4" name="wr_2" value="자녀 양육"<?php echo $write[wr_2]=="자녀 양육"?" checked":"";?>><label for="wr_2_4">자녀 양육</label>
                                        </div>
                                    </div>
                                    <h3>Q3. 결혼 상대로 선호하는 성격은?</h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4">
                                            <input type="radio" id="wr_3_1" name="wr_3" value="스마트하고 똑똑한"<?php echo $write[wr_3]=="스마트하고 똑똑한"||$w==""?" checked":"";?>><label for="wr_3_1">스마트하고 똑똑한</label>
                                            <input type="radio" id="wr_3_2" name="wr_3" value="밝고 활기찬"<?php echo $write[wr_3]=="밝고 활기찬"?" checked":"";?>><label for="wr_3_2">밝고 활기찬</label>
                                            <input type="radio" id="wr_3_3" name="wr_3" value="착하고 부드러운"<?php echo $write[wr_3]=="착하고 부드러운"?" checked":"";?>><label for="wr_3_3">착하고 부드러운</label>
                                            <input type="radio" id="wr_3_4" name="wr_3" value="생각이 깊고 신중한"<?php echo $write[wr_3]=="생각이 깊고 신중한"?" checked":"";?>><label for="wr_3_4">생각이 깊고 신중한</label>
                                            
                                        </div>
                                    </div>

                                    <br>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <h2>관심사 선택</h2>
                                    <h3>Q1. 내가 요즘 관심 있는 분야는? <span>(복수선택 가능)</span></h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid3">
                                            <input type="hidden" name="wr_4" value="<?=$write[wr_4]?>"/>
                                            <?php
                                            $subList03 = [
                                                '배드민턴', '수영/수상스포츠', '스키/스노보드', '자전거/바이크','3골프',
												'집안꾸미기', '요리(베이킹)', '애완동물 키우기', '식물 키우기',
												'사진촬영', '수집하기', '그림그리기', '공예/뜨개질/프라모델 등',
												'여행/드라이브', '등산/산책', '영화/음악감상', '악기연주',
												'연극/뮤지컬/콘서트', 'SNS하기', '기타',
                                            ];
                                            foreach ($subList03 as $key => $val):
                                                $id = "wr_4_{$key}";
                                                $checked = (strpos($write[wr_4], $val) !== false || (empty($write[wr_4]) && $key == 0))? "checked" : '';
                                            ?>
                                            <input type="checkbox" name="wr4[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> />
                                            <label for="<?=$id?>"><?=$val?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <h2>희망상대 선택</h2>
                                    <h3>Q1. 결혼상대의 연령은? <span>(복수선택 가능)</span></h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4">
                                            <input type="hidden" name="wr_5" value="<?=$write[wr_5]?>"/>
                                            <?php
                                            $subList02 = [
                                                '24세 이하', '25~29세','30~34세', '35~40세', '40~44세', '45~49세', '50~55세', '56세 이상',
                                            ];
                                            foreach ($subList02 as $key => $val):
                                                $id = "wr_5_{$key}";
                                                $checked = (strpos($write[wr_5], $val) !== false || (empty($write[wr_5]) && $key == 0))? "checked" : '';
                                            ?>
                                            <input type="checkbox" name="wr5[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> />
                                            <label for="<?=$id?>"><?=$val?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <h3>Q2. 결혼상대의 학력은? <span>(복수선택 가능)</span></h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4">                 
                                            <input type="hidden" name="wr_6" value="<?=$write[wr_6]?>"/>
                                            <?php
                                            $subList = [
                                                '고졸', '전문대졸', '대학교졸', '교사 및 강사','대학원 이상',
                                            ];
                                            foreach ($subList as $key => $val):
                                                $id = "wr_6_{$key}";
                                                $checked = (strpos($write[wr_6], $val) !== false || (empty($write[wr_6]) && $key == 0))? "checked" : '';
                                            ?>
                                            <input type="checkbox" name="wr6[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> />
                                            <label for="<?=$id?>"><?=$val?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <h3>Q3. 결혼상대의 직업은? <span>(복수선택 가능)</span></h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4 job_list">
                                            <input type="hidden" name="wr_7" value="<?=$write[wr_7]?>"/>
                                            <?php
                                            $jobList = [
                                                '사무/금융직', '연구원/엔지니어', '건축/설계', '교사 및 강사', '공무원/공사',
                                                '승무원/항공관련', '서비스/영업', '의사/한의사/약사', '변호사/법조인', '회계사 등 전문직',
                                                '간호 및 의료사', '자영업/사업', '유학생/석,박사', '프리랜서 및 기타',
                                            ];
                                            foreach ($jobList as $key => $val):
                                                $id = "wr_7_{$key}";
                                                $checked = (strpos($write[wr_7], $val) !== false || (empty($write[wr_7]) && $key == 0))? "checked" : '';
                                            ?>
                                            <input type="checkbox" name="wr7[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> />
                                            <label for="<?=$id?>"><?=$val?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <h3>Q4. 결혼상대의 연봉은? <span>(복수선택 가능)</span></h3>
                                    <div class="form_wrap">
                                        <div class="select grid grid4">
                                            <input type="hidden" name="wr_9" value="<?=$write[wr_9]?>"/>
                                            <?php
                                            $salaryList = [
                                                '3천만원 미만', '3~4천 만원', '4~6천 만원', '6~8천 만원', '8천~1억',
                                                '1억~1억5천', '1억5천~2억', '2억 이상'
                                            ];
                                            foreach ($salaryList as $key => $val):
                                                $id = "wr_9_{$key}";
                                                $checked = (strpos($write[wr_9], $val) !== false || (empty($write[wr_9]) && $key == 0))? "checked" : '';
                                            ?>
                                            <input type="checkbox" name="wr9[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> />
                                            <label for="<?=$id?>"><?=$val?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    <h2>추천 프로필 신청</h2>
                                    <h3>이제 결혼상대 추천에 필요한 정보를 입력해주세요.</h3>
                                    <div>결혼 컨설팅을 진행하는 전담 커플매니저가
                                        2명의 추천 프로필을 카카오 알림톡으로 익일 발송해 드립니다</div>
                                    <br>
                                    <div class="form_wrap profile">
                                        <div class="flex">
                                            <input type="text" name="wr_name" placeholder="이름">
                                            <div class="select grid grid2">
                                                <input type="radio" name="wr_link1" id="wr_link1_1" value="남자"<?php echo $write[wr_link1]=="남자"||$w==""?" checked":"";?>><label for="wr_link1_1">남자</label>
                                                <input type="radio" name="wr_link1" id="wr_link1_2" value="여자"<?php echo $write[wr_link1]=="여자"?" checked":"";?>><label for="wr_link1_2">여자</label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                             <input type="text" name="wr_homepage" id="mtel" placeholder="휴대폰번호">
                                        </div>
                                        <div class="select grid grid4">
                                            <input type="radio" id="wr_10_1" name="wr_10" value="초혼"<?php echo $write[wr_10]=="초혼"||$w==""?" checked":"";?> checked><label for="wr_10_1">초혼</label>
                                            <input type="radio" id="wr_10_2" name="wr_10" value="재혼"<?php echo $write[wr_10]=="재혼"?" checked":"";?>><label for="wr_10_2">재혼</label>
                                            <input type="radio" id="wr_10_3" name="wr_10" value="썸혼"<?php echo $write[wr_10]=="썸혼"?" checked":"";?>><label for="wr_10_3" class="block" tooltip="자녀없이 이혼한  돌싱">썸혼</label>
                                            <input type="radio" id="wr_10_4" name="wr_10" value="황혼"<?php echo $write[wr_10]=="황혼"?" checked":"";?>><label for="wr_10_4" class="block" tooltip="60세이후 혼자">황혼</label>
                                        </div>
                                        <div class="flex">
                                            <select name="wr_content" id="wr_content" required>
                                                <option value="">출생년도</option>
												 <?
                                                 //2010~현재년도까지
                                                  foreach(range(date('Y'), 1940) as $year) {
                                                    $tm_selected = ($ymd == $year) ? "selected" : "";
                                                    echo '<option value="'.$year.'"  '.$tm_selected.'  >'.$year.'</option>';
                                                  }  
                                                 ?>
                                            </select>
                                            <select name="wr_8" id="wr_8" required >
                                                <option value="">거주지</option>
                                                <option value="서울"<?php echo $write['wr_8']=="서울"?" selected":"";?>>서울</option>
                                                <option value="경기"<?php echo $write['wr_8']=="경기"?" selected":"";?>>경기</option>
                                                <!--<option value="경기(북부 - 고양,파주,의정부 등)"<?php echo $write['wr_8']=="경기(북부 - 고양,파주,의정부 등)"?" selected":"";?>>경기(북부 - 고양,파주,의정부 등)</option>
                                                <option value="경기(서부 - 김포,광명,시흥 등)"<?php echo $write['wr_8']=="경기(서부 - 김포,광명,시흥 등)"?" selected":"";?>>경기(서부 - 김포,광명,시흥 등)</option>
                                                <option value="경기(남부 - 분당,과천,수원,용인 등)"<?php echo $write['wr_8']=="경기(남부 - 분당,과천,수원,용인 등)"?" selected":"";?>>경기(남부 - 분당,과천,수원,용인 등)</option>
                                                <option value="경기(동부 - 구리,하남,남양주 등)"<?php echo $write['wr_8']=="경기(동부 - 구리,하남,남양주 등)"?" selected":"";?>>경기(동부 - 구리,하남,남양주 등)</option>-->
                                                <option value="인천/부천"<?php echo $write['wr_8']=="인천/부천"?" selected":"";?>>인천/부천</option>
                                                <option value="강원도"<?php echo $write['wr_8']=="강원도"?" selected":"";?>>강원도</option>
                                                <option value="대전"<?php echo $write['wr_8']=="대전"?" selected":"";?>>대전</option>
                                                <option value="세종"<?php echo $write['wr_8']=="세종"?" selected":"";?>>세종</option>
                                                <option value="대구"<?php echo $write['wr_8']=="대구"?" selected":"";?>>대구</option>
                                                <option value="광주"<?php echo $write['wr_8']=="광주"?" selected":"";?>>광주</option>
                                                <option value="울산"<?php echo $write['wr_8']=="울산"?" selected":"";?>>울산</option>
                                                <option value="부산"<?php echo $write['wr_8']=="부산"?" selected":"";?>>부산</option>
                                                <option value="충북"<?php echo $write['wr_8']=="충북"?" selected":"";?>>충북</option>
                                                <option value="충남"<?php echo $write['wr_8']=="충남"?" selected":"";?>>충남</option>
                                                <option value="경북"<?php echo $write['wr_8']=="경북"?" selected":"";?>>경북</option>
                                                <option value="경남"<?php echo $write['wr_8']=="경남"?" selected":"";?>>경남</option>
                                                <option value="전북"<?php echo $write['wr_8']=="전북"?" selected":"";?>>전북</option>
                                                <option value="전남"<?php echo $write['wr_8']=="전남"?" selected":"";?>>전남</option>
                                                <option value="제주"<?php echo $write['wr_8']=="제주"?" selected":"";?>>제주</option>
                                                <option value="해외"<?php echo $write['wr_8']=="해외"?" selected":"";?>>해외</option>
                                                <option value="기타"<?php echo $write['wr_8']=="기타"?" selected":"";?>>기타</option>
                                            </select>
                                        </div>
                                        <div class="flex">
                                            <select name="wr_11" id="wr_11" required >
                                                <option>최종학력</option>
                                                <option value="대학교 졸업"<?php echo $write['wr_11']=="대학교 졸업"?" selected":"";?>>대학교 졸업</option>
                                                <option value="대학교 중퇴"<?php echo $write['wr_11']=="대학교 중퇴"?" selected":"";?>>대학교 중퇴</option>
                                                <option value="대학교 재학"<?php echo $write['wr_11']=="대학교 재학"?" selected":"";?>>대학교 재학</option>
                                                <option value="대학원 졸업"<?php echo $write['wr_11']=="대학교 졸업"?" selected":"";?>>대학원 졸업</option>
                                                <option value="대학(2,3년제) 졸업"<?php echo $write['wr_11']=="대학(2,3년제) 졸업"?" selected":"";?>>대학(2,3년제) 졸업</option>
                                                <option value="대학(2,3년제) 중퇴"<?php echo $write['wr_11']=="대학(2,3년제) 중퇴"?" selected":"";?>>대학(2,3년제) 중퇴</option>
                                                <option value="고등학교 졸업"<?php echo $write['wr_11']=="고등학교 졸업"?" selected":"";?>>고등학교 졸업</option>
                                                <option value="기타"<?php echo $write['wr_11']=="기타"?" selected":"";?>>기타</option>
                                            </select>
                                            <select name="wr_12" id="wr_12" required >
                                                <option>나의 직업은</option>
                                                <option value="사무/금융직"<?php echo $write['wr_12']=="사무/금융직"?" selected":"";?>>사무/금융직</option>
                                                <option value="연구원/엔지니어"<?php echo $write['wr_12']=="연구원/엔지니어"?" selected":"";?>>연구원/엔지니어</option>
                                                <option value="건축/설계"<?php echo $write['wr_12']=="건축/설계"?" selected":"";?>>건축/설계</option>
                                                <option value="교사 및 강사"<?php echo $write['wr_12']=="교사 및 강사"?" selected":"";?>>교사 및 강사</option>
                                                <option value="공무원/공사"<?php echo $write['wr_12']=="공무원/공사"?" selected":"";?>>공무원/공사</option>
                                                <option value="승무원/항공관련"<?php echo $write['wr_12']=="승무원/항공관련"?" selected":"";?>>승무원/항공관련</option>
                                                <option value="서비스/영업"<?php echo $write['wr_12']=="서비스/영업"?" selected":"";?>>서비스/영업</option>
                                                <option value="의사/한의사/약사"<?php echo $write['wr_12']=="의사/한의사/약사"?" selected":"";?>>의사/한의사/약사</option>
                                                <option value="변호사/법조인"<?php echo $write['wr_12']=="변호사/법조인"?" selected":"";?>>변호사/법조인</option>
                                                <option value="회계사 등 전문직"<?php echo $write['wr_12']=="회계사 등 전문직"?" selected":"";?>>회계사 등 전문직</option>
                                                <option value="간호 및 의료사"<?php echo $write['wr_12']=="간호 및 의료사"?" selected":"";?>>간호 및 의료사</option>
                                                <option value="자영업/사업"<?php echo $write['wr_12']=="자영업/사업"?" selected":"";?>>자영업/사업</option>
                                                <option value="유학생/석,박사"<?php echo $write['wr_12']=="유학생/석,박사"?" selected":"";?>>유학생/석,박사</option>
                                                <option value="프리랜서 및 기타"<?php echo $write['wr_12']=="기타"?" selected":"";?>>프리랜서 및 기타</option>
                                            </select>
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
											//자동하이픈 넣기
											$(document).on("keyup", "#mtel", function() {
												$(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})/,"$1-$2-$3").replace("--", "-") );
											});
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
                                        extraHtml: `<button class="btn btn-success" onclick="onFinish()">추천 프로필 받기</button>`
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
        $(function() {
            // 로드시 스텝1로 이동
            const currentHash = window.location.hash;
            if (currentHash != '#step-1') {
                location.hash = 'step-1';
                location.reload();
            }
        });

        function index_write_submit(f){

			if( frmtest.wr_name.value == "" ) {
				frmtest.wr_name.focus();
				alert("이름을 입력해 주세요.");
				return false;	
			}

            if(checkHan(frmtest.wr_name.value) == false){
                frmtest.wr_name.focus();
                alert("이름은 한글로만 입력해 주세요.");
                return false;
            }

			if( frmtest.wr_homepage.value == "" ) {
				frmtest.wr_homepage.focus();
				alert("휴대폰번호를 입력해 주세요.");
				return false;	
			}
            if( frmtest.wr_content.value == "" ) {
                alert("출생년도를 선택해 주세요.");
                return false;
            }

            if( frmtest.wr_8.value == "" ) {
                alert("거주지를 선택해 주세요.");
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
			
			const wr_4_arr = [];
			const wr_5_arr = [];
			const wr_6_arr = [];
			const wr_7_arr = [];
			const wr_9_arr = [];

			// 관심사
			document.querySelectorAll('[name="wr4[]"]').forEach(input => {
				if (input.checked && input.value != '') wr_4_arr.push(input.value);
			});
	
			// 결혼상대연령
			document.querySelectorAll('[name="wr5[]"]').forEach(input => {
				if (input.checked && input.value != '') wr_5_arr.push(input.value);
			});

            // 학력
            document.querySelectorAll('[name="wr6[]"]').forEach(input => {
                if (input.checked && input.value != '') wr_6_arr.push(input.value);
            });

            // 직업
            document.querySelectorAll('[name="wr7[]"]').forEach(input => {
                if (input.checked && input.value != '') wr_7_arr.push(input.value);
            });

            // 연봉
            document.querySelectorAll('[name="wr9[]"]').forEach(input => {
                if (input.checked && input.value != '') wr_9_arr.push(input.value);
            });

	
			f.wr_4.value = wr_4_arr.join(',');
			f.wr_5.value = wr_5_arr.join(',');
			f.wr_6.value = wr_6_arr.join(',');
			f.wr_7.value = wr_7_arr.join(',');
			f.wr_9.value = wr_9_arr.join(',');

            return true;
        }
    </script>

<?
include_once('./tail.php');
?>