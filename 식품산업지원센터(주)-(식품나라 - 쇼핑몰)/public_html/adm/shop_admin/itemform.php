<?php
$sub_menu = '400300';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

auth_check($auth[$sub_menu], "w");

$html_title = "상품 ";

if ($w == "")
{
    $html_title .= "입력";

    // 옵션은 쿠키에 저장된 값을 보여줌. 다음 입력을 위한것임
    //$it[ca_id] = _COOKIE[ck_ca_id];
    $it['ca_id'] = get_cookie("ck_ca_id");
    $it['ca_id2'] = get_cookie("ck_ca_id2");
    $it['ca_id3'] = get_cookie("ck_ca_id3");
    if (!$it['ca_id'])
    {
        $sql = " select ca_id from {$g5['g5_shop_category_table']} order by ca_order, ca_id limit 1 ";
        $row = sql_fetch($sql);
        if (!$row['ca_id'])
            alert("등록된 분류가 없습니다. 우선 분류를 등록하여 주십시오.", './categorylist.php');
        $it['ca_id'] = $row['ca_id'];
    }
    //$it[it_maker]  = stripslashes($_COOKIE[ck_maker]);
    //$it[it_origin] = stripslashes($_COOKIE[ck_origin]);
    $it['it_maker']  = stripslashes(get_cookie("ck_maker"));
    $it['it_origin'] = stripslashes(get_cookie("ck_origin"));
}
else if ($w == "u")
{
    $html_title .= "수정";

    $sql = " select * from {$g5['g5_shop_item_table']} where it_id = '$it_id' ";
    $it = sql_fetch($sql);

    if(!$it)
        alert('상품정보가 존재하지 않습니다.');

	if ($is_admin != 'super')
    {
		if ($member['mb_id'] != $it['mb_id']) {
			alert("잘못된 접근입니다.");
		}
    }

    if (!$ca_id)
        $ca_id = $it['ca_id'];

    $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
}
else
{
    alert();
}

$qstr  = $qstr.'&amp;sca='.$sca.'&amp;page='.$page;

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');

// 분류리스트
$category_select = '';
$script = '';
$sql = " select * from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $len = strlen($row['ca_id']) / 2 - 1;

    $nbsp = "";
    for ($i=0; $i<$len; $i++)
        $nbsp .= "&nbsp;&nbsp;&nbsp;";

    $category_select .= "<option value=\"{$row['ca_id']}\">$nbsp{$row['ca_name']}</option>\n";

    $script .= "ca_use['{$row['ca_id']}'] = {$row['ca_use']};\n";
    $script .= "ca_stock_qty['{$row['ca_id']}'] = {$row['ca_stock_qty']};\n";
    //$script .= "ca_explan_html['$row[ca_id]'] = $row[ca_explan_html];\n";
    $script .= "ca_sell_email['{$row['ca_id']}'] = '{$row['ca_sell_email']}';\n";
}

// 재입고알림 설정 필드 추가
if(!sql_query(" select it_stock_sms from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_stock_sms` tinyint(4) NOT NULL DEFAULT '0' AFTER `it_stock_qty` ", true);
}

// 추가옵션 포인트 설정 필드 추가
if(!sql_query(" select it_supply_point from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_supply_point` int(11) NOT NULL DEFAULT '0' AFTER `it_point_type` ", true);
}

// 상품메모 필드 추가
if(!sql_query(" select it_shop_memo from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_shop_memo` text NOT NULL AFTER `it_use_avg` ", true);
}

// 지식쇼핑 PID 필드추가
// 상품메모 필드 추가
if(!sql_query(" select ec_mall_pid from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `ec_mall_pid` varchar(255) NOT NULL AFTER `it_shop_memo` ", true);
}

$pg_anchor ='<ul class="anchor">
<li><a href="#anc_sitfrm_ini">기본정보</a></li>
<li><a href="#anc_sitfrm_cost">가격 및 재고</a></li>
<li><a href="#anc_sitfrm_sendcost">배송비</a></li>
<li><a href="#anc_sitfrm_img">상품이미지</a></li>
<li><a href="#anc_sitfrm_relation">관련상품</a></li>
</ul>
';


// 쿠폰적용안함 설정 필드 추가
if(!sql_query(" select it_nocoupon from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_nocoupon` tinyint(4) NOT NULL DEFAULT '0' AFTER `it_use` ", true);
}

// 스킨필드 추가
if(!sql_query(" select it_skin from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_skin` varchar(255) NOT NULL DEFAULT '' AFTER `ca_id3`,
                    ADD `it_mobile_skin` varchar(255) NOT NULL DEFAULT '' AFTER `it_skin` ", true);
}

/***************************
추가
***************************/
// 회원아이디 추가
if(!sql_query(" select mb_id from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `mb_id` varchar(30) NOT NULL COMMENT '회원아이디' AFTER `it_id` ", true);
}

$mb_id = $member['mb_id'];
if ($w == "u") {
	$mb_id = ($it['mb_id'] != "")? $it['mb_id'] : $member['mb_id'];
}

?>
<style>
.tbl_wrap .noti {vertical-align: middle; margin-left: 5px; color: red;}
</style>

<form name="fitemform" action="./itemformupdate.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">

<input type="hidden" name="codedup" value="<?php echo $default['de_code_dup_use']; ?>">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod"  value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx"  value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<!-- 필드추가 -->
<input type="hidden" name="mb_id" value="<?=$mb_id?>">



<input type="hidden" name="it_notax" value="0"><!-- 상품과제유형 (0:과세, 1:비과세) -->


<section id="anc_sitfrm_ini">
    <h2 class="h2_frm">기본정보</h2>
    <?php echo $pg_anchor; ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>기본정보 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
		<tr>
			<th scope="row"><label for="ca_id">상품분류</label><span class="noti">*</span></th>
			<td colspan="2">
				<select name="ca_id" id="ca_id" onchange="categorychange(this.form)">
					<option value="">선택하세요</option>
					<?php echo conv_selected_option($category_select, $it['ca_id']); ?>
				</select>
				<script>
					var ca_use = new Array();
					var ca_stock_qty = new Array();
					//var ca_explan_html = new Array();
					var ca_sell_email = new Array();
					var ca_opt1_subject = new Array();
					var ca_opt2_subject = new Array();
					var ca_opt3_subject = new Array();
					var ca_opt4_subject = new Array();
					var ca_opt5_subject = new Array();
					var ca_opt6_subject = new Array();
					<?php echo "\n$script"; ?>
				</script>

				<? for ($i=2; $i<=3; $i++) { ?>
                <select name="ca_id<?php echo $i; ?>" id="ca_id<?php echo $i; ?>">
                    <option value="">선택하세요</option>
                    <?php echo conv_selected_option($category_select, $it['ca_id'.$i]); ?>
                </select>
				<? } ?>
		</tr>
        <tr>
            <th scope="row">상품코드</th>
            <td>
                <?php if ($w == '') { // 추가 ?>
                    <!-- 최근에 입력한 코드(자동 생성시)가 목록의 상단에 출력되게 하려면 아래의 코드로 대체하십시오. -->
                    <!-- <input type=text class=required name=it_id value="<?php echo 10000000000-time()?>" size=12 maxlength=10 required> <a href='javascript:;' onclick="codedupcheck(document.all.it_id.value)"><img src='./img/btn_code.gif' border=0 align=absmiddle></a> -->
                    <?php echo help("상품의 코드는 10자리 숫자로 자동생성합니다. <b>직접 상품코드를 입력할 수도 있습니다.</b>\n상품코드는 영문자, 숫자, - 만 입력 가능합니다."); ?>
                    <input type="text" name="it_id" value="<?php echo time(); ?>" id="it_id" required class="frm_input required" size="20" maxlength="20">
                    <!-- <?php if ($default['de_code_dup_use']) { ?><button type="button" class="btn_frmline" onclick="codedupcheck(document.all.it_id.value)">중복검사</a><?php } ?> -->
                <?php } else { ?>
                    <input type="hidden" name="it_id" value="<?php echo $it['it_id']; ?>">
                    <span class="frm_ca_id"><?php echo $it['it_id']; ?></span>
                    <a href="<?php echo G5_SHOP_URL; ?>/item.php?it_id=<?php echo $it_id; ?>" class="btn_frmline">상품확인</a>
                    <a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/itemuselist.php?sfl=a.it_id&amp;stx=<?php echo $it_id; ?>" class="btn_frmline">사용후기</a>
                    <a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/itemqalist.php?sfl=a.it_id&amp;stx=<?php echo $it_id; ?>" class="btn_frmline">상품문의</a>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_name">상품명</label><span class="noti">*</span></th>
            <td><input type="text" name="it_name" value="<?php echo get_text(cut_str($it['it_name'], 250, "")); ?>" id="it_name" required class="frm_input required" size="95"></td>
        </tr>
		<tr>
            <th scope="row"><label for="it_order">출력순서</label></th>
            <td>
                <?php echo help("숫자가 작을 수록 상위에 출력됩니다. 음수 입력도 가능하며 입력 가능 범위는 -2147483648 부터 2147483647 까지입니다.\n<b>입력하지 않으면 자동으로 출력됩니다.</b>"); ?>
                <input type="text" name="it_order" value="<?php echo $it['it_order']; ?>" id="it_order" class="frm_input" size="12">
            </td>
           
        </tr>
        <tr>
            <th scope="row"><label for="it_basic">기본설명</label></th>
            <td>
                <?php echo help("상품명 하단에 상품에 대한 추가적인 설명이 필요한 경우에 입력합니다."); ?>
                <input type="text" name="it_basic" value="<?php echo get_text($it['it_basic']); ?>" id="it_basic" class="frm_input" size="95">
            </td>
        </tr>
       
        <tr>
            <th scope="row"><label for="it_maker">제조사</label></th>
            <td>
                <?php echo help("입력하지 않으면 상품상세페이지에 출력하지 않습니다."); ?>
                <input type="text" name="it_maker" value="<?php echo get_text($it['it_maker']); ?>" id="it_maker" class="frm_input" size="40">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_origin">원산지</label></th>
            <td>
                <?php echo help("입력하지 않으면 상품상세페이지에 출력하지 않습니다."); ?>
                <input type="text" name="it_origin" value="<?php echo get_text($it['it_origin']); ?>" id="it_origin" class="frm_input" size="40">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_brand">브랜드</label></th>
            <td>
                <?php echo help("입력하지 않으면 상품상세페이지에 출력하지 않습니다."); ?>
                <input type="text" name="it_brand" value="<?php echo get_text($it['it_brand']); ?>" id="it_brand" class="frm_input" size="40">
            </td>
        </tr>
		<tr>
            <th scope="row">상품유형</th>
            <td>
                <?php echo help("메인화면에 유형별로 출력할때 사용합니다.\n이곳에 체크하게되면 상품리스트에서 유형별로 정렬할때 체크된 상품이 가장 먼저 출력됩니다."); ?>
                <input type="checkbox" name="it_type1" value="1" <?php echo ($it['it_type1'] ? "checked" : ""); ?> id="it_type1">
                <label for="it_type1">히트 <img src="<?php echo G5_SHOP_URL; ?>/img/icon_hit.gif" alt=""></label>
                <input type="checkbox" name="it_type2" value="1" <?php echo ($it['it_type2'] ? "checked" : ""); ?> id="it_type2">
                <label for="it_type2">추천 <img src="<?php echo G5_SHOP_URL; ?>/img/icon_rec.gif" alt=""></label>
                <input type="checkbox" name="it_type3" value="1" <?php echo ($it['it_type3'] ? "checked" : ""); ?> id="it_type3">
                <label for="it_type3">신상품 <img src="<?php echo G5_SHOP_URL; ?>/img/icon_new.gif" alt=""></label>
                <input type="checkbox" name="it_type4" value="1" <?php echo ($it['it_type4'] ? "checked" : ""); ?> id="it_type4">
                <label for="it_type4">인기 <img src="<?php echo G5_SHOP_URL; ?>/img/icon_best.gif" alt=""></label>
                <input type="checkbox" name="it_type5" value="1" <?php echo ($it['it_type5'] ? "checked" : ""); ?> id="it_type5">
                <label for="it_type5">할인 <img src="<?php echo G5_SHOP_URL; ?>/img/icon_discount.gif" alt=""></label>
				<input type="checkbox" name="it_type6" value="1" <?php echo ($it['it_type6'] ? "checked" : ""); ?> id="it_type5">
                <label for="it_type6">할인</label>
            </td>
            
        </tr>
        <!--<tr>
            <th scope="row"><label for="it_model">모델</label></th>
            <td>
                <?php echo help("입력하지 않으면 상품상세페이지에 출력하지 않습니다."); ?>
                <input type="text" name="it_model" value="<?php echo get_text($it['it_model']); ?>" id="it_model" class="frm_input" size="40">
            </td>
        </tr>-->
        <tr>
            <th scope="row"><label for="it_tel_inq">전화문의</label></th>
            <td>
                <?php echo help("상품 금액 대신 전화문의로 표시됩니다."); ?>
                <input type="checkbox" name="it_tel_inq" value="1" id="it_tel_inq" <?php echo ($it['it_tel_inq']) ? "checked" : ""; ?>> 예
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_use">판매가능</label></th>
            <td>
                <?php echo help("체크 : 정상판매<br>체크해제 : 쇼핑몰에 노출되지 않음"); ?>
                <input type="checkbox" name="it_use" value="1" id="it_use" <?php echo ($it['it_use']) ? "checked" : ""; ?>> 예
            </td>
        </tr>
        <tr>
            <th scope="row">상품설명<span class="noti">*</span></th>
            <td><?php echo editor_html('it_explan', get_text($it['it_explan'], 0)); ?></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<section id="anc_sitfrm_cost">
    <h2 class="h2_frm">가격 및 재고</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>가격 및 재고 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="it_price">가격</label><span class="noti">*</span></th>
            <td><input type="text" name="it_price" value="<?php echo $it['it_price']; ?>" id="it_price" class="frm_input" size="8" required> 원</td>
        </tr>
        <tr>
            <th scope="row"><label for="it_cust_price">시중가격</label></th>
            <td>
                <?php echo help("입력하지 않으면 상품상세페이지에 출력하지 않습니다."); ?>
                <input type="text" name="it_cust_price" value="<?php echo $it['it_cust_price']; ?>" id="it_cust_price" class="frm_input" size="8"> 원
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_soldout">상품품절</label></th>
            <td>
                <?php echo help("체크 : 품절상품으로 표시 (잠시 판매를 중단하거나 재고가 없을 경우)<br>체크해제 : 정상판매"); ?>
                <input type="checkbox" name="it_soldout" value="1" id="it_soldout" <?php echo ($it['it_soldout']) ? "checked" : ""; ?>> 예
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_stock_qty">재고수량</label></th>
            <td>
                <?php echo help("<b>주문관리에서 상품별 상태 변경에 따라 자동으로 재고를 가감합니다.</b><br>재고는 옵션별이 아닌, 상품별로만 관리됩니다.<br>재고수량을 0으로 설정하시면 품절상품으로 표시됩니다."); ?>
                <input type="text" name="it_stock_qty" value="<?php echo $it['it_stock_qty']; ?>" id="it_stock_qty" class="frm_input" size="8"> 개
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_buy_min_qty">최소구매수량</label></th>
            <td>
                <?php echo help("상품 구매시 최소 구매 수량을 설정합니다."); ?>
                <input type="text" name="it_buy_min_qty" value="<?php echo $it['it_buy_min_qty']; ?>" id="it_buy_min_qty" class="frm_input" size="8"> 개
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_buy_max_qty">최대구매수량</label></th>
            <td>
                <?php echo help("상품 구매시 최대 구매 수량을 설정합니다."); ?>
                <input type="text" name="it_buy_max_qty" value="<?php echo $it['it_buy_max_qty']; ?>" id="it_buy_max_qty" class="frm_input" size="8"> 개
            </td>
        </tr>
        <?php
        $opt_subject = explode(',', $it['it_option_subject']);
        ?>
        <tr>
            <th scope="row">상품선택옵션</th>
            <td>
                <div class="sit_option tbl_frm01">
                    <?php echo help('옵션항목은 콤마(,) 로 구분하여 여러개를 입력할 수 있습니다. 옷을 예로 들어 [옵션1 : 사이즈 , 옵션1 항목 : XXL,XL,L,M,S] , [옵션2 : 색상 , 옵션2 항목 : 빨,파,노]<br><strong>옵션명과 옵션항목에 따옴표(\', ")는 입력할 수 없습니다.</strong>'); ?>
                    <table>
                    <caption>상품선택옵션 입력</caption>
                    <colgroup>
                        <col class="grid_4">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row">
                            <label for="opt1_subject">옵션1</label>
                            <input type="text" name="opt1_subject" value="<?php echo $opt_subject[0]; ?>" id="opt1_subject" class="frm_input" size="15">
                        </th>
                        <td>
                            <label for="opt1"><b>옵션1 항목</b></label>
                            <input type="text" name="opt1" value="" id="opt1" class="frm_input" size="50">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="opt2_subject">옵션2</label>
                            <input type="text" name="opt2_subject" value="<?php echo $opt_subject[1]; ?>" id="opt2_subject" class="frm_input" size="15">
                        </th>
                        <td>
                            <label for="opt2"><b>옵션2 항목</b></label>
                            <input type="text" name="opt2" value="" id="opt2" class="frm_input" size="50">
                        </td>
                    </tr>
                     <tr>
                        <th scope="row">
                            <label for="opt3_subject">옵션3</label>
                            <input type="text" name="opt3_subject" value="<?php echo $opt_subject[2]; ?>" id="opt3_subject" class="frm_input" size="15">
                        </th>
                        <td>
                            <label for="opt3"><b>옵션3 항목</b></label>
                            <input type="text" name="opt3" value="" id="opt3" class="frm_input" size="50">
                        </td>
                    </tr>
                    </tbody>
                    </table>
                    <div class="btn_confirm02 btn_confirm">
                        <button type="button" id="option_table_create" class="btn_frmline">옵션목록생성</button>
                    </div>
                </div>
                <div id="sit_option_frm"><?php include_once(G5_ADMIN_PATH.'/shop_admin/itemoption.php'); ?></div>

                <script>
                $(function() {
                    <?php if($it['it_id'] && $po_run) { ?>
                    //옵션항목설정
                    var arr_opt1 = new Array();
                    var arr_opt2 = new Array();
                    var arr_opt3 = new Array();
                    var opt1 = opt2 = opt3 = '';
                    var opt_val;

                    $(".opt-cell").each(function() {
                        opt_val = $(this).text().split(" > ");
                        opt1 = opt_val[0];
                        opt2 = opt_val[1];
                        opt3 = opt_val[2];

                        if(opt1 && $.inArray(opt1, arr_opt1) == -1)
                            arr_opt1.push(opt1);

                        if(opt2 && $.inArray(opt2, arr_opt2) == -1)
                            arr_opt2.push(opt2);

                        if(opt3 && $.inArray(opt3, arr_opt3) == -1)
                            arr_opt3.push(opt3);
                    });


                    $("input[name=opt1]").val(arr_opt1.join());
                    $("input[name=opt2]").val(arr_opt2.join());
                    $("input[name=opt3]").val(arr_opt3.join());
                    <?php } ?>
                    // 옵션목록생성
                    $("#option_table_create").click(function() {
                        var it_id = $.trim($("input[name=it_id]").val());
                        var opt1_subject = $.trim($("#opt1_subject").val());
                        var opt2_subject = $.trim($("#opt2_subject").val());
                        var opt3_subject = $.trim($("#opt3_subject").val());
                        var opt1 = $.trim($("#opt1").val());
                        var opt2 = $.trim($("#opt2").val());
                        var opt3 = $.trim($("#opt3").val());
                        var $option_table = $("#sit_option_frm");

                        if(!opt1_subject || !opt1) {
                            alert("옵션명과 옵션항목을 입력해 주십시오.");
                            return false;
                        }

                        $.post(
                            "<?php echo G5_ADMIN_URL; ?>/shop_admin/itemoption.php",
                            { it_id: it_id, w: "<?php echo $w; ?>", opt1_subject: opt1_subject, opt2_subject: opt2_subject, opt3_subject: opt3_subject, opt1: opt1, opt2: opt2, opt3: opt3 },
                            function(data) {
                                $option_table.empty().html(data);
                            }
                        );
                    });

                    // 모두선택
                    $(document).on("click", "input[name=opt_chk_all]", function() {
                        if($(this).is(":checked")) {
                            $("input[name='opt_chk[]']").attr("checked", true);
                        } else {
                            $("input[name='opt_chk[]']").attr("checked", false);
                        }
                    });

                    // 선택삭제
                    $(document).on("click", "#sel_option_delete", function() {
                        var $el = $("input[name='opt_chk[]']:checked");
                        if($el.size() < 1) {
                            alert("삭제하려는 옵션을 하나 이상 선택해 주십시오.");
                            return false;
                        }

                        $el.closest("tr").remove();
                    });

                    // 일괄적용
                    $(document).on("click", "#opt_value_apply", function() {
                        if($(".opt_com_chk:checked").size() < 1) {
                            alert("일괄 수정할 항목을 하나이상 체크해 주십시오.");
                            return false;
                        }

                        var opt_price = $.trim($("#opt_com_price").val());
                        var opt_stock = $.trim($("#opt_com_stock").val());
                        var opt_noti = $.trim($("#opt_com_noti").val());
                        var opt_use = $("#opt_com_use").val();
                        var $el = $("input[name='opt_chk[]']:checked");

                        // 체크된 옵션이 있으면 체크된 것만 적용
                        if($el.size() > 0) {
                            var $tr;
                            $el.each(function() {
                                $tr = $(this).closest("tr");

                                if($("#opt_com_price_chk").is(":checked"))
                                    $tr.find("input[name='opt_price[]']").val(opt_price);

                                if($("#opt_com_stock_chk").is(":checked"))
                                    $tr.find("input[name='opt_stock_qty[]']").val(opt_stock);

                                if($("#opt_com_noti_chk").is(":checked"))
                                    $tr.find("input[name='opt_noti_qty[]']").val(opt_noti);

                                if($("#opt_com_use_chk").is(":checked"))
                                    $tr.find("select[name='opt_use[]']").val(opt_use);
                            });
                        } else {
                            if($("#opt_com_price_chk").is(":checked"))
                                $("input[name='opt_price[]']").val(opt_price);

                            if($("#opt_com_stock_chk").is(":checked"))
                                $("input[name='opt_stock_qty[]']").val(opt_stock);

                            if($("#opt_com_noti_chk").is(":checked"))
                                $("input[name='opt_noti_qty[]']").val(opt_noti);

                            if($("#opt_com_use_chk").is(":checked"))
                                $("select[name='opt_use[]']").val(opt_use);
                        }
                    });
                });
                </script>
            </td>
        </tr>
        <?php
        $spl_subject = explode(',', $it['it_supply_subject']);
        $spl_count = count($spl_subject);
        ?>
        <tr>
            <th scope="row">상품추가옵션</th>
            <td>
                <div id="sit_supply_frm" class="sit_option tbl_frm01">
                    <?php echo help('옵션항목은 콤마(,) 로 구분하여 여러개를 입력할 수 있습니다. 스마트폰을 예로 들어 [추가1 : 추가구성상품 , 추가1 항목 : 액정보호필름,케이스,충전기]<br><strong>옵션명과 옵션항목에 따옴표(\', ")는 입력할 수 없습니다.</strong>'); ?>
                    <table>
                    <caption>상품추가옵션 입력</caption>
                    <colgroup>
                        <col class="grid_4">
                        <col>
                    </colgroup>
                    <tbody>
                    <?php
                    $i = 0;
                    do {
                        $seq = $i + 1;
                    ?>
                    <tr>
                        <th scope="row">
                            <label for="spl_subject_<?php echo $seq; ?>">추가<?php echo $seq; ?></label>
                            <input type="text" name="spl_subject[]" id="spl_subject_<?php echo $seq; ?>" value="<?php echo $spl_subject[$i]; ?>" class="frm_input" size="15">
                        </th>
                        <td>
                            <label for="spl_item_<?php echo $seq; ?>"><b>추가<?php echo $seq; ?> 항목</b></label>
                            <input type="text" name="spl[]" id="spl_item_<?php echo $seq; ?>" value="" class="frm_input" size="40">
                            <?php
                            if($i > 0)
                                echo '<button type="button" id="del_supply_row" class="btn_frmline">삭제</button>';
                            ?>
                        </td>
                    </tr>
                    <?php
                        $i++;
                    } while($i < $spl_count);
                    ?>
                    </tbody>
                    </table>
                    <div id="sit_option_addfrm_btn"><button type="button" id="add_supply_row" class="btn_frmline">옵션추가</button></div>
                    <div class="btn_confirm02 btn_confirm">
                        <button type="button" id="supply_table_create">옵션목록생성</button>
                    </div>
                </div>
                <div id="sit_option_addfrm"><?php include_once(G5_ADMIN_PATH.'/shop_admin/itemsupply.php'); ?></div>

                <script>
                $(function() {
                    <?php if($it['it_id'] && $ps_run) { ?>
                    // 추가옵션의 항목 설정
                    var arr_subj = new Array();
                    var subj, spl;

                    $("input[name='spl_subject[]']").each(function() {
                        subj = $.trim($(this).val());
                        if(subj && $.inArray(subj, arr_subj) == -1)
                            arr_subj.push(subj);
                    });

                    for(i=0; i<arr_subj.length; i++) {
                        var arr_spl = new Array();
                        $(".spl-subject-cell").each(function(index) {
                            subj = $(this).text();
                            if(subj == arr_subj[i]) {
                                spl = $(".spl-cell:eq("+index+")").text();
                                arr_spl.push(spl);
                            }
                        });

                        $("input[name='spl[]']:eq("+i+")").val(arr_spl.join());
                    }
                    <?php } ?>
                    // 입력필드추가
                    $("#add_supply_row").click(function() {
                        var $el = $("#sit_supply_frm tr:last");
                        var fld = "<tr>\n";
                        fld += "<th scope=\"row\">\n";
                        fld += "<label for=\"\">추가</label>\n";
                        fld += "<input type=\"text\" name=\"spl_subject[]\" value=\"\" class=\"frm_input\" size=\"15\">\n";
                        fld += "</th>\n";
                        fld += "<td>\n";
                        fld += "<label for=\"\"><b>추가 항목</b></label>\n";
                        fld += "<input type=\"text\" name=\"spl[]\" value=\"\" class=\"frm_input\" size=\"40\">\n";
                        fld += "<button type=\"button\" id=\"del_supply_row\" class=\"btn_frmline\">삭제</button>\n";
                        fld += "</td>\n";
                        fld += "</tr>";

                        $el.after(fld);

                        supply_sequence();
                    });

                    // 입력필드삭제
                    $(document).on("click", "#del_supply_row", function() {
                        $(this).closest("tr").remove();

                        supply_sequence();
                    });

                    // 옵션목록생성
                    $("#supply_table_create").click(function() {
                        var it_id = $.trim($("input[name=it_id]").val());
                        var subject = new Array();
                        var supply = new Array();
                        var subj, spl;
                        var count = 0;
                        var $el_subj = $("input[name='spl_subject[]']");
                        var $el_spl = $("input[name='spl[]']");
                        var $supply_table = $("#sit_option_addfrm");

                        $el_subj.each(function(index) {
                            subj = $.trim($(this).val());
                            spl = $.trim($el_spl.eq(index).val());

                            if(subj && spl) {
                                subject.push(subj);
                                supply.push(spl);
                                count++;
                            }
                        });

                        if(!count) {
                            alert("추가옵션명과 추가옵션항목을 입력해 주십시오.");
                            return false;
                        }

                        $.post(
                            "<?php echo G5_ADMIN_URL; ?>/shop_admin/itemsupply.php",
                            { it_id: it_id, w: "<?php echo $w; ?>", 'subject[]': subject, 'supply[]': supply },
                            function(data) {
                                $supply_table.empty().html(data);
                            }
                        );
                    });

                    // 모두선택
                    $(document).on("click", "input[name=spl_chk_all]", function() {
                        if($(this).is(":checked")) {
                            $("input[name='spl_chk[]']").attr("checked", true);
                        } else {
                            $("input[name='spl_chk[]']").attr("checked", false);
                        }
                    });

                    // 선택삭제
                    $(document).on("click", "#sel_supply_delete", function() {
                        var $el = $("input[name='spl_chk[]']:checked");
                        if($el.size() < 1) {
                            alert("삭제하려는 옵션을 하나 이상 선택해 주십시오.");
                            return false;
                        }

                        $el.closest("tr").remove();
                    });

                    // 일괄적용
                    $(document).on("click", "#spl_value_apply", function() {
                        if($(".spl_com_chk:checked").size() < 1) {
                            alert("일괄 수정할 항목을 하나이상 체크해 주십시오.");
                            return false;
                        }

                        var spl_price = $.trim($("#spl_com_price").val());
                        var spl_stock = $.trim($("#spl_com_stock").val());
                        var spl_noti = $.trim($("#spl_com_noti").val());
                        var spl_use = $("#spl_com_use").val();
                        var $el = $("input[name='spl_chk[]']:checked");

                        // 체크된 옵션이 있으면 체크된 것만 적용
                        if($el.size() > 0) {
                            var $tr;
                            $el.each(function() {
                                $tr = $(this).closest("tr");

                                if($("#spl_com_price_chk").is(":checked"))
                                    $tr.find("input[name='spl_price[]']").val(spl_price);

                                if($("#spl_com_stock_chk").is(":checked"))
                                    $tr.find("input[name='spl_stock_qty[]']").val(spl_stock);

                                if($("#spl_com_noti_chk").is(":checked"))
                                    $tr.find("input[name='spl_noti_qty[]']").val(spl_noti);

                                if($("#spl_com_use_chk").is(":checked"))
                                    $tr.find("select[name='spl_use[]']").val(spl_use);
                            });
                        } else {
                            if($("#spl_com_price_chk").is(":checked"))
                                $("input[name='spl_price[]']").val(spl_price);

                            if($("#spl_com_stock_chk").is(":checked"))
                                $("input[name='spl_stock_qty[]']").val(spl_stock);

                            if($("#spl_com_noti_chk").is(":checked"))
                                $("input[name='spl_noti_qty[]']").val(spl_noti);

                            if($("#spl_com_use_chk").is(":checked"))
                                $("select[name='spl_use[]']").val(spl_use);
                        }
                    });
                });

                function supply_sequence()
                {
                    var $tr = $("#sit_supply_frm tr");
                    var seq;
                    var th_label, td_label;

                    $tr.each(function(index) {
                        seq = index + 1;
                        $(this).find("th label").attr("for", "spl_subject_"+seq).text("추가"+seq);
                        $(this).find("th input").attr("id", "spl_subject_"+seq);
                        $(this).find("td label").attr("for", "spl_item_"+seq);
                        $(this).find("td label b").text("추가"+seq+" 항목");
                        $(this).find("td input").attr("id", "spl_item_"+seq);
                    });
                }
                </script>
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>


<section id="anc_sitfrm_sendcost">
    <h2 class="h2_frm">배송비</h2>
    <?php echo $pg_anchor; ?>
	<!--<div class="local_desc02 local_desc">
        <p>쇼핑몰설정 &gt; 배송비유형 설정보다 <strong>개별상품 배송비설정이 우선</strong> 적용됩니다.</p>
    </div>-->

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>배송비 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
            <tr>
                <th scope="row"><label for="it_sc_type">배송비 유형</label></th>
                <td>
                    <?php echo help("배송비 유형을 선택하면 자동으로 항목이 변환됩니다."); ?>
                    <select name="it_sc_type" id="it_sc_type">
                        <option value="0"<?php echo get_selected('0', $it['it_sc_type']); ?>>쇼핑몰 기본설정 사용</option>
                        <option value="1"<?php echo get_selected('1', $it['it_sc_type']); ?>>무료배송</option>
                        <option value="2"<?php echo get_selected('2', $it['it_sc_type']); ?>>조건부 무료배송</option>
                        <option value="3"<?php echo get_selected('3', $it['it_sc_type']); ?>>유료배송</option>
                        <option value="4"<?php echo get_selected('4', $it['it_sc_type']); ?>>수량별 부과</option>
                    </select>
                </td>
            </tr>
            <tr id="sc_con_method">
                <th scope="row"><label for="it_sc_method">배송비 결제</label></th>
                <td>
                    <select name="it_sc_method" id="it_sc_method">
                        <option value="0"<?php echo get_selected('0', $it['it_sc_method']); ?>>선불</option>
                        <option value="1"<?php echo get_selected('1', $it['it_sc_method']); ?>>착불</option>
                        <option value="2"<?php echo get_selected('2', $it['it_sc_method']); ?>>사용자선택</option>
                    </select>
                </td>
            </tr>
            <tr id="sc_con_basic">
                <th scope="row"><label for="it_sc_price">기본배송비</label></th>
                <td>
                    <?php echo help("무료배송 이외의 설정에 적용되는 배송비 금액입니다."); ?>
                    <input type="text" name="it_sc_price" value="<?php echo $it['it_sc_price']; ?>" id="it_sc_price" class="frm_input" size="8"> 원
                </td>
            </tr>
            <tr id="sc_con_minimum">
                <th scope="row"><label for="it_sc_minimum">배송비 상세조건</label></th>
                <td>
                    주문금액 <input type="text" name="it_sc_minimum" value="<?php echo $it['it_sc_minimum']; ?>" id="it_sc_minimum" class="frm_input" size="8"> 이상 무료 배송
                </td>
            </tr>
            <tr id="sc_con_qty">
                <th scope="row"><label for="it_sc_qty">배송비 상세조건</label></th>
                <td>
                    <?php echo help("상품의 주문 수량에 따라 배송비가 부과됩니다. 예를 들어 기본배송비가 3,000원 수량을 3으로 설정했을 경우 상품의 주문수량이 5개이면 6,000원 배송비가 부과됩니다."); ?>
                    주문수량 <input type="text" name="it_sc_qty" value="<?php echo $it['it_sc_qty']; ?>" id="it_sc_qty" class="frm_input" size="8"> 마다 배송비 부과
                </td>
            </tr>
        </tbody>
        </table>
    </div>

    <script>
    $(function() {
        <?php
        switch($it['it_sc_type']) {
            case 1:
                echo '$("#sc_con_method").hide();'.PHP_EOL;
                echo '$("#sc_con_basic").hide();'.PHP_EOL;
                echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                echo '$("#sc_con_qty").hide();'.PHP_EOL;
                echo '$("#sc_grp").attr("rowspan","1");'.PHP_EOL;
                break;
            case 2:
                echo '$("#sc_con_method").show();'.PHP_EOL;
                echo '$("#sc_con_basic").show();'.PHP_EOL;
                echo '$("#sc_con_minimum").show();'.PHP_EOL;
                echo '$("#sc_con_qty").hide();'.PHP_EOL;
                echo '$("#sc_grp").attr("rowspan","4");'.PHP_EOL;
                break;
            case 3:
                echo '$("#sc_con_method").show();'.PHP_EOL;
                echo '$("#sc_con_basic").show();'.PHP_EOL;
                echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                echo '$("#sc_con_qty").hide();'.PHP_EOL;
                echo '$("#sc_grp").attr("rowspan","3");'.PHP_EOL;
                break;
            case 4:
                echo '$("#sc_con_method").show();'.PHP_EOL;
                echo '$("#sc_con_basic").show();'.PHP_EOL;
                echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                echo '$("#sc_con_qty").show();'.PHP_EOL;
                echo '$("#sc_grp").attr("rowspan","4");'.PHP_EOL;
                break;
            default:
                echo '$("#sc_con_method").hide();'.PHP_EOL;
                echo '$("#sc_con_basic").hide();'.PHP_EOL;
                echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                echo '$("#sc_con_qty").hide();'.PHP_EOL;
                echo '$("#sc_grp").attr("rowspan","2");'.PHP_EOL;
                break;
        }
        ?>
        $("#it_sc_type").change(function() {
            var type = $(this).val();

            switch(type) {
                case "1":
                    $("#sc_con_method").hide();
                    $("#sc_con_basic").hide();
                    $("#sc_con_minimum").hide();
                    $("#sc_con_qty").hide();
                    $("#sc_grp").attr("rowspan","1");
                    break;
                case "2":
                    $("#sc_con_method").show();
                    $("#sc_con_basic").show();
                    $("#sc_con_minimum").show();
                    $("#sc_con_qty").hide();
                    $("#sc_grp").attr("rowspan","4");
                    break;
                case "3":
                    $("#sc_con_method").show();
                    $("#sc_con_basic").show();
                    $("#sc_con_minimum").hide();
                    $("#sc_con_qty").hide();
                    $("#sc_grp").attr("rowspan","3");
                    break;
                case "4":
                    $("#sc_con_method").show();
                    $("#sc_con_basic").show();
                    $("#sc_con_minimum").hide();
                    $("#sc_con_qty").show();
                    $("#sc_grp").attr("rowspan","4");
                    break;
                default:
                    $("#sc_con_method").hide();
                    $("#sc_con_basic").hide();
                    $("#sc_con_minimum").hide();
                    $("#sc_con_qty").hide();
                    $("#sc_grp").attr("rowspan","1");
                    break;
            }
        });
    });
    </script>
</section>


<section id="anc_sitfrm_img">
    <h2 class="h2_frm">상품이미지</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>이미지 업로드</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <?php for($i=1; $i<=10; $i++) { ?>
        <tr>
            <th scope="row"><label for="it_img<?php echo $i; ?>">이미지 <?php echo $i; ?></label></th>
            <td>
                <input type="file" name="it_img<?php echo $i; ?>" id="it_img<?php echo $i; ?>">
                <?php
                $it_img = G5_DATA_PATH.'/item/'.$it['it_img'.$i];
                if(is_file($it_img) && $it['it_img'.$i]) {
                    $size = @getimagesize($it_img);
                    $thumb = get_it_thumbnail($it['it_img'.$i], 25, 25);
                ?>
                <label for="it_img<?php echo $i; ?>_del"><span class="sound_only">이미지 <?php echo $i; ?> </span>파일삭제</label>
                <input type="checkbox" name="it_img<?php echo $i; ?>_del" id="it_img<?php echo $i; ?>_del" value="1">
                <span class="sit_wimg_limg<?php echo $i; ?>"><?php echo $thumb; ?></span>
                <div id="limg<?php echo $i; ?>" class="banner_or_img">
                    <img src="<?php echo G5_DATA_URL; ?>/item/<?php echo $it['it_img'.$i]; ?>" alt="" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
                    <button type="button" class="sit_wimg_close">닫기</button>
                </div>
                <script>
                $('<button type="button" id="it_limg<?php echo $i; ?>_view" class="btn_frmline sit_wimg_view">이미지<?php echo $i; ?> 확인</button>').appendTo('.sit_wimg_limg<?php echo $i; ?>');
                </script>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</section>


<section id="anc_sitfrm_relation" class="srel">
    <h2 class="h2_frm">관련상품</h2>
    <?php echo $pg_anchor; ?>

    <div class="local_desc02 local_desc">
        <p>
            등록된 전체상품 목록에서 상품분류를 선택하면 해당 상품 리스트가 연이어 나타납니다.<br>
            상품리스트에서 관련 상품으로 추가하시면 선택된 관련상품 목록에 <strong>함께</strong> 추가됩니다.<br>
            예를 들어, A 상품에 B 상품을 관련상품으로 등록하면 B 상품에도 A 상품이 관련상품으로 자동 추가되며, <strong>확인 버튼을 누르셔야 정상 반영됩니다.</strong>
        </p>
    </div>

    <div class="compare_wrap">
        <section class="compare_left">
            <h3>등록된 전체상품 목록</h3>
            <label for="sch_relation" class="sound_only">상품분류</label>
            <span class="srel_pad">
                <select id="sch_relation">
                    <option value=''>분류별 상품</option>
                    <?php
                        $sql = " select * from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
                        $result = sql_query($sql);
                        for ($i=0; $row=sql_fetch_array($result); $i++)
                        {
                            $len = strlen($row['ca_id']) / 2 - 1;

                            $nbsp = "";
                            for ($i=0; $i<$len; $i++)
                                $nbsp .= "&nbsp;&nbsp;&nbsp;";

                            echo "<option value=\"{$row['ca_id']}\">$nbsp{$row['ca_name']}</option>\n";
                        }
                    ?>
                </select>
                <label for="sch_name" class="sound_only">상품명</label>
                <input type="text" name="sch_name" id="sch_name" class="frm_input" size="15">
                <button type="button" id="btn_search_item" class="btn_frmline">검색</button>
            </span>
            <div id="relation" class="srel_list">
                <p>상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>
            </div>
            <script>
            $(function() {
                $("#btn_search_item").click(function() {
                    var ca_id = $("#sch_relation").val();
                    var it_name = $.trim($("#sch_name").val());
                    var $relation = $("#relation");

                    if(ca_id == "" && it_name == "") {
                        $relation.html("<p>상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>");
                        return false;
                    }

                    $("#relation").load(
                        "./itemformrelation.php",
                        { it_id: "<?php echo $it_id; ?>", ca_id: ca_id, it_name: it_name }
                    );
                });

                $(document).on("click", "#relation .add_item", function() {
                    // 이미 등록된 상품인지 체크
                    var $li = $(this).closest("li");
                    var it_id = $li.find("input:hidden").val();
                    var it_id2;
                    var dup = false;
                    $("#reg_relation input[name='re_it_id[]']").each(function() {
                        it_id2 = $(this).val();
                        if(it_id == it_id2) {
                            dup = true;
                            return false;
                        }
                    });

                    if(dup) {
                        alert("이미 선택된 상품입니다.");
                        return false;
                    }

                    var cont = "<li>"+$li.html().replace("add_item", "del_item").replace("추가", "삭제")+"</li>";
                    var count = $("#reg_relation li").size();

                    if(count > 0) {
                        $("#reg_relation li:last").after(cont);
                    } else {
                        $("#reg_relation").html("<ul>"+cont+"</ul>");
                    }

                    $li.remove();
                });

                $(document).on("click", "#reg_relation .del_item", function() {
                    if(!confirm("상품을 삭제하시겠습니까?"))
                        return false;

                    $(this).closest("li").remove();

                    var count = $("#reg_relation li").size();
                    if(count < 1)
                        $("#reg_relation").html("<p>선택된 상품이 없습니다.</p>");
                });
            });
            </script>
        </section>

        <section class="compare_right">
            <h3>선택된 관련상품 목록</h3>
            <span class="srel_pad"></span>
            <div id="reg_relation" class="srel_sel">
                <?php
                $str = array();
                $sql = " select b.ca_id, b.it_id, b.it_name, b.it_price
                           from {$g5['g5_shop_item_relation_table']} a
                           left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id)
                          where a.it_id = '$it_id'
                          order by ir_no asc ";
                $result = sql_query($sql);
                for($g=0; $row=sql_fetch_array($result); $g++)
                {
                    $it_name = get_it_image($row['it_id'], 50, 50).' '.$row['it_name'];

                    if($g==0)
                        echo '<ul>';
                ?>
                    <li>
                        <input type="hidden" name="re_it_id[]" value="<?php echo $row['it_id']; ?>">
                        <div class="list_item"><?php echo $it_name; ?></div>
                        <div class="list_item_btn"><button type="button" class="del_item btn_frmline">삭제</button></div>
                    </li>
                <?php
                    $str[] = $row['it_id'];
                }
                $str = implode(",", $str);

                if($g > 0)
                    echo '</ul>';
                else
                    echo '<p>선택된 상품이 없습니다.</p>';
                ?>
            </div>
            <input type="hidden" name="it_list" value="<?php echo $str; ?>">
        </section>
    </div>
</section>

<div class="btn_fixed_top">
    <a href="./itemlist.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
	<? if ($w == "u") { ?>
    <a href="<?php echo G5_SHOP_URL ;?>/item.php?it_id=<?php echo $it_id ;?>" class="btn_02 btn" target="_blank">상품보기</a>
	<? } ?>
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
</div>
</form>


<script>
var f = document.fitemform;

<?php if ($w == 'u') { ?>
$(".banner_or_img").addClass("sit_wimg");

$(function() {
    $(".sit_wimg_view").bind("click", function() {
        var sit_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sit_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        var $img = $("#"+sit_wimg_id[1]).children("img");
        var width = $img.width();
        var height = $img.height();
        if(width > 700) {
            var img_width = 700;
            var img_height = Math.round((img_width * height) / width);

            $img.width(img_width).height(img_height);
        }
    });
    $(".sit_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
        var $button = $("#it_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });
});
<?php } ?>

function codedupcheck(id)
{
    if (!id) {
        alert('상품코드를 입력하십시오.');
        f.it_id.focus();
        return;
    }

    var it_id = id.replace(/[A-Za-z0-9\-_]/g, "");
    if(it_id.length > 0) {
        alert("상품코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.");
        return false;
    }

    $.post(
        "./codedupcheck.php",
        { it_id: id },
        function(data) {
            if(data.name) {
                alert("코드 '"+data.code+"' 는 '".data.name+"' (으)로 이미 등록되어 있으므로\n\n사용하실 수 없습니다.");
                return false;
            } else {
                alert("'"+data.code+"' 은(는) 등록된 코드가 없으므로 사용하실 수 있습니다.");
                document.fitemform.codedup.value = '';
            }
        }, "json"
    );
}

function fitemformcheck(f)
{
    if (!f.ca_id.value) {
        alert("기본분류를 선택하십시오.");
        f.ca_id.focus();
        return false;
    }

    if (f.w.value == "") {
        var error = "";
        $.ajax({
            url: "./ajax.it_id.php",
            type: "POST",
            data: {
                "it_id": f.it_id.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                error = data.error;
            }
        });

        if (error) {
            alert(error);
            return false;
        }
    }

    if(parseInt(f.it_sc_type.value) > 1) {
        if(!f.it_sc_price.value || f.it_sc_price.value == "0") {
            alert("기본배송비를 입력해 주십시오.");
            return false;
        }

        if(f.it_sc_type.value == "2" && (!f.it_sc_minimum.value || f.it_sc_minimum.value == "0")) {
            alert("배송비 상세조건의 주문금액을 입력해 주십시오.");
            return false;
        }

        if(f.it_sc_type.value == "4" && (!f.it_sc_qty.value || f.it_sc_qty.value == "0")) {
            alert("배송비 상세조건의 주문수량을 입력해 주십시오.");
            return false;
        }
    }

    // 관련상품처리
    var item = new Array();
    var re_item = it_id = "";

    $("#reg_relation input[name='re_it_id[]']").each(function() {
        it_id = $(this).val();
        if(it_id == "")
            return true;

        item.push(it_id);
    });

    if(item.length > 0)
        re_item = item.join();

    $("input[name=it_list]").val(re_item);

    <?php echo get_editor_js('it_explan'); ?>

    return true;
}

function categorychange(f)
{
    var idx = f.ca_id.value;

    if (f.w.value == "" && idx)
    {
        f.it_use.checked = ca_use[idx] ? true : false;
        f.it_stock_qty.value = ca_stock_qty[idx];
    }
}

categorychange(document.fitemform);
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
