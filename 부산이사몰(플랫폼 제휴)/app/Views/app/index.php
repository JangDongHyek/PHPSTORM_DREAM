<div class="main_slider">
    <!-- Swiper -->
    <div class="swiper mainSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?=base_url()?>img/main_slider04.jpg" class="pc" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
                <img src="<?=base_url()?>img/main_slider04_m.jpg" class="mobile" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
            </div>
            <div class="swiper-slide">
                <img src="<?=base_url()?>img/main_slider03.jpg" class="pc" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
                <img src="<?=base_url()?>img/main_slider03_m.jpg" class="mobile" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
            </div>
            <div class="swiper-slide">
                <img src="<?=base_url()?>img/main_slider01.jpg" class="pc" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
                <img src="<?=base_url()?>img/main_slider01_m.jpg" class="mobile" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
            </div>
            <div class="swiper-slide">
                <img src="<?=base_url()?>img/main_slider02.jpg" class="pc" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
                <img src="<?=base_url()?>img/main_slider02_m.jpg" class="mobile" alt="부산이사몰" onclick="location.href='<?=base_url()?>adGuide'">
            </div>
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>
<div class="inner">
        <section class="main_estimate">
            <button type="button" class="btn btn_yellow" onclick="location.href='./estimateForm'">이사 견적 신청</button>
        </section>

    <?/*
    <section class="main_estimate">
        <form>
            <div class="flex ai-c jc-c">
                <p>
                    <select name="movingType">
                        <?php foreach (SERVICE_TYPE as $key => $value):?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php endforeach;?>
                    </select>
                </p>
                <p>
                    <label for="schedDate">이사일</label>
                    <input type="date" name="schedDate" id="schedDate" placeholder="이사일을 선택하세요">
                </p>
                <p>
                    <label for="origin">출발지</label>
                    <input type="text" name="origin" id="origin" placeholder="시, 군, 구 동까지 입력바랍니다.">
                </p>
                <p>
                    <label for="">도착지</label>
                    <input type="text" id="bourne" name="bourne" placeholder="시, 군, 구 동까지 입력바랍니다.">
                </p>

                <button type="button" class="btn btn_yellow" id="estimateButton">이사 견적 신청</button>
            </div>
        </form>
    </section>
    <section class="main_area">

        <ul class="nav nav-tabs" role="tablist">
            <li <?=$service==='P' ? 'class="active"': ''?>><a href="#area01" role="tab" data-toggle="tab" data-service="P">포장이사</a></li>
            <li <?=$service==='H' ? 'class="active"': ''?>><a href="#area02" role="tab" data-toggle="tab" data-service="H">반포장이사</a></li>
            <li <?=$service==='C' ? 'class="active"': ''?>><a href="#area03" role="tab" data-toggle="tab" data-service="C">일반이사</a></li>
            <li <?=$service==='O' ? 'class="active"': ''?>><a href="#area04" role="tab" data-toggle="tab" data-service="O">원룸이사</a></li>
            <li <?=$service==='L' ? 'class="active"': ''?>><a href="#area05" role="tab" data-toggle="tab" data-service="L">사다리차</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="area01">

                <input type="hidden" id="typereg" name="type" value="<?=$type?>">
                <input type="hidden" id="service" name="service" value="P">
                <div class="area_filter">
                    <div class="area">
                        <dl class="dropdown">
                            <dt id="selected"><?=REGION[$type]?></dt>
                            <dd class="dropdown_list">
                                <a href="<?=base_url().'?type=bus&service='.$service.'&reg=all'?>">부산</a>
                                <a href="<?=base_url().'?type=uls&service='.$service.'&reg=all'?>">울산</a>
                                <a href="<?=base_url().'?type=gye&service='.$service.'&reg=all'?>">경남</a>
                            </dd>
                        </dl>

                    </div>
                    <div class="box_gray">
                        <ul class="text_radio">
                            <li>
                                <input type="radio" id="<?=$type?>_all" name="area[]" <?=($get['reg'] == '') ? 'checked' : ''; ?> value="" />
                                <label for="<?=$type?>_all"><?=REGION[$type]?> 전체</label>
                            </li>
                            <?php if (isset($sigu)):
                                foreach ($sigu as $key => $value):
                                    ?>
                                    <li>
                                        <input type="radio" id="<?=$type?>_<?=$key?>" name="area[]" <?=($get['reg'] == $value) ? 'checked' : ''; ?>  value="<?=$value?>" />
                                        <label for="<?=$type?>_<?=$key?>"><?=$value?></label>
                                    </li>
                                <?php endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="area02">

                <input type="hidden" id="typereg" name="type" value="<?=$type?>">
                <input type="hidden" id="service" name="service" value="H">
                <div class="area_filter">
                    <div class="area">
                        <dl class="dropdown">
                            <dt id="selected"><?=REGION[$type]?></dt>
                            <dd class="dropdown_list">
                                <a href="<?=base_url().'?type=bus&service='.$service.'&reg=all'?>">부산</a>
                                <a href="<?=base_url().'?type=uls&service='.$service.'&reg=all'?>">울산</a>
                                <a href="<?=base_url().'?type=gye&service='.$service.'&reg=all'?>">경남</a>
                            </dd>
                        </dl>

                    </div>
                    <div class="box_gray">
                        <ul class="text_radio">
                            <li>
                                <input type="radio" id="<?=$type?>_all" name="area[]" <?=($get['reg'] == '') ? 'checked' : ''; ?> value="" />
                                <label for="<?=$type?>_all"><?=REGION[$type]?> 전체</label>
                            </li>
                            <?php if (isset($sigu)):
                                foreach ($sigu as $key => $value):
                                    ?>
                                    <li>
                                        <input type="radio" id="<?=$type?>_<?=$key?>" name="area[]" <?=($get['reg'] == $value) ? 'checked' : ''; ?>  value="<?=$value?>" />
                                        <label for="<?=$type?>_<?=$key?>"><?=$value?></label>
                                    </li>
                                <?php endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="area03">

                <input type="hidden" id="typereg" name="type" value="<?=$type?>">
                <input type="hidden" id="service" name="service" value="C">
                <div class="area_filter">
                    <div class="area">
                        <dl class="dropdown">
                            <dt id="selected"><?=REGION[$type]?></dt>
                            <dd class="dropdown_list">
                                <a href="<?=base_url().'?type=bus&service='.$service.'&reg=all'?>">부산</a>
                                <a href="<?=base_url().'?type=uls&service='.$service.'&reg=all'?>">울산</a>
                                <a href="<?=base_url().'?type=gye&service='.$service.'&reg=all'?>">경남</a>
                            </dd>
                        </dl>

                    </div>
                    <div class="box_gray">
                        <ul class="text_radio">
                            <li>
                                <input type="radio" id="<?=$type?>_all" name="area[]" <?=($get['reg'] == '') ? 'checked' : ''; ?> value="" />
                                <label for="<?=$type?>_all"><?=REGION[$type]?> 전체</label>
                            </li>
                            <?php if (isset($sigu)):
                                foreach ($sigu as $key => $value):
                                    ?>
                                    <li>
                                        <input type="radio" id="<?=$reg?>_<?=$key?>" name="area[]" <?=($get['reg'] == $value) ? 'checked' : ''; ?>  value="<?=$value?>" />
                                        <label for="<?=$type?>_<?=$key?>"><?=$value?></label>
                                    </li>
                                <?php endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="area04">

                <input type="hidden" id="typereg" name="type" value="<?=$type?>">
                <input type="hidden" id="service" name="service" value="O">
                <div class="area_filter">
                    <div class="area">
                        <dl class="dropdown">
                            <dt id="selected"><?=REGION[$type]?></dt>
                            <dd class="dropdown_list">
                                <a href="<?=base_url().'?type=bus&service='.$service.'&reg=all'?>">부산</a>
                                <a href="<?=base_url().'?type=uls&service='.$service.'&reg=all'?>">울산</a>
                                <a href="<?=base_url().'?type=gye&service='.$service.'&reg=all'?>">경남</a>
                            </dd>
                        </dl>

                    </div>
                    <div class="box_gray">
                        <ul class="text_radio">
                            <li>
                                <input type="radio" id="<?=$type?>_all" name="area[]" <?=($get['reg'] == '') ? 'checked' : ''; ?> value="" />
                                <label for="<?=$type?>_all"><?=REGION[$type]?> 전체</label>
                            </li>
                            <?php if (isset($sigu)):
                                foreach ($sigu as $key => $value):
                                    ?>
                                    <li>
                                        <input type="radio" id="<?=$type?>_<?=$key?>" name="area[]" <?=($get['reg'] == $value) ? 'checked' : ''; ?>  value="<?=$value?>" />
                                        <label for="<?=$type?>_<?=$key?>"><?=$value?></label>
                                    </li>
                                <?php endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="area05">

                <input type="hidden" id="typereg" name="type" value="<?=$type?>">
                <input type="hidden" id="service" name="service" value="L">
                <div class="area_filter">
                    <div class="area">
                        <dl class="dropdown">
                            <dt id="selected"><?=REGION[$type]?></dt>
                            <dd class="dropdown_list">
                                <a href="<?=base_url().'?type=bus&service='.$service.'&reg=all'?>">부산</a>
                                <a href="<?=base_url().'?type=uls&service='.$service.'&reg=all'?>">울산</a>
                                <a href="<?=base_url().'?type=gye&service='.$service.'&reg=all'?>">경남</a>
                            </dd>
                        </dl>

                    </div>
                    <div class="box_gray">
                        <ul class="text_radio">
                            <li>
                                <input type="radio" id="<?=$type?>_all" name="area[]" <?=($get['reg'] == '') ? 'checked' : ''; ?> value="" />
                                <label for="<?=$type?>_all"><?=REGION[$type]?> 전체</label>
                            </li>
                            <?php if (isset($sigu)):
                                foreach ($sigu as $key => $value):
                                    ?>
                                    <li>
                                        <input type="radio" id="<?=$type?>_<?=$key?>" name="area[]" <?=($get['reg'] == $value) ? 'checked' : ''; ?>  value="<?=$value?>" />
                                        <label for="<?=$type?>_<?=$key?>"><?=$value?></label>
                                    </li>
                                <?php endforeach;
                            endif;
                            ?>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </section>
    */?>
        <!--지역구 링크 재작업-->
        <section class="main_area">
            <ul class="grid grid8">
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=강서구">강서구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=금정구">금정구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=기장군">기장군</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=남구">남구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=동구">동구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=동래구">동래구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=부산진구">부산진구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=북구">북구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=사상구">사상구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=사하구">사하구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=서구">서구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=수영구">수영구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=연제구">연제구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=영도구">영도구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=중구">중구</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=bus&service=P&reg=해운대구">해운대구</a></li>

                <li><a class="btn btn_colorline btn_large" href="./company?type=gye&service=P&reg=all">경남</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=gye&service=P&reg=김해시">김해</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=gye&service=P&reg=양산시">양산</a></li>
                <li><a class="btn btn_colorline btn_large" href="./company?type=uls&service=P&reg=all">울산</a></li>
            </ul>
        </section>
        <!--//지역구 링크 재작업-->


    <hr>
    <div class="main_count dot_list text-center txt_up">
        <ul class="flex ai-c jc-c">
            <li>오늘 방문자 <strong class="txt_color"><?=number_format($response['todayCount'] ?? 0)?></strong>명</li>
            <li>총 방문자 <strong class="txt_color"><?=number_format($response['totalCount'] ?? 0) ?></strong>명</li>
        </ul>
    </div>
    <br>
    <section class="main_list">
        <h3 class="flex ai-c"><i class="fa-solid fa-crown"></i> 금주의 인기 업체</h3>
        <div class="company_list ad_list">
            <ul class="grid grid4">
                <?php if(empty($companyTop)):?>
                    <li>
                        등록되어 있는 업체가 없습니다
                    </li>
                <?php else:
                    foreach ($companyTop as $list):?>
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
                endif;?>


            </ul>
            <div class="more">
                <a class="btn_circle" href="<?= base_url()?>/company?type=bus&service=P&reg=all">
                    <i class="fa-regular fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    <section class="main_md_banner">
        <ul class="grid grid3 gap20">
            <li class="img"><a href="http://www.baic.co.kr/" target="_blank"><img src="<?=base_url()?>img/main_md_banner01.jpg"></a></li>
            <li class="img"><img src="<?=base_url()?>img/main_md_banner02.jpg"></li>
            <li class="img"><img src="<?=base_url()?>img/main_md_banner03.jpg"></li>
        </ul>
    </section>
    <section class="main_list">
        <h3 class="flex ai-c"><i class="fa-solid fa-crown"></i> 프라임 서비스</h3>
        <div class="company_list ad_list">
            <ul class="grid grid4">
                <?php if (empty($companyBottom)):?>
                    <li>
                        등록되어 있는 업체가 없습니다
                    </li>
                <?php else:
                    foreach ($companyBottom as $list):?>
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
                endif;?>

            </ul>
            <div class="more">
                <a class="btn_circle" href="<?= base_url()?>/company?type=bus&service=P&reg=all">
                    <i class="fa-regular fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
</div>
<?php include_once APPPATH."Views/modal/app/index_estimateModal.php" // 모달 ?>
<?php include_once APPPATH."Views/template/popup.php" // 팝업 ?>
<script src="<?=base_url()?>js/app/index.js?<?=JS_VER?>"></script>


