<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style_pro.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!--디자인 > 일러스트(삽화·캐릭터·웹툰·캐리커쳐·인물) 등록 가정시-->

<!-- 재능상품 등록하기(1.기본정보 단계) -->
<div id="pro_step" class="register_contest">

    <!--등록 폼 시작-->
    <div class="in">
        <form id="frmpro" method="post">
            <input type="hidden" id="cp_idx" name="cp_idx" value="<?=$cp_idx?>">

            <div class="form-group">
                <label for="test01">제목</label>
                <input type="text" class="form-control" id="cp_title" name="cp_title" value="<?=$cp['cp_title']?>" placeholder="공모전을 잘 드러낼 수 있는 제목을 입력해 주세요">
            </div><!--form-group-->
            
            <div class="form-group">
                <label for="test01">총 상금</label>
                <input type="text" class="form-control" id="cp_reward" name="cp_reward" onkeyup="add_comma(this)" value="<?=$cp['cp_reward']?>" placeholder="단위: 만원">
                <p style="float: right">만원</p>
            </div><!--form-group-->
            
            <div class="form-group">
                <label for="test01">공모전 마감일</label>
                <dl class="row">

                    <dd style="margin-left: 15px">
                        <select name="year" onchange="last_day()" class="<?php echo $required ?>" id="year" title="연도">
                            <option value = "<?=date('Y',strtotime(G5_TIME_YMD))?>"><?=date('Y',strtotime(G5_TIME_YMD))?></option>
                            <option value = "<?=date('Y',strtotime(G5_TIME_YMD)+1)?>"><?=date('Y',strtotime(G5_TIME_YMD))+1?></option>
                        </select>
                    </dd>
                    <dd>
                        <select name="month" onchange="last_day()" class="<?php echo $required ?>" id="month" title="월">
                            <option value="">월</option>
                            <?php for ($i = 1; $i <= 12; $i++){
                                if ($i < 10){
                                    $number = "0"."".$i;
                                }else{
                                    $number = $i;
                                }
                                echo '<option value="'.$number.'">'.$number.'</option>';
                            }?>
                        </select>
                    </dd>
                    <dd>
                        <select name="day"  class="<?php echo $required ?>" id="day" title="일">
                            <option value = "">일</option>
                        </select>
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
            </div><!--form-group-->
            <div class="form-group">
                <label for="test01">상호명</label>
                <input type="text" class="form-control" id="cp_company_name" name="cp_company_name" value="<?=$cp['cp_company_name']?>" placeholder="디자인에 사용하실 상호명을 입력해주세요.">
            </div><!--form-group-->


            <div class="form-group">
                <label for="test01">서비스 설명</label>
                <input type="text" class="form-control" id="cp_company_explain" name="cp_company_explain" value="<?=$cp['cp_company_explain']?>" placeholder="의뢰인분께서 종사 또는 운영중이신 업무의 성격이나 개요등을 입력해주세요.">
            </div><!--form-group-->

            <div class="form-group cf">
                <label for="test01">카테고리 선택</label>
                <div class="part last">
                    <select class="form-control" name="cp_category1" id="cp_category1" onchange="change_category(this.value);">
                        <option value="">1차 카테고리 선택</option>
                        <?php
                        echo common_code('competition_ctg','code_ctg','html');
                        ?>
                    </select>
                </div>
                <div class="part last">
                    <select class="form-control" name="cp_category2" id="cp_category2">
                        <option value="">2차 카테고리 선택</option>
                    </select>
                </div>
            </div><!--form-group-->
            
            <div class="form-group">
                <h2 class="title">이미지 첨부하기</h2>
                <div class="img_up">
                    <strong class="tit">메인이미지 등록</strong><a data-toggle="modal" data-target="#myModal_mg1" class="img_tip">TIP!</a>
                    <div class="size">300픽셀 해상도 이상의 이미지</div>
                    <ul class="mainType" id="mainType_img">
                        <div id="prev_area">
                            <?php
                            $sql = "select * from {$g5['board_file_table']} where wr_id = '{$cp_idx}' and bo_table = 'competition_main' ";
                            $result =sql_query($sql);
                            for($i = 0; $row = sql_fetch_array($result); $i++){
                                $main_file = G5_DATA_PATH.'/file/competition_main/'.$row['bf_file'];
                            if (file_exists($main_file)){
                                $html = "<li id ='p_box_" . $row['bf_idx'] . "'><a href=\"javascript:;\">";
                                $html .= "<div class=\"img\"><img src='" . G5_DATA_URL.'/file/competition_main/'.$row['bf_file'] . "' alt=\"\"></div>";
                                $html .= "<div onclick=\"btn_image_del(this," . "''" . ")\" id ='btn_del_" . $row['bf_idx'] . "' class='del btn_del'><img src=\"".G5_THEME_IMG_URL."/main/btn_sfile_del.png\" alt='삭제'></div>";
                                $html .= "</a></li>";
                                echo $html;
                              }
                            } ?>
                        </div>
                        <li onclick="file_add('')" class="addFiles" id="li_list_img"><!--이미지 등록 전-->
                        </li>
                    </ul>
                </div><!--img_up-->

                <div class="img_up">
                    <strong class="tit">선호하는 디자인 스타일 (최대 3장 까지 업로드 가능)</strong><a data-toggle="modal" data-target="#myModal_mg2" class="img_tip">TIP!</a>
                    <div class="size">규격 없음<strong class="img_limit"><span id="subservice_detail_count"><?= number_format($sub_img_cnt['cnt']) ?></span> / 3</strong></div>
                    <ul class="mainType" id="mainType_img">
                        <div id="subprev_area">
                            <?php
                            $sql = "select * from {$g5['board_file_table']} where wr_id = '{$cp_idx}' and bo_table = 'competition_sub' ";
                            $result =sql_query($sql);
                            for($i = 0; $row = sql_fetch_array($result); $i++){
                                $main_file = G5_DATA_PATH.'/file/competition_sub/'.$row['bf_file'];
                                if (file_exists($main_file)){
                                    $html = "<li id ='subp_box_" . $row['bf_idx'] . "'><a href=\"javascript:;\">";
                                    $html .= "<div class=\"img\"><img src='" . G5_DATA_URL.'/file/competition_sub/'.$row['bf_file'] . "' alt=\"\"></div>";
                                    $html .= "<div onclick=\"btn_image_del(this," . "'sub'" . ")\" id ='subbtn_del_" . ($row['bf_idx']) . "' class='del subbtn_del'><img src=\"".G5_THEME_IMG_URL."/main/btn_sfile_del.png\" alt='삭제'></div>";
                                    $html .= "</a></li>";
                                    echo $html;
                                }
                            } ?>
                        </div>
                        <li onclick="file_add('sub')" class="addFiles" id="li_list_img"></li><!--이미지 등록 전-->
                    </ul>
                </div><!--img_up-->
            </div>
            
            <div class="form-group">
                <label for="test01">디자인 참고자료</label>
                <div class="txt_bx">
                <textarea name="cp_logo_sty" id="cp_logo_sty" class="form-control txt doc_text" rows="5" placeholder="예) 참신함, 간결함, 블루계열 등 참고로 할만한 문구를 콤마로 분류해서 입력해주세요"><?=$cp['cp_logo_sty']?></textarea>
                    <!--텍스트입력시 카운트가 올라감-->
                </div>
            </div><!--form-group-->
                        
            <div class="form-group">
                <label for="test01">공모전 상세내용</label>
                <div class="txt_bx">
                <textarea name="cp_logo_content" id="cp_logo_content" class="form-control txt doc_text" rows="5" placeholder="공모전에 필요한 상세 설명을 입력해주세요. 외부연락처(전화번호 및 카톡ID, 이메일, 외부링크)는 노출하실 수 없습니다."><?=$cp['cp_logo_content']?></textarea>
                    <div class="text_limit"><span id="cp_logo_content_count"><?=mb_strlen($cp['cp_logo_content'],'utf-8') > 0  ? mb_strlen($cp['cp_logo_content'],'utf-8'): "0";?></span> / 최소 100자</div>
                    <!--텍스트입력시 카운트가 올라감-->
                </div>
            </div><!--form-group-->

             


        </form>
    </div><!--in-->

    <!--저장 부분-->
    <div class="f_save cf">
        <div class="save hide"><a href="javascript: form_action('save');">임시저장</a></div>
        <div class="arr"><a href="javascript: form_action('next')">등록완료</a></div>
    </div><!--f_save-->

</div><!--pro_step-->
<script>
    $(function() {
        // 수정 시 1차 카테고리에 따른 2차 카테고리 리스트 및 데이터 출력
        if('<?=$cp_idx?>' != '') {
            //일자 셋팅
            $('#day').html('<?=last_day($date[0],$date[1])?>');

            $('#cp_category1').val('<?=$cp['cp_category1']?>').attr('selected', 'selected');
            change_category('<?=$cp['cp_category1']?>');
            $('#cp_category2').val('<?=$cp['cp_category2']?>').attr('selected', 'selected');


            $('#year').val('<?=$date[0]?>').attr('selected', 'selected');
            $('#month').val('<?=$date[1]?>').attr('selected', 'selected');
            $('#day').val('<?=$date[2]?>').attr('selected', 'selected');


        }
    });

    function form_action(mode) {

        $("#frmpro").attr("action", g5_bbs_url+"/ajax.competition.php");
        submit_ok();

    }

    function submit_ok(){

        if(removeComma($("#cp_reward").val())+"0000" > <?=$member['mb_6']?>){
            swal("보유금액보다 총상금을 많이 설정할 수 없습니다.");
            return false;
        }

        if ( $('#year').val() == "" || $('#month').val() == "" || $('#day').val() == "" ){
            swal("마감일을 입력해주세요.");
            $('#year').focus();
            return false;
        }

        if ( "<?=date('Y-m-d',strtotime(G5_TIME_YMDHIS))?>" > $('#year').val() + "-" +$('#month').val()+ "-" +$('#day').val()){
            swal("마감일을 다시한번 확인해주세요.");
            $('#year').focus();
            return false;
        }

        if ($('#cp_title').val().length < 5 ){
            swal("제목을 4글자 이상 입력해주세요.");
            $('#cp_title').focus();
            return false;
        }
        if ($('#cp_category1').val() == ""){
            swal("상위 카테고리를 선택해주세요.");
            $('#cp_category1').focus();
            return false;
        }
        if ($('#cp_category2').val() == ""){
            swal("하위 카테고리를 선택해주세요.");
            $('#cp_category2').focus();
            return false;
        }

        if($("[id^='btn_del']").length == 0 ){
            swal("메인이미지를 1장 이상 등록해주세요.");
            return false;
        }

        if ($('#cp_logo_content_count').text() < 100){
            swal("공모전 상세내용을 100자 이상 입력해주세요.");
            return false;
        }

        //금지단어 필터링
        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": $("#cp_title").val(),
                "content": $("#cp_logo_content").val()
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
            swal("공모전 상세내용에 금지단어('"+content+"')가 포함되어있습니다");
            return false;
        }

        var confirm_is = true;
        if ($("#cp_reward").val().length > 3){
            var confirm_is = confirm("상금은 만원 단위입니다. "+$("#cp_reward").val()+"만원으로 공모전을 등록하시겠습니까?");
        }
        if (confirm_is) {
            form_ajax();
        }

    }

    function removeComma(str)

    {
        n = parseInt(str.replace(/,/g,""));
        return n;
    }


    // 카테고리 선택 -- 1차에 따른 2차 카테고리 분류
    function change_category(value) {
        // 1차 카테고리 정보
        console.log(value);

        // 레슨정보 ajax
        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {pro_ctg1: value, mode : 'pro_ctg2_common' },
            type: 'POST',
            async: false,
            success: function (data) {

                $('#cp_category2').html('<option value="">2차 카테고리 선택</option>' + data);

            },
        });
    }


    var file_idx = 0;
    var subfile_idx = 0;
    function file_add(id) {
        var leng = $("." + id + "btn_del").size();

        if (id == '') {
            var input_id = "image" + file_idx;
            upload = $('<input type="file" name="image[]" class="frm_file" id="' + input_id + '" onchange="getImgPrev(this,' + "'" + id + "'" + ')" accept="image/*" >');

        } else {
            var input_id = id + "image" + subfile_idx;
            upload = $('<input type="file" name="image[]" class="frm_file" id="' + input_id + '" multiple onchange="getImgPrev(this,' + "'" + id + "'" + ')" accept="image/*" >');

        }



        // $("#" + id + "file_input").after(upload);
        upload.trigger('click');
        // file_idx++;

    }

    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    var subbox_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input, id) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $("." + id + "btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);
        var count = 0;

        if (id == 'sub'){
            count = 3;
            if (leng + input.files.length > count) {
                swal('최대 '+count+'개까지 등록 가능 합니다.');
                return false
            }
        }
        //이미지 현재 개수에 파일 추가 하는 것 만큼 더해주기
        $('#'+id+'service_detail_count').html($('#'+id+'service_detail_count').text()*1+input.files.length);

        for (var i = 0; i < input.files.length; i++) {
            // img_idx++;

            var file_name = input.files[i].name.toLowerCase();
            if (!reg_ext.test(file_name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }
            if (id == '') {
                filesTempArr.push(files_arr[i]);
            } else {
                subfilesTempArr.push(files_arr[i]);
            }

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (id == '') {
                        box_idx++;
                        idx = box_idx;
                    } else {
                        subbox_idx++;
                        idx = subbox_idx;
                    }

                    var html = "<li id ='" + id + "p_box_" + idx + "'><a href=\"javascript:;\">";
                    html += "<div class=\"img\"><img src='" + e.target.result + "' alt=\"\"></div>"
                    html += "<div onclick=\"btn_image_del(this," + "'" + id + "'" + ")\" id ='" + id + "btn_del_" + (idx) + "' class='del "+id+"btn_del'><img src=\"<?php echo G5_THEME_IMG_URL ?>/main/btn_sfile_del.png\" alt='삭제'></div>";
                    html += "</a></li>"
                    if (id == 'sub') {
                        $('#' + id + 'prev_area').append(html);
                    }else{
                        $('#' + id + 'prev_area').html(html);

                    }
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
        // console.log(filesTempArr)
    }

    var filesTempArr = [];
    var subfilesTempArr = [];
    var update_sub_idx = [];
    var update_main_idx = [];
    function btn_image_del(f, id) {
        var btn_del = document.getElementById(f.id),
            file_idx = btn_del.id.split('_');
        //splice하면 index꼬여서 delete처리함.
        if (id == '') {
            delete filesTempArr[(file_idx[2] - 1)];
            update_main_idx.push(file_idx[2]);

        } else {
            delete subfilesTempArr[(file_idx[2] - 1)];
            //이미 있는 파일 삭제
            update_sub_idx.push(file_idx[2]);
        }

        //파일 딜리트하면 현재개수에서 -1
        $('#'+id+'service_detail_count').html($('#'+id+'service_detail_count').text()-1);

        $('#' + id + 'p_box_' + file_idx[2]).html('');
        $('#' + id + 'p_box_' + file_idx[2]).css('display', 'none');
    }


    var is_post = false;
    function form_ajax() {
        var form = $('#frmpro')[0];
        var formData = new FormData(form);

        // if (is_post) {
        //     swal("재능등록이 진행 중입니다. 잠시만 기다려 주세요.");
        //     return false;
        // }
        // is_post = true;

        //메인 사진은 하나만 담기
        formData.append("bf_file[]", filesTempArr[filesTempArr.length-1]);

        for (var i = 0; i < subfilesTempArr.length; i++) {
            formData.append("subbf_file[]", subfilesTempArr[i]);
        }

        formData.append("mode", "competition_form");
        formData.append("update_sub_idx", update_sub_idx);
        formData.append("update_main_idx", update_main_idx);


        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.competition.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                if (data == 1) {
                    var category1 = $("#cp_category1 option:checked").text();
                    var category2 = $("#cp_category2 option:checked").text();
                    swal("공모전 등록이 완료되었습니다.")
                        .then(() => {
                            location.href = g5_bbs_url + '/contest_list.php?category1=' + category1 + '&category2=' + category2;
                        });

                } else {
                    is_post = false;
                    alert("통신에 실패했습니다.");
                }
            },
            err: function (err) {
                alert(err.status);
            }
        });

    }

    // textarea 글자 수 체크
    $('.doc_text').keyup(function (e) {
        var content = $("textarea#"+this.id).val();
        $('#'+this.id+'_count').text("" + content.length); // 글자 수 실시간 카운팅

        if(this.id.indexOf('company_explain') != -1) { // 제목
            if (content.length > 200) {
                swal("최대 200자까지 입력 가능합니다.");
                var content_slice = content.slice(0, 200);
                $("textarea#"+this.id).val(content_slice);
            }
        }

    });

    //콤마찍기
    function add_comma(x) {
        // console.log();
        var price = x.value;
        price = price.replace(/[^0-9]/g,'');   // 입력값이 숫자가 아니면 공백
        price = price.replace(/,/g,'');          // ,값 공백처리
        $('#'+x.id).val(number_format(price)); // 정규식을 이용해서 3자리 마다 , 추가
    }
    function last_day() {

        var year = $('#year').val();
        var month = $('#month').val();

        if(month == ""){
            $('#day').html('<option value="">일</option>');
            return false;
        }

        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.competition.php",
            data: {"year": year, "month":month, "mode": "last_day_ajax"},
            type: 'POST',
            datatype: 'html',
            success: function (data) {
                $('#day').html(data);
            },
            err: function (err) {
                alert(err.status);
            }
        });

    }
</script>