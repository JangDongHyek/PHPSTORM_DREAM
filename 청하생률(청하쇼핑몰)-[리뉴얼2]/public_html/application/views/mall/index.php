<div id="visual">
    <!-- Swiper -->
    <div class="swiper mainSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide mv01">
                <img src="<?=ASSETS_URL?>/img/main/main_visual01.jpg" class="ban">
                <div class="slg left">
                    <span class="color_brown">당도가 높고 달콤해서 남녀노소 누구나 즐기는</span>
                    <h3 class="color_green">청하생률</h3>
                    <p>영양적 가치가 높은 생밤을 먹기 위해<br>
                        화학물질을 전혀 사용하지않고<br>
                        자연상태로 껍질을 벗기는 특별하게 개발된 기술로 가공합니다. </p>
                </div>
            </div>
            <div class="swiper-slide mv02">
                <img src="<?=ASSETS_URL?>/img/main/main_visual02.gif" class="ban">
                <div class="slg left">
                    <span>몸에도 좋고 맛도 좋고</span>
                    <h3>영양만점 간편간식</h3>
                    <p>견과류 중 유일하게 비타민 C 함유<br>
                       비타민 D, 비타민 B1 등 각종 영양소가 골고루<br>
                        저지방 식품 (100g당 0.6g)</p>
                </div>
            </div>
            <div class="swiper-slide mv03">
                <img src="<?=ASSETS_URL?>/img/main/main_visual03.jpg" class="ban">
                <div class="slg left">
                    <span class="color_brown">이제 먹고싶은 생밤을 간편하게 먹어요</span>
                    <h3 class="color_brown">손대면 노란알맹이가 <strong class="color_yellow">톡!</strong></h3>
                    <p class="color_brown">영양적가치가 더 높은 생밤을 먹기위해 <br>
                        청하생률은 화학물질을 전혀 사용하지않고 <br>
                        자연상태로 껍질을 벗기는 특별하게 개발된 <br>
                        특허 제 10-1177529호 발명기술로 가공합니다.</p>
                </div>
<!--
                <div class="img">
                    <img src="<?=ASSETS_URL?>/img/main/visual03_img.png">
                </div>
-->
            </div>
        </div>
        <div class="swiper-button">
            <div class="swiper-pagination"></div>
        </div>
    </div>
            <div class="swiper-button-prev"><i class="fa-light fa-chevron-left"></i></div>
            <div class="swiper-button-next"><i class="fa-light fa-chevron-right"></i></div>
</div>


<div id="idx_bast">
    <div class="inr">
   <div class="titWrap">
        <h4>청하생률 베스트상품</h4>
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

<div id="idx_drugs" style="margin-bottom: 0;">
    
    <div class="inr">
        <div class="imgWrap">
            <img src="<?=ASSETS_URL?>/img/main/cal01.jpg">
        </div>
       <div class="titWrap color_green">
            <h4>청하생률<br>더 맛있게 먹기</h4>
            <p>몸에도 좋고 맛도 좋고 먹기편한 영양만점 맛밤<br>당도가 높고 달콤해서 남녀노소 누구나 드실 수 있는 자연산 단밤입니다.</p>
            <ul class="color_brown">
                <li>
                    <span>1</span>
                    우유나 야구르트와 같이 믹서기에 갈아 밤쉐이크로 마시기
                </li>
                <li>
                    <span>2</span>
                    밥솥에 넣어 맛있는 밤밥으로 먹기
                </li>
                <li>
                    <span>3</span>
                    밤을 믹서기에 갈아 쌀과 밥을 1:1 비율로 고소한 밤죽으로 먹기
                </li>
                <li>
                    <span>4</span>
                    믹서기로 갈아 계란 3개, 밤 5개 비율로 밤 계란말이로 먹기
                </li>
                <li>
                    <span>5</span>
                    삼계탕, 갈비탕, 전골류, 찌개 등 다양하게 넣어 먹기
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="idx_guide">
    <div class="inr">
   <div class="titWrap">
        <h4>생생한 구매후기</h4>
        <a href="<?=PROJECT_URL?>/board/<?=$list['idx']?>?cate=review" class="btn btn_mini btn_whiteline btn-mv">더보기</a>
    </div>
    <ul class="reviewWrap">

        <?php
        $list_i = 0;
        foreach($listData as $list) {

            if($list_i == 6){
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
                    <p><?=$list["mb_name"]?></p>

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
                        <span><?=replaceDateFormat($list['reg_date'])?></span>
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
