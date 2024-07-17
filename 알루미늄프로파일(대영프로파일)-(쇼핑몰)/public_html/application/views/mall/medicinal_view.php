<!--제품소개 상세-->
<?php
// print_r($imageFiles);
?>
<template id="app">
    <div id="products_view">
        <div class="area_top">
            <div class="area_img">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <? foreach ($imageFiles as $file) { ?>
                            <div class="swiper-slide">
                                <img src="<?= ASSETS_URL ?>/uploads/product/<?=$file['filename']?>" />
                            </div>
                        <? } ?>
                        <? if(count($imageFiles) == 0) { ?>
                            <div class="swiper-slide">
                                <img src="<?= ASSETS_URL ?>/img/common/noimg.jpg" />
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <? foreach ($imageFiles as $file) { ?>
                            <div class="swiper-slide">
                                <img src="<?= ASSETS_URL ?>/uploads/product/<?=$file['filename']?>" />
                            </div>
                        <? } ?>
                        <? if(count($imageFiles) == 0) { ?>
                            <div class="swiper-slide">
                                <img src="<?= ASSETS_URL ?>/img/common/noimg.jpg" />
                            </div>
                        <? } ?>
                    </div>
                </div>
                <!-- Initialize Swiper -->
                <script>
                    var swiper = new Swiper(".mySwiper", {
                        spaceBetween: 10,
                        slidesPerView: 4,
                        freeMode: true,
                        watchSlidesProgress: true,
                    });
                    var swiper2 = new Swiper(".mySwiper2", {
                        spaceBetween: 10,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        thumbs: {
                            swiper: swiper,
                        },
                    });
                </script>
            </div>
            <div class="area_text">
                <div class="location"><i class="fa-light fa-house-blank"></i> 홈 <i class="fa-light fa-angle-right"></i><strong>제품소개</strong></div>
                <h2><?=$productData['prod_name']?>
                    <? if ($productData['soldout_yn'] == 'Y') { ?>
                        <span class="soldout">임시품절</span>
                    <? } ?>
                </h2>
                <div class="info"  style="display: none">
                    <!--
				<dl>
					<dt>약재명</dt>
					<dd><?=$productData['prod_name']?></dd>
					<dt>원산지</dt>
					<dd><?=$productData['prod_origin']?></dd>
				</dl>
				<dl>
					<dt>포장방법</dt>
					<dd><?=$productData['package_method']?></dd>
					<dt>상품구성</dt>
					<dd><?=$productData['prod_format']?></dd>
				</dl>
-->
                    <dl>
                        <dt>고객 별점</dt>
                        <dd><img src="<?=ASSETS_URL?>/img/main/ico_star5.jpg"><span>평균 5.0개</span></dd>
                    </dl>
                </div>
                <div class="delivery">
                    <dl>
                        <dt>배송방법</dt>
                        <dd><?=$productData['shipping_info']?></dd>
                        <dt>배송비</dt>
                        <dd><?=$productData['shipping_free_yn'] == 'Y' ? '무료' : '3,000원(4만원 이상 무료)'?></dd>
                        <dt>제주/도서산간 배송비</dt>
                        <dd>3,000원</dd>
                    </dl>
                </div>
                <div class="option">
                    <!--시중가격-->
                    <?php if($productData['prod_price2']){ ?>
                        <dl>
                            <dt>기본가격</dt>
                            <dd><strong class="prodPriceDisplay"><?=number_format($productData['prod_price2'])?>원</strong></dd>
                        </dl>
                    <?php } ?>
                    <dl>
                        <dt>할인가격</dt>
                        <dd><strong class="txt_orange prodPriceDisplay"><?=number_format($productData['prod_price'])?>원</strong></dd>
                    </dl>
                    <dl v-if="data.categoryChild && data.categoryChild.name == '프로파일'">
                        <dt>절단길이</dt>
                        <dd class="cutting">
                            <p><input type="text" id="cut_length" name="cut_length" v-model="cut_length" placeholder="25" value="25">mm</p>
                            <p class="comment">※최소25mm ~ 최대6000mm 까지 주문 가능합니다.<br>
                                ※절단 공차는 0.3mm이내로 관리하고 있습니다.</p>
                        </dd>
                    </dl>
                    <dl v-if="data.categoryChild && data.categoryChild.name == '프로파일'">
                        <dt>절단비</dt>
                        <dd class="cutting">
                            <strong class="prodPriceDisplay" class="comment">330원</strong>
                        </dd>
                    </dl>

                    <dl v-if="data.categoryChild && data.categoryChild.name == '프로파일'">
                        <dt>가공선택</dt>
                        <dd class="cutting">
                            <select v-model="processing_index" @change="changeEvent">
                                <option value="">추가상품</option>
                                <option v-for="item,index in datas" :value="index">
                                    <span>{{item.prod_name}} (+{{parseInt(item.prod_price2).format()}})원</span>
                                </option>
                            </select>
                        </dd>
                    </dl>
                    
                    <dl>
                        <dt>구매수량</dt>
                        <dd>
                            <p class="number_controller">
                                <button type="button" @click="product.amount = product.amount > 1 ? product.amount-1 : product.amount"><i class="fa-regular fa-minus"></i></button>
                                <input type="number" name="inputNumber" v-model="product.amount" @input="amountPatten"/>
                                <button type="button" @click="product.amount = product.amount+1"><i class="fa-regular fa-plus"></i></button>
                            </p>
                        </dd>
                    </dl>
                </div>
                <div class="total">
                    <div class="total_price">
                        <p class="text">총 상품금액</p>
                        <p class="price txt_green"><span class="totalPriceDisplay">{{totalPrice.format()}}</span>원</p>
                    </div>
                    <div class="btn_wrap">
                        <?php if ($member) {?>
                            <a class="btn btn_middle btn_greenline" onclick="addCart()">장바구니 담기</a>
                        <?php } ?>
                        <a class="btn btn_middle btn_green" onclick="addCart(true)">바로 주문</a>
                    </div>
                </div>
            </div>
        </div>

        <form name="order" autocomplete="off" method="post">
            <input type="hidden" name="productIdx" value="<?=$productData['idx']?>" /> <!--상품인덱스-->
            <input type="hidden" name="productCnt" v-model="product.amount" /> <!--구매수량-->
            <input type="hidden" id="cut_length2" name="cut_length2" v-model="cut_length" /> <!--구매수량-->
            <input type="hidden" id="processing_idx" name="processing_idx" v-model="processing_idx" /> <!--구매수량-->
            <input type="hidden" name="totalPrice" value="<?=$productData['prod_price']?>" /> <!--총상품금액-->
            <input type="hidden" name="cartIdx[]" /> <!--장바구니 인덱스-->
        </form>

        <div class="area_view">
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-view" aria-controls="tab-view" role="tab" data-toggle="tab">상품 상세정보</a></li>
                    <li role="presentation"><a href="#tab-info" aria-controls="tab-info" role="tab" data-toggle="tab">상품 구매정보</a></li>
                    <li role="presentation"><a href="#tab-review" aria-controls="tab-review" role="tab" data-toggle="tab">상품후기<strong class="txt_orange">(<span class="reviewCntDisplay"><?=number_format($reviewCnt)?></span>)</strong></a></li>
                    <li role="presentation"><a href="#tab-qna" aria-controls="tab-qna" role="tab" data-toggle="tab">상품문의<strong class="txt_orange">(<span class="qnaCntDisplay"><?=number_format($qnaCnt)?></span>)</strong></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab-view"><?=$productData['content']?></div>
                    <div role="tabpanel" class="tab-pane" id="tab-info">
                        <dl>
                            <dt>배송정보</dt>
                            <dd><p>- 주문하신 제품의 판매자가 다른 경우 부분배송되며, 실제 배송 상황에 따라 1~2일 정도 차이가 발생할 수 있습니다.</p>
                                <p>- 입금확인후 2~5일이내(토,일,공휴일제외)에 배송되며 도서산간지역의 경우 배송일이 추가소요 될 수 있습니다.</p>
                                <p>- 제주도 및 도서산간 지역의 경우 제품수령시 추가배송비가 과금될 수 있습니다.</p>
                                <p>- 단,특정 업체별로 배송료 부과 기준을 달리하는 경우에는 각 상품별로 공지된 상품설명에 따릅니다.</p>
                            </dd>
                        </dl>
                        <dl>
                            <dt>교환 및 반품정보</dt>
                            <dd><strong>교환 및 반품이 가능한 경우</strong>
                                <p>1. 상품 수령 후 사용하지 않으신 경우에 한하여, 상품을 받거나 공급이 개시된 날로부터 7일 이내 교환 및 반품이 가능합니다.</p>
                                <p>2. 받으신 상품의 내용이 표시·광고 사항과 다른 경우에는 상품들을 받으신 날로부터 3개월 이내</p>
                                <p>3. 전자상거래등에서의 소비자보호에관한법률에 규정되어 있는 소비자 청약철회 가능범위에 해당되는 경우 고객님의 단순한 변심에 의해 상품의 교환 및 반품을
                                    요청하시는 경우에는 상품 반송에 소요되는 비용을 고객님이 부담하셔야 합니다.</p>
                            </dd>
                            <dd><strong>교환 및 반품이 불가능한 경우</strong>
                                <p>1. 고객님의 단순변심으로 인한 교환/반품 요청이 상품을 수령한 날로부터 7일을 경과한 경우</p>
                                <p>2. 고객님의 책임 있는 사유로 상품 등의 가치가 심하게 파손되거나 훼손된 경우</p>
                                <p>3. 시간이 경과되어 재판매가 곤란할 정도로 상품등의 가치가 상실된 경우 (예:신선식품 등)</p>
                                <p>4. 배송된 상품이 하자없음을 확인한 후 설치가 완료된 상품의 경우</p>
                                <p>5. 고객님의 요청에 따라 개별적으로 주문 제작되는 상품의 경우</p>
                                <p>6. 구매하신 상품의 구성품이 누락된 경우</p>
                                <p>7. 복제가 가능한 상품등의 포장을 훼손한 경우 (예:도서, DVD, CD등 복제 가능한 상품)</p>
                                <p>8. 기타, 전자상거래등에서의 소비자보호에관한볍률이 정하는 소비자 청약철회 제한에 해당되는 경우</p>
                            </dd>
                        </dl>
                        <dl>
                            <dt>환불안내</dt>
                            <dd><strong>교환 및 반품이 가능한 경우</strong>
                                <p>1. 신용카드 결제 : 상품 회수 확인 후 해당 카드사로 청구취소 요청(약 7일 정도 소요)</p>
                                <p>2. 무통장 입금 : 상품 회수 확인 후 3일 이내에 환불 처리</p>
                                <p>3. 인터넷 안전결제 ISP 결제 : 상품회수 확인 후 매달 1,8,15,22일 해당 카드사로 청구취소 요청</p>
                            </dd>
                        </dl>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-review">
                        <!-- Button trigger modal -->
                        <a class="btn btn_small btn_gray" onclick="openBoardModal('register', 'review')"> 상품후기 작성하기</a>

                        <div class="board_list">
                            <p>총 <strong class="txt_green reviewCntDisplay"><?=number_format($reviewCnt)?></strong>개 </p>
                            <ul id="reviewList">
                                <!--modal/product_board_data.php-->
                            </ul>

                            <? include_once VIEWPATH . 'component/pagination.php'; // 페이징?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-qna">
                        <div class="qna_info">
                            상품에 대한 궁금하신 점이나 서비스 이용에 불편한 점이 있으신가요?<br>
                            문제가 되거나 궁금한 사항 등을 남겨주시면 정성껏 빠르게 답변해드리겠습니다.<br>
                            해당 게시판의 성격과 다른 글은 사전 동의 없이 이동하거나 외부 광고성 글은 삭제하고 있으니 양해를 부탁드립니다.
                            <div class="box">
                                전화 문의 <strong>1234-5678</strong><br>
                                평일 오전 9시~오후6시 (점심시간 12시~1시)
                            </div>
                        </div>
                        <a class="btn btn_small btn_gray" onclick="openBoardModal('register', 'p_qna')"> 상품문의 작성하기</a>

                        <div class="board_list">
                            <p>총 <strong class="txt_green qnaCntDisplay"><?=number_format($qnaCnt)?></strong>개 </p>
                            <ul id="qnaList">
                                <!--modal/product_board_data.php-->
                            </ul>
                            <!--<ul>
                                <li data-toggle="modal" data-target="#qnaModal">
                                    <p class="p_num">2</p>
                                    <p class="p_title">빠른답변부탁드립니다.</p>
                                    <p class="p_state"><span class="icon line">접수완료</span></p>
                                    <p class="p_user">**한의원</p>
                                    <p class="p_date">2023.05.06</p>
                                </li>
                                <li data-toggle="modal" data-target="#qnaModal">
                                    <p class="p_num">1</p>
                                    <p class="p_title">제품관련 질문드립니다!</p>
                                    <p class="p_state"><span class="icon">답변완료</span></p>
                                    <p class="p_user">**한의원</p>
                                    <p class="p_date">2023.05.06</p>
                                </li>
                            </ul>-->

                            <? include_once VIEWPATH . 'component/pagination.php'; // 페이징?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<?php include_once MODAL_PATH. "product_board_modal.php" // 상품후기/상품문의 모달 ?>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<script>
    // Vue 인스턴스 생성
    document.addEventListener('DOMContentLoaded', function(){
        new Vue({
            el: '#app',
            data: {
                cut_length : 25,
                product : {
                    price : <?=$productData['prod_price']?>,
                    amount : 1
                },

                processing_index : "",
                processing : null,
                processing_idx : "",
                primary : "<?=$productData['idx']?>",
                data : {},
                datas : [],
                filter : {
                    all_search : "false",
                    page : <?=$_GET["page"] ? $_GET["page"] : 1?>,
                    limit : 10,
                    search_key : "<?=$_GET["search_key"] ? $_GET["search_key"] : ""?>",
                    search_value : "<?=$_GET["search_value"] ? $_GET["search_value"] : ""?>"
                },
                total : 0,
                checks : [],
                all_check : false,
            },
            created : function() {
                // this.getsData();
                // console.log(this.primary)
                if(this.primary) this.getData();
            },
            mounted : function() {
                this.$nextTick(() => {

                });
            },
            methods: {
                changeEvent : function () {
                    if(!isNaN(parseInt(this.processing_index))) {
                        this.processing = this.datas[this.processing_index]
                        this.processing_idx = this.processing.idx;

                    }else {
                        this.processing = null;
                        this.processing_idx = ""
                    }
                },
                amountPatten(event) {
                    const value = event.target.value;
                    // 숫자가 아닌 값 필터링
                    const numericValue = value.replace(/[^0-9]/g, '');
                    // 숫자 변환
                    const number = parseInt(numericValue, 10);
                    // 숫자가 0 이하인 경우 1로 변경
                    if (number <= 0 || isNaN(number)) {
                        this.product.amount = '1';
                    } else {
                        this.product.amount = numericValue;
                    }
                },
                changePage(page) {
                    var url = `${this.base_url}/example.php?`;

                    Object.keys(this.filter).forEach(function(key) {
                        if(key == "all_search") return;
                        if(key == "limit") return;
                        url += `key=${this.filter[key]}&`;
                    });

                    window.location.href = url;
                },
                postData : function() {
                    var method = this.data._idx ? "put" : "post";
                    var obj = JSON.parse(JSON.stringify(this.data));

                    var objs = {
                        _method : method,
                        obj : JSON.stringify(obj),
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);

                    if(res) {
                        console.log(res)
                    }
                },
                deletesData : function() {
                    var method = "deletes";

                    if(this.checks.length <= 0) {
                        alert("하나 이상 선택하셔야합니다.");
                        return false;
                    }

                    var objs = {
                        _method : method,
                        arrays : JSON.stringify(this.checks)
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);
                    if(res) {
                        alert("삭제되었습니다.");
                        window.location.reload();
                    }
                },
                getData : function() {
                    var method = "get";
                    var filter = {
                        idx : this.primary
                    }

                    var objs = {
                        _method : method,
                        filter : JSON.stringify(filter)
                    };

                    var res = this.ajax(baseUrl + "/api/product/getData2",objs);
                    if(res) {
                        console.log(res)
                        this.data = res.data[0];

                        if(this.data.categoryChild && this.data.categoryChild.name == "프로파일") this.getsData();
                    }
                },
                getsData : function() {
                    var method = "gets";
                    var filter = {
                        category_parent : 70
                    }
                    var objs = {
                        _method : method,
                        filter : JSON.stringify(filter)
                    };

                    var res = this.ajax(baseUrl + "/api/product/getData2",objs);
                    if(res) {
                        console.log(res)
                        this.datas = res.data;
                    }
                },
                ajax : function(url,objs) {
                    var form = new FormData();
                    //if(url.indexOf(".php") == -1) url = url + ".php";
                    for(var i in objs) {
                        form.append(i, objs[i]);
                    }

                    var result = null;
                    $.ajax({
                        url : url,
                        method : "post",
                        enctype : "multipart/form-data",
                        processData : false,
                        contentType : false,
                        async : false,
                        cache : false,
                        data : form,
                        dataType : "json",
                        success: function(res){
                            if(!res.success) alert(res.message);
                            else {
                                result = res;

                                if(res.data) {
                                    var obj = res.data;
                                    for(field in obj) {
                                        if(field.indexOf("_id") !== -1) continue;
                                        try {
                                            obj[field] = JSON.parse(obj[field]);
                                        } catch (e) {

                                        }
                                    }
                                    res.data = obj;
                                }
                            }
                        }
                    });

                    return result;
                }
            },
            computed : {
                totalPrice : function () {
                    if(this.data.categoryChild && this.data.categoryChild.name == '프로파일') {
                        var price = this.product.amount * (this.product.price *(this.cut_length / 1000)) + 330;
                        if(this.processing) price += parseInt(this.processing.prod_price2)
                        return price
                    }else {
                        return this.product.price * this.product.amount
                    }
                }
            },
            watch : {
                all_check : function() {
                    this.checks = [];

                    if(this.all_check) {
                        this.datas.forEach((item) => {
                            this.checks.push(item._idx);
                        });
                    }
                }
            }

        });
    }, false);

    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };
</script>

<script>
    // 구매수량 (버튼/입력)
    const changeCount = (e, value, input = false) => {
        const numberElement = document.querySelector(`[name=inputNumber]`); // 구매수량
        const price = toNumber(document.querySelector('.prodPriceDisplay').textContent); // 상품금액
        let changeCount;

        // 변경수량
        if (!input) {
            changeCount = toNumber(numberElement.value);
            changeCount += value;
        } else { // 직접입력
            changeCount = value;
        }
        if (changeCount < 1) changeCount = 1;

        numberElement.value = changeCount;
        document.querySelector('.totalPriceDisplay').innerHTML = addCommaNumber(price * changeCount);

        // formdata
        document.querySelector('[name=productCnt]').value = changeCount; // 총상품금액
        document.querySelector('[name=totalPrice]').value = price * changeCount; // 총상품금액
    }

    // 장바구니 담기
    const addCart = async (isBuy = false) => {
        // 일시품절 체크
        if (isBuy && document.querySelector('span.soldout')) {
            showAlert('임시품절 된 상품입니다.');
            return false;
        }

        const form = document.order;

        var cut_length = parseInt(form.cut_length2.value);

        if (isNaN(cut_length) || cut_length < 25 || cut_length > 6000) {
            alert('절단길이를 최소25mm ~ 최대6000mm 이내 입력해주세요.');
            return false;
        }

        const formData = new FormData(form);
        formData.append("isBuy", !isBuy ? 'Y' : 'N');


        const response = await fetchData(`/api/addCart`, formData);
        // console.log(response);

        if (response.result) {
            if (isBuy) { // 바로구매하기
                const cartIdx = toNumber(response.cartIdx);
                if (cartIdx == 0) {
                    showAlert('서버와의 통신에 실패했습니다. 다시 시도해 주세요.', () => {location.reload();});
                    return false;
                }

                // 주문서 이동
                form.querySelector('[name="cartIdx[]"]').value = cartIdx;
                form.action = baseUrl + 'orderSheet';
                form.submit();

            } else { // 장바구니등록
                const confirmResult = await showConfirm('장바구니에 추가되었습니다.<br>장바구니로 이동하시겠습니까?');
                if (confirmResult.isConfirmed !== true) return false;
                else {
                    location.href = baseUrl + 'cart';
                }
            }
        } else {
            showAlert('서버와의 통신에 실패했습니다. 다시 시도해 주세요.', () => {location.reload();});
        }
    }

    // 상품후기/상품문의 탭 선택
    const tabs = document.querySelectorAll('.nav-tabs a');
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            const tabId = this.getAttribute('aria-controls');
            // console.log('tab id:', tabId);

            let category = '';
            let dataElement = '';
            if(tabId == 'tab-review') { // 상품후기
                category = 'review';
                dataElement = document.querySelector('#reviewList');
            }
            else if(tabId == 'tab-qna') { // 상품문의
                category = 'p_qna';
                dataElement = document.querySelector('#qnaList');
            }
            document.querySelector('[name=category]').value = category;
            const productIdx = document.querySelector('[name=productIdx]').value;

            productBoardList(category, productIdx, dataElement);
        });
    });

    // 상품후기/상품문의 목록
    // category: 후기/문의 구분
    // productIdx: 상품인덱스
    // dataElement: 목록div
    const productBoardList = async (category, productIdx, dataElement) => {
        const param = `?category=${category}&productIdx=${productIdx}`;
        await fetchHtml(`/api/getProductBoardList${param}`, dataElement);

        document.querySelectorAll(".reviewCntDisplay").forEach(elem => elem.textContent = document.querySelector('[name=reviewCnt]').value);
        document.querySelectorAll(".qnaCntDisplay").forEach(elem => elem.textContent = document.querySelector('[name=qnaCnt]').value);
    }

    // 상품후기/상품문의 모달 (글 조회)
    const openBoardModal = async (mode, category, idx) => {
        const isReview = category === 'review'; // 상품후기인지
        const viewId = isReview ? '#reviewModal' : '#qnaModal'; // 상세 모달
        const isAdminAccount = document.querySelector('[name=level]').value === '10'; // 관리자인지
        document.querySelector("#boardModal #myModalLabel").textContent = isReview ? '상품후기' : '상품문의';

        // 초기화
        const exceptArr = ["ref_idx", "category"];
        clearForm('write', exceptArr);

        if(mode == 'register') {
            // 등록
            document.querySelectorAll('.addFile span').forEach(span => span.innerHTML = '파일을 선택하세요..');
            $("#boardModal").modal();
            $("#boardModal .labelMsg").text('등록');
            return;
        }

        const response = await fetchData(`/api/getProductBoardInfo/${category}/${idx}`, "", "GET");
        if (!response.data || Object.keys(response.data).length == 0) {
            showAlert(`정보를 불러오는데 실패했습니다.`);
            return false;
        }

        const data = response.data; // 게시글

        if(mode == 'view') {
            // 조회
            const boardElements = [
                { selector: '#boardTitle', key: 'title' },
                { selector: '#boardContent', key: 'content' },
                { selector: '#boardCnname', key: 'cn_name' },
                { selector: '#boardRegdate', key: 'reg_date', transform: date => date.substring(0, 10) },
            ];
            boardElements.forEach(element => {
                const value = element.transform ? element.transform(data[element.key]) : data[element.key];
                document.querySelector(`${viewId} ${element.selector}`).textContent = value;
            });

            if(!isReview) { // 상품문의
                const commentData = response.commentData; // 게시글코멘트
                let commentHtml = '';
                if(commentData.length > 0) {
                    for(let i=0; i<commentData.length; i++) {
                        commentHtml += `
                            <dl>
                                <dt>
                                    <i class="fa-light fa-arrow-turn-down-right"></i> 작성자 <strong>${commentData[i].mb_name}</strong> 답변일 <strong>${commentData[i].reg_date.substring(0, 10)}</strong>
                                     ${isAdminAccount ? `
                                        <button type="button" class="btn" onclick="modifyAnswer(this, '${commentData[i].idx}')">수정</button>
                                        <button type="button" class="btn" onclick="deleteAnswer('${commentData[i].idx}')">삭제</button>
                                    ` : ''}
                                </dt>
                                <dd class="content">${commentData[i].content}</dd>
                            </dl>
                            `
                    }
                } else {
                    commentHtml = "<dl>관리자의 답변을 기다리는 중입니다.</dl>";
                }
                document.querySelector('#answerList').innerHTML = commentHtml;
                if(isAdminAccount) {
                    document.querySelector("[name=boardIdx]").value = data.idx;
                    document.querySelector('.answer_write').classList.remove('hide');
                }
            }

            // 첨부파일
            document.querySelector(`${viewId} #boardFiles`).textContent = '';
            const files = JSON.parse(data.file_name_json);
            if (files.length > 0) {
                const downloadUri = baseUrl + `file/download?path=<?=uploadFileRemoveServerPath(UPLOAD_FOLDERS['BOARD'])?>`;
                const assetsUrl = baseUrl + `assets/uploads/cs`;
                let fileHtml = files.map(file => `<p><a href="${downloadUri}/${file.name}"><img src="${assetsUrl}/${file.name}"></a></p>`).join('');
                document.querySelector(`${viewId} #boardFiles`).insertAdjacentHTML('beforeend', `<strong><i class="fa-light fa-folder-download"></i> 첨부파일</strong>${fileHtml}`);
            }

            $(viewId).modal();

        }
        else {
            // 수정
            boardFrm.idx.value = data.idx;
            boardFrm.title.value = data.title;
            boardFrm.content.value = data.content;

            // 첨부파일
            const files = JSON.parse(data.file_name_json);
            files.forEach((file, i) => {
                const number = i + 1;
                document.querySelector(`#addFile${number} span`).innerHTML = file.orgName + ` <button type="button" onclick="deleteFile(${number})" class="btn">삭제</button>`; //`업로드 완료`;
                document.querySelector(`input[name="fileName[${number}]"]`).value = file.name;
                document.querySelector(`input[name="orgFileName[${number}]"]`).value = file.orgName; // 원본파일명 저장
            });

            $("#boardModal").modal();
            $("#boardModal .labelMsg").text('수정');
        }
    }

    // 게시글 삭제
    const deleteBoard = async (idx) => {
        const confirmResult = await showConfirm(`글을 삭제 하시겠습니까?`);
        if (confirmResult.isConfirmed !== true) return false;

        await commonActionRegister('/api/deleteBoard', {idx}, '삭제');
    }

    // 답변 등록/수정
    const registerAnswer = async () => {
        const answerElement = document.querySelector('textarea[name=answer]');
        const answer = answerElement.value;
        if (answer.length == 0) {
            return showAlert('답변을 입력해 주세요.', () => {
                answerElement.focus();
            });
        }
        const boardIdx = document.querySelector('[name=boardIdx]').value;
        const commentIdx = document.querySelector('[name=commentIdx]').value;

        const gubun = (commentIdx == '')? '등록' : '수정';
        const confirmResult = await showConfirm(`답변을 ${gubun}하시겠습니까?`);
        if (confirmResult.isConfirmed !== true) return false;

        await commonBoardModalRegister('/api/registerComment', {answer, boardIdx, commentIdx}, gubun);
    }

    // 답변수정 textarea bind
    const modifyAnswer = (elem, idx) => {
        const parent = elem.closest('dl');
        const originAnswer = parent.querySelector('.content').innerText;

        document.querySelector('[name=commentIdx]').value = idx;
        document.querySelector('[name=answer]').value = originAnswer;
        document.querySelector('[name=answer]').focus();
    }

    // 답변 삭제
    const deleteAnswer = async (idx) => {
        const confirmResult = await showConfirm(`선택하신 답변을 삭제하시겠습니까?`);
        if (confirmResult.isConfirmed !== true) return false;

        await commonBoardModalRegister('/api/deleteComment', {idx}, '삭제');
    }

    // 모달에서 등록 시 새로고침하지 않고 데이터 초기화
    const commonBoardModalRegister = async (fetchURL, formData, gubun, category = 'review') => {
        const response = await fetchData(`${fetchURL}`, formData);
        // console.log(response);
        if (response.result) {
            showAlert(`${gubun} 완료되었습니다.`, () => {
                const category = boardFrm.category.value;
                const modalId = category === 'review' ? '#reviewModal' : '#qnaModal';
                const listElement = category === 'review' ? '#reviewList' : '#qnaList';

                $(modalId).modal('hide');
                productBoardList(category, document.querySelector('[name=productIdx]').value, document.querySelector(listElement));
            });
        } else {
            let message = response.message ? response.message : `${gubun}에 실패했습니다.`;
            showAlert(message);
        }
    }
</script>

<!-- 게시판등록/수정 JS -->
<script src="<?=ASSETS_URL?>/js/mall/board_form.js?v=<?=JS_VER?>"></script>