<?php
$sub_menu = "350000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_competition ";


$sql_search = " where 1=1 ";


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
    $sql_search .= " and cp_category1 = ".$big_ctg ;
}
if ($small_ctg) {
    $sql_search .= " and cp_category2 = ".$small_ctg ;
}

if (!$sst) {
    $sst = "wr_datetime";
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

$g5['title'] = '마켓 판매';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;


?>

<style>
    .mb_tbl table {text-align: center;}
    .flex {display: flex; align-items: center; gap: 10px}
    .thumb {width: 50px; height: 50px; object-fit: cover}
    td.left {text-align: left!important;}
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
    <input type="date" class=" frm_input"> ~
    <input type="date" class=" frm_input">
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="cp_title"<?php echo get_selected($_GET['sfl'], "cp_title"); ?>>상품명</option>
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
        <option value="">주문상태</option>
        <option value="">결제완료</option>
        <option value="">취소완료</option>
        <option value="">배송준비중</option>
        <option value="">배송완료</option>
    </select>
</form>
<div class="btn_add01 btn_add">
    <a>주문 접수</a>
</div>



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
                <th><input type="checkbox"></th>
                <th>No</th>
                <th>상태</th>
                <th>판매일<br>주문번호</th>
                <th>업체명</th>
                <th>상품명</th>
                <th>옵션/갯수</th>
                <th>판매구분</th>
                <th>구매자 정보</th>
                <th>결제금액</th>
                <th>배송비</th>
                <th>결제수단</th>
                <th>배송</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>no</td>
                    <td>결제완료</td>
                    <td>판매일<br>주문번호</td>
                    <td>업체명</td>
                    <td>
                        <div class="flex">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg" class="thumb">
                            상품명
                        </div>
                    </td>
                    <td>옵션/갯수</td>
                    <td>일반/셀러</td>
                    <td class="left">
                        이름(아이디) 연락처
                        <br>주소
                    </td>
                    <td>결제금액</td>
                    <td>배송비</td>
                    <td>결제수단</td>
                    <td>
                        <div class="flex">
                            <select>
                                <option>택배사</option>
                            </select>
                            <input type="text" class="frm_input" placeholder="송장번호">

                            <a class="btn_01" href="">저장</a>
                        </div>
                    </td>
                    <td>
                        <a class="btn_02" href="">상세</a>
                        <a class="btn_04">접수</a>
                        <a class="btn_03">취소</a>
                    </td>
                </tr>

            <?/*php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $s_mod = '<a href="./compete_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['cp_idx'].'">보기/수정</a>';

                $bg = 'bg'.($i%2);
                $mb = get_member($row['mb_id']);
                ?>
                <tr class="<?php echo $bg; ?>">

                </tr>

                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            */?>
            </tbody>
        </table>
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    $(document).ready(function () {

    })

    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }

    function ctg_change(type) {

        var big_ctg = $("#big_ctg").val();
        if (type == 'small'){
            var small_ctg = $("#small_ctg").val();
        }else{
            var small_ctg = "";
        }
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "" || big_ctg != "" || small_ctg != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx+ "&big_ctg=" + big_ctg + "&small_ctg=" + small_ctg;
        }

        location.href = g5_admin_url + "/competition_list.php" + params;

    }

</script>

<?php
include_once ('./admin.tail.php');
?>
