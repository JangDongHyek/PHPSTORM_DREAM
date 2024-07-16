<?
include_once('./_common.php');
include_once('./_head.php');

?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">


	<div id="area_intro" class="movie">
		<div class="inr">
			<h2>소개영상</h2>
			<div class="area_video">
				<video controls>
				<source src="<?=G5_THEME_IMG_URL?>/app/movie.mp4"
						type="video/mp4">
					Sorry, your browser doesn't support embedded videos.
				</video>	
			</div>
		</div>
	</div>

<?
include_once('./_tail.php');
?>