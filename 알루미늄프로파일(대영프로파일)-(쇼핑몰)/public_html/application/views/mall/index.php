<div id="visual">
    <!-- Swiper -->
    <div class="swiper mainSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide mv01">
                <img src="<?=ASSETS_URL?>/img/main/product01.png" class="ban">
                <div class="slg left">
                    <span class="color_red">알루미늄 프로파일 40/80시리즈</span>
                    <h3 class="color_blue">DNF4080 40X80</h3>
                    <p>탁월한 내구성과 완벽한 조립성으로 제작된 40/80시리즈는<br>
                        높은 신뢰성과 성능을 제공합니다. </p>
                </div>
            </div>
            <div class="swiper-slide mv02">
                <img src="<?=ASSETS_URL?>/img/main/product02.png" class="ban">
                <div class="slg left">
                    <span class="color_red">알루미늄 프로파일 80/160시리즈</span>
                    <h3 class="color_blue">DF80160 80X160</h3>
                    <p>강력한 내구성과 정밀한 조립이 특징인 80/160시리즈는<br>
                        대형 구조물에도 탁월한 안정성을 제공합니다. </p>
                </div>
            </div>
        </div>
        <div class="swiper-button">
            <div class="swiper-pagination"></div>
        </div>
    </div>
            <div class="swiper-button-prev"><i class="fa-light fa-chevron-left"></i></div>
            <div class="swiper-button-next"><i class="fa-light fa-chevron-right"></i></div>
</div>

<div class="idx_banner">
    <a href="http://www.xn--vk1bq5hp0njnb342amyc.kr/" target="_blank">
        <img src="<?=ASSETS_URL?>/img/main/banner_logo.jpg"> <span>홈페이지 바로가기 <i class="fa-light fa-arrow-right"></i></span>
    </a>
</div>
<div id="idx_bast">
    <div class="inr">
   <div class="titWrap">
        <h4>베스트상품</h4>
        <a href="<?=PROJECT_URL?>/medicinal" class="btn btn_mini btn_whiteline btn-mv">더보기</a>
    </div>
        <div class="product_list">
			<? if (count($mdData) == 0) { ?>
                <ul><li class="noDataAlign" style="width: 100%; text-align: center;">등록된 상품이 없습니다.</li></ul>
			<? } else { ?>
            <ul>
				<?
				foreach ($mdData AS $row) {
					$thumbnail = ASSETS_URL . '/' . getProductThumbnail($row['file_name_list']);
				?>
                <li onclick="location.href='<?=PROJECT_URL?>/medicinal/<?=$row['idx']?>'">
                    <div class="area_img">
                        <img src="<?=$thumbnail?>">
						<span class="icon square02 rd"><strong>BEST</strong></span>
						<?if($row['soldout_yn']=='Y'){?><span class="ic_sold_out"><strong>임시 품절</strong></span><?}?>
                    </div>
                    <div class="area_text">
                        <span><?=$row['prod_origin']?></span>
                        <p class="p_name"><?=$row['prod_name']?></p>
                        <p class="p_price">

                           <!--시중가격-->
                            <?php if($row['prod_price2']){ ?>
                            <u class=""><?=number_format($row['prod_price2'])?>원</u>
                            <?php } ?>
                            
<!--                            할인가격-->
                           <strong><?=number_format($row['prod_price'])?>원</strong>
                        </p>
                    </div>
                </li>
				<? } // end foreach ?>
            </ul>
			<?} // end if ?>
        </div>
    </div>
</div>

<div id="idx_guide">
    <div class="inr">
   <div class="titWrap">
        <h4>구매후기</h4>
        <a href="<?=PROJECT_URL?>/board/<?=$list['idx']?>?cate=review" class="btn btn_mini btn_whiteline btn-mv">더보기</a>
    </div>
    <ul class="reviewWrap">

        <?php
        $list_i = 0;
        foreach($listData as $list) {

            if($list_i == 4){
                break;
            }
        // 상세보기 링크
        $defaultLink = PROJECT_URL . "/board/{$list['idx']}?cate={$category}";
        $alertLink = "javascript:showAlert('본인이 작성한 글만 열람이 가능합니다.')";
        $allowedToView = $isAdminAccount || $list['mb_id'] == $member['mb_id']; // 관리자 & 본인글 여부
        $viewLink = ($list['secret_yn'] == 'Y' && !$allowedToView)? $alertLink : $defaultLink; // 비밀글 체크

        // 새글여부 (24시간 이전)
        $hoursPassed = getPassedHours($list['reg_date']);
        $downloadUri = PROJECT_URL.'/file/download?path='.uploadFileRemoveServerPath(UPLOAD_FOLDERS['BOARD']);

        $imgFile_ORG = json_decode($list['file_name_json']);
           $file_name_json  = json_decode($list['file_name_json'], JSON_UNESCAPED_UNICODE);

           if($file_name_json[0]['name']){
               $thumbNail = ASSETS_URL . '/uploads/cs/' . $file_name_json[0]['name']; // 썸네일
           }else{
               $thumbNail = ASSETS_URL . '/img/common/noimg.jpg'; // 썸네일
           }



        //var_dump($imgFile[0]['name']);
        //$imgURL_1 = ASSETS_URL.$imgFile_ORG[0]['name'];
        ?>
            <li>
                <div class="thumb">
                    <img src="<?=$thumbNail?>" onerror="this.src='<?=ASSETS_URL?>/img/common/noimg.jpg';">
                </div>
                <div class="text">
                    <h6><?=$list['title']?></h6>
                    <div class="flex">
                        <p><?=$list["mb_name"]?></p>
                        <span><?=replaceDateFormat($list['reg_date'])?></span>
                    </div>
                    <div class="info">
                        <span><?=$list["content"]?></span>
                        <div style="display: none">
                        <?php if($list["star"] == 1){ ?>
                            <span><img src="<?=ASSETS_URL?>/img/main/ico_star1.jpg"></span>
                        <?php }elseif($list["star"] == 2){ ?>
                            <span><img src="<?=ASSETS_URL?>/img/main/ico_star2.jpg"></span>
                        <?php }elseif($list["star"] == 3){ ?>
                            <span><img src="<?=ASSETS_URL?>/img/main/ico_star3.jpg"></span>
                        <?php }elseif($list["star"] == 4){ ?>
                            <span><img src="<?=ASSETS_URL?>/img/main/ico_star4.jpg"></span>
                        <?php }else{ ?>
                            <span><img src="<?=ASSETS_URL?>/img/main/ico_star5.jpg"></span>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php
            $list_i++;
            $paging['listNo']--;
        }
        if ($paging['totalCount'] == 0) {
            ?>

        <?php } ?>

    </ul>
    </div>
</div>
