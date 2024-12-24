<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$rand = mt_rand(0, (count($list) - 1));
$thumb = get_list_thumbnail($bo_table, $list[$rand]['wr_id'], $width, $height); 
?>
<?php if($thumb){ ?>
<a href="<?php echo $list[$rand]['wr_link1'];?>"><img src="<?php echo $thumb['src']; ?>" style="width:100%;"></a>
<?php } ?>
