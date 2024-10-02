<?php
include_once G5_PATH."/jl/JlConfig.php";
$model = new JlModel(array("table" => "g5_new_win"));

$model->between("now()","nw_begin_time","nw_end_time");

$data = $model->get();

?>

<div id="new_pop">
    <div>
        <div class="pop_btn">
            <button type="button" onclick="postSession()">오늘 하루 보지 않기</button>
            <button type="button" onclick="removeDiv('new_pop')">닫기</button>
        </div>
        <div class="pops_con">

            <div thumbsSlider="" class="swiper thumbSwiper">
                <div class="swiper-wrapper">
                    <? foreach($data['data'] as $d) {?>
                    <div class="swiper-slide">
                        <p><?=$d['nw_subject']?></p>
                    </div>
                    <?}?>
                </div>
            </div>
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper popSwiper">
                <div class="swiper-wrapper">
                    <? foreach($data['data'] as $d) {?>
                        <div class="swiper-slide">
                            <?=$d['nw_content']?>
                        </div>
                    </a>
                    <?}?>
                </div>
            </div>

            <!-- Swiper JS -->
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".thumbSwiper", {
                    spaceBetween: 0,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".popSwiper", {
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper,
                    },
                });
            </script>
        </div>

    </div>
</div>
<?php $jl->jsLoad();?>
<script>
    async function postSession() {
        let obj = {};
        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("session",obj,"/api/session.php");
            removeDiv('new_pop')
        }catch (e) {
            alert(e.message)
        }
    }

    function removeDiv(id) {
        var element = document.getElementById(id);
        if (element) {
            element.remove(); // 요소 제거
        }
    }
</script>