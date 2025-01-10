<style>
    #ctt {
        display: none;
    }

</style>

<div id="sub04_02" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <? if(defined('_INDEX_')) {?>
    <? }else if($co_id == "sub02_04"){ ?>

    <div class="vedio_wrap">
       <video id="sub02_04" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub02_04.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                    poster: "../vedio/sub02_04_thumb.jpg",
                    controls: true,
                    preload: "auto",
                    responsive: true,
                    controlBar: {
                        playToggle: true,
                        pictureInPictureToggle: false,
                        remainingTimeDisplay: true,
                        progressControl: true,
                        qualitySelector: true,
                    },
                };
                var player = videojs('sub02_04', options);
                player.src([{
                    src: '../vedio/sub02_04.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>



    <div class="video_sec">
        <div class="inr">
            <div class="video_grid">
                <div class="video-container">
                <iframe src="https://www.youtube.com/embed/kYk9kepmQVo?si=y546Df-EHjk4C1ug&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/XjBNaopmRlA?si=eeS22GcKvetiV39S&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/mnwD43kELAc?si=5K1EySZlO7j-6l2o&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/Qa3SCKP35hs?si=vvonsZ4NhP5SiUfp&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/KVXAXlwYL20?si=iiztCUQC-gv3hEMF&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/puNXEA49gps?si=lgFIVn4dfxTIVATx&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
        </div>
    </div>

    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <? } ?>
</div>
