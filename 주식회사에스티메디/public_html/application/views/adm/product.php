<!--관리자-상품관리 목록-->
<section class="product">
    <form name="searchFrm" autocomplete="off">
		<input type="hidden" name="order" value=""/><!--정렬-->
        <div class="panel">
			<p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
					<option value="PRODUCT_NM" <?=$_GET['sfl']=="PRODUCT_NM"?"selected":""?>>상품명</option>
					<option value="PRODUCT_CD" <?=$_GET['sfl']=="PRODUCT_CD"?"selected":""?>>제품코드</option>
					<option value="CONS_CD" <?=$_GET['sfl']=="CONS_CD"?"selected":""?>>성분코드</option>
					<option value="CONS_CD_SEQ" <?=$_GET['sfl']=="CONS_CD_SEQ"?"selected":""?>>성분코드SEQ</option>
					<option value="CONS" <?=$_GET['sfl']=="CONS"?"selected":""?>>성분분류코드</option>
					<option value="CONS_NM" <?=$_GET['sfl']=="CONS_NM"?"selected":""?>>성분분류명</option>
                </select>
				<input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <button type="button" class="btn btn_sky" onclick="getApiProductList()">상품 불러오기</button>
                <button type="button" class="btn btn_orange" data-toggle="modal" data-target="#defaultFeeModal" onclick="getAgencyFeeAll()">정산 수수료 일괄 설정</button>
                <?php if($memberId == 'lets080'){ ?>
                <button type="button" class="btn btn_gray" onclick="setDefaultToken()">기본 토큰 설정</button>
                <?php } ?>
                <button type="button" class="btn btn_blue" onclick="setDefaultDelivery()">기본 배송비 설정</button>
                <button type="button" class="btn btn_blue" onclick="location.href='<?=PROJECT_URL?>/adm/productForm'">등록하기</button>
            </span>
        </div>
        <div class="box" style="display: ">
            <div class="tagbox">

                <div>
                    <p><strong>노출상태</strong></p>
                </div>
                <div>
                    <input type="hidden" name="isUse" value="<?=$_GET['isUse']?>">
                    <p><a onclick="searchFilter('isUse', '')"><span class="tag <?=getParamMatches('isUse', "")?>">전체</span></a></p>
                    <p><a onclick="searchFilter('isUse', 'Y')"><span class="tag <?=getParamMatches('isUse', "Y")?>">노출</span></a></p>
                    <p><a onclick="searchFilter('isUse', 'N')"><span class="tag <?=getParamMatches('isUse', "N")?>">노출안함</span></a></p>
                </div>
                <div>
                    <p><strong>삭제상태</strong></p>
                </div>
                <div>
                    <input type="hidden" name="del_yn" value="<?=$_GET['del_yn']?>">
                    <p><a onclick="searchFilter('del_yn', '')"><span class="tag <?=getParamMatches('del_yn', "")?>">전체</span></a></p>
                    <p><a onclick="searchFilter('del_yn', 'Y')"><span class="tag <?=getParamMatches('del_yn', "Y")?>">삭제함</span></a></p>
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
                <!--
                <div>
                    <p><strong>카테고리</strong></p>
                </div>
                <div>
					<input type="hidden" name="cate" value="<?=$_GET['cate']?>">
					<p><a onclick="searchFilter('cate', '')"><span class="tag <?=getParamMatches('cate', "")?>">전체</span></a></p>
					<? foreach (PRODUCT_CATEGORY AS $key => $name) { ?>
					<p><a onclick="searchFilter('cate', '<?=$key?>')"><span class="tag <?=getParamMatches('cate', $key)?>"><?=$name?></span></a></p>
					<? } ?>
                </div>

                <div>
                    <p><strong>배송</strong></p>
                </div>
                <div>
					<input type="hidden" name="isShipFree" value="<?=$_GET['isShipFree']?>">
					<p><a onclick="searchFilter('isShipFree', '')"><span class="tag <?=getParamMatches('isShipFree', "")?>">전체</span></a></p>
					<p><a onclick="searchFilter('isShipFree', 'Y')"><span class="tag <?=getParamMatches('isShipFree', "Y")?>">유료</span></a></p>
					<p><a onclick="searchFilter('isShipFree', 'N')"><span class="tag <?=getParamMatches('isShipFree', "N")?>">무료</span></a></p>
                </div>

				<div>
					<p><strong>MD추천</strong></p>
				</div>
				<div>
					<input type="hidden" name="mdRec" value="<?=$_GET['mdRec']?>">
					<p><a onclick="searchFilter('mdRec', '')"><span class="tag <?=getParamMatches('mdRec', "")?>">전체</span></a></p>
					<p><a onclick="searchFilter('mdRec', 'Y')"><span class="tag <?=getParamMatches('mdRec', "Y")?>">여</span></a></p>
					<p><a onclick="searchFilter('mdRec', 'N')"><span class="tag <?=getParamMatches('mdRec', "N")?>">부</span></a></p>
				</div>
				-->
            </div>
        </div>
    </form>

    <div class="boxline">
        <div class="flex">
            <div style="flex: 1">
                <span class="tooltip-container">
                    <button type="button" class="btn btn_gray" id="modifyList">일괄 수정</button>
                    <span class="tooltip right">버튼을 클릭하면 현재 페이지의<br>배송 / 노출상태 / 우선순위 / 판매가격 / 삭제<br>정보를 일괄 수정합니다.</span>
                </span>
            </div>
			<select class="list_order" onchange="searchFilter('order', this.value)">
                <option value="prod_order" <?=$_GET['order']=='prod_order' || $_GET['order']=='' ? 'selected':''?>>우선순위</option>
                <option value="PRODUCT_CD" <?=$_GET['order']=='PRODUCT_CD'? 'selected':''?>>제품코드</option>

				<option value="date"  <?=$_GET['order']=='date'? 'selected':''?>>등록일</option>
			</select>
        </div>
        <div class="table adm">
            <table>
                <colgroup>
                    <col width="65px">
					<col width="20%">
                    <col width="*">
                    <col width="*">
                    <col width="*">
					<col width="7%">
					<col width="7%">
					<col width="10%">
					<col width="7%">
					<col width="9%">
					<col width="80px">
					<col width="40px">
                </colgroup>
                <thead>
                <tr>
                    <th class="text_left">No.</th>
                    <!--
                    <th>카테고리</th>

                    <th>이미지</th>
                    -->
					<th>제품명</th>
                    <th>성분코드</th>
                    <th>성분분류코드</th>
                    <th>성분명</th>
                    <th>규격</th>
                    <!--
                    <th>배송</th>
                    -->
                    <th>재고수량</th>
                    <th>표준코드</th>
                    <th>단가</th>
					<th>판매가</th>
                    <th>작성일<br>갱신일</th>
                    <th rowspan="2">노출<br>관리</th>
                </tr>
				<tr>
					<th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
					<th>제품코드</th>
                    <th>성분코드SEQ</th>
                    <th>성분분류명</th>
                    <th>제조사명</th>
                    <th>단위</th>
                    <th>계산단위</th>
                    <th>보험코드</th>
                    <th>보험가</th>
                    <th>정산 수수료</th>
                    <th>우선순위</th>
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
					<td class="text_left">
						<?=$paging['listNo']?>
						<input type="hidden" name="idx[]" value="<?=$idx?>"/>
					</td>
                    <!--
                    <td><?=PRODUCT_CATEGORY[$list['category']]?></td>
                    <td><div class="thumb_img"><img src="<?=$thumbNail?>"></div></td>
                    -->
					<td class="text_left">
						<?/*<!--라벨--><div class="icon"><span class="green">인기상품</span><span class="gray">임시품절</span></div>*/?>
						<div class="icon">
							<?if ($list['md_rec_yn']=='Y') {?><span class="green">MD추천</span><?}?>
							<?if ($list['soldout_yn']=='Y') {?><span class="gray">임시품절</span><?}?>
						</div>
                        <!--
						<a href="<?=PROJECT_URL?>/product/<?=$idx?>" target="_blank" class="txt_bold2 cut3"><?=$list['PRODUCT_NM']?></a>
					    -->
                        <a class="txt_bold2 cut3"><?=$list['PRODUCT_NM']?></a>
					</td>
					<td tag="CONS_CD"><?=$list['CONS_CD']?></td>
					<td tag="CONS"><?=$list['CONS']?></td>
					<td tag="CONS_CD_NM"><?=$list['CONS_CD_NM']?></td>
					<td tag="PRODUCT_STANDARD"><?=$list['PRODUCT_STANDARD']?></td>
                    <!--
                    <td>
						<select name="shipFreeYn[<?=$idx?>]">
							<option value="N" <?=!$shipFreeYn? "selected":""?>>유료</option>
							<option value="Y" <?=$shipFreeYn? "selected":""?>>무료</option>
						</select>
                    </td>
                    -->
                    <td tag="STOCK_QTY" class="txt_right"><?=number_format(removeComma($list['STOCK_QTY']))?></td>
					<td tag="STANDARD_CD"><?=$list['STANDARD_CD']?></td>
					<td tag="UNIT_PRICE" class="txt_right"><?=number_format(removeComma($list['UNIT_PRICE']),2)?></td>
					<td tag="prod_price"><input type="text" class="num" name="price[<?=$idx?>]" value="<?=number_format(removeComma($list['prod_price']))?>" /></td>
					<td tag="reg_date">
                        <?=replaceDateFormat($list['reg_date'])?><br>
                        <?=replaceDateFormat($list['mod_date'])?>
                    </td>
                    <td rowspan="2">
						<select name="useYn[<?=$idx?>]">
							<option value="Y" <?=$useYn? "selected":""?>>노출</option>
							<option value="N" <?=!$useYn? "selected":""?>>안함</option>
						</select>
                        <button type="button" class="btn btn_gray btn_mini" onclick="location.href='<?=PROJECT_URL?>/adm/productForm/<?=$idx?>'">수정</button><br>
                        <input type="hidden" name="del_yn[<?=$idx?>]" value="N">
                        <?php if($list['del_yn'] == 'N'){ ?>

                            <button type="button" class="btn btn_line btn_mini" onclick="deleteProduct(<?=$idx?>)">삭제</button>
                        <?php }else{ ?>

                        <?php } ?>
                    </td>
                </tr>
				<tr>
					<td><input type="checkbox" name="checkIdx" value="<?=$idx?>"></td>
					<td class="text_left" tag="PRODUCT_CD"><?=$list['PRODUCT_CD']?></td>
					<td tag="CONS_CD_SEQ"><?=$list['CONS_CD_SEQ']?></td>
					<td tag="CONS_NM"><?=$list['CONS_NM']?></td>
					<td tag="MAKER_NM"><?=$list['MAKER_NM']?></td>
					<td tag="PRODUCT_UNIT"><?=$list['PRODUCT_UNIT']?></td>
					<td tag="ACC_UNIT" class="txt_right"><?=number_format(removeComma($list['ACC_UNIT']),2)?></td>
					<td tag="INSU_CD"><?=$list['INSU_CD']?></td>
					<td tag="INSU_PRICE" class="txt_right"><?=number_format(removeComma($list['INSU_PRICE']),2)?></td>
                    <?/*td tag="agency_fee"><input type="text" class="num" name="agency_fee[<?=$idx?>]" value="<?=(removeComma($list['agency_fee']))?>" maxlength="5" max="5" />%</td*/?>
                    <td tag="agency_fee">
                        <?=$list['agency_fee_min']?>% ~ <?=$list['agency_fee_max']?>%
						<button type="button" class="btn btn_blue btn_mini" data-toggle="modal" data-target="#agencyFeeModal" onclick="getAgencyFee(<?=$list['idx']?>)">상세</button>
					</td>
                    <td tag="prod_order"><input type="text" class="num" name="order[<?=$idx?>]" value="<?=$list['prod_order']?>" /></td>
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
<?php include_once MODAL_PATH. "api_token_modal.php" // api토큰관련 모달 ?>


<!--상품관리 JS-->
<script src="<?=ASSETS_URL?>/js/adm/product.js?v=<?=JS_VER?>"></script>

<!-- 로더 시작 { -->
<div id="loadings">
    <div id="loading_txt">불러오는 중입니다.</div>
    <div id="loading_api"></div>
</div>
