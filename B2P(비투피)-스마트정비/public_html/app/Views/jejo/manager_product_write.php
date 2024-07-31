
<?php 
    echo view('common/header_adm'); 
    $pid = "manager_product_write";
    $header_name = "제품 관리";
?>


<div id="adm_content">
    <?php echo view('common/jejo_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">제품 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('/jejo/manager_product_list')?>" class="active">제품 관리</a>
                <a href="<?=base_url('/jejo/manager_stock_list')?>">재고 관리</a>
            </div>
        </div>

        <div class="write_wrap">
            <div class="top_wrap">
                <h1>제품 등록하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('/jejo/manager_product_list')?>" class="btn btn-sm btn-gray">목록</a>
                    <a href="<?=base_url('/jejo/manager_product_list')?>" class="btn btn-sm btn-pink">삭제</a>
                    <a href="<?=base_url('/jejo/manager_product_list')?>" class="btn btn-sm btn-blue">저장</a>
                </div>
            </div>

            <div class="box">
                <h4><span class="color-blue">(필수)</span> 판매사이트 및 판매상태</h4>
                <div class="wrap box__site-group">
                    <div class="box__bundle">
                        <div class="box__filter-group">
                            <div class="form form--gmarket">
                                <div class="input_checkbox form__inner form">
                                    <input class="form__checkbox" disabled="" id=":r1m:" type="checkbox" checked="">
                                    <label for=":r1m:" class="form__label">
                                        <i class="fa-duotone fa-square-check txt-lg"></i><span class="for-a11y">Gmarket</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box__filter-group ">
                            <div class="input_radio form">
                                <input class="form__radio" id=":r1n:" type="radio" value="11" name="gmarket_radi" checked="">
                                <label for=":r1n:" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매가능</label>
                            </div>
                            <div class="input_radio form">
                                <input class="form__radio" id=":r1o:" type="radio" value="11" name="gmarket_radi">
                                <label for=":r1o:" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매중지</label>
                            </div>
                        </div>
                    </div>
                    <div class="box__bundle">
                        <div class="box__filter-group">
                            <div class="form form--auction">
                                <div class="input_checkbox form__inner form">
                                    <input class="form__checkbox" id=":r1p:" type="checkbox">
                                    <label for=":r1p:" class="form__label">
                                        <i class="fa-duotone fa-square-check txt-lg"></i><span class="for-a11y">Auction</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <p class="text__information flex gap5"><i class="fa-duotone fa-circle-exclamation"></i>상품 미등록 상태입니다.</p>
                    </div>
                </div>
            </div>


            <div class="box">
                <h4><span class="color-blue">(필수)</span> 상품명</h4>

                <div class="">
                    <p><span class="color-blue">(필수)</span> 상품명</p>
                    <input type="text" placeholder="입력하세요" class="border_gray" value="기아 쎄라토 쏘렌토 / 바이오라이트 HALO 할로 차량용 케빈 에어컨 필터 PM0.3 / 부품협회인정">
                    <p class="text-guide">※ 적합한 상품명을 입력하면 검색 결과 노출에 도움이 될 수 있습니다. 일부 카테고리를 제외하고 언제든 상품명 수정이 가능합니다.</p>
                </div>

                <div class="">
                    <p><span class="color-blue">(필수)</span> 프로모션 문구</p>
                    <input type="text" placeholder="최대 한글 50자, 영문/숫자 100자까지 입력 가능합니다. (상품명 포함)" class="border_gray">
                    <p class="text-guide">※ 1+1행사 중, 사은품 증정 등 판매 촉진을 위한 문구를 입력해보세요.</p>
                </div>

                <div class="">
                    <p><span class="color-blue">(필수)</span> 판매자 관리코드</p>
                    <input type="text" placeholder="판매자 관리코드를 입력해주세요." class="border_gray">
                </div>
            </div>


            <div class="box">
                <h4><span class="color-blue">(필수)</span> 카테고리</h4>
                <!--
                <div class="input_radio">
                    <input type="radio" id="radi_cate01" name="radi_cate">
                    <label for="radi_cate01"><i class="fa-duotone fa-circle-check"></i>카테고리 검색</label>
                </div>
-->

                <div class="flex justi-sb">
                    <p>카테고리 선택</p>
                    <p>
                        선택한 카테고리 : <strong class="color-blue">식품 > 신선식품 > 축산물 > 닭고기 > 부위별닭고기</strong>
                        <button class="btn btn-mini btn-white" style="margin-left:10px">재선택</button>
                    </p>
                </div>
                <div class="box__filter-group">
                    <div class="box__category-wrapper">
                        <div class="box__category-wrap">
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">대분류</span>
                                    <ul class="list__category" role="listbox">
                                        <li class="list-item is-selected" role="presentation">
                                            <button class="button__category" role="option" type="button" title="식품">식품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button>
                                        </li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="리빙">리빙</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="유아동">유아동</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="뷰티">뷰티</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="의류">의류</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="패션잡화">패션잡화</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="신발">신발</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="가전">가전</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="디지털">디지털</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="컴퓨터">컴퓨터</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="문구/사무용품">문구/사무용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="도서">도서</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="음반/DVD">음반/DVD</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="악기">악기</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="수집/종교용품">수집/종교용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="광학기기">광학기기</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="원예/꽃배달">원예/꽃배달</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="이벤트/파티용품">이벤트/파티용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="여행/티켓/e쿠폰">여행/티켓/e쿠폰</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="반려동물용품">반려동물용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="스포츠/레저용품">스포츠/레저용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="건강의료용품">건강의료용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="공구설비/자재">공구설비/자재</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="자동차용품">자동차용품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="완구">완구</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="생활서비스">생활서비스</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="홈인테리어/가구">홈인테리어/가구</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="렌탈">렌탈</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="특판">특판</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="중고시장">중고시장</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">중분류</span>
                                    <ul class="list__category" role="listbox">
                                        <li class="list-item is-selected" role="presentation"><button class="button__category" role="option" type="button" title="신선식품">신선식품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="가공식품">가공식품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="건강식품">건강식품</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">소분류</span>
                                    <ul class="list__category" role="listbox">
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="농산물">농산물</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item is-selected" role="presentation"><button class="button__category" role="option" type="button" title="축산물">축산물</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="수산물">수산물</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">세분류</span>
                                    <ul class="list__category" role="listbox">
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="소고기">소고기</button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="돼지고기">돼지고기</button></li>
                                        <li class="list-item is-selected" role="presentation"><button class="button__category" role="option" type="button" title="닭고기">닭고기</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="오리고기">오리고기</button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="알류">알류</button><button class="button__category--more"><i class="fa-light fa-chevron-right"></i></button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="기타축산물">기타축산물</button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="양고기">양고기</button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">상세분류</span>
                                    <ul class="list__category" role="listbox">
                                        <li class="list-item is-selected" role="presentation"><button class="button__category" role="option" type="button" title="부위별닭고기">부위별닭고기</button></li>
                                        <li class="list-item" role="presentation"><button class="button__category" role="option" type="button" title="생닭">생닭</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justi-sb">
                    <p>G마켓 노출</p>
                    <p class="">
                        신선식품 &gt; 닭고기/계란 &gt; 생닭
                        <span class="under_line">(카테고리 이용료 12%)</span>
                    </p>
                </div>

                <div class="flex justi-sb">
                    <p>A옥션 노출</p>
                    <p class="">
                        신선식품 &gt; 닭고기/계란 &gt; 생닭
                        <span class="under_line">(카테고리 이용료 12%)</span>
                    </p>
                </div>

            </div>


            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 판매가
                </h4>
                <div class="input_form">

                    <div class="">
                        <p><span class="color-blue">(필수)</span> 판매가</p>
                        <div class="input_unit">
                            <input type="text" placeholder="입력해주세요." class="border_gray">원
                        </div>
                        <p class="text-guide">
                            <span>2만2,000원</span>
                            <span>판매이용료 13% : 2,860원</span>
                        </p>
                    </div>
                </div>

                <div class="input_form">
                    <div class="">
                        <p>할인</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_discount01" name="radi_discount">
                                <label for="radi_discount01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_discount02" name="radi_discount" checked>
                                <label for="radi_discount02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="wrap">
                    <div>
                        <p>판매기간</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_period01" name="radi_period" checked>
                                <label for="radi_period01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>

                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_period02" name="radi_period">
                                <label for="radi_period02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <p class="">
                            기간설정
                        </p>

                        <div class="input_period">
                            <div class="radi_period_set_wrap">
                                <input type="radio" id="radi_period_set15" name="radi_period_set">
                                <label for="radi_period_set15">15일</label>

                                <input type="radio" id="radi_period_set30" name="radi_period_set">
                                <label for="radi_period_set30">30일</label>

                                <input type="radio" id="radi_period_set60" name="radi_period_set">
                                <label for="radi_period_set60">60일</label>

                                <input type="radio" id="radi_period_set90" name="radi_period_set">
                                <label for="radi_period_set90">90일</label>

                                <input type="radio" id="radi_period_set120" name="radi_period_set">
                                <label for="radi_period_set120">120일</label>
                            </div>

                            <div>
                                <div class="input_select">
                                    <!--i class="fa-duotone fa-calendar"></i-->
                                    <input type="date" value="2024-08-24" class="border_gray">
                                </div>
                                <p class="flex gap5 text-guide"><i class="fa-duotone fa-circle-exclamation"></i>남은 판매기간 31일</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="input_form">
                    <div class="">
                        <p>부과세</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_taxfree01" name="radi_taxfree">
                                <label for="radi_taxfree01">
                                    <i class="fa-duotone fa-circle-check"></i>과세상품
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_taxfree02" name="radi_taxfree">
                                <label for="radi_taxfree02">
                                    <i class="fa-duotone fa-circle-check"></i>면세상품
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 스마일 배송
                </h4>

                <div class="input_form">
                    <div class="">
                        <p>스마일 배송</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_smile01" name="radi_smile">
                                <label for="radi_smile01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_smile02" name="radi_smile" checked>
                                <label for="radi_smile02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 옵션
                </h4>

                <div class="input_form">
                    <p>선택형</p>
                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_option_upload01" name="radi_option_upload">
                            <label for="radi_option_upload01">
                                <i class="fa-duotone fa-circle-check"></i>설정함
                            </label>
                        </div>


                        <div class="input_radio">
                            <input type="radio" id="radi_option_upload02" name="radi_option_upload">
                            <label for="radi_option_upload02">
                                <i class="fa-duotone fa-circle-check"></i>설정안함
                            </label>
                        </div>
                    </div>
                </div>


                <div class="input_form input_grid3">
                    <div>
                        <p><span class="color-blue">(필수)</span> 옵션 입력방식</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_option_upload01_01" name="radi_option_upload01">
                                <label for="radi_option_upload01_01">
                                    <i class="fa-duotone fa-circle-check"></i>직접 입력하기
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_option_upload01_02" name="radi_option_upload01">
                                <label for="radi_option_upload01_02">
                                    <i class="fa-duotone fa-circle-check"></i>엑셀 일괄 등록하기
                                </label>
                            </div>

                        </div>

                        <div class="exel_btn_wrap">
                            <input type="file" id="file-exel">
                            <label for="file-exel" class="btn btn-sm btn-blue">
                                <i class="fa-duotone fa-arrow-up-from-bracket"></i>엑셀 업로드
                            </label>

                            <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(단독형)</a>
                            <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(2개조합형)</a>
                            <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(3개조합형)</a>
                        </div>
                    </div>


                    <div>
                        <p><span class="color-blue">(필수)</span> 옵션 유형</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_option_upload02_01" name="radi_option_upload02">
                                <label for="radi_option_upload02_01">
                                    <i class="fa-duotone fa-circle-check"></i>단독형
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_option_upload02_02" name="radi_option_upload02">
                                <label for="radi_option_upload02_02">
                                    <i class="fa-duotone fa-circle-check"></i>조합형
                                </label>
                            </div>
                        </div>
                    </div>


                    <div>
                        <p><span class="color-blue">(필수)</span> 옵션명 개수</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_option_upload03_01" name="radi_option_upload03">
                                <label for="radi_option_upload03_01">
                                    <i class="fa-duotone fa-circle-check"></i>2개
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_option_upload03_02" name="radi_option_upload03">
                                <label for="radi_option_upload03_02">
                                    <i class="fa-duotone fa-circle-check"></i>3개
                                </label>
                            </div>
                        </div>
                    </div>

                </div>


                <div>
                    <p><span class="color-blue">(필수)</span> 옵션입력</p>

                    <div class="option_grid">
                        <div>
                            <p class="text-guide">옵션명</p>
                            <div class="input_select option-name">

                                <select class="border_gray">
                                    <option value="옵션명 선택">옵션명 선택</option>
                                    <option value="옵션명 선택">옵션명 선택</option>
                                    <option value="옵션명 선택">옵션명 선택</option>
                                </select>
                            </div>
                            <div class="input_select option-name">

                                <select class="border_gray">
                                    <option value="옵션명 선택">옵션명 선택</option>
                                    <option value="옵션명 선택">옵션명 선택</option>
                                    <option value="옵션명 선택">옵션명 선택</option>
                                </select>
                            </div>


                            <button class="btn-option-save btn-blue"><i class="fa-light fa-arrow-down"></i>옵션목록으로 적용</button>
                        </div>


                        <div class="">
                            <p class="text-guide">옵션값</p>


                            <div class="flex gap10 option-value">
                                <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" class="border_gray" value="니로 / H06,모닝 / K02,올 뉴 모닝 / K02-1">
                                <button class="flex gap5 btn btn-blue"><i class="fa-light fa-plus"></i>추가</button>
                            </div>

                            <div class="flex gap10 option-value">
                                <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" class="border_gray">
                                <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="option_list">
                    <p><span class="color-blue">(필수)</span> 옵션 목록 <strong class="color-blue">3</strong>개</p>

                    <div class="flex justi-sb">
                        <div class="input_checkbox">
                            <input type="checkbox" id="input_option_list">
                            <label for="input_option_list"><i class="fa-duotone fa-square-check txt-lg"></i>재고수량 관리</label>
                        </div>

                        <div class="flex gap10">
                            <div class="input_select">

                                <select class="border_gray">
                                    <option value="등록순">등록순</option>
                                    <option value="등록순">등록순</option>
                                    <option value="등록순">등록순</option>
                                </select>
                            </div>

                            <a href="" class="inlineflex gap5 btn btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 다운로드</a>
                        </div>
                    </div>


                    <div class="option_table">
                        <div class="top_btn">
                            <div></div>
                            <button class="btn btn-sm btn-white">선택삭제</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th width="50px">
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-selectall">
                                            <label for="option-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </th>
                                    <!--                                    <th>이미지</th>-->
                                    <th width="auto">옵션명</th>
                                    <th width="auto">옵션값<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="100px">추가금<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="100px">재고수량<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="auto">판매상태<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="auto">옵션관리코드<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="auto">노출여부<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="50px">삭제</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-select01">
                                            <label for="option-select01"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </td>
                                    <!--                                    <td>이미지</td>-->
                                    <td>차종</td>
                                    <td><input type="text" value="니로 / H06" class="border_gray"></td>
                                    <td><input type="text" value="100" class="border_gray"></td>
                                    <td><input type="text" value="0" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="판매가능">판매가능</option>
                                                <option value="품절">품절</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" value="BOL01-205A001" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="노출">노출</option>
                                                <option value="미노출">미노출</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-sm btn-white">삭제</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-select01">
                                            <label for="option-select01"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </td>
                                    <!--                                    <td>이미지</td>-->
                                    <td>차종</td>
                                    <td><input type="text" value="니로 / H06" class="border_gray"></td>
                                    <td><input type="text" value="100" class="border_gray"></td>
                                    <td><input type="text" value="0" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="판매가능">판매가능</option>
                                                <option value="품절">품절</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" value="BOL01-205A001" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="노출">노출</option>
                                                <option value="미노출">미노출</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-sm btn-white">삭제</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-select01">
                                            <label for="option-select01"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </td>
                                    <!--                                    <td>이미지</td>-->
                                    <td>차종</td>
                                    <td><input type="text" value="니로 / H06" class="border_gray"></td>
                                    <td><input type="text" value="100" class="border_gray"></td>
                                    <td><input type="text" value="0" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="판매가능">판매가능</option>
                                                <option value="품절">품절</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" value="BOL01-205A001" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="노출">노출</option>
                                                <option value="미노출">미노출</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-sm btn-white">삭제</button></td>
                                </tr>
                                <tr class="nodata_tr">
                                    <td colspan="9">
                                        <p><i class="fa-duotone fa-circle-exclamation"></i>적용된 옵션값이 없습니다</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="box">
                <h4>
                    재고수량
                </h4>
                <div class="input_form">

                    <div class="">
                        <p><span class="color-blue">(필수)</span> 재고수량</p>
                        <div class="input_unit">
                            <input type="text" placeholder="입력해주세요." class="border_gray">개
                        </div>
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>옵션 재고수량을 설정하면, 옵션의 재고수량으로 자동 적용됩니다.
                        </p>
                    </div>
                </div>

            </div>


            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 상품이미지
                </h4>
                <div class="proImgWrap">
                    <div class="btn-proImgUpload">
                        <input type="file" id="file-proImgUpload">
                        <label for="file-proImgUpload">
                            <i class="fa-light fa-plus"></i>
                            <span class="text">권장 : 1000 x 1000<br>JPG, PNG</span>
                        </label>
                    </div>
                    <div class="btn-proImgList">
                        <div class="file-proImg" id="file-proImg01">
                            <img src="http://gdimg.gmarket.co.kr/3153099695/STILL/600?tcache=638497356053937478" alt="">
                            <div class="emb emb_on">
                                대표
                            </div>
                            <div class="controller_wrap">
                                <button class="btn-del"><i class="fa-light fa-xmark"></i></button>
                            </div>
                        </div>
                        <div class="file-proImg" id="file-proImg02">
                            <img src="http://gdimg.gmarket.co.kr/3153099695/STILL/600?tcache=638497356053937478" alt="">
                            <div class="emb">
                                추가1
                            </div>
                            <div class="controller_wrap">
                                <button class="btn-del"><i class="fa-light fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="flex gap5 text-guide">
                    <i class="fa-duotone fa-circle-exclamation"></i>상품이미지는 15장까지 업로드 가능합니다
                </p>

            </div>

            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 상품 상세설명필수
                </h4>
                <div class="tab-detail-wrap">
                    <input type="radio" id="radi-tab-detail01" name="radi-tab-detail">
                    <label class="" for="radi-tab-detail01">에디터 작성</label>

                    <input type="radio" id="radi-tab-detail02" name="radi-tab-detail">
                    <label class="" for="radi-tab-detail02">이미지 업로드</label>

                    <input type="radio" id="radi-tab-detail03" name="radi-tab-detail" checked>
                    <label class="" for="radi-tab-detail03">HTML 작성</label>
                </div>
                <div class="con-detail-wrap">
                    <textarea class="border_gray">HTML을 작성해주세요.</textarea>
                </div>
                <div class="flex justi-sb">
                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>Iframe, 다른상품링크, 팝업링크를 제외하고 입력해주세요.
                    </p>
                    <div class="flex gap5 btn_wrap">
                        <button class="btn btn-sm btn-white">초기화</button>
                        <button class="btn btn-sm btn-black">이미지호스팅</button>
                        <button class="btn btn-sm btn-blue">미리보기</button>
                    </div>
                </div>
            </div>


            <div class="box">
                <h4>
                    상품 주요정보
                </h4>
                <div class="input_form">

                    <div class="">
                        <p>브랜드 및 제조사</p>
                        <div class="input_search">
                            <input type="text" placeholder='브랜드 및 제조사, 상품브랜드를 검색해보세요.' class="border_gray">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        <div class="input_checkbox">
                            <input type="checkbox" id="no_brand">
                            <label for="no_brand"><i class="fa-duotone fa-square-check"></i>브랜드 없음</label>
                        </div>
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>브랜드 및 제조사를 등록하면 검색 결과에 노출될 확률이 높아집니다.
                        </p>
                    </div>
                </div>

            </div>


            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 인증정보필수
                </h4>

                <div class="wrap">
                    <div class="input_form">
                        <div class="">
                            <p>어린이제품 인증</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_certi01_01" name="radi_certi01">
                                    <label for="radi_certi01_01">
                                        <i class="fa-duotone fa-circle-check"></i>인증대상
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_certi01_02" name="radi_certi01">
                                    <label for="radi_certi01_02">
                                        <i class="fa-duotone fa-circle-check"></i>상세설명에 별도표기
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_certi01_03" name="radi_certi01">
                                    <label for="radi_certi01_03">
                                        <i class="fa-duotone fa-circle-check"></i>인증대상이 아님
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!--                인증대상일때-->
                    <div class="input_form">
                        <div class="">
                            <p>인증 유형</p>

                            <div class="option_grid">
                                <div class="input_select option-name">

                                    <select class="border_gray">
                                        <option value="안전인증">안전인증</option>
                                        <option value="안전인증">안전인증</option>
                                        <option value="안전인증">안전인증</option>
                                    </select>
                                </div>
                                <div class="flex gap10 ">
                                    <input type="text" placeholder="인증번호" class="border_gray" value="">
                                    <button class="flex gap5 btn btn-blue">인증하기</button>
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
                                </div>
                            </div>
                            <p class="flex gap5 text-guide">
                                <i class="fa-duotone fa-circle-exclamation"></i>KC인증이 필수인 상품을 인증 없이 판매하는 경우 3년 이하의 징역 또는 3천만원 이하의 벌금형에 처해질 수 있습니다.
                            </p>
                        </div>

                    </div>
                </div>



                <div class="wrap">
                    <div class="input_form">
                        <div class="">
                            <p>생활용품 인증</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_certi02_01" name="radi_certi02">
                                    <label for="radi_certi02_01">
                                        <i class="fa-duotone fa-circle-check"></i>인증대상
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_certi02_02" name="radi_certi02">
                                    <label for="radi_certi02_02">
                                        <i class="fa-duotone fa-circle-check"></i>상세설명에 별도표기
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_certi02_03" name="radi_certi02">
                                    <label for="radi_certi02_03">
                                        <i class="fa-duotone fa-circle-check"></i>인증대상이 아님
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!--                인증대상일때-->
                    <div class="input_form">
                        <div class="">
                            <p>인증 유형</p>

                            <div class="option_grid">
                                <div class="input_select option-name">

                                    <select class="border_gray">
                                        <option value="안전인증">안전인증</option>
                                        <option value="안전인증">안전인증</option>
                                        <option value="안전인증">안전인증</option>
                                    </select>
                                </div>
                                <div class="flex gap10 ">
                                    <input type="text" placeholder="인증번호" class="border_gray" value="">
                                    <button class="flex gap5 btn btn-blue">인증하기</button>
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
                                </div>
                            </div>
                            <p class="flex gap5 text-guide">
                                <i class="fa-duotone fa-circle-exclamation"></i>KC인증이 필수인 상품을 인증 없이 판매하는 경우 3년 이하의 징역 또는 3천만원 이하의 벌금형에 처해질 수 있습니다.
                            </p>
                        </div>

                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_certi02_02_01" name="radi_certi02_02">
                                <label for="radi_certi02_02_01">
                                    <i class="fa-duotone fa-circle-check"></i>해당없음
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_certi02_02_02" name="radi_certi02_02">
                                <label for="radi_certi02_02_02">
                                    <i class="fa-duotone fa-circle-check"></i>병행수입
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_certi02_02_03" name="radi_certi02_02">
                                <label for="radi_certi02_02_03">
                                    <i class="fa-duotone fa-circle-check"></i>구매대행
                                </label>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="wrap">
                    <div class="input_form">
                        <div class="">
                            <p>전기용품 인증</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_certi03_01" name="radi_certi03">
                                    <label for="radi_certi03_01">
                                        <i class="fa-duotone fa-circle-check"></i>인증대상
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_certi03_02" name="radi_certi03">
                                    <label for="radi_certi03_02">
                                        <i class="fa-duotone fa-circle-check"></i>상세설명에 별도표기
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_certi03_03" name="radi_certi03">
                                    <label for="radi_certi03_03">
                                        <i class="fa-duotone fa-circle-check"></i>인증대상이 아님
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!--                인증대상일때-->
                    <div class="input_form">
                        <div class="">
                            <p>인증 유형</p>

                            <div class="option_grid">
                                <div class="input_select option-name">

                                    <select class="border_gray">
                                        <option value="안전인증">안전인증</option>
                                        <option value="안전인증">안전인증</option>
                                        <option value="안전인증">안전인증</option>
                                    </select>
                                </div>
                                <div class="flex gap10 ">
                                    <input type="text" placeholder="인증번호" class="border_gray" value="">
                                    <button class="flex gap5 btn btn-blue">인증하기</button>
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
                                </div>
                            </div>
                            <p class="flex gap5 text-guide">
                                <i class="fa-duotone fa-circle-exclamation"></i>KC인증이 필수인 상품을 인증 없이 판매하는 경우 3년 이하의 징역 또는 3천만원 이하의 벌금형에 처해질 수 있습니다.
                            </p>
                        </div>

                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_certi03_02_01" name="radi_certi03_02">
                                <label for="radi_certi03_02_01">
                                    <i class="fa-duotone fa-circle-check"></i>해당없음
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_certi03_02_02" name="radi_certi03_02">
                                <label for="radi_certi03_02_02">
                                    <i class="fa-duotone fa-circle-check"></i>병행수입
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_certi03_02_03" name="radi_certi03_02">
                                <label for="radi_certi03_02_03">
                                    <i class="fa-duotone fa-circle-check"></i>구매대행
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>




            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 판매방식
                </h4>

                <div class="wrap">
                    <div class="input_form">
                        <p>상품상태</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method01_01" name="radi_sale_method01">
                                <label for="radi_sale_method01_01">
                                    <i class="fa-duotone fa-circle-check"></i>신상품
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method01_02" name="radi_sale_method01">
                                <label for="radi_sale_method01_02">
                                    <i class="fa-duotone fa-circle-check"></i>중고상품
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="input_form">
                        <p>미성년자 구매</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method02_01" name="radi_sale_method02">
                                <label for="radi_sale_method02_01">
                                    <i class="fa-duotone fa-circle-check"></i>가능
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method02_02" name="radi_sale_method02">
                                <label for="radi_sale_method02_02">
                                    <i class="fa-duotone fa-circle-check"></i>불가능
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrap">
                    <div class="input_form">
                        <p>최대구매 수량</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method03_01" name="radi_sale_method03">
                                <label for="radi_sale_method03_01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method03_02" name="radi_sale_method03">
                                <label for="radi_sale_method03_02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>


                    <!--                    최대구매 수량 설정함일때-->
                    <div class="input_form">
                        <p>제한설정</p>

                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method03_02_01" name="radi_sale_method03_02">
                                <label for="radi_sale_method03_02_01">
                                    <i class="fa-duotone fa-circle-check"></i>최대구매제한
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method03_02_02" name="radi_sale_method03_02">
                                <label for="radi_sale_method03_02_02">
                                    <i class="fa-duotone fa-circle-check"></i>기간제한
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method03_02_03" name="radi_sale_method03_02">
                                <label for="radi_sale_method03_02_03">
                                    <i class="fa-duotone fa-circle-check"></i>1회 제한
                                </label>
                            </div>
                        </div>

                        <p class="flex gap10">
                            구매자 1명이 최대 <input type="text" class="border_gray" style="width:100px" value="0">개 까지 구매가능(최대 999개)
                        </p>
                    </div>
                </div>

                <div class="wrap">
                    <div class="input_form">
                        <p>예약판매</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method04_01" name="radi_sale_method04">
                                <label for="radi_sale_method04_01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method04_02" name="radi_sale_method04">
                                <label for="radi_sale_method04_02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="input_form">
                        <p>배송시작일 설정</p>

                        <div class="flex gap20">
                            <div class="input_checkbox">
                                <input type="checkbox" id="start_date01">
                                <label for="start_date01"><i class="fa-duotone fa-square-check"></i>일괄</label>
                            </div>

                            <div class="input_checkbox">
                                <input type="checkbox" id="start_date02">
                                <label for="start_date02"><i class="fa-duotone fa-square-check"></i>G마켓</label>
                            </div>

                            <div class="input_checkbox">
                                <input type="checkbox" id="start_date03">
                                <label for="start_date03"><i class="fa-duotone fa-square-check"></i>옥션</label>
                            </div>
                        </div>
                        <div class="input_select" style="width:300px">
                            <!--i class="fa-duotone fa-calendar"></i-->
                            <input type="date" class="border_gray">
                        </div>

                    </div>

                </div>

                <div class="wrap">
                    <div class="input_form">
                        <p>G마켓 선물하기</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method05_01" name="radi_sale_method05">
                                <label for="radi_sale_method05_01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method05_02" name="radi_sale_method05">
                                <label for="radi_sale_method05_02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="input_form">
                        <p>G마켓 해외판매</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method06_01" name="radi_sale_method06">
                                <label for="radi_sale_method06_01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_sale_method06_02" name="radi_sale_method06">
                                <label for="radi_sale_method06_02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>
                </div>



            </div>



            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 상품정보 제공고시
                </h4>

                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 배송방법 선택</p>
                </div>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 택배사</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="직접입력">직접입력</option>
                            <option value="직접입력">직접입력</option>
                            <option value="직접입력">직접입력</option>
                        </select>
                    </div>
                    <div class="input_checkbox">
                        <input type="checkbox" id="input_all">
                        <label for="input_all"><i class="fa-duotone fa-square-check"></i>'상품 상세설명 참조'로 전체 입력</label>
                    </div>
                </div>

                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 직접입력</p>
                    <textarea class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
                </div>

                <div class="input_form">
                    <p>기타 특이사항</p>
                    <textarea class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
                </div>
            </div>



            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 배송
                </h4>
                <div class="wrap">
                    <div class="input_form">
                        <p>상품상태</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_deli01_01" name="radi_deli01">
                                <label for="radi_deli01_01">
                                    <i class="fa-duotone fa-circle-check"></i>택배,소포,등기
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_deli01_02" name="radi_deli01">
                                <label for="radi_deli01_02">
                                    <i class="fa-duotone fa-circle-check"></i>직접배송
                                </label>
                            </div>
                        </div>
                        <!--
                        <div class="input_checkbox">
                            <input type="checkbox" id="input_all">
                            <label for="input_all"><i class="fa-duotone fa-square-check"></i>템플릿 추가</label>
                        </div>
-->
                    </div>

                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 택배사</p>
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="선택">선택</option>
                                <option value="선택">선택</option>
                                <option value="선택">선택</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="wrap">
                    <div class="input_form">
                        <p>발송정책</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_deli02_01" name="radi_deli02">
                                <label for="radi_deli02_01">
                                    <i class="fa-duotone fa-circle-check"></i>당일발송
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_deli02_02" name="radi_deli02">
                                <label for="radi_deli02_02">
                                    <i class="fa-duotone fa-circle-check"></i>순차발송
                                </label>
                            </div>

                            <div class="input_radio">
                                <input type="radio" id="radi_deli02_03" name="radi_deli02">
                                <label for="radi_deli02_03">
                                    <i class="fa-duotone fa-circle-check"></i>해외발송
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_deli02_04" name="radi_deli02">
                                <label for="radi_deli02_04">
                                    <i class="fa-duotone fa-circle-check"></i>요청일 발송
                                </label>
                            </div>

                            <div class="input_radio">
                                <input type="radio" id="radi_deli02_05" name="radi_deli02">
                                <label for="radi_deli02_05">
                                    <i class="fa-duotone fa-circle-check"></i>주문제작 발송
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_deli02_06" name="radi_deli02">
                                <label for="radi_deli02_06">
                                    <i class="fa-duotone fa-circle-check"></i>발송일 미정
                                </label>
                            </div>
                        </div>
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>당일발송을 설정하면 '오늘출발' 태그가 노출됩니다.
                        </p>
                    </div>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 발송 마감시간</p>
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="선택">선택</option>
                                <option value="선택">선택</option>
                                <option value="선택">선택</option>
                            </select>
                        </div>
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>발송정책은 '배송정보관리' 메뉴에서 관리가 가능합니다.
                        </p>
                    </div>
                </div>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 출고지</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="HK Tech Corporation">HK Tech Corporation</option>
                            <option value="HK Tech Corporation">HK Tech Corporation</option>
                            <option value="HK Tech Corporation">HK Tech Corporation</option>
                        </select>
                    </div>

                    <p class="text-guide">
                        경기도 화성시 마도면 마도로620번길 43 HK Tech Corporation (우:18541 )
                    </p>
                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>출고지 주소록은 '배송정보관리'메뉴에서 관리가 가능합니다.
                    </p>
                </div>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 묶음배송</p>
                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_deli03_01" name="radi_deli03">
                            <label for="radi_deli03_01">
                                <i class="fa-duotone fa-circle-check"></i>설정함
                            </label>
                        </div>


                        <div class="input_radio">
                            <input type="radio" id="radi_deli03_02" name="radi_deli03">
                            <label for="radi_deli03_02">
                                <i class="fa-duotone fa-circle-check"></i>설정안함(개별배송)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 배송지 선택</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="선택">선택</option>
                            <option value="선택">선택</option>
                            <option value="선택">선택</option>
                        </select>
                    </div>

                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>배송비는 '배송정보관리'메뉴에서만 관리가 가능합니다.
                    </p>
                </div>
            </div>



            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 반품/교환
                </h4>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 반품/교환지</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="HK Tech Corporation">HK Tech Corporation</option>
                            <option value="HK Tech Corporation">HK Tech Corporation</option>
                            <option value="HK Tech Corporation">HK Tech Corporation</option>
                        </select>
                    </div>

                    <p class="text-guide">
                        경기도 화성시 마도면 마도로620번길 43 HK Tech Corporation (우:18541 )
                    </p>
                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>발송정책은 '배송정보관리'메뉴에서 관리가 가능합니다.
                    </p>
                </div>
                <div class="input_form">
                    <p>택배사</p>
                    <input type="text" class="border_gray" value="발송한 택배사와 동일합니다." disabled>
                </div>


                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 반품/교환 배송비(편도)</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_refund_01" name="radi_refund">
                            <label for="radi_refund_01">
                                <i class="fa-duotone fa-circle-check"></i>무료
                            </label>
                        </div>


                        <div class="input_radio">
                            <input type="radio" id="radi_refund_02" name="radi_refund">
                            <label for="radi_refund_02">
                                <i class="fa-duotone fa-circle-check"></i>유료
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="input_unit">
                        <input type="text" class="border_gray" value="0">원
                    </div>
                </div>
            </div>




            <div class="box">
                <h4>
                    추가구성
                </h4>
                <div class="input_form">
                    <p>추가구성</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_chuga_01" name="radi_chuga">
                            <label for="radi_chuga_01">
                                <i class="fa-duotone fa-circle-check"></i>설정함
                            </label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="radi_chuga_02" name="radi_chuga" checked>
                            <label for="radi_chuga_02">
                                <i class="fa-duotone fa-circle-check"></i>설정안함
                            </label>
                        </div>

                    </div>
                </div>
            </div>


            <div class="box">
                <h4>
                    구매혜택
                </h4>
                <div class="input_form">
                    <p>G마켓 더 사면 할인</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_hyetak_01" name="radi_hyetak">
                            <label for="radi_hyetak_01">
                                <i class="fa-duotone fa-circle-check"></i>설정함
                            </label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="radi_hyetak_02" name="radi_hyetak" checked>
                            <label for="radi_hyetak_02">
                                <i class="fa-duotone fa-circle-check"></i>설정안함
                            </label>
                        </div>

                    </div>
                </div>
                <div class="input_form">
                    <p>스마일캐시 지급</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_smilecash_01" name="radi_smilecash">
                            <label for="radi_smilecash_01">
                                <i class="fa-duotone fa-circle-check"></i>설정함
                            </label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="radi_smilecash_02" name="radi_smilecash" checked>
                            <label for="radi_smilecash_02">
                                <i class="fa-duotone fa-circle-check"></i>설정안함
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box">
                <h4>
                    상품 추가 정보
                </h4>
                <div class="input_form">
                    <p>원산지 구분</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_refund_01" name="radi_refund">
                            <label for="radi_refund_01">
                                <i class="fa-duotone fa-circle-check"></i>상품 상세설명 참조
                            </label>
                        </div>


                        <div class="input_radio">
                            <input type="radio" id="radi_refund_02" name="radi_refund" checked>
                            <label for="radi_refund_02">
                                <i class="fa-duotone fa-circle-check"></i>원산지 의무표시 대상아님
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 노출 채널
                </h4>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> 포털 가격비교 사이트 상품등록</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_ch_01" name="radi_ch">
                            <label for="radi_ch_01">
                                <i class="fa-duotone fa-circle-check"></i>상품 상세설명 참조
                            </label>
                        </div>


                        <div class="input_radio">
                            <input type="radio" id="radi_ch_02" name="radi_ch">
                            <label for="radi_ch_02">
                                <i class="fa-duotone fa-circle-check"></i>원산지 의무표시 대상아님
                            </label>
                        </div>
                    </div>

                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>등록함으로 설정한 경우, 포털 가격비교 사이트를 통한 주문 발생 시 판매가의 2%가 서비스 이용료로 부과됩니다.
                    </p>
                </div>

                <div class="wrap">
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 쿠폰적용</p>

                        <div class="flex gap20">
                            <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_coupon01_01" name="radi_coupon01" checked>
                                    <label for="radi_coupon01_01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_coupon01_02" name="radi_coupon01" disabled>
                                    <label for="radi_coupon01_02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>

                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>G마켓은 쿠폰적용 여부를 변경할 수 없습니다.
                        </p>
                    </div>
                    <div class="input_form">
                        <p style="opacity:0;"><span class="color-blue">(필수)</span> 쿠폰적용</p>

                        <div class="flex gap20">
                            <div class="box__flag box__flag--auction"><span class="for-a11y">G마켓</span></div>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_coupon02_01" name="radi_coupon02">
                                    <label for="radi_coupon02_01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_coupon02_02" name="radi_coupon02">
                                    <label for="radi_coupon02_02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="wrap">
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 사이트 부담 할인</p>

                        <div class="flex gap20">
                            <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_discount01_01" name="radi_discount01">
                                    <label for="radi_discount01_01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_discount01_02" name="radi_discount01">
                                    <label for="radi_discount01_02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input_form">
                        <p style="opacity:0;"><span class="color-blue">(필수)</span> 쿠폰적용</p>

                        <div class="flex gap20">
                            <div class="box__flag box__flag--auction"><span class="for-a11y">G마켓</span></div>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_discount02_01" name="radi_discount02" disabled>
                                    <label for="radi_discount02_01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_discount02_02" name="radi_discount02" disabled>
                                    <label for="radi_discount02_02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>

                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>지원할인에 동의한 판매자만 설정이 가능합니다.
                        </p>
                    </div>

                </div>
            </div>




            <div class="box">
                <h4>
                    <span class="color-blue">(필수)</span> 후원/나눔쇼핑
                </h4>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span> G마켓 후원쇼핑</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="radi_huwon_01" name="radi_huwon">
                            <label for="radi_huwon_01">
                                <i class="fa-duotone fa-circle-check"></i>설정함
                            </label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="radi_huwon_02" name="radi_huwon" checked>
                            <label for="radi_huwon_02">
                                <i class="fa-duotone fa-circle-check"></i>설정안함
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>