<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt">
    <div class="lt_wrap">
        <strong class="lt_title"><?php echo $bo_subject; ?></strong>
        <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"> VIEW MORE <i class="fas fa-plus"></i></a></div>
    </div>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\">";

            echo "<div class='lt_tit'>";
            echo $list[$i]['subject']; // Output the subject first

            if (isset($list[$i]['icon_new'])) {
                echo "<span class='lt_new'>" . $list[$i]['icon_new']."</span>"; // Output lt_new if it exists
            }

            echo "</div>"; // Close lt_tit div

            echo "<div class='lt_cont'>".cut_str($list[$i]['wr_content'], 100, "..")."</div>";

            echo "<div class='lt_date'>".$list[$i]['datetime']."</div>";

            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
            //if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
            //if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
            //if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
            //if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
             ?>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>
    </ul>

</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->