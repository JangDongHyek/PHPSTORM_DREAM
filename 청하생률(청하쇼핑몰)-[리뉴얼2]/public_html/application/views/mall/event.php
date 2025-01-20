<div id="products_list">

    <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <div id="main_list">
        <div class="top_list flex js">
            <p class="total">총 <strong class="txt_green">628</strong>개의 상품이 등록되었습니다.</p>
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
                        <img src="<?=ASSETS_URL?>/img/common/noimg.jpg">
                    </div>
                    <div class="area_text">
                        <span>초근목피</span>
                        <p class="p_name">침향꽃벵이환 10환</p>
                        <p class="p_price">120,000원</p>
                    </div>
                </li>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
                        <img src="<?=ASSETS_URL?>/img/common/noimg.jpg">
                    </div>
                    <div class="area_text">
                        <span>초근목피</span>
                        <p class="p_name">침향꽃벵이환 10환</p>
                        <p class="p_price">120,000원</p>
                    </div>
                </li>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
                        <img src="<?=ASSETS_URL?>/img/common/noimg.jpg">
                    </div>
                    <div class="area_text">
                        <span>초근목피</span>
                        <p class="p_name">침향꽃벵이환 10환</p>
                        <p class="p_price">120,000원</p>
                    </div>
                </li>
                <li onclick="location.href='./product/1'">
                    <div class="area_img">
                        <img src="<?=ASSETS_URL?>/img/common/noimg.jpg">
                    </div>
                    <div class="area_text">
                        <span>초근목피</span>
                        <p class="p_name">침향꽃벵이환 10환</p>
                        <p class="p_price">120,000원</p>
                    </div>
                </li>
            </ul>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>

    </div>
</div>
