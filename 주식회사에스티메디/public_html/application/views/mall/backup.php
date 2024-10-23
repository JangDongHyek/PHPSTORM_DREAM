<!--메인-->


<div id="idx_bast">
	<h4><span class="icon gr">MD추천</span><br>이 상품은 어떠세요?</h4>
	<div class="inr">
		<div class="product_list">
			<!--임시-->
			<ul>
				<li onclick="location.href='<?=PROJECT_URL?>/product/1'">
					<div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
						<span class="icon square sk"><strong>인기</strong></span>
					</div>
					<div class="area_text">
						<span>한국백신</span>
						<p class="p_name">정맥카테터(I.V CATH)</p>
						<p class="p_price">13,900원</p>
					</div>
				</li>
				<li onclick="location.href='<?=PROJECT_URL?>/product/1'">
					<div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample2.jpg" />
						<span class="icon square sk"><strong>인기</strong></span>
					</div>
					<div class="area_text">
						<span>성심메디칼</span>
						<p class="p_name">일회용주사기(Syringe)</p>
						<p class="p_price">5,400원</p>
					</div>
				</li>
				<li onclick="location.href='<?=PROJECT_URL?>/product/1'">
					<div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample3.jpg" />
						<span class="icon square sk"><strong>인기</strong></span>
					</div>
					<div class="area_text">
						<span>정림</span>
						<p class="p_name">일회용주사기(Syringe)</p>
						<p class="p_price">5,600원</p>
					</div>
				</li>
				<li onclick="location.href='<?=PROJECT_URL?>/product/1'">
					<div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample4.jpg" />
						<span class="icon square sk"><strong>인기</strong></span>
					</div>
					<div class="area_text">
						<span>성심메디칼</span>
						<p class="p_name">일회용주사기(Syringe)</p>
						<p class="p_price">8,500원</p>
					</div>
				</li>
			</ul>
			<!--임시-->
			<?/* if (count($mdData) == 0) { ?>
			<p>등록된 MD상품이 없습니다.</p>
			<? } else { ?>
            <ul>
				<?
				foreach ($mdData AS $row) {
					$thumbnail = ASSETS_URL . '/' . getProductThumbnail($row['file_name_list']);
				?>
                <li onclick="location.href='<?=PROJECT_URL?>/medicinal/<?=$row['idx']?>'">
                    <div class="area_img">
                        <img src="<?=$thumbnail?>">
						<span class="icon square sk"><strong>인기</strong></span>
						<?if($row['soldout_yn']=='Y'){?><span class="icon square bl"><strong>품절</strong></span><?}?>
                    </div>
                    <div class="area_text">
                        <span><?=$row['prod_origin']?></span>
                        <p class="p_name"><?=$row['prod_name']?></p>
                        <p class="p_price"><?=number_format($row['prod_price'])?>원</p>
                    </div>
                </li>
				<? } // end foreach ?>
            </ul>
			<?} // end if */?>
		</div>
	</div>
</div>

<!--div id="idx_drugs" style="margin-bottom: 0;">
    <h4>추천약재</h4>
    <div class="inr">
        <div class="circle_list">
            <ul>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs01.jpg"></div>
                    <p>황정(둥굴레)</p>
                </li>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs02.jpg"></div>
                    <p>율무</p>
                </li>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs03.jpg"></div>
                    <p>오미자</p>
                </li>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs04.jpg"></div>
                    <p>황기</p>
                </li>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs05.jpg"></div>
                    <p>당귀</p>
                </li>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs06.jpg"></div>
                    <p>작약</p>
                </li>
                <li>
                    <div class="area_img circle"><img src="<?=ASSETS_URL?>/img/main/idx_drugs07.jpg"></div>
                    <p>돼지감자</p>
                </li>
            </ul>
        </div>
    </div>
</div-->
<div id="idx_new">
	<h4><span class="icon">신상품</span><br>새로 들어왔어요!</h4>
	<div class="inr">
		<div class="product_list">
			<ul>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>케프라</span>
						<p class="p_name">레비티라세탐 1g</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>리스페리돈</span>
						<p class="p_name">리스페리돈 1mg</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>무코스타</span>
						<p class="p_name">레바미피드 100mg</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>아리셉트</span>
						<p class="p_name">도네페질염산염 5mg</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<div id="idx_sale">
	<h4><span class="icon gr">할인중</span><br>지금이 기회에요!</h4>
	<div class="inr">
		<div class="product_list">
			<ul>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>케프라</span>
						<p class="p_name">레비티라세탐 1g</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>리스페리돈</span>
						<p class="p_name">리스페리돈 1mg</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>무코스타</span>
						<p class="p_name">레바미피드 100mg</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
				<li>
					<div class="area_img">
						<img src="<?=ASSETS_URL?>/img/common/mediimg.jpg">
					</div>
					<div class="area_text">
						<span>아리셉트</span>
						<p class="p_name">도네페질염산염 5mg</p>
						<p class="p_price"><u>120,000원</u> 100,000원</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<div id="idx_guide" style="background: url('<?=ASSETS_URL?>/img/main/idx_guide.jpg')">
	<img src="<?=ASSETS_URL?>/img/common/logo_w.png">
	<p>회원가입 및 사업자인증 확인 후 구매가능합니다.</p>
	<a class="btn btn_middle btn_white" href="<?=PROJECT_URL?>/signUp">회원가입 바로가기</a>
</div>


<div class="index_panel">
	<div class="inr flex">
		<div class="login flex">
			<i class="fa-regular fa-hospital"></i>
			<div>
				<h6>회원등급 <span>일반</span></h6>
				<p><storng>햇살요양병원</storng>님</p>
			</div>
		</div>
		<div class="past_purchase">
			<a href="<?=PROJECT_URL?>/order">이전 주문 그대로<span><i class="fa-regular fa-paste"></i> 최근구매</span></a>
		</div>
		<div class="quick_purchase">
			<a href="<?=PROJECT_URL?>/medicinal"><em>쏙</em><em>쏙</em>&nbsp;골라 빠르고 간편하게<span>의약품 간편구매 <i class="fa-regular fa-bullseye-pointer"></i></span></a>
		</div>
	</div>
</div>
