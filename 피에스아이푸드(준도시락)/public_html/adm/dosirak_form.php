<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '등록';
}
else if ($w == 'u')
{
    $html_title = '수정';
    $do = sql_fetch(" select * from g5_dosirak where idx = '{$idx}' ");
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '메뉴'.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<link rel="stylesheet" href="<?php echo G5_URL ?>/plugin/powerful-calendar/theme.css">
<link rel="stylesheet" href="<?php echo G5_URL ?>/plugin/powerful-calendar/style.css">

<form name="fdosirak" id="fdosirak" action="./dosirak_form_update.php" onsubmit="return fdosirak_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" id="del_file_idx" name="del_file_idx" value="<?=$idx?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="8%">
        <col width="*">
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="do_category">구분<?php echo $sound_only ?></label></th>
        <td>
            <select id="do_category" name="do_category" onchange="changeCate(this.value);">
                <option value="정기배달" <?php echo $do['do_category'] == '정기배달' ? 'selected' : ''; ?>>정기배달</option>
                <option value="행사용" <?php echo $do['do_category'] == '행사용' ? 'selected' : ''; ?>>행사용</option>
                <!--<option value="발열" <?php /*echo $do['do_category'] == '발열' ? 'selected' : ''; */?>>발열</option>-->
                <option value="샐러드팩" <?php echo $do['do_category'] == '샐러드팩' ? 'selected' : ''; ?>>샐러드팩</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="do_name">메뉴명<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="do_name" value="<?php echo $do['do_name'] ?>" id="do_name" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="do_price">금액<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="do_price" value="<?php echo !empty($do['do_price']) ? number_format($do['do_price']) : ''; ?>" id="do_price" class="frm_input" size="30" onkeyup="commaNumber(this);">원
        </td>
    </tr>
    <!--<tr>
        <th scope="row"><label for="do_shipping_fee">배송비<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="text" name="do_shipping_fee" value="<?php /*echo !empty($do['do_shipping_fee']) ? number_format($do['do_shipping_fee']) : ''; */?>" id="do_shipping_fee" class="frm_input" size="30" onkeyup="commaNumber(this);">원
        </td>
    </tr>-->
    <!--<tr>
        <th scope="row"><label for="do_delivㅇery_time">배달가능시간<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="text" name="do_delivery_time" value="<?php /*echo $do['do_delivery_time'] */?>" id="do_delivery_time" class="frm_input" size="30">
        </td>
    </tr>-->
    <!--<tr>
        <th scope="row"><label for="do_min_delivery_cnt">최소배달개수<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="text" name="do_min_delivery_cnt" value="<?php /*echo $do['do_min_delivery_cnt'] */?>" id="do_min_delivery_cnt" class="frm_input" size="30">개
        </td>
    </tr>-->
    <!--<tr>
        <th scope="row"><label for="do_warm">발열도시락<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="checkbox" name="do_warm" <?php /*echo $do['do_warm'] == 'Y' || $w == "" ? 'checked' : ''; */?> value="<?php /*echo $do['do_warm'] */?>" id="do_warm" class="frm_input">
            * 선택 시 발열도시락 변경 옵션이 추가됩니다.
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="do_add_price">발열도시락추가금액<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="checkbox" name="do_add_price" <?php /*echo $do['do_add_price'] == 'Y' ? 'checked' : ''; */?> value="<?php /*echo $do['do_add_price'] */?>" id="do_add_price" class="frm_input">
            * 선택 시 발열도시락 변경 시 추가 금액 1,000원이 적용됩니다.
        </td>
    </tr>-->
    <tr>
        <th scope="row"><label for="do_contents">메뉴설명<?php echo $sound_only ?></label></th>
        <td>
            <textarea id="do_contents" name="do_contents" style="resize: unset;width: 500px;"><?=str_replace("<br />","", nl2br($do['do_contents']))?></textarea>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_id">메뉴이미지<?php echo $sound_only ?></label></th>
        <td>
            <div class="area_box">
                <div id="file_area" class="img_wrap btn_upload">
                    <button type="button" onclick="fileAdd();">파일선택</button>
                    <input type="file" name="file" id="file" onchange="fileSelect(this);" multiple accept="image.*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
                </div>
                <div class="file_list" style="margin-top: 10px;">
                    <?php
                    $file_cnt = sql_fetch(" select count(*) as count from g5_dosirak_img where dosirak_idx = {$idx}; ")['count'];
                    if($file_cnt > 0) {
                        $file_result = sql_query(" select * from g5_dosirak_img where dosirak_idx = {$idx} order by idx; ");

                        for($i=0; $row=sql_fetch_array($file_result); $i++) {
                            $img_src = G5_DATA_URL.'/file/dosirak/'.$row['img_file'];
                        ?>
                        <span style="float:left;margin-right: 5px;" class="img_<?=$i?>">
                            <input type="hidden" id="img_idx_<?=$i?>" value="<?=$row['idx']?>">
                            <p style="padding-bottom: 5px;"><img src="<?=$img_src?>" style="width: 100px; height: 100px;"></p>
                            <button type="button" class="btn_del" onclick="fileDelete('<?=$i?>', 'u');" style="position: relative;">삭제</button>
                        </span>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </td>
    </tr>
    <?php if($private) { ?>
    <!--<tr>
        <th scope="row"><label for="rider_color">배송기사앱 표시색상<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="color" class="frm_input" name="rider_color" id="rider_color" value="<?/*=$do['rider_color']*/?>"/>
        </td>
    </tr>-->
    <?php } ?>

    <!--23.06.27 주문불가능시간/주문불가능일자 설정-->
    <tr>
        <th scope="row"><label for="rider_color">주문불가능시간<?php echo $sound_only ?></label></th>
        <td>
            <input type="time" name="no_st_time" value="<?=$do['no_st_time']?>"> ~ <input type="time" name="no_ed_time" value="<?=$do['no_ed_time']?>">
            * 설정된 시간에는 주문이 불가능합니다.
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="rider_color">주문불가능일자<?php echo $sound_only ?></label></th>
        <td>
            <input type="hidden" name="no_date" value="<?=$do['no_date']?>">
            <div class="area_calendar" style="width: 50%;">
                <div class="order_calendar"></div>
            </div>
            * 설정된 일자에는 주문이 불가능합니다.
        </td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <!--<input type="submit" value="<?/*=$html_title*/?>" class="btn_submit" accesskey='s'>-->
    <input type="button" value="<?=$html_title?>" class="btn_submit" accesskey='s' onclick="fdosirak_submit($('form')[0]);">
    <a href="./dosirak_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<style>
    .order_calendar .check span {
        background: #333;
        color: #fff;
        display: inline-block;
        border-radius: 50%;
    }
</style>
<script src="<?=G5_PLUGIN_URL?>/powerful-calendar/calendar.adm.js?v=<?=G5_JS_VER?>"></script> <!--주문달력-->
<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script>
    let selectedNoDate = []; // 주문불가능일자 선택
    var cur_date = new Date();
    var weekday = new Array('일', '월', '화', '수', '목', '금', '토');
    $(function() {
        if('<?=$w?>' == 'u') selectedNoDate = document.querySelector('[name=no_date]').value.split(',');

        var curr = new Date();
        var utc = curr.getTime() + (curr.getTimezoneOffset() * 60 * 1000);
        // UTC to KST (UTC + 9시간)
        var KR_TIME_DIFF = 9 * 60 * 60 * 1000;
        cur_date = new Date(utc + (KR_TIME_DIFF));
        // console.log("한국시간 : " + cur_date);

        setTimeout(function() {
            // 달력
            $('.order_calendar').calendar({
                prevButton: "이전",
                nextButton: "다음",
                showTodayButton: false,
                todayButtonContent: "오늘",
                highlightSelectedWeek: false,
                highlightSelectedWeekday: false,
                date: cur_date,
                onClickDate: function (date) {
                    var today = cur_date.getFullYear() + '-' + addZero(cur_date.getMonth() + 1) + '-' + addZero(cur_date.getDate()); // 오늘
                    var chk_date = new Date(date); // 선택 날짜
                    var year = chk_date.getFullYear();
                    var month = chk_date.getMonth() + 1;
                    var day = chk_date.getDate();

                    // let selectedDate = year + '-' + addZero(month) + '-' + addZero(day); // 선택일
                    // selectedNoDate.push(selectedDate);
                },
            });
        }, 150);
    });

    // 구분 변경 (정기배달은 발열도시락이 기본 옵션)
    function changeCate(cate) {
        if(cate != "정기배달") {
            $("#do_warm").attr("checked", false);
        } else {
            $("#do_warm").attr("checked", true);
        }
    }

    var fileList = []; // 파일 정보를 담아둘 배열
    var fileCount = '<?=$file_cnt?>' == 0 ? 0 : '<?=$file_cnt?>';

    // 파일추가 버튼 클릭
    function fileAdd() {
        $("#file").click();
    }

    // 파일 선택
    function fileSelect(input) {
        if (input.files && input.files[0]) {
            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);

            for (var i = 0; i<input.files.length; i++) {
                var f = files_arr[i];

                var fileName = f.name;
                var reg_ext = /(.*?)\.(jpg|jpeg|png|PNG|bmp|gif|JPG)$/;
                if (!reg_ext.test(fileName)) {
                    swal("확장자를 확인해 주세요.");
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                var fileSize = f.size;
                var maxSize = 10 * 1024 * 1024; // 최대 10MB
                if(fileSize > maxSize) {
                    swal('파일이 최대 용량 10MB를 초과합니다.');
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                fileList.push(f);

                // 파일 새창 미리보기
                var reader = new FileReader();
                reader.onload = function(e) {
                    var tag = "";
                    tag += '<span style="float:left;margin-right: 5px;" class="img_'+fileCount+'">' +
                           '<p style="padding-bottom: 5px;"><img src="'+e.target.result+'" style="width: 100px; height: 100px;"></p>' +
                           '<button type="button" class="btn_del" onclick="fileDelete('+fileCount+');" style="position: relative;">삭제</button>' +
                           '</span>';
                    $('.file_list').append(tag);

                    fileCount++;
                }
                reader.readAsDataURL(f);
            }
        }
    }

    // 파일 삭제
    var delFileIdx = '';
    function fileDelete(num, mode) {
        if(mode == 'u') {
            delFileIdx += $('#img_idx_'+num).val() + ',';
        }
        $('.img_'+num).remove();
    }

    // 등록/수정
    var is_post = false;
    function fdosirak_submit(f) {
        if(is_post) {
            is_post = false;
        }
        is_post = true;

        $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 이미지 삭제

        // 유효성체크
        if(f.do_name.value.length == 0) {
            alert('메뉴명을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if(f.do_price.value.length == 0 || f.do_price.value == 0) {
            alert('금액을 입력해 주세요.');
            is_post = false;
            return false;
        }
        /*if(f.do_delivery_time.value.length == 0) {
            alert('배달가능시간을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if(f.do_min_delivery_cnt.value.length == 0) {
            alert('최소배달개수를 입력해 주세요.');
            is_post = false;
            return false;
        }*/
        if(f.do_contents.value.length == 0) {
            alert('메뉴설명을 입력해 주세요.');
            is_post = false;
            return false;
        }

        // 발열도시락여부
        if($("input:checkbox[name=do_warm]:checked").length == 0) {
            $('#do_warm').val('N');
        } else {
            $('#do_warm').val('Y');
        }

        // 발열도시락추가금액여부
        if($("input:checkbox[name=do_add_price]:checked").length == 0) {
            $('#do_add_price').val('N');
        } else {
            $('#do_add_price').val('Y');
        }

        var form = $('#fdosirak')[0];
        var formData = new FormData(form);
        if(fileList.length > 0){ // 파일 업로드
            fileList.forEach(function(f){
                formData.append("files[]", f);
            });
        }

        // 주문불가능일자
        selectedNoDate = selectedNoDate.sort();
        formData.append("no_date", selectedNoDate.join(','));

        $.ajax({
            url : g5_admin_url + "/ajax.dosirak_form_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data) {
                   alert('메뉴<?=$html_title?>이 완료되었습니다.');
                   location.replace('./dosirak_list.php');
                }
            },
            err : function(err) {
                alert(err.status);
            }
        });

        return true;
    }
</script>

<?php
include_once('./admin.tail.php');
?>
