<!-- 상품관리 등록/수정 폼 -->
<? include_once VIEWPATH. 'component/summer_note_resource.php'; // summernote?>

<section class="productupd">
    <form name="productFrm" autocomplete="off" method="post">
        <input type="hidden" name="idx" value="<?=(int)$productData['idx']?>">
        <div class="panel">
            <p class="flex ai-c">
                <label class="PRODUCT_NM">상품명</label>
                <!--
                <input type="text" name="prodName" placeholder="상품명을 입력하세요" class="title" value="<?=$productData['prod_name']?>" required>
                -->
                <input type="text" name="PRODUCT_NM" placeholder="상품명을 입력하세요" class="PRODUCT_NM" value="<?=$productData['PRODUCT_NM']?>" required>

                <span>
					<input type="checkbox" id="soldoutYn" name="soldoutYn" value="Y" <?=$productData['soldout_yn']=='Y'?'checked':''?>>
                    <label for="soldoutYn">임시품절</label>
				</span>&nbsp;
				<span>
					<input type="checkbox" id="mdRecYn" name="mdRecYn" value="Y" <?=$productData['md_rec_yn']=='Y'?'checked':''?>>
                    <label for="mdRecYn">MD추천</label>
				</span>
                <span>
					<input type="checkbox" id="del_yn" name="del_yn" value="Y" <?=$productData['del_yn']=='Y'?'checked':''?>>
                    <label for="mdRecYn">삭제됨</label>
				</span>
            </p>
            <span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="submit" class="btn btn_blue"><?=$isModify?'수정':'등록'?></button>
            </span>
        </div>

        <div class="box">
            <p class="name">기본 분류</p>
            <!--
            <p class="line">
                <label>카테고리</label>
                <select name="category" required>
					<?php foreach (PRODUCT_CATEGORY AS $cate=>$name){?>
                    <option value="<?=$cate?>" <?=$productData['category']==$cate?'selected':''?>><?=$name?></option>
                    <?php }?>
                </select>
            </p>
            -->
            <div class="grid grid2">
                <p class="line">
                    <label>우선순위</label>
                    <input type="text" name="prodOrder" placeholder="0"
                           value="<?= empty($productData['prod_order']) ? '' : $productData['prod_order'] ?>">큰 순서로 노출
                </p>
                <p class="line">
                    <label>검색 키워드</label>
                    <input type="text" name="keyword" placeholder=" ,(콤마)로 구분해서 입력해주세요."
                           value="<?= empty($productData['keyword']) ? '' : $productData['keyword'] ?>">
                </p>
            </div>



			<p class="name">판매가격</p>
			<div class="price">
				<p class="name">가격 정보</p>
				<div class="grid grid2">
					<p class="line">
						<label>판매가</label><!--
					--><input type="text" name="prodPrice" placeholder="기본 판매가를 입력하세요" value="<?=empty($productData['prod_price'])?'':number_format(removeComma($productData['prod_price']))?>" >원
					</p>
					<p class="line">
						<label>규격단가</label><input type="text" name="standard_price" placeholder="규격단가를 입력하세요" value="<?=empty($productData['standard_price'])?'':number_format(removeComma($productData['standard_price']))?>" >
						<span>* 예) 100T 규격시 1T에 대한 단가</span>
					</p>
				</div>
				<div class="grid grid2">
					<p class="line"><label>단가</label><input type="text" name="UNIT_PRICE" placeholder="단가를 입력하세요" value="<?=number_format(removeComma($productData['UNIT_PRICE']),2)?>" ></p>
					<p class="line"><label>보험가</label><input type="text" name="INSU_PRICE" placeholder="보험가를 입력하세요" value="<?=number_format(removeComma($productData['INSU_PRICE']),2)?>" ></p>
				</div>
			</div>

            <p class="name">상품 정보</p>
            <p class="line"><label>제품코드</label>
                <input type="text" name="PRODUCT_CD" id="PRODUCT_CD" placeholder="제품코드를 입력하세요" value="<?=$productData['PRODUCT_CD']?>"  required maxlength="5" onkeyup="checkPRODUCT_CD()">
                <input type="hidden" name="PRODUCT_CD_reg" id="PRODUCT_CD_reg" value="<?=$productData['PRODUCT_CD']?>">
                <span class="info box_red" id="PRODUCT_CD_txt"></span>
            </p>
			<div class="grid grid2">
				<p class="line"><label>성분코드</label><input type="text" name="CONS_CD" placeholder="성분코드를 입력하세요" value="<?=$productData['CONS_CD']?>" ></p>
				<p class="line"><label>성분코드SEQ</label><input type="text" name="CONS_CD_SEQ" placeholder="성분코드SEQ를 입력하세요" value="<?=$productData['CONS_CD_SEQ']?>" ></p>
			</div>
			<div class="grid grid2">
				<p class="line"><label>성분분류코드</label><input type="text" name="CONS" placeholder="성분분류코드를 입력하세요" value="<?=$productData['CONS']?>" ></p>
				<p class="line"><label>성분분류명</label><input type="text" name="CONS_NM" placeholder="성분분류명을 입력하세요" value="<?=$productData['CONS_NM']?>" ></p>
			</div>
			<div class="grid grid2">
				<p class="line"><label>성분명</label><input type="text" name="CONS_CD_NM" placeholder="성분명을 입력하세요" value="<?=$productData['CONS_CD_NM']?>" ></p>
				<p class="line"><label>제조사명</label><input type="text" name="MAKER_NM" placeholder="제조사명을 입력하세요" value="<?=$productData['MAKER_NM']?>" ></p>
			</div>
			<div class="grid grid2">
				<p class="line"><label>보험코드</label><input type="text" name="INSU_CD" placeholder="보험코드를 입력하세요" value="<?=$productData['INSU_CD']?>" ></p>
				<p class="line"><label>표준코드</label><input type="text" name="STANDARD_CD" placeholder="표준코드를 입력하세요" value="<?=$productData['STANDARD_CD']?>" ></p>
			</div>
			<div class="grid grid2">
				<p class="line"><label>규격</label><input type="text" name="PRODUCT_STANDARD" placeholder="규격을 입력하세요" value="<?=$productData['PRODUCT_STANDARD']?>" ></p>
				<p class="line"><label>단위</label><input type="text" name="PRODUCT_UNIT" placeholder="단위를 입력하세요" value="<?=$productData['PRODUCT_UNIT']?>" ></p>
			</div>
			<div class="grid grid2">
				<p class="line"><label>재고수량</label><input type="text" name="STOCK_QTY" placeholder="재고수량을 입력하세요" value="<?=number_format($productData['STOCK_QTY'],2)?>" ></p>
				<p class="line"><label>계산단위</label><input type="text" name="ACC_UNIT" placeholder="계산단위를 입력하세요" value="<?=number_format($productData['ACC_UNIT'],2)?>" ></p>
			</div>

            <p class="name">배송 정보</p>
            <p class="line"><label>배송 방법</label><input type="text" name="shippingInfo" placeholder="예) 택배(15시 이전 입금 확인시 당일발송)" value="<?=$productData['shipping_info']?>"></p>
            <p class="line">
                <label>배송 비용</label>
                <select name="shippingFreeYn" class="st-sm">
                    <option value="N" <?=$productData['shipping_free_yn']=='N'||empty($productData['shipping_free_yn'])?'selected':''?>>유료</option>
                    <option value="Y" <?=$productData['shipping_free_yn']=='Y'?'selected':''?>>무료</option>
                </select>
            </p>

            <p class="name">구매 분류</p>
            <p class="line">
                <label>노출 상태</label>
                <input type="radio" id="use1" name="useYn" value="Y" <?=$productData['use_yn']=='Y'||empty($productData['use_yn'])?'checked':''?>><label for="use1">노출</label>
                <input type="radio" id="use2" name="useYn" value="N" <?=$productData['use_yn']=='N'?'checked':''?>><label for="use2">노출안함</label>
            </p>

            <p class="name">판매 분류</p>
            <p class="line">
                <label>상태 구분</label>
                <input type="radio" id="sell1" name="sell_yn" value="Y" <?=$productData['sell_yn']=='Y'||empty($productData['sell_yn'])?'checked':''?>><label for="sell1">판매중</label>
                <input type="radio" id="sell2" name="sell_yn" value="N" <?=$productData['sell_yn']=='N'?'checked':''?>><label for="sell2">미판매</label>
            </p>

            <p class="name">의약품 구분</p>
            <p class="line">
                <label>상태 구분</label>
                <input type="radio" id="medi1" name="medi_yn" value="Y" <?=$productData['medi_yn']=='Y'?'checked':''?>><label for="medi1">실의약품</label>
                <input type="radio" id="medi2" name="medi_yn" value="N" <?=$productData['medi_yn']=='N'?'checked':''?>><label for="medi2">대체의약품</label>
                <input type="radio" id="medi2" name="medi_yn" value="NONE" <?=$productData['medi_yn']=='NONE' || empty($productData['medi_yn'])?'checked':''?>><label for="medi2">구분안함</label>
            </p>

            <p class="name">결제 정보</p>
            <p class="line">
                <label>결제 수단</label>
				<?php
				$payMethodList = explode(",", $productData['pay_method_list']);
				foreach (ENABLE_PAYMENT_METHODS AS $key=>$name) {
					$checked = !$productData || in_array($key, $payMethodList)? "checked" : "";
				?>
                <input type="checkbox" id="pm<?=$key?>" name="payMethod[]" value="<?=$key?>" <?=$checked?>>
                <label for="pm<?=$key?>"><?=$name?></label>
				<?php } ?>
            </p>

				<!--<p class="name">의약품 구분</p>-->
				<!--<p class="line">-->
				<!--	<label>구분</label>-->
				<!--	<select>-->
				<!--		<option>실의약품</option>-->
				<!--		<option>대체의약품</option>-->
				<!--	</select>-->
				<!--</p>-->

            <div id="productForm">
                <product-replace product_idx="<?=$productData['idx']?>"></product-replace>
            </div>
            <!--
            <p class="name">상세 정보</p>
            <div class="editor">
				<div id="editor"></div>
				<textarea name="content" style="display: none;"><?=$productData['content']?></textarea>
            </div>
            -->
            <!--
            <p class="name">사진 등록 (최대5장)</p>
            <div class="newpic-upload">
                <button type="button" class="newpic-edit" onclick="addProductImage()"><i class="fa-thin fa-plus"></i></button>
				<div class="flex" id="prevImageWrap">
				</div>
                <?/*<div class="newpic-preview">
                    <div id="prodImgPrev0">
                        <div class="thumb_img"><img src="<?=ASSETS_URL?>/img/common/noimg.jpg"></div>
                    </div>
                    <button type="button" class="newpic-del"><i class="fa-solid fa-close"></i></button>
                </div>*/?>
            </div>
            -->

        </div>
    </form>

    <!-- file upload hidden -->
    <div class="hide">
        <input type="file" name="file1" onchange="fileUpload(this);" accept="image/*">
    </div>

</section>

<script>
	const uploadImageFiles = <?=json_encode($imageFiles)?>;
</script>
<!-- 상품등록/수정 JS -->
<script src="<?=ASSETS_URL?>/js/adm/product_form.js?v=<?=JS_VER?>"></script>

<?php $jl->vueLoad("productForm");?>
<?php $jl->componentLoad("product");?>
<?php $jl->componentLoad("item");?>
