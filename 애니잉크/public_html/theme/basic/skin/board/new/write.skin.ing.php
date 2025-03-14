<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

$list_arr = array('흑백복사기','컬러복사기','잉크젯복합기','잉크젯프린터','컬러레이져복합기','흑백레이져복합기','흑백레이져프린터','컬러레이져프린터');
$connection_type_arr = array('USB','유선네트워크','무선네트워크','USB및유선네트워크','USB및무선네트워크','블루투스');
?>

<?php
function type_list($t_row){
    global $list_arr;

    if($t_row){
        $datas = '';
        $datas .= '<tr class="nt_tr1"><td class="b_tb_td x110" rowspan="2">';
        $datas .= '<input type="hidden" name="nt_cnt[]" class="nt_cnt" value="'.$t_row['nt_idx'].'" />';
        $datas .= '<input type="text" name="nt_date[]" class="frm_input x90 nt_date" value="'.$t_row['nt_date'].'" />';
        $datas .= '</td><td class="b_tb_td"><select name="nt_list[]" class="nt_list" onchange="nt_view(this)"><option value="">선택하세요</option>';
        for($a=0; $a<count($list_arr); $a++){
            $selected = '';
            if($list_arr[$a] == $t_row['nt_list']) $selected = 'selected';
            $datas .= '<option value="'.$list_arr[$a].'" '.$selected.'>'.$list_arr[$a].'</option>';
        }
        $datas .= '</select></td><td class="b_tb_td nt1">';
        if($t_row['nt_list'] == '컬러복사기'){
            $datas .= '<label>흑백 </label>';
            $datas .= '<input type="text" name="nt_page1[]" class="frm_input x60 nt_page1" value="'.$t_row['nt_page1'].'" />';
            $datas .= '<label> 컬러 </label>';
            $datas .= '<input type="text" name="nt_page1_2[]" class="frm_input x60 nt_page1_2" value="'.$t_row['nt_page1_2'].'" /></td>';
        }else{
            $datas .= '<input type="text" name="nt_page1[]" class="frm_input x60 nt_page1" value="'.$t_row['nt_page1'].'" />';
            $datas .= '<input type="hidden" name="nt_page1_2[]" class="nt_page1_2" value="'.$t_row['nt_page1_2'].'" /></td>';
        }
        $datas .= '<td class="b_tb_td"><input type="text" name="nt_install[]" class="frm_input x200 nt_install" value="'.$t_row['nt_install'].'" /></td>';
        $datas .= '<td class="b_tb_td" rowspan="2"><a class="nt_del_btn" onclick="del_act(this)">삭제</a></td>';
        $datas .= '</tr><tr class="nt_tr2">';
        $datas .= '<td class="b_tb_td"><input type="text" name="nt_model[]" class="frm_input x200 nt_model" value="'.$t_row['nt_model'].'" /></td>';
        if($t_row['nt_list'] == '컬러복사기'){
            $datas .= '<td class="b_tb_td nt2"><label>흑백 </label>';
            $datas .= '<input type="text" name="nt_page2[]" class="frm_input x60 nt_page2" value="'.$t_row['nt_page2'].'" />';
            $datas .= '<label> 컬러 </label>';
            $datas .= '<input type="text" name="nt_page2_2[]" class="frm_input x60 nt_page2_2" value="'.$t_row['nt_page2_2'].'" /></td>';
        }else{
            $datas .= '<td class="b_tb_td nt2"><input type="text" name="nt_page2[]" class="frm_input x60 nt_page2" value="'.$t_row['nt_page2'].'" />';
            $datas .= '<input type="hidden" name="nt_page2_2[]" class="nt_page2_2" value="'.$t_row['nt_page2_2'].'" /></td>';
        }
        $datas .= '<td class="b_tb_td talign_l">';
        $datas .= '<input type="hidden" name="pre_nt_file[]" class="pre_nt_file" value="'.$t_row['nt_file'].'" />';
        $datas .= '<input type="file" name="nt_file[]" class="frm_input x200 nt_file frm_file" />';
        if($t_row['nt_file'] != ''){
            $datas .= '<div>';
            $datas .= '<label><input type="checkbox" name="nt_file_del[]" class="nt_file_del" value="y" /> 삭제</label>';
            $datas .= '<span> ( '.$t_row['nt_file'].' )</span>';
            $datas .= '</div>';
        }
        $datas .= '</td></tr>';

        return $datas;
    }
}
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo $board_skin_url ?>/jquery-ui.js"></script>
<script>
    function datepicker_act(){
        $("#wr_1,#wr_14,.nt_date,#wr_22,#wr_26").datepicker({	// UI 달력을 사용할 Class / Id 를 콤마(,) 로 나누어서 다중으로 가능
            buttonText: "Select date",
            dateFormat: "yy-mm-dd",	// Form에 입력될 Date Type
            prevText: '이전 달',	// ◀ 에 마우스 오버하면 나타나는 타이틀
            nextText: '다음 달',	// ▶ 에 마우스 오버하면 나타나는 타이틀
            changeMonth: true,	// 월 SelectBox 형식으로 선택변경 유무
            changeYear: true,	// 년 SelectBox 형식으로 선택변경 유무
            showMonthAfterYear: true,	// 년도 다음에 월이 나타나게 할지 여부 ( true : 년 월 , false : 월 년 )
            showButtonPanel: true,	// UI 하단에 버튼 사용 유무
            monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
            monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
            dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],	// 요일에 마우스 오버하면 나타나는 타이틀
            dayNamesMin: ['일','월','화','수','목','금','토'],	// 요일 텍스트 값
            duration: 'fast', // 달력 나타나는 속도 ( Slow , Normal , Fast )
            showAnim: 'slideDown'
        });
    }
    $(function(){
        datepicker_act();
    });
</script>

<script>
    function chkNum(c){
        if((c.keyCode<48) || (c.keyCode>57)){
            return false;
        }
    }

    function onOnlyNumber(obj){
        for(var i=0; i<obj.value.length; i++){
            chr = obj.value.substr(i,1);
            chr = escape(chr);
            key_eg = chr.charAt(1);

            if(key_eg == "u"){
                key_num = chr.substr(i,(chr.length-1));
                if((key_num < "AC00") || (key_num > "D7A3")){
                    event.returnValue = false;
                }
            }
        }

        if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 16){
            event.returnValue = true;
        }else{
            event.returnValue = false;
        }
    }
</script>

<?php if(!isset($_SERVER["HTTPS"])) { ?>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<?php }else{ ?>
    <script src=" https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<?php } ?>
<!-- 240409 카카오맵안열리는거
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
-->
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
        <input type="hidden" name="pre_wr_16" value="<?php echo $write['wr_16'] ?>">
        <?php
        $option = '';
        $option_hidden = '';
        if ($is_notice || $is_html || $is_secret || $is_mail) {
            $option = '';
            if ($is_notice) {
                //$option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
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

        <div class="tbl_wrap">
            <table class="b_tbl">
                <tbody>
                <tr>
                    <th class="b_th">계약일자</th>
                    <td class="b_td" colspan="3">
                        <input type="text" name="wr_1" id="wr_1" value="<?php echo $write['wr_1'] ?>" class="frm_input x90" />
                    </td>
                </tr>
                <tr>
                    <th class="b_th">계약기간</th>
                    <td class="b_td" colspan="3">
                        <select name="wr_18" id="wr_18">
                            <?php
                            for($i=1; $i<=5; $i++){
                                ?>
                                <option value="<?php echo $i ?>" <?php if($write['wr_18'] == $i) echo 'selected'; ?>><?php echo $i ?>년</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">고객분류</th>
                    <td class="b_td" colspan="3">
                        <select name="wr_2" id="wr_2">
                            <option value="임대" <?php if($write['wr_2'] == '임대') echo 'selected'; ?>>임대</option>
                            <?php if($w == 'u'){ ?>
                                <option value="임대해지" <?php if($write['wr_2'] == '임대해지') echo 'selected'; ?>>임대해지</option>
                            <?php } ?>
                        </select>
                        <label class="wr_2_box">
                            해지일자&nbsp;&nbsp;&nbsp;<input type="text" name="wr_26" id="wr_26" value="<?php echo $write['wr_26'] ?>" class="frm_input x90" style="height:21px;" />
                        </label>
                        <?php if($write['wr_2'] == '임대해지'){ ?>
                            <script>
                                $(".wr_2_box").css('display','inline-block');
                            </script>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">업체명</th>
                    <td class="b_td" colspan="3">
                        <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" class="frm_input x200" maxlength="255">
                    </td>
                </tr>
                <tr>
                    <th class="b_th xp15">대표자</th>
                    <td class="b_td xp35">
                        <input type="text" name="wr_3" id="wr_3" value="<?php echo $write['wr_3'] ?>" class="frm_input x100" />
                    </td>
                    <th class="b_th xp15">대표자 H.P</th>
                    <td class="b_td xp35">
                        <input type="text" name="wr_4" id="wr_4" value="<?php echo $write['wr_4'] ?>" class="frm_input x130" />
                    </td>
                </tr>
                <tr>
                    <th class="b_th">담당자</th>
                    <td class="b_td">
                        <input type="text" name="wr_5" id="wr_5" value="<?php echo $write['wr_5'] ?>" class="frm_input x100" />
                    </td>
                    <th class="b_th">담당자 H.P</th>
                    <td class="b_td">
                        <input type="text" name="wr_6" id="wr_6" value="<?php echo $write['wr_6'] ?>" class="frm_input x130" />
                    </td>
                </tr>
                <tr>
                    <th class="b_th">Tel</th>
                    <td class="b_td">
                        <input type="text" name="wr_7" id="wr_7" value="<?php echo $write['wr_7'] ?>" class="frm_input x130" />
                    </td>
                    <th class="b_th">Fax</th>
                    <td class="b_td">
                        <input type="text" name="wr_8" id="wr_8" value="<?php echo $write['wr_8'] ?>" class="frm_input x130" />
                    </td>
                </tr>
                <tr>
                    <th class="b_th">주소</th>
                    <td class="b_td" colspan="3">
                        <input type="text" name="wr_9" value="<?php echo $write['wr_9'] ?>" id="wr_9"  class="frm_input " size="5" maxlength="6">
                        <button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'wr_9', 'wr_10', 'wr_11', 'wr_12', 'mb_addr_jibeon');" style="border-radius:4px;">주소 검색</button><br>
                        <input type="text" name="wr_10" value="<?php echo $write['wr_10'] ?>" id="wr_10"  class="frm_input frm_address " size="50">
                        <label for="wr_10">기본주소</label><br>
                        <input type="text" name="wr_11" value="<?php echo $write['wr_11'] ?>" id="wr_11" class="frm_input frm_address" size="50">
                        <label for="wr_11">상세주소</label>
                        <br>
                        <input type="text" name="wr_12" value="<?php echo $write['wr_12'] ?>" id="wr_12" class="frm_input frm_address" size="50" readonly>
                        <label for="wr_12">참고항목</label>
                        <input type="hidden" name="mb_addr_jibeon" value="">
                    </td>
                </tr>
                <tr>
                    <th class="b_th">임대기종</th>
                    <td class="b_td" colspan="3">

                        <table class="b_tbl2">
                            <thead>
                            <tr>
                                <th class="b_th_th" rowspan="2">설치일자</th>
                                <th class="b_th_th x200">분류선택</th>
                                <th class="b_th_th x200">연결방식</th>
                                <th class="b_th_th x200">기본장수</th>
                                <th class="b_th_th">설치위치</th>
                                <th class="b_th_th x70" rowspan="2">삭제</th>
                            </tr>
                            <tr>
                                <th class="b_th_th">모델</th>
                                <th class="b_th_th x200">IP</th>
                                <th class="b_th_th x200">시작장수</th>
                                <th class="b_th_th">첨부파일</th>
                            </tr>
                            </thead>
                            <tbody id="nt_tbody">
                            <?php
                            $t_sql = "SELECT * FROM g5_write_new_type WHERE nt_wr_id='{$wr_id}' ORDER BY nt_idx ASC";
                            $t_qry = sql_query($t_sql);
                            $t_num = sql_num_rows($t_qry);

                            if ($t_num > 0) {
                                // 기존 데이터가 있는 경우 반복문으로 출력
                                for ($b = 0; $b < $t_num; $b++) {
                                    $t_row = sql_fetch_array($t_qry);
                                    ?>
                                    <tr class="nt_tr1">
                                        <td class="b_tb_td x110" rowspan="2">
                                            <input type="hidden" name="nt_cnt[]" class="nt_cnt" value="<?php echo $t_row['nt_cnt']; ?>" />
                                            <input type="text" name="nt_date[]" class="frm_input x90 nt_date" value="<?php echo $t_row['nt_date']; ?>" />
                                        </td>
                                        <td class="b_tb_td">
                                            <select name="nt_list[]" class="nt_list" onchange="nt_view(this)">
                                                <option value="">선택하세요</option>
                                                <?php
                                                for ($c = 0; $c < count($list_arr); $c++) {
                                                    $selected = ($t_row['nt_list'] == $list_arr[$c]) ? 'selected' : '';
                                                    echo "<option value='{$list_arr[$c]}' {$selected}>{$list_arr[$c]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="b_tb_td">
                                            <select name="nt_connection_type[]" class="nt_list" onchange="nt_view(this)">
                                                <option value="">선택하세요</option>
                                                <?php
                                                for ($c = 0; $c < count($connection_type_arr); $c++) {
                                                    $selected = ($t_row['nt_connection_type'] == $connection_type_arr[$c]) ? 'selected' : '';
                                                    echo "<option value='{$connection_type_arr[$c]}' {$selected}>{$connection_type_arr[$c]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="b_tb_td nt1">
                                            <input type="text" name="nt_page1[]" class="frm_input x60 nt_page1" value="<?php echo $t_row['nt_page1']; ?>" />
                                            <input type="hidden" name="nt_page1_2[]" class="nt_page1_2" value="<?php echo $t_row['nt_page1_2']; ?>" />
                                        </td>
                                        <td class="b_tb_td">
                                            <input type="text" name="nt_install[]" class="frm_input x200 nt_install" value="<?php echo $t_row['nt_install']; ?>" />
                                        </td>
                                        <td class="b_tb_td" rowspan="2">
                                            <a class="nt_del_btn" onclick="del_act(this)">삭제</a>
                                        </td>
                                    </tr>
                                    <tr class="nt_tr2">
                                        <td class="b_tb_td">
                                            <input type="text" name="nt_model[]" class="frm_input x200 nt_model" value="<?php echo $t_row['nt_model']; ?>" />
                                        </td>
                                        <td class="b_tb_td nt2">
                                            <input type="text" name="nt_ip[]" class="frm_input x200 nt_page2" value="<?php echo $t_row['nt_ip']; ?>" />
                                        </td>
                                        <td class="b_tb_td nt2">
                                            <input type="text" name="nt_page2[]" class="frm_input x60 nt_page2" value="<?php echo $t_row['nt_page2']; ?>" />
                                            <input type="hidden" name="nt_page2_2[]" class="nt_page2_2" value="<?php echo $t_row['nt_page2_2']; ?>" />
                                        </td>
                                        <td class="b_tb_td talign_l">
                                            <input type="file" name="nt_file[]" class="frm_input x200 nt_file frm_file" />
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // 데이터가 없을 때 기본 입력 행 표시
                                ?>
                                <tr class="nt_tr1">
                                    <td class="b_tb_td x110" rowspan="2">
                                        <input type="hidden" name="nt_cnt[]" class="nt_cnt" value="" />
                                        <input type="text" name="nt_date[]" class="frm_input x90 nt_date" value="" />
                                    </td>
                                    <td class="b_tb_td">
                                        <select name="nt_list[]" class="nt_list" onchange="nt_view(this)">
                                            <option value="">선택하세요</option>
                                            <?php
                                            for ($c = 0; $c < count($list_arr); $c++) {
                                                echo "<option value='{$list_arr[$c]}'>{$list_arr[$c]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="b_tb_td">
                                        <select name="nt_connection_type[]" class="nt_list" onchange="nt_view(this)">
                                            <option value="">선택하세요</option>
                                            <?php
                                            for ($c = 0; $c < count($connection_type_arr); $c++) {
                                                echo "<option value='{$connection_type_arr[$c]}'>{$connection_type_arr[$c]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td class="b_tb_td nt1">
                                        <input type="text" name="nt_page1[]" class="frm_input x60 nt_page1" value="" />
                                        <input type="hidden" name="nt_page1_2[]" class="nt_page1_2" value="" />
                                    </td>
                                    <td class="b_tb_td">
                                        <input type="text" name="nt_install[]" class="frm_input x200 nt_install" value="" />
                                    </td>
                                    <td class="b_tb_td" rowspan="2">
                                        <a class="nt_del_btn" onclick="del_act(this)">삭제</a>
                                    </td>
                                </tr>
                                <tr class="nt_tr2">
                                    <td class="b_tb_td">
                                        <input type="text" name="nt_model[]" class="frm_input x200 nt_model" value="" />
                                    </td>
                                    <td class="b_tb_td nt2">
                                        <input type="text" name="nt_ip[]" class="frm_input x200 nt_page2" value="" />
                                    </td>
                                    <td class="b_tb_td nt2">
                                        <input type="text" name="nt_page2[]" class="frm_input x60 nt_page2" value="" />
                                        <input type="hidden" name="nt_page2_2[]" class="nt_page2_2" value="" />
                                    </td>
                                    <td class="b_tb_td talign_l">
                                        <input type="file" name="nt_file[]" class="frm_input x200 nt_file frm_file" />
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <div id="nt_add_box">
                            <input type="button" value="추&nbsp;&nbsp;&nbsp;&nbsp;가" id="nt_add_btn" />
                        </div>



                    </td>
                </tr>
                <tr>
                    <th class="b_th">보증금</th>
                    <td class="b_td" colspan="3">
                        <input type="text" name="wr_19" id="wr_19" value="<?php echo $write['wr_19'] ?>" class="frm_input x130" />

                        <label style="padding-left:10px;"><input type="radio" name="wr_26" value="미납" <?php if($write['wr_26'] == '' || $write['wr_26'] == '미납') echo 'checked' ?> /> 미납</label>&nbsp;&nbsp;&nbsp;
                        <label><input type="radio" name="wr_26" value="완납" <?php if($write['wr_26'] == '완납') echo 'checked' ?> /> 완납</label>

                        <label style="padding-left:10px;">완납일자 : </label>
                        <input type="date" name="wr_27" id="wr_27" value="<?php echo $write['wr_27'] ?>" class="frm_input x130" />
                    </td>
                </tr>
                <tr>
                    <th class="b_th">임대금액</th>
                    <td class="b_td">
                        <input type="text" name="wr_13" id="wr_13" value="<?php echo $write['wr_13'] ?>" class="frm_input x130" style="IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);" />

                        <label style="padding-left:10px;"><input type="radio" name="wr_21" value="선불" <?php if($write['wr_21'] == '선불') echo 'checked' ?>> 선불</label>&nbsp;&nbsp;&nbsp;
                        <label><input type="radio" name="wr_21" value="후불" <?php if($write['wr_21'] == '후불') echo 'checked' ?>> 후불</label>
                    </td>
                    <th class="b_th">출금일자</th>
                    <td class="b_td">
                        <select name="wr_14" id="wr_14">
                            <option value="">선택하세요</option>
                            <?php
                            for($a=1; $a<32; $a++){
                                ?>
                                <option value="<?php echo $a ?>" <?php if($a == $write['wr_14']) echo 'selected'; ?>><?php echo $a.'일' ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">임대금액 결제방식</th>
                    <td class="b_td" colspan="3">
                        <select name="wr_15">
                            <option value="" <?php if($write['wr_15'] == '') echo 'selected'; ?>>선택하세요</option>
                            <option value="통장CMS" <?php if($write['wr_15'] == '통장CMS') echo 'selected'; ?>>통장CMS</option>
                            <option value="카드CMS" <?php if($write['wr_15'] == '카드CMS') echo 'selected'; ?>>카드CMS</option>
                            <option value="통장입금" <?php if($write['wr_15'] == '통장입금') echo 'selected'; ?>>통장입금</option>
                            <option value="수금(현금)" <?php if($write['wr_15'] == '수금(현금)') echo 'selected'; ?>>수금(현금)</option>
                            <option value="카드결제" <?php if($write['wr_15'] == '카드결제') echo 'selected'; ?>>카드결제</option>
                            <option value="CMS" <?php if($write['wr_15'] == 'CMS') echo 'selected'; ?>>CMS</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">VAT</th>
                    <td class="b_td" colspan="3">
                        <label><input type="radio" name="wr_20" value="포함" <?php if($write['wr_20'] == '포함') echo 'checked' ?> /> 포함</label>&nbsp;&nbsp;&nbsp;
                        <label><input type="radio" name="wr_20" value="별도" <?php if($write['wr_20'] == '별도') echo 'checked' ?> /> 별도</label>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">정기점검세팅</th>
                    <td class="b_td" colspan="3">
                        <select name="wr_16">
                            <option value="">선택</option>
                            <?php
                            for($a=1; $a<13; $a++){
                                ?>
                                <option value="<?php echo $a ?>개월" <?php if($write['wr_16'] == $a) echo 'selected'; ?>><?php echo $a ?>개월</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">비고</th>
                    <td class="b_td" colspan="3">
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
                <tr>
                    <th class="b_th">사업자등록증</th>
                    <td class="b_td" colspan="3">
                        <?php for ($i=0; $is_file && $i<1; $i++) { ?>
                            <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                            <?php if ($is_file_content) { ?>
                                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                            <?php } ?>
                            <?php if($w == 'u' && $file[$i]['file']) { ?>
                                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">계약서</th>
                    <td class="b_td" colspan="3">
                        <?php for ($i=1; $is_file && $i<2; $i++) { ?>
                            <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                            <?php if ($is_file_content) { ?>
                                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                            <?php } ?>
                            <?php if($w == 'u' && $file[$i]['file']) { ?>
                                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th class="b_th">CMS</th>
                    <td class="b_td" colspan="3">
                        <?php for ($i=2; $is_file && $i<3; $i++) { ?>
                            <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                            <?php if ($is_file_content) { ?>
                                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                            <?php } ?>
                            <?php if($w == 'u' && $file[$i]['file']) { ?>
                                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php if($w != ''){ ?>
                    <tr>
                        <th class="b_th">수금사항</th>
                        <td class="b_td" colspan="3">
                            <label><input type="radio" name="wr_17" class="wr_17" value="수금" <?php if($write['wr_17'] == '수금') echo 'checked'; ?>> 수금</label>&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" name="wr_17" class="wr_17" value="미수" <?php if($write['wr_17'] == '미수') echo 'checked'; ?>> 미수</label>
                            <div id="wr_17_box2">
                                <span style="font-weight:bold;">수금일자&nbsp;&nbsp;</span>
                                <input type="text" name="wr_22" id="wr_22" value="<?php echo $write['wr_22'] ?>" class="frm_input x90" style="height:21px;" />
                                <span style="padding-left:15px; font-weight:bold;">수금방법&nbsp;&nbsp;</span>
                                <select name="wr_23">
                                    <option value="" <?php if($write['wr_23'] == '') echo 'selected'; ?>>선택하세요</option>
                                    <option value="CMS" <?php if($write['wr_23'] == 'CMS') echo 'selected'; ?>>CMS</option>
                                    <option value="통장입금" <?php if($write['wr_23'] == '통장입금') echo 'selected'; ?>>통장입금</option>
                                    <option value="수금(현금)" <?php if($write['wr_23'] == '수금(현금)') echo 'selected'; ?>>수금(현금)</option>
                                    <option value="카드결제" <?php if($write['wr_23'] == '카드결제') echo 'selected'; ?>>카드결제</option>
                                </select>
                            </div>
                            <?php if($write['wr_17'] == '수금'){ ?>
                                <script>
                                    $("#wr_17_box2").css('display','block');
                                </script>
                            <?php } ?>
                            <div id="wr_17_box3">
                                <span style="font-weight:bold;">미수금액&nbsp;&nbsp;</span>
                                <input type="text" name="wr_24" id="wr_24" value="<?php echo $write['wr_24'] ?>" class="frm_input x90" style="height:21px; IME-MODE:disabled;" onkeypress="return chkNum(event);" onKeyDown="onOnlyNumber(this);" />
                                <span style="padding-left:15px; font-weight:bold;">미수금된 개월수&nbsp;&nbsp;</span>
                                <select name="wr_25">
                                    <option value="" <?php if($write['wr_25'] == '') echo 'selected'; ?>>선택</option>
                                    <?php
                                    for($a=1; $a<13; $a++){
                                        ?>
                                        <option value="<?php echo $a ?>개월" <?php if($write['wr_25'] == $a) echo 'selected'; ?>><?php echo $a ?>개월</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php if($write['wr_17'] == '미수'){ ?>
                                <script>
                                    $("#wr_17_box3").css('display','block');
                                </script>
                            <?php } ?>
                            <div id="wr_17_box">
                                <textarea name="wr_17_text" style="width:100%; height:100px; border:1px solid #b5b5b5;"><?php echo $write['wr_17_text'] ?></textarea>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm" style="padding-top:15px;">
            <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
            <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
        </div>
    </form>

    <script>
        function nt_view(obj){
            var data1, data2 = '';
            var _index = $(".nt_list").index(obj);

            if($(".nt_list").eq(_index).val() == '컬러복사기'){
                data1 = '<label>흑백 </label>';
                data1 += '<input name="nt_page1[]" class="frm_input x60 nt_page1" type="text" value="">';
                data1 += '<label> 컬러 </label>';
                data1 += '<input name="nt_page1_2[]" class="frm_input x60 nt_page1_2" type="text" value="">';

                data2 = '<label>흑백 </label>';
                data2 += '<input name="nt_page2[]" class="frm_input x60 nt_page2" type="text" value="">';
                data2 += '<label> 컬러 </label>';
                data2 += '<input name="nt_page2_2[]" class="frm_input x60 nt_page2_2" type="text" value="">';
            }else{
                data1 = '<input name="nt_page1[]" class="frm_input x60 nt_page1" type="text" value="">';
                data1 += '<input name="nt_page1_2[]" class="nt_page1_2" type="hidden" value="">';

                data2 = '<input name="nt_page2[]" class="frm_input x60 nt_page2" type="text" value="">';
                data2 += '<input name="nt_page2_2[]" class="nt_page2_2" type="hidden" value="">';
            }

            $(".nt1").eq(_index).empty();
            $(".nt2").eq(_index).empty();

            $(".nt1").eq(_index).append(data1);
            $(".nt2").eq(_index).append(data2);
        }

        function del_act(obj){
            var _idx = $(".nt_del_btn").index(obj);

            if(confirm('삭제하시겠습니까?')){
                $(".nt_tr1").eq(_idx).remove();
                $(".nt_tr2").eq(_idx).remove();
            }
        }

        $(function(){
            $("#nt_add_btn").on('click', function(){
                // PHP 배열을 JavaScript 배열로 변환
                var listArr = <?php echo json_encode($list_arr); ?>;
                var connectionTypeArr = <?php echo json_encode($connection_type_arr); ?>;

                var datas = '';
                datas += '<tr class="nt_tr1">';
                datas += '<td class="b_tb_td x110" rowspan="2"><input type="hidden" name="nt_cnt[]" class="nt_cnt" value="" />';
                datas += '<input type="text" name="nt_date[]" class="frm_input x90 nt_date" value="" /></td>';

                // 분류선택
                datas += '<td class="b_tb_td"><select name="nt_list[]" class="nt_list" onchange="nt_view(this)"><option value="">선택하세요</option>';
                for (var a = 0; a < listArr.length; a++) {
                    datas += '<option value="'+listArr[a]+'">'+listArr[a]+'</option>';
                }
                datas += '</select></td>';

                // 연결방식
                datas += '<td class="b_tb_td"><select name="nt_connection_type[]" class="nt_list" onchange="nt_view(this)"><option value="">선택하세요</option>';
                for (var a = 0; a < connectionTypeArr.length; a++) {
                    datas += '<option value="'+connectionTypeArr[a]+'">'+connectionTypeArr[a]+'</option>';
                }
                datas += '</select></td>';

                // 기본장수
                datas += '<td class="b_tb_td nt1"><input type="text" name="nt_page1[]" class="frm_input x60 nt_page1" value="" />';
                datas += '<input type="hidden" name="nt_page1_2[]" class="nt_page1_2" value="" /></td>';

                // 설치위치
                datas += '<td class="b_tb_td"><input type="text" name="nt_install[]" class="frm_input x200 nt_install" value="" /></td>';
                datas += '<td class="b_tb_td" rowspan="2"><a class="nt_del_btn" onclick="del_act(this)">삭제</a></td>';
                datas += '</tr>';

                datas += '<tr class="nt_tr2">';
                datas += '<td class="b_tb_td"><input type="text" name="nt_model[]" class="frm_input x200 nt_model" value="" /></td>';
                datas += '<td class="b_tb_td nt2"><input type="text" name="nt_ip[]" class="frm_input x200 nt_page2" value="" /></td>';
                datas += '<td class="b_tb_td nt2"><input type="text" name="nt_page2[]" class="frm_input x60 nt_page2" value="" />';
                datas += '<input type="hidden" name="nt_page2_2[]" class="nt_page2_2" value="" /></td>';
                datas += '<td class="b_tb_td talign_l"><input type="file" name="nt_file[]" class="frm_input x200 nt_file frm_file" /></td>';
                datas += '</tr>';

                // 테이블에 추가
                $("#nt_tbody").append(datas);

                // datepicker 활성화 함수 호출
                datepicker_act();
            });


            $(".wr_17").on('click', function(){
                var _idx = $(".wr_17").index(this);
                if(_idx == 0){
                    $("#wr_17_box2").css('display','block');
                    $("#wr_17_box3").css('display','none');
                    //$("#wr_17_box").css('display','none');
                }else{
                    $("#wr_17_box2").css('display','none');
                    $("#wr_17_box3").css('display','block');
                    //$("#wr_17_box").css('display','block');
                }
            });

            $("#wr_2").on('click', function(){
                if($(this).val() == '임대해지'){
                    $(".wr_2_box").css('display','inline-block');
                }else{
                    $(".wr_2_box").css('display','none');
                }
            });
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
            if(f.wr_1.value == ''){
                alert("계약일자를 선택(입력)해주세요");
                f.wr_1.focus();
                return false;
            }

            if(f.wr_subject.value == ''){
                alert("업체명을 입력해주세요");
                f.wr_subject.focus();
                return false;
            }

            if(f.wr_13.value == ''){
                alert("임대금액을 입력해주세요");
                f.wr_13.focus();
                return false;
            }

            var wr_content_editor_data = oEditors.getById['wr_content'].getIR();
            oEditors.getById['wr_content'].exec('UPDATE_CONTENTS_FIELD', []);
            if(jQuery.inArray(document.getElementById('wr_content').value.toLowerCase().replace(/^\s*|\s*$/g, ''), ['&nbsp;','<p>&nbsp;</p>','<p><br></p>','<div><br></div>','<p></p>','<br>','']) != -1){document.getElementById('wr_content').value='';}
            //if (!wr_content_editor_data || jQuery.inArray(wr_content_editor_data.toLowerCase(), ['&nbsp;','<p>&nbsp;</p>','<p><br></p>','<p></p>','<br>']) != -1) { alert("내용을 입력해 주십시오."); oEditors.getById['wr_content'].exec('FOCUS'); return false; }

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
                alert("업체명에 금지단어('"+subject+"')가 포함되어있습니다");
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

            <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

            document.getElementById("btn_submit").disabled = "disabled";

            return true;
        }

        function setWr27() {
            const wr26 = $('input[name="wr_26"]:checked').val();
            const wr27 = $('#wr_27');

            if (wr26 === '완납') {
                const today = new Date().toISOString().split('T')[0]; // 현재 날짜를 "YYYY-MM-DD" 형식으로 가져오기
                wr27.val(today);
            } else {
                wr27.val(''); // 빈값으로 설정
            }
        }

        // 라디오 버튼 변경 시 setWr27 함수 실행
        $('input[name="wr_26"]').on('change', setWr27);

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->