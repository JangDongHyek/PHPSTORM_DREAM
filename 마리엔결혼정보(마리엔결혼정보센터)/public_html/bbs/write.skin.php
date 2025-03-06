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
    <input type="hidden" name="wr_subject" value="간편상담 신청 문의가 접수되었습니다.">
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

    <input type="hidden" name="wr_content" value="간편상담 문의가 접수되었습니다."> 
    <div class="qna">
        <div class="qna_wrap">

            <div class="titleArea">
                <h2>문의하실 내용을 선택해 주세요<br>
                궁금해 하시는 모든 부분을 빠르게 답변 드리겠습니다.</h2>
            </div>
            
            <div class="form">
                <div class="form_wrap">
                    <h3>간편상담 문의 주제는? <span>(복수선택가능)</span></h3>
                    <div class="select grid grid6">
                        <input type="hidden" name="wr_1" value="<?=$write[wr_1]?>"/>
                        <?php
                        $subList = ['가입비', '만남횟수', '가입방법', '성혼율', '가입자격', '회원수'];
                        foreach ($subList as $key => $val):
                            $id = "wr_1_{$key}";
                            $checked = (strpos($write[wr_1], $val) !== false) || (empty($write[wr_1]) && $key == 0) ? "checked" : '';
                            ?>
                            <input type="checkbox" name="wr1[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> class="rd_subj" />
                            <label for="<?=$id?>"><?=$val?></label>
                        <?php endforeach; ?>
                    </div>
                    <textarea name="wr_2" id="wr_2" placeholder="문의내용 직접 입력"></textarea>
                </div>
                <div class="form_wrap">
                    <h3>결혼 상대의 직업은? <span>(복수선택가능)</span></h3>
                    <div class="select grid grid4 job_list">
                        <input type="hidden" name="wr_3" value="<?=$write[wr_3]?>"/>
                        <?php
                        $jobList = [
                            '사무/금융직', '연구원/엔지니어', '건축/설계', '교사 및 강사', '공무원/공사',
                            '승무원/항공관련', '서비스/영업', '의사/한의사/약사', '변호사/법조인', '회계사 등 전문직',
                            '간호 및 의료사', '자영업/사업', '유학생/석,박사', '프리랜서 및 기타',
                        ];
                        foreach ($jobList as $key => $val):
                            $id = "wr_3_{$key}";
                            $checked = (strpos($write[wr_3], $val) !== false) || (empty($write[wr_3]) && $key == 0)? "checked" : '';
                        ?>
                        <input type="checkbox" name="wr3[]" id="<?=$id?>" value="<?=$val?>" <?=$checked?> />
                        <label for="<?=$id?>"><?=$val?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form_wrap">
                    <h3>상담을 위한 정보를 입력해주세요</h3>

                    <div class="flex">
                        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" placeholder="이름">
                        <div class="select grid grid2">
                            <input type="radio" name="wr_4" id="wr_4_1" value="남자"<?php echo $write[wr_4]=="남자"||$w==""?" checked":"";?>><label for="wr_4_1">남자</label>
                            <input type="radio" name="wr_4" id="wr_4_2" value="여자"<?php echo $write[wr_4]=="여자"?" checked":"";?>><label for="wr_4_2">여자</label>
                        </div>
                    </div>
                    <input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" id="wr_5" placeholder="휴대폰번호">
                    <div class="flex">
                        <select name="wr_6" id="wr_6" required >
                            <option>출생년도</option>
								 <?
                                 //2010~현재년도까지
                                  foreach(range(date('Y'), 1940) as $year) {
                                    $tm_selected = ($ymd == $year) ? "selected" : "";
                                    echo '<option value="'.$year.'"  '.$tm_selected.'  >'.$year.'</option>';
                                  }  
                                 ?>
                        </select>
                        <select name="wr_7" id="wr_7" required >
                            <option>최종학력</option>
                            <option value="대학교 졸업"<?php echo $write['wr_7']=="대학교 졸업"?" selected":"";?>>대학교 졸업</option>
                            <option value="대학교 중퇴"<?php echo $write['wr_7']=="대학교 중퇴"?" selected":"";?>>대학교 중퇴</option>
                            <option value="대학교 재학"<?php echo $write['wr_7']=="대학교 재학"?" selected":"";?>>대학교 재학</option>
                            <option value="대학원 졸업"<?php echo $write['wr_7']=="대학교 졸업"?" selected":"";?>>대학원 졸업</option>
                            <option value="대학(2,3년제) 졸업"<?php echo $write['wr_7']=="대학(2,3년제) 졸업"?" selected":"";?>>대학(2,3년제) 졸업</option>
                            <option value="대학(2,3년제) 중퇴"<?php echo $write['wr_7']=="대학(2,3년제) 중퇴"?" selected":"";?>>대학(2,3년제) 중퇴</option>
                            <option value="고등학교 졸업"<?php echo $write['wr_7']=="고등학교 졸업"?" selected":"";?>>고등학교 졸업</option>
                            <option value="기타"<?php echo $write['wr_7']=="기타"?" selected":"";?>>기타</option>
                        </select>
                        <select name="wr_8" id="wr_8" required >
                            <option>거주지</option>
                            <option value="서울"<?php echo $write['wr_8']=="서울"?" selected":"";?>>서울</option>
                            <option value="경기(북부 - 고양,파주,의정부 등)"<?php echo $write['wr_8']=="경기(북부 - 고양,파주,의정부 등)"?" selected":"";?>>경기(북부 - 고양,파주,의정부 등)</option>
                            <option value="경기(서부 - 김포,광명,시흥 등)"<?php echo $write['wr_8']=="경기(서부 - 김포,광명,시흥 등)"?" selected":"";?>>경기(서부 - 김포,광명,시흥 등)</option>
                            <option value="경기(남부 - 분당,과천,수원,용인 등)"<?php echo $write['wr_8']=="경기(남부 - 분당,과천,수원,용인 등)"?" selected":"";?>>경기(남부 - 분당,과천,수원,용인 등)</option>
                            <option value="경기(동부 - 구리,하남,남양주 등)"<?php echo $write['wr_8']=="경기(동부 - 구리,하남,남양주 등)"?" selected":"";?>>경기(동부 - 구리,하남,남양주 등)</option>
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
                            <div class="conts"><? include_once(G5_BBS_PATH.'/agree_detail01.php'); ?></div>
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
        <input type="submit" value="문의하기" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="<?php echo $list_href ?>" class="btn_cancel">취소</a>
       <? if($is_admin){?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
       <? } ?>
        
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

    // 휴대폰번호
    document.querySelector('#wr_5').addEventListener('keyup', (e) => {
        e.target.value = addHyphenTel(e.target.value);
    });

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
        const wr_1_arr = [];
        const wr_3_arr = [];

        // 간편상담 문의주제
        document.querySelectorAll('[name="wr1[]"]').forEach(input => {
            if (input.checked && input.value != '') wr_1_arr.push(input.value);
        });
        if (wr_1_arr.length == 0) {
            alert("간편상담 문의 주제를 1개 이상 선택해 주세요.");
            return false;
        }

        // 결혼상대직업
        document.querySelectorAll('[name="wr3[]"]').forEach(input => {
            if (input.checked && input.value != '') wr_3_arr.push(input.value);
        });
        if (wr_3_arr.length == 0) {
            alert("결혼 상대의 직업을 1개 이상 선택해 주세요.");
            return false;
        }

        f.wr_1.value = wr_1_arr.join(',');
        f.wr_3.value = wr_3_arr.join(',');

		if( f.wr_name.value == "" ) {
			f.wr_name.focus();
			alert("이름을 입력해 주세요.");
			return false;	
		}
		if( f.wr_5.value == "" ) {
			f.wr_5.focus();
			alert("휴대폰번호를 입력해 주세요.");
			return false;	
		}
		if (!f.agree2.checked) {
			alert("개인정보 수집 및 이용에 동의하셔야 작성할 수 있습니다.");
			f.agree2.focus();
			return false;
		}
		if (!f.agree3.checked) {
			alert("마케팅 활용에 동의하셔야 작성할 수 있습니다.");
			f.agree3.focus();
			return false;
		}

        document.getElementById("btn_submit").disabled = "disabled";
        return true;
		
    }

    function addHyphenTel(value) {
        if (!value) return '';
        let formatted = value.replace(/[^0-9]/g, "");
        if (formatted.length > 11) {
            return value.slice(0, 13);
        }

        let result = [];
        let restNumber = "";

        // 지역번호와 나머지 번호로 나누기
        if (formatted.startsWith("02")) {
            // 서울 02 지역번호
            result.push(formatted.substr(0, 2));
            restNumber = formatted.substring(2);
        } else if (formatted.startsWith("1")) {
            // 지역 번호가 없는 경우
            // 1xxx-yyyy
            restNumber = formatted;
        } else {
            // 나머지 3자리 지역번호
            // 0xx-yyyy-zzzz
            result.push(formatted.substr(0, 3));
            restNumber = formatted.substring(3);
        }

        if (restNumber.length === 7) {
            // 7자리만 남았을 때는 xxx-yyyy
            result.push(restNumber.substring(0, 3));
            result.push(restNumber.substring(3));
        } else {
            result.push(restNumber.substring(0, 4));
            result.push(restNumber.substring(4));
        }

        return result.filter((val) => val).join("-");
    }

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->