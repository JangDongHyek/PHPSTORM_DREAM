<?php

include_once(G5_LIB_PATH . '/thumbnail.lib.php');
add_stylesheet("<link rel=\"stylesheet\" href=\"{$board_skin_url}/style.css\" />", 0);
add_javascript("<script src=\"{$board_skin_url}/script.js\"></script>", 0);

?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$(function(){

	<?php if($board['bo_download_point'] < 0){ ?>
	$('#view-skin a.download').on('click', function(e){
		if(g5_is_member){
			if(window.confirm('<?php echo number_format($board['bo_download_point']); ?> 포인트가 차감됩니다.\n\n정말로 다운받으시겠습니까?') == true){
				$(this).attr('href', $(this).attr('href') + '&js=on');
			}
		} else{
			e.preventDefault();
			window.alert('로그인후에 이용해주세요.');
		}
    });
	<?php } ?>

	$(document).on('mouseup', function(e){
		if(!$('#bo_v_sns').is(e.target) && $('#bo_v_sns').has(e.target).length === 0){
			$('#bo_v_sns').hide();
		}
	});

	$('#view-skin div.content').viewimageresize();

});
</script>

<section id="view-skin">
	<h1>
		<?php if($category_name) echo "<strong>분류{$view['ca_name']}</strong>"; ?>
		<?php echo get_text($view['wr_subject']); ?>
	</h1>
	<h2>
		<i class="fa fa-user"></i>
		<?php echo $view['name']; ?>
		<?php if($is_ip_view) echo "({$ip})"; ?>
		<i class="fa fa-comment"></i>
		<?php echo number_format($view['wr_comment']); ?>
		<i class="fa fa-clock-o"></i>
		<?php echo $view['wr_datetime']; ?>
		<i class="fa fa-eye"></i>
		<?php echo number_format($view['wr_hit']); ?>
	</h2>
	<div class="content">
		<?php
		foreach($view['file'] as $val){
			if($val['view']){
				echo '<p class="thumb">' . get_view_thumbnail($val['view']) . '</p>';
			}
		}
		echo get_view_thumbnail($view['content']);
		include_once(G5_SNS_PATH . '/view.sns.skin.php');
		?>
	</div>
	<?php
	if(array_filter($view['link']) == true){
		for($key = 1; $i <= count($view['link']); $key++){
			if($view['link'][$key]){
	?>
	<h3>
		<i class="fa fa-link"></i>
		<a href="<?php echo $view['link_href'][$key]; ?>" target="_blank"><?php echo $view['link'][$key]; ?></a>
	</h3>
	<?php
			}
		}
	}
	foreach($view['file'] as $val){
		if($val['source'] && !$val['view']){
	?>
	<h3>
		<i class="fa fa-download"></i>
		<a href="<?php echo $val['href']; ?>" class="download"><?php echo $val['source']; ?> (<?php echo $val['size']; ?>)</a>
	</h3>
	<?php
		}
	}
	if($prev_href){
	?>
	<h3>
		<i class="fa fa-caret-up"></i>
		<a href="<?php echo $prev_href; ?>"><?php echo $prev_wr_subject; ?></a>
	</h3>
	<?php
	}
	if($next_href){
	?>
	<h3>
		<i class="fa fa-caret-down"></i>
		<a href="<?php echo $next_href; ?>"><?php echo $next_wr_subject; ?></a>
	</h3>
	<?php } ?>
	<p>
		<?php if($scrap_href) echo "<a href=\"{$scrap_href}\" class=\"scrap\">스크랩</a>"; ?>
		<?php if($nogood_href || $board['bo_use_nogood']){ ?>
		<a href="<?php echo "{$nogood_href}&{$qstr}"; ?>" class="nogood">
			좋아요
			(<span><?php echo number_format($view['wr_nogood']); ?></span>)
		</a>
		<?php } ?>
		<?php if($good_href || $board['bo_use_good']){ ?>
		<a href="<?php echo "{$good_href}&{$qstr}"; ?>" class="good">
			싫어요
			(<span><?php echo number_format($view['wr_good']); ?></span>)
		</a>
		<?php } ?>
	</p>
	<p>
		<?php if($copy_href) echo "<a href=\"{$copy_href}\" class=\"left copy\">복사</a>"; ?>
		<?php if($move_href) echo "<a href=\"{$move_href}\" class=\"left move\">이동</a>"; ?>
		<?php if($delete_href) echo "<a href=\"{$delete_href}\" class=\"left delete\">삭제</a>"; ?>
		<?php if($update_href) echo "<a href=\"{$update_href}\" class=\"left\">수정</a>"; ?>
		<a href="<?php if($search_href) echo $search_href; else echo $list_href; ?>" class="right">목록</a>
		<?php if($reply_href) echo "<a href=\"{$reply_href}\" class=\"right\">답변</a>"; ?>
	</p>
</section>

<?php include_once(G5_BBS_PATH . '/view_comment.php'); ?>