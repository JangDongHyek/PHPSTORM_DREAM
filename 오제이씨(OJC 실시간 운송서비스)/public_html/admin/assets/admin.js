async function removeData(table, idx){
    
    if(!confirm('한 번 삭제한 정보는 복구가 불가능합니다.\n삭제 진행하시겠습니까?')) return false;
    
    const removeDataRes = await postJson(getAjaxUrl('admin'), {
        mode : 'removeData',
        table : table,
        idx : idx        
    });

    if(!removeDataRes.result){
        swal(removeDataRes.msg);
        return false;
    }
        
    swal('삭제되었습니다.')
    .then(()=>{
        location.reload();
    });
}

// 오브젝트 빈값 체크
function isEmptyObj(obj)  {
  if(obj.constructor === Object
     && Object.keys(obj).length === 0)  {
    return true;
  }
  
  return false;
}

// 딜레이 포커스
function dealyFocus($target, time = 500){
    let len = $target.val().length;
    
    setTimeout( () => {
        $target.focus();
        $target[0].setSelectionRange(len, len);        
    }, time);
}

// 딜레이 스크롤
function dealyScrollTop($target, time = 200){
    setTimeout( () => {
        $target.scrollTop(0);
    }, time);
}

// 폼 검색
function serachSubmit(){
    $('#formSearch').submit();
}

/* 출력 기능 */    
function printSignpad(dispatchIdx){
    let url = `./print.php?idx=${dispatchIdx}`;
    
    centerPopup(url);
}

function centerPopup(href, popupWidth = 600, popupHeight = 500){
    let popupX = Math.ceil(( window.screen.width - popupWidth) / 2),
        popupY = Math.ceil(( window.screen.height - popupHeight) / 2);

    popupX += window.screenLeft;
    
    window.open(href, '오제이씨 인수증 출력', 'width=' + popupWidth + ',height=' + popupHeight + ',left='+ popupX + ', top='+ popupY);
}

function tableRemoveChk(type){
    let $allTableRemoveChk = $('#allTableRemoveChk'),
        $tableRemoveChk = $('.tableRemoveChk'),
        $chk = $('.tableRemoveChk:checked');
    
    if(type == 'all'){
        if($allTableRemoveChk.is(':checked')){
            $tableRemoveChk.prop('checked', true);
        }else{
            $tableRemoveChk.prop('checked', false);
        }
    }else{
        if($chk.length == $tableRemoveChk.length){
            $allTableRemoveChk.prop('checked', true);
        }else{
            $allTableRemoveChk.prop('checked', false);
        }   
    }        
}

async function removeTableData(table){
    let $chk = $('.tableRemoveChk:checked'),
        idxArr = [];
    
    for(let i=0; i<$chk.length; i++){
        idxArr.push($chk.eq(i).val());
    }
    
    if(!idxArr.length){
        swal('삭제할 항목을 하나 이상 선택해주세요.');
        return false;
    }
    
    if(!confirm('한 번 삭제한 정보는 복구가 불가능합니다.\n삭제 진행하시겠습니까?')) return false;        
    
    const removeTableDataRes = await postJson(getAjaxUrl('admin'), {
        mode : 'removeTableData',
        table : table,
        idxArr : idxArr
    });

    if(!removeTableDataRes.result){
        swal(removeTableDataRes.msg);
        return false;
    }
        
    swal('삭제되었습니다.')
    .then(()=>{
        location.reload();
    });
}

/* 인수증 모달 */
function openSignPadModal(data){
    console.log(data);
    let list = "";
    
    $('#sDate').text(data.kr_complete_date);
    $('#sCompanyName').text(data.real_company_name);
    $('#sCompanyAddr').text(`${data.customer_addr} ${data.customer_addr_detail}`);
    $('#sCustomerName').text(data.customer_mb_name);
    $('#sCustomerMbHp').text(`${telNoHypen(data.customer_mb_hp)}`);
        
    for (let product = 0; product < data.product_full_string.length; product++) {
        let info = data.product_full_string[product],
            productLength = data.product_full_string.length,
            isLast = (productLength - 1) == product,
            productTitle = "";

        if (!product) {
            productTitle = `<th class="" rowspan="${productLength}">${!product? '배송물품' : ''}</th>`;
        }

        list += `<tr class="productNameBox ${isLast? 'y_border': 'n_border'}">				        
                      ${productTitle}
		              <td class="">${info.MAKTX} ${parseInt(comma(info.LFIMG))}개</td>
                </tr>`;
    }
       
    $('.productNameBox').remove();
    $('#pctListParents').after(list);            
    
    $('#sDataUrl').css('background-image', `url(${data.data_url})`);
    $('#sDeliveryName').text(`${data.real_delivery_name} (${telNoHypen(data.delivery_mb_hp)})`);
    $('#sCompleteDate').text(data.complete_date);
    $('#printSignpad').attr('onclick', `printSignpad(${data.idx})`);
    
    dealyScrollTop($('#signpadModalBody'));
    $('#signpadModal').modal('show');
    
    return false;
}

/*  운행기록/납품기록
    type - delivery(운행기록)
    type - customer(납품기록) */

function openRecordModal(type, name, mb_id){    
    
    let title = `${name}님의 ${type == 'delivery'? '운행기록' : '납품기록'}`;
    
    $('#recordTitle').text(title);    
    $('#record_type').val(type);
    $('#record_mb_id').val(mb_id);
            
    $('#recordModal').modal('show');
    dealyScrollTop($('#recordModalBody'));
    
    /* 스크롤이 아래로 내려가있으면 리스트를 한 번 더 불러와서 dealy 걸기 */
    setTimeout(() => {
        getRecordList(1);
    }, 300);
}

async function getRecordList(page){
    let $recordList = $('#recordList'),        
        type = $('#record_type').val(),
        mb_id = $('#record_mb_id').val(),
        pagingCount = 15,
        list = '';                        
        
    const getRecordListRes = await postJson(getAjaxUrl('admin'), {            
        mode : 'getRecordList',
        page : page,
        pagingCount : pagingCount,
        type : type,
        mb_id : mb_id
    });
    
    const listLength = getRecordListRes.list.length;
        
    if(page == 1){        
        $recordList.empty();
        
        if(!listLength) list = "내역이 존재하지 않습니다.";
    }
        
    for(let i=0; i<getRecordListRes.list.length; i++){
        let data = getRecordListRes.list[i];
        
        list += `<tr>
                    <th class="">${data.limit_complete_date}</th>
                    <td class="">${data.product_name}</td>
                    <td class="">
                        <button type="button" class="btn-5" onclick='openSignPadModal(${JSON.stringify(data)})'>인수증 보기</button>
                    </td>
                </tr>`;
    }
    
    $recordList.append(list);
    
    if(page != 1 && listLength < pagingCount){
        page = -1;
        $.toast('마지막 내역입니다.', {
            duration: 1000,
            type: 'info'
        });
        return false;
    }

   $('#recordModalBody').unbind('scroll').scroll(function(){
        let $this = $(this),
            paddingPx = 30;
       
        /* 모달 무한스크롤 패딩 값은 빼줘야함 */
        if(page > 0 && $this.scrollTop() + $this.height() >= $this.prop('scrollHeight') - paddingPx) {
            getRecordList(page + 1);
            $this.unbind('scroll');            
        }
    });
}


function excelUpload(){    
    $('#excelFile').click();
}

function isExcelFile(file) {
    let ext = file.name.split(".").pop().toLowerCase(); // 파일명에서 확장자를 가져온다.
    
    return ($.inArray(ext, ["xlsx"]) === -1) ? false : true;    
}

$(function(){    
    $('#excelFile').on('change', async function(event){
        let $el = $(this),
            formData = new FormData(),
            reader = new FileReader(),            
            file = event.target.files[0];
        
        if(!isExcelFile(file)){
            swal("[xlsx] 형식의 엑셀 파일만 업로드 가능합니다.");            
            return false;
        }                
        
        formData.append('mode', $('#excelMode').val());
        formData.append('file', file);
        
        const readExcelRes = await postFormJson(getAjaxUrl('readExcel'), formData);
        
        /* 초기화 */
        $el.val('');
        
        if(!readExcelRes.result){
            swal(readExcelRes.msg);
            return false;
        }
        
        swal(readExcelRes.msg)
        .then(() => {
            location.reload(); 
        });
    });
});