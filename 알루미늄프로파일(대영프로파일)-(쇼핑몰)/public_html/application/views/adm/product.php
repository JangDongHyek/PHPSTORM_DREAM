<!--관리자-상품관리 목록-->
<section class="product">
    <form name="searchFrm" autocomplete="off">
		<input type="hidden" name="order" value=""/><!--정렬-->
        <div class="panel">
			<p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
					<option value="title" <?=$_GET['sfl']=="title"?"selected":""?>>상품명</option>
					<option value="content" <?=$_GET['sfl']=="content"?"selected":""?>>상세설명</option>
                </select>
				<input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <button type="button" class="btn btn_orange" onclick="setDefaultDelivery()">기본 배송비 설정</button>
                <button type="button" class="btn btn_green" onclick="location.href='<?=PROJECT_URL?>/adm/productForm'">등록하기</button>
            </span>
        </div>
        <div class="box">
            <div class="tagbox">
                <div style="display: none">
                    <p><strong>카테고리</strong></p>
                </div>
                <div style="display: none">
					<input type="hidden" name="cate" value="<?=$_GET['cate']?>">
					<p><a onclick="searchFilter('cate', '')"><span class="tag <?=getParamMatches('cate', "")?>">전체</span></a></p>
					<? foreach (PRODUCT_CATEGORY AS $key => $name) { ?>
					<p><a onclick="searchFilter('cate', '<?=$key?>')"><span class="tag <?=getParamMatches('cate', $key)?>"><?=$name?></span></a></p>
					<? } ?>
                </div>
                <div>
                    <p><strong>노출상태</strong></p>
                </div>
                <div>
					<input type="hidden" name="isUse" value="<?=$_GET['isUse']?>">
					<p><a onclick="searchFilter('isUse', '')"><span class="tag <?=getParamMatches('isUse', "")?>">전체</span></a></p>
					<p><a onclick="searchFilter('isUse', 'Y')"><span class="tag <?=getParamMatches('isUse', "Y")?>">노출</span></a></p>
					<p><a onclick="searchFilter('isUse', 'N')"><span class="tag <?=getParamMatches('isUse', "N")?>">노출안함</span></a></p>
                </div>
                <div style="display: none">
                    <p><strong>배송</strong></p>
                </div>
                <div style="display: none">
					<input type="hidden" name="isShipFree" value="<?=$_GET['isShipFree']?>">
					<p><a onclick="searchFilter('isShipFree', '')"><span class="tag <?=getParamMatches('isShipFree', "")?>">전체</span></a></p>
					<p><a onclick="searchFilter('isShipFree', 'Y')"><span class="tag <?=getParamMatches('isShipFree', "Y")?>">유료</span></a></p>
					<p><a onclick="searchFilter('isShipFree', 'N')"><span class="tag <?=getParamMatches('isShipFree', "N")?>">무료</span></a></p>
                </div>
                <div>
                    <p><strong>임시품절</strong></p>
                </div>
                <div>
					<input type="hidden" name="soldOut" value="<?=$_GET['soldOut']?>">
					<p><a onclick="searchFilter('soldOut', '')"><span class="tag <?=getParamMatches('soldOut', "")?>">전체</span></a></p>
					<p><a onclick="searchFilter('soldOut', 'Y')"><span class="tag <?=getParamMatches('soldOut', "Y")?>">여</span></a></p>
					<p><a onclick="searchFilter('soldOut', 'N')"><span class="tag <?=getParamMatches('soldOut', "N")?>">부</span></a></p>
                </div>
				<div>
					<p><strong>BEST</strong></p>
				</div>
				<div>
					<input type="hidden" name="mdRec" value="<?=$_GET['mdRec']?>">
					<p><a onclick="searchFilter('mdRec', '')"><span class="tag <?=getParamMatches('mdRec', "")?>">전체</span></a></p>
					<p><a onclick="searchFilter('mdRec', 'Y')"><span class="tag <?=getParamMatches('mdRec', "Y")?>">여</span></a></p>
					<p><a onclick="searchFilter('mdRec', 'N')"><span class="tag <?=getParamMatches('mdRec', "N")?>">부</span></a></p>
				</div>
            </div>
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
                    <col width="10%">
                    <col width="100px">
                    <col width="*">
                    <!--
                    <col width="10%">
                    -->
                    <col width="10%">
                    <col width="10%">
                    <col width="13%">
                    <col width="7%">
					<col width="5%">
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>카테고리</th>
                    <th>이미지</th>
                    <th>상품명</th>
                    <!--
                    <th>배송</th>
                    -->
                    <th>노출상태</th>
                    <th>우선순위</th>
                    <th>할인가</th>
                    <th>등록일</th>
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
                    <td><?=$list["categoryParent"]->name?> <?=$list["categoryChild"] ? " > ".$list["categoryChild"]->name : ""?></td>
                    <td><div class="thumb_img"><img src="<?=$thumbNail?>"></div></td>
                    <td class="text_left">
                        <?/*<!--라벨--><div class="icon"><span class="green">인기상품</span><span class="gray">임시품절</span></div>*/?>
						<div class="icon">
							<?if ($list['md_rec_yn']=='Y') {?><span class="green">BEST</span><?}?>
							<?if ($list['soldout_yn']=='Y') {?><span class="gray">임시품절</span><?}?>
						</div>
                        <a href="<?=PROJECT_URL?>/medicinal/<?=$idx?>" target="_blank"><?=$list['prod_name']?></a>
                    </td>
                    <td style="display: none">
						<select name="shipFreeYn[<?=$idx?>]">
							<option value="N" <?=!$shipFreeYn? "selected":""?>>유료</option>
							<option value="Y" <?=$shipFreeYn? "selected":""?>>무료</option>
						</select>
                    </td>
                    <td>
						<select name="useYn[<?=$idx?>]">
							<option value="Y" <?=$useYn? "selected":""?>>노출</option>
							<option value="N" <?=!$useYn? "selected":""?>>노출안함</option>
						</select>
                    </td>
                    <td><input type="text" class="num" name="order[<?=$idx?>]" value="<?=$list['prod_order']?>" /></td>
					<td><input type="text" class="num" name="price[<?=$idx?>]" value="<?=number_format($list['prod_price'])?>" /></td>
					<td><?=replaceDateFormat($list['reg_date'])?></td>
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
