<?php
$sub_menu = "350050";
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

$g5['title'] = '마켓 정산';
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
    .box{ padding: 0 20px;display: flex; flex-wrap: wrap; justify-content: space-between; margin: 10px 0 10px}
    .box .monthBox { width: calc( 100% / 6 - 10px ); text-align: center;  margin-bottom: 10px; cursor: pointer}
    .box .monthBox h2 { font-size: 1.2em;    color: #2c2c2c;    opacity: 1;    font-weight: 800;     background: #e4ebee;    margin-bottom: 0; padding: 5px 0 }
    .box .monthBox p { font-size: 1.05em; font-weight: 800;padding: 10px 0; border: 0px solid #e4ebee;background: rgba(228, 235, 238, 0.51);}
    .box .monthBox.monthBg h2 {  background: #BC2D1E!important; color: #fff!important;}
    .box .monthBox.monthBg p { color: #BC2D1E; background: #fdf6f6}

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
    <select name="" id="">
        <option value="">2024</option>
    </select>
    <select name="big_ctg" id="big_ctg" onchange="ctg_change('big');">
        <option value="">전체판매</option>
        <option value="">일반판매</option>
        <option value="">셀러판매</option>
    </select>
</form>
<div class="btn_add01 btn_add">
    <a>다운로드</a>
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
    <div class="box"><!--월 클릭시 해당 월 목록만-->
        <div class="monthBox" data-action="calcMonth" data-month="1">
            <h2>1월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="2">
            <h2>2월</h2>
            <p>300원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="3">
            <h2>3월</h2>
            <p>16,887,550원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="4">
            <h2>4월</h2>
            <p>26,837,340원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="5">
            <h2>5월</h2>
            <p>46,896,590원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="6">
            <h2>6월</h2>
            <p>45,374,780원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="7">
            <h2>7월</h2>
            <p>60,631,604원</p>
        </div>
        <div class="monthBox monthBg" data-action="calcMonth" data-month="8">
            <h2>8월</h2>
            <p>53,907,300원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="9">
            <h2>9월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="10">
            <h2>10월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="11">
            <h2>11월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="12">
            <h2>12월</h2>
            <p>0원</p>
        </div>
    </div>
    <div class="tbl_head02 tbl_wrap mb_tbl">

        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th>No</th>
                <th>판매일</th>
                <th>주문번호</th>
                <th>업체명</th>
                <th>상품명</th>
                <th>판매구분</th>
                <th>결제금액</th>
                <th>배송비</th>
                <th>결제수단</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>no</td>
                    <td>판매일</td>
                    <td>주문번호</td>
                    <td>업체명</td>
                    <td>상품명</td>
                    <td>일반/셀러</td>
                    <td>결제금액</td>
                    <td>배송비</td>
                    <td>결제수단</td>
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
