<?php
$pid = "admin";
$subPid = "index";
include_once("../app/app_head.php");
include_once("./admin_head.php");

$list = array();
$page = empty($_GET['page'])? 1 : $_GET['page'];
$pagingCount = 8;
$limit = getPageLimit($page, $pagingCount);

$statusCode = empty($_GET['statusCode'])? StatusCode[0]['code'] : $_GET['statusCode'];
$searchType = empty($_GET['searchType'])? '' : $_GET['searchType'];
$searchTxt = empty($_GET['searchTxt'])? '' : $_GET['searchTxt'];
$startDate = empty($_GET['startDate'])? AMonthAgo : $_GET['startDate'];
$endDate = empty($_GET['endDate'])? TODAY : $_GET['endDate'];
    

/* 기간 검색 */
$sqlSearch = "
    date(D.reg_date) >= '{$startDate}' AND
    date(D.reg_date) <= '{$endDate}' AND
";


/* 상태 검색 */
if(!empty($statusCode)){
    $sqlSearch = " status_code = '{$statusCode}' AND ";
}

/* select 검색 */
if(!empty($searchType) && !empty($searchTxt)){
    $sqlSearch .= " {$searchType} LIKE '%{$searchTxt}%' AND ";
}

    
$sql = "
    SELECT
        D.*,
        S.data_url
    FROM
        dispatch_list AS D LEFT JOIN
        signpad_list AS S ON S.dispatch_idx = D.idx AND S.is_use = '1'        
    WHERE
        $sqlSearch
        D.is_use = '1'
    ORDER BY
        D.idx DESC
    LIMIT
        $limit, $pagingCount
";

$dispatchRes = sql_query($sql);
        
for($i = 0; $row = sql_fetch_array($dispatchRes); $i++){
    $row['product_string'] = json_decode($row['product_string'], true);
    $row['product_full_string'] = json_decode($row['product_full_string'], true);
    $row['kr_complete_date'] = getKrDate($row['complete_date']);
    $list[] = $row;
}

/* 전체 갯수 구하기 */
$sql = "
    SELECT 
        COUNT(*) AS cnt 
    FROM 
        dispatch_list AS D
    WHERE
        $sqlSearch
        D.is_use = '1'
";
    
$totalCount = sql_fetch($sql)['cnt'];
?>
    
<style>
    .middle{
         vertical-align: middle !important;   
    }
</style>

	<div id="admcent">
		<? include_once('./inc/head.php'); ?>
		
		<div class="wrap">
			<div class="cate flex">
			    <form id="formSearch" action="./" method="GET">
                    <div class="select">
                        <? foreach(StatusCode as $key => $val){ ?>
                             <input type="radio" id="select<?=$val['code']?>" name="statusCode" value="<?=$val['code']?>" <?=$statusCode == $val['code']? 'checked' : ''?> onclick="serachSubmit(); 
                             ">                             
                             <label for="select<?=$val['code']?>"><?=$val['name']?></label>
                        <? } ?>
                        <button type="button" class="btn-del" onclick="removeTableData('dispatch_list')">선택삭제</button>
                    </div>
                    <div class="select2">                       
                        <select name="searchType">                            
                            <?
                                /* 검색 필드값(searchType) 배열처리 */
                                $searchTypeArr = [
                                    ['code' => "D.real_delivery_name", 'name' => "배송기사"],
                                    ['code' => "D.customer_mb_name", 'name' => "담당자"],
                                    ['code' => "D.real_company_name", 'name' => "업체명"]
                                ];
                            ?>                            
                            <? foreach($searchTypeArr as $key => $value){ ?>
                                <option value="<?=$value['code']?>" <?=$searchType == $value['code']? 'selected' : ''?>><?=$value['name']?></option>
                            <? } ?>
                        </select>

                        <p><input type="text" id="searchTxt" name="searchTxt" placeholder="검색어를 입력하세요." value="<?=$searchTxt?>"></p>
                        <p>
                            <strong>기간 검색</strong>
                            <input type="date" id="startDate" name="startDate" value="<?=$startDate?>"> ~ <input type="date" id="endDate" name="endDate" value="<?=$endDate?>">
                        </p>
                        <button type="submit" class="btn-srch"><i class="fa-light fa-magnifying-glass"></i></button>
                    </div>
                </form>
			</div>

			<!-- Button trigger modal -->

			<div class="table">
				<table id="table_id" class="display">
								<colgroup>
									<col width="10px">
									<col width="50px">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="">
									<col width="80px">
									<col width="50px">
									<col width="80px">
									<col width="50px">
								</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" id="allTableRemoveChk" onclick="tableRemoveChk('all')"></th>
							<th>상태</th>
							<th>요청일시</th>							
							<th>출고일</th>
                            <th>완료일</th>
							<th>업체명</th>
							<th>차량번호</th>
							<th>배송기사</th>
							<th>연락처</th>
							<th>담당자</th>
							<th>연락처</th>
							<th>배송주소</th>
							<th>긴급</th>
                            <th>실시간</th>
							<th>인수증</th>
							<th>기타</th>
						</tr>
					</thead>
					<tbody>
					    <? foreach($list as $key => $val){ ?>
					        <tr>
                                <td><input type="checkbox" class="tableRemoveChk" onclick="tableRemoveChk('sub')" value="<?=$val['idx']?>"></td>
                                <td><span class="ty<?=$val['status_code']?>"><?=StatusCode[$val['status_code']]['name']?></span></td>
                                <td><?=convertDateFormat($val['reg_date'])?></td>
                                <td><?=getDateFormat($val['request_date'])?></td>                                
                                <td>
                                   <? if($val['status_code'] == 4){ ?> 
                                       <?=getDateFormat2($val['complete_date'])?>
                                   <? } ?>                                    
                                </td>
                                <td><?=$val['real_company_name']?></td>
                                <td><?=$val['product_string']['ZL_CARNO']?></td>
                                <td><?=$val['real_delivery_name']?></td>
                                <td><?=telNoHyphen($val['delivery_mb_hp'])?></td>
                                <td><?=$val['customer_mb_name']?></td>
                                <td><?=telNoHyphen($val['customer_mb_hp'])?></td>
                                <td><?=$val['customer_addr']?> <?=$val['customer_addr_detail']?></td>
                                <td><span class="noti<?=$val['dis_status_code']?>"><?=DisStatusCode[$val['dis_status_code']]['name']?></span></td>
                                <td>
                                    <? if($val['status_code'] != 4){ ?> 
                                    <button type="button" class="btn-1" onclick="centerPopup('../app/nowmap.php?idx=<?=$val['idx']?>', 600, 800)">확인</button>
                                    <? } ?> 
                                </td>
                                <td>
                                    <? if(!empty($val['data_url'])){ ?>
                                        <button type="button" class="btn-2 ty1" onclick='openSignPadModal(<?=json_encode($val)?>)'>제출</button>
                                    <? } ?>
                                </td>
                                <td>
                                    <? if($val['status_code'] != 4){ ?> 
                                        <button type="button" class="btn-3" onclick='openDispatchModal(<?=json_encode($val)?>)'>수정</button>
                                    <? } ?>
                                </td>
                            </tr>
					    <? } ?>
					</tbody>
				</table>
			</div>
			<? include_once('./inc/page.php'); ?>
		</div>
	</div>
</div>

<!-- 배차하기 -->
<div class="modal fade" id="dispatchModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div id="dispatchModalBody" class="modal-body">
		  <h5>배차하기</h5>
          <table border="0" width="100%">
			<colgroup>
				<col width="100px">
				<col width="*">
			</colgroup>
              <tr>
                <input type="hidden" id="dispatch_idx" value="" /> <!--idx-->
                
				<th>상태</th>
				<td>
					<select id="status_code">
					    <? foreach(StatusCode as $key => $val){ 
                            if($key == 0 || $key == 4) continue;
                        ?>
					        <option value="<?=$val['code']?>"><?=$val['name']?></option>
					    <? } ?>
					</select>
				</td>
			  </tr>
			  <tr>
				<th>긴급</th>
				<td>				               
					<select id="dis_status_code">
					    <? foreach(DisStatusCode as $key => $val){ ?> 
					        <option value="<?=$val['code']?>"><?=$val['name']?></option>
					    <? } ?>						
					</select>
				</td>
			  </tr>			  
			  <tr>
                  <th></th>
			      <td>
			          <div class="line">물품조회</div>
			      </td>
			  </tr>
			  <tr>
				<th>요청일시</th><!--당일로 고정-->
				<td><input type="date" id="request_date" value="2023-01-03"></td>
			  </tr>
			  <tr>
				<th>출하지점</th>
				<td>
				    <select id="shipping_point">
				        <option value="">선택</option>
				        <? foreach(ShippingPoint as $key => $value){ ?>
				            <option value="<?=$value['code']?>"><?=$value['name']?></option>
				        <?} ?>		
					</select>
				</td>
			  </tr>
			  <tr>
                  <th></th>
			      <td>
			          <button type="button" class="btn btn-primary" style="width: 100%;" onclick="searchProduct()">조회</button>
			      </td>
			  </tr>
			  <tr class="productBox hide">
				<th>납품문서</th>
				<td>
				    <input type="text" id="product_pk" placeholder="요청일시/출하지점 검색 후 조회버튼을 눌려주세요." readonly>
				    <input type="hidden" id="product_string" />
                    <input type="hidden" id="product_full_string" />
				</td>
			  </tr>
			  <tr class="productBox hide">
				<th>상품명</th>
				<td><input type="text" id="product_name" placeholder="요청일시/출하지점 검색 후 조회버튼을 눌려주세요." readonly></td>
			  </tr>
			  <tr class="productBox hide">
				<th>수량</th>
				<td><input type="text" id="product_cnt" placeholder="요청일시/출하지점 검색 후 조회버튼을 눌려주세요." readonly></td>
			  </tr>
                     
              <tr>
                  <th></th>
			      <td>
			          <div class="line">업체조회</div>
			      </td>
			  </tr>
			  
			  <tr>    
				<th>업체명</th> <!--고객사에서 찾거나 직접 입력 / 아래 세 항목 연동 혹은 직접 입력-->
				<td>
				    <input type="text" id="company_name" placeholder="업체명을 입력하세요.">
				    <input type="hidden" id="company_mb_id" value=""/>
				</td>
			  </tr>
			  <tr>
                  <th></th>
			      <td>
			          <button type="button" class="btn btn-primary" onclick="searchCompany()" style="width: 100%;">조회</button>
			      </td>
			  </tr>
			  <tr class="cpBox hide">
				<th>선택된 업체 정보</th>
				<td><input type="text" id="real_company_name" placeholder="선택된 업체" readonly></td>
			  </tr>
			  			  
			  <tr class="cpBox hide">
				<th>인수 담당자</th>
				<td><input type="text" id="customer_mb_name" placeholder="인수 담당자를 입력하세요." ></td>
			  </tr>
			  <tr class="cpBox hide">
				<th>인수 담당자 연락처</th>
				<td><input type="text" id="customer_mb_hp" placeholder="인수 담당자 연락처를 입력하세요." onkeyup="setHyphen($(this))"></td>
			  </tr>
			  
			  <tr class="cpBox hide">
				<th>배송주소</th>
				<td>
				    <input type="text" id="customer_addr" placeholder="배송주소 검색" onclick="openDaumPostcode($('#customer_zip_code'), $('#customer_addr'), $('#customer_addr_detail'), $('#customer_lat'), $('#customer_lng'))" style="cursor: pointer" readonly>
				    <input type="hidden" id="customer_zip_code"/>
				    <input type="hidden" id="customer_lat"/>
				    <input type="hidden" id="customer_lng"/>
				</td>
			  </tr>
			  <tr class="cpBox hide">
				<th>배송 상세주소</th>
				<td><input type="text" id="customer_addr_detail" placeholder="배송 상세주소를 입력하세요." ></td>
			  </tr>
             			    
              <tr>
                  <th></th>
			      <td>
			          <div class="line">기사조회</div>
			      </td>
			  </tr>
			  <tr>
				<th>기사 성함</th>
				<td>
				    <input type="text" id="delivery_mb_name" placeholder="기사 성함을 입력하세요.">
				    <input type="hidden" id="delivery_mb_id" />
				</td>
			  </tr>
			  <tr>
                  <th></th>
			      <td>
			          <button type="button" class="btn btn-primary" style="width: 100%;" onclick="searchDelivery()">조회</button>
			      </td>
			  </tr>
			  <tr class="deliveryBox hide">
				<th>선택된 기사님 정보</th>
				<td>
				    <input type="text" id="real_delivery_name" placeholder="선택된 기사" readonly>
				</td>				
			  </tr>
			  <tr class="deliveryBox hide">
				<th>기사 연락처</th>
				<td>
				    <input type="text" id="delivery_mb_hp" placeholder="기사 연락처를 입력하세요." onkeyup="setHyphen($(this))">
				</td>
			  </tr>
			</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="saveDispatch()">저장</button>
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>


<!-- 물품선택 -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="width: 1000px;">      
      <div class="modal-body">
		  <h5>물품선택</h5>
          <table border="0" width="100%" class="table">
			<colgroup>
				<col width="*">
			</colgroup>
            <thead>
                <tr>
                	<th>납품문서</th>
                    <th>납품처명(납품처코드)</th>                	
                    <th>배송기사(연락처)</th>
                    <th>차량번호</th>             
                    <th>품목번호</th>
                    <th>자재코드명(자재코드)</th>
                    <th>수량</th>
                    <th>상태</th>
                    <th>기타</th>
                </tr>
            </thead>
            <tbody id="productList">
            </tbody>
          </table>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>

<script>
    const TODAY = '<?=TODAY?>';        
    
    /* 배차 모달 */
    function openDispatchModal(data = {}){        
        let isData = !isEmptyObj(data);
                
        setDefault(data);
        setProduct(isData? data.product_string : {}, (isData && data.product_full_string)? data.product_full_string : []);
        setCustomer(data);
        setDelivery(data);
        
        $('#company_name').val('');
        $('#delivery_mb_name').val('');
        
        $('#dispatchModal').modal('show');        
        dealyScrollTop($('#dispatchModalBody'));
    }
    
    /* 배차 상단 셋팅 */
    function setDefault(data){
        let isData = !isEmptyObj(data);
        
        $('#dispatch_idx').val(isData? data.idx : '');
        $('#status_code').val((isData? data.status_code : '1')).trigger('change');
        $('#dis_status_code').val((isData? data.dis_status_code : '0')).trigger('change');        
        $('#request_date').val(isData? data.request_date : TODAY);
//        $('#request_date').val(isData? data.request_date : '2023-01-03');
        $('#shipping_point').val((isData? data.shipping_point : '')).trigger('change');   
    }
    
    /* 물품 조회 */
    async function searchProduct(){
        let $request_date = $('#request_date'),
            $shipping_point = $('#shipping_point option:selected'),
            list = '',
            falseMsg = '',
            target = null;
        
        if(!$request_date.val()){
            falseMsg = "요청일시를 입력해주세요.";
            target = $request_date;
        }else if(!$shipping_point.val()){
            falseMsg = "출하지점을 선택해주세요.";
            target = $shipping_point;
        }
        
        if(target != null){
            swal(falseMsg)
            .then(() => {
                target.focus(); 
            });
            
            return;
        }
        
        const searchProductRes = await postJson(getAjaxUrl('admin'), {            
            mode : 'searchProduct',
            request_date : unHypen($request_date.val()),
            shipping_point : $shipping_point.val()
        });
        
        if(!searchProductRes.result){
            swal(searchProductRes.msg);
            return false;
        }
                                    
        for(let vbeln of Object.keys(searchProductRes.groupedArray)) {            
            let group = searchProductRes.groupedArray[vbeln];
            
            for(let [index, item] of group.entries()) {                
                let isIndex = (index == 0),
                    rowspan = group.length;
                
                list += `<tr>`;
                
                if(isIndex){
                    list += `<td class="middle" rowspan="${rowspan}">${item.VBELN}</td>                
                             <td class="middle" rowspan="${rowspan}">${item.NAME1}(${item.KUNNR})</td>
                             <td class="middle" rowspan="${rowspan}">${item.ZNAME1}(${item.ZPHONE})</td>
                             <td class="middle" rowspan="${rowspan}">${item.ZL_CARNO}</td>`;   
                }
                
                list += `<td>${item.POSNR}</td>
                         <td>${item.MAKTX}(${item.MATNR})</td>
                         <td>${parseInt(item.LFIMG)}</td>
                         <td>${item.ZZSTAT}</td>`;
                
                if(isIndex){
                    list += `<td class="middle" rowspan="${rowspan}">
                                <button type="button" class="btn-2 ty1" onclick='setProduct(${JSON.stringify(item)}, ${JSON.stringify(group)}, true)'>선택</button>
                             </td>`;
                }
                
                list += `</tr>`;                
            } 
        }
        
        $('#productList').html(list); 
        $('#productModal').modal('show');
    }
    
    /* 물품 셋팅 */
    function setProduct(data, fullData, isModalSelect = false){
        let isData = !isEmptyObj(data),
            productName = (isData? data.MAKTX : ''),
            productCnt = (isData? (parseInt(data.LFIMG) + '개') : '');                
                        
        /* 상품이 두개 이상일 경우 */                        
        
        if(fullData.length >= 2){ 
            let cnt = fullData.length - 1;
            
            productName += ` 외 ${cnt}개`;
            productCnt += ` 외 ${cnt}건`;
        }
        
        $('#product_string').val(isData? (JSON.stringify(data)) : '');
        $('#product_full_string').val(isData? (JSON.stringify(fullData)) : '');        
        $('#product_pk').val(isData? (`${data.VBELN}`) : '');
        $('#product_name').val(productName);
        $('#product_cnt').val(productCnt);
        
        if(isData){
            $('.productBox').removeClass('hide');
        }else{
            $('.productBox').addClass('hide');
        }
        
        if(isModalSelect){
            $('#productModal').modal('hide');
            dealyFocus($('#company_name'), 0);
        }
        
        return false;
    }
    
    /* 업체조회 */
    async function searchCompany(){
        let $company_name = $('#company_name');
        
        if(!$company_name.val()){
            swal('업체명을 입력해주세요.')
            .then(() => {
                $company_name.focus();
            });
            return;
        }
        
        const searchCompanyRes = await postJson(getAjaxUrl('admin'), {            
            mode : 'searchCompany',
            company_name : $company_name.val()
        });

        if(!searchCompanyRes.result){
            swal(searchCompanyRes.msg);
            return false;
        }
                
        setCustomer(searchCompanyRes.companyInfo);
        dealyFocus($('#delivery_mb_name'), 0);
    }
    
    /* 업체 셋팅 */    
    function setCustomer(data){        
        let isData = !isEmptyObj(data);
                
        $('#real_company_name').val(isData? (`${data.real_company_name}`) : '');
        $('#company_mb_id').val(isData? data.company_mb_id : '');
        $('#customer_mb_name').val(isData? data.customer_mb_name : '');
        $('#customer_mb_hp').val(isData? telNoHypen(data.customer_mb_hp) : '');
        $('#customer_addr').val(isData? data.customer_addr : '');
        $('#customer_zip_code').val(isData? data.customer_zip_code : '');
        $('#customer_lat').val(isData? data.customer_lat : '');
        $('#customer_lng').val(isData? data.customer_lng : '');
        $('#customer_addr_detail').val(isData? data.customer_addr_detail : '');
        
        if(isData){
            $('.cpBox').removeClass('hide');
        }else{
            $('.cpBox').addClass('hide');
        }
    }
    
    /* 기사조회 */
    async function searchDelivery(){
        let $delivery_mb_name = $('#delivery_mb_name');
        
        if(!$delivery_mb_name.val()){
            swal('기사 성함을 입력해주세요.')
            .then(() => {
                $delivery_mb_name.focus();
            });
            return;
        }
        
        const searchDeliveryRes = await postJson(getAjaxUrl('admin'), {            
            mode : 'searchDelivery',
            delivery_mb_name : $delivery_mb_name.val()
        });
        
        if(!searchDeliveryRes.result){
            swal(searchDeliveryRes.msg);
            return false;
        }
                
        setDelivery(searchDeliveryRes.deliveryInfo);        
        dealyFocus($('#delivery_mb_hp'), 0);
    }        
    
    /* 기사 셋팅 */    
    function setDelivery(data){        
        let isData = !isEmptyObj(data);
        
        $('#delivery_mb_id').val(isData? data.delivery_mb_id : '');
        $('#real_delivery_name').val(isData? (`${data.real_delivery_name}`) : '');
        $('#delivery_mb_hp').val(isData? (telNoHypen(data.delivery_mb_hp)) : '');
        
        if(isData){
            $('.deliveryBox').removeClass('hide');
        }else{
            $('.deliveryBox').addClass('hide');
        }
    }
    
    /* 배차 저장(추가/수정) */
    async function saveDispatch(){
        let $shipping_point = $('#shipping_point option:selected'), // 출하지점
            $product_string = $('#product_string'), // 상품정보 JSON

            $company_mb_id = $('#company_mb_id'), // 조회한 업체 id
            $customer_mb_name = $('#customer_mb_name'), // 업체 - 인수 담당자
            $customer_mb_hp = $('#customer_mb_hp'), // 업체 - 인수 담당자 연락처
            
            $delivery_mb_id = $('#delivery_mb_id'), // 기사 - id
            $delivery_mb_hp = $('#delivery_mb_hp'), // 기사 - 연락처
            falseMsg = '',
            target = null;
        
        
        if(!$shipping_point.val()){
            falseMsg = "출하지점을 선택해주세요.";
            target = $shipping_point;
        }else if(!$product_string.val()){
            falseMsg = "물품조회 후 진행가능합니다.";
            target = $shipping_point;
        }else if(!$company_mb_id.val()){
            falseMsg = "업체조회 후 진행가능합니다.";
            target = $('#company_name');
        }else if(!$customer_mb_name.val()){
            falseMsg = "인수 담당자를 입력해주세요.";
            target = $customer_mb_name;
        }else if($customer_mb_hp.val().length != 13){
            falseMsg = "인수 담당자 연락처 11자리를 정확히 입력해주세요.";
            target = $customer_mb_hp;
        }else if(!$delivery_mb_id.val()){
            falseMsg = "기사조회 후 진행가능합니다.";
            target = $('#delivery_mb_name');
        }else if($delivery_mb_hp.val().length != 13){ 
            falseMsg = "기사 연락처 11자리를 후 진행가능합니다.";
            target = $delivery_mb_hp;
        }
        
        if(falseMsg != ''){
            swal(falseMsg)
            .then(() => {
                 target.focus();
            });            
            return;
        }
        
        const saveDispatchRes = await postJson(getAjaxUrl('admin'), {
            mode : 'saveDispatch',
            dispatch_idx : $('#dispatch_idx').val(),
            status_code : $('#status_code option:selected').val(),
            dis_status_code : $('#dis_status_code option:selected').val(),
            
            request_date : $('#request_date').val(),
            shipping_point : $shipping_point.val(),
            product_string : $product_string.val(),
            product_full_string : $('#product_full_string').val(),
            product_pk : $('#product_pk').val(),            
            product_name : $('#product_name').val(),
            product_cnt : $('#product_cnt').val(),
            
            company_mb_id : $company_mb_id.val(),
            real_company_name : $('#real_company_name').val(),
            customer_mb_name : $customer_mb_name.val(),
            customer_mb_hp : unHypen($customer_mb_hp.val()),
            customer_addr : $('#customer_addr').val(),
            customer_addr_detail : $('#customer_addr_detail').val(),
            customer_zip_code : $('#customer_zip_code').val(),
            customer_lat : $('#customer_lat').val(),
            customer_lng : $('#customer_lng').val(),
            
            delivery_mb_id : $delivery_mb_id.val(),
            real_delivery_name : $('#real_delivery_name').val(),
            delivery_mb_hp : unHypen($delivery_mb_hp.val())
        });

        if(!saveDispatchRes.result){
            swal(saveDispatchRes.msg);
            return false;
        }
        
        swal('저장되었습니다.')
        .then(() => {
            location.reload(); 
        });
    }
    
    function defaultSetup(){
        $('#table_id').DataTable({
            // 페이징 기능 숨기기
            paging: false,
            // 표시 건수기능 숨기기
            lengthChange: false,
            // 검색 기능 숨기기
            searching: false,
            // 정렬 기능 숨기기
            ordering: false,

            // 정보 표시 숨기기    
            info: false,
            "oLanguage": {
                "sEmptyTable": "배송내역이 존재하지않습니다."
            }
        });
    }
    
	$(function(){
                
        $('#company_name').on('keyup', function(e){
            if(e.keyCode != 13) return false;
            
            searchCompany();
        });                
        
        $('#delivery_mb_name').on('keyup', function(e){
            if(e.keyCode != 13) return false;
            
            searchDelivery();
        });
        
        defaultSetup();
    });
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>



<?php include_once("./admin_modal.php") ?>


<?php
include_once ("../app/tail.sub.php");
?>