

<input type="hidden" id="typereg" name="type" value="<?=$type?>">
<input type="hidden" id="service" name="service" value="<?=$service?>">
<div class="area_filter">
    <div class="flex ai-c jc-sb">
        <div class="area">
            <dl class="dropdown">
                <dt id="selected"><?=REGION[$type]?></dt>
                <dd class="dropdown_list">
                    <a href="<?=base_url().'company?type=bus&service='.$service.'&reg=all'?>">부산</a>
                    <a href="<?=base_url().'company?type=uls&service='.$service.'&reg=all'?>">울산</a>
                    <a href="<?=base_url().'company?type=gye&service='.$service.'&reg=all'?>">경남</a>
                </dd>
            </dl>

        </div>
        <div class="search_wrap">
            <form name="searchFrm" autocomplete="off">
                <input type="hidden" name="type" value="<?=$get['type']?>">
                <input type="hidden" name="service" value="<?=$get['service']?>">
                <input type="hidden" name="reg" value="<?=$get['reg']?>">
                <div class="search">
                    <input type="search" name="stx" value="<?=$get['stx']?>" placeholder="검색어를 입력하세요">
                    <button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="box_gray">
        <ul class="text_radio">
            <!--li>
                <input type="radio" id="<?=$type?>_all" name="area[]" <?=($get['reg'] == 'all') ? 'checked' : ''; ?> value="all" />
                <label for="<?=$type?>_all"><?=REGION[$type]?> 전체</label>
            </li-->
            <?php if (isset($sigu)):
                foreach ($sigu as $key => $value):
                    ?>
                    <li>
                        <input type="radio" id="<?=$reg?>_<?=$key?>" name="area[]" <?=($get['reg'] == $value) ? 'checked' : ''; ?>  value="<?=$value?>" />
                        <label for="<?=$reg?>_<?=$key?>"><?=$value?></label>
                    </li>
                <?php endforeach;
            endif; ?>

        </ul>
    </div>
</div>

<br>
<section>
    <h3 class="flex ai-c">
        <i class="fa-solid fa-crown"></i> 프리미엄 업체
        <span class="txt_gray txt14">부산이사몰에서 선정한 프리미엄 업체</span>
    </h3>
    <div class="company_list ad_list">
        <ul class="grid">
            <?php if(empty($premium)):?>
                <li>
                    등록되어 있는 업체가 없습니다
                </li>
            <?php else:
            foreach ($premium as $list):
            ?>
                <li>
                    <a href="<?=base_url()?>companyView?idx=<?=$list['idx']?>">
                        <div class="area_img img">
                            <?/*
                            <?php if($list['shorts_video']):?>
                                <video class="hover-video" width="100%" height="auto" controls playsinline webkit-playsinline>
                                    <source src="<?= base_url() ?>uploads/company/<?=$list['shorts_video']?>#t=1" type="video/mp4">
                                </video>
                            <?else:?>
                            <?php endif;?>
                            */?>
                                <img src="<?= base_url() ?>uploads/company/<?= $list['main_img'] ?>" alt="noimage" onerror="this.src='<?=base_url()?>img/noimage.jpg'">
                        </div>
                        <div class="area_text">
                            <div class="flex ai-c jc-sb">
                                <div class="title"><!--업체명--><?=$list['company_name']?><!--(<?=$list['area_gu']?>점)--></div>
                                <div class="info">
                                    <span>조회수  <?=$list['read_cnt']?></span>

                                </div>
                            </div>
                            <div class="exp"><!--상세설명-->
                                <?=$list['cp_desc']?>
                            </div>
                        </div>

                    </a>
                </li>
            <?php endforeach;
            endif;
            ?>
        </ul>
    </div>
</section>
<hr>
<section>
    <h3>지역 업체</h3>
    <div class="company_list">
        <ul class="grid">
            <?php if (empty($listData)):?>
            <li>
                내역이 없습니다.
            </li>
            <?php else:
            foreach ($listData as $list):
            ?>
            <li id="detailPage" data-idx="<?=$list['idx']?>">
                <div class="area_img img">
                    <img src="<?= base_url() ?>uploads/company/<?= $list['main_img'] ?>" alt="noimage" onerror="this.src='<?=base_url()?>img/noimage.jpg'">
                    <?/*<?php if($list['shorts_video']):?>
                        <video class="hover-video" width="100%" height="auto" controls playsinline webkit-playsinline>
                            <source src="<?= base_url() ?>uploads/company/<?=$list['shorts_video']?>#t=1" type="video/mp4">
                        </video>
                    <?else:?>
                    <img src="<?= base_url() ?>uploads/company/<?= $list['main_img'] ?>" alt="noimage" onerror="this.src='<?=base_url()?>img/noimage.jpg'">
                    <?php endif;?>*/?>
                </div>
                <div class="area_text">
                    <div class="flex ai-c jc-sb">
                        <div class="title"><!--업체명--><?=$list['company_name']?><!--(<?=$list['area_gu']?>점)--></div>
                        <div class="info">
                            <span>조회수 <?=$list['read_cnt']?></span>
                        </div>
                    </div>
                    <div class="exp">
                        <?=$list['cp_desc']?>
                    </div>
                </div>
            </li>
            <?php endforeach;
            endif;?>


        </ul>
        <!--<div class="more">
            <a class="btn_circle">
                <i class="fa-regular fa-arrow-down"></i>
            </a>
        </div>-->
        <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
    </div>
</section>

<script src="<?= base_url()?>js/app/company.js?<?=JS_VER?>"></script>

<script>
    // 모든 비디오 요소 선택 및 이벤트 추가
    /*document.querySelectorAll('.hover-video').forEach(video => {
        // 비디오 클릭 시 모바일에서만 비디오 제어
        const handleVideoClick = (e) => {
            if (isMobile()) {
                e.preventDefault(); // 링크 이동 방지

                if (video.paused) {
                    video.play(); // 비디오가 멈춰있으면 재생
                } else {
                    video.pause(); // 비디오가 재생 중이면 멈춤
                }
            } else {
                // PC에서는 링크로 이동
                window.location.href = '<?= base_url() ?>companyView';
            }
        };

        // 비디오 클릭 및 터치 시작 시 비디오 제어
        video.addEventListener('click', handleVideoClick);
        video.addEventListener('touchstart', handleVideoClick);

        // 마우스 오버 시 동영상 재생 (PC에서만)
        video.addEventListener('mouseenter', () => {
            if (!isMobile()) {
                video.play();
            }
        });

        // 마우스가 동영상을 벗어날 때 일시정지 (PC에서만)
        video.addEventListener('mouseleave', () => {
            if (!isMobile()) {
                video.pause();
            }
        });
    });*/

    // 모바일 디바이스 여부 확인 함수
    function isMobile() {
        return /Mobi|Android/i.test(navigator.userAgent); // 모바일 장치 확인
    }
</script></script>