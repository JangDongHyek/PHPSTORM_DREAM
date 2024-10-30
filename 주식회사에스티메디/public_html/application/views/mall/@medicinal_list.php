<?php
var_dump($orders);
?>
<section id="user" class="ver2">
    <div class="location">
        <i class="fa-light fa-house-blank"></i> 홈 <i class="fa-light fa-angle-right"></i> <strong>의약품</strong>
    </div>
    <div class="inr flex js">
        <section>
            <h6>최근 주문
                <button type="button" class="btn" id="listOpen1">접기</button>
            </h6>
            <div class="w100"><!--임시-->
                <? foreach($orders as $index => $order) {?>
				<div class="flex js sub" id="drugs_list_recent">
					<span class="flex gap10 ai-c w100">
						<strong>주문일 <b class="txt_blue"><?=explode(' ',$order['reg_date'])[0]?></b></strong>
						<button type="button" class="btn male-auto btn_blueline" onclick="addAllProduct('<?=$order['idx']?>')">전체 담기</button>
					</span>
				</div>
				<div class="drugs_list my_list">
					<ul>
                        <? foreach($order['products'] as $product) { ?>
						<li>
							<div class="flex">
								<input type="checkbox" value="<?=$product['info']['idx']?>" v-model="carts">
								<label for="checkIdx_recent1">
									<div>
										<p class="p_name">
											<?=$product['info']['PRODUCT_NM']?>
										</p>
										<span>제조사 <strong><?=$product['info']['MAKER_NM']?></strong> |</span>
										<span>규격 <strong><?=$product['info']['PRODUCT_STANDARD']?></strong> |</span><br class="visible-xs">
										<span>성분명 <strong><?=$product['info']['CONS_CD_NM']?></strong> |</span>
										<span>재고수량  <strong><?=$product['info']['STOCK_QTY']?></strong></span>
                                        <span>주문수량  <strong><?=$product['item_cnt']?></strong></span>
                                        <span>제품가격  <strong><?=number_format($product['info']['prod_price'])?></strong></span>
									</div>
									<div class="area_text">
										<p class="p_price" style="display: none"><?=number_format($product['info']['prod_price'] * $product['item_cnt'])?>원</p>
										<p style="font-weight: 700;text-align: right;"><?=number_format($product['info']['prod_price'] * $product['item_cnt'])?>원</p>
									</div>
								</label>
							</div>
						</li>
                        <?}?>
					</ul>
				</div>
                <?}?>

				<div class="paging">
					<div class="pagingWrap" id="drugs_paging">
						<!--처음-->

						<!--이전-->

						<!--페이지-->
						<a class="active" onclick="">1</a>

						<!--다음-->
						<a class="next disabled" onclick=""><i class="fa-light fa-chevron-right"></i></a>

						<!--마지막-->
						<a class="last disabled" onclick=""><i class="fa-light fa-chevrons-right"></i></a>
					</div>
				</div>
            </div>

        </section>
        <section id="simple">
            <h6>주문하기
                <button type="button" class="btn" id="listOpen2">접기</button>
            </h6>

            <div>
				<div class="flex gap10">

					<button type="button" class="btn btn_large btn_blue" class="more" data-toggle="modal" data-target="#moreModal2"><i class="fa-solid fa-cart-plus"></i> 신규약 담기</button>
					<button type="button" class="btn btn_large btn_green"><i class="fa-solid fa-bags-shopping"></i> 주문하기</button>
				</div>
                <div class="drugs_list">
                    <ul id="drugs_list">
						<li v-for="product,index in products">
							<div class="flex">
								<button type="button" class="delete" @click="deleteCart(product.idx)"><i class="fa-solid fa-x"></i></button>
								<input type="checkbox" name="checkIdx" :value="product.idx" v-model="carts">
								<label>
									<div>
										<p class="p_name">
											{{product.PRODUCT_NM}}
										</p>
										<span>제조사 <strong>{{product.MAKER_NM}}</strong> |</span>
										<span>규격 <strong>{{product.PRODUCT_STANDARD}}</strong> |</span><br class="visible-xs">
										<span>성분명 <strong>{{product.CONS_CD_NM}}</strong> |</span>
										<span>재고수량  <strong>{{product.STOCK_QTY}}</strong></span>
									</div>
									<div class="area_text">
										<p class="p_price">{{parseInt(product.prod_price).format()}}원</p>
									</div>
								</label>
							</div>
							<div class="more" data-toggle="modal" data-target="#moreModal1" @click="modal_product_idx = product.idx">
								<i class="fa-regular fa-arrow-turn-down-right"></i>
								<span><b>대체약</b>({{product.OTHER_PRODUCTS.length}})</span>
							</div>
						</li>
						<li class="empty">

							<p>담은 상품이 없습니다.</p>
						</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>

    <!-- 동일성분약품 Modal -->
    <div class="modal fade more_modal" id="moreModal1" tabindex="-1" aria-labelledby="moreModal1Label" aria-hidden="true">
        <div class="modal-dialog wide">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="drugs_list_cons_modal">
                    <div class="box">
                        <p class="txt_bold txt_blue">선택 의약품</p>
                        <div class="flex jc-sb basic">
                            <div>
                                <p class="p_name">{{modal_product.PRODUCT_NM}}</p>
                            </div>
                            <div class="area_text">
                                <p class="p_price">{{parseInt(modal_product.prod_price).format()}}원</p>
                            </div>
                        </div>
                    </div>
                    <div class="search">
                        <input type="search" v-model="modal_search_value" placeholder="원하시는 제품을 검색하세요" value=""/>
                        <button type="button" class="btn"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>

                    <p class="txt_bold txt_blue">대체약</p>
                    <ul class="drugs_list">
                        <li v-for="item,index in modal_other_products">
                            <div class="flex">
                                <input type="checkbox" name="" :value="item.idx" v-model="carts">
                                <label>
                                    <div>
                                        <p class="p_name">{{item.PRODUCT_NM}}</p>
                                        <span>제조사 <strong>{{item.MAKER_NM}}</strong> |</span>
                                        <span>규격 <strong>{{item.PRODUCT_STANDARD}}</strong> |</span>
                                        <!--<span>대체약  <strong>무코스타</strong></span>-->
                                    </div>
                                    <div class="area_text">
                                        <p class="p_price">{{parseInt(item.prod_price).format()}}원</p>
                                    </div>
                                </label>
                            </div>
                        </li>

                    </ul>
                    <div class="paging">
                        <div class="pagingWrap">
                            <!--처음-->

                            <!--이전-->

                            <!--페이지-->
                            <a class="active" href="javascript:void(0)">1</a>
                            <a class="" onclick="callContent()" href="?page=2&amp;">2</a>
                            <a class="" href="?page=3&amp;">3</a>
                            <a class="" href="?page=4&amp;">4</a>
                            <a class="" href="?page=5&amp;">5</a>

                            <!--다음-->
                            <a class="next disabled" href="?page=11&amp;"><i class="fa-light fa-chevron-right"></i></a>

                            <!--마지막-->
                            <a class="last disabled" href="?page=101&amp;"><i class="fa-light fa-chevrons-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--
                    <button type="button" class="btn btn_middle btn_gray" data-dismiss="modal">닫기</button>
                    -->
                    <button type="button" class="btn btn_middle btn_blue" data-dismiss="modal">선택 완료</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 신규약 Modal -->
    <div class="modal fade more_modal" id="moreModal2" tabindex="-1" aria-labelledby="moreModal2Label" aria-hidden="true">
        <div class="modal-dialog wide">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="drugs_list_cons_modal">
                    <div class="search">
                        <input type="search" v-model="modal2_like_value" placeholder="원하시는 제품을 검색하세요" value=""/>
                        <button type="button" class="btn"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>

                    <ul class="drugs_list">
                        <li v-for="item,index in modal2_products">
                            <div class="flex">
                                <input type="checkbox" name="" :value="item.idx" v-model="carts">
                                <label>
                                    <div>
                                        <p class="p_name">{{item.PRODUCT_NM}}</p>
                                        <span>제조사 <strong>{{item.MAKER_NM}}</strong> |</span>
                                        <span>규격 <strong>{{item.PRODUCT_STANDARD}}</strong> |</span>
                                        <!--<span>대체약  <strong>무코스타</strong></span>-->
                                    </div>
                                    <div class="area_text">
                                        <p class="p_price">{{parseInt(item.prod_price).format()}}원</p>
                                    </div>
                                </label>
                            </div>
                        </li>

                    </ul>
                    <div class="paging">
                        <div class="pagingWrap">
                            <!--처음-->

                            <!--이전-->

                            <!--페이지-->
                            <a class="active" href="javascript:void(0)">1</a>
                            <a class="" onclick="callContent()" href="?page=2&amp;">2</a>
                            <a class="" href="?page=3&amp;">3</a>
                            <a class="" href="?page=4&amp;">4</a>
                            <a class="" href="?page=5&amp;">5</a>

                            <!--다음-->
                            <a class="next disabled" href="?page=11&amp;"><i class="fa-light fa-chevron-right"></i></a>

                            <!--마지막-->
                            <a class="last disabled" href="?page=101&amp;"><i class="fa-light fa-chevrons-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--
                    <button type="button" class="btn btn_middle btn_gray" data-dismiss="modal">닫기</button>
                    -->
                    <button type="button" class="btn btn_middle btn_blue" data-dismiss="modal">선택 완료</button>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $jl->vueLoad("user");?>

<script>
    Jl_data.carts = [];
    Jl_data.products = [];
    Jl_data.modal_product_idx = "";
    Jl_data.modal_product = {};
    Jl_data.modal_search_value = "";

    Jl_data.modal2_like_value = "";
    Jl_data.modal2_page = 1;
    Jl_data.modal2_limit = 10;
    Jl_data.modal2_products = [];

    Jl_watch.carts = function() {
        getProduct(this.carts)
    }

    Jl_watch.modal_product_idx = function() {
        getModalProduct(this.modal_product_idx)
    }

    Jl_methods.deleteCart = function(idx) {
        let index = this.carts.findIndex(item => item == idx);
        console.log(idx);
        console.log(index);
        if(index !== -1) {
            this.carts.splice(index,1);
        }
    }

    //검색 된 데이터 반환 만드는
    Jl_computed.modal_other_products = function() {
        if(!this.modal_product) return [];

        if(this.modal_search_value) return this.jl.findsObject(this.modal_product.OTHER_PRODUCTS,'PRODUCT_NM',this.modal_search_value,true)

        return this.modal_product.OTHER_PRODUCTS;
    }

    async function getAllProduct() {
        let vue = Vue.user.$data
        let obj = {
            del_yn : "N",
            use_yn : "Y",
            page : vue.modal2page,
            limit : vue.modal2_limit,
            like_key : "PRODUCT_NM",
            like_value : vue.modal2_like_value
        };
        try {
            let res = await jl.ajax("get",obj,"/api/bs_product");

        }catch (e) {
            alert(e.message)
        }
    }

    async function addAllProduct(idx) {
        if(!idx) return false;

        let obj = {ord_idx : idx};
        try {
            let res = await jl.ajax("get",obj,"/api/bs_order_item");
            let carts = Vue.user.$data.carts
            res.data.forEach(function(product) {
                console.log(product);
                let index = carts.findIndex(item => item == product.product_idx);
                if(index == -1) {
                    carts.push(product.product_idx)
                }
            });
        }catch (e) {
            alert(e.message)
        }
    }

    async function getModalProduct(idx) {
        if(!idx) return false;

        let obj = {idx : idx};
        try {
            let res = await jl.ajax("get",obj,"/api/bs_product");
            Vue.user.$data.modal_product = res.data[0];
        }catch (e) {
            alert(e.message)
        }
    }

    async function getProduct(carts) {
        if(!carts.length) {
            Vue.user.$data.products = [];
            return false;
        }
        let obj = {
            in_key1 : "idx",
            in_value1 : carts
        };
        try {
            let res = await jl.ajax("get",obj,"/api/bs_product");
            Vue.user.$data.products = res.data;
        }catch (e) {
            alert(e.message)
        }
    }
</script>


<script>
    let a1 = document.querySelector('#listOpen1');
    a1.addEventListener('click', function () {
        if (a1.classList.contains('on')) {
            a1.classList.remove('on');
            a1.innerText = "접기";
        } else {
            a1.classList.add('on');
            a1.innerText = "열기";
        }
    });

    let b1 = document.querySelector('#listOpen2');
    b1.addEventListener('click', function () {
        if (b1.classList.contains('on')) {
            b1.classList.remove('on');
            b1.innerText = "접기";
        } else {
            b1.classList.add('on');
            b1.innerText = "열기";
        }
    });
    function medicinalSearchPopup() {
        window.open("../medicinalSearch", "popupWindow", "width=600, height=800, scrollbars=no");
    }
</script>