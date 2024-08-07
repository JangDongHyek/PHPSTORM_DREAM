<?php
$pid = "index";
include_once("./app_head.php");

if($member['mb_type'] == DELIVERY){
    header('Location: '.APP_URL);
    exit;
}
?>

<div id="header">
	<div class="text">
		<h3><strong><?=$member['mb_company_name']?></strong> 님!</h3>
<!--		<p>배송 현황을 확인하세요 <span><i class="fa-light fa-angle-right"></i></span></p>-->
	</div>
</div>

<div id="container">
	<div id="nowTab" class="now">
		<h5>현재</h5>		
	</div>
	<div id="doneTab" class="done">
		<h5>완료건</h5>		
	</div>
</div>

<script>
    
    var page = 1,
        pagingCount = 20;
    
    function defaultSetup(){        
        webViewPostMsg({'type' : 'getDeviceToken'}); /* 디바이스 토큰 업데이트 */
        setIsRefresh(true); /* APP 새로고침 허용 */
        clearHistory(); /* 뒤로가기 막기 */             
        
        getDispatchList();
    }
    
    async function getDispatchList(){
        
        const dispatchList = await postJson(getAjaxUrl('paging'), {
            mode : 'getDispatchList',
            page : page,
            pagingCount : pagingCount
        });
        
        let listLength = dispatchList.list.length;        
        
        dispatchList.list.forEach((data, key) => {
            let nowList = '',
                doneList = '';
            
            if(data.status_code == '4'){ // 완료
                
                if(!$(`.date[data-date="${data.reg_date}"]`).length){
                    doneList += `<h6 class="date" data-date="${data.reg_date}">${data.reg_date}(${data.regDateWeekDay})</h6>`;   
                }
                
                doneList += `<div class="list flex">
                              <div class="txt">
                                 <div class="flex">
                                    <p class="txt1 prdt">${data.product_name}</p>
                                    <p class="txt1"><span class="deli3 ty2">배송완료</span></p>
                                </div>
                                <p class="txt2 elip">
                                    <span class="blue">배송 담당자</span> ${data.real_delivery_name} (${telNoHypen(data.delivery_mb_hp)})
                                </p>
                              </div>
                              <div class="bttn">
                                  <a href="./done2.php?idx=${data.idx}">
                                        <button type="button" class="gray">
                                            <i class="fa-duotone fa-receipt"></i>
                                        </button>
                                    </a>                                  
                              </div>
                            </div>`;
            }else{ // 현재
                let noti = `<p class="txt1"><span class="noti1"></span></p>`;
                
                if(data.dis_status_code != '0'){
                    noti = `<p class="txt1"><span class="noti1 ty${data.dis_status_code}">${data.disStatusCodeName}</span></p>`;
                }
                
                nowList += `<div class="list flex">
                               <div class="txt">
                                 <p class="txt1"><span class="deli3 ty1">배송예정</span>
                                 <span class="deli2">${data.productJson.WADAT}(${data.WadatWeekDay}) ${data.from_time}~${data.to_time}시</span></p>
                                 <p class="txt1 prdt">${data.product_name}</p>
                                 <p class="txt2 elip"><span class="blue">배송 담당자</span> ${data.real_delivery_name} (${telNoHypen(data.delivery_mb_hp)})</p>
                               </div>
                               <div class="bttn ty2">
                                    ${noti}
                                    <a href="./nowmap.php?idx=${data.idx}">
                                        <button type="button" class="blue">                                        
                                            <i class="fa-duotone fa-map-location-dot"></i>                                        
                                        </button>
                                    </a>
                                    <!-- <a href="./done2.php?idx=${data.idx}">
                                        <button type="button" class="gray">
                                            <i class="fa-duotone fa-receipt"></i>
                                        </button>
                                    </a> --!>
                               </div>
                             </div>`;
            }
            
            if(nowList){
                $('#nowTab').append(nowList);
            }

            $('#doneTab').append(doneList);
        });
        
        
        
        if(listLength < pagingCount){
            page = -1;
        }

        $(window).unbind('scroll').scroll(function(){
            let $window  = $(this);

            if(page > 0 && $window.scrollTop() + $window.height() >= $(document).height() - 50) {
                page++;
                getDispatchList();
                $window.unbind('scroll');
            }
        });
    }    
    
    $(function(){                
        
        defaultSetup();
    });
    
</script>

<?php
include_once ("./app_tail.php");
?>