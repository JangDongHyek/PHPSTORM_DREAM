<?
include_once('./_common.php');
include_once('./_head.php');

?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<div id="area_intro" class="movie">
    <div class="inr">
        <h2>Introduction Video</h2>
        <div class="area_video">
            <iframe style="width: 100%" height="560px" src="https://www.youtube.com/embed/AD7p86IqPt4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <!--<video controls autoplay>
                <source src="<?/*=G5_THEME_IMG_URL*/?>/app/movie.mp4"
                        type="video/mp4">
                    Sorry, your browser doesn't support embedded videos.
            </video>-->
        </div>
    </div>
</div>

<?
include_once('./_tail.php');
?>
