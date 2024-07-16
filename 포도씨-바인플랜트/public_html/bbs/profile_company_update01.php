<?php
include_once('./_common.php');

$g5['title'] = '기업 프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '기업');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
    .profile_top .list_step > li.active:before{width:20%;}
    .profile_content h3{text-align:center !important;}
    #join_info dl.add .input input {margin:unset !important;}
    .sector {border: unset !important;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>기업 프로필 업데이트</h3>
        <form method="post" autocomplete="off">
            <input type="hidden" id="del_file" name="del_file" value="">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li class="active">
                                <em>1</em>
                                <span>회사요약</span>
                            </li>
                            <li>
                                <em>2</em>
                                <span>회사 소개</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>인증서 및 자료</span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>취급 제품 및 브랜드</span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>해시태그</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <h4>회사명을 입력해 주세요.</h4>
                        <dl class="row">
                            <dt>한글</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_company_name" id="mb_company_name" value="<?=$member['mb_company_name']?>" class="regist-input " placeholder="회사명을 입력해 주세요." required>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>영문<em>*선택</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_company_name_eng" id="mb_company_name_eng" value="<?=$member['mb_company_name_eng']?>" class="regist-input " placeholder="회사명을 입력해 주세요.">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row add">
                            <?php $logo = sql_fetch(" select * from g5_member_img where mb_id = '{$member['mb_id']}' and category = '로고'; ")['img_file']; ?>
                            <dt>회사로고 <?php if (!empty($logo)) { ?><button type="button" onclick="file_del('<?=$member['mb_img_idx']?>');">삭제</button><?php } ?></dt>
                            <dd>

                                <div class="input">
                                    <div class="area_logo">
                                        <input type="file" name="file" id="file" onchange="getImgPrev(this);" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                        <!-- 등록 이미지 있을 때 -->
                                        <div class="p_box">
                                            <div class="img_rd">
                                                <?php if (empty($logo)) { ?>
                                                <!-- 기본이미지 -->
                                                <img class="no_img" src="<?php echo G5_THEME_IMG_URL ?>/app/logo.svg">
                                                <?php } else { ?>
                                                <img src="<?=G5_DATA_URL?>/file/company/<?=$logo?>">
                                                <?php } ?>
												<em>200px X 200px (1:1 비율)</em>
                                            </div>
                                        </div>

                                        <a class="btn_upload" href="javascript:void(0);" onclick="file_add();"><i></i>업로드</a>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>설립일</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_company_establish_date" id="mb_company_establish_date" value="<?=$member['mb_company_establish_date']?>" class="regist-input ">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>지역</dt>
                            <dd>
                                <div class="input">
                                    <select id="mb_company_si" name="mb_company_si" required>
                                        <option value="" selected >선택해주세요</option>
                                        <option value="서울">서울</option>
                                        <option value="인천">인천</option>
                                        <option value="부산">부산</option>
                                        <option value="울산">울산</option>
                                        <option value="대구">대구</option>
                                        <option value="대전">대전</option>
                                        <option value="광주">광주</option>
                                        <option value="세종">세종</option>
                                        <option value="경기(평택)">경기(평택)</option>
                                        <option value="경남(거제,창원)">경남(거제,창원)</option>
                                        <option value="경북(포항)">경북(포항)</option>
                                        <option value="전남(목포,여수)">전남(목포,여수)</option>
                                        <option value="전북(군산,부안)">전북(군산,부안)</option>
                                        <option value="충남(당진,서산)">충남(당진,서산)</option>
                                        <option value="충북">충북</option>
                                        <option value="강원">강원</option>
                                        <option value="제주">제주</option>
                                    </select>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>기업홈페이지</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_company_homepage" id="mb_company_homepage" value="<?=$member['mb_company_homepage']?>" class="regist-input ">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>업종분류</dt>
                            <dd>
                                <div class="input">
                                    <select id="mb_company_sector" name="mb_company_sector" onchange="form_check();">
                                        <option value="" selected >선택해주세요.</option>
                                        <?php for ($i=1; $i<=count($company_sectors); $i++) { ?>
                                        <option value='<?=$i?>' <?php echo $member['mb_company_sector'] == $i ? 'selected' : ''; ?>><?=$company_sectors[$i]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row add">
                            <dt>상세업종 <button type="button" onclick="add_sectors();">+추가</button></dt>
                            <dd>
                                <div class="input">
                                    <ul class="catalog_list sector_list">
                                        <?php if(empty($member['mb_company_sector_detail'])) { ?>
                                        <li class="sector_1">
                                            <button type="button" class="btn_close" onclick="del_sectors(1);"></button>
                                            <input type="text" id="mb_company_sector_detail_1" name="mb_company_sector_detail[]" class="regist-input sector" placeholder="상세업종을 입력해 주세요.">
                                        </li>
                                        <?php } ?>
                                        <?php
                                        if(!empty($member['mb_company_sector_detail'])) {
                                            $mb_company_sector_detail = explode('|', $member['mb_company_sector_detail']);
                                            for($i=0; $i<count($mb_company_sector_detail); $i++) {
                                        ?>
                                        <li class="sector_<?=$i+1?>">
                                            <button type="button" class="btn_close" onclick="del_sectors(<?=$i+1?>);"></button>
                                            <input type="text" id="mb_company_sector_detail_<?=$i+1?>" name="mb_company_sector_detail[]" value="<?=$mb_company_sector_detail[$i]?>" class="regist-input sector" placeholder="상세업종을 입력해 주세요.">
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <!-- 추가 버튼 클릭하면 인풋 생기게  (최대 10개)-->
                                    <!--<input type="text" class="regist-input " placeholder="상세업종을 입력해 주세요.">-->
                                </div>
                                <em>※사업자 등록상 업종을 기재해 주시기 바랍니다.</em>
                            </dd>
                        </dl>
                        <div class="area_btn">
                            <!-- input 다작성하면 a class="active" 추가 -->
                            <a href="jaascript:void(0);" class="btn_next">다음</a>
                            <a href="javascript:void(0);" class="btn_confirm home">수정완료</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
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

        $('#mb_company_establish_date').datepicker();

        $('#mb_company_si').val('<?=$member['mb_company_si']?>').attr("selected", "selected"); // 지역
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });
    });

    // 폼체크(필수값)
    function form_check() {
        var sector_flag = false; // 상세업종 입력 확인
        $('.sector_list li input').each(function() {
            if($.trim(this.value).length != 0) {
                sector_flag = true;
            }
        });

        if($.trim($('#mb_company_name').val()).length != 0 && $.trim($('#mb_company_establish_date').val()).length != 0 && $('#mb_company_sector').val() != "" && sector_flag) {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update("<?=$company?>");');
            $('.home').addClass('active');
            var param1 = '<?=$company?>' == 'Y' ? 'home' : 'mypage';
            $('.home').attr('href', 'javascript:profile_update("'+param1+'");');
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
            $('.home').removeClass('active');
            $('.home').attr('href', 'javascript:void(0);');
        }
    }

    // 로고 사진 삭제
    function file_del(idx) {
        $('#del_file').val(idx);
        $('#file').val('');
        $('.img_rd').html('<img class="no_img" src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png">');
    }

    // 로고 사진 등록
    function file_add() {
        $("#file").click();
    }

    // 사진 미리보기
    var filesTempArr = [];
    function getImgPrev(input) {
        var regex = /(.*?)\.(jpg|jpeg|png|PNG|bmp|JPG|gif)$/;

        if (!regex.test(input.files[0].name)) {
            swal("이미지만 등록이 가능합니다.\n(jpg/jpeg/png/bmp/gif)");
            input.value = "";
            return false;
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var div = document.createElement('div'),
                    div_img = document.createElement('div'),
                    img = document.createElement('img');
                // btn = document.createElement('button');

                var el = $(input),
                    prev_area = el.nextAll("div.p_box"),
                    file_area = el.nextAll("div.wr_files");
                if (prev_area.length > 0) prev_area.remove();
                //if (file_area.length > 0) file_area.remove();

                div.setAttribute("class", "p_box");

                div_img.setAttribute("class", "img_rd");
                img.setAttribute("class", "p_img");
                img.setAttribute("src", e.target.result);
                //img.setAttribute("style", "width:100%;height:150px;");

                // btn.setAttribute("type", "button");
                // btn.setAttribute("class", "btn");
                // btn.innerHTML = "X";

                div_img.appendChild(img);
                div.appendChild(div_img);
                // div.appendChild(btn);

                el.after(div);
            }
            reader.readAsDataURL(input.files[0]);

            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);
            filesTempArr.push(files_arr);

            if('<?=$member['mb_img_idx']?>' != '') { // 로고 변경 시
                $('#del_file').val('<?=$member['mb_img_idx']?>');
            }
        }
    }

    // 상세업종 추가
    var num = '<?php echo (!empty($member['mb_company_sector_detail'])) ? count($mb_company_sector_detail)+1 : 2; ?>';
    function add_sectors() {
        if($('.sector').length == 10) {
            swal('최대 10개까지 등록할 수 있습니다.');
            return false;
        }
        var html = '<li class="sector_'+num+'"><button type="button" class="btn_close" onclick="del_sectors('+num+');"></button><input type="text" id="mb_company_sector_detail_'+num+'" name="mb_company_sector_detail[]" class="regist-input sector" placeholder="상세업종을 입력해 주세요." onkeyup="form_check();"></li>';
        $('.sector_list').append(html);
        num++;
    }

    // 상세업종 삭제
    function del_sectors(num) {
        $('.sector_'+num).remove();
    }

    // 프로필 업데이트 - 회원소개
    function profile_update(home) {
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("file[]", filesTempArr);
        formData.append("mode", 'profile01');

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_company_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    if(home == 'home') { // 기업미니홈피 이동
                        location.href = '<?php echo G5_BBS_URL ?>/company.php?mb_no=<?=$member['mb_no']?>';
                    } else if(home == 'mypage') { // 마이페이지 이동
                        location.href = '<?php echo G5_BBS_URL ?>/mypage_company.php';
                    } else {
                        var param = '';
                        if(home == 'Y') { param = '?company=Y'; } // 기업미니홈피로 이동할 수 있는 버튼 생성 위함
                        location.href = '<?php echo G5_BBS_URL ?>/profile_company_update02.php'+param;
                    }
                }
            },
            err : function(err) {
                swal(err.status);
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>
