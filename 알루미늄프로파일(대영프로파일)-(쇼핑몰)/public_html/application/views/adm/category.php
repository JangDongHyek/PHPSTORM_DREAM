<!--관리자-상품관리 목록-->
<section class="product">
    <form name="searchFrm" autocomplete="off">
		<input type="hidden" name="order" value=""/><!--정렬-->
        <div class="panel">
			<p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
					<option value="title" <?=$_GET['sfl']=="title"?"selected":""?>>카테고리명</option>
                </select>
				<input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <!--<button type="button" class="btn btn_orange" onclick="setDefaultDelivery()">기본 배송비 설정</button>-->
                <button type="button" class="btn btn_green" onclick="location.href='<?=PROJECT_URL?>/adm/categoryForm'">등록하기</button>
            </span>
        </div>
    </form>

    <div class="boxline">
        <div class="flex">
            <div style="flex: 1">
                <span class="tooltip-container">
                    <button type="button" class="btn btn_gray" id="modifyList">일괄 수정</button>
                    <span class="tooltip right">버튼을 클릭하면 현재 페이지의<br>배송 / 노출상태 / 우선순위 / 판매가격<br>정보를 일괄 수정합니다.</span>
                </span>
            </div>
			<select class="list_order" onchange="searchFilter('order', this.value)">
				<option value="" <?=$_GET['order']==''? 'selected':''?>>우선순위</option>
				<option value="date"  <?=$_GET['order']=='date'? 'selected':''?>>등록일</option>
			</select>
        </div>
        <div class="table adm">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="*">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <!--<col width="10%">
                    <col width="13%">
                    <col width="7%">
					<col width="*">-->
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>카테고리명</th>
                    <th>상품 등록수</th>
                    <!--
                    <th>배송</th>
                    -->
                    <th>판매가능</th>
                    <th>우선순위</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php
				foreach($listData as $list) {
					$shipFreeYn = $list['shipping_free_yn']=="Y"; // 배송무료?
					$useYn = $list['use_yn']=="Y"; // 사용중?

					$idx = $list['idx'];
					$thumbNail = ASSETS_URL . '/' . getProductThumbnail($list['file_name_list']); // 썸네일
				?>
                    <tr>
                        <td>
                            <?=$paging['listNo']?>
                            <input type="hidden" name="idx[]" value="<?=$idx?>"/>
                        </td>
                        <td><input type="text" class="num" name="category[<?=$idx?>]" value="<?=$list['category']?>"</td>
                        <!--<td><div class="thumb_img"><img src="<?/*=$thumbNail*/?>"></div></td>-->
                        <td>
                            1234
                        </td>
                        <td>
                            <select name="useYn[<?=$idx?>]">
                                <option value="Y" <?=$useYn? "selected":""?>>노출</option>
                                <option value="N" <?=!$useYn? "selected":""?>>노출안함</option>
                            </select>
                        </td>
                        <td><input type="text" class="num" name="order[<?=$idx?>]" value="<?=$list['prod_order']?>" /></td>
                        <td>
                            <button type="button" class="btn btn_black" onclick="location.href='<?=PROJECT_URL?>/adm/productForm/<?=$idx?>'">수정</button>
                            <button type="button" class="btn btn_greenline" onclick="deleteProduct(<?=$idx?>)">삭제</button>
                        </td>
                    </tr>
				<?php
					$paging['listNo']--;
				}
				if ($paging['totalCount'] == 0) { ?>
				<tr><td colspan="20" class="noDataAlign">등록된 상품이 없습니다.</td></tr>
				<?php } ?>
                </tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>

<?php include_once MODAL_PATH. "product_modal.php" // 배송비 모달 ?>

<!--상품관리 JS-->
<script src="<?=ASSETS_URL?>/js/adm/product.js?v=<?=JS_VER?>"></script>
