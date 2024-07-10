<!--제품소개 목록-->
<div id="drugs_list">
    <div class="area_top">
        <div class="location">
            <i class="fa-light fa-house-blank"></i> 홈 <i class="fa-light fa-angle-right"></i> 제품소개 <i class="fa-light fa-angle-right"></i> <strong><?=$category_parent->name?></strong>
        </div>
        <h2><?=$category_parent->name?></h2><!--1차메뉴-->

        <div class="lnb"><!--2차메뉴-->
            <ul>
                <li><a href="<?=PROJECT_URL?>/medicinal?category=<?=$category_parent->idx?>" <?=$category_parent->idx == $_GET['category'] ? 'class="active"' : ""?>>전체(<?=$category_parent->productCount?>)</a></li>
                <?php foreach ($category_parent->childs as $child) {?>
                <li><a href="<?=PROJECT_URL?>/medicinal?category=<?=$child->idx?>" <?=$child->idx == $_GET['category'] ? 'class="active"' : ""?>> <?=$child->name;?>(<?=$child->productCount?>)</a></li>
                <?php }?>
            </ul>
        </div>
    </div>

    <div id="main_list">
        <div class="top_list flex js">
            <p class="total">총 <strong class="txt_green"><?=number_format($paging['totalCount'])?></strong>개의 상품이 등록되었습니다.</p>
            <div class="sort">
                <ul>
                    <li><a class="date <?=empty($_GET['order']) ? 'active' : ''?>" href="./medicinal?order=date&category=<?=$_GET['category']?>">등록순</a></li>
                    <li><a class="name" href="./medicinal?order=name&category=<?=$_GET['category']?>">상품명순</a></li>
                    <li><a class="rowPrice" href="./medicinal?order=rowPrice&category=<?=$_GET['category']?>">낮은가격순</a></li>
                    <li><a class="exPrice" href="./medicinal?order=exPrice&category=<?=$_GET['category']?>">높은가격순</a></li>
                </ul>
            </div>
        </div>
        <div class="drugs_list">
            <ul>
                <?php
                foreach($listData as $list) {
                    $thumbNail = getProductThumbnail($list['file_name_list']); // 썸네일
                ?>
                <li onclick="location.href='<?=PROJECT_URL?>/medicinal/<?=$list['idx']?>'">
                    <!--
                    <input type="checkbox" name="checkIdx" id="checkIdx<?=$list['idx']?>" value="<?=$list['idx']?>">
                    -->
                    <label for="checkIdx<?=$list['idx']?>">
                        <div class="area_img">
                            <img src="<?=ASSETS_URL?>/<?=$thumbNail?>">
                            <? if ($list['soldout_yn'] == 'Y') { ?>
                            <span class="ic_sold_out">
                                <strong>임시 품절</strong>
                            </span>
                            <? } ?>
                        </div>
                    </label>
                    <div class="area_text" >
                        <div>
<!--                            <span><?=$list['prod_origin']?></span>-->
                            <p class="p_name"><?=$list['prod_name']?></p>
                        </div>
                        <p class="p_price">
                        


                            <!--시중가격-->
                            <?php if($list['prod_price2']){ ?>
                                <u class=""><?=number_format($list['prod_price2'])?>원</u>
                            <?php } ?>
                            
<!--                            할인가격-->
                           <strong><?=number_format($list['prod_price'])?>원</strong>
                           </p>
                    </div>
                </li>
                <?
                }
                if ($paging['totalCount'] == 0) { ?>
                <li class="noDataAlign" style="width: 100%; text-align: center;">등록된 상품이 없습니다.</li>
                <?php } ?>
            </ul>
        </div>

		<? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>

    </div>

    <!--장바구니-->
    <div class="fixed" style="display: none">
        <div class="drugs_cart">
            <div class="cart_list">
                <details open>
                    <summary><h5>선택한 제품소개</h5></summary>
                    <div class="details">
                        <ul class="scrollbar liProducts">
                            <!--선택 상품 목록-->
                        </ul>
                    </div>
                </details>
            </div>
            <div class="total">
                <div class="total_price">
                    <p class="text">총 결제금액</p>
                    <p class="price txt_green"><span class="totalPriceDisplay">0</span>원</p>
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
    <!--//장바구니-->
</div>

<form name="order" autocomplete="off" method="post">
    <input type="hidden" name="productIdx" value="" /> <!--상품인덱스-->
    <input type="hidden" name="productCnt" value="" /> <!--구매수량-->
    <input type="hidden" name="totalPrice" value="" /> <!--총상품금액-->
</form>

<script>
    const searchFrm = document.searchFrm; // 검색 폼

    $(function() {
        // 목록 정렬
        const orderElements = document.querySelectorAll('.sort ul li a');
        orderElements.forEach((elem) => {
            elem.addEventListener('click', async () => {
                searchFilter("order", elem.classList[0]);
            });
        });
        if('<?=$_GET['order']?>' != '') {
            orderElements.forEach((elem) => {
                elem.classList.remove('active');
                if(elem.classList.contains('<?=$_GET['order']?>')) elem.classList.add('active');
            });
        }

        // 초성 검색
        const initialRadios = document.querySelectorAll('input[name="initial"]');
        initialRadios.forEach(radio => {
            radio.addEventListener('click', async (e) => {
                searchFilter("initial", e.target.value);
            });
        });
        if('<?=$_GET['initial']?>' != '') {
            searchFrm.initial.value = '<?=$_GET['initial']?>';
        }
    });

    // 검색 필터
    const searchFilter = (filter, value) => {
        searchFrm[filter].value = value;
        searchFrm.submit();
    }

    // 상품 선택 시
    const checkboxes = document.querySelectorAll('input[name="checkIdx"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('click', async () => {
            // 일시품절 체크
            if (checkbox.parentElement.querySelector('.soldout')) {
                return showAlert('임시품절 된 상품입니다.', () => { checkbox.checked = false; });
            }

            const idxArr = [];
            checkboxes.forEach((checkbox) => {
                if(checkbox.checked) idxArr.push(checkbox.value);
            });
            document.querySelector('[name=productIdx]').value = idxArr; // formdata 상품인덱스

            console.log(idxArr);
            // 상품 정보
            const response = await fetchData(`/api/getProductInfo/${checkbox.value}`, '', 'GET');

            // 선택 해제 시 선택한 제품소개 목록에서 삭제
            if(document.querySelector(`.liProducts #li${response.idx}`) && !checkbox.checked) {
                document.querySelector(`.liProducts #li${response.idx}`).remove();
                calcTotalPrice();
                return false;
            }

            const html = `
                <li id="li${response.idx}">
                    <p class="p_name">${response.prod_name}</p>
                    <p class="p_price">${addCommaNumber(response.prod_price)}원</p>
                    <div class="number_controller">
                        <button type="button" onclick="changeCount(this, -1)"><i class="fa-regular fa-minus"></i></button>
                        <input type="number" name="inputNumber" value="1" onkeyup="this.value=numberChk(this.value);changeCount(this, this.value, true)"/>
                        <button type="button" onclick="changeCount(this, 1)"><i class="fa-regular fa-plus"></i></button>
                    </div>
                    <p class="p_price2"><span class="prodPriceDisplay">${addCommaNumber(response.prod_price)}</span>원</p>
                    <a><i class="fa-light fa-close" onclick="delProduct(${response.idx})"></i></a>
                </li>
            `;
            document.querySelector('.liProducts').innerHTML += html;

            calcTotalPrice();
        });
    });

    // 선택한 제품소개 삭제
    const delProduct = (idx) => {
        document.querySelector(`#checkIdx${idx}`).checked = false;
        document.querySelector(`.liProducts #li${idx}`).remove();

        calcTotalPrice();
    }
    
    // 구매수량 (버튼/입력)
    const changeCount = (e, value, input = false) => {
        const parent = e.closest('li');
        const numberElement = parent.querySelector(`[name=inputNumber]`); // 구매수량
        const price = toNumber(parent.querySelector(`.p_price`).textContent); // 상품금액

        // 변경수량
        let changeCount = !input ? toNumber(numberElement.value) + value : value;
        changeCount = Math.max(changeCount, 1);

        numberElement.value = changeCount;
        parent.querySelector(`.prodPriceDisplay`).innerHTML = addCommaNumber(price * changeCount);

        calcTotalPrice();
    }

    // 총금액 계산
    const calcTotalPrice = () => {
        const list = document.querySelectorAll('.liProducts li');
        let productPrice = 0;

        const cntArr = [];
        if (list.length >= 1) {
            list.forEach(row => {
                const priceStr = row.querySelector('.prodPriceDisplay').innerText;
                const price = toNumber(priceStr);
                productPrice += price;

                cntArr.push(row.querySelector('[name=inputNumber]').value);
            });
        }

        document.querySelector('.totalPriceDisplay').innerHTML = addCommaNumber(productPrice); // 총 결제금액
        document.querySelector('[name=productCnt]').value = cntArr; // formdata 구매수량
    }

    // 장바구니 담기
    const addCart = async (isBuy = false) => {
        const list = document.querySelectorAll('.liProducts li');
        if (list.length == 0) return showAlert('상품을 선택해 주세요.');

        const form = document.order;
        const formData = new FormData(form);
        formData.append("isBuy", !isBuy ? 'Y' : 'N');

        const response = await fetchData(`/api/addCart`, formData);
        console.log(response);

        if (response.result) {
            if (isBuy) { // 바로구매하기
                const cartIdxArr = response.cartIdx; //.split(',');
                if (cartIdxArr.length == 0) {
                    showAlert('서버와의 통신에 실패했습니다. 다시 시도해 주세요.', () => {location.reload();});
                    return false;
                }

                for (let i = 0; i < cartIdxArr.length; i++) {
                    let cartIdx = cartIdxArr[i];
                    let html = `<input type="hidden" name="cartIdx[]" value="${cartIdx}" />`;
                    form.insertAdjacentHTML('beforeend', html);
                }
                // 주문서 이동
                form.action = baseUrl + 'orderSheet';
                form.submit();

            } else { // 장바구니등록
                const confirmResult = await showConfirm('장바구니에 추가되었습니다.<br>장바구니로 이동하시겠습니까?');
                if (confirmResult.isConfirmed !== true) return false;
                else {
                    location.href = baseUrl + 'cart';
                }
            }

            document.querySelectorAll('input[name="checkIdx"]').forEach((checkbox) => { checkbox.checked = false; });
        } else {
            showAlert('서버와의 통신에 실패했습니다. 다시 시도해 주세요.', () => {location.reload();});
        }
    }
</script>
