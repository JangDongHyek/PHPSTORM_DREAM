<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);



check_device($board['bo_device']);
$sql = "select * from g5_write_cucenter where wr_id = '{$wr_id}' ";
$write = sql_fetch($sql);
$content = $write["wr_content"];


//이미지
$bo_table = "cucenter";
$sql = "select * from g5_board_file where bo_table = '{$bo_table}' and wr_id = '{$write["wr_id"]}' ";
$file = sql_fetch($sql)["bf_file"];
$img = "";
if (file_exists(G5_DATA_PATH."/file/".$bo_table."/".$file) && $file != ""){
    $img ="<img style = 'width:100px' src = '".G5_DATA_URL."/file/".$bo_table."/".$file."' >";
}

//수강생 리스트
$sql = "select * from new_cucenter_member where cm_wr_id = '{$write["wr_id"]}' ";
$cm_result = sql_query($sql);
//접수인원
$sql = "select * from new_enrolment where wr_id = '{$write["wr_id"]}' and e_is_wait = 'N' order by e_idx desc ";
$e_result = sql_query($sql);
$sql = "select * from new_enrolment where wr_id = '{$write["wr_id"]}' and e_is_wait = 'Y' order by e_idx desc ";
$y_e_result = sql_query($sql);

$is_dhtml_editor = false;
$is_dhtml_editor_use = false;
$editor_content_js = '';
if(!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)
    $is_dhtml_editor_use = true;

// 모바일에서는 G5_IS_MOBILE_DHTML_USE 설정에 따라 DHTML 에디터 적용
if ($config['cf_editor'] && $is_dhtml_editor_use && $board['bo_use_dhtml_editor'] && $member['mb_level'] >= $board['bo_html_level']) {
    $is_dhtml_editor = true;

    if(is_file(G5_EDITOR_PATH.'/'.$config['cf_editor'].'/autosave.editor.js'))
        $editor_content_js = '<script src="'.G5_EDITOR_URL.'/'.$config['cf_editor'].'/autosave.editor.js"></script>'.PHP_EOL;
}
$editor_html = editor_html('wr_content', $content, $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('wr_content', $is_dhtml_editor);
$editor_js .= chk_editor_js('wr_content', $is_dhtml_editor);

set_session('ss_bo_table',$bo_table);
set_session('ss_wr_id', $_REQUEST['wr_id']);

$g5['title'] = '강좌등록';
include_once('./admin.head.php');

$action_url = https_url(G5_ADMIN_DIR)."/write_update.php";



?>

<style>
    .btn_cl{
        margin-left: 5px; border: 1px solid #951015;
    }

    .th_cls{
        text-align: center!important;
        padding: 5px!important;

    }
</style>
<section id="bo_w" class="inr">

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
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
        <input type="hidden" name="del_arr" value="">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <tbody>
                <tr>
                    <th scope="row"><label for="wr_8">강좌타입<strong class="sound_only">필수</strong></label></th>
                    <td>
                       <select name="wr_8">
                           <option <?php if ($write["wr_8"] == '1') echo "selected" ?>  value="1">성인강좌</option>
                           <option <?php if ($write["wr_8"] == "2") echo "selected" ?>  value="2">어린이강좌</option>
                       </select>
                        <strong style="margin-left: 100px; margin-right: 15px">재수강여부</strong>
                        <span>예(수강인원 설정)<input style=" margin-left: 5px" onclick="span_display('M')" type="radio" name="wr_10" value="M"></span>
                        <span>예(수강생 설정)<input style=" margin-left: 5px" onclick="span_display('Y')" type="radio" name="wr_10" value="Y"></span>
                        <span style="margin-left: 10px;">아니오<input style=" margin-left: 5px" onclick="span_display('N')" type="radio" name="wr_10" value="N"></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <div id="autosave_wrapper">
                            <input type="text" name="wr_subject" value="<?php echo $write['wr_subject'] ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_subject">썸네일<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <div id="autosave_wrapper">
                            <input type="file" name="bf_file[]" accept="image/*" >
                        </div>
                    </td>
                </tr>
                <?php if ($img != ""){ ?>
                <tr>
                    <th scope="row"><label for="wr_subject">적용된 썸네일<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <?= $img?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th scope="row"><label for="wr_7">간단설명<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_7" value="<?php echo $write['wr_7'] ?>" id="wr_7" class="frm_input" size="70"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_5">수강 기간<strong class="sound_only">필수</strong></label></th>
                    <td class="writ_date">
                        <div class="dlBox">
                            <input type='text' name="wr_1" id="wr_1" class="frm_input" value="<?php echo $write[wr_1]?>"  placeholder="시작일을 선택 해 주세요." required/>
                            -
                            <input type='text' name="wr_2" id="wr_2" class="frm_input" value="<?=$write[wr_2]?>"  placeholder="종료일을 선택 해 주세요."/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_5">접수 기간<strong class="sound_only">필수</strong></label></th>
                    <td class="writ_date">
                        <div class="dlBox">
                            <input type='text' name="wr_3" id="wr_3" class="frm_input" value="<?php echo $write[wr_3]?>"  placeholder="시작일을 선택 해 주세요." required/>
                            -
                            <input type='text' name="wr_4" id="wr_4" class="frm_input" value="<?=$write[wr_4]?>"  placeholder="종료일을 선택 해 주세요."/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_5">수강 시간<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" id="wr_5" class="frm_input" size="50"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_6">수강료</label></th>
                    <td colspan="3">
                        <input onkeyup="numberWithCommas(this)" id="wr_6" name="wr_6" type="text" class="frm_input" style="width:220px;" value="<?=number_format($write["wr_6"])?>"><strong> 원</strong>
                        <span id="wr9_span" style="display: inline">
                            <strong style="margin-left: 100px; margin-right: 5px">수강인원</strong><input onkeyup="numberWithCommas(this)" id="wr_9" value="<?=$write["wr_9"]?>" name="wr_9" type="text" class="frm_input" style="width" >
                            <strong>명</strong>
                        </span>
                    </td>

                </tr>
                <tr id="member_span">
                    <th scope="row"><label for="wr_5">수강생<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input id="birds" name="member_input" type="text" class="frm_input">
                        <p style="display:inline-block"> * 해당 칸에서 이름 혹은 아이디 혹은 휴대번호 입력 후 해당 회원을 엔터 혹은 클릭으로 선택하여 리스트에 추가해주세요</p>
                        <div style="float: right;">
<!--                            <button style="border: #8aa6c1 1px solid; float: right; padding: 5px" type="button" onclick="before_member()">지난 수강생 불러오기</button>-->

                            <form id="excel_form" enctype="multipart/form-data" >
                            <input type="file" id="excelFile" style=" ">
                            <button style="border: #8aa6c1 1px solid; padding: 5px" type="button" onclick="excel_upload()">엑셀로 등록하기</button>
                            </form>
                        </div>
                        <div>
                            <table style="text-align: center;margin-top: 10px!important;">

                                <thead style="background: #e5ecef">
                                <tr>
                                    <th class="th_cls">이름</th>
                                    <th class="th_cls">아이디</th>
                                    <th class="th_cls">등급</th>
                                    <th class="th_cls">조합원번호</th>
                                    <th class="th_cls">휴대폰</th>
                                    <th class="th_cls">삭제</th>
                                </tr>
                                </thead>
                                <tbody id="member_list">
                                <?php for ($i = 0; $cm = sql_fetch_array($cm_result); $i++){

                                    $mb = get_member($cm["mb_id"]);

                                    ?>
                                    <tr id='span_<?=$cm["mb_id"]?>'>
                                        <td><?=get_text($mb['mb_name'])?></td>
                                        <td style="text-decoration:underline"><a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=<?=$mb["mb_id"]?>"><?=$mb["mb_id"]?></a></td>
                                        <td style="text-decoration:underline"><?=$level_arr[$mb["mb_level"]-1]?></td>
                                        <td style="text-decoration:underline"><?=$mb["mb_1"]?></td>
                                        <td><?=$mb['mb_hp']?></td>
                                        <td><button type='button' class="btn_cl" onclick="member_del('<?=$mb["mb_id"]?>','u')">
                                                X
                                            </button></td>
                                    </tr>


                                    <?php
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
                    <td class="wr_content">
                        <?php if($write_min || $write_max) { ?>
                            <!-- 최소/최대 글자 수 사용 시 -->
                            <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                        <?php } ?>
                        <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                        <?php if($write_min || $write_max) { ?>
                            <!-- 최소/최대 글자 수 사용 시 -->
                            <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                        <?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm"  style="margin-left: 50%">
            <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
            <a href="./culture_list.php" class="btn_cancel">취소</a>
        </div>
    </form>

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <h2>접수인원 리스트(총 <?=sql_num_rows($e_result)?>명)<button type="button" onclick="excel_down()" style="margin-left: 10px; padding: 5px; border: #8aa6c1 1px solid">엑셀 다운로드</button></h2>
        <form id="no_wait_form" action="./adm.ajax.controller.php" method="post">
            <input type="hidden" name="mode" value="no_wait_mem_update">
            <input type="hidden" name="wr_id" value="<?=$wr_id?>">
            <table style="text-align: center">

                <thead>
                <tr>
                    <th></th>
                    <th>예약상황</th>
                    <th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
                    <th>아이디</a></th>
                    <th>등급</th>
                    <th>조합원번호</th>
                    <th>휴대폰</th>
                    <th>입금확인</th>
                    <th>접수일</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $row=sql_fetch_array($e_result); $i++) {
                    $mb = get_member($row["mb_id"]);

                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <td><input type="checkbox" name="no_wait_mem_chk[]" value = "<?=$row["e_idx"]?>"></td>
                        <td><select onchange="proc_change('<?=$row["e_idx"]?>',this.value)">
                                <option <?php if ($row["e_proc"] == "comp") echo 'selected'?> value="comp">접수완료</option>
                                <option <?php if ($row["e_proc"] == "cancel") echo 'selected'?> value="cancel">취소</option>
                            </select>
                        </td>
                        <td><?=get_text($mb['mb_name'])?></td>
                        <td style="text-decoration:underline"><a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=<?=$mb["mb_id"]?>"><?=$mb["mb_id"]?></a></td>
                        <td style="text-decoration:underline"><?=$level_arr[$mb["mb_level"]-1]?></td>
                        <td style="text-decoration:underline"><?=$mb["mb_1"]?></td>
                        <td><?=$mb['mb_hp']?></td>
                        <td><input type="checkbox" id="payment_chk_<?=$row["e_idx"]?>" value="Y" <?php if ($row["payment_chk"] == "Y") echo 'checked' ?> onclick="payment_chk(<?=$row["e_idx"]?>)"></td>
                        <td><?=substr($row['wr_datetime'],2,8)?></td>
                    </tr>


                    <?php
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
            <button onclick="javascript:$('#no_wait_form').submit();" style="margin-top: 10px; padding: 5px; border: #8aa6c1 1px solid;">대기인원으로 등록</button>
        </form>
    </div>
    <div class="tbl_head02 tbl_wrap mb_tbl">
        <h2>대기접수인원 리스트(총 <?=sql_num_rows($y_e_result)?>명)</h2>
        <form id="wait_form" action="./adm.ajax.controller.php" method="post">
            <table style="text-align: center">
                <input type="hidden" name="mode" value="wait_mem_update">
                <input type="hidden" name="wr_id" value="<?=$wr_id?>">
                <thead>
                <tr>
                    <th></th>
                    <th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
                    <th>아이디</th>
                    <th>등급</th>
                    <th>조합원번호</th>
                    <th>휴대폰</th>
                    <th>접수일</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $row=sql_fetch_array($y_e_result); $i++) {
                    $mb = get_member($row["mb_id"]);

                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <td><input type="checkbox" name="wait_mem_chk[]" value = "<?=$row["e_idx"]?>"></td>
                        <td style="text-decoration:underline"><a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=<?=$mb["mb_id"]?>"><?=$mb["mb_id"]?></a></td>
                        <td style="text-decoration:underline"><?=$level_arr[$mb["mb_level"]-1]?></td>
                        <td style="text-decoration:underline"><?=$mb["mb_1"]?></td>
                        <td><?=get_text($mb['mb_name'])?></td>
                        <td><?=$mb['mb_hp']?></td>
                        <td><?=substr($row['wr_datetime'],2,8)?></td>
                    </tr>


                    <?php
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>

            <button onclick="javascript:$('#wait_form').submit();" style="margin-top: 10px; padding: 5px; border: #8aa6c1 1px solid;">접수인원으로 등록</button>
        </form>
    </div>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo G5_THEME_JS_URL ?>/ko.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
    <script>

        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년',
            minDate: 0
        });

        $(function() {
            $("#wr_1,#wr_2,#wr_3,#wr_4").datepicker();

            $("input[name='wr_6']").eq(0).click();
            span_display("<?= ($write["wr_10"] != '') ? $write["wr_10"] : "N" ?>")
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

        var del_idx = '';
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

            if ($('input[name="wr_10"]:checked').val() != "Y" && $("[name = wr_9]").val() < 1){
                alert("수강인원을 입력하세요.");
                return false;
            }

            $('input[name=del_arr]').val(del_idx.slice(0,-1));

            document.getElementById("btn_submit").disabled = "disabled";

            return true;
        }

        function numberWithCommas(x) {
            var val = x.value;
            var id = x.id;
            final_val = val.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
            final_val = final_val.replace(/,/g,''); // ,값 공백처리
            $("#"+id).val(final_val.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
        }

       function span_display(yn) {
           $("input:radio[name='wr_10']:radio[value='"+yn+"']").prop("checked", true);

           if (yn == "Y"){
               $("#member_span").css("display","table-row");
               $("#wr9_span").css("display","none");
           }else{
               $("#member_span").css("display","none");
               $("#wr9_span").css("display","inline");
           }
       }

        function member_del(id,w){
            $("#span_"+id).remove();
            if (w == "u"){
                del_idx += id + ',';
            }
            console.log(del_idx);
        }

        function log(name,id, level,number,hp ) {
            var html = "<tr id='span_"+id+"'>" +
                "<td>" + name +"</td>" +
                "<td>" + id +"</td>" +
                "<td>" + level +"</td>" +
                "<td>" + number +"</td>" +
                "<td>" + hp +"</td>" +
                "<td><button type='button' class='btn_cl' onclick=\"member_del('"+id+"')\"><input type='hidden' name='member_arr[]' value='"+id+"'>X</button></td>" +
                "</tr>";
            $("#member_list").append(html);
            $("#member_list" ).attr( "scrollTop", 0 );
        }


        $( function() {



            $.ajax({
                url: g5_admin_url + "/adm.ajax.controller.php",
                data: {"mode":"autocomplete"},
                dataType: "json",
                type: "POST",
                success: function( xmlResponse ) {

                    $( "#birds" ).autocomplete({
                        source: xmlResponse,
                        minLength: 0,
                        select: function( event, ui ) {
                            var words = ui.item.value.split("/");

                            $.ajax({
                                url: g5_admin_url + "/adm.ajax.controller.php",
                                data: {"mode": "autocomplete_select", "id": words[0]},
                                dataType: "json",
                                type: "POST",
                                success: function (xmlResponse) {

                                    log(words[0], xmlResponse["name"], xmlResponse["id_level"], xmlResponse["hp"]);
                                    setTimeout(function () {
                                        $("#birds").val("")
                                    }, 300);
                                }
                            });

                        }
                    });
                }
            });
        } );
        //엔터 시 폼넘어가는거 막기
        document.addEventListener('keydown', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            };
        }, true);

        function payment_chk(idx) {
            var payment_val = "N"

            if ( $('#payment_chk_'+idx).is(":checked") ){
                payment_val = "Y";
            }

            $.ajax({
                url: g5_admin_url+"/adm.ajax.controller.php",
                type: "POST",
                data: {
                    "idx": idx,
                    "mode": "culture_payment_chk",
                    "val" :payment_val,
                },
                success: function(data) {
                    if (data != 1){
                        alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                    }

                }
            });
        }

        function proc_change(idx,val) {
            $.ajax({
                url: g5_admin_url+"/adm.ajax.controller.php",
                type: "POST",
                data: {
                    "idx": idx,
                    "val" : val,
                    "mode": "e_proc_change"
                },
                success: function(data) {
                    if (data != 1){
                        alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                    }else{
                        alert("변경되었습니다.");
                    }

                }
            });
        }


        function excel_down() {

            location.href = g5_admin_url + '/new_culture_excel_download.php?wr_id=<?=$_REQUEST["wr_id"]?>';
        }
        function excel_upload() {
            if ($("#excelFile")[0].files[0] == undefined){
                alert("엑셀파일을 선택해주세요.");
                return false;
            }

            var formData = new FormData();
            formData.append('excelFile',$("#excelFile")[0].files[0]);

            $.ajax({
                url: g5_admin_url+"/excel_read.php",
                type: "POST",
                data: formData,
                processData : false,
                contentType : false,
                dataType: "json",
                success: function(data) {
                    var mb_id = "";
                    $.each(data, function (key,value) {

                        log(value["name"],value["id"],value["level"],value["number"], value["hp"]);
                    });


                }
            });

        }

        function before_member() {

            $.ajax({
                url: g5_admin_url+"/adm.ajax.controller.php",
                type: "POST",
                data: {
                    "idx": idx,
                    "val" : val,
                    "mode": "e_proc_change"
                },
                success: function(data) {
                    if (data != 1){
                        alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                    }else{
                        alert("변경되었습니다.");
                    }

                }
            });

        }
    </script>
</section>

