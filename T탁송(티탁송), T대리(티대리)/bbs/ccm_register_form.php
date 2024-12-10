<?php
include_once('./_common.php');
include_once('./_head.php');
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
    <style>
        .x-shape {
            width: 18px;
            height: 18px;
            background-color: black;
            position: relative;
        }

        .x-shape:before,
        .x-shape:after {
            content: '';
            position: absolute;
            width: 60%;
            height: 1px;
            background-color: white;
            top: 48%;
            left: 20%;
            transform-origin: center;
        }

        .x-shape:before {
            transform: rotate(45deg);
        }

        .x-shape:after {
            transform: rotate(-45deg);
        }


        .mbskin{font-size:1em; padding:20px;}
        .mbskin caption { color:#333;margin:0;text-align:left;padding:10px 10px;font-weight:bold;text-align:left; font-size:1.2em; position:relative;}
        .mbskin caption:after{ content:""; display:block; left:0; top:15px; position:absolute; width:5px; height:15px; background:#ffe900; border-radius:5px;}
        .mbskin .tbl_frm01 th {width:85px; display:none;}
        .mbskin .required, .mbskin textarea.required { width:100%;}

        .mbskin .flex{display: flex; align-items: center; justify-content: space-between; gap: 6px; margin: 0;}
        .mbskin canvas {border: 1px solid #ddd; background-color: #eee; width: 100%; max-width: 400px}

        .mbskin .btn,
        .btn-success{background:#F2DE2B; color:#171717; border:0; font-weight:600;}
        .mbskin .btn:hover,
        .btn-success:hover{background:#171717; color:#fff;}

        .mbskin .txt_down{font-size: 12px; font-weight: normal;}

        /*이미지 업로드*/
        .imageInput_wrap{}
        #preview-container {display: grid;flex-wrap: wrap;gap: 10px;grid-template-columns: repeat(3, 1fr);}
        .preview-item {position: relative;aspect-ratio: 1/1;cursor: pointer;width: 100%; border: 1px solid #E1E1E1;background: #eee;}
        .preview-image {width: 100%;height: 100%;object-fit: cover;}
        .delete-button, .set-representative-button {position: absolute;padding: 4px;border: none;border-radius: 4px;font-size: 12px;opacity: 0.8;transition: opacity 0.3s;}
        .delete-button{right: -4px; top: -4px; background: #000000; color: #fff; width: 18px; height: 18px; padding: 0; font-weight: 200; border-radius: 50%; font-size: 11px; line-height: 18px; overflow: hidden;}
        .set-representative-button{bottom: 0; left: 0; display: none;}
        /*.preview-item:hover .set-representative-button{display: block; background: #00000069; width: 100%; height: 100%; border-radius: 0;}*/
        .delete-button:hover, .set-representative-button:hover {opacity: 1;}
        .representative {}
        .representative:after{content: "대표이미지"; position: absolute; bottom: 0; left: 0; width: 100%; background: #FEFAE4; color: #3F3E32; text-align: center; font-size: 11px; padding: 2px;}

        /* 이미지 선택 버튼 스타일 */
        #imageInput {display: none; /* 기존의 브라우저 기본 스타일 숨김 */}
        .custom-image-input { margin:0 10px 10px 0;}
        .custom-image-input:hover {background-color: #4900C0;}

        .modal-header{display: flex; align-items: center; justify-content: space-between;}
        .modal-body{white-space: pre-wrap; height: calc(100vh - 160px); overflow: auto;}

        select.frm_input{width: 100%; font-family: 'Noto Sans KR','Spoqa Han Sans', sans-serif;}
        select.frm_input:after{content: ""}
    </style>
    <form id="fregisterform" name="fregisterform" action="ccm_register_form_update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="agree" value="<?php echo $agree ?>">
        <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
        <!-- 대리점 -->
        <input type="hidden" name="agency_no" value="<? echo ($w == "")? $_SESSION['myAgency'] : $member['agency_no'] ?>">
        <!-- 회원구분 -->
        <? if ($w==""){ ?>
            <div id="mb_cate">
                <input type="hidden" name="mb_level" value="2" id="mb_level"><label for="mb-level2">CCM회원</label>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        <? } else { ?>
            <input type="hidden" name="mb_level" value="<?=$member['mb_level']?>">
        <? } ?>

        <?
            for($i=1; $i<13; $i++){ ?>
                <input type="hidden"  id="mb_<?=$i?>" name="mb_<?=$i?>" value="<?=$member['mb_{$i}']?>">
            <?}
        ?>

        <div class="mbskin">
            <div class="tbl_frm01 tbl_wrap">
                <table>
                    <caption>CCMSOLO 회원가입</caption>
                    <tbody>
                    <tr>
                        <th scope="row"><label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <div class="flex">
                                <input placeholder="아이디" type="tel" name="mb_id" value="" id="reg_mb_id" class="frm_input required" maxlength="20">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <input placeholder="이름" type="text" id="reg_mb_name" name="mb_name" value="" required="" class="frm_input required ">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="reg_mb_hp">휴대폰 번호<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <div class="flex">
                                <input placeholder="휴대폰번호" type="tel" name="mb_hp" value="" id="reg_mb_hp" class="frm_input required" maxlength="20">
                                <!--<button type="button" class="btn btn-success" id="injung">인증</button>-->
                            </div>
                        </td>
                    </tr>

                    <tr id="injung-no" style="display:none">
                        <th scope="row"><label for="reg_mb_hp">인증번호<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <input type="hidden" name="" value="" id="injung-re">
                            <input type="number" placeholder="6자리 인증번호를 입력하세요" id="injung-answer" class="frm_input" style="width:calc(100% - 106px)">
                            <button type="button" class="btn btn-success" style="width:60px" id="injung-success">확인</button>
                            <span id="time"></span>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></th>
                        <td><input placeholder="비밀번호" type="password" name="mb_password" id="reg_mb_password" class="frm_input required" minlength="3" maxlength="20" required=""></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></th>
                        <td><input placeholder="비밀번호 확인" type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input required" minlength="3" maxlength="20" required=""></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">주소<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <? $addr_onclick = "win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');"; ?>
                            <div class="flex"><input placeholder="주소입력" type="text" name="mb_addr1" id="mb_addr1" class="frm_input required" minlength="" maxlength="" required=""><button type="button" class="btn btn-success" id="injung" onclick="<?=$addr_onclick?>">찾기</button></div>
                            <div style="margin-top: 4px;"><input placeholder="상세주소입력" type="text" name="mb_addr2" id="mb_addr2" class="frm_input required" minlength="" maxlength="" required=""></div>
                            <input type="hidden" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
                            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>">
                            <input type="hidden" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input" size="10" maxlength="6" onclick="<?=$addr_onclick?>" placeholder="우편번호">
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="">이메일<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <input placeholder="이메일" type="text" name="mb_email" id="mb_email" class="frm_input required" minlength="" maxlength="" required="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">주거형태<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <select class="frm_input" name="mb_house" id="mb_house">
                                <option value="">주거형태 선택</option>
                                <option value="단독주택">단독주택</option>
                                <option value="아파트">아파트</option>
                                <option value="연립주택">연립주택</option>
                                <option value="다세대주택">다세대주택</option>
                                <option value="빌라">빌라</option>
                                <option value="원룸">원룸</option>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">생년월일</th>
                        <td>
                            <dl class="flex">
                                <dt>생년월일</dt>
                                <dd>
                                    <input placeholder="생년월일" type="date" id="mb_birth" name="mb_birth" value="" class="frm_input">
                                </dd>
                            </dl>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">성별</th>
                        <td>
                            <dl class="flex">
                                <dt>성별</dt>
                                <dd>
                                    <input type="radio" id="male" name="mb_gender" checked value="남"><label for="male">남성</label>
                                    <input type="radio" id="female" name="mb_gender" value="여"><label for="female">여성</label>
                                </dd>
                            </dl>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">혼인여부</th>
                        <td>
                            <dl class="flex">
                                <dt>혼인여부</dt>
                                <dd>
                                    <input type="radio" id="single" name="mb_maritalStatus" checked value="미혼"><label for="single">미혼</label>
                                    <input type="radio" id="married" name="mb_maritalStatus" value="재혼"><label for="married">재혼</label>
                                </dd>
                            </dl>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table>
                    <caption>프로필 사진 등록 <!--<span class="txt_down">※이미지클릭 대표이미지 설정</span>--></caption>
                    <tbody><tr>
                        <th scope="row"><label for="">사진 등록</label></th>
                        <td>
                            <div class="imageInput_wrap">
                                <!-- 이미지 선택 버튼 -->
                                <label for="imageInput" class="custom-image-input btn"><i class="fas fa-camera"></i> 이미지 추가</label>
                                <input type="file" id="imageInput" name="imageInput" accept="image/*"  onchange="uploadImg(this)">
                                <!-- 이미지 미리보기 컨테이너 -->
                                <div id="preview-container"></div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table>
                    <caption>가입 신청서 서명</caption>
                    <tbody><tr>
                        <th scope="row"><label for="">서명<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <button type="button" class="btn btn-success" onclick="openSignPad('name')">이름 서명하기</button>
                            <button type="button" class="btn btn-success" onclick="openSignPad('sign')">사인하기</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table>
                    <caption>CCMSOLO 가입서 규칙</caption>
                    <tbody><tr>
                        <th scope="row"><label for="">서명<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <div class="flex">
                                <p><input type="checkbox" id="agree" name="agree"><label for="agree">동의합니다.</label></p>
                                <button class="btn" data-toggle="modal" data-target="#agreeModal">가입서 확인</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="btn_confirm">
                <input type="submit" class="btn_submit" value="회원가입">
            </div>
        </div>
        <div class="modal fade" id="agreeModal" tabindex="-1" role="dialog" aria-labelledby="agreeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agreeModalLabel">CCMSOLO 가입서 규칙</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        제 1조 명칭
                        - 본 카페의 명칭은 기독교싱글모임 CCMSOLO  (크리스천 싱글모임)이라 칭한다

                        제 2조 목적
                        - CCM교회 찬양과 나눔 , 회원 상호 간의 친목, 정보교류 등을 통해 삶의 질을 높인다.

                        제 3조 회원의 의무
                        - CCMSOLO 회원은 회칙을 준수하며 회에서 정한 의결 사항을 성실히 이행하여야 한다.

                        제 4조 회원의 자격
                        - ccmsolo 회원은 서류상 법적 싱글만 가입하고 활동할 수 있다.(동거 중인 자 제외)
                        (단, ccmsolo 회원들 간의 동거,결혼은 제외한다.)

                        제 5조 스탭 및 지역장 임기
                        1. 스탭의 임기는 1년으로 하되, 카페장의 권고로 연임할 수 있다.
                        2. 지역장의 임기는 1년으로 하되, 카페장의 권고로 연임할 수 있다.
                        3. 지역장은 부지역장, 해당 지역의 클럽장을 선임할 수 있다.
                        4. 임기를 마친 스탭 및 지역장은 VIP 회원으로 활동한다.
                        (단, 임기를 채우지 못한 임원진은 현행 등급 관리에 준하여 적용한다.)
                        5 스텝. 지역장은 카페장의 권한으로 결혼한 사람을 세울 수 있다

                        제 6조 카페장의 권한
                        1. 카페 발전에 있어서 물의를 일으키는 회원은 카페장 재량권으로 제재 조치할 수 있다.
                        2. 스탭, 지역장, 클럽장의 선임, 재임, 회수 권한을 행사할 수 있다.

                        제 7조 운영기금
                        1. 공식적인 모임 회비의 잔액은 운영기금에 적립할 수 있다.
                        2 ccm교회의 헌금은 하나님께 드리는 것이므로 반환할 수 없다
                        3  운영기금은 공식 모임이나 이벤트 상품 지출 등에 사용한다.
                        ⓵ 카페장이 주관하는 공식 모임
                        ⓶ 스탭이 주관하나, 카페장이 승인한 공식 모임

                        제 8조 회원 활동과 제한조치 (각 조항 사안에 따라 강등, 경고,활동정지,강제탈퇴 조치를 할 수 있다.)
                        1. 주민등록증에 기재된 년생 활동 외에는 허용하지 않으며, 허위 프로필은 강제탈퇴 조치한다.
                        (가입인사 년생, 미혼,돌싱 허위 기재, 네이버 프로필 나이/성별 비공개 포함)
                        2. 허위사실 유포는 강제탈퇴 조치한다.
                        3. 가입인사 없이 쪽지를 발송한 자는 강제탈퇴 조치할 수 있다.
                        4. 아래 항목은 행위를 참고하여 징계 수위를 조절 조치한다.(활동정지 시 최장 60일)
                        ① 동일한 제목 반복 사용
                        ② 특수기호, 문장부호, 초성, 숫자만 사용하는 제목, 본문내용 삭제(일명 내용 펑)
                        (단, 인물사진 제외)
                        ③ 게시글, 댓글 삭제
                        ④ 댓글 차단
                        5. 활동정지 기간에 자진 탈퇴 후 재가입자는 확인 즉시 징계는 발효된다.
                        6. 성범죄, 폭행, 금전(회비포함),스토킹은 중대한 사건으로 분류하고 강제탈퇴 조치한다.
                        ① 타 카페 중대한 사건 강퇴자는 가입할 수 없다.
                        ② 타 카페 중대한 사건 외의 강퇴자는 가입할 수 있다.
                        7. 타인의 사생활은 침해할 수 없다.
                        8.카페장 동의 없는 홍보는 허용하지 않으며 아래 항목 위반자는 강제탈퇴 조치할 수 있다.
                        ① 인스타, 페이스북, 명함공개, 개인블로그, 단톡방, 유튜버의 홍보는 금지한다.
                        ② 사이트, 모임어플, 타 카페 홍보 및 가입 유도는 금지한다.
                        ③ 타 카페 직, 간접 노출은 금지한다.
                        ④ 유사 카페 운영진은 가입할 수 없다.
                        9. 과도한 분쟁은 사전 통보 없이 활동정지 조치할 수 있다.
                        10. 온라인과 오프라인 활동 나이는 26세부터 가능하다.
                        (단, 미혼부,모, 돌싱은 온, 오프라인 활동에 나이 제한을 두지 않으며, 미혼의 경우 26세에서 29세까지는 열심 회원부터 오프라인 모임에 참석할 수 있다.)
                        11. 서류상 법적 싱글만 활동 가능하며 기혼자 의심 신고에 대해서는 혼인 관계 증명서(상세)를 요구할 수 있다. (당사자는 거부할 수 있으며 거부 시 활동에 제한을 둘 수 있다.)
                        12. 활동정지 회원은 ccmsolo와 관련된(쪽지, 메일, 일쳇, 채팅방 포함) 모든 활동을 할 수 없다.
                        (활동 확인 즉시 강제탈퇴 조치할 수 있다.)
                        13. 카페장이 지정한 게시판 외의 상행위는 제재할 수 있다.
                        14. 타 카페 언급(옆동네,옆카페 포함)으로 분란을 야기할 수 있는 회원은 활동정지 또는 강제탈퇴 조치할 수 있다.
                        15. 게시글 및 댓글을 통한 금전이나 물품은 요구할 수 없다.
                        16. 운영진 안내에도 이를 이행하지 않은 회원은 사안에 따라 강제강등 및 활동정지 이상의 조치를 할 수 있다.
                        17. 운영진 판단하에 편을 가르거나 분란조장 행위 글은 제재할 수 있다.
                        18, 글 사고 접수는 7일 이내 스크린 샷 필수, 증거에 필요한 관련 링크는 추가 요청할 수 있다.
                        19, 정치 관련 글은 금지한다.
                        20. 쪽지, 메일 및 채팅을 통한 투자(주식포함) 유도의 금전 요구는 강제탈퇴 조치한다.

                        제 9조 협조 및 당부
                        1. 타인을 존중하며 비하(지역 비하 포함), 비방, 욕설(초성) 등을 금지한다.
                        2. 도배성 게시글은 금지하며 과도한 펌 글은 삼가한다.
                        3. 개인의 감정이 카페 운영 취지에 훼손되지 않도록 한다.
                        4. 각 게시판 성격에 맞는 게시글을 게시한다.
                        5. 게시글과 댓글에서의 비벙, 일벙 표현을 금지한다.

                        제 10조 회칙에 따른 조치
                        1. 경고 누적 횟수에 따라 활동정지 또는 강제탈퇴 대상이 될 수 있다.
                        2. 회칙 위배자는 게시판에 공지할 수 있다.
                        3. 운영진은 회칙을 위반한 게시글, 댓글에 대해서는 삭제할 수 있다.
                        4. 운영진 판단하에 등업을 목적으로하는 게시글은 삭제할 수 있다.

                        제 11조 징계 및 시효
                        1. 징계 소멸기간은 12개월(1년)로 한다.
                        2. 사건사고 시 신고유효 기간은 아래와 같다.
                        ① 글 관련은 사건 발생 7일 이내의 신고를 원칙으로 한다.
                        ② 오프라인 모임에서의 성범죄,폭행,금전(회비),스토킹의 중대한 사건은 15일 이내로 한다.
                        ③ 비밀모임(비벙) 주최자 신고는 12개월(1년)로 한다.

                        제 12조 제재 종류
                        1. 2일 활동 정지: 징계 누적이 적용되지 않는 긴급 조치 (공지 하지 않음)
                        2. 경고: 징계를 통한 재발 방지
                        3. 활동정지: 온라인(ccmsolo 내 메일,쪽지,채팅포함), 오프라인 활동 금지
                        4. 강제탈퇴: 영구제명

                        제 13조 회원 가입서
                        어플을 통한 가입서 작성시 생년월일 핸드폰번호  주소. 이메일.,,, 등 프로필 작성과
                        마지막에. 개인의 이름과 싸인을  어플에서 등록해야. ccmsolo 회원에 가입 할 수 있다

                        신규회원가입 (프로필)
                        이름:
                        전화:
                        생년월일:  남,여 구분.  미혼 재혼 체크란
                        주소:
                        이메일:
                        주거 형태: 자가. 전세. 월세
                        가입 신청서 사인 (. 사인넣는 부분 : 이름 (한글자씩 정자로 칸에 맞추어서 쓰세요). 사인

                        CCMSOLO 가입 계약서 (별도로. 회원가입시). . 사인넣는 부분 : 이름 (한글자씩 정자로 칸에 맞추어서 쓰세요). 사인. /.  CCMSOLO 도장.
                        개인정보동의서.  체크. (회원가입 프로필)


                        1)CCMSOLO 입회 가입시 제출된 프로필등 모든 서류에 대해  본인은 거짓이 없으며
                        운영자및 회원들에게 개인정보동의를 합니다
                        본인이 CCMSOLO 에 제공한 프로필등 이력은 거짓이 없으며  민.형사상의 문제 사고 발생시 본인이 책임을 지겠으며 이에따른 개인정보 제공에 전체 동의 합니다

                        2)CCMSOLO 에선 일체의 가입비나. 결혼성사금 등을 받지 않습니다
                        다만 , CCM교회에 자발적인 헌금은 하나님께 드리는 것으로 CCMSOLO 와는 별개의 모임이므로 일체 반환은 하지 않습니다
                        (주일 ccm교회 예배 및 오후 찬양예배가  (토요일 오후 찬양예배) 모두 마친후  ccmsolo 싱글모임을 별도로 운영합니다)

                        3)남,녀 관계의 신체접촉과 (성추행) , 불미스러운 관계  (성행위) 및 스토커(전화,문자,카카오톡)와 같은 지속적인 괴롭힘 등 문제가 발생되었을시엔  모든 책임은 본인 당사자에게 있으며. CCM교회와. CCMSOLO에선 책임을 지지 않습니다.
                        ccmsolo 회원  본인 자신이 전적으로 책임을 집니다
                        (어플에서. ccmsolo 가입서에 본인 이름/ 싸인 기재됌)

                        2024년.    4월 2일

                        이름.                           사인

                        대한예수교 장로회. CCM교회. 직인
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                        <!--<button type="button" class="btn btn-success" onclick="openSignPad()">동의합니다</button>-->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!------------------- 사인하기 모달 시작 -->
    <div class="modal fade modalS" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="pad_load">
                    <h1 style="margin-bottom: 10px">이름설명하기</h1>
                    <!-- pad load -->
                    <form method="POST" name="pfrm">
                        <input type="hidden" id="sign_type">
                        <div class="pad_bg"><canvas class="pad" id="sign_pad"></canvas></div>
                        <fieldset style="margin-top: 5px;"><input type="reset" class="btn btn-default" value="서명 다시하기" /></fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="sign_ok" onclick="signSubmit()">확인</button>
                    <button type="button" class="sign_close" data-dismiss="modal" aria-label="Close">취소</button>
                </div>
            </div>
        </div>
    </div><!--.modalS-->
    <!------------------- 사인하기 모달 끝 -->

    <link href="<?=G5_URL?>/css/jquery.signaturepad.css" rel="stylesheet">
    <script src="<?=G5_URL?>/js/jquery.signaturepad.js"></script>

    <script>
        // 사인
        var api;
        var canvas;
        var padResize = function(event) {
            canvas.attr({
                height: 250,
                width: window.innerWidth - 36 // padding+border빼기
            });
        };

        //서명
        $(function() {
            // 사인 패드 초기화
            api = $('#pad_load form').signaturePad({
                drawOnly: true,
                defaultAction: 'drawIt',
                validateFields: false,
                lineWidth: 0,
                output: null,
                sigNav: null,
                name: null,
                typed: null,
                clear: 'input[type=reset]',
                typeIt: null,
                drawIt: null,
                typeItDesc: null,
                drawItDesc: null,
                penColour: '#000'
            });

            canvas = $('canvas');

            window.addEventListener('orientationchange', padResize, false);
            window.addEventListener('resize', padResize, false);
            padResize();
        });

        // 사인하기 오픈
        function openSignPad(type) {
            $('#myModal').modal('show');
            canvas = $('canvas');

            $("#sign_type").val(type);
            var subj = (type == "sign")? "계약서 사인하기" : "이름 서명하기";
            $("#pad_load > h1").html(subj);

            window.addEventListener('orientationchange', padResize, false);
            window.addEventListener('resize', padResize, false);
            padResize();
        }

        //이미지등록
        $(document).ready(function(){
            // 이미지 업로드
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageUpload").change(function() {
                readURL(this);
            });

            // 제품등록 이미지 업로드
            $("#imageInput").on('change', handleImageSelect);

            function handleImageSelect(event) {
                const previewContainer = $('#preview-container');

                const files = event.target.files;

                for (const file of files) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const previewItem = $('<div class="preview-item"></div>');

                        const previewImage = $('<img class="preview-image">');
                        previewImage.attr('src', e.target.result);

                        const deleteButton = $('<button class="delete-button"><div class="x-shape"></div></button>');
                        deleteButton.click(function() {
                            previewItem.remove();
                        });

                        const setRepresentativeButton = $('<button class="set-representative-button">대표 이미지로 설정</button>');
                        setRepresentativeButton.click(function() {
                            //setRepresentativeImage(previewImage.attr('src'));
                        });

                        previewItem.append(previewImage);
                        previewItem.append(deleteButton);
                        previewItem.append(setRepresentativeButton);
                        previewContainer.html(previewItem);

                        previewImage.click(function() {
                            //setRepresentativeImage($(this));
                        });
                    };

                    reader.readAsDataURL(file);
                }

                // 선택한 파일 초기화
                $(this).val('');
            }
        });

        // 사인 업로드
        function signSubmit() {
            if (!api.validateForm()) {
                return false;
            }

            var sign = document.getElementById("sign_pad").toDataURL("image/png");
            sign = sign.replace('data:image/png;base64,', '');
            var sign_type = $("#sign_type").val();

            $.ajax({
                type : "post",
                url : g5_bbs_url + "/ajax.sign_upload.php",
                data : {"sign" : sign, "page" : "ccm", "sign_type" : sign_type},
                dataType : "text",
                success : function(json) {
                    var data = JSON.parse(json);
                    console.log(data);

                    var fd = "";
                    var area = "";

                    if (sign_type == "sign") {
                        fd = document.fregisterform.mb_5;	// 사인필드
                        area = $("#sign_area");
                    } else {
                        fd = document.fregisterform.mb_12;	// 이름서명필드
                        area = $("#nm_sign_area");
                    }

                    if (data.result == "T" && fd != "") {	// 사인완료
                        fd.value = data.file;
                        $('#myModal').modal('hide');
                        var img = $('<img src="<?=G5_SIGN_URL?>/'+ data.file +'" style="max-height: 70px;width:auto;">');
                        area.show().find(".sign_img").html(img);
                    } else {
                        getNoti(1, "사인등록에 실패하였습니다. 다시 시도해 주세요.");
                        fd.value = "";
                    }

                    /*
                    var mb_5 = document.fregisterform.mb_5;	// 사인필드
                    if (data.result == "T") {
                        // 사인완료
                        mb_5.value = data.file;
                        $('#myModal').modal('hide');
                        var img = $('<img src="<?=G5_SIGN_URL?>/'+ data.file +'" style="max-height: 70px;width:auto;">');
				$("#sign_area").show().find(".sign_img").html(img);
			} else {
				getNoti(1, "사인등록에 실패하였습니다. 다시 시도해 주세요.");
				mb_5.value = "";
			}
			*/
                },
                error : function(xhr,status,err) {
                    getNoti(1, "사인등록에 실패하였습니다. 다시 시도해 주세요.");
                    console.log(err);
                }
            });
        }


        // 프로필 사진
        function uploadImg(input) {
            var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;

            if (!reg_ext.test(input.files[0].name)) {
                getNoti(1, "이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                $("#imageInput").val("");
                return false;
            }

            // 최대용량 체크
            var	max_size_mb = 5, //5mb
                max_byte = max_size_mb * 1024 * 1024,
                file_byte = input.files[0].size;

            if (file_byte > max_byte) {
                getNoti(1, "최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
                $("#imageInput").val("");
                return false;
            }

            // 업로드 진행
            var frm = $("#fregisterform")[0];
            var frm_data = new FormData(frm);

            $('#page_loader').show();

            setTimeout(function() {
                $.ajax({
                    type : "POST",
                    url : "./ajax.ccm_form_img.php",
                    data : frm_data,
                    processData : false,
                    contentType : false,
                    async : false,
                    //beforeSend: function() {
                    //	$('#page_loader').show();
                    //},
                    success : function(json) {
                        console.log(json);
                        var data = JSON.parse(json);
                        if (data.result == "T") {
                            $("#mb_9").val(data.file);

                        } else {
                            getNoti(1, "첨부에 실패하였습니다. 다시 시도해 주세요.");
                        }
                    },
                    error : function(xhr,status,error) {
                        //console.log(error);
                        getNoti(1, "첨부에 실패하였습니다. 다시 시도해 주세요.");
                    },
                    complete: function() {
                        $('#page_loader').hide();
                    }
                });
            }, 200);
        }


        $('#fregisterform').submit(function(event) {
            var isValid = true;
            var errorMsg = '';

            // 아이디
            if (!$('#reg_mb_id').val().trim()) {
                errorMsg += '아이디를 입력하세요.\n';
                isValid = false;
            }

            // 이름
            if (!$('#reg_mb_name').val().trim()) {
                errorMsg += '이름을 입력하세요.\n';
                isValid = false;
            }

            // 휴대폰 번호
            if (!$('#reg_mb_hp').val().trim()) {
                errorMsg += '휴대폰 번호를 입력하세요.\n';
                isValid = false;
            }

            // 비밀번호
            if (!$('#reg_mb_password').val().trim()) {
                errorMsg += '비밀번호를 입력하세요.\n';
                isValid = false;
            }

            // 비밀번호 확인
            if ($('#reg_mb_password').val().trim() !== $('#reg_mb_password_re').val().trim()) {
                errorMsg += '비밀번호가 일치하지 않습니다.\n';
                isValid = false;
            }

            // 주소
            if (!$('#mb_addr1').val().trim() || !$('#mb_addr2').val().trim()) {
                errorMsg += '주소를 입력하세요.\n';
                isValid = false;
            }

            // 이메일
            if (!$('#mb_email').val().trim()) {
                errorMsg += '이메일을 입력하세요.\n';
                isValid = false;
            }

            // 주거형태
            if (!$('#mb_house').val().trim()) {
                errorMsg += '주거형태를 선택하세요.\n';
                isValid = false;
            }

            // 생년월일
            if (!$('#mb_birth').val().trim()) {
                errorMsg += '생년월일을 입력하세요.\n';
                isValid = false;
            }

            // 성별
            if (!$('input[name="mb_gender"]:checked').val()) {
                errorMsg += '성별을 선택하세요.\n';
                isValid = false;
            }

            // 혼인여부
            if (!$('input[name="mb_maritalStatus"]:checked').val()) {
                errorMsg += '혼인여부를 선택하세요.\n';
                isValid = false;
            }

            // 프로필 사진 (mb_9)
            if (!$('#mb_9').val().trim()) {
                errorMsg += '프로필 사진을 등록하세요.\n';
                isValid = false;
            }

            // 서명 (mb_5, mb_12)
            if (!$('#mb_5').val().trim() || !$('#mb_12').val().trim()) {
                errorMsg += '서명을 완료하세요.\n';
                isValid = false;
            }

            // 동의 체크
            if (!$('#agree').is(':checked')) {
                errorMsg += '가입서 규칙에 동의해야 합니다.\n';
                isValid = false;
            }

            if (!isValid) {
                getNoti(1, errorMsg);
                event.preventDefault();
            }
        });
    </script>

<?php
include_once('./_tail.php');
?>