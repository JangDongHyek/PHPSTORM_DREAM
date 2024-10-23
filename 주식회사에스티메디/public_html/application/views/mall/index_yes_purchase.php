<style>
        * {
            scroll-behavior: smooth;
        }
    </style>

    <div class="contsTitle member animate__animated animate__fadeInUp" id="contsTitle">
        <h2>에스티메디에서 간편하게 비교견적 확인하시고</h2>
        <h1>회원가로 저렴하게 구매하세요!</h1>
        <h3><i class="fa-duotone fa-angles-down"></i></h3>
    </div>
    <div class="contsArea member">
        <dl class="animate__animated animate__fadeInUp">
            <p class="icon animate__animated animate__flip animate__delay-1s">
                <i class="fa-regular fa-hand-pointer"></i></p>
            <div>
                <dt>쉽고 빠른 견적비교</dt>
                <dd><strong class="txtRed">클릭 한번으로 편리하게</strong>비교견적 확인하세요!</dd>
            </div>
        </dl>
        <dl class="animate__animated animate__fadeInUp">
            <p class="icon animate__animated animate__flip animate__delay-2s">
                <i class="fa-regular fa-money-from-bracket"></i></p>
            <div>
                <dt>의약품 저가구매</dt>
                <dd>에스티메디에서 의약품을<strong class="txtRed">저렴하게 구매해보세요!</strong></dd>
            </div>
        </dl>
        <dl class="animate__animated animate__fadeInUp">
            <p class="icon animate__animated animate__flip animate__delay-3s">
                <i class="fa-regular fa-bell-concierge"></i></p>
            <div>
                <dt>확실한 서비스</dt>
                <dd><strong class="txtRed">간편하고 저렴한 서비스</strong>에스티메디를 이용해보세요!</dd>
            </div>
        </dl>
    </div>

    <div class="contsLink flex">
        <button class="btn btn_large" onclick="location.href='/medicinal#simple'"><i
                    class="fa-solid fa-cart-flatbed-boxes"></i> 의약품 최저가 구매
        </button>
        <button class="btn btn_large" onclick="location.href='/medicinal'"><i class="fa-solid fa-bags-shopping"></i>
            최근구매
        </button>
        <button class="btn btn_large" id="btnList" onclick="location.href='#first02'"><i
                    class="fa-solid fa-bring-forward"></i> 에스티메디 의약품 최저가 견적
        </button>
    </div>
    <script>

        let c2 = document.querySelector('#btnList');

        c2.addEventListener('click', function () {
            const div = document.querySelector('#first02');
            const fix = document.querySelector('#fixed');
            if (div.classList.contains('off')) {
                div.classList.remove('off');
                fix.style.display = "block"
            } else {
                div.classList.add('off');
                fix.style.display = "none"
            }
        });


    </script>

    <section id="first02" class="member off">
        <div class="inr">
            <img src="<?= ASSETS_URL ?>/img/main/clip.png" class="clip">
            <div class="info">
                <h6><strong>에스티메디</strong>&nbsp;Special Order</h6>
            </div>
            <div class="flex js info">
                <p><strong>에스티메디</strong>&nbsp;<em>For First Customer</em></p>
                <span>
					<p>Order Date : <?php echo date('Y/m/d ', time()); ?></p>
					<p>&nbsp;| &nbsp; Order Number : <?php echo date('Ymd', time()); ?>00301</p>
				</span>
            </div>
			<div class="box_red">
				<p>
					<i class="fa-solid fa-triangle-exclamation"></i> 제품이 검색되지 않을 시, 성분명으로 검색해보세요.
				</p>
			</div>

			<section class="main_list">
                <div class="">
                    <form name="searchFrm" autocomplete="off" method="get">
                        <input type="hidden" name="order" value="<?= $_GET['order'] ?>">
                        <div class="sch_initial">
                            <h5>의약품 검색</h5>
                            <div class="box_in">
                                <input type="radio" id="select1" name="initial" value=""
                                       class="red" <?= empty($_GET['initial']) ? 'checked' : '' ?>/><label
                                        for="select1">전체</label>
                                <input type="radio" id="select2" name="initial" value="ㄱ" class="red"/><label
                                        for="select2">ㄱ</label>
                                <input type="radio" id="select3" name="initial" value="ㄴ" class="red"/><label
                                        for="select3">ㄴ</label>
                                <input type="radio" id="select4" name="initial" value="ㄷ" class="red"/><label
                                        for="select4">ㄷ</label>
                                <input type="radio" id="select5" name="initial" value="ㄹ" class="red"/><label
                                        for="select5">ㄹ</label>
                                <input type="radio" id="select6" name="initial" value="ㅁ" class="red"/><label
                                        for="select6">ㅁ</label>
                                <input type="radio" id="select7" name="initial" value="ㅂ" class="red"/><label
                                        for="select7">ㅂ</label>
                                <input type="radio" id="select8" name="initial" value="ㅅ" class="red"/><label
                                        for="select8">ㅅ</label>
                                <input type="radio" id="select9" name="initial" value="ㅇ" class="red"/><label
                                        for="select9">ㅇ</label>
                                <input type="radio" id="select10" name="initial" value="ㅈ" class="red"/><label
                                        for="select10">ㅈ</label>
                                <input type="radio" id="select11" name="initial" value="ㅊ" class="red"/><label
                                        for="select11">ㅊ</label>
                                <input type="radio" id="select12" name="initial" value="ㅋ" class="red"/><label
                                        for="select12">ㅋ</label>
                                <input type="radio" id="select13" name="initial" value="ㅌ" class="red"/><label
                                        for="select13">ㅌ</label>
                                <input type="radio" id="select14" name="initial" value="ㅍ" class="red"/><label
                                        for="select14">ㅍ</label>
                                <input type="radio" id="select15" name="initial" value="ㅎ" class="red"/><label
                                        for="select15">ㅎ</label>
                            </div>
                        </div>
                    </form>

                    <div class="search">
                        <input type="search" name="hstx" id="drugs_hstx" placeholder="원하시는 제품을 검색하세요"
                               value="<?= $_GET['hstx'] ?>"
                               onkeyup="if(window.event.keyCode==13){callContent(1,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')}"/>
                        <button type="button" class="btn"
                                onclick="callContent(1,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')"><i
                                    class="fa-regular fa-magnifying-glass"></i></button>
                    </div>

                    <div class="drugs_list" style="background: #fff;">
                        <h5>검색 결과
                            <button type="button" class="btn" id="listOpen">접기</button>
                        </h5>
                        <ul id="drugs_list">
                            <div id="drungChecked" style="display: none">
                                <p>의약품 재선택은 <br><br>
                                    <button class="btn btn_mini btn_line">재견적</button>
                                    버튼을 눌러주세요.
                                </p>
                            </div>
                            <?php
                            foreach ($listData as $list) {
                                $shipFreeYn = $list['shipping_free_yn'] == "Y"; // 배송무료?
                                $useYn = $list['use_yn'] == "Y"; // 사용중?

                                $idx = $list['idx'];
                                $thumbNail = ASSETS_URL . '/' . getProductThumbnail($list['file_name_list']); // 썸네일

                                $CONS_CD_CountSql = "SELECT COUNT(*) AS cnt from bs_product where CONS_CD = '{$list['CONS_CD']}'";
                                $CONS_CD_CountRow = $this->db->query($CONS_CD_CountSql)->row();
                                $CONS_CD_Count = ($CONS_CD_CountRow && $CONS_CD_CountRow->cnt) ? $CONS_CD_CountRow->cnt : 0; // 전체 수

                                //보험가 적용하는 회원들 따로 가격
                                if ($member['INSU_CHECK'] == 'Y') {
                                    $list['prod_price'] = $list['INSU_PRICE'];
                                }

                                if((int)$list['prod_price'] == 0 ){
                                    $list['prod_price'] = '제품문의';
                                }else{
                                    $list['prod_price'] = number_format(removeComma($list['prod_price']));
                                    $list['prod_price'] .= '원';
                                }

                                ?>
                                <li>
                                    <div class="flex">
                                        <input type="checkbox" name="checkIdx" id="checkIdx<?= $list['idx'] ?>"
                                               value="<?= $list['idx'] ?>" class="<?= $list['idx'] ?>"
                                               onclick="checkboxes_func2(this)">
                                        <label for="checkIdx<?= $list['idx'] ?>">
                                            <div>
                                                <p class="p_name">
                                                    <? if ($list['soldout_yn'] == 'Y') { ?>
                                                        <span class="icon bl soldout">
														<strong>임시품절</strong>
													</span>
                                                    <? } ?>
                                                    <?= $list['PRODUCT_NM'] ?>
                                                </p>
                                                <span>제조사 <strong><?= $list['MAKER_NM'] ?></strong> |</span>
                                                <span>단위 <strong><?= $list['PRODUCT_STANDARD'] ?></strong> |</span><br class="visible-xs">
												<span>성분명 <strong><?= $list['CONS_CD_NM'] ?></strong> |</span>
                                                <span style="display: none">재고수량  <strong><?= number_format($list['STOCK_QTY']) ?></strong></span>
                                            </div>
                                            <!--div class="area_img">
												<img src="<?= ASSETS_URL ?>/<?= $thumbNail ?>" onerror="this.src='<?= ASSETS_URL ?>/img/common/mediimg.jpg';"/>
											</div-->
                                            <div class="text-right" style="display: ">
                                                <p class="p_price_2">
                                                    <em>원가</em><?= number_format($list['UNIT_PRICE']) ?>원</p>
                                                <p class="p_price"><?= ($list['prod_price']) ?></p>
                                            </div>

                                            <?php if ($member['INSU_CHECK'] == 'Y' && $list['INSU_PRICE'] == 0) { ?>
                                                <p>제품문의</p>
                                            <?php } ?>
                                            <?php if ($member['INSU_CHECK'] <> 'Y' && $list['prod_price'] == 0) { ?>
                                                <p>제품문의</p>
                                            <?php } ?>
                                        </label>
                                    </div>
                                    <?php if ($CONS_CD_Count) { ?>
                                        <div class="more" data-toggle="modal" data-target="#moreModal1"
                                             onclick="callContent_cons(1,'<?= $list['CONS_CD'] ?>','<?= $list['PRODUCT_NM'] ?>','<?= number_format($list['prod_price']) ?>')">
                                            <i class="fa-regular fa-arrow-turn-down-right"></i>
                                            <span><b>대체약</b> (<?= $CONS_CD_Count ?>)</span>
                                        </div>
                                    <?php } ?>
                                </li>
                                <?
                            }
                            if ($paging['totalCount'] == 0) { ?>
                                <li class="noDataAlign" style="width: 100%; text-align: center;">등록된 상품이 없습니다.</li>
                            <?php } ?>
                        </ul id="drugs_list_end">
                    </div>
                    <div class="paging">
                        <div class="pagingWrap" id="drugs_paging">
                            <!--처음-->
                            <?php if ($paging['page'] > 1 && $paging['totalPage'] > 0) { ?>
                                <a class="first disabled"
                                   onclick="callContent(1,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')"><i
                                            class="fa-light fa-chevrons-left"></i></a>
                            <?php } ?>

                            <!--이전-->
                            <?php if ($paging['currentBlock'] > 1) { ?>
                                <a class="prev disabled"
                                   onclick="callContent(<?= $paging['startPage'] - 1 ?>,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')"><i
                                            class="fa-light fa-chevron-left"></i></a>
                            <?php } ?>

                            <!--페이지-->
                            <?php
                            if ($paging['totalPage'] != 0) {
                                foreach (range(1, $paging['totalPage']) as $number) {
                                    if ($number >= $paging['startPage'] && $number <= $paging['endPage']) {
                                        $action = "?page=" . $number . "&" . $qstr;
                                        if ($paging['page'] == $number) $action = "javascript:void(0)";
                                        ?>
                                        <a class="<?= ($paging['page'] == $number) ? 'active' : '' ?>"
                                           onclick="callContent(<?= $number ?>,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')"><?= $number ?></a>
                                    <?php }
                                }
                            } ?>

                            <!--다음-->
                            <?php if ($paging['totalBlock'] > 1 && $paging['totalBlock'] != $paging['currentBlock']) { ?>
                                <a class="next disabled"
                                   onclick="callContent(<?= $paging['endPage'] + 1 ?>,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')"><i
                                            class="fa-light fa-chevron-right"></i></a>
                            <?php } ?>

                            <!--마지막-->
                            <?php if ($paging['page'] < $paging['totalPage']) { ?>
                                <a class="last disabled"
                                   onclick="callContent(<?= $paging['totalPage'] + 1 ?>,$('#drugs_hstx').val(),'<?= $_GET['initial'] ?>')"><i
                                            class="fa-light fa-chevrons-right"></i></a>
                            <?php } ?>
                        </div id="drugs_paging_end">
                    </div>
                    <br>
                </div>
            </section>
            <!--button type="button" class="btn btn_blue btn_large" onclick="location.href='./result'"><i class="fa-solid fa-cart-shopping"></i> 비교견적 확인하기</button-->
        </div>
    </section>

    <!-- 동일성분약품 Modal -->
    <div class="modal fade more_modal" id="moreModal1" tabindex="-1" aria-labelledby="moreModal1Label"
         aria-hidden="true">
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
                                <p class="p_name">레바미피드 100mg</p>
                            </div>
                            <div class="area_text">
                                <p class="p_price">40,000원</p>
                            </div>
                        </div>
                    </div>
                    <div class="search">
                        <input type="search" name="hstx" id="" placeholder="원하시는 제품을 검색하세요" value=""/>
                        <button type="button" class="btn" onclick=""><i class="fa-regular fa-magnifying-glass"></i>
                        </button>
                    </div>

                    <p class="txt_bold txt_blue">대체약</p>
                    <ul class="drugs_list">
                        <li>
                            <div class="flex">
                                <input type="checkbox" name="" id="more1" value="5">
                                <label for="more1">
                                    <div>
                                        <p class="p_name">레바미피드 100mg</p>
                                        <span>제조사 <strong>구매문의</strong> |</span>
                                        <span>단위 <strong>500T</strong> |</span>
                                        <span>대체약  <strong>무코스타</strong></span>
                                    </div>
                                    <div class="area_text">
                                        <p class="p_price">40,000원</p>
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
                            <a class="last disabled" href="?page=101&amp;"><i
                                        class="fa-light fa-chevrons-right"></i></a>
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

    <!--장바구니-->
    <div class="fixed main" id="fixed" style="opacity: 0; display: none">
        <div class="drugs_cart">
            <div class="cart_list">
                <details open>
                    <summary><h5>선택 목록</h5></summary>
                    <div class="details">
                        <ul class="scrollbar" id="liProducts_no">
                            <!--선택 상품 목록-->
                            <li><p style="padding: 5% 0; text-align: center">
                                    <i class="fa-duotone fa-kit-medical"></i><br>의약품을 선택해주세요.
                                </p>
                            </li>
                        </ul>
                        <ul class="liProducts">

                        </ul>
                    </div>
                </details>
            </div>
            <div class="total">
                <div class="total_price" id="totalPrice" style="display: ">
                    <div>
                        <p class="text">총 원가</p>

                        <p class="price txt_orange">
                            <span class="totalPriceDisplay2">0</span>원
                        </p>
                    </div>
                    <div>
                        <p class="text">총 결제금액</p>

                        <p class="price txt_blue">
                            <span class="totalPriceDisplay">0</span>원
                        </p>
                    </div>
                </div>
                <div class="btn_wrap">
                    <? /*<a class="btn btn_middle btn_blueline" onclick="addCart()">장바구니 담기</a>
					<a class="btn btn_middle btn_blue" onclick="addCart(true)">바로 주문</a>
                    <a class="btn btn_large btn_ani" id="loadingBtn" onclick="loadingClick()">의약품 견적 비교</a> */ ?>
					<a class="btn btn_large btn_ani" id="loadingBtn" onclick="location.href='./medicinal/'">의약품 구매하기</a>
                    <a class="btn btn_large btn_line" id="" onclick="removeCart()">닫기</a>
                    <a class="btn btn_large btn_line" id="resultBtn1" style="display: none"
                       onclick="loadingClick_reset()">재견적</a>
                    <?php if ($member) { ?>
                        <a class="btn btn_large btn_ani" id="resultBtn2" style="display: none" onclick="addCart(true)">바로
                            주문</a>
                    <?php } else { ?>
                        <a class="btn btn_large btn_ani" id="resultBtn2" style="display: none"
                           onclick="location.href='./signUp'">회원가입 후 구매하기</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--//장바구니-->

    <form name="order" autocomplete="off" method="post">
        <input type="hidden" name="productIdx" value=""/> <!--상품인덱스-->
        <input type="hidden" name="productCnt" value=""/> <!--구매수량-->
        <input type="hidden" name="totalPrice" value=""/> <!--총상품금액-->
        <input type="hidden" name="totalPrice2" value=""/> <!--총 원가 상품금액-->
    </form>

    <script>
        function loadingClick() {
            const div = document.getElementById('loading');
            const div2 = document.getElementById('totalPrice');
            const div3 = document.getElementById('drungChecked');
            const btn1 = document.getElementById('loadingBtn');
            const btn3 = document.getElementById('resultBtn1');
            const btn4 = document.getElementById('resultBtn2');

            if (div.style.display === 'none') {
                div.style.display = 'block';
            }
            setTimeout(function () {
                btn1.style.display = 'none';
                btn3.style.display = 'block';
                btn4.style.display = 'block';
                div.style.display = 'none';
                div2.style.display = 'flex';
                div3.style.display = 'flex';
                $('.fixedPrice').css({'display': 'flex'});
                $('.noControl').css({'marginLeft': '0px'});
                $('.drugs_list').css({'pointer-events': 'none'});
            }, 3000);
        }
        function loadingClick_reset() {
            const div = document.getElementById('loading');
            const div2 = document.getElementById('totalPrice');
            const div3 = document.getElementById('drungChecked');
            const btn1 = document.getElementById('loadingBtn');
            const btn3 = document.getElementById('resultBtn1');
            const btn4 = document.getElementById('resultBtn2');

            if (div.style.display === 'block') {
                div.style.display = 'none';
            }
            btn1.style.display = 'block';
            btn3.style.display = 'none';
            btn4.style.display = 'none';
            div.style.display = 'none';
            div2.style.display = 'none';
            div3.style.display = 'none';
            $('.fixedPrice').css({'display': 'none'});
            $('.noControl').css({'marginLeft': '0px'});
            $('.drugs_list').css({'pointer-events': 'auto'});

        }
    </script>
    <script>
        const searchFrm = document.searchFrm; // 검색 폼
        var page = <?=$paging['page']?>; // 페이지
        var hstx = '<?=$_GET['hstx']?>'; // 검색어
        var initial = '<?=$_GET['initial']?>'; // 초성

        $(function () {
            // 목록 정렬
            const orderElements = document.querySelectorAll('.sort li a');
            orderElements.forEach((elem) => {
                elem.addEventListener('click', async () => {
                    searchFilter("order", elem.classList[0]);
                });
            });
            if ('<?=$_GET['order']?>' != '') {
                orderElements.forEach((elem) => {
                    elem.classList.remove('active');
                    if (elem.classList.contains('<?=$_GET['order']?>')) elem.classList.add('active');
                });
            }

            // 초성 검색
            const initialRadios = document.querySelectorAll('input[name="initial"]');
            initialRadios.forEach(radio => {
                radio.addEventListener('click', async (e) => {

                    if (e.target.value) {
                        callContent(1, 0, e.target.value);
                    } else {
                        //전체 선택하면 검색어 풀리게
                        $('#drugs_hstx').val('');
                        callContent(1, 0, e.target.value);
                    }

                    //searchFilter("initial", e.target.value);
                });
            });
            if ('<?=$_GET['initial']?>' != '') {
                searchFrm.initial.value = '<?=$_GET['initial']?>';
            }
        });

        // 검색 필터
        const searchFilter = (filter, value) => {
            searchFrm[filter].value = value;
            searchFrm.submit();
        }

        // 상품 선택 시
        var idxArr = [];
        var idxDelArr = [];

        $( document ).ready(function() {
            $("input:checkbox[name='checkIdx']").prop("checked", false)
        });

        async function checkboxes_func2(checkbox) {
            // 일시품절 체크
            if (checkbox.parentElement.querySelector('.soldout')) {
                return showAlert('임시품절 된 상품입니다.', () => {
                    checkbox.checked = false;
                });
            }

            let fix = document.getElementById('fixed')
            fix.style.display = "block";

            //console.log(checkbox);
            // 상품 정보
            const response = await fetchData(`/api/getProductInfo/${checkbox.value}`, '', 'GET');

            if(response.result == false){
                idxArr = idxArr.filter((element) => element !== response.idx);
                $("." + checkbox.value + "").prop("checked", false); // class로 체크다해주기
                showAlert('상품 오류');
                return false;
            }

            if ($.inArray(checkbox.value, idxArr) != -1 && checkbox.checked) {
                //배열에 해당값 있음
                changeCount(checkbox.value, 1);
                return false;
            } else if ($.inArray(checkbox.value, idxArr) == -1 && checkbox.checked) {
                //배열에 해당값없음
                idxArr.push(checkbox.value);

            } else {
                // 체크해제시
                document.querySelector(`.liProducts .li${response.idx}`).remove();
                $("." + response.idx + "").prop("checked", false); // class로 체크다해주기
                idxArr = idxArr.filter((element) => element !== response.idx);
                calcTotalPrice();

                return false;
            }

            //240726 1T,1C,1정 삭제하는부분
            var PRODUCT_STANDARD = response.PRODUCT_STANDARD;
            if(PRODUCT_STANDARD.charAt(0) == 1 && PRODUCT_STANDARD.length == 2){
                idxDelArr.push(checkbox.value);
            }

            //보험가 적용하는 회원들 따로 가격
            <?php if ($member['INSU_CHECK'] == 'Y') { ?>
                //회원가인사람들 0원이면 제품문의띄워주고 idx빼줌
                if(Math.floor(response.INSU_PRICE) == 0){
                    idxArr = idxArr.filter((element) => element !== response.idx);
                    $("." + checkbox.value + "").prop("checked", false); // class로 체크다해주기
                    showAlert('해당 제품은 문의 바랍니다.');
                    return false;
                }else{

                }
            <?php }else{ ?>
                //회원가인사람들 0원이면 제품문의띄워주고 idx빼줌
                if(Math.floor(response.prod_price) == 0){
                    idxArr = idxArr.filter((element) => element !== response.idx);
                    $("." + checkbox.value + "").prop("checked", false); // class로 체크다해주기
                    showAlert('해당 제품은 문의 바랍니다.');
                    return false;
                }else{

                }
            <?php } ?>

            if (checkbox.checked) {
                $("." + checkbox.value + "").prop("checked", true); // class로 체크다해주기
            } else {
                $("." + checkbox.value + "").prop("checked", false); // class로 체크다해주기
            }

            document.querySelector('[name=productIdx]').value = idxArr; // formdata 상품인덱스

            //console.log(idxArr);

            var html = `
					<li id="li${response.idx}" class="li${response.idx}">
						<p class="p_name">${response.PRODUCT_NM}</p>
						<p class="p_unit">${response.PRODUCT_STANDARD} | ${response.PRODUCT_UNIT}</p>
						<p class="p_price_2">${addCommaNumber(Math.floor(removeComma(response.UNIT_PRICE)))}원</p>
                        `;

            //보험가 적용하는 회원들 따로 가격
            <?php if ($member['INSU_CHECK'] == 'Y') { ?>
            html += `<p class="p_price" style="margin-left: auto">${addCommaNumber(Math.floor(removeComma(response.INSU_PRICE)))}원</p>`
            <?php }else{ ?>
             html += `<p class="p_price" style="margin-left: auto">${addCommaNumber(Math.floor(removeComma(response.prod_price)))}원</p>`
            <?php } ?>

            html += `<div class="number_controller noControl" >
                        <button type="button" onclick="changeCount(${response.idx}, -1)"><i class="fa-regular fa-minus"></i></button>
                    <input type="number" name="inputNumber" value="1" onkeyup="this.value=numberChk(this.value);changeCount(${response.idx}, this.value, true)" id="inputNumber${response.idx}"/>
                        <button type="button" onclick="changeCount(${response.idx}, 1)" id="Count_add${response.idx}"><i class="fa-regular fa-plus"></i></button>
                    </div>
                    <div class="price fixedPrice" style="display: ">
                        <p class="p_price2 ori"><em>원가</em><span class="prodPriceDisplay2">${addCommaNumber(Math.floor(removeComma(response.UNIT_PRICE)))}</span>원</p>
                        `;

            //보험가 적용하는 회원들 따로 가격
            <?php if ($member['INSU_CHECK'] == 'Y') { ?>
            html += `<p class="p_price2 now"><span class="prodPriceDisplay">${addCommaNumber(Math.floor(removeComma(response.INSU_PRICE)))}</span>원</p>`;
            <?php }else{ ?>
            html += `<p class="p_price2 now"><span class="prodPriceDisplay">${addCommaNumber(Math.floor(removeComma(response.prod_price)))}</span>원</p>`;
            <?php } ?>

            html += `
                    </div>
                    <a><i class="fa-light fa-close" onclick="delProduct(${response.idx})"></i></a>
                </li>`;

            /*
            var html = `
					<li id="li${response.idx}" class="li${response.idx}">
						<p class="p_name">${response.PRODUCT_NM}</p>
						<p class="p_price_2">${addCommaNumber(Math.floor(response.UNIT_PRICE))}원</p>
						<p class="p_price">${addCommaNumber(Math.floor(response.prod_price))}원</p>
						<div class="number_controller noControl" style="margin-left: auto">
							<button type="button" onclick="changeCount(${response.idx}, -1)"><i class="fa-regular fa-minus"></i></button>
							<input type="number" name="inputNumber" value="1" onkeyup="this.value=numberChk(this.value);changeCount(${response.idx}, this.value, true)" id="inputNumber${response.idx}"/>
							<button type="button" onclick="changeCount(${response.idx}, 1)" id="Count_add${response.idx}"><i class="fa-regular fa-plus"></i></button>
						</div>
						<div class="price fixedPrice" style="display: none">
							<p class="p_price2 ori"><em>원가</em><span class="prodPriceDisplay2">${addCommaNumber(Math.floor(response.UNIT_PRICE))}</span>원</p>
							<p class="p_price2 now"><span class="prodPriceDisplay">${addCommaNumber(Math.floor(response.prod_price))}</span>원</p>
						</div>
						<a><i class="fa-light fa-close" onclick="delProduct(${response.idx})"></i></a>
					</li>
				`;
             */
            $('.liProducts').append(html);

            // 스크롤 맨위로 되게
            const liProducts = document.querySelector('.liProducts'); // ul 리스트
            const lastLi = liProducts.lastElementChild; // 마지막 li 요소
            if (lastLi) {
                lastLi.scrollIntoView({ behavior: 'smooth' }); // 마지막 li로 스크롤
            }
            
            //document.querySelector('.liProducts').innerHTML += html;
            calcTotalPrice();
        }

        //시작과 동시에 실행
        //checkboxes_func();


        // 선택한 한방약품 삭제
        const delProduct = (idx) => {
            $("." + idx + "").prop("checked", false); // class로 체크다해주기
            idxArr = idxArr.filter((element) => element !== '' + idx + '');
            //console.log(idxArr);
            document.querySelector(`.liProducts .li${idx}`).remove();
            calcTotalPrice();
        }

        // 구매수량 (버튼/입력)
        const changeCount = (id, value, input = false) => {

            const parent = $('#li' + id);
            //console.log(parent);
            const numberElement = parent.find("input[name='inputNumber']").val(); // 구매수량
            const price = toNumber(parent.children(`.p_price`).text()); // 상품금액
            const price2 = toNumber(parent.children(`.p_price_2`).text()); // 상품금액

            // 변경수량
            let changeCount = !input ? toNumber(numberElement) + value : value;
            changeCount = Math.max(changeCount, 1);


            parent.find("input[name='inputNumber']").val(changeCount);

            //$('#inputNumber' + id).val('9999');
            parent.find(`.prodPriceDisplay`).html(addCommaNumber(price * changeCount));
            parent.find(`.prodPriceDisplay2`).html(addCommaNumber(price2 * changeCount));

            //console.log(price * changeCount);

            calcTotalPrice();
        }

        // 총금액 계산
        const calcTotalPrice = () => {
            const list = document.querySelectorAll('.liProducts li');
            let productPrice = 0;
            let productPrice2 = 0;

            const cntArr = [];
            if (list.length >= 1) {
                list.forEach(row => {

                    const priceStr = row.querySelector('.prodPriceDisplay').innerText;
                    //const priceStr = row.find(`.prodPriceDisplay`).text();
                    const price = toNumber(priceStr);
                    productPrice += price;

                    const priceStr2 = row.querySelector('.prodPriceDisplay2').innerText;
                    //const priceStr2 = row.find(`.prodPriceDisplay2`).text();
                    const price2 = toNumber(priceStr2);
                    productPrice2 += price2;

                    cntArr.push(row.querySelector('[name=inputNumber]').value);

                });
                //상품하나라도 있으면 의약품선택가리는부분
                $('#liProducts_no').hide();
            } else {

                //상품하나도 없을떄
                $('.drugs_list').css({'pointer-events': 'auto'});
                $('#liProducts_no').show();
            }

            document.querySelector('.totalPriceDisplay').innerHTML = addCommaNumber(productPrice); // 총 결제금액
            document.querySelector('.totalPriceDisplay2').innerHTML = addCommaNumber(productPrice2); // 총 결제금액
            document.querySelector('[name=productCnt]').value = cntArr; // formdata 구매수량
            document.querySelector('[name=productIdx]').value = idxArr; // formdata 상품인덱스


        }

        // 장바구니 담기
        const addCart = async (isBuy = false) => {
            const list = document.querySelectorAll('.liProducts li');
            if (list.length == 0) return showAlert('약품을 선택해 주세요.');

            //240726 1T,1C,1정 삭제하는부분
            for (let j = 0; j<idxDelArr.length ; j++){
                idxArr = idxArr.filter((e) => e !== idxDelArr[j]);
            }
            document.querySelector('[name=productIdx]').value = idxArr; // formdata 상품인덱스

            const form = document.order;
            const formData = new FormData(form);
            formData.append("isBuy", !isBuy ? 'Y' : 'N');

            const response = await fetchData(`/api/addCart`, formData);
            // console.log(response);

            if (response.result) {
                if (isBuy) { // 바로구매하기
                    const cartIdxArr = response.cartIdx; //.split(',');
                    if (cartIdxArr.length == 0) {
                        showAlert('서버와의 통신에 실패했습니다. 다시 시도해 주세요.', () => {
                            location.reload();
                        });
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

                document.querySelectorAll('input[name="checkIdx"]').forEach((checkbox) => {
                    checkbox.checked = false;
                });
            } else {
                showAlert('서버와의 통신에 실패했습니다. 다시 시도해 주세요.', () => {
                    location.reload();
                });
            }
        }

        // 장바구니 삭제
        const removeCart = async () => {
            for (let j = 0; j<idxArr.length ; j++){
                $('.liProducts .li' + idxArr[j]).remove();
                $("." + idxArr[j] + "").prop("checked", false); // class로 체크다해주기
            }
            idxArr = [];
            idxDelArr = [];
            document.querySelector('[name=productIdx]').value = idxArr; // formdata 상품인덱스
            calcTotalPrice();

            let fix = document.getElementById('fixed')
            fix.style.display = "none"
            $('#liProducts_no').show();
        }


        const callContent = (page, hstx = '', initial = '') => {
            page = page;
            if (!initial) {
                initial = '<?=$_GET['initial']?>';
            }

            if (!hstx) {
                hstx = $('#drugs_hstx').val();
            }

            var url = baseUrl + "/?hstx=" + hstx + "&initial=" + initial + "&page=" + page;
            var tbody = "";
            var thtml = "";
            var tbody2 = "";
            var thtml2 = "";
            //console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                dataType: "html",
                success: function (html) {
                    tbody = html.split('<ul id="drugs_list">');
                    thtml = tbody[1].split('</ul id="drugs_list_end">');

                    tbody2 = html.split('<div class="pagingWrap" id="drugs_paging">');

                    //console.log(tbody2);

                    thtml2 = tbody2[1].split('</div id="drugs_paging_end">');

                    $("#drugs_list").html(thtml[0]);
                    $("#drugs_paging").html(thtml2[0]);

                    //이미 체크되어있는거 체크유지해주기
                    $.each(idxArr, function (index, element) {
                        //console.log(index + " :: " + element);
                        $("." + element + "").prop("checked", true); // class로 체크다해주기
                    });


                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }

        var CONS_CD = '';
        var PRODUCT_NM = '';
        var prod_price = '';

        const callContent_cons = (page, CONS_CD_get = '', PRODUCT_NM_get = '', prod_price_get = '', cons_hstx = '') => {

            //선택상품 성분명
            if (CONS_CD_get) {
                CONS_CD = CONS_CD_get;
            }

            //선택상품이름
            if (PRODUCT_NM_get) {
                PRODUCT_NM = PRODUCT_NM_get;
            }

            //선택상품금액
            if (prod_price_get) {
                prod_price = prod_price_get;
            }

            //검색어
            if (cons_hstx) {
                var cons_hstx = cons_hstx;
            }

            var url = baseUrl + "/medicinal_cons/?page=" + page + "&CONS_CD=" + CONS_CD + "&PRODUCT_NM=" + PRODUCT_NM + "&prod_price=" + prod_price + "&cons_hstx=" + cons_hstx;
            var tbody = "";

            //console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                dataType: "html",
                success: function (html) {

                    tbody = html.split('<div class="box" id="drugs_list_cons">');
                    thtml = tbody[1].split('</div id="drugs_list_cons_end">');

                    $("#drugs_list_cons_modal").html(thtml[0]);

                    //이미 체크되어있는거 체크유지해주기
                    $.each(idxArr, function (index, element) {
                        //console.log(index + " :: " + element);
                        $("." + element + "").prop("checked", true); // class로 체크다해주기
                    });

                    //checkboxes_func();
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }


    </script>
    <script>

        let c1 = document.querySelector('#listOpen');

        c1.addEventListener('click', function () {
            if (c1.classList.contains('on')) {
                c1.classList.remove('on');
                c1.innerText = "접기";
            } else {
                c1.classList.add('on');
                c1.innerText = "열기";
            }
        });


    </script>
    <script>

        window.addEventListener('scroll', () => {
            let scrollLocation = document.documentElement.scrollTop;
            let windowHeight = window.innerHeight;
            let fullHeight = document.body.scrollHeight;
            let fix = document.getElementById('fixed')

            if (scrollLocation > 700) {
                fix.style.display = "block"
            } else {
                fix.style.display = "none"
            }
            if (scrollLocation > 700) {
                fix.style.opacity = "1"
            } else {
                fix.style.opacity = "0"
            }
        })

    </script>


