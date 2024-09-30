<?php
$sub_menu = '280100'; //'100310';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$html_title = "팝업";
if ($w == "u")
{
    $html_title .= " 수정";
    $sql = " select * from {$g5['new_win_table']} where nw_id = '$nw_id' ";
    $nw = sql_fetch($sql);
    if (!$nw['nw_id']) alert("등록된 자료가 없습니다.");
}
else
{
    $html_title .= " 등록";
    $nw['nw_device'] = 'both';
    $nw['nw_disable_hours'] = 24;
    $nw['nw_left']   = 10;
    $nw['nw_top']    = 10;
    $nw['nw_width']  = 450;
    $nw['nw_height'] = 500;
    $nw['nw_content_html'] = 2;
}

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

    <form name="frmnewwin" action="./newwinformupdate.php" onsubmit="return frmnewwin_check(this);" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="nw_id" value="<?php echo $nw_id; ?>">
        <input type="hidden" name="token" value="">

        <div class="local_desc01 local_desc">
            <p>메인에 자동으로 열리는 팝업을 설정합니다.</p>
        </div>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="nw_disable_hours">시간<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <?php echo help("고객이 다시 보지 않음을 선택할 시 몇 시간동안 팝업레이어를 보여주지 않을지 설정합니다."); ?>
                        <input type="text" name="nw_disable_hours" value="<?php echo $nw['nw_disable_hours']; ?>" id="nw_disable_hours" required class="frm_input required" size="5"> 시간
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nw_begin_time">시작일시<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="text" name="nw_begin_time" value="<?php echo substr($nw['nw_begin_time'], 0, 10); ?>" id="nw_begin_time" required class="frm_input required" size="21" maxlength="19">
                        <input type="checkbox" name="nw_begin_chk" value="<?php echo date("Y-m-d", G5_SERVER_TIME); ?>" id="nw_begin_chk" onclick="if (this.checked == true) this.form.nw_begin_time.value=this.form.nw_begin_chk.value; else this.form.nw_begin_time.value = this.form.nw_begin_time.defaultValue;">
                        <label for="nw_begin_chk">시작일시를 오늘로</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nw_end_time">종료일시<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="text" name="nw_end_time" value="<?php echo substr($nw['nw_end_time'], 0, 10); ?>" id="nw_end_time" required class="frm_input required" size="21" maxlength="19">
                        <input type="checkbox" name="nw_end_chk" value="<?php echo date("Y-m-d", G5_SERVER_TIME+(60*60*24*7)); ?>" id="nw_end_chk" onclick="if (this.checked == true) this.form.nw_end_time.value=this.form.nw_end_chk.value; else this.form.nw_end_time.value = this.form.nw_end_time.defaultValue;">
                        <label for="nw_end_chk">종료일시를 오늘로부터 7일 후로</label>
                    </td>
                </tr>

                <!--<tr>
                <th scope="row"><label for="nw_device">접속기기</label></th>
                <td>
                    <?php /*echo help("팝업레이어가 표시될 접속기기를 설정합니다."); */?>
                    <select name="nw_device" id="nw_device">
                        <option value="both"<?php /*echo get_selected($nw['nw_device'], 'both', true); */?>>PC와 모바일</option>
                        <option value="pc"<?php /*echo get_selected($nw['nw_device'], 'pc'); */?>>PC</option>
                        <option value="mobile"<?php /*echo get_selected($nw['nw_device'], 'mobile'); */?>>모바일</option>
                    </select>
                </td>
            </tr>-->

                <tr>
                    <th scope="row"><label for="nw_left">팝업 좌측 위치<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="text" name="nw_left" value="<?php echo $nw['nw_left']; ?>" id="nw_left" required class="frm_input required" size="5"> px
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nw_top">팝업 상단 위치<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="text" name="nw_top" value="<?php echo $nw['nw_top']; ?>" id="nw_top" required class="frm_input required"  size="5"> px
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nw_width">팝업 넓이<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="text" name="nw_width" value="<?php echo $nw['nw_width'] ?>" id="nw_width" required class="frm_input required" size="5"> px
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nw_height">팝업 높이<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="text" name="nw_height" value="<?php echo $nw['nw_height'] ?>" id="nw_height" required class="frm_input required" size="5"> px
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="nw_subject">팝업 제목<strong class="sound_only"> 필수</strong></label></th>
                    <td><input type="text" name="nw_subject" value="<?php echo stripslashes($nw['nw_subject']) ?>" id="nw_subject" required class="frm_input required" size="80"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="nw_link">연결URL</label></th>
                    <td><input type="text" name="nw_link" value="<?=$nw['nw_link']?>" id="nw_link" class="frm_input" size="80" maxlength="180"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="nw_content">팝업 이미지</label></th>
                    <td>
                        <input type="file" name="nw_file" accept="image/*" id="nw_file">
                        <? if ($w == "u") { ?>
                            <img src="<?=G5_DATA_URL?>/popup/<?=$nw['nw_file']?>" id="prev_img" style="margin: 10px 0; max-height: 400px;">
                            <input type="hidden" name="nw_file_old" value="<?=$nw['nw_file']?>">
                        <? } ?>
                    </td>
                </tr>

                <!--<tr>
                    <th scope="row"><label for="nw_content">내용</label></th>
                    <td><?php /*echo editor_html('nw_content', get_text($nw['nw_content'], 0)); */?></td>
                </tr>-->
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" class="btn_submit" accesskey="s">
            <a href="./newwinlist.php">목록</a>
        </div>
    </form>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script>
        var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            day_arr = ['일', '월', '화', '수', '목', '금', '토'];

        $("#nw_begin_time, #nw_end_time").datepicker({
            changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr
        });

        $("#nw_file").on("change", function() {
            if ($("#prev_img").length) {
                $("#prev_img").remove();
            }
        });

        function frmnewwin_check(f)
        {
            if (f.w.value == "" && f.nw_file.value == "") {
                alert("팝업 이미지를 등록하세요.");
                return false;
            }

            <?php echo get_editor_js('nw_content'); ?>

            /*
            errmsg = "";
            errfld = "";

            check_field(f.nw_subject, "제목을 입력하세요.");

            if (errmsg != "") {
                alert(errmsg);
                errfld.focus();
                return false;
            }
            */

            return true;
        }
    </script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
