<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="lt">
	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="lt_title"><h3>공지사항</h3></a>
	<ul>
	<?php for ($i=0; $i<count($list); $i++) { ?>
		<li>
			<?php
			//echo $list[$i]['icon_reply']." ";
			echo "<a href=\"".$list[$i]['href']."\">";
			if ($list[$i]['is_notice'])
				echo "<strong>".$list[$i]['subject']."</strong>";
			else
				echo "<strong>".$list[$i]['subject']."</strong>";

			 ?>


			<span class="lt_date"><?php echo $list[$i]['datetime'] ?></span>
			<?php
				echo "</a>";
			?>
		</li>
	<?php } ?>
	<?php if (count($list) == 0) { //게시물이 없을 때 ?>
	<li>게시물이 없습니다.</li>
	<?php } ?>
	</ul>
</div>
