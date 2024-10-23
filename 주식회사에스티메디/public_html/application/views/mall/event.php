<div id="products_list">

    <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <div id="main_list">
        <div class="top_list flex js">
            <p class="total">총 <strong class="txt_blue">4</strong>개의 상품이 등록되었습니다.</p>
            <div class="sort">
                <ul>
                    <li><a class="active">등록순</a></li>
                    <li><a>상품명순</a></li>
                    <li><a>낮은가격순</a></li>
                    <li><a>높은가격순</a></li>
                </ul>
            </div>
        </div>
        <div class="product_list">
            <ul>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
                    </div>
                    <div class="area_text">
                        <span>한국백신</span>
                        <p class="p_name">정맥카테터(I.V CATH)</p>
                        <p class="p_price">13,900원</p>
                    </div>
                </li>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample2.jpg" />
                    </div>
                    <div class="area_text">
                        <span>성심메디칼</span>
                        <p class="p_name">일회용주사기(Syringe)</p>
                        <p class="p_price">5,400원</p>
                    </div>
                </li>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample3.jpg" />
                    </div>
                    <div class="area_text">
                        <span>정림</span>
						<p class="p_name">일회용주사기(Syringe)</p>
						<p class="p_price">5,600원</p>
                    </div>
                </li>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
						<img src="<?= ASSETS_URL ?>/img/sub/sample4.jpg" />
                    </div>
                    <div class="area_text">
						<span>성심메디칼</span>
						<p class="p_name">일회용주사기(Syringe)</p>
                        <p class="p_price">8,500원</p>
                    </div>
                </li>
            </ul>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>

    </div>
</div>
