<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style_pro.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!--디자인 > 일러스트(삽화·캐릭터·웹툰·캐리커쳐·인물) 등록 가정시-->

<!-- 재능상품 등록하기(1.기본정보 단계) -->
<div id="pro_step">
    <!--상단카테고리-->
    <ul class="cate cf">
        <li class="active"><a href="javascript:void(0);"><span class="nm">01</span><span>기본정보</span></a></li>
        <li><a href="javascript:void(0);" onclick="move_category('pro_step02.php');"><span class="nm">02</span>가격정보</a></li>
        <li><a href="javascript:void(0);" onclick="move_category('pro_step03.php');"><span class="nm">03</span>서비스상세</a></li>
    </ul>

    <!--등록 폼 시작-->
    <div class="in">
        <form id="frmpro" method="post">
            <input type="hidden" name="mode" value="pro_step">
            <input type="hidden" id="move_mode" name="move_mode" value=""> <!-- 임시저장 or 다음단계 -->
            <input type="hidden" id="page" name="page" value=""> <!-- 이동할 탭 (01-기본정보/02-가격정보/03-서비스상세) -->
            <input type="hidden" id="page" name="tab" value="1"> <!-- 이동할 탭 (1-기본정보/2-가격정보/3-서비스상세) -->
            <input type="hidden" id="ta_idx" name="ta_idx" value="<?=$ta_idx?>">
            <input type="hidden" id="ctg_idx" name="ta_ctg_idx" value="<?=$ta['ta_ctg_idx']?>">
            <input type="hidden" id="w" name="w" value="<?=$_REQUEST['w']?>">
            <div class="form-group">
                <label for="test01">제목</label>
                <input type="text" class="form-control" id="ta_title" name="ta_title" value="<?=$ta['ta_title']?>" placeholder="재능상품을 잘 드러낼 수 있는 제목을 입력해 주세요">
            </div><!--form-group-->

            <div class="form-group cf">
                <label for="test01">카테고리 선택</label>
                <div class="part last">
                    <select class="form-control" name="ta_category1" id="ta_category1" onchange="change_category(this.value,'ctg2'); ctg_service(this.value)">
                        <option value="">1차 카테고리 선택</option>
                        <?php
                        echo common_code('ctg','code_ctg','html');
                        ?>
                    </select>
                </div>
                <div class="part last">
                    <select class="form-control" name="ta_category2" id="ta_category2" onchange="change_category(this.value,'ctg3')">
                        <option value="">2차 카테고리 선택</option>
                    </select>
                </div>
                <div class="part last">
                    <select class="form-control" name="ta_category3" id="ta_category3">
                        <option value="">3차 카테고리 선택</option>
                    </select>
                </div>
            </div><!--form-group-->
            <div class="form-group">
                <h2 class="title">서비스 방식 선택</h2>
                <div class="bx">
                    <h3 class="tit"><?=$option_list['holiday'][0]?></h3>
                    <div class="chk cf">
                        <?php for ($i =1; $i < count($option_list['holiday']); $i++){?>
                        <div class="chk_co"><input type="checkbox" name="option1[]" value="<?='holiday_'.$i?>"  id="<?='holiday_'.$i?>"><label for="<?='holiday_'.$i?>"><?=$option_list['holiday'][$i]?></label></div>
                        <?php } ?>
                    </div><!--chk-->
                    <div class="etc hide"><input type="text" class="form-control" id="" placeholder="기타항목을 작성해 주세요."></div><!--클래스명 "hide"로 감췄습니다.-->
                </div><!--bx-->
                <div id="ctg_service_div">
                    <?= $ctg_service_html ?>
                </div>
               <?php /*<div class="bx">
                    <h3 class="tit">스타일</h3>
                    <div class="chk cf">
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="bk_req1"><label for="bk_req1">프리스타일</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="bk_req2"><label for="bk_req2">유명만화캐릭터</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="bk_req3"><label for="bk_req3">애니메이션캐릭터</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="bk_req4"><label for="bk_req4">기타</label></div><!--기타를 체크시 하단에 직접 입력할 수 있는 텍스트박스가 생성됨 -->
                    </div><!--chk-->
                    <div class="etc hide"><input type="text" class="form-control" id="" placeholder="기타항목을 작성해 주세요."></div><!--클래스명 "hide"로 감췄습니다.-->
                </div><!--bx-->
                <div class="bx">
                    <h3 class="tit">파일형식</h3>
                    <div class="chk cf">
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req1"><label for="ck_req1">JPG</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req2"><label for="ck_req2">PNG</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req3"><label for="ck_req3">PSD</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req4"><label for="ck_req4">PDF</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req5"><label for="ck_req5">AI</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req6"><label for="ck_req6">SVG</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="ck_req7"><label for="ck_req7">기타</label></div><!--기타를 체크시 하단에 직접 입력할 수 있는 텍스트박스가 생성됨 -->
                    </div><!--chk-->
                    <div class="etc hide"><input type="text" class="form-control" id="" placeholder="기타항목을 작성해 주세요."></div><!--클래스명 "hide"로 감췄습니다.-->
                </div><!--bx-->
                <div class="bx">
                    <h3 class="tit">추가옵션</h3>
                    <div class="chk cf">
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req1"><label for="dk_req1">상업적이용</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req2"><label for="dk_req2">원본파일제공</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req3"><label for="dk_req3">풀컬러</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req4"><label for="dk_req4">전신그림</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req5"><label for="dk_req5">배경추가</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req6"><label for="dk_req6">인물추가</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req7"><label for="dk_req7">컷수추가</label></div>
                        <div class="chk_co"><input type="checkbox" name="reg_req[]" id="dk_req8"><label for="dk_req8">기타</label></div><!--기타를 체크시 하단에 직접 입력할 수 있는 텍스트박스가 생성됨 -->
                    </div><!--chk-->
                    <div class="etc hide"><input type="text" class="form-control" id="" placeholder="기타항목을 작성해 주세요."></div><!--클래스명 "hide"로 감췄습니다.-->
                </div><!--bx--> */?>
            </div><!--form-group-->


        </form>
    </div><!--in-->

    <!--저장 부분-->
    <div class="f_save cf">
        <div class="save hide"><a href="javascript: form_action('save');">임시저장</a></div>
        <div class="arr"><a href="javascript: form_action('next')">다음단계</a></div>
    </div><!--f_save-->

</div><!--pro_step-->
<script>
    $(function() {
        // 수정 시 1차 카테고리에 따른 2차 카테고리 리스트 및 데이터 출력
        if('<?=$ta_idx?>' != '') {
            $('#ta_category1').val('<?=$ta['ta_category1']?>').attr('selected', 'selected');
            change_category('<?=$ta['ta_category1']?>','ctg2');
            $('#ta_category2').val('<?=$ta['ta_category2']?>').attr('selected', 'selected');
            change_category('<?=$ta['ta_category2']?>','ctg3');
            $('#ta_category3').val('<?=$ta['ta_category3']?>').attr('selected', 'selected');
            ctg_service("<?=$ta['ta_category1']?>");
            //해당 옵션 체크
            <?php for ($i = 0; $i < count($arr); $i++){
                for ($a = 0; $a < count($arr[$i]); $a++){ ?>
                $("#<?=$arr[$i][$a]?>").prop("checked", true);
            <?php }
                } ?>

        }
    });

    function form_action(mode) {
        /*if (mode == 'save'){
            $("#frmpro").attr("action", g5_bbs_url+"/ajax.controller.php");
        }
        if (mode == 'next'){
            $("#frmpro").attr("action", g5_bbs_url+"/pro_step02.php");
        }*/

        $('#move_mode').val(mode);
        $("#frmpro").attr("action", g5_bbs_url+"/ajax.controller.php");

        submit_ok();

    }

    function submit_ok(){
        if ($('#ta_title').val().length < 5 ){
            swal("제목을 4글자 이상 입력해주세요.");
            $('#ta_title').focus();
            return false;
        }
        if ($('#ta_category1').val() == ""){
            swal("1차 카테고리를 선택해주세요.");
            $('#ta_category1').focus();
            return false;
        }
        if ($('#ta_category2').val() == ""){
            swal("2차 카테고리를 선택해주세요.");
            $('#ta_category2').focus();
            return false;
        }
        if ($('#ta_category3').val() == ""){
            swal("3차 카테고리를 선택해주세요.");
            $('#ta_category3').focus();
            return false;
        }

        //금지어 필터링
        var subject = $('#ta_title').val();
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": subject
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
            }
        });

        if (subject) {
            swal("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            return false;
        }

        $("#frmpro").submit();
    }

    // 탭 이동 시
    function move_category(page) {
        $('#page').val(page); // 탭 이동 시 (02-가격정보, 03-서비스상세)
        form_action('next');
        //location.href = '<?//=G5_BBS_URL?>///' + page;
    }

    // 카테고리 선택 -- 1차에 따른 2차 카테고리 분류
    function change_category(value,type) {
        // 1차 카테고리 정보
        console.log(value);

        // 레슨정보 ajax
        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {pro_ctg1: value, mode : 'pro_ctg2_common' },
            type: 'POST',
            async: false,
            success: function (data) {
                if (type == 'ctg2') {
                    $('#ta_category2').html('<option value="">2차 카테고리 선택</option>' + data);
                    $('#ta_category3').html('<option value="">3차 카테고리 선택</option>');
                }else{
                    $('#ta_category3').html('<option value="">3차 카테고리 선택</option>' + data);
                }
            },
        });
    }

    //1차 카테고리 별 서비스 방식
    function ctg_service(value) {

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {ctg: value, mode:"ctg_service"},
            type: 'POST',
            async: false,
            dataType:'html',
            success: function (data) {
                $('#ctg_service_div').html(data);
            },
        });

    }
</script>