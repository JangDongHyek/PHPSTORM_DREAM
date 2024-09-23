<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt">
	<div class="tit">
		<p class="point01">Notice</p>
		<h1 class="lt_title"><?php echo $bo_subject; ?></h1>
		<p class="con">
			신선함과 최저가격을 보장하는 <br class="hidden-xs">
			일진꼼장어의 소식을 알아보세요
		</p>

		<a class="btn_view" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>">바로가기</a>
	</div>
	<ul class="list">
		<?php for ($i=0; $i<count($list); $i++) {  ?>
		<li class="animate__animated animate__fadeInUp animate__delay-1s">
			<?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\">";
            
			if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo "<strong>".$list[$i]['subject']."</strong>";;

            if ($list[$i]['datetime'])
                echo "<span class='time'>".$list[$i]['datetime']."</span>";

			
            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            //if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
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
	<!--
    <div class="lt_more"><a class="area_btn" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>MORE VIEW<i></i></a></div>
	-->
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
