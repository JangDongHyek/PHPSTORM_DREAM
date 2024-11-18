<?
if (!defined('_GNUBOARD_')) exit;
// 최신글 추출
function latest_tabs($skin_dir="", $bo_table, $rows=10, $subject_len=40, $options="")
{
    global $g5;

    if ($skin_dir)
        $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
    else
        $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.basic;

    $list = array();

    $sql = " select * from $g5[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql);

    $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    $category = explode("|", $board['bo_category_list']);
    $cate_count = count($category);

    for($x = 0; $x < $cate_count; $x ++){
        $sql = " select * from $tmp_write_table where wr_is_comment = 0 and ca_name ='{$category[$x]}' order by wr_num limit 0, $rows ";
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++) {
            $list[$category[$x]][$i] = get_list($row, $board, $latest_skin_path, $subject_len);
        }
    }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>