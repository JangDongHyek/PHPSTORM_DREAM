<?php
$sub_menu = '400300';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");
if(!$sca){
	$sca="10";
}
$g5['title'] = '상품관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

// 분류
$ca_list  = '<option value="">선택</option>'.PHP_EOL;
$sql = " select * from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $len = strlen($row['ca_id']) / 2 - 1;
    $nbsp = '';
    for ($i=0; $i<$len; $i++) {
        $nbsp .= '&nbsp;&nbsp;&nbsp;';
    }
    $ca_list .= '<option value="'.$row['ca_id'].'">'.$nbsp.$row['ca_name'].'</option>'.PHP_EOL;
}

$where = " and ";
$sql_search = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if ($save_stx != $stx)
        $page = 1;
}

if ($sca != "") {
    $sql_search .= " $where (a.ca_id like '$sca%' or a.ca_id2 like '$sca%' or a.ca_id3 like '$sca%') ";
}

if ($sfl == "")  $sfl = "it_name";

$sql_common = " from {$g5['g5_shop_item_table']} a ,
                     {$g5['g5_shop_category_table']} b
               where (a.ca_id = b.ca_id";

$sql_common .= ") ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);				// 전체 페이지 계산
if ($page < 1) { $page = 1; }							// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;						// 시작 열을 구함

$list_no = $total_count - ($rows * ($page - 1));		// 글번호(내림차순)

if (!$sst) {
    $sst  = "it_price";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";


$sql  = " select *
           $sql_common
           $sql_order
           ";
$result = sql_query($sql);

$qstr = $qstr.'&amp;sca='.$sca.'&amp;page='.$page.'&amp;save_stx='.$stx;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
?>

<style>
td.icon_area {text-align: left !important;}
.icon_area label {display:inline-block;margin:0 2px 2px 0;padding:0 8px;border-radius:30px;line-height:20px;font-size:11px;background:#f3f3f3}
.icon_area .icon_soldout{position:absolute;top:10px;left:10px;background:#ff0000;color:#fff;border-radius:0}
.icon_area .icon_hit{color:#32b4be}
.icon_area .icon_rec{color:#32be5a}
.icon_area .icon_sale{color:#b9be32}
.icon_area .icon_new{color:#be329d}
.icon_area .icon_best{color:#ff0000}
#cat .active { font-weight:bold; background:#3f51b5; padding:3px 5px; border-radius:3px}
#cat .active a{ color:#fff !important;}
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall; ?>
    <span class="btn_ov01"><span class="ov_txt">등록된 상품</span><span class="ov_num"> <?php echo $total_count; ?>건</span></span>
</div>

<!-- 검색 -->
<form name="flist" class="local_sch01 local_sch">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="save_stx" value="<?php echo $stx; ?>">

    <label for="sca" class="sound_only">분류선택</label>
    <select name="sca" id="sca">
        <option value="">전체분류</option>
        <?php
        $sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
        $result1 = sql_query($sql1);
        for ($i=0; $row1=sql_fetch_array($result1); $i++) {
            $len = strlen($row1['ca_id']) / 2 - 1;
            $nbsp = '';
            for ($i=0; $i<$len; $i++) $nbsp .= '&nbsp;&nbsp;&nbsp;';
            echo '<option value="'.$row1['ca_id'].'" '.get_selected($sca, $row1['ca_id']).'>'.$nbsp.$row1['ca_name'].'</option>'.PHP_EOL;
        }
        ?>
    </select>

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="it_name" <?php echo get_selected($sfl, 'it_name'); ?>>상품명</option>
        <option value="it_id" <?php echo get_selected($sfl, 'it_id'); ?>>상품코드</option>
    </select>

    <label for="stx" class="sound_only">검색어</label>
    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" class="frm_input">
    <input type="submit" value="검색" class="btn_submit">
</form>
<!-- // 검색 -->


<div class="flex">
    <div class="lnb_menu">
        <h2>상품관리 분류</h2>
        <ul id="cat">
            <?php
            $sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
            $result1 = sql_query($sql1);
            for ($i=0; $row1=sql_fetch_array($result1); $i++) {
                $len = strlen($row1['ca_id']) / 2 - 1;
                $nbsp = '';
                for ($i=0; $i<$len; $i++){ $nbsp .= '&nbsp;&nbsp;&nbsp;';}?>
                <li class="<?php echo $row1[ca_id]==$sca?"active":""?>"><a href="?sca=<?php echo $row1[ca_id]?>"><?php echo $nbsp.$row1['ca_name']?></a></li>
				<?php
            }
            ?>
        </ul>

    </div>
    <div class="item_list">
        <!-- 리스트 -->
        <form name="fitemlistupdate" method="post" action="./itemlistupdate.php" <?/*onsubmit="return fitemlist_submit(this);"*/?> autocomplete="off" id="fitemlistupdate">
            <input type="hidden" name="sca" value="<?php echo $sca; ?>">
            <!--<input type="hidden" name="sst" value="<?php echo $sst; ?>">
            <input type="hidden" name="sod" value="<?php echo $sod; ?>">-->
            <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
            <input type="hidden" name="stx" value="<?php echo $stx; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
			

            <!-- 선택수정,삭제용 변수-->
            <input type="hidden" name="act_button" value="">

            <div class="btn_fixed_top">
                <a href="./itemform.php" class="btn btn_01">상품등록</a>
                <input type="button" value="선택수정" onclick="fitemlist_submit(document.fitemlistupdate, 1)" class="btn btn_03">
                <input type="button" value="선택삭제" onclick="fitemlist_submit(document.fitemlistupdate, 2)" class="btn btn_02">
                <?/*<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_03">
                <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">*/?>
            </div>
            <script type="text/javascript">

                // 선택수정, 선택삭제
        function fitemlist_submit(f, mode)
        {
            if (mode == 1) {
                document.pressed = "선택수정";
            } else {
                document.pressed = "선택삭제";
            }
            if (!is_checked("chk[]")) {
                getNoti(1, document.pressed+" 하실 항목을 하나 이상 선택하세요.");
                return false;
            }

            var msg = "선택하신 상품을 ";
            msg += (document.pressed == "선택삭제")? "삭제하시겠습니까? 삭제된 상품은 복구되지 않습니다." : "수정하시겠습니까?";
            if(confirm(msg)){
                f.act_button.value = document.pressed;
                f.submit();
            }
        }

            </script>

            <div class="tbl_head01 tbl_wrap">
                <table>
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="5%">
                <col width="20%">
                <col width="10%">
                <col width="7%">
                <col width="7%">
                <col width="7%">
                <col width="5%">
				<col width="10%">
                <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th scope="col" rowspan="2">
						
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col" rowspan="2">No.</th>
                    <th scope="col" rowspan="2">이미지</th>
                    <th scope="col" rowspan="2"><?php echo subject_sort_link('it_name', 'sca='.$sca); ?>상품명</a></th>
                    <th scope="col" rowspan="2">대표분류</th>
                    <th scope="col" rowspan="2"><?php echo subject_sort_link('it_stock_qty', 'sca='.$sca); ?>재고</a></th>
                    <th scope="col" rowspan="2"><?php echo subject_sort_link('it_price', 'sca='.$sca); ?>가격</a></th>
                    <th scope="col" rowspan="2"><?php echo subject_sort_link('it_cust_price', 'sca='.$sca); ?>시중가격</a></th>
                    <th scope="col" rowspan="2"><?php echo subject_sort_link('it_use', 'sca='.$sca, 1); ?>판매</a></th>
                    <!--<th scope="col" rowspan="2"><?php echo subject_sort_link('it_soldout', 'sca='.$sca, 1); ?>품절</a></th>-->
                    <th scope="col" rowspan="2"><?php echo subject_sort_link('it_order', 'sca='.$sca, 1); ?>출력순서</a></th>
                    <!-- <th scope="col" rowspan="2"><?php echo subject_sort_link('it_hit', 'sca='.$sca, 1); ?>조회수</a></th> -->
                    <th scope="col" rowspan="2">관리</th>
                </tr>
               <!--  <tr>
                    <th scope="col"><?php echo subject_sort_link('it_id', 'sca='.$sca); ?>상품코드</a></th>
                </tr> -->
                </thead>
                <tbody>
                <?
                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $bg = 'bg'.($i%2);
                    $it_id = $row['it_id'];
                    $href = G5_SHOP_URL.'/item.php?it_id='.$it_id;

                ?>
                <tr class="<?=$bg?>" data-no="<?=$i?>">
                    <td>
						<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?=$i?>">
						<input type="hidden" name="it_id[<?php echo $i?>]" value="<?php echo $row[it_id]?>">
					</td>
                    <td ><?=number_format($list_no)?></td>
                    <!-- 이미지 -->
                    <td><?php echo get_it_image($it_id, 70, 70); ?></td>
                    <!-- 상품명 -->
                    <td><input type="text" name="it_name[<?=$i?>]" value="<?php echo htmlspecialchars2(cut_str($row['it_name'],250, "")); ?>" id="name_<?=$i?>" required class="tbl_input required" size="30"></td>
                    <!-- 분류 -->
                    <td>
                        <select name="ca_id[<?=$i?>]" id="ca_id_<?=$i?>">
                            <?php echo conv_selected_option($ca_list, $row['ca_id']); ?>
                        </select>
                        <input type="hidden" name="ca_id2[<?=$i?>]" value="<?=$row['ca_id2']?>">
                        <input type="hidden" name="ca_id3[<?=$i?>]" value="<?=$row['ca_id3']?>">
                    </td>
                    <!-- 재고 -->
                    <td><input type="text" name="it_stock_qty[<?=$i?>]" value="<?php echo $row['it_stock_qty']; ?>" id="stock_qty_<?=$i?>" class="tbl_input sit_qty" size="7"></td>
                    <!-- 판매가격 -->
                    <td><input type="text" name="it_price[<?=$i?>]" value="<?php echo $row['it_price']; ?>" id="price_<?=$i?>" class="tbl_input sit_amt" size="7"></td>
                    <!-- 시중가격 -->
                    <td ><input type="text" name="it_cust_price[<?=$i?>]" value="<?php echo $row['it_cust_price']; ?>" id="cust_price_<?=$i?>" class="tbl_input sit_camt" size="7"></td>
                    <!-- 판매 -->
                    <td><input type="checkbox" name="it_use[<?=$i?>]" <?php echo ($row['it_use'] ? 'checked' : ''); ?> value="1" id="use_<?=$i?>"></td>
                    <!-- 품절 -->
                    <!--<td><input type="checkbox" name="it_soldout[<?=$i?>]" <?php echo ($row['it_soldout'] ? 'checked' : ''); ?> value="1" id="soldout_<?=$i?>"></td>-->
                   
                   <td><input type="text" name="it_order[<?=$i?>]" value="<?php echo $row['it_order']; ?>" id="it_order<?=$i?>" class="tbl_input sit_camt" size="7"></td>

				    <!-- 조회 -->
<!--                     <td><?=number_format($row['it_hit'])?></td> -->
                    <!-- 관리 -->
                    <td class="td_mng td_mng_s" width="100">
                        <a href="./itemform.php?w=u&amp;it_id=<?=$it_id?>&amp;ca_id=<?php echo $row['ca_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03"></span>수정</a>
                        <a href="javascript:;" onclick="window.open('./itemcopy.php?it_id=<?=$it_id?>&amp;ca_id=<?php echo $row['ca_id']; ?>','copy','width=400,height=300')" class="itemcopy btn btn_02" target="_blank">복사</a>
                        <a href="<?php echo $href; ?>" class="btn btn_02" target="_blank">보기</a>

                    </td>
                </tr>

                <? /*<tr class="<?=$bg?>" data-no="<?=$i?>">
                    <!-- 관리자 버튼설정 -->
                    <td class="icon_area">
                        <?
                        foreach ($shop_icon_lst as $key=>$item) {
                            $btn_id = "tp{$i}_{$key}";
                            $btn_checked = ($row['it_type'.$key])? "checked" : "";
                            $btn_val = ($row['it_type'.$key])? "1" : "";

                            if ($member['mb_level'] == "10")  {
                        ?>
                        <input type="checkbox" name="it_type<?=$key?>[<?=$i?>]" value="1" id="<?=$btn_id?>" <?=$btn_checked?>><!--
                        --><label for="<?=$btn_id?>" class="<?=$shop_icon_cls[$key]?>"><?=$item?></label>
                        <?	} else { ?>
                        <input type="hidden" name="it_type<?=$key?>[<?=$i?>]" value="<?=$btn_val?>"><!--
                        --><label class="<?=$shop_icon_cls[$key]?>" <?if ($btn_val == "") echo "style='display: none;'"; ?>><?=$item?></label>
                        <?
                            }
                        } // end foreach
                        ?>
                    </td>
                    <!-- 상품코드 -->
                    <!-- <td><input type="hidden" name="it_id[<?=$i?>]" value="<?=$it_id?>"><?=$it_id?></td> -->
                </tr>*/?>
                <?
                    $list_no--;
                }

                if ($i == 0) {
                ?>
                <tr><td colspan="15" class="empty_table">등록된 상품이 없습니다.</td></tr>
                <? } ?>
                </tbody>
                </table>
            </div>

        </form>
        <!-- 리스트 -->
    </div>
</div>
<?php //echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function() {
	// select변경시 체크박스선택
	$("#fitemlistupdate select").on("change", function() {
		setChkbox($(this));
	});

	// chkbox변경시 체크박스선택
	$("#fitemlistupdate input[type='checkbox']").on("click", function() {
		setChkbox($(this));
	});

	// text변경시 체크박스 선택
	$("#fitemlistupdate input[type='text']").on("keyup", function() {
		setChkbox($(this));
	});
});

// 체크박스선택
function setChkbox(el) {
	var no = $(el).parents('tr').data("no"),
		chkbox = $("#chk_"+no);

	if ($(el).attr('name') == "chk[]") {
		return;
	}
	if (chkbox.length > 0) {
		chkbox.prop("checked", true);
	}
}


<?/*
// 복사
$(function() {
    $(".itemcopy").click(function() {
        var href = $(this).attr("href");
        window.open(href, "copywin", "left=100, top=100, width=300, height=200, scrollbars=0");
        return false;
    });
});
*/?>
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
