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
    <div id="app" class="flex">
        <div>
            <!--삼삼경매 상담문의-->
            <div class="form_wrap">
                <div class="form">
                <dl>
                    <dt><label for="wr_name">이름<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" name="wr_name" v-model="data.wr_name" id="wr_name" required size="10" maxlength="20"></dd>
                </dl>
                <dl class="flex">
                    <dt>성별<strong class="sound_only">*</strong></dt>
                    <dd>
                        <input type="radio" id="gender_female" v-model="data.gender" name="gender" value="여성" required><label for="gender_female">여성</label>
                        <input type="radio" id="gender_male" v-model="data.gender" name="gender" value="남성" required><label for="gender_male">남성</label>
                    </dd>
                </dl>
                <dl>
                    <dt><label for="wr_hp">연락처<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="wr_hp" v-model="data.wr_hp" name="wr_hp" placeholder="연락처" required></dd>
                </dl>
                <dl>
                    <dt><label for="wr_email">이메일<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="wr_email" v-model="data.wr_email" name="wr_email" placeholder="이메일" required></dd>
                </dl>
                <dl>
                    <dt><label for="birthdate">생년월일<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="date" id="birthdate" v-model="data.birthdate" name="birthdate" placeholder="생년월일" required></dd>
                </dl>
                <dl>
                    <dt><label for="address">주소<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="address" v-model="data.address" name="address" placeholder="시(서울시는 구까지 입력 부탁드립니다)" required></dd>
                </dl>
                <dl>
                    <dt><label for="wr_1">직업<strong class="sound_only">*</strong></label></dt>
                    <dd><input type="text" id="wr_1" v-model="data.wr_1" name="wr_1" placeholder="직업" required></dd>
                </dl>
                <dl class="flex">
                    <dt>결혼유무<strong class="sound_only">*</strong></dt>
                    <dd>
                        <input type="radio" id="marital_status_single"  v-model="data.wr_2" name="wr_2" value="미혼" required><label for="marital_status_single">미혼</label>
                        <input type="radio" id="marital_status_married" v-model="data.wr_2" name="wr_2" value="기혼" required><label for="marital_status_married">기혼</label>
                    </dd>
                </dl>
                <dl>
                    <dt>투자경험여부<strong class="sound_only">*</strong><span>복수 선택 가능합니다.</span></dt>
                    <dd>
                       <p><input type="checkbox" id="investment_none" v-model="data.wr_3" name="investment_experience[]" value="금융투자상품에 투자해 본 경험 없음">
                           <label for="investment_none">금융투자상품에 투자해 본 경험 없음</label></p>
                        <p> <input type="checkbox" id="investment_bank" v-model="data.wr_3" name="investment_experience[]" value="은행, 예/적금, 국채, MMF, CMA등"><label for="investment_bank">은행, 예/적금, 국채, MMF, CMA등</label></p>
                        <p>  <input type="checkbox" id="investment_fund" v-model="data.wr_3" name="investment_experience[]" value="펀드, 원금보장형 ELS, 금융채 등"><label for="investment_fund">펀드, 원금보장형 ELS, 금융채 등</label></p>
                        <p>  <input type="checkbox" id="investment_gpl" v-model="data.wr_3" name="investment_experience[]" value="GPL, NPL, 경매 등"><label for="investment_gpl">GPL, NPL, 경매 등</label></p>
                        <p>  <input type="checkbox" id="investment_realestate" v-model="data.wr_3" name="investment_experience[]" value="실물 부동산 투자"><label for="investment_realestate">실물 부동산 투자</label></p>
                        <p>  <input type="checkbox" id="investment_bitcoin" v-model="data.wr_3" name="investment_experience[]" value="비트코인"><label for="investment_bitcoin">비트코인</label></p>
                        <p>  <input type="checkbox" id="investment_venture" v-model="data.wr_3" name="investment_experience[]" value="벤처투자"><label for="investment_venture">벤처투자</label></p>
                    </dd>
                </dl>
                <dl>
                    <dt>희망하는 상담 서비스<strong class="sound_only">*</strong><span>복수 선택 가능합니다.</span></dt>
                    <dd>
                        <p>  <input type="checkbox" id="service_financial" v-model="data.wr_4" name="desired_service[]" value="재무상담"><label for="service_financial">재무상담</label></p>
                        <p>   <input type="checkbox" id="service_mortgage" v-model="data.wr_4" name="desired_service[]" value="담보물채권투자"><label for="service_mortgage">담보물채권투자</label></p>
                        <p>   <input type="checkbox" id="service_realestate" v-model="data.wr_4" name="desired_service[]" value="부동산 상담"><label for="service_realestate">부동산 상담</label></p>
                        <p> <input type="checkbox" id="service_auction" v-model="data.wr_4" name="desired_service[]" value="경매상담"><label for="service_auction">경매상담</label></p>
                        <p> <input type="checkbox" id="service_legal" v-model="data.wr_4" name="desired_service[]" value="법무상담"><label for="service_legal">법무상담</label></p>
                        <p>  <input type="checkbox" id="service_loan" v-model="data.wr_4" name="desired_service[]" value="대출상담"><label for="service_loan">대출상담</label></p>
                    </dd>
                </dl>
                <dl class="flex">
                    <dt>희망하시는 상담 유형<strong class="sound_only">*</strong><span>항목에 대한 설명을 입력해주세요</span></dt>
                    <dd>
                        <input type="radio" id="consultation_type_visit" v-model="data.wr_5" name="consultation_type" value="내방" required><label for="consultation_type_visit">내방</label>
                        <input type="radio" id="consultation_type_phone" v-model="data.wr_5" name="consultation_type" value="전화" required><label for="consultation_type_phone">전화</label>
                    </dd>
                </dl>
                <dl>
                    <dt>문의사항<strong class="sound_only">*</strong><span>최대한 구체적으로 적어주세요. </span></dt>
                    <dd>
                        <textarea id="inquiry" name="inquiry" v-model="data.wr_6" placeholder="최대한 구체적으로 적어주세요." required></textarea>
                    </dd>
                </dl>
                <dl class="flex">
                    <dt>통화가능시간대<strong class="sound_only">*</strong><span>항목에 대한 설명을 입력해주세요</span></dt>
                    <dd>
                        <input type="time" id="available_time" v-model="data.wr_7" name="available_time" required>
                    </dd>
                </dl>
                </div>
                <? if(!$is_admin){?>
                    <div class="agree">
                        <h2>개인정보수집동의</h2>
                        <div class="txt cf">
                            <div class="bx"><strong>개인정보의 수집·이용 목적</strong><div class="con">서비스 제공 및 계약의 이행 등을 목적으로 개인정보를 처리합니다.</div></div>
                            <div class="bx"><strong>수집하려는 개인정보의 항목</strong><div class="con">이름, 이메일 등</div></div>
                            <div class="bx"><strong>개인정보의 보유 및 이용 기간</strong><div class="con">개인정보 수집 및 이용목적이 달성된 후에는 예외없이 해당정보를 파기합니다..</div></div>
                        </div>
                        <div class="agree_ch">
                            <input type=checkbox name="agree_chk" v-model="agree" id="agree_chk" value="y" required><label for="agree_chk">개인정보 처리방침에 동의함에 꼭 체크해주세요.</label>
                        </div>
                    </div><!--.agree-->
                <? }?>
            </div>
            <!--//삼삼경매 상담문의-->
            <div class="btn_confirm">
            <input type="button" @click="postData()" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
            <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
           <? if($is_admin){?>
            <a href="<?php echo $list_href ?>" class="btn_cancel">목록보기</a>
           <? } ?>

        </div>
        </div>
        <div class="roll_list">
                <div id="tbRealtime" class="swiper-container swiper-container-vertical">
                    <div class="swiper-wrapper">
                        <ul class="swiper-slide">
                            <li><span class="addr">[재무상담] 저축은 하고 있는데, 왜 돈이 불어나지 않을까요?  </span></li>
                            <li>강○○</li>
                            <li>2024-07-05</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[재무상담] 빚이 많아 미래가 불안합니다. 어떻게 해결할 수 있을까요?</span></li>
                            <li>유○○</li>
                            <li>2024-08-20</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[재무상담] 은퇴 후 생활이 걱정돼요. 지금부터 준비해야 할 것들</span></li>
                            <li>이○○</li>
                            <li>2024-07-16</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[재무상담] 투자를 시작했지만 불안합니다. 안전하게 수익을 내는 방법이 있을까요?</span></li>
                            <li>최○○</li>
                            <li>2024-07-19</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[재무상담] 가족의 미래를 위한 재무 계획, 어디서부터 시작해야 할까요? </span></li>
                            <li>최○○</li>
                            <li>2024-07-19</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[부동산상담] 부동산 가격이 계속 오를까요? 시장 전망과 투자 전략알려주세요 </span></li>
                            <li>김○○</li>
                            <li>2024-07-10</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[부동산상담] 내 집 마련의 첫걸음시작하려는데, 지금이 적기일까요?</span></li>
                            <li>김○○</li>
                            <li>2024-08-10</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[대출상담] 내 상황에 맞는 최적의 대출 상품을 찾아주세요</span></li>
                            <li>박○○</li>
                            <li>2024-08-29</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[대출상담] 대출 상환 계획 세우기: 재정적 여유를 위한 전략</span></li>
                            <li>지○○</li>
                            <li>2024-07-23</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[대출상담] 신용도에 따른 대출 조건, 어떻게 개선할 수 있을까요?</span></li>
                            <li>조○○</li>
                            <li>2024-08-28</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                        <ul class="swiper-slide">
                            <li><span class="addr">[대출상담] 대출, 어떻게 하면 부담을 줄일 수 있을까요?</span></li>
                            <li>정○○</li>
                            <li>2024-08-21</li>
                            <li><span class="state state1">상담완료</span></li>
                        </ul>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </div>
    </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

    <script>
// Vue 인스턴스 생성
new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            data : {
                wr_name : "",
                gender : "",
                wr_hp : "",
                wr_email : "",
                birthdate : "",
                address : "",
                wr_1 : "",
                wr_2 : "",
                wr_3 : [],
                wr_4 : [],
                wr_5 : "",
                wr_6 : "",
                wr_7 : "",
            },
            agree : false
        },
        created : function() {

        },
        methods: {
            postData : function() {
                if(this.data.wr_name == "") {
                    alert("이름을 입력해주세요.");
                    return false;
                }
                if(this.data.gender == "") {
                    alert("성별을 선택해주세요.");
                    return false;
                }
                if(this.data.wr_hp == "") {
                    alert("번호를 입력해주세요.");
                    return false;
                }
                if(this.data.wr_email == "") {
                    alert("이메일을 입력해주세요.");
                    return false;
                }
                if(this.data.birthdate == "") {
                    alert("생년월일을 입력해주세요.");
                    return false;
                }
                if(this.data.address == "") {
                    alert("주소를 입력해주세요.");
                    return false;
                }
                if(this.data.wr_1 == "") {
                    alert("기업을 입력해주세요.");
                    return false;
                }
                if(this.data.wr_2 == "") {
                    alert("결혼유무를 선택해주세요.");
                    return false;
                }
                if(this.data.wr_3.length <= 0 ) {
                    alert("투자경험여부를 하나라도 선택해주세요.");
                    return false;
                }
                if(this.data.wr_4.length <= 0) {
                    alert("희망하는 상담 서비스를 하나라도 선택해주세요.");
                    return false;
                }
                if(this.data.wr_5 == "") {
                    alert("희망하는 상담 서비스 유형을 선택해주세요.");
                    return false;
                }
                if(this.data.wr_6 == "") {
                    alert("문의사항을 입력해주세요.");
                    return false;
                }
                if(this.data.wr_7 == "") {
                    alert("통화가능시간대를 선택 해주세요.");
                    return false;
                }
                if(!this.agree) {
                    alert("개인정보 처리방침에 동의 해주세요.");
                    return false;
                }

                var method = "post";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };

                console.log(objs);
                var res = this.ajax(this.base_url + "/api/g5_write_qna.php",objs);

                if(res) {
                    alert("작성이 완료되었습니다.");
                    window.location.reload();
                }
            },
            getData : function() {
                var method = "get";

                var objs = {
                    _method : method
                };

                var res = this.ajax(this.base_url + "/api/",objs);
                if(res) {
                    console.log(res)
                }
            },
            ajax : function(url,objs) {
                var form = new FormData();
                if(url.indexOf(".php") == -1) url = url + ".php";
                for(var i in objs) {
                    form.append(i, objs[i]);
                }

                var result = null;
                $.ajax({
                    url : url,
                    method : "post",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : false,
                    cache : false,
                    data : form,
                    dataType : "json",
                    success: function(res){
                        if(!res.success) alert(res.message);
                        else {
                            result = res;

                            if(res.data) {
                                var obj = res.data;
                                for(field in obj) {
                                    if(field.indexOf("_id") !== -1) continue;
                                    try {
                                        obj[field] = JSON.parse(obj[field]);
                                    } catch (e) {

                                    }
                                }
                                res.data = obj;
                            }
                        }
                    }
                });

                return result;
            }
        }
    });
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
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

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

    <script>
        //실시간 상담리스트
        var swiper = new Swiper('#tbRealtime', {
            loop: true,
            direction: 'vertical',
            slidesPerView: 4,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
        });
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->