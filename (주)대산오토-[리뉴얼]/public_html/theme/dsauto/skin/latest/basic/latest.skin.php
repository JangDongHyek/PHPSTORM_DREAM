<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt">
    <!--<strong class="lt_title"><?php echo $bo_subject; ?></strong>-->
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\">";
            
			if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo "<strong>".$list[$i]['subject']."</strong>";;

            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];

			
            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            //if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
            //if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
            //if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
            //if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
            //if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
           
			$content = cut_str(preg_replace("@<.*?>@","", $list[$i]['wr_content']),80); // 내용 자르기
            echo "<p class=\"news_text\">".$content;
            echo "</p>"
            ?>
            <span class="lt_date"><?php echo $list[$i]['datetime'] ?></span>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <!--<div class="lt_more"><a class="area_btn" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>MORE VIEW<i></i></a></div>-->
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->