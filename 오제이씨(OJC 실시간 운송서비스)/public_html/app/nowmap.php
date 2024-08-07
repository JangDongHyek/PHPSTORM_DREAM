<?php
$pid = "map";
include_once("./app_head.php");

$dispatch_idx = $_GET['idx'];

$data = getDispatchInfo($dispatch_idx);

if(empty($data['product_string'])){
	alert('완료되거나 삭제된 배송입니다.');
	exit;
}
?>

<style>
	body {background: #F5F5F5;       height: 100vh;}
</style>


<div id="map"> <!--길찾기 기능 전체화면 구현후 주석삭제-->
	
</div>


<? if($data['dis_status_code'] != '0'){ ?>
<div id="mapnoti"> <!--시나리오따라 비노출-->
	<p class="elip">        
        <strong>[<?=DisStatusCode[$data['dis_status_code']]['name']?>안내]</strong> 최대한 빠르게 배송할 수 있도록 하겠습니다.<br>
        <? if(!empty($data['dis_status_text'])){ ?>
            <span><?=$data['dis_status_text']?></span>
        <? } ?>
    </p>
</div>
<? } ?>

<div id="mapinfo">
	
    <table class="date" border="0" width="100%" style="margin-bottom:10px;">
	  	<colgroup>
			<col width="20px">			  
			<col width="*">			  
	    </colgroup>				  
		  <tr>
			<th class="">일자</th>
			<td class=""><?=getKrDate(TODAY)?></td>
		  </tr>
    </table>
	
    <div class="list" style="min-height: 0px;  border-top: 1px solid #ececec;">						
    	<div class="comments">
    	    <p class="pin1">
    	        <span id="nowDeliveryDate">현재 위치</span>
    	        <br>
    	        <span id="nowDeliveryAddr"></span>
    	    </p>
    	    <p class="pin2">
    	      <span>배송 위치</span>    
    	      <br>
    	      <?=$data['customer_addr']?> <?=$data['customer_addr_detail']?>
            </p>
    	</div>
    </div>

	
	<div class="list" style="min-height: 0px">
	  <table class="" border="0" width="100%">
		  	<colgroup>
				<col width="90px">			  
				<col width="*">			  
		    </colgroup>				  
            <tr>
                <th class="">배송물품</th>
                <td class=""><?=$data['product_name']?>
                    <a data-toggle="modal" data-target="#nowmapModal" style="cursor:pointer">
                       <span class="call">물품 목록</span>
                    </a></td>
            </tr>
            <tr>
				<th class="">배송 수량</th>
				<td class=""><?=$data['product_cnt']?></td>
            </tr>
            <tr>
				<th class="">배송 담당자</th>
				<td class="">
                    <?=$data['real_delivery_name']?>(<?=telNoHyphen($data['delivery_mb_hp'])?>)
                    <a href="tel:<?=$data['delivery_mb_hp']?>">
                       <span class="call"><i class="fa-solid fa-phone"></i></span>
                    </a>
                </td>
            </tr>
            <tr>
				<th class="">차량번호</th>
				<td class=""><?=$data['delivery_car_number']?></td>
            </tr>            
            <tr>
                <th class="">도착예정시간</th>
                <td class=""><?=getTimeFormat($data['from_time'])?>시 ~ <?=getTimeFormat($data['to_time'])?>시</td>
            </tr>            
	  </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="nowmapModal" tabindex="-1" aria-labelledby="nowmapModalLabel" aria-hidden="true">
  <div class="modal-dialog" style=" margin: 50px auto 0;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nowmapModalLabel" style="font-size: 1.2em;font-weight: 800;"><i class="fa-duotone fa-truck"></i> 물품 목록</h5>
      </div>
      <div class="modal-body list">
        <table class="" border="0" width="100%">
			  	<colgroup>
					<col width="100px">			  
					<col width="*">			  
			    </colgroup>
				<tbody>
                  <? foreach($data['product_full_string'] as $key => $val){ ?>
                        <tr>
					        <th class="">배송 물품명</th>
					        <td class=""><?=$val['MAKTX']?></td>
				        </tr>
                        <tr class="last">
                            <th class="">배송 수량</th>
                            <td class=""><?=(int)$val['LFIMG']?>개</td>
                        </tr>
                  <? } ?>				  
				</tbody>
			</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=KakaoJsKey?>"></script>
<script>
    
    const $data = <?=json_encode($data)?>;    
    
    var container = document.getElementById('map'),
        options = {
            center: new kakao.maps.LatLng($data.customer_lat, $data.customer_lng),
            level: 12
        },
        map = new kakao.maps.Map(container, options),   
        
        /* 배송도착지점 마커 */
        customerMarker = new kakao.maps.CustomOverlay({ 
            position:  new kakao.maps.LatLng($data.customer_lat, $data.customer_lng),
            content: `<div class="marker">${$data.real_company_name}</div>`
        }),
        
        /* 배송기사 마커 */
        deliveryMarker = new kakao.maps.CustomOverlay({
            position: map.getCenter(),
            content: `<div class="marker">${$data.delivery_car_number}</div>`
        });
        
    function defaultSetup(){
        
        const time = 20000;
        
        customerMarker.setMap(map); /* 배송도착지점 마커 */        
        deliveryMarker.setMap(map); /* 배송기사 마커 */
        
        getDeliveryPosition(true);
        
        /* time초 마다 주기적 실행 */
        setInterval(getDeliveryPosition, time);
    }
    
    async function getDeliveryPosition(isLoading = false){
        
        const positionRes = await postJson(getAjaxUrl('catch'), {            
            delivery_mb_id : $data.delivery_mb_id
        }, isLoading),
        $nowDeliveryDate = $('#nowDeliveryDate'),
        $nowDeliveryAddr = $('#nowDeliveryAddr');
        
        if(!positionRes.result){
            $nowDeliveryAddr.text('현재 기사님 위치정보를 찾을 수 없습니다.');
            $nowDeliveryAddr.text('');
            return false;
        }
        
        // 마커 위치 실시간 변경
        let data = positionRes.data,
            newPosition = new kakao.maps.LatLng(data.latitude, data.longitude);
        
        deliveryMarker.setPosition(newPosition);
        
        $nowDeliveryDate.text(`현재 위치(${data.reg_date})`);
        $nowDeliveryAddr.text(data.addr);
    }        
    
    $(function(){
        defaultSetup();
    });
    
</script>

<?php
include_once ("./app_tail.php");
?>