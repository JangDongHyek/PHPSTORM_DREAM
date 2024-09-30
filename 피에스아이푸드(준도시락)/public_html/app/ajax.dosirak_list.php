<?php
include_once("./__init.php");
/**
 * 메뉴안내 및 주문 - 도시락 메뉴 리스트 (ajax)
 */

$sql_search = " where 1=1 ";
$category = 1;
if($menu == "menu_deli") { // 정기배달도시락
    $sql_search .= " and do_category = '정기배달' ";
    $category = 1;
} elseif($menu == "menu_event") {
    $sql_search .= " and do_category = '행사용' ";
    $category = 2;
} elseif($menu == "menu_warm") {
    $sql_search .= " and do_category = '발열' ";
    $category = 3;
} elseif($menu == "menu_salad") {
    $sql_search .= " and do_category = '샐러드팩' ";
    $category = 4;
}

$sql = "select * from g5_dosirak {$sql_search} order by idx ";
//echo $sql;
$rlt = sql_query($sql);
while($do = sql_fetch_array($rlt)) {
    $file = sql_fetch("select * from g5_dosirak_img where dosirak_idx = '{$do['idx']}' order by idx limit 1;");
    ?>
    <li onclick="dosirakModal('<?=$do['idx']?>');">
        <div class="img"><img src="<?php echo G5_DATA_URL ?>/file/dosirak/<?=$file['img_file']?>" /></div>
        <p><?=$do['do_name']?><strong><?=number_format($do['do_price'])?>원 <b>(VAT별도)</b></strong></p>
    </li>
<?php
}
if(empty(sql_num_rows($rlt))) {
    ?>
    <li class="nodata" style="width: 100% !important;">메뉴가 없습니다.</li>
    <?php
}
?>
