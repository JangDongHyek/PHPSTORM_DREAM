<?php
$sub_menu = "250000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['talent_table']} ta ";


$sql_search = " where 1=1 and ta_imsi != 'Y' ";


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_work' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($big_ctg) {
    $sql_search .= " and ta_category1 = ".$big_ctg ;
}
if ($small_ctg) {
    $sql_search .= " and ta_category2 = ".$small_ctg ;
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
    $sql_search .= " and mb_id != 'lets080'";

if (!$sst) {
    $sst = "ta.wr_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '재능등록';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;


?>

<style>
    .mb_tbl table {text-align: center;}

</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총게시글 <?php echo number_format($total_count) ?> 개
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>"></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="ta_title"<?php echo get_selected($_GET['sfl'], "ta_title"); ?>>제목</option>
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
<form id="fsearch2" name="fsearch2" class="local_sch01 local_sch" method="get">
    <label for="big_ctg" class="sound_only">검색대상</label>
    <select name="big_ctg" id="big_ctg" onchange="ctg_change('big');">
        <option value="">상위카테고리</option>
        <?php
        $code = common_code('ctg','code_ctg','json');
        for ($i = 0; $i < count($code); $i++){ ?>
            <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['big_ctg'],$code[$i]['idx']) ?> ><?=$code[$i]['name']?></option>
        <?php } ?>
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
    <select name="small_ctg" id="small_ctg" onchange="ctg_change('small');">
        <option value="">하위카테고리</option>

        <?php
        if ($big_ctg != "") {
        $code = common_code($big_ctg,'code_p_idx','json');
        for ($i = 0; $i < count($code); $i++){ ?>
            <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['small_ctg'],$code[$i]['idx']) ?> ><?=$code[$i]['name']?></option>
        <?php }
        }?>
    </select>
</form>



<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">회원 전체</label>
<!--                    <input type="checkbox" name="chkall" value="1" id="chkall">-->
                </th>
                <th>no</th>
                <th>상위카테고리</th>
                <th>하위카테고리</th>
                <th>제목</th>
                <th>가격</th>
                <th><?php echo subject_sort_link('mb_id') ?>닉네임</a></th>
                <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
                <th>작성일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));


            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $s_mod = '<a href="./talent_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['ta_idx'].'">보기/수정</a>';

                $s_mod .= '<a style = "margin-left:5px; color:red" onclick="return delete_confirm(this);" href="'.G5_BBS_URL.'/talent_delete.php?idx=' . $row['ta_idx'] . '">삭제</a>';
                $bg = 'bg'.($i%2);
                $mb = get_member($row['mb_id']);

                $sql = "select * from new_talent_ad";
                $ad_result = sql_query($sql);
                $is_ad = '0';

                for($a = 0; $ad = sql_fetch_array($ad_result); $a++){
                    if ($ad['ad_ta_idx'] == $row['ta_idx']){
                        $is_ad = '1';
                    }
                }

                ?>
                <tr class="<?php echo $bg; ?>">
                    <td>
                        <?php if ($is_ad == 0){ ?>
<!--                        <input type="hidden" name="idx[--><?php //echo $i ?><!--]" value="--><?php //echo $row['ta_idx'] ?><!--" id="ta_idx_--><?php //echo $i ?><!--">-->
                        <input type="checkbox" name="chk[]" value="<?php echo $row['ta_idx'] ?>" id="chk_<?php echo $i ?>">
                        <?php }else{ ?>
                        <input style="border-style: none;background: none;" type="button" value="광고해제" onclick="ad_del(<?php echo $row['ta_idx'] ?>)">
                         <?php } ?>
                    </td>
                    <td><?=$list_no?></td>
                    <td><?php $code = common_code($row['ta_category1'], 'code_idx','json');
                            echo $code[0]['name']; ?></td>
                    <td><?php $code = common_code($row['ta_category2'], 'code_idx','json');
                        echo $code[0]['name']; ?></td>
                    <td><?=$row['ta_title']?></td>
                    <td><?php
                        $sql = "select min(pta_pay) min_pay,max(pta_pay) max_pay from {$g5['pay_talent_table']} where ta_idx = '{$row['ta_idx']}' ";

                        $pay_row = sql_fetch($sql);
                        if ( $pay_row["min_pay"] != $pay_row["max_pay"]){
                            echo number_format($pay_row["min_pay"]). "원 ~ ".number_format($pay_row["max_pay"])."원";
                        }else if ($pay_row["min_pay"] > 0){
                            echo number_format($pay_row["min_pay"])."원";
                        }

                        ?></td>
                    <td><?=$mb['mb_nick']?></td>
                    <td><?=$mb['mb_id']?></td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>
                    <td><?=$s_mod?></td>
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

    <div class="btn_list01 btn_list">
        <input type="text" name="number" placeholder="노출순서">
        <select name="category_option" style="height: 37px">
            <option value="1">1차 카테고리 노출</option>
            <option value="2">2차 카테고리 노출</option>
            <option value="3">3차 카테고리 노출</option>
        </select>
        <input type="submit" name="act_button" value="설정" onclick="document.pressed=this.value">
        <div style="margin-top: 5px">노출순서 : 숫자가 클수록 먼저 노출됩니다.</div>
    </div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    $(document).ready(function () {

    })
    $("ul.cate li").on("click", function() {

        var big_ctg = $("#big_ctg").val();
        var small_ctg = $("#small_ctg").val();

        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (big_ctg != "" || small_ctg!= "") {
            params += "?big_ctg=" + big_ctg + "&small_ctg=" + small_ctg;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx
        }

        location.href = g5_admin_url + "/talent_list.php" + params;
    });
    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        return true;
    }

    function ctg_change(type) {

        var big_ctg = $("#big_ctg").val();
        if (type == 'small'){
            var small_ctg = $("#small_ctg").val();
        }else{
            var small_ctg = '';
        }
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "" || big_ctg != "" || small_ctg != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx+ "&big_ctg=" + big_ctg + "&small_ctg=" + small_ctg;
        }

        location.href = g5_admin_url + "/talent_list.php" + params;

    }
    
   function ad_del(idx) {
        $.ajax({
            url: g5_admin_url+"/adm.ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "mode": "ad_del"
            },
            success: function(data) {
                if (data != 1) {
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }else{
                    alert("광고가 해제되었습니다.");
                    location.href = location.href
                }
            }
        });
    }

</script>

<?php
include_once ('./admin.tail.php');
?>
