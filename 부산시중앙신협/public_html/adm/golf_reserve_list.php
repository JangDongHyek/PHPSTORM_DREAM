<?php
$sub_menu = "260200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($member["mb_level"] == 8){
    alert("접근권한이 없습니다.", G5_ADMIN_URL);
}

$sql_common = " from new_golf_reserve pr left join g5_member mem on pr.mb_id = mem.mb_id";


$sql_search = " where 1=1 ";

$room = $_REQUEST["room"];
$start_date = $_REQUEST["start_date"];
$end_date = $_REQUEST["end_date"];
$wr_start_date = $_REQUEST["wr_start_date"];
$wr_end_date = $_REQUEST["wr_end_date"];

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'wr_subject' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($room != ""){
    $sql_search .= "and gr_room = ".$room;
}


if ($start_date != "" && $end_date != ""){
    $sql_search .= " and date_format(gr_date, '%Y-%m-%d') >= '{$start_date}'
                    AND date_format(gr_date, '%Y-%m-%d') <= '{$end_date}' ";
}

if ($wr_start_date != "" && $wr_end_date != ""){
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') >= '{$wr_start_date}'
                    AND date_format(wr_datetime, '%Y-%m-%d') <= '{$wr_end_date}' ";
}

if (!$sst) {
    $sst = "gr_date";
    $sod = "desc";
}

$sql_order = " order by gr_idx desc  ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '더골프 예약관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<style>
    .mb_tbl table {text-align: center;}

    .btn_add .cate li {
        float: left;
        padding: 10px;
        border: 1px solid #ccc;
        border-left: 0;
        width: 85px;
        text-align: center;
        cursor: pointer;
    }
    .btn_add .cate li.on {
        background: #f2f5f9;
        font-weight: 700;
    }
    .btn_add .cate li:nth-child(1) {
        border-left: 1px solid #ccc;
    }
    .btn_add ul.cate {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .local_sch .btn_submit {
        padding: 0 5px;
        height: 24px;
        border: 0;
        color: #fff;
        font-size: 0.95em;
        vertical-align: middle;
        cursor: pointer;
        box-sizing: border-box;
    }

	.cancel_cl{
        background: #EAEAEA;
    }
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 예약수 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="room" value="<?=$room?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select onchange="sfl_change()" name="sfl" id="sfl">
        <option value="pr.mb_id"<?php echo get_selected($_GET['sfl'], "pr.mb_id"); ?>>아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>등급</option>
        <? /*
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
	*/ ?>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <span id="stx_span" style="display: inline"><input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input"></span>
    <input type="submit" class="btn_submit" value="검색">

</form>

<?php if ($is_admin == 'super') { ?>
    <div class="btn_add01 btn_add" >
        <ul class="cate local_sch " >
            <li style="margin-bottom: 10px" <? if ($room == "") echo 'class="on"'; ?> data-lv="">전체</li>

            <?php for ($i = 1; $i <= count($gr_room_arr); $i++){ ?>
                <li <? if ($room == $i) echo 'class="on"'; ?> data-lv="<?=$i?>"><?=$gr_room_arr[$i]?></li>
            <?php } ?>

            예약날짜:
            <input style="border: 1px solid #ccc;" value="<?=$start_date?>" type="date" id="start_date" onchange="date_change('')">
            ~
            <input style="border: 1px solid #ccc;" value="<?=$end_date?>" type="date" id="end_date" onchange="date_change('')">
            <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day('','')">
            <input type="button" class="btn_submit" style="background: grey" value="모두" onclick="click_day('all','')">
            <br>
            접수일자:
            <input style="border: 1px solid #ccc;" value="<?=$wr_start_date?>" type="date" id="wrstart_date" onchange="date_change('wr')">
            ~
            <input style="border: 1px solid #ccc;" value="<?=$wr_end_date?>" type="date" id="wrend_date" onchange="date_change('wr')">
            <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day('','wr')">
            <input type="button" class="btn_submit" style="background: grey" value="모두" onclick="click_day('all','wr')">
        </ul>
    </div>
<?php } ?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th>No.</th>
                <th style="width: 100px">예약상황</th>
                <th style="width: 100px">예약장소</th>
                <th style="width: 100px">예약날짜</th>
                <th style="width: 100px">예약시간</th>
                <?php if ($room > 3 || $room == ""){ ?>
                <th style="width: 100px">인원</th>
                <?php } ?>
                <th style="width: 100px">수정버튼</th>
                <th style="width: 100px">결제방법</th>
                <?php if ($room > 3 || $room == "" ) {?>
                <th style="width: 100px">입금확인</th>
                <?php } ?>

                <th style="width: 200px">고객아이디/등급/조합원번호</th>
                <th>고객이름</th>
                <th>휴대폰번호</th>
                <th>접수일</th>
            </tr>
            <? /*
    <tr>
        <th scope="col" rowspan="2" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" rowspan="2" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
        <th scope="col" colspan="6" id="mb_list_cert"><?php echo subject_sort_link('mb_certify', '', 'desc') ?>본인확인</a></th>
        <th scope="col" id="mb_list_mobile">휴대폰</th>
        <th scope="col" id="mb_list_auth">상태/<?php echo subject_sort_link('mb_level', '', 'desc') ?>권한</a></th>
        <th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
        <th scope="col" rowspan="2" id="mb_list_grp">접근<br>그룹</th>
        <th scope="col" rowspan="2" id="mb_list_mng">관리</th>
    </tr>
    <tr>
        <th scope="col" id="mb_list_nick"><?php echo subject_sort_link('mb_nick') ?>닉네임</a></th>
        <th scope="col" id="mb_list_mailc"><?php echo subject_sort_link('mb_email_certify', '', 'desc') ?>메일<br>인증</a></th>
        <th scope="col" id="mb_list_open"><?php echo subject_sort_link('mb_open', '', 'desc') ?>정보<br>공개</a></th>
        <th scope="col" id="mb_list_mailr"><?php echo subject_sort_link('mb_mailling', '', 'desc') ?>메일<br>수신</a></th>
        <th scope="col" id="mb_list_sms"><?php echo subject_sort_link('mb_sms', '', 'desc') ?>SMS<br>수신</a></th>
        <th scope="col" id="mb_list_adultc"><?php echo subject_sort_link('mb_adult', '', 'desc') ?>성인<br>인증</a></th>
        <th scope="col" id="mb_list_deny"><?php echo subject_sort_link('mb_intercept_date', '', 'desc') ?>접근<br>차단</a></th>
        <th scope="col" id="mb_list_tel">전화번호</th>
        <th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 포인트</a></th>
        <th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
    </tr>
	*/ ?>
            </thead>
            <tbody>
            <?php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));

            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $s_mod = "<a href='".G5_ADMIN_URL."/culture_write.php?w=u&wr_id=".$row["wr_id"]."&".$qstr."'>보기</a>";
                $bg = 'bg'.($i%2);
				$cancel_cl = $row["gr_proc"] == 'cancel' ? "cancel_cl" : "";
                ?>
                <tr class="<?php echo $bg ." ".$cancel_cl; ?>">
                    <!--		<td>-->
                    <!--			<input type="hidden" name="mb_id[--><?php //echo $i ?><!--]" value="--><?php //echo $row['mb_id'] ?><!--" id="mb_id_--><?php //echo $i ?><!--">-->
                    <!--            <input type="checkbox" name="chk[]" value="--><?php //echo $i ?><!--" id="chk_--><?php //echo $i ?><!--">-->
                    <!--		</td>-->
                    <td><?=$list_no?></td>
                    <td><select id = "gr_proc_<?=$row["gr_idx"]?>">
                            <option <?php if ($row["gr_proc"] == "comp") echo 'selected'?> value="comp">예약완료</option>
                            <option <?php if ($row["gr_proc"] == "cancel") echo 'selected'?> value="cancel">예약취소</option>
                        </select>
                    </td>
                    <td><select onchange="gr_room_change(<?=$row["gr_idx"]?>,this.value);" id = "gr_room_<?=$row["gr_idx"]?>">
                            <?php for ($i =1; $i <= count($gr_room_arr);$i++){ ?>
                                <option <?php if ($row["gr_room"] == $i) echo 'selected'?> value="<?=$i?>"><?=$gr_room_arr[$i]?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input id = "gr_date_<?=$row["gr_idx"]?>" type="date" class="frm_input" value="<?= $row["gr_date"]?>"></td>
                    <td><select id = "gr_time_<?=$row["gr_idx"]?>">

                            <?php
                            if ($row["gr_room"] > 3){ ?>
                                <option <?php if ($row["gr_time"] == 1) echo 'selected'?> value="1">오전(9시~13시)</option>
                                <option <?php if ($row["gr_time"] == 2) echo 'selected'?> value="2">오후(13시~18시)</option>

                            <?php }else{
                                for ($i =1; $i <= count($reserve_time_arr);$i++){ ?>
                                <option <?php if ($row["gr_time"] == $i) echo 'selected'?> value="<?=$i?>"><?=$reserve_time_arr[$i]?></option>
                                <?php }
                            } ?>
                        </select>
                    </td>
                    <?php if ( $room > 3 || $room == "" ) { ?>
                        <td><?php if ($row["gr_room"] > 3 ) echo $row["gr_cnt"]."명" ?></td>
                    <?php } ?>
                    <td><button type="button" onclick="gr_update(<?=$row["gr_idx"]?>)" style="border: #8aa6c1 1px solid">수정완료</button></td>
                    <td><?= $method_arr[$row["gr_payment_method"]] ?></td>
                    <?php if ($room > 3 || $room == "" ) {?>
                    <td>
                        <?php if ($row["gr_room"] > 3 ){ ?>
                        <input type="checkbox" id="payment_chk_<?=$row["gr_idx"]?>" value="Y" <?php if ($row["payment_chk"] == "Y") echo 'checked' ?> onclick="payment_chk(<?=$row["gr_idx"]?>)">
                        <?php } ?>
                    </td>
                    <?php } ?>

                    <td><?=$row["mb_id"]."/".$level_arr[$row["mb_level"]-1]."/".$row["mb_1"] ?></td>
                    <td><?= $row["mb_name"] ?></td>
                    <td><?= $row["mb_hp"] ?></td>
                    <td><?=substr($row['wr_datetime'],2,14)?></td>
					<input type="hidden" id="mb_id_<?=$row['gr_idx']?>" value="<?=$row['mb_id']?>">
                </tr>
                <? /*
    <tr class="<?php echo $bg; ?>">

        <td headers="mb_list_chk" class="td_chk" rowspan="2">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" rowspan="2" class="td_name sv_use"><?php echo $mb_id ?></td>
        <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
        <td headers="mb_list_cert" colspan="6" class="td_mbcert">
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="ipin" id="mb_certify_ipin_<?php echo $i; ?>" <?php echo $row['mb_certify']=='ipin'?'checked':''; ?>>
            <label for="mb_certify_ipin_<?php echo $i; ?>">아이핀</label>
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="hp" id="mb_certify_hp_<?php echo $i; ?>" <?php echo $row['mb_certify']=='hp'?'checked':''; ?>>
            <label for="mb_certify_hp_<?php echo $i; ?>">휴대폰</label>
        </td>
        <td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['mb_hp']); ?></td>
        <td headers="mb_list_auth" class="td_mbstat">
            <?php
            if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
            else echo "정상";
            ?>
            <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?>
        </td>
        <td headers="mb_list_lastcall" class="td_date"><?php echo substr($row['mb_today_login'],2,8); ?></td>
        <td headers="mb_list_grp" rowspan="2" class="td_numsmall"><?php echo $group ?></td>
        <td headers="mb_list_mng" rowspan="2" class="td_mngsmall"><?php echo $s_mod ?> <?php echo $s_grp ?></td>
    </tr>
    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_nick" class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
        <td headers="mb_list_mailc" class="td_chk"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'<span class="txt_true">Yes</span>':'<span class="txt_false">No</span>'; ?></td>
        <td headers="mb_list_open" class="td_chk">
            <label for="mb_open_<?php echo $i; ?>" class="sound_only">정보공개</label>
            <input type="checkbox" name="mb_open[<?php echo $i; ?>]" <?php echo $row['mb_open']?'checked':''; ?> value="1" id="mb_open_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_mailr" class="td_chk">
            <label for="mb_mailling_<?php echo $i; ?>" class="sound_only">메일수신</label>
            <input type="checkbox" name="mb_mailling[<?php echo $i; ?>]" <?php echo $row['mb_mailling']?'checked':''; ?> value="1" id="mb_mailling_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_sms" class="td_chk">
            <label for="mb_sms_<?php echo $i; ?>" class="sound_only">SMS수신</label>
            <input type="checkbox" name="mb_sms[<?php echo $i; ?>]" <?php echo $row['mb_sms']?'checked':''; ?> value="1" id="mb_sms_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_adultc" class="td_chk">
            <label for="mb_adult_<?php echo $i; ?>" class="sound_only">성인인증</label>
            <input type="checkbox" name="mb_adult[<?php echo $i; ?>]" <?php echo $row['mb_adult']?'checked':''; ?> value="1" id="mb_adult_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_deny" class="td_chk">
            <?php if(empty($row['mb_leave_date'])){ ?>
            <input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php echo $row['mb_intercept_date']?'checked':''; ?> value="<?php echo $intercept_date ?>" id="mb_intercept_date_<?php echo $i ?>" title="<?php echo $intercept_title ?>">
            <label for="mb_intercept_date_<?php echo $i; ?>" class="sound_only">접근차단</label>
            <?php } ?>
        </td>
        <td headers="mb_list_tel" class="td_tel"><?php echo get_text($row['mb_tel']); ?></td>
        <td headers="mb_list_point" class="td_num"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
        <td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
    </tr>
	*/ ?>

                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <!--<div class="btn_list01 btn_list">-->
    <!--    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
    <!--    <input type="submit" name="act_button" value="선택삭제" onclick="document.gressed=this.value">-->
    <!--</div>-->

</form>
<div class="btn_add01 btn_add">
    <a href="javascript:excel_down()" id="member_add">엑셀 다운로드</a>
</div>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&start_date='.$_REQUEST["start_date"].'&end_date='.$_REQUEST["end_date"].'&room='.$room.'&amp;page='); ?>

<script>
    $(document).ready(function () {
        sfl_change('ready');
    })
    //검색 조건이 작업일 경우 select 박스로 변경
    function sfl_change(type) {

        var sfl = $('#sfl');
        if (sfl.val() == 'mb_level'){
            $('#stx_span').html('<select name="stx" id="stx" class=" frm_input" value="<?php echo $stx ?>">' +
                <?php for ($c = 1; $c <= count($level_arr); $c++) { ?>
                '<option value = "<?= $c+1 ?>"><?= $level_arr[$c]?></option>' +
                <?php }?>
                '</select>');
            //검색 후 셀렉트값 넣어줌
            $("#stx").val($('#fmemberlist [name = "stx"]').val()).prop("selected", true);
        }else{
            if (type != "ready") {
                $('#stx_span').html('<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input">');
                $("#stx").val("");
            }
        }

    }

    $("ul.cate li").on("click", function() {
        var level = $(this).data("lv"),
            params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (level != "") {
            params += "?room=" + level;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx;
        }

        location.href = g5_admin_url + "/golf_reserve_list.php" + params;
    });

    function date_change(type) {
        var search = '';

        if (type == "wr"){
            search += "wr_start_date=" + $("#wrstart_date").val() +"&wr_end_date="+$("#wrend_date").val()
        }else{
            search += "start_date=" + $("#start_date").val() +"&end_date="+$("#end_date").val()
        }

        location.href = g5_admin_url + "/golf_reserve_list.php?room=<?=$room?>&"+ search+'&<?=$qstr?>';

    }

    function click_day(type, id) {
        if (type == "all") {
            $('#'+id+'start_date').val('');
            $('#'+id+'end_date').val('');
        }else {
            $('#'+id+'start_date').val('<?=date("Y-m-d")?>');
            $('#'+id+'end_date').val('<?=date("Y-m-d")?>');
        }

        date_change(id);
    }


    function gr_update(idx) {
        $.ajax({
            url: g5_admin_url+"/adm.ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "gr_room" : $("#gr_room_"+idx).val(),
                "gr_date": $("#gr_date_"+idx).val(),
                "gr_time": $("#gr_time_"+idx).val(),
                "gr_proc": $("#gr_proc_"+idx).val(),
				"mb_id" : $("#mb_id_"+idx).val(),
                "mode": "gr_update"
            },
            success: function(data) {
                if (data != 1){
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }else{
                    alert("수정이 완료되었습니다.");
                    location.href = "";

                }

            }
        });
    }

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
                "mode": "payment_chk",
                "val" :payment_val,
            },
            success: function(data) {
                if (data != 1){
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }

            }
        });
    }

    function excel_down() {

        var sfl = $('#sfl').val(),
            stx = $('#stx').val();


        location.href = g5_admin_url + '/new_golf_excel_download.php?room=<?=$_GET["room"]?>&start_date=<?=$_GET["start_date"]?>&end_date=<?=$_GET["end_date"]?>&wr_start_date=<?=$_GET["wr_start_date"]?>&wr_end_date=<?=$_GET["wr_end_date"]?>&sfl='+sfl+'&stx='+stx;
    }

    function gr_room_change(idx,val) {

        alert("예약장소 변경 시 예약시간을 다시 확인해주세요.");

        var html = "<select onchange='gr_room_change("+idx+",this.value);' id = 'gr_room_"+idx+"' >";
        if (val > 3){
            html += '<option value="1">오전(9시~13시)</option>';
            html += '<option value="2">오후(13시~18시)</option>';
        }else{
            <?php for ($i =1; $i <= count($reserve_time_arr);$i++){ ?>
                html += '<option  value="<?=$i?>"><?=$reserve_time_arr[$i]?></option>';
            <?php } ?>
        }

        html += "</select>";

        $("#gr_time_"+idx).html(html);
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
