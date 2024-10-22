<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>


<ul class="list_wrap flex_wrap">
	<?php for ($i=0; $i<count($list); $i++) {  ?>
	<li>
		<?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\">";
            
			if ($list[$i]['is_notice'])
                echo "<i class=\"fa-thin fa-angle-right\"></i><strong>".$list[$i]['subject']."</strong>";
            else
                echo "<i class=\"fa-thin fa-angle-right\"></i><strong>".$list[$i]['subject']."</strong>";;

            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];

			
            echo "</a>";

            ?>
		<span class="lt_date"><?php echo $list[$i]['datetime'] ?></span>
	</li>
	<?php }  ?>
	<?php if (count($list) == 0) { //게시물이 없을 때  ?>
	<li>게시물이 없습니다.</li>
	<?php }  ?>
</ul>
