<?
include_once('./_common.php');

$g5['title'] = '채용공고 등록';
include_once('./_head.php');

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}
if(!$admin && $member['mb_category'] == '일반') {
    alert('기업회원만 이용할 수 있습니다.');
}

$cr = sql_fetch(" select * from g5_career_recruit where idx = {$idx} ");

if($w == 'u') {
    if(!$private) {
        if($cr['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
            alert('올바른 경로가 아닙니다.');
        }
    }
}

$btn_txt = ($w == "" ? '등록' : '수정'); // 등록/수정 버튼 텍스트
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
</style>
<!-- 카테고리 모달팝업 -->
<div id="area_help" class="company_write v3">
    <form id="fcareer" name="fcareer" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/career_write_update.php">
        <input type="hidden" id="cr_hashtag" name="cr_hashtag" value="<?=$cr['cr_hashtag']?>">
        <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
        <input type="hidden" id="w" name="w" value="<?=$w?>">
        <div class="inr v3">
            <h2 class="title">채용공고 등록</h2>
            <div id="company_write">
                <ul class="box_list">
                    <li>
                        <em>제목</em>
                        <div class="area_box">
                            <input type="text" class="input_subject" id="cr_subject" name="cr_subject" value="<?=$cr['cr_subject']?>">
                        </div>
                    </li>
                    <li>
                        <em>채용공고 사이트 주소 <span class="discription">(별도의 채용공고 사이트가 없을시 포도씨 기업홈피가 기본으로 설정됩니다.)</span></em>
                        <div class="area_box">
                            <input type="text" class="input_subject" id="cr_site" name="cr_site" value="<?=$cr['cr_site']?>">
                        </div>
                    </li>
                    <li>
                        <em>접수기간</em>
                        <div class="area_box">
                             <input type="date" class="input_date" id="cr_stdate" name="cr_stdate" value="<?=$cr['cr_stdate']?>">
                             <i class="cdata">~</i>
                             <input type="date" class="input_date last" id="cr_eddate" name="cr_eddate" value="<?=$cr['cr_eddate']?>">
                             <ul class="area_filter cdata">
                                <li>
                                    <input type="checkbox" id="cr_always" name="cr_always" <?php echo $cr['cr_always'] == 'Y' ? 'checked' : ''; ?> value="<?=$cr['cr_always']?>" onclick="alwaysRecruit();">
                                    <label for="cr_always">
                                        <span></span>
                                        <em>상시채용</em>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <ul class="area_box col02">
                            <li>
                                <span>근무형태</span>
                                <input type="text" id="cr_work_type" name="cr_work_type" value="<?=$cr['cr_work_type']?>">
                            </li>
                            <li>
                                <span>직급/직책</span>
                                <input type="text" id="cr_work_position" name="cr_work_position" value="<?=$cr['cr_work_position']?>">
                            </li>
                            <li>
                                <span>연봉</span>
                                <select id="cr_work_salary" name="cr_work_salary">
                                    <?php for ($i=1; $i<=count($recruit_salary); $i++) { ?>
                                    <option value='<?=$i?>' <?php echo $cr['cr_work_salary'] == $i ? 'selected' : ''; ?>><?=$recruit_salary[$i]?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <span>근무지</span>
                                <input type="text" id="cr_work_addr" name="cr_work_addr" value="<?=$cr['cr_work_addr']?>">
                            </li>
                        </ul>
                    </li>

                    <li>
                        <em>채용공고</em>
                        <div class="area_box02">
                            <!-- 에디터 넣어주세요 -->
                            <div class="bottom" id="editor" style="display: none;"></div>
                            <textarea id="cr_contents" name="cr_contents" class="noshow"><?=$cr['cr_contents']?></textarea>
                        </div>
                    </li>
                </ul>
            </div>

            <div id="company_write" class="v2">
                <ul class="box_list">
                    <li>
                        <ul class="area_box col03">
                            <li>
                                <span>채용담당자</span>
                                <input type="text" id="cr_manager" name="cr_manager" value="<?=$cr['cr_manager']?>">
                            </li>
                            <li>
                                <span>연락처</span>
                                <input type="text" id="cr_hp" name="cr_hp" value="<?=$cr['cr_hp']?>" maxlength="13">
                            </li>
                            <li>
                                <span>이메일</span>
                                <input type="text" id="cr_email" name="cr_email" value="<?=$cr['cr_email']?>">
                            </li>
                            <li class="addr">
                                <span>회사위치</span>
                                <input type="text" id="cr_addr" name="cr_addr" value="<?=$cr['cr_addr']?>">
                                <input type="hidden" name="cr_zip" id="cr_zip" value="<?=$cr['cr_zip']?>">
                                <input type="hidden" id="cr_addr_lat" name="cr_addr_lat" value="<?=$cr['cr_addr_lat']?>">
                                <input type="hidden" id="cr_addr_lng" name="cr_addr_lng" value="<?=$cr['cr_addr_lng']?>">
                            </li>
							<li class="addr last">
							 	<span>상세주소</span>
                                <input type="text" id="cr_addr2" name="cr_addr2" value="<?=$cr['cr_addr2']?>">
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="w_filter career">
                <h3>#해시태그</h3>
                <span class="discription">회사를 소개할 수 있는 태그를 입력해 주세요.</span>
                <div class="area_tag">
                    <span class="span_tag">#</span>
                    <input style="display: inline-block;width: calc( 100% - 20px);" type="text" class="input_tag" id="input_tag" placeholder="질문에 맞는 태그를 입력해 주세요(엔터로 구분, 최대 5개)" onkeyup="add_hash(this);lengthChk(this);">
                    <ul class="tag_list">
                    <?php
                    if(!empty($cr['cr_hashtag'])) {
                        $cr_hashtag = explode(',', $cr['cr_hashtag']);
                        for($i=0; $i < count($cr_hashtag); $i++) {
                    ?>
                        <li class="tag_<?=$i+1?>"><span class="tag_word"><?=$cr_hashtag[$i]?><button type="button" class="btn_close" onclick="del_hash(<?=$i+1?>);"></button></span></li>
                    <?php } } ?>
                    </ul>
                </div>
            </div>

            <div class="area_btn two">
                <ul class="btn_list">
                <li><button type="button" class="btn_cancle" onclick="location.href='<?=G5_BBS_URL?>/career.php'">취소하기</button></li>
                <li><button type="button" class="btn_confirm" onclick="career_register();">채용공고<?=$btn_txt?></button></li>
            </ul>
            </div>
        </div>
    </form>
</div>

<!-- 다음주소 -->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <div class="add_title">
        <h2>주소찾기</h2>
        <div class="btn_close2" onclick="closeDaumPostcode()" alt="닫기 버튼">
            <span></span>
            <span></span>
        </div>
    </div>
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=$kakao_javascript_key_new?>&libraries=services"></script>
<script>
    $(function() {
        // summernote
        var editor = $('#editor').summernote({
            height: 300, //(mobilecheck())? 150 : 300,
            lang: 'ko-KR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'undo', 'redo']],
            ],
            callbacks: {
                onImageUpload:function(files){ // 이미지 업로드
                    sendFile(editor, files[0]);
                }
            }
        });

        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            prevText: '이전 달',
            nextText: '다음 달',
            changeYear: true, // 년 선택 가능
            changeMonth: true, // 월 선택 가능
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년',
            yearRange: "-100:+0"
        });

        // 수정
        $('#editor').summernote('code', $('#cr_contents').val());
    });

    // #해시태그 등록
    var num = '<?php echo (!empty($cr['he_hashtag'])) ? count($cr_hashtag)+1 : 1; ?>';
    function add_hash(data) {
        if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            // 빈칸 체크
            if($.trim(data.value).length == 0) {
                swal('태그를 입력해 주세요.');
                return false;
            }
            // 콤마 체크
            if(!isComma(data.value)) {
                swal('콤마는 입력할 수 없습니다.');
                $('#input_tag').val('');
                return false;
            }
            // 태그 체크
            if(!isTag(data.value)) {
                swal('#은 입력할 수 없습니다.');
                $('#input_tag').val('');
                return false;
            }
            // 최대 5개 처리
            if($('.tag_word').length == 5) {
                swal('최대 5개까지 등록할 수 있습니다.');
                return false;
            }
            var tag = '<li class="tag_'+num+'"><span class="tag_word">#'+data.value+'<button type="button" class="btn_close" onclick="del_hash('+num+');"></button></span></li>';
            $('.tag_list').append(tag);
            $('#input_tag').val('');
            num++;
        }
    }

    // #해시태그 삭제
    function del_hash(num) {
        $('.tag_'+num).remove();
    }

    $("#cr_addr").on("focusin", execDaumPostcode);

    // 상시채용
    function alwaysRecruit() {
        if($("input:checkbox[name=cr_always]").is(":checked")) {
            $('#cr_always').val('Y');
            $('#cr_stdate').val('');
            $('#cr_eddate').val('');
        } else {
            $('#cr_always').val('');
        }
    }

    // 질문등록
    function career_register() {
        $('#cr_contents').val(editorCheck()); // 내용

        var hashtag = '';
        $('.tag_list li span').each(function() {
            hashtag += $(this).text() + ',';
        });
        hashtag = hashtag.slice(0, -1);
        $('#cr_hashtag').val(hashtag); // 해시태그

        var f = $('#fcareer')[0];
        if($.trim(f.cr_subject.value).length == 0) {
            swal('제목을 입력해 주세요.');
            return false;
        }
        // if($.trim(f.cr_site.value).length == 0) {
        //     swal('채용공고 사이트 주소를 입력해 주세요.');
        //     return false;
        // }
        if($.trim(f.cr_stdate.value).length == 0 && $('#cr_always').val() == '') {
            swal('접수기간을 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_eddate.value).length == 0 && $('#cr_always').val() == '') {
            swal('접수기간을 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_work_type.value).length == 0) {
            swal('근무형태를 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_work_position.value).length == 0) {
            swal('직급/직책을 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_work_salary.value).length == 0) {
            swal('연봉을 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_work_addr.value).length == 0) {
            swal('근무지를 입력해 주세요.');
            return false;
        }
        if(f.cr_contents.value == "") {
            swal('채용공고 내용을 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_manager.value).length == 0) {
            swal('채용담당자를 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_hp.value).length == 0) {
            swal('연락처를 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_email.value).length == 0) {
            swal('이메일을 입력해 주세요.');
            return false;
        }
        if($.trim(f.cr_addr.value).length == 0 || f.cr_zip.value == '') { // 주소 미입력 || 우편번호 없을 시
            swal('회사위치를 입력해 주세요.');
            return false;
        }
        /*if($('.tag_word').length == 0) {
            swal('해시태그를 입력해 주세요.');
            return false;
        }*/

        $('#fcareer').submit();
    }

    /* 다음주소 */
    var element_layer = document.getElementById('layer');

    function closeDaumPostcode() {
        element_layer.style.display = 'none';
    }

    function execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                document.getElementById("cr_addr").value = data.roadAddress;
                document.getElementById("cr_zip").value = data.zonecode;
                document.getElementById("cr_addr2").focus();

                element_layer.style.display = 'none';

                // 위도/경도
                var geocoder = new kakao.maps.services.Geocoder();
                var callback = function(result, status) {
                    if (status === kakao.maps.services.Status.OK) {
                        // console.log(result[0].y);
                        // console.log(result[0].x);
                        document.getElementById("cr_addr_lat").value = result[0].y; // 위도
                        document.getElementById("cr_addr_lng").value = result[0].x; // 경도
                    }
                };
                geocoder.addressSearch(document.getElementById("cr_addr").value, callback);
            },
            width : '100%',
            height : '100%',
            maxSuggestItems : 5
        }).embed(element_layer);

        element_layer.style.display = 'block';
        initLayerPosition();
    }

    <?php
    /*
    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    */ ?>
    function initLayerPosition(){
        var width = Math.round($(window).width() * 0.9);
        var height = Math.round($(window).height() * 0.8);
        var borderWidth = 1;

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }
</script>

<script>
    $("#cr_hp").keydown(function (event) {
        var key = event.charCode || event.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 8) {
                $text.val($text.val() + '-');
            }
        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
</script>

<?
include_once('./_tail.php');
?>
