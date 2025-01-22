<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$str = '';
$exists = false;

$ca_id_val = $ca_id;
$ca_id_len = strlen($ca_id);
if($ca_id_len == 4){
	$ca_id_val = substr($ca_id,0,2);
	$ca_id_len = 2;
}
$len2 = $ca_id_len + 2;
$len4 = $ca_id_len + 4;
//3차를 보여주기 위한 쿼리문
if(strlen($ca_id)==4){
	$len=strlen($ca_id)+2;
	$sql="select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_id like '$ca_id%' and length(ca_id) = $len and ca_use = '1' order by ca_order, ca_id";
	$result=sql_query($sql);
	$cnt=sql_num_rows($result);
	if(0<$cnt){
		$len2=$len;
		$ca_id_val=$ca_id;
	}
}
if($len2==8){
	$len2=6;
	$ca_id_val=substr($ca_id,0,4);

}



$sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_id like '$ca_id_val%' and length(ca_id) = $len2 and ca_use = '1' order by ca_order, ca_id ";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) {

    $row2 = sql_fetch(" select count(*) as cnt from {$g5['g5_shop_item_table']} where (ca_id like '{$row['ca_id']}%' or ca_id2 like '{$row['ca_id']}%' or ca_id3 like '{$row['ca_id']}%') and it_use = '1'  ");

   // $str .= '<li><a href="./list.php?ca_id='.$row['ca_id'].'">'.$row['ca_name'].' ('.$row2['cnt'].')</a></li>';
    $str .= '<li><a href="./list.php?ca_id='.$row['ca_id'].'">'.$row['ca_name'].'</a></li>';
    $exists = true;
}

if ($exists) {

    // add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
    add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);

$ca_len = strlen($_GET['ca_id']);
if($ca_len == 4){
	$ca_len = 2;
}
$ca_list_sql = " select * from g5_shop_category where length(ca_id) = '{$ca_len}' ";
$ca_list_qry = sql_query($ca_list_sql);
$ca_list_qry2 = sql_query($ca_list_sql);
$ca_list_num = sql_num_rows($ca_list_qry);
?>

<!-- 상품분류 1 시작 { -->
<!--카테고리-->
<?php /*?><div class="list-category list-category-mobile">
        <div class="tabs div-tab tabs-blue-top hidden-xs">
            <?php if($ca_list_num > 0){ ?>
			<ul class="nav nav-tabs">
				<?php
				for($ii=0; $ii<$ca_list_num; $ii++){
					$ca_list_row = sql_fetch_array($ca_list_qry);
				?>
                <li><a href="<?php echo G5_SHOP_URL ?>/list.php?ca_id=<?php echo $ca_list_row['ca_id'] ?>"><?php echo $ca_list_row['ca_name'] ?></a></li>
				<?php
				}
				?>
            </ul>
			<?php } ?>
        </div>
        <div class="dropdown visible-xs">
            <a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-blue btn-block"><?php echo $g5['title'] ?><span class="caret"></span>
            </a>
				<?php if($ca_list_num > 0){ ?>
                <ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel" style="width:100%;">
					<?php
					for($ii=0; $ii<$ca_list_num; $ii++){
						$ca_list_row2 = sql_fetch_array($ca_list_qry2);
					?>
                    <li><a href="<?php echo G5_SHOP_URL ?>/list.php?ca_id=<?php echo $ca_list_row2['ca_id'] ?>"><?php echo $ca_list_row2['ca_name'] ?></a></li>
					<?php
					}
					?>
                </ul>
				<?php } ?>
        </div>
</div><?php */?>
<!--카테고리-->

<aside id="sct_ct_1" class="sct_ct">
    <h2>현재 상품 분류와 관련된 분류</h2>
    <ul>
        <?php echo $str; ?>
    </ul>
</aside>
<!-- } 상품분류 1 끝 -->

<?php } ?>