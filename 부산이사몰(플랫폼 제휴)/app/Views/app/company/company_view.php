<section class="view_top">
    <div class="area_img">
        <!--<img src="<?/*=base_url()*/?>img/noimage.jpg" alt="noimage">-->
        <img src="<?=base_url()?>uploads/company/<?=$infoData['main_img']?>" alt="noimage"  onerror="this.src='<?=base_url()?>img/noimage.jpg'">
    </div>
    <div class="area_info">
        <p class="txt_color"><?=$infoData['area_si']?> > <?=$infoData['area_gu']?></p>
        <div class="flex ai-c">
            <h5><?=$infoData['company_name']?><!--(<?=$infoData['area_gu']?>점)--></h5>
            <i class="fa-solid fa-crown"></i>
            <!--<i class="fa-solid fa-heart" id="heartIcon"></i>-->
        </div>
        <div>
            <span>조회수 <?=$infoData['read_cnt']?></span>
            <!---->
        </div>
        <dl>
            <!--<dt>주소</dt>
            <dd>[<?/*=$infoData['zip_code']*/?>] <?/*=$infoData['addr']*/?></dd>-->
            <dt>연락처</dt>
            <dd><?=$infoData['cp_tel']?> <a href="tel:<?=$infoData['cp_tel']?>" class="btn btn_yellow btn_mini"><i class="fa-solid fa-phone"></i></a> <a href="tel:<?=$infoData['cp_tel']?>" class="btn btn_yellow btn_fixed"><i class="fa-solid fa-phone"></i> 이 업체로 전화연결</a></dd>
            <dt>관허</dt>
            <dd><?=$infoData['grant']?></dd>
            <dt>서비스</dt>
            <dd>
                <?php $serviceTypes = explode(',', $infoData['service_type']); ?>
                <?=in_array('P', $serviceTypes) ? '<span class="icon icon_line">포장이사</span>' : ''?>
                <?=in_array('H', $serviceTypes) ? '<span class="icon icon_line">반포장이사</span>' : ''?>
                <?=in_array('C', $serviceTypes) ? '<span class="icon icon_line">일반이사</span>' : ''?>
                <?=in_array('O', $serviceTypes) ? '<span class="icon icon_line">원룸이사</span>' : ''?>
                <?=in_array('L', $serviceTypes) ? '<span class="icon icon_line">사다리차</span>' : ''?>
            </dd>
        </dl>
        <div class="exp">
            <?=$infoData['cp_desc']?>
            <!--고객 맞춤형 전문이사업체 현대이사몰입니다.<br>
            항상 고객의 입장에 서서 서비스를 제공할 것을 약속드립니다.<br>
            믿음과 신뢰를 바탕으로 최고의 서비스로 보답하겠습니다.-->
        </div>
        <div class="btn_wrap flex">
            <a class="btn btn_large btn_color" <?=$infoData['hompage_link'] ? 'href="' . $infoData['hompage_link'] . '"' : 'onclick="utils.showToast(\'준비중\')"'?> target="_blank" ><i class="fa-solid fa-house"></i> 홈페이지</a>
            <a class="btn btn_sns btn_green" <?=$infoData['blog_link'] ? 'href="'.$infoData['blog_link'].'"' : 'onclick="utils.showToast(\'준비중\')"'?>  target="_blank"><img src="<?=base_url()?>img/common/naver_blog.svg" /></a>
            <a class="btn btn_sns instar" <?=$infoData['instar_link'] ? 'href="'.$infoData['instar_link'].'"' : 'onclick="utils.showToast(\'준비중\')"'?> target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a class="btn btn_sns btn_red" <?=$infoData['youtube_link'] ? 'href="'.$infoData['youtube_link'].'"': 'onclick="utils.showToast(\'준비중\')"'?> target="_blank"><i class="fa-brands fa-youtube"></i></a>
            <?/*a class="btn btn_sns btn_black" <?=$infoData['tiktok_link'] ? 'href="'.$infoData['tiktok_link'].'"' : 'onclick="utils.showToast(\'준비중\')"'?>  target="_blank"><i class="fa-brands fa-tiktok"></i></a*/?>
            <a class="btn btn_sns btn_black hidden-xs"  data-toggle="modal" data-target="#sharePc"><i class="fa-regular fa-share-nodes"></i></a>
            <a class="btn btn_sns btn_black visible-xs" onclick="utils.showToast('준비중')"><i class="fa-regular fa-share-nodes"></i></a>

        </div>
    </div>
</section>
<!-- 메인 간편 견적 신청  -->
<div class="modal fade" id="sharePc" tabindex="-1" aria-labelledby="sharePcLabel" aria-hidden="true">
    <div class="modal-dialog modal-narrow">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="sharePcLabel">공유하기</h5>
            </div>
            <div class="modal-body">
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <div id="kakao-link-btn" style="display: inline-block">
                        <img src="https://developers.kakao.com/assets/img/about/logos/kakaotalksharing/kakaotalk_sharing_btn_medium.png" alt="카카오톡 공유" style="width:32px;height:32px; cursor: pointer;">
                    </div>
                    <a class="a2a_button_copy_link"></a>
                </div>

                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <script>
                    var a2a_config = a2a_config || {};
                    a2a_config.linkname = "공유할 제목";
                    a2a_config.linkurl = "https://yourwebsite.com"; // 공유할 링크
                </script>
                <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
                <script>
                    Kakao.init('YOUR_APP_KEY'); // 카카오 개발자 센터에서 발급받은 JavaScript 앱 키
                </script>

                <script>
                    // 카카오 공유 버튼 클릭 이벤트 등록
                    document.getElementById('kakao-link-btn').addEventListener('click', function() {
                        Kakao.Link.sendDefault({
                            objectType: 'feed',
                            content: {
                                title: '공유할 제목',
                                description: '공유할 설명',
                                imageUrl: 'https://yourwebsite.com/image.jpg', // 이미지 URL
                                link: {
                                    mobileWebUrl: 'https://yourwebsite.com', // 모바일용 링크
                                    webUrl: 'https://yourwebsite.com'       // 웹 브라우저용 링크
                                }
                            },
                            buttons: [
                                {
                                    title: '자세히 보기',
                                    link: {
                                        mobileWebUrl: 'https://yourwebsite.com',
                                        webUrl: 'https://yourwebsite.com'
                                    }
                                }
                            ]
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<section>
    <h5>서비스 설명</h5>
    <hr>
    <!--동영상-->
    <?php if($infoData['shorts_video']):?>
        <div class="player">
            <video id="myVideo"      src="<?= base_url() ?>uploads/company/<?=$infoData['shorts_video']?>" width="100%" height="100%" controls loop playsinline></video>
        </div>
    <?php endif;?>
    <!--<div class="player">
        <video src="<?/*= base_url() */?>img/shorts_sample.mp4" width="100%" height="100%" controls muted loop></video>
    </div>-->
    <!--//동영상-->

    <div class="service_details">
        <div class="details">
            <?=$infoData['service_desc']?>
            <!--<img src="<?/*=base_url()*/?>img/noimage.jpg" alt="noimage">
            <img src="<?/*=base_url()*/?>img/noimage.jpg" alt="noimage">
            <img src="<?/*=base_url()*/?>img/noimage.jpg" alt="noimage">
            <img src="<?/*=base_url()*/?>img/noimage.jpg" alt="noimage">
            <img src="<?/*=base_url()*/?>img/noimage.jpg" alt="noimage">-->
        </div>
        <button type="button" class="btn btn_large btn_line" name="btnToggle">서비스 자세히 보기 <i class="fa-light fa-angle-down"></i></button>
    </div>
</section>
<?php
/*<section>
    <h3 class="flex ai-c">이 지역 추천 업체</h3>
    <div class="company_list">
        <ul class="grid grid4">
            <li onclick="location.href='./companyView'">
                <div class="area_img img">
                    <img src="<?=base_url()?>img/noimage.jpg" alt="noimage">
                </div>
                <div class="area_text">
                    <div class="flex ai-c jc-sb">
                        <div class="title"><!--업체명-->현대이사</div>
                        <div class="info">
                            <span>조회수 4.9</span>

                        </div>
                    </div>
                    <div class="exp"><!--상세설명-->
                        고품격 포장 이사 친절하게 관리하는 전문이사
                    </div>
                </div>
            </li>
            <li>
                <div class="area_img img">
                    <img src="<?=base_url()?>img/noimage.jpg" alt="noimage">
                </div>
                <div class="area_text">
                    <div class="flex ai-c jc-sb">
                        <div class="title"><!--업체명-->현대이사</div>
                        <div class="info">
                            <span>조회수 4.9</span>

                        </div>
                    </div>
                    <div class="exp"><!--상세설명-->
                        고품격 포장 이사 친절하게 관리하는 전문이사
                    </div>
                </div>
            </li>
            <li>
                <div class="area_img img">
                    <img src="<?=base_url()?>img/noimage.jpg" alt="noimage">
                </div>
                <div class="area_text">
                    <div class="flex ai-c jc-sb">
                        <div class="title"><!--업체명-->현대이사</div>
                        <div class="info">
                            <span>조회수 4.9</span>

                        </div>
                    </div>
                    <div class="exp"><!--상세설명-->
                        고품격 포장 이사 친절하게 관리하는 전문이사
                    </div>
                </div>
            </li>
            <li>
                <div class="area_img img">
                    <img src="<?=base_url()?>img/noimage.jpg" alt="noimage">
                </div>
                <div class="area_text">
                    <div class="flex ai-c jc-sb">
                        <div class="title"><!--업체명-->현대이사</div>
                        <div class="info">
                            <span>조회수 4.9</span>

                        </div>
                    </div>
                    <div class="exp"><!--상세설명-->
                        고품격 포장 이사 친절하게 관리하는 전문이사
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>*/
?>


<script>
    const video = document.getElementById("myVideo");

    // 모바일 기기인지 확인하는 함수
    function isMobile() {
        return /Mobi|Android/i.test(navigator.userAgent);
    }

    // 비디오가 재생될 때 전체 화면으로 전환 (모바일에서만)
    video.addEventListener('play', () => {
        if (isMobile()) {
            if (video.requestFullscreen) {
                video.requestFullscreen();
            } else if (video.webkitRequestFullscreen) { // Safari
                video.webkitRequestFullscreen();
            } else if (video.msRequestFullscreen) { // IE/Edge
                video.msRequestFullscreen();
            }
        }
    });

    // 전체 화면에서 비디오가 종료될 때 전체 화면 모드 해제
    video.addEventListener('ended', () => {
        if (document.fullscreenElement) {
            document.exitFullscreen();
        }
    });

    const playPauseButton = document.getElementById("playPauseButton");

    function playPause() {
        if (video.paused) {
            video.play();
            playPauseButton.innerHTML = "<i class='fa-solid fa-pause'></i>";  // 재생 중일 때 일시정지 아이콘으로 변경
        } else {
            video.pause();
            playPauseButton.innerHTML = "<i class='fa-solid fa-play'></i>";  // 일시정지 상태일 때 재생 아이콘으로 변경
        }
    }
</script>