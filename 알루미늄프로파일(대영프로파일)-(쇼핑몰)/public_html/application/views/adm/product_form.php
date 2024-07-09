<!-- 상품관리 등록/수정 폼 -->
<? include_once VIEWPATH. 'component/summer_note_resource.php'; // summernote?>

<section class="productupd">
    <form name="productFrm" autocomplete="off" method="post">
        <input type="hidden" name="idx" value="<?=(int)$productData['idx']?>">
        <div class="panel">
            <p>
                <label class="title">상품명</label>
                <input type="text" name="prodName" placeholder="상품명을 입력하세요" class="title" value="<?=$productData['prod_name']?>" required>
                <span>
					<input type="checkbox" id="soldoutYn" name="soldoutYn" value="Y" <?=$productData['soldout_yn']=='Y'?'checked':''?>>
                    <label for="soldoutYn">임시품절</label>
				</span>&nbsp;
				<span>
					<input type="checkbox" id="mdRecYn" name="mdRecYn" value="Y" <?=$productData['md_rec_yn']=='Y'?'checked':''?>>
                    <label for="mdRecYn">BEST</label>
				</span>
            </p>
            <span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="submit" class="btn btn_green"><?=$isModify?'수정':'등록'?></button>
            </span>
        </div>

        <div class="box">
            <p class="name">기본 분류</p>
            <p class="line" style="display: none">
                <label>카테고리</label>
                <select name="category" required>
					<?php foreach (PRODUCT_CATEGORY AS $cate=>$name){?>
                    <option value="<?=$cate?>" <?=$productData['category']==$cate?'selected':''?>><?=$name?></option>
                    <?php }?>
                </select>
            </p>
            <p class="line">
                <label>우선순위</label>
                <input type="text" name="prodOrder" placeholder="0" value="<?=empty($productData['prod_order'])?'':$productData['prod_order']?>">큰 순서로 노출
            </p>

			<p class="name">판매가격</p>
			<div class="price">
				<p class="name">가격 정보</p>
                <p class="line">
                    <label>시중가격</label>
                    <input type="text" name="prodPrice2" placeholder="기본 판매가를 입력하세요" value="<?=empty($productData['prod_price2'])?'':number_format($productData['prod_price2'])?>" required>원
                </p>
				<p class="line">
					<label>할인가(실제)</label>
					<input type="text" name="prodPrice" placeholder="기본 할인가를 입력하세요" value="<?=empty($productData['prod_price'])?'':number_format($productData['prod_price'])?>" required>원
				</p>
			</div>

            <p class="name" style="display: none">상품 정보</p>
            <p class="line" style="display: none"><label>원산지</label><input type="text" name="prodOrigin" placeholder="원산지를 입력하세요" value="<?=$productData['prod_origin']?>"></p>
            <p class="line" style="display: none"><label>포장 방법</label><input type="text" name="packageMethod" placeholder="포장 방법을 입력하세요" value="<?=$productData['package_method']?>"></p>
            <p class="line" style="display: none"><label>상품 구성</label><input type="text" name="prodFormat" placeholder="상품 구성을 입력하세요" value="<?=$productData['prod_format']?>"></p>
            <p class="name">배송 정보</p>
            <p class="line"><label>배송 방법</label><input type="text" name="shippingInfo" placeholder="예) 택배(15시 이전 입금 확인시 당일발송)" value="<?=$productData['shipping_info']?>"></p>
            <p class="line" style="display: none">
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
            <p class="name">상세 정보</p>
            <div class="editor">
				<!-- 상세설명 -->
				<div id="editor"></div>
				<textarea name="content" style="display: none;"><?=$productData['content']?></textarea>
            </div>
            <p class="name">사진 등록 (최대5장)</p>
            <div class="newpic-upload">
                <button type="button" class="newpic-edit" onclick="addProductImage()"><i class="fa-thin fa-plus"></i></button>
				<div class="flex" id="prevImageWrap">
					<!--사진미리보기-->
				</div>
                <?/*<div class="newpic-preview">
                    <div id="prodImgPrev0">
                        <div class="thumb_img"><img src="<?=ASSETS_URL?>/img/common/noimg.jpg"></div>
                    </div>
                    <button type="button" class="newpic-del"><i class="fa-solid fa-close"></i></button>
                </div>*/?>
            </div>

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
