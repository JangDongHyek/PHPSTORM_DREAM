<section id="ver2">
    <div class="tab-content">
        <div id="estimate">
            <estimate-input mb_id="<?=$member['mb_id']?>" INSU_CHECK="<?=$member['INSU_CHECK']?>" primary="<?=$_GET['primary']?>"></estimate-input>
        </div>

    </div>

    <div class="contsBanner" id="visual">

        <div class="swiper mainSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?= ASSETS_URL ?>/img/main/visual01.jpg" />
                    <div class="slg">
                        <h3>에스티메디 OPEN</h3>
                        <p>지금 바로 비교견적 해보세요</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="<?= ASSETS_URL ?>/img/main/visual02.jpg" />
                    <div class="slg">
                        <h3>에스티메디 OPEN</h3>
                        <p>지금 바로 비교견적 해보세요</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mainSwiper", {
                pagination: {
                    el: ".swiper-pagination",
                    type: "fraction",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>
    </div>

</section>


<?php $jl->vueLoad('ver2');?>
<?php $jl->componentLoad('estimate');?>
<?php $jl->componentLoad('item');?>
<?php $jl->componentLoad('modal');?>